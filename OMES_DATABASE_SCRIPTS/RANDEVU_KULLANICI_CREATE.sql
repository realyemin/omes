USE [QCU2.MDF]
GO

/****** Object:  Table [dbo].[RANDEVU_KULLANICI]    Script Date: 7.06.2018 22:32:16 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[RANDEVU_KULLANICI](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[musteriAd] [nvarchar](100) NULL,
	[musteriSoyad] [nvarchar](100) NULL,
	[musteriTc] [nvarchar](11) NULL,
	[musteriTel] [nvarchar](20) NULL,
	[kayitTarihi] [date] NULL,
	[IPAdresi] [nvarchar](50) NULL,
 CONSTRAINT [PK_RANDEVU_KULLANICI] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

