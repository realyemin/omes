
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net;
using System.Collections;
using QPU_TCPIP.Library.Classes;
using System.Data;

namespace QPU_TCPIP.Classes.TCPIP.SocketCommunicateLayer.QLUComm
{
    public class LCDClient
    {
        #region Members/Propertieses
        public int ATID { get; set; }
        public int Port { get; set; }
        public IPAddress IPAdres { get; set; }
        public Hashtable VezneNoYonOku { get; set; }
        public bool IsRegistrable { get; set; }
        #endregion


        #region Fields
        public string FailedMessage { get; set; }
        #endregion


        #region Ctors
        public LCDClient(int _AnaTabloID, string _ipAdres, int _port)
        {
            this.ATID = _AnaTabloID;
            this.Port = _port;
            this.IPAdres = IPAddress.Parse(_ipAdres);
            this.VezneNoYonOku = this.GetTerminalAndArrows();
            if (VezneNoYonOku.Count == 0)
            {
                this.IsRegistrable = false;
            }
            else
            {
                this.IsRegistrable = true;
            }
        }

        public LCDClient()
        {
            this.ATID = 1;
            this.IPAdres = IPAddress.Parse("192.168.0.98");
            this.Port = 506;
            this.VezneNoYonOku = new Hashtable();
        }
        #endregion


        #region Methods
        private Hashtable GetTerminalAndArrows()
        {
            Hashtable rv_TermAndArrows = new Hashtable();
            Hashtable hshResult;
            DataTable dtTermAndArrows = new DataTable();


            hshResult = DBProcess.SimpleQuery(
                "ANATABLO_YON INNER JOIN TERMINALLER ON ANATABLO_YON.TID = TERMINALLER.TID",
                "WHERE ANATABLO_YON.ATID = " + this.ATID,
                "",
                "TERMINALLER.ELTID, ANATABLO_YON.YON"
                );

            if (hshResult.ContainsKey("Error"))
            {
                FailedMessage = hshResult["Error"].ToString();
            }
            else if (hshResult.ContainsKey("DataTable"))
            {
                dtTermAndArrows = (DataTable)hshResult["DataTable"];

                for (int i = 0; i < dtTermAndArrows.Rows.Count; i++)
                {
                    rv_TermAndArrows.Add(
                        dtTermAndArrows.Rows[i]["ELTID"],
                        dtTermAndArrows.Rows[i]["YON"]
                        );
                }

                if (dtTermAndArrows.Rows.Count <= 0)
                {
                    this.FailedMessage = "Anatablo kaydı veritabanında mevcut değil!";
                }
            }

            return rv_TermAndArrows;
        }
        #endregion
    }

}
