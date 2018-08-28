USE [QCU.MDF]
GO

/****** Object:  Table [dbo].[BUTONLAR]    Script Date: 10.06.2018 04:35:16 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[BUTONLAR](
	[BM_ADRES] [int] NOT NULL,
	[BTNID] [int] NOT NULL,
	[GRP_ID] [int] NULL,
	[ANA_BTNID] [int] NULL,
	[BTN_EKRAN] [nvarchar](250) NULL,
	[BTN_BILET_S1] [nvarchar](50) NULL,
	[BTN_BILET_S2] [nvarchar](50) NULL,
	[BTN_BILET_S3] [nvarchar](50) NULL,
	[BTN_BILET_S4] [nvarchar](50) NULL,
	[MAKS_BILET] [smallint] NULL,
	[BILET_KOPYA] [smallint] NULL,
	[YUKSEKLIK] [smallint] NULL,
	[GENISLIK] [smallint] NULL,
	[RENK] [int] NULL,
	[YAZI_RENGI] [int] NULL,
	[RESIM] [image] NULL,
	[RESIM_YON] [int] NULL,
	[RESIM_AD] [nvarchar](20) NULL,
	[ESKI_RESIM_AD] [nvarchar](20) NULL,
	[ACIKLAMA] [nvarchar](250) NULL,
	[AKTIF] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[RandevuButonuMu] [bit] NULL,
	[GRP_ID2] [int] NULL,
	[GRP1_ORAN] [int] NULL,
	[GRP2_ORAN] [int] NULL,
	[GRP_ID3] [int] NULL,
	[GRP3_ORAN] [int] NULL,
	[GRP_ID4] [int] NULL,
	[GRP4_ORAN] [int] NULL,
	[FONT] [nvarchar](40) NULL,
	[PUNTO] [smallint] NULL,
	[Border_Style] [nvarchar](20) NULL,
	[Border_Width] [tinyint] NULL,
	[Border_Color] [int] NULL,
	[Border_Radius] [tinyint] NULL,
 CONSTRAINT [PK_BUTONLAR] PRIMARY KEY CLUSTERED 
(
	[BTNID] ASC,
	[BM_ADRES] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_ANA_BTNID]  DEFAULT ((0)) FOR [ANA_BTNID]
GO

ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_BILET_KOPYA]  DEFAULT ((1)) FOR [BILET_KOPYA]
GO

ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_RENK]  DEFAULT ((0)) FOR [RENK]
GO

ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_YAZI_RENGİ]  DEFAULT ((0)) FOR [YAZI_RENGI]
GO

ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_RESIM_YON]  DEFAULT ((32)) FOR [RESIM_YON]
GO

ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_AKTIF]  DEFAULT ((1)) FOR [AKTIF]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN AİT OLDUĞU BİLET MAKİNESİ FİZİKSEL ADRESİ, KIOSK İÇİN PRINTERI İFADE ETMEKTEDİR' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BM_ADRES'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET MAKİNESİNDEKİ FİZİKSEL BUTON ID''Sİ KIOSKTA SADECE SIRALAMA ANLAMI İFADE ETMEKTEDİR.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTNID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONA BASILDIĞINDA BİLETİN VERİLECEĞİ GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'GRP_ID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'EĞER BUTON ALT BUTON İSE ANA BUTONUN ID''Sİ. DEĞİLSE 0' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'ANA_BTNID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK ÜZERİNDEKİ BUTONUN EKRANA BASILDIĞINDA ÜZERİNDE YAZACAK OLAN YAZI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_EKRAN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN İLK SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN İKİNCİ SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN ÜÇÜNCÜ SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN DÖRDÜNCÜ SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S4'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUBA BİR GÜNDE MAKSİMUM KAÇ TANE BİLET BASILACAĞI. GRUP BİLET BİTİNCE BAŞA DÖN AKTİFSE DE TUR SAYISINI ETKİLER.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'MAKS_BILET'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR İSTEKTE BASILACAK BİLET KOPYA SAYISI. AYNI BİLETİ BELİRTİLEN SAYI KADAR BASAR. VARSAYILAN 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BILET_KOPYA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK UZERİNDEKİ YÜKSEKLİĞİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'YUKSEKLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK UZERİNDEKİ GENİŞLİĞİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'GENISLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK ÜZERİNDEKİ ARKA PLAN RENGİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'RENK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK ÜZERİNDEKİ ARKA PLAN RESMI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'RESIM'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YÜKLENEN ARKA PLAN RESMİNİN İSMİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'RESIM_AD'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AÇIKLAMA' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'ACIKLAMA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN AKTİFLİK DURUMU. VARSAYILAN TRUE' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'AKTIF'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

