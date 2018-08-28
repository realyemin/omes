<?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 15.04.2018
-- Description:	Kişi ve Randevu Bilgilerini(kon.php den) Ajax ile kaydetmek için yazıldı
-- ============================================= 
 */?>
<?php
require("baglanti.php");
    try
    {       
        if ($db)
		{
		    	  
			if(isset($_POST['tarih']) && isset($_POST['saat']) && isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['tc']) && isset($_POST['tel']))
			{
				$RandevuTarihi =date("Y-m-d H:i:s", strtotime($_POST['tarih']." ".$_POST['saat'])) ; //randevu tarihi				
				$saat=explode(":",$_POST['saat']);
				$biletNo = intval($saat[0].$saat[1]);
				
			$gruplar = $db -> query("SELECT top 1 * FROM GRUPLAR WHERE Webrandevu=1")->fetch();
			$biletler = $db->query("SELECT * FROM BILETLER WHERE SIS_TAR='$RandevuTarihi' and BILET_NO='$biletNo'", PDO::FETCH_ASSOC);
				if ( $biletler->rowCount() ){
				
				
					$durum=false;
					$mesaj="Üzgünüz![".$_POST['tarih']."-".$_POST['saat']."] Randevu doludur. Lütfen başka bir randevu tarihi seçiniz.";
				
				}
				else
				{				
		/*
				echo "Grup ID:".$gruplar["GRPID"]."<br>";
				echo "Grup Adı:".$gruplar["GRUP_ISMI"]."<br>";
				echo "Min Hizmet Süresi:".$gruplar["MIN_HIZMET_SURESI"]."<br>";
				echo "Mesai baş:".$gruplar["MESAI_BAS"]."</br>";
				echo "Mesai Bitiş:".$gruplar["MESAI_BIT"]."</br>";
				echo "Öğle Baş:".$gruplar["OGLE_BAS"]."</br>";
				echo "Öğle Bitiş:".$gruplar["OGLE_BIT"]."<hr>";
		*/
				$biletler = $db -> prepare("INSERT INTO BILETLER(TID,GRPID,BILET_NO,SIS_TAR,MusteriNo,MusteriAdi,Zaman,S_YF1) VALUES(:tid, :grpid, :biletNo, :randevutarihi, :MusteriNo, :MusteriAdi, :zaman, :tel)");		
				$biletler->bindParam(':tid', $tid);
				$biletler->bindParam(':grpid', $grpid);
				$biletler->bindParam(':biletNo', $biletNo);
				$biletler->bindParam(':randevutarihi', $RandevuTarihi);
				$biletler->bindParam(':MusteriNo', $MusteriNo);
				$biletler->bindParam(':MusteriAdi', $MusteriAdi);
				$biletler->bindParam(':zaman', $zaman);
				$biletler->bindParam(':tel', $tel);
				
			
				// bir satır veri girelim
				$tid = 33;
				$grpid = $gruplar["GRPID"];
				$saat=explode(":",$_POST['saat']);
				$biletNo = intval($saat[0].$saat[1]);
				$RandevuTarihi = date("Y-m-d H:i", strtotime($_POST['tarih']." ".$_POST['saat'])) ; //randevu tarihi
				$MusteriNo = $_POST['tc']; //tc yazılacak
				$MusteriAdi = $_POST['ad']." ".$_POST['soyad'];
				$zaman =date("Y-m-d H:i:s") ; //randevu kayıt tarihi(zaman)
				$tel =$_POST['tel'] ; //müsteri tel
				$biletler->execute(); //sorguyu çalıştır
				
				$bid = $db -> query("SELECT IDENT_CURRENT('BILETLER')")->fetch();
				$bid=$bid[0];//mevcut bilet id
				$kuyruk = $db -> prepare("INSERT INTO KUYRUK(BID,GRPID,BILET_NO) VALUES(:bid, :grpid, :biletNo)");		
				$kuyruk->bindParam(':bid', $bid);
				$kuyruk->bindParam(':grpid', $grpid);
				$kuyruk->bindParam(':biletNo', $biletNo);
				
				$kuyruk->execute(); //sorguyu çalıştır
										
				
				/*
					$biletler = $db -> query("SELECT top 10 * FROM BILETLER ORDER BY BID DESC")->fetchAll();
				//Kayıt sayısı ekrana bastırılacak.
			   // echo count($biletler)."</br>";
				foreach ($biletler as $item)
				{
					echo "Terminal ID:".$item["TID"]."<br>";
					echo "Grup ID:".$item["GRPID"]."<br>";
					echo "BİLET NO:".$item["BILET_NO"]."<br>";
					echo "SIS_TAR:".$item["SIS_TAR"]."</br>";
					echo "MusteriNo:".$item["MusteriNo"]."</br>";
					echo "MusteriAdi:".$item["MusteriAdi"]."<hr>";			
				}
				*/
				
				$durum=true;
				$mesaj= "<div style='margin:20px; font-size:18pt;'>Randevunuz Kaydedildi<br> <h2 class='button mavi' style='font-size:18pt;'>Randevu Tarihi: [".$RandevuTarihi."]</h2></div><div style='margin:20px; font-size:18pt;'><h2 class='button mavi' style='font-size:18pt;'>Bilet No:[".$biletNo."]</h2></div>";
				}
			}
			else
			{
				$durum=false;
				$mesaj= "İşleminiz gerçekleştirilemedi! Lütfen tekrar deneyiniz.";
			}
			
		}
    }
    catch (Exception $exception)
    {
		$durum=false;
		$mesaj= $exception->getMessage();
    }
	finally {
		echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 	
	}
?>