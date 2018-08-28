using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Drawing;
using System.Data;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace QLU.Controls
{
    public partial class AnaTabloSatir : UserControl
    {
        public AnaTabloSatir()
        {
            InitializeComponent();
        }

        private void AnaTabloSatir_Resize(object sender, EventArgs e)
        {
            lbl_GrupAdi.Width = Convert.ToInt32(this.Width * 0.5);
            lbl_BiletNo.Width = Convert.ToInt32(this.Width * 0.25);
            lbl_VezneNo.Width = Convert.ToInt32(this.Width * 0.15);
            pnlOk.Width = Convert.ToInt32(this.Width * 0.1);
        }
    }
}
