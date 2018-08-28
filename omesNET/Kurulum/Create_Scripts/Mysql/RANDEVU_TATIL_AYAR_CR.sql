CREATE TABLE RANDEVU_TATIL_AYAR(
	`id` int AUTO_INCREMENT NOT NULL,
	`tatilTarihi` date NULL,
	`tatilPeriyot` tinyint Unsigned NULL,
	`tatilAciklama` nvarchar(150) NULL,
	`aktif` Tinyint NULL,
	`GRPID` int NULL,
 CONSTRAINT `PK_RANDEVU_TATIL_AYAR` PRIMARY KEY 
(
	`id` ASC
) 
);
ALTER DATABASE `RANDEVU_TATIL_AYAR` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
