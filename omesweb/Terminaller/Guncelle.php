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
  $updateSQL = sprintf("UPDATE terminaller SET ELTID=%s, TERMINAL_AD=%s, OTO_CAGRI=%s, OTO_SURE=%s, DURUM=%s, AKTIF=%s, AKTIF_BID=%s, SON_CAGRILAN_GRUP=%s, SON_CAGRILAN_TUR=%s, TerminalTipi=%s, DoubleClick=%s, SiralamaTipi=%s, CagriSiralamaTipi=%s WHERE TID=%s",
                       GetSQLValueString($_POST['ELTID'], "int"),
                       GetSQLValueString($_POST['TERMINAL_AD'], "text"),
                       GetSQLValueString(isset($_POST['OTO_CAGRI']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['OTO_SURE'], "date"),
                       GetSQLValueString($_POST['DURUM'], "int"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['AKTIF_BID'], "int"),
                       GetSQLValueString($_POST['SON_CAGRILAN_GRUP'], "int"),
                       GetSQLValueString($_POST['SON_CAGRILAN_TUR'], "int"),
                       GetSQLValueString($_POST['TerminalTipi'], "text"),
                       GetSQLValueString(isset($_POST['DoubleClick']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['SiralamaTipi'], "int"),
                       GetSQLValueString($_POST['CagriSiralamaTipi'], "int"),
                       GetSQLValueString($_POST['TID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?TerminalListele&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_TerminalGuncelle = "-1";
if (isset($_GET['TerminalGuncelle'])) {
  $colname_TerminalGuncelle = $_GET['TerminalGuncelle'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_TerminalGuncelle = sprintf("SELECT * FROM terminaller WHERE TID = %s", GetSQLValueString($colname_TerminalGuncelle, "int"));
$TerminalGuncelle = mysql_query($query_TerminalGuncelle, $baglantim) or die(mysql_error());
$row_TerminalGuncelle = mysql_fetch_assoc($TerminalGuncelle);
$totalRows_TerminalGuncelle = mysql_num_rows($TerminalGuncelle);
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
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Terminal Paneli Güncelleme Ekranı <span class="alert alert-info">(Terminal ID:<?php echo $row_TerminalGuncelle['TID']; ?>)</span></div>
  <div class="panel body table-responsive">
  <table class="table table-hover">
    <tr valign="baseline">
      <td nowrap>EL Terminal ID:</td>
      <td><span id="sprytextfield1">
        <input class="form-control" type="number" name="ELTID" value="<?php echo htmlentities($row_TerminalGuncelle['ELTID'], ENT_COMPAT, 'utf-8'); ?>" min="1" max="1000" size="32" placeholder="1">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TERMINAL ADI:</td>
      <td><span id="sprytextfield2">
        <input class="form-control" type="text" name="TERMINAL_AD" value="<?php echo htmlentities($row_TerminalGuncelle['TERMINAL_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32" maxlength="20">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. CAGRI:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="OTO_CAGRI" value="" <?php if($row_TerminalGuncelle['OTO_CAGRI']==1){ echo "checked";} ?> ><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. SURE:</td>
      <td><span id="sprytextfield3">
      <input class="form-control" type="text" name="OTO_SURE" value="<?php echo htmlentities($row_TerminalGuncelle['OTO_SURE'], ENT_COMPAT, 'utf-8'); ?>" size="32">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>AKTIF:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="AKTIF" value="" <?php if($row_TerminalGuncelle['AKTIF']==1){ echo "checked"; } ?> >
     <span class="slider round"></span></label> </td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Terminal Tipi:</td>
      <td><select class="form-control" name="TerminalTipi">
        <option value="Oda" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Poliklinik"))) {echo "SELECTED";} ?>>Oda</option>
        <option value="Poliklinik" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Poliklinik"))) {echo "SELECTED";} ?>>Poliklinik</option>
        <option value="Masa" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Masa"))) {echo "SELECTED";} ?>>Masa</option>
        <option value="Vezne" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Vezne"))) {echo "SELECTED";} ?>>Vezne</option>
        <option value="Banko" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Banko"))) {echo "SELECTED";} ?>>Banko</option>
        <option value="Ünite" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Ünite"))) {echo "SELECTED";} ?>>Ünite</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>DoubleClick:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="DoubleClick" value="" <?php if($row_TerminalGuncelle['DoubleClick']==1){ echo "checked";} ?>><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Sıralama Tipi:</td>
      <td><select class="form-control" name="SiralamaTipi">
        <option value="1" <?php if (!(strcmp($row_TerminalGuncelle['SiralamaTipi'], "1"))) {echo "SELECTED";} ?>>Alınma Sırası</option>
        <option value="2" <?php if (!(strcmp($row_TerminalGuncelle['SiralamaTipi'], "2"))) {echo "SELECTED";} ?>>Bilet No</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Çağrı Sıralama Tipi:</td>
      <td><select class="form-control" name="CagriSiralamaTipi">       
        <option value="1" <?php if (!(strcmp($row_TerminalGuncelle['CagriSiralamaTipi'], "1"))) {echo "SELECTED";} ?>>Oran</option>
        <option value="2" <?php if (!(strcmp($row_TerminalGuncelle['CagriSiralamaTipi'], "2"))) {echo "SELECTED";} ?>>Kuyruk</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" nowrap><input type="hidden" name="SIL" value="0" size="32">
        <input type="hidden" name="DURUM" value="<?php echo htmlentities($row_TerminalGuncelle['DURUM'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <input type="hidden" name="AKTIF_BID" value="<?php echo htmlentities($row_TerminalGuncelle['AKTIF_BID'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <input type="hidden" name="SON_CAGRILAN_GRUP" value="<?php echo htmlentities($row_TerminalGuncelle['SON_CAGRILAN_GRUP'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <input type="hidden" name="SON_CAGRILAN_TUR" value="<?php echo htmlentities($row_TerminalGuncelle['SON_CAGRILAN_TUR'], ENT_COMPAT, 'utf-8'); ?>" size="32">        <input class="form-control btn btn-primary" type="submit" value="Kaydı Güncelleştir"></td>
      </tr>
  </table></div></div></div>
<input type="hidden" name="TID" value="<?php echo $row_TerminalGuncelle['TID']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  
</form><input type="hidden" name="TID" value="<?php echo $row_TerminalGuncelle['TID']; ?>">
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
</script>

</body>
</html>
<?php
mysql_free_result($TerminalGuncelle);
?>
