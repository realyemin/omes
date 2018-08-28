// Type: QLU.Classes.Connection
// Assembly: QLU, Version=1.1.0.0, Culture=neutral, PublicKeyToken=null
// MVID: 5FBC9314-0845-40D3-B639-F723476E848F
// Assembly location: C:\OMES .NET\Açılacak\QLU\program files\OMES Elektronik\QLU\QLU.exe

using QLU.Properties;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Text;
using System.Windows.Forms;

namespace QLU.Classes
{
    public class Connection
    {
        private TcpClient clientSocket;

        public event DataReturn_Ticket Ticket_Returned;

        public event DataReturn_Header Header_Returned;

        public event DataReturn_Footer Footer_Returned;

        public event DataReturn_Command Command_Returned;

        public void Listen(TcpClient _ClientSocket)
        {
            //MessageBox.Show("c1");
            clientSocket = _ClientSocket;
            byte[] numArray = new byte[10025];
            try
            {
                int length = clientSocket.GetStream().Read(numArray, 0, numArray.Length);
                    //this.clientSocket.ReceiveBufferSize);
                string str = Encoding.ASCII.GetString(numArray).Substring(0, length);
                if (string.IsNullOrEmpty(str))
                    return;
                DecideCommand(str.Split(new char[1]
                {
                    '#'
                }));
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
                Console.Write(ex.Message);
            }
        }

        public static bool CheckQPUServer()
        {
            TcpClient tcpClient = (TcpClient) null;
            NetworkStream networkStream = (NetworkStream) null;
            try
            {
                //IPAddress address = IPAddress.Parse(Settings.Default.ServerIP.ToString());
                string address = Settings.Default.ServerIP.ToString();
                tcpClient = new TcpClient();
                tcpClient.Connect(address, Settings.Default.PORT_Gonderici);
                networkStream = tcpClient.GetStream();
                byte[] bytes = Encoding.ASCII.GetBytes(string.Format("099#000#000#000", new object[0]));
                networkStream.Write(bytes, 0, bytes.Length);
                return true;
            }
            catch (Exception ex)
            {
                Console.Write(ex.Message);
                return false;
            }
            finally
            {
                if (networkStream != null)
                    networkStream.Flush();
                if (tcpClient.Connected)
                    tcpClient.Close();
            }
        }

        public static bool ServerRegister()
        {
            TcpClient tcpClient = (TcpClient) null;
            NetworkStream networkStream = (NetworkStream) null;
            try
            {
                //IPAddress address = IPAddress.Parse(Settings.Default.ServerIP.ToString());
                string address = Settings.Default.ServerIP.ToString();
                tcpClient = new TcpClient();
                tcpClient.Connect(address, Settings.Default.PORT_Gonderici);
                networkStream = tcpClient.GetStream();
                byte[] bytes =
                    Encoding.ASCII.GetBytes(string.Format("000#{0}#{1}#{2}", (object) Settings.Default.AnatabloID,
                        (object)GetIP(), (object)Settings.Default.PORT_Alici));
                networkStream.Write(bytes, 0, bytes.Length);
                return true;
            }
            catch (Exception ex)
            {
                Console.Write(ex.Message);
                return false;
            }
            finally
            {
                if (networkStream != null)
                    networkStream.Flush();
                if (tcpClient.Connected)
                    tcpClient.Close();
            }
        }

        public static bool ServerUnRegister()
        {
            TcpClient tcpClient = (TcpClient) null;
            NetworkStream networkStream = (NetworkStream) null;
            try
            {
                //IPAddress address = IPAddress.Parse(Settings.Default.ServerIP.ToString());
                string address = Settings.Default.ServerIP.ToString();
                tcpClient = new TcpClient();
                tcpClient.Connect(address, Settings.Default.PORT_Gonderici);
                networkStream = tcpClient.GetStream();
                byte[] bytes =
                    Encoding.ASCII.GetBytes(string.Format("005#{0}#{1}", (object) Settings.Default.AnatabloID,
                        (object) GetIP()));
                networkStream.Write(bytes, 0, bytes.Length);
                return true;
            }
            catch (Exception ex)
            {
                Console.Write(ex.Message);
                return false;
            }
            finally
            {
                if (networkStream != null)
                    networkStream.Flush();
                if (tcpClient.Connected)
                    tcpClient.Close();
            }
        }

        public static string GetIP()
        {
            try
            {
                if (Settings.Default.ServerIP.ToString() == string.Empty)
                    return string.Empty;
                if (!Settings.Default.OtoIP)
                    return Settings.Default.ClientIP;
                string str = (string) null;
                foreach (IPAddress ipAddress in Dns.GetHostEntry(Dns.GetHostName()).AddressList)
                {
                    if (((object) ipAddress.AddressFamily).ToString() == "InterNetwork")
                        str = ipAddress.ToString();
                }
                return str;
            }
            catch (Exception ex)
            {
                Console.Write(ex.Message);
                return "Error";// + ex.Message;
            }
        }

