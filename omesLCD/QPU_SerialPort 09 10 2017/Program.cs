using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using ComCommunication;
using System.Threading;
using ComCommunication.EventArgsClasses;
using QPU_SerialPort.Classes.SerialCommunicateLayer;
using QPU_SerialPort.Classes.QueueLayer;
using QPU_TCPIP.Classes.SysConfigration;
using System.Net;
using System.Net.Sockets;
using QPU_TCPIP.Classes.SocketCommunicateLayer;
using System.Data;
using QPU_SerialPort.Library.Classes;
using System.Collections;
using System.Timers;
using System.Windows.Forms;
using QPU_TCPIP.Classes.TCPIP.SocketCommunicateLayer.QLUComm;
using Timer = System.Threading.Timer;

//..............ert
using System.Data.SqlClient;
using System.IO.Ports;

namespace QPU_SerialPort
{
    internal class Program
    {

        #region Common Public variables

        public static Communicate Communice;
        private static int requestCount = 0;
        private static int lineCount = 0;
        private static string comPort = "COM1";
        
        #endregion


        private static void Main(string[] args)
        {
            
            Console.Title = "Omes Qpu Version(MSsql) 2017.10.08";
            try
            {
                OlayGunluk.Olay("MAIN (QPU) başlatıldı");
                Console.WriteLine("##__________ MAIN (QPU) başlatıldı _________##\n");
                //string[] ports = SerialPort.GetPortNames();
                //foreach (string port in ports)
                //{
                //    SerialPort a = new SerialPort(port);
                //    a.Open();
                //    if (a.IsOpen)
                //    {
                //        Console.WriteLine("Comport"+ port);
                //        comPort = port;
                //        break;
                //    }
                   
                //}

                if (args.Length > 0)
                {
                    comPort = "COM" + args[0].Substring(1);
                    Console.WriteLine("Com port COM" + args[0].Substring(1) + " olarak ayarlandı...");
                    OlayGunluk.Olay("Com port COM" + args[0].Substring(1) + " olarak ayarlandı...");
                }
                else
                {
                    comPort = "COM1";
                    Console.WriteLine("Com port COM1 olarak ayarlandı...");
                    OlayGunluk.Olay("Com port COM1 olarak ayarlandı...");
                }

                
                if (DBProcess.GetCon2())//bağlantıyı kotrol et
                {
                    Console.ForegroundColor = ConsoleColor.Green;
                    Console.WriteLine("\nSunucuya Bağlanıldı..\n");
                    OlayGunluk.Olay("Sunucuya Bağlanıldı..");
                    Console.ResetColor();
                }
                else
                {
                    Console.ForegroundColor = ConsoleColor.Red;
                    Console.WriteLine("\nSunucuya Bağlanılamadı.. \nSunucunun Açık olduğundan emin olup, Kullanıcı adı ve parolanızı kontrol ederek tekrar deneyiniz.\n");
                    OlayGunluk.Olay("Sunucuya Bağlanılamadı!..\n");
                    Console.ResetColor();
                    Console.Beep();
                    Console.ReadKey();
                    Environment.Exit(-1); //programdan çık
                }
            }
            catch (Exception hata1)
            {
                Console.WriteLine("Hata1:" + hata1.Message);
                OlayGunluk.Olay("Hata1:" + hata1.Message);
                Console.ForegroundColor = ConsoleColor.Red;                           
                Console.WriteLine("Com port bilgisi okunamadı, COM1 olarak ayarlandı...\n");
                Console.ResetColor();
            }

            try
            {
                Console.WriteLine("İşlem görmemiş biletler sistemden temizleniyor...");
                if (CheckLeapTicket())
                {
                    Console.WriteLine("Temizleme işlemi başarıyla tamamlandı.\n");
                }
                else
                {
                    Console.WriteLine("Temizlenecek bilet bulunamadı.\n");
                }

                Thread thrReadPort = new Thread(ListenStart);
                thrReadPort.Start();
                Thread thrReadTCPIP = new Thread(ListenTCPIP);
                thrReadTCPIP.Start();

                Thread thrReadLCD = new Thread(ListenTCPIPForLCD);
                thrReadLCD.Start();

                //Console.WriteLine("kioskta butana basacak");
                //Communicating.KiosktaOzelButonaBas();
                //Console.WriteLine("kioskta butana bastı");

                //Timer aa = new Timer(TimerCallback, null, 0, 1000);

                TimerCallback callback = new TimerCallback(TimerCallback);

                Console.WriteLine("Global ResetTimer başladı, program start time: {0}\n", DateTime.Now.ToString("HH:mm:ss"));

                // 5 saniyede bir çalışacak
                Timer stateTimer = new Timer(callback, null, 0, 1000);

                Console.ReadLine();
                Communice.Dispose();
            }
            catch (Exception hata2)
            {
                Console.WriteLine("Main HATA2:" + hata2.Message);
                OlayGunluk.Olay("Main HATA2:" + hata2.Message);
            }
        }

