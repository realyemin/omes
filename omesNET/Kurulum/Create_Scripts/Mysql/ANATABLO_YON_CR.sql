CREATE TABLE IF NOT EXISTS `anatablo_yon` (
  `YID` int(11) NOT NULL AUTO_INCREMENT,
  `ATID` int(11) NOT NULL,
  `TID` int(11) NOT NULL,
  `YON` smallint(6) NOT NULL,
  `S_YF1` varchar(50) DEFAULT '',
  `S_YF2` varchar(50) DEFAULT '',
  `S_YF3` varchar(50) DEFAULT '',
  `I_YF1` int(11) DEFAULT NULL,
  `I_YF2` int(11) DEFAULT NULL,
  `I_YF3` int(11) DEFAULT NULL,
  `B_YF` tinyint(1) DEFAULT NULL,
  `Port` int(11) DEFAULT NULL,
  PRIMARY KEY (`YID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
ALTER DATABASE `anatablo_yon` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;