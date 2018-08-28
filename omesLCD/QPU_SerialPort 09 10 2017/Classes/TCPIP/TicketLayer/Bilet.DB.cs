using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_TCPIP.Library.Classes;
using System.Collections;

namespace QPU_TCPIP.Classes.TicketLayer {
    public partial class Bilet {
        #region Members/Propertieses
                                public int BiletID { get; set; }
                                public int TerminalID { get; set; }
                                public int GrupID { get; set; }
                                public int BiletNo { get; set; }
                                public DateTime AlinmaTarihi { get; set; }
                                public DateTime IslemBaslangicSaati { get; set; }
                                public DateTime IslemBitisSaati { get; set; }
                                        public bool Transfer { get; set; }
                                        public int Tur { get; set; }
                                public bool Fiktif { get; set; }
        #endregion


        #region CRUD Process Methods
                                                                public DataTable Get(string Where, string Columns) {
            DataTable dtGet = (DataTable)DBProcess.SimpleQuery("BILETLER",
                "Where " + Where,
                "ORDER BY BID DESC",
                Columns)["DataTable"];

            return dtGet;
        }

        public Hashtable New() {
            Hashtable hshNewTicket = new Hashtable();
            hshNewTicket.Add("TID", TerminalID);
            hshNewTicket.Add("GRPID", GrupID);
            hshNewTicket.Add("BILET_NO", BiletNo);
            hshNewTicket.Add("SIS_TAR", AlinmaTarihi);
                                    hshNewTicket.Add("TRANSFER", Transfer);
            hshNewTicket.Add("TUR", Tur);             hshNewTicket.Add("OZEL_MUSTERI", Fiktif);

            Hashtable hshInsertState = DBProcess.InsertData("BILETLER", hshNewTicket);

            if (!hshInsertState.ContainsKey("Error")) {                 string _BiletID = hshInsertState["Identity"].ToString();                 hshInsertState.Clear();                 hshInsertState = NewQueue(_BiletID); 
                if (hshInsertState.ContainsKey("Error")) {                     this.NewQueue(_BiletID);                                     }
            }

            return hshInsertState;
        }

        private Hashtable NewQueue(string _BiletID) {
            Hashtable hshNewQueue = new Hashtable();
            hshNewQueue.Add("BID", _BiletID);
            hshNewQueue.Add("GRPID", GrupID);
            hshNewQueue.Add("BILET_NO", BiletNo);
            hshNewQueue.Add("TRANSFER", Transfer);
            hshNewQueue.Add("OZEL_MUSTERI", Fiktif);

            return DBProcess.InsertData("KUYRUK", hshNewQueue);
        }

        public Hashtable Update(string Where, Hashtable UpdateColumns) {
            return DBProcess.UpdateData("BILETLER", "Where " + Where, UpdateColumns);
        }
        #endregion
    }
}
