using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Collections;
using System.Data;

namespace QPU_TCPIP.Library.Classes
{
    public static class SanalTerminal
    {
        public static int PersonelID { get; set; }
        public static int TerminalID { get; set; }
        public static string PersonelAd { get; set; }
        public static string PersonelSoyad { get; set; }
        public static bool OtomatikCagri { get; set; }
        public static int OtomatikCagriSuresi { get; set; }
        public static string TerminalAdi { get; set; }
        public static bool DoubleClick { get; set; }

        public static int GetOtoCagriSuresi()
        {
            Hashtable hshOtoCagri = DBProcess.SimpleQuery(
                "TERMINALLER",
                "WHERE TID = " + TerminalID,
                "",
                "OTO_SURE"
                );

            if (!hshOtoCagri.ContainsKey("Error"))
            {
                DataTable dtOtoSure = (DataTable) hshOtoCagri["DataTable"];
                if (dtOtoSure == null || dtOtoSure.Rows.Count < 0)
                {
                    return 0;
                }
                DateTime dtTimeOtoSure = DateTime.Parse(dtOtoSure.Rows[0][0].ToString());
                TimeSpan tsOtoCagriSuresi = new TimeSpan(dtTimeOtoSure.Hour, dtTimeOtoSure.Minute, dtTimeOtoSure.Second);
                return Convert.ToInt32(tsOtoCagriSuresi.TotalMilliseconds);

            }
            else
            {
                return 0;
            }
        }

        public static string GetBiletSiralamaTipi()
        {
            string alanAdi = "BID";
            Hashtable hshBiletSiralama = DBProcess.SimpleQuery(
                "TERMINALLER",
                "WHERE TID = " + TerminalID,
                "",
                "SiralamaTipi" //BiletSiralama yoktu ben SiralamaTipi olarak deðiþtirdim (ek)
                );
             
            if (!hshBiletSiralama.ContainsKey("Error"))
            {
                DataTable dtBiletSiralama = (DataTable)hshBiletSiralama["DataTable"];
                if (dtBiletSiralama == null || dtBiletSiralama.Rows.Count < 0)
                {
                    return alanAdi;
                }

                string tip = dtBiletSiralama.Rows[0][0].ToString();
                switch (tip)
                {
                    case "1":
                        alanAdi = "BID";
                        break;
                    case "2":
                        alanAdi = "BILET_NO";
                        break;
                }
                return alanAdi;
            }
            else
            {
                return alanAdi;
            }
        }

        public static bool GetOtoCagriAktif()
        {
            Hashtable hshOtoCagri = DBProcess.SimpleQuery(
                "TERMINALLER",
                "WHERE TID = " + TerminalID,
                "",
                "OTO_CAGRI"
                );

            if (!hshOtoCagri.ContainsKey("Error"))
            {
                DataTable dtOtoCagri = (DataTable) hshOtoCagri["DataTable"];
                if (dtOtoCagri != null && dtOtoCagri.Rows.Count > 0)
                {
                    return bool.Parse(dtOtoCagri.Rows[0][0].ToString());
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }

        public static bool GetDoubleClickCagriAktif()
        {
            Hashtable hshDoubleClick = DBProcess.SimpleQuery(
                "TERMINALLER",
                "WHERE TID = " + TerminalID,
                "",
                "DoubleClick"
                );

            if (!hshDoubleClick.ContainsKey("Error"))
            {
                DataTable dtDoubleClick = (DataTable)hshDoubleClick["DataTable"];
                if (dtDoubleClick != null && dtDoubleClick.Rows.Count > 0)
                {
                    return bool.Parse(dtDoubleClick.Rows[0][0].ToString());
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
    }
}
