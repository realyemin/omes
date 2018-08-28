using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_SerialPort.Library.Classes;
using QPU_TCPIP.Library.Classes;

namespace QPU_SerialPort.Classes.QueueLayer
{
    public partial class Kuyruk
    {
        #region Logical Methods

        //private DataTable GetRealetedGroupsOfTerminal()
        //{
        //    StringBuilder strBlColumns = new StringBuilder();
        //    strBlColumns.Append("KUYRUK.BID, KUYRUK.GRPID, KUYRUK.BILET_NO, KUYRUK.TRANSFER, KUYRUK.OZEL_MUSTERI, ");
        //    strBlColumns.Append("TERMINAL_GRUP.GRPID AS TGRPID, TERMINAL_GRUP.TID, TERMINAL_GRUP.CAGRI_ORAN, ");
        //    strBlColumns.Append("TERMINAL_GRUP.TRANSFER_ORAN, TERMINAL_GRUP.YARDIM_GRUBU, TERMINAL_GRUP.CAGRILAN, ");
        //    strBlColumns.Append("TERMINAL_GRUP.TRANSFER_CAGRILAN");
        //    DataTable dtGroups = (DataTable) DBProcess.SimpleQuery(
        //        "KUYRUK INNER JOIN TERMINAL_GRUP ON KUYRUK.GRPID = TERMINAL_GRUP.GRPID",
        //        "WHERE (TERMINAL_GRUP.TID =" + terminal.TID + ")",
        //        "ORDER BY TERMINAL_GRUP.ONCELIK, KUYRUK.TRANSFER DESC, KUYRUK.BID",
        //        strBlColumns.ToString()
        //        )["DataTable"];

        //    return dtGroups;
        //}

        private DataTable GetRealetedGroupsOfTerminal()
        {
            var strBlColumns = new StringBuilder();
            strBlColumns.Append("K.BID, K.GRPID, K.BILET_NO, K.TRANSFER, K.OZEL_MUSTERI, G.GRPID AS TGRPID, G.TID, ");
            strBlColumns.Append("G.CAGRI_ORAN, G.TRANSFER_ORAN, G.YARDIM_GRUBU, G.CAGRILAN, G.TRANSFER_CAGRILAN, G.AYRICALIKLI, T.CagriSiralamaTipi");

            var dtGroups = (DataTable)Library.Classes.DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID INNER JOIN TERMINALLER T ON G.TID = T.TID ",
            "WHERE (K.I_yf3 = 0 or K.I_yf3 is null) AND G.TID =" + terminal.TID
            + " AND NOT EXISTS (SELECT BID FROM HAVUZ WHERE TID=G.TID AND BID=K.BID)", //örnek týp merkezi için eklendi.
            "ORDER BY G.AYRICALIKLI DESC, K.OZEL_MUSTERI DESC, G.YARDIM_GRUBU, ONCELIK, G.TGID, K.TRANSFER, " + SanalTerminal.GetBiletSiralamaTipi(), //"K.BILET_NO", 
            strBlColumns.ToString())["DataTable"];

            return dtGroups;
        }

        private DataTable GetOnProcessGroupsTickets()
        {
            DataTable dtOnProcessGroups = new DataTable();
            dtOnProcessGroups = KuyruktakiBiletler.Clone();

            var onProcessGroupsTicket = from onProcess in KuyruktakiBiletler.AsEnumerable()
                where onProcess.Field<bool>("YARDIM_GRUBU") == false
                      && onProcess.Field<short>("CAGRILAN") > 0
                select onProcess;

            if (onProcessGroupsTicket.Count<DataRow>() > 0)
            {
                dtOnProcessGroups = onProcessGroupsTicket.CopyToDataTable<DataRow>();
            }
            return dtOnProcessGroups;
        }

        private DataTable GetOnProcessTransferGroupsTickets()
        {
            DataTable dtOnProcessTransferGroups = new DataTable();
            dtOnProcessTransferGroups = KuyruktakiBiletler.Clone();

            var onProcessTransferGroupsTicket = from onProcessTransfer in KuyruktakiBiletler.AsEnumerable()
                where onProcessTransfer.Field<bool>("YARDIM_GRUBU") == false
                      && onProcessTransfer.Field<short>("TRANSFER_CAGRILAN") > 0
                select onProcessTransfer;



            if (onProcessTransferGroupsTicket.Count<DataRow>() > 0)
            {
                dtOnProcessTransferGroups = onProcessTransferGroupsTicket.CopyToDataTable<DataRow>();
            }
            return dtOnProcessTransferGroups;
        }

