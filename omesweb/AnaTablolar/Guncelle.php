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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE anatablolar SET TABLO_ADI=%s, TABLO_TURU=%s WHERE ATID=%s",
                       GetSQLValueString($_POST['TABLO_ADI'], "text"),
                       GetSQLValueString($_POST['TABLO_TURU'], "int"),
                       GetSQLValueString($_POST['ATID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?AnaTabloListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_AnaTabloGuncelle = "-1";
if (isset($_GET['AnaTabloGuncelle'])) {
  $colname_AnaTabloGuncelle = $_GET['AnaTabloGuncelle'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_AnaTabloGuncelle = sprintf("SELECT ATID, TABLO_ADI, TABLO_TURU FROM anatablolar WHERE ATID = %s", GetSQLValueString($colname_AnaTabloGuncelle, "int"));
$AnaTabloGuncelle = mysql_query($query_AnaTabloGuncelle, $baglantim) or die(mysql_error());
$row_AnaTabloGuncelle = mysql_fetch_assoc($AnaTabloGuncelle);
$totalRows_AnaTabloGuncelle = mysql_num_rows($AnaTabloGuncelle);
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
  <div class="panel panel-heading">AnaTablo Güncelle</div>
  <div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo Adresi:</th>
      <td><strong><?php echo $row_AnaTabloGuncelle['ATID']; ?></strong></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">TABLO ADI:</th>
      <td><span id="sprytextfield1">
        <input class="form-control" name="TABLO_ADI" type="text" value="<?php echo htmlentities($row_AnaTabloGuncelle['TABLO_ADI'], ENT_COMPAT, 'utf-8'); ?>" size="32" maxlength="20">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">TABLO TURU:</th>
      <td><select class="form-control" name="TABLO_TURU">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_AnaTabloGuncelle['TABLO_TURU'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LCD Tablo</option>
        <option value="2" <?php if (!(strcmp(2, htmlentities($row_AnaTabloGuncelle['TABLO_TURU'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LED Tablo</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="btn btn-info form-control" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="ATID" value="<?php echo $row_AnaTabloGuncelle['ATID']; ?>">
</form></div></div></div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
</script>

</body>
</html>
<?php
mysql_free_result($AnaTabloGuncelle);
?>
