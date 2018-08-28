CREATE TABLE [dbo].[TERMINALLER](
	[TID] [int] IDENTITY(1,1) NOT NULL,
	[ELTID] [int] NULL,
	[TERMINAL_AD] [nvarchar](20) NULL,
	[OTO_CAGRI] [bit] NULL,
	[OTO_SURE] [time](7) NULL,
	[DURUM] [smallint] NULL,
	[AKTIF] [bit] NULL,
	[AKTIF_BID] [int] NULL,
	[SON_CAGRILAN_GRUP] [int] NULL,
	[SON_CAGRILAN_TUR] [bit] NULL,
	[SIL] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[TerminalTipi] [varchar](50) NULL,
	[DoubleClick] [bit] NULL,
	[SiralamaTipi] [varchar](50) NULL,
	[CagriSiralamaTipi] [varchar](50) NULL,
 CONSTRAINT [PK_TERMINALLER] PRIMARY KEY CLUSTERED 
(
	[TID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_OTO_CAGRI]  DEFAULT ((0)) FOR [OTO_CAGRI]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_DURUM]  DEFAULT ((6)) FOR [DURUM]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_AKTIF]  DEFAULT ((1)) FOR [AKTIF]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SON_CAGRILAN_BID]  DEFAULT ((0)) FOR [AKTIF_BID]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SON_CAGRILAN_GRUP]  DEFAULT ((0)) FOR [SON_CAGRILAN_GRUP]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SON_BILET_TUR]  DEFAULT ((0)) FOR [SON_CAGRILAN_TUR]
GO

ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SIL]  DEFAULT ((0)) FOR [SIL]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALE BAĞLI OLAN EL TERMİNALİ ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'ELTID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ADI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'TERMINAL_AD'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SANAL TERMİNALİN OTO ÇAĞRI YAPMASININ AKTİF OLUP OLMADIĞI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'OTO_CAGRI'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTOMATİK ÇAĞRI SÜRESİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'OTO_SURE'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SİSTEMDEKİ ANLIK DURUMU, 
SERVİS DIŞI, MÜŞTERİYLE MEŞGUL, BOŞTA, MOLADA, SİSTEMDE DEĞİL GİBİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'DURUM'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ÇALIŞMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'AKTIF'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ŞU AN İŞLEM YAPTIĞI BİLETİN ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'AKTIF_BID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN İŞLEM İÇİN BEKLEYEN BİLETLERDEN SON ÇAĞIRDIĞI BİLETİN GRUBU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'SON_CAGRILAN_GRUP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ÇAĞIRDIĞI SON BİLETİN TRANSFER BİLETİ OLUP OLMADIĞINI TUTAN ALAN' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'SON_CAGRILAN_TUR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Varsayılan 0. Kayıt kullanıcı tarafından programdan silindiğinde 1.(Terminal kaydı halen durur.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'SIL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

