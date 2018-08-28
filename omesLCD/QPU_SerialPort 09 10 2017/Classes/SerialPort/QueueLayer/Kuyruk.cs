using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_SerialPort.Library.Classes;
using QPU_SerialPort.Classes.TicketLayer;
using System.Collections;
using QPU_TCPIP.Classes.TCPIP.SocketCommunicateLayer.QLUComm;
using QPU_TCPIP.Classes.QueueLayer;
using QPU_TCPIP.Library.Classes;

namespace QPU_SerialPort.Classes.QueueLayer
{
    public partial class Kuyruk
    {
        #region Members/Propertieses
        public int ElTerminalID { get; set; }
        public bool YardimGrubundan { get; set; }

        public DataTable KuyruktakiYardimEdilecekGruplar { get; set; }
        public DataTable KuyruktakiBiletler { get; set; }
        public DataTable KuyruktakiFiktifBiletler { get; set; }
        public DataTable KuyruktakiTransferBiletler { get; set; }
        public DataTable AktifCagrilanGruptakiBiletler { get; set; }
        public DataTable AktifCagrilanGruptakiTransferBiletler { get; set; }
        public DataTable TerminalinAnaGrubundakiBiletler { get; set; }
        public DataTable TerminalinYardimEdecegiGruptakiBiletler { get; set; }
        static Terminaller terminal;
        static Kuyruk kuyruk;
        Bilet bilet;
        #endregion



        #region Methods
        public static void NextTicketRequest(byte _ElTerminalID)
        {
            terminal = new Terminaller(_ElTerminalID.ToString());

            SanalTerminal.TerminalID = terminal.TID;
            SanalTerminal.OtomatikCagri = SanalTerminal.GetOtoCagriAktif();
            SanalTerminal.OtomatikCagriSuresi = SanalTerminal.GetOtoCagriSuresi();
            SanalTerminal.DoubleClick = SanalTerminal.GetDoubleClickCagriAktif();

            kuyruk = new Kuyruk();
            kuyruk.ElTerminalID = _ElTerminalID;

            //örnek týp merkezi için eklendi.

            Hashtable cl = new Hashtable();
            cl["I_yf3"] = "0";
            QPU_TCPIP.Library.Classes.DBProcess.UpdateData("KUYRUK", "Where " + "I_yf3=" + terminal.TID, cl);

            terminal.RefreshTicketInf();
            kuyruk.DetectAndSendNextTicket();
        }

        public static void KuyruktaBekleyenlerAdediniGonder(byte _ElTerminalID)
        {
            terminal = new Terminaller(_ElTerminalID.ToString());

            kuyruk = new Kuyruk();
            kuyruk.ElTerminalID = _ElTerminalID;

            terminal.RefreshTicketInf();

            kuyruk.TerminalinAnaGrubundakiBiletler = kuyruk.GetMainGroupsTickets();
            kuyruk.SendKuyruktaBekleyenlerAdet(kuyruk.ElTerminalID.ToString(), kuyruk.KuyruktakiBiletler.Rows.Count.ToString());
        }

        private void SendKuyruktaBekleyenlerAdet(string VezneNo, string Adet)
        {

            Program.Communice.SendKuyruktaBekleyenler(ElTerminalID.ToString(), Adet);
        }

        public void DetectAndSendNextTicket()
        {
            terminal.RefreshTicketInf();
            SendTicketNumber(DetectTicketNumber());

            if (KuyrukSira.KuyruktaBiletYok)
            {
                Program.Communice.NotExistWaitingResponse(this.ElTerminalID.ToString());
                terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);
                this.KillTicket();
                terminal.SetActiveTicketID(0);
            }
        }

        public void HasNotTicket()
        {
            terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

            KillTicket();
            terminal.SetActiveTicketID(0);
        }

