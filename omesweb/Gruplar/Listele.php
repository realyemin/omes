<?php // require_once('../Connections/baglantim.php'); ?>
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

$maxRows_GrupListele = 10;
$pageNum_GrupListele = 0;
if (isset($_GET['pageNum_GrupListele'])) {
  $pageNum_GrupListele = $_GET['pageNum_GrupListele'];
}
$startRow_GrupListele = $pageNum_GrupListele * $maxRows_GrupListele;

mysql_select_db($database_baglantim, $baglantim);
$query_GrupListele = "SELECT * FROM gruplar ORDER BY GRPID DESC";
$query_limit_GrupListele = sprintf("%s LIMIT %d, %d", $query_GrupListele, $startRow_GrupListele, $maxRows_GrupListele);
$GrupListele = mysql_query($query_limit_GrupListele, $baglantim) or die(mysql_error());
$row_GrupListele = mysql_fetch_assoc($GrupListele);

if (isset($_GET['totalRows_GrupListele'])) {
  $totalRows_GrupListele = $_GET['totalRows_GrupListele'];
} else {
  $all_GrupListele = mysql_query($query_GrupListele);
  $totalRows_GrupListele = mysql_num_rows($all_GrupListele);
}
$totalPages_GrupListele = ceil($totalRows_GrupListele/$maxRows_GrupListele)-1;

$queryString_GrupListele = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_GrupListele") == false && 
        stristr($param, "totalRows_GrupListele") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_GrupListele = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_GrupListele = sprintf("&totalRows_GrupListele=%d%s", $totalRows_GrupListele, $queryString_GrupListele);
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
          <h4 class="modal-title alert alert-danger">Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Gruplar ve İlişkili Ayarların tümü silindi</strong></p>
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
	if(isset($_GET["GrupEkle"]) and $_GET["GrupEkle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Grup Eklendi</strong></p>
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
          <h4 class="modal-title alert alert-info">Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Gruplar Güncelleştirildi</strong></p>
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
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">GRUP Listesi <a class="btn btn-success" style="float:right" href="?GrupEkle&">Yeni Grup Ekle</a></div>
  <div class="panel body table-responsive">
  <?php if ($totalRows_GrupListele > 0) { // Show if recordset not empty ?>
  <table class="table">
    <tr class="label-info">
      <th>GRUP ISMI</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
    <?php do { ?>
      <tr>
        <td class="alert alert-success"><strong><?php echo $row_GrupListele['GRUP_ISMI']; ?></strong></td>
        <td><a class="btn btn-primary" href="?GrupGuncelle=<?php echo $row_GrupListele['GRPID']; ?>">Güncelle #<?php echo $row_GrupListele['GRPID']; ?></a></td>
        <td><a onClick="return confirm('Silmek istediğinizden emin misiniz?');" href="?GrupSil=<?php echo $row_GrupListele['GRPID']; ?>" class="btn btn-danger" id="sprytrigger1">Sil #<?php echo $row_GrupListele['GRPID']; ?></a></td>
      </tr>
      <?php } while ($row_GrupListele = mysql_fetch_assoc($GrupListele)); ?>
  </table>
  <table class="pagination pagination-lg mtm mbm">
    <tr>
      <td><?php if ($pageNum_GrupListele > 0) { // Show if not first page ?>
        <a class="btn btn-success" href="<?php printf("%s?pageNum_GrupListele=%d%s", $currentPage, 0, $queryString_GrupListele); ?>">&#304;lk</a>
        <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_GrupListele > 0) { // Show if not first page ?>
        <a class="btn btn-warning" href="<?php printf("%s?pageNum_GrupListele=%d%s", $currentPage, max(0, $pageNum_GrupListele - 1), $queryString_GrupListele); ?>">&Ouml;nceki</a>
        <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_GrupListele < $totalPages_GrupListele) { // Show if not last page ?>
        <a class="btn btn-info" href="<?php printf("%s?pageNum_GrupListele=%d%s", $currentPage, min($totalPages_GrupListele, $pageNum_GrupListele + 1), $queryString_GrupListele); ?>">Sonraki</a>
        <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_GrupListele < $totalPages_GrupListele) { // Show if not last page ?>
        <a class="btn btn-danger" href="<?php printf("%s?pageNum_GrupListele=%d%s", $currentPage, $totalPages_GrupListele, $queryString_GrupListele); ?>">Son</a>
        <?php } // Show if not last page ?></td>
    </tr>
  </table>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Bir Daha Geri Alınamaz!</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  <?php } // Show if recordset not empty ?>
  </div></div></div>
  

<p>
  <?php if ($totalRows_GrupListele == 0) { // Show if recordset empty ?>
    Listelenecek Grup Bulunamadı. <a href="?GrupEkle" class="btn btn-success"> Yeni Grup Eklemek İçin Tıklayınız</a>
  <?php } // Show if recordset empty ?>
</p>
</body>
</html>
<?php
mysql_free_result($GrupListele);
?>
