using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Data;

namespace QVU.Classes.CommonProcess {
    class CommonProcess {
        public static void LoadDataToComboBox( ComboBox Combo, DataTable DtToCombo, string PleaseSelectText ) {
            DataTable dtPleaseSelect = new DataTable(); dtPleaseSelect.Columns.Add( Combo.ValueMember, typeof( int ) );
            dtPleaseSelect.Columns.Add( Combo.DisplayMember, typeof( string ) );
            dtPleaseSelect.Rows.Add( 0, PleaseSelectText );


            foreach( DataRow item in DtToCombo.Rows ) {
                dtPleaseSelect.Rows.Add( item[Combo.ValueMember].ToString(),
                    item[Combo.DisplayMember].ToString() );
            }

            Combo.DataSource = dtPleaseSelect;
        }
    }
}
