using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace QVU.WFroms
{
    public partial class FrmParkingTickets : Form
    {
        public FrmParkingTickets(ref DataTable ParkingTickets)
        {
            InitializeComponent();
            DGVParking.DataSource = ParkingTickets;
        }

        public DataGridViewRow CalledTicket { get; set; }
        public int CalledIndex { get; set; }
        public bool IsCalledParkingTickets { get; set; }
        private void FrmParkingTickets_Load(object sender, EventArgs e)
        {
        }

        private void DGVParking_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex <= -1)
            {
                IsCalledParkingTickets = false;
                return;
            }

            this.CalledTicket = this.DGVParking.Rows[e.RowIndex];
            IsCalledParkingTickets = true;
            this.CalledIndex = e.RowIndex;
            this.Close();
        }
    }
}