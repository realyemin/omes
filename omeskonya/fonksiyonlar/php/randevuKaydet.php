<?php /*
	-- =============================================
	-- Author:		EKOMURCU
	-- Create date: 15.04.2018
	-- Description:	Kişi ve Randevu Bilgilerini(kon.php den) Ajax ile kaydetmek için yazıldı
	-- ============================================= 
*/?>
<?php
	include("../../Connections/baglantim.php");
	include("turkceTarih.php");
	include("../../veriler/gruplar.php");//grup bilgisi ile hangi servise randevu verileceği seçilir
	include("../../veriler/terminal_grup.php");//grup bilgisi ile hangi terminale randevu verileceği seçilir
    try
    {       
        if ($db)
		{
			$db->beginTransaction(); //Transaction başlat
			if(isset($_POST['tarih']) && isset($_POST['saat']) && isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['tc']) && isset($_POST['tel']) && isset($_POST['GRPID']) && isset($_POST['IPAdresi']))
			{				
				#->randevu alma sayısını sınırla
				$musteriTc=$_POST['tc'];
				$musteriTel =$_POST['tel'] ;
				$randevuKontrol = $db -> query("SELECT MAX(randevuTalepSayisi) AS randevuTalepSayisi FROM RANDEVU_KAYDET 
				WHERE (musteriTc = '$musteriTc') OR (musteriTel = '$musteriTel')")->fetch();
				
				$biletSinirla = $db -> query("SELECT * FROM RANDEVU_AYAR WHERE GRPID='$GRPID'")->fetch(); //burası terminale göre ayarlanabilir!ertu
				
				if($biletSinirla['biletSinirla']) //bilet sinirlama ayarı açıksa
				{				
					if($randevuKontrol['randevuTalepSayisi'] < $biletSinirla['biletSinirSayisi'])
					{ 	
						$randevuTalepSayisi=(int)($randevuKontrol['randevuTalepSayisi'])+1; //talep tekrar ediliyorsa	
					}
					else
					{
						$durum=true;//modal olarak göster(true)	
						
						$mesaj="<div class='button kirmizi' style='margin:10%;'>Üzgünüz! Randevu alma limitiniz dolmuştur. Lütfen yerinde randevu alınız.</div>";	
						echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 
						exit;
					}
					
				}
				else{$randevuTalepSayisi=(int)($randevuKontrol['randevuTalepSayisi'])+1;}//sınırsız bilet
				#->randevu alma sayısını sınırla
				
				$RandevuTarihi =date("Y-m-d H:i:s", strtotime($_POST['tarih']." ".$_POST['saat'])) ; //randevu tarihi				
				$saat=explode(":",$_POST['saat']);
				$biletNo = intval($saat[0].$saat[1]);
				
				
				$biletler = $db->query("SELECT * FROM BILETLER WHERE SIS_TAR='$RandevuTarihi' and BILET_NO='$biletNo'", PDO::FETCH_ASSOC);
				if ( $biletler->rowCount() ){
					
					
					$durum=true;//modal olarak göster(true)	
					$mesaj="Üzgünüz![".$_POST['tarih']."-".$_POST['saat']."] Randevu doludur. Lütfen başka bir randevu tarihi seçiniz.";
					
				}
				else
				{		
					#Region Randevulu Üye Kaydı	Başlangic
					
					$kullaniciKontrol=$db->query("SELECT * FROM RANDEVU_KULLANICI WHERE musteriTc = $_POST[tc] ")->fetchAll();
					if(count($kullaniciKontrol)>0) //kullanıcı daha önce randevu almış ise bilgi güncelle
					{
						$kullaniciGNC = $db -> prepare("UPDATE RANDEVU_KULLANICI
						SET musteriAd = :musteriAd,musteriSoyad = :musteriSoyad,
						musteriTel = :musteriTel, IPAdresi = :IPAdresi
						WHERE musteriTc = :musteriTc");		
						$kullaniciGNC->bindParam(':musteriAd', $musteriAd);
						$kullaniciGNC->bindParam(':musteriSoyad', $musteriSoyad);				
						$kullaniciGNC->bindParam(':musteriTel', $musteriTel);				
						$kullaniciGNC->bindParam(':IPAdresi', $IPAdresi);
						$kullaniciGNC->bindParam(':musteriTc', $musteriTc);
						
						$musteriAd = $_POST['ad'];
						$musteriSoyad = $_POST['soyad'];											
						$musteriTel =$_POST['tel'];					
						$kayitTarihi =date("Y-m-d H:i:s") ;				
						$IPAdresi =$_POST['IPAdresi'] ;	
						$musteriTc = $_POST['tc']; 				
						$kullaniciGNC->execute();
						}else{ //yeni kullanıcı kaydı yapılacaksa
						$kullaniciEkle = $db -> prepare("INSERT INTO RANDEVU_KULLANICI
						([musteriAd],[musteriSoyad],[musteriTc],[musteriTel],[kayitTarihi],[IPAdresi]) 
						VALUES(:musteriAd, :musteriSoyad, :musteriTc, :musteriTel, :kayitTarihi, :IPAdresi)");		
						$kullaniciEkle->bindParam(':musteriAd', $musteriAd);
						$kullaniciEkle->bindParam(':musteriSoyad', $musteriSoyad);
						$kullaniciEkle->bindParam(':musteriTc', $musteriTc);
						$kullaniciEkle->bindParam(':musteriTel', $musteriTel);				
						$kullaniciEkle->bindParam(':kayitTarihi', $kayitTarihi);
						$kullaniciEkle->bindParam(':IPAdresi', $IPAdresi);
						
						$musteriAd = $_POST['ad'];
						$musteriSoyad = $_POST['soyad'];	
						$musteriTc = $_POST['tc']; 							
						$musteriTel =$_POST['tel'];						
						$kayitTarihi =date("Y-m-d H:i:s") ;				
						$IPAdresi =$_POST['IPAdresi'] ;				
						$kullaniciEkle->execute();
					}	
					#Region Randevulu Üye Kaydı	Bitiş
					
					#Biletler tablosuna ekle
					$biletler = $db -> prepare("INSERT INTO BILETLER(TID,GRPID,BILET_NO,SIS_TAR,MusteriNo,MusteriAdi,Zaman,S_YF1) VALUES(:tid, :grpid, :biletNo, :randevutarihi, :MusteriNo, :MusteriAdi, :zaman, :tel)");		
					$biletler->bindParam(':tid', $tid);
					$biletler->bindParam(':grpid', $grpid);
					$biletler->bindParam(':biletNo', $biletNo);
					$biletler->bindParam(':randevutarihi', $RandevuTarihi);
					$biletler->bindParam(':MusteriNo', $MusteriNo);
					$biletler->bindParam(':MusteriAdi', $MusteriAdi);
					$biletler->bindParam(':zaman', $zaman);
					$biletler->bindParam(':tel', $tel);
					
					// veriler
					$tid = $terminal_grup['TID'];
					$grpid = $GRPID;
					$saat=explode(":",$_POST['saat']);
					$biletNo = intval($saat[0].$saat[1]);
					$RandevuTarihi = date("Y-m-d H:i", strtotime($_POST['tarih']." ".$_POST['saat'])) ; //randevu tarihi				
					$RandevuTarihiMesaj = turkcetarih("d-F-Y, l", $_POST['tarih'])." Saat:".date("H:i",strtotime($_POST['saat'])); //randevu tarihi mesaj ekranı
					$MusteriNo = $_POST['tc']; //tc yazılacak
					$MusteriAdi = $_POST['ad']." ".$_POST['soyad'];
					$zaman =date("Y-m-d H:i:s") ; //randevu kayıt tarihi(zaman)
					$tel =$_POST['tel'] ; //müsteri tel
					$biletler->execute(); 						
					#Biletler tablosuna ekle
					
					#Kuyruk tablosuna ekle		
					$bid = $db -> query("SELECT IDENT_CURRENT('BILETLER')")->fetch();
					$bid=$bid[0];//mevcut bilet id
					$kuyruk = $db -> prepare("INSERT INTO KUYRUK(BID,GRPID,BILET_NO,S_YF1) VALUES(:bid, :grpid, :biletNo, :S_YF1)");		
					$kuyruk->bindParam(':bid', $bid);
					$kuyruk->bindParam(':grpid', $grpid);
					$kuyruk->bindParam(':biletNo', $biletNo);				
					$kuyruk->bindParam(':S_YF1', $_POST['tc']);
					//kuyruk tablosuna S_YF1 yedek alanına müsteri tc'si eklendi.
					//(yönetim ekranıdan müsteriye ait randevuların toplu silinmesi istendiği için 02.07.2018)
					$kuyruk->execute(); //sorguyu çalıştır
					#Kuyruk tablosuna ekle
					
					#Web Randevu Rapor Ekranı için istatistiki bilgiler	
					$randevular = $db -> prepare("INSERT INTO RANDEVU_KAYDET
					(TID,GRPID,BID,musteriAd,musteriSoyad,musteriTc,musteriTel,randevuTarihi,
					randevuSaati,biletNo,randevuKayitTarihi,randevuTalepSayisi, IPAdresi) 
					VALUES(:TID,:GRPID,:BID,:musteriAd,:musteriSoyad,:musteriTc,:musteriTel,:randevuTarihi,
					:randevuSaati,:biletNo,:randevuKayitTarihi,:randevuTalepSayisi, :IPAdresi)");		
					$randevular->bindParam(':TID', $tid);
					$randevular->bindParam(':GRPID', $grpid);
					$randevular->bindParam(':BID', $bid);
					$randevular->bindParam(':musteriAd', $musteriAd);
					$randevular->bindParam(':musteriSoyad', $musteriSoyad);
					$randevular->bindParam(':musteriTc', $musteriTc);
					$randevular->bindParam(':musteriTel', $musteriTel);
					$randevular->bindParam(':randevuTarihi', $randevuTarihi);
					$randevular->bindParam(':randevuSaati', $randevuSaati);
					$randevular->bindParam(':biletNo', $biletNo);
					$randevular->bindParam(':randevuKayitTarihi', $randevuKayitTarihi);				
					$randevular->bindParam(':randevuTalepSayisi', $randevuTalepSayisi); //ilk kayıtta 1
					$randevular->bindParam(':IPAdresi', $IPAdresi); //ilk kayıtta 1
					
					$tid = $terminal_grup['TID'];
					$grpid = $GRPID;
					$musteriAd = $_POST['ad'];
					$musteriSoyad = $_POST['soyad'];
					$musteriTc=$_POST['tc'];
					$musteriTel =$_POST['tel'] ;		
					$randevuTarihi = date("Y-m-d", strtotime($_POST['tarih']." ".$_POST['saat'])) ; //randevu tarihi	
					$randevuSaati = date("H:i:s", strtotime($_POST['tarih']." ".$_POST['saat'])) ; //randevu saati	
					$saat=explode(":",$_POST['saat']);
					$biletNo = intval($saat[0].$saat[1]);										
					$randevuKayitTarihi =date("Y-m-d H:i:s") ; //randevu kayıt tarihi(zaman)	
					$IPAdresi =$_POST['IPAdresi'] ;				
					$randevular->execute(); //sorguyu çalıştır
					#Web Randevu Rapor Ekranı için istatistiki bilgiler
					
					$durum=true;
					$icerik="<tr><td colspan='2'><h2>Randevunuz Kaydedildi<i class='icon-ok'></i></h2></td></tr><tr><td><h3>Servis Adı:</h3></td><td><h3 class='btn btn-primary form-control'>".$gruplar['GRUP_ISMI']."</h3></td></tr><tr><td><h3>Randevu Tarihi:</h3></td><td><h3 class='btn btn-warning form-control'>".$RandevuTarihiMesaj."</h3></td></tr><tr><td><h3>Bilet No:</h3></td><td><h3 class='btn btn-danger form-control'><strong>".$biletNo."</strong></h3></td></tr>";
					$mesaj= "<form target='_blank' action='PDF/make/pdfOlustur.php' method='post'><table class='table'>$icerik</table><input type='hidden' name='grp_ismi' value='$gruplar[GRUP_ISMI]' /><input type='hidden' name='adSoyad' value='$musteriAd $musteriSoyad' /><input type='hidden' name='RandevuTarihiMesaj' value='$RandevuTarihiMesaj' /><input type='hidden' name='biletNo' value='$biletNo' /><div><h3>Randevu günü ve saatini kaydetmeyi unutmayınız.</h3><br><button class='btn btn-warning'>İndir/Yazdır</button></div></form>";
					$db->commit();//işlem başarılı ise vtye işlet
				}
			}
			else
			{
				$durum=false;
				$mesaj= "İşleminiz gerçekleştirilemedi! Lütfen tekrar deneyiniz.";
			}
			
		}
		else{
			$durum=false;		
			$mesaj="Bağlantı hatası";
		}
	}
	catch (Exception $exception)
	{
		$durum=false;
		$db->rollBack();//hata varsa vt değişikliğini geri al
		$mesaj= $exception->getMessage();
	}
	finally {
		
		
		
		echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 	
		
	}
?>			