        private void SendTicketNumber(DataRow drCallingTicket)
        {
            if (drCallingTicket == null)
            {
                HasNotTicket();
                //if (NotTicketDetected != null) NotTicketDetected();
                return;
            }

            BiletID = int.Parse(drCallingTicket["BID"].ToString());
            GrupID = int.Parse(drCallingTicket["GRPID"].ToString());
            BiletNo = int.Parse(drCallingTicket["BILET_NO"].ToString());
            Transfer = bool.Parse(drCallingTicket["TRANSFER"].ToString());
            Fiktif = bool.Parse(drCallingTicket["OZEL_MUSTERI"].ToString());


            //örnek týp merkezi için eklendi.

            //Hashtable cl = new Hashtable();
            //cl["I_yf3"] = "0";
            //QPU_TCPIP.Library.Classes.DBProcess.UpdateData("KUYRUK", "Where " + "I_yf3=" + terminal.TID, cl);

            System.Collections.Hashtable hs = new System.Collections.Hashtable();
            hs["BID"] = BiletID;
            hs["TID"] = terminal.TID;

            QPU_TCPIP.Library.Classes.DBProcess.InsertData("havuz", hs);
            //********************************************************************örnek týp merkezi için eklendi.
            //KuyrukSira.Cagrilan = KuyrukSira.GrupId == GrupId && KuyrukSira.Transfer == Transfer ? KuyrukSira.Cagrilan + 1 : 1;

            //KuyrukSira.GrupId = GrupId;
            //KuyrukSira.Transfer = Transfer;/*/*/
            //KuyrukSira.Cagrilacak = Transfer ? int.Parse(drCallingTicket["TRANSFER_ORAN"].ToString()) : int.Parse(drCallingTicket["CAGRI_ORAN"].ToString());

            KillTicket();
            CallTicket();
        }

        private DataRow DetectTicketNumber()
        {
            DataRow dr;

            do
            {
                dr = DetectTicketNumber2();
            }
            while (dr == null && !KuyrukSira.KuyruktaBiletYok);


            return dr;
        }

