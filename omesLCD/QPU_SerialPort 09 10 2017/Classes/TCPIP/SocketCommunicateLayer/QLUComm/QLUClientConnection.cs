
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net.Sockets;
using System.Threading;

namespace QPU_TCPIP.Classes.TCPIP.SocketCommunicateLayer.QLUComm
{
    public class QLUClientConnection
    {
        #region Members/Properties

        private TcpClient clientSocket;

        #endregion


        #region Methods

        #region QLU TCPIP Methods

        public void ConnectClientForLCD(TcpClient _ClientSocket)
        {
            this.clientSocket = _ClientSocket;
            Thread ctThread = new Thread(Listen);
            ctThread.Start();
        }

        private void Listen()
        {
            byte[] bytesFrom = new byte[10025];
            string dataFromClient = null;
            NetworkStream networkStream = null;
            int vi_ReadingDataLenght;
            string[] requestedData;
            try
            {
                networkStream = clientSocket.GetStream();
                vi_ReadingDataLenght = networkStream.Read(bytesFrom, 0, bytesFrom.Length);
                    //(int) clientSocket.ReceiveBufferSize);**********
                dataFromClient = System.Text.Encoding.ASCII.GetString(bytesFrom);

                dataFromClient = dataFromClient.Substring(0, vi_ReadingDataLenght);

                requestedData = dataFromClient.Split('#');

                QLUClientCommunicating.DecideCommandResponse(requestedData);
            }
            catch (Exception ex)
            {
                Console.WriteLine(" >> (QLU) Bir hata meydana geldi {0}: ", ex.ToString());
            }
            finally
            {
                if (networkStream != null)
                    networkStream.Flush();

                if (clientSocket.Connected)
                    clientSocket.Close();
            }
        }

        #endregion

        #endregion
    }
}
