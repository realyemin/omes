using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;
using System.Collections;

namespace QVU.Classes.TicketLayer {
                public partial class BiletMakineButon {
        #region Members/Propertieses
                                        public int ButonID { get; set; }
                                public int GrupID { get; set; }
                                        public int MaximumBiletSayisi { get; set; }
                                public int BiletKopyaSayisi { get; set; }
                                                public bool Aktif { get; set; }
        #endregion
        
        
        
        #region Methods
        #region Constructer Methods
        public BiletMakineButon() { }

                                                        public BiletMakineButon(string _BTNID, string _BMAdres) {
            DataTable dtStructure = Get(
                string.Format("BTNID={0} AND BM_ADRES={1}", _BTNID, _BMAdres),
                "GRP_ID, MAKS_BILET, BILET_KOPYA, AKTIF"
                );

            if (dtStructure.Rows.Count > 0) {
                DataRow drStructure = dtStructure.Rows[0];
                ButonID = int.Parse(_BTNID);
                                                GrupID = int.Parse(drStructure["GRP_ID"].ToString());
                                
                MaximumBiletSayisi = int.Parse(drStructure["MAKS_BILET"].ToString());
                BiletKopyaSayisi = int.Parse(drStructure["BILET_KOPYA"].ToString());
                Aktif = bool.Parse(drStructure["AKTIF"].ToString());
                MaxBileteUlasildimi = CheckMaxTicketLimit();
            }
        }
        #endregion
        
        
        
        #region CRUD Process Methods
                                                                public DataTable Get(string Where, string Columns) {
            DataTable dtGet = (DataTable)DBProcess.SimpleQuery(
                "BUTONLAR",
                "Where " + Where,
                "ORDER BY BTNID DESC",
                Columns
                )["DataTable"];

            return dtGet;
        }
        #endregion
        #endregion
    }
}
