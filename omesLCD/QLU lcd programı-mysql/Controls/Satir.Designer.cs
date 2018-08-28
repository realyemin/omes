namespace QLU.Controls
{
    partial class Satir
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
            this.panel1 = new System.Windows.Forms.Panel();
            this.lbl_VezneNo = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.pnlOk = new System.Windows.Forms.Panel();
            this.pic_Yon = new System.Windows.Forms.PictureBox();
            this.lbl_BiletNo = new System.Windows.Forms.Label();
            this.timer_Animation = new System.Windows.Forms.Timer(this.components);
            this.panel1.SuspendLayout();
            this.pnlOk.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pic_Yon)).BeginInit();
            this.SuspendLayout();
            // 
            // panel1
            // 
            this.panel1.BackColor = System.Drawing.SystemColors.GrayText;
            this.panel1.Controls.Add(this.lbl_VezneNo);
            this.panel1.Controls.Add(this.label1);
            this.panel1.Controls.Add(this.pnlOk);
            this.panel1.Controls.Add(this.lbl_BiletNo);
            this.panel1.Dock = System.Windows.Forms.DockStyle.Fill;
            this.panel1.Location = new System.Drawing.Point(0, 0);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(514, 94);
            this.panel1.TabIndex = 0;
            // 
            // lbl_VezneNo
            // 
            this.lbl_VezneNo.BackColor = System.Drawing.SystemColors.Control;
            this.lbl_VezneNo.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lbl_VezneNo.Font = new System.Drawing.Font("Microsoft Sans Serif", 60F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbl_VezneNo.Location = new System.Drawing.Point(350, 0);
            this.lbl_VezneNo.Margin = new System.Windows.Forms.Padding(6, 0, 6, 0);
            this.lbl_VezneNo.Name = "lbl_VezneNo";
            this.lbl_VezneNo.Size = new System.Drawing.Size(164, 94);
            this.lbl_VezneNo.TabIndex = 9;
            this.lbl_VezneNo.Text = "1";
            this.lbl_VezneNo.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(16, 4);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(35, 13);
            this.label1.TabIndex = 12;
            this.label1.Text = "label1";
            this.label1.UseMnemonic = false;
            this.label1.Visible = false;
            // 
            // pnlOk
            // 
            this.pnlOk.Controls.Add(this.pic_Yon);
            this.pnlOk.Dock = System.Windows.Forms.DockStyle.Left;
            this.pnlOk.Location = new System.Drawing.Point(250, 0);
            this.pnlOk.Name = "pnlOk";
            this.pnlOk.Size = new System.Drawing.Size(100, 94);
            this.pnlOk.TabIndex = 11;
            // 
            // pic_Yon
            // 
            this.pic_Yon.BackColor = System.Drawing.Color.White;
            this.pic_Yon.Dock = System.Windows.Forms.DockStyle.Fill;
            this.pic_Yon.Image = global::QLU.Properties.Resources.YukariYonOku;
            this.pic_Yon.Location = new System.Drawing.Point(0, 0);
            this.pic_Yon.Name = "pic_Yon";
            this.pic_Yon.Size = new System.Drawing.Size(100, 94);
            this.pic_Yon.SizeMode = System.Windows.Forms.PictureBoxSizeMode.CenterImage;
            this.pic_Yon.TabIndex = 8;
            this.pic_Yon.TabStop = false;
            // 
            // lbl_BiletNo
            // 
            this.lbl_BiletNo.BackColor = System.Drawing.SystemColors.Control;
            this.lbl_BiletNo.Dock = System.Windows.Forms.DockStyle.Left;
            this.lbl_BiletNo.Font = new System.Drawing.Font("Microsoft Sans Serif", 60F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.lbl_BiletNo.Location = new System.Drawing.Point(0, 0);
            this.lbl_BiletNo.Margin = new System.Windows.Forms.Padding(6, 0, 6, 0);
            this.lbl_BiletNo.Name = "lbl_BiletNo";
            this.lbl_BiletNo.Size = new System.Drawing.Size(250, 94);
            this.lbl_BiletNo.TabIndex = 10;
            this.lbl_BiletNo.Text = "12345";
            this.lbl_BiletNo.TextAlign = System.Drawing.ContentAlignment.MiddleCenter;
            // 
            // timer_Animation
            // 
            this.timer_Animation.Interval = 500;
            this.timer_Animation.Tick += new System.EventHandler(this.timer_Animation_Tick);
            // 
            // Satir
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(96F, 96F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Dpi;
            this.BackColor = System.Drawing.Color.Silver;
            this.Controls.Add(this.panel1);
            this.Name = "Satir";
            this.Size = new System.Drawing.Size(514, 94);
            this.Resize += new System.EventHandler(this.Satir_Resize);
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            this.pnlOk.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.pic_Yon)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Panel panel1;
        public System.Windows.Forms.Label label1;
        public System.Windows.Forms.Label lbl_VezneNo;
        private System.Windows.Forms.Panel pnlOk;
        public System.Windows.Forms.PictureBox pic_Yon;
        public System.Windows.Forms.Label lbl_BiletNo;
        public System.Windows.Forms.Timer timer_Animation;

    }
}
