using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;
using System.Data;
using QVU.Library.Classes;
using System.Collections;

namespace QVU.Classes.TicketLayer
{
    public partial class Bilet
    {
        #region Members/Propertieses
        public int BiletMakineAdresi { get; set; }
        public int ButonID { get; set; }
        public DateTime BiletTarih { get; set; }
        public bool BastanNumaraVer { get; set; }
        #region Common/Public Variables
        static BiletMakineButon bmButon;
        public static Bilet newBilet;
        static Grup grup;
        #endregion
        #endregion



        #region Methods
        #region Bilet olusturma, kaydetme ve yazdirma metodlari
        public static void NewTicketRequest(byte ButonNo, byte BMAddress)
        {
            bmButon = new BiletMakineButon(ButonNo.ToString(), BMAddress.ToString());

            newBilet = new Bilet(); newBilet.GrupID = bmButon.GrupID;
            newBilet.BiletMakineAdresi = BMAddress;
            newBilet.ButonID = ButonNo;
            newBilet.BiletTarih = DateTime.Now;
            newBilet.BiletNo = newBilet.GetNextTicketNumber();
            grup = new Grup(bmButon.GrupID.ToString());

            if (CheckAvailableTicket()) { newBilet.Create(); }
        }

        public void Create()
        {
            int TicketNumber = CheckAndCorrectTicketNumber(); string WaitingPersonCount = GetWaitingPerson(GrupID); Hashtable hshNewTicketResult;
            if (TicketNumber != 0)
            {
                newBilet.TerminalID = 0; newBilet.BiletNo = TicketNumber;
                newBilet.AlinmaTarihi = this.BiletTarih;
                newBilet.Transfer = false;
                newBilet.Tur = 0; newBilet.Fiktif = false;

                hshNewTicketResult = this.New();
                if (!hshNewTicketResult.ContainsKey("Error"))
                {

                    Console.WriteLine(
                        "{0} numaralı bilet {1} ID'li grup için {2} adresli bilet makinesine gönderildi.",
                        newBilet.BiletNo,
                        grup.GRPID,
                        newBilet.BiletMakineAdresi
                        );
                }
                else {
                }
            }
            else {
            }
        }
        #endregion



        #region Bilet bilgileri alma metodlari
        public string GetWaitingPerson(int GrupID)
        {
            DataTable dtWaitingPersonCount = (DataTable)DBProcess.SimpleQuery("KUYRUK",
            "Where GRPID=" + GrupID,
            "",
            "COUNT(BID) AS BID")["DataTable"];

            if (dtWaitingPersonCount != null && dtWaitingPersonCount.Rows.Count > 0)
            {
                return dtWaitingPersonCount.Rows[0][0].ToString();
            }
            else {
                return "0";
            }
        }

        public int GetNextTicketNumber()
        {
            int NextTicketNumber = 0;
            string strWhereSQL = string.Format("Where GRPID={0} AND (SIS_TAR BETWEEN '{1}' AND '{2}')",
               newBilet.GrupID,
                BiletTarih.ToString("MM.dd.yyyy 00:00:00"),
                BiletTarih.ToString("MM.dd.yyyy 23:59:59")
                );

            DataTable dtTicketNumber = (DataTable)DBProcess.SimpleQuery("BILETLER",
   strWhereSQL,
   "ORDER BY BID DESC",
   "TOP (1) BILET_NO")["DataTable"];

            if (dtTicketNumber != null)
            {
                if (dtTicketNumber.Rows.Count > 0)
                {
                    NextTicketNumber = int.Parse(dtTicketNumber.Rows[0][0].ToString()) + 1;
                }
                else {
                    NextTicketNumber = grup.BaslangicNo;
                }
            }
            else { NextTicketNumber = 0; }

            return NextTicketNumber;
        }
        #endregion