        static public void Tick(Object stateInfo)
        {
            Console.WriteLine("Tick: {0}", DateTime.Now.ToString("hh:mm:ss"));
        }

        private static void TimerCallback(object state)
        {
            try
            {
                string saat = DateTime.Now.TimeOfDay.ToString().Substring(0, 8);

                //Console.WriteLine("Saat: {0}", saat);

                TimeSpan time = new TimeSpan(00, 00, 00);

                if (saat == time.ToString())
                {
                    Console.WriteLine("Global Reset zamanı : " + DateTime.Now.ToString("HH:mm:ss"));
                    Console.WriteLine("İşlem görmemiş biletler sistemden temizleniyor...");
                    if (CheckLeapTicket())
                    {
                        Console.WriteLine("Temizleme işlemi başarıyla tamamlandı.");
                    }
                    else
                    {
                        Console.WriteLine("Temizlenecek bilet bulunamadı.");
                    }
                    
                }

                //GC.Collect();
            }
            catch (Exception hata)
            {
                Console.WriteLine("TimerCallback. Hata:" + hata.Message);
                OlayGunluk.Olay("TimerCallback. Hata:" + hata.Message);
            }
        }


        #region Methods

        private static bool CheckLeapTicket()
        {
            bool durum = false;
            try
            {
                DataTable dtQueue = (DataTable)DBProcess.SimpleQuery(
                    "KUYRUK INNER JOIN BILETLER ON KUYRUK.BID = BILETLER.BID",
                    "Where BILETLER.SIS_TAR < '" + DateTime.Now.ToString("yyyy.MM.dd") + "'",
                    "",
                    "KUYRUK.BID, BILETLER.SIS_TAR")["DataTable"];
                if (dtQueue != null && dtQueue.Rows.Count > 0)
                {
                    foreach (DataRow item in dtQueue.Rows)
                    {

                        DBProcess.DeleteData("KUYRUK", "Where BID = " + item[0]);
                    }
                    durum = true;
                }                
            }
            catch (Exception hata)
            {
                durum = false;
                Console.WriteLine("CheckLeapTicket. Hata:" + hata.Message);
                OlayGunluk.Olay("CheckLeapTicket. Hata:" + hata.Message);
            }
            return durum;
        }

        public static void ListenStart()
        {
            try
            {
                Communice = new Communicate(comPort, 9600, 15);

                DateTime dtNow = DateTime.Now;
                Console.WriteLine(" >> QPU Serial sistemi başlatıldı...");
                Console.WriteLine("Sistemden gelecek olan istekler dinleniyor...");
                Console.WriteLine("Sistem dinleme başlama zamanı: {0}.{1}", dtNow, dtNow.Millisecond);
                Console.WriteLine("------------------------------------------------");

                Communice.RequestedDataReceived += new Communicate.DataReceivedEventHandler(tryIt_RequestedDataReceived);
                Communice.ComPortCannotOpened += new Communicate.OnComPortCannotOpened(Communice_ComPortCannotOpened);

                Communice.Start();
                
            }
            catch (Exception hata)
            {
                Console.WriteLine("ListenStart. Hata:" + hata.Message);
                OlayGunluk.Olay("ListenStart. Hata:" + hata.Message);
            }
        }

