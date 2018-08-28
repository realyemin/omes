CREATE TABLE IF NOT EXISTS `bilet_makineleri` (
  `MAKINE_ADRESI` int(11) NOT NULL,
  `MAKINE_ADI` varchar(25) DEFAULT '',
  `MAKINE_TURU` smallint(6) DEFAULT NULL,
  `SIL` tinyint(1) DEFAULT '0',
  `S_YF1` varchar(50) DEFAULT '',
  `S_YF2` varchar(50) DEFAULT '',
  `S_YF3` varchar(50) DEFAULT '',
  `I_YF1` int(11) DEFAULT NULL,
  `I_YF2` int(11) DEFAULT NULL,
  `I_YF3` int(11) DEFAULT NULL,
  `B_YF` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`MAKINE_ADRESI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER DATABASE `bilet_makineleri` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;