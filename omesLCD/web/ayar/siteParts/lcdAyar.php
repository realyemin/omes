   <table class="table table-bordered table-hover table-striped">
    <tr>
    <th colspan="4">LCD Ayarları</th>
    </tr>
	<tr>
	<td>LCD Üst Başlık: </td>
	<td colspan="3"><input type="text" name="UstBaslik" value="<?php echo $UstBaslik; ?>" maxlength="150" class="form-control" ></td>
	</tr>
	<tr>
	<td>LCD Alt Başlık: </td>
	<td colspan="3"><input type="text" name="AltBaslik" value="<?php echo $AltBaslik; ?>" maxlength="150" class="form-control" ></td>
	</tr>
	<tr>
	<td>Ses Dosyası Yolu: </td>
	<td colspan="3"><input type="file" name="SesURL" value="<?php echo $SesURL; ?>" class="form-control-file" > <?php echo $SesURL; ?></td>
	</tr>
	<tr>
	<td>Video Dosyası Yolu: </td>
	<td colspan="3"><input type="file" name="VideoURL" value="<?php echo $VideoURL; ?>" class="form-control-file" > <?php echo $VideoURL; ?></td>
	</tr>
	<tr>
	<td>Tablo Adresi: </td>
	<td colspan="3"><input type="number" name="AnatabloID" value="<?php echo $AnatabloID; ?>" class="form-control" ></td>
	</tr>
	<tr>
	<td>Ekran No: </td>
	<td colspan="3"><input type="number" name="EkranNo" value="<?php echo $EkranNo; ?>" class="form-control" ></td>
	</tr>
	<tr>
	<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
	<td>Ses Çalma Tipi: </td>
	<td colspan="3">
		<select name="Ses" class="form-control">
			<option value="Dosyadan" <?php if($Ses=='Dosyadan'){ echo "selected"; } ?>>Dosyadan</option>
			<option value="Sesli Çağrı" <?php if($Ses=='Sesli Çağrı'){ echo "selected"; } ?>>Sesli Çağrı</option>
			<option value="Sesli Çağrı(Arapça)" <?php if($Ses=='Sesli Çağrı(selected)'){ echo "checked"; } ?>>Sesli Çağrı(Arapça)</option>
		</select>
	</td>
	</tr>
	<tr>
	<td>Media Tipi: </td>
	<td colspan="3">
		<select name="MediaTipi" class="form-control">
			<option value="0" <?php if($MediaTipi==0){ echo "selected"; } ?>>Media Yok</option>
			<option value="1" <?php if($MediaTipi==1){ echo "selected"; } ?>>Video Göster</option>
			<option value="2" <?php if($MediaTipi==2){ echo "selected"; } ?>>TV Göster</option>
			<option value="3" <?php if($MediaTipi==3){ echo "selected"; } ?>>Web Sayfası Göster</option>
			<option value="4" <?php if($MediaTipi==4){ echo "selected"; } ?>>Bekleme Listesi Göster</option>
			<option value="5" <?php if($MediaTipi==5){ echo "selected"; } ?>>Tek Satır</option>
			<option value="6" <?php if($MediaTipi==6){ echo "selected"; } ?>>Banko İsimli</option>
			<option value="7" <?php if($MediaTipi==7){ echo "selected"; } ?>>Müşteri İsimli</option>
			<option value="8" <?php if($MediaTipi==8){ echo "selected"; } ?>>Banko ve Müşteri İsimli</option>
			<option value="9" <?php if($MediaTipi==9){ echo "selected"; } ?>>Sabit Ana Tablo</option>
		</select>
	</td>
	</tr>
	<tr>
	<td>TV Kaynak: </td>
	<td colspan="3">
		<select name="TvKaynak" class="form-control">
			<option value="Yok">Yok</option>
			<option value="Eklenecek">Eklenecek</option>			
		</select>
	</td>
	</tr>
	<tr>
	<td>TV Kanal: </td>
	<td colspan="3"><input type="number" name="TvKanal" value="<?php echo $TvKanal; ?>" class="form-control" ></td>
	</tr>
	<tr>
	<td>Web Browser URL: </td>
	<td colspan="3"><input type="text" name="WebBrowserUrl" value="<?php echo $WebBrowserUrl; ?>" class="form-control" ></td>
	</tr>
	<tr>
	<td>Satır Sayısı: </td>
	<td colspan="3"><input type="number" name="SatirSayisi" value="<?php echo $SatirSayisi; ?>" class="form-control" ></td>
	</tr>
	<tr>
	<td>Sayfa verileri yenileme süresi(sn): </td>
	<td colspan="3">
	<input type="number" 
	name="sayfaYinelemeSuresi" 
	value="<?php echo ($sayfaYinelemeSuresi)/1000; ?>" 
	class="form-control" 
	min="1" max="60" required></td>
	</tr>
	<tr>
	<td colspan="4">&nbsp;</td>
	</tr>
	</table>