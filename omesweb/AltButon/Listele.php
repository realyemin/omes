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


$maxRows_AnaButon = 10;
$pageNum_AnaButon = 0;
if (isset($_GET['pageNum_AnaButon'])) {
  $pageNum_AnaButon = $_GET['pageNum_AnaButon'];
}
$startRow_AnaButon = $pageNum_AnaButon * $maxRows_AnaButon;

mysql_select_db($database_baglantim, $baglantim);
$query_AnaButon = "SELECT * FROM butonlar WHERE ANA_BTNID <>0 ORDER BY BM_ADRES, BTNID ASC";
$query_limit_AnaButon = sprintf("%s LIMIT %d, %d", $query_AnaButon, $startRow_AnaButon, $maxRows_AnaButon);
$AnaButon = mysql_query($query_limit_AnaButon, $baglantim) or die(mysql_error());
$row_AnaButon = mysql_fetch_assoc($AnaButon);

if (isset($_GET['totalRows_AnaButon'])) {
  $totalRows_AnaButon = $_GET['totalRows_AnaButon'];
} else {
  $all_AnaButon = mysql_query($query_AnaButon);
  $totalRows_AnaButon = mysql_num_rows($all_AnaButon);
}
$totalPages_AnaButon = ceil($totalRows_AnaButon/$maxRows_AnaButon)-1;

$queryString_AnaButon = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_AnaButon") == false && 
        stristr($param, "totalRows_AnaButon") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_AnaButon = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_AnaButon = sprintf("&totalRows_AnaButon=%d%s", $totalRows_AnaButon, $queryString_AnaButon);
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
<?php if ($totalRows_AnaButon > 0) { // Show if recordset not empty ?>
  <a name="ust"></a>
<div class="form-group">
  <div class="panel panel-pink">
      <div class="panel panel-heading">Alt Buton Listesi</div>
      <div class="panel body table-responsive">
        <table class="table table-hover table-condensed ">
          <thead>
            <tr class="alert alert-info">
              <th>Bilet Makinesi</th>
              <th>ANA BUTON ID</th>
              <th>ALT BUTON ID</th>
              <th>1.Grup</th>
              <th>1.Oran</th>
              <th>2.Grup</th>
              <th>2.Oran</th>
              <th>3.Grup</th>
              <th>3.Oran</th>
              <th>4.Grup</th>
              <th>4.Oran</th>
              <th>&nbsp;</th>
              <th>AKTIF</th>
              <th>Randevu Butonu Mu?</th>
              <th>Detay</th>
              <th>Güncelle</th>
              <th>Sil</th>
          </tr></thead>
          <?php do { ?>
            <tr>
              <td><?php 
	  mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi =sprintf("SELECT MAKINE_ADRESI, MAKINE_ADI FROM bilet_makineleri WHERE MAKINE_ADRESI = %s",GetSQLValueString($row_AnaButon['BM_ADRES'], "int"));
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);

	  
	  echo "<span class='label label-default'>#".$row_AnaButon["BM_ADRES"]."</span></br>".$row_BiletMakinesi['MAKINE_ADI']; ?>
                
              </td>
              <td><?php if($row_AnaButon['ANA_BTNID']==0){echo "Evet";}else{ echo "<span class='label label-success'>".$row_AnaButon['ANA_BTNID']."</span>";} 
	   ?></td>
              <td><span class="label label-dark"><?php echo $row_AnaButon['BTNID']; ?></span></td>
              <td><?php 
	  mysql_select_db($database_baglantim, $baglantim);
$query_Grup =sprintf("SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID= %s", GetSQLValueString($row_AnaButon['GRP_ID'], "int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-info"> <?php echo $row_AnaButon['GRP1_ORAN']; ?></span></td>
              <td><?php 
	  mysql_select_db($database_baglantim, $baglantim);
$query_Grup =sprintf("SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID= %s", GetSQLValueString($row_AnaButon['GRP_ID2'], "int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID2']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-success"><?php echo $row_AnaButon['GRP2_ORAN']; ?></span></td>
              <td><?php 
	  mysql_select_db($database_baglantim, $baglantim);
$query_Grup =sprintf("SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID= %s", GetSQLValueString($row_AnaButon['GRP_ID3'], "int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID3']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-warning"><?php echo $row_AnaButon['GRP3_ORAN']; ?></span></td>
              <td><?php 
	  mysql_select_db($database_baglantim, $baglantim);
$query_Grup =sprintf("SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID= %s", GetSQLValueString($row_AnaButon['GRP_ID4'], "int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID4']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-danger"><?php echo $row_AnaButon['GRP4_ORAN']; ?></span></td>
              <td>&nbsp;</td>
              <td><?php if($row_AnaButon['AKTIF']==1){echo "Evet";} else{ echo "Hayır";} ?></td>
              <td><?php if($row_AnaButon['RandevuButonuMu']==0){echo "Hayır";} else{ echo "Evet";} ?></td>
              <td><a href="?AltButonDetay&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-success">Detay</a></td>
              <td><a href="?AltButonGuncelle&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-info">Güncelle</a></td>
              <td><a href="?AltButonSil&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-danger" id="sprytriggerSil" onClick="return confirm('Silmek İstediğinizden Emin misiniz?');">Sil</a></td>
            </tr>
            <?php } while ($row_AnaButon = mysql_fetch_assoc($AnaButon)); ?>
        </table>
        <div class="tooltipContent" id="sprytooltipSil">Dikkat! Silme işlemi geri alınamaz.</div>
        <table border="0">
          <tr>
            <td><?php if ($pageNum_AnaButon > 0) { // Show if not first page ?>
              <a class="btn btn-warning" href="<?php printf("%s?pageNum_AnaButon=%d%s", $currentPage, 0, $queryString_AnaButon); ?>#ust">&#304;lk</a>
            <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_AnaButon > 0) { // Show if not first page ?>
              <a class="btn btn-info" href="<?php printf("%s?pageNum_AnaButon=%d%s", $currentPage, max(0, $pageNum_AnaButon - 1), $queryString_AnaButon); ?>#ust">&Ouml;nceki</a>
            <?php } // Show if not first page ?></td>
            <td><?php if ($pageNum_AnaButon < $totalPages_AnaButon) { // Show if not last page ?>
              <a class="btn btn-success" href="<?php printf("%s?pageNum_AnaButon=%d%s", $currentPage, min($totalPages_AnaButon, $pageNum_AnaButon + 1), $queryString_AnaButon); ?>#ust">Sonraki</a>
            <?php } // Show if not last page ?></td>
            <td><?php if ($pageNum_AnaButon < $totalPages_AnaButon) { // Show if not last page ?>
              <a class="btn btn-danger" href="<?php printf("%s?pageNum_AnaButon=%d%s", $currentPage, $totalPages_AnaButon, $queryString_AnaButon); ?>#ust">Son</a>
            <?php } // Show if not last page ?></td>
          </tr>
        </table>
  </div></div></div>

<script type="text/javascript">
var sprytooltipSil = new Spry.Widget.Tooltip("sprytooltipSil", "#sprytriggerSil");
    </script>
</body>
</html>
<?php
mysql_free_result($BiletMakinesi);

mysql_free_result($Grup);

mysql_free_result($AnaButon);
?>
 <?php } // Show if recordset not empty ?>
 <?php if ($totalRows_AnaButon == 0) { // Show if recordset empty ?>
  <div class="btn btn-danger form-control">Henüz Bir Alt Buton Eklenmemiştir.</div>
  <?php } // Show if recordset empty ?>