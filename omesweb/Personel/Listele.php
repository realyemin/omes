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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Personel = 10;
$pageNum_Personel = 0;
if (isset($_GET['pageNum_Personel'])) {
  $pageNum_Personel = $_GET['pageNum_Personel'];
}
$startRow_Personel = $pageNum_Personel * $maxRows_Personel;

mysql_select_db($database_baglantim, $baglantim);
$query_Personel = "SELECT PID, TID, AD, SOYAD, ADRES, TEL, GSM, EMAIL, ACIKLAMA, CALISIYOR, KAYIT_TARIHI, KULLANICI_ADI, SIFRE, OTURUM_DURUM FROM personeller WHERE PID <> 1";
$query_limit_Personel = sprintf("%s LIMIT %d, %d", $query_Personel, $startRow_Personel, $maxRows_Personel);
$Personel = mysql_query($query_limit_Personel, $baglantim) or die(mysql_error());
$row_Personel = mysql_fetch_assoc($Personel);

if (isset($_GET['totalRows_Personel'])) {
  $totalRows_Personel = $_GET['totalRows_Personel'];
} else {
  $all_Personel = mysql_query($query_Personel);
  $totalRows_Personel = mysql_num_rows($all_Personel);
}
$totalPages_Personel = ceil($totalRows_Personel/$maxRows_Personel)-1;



$queryString_Personel = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Personel") == false && 
        stristr($param, "totalRows_Personel") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Personel = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Personel = sprintf("&totalRows_Personel=%d%s", $totalRows_Personel, $queryString_Personel);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	if(isset($_GET["Personel"]) and $_GET["Personel"]=="ok")
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
          <h4 class="modal-title alert alert-success">Personel Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Personel Kaydı Yapıldı</strong></p>
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
	if(isset($_GET["Personel"]) and $_GET["Personel"]=="gnc")
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
          <h4 class="modal-title alert alert-info">Personel Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Personel Bilgileri Güncelleştirildi.</strong></p>
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
<div class="panel panel-primary">
<div class="panel panel-heading">Personel Bilgileri <a class="btn btn-success" href="?PersonelEkle">Yeni Personel Kaydı</a></div>
<div class="panel body table-responsive" style="overflow:auto;">
<table class="table table-hover table-condensed">
  <tr>
    <th>#</th>
    <th>Kullanıcı Adı</th>
    <th>Terminal AD</th>
    <th>Ad</th>
    <th>Soyad</th>
    <th>Adres</th>
    <th>Tel</th>
    <th>Gsm</th>
    <th>Email</th>
    <th>Çalışıyor</th>
    <th>Kayıt Tarihi</th>
    <th>Güncelle</th>
    <th>Sil</th>
    </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Personel['PID']; ?></td>
      <td><?php echo $row_Personel['KULLANICI_ADI']; ?></td>
      <td>
	 <?php 

$query_Terminal = sprintf("SELECT TID, TERMINAL_AD FROM terminaller WHERE TID = %s", GetSQLValueString($row_Personel['TID'], "int"));
$Terminal = mysql_query($query_Terminal, $baglantim) or die(mysql_error());
$row_Terminal = mysql_fetch_assoc($Terminal);
	 ?> 
	  <?php echo $row_Terminal['TERMINAL_AD']; ?></td>
      <td><?php echo $row_Personel['AD']; ?></td>
      <td><?php echo $row_Personel['SOYAD']; ?></td>
      <td><?php echo $row_Personel['ADRES']; ?></td>
      <td><?php echo $row_Personel['TEL']; ?></td>
      <td><?php echo $row_Personel['GSM']; ?></td>
      <td><?php echo $row_Personel['EMAIL']; ?></td>
      <td><label class="switch"><input type="checkbox" disabled <?php if($row_Personel['CALISIYOR']==1){echo 'checked';} ?>><span class="slider round"></span></label></td>
      <td><?php echo $row_Personel['KAYIT_TARIHI']; ?></td>
      <td><a href="?PersonelGuncelle=<?php echo $row_Personel["PID"]; ?>" class="btn btn-info">Güncelle</a></td>
      <td><a href="?PersonelSil=<?php echo $row_Personel["PID"]; ?>" class="btn btn-danger" id="sprytrigger1"  onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
    <?php } while ($row_Personel = mysql_fetch_assoc($Personel)); ?>
</table>
<table border="0">
  <tr>
    <td><?php if ($pageNum_Personel > 0) { // Show if not first page ?>
        <a class="btn btn-success" href="<?php printf("%s?pageNum_Personel=%d%s", $currentPage, 0, $queryString_Personel); ?>">&#304;lk</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Personel > 0) { // Show if not first page ?>
        <a class="btn btn-warning" href="<?php printf("%s?pageNum_Personel=%d%s", $currentPage, max(0, $pageNum_Personel - 1), $queryString_Personel); ?>">&Ouml;nceki</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Personel < $totalPages_Personel) { // Show if not last page ?>
        <a class="btn btn-info" href="<?php printf("%s?pageNum_Personel=%d%s", $currentPage, min($totalPages_Personel, $pageNum_Personel + 1), $queryString_Personel); ?>">Sonraki</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Personel < $totalPages_Personel) { // Show if not last page ?>
        <a class="btn btn-danger" href="<?php printf("%s?pageNum_Personel=%d%s", $currentPage, $totalPages_Personel, $queryString_Personel); ?>">Son</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</div></div>
<div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Geri Alınamaz.</div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
</body>
</html>
<?php
mysql_free_result($Personel);

mysql_free_result($Terminal);
?>
