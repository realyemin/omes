CREATE TABLE RANDEVU_KAYDET(
	`id` int AUTO_INCREMENT NOT NULL,
	`TID` int NULL,
	`GRPID` int NULL,
	`BID` int NULL,
	`musteriAd` nvarchar(100) NULL,
	`musteriSoyad` nvarchar(100) NULL,
	`musteriTc` nvarchar(11) NULL,
	`musteriTel` nvarchar(20) NULL,
	`randevuTarihi` date NULL,
	`randevuSaati` time(6) NULL,
	`biletNo` nvarchar(10) NULL,
	`randevuKayitTarihi` datetime(3) NULL,
	`randevuTalepSayisi` tinyint Unsigned NULL,
	`IPAdresi` nvarchar(50) NULL,
	`IPTAL` Tinyint NULL,
 CONSTRAINT `PK_RANDEVU_KAYDET` PRIMARY KEY 
(
	`id` ASC
) 
);
ALTER DATABASE `RANDEVU_KAYDET` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

