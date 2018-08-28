using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Collections;

namespace QVU.Classes.OtherProcess {
						public partial class Servis {
		#region Members/Propertieses
								public bool ServisDisi { get; set; }
		#endregion



								public void CloseService() {
			Hashtable hshOutOfService = this.New();

			if ( !hshOutOfService.ContainsKey( "Error" ) ) { 								this.ServisDisi = true;
				this.ServisHareketID = int.Parse( hshOutOfService[ "Identity" ].ToString() );
			}
			else {
								this.ServisDisi = false;
				this.ServisHareketID = 0;
							}
		}

								public void OpenService() {
			Hashtable hshOutOfServiceInf = new Hashtable();
			hshOutOfServiceInf.Add( "AC_TAR", this.ServisAcmaTarihi );
			hshOutOfServiceInf.Add( "KAPALI", false );

			Hashtable hshDoneOutOf = this.Update( "SKID = " + this.ServisHareketID, hshOutOfServiceInf );

			if ( !hshOutOfServiceInf.ContainsKey( "Error" ) ) { 								this.ServisDisi = false;
				this.ServisHareketID = 0;
			}
			else {
							}
		}
	}
}
