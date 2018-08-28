using System;
using System.Net.Sockets;
using System.Threading;
using ComCommunication;
using QPU_TCPIP.Classes.SerialCommunicateLayer;

namespace QPU_TCPIP.Classes.SocketCommunicateLayer
{
    public class ClientConnection
    {
        TcpClient clientSocket;
        string connectionNo;

        #region Methods
        #region General TCPIP Process Methods
        public void ConnectClient(TcpClient _ClientSocket, string _connectionNo)
        {
            this.clientSocket = _ClientSocket;
            this.connectionNo = _connectionNo;
            Thread ctThread = new Thread(Listen);
            ctThread.Start();
        }

        private void Listen()
        {
            int requestCount = 0; 
            byte[] bytesFrom = new byte[10025]; 
            string dataFromClient = null;
            NetworkStream networkStream = null;

            string[] requestedData = new string[4];
            while ((clientSocket.Connected))
            {
                try
                {
                    DateTime dtNow = DateTime.Now; requestCount++;
                    networkStream = clientSocket.GetStream();
                    networkStream.Read(bytesFrom, 0, bytesFrom.Length); // (int)clientSocket.ReceiveBufferSize);
                    dataFromClient = System.Text.Encoding.ASCII.GetString(bytesFrom);

                    Console.WriteLine("------------------------------------------------");
                    Console.WriteLine("[{0}. isteğe ait datalar:]", requestCount);

                    int startIndex = 0; 
                    int dataIndex = 0;
                    int i = 0; 
                    while ((startIndex < dataFromClient.Length) && (dataIndex > -1))
                    {
                        dataIndex = dataFromClient.IndexOf("#", startIndex);

                        if (dataIndex == -1) break;
                        requestedData[i] = dataFromClient.Substring(dataIndex + 1, 4).Replace("#", "");

                        startIndex += 4;

                        Console.WriteLine("\tGelen data {0} : {1}", i + 1, requestedData[i].ToString());
                        i++;
                    }


                    Console.WriteLine("Gelen komut          : {0}", Communicate.GetCommandName(requestedData[0]));
                    Console.WriteLine("İstek zamanı         : {0}.{1}", dtNow, dtNow.Millisecond);
                    Console.WriteLine("------------------------------------------------");

                    Communicating.DecideCommandResponse(requestedData);
                }
                catch (Exception ex)
                {
                    Console.WriteLine(" >> Bir hata meydana geldi {0}: ", ex.ToString());
                }
                finally
                {
                    if (networkStream != null)
                        networkStream.Flush();

                    if (clientSocket.Connected)
                        clientSocket.Close();
                }
            }
        }
        #endregion
        #endregion
    }
}
