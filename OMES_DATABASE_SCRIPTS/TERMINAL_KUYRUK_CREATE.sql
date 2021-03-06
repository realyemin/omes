USE [QCU2.MDF]
GO

/****** Object:  Table [dbo].[TERMINAL_KUYRUK]    Script Date: 7.06.2018 22:36:11 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TERMINAL_KUYRUK](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[TerminalID] [int] NULL,
	[BirimNo] [int] NULL,
	[tarih] [datetime] NULL,
 CONSTRAINT [PK_TERMINAL_KUYRUK] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

