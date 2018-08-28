namespace QVU.WFroms {
    partial class WOutOfServiceReason {
                                private System.ComponentModel.IContainer components = null;

                                        protected override void Dispose( bool disposing ) {
            if ( disposing && ( components != null ) ) {
                components.Dispose();
            }
            base.Dispose( disposing );
        }

        #region Windows Form Designer generated code

                                        private void InitializeComponent( ) {
            this.components = new System.ComponentModel.Container();
            this.TxtBxReason = new System.Windows.Forms.TextBox();
            this.BtnCloseService = new System.Windows.Forms.Button();
            this.LblResultAndReason = new System.Windows.Forms.Label();
            this.TmrCloseWait = new System.Windows.Forms.Timer(this.components);
            this.panel1 = new System.Windows.Forms.Panel();
            this.panel2 = new System.Windows.Forms.Panel();
            this.panel1.SuspendLayout();
            this.panel2.SuspendLayout();
            this.SuspendLayout();
            // 
            // TxtBxReason
            // 
            this.TxtBxReason.Anchor = ((System.Windows.Forms.AnchorStyles)(((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.TxtBxReason.Location = new System.Drawing.Point(11, 11);
            this.TxtBxReason.Margin = new System.Windows.Forms.Padding(4);
            this.TxtBxReason.Multiline = true;
            this.TxtBxReason.Name = "TxtBxReason";
            this.TxtBxReason.Size = new System.Drawing.Size(485, 109);
            this.TxtBxReason.TabIndex = 0;
            // 
            // BtnCloseService
            // 
            this.BtnCloseService.Anchor = ((System.Windows.Forms.AnchorStyles)((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Right)));
            this.BtnCloseService.DialogResult = System.Windows.Forms.DialogResult.OK;
            this.BtnCloseService.Font = new System.Drawing.Font("Calibri", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.BtnCloseService.Location = new System.Drawing.Point(328, 8);
            this.BtnCloseService.Margin = new System.Windows.Forms.Padding(4);
            this.BtnCloseService.Name = "BtnCloseService";
            this.BtnCloseService.Size = new System.Drawing.Size(168, 38);
            this.BtnCloseService.TabIndex = 2;
            this.BtnCloseService.Text = "Close Service";
            this.BtnCloseService.UseVisualStyleBackColor = true;
            this.BtnCloseService.Click += new System.EventHandler(this.BtnCloseService_Click);
            // 
            // LblResultAndReason
            // 
            this.LblResultAndReason.AutoSize = true;
            this.LblResultAndReason.Font = new System.Drawing.Font("Calibri", 12F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.LblResultAndReason.Location = new System.Drawing.Point(7, 8);
            this.LblResultAndReason.Margin = new System.Windows.Forms.Padding(7, 0, 7, 0);
            this.LblResultAndReason.Name = "LblResultAndReason";
            this.LblResultAndReason.Size = new System.Drawing.Size(309, 19);
            this.LblResultAndReason.TabIndex = 4;
            this.LblResultAndReason.Text = "Enter the reason for shutting down the service";
            // 
            // TmrCloseWait
            // 
            this.TmrCloseWait.Interval = 50;
            this.TmrCloseWait.Tick += new System.EventHandler(this.TmrCloseWait_Tick);
            // 
            // panel1
            // 
            this.panel1.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.panel1.Controls.Add(this.LblResultAndReason);
            this.panel1.Controls.Add(this.BtnCloseService);
            this.panel1.Location = new System.Drawing.Point(0, 131);
            this.panel1.Name = "panel1";
            this.panel1.Size = new System.Drawing.Size(503, 54);
            this.panel1.TabIndex = 5;
            // 
            // panel2
            // 
            this.panel2.Controls.Add(this.TxtBxReason);
            this.panel2.Dock = System.Windows.Forms.DockStyle.Top;
            this.panel2.Location = new System.Drawing.Point(0, 0);
            this.panel2.Name = "panel2";
            this.panel2.Size = new System.Drawing.Size(506, 131);
            this.panel2.TabIndex = 0;
            // 
            // WOutOfServiceReason
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(506, 185);
            this.Controls.Add(this.panel2);
            this.Controls.Add(this.panel1);
            this.Font = new System.Drawing.Font("Microsoft Sans Serif", 10F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(162)));
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.KeyPreview = true;
            this.Margin = new System.Windows.Forms.Padding(4);
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "WOutOfServiceReason";
            this.ShowInTaskbar = false;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent;
            this.Text = "Service Shutdown Reason";
            this.TopMost = true;
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.WOutOfServiceReason_FormClosing);
            this.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.WOutOfServiceReason_KeyPress);
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            this.panel2.ResumeLayout(false);
            this.panel2.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button BtnCloseService;
        private System.Windows.Forms.Label LblResultAndReason;
        private System.Windows.Forms.Timer TmrCloseWait;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.Panel panel2;
        public System.Windows.Forms.TextBox TxtBxReason;
    }
}