        private DataTable HasFiktifTicket()
        {
            DataTable dtFiktif = new DataTable();
            dtFiktif = KuyruktakiBiletler.Clone();
            var fiktifTicket = from fiktif in KuyruktakiBiletler.AsEnumerable()
                where fiktif.Field<bool>("OZEL_MUSTERI") == true
                orderby fiktif.Field<bool>("YARDIM_GRUBU") ascending
                select fiktif;

            if (fiktifTicket.Count<DataRow>() > 0)
            {
                dtFiktif = fiktifTicket.CopyToDataTable<DataRow>();
            }

            return dtFiktif;
        }

        private DataTable GetMainGroupsTickets()
        {
            DataTable dtMainGroups = new DataTable();
            dtMainGroups = KuyruktakiBiletler.Clone();

            var mainGroupsTickets = from mainGroups in KuyruktakiBiletler.AsEnumerable()
                where mainGroups.Field<bool>("YARDIM_GRUBU") == false
                      && mainGroups.Field<int>("GRPID") != terminal.SonCagrilanGrup
                select mainGroups;

            if (mainGroupsTickets.Count<DataRow>() > 0)
            {
                dtMainGroups = mainGroupsTickets.CopyToDataTable<DataRow>();
            }
            else
            {
                var mainGroupsTicketRetry = from mainGroups in KuyruktakiBiletler.AsEnumerable()
                    where mainGroups.Field<bool>("YARDIM_GRUBU") == false
                    select mainGroups;
                if (mainGroupsTicketRetry.Count<DataRow>() > 0)
                {
                    dtMainGroups = mainGroupsTicketRetry.CopyToDataTable<DataRow>();
                }
            }

            return dtMainGroups;
        }

        private DataTable GetAssistGroupsTickets()
        {
            DataTable dtAssistGroups = new DataTable();
            dtAssistGroups = KuyruktakiBiletler.Clone();

            var AssistGroupsTickets = from assistGroups in KuyruktakiBiletler.AsEnumerable()
                where assistGroups.Field<bool>("YARDIM_GRUBU") == true
                select assistGroups;

            if (AssistGroupsTickets.Count<DataRow>() > 0)
            {
                dtAssistGroups = AssistGroupsTickets.CopyToDataTable<DataRow>();
            }

            return dtAssistGroups;
        }

        private DataTable GetTransferTickets()
        {
            DataTable dtTransferTickets = new DataTable();
            dtTransferTickets = KuyruktakiBiletler.Clone();

            var transferTickets = from transfer in KuyruktakiBiletler.AsEnumerable()
                where transfer.Field<bool>("TRANSFER") == true
                      && transfer.Field<bool>("YARDIM_GRUBU") == false
                      && transfer.Field<int>("GRPID") != terminal.SonCagrilanGrup
                select transfer;

            if (transferTickets.Count<DataRow>() > 0)
            {
                dtTransferTickets = transferTickets.CopyToDataTable<DataRow>();
            }
            else
            {
                var transferTicketRetry = from transfer in KuyruktakiBiletler.AsEnumerable()
                    where transfer.Field<bool>("TRANSFER") == true
                          && transfer.Field<bool>("YARDIM_GRUBU") == false
                    select transfer;
                if (transferTicketRetry.Count<DataRow>() > 0)
                {
                    dtTransferTickets = transferTicketRetry.CopyToDataTable<DataRow>();
                }
            }
            return dtTransferTickets;
        }



        private DataTable GetAssistGroupsAndCount()
        {
            string strWhereSQL = string.Format(
                "WHERE (TERMINAL_GRUP.TID ={0}) {1}",
                terminal.TID,
                " AND (TERMINAL_GRUP.YARDIM_GRUBU = 'True') GROUP BY KUYRUK.GRPID"
                );
            DataTable dtGroupsAndCount = (DataTable)QPU_TCPIP.Library.Classes.DBProcess.SimpleQuery(
                "KUYRUK INNER JOIN TERMINAL_GRUP ON KUYRUK.GRPID = TERMINAL_GRUP.GRPID",
                strWhereSQL,
                "ORDER BY grpCount DESC",
                "COUNT(KUYRUK.GRPID) AS grpCount, KUYRUK.GRPID"
                )["DataTable"];

            return dtGroupsAndCount;
        }



        #endregion
    }
}
