using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QPU_SerialPort.Library.Classes;
using System.Collections;

namespace QPU_SerialPort.Classes.QueueLayer
{
    public partial class Kuyruk
    {
        #region Members/Properties

        public int BiletID { get; set; }
        public int GrupID { get; set; }
        public int BiletNo { get; set; }
        public bool Transfer { get; set; }
        public bool Fiktif { get; set; }

        #endregion



        #region Methods

        #region Constructure Methods

        public Kuyruk()
        {
            KuyruktakiBiletler = GetRealetedGroupsOfTerminal();

            YardimGrubundan = false;
        }

        #endregion


        #region CRUD Process Methods

        private int deleteTryingCount = 0;

        public void Delete(string Where, int TerminalId)  //ikinci parametre örnek týp merkezi için eklendi
        {
            Hashtable hshDelete = DBProcess.DeleteData("KUYRUK", "Where " + Where);
            Hashtable cl = new Hashtable();
            cl["I_yf3"] = TerminalId;
            //Hashtable hshDelete = DBProcess.UpdateData("KUYRUK", "Where " + Where, cl); //örnek týp merkezi
            //deleteTryingCount++;

            //if (hshDelete.ContainsKey("Error"))
            //{
            //    if (deleteTryingCount <= 5)
            //    {
            //        Delete(Where, TerminalId);
            //    }
            //    else
            //    {
            //        hshDelete.Clear();
            //        hshDelete.Add("GRPID", 0);
            //        Update("BID" + BiletID, hshDelete);
            //    }


            //}
        }

        public void Update(string Where, Hashtable ColumnsAndValues)
        {
            DBProcess.UpdateData("KUYRUK", "Where " + Where, ColumnsAndValues);
        }

        #endregion

        #endregion
    }
}
