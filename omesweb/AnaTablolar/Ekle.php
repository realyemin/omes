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
  $insertSQL = sprintf("INSERT INTO anatablolar (ATID, TABLO_ADI, TABLO_TURU) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['ATID'], "int"),
                       GetSQLValueString($_POST['TABLO_ADI'], "text"),
                       GetSQLValueString($_POST['TABLO_TURU'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?AnaTabloListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Ekle</div>
  <div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover">
    <tr valign="baseline">
      <td nowrap align="right">Ana Tablo Adresi:</td>
      <td><span id="sprytextfield1">
      <input class="form-control" type="number" min="1" name="ATID" value="1" placeholder="Sayısal bir değer girin" required size="32">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format. Sadece sayısal değer girin!</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TABLO ADI:</td>
      <td><span id="sprytextfield2">
        <input name="TABLO_ADI" type="text" class="form-control" value="" size="32" required maxlength="20">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TABLO TURU:</td>
      <td><select class="form-control" name="TABLO_TURU">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>LCD Tablo</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>LED Tablo</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="btn btn-success form-control" type="submit" value="Kayıt Ekle"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</div></div></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>