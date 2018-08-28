CREATE TABLE RANDEVU_AYAR(
	`id` int AUTO_INCREMENT NOT NULL,
	`randevuSecimi` tinyint Unsigned NULL,
	`minimumTarihSayisi` tinyint Unsigned NULL,
	`minimumTarihTuru` nvarchar(1) NULL,
	`maksimumTarihSayisi` tinyint Unsigned NULL,
	`maksimumTarihTuru` nvarchar(1) NULL,
	`takvimTema` nvarchar(50) NULL,
	`takvimAnimasyon` nvarchar(20) NULL,
	`animasyonHizi` nvarchar(10) NULL,
	`biletSinirla` Tinyint NULL,
	`biletSinirSayisi` tinyint Unsigned NULL,
	`oturumSuresi` tinyint Unsigned NULL,
	`oturumSuresiGoster` Tinyint NULL,
	`dogrulamaKoduGoster` Tinyint NULL,
	`GRPID` int NULL,
 CONSTRAINT `PK_Table_1_1` PRIMARY KEY 
(
	`id` ASC
) 
);
ALTER DATABASE `RANDEVU_AYAR` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

