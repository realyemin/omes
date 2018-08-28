<?php include("../../Connections/baglantim.php");  ?>
<?php 
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 11.05.2018
-- Description:	Randevu Sistemi Yönetim Paneli (Toplu Silme:bütün silme işlemleri için tek sayfa) 
-- ============================================= 
 */
if(isset($_GET['tarihSil']))
{
	$tatilsil = $db->prepare("DELETE FROM RANDEVU_TATIL_AYAR WHERE id = :tarihID");
	$tatilsil->bindParam(':tarihID', $_GET['tarihSil']); //parametre tanımla	
	$tatilsil->execute(); //sorguyu çalıştır
	if($tatilsil)
	{ header("Location: ../../?WebRandevu&GRPID=$_GET[GRPID]&tatil&ok=3"); }else{  header("Location: ../../?WebRandevu&GRPID=$GET[GRPID]&tatil&hata=1");}
}
if(isset($_GET['tumTatilSil']))
{
	$tatilsil = $db->prepare("DELETE FROM RANDEVU_TATIL_AYAR WHERE GRPID = :GRPID");
	$tatilsil->bindParam(':GRPID', $_GET['GRPID']); //parametre tanımla	
	$tatilsil->execute(); //sorguyu çalıştır
	if($tatilsil)
	{ header("Location: ../../?WebRandevu&GRPID=$_GET[GRPID]&tatil&ok=3"); }else{  header("Location: ../../?WebRandevu&GRPID=$GET[GRPID]&tatil&hata=1");}
}
if(isset($_GET['tumRandevuSil']))
{
	$randevuKaydetSil = $db->prepare("DELETE FROM RANDEVU_KAYDET WHERE GRPID = :GRPID");
	$randevuKaydetSil->bindParam(':GRPID', $_GET['GRPID']); //parametre tanımla
	$randevuKaydetSil->execute(); //sorguyu çalıştır
	if($randevuKaydetSil)
	{
	$randevuKuyrukSil = $db->prepare("DELETE FROM KUYRUK WHERE GRPID = :GRPID");
	$randevuKuyrukSil->bindParam(':GRPID', $_GET['GRPID']); //parametre tanımla
	$randevuKuyrukSil->execute(); //sorguyu çalıştır
	
	$randevuBiletSil = $db->prepare("DELETE FROM BILETLER WHERE GRPID = :GRPID");
	$randevuBiletSil->bindParam(':GRPID', $_GET['GRPID']); //parametre tanımla	
	$randevuBiletSil->execute(); //sorguyu çalıştır
	
	 header("Location: ../../?WebRandevu&GRPID=$_GET[GRPID]&ana&ok=3&#git"); }else{ header("Location: ../../?WebRandevu&GRPID=$_GET[GRPID]&ana&hata=1&#git"); }
}
if(isset($_POST['randevuSilTekBtn']))
{
	
		
	$randevusil = $db->prepare("DELETE FROM RANDEVU_KAYDET WHERE id = :id");
	$randevusil->bindParam(':id', $_POST['id']); //parametre tanımla	
	$randevusil->execute(); //sorguyu çalıştır
	if($randevusil)
	{
	$GRPID=$_POST['GRPID'];
	$tc=$_POST['musteriTc'];
	$SIS_TAR=substr($_POST['randevuTarihi']." ".$_POST['randevuSaati'],0,23);
	
	$biletiID=$db->query("SELECT BID FROM BILETLER WHERE GRPID='$GRPID' AND MusteriNo='$tc' AND SIS_TAR='$SIS_TAR'")->fetch();
		
	$biletSil=$db->prepare("DELETE FROM BILETLER WHERE GRPID = :GRPID AND MusteriNo = :MusteriNo AND SIS_TAR = :SIS_TAR");
	$biletSil->bindParam(':GRPID',$GRPID, PDO::PARAM_INT);
	$biletSil->bindParam(':MusteriNo',$tc, PDO::PARAM_STR);
	$biletSil->bindParam(':SIS_TAR',$SIS_TAR,PDO::PARAM_STR);
	$GRPID=$_POST['GRPID'];
	$tc=$_POST['musteriTc'];
	$SIS_TAR=substr($_POST['randevuTarihi']." ".$_POST['randevuSaati'],0,23);	
	
	
	$kuyrukSil=$db->prepare("DELETE FROM KUYRUK WHERE BID=:BID");
	$kuyrukSil->bindParam(':BID',$biletiID['BID'], PDO::PARAM_INT);	
	//buraya commit ve rollback yapılabilir
	$biletSil->execute();
	$kuyrukSil->execute();

	header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&ana&ok=3&#git"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&ana&hata=1&#git"); }
	
}
if(isset($_POST['randevuSilTumuBtn']))
{

	$randevusil = $db->prepare("DELETE FROM RANDEVU_KAYDET WHERE musteriTc = :musteriTc");
	$randevusil->bindParam(':musteriTc', $_POST['musteriTc']); //parametre tanımla	
	$randevusil->execute(); //sorguyu çalıştır
	if($randevusil)
	{ 
	$biletSil=$db->prepare("DELETE FROM BILETLER WHERE MusteriNo = :MusteriNo");
	$biletSil->bindParam(':MusteriNo',$_POST['musteriTc'], PDO::PARAM_INT);
	
	$kuyrukSil=$db->prepare("DELETE FROM KUYRUK WHERE S_YF1=:MusteriNo");
	$kuyrukSil->bindParam(':MusteriNo',$_POST['musteriTc'], PDO::PARAM_INT);	
	
	$biletSil->execute();
	$kuyrukSil->execute();
header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&ana&ok=3&#git"); }else{ header("Location: ../../?WebRandevu&GRPID=$_POST[GRPID]&ana&hata=1&#git"); }
}
?>