        private DataRow DetectTicketNumber2()
        {
            var kuyrukList = GetRealetedGroupsOfTerminal().AsEnumerable();
            KuyrukSira.KuyruktaBiletYok = false;

            if (!kuyrukList.Any())
            {
                KuyrukSira.KuyruktaBiletYok = true;
                return null;
            }

            DataRow data = kuyrukList.FirstOrDefault();
            //ysadece yardým gruplarýndan kalmýþsa
            if (!kuyrukList.Where(x => x.Field<bool>("YARDIM_GRUBU") == false).Any() && kuyrukList.Where(x => x.Field<bool>("YARDIM_GRUBU") == true).Any()) //normal bilet kalmadýysa
            {
                return data;
            }

            if (kuyrukList.FirstOrDefault()["CagriSiralamaTipi"].ToString() == "2")
            {
                return data;
            }





            // Farklý Grupta çalýþan terminalin grubunu belirledik
            #region Ömer Ekledi
            var Colun = new StringBuilder();
            Colun.Append("TGID, GRPID, CAGRI_ORAN, GRUP_TIPI ");
            var GRP = (DataTable)Library.Classes.DBProcess.SimpleQuery("VGRUPLAR ",
                "WHERE TID =" + terminal.TID, " ORDER BY ONCELIK, GRPID, GRUP_TIPI  ", Colun.ToString())["DataTable"];
            DataRow sonSatir1 = GRP.Rows[GRP.Rows.Count - 1];
            foreach (DataRow item in GRP.Rows)
            {
                if (KuyrukSira.GrupId != int.Parse(item["GRPID"].ToString()))
                {
                    if (item.Equals(sonSatir1))
                    {
                        KuyrukSira.CagrilanGruplar = Convert.ToString(KuyrukSira.GrupId = Library.Classes.DBProcess.SelectProcess2("select GRPID from BILETLER where TID =" + terminal.TID + "and BID = (select max (BID) From BILETLER where TID =" + terminal.TID + ")"));
                    }
                }
                else
                    break;
                if (KuyrukSira.GrupId <= 0)
                    break;
            }
            #endregion

            //gönderilecek bilet için grup belirle
            if (KuyrukSira.GrupId <= 0)
            #region ilk gönderilen
            {
                KuyrukSira.GrupId = Convert.ToInt32(kuyrukList.FirstOrDefault()["GRPID"].ToString());
                KuyrukSira.CagrilanGruplar = kuyrukList.FirstOrDefault()["GRPID"].ToString();

                if (kuyrukList.FirstOrDefault()["TRANSFER"].ToString() == "1")
                {
                    KuyrukSira.Cagrilacak = int.Parse(kuyrukList.FirstOrDefault()["TRANSFER_ORAN"].ToString());
                    KuyrukSira.CagrilanGrupTipi = "2";
                }
                else
                {
                    KuyrukSira.Cagrilacak = int.Parse(kuyrukList.FirstOrDefault()["CAGRI_ORAN"].ToString());
                    KuyrukSira.CagrilanGrupTipi = "1";
                }
            }
            #endregion
            else if (KuyrukSira.Cagrilan >= KuyrukSira.Cagrilacak) //çaðrýlacak sayýsý tamam ise grup deðiþtir
            #region çaðrýlan, çaðrýlacak kadar oluysa
            {/*
                0 FIKTIF
                1 NORMAL
                2 TRANSFER
                3 YARDIM
                4 YARDIM TRANSFER
              */

                var Columns = new StringBuilder();
                Columns.Append("TGID, GRPID, CAGRI_ORAN, GRUP_TIPI ");
                var Groups = (DataTable)Library.Classes.DBProcess.SimpleQuery("VGRUPLAR ",
                "WHERE TID =" + terminal.TID, " ORDER BY ONCELIK, GRPID, GRUP_TIPI  ", Columns.ToString())["DataTable"];

                bool currentGroupFound = false;
                DataRow sonSatir = Groups.Rows[Groups.Rows.Count - 1];
                DataRow ilkSatir = Groups.Rows[0];

                foreach (DataRow satir in Groups.Rows)
                {
                    if (currentGroupFound)
                    {
                        KuyrukSira.GrupId = Convert.ToInt32(satir["GRPID"].ToString());
                        KuyrukSira.CagrilanGruplar = satir["GRPID"].ToString();
                        KuyrukSira.Cagrilacak = int.Parse(satir["CAGRI_ORAN"].ToString());
                        KuyrukSira.CagrilanGrupTipi = satir["GRUP_TIPI"].ToString();

                        KuyrukSira.Cagrilan = 0;
                        break;
                    }

                    if (satir["GRPID"].ToString() == KuyrukSira.CagrilanGruplar && satir["GRUP_TIPI"].ToString() == KuyrukSira.CagrilanGrupTipi)
                    {
                        currentGroupFound = true;
                        if (satir.Equals(sonSatir))
                        {
                            KuyrukSira.GrupId = Convert.ToInt32(ilkSatir["GRPID"].ToString());
                            KuyrukSira.CagrilanGruplar = ilkSatir["GRPID"].ToString();
                            KuyrukSira.Cagrilacak = int.Parse(ilkSatir["CAGRI_ORAN"].ToString());
                            KuyrukSira.CagrilanGrupTipi = ilkSatir["GRUP_TIPI"].ToString();

                            KuyrukSira.Cagrilan = 0;
                            break;
                        }
                    }
                }
            }
            #endregion

            KuyrukSira.Cagrilan += 1;

            string where = "WHERE G.TID =" + terminal.TID;
            where += " ";// " AND (K.I_yf3 = 0 or K.I_yf3 is null) AND NOT EXISTS (SELECT BID FROM HAVUZ WHERE TID=G.TID AND BID=K.BID)"; //örnek týp merkezi için eklendi.

            string where2 = "";
            var strBlColumns = new StringBuilder();

            //AYRICALIKLI VAR MI, varsa onu gönder yoksa devam et
            #region ayrýcalýklý
            where2 = " AND G.AYRICALIKLI = 1 ";

            //grup belli, ilk bileti bulalým

            strBlColumns.Append("K.BID, K.GRPID, K.BILET_NO, K.TRANSFER, K.OZEL_MUSTERI, G.GRPID AS TGRPID, G.TID, ");
            strBlColumns.Append("G.CAGRI_ORAN, G.TRANSFER_ORAN, G.YARDIM_GRUBU, G.CAGRILAN, G.TRANSFER_CAGRILAN ");

            var dtBiletler = (DataTable)Library.Classes.DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID",
            where + where2, " ORDER BY K.OZEL_MUSTERI DESC, G.ONCELIK, G.TGID, K.TRANSFER, " + SanalTerminal.GetBiletSiralamaTipi(), //"K.BILET_NO", 
            strBlColumns.ToString())["DataTable"];

