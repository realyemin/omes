using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net.Sockets;
using QVU.Classes.DBLayer;
using System.Net;
using QVU.Classes.SysConfigration;
using System.Windows.Forms;

namespace QVU.Classes.SocketCommunicateLayer
{
    public static class TCPIPCommunicating
    {
        #region Methods

        public static bool CheckQPUServer()
        {
            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                IPAddress serverIP = GetServerIpFromConfig();

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIP, 90);

                serverStream = tcpClient.GetStream();

                outStream = Encoding.ASCII.GetBytes("#099#000#000#000");
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

        private static IPAddress GetServerIpFromConfig() //mt
        {
            ServerConfig serverConfigrations = new ServerConfig();
            //IPAddress serverIP = IPAddress.Parse(serverConfigrations.ServerIP);

            IPAddress serverIp = IPAddress.Parse("127.0.0.1");
            try
            {
                serverIp = IPAddress.Parse(serverConfigrations.ServerIP);
            }
            catch
            {
                string serverName = serverConfigrations.ServerIP;
                IPAddress[] serverIPs = Dns.GetHostAddresses(serverName);
                foreach (var ip in serverIPs)
                {
                    try
                    {
                        if (ip.AddressFamily == AddressFamily.InterNetwork)
                        {
                            serverIp = ip;
                            // MessageBox.Show(serverIP.ToString());
                            break;
                        }
                    }
                    catch
                    {
                        continue;
                    }
                }
            }
            return serverIp;
        }

        public static bool CallTicket(int _TicketNumber, int _ElTerminalID)
        {

            string elTermID = _ElTerminalID.ToString();
            string ticketNumber = _TicketNumber.ToString();
            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (elTermID.Length < 3)
                {
                    elTermID = elTermID.Insert(0, "0");
                }

                while (ticketNumber.Length < 4)
                {
                    ticketNumber = ticketNumber.Insert(0, "0");
                }

                IPAddress serverIp = GetServerIpFromConfig();// IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "001", elTermID, ticketNumber);

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

        public static bool ReCallTicket(int _TicketNumber, int _ElTerminalID)
        {
            if (!CheckQPUServer())
            {
                MessageBox.Show(
                    string.Format("{0}{1}{2}", "QPU Server'a ulaşılamıyor.",
                        Environment.NewLine,
                        "Server programının çalıştığından emin olun ve bilet çağırma işlemini yeniden deneyin."),
                    Settings.MessageBoxTitle,
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning
                    );
                return false;
            }

            string elTermID = _ElTerminalID.ToString();
            string ticketNumber = _TicketNumber.ToString();
            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (elTermID.Length < 3)
                {
                    elTermID = elTermID.Insert(0, "0");
                }

                while (ticketNumber.Length < 4)
                {
                    ticketNumber = ticketNumber.Insert(0, "0");
                }

                IPAddress serverIp = GetServerIpFromConfig(); //IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "003", elTermID, ticketNumber);

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

        public static bool CloseDisplay(int _ElTerminalID)
        {
            string elTermID = _ElTerminalID.ToString();

            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (elTermID.Length < 3)
                {
                    elTermID = elTermID.Insert(0, "0");
                }


                IPAddress serverIp = GetServerIpFromConfig(); //IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "004", elTermID, "000");

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

        public static bool OpenDisplay(int _ElTerminalID)
        {
            string elTermID = _ElTerminalID.ToString();

            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (elTermID.Length < 3)
                {
                    elTermID = elTermID.Insert(0, "0");
                }


                IPAddress serverIp = GetServerIpFromConfig(); //IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "006", elTermID, "000");

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

        public static bool MakeLineOnDisplay(int _ElTerminalID)
        {
            string elTermID = _ElTerminalID.ToString();

            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (elTermID.Length < 3)
                {
                    elTermID = elTermID.Insert(0, "0");
                }


                IPAddress serverIp = GetServerIpFromConfig(); //IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "005", elTermID, "000");

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

        public static bool NotExistWaitingResponse(int _ElTerminalID)
        {
            string elTermID = _ElTerminalID.ToString();

            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (elTermID.Length < 3)
                {
                    elTermID = elTermID.Insert(0, "0");
                }


                IPAddress serverIp = GetServerIpFromConfig(); //IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "009", elTermID, "0000");

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

        public static bool SetStateDotMatrix(int _DotMatrixAddress, string _FlashAndDindongState)
        {
            string dotMatrixAddress = _DotMatrixAddress.ToString();
            string stateData = _FlashAndDindongState;

            byte[] outStream;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                while (dotMatrixAddress.Length < 3)
                {
                    dotMatrixAddress = dotMatrixAddress.Insert(0, "0");
                }

                while (stateData.Length < 3)
                {
                    stateData = stateData.Insert(0, "0");
                }


                IPAddress serverIp = GetServerIpFromConfig(); //IPAddress.Parse("127.0.0.1");

                tcpClient = new TcpClient();
                tcpClient.Connect(serverIp, 90);

                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format("#{0}#{1}#{2}", "021", stateData, dotMatrixAddress);

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

        #endregion
    }
}
