CREATE TABLE [dbo].[GRUPLAR](
	[GRPID] [int] IDENTITY(1,1) NOT NULL,
	[GRUP_ISMI] [nvarchar](50) NOT NULL,
	[BAS_NO] [int] NULL,
	[BIT_NO] [int] NULL,
	[DONGU] [bit] NULL,
	[MIN_HIZMET_SURESI] [time](0) NULL,
	[MAX_HIZMET_SURESI] [time](0) NULL,
	[AKTIF] [bit] NULL,
	[MESAI_BAS] [time](0) NULL,
	[MESAI_BIT] [time](0) NULL,
	[OGLE_BAS] [time](0) NULL,
	[OGLE_BIT] [time](0) NULL,
	[OGLEN_BILET_VER] [bit] NULL,
	[BILET_SINIRLA] [bit] NULL,
	[OO_MAX_BILET] [int] NULL,
	[OS_MAX_BILET] [int] NULL,
	[SIL] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[BeklemeSuresiTipi] [int] NULL,
	[Webrandevu] [bit] NULL,
 CONSTRAINT [PK_GRUPLAR] PRIMARY KEY CLUSTERED 
(
	[GRPID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[GRUPLAR] ADD  CONSTRAINT [DF_GRUPLAR_SIL]  DEFAULT ((0)) FOR [SIL]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET VERMEYE BAŞLANILAN NUMARA' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BAS_NO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SON BİLET NUMARASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BIT_NO'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİTİŞ NUMARASINA ERDİKTEN SONRA TEKRAR BAŞLANGIÇ NUMARASINDAN BİLET VERMEYE DEVAM EDİLSİN Mİ?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'DONGU'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLE TATİLİNDE SİSTEMİN BİLET VERİP VERMEYECEĞİNİ TUTAN ALAN' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'OGLEN_BILET_VER'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLEDEN ÖNCE VE ÖĞLEDEN SONRA VERİLECEK BİLET ADETİNDE SINIRLAMASI YAPILSIN MI?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BILET_SINIRLA'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLEDEN ÖNCE GRUBA VERİLECEK BİLET SINIRLAMASI SAYISI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'OO_MAX_BILET'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLEDEN SONRA GRUBA VERİLECEK BİLET SINIRLAMASI SAYISI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'OS_MAX_BILET'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KAYDIN SİLİNME DURUMU VARSAYILAN=0 FALSE' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'SIL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'0- yok, 1- manuel, 2-otomatik' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BeklemeSuresiTipi'
GO

