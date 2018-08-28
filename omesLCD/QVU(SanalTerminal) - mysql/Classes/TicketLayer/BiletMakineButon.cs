using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Collections;
using QVU.Library.Classes;

namespace QVU.Classes.TicketLayer {
                        public partial class BiletMakineButon {
        #region Members/Propertieses
                                public bool MaxBileteUlasildimi { get; set; }

                                        public enum ButtonType {
                                                MainButton,
                                                SubButton,
                                                All
                    }
        #endregion
        
        
        
        #region Methods
        #region Logical Process and Methods
                                                private bool CheckMaxTicketLimit() {
            string dtTodayTicket = DateTime.Now.ToShortDateString();
            dtTodayTicket = DateTime.Parse(dtTodayTicket).ToString("MM.dd.yyyy");
            string dtTodayTicketStart = string.Format("{0} 00:00:00", dtTodayTicket);
            string dtTodayTicketFinish = string.Format("{0} 23:59:59", dtTodayTicket);

            string strWhereSQL = string.Format(
                "Where (BTNID={0}) AND (SIS_TAR BETWEEN '{1}' AND '{2}')",
                ButonID,
                dtTodayTicketStart,
                dtTodayTicketFinish
                );

                        DataTable dtTodayTicketCount = (DataTable)DBProcess.SimpleQuery(
                "BILETLER",
                strWhereSQL,
                "",
                "COUNT(BID)"
                )["DataTable"];

            if (dtTodayTicketCount != null && dtTodayTicketCount.Rows.Count > 0) {                 if (int.Parse(dtTodayTicketCount.Rows[0][0].ToString()) < this.MaximumBiletSayisi) {
                                        return false;
                }
                else {
                                        return true;
                }
            }
            else {
                                return true;
            }
        }
        #endregion
        #endregion
    }
}
