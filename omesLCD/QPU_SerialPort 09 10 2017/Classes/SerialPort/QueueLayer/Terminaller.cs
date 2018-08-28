using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using ComCommunication;
using System.Collections;
using QPU_SerialPort.Library.Classes;

namespace QPU_SerialPort.Classes.QueueLayer
{
    public partial class Terminaller
    {
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

            if (hshUpdateStateData.ContainsKey("Error"))
            {
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

        #endregion
    }
}
