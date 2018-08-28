using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;
using System.Collections;

namespace QVU.Classes.OtherProcess {
					public partial class Mola {
		#region Members/Propertieses
								public int MolaID { get; set; }
								public int PersonelID { get; set; }
								public DateTime MolaBaslangic { get; set; }
								public DateTime MolaBitis { get; set; }
		#endregion


		#region Methods
		#region Constructure Methods
		public Mola() {
			this.Molada = false;
		}
				
																#endregion

																public DataTable Get( string Where, string Columns ) {
			DataTable dtGetData = new DataTable();
			Hashtable hshGet = DBProcess.SimpleQuery(
				"MOLALAR",
				"Where " + Where,
				"",
				Columns );

			if (! hshGet.ContainsKey("Error") ) {
				dtGetData = (DataTable)hshGet[ "DataTable" ];
			}
			else {
							}

			return dtGetData;
		}

										public Hashtable New() {
			Hashtable hshNewCoffeBreak = new Hashtable();
			hshNewCoffeBreak.Add( "PID", PersonelID );
			hshNewCoffeBreak.Add( "BAS_TARIH", MolaBaslangic );
			hshNewCoffeBreak.Add( "MOLADA", true );

			return DBProcess.InsertData( "MOLALAR", hshNewCoffeBreak );
		}

																		public Hashtable Update( string Where, Hashtable UpdateColumns ) {
			return DBProcess.UpdateData( "MOLALAR", "Where " + Where, UpdateColumns );
		}
		#endregion
	}
}
