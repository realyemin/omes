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

$maxRows_TerminalGrup = 10;
$pageNum_TerminalGrup = 0;
if (isset($_GET['pageNum_TerminalGrup'])) {
  $pageNum_TerminalGrup = $_GET['pageNum_TerminalGrup'];
}
$startRow_TerminalGrup = $pageNum_TerminalGrup * $maxRows_TerminalGrup;

$colname_TerminalGrup = "-1";
if (isset($_GET['TerminalGrupListele'])) {
  $colname_TerminalGrup = $_GET['TerminalGrupListele'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_TerminalGrup = sprintf("SELECT * FROM terminal_grup WHERE TID = %s", GetSQLValueString($colname_TerminalGrup, "int"));
$query_limit_TerminalGrup = sprintf("%s LIMIT %d, %d", $query_TerminalGrup, $startRow_TerminalGrup, $maxRows_TerminalGrup);
$TerminalGrup = mysql_query($query_limit_TerminalGrup, $baglantim) or die(mysql_error());
$row_TerminalGrup = mysql_fetch_assoc($TerminalGrup);

if (isset($_GET['totalRows_TerminalGrup'])) {
  $totalRows_TerminalGrup = $_GET['totalRows_TerminalGrup'];
} else {
  $all_TerminalGrup = mysql_query($query_TerminalGrup);
  $totalRows_TerminalGrup = mysql_num_rows($all_TerminalGrup);
}
$totalPages_TerminalGrup = ceil($totalRows_TerminalGrup/$maxRows_TerminalGrup)-1;



$queryString_TerminalGrup = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_TerminalGrup") == false && 
        stristr($param, "totalRows_TerminalGrup") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_TerminalGrup = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_TerminalGrup = sprintf("&totalRows_TerminalGrup=%d%s", $totalRows_TerminalGrup, $queryString_TerminalGrup);
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
          <h4 class="modal-title alert alert-info">Terminal Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Terminal Grupları Güncelleştirildi</strong></p>
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
<?php if ($totalRows_TerminalGrup > 0) { // Show if recordset not empty ?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Terminal/GRUP Listesi<a class="btn btn-success" style="float:right" href="?TerminalGrupEkle" >Yeni Terminal Grup Ekle</a></div><div class="panel body table-responsive">
  <table class="table table-hover">
    <tr class="alert alert-info">
      <th>TGID</th>
      <th>Terminal</th>
      <th>Grup İsmi</th>
      <th>ÇAĞRI ORANI</th>
      <th>TRANSFER ORANI</th>
      <th>CAGRILAN</th>
      <th>TRANSFER CAGRILAN</th>
      <th>YARDIM GRUBU</th>
      <th>AYRICALIKLI</th>
      <th>ÖNCELİK</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_TerminalGrup['TGID']; ?></td>
        <td><strong>
          <em>
          <?php mysql_select_db($database_baglantim, $baglantim);
$query_terminal = "SELECT TERMINAL_AD FROM terminaller WHERE TID = $row_TerminalGrup[TID]";
$terminal = mysql_query($query_terminal, $baglantim) or die(mysql_error());
$row_terminal = mysql_fetch_assoc($terminal);
$totalRows_terminal = mysql_num_rows($terminal);
 echo $row_terminal['TERMINAL_AD']; 
 mysql_free_result($terminal);?>
        </em></strong></td>
        <td><strong>
          <em>
          <?php mysql_select_db($database_baglantim, $baglantim);
$query_grup = "SELECT GRUP_ISMI FROM gruplar WHERE GRPID = $row_TerminalGrup[GRPID];";
$grup = mysql_query($query_grup, $baglantim) or die(mysql_error());
$row_grup = mysql_fetch_assoc($grup);
$totalRows_grup = mysql_num_rows($grup); echo $row_grup['GRUP_ISMI'];
mysql_free_result($grup); ?>
        </em></strong></td>
        <td><?php echo $row_TerminalGrup['CAGRI_ORAN']; ?></td>
        <td><?php echo $row_TerminalGrup['TRANSFER_ORAN']; ?></td>
        <td><?php echo $row_TerminalGrup['CAGRILAN']; ?></td>
        <td><?php echo $row_TerminalGrup['TRANSFER_CAGRILAN']; ?></td>
        <td><?php if($row_TerminalGrup['YARDIM_GRUBU']==1){echo "EVET";}else {echo "HAYIR";} ?></td>
        <td><?php if($row_TerminalGrup['AYRICALIKLI']==1){ echo "Evet";}else { echo "Hayır"; } ?></td>
        <td><?php echo $row_TerminalGrup['ONCELIK']; ?></td>
        <td><a class="btn btn-info" href="?TerminalGrupGuncelle=<?php echo $row_TerminalGrup['TGID']; ?>">Güncelle</a></td>
        <td><a href="?TerminalGrupSil=<?php echo $row_TerminalGrup['TGID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
      <?php } while ($row_TerminalGrup = mysql_fetch_assoc($TerminalGrup)); ?>
  </table>
  <table>
    <tr>
      <td><?php if ($pageNum_TerminalGrup > 0) { // Show if not first page ?>
          <a class="btn btn-success" href="<?php printf("%s?pageNum_TerminalGrup=%d%s", $currentPage, 0, $queryString_TerminalGrup); ?>">&#304;lk</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_TerminalGrup > 0) { // Show if not first page ?>
          <a class="btn btn-warning" href="<?php printf("%s?pageNum_TerminalGrup=%d%s", $currentPage, max(0, $pageNum_TerminalGrup - 1), $queryString_TerminalGrup); ?>">&Ouml;nceki</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_TerminalGrup < $totalPages_TerminalGrup) { // Show if not last page ?>
          <a class="btn btn-info" href="<?php printf("%s?pageNum_TerminalGrup=%d%s", $currentPage, min($totalPages_TerminalGrup, $pageNum_TerminalGrup + 1), $queryString_TerminalGrup); ?>">Sonraki</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_TerminalGrup < $totalPages_TerminalGrup) { // Show if not last page ?>
          <a class="btn btn-danger" href="<?php printf("%s?pageNum_TerminalGrup=%d%s", $currentPage, $totalPages_TerminalGrup, $queryString_TerminalGrup); ?>">Son</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table></div></div></div>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
    </script>
<?php } // Show if recordset not empty ?>

<?php if ($totalRows_TerminalGrup == 0) { // Show if recordset empty ?>
    <p class="alert alert-danger"><span class="btn btn-success">#<?php echo $_GET['TerminalGrupListele']."-".$_GET['TERMINAL_AD']; ?> </span>nolu Terminalin Henüz Grupları oluşturulmamıştır. Oluşturmak İçin <a href="?TerminalGrupEkle" class="btn btn-success" >Tıklayınız.</a></p>
    <?php } // Show if recordset empty ?>

</body>
</html>
<?php
mysql_free_result($TerminalGrup);

?>
