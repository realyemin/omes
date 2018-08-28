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

$maxRows_AnaTabloYon = 10;
$pageNum_AnaTabloYon = 0;
if (isset($_GET['pageNum_AnaTabloYon'])) {
  $pageNum_AnaTabloYon = $_GET['pageNum_AnaTabloYon'];
}
$startRow_AnaTabloYon = $pageNum_AnaTabloYon * $maxRows_AnaTabloYon;

mysql_select_db($database_baglantim, $baglantim);
$query_AnaTabloYon = "SELECT anatablo_yon.YID, anatablolar.TABLO_ADI, terminaller.TERMINAL_AD,anatablo_yon.YON, anatablo_yon.Port FROM anatablolar INNER JOIN anatablo_yon on anatablolar.ATID=anatablo_yon.ATID INNER JOIN terminaller on terminaller.TID=anatablo_yon.TID ";
$query_limit_AnaTabloYon = sprintf("%s LIMIT %d, %d", $query_AnaTabloYon, $startRow_AnaTabloYon, $maxRows_AnaTabloYon);
$AnaTabloYon = mysql_query($query_limit_AnaTabloYon, $baglantim) or die(mysql_error());
$row_AnaTabloYon = mysql_fetch_assoc($AnaTabloYon);

if (isset($_GET['totalRows_AnaTabloYon'])) {
  $totalRows_AnaTabloYon = $_GET['totalRows_AnaTabloYon'];
} else {
  $all_AnaTabloYon = mysql_query($query_AnaTabloYon);
  $totalRows_AnaTabloYon = mysql_num_rows($all_AnaTabloYon);
}
$totalPages_AnaTabloYon = ceil($totalRows_AnaTabloYon/$maxRows_AnaTabloYon)-1;

$queryString_AnaTabloYon = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_AnaTabloYon") == false && 
        stristr($param, "totalRows_AnaTabloYon") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_AnaTabloYon = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_AnaTabloYon = sprintf("&totalRows_AnaTabloYon=%d%s", $totalRows_AnaTabloYon, $queryString_AnaTabloYon);
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
  <div class="panel panel-heading">AnaTablo Yön Listesi<a class="btn btn-success" style="float:right" href="?AnaTabloYonEkle" >Yeni AnaTablo Yön Ekle</a></div>
  <div class="panel body table-responsive">
<?php if ($totalRows_AnaTabloYon > 0) { // Show if recordset not empty ?>
  <table class="table table-hover">
    <tr>
      <th>YID</th>
      <th>TABLO ADI</th>
      <th>TERMINAL AD</th>
      <th>YON</th>
      <th>Port</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_AnaTabloYon['YID']; ?></td>
        <td><?php echo $row_AnaTabloYon['TABLO_ADI']; ?></td>
        <td><?php echo $row_AnaTabloYon['TERMINAL_AD']; ?></td>
        <td><?php if($row_AnaTabloYon['YON']==1){ echo "Yukarı";} else if($row_AnaTabloYon['YON']==2){ echo "     Aşağı";} else if($row_AnaTabloYon['YON']==3){ echo "     Sağ";}else if($row_AnaTabloYon['YON']==4){ echo "Sol";}else if($row_AnaTabloYon['YON']==5){ echo "Kapalı";}else { echo "Yön geçersiz"; }                       ?></td>
        <td><?php echo $row_AnaTabloYon['Port']; ?></td>
        <td><a class="btn btn-info" href="?AnaTabloYonGuncelle=<?php echo $row_AnaTabloYon['YID']; ?>">Güncelle</a></td>
        <td><a href="?AnaTabloYonSil=<?php echo $row_AnaTabloYon['YID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek İstediğinizden Emin misini?');">Sil</a></td>
      </tr>
      <?php } while ($row_AnaTabloYon = mysql_fetch_assoc($AnaTabloYon)); ?>
  </table>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_AnaTabloYon > 0) { // Show if not first page ?>
          <a class="btn btn-success" href="<?php printf("%s?pageNum_AnaTabloYon=%d%s", $currentPage, 0, $queryString_AnaTabloYon); ?>">&#304;lk</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_AnaTabloYon > 0) { // Show if not first page ?>
          <a class="btn btn-warning" href="<?php printf("%s?pageNum_AnaTabloYon=%d%s", $currentPage, max(0, $pageNum_AnaTabloYon - 1), $queryString_AnaTabloYon); ?>">&Ouml;nceki</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_AnaTabloYon < $totalPages_AnaTabloYon) { // Show if not last page ?>
          <a class="btn btn-info" href="<?php printf("%s?pageNum_AnaTabloYon=%d%s", $currentPage, min($totalPages_AnaTabloYon, $pageNum_AnaTabloYon + 1), $queryString_AnaTabloYon); ?>">Sonraki</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_AnaTabloYon < $totalPages_AnaTabloYon) { // Show if not last page ?>
          <a class="btn btn-danger" href="<?php printf("%s?pageNum_AnaTabloYon=%d%s", $currentPage, $totalPages_AnaTabloYon, $queryString_AnaTabloYon); ?>">Son</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
<?php } // Show if recordset not empty ?>
<p>
  <?php if ($totalRows_AnaTabloYon == 0) { // Show if recordset empty ?>
    Henüz AnaTablo için Yön ayarları eklenmemiştir. Eklemek için <a class="btn btn-success" href="?AnaTabloYonEkle">Tıklayınız.</a>
  <?php } // Show if recordset empty ?>
</p>
</div></div></div>

</body>
</html>
<?php
mysql_free_result($AnaTabloYon);
?>
