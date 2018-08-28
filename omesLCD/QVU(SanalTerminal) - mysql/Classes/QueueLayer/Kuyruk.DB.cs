using System.Collections;
using QVU.Library.Classes;

namespace QVU.Classes.QueueLayer
{
    public partial class Kuyruk
    {
        #region Members/Properties

        public int BiletId { get; set; }
        public int GrupId { get; set; }
        public int BiletNo { get; set; }
        public bool Transfer { get; set; }
        public bool Fiktif { get; set; }

        #endregion

        #region Methods

        #region Constructure Methods

        public Kuyruk(int terminalId)
        {
            terminal = new Terminaller(terminalId.ToString());
            YardimGrubundan = false;
        }

        #endregion

        #region CRUD Process Methods

        private int _deleteTryingCount;

        public void Delete(string Where)
        {
            var hshDelete = DBProcess.DeleteData("KUYRUK", "Where " + Where);
            _deleteTryingCount++;

            if (!hshDelete.ContainsKey("Error")) return;
            if (_deleteTryingCount <= 5)
            {
                Delete(Where);
            }
            else
            {
                hshDelete.Clear();
                hshDelete.Add("GRPID", 0);
                Update("BID" + BiletId, hshDelete);
            }
        }

        public void Update(string Where, Hashtable ColumnsAndValues)
        {
            DBProcess.UpdateData("KUYRUK", "Where " + Where, ColumnsAndValues);
        }

        #endregion

        #endregion
    }
}