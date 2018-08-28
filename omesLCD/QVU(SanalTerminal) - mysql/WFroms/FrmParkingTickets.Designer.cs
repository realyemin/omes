namespace QVU.WFroms
{
    partial class FrmParkingTickets
    {
        private System.ComponentModel.IContainer components = null;

        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        private void InitializeComponent()
        {
            this.DGVParking = new System.Windows.Forms.DataGridView();
            this.BID = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.GRPID = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.BNo = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.DGVParking)).BeginInit();
            this.SuspendLayout();
            // 
            // DGVParking
            // 
            this.DGVParking.AllowUserToAddRows = false;
            this.DGVParking.AllowUserToDeleteRows = false;
            this.DGVParking.BackgroundColor = System.Drawing.SystemColors.Control;
            this.DGVParking.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.DGVParking.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.BID,
            this.GRPID,
            this.BNo});
            this.DGVParking.Dock = System.Windows.Forms.DockStyle.Fill;
            this.DGVParking.Location = new System.Drawing.Point(0, 0);
            this.DGVParking.Name = "DGVParking";
            this.DGVParking.ReadOnly = true;
            this.DGVParking.Size = new System.Drawing.Size(251, 277);
            this.DGVParking.TabIndex = 0;
            this.DGVParking.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.DGVParking_CellDoubleClick);
            // 
            // BID
            // 
            this.BID.DataPropertyName = "BID";
            this.BID.HeaderText = "BID";
            this.BID.Name = "BID";
            this.BID.ReadOnly = true;
            this.BID.Visible = false;
            // 
            // GRPID
            // 
            this.GRPID.DataPropertyName = "GRPID";
            this.GRPID.HeaderText = "GRPID";
            this.GRPID.Name = "GRPID";
            this.GRPID.ReadOnly = true;
            this.GRPID.Visible = false;
            // 
            // BNo
            // 
            this.BNo.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.BNo.DataPropertyName = "BiletNo";
            this.BNo.HeaderText = "Ticked No";
            this.BNo.Name = "BNo";
            this.BNo.ReadOnly = true;
            // 
            // FrmParkingTickets
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(251, 277);
            this.Controls.Add(this.DGVParking);
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "FrmParkingTickets";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent;
            this.Text = "Parked tickets";
            this.TopMost = true;
            this.Load += new System.EventHandler(this.FrmParkingTickets_Load);
            ((System.ComponentModel.ISupportInitialize)(this.DGVParking)).EndInit();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.DataGridView DGVParking;
        private System.Windows.Forms.DataGridViewTextBoxColumn BID;
        private System.Windows.Forms.DataGridViewTextBoxColumn GRPID;
        private System.Windows.Forms.DataGridViewTextBoxColumn BNo;
    }
}
