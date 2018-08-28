USE [QCU2.MDF]
GO

/****** Object:  Table [dbo].[RANDEVU_AYAR]    Script Date: 7.06.2018 22:31:37 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[RANDEVU_AYAR](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[randevuSecimi] [tinyint] NULL,
	[minimumTarihSayisi] [tinyint] NULL,
	[minimumTarihTuru] [nvarchar](1) NULL,
	[maksimumTarihSayisi] [tinyint] NULL,
	[maksimumTarihTuru] [nvarchar](1) NULL,
	[takvimAnimasyon] [nvarchar](20) NULL,
	[animasyonHizi] [nvarchar](10) NULL,
	[biletSinirla] [bit] NULL,
	[biletSinirSayisi] [tinyint] NULL,
	[oturumSuresi] [tinyint] NULL,
	[oturumSuresiGoster] [bit] NULL,
	[dogrulamaKoduGoster] [bit] NULL,
	[GRPID] [int] NULL,
 CONSTRAINT [PK_Table_1_1] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

