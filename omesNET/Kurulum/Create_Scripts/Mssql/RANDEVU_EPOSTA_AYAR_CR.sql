CREATE TABLE [dbo].[RANDEVU_EPOSTA_AYAR](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[host] [nvarchar](50) NULL,
	[port] [nvarchar](10) NULL,
	[username] [nvarchar](50) NULL,
	[password] [nvarchar](50) NULL,
	[fromMesaj] [nvarchar](50) NULL,
	[subject] [nvarchar](50) NULL,
	[GRPID] [int] NULL,
	[Aktif] [bit] NULL,
 CONSTRAINT [PK_RANDEVU_EPOSTA_AYAR] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO