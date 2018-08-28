using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net.Sockets;
using System.Net;
using System.Collections;
using System.Data.SqlClient;
using System.IO;
//...............
using QPU_SerialPort;

namespace QPU_TCPIP.Classes.TCPIP.SocketCommunicateLayer.QLUComm
{
    public static class QLUClientCommunicating
    {
        #region Members/Propertieses

        public static List<LCDClient> RegisteredClients { get; set; }



        #endregion



        #region Enums

        public enum RequestCommadType
        {
            ClientRegister = 0,
            ClientUnRegister = 5,
        }

        public enum ResponseCommandType
        {
            TicketInfSend = 1,
            BulletSet = 2,
            BottomBulletSet = 3,
            ProcessResult = 4,
        }

        #endregion



        #region Methods

        public static void DecideCommandResponse(string[] CommandData)
        {
            RequestCommadType requestCommandType = (RequestCommadType) int.Parse(CommandData[0]);

            if (RegisteredClients == null)
            {
                RegisteredClients = new List<LCDClient>();
            }

            switch (requestCommandType)
            {
                case RequestCommadType.ClientRegister:
                    var registerITClient = from x in RegisteredClients
                        //where x.IPAdres.ToString() == CommandData[2]
                        where x.ATID.ToString() == CommandData[1]
                        select x;

                    if (registerITClient == null || registerITClient.Count() == 0)
                    {
                        #region Note

                        #endregion

                        LCDClient lcdClient = new LCDClient(Convert.ToInt16(CommandData[1]), CommandData[2], Convert.ToInt16(CommandData[3]));

                        if (lcdClient.IsRegistrable)
                        {
                            RegisteredClients.Add(lcdClient);

                            QLUClientCommunicating.SendResult(
                                QLUClientCommunicating.RequestCommadType.ClientRegister,
                                true,
                                "QLU client register işlemi başarılı",
                                lcdClient.IPAdres
                                );

                            StreamWriter sr = new StreamWriter(@"c:\lcdler.txt", true);
                            sr.WriteLine(DateTime.Now.ToString() + " Register " + lcdClient.ATID.ToString() + "; " + lcdClient.IPAdres.ToString() + "; ");
                            sr.Flush();
                            sr.Close();
                        }
                        else
                        {
                            QLUClientCommunicating.SendResult(
                                QLUClientCommunicating.RequestCommadType.ClientRegister,
                                false,
                                lcdClient.FailedMessage,
                                lcdClient.IPAdres
                                );
                            StreamWriter sr = new StreamWriter(@"c:\lcdler.txt", true);
                            sr.WriteLine(DateTime.Now.ToString() + " Kaydolamadı " + lcdClient.ATID.ToString() + "; " + lcdClient.IPAdres.ToString() + "; ");
                            sr.Flush();
                            sr.Close();
                        }
                    }
                    break;
                case RequestCommadType.ClientUnRegister:
                    var removeITClient = from x in RegisteredClients
                        //where x.IPAdres.ToString() == CommandData[2]
                        where x.ATID.ToString() == CommandData[1]
                        select x;

                    foreach (LCDClient item in removeITClient.ToList())
                    {
                        RegisteredClients.Remove(item);

                        StreamWriter sr = new StreamWriter(@"c:\lcdler.txt", true);
                        sr.WriteLine(DateTime.Now.ToString() + " unRegister " + item.ATID.ToString() + "; " + item.IPAdres.ToString() + "; ");
                        sr.Flush();
                        sr.Close();
                    }


                    break;
                default:
                    break;
            }
        }

