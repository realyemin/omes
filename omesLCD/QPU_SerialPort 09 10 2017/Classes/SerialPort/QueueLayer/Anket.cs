using System;
using System.Collections;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using QPU_SerialPort.Library.Classes;

namespace QPU_SerialPort.Classes.SerialPort.QueueLayer
{
    public class Anket
    {
        public int Secim { get; set; }
        public int TerminalId { get; set; }

        public Anket()
        {

        }

        public void Insert()
        {
            Hashtable ht = new Hashtable();
            ht.Add("Secim", Secim);
            ht.Add("Tarih", DateTime.Now);
            ht.Add("TerminalId", TerminalId);

            DBProcess.InsertData("ANKET", ht);
        }
    }
}
