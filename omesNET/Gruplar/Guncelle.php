<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = $db->prepare("UPDATE GRUPLAR 
  SET GRUP_ISMI=:GRUP_ISMI, BAS_NO=:BAS_NO, BIT_NO=:BIT_NO, 
  DONGU=:DONGU, MIN_HIZMET_SURESI=:MIN_HIZMET_SURESI, 
  MAX_HIZMET_SURESI=:MAX_HIZMET_SURESI, AKTIF=:AKTIF, 
  MESAI_BAS=:MESAI_BAS, MESAI_BIT=:MESAI_BIT, OGLE_BAS=:OGLE_BAS, 
  OGLE_BIT=:OGLE_BIT, OGLEN_BILET_VER=:OGLEN_BILET_VER, 
  BILET_SINIRLA=:BILET_SINIRLA, OO_MAX_BILET=:OO_MAX_BILET, 
  OS_MAX_BILET=:OS_MAX_BILET, SIL=:SIL, BeklemeSuresiTipi=:BeklemeSuresiTipi, Webrandevu=:Webrandevu
  WHERE GRPID=:GRPID");
               
			   $updateSQL->bindParam(':GRPID', $_POST['GRPID']);
			   $updateSQL->bindParam(':GRUP_ISMI', $_POST['GRUP_ISMI']);
               $updateSQL->bindParam(':BAS_NO', $_POST['BAS_NO']);
               $updateSQL->bindParam(':BIT_NO', $_POST['BIT_NO']);
               $updateSQL->bindParam(':DONGU', $DONGU);
		if($_POST['DONGU']=="on"){ $DONGU=true;}else{ $DONGU=false;}
               $updateSQL->bindParam(':MIN_HIZMET_SURESI', $_POST['MIN_HIZMET_SURESI']);
               $updateSQL->bindParam(':MAX_HIZMET_SURESI', $_POST['MAX_HIZMET_SURESI']);
               $updateSQL->bindParam(':AKTIF', $AKTIF);
		if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
               $updateSQL->bindParam(':MESAI_BAS', $_POST['MESAI_BAS']);
               $updateSQL->bindParam(':MESAI_BIT', $_POST['MESAI_BIT']);
               $updateSQL->bindParam(':OGLE_BAS', $_POST['OGLE_BAS']);  
               $updateSQL->bindParam(':OGLE_BIT', $_POST['OGLE_BIT']);
               $updateSQL->bindParam(':OGLEN_BILET_VER', $OGLEN_BILET_VER);
		if(isset($_POST['OGLEN_BILET_VER'])){ $OGLEN_BILET_VER=true;}else{ $OGLEN_BILET_VER=false;}
               $updateSQL->bindParam(':BILET_SINIRLA', $BILET_SINIRLA);  
		if(isset($_POST['BILET_SINIRLA'])){ $BILET_SINIRLA=true;}else{ $BILET_SINIRLA=false;}
               $updateSQL->bindParam(':OO_MAX_BILET', $_POST['OO_MAX_BILET']);
               $updateSQL->bindParam(':OS_MAX_BILET', $_POST['OS_MAX_BILET']);
               $updateSQL->bindParam(':SIL', $_POST['SIL']);
               $updateSQL->bindParam(':BeklemeSuresiTipi', $_POST['BeklemeSuresiTipi']);                
               $updateSQL->bindParam(':Webrandevu', $Webrandevu, PDO::PARAM_BOOL);                
		if(isset($_POST['Webrandevu'])){ $Webrandevu=true;}else{ $Webrandevu=false;}
  
  				$updateSQL->execute();

  $updateGoTo = "?GrupListele&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Guncelle = "-1";
if (isset($_GET['GrupGuncelle'])) {
  $colname_Guncelle = $_GET['GrupGuncelle'];
}

$query_Guncelle = "SELECT * FROM GRUPLAR WHERE GRPID = '$colname_Guncelle'";
$row_Guncelle = $db->query($query_Guncelle)->fetch();

?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Grup Paneli Güncelleme Ekranı</div><div class="panel body table-responsive">
  <table class="table table-hover">
  <tr>
    <td width="362" valign="top">  
    <div class="panel panel-blue">
  <div class="panel panel-heading">Grup Bilgileri #<?php echo $row_Guncelle['GRPID']; ?></div>
  <div class="panel body table-responsive">
      <table class="table table-hover">
        <tr valign="baseline">
          <td valign="baseline" >GRUP ISMI:
            <input type="hidden" name="GRPID" value="" size="32"></td>
          <td valign="baseline"><span id="sprytextfield1">
            <input class="form-control" type="text" name="GRUP_ISMI" value="<?php echo htmlentities($row_Guncelle['GRUP_ISMI'], ENT_COMPAT, 'utf-8'); ?>" maxlength="25" size="32" placeholder="Grup Adını Yazınız">
            <span class="textfieldRequiredMsg">Grup Adı Boş geçilemez!.</span></span></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Başlangıç No:</td>
          <td valign="baseline"><input class="form-control" type="number" min="1" max="2147483647" name="BAS_NO"size="32" value="<?php echo htmlentities($row_Guncelle['BAS_NO'], ENT_COMPAT, 'utf-8'); ?>" placeholder="1"></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Bitiş No:</td>
          <td valign="baseline"><input class="form-control" type="number" min="1" max="2147483647" name="BIT_NO" value="<?php echo htmlentities($row_Guncelle['BIT_NO'], ENT_COMPAT, 'utf-8'); ?>" placeholder="1" size="32"></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Döngü:(Bitince Başa Dön)</td>
          <td align="left" valign="baseline"><label class="switch"><input name="DONGU" type="checkbox" class="form-control" <?php if($row_Guncelle['DONGU']==1){ echo "checked"; } ?> ><span class="slider round"></span></label></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Aktif:</td>
          <td align="left" valign="baseline"><label class="switch"><input name="AKTIF" type="checkbox" <?php if($row_Guncelle['AKTIF']=='1'){ echo "checked"; } ?> ><span class="slider round"></span></label></td>
          </tr> 
		  <tr class="alert alert-success" data-toggle="tooltip" title="EĞER BU GRUBUN WEB RANDEVULARINA BAKACAK ŞEKİLDE OLMASINI İSTİYORSANIZ İŞARETLEYİNİZ!">
          <td valign="baseline" >WEB RANDEVU:</td>
          <td align="left" valign="baseline"><label class="switch"><input name="Webrandevu" type="checkbox" <?php if($row_Guncelle['Webrandevu']=='1'){ echo "checked"; } ?> ><span class="slider round"></span></label></td>
          </tr>        
      </table></div></div>
    </td>
  <td width="270" valign="top">
  <div class="panel panel-green">
  <div class="panel panel-heading">Hizmet Bilgileri</div>
  <div class="panel body table-responsive">
  	<table class="table table-hover">
    <tr valign="baseline">
      <td valign="baseline">MIN. HIZMET SURESI(Saat:Dak:Sn):</td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" ><span id="sprytextfield2">
      <input class="form-control" data-toggle="tooltip" title="Aynı Zamanda Web Randevu için Randevu aralığı yerine geçer" type="text" name="MIN_HIZMET_SURESI" value="<?php echo htmlentities($row_Guncelle['MIN_HIZMET_SURESI'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" >MAX. HIZMET SURESI(Saat:Dak:Sn):</td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" ><span id="sprytextfield3">
      <input class="form-control" type="text" name="MAX_HIZMET_SURESI" value="<?php echo htmlentities($row_Guncelle['MAX_HIZMET_SURESI'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td class="alert alert-info"><strong>Ortalama Bekleme Süresi Yazdırma Şekli</strong></td>
    </tr>
      <tr valign="baseline">
      <td valign="baseline" ><table class="table table-responsive">
        <tr>
          <td><label class="switch"><input name="BeklemeSuresiTipi" type="radio" value="1" <?php if($row_Guncelle['BeklemeSuresiTipi']==1){ echo "checked"; } ?>><span class="slider round"></span></label></td>
          <td> Min.Hizmet Süresini Kullanın</td>
        </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="BeklemeSuresiTipi" value="2" <?php if($row_Guncelle['BeklemeSuresiTipi']==2){ echo "checked"; } ?>><span class="slider round"></span></label></td>
          <td>Otomatik Hesapla</td>
        </tr>
      </table></td>
      </tr>    
    </table></div></div>
    </td>    
    </tr>    
  <tr><td colspan="2">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Çalışma Saati Bilgileri</div><div class="panel body table-responsive">
  <table id="tableID" class="table table-hover">
  <tr valign="baseline">
      <td valign="baseline">Mesai Başlangıcı(Saat:Dak:Sn):</td>
      <td valign="baseline"><span id="sprytextfield4">
      <input class="form-control" type="text" name="MESAI_BAS" value="<?php echo htmlentities($row_Guncelle['MESAI_BAS'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td valign="baseline">Öğle Molası Başlangıcı(Saat:Dak:Sn):</td>
      <td valign="baseline"><span id="sprytextfield6">
      <input class="form-control" type="text" name="OGLE_BAS" value="<?php echo htmlentities($row_Guncelle['OGLE_BAS'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td valign="baseline">Mesai Bitiş(Saat:Dak:Sn):</td>
      <td valign="baseline"><span id="sprytextfield5">
      <input class="form-control" type="text" name="MESAI_BIT" value="<?php echo htmlentities($row_Guncelle['MESAI_BIT'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td valign="baseline">Öğle Molası Bitiş(Saat:Dak:Sn):</td>
      <td valign="baseline"><span id="sprytextfield7">
      <input class="form-control" type="text" name="OGLE_BIT" value="<?php echo htmlentities($row_Guncelle['OGLE_BIT'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td valign="baseline" >Bilet Sınırlaması Yapılsın mı?:</td>
      <td valign="baseline"><label class="switch"><input class="form-control" type="checkbox" name="BILET_SINIRLA" id="checkboxID" <?php if($row_Guncelle['BILET_SINIRLA']==1){ echo "checked"; } ?>><span class="slider round"></span></label>
      
      </td>
      <td valign="baseline">Öğle Tatilinde Bilet Verilsin mi?:</td>
      <td valign="baseline"><label class="switch"><input class="form-control" type="checkbox" name="OGLEN_BILET_VER" <?php if($row_Guncelle['OGLEN_BILET_VER']==1){ echo "checked"; } ?>><span class="slider round"></span></label></td>
    </tr>
    <tr class="rowClass" valign="baseline">
      <td colspan="4" class="alert alert-info" ><strong>Bilet Sınırlama Bilgileri</strong></td>
      </tr>
      
    <tr class="rowClass" valign="baseline">
      <td valign="baseline" >Öğleden Önce Max. Bilet Sayısı:</td>
      <td class="rowClass" valign="baseline"><input class="form-control" type="number" min="0" max="1000" name="OO_MAX_BILET" value="<?php echo htmlentities($row_Guncelle['OO_MAX_BILET'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      <td colspan="2" class="alert alert-success">Bilet sınırlaması, bir gruba öğleden önce ve<br>
öğleden sonra en fazla ne kadar bilet <br>
verileceğini belirler.</td>
      </tr>
    <tr class="rowClass" valign="baseline">
      <td valign="baseline" >Öğleden Sonra Max. Bilet Sayısı</td>
      <td valign="baseline"><input class="form-control" type="number" min="0" max="1000" name="OS_MAX_BILET" value="<?php echo htmlentities($row_Guncelle['OS_MAX_BILET'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      <td colspan="2" rowspan="2" class="aler alert-danger"><strong><p>Eğer herhangi bir sınırlama olmaksızın bilet <br>
verilmesini istiyorsanız <br>
&quot;Bilet Sınırlaması Yap&quot; kutucuğunun işaretini kaldırınız.</p></strong></td>
      </tr>
    <tr valign="baseline">
      <td colspan="2" valign="baseline" ><input class="form-control" type="hidden" name="SIL" value="0" size="32">
        <input class="form-control" type="hidden" name="S_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="B_YF" value="" size="32"></td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" >&nbsp;</td>
      <td valign="baseline"><input class="form-control btn btn-primary" type="submit" value="Kayıt Güncelleştir"></td>
      <td valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
  </table></div>
  </div></td></tr>
  </table>
   <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="GRPID" value="<?php echo $row_Guncelle['GRPID']; ?>">
 
  </div></div></div>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time", {format:"HH:mm:ss", useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {useCharacterMasking:true, format:"HH:mm:ss", validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
</script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->

<script>	
//<![CDATA[
$(window).load(function(){
$("#checkboxID").change(function(){
    var self = this;
    $("#tableID tr.rowClass").toggle(self.checked); 
}).change();
});//]]> 
      </script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->