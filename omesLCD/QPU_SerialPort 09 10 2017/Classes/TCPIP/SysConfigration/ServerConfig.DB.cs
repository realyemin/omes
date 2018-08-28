using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_TCPIP.Library.Classes;

namespace QPU_TCPIP.Classes.SysConfigration {
    public partial class ServerConfig
    {
        #region Members/Propertieses

        public string ServerIP { get; set; }

        #endregion

        #region Methods

        #region Constructure Methods

        public ServerConfig()
        {
            DataTable dtConstructure = this.Get("*");

            if (dtConstructure != null && dtConstructure.Rows.Count > 0)
            {
                this.ServerIP = dtConstructure.Rows[0]["SERVER_IP"].ToString();
            }
        }

        #endregion

        #region CRUD Methods

        public DataTable Get(string Columns)
        {
            DataTable dtGet = (DataTable) DBProcess.SimpleQuery("SISTEM_CONFIG",
                "",
                "",
                Columns)["DataTable"];

            return dtGet;
        }

        #endregion
        //a�a��daki kod kioskId 130 ise server ad�na vt'den ula��yor oysa bu de�erin parametrik olmas� gerekir
        //�rn GET(string Columns, int KioskId) gibi ikinci bir parametre ile hangi kioks oldu�u belirtilebilir ki WHERE kosulu
        //de�i�ken olsun
        #region ESKI
        //public DataTable Get(string Columns)
        //{
        //    DataTable dtGet = (DataTable)DBProcess.SimpleQuery("SISTEM_CONFIG",
        //        "Where KioskId = 130",
        //        "",
        //        Columns)["DataTable"];

        //    return dtGet;
        //}
        #endregion
        #endregion
    }
}