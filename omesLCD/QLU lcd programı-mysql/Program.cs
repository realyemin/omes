// Type: QLU.Program
// Assembly: QLU, Version=1.1.0.0, Culture=neutral, PublicKeyToken=null
// MVID: 5FBC9314-0845-40D3-B639-F723476E848F
// Assembly location: C:\OMES .NET\Açılacak\QLU\program files\OMES Elektronik\QLU\QLU.exe

using QLU.Properties;
using System;
using System.Net;
using System.Net.Sockets;
using System.Threading;
using System.Windows.Forms;

namespace QLU
{
    internal static class Program
    {
        public static QLU.Classes.Connection com = new QLU.Classes.Connection();
        public static bool IsServerStarted = true;
        //private static string mutexName = "QLU";
        public static Thread thReadServer;
        public static TcpClient clientSocket;
        public static TcpListener serverSocket;
        //private static Mutex mutex;

        static Program()
        {
        }

        [STAThread]
        private static void Main()
        {
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);
            try
            {
                //try
                //{
                //  Program.mutex = Mutex.OpenExisting(Program.mutexName);
                //  int num = (int) MessageBox.Show("LCD şu anda çalışıyor.", "Bilgi", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                //  Environment.Exit(0);
                //}
                //catch
                //{
                //  Program.mutex = new Mutex(true, Program.mutexName);
                //}
                Program.thReadServer = new Thread(new ThreadStart(Program.ListenTCPIP));
                Program.thReadServer.Name = "ListenTCPIP";
                Program.thReadServer.Start();
                Application.Run((Form) new QLUMain());
            }
            catch (Exception ex)
            {
                Console.Write(((object) ex).ToString());
            }
        }

        public static void ListenTCPIP()
        {
            string str = string.Empty;
            if (QLU.Classes.Connection.GetIP() == string.Empty)
                return;
            string ip = QLU.Classes.Connection.GetIP();
            //MessageBox.Show(ip);
            if (ip == "Error")
            {
                int num =
                    (int)
                        MessageBox.Show(
                            "IP adres alınamıyor! " + Environment.NewLine +
                            "Lütfen ağ bağlantılarınızın doğruluğundan emin olduktan sonra programı yeniden başlatınız.Program şimdi kapatılacak.",
                            "Uyarı", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
            }
            else
            {
                //MessageBox.Show("1");
                Program.serverSocket = new TcpListener(IPAddress.Parse(ip), Settings.Default.PORT_Alici);
                //MessageBox.Show("2");
                //Program.serverSocket = new TcpListener(ip, Settings.Default.PORT_Alici);
                Program.clientSocket = new TcpClient();
                //MessageBox.Show("3");
                try
                {
                    //MessageBox.Show("4");
                    Program.serverSocket.Start();
                    //MessageBox.Show("5");
                    Program.IsServerStarted = true;
                    while (true)
                    {
                        //MessageBox.Show("while");
                        Program.clientSocket = Program.serverSocket.AcceptTcpClient();
                        //MessageBox.Show("while- 2");
                        Program.com.Listen(Program.clientSocket);
                        //MessageBox.Show("while- 3");
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show(ex.Message);
                    Program.clientSocket.Close();
                    Program.serverSocket.Stop();
                    Program.IsServerStarted = false;
                }
                //MessageBox.Show("6");
            }
        }
    }
}
