using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Collections;
using QVU.Library.Classes;

namespace QVU.Classes.QueueLayer {
    public partial class Terminaller
    {
        #region Members/Propertieses
        public int TID { get; set; }
        public int ElTerminalID { get; set; }
        public int BiletMakineID { get; set; }
        public bool OtomatikCagri { get; set; }
        public DateTime OtomatikCagriSuresi { get; set; }
        public int Durum { get; set; }
        public bool Aktif { get; set; }
        public int AktifBiletID { get; set; }
        public int SonCagrilanGrup { get; set; }
        public bool SonCagrilanTur { get; set; }


        public enum TerminalDurum
        {
            ServisDisi = 1,
            MusteriIleMesgul,
            Bosta,
            Molada,
            OgleTatilinde,
            SistemdeDegil
        }
        #endregion



        #region Methods
        #region Constructer Methods
        public Terminaller() { }

        public Terminaller(string _TID)
        {
            DataTable dtTerminal = Get(
                "TID=" + _TID,
                "ELTID, OTO_SURE, DURUM, AKTIF, AKTIF_BID, SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR"
                );

            if (dtTerminal.Rows.Count > 0)
            {
                DataRow drTerminal = dtTerminal.Rows[0];
                TID = int.Parse(_TID);
                ElTerminalID = int.Parse(drTerminal["ELTID"].ToString());
                OtomatikCagriSuresi = DateTime.Parse(drTerminal["OTO_SURE"].ToString());
                Durum = int.Parse(drTerminal["DURUM"].ToString());
                Aktif = bool.Parse(drTerminal["AKTIF"].ToString());
                AktifBiletID = int.Parse(drTerminal["AKTIF_BID"].ToString());
                SonCagrilanGrup = int.Parse(drTerminal["SON_CAGRILAN_GRUP"].ToString());
                SonCagrilanTur = bool.Parse(drTerminal["SON_CAGRILAN_TUR"].ToString());
            }
        }
        #endregion


        #region CRUD Process Methods
        public DataTable Get(string Where, string Columns)
        {
            Hashtable hshGetDataResults;
            DataTable dtGetData = new DataTable();
            hshGetDataResults = DBProcess.SimpleQuery(
                "TERMINALLER",
                "Where " + Where,
                "",
                Columns);

            if (!hshGetDataResults.ContainsKey("Error"))
            {
                dtGetData = (DataTable)hshGetDataResults["DataTable"];
            }

            return dtGetData;
        }
        #endregion
        #endregion
    }
}
