USE [master]
GO
/****** Object:  Database [QCU.MDF]    Script Date: 20.05.2018 03:52:38 ******/
CREATE DATABASE [QCU.MDF]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'QCU', FILENAME = N'E:\Visual Studio Project\OMES ELEKTRONIK\DATA\QCU.mdf' , SIZE = 53248KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'QCU_log', FILENAME = N'E:\Visual Studio Project\OMES ELEKTRONIK\DATA\QCU_log.ldf' , SIZE = 3840KB , MAXSIZE = UNLIMITED, FILEGROWTH = 10%)
GO
ALTER DATABASE [QCU.MDF] SET COMPATIBILITY_LEVEL = 100
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [QCU.MDF].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [QCU.MDF] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [QCU.MDF] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [QCU.MDF] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [QCU.MDF] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [QCU.MDF] SET ARITHABORT OFF 
GO
ALTER DATABASE [QCU.MDF] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [QCU.MDF] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [QCU.MDF] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [QCU.MDF] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [QCU.MDF] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [QCU.MDF] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [QCU.MDF] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [QCU.MDF] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [QCU.MDF] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [QCU.MDF] SET  DISABLE_BROKER 
GO
ALTER DATABASE [QCU.MDF] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [QCU.MDF] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [QCU.MDF] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [QCU.MDF] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [QCU.MDF] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [QCU.MDF] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [QCU.MDF] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [QCU.MDF] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [QCU.MDF] SET  MULTI_USER 
GO
ALTER DATABASE [QCU.MDF] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [QCU.MDF] SET DB_CHAINING OFF 
GO
ALTER DATABASE [QCU.MDF] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [QCU.MDF] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [QCU.MDF] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [QCU.MDF] SET QUERY_STORE = OFF
GO
USE [QCU.MDF]
GO
ALTER DATABASE SCOPED CONFIGURATION SET IDENTITY_CACHE = ON;
GO
ALTER DATABASE SCOPED CONFIGURATION SET LEGACY_CARDINALITY_ESTIMATION = OFF;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET LEGACY_CARDINALITY_ESTIMATION = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET MAXDOP = 0;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET MAXDOP = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET PARAMETER_SNIFFING = ON;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET PARAMETER_SNIFFING = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET QUERY_OPTIMIZER_HOTFIXES = OFF;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET QUERY_OPTIMIZER_HOTFIXES = PRIMARY;
GO
USE [QCU.MDF]
GO
/****** Object:  User [mtQcu]    Script Date: 20.05.2018 03:52:38 ******/
CREATE USER [mtQcu] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  User [mtOmes]    Script Date: 20.05.2018 03:52:38 ******/
CREATE USER [mtOmes] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  View [dbo].[vAnlikGrupDurumu]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE view [dbo].[vAnlikGrupDurumu] as 
select distinct BolgeAdI, BID, GRPID, TID, ISNULL(GRUP_ISMI, '#Grup Kaydı Silinmiş#') GrupAdi ,
DATEDIFF(second, ISLEM_BAS_TAR, ISLEM_BIT_TAR) IslemSuresi, 
DATEDIFF(second, CONVERT(time, SIS_TAR), ISLEM_BAS_TAR) BeklemeSuresi,

CASE when TID = 0 THEN 0 ELSE 1 END TID2


from omesBI

WHERE SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00' AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 




