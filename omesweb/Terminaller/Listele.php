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

$maxRows_terminalListe = 10;
$pageNum_terminalListe = 0;
if (isset($_GET['pageNum_terminalListe'])) {
  $pageNum_terminalListe = $_GET['pageNum_terminalListe'];
}
$startRow_terminalListe = $pageNum_terminalListe * $maxRows_terminalListe;

mysql_select_db($database_baglantim, $baglantim);
$query_terminalListe = "SELECT * FROM terminaller Order By TID Desc";
$query_limit_terminalListe = sprintf("%s LIMIT %d, %d", $query_terminalListe, $startRow_terminalListe, $maxRows_terminalListe);
$terminalListe = mysql_query($query_limit_terminalListe, $baglantim) or die(mysql_error());
$row_terminalListe = mysql_fetch_assoc($terminalListe);

if (isset($_GET['totalRows_terminalListe'])) {
  $totalRows_terminalListe = $_GET['totalRows_terminalListe'];
} else {
  $all_terminalListe = mysql_query($query_terminalListe);
  $totalRows_terminalListe = mysql_num_rows($all_terminalListe);
}
$totalPages_terminalListe = ceil($totalRows_terminalListe/$maxRows_terminalListe)-1;

$queryString_terminalListe = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_terminalListe") == false && 
        stristr($param, "totalRows_terminalListe") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_terminalListe = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_terminalListe = sprintf("&totalRows_terminalListe=%d%s", $totalRows_terminalListe, $queryString_terminalListe);
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
          <h4 class="modal-title alert alert-danger">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Terminal ve İlişkili Ayarların tümü silindi</strong></p>
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
	if(isset($_GET["Ekle"]) and $_GET["Ekle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Terminal Eklendi</strong></p>
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
          <h4 class="modal-title alert alert-info">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Terminal Güncelleştirildi</strong></p>
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
	if(isset($_GET["TGrup"]) and $_GET["TGrup"]=="ok")
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
          <h4 class="modal-title alert alert-success">Terminal Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Terminal/Grup Eklendi</strong></p>
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
  <div class="panel panel-heading">Terminal Listesi <a class="btn btn-success" style="float:right" href="?TerminalEkle">Yeni Terminal Ekle</a></div>
  <div class="panel body table-responsive">
<?php if ($totalRows_terminalListe > 0) { // Show if recordset not empty ?>
  <table class="table table-hover">
    <tr>
      <th>#TID</th>
      <th>El Terminal ID</th>
      <th>TERMINAL ADI</th>
      <th>OTO. CAGRI</th>
      <th>OTO. SURE</th>
      <th>AKTIF</th>
      <th>Sıralama Tipi</th>
      <th>Çağrılma Tipi</th>
      <th>Terminal Tipi</th>
      <th>Grup Güncelle</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_terminalListe['TID']; ?></td>
        <td><?php echo $row_terminalListe['ELTID']; ?></td>
        <td><?php echo $row_terminalListe['TERMINAL_AD']; ?></td>
        <td><?php if($row_terminalListe['OTO_CAGRI']==0) { echo "Hayır";}else { echo "Evet"; } ?></td>
        <td><?php echo $row_terminalListe['OTO_SURE']; ?></td>
        <td><?php if($row_terminalListe['AKTIF']==0){ echo "Hayır";}else { echo "Evet";} ?></td>
        <td><?php if($row_terminalListe['SiralamaTipi']==0){echo "Bilet Sıralama Türü Seçiniz";} else if($row_terminalListe['SiralamaTipi']==1){ echo "Alınma Sırası";}else if($row_terminalListe['SiralamaTipi']==2){ echo "Bilet No";} ?></td>
        <td><?php if($row_terminalListe['CagriSiralamaTipi']==0){echo "Bilet Sıralama Türü Seçiniz";} else if($row_terminalListe['CagriSiralamaTipi']==1){ echo "Oran";}else if($row_terminalListe['CagriSiralamaTipi']==2){ echo "Kuyruk";} ?></td>
                <td><?php echo $row_terminalListe['TerminalTipi']; ?></td>
                <td><a href="?TerminalGrupListele=<?php echo $row_terminalListe["TID"]."&TERMINAL_AD=".$row_terminalListe['TERMINAL_AD']; ?>" class="btn btn-success">Terminal/Grup Görüntüle</a></td>
        <td><a href="?TerminalGuncelle=<?php echo $row_terminalListe["TID"]; ?>" class="btn btn-info">Terminal Güncelle</a></td>
        <td><a href="?TerminalSil=<?php echo $row_terminalListe["TID"]; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
      <?php } while ($row_terminalListe = mysql_fetch_assoc($terminalListe)); ?>
  </table>
  <table border="0">
    <tr>
      <td><?php if ($pageNum_terminalListe > 0) { // Show if not first page ?>
          <a class="btn btn-success" href="<?php printf("%s?pageNum_terminalListe=%d%s", $currentPage, 0, $queryString_terminalListe); ?>">&#304;lk</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_terminalListe > 0) { // Show if not first page ?>
          <a class="btn btn-warning" href="<?php printf("%s?pageNum_terminalListe=%d%s", $currentPage, max(0, $pageNum_terminalListe - 1), $queryString_terminalListe); ?>">&Ouml;nceki</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_terminalListe < $totalPages_terminalListe) { // Show if not last page ?>
          <a class="btn btn-info" href="<?php printf("%s?pageNum_terminalListe=%d%s", $currentPage, min($totalPages_terminalListe, $pageNum_terminalListe + 1), $queryString_terminalListe); ?>">Sonraki</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_terminalListe < $totalPages_terminalListe) { // Show if not last page ?>
          <a class="btn btn-danger" href="<?php printf("%s?pageNum_terminalListe=%d%s", $currentPage, $totalPages_terminalListe, $queryString_terminalListe); ?>">Son</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
<?php } // Show if recordset not empty ?>
<p>
  <?php if ($totalRows_terminalListe == 0) { // Show if recordset empty ?>
    Henüz bir Terminal Kaydı Oluşturulmamıştır. <a href="?TerminalEkle"  class="btn btn-success">Eklemek için tıklayın</a>
  <?php } // Show if recordset empty ?>
</p></div></div></div>

</body>
</html>
<?php
mysql_free_result($terminalListe);
?>
