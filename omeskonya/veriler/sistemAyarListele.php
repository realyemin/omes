<?php
if(isset($_GET['GRPID'])){ $GRPID=$_GET['GRPID']; }
if(isset($_POST['GRPID'])){ $GRPID=$_POST['GRPID']; }

if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
{
$row = $db->prepare("SELECT 
	randevuSecimi,
	takvimAnimasyon,
	animasyonHizi,
	minimumTarihSayisi,
	maksimumTarihSayisi, 
	minimumTarihTuru,
	maksimumTarihTuru,
	biletSinirla,
	biletSinirSayisi
FROM RANDEVU_AYAR WHERE GRPID=:GRPID");
$row->bindParam(':GRPID', $GRPID, PDO::PARAM_INT);
$row->execute();
		
				$row_RandevuAyar=$row->fetch(PDO::FETCH_ASSOC);
				
	echo $row_RandevuAyar['biletSinirla'];
}		
?> 