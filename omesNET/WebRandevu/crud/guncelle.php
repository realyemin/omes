<?php include("../../Connections/baglantim.php");  ?>
<?php 
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 11.05.2018
-- Description:	Randevu Sistemi Yönetim Paneli (Toplu Güncelle:bütün güncelleme işlemleri için tek sayfa) 
-- ============================================= 
 */
 if(isset($_POST['tatilDurumBtn']) && isset($_GET['guncelle']))
{	
$guncelle = $db -> prepare("UPDATE RANDEVU_TATIL_AYAR SET tatilTarihi = :tatilTarihi, tatilPeriyot =:tatilPeriyot, tatilAciklama = :tatilAciklama, aktif = :aktif WHERE id = :id");		
				$guncelle->bindParam(':tatilTarihi', $RandevuTarihi); //parametre tanımla	
				$RandevuTarihi = date("Y-m-d", strtotime($_POST['tatilTarihi'])); //randevu tarihi					
				$guncelle->bindParam(':tatilPeriyot', $_POST['tatilPeriyot']); //parametre tanımla										
				$guncelle->bindParam(':tatilAciklama', $_POST['tatilAciklama']); //parametre tanımla		
				$guncelle->bindParam(':aktif', $_POST['aktif']); //parametre tanımla	
				$guncelle->bindParam(':id', $_POST['id']); //parametre tanımla											
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&tatil&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&tatil&hata=1");}
}
?>
<?php

if(isset($_POST['sistemDurumBtn']) && isset($_GET['guncelle']))
{
	//web randevusu için Gruplardan sistem durumunu Aktif=1 veya Aktif=0 yapar günceller
				
$guncelle = $db -> prepare("UPDATE GRUPLAR SET AKTIF=:AKTIF WHERE GRPID=:GRPID");		
				$guncelle->bindParam(':AKTIF', $_POST['AKTIF']); //parametre tanımla										
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla										
				$guncelle->execute(); //sorguyu çalıştır			
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&sistem&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&sistem&hata=1");}
					
}
if(isset($_POST['biletSinirlamaDurumBtn']) && isset($_GET['guncelle']))
{
	
$guncelle = $db -> prepare("UPDATE RANDEVU_AYAR SET biletSinirla = :biletSinirla, biletSinirSayisi= :biletSinirSayisi WHERE GRPID=:GRPID");		
				$guncelle->bindParam(':biletSinirla', $biletSinirla); //parametre tanımla										
if($_POST['biletSinirla']=="on"){ $biletSinirla=true;}else{ $biletSinirla=false;}	
				$guncelle->bindParam(':biletSinirSayisi', $_POST['biletSinirSayisi']); //parametre tanımla			
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&hata=1");}
					
}
if(isset($_POST['haftaSonuDurumBtn']) && isset($_GET['guncelle']))
{
	
$guncelle = $db -> prepare("UPDATE RANDEVU_AYAR SET randevuSecimi = :randevuSecimi WHERE GRPID=:GRPID");		
				$guncelle->bindParam(':randevuSecimi', $_POST['randevuSecimi']); //parametre tanımla	
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&randevu&hata=1");}
}
//$row_RandevuAyar = $db->query("SELECT sistemDurumu, randevuSecimi FROM RANDEVU_AYAR")->fetch();
?> 
<?php
if(isset($_POST['animasyonDurumBtn']) && isset($_GET['guncelle']))
{	
$guncelle = $db -> prepare("UPDATE RANDEVU_AYAR SET takvimTema=:takvimTema, takvimAnimasyon = :durum, animasyonHizi= :animasyonHizi WHERE GRPID=:GRPID");		
				$guncelle->bindParam(':durum', $_POST['takvimAnimasyon']); //parametre tanımla										
				$guncelle->bindParam(':takvimTema', $_POST['takvimTema']); //parametre tanımla	
				$guncelle->bindParam(':animasyonHizi', $_POST['animasyonHizi']); //parametre tanımla	
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&hata=1");}
}

