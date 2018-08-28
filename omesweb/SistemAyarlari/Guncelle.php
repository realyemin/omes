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
  $updateSQL = sprintf("UPDATE sistem_config SET FIRMA_ISMI=%s, SERVER_IP=%s WHERE ID=%s",
                       GetSQLValueString($_POST['FIRMA_ISMI'], "text"),
                       GetSQLValueString($_POST['SERVER_IP'], "text"),
					   GetSQLValueString($_POST['ID'], "text"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?SistemAyarlari=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_SistemAyarlari = "SELECT ID, SERVER_IP, FIRMA_ISMI FROM sistem_config";
$SistemAyarlari = mysql_query($query_SistemAyarlari, $baglantim) or die(mysql_error());
$row_SistemAyarlari = mysql_fetch_assoc($SistemAyarlari);
$totalRows_SistemAyarlari = mysql_num_rows($SistemAyarlari);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	if(isset($_GET["SistemAyarlari"]) and $_GET["SistemAyarlari"]=="ok")
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
          <h4 class="modal-title alert alert-info">Sistem Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Sistem Ayarları Güncellendi</strong></p>
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
  <div class="panel panel-heading">Genel Sistem Ayarları <a href="?SistemAyarSil&tumu=ok" class="btn btn-danger" id="sprytrigger1" style="float:right" onClick="return confirm('Tüm kayıtları silmek istediğinizden emin misiniz?');">
  Tüm Ayarları Sil</a></div>
  <div class="panel body">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right">QPU SERVER IP:</td>
      <td><span id="sprytextfield1">
    <input class="form-control" type="text" name="SERVER_IP" value="<?php echo $row_SistemAyarlari['SERVER_IP']; ?>">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">FIRMA ISMI:</td>
      <td><span id="sprytextfield2">
        <input class="form-control" type="text" name="FIRMA_ISMI" value="<?php echo htmlentities($row_SistemAyarlari['FIRMA_ISMI'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input class="form-control btn btn-info" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="ID" value="<?php echo $row_SistemAyarlari['ID']; ?>">
</form>
<div class="tooltipContent" id="sprytooltip1">Dikkat! Bu işlem tüm sistemi sıfırlar ve ilk haline döndürür.</div>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
</body>
</html>
<?php
mysql_free_result($SistemAyarlari);
?>
