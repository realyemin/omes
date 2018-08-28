USE [QCU2.MDF]
GO

/****** Object:  Table [dbo].[KIOSK_AYAR]    Script Date: 7.06.2018 22:29:39 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[KIOSK_AYAR](
	[KID] [int] NOT NULL,
	[BASLIK] [nvarchar](200) NULL,
	[ALT_BASLIK] [nvarchar](200) NULL,
	[MESAJ_OGLE] [nvarchar](50) NULL,
	[MESAJ_SISTEM_KAPALI] [nvarchar](50) NULL,
	[MESAJ_SERVIS_KAPALI] [nvarchar](50) NULL,
	[SOL_BTN_ADET] [smallint] NULL,
	[SAG_BTN_ADET] [smallint] NULL,
	[SOL_PADDING] [smallint] NULL,
	[SAG_PADDING] [smallint] NULL,
	[FONT] [nvarchar](40) NULL,
	[PUNTO] [smallint] NULL,
	[BTN_FONT] [nvarchar](40) NULL,
	[BTN_PUNTO] [smallint] NULL,
	[GECIKME] [int] NULL,
	[YAZI_RENGI] [int] NULL,
	[RENK] [int] NULL,
	[RESIM] [image] NULL,
	[RESIM_AD] [nvarchar](20) NULL,
	[ESKI_RESIM_AD] [nvarchar](20) NULL,
	[RESIM_YON] [int] NULL,
	[BASLIK_KAY] [bit] NULL,
	[ALT_BASLIK_KAY] [bit] NULL,
	[YON_BASLIK] [bit] NULL,
	[YON_ALT_BASLIK] [bit] NULL,
	[HIZ_BASLIK] [int] NULL,
	[HIZ_ALT_BASLIK] [int] NULL,
	[AKTIF] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[TagPreviewHeight] [int] NULL,
	[TagPreviewWidth] [int] NULL,
	[TagPreviewTimerInterval] [int] NULL,
	[TagPreviewZoom] [numeric](18, 4) NULL,
	[TotalTag] [int] NULL,
	[MaxTotalTag] [int] NULL,
	[TagOverFlowPerId] [int] NULL,
	[TagOverFlowMessage] [nvarchar](500) NULL,
	[RandevuButonMetni] [varchar](150) NULL,
	[AltButonSuresi] [int] NULL,
	[WebdenRandevu] [bit] NULL,
	[BeklemeSuresiMetni] [nvarchar](500) NULL,
	[EtiketSifirlamasifresi] [int] NULL,
	[BarkodlaEtiket] [bit] NULL,
 CONSTRAINT [PK_KIOSK_AYAR] PRIMARY KEY CLUSTERED 
(
	[KID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YAZI_RENGI]  DEFAULT ((0)) FOR [YAZI_RENGI]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_RENK]  DEFAULT ((0)) FOR [RENK]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_BASLIK_KAY]  DEFAULT ((1)) FOR [BASLIK_KAY]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_ALT_BASLIK_KAY]  DEFAULT ((1)) FOR [ALT_BASLIK_KAY]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YON_BASLIK]  DEFAULT ((0)) FOR [YON_BASLIK]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YON_ALT_BASLIK]  DEFAULT ((0)) FOR [YON_ALT_BASLIK]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_HIZ_BASLIK]  DEFAULT ((1)) FOR [HIZ_BASLIK]
GO

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_HIZ_ALT_BASLIK]  DEFAULT ((1)) FOR [HIZ_ALT_BASLIK]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK ID PRIMARY KEY, BİLET MAKİNESİ TABLOSUNA EKLENEN MAKİNENIN ADRESİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'KID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDA GÖRÜNTÜLENECEK OLAN BAŞLIK TEXTİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'BASLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDA GÖRÜNTÜLENECEK OLAN ALT BAŞLIK TEXTİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'ALT_BASLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SOL TARAFTA ÇİZİLECEK OLAN BUTON SAYISI. EĞER NULL İSE SIRAYLA TÜM BUTONLARI UYGUN ŞEKİLDE ÇİZER (GEREK OLAMAYABİLİR. ÇİZİM HESAPLAMASI KOD İLE YAPILABİLİR.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SOL_BTN_ADET'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SAĞ TARAFTA ÇİZİLECEK OLAN BUTON SAYISI. EĞER NULL İSE SIRAYLA TÜM BUTONLARI UYGUN ŞEKİLDE ÇİZER (GEREK OLAMAYABİLİR. ÇİZİM HESAPLAMASI KOD İLE YAPILABİLİR.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SAG_BTN_ADET'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK FORMUNUN SOL KISIMDAN PADDING DEĞERİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SOL_PADDING'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK FORMUNUN SAĞ KISIMDAN PADDING DEĞERİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SAG_PADDING'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK YAZI TİPİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'FONT'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK YAZI PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDAKİ BUTONA BASILDIĞINDA BİLETİ VERDİKTEN SONRA İKİNCİ BİLET İÇİN BEKLEME SÜRESİ, DELAY' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'GECIKME'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSKUN ÇALIŞMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'AKTIF'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewHeight'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewWidth'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewTimerInterval'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewZoom'
GO