GO
/****** Object:  View [dbo].[vGrupDurumu3]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
Create view [dbo].[vGrupDurumu3] as
select BolgeAdI BolgeAdi, GrupAdi, sum(TID2) IslemGoren, count(BID) - sum(TID2) IslemGormeyen, count(BID) Toplam

from vAnlikGrupDurumu
group by BolgeAdI, GrupAdi, TID2


GO
/****** Object:  Table [dbo].[PERSONELLER]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
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
/****** Object:  Table [dbo].[TERMINAL_GRUP]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TERMINAL_GRUP](
	[TGID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[GRPID] [int] NULL,
	[CAGRI_ORAN] [smallint] NULL,
	[TRANSFER_ORAN] [smallint] NULL,
	[YARDIM_GRUBU] [bit] NULL,
	[CAGRILAN] [smallint] NULL,
	[TRANSFER_CAGRILAN] [smallint] NULL,
	[ONCELIK] [smallint] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[AYRICALIKLI] [bit] NULL,
 CONSTRAINT [PK_TERMINAL_GRUP] PRIMARY KEY CLUSTERED 
(
	[TGID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BILETLER]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BILETLER](
	[BID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[GRPID] [int] NULL,
	[BILET_NO] [smallint] NULL,
	[SIS_TAR] [datetime] NULL,
	[ISLEM_BAS_TAR] [time](0) NULL,
	[ISLEM_BIT_TAR] [time](0) NULL,
	[TRANSFER] [bit] NULL,
	[TUR] [smallint] NULL,
	[OZEL_MUSTERI] [bit] NULL,
	[BTNID] [int] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[Zaman] [datetime] NULL,
	[MusteriNo] [varchar](50) NULL,
	[MusteriAdi] [varchar](150) NULL,
 CONSTRAINT [PK_BILETLER] PRIMARY KEY CLUSTERED 
(
	[BID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TERMINALLER]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TERMINALLER](
	[TID] [int] IDENTITY(1,1) NOT NULL,
	[ELTID] [int] NULL,
	[TERMINAL_AD] [nvarchar](20) NULL,
	[OTO_CAGRI] [bit] NULL,
	[OTO_SURE] [time](7) NULL,
	[DURUM] [smallint] NULL,
	[AKTIF] [bit] NULL,
	[AKTIF_BID] [int] NULL,
	[SON_CAGRILAN_GRUP] [int] NULL,
	[SON_CAGRILAN_TUR] [bit] NULL,
	[SIL] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[TerminalTipi] [varchar](50) NULL,
	[DoubleClick] [bit] NULL,
	[SiralamaTipi] [varchar](50) NULL,
	[CagriSiralamaTipi] [varchar](50) NULL,
 CONSTRAINT [PK_TERMINALLER] PRIMARY KEY CLUSTERED 
(
	[TID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[GRUPLAR]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GRUPLAR](
	[GRPID] [int] IDENTITY(1,1) NOT NULL,
	[GRUP_ISMI] [nvarchar](50) NOT NULL,
	[BAS_NO] [int] NULL,
	[BIT_NO] [int] NULL,
	[DONGU] [bit] NULL,
	[MIN_HIZMET_SURESI] [time](0) NULL,
	[MAX_HIZMET_SURESI] [time](0) NULL,
	[AKTIF] [bit] NULL,
	[MESAI_BAS] [time](0) NULL,
	[MESAI_BIT] [time](0) NULL,
	[OGLE_BAS] [time](0) NULL,
	[OGLE_BIT] [time](0) NULL,
	[OGLEN_BILET_VER] [bit] NULL,
	[BILET_SINIRLA] [bit] NULL,
	[OO_MAX_BILET] [int] NULL,
	[OS_MAX_BILET] [int] NULL,
	[SIL] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[BeklemeSuresiTipi] [int] NULL,
	[Webrandevu] [bit] NULL,
 CONSTRAINT [PK_GRUPLAR] PRIMARY KEY CLUSTERED 
(
	[GRPID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MOLALAR]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MOLALAR](
	[MID] [int] IDENTITY(1,1) NOT NULL,
	[PID] [int] NULL,
	[BAS_TARIH] [datetime] NULL,
	[BIT_TARIH] [datetime] NULL,
	[MOLADA] [bit] NULL,
 CONSTRAINT [PK_MOLALAR] PRIMARY KEY CLUSTERED 
(
	[MID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SERVIS_HAREKET]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SERVIS_HAREKET](
	[SKID] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[SEBEP] [nvarchar](250) NULL,
	[KAP_TAR] [datetime] NULL,
	[AC_TAR] [datetime] NULL,
	[KAPALI] [bit] NULL,
 CONSTRAINT [PK_SERVIS_HAREKET] PRIMARY KEY CLUSTERED 
(
	[SKID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  View [dbo].[BI]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[BI] AS
select T.TID, ELTID, TERMINAL_AD, OTO_CAGRI OTO_SURE, DURUM, T.AKTIF, AKTIF_BID, SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR, 
TerminalTipi, DoubleClick SiralamaTipi, TGID, G.GRPID, CAGRI_ORAN, TRANSFER_ORAN, YARDIM_GRUBU, CAGRILAN, TRANSFER_CAGRILAN, ONCELIK, 
GRUP_ISMI, BAS_NO, BIT_NO, DONGU, MIN_HIZMET_SURESI, MAX_HIZMET_SURESI, G.AKTIF GAKTIF, MESAI_BAS, MESAI_BIT, OGLE_BAS, OGLE_BIT, OGLEN_BILET_VER, BILET_SINIRLA, OO_MAX_BILET,
OS_MAX_BILET, BeklemeSuresiTipi, P.PID, AD, SOYAD, ADRES, TEL, GSM, EMAIL, ACIKLAMA, CALISIYOR KAYIT_TARIHI,
KULLANICI_ADI, SIFRE, OTURUM_DURUM, BID, BILET_NO, SIS_TAR, ISLEM_BAS_TAR, ISLEM_BIT_TAR, TRANSFER,
TUR, OZEL_MUSTERI, BTNID, Zaman, MusteriNo, MusteriAdi, SKID, SEBEP, KAP_TAR, AC_TAR, KAPALI, MID, BAS_TARIH, BIT_TARIH, MOLADA
from BILETLER B
LEFT OUTER JOIN GRUPLAR G ON B.GRPID = G.GRPID
LEFT OUTER JOIN TERMINALLER T ON B.TID = T.TID
LEFT OUTER JOIN TERMINAL_GRUP TG ON T.TID = TG.TID AND B.GRPID = TG.GRPID
LEFT OUTER JOIN PERSONELLER P ON T.TID = P.TID
LEFT OUTER JOIN SERVIS_HAREKET SH ON T.TID = SH.TID
LEFT OUTER JOIN MOLALAR M ON P.PID = P.PID





GO
/****** Object:  View [dbo].[Detayli_Toplam]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[Detayli_Toplam] as
select TID, [Terminal No], [Terminal], count([Bilet No]) Bilet, count([Transfer]) TransferToplam, count([Fiktif]) Fiktif
from
(
select   TERMINALLER.ELTID AS [Terminal No], 
            TERMINALLER.TERMINAL_AD AS [Terminal], BILETLER.BILET_NO AS [Bilet No], 
            BILETLER.SIS_TAR AS [Alınma Tarihi], BILETLER.ISLEM_BAS_TAR AS [Çağrı Saati], 
            BILETLER.ISLEM_BIT_TAR AS [İşlem Bitiş Saati], 
            CASE BILETLER.TRANSFER WHEN 'false' THEN '' WHEN 'true' THEN 'Transfer' END AS [Transfer],  
            CASE BILETLER.OZEL_MUSTERI WHEN 'false' THEN '' WHEN 'true' THEN 'Fiktif Bilet' END AS [Fiktif], 
            BILETLER.GRPID AS [GRPID], TERMINALLER.TID AS [TID]  
			from
 --GRUPLAR RIGHT OUTER  ON GRUPLAR.GRPID = BILETLER.GRPID LEFT OUTER JOIN  
 TERMINALLER JOIN BILETLER ON TERMINALLER.TID = BILETLER.TID) h
 group by TID, [Terminal No], [Terminal]


GO
/****** Object:  View [dbo].[IslemYaptirmayanlar]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create view [dbo].[IslemYaptirmayanlar] as
select GRUPLAR.GRUP_ISMI AS [Grup/Servis], GRUPLAR.MIN_HIZMET_SURESI AS [Min. Hizmet Süresi], 
BILETLER.BILET_NO AS [Bilet No], BILETLER.SIS_TAR AS [Alınma Tarihi],
BILETLER.ISLEM_BAS_TAR AS [Çağrı Saati], BILETLER.ISLEM_BIT_TAR AS [İşlem Bitiş Saati],
CONVERT(varchar, DATEADD(s, DATEDIFF(second, CONVERT(time, BILETLER.SIS_TAR), BILETLER.ISLEM_BAS_TAR), 0), 108) AS [Bekleme Süresi], 
CONVERT(varchar, DATEADD(s, DATEDIFF(second, BILETLER.ISLEM_BAS_TAR, BILETLER.ISLEM_BIT_TAR), 0), 108) AS [İşlem Süresi],
GRUPLAR.GRPID 
from GRUPLAR INNER JOIN  BILETLER ON GRUPLAR.GRPID = BILETLER.GRPID 
GROUP BY GRUPLAR.GRPID, GRUPLAR.GRUP_ISMI, GRUPLAR.MIN_HIZMET_SURESI, BILETLER.BILET_NO, BILETLER.SIS_TAR, BILETLER.ISLEM_BAS_TAR, 
BILETLER.ISLEM_BIT_TAR 
HAVING      (DATEDIFF(second, CONVERT(time, BILETLER.ISLEM_BAS_TAR), BILETLER.ISLEM_BIT_TAR) < (DATEPART(second, GRUPLAR.MIN_HIZMET_SURESI) + DATEPART(minute, GRUPLAR.MIN_HIZMET_SURESI) * 60) + DATEPART(hour, GRUPLAR.MIN_HIZMET_SURESI) * 360)
                   


GO
/****** Object:  View [dbo].[RandevuBiletleri]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create view [dbo].[RandevuBiletleri] as
select BID, BILET_NO, G.GRUP_ISMI, ZAMAN
from BILETLER B
join GRUPLAR G ON B.GRPID = G.GRPID




GO
/****** Object:  Table [dbo].[ANKET]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ANKET](
	[SatirId] [int] IDENTITY(1,1) NOT NULL,
	[Secim] [int] NULL,
	[Tarih] [datetime] NULL,
	[TerminalId] [int] NULL,
 CONSTRAINT [PK_ANKET] PRIMARY KEY CLUSTERED 
(
	[SatirId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  View [dbo].[vAnket]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE view [dbo].[vAnket] as
select TERMINAL_AD TerminalAdi, TID, A.*,
case secim when 1 then 'Seçim 1'
when 2 then 'Seçim 2' when 3 then 'Seçim 3' end Secim2
from anket A
join TERMINALLER T ON A.TerminalId = T.ELTID




GO
/****** Object:  View [dbo].[vAnlikGrupDurumu2]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[vAnlikGrupDurumu2] as
SELECT GRUPLAR.GRPID, GRUPLAR.GRUP_ISMI,

	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, B.ISLEM_BAS_TAR, B.ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, B.ISLEM_BAS_TAR, B.ISLEM_BIT_TAR)), 0), 108) AS [T. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, CONVERT(time, B.SIS_TAR), B.ISLEM_BAS_TAR)), 0), 108) AS [O. Bekleme Süresi],
	 CONVERT(varchar, DATEADD(s, MAX(DATEDIFF(second, CONVERT(time, B.SIS_TAR), B.ISLEM_BAS_TAR)), 0), 108) AS [Max. Bekleme Süresi]


FROM   GRUPLAR AS GRUPLAR 
RIGHT OUTER JOIN BILETLER AS B ON GRUPLAR.GRPID = B.GRPID
--WHERE b.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
--AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
group by GRUPLAR.GRPID, GRUPLAR.GRUP_ISMI



GO
/****** Object:  View [dbo].[vAnlikRapor]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE view [dbo].[vAnlikRapor] as
	SELECT		B1.GRPID, ISNULL(GRUPLAR.GRUP_ISMI, '#Grup Kaydı Silinmiş#') AS [Grup/Servis], COUNT(B1.BID) AS [T. Bilet],
		(SELECT     COUNT(B3.BID) AS Expr1
                            FROM  GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B3 ON GRUPLAR.GRPID = B3.GRPID
                            WHERE (B3.TID > 0) AND (B3.GRPID = B1.GRPID) 
                            AND b3.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' ) AS [T. İşlem],
	
		(SELECT     COUNT(B4.BID) AS Expr1
                            FROM   GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B4 ON GRUPLAR.GRPID = B4.GRPID
                            WHERE	(B4.TID = 0) AND (B4.GRPID = B1.GRPID)
                            AND b4.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' ) AS [T. Bekleyen],
                            
		(SELECT     TOP (1) B2.BILET_NO AS Expr1
                            FROM	GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B2 ON GRUPLAR.GRPID = B2.GRPID
                            WHERE	(B2.GRPID = B1.GRPID)
							AND b2.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
                            ORDER BY B2.BID DESC) AS [Son Alınan Bilet],
                            
		(SELECT     TOP (1) B5.BILET_NO AS Expr1
                            FROM	GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B5 ON GRUPLAR.GRPID = B5.GRPID
                            WHERE	(B5.GRPID = B1.GRPID) AND (B5.TID > 0)
                            AND b5.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
                            ORDER BY B5.BID DESC) AS [Son İşlem],
                            
		(SELECT     TOP (1) B6.ISLEM_BAS_TAR AS Expr1
                            FROM	GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B6 ON GRUPLAR.GRPID = B6.GRPID
                            WHERE	(B6.GRPID = B1.GRPID) AND (B6.TID > 0)
                            AND b6.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
                            ORDER BY B6.BID DESC) AS [Son Çağrı Saati],
                            
	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [T. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, CONVERT(time, B1.SIS_TAR), B1.ISLEM_BAS_TAR)), 0), 108) AS [O. Bekleme Süresi],
	 CONVERT(varchar, DATEADD(s, MAX(DATEDIFF(second, CONVERT(time, B1.SIS_TAR), B1.ISLEM_BAS_TAR)), 0), 108) AS [Max. Bekleme Süresi]
                          
                         
                      
FROM         GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
                      BILETLER AS B1 ON GRUPLAR.GRPID = B1.GRPID
                      Where b1.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                        and DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
                      
GROUP BY GRUPLAR.GRUP_ISMI, B1.GRPID




GO
/****** Object:  View [dbo].[vanlikRaporTerminal]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create view [dbo].[vanlikRaporTerminal] as

	SELECT		T1.ELTID AS [Terminal No], T1.TERMINAL_AD AS [Terminal],  T1.TID, COUNT(B1.BID) AS [T. İşlem], 
				CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi], 
				CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [T. Çalışma Süresi],
        
			(SELECT     TOP (1) GRUPLAR.GRUP_ISMI
				FROM		BILETLER AS B2 INNER JOIN
							TERMINALLER AS T2 ON B2.TID = T2.TID INNER JOIN
                            GRUPLAR ON B2.GRPID = GRUPLAR.GRPID
				WHERE	(B2.TID = B1.TID)
						AND b2.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
				ORDER BY B2.BID DESC) AS [Son İşlem],
                
			(SELECT     TOP (1) B3.BILET_NO AS Expr1
				FROM		BILETLER AS B3 INNER JOIN
							TERMINALLER AS T3 ON B3.TID = T3.TID INNER JOIN
							GRUPLAR AS G3 ON B3.GRPID = G3.GRPID
				WHERE	(B3.TID = B1.TID)
						AND b3.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
				ORDER BY B3.BID DESC) AS [Son Çağrılan Bilet],
                
			(SELECT     TOP (1) B4.ISLEM_BAS_TAR AS Expr1
                FROM		BILETLER AS B4 INNER JOIN
							TERMINALLER AS T4 ON B4.TID = T4.TID INNER JOIN
                            GRUPLAR AS G4 ON B4.GRPID = G4.GRPID
				WHERE      (B4.TID = B1.TID)
						AND b4.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
                ORDER BY B4.BID DESC) AS [Son Çağrı Saati]

	FROM         BILETLER AS B1 LEFT JOIN
                 TERMINALLER AS T1 ON B1.TID = T1.TID INNER JOIN
                 GRUPLAR AS G1 ON B1.GRPID = G1.GRPID
                 
	Where		b1.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
					and DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
					AND b1.TID >0 

GROUP BY T1.ELTID, T1.TID, B1.TID, T1.TERMINAL_AD





GO
/****** Object:  View [dbo].[VGRUPLAR]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[VGRUPLAR] AS
SELECT * FROM
(
	select TGID, TID, GRPID, CAGRI_ORAN, '1' GRUP_TIPI, ONCELIK --			1 NORMAL
	from TERMINAL_GRUP
	where YARDIM_GRUBU = 0
	UNION ALL
	select TGID, TID, GRPID, TRANSFER_ORAN, '2' GRUP_TIPI, ONCELIK --		2 TRANSFER
	from TERMINAL_GRUP
	where YARDIM_GRUBU = 0
	--UNION ALL
	--select TGID, TID, GRPID, CAGRI_ORAN, '3' GRUP_TIPI, 999 ONCELIK --		3 YARDIM
	--from TERMINAL_GRUP
	--where YARDIM_GRUBU = 1
	--UNION ALL
	--select TGID, TID, GRPID, TRANSFER_ORAN, '4' GRUP_TIPI, 999 ONCELIK--	4 YARDIM TRANSFER
	--from TERMINAL_GRUP
	--where YARDIM_GRUBU = 1
) G


GO
/****** Object:  View [dbo].[vMoladakiler]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE view [dbo].[vMoladakiler] as
select TERMINALLER.TID,
MOLALAR.BAS_TARIH AS [Mola Başlangıç], 
PERSONELLER.AD + ' ' + PERSONELLER.SOYAD AS Personel, 
TERMINALLER.ELTID AS [Terminal No],  TERMINALLER.TERMINAL_AD AS [Terminal], 
MOLALAR.PID 
from MOLALAR INNER JOIN PERSONELLER ON MOLALAR.PID = PERSONELLER.PID  INNER JOIN TERMINALLER ON PERSONELLER.TID = TERMINALLER.TID
where (TERMINALLER.DURUM = 4) AND (MOLALAR.BAS_TARIH > DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00')  AND (MOLALAR.MOLADA = 'True')



GO
/****** Object:  View [dbo].[vMolalar]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE view [dbo].[vMolalar] as
select TERMINALLER.TID, PERSONELLER.AD + ' ' + PERSONELLER.SOYAD AS Personel,
      MOLALAR.BAS_TARIH AS [Mola Başlangıç], MOLALAR.BIT_TARIH AS [Mola Bitiş], 
      TERMINALLER.ELTID AS [Terminal No],  TERMINALLER.TERMINAL_AD AS [Terminal], 
      CONVERT(varchar, DATEADD(s, DATEDIFF(second, MOLALAR.BAS_TARIH, MOLALAR.BIT_TARIH), 0), 108) AS [Mola Süresi],  
      MOLALAR.PID 
from MOLALAR LEFT OUTER JOIN PERSONELLER ON MOLALAR.PID = PERSONELLER.PID CROSS JOIN TERMINALLER   



GO
/****** Object:  View [dbo].[vServisDisi]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE view [dbo].[vServisDisi] as
select SKID,
PERSONELLER.AD + ' ' + PERSONELLER.SOYAD AS Personel,
      TERMINALLER.ELTID AS [Terminal No],  TERMINALLER.TERMINAL_AD AS [Terminal], 
      SERVIS_HAREKET.SEBEP AS [Kapatma Sebebi], SERVIS_HAREKET.KAP_TAR AS [Kapatma Tarihi], 
      SERVIS_HAREKET.AC_TAR AS [Açma Tarihi], 
      CONVERT(varchar, DATEADD(s, DATEDIFF(second, SERVIS_HAREKET.KAP_TAR, SERVIS_HAREKET.AC_TAR), 0), 108) AS [Kapalı Süre],  
      SERVIS_HAREKET.TID 
from PERSONELLER INNER JOIN TERMINALLER ON PERSONELLER.TID = TERMINALLER.TID RIGHT OUTER JOIN SERVIS_HAREKET ON TERMINALLER.TID = SERVIS_HAREKET.TID
      



GO
/****** Object:  View [dbo].[vServisDisilar]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE view [dbo].[vServisDisilar] as
select SKID, SERVIS_HAREKET.TID, PERSONELLER.AD + ' ' + PERSONELLER.SOYAD AS Personel, 
TERMINALLER.ELTID AS [Terminal No],  TERMINALLER.TERMINAL_AD AS [Terminal], 
SERVIS_HAREKET.KAP_TAR AS [Kapatma Tarihi], 
SERVIS_HAREKET.SEBEP AS [Kapatma Sebebi] 
from SERVIS_HAREKET INNER JOIN TERMINALLER ON SERVIS_HAREKET.TID = TERMINALLER.TID 
INNER JOIN PERSONELLER ON TERMINALLER.TID = PERSONELLER.TID
where (SERVIS_HAREKET.KAPALI = 'True') AND (TERMINALLER.DURUM = 1) AND (SERVIS_HAREKET.KAP_TAR > DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00')
     



GO
/****** Object:  View [dbo].[vSure]    Script Date: 20.05.2018 03:52:38 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE view [dbo].[vSure] as
select BILETLER.BID, TERMINALLER.TERMINAL_AD AS Terminal, TERMINALLER.ELTID AS [Terminal No], 
PERSONELLER.AD + ' ' + PERSONELLER.SOYAD AS Personel, 
GRUPLAR.GRUP_ISMI AS [Grup/Servis],  BILETLER.BILET_NO AS [Bilet No], 
BILETLER.SIS_TAR AS [Alınma Tarihi], BILETLER.ISLEM_BAS_TAR AS [Çağrı Saati], 
BILETLER.ISLEM_BIT_TAR AS [İşlem Bitiş Saati], 
(CASE BILETLER.TRANSFER WHEN 'false' THEN '' WHEN 'true' THEN 'Transfer' END) AS [Transfer],  
CASE BILETLER.OZEL_MUSTERI WHEN 'false' THEN '' WHEN 'true' THEN 'Fiktif Bilet' END AS [Fiktif], 
BILETLER.GRPID AS [GRPID], BILETLER.TID AS [TID]  
from BILETLER LEFT OUTER JOIN TERMINALLER ON BILETLER.TID = TERMINALLER.TID 
LEFT OUTER JOIN  PERSONELLER ON TERMINALLER.TID = PERSONELLER.TID 
LEFT OUTER JOIN  GRUPLAR ON BILETLER.GRPID = GRUPLAR.GRPID
     



GO
/****** Object:  Table [dbo].[T_DURUM_MASTER]    Script Date: 20.05.2018 03:52:38 ******/
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
/****** Object:  View [dbo].[vTerminalDurumlari]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create view [dbo].[vTerminalDurumlari] as
select TERMINALLER.ELTID AS [Terminal No],  TERMINALLER.TERMINAL_AD AS [Terminal], 
PERSONELLER.AD + ' ' + PERSONELLER.SOYAD AS Personel, 
T_DURUM_MASTER.DURUM AS [Durum], TERMINALLER.AKTIF_BID AS [İşlem Yapılan Bilet], 
GRUPLAR.GRUP_ISMI AS [İşlem Yapılan Grup/Servis], 
TERMINALLER.TID, TERMINALLER.DURUM AS [TD]
from TERMINALLER LEFT OUTER JOIN PERSONELLER ON TERMINALLER.TID = PERSONELLER.TID 
INNER JOIN T_DURUM_MASTER ON TERMINALLER.DURUM = T_DURUM_MASTER.DID LEFT OUTER JOIN GRUPLAR ON TERMINALLER.SON_CAGRILAN_GRUP = GRUPLAR.GRPID
where PERSONELLER.SIL='FALSE'
      


GO
/****** Object:  View [dbo].[vAnlikGrupDurumuOrt]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[vAnlikGrupDurumuOrt] as
SELECT BOLGEADI, GRPID, GRUP_ISMI,

	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, ISLEM_BAS_TAR, ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, ISLEM_BAS_TAR, ISLEM_BIT_TAR)), 0), 108) AS [T. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, CONVERT(time, SIS_TAR), ISLEM_BAS_TAR)), 0), 108) AS [O. Bekleme Süresi],
	 CONVERT(varchar, DATEADD(s, MAX(DATEDIFF(second, CONVERT(time, SIS_TAR), ISLEM_BAS_TAR)), 0), 108) AS [Max. Bekleme Süresi]


FROM OmesBI
--WHERE b.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
--AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
group by BOLGEADI, GRPID, GRUP_ISMI




GO
/****** Object:  View [dbo].[vPersonelKapaliServis]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[vPersonelKapaliServis] AS
select DISTINCT BOLGEADI, AD + ' ' + SOYAD PERSONEL, KAP_TAR, AC_TAR, DATEDIFF(MINUTE, KAP_TAR, AC_TAR) Sure
from omesBI

WHERE SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
AND KAPALI = 1



GO
/****** Object:  View [dbo].[vPersonelMesaiBaslama]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE VIEW [dbo].[vPersonelMesaiBaslama] as
select BOLGEADI, AD + ' ' + SOYAD PERSONEL, MIN(ISLEM_BAS_TAR) BASLAMA_SAATI, 'Meşgul' Durum, MAX(ISLEM_BAS_TAR) SonIslemZamani
from omesBI

WHERE SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 


GROUP BY BOLGEADI, AD, SOYAD





GO
/****** Object:  View [dbo].[vPersonelMola]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE VIEW [dbo].[vPersonelMola] AS
select DISTINCT BOLGEADI, AD + ' ' + SOYAD PERSONEL, BIT_TARIH, BAS_TARIH, DATEDIFF(MINUTE, BIT_TARIH, BAS_TARIH) Sure
from omesBI

WHERE SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
AND KAPALI = 1






GO
/****** Object:  View [dbo].[vTerminalGrupListesi]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vTerminalGrupListesi] AS

select DISTINCT BOLGEADI, TERMINAL_AD, GRUP_ISMI, BID, BILET_NO,  ISLEM_BAS_TAR, ISLEM_BIT_TAR, DATEDIFF(MINUTE, ISLEM_BAS_TAR, ISLEM_BIT_TAR) ISLEM_SURESI
from omesBI

--WHERE SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
--AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
--AND KAPALI = 1





GO
/****** Object:  View [dbo].[vTerminalListesi]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[vTerminalListesi]
AS
SELECT        BOLGEADI, TERMINAL_AD, COUNT(BID) AS ToplamIslemAdedi, MAX(BILET_NO) AS SonBiletNo, (CASE WHEN (AVG(ISLEM_SURESI) > 0) THEN AVG(ISLEM_SURESI) ELSE (AVG(ISLEM_SURESI) * (- 1)) END) 
                         AS OrtIslemSuresi, (CASE WHEN (SUM(ISLEM_SURESI) > 0) THEN SUM(ISLEM_SURESI) ELSE (SUM(ISLEM_SURESI) * (- 1)) END) AS ToplamCalismaSuresi
FROM            (SELECT DISTINCT BOLGEADI, TERMINAL_AD, BID, BILET_NO, ISLEM_BAS_TAR, ISLEM_BIT_TAR, DATEDIFF(MINUTE, ISLEM_BAS_TAR, ISLEM_BIT_TAR) AS ISLEM_SURESI
                          FROM            dbo.OmesBI) AS g
GROUP BY BOLGEADI, TERMINAL_AD


GO
/****** Object:  View [dbo].[vwUsers]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create view [dbo].[vwUsers] as
select
u.Id UserId, UserName, r.Id RoleId, Name
from aspnetUsers u
join aspnetUserRoles ur on u.Id = ur.UserId
join aspnetRoles r on ur.RoleId = r.Id



GO
/****** Object:  Table [dbo].[_SISTEM_CONFIG]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[_SISTEM_CONFIG](
	[SERVER_IP] [nvarchar](15) NULL,
	[FIRMA_ISMI] [nvarchar](50) NULL,
	[KioskId] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ANATABLO_YON]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ANATABLO_YON](
	[YID] [int] IDENTITY(1,1) NOT NULL,
	[ATID] [int] NOT NULL,
	[TID] [int] NOT NULL,
	[YON] [smallint] NOT NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[Port] [int] NULL,
 CONSTRAINT [PK_ANATABLO_YON] PRIMARY KEY CLUSTERED 
(
	[YID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ANATABLOLAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
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
GO
/****** Object:  Table [dbo].[BILET_AYAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BILET_AYAR](
	[KID] [int] NOT NULL,
	[BILET_BASLIK_S1] [nvarchar](30) NULL,
	[BILET_BASLIK_S2] [nvarchar](30) NULL,
	[BILET_BASLIK_S3] [nvarchar](30) NULL,
	[BILET_BASLIK_S4] [nvarchar](30) NULL,
	[ETIKET_BEKLEYEN] [nvarchar](30) NULL,
	[ETIKET_KARSILAMA1] [nvarchar](30) NULL,
	[ETIKET_KARSILAMA2] [nvarchar](30) NULL,
	[FONT_BEKLEYEN] [nvarchar](30) NULL,
	[FONT_KARSILAMA] [nvarchar](30) NULL,
	[FONT_BASLIK] [nvarchar](30) NULL,
	[FONT_GRUP] [nvarchar](30) NULL,
	[FONT_TARIH] [nvarchar](30) NULL,
	[FONT_SIRANO] [nvarchar](30) NULL,
	[FONT2_SIRANO] [nvarchar](30) NULL,
	[PUNTO_BEKLEYEN] [smallint] NULL,
	[PUNTO_KARSILAMA] [smallint] NULL,
	[PUNTO_BASLIK] [smallint] NULL,
	[PUNTO_GRUP] [smallint] NULL,
	[PUNTO_TARIH] [smallint] NULL,
	[PUNTO_SIRANO] [smallint] NULL,
	[YAZ_BEKLEYEN] [bit] NULL,
	[YAZ_KARSILAMA] [bit] NULL,
	[YAZ_BASLIK] [bit] NULL,
	[YAZ_GRUP] [bit] NULL,
	[YAZ_TARIH] [bit] NULL,
	[YAZ_SIRANO] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[OrtalamaBeklemeSuresiYaz] [bit] NULL,
 CONSTRAINT [PK_BILET_AYAR] PRIMARY KEY CLUSTERED 
(
	[KID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BILET_MAKINELERI]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
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
/****** Object:  Table [dbo].[BUTONLAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BUTONLAR](
	[BM_ADRES] [int] NOT NULL,
	[BTNID] [int] NOT NULL,
	[GRP_ID] [int] NULL,
	[ANA_BTNID] [int] NULL,
	[BTN_EKRAN] [nvarchar](250) NULL,
	[BTN_BILET_S1] [nvarchar](50) NULL,
	[BTN_BILET_S2] [nvarchar](50) NULL,
	[BTN_BILET_S3] [nvarchar](50) NULL,
	[BTN_BILET_S4] [nvarchar](50) NULL,
	[MAKS_BILET] [smallint] NULL,
	[BILET_KOPYA] [smallint] NULL,
	[YUKSEKLIK] [smallint] NULL,
	[GENISLIK] [smallint] NULL,
	[RENK] [int] NULL,
	[YAZI_RENGI] [int] NULL,
	[RESIM] [image] NULL,
	[RESIM_YON] [int] NULL,
	[RESIM_AD] [nvarchar](20) NULL,
	[ESKI_RESIM_AD] [nvarchar](20) NULL,
	[ACIKLAMA] [nvarchar](250) NULL,
	[AKTIF] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[RandevuButonuMu] [bit] NULL,
	[GRP_ID2] [int] NULL,
	[GRP1_ORAN] [int] NULL,
	[GRP2_ORAN] [int] NULL,
	[GRP_ID3] [int] NULL,
	[GRP3_ORAN] [int] NULL,
	[GRP_ID4] [int] NULL,
	[GRP4_ORAN] [int] NULL,
	[FONT] [nvarchar](40) NULL,
	[PUNTO] [smallint] NULL,
 CONSTRAINT [PK_BUTONLAR] PRIMARY KEY CLUSTERED 
(
	[BTNID] ASC,
	[BM_ADRES] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[FONTLAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[FONTLAR](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[FONT] [nvarchar](100) NULL,
 CONSTRAINT [PK_FONTLAR] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Havuz]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Havuz](
	[SatirId] [int] IDENTITY(1,1) NOT NULL,
	[BID] [int] NULL,
	[TID] [int] NULL,
	[Tarih] [datetime] NULL,
 CONSTRAINT [PK_Havuz] PRIMARY KEY CLUSTERED 
(
	[SatirId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[KIOSK_AYAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[KIOSK_AYAR](
	[KID] [int] NOT NULL,
	[BASLIK] [nvarchar](200) NULL,
	[ALT_BASLIK] [nvarchar](200) NULL,
	[MESAJ_OGLE] [nvarchar](50) NULL,
	[MESAJ_SISTEM_KAPALI] [nvarchar](50) NULL,
	[MESAJ_SERVIS_KAPALI] [nvarchar](50) NULL,
	[SOL_BTN_ADET] [smallint] NULL,
	[SAG_BTN_ADET] [smallint] NULL,
	[SOL_PADDING] [smallint] NULL,
	[SAG_PADDING] [smallint] NULL,
	[FONT] [nvarchar](40) NULL,
	[PUNTO] [smallint] NULL,
	[BTN_FONT] [nvarchar](40) NULL,
	[BTN_PUNTO] [smallint] NULL,
	[GECIKME] [int] NULL,
	[YAZI_RENGI] [int] NULL,
	[RENK] [int] NULL,
	[RESIM] [image] NULL,
	[RESIM_AD] [nvarchar](20) NULL,
	[ESKI_RESIM_AD] [nvarchar](20) NULL,
	[RESIM_YON] [int] NULL,
	[BASLIK_KAY] [bit] NULL,
	[ALT_BASLIK_KAY] [bit] NULL,
	[YON_BASLIK] [bit] NULL,
	[YON_ALT_BASLIK] [bit] NULL,
	[HIZ_BASLIK] [int] NULL,
	[HIZ_ALT_BASLIK] [int] NULL,
	[AKTIF] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
	[TagPreviewHeight] [int] NULL,
	[TagPreviewWidth] [int] NULL,
	[TagPreviewTimerInterval] [int] NULL,
	[TagPreviewZoom] [numeric](18, 4) NULL,
	[TotalTag] [int] NULL,
	[MaxTotalTag] [int] NULL,
	[TagOverFlowPerId] [int] NULL,
	[TagOverFlowMessage] [nvarchar](500) NULL,
	[RandevuButonMetni] [varchar](150) NULL,
	[AltButonSuresi] [int] NULL,
	[WebdenRandevu] [bit] NULL,
	[BeklemeSuresiMetni] [nvarchar](500) NULL,
	[EtiketSifirlamasifresi] [int] NULL,
	[BarkodlaEtiket] [bit] NULL,
 CONSTRAINT [PK_KIOSK_AYAR] PRIMARY KEY CLUSTERED 
(
	[KID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[KUYRUK]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[KUYRUK](
	[BID] [int] NOT NULL,
	[GRPID] [int] NULL,
	[BILET_NO] [smallint] NULL,
	[TRANSFER] [bit] NULL,
	[OZEL_MUSTERI] [bit] NULL,
	[S_YF1] [nvarchar](50) NULL,
	[S_YF2] [nvarchar](50) NULL,
	[S_YF3] [nvarchar](50) NULL,
	[I_YF1] [int] NULL,
	[I_YF2] [int] NULL,
	[I_YF3] [int] NULL,
	[B_YF] [bit] NULL,
 CONSTRAINT [PK_KUYRUK] PRIMARY KEY CLUSTERED 
(
	[BID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[OTURUMLAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[OTURUMLAR](
	[OID] [int] IDENTITY(1,1) NOT NULL,
	[PID] [int] NOT NULL,
	[OTURUM_BAS_TARIH] [datetime] NULL,
	[OTURUM_BIT_TARIH] [datetime] NULL,
 CONSTRAINT [PK_OTURUMLAR] PRIMARY KEY CLUSTERED 
(
	[OID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[RANDEVU_AYAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[RANDEVU_AYAR](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[sistemDurumu] [bit] NULL,
	[randevuSecimi] [tinyint] NULL,
	[minimumTarihSayisi] [tinyint] NULL,
	[minimumTarihTuru] [nvarchar](1) NULL,
	[maksimumTarihSayisi] [tinyint] NULL,
	[maksimumTarihTuru] [nvarchar](1) NULL,
	[takvimAnimasyon] [nvarchar](20) NULL,
	[animasyonHizi] [nvarchar](10) NULL,
	[biletSinirla] [bit] NULL,
	[biletSinirSayisi] [tinyint] NULL,
 CONSTRAINT [PK_Table_1_1] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[RANDEVU_KAYDET]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[RANDEVU_KAYDET](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[TID] [int] NULL,
	[GRPID] [int] NULL,
	[musteriAd] [nvarchar](100) NULL,
	[musteriSoyad] [nvarchar](100) NULL,
	[musteriTc] [nvarchar](11) NULL,
	[musteriTel] [nvarchar](20) NULL,
	[randevuTarihi] [date] NULL,
	[randevuSaati] [time](7) NULL,
	[biletNo] [nvarchar](10) NULL,
	[randevuKayitTarihi] [datetime] NULL,
	[randevuTalepSayisi] [tinyint] NULL,
 CONSTRAINT [PK_RANDEVU_KAYDET] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[RANDEVU_TATIL_AYAR]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[RANDEVU_TATIL_AYAR](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tatilTarihi] [date] NULL,
	[tatilPeriyot] [tinyint] NULL,
	[tatilAciklama] [nvarchar](150) NULL,
	[aktif] [bit] NULL,
 CONSTRAINT [PK_RANDEVU_TATIL_AYAR] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SISTEM_CONFIG]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SISTEM_CONFIG](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[SERVER_IP] [nvarchar](15) NULL,
	[FIRMA_ISMI] [nvarchar](50) NULL,
	[KioskId] [int] NULL,
 CONSTRAINT [PK_Table_1] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SYS_MESAJ]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SYS_MESAJ](
	[SMMID] [int] NOT NULL,
	[MESAJ] [nvarchar](30) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SYS_MESAJ_MASTER]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SYS_MESAJ_MASTER](
	[SMMID] [int] IDENTITY(1,1) NOT NULL,
	[MESAJ_TIP] [nvarchar](20) NULL,
 CONSTRAINT [PK_SYS_MESAJ_MASTER] PRIMARY KEY CLUSTERED 
(
	[SMMID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TERMINAL_BIRIM]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TERMINAL_BIRIM](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[BirimNo] [int] NULL,
	[TerminalID] [int] NULL,
 CONSTRAINT [PK_TERMINAL_BIRIM] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TERMINAL_KUYRUK]    Script Date: 20.05.2018 03:52:39 ******/
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
ALTER TABLE [dbo].[BILET_MAKINELERI] ADD  CONSTRAINT [DF_BILET_MAKINELERI_SIL]  DEFAULT ((0)) FOR [SIL]
GO
ALTER TABLE [dbo].[BILETLER] ADD  CONSTRAINT [DF_BILETLER_TUR]  DEFAULT ((1)) FOR [TUR]
GO
ALTER TABLE [dbo].[BILETLER] ADD  CONSTRAINT [DF_BILETLER_OZEL_MUSTERI]  DEFAULT ((0)) FOR [OZEL_MUSTERI]
GO
ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_ANA_BTNID]  DEFAULT ((0)) FOR [ANA_BTNID]
GO
ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_BILET_KOPYA]  DEFAULT ((1)) FOR [BILET_KOPYA]
GO
ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_RENK]  DEFAULT ((0)) FOR [RENK]
GO
ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_YAZI_RENGİ]  DEFAULT ((0)) FOR [YAZI_RENGI]
GO
ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_RESIM_YON]  DEFAULT ((32)) FOR [RESIM_YON]
GO
ALTER TABLE [dbo].[BUTONLAR] ADD  CONSTRAINT [DF_BUTONLAR_AKTIF]  DEFAULT ((1)) FOR [AKTIF]
GO
ALTER TABLE [dbo].[GRUPLAR] ADD  CONSTRAINT [DF_GRUPLAR_SIL]  DEFAULT ((0)) FOR [SIL]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YAZI_RENGI]  DEFAULT ((0)) FOR [YAZI_RENGI]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_RENK]  DEFAULT ((0)) FOR [RENK]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_BASLIK_KAY]  DEFAULT ((1)) FOR [BASLIK_KAY]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_ALT_BASLIK_KAY]  DEFAULT ((1)) FOR [ALT_BASLIK_KAY]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YON_BASLIK]  DEFAULT ((0)) FOR [YON_BASLIK]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_YON_ALT_BASLIK]  DEFAULT ((0)) FOR [YON_ALT_BASLIK]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_HIZ_BASLIK]  DEFAULT ((1)) FOR [HIZ_BASLIK]
GO
ALTER TABLE [dbo].[KIOSK_AYAR] ADD  CONSTRAINT [DF_KIOSK_AYAR_HIZ_ALT_BASLIK]  DEFAULT ((1)) FOR [HIZ_ALT_BASLIK]
GO
ALTER TABLE [dbo].[KUYRUK] ADD  CONSTRAINT [DF_KUYRUK_TRANSFER]  DEFAULT ((0)) FOR [TRANSFER]
GO
ALTER TABLE [dbo].[KUYRUK] ADD  CONSTRAINT [DF_KUYRUK_OZEL_MUSTERI]  DEFAULT ((0)) FOR [OZEL_MUSTERI]
GO
ALTER TABLE [dbo].[MOLALAR] ADD  CONSTRAINT [DF_MOLALAR_MOLADA]  DEFAULT ((0)) FOR [MOLADA]
GO
ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_CALISIYOR]  DEFAULT ((1)) FOR [CALISIYOR]
GO
ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_KAYITTARIHI]  DEFAULT (getdate()) FOR [KAYIT_TARIHI]
GO
ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_OTURUM_DURUM]  DEFAULT ((0)) FOR [OTURUM_DURUM]
GO
ALTER TABLE [dbo].[PERSONELLER] ADD  CONSTRAINT [DF_PERSONELLER_SIL]  DEFAULT ((0)) FOR [SIL]
GO
ALTER TABLE [dbo].[SERVIS_HAREKET] ADD  CONSTRAINT [DF_SERVIS_HAREKET_KAPALI]  DEFAULT ((0)) FOR [KAPALI]
GO
ALTER TABLE [dbo].[TERMINAL_GRUP] ADD  CONSTRAINT [DF_TERMINAL_GRUP_CAGRILAN]  DEFAULT ((0)) FOR [CAGRILAN]
GO
ALTER TABLE [dbo].[TERMINAL_GRUP] ADD  CONSTRAINT [DF_TERMINAL_GRUP_TRANSFER_CAGRILAN]  DEFAULT ((0)) FOR [TRANSFER_CAGRILAN]
GO
ALTER TABLE [dbo].[TERMINAL_GRUP] ADD  CONSTRAINT [DF_TERMINAL_GRUP_ONCELIK]  DEFAULT ((0)) FOR [ONCELIK]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_OTO_CAGRI]  DEFAULT ((0)) FOR [OTO_CAGRI]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_DURUM]  DEFAULT ((6)) FOR [DURUM]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_AKTIF]  DEFAULT ((1)) FOR [AKTIF]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SON_CAGRILAN_BID]  DEFAULT ((0)) FOR [AKTIF_BID]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SON_CAGRILAN_GRUP]  DEFAULT ((0)) FOR [SON_CAGRILAN_GRUP]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SON_BILET_TUR]  DEFAULT ((0)) FOR [SON_CAGRILAN_TUR]
GO
ALTER TABLE [dbo].[TERMINALLER] ADD  CONSTRAINT [DF_TERMINALLER_SIL]  DEFAULT ((0)) FOR [SIL]
GO
/****** Object:  StoredProcedure [dbo].[anlikRapor]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Uğur Aldanmaz>
-- Create date: <25/11/2011>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[anlikRapor]
	-- Add the parameters for the stored procedure here
	--<@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	--<@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
	
	--StartDate = DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE()))
	
AS
BEGIN
	--declare @StartDate datetime,
	--declare	@FinishDate datetime
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	--SET @StartDate =  DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
		--SET @StartDate =  DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
	SET NOCOUNT ON;
	
    -- Insert statements for procedure here
	SELECT		B1.GRPID, ISNULL(GRUPLAR.GRUP_ISMI, '#Grup Kaydı Silinmiş#') AS [Grup/Servis], COUNT(B1.BID) AS [T. Bilet],
		(SELECT     COUNT(B3.BID) AS Expr1
                            FROM  GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B3 ON GRUPLAR.GRPID = B3.GRPID
                            WHERE (B3.TID > 0) AND (B3.GRPID = B1.GRPID) 
                            AND b3.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' ) AS [T. İşlem],
	
		(SELECT     COUNT(B4.BID) AS Expr1
                            FROM   GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B4 ON GRUPLAR.GRPID = B4.GRPID
                            WHERE	(B4.TID = 0) AND (B4.GRPID = B1.GRPID)
                            AND b4.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' ) AS [T. Bekleyen],
                            
		(SELECT     TOP (1) B2.BILET_NO AS Expr1
                            FROM	GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B2 ON GRUPLAR.GRPID = B2.GRPID
                            WHERE	(B2.GRPID = B1.GRPID)
							AND b2.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
                            ORDER BY B2.BID DESC) AS [Son Alınan Bilet],
                            
		(SELECT     TOP (1) B5.BILET_NO AS Expr1
                            FROM	GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B5 ON GRUPLAR.GRPID = B5.GRPID
                            WHERE	(B5.GRPID = B1.GRPID) AND (B5.TID > 0)
                            AND b5.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
                            ORDER BY B5.BID DESC) AS [Son İşlem],
                            
		(SELECT     TOP (1) B6.ISLEM_BAS_TAR AS Expr1
                            FROM	GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
										BILETLER AS B6 ON GRUPLAR.GRPID = B6.GRPID
                            WHERE	(B6.GRPID = B1.GRPID) AND (B6.TID > 0)
                            AND b6.SIS_TAR
                            between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                            AND		DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59'
                            ORDER BY B6.BID DESC) AS [Son Çağrı Saati],
                            
	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [T. İşlem Süresi],
	 CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, CONVERT(time, B1.SIS_TAR), B1.ISLEM_BAS_TAR)), 0), 108) AS [O. Bekleme Süresi],
	 CONVERT(varchar, DATEADD(s, MAX(DATEDIFF(second, CONVERT(time, B1.SIS_TAR), B1.ISLEM_BAS_TAR)), 0), 108) AS [Max. Bekleme Süresi]
                          
                         
                      
FROM         GRUPLAR AS GRUPLAR RIGHT OUTER JOIN
                      BILETLER AS B1 ON GRUPLAR.GRPID = B1.GRPID
                      Where b1.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
                        and DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
                      
GROUP BY GRUPLAR.GRUP_ISMI, B1.GRPID
END




GO
/****** Object:  StoredProcedure [dbo].[anlikRaporTerminal]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Uğur Aldanmaz>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[anlikRaporTerminal]
	-- Add the parameters for the stored procedure here
	--<@Param1, sysname, @p1> <Datatype_For_Param1, , int> = <Default_Value_For_Param1, , 0>, 
	--<@Param2, sysname, @p2> <Datatype_For_Param2, , int> = <Default_Value_For_Param2, , 0>
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT		T1.ELTID AS [Terminal No], T1.TERMINAL_AD AS [Terminal],  T1.TID, COUNT(B1.BID) AS [T. İşlem], 
				CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi], 
				CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [T. Çalışma Süresi],
        
			(SELECT     TOP (1) GRUPLAR.GRUP_ISMI
				FROM		BILETLER AS B2 INNER JOIN
							TERMINALLER AS T2 ON B2.TID = T2.TID INNER JOIN
                            GRUPLAR ON B2.GRPID = GRUPLAR.GRPID
				WHERE	(B2.TID = B1.TID)
						AND b2.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
				ORDER BY B2.BID DESC) AS [Son İşlem],
                
			(SELECT     TOP (1) B3.BILET_NO AS Expr1
				FROM		BILETLER AS B3 INNER JOIN
							TERMINALLER AS T3 ON B3.TID = T3.TID INNER JOIN
							GRUPLAR AS G3 ON B3.GRPID = G3.GRPID
				WHERE	(B3.TID = B1.TID)
						AND b3.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
				ORDER BY B3.BID DESC) AS [Son Çağrılan Bilet],
                
			(SELECT     TOP (1) B4.ISLEM_BAS_TAR AS Expr1
                FROM		BILETLER AS B4 INNER JOIN
							TERMINALLER AS T4 ON B4.TID = T4.TID INNER JOIN
                            GRUPLAR AS G4 ON B4.GRPID = G4.GRPID
				WHERE      (B4.TID = B1.TID)
						AND b4.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
                ORDER BY B4.BID DESC) AS [Son Çağrı Saati]

	FROM         BILETLER AS B1 LEFT JOIN
                 TERMINALLER AS T1 ON B1.TID = T1.TID INNER JOIN
                 GRUPLAR AS G1 ON B1.GRPID = G1.GRPID
                 
	Where		b1.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
					and DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
					AND b1.TID >0 

GROUP BY T1.ELTID, T1.TID, B1.TID, T1.TERMINAL_AD

END




GO
/****** Object:  StoredProcedure [dbo].[BiletInsert]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[BiletInsert]
       -- Add the parameters for the stored procedure here
@TID int
           ,@GRPID int
           ,@BILET_NO smallint
           ,@SIS_TAR datetime
           --,@ISLEM_BAS_TAR time(0)
           --,@ISLEM_BIT_TAR time(0)
           ,@TRANSFER bit
           ,@TUR smallint
           ,@OZEL_MUSTERI bit
           ,@BTNID int
           --,@S_YF1 nvarchar(50)
           --,@S_YF2 nvarchar(50)
           --,@S_YF3 nvarchar(50)
           --,@I_YF1 int
           --,@I_YF2 int
           --,@I_YF3 int
           --,@B_YF bit
           --,@Zaman datetime
           ,@MusteriNo varchar(50)
           ,@MusteriAdi varchar(150)
AS
BEGIN
       -- SET NOCOUNT ON added to prevent extra result sets from
       -- interfering with SELECT statements.
       SET NOCOUNT ON;
 
    -- Insert statements for procedure here
INSERT INTO [dbo].[BILETLER]
           ([TID]
           ,[GRPID]
           ,[BILET_NO]
           ,[SIS_TAR]
           ,[TRANSFER]
           ,[TUR]
           ,[OZEL_MUSTERI]
           ,[BTNID]
           --,[S_YF1]
           --,[S_YF2]
           --,[S_YF3]
           --,[I_YF1]
           --,[I_YF2]
           --,[I_YF3]
           --,[B_YF]
           --,[Zaman]
           ,[MusteriNo]
           ,[MusteriAdi])
     VALUES
           (@TID
           ,@GRPID
           ,@BILET_NO
           ,@SIS_TAR
           --,@ISLEM_BAS_TAR
           --,@ISLEM_BIT_TAR
           ,@TRANSFER
           ,@TUR
           ,@OZEL_MUSTERI
           ,@BTNID
           --,@S_YF1
           --,@S_YF2
           --,@S_YF3
           --,@I_YF1
           --,@I_YF2
           --,@I_YF3
           --,@B_YF
           --,@Zaman
           ,@MusteriNo
                ,@MusteriAdi)
END
GO
/****** Object:  StoredProcedure [dbo].[GetKesilmisBilet]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[GetKesilmisBilet]
       -- Add the parameters for the stored procedure here
@buttonId int,
@vTC nvarchar(50)
AS
BEGIN
       -- SET NOCOUNT ON added to prevent extra result sets from
       -- interfering with SELECT statements.
       SET NOCOUNT ON;
 
    -- Insert statements for procedure here
       SELECT * FROM [dbo].[BILETLER] B
       Where B.MusteriNo = @vTC and B.[GRPID] = @buttonId AND CONVERT(date,B.[SIS_TAR]) = CONVERT(date, getdate())
END
 
GO
/****** Object:  StoredProcedure [dbo].[sp_AnlikMolaTerminalPersonel]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_AnlikMolaTerminalPersonel]
       -- Add the parameters for the stored procedure here
@PID int
AS
BEGIN
       -- SET NOCOUNT ON added to prevent extra result sets from
       -- interfering with SELECT statements.
       SET NOCOUNT ON;
DECLARE  @vSure datetime
     -- Insert statements for procedure here
SELECT  --      dbo.TERMINALLER.TID,
dbo.MOLALAR.BAS_TARIH AS [Mola Başlangıç], dbo.PERSONELLER.AD + ' ' + dbo.PERSONELLER.SOYAD AS Personel
--,dbo.TERMINALLER.ELTID AS [Terminal No], dbo.TERMINALLER.TERMINAL_AD AS Terminal, dbo.MOLALAR.PID
,      (convert(nvarchar(5),DATEDIFF(HOUR,GETDATE() , dbo.MOLALAR.BAS_TARIH),120)       + ':'+
       convert(nvarchar(5),DATEDIFF(MINUTE,GETDATE() , dbo.MOLALAR.BAS_TARIH),120)      + ':'+
       convert(nvarchar(5),DATEDIFF(SECOND,GETDATE() , dbo.MOLALAR.BAS_TARIH),120))  as Sure
 
FROM            dbo.MOLALAR INNER JOIN
                         dbo.PERSONELLER ON dbo.MOLALAR.PID = dbo.PERSONELLER.PID
                                         --INNER JOIN
                       --  dbo.TERMINALLER ON dbo.PERSONELLER.TID = dbo.TERMINALLER.TID
WHERE        --(dbo.TERMINALLER.DURUM = 4) AND
(dbo.MOLALAR.BAS_TARIH > DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00') AND
(dbo.MOLALAR.MOLADA = 'True')
             --AND  dbO.PERSONELLER.PID=@PID
             end
GO
/****** Object:  StoredProcedure [dbo].[sp_AnlikRaporTerminal]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Uğur Aldanmaz>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[sp_AnlikRaporTerminal]
	-- Add the parameters for the stored procedure here
@TID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT		T1.ELTID AS [Terminal No], T1.TERMINAL_AD AS [Terminal],  T1.TID, COUNT(B1.BID) AS [T. İşlem], 
				CONVERT(varchar, DATEADD(s, AVG(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [O. İşlem Süresi], 
				CONVERT(varchar, DATEADD(s, SUM(DATEDIFF(second, B1.ISLEM_BAS_TAR, B1.ISLEM_BIT_TAR)), 0), 108) AS [T. Çalışma Süresi],
        
			(SELECT     TOP (1) GRUPLAR.GRUP_ISMI
				FROM		BILETLER AS B2 INNER JOIN
							TERMINALLER AS T2 ON B2.TID = T2.TID INNER JOIN
                            GRUPLAR ON B2.GRPID = GRUPLAR.GRPID
				WHERE	(B2.TID = B1.TID)
						AND b2.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
				ORDER BY B2.BID DESC) AS [Son İşlem],
                
			(SELECT     TOP (1) B3.BILET_NO AS Expr1
				FROM		BILETLER AS B3 INNER JOIN
							TERMINALLER AS T3 ON B3.TID = T3.TID INNER JOIN
							GRUPLAR AS G3 ON B3.GRPID = G3.GRPID
				WHERE	(B3.TID = B1.TID)
						AND b3.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
				ORDER BY B3.BID DESC) AS [Son Çağrılan Bilet],
                
			(SELECT     TOP (1) B4.ISLEM_BAS_TAR AS Expr1
                FROM		BILETLER AS B4 INNER JOIN
							TERMINALLER AS T4 ON B4.TID = T4.TID INNER JOIN
                            GRUPLAR AS G4 ON B4.GRPID = G4.GRPID
				WHERE      (B4.TID = B1.TID)
						AND b4.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
						AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
                ORDER BY B4.BID DESC) AS [Son Çağrı Saati]

	FROM         BILETLER AS B1 LEFT JOIN
                 TERMINALLER AS T1 ON B1.TID = T1.TID INNER JOIN
                 GRUPLAR AS G1 ON B1.GRPID = G1.GRPID
                 
	Where		b1.SIS_TAR between DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00'
					and DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '23:59' 
					AND b1.TID > 0 AND T1.TID = @TID

GROUP BY T1.ELTID, T1.TID, B1.TID, T1.TERMINAL_AD

END




GO
/****** Object:  StoredProcedure [dbo].[sp_AnlikTerminalDurum]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_AnlikTerminalDurum]
       -- Add the parameters for the stored procedure here
@PID int
AS
BEGIN
       -- SET NOCOUNT ON added to prevent extra result sets from
       -- interfering with SELECT statements.
       SET NOCOUNT ON;
 
    -- Insert statements for procedure here
SELECT        dbo.TERMINALLER.ELTID AS [Terminal No], dbo.TERMINALLER.TERMINAL_AD AS Terminal, dbo.PERSONELLER.AD + ' ' + dbo.PERSONELLER.SOYAD AS Personel, dbo.T_DURUM_MASTER.DURUM,
                         dbo.TERMINALLER.AKTIF_BID AS [İşlem Yapılan Bilet], dbo.GRUPLAR.GRUP_ISMI AS [İşlem Yapılan Grup/Servis], dbo.TERMINALLER.TID, dbo.TERMINALLER.DURUM AS TD
FROM            dbo.TERMINALLER LEFT OUTER JOIN
                         dbo.PERSONELLER ON dbo.TERMINALLER.TID = dbo.PERSONELLER.TID INNER JOIN
                         dbo.T_DURUM_MASTER ON dbo.TERMINALLER.DURUM = dbo.T_DURUM_MASTER.DID LEFT OUTER JOIN
                         dbo.GRUPLAR ON dbo.TERMINALLER.SON_CAGRILAN_GRUP = dbo.GRUPLAR.GRPID
WHERE        (dbo.PERSONELLER.SIL = 'FALSE') --AND  dbo.PERSONELLER.PID = @PID
END
GO
/****** Object:  StoredProcedure [dbo].[sp_BiletKontrol]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_BiletKontrol] 
	-- Add the parameters for the stored procedure here
@GRPID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
		Select count(*) AS 'BiletSayi', (CONVERT(date,SIS_TAR,104)) AS 'Tarih'
		from BILETLER 
		where (GRPID = @GRPID) and CONVERT(date,GETDATE(),104) <= CONVERT(date,SIS_TAR,104)
		group by (CONVERT(date,SIS_TAR,104))
		order by CONVERT(date,SIS_TAR,104)
	END
GO
/****** Object:  StoredProcedure [dbo].[sp_DetayliIslemYaptirmayanlar]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[sp_DetayliIslemYaptirmayanlar] 
	-- Add the parameters for the stored procedure here
@GRPID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT        dbo.GRUPLAR.GRUP_ISMI AS [Grup/Servis], dbo.GRUPLAR.MIN_HIZMET_SURESI AS [Min. Hizmet Süresi], dbo.BILETLER.BILET_NO AS [Bilet No], dbo.BILETLER.SIS_TAR AS [Alınma Tarihi], 
                         dbo.BILETLER.ISLEM_BAS_TAR AS [Çağrı Saati], dbo.BILETLER.ISLEM_BIT_TAR AS [İşlem Bitiş Saati], CONVERT(varchar, DATEADD(s, DATEDIFF(second, CONVERT(time, dbo.BILETLER.SIS_TAR), 
                         dbo.BILETLER.ISLEM_BAS_TAR), 0), 108) AS [Bekleme Süresi], CONVERT(varchar, DATEADD(s, DATEDIFF(second, dbo.BILETLER.ISLEM_BAS_TAR, dbo.BILETLER.ISLEM_BIT_TAR), 0), 108) AS [İşlem Süresi], 
                         dbo.GRUPLAR.GRPID
FROM            dbo.GRUPLAR INNER JOIN
                         dbo.BILETLER ON dbo.GRUPLAR.GRPID = dbo.BILETLER.GRPID
WHERE dbo.GRUPLAR.GRPID = @GRPID
GROUP BY dbo.GRUPLAR.GRPID, dbo.GRUPLAR.GRUP_ISMI, dbo.GRUPLAR.MIN_HIZMET_SURESI, dbo.BILETLER.BILET_NO, dbo.BILETLER.SIS_TAR, dbo.BILETLER.ISLEM_BAS_TAR, 
                         dbo.BILETLER.ISLEM_BIT_TAR
HAVING        (DATEDIFF(second, CONVERT(time, dbo.BILETLER.ISLEM_BAS_TAR), dbo.BILETLER.ISLEM_BIT_TAR) < (DATEPART(second, dbo.GRUPLAR.MIN_HIZMET_SURESI) + DATEPART(minute, 
                         dbo.GRUPLAR.MIN_HIZMET_SURESI) * 60) + DATEPART(hour, dbo.GRUPLAR.MIN_HIZMET_SURESI) * 360)

END

GO
/****** Object:  StoredProcedure [dbo].[sp_DetayliMolaRapor]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[sp_DetayliMolaRapor] 
	-- Add the parameters for the stored procedure here
@PID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT        --dbo.TERMINALLER.TID, 
dbo.PERSONELLER.AD + ' ' + dbo.PERSONELLER.SOYAD AS Personel, dbo.MOLALAR.BAS_TARIH AS [Mola Başlangıç], dbo.MOLALAR.BIT_TARIH AS [Mola Bitiş], 
                --         dbo.TERMINALLER.ELTID AS [Terminal No], dbo.TERMINALLER.TERMINAL_AD AS Terminal,
						  CONVERT(varchar, DATEADD(s, DATEDIFF(second, dbo.MOLALAR.BAS_TARIH, dbo.MOLALAR.BIT_TARIH), 0), 108) 
                         AS [Mola Süresi], dbo.MOLALAR.PID
FROM            dbo.MOLALAR LEFT OUTER JOIN
                         dbo.PERSONELLER ON dbo.MOLALAR.PID = dbo.PERSONELLER.PID 
						 --CROSS JOIN                         dbo.TERMINALLER
							WHERE dbo.MOLALAR.PID = @PID 
END

GO
/****** Object:  StoredProcedure [dbo].[sp_DetayliServisDisiPersonel]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[sp_DetayliServisDisiPersonel] 
	-- Add the parameters for the stored procedure here
@TID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
SELECT        dbo.SERVIS_HAREKET.SKID, dbo.PERSONELLER.AD + ' ' + dbo.PERSONELLER.SOYAD AS Personel, dbo.TERMINALLER.ELTID AS [Terminal No], dbo.TERMINALLER.TERMINAL_AD AS Terminal, 
                         dbo.SERVIS_HAREKET.SEBEP AS [Kapatma Sebebi], dbo.SERVIS_HAREKET.KAP_TAR AS [Kapatma Tarihi], dbo.SERVIS_HAREKET.AC_TAR AS [Açma Tarihi], CONVERT(varchar, DATEADD(s, DATEDIFF(second, 
                         dbo.SERVIS_HAREKET.KAP_TAR, dbo.SERVIS_HAREKET.AC_TAR), 0), 108) AS [Kapalı Süre], dbo.SERVIS_HAREKET.TID
FROM            dbo.PERSONELLER INNER JOIN
                         dbo.TERMINALLER ON dbo.PERSONELLER.TID = dbo.TERMINALLER.TID RIGHT OUTER JOIN
                         dbo.SERVIS_HAREKET ON dbo.TERMINALLER.TID = dbo.SERVIS_HAREKET.TID
WHERE dbo.TERMINALLER.TID = @TID
END

GO
/****** Object:  StoredProcedure [dbo].[sp_GetButtonIDToProperty]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetButtonIDToProperty]
	-- Add the parameters for the stored procedure here
@BtnID int,
@KID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT * FROM BUTONLAR where [BTNID] = @BtnID and [BM_ADRES] = @KID
	
END
GO
/****** Object:  StoredProcedure [dbo].[sp_GetSubBtnNameToID]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_GetSubBtnNameToID]
	-- Add the parameters for the stored procedure here
@KioskID int,
@SubbtnAd nvarchar(150)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT [BTNID] FROM BUTONLAR where [BM_ADRES] = @KioskID and [BTN_EKRAN] = @SubbtnAd
END
GO
/****** Object:  StoredProcedure [dbo].[sp_KontrolBiletTC]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:          <Author,,Name>
-- Create date: <Create Date,,>
-- Description:     <Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[sp_KontrolBiletTC]
       -- Add the parameters for the stored procedure here
@TC nvarchar(11)
,@Tarih datetime
AS
BEGIN
       -- SET NOCOUNT ON added to prevent extra result sets from
       -- interfering with SELECT statements.
       SET NOCOUNT ON;
 
    -- Insert statements for procedure here
       SELECT TOP 1 MusteriNo FROM BILETLER
       WHERE MusteriNo = @TC and CONVERT(VARCHAR(10),SIS_TAR,110) = CONVERT(VARCHAR(10),@Tarih,110)
       END
GO
/****** Object:  StoredProcedure [dbo].[sp_KuyrukInsert]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create PROCEDURE [dbo].[sp_KuyrukInsert] 
-- Add the parameters for the stored procedure here 
@BID int 
,@GRPID int 
,@BILET_NO smallint 
,@TRANSFER bit 
,@OZEL_MUSTERI bit 
AS 
BEGIN 
-- SET NOCOUNT ON added to prevent extra result sets from 
-- interfering with SELECT statements. 
SET NOCOUNT ON; 

-- Insert statements for procedure here 
INSERT INTO [dbo].[KUYRUK] 
([BID] 
,[GRPID] 
,[BILET_NO] 
,[TRANSFER] 
,[OZEL_MUSTERI]) 
VALUES 
(@BID 
,@GRPID 
,@BILET_NO 
,@TRANSFER 
,@OZEL_MUSTERI) 
END
GO
/****** Object:  StoredProcedure [dbo].[Sp_MailEkle]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
 CREATE proc [dbo].[Sp_MailEkle]
 (
 @G_Kisi varchar(50),
 @Mail_Adresi varchar(50),
 @G_Rapor varchar(50),
 @Konu varchar(50) ,
 @Mesaj varchar(max)
 )
 as
 insert Mail (G_Kisi,Mail_Adresi,G_Rapor,Konu,Mesaj)values (@G_Kisi,@Mail_Adresi,@G_Rapor,@Konu,@Mesaj)

GO
/****** Object:  StoredProcedure [dbo].[sp_ServisDisiPersonel]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE PROCEDURE [dbo].[sp_ServisDisiPersonel]
	-- Add the parameters for the stored procedure here
@TID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
SELECT        dbo.SERVIS_HAREKET.SKID, dbo.SERVIS_HAREKET.TID, dbo.PERSONELLER.AD + ' ' + dbo.PERSONELLER.SOYAD AS Personel, dbo.TERMINALLER.ELTID AS [Terminal No], 
                         dbo.TERMINALLER.TERMINAL_AD AS Terminal, dbo.SERVIS_HAREKET.KAP_TAR AS [Kapatma Tarihi], dbo.SERVIS_HAREKET.SEBEP AS [Kapatma Sebebi]
FROM            dbo.SERVIS_HAREKET INNER JOIN
                         dbo.TERMINALLER ON dbo.SERVIS_HAREKET.TID = dbo.TERMINALLER.TID INNER JOIN
                         dbo.PERSONELLER ON dbo.TERMINALLER.TID = dbo.PERSONELLER.TID
WHERE        (dbo.SERVIS_HAREKET.KAPALI = 'True') AND (dbo.PERSONELLER.OTURUM_DURUM = 1) AND (dbo.SERVIS_HAREKET.KAP_TAR > DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) + '00:00')
AND dbo.TERMINALLER.TID = @TID
END

GO
/****** Object:  StoredProcedure [dbo].[sp_Sure]    Script Date: 20.05.2018 03:52:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sp_Sure] 
	-- Add the parameters for the stored procedure here
@GRPID int,
@TID int
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT       dbo.BILETLER.BID, dbo.TERMINALLER.TERMINAL_AD AS Terminal, dbo.TERMINALLER.ELTID AS [Terminal No], dbo.PERSONELLER.AD + ' ' + dbo.PERSONELLER.SOYAD AS Personel, 
                         dbo.GRUPLAR.GRUP_ISMI AS [Grup/Servis], dbo.BILETLER.BILET_NO AS [Bilet No], cast(dbo.BILETLER.SIS_TAR as datetime) AS [Alınma Tarihi], dbo.BILETLER.ISLEM_BAS_TAR AS [Çağrı Saati], 
                         dbo.BILETLER.ISLEM_BIT_TAR AS [İşlem Bitiş Saati], (CASE BILETLER.TRANSFER WHEN 'false' THEN '' WHEN 'true' THEN 'Transfer' END) AS Transfer, 
                         CASE BILETLER.OZEL_MUSTERI WHEN 'false' THEN '' WHEN 'true' THEN 'Fiktif Bilet' END AS Fiktif, dbo.BILETLER.GRPID, dbo.BILETLER.TID
FROM            dbo.BILETLER LEFT OUTER JOIN
                         dbo.TERMINALLER ON dbo.BILETLER.TID = dbo.TERMINALLER.TID LEFT OUTER JOIN
                         dbo.PERSONELLER ON dbo.TERMINALLER.TID = dbo.PERSONELLER.TID LEFT OUTER JOIN
                         dbo.GRUPLAR ON dbo.BILETLER.GRPID = dbo.GRUPLAR.GRPID
						 WHERE dbo.GRUPLAR.GRPID=@GRPID AND TERMINALLER.TID = @TID
END
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SİSTEMİN ÇALIŞACAĞI MAKİNENİN IP ADRESİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'_SISTEM_CONFIG', @level2type=N'COLUMN',@level2name=N'SERVER_IP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'PROGRAMI KULLANACAK OLAN FİRMANIN İSMİ. EXCEL RAPOR ÇIKTILARINDA GÖZÜKECEKTİR' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'_SISTEM_CONFIG', @level2type=N'COLUMN',@level2name=N'FIRMA_ISMI'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İLGİLİ OLDUĞU ANA TABLO ID Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'ATID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İLGİLİ TERMİNAL ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'TID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OK YÖNÜ (SOL=1, SAĞ=2, YUKARI=3, AŞAĞI=4, KAPALI=5)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'YON'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLO_YON', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TABLO TÜRÜ (LCD TABLO=0, LED TABLO=1) PROGRAM İÇERSİNDE ENUMLARLA SAĞLANACAK.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'TABLO_TURU'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'ANATABLOLAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AYARIN SAHİBİ OLAN KIOSK ID, PRIMARY KEY, OTO ARTIŞ YOK' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'KID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BASILACAK OLAN BİLETTEKİ BAŞLIK/SATIR 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'BILET_BASLIK_S1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BASILACAK OLAN BİLETTEKİ BAŞLIK/SATIR 2' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'BILET_BASLIK_S2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN KİŞİ YAZISI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'ETIKET_BEKLEYEN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'ETIKET_KARSILAMA1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_BEKLEYEN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJI FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_KARSILAMA'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BAŞLIĞIN FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_BASLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP İSMİNİN FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_GRUP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TARİH FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_TARIH'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT_SIRANO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO FONTU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'FONT2_SIRANO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_BEKLEYEN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJI PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_KARSILAMA'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BAŞLIĞIN PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_BASLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP İSMİNİN PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_GRUP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TARİH PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_TARIH'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO_SIRANO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BEKLEYEN ETİKETİNİN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_BEKLEYEN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AĞIRLAMA MESAJININ BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_KARSILAMA'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BAŞLIĞIN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_BASLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP İSMİNİN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_GRUP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TARİHİN BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_TARIH'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SIRANO BASILMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'YAZ_SIRANO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILET_AYAR', @level2type=N'COLUMN',@level2name=N'B_YF'
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
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İŞLEMİ YAPAN TERMİNALİN ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'TID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'HAREKETİN GERÇEKLEŞTİĞİ (BİLETİN VERİLDİĞİ) GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'GRPID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET NUMARASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'BILET_NO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİN ALINDIĞI/SİSTEME KAYDOLDUĞU VEYA TRANSFER EDİLDİĞİ TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'SIS_TAR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİN İŞLEME ALINDIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'ISLEM_BAS_TAR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İŞLEMİN BİTTİĞİ TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'ISLEM_BIT_TAR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR BİLET TRANSFER EDİLDİĞİNDE TEKRAR HAREKET TABLOSUNA KAYDEDİLER. VARSAYILAN TRANSFER=0(TRANSFER DEĞİL)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'TRANSFER'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUP ÜZERİNDEKİ BİLET BİTTİĞİNDE BAŞA DÖN DURUMU AKTİFSE TUR SAYISI 1 ARTAR. BAŞLANGIÇ DEĞERİ = 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'TUR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİ ALAN KİŞİ ÖZEL MÜŞTERİ Mİ? (FİKTİF BİLET İÇİN) ÇAĞRILMA ORANINI ETKİLEYECEK DEĞER. VARSAYILAN = 0' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'OZEL_MUSTERI'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİN VERİLDİĞİ BUTONUN ID''Sİ(BİLET MAKİNESİ ÜZERİNDEKİ BUTONUN FİZİKSEL ADRESİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'BTNID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BILETLER', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN AİT OLDUĞU BİLET MAKİNESİ FİZİKSEL ADRESİ, KIOSK İÇİN PRINTERI İFADE ETMEKTEDİR' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BM_ADRES'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET MAKİNESİNDEKİ FİZİKSEL BUTON ID''Sİ KIOSKTA SADECE SIRALAMA ANLAMI İFADE ETMEKTEDİR.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTNID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONA BASILDIĞINDA BİLETİN VERİLECEĞİ GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'GRP_ID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'EĞER BUTON ALT BUTON İSE ANA BUTONUN ID''Sİ. DEĞİLSE 0' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'ANA_BTNID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK ÜZERİNDEKİ BUTONUN EKRANA BASILDIĞINDA ÜZERİNDE YAZACAK OLAN YAZI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_EKRAN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN İLK SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN İKİNCİ SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN ÜÇÜNCÜ SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET BASILDIĞINDA KAĞIT ÜZERİNE YAZILACAK OLAN DÖRDÜNCÜ SATIR (GRUP BİLGİLERİ İÇERİR, GRUP ADI GİBİ)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BTN_BILET_S4'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'GRUBA BİR GÜNDE MAKSİMUM KAÇ TANE BİLET BASILACAĞI. GRUP BİLET BİTİNCE BAŞA DÖN AKTİFSE DE TUR SAYISINI ETKİLER.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'MAKS_BILET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR İSTEKTE BASILACAK BİLET KOPYA SAYISI. AYNI BİLETİ BELİRTİLEN SAYI KADAR BASAR. VARSAYILAN 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'BILET_KOPYA'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK UZERİNDEKİ YÜKSEKLİĞİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'YUKSEKLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK UZERİNDEKİ GENİŞLİĞİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'GENISLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK ÜZERİNDEKİ ARKA PLAN RENGİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'RENK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN KIOSK ÜZERİNDEKİ ARKA PLAN RESMI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'RESIM'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YÜKLENEN ARKA PLAN RESMİNİN İSMİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'RESIM_AD'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'AÇIKLAMA' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'ACIKLAMA'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BUTONUN AKTİFLİK DURUMU. VARSAYILAN TRUE' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'AKTIF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'BUTONLAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET VERMEYE BAŞLANILAN NUMARA' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BAS_NO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SON BİLET NUMARASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BIT_NO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİTİŞ NUMARASINA ERDİKTEN SONRA TEKRAR BAŞLANGIÇ NUMARASINDAN BİLET VERMEYE DEVAM EDİLSİN Mİ?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'DONGU'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLE TATİLİNDE SİSTEMİN BİLET VERİP VERMEYECEĞİNİ TUTAN ALAN' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'OGLEN_BILET_VER'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLEDEN ÖNCE VE ÖĞLEDEN SONRA VERİLECEK BİLET ADETİNDE SINIRLAMASI YAPILSIN MI?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BILET_SINIRLA'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLEDEN ÖNCE GRUBA VERİLECEK BİLET SINIRLAMASI SAYISI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'OO_MAX_BILET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'ÖĞLEDEN SONRA GRUBA VERİLECEK BİLET SINIRLAMASI SAYISI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'OS_MAX_BILET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KAYDIN SİLİNME DURUMU VARSAYILAN=0 FALSE' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'SIL'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'0- yok, 1- manuel, 2-otomatik' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'GRUPLAR', @level2type=N'COLUMN',@level2name=N'BeklemeSuresiTipi'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK ID PRIMARY KEY, BİLET MAKİNESİ TABLOSUNA EKLENEN MAKİNENIN ADRESİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'KID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDA GÖRÜNTÜLENECEK OLAN BAŞLIK TEXTİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'BASLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDA GÖRÜNTÜLENECEK OLAN ALT BAŞLIK TEXTİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'ALT_BASLIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SOL TARAFTA ÇİZİLECEK OLAN BUTON SAYISI. EĞER NULL İSE SIRAYLA TÜM BUTONLARI UYGUN ŞEKİLDE ÇİZER (GEREK OLAMAYABİLİR. ÇİZİM HESAPLAMASI KOD İLE YAPILABİLİR.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SOL_BTN_ADET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SAĞ TARAFTA ÇİZİLECEK OLAN BUTON SAYISI. EĞER NULL İSE SIRAYLA TÜM BUTONLARI UYGUN ŞEKİLDE ÇİZER (GEREK OLAMAYABİLİR. ÇİZİM HESAPLAMASI KOD İLE YAPILABİLİR.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SAG_BTN_ADET'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK FORMUNUN SOL KISIMDAN PADDING DEĞERİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SOL_PADDING'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK FORMUNUN SAĞ KISIMDAN PADDING DEĞERİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'SAG_PADDING'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK YAZI TİPİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'FONT'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK YAZI PUNTOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'PUNTO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSK EKRANINDAKİ BUTONA BASILDIĞINDA BİLETİ VERDİKTEN SONRA İKİNCİ BİLET İÇİN BEKLEME SÜRESİ, DELAY' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'GECIKME'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KIOSKUN ÇALIŞMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'AKTIF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewHeight'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewWidth'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewTimerInterval'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'mt' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KIOSK_AYAR', @level2type=N'COLUMN',@level2name=N'TagPreviewZoom'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'KUYRUKTA BEKLEYEN BİLET' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'BID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'HAREKETİN GERÇEKLEŞTİĞİ (BİLETİN VERİLDİĞİ) GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'GRPID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLET NUMARASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'BILET_NO'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR BİLET TRANSFER EDİLDİĞİNDE TEKRAR HAREKET TABLOSUNA KAYDEDİLER. VARSAYILAN TRANSFER=0(TRANSFER DEĞİL)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'TRANSFER'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİLETİ ALAN KİŞİ ÖZEL MÜŞTERİ Mİ? (FİKTİF BİLET) ÇAĞRILMA ORANINI ETKİLEYECEK DEĞER.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'OZEL_MUSTERI'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'KUYRUK', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUM KAYIT ID. PRIMARY KEY' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'OID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUM AÇAN PERSONELİN ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'PID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUMUN BAŞLATILDIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'OTURUM_BAS_TARIH'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTURUMUN KAPATILDIĞI TARİH' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'OTURUMLAR', @level2type=N'COLUMN',@level2name=N'OTURUM_BIT_TARIH'
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
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SERVİSİNİ KAPATAN TERMİNAL' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'TID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SERVİSİ KAPATMA SEBEBİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'SEBEP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SERVİSİ KAPATTIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'KAP_TAR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SERVİSİ AÇTIĞI TARİH SAAT' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SERVIS_HAREKET', @level2type=N'COLUMN',@level2name=N'AC_TAR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SİSTEM MESAJ MASTER ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ', @level2type=N'COLUMN',@level2name=N'SMMID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'MESAJ METNİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ', @level2type=N'COLUMN',@level2name=N'MESAJ'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SİSTEM MESAJLARI MASTER ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ_MASTER', @level2type=N'COLUMN',@level2name=N'SMMID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'MESAJ TİPİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'SYS_MESAJ_MASTER', @level2type=N'COLUMN',@level2name=N'MESAJ_TIP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SİSTEM ÜZERİNDEKİ DURUM MASTER TABLOSU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'T_DURUM_MASTER', @level2type=N'COLUMN',@level2name=N'DURUM'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'İLGİLİ TERMİNAL ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'TID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN İLİŞKİLENDİRİLDİĞİ GRUP ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'GRPID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN BU GRUPTAN NE SIKLIKLA MÜŞTERİ ÇAĞIRACAĞI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'CAGRI_ORAN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN, BU GRUBA TRANSFER EDİLMİŞ MÜŞTERİLERİ NE SIKLIKLA ÇAĞIRACAĞI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'TRANSFER_ORAN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN YARDIM EDECEĞİ GRUP MU?' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'YARDIM_GRUBU'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN BU GRUPTAN NORMAL BİLETLİ MÜŞTERİLERİN NE KADARINI ÇAĞIRDIĞI.(ÇAĞRI ORAN DEĞERİNE ULAŞILDIĞINDA SIFIRLANACAK)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'CAGRILAN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN BU GRUPTAN TRANSFER EDİLMİŞ BİLETLİ MÜŞTERİLERİN NE KADARINI ÇAĞIRDIĞI.(TRANSFER ORAN DEĞERİNE ULAŞILDIĞINDA SIFIRLANACAK)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'TRANSFER_CAGRILAN'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'BİR TERMİNALE ATANMIŞ GRUBUN BİLET ÇAĞIRMADAKİ ÖNCELİĞİ/SIRASI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'ONCELIK'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINAL_GRUP', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALE BAĞLI OLAN EL TERMİNALİ ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'ELTID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ADI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'TERMINAL_AD'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'SANAL TERMİNALİN OTO ÇAĞRI YAPMASININ AKTİF OLUP OLMADIĞI' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'OTO_CAGRI'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'OTOMATİK ÇAĞRI SÜRESİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'OTO_SURE'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN SİSTEMDEKİ ANLIK DURUMU, 
SERVİS DIŞI, MÜŞTERİYLE MEŞGUL, BOŞTA, MOLADA, SİSTEMDE DEĞİL GİBİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'DURUM'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ÇALIŞMA DURUMU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'AKTIF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ŞU AN İŞLEM YAPTIĞI BİLETİN ID''Sİ' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'AKTIF_BID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN İŞLEM İÇİN BEKLEYEN BİLETLERDEN SON ÇAĞIRDIĞI BİLETİN GRUBU' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'SON_CAGRILAN_GRUP'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'TERMİNALİN ÇAĞIRDIĞI SON BİLETİN TRANSFER BİLETİ OLUP OLMADIĞINI TUTAN ALAN' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'SON_CAGRILAN_TUR'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Varsayılan 0. Kayıt kullanıcı tarafından programdan silindiğinde 1.(Terminal kaydı halen durur.)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'SIL'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'S_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'S_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK STRING FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'S_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'I_YF1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'I_YF2'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK INT FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'I_YF3'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'YEDEK BOOL FIELD' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'TERMINALLER', @level2type=N'COLUMN',@level2name=N'B_YF'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPane1', @value=N'[0E232FF0-B466-11cf-A24F-00AA00A3EFFF, 1.00]
Begin DesignProperties = 
   Begin PaneConfigurations = 
      Begin PaneConfiguration = 0
         NumPanes = 4
         Configuration = "(H (1[28] 4[8] 2[35] 3) )"
      End
      Begin PaneConfiguration = 1
         NumPanes = 3
         Configuration = "(H (1 [50] 4 [25] 3))"
      End
      Begin PaneConfiguration = 2
         NumPanes = 3
         Configuration = "(H (1 [50] 2 [25] 3))"
      End
      Begin PaneConfiguration = 3
         NumPanes = 3
         Configuration = "(H (4 [30] 2 [40] 3))"
      End
      Begin PaneConfiguration = 4
         NumPanes = 2
         Configuration = "(H (1 [56] 3))"
      End
      Begin PaneConfiguration = 5
         NumPanes = 2
         Configuration = "(H (2 [66] 3))"
      End
      Begin PaneConfiguration = 6
         NumPanes = 2
         Configuration = "(H (4 [50] 3))"
      End
      Begin PaneConfiguration = 7
         NumPanes = 1
         Configuration = "(V (3))"
      End
      Begin PaneConfiguration = 8
         NumPanes = 3
         Configuration = "(H (1[56] 4[18] 2) )"
      End
      Begin PaneConfiguration = 9
         NumPanes = 2
         Configuration = "(H (1 [75] 4))"
      End
      Begin PaneConfiguration = 10
         NumPanes = 2
         Configuration = "(H (1[66] 2) )"
      End
      Begin PaneConfiguration = 11
         NumPanes = 2
         Configuration = "(H (4 [60] 2))"
      End
      Begin PaneConfiguration = 12
         NumPanes = 1
         Configuration = "(H (1) )"
      End
      Begin PaneConfiguration = 13
         NumPanes = 1
         Configuration = "(V (4))"
      End
      Begin PaneConfiguration = 14
         NumPanes = 1
         Configuration = "(V (2))"
      End
      ActivePaneConfig = 0
   End
   Begin DiagramPane = 
      Begin Origin = 
         Top = 0
         Left = 0
      End
      Begin Tables = 
         Begin Table = "g"
            Begin Extent = 
               Top = 6
               Left = 38
               Bottom = 136
               Right = 228
            End
            DisplayFlags = 280
            TopColumn = 0
         End
      End
   End
   Begin SQLPane = 
   End
   Begin DataPane = 
      Begin ParameterDefaults = ""
      End
      Begin ColumnWidths = 9
         Width = 284
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
         Width = 1500
      End
   End
   Begin CriteriaPane = 
      Begin ColumnWidths = 12
         Column = 1440
         Alias = 900
         Table = 1170
         Output = 720
         Append = 1400
         NewValue = 1170
         SortType = 1350
         SortOrder = 1410
         GroupBy = 1350
         Filter = 1350
         Or = 1350
         Or = 1350
         Or = 1350
      End
   End
End
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vTerminalListesi'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_DiagramPaneCount', @value=1 , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'VIEW',@level1name=N'vTerminalListesi'
GO
USE [master]
GO
ALTER DATABASE [QCU.MDF] SET  READ_WRITE 
GO
