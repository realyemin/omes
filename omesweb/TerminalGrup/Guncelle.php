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
  $updateSQL = sprintf("UPDATE terminal_grup SET TID=%s, GRPID=%s, CAGRI_ORAN=%s, TRANSFER_ORAN=%s, YARDIM_GRUBU=%s, CAGRILAN=%s, TRANSFER_CAGRILAN=%s, ONCELIK=%s, S_YF1=%s, S_YF2=%s, S_YF3=%s, I_YF1=%s, I_YF2=%s, I_YF3=%s, B_YF=%s, AYRICALIKLI=%s WHERE TGID=%s",
                       GetSQLValueString($_POST['TID'], "int"),
                       GetSQLValueString($_POST['GRPID'], "int"),
                       GetSQLValueString($_POST['CAGRI_ORAN'], "int"),
                       GetSQLValueString($_POST['TRANSFER_ORAN'], "int"),
                       GetSQLValueString(isset($_POST['YARDIM_GRUBU']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['CAGRILAN'], "int"),
                       GetSQLValueString($_POST['TRANSFER_CAGRILAN'], "int"),
                       GetSQLValueString($_POST['ONCELIK'], "int"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString(isset($_POST['AYRICALIKLI']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['TGID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?TerminalGrupListele=".$_POST["TID"]."&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_gruplar = "SELECT GRPID, GRUP_ISMI FROM gruplar";
$gruplar = mysql_query($query_gruplar, $baglantim) or die(mysql_error());
$row_gruplar = mysql_fetch_assoc($gruplar);
$totalRows_gruplar = mysql_num_rows($gruplar);

mysql_select_db($database_baglantim, $baglantim);
$query_terminaller = "SELECT TID, TERMINAL_AD FROM terminaller";
$terminaller = mysql_query($query_terminaller, $baglantim) or die(mysql_error());
$row_terminaller = mysql_fetch_assoc($terminaller);
$totalRows_terminaller = mysql_num_rows($terminaller);

$colname_terminal_grup = "-1";
if (isset($_GET['TerminalGrupGuncelle'])) {
  $colname_terminal_grup = $_GET['TerminalGrupGuncelle'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_terminal_grup = sprintf("SELECT * FROM terminal_grup WHERE TGID = %s", GetSQLValueString($colname_terminal_grup, "int"));
$terminal_grup = mysql_query($query_terminal_grup, $baglantim) or die(mysql_error());
$row_terminal_grup = mysql_fetch_assoc($terminal_grup);
$totalRows_terminal_grup = mysql_num_rows($terminal_grup);
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
  <div class="panel panel-blue">
  <div class="panel panel-heading">Terminal/GRUP Güncelleme Paneli </div>
  <div class="panel body table-responsive">
  <table class="table table-hover table-bordered" align="center">
    <tr valign="baseline">
      <td nowrap align="right">Terminal ADI:</td>
      <td>
      <?php
      $query_terminaller = sprintf("SELECT TERMINAL_AD FROM terminaller WHERE TID = %s", GetSQLValueString($row_terminal_grup['TID'], "int"));
$terminaller = mysql_query($query_terminaller, $baglantim) or die(mysql_error());
$row_terminaller = mysql_fetch_assoc($terminaller);
$totalRows_terminaller = mysql_num_rows($terminaller);

	   ?>
      <input name="TID" type="hidden" id="TID" value="<?php echo $row_terminal_grup['TID']; ?>">  
       <strong><?php echo $row_terminaller["TERMINAL_AD"]; ?></strong>
     
                    
      </td>
    <tr valign="baseline">
      <td nowrap align="right">GRUP ADI:</td>
      <td><select class="form-control" name="GRPID">
        <?php 
do {  
?>
        <option value="<?php echo $row_gruplar['GRPID']?>" <?php if (!(strcmp($row_gruplar['GRPID'], htmlentities($row_terminal_grup['GRPID'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo "#".$row_gruplar['GRPID']."-". $row_gruplar['GRUP_ISMI']?></option>
        <?php
} while ($row_gruplar = mysql_fetch_assoc($gruplar));
?>
      </select></td>
    <tr valign="baseline">
      <td nowrap align="right">ÇAĞRI ORANI:</td>
      <td><input class="form-control" type="number" min="1"  max="100" name="CAGRI_ORAN" value="<?php echo htmlentities($row_terminal_grup['CAGRI_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TRANSFER ORANI:</td>
      <td><input class="form-control" type="number" min="1"  max="100" name="TRANSFER_ORAN" value="<?php echo htmlentities($row_terminal_grup['TRANSFER_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">YARDIM GRUBU:</td>
      <td><label class="switch"><input type="checkbox" name="YARDIM_GRUBU" value=""  <?php if (!(strcmp(htmlentities($row_terminal_grup['YARDIM_GRUBU'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ÖNCELIK:</td>
      <td><input class="form-control" type="number" min="1"  max="100" name="ONCELIK" value="<?php echo htmlentities($row_terminal_grup['ONCELIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AYRICALIKLI:</td>
      <td><label class="switch"><input type="checkbox" name="AYRICALIKLI" value=""  <?php if (!(strcmp(htmlentities($row_terminal_grup['AYRICALIKLI'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="hidden" name="CAGRILAN" value="<?php echo htmlentities($row_terminal_grup['CAGRILAN'], ENT_COMPAT, 'utf-8'); ?>" size="32">        <input type="hidden" name="TRANSFER_CAGRILAN" value="<?php echo htmlentities($row_terminal_grup['TRANSFER_CAGRILAN'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      <td><input class="form-control btn btn-primary" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="TGID" value="<?php echo $row_terminal_grup['TGID']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="TGID" value="<?php echo $row_terminal_grup['TGID']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($gruplar);

mysql_free_result($terminaller);

mysql_free_result($terminal_grup);
?>
