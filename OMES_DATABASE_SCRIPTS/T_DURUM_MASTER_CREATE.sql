USE [QCU2.MDF]
GO

/****** Object:  Table [dbo].[T_DURUM_MASTER]    Script Date: 7.06.2018 22:34:26 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[T_DURUM_MASTER](
	[DID] [int] NOT NULL,
	[DURUM] [nvarchar](25) NULL,
 CONSTRAINT [PK_T_DURUM_MASTER] PRIMARY KEY CLUSTERED 
(
	[DID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SİSTEM ÜZERİNDEKİ DURUM MASTER TABLOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'T_DURUM_MASTER', @level2type=N'COLUMN',@level2name=N'DURUM'
GO

