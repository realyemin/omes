using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Collections;
using QPU_SerialPort.Library.Classes;

namespace QPU_SerialPort.Classes.QueueLayer
{
    public partial class Terminaller
    {
        #region Members/Propertieses

        public int TID { get; set; }
        public int ElTerminalID { get; set; }
        public int BiletMakineID { get; set; }
        public bool OtomatikCagri { get; set; }
        public DateTime OtomatikCagriSuresi { get; set; }
        public int AktifBiletID { get; set; }
        public int Durum { get; set; }
        public bool Aktif { get; set; }
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

        public Terminaller()
        {
        }

        public Terminaller(string _ElTID)
        {
            DataTable dtTerminal = Get("ELTID=" + _ElTID,
                "TID, ELTID, OTO_SURE, DURUM, AKTIF, SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR");

            if (dtTerminal.Rows.Count > 0)
            {
                DataRow drTerminal = dtTerminal.Rows[0];
                TID = int.Parse(drTerminal["TID"].ToString());
                ElTerminalID = int.Parse(drTerminal["ELTID"].ToString());
                OtomatikCagriSuresi = DateTime.Parse(drTerminal["OTO_SURE"].ToString());
                Durum = int.Parse(drTerminal["DURUM"].ToString());
                Aktif = bool.Parse(drTerminal["AKTIF"].ToString());
                SonCagrilanGrup = int.Parse(drTerminal["SON_CAGRILAN_GRUP"].ToString());
                SonCagrilanTur = bool.Parse(drTerminal["SON_CAGRILAN_TUR"].ToString());
            }
        }

        #endregion


        #region CRUD Process Methods

        public DataTable Get(string Where, string Columns)
        {
            DataTable dtGetData = (DataTable) DBProcess.SimpleQuery(
                "TERMINALLER",
                "Where " + Where,
                "",
                Columns)["DataTable"];

            return dtGetData;
        }

        #endregion

        #endregion
    }
}
