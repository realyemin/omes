<?php
	include("../Connections/baglantim.php");
	include($_SERVER['DOCUMENT_ROOT']."/fonksiyonlar/php/turkceTarih.php");
	
	try
	{	
		if(isset($_POST['randevuId']) && isset($_POST['tc']) && isset($_POST['GRPID']) && isset($_POST['randevuTarihi']) && isset($_POST['randevuSaati']))
		{
			$db->beginTransaction(); //Transaction başlat
			$GRPID=$_POST['GRPID'];
			$tc=$_POST['tc'];
			$eposta=$_POST['eposta'];
			
			$SIS_TAR=substr($_POST['randevuTarihi']." ".$_POST['randevuSaati'],0,23);
			
			$biletiID=$db->query("SELECT BID FROM BILETLER WHERE GRPID='$GRPID' AND MusteriNo='$tc' AND SIS_TAR='$SIS_TAR'")->fetch();
			
			$biletSil=$db->prepare("DELETE FROM BILETLER WHERE GRPID = :GRPID AND MusteriNo = :MusteriNo AND SIS_TAR = :SIS_TAR");
			$biletSil->bindParam(':GRPID',$GRPID, PDO::PARAM_INT);
			$biletSil->bindParam(':MusteriNo',$tc, PDO::PARAM_STR);
			$biletSil->bindParam(':SIS_TAR',$SIS_TAR,PDO::PARAM_STR);
			$biletSil->execute();
			
			$kuyrukSil=$db->prepare("DELETE FROM KUYRUK WHERE BID=:BID");
			$kuyrukSil->bindParam(':BID',$biletiID['BID'], PDO::PARAM_INT);	
			$kuyrukSil->execute();
			
			if($biletSil->rowCount()>0 && $kuyrukSil->rowCount()>0)
			{
				
				$randevuGuncelle=$db->prepare("UPDATE RANDEVU_KAYDET SET IPTAL = 1 WHERE id = :id");
				$randevuGuncelle->bindParam(':id',$randevuId, PDO::PARAM_INT);
				$randevuId=$_POST['randevuId'];
				$randevuGuncelle->execute();
				
				if($randevuGuncelle->rowCount()>0)
				{
					$durum=true;
					$mailAt=false;
					$db->commit();//işlem başarılı ise vtye işlet
					$tarih=substr($SIS_TAR,0,10);
					$saat=substr($SIS_TAR,11,5);
					$mesaj ="<div class='alert alert-danger'>Telebiniz Üzerine<br><strong>".turkcetarih("d F Y, l", $tarih)." Saat:".$saat."</strong> tarihli";
					$mesaj.="<div style='margin:20px; font-size:18pt;'>Randevunuz iptal edildi.<i class='icon-ok' style='font-size: 40px'></i></div></div>";
				}
				else
				{
					$durum=false;
					$db->rollBack();//hata varsa vt değişikliğini geri al
					$mesaj="Tekrar deneyiniz..";
				}
			}
		}
	}
	catch (Exception $exception)
	{
		$durum=false;
		$db->rollBack();//hata varsa vt değişikliğini geri al
		$mesaj= $exception->getMessage();
	}
	finally
	{
		if($mailAt)
		{
			
			$epostaAyar=$db->query("SELECT * FROM RANDEVU_EPOSTA_AYAR WHERE GRPID = '$GRPID'")->fetch();
			if($epostaAyar['Aktif'] && isset($eposta) && $eposta!="" && $eposta!='false')
			{
				$musteriEposta=$_POST['eposta'];
				include($_SERVER['DOCUMENT_ROOT']."/fonksiyonlar/php/phpMail/mailGonder.php");
				MailGonder($tc,$musteriEposta,$mesaj,$epostaAyar);
			}
			
		}
		echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 	
	}
	
?>