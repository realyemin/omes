CREATE TABLE [dbo].[SYS_MESAJ](
	[SMMID] [int] NOT NULL,
	[MESAJ] [nvarchar](30) NULL
) ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SİSTEM MESAJ MASTER ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ', @level2type=N'COLUMN',@level2name=N'SMMID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'MESAJ METNİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ', @level2type=N'COLUMN',@level2name=N'MESAJ'
GO

