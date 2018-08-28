CREATE TABLE [dbo].[SERVIS_HAREKET](
	[SKID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[SEBEP] [nvarchar](250) NULL,
	[KAP_TAR] [datetime] NULL,
	[AC_TAR] [datetime] NULL,
	[KAPALI] [bit] NULL,
 CONSTRAINT [PK_SERVIS_HAREKET] PRIMARY KEY CLUSTERED 
(
	[SKID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[SERVIS_HAREKET] ADD  CONSTRAINT [DF_SERVIS_HAREKET_KAPALI]  DEFAULT ((0)) FOR [KAPALI]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SERVİSİNİ KAPATAN TERMİNAL' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'TID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SERVİSİ KAPATMA SEBEBİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'SEBEP'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SERVİSİ KAPATTIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'KAP_TAR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SERVİSİ AÇTIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'AC_TAR'
GO