?>
<?php
if(isset($_POST['takvimBasBitBtn']) && isset($_GET['guncelle']))
{	
$guncelle = $db -> prepare("UPDATE RANDEVU_AYAR SET minimumTarihSayisi = :minimumTarihSayisi, minimumTarihTuru= :minimumTarihTuru,
maksimumTarihSayisi=:maksimumTarihSayisi, maksimumTarihTuru=:maksimumTarihTuru WHERE GRPID=:GRPID");		
				$guncelle->bindParam(':minimumTarihSayisi', $_POST['minimumTarihSayisi']); //parametre tanımla										
				$guncelle->bindParam(':minimumTarihTuru', $_POST['minimumTarihTuru']); //parametre tanımla		
				$guncelle->bindParam(':maksimumTarihSayisi', $_POST['maksimumTarihSayisi']); //parametre tanımla										
				$guncelle->bindParam(':maksimumTarihTuru', $_POST['maksimumTarihTuru']); //parametre tanımla	
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&takvim&hata=1");}
}

?>
<?php
if(isset($_POST['randevuGuncelleBtn']))
{	
$guncelle = $db -> prepare("UPDATE [RANDEVU_KAYDET]
   SET [musteriAd] = :musteriAd
      ,[musteriSoyad] = :musteriSoyad
      ,[musteriTc] = :musteriTc
      ,[musteriTel] = :musteriTel
      ,[randevuTarihi] = :randevuTarihi
      ,[randevuSaati] = :randevuSaati
      ,[biletNo] = :biletNo
      ,[randevuTalepSayisi] = :randevuTalepSayisi
 WHERE id=:id");		

				$guncelle->bindParam(':musteriAd', $_POST['musteriAd']); //parametre tanımla					
				$guncelle->bindParam(':musteriSoyad', $_POST['musteriSoyad']); //parametre tanımla					
				$guncelle->bindParam(':musteriTc', $_POST['musteriTc']); //parametre tanımla					
				$guncelle->bindParam(':musteriTel', $_POST['musteriTel']); //parametre tanımla					
				$guncelle->bindParam(':randevuTarihi', $randevuTarihi); //parametre tanımla					
				$guncelle->bindParam(':randevuSaati', $randevuSaati); //parametre tanımla	
$randevuTarihi = date("Y-m-d", strtotime($_POST['randevuTarihi']." ".$_POST['randevuSaati'])) ; //randevu tarihi	
$randevuSaati = date("H:i:s", strtotime($_POST['randevuTarihi']." ".$_POST['randevuSaati'])) ; //randevu saati					
				$guncelle->bindParam(':biletNo', $_POST['biletNo']); //parametre tanımla					
				$guncelle->bindParam(':randevuTalepSayisi', $_POST['randevuTalepSayisi']); //parametre tanımla					
				$guncelle->bindParam(':id', $_POST['id']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&ana&ok=2&#git"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&ana&hata=1&#git");}
}

?>
<?php
if(isset($_POST['oturumDurumBtn']))
{	
$guncelle = $db -> prepare("UPDATE [RANDEVU_AYAR]
   SET [oturumSuresi] = :oturumSuresi
      ,[oturumSuresiGoster] = :oturumSuresiGoster
 WHERE GRPID=:GRPID");		

				$guncelle->bindParam(':oturumSuresi', $_POST['oturumSuresi']); //parametre tanımla					
				$guncelle->bindParam(':oturumSuresiGoster', $oturumSuresiGoster); //parametre tanımla								
if($_POST['oturumSuresiGoster']=="on"){ $oturumSuresiGoster=true;}else{ $oturumSuresiGoster=false;}								
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&oturum&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&oturum&hata=1");}
}

?><?php
if(isset($_POST['dogrulamaKoduBtn']))
{	
$guncelle = $db -> prepare("UPDATE [RANDEVU_AYAR]
   SET dogrulamaKoduGoster = :dogrulamaKoduGoster
 WHERE GRPID=:GRPID");		
			
				$guncelle->bindParam(':dogrulamaKoduGoster', $dogrulamaKoduGoster); //parametre tanımla								
if($_POST['dogrulamaKoduGoster']=="on"){ $dogrulamaKoduGoster=true;}else{ $dogrulamaKoduGoster=false;}								
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&oturum&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&oturum&hata=1");}
}

?>
<?php
if(isset($_POST['epostaAyarBtn']) && isset($_GET['guncelle']))
{	
$guncelle = $db -> prepare("UPDATE [RANDEVU_EPOSTA_AYAR]
   SET host=:host,port=:port,username=:username,password=:password,fromMesaj=:fromMesaj,subject=:subject,Aktif=:Aktif
 WHERE GRPID=:GRPID");		
			
				$guncelle->bindParam(':host', $_POST['host']); 								
				$guncelle->bindParam(':port', $_POST['port']); 								
				$guncelle->bindParam(':username', $_POST['username']); 								
				$guncelle->bindParam(':password', $_POST['password']); 								
				$guncelle->bindParam(':fromMesaj', $_POST['fromMesaj']); 								
				$guncelle->bindParam(':subject', $_POST['subject']); 								
				$guncelle->bindParam(':Aktif', $_POST['Aktif']); 															
				$guncelle->bindParam(':GRPID', $_POST['GRPID']); //parametre tanımla					
				$guncelle->execute(); //sorguyu çalıştır
				if($guncelle->rowCount()>0)
				{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&mail&ok=2"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&mail&hata=1");}
}

?>