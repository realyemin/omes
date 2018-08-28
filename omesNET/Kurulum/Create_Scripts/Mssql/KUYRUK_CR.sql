CREATE TABLE [dbo].[KUYRUK](
	[BID] [int] NOT NULL,
	[GRPID] [int] NULL,
	[BILET_NO] [smallint] NULL,
	[TRANSFER] [bit] NULL,
	[OZEL_MUSTERI] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
 CONSTRAINT [PK_KUYRUK] PRIMARY KEY CLUSTERED 
(
	[BID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[KUYRUK] ADD  CONSTRAINT [DF_KUYRUK_TRANSFER]  DEFAULT ((0)) FOR [TRANSFER]
GO

ALTER TABLE [dbo].[KUYRUK] ADD  CONSTRAINT [DF_KUYRUK_OZEL_MUSTERI]  DEFAULT ((0)) FOR [OZEL_MUSTERI]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KUYRUKTA BEKLEYEN BİLET' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'BID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'HAREKETİN GERÇEKLEŞTİĞİ (BİLETİN VERİLDİĞİ) GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'GRPID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET NUMARASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'BILET_NO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR BİLET TRANSFER EDİLDİĞİNDE TEKRAR HAREKET TABLOSUNA KAYDEDİLER. VARSAYILAN TRANSFER=0(TRANSFER DEĞİL)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'TRANSFER'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİ ALAN KİŞİ ÖZEL MÜŞTERİ Mİ? (FİKTİF BİLET) ÇAĞRILMA ORANINI ETKİLEYECEK DEĞER.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'OZEL_MUSTERI'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

