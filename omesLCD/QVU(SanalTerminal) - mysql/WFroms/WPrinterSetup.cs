using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Drawing.Printing;
using QVU.Properties;

namespace QVU.WFroms {
    public partial class WPrinterSetup : Form {
        public WPrinterSetup() {
            InitializeComponent();
        }
        #region Members/Propertieses
                                        public bool DonePrintSettings = false;
        #endregion



        #region Events
        private void WPrinterSetup_Load( object sender, EventArgs e ) {
            for ( int i = 0; i < PrinterSettings.InstalledPrinters.Count; i++ ) {
                LstBxPrinterList.Items.Add( PrinterSettings.InstalledPrinters[ i ] );

            }
            LstBxPrinterList.SelectedIndex = -1;



            for ( int i = 0; i < LstBxPrinterList.Items.Count; i++ ) {
                if ( LstBxPrinterList.Items[ i ].ToString() == Settings.Default.FiktifPrinter ) {
                    LstBxPrinterList.SelectedItem = LstBxPrinterList.Items[ i ];
                    LblCurrentPrinter.Text = LstBxPrinterList.SelectedItem.ToString();
                    break;
                }
            }

                    }
        

        #region Process Events
        private void LstBxPrinterList_DoubleClick( object sender, EventArgs e ) {
                        BtnPrintSave.PerformClick();
        }

        private void LstBxPrinterList_SelectedIndexChanged( object sender, EventArgs e ) {
            if ( LstBxPrinterList.SelectedIndex == -1 ) {
                BtnPrintSave.Enabled = false;
                return;
            }

            LblPrinterName.Text = LstBxPrinterList.SelectedItem.ToString();
            BtnPrintSave.Enabled = true;
        }

                
                        
        private void BtnPrintSave_Click( object sender, EventArgs e ) {
            Settings.Default.FiktifPrinter = LstBxPrinterList.SelectedItem.ToString();
            Settings.Default.Save();

            DonePrintSettings = true;

                        TmrCloseWait.Start(); 
            LblResultAndReason.ForeColor = Color.Green;
            LblResultAndReason.Text = "Yazıcı ayarları yapıldı...";
                    }
        #endregion
        
        
        
        #region Closing events
        private void WPrinterSetup_KeyDown( object sender, KeyEventArgs e ) {
            if ( e.KeyCode == Keys.Escape ) {
                this.Close();
            }
        }
        
        int timeTick = 0;
        private void TmrCloseWait_Tick( object sender, EventArgs e ) {
            if ( timeTick == 50 ) {
                beClose = true;
                this.Close();
            }
            else {
                timeTick++;
                this.Opacity -= 0.020;

            }
        }

        bool beClose = false;
        private void WPrinterSetup_FormClosing( object sender, FormClosingEventArgs e ) {
            if ( !DonePrintSettings ) {                                 TmrCloseWait.Start();
                LblResultAndReason.ForeColor = Color.Red;
                LblResultAndReason.Text = "Yazıcı ayarlama işlemini iptal ettiniz...";
                e.Cancel = true;
            }
            else {
                this.DialogResult = System.Windows.Forms.DialogResult.OK;
            }

            if ( beClose ) {
                e.Cancel = false;
            }
        }
        #endregion
        #endregion















    }
}
