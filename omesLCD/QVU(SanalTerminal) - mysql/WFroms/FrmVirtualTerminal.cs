using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Printing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Windows.Forms;
using QVU.Classes;
using QVU.Classes.Objects;
using QVU.Classes.CommonProcess;
using QVU.Classes.QueueLayer;
using QVU.Classes.DBLayer;
using QVU.Classes.QueueLayer.EventArgsClasses;
using QVU.Classes.TicketLayer;
using System.Collections;
using QVU.Library.Classes;
using QVU.Classes.OtherProcess;
using System.Globalization;
using QVU.Classes.SocketCommunicateLayer;
using QVU.Properties;
using Grup = QVU.Classes.Objects.Grup;
using Settings = QVU.Classes.Settings;

namespace QVU.WFroms
{
    public partial class FrmVirtualTerminal : Form
    {
        string language;
        public FrmVirtualTerminal()
        {
            InitializeComponent();

            Text = string.Format(
                "Virtual Terminal - [{0} {1} {2}] - {3}",
                SanalTerminal.PersonelAd,
                SanalTerminal.PersonelSoyad,
                SanalTerminal.TerminalAdi,
                " OMES "
                );
        }

        #region Common/Public Variables

        private Kuyruk _kuyruk;
        private Mola _startCoffeeBreak;
        private Servis _closeAndOpenService;
        private string _fiktifPrintTicketNo;
        public DataTable ParkingTickets { get; set; }

        #endregion

        #region UPDATED NOT

        #endregion.

        #region Events

        private void ChangeLanguage()
        {
            //var ci = new CultureInfo(lang);
            //var ci = Application.CurrentCulture;
            var ci = System.Threading.Thread.CurrentThread.CurrentUICulture;// = ci;
            foreach (Control c in this.Controls)
            {
                ComponentResourceManager resources = new ComponentResourceManager(this.GetType());
                resources.ApplyResources(c, c.Name, ci);
                if (c.GetType() == typeof(DataGridView))
                {
                    var dgv = (DataGridView)c;
                    foreach (DataGridViewColumn col in dgv.Columns)
                    {
                        resources.ApplyResources(col, col.Name);
                    }
                }
            }
        }

        private void FrmVirtualTerminal_Load(object sender, EventArgs e)
        {
            ChangeLanguage();

            DataTable dtGroups = Grup.LoadToControl();
            string cbGrupText = "";
            string cbBiletText = "";


            if (Thread.CurrentThread.CurrentUICulture.Name == "tr-TR")
            {
                cbGrupText = "Lütfen Grup Seçiniz...";
                cbBiletText = "Tüm Biletler...";
            }
            else
            {
                cbGrupText = "Select Group...";
                cbBiletText = "All Tickets...";
            }

            CommonProcess.LoadDataToComboBox(CmbBxTransferGroups, dtGroups, cbGrupText);
            CommonProcess.LoadDataToComboBox(CmbBxFiktifGroups, dtGroups, cbGrupText);
            CommonProcess.LoadDataToComboBox(CmbBxQueueGroups, dtGroups, cbBiletText);

            _kuyruk = new Kuyruk(SanalTerminal.TerminalID);
            _kuyruk.NextTicketDetected += kuyruk_NextTicketDetected;

            _kuyruk.NotTicketDetected += kuyruk_NotTicketDetected;

            _kuyruk.TicketCallingFalied += kuyruk_TicketCallingFalied;

            _kuyruk.terminal.StatementChanged += terminal_StatementChanged;

            _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

            if (Thread.CurrentThread.CurrentUICulture.Name == "tr-TR")
                NotifiyCurrentState("Boşta...", Color.Red);
            else
                NotifiyCurrentState("Idle...", Color.Red);

            LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();

            SetWaitingLamb();

            DataTable dtTerminalGroups = TerminalGrup.GetGroupOfTerminal(SanalTerminal.TerminalID.ToString());
            if (dtTerminalGroups.Rows.Count > 0)
            {
                string strWhereForTermGroup = string.Empty;

                for (int i = 0; i < dtTerminalGroups.Rows.Count; i++)
                {
                    strWhereForTermGroup = string.Format(
                        "{0} (KUYRUK.GRPID= {1}) OR", strWhereForTermGroup, dtTerminalGroups.Rows[i][0]);
                }
                strWhereForTermGroup = strWhereForTermGroup.Substring(0, strWhereForTermGroup.Length - 2);

                DGVTicketLists.DataSource = GetAllTickets(strWhereForTermGroup);
            }


            if (DGVTicketLists.Rows.Count > 0) DGVTicketLists.Rows[0].Selected = false;

            if (SanalTerminal.OtomatikCagri)
            {
                TmrOtoTicketCall.Interval = SanalTerminal.OtomatikCagriSuresi;
                TmrOtoTicketCall.Start();
            }


            _startCoffeeBreak = new Mola();
            _closeAndOpenService = new Servis();
            ChckBxMinMax.Checked = true;
            Location = new Point(0, Location.Y);

            ParkingTickets = new DataTable();
            ParkingTickets.Columns.Add("BID", typeof(int));
            ParkingTickets.Columns.Add("GRPID", typeof(int));
            ParkingTickets.Columns.Add("BiletNo", typeof(string));

            LblCallingCount.Text = _kuyruk.terminal.GetCalledTicketCount().ToString();
        }


        #region Bilet cagirma eventleri

        private void BtnNextTicket_Click(object sender, EventArgs e)
        {
            BtnNextTicket.Enabled = false;
            ClearTicketInf();
            _kuyruk.DetectAndSendNextTicket();

            //250ms bekle
            //Thread.Sleep(250);
            //if (LblTicketNo.Tag != null)
            //{
            //    TCPIPCommunicating.ReCallTicket(int.Parse(LblTicketNo.Tag.ToString()), _kuyruk.terminal.ElTerminalID);
            //}

            BtnNextTicket.Enabled = true;
        }

