using System;
using System.Data;
using QVU.Classes.QueueLayer.EventArgsClasses;
using QVU.Classes.SocketCommunicateLayer;
using QVU.Classes.TicketLayer;
using QVU.Classes.UserAccessLayer.EventArgsClasses;
using QVU.Library.Classes;

namespace QVU.Classes.QueueLayer
{
    public partial class Kuyruk
    {
        #region Members/Properties

        public bool YardimGrubundan { get; set; }
        public int KuyruktakiKisiSayisi { get; set; }
        public int BitikKioskId { get; set; }
        public Terminaller terminal;

        #endregion

        #region Delegates and events definitons

        public delegate void NextTicketDetectedEventHandler(NextTicketDetectedEventArgs args);

        public event NextTicketDetectedEventHandler NextTicketDetected;

        public delegate void NotTicketDetectedEventHandler();

        public event NotTicketDetectedEventHandler NotTicketDetected;

        public delegate void TicketCallingFaliedEventHandler();

        public event TicketCallingFaliedEventHandler TicketCallingFalied;

        #endregion

        #region Methods

        public void DetectAndSendNextTicket()
        {
            terminal.RefreshTicketInf();
            SendTicketNumber(DetectTicketNumber());
        }

        private void SendTicketNumber(DataRow drCallingTicket)
        {
            if (drCallingTicket == null)
            {
                HasNotTicket();
                if (NotTicketDetected != null) NotTicketDetected();
                return;
            }

            BiletId = int.Parse(drCallingTicket["BID"].ToString());
            GrupId = int.Parse(drCallingTicket["GRPID"].ToString());
            BiletNo = int.Parse(drCallingTicket["BILET_NO"].ToString());
            Transfer = bool.Parse(drCallingTicket["TRANSFER"].ToString());
            Fiktif = bool.Parse(drCallingTicket["OZEL_MUSTERI"].ToString());


            //örnek týp merkezi için eklendi.
            //System.Collections.Hashtable hs = new System.Collections.Hashtable();
            //hs["BID"] = BiletId;
            //hs["TID"] = terminal.TID;

            //DBProcess.InsertData("havuz", hs);
            //********************************************************************örnek týp merkezi için eklendi.


            KuyrukSira.Cagrilan = KuyrukSira.GrupId == GrupId && KuyrukSira.Transfer == Transfer ? KuyrukSira.Cagrilan + 1 : 1;

            KuyrukSira.GrupId = GrupId;
            KuyrukSira.Transfer = Transfer;/*/*/
            KuyrukSira.Cagrilacak = Transfer ? int.Parse(drCallingTicket["TRANSFER_ORAN"].ToString()) : int.Parse(drCallingTicket["CAGRI_ORAN"].ToString());

            KillTicket();
            CallTicket();
        }

        public void HasNotTicket()
        {
            terminal.SetTerminalState(Terminaller.TerminalDurum.Bosta);

            KillTicket();
            terminal.SetActiveTicketID(0);
        }

        public void KillTicket()
        {
            var lastTicket = new Bilet { IslemBitisSaati = DateTime.Now };
            lastTicket.SetTicketStateToDone(terminal.AktifBiletID);
        }

        private void CallTicket()
        {
            var callingSuccess = TCPIPCommunicating.CallTicket(BiletNo, terminal.ElTerminalID);

            if (!callingSuccess)
            {
                TicketCallingFalied.Invoke();
                return;
            }

            PopQueue();
            var currentTicket = new Bilet { TerminalID = terminal.TID, IslemBaslangicSaati = DateTime.Now };

            currentTicket.SetTicketOnProcess(BiletId);
            terminal.SetActiveTicketID(BiletId);
            terminal.SetTerminalState(Terminaller.TerminalDurum.MusteriIleMesgul);

            if (!Transfer)
            {
                terminal.ToIncreaseOrResetCallRatio(terminal.TID, GrupId);
            }
            else
            {
                terminal.ToIncreaseOrResetTransferRatio(terminal.TID, GrupId);
            }

            if (!YardimGrubundan)
            {
                terminal.SetLastCallingGroup(terminal.TID, GrupId, Transfer);
            }

            if (NextTicketDetected != null)
                NextTicketDetected(new NextTicketDetectedEventArgs(this));
        }