        public static bool SendResult(
            RequestCommadType _resultRequest, bool _result, string _resultReason, IPAddress _ipAddress)
        {
            string vs_resultRequest;
            string vs_result;
            byte[] outStream = null;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;

            try
            {
                vs_resultRequest = ((int) _resultRequest).ToString("X3");
                vs_result = Convert.ToInt16(_result).ToString("X3");


                tcpClient = new TcpClient();
                tcpClient.Connect(_ipAddress, 506);
                serverStream = tcpClient.GetStream();

                string CommandDatas = string.Format(
                    "{0}#{1}#{2}#{3}", "004", vs_resultRequest, vs_result, _resultReason);

                outStream = Encoding.ASCII.GetBytes(CommandDatas);
                serverStream.Write(outStream, 0, outStream.Length);

                return true;
            }
            catch (Exception ex)
            {
                OlayGunluk.Olay("QLUClientCommunication SendResult:"+ex.Message);
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

        public static bool SendTicketInfToLCD(int _elTermID, string _ticketNumber)
        {
            byte[] outStream = null;
            TcpClient tcpClient = null;
            NetworkStream serverStream = null;
            int port = 506;

            try
            {
                List<LCDClient> sendingTicketInfToClients = FindRelatedClients(_elTermID);

                foreach (LCDClient item in sendingTicketInfToClients)
                {
                    
                    //portu bulalım
                    //string dataSource = QPU_SerialPort.Properties.Settings.Default.DataSource;
                    //string dbName = QPU_SerialPort.Properties.Settings.Default.DbName;
                    //string dbUserName = QPU_SerialPort.Properties.Settings.Default.DBUserName;
                    //string dbPass = QPU_SerialPort.Properties.Settings.Default.DBPass;

                    //string queryString = "select distinct port from TERMINALLER T "
                    //                   + " JOIN ANATABLO_YON Y ON T.TID = Y.TID "
                    //                   + " where ELTID = " + _elTermID.ToString();

                    //string conStr = string.Format("Data Source={0};Initial Catalog={1};User ID={2};Password={3}", dataSource, dbName, dbUserName, dbPass);

                    //using (SqlConnection connection = new SqlConnection(conStr))
                    //{
                    //    SqlCommand command = new SqlCommand(queryString, connection);
                    //    connection.Open();
                    //    SqlDataReader reader = command.ExecuteReader();
                    //    try
                    //    {
                    //        if (reader.HasRows)
                    //        {
                    //            while (reader.Read())
                    //            {
                                    tcpClient = new TcpClient();
                                    if (tcpClient.Connected)
                                        tcpClient.Close();

                    port = Convert.ToInt32(item.Port); // reader["port"]);
                                    tcpClient.Connect(item.IPAdres, port); //506***);
                                    serverStream = tcpClient.GetStream();

                                    string CommandDatas = string.Format(
                                        "{0}#{1}#{2}#{3}", "001", _elTermID, item.VezneNoYonOku[_elTermID], _ticketNumber);


                                    outStream = Encoding.ASCII.GetBytes(CommandDatas);
                                    serverStream.Write(outStream, 0, outStream.Length);

                                    if (serverStream != null)
                                        serverStream.Flush();

                                    if (tcpClient.Connected)
                                        tcpClient.Close();
                    //            }
                    //        }
                    //    }
                    //    catch (Exception ex)
                    //    {
                    //        port = 506;
                    //        tcpClient.Connect(item.IPAdres, port); //506***);
                    //        serverStream = tcpClient.GetStream();

                    //        string CommandDatas = string.Format(
                    //            "{0}#{1}#{2}#{3}", "001", _elTermID, item.VezneNoYonOku[_elTermID], _ticketNumber);


                    //        outStream = Encoding.ASCII.GetBytes(CommandDatas);
                    //        serverStream.Write(outStream, 0, outStream.Length);

                    //        if (serverStream != null)
                    //            serverStream.Flush();

                    //        if (tcpClient.Connected)
                    //            tcpClient.Close();
                    //    }
                    //}

                    //ESKİ HALİ
                    //tcpClient.Connect(item.IPAdres, port); //506***);
                    //serverStream = tcpClient.GetStream();

                    //string CommandDatas = string.Format(
                    //    "{0}#{1}#{2}#{3}", "001", _elTermID, item.VezneNoYonOku[_elTermID], _ticketNumber);


                    //outStream = Encoding.ASCII.GetBytes(CommandDatas);
                    //serverStream.Write(outStream, 0, outStream.Length);

                    //if (serverStream != null)
                    //    serverStream.Flush();

                    //if (tcpClient.Connected)
                    //    tcpClient.Close();
                }
                return true;
            }
            catch (Exception ex)
            {
                OlayGunluk.Olay("QLUClientCommunication SendTicketInfToLCD:" + ex.Message);
                return false;
            }
            finally
            {
                if (serverStream != null)
                    serverStream.Flush();

                if (tcpClient != null && tcpClient.Connected)
                    tcpClient.Close();
            }
        }

        private static List<LCDClient> FindRelatedClients(int _elTermID)
        {
            List<LCDClient> rv_relatedClients = new List<LCDClient>();


            if (RegisteredClients != null)
            {
                foreach (LCDClient item in RegisteredClients)
                {
                    if (item.VezneNoYonOku.ContainsKey(_elTermID))
                    {
                        rv_relatedClients.Add(item);
                    }
                }
            }

            return rv_relatedClients;
        }

        public static void RemoveLCDClient(LCDClient _lcdClient)
        {
            RegisteredClients.Remove(_lcdClient);
        }

        #endregion
    }
}
