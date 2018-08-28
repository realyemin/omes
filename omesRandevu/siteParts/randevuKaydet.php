<?php /*
	-- =============================================
	-- Author:		EKOMURCU
	-- Create date: 15.04.2018
	-- Description:	Kişi ve Randevu Bilgilerini(kon.php den) Ajax ile kaydetmek için yazıldı
	-- ============================================= 
*/?>
<?php
	include($_SERVER['DOCUMENT_ROOT']."/Connections/baglantim.php");
	include($_SERVER['DOCUMENT_ROOT']."/veriler/gruplar.php");//grup bilgisi ile hangi servise randevu verileceği seçilir
	include($_SERVER['DOCUMENT_ROOT']."/veriler/terminal_grup.php");//grup bilgisi ile hangi terminale randevu verileceği seçilir
	include($_SERVER['DOCUMENT_ROOT']."/fonksiyonlar/php/turkceTarih.php");
    try
    {       
        if ($db)
		{
			
			if(isset($_POST['tarih']) && isset($_POST['saat']) && isset($_POST['ad']) && isset($_POST['soyad']) && isset($_POST['tc']) && isset($_POST['tel']) && isset($_POST['eposta']) && isset($_POST['GRPID']) && isset($_POST['IPAdresi']))
			{
		#ortak parametrik değerler
		$tarih=$_POST['tarih'];
		$saat=$_POST['saat'];
		$musteriTc=$_POST['tc'];
		$musteriTel =$_POST['tel'] ;
		$musteriEposta=$_POST['eposta'];
		$musteriAd=$_POST['ad'];
		$musteriSoyad=$_POST['soyad'];
		$GRPID=$_POST['GRPID'];
		$IPAdresi=$_POST['IPAdresi'];
		$kayitTarihi =date("Y-m-d H:i:s");	
		$RandevuTarihi =date("Y-m-d H:i:s", strtotime($tarih." ".$saat)) ; //randevu tarihi		
		$RandevuSaati = date("H:i:s", strtotime($tarih." ".$saat)) ; //randevu saati
		$bilet=explode(":",$saat);
		$biletNo = intval($bilet[0].$bilet[1]);
		$tid = $terminal_grup['TID'];
		$RandevuTarihiMesaj = turkcetarih("d-F-Y, l", $tarih)." Saat:".date("H:i",strtotime($saat)); //randevu tarihi mesaj ekranı					
		$MusteriAdiSoyadi = $musteriAd." ".$musteriSoyad;
					
				$db->beginTransaction(); //Transaction başlat
				#->randevu alma sayısını sınırla							
				
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
						
						$mesaj="<div class='button kirmizi' style='margin:10%;'><strong>Randevu alma limitiniz dolmuştur. Lütfen yerinde randevu alınız.</strong></div>";	
						echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 
						exit;
					}
					
				}
				else{$randevuTalepSayisi=(int)($randevuKontrol['randevuTalepSayisi'])+1;}//sınırsız bilet
				#->randevu alma sayısını sınırla								
				$biletler = $db->query("SELECT * FROM BILETLER WHERE SIS_TAR='$RandevuTarihi' and BILET_NO='$biletNo'", PDO::FETCH_ASSOC);
				if ( $biletler->rowCount() ){
					$durum=true;//modal olarak göster(true)	
					$mailAt=false;
					$mesaj="<div class='alert alert-danger'><strong>[".$RandevuTarihiMesaj."]</strong><br> Randevu doludur. Lütfen başka bir randevu tarihi seçiniz.</div>";	
				}
				else
				{		
					#Region Randevulu Üye Kaydı	Başlangic
					$kullaniciKontrol=$db->query("SELECT * FROM RANDEVU_KULLANICI WHERE musteriTc = $_POST[tc] ")->fetchAll();
					if(count($kullaniciKontrol)>0) //kullanıcı daha önce randevu almış ise bilgi güncelle
					{
						$kullaniciGNC = $db -> prepare("UPDATE RANDEVU_KULLANICI
						SET musteriAd = :musteriAd,musteriSoyad = :musteriSoyad,
						musteriTel = :musteriTel, musteriEposta = :musteriEposta, IPAdresi = :IPAdresi
						WHERE musteriTc = :musteriTc");		
						$kullaniciGNC->bindParam(':musteriAd', $musteriAd);
						$kullaniciGNC->bindParam(':musteriSoyad', $musteriSoyad);				
						$kullaniciGNC->bindParam(':musteriTel', $musteriTel);
						$kullaniciGNC->bindParam(':musteriEposta', $musteriEposta);
						$kullaniciGNC->bindParam(':IPAdresi', $IPAdresi);
						$kullaniciGNC->bindParam(':musteriTc', $musteriTc);																		
						$kullaniciGNC->execute();
						
						}else{ //yeni kullanıcı kaydı yapılacaksa
						$kullaniciEkle = $db -> prepare("INSERT INTO RANDEVU_KULLANICI
						([musteriAd],[musteriSoyad],[musteriTc],[musteriTel],[musteriEposta],[kayitTarihi],[IPAdresi]) 
						VALUES(:musteriAd, :musteriSoyad, :musteriTc, :musteriTel, :musteriEposta, :kayitTarihi, :IPAdresi)");		
						$kullaniciEkle->bindParam(':musteriAd', $musteriAd);
						$kullaniciEkle->bindParam(':musteriSoyad', $musteriSoyad);
						$kullaniciEkle->bindParam(':musteriTc', $musteriTc);
						$kullaniciEkle->bindParam(':musteriTel', $musteriTel);
						$kullaniciEkle->bindParam(':musteriEposta', $musteriEposta);
						$kullaniciEkle->bindParam(':kayitTarihi', $kayitTarihi);
						$kullaniciEkle->bindParam(':IPAdresi', $IPAdresi);										
						$kullaniciEkle->execute();
					}	
					#Region Randevulu Üye Kaydı	Bitiş
					
					#Biletler tablosuna ekle
					$biletler = $db -> prepare("INSERT INTO BILETLER(TID,GRPID,BILET_NO,SIS_TAR,MusteriNo,MusteriAdi,Zaman,S_YF1) VALUES(:tid, :grpid, :biletNo, :randevutarihi, :MusteriNo, :MusteriAdi, :zaman, :tel)");		
					$biletler->bindParam(':tid', $tid);
					$biletler->bindParam(':grpid', $GRPID);
					$biletler->bindParam(':biletNo', $biletNo);
					$biletler->bindParam(':randevutarihi', $RandevuTarihi);
					$biletler->bindParam(':MusteriNo', $musteriTc);
					$biletler->bindParam(':MusteriAdi', $MusteriAdiSoyadi);
					$biletler->bindParam(':zaman', $kayitTarihi);
					$biletler->bindParam(':tel', $musteriTel);									
					$biletler->execute(); 						
					#Biletler tablosuna ekle
					
					#Kuyruk tablosuna ekle		
					$bid = $db -> query("SELECT IDENT_CURRENT('BILETLER')")->fetch();
					$bid=$bid[0];//mevcut bilet id
					$kuyruk = $db -> prepare("INSERT INTO KUYRUK(BID,GRPID,BILET_NO,S_YF1) VALUES(:bid, :grpid, :biletNo, :S_YF1)");		
					$kuyruk->bindParam(':bid', $bid);
					$kuyruk->bindParam(':grpid', $GRPID);
					$kuyruk->bindParam(':biletNo', $biletNo);				
					$kuyruk->bindParam(':S_YF1', $musteriTc);
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
					$randevular->bindParam(':GRPID', $GRPID);
					$randevular->bindParam(':BID', $bid);
					$randevular->bindParam(':musteriAd', $musteriAd);
					$randevular->bindParam(':musteriSoyad', $musteriSoyad);
					$randevular->bindParam(':musteriTc', $musteriTc);
					$randevular->bindParam(':musteriTel', $musteriTel);
					$randevular->bindParam(':randevuTarihi', $RandevuTarihi);
					$randevular->bindParam(':randevuSaati', $RandevuSaati);
					$randevular->bindParam(':biletNo', $biletNo);
					$randevular->bindParam(':randevuKayitTarihi', $kayitTarihi);				
					$randevular->bindParam(':randevuTalepSayisi', $randevuTalepSayisi); //ilk kayıtta 1
					$randevular->bindParam(':IPAdresi', $IPAdresi);
					$randevular->execute(); //sorguyu çalıştır
					#Web Randevu Rapor Ekranı için istatistiki bilgiler
					
					$durum=true;
					$mailAt=false;
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
			$db->rollBack();//hata varsa vt değişikliğini geri al
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
		
		if($mailAt)
		{
			
			$epostaAyar=$db->query("SELECT * FROM RANDEVU_EPOSTA_AYAR WHERE GRPID = '$GRPID'")->fetch();
			if($epostaAyar['Aktif'] && isset($musteriEposta) && $musteriEposta!="" && $musteriEposta!='false')
			{
				include($_SERVER['DOCUMENT_ROOT']."/fonksiyonlar/php/phpMail/mailGonder.php");
				MailGonder($musteriTc,$musteriEposta,$mesaj,$epostaAyar);
			}
			
		}
		
		echo '{"durum":"'.$durum.'", "mesaj":"'.$mesaj.'"}'; 	
		
	}
?>			