using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using QVU.Classes;
using QVU.Classes.DBLayer;
using QVU.Classes.QueueLayer;
using QVU.Classes.UserAccessLayer.EventArgsClasses;
using QVU.Classes.SocketCommunicateLayer;
using System.Globalization;
using System.Threading;


namespace QVU.WFroms
{
    public partial class FrmLogin : Form
    {
        public static string language;
        public FrmLogin()
        {
            InitializeComponent();
        }

        public static bool v_bl_LoginState;

        private UserLogin userLogin;

        #region Events

        private void Login_Load(object sender, EventArgs e)
        {
            ChangeLanguage("EN");
            userLogin = new UserLogin();
            userLogin.SuccessLogin += userLogin_SuccessLogin;
            userLogin.FailedLogin += userLogin_FailedLogin;

            DataTable dtTerminal = Terminaller.LoadToControl();
            CommonDataOptions.LoadDataToComboBox(cbTerminal, dtTerminal, "Please Select Terminal...");
        }

        private void FrmLogin_Shown(object sender, EventArgs e)
        {
            if (!TCPIPCommunicating.CheckQPUServer())
            {
                MessageBox.Show(
                    string.Format("{0}{1}{2}{1}{3}", "The QPU Server cannot be get at.",
                        Environment.NewLine,
                        "Ensure that the Server program is running and restart the virtual terminal software.",
                        "The virtual terminal will now be closed."),
                    Settings.MessageBoxTitle,
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning
                    );
                v_bl_LoginState = false;
                this.Close();
            }
        }

        private void BtnLogin_Click(object sender, EventArgs e)
        {
            if (RequiredFieldControl())
            {
                userLogin.Login(TxtBxUserName.Text.Trim(), TxtBxPass.Text.Trim(), cbTerminal.SelectedValue.ToString());

            }
        }

        private void userLogin_FailedLogin(FailedLoginEventArgs args)
        {
            v_bl_LoginState = false;
            MessageBox.Show(args.FailedResult, "Warning", MessageBoxButtons.OK, MessageBoxIcon.Warning);

            TxtBxUserName.SelectAll();
            TxtBxUserName.Focus();
        }

        private void BtnCancel_Click(object sender, EventArgs e)
        {
            v_bl_LoginState = false;
            this.Close();
        }

        private void TxtBxUserName_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char) Keys.Enter)
            {
                TxtBxPass.Focus();
            }
        }

        private void TxtBxPass_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char) Keys.Enter)
            {
                BtnLogin.PerformClick();
            }
        }

        private void userLogin_SuccessLogin(SuccesLoginEventArgs args)
        {
            SanalTerminal.PersonelID = args.PersonelId;
            SanalTerminal.TerminalID = args.TerminalId;
            SanalTerminal.PersonelAd = args.PersonelAd;
            SanalTerminal.PersonelSoyad = args.PersonelSoyad;
            SanalTerminal.OtomatikCagri = SanalTerminal.GetOtoCagriAktif();
            SanalTerminal.OtomatikCagriSuresi = SanalTerminal.GetOtoCagriSuresi();
            SanalTerminal.TerminalAdi = args.TerminalAdi;
            SanalTerminal.DoubleClick = SanalTerminal.GetDoubleClickCagriAktif();
            

            v_bl_LoginState = true;
            this.Close();
        }

        #endregion


        #region Methods

        private bool RequiredFieldControl()
        {
            if (string.IsNullOrEmpty(TxtBxUserName.Text.Trim()))
            {
                MessageBox.Show("Please enter your username!",
                    Settings.MessageBoxTitle,
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning);

                TxtBxUserName.BackColor = Color.Red;
                TxtBxUserName.Focus();
                return false;
            }
            else if (string.IsNullOrEmpty(TxtBxPass.Text.Trim()))
            {
                MessageBox.Show("Please enter your password!",
                    Settings.MessageBoxTitle,
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning);

                TxtBxPass.BackColor = Color.Red;
                TxtBxPass.Focus();
                return false;
            }
            else
            {
                return true;
            }
        }

        #endregion

        private void label3_Click(object sender, EventArgs e)
        {
            ChangeLanguage("tr-TR");
        }

        private void label4_Click(object sender, EventArgs e)
        {
            ChangeLanguage("en");
        }

        private void ChangeLanguage(string lang)
        {
            language = lang;
            var ci = new CultureInfo(lang);
            System.Threading.Thread.CurrentThread.CurrentUICulture = ci;
            foreach (Control c in this.Controls)
            {
                ComponentResourceManager resources = new ComponentResourceManager(this.GetType());
                resources.ApplyResources(c, c.Name, ci);
                if (c.GetType() == typeof(DataGridView))
                {
                    var dgv = (DataGridView)c;
                    foreach (DataGridViewColumn col in dgv.Columns)
                    {
                        resources.ApplyResources(col, col.Name);
                    }
                }
            }
        }
    }
}
