CREATE TABLE [dbo].[ANATABLOLAR](
	[ATID] [int] NOT NULL,
	[TABLO_ADI] [nvarchar](20) NULL,
	[TABLO_TURU] [smallint] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
 CONSTRAINT [PK_ANATABLOLAR] PRIMARY KEY CLUSTERED 
(
	[ATID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]