<table class="table table-bordered table-hover table-striped">
	<tr>
	<th colspan="4">Form Ayarları</th>
	</tr>
	<tr>
	<td>LCD Yazı Tipi: </td>
	<td>
		<select name="KayanYaziFont" class="form-control">
			<option value="Arial" <?php if($KayanYaziFont==0){ echo "selected"; } ?>>Arial</option>
			
		</select>
	</td>
	<td>LCD Kayan Yazi Rengi:</td>
	<td><input class="jscolor form-control" name="KayanYaziRenk" type="text" value="<?php echo "#".substr(signed2hex($KayanYaziRenk),2,6); ?>"></td>
	</tr>
	<tr>
	<td>Punto:</td>
	   <td>
		<input type="number"
		name="KayanYaziPunto" 
		value="<?php echo $KayanYaziPunto; ?>" 
		class="form-control"
		min="10" max="100">
		</td> 
	<td>LCD Kayan Yazi Arkaplan Rengi:</td>
	<td>
		<input class="jscolor form-control" name="KayanYaziArkaPlanRenk" type="text" value="<?php echo "#".substr(signed2hex($KayanYaziArkaPlanRenk),2,6); ?>">
	</td>
	</tr>
	<tr>
<td colspan="2"></td>	
	<td>LCD Form Arkaplan Rengi:</td>
	<td>
		<input class="jscolor form-control" name="LCDFormArkaplanRenk" type="text" value="<?php echo "#".substr(signed2hex($LCDFormArkaplanRenk),2,6); ?>">
	</td>    
    </tr>
	<tr>  
	 <th colspan="2">Üst Kayan Yazı</th>      
     <th colspan="2">Alt Kayan Yazı</th>
	 </tr>
	 <tr>
	 <td>Kaysın:</td>
	 <td>
	<label class="switch">
        <input name="UstBaslikKaysin" type="checkbox" value="true" <?php if($UstBaslikKaysin){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label>
     </td>
	  <td>Kaysın:</td>
	 <td>
	<label class="switch">
        <input name="AltBaslikKaysin" type="checkbox" value="true" <?php if($AltBaslikKaysin){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label>
     </td>
    </tr>
	 <tr>
	 <td>Üst Başlık Kayma Yönü:</td>
	 <td>
	 Sola doğru 
	<label class="switch">
        <input name="UstBaslikYon" type="radio" value="0" <?php if($UstBaslikYon==0){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label>
	<label class="switch">
        <input name="UstBaslikYon" type="radio" value="1" <?php if($UstBaslikYon==1){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label> Sağa doğru
     </td>
	  <td>Alt Başlık Kayma Yönü:</td>
	 	 <td>
	 Sola doğru 
	<label class="switch">
        <input name="AltBaslikYon" type="radio" value="0" <?php if($AltBaslikYon==0){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label>
	<label class="switch">
        <input name="AltBaslikYon" type="radio" value="1" <?php if($AltBaslikYon==1){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label> Sağa doğru
     </td>
    </tr>
	<tr>
	 <td>Üst Başlık Kayma Hızı: </td>
	 <td> 
	<input type="number" 
	name="UstBaslikHiz" 
	value="<?php echo $UstBaslikHiz; ?>" 
	class="form-control" 
	min="1" max="20"> sn
     </td>
	 <td>Alt Başlık Kayma Hızı: </td>
	 <td> 
	<input type="number" 
	name="AltBaslikHiz" 
	value="<?php echo $AltBaslikHiz; ?>"
	class="form-control"
	min="1" max="20"> sn
     </td>
    </tr>
		<tr>
	<th colspan="4">Çağrılan Numaraların Yazı Ayarları </th>
	</tr>
	<tr>
	<td>Çağrı No Yazi Tipi:</td>
	<td>
		<select name="CagNoFont" class="form-control">
			<option value="Arial" <?php if($CagNoFont==0){ echo "selected"; } ?>>Arial</option>
		</select>
	</td>
	<td>Çağrı No Yazi Rengi:</td>
	<td>
	<input class="jscolor form-control" name="CagNoRenk" type="text" value="<?php echo "#".substr(signed2hex($CagNoRenk),2,6); ?>">
	</td>
	</tr>
	<tr>
	<td>Punto:</td>
	<td>
	<input type="number" 
	name="CagNoPunto" 
	value="<?php echo $CagNoPunto; ?>" 
	class="form-control" 
	min="10" max="100"> 	
	</td>
	<td>Çağrı No Tek Satır Punto:</td>
	<td>
	<input type="number" 
	name="CagNoPuntoTekSatir" 
	value="<?php echo $CagNoPuntoTekSatir; ?>" 
	class="form-control" 
	min="10" max="400"> 
	</td>
	</tr>
	<tr>
	<th colspan="4">Bilet Yazı Sahası Ayarları</th>
	</tr>
	<tr>
	<td>Bilet Sütun Metni:</td>
	<td>
	<input type="text" 
	name="Sutun1" 
	value="<?php echo $Sutun1; ?>" 
	class="form-control"> 	
	</td>
	<td>Vezne Sütun Metni:</td>
	<td>
	<input type="text" 
	name="Sutun2" 
	value="<?php echo $Sutun2; ?>" 
	class="form-control"> 
	</td>
	</tr>
	<tr>
	<td>Yazı Stili:</td>
	<td>
	<select name="SutunYaziOzellik" class="form-control">
		<option value="regular">Normal</option>
		<option value="italik" style="font-style:italic">İtalik</option>
	</select>		
	</td>
	<td>Sütun Başlık Rengi:</td>
	<td>
	<input class="jscolor form-control" 
	name="SutunRenk" 
	type="text" 
	value="<?php echo "#".substr(signed2hex($SutunRenk ),2,6); ?>">
	</td>
	</tr>
	<tr>
	<td>Yazı Kalınlığı:</td>
	<td>
	<select name="SutunYaziKalinlik" class="form-control">
		<option value="100" style="font-weight:100">100</option>
		<option value="200" style="font-weight:200">200</option>
		<option value="300" style="font-weight:300">300</option>
		<option value="400" style="font-weight:400">400</option>
		<option value="500" style="font-weight:500">500</option>
		<option value="600" style="font-weight:600">600</option>
		<option value="700" style="font-weight:700">700</option>
		<option value="800" style="font-weight:800">800</option>
		<option value="900" style="font-weight:900">900</option>
	</select>		
	</td>
	<td>Sütun Punto:</td>
	<td>
	<input type="number" 
	name="SutunPunto" 
	value="<?php echo $SutunPunto; ?>" 
	class="form-control"> 
	</td>
	</tr>
	<tr>
	<td>Sütun Font:</td>
	<td>
	<select name="SutunFont" class="form-control">
			<option value="Arial" <?php if($SutunFont==0){ echo "selected"; } ?>>Arial</option>
			
		</select></td>
	</tr>
	<tr>
	<th colspan="4">Bekleme Listesi Ayarları</th>
	</tr>
	<tr>
	<td>Bekleme Listesi Adı: </td>
	<td>
	<input type="text" 
	name="bekleyenler_metni" 
	class="form-control" 
	value="<?php echo $bekleyenler_metni; ?>">
	</td>
	<td>Bilet No Metni: </td>
	<td>
	<input type="text" 
	name="biletno_metni" 
	class="form-control"
	value="<?php echo $biletno_metni; ?>">
	</td>
	</tr>
	<tr>
	<td>Bekleyen Font: </td>
	<td>
	<select name="bekleyenFont" class="form-control">
			<option value="Arial" <?php if($bekleyenFont=="Arial"){ echo "selected"; } ?>>Arial</option>
			
		</select>
	</td>
	<td>Bekleyen Punto: </td>
	<td>
	<input type="number" 
	name="bekleyenPunto" 
	class="form-control" 
	min="10" max="40"
	value="<?php echo $bekleyenPunto; ?>">
	</td>
	</tr>
		<tr>
	<td>Bekleyen Renk: </td>
	<td>
	<input class="jscolor form-control" 
	name="bekleyenRenk" 
	type="text" 
	value="<?php echo "#".substr(signed2hex($bekleyenRenk),2,6); ?>">
	</td>
	<td>Bekleyen Arkaplan Renk: </td>
	<td>
	<input class="jscolor form-control" 
	name="bekleyenArkaPlanRenk" 
	type="text" 
	value="<?php echo "#".substr(signed2hex($bekleyenArkaPlanRenk),2,6); ?>">
	</td>
	</tr>
	<tr>
	<th colspan="4">Sıradaki Bilet Animasyon Ayarları</th>
	</tr>
	<tr>
	<td>Bilet Renk: </td>
	<td><input class="jscolor form-control" 
	name="animasyonRenk" 
	type="text" 
	value="<?php if(isset($animasyonRenk) && $animasyonRenk!=""){ echo "#".substr(signed2hex($animasyonRenk),2,6); } else{ echo "#FFFFFF"; } ?>">
	</td>
	<td>Bilet Arkaplan Renk: </td>
	<td><input class="jscolor form-control" 
	name="animasyonArkaplanRenk" 
	type="text" 
	value="<?php if(isset($animasyonArkaplanRenk) && $animasyonArkaplanRenk!=""){ echo "#".substr(signed2hex($animasyonArkaplanRenk),2,6); } else{ echo "#FF0000"; } ?>">
	</td>
	</tr>
		<tr>
	<td>Animasyon Süre(ms): </td>
	<td><input class="form-control" 
	name="animasyonSure" 
	type="number" 
	value="<?php if(isset($animasyonSure) && $animasyonSure!=""){ echo $animasyonSure; } else{ echo 500; } ?>"
	min="300" max="5000">
	</td>
	<td>Animasyon Açık/Kapalı: </td>
	<td>
	<label class="switch">
        <input name="animasyonDurum" type="checkbox" <?php if($animasyonDurum=='true'){ ?>checked <?php } ?>>
        <span class="slider round"></span>
		</label> 
	</td>
	</tr>
	<tr>
	<th colspan="4">Saat Ayarları</th>
	</tr>
	<tr>
	<td>Saat Font: </td>
	<td> 	
	<select name="saatFont" class="form-control">
	<option value="Arial" <?php if($saatFont=="Arial"){ echo "selected"; } ?>>Arial</option>			
	</select>
	</td>
	<td>Saat Punto:</td>
	<td><input type="number" 
	name="saatPunto" 
	class="form-control" 
	min="10" max="40"
	value="<?php echo $saatPunto; ?>"></td>
	</tr>
	<tr>
	<td>Saat Renk: </td>
	<td>
	<input class="jscolor form-control" 
	name="saatRenk" 
	type="text" 
	value="<?php echo "#".substr(signed2hex($saatRenk),2,6); ?>">
	</td>
		<td>Saat Arkaplan Renk: </td>
	<td>
	<input class="jscolor form-control" 
	name="saatArkaplanRenk" 
	type="text" 
	value="<?php if(isset($saatArkaplanRenk) && $saatArkaplanRenk!=""){ echo "#".substr(signed2hex($saatArkaplanRenk),2,6); } else{ echo "#0C6E21"; } ?>">
	</td>
	</tr>
  </table>