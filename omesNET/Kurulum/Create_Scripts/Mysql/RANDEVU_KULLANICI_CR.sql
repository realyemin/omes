CREATE TABLE RANDEVU_KULLANICI(
	`id` int AUTO_INCREMENT NOT NULL,
	`musteriAd` nvarchar(100) NULL,
	`musteriSoyad` nvarchar(100) NULL,
	`musteriTc` nvarchar(11) NULL,
	`musteriTel` nvarchar(20) NULL,
	`musteriEposta` nvarchar(120) NULL,
	`kayitTarihi` date NULL,
	`IPAdresi` nvarchar(50) NULL,
 CONSTRAINT `PK_RANDEVU_KULLANICI` PRIMARY KEY 
(
	`id` ASC
) 
);
ALTER DATABASE `RANDEVU_KULLANICI` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;