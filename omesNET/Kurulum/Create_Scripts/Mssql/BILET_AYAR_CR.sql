CREATE TABLE [dbo].[BILET_AYAR](
	[KID] [int] NOT NULL,
	[BILET_BASLIK_S1] [nvarchar](30) NULL,
	[BILET_BASLIK_S2] [nvarchar](30) NULL,
	[BILET_BASLIK_S3] [nvarchar](30) NULL,
	[BILET_BASLIK_S4] [nvarchar](30) NULL,
	[ETIKET_BEKLEYEN] [nvarchar](30) NULL,
	[ETIKET_KARSILAMA1] [nvarchar](30) NULL,
	[ETIKET_KARSILAMA2] [nvarchar](30) NULL,
	[FONT_BEKLEYEN] [nvarchar](30) NULL,
	[FONT_KARSILAMA] [nvarchar](30) NULL,
	[FONT_BASLIK] [nvarchar](30) NULL,
	[FONT_GRUP] [nvarchar](30) NULL,
	[FONT_TARIH] [nvarchar](30) NULL,
	[FONT_SIRANO] [nvarchar](30) NULL,
	[FONT2_SIRANO] [nvarchar](30) NULL,
	[PUNTO_BEKLEYEN] [smallint] NULL,
	[PUNTO_KARSILAMA] [smallint] NULL,
	[PUNTO_BASLIK] [smallint] NULL,
	[PUNTO_GRUP] [smallint] NULL,
	[PUNTO_TARIH] [smallint] NULL,
	[PUNTO_SIRANO] [smallint] NULL,
	[YAZ_BEKLEYEN] [bit] NULL,
	[YAZ_KARSILAMA] [bit] NULL,
	[YAZ_BASLIK] [bit] NULL,
	[YAZ_GRUP] [bit] NULL,
	[YAZ_TARIH] [bit] NULL,
	[YAZ_SIRANO] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[OrtalamaBeklemeSuresiYaz] [bit] NULL,
 CONSTRAINT [PK_BILET_AYAR] PRIMARY KEY CLUSTERED 
(
	[KID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AYARIN SAHİBİ OLAN KIOSK ID, PRIMARY KEY, OTO ARTIŞ YOK' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'KID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BASILACAK OLAN BİLETTEKİ BAŞLIK/SATIR 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'BILET_BASLIK_S1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BASILACAK OLAN BİLETTEKİ BAŞLIK/SATIR 2' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'BILET_BASLIK_S2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN KİŞİ YAZISI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'ETIKET_BEKLEYEN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'ETIKET_KARSILAMA1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_BEKLEYEN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJI FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_KARSILAMA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BAŞLIĞIN FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_BASLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP İSMİNİN FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_GRUP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TARİH FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_TARIH'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_SIRANO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT2_SIRANO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_BEKLEYEN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJI PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_KARSILAMA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BAŞLIĞIN PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_BASLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP İSMİNİN PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_GRUP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TARİH PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_TARIH'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_SIRANO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN ETİKETİNİN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_BEKLEYEN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJININ BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_KARSILAMA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BAŞLIĞIN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_BASLIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP İSMİNİN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_GRUP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TARİHİN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_TARIH'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_SIRANO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

