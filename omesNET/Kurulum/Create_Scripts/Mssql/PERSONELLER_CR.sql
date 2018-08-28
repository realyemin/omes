CREATE TABLE [dbo].[PERSONELLER](
	[PID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[AD] [nvarchar](25) NULL,
	[SOYAD] [nvarchar](25) NULL,
	[ADRES] [nvarchar](250) NULL,
	[TEL] [nvarchar](15) NULL,
	[GSM] [nvarchar](15) NULL,
	[EMAIL] [nvarchar](30) NULL,
	[ACIKLAMA] [nvarchar](250) NULL,
	[CALISIYOR] [bit] NULL,
	[KAYIT_TARIHI] [datetime] NULL,
	[KULLANICI_ADI] [nvarchar](15) NOT NULL,
	[SIFRE] [nvarchar](15) NOT NULL,
	[OTURUM_DURUM] [bit] NULL,
	[SIL] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
 CONSTRAINT [PK_PERSONELLER] PRIMARY KEY CLUSTERED 
(
	[PID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_CALISIYOR]  DEFAULT ((1)) FOR [CALISIYOR]
GO

ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_KAYITTARIHI]  DEFAULT (getdate()) FOR [KAYIT_TARIHI]
GO

ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_OTURUM_DURUM]  DEFAULT ((0)) FOR [OTURUM_DURUM]
GO

ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_SIL]  DEFAULT ((0)) FOR [SIL]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Personelin halen çalışıp çalışmadığı' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'CALISIYOR'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR OTURUM AÇMIŞ DURUMDASINIZ. YALNIZCA BİR OTURUM AÇABİLİRSİNİZ" DİYEREK MESAJ VERİLMELİ.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'OTURUM_DURUM'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Varsayılan 0. Kayıt kullanıcı tarafından programdan silindiğinde 1.(Personel kaydı halen durur.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'SIL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'PERSONELLER', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

