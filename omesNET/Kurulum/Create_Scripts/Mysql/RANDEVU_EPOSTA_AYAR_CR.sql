CREATE TABLE RANDEVU_EPOSTA_AYAR(
	`id` int AUTO_INCREMENT NOT NULL,
	`host` nvarchar(50) NULL,
	`port` nvarchar(10) NULL,
	`username` nvarchar(50) NULL,
	`password` nvarchar(50) NULL,
	`fromMesaj` nvarchar(50) NULL,
	`subject` nvarchar(50) NULL,
	`GRPID` int NULL,
	`Aktif` Tinyint NULL,

 CONSTRAINT `PK_Table_1_1` PRIMARY KEY 
(
	`id` ASC
) 
);
ALTER DATABASE `RANDEVU_EPOSTA_AYAR` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

