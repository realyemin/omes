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
    public partial class Satir : UserControl
    {
        private int animasyonDeger;
        public Satir()
        {
            InitializeComponent();
        }

        private void timer_Animation_Tick(object sender, EventArgs e)
        {
            ++animasyonDeger;
            if (animasyonDeger == 7)
            {
                lbl_BiletNo.ForeColor = SystemColors.ControlText;
                lbl_VezneNo.ForeColor = SystemColors.ControlText;
                lbl_BiletNo.BackColor = Color.Red;
                lbl_VezneNo.BackColor = Color.Red;
                pic_Yon.Visible = true;
                timer_Animation.Stop();
            }
            else if (lbl_BiletNo.ForeColor != Color.Red && lbl_VezneNo.ForeColor != Color.Red)
            {
                lbl_VezneNo.ForeColor = Color.Red;
                lbl_BiletNo.ForeColor = Color.Red;
                lbl_BiletNo.BackColor = SystemColors.HotTrack;
                lbl_VezneNo.BackColor = SystemColors.HotTrack;
                pic_Yon.Visible = false;
            }
            else
            {
                lbl_VezneNo.ForeColor = SystemColors.ControlText;
                lbl_BiletNo.ForeColor = SystemColors.ControlText;
                lbl_BiletNo.BackColor = Color.Red;
                lbl_VezneNo.BackColor = Color.Red;
                pic_Yon.Visible = true;
            }
        }

        private void Satir_Resize(object sender, EventArgs e)
        {
            lbl_BiletNo.Width = Convert.ToInt32(this.Width * 0.5);
            lbl_VezneNo.Width = Convert.ToInt32(this.Width * 0.3);
            pnlOk.Width = Convert.ToInt32(this.Width * 0.2);

            //int size = lbl_BiletNo.Height * 6 / 10;
            //Font f = new Font("Microsoft Sans Serif", size);
            //lbl_BiletNo.Font = f;
        }
    }
}
