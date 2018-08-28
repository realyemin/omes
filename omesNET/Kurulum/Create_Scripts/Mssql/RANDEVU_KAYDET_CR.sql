CREATE TABLE [dbo].[RANDEVU_KAYDET](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[GRPID] [int] NULL,
	[BID] [int] NULL,
	[musteriAd] [nvarchar](100) NULL,
	[musteriSoyad] [nvarchar](100) NULL,
	[musteriTc] [nvarchar](11) NULL,
	[musteriTel] [nvarchar](20) NULL,
	[randevuTarihi] [date] NULL,
	[randevuSaati] [time](7) NULL,
	[biletNo] [nvarchar](10) NULL,
	[randevuKayitTarihi] [datetime] NULL,
	[randevuTalepSayisi] [tinyint] NULL,
	[IPAdresi] [nvarchar](50) NULL,
	[IPTAL] [bit] NULL,
 CONSTRAINT [PK_RANDEVU_KAYDET] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

