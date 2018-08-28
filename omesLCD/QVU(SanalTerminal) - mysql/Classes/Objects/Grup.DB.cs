
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Collections;
using System.Data;
using QVU.Library.Classes;


namespace QVU.Classes.Objects {
                    public partial class Grup {
        #region  Members/Propertieses
                                public int GRPID { get; set; }
                                public string Ad { get; set; }
                                public int BaslangicNo { get; set; }
                                public int BitisNo { get; set; }
                                                public bool Dongu { get; set; }
                                                        public DateTime MinHizmetSuresi { get; set; }
                                                        public DateTime MaxHizmetSuresi { get; set; }
                                public bool Aktif { get; set; }
                                                        public DateTime MesaiBaslangic { get; set; }
                                                        public DateTime MesaiBitis { get; set; }
                                                        public DateTime OgleArasiBaslangic { get; set; }
                                                        public DateTime OgleArasiBitis { get; set; }
                                                        public bool OgleTatilindeBiletVer { get; set; }
                                public bool BiletSinirla { get; set; }
                                public int OgledenOnceMaxBiletSayisi { get; set; }
                                public int OgledenSonraMaxBiletSayisi { get; set; }
                                                public bool Sil { get; set; }
        #endregion

        #region Methods
        #region Constructer Methods
        public Grup() { }

                                        public Grup(string _GRPID) {
            DataTable dtGroup = Get("GRPID=" + _GRPID, "*", "");

            if (dtGroup.Rows.Count > 0) {
                DataRow drGroup = dtGroup.Rows[0];
                GRPID = int.Parse(drGroup["GRPID"].ToString());
                Ad = drGroup["GRUP_ISMI"].ToString();
                BaslangicNo = int.Parse(drGroup["BAS_NO"].ToString());
                BitisNo = int.Parse(drGroup["BIT_NO"].ToString());
                Dongu = bool.Parse(drGroup["DONGU"].ToString());
                MinHizmetSuresi = DateTime.Parse(drGroup["MIN_HIZMET_SURESI"].ToString());
                MaxHizmetSuresi = DateTime.Parse(drGroup["MAX_HIZMET_SURESI"].ToString());
                Aktif = bool.Parse(drGroup["AKTIF"].ToString());
                MesaiBaslangic = DateTime.Parse(drGroup["MESAI_BAS"].ToString());
                MesaiBitis = DateTime.Parse(drGroup["MESAI_BIT"].ToString());
                OgleArasiBaslangic = DateTime.Parse(drGroup["OGLE_BAS"].ToString());
                OgleArasiBitis = DateTime.Parse(drGroup["OGLE_BIT"].ToString());
                OgleTatilindeBiletVer = bool.Parse(drGroup["OGLEN_BILET_VER"].ToString());
                BiletSinirla = bool.Parse(drGroup["BILET_SINIRLA"].ToString());
                OgledenOnceMaxBiletSayisi = int.Parse(drGroup["OO_MAX_BILET"].ToString());
                OgledenSonraMaxBiletSayisi = int.Parse(drGroup["OS_MAX_BILET"].ToString());
                Sil = bool.Parse(drGroup["SIL"].ToString());
            }
        }
        #endregion


        #region CRUD Process Methods
                                                                                public DataTable Get(string Where, string Columns, string OrderBy) {
            DataTable dtGroups = (DataTable)DBProcess.SimpleQuery("GRUPLAR",
                "Where " + Where + " AND SIL='False'",
                OrderBy,
                Columns)["DataTable"];

            return dtGroups;
        }
        #endregion
        #endregion
    }
}
