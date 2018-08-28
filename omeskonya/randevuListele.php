<?php 
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 16.04.2018
-- Revize date: 04.06.2018
-- Description:	Randevu Bilgilerini(randevu.php den) Ajax ile almak için yazıldı
-- ============================================= 
 */

  if(!isset($_SESSION))
{
	session_start();		
}
if(!isset($_SESSION['onay'])){  }else{ session_destroy(); unset($_SESSION['onay']);}
if(isset($_SESSION['oturum'])){ echo "<script> window.location='index.php'; </script>";  }

include("Connections/baglantim.php");
require("veriler/gruplar.php");
$oturumSureGoster=-1;
if(isset($_POST['tarih']) && $_POST['tarih']!="" && $_POST['tarih']!="Tarih Seçin" && $grupDurum)
{	
	if(!isset($_SESSION["sure"]))
	{
		$oturumSuresi = $db->query("SELECT oturumSuresi, oturumSuresiGoster FROM RANDEVU_AYAR WHERE GRPID='$GRPID'")->fetch();	
		if($oturumSuresi["oturumSuresiGoster"])
		{
			$oturumSureGoster=true;
			$_SESSION["sure"]=time()+intval($oturumSuresi["oturumSuresi"]*60); //dk cinsiden oturum sayacı			
		}
		else{
			$oturumSureGoster=false;
		}
		
	}

		$RandevuTarihi =date("Y-m-d", strtotime($_POST['tarih'])) ; //randevu tarihi
		$tarih=$RandevuTarihi;
		$dizi=array();
		$biletler = $db->query("SELECT BILET_NO FROM BILETLER WHERE convert(varchar(10), [SIS_TAR], 120)='$tarih'", PDO::FETCH_ASSOC);
				if ( $biletler->rowCount() ){
				
				foreach( $biletler as $row ){
				array_push($dizi, $row['BILET_NO']);//alınan biletleri dizeye at
				
					}
				}
$tatil = $db->query("SELECT tatilPeriyot,tatilAciklama FROM RANDEVU_TATIL_AYAR WHERE tatilTarihi='$RandevuTarihi' AND GRPID='$GRPID'")->fetch();	
?>
<div class="row">
	<div class="col-md-4 col-xs-2"></div>
	<div class="col-md-2 col-xs-4 dolubos" >
		<input type="radio" disabled id="dolu"/>
			<label for="dolu">
				<p>Dolu Olan Saatler</p>
			</label>
	</div>&nbsp;
	<div class="col-md-2 col-xs-4 dolubos" >
		<input type="radio" checked id="bos" />
			<label for="bos">
				<p>Boş Olan Saatler</p>
			</label>
	</div>
	<div class="col-md-4 col-xs-2"></div>
</div>
	
<section>
<!--ÖĞLEDEN ÖNCE-->
	<?php
	$MESAI_BAS=explode(":",$gruplar['MESAI_BAS']); 
	$MESAI_BIT=explode(":",$gruplar['MESAI_BIT']); 
	$OGLE_BAS=explode(":",$gruplar['OGLE_BAS']); //12:00:00
	$OGLE_BIT=explode(":",$gruplar['OGLE_BIT']); //13:00:00 gibi
	
	function calismaSuresiHesapla($baslangicSaati,$bitisSaati)
	{
		//iki saat aralığındaki toplam dakikayı verir
		$fark = abs(strtotime($bitisSaati) - strtotime($baslangicSaati));
		// dakika cevrimi
		return $sure = floor($fark/60);
	}
	function hizmetSuresiHesapla($saat)
	{
		//toplam hizmet süresini dakika olarak verir.
		//(randevu aralıklarının belirlenmesi için yazıldı)
		//$MIN_HIZMET_SURESI[0] saati
		//$MIN_HIZMET_SURESI[1] dakikayı temsil eder
		$MIN_HIZMET_SURESI=explode(":",$saat);
		$sure=intval($MIN_HIZMET_SURESI[0])*60+intval($MIN_HIZMET_SURESI[1])*1;
		return $sure;
	}
$ara=hizmetSuresiHesapla($gruplar['MIN_HIZMET_SURESI']); //randevu süreleri (aralıkları) global degisken olmalı
	if($gruplar['OGLEN_BILET_VER']) //öğle tatilinde bilet verilecekse tüm gün için randevu dağıtılır
	{
				
		$basSaat=intval($MESAI_BAS[0]); //öğleden önce
		$basDak=intval($MESAI_BAS[1]); 	//öğleden önce
		$bitSaat=intval($OGLE_BAS[0]); 	//öğleden sonra
		$bitDak=intval($OGLE_BAS[1]); 	//öğleden sonra
		$sure=calismaSuresiHesapla($gruplar['MESAI_BAS'],$gruplar['MESAI_BIT']); //öğleden önceki toplam hizmet süresi (dak)
		for($i=$basDak; $i<=$sure; $i+=$ara) { 
						
							
				if($basSaat<10){ $basSaat1="0".$basSaat;}else{ $basSaat1=$basSaat;}
				if($basDak<10){ $basDak1="0".$basDak;} else{ $basDak1=$basDak; }	
			if($ara>59){ $arak=$ara-60; $basSaat++; $basDak+=$arak; }else{ $basDak+=$ara;}
				
							
						if($basDak>59)
						{
							//kalan dakikaları kullan
							$basDak%=60;
							$basSaat++;						
						}
						
				$biletSaati=strtotime($basSaat1.":".$basDak1);
				$mevcutTarih=strtotime(date("Y-m-d"));
				$mevcutSaat=strtotime(date("H:i"));
				$RandevuTarihi=strtotime($tarih);
					if(intval($mevcutTarih) == intval($RandevuTarihi)){
						if(intval($biletSaati)>intval($mevcutSaat)){		
				?>
				
			<div>
			<input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OOnce<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
			<label for="control_OOnce<?php echo $i; ?>">
				<p><?php echo "<br>".$basSaat1.":".$basDak1; ?></p>
				
			</label>
			</div>
		
		<?php } }else{ ?>
			<div>
			<input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OOnce<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
			<label for="control_OOnce<?php echo $i; ?>">
				<p><?php echo "<br>".$basSaat1.":".$basDak1; ?></p>
				
			</label>
			</div>
		<?php
							
		}}
			#aynı gün için mesai bittiyse mesaj ver				
				$mesaiBitis=strtotime($MESAI_BIT[0].":".$MESAI_BIT[1]);
				if(intval($mevcutTarih) == intval($RandevuTarihi) && intval($mesaiBitis)<= intval($mevcutSaat))
				{
					?>
					<div class="alert alert-danger"><strong>Üzgünüz, mesai saatleri dışında(<?php echo $gruplar['MESAI_BAS'];?>-<?php echo $gruplar['MESAI_BIT'];?>) randevu talebinde bulunamazsınız.<br>Lütfen, başka bir tarih deneyiniz.</strong></div>
					<?php 
				}
			#aynı gün için mesai bittiyse mesaj ver
	}
	else //normal çalışma (öğle tatili var)
	{	
			
				if(!($tatil['tatilPeriyot']==2)) //öğleden önce(periyot:2)
				{
					
				$basSaat=intval($MESAI_BAS[0]); //öğleden önce
				$basDak=intval($MESAI_BAS[1]); //öğleden önce
				$bitSaat=intval($OGLE_BAS[0]); //öğleden sonra
				$bitDak=intval($OGLE_BAS[1]); //öğleden sonra				
				$sure=calismaSuresiHesapla($gruplar['MESAI_BAS'],$gruplar['OGLE_BAS']); //öğleden önceki toplam hizmet süresi (dak)
				$biletSayac=0;
				for($i=$basDak; $i<=$sure; $i+=$ara) { 
						if($gruplar['BILET_SINIRLA'])
						{
							$OO_MAX_BILET=$gruplar['OO_MAX_BILET']; //öğleden önce max bilet sayısı
											
								if($biletSayac<$OO_MAX_BILET){	$biletSayac++;	}else{ break;}	
						}
							
						if($basSaat<10){ $basSaat1="0".$basSaat;}else{ $basSaat1=$basSaat;}
						if($basDak<10){ $basDak1="0".$basDak;} else{ $basDak1=$basDak; }	
					if($ara>59){ $arak=$ara-60; $basSaat++; $basDak+=$arak; }else{ $basDak+=$ara;}
						
									
								if($basDak>59)
								{									
									$basDak%=60;
									$basSaat++;						
								}

					$biletSaati=strtotime($basSaat1.":".$basDak1);
					$mevcutTarih=strtotime(date("Y-m-d"));
					$mevcutSaat=strtotime(date("H:i"));
					$RandevuTarihi=strtotime($tarih);
						if(intval($mevcutTarih) == intval($RandevuTarihi)){
							if(intval($biletSaati)>intval($mevcutSaat)){
							?>
					<div>
					<input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OOnce<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
					<label for="control_OOnce<?php echo $i; ?>">
						<p><?php echo "<br>".$basSaat1.":".$basDak1; ?></p>
						
					</label>
					</div>
				
							<?php } }else{
							?>
						<div>
					<input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OOnce<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
					<label for="control_OOnce<?php echo $i; ?>">
						<p><?php echo "<br>".$basSaat1.":".$basDak1; ?></p>
						
					</label>
					</div>
							<?php
						} } } ?>
				</section>	
				<!--ÖĞLEDEN ÖNCE-->
				<?php 
				//aynı gün için mesai bittiyse mesaj ver				
				$mesaiBitis=strtotime($MESAI_BIT[0].":".$MESAI_BIT[1]);
				if(intval($mevcutTarih) == intval($RandevuTarihi) && intval($mesaiBitis)<= intval($mevcutSaat))
				{
					?>
					<div class="alert alert-danger"><strong>Üzgünüz, mesai saatleri dışında(<?php echo $gruplar['MESAI_BAS'];?>-<?php echo $gruplar['MESAI_BIT'];?>) randevu talebinde bulunamazsınız.<br>Lütfen, başka bir tarih deneyiniz.</strong></div>
					<?php 
				} else{
					?>
					<div class="alert alert-info"><strong><?php if(isset($tatil['tatilAciklama'])){ echo $tatil['tatilAciklama']; }else{ echo "ÖĞLE ARASI (".$OGLE_BAS[0].":".$OGLE_BAS[1]."-".$OGLE_BIT[0].":".$OGLE_BIT[1].")"; }?></strong></div>
					<?php
				} ?>							
				<!--ÖĞLEDEN SONRA-->
				<section>
				<?php
					if(!($tatil['tatilPeriyot']==3))//öğleden sonra(periyot:3)
					{		
											
				$basSaat=intval($OGLE_BIT[0]); $basDak=intval($OGLE_BIT[1]); 
				$bitSaat=intval($MESAI_BIT[0]); $bitDak=intval($MESAI_BIT[1]);
				$sure=calismaSuresiHesapla($gruplar['OGLE_BIT'],$gruplar['MESAI_BIT']); //öğleden sonraki toplam hizmet süresi (dak)
				$biletSayac=0;
				for($i=$basDak; $i<=$sure; $i+=$ara) { 
								
						if($gruplar['BILET_SINIRLA'])
								{
									$OS_MAX_BILET=$gruplar['OS_MAX_BILET']; //öğleden önce max bilet sayısı
											
										if($biletSayac<$OS_MAX_BILET){	$biletSayac++;	}else{ break;}	
								}	
						if($basSaat<10){ $basSaat1="0".$basSaat;}else{ $basSaat1=$basSaat;}
						if($basDak<10){ $basDak1="0".$basDak;} else{ $basDak1=$basDak; }	
						
							if($ara>59){ $arak=$ara-60; $basSaat++; $basDak+=$arak; }else{ $basDak+=$ara;} //randevu aralık hesabı
									
								if($basDak>59)
								{									
									$basDak%=60;
									$basSaat++;						
								}								
						?>
						<?php 
					
					$biletSaati=strtotime($basSaat1.":".$basDak1);
					$mevcutTarih=strtotime(date("Y-m-d"));
					$mevcutSaat=strtotime(date("H:i"));
					$RandevuTarihi=strtotime($tarih);
						if(intval($mevcutTarih) == intval($RandevuTarihi)){
							if(intval($biletSaati)>intval($mevcutSaat)){
							?>
					<div>
					<input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OSonra<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
					<label for="control_OSonra<?php echo $i; ?>">
						<p><?php echo "<br>".$basSaat1.":".$basDak1; ?></p>
					</label>
					</div>
				
							<?php } }else{
							?>
							<div>
					<input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OSonra<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
					<label for="control_OSonra<?php echo $i; ?>">
						<p><?php echo "<br>".$basSaat1.":".$basDak1; ?></p>
					</label>
					</div>	
						<?php
						} } } 
			
	}?>
		<!--ÖĞLEDEN SONRA-->
		</section>	
		<!--RandevuButonu-->
			<div align="center" style="position: fixed; z-index:99; left: 0; bottom: 0; width: 100%;background-color:#eee; color: white; text-align: center;">
			<button class="button yesil" id="ok" onClick="kaydet();">
			<i class="icon-ok" style="font-size: 30px"></i> Bilgileri Onaylıyorum Randevuyu Kaydet
			</button>
			<a href="oturumKapat.php?doLogout=true" class="button kirmizi" ><strong>Vazgeç </strong><i class="icon-remove" style="font-size:30px;"></i></a>
			</div>
		<!--RandevuButonu-->
<?php if($oturumSureGoster)
{
	?>	
<style>
.countDownSabitle
{
position:fixed;
top:5px;
left:5px;
color:white;
pading-bottom:15px;
}
.clock {
position: relative !important;
padding-top: 0px;
margin-left: -200px;
margin-top: -30px;
height:100px;
width: 700px;
transform: scale(.4);
-ms-transform: scale(.4); 
-webkit-transform: scale(.4);
-o-transform: scale(.4); 
-moz-transform: scale(.4); 
}
.flip-clock-label{ display: none !important; }
</style>	
<div class="countDownSabitle">Kalan Süreniz <div class="clock"></div></div>
<div class="message"></div>
	<script type="text/javascript">
		var clock;
		var girisZamani=<?php echo intval($_SESSION["sure"]); ?>;
		var sure = <?php echo intval(time()); ?>;
		var kalan=girisZamani-sure;
	if(kalan<0){ kalan=100;}
		$(document).ready(function() {
			clock = $('.clock').FlipClock(kalan, {
		        clockFace: 'MinuteCounter',
		        countdown: true,
				language: "tr",
		        callbacks: {
		        	stop: function() {
		        		$('.message').html('Oturum Süreniz doldu!');
						//alert("Oturum Süreniz doldu!");
						window.location="oturumKapat.php?doLogout=true";
		        	},
					onStop: function() {
					window.location="oturumKapat.php?doLogout=true";
					}	
		        }		
		    });			
		});	
	</script>
	<?php
}
?>
<?php					
}else
{
	echo "Lütfen bilgileri kontrol ederek yeniden deneyiniz.";
} 
?>
