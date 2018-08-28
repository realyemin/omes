<?php 
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 16.04.2018
-- Description:	Randevu Bilgilerini(randevu.php den) Ajax ile almak için yazıldı
-- ============================================= 
 */
require("baglanti.php");
require("veriler/gruplar.php");
if(isset($_POST['tarih']) && $_POST['tarih']!="" && $_POST['tarih']!="Tarih Seçin")
{	
		$RandevuTarihi =date("Y-m-d", strtotime($_POST['tarih'])) ; //randevu tarihi
		$tarih=$RandevuTarihi;
		$dizi=array();
		$biletler = $db->query("SELECT BILET_NO FROM BILETLER WHERE convert(varchar(10), [SIS_TAR], 120)='$tarih'", PDO::FETCH_ASSOC);
				if ( $biletler->rowCount() ){
				
				foreach( $biletler as $row ){
				array_push($dizi, $row['BILET_NO']);//alınan biletleri dizeye at
				
					}
				}
				//echo "Seçilen randevu tarihi:".$_POST['tarih']."<br>";
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
	$OGLE_BAS=explode(":",$gruplar['OGLE_BAS']); 
	$OGLE_BIT=explode(":",$gruplar['OGLE_BIT']); 
	$OGLE_BIT=explode(":",$gruplar['OGLE_BIT']); 
	$MIN_HIZMET_SURESI=explode(":",$gruplar['MIN_HIZMET_SURESI']); 
	
$basSaat=intval($MESAI_BAS[0]); $basDak=intval($MESAI_BAS[1]); $ara=intval($MIN_HIZMET_SURESI[1]); $bitSaat=intval($OGLE_BAS[0]); $bitDak=intval($OGLE_BAS[1]);
$sure=($bitSaat-$basSaat)*60; //toplam hizmet süresi (dak)
$sayac=0;
	for($i=$basDak; $i<=$sure; $i+=$ara) { 
					
			if($basSaat<10){ $basSaat1="0".$basSaat;}else{ $basSaat1=$basSaat;}
			if($basDak<10){ $basDak1="0".$basDak;} else{ $basDak1=$basDak; }	
			
			$basDak+=$ara;
						
					if($basDak>59)
					{
						$basDak=0;
						$basSaat++;						
					}
								
		
		$sayac++;
			?>
		<div>
		  <input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OOnce<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
		  <label for="control_OOnce<?php echo $i; ?>">
			<p><?php echo $sayac."<br>".$basSaat1.":".$basDak1; ?></p>
		  </label>
		</div>
	
	<?php } ?>
	<div class="mesaj mavi"> ÖĞLE ARASI </div>
	</section>
	<!--ÖĞLEDEN ÖNCE-->
	<section>
	<!--ÖĞLEDEN SONRA-->
		<?php
$basSaat=intval($OGLE_BIT[0]); $basDak=intval($OGLE_BIT[1]); $ara=intval($MIN_HIZMET_SURESI[1]); $bitSaat=intval($MESAI_BIT[0]); $bitDak=intval($MESAI_BIT[1]);
$sure=($bitSaat-$basSaat)*60; //toplam hizmet süresi (dak)
	for($i=$basDak; $i<=$sure; $i+=$ara) { 
					
			if($basSaat<10){ $basSaat1="0".$basSaat;}else{ $basSaat1=$basSaat;}
			if($basDak<10){ $basDak1="0".$basDak;} else{ $basDak1=$basDak; }	
			
			$basDak+=$ara;
						
					if($basDak>59)
					{
						$basDak=0;
						$basSaat++;						
					}								
		$sayac++;
			?>
		<div>
		  <input type="radio" onClick="mesaj(this.id,this.value);" <?php $biletix=$basSaat1."".$basDak1; if(in_array($biletix,$dizi)){ echo "disabled"; } ?> id="control_OSonra<?php echo $i; ?>" name="select" value="<?php echo $basSaat1.":".$basDak1; ?>" />
		  <label for="control_OSonra<?php echo $i; ?>">
			<p><?php echo $sayac."<br>".$basSaat1.":".$basDak1; ?></p>
		  </label>
		</div>
	
	<?php } ?>
	<!--ÖĞLEDEN SONRA-->
</section>	
<?php
					
	}else{
		echo "Lütfen bilgileri kontrol ederek yeniden deneyiniz.".$_POST['tarih'];
	} ?>