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

$maxRows_biletMakinesi = 10;
$pageNum_biletMakinesi = 0;
if (isset($_GET['pageNum_biletMakinesi'])) {
  $pageNum_biletMakinesi = $_GET['pageNum_biletMakinesi'];
}
$startRow_biletMakinesi = $pageNum_biletMakinesi * $maxRows_biletMakinesi;

mysql_select_db($database_baglantim, $baglantim);
$query_biletMakinesi = "SELECT MAKINE_ADRESI, MAKINE_ADI, MAKINE_TURU FROM bilet_makineleri";
$query_limit_biletMakinesi = sprintf("%s LIMIT %d, %d", $query_biletMakinesi, $startRow_biletMakinesi, $maxRows_biletMakinesi);
$biletMakinesi = mysql_query($query_limit_biletMakinesi, $baglantim) or die(mysql_error());
$row_biletMakinesi = mysql_fetch_assoc($biletMakinesi);

if (isset($_GET['totalRows_biletMakinesi'])) {
  $totalRows_biletMakinesi = $_GET['totalRows_biletMakinesi'];
} else {
  $all_biletMakinesi = mysql_query($query_biletMakinesi);
  $totalRows_biletMakinesi = mysql_num_rows($all_biletMakinesi);
}
$totalPages_biletMakinesi = ceil($totalRows_biletMakinesi/$maxRows_biletMakinesi)-1;

$queryString_biletMakinesi = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_biletMakinesi") == false && 
        stristr($param, "totalRows_biletMakinesi") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_biletMakinesi = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_biletMakinesi = sprintf("&totalRows_biletMakinesi=%d%s", $totalRows_biletMakinesi, $queryString_biletMakinesi);
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
<?php if ($totalRows_biletMakinesi > 0) { // Show if recordset not empty ?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Bilet Makinesi Listesi </div>
  <div class="panel body table-responsive">
  <table class="table table-hover">
    <tr>
      <th>MAKINE ADRESI</th>
      <th> ADI</th>
      <th> TÜRÜ</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
    <?php do { ?>
      <tr>
        <td>#<?php echo $row_biletMakinesi['MAKINE_ADRESI']; ?></td>
        <td><?php echo $row_biletMakinesi['MAKINE_ADI']; ?></td>
        <td><?php if($row_biletMakinesi['MAKINE_TURU']==1){echo "Kiosk"; }else if($row_biletMakinesi['MAKINE_TURU']==2){ echo "Buton"; }else{ echo "Diğer";}?></td>
        <td><a class="btn btn-info" href="?BiletMakinesiGuncelle=<?php echo $row_biletMakinesi['MAKINE_ADRESI']; ?>" >Güncelle</a></td>
        <td><a href="?BiletMakinesiSil=<?php echo $row_biletMakinesi['MAKINE_ADRESI']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
      <?php } while ($row_biletMakinesi = mysql_fetch_assoc($biletMakinesi)); ?>
  </table>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_biletMakinesi > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_biletMakinesi=%d%s", $currentPage, 0, $queryString_biletMakinesi); ?>">&#304;lk</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_biletMakinesi > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_biletMakinesi=%d%s", $currentPage, max(0, $pageNum_biletMakinesi - 1), $queryString_biletMakinesi); ?>">&Ouml;nceki</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_biletMakinesi < $totalPages_biletMakinesi) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_biletMakinesi=%d%s", $currentPage, min($totalPages_biletMakinesi, $pageNum_biletMakinesi + 1), $queryString_biletMakinesi); ?>">Sonraki</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_biletMakinesi < $totalPages_biletMakinesi) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_biletMakinesi=%d%s", $currentPage, $totalPages_biletMakinesi, $queryString_biletMakinesi); ?>">Son</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table></div></div></div>
  <?php } // Show if recordset not empty ?>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
<?php if ($totalRows_biletMakinesi == 0) { // Show if recordset empty ?>
  <p>Henüz Makine Eklenmemiştir. Eklemek için Yandaki Formu Kullanın.</p>
  <?php } // Show if recordset empty ?>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
  </script>
</body>
</html>
<?php
mysql_free_result($biletMakinesi);
?>
