﻿<?php //require_once('../Connections/baglantim.php'); ?>
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
  $updateSQL = sprintf("UPDATE bilet_makineleri SET MAKINE_ADI=%s, MAKINE_TURU=%s WHERE MAKINE_ADRESI=%s",
                       GetSQLValueString($_POST['MAKINE_ADI'], "text"),
                       GetSQLValueString($_POST['MAKINE_TURU'], "int"),
                       GetSQLValueString($_POST['MAKINE_ADRESI'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?BiletMakinesiEkle&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_BiletMakinesi = "-1";
if (isset($_GET['BiletMakinesiGuncelle'])) {
  $colname_BiletMakinesi = $_GET['BiletMakinesiGuncelle'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi = sprintf("SELECT MAKINE_ADRESI, MAKINE_ADI, MAKINE_TURU FROM bilet_makineleri WHERE MAKINE_ADRESI = %s", GetSQLValueString($colname_BiletMakinesi, "int"));
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Bilet Makinesi Güncelle </div>
  <div class="panel body table-responsive">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right">MAKINE ADRESI:</td>
      <td><input class="form-control" type="text" name="MAKINE_ADI2" value="<?php echo htmlentities($row_BiletMakinesi['MAKINE_ADRESI'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MAKINE ADI:</td>
      <td><input class="form-control" type="text" name="MAKINE_ADI" value="<?php echo htmlentities($row_BiletMakinesi['MAKINE_ADI'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MAKINE TÜRÜ:</td>
      <td valign="baseline"><table>
        <tr>
          <td><label class="switch"><input type="radio" name="MAKINE_TURU" value="1" <?php if (!(strcmp(htmlentities($row_BiletMakinesi['MAKINE_TURU'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label>
            Kiosk</td>
        </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="MAKINE_TURU" value="2" <?php if (!(strcmp(htmlentities($row_BiletMakinesi['MAKINE_TURU'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label>
            Buton</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input class="form-control btn btn-info" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="MAKINE_ADRESI" value="<?php echo $row_BiletMakinesi['MAKINE_ADRESI']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($BiletMakinesi);
?>
