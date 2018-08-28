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

$maxRows_AnaTablo = 10;
$pageNum_AnaTablo = 0;
if (isset($_GET['pageNum_AnaTablo'])) {
  $pageNum_AnaTablo = $_GET['pageNum_AnaTablo'];
}
$startRow_AnaTablo = $pageNum_AnaTablo * $maxRows_AnaTablo;

mysql_select_db($database_baglantim, $baglantim);
$query_AnaTablo = "SELECT ATID, TABLO_ADI, TABLO_TURU FROM anatablolar ORDER BY ATID ASC";
$query_limit_AnaTablo = sprintf("%s LIMIT %d, %d", $query_AnaTablo, $startRow_AnaTablo, $maxRows_AnaTablo);
$AnaTablo = mysql_query($query_limit_AnaTablo, $baglantim) or die(mysql_error());
$row_AnaTablo = mysql_fetch_assoc($AnaTablo);

if (isset($_GET['totalRows_AnaTablo'])) {
  $totalRows_AnaTablo = $_GET['totalRows_AnaTablo'];
} else {
  $all_AnaTablo = mysql_query($query_AnaTablo);
  $totalRows_AnaTablo = mysql_num_rows($all_AnaTablo);
}
$totalPages_AnaTablo = ceil($totalRows_AnaTablo/$maxRows_AnaTablo)-1;

$queryString_AnaTablo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_AnaTablo") == false && 
        stristr($param, "totalRows_AnaTablo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_AnaTablo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_AnaTablo = sprintf("&totalRows_AnaTablo=%d%s", $totalRows_AnaTablo, $queryString_AnaTablo);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
</head>

<body><div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Listesi<a class="btn btn-success" style="float:right" href="?AnaTabloEkle" >Yeni Ana Tablo Ekle</a></div>
  <div class="panel body table-responsive">
<?php if ($totalRows_AnaTablo > 0) { // Show if recordset not empty ?>

  <table class="table table-hover">
    <tr>
      <th>AnaTablo ID</th>
      <th>TABLO ADI</th>
      <th>TABLO TURU</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_AnaTablo['ATID']; ?></td>
        <td><?php echo $row_AnaTablo['TABLO_ADI']; ?></td>
        <td><?php if($row_AnaTablo['TABLO_TURU']==1){ echo "LCD tablo";} else if($row_AnaTablo['TABLO_TURU']==2){ echo "LED tablo";} else{ echo "Tablo Türü Bilinmiyor";}?></td>
        <td><a class="btn btn-info" href="?AnaTabloGuncelle=<?php echo $row_AnaTablo['ATID']; ?>">Güncelle</a></td>
        <td><a href="?AnaTabloSil=<?php echo $row_AnaTablo['ATID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek İstediğinizden Emin misiniz?');">Sil</a></td>
      </tr>
      <?php } while ($row_AnaTablo = mysql_fetch_assoc($AnaTablo)); ?>
  </table>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_AnaTablo > 0) { // Show if not first page ?>
          <a class="btn btn-success" href="<?php printf("%s?pageNum_AnaTablo=%d%s", $currentPage, 0, $queryString_AnaTablo); ?>">&#304;lk</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_AnaTablo > 0) { // Show if not first page ?>
          <a class="btn btn-warning" href="<?php printf("%s?pageNum_AnaTablo=%d%s", $currentPage, max(0, $pageNum_AnaTablo - 1), $queryString_AnaTablo); ?>">&Ouml;nceki</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_AnaTablo < $totalPages_AnaTablo) { // Show if not last page ?>
          <a class="btn btn-info" href="<?php printf("%s?pageNum_AnaTablo=%d%s", $currentPage, min($totalPages_AnaTablo, $pageNum_AnaTablo + 1), $queryString_AnaTablo); ?>">Sonraki</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_AnaTablo < $totalPages_AnaTablo) { // Show if not last page ?>
          <a class="btn btn-danger" href="<?php printf("%s?pageNum_AnaTablo=%d%s", $currentPage, $totalPages_AnaTablo, $queryString_AnaTablo); ?>">Son</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table><div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  <?php } // Show if recordset not empty ?>
  
<p>
  <?php if ($totalRows_AnaTablo == 0) { // Show if recordset empty ?>
    Henüz Anatablo bilgileri eklenmemiştir. Eklemek İçin <a class="btn btn-success" href="?AnaTabloEkle">Tıklayınız</a>
    
  <?php } // Show if recordset empty ?>
</p>
</div></div></div>
</body>
</html>
<?php
mysql_free_result($AnaTablo);
?>
