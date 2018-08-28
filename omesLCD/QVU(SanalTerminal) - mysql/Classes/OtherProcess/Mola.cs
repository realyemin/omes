using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Collections;

namespace QVU.Classes.OtherProcess {
					public partial class Mola {
		#region Members/Propertieses
								public bool Molada { get; set; }
		#endregion



								public void LetsCoffeeBreak() {
			Hashtable hshCoffeeBreak = this.New();


			if ( !hshCoffeeBreak.ContainsKey( "Error" ) ) { 								this.Molada = true;
				this.MolaID = int.Parse( hshCoffeeBreak[ "Identity" ].ToString() );
			}
			else {
								this.Molada = false;
				this.MolaID = 0;
							}
		}

								public void DoneCoffeeBreak() {
			Hashtable hshCoffeeInf = new Hashtable();
			hshCoffeeInf.Add( "BIT_TARIH", this.MolaBitis );
			hshCoffeeInf.Add( "MOLADA", false);

			Hashtable hshDoneCoffeeBreak = this.Update( "MID=" + this.MolaID, hshCoffeeInf );

			if ( !hshCoffeeInf.ContainsKey( "Error" ) ) { 								this.Molada = false;
				this.MolaID = 0;
			}
			else {
							}
		}
	}
}
