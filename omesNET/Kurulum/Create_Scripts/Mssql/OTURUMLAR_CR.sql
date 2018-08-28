CREATE TABLE [dbo].[OTURUMLAR](
	[OID] [int] IDENTITY(1,1) NOT NULL,
	[PID] [int] NOT NULL,
	[OTURUM_BAS_TARIH] [datetime] NULL,
	[OTURUM_BIT_TARIH] [datetime] NULL,
 CONSTRAINT [PK_OTURUMLAR] PRIMARY KEY CLUSTERED 
(
	[OID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUM KAYIT ID. PRIMARY KEY' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'OID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUM AÇAN PERSONELİN ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'PID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUMUN BAŞLATILDIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'OTURUM_BAS_TARIH'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUMUN KAPATILDIĞI TARİH' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'OTURUM_BIT_TARIH'
GO

