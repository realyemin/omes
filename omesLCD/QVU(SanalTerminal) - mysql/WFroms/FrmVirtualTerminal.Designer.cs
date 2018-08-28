namespace QVU.WFroms {
	partial class FrmVirtualTerminal {
								private System.ComponentModel.IContainer components = null;

										protected override void Dispose( bool disposing ) {
			if ( disposing && ( components != null ) ) {
				components.Dispose();
			}
			base.Dispose( disposing );
		}

		#region Windows Form Designer generated code

										private void InitializeComponent() {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(FrmVirtualTerminal));
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle3 = new System.Windows.Forms.DataGridViewCellStyle();
            System.Windows.Forms.DataGridViewCellStyle dataGridViewCellStyle4 = new System.Windows.Forms.DataGridViewCellStyle();
            this.PnlTop = new System.Windows.Forms.Panel();
            this.btnTagSifirla = new System.Windows.Forms.Button();
            this.lblBitikBiletliKiosk = new System.Windows.Forms.Label();
            this.PctrBxHaveNotWaitings = new System.Windows.Forms.PictureBox();
            this.PctrBxHaveWaitings = new System.Windows.Forms.PictureBox();
            this.ChckBxMinMax = new System.Windows.Forms.CheckBox();
            this.LblCallingCount = new System.Windows.Forms.Label();
            this.MenuStripTop = new System.Windows.Forms.MenuStrip();
            this.ayarlarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.yaziciAyarlariToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.yardimToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.kisayollarToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.hakkindaToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.hataRaporuGonderToolStripMenuItem = new System.Windows.Forms.ToolStripMenuItem();
            this.LblWaitingTickets = new System.Windows.Forms.Label();
            this.label19 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.GrpBxTicketInf = new System.Windows.Forms.GroupBox();
            this.LblProcessTime = new System.Windows.Forms.Label();
            this.label16 = new System.Windows.Forms.Label();
            this.LblIsFiktif = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.LblIsTransfer = new System.Windows.Forms.Label();
            this.LblIslemSaati = new System.Windows.Forms.Label();
            this.LblSisTar = new System.Windows.Forms.Label();
            this.LblTicketGroupName = new System.Windows.Forms.Label();
            this.label14 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label9 = new System.Windows.Forms.Label();
            this.LblTicketNo = new System.Windows.Forms.Label();
            this.label15 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label12 = new System.Windows.Forms.Label();
            this.label13 = new System.Windows.Forms.Label();
            this.label11 = new System.Windows.Forms.Label();
            this.label10 = new System.Windows.Forms.Label();
            this.label8 = new System.Windows.Forms.Label();
            this.label7 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.BtnTransfer = new System.Windows.Forms.Button();
            this.CmbBxTransferGroups = new System.Windows.Forms.ComboBox();
            this.GrpBxQueueInf = new System.Windows.Forms.GroupBox();
            this.BtnClearFilter = new System.Windows.Forms.Button();
            this.TxtBxQueueTicketNo = new System.Windows.Forms.TextBox();
            this.DGVTicketLists = new System.Windows.Forms.DataGridView();
            this.BID = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.MusteriAdi = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.GRPID = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.BiletNo = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.GRP_AD = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.CmbBxQueueGroups = new System.Windows.Forms.ComboBox();
            this.PnlMiddle = new System.Windows.Forms.Panel();
            this.PnlBottom = new System.Windows.Forms.Panel();
            this.panel1 = new System.Windows.Forms.Panel();
            this.GrpBxFiktif = new System.Windows.Forms.GroupBox();
            this.ChckBxFiktifCurrentTicket = new System.Windows.Forms.CheckBox();
            this.LblFiktifError = new System.Windows.Forms.Label();
            this.LblFiktifTicketNumber = new System.Windows.Forms.Label();
            this.BtnFiktif = new System.Windows.Forms.Button();
            this.CmbBxFiktifGroups = new System.Windows.Forms.ComboBox();
            this.GrpBxProcess = new System.Windows.Forms.GroupBox();
            this.btnParkGoster = new System.Windows.Forms.Button();
            this.btnPark = new System.Windows.Forms.Button();
            this.LblSysInfo = new System.Windows.Forms.Label();
            this.label17 = new System.Windows.Forms.Label();
            this.BtnMola = new System.Windows.Forms.Button();
            this.BtnOutOfService = new System.Windows.Forms.Button();
            this.BtnReCallTicket = new System.Windows.Forms.Button();
            this.BtnNextTicket = new System.Windows.Forms.Button();
            this.label18 = new System.Windows.Forms.Label();
            this.ToolTipForProcess = new System.Windows.Forms.ToolTip(this.components);
            this.TmrTicketProcessCounter = new System.Windows.Forms.Timer(this.components);
            this.TmrOtoTicketCall = new System.Windows.Forms.Timer(this.components);
            this.TmrFiktifEffects = new System.Windows.Forms.Timer(this.components);
            this.printDialog1 = new System.Windows.Forms.PrintDialog();
            this.printDocument1 = new System.Drawing.Printing.PrintDocument();
            this.TmrForMakeLine = new System.Windows.Forms.Timer(this.components);
            this.TmrWaitingCountRefresh = new System.Windows.Forms.Timer(this.components);
            this.timerBiletBitti = new System.Windows.Forms.Timer(this.components);
            this.PnlTop.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.PctrBxHaveNotWaitings)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.PctrBxHaveWaitings)).BeginInit();
            this.MenuStripTop.SuspendLayout();
            this.GrpBxTicketInf.SuspendLayout();
            this.GrpBxQueueInf.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.DGVTicketLists)).BeginInit();
            this.PnlMiddle.SuspendLayout();
            this.PnlBottom.SuspendLayout();
            this.panel1.SuspendLayout();
            this.GrpBxFiktif.SuspendLayout();
            this.GrpBxProcess.SuspendLayout();
            this.SuspendLayout();
            // 
            // PnlTop
            // 
            this.PnlTop.BackColor = System.Drawing.SystemColors.ActiveCaption;
            this.PnlTop.Controls.Add(this.btnTagSifirla);
            this.PnlTop.Controls.Add(this.lblBitikBiletliKiosk);
            this.PnlTop.Controls.Add(this.PctrBxHaveNotWaitings);
            this.PnlTop.Controls.Add(this.PctrBxHaveWaitings);
            this.PnlTop.Controls.Add(this.ChckBxMinMax);
            this.PnlTop.Controls.Add(this.LblCallingCount);
            this.PnlTop.Controls.Add(this.MenuStripTop);
            this.PnlTop.Controls.Add(this.LblWaitingTickets);
            this.PnlTop.Controls.Add(this.label19);
            this.PnlTop.Controls.Add(this.label3);
            resources.ApplyResources(this.PnlTop, "PnlTop");
            this.PnlTop.Name = "PnlTop";
            // 
            // btnTagSifirla
            // 
            resources.ApplyResources(this.btnTagSifirla, "btnTagSifirla");
            this.btnTagSifirla.Name = "btnTagSifirla";
            this.btnTagSifirla.UseVisualStyleBackColor = true;
            this.btnTagSifirla.Click += new System.EventHandler(this.btnTagSifirla_Click);
            // 
            // lblBitikBiletliKiosk
            // 
            resources.ApplyResources(this.lblBitikBiletliKiosk, "lblBitikBiletliKiosk");
            this.lblBitikBiletliKiosk.ForeColor = System.Drawing.Color.Red;
            this.lblBitikBiletliKiosk.Name = "lblBitikBiletliKiosk";
            // 
            // PctrBxHaveNotWaitings
            // 
            this.PctrBxHaveNotWaitings.Image = global::QVU.Properties.Resources.HaveNotWaiting;
            resources.ApplyResources(this.PctrBxHaveNotWaitings, "PctrBxHaveNotWaitings");
            this.PctrBxHaveNotWaitings.Name = "PctrBxHaveNotWaitings";
            this.PctrBxHaveNotWaitings.TabStop = false;
            this.ToolTipForProcess.SetToolTip(this.PctrBxHaveNotWaitings, resources.GetString("PctrBxHaveNotWaitings.ToolTip"));
            // 
            // PctrBxHaveWaitings
            // 
            this.PctrBxHaveWaitings.Image = global::QVU.Properties.Resources.HaveWaiting;
            resources.ApplyResources(this.PctrBxHaveWaitings, "PctrBxHaveWaitings");
            this.PctrBxHaveWaitings.Name = "PctrBxHaveWaitings";
            this.PctrBxHaveWaitings.TabStop = false;
            this.ToolTipForProcess.SetToolTip(this.PctrBxHaveWaitings, resources.GetString("PctrBxHaveWaitings.ToolTip"));
            // 
            // ChckBxMinMax
            // 
            resources.ApplyResources(this.ChckBxMinMax, "ChckBxMinMax");
            this.ChckBxMinMax.Name = "ChckBxMinMax";
            this.ToolTipForProcess.SetToolTip(this.ChckBxMinMax, resources.GetString("ChckBxMinMax.ToolTip"));
            this.ChckBxMinMax.UseVisualStyleBackColor = true;
            this.ChckBxMinMax.CheckedChanged += new System.EventHandler(this.ChckBxMinMax_CheckedChanged);
            // 
            // LblCallingCount
            // 
            resources.ApplyResources(this.LblCallingCount, "LblCallingCount");
            this.LblCallingCount.ForeColor = System.Drawing.Color.Red;
            this.LblCallingCount.Name = "LblCallingCount";
            // 
            // MenuStripTop
            // 
            resources.ApplyResources(this.MenuStripTop, "MenuStripTop");
            this.MenuStripTop.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.ayarlarToolStripMenuItem,
            this.yardimToolStripMenuItem});
            this.MenuStripTop.Name = "MenuStripTop";
            // 
            // ayarlarToolStripMenuItem
            // 
            this.ayarlarToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.yaziciAyarlariToolStripMenuItem});
            this.ayarlarToolStripMenuItem.Name = "ayarlarToolStripMenuItem";
            resources.ApplyResources(this.ayarlarToolStripMenuItem, "ayarlarToolStripMenuItem");
            // 
            // yaziciAyarlariToolStripMenuItem
            // 
            this.yaziciAyarlariToolStripMenuItem.Name = "yaziciAyarlariToolStripMenuItem";
            resources.ApplyResources(this.yaziciAyarlariToolStripMenuItem, "yaziciAyarlariToolStripMenuItem");
            this.yaziciAyarlariToolStripMenuItem.Click += new System.EventHandler(this.yaziciAyarlariToolStripMenuItem_Click);
            // 
            // yardimToolStripMenuItem
            // 
            this.yardimToolStripMenuItem.DropDownItems.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.kisayollarToolStripMenuItem,
            this.hakkindaToolStripMenuItem,
            this.hataRaporuGonderToolStripMenuItem});
            this.yardimToolStripMenuItem.Name = "yardimToolStripMenuItem";
            resources.ApplyResources(this.yardimToolStripMenuItem, "yardimToolStripMenuItem");
            // 
            // kisayollarToolStripMenuItem
            // 
            this.kisayollarToolStripMenuItem.Name = "kisayollarToolStripMenuItem";
            resources.ApplyResources(this.kisayollarToolStripMenuItem, "kisayollarToolStripMenuItem");
            this.kisayollarToolStripMenuItem.Click += new System.EventHandler(this.kisayollarToolStripMenuItem_Click);
            // 
            // hakkindaToolStripMenuItem
            // 
            this.hakkindaToolStripMenuItem.Name = "hakkindaToolStripMenuItem";
            resources.ApplyResources(this.hakkindaToolStripMenuItem, "hakkindaToolStripMenuItem");
            this.hakkindaToolStripMenuItem.Click += new System.EventHandler(this.hakkindaToolStripMenuItem_Click);
            // 
            // hataRaporuGonderToolStripMenuItem
            // 
            this.hataRaporuGonderToolStripMenuItem.Name = "hataRaporuGonderToolStripMenuItem";
            resources.ApplyResources(this.hataRaporuGonderToolStripMenuItem, "hataRaporuGonderToolStripMenuItem");
            this.hataRaporuGonderToolStripMenuItem.Click += new System.EventHandler(this.hataRaporuGonderToolStripMenuItem_Click);
            // 
            // LblWaitingTickets
            // 
            resources.ApplyResources(this.LblWaitingTickets, "LblWaitingTickets");
            this.LblWaitingTickets.ForeColor = System.Drawing.Color.Red;
            this.LblWaitingTickets.Name = "LblWaitingTickets";
            // 
            // label19
            // 
            resources.ApplyResources(this.label19, "label19");
            this.label19.Name = "label19";
            // 
            // label3
            // 
            resources.ApplyResources(this.label3, "label3");
            this.label3.Name = "label3";
            // 
            // GrpBxTicketInf
            // 
            this.GrpBxTicketInf.Controls.Add(this.LblProcessTime);
            this.GrpBxTicketInf.Controls.Add(this.label16);
            this.GrpBxTicketInf.Controls.Add(this.LblIsFiktif);
            this.GrpBxTicketInf.Controls.Add(this.label6);
            this.GrpBxTicketInf.Controls.Add(this.LblIsTransfer);
            this.GrpBxTicketInf.Controls.Add(this.LblIslemSaati);
            this.GrpBxTicketInf.Controls.Add(this.LblSisTar);
            this.GrpBxTicketInf.Controls.Add(this.LblTicketGroupName);
            this.GrpBxTicketInf.Controls.Add(this.label14);
            this.GrpBxTicketInf.Controls.Add(this.label4);
            this.GrpBxTicketInf.Controls.Add(this.label9);
            this.GrpBxTicketInf.Controls.Add(this.LblTicketNo);
            this.GrpBxTicketInf.Controls.Add(this.label15);
            this.GrpBxTicketInf.Controls.Add(this.label2);
            this.GrpBxTicketInf.Controls.Add(this.label12);
            this.GrpBxTicketInf.Controls.Add(this.label13);
            this.GrpBxTicketInf.Controls.Add(this.label11);
            this.GrpBxTicketInf.Controls.Add(this.label10);
            this.GrpBxTicketInf.Controls.Add(this.label8);
            this.GrpBxTicketInf.Controls.Add(this.label7);
            this.GrpBxTicketInf.Controls.Add(this.label5);
            this.GrpBxTicketInf.Controls.Add(this.BtnTransfer);
            this.GrpBxTicketInf.Controls.Add(this.CmbBxTransferGroups);
            resources.ApplyResources(this.GrpBxTicketInf, "GrpBxTicketInf");
            this.GrpBxTicketInf.Name = "GrpBxTicketInf";
            this.GrpBxTicketInf.TabStop = false;
            // 
            // LblProcessTime
            // 
            resources.ApplyResources(this.LblProcessTime, "LblProcessTime");
            this.LblProcessTime.ForeColor = System.Drawing.Color.Red;
            this.LblProcessTime.Name = "LblProcessTime";
            // 
            // label16
            // 
            resources.ApplyResources(this.label16, "label16");
            this.label16.Name = "label16";
            // 
            // LblIsFiktif
            // 
            resources.ApplyResources(this.LblIsFiktif, "LblIsFiktif");
            this.LblIsFiktif.ForeColor = System.Drawing.Color.Red;
            this.LblIsFiktif.Name = "LblIsFiktif";
            // 
            // label6
            // 
            resources.ApplyResources(this.label6, "label6");
            this.label6.Name = "label6";
            // 
            // LblIsTransfer
            // 
            resources.ApplyResources(this.LblIsTransfer, "LblIsTransfer");
            this.LblIsTransfer.ForeColor = System.Drawing.Color.Red;
            this.LblIsTransfer.Name = "LblIsTransfer";
            // 
            // LblIslemSaati
            // 
            resources.ApplyResources(this.LblIslemSaati, "LblIslemSaati");
            this.LblIslemSaati.Name = "LblIslemSaati";
            // 
            // LblSisTar
            // 
            resources.ApplyResources(this.LblSisTar, "LblSisTar");
            this.LblSisTar.Name = "LblSisTar";
            // 
            // LblTicketGroupName
            // 
            resources.ApplyResources(this.LblTicketGroupName, "LblTicketGroupName");
            this.LblTicketGroupName.Name = "LblTicketGroupName";
            // 
            // label14
            // 
            resources.ApplyResources(this.label14, "label14");
            this.label14.Name = "label14";
            // 
            // label4
            // 
            resources.ApplyResources(this.label4, "label4");
            this.label4.Name = "label4";
            // 
            // label9
            // 
            resources.ApplyResources(this.label9, "label9");
            this.label9.Name = "label9";
            // 
            // LblTicketNo
            // 
            resources.ApplyResources(this.LblTicketNo, "LblTicketNo");
            this.LblTicketNo.Name = "LblTicketNo";
            // 
            // label15
            // 
            resources.ApplyResources(this.label15, "label15");
            this.label15.Name = "label15";
            // 
            // label2
            // 
            resources.ApplyResources(this.label2, "label2");
            this.label2.Name = "label2";
            // 
            // label12
            // 
            resources.ApplyResources(this.label12, "label12");
            this.label12.Name = "label12";
            // 
            // label13
            // 
            resources.ApplyResources(this.label13, "label13");
            this.label13.Name = "label13";
            // 
            // label11
            // 
            resources.ApplyResources(this.label11, "label11");
            this.label11.Name = "label11";
            // 
            // label10
            // 
            resources.ApplyResources(this.label10, "label10");
            this.label10.Name = "label10";
            // 
            // label8
            // 
            resources.ApplyResources(this.label8, "label8");
            this.label8.Name = "label8";
            // 
            // label7
            // 
            resources.ApplyResources(this.label7, "label7");
            this.label7.Name = "label7";
            // 
            // label5
            // 
            resources.ApplyResources(this.label5, "label5");
            this.label5.Name = "label5";
            // 
            // BtnTransfer
            // 
            resources.ApplyResources(this.BtnTransfer, "BtnTransfer");
            this.BtnTransfer.Name = "BtnTransfer";
            this.BtnTransfer.UseVisualStyleBackColor = true;
            this.BtnTransfer.Click += new System.EventHandler(this.BtnTransfer_Click);
            // 
            // CmbBxTransferGroups
            // 
            this.CmbBxTransferGroups.DisplayMember = "GRUP_ISMI";
            this.CmbBxTransferGroups.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            resources.ApplyResources(this.CmbBxTransferGroups, "CmbBxTransferGroups");
            this.CmbBxTransferGroups.FormattingEnabled = true;
            this.CmbBxTransferGroups.Name = "CmbBxTransferGroups";
            this.CmbBxTransferGroups.ValueMember = "GRPID";
            this.CmbBxTransferGroups.KeyDown += new System.Windows.Forms.KeyEventHandler(this.CmbBxTransferGroups_KeyDown);
            // 
            // GrpBxQueueInf
            // 
            this.GrpBxQueueInf.Controls.Add(this.BtnClearFilter);
            this.GrpBxQueueInf.Controls.Add(this.TxtBxQueueTicketNo);
            this.GrpBxQueueInf.Controls.Add(this.DGVTicketLists);
            this.GrpBxQueueInf.Controls.Add(this.CmbBxQueueGroups);
            resources.ApplyResources(this.GrpBxQueueInf, "GrpBxQueueInf");
            this.GrpBxQueueInf.Name = "GrpBxQueueInf";
            this.GrpBxQueueInf.TabStop = false;
            // 
            // BtnClearFilter
            // 
            resources.ApplyResources(this.BtnClearFilter, "BtnClearFilter");
            this.BtnClearFilter.Name = "BtnClearFilter";
            this.BtnClearFilter.UseVisualStyleBackColor = true;
            this.BtnClearFilter.Click += new System.EventHandler(this.BtnClearFilter_Click);
            // 
            // TxtBxQueueTicketNo
            // 
            resources.ApplyResources(this.TxtBxQueueTicketNo, "TxtBxQueueTicketNo");
            this.TxtBxQueueTicketNo.ForeColor = System.Drawing.SystemColors.ControlText;
            this.TxtBxQueueTicketNo.Name = "TxtBxQueueTicketNo";
            this.ToolTipForProcess.SetToolTip(this.TxtBxQueueTicketNo, resources.GetString("TxtBxQueueTicketNo.ToolTip"));
            this.TxtBxQueueTicketNo.TextChanged += new System.EventHandler(this.TxtBxQueueTicketNo_TextChanged);
            this.TxtBxQueueTicketNo.Enter += new System.EventHandler(this.TxtBxQueueTicketNo_Enter);
            this.TxtBxQueueTicketNo.Leave += new System.EventHandler(this.TxtBxQueueTicketNo_Leave);
            // 
            // DGVTicketLists
            // 
            this.DGVTicketLists.AllowUserToAddRows = false;
            this.DGVTicketLists.AllowUserToDeleteRows = false;
            dataGridViewCellStyle3.BackColor = System.Drawing.Color.FromArgb(((int)(((byte)(224)))), ((int)(((byte)(224)))), ((int)(((byte)(224)))));
            this.DGVTicketLists.AlternatingRowsDefaultCellStyle = dataGridViewCellStyle3;
            this.DGVTicketLists.BackgroundColor = System.Drawing.SystemColors.Control;
            this.DGVTicketLists.BorderStyle = System.Windows.Forms.BorderStyle.None;
            this.DGVTicketLists.ColumnHeadersBorderStyle = System.Windows.Forms.DataGridViewHeaderBorderStyle.Single;
            this.DGVTicketLists.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.DGVTicketLists.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.BID,
            this.MusteriAdi,
            this.GRPID,
            this.BiletNo,
            this.GRP_AD});
            this.DGVTicketLists.Cursor = System.Windows.Forms.Cursors.Hand;
            resources.ApplyResources(this.DGVTicketLists, "DGVTicketLists");
            this.DGVTicketLists.MultiSelect = false;
            this.DGVTicketLists.Name = "DGVTicketLists";
            this.DGVTicketLists.ReadOnly = true;
            this.DGVTicketLists.RowHeadersBorderStyle = System.Windows.Forms.DataGridViewHeaderBorderStyle.None;
            this.DGVTicketLists.RowHeadersVisible = false;
            dataGridViewCellStyle4.SelectionBackColor = System.Drawing.Color.FromArgb(((int)(((byte)(212)))), ((int)(((byte)(5)))), ((int)(((byte)(24)))));
            this.DGVTicketLists.RowsDefaultCellStyle = dataGridViewCellStyle4;
            this.DGVTicketLists.RowTemplate.Resizable = System.Windows.Forms.DataGridViewTriState.False;
            this.DGVTicketLists.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.ToolTipForProcess.SetToolTip(this.DGVTicketLists, resources.GetString("DGVTicketLists.ToolTip"));
            this.DGVTicketLists.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.DGVTicketLists_CellDoubleClick);
            this.DGVTicketLists.CellMouseEnter += new System.Windows.Forms.DataGridViewCellEventHandler(this.DGVTicketLists_CellMouseEnter);
            this.DGVTicketLists.CellMouseLeave += new System.Windows.Forms.DataGridViewCellEventHandler(this.DGVTicketLists_CellMouseLeave);
            this.DGVTicketLists.DataBindingComplete += new System.Windows.Forms.DataGridViewBindingCompleteEventHandler(this.DGVTicketLists_DataBindingComplete);
            // 
            // BID
            // 
            this.BID.DataPropertyName = "BID";
            resources.ApplyResources(this.BID, "BID");
            this.BID.Name = "BID";
            this.BID.ReadOnly = true;
            // 
            // MusteriAdi
            // 
            this.MusteriAdi.DataPropertyName = "MusteriAdi";
            resources.ApplyResources(this.MusteriAdi, "MusteriAdi");
            this.MusteriAdi.Name = "MusteriAdi";
            this.MusteriAdi.ReadOnly = true;
            // 
            // GRPID
            // 
            this.GRPID.DataPropertyName = "GRPID";
            resources.ApplyResources(this.GRPID, "GRPID");
            this.GRPID.Name = "GRPID";
            this.GRPID.ReadOnly = true;
            // 
            // BiletNo
            // 
            this.BiletNo.DataPropertyName = "BILET_NO";
            resources.ApplyResources(this.BiletNo, "BiletNo");
            this.BiletNo.Name = "BiletNo";
            this.BiletNo.ReadOnly = true;
            // 
            // GRP_AD
            // 
            this.GRP_AD.AutoSizeMode = System.Windows.Forms.DataGridViewAutoSizeColumnMode.Fill;
            this.GRP_AD.DataPropertyName = "GRUP_ISMI";
            resources.ApplyResources(this.GRP_AD, "GRP_AD");
            this.GRP_AD.Name = "GRP_AD";
            this.GRP_AD.ReadOnly = true;
            // 
            // CmbBxQueueGroups
            // 
            this.CmbBxQueueGroups.DisplayMember = "GRUP_ISMI";
            this.CmbBxQueueGroups.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.CmbBxQueueGroups.FormattingEnabled = true;
            resources.ApplyResources(this.CmbBxQueueGroups, "CmbBxQueueGroups");
            this.CmbBxQueueGroups.Name = "CmbBxQueueGroups";
            this.CmbBxQueueGroups.ValueMember = "GRPID";
            this.CmbBxQueueGroups.SelectedIndexChanged += new System.EventHandler(this.CmbBxQueueGroups_SelectedIndexChanged);
            this.CmbBxQueueGroups.KeyDown += new System.Windows.Forms.KeyEventHandler(this.CmbBxTransferGroups_KeyDown);
            // 
            // PnlMiddle
            // 
            this.PnlMiddle.Controls.Add(this.GrpBxQueueInf);
            this.PnlMiddle.Controls.Add(this.GrpBxTicketInf);
            resources.ApplyResources(this.PnlMiddle, "PnlMiddle");
            this.PnlMiddle.Name = "PnlMiddle";
            // 
            // PnlBottom
            // 
            this.PnlBottom.Controls.Add(this.panel1);
            this.PnlBottom.Controls.Add(this.GrpBxProcess);
            resources.ApplyResources(this.PnlBottom, "PnlBottom");
            this.PnlBottom.Name = "PnlBottom";
            // 
            // panel1
            // 
            this.panel1.Controls.Add(this.GrpBxFiktif);
            resources.ApplyResources(this.panel1, "panel1");
            this.panel1.Name = "panel1";
            // 
            // GrpBxFiktif
            // 
            this.GrpBxFiktif.Controls.Add(this.ChckBxFiktifCurrentTicket);
            this.GrpBxFiktif.Controls.Add(this.LblFiktifError);
            this.GrpBxFiktif.Controls.Add(this.LblFiktifTicketNumber);
            this.GrpBxFiktif.Controls.Add(this.BtnFiktif);
            this.GrpBxFiktif.Controls.Add(this.CmbBxFiktifGroups);
            resources.ApplyResources(this.GrpBxFiktif, "GrpBxFiktif");
            this.GrpBxFiktif.Name = "GrpBxFiktif";
            this.GrpBxFiktif.TabStop = false;
            // 
            // ChckBxFiktifCurrentTicket
            // 
            resources.ApplyResources(this.ChckBxFiktifCurrentTicket, "ChckBxFiktifCurrentTicket");
            this.ChckBxFiktifCurrentTicket.Name = "ChckBxFiktifCurrentTicket";
            this.ChckBxFiktifCurrentTicket.UseVisualStyleBackColor = true;
            // 
            // LblFiktifError
            // 
            resources.ApplyResources(this.LblFiktifError, "LblFiktifError");
            this.LblFiktifError.ForeColor = System.Drawing.Color.Red;
            this.LblFiktifError.Name = "LblFiktifError";
            // 
            // LblFiktifTicketNumber
            // 
            resources.ApplyResources(this.LblFiktifTicketNumber, "LblFiktifTicketNumber");
            this.LblFiktifTicketNumber.BackColor = System.Drawing.SystemColors.ButtonHighlight;
            this.LblFiktifTicketNumber.Name = "LblFiktifTicketNumber";
            // 
            // BtnFiktif
            // 
            resources.ApplyResources(this.BtnFiktif, "BtnFiktif");
            this.BtnFiktif.Name = "BtnFiktif";
            this.BtnFiktif.UseVisualStyleBackColor = true;
            this.BtnFiktif.Click += new System.EventHandler(this.BtnFiktif_Click);
            // 
            // CmbBxFiktifGroups
            // 
            this.CmbBxFiktifGroups.DisplayMember = "GRUP_ISMI";
            this.CmbBxFiktifGroups.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.CmbBxFiktifGroups.FormattingEnabled = true;
            resources.ApplyResources(this.CmbBxFiktifGroups, "CmbBxFiktifGroups");
            this.CmbBxFiktifGroups.Name = "CmbBxFiktifGroups";
            this.CmbBxFiktifGroups.ValueMember = "GRPID";
            // 
            // GrpBxProcess
            // 
            this.GrpBxProcess.Controls.Add(this.btnParkGoster);
            this.GrpBxProcess.Controls.Add(this.btnPark);
            this.GrpBxProcess.Controls.Add(this.LblSysInfo);
            this.GrpBxProcess.Controls.Add(this.label17);
            this.GrpBxProcess.Controls.Add(this.BtnMola);
            this.GrpBxProcess.Controls.Add(this.BtnOutOfService);
            this.GrpBxProcess.Controls.Add(this.BtnReCallTicket);
            this.GrpBxProcess.Controls.Add(this.BtnNextTicket);
            this.GrpBxProcess.Controls.Add(this.label18);
            resources.ApplyResources(this.GrpBxProcess, "GrpBxProcess");
            this.GrpBxProcess.Name = "GrpBxProcess";
            this.GrpBxProcess.TabStop = false;
            // 
            // btnParkGoster
            // 
            this.btnParkGoster.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.btnParkGoster.BackgroundImage = global::QVU.Properties.Resources.refresh;
            resources.ApplyResources(this.btnParkGoster, "btnParkGoster");
            this.btnParkGoster.FlatAppearance.BorderColor = System.Drawing.SystemColors.ActiveCaption;
            this.btnParkGoster.FlatAppearance.MouseDownBackColor = System.Drawing.Color.SkyBlue;
            this.btnParkGoster.FlatAppearance.MouseOverBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.btnParkGoster.Name = "btnParkGoster";
            this.ToolTipForProcess.SetToolTip(this.btnParkGoster, resources.GetString("btnParkGoster.ToolTip"));
            this.btnParkGoster.UseVisualStyleBackColor = false;
            this.btnParkGoster.Click += new System.EventHandler(this.btnParkGoster_Click);
            // 
            // btnPark
            // 
            this.btnPark.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.btnPark.BackgroundImage = global::QVU.Properties.Resources.redo;
            resources.ApplyResources(this.btnPark, "btnPark");
            this.btnPark.FlatAppearance.BorderColor = System.Drawing.SystemColors.ActiveCaption;
            this.btnPark.FlatAppearance.MouseDownBackColor = System.Drawing.Color.SkyBlue;
            this.btnPark.FlatAppearance.MouseOverBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.btnPark.Name = "btnPark";
            this.ToolTipForProcess.SetToolTip(this.btnPark, resources.GetString("btnPark.ToolTip"));
            this.btnPark.UseVisualStyleBackColor = false;
            this.btnPark.Click += new System.EventHandler(this.btnPark_Click);
            // 
            // LblSysInfo
            // 
            resources.ApplyResources(this.LblSysInfo, "LblSysInfo");
            this.LblSysInfo.ForeColor = System.Drawing.Color.Red;
            this.LblSysInfo.Name = "LblSysInfo";
            // 
            // label17
            // 
            resources.ApplyResources(this.label17, "label17");
            this.label17.Name = "label17";
            // 
            // BtnMola
            // 
            this.BtnMola.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.BtnMola.BackgroundImage = global::QVU.Properties.Resources.Mola;
            resources.ApplyResources(this.BtnMola, "BtnMola");
            this.BtnMola.FlatAppearance.BorderColor = System.Drawing.SystemColors.ActiveCaption;
            this.BtnMola.FlatAppearance.MouseDownBackColor = System.Drawing.Color.SkyBlue;
            this.BtnMola.FlatAppearance.MouseOverBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.BtnMola.Name = "BtnMola";
            this.ToolTipForProcess.SetToolTip(this.BtnMola, resources.GetString("BtnMola.ToolTip"));
            this.BtnMola.UseVisualStyleBackColor = false;
            this.BtnMola.Click += new System.EventHandler(this.BtnMola_Click);
            // 
            // BtnOutOfService
            // 
            this.BtnOutOfService.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.BtnOutOfService.BackgroundImage = global::QVU.Properties.Resources.OutOfService3;
            resources.ApplyResources(this.BtnOutOfService, "BtnOutOfService");
            this.BtnOutOfService.FlatAppearance.BorderColor = System.Drawing.SystemColors.ActiveCaption;
            this.BtnOutOfService.FlatAppearance.MouseDownBackColor = System.Drawing.Color.SkyBlue;
            this.BtnOutOfService.FlatAppearance.MouseOverBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.BtnOutOfService.Name = "BtnOutOfService";
            this.ToolTipForProcess.SetToolTip(this.BtnOutOfService, resources.GetString("BtnOutOfService.ToolTip"));
            this.BtnOutOfService.UseVisualStyleBackColor = false;
            this.BtnOutOfService.Click += new System.EventHandler(this.BtnOutOfService_Click);
            // 
            // BtnReCallTicket
            // 
            this.BtnReCallTicket.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.BtnReCallTicket.BackgroundImage = global::QVU.Properties.Resources.ReCallTicketNumber;
            resources.ApplyResources(this.BtnReCallTicket, "BtnReCallTicket");
            this.BtnReCallTicket.FlatAppearance.BorderColor = System.Drawing.SystemColors.ActiveCaption;
            this.BtnReCallTicket.FlatAppearance.MouseDownBackColor = System.Drawing.Color.SkyBlue;
            this.BtnReCallTicket.FlatAppearance.MouseOverBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.BtnReCallTicket.Name = "BtnReCallTicket";
            this.ToolTipForProcess.SetToolTip(this.BtnReCallTicket, resources.GetString("BtnReCallTicket.ToolTip"));
            this.BtnReCallTicket.UseVisualStyleBackColor = false;
            this.BtnReCallTicket.Click += new System.EventHandler(this.BtnReCallTicket_Click);
            // 
            // BtnNextTicket
            // 
            this.BtnNextTicket.BackColor = System.Drawing.SystemColors.InactiveCaption;
            this.BtnNextTicket.BackgroundImage = global::QVU.Properties.Resources.NextTicket;
            resources.ApplyResources(this.BtnNextTicket, "BtnNextTicket");
            this.BtnNextTicket.FlatAppearance.BorderColor = System.Drawing.SystemColors.ActiveCaption;
            this.BtnNextTicket.FlatAppearance.MouseDownBackColor = System.Drawing.Color.SkyBlue;
            this.BtnNextTicket.FlatAppearance.MouseOverBackColor = System.Drawing.SystemColors.GradientInactiveCaption;
            this.BtnNextTicket.Name = "BtnNextTicket";
            this.ToolTipForProcess.SetToolTip(this.BtnNextTicket, resources.GetString("BtnNextTicket.ToolTip"));
            this.BtnNextTicket.UseVisualStyleBackColor = false;
            this.BtnNextTicket.Click += new System.EventHandler(this.BtnNextTicket_Click);
            // 
            // label18
            // 
            resources.ApplyResources(this.label18, "label18");
            this.label18.Name = "label18";
            // 
            // TmrTicketProcessCounter
            // 
            this.TmrTicketProcessCounter.Interval = 1000;
            this.TmrTicketProcessCounter.Tick += new System.EventHandler(this.TmrTicketProcessCounter_Tick);
            // 
            // TmrOtoTicketCall
            // 
            this.TmrOtoTicketCall.Interval = 5000;
            this.TmrOtoTicketCall.Tick += new System.EventHandler(this.TmrOtoTicketCall_Tick);
            // 
            // TmrFiktifEffects
            // 
            this.TmrFiktifEffects.Interval = 500;
            this.TmrFiktifEffects.Tick += new System.EventHandler(this.TmrFiktifEffects_Tick);
            // 
            // printDialog1
            // 
            this.printDialog1.Document = this.printDocument1;
            this.printDialog1.UseEXDialog = true;
            // 
            // printDocument1
            // 
            this.printDocument1.PrintPage += new System.Drawing.Printing.PrintPageEventHandler(this.printDocument1_PrintPage);
            // 
            // TmrForMakeLine
            // 
            this.TmrForMakeLine.Interval = 10000;
            this.TmrForMakeLine.Tick += new System.EventHandler(this.TmrForMakeLine_Tick);
            // 
            // TmrWaitingCountRefresh
            // 
            this.TmrWaitingCountRefresh.Enabled = true;
            this.TmrWaitingCountRefresh.Interval = 5000;
            this.TmrWaitingCountRefresh.Tick += new System.EventHandler(this.TmrNewTicketCheck_Tick);
            // 
            // timerBiletBitti
            // 
            this.timerBiletBitti.Interval = 1000;
            this.timerBiletBitti.Tick += new System.EventHandler(this.timerBiletBitti_Tick);
            // 
            // FrmVirtualTerminal
            // 
            resources.ApplyResources(this, "$this");
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.Controls.Add(this.PnlBottom);
            this.Controls.Add(this.PnlMiddle);
            this.Controls.Add(this.PnlTop);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.KeyPreview = true;
            this.MainMenuStrip = this.MenuStripTop;
            this.MaximizeBox = false;
            this.Name = "FrmVirtualTerminal";
            this.TopMost = true;
            this.FormClosing += new System.Windows.Forms.FormClosingEventHandler(this.FrmVirtualTerminal_FormClosing);
            this.Load += new System.EventHandler(this.FrmVirtualTerminal_Load);
            this.KeyDown += new System.Windows.Forms.KeyEventHandler(this.FrmVirtualTerminal_KeyDown);
            this.PnlTop.ResumeLayout(false);
            this.PnlTop.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.PctrBxHaveNotWaitings)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.PctrBxHaveWaitings)).EndInit();
            this.MenuStripTop.ResumeLayout(false);
            this.MenuStripTop.PerformLayout();
            this.GrpBxTicketInf.ResumeLayout(false);
            this.GrpBxTicketInf.PerformLayout();
            this.GrpBxQueueInf.ResumeLayout(false);
            this.GrpBxQueueInf.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.DGVTicketLists)).EndInit();
            this.PnlMiddle.ResumeLayout(false);
            this.PnlBottom.ResumeLayout(false);
            this.panel1.ResumeLayout(false);
            this.GrpBxFiktif.ResumeLayout(false);
            this.GrpBxFiktif.PerformLayout();
            this.GrpBxProcess.ResumeLayout(false);
            this.GrpBxProcess.PerformLayout();
            this.ResumeLayout(false);

		}

		#endregion

		private System.Windows.Forms.Panel PnlTop;
		private System.Windows.Forms.Label label3;
		private System.Windows.Forms.Label LblWaitingTickets;
		private System.Windows.Forms.GroupBox GrpBxTicketInf;
		private System.Windows.Forms.GroupBox GrpBxQueueInf;
		private System.Windows.Forms.Panel PnlMiddle;
        private System.Windows.Forms.Panel PnlBottom;
		private System.Windows.Forms.Button BtnTransfer;
        private System.Windows.Forms.ComboBox CmbBxTransferGroups;
		private System.Windows.Forms.GroupBox GrpBxProcess;
		private System.Windows.Forms.Button BtnNextTicket;
		private System.Windows.Forms.Button BtnReCallTicket;
		private System.Windows.Forms.ToolTip ToolTipForProcess;
		private System.Windows.Forms.Label LblIsFiktif;
		private System.Windows.Forms.Label LblTicketNo;
		private System.Windows.Forms.Label label6;
		private System.Windows.Forms.Label label5;
		private System.Windows.Forms.Label LblSisTar;
		private System.Windows.Forms.Label LblTicketGroupName;
		private System.Windows.Forms.Label label9;
		private System.Windows.Forms.Label label2;
		private System.Windows.Forms.Label LblIsTransfer;
		private System.Windows.Forms.Label label4;
		private System.Windows.Forms.Label label12;
		private System.Windows.Forms.Label label11;
		private System.Windows.Forms.Label label10;
		private System.Windows.Forms.Label label8;
		private System.Windows.Forms.Label label7;
		private System.Windows.Forms.Label LblIslemSaati;
		private System.Windows.Forms.Label label14;
        private System.Windows.Forms.Label label13;
		private System.Windows.Forms.MenuStrip MenuStripTop;
		private System.Windows.Forms.Button BtnOutOfService;
		private System.Windows.Forms.Button BtnMola;
		private System.Windows.Forms.TextBox TxtBxQueueTicketNo;
		private System.Windows.Forms.DataGridView DGVTicketLists;
		private System.Windows.Forms.ComboBox CmbBxQueueGroups;
        private System.Windows.Forms.Button BtnClearFilter;
		private System.Windows.Forms.ToolStripMenuItem ayarlarToolStripMenuItem;
		private System.Windows.Forms.ToolStripMenuItem yaziciAyarlariToolStripMenuItem;
		private System.Windows.Forms.ToolStripMenuItem yardimToolStripMenuItem;
		private System.Windows.Forms.ToolStripMenuItem kisayollarToolStripMenuItem;
		private System.Windows.Forms.ToolStripMenuItem hakkindaToolStripMenuItem;
        private System.Windows.Forms.ToolStripMenuItem hataRaporuGonderToolStripMenuItem;
		private System.Windows.Forms.Label LblProcessTime;
		private System.Windows.Forms.Label label16;
		private System.Windows.Forms.Label label15;
        private System.Windows.Forms.Timer TmrTicketProcessCounter;
		private System.Windows.Forms.Timer TmrOtoTicketCall;
		private System.Windows.Forms.Timer TmrFiktifEffects;
		private System.Windows.Forms.Label LblSysInfo;
		private System.Windows.Forms.Label label17;
		private System.Windows.Forms.Label label18;
		private System.Windows.Forms.PrintDialog printDialog1;
		private System.Drawing.Printing.PrintDocument printDocument1;
		private System.Windows.Forms.CheckBox ChckBxMinMax;
		private System.Windows.Forms.PictureBox PctrBxHaveWaitings;
		private System.Windows.Forms.PictureBox PctrBxHaveNotWaitings;
		private System.Windows.Forms.Timer TmrForMakeLine;
		private System.Windows.Forms.Label LblCallingCount;
		private System.Windows.Forms.Label label19;
        private System.Windows.Forms.Timer TmrWaitingCountRefresh;
        private System.Windows.Forms.Panel panel1;
        private System.Windows.Forms.GroupBox GrpBxFiktif;
        private System.Windows.Forms.CheckBox ChckBxFiktifCurrentTicket;
        private System.Windows.Forms.Label LblFiktifError;
        private System.Windows.Forms.Label LblFiktifTicketNumber;
        private System.Windows.Forms.Button BtnFiktif;
        private System.Windows.Forms.ComboBox CmbBxFiktifGroups;
        private System.Windows.Forms.Label lblBitikBiletliKiosk;
        private System.Windows.Forms.Timer timerBiletBitti;
        private System.Windows.Forms.Button btnTagSifirla;
        private System.Windows.Forms.Button btnParkGoster;
        private System.Windows.Forms.Button btnPark;
        private System.Windows.Forms.DataGridViewTextBoxColumn BID;
        private System.Windows.Forms.DataGridViewTextBoxColumn MusteriAdi;
        private System.Windows.Forms.DataGridViewTextBoxColumn GRPID;
        private System.Windows.Forms.DataGridViewTextBoxColumn BiletNo;
        private System.Windows.Forms.DataGridViewTextBoxColumn GRP_AD;
    }
}
