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
  $insertSQL = sprintf("INSERT INTO anatablo_yon (YID, ATID, TID, YON, Port) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['YID'], "int"),
                       GetSQLValueString($_POST['ATID'], "int"),
                       GetSQLValueString($_POST['TID'], "int"),
                       GetSQLValueString($_POST['YON'], "int"),
                       GetSQLValueString($_POST['Port'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?AnaTabloYonListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_AnaTablo = "SELECT ATID, TABLO_ADI FROM anatablolar";
$AnaTablo = mysql_query($query_AnaTablo, $baglantim) or die(mysql_error());
$row_AnaTablo = mysql_fetch_assoc($AnaTablo);
$totalRows_AnaTablo = mysql_num_rows($AnaTablo);

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
</head>

<body>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Yön Ekle</div><div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo:</th>
      <td><select class="form-control" name="ATID">
        <?php 
do {  
?>
        <option value="<?php echo $row_AnaTablo['ATID']?>" ><?php echo $row_AnaTablo['TABLO_ADI']?></option>
        <?php
} while ($row_AnaTablo = mysql_fetch_assoc($AnaTablo));
?>
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right">Terminal:</th>
      <td><select class="form-control" name="TID">
        <?php 
do {  
?>
        <option value="<?php echo $row_Terminal['TID']?>" ><?php echo $row_Terminal['TERMINAL_AD']?></option>
        <?php
} while ($row_Terminal = mysql_fetch_assoc($Terminal));
?>
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right">YÖN:</th>
      <td><select class="form-control" name="YON">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?> > Yukarı</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Aşağı</option>
        <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>Sağ</option>
        <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>Sol</option>
        <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>Kapalı</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Port:</th>
      <td><input class="form-control" type="number" min="0" placeholder="Sayısal değer girin" name="Port" value="0" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="btn btn-success form-control" type="submit" value="Kayıt Ekle"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
  <input type="hidden" name="YID" value="" size="32">
</form>
</div></div></div>
<p>bu kısımda PhpSocket/client.php de yazdığım kodlarla QPU serial porta bağlanılacak ve gerekli ayarlar yapılarak kayıt ve güncelleme işlemleri yerine getirilecek.</p>
</body>
</html>
<?php
mysql_free_result($AnaTablo);

mysql_free_result($Terminal);
?>
