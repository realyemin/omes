using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using QVU.Classes.OtherProcess;
using QVU.Classes.DBLayer;

namespace QVU.WFroms
{
    public partial class WOutOfServiceReason : Form
    {
        public WOutOfServiceReason()
        {
            InitializeComponent();

        }

        public bool ServiceOutOf = false;
        public string outOfReaseon = string.Empty;
        private void BtnCloseService_Click(object sender, EventArgs e)
        {
            if (string.IsNullOrEmpty(TxtBxReason.Text.Trim()))
            {
                MessageBox.Show(
                  "Please enter the service shutdown reason!", "Virtual Terminal - Warning",
                  MessageBoxButtons.OK,
                  MessageBoxIcon.Warning
                  );
                return;
            }
            ServiceOutOf = true;



            TmrCloseWait.Start();
            LblResultAndReason.ForeColor = Color.Green;
            LblResultAndReason.Text = "Service shutdown performed.\nYour service is off...";
        }

        bool beClose = false;
        private void WOutOfServiceReason_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (beClose)
            {
                e.Cancel = false;
                return;
            }



            if (!ServiceOutOf)
            {
                TmrCloseWait.Start();
                LblResultAndReason.ForeColor = Color.Red;
                LblResultAndReason.Text = "service You canceled shutdown.\nservice In the open case...";
                e.Cancel = true;
            }
        }

        int timeTick = 0;
        private void TmrCloseWait_Tick(object sender, EventArgs e)
        {

            if (timeTick == 50)
            {
                beClose = true;
                this.Close();
            }
            else
            {
                timeTick++;
                this.Opacity -= 0.020;

            }
        }

        private void WOutOfServiceReason_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char)Keys.Escape)
            {
                this.Close();
            }
        }
    }
}
