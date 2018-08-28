CREATE TABLE IF NOT EXISTS `sistem_config` (
  `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `SERVER_IP` varchar(15) DEFAULT '',
  `FIRMA_ISMI` varchar(50) DEFAULT '',
  `KioskId` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
ALTER DATABASE `sistem_config` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;