using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Windows.Forms;
using QVU.Classes;
using QVU.WFroms;

namespace QVU
{
    internal static class Program
    {
        [STAThread]
        
        private static void Main()
        {
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);

            Settings.MessageBoxTitle = "OMES Virtual Terminal";

            Application.Run(new FrmLogin());


            if (FrmLogin.v_bl_LoginState)
            {
                if (FrmLogin.language != null)
                {
                    var ci = new CultureInfo(FrmLogin.language);
                    Application.CurrentCulture = ci;
                }
                Application.Run(new FrmVirtualTerminal());
            }
            else
            {
                Application.Exit();
            }
        }
    }
}
