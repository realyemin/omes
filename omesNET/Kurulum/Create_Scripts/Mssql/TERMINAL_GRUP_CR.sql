CREATE TABLE [dbo].[TERMINAL_GRUP](
	[TGID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[GRPID] [int] NULL,
	[CAGRI_ORAN] [smallint] NULL,
	[TRANSFER_ORAN] [smallint] NULL,
	[YARDIM_GRUBU] [bit] NULL,
	[CAGRILAN] [smallint] NULL,
	[TRANSFER_CAGRILAN] [smallint] NULL,
	[ONCELIK] [smallint] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[AYRICALIKLI] [bit] NULL,
 CONSTRAINT [PK_TERMINAL_GRUP] PRIMARY KEY CLUSTERED 
(
	[TGID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[TERMINAL_GRUP] ADD  CONSTRAINT [DF_TERMINAL_GRUP_CAGRILAN]  DEFAULT ((0)) FOR [CAGRILAN]
GO

ALTER TABLE [dbo].[TERMINAL_GRUP] ADD  CONSTRAINT [DF_TERMINAL_GRUP_TRANSFER_CAGRILAN]  DEFAULT ((0)) FOR [TRANSFER_CAGRILAN]
GO

ALTER TABLE [dbo].[TERMINAL_GRUP] ADD  CONSTRAINT [DF_TERMINAL_GRUP_ONCELIK]  DEFAULT ((0)) FOR [ONCELIK]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İLGİLİ TERMİNAL ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'TID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN İLİŞKİLENDİRİLDİĞİ GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'GRPID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN BU GRUPTAN NE SIKLIKLA MÜŞTERİ ÇAĞIRACAĞI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'CAGRI_ORAN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN, BU GRUBA TRANSFER EDİLMİŞ MÜŞTERİLERİ NE SIKLIKLA ÇAĞIRACAĞI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'TRANSFER_ORAN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN YARDIM EDECEĞİ GRUP MU?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'YARDIM_GRUBU'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN BU GRUPTAN NORMAL BİLETLİ MÜŞTERİLERİN NE KADARINI ÇAĞIRDIĞI.(ÇAĞRI ORAN DEĞERİNE ULAŞILDIĞINDA SIFIRLANACAK)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'CAGRILAN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN BU GRUPTAN TRANSFER EDİLMİŞ BİLETLİ MÜŞTERİLERİN NE KADARINI ÇAĞIRDIĞI.(TRANSFER ORAN DEĞERİNE ULAŞILDIĞINDA SIFIRLANACAK)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'TRANSFER_CAGRILAN'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR TERMİNALE ATANMIŞ GRUBUN BİLET ÇAĞIRMADAKİ ÖNCELİĞİ/SIRASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'ONCELIK'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

