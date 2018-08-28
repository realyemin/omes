<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = $db->prepare("INSERT INTO PERSONELLER 
  (TID, AD, SOYAD, ADRES, TEL, GSM, EMAIL, ACIKLAMA, CALISIYOR, KAYIT_TARIHI, KULLANICI_ADI, SIFRE, B_YF) 
  VALUES (:TID, :AD, :SOYAD, :ADRES, :TEL, :GSM, :EMAIL, :ACIKLAMA, :CALISIYOR, :KAYIT_TARIHI, :KULLANICI_ADI, :SIFRE, :B_YF)");
                
                     $insertSQL->bindParam(':TID',$_POST['TID']);
                     $insertSQL->bindParam(':AD',$_POST['AD']);
                     $insertSQL->bindParam(':SOYAD',$_POST['SOYAD']);
                     $insertSQL->bindParam(':ADRES',$_POST['ADRES']);
                     $insertSQL->bindParam(':TEL',$_POST['TEL']);
                     $insertSQL->bindParam(':GSM',$_POST['GSM']);
                     $insertSQL->bindParam(':EMAIL',$_POST['EMAIL']);
                     $insertSQL->bindParam(':ACIKLAMA',$_POST['ACIKLAMA']);
                     $insertSQL->bindParam(':CALISIYOR',$CALISIYOR);
			if($_POST['CALISIYOR']=="on"){ $CALISIYOR=true;}else{ $CALISIYOR=false;}
                     $insertSQL->bindParam(':KAYIT_TARIHI',$_POST['KAYIT_TARIHI']);
                     $insertSQL->bindParam(':KULLANICI_ADI',$_POST['KULLANICI_ADI']);
                     $insertSQL->bindParam(':SIFRE',$_POST['SIFRE']);
                     $insertSQL->bindParam(':B_YF',$B_YF);//yonetici ise true user ise false
					if($_POST['B_YF']=="on"){ $B_YF=true;}else{ $B_YF=false;}
					$insertSQL->execute();

	
  $insertGoTo = "?Personel=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
$row_Terminal = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER")->fetchAll();
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="panel panel-blue">
<div class="panel panel-heading">Yeni Personel Kaydı</div>
<div class="panel body table-responsive">
  <table class="table table-hover table-bordered">
    <tr valign="baseline">
      <th nowrap align="right">KULLANICI ADI:</th>
      <td><span id="sprytextfield1">
        <input name="KULLANICI_ADI" type="text" class="form-control" value="" size="32" maxlength="15">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">SIFRE:</th>
      <td><span id="sprypassword1">
      <input name="SIFRE" type="password" class="form-control" value="" size="32" maxlength="15">
      <span class="passwordRequiredMsg">Bir değer gerekiyor.</span><span class="passwordMinCharsMsg">Minimum karakter(6) sayısına ulaşılmadı.</span><span class="passwordMaxCharsMsg">Maksimum karakter(15) sayısı aşıldı.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Terminal:</th>
      <td><span id="spryselect1">
        <select class="form-control btn btn-success" name="TID">
          <option value="-1">Terminal Seçiniz</option>
          <?php
foreach($row_Terminal as $row_Terminal) {  
?>
          <option value="<?php echo $row_Terminal['TID']?>"><?php echo $row_Terminal['TERMINAL_AD']?></option>
          <?php
} 
?>
        </select>
        <span class="selectInvalidMsg">Lütfen geçerli bir öğe seçin.</span><span class="selectRequiredMsg">Lütfen bir öğe seçin.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">AD:</th>
      <td><input name="AD" type="text" class="form-control" value="" size="32" maxlength="25"></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">SOYAD:</th>
      <td><input name="SOYAD" type="text" class="form-control" value="" size="32" maxlength="25"></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">ADRES:</th>
      <td><span id="sprytextarea1">
      <textarea name="ADRES" cols="32" class="form-control"></textarea>
      <span id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">TEL:</th>
      <td><span id="sprytextfield2">
      <input name="TEL" type="text" class="form-control" value="" size="32" maxlength="10">
<span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">GSM:</th>
      <td><span id="sprytextfield3">
        <input class="form-control" type="text" name="GSM" value="" size="32">
        <span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">EMAIL:</th>
      <td><span id="sprytextfield4">
      <input class="form-control" type="text" name="EMAIL" value="" size="32">
<span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">ACIKLAMA:</th>
      <td><textarea name="ACIKLAMA" cols="32" class="form-control"></textarea></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">ÇALIŞMA DURUMU:</th>
      <td><label class="switch">
        <input name="CALISIYOR" type="checkbox" checked>
<span class="slider round"></span></label>
        </td>
    </tr>
	   <tr valign="baseline">
      <th nowrap align="right">YÖNETİCİ/KULLANICI:</th>
      <td><label class="switch" data-toggle="tooltip" title="Aktif olursa 'Yönetici' yetkisine sahip olur.">
        <input name="B_YF" type="checkbox">
<span class="slider round"></span></label>
        </td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">KAYIT TARIHI:</th>
      <td><input class="form-control" readonly  type="text" name="KAYIT_TARIHI" value="<?php date_default_timezone_set('Europe/Istanbul'); echo date("Y-m-d H:i:s"); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="form-control" type="hidden" name="PID" value="" size="32">        <input class="form-control btn btn-success" type="submit" value="Kayıt Ekle"></td>
      </tr>
  </table></div></div>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6, maxChars:15, validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:200, counterId:"countsprytextarea1", counterType:"chars_remaining", isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "phone_number", {validateOn:["blur", "change"], useCharacterMasking:true, isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "phone_number", {isRequired:false, validateOn:["blur", "change"], useCharacterMasking:true});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email", {useCharacterMasking:true, isRequired:false, validateOn:["blur", "change"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
</script>