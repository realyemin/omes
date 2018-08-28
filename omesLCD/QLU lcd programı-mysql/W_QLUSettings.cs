// Type: QLU.W_QLUSettings
// Assembly: QLU, Version=1.1.0.0, Culture=neutral, PublicKeyToken=null
// MVID: 5FBC9314-0845-40D3-B639-F723476E848F
// Assembly location: C:\OMES .NET\Açılacak\QLU\program files\OMES Elektronik\QLU\QLU.exe

//using DirectX.Capture;
using QLU.Properties;
using System;
using System.ComponentModel;
using System.Drawing;
using System.Text.RegularExpressions;
using System.Windows.Forms;
//using DirectX.Capture;

namespace QLU
{
    public partial class W_QLUSettings : Form
    {
        private IContainer components;
        private StatusStrip statusStrip1;
        private ToolStripStatusLabel lbl_DurumLabel;
        private ToolStripStatusLabel lbl_Durum;
        private ToolTip toolTip1;
        private TabPage tabPage1;
        private Panel panel1;
        private Button btn_LCDAyarGuncelle;
        private TabPage tabPage2;
        private Panel panel2;
        private Button btn_FormGuncelle;
        private Label label8;
        private TabPage tabPage3;
        private Panel panel3;
        private TextBox txt_ServerIP;
        private Label label11;
        private Label label10;
        private Label label9;
        private Button btn_ServerGuncelle;
        private NumericUpDown txt_PortAlici;
        private NumericUpDown txt_PortGonderici;
        private Label label12;
        private CheckBox chk_OtoIP;
        public TabControl tabControl1;
        public TextBox txt_ClientIP;
        private GroupBox groupBox2;
        private Label label15;
        private Button btn_Font;
        private TextBox txt_KayanYaziFont;
        private Label label7;
        private NumericUpDown txt_KayanYaziPunto;
        private Button btn_KayanYaziRenk;
        private GroupBox groupBox3;
        private Label label17;
        private Label label16;
        private TextBox txt_Sutun2;
        private TextBox txt_Sutun1;
        private Label label14;
        private Label label6;
        private NumericUpDown txt_AnatabloID;
        private NumericUpDown txt_EkranID;
        private Button btn_VideoSec;
        private Button btn_SesSec;
        private Label label13;
        private Label label5;
        private Label label4;
        private Label label2;
        private TextBox txt_VideoYolu;
        private TextBox txt_AltBaslik;
        private TextBox txt_SesYolu;
        private Label label3;
        private TextBox txt_UstBaslik;
        private Label label1;
        private Button btn_SaveAllSettings;
        private Button btn_LCDArkaPlanRenk;
        private GroupBox groupBox4;
        private GroupBox groupBox1;
        private Label label21;
        private NumericUpDown txt_UstKaymaHizi;
        private RadioButton rbtn_UstSol;
        private RadioButton rbtn_UstSag;
        private Label label20;
        private Label label19;
        private Label label18;
        private CheckBox chk_UstYazi;
        private Label label25;
        private CheckBox chk_AltYazi;
        private NumericUpDown txt_AltKaymaHizi;
        private Label label22;
        private RadioButton rbtn_AltSol;
        private Label label23;
        private RadioButton rbtn_AltSag;
        private Label label24;
        private Button btn_SutunRenk;
        private GroupBox groupBox5;
        private RadioButton radioButton3;
        private RadioButton radioButton2;
        private RadioButton radioButton1;
        private GroupBox groupBox6;
        private Label label26;
        private TextBox txt_CagNoFont;
        private Button btn_CagNoFont;
        private NumericUpDown txt_CagNoPunto;
        private Label label27;
        private Button btn_CagNoRenk;
        private Label label28;
        private ComboBox cmbTVKaynak;
        private Label labelTvChannel1;
        private NumericUpDown tbKanal;
        private NumericUpDown txt_SaatYukseklik;
        private Label label29;
        public TextBox tbDbPass;
        private Label label31;
        public TextBox tbDbUserName;
        private Label label30;
        public TextBox tbWebBrowserUrl;
        private Label label32;
        private Label label33;
        private NumericUpDown tbPuntoTekSatir;
        private Label label34;
        private ComboBox cbMediaTipi;
        private Label label40;
        private Label label39;
        private Label label38;
        private Label label37;
        private Label label41;
        private ComboBox cbSesliCagri;
        private Label label35;
        private NumericUpDown tbSatirSayisi;
        private Label label42;
        private Label label36;

        //private Filters filters = new Filters();

        public string UstBaslik { get; set; }

        public string AltBaslik { get; set; }

        public string SesURL { get; set; }

        public string TvKaynak { get; set; }

        public string VideoURL { get; set; }

        public int EkranNo { get; set; }

        public int TvKanal { get; set; }

        public int TvKaynakIndex { get; set; }

        public string DefaultFormID { get; set; }

        public string ServerIP { get; set; }

        public int PORT_Gonderici { get; set; }

        public int PORT_Alici { get; set; }

        public int AnatabloID { get; set; }

        public string ClientIP { get; set; }

        public string KayanYaziFont { get; set; }

        public int KayanYaziRenk { get; set; }

        public Decimal KayanYaziPunto { get; set; }

        public int KayanYaziArkaPlanRenk { get; set; }

        public string Sutun1 { get; set; }

        public string Sutun2 { get; set; }

        public int LCDArkaPlanRenk { get; set; }

        public int LCDFormArkaplanRenk { get; set; }

        public bool UstBaslikKaysin { get; set; }

        public bool AltBaslikKaysin { get; set; }

        public bool UstBaslikYon { get; set; }

        public bool AltBaslikYon { get; set; }

        public Decimal UstBaslikHiz { get; set; }

        public Decimal AltBaslikHiz { get; set; }

        public int SutunRenk { get; set; }

        public int SutunYaziOzellik { get; set; }

        public string CagNoFont { get; set; }

        public int CagNoRenk { get; set; }

        public Decimal CagNoPunto { get; set; }

        public Decimal SaatYukseklik { get; set; }

        public string dbUserName { get; set; }
        public string dbPassword { get; set; }
        public int MediaTipi { get; set; }
        public int SatirSayisi { get; set; }
        public string Ses { get; set; }
        public string WebBrowserUrl { get; set; }
        public int CagNoPuntoTekSatir { get; set; }