        public bool CheckSum(string[] _strVeriler)
        {
            return (int.Parse(_strVeriler[0]) + int.Parse(_strVeriler[1]) + int.Parse(_strVeriler[2]) +
                    int.Parse(_strVeriler[3]) + int.Parse(_strVeriler[4]))%(int) byte.MaxValue ==
                   int.Parse(_strVeriler[5]);
        }

        public void DecideCommand(string[] _commandData)
        {
            Datas _Veri = new Datas();
            _Veri.KomutData = KomutDataTip(_commandData[0]);
            switch (_Veri.KomutData)
            {
                case CommandDataTypes.Bilet:
                    for (int index = 0; index < Enumerable.Count<string>((IEnumerable<string>) _commandData); ++index)
                    {
                        while (_commandData[index].Length < 3)
                            _commandData[index] = _commandData[index].Insert(0, "0");
                    }
                    _Veri.VezneNo = _commandData[1];
                    _Veri.OkYonu = OkYonu(_commandData[2]);
                    _Veri.BiletNo = _commandData[3];
                    if (Ticket_Returned == null)
                        break;
                    Ticket_Returned(_Veri);
                    break;
                case CommandDataTypes.UstYazi:
                    try
                    {
                        _Veri.UstBaslik = _commandData[1];
                        if (Header_Returned == null)
                            break;
                        Header_Returned(_Veri.UstBaslik);
                        break;
                    }
                    catch (Exception ex)
                    {
                        Console.Write(ex.Message);
                        break;
                    }
                case CommandDataTypes.Altyazi:
                    try
                    {
                        _Veri.AltBaslik = _commandData[1];
                        if (Footer_Returned == null)
                            break;
                        Footer_Returned(_Veri.AltBaslik);
                        break;
                    }
                    catch (Exception ex)
                    {
                        Console.Write(ex.Message);
                        break;
                    }
                case CommandDataTypes.Kontrol:
                    try
                    {
                        _Veri.SonucDegeri = SonucDegerleri(_commandData[2]);
                        _Veri.Sonuclar = Sonuclar(_commandData[1]);
                        switch (_Veri.Sonuclar)
                        {
                            case Results.Register:
                                if (Command_Returned == null)
                                    return;
                                Command_Returned(_commandData[2], _commandData[3]);
                                return;
                            case Results.Unregister:
                                if (Command_Returned == null)
                                    return;
                                Command_Returned(_commandData[2], _commandData[3]);
                                return;
                            case Results.Hatali:
                                return;
                            default:
                                return;
                        }
                    }
                    catch (Exception ex)
                    {
                        Console.Write(ex.Message);
                        break;
                    }
            }
        }

        public static CommandDataTypes KomutDataTip(string _strVeri)
        {
            if (_strVeri == "001")
                return CommandDataTypes.Bilet;
            if (_strVeri == "002")
                return CommandDataTypes.UstYazi;
            if (_strVeri == "003")
                return CommandDataTypes.Altyazi;
            return _strVeri == "004" ? CommandDataTypes.Kontrol : CommandDataTypes.Hatali;
        }

        public static Results Sonuclar(string _strVeri)
        {
            if (_strVeri == "000")
                return Results.Register;
            return _strVeri == "005" ? Results.Unregister : Results.Hatali;
        }

        public static Ways OkYonu(string _strVeri)
        {
            if (_strVeri == "001")
                return Ways.Yukari;
            if (_strVeri == "002")
                return Ways.Asagi;
            if (_strVeri == "003")
                return Ways.Ileri;
            return _strVeri == "004" ? Ways.Geri : Ways.Kapali;
        }

        public static ResultValues SonucDegerleri(string _strVeri)
        {
            return _strVeri == "001" ? ResultValues.Success : ResultValues.Failed;
        }

        public delegate void DataReturn_Ticket(Datas _Veri);

        public delegate void DataReturn_Header(string _UstBaslik);

        public delegate void DataReturn_Footer(string _AltBaskik);

        public delegate void DataReturn_Command(string _Sonuc, string _SonucBilgisi);

        public static bool GlobalReset()
        {
            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {

                //ServerConfig serverConfigrations = new ServerConfig();
                //IPAddress serverIP;
                //serverIP = IPAddress.Parse(Settings.Default.ServerIP.ToString());
                string serverIP = Settings.Default.ServerIP.ToString();

                tcpClient = new TcpClient();
                tcpClient.ReceiveTimeout = 3;
                tcpClient.Connect(serverIP, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "085", "000", "000");

                outStream = Encoding.ASCII.GetBytes(CommandDatas);
                serverStream.Write(outStream, 0, outStream.Length);

                return true;
            }
            catch (Exception ex)
            {
                return false;
            }
            finally
            {
                if (serverStream != null)
                    serverStream.Flush();

                if (tcpClient.Connected)
                    tcpClient.Close();
            }
        }
    }
}
