TRUNCATE TABLE `gruplar`;
INSERT INTO `gruplar` (`GRPID`, `GRUP_ISMI`, `BAS_NO`, `BIT_NO`, `DONGU`, `MIN_HIZMET_SURESI`, `MAX_HIZMET_SURESI`, `AKTIF`, `MESAI_BAS`, `MESAI_BIT`, `OGLE_BAS`, `OGLE_BIT`, `OGLEN_BILET_VER`, `BILET_SINIRLA`, `OO_MAX_BILET`, `OS_MAX_BILET`, `SIL`, `S_YF1`, `S_YF2`, `S_YF3`, `I_YF1`, `I_YF2`, `I_YF3`, `B_YF`, `BeklemeSuresiTipi`,`Webrandevu`) VALUES
(83, 'Web Randevu', 1, 10, 1, '00:05:00', '00:20:00', 1, '09:00:00', '17:00:00', '12:00:00', '13:00:00', 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2,1),
(84, 'Kiosk', 101, 200, 1, '00:02:00', '00:20:00', 1, '00:00:00', '23:59:59', '12:00:00', '13:00:00', 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2,0),
(85, 'Gişe', 1000, 2000, 1, '00:02:00', '00:20:00', 1, '07:00:00', '17:00:00', '12:00:00', '13:00:00', 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2,0);