        public static void ListenTCPIP()
        {
            ServerConfig serverConfigrations = new ServerConfig();
            IPAddress serverIP = IPAddress.Parse("127.0.0.1");
            try
            {
                serverIP = IPAddress.Parse(serverConfigrations.ServerIP);
            }
            catch(Exception Hata)
            {
                try
                {
                    string serverName = serverConfigrations.ServerIP;
                    IPAddress[] serverIPs = Dns.GetHostAddresses(serverName);
                    Console.WriteLine("ListenTCPIP Vt'den ip çekilemedi. Host Adı alındı:(" + Hata.Message + ")" + serverName);
                    OlayGunluk.Olay("ListenTCPIP Vt'den ip çekilemedi.  Host Adı alındı:(" + Hata.Message + ")" + serverName);
                    foreach (var ip in serverIPs)
                    {
                        //try
                        //{
                        if (ip.AddressFamily == AddressFamily.InterNetwork)
                        {
                            serverIP = ip;
                            Console.WriteLine(" >> İsimden IP çözüldü-> " + serverIP.ToString() + " !");
                            break;
                        }
                        //}
                        //catch (Exception hata2)
                        //{
                        //    Console.WriteLine("ListenTCPIP. Hata2:" + hata2.Message);
                        //    OlayGunluk.Olay("ListenTCPIP. Hata2:" + hata2.Message);
                        //    continue;
                        //}
                    }
                }
                catch (Exception hata2)
                {
                    Console.WriteLine("ListenTCPIP. Hata2:" + hata2.Message);
                    OlayGunluk.Olay("ListenTCPIP. Hata2:" + hata2.Message);
                }
            }

            TcpListener serverSocket = new TcpListener(serverIP, 90);
            TcpClient clientSocket = default(TcpClient);

            int counter = 0;
            try
            {
                serverSocket.Start();
            }
            catch
            {
                Console.WriteLine("Server IP adresi doğru yapılandırılmamış! Lütfen QCU üzerinden server ayarlarınızı kontrol ediniz.");
                OlayGunluk.Olay("Server IP adresi doğru yapılandırılmamış! Lütfen QCU üzerinden server ayarlarınızı kontrol ediniz.");
                return;
            }

            try
            {
                Console.WriteLine(" >> QPU TCPIP sanal aygıtları dinlemeye başladı...");

                while (true)
                {
                    counter += 1;
                    lineCount += 1;

                    if (lineCount % 10 == 0)
                    {
                        lineCount = 0;
                        Console.Clear();
                    }

                    clientSocket = serverSocket.AcceptTcpClient();
                    Console.WriteLine(" >> {0}. Sanal terminal bağlantısı sağlandı!", Convert.ToString(counter));
                    ClientConnection client = new ClientConnection();
                    client.ConnectClient(clientSocket, Convert.ToString(counter));
                }

                if (clientSocket != null)
                {
                    clientSocket.Close();
                }

                if (serverSocket != null)
                {
                    serverSocket.Stop();
                }

                Console.WriteLine(" >> çıkış yapılıyor...");
                Console.ReadLine();
            }
            catch (Exception hata2)
            {
                Console.WriteLine("ListenTCPIP Hata3:" + hata2.Message);
                OlayGunluk.Olay("ListenTCPIP Hata3:" + hata2.Message);
            }
        }

