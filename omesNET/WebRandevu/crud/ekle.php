<?php include("../../Connections/baglantim.php");  ?>
<?php 
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 11.05.2018
-- Description:	Randevu Sistemi Yönetim Paneli 
(Toplu Ekle:bütün ekleme işlemleri için tek sayfa) 
-- ============================================= 
 */
 if(isset($_POST['tatilDurumBtn']) && isset($_GET['ekle']))
{	
	$RandevuTarihi = date("Y-m-d", strtotime($_POST['tatilTarihi'])); //randevu tarihi	
	$GRPID=$_POST['GRPID'];
$listele=$db->query("SELECT COUNT(*) AS T FROM RANDEVU_TATIL_AYAR WHERE tatilTarihi='$RandevuTarihi' AND GRPID='$GRPID'")->fetch();
if($listele['T']>0)
{
header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&tatil&hata=2"); 
}else{
$kaydet = $db -> prepare("INSERT INTO RANDEVU_TATIL_AYAR(tatilTarihi,tatilPeriyot,tatilAciklama,aktif, GRPID) VALUES(:tatilTarihi, :tatilPeriyot, :tatilAciklama, :aktif , :GRPID)");		
				$kaydet->bindParam(':tatilTarihi', $RandevuTarihi); //parametre tanımla										
				$kaydet->bindParam(':tatilPeriyot', $_POST['tatilPeriyot']); //parametre tanımla										
				$kaydet->bindParam(':tatilAciklama', $_POST['tatilAciklama']); //parametre tanımla		
				$kaydet->bindParam(':aktif', $_POST['aktif']); //parametre tanımla		
				$kaydet->bindParam(':GRPID', $GRPID); //parametre tanımla		

						
				$kaydet->execute(); //sorguyu çalıştır
				if($kaydet->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&tatil&ok=1"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&tatil&hata=1");}
}	
}
?>
<?php 
if(isset($_POST['haftaSonuDurumBtn']) && isset($_GET['ekle']))
{
	
$kaydet = $db -> prepare("INSERT INTO RANDEVU_AYAR (randevuSecimi, GRPID) VALUES(:randevuSecimi, :GRPID)");		
				$kaydet->bindParam(':randevuSecimi', $_POST['randevuSecimi']); //parametre tanımla	
				$kaydet->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$kaydet->execute(); //sorguyu çalıştır
				if($kaydet->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&ok=1"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&hata=1");}
}?>
<?php 
if(isset($_POST['biletSinirlamaDurumBtn']) && isset($_GET['ekle']))
{
	
$kaydet = $db -> prepare("INSERT INTO RANDEVU_AYAR (biletSinirla , biletSinirSayisi, GRPID) VALUES(:biletSinirla, :biletSinirSayisi, :GRPID)");		
				$kaydet->bindParam(':biletSinirla', $biletSinirla); //parametre tanımla	
				if($_POST['biletSinirla']=="on"){ $biletSinirla=true;}else{ $biletSinirla=false;}	
				$kaydet->bindParam(':biletSinirSayisi', $_POST['biletSinirSayisi']); //parametre tanımla	
				$kaydet->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$kaydet->execute(); //sorguyu çalıştır
				if($kaydet->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&ok=1"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&hata=1");}
}?>
<?php
if(isset($_POST['animasyonDurumBtn']) && isset($_GET['ekle']))
{	
$kaydet = $db -> prepare("INSERT INTO RANDEVU_AYAR (takvimTema, takvimAnimasyon, animasyonHizi, GRPID) VALUES(:takvimTema, :takvimAnimasyon, :animasyonHizi,:GRPID)");		
				$kaydet->bindParam(':takvimAnimasyon', $_POST['takvimAnimasyon']); //parametre tanımla										
				$kaydet->bindParam(':takvimTema', $_POST['takvimTema']); //parametre tanımla	
				$kaydet->bindParam(':animasyonHizi', $_POST['animasyonHizi']); //parametre tanımla	
				$kaydet->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$kaydet->execute(); //sorguyu çalıştır
				if($kaydet->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&ok=1"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&hata=1");}
}

?>
<?php
if(isset($_POST['takvimBasBitBtn']) && isset($_GET['ekle']))
{	
$kaydet = $db -> prepare("INSERT INTO RANDEVU_AYAR (minimumTarihSayisi, minimumTarihTuru,maksimumTarihSayisi, maksimumTarihTuru, GRPID) 
VALUES (:minimumTarihSayisi, :minimumTarihTuru,:maksimumTarihSayisi, :maksimumTarihTuru, :GRPID)");		
				$kaydet->bindParam(':minimumTarihSayisi', $_POST['minimumTarihSayisi']); //parametre tanımla										
				$kaydet->bindParam(':minimumTarihTuru', $_POST['minimumTarihTuru']); //parametre tanımla		
				$kaydet->bindParam(':maksimumTarihSayisi', $_POST['maksimumTarihSayisi']); //parametre tanımla										
				$kaydet->bindParam(':maksimumTarihTuru', $_POST['maksimumTarihTuru']); //parametre tanımla	
				$kaydet->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$kaydet->execute(); //sorguyu çalıştır
				if($kaydet->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&ok=1"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&hata=1");}
}

?>
<?php
if(isset($_POST['epostaAyarBtn']) && isset($_GET['ekle']))
{	
$kaydet = $db -> prepare("INSERT INTO RANDEVU_EPOSTA_AYAR (host,port,username,password,fromMesaj,subject,GRPID,Aktif) 
VALUES (:host, :port,:username, :password, :fromMesaj, :subject, :GRPID, :Aktif)");		
				$kaydet->bindParam(':host', $_POST['host']); //parametre tanımla										
				$kaydet->bindParam(':port', $_POST['port']); //parametre tanımla		
				$kaydet->bindParam(':username', $_POST['username']); //parametre tanımla										
				$kaydet->bindParam(':password', $_POST['password']); //parametre tanımla	
				$kaydet->bindParam(':fromMesaj', $_POST['fromMesaj']); //parametre tanımla	
				$kaydet->bindParam(':subject', $_POST['subject']); //parametre tanımla	
				$kaydet->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla
				$kaydet->bindParam(':Aktif', $_POST['Aktif']); //parametre tanımla	
				$kaydet->execute(); //sorguyu çalıştır
				if($kaydet->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&mail&ok=1"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&mail&hata=1");}
}

?>