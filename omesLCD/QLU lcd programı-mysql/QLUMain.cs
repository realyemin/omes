using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Media;
using System.Text;
using System.Threading;
using System.Windows.Forms;
//using DirectX.Capture;
using QLU.Classes;
using QLU.Controls;
using QLU.Properties;
using System.Globalization;
using System.Net.Sockets;
using System.Net;
using System.IO;
//..............
using MySql.Data.MySqlClient;
namespace QLU
{
    public partial class QLUMain : Form
    {
        public string VideoURL { get; set; }
        public string UstBaslik { get; set; }
        public string AltBaslik { get; set; }
        public bool Yon1 { get; set; }
        public bool Yon2 { get; set; }

        private int _satirSayisi = 0;
        private int _satirSayisi2 = 0;
        //private int _silinecekSatirSayisi = 1;

        private SoundPlayer sp;
        //private Capture _capture = null;
        //private Filters filters = new Filters();
        //private volatile List<Datas> _Veriler = new List<Datas>(4);
        private int _mediaTipi;

        public QLUMain()
        {
            InitializeComponent();
            //MessageBox.Show("init");

            CheckForIllegalCrossThreadCalls = false;
            if (!(Settings.Default.EkranNo.ToString() != string.Empty))
                return;
            FormBilgileriAyarla();
            //MessageBox.Show("form bilgi ayarla");
        }

