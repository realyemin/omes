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

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YAZI_RENGI]  DEFAULT ((0)) FOR [YAZI_RENGI]

ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_RENK]  DEFAULT ((0)) FOR [RENK]


ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_BASLIK_KAY]  DEFAULT ((1)) FOR [BASLIK_KAY]


ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_ALT_BASLIK_KAY]  DEFAULT ((1)) FOR [ALT_BASLIK_KAY]


ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YON_BASLIK]  DEFAULT ((0)) FOR [YON_BASLIK]


ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YON_ALT_BASLIK]  DEFAULT ((0)) FOR [YON_ALT_BASLIK]


ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_HIZ_BASLIK]  DEFAULT ((1)) FOR [HIZ_BASLIK]


ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_HIZ_ALT_BASLIK]  DEFAULT ((1)) FOR [HIZ_ALT_BASLIK]


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK ID PRIMARY KEY, BİLET MAKİNESİ TABLOSUNA EKLENEN MAKİNENIN ADRESİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'KID'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDA GÖRÜNTÜLENECEK OLAN BAŞLIK TEXTİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'BASLIK'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDA GÖRÜNTÜLENECEK OLAN ALT BAŞLIK TEXTİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'ALT_BASLIK'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SOL TARAFTA ÇİZİLECEK OLAN BUTON SAYISI. EĞER NULL İSE SIRAYLA TÜM BUTONLARI UYGUN ŞEKİLDE ÇİZER (GEREK OLAMAYABİLİR. ÇİZİM HESAPLAMASI KOD İLE YAPILABİLİR.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SOL_BTN_ADET'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SAĞ TARAFTA ÇİZİLECEK OLAN BUTON SAYISI. EĞER NULL İSE SIRAYLA TÜM BUTONLARI UYGUN ŞEKİLDE ÇİZER (GEREK OLAMAYABİLİR. ÇİZİM HESAPLAMASI KOD İLE YAPILABİLİR.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SAG_BTN_ADET'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK FORMUNUN SOL KISIMDAN PADDING DEĞERİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SOL_PADDING'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK FORMUNUN SAĞ KISIMDAN PADDING DEĞERİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SAG_PADDING'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK YAZI TİPİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'FONT'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK YAZI PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDAKİ BUTONA BASILDIĞINDA BİLETİ VERDİKTEN SONRA İKİNCİ BİLET İÇİN BEKLEME SÜRESİ, DELAY' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'GECIKME'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSKUN ÇALIŞMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'AKTIF'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF1'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF2'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF3'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF1'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF2'

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF3'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'B_YF'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewHeight'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewWidth'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewTimerInterval'


EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewZoom'


