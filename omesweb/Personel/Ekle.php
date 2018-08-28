<?php //require_once('../Connections/baglantim.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO personeller (PID, TID, AD, SOYAD, ADRES, TEL, GSM, EMAIL, ACIKLAMA, CALISIYOR, KAYIT_TARIHI, KULLANICI_ADI, SIFRE) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['PID'], "int"),
                       GetSQLValueString($_POST['TID'], "int"),
                       GetSQLValueString($_POST['AD'], "text"),
                       GetSQLValueString($_POST['SOYAD'], "text"),
                       GetSQLValueString($_POST['ADRES'], "text"),
                       GetSQLValueString($_POST['TEL'], "text"),
                       GetSQLValueString($_POST['GSM'], "text"),
                       GetSQLValueString($_POST['EMAIL'], "text"),
                       GetSQLValueString($_POST['ACIKLAMA'], "text"),
                       GetSQLValueString(isset($_POST['CALISIYOR']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['KAYIT_TARIHI'], "date"),
                       GetSQLValueString($_POST['KULLANICI_ADI'], "text"),
                       GetSQLValueString($_POST['SIFRE'], "text"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?Personel=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_Terminal = "SELECT TID, TERMINAL_AD FROM terminaller";
$Terminal = mysql_query($query_Terminal, $baglantim) or die(mysql_error());
$row_Terminal = mysql_fetch_assoc($Terminal);
$totalRows_Terminal = mysql_num_rows($Terminal);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
</head>

<body>
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
do {  
?>
          <option value="<?php echo $row_Terminal['TID']?>"><?php echo $row_Terminal['TERMINAL_AD']?></option>
          <?php
} while ($row_Terminal = mysql_fetch_assoc($Terminal));
  $rows = mysql_num_rows($Terminal);
  if($rows > 0) {
      mysql_data_seek($Terminal, 0);
	  $row_Terminal = mysql_fetch_assoc($Terminal);
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
</body>
</html>
<?php
mysql_free_result($Terminal);
?>