        private void ChangeLanguage()
        {
            var ci = new CultureInfo("tr-TR");
            //var ci = Application.CurrentCulture;
            //var ci = System.Threading.Thread.CurrentThread.CurrentUICulture;// = ci;
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

        private void QLUMain_Load(object sender, EventArgs e)
        {
            ChangeLanguage();
            //MessageBox.Show("2,1");
            if (Settings.Default.ServerIP.ToString() == string.Empty)
            {
                int num1 =
                    (int)
                        MessageBox.Show(
                            "LCD ağ ayarları yapılandırılmamış. Lütfen ağ ayarlarını gelecek pencereden ayarlayınız.",
                            "Hoşgeldiniz", MessageBoxButtons.OK, MessageBoxIcon.Question);


                int num2 = (int)new W_QLUSettings()
                {
                    tabControl1 =
                    {
                        SelectedIndex = 2
                    }
                }.ShowDialog();
            }
            else if (!Program.IsServerStarted)
            {
                int num1 =
                    (int)
                        MessageBox.Show(
                            "LCD tablo ağa bağlanamıyor! Lütfen ayarladığınız LCD IP adresinin doğruluğunu kontrol ediniz.",
                            "Hata", MessageBoxButtons.OK, MessageBoxIcon.Hand);
                int num2 = (int)new W_QLUSettings()
                {
                    tabControl1 =
                    {
                        SelectedIndex = 2
                    }
                }.ShowDialog();
            }
            else
            {
                //MessageBox.Show("3");
                sp = new SoundPlayer { SoundLocation = Settings.Default.SesURL };
                showOnMonitor(Settings.Default.EkranNo);
                lbl_UstBaslik.Text = Settings.Default.UstBaslik;
                lbl_AltBaslik.Text = Settings.Default.AltBaslik;
                VideoURL = Settings.Default.VideoURL;
                timer_Saat.Start();
                //timer_Animation.Enabled = false;
                if (!Connection.CheckQPUServer())
                {
                    int num1 =
                        (int)
                            MessageBox.Show("'" + Settings.Default.ServerIP.ToString() + "' " +
                                "Servera ulaşılamıyor. Lütfen ağ ayarlarınızın doğruluğundan ve server programının çalıştığından emin olduktan sonra programı yeniden başlatınız.",
                                "Uyarı", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
                }
                else if (!Connection.ServerRegister())
                {
                    int num2 =
                        (int)
                            MessageBox.Show(
                                "Servera kayıt işlemi gerçekleşemedi. Lüften ağ ayarlarınızı kontrol ediniz.", "Uyarı",
                                MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
                }
                else
                {
                    //MessageBox.Show("4");
                    Program.com.Ticket_Returned += com_Ticket_Returned;
                    Program.com.Header_Returned += com_Header_Returned;
                    Program.com.Footer_Returned += com_Footer_Returned;
                    Program.com.Command_Returned += com_Command_Returned;

                    //media Paneli ayarla mt
                    _mediaTipi = Convert.ToInt32(Settings.Default.MediaTipi);
                    switch (_mediaTipi)
                    {
                        case 0: //media yok
                            //media paneli gösterme
                            //MessageBox.Show("5");
                            pnl_AnaSag.Visible = false;
                            pnl_AnaSol.Dock = DockStyle.Fill;
                            pnlCagriSatirlari.Dock = DockStyle.Fill;

                            pnl_AnaSag.Visible = false;
                            pnl_AnaSol.Dock = DockStyle.Fill;
                            break;
                        case 1: //video
                            VideoSet();
                            break;
                        case 2: //tivi
                            TvSet();
                            break;
                        case 3: //www
                            WebMediaSet();
                            break;
                        case 4: //www
                            BeklemeListesiSet();
                            break;
                        case 5: //www
                            TekSatirSet();
                            break;
                        case 6: //www
                            BankoIsimliSet(); //inter aktif değişken
                            break;
                        case 7: //www
                            MusteriIsımliSet();//inter aktif değişken isimlisi - kbb  yok
                            break;
                        case 8: //www
                            MusteriVeBankoIsimli(); //inter aktif değişken müşteri isimli
                            break;
                        case 9: //www
                            MusteriVeBankoIsimli(); //sabit ana tablo, grupları bas, nomeroyu değiştir.
                            break;
                        //case 9: //www
                        //    MusteriVeBankoIsimli(); //sabit ana tablo, grupları bas, nomeroyu değiştir.
                        //    break;
                        default:
                            pnl_AnaSag.Visible = false;
                            pnl_AnaSol.Dock = DockStyle.Fill;
                            break;
                    }
                }
            }
        }

        private void MusteriVeBankoIsimli()
        {
            //paralel ana tabloda bilet nonun yanında yada altında müşteri adını yaz.
        }

        private void MusteriIsımliSet()
        {
            //bilet nonun yanında yada altında müşteri adı yazacak. tek satır mı çok satır mı?
        }

        private void BankoIsimliSet()
        {
            //paralel ana tablo
            //lcd ye bağlı terminallere bağlı grupları çek.
            //her satırda bir grup göster, o satırda o grubun numarasını yaz.

            pnl_AnaSag.Visible = false;
            pnl_AnaSol.Dock = DockStyle.Fill;
        }

        private void TekSatirSet()
        {
            pnl_AnaSag.Visible = false;
            pnl_AnaSol.Dock = DockStyle.Fill;

            //aşağı doğru da fill olacak, font da büyümeli.
        }

        private void BeklemeListesiSet()
        {
            string strWhereForTermGroup = "limit 7";// string.Empty;

            //for (int i = 0; i < dtTerminalGroups.Rows.Count; i++)
            //{
            //    strWhereForTermGroup = string.Format(
            //        "{0} (KUYRUK.GRPID= {1}) OR", strWhereForTermGroup, dtTerminalGroups.Rows[i][0]);
            //}
            //strWhereForTermGroup = strWhereForTermGroup.Substring(0, strWhereForTermGroup.Length - 2);

            DataTable dtAllTickets = (DataTable)DBProcess.SimpleQuery(
                "KUYRUK INNER JOIN GRUPLAR ON KUYRUK.GRPID = GRUPLAR.GRPID JOIN BILETLER B ON KUYRUK.BID = B.BID " +
                "JOIN TERMINAL_GRUP TG ON GRUPLAR.GRPID = TG.GRPID " +
                "JOIN ANATABLO_YON AT ON TG.TID = AT.TID AND AT.ATID = " + Settings.Default.AnatabloID.ToString(),
                strWhereForTermGroup,
                "", " DISTINCT GRUPLAR.GRUP_ISMI, KUYRUK.BID, KUYRUK.GRPID, KUYRUK.BILET_NO, B.MusteriAdi " //şahinbey belediyesi için top 7 eklendi.
                )["DataTable"];

            DGVTicketLists.DataSource = dtAllTickets;

            pnl_AnaSag.Dock = DockStyle.Fill;
            pnl_AnaSol.Dock = DockStyle.Left;
            panelBekleyenListesi.Dock = DockStyle.Fill;
            panelBekleyenListesi.Visible = true;

            panelTv.Visible = false;
            panelWeb.Visible = false;
        }

        private void WebMediaSet()
        {
            pnl_AnaSag.Dock = DockStyle.Fill;
            pnl_AnaSol.Dock = DockStyle.Left;
            panelWeb.Dock = DockStyle.Fill;
            panelWeb.Visible = true;

            panelTv.Visible = false;
            panelBekleyenListesi.Visible = false;
        }

        private void VideoSet()
        {
            WMPlayer.URL = VideoURL;
            WMPlayer.settings.setMode("loop", true);
            WMPlayer.stretchToFit = true;

            WMPlayer.BringToFront();
            WMPlayer.Dock = DockStyle.Fill;
            WMPlayer.uiMode = "none";
            WMPlayer.Ctlcontrols.play();

            pnl_AnaSag.Dock = DockStyle.Fill;
            pnl_AnaSol.Dock = DockStyle.Left;
            panelVideo.Visible = true;
            panelVideo.Dock = DockStyle.Fill;

            //diğerlerini kapa
            panelTv.Visible = false;
            panelWeb.Visible = false;
            panelBekleyenListesi.Visible = false;
        }

        private void TvSet()
        {
            //try
            //{
            //    // Get current devices and dispose of capture object
            //    // because the video and audio device can only be changed
            //    // by creating a new Capture object.
            //    Filter videoDevice = null;
            //    Filter audioDevice = null;

            //    if (_capture != null)
            //    {
            //        videoDevice = _capture.VideoDevice;
            //        audioDevice = _capture.AudioDevice;
            //        _capture.Dispose();
            //        _capture = null;
            //    }

            //    // Get new video device
            //    int kaynakDeviceIndex = Convert.ToInt32(Settings.Default.TvKaynakIndex - 1);
            //    int kaynakKanal = Convert.ToInt32(Settings.Default.TvKanal);
            //    if (kaynakDeviceIndex > -1) videoDevice = filters.VideoInputDevices[kaynakDeviceIndex];

            //    // Create capture object
            //    if ((videoDevice != null) || (audioDevice != null))
            //    {
            //        _capture = new Capture(videoDevice, audioDevice, false);
            //        _capture.PreviewWindow = panelTv;
            //        if (kaynakKanal > 0) _capture.Tuner.SetFrequency(kaynakKanal);

            //        pnl_AnaSag.Dock = DockStyle.Fill;
            //        pnl_AnaSol.Dock = DockStyle.Left;
            //        panelTv.Visible = true;
            //        panelTv.Dock = DockStyle.Fill;

            //        //diğerlerini kapa
            //        panelWeb.Visible = false;
            //        WMPlayer.Visible = false;
            //        panelBekleyenListesi.Visible = false;
            //        WMPlayer.Ctlcontrols.stop();
            //    }

            //    // Update the menu
            //    //updateMenu();
            //}
            //catch (Exception ex)
            //{
            //    MessageBox.Show("Video device not supported.\n\n" + ex.Message + "\n\n" + ex.ToString());
            //}
        }

        private void com_Command_Returned(string _Sonuc, string _SonucBilgisi)
        {
            if (!(_Sonuc == "000"))
                return;
            int num1 =
                (int)
                    MessageBox.Show(
                        "Veritabanında " + Settings.Default.AnatabloID +
                        " adresine ait bir LCD tablo kaydı bulunmuyor. Lütfen LCD ayarlarını kontrol ediniz.", "Uyarı",
                        MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
            int num2 = (int)new W_QLUSettings().ShowDialog();
        }

        private void com_Footer_Returned(string _AltBaskik)
        {
            if (lbl_AltBaslik.InvokeRequired)
                lbl_AltBaslik.Invoke(new updateAltBaslikLabelDelegate(com_Footer_Returned),
                    new object[1]
                    {
                        _AltBaskik
                    });
            else
                lbl_AltBaslik.Text = _AltBaskik;
        }

        private void com_Header_Returned(string _UstBaslik)
        {
            if (lbl_UstBaslik.InvokeRequired)
                lbl_UstBaslik.Invoke(new updateUstBaslikLabelDelegate(com_Header_Returned),
                    new object[1]
                    {
                        _UstBaslik
                    });
            else
                lbl_UstBaslik.Text = _UstBaslik;
        }

        private void com_Ticket_Returned(Datas veri)
        {
            BiletVerileriDoldur(veri);
        }

        private void timer_Saat_Tick(object sender, EventArgs e)
        {
            try
            {
                label1.Text = DateTime.Now.TimeOfDay.ToString().Substring(0, 8);
                TimeSpan time = new TimeSpan(00, 00, 00);

                if (label1.Text == time.ToString())
                {
                    //lbl_BiletNo1.Text = lbl_BiletNo2.Text = lbl_BiletNo3.Text = lbl_BiletNo4.Text = "";
                    //lbl_VezneNo1.Text = lbl_VezneNo2.Text = lbl_VezneNo3.Text = lbl_VezneNo4.Text = "";
                    //pic_Yon1.Image = pic_Yon2.Image = pic_Yon3.Image = pic_Yon4.Image = null;
                    //animasyonDeger = 0;
                    //_Veriler.Clear();
                    _satirSayisi = 0;
                    _satirSayisi2 = 0;
                    //_silinecekSatirSayisi = 1;
                    pnlCagriSatirlari.Controls.Clear();
                    BeklemeListesiSet();
                }
            }
            catch (Exception ex)
            {
                pnlCagriSatirlari.Controls.Clear();
                BeklemeListesiSet();
            }


        }

        private void timer_KayanYazi1_Tick(object sender, EventArgs e)
        {
            if (Yon1)
            {
                lbl_UstBaslik.Left = lbl_UstBaslik.Left + 2;
                if (lbl_UstBaslik.Left <= pnl_UstBaslik.Width)
                    return;
                lbl_UstBaslik.Left = 1 - lbl_UstBaslik.Width;
            }
            else
            {
                lbl_UstBaslik.Left = lbl_UstBaslik.Left - 2;
                if (lbl_UstBaslik.Right > 0)
                    return;
                lbl_UstBaslik.Left = pnl_UstBaslik.Width;
            }
        }

        private void timer_KayanYazi2_Tick(object sender, EventArgs e)
        {
            if (Yon2)
            {
                lbl_AltBaslik.Left = lbl_AltBaslik.Left + 2;
                if (lbl_AltBaslik.Left <= pnl_AltBaslik.Width)
                    return;
                lbl_AltBaslik.Left = 1 - lbl_AltBaslik.Width;
            }
            else
            {
                lbl_AltBaslik.Left = lbl_AltBaslik.Left - 2;
                if (lbl_AltBaslik.Right > 0)
                    return;
                lbl_AltBaslik.Left = pnl_AltBaslik.Width;
            }
        }

        private void W_QLU1_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (Connection.GetIP() == string.Empty)
                return;
            //this.analogClock1.Dispose();
            //timer_Animation.Stop();
            timer_KayanYazi1.Stop();
            WMPlayer.Dispose();
            if (Connection.CheckQPUServer())
                Connection.ServerUnRegister();
            if (!Program.thReadServer.IsAlive)
                return;
            Program.clientSocket.Close();
            Program.serverSocket.Stop();
            Program.thReadServer.Interrupt();
            if (!Program.thReadServer.Join(2000))
                return;
            Program.thReadServer.Abort();
        }

        private void W_QLU1_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode != Keys.A || ModifierKeys != Keys.Control)
                return;
            //SaatMaxHeight = pnl_Saat.Height;
            int num = (int)new W_QLUSettings().ShowDialog();
            lbl_UstBaslik.Text = Settings.Default.UstBaslik;
            lbl_AltBaslik.Text = Settings.Default.AltBaslik;
            //VideoURL = Settings.Default.VideoURL;
            //WMPlayer.URL = VideoURL;
            //this.WMPlayer.Ctlcontrols.play();
            //TvSet();
            FormBilgileriAyarla();
        }

        private Datas TrimBeginingZeros(Datas _data)
        {
            _data.BiletNo = _data.BiletNo.TrimStart(new char[1]
            {
                '0'
            });
            _data.VezneNo = _data.VezneNo.TrimStart(new char[1]
            {
                '0'
            });
            return _data;
        }

        private void BiletVerileriDoldur(Datas _Veri)
        {
            _Veri = TrimBeginingZeros(_Veri);
            #region satirlari yaz eski rutin

            //if (_Veriler.Count < 4)
            //{
            //    Datas datas = new Datas()
            //    {
            //        BiletNo = "",
            //        VezneNo = "",
            //        OkYonu = Ways.Kapali
            //    };
            //    _Veriler.Add(datas);
            //    _Veriler.Add(datas);
            //    _Veriler.Add(datas);
            //    _Veriler.Add(datas);
            //}
            //if (_Veriler.Count == 4)
            //    _Veriler.RemoveAt(0);
            //_Veriler.Add(_Veri);


            //lbl_BiletNo1.Text = _Veriler[3].BiletNo;
            //lbl_VezneNo1.Text = _Veriler[3].VezneNo;
            //switch (_Veriler[3].OkYonu)
            //{
            //    case Ways.Yukari:
            //        pic_Yon1.Image = Resources.YukariYonOku;
            //        break;
            //    case Ways.Asagi:
            //        pic_Yon1.Image = Resources.AltYonOku;
            //        break;
            //    case Ways.Ileri:
            //        pic_Yon1.Image = Resources.SagYonOku;
            //        break;
            //    case Ways.Geri:
            //        pic_Yon1.Image = Resources.SolYonOku;
            //        break;
            //    case Ways.Kapali:
            //        pic_Yon1.Image = Resources.uyari;
            //        break;
            //}
            //lbl_BiletNo2.Text = _Veriler[2].BiletNo;
            //lbl_VezneNo2.Text = _Veriler[2].VezneNo;
            //switch (_Veriler[2].OkYonu)
            //{
            //    case Ways.Yukari:
            //        pic_Yon2.Image = Resources.YukariYonOku;
            //        break;
            //    case Ways.Asagi:
            //        pic_Yon2.Image = Resources.AltYonOku;
            //        break;
            //    case Ways.Ileri:
            //        pic_Yon2.Image = Resources.SagYonOku;
            //        break;
            //    case Ways.Geri:
            //        pic_Yon2.Image = Resources.SolYonOku;
            //        break;
            //    case Ways.Kapali:
            //        pic_Yon2.Image = Resources.uyari;
            //        break;
            //}
            //lbl_BiletNo3.Text = _Veriler[1].BiletNo;
            //lbl_VezneNo3.Text = _Veriler[1].VezneNo;
            //switch (_Veriler[1].OkYonu)
            //{
            //    case Ways.Yukari:
            //        pic_Yon3.Image = Resources.YukariYonOku;
            //        break;
            //    case Ways.Asagi:
            //        pic_Yon3.Image = Resources.AltYonOku;
            //        break;
            //    case Ways.Ileri:
            //        pic_Yon3.Image = Resources.SagYonOku;
            //        break;
            //    case Ways.Geri:
            //        pic_Yon3.Image = Resources.SolYonOku;
            //        break;
            //    case Ways.Kapali:
            //        pic_Yon3.Image = Resources.uyari;
            //        break;
            //}
            //lbl_BiletNo4.Text = _Veriler[0].BiletNo;
            //lbl_VezneNo4.Text = _Veriler[0].VezneNo;
            //switch (_Veriler[0].OkYonu)
            //{
            //    case Ways.Yukari:
            //        pic_Yon4.Image = Resources.YukariYonOku;
            //        break;
            //    case Ways.Asagi:
            //        pic_Yon4.Image = Resources.AltYonOku;
            //        break;
            //    case Ways.Ileri:
            //        pic_Yon4.Image = Resources.SagYonOku;
            //        break;
            //    case Ways.Geri:
            //        pic_Yon4.Image = Resources.SolYonOku;
            //        break;
            //    case Ways.Kapali:
            //        pic_Yon4.Image = Resources.uyari;
            //        break;
            //} 
            #endregion

            //terminal bilgileri
            string terminalTipi = "";
            string grupAdi = "";
            string dataSource = Settings.Default.ServerIP;
            string dbName = "QCU";
            string dbUserName = Settings.Default.dbUserName;
            string dbPass = Settings.Default.dbPassword;
            int gosterilecekSatirAdedi = Convert.ToInt32(Settings.Default.SatirSayisi);

            string conStr = string.Format("Data Source={0};Initial Catalog={1};User ID={2};Password={3}", dataSource,
                dbName, dbUserName, dbPass);

            using (MySqlConnection connection = new MySqlConnection(conStr))
            {
                string terminalId = _Veri.VezneNo;
                string queryString = "SELECT * from TERMINALLER  WHERE ELTID= " + terminalId;

                int tid = 0;
                MySqlCommand command = new MySqlCommand(queryString, connection);
                connection.Open();
                MySqlDataReader reader = command.ExecuteReader();
                try
                {
                    while (reader.Read())
                    {
                        terminalTipi = reader["TerminalTipi"].ToString() + ".wav";
                        tid = Convert.ToInt32(reader["TID"].ToString());
                    }
                }
                finally
                {
                    // Always call Close when done reading.
                    reader.Close();
                    connection.Close();
                }

                queryString = "SELECT TID, G.GRPID, GRUP_ISMI from TERMINAL_GRUP TG "
                            + "JOIN GRUPLAR G ON TG.GRPID = G.GRPID AND TID = " + tid;
                MySqlCommand command2 = new MySqlCommand(queryString, connection);
                connection.Open();
                MySqlDataReader reader2 = command2.ExecuteReader();
                try
                {
                    while (reader2.Read())
                    {
                        grupAdi = reader2["GRUP_ISMI"].ToString();
                    }
                }
                finally
                {
                    // Always call Close when done reading.
                    reader2.Close();
                    connection.Close();
                }
            }

            if (this.InvokeRequired)
            {
                this.BeginInvoke((MethodInvoker)delegate ()
                {
                    if (_mediaTipi == 5)
                    {
                        pnlCagriSatirlari.Controls.Clear(); //tek satır göstereceğiz.
                    }

                    if (_mediaTipi == 4)
                    {
                        BeklemeListesiSet();
                    }

                    if (_mediaTipi == 6)
                    {
                        AnaTabloSatir atSatir = new AnaTabloSatir
                        {
                            Dock = DockStyle.Fill,
                            //grup adını al

                            lbl_GrupAdi = { Text = grupAdi },
                            lbl_BiletNo =
                            {
                                Text = _Veri.BiletNo,
                                Font = new Font(Settings.Default.CagNoFont, (float) Settings.Default.CagNoPunto),
                                ForeColor = Color.FromArgb(Settings.Default.CagNoRenk)
                            },
                            lbl_VezneNo =
                            {
                                Text = _Veri.VezneNo,
                                Font = new Font(Settings.Default.CagNoFont, (float) Settings.Default.CagNoPunto),
                                ForeColor = Color.FromArgb(Settings.Default.CagNoRenk)
                            },
                            pic_Yon = { Image = Resources.YukariYonOku },
                            Width = 526,
                            //Height = 600,
                            Name = "satir" + _Veri.BiletNo,
                            BackColor = Color.FromArgb(Settings.Default.LCDFormArkaplanRenk)
                        };

                        switch (_Veri.OkYonu)
                        {
                            case Ways.Yukari:
                                atSatir.pic_Yon.Image = Resources.YukariYonOku;
                                break;
                            case Ways.Asagi:
                                atSatir.pic_Yon.Image = Resources.AltYonOku;
                                break;
                            case Ways.Ileri:
                                atSatir.pic_Yon.Image = Resources.SagYonOku;
                                break;
                            case Ways.Geri:
                                atSatir.pic_Yon.Image = Resources.SolYonOku;
                                break;
                            case Ways.Kapali:
                                atSatir.pic_Yon.Image = Resources.uyari;
                                break;
                        };

                        atSatir.timer_Animation.Start();
                        pnlCagriSatirlari.Controls.Add(atSatir);
                        atSatir.SendToBack();
                    }
                    else
                    {
                        //normal hal
                        ++_satirSayisi;
                        ++_satirSayisi2;
                        Satir satir = new Satir
                        {
                            Dock = DockStyle.Top,
                            lbl_BiletNo =
                            {
                                Text = _Veri.BiletNo,
                                Font = new Font(Settings.Default.CagNoFont, (float) Settings.Default.CagNoPunto),
                                ForeColor = Color.FromArgb(Settings.Default.CagNoRenk)
                            },
                            lbl_VezneNo =
                            {
                                Text = _Veri.VezneNo,
                                Font = new Font(Settings.Default.CagNoFont, (float) Settings.Default.CagNoPunto),
                                ForeColor = Color.FromArgb(Settings.Default.CagNoRenk)
                            },
                            label1 =
                            {
                                Text = "satir" + _satirSayisi2.ToString()
                            },
                            pic_Yon = { Image = Resources.YukariYonOku },
                            Width = 526,
                            Name = "satir" + _satirSayisi2.ToString(), // _Veri.BiletNo,
                            BackColor = Color.FromArgb(Settings.Default.LCDFormArkaplanRenk)
                        };
                        if (_mediaTipi == 5) satir.Dock = DockStyle.Fill;

                        switch (_Veri.OkYonu)
                        {
                            case Ways.Yukari:
                                satir.pic_Yon.Image = Resources.YukariYonOku;
                                break;
                            case Ways.Asagi:
                                satir.pic_Yon.Image = Resources.AltYonOku;
                                break;
                            case Ways.Ileri:
                                satir.pic_Yon.Image = Resources.SagYonOku;
                                break;
                            case Ways.Geri:
                                satir.pic_Yon.Image = Resources.SolYonOku;
                                break;
                            case Ways.Kapali:
                                satir.pic_Yon.Image = Resources.uyari;
                                break;
                        };

                        satir.timer_Animation.Start();
                        if (_mediaTipi == 0)
                        {
                            float width = satir.Width;
                            //satir.Height = 

                            pnlCagriSatirlari.Controls.Clear();
                            //_satirSayisi = 1;
                            pnlCagriSatirlari.Dock = DockStyle.Fill;
                            satir.Dock = DockStyle.Fill;
                            pnl_AnaSol.Dock = DockStyle.Fill;

                            Font font2 = new Font(Settings.Default.CagNoFont, (float)Settings.Default.CagNoPuntoTekSatır);
                            satir.lbl_BiletNo.Font = font2;
                            satir.lbl_VezneNo.Font = font2;
                        }

                        if (_satirSayisi2 > 1) //BİR ÖNCEKİ KIRMIZI OLMASIN
                        {
                            foreach (var ekliSatir in pnlCagriSatirlari.Controls)
                            {
                                var satir1 = ekliSatir as Satir;
                                if (satir1 != null)
                                {
                                    if (satir1.Name == "satir" + (_satirSayisi2 - 1).ToString())
                                    {
                                        satir1.lbl_BiletNo.BackColor = SystemColors.Control;
                                        satir1.lbl_VezneNo.BackColor = SystemColors.Control;
                                    }
                                }
                            }
                        }

                        if (_mediaTipi != 0)
                            if (_satirSayisi > gosterilecekSatirAdedi)
                            {
                                //pnlCagriSatirlari.Controls.Remove(pnlCagriSatirlari.Controls[0]);
                                pnlCagriSatirlari.Controls[0].Dispose();
                                //_satirSayisi--;

                                //foreach (var ekliSatir in pnlCagriSatirlari.Controls)
                                //{
                                //    var satir1 = ekliSatir as Satir;
                                //    if (satir1 != null)
                                //    {
                                //        if (satir1.Name == "satir" + silinecekSatirSayisi.ToString())
                                //        {
                                //            pnlCagriSatirlari.Controls.Remove(satir1);
                                //            satir1.Dispose();
                                //            --satirSayisi;
                                //            ++silinecekSatirSayisi;
                                //            break;
                                //        }
                                //    }
                                //}
                            }
                        pnlCagriSatirlari.Controls.Add(satir);
                        satir.SendToBack();
                        //pnlCagriSatirlari.SendToBack();
                        //pnl_AnaSol.SendToBack();
                    }
                });
            }

            sp.Play();


            if (Settings.Default.Ses == "Sesli Çağrı")
            {
                //oku
                string yazi = YaziyaCevir(Convert.ToDecimal(_Veri.BiletNo));
                yazi += "numara.wav;###;lütfen.wav;###;";
                yazi += YaziyaCevir2(Convert.ToDecimal(_Veri.VezneNo));
                yazi += terminalTipi;

                Thread.Sleep(2000);
                Oku(yazi);
            }

            if (Settings.Default.Ses == "Sesli Çağrı (Arapça)")
            {
                //oku
                string yazi = "lütfen.wav;###;numara.wav;###;###;###;";
                yazi += YaziyaCevir(Convert.ToDecimal(_Veri.BiletNo));
                yazi += terminalTipi + ";###;";
                yazi += YaziyaCevir2(Convert.ToDecimal(_Veri.VezneNo));
                yazi = yazi.Substring(0, (yazi.Length - 1));

                Thread.Sleep(2000);
                //MessageBox.Show(yazi);
                Oku(yazi);
            }

            //BeklemeListesiSet();
        }

        public string YaziyaCevir(decimal tutar)
        {
            string sTutar = tutar.ToString("F2").Replace('.', ',');
            // Replace('.',',') ondalık ayracının . olma durumu için           
            string lira = sTutar.Substring(0, sTutar.IndexOf(',')); //tutarın tam kısmı
            //string kurus = sTutar.Substring(sTutar.IndexOf(',') + 1, 2);
            string yazi = "";

            string[] birler = { "", "1.wav;", "2.wav;", "3.wav;", "4.wav;", "5.wav;", "6.wav;", "7.wav;", "8.wav;", "9.wav;" };
            string[] onlar =
            {
                "", "10.wav;", "20.wav;", "30.wav;", "40.wav;", "50.wav;", "60.wav;", "70.wav;", "80.wav;",
                "90.wav;"
            };
            string[] binler = { "KATRİLYON", "TRİLYON", "MİLYAR", "MİLYON", "1000.wav;", "" };
            //KATRİLYON'un önüne ekleme yapılarak artırabilir.

            int grupSayisi = 6; //sayıdaki 3'lü grup sayısı. katrilyon içi 6. (1.234,00 daki grup sayısı 2'dir.)
            //KATRİLYON'un başına ekleyeceğiniz her değer için grup sayısını artırınız.

            lira = lira.PadLeft(grupSayisi * 3, '0');
            //sayının soluna '0' eklenerek sayı 'grup sayısı x 3' basakmaklı yapılıyor.           

            string grupDegeri;

            for (int i = 0; i < grupSayisi * 3; i += 3) //sayı 3'erli gruplar halinde ele alınıyor.
            {
                grupDegeri = "";

                if (lira.Substring(i, 1) != "0")
                {
                    grupDegeri += birler[Convert.ToInt32(lira.Substring(i, 1))] + "100.wav;"; //yüzler               
                   // grupDegeri += "###;";
                }
                if (grupDegeri == "1.wav;100.wav;")
                {//biryüz düzeltiliyor.
                    grupDegeri = "100.wav;";
                    grupDegeri += "###;";
                }
                if (Settings.Default.Ses == "Sesli Çağrı (Arapça)")
                {
                    if (grupDegeri == "2.wav;100.wav;")
                    {//ikiyüz düzeltiliyor.
                        grupDegeri = "200.wav;";
                        grupDegeri += "###;";
                    }
                }

                if (Settings.Default.Ses == "Sesli Çağrı (Arapça)")
                {
                    switch (lira.Substring(i + 1, 2))
                    {
                        case "11":
                            grupDegeri += "11.wav; ###;";
                            break;
                        case "12":
                            grupDegeri += "12.wav;###;";
                            break;
                        case "13":
                            grupDegeri += "13.wav;###;";
                            break;
                        case "14":
                            grupDegeri += "14.wav;###;";
                            break;
                        case "15":
                            grupDegeri += "15.wav;###;";
                            break;
                        case "16":
                            grupDegeri += "16.wav;###;";
                            break;
                        case "17":
                            grupDegeri += "17.wav;###;";
                            break;
                        case "18":
                            grupDegeri += "18.wav;###;";
                            break;
                        case "19":
                            grupDegeri += "19.wav;###;";
                            break;
                        default:
                            grupDegeri += birler[Convert.ToInt32(lira.Substring(i + 2, 1))];
                            if (lira.Substring(i + 1, 2) != "0")
                            {
                                //grupDegeri += "###;";
                            }
                            
                            if (lira.Substring(i + 1, 1) != "0" & lira.Substring(i + 1, 1) != "1")
                                grupDegeri += "wa.wav;###;";
                            grupDegeri += onlar[Convert.ToInt32(lira.Substring(i + 1, 1))];
                            if (lira.Substring(i + 1, 1) != "0")
                            {
                                grupDegeri += "###;";
                            }
                            break;
                    }
                   

                    //birler  

                    //onlar
                }
                else
                {
                    grupDegeri += onlar[Convert.ToInt32(lira.Substring(i + 1, 1))]; //onlar

                    grupDegeri += birler[Convert.ToInt32(lira.Substring(i + 2, 1))]; //birler               
                }



                if (grupDegeri != "") //binler
                    grupDegeri += binler[i / 3];
                if (grupDegeri == "1.wav;1000.wav;") //birbin düzeltiliyor.
                    grupDegeri = "1000.wav;";
                //if (binler[i / 3] != binler[5] & binler[i / 3] != binler[0])
                //    grupDegeri += "wa.wav";

                yazi += grupDegeri;
            }

            //if (yazi != "") yazi += " TL ";

            //int yaziUzunlugu = yazi.Length;

            //if (kurus.Substring(0, 1) != "0") //kuruş onlar
            //    yazi += onlar[Convert.ToInt32(kurus.Substring(0, 1))];

            //if (kurus.Substring(1, 1) != "0") //kuruş birler
            //    yazi += birler[Convert.ToInt32(kurus.Substring(1, 1))];

            //if (yazi.Length > yaziUzunlugu)
            //    yazi += " Kr.";
            //else
            //    yazi += "SIFIR Kr.";
            return yazi;
        }

        public string YaziyaCevir2(decimal tutar)
        {
            string sTutar = tutar.ToString("F2").Replace('.', ',');
            // Replace('.',',') ondalık ayracının . olma durumu için           
            string lira = sTutar.Substring(0, sTutar.IndexOf(',')); //tutarın tam kısmı
            //string kurus = sTutar.Substring(sTutar.IndexOf(',') + 1, 2);
            string yazi = "";

            string[] birler = { "", "birinci.wav;###;", "ikinci.wav;###;", "üçüncü.wav;###;", "dördüncü.wav;###;", "beşinci.wav;###;", "altıncı.wav;###;", "yedinci.wav;###;", "sekizinci.wav;###;", "dokuzuncu.wav;###;" };
            string[] onlar = new string[10];
            if (tutar % 10 != 0)
            {
                onlar[0] = "";
                onlar[1] = "10.wav;";
                onlar[2] = "20.wav;";
                onlar[3] = "30.wav;";
                onlar[4] = "40.wav;";
                onlar[5] = "50.wav;";
                onlar[6] = "60.wav;";
                onlar[7] = "70.wav;";
                onlar[8] = "80.wav;";
                onlar[9] = "90.wav;";
            }
            else
            {
                onlar[0] = "";
                onlar[1] = "onuncu.wav;###;";
                onlar[2] = "yirminci.wav;###;";
                onlar[3] = "otuzuncu.wav;###;";
                onlar[4] = "kırkıncı.wav;###;";
                onlar[5] = "ellinci.wav;###;";
                onlar[6] = "atmışıncı.wav;###;";
                onlar[7] = "yetmişinci.wav;###;";
                onlar[8] = "sekseninci.wav;###;";
                onlar[9] = "doksanıncı.wav;###;";
            }
            string[] binler = { "KATRİLYON", "TRİLYON", "MİLYAR", "MİLYON", "1000.wav;", "" };
            //KATRİLYON'un önüne ekleme yapılarak artırabilir.

            int grupSayisi = 6; //sayıdaki 3'lü grup sayısı. katrilyon içi 6. (1.234,00 daki grup sayısı 2'dir.)
            //KATRİLYON'un başına ekleyeceğiniz her değer için grup sayısını artırınız.

            lira = lira.PadLeft(grupSayisi * 3, '0');
            //sayının soluna '0' eklenerek sayı 'grup sayısı x 3' basakmaklı yapılıyor.           

            string grupDegeri;

            for (int i = 0; i < grupSayisi * 3; i += 3) //sayı 3'erli gruplar halinde ele alınıyor.
            {
                grupDegeri = "";

                if (lira.Substring(i, 1) != "0")
                    grupDegeri += birler[Convert.ToInt32(lira.Substring(i, 1))] + "100.wav;"; //yüzler               

                if (grupDegeri == "1.wav;100.wav;") //biryüz düzeltiliyor.
                    grupDegeri = "100.wav;";

                if (Settings.Default.Ses == "Sesli Çağrı (Arapça)")
                {
                    grupDegeri += birler[Convert.ToInt32(lira.Substring(i + 2, 1))]; //birler 

                    grupDegeri += onlar[Convert.ToInt32(lira.Substring(i + 1, 1))]; //onlar

                    //grupDegeri += "###;";
                }
                else
                {
                    grupDegeri += onlar[Convert.ToInt32(lira.Substring(i + 1, 1))]; //onlar

                    grupDegeri += birler[Convert.ToInt32(lira.Substring(i + 2, 1))]; //birler               
                }

                if (grupDegeri != "") //binler
                    grupDegeri += binler[i / 3];

                if (grupDegeri == "1.wav;1000.wav;") //birbin düzeltiliyor.
                    grupDegeri = "1000.wav;";

                yazi += grupDegeri;
            }

            //if (yazi != "") yazi += " TL ";

            //int yaziUzunlugu = yazi.Length;

            //if (kurus.Substring(0, 1) != "0") //kuruş onlar
            //    yazi += onlar[Convert.ToInt32(kurus.Substring(0, 1))];

            //if (kurus.Substring(1, 1) != "0") //kuruş birler
            //    yazi += birler[Convert.ToInt32(kurus.Substring(1, 1))];

            //if (yazi.Length > yaziUzunlugu)
            //    yazi += " Kr.";
            //else
            //    yazi += "SIFIR Kr.";
            return yazi;
        }

        private static void Oku(string yazi)
        {
            string[] sesler = yazi.Split(';');
            SoundPlayer mysp = new SoundPlayer();
            foreach (var ses in sesler)
            {
                if (ses == "###")
                {
                    Thread.Sleep(500);
                }
                else
                {
                    mysp.SoundLocation = @"C:\Omes\wavs\" + ses;
                    mysp.Play();
                    Thread.Sleep(600);
                }
            }
        }

        private void showOnMonitor(Decimal _monitorIndex)
        {
            try
            {
                int index = Convert.ToInt32(_monitorIndex);
                Screen[] allScreens = Screen.AllScreens;
                if (_monitorIndex >= allScreens.Length)
                    _monitorIndex = new Decimal(0);
                StartPosition = FormStartPosition.Manual;
                Location = new Point(allScreens[index].Bounds.Left, allScreens[index].Bounds.Top);
                WindowState = FormWindowState.Normal;
                WindowState = FormWindowState.Maximized;
            }
            catch (Exception ex)
            {
                int num =
                    (int)MessageBox.Show("Ayarladığınız ekran bulunamadı.\nProgram varsayılan ekranda başlayacaktır.");
                Settings.Default.EkranNo = 0;
                Settings.Default.Save();
                showOnMonitor(new Decimal(0));
            }
        }

        private void CagNoAyarla()
        {
            try
            {
                //lbl_BiletNo1.Font =
                //    lbl_BiletNo2.Font =
                //        lbl_BiletNo3.Font =
                //            lbl_BiletNo4.Font =
                //                lbl_VezneNo1.Font =
                //                    lbl_VezneNo2.Font =
                //                        lbl_VezneNo3.Font =
                //                            lbl_VezneNo4.Font =
                //                                new Font(Settings.Default.CagNoFont, (float) Settings.Default.CagNoPunto);
                //lbl_BiletNo1.ForeColor =
                //    lbl_BiletNo2.ForeColor =
                //        lbl_BiletNo3.ForeColor =
                //            lbl_BiletNo4.ForeColor =
                //                lbl_VezneNo1.ForeColor =
                //                    lbl_VezneNo2.ForeColor =
                //                        lbl_VezneNo3.ForeColor =
                //                            lbl_VezneNo4.ForeColor = Color.FromArgb(Settings.Default.CagNoRenk);
            }
            catch
            {
            }
        }

        private void FormBilgileriAyarla()
        {
            try
            {
                lbl_AltBaslik.Font = new Font(Settings.Default.KayanYaziFont,
                    (float)Settings.Default.KayanYaziPunto);
                lbl_UstBaslik.Font = new Font(Settings.Default.KayanYaziFont,
                    (float)Settings.Default.KayanYaziPunto);
            }
            catch
            {
            }

            CagNoAyarla();
            try
            {
                pnl_UstBaslik.Height = lbl_UstBaslik.Height + 5;
                pnl_AltBaslik.Height = lbl_AltBaslik.Height + 5;
                pnl_AnaSol.Height = Height - (pnl_UstBaslik.Height + pnl_AltBaslik.Height);
                pnl_AnaSag.Height = Height - (pnl_UstBaslik.Height + pnl_AltBaslik.Height);
                pnl_AnaSol.Top = pnl_UstBaslik.Height;
                pnl_AnaSag.Top = pnl_UstBaslik.Height;
                lbl_UstBaslik.ForeColor =
                    lbl_AltBaslik.ForeColor = Color.FromArgb(Settings.Default.KayanYaziRenk);
                pnl_UstBaslik.BackColor =
                    pnl_AltBaslik.BackColor = Color.FromArgb(Settings.Default.KayanYaziArkaPlanRenk);
                if (Settings.Default.LCDArkaplanRenk == Color.Transparent.ToArgb())
                    Settings.Default.LCDArkaplanRenk = -6703919;
                BackColor =
                    pnl_Saat.BackColor =
                        pnl_AnaSag.BackColor = Color.FromArgb(Settings.Default.LCDArkaplanRenk);
                if (Settings.Default.UstBaslikKaysin)
                {
                    timer_KayanYazi1.Interval = (int)Settings.Default.UstBaslikHiz;
                    timer_KayanYazi1.Enabled = true;
                    Yon1 = Settings.Default.UstBaslikYon;
                }
                else
                {
                    timer_KayanYazi1.Enabled = false;
                    lbl_UstBaslik.Left = 5;
                }
                if (Settings.Default.AltBaslikKaysin)
                {
                    timer_KayanYazi2.Interval = (int)Settings.Default.AltBaslikHiz;
                    timer_KayanYazi2.Enabled = true;
                    Yon2 = Settings.Default.AltBaslikYon;
                }
                else
                {
                    timer_KayanYazi2.Enabled = false;
                    lbl_AltBaslik.Left = 5;
                }
                lbl_SiraNo.Text = Settings.Default.Sutun1;
                lbl_VezneNo.Text = Settings.Default.Sutun2;

                //if (Settings.Default.Sutun3Goster)
                //{
                //    lblSutun3.Text = Settings.Default.Sutun3; //mt 23.03.2015
                //}
                //else
                //{
                //    pnlSutun3.Visible = false;
                //}

                lbl_SiraNo.ForeColor = lbl_VezneNo.ForeColor = Color.FromArgb(Settings.Default.SutunRenk);
                switch (Settings.Default.SutunYaziOzellik)
                {
                    case 0:
                        //lblSutun3.Font = 
                        lbl_SiraNo.Font = lbl_VezneNo.Font = new Font(lbl_SiraNo.Font, FontStyle.Bold);
                        break;
                    case 1:
                        //lblSutun3.Font = 
                        lbl_SiraNo.Font = lbl_VezneNo.Font = new Font(lbl_SiraNo.Font, FontStyle.Italic);
                        break;
                    case 2:
                        //lblSutun3.Font = 
                        lbl_SiraNo.Font = lbl_VezneNo.Font = new Font(lbl_SiraNo.Font, FontStyle.Regular);
                        break;
                }
            }
            catch (Exception ex)
            {
                int num =
                    (int)
                        MessageBox.Show("Form Ayarları ayarlanamadı.\n" + ex.Message, "Hata", MessageBoxButtons.OK,
                            MessageBoxIcon.Hand);
            }
        }

        private delegate void updateAltBaslikLabelDelegate(string _AltBaslikText);

        private delegate void updateUstBaslikLabelDelegate(string _UstBaslikText);

        private void label1_Click(object sender, EventArgs e)
        {



        }

        private void label1_MouseDown(object sender, MouseEventArgs e)
        {
            if (e.Button == MouseButtons.Left)
            {
                int num = (int)new W_QLUSettings().ShowDialog();
            }
            else
            {
                this.FormBorderStyle = FormBorderStyle.Sizable;

            }
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            if (Connection.CheckQPUServer() && Connection.ServerRegister())
            {
                if (Settings.Default.MediaTipi == 4)
                    BeklemeListesiSet();
            }
        }
    }
}
