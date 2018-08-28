CREATE TABLE [dbo].[SYS_MESAJ_MASTER](
	[SMMID] [int] IDENTITY(1,1) NOT NULL,
	[MESAJ_TIP] [nvarchar](20) NULL,
 CONSTRAINT [PK_SYS_MESAJ_MASTER] PRIMARY KEY CLUSTERED 
(
	[SMMID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SİSTEM MESAJLARI MASTER ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ_MASTER', @level2type=N'COLUMN',@level2name=N'SMMID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'MESAJ TİPİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ_MASTER', @level2type=N'COLUMN',@level2name=N'MESAJ_TIP'
GO

