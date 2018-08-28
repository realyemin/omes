namespace QLU.Controls
{
    partial class AnaTabloSatir
    {
        /// <summary> 
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary> 
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Component Designer generated code

        /// <summary> 
        /// Required method for Designer support - do not modify 
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            this.lbl_GrupAdi = new System.Windows.Forms.Label();
            this.lbl_VezneNo = new System.Windows.Forms.Label();
            this.lbl_BiletNo = new System.Windows.Forms.Label();
            this.timer_Animation = new System.Windows.Forms.Timer(this.components);
            this.pnlOk = new System.Windows.Forms.Panel();
            this.pic_Yon = new System.Windows.Forms.PictureBox();
            this.pnlOk.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pic_Yon)).BeginInit();
            this.SuspendLayout();
            // 
            // lbl_GrupAdi
            // 
            this.lbl_GrupAdi.BackColor = System.Drawing.SystemColors.Control;
            this.lbl_GrupAdi.Dock = System.Windows.Forms.DockStyle.Left;
            this.lbl_GrupAdi.Font = new System.Drawing.Font("Nyala", 60F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbl_GrupAdi.Location = new System.Drawing.Point(0, 0);
            this.lbl_GrupAdi.Margin = new System.Windows.Forms.Padding(6, 0, 6, 0);
            this.lbl_GrupAdi.Name = "lbl_GrupAdi";
            this.lbl_GrupAdi.Size = new System.Drawing.Size(500, 470);
            this.lbl_GrupAdi.TabIndex = 7;
            this.lbl_GrupAdi.Text = "KBB";
            // 
            // lbl_VezneNo
            // 
            this.lbl_VezneNo.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lbl_VezneNo.Font = new System.Drawing.Font("Nyala", 60F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbl_VezneNo.Location = new System.Drawing.Point(850, 0);
            this.lbl_VezneNo.Margin = new System.Windows.Forms.Padding(6, 0, 6, 0);
            this.lbl_VezneNo.Name = "lbl_VezneNo";
            this.lbl_VezneNo.Size = new System.Drawing.Size(150, 470);
            this.lbl_VezneNo.TabIndex = 8;
            this.lbl_VezneNo.Text = "1";
            // 
            // lbl_BiletNo
            // 
            this.lbl_BiletNo.Dock = System.Windows.Forms.DockStyle.Left;
            this.lbl_BiletNo.Font = new System.Drawing.Font("Nyala", 60F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbl_BiletNo.Location = new System.Drawing.Point(500, 0);
            this.lbl_BiletNo.Margin = new System.Windows.Forms.Padding(6, 0, 6, 0);
            this.lbl_BiletNo.Name = "lbl_BiletNo";
            this.lbl_BiletNo.Size = new System.Drawing.Size(250, 470);
            this.lbl_BiletNo.TabIndex = 9;
            this.lbl_BiletNo.Text = "12345";
            // 
            // timer_Animation
            // 
            this.timer_Animation.Interval = 500;
            // 
            // pnlOk
            // 
            this.pnlOk.Controls.Add(this.pic_Yon);
            this.pnlOk.Dock = System.Windows.Forms.DockStyle.Left;
            this.pnlOk.Location = new System.Drawing.Point(750, 0);
            this.pnlOk.Name = "pnlOk";
            this.pnlOk.Size = new System.Drawing.Size(100, 470);
            this.pnlOk.TabIndex = 10;
            // 
            // pic_Yon
            // 
            this.pic_Yon.Dock = System.Windows.Forms.DockStyle.Fill;
            //this.pic_Yon.Image = global::QLU.Properties.Resources.YukariYonOku;
            this.pic_Yon.Location = new System.Drawing.Point(0, 0);
            this.pic_Yon.Name = "pic_Yon";
            this.pic_Yon.Size = new System.Drawing.Size(100, 470);
            this.pic_Yon.SizeMode = System.Windows.Forms.PictureBoxSizeMode.CenterImage;
            this.pic_Yon.TabIndex = 8;
            this.pic_Yon.TabStop = false;
            // 
            // AnaTabloSatir
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.Controls.Add(this.lbl_VezneNo);
            this.Controls.Add(this.pnlOk);
            this.Controls.Add(this.lbl_BiletNo);
            this.Controls.Add(this.lbl_GrupAdi);
            this.Name = "AnaTabloSatir";
            this.Size = new System.Drawing.Size(1000, 470);
            this.Resize += new System.EventHandler(this.AnaTabloSatir_Resize);
            this.pnlOk.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.pic_Yon)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        public System.Windows.Forms.Label lbl_GrupAdi;
        public System.Windows.Forms.Label lbl_VezneNo;
        public System.Windows.Forms.Label lbl_BiletNo;
        public System.Windows.Forms.Timer timer_Animation;
        private System.Windows.Forms.Panel pnlOk;
        public System.Windows.Forms.PictureBox pic_Yon;

    }
}