        public W_QLUSettings()
        {
            this.InitializeComponent();
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing && this.components != null)
                this.components.Dispose();
            base.Dispose(disposing);
        }

        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(W_QLUSettings));
            this.statusStrip1 = new System.Windows.Forms.StatusStrip();
            this.lbl_DurumLabel = new System.Windows.Forms.ToolStripStatusLabel();
            this.lbl_Durum = new System.Windows.Forms.ToolStripStatusLabel();
            this.toolTip1 = new System.Windows.Forms.ToolTip(this.components);
            this.btn_KayanYaziRenk = new System.Windows.Forms.Button();
            this.btn_VideoSec = new System.Windows.Forms.Button();
            this.btn_SesSec = new System.Windows.Forms.Button();
            this.btn_LCDArkaPlanRenk = new System.Windows.Forms.Button();
            this.btn_SutunRenk = new System.Windows.Forms.Button();
            this.txt_AltKaymaHizi = new System.Windows.Forms.NumericUpDown();
            this.txt_UstKaymaHizi = new System.Windows.Forms.NumericUpDown();
            this.btn_CagNoRenk = new System.Windows.Forms.Button();
            this.txt_SaatYukseklik = new System.Windows.Forms.NumericUpDown();
            this.txt_CagNoPunto = new System.Windows.Forms.NumericUpDown();
            this.txt_KayanYaziPunto = new System.Windows.Forms.NumericUpDown();
            this.tbPuntoTekSatir = new System.Windows.Forms.NumericUpDown();
            this.tabControl1 = new System.Windows.Forms.TabControl();
            this.tabPage1 = new System.Windows.Forms.TabPage();
            this.panel1 = new System.Windows.Forms.Panel();
            this.tbSatirSayisi = new System.Windows.Forms.NumericUpDown();
            this.label42 = new System.Windows.Forms.Label();
            this.label41 = new System.Windows.Forms.Label();
            this.cbSesliCagri = new System.Windows.Forms.ComboBox();
            this.label35 = new System.Windows.Forms.Label();
            this.label40 = new System.Windows.Forms.Label();
            this.label39 = new System.Windows.Forms.Label();
            this.label38 = new System.Windows.Forms.Label();
            this.label37 = new System.Windows.Forms.Label();
            this.label36 = new System.Windows.Forms.Label();
            this.cbMediaTipi = new System.Windows.Forms.ComboBox();
            this.tbWebBrowserUrl = new System.Windows.Forms.TextBox();
            this.label32 = new System.Windows.Forms.Label();
            this.label33 = new System.Windows.Forms.Label();
            this.label29 = new System.Windows.Forms.Label();
            this.cmbTVKaynak = new System.Windows.Forms.ComboBox();
            this.labelTvChannel1 = new System.Windows.Forms.Label();
            this.tbKanal = new System.Windows.Forms.NumericUpDown();
            this.label14 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.txt_AnatabloID = new System.Windows.Forms.NumericUpDown();
            this.txt_EkranID = new System.Windows.Forms.NumericUpDown();
            this.label13 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.txt_VideoYolu = new System.Windows.Forms.TextBox();
            this.txt_AltBaslik = new System.Windows.Forms.TextBox();
            this.txt_SesYolu = new System.Windows.Forms.TextBox();
            this.label3 = new System.Windows.Forms.Label();
            this.txt_UstBaslik = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.tabPage2 = new System.Windows.Forms.TabPage();
            this.panel2 = new System.Windows.Forms.Panel();
            this.label8 = new System.Windows.Forms.Label();
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.groupBox5 = new System.Windows.Forms.GroupBox();
            this.radioButton3 = new System.Windows.Forms.RadioButton();
            this.radioButton2 = new System.Windows.Forms.RadioButton();
            this.radioButton1 = new System.Windows.Forms.RadioButton();
            this.label17 = new System.Windows.Forms.Label();
            this.label16 = new System.Windows.Forms.Label();
            this.txt_Sutun2 = new System.Windows.Forms.TextBox();
            this.txt_Sutun1 = new System.Windows.Forms.TextBox();
            this.btn_FormGuncelle = new System.Windows.Forms.Button();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.groupBox6 = new System.Windows.Forms.GroupBox();
            this.label34 = new System.Windows.Forms.Label();
            this.label28 = new System.Windows.Forms.Label();
            this.label26 = new System.Windows.Forms.Label();
            this.txt_CagNoFont = new System.Windows.Forms.TextBox();
            this.btn_CagNoFont = new System.Windows.Forms.Button();
            this.label27 = new System.Windows.Forms.Label();
            this.groupBox4 = new System.Windows.Forms.GroupBox();
            this.label25 = new System.Windows.Forms.Label();
            this.chk_AltYazi = new System.Windows.Forms.CheckBox();
            this.label22 = new System.Windows.Forms.Label();
            this.rbtn_AltSol = new System.Windows.Forms.RadioButton();
            this.label23 = new System.Windows.Forms.Label();
            this.rbtn_AltSag = new System.Windows.Forms.RadioButton();
            this.label24 = new System.Windows.Forms.Label();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.label21 = new System.Windows.Forms.Label();
            this.rbtn_UstSol = new System.Windows.Forms.RadioButton();
            this.rbtn_UstSag = new System.Windows.Forms.RadioButton();
            this.label20 = new System.Windows.Forms.Label();
            this.label19 = new System.Windows.Forms.Label();
            this.label18 = new System.Windows.Forms.Label();
            this.chk_UstYazi = new System.Windows.Forms.CheckBox();
            this.label15 = new System.Windows.Forms.Label();
            this.btn_Font = new System.Windows.Forms.Button();
            this.txt_KayanYaziFont = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.tabPage3 = new System.Windows.Forms.TabPage();
            this.panel3 = new System.Windows.Forms.Panel();
            this.tbDbPass = new System.Windows.Forms.TextBox();
            this.label31 = new System.Windows.Forms.Label();
            this.tbDbUserName = new System.Windows.Forms.TextBox();
            this.label30 = new System.Windows.Forms.Label();
            this.chk_OtoIP = new System.Windows.Forms.CheckBox();
            this.txt_PortAlici = new System.Windows.Forms.NumericUpDown();
            this.txt_PortGonderici = new System.Windows.Forms.NumericUpDown();
            this.txt_ClientIP = new System.Windows.Forms.TextBox();
            this.txt_ServerIP = new System.Windows.Forms.TextBox();
            this.label12 = new System.Windows.Forms.Label();
            this.label11 = new System.Windows.Forms.Label();
            this.label10 = new System.Windows.Forms.Label();
            this.label9 = new System.Windows.Forms.Label();
            this.btn_LCDAyarGuncelle = new System.Windows.Forms.Button();
            this.btn_ServerGuncelle = new System.Windows.Forms.Button();
            this.btn_SaveAllSettings = new System.Windows.Forms.Button();
            this.statusStrip1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.txt_AltKaymaHizi)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_UstKaymaHizi)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_SaatYukseklik)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_CagNoPunto)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_KayanYaziPunto)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tbPuntoTekSatir)).BeginInit();
            this.tabControl1.SuspendLayout();
            this.tabPage1.SuspendLayout();
            this.panel1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.tbSatirSayisi)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.tbKanal)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_AnatabloID)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_EkranID)).BeginInit();
            this.tabPage2.SuspendLayout();
            this.panel2.SuspendLayout();
            this.groupBox3.SuspendLayout();
            this.groupBox5.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.groupBox6.SuspendLayout();
            this.groupBox4.SuspendLayout();
            this.groupBox1.SuspendLayout();
            this.tabPage3.SuspendLayout();
            this.panel3.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.txt_PortAlici)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_PortGonderici)).BeginInit();
            this.SuspendLayout();
            // 
            // statusStrip1
            // 
            this.statusStrip1.Items.AddRange(new System.Windows.Forms.ToolStripItem[] {
            this.lbl_DurumLabel,
            this.lbl_Durum});
            resources.ApplyResources(this.statusStrip1, "statusStrip1");
            this.statusStrip1.Name = "statusStrip1";
            this.statusStrip1.SizingGrip = false;
            // 
            // lbl_DurumLabel
            // 
            this.lbl_DurumLabel.Name = "lbl_DurumLabel";
            resources.ApplyResources(this.lbl_DurumLabel, "lbl_DurumLabel");
            // 
            // lbl_Durum
            // 
            this.lbl_Durum.ForeColor = System.Drawing.Color.Red;
            this.lbl_Durum.Name = "lbl_Durum";
            resources.ApplyResources(this.lbl_Durum, "lbl_Durum");
            // 
            // btn_KayanYaziRenk
            // 
            resources.ApplyResources(this.btn_KayanYaziRenk, "btn_KayanYaziRenk");
            this.btn_KayanYaziRenk.Name = "btn_KayanYaziRenk";
            this.toolTip1.SetToolTip(this.btn_KayanYaziRenk, resources.GetString("btn_KayanYaziRenk.ToolTip"));
            this.btn_KayanYaziRenk.UseVisualStyleBackColor = true;
            this.btn_KayanYaziRenk.MouseDown += new System.Windows.Forms.MouseEventHandler(this.btn_Renk_MouseDown);
            // 
            // btn_VideoSec
            // 
            resources.ApplyResources(this.btn_VideoSec, "btn_VideoSec");
            this.btn_VideoSec.Name = "btn_VideoSec";
            this.toolTip1.SetToolTip(this.btn_VideoSec, resources.GetString("btn_VideoSec.ToolTip"));
            this.btn_VideoSec.UseVisualStyleBackColor = true;
            this.btn_VideoSec.Click += new System.EventHandler(this.btn_VideoSec_Click);
            // 
            // btn_SesSec
            // 
            resources.ApplyResources(this.btn_SesSec, "btn_SesSec");
            this.btn_SesSec.Name = "btn_SesSec";
            this.toolTip1.SetToolTip(this.btn_SesSec, resources.GetString("btn_SesSec.ToolTip"));
            this.btn_SesSec.UseVisualStyleBackColor = true;
            this.btn_SesSec.Click += new System.EventHandler(this.btn_SesSec_Click);
            // 
            // btn_LCDArkaPlanRenk
            // 
            resources.ApplyResources(this.btn_LCDArkaPlanRenk, "btn_LCDArkaPlanRenk");
            this.btn_LCDArkaPlanRenk.Name = "btn_LCDArkaPlanRenk";
            this.toolTip1.SetToolTip(this.btn_LCDArkaPlanRenk, resources.GetString("btn_LCDArkaPlanRenk.ToolTip"));
            this.btn_LCDArkaPlanRenk.UseVisualStyleBackColor = true;
            this.btn_LCDArkaPlanRenk.MouseDown += new System.Windows.Forms.MouseEventHandler(this.btn_LCDArkaPlanRenk_MouseDown);
            // 
            // btn_SutunRenk
            // 
            resources.ApplyResources(this.btn_SutunRenk, "btn_SutunRenk");
            this.btn_SutunRenk.Name = "btn_SutunRenk";
            this.toolTip1.SetToolTip(this.btn_SutunRenk, resources.GetString("btn_SutunRenk.ToolTip"));
            this.btn_SutunRenk.UseVisualStyleBackColor = true;
            this.btn_SutunRenk.Click += new System.EventHandler(this.btn_SutunRenk_Click);
            // 
            // txt_AltKaymaHizi
            // 
            resources.ApplyResources(this.txt_AltKaymaHizi, "txt_AltKaymaHizi");
            this.txt_AltKaymaHizi.Maximum = new decimal(new int[] {
            10000,
            0,
            0,
            0});
            this.txt_AltKaymaHizi.Name = "txt_AltKaymaHizi";
            this.toolTip1.SetToolTip(this.txt_AltKaymaHizi, resources.GetString("txt_AltKaymaHizi.ToolTip"));
            // 
            // txt_UstKaymaHizi
            // 
            resources.ApplyResources(this.txt_UstKaymaHizi, "txt_UstKaymaHizi");
            this.txt_UstKaymaHizi.Maximum = new decimal(new int[] {
            10000,
            0,
            0,
            0});
            this.txt_UstKaymaHizi.Name = "txt_UstKaymaHizi";
            this.toolTip1.SetToolTip(this.txt_UstKaymaHizi, resources.GetString("txt_UstKaymaHizi.ToolTip"));
            // 
            // btn_CagNoRenk
            // 
            resources.ApplyResources(this.btn_CagNoRenk, "btn_CagNoRenk");
            this.btn_CagNoRenk.Name = "btn_CagNoRenk";
            this.toolTip1.SetToolTip(this.btn_CagNoRenk, resources.GetString("btn_CagNoRenk.ToolTip"));
            this.btn_CagNoRenk.UseVisualStyleBackColor = true;
            this.btn_CagNoRenk.MouseDown += new System.Windows.Forms.MouseEventHandler(this.btn_CagNoRenk_MouseDown);
            // 
            // txt_SaatYukseklik
            // 
            resources.ApplyResources(this.txt_SaatYukseklik, "txt_SaatYukseklik");
            this.txt_SaatYukseklik.Maximum = new decimal(new int[] {
            2000,
            0,
            0,
            0});
            this.txt_SaatYukseklik.Name = "txt_SaatYukseklik";
            this.toolTip1.SetToolTip(this.txt_SaatYukseklik, resources.GetString("txt_SaatYukseklik.ToolTip"));
            // 
            // txt_CagNoPunto
            // 
            resources.ApplyResources(this.txt_CagNoPunto, "txt_CagNoPunto");
            this.txt_CagNoPunto.Maximum = new decimal(new int[] {
            1000,
            0,
            0,
            0});
            this.txt_CagNoPunto.Name = "txt_CagNoPunto";
            this.toolTip1.SetToolTip(this.txt_CagNoPunto, resources.GetString("txt_CagNoPunto.ToolTip"));
            // 
            // txt_KayanYaziPunto
            // 
            resources.ApplyResources(this.txt_KayanYaziPunto, "txt_KayanYaziPunto");
            this.txt_KayanYaziPunto.Maximum = new decimal(new int[] {
            1000,
            0,
            0,
            0});
            this.txt_KayanYaziPunto.Name = "txt_KayanYaziPunto";
            this.toolTip1.SetToolTip(this.txt_KayanYaziPunto, resources.GetString("txt_KayanYaziPunto.ToolTip"));
            // 
            // tbPuntoTekSatir
            // 
            resources.ApplyResources(this.tbPuntoTekSatir, "tbPuntoTekSatir");
            this.tbPuntoTekSatir.Maximum = new decimal(new int[] {
            1000,
            0,
            0,
            0});
            this.tbPuntoTekSatir.Name = "tbPuntoTekSatir";
            this.toolTip1.SetToolTip(this.tbPuntoTekSatir, resources.GetString("tbPuntoTekSatir.ToolTip"));
            // 
            // tabControl1
            // 
            this.tabControl1.Controls.Add(this.tabPage1);
            this.tabControl1.Controls.Add(this.tabPage2);
            this.tabControl1.Controls.Add(this.tabPage3);
            resources.ApplyResources(this.tabControl1, "tabControl1");
            this.tabControl1.Name = "tabControl1";
            this.tabControl1.SelectedIndex = 0;
            // 
            // tabPage1
            // 
            this.tabPage1.Controls.Add(this.panel1);
            resources.ApplyResources(this.tabPage1, "tabPage1");
            this.tabPage1.Name = "tabPage1";
            this.tabPage1.UseVisualStyleBackColor = true;
            // 
            // panel1
            // 
            this.panel1.Controls.Add(this.tbSatirSayisi);
            this.panel1.Controls.Add(this.label42);
            this.panel1.Controls.Add(this.label41);
            this.panel1.Controls.Add(this.cbSesliCagri);
            this.panel1.Controls.Add(this.label35);
            this.panel1.Controls.Add(this.label40);
            this.panel1.Controls.Add(this.label39);
            this.panel1.Controls.Add(this.label38);
            this.panel1.Controls.Add(this.label37);
            this.panel1.Controls.Add(this.label36);
            this.panel1.Controls.Add(this.cbMediaTipi);
            this.panel1.Controls.Add(this.tbWebBrowserUrl);
            this.panel1.Controls.Add(this.label32);
            this.panel1.Controls.Add(this.label33);
            this.panel1.Controls.Add(this.label29);
            this.panel1.Controls.Add(this.cmbTVKaynak);
            this.panel1.Controls.Add(this.labelTvChannel1);
            this.panel1.Controls.Add(this.tbKanal);
            this.panel1.Controls.Add(this.label14);
            this.panel1.Controls.Add(this.label6);
            this.panel1.Controls.Add(this.txt_AnatabloID);
            this.panel1.Controls.Add(this.txt_EkranID);
            this.panel1.Controls.Add(this.btn_VideoSec);
            this.panel1.Controls.Add(this.btn_SesSec);
            this.panel1.Controls.Add(this.label13);
            this.panel1.Controls.Add(this.label5);
            this.panel1.Controls.Add(this.label4);
            this.panel1.Controls.Add(this.label2);
            this.panel1.Controls.Add(this.txt_VideoYolu);
            this.panel1.Controls.Add(this.txt_AltBaslik);
            this.panel1.Controls.Add(this.txt_SesYolu);
            this.panel1.Controls.Add(this.label3);
            this.panel1.Controls.Add(this.txt_UstBaslik);
            this.panel1.Controls.Add(this.label1);
            resources.ApplyResources(this.panel1, "panel1");
            this.panel1.Name = "panel1";
            // 
            // tbSatirSayisi
            // 
            resources.ApplyResources(this.tbSatirSayisi, "tbSatirSayisi");
            this.tbSatirSayisi.Maximum = new decimal(new int[] {
            1000,
            0,
            0,
            0});
            this.tbSatirSayisi.Name = "tbSatirSayisi";
            // 
            // label42
            // 
            resources.ApplyResources(this.label42, "label42");
            this.label42.Name = "label42";
            // 
            // label41
            // 
            resources.ApplyResources(this.label41, "label41");
            this.label41.ForeColor = System.Drawing.Color.Red;
            this.label41.Name = "label41";
            // 
            // cbSesliCagri
            // 
            this.cbSesliCagri.FormattingEnabled = true;
            this.cbSesliCagri.Items.AddRange(new object[] {
            resources.GetString("cbSesliCagri.Items"),
            resources.GetString("cbSesliCagri.Items1"),
            resources.GetString("cbSesliCagri.Items2")});
            resources.ApplyResources(this.cbSesliCagri, "cbSesliCagri");
            this.cbSesliCagri.Name = "cbSesliCagri";
            // 
            // label35
            // 
            resources.ApplyResources(this.label35, "label35");
            this.label35.Name = "label35";
            // 
            // label40
            // 
            resources.ApplyResources(this.label40, "label40");
            this.label40.ForeColor = System.Drawing.Color.Red;
            this.label40.Name = "label40";
            // 
            // label39
            // 
            resources.ApplyResources(this.label39, "label39");
            this.label39.ForeColor = System.Drawing.Color.Red;
            this.label39.Name = "label39";
            // 
            // label38
            // 
            resources.ApplyResources(this.label38, "label38");
            this.label38.ForeColor = System.Drawing.Color.Red;
            this.label38.Name = "label38";
            // 
            // label37
            // 
            resources.ApplyResources(this.label37, "label37");
            this.label37.ForeColor = System.Drawing.Color.Red;
            this.label37.Name = "label37";
            // 
            // label36
            // 
            resources.ApplyResources(this.label36, "label36");
            this.label36.ForeColor = System.Drawing.Color.Red;
            this.label36.Name = "label36";
            // 
            // cbMediaTipi
            // 
            this.cbMediaTipi.FormattingEnabled = true;
            this.cbMediaTipi.Items.AddRange(new object[] {
            resources.GetString("cbMediaTipi.Items"),
            resources.GetString("cbMediaTipi.Items1"),
            resources.GetString("cbMediaTipi.Items2"),
            resources.GetString("cbMediaTipi.Items3"),
            resources.GetString("cbMediaTipi.Items4"),
            resources.GetString("cbMediaTipi.Items5"),
            resources.GetString("cbMediaTipi.Items6"),
            resources.GetString("cbMediaTipi.Items7"),
            resources.GetString("cbMediaTipi.Items8"),
            resources.GetString("cbMediaTipi.Items9")});
            resources.ApplyResources(this.cbMediaTipi, "cbMediaTipi");
            this.cbMediaTipi.Name = "cbMediaTipi";
            // 
            // tbWebBrowserUrl
            // 
            resources.ApplyResources(this.tbWebBrowserUrl, "tbWebBrowserUrl");
            this.tbWebBrowserUrl.Name = "tbWebBrowserUrl";
            // 
            // label32
            // 
            resources.ApplyResources(this.label32, "label32");
            this.label32.Name = "label32";
            // 
            // label33
            // 
            resources.ApplyResources(this.label33, "label33");
            this.label33.Name = "label33";
            // 
            // label29
            // 
            resources.ApplyResources(this.label29, "label29");
            this.label29.Name = "label29";
            // 
            // cmbTVKaynak
            // 
            this.cmbTVKaynak.FormattingEnabled = true;
            resources.ApplyResources(this.cmbTVKaynak, "cmbTVKaynak");
            this.cmbTVKaynak.Name = "cmbTVKaynak";
            // 
            // labelTvChannel1
            // 
            resources.ApplyResources(this.labelTvChannel1, "labelTvChannel1");
            this.labelTvChannel1.Name = "labelTvChannel1";
            // 
            // tbKanal
            // 
            resources.ApplyResources(this.tbKanal, "tbKanal");
            this.tbKanal.Name = "tbKanal";
            // 
            // label14
            // 
            resources.ApplyResources(this.label14, "label14");
            this.label14.ForeColor = System.Drawing.Color.Red;
            this.label14.Name = "label14";
            // 
            // label6
            // 
            resources.ApplyResources(this.label6, "label6");
            this.label6.ForeColor = System.Drawing.Color.Red;
            this.label6.Name = "label6";
            // 
            // txt_AnatabloID
            // 
            resources.ApplyResources(this.txt_AnatabloID, "txt_AnatabloID");
            this.txt_AnatabloID.Maximum = new decimal(new int[] {
            1000,
            0,
            0,
            0});
            this.txt_AnatabloID.Name = "txt_AnatabloID";
            this.txt_AnatabloID.ValueChanged += new System.EventHandler(this.txt_AnatabloID_ValueChanged);
            // 
            // txt_EkranID
            // 
            resources.ApplyResources(this.txt_EkranID, "txt_EkranID");
            this.txt_EkranID.Maximum = new decimal(new int[] {
            1000,
            0,
            0,
            0});
            this.txt_EkranID.Name = "txt_EkranID";
            this.txt_EkranID.ValueChanged += new System.EventHandler(this.txt_EkranID_ValueChanged);
            // 
            // label13
            // 
            resources.ApplyResources(this.label13, "label13");
            this.label13.Name = "label13";
            // 
            // label5
            // 
            resources.ApplyResources(this.label5, "label5");
            this.label5.Name = "label5";
            // 
            // label4
            // 
            resources.ApplyResources(this.label4, "label4");
            this.label4.Name = "label4";
            // 
            // label2
            // 
            resources.ApplyResources(this.label2, "label2");
            this.label2.Name = "label2";
            // 
            // txt_VideoYolu
            // 
            resources.ApplyResources(this.txt_VideoYolu, "txt_VideoYolu");
            this.txt_VideoYolu.Name = "txt_VideoYolu";
            this.txt_VideoYolu.ReadOnly = true;
            this.txt_VideoYolu.Click += new System.EventHandler(this.btn_VideoSec_Click);
            // 
            // txt_AltBaslik
            // 
            resources.ApplyResources(this.txt_AltBaslik, "txt_AltBaslik");
            this.txt_AltBaslik.Name = "txt_AltBaslik";
            // 
            // txt_SesYolu
            // 
            resources.ApplyResources(this.txt_SesYolu, "txt_SesYolu");
            this.txt_SesYolu.Name = "txt_SesYolu";
            this.txt_SesYolu.ReadOnly = true;
            this.txt_SesYolu.Click += new System.EventHandler(this.btn_SesSec_Click);
            // 
            // label3
            // 
            resources.ApplyResources(this.label3, "label3");
            this.label3.Name = "label3";
            // 
            // txt_UstBaslik
            // 
            resources.ApplyResources(this.txt_UstBaslik, "txt_UstBaslik");
            this.txt_UstBaslik.Name = "txt_UstBaslik";
            // 
            // label1
            // 
            resources.ApplyResources(this.label1, "label1");
            this.label1.Name = "label1";
            // 
            // tabPage2
            // 
            this.tabPage2.Controls.Add(this.panel2);
            resources.ApplyResources(this.tabPage2, "tabPage2");
            this.tabPage2.Name = "tabPage2";
            this.tabPage2.UseVisualStyleBackColor = true;
            // 
            // panel2
            // 
            this.panel2.Controls.Add(this.label8);
            this.panel2.Controls.Add(this.groupBox3);
            this.panel2.Controls.Add(this.btn_FormGuncelle);
            this.panel2.Controls.Add(this.groupBox2);
            resources.ApplyResources(this.panel2, "panel2");
            this.panel2.Name = "panel2";
            // 
            // label8
            // 
            resources.ApplyResources(this.label8, "label8");
            this.label8.ForeColor = System.Drawing.Color.Red;
            this.label8.Name = "label8";
            // 
            // groupBox3
            // 
            this.groupBox3.Controls.Add(this.groupBox5);
            this.groupBox3.Controls.Add(this.btn_SutunRenk);
            this.groupBox3.Controls.Add(this.label17);
            this.groupBox3.Controls.Add(this.label16);
            this.groupBox3.Controls.Add(this.txt_Sutun2);
            this.groupBox3.Controls.Add(this.txt_Sutun1);
            resources.ApplyResources(this.groupBox3, "groupBox3");
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.TabStop = false;
            // 
            // groupBox5
            // 
            this.groupBox5.Controls.Add(this.radioButton3);
            this.groupBox5.Controls.Add(this.radioButton2);
            this.groupBox5.Controls.Add(this.radioButton1);
            resources.ApplyResources(this.groupBox5, "groupBox5");
            this.groupBox5.Name = "groupBox5";
            this.groupBox5.TabStop = false;
            // 
            // radioButton3
            // 
            resources.ApplyResources(this.radioButton3, "radioButton3");
            this.radioButton3.Name = "radioButton3";
            this.radioButton3.TabStop = true;
            this.radioButton3.UseVisualStyleBackColor = true;
            // 
            // radioButton2
            // 
            resources.ApplyResources(this.radioButton2, "radioButton2");
            this.radioButton2.Name = "radioButton2";
            this.radioButton2.TabStop = true;
            this.radioButton2.UseVisualStyleBackColor = true;
            // 
            // radioButton1
            // 
            resources.ApplyResources(this.radioButton1, "radioButton1");
            this.radioButton1.Name = "radioButton1";
            this.radioButton1.TabStop = true;
            this.radioButton1.UseVisualStyleBackColor = true;
            // 
            // label17
            // 
            resources.ApplyResources(this.label17, "label17");
            this.label17.Name = "label17";
            // 
            // label16
            // 
            resources.ApplyResources(this.label16, "label16");
            this.label16.Name = "label16";
            // 
            // txt_Sutun2
            // 
            resources.ApplyResources(this.txt_Sutun2, "txt_Sutun2");
            this.txt_Sutun2.Name = "txt_Sutun2";
            // 
            // txt_Sutun1
            // 
            resources.ApplyResources(this.txt_Sutun1, "txt_Sutun1");
            this.txt_Sutun1.Name = "txt_Sutun1";
            // 
            // btn_FormGuncelle
            // 
            resources.ApplyResources(this.btn_FormGuncelle, "btn_FormGuncelle");
            this.btn_FormGuncelle.Name = "btn_FormGuncelle";
            this.btn_FormGuncelle.UseVisualStyleBackColor = true;
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.groupBox6);
            this.groupBox2.Controls.Add(this.groupBox4);
            this.groupBox2.Controls.Add(this.groupBox1);
            this.groupBox2.Controls.Add(this.btn_LCDArkaPlanRenk);
            this.groupBox2.Controls.Add(this.btn_KayanYaziRenk);
            this.groupBox2.Controls.Add(this.txt_KayanYaziPunto);
            this.groupBox2.Controls.Add(this.label15);
            this.groupBox2.Controls.Add(this.btn_Font);
            this.groupBox2.Controls.Add(this.txt_KayanYaziFont);
            this.groupBox2.Controls.Add(this.label7);
            resources.ApplyResources(this.groupBox2, "groupBox2");
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.TabStop = false;
            // 
            // groupBox6
            // 
            this.groupBox6.Controls.Add(this.tbPuntoTekSatir);
            this.groupBox6.Controls.Add(this.label34);
            this.groupBox6.Controls.Add(this.label28);
            this.groupBox6.Controls.Add(this.txt_SaatYukseklik);
            this.groupBox6.Controls.Add(this.label26);
            this.groupBox6.Controls.Add(this.txt_CagNoFont);
            this.groupBox6.Controls.Add(this.btn_CagNoFont);
            this.groupBox6.Controls.Add(this.btn_CagNoRenk);
            this.groupBox6.Controls.Add(this.txt_CagNoPunto);
            this.groupBox6.Controls.Add(this.label27);
            resources.ApplyResources(this.groupBox6, "groupBox6");
            this.groupBox6.Name = "groupBox6";
            this.groupBox6.TabStop = false;
            // 
            // label34
            // 
            resources.ApplyResources(this.label34, "label34");
            this.label34.Name = "label34";
            // 
            // label28
            // 
            resources.ApplyResources(this.label28, "label28");
            this.label28.Name = "label28";
            // 
            // label26
            // 
            resources.ApplyResources(this.label26, "label26");
            this.label26.Name = "label26";
            // 
            // txt_CagNoFont
            // 
            resources.ApplyResources(this.txt_CagNoFont, "txt_CagNoFont");
            this.txt_CagNoFont.Name = "txt_CagNoFont";
            this.txt_CagNoFont.ReadOnly = true;
            this.txt_CagNoFont.Click += new System.EventHandler(this.btn_CagNoFont_Click);
            // 
            // btn_CagNoFont
            // 
            resources.ApplyResources(this.btn_CagNoFont, "btn_CagNoFont");
            this.btn_CagNoFont.Name = "btn_CagNoFont";
            this.btn_CagNoFont.UseVisualStyleBackColor = true;
            this.btn_CagNoFont.Click += new System.EventHandler(this.btn_CagNoFont_Click);
            // 
            // label27
            // 
            resources.ApplyResources(this.label27, "label27");
            this.label27.Name = "label27";
            // 
            // groupBox4
            // 
            this.groupBox4.Controls.Add(this.label25);
            this.groupBox4.Controls.Add(this.chk_AltYazi);
            this.groupBox4.Controls.Add(this.txt_AltKaymaHizi);
            this.groupBox4.Controls.Add(this.label22);
            this.groupBox4.Controls.Add(this.rbtn_AltSol);
            this.groupBox4.Controls.Add(this.label23);
            this.groupBox4.Controls.Add(this.rbtn_AltSag);
            this.groupBox4.Controls.Add(this.label24);
            resources.ApplyResources(this.groupBox4, "groupBox4");
            this.groupBox4.Name = "groupBox4";
            this.groupBox4.TabStop = false;
            // 
            // label25
            // 
            resources.ApplyResources(this.label25, "label25");
            this.label25.Name = "label25";
            // 
            // chk_AltYazi
            // 
            resources.ApplyResources(this.chk_AltYazi, "chk_AltYazi");
            this.chk_AltYazi.Checked = true;
            this.chk_AltYazi.CheckState = System.Windows.Forms.CheckState.Checked;
            this.chk_AltYazi.Name = "chk_AltYazi";
            this.chk_AltYazi.UseVisualStyleBackColor = true;
            // 
            // label22
            // 
            resources.ApplyResources(this.label22, "label22");
            this.label22.Name = "label22";
            // 
            // rbtn_AltSol
            // 
            resources.ApplyResources(this.rbtn_AltSol, "rbtn_AltSol");
            this.rbtn_AltSol.Checked = true;
            this.rbtn_AltSol.Name = "rbtn_AltSol";
            this.rbtn_AltSol.TabStop = true;
            this.rbtn_AltSol.UseVisualStyleBackColor = true;
            // 
            // label23
            // 
            resources.ApplyResources(this.label23, "label23");
            this.label23.Name = "label23";
            // 
            // rbtn_AltSag
            // 
            resources.ApplyResources(this.rbtn_AltSag, "rbtn_AltSag");
            this.rbtn_AltSag.Name = "rbtn_AltSag";
            this.rbtn_AltSag.TabStop = true;
            this.rbtn_AltSag.UseVisualStyleBackColor = true;
            // 
            // label24
            // 
            resources.ApplyResources(this.label24, "label24");
            this.label24.Name = "label24";
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.label21);
            this.groupBox1.Controls.Add(this.txt_UstKaymaHizi);
            this.groupBox1.Controls.Add(this.rbtn_UstSol);
            this.groupBox1.Controls.Add(this.rbtn_UstSag);
            this.groupBox1.Controls.Add(this.label20);
            this.groupBox1.Controls.Add(this.label19);
            this.groupBox1.Controls.Add(this.label18);
            this.groupBox1.Controls.Add(this.chk_UstYazi);
            resources.ApplyResources(this.groupBox1, "groupBox1");
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.TabStop = false;
            // 
            // label21
            // 
            resources.ApplyResources(this.label21, "label21");
            this.label21.Name = "label21";
            // 
            // rbtn_UstSol
            // 
            resources.ApplyResources(this.rbtn_UstSol, "rbtn_UstSol");
            this.rbtn_UstSol.Checked = true;
            this.rbtn_UstSol.Name = "rbtn_UstSol";
            this.rbtn_UstSol.TabStop = true;
            this.rbtn_UstSol.UseVisualStyleBackColor = true;
            // 
            // rbtn_UstSag
            // 
            resources.ApplyResources(this.rbtn_UstSag, "rbtn_UstSag");
            this.rbtn_UstSag.Name = "rbtn_UstSag";
            this.rbtn_UstSag.TabStop = true;
            this.rbtn_UstSag.UseVisualStyleBackColor = true;
            // 
            // label20
            // 
            resources.ApplyResources(this.label20, "label20");
            this.label20.Name = "label20";
            // 
            // label19
            // 
            resources.ApplyResources(this.label19, "label19");
            this.label19.Name = "label19";
            // 
            // label18
            // 
            resources.ApplyResources(this.label18, "label18");
            this.label18.Name = "label18";
            // 
            // chk_UstYazi
            // 
            resources.ApplyResources(this.chk_UstYazi, "chk_UstYazi");
            this.chk_UstYazi.Checked = true;
            this.chk_UstYazi.CheckState = System.Windows.Forms.CheckState.Checked;
            this.chk_UstYazi.Name = "chk_UstYazi";
            this.chk_UstYazi.UseVisualStyleBackColor = true;
            // 
            // label15
            // 
            resources.ApplyResources(this.label15, "label15");
            this.label15.Name = "label15";
            // 
            // btn_Font
            // 
            resources.ApplyResources(this.btn_Font, "btn_Font");
            this.btn_Font.Name = "btn_Font";
            this.btn_Font.UseVisualStyleBackColor = true;
            this.btn_Font.Click += new System.EventHandler(this.btn_Font_Click);
            // 
            // txt_KayanYaziFont
            // 
            resources.ApplyResources(this.txt_KayanYaziFont, "txt_KayanYaziFont");
            this.txt_KayanYaziFont.Name = "txt_KayanYaziFont";
            this.txt_KayanYaziFont.ReadOnly = true;
            this.txt_KayanYaziFont.Click += new System.EventHandler(this.btn_Font_Click);
            // 
            // label7
            // 
            resources.ApplyResources(this.label7, "label7");
            this.label7.Name = "label7";
            // 
            // tabPage3
            // 
            this.tabPage3.Controls.Add(this.panel3);
            resources.ApplyResources(this.tabPage3, "tabPage3");
            this.tabPage3.Name = "tabPage3";
            this.tabPage3.UseVisualStyleBackColor = true;
            // 
            // panel3
            // 
            this.panel3.Controls.Add(this.tbDbPass);
            this.panel3.Controls.Add(this.label31);
            this.panel3.Controls.Add(this.tbDbUserName);
            this.panel3.Controls.Add(this.label30);
            this.panel3.Controls.Add(this.chk_OtoIP);
            this.panel3.Controls.Add(this.txt_PortAlici);
            this.panel3.Controls.Add(this.txt_PortGonderici);
            this.panel3.Controls.Add(this.txt_ClientIP);
            this.panel3.Controls.Add(this.txt_ServerIP);
            this.panel3.Controls.Add(this.label12);
            this.panel3.Controls.Add(this.label11);
            this.panel3.Controls.Add(this.label10);
            this.panel3.Controls.Add(this.label9);
            resources.ApplyResources(this.panel3, "panel3");
            this.panel3.Name = "panel3";
            // 
            // tbDbPass
            // 
            resources.ApplyResources(this.tbDbPass, "tbDbPass");
            this.tbDbPass.Name = "tbDbPass";
            // 
            // label31
            // 
            resources.ApplyResources(this.label31, "label31");
            this.label31.Name = "label31";
            // 
            // tbDbUserName
            // 
            resources.ApplyResources(this.tbDbUserName, "tbDbUserName");
            this.tbDbUserName.Name = "tbDbUserName";
            // 
            // label30
            // 
            resources.ApplyResources(this.label30, "label30");
            this.label30.Name = "label30";
            // 
            // chk_OtoIP
            // 
            resources.ApplyResources(this.chk_OtoIP, "chk_OtoIP");
            this.chk_OtoIP.Checked = true;
            this.chk_OtoIP.CheckState = System.Windows.Forms.CheckState.Checked;
            this.chk_OtoIP.Name = "chk_OtoIP";
            this.chk_OtoIP.UseVisualStyleBackColor = true;
            this.chk_OtoIP.CheckedChanged += new System.EventHandler(this.chk_OtoIP_CheckedChanged);
            // 
            // txt_PortAlici
            // 
            resources.ApplyResources(this.txt_PortAlici, "txt_PortAlici");
            this.txt_PortAlici.Maximum = new decimal(new int[] {
            65000,
            0,
            0,
            0});
            this.txt_PortAlici.Name = "txt_PortAlici";
            // 
            // txt_PortGonderici
            // 
            resources.ApplyResources(this.txt_PortGonderici, "txt_PortGonderici");
            this.txt_PortGonderici.Maximum = new decimal(new int[] {
            65000,
            0,
            0,
            0});
            this.txt_PortGonderici.Name = "txt_PortGonderici";
            // 
            // txt_ClientIP
            // 
            resources.ApplyResources(this.txt_ClientIP, "txt_ClientIP");
            this.txt_ClientIP.Name = "txt_ClientIP";
            // 
            // txt_ServerIP
            // 
            resources.ApplyResources(this.txt_ServerIP, "txt_ServerIP");
            this.txt_ServerIP.Name = "txt_ServerIP";
            // 
            // label12
            // 
            resources.ApplyResources(this.label12, "label12");
            this.label12.Name = "label12";
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
            // label9
            // 
            resources.ApplyResources(this.label9, "label9");
            this.label9.Name = "label9";
            // 
            // btn_LCDAyarGuncelle
            // 
            resources.ApplyResources(this.btn_LCDAyarGuncelle, "btn_LCDAyarGuncelle");
            this.btn_LCDAyarGuncelle.Name = "btn_LCDAyarGuncelle";
            this.btn_LCDAyarGuncelle.UseVisualStyleBackColor = true;
            this.btn_LCDAyarGuncelle.Click += new System.EventHandler(this.btn_LCDAyarGuncelle_Click);
            // 
            // btn_ServerGuncelle
            // 
            resources.ApplyResources(this.btn_ServerGuncelle, "btn_ServerGuncelle");
            this.btn_ServerGuncelle.Name = "btn_ServerGuncelle";
            this.btn_ServerGuncelle.UseVisualStyleBackColor = true;
            this.btn_ServerGuncelle.Click += new System.EventHandler(this.btn_ServerGuncelle_Click);
            // 
            // btn_SaveAllSettings
            // 
            resources.ApplyResources(this.btn_SaveAllSettings, "btn_SaveAllSettings");
            this.btn_SaveAllSettings.Name = "btn_SaveAllSettings";
            this.btn_SaveAllSettings.UseVisualStyleBackColor = true;
            this.btn_SaveAllSettings.Click += new System.EventHandler(this.btn_SaveAllSettings_Click);
            // 
            // W_QLUSettings
            // 
            resources.ApplyResources(this, "$this");
            this.Controls.Add(this.btn_SaveAllSettings);
            this.Controls.Add(this.tabControl1);
            this.Controls.Add(this.statusStrip1);
            this.Controls.Add(this.btn_LCDAyarGuncelle);
            this.Controls.Add(this.btn_ServerGuncelle);
            this.Name = "W_QLUSettings";
            this.ShowInTaskbar = false;
            this.Load += new System.EventHandler(this.W_QLUSettings_Load);
            this.statusStrip1.ResumeLayout(false);
            this.statusStrip1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.txt_AltKaymaHizi)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_UstKaymaHizi)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_SaatYukseklik)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_CagNoPunto)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_KayanYaziPunto)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tbPuntoTekSatir)).EndInit();
            this.tabControl1.ResumeLayout(false);
            this.tabPage1.ResumeLayout(false);
            this.panel1.ResumeLayout(false);
            this.panel1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.tbSatirSayisi)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.tbKanal)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_AnatabloID)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_EkranID)).EndInit();
            this.tabPage2.ResumeLayout(false);
            this.panel2.ResumeLayout(false);
            this.panel2.PerformLayout();
            this.groupBox3.ResumeLayout(false);
            this.groupBox3.PerformLayout();
            this.groupBox5.ResumeLayout(false);
            this.groupBox5.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox2.PerformLayout();
            this.groupBox6.ResumeLayout(false);
            this.groupBox6.PerformLayout();
            this.groupBox4.ResumeLayout(false);
            this.groupBox4.PerformLayout();
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.tabPage3.ResumeLayout(false);
            this.panel3.ResumeLayout(false);
            this.panel3.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.txt_PortAlici)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.txt_PortGonderici)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }


        private void ChangeLanguage( string lang)
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


        private void W_QLUSettings_Load(object sender, EventArgs e)
        {
            ChangeLanguage("En");

            this.txt_UstBaslik.Text = this.UstBaslik = Settings.Default.UstBaslik;
            this.txt_AltBaslik.Text = this.AltBaslik = Settings.Default.AltBaslik;
            this.txt_SesYolu.Text = this.SesURL = Settings.Default.SesURL;
            this.txt_VideoYolu.Text = this.VideoURL = Settings.Default.VideoURL;
            this.txt_EkranID.Value = (Decimal) (this.EkranNo = Settings.Default.EkranNo);
            this.DefaultFormID = Settings.Default.DefaultFormID;
            this.txt_ServerIP.Text = Settings.Default.ServerIP.ToString();
            this.ServerIP = Settings.Default.ServerIP;
            this.txt_PortGonderici.Value = (Decimal) (this.PORT_Gonderici = Settings.Default.PORT_Gonderici);
            this.txt_PortAlici.Value = (Decimal) (this.PORT_Alici = Settings.Default.PORT_Alici);
            this.txt_AnatabloID.Value = (Decimal) (this.AnatabloID = Settings.Default.AnatabloID);
            this.txt_KayanYaziFont.Text = this.KayanYaziFont = Settings.Default.KayanYaziFont;
            this.txt_KayanYaziPunto.Value = this.KayanYaziPunto = Settings.Default.KayanYaziPunto;
            this.btn_KayanYaziRenk.ForeColor = Color.FromArgb(Settings.Default.KayanYaziRenk);
            this.btn_KayanYaziRenk.BackColor = Color.FromArgb(Settings.Default.KayanYaziArkaPlanRenk);
            this.btn_LCDArkaPlanRenk.BackColor = Color.FromArgb(Settings.Default.LCDArkaplanRenk);
            this.btn_LCDArkaPlanRenk.ForeColor = Color.FromArgb(Settings.Default.LCDFormArkaplanRenk);
            this.chk_UstYazi.Checked = this.UstBaslikKaysin = Settings.Default.UstBaslikKaysin;
            this.chk_AltYazi.Checked = this.AltBaslikKaysin = Settings.Default.AltBaslikKaysin;
            this.txt_UstKaymaHizi.Value = this.UstBaslikHiz = Settings.Default.UstBaslikHiz;
            this.txt_AltKaymaHizi.Value = this.AltBaslikHiz = Settings.Default.AltBaslikHiz;
            this.rbtn_UstSag.Checked = this.UstBaslikYon = Settings.Default.UstBaslikYon;
            this.rbtn_AltSag.Checked = this.AltBaslikYon = Settings.Default.AltBaslikYon;
            this.txt_Sutun1.Text = this.Sutun1 = Settings.Default.Sutun1;
            this.txt_Sutun2.Text = this.Sutun2 = Settings.Default.Sutun2;
            this.btn_SutunRenk.ForeColor = Color.FromArgb(Settings.Default.SutunRenk);
            this.txt_CagNoFont.Text = this.CagNoFont = Settings.Default.CagNoFont;
            this.txt_CagNoPunto.Value = this.CagNoPunto = Settings.Default.CagNoPunto;
            this.btn_CagNoRenk.ForeColor = Color.FromArgb(Settings.Default.CagNoRenk);
            this.tbKanal.Text = Settings.Default.TvKanal.ToString();
            tbDbUserName.Text = dbUserName = Settings.Default.dbUserName;
            tbDbPass.Text = dbPassword = Settings.Default.dbPassword;
            cbMediaTipi.SelectedIndex = MediaTipi = Settings.Default.MediaTipi;
            tbSatirSayisi.Text = (SatirSayisi = Settings.Default.SatirSayisi).ToString();
            cbSesliCagri.Text = Ses = Settings.Default.Ses;
            tbPuntoTekSatir.Text = (CagNoPuntoTekSatir = Settings.Default.CagNoPuntoTekSatır).ToString();
            tbWebBrowserUrl.Text = WebBrowserUrl = Settings.Default.WebBrowserUrl;

            try
            {
                //this.txt_SaatYukseklik.Value = this.SaatYukseklik = Settings.Default.SaatYukseklik;
                //this.txt_SaatYukseklik.Maximum = (Decimal) W_QLU1.SaatMaxHeight;
            }
            catch
            {
            }
            switch (Settings.Default.SutunYaziOzellik)
            {
                case 0:
                    this.radioButton1.Checked = true;
                    break;
                case 1:
                    this.radioButton2.Checked = true;
                    break;
                case 2:
                    this.radioButton3.Checked = true;
                    break;
            }
            if (!string.IsNullOrEmpty(Settings.Default.ClientIP))
                this.txt_ClientIP.Text = Settings.Default.ClientIP;
            this.chk_OtoIP.Checked = Settings.Default.OtoIP;
            this.txt_ClientIP.Enabled = !this.chk_OtoIP.Checked;

            //tv işlemleri
            //Filter f;
            //ComboboxItem m = new ComboboxItem();
            //m.Value = 0;
            //m.Text = "Yok";
            //cmbTVKaynak.Items.Add(m);

            //for (int c = 1; c < filters.VideoInputDevices.Count + 1; c++)
            //{
            //    f = filters.VideoInputDevices[c-1];
            //    m = new ComboboxItem(); // MenuItem(f.Name, new EventHandler(mnuVideoDevices_Click));
            //    m.Text = f.Name;
            //    m.Value = c;
            //    //m.Checked = (videoDevice == f);
            //    cmbTVKaynak.Items.Add(m);
            //}
            //this.cmbTVKaynak.SelectedIndex = Settings.Default.TvKaynakIndex;
        }

        public class ComboboxItem //tv kaynakları comboya eklemek içün mt
        {
            public string Text { get; set; }
            public object Value { get; set; }

            public override string ToString()
            {
                return Text;
            }
        }

        private void btn_LCDAyarGuncelle_Click(object sender, EventArgs e)
        {
            if (string.IsNullOrEmpty(this.txt_UstBaslik.Text) && string.IsNullOrEmpty(this.txt_AltBaslik.Text) &&
                (string.IsNullOrEmpty(this.txt_SesYolu.Text) && string.IsNullOrEmpty(this.txt_VideoYolu.Text)))
                return;
            Settings.Default.UstBaslik = this.UstBaslik = this.txt_UstBaslik.Text;
            Settings.Default.AltBaslik = this.AltBaslik = this.txt_AltBaslik.Text;
            Settings.Default.SesURL = this.SesURL = this.txt_SesYolu.Text;
            Settings.Default.VideoURL = this.VideoURL = this.txt_VideoYolu.Text;
            Settings.Default.AnatabloID = this.AnatabloID = Convert.ToInt32(this.txt_AnatabloID.Value);
            Settings.Default.EkranNo = this.EkranNo = Convert.ToInt32(this.txt_EkranID.Value);
            Settings.Default.Save();
            this.lbl_Durum.Text = "LCD Ayarları başarıyla kaydedildi.";
        }

        private void btn_ServerGuncelle_Click(object sender, EventArgs e)
        {
            if (!this.IsValidIP(this.txt_ServerIP.Text))
                this.lbl_Durum.Text = "Girdiğiniz Server IP adresi doğru formatta değil!";
            else if (this.chk_OtoIP.Checked)
            {
                Settings.Default.ServerIP = this.txt_ServerIP.Text;
                this.ServerIP = this.txt_ServerIP.Text;
                Settings.Default.PORT_Gonderici = this.PORT_Gonderici = Convert.ToInt32(this.txt_PortGonderici.Value);
                Settings.Default.PORT_Alici = this.PORT_Alici = Convert.ToInt32(this.txt_PortAlici.Value);
                Settings.Default.Save();
                this.lbl_Durum.Text = "Server ayarları başarıyla kaydedildi.";
            }
            else if (!this.IsValidIP(this.txt_ClientIP.Text))
            {
                this.lbl_Durum.Text = "Girdiğiniz LCD IP adresi doğru formatta değil!";
            }
            else
            {
                Settings.Default.ServerIP = this.txt_ServerIP.Text;
                this.ServerIP = this.txt_ServerIP.Text;
                Settings.Default.PORT_Gonderici = this.PORT_Gonderici = Convert.ToInt32(this.txt_PortGonderici.Value);
                Settings.Default.PORT_Alici = this.PORT_Alici = Convert.ToInt32(this.txt_PortAlici.Value);
                Settings.Default.ClientIP = this.ClientIP = this.txt_ClientIP.Text;
                Settings.Default.Save();
                this.lbl_Durum.Text = "Server ayarları başarıyla kaydedildi.";
            }
        }

        private void btn_SesSec_Click(object sender, EventArgs e)
        {
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Title = "Lütfen Bilgisayarınızdan Ses Dosyasını Seçiniz";
            openFileDialog.Filter = "(Wave Dosyası)|*.wav|(Bütün Dosyalar)|*.*";
            int num = (int) openFileDialog.ShowDialog();
            this.txt_SesYolu.Text = openFileDialog.FileName;
            if (!string.IsNullOrEmpty(openFileDialog.FileName))
                return;
            this.txt_SesYolu.Text = this.SesURL;
        }

        private void btn_VideoSec_Click(object sender, EventArgs e)
        {
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Title = "Lütfen Bilgisayarınızdan Video Dosyasını Seçiniz";
            openFileDialog.Filter = "(Windows Media Video)|*.wmv|(MPEG-4)|*.mp4|(Bütün Dosyalar)|*.*";
            int num = (int) openFileDialog.ShowDialog();
            this.txt_VideoYolu.Text = openFileDialog.FileName;
            if (!string.IsNullOrEmpty(openFileDialog.FileName))
                return;
            this.txt_VideoYolu.Text = this.VideoURL;
        }

        private void txt_EkranID_ValueChanged(object sender, EventArgs e)
        {
            if ((Decimal) this.EkranNo != this.txt_EkranID.Value)
                this.label6.Visible = true;
            else
                this.label6.Visible = false;
        }

        private void txt_AnatabloID_ValueChanged(object sender, EventArgs e)
        {
            if ((Decimal) this.AnatabloID != this.txt_AnatabloID.Value)
                this.label14.Visible = true;
            else
                this.label14.Visible = false;
        }

        private void chk_OtoIP_CheckedChanged(object sender, EventArgs e)
        {
            this.txt_ClientIP.Enabled = !this.chk_OtoIP.Checked;
            Settings.Default.OtoIP = this.chk_OtoIP.Checked;
        }

        private void btn_Font_Click(object sender, EventArgs e)
        {
            FontDialog fontDialog = new FontDialog();
            fontDialog.ScriptsOnly = true;
            fontDialog.Font = new Font(Settings.Default.KayanYaziFont, (float) Settings.Default.KayanYaziPunto);
            try
            {
                if (fontDialog.ShowDialog() != DialogResult.OK)
                    return;
                this.txt_KayanYaziFont.Text = fontDialog.Font.Name;
            }
            catch
            {
            }
            finally
            {
                this.txt_KayanYaziFont.Text = fontDialog.Font.Name;
            }
        }

        private void btn_SutunRenk_Click(object sender, EventArgs e)
        {
            ColorDialog colorDialog = new ColorDialog();
            if (colorDialog.ShowDialog() != DialogResult.OK)
                return;
            this.btn_SutunRenk.ForeColor = colorDialog.Color;
        }

        private void btn_Renk_MouseDown(object sender, MouseEventArgs e)
        {
            if (e.Button == MouseButtons.Left)
            {
                ColorDialog colorDialog = new ColorDialog();
                if (colorDialog.ShowDialog() != DialogResult.OK)
                    return;
                this.btn_KayanYaziRenk.BackColor = colorDialog.Color;
            }
            else
            {
                if (e.Button != MouseButtons.Right)
                    return;
                ColorDialog colorDialog = new ColorDialog();
                if (colorDialog.ShowDialog() != DialogResult.OK)
                    return;
                this.btn_KayanYaziRenk.ForeColor = colorDialog.Color;
            }
        }

        private void btn_LCDArkaPlanRenk_MouseDown(object sender, MouseEventArgs e)
        {
            if (e.Button == MouseButtons.Left)
            {
                ColorDialog colorDialog = new ColorDialog();
                if (colorDialog.ShowDialog() != DialogResult.OK)
                    return;
                this.btn_LCDArkaPlanRenk.BackColor = colorDialog.Color;
            }
            else
            {
                if (e.Button != MouseButtons.Right)
                    return;
                ColorDialog colorDialog = new ColorDialog();
                if (colorDialog.ShowDialog() != DialogResult.OK)
                    return;
                this.btn_LCDArkaPlanRenk.ForeColor = colorDialog.Color;
            }
        }

        private void btn_SaveAllSettings_Click(object sender, EventArgs e)
        {
            try
            {
                if (string.IsNullOrEmpty(this.txt_UstBaslik.Text) && string.IsNullOrEmpty(this.txt_AltBaslik.Text) &&
                    (string.IsNullOrEmpty(this.txt_SesYolu.Text) && string.IsNullOrEmpty(this.txt_VideoYolu.Text)))
                {
                    this.lbl_Durum.Text = "Lütfen gerekli alanları doldurunuz.";
                    return;
                }
                else
                {
                    Settings.Default.UstBaslik = this.UstBaslik = this.txt_UstBaslik.Text;
                    Settings.Default.AltBaslik = this.AltBaslik = this.txt_AltBaslik.Text;
                    Settings.Default.SesURL = this.SesURL = this.txt_SesYolu.Text;
                    Settings.Default.VideoURL = this.VideoURL = this.txt_VideoYolu.Text;
                    Settings.Default.AnatabloID = this.AnatabloID = Convert.ToInt32(this.txt_AnatabloID.Value);
                    Settings.Default.EkranNo = this.EkranNo = Convert.ToInt32(this.txt_EkranID.Value);
                    Settings.Default.TvKanal = this.EkranNo = Convert.ToInt32(this.tbKanal.Value);
                    Settings.Default.TvKaynak = this.TvKaynak = this.cmbTVKaynak.Text;
                    Settings.Default.dbUserName = dbUserName = tbDbUserName.Text;
                    Settings.Default.dbPassword = dbPassword = tbDbPass.Text;
                    Settings.Default.MediaTipi = MediaTipi = cbMediaTipi.SelectedIndex;
                    Settings.Default.SatirSayisi = SatirSayisi = Convert.ToInt32(tbSatirSayisi.Text);

                    Settings.Default.Ses = Ses = cbSesliCagri.Text;

                    Settings.Default.WebBrowserUrl = WebBrowserUrl = tbWebBrowserUrl.Text;
                    Settings.Default.CagNoPuntoTekSatır = CagNoPuntoTekSatir = Convert.ToInt32(tbPuntoTekSatir.Text);

                    Settings.Default.TvKaynakIndex = this.TvKaynakIndex = cmbTVKaynak.SelectedIndex;
                    //if (!this.IsValidIP(this.txt_ServerIP.Text))
                    //{
                    //    this.lbl_Durum.Text = "Girdiğiniz Server IP adresi doğru formatta değil!";
                    //    return;
                    //}
                    //else
                    {
                        if (this.chk_OtoIP.Checked)
                        {
                            Settings.Default.ServerIP = this.txt_ServerIP.Text;
                            this.ServerIP = this.txt_ServerIP.Text;
                            Settings.Default.PORT_Gonderici =
                                this.PORT_Gonderici = Convert.ToInt32(this.txt_PortGonderici.Value);
                            Settings.Default.PORT_Alici = this.PORT_Alici = Convert.ToInt32(this.txt_PortAlici.Value);
                        }
                        else if (!this.IsValidIP(this.txt_ClientIP.Text))
                        {
                            this.lbl_Durum.Text = "Girdiğiniz LCD IP adresi doğru formatta değil!";
                            return;
                        }
                        else
                        {
                            Settings.Default.ServerIP = this.txt_ServerIP.Text;
                            this.ServerIP = this.txt_ServerIP.Text;
                            Settings.Default.PORT_Gonderici =
                                this.PORT_Gonderici = Convert.ToInt32(this.txt_PortGonderici.Value);
                            Settings.Default.PORT_Alici = this.PORT_Alici = Convert.ToInt32(this.txt_PortAlici.Value);
                            Settings.Default.ClientIP = this.ClientIP = this.txt_ClientIP.Text;
                        }
                        Settings.Default.KayanYaziFont = this.KayanYaziFont = this.txt_KayanYaziFont.Text;
                        Settings.Default.KayanYaziPunto = this.KayanYaziPunto = this.txt_KayanYaziPunto.Value;
                        // ISSUE: variable of a compiler-generated type
                        Settings default1 = Settings.Default;
                        W_QLUSettings wQluSettings1 = this;
                        Color backColor1 = this.btn_KayanYaziRenk.BackColor;
                        int num1;
                        int num2 = num1 = backColor1.ToArgb();
                        wQluSettings1.KayanYaziArkaPlanRenk = num1;
                        int num3 = num2;
                        default1.KayanYaziArkaPlanRenk = num3;
                        // ISSUE: variable of a compiler-generated type
                        Settings default2 = Settings.Default;
                        W_QLUSettings wQluSettings2 = this;
                        Color foreColor1 = this.btn_KayanYaziRenk.ForeColor;
                        int num4;
                        int num5 = num4 = foreColor1.ToArgb();
                        wQluSettings2.KayanYaziRenk = num4;
                        int num6 = num5;
                        default2.KayanYaziRenk = num6;
                        // ISSUE: variable of a compiler-generated type
                        Settings default3 = Settings.Default;
                        W_QLUSettings wQluSettings3 = this;
                        Color backColor2 = this.btn_LCDArkaPlanRenk.BackColor;
                        int num7;
                        int num8 = num7 = backColor2.ToArgb();
                        wQluSettings3.LCDArkaPlanRenk = num7;
                        int num9 = num8;
                        default3.LCDArkaplanRenk = num9;
                        // ISSUE: variable of a compiler-generated type
                        Settings default4 = Settings.Default;
                        W_QLUSettings wQluSettings4 = this;
                        Color foreColor2 = this.btn_LCDArkaPlanRenk.ForeColor;
                        int num10;
                        int num11 = num10 = foreColor2.ToArgb();
                        wQluSettings4.LCDFormArkaplanRenk = num10;
                        int num12 = num11;
                        default4.LCDFormArkaplanRenk = num12;
                        Settings.Default.UstBaslikKaysin = this.chk_UstYazi.Checked;
                        this.UstBaslikKaysin = this.chk_UstYazi.Checked;
                        Settings.Default.AltBaslikKaysin = this.chk_AltYazi.Checked;
                        this.AltBaslikKaysin = this.chk_AltYazi.Checked;
                        Settings.Default.UstBaslikYon = this.rbtn_UstSag.Checked;
                        this.UstBaslikYon =
                            Settings.Default.AltBaslikYon = this.rbtn_AltSag.Checked;
                        this.AltBaslikYon = this.rbtn_AltSag.Checked;
                        Settings.Default.UstBaslikHiz = this.txt_UstKaymaHizi.Value;
                        this.UstBaslikHiz = this.txt_UstKaymaHizi.Value;
                        Settings.Default.AltBaslikHiz = this.txt_AltKaymaHizi.Value;
                        this.AltBaslikHiz = this.txt_AltKaymaHizi.Value;
                        Settings.Default.Sutun1 = this.txt_Sutun1.Text;
                        this.Sutun1 = this.txt_Sutun1.Text;
                        Settings.Default.Sutun2 = this.txt_Sutun2.Text;
                        this.Sutun2 = this.txt_Sutun2.Text;
                        // ISSUE: variable of a compiler-generated type
                        Settings default5 = Settings.Default;
                        W_QLUSettings wQluSettings5 = this;
                        Color foreColor3 = this.btn_SutunRenk.ForeColor;
                        int num13;
                        int num14 = num13 = foreColor3.ToArgb();
                        wQluSettings5.SutunRenk = num13;
                        int num15 = num14;
                        default5.SutunRenk = num15;
                        if (this.radioButton1.Checked)
                            Settings.Default.SutunYaziOzellik = this.SutunYaziOzellik = 0;
                        else if (this.radioButton2.Checked)
                            Settings.Default.SutunYaziOzellik = this.SutunYaziOzellik = 1;
                        else if (this.radioButton3.Checked)
                            Settings.Default.SutunYaziOzellik = this.SutunYaziOzellik = 2;
                        Settings.Default.CagNoFont = this.CagNoFont = this.txt_CagNoFont.Text;
                        Settings.Default.CagNoPunto = this.CagNoPunto = this.txt_CagNoPunto.Value;
                        // ISSUE: variable of a compiler-generated type
                        Settings default6 = Settings.Default;
                        W_QLUSettings wQluSettings6 = this;
                        Color foreColor4 = this.btn_CagNoRenk.ForeColor;
                        int num16;
                        int num17 = num16 = foreColor4.ToArgb();
                        wQluSettings6.CagNoRenk = num16;
                        int num18 = num17;
                        default6.CagNoRenk = num18;
                        Settings.Default.SaatYukseklik = this.SaatYukseklik = this.txt_SaatYukseklik.Value;
                        Settings.Default.Save();
                    }
                }
            }
            catch (Exception ex)
            {
                int num =
                    (int)
                        MessageBox.Show(
                            "Ayarları kaydederken hata meydana geldi. Lütfen ayarlar dosyasını kontrol ediniz.\n" +
                            ex.Message, "Hata", MessageBoxButtons.OK, MessageBoxIcon.Hand);
            }
            this.lbl_Durum.Text = "Ayarlar başarıyla kaydedildi.";
        }

        private void btn_CagNoFont_Click(object sender, EventArgs e)
        {
            FontDialog fontDialog = new FontDialog();
            fontDialog.ScriptsOnly = true;
            fontDialog.Font = new Font(Settings.Default.CagNoFont, (float) Settings.Default.CagNoPunto);
            try
            {
                if (fontDialog.ShowDialog() != DialogResult.OK)
                    return;
                this.txt_CagNoFont.Text = fontDialog.Font.Name;
            }
            catch
            {
            }
            finally
            {
                this.txt_CagNoFont.Text = fontDialog.Font.Name;
            }
        }

        private void btn_CagNoRenk_MouseDown(object sender, MouseEventArgs e)
        {
            if (e.Button != MouseButtons.Left)
                return;
            ColorDialog colorDialog = new ColorDialog();
            if (colorDialog.ShowDialog() != DialogResult.OK)
                return;
            this.btn_CagNoRenk.ForeColor = colorDialog.Color;
        }

        public bool IsValidIP(string addr)
        {
            Regex regex =
                new Regex(
                    "\\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\b");
            return !(addr == "") && regex.IsMatch(addr, 0);
        }
    }
}
