<?php
	if(isset($_GET['GRPID'])){ $GRPID=$_GET['GRPID']; }
	if(isset($_POST['GRPID'])){ $GRPID=$_POST['GRPID']; }
	
	if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
	{
		#RANDEVU_AYAR
		$row = $db->prepare("SELECT 
		randevuSecimi,
		takvimTema,
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
		
		//if ($row->fetchColumn() > 0){
		$row_RandevuAyar=$row->fetch(PDO::FETCH_ASSOC);
		//}
		
		#RANDEVU_EPOSTA_AYAR
		$row = $db->prepare("SELECT host,port,username,password,fromMesaj, subject,Aktif
		FROM RANDEVU_EPOSTA_AYAR WHERE GRPID=:GRPID");
		$row->bindParam(':GRPID', $GRPID, PDO::PARAM_INT);
		$row->execute();
		
		//if ($row->fetchColumn() > 0){
		$row_EpostaAyar=$row->fetch(PDO::FETCH_ASSOC);
		//}
	}		
?> 