            if (dtBiletler.Rows.Count > 0)
            {
                data = dtBiletler.AsEnumerable().FirstOrDefault();
                KuyrukSira.Cagrilan = 0;
                KuyrukSira.GrupId = 0;
                return data;
            }
            #endregion

            //FÝKTÝF VAR MI, varsa onu gönder yoksa devam et
            #region fiktif
            where = "WHERE G.TID =" + terminal.TID + " AND G.GRPID = " + KuyrukSira.GrupId.ToString();
            where += " ";// " AND (K.I_yf3 = 0 or K.I_yf3 is null) AND NOT EXISTS (SELECT BID FROM HAVUZ WHERE TID=G.TID AND BID=K.BID)"; //örnek týp merkezi için eklendi.
            where2 = " AND K.OZEL_MUSTERI = 1 ";

            //grup belli, ilk bileti bulalým
            strBlColumns = new StringBuilder();
            strBlColumns.Append("K.BID, K.GRPID, K.BILET_NO, K.TRANSFER, K.OZEL_MUSTERI, G.GRPID AS TGRPID, G.TID, ");
            strBlColumns.Append("G.CAGRI_ORAN, G.TRANSFER_ORAN, G.YARDIM_GRUBU, G.CAGRILAN, G.TRANSFER_CAGRILAN ");

            dtBiletler = (DataTable)Library.Classes.DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID",
            where + where2, " ORDER BY K.OZEL_MUSTERI DESC, G.ONCELIK, G.TGID, K.TRANSFER, " + SanalTerminal.GetBiletSiralamaTipi(), //"K.BILET_NO", 
            strBlColumns.ToString())["DataTable"];

            if (dtBiletler.Rows.Count > 0)
            {
                data = dtBiletler.AsEnumerable().FirstOrDefault();
                KuyrukSira.Cagrilan = 0;
                KuyrukSira.GrupId = 0;
                return data;
            }
            #endregion

            if (KuyrukSira.CagrilanGrupTipi == "2") // transfer
            {
                where2 = " AND K.TRANSFER = 1 ";
            }
            else
            {
                where2 = "";
            }

            //grup belli, ilk bileti bulalým
            strBlColumns = new StringBuilder();
            strBlColumns.Append("K.BID, K.GRPID, K.BILET_NO, K.TRANSFER, K.OZEL_MUSTERI, G.GRPID AS TGRPID, G.TID, ");
            strBlColumns.Append("G.CAGRI_ORAN, G.TRANSFER_ORAN, G.YARDIM_GRUBU, G.CAGRILAN, G.TRANSFER_CAGRILAN ");

            dtBiletler = (DataTable)Library.Classes.DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID",
            where + where2, " ORDER BY K.OZEL_MUSTERI DESC, G.ONCELIK, G.TGID, K.TRANSFER, " + SanalTerminal.GetBiletSiralamaTipi(), //"K.BILET_NO", 
            strBlColumns.ToString())["DataTable"];

            KuyrukSira.Transfer = Transfer;


            if (dtBiletler != null)
            {
                data = dtBiletler.AsEnumerable().FirstOrDefault();
                //return data;
            }
            else
            {
                data = null;
            }

            return data;
        }

        //private void DetectAndSendNextTicket()
        //{
        //    if (KuyruktakiBiletler.Rows.Count > 0)
        //    {
        //        KuyruktakiFiktifBiletler = HasFiktifTicket();
        //        if (KuyruktakiFiktifBiletler.Rows.Count > 0)
        //        {
        //            BiletID = int.Parse(KuyruktakiFiktifBiletler.Rows[0]["BID"].ToString());
        //            GrupID = int.Parse(KuyruktakiFiktifBiletler.Rows[0]["GRPID"].ToString());
        //            BiletNo = int.Parse(KuyruktakiFiktifBiletler.Rows[0]["BILET_NO"].ToString());
        //            Transfer = bool.Parse(KuyruktakiFiktifBiletler.Rows[0]["TRANSFER"].ToString());
        //            Fiktif = true;
        //            KillTicket();
        //            CallTicket(); return;
        //        }

        //        AktifCagrilanGruptakiTransferBiletler = GetOnProcessTransferGroupsTickets();
        //        if (AktifCagrilanGruptakiTransferBiletler.Rows.Count > 0)
        //        {
        //            BiletID = int.Parse(AktifCagrilanGruptakiTransferBiletler.Rows[0]["BID"].ToString());
        //            GrupID = int.Parse(AktifCagrilanGruptakiTransferBiletler.Rows[0]["GRPID"].ToString());
        //            BiletNo = int.Parse(AktifCagrilanGruptakiTransferBiletler.Rows[0]["BILET_NO"].ToString());
        //            Transfer = bool.Parse(AktifCagrilanGruptakiTransferBiletler.Rows[0]["TRANSFER"].ToString());
        //            Fiktif = bool.Parse(AktifCagrilanGruptakiTransferBiletler.Rows[0]["OZEL_MUSTERI"].ToString());
        //            KillTicket();
        //            CallTicket(); return;
        //        }

        //        AktifCagrilanGruptakiBiletler = GetOnProcessGroupsTickets();
        //        if (AktifCagrilanGruptakiBiletler.Rows.Count > 0)
        //        {
        //            BiletID = int.Parse(AktifCagrilanGruptakiBiletler.Rows[0]["BID"].ToString());
        //            GrupID = int.Parse(AktifCagrilanGruptakiBiletler.Rows[0]["GRPID"].ToString());
        //            BiletNo = int.Parse(AktifCagrilanGruptakiBiletler.Rows[0]["BILET_NO"].ToString());
        //            Transfer = bool.Parse(AktifCagrilanGruptakiBiletler.Rows[0]["TRANSFER"].ToString());
        //            Fiktif = bool.Parse(AktifCagrilanGruptakiBiletler.Rows[0]["OZEL_MUSTERI"].ToString());
        //            KillTicket();
        //            CallTicket(); return;
        //        }

        //        KuyruktakiTransferBiletler = GetTransferTickets();
        //        if (KuyruktakiTransferBiletler.Rows.Count > 0)
        //        {
        //            BiletID = int.Parse(KuyruktakiTransferBiletler.Rows[0]["BID"].ToString());
        //            GrupID = int.Parse(KuyruktakiTransferBiletler.Rows[0]["GRPID"].ToString());
        //            BiletNo = int.Parse(KuyruktakiTransferBiletler.Rows[0]["BILET_NO"].ToString());
        //            Transfer = bool.Parse(KuyruktakiTransferBiletler.Rows[0]["TRANSFER"].ToString());
        //            Fiktif = bool.Parse(KuyruktakiTransferBiletler.Rows[0]["OZEL_MUSTERI"].ToString());
        //            KillTicket();
        //            CallTicket(); return;
        //        }

        //        TerminalinAnaGrubundakiBiletler = GetMainGroupsTickets();
        //        if (TerminalinAnaGrubundakiBiletler.Rows.Count > 0)
        //        {
        //            BiletID = int.Parse(TerminalinAnaGrubundakiBiletler.Rows[0]["BID"].ToString());
        //            GrupID = int.Parse(TerminalinAnaGrubundakiBiletler.Rows[0]["GRPID"].ToString());
        //            BiletNo = int.Parse(TerminalinAnaGrubundakiBiletler.Rows[0]["BILET_NO"].ToString());
        //            Transfer = bool.Parse(TerminalinAnaGrubundakiBiletler.Rows[0]["TRANSFER"].ToString());
        //            Fiktif = bool.Parse(TerminalinAnaGrubundakiBiletler.Rows[0]["OZEL_MUSTERI"].ToString());
        //            KillTicket();
        //            CallTicket(); return;
        //        }

        //        TerminalinYardimEdecegiGruptakiBiletler = GetAssistGroupsTickets();
        //        if (TerminalinYardimEdecegiGruptakiBiletler.Rows.Count > 0)
        //        {
        //            BiletID = int.Parse(TerminalinYardimEdecegiGruptakiBiletler.Rows[0]["BID"].ToString());
        //            GrupID = int.Parse(TerminalinYardimEdecegiGruptakiBiletler.Rows[0]["GRPID"].ToString());
        //            BiletNo = int.Parse(TerminalinYardimEdecegiGruptakiBiletler.Rows[0]["BILET_NO"].ToString());
        //            Transfer = bool.Parse(TerminalinYardimEdecegiGruptakiBiletler.Rows[0]["TRANSFER"].ToString());
        //            Fiktif = bool.Parse(TerminalinYardimEdecegiGruptakiBiletler.Rows[0]["OZEL_MUSTERI"].ToString());
        //            YardimGrubundan = true; KillTicket();
        //            CallTicket(); return;
        //        }
        //    }
        //    else
        //    {
        //        Program.Communice.NotExistWaitingResponse(this.ElTerminalID.ToString());

        //        terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

        //        this.KillTicket();

        //        terminal.SetActiveTicketID(0);
        //    }
        //}

        public void KillTicket()
        {
            Bilet lastTicket = new Bilet();
            lastTicket.IslemBitisSaati = DateTime.Now;
            lastTicket.SetTicketStateToDone(terminal.AktifBiletID);
        }

        private void CallTicket()
        {
            Program.Communice.SendTicketNumber(ElTerminalID.ToString(),
                BiletNo.ToString()
                );

            QLUClientCommunicating.SendTicketInfToLCD(ElTerminalID, BiletNo.ToString());

            PopQueue();
            bilet = new Bilet();
            bilet.TerminalID = terminal.TID;
            bilet.IslemBaslangicSaati = DateTime.Now;

            if ((bilet.SetTicketOnProcess(BiletID.ToString())).ContainsKey("Error"))
            {
            }

            terminal.SetActiveTicketID(BiletID);
            terminal.SetTerminalState(Terminaller.TerminalDurum.MusteriIleMesgul);


            if (!Transfer)
            {
                terminal.ToIncreaseOrResetCallRatio(terminal.TID, GrupID);
            }
            else
            {
                terminal.ToIncreaseOrResetTransferRatio(terminal.TID, GrupID);
            }

            if (!YardimGrubundan)
            {
                terminal.SetLastCallingGroup(terminal.TID, GrupID, Transfer);
            }
        }

        public void PopQueue()
        {
            //örnek týp merkezi
            this.Delete("BID=" + BiletID, terminal.TID);
        }
        #endregion
    }
}
