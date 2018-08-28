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
  $updateSQL = sprintf("UPDATE anatablo_yon SET ATID=%s, TID=%s, YON=%s, Port=%s WHERE YID=%s",
                       GetSQLValueString($_POST['ATID'], "int"),
                       GetSQLValueString($_POST['TID'], "int"),
                       GetSQLValueString($_POST['YON'], "int"),
                       GetSQLValueString($_POST['Port'], "int"),
                       GetSQLValueString($_POST['YID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?AnaTabloYonListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_Terminal = "SELECT TID, TERMINAL_AD FROM terminaller";
$Terminal = mysql_query($query_Terminal, $baglantim) or die(mysql_error());
$row_Terminal = mysql_fetch_assoc($Terminal);
$totalRows_Terminal = mysql_num_rows($Terminal);

mysql_select_db($database_baglantim, $baglantim);
$query_AnaTablo = "SELECT ATID, TABLO_ADI FROM anatablolar";
$AnaTablo = mysql_query($query_AnaTablo, $baglantim) or die(mysql_error());
$row_AnaTablo = mysql_fetch_assoc($AnaTablo);
$totalRows_AnaTablo = mysql_num_rows($AnaTablo);

$colname_AnaTabloYon = "-1";
if (isset($_GET['AnaTabloYonGuncelle'])) {
  $colname_AnaTabloYon = $_GET['AnaTabloYonGuncelle'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_AnaTabloYon = sprintf("SELECT YID, ATID, TID, YON, Port FROM anatablo_yon WHERE YID = %s", GetSQLValueString($colname_AnaTabloYon, "int"));
$AnaTabloYon = mysql_query($query_AnaTabloYon, $baglantim) or die(mysql_error());
$row_AnaTabloYon = mysql_fetch_assoc($AnaTabloYon);
$totalRows_AnaTabloYon = mysql_num_rows($AnaTabloYon);
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
  <div class="panel panel-heading">AnaTablo Yön Güncelle</div>
  <div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo Yön ID:</th>
      <td><strong><?php echo $row_AnaTabloYon['YID']; ?></strong></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo :</th>
      <td><select class="form-control" name="ATID">
        <?php 
do {  
?>
        <option value="<?php echo $row_AnaTablo['ATID']?>" <?php if (!(strcmp($row_AnaTablo['ATID'], htmlentities($row_AnaTabloYon['ATID'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_AnaTablo['TABLO_ADI']?></option>
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
        <option value="<?php echo $row_Terminal['TID']?>" <?php if (!(strcmp($row_Terminal['TID'], htmlentities($row_AnaTabloYon['TID'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_Terminal['TERMINAL_AD']?></option>
        <?php
} while ($row_Terminal = mysql_fetch_assoc($Terminal));
?>
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right">YÖN:</th>
      <td><select class="form-control" name="YON">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Yukarı</option>
        <option value="2" <?php if (!(strcmp(2, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Aşağı</option>
        <option value="3" <?php if (!(strcmp(3, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Sağ</option>
        <option value="4" <?php if (!(strcmp(4, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Sol</option>
        <option value="5" <?php if (!(strcmp(5, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kapalı</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Port:</th>
      <td><input class="form-control" type="number" min="0" name="Port" value="<?php echo htmlentities($row_AnaTabloYon['Port'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="form-control btn btn-info" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="YID" value="<?php echo $row_AnaTabloYon['YID']; ?>">
</form>
</div></div></div>
</body>
</html>
<?php
mysql_free_result($Terminal);

mysql_free_result($AnaTablo);

mysql_free_result($AnaTabloYon);
?>
