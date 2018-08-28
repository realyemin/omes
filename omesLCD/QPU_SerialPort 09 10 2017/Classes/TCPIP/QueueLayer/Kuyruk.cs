using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_TCPIP.Library.Classes;
using QPU_TCPIP.Classes.TicketLayer;
using System.Collections;
using QPU_SerialPort;
using QPU_TCPIP.Classes.TCPIP.SocketCommunicateLayer.QLUComm;

namespace QPU_TCPIP.Classes.QueueLayer
{
    public static class Kuyruk
    {
        #region Members/Properties
        public static string ElTerminalID { get; set; }
        public static string BiletNo { get; set; }
        #endregion



        #region Methods
        public static void CallTicket(string[] CommandDatas)
        {
            ElTerminalID = CommandDatas[1];
            BiletNo = CommandDatas[2];
            QLUClientCommunicating.SendTicketInfToLCD(Convert.ToInt32(ElTerminalID), BiletNo);

            Program.Communice.SendTicketNumber(ElTerminalID, BiletNo);
        }


        public static void ReCallTicket(string[] CommandDatas) //mt 22.06.2015, lcd ye sayý tekrarlatma gitmiyordu.
        {
            ElTerminalID = CommandDatas[1];
            BiletNo = CommandDatas[2];
            QLUClientCommunicating.SendTicketInfToLCD(Convert.ToInt32(ElTerminalID), BiletNo);

            Program.Communice.RepeatNumber(ElTerminalID,BiletNo);
        }
        #endregion
    }
}
