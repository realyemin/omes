<?php
	include("../../Connections/baglantim.php");
	
	
	try
	{	
		if(isset($_POST['randevuId']) && isset($_POST['tc']) && isset($_POST['GRPID']) && isset($_POST['randevuTarihi']) && isset($_POST['randevuSaati']))
		{
			$db->beginTransaction(); //Transaction başlat
			$GRPID=$_POST['GRPID'];
			$tc=$_POST['tc'];		
			$SIS_TAR=substr($_POST['randevuTarihi']." ".$_POST['randevuSaati'],0,23);
			
			$biletiID=$db->query("SELECT BID FROM BILETLER WHERE GRPID='$GRPID' AND MusteriNo='$tc' AND SIS_TAR='$SIS_TAR'")->fetch();
			
			$biletSil=$db->prepare("DELETE FROM BILETLER WHERE GRPID = :GRPID AND MusteriNo = :MusteriNo AND SIS_TAR = :SIS_TAR");
			$biletSil->bindParam(':GRPID',$GRPID, PDO::PARAM_INT);
			$biletSil->bindParam(':MusteriNo',$tc, PDO::PARAM_STR);
			$biletSil->bindParam(':SIS_TAR',$SIS_TAR,PDO::PARAM_STR);
			$GRPID=$_POST['GRPID'];
			$tc=$_POST['tc'];
			$SIS_TAR=substr($_POST['randevuTarihi']." ".$_POST['randevuSaati'],0,23);	
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
					$db->commit();//işlem başarılı ise vtye işlet
					$mesaj="<div style='margin:20px; font-size:18pt;'>Randevunuz iptal edildi.<i class='icon-ok' style='font-size: 40px'></i>";
				}
				else
				{
					$durum=false;				
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
		echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 	
	}
	
?>