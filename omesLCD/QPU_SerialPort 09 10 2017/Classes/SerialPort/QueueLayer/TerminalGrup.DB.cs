using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Collections;
using QPU_SerialPort.Library.Classes;

namespace QPU_SerialPort.Classes.QueueLayer {
                public partial class TerminalGrup {
        #region Members/Propertieses
                                public int TGID { get; set; }
                                public int TerminalID { get; set; }
                                public int GrupID { get; set; }
                                public int CagriOran { get; set; }
                                public int TransferOran { get; set; }
                                                        public bool YardimGrubu { get; set; }
        #endregion

        
        #region Methods
        #region Constructer Methods
        public TerminalGrup() { }

                                                public TerminalGrup(string _TGID) {
            DataTable dtConstructer = Get("TGID=" + _TGID, "*");

            if (dtConstructer.Rows.Count > 0) {
                DataRow drConstructer = dtConstructer.Rows[0];
                TGID = int.Parse(drConstructer["TGID"].ToString());
                TerminalID = int.Parse(drConstructer["TID"].ToString());
                GrupID = int.Parse(drConstructer["GRPID"].ToString());
                CagriOran = int.Parse(drConstructer["CAGRI_ORAN"].ToString());
                TransferOran = int.Parse(drConstructer["TRANSFER_ORAN"].ToString());
                YardimGrubu = bool.Parse(drConstructer["YARDIM_GRUBU"].ToString());
            }
        }
        #endregion


        #region CRUD Process Methods
                                                                public DataTable Get(string Where, string Columns) {
            DataTable dtGetData = (DataTable)DBProcess.SimpleQuery(
                "TERMINAL_GRUP",
                "Where " + Where,
                "",
                Columns)["DataTable"];

            return dtGetData;
        }

                                                                        public DataTable Get(string Where, string Columns, string OrderBy) {
            DataTable dtGetData = (DataTable)DBProcess.SimpleQuery(
                "TERMINAL_GRUP",
                "Where " + Where,
                OrderBy,
                Columns)["DataTable"];

            return dtGetData;
        }
        #endregion
        #endregion
    }
}
