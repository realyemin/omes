<?php //require_once('../Connections/baglantim.php'); ?><?php
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
  $insertSQL = sprintf("INSERT INTO bilet_makineleri (MAKINE_ADRESI, MAKINE_ADI, MAKINE_TURU) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['MAKINE_ADRESI'], "int"),
                       GetSQLValueString($_POST['MAKINE_ADI'], "text"),
                       GetSQLValueString($_POST['MAKINE_TURU'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?BiletMakinesiEkle&Bilet=ok&";
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
<?php
	if(isset($_GET["Sil"]) and $_GET["Sil"]=="ok")
	{
	?>
<script>
    $(document).ready(function(){
$('#my-modal').modal('show');
});
</script>
        <div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title alert alert-danger">Bilet Makinesi</h4>
        </div>
        <div class="modal-body">
          <p><strong>Bilet Makinesi ve İlişkili Ayarların tümü silindi</strong></p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>
<?php
	}
?>
<?php
	if(isset($_GET["Bilet"]) and $_GET["Bilet"]=="ok")
	{
	?>
<script>
    $(document).ready(function(){
$('#my-modal').modal('show');
});
</script>
        <div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title alert alert-success">Bilet Makinesi</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Bilet Makinesi Eklendi</strong></p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>
<?php
	}
?>
<?php
	if(isset($_GET["gnc"]) and $_GET["gnc"]=="ok")
	{
	?>
<script>
    $(document).ready(function(){
$('#my-modal').modal('show');
});
</script>
        <div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title alert alert-info">Bilet Makinesi</h4>
        </div>
        <div class="modal-body">
          <p><strong>Bilet Makinesi Güncelleştirildi</strong></p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>
<?php
	}
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Bilet Makinesi Ekle </div>
  <div class="panel body table-responsive">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right">MAKINE ADRESI:</td>
      <td><span id="sprytextfield2">
      <input class="form-control" type="number" min="1" max="1000" name="MAKINE_ADRESI" value="1" placeholder="1-1000 arası bir değer giriniz" size="32">                
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MAKINE ADI:</td>
      <td><span id="sprytextfield1">
        <input class="form-control" type="text" name="MAKINE_ADI" value="" size="32" maxlength="25" placeholder="Makine adını yazınız">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MAKINE TÜRÜ:</td>
      <td valign="baseline"><table>
        <tr>
          <td><label class="switch"><input name="MAKINE_TURU" type="radio" value="1" checked >
            <span class="slider round"></span></label>KIOSK</td>
        </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="MAKINE_TURU" value="2" >
            <span class="slider round"></span></label>BUTON</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input class="form-control btn btn-success" type="submit" value="Kayıt Ekle"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
</script>
</body>
</html>