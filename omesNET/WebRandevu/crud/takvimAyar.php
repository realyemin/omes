<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
		{
			//$row sistemAyarListele.php içinde tanımlı
			?>
		<div class="col-sm-3">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h4 data-toggle="tooltip" title="Randevu seçici takviminin ekranda nasıl belireceğini ayarlayabilirsiniz. Not:Randevu sistemi anasayfası için geçerlidir." >
					<strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Takvim Animasyon Seçici</h4>            
				</div>
<script type="text/javascript">
function temaSec()
{
	var img=document.getElementById("temaImg");
	var tema=document.getElementById("temaOption");
	img.src="dist/plugin/datepicker/tema_images/"+tema.value+".png";
}
</script>
				<div class="panel-body table-responsive">
					<form name="animasyonForm" <?php if($row->rowCount()){ echo "action='WebRandevu/crud/guncelle.php?guncelle'";}else {echo "action='WebRandevu/crud/ekle.php?ekle'";} ?> method="post">
					<table class="table table-hover">
					<tr><td>Takvim Teması:</td></tr>
					<tr><td class="inputs">
					<select name="takvimTema" class="form-control" onChange="temaSec()" id="temaOption">
						<option value="base" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="base"){echo "selected";}?>>1.Base</option>
						<option value="black-tie" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="black-tie"){echo "selected";}?>>2.black-tie</option>
						<option value="blitzer" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="blitzer"){echo "selected";}?>>3.blitzer</option>
						<option value="cupertino" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="cupertino"){echo "selected";}?>>4.cupertino</option>
						<option value="dark-hive" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="dark-hive"){echo "selected";}?>>5.dark-hive</option>
						<option value="dot-luv" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="dot-luv"){echo "selected";}?>>6.dot-luv</option>
						<option value="eggplant" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="eggplant"){echo "selected";}?>>7.eggplant</option>
						<option value="excite-bike" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="excite-bike"){echo "selected";}?>>8.excite-bike</option>
						<option value="flick" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="flick"){echo "selected";}?>>9.flick</option>
						<option value="hot-sneaks" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="hot-sneaks"){echo "selected";}?>>10.hot-sneaks</option>
						<option value="humanity" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="humanity"){echo "selected";}?>>11.humanity</option>
						<option value="le-frog" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="le-frog"){echo "selected";}?>>12.le-frog</option>
						<option value="mint-choc" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="mint-choc"){echo "selected";}?>>13.mint-choc</option>
						<option value="overcast" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="overcast"){echo "selected";}?>>14.overcast</option>
						<option value="pepper-grinder" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="pepper-grinder"){echo "selected";}?>>15.pepper-grinder</option>
						<option value="redmond" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="redmond"){echo "selected";}?>>16.redmond</option>
						<option value="smoothness" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="smoothness"){echo "selected";}?>>17.smoothness</option>
						<option value="south-street" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="south-street"){echo "selected";}?>>18.south-street</option>
						<option value="start" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="start"){echo "selected";}?>>19.start</option>
						<option value="sunny" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="sunny"){echo "selected";}?>>20.sunny</option>
						<option value="swanky_purse" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="swanky_purse"){echo "selected";}?>>21.swanky_purse</option>
						<option value="trontastic" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="trontastic"){echo "selected";}?>>22.trontastic</option>
						<option value="ui-darkness" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="ui-darkness"){echo "selected";}?>>23.ui-darkness</option>
						<option value="ui-lightness" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="ui-lightness"){echo "selected";}?>>24.ui-lightness</option>
						<option value="vader" <?php if(isset($row_RandevuAyar['takvimTema']) && $row_RandevuAyar['takvimTema']=="base"){echo "vader";}?>>25.vader</option>
					</select>
					<img src="<?php echo "dist/plugin/datepicker/tema_images/".$row_RandevuAyar['takvimTema'].".png"; ?>" id="temaImg">

					</td></tr>
					<tr><td>Animasyon Türü:</td></tr>
						<tr><td style="padding:5px;">
						<select name="takvimAnimasyon" class="form-control">
							<option value="drop" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) && $row_RandevuAyar['takvimAnimasyon']=="drop"){echo "selected";}?>>Aç(varsayılan)</option>
							<option value="clip" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="clip"){echo "selected"; }?>>Kırp(Clip)</option>
							<option value="pulsate" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="pulsate"){echo "selected";}?>>Kalp Atışı(Pulsate)</option>
							<option value="puff" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="puff"){echo "selected" ;}?>>Ucur(Puff)</option>
							<option value="scale" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="scale"){echo "selected";}?>>Büyüt(scale)</option>
							<option value="shake" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="shake"){echo "selected" ;}?>>Salla(Shake)</option>
							<option value="slide" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="slide"){echo "selected" ;}?>>Kaydır(Slide)</option>
							<option value="bounce" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="bounce"){echo "selected" ;}?>>Zıpla(Bounce)</option>							
							<option value="blind" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="blind"){echo "selected" ;}?>>Sakla(Blind)</option>
							<option value="show" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="show"){echo "selected" ;}?>>Gösteri(show)</option>
							<option value="fold" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="fold"){echo "selected" ;}?>>Kıvır(fold)</option>
							<option value="fadeIn" <?php if(isset($row_RandevuAyar['takvimAnimasyon']) &&  $row_RandevuAyar['takvimAnimasyon']=="fadeIn"){echo "selected" ;}?>>Giriş(fadeIn)</option>										
						</select>						
						</td></tr>
						<tr><td>Animasyon Hızı:</td></tr>
						<tr><td>
						<select name="animasyonHizi" class="form-control">
							<option value="slow" <?php if(isset($row_RandevuAyar['animasyonHizi']) &&  $row_RandevuAyar['animasyonHizi']=="slow"){echo "selected" ;}?>>Yavaş</option>
							<option value="normal" <?php if(isset($row_RandevuAyar['animasyonHizi']) &&  $row_RandevuAyar['animasyonHizi']=="normal"){echo "selected" ;}?> selected>Normal</option>
							<option value="fast" <?php if(isset($row_RandevuAyar['animasyonHizi']) &&  $row_RandevuAyar['animasyonHizi']=="fast"){echo "selected" ;}?>>Hızlı</option>
						</select>
						</td></tr>
						<tr>
							<td>
							<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
							<?php if($row->rowCount()){ ?>
							<button name="animasyonDurumBtn" class="btn btn-warning form-control">Güncelle</button>
							<?php }else{ ?>
							<button name="animasyonDurumBtn" class="btn btn-success form-control">Kaydet</button>
							<?php } ?>
							</td>
						</tr>						
					</table>
					</form>
				</div>
				<div class="panel-footer">
				Animasyon
				</div>
			</div>
		</div>
             	
		<div class="col-sm-5">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 data-toggle="tooltip" title="Randevu alınabilecek tarih aralıklarını seçebilirsiniz. Not:Randevu sistemi anasayfası için geçerlidir. " >
					<strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Takvim Başlangıç & Bitiş Seçici</h4>            
				</div>
				<div class="panel-body table-responsive">
					<form  name="takvimBasBitForm" <?php if($row->rowCount()){ echo "action='WebRandevu/crud/guncelle.php?guncelle'";}else {echo "action='WebRandevu/crud/ekle.php?ekle'";} ?> method="post">
					<table class="table table-hover">
						<tr>
						<td>Takvim başlangıç</td>
						<td>
						<input type="number" min="0" max="31" class="form-control" name="minimumTarihSayisi" value="<?php if(isset($row_RandevuAyar['minimumTarihSayisi'])){ echo $row_RandevuAyar['minimumTarihSayisi'];  } else { echo 0; } ?>" required />
						</td>
						<td>
						<select name="minimumTarihTuru" required class="form-control">
							<option value="d" <?php if(isset($row_RandevuAyar['minimumTarihTuru']) &&  $row_RandevuAyar['minimumTarihTuru']=="d"){echo "selected";}?>>Gün</option>
							<option value="w" <?php if(isset($row_RandevuAyar['minimumTarihTuru']) &&  $row_RandevuAyar['minimumTarihTuru']=="w"){echo "selected"; }?>>Hafta</option>
							<option value="m" <?php if(isset($row_RandevuAyar['minimumTarihTuru']) &&  $row_RandevuAyar['minimumTarihTuru']=="m"){echo "selected";}?>>Ay</option>
							<option value="y" <?php if(isset($row_RandevuAyar['minimumTarihTuru']) &&  $row_RandevuAyar['minimumTarihTuru']=="y"){echo "selected" ;}?>>Yıl</option>													
						</select>						
						</td></tr>
						<tr>
						<td>Takvim Bitiş</td><td>
						<input type="number" min="1" max="31" class="form-control" name="maksimumTarihSayisi" value="<?php if(isset($row_RandevuAyar['maksimumTarihSayisi'])) { echo $row_RandevuAyar['maksimumTarihSayisi']; }else{ echo 10; }?>" required />
						</td><td>
						<select name="maksimumTarihTuru" required class="form-control">
							<option value="d" <?php if(isset($row_RandevuAyar['maksimumTarihTuru']) &&  $row_RandevuAyar['maksimumTarihTuru']=="d"){echo "selected";}?>>Gün</option>
							<option value="w" <?php if(isset($row_RandevuAyar['maksimumTarihTuru']) &&  $row_RandevuAyar['maksimumTarihTuru']=="w"){echo "selected"; }?>>Hafta</option>
							<option value="m" <?php if(isset($row_RandevuAyar['maksimumTarihTuru']) &&  $row_RandevuAyar['maksimumTarihTuru']=="m"){echo "selected";}?>>Ay</option>
							<option value="y" <?php if(isset($row_RandevuAyar['maksimumTarihTuru']) &&  $row_RandevuAyar['maksimumTarihTuru']=="y"){echo "selected" ;}?>>Yıl</option>														
						</select>						
						</td></tr>						
						<tr>
							<td colspan="3">
							<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
							<?php if($row->rowCount()){ ?>
							<button name="takvimBasBitBtn" class="btn btn-warning form-control">Güncelle</button>
							<?php }else{ ?>
							<button name="takvimBasBitBtn" class="btn btn-info form-control">Kaydet</button>
							<?php } ?>
							</td>
						</tr>
						<tr>
							<td colspan="3">*Başlangıç değeri 0 olarak ayarlanırsa aynı gün için randevu verilebilir.<br>*Başlangıç tarihi bitiş tarihinden küçük olmalıdır.</td>
						</tr>
					</table>
					</form>
				</div>
				<div class="panel-footer">
				Takvim Başlangıç Bitiş Formu
				</div>
			</div>
		</div>	
		<?php } ?>   
