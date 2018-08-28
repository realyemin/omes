using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using QPU_SerialPort.Classes.TicketLayer;
using QPU_SerialPort.Classes.QueueLayer;
using QPU_SerialPort.Classes.SerialPort.QueueLayer;
using System.Net.Sockets;

namespace QPU_SerialPort.Classes.SerialCommunicateLayer
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
            GrupNoOgrenmeKomutu = 10,
            GrupNoDegistirmeKomutu = 12,
            YonlendirmeKomutu = 13,
            BiletTalepKomutu = 14,
            ACK = 16,
            AnaTabloYonOkuAyarlamaKomutu = 26,
            AnketGirisiKomutu = 49
        }

        public enum ResponseCommandTypes
        {
            IlerletmeCevapKomutu = 2,
            BekleyenCevapKomutu = 8,
            BekleyenYokCevapKomutu = 9,
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

        public static void DecideCommandResponse(byte[] CommandData)
        {
            RequestCommandTypes requestCommandType = (RequestCommandTypes) CommandData[1];
            switch (requestCommandType)
            {
                case RequestCommandTypes.IlerletmeKomutu:
                    Kuyruk.NextTicketRequest(CommandData[5]);
                    break;
                case RequestCommandTypes.SayiTekrarlatmaKomutu:
                    break;
                case RequestCommandTypes.DisplayKapatmaKomutu:
                    break;
                case RequestCommandTypes.DisplayCizgiYapmaKomutu:
                    break;
                case RequestCommandTypes.DisplayAcmaKomutu:
                    break;
                case RequestCommandTypes.BekleyenTalepKomutu:
                    Kuyruk.KuyruktaBekleyenlerAdediniGonder(CommandData[5]);
                    break;
                case RequestCommandTypes.GrupNoOgrenmeKomutu:
                    break;
                case RequestCommandTypes.GrupNoDegistirmeKomutu:
                    break;
                case RequestCommandTypes.YonlendirmeKomutu:
                    break;
                case RequestCommandTypes.BiletTalepKomutu:
                    //Bilet.NewTicketRequest(CommandData[4], CommandData[5]); //burayý ezeceðiz.
                    KiosktaOzelButonaBas();
                    break;
                case RequestCommandTypes.ACK:
                    break;
                case RequestCommandTypes.AnaTabloYonOkuAyarlamaKomutu:
                    break;
                case RequestCommandTypes.AnketGirisiKomutu:
                    AnketSonucuKaydet(CommandData[2], CommandData[5]);
                    break;
                default:
                    break;
            }

        }

        public static void KiosktaOzelButonaBas()
        {
            string KioskIP = Properties.Settings.Default.KioskIP;
            string btnId = Properties.Settings.Default.OzelBtnId;

            TcpClient tcpClient = (TcpClient)null;
            tcpClient = new TcpClient();
            tcpClient.Connect(KioskIP, 8586);
            NetworkStream networkStream = tcpClient.GetStream();
            //byte[] bytes = Encoding.ASCII.GetBytes(string.Format("099#000#000#000", new object[0]));
            Byte[] sendBytes = Encoding.UTF8.GetBytes(btnId);
            networkStream.Write(sendBytes, 0, sendBytes.Length);
            tcpClient.Close();
            networkStream.Close();
        }

        private static void AnketSonucuKaydet(byte ButonNo, byte Adres)
        {
            //anket sonucunu kaydet.
            Anket an = new Anket();
            an.Secim = ButonNo;
            an.TerminalId = Adres;
            an.Insert();            
        }

        #endregion
    }
}