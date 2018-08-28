using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using QPU_TCPIP.Classes.TicketLayer;
using QPU_TCPIP.Classes.QueueLayer;
using QPU_TCPIP.Classes;
using QPU_SerialPort;
using System.Threading;
using QPU_TCPIP.Library.Classes;

namespace QPU_TCPIP.Classes.SerialCommunicateLayer
{
    internal class Communicating
    {

        #region Enums

        public enum RequestCommandTypes
        {
            IlerletmeKomutu = 1,
            SayiTekrarlatmaKomutu = 3,
            DisplayKapatmaKomutu = 4,
            DisplayCizgiYapmaKomutu = 5,
            DisplayAcmaKomutu = 6,
            BekleyenTalepKomutu = 7,
            BekleyenYokCevapKomutu = 9,
            GrupNoOgrenmeKomutu = 10,
            GrupNoDegistirmeKomutu = 12,
            YonlendirmeKomutu = 13,
            BiletTalepKomutu = 14,
            ACK = 16,
            AnaTabloKUYuklemeKomutu = 27,
            AnaTabloYonOkuAyarlamaKomutu = 28,
            GlobalResetKomutu = 85,
            EtiketBittiKomutu = 86
        }

        public enum ResponseCommandTypes
        {
            IlerletmeCevapKomutu = 2,
            BekleyenCevapKomutu = 8,

            GrupNoBildirmeKomutu = 11,
            BiletCevap1Komutu = 15,
            BirdenFazlaBiletBasmaKomutu = 17,
            BiletYokCevapKomutu = 18,
            DotMatrixYazmaKomutu1 = 19,
            DotMatrixYazmaKomutu2 = 20,
            DotMatixDurumKomutu = 21,
            DotMatixDurumKomutu2 = 21,
            DotMatixDurumKomutu3 = 21,
            DotMatixDurumKomutu4 = 21,
            DotMatixDurumKomutu5 = 21,
            BiletDatasiYuklemeKomutu = 23,
            BiletMakinesiHizmetDisiKomutu = 24,
            AnaTabloKUYuklemeKomutu = 27,
            AnaTabloYonOkuBelirlemeKomutu = 28,
            GenelDingDongAcmaKapamaKomutu = 29,
            TarihSaatAyarlamaKomutu = 30,
            GostergeFlashAyarlamaKomutu = 31,
            MesaiSaatiDisindaKomutu = 32,
            Konfigrasyon24C02DatasiYuklemeKomutu = 33,
            GostergeKaydirmaBaslamaSuresiKomutu = 34,
            GlobalResetKomutu = 85,
            ResetKomutu = 85
        }

        #endregion

        #region Methods

        public static void DecideCommandResponse(string[] CommandData)
        {
            RequestCommandTypes requestCommandType = (RequestCommandTypes) int.Parse(CommandData[0]);

            switch (requestCommandType)
            {
                case RequestCommandTypes.IlerletmeKomutu:
                    Kuyruk.CallTicket(CommandData);
                    break;
                case RequestCommandTypes.SayiTekrarlatmaKomutu:
                    //Program.Communice.RepeatNumber(CommandData[1], CommandData[2]); //mt 22.06.2015, lcd ye sayý tekrarlatma gitmiyordu.
                    Kuyruk.ReCallTicket(CommandData);
                    break;
                case RequestCommandTypes.DisplayKapatmaKomutu:
                    Program.Communice.CloseDisplay(CommandData[1]);
                    break;
                case RequestCommandTypes.DisplayCizgiYapmaKomutu:
                    Program.Communice.MakeLineOnDisplay(CommandData[1]);
                    break;
                case RequestCommandTypes.DisplayAcmaKomutu:
                    Program.Communice.OpenDisplay(CommandData[1]);
                    break;
                case RequestCommandTypes.BekleyenTalepKomutu:
                    Program.Communice.MakeLineOnDisplay(CommandData[1]);
                    break;
                case RequestCommandTypes.BekleyenYokCevapKomutu:
                    Program.Communice.NotExistWaitingResponse(CommandData[1]);
                    break;
                case RequestCommandTypes.GrupNoOgrenmeKomutu:
                    break;
                case RequestCommandTypes.GrupNoDegistirmeKomutu:
                    break;
                case RequestCommandTypes.YonlendirmeKomutu:
                    break;
                case RequestCommandTypes.BiletTalepKomutu:
                    Bilet.NewTicketRequest(byte.Parse(CommandData[4]), byte.Parse(CommandData[5]));
                    break;
                case RequestCommandTypes.ACK:

                    break;
                case RequestCommandTypes.AnaTabloKUYuklemeKomutu:
                    Program.Communice.LoadKUNumbersToMainTable(CommandData[1],
                        (ComCommunication.Communicate.KU) int.Parse(CommandData[2]),
                        CommandData[3]);
                    break;
                case RequestCommandTypes.AnaTabloYonOkuAyarlamaKomutu:
                    Program.Communice.LoadKUNumbersToMainTable(CommandData[1],
                        ComCommunication.Communicate.KU.Show,
                        CommandData[3]);

                    Thread.Sleep(15);

                    Program.Communice.SetMainTableDirectionArrow(CommandData[1],
                        (ComCommunication.Communicate.ArrowDirections) int.Parse(CommandData[2]),
                        CommandData[3]);
                    break;

                case RequestCommandTypes.GlobalResetKomutu:
                    Program.Communice.GlobalReset();
                    break;

                case RequestCommandTypes.EtiketBittiKomutu:
                    EtiketBitti(int.Parse(CommandData[2]));
                    break;

                default:
                    break;
            }
        }

        private static void EtiketBitti(int KioskId)
        {
            DataTable dt = (DataTable) DBProcess.SimpleQuery(
                "KIOSK_AYAR",
                "Where TID=" + KioskId,
                "",
                "TagOverFlowPerId"
                )["DataTable"];

            int personelId = int.Parse(dt.Rows[0]["TagOverFlowPerId"].ToString());

            //bu sanal terminale bilgiyi bas.
        }

        #endregion
    }
}
