using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;

namespace QVU.Classes.UserAccessLayer.EventArgsClasses
{
    internal class SuccesLoginEventArgs : EventArgs
    {
        #region Members

        public int PersonelId { get; set; }
        public int TerminalId { get; set; }
        public string TerminalAdi { get; set; }
        public string PersonelAd { get; set; }
        public string PersonelSoyad { get; set; }

        #endregion

        #region Methods

        public SuccesLoginEventArgs(UserLogin userLogin)
        {
            PersonelId = userLogin.PersonelId;
            TerminalId = userLogin.TerminalId;
            PersonelAd = userLogin.Ad;
            PersonelSoyad = userLogin.Soyad;
            TerminalAdi = userLogin.TerminalAdi;
        }

        #endregion

    }

    internal class FailedLoginEventArgs : EventArgs
    {
        #region Members

        public string FailedResult { get; set; }

        #endregion

        #region Methods

        public FailedLoginEventArgs(string _FailedResult)
        {
            FailedResult = _FailedResult;
        }

        #endregion
    }
}