        private void PopQueue()
        {
            //örnek týp merkezi için kuyruktan bilet silme çýkarýldý
            Delete("BID=" + BiletId);
        }

        public int GetWaitingTicketsCount()
        {
            var hshWaitingCounts = DBProcess.SimpleQuery("KUYRUK K INNER JOIN TERMINAL_GRUP G ON K.GRPID = G.GRPID", "WHERE G.TID = " + terminal.TID, "", "COUNT(K.BID) AS CBID");

            if (!hshWaitingCounts.ContainsKey("Error"))
            {
                var dtWaitingCounts = (DataTable) hshWaitingCounts["DataTable"];
                KuyruktakiKisiSayisi = dtWaitingCounts.Rows.Count > 0 ? int.Parse(dtWaitingCounts.Rows[0]["CBID"].ToString()) : 0;
            }
            else
            {
                KuyruktakiKisiSayisi = 0;
            }

            return KuyruktakiKisiSayisi;
        }

        public bool BitikBiletSifirla()
        {
            try
            {
                string sql = "update KIOSK_AYAR set TotalTag = 0 " +
                         "from TERMINALLER T JOIN PERSONELLER P ON T.TID = P.TID " +
                         "JOIN KIOSK_AYAR K ON P.PID = K.TagOverFlowPerId " +
                         "WHERE T.TID = " + terminal.TID;
                DBProcess.ExecuteSQL(sql);
                return true;
            }
            catch (Exception)
            {
                return false;
            }
        }

        public int GetBitikBilet()
        {
            /*
                SELECT K.KID
                FROM TERMINALLER T 
                JOIN PERSONELLER P ON T.TID = P.TID
                JOIN KIOSK_AYAR K ON P.PID = K.TagOverFlowPerId
                WHERE K.TagOverFlowPerId = 21
             */
            string tables = "TERMINALLER T JOIN PERSONELLER P ON T.TID = P.TID JOIN KIOSK_AYAR K ON P.PID = K.TagOverFlowPerId";
            var hshBitik = DBProcess.SimpleQuery(tables, "WHERE k.TotalTag >= k.MaxTotalTag and T.TID = " + terminal.TID, "", "COUNT(K.KID) AS CKID");

            if (!hshBitik.ContainsKey("Error"))
            {
                var dtWaitingCounts = (DataTable)hshBitik["DataTable"];
                BitikKioskId = dtWaitingCounts.Rows.Count > 0 ? int.Parse(dtWaitingCounts.Rows[0]["CKID"].ToString()) : 0;
            }
            else
            {
                BitikKioskId = 0;
            }

            return BitikKioskId;
        }

        public void CallTicketManuel(int _TicketNo, int _TicketID, int _GrupID, bool _IsTransfer, bool _IsFiktif, bool _IsAssistGroup, bool _IsMainGroup)
        {
            BiletId = _TicketID;
            BiletNo = _TicketNo;
            Fiktif = _IsFiktif;
            GrupId = _GrupID;
            Transfer = _IsTransfer;
            YardimGrubundan = _IsAssistGroup;
            var ticketHasMainGroups = _IsMainGroup;

            var callingSuccess = TCPIPCommunicating.CallTicket(BiletNo, terminal.ElTerminalID);

            if (!callingSuccess)
            {
                if (TicketCallingFalied != null)
                {
                    TicketCallingFalied();
                }
                return;
            }

            PopQueue();
            var currentTicket = new Bilet { TerminalID = terminal.TID, IslemBaslangicSaati = DateTime.Now };

            currentTicket.SetTicketOnProcess(BiletId);
            terminal.SetActiveTicketID(BiletId);
            terminal.SetTerminalState(Terminaller.TerminalDurum.MusteriIleMesgul);

            if (NextTicketDetected != null)
                NextTicketDetected(new NextTicketDetectedEventArgs(this));

            if (!ticketHasMainGroups)
            {
                return;
            }

            if (!Transfer)
            {
                terminal.ToIncreaseOrResetCallRatio(terminal.TID, GrupId);
            }
            else
            {
                terminal.ToIncreaseOrResetTransferRatio(terminal.TID, GrupId);
            }

            if (!YardimGrubundan)
            {
                terminal.SetLastCallingGroup(terminal.TID, GrupId, Transfer);
            }
        }

        #endregion
    }
}