        public static void ListenTCPIPForLCD()
        {
            ServerConfig serverConfigrations = new ServerConfig();
            IPAddress serverIP = IPAddress.Parse("127.0.0.1");
            
            try
            {
                serverIP = IPAddress.Parse(serverConfigrations.ServerIP);
            }
            catch(Exception hata)
            {
                try
                {
                    string serverName = serverConfigrations.ServerIP;
                    Console.WriteLine("ListenTCPIPForLCD Vt'den ip çekilemedi.(" + hata.Message + ") Host Adı alındı:" + serverName);
                    OlayGunluk.Olay("ListenTCPIPForLCD Vt'den ip çekilemedi.(" + hata.Message + ") Host Adı alındı:" + serverName);
                    IPAddress[] serverIPs = Dns.GetHostAddresses(serverName);
                    foreach (var ip in serverIPs)
                    {
                        //try
                        //{
                        if (ip.AddressFamily == AddressFamily.InterNetwork)
                        {
                            serverIP = ip;
                            Console.WriteLine(" >> İsimden IP çözüldü-> " + serverIP.ToString() + " !");
                            break;
                        }
                        //}
                        //catch(Exception hata2)
                        //{
                        //    Console.WriteLine("ListenTCPIPForLCD metodu. Hata2:" + hata2.Message);
                        //    OlayGunluk.Olay("ListenTCPIPForLCD metodu. Hata2:" + hata2.Message);
                        //    continue;
                        //}
                    }
                }
                catch (Exception hata2)
                {
                    Console.WriteLine("ListenTCPIPForLCD metodu. Hata2:" + hata2.Message);
                    OlayGunluk.Olay("ListenTCPIPForLCD metodu. Hata2:" + hata2.Message);                   
                }
            }

            TcpListener serverSocket = new TcpListener(serverIP, 505);
            TcpClient clientSocket = default(TcpClient);

            try
            {
                serverSocket.Start();
            }
            catch
            {

                Console.WriteLine(
                    "Server IP adresi doğru yapılandırılmamış! Lütfen QCU üzerinden server ayarlarınızı kontrol ediniz.");
                OlayGunluk.Olay(
                    "Server IP adresi doğru yapılandırılmamış! Lütfen QCU üzerinden server ayarlarınızı kontrol ediniz.");
                
                return;
            }

            try
            {
                while (true)
                {
                    clientSocket = serverSocket.AcceptTcpClient();
                    QLUClientConnection clientQLU = new QLUClientConnection();
                    clientQLU.ConnectClientForLCD(clientSocket);
                }
            }
            catch (Exception ex)
            {
                if (clientSocket != null)
                {
                    clientSocket.Close();
                }
                if (serverSocket != null)
                {
                    serverSocket.Stop();
                }

                Console.WriteLine(
                    string.Format(" >> LCD aygıtları ile iletişimde bir hata meydana geldi! Hata kodu: {0}", ex.Message));
               OlayGunluk.Olay(
                   string.Format(" >> LCD aygıtları ile iletişimde bir hata meydana geldi! Hata kodu: {0}", ex.Message));
                Console.ReadLine();
            }
        }

        #endregion

        #region Events

        private static void tryIt_RequestedDataReceived(DataRequestEventArgs args)
        {
            try
            {
                DateTime dtNow = DateTime.Now;
                requestCount++;
                lineCount += 1;

                if (lineCount % 10 == 0)
                {
                    lineCount = 0;
                    Console.Clear();
                }

                Console.WriteLine("------------------------------------------------");
                Console.WriteLine("[{0}. isteğe ait datalar:]", requestCount);

                for (int i = 0; i < args.RequestedData.Length; i++)
                {
                    Console.WriteLine("\tGelen data {0} : {1}", i + 1, args.RequestedData[i].ToString());
                }

                Console.WriteLine("Gelen komut          : {0}", Communicate.GetCommandName(args.RequestedData[1].ToString()));
                //Console.WriteLine("Anket tmp bilgi btn  : {0}", args.RequestedData[2].ToString());
                //Console.WriteLine("Anket tmp bilgi elt  : {0}", args.RequestedData[5].ToString());
                Console.WriteLine("Checksum değeri      : {0}", args.RequestedData[6]);
                Console.WriteLine("İstek zamanı         : {0}.{1}", dtNow, dtNow.Millisecond);
                Console.WriteLine("------------------------------------------------");

                Communicating.DecideCommandResponse(args.RequestedData);
            }
            catch (Exception hata)
            {
                Console.WriteLine("tryIt_RequestedDataReceived hata:" + hata.Message);
                OlayGunluk.Olay("tryIt_RequestedDataReceived hata:" + hata.Message);
            }
        }

        private static void Communice_ComPortCannotOpened(string reason)
        {
            Console.WriteLine(reason);
        }
        
        #endregion
    }
}

