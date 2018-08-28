using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Collections;
using QVU.Library.Classes;
using QVU.Classes.QueueLayer.EventArgsClasses;

namespace QVU.Classes.QueueLayer
{
    public partial class Terminaller
    {
        #region Members/Propertieses

        #endregion

        #region Delegates and events definitons

        public delegate void StatementsChangedEventHandler(StatementsChangedEventArgs args);

        public event StatementsChangedEventHandler StatementChanged;

        #endregion


        #region Methods

        public void ToIncreaseOrResetCallRatio(int TermID, int GrpID)
        {
            string strWhereSQL = string.Format("Where TID={0} AND GRPID={1}", TermID, GrpID);
            int cagriOran = 0, cagrilan = 0;
            Hashtable hshIncrease;
            DataTable dtCallRatio = (DataTable) DBProcess.SimpleQuery(
                "TERMINAL_GRUP",
                strWhereSQL,
                "",
                "CAGRI_ORAN, CAGRILAN"
                )["DataTable"];
            cagriOran = int.Parse(dtCallRatio.Rows[0]["CAGRI_ORAN"].ToString());
            cagrilan = int.Parse(dtCallRatio.Rows[0]["CAGRILAN"].ToString());

            hshIncrease = new Hashtable();

            if (cagriOran > cagrilan + 1)
            {
                hshIncrease.Add("CAGRILAN", cagrilan + 1);
            }
            else
            {
                hshIncrease.Add("CAGRILAN", 0);
            }
            DBProcess.UpdateData("TERMINAL_GRUP", "Where TID=" + TermID + " AND GRPID=" + GrpID, hshIncrease);
        }

        public void ToIncreaseOrResetTransferRatio(int TermID, int GrpID)
        {
            string strWhereSQL = string.Format("Where TID={0} AND GRPID={1}", TermID, GrpID);
            int transferCagriOran = 0, transferCagrilan = 0;
            Hashtable hshIncrease;
            DataTable dtCallRatio = (DataTable) DBProcess.SimpleQuery(
                "TERMINAL_GRUP",
                strWhereSQL,
                "",
                "TRANSFER_ORAN, TRANSFER_CAGRILAN"
                )["DataTable"];
            transferCagriOran = int.Parse(dtCallRatio.Rows[0]["TRANSFER_ORAN"].ToString());
            transferCagrilan = int.Parse(dtCallRatio.Rows[0]["TRANSFER_CAGRILAN"].ToString());

            hshIncrease = new Hashtable();

            if (transferCagriOran > transferCagrilan + 1)
            {
                hshIncrease.Add("TRANSFER_CAGRILAN", transferCagrilan + 1);
            }
            else
            {
                hshIncrease.Add("TRANSFER_CAGRILAN", 0);
            }
            DBProcess.UpdateData("TERMINAL_GRUP", "Where TID=" + TermID + " AND GRPID=" + GrpID, hshIncrease);
        }

        public void ResetCallAndTransferRatio(int _TermID)
        {
            Hashtable hshReset = new Hashtable();
            hshReset.Add("CAGRILAN", 0);
            hshReset.Add("TRANSFER_CAGRILAN", 0);

            DBProcess.UpdateData("TERMINAL_GRUP", "Where TID=" + _TermID, hshReset);
        }

        public void SetLastCallingGroup(int TermID, int GrpID, bool TicketType)
        {
            Hashtable hshUpdate = new Hashtable();
            hshUpdate.Add("SON_CAGRILAN_GRUP", GrpID);
            hshUpdate.Add("SON_CAGRILAN_TUR", TicketType);

            DBProcess.UpdateData("TERMINALLER", "Where TID=" + TermID, hshUpdate);
        }

        public void SetTerminalState(TerminalDurum termState)
        {
            Hashtable hshUpdateStateData = new Hashtable();
            hshUpdateStateData.Add("DURUM", (int) termState);

            Hashtable hshUpdateStateResult = DBProcess.UpdateData(
                "TERMINALLER",
                "Where TID=" + TID,
                hshUpdateStateData
                );

            if (!hshUpdateStateData.ContainsKey("Error"))
            {
                if (StatementChanged != null)
                {
                    StatementChanged(new StatementsChangedEventArgs(termState));
                }
            }
        }

        public void SetActiveTicketID(int _BiletID)
        {
            this.AktifBiletID = _BiletID;
            Hashtable hshUpdateActiveTicket = new Hashtable();
            hshUpdateActiveTicket.Add("AKTIF_BID", this.AktifBiletID);

            DBProcess.UpdateData(
                "TERMINALLER",
                "Where TID=" + this.TID,
                hshUpdateActiveTicket
                );
        }

        public void RefreshTicketInf()
        {
            DataTable dtTerminal = Get(
                "TID=" + this.TID,
                "AKTIF_BID, SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR"
                );

            if (dtTerminal.Rows.Count > 0)
            {
                DataRow drTerminal = dtTerminal.Rows[0];
                AktifBiletID = int.Parse(drTerminal["AKTIF_BID"].ToString());
                SonCagrilanGrup = int.Parse(drTerminal["SON_CAGRILAN_GRUP"].ToString());
                SonCagrilanTur = bool.Parse(drTerminal["SON_CAGRILAN_TUR"].ToString());
            }
        }

        public TerminalDurum GetTerminalState()
        {
            DataTable dtTermStateResult = this.Get("TID = " + this.TID, "DURUM");
            TerminalDurum termState = 0;

            if (dtTermStateResult != null && dtTermStateResult.Rows.Count > 0)
            {
                termState = (TerminalDurum) int.Parse(dtTermStateResult.Rows[0][0].ToString());
            }

            return termState;
        }

        public int GetCalledTicketCount()
        {
            int rv_CalledTicketCount = 0;

            Hashtable hshCalledTicketResult;
            DataTable dtCalledTicketCount;

            string vs_WhereSQL = string.Empty;
            vs_WhereSQL = string.Format(
                "Where (TERMINAL_GRUP.TID = {0}) AND (BILETLER.SIS_TAR BETWEEN CONCAT(TIMESTAMPADD(dd, 0, TIMESTAMPDIFF(dd, 0, NOW())) , '00:00') AND CONCAT(TIMESTAMPADD(dd, 0, TIMESTAMPDIFF(dd, 0,  NOW())) , '23:59'))",
               // "Where (TERMINAL_GRUP.TID = {0}) AND (BILETLER.SIS_TAR BETWEEN DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00' AND DATEADD(dd, 0, DATEDIFF(dd, 0,  GETDATE())) + '23:59')",
                this.TID);

            hshCalledTicketResult = DBProcess.SimpleQuery(
                "TERMINAL_GRUP RIGHT OUTER JOIN BILETLER ON TERMINAL_GRUP.TID = BILETLER.TID",
                vs_WhereSQL,
                "",
                "COUNT(BILETLER.BID) AS [CalledTicketCount]"
                );

            if (!hshCalledTicketResult.ContainsKey("Error"))
            {
                dtCalledTicketCount = (DataTable) hshCalledTicketResult["DataTable"];

                rv_CalledTicketCount = Convert.ToInt32(dtCalledTicketCount.Rows[0]["CalledTicketCount"]);
            }

            return rv_CalledTicketCount;
        }

        public static DataTable LoadToControl()
        {
            DataTable dtData = (DataTable)DBProcess.SimpleQuery("TERMINALLER",
                "Where SIL='False'",
                "ORDER BY TID DESC",
                "TID, TERMINAL_AD")["DataTable"];


            return dtData;
        }

        #endregion
    }
}
