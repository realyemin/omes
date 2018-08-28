using System;
using System.Data;
using QVU.Library.Classes;

namespace QVU.Classes.QueueLayer.EventArgsClasses
{
    public class NextTicketDetectedEventArgs : EventArgs
    {
        #region Members/Propertieses

        public int BiletID { get; set; }
        public int GrupID { get; set; }
        public int BiletNo { get; set; }
        public bool Transfer { get; set; }
        public bool Fiktif { get; set; }
        public DateTime AlinmaTarihi { get; set; }
        public DateTime IslemSaati { get; set; }
        public string GrupAdi { get; set; }

        #endregion

        public NextTicketDetectedEventArgs(Kuyruk kuyruk)
        {
            BiletID = kuyruk.BiletId;
            BiletNo = kuyruk.BiletNo;
            Fiktif = kuyruk.Fiktif;
            GrupID = kuyruk.GrupId;
            Transfer = kuyruk.Transfer;
            
            var drTicketInfs = GetTicketInformations();
            if (drTicketInfs != null)
            {
                AlinmaTarihi = DateTime.Parse(drTicketInfs["SIS_TAR"].ToString());
                IslemSaati = DateTime.Parse(drTicketInfs["ISLEM_BAS_TAR"].ToString());
            }
            GrupAdi = GetGroupName();
        }

        private string GetGroupName()
        {
            var hshGroupNameResult = DBProcess.SimpleQuery("GRUPLAR", "Where GRPID=" + GrupID, "", "GRUP_ISMI");
            return !hshGroupNameResult.ContainsKey("Error") ? ((DataTable) hshGroupNameResult["DataTable"]).Rows[0][0].ToString() : string.Empty;
        }

        private DataRow GetTicketInformations()
        {
            var hshTicketResult = DBProcess.SimpleQuery("BILETLER", "Where BID=" + BiletID, "", "SIS_TAR, ISLEM_BAS_TAR");
            return !hshTicketResult.ContainsKey("Error") ? ((DataTable) hshTicketResult["DataTable"]).Rows[0] : null;
        }
    }
}