using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using System.Windows.Forms;

namespace QVU.Classes.DBLayer
{
    internal class CommonDataOptions
    {
        public enum GetDataOptions
        {
            AllData,
            OnlyNotDeletedData,
            OnlyDeletedData
        }


        public static string CreateWhereThanDataOptions(CommonDataOptions.GetDataOptions getDataOptions)
        {
            string str_WhereSQLFilter = string.Empty;
            switch (getDataOptions)
            {
                case CommonDataOptions.GetDataOptions.AllData:
                    str_WhereSQLFilter = "";
                    break;
                case CommonDataOptions.GetDataOptions.OnlyNotDeletedData:
                    str_WhereSQLFilter = "SIL='False'";
                    break;
                case CommonDataOptions.GetDataOptions.OnlyDeletedData:
                    str_WhereSQLFilter = "SIL='True'";
                    break;
                default:
                    str_WhereSQLFilter = "";
                    break;
            }

            return str_WhereSQLFilter;
        }


        public static void LoadDataToComboBox(ComboBox Combo, DataTable DtToCombo,string PleaseSelectText)
        {
            DataTable dtPleaseSelect = new DataTable();
            dtPleaseSelect.Columns.Add(Combo.ValueMember, typeof (int));
            dtPleaseSelect.Columns.Add(Combo.DisplayMember, typeof (string));
            dtPleaseSelect.Rows.Add(0, PleaseSelectText);

          
                foreach (DataRow item in DtToCombo.Rows)
                {
                    dtPleaseSelect.Rows.Add(item[Combo.ValueMember].ToString(),
                        item[Combo.DisplayMember].ToString());
                }

            
            Combo.DataSource = dtPleaseSelect;
        }
    }
}
