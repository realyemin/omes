CREATE TABLE [dbo].[RANDEVU_KULLANICI](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[musteriAd] [nvarchar](100) NULL,
	[musteriSoyad] [nvarchar](100) NULL,
	[musteriTc] [nvarchar](11) NULL,
	[musteriTel] [nvarchar](20) NULL,
	[musteriEposta] [nvarchar](120) NULL,
	[kayitTarihi] [date] NULL,
	[IPAdresi] [nvarchar](50) NULL,
 CONSTRAINT [PK_RANDEVU_KULLANICI] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

