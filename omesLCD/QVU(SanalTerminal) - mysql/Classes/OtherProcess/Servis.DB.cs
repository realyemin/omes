using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;
using System.Collections;
using QVU.Classes.DBLayer;

namespace QVU.Classes.OtherProcess {
						public partial class Servis {
		#region Members/Propertieses
								public int ServisHareketID { get; set; }
								public int TerminalID { get; set; }
								public string KapatmaSebebi { get; set; }
								public DateTime ServisKapatmaTarihi { get; set; }
								public DateTime ServisAcmaTarihi { get; set; }
								public bool ServisKapali { get; set; }
		#endregion


		#region Methods
		public Servis() {
						this.TerminalID = SanalTerminal.TerminalID;
		}

																public DataTable Get( string Where, string Columns ) {
			DataTable dtGetData = new DataTable();
			Hashtable hshGet = DBProcess.SimpleQuery(
				"SERVIS_HAREKET",
				"Where " + Where,
				"",
				Columns );
			
						
			if ( !hshGet.ContainsKey( "Error" ) ) {
				dtGetData = (DataTable)hshGet[ "DataTable" ];
			}
			else {
							}

			return dtGetData;
		}

										public Hashtable New() {
			Hashtable hshNewOutOfService = new Hashtable();
			hshNewOutOfService.Add( "TID", this.TerminalID );
			hshNewOutOfService.Add( "SEBEP", this.KapatmaSebebi );
			hshNewOutOfService.Add( "KAP_TAR", this.ServisKapatmaTarihi );
			hshNewOutOfService.Add( "KAPALI", true );

			return DBProcess.InsertData( "SERVIS_HAREKET", hshNewOutOfService );
		}

																		public Hashtable Update( string Where, Hashtable UpdateColumns ) {
			return DBProcess.UpdateData( "SERVIS_HAREKET", "Where " + Where, UpdateColumns );
		}
		#endregion
	}
}
