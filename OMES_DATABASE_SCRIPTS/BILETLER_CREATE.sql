USE [QCU.MDF]
GO

/****** Object:  Table [dbo].[BILETLER]    Script Date: 10.06.2018 04:35:07 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[BILETLER](
	[BID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[GRPID] [int] NULL,
	[BILET_NO] [smallint] NULL,
	[SIS_TAR] [datetime] NULL,
	[ISLEM_BAS_TAR] [time](0) NULL,
	[ISLEM_BIT_TAR] [time](0) NULL,
	[TRANSFER] [bit] NULL,
	[TUR] [smallint] NULL,
	[OZEL_MUSTERI] [bit] NULL,
	[BTNID] [int] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[Zaman] [datetime] NULL,
	[MusteriNo] [varchar](50) NULL,
	[MusteriAdi] [varchar](150) NULL,
 CONSTRAINT [PK_BILETLER] PRIMARY KEY CLUSTERED 
(
	[BID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[BILETLER] ADD  CONSTRAINT [DF_BILETLER_TUR]  DEFAULT ((1)) FOR [TUR]
GO

ALTER TABLE [dbo].[BILETLER] ADD  CONSTRAINT [DF_BILETLER_OZEL_MUSTERI]  DEFAULT ((0)) FOR [OZEL_MUSTERI]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İŞLEMİ YAPAN TERMİNALİN ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'TID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'HAREKETİN GERÇEKLEŞTİĞİ (BİLETİN VERİLDİĞİ) GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'GRPID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET NUMARASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'BILET_NO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİN ALINDIĞI/SİSTEME KAYDOLDUĞU VEYA TRANSFER EDİLDİĞİ TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'SIS_TAR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİN İŞLEME ALINDIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'ISLEM_BAS_TAR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İŞLEMİN BİTTİĞİ TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'ISLEM_BIT_TAR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR BİLET TRANSFER EDİLDİĞİNDE TEKRAR HAREKET TABLOSUNA KAYDEDİLER. VARSAYILAN TRANSFER=0(TRANSFER DEĞİL)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'TRANSFER'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP ÜZERİNDEKİ BİLET BİTTİĞİNDE BAŞA DÖN DURUMU AKTİFSE TUR SAYISI 1 ARTAR. BAŞLANGIÇ DEĞERİ = 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'TUR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİ ALAN KİŞİ ÖZEL MÜŞTERİ Mİ? (FİKTİF BİLET İÇİN) ÇAĞRILMA ORANINI ETKİLEYECEK DEĞER. VARSAYILAN = 0' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'OZEL_MUSTERI'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİN VERİLDİĞİ BUTONUN ID''Sİ(BİLET MAKİNESİ ÜZERİNDEKİ BUTONUN FİZİKSEL ADRESİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'BTNID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

