CREATE TABLE IF NOT EXISTS `anatablolar` (
  `ATID` int(11) NOT NULL,
  `TABLO_ADI` varchar(20) DEFAULT '',
  `TABLO_TURU` smallint(6) DEFAULT NULL,
  `S_YF1` varchar(50) DEFAULT '',
  `S_YF2` varchar(50) DEFAULT '',
  `S_YF3` varchar(50) DEFAULT '',
  `I_YF1` int(11) DEFAULT NULL,
  `I_YF2` int(11) DEFAULT NULL,
  `I_YF3` int(11) DEFAULT NULL,
  `B_YF` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ATID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER DATABASE `anatablolar` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;