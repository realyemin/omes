using System;
using System.Data;
using System.Linq;
using System.Text;
using QVU.Classes.DBLayer;

namespace QVU.Classes.QueueLayer
{
    public partial class Kuyruk
    {
        #region Logical Methods

        private DataTable GetRealetedGroupsOfTerminal()
        {
            var strBlColumns = new StringBuilder();
            strBlColumns.Append("K.BID, K.GRPID, K.BILET_NO, K.TRANSFER, K.OZEL_MUSTERI, G.GRPID AS TGRPID, G.TID, ");
            strBlColumns.Append("G.CAGRI_ORAN, G.TRANSFER_ORAN, G.YARDIM_GRUBU, G.CAGRILAN, G.TRANSFER_CAGRILAN, G.AYRICALIKLI, T.CagriSiralamaTipi");


            //burada da çağrılanlar tablosunda olmayanaları listele not exists olacak yani.
            var dtGroups = (DataTable)Library.Classes.DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID INNER JOIN TERMINALLER T ON G.TID = T.TID ",
            "WHERE G.TID =" + terminal.TID 
            + " AND NOT EXISTS (SELECT BID FROM HAVUZ WHERE TID=G.TID AND BID=K.BID)", //örnek tıp merkezi için eklendi.
            "ORDER BY G.AYRICALIKLI DESC, K.OZEL_MUSTERI DESC, G.YARDIM_GRUBU, ONCELIK, G.TGID, K.TRANSFER, " + SanalTerminal.GetBiletSiralamaTipi(), //"K.BILET_NO", 
            strBlColumns.ToString())["DataTable"];

            return dtGroups;
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
            //ysadece yardım gruplarından kalmışsa
            if (!kuyrukList.Where(x => x.Field<bool>("YARDIM_GRUBU") == false).Any() && kuyrukList.Where(x => x.Field<bool>("YARDIM_GRUBU") == true).Any()) //normal bilet kalmadıysa
            {
                return data;
            }

            if (kuyrukList.FirstOrDefault()["CagriSiralamaTipi"].ToString() == "2")
            {
                return data;
            }

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
            else if (KuyrukSira.Cagrilan >= KuyrukSira.Cagrilacak) //çağrılacak sayısı tamam ise grup değiştir
            #region çağrılan, çağrılacak kadar oluysa
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
            where += " AND NOT EXISTS (SELECT BID FROM HAVUZ WHERE TID=G.TID AND BID=K.BID)"; //örnek tıp merkezi için eklendi.
            string where2 = "";

            //AYRICALIKLI VAR MI, varsa onu gönder yoksa devam et
            #region ayrıcalıklı
            where2 = " AND G.AYRICALIKLI = 1 ";

            //grup belli, ilk bileti bulalım
            var strBlColumns = new StringBuilder();
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

            //FİKTİF VAR MI, varsa onu gönder yoksa devam et
            #region fiktif
            where = "WHERE G.TID =" + terminal.TID + " AND G.GRPID = " + KuyrukSira.GrupId.ToString();
            where += " AND NOT EXISTS (SELECT BID FROM HAVUZ WHERE TID=G.TID AND BID=K.BID)"; //örnek tıp merkezi için eklendi.
            where2 = " AND K.OZEL_MUSTERI = 1 ";

            //grup belli, ilk bileti bulalım
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

            //grup belli, ilk bileti bulalım
            strBlColumns = new StringBuilder();
            strBlColumns.Append("K.BID, K.GRPID, K.BILET_NO, K.TRANSFER, K.OZEL_MUSTERI, G.GRPID AS TGRPID, G.TID, ");
            strBlColumns.Append("G.CAGRI_ORAN, G.TRANSFER_ORAN, G.YARDIM_GRUBU, G.CAGRILAN, G.TRANSFER_CAGRILAN ");

            dtBiletler = (DataTable)Library.Classes.DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID",
            where + where2, " ORDER BY K.OZEL_MUSTERI DESC, G.ONCELIK, G.TGID, K.TRANSFER, " + SanalTerminal.GetBiletSiralamaTipi(), //"K.BILET_NO", 
            strBlColumns.ToString())["DataTable"];

            KuyrukSira.Transfer = Transfer;

            data = dtBiletler.AsEnumerable().FirstOrDefault();
            //if (data != null)
            //{
            //    return data;
            //}
            //DetectTicketNumber();

            return data;
        }

        //private DataRow GetOnProcessGroupsTickets()
        //{
        //    return KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("YARDIM_GRUBU") == false && x.Field<short>("CAGRILAN") > 0);
        //}

        //private DataRow GetOnProcessTransferGroupsTickets()
        //{
        //    return KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("YARDIM_GRUBU") == false && x.Field<short>("TRANSFER_CAGRILAN") > 0);
        //}

        //private DataRow HasFiktifTicket()
        //{
        //    return KuyruktakiBiletler.AsEnumerable().Where(x => x.Field<bool>("OZEL_MUSTERI")).OrderBy(x => x.Field<bool>("YARDIM_GRUBU")).FirstOrDefault();
        //}

        //private DataRow GetMainGroupsTickets()
        //{
        //    return KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("YARDIM_GRUBU") == false && x.Field<bool>("TRANSFER") == false && x.Field<int>("GRPID") != terminal.SonCagrilanGrup)
        //        ?? KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("YARDIM_GRUBU") == false && x.Field<bool>("TRANSFER") == false);
        //}

        //private DataRow GetAssistGroupsTickets()
        //{
        //    return KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("YARDIM_GRUBU"));
        //}

        //private DataRow GetTransferTickets()
        //{
        //    return KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("TRANSFER") && x.Field<bool>("YARDIM_GRUBU") == false && x.Field<int>("GRPID") != terminal.SonCagrilanGrup)
        //        ?? KuyruktakiBiletler.AsEnumerable().FirstOrDefault(x => x.Field<bool>("TRANSFER") && x.Field<bool>("YARDIM_GRUBU") == false);
        //}

        #endregion
    }
}