        private void kuyruk_NextTicketDetected(NextTicketDetectedEventArgs args)
        {
            LblIsFiktif.Text = (args.Fiktif) ? "Yes" : "No";
            LblIsTransfer.Text = (args.Transfer) ? "Yes" : "No";
            LblSisTar.Text = args.AlinmaTarihi.ToString("HH:mm:ss");
            LblIslemSaati.Text = args.IslemSaati.ToString("HH:mm:ss");
            LblTicketGroupName.Text = args.GrupAdi;
            LblTicketGroupName.Tag = args.GrupID;
            LblTicketNo.Text = args.BiletNo.ToString();
            LblTicketNo.Tag = args.BiletNo;
            LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();
            LblSisTar.Tag = args.BiletID;
            SetWaitingLamb();
            DGVTicketLists.DataSource = GetAllTickets("");
            SetEnabledForTransferControls(true);
            TmrOtoTicketCall.Stop();
            //TmrWaitingCountRefresh.Stop();
            LblProcessTime.Text = "00:00:00";
            TmrTicketProcessCounter.Start();

            NotifiyCurrentState("Busy...", Color.Green);
            LblCallingCount.Text = (int.Parse(LblCallingCount.Text) + 1).ToString();
        }

        private void kuyruk_NotTicketDetected()
        {
            LblWaitingTickets.Text = "0";
            SetWaitingLamb();
            SetEnabledForTransferControls(false);
            TmrOtoTicketCall.Start();
            TmrTicketProcessCounter.Stop();

            NotifiyCurrentState("idled...", Color.Red);

            LblTicketNo.Tag = null;
            TCPIPCommunicating.NotExistWaitingResponse(_kuyruk.terminal.ElTerminalID);
        }

        private void kuyruk_TicketCallingFalied()
        {
            MessageBox.Show(
                string.Format("{0}{1}{2}", "The QPU Server cannot be get at.",
                    Environment.NewLine,
                    "Make sure the Server program is running."),
                Settings.MessageBoxTitle,
                MessageBoxButtons.OK,
                MessageBoxIcon.Warning
                );
            TmrTicketProcessCounter.Stop();
        }

        private void TmrTicketProcessCounter_Tick(object sender, EventArgs e)
        {
            LblProcessTime.Text = DateTime.Parse(LblProcessTime.Text).AddSeconds(1).ToLongTimeString();
        }

        private void TmrOtoTicketCall_Tick(object sender, EventArgs e)
        {
            if (!SanalTerminal.OtomatikCagri)
            {
                TmrOtoTicketCall.Stop();
                return;
            }

            SetEnabledCommonControls(false);
            BtnNextTicket.Enabled = true;
            BtnNextTicket.PerformClick();
            SetEnabledCommonControls(true);
        }

        private void TmrNewTicketCheck_Tick(object sender, EventArgs e)
        {
            int selectedRowIndex = 0;
            try
            {
                selectedRowIndex = DGVTicketLists.SelectedRows[0].Index;
            }
            catch
            {
                //
            }

            //bitik rulo
            int bitikId = _kuyruk.GetBitikBilet();
            if (bitikId > 0)
            {
                lblBitikBiletliKiosk.Text = bitikId.ToString() + " Kiosk tag is finished.";
                btnTagSifirla.Visible = true;
                timerBiletBitti.Enabled = true;
            }
            else
            {
                lblBitikBiletliKiosk.Text = "";
                btnTagSifirla.Visible = false;
                timerBiletBitti.Enabled = false;
            }

            LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();
            SetWaitingLamb();

            string strWhereSQL = " 1=1 ";
            if (CmbBxQueueGroups.SelectedIndex != 0)
            {
                strWhereSQL = string.Format("KUYRUK.GRPID = {0}", CmbBxQueueGroups.SelectedValue.ToString());
            }

            DGVTicketLists.DataSource = GetAllTickets(strWhereSQL);
            try
            {
                DGVTicketLists.Rows[selectedRowIndex].Selected = true;
            }
            catch
            {
                //
            }

            if (LblWaitingTickets.Text != "0")
            {
                //TmrWaitingCountRefresh.Stop();
            }
        }

        #endregion


        #region Transfer eventleri

        private void BtnTransfer_Click(object sender, EventArgs e)
        {
            if (CmbBxTransferGroups.SelectedIndex == 0)
            {
                MessageBox.Show(
                    "Please select the group to transfer the ticket to!", "Visual Terminal - Warning",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning
                    );
                return;
            }
            else if (CmbBxTransferGroups.SelectedValue.ToString() == LblTicketGroupName.Tag.ToString())
            {
                MessageBox.Show(
                    "This ticket is a ticket belonging to the group you already selected!"
                    + Environment.NewLine
                    + "Please select a different group from the group where the ticket is located for the transfer.",
                    "Virtual Terminal - Warning",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning
                    );
                return;
            }

            BtnTransfer.Text = "Ticket is being transported...";
            SetEnabledForTransferControls(false);
            Bilet ticketTransfer = CreateTicket(
                int.Parse(CmbBxTransferGroups.SelectedValue.ToString()),
                true,
                false,
                int.Parse(LblTicketNo.Tag.ToString())
                );

            Hashtable hshNewTransferTicket = ticketTransfer.New();

            if (!hshNewTransferTicket.ContainsKey("Error"))
            {
                _kuyruk.HasNotTicket();
                LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();
                SetWaitingLamb();
                ClearTicketInf();
                DGVTicketLists.DataSource = GetAllTickets("");
                LblTicketNo.Text = "Ticket transfer is complete";
                CmbBxTransferGroups.SelectedIndex = 0;

                TmrTicketProcessCounter.Stop();
                TmrOtoTicketCall.Start();
                NotifiyCurrentState("idled...", Color.Red);
            }
            else
            {
                LblTicketNo.Text = "There was a mistake in the ticket transfer process.";
                LblTicketGroupName.Text = "Please try again the transfer process.";
                SetEnabledForTransferControls(true);
            }

            BtnTransfer.Text = "Transfer Ticket";
        }