        #region Control Methods
        private static bool CheckAvailableTicket()
        {
            if (!bmButon.Aktif)
            {
                return false;
            }

            else if (bmButon.MaxBileteUlasildimi) return false;

            else if (!grup.Aktif) return false;

            else if (!grup.GrupMesaiSaatiDisinda) return false;

            else if (!HasTicketNumber()) return false;

            else if (!HasGroupLunchBreak()) return false;

            else if (!CheckTheLunchTicketLimit()) return false;

            else return true;
        }


        private static bool HasTicketNumber()
        {
            if (grup.BitisNo >= newBilet.BiletNo)
            {
                return true;
            }
            else {
                if (grup.Dongu)
                {
                    return true;
                }
                else {
                    return false;
                }
            }
        }

        private static bool HasGroupLunchBreak()
        {
            if (!grup.GrupOgleTatilinde)
            {
                return true;
            }
            else {
                if (grup.OgleTatilindeBiletVer)
                {
                    return true;
                }
                else {
                    return false;
                }

            }
        }


        private static bool CheckTheLunchTicketLimit()
        {
            bool bl_Return = false;
            if (grup.BiletSinirla)
            {
                if (grup.OgleArasiBaslangic > newBilet.BiletTarih)
                {
                    if (grup.OgledenOnceMaxBiletSayisi > Bilet.GetBeforeLunchTicket(grup.GRPID))
                    {
                        bl_Return = true;
                    }
                    else {
                        bl_Return = false;
                    }
                }
                else if (grup.OgleArasiBitis < newBilet.BiletTarih || grup.GrupOgleTatilinde)
                {
                    if (grup.OgledenSonraMaxBiletSayisi > Bilet.GetAfterLunchTicket(grup.GRPID))
                    {
                        bl_Return = true;
                    }
                    else {
                        bl_Return = false;
                    }
                }

                else {
                }
            }
            else {
                bl_Return = true;
            }
            return bl_Return;
        }


        private static int GetAfterLunchTicket(int GrpID)
        {
            DataTable dtTicketCount; string dtmTicketTime = grup.OgleArasiBaslangic.ToString("MM.dd.yyyy hh:mm:ss");
            string strWhereSQL = string.Format("(GRPID={0}) AND (SIS_TAR <'{1}')", GrpID, dtmTicketTime);
            dtTicketCount = newBilet.Get(strWhereSQL, "COUNT(BID) AS BID");


            if (dtTicketCount != null && dtTicketCount.Rows.Count > 0)
            {
                return int.Parse(dtTicketCount.Rows[0][0].ToString());
            }
            else {
                return 0;
            }
        }

        private static int GetBeforeLunchTicket(int GrpID)
        {
            DataTable dtTicketCount; string ticketRequestTime = newBilet.BiletTarih.ToString("MM.dd.yyyy");
            dtTicketCount = newBilet.Get("GRPID=" + GrpID + " AND SIS_TAR >='" + ticketRequestTime + "' GROUP BY BID", "Count(BID)");

            if (dtTicketCount != null && dtTicketCount.Rows.Count > 0)
            {
                return int.Parse(dtTicketCount.Rows[0][0].ToString());
            }
            else {
                return 0;
            }
        }

        private int CheckAndCorrectTicketNumber()
        {
            if (newBilet.BiletNo > grup.BitisNo)
            {
                newBilet.BiletNo = grup.BaslangicNo;
            }
            return newBilet.BiletNo;
        }
        #endregion



        public Hashtable SetTicketOnProcess(int BID)
        {
            Hashtable hshOnProcess = new Hashtable();
            hshOnProcess.Add("TID", this.TerminalID);
            hshOnProcess.Add("ISLEM_BAS_TAR", this.IslemBaslangicSaati);
            return this.Update("BID=" + BID, hshOnProcess);
        }


        public void SetTicketStateToDone(int _BiletID)
        {
            Hashtable hshTicketDone = new Hashtable();
            hshTicketDone.Add("ISLEM_BIT_TAR", this.IslemBitisSaati);

            DBProcess.UpdateData("BILETLER", "Where BID=" + _BiletID, hshTicketDone);
        }
        #endregion
    }
}
