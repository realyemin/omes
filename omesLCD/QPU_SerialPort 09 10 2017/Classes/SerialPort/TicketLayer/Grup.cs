using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace QPU_SerialPort.Classes.TicketLayer {
    public partial class Grup {
        #region  Members/Propertieses
                                        public bool GrupOgleTatilinde { get; set; }
                                        public bool GrupMesaiSaatiDisinda { get; set; }
                                        public DateTime GrupBiletIstekTarihi { get; set; }
        #endregion

        #region Logical Process Methods
                                                                
                                        public bool IsGroupInLunchBreak() {
            if (!(Bilet.newBilet.BiletTarih > OgleArasiBaslangic && Bilet.newBilet.BiletTarih < OgleArasiBitis)) {
                                return false;
            }
            else {                 return true;
            }
        }
                                                private bool IsGroupOutOfWorkingHours() {
            if (!(Bilet.newBilet.BiletTarih > MesaiBaslangic && Bilet.newBilet.BiletTarih < MesaiBitis)) {
                                return false;             }
            else {                 return true;
            }
        }

        #endregion
    }
}
