using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data;
using QVU.Library.Classes;
using QVU.Classes.UserAccessLayer.EventArgsClasses;
using System.Collections;
using System.Windows.Forms;
using QTU.Classes.HandlingLayer;

namespace QVU.Classes
{
    internal class UserLogin
    {
        #region Members/Properties

        public int PersonelId { get; set; }
        private string Username { get; set; }
        private string Pass { get; set; }
        public int TerminalId { get; set; }
        public string TerminalAdi { get; set; }
        public string Ad { get; set; }
        public string Soyad { get; set; }

        #endregion



        #region Delegates and events definitons

        public delegate void SuccesLoginEventHandler(SuccesLoginEventArgs args);

        public event SuccesLoginEventHandler SuccessLogin;

        public delegate void FailedLoginEventHandler(FailedLoginEventArgs args);

        public event FailedLoginEventHandler FailedLogin;

        #endregion



        #region Methods

        public bool Login(string pUserName, string pPass, string terminalId)
        {
            Username = pUserName;
            Pass = pPass;

            DataTable dtUserInf;
            Hashtable hshUserResult = DBProcess.SimpleQuery(
                "PERSONELLER",
                "WHERE KULLANICI_ADI='" + Username + "' AND SIFRE='" + Pass + "'",
                "",
                "PID, TID, AD, SOYAD, OTURUM_DURUM"
                );


            if (hshUserResult.ContainsKey("Error"))
            {
                if (FailedLogin != null)
                {
                    FailedLogin(new FailedLoginEventArgs(
                        QSError.GiveErrorMessage(QSError.ErrorCodes.VeritabaninaUlasilamiyor)));
                }
                return false;
            }

            dtUserInf = (DataTable) hshUserResult["DataTable"];
            if (dtUserInf.Rows.Count > 0)
            {
                PersonelId = int.Parse(dtUserInf.Rows[0]["PID"].ToString());
                Ad = dtUserInf.Rows[0]["AD"].ToString();
                Soyad = dtUserInf.Rows[0]["SOYAD"].ToString();
                TerminalId = (terminalId == "0" ? int.Parse(dtUserInf.Rows[0]["TID"].ToString()) : Convert.ToInt32(terminalId));  //aha buraya combodan doldur.
               
                Hashtable hshTerminalResult = DBProcess.SimpleQuery(
                    "TERMINALLER", "WHERE TID=" + TerminalId, "", "TID, TERMINAL_AD");

                if (hshTerminalResult.ContainsKey("DataTable"))
                {
                    DataTable dtTerminalInf = (DataTable) hshTerminalResult["DataTable"];
                    if (!(dtTerminalInf.Rows.Count > 0))
                    {
                        if (FailedLogin != null)
                        {
                            FailedLogin(new FailedLoginEventArgs(
                                "Giriş yapılmaya çalışılan personele ait bir terminal kaydı bulunmamaktadır! Lütfen QCU üzerinden personele bir terminal ataması yapınız."));
                        }
                        return false;
                    }
                    else
                    {
                        TerminalAdi = dtTerminalInf.Rows[0]["TERMINAL_AD"].ToString();
                    }

                }

                UpdateLoginState(true);
                if (SuccessLogin != null)
                {
                    SuccessLogin(new SuccesLoginEventArgs(this));
                }
                return true;
            }
            if (FailedLogin != null)
            {
                FailedLogin(new FailedLoginEventArgs("Kullanıcı adı ve/veya şifreyi hatalı girdiniz!"));
            }
            return false;
        }

        public void UpdateLoginState(bool IsLogin)
        {
            Hashtable hshUpdateStates = new Hashtable();
            hshUpdateStates.Add("OTURUM_DURUM", IsLogin);

            DBProcess.UpdateData("PERSONELLER", "WHERE PID = " + PersonelId, hshUpdateStates);
        }

        #endregion
    }
}
