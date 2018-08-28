CREATE TABLE [dbo].[BILET_MAKINELERI](
	[MAKINE_ADRESI] [int] NOT NULL,
	[MAKINE_ADI] [nvarchar](25) NULL,
	[MAKINE_TURU] [smallint] NULL,
	[SIL] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
 CONSTRAINT [PK_BILET_MAKINELERI] PRIMARY KEY CLUSTERED 
(
	[MAKINE_ADRESI] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[BILET_MAKINELERI] ADD  CONSTRAINT [DF_BILET_MAKINELERI_SIL]  DEFAULT ((0)) FOR [SIL]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'MAKİNENİN FİZİKSEL ADRESİ (OTOMATİK ARTIŞ YOK!)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'MAKINE_ADRESI'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET MAKİNESİNİN ADI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'MAKINE_ADI'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET MAKİNESİ TURU. 1=KIOSK, 0=BUTONLU MAKİNE' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'MAKINE_TURU'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KAYDIN SİLİNME DURUMU VARSAYILAN=0 (FALSE)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'SIL'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_MAKINELERI', @level2type=N'COLUMN',@level2name=N'B_YF'
GO