        #endregion


        #region Fiktif bilet eventleri

        private void BtnFiktif_Click(object sender, EventArgs e)
        {
            if (CmbBxFiktifGroups.SelectedIndex == 0)
            {
                MessageBox.Show(
                    "Please select the group in which the fictitious ticket will be produced!", "Virtual Terminal - Uyarı",
                    MessageBoxButtons.OK,
                    MessageBoxIcon.Warning
                    );
                return;
            }


            BtnFiktif.Enabled = false;

            Bilet ticketFiktif = CreateTicket(int.Parse(CmbBxFiktifGroups.SelectedValue.ToString()),
                false,
                true,
                GetNextFiktifTicketNumber()
                );

            Hashtable hshFiktif = ticketFiktif.New();
            if (!hshFiktif.ContainsKey("Error"))
            {
                LblFiktifTicketNumber.Text = ticketFiktif.BiletNo.ToString();
                if (ChckBxFiktifCurrentTicket.Checked)
                {
                    _kuyruk.HasNotTicket();
                    LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();
                    SetWaitingLamb();

                    ClearTicketInf();
                    SetEnabledForTransferControls(false);
                    TmrTicketProcessCounter.Stop();
                    NotifiyCurrentState("idled...", Color.Red);
                    _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

                    TmrOtoTicketCall.Start();
                }

                PrintFiktifTicket(ticketFiktif.BiletNo);
                DGVTicketLists.DataSource = GetAllTickets("");
            }
            else
            {
                LblFiktifError.Text = "A mistake has occurred in the process of producing a fictitious ticket.";
                LblFiktifError.Text += "\nPlease try again.";
            }

            BtnFiktif.Enabled = true;
        }

        private void printDocument1_PrintPage(object sender, PrintPageEventArgs e)
        {
            Font f = new Font("Verdana", 10);
            StringFormat strFrmtCenter = new StringFormat();
            strFrmtCenter.LineAlignment = StringAlignment.Center;
            strFrmtCenter.Alignment = StringAlignment.Near;

            e.Graphics.DrawString(((DataRowView)CmbBxFiktifGroups.SelectedItem).Row["GRUP_ISMI"].ToString(),
                f, Brushes.Black, 2, 2);

            e.Graphics.DrawString(_fiktifPrintTicketNo, new Font("Tahoma", 60), Brushes.Black, 2, 10);

            e.Graphics.DrawString(DateTime.Now.ToString("dd/mm/yyyy HH:mm"), f, Brushes.Black, 10, 120, strFrmtCenter);

            e.Graphics.DrawString(CultureInfo.CurrentCulture.DateTimeFormat.DayNames[(int)DateTime.Now.DayOfWeek],
                f, Brushes.Black, 10, 140, strFrmtCenter);

            _fiktifPrintTicketNo = string.Empty;
        }

        #endregion


        #region Tum biletlerin listesi ile ilgili eventler, filtreleme, renk ayarlari, bilet cagirma etc.

        private void DGVTicketLists_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            if (!SanalTerminal.DoubleClick) return; // double clikc aktif değilse çağırma.

            if (e.RowIndex <= -1)
            {
                return;
            }

            DGVTicketLists.Enabled = false;
            int TicketID, TicketNo, GroupID;
            bool IsAssistGroup, IsMainGroup, IsTransferTicket, IsFiktifTicket;
            DataGridViewRow dgvRowTicket = DGVTicketLists.Rows[e.RowIndex];
            TicketID = int.Parse(dgvRowTicket.Cells["BID"].Value.ToString());
            TicketNo = int.Parse(dgvRowTicket.Cells["BiletNo"].Value.ToString());
            GroupID = int.Parse(dgvRowTicket.Cells["GRPID"].Value.ToString());

            IsMainGroup = TerminalHasThisGroup(dgvRowTicket.Cells["GRPID"].Value.ToString(), out IsAssistGroup);
            IsTransferOrFiktifTicket(TicketID, out IsTransferTicket, out IsFiktifTicket);

            _kuyruk.KillTicket();
            _kuyruk.CallTicketManuel(TicketNo, TicketID, GroupID, IsTransferTicket,
                IsFiktifTicket, IsAssistGroup, IsMainGroup);

            LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();

            SetWaitingLamb();
            DGVTicketLists.Enabled = true;
        }

        private void TxtBxQueueTicketNo_TextChanged(object sender, EventArgs e)
        {
            if (Thread.CurrentThread.CurrentUICulture.Name == "tr-TR")
            {

                if (!string.IsNullOrEmpty(TxtBxQueueTicketNo.Text.Trim()))
                {
                    BtnClearFilter.Text = "Getir";
                    TmrWaitingCountRefresh.Enabled = false;
                }
                else
                {
                    BtnClearFilter.Text = "Tümü";
                    TmrWaitingCountRefresh.Enabled = true;
                }
            }
            else
            {
                if (!string.IsNullOrEmpty(TxtBxQueueTicketNo.Text.Trim()))
                {
                    BtnClearFilter.Text = "brought";
                    TmrWaitingCountRefresh.Enabled = false;
                }
                else
                {
                    BtnClearFilter.Text = "all of";
                    TmrWaitingCountRefresh.Enabled = true;
                }
            }
        }

        private void CmbBxQueueGroups_SelectedIndexChanged(object sender, EventArgs e)
        {
            string strWhereSQL = string.Empty;
            if (CmbBxQueueGroups.SelectedIndex != 0)
            {
                strWhereSQL = string.Format("KUYRUK.GRPID = {0}", CmbBxQueueGroups.SelectedValue.ToString());

                if (!string.IsNullOrEmpty(TxtBxQueueTicketNo.Text.Trim()))
                {
                    strWhereSQL = string.Format(
                        "{0} AND  KUYRUK.BILET_NO = {1}",
                        strWhereSQL,
                        TxtBxQueueTicketNo.Text.Trim()
                        );
                }
                DGVTicketLists.DataSource = GetAllTickets(strWhereSQL);
            }
            else
            {
                TxtBxQueueTicketNo.Text = string.Empty;
                DGVTicketLists.DataSource = GetAllTickets("");

            }
        }

        private void BtnClearFilter_Click(object sender, EventArgs e)
        {
            switch (BtnClearFilter.Text)
            {
                case "Getir":
                    DGVTicketLists.DataSource =
                        GetAllTickets(string.Format("KUYRUK.BILET_NO = {0}", TxtBxQueueTicketNo.Text.Trim())
                            );
                    TxtBxQueueTicketNo.Text = string.Empty;
                    break;

                case "Tümü":
                    if (CmbBxQueueGroups.SelectedIndex != 0)
                    {
                        CmbBxQueueGroups.SelectedIndex = 0;
                    }
                    else
                    {
                        DGVTicketLists.DataSource = GetAllTickets("");

                    }
                    break;
            }
        }

        private void DGVTicketLists_CellMouseEnter(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex == -1)
            {
                return;
            }

            DGVTicketLists.Rows[e.RowIndex].Cells["BiletNo"].Style.BackColor = Color.FromArgb(97, 147, 202);
            DGVTicketLists.Rows[e.RowIndex].Cells["GRP_AD"].Style.BackColor = Color.FromArgb(97, 147, 202);

        }

        private void DGVTicketLists_CellMouseLeave(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex == -1)
            {
                return;
            }

            Color rowColor = DGVTicketLists.DefaultCellStyle.BackColor;
            if (e.RowIndex % 2 != 0)
            {
                rowColor = DGVTicketLists.AlternatingRowsDefaultCellStyle.BackColor;
            }

            DGVTicketLists.Rows[e.RowIndex].Cells["BiletNo"].Style.BackColor = rowColor;
            DGVTicketLists.Rows[e.RowIndex].Cells["GRP_AD"].Style.BackColor = rowColor;


        }

        private void DGVTicketLists_DataBindingComplete(object sender, DataGridViewBindingCompleteEventArgs e)
        {
            //GrpBxQueueInf.Text = string.Format("Sırada Bekleyen Tüm Biletler ({0} kişi)", DGVTicketLists.Rows.Count);
        }

        #endregion


        #region Form uzerindeki fonksiyon kısayollari eventleri

        private void FrmVirtualTerminal_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.Alt && e.Control)
            {
                MenuStripTop.Visible = !MenuStripTop.Visible;
                return;
            }

            if (e.KeyCode == Keys.Right && e.Shift)
            {
                BtnNextTicket.PerformClick();
                return;
            }
            else if (e.KeyCode == Keys.R && e.Shift)
            {
                BtnReCallTicket.PerformClick();
            }
            else if (e.KeyCode == Keys.X && e.Shift)
            {
                TCPIPCommunicating.CloseDisplay(_kuyruk.terminal.ElTerminalID);
            }
            else if (e.KeyCode == Keys.Z && e.Shift)
            {
                TCPIPCommunicating.OpenDisplay(_kuyruk.terminal.ElTerminalID);
            }
            else if (e.KeyCode == Keys.L && e.Shift)
            {
                TCPIPCommunicating.MakeLineOnDisplay(_kuyruk.terminal.ElTerminalID);
            }
            else if (e.KeyCode == Keys.K && e.Shift)
            {
                DataTable dtTempParking = ParkingTickets;
                FrmParkingTickets frmParking = new FrmParkingTickets(ref dtTempParking);
                frmParking.ShowDialog();

                if (frmParking.IsCalledParkingTickets)
                {
                    ParkingTickets = null;
                    ParkingTickets = dtTempParking;

                    int TicketID, TicketNo, GroupID;
                    bool IsAssistGroup, IsMainGroup, IsTransferTicket, IsFiktifTicket;
                    DataGridViewRow drCalledTickets = frmParking.CalledTicket;
                    TicketID = int.Parse(drCalledTickets.Cells["BID"].Value.ToString());
                    TicketNo = int.Parse(drCalledTickets.Cells["BNo"].Value.ToString());
                    GroupID = int.Parse(drCalledTickets.Cells["GRPID"].Value.ToString());

                    IsMainGroup = TerminalHasThisGroup(
                        drCalledTickets.Cells["GRPID"].Value.ToString(), out IsAssistGroup);
                    IsTransferOrFiktifTicket(TicketID, out IsTransferTicket, out IsFiktifTicket);

                    _kuyruk.KillTicket();
                    _kuyruk.CallTicketManuel(TicketNo, TicketID, GroupID, IsTransferTicket,
                        IsFiktifTicket, IsAssistGroup, IsMainGroup);

                    LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();

                    SetWaitingLamb();
                    ParkingTickets.Rows.RemoveAt(frmParking.CalledIndex);
                }
            }
            else if (e.KeyCode == Keys.P)
            {
                if (LblTicketNo.Tag != null && !string.IsNullOrEmpty(LblTicketNo.Tag.ToString()))
                {
                    ParkingTickets.Rows.Add(
                        int.Parse(LblSisTar.Tag.ToString()), int.Parse(LblTicketGroupName.Tag.ToString()),
                        LblTicketNo.Text);
                    TmrOtoTicketCall.Start();
                    TmrTicketProcessCounter.Stop();
                    SetEnabledForTransferControls(false);
                    ClearTicketInf();
                    _kuyruk.terminal.SetActiveTicketID(0);

                    _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

                    NotifiyCurrentState("idled...", Color.Red);
                }
            }
        }

        private void CmbBxTransferGroups_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.Control)
            {
                e.Handled = true;
            }
        }

        #endregion


        #region Islem butonu eventleri

        private void BtnReCallTicket_Click(object sender, EventArgs e)
        {
            if (LblTicketNo.Tag != null)
            {
                TCPIPCommunicating.ReCallTicket(int.Parse(LblTicketNo.Tag.ToString()), _kuyruk.terminal.ElTerminalID);
            }
        }

        private void BtnOutOfService_Click(object sender, EventArgs e)
        {

            TmrOtoTicketCall.Stop();
            //TmrWaitingCountRefresh.Stop();
            if (_closeAndOpenService.ServisDisi)
            {
                _closeAndOpenService.ServisAcmaTarihi = DateTime.Now;
                _closeAndOpenService.OpenService();

                LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();

                SetWaitingLamb();
                _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

                NotifiyCurrentState("Boşta...", Color.Red);
                BtnOutOfService.BackColor = SystemColors.InactiveCaption;
                BtnOutOfService.FlatAppearance.BorderColor = SystemColors.ActiveCaption;
                BtnOutOfService.FlatAppearance.MouseDownBackColor = Color.SkyBlue;
                BtnOutOfService.FlatAppearance.MouseOverBackColor = SystemColors.GradientInactiveCaption;

                TmrOtoTicketCall.Start();
                SetEnabledCommonControls(true);
                BtnMola.BackColor = SystemColors.InactiveCaption;
                BtnMola.Enabled = true;
                DGVTicketLists.DataSource = GetAllTickets("");
                return;
            }


            string outOfReason = string.Empty;
            WOutOfServiceReason outOfIT = new WOutOfServiceReason();
            if (outOfIT.ShowDialog() == DialogResult.OK)
            {
                _closeAndOpenService.KapatmaSebebi = outOfIT.TxtBxReason.Text.Trim();
                _closeAndOpenService.ServisKapatmaTarihi = DateTime.Now;
                _closeAndOpenService.CloseService();


                TCPIPCommunicating.MakeLineOnDisplay(_kuyruk.terminal.ElTerminalID);
                if (Thread.CurrentThread.CurrentUICulture.Name == "tr-TR")
                    NotifiyCurrentState("Servis Dışı...", Color.OrangeRed);
                else
                    NotifiyCurrentState("Out Of Order...", Color.OrangeRed);
                BtnOutOfService.BackColor = Color.OrangeRed;
                BtnOutOfService.FlatAppearance.BorderColor = SystemColors.InactiveBorder;
                BtnOutOfService.FlatAppearance.MouseDownBackColor = Color.Orange;
                BtnOutOfService.FlatAppearance.MouseOverBackColor = Color.DarkOrange;

                SetEnabledCommonControls(false);
                BtnMola.BackColor = SystemColors.InactiveBorder;
                BtnMola.Enabled = false;

                if (!string.IsNullOrEmpty(LblTicketNo.Text))
                {
                    _kuyruk.HasNotTicket();
                    ClearTicketInf();
                    TmrTicketProcessCounter.Stop();
                }

                _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.ServisDisi);

            }
            else
            {
            }
        }

        private void BtnMola_Click(object sender, EventArgs e)
        {
            TmrOtoTicketCall.Stop();
            //TmrWaitingCountRefresh.Stop();
            if (!_startCoffeeBreak.Molada)
            {
                _startCoffeeBreak.PersonelID = SanalTerminal.PersonelID;
                _startCoffeeBreak.MolaBaslangic = DateTime.Now;
                _startCoffeeBreak.LetsCoffeeBreak();

                TCPIPCommunicating.MakeLineOnDisplay(_kuyruk.terminal.ElTerminalID);

                if (Thread.CurrentThread.CurrentUICulture.Name == "tr-TR")
                    NotifiyCurrentState("Molada...", Color.Red);
                else
                    NotifiyCurrentState("Takes Break...", Color.Red);
                BtnMola.BackColor = Color.OrangeRed;
                BtnMola.FlatAppearance.BorderColor = SystemColors.InactiveBorder;
                BtnMola.FlatAppearance.MouseDownBackColor = Color.Orange;
                BtnMola.FlatAppearance.MouseOverBackColor = Color.DarkOrange;
                ToolTipForProcess.SetToolTip(BtnMola, "End Break");

                SetEnabledCommonControls(false);
                BtnOutOfService.BackColor = SystemColors.InactiveBorder;
                BtnOutOfService.Enabled = false;
                if (!string.IsNullOrEmpty(LblTicketNo.Text))
                {
                    _kuyruk.HasNotTicket();
                    ClearTicketInf();
                    TmrTicketProcessCounter.Stop();
                }

                _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Molada);
            }
            else
            {
                _startCoffeeBreak.MolaBitis = DateTime.Now;
                _startCoffeeBreak.DoneCoffeeBreak();

                LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();

                SetWaitingLamb();
                _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

                NotifiyCurrentState("idled...", Color.Red);
                BtnMola.BackColor = SystemColors.InactiveCaption;
                BtnMola.FlatAppearance.BorderColor = SystemColors.ActiveCaption;
                BtnMola.FlatAppearance.MouseDownBackColor = Color.SkyBlue;
                BtnMola.FlatAppearance.MouseOverBackColor = SystemColors.GradientInactiveCaption;
                ToolTipForProcess.SetToolTip(BtnMola, "Start Break");

                TmrOtoTicketCall.Start();

                SetEnabledCommonControls(true);
                BtnOutOfService.BackColor = SystemColors.InactiveCaption;
                BtnOutOfService.Enabled = true;
                DGVTicketLists.DataSource = GetAllTickets("");

            }
        }

        #endregion


        #region TopMenu MenuStrip eventleri

        private void yaziciAyarlariToolStripMenuItem_Click(object sender, EventArgs e)
        {
            TmrOtoTicketCall.Stop();
            //TmrWaitingCountRefresh.Stop();
            WPrinterSetup wprintSetupIT = new WPrinterSetup();
            wprintSetupIT.ShowDialog();

            if (_kuyruk.terminal.GetTerminalState() == Terminaller.TerminalDurum.Bosta)
            {
                TmrOtoTicketCall.Start();
            }

            MenuStripTop.Visible = false;
        }

        private void kisayollarToolStripMenuItem_Click(object sender, EventArgs e)
        {
        }

        private void hakkindaToolStripMenuItem_Click(object sender, EventArgs e)
        {
        }

        private void hataRaporuGonderToolStripMenuItem_Click(object sender, EventArgs e)
        {
        }

        #endregion


        #region Other events

        private void ChckBxMinMax_CheckedChanged(object sender, EventArgs e)
        {
            if (ChckBxMinMax.Checked)
            {
                GrpBxQueueInf.Visible = false;
                GrpBxQueueInf.Dock = DockStyle.None;
                GrpBxQueueInf.Height = 0;


                PnlBottom.Dock = DockStyle.None;
                PnlBottom.Location = new Point(GrpBxTicketInf.Width, PnlMiddle.Location.Y);
                PnlBottom.Width = PnlMiddle.Width - GrpBxTicketInf.Width;

                GrpBxFiktif.Visible = false;
                PnlMiddle.Dock = DockStyle.None;
                PnlMiddle.Width = GrpBxTicketInf.Width;

                BtnNextTicket.Width = 48;
                BtnNextTicket.Height = 37;
                BtnReCallTicket.Width = 48;
                BtnReCallTicket.Height = 37;
                BtnOutOfService.Width = 48;
                BtnOutOfService.Height = 37;
                BtnMola.Width = 48;
                BtnMola.Height = 37;

                BtnNextTicket.Location = new Point(6, 20);
                BtnReCallTicket.Location = new Point(61, 20);
                BtnOutOfService.Location = new Point(116, 20);
                BtnMola.Location = new Point(171, 20);

                BtnNextTicket.BackgroundImage = Resources.NextTicket_Sizing;
                BtnReCallTicket.BackgroundImage = Resources.ReCallTicketNumber_Sizing;
                BtnOutOfService.BackgroundImage = Resources.OutOfService3_Sizing;
                BtnMola.BackgroundImage = Resources.Mola_Sizing;


                Height = PnlTop.Height + PnlMiddle.Margin.Top + GrpBxTicketInf.Margin.Top +
                         GrpBxTicketInf.Padding.Top +
                         PnlMiddle.Top + BtnNextTicket.Height;
                ;
                Width = GrpBxTicketInf.Width + 220 + 5;
                PctrBxHaveNotWaitings.Location = new Point(Width - 113, 3);
                PctrBxHaveWaitings.Location = new Point(Width - 113, 3);
                ChckBxMinMax.Location = new Point(Width - 77, 10);
            }
            else
            {
                GrpBxQueueInf.Visible = true;
                GrpBxQueueInf.Dock = DockStyle.Fill;
                GrpBxQueueInf.Height = 191;


                PnlBottom.Dock = DockStyle.Fill;
                PnlBottom.Location = new Point(0, 245);

                GrpBxFiktif.Visible = true;
                PnlMiddle.Dock = DockStyle.Top;
                PnlMiddle.Width = 561;

                BtnNextTicket.Width = 67;
                BtnNextTicket.Height = 56;
                BtnReCallTicket.Width = 67;
                BtnReCallTicket.Height = 56;
                BtnOutOfService.Width = 67;
                BtnOutOfService.Height = 56;
                BtnMola.Width = 67;
                BtnMola.Height = 56;

                BtnNextTicket.Location = new Point(6, 20);
                BtnReCallTicket.Location = new Point(80, 20);
                BtnOutOfService.Location = new Point(153, 20);
                BtnMola.Location = new Point(226, 20);

                BtnNextTicket.BackgroundImage = Resources.NextTicket;
                BtnReCallTicket.BackgroundImage = Resources.ReCallTicketNumber;
                BtnOutOfService.BackgroundImage = Resources.OutOfService3;
                BtnMola.BackgroundImage = Resources.Mola;

                PctrBxHaveNotWaitings.Location = new Point(462, 3);
                PctrBxHaveWaitings.Location = new Point(462, 3);
                ChckBxMinMax.Location = new Point(490, 10);
                Height = 378 + 70;
                Width = 569;
            }
        }

        private void TmrForMakeLine_Tick(object sender, EventArgs e)
        {
        }

        private void terminal_StatementChanged(StatementsChangedEventArgs args)
        {
            if (args.NewStatement == Terminaller.TerminalDurum.Bosta)
            {

                LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();
                if (LblWaitingTickets.Text == "0")
                {
                    TmrWaitingCountRefresh.Start();
                }
                else
                {
                    //TmrWaitingCountRefresh.Stop();
                }
            }
        }

        private int fiktifEffectLoopCount = 1;

        private void TmrFiktifEffects_Tick(object sender, EventArgs e)
        {




        }

        private void TxtBxQueueTicketNo_Enter(object sender, EventArgs e)
        {
        }

        private void TxtBxQueueTicketNo_Leave(object sender, EventArgs e)
        {

        }

        private void FrmVirtualTerminal_FormClosing(object sender, FormClosingEventArgs e)
        {
            UserLogin userLogoutIt = new UserLogin();
            userLogoutIt.PersonelId = SanalTerminal.PersonelID;
            userLogoutIt.UpdateLoginState(false);

            if (_closeAndOpenService.ServisDisi)
            {
                _closeAndOpenService.ServisAcmaTarihi = DateTime.Now;
                _closeAndOpenService.OpenService();
            }

            else if (_startCoffeeBreak.Molada)
            {
                _startCoffeeBreak.MolaBitis = DateTime.Now;
                _startCoffeeBreak.DoneCoffeeBreak();
            }

            _kuyruk.terminal.SetLastCallingGroup(SanalTerminal.TerminalID, 0, false);

            if (LblTicketNo.Tag != null)
            {
                _kuyruk.HasNotTicket();
            }

            _kuyruk.terminal.ResetCallAndTransferRatio(SanalTerminal.TerminalID);
            _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.SistemdeDegil);
        }

        #endregion

        #endregion

        #region Methods

        #region Transfer ve Fiktif ortak metodlari

        private Bilet CreateTicket(int GRPID, bool IsTransfer, bool IsFiktif, int TicketNumber)
        {
            Bilet newTicket = new Bilet();
            newTicket.TerminalID = 0;
            newTicket.GrupID = GRPID;
            newTicket.BiletNo = TicketNumber;
            newTicket.AlinmaTarihi = DateTime.Now;
            newTicket.Transfer = IsTransfer;
            newTicket.Fiktif = IsFiktif;

            return newTicket;
        }

        private void SetEnabledCommonControls(bool _enabled)
        {
            GrpBxTicketInf.Enabled = _enabled;
            GrpBxQueueInf.Enabled = _enabled;
            GrpBxFiktif.Enabled = _enabled;

            DGVTicketLists.Enabled = _enabled;

            BtnNextTicket.Enabled = _enabled;
            BtnReCallTicket.Enabled = _enabled;

            if (_enabled)
            {
                BtnNextTicket.BackColor = SystemColors.InactiveCaption;
                BtnReCallTicket.BackColor = SystemColors.InactiveCaption;
            }
            else
            {
                BtnNextTicket.BackColor = SystemColors.InactiveBorder;
                BtnReCallTicket.BackColor = SystemColors.InactiveBorder;

            }
        }

        #endregion


        #region Transfer metodlari

        private void SetEnabledForTransferControls(bool enabled)
        {
            BtnTransfer.Enabled = enabled;
            CmbBxTransferGroups.Enabled = enabled;
            ChckBxFiktifCurrentTicket.Enabled = enabled;
            ChckBxFiktifCurrentTicket.Checked = enabled;
        }

        private void ClearTicketInf()
        {
            LblIsFiktif.Text = string.Empty;
            LblIsTransfer.Text = string.Empty;
            LblSisTar.Text = string.Empty;
            LblIslemSaati.Text = string.Empty;
            LblTicketGroupName.Text = string.Empty;
            LblTicketNo.Text = string.Empty;
            LblTicketNo.Tag = null;
            LblProcessTime.Text = string.Empty;
            LblSisTar.Tag = string.Empty;
        }

        #endregion


        #region Fiktif bilet metodlari

        private int GetNextFiktifTicketNumber()
        {
            int NextTicketNumber = 0;
            string strWhereSQL = string.Format("Where (SIS_TAR BETWEEN '{0}' AND '{1}') AND (OZEL_MUSTERI='True')",
                DateTime.Now.ToString("MM.dd.yyyy 00:00:00"),
                DateTime.Now.ToString("MM.dd.yyyy 23:59:59")
                );

            DataTable dtTicketNumber = (DataTable)DBProcess.SimpleQuery("BILETLER",
                strWhereSQL,
                "ORDER BY BID DESC",
                "TOP (1) BILET_NO")["DataTable"];

            if (dtTicketNumber != null)
            {
                if (dtTicketNumber.Rows.Count > 0)
                {
                    NextTicketNumber = int.Parse(dtTicketNumber.Rows[0][0].ToString()) + 1;
                }
                else
                {
                    NextTicketNumber = 900;
                }
            }
            else
            {
                NextTicketNumber = 0;
            }


            if (NextTicketNumber > 999)
            {
                NextTicketNumber = 900;
            }

            return NextTicketNumber;
        }

        private void PrintFiktifTicket(int fiktifTicketNo)
        {
            string printerName = Properties.Settings.Default.FiktifPrinter;
            printDialog1.PrinterSettings.PrinterName = printerName;

            if (string.IsNullOrEmpty(printerName))
            {
                DialogResult dlgRslt = MessageBox.Show(
                    "for the necessary printer settings not configured properly !"
                    + "\nClick OK to perform printer settings, or Cancel to cancel printing."
                    + "\nNote: The fixed ticket has been processed on the system. "
                    + "Canceling the printout will not cancel the fictitious ticket.",
                    "Virtual Terminal - Warning",
                    MessageBoxButtons.OKCancel,
                    MessageBoxIcon.Warning
                    );

                if (dlgRslt == DialogResult.OK)
                {
                    WPrinterSetup wprintSetupIT = new WPrinterSetup();
                    DialogResult dlgRsltForSettings = wprintSetupIT.ShowDialog();

                    if (dlgRsltForSettings == DialogResult.OK)
                    {
                        printDialog1.PrinterSettings.PrinterName = Properties.Settings.Default.FiktifPrinter;
                    }
                }
                else
                {
                    MessageBox.Show(
                        "You canceled the printer settings. Fiktif The ticket will not be picked up.",
                        "Virtual Terminal - Warning",
                        MessageBoxButtons.OK,
                        MessageBoxIcon.Warning
                        );

                    return;
                }
            }

            if (!printDialog1.PrinterSettings.IsValid)
            {
                Properties.Settings.Default.FiktifPrinter = string.Empty;
                Properties.Settings.Default.Save();
                PrintFiktifTicket(fiktifTicketNo);
            }
            else
            {
                _fiktifPrintTicketNo = fiktifTicketNo.ToString();
                printDocument1.Print();
            }
        }

        #endregion

        private DataTable GetAllTickets(string Where)
        {
            string whereSQLFilter = string.Empty;

            if (!string.IsNullOrEmpty(Where))
            {
                whereSQLFilter = string.Format("WHERE {0}", Where);
            }

            DataTable dtAllTickets = (DataTable)DBProcess.SimpleQuery(
                "KUYRUK INNER JOIN GRUPLAR ON KUYRUK.GRPID = GRUPLAR.GRPID JOIN BILETLER B ON KUYRUK.BID = B.BID ",
                whereSQLFilter,
                "ORDER BY " + SanalTerminal.GetBiletSiralamaTipi(), //order by
                "GRUPLAR.GRUP_ISMI, KUYRUK.BID, KUYRUK.GRPID, KUYRUK.BILET_NO, B.MusteriAdi "

                //"", "GRUPLAR.GRUP_ISMI, KUYRUK.BID, KUYRUK.GRPID, KUYRUK.BILET_NO" orj
                )["DataTable"];

            return dtAllTickets;
        }


        #region Tum biletlerin listesi ile ilgili metodlar, filtreleme, renk ayarlari, bilet cagirma etc.

        private bool TerminalHasThisGroup(string _grpID, out bool _IsAssistGroup)
        {
            string strWhereSQL = string.Format("WHERE TID = {0} AND GRPID = {1}", SanalTerminal.TerminalID, _grpID);
            Hashtable hshGroups = DBProcess.SimpleQuery("TERMINAL_GRUP", strWhereSQL, "", "YARDIM_GRUBU");
            DataTable dtGroupInf = null;
            _IsAssistGroup = false;

            if (hshGroups.ContainsKey("Error"))
            {
                return false;
            }
            else
            {
                dtGroupInf = (DataTable)hshGroups["DataTable"];

                if (dtGroupInf.Rows.Count > 0)
                {
                    _IsAssistGroup = bool.Parse(dtGroupInf.Rows[0][0].ToString());
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

        private void IsTransferOrFiktifTicket(int _TicketID, out bool _IsTransfer, out bool _IsFiktif)
        {
            _IsTransfer = false;
            _IsFiktif = false;

            Hashtable hshTicketInf = DBProcess.SimpleQuery("KUYRUK", "WHERE BID = " + _TicketID,
                "", "TRANSFER, OZEL_MUSTERI");
            DataTable dtTciketInf = null;


            if (hshTicketInf.ContainsKey("Error"))
            {
                return;
            }
            else
            {
                dtTciketInf = (DataTable)hshTicketInf["DataTable"];

                if (dtTciketInf.Rows.Count > 0)
                {
                    _IsFiktif = bool.Parse(dtTciketInf.Rows[0]["OZEL_MUSTERI"].ToString());
                    _IsTransfer = bool.Parse(dtTciketInf.Rows[0]["TRANSFER"].ToString());
                }
            }
        }

        #endregion


        #region Kontrol durumlari ile ilgili metodlar

        private void NotifiyCurrentState(string stateText, Color stateColor)
        {
            LblSysInfo.ForeColor = stateColor;
            LblSysInfo.Text = stateText;
        }

        private void SetWaitingLamb()
        {
            if (int.Parse(LblWaitingTickets.Text) > 0)
            {
                PctrBxHaveNotWaitings.Visible = false;
                PctrBxHaveWaitings.Visible = true;
            }
            else
            {
                PctrBxHaveNotWaitings.Visible = true;
                PctrBxHaveWaitings.Visible = false;
            }
        }

        #endregion

        private void timerBiletBitti_Tick(object sender, EventArgs e)
        {
            lblBitikBiletliKiosk.Visible = !lblBitikBiletliKiosk.Visible;
        }

        #endregion

        private void btnTagSifirla_Click(object sender, EventArgs e)
        {
            _kuyruk.BitikBiletSifirla();

            lblBitikBiletliKiosk.Text = "";
            btnTagSifirla.Visible = false;
            timerBiletBitti.Enabled = false;
        }

        private void btnPark_Click(object sender, EventArgs e)
        {
            if (LblTicketNo.Tag != null && !string.IsNullOrEmpty(LblTicketNo.Tag.ToString()))
            {
                ParkingTickets.Rows.Add(
                    int.Parse(LblSisTar.Tag.ToString()), int.Parse(LblTicketGroupName.Tag.ToString()),
                    LblTicketNo.Text);
                TmrOtoTicketCall.Start();
                TmrTicketProcessCounter.Stop();
                SetEnabledForTransferControls(false);
                ClearTicketInf();
                _kuyruk.terminal.SetActiveTicketID(0);

                _kuyruk.terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

                NotifiyCurrentState("idled...", Color.Red);
            }
        }

        private void btnParkGoster_Click(object sender, EventArgs e)
        {
            DataTable dtTempParking = ParkingTickets;
            FrmParkingTickets frmParking = new FrmParkingTickets(ref dtTempParking);
            frmParking.ShowDialog();

            if (frmParking.IsCalledParkingTickets)
            {
                ParkingTickets = null;
                ParkingTickets = dtTempParking;

                int TicketID, TicketNo, GroupID;
                bool IsAssistGroup, IsMainGroup, IsTransferTicket, IsFiktifTicket;
                DataGridViewRow drCalledTickets = frmParking.CalledTicket;
                TicketID = int.Parse(drCalledTickets.Cells["BID"].Value.ToString());
                TicketNo = int.Parse(drCalledTickets.Cells["BNo"].Value.ToString());
                GroupID = int.Parse(drCalledTickets.Cells["GRPID"].Value.ToString());

                IsMainGroup = TerminalHasThisGroup(
                    drCalledTickets.Cells["GRPID"].Value.ToString(), out IsAssistGroup);
                IsTransferOrFiktifTicket(TicketID, out IsTransferTicket, out IsFiktifTicket);

                _kuyruk.KillTicket();
                _kuyruk.CallTicketManuel(TicketNo, TicketID, GroupID, IsTransferTicket,
                    IsFiktifTicket, IsAssistGroup, IsMainGroup);

                LblWaitingTickets.Text = _kuyruk.GetWaitingTicketsCount().ToString();

                SetWaitingLamb();
                ParkingTickets.Rows.RemoveAt(frmParking.CalledIndex);
            }
        }

    }
}
