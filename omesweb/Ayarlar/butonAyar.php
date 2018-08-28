<?php require_once('../Connections/baglantim.php'); ?>
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

$maxRows_butonAyar = 10;
$pageNum_butonAyar = 0;
if (isset($_GET['pageNum_butonAyar'])) {
  $pageNum_butonAyar = $_GET['pageNum_butonAyar'];
}
$startRow_butonAyar = $pageNum_butonAyar * $maxRows_butonAyar;

mysql_select_db($database_baglantim, $baglantim);
$query_butonAyar = "SELECT * FROM butonlar";
$query_limit_butonAyar = sprintf("%s LIMIT %d, %d", $query_butonAyar, $startRow_butonAyar, $maxRows_butonAyar);
$butonAyar = mysql_query($query_limit_butonAyar, $baglantim) or die(mysql_error());
$row_butonAyar = mysql_fetch_assoc($butonAyar);

if (isset($_GET['totalRows_butonAyar'])) {
  $totalRows_butonAyar = $_GET['totalRows_butonAyar'];
} else {
  $all_butonAyar = mysql_query($query_butonAyar);
  $totalRows_butonAyar = mysql_num_rows($all_butonAyar);
}
$totalPages_butonAyar = ceil($totalRows_butonAyar/$maxRows_butonAyar)-1;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>
<table>
  <tr>
    <td>BM_ADRES</td>
    <td>BTNID</td>
    <td>GRP_ID</td>
    <td>ANA_BTNID</td>
    <td>BTN_EKRAN</td>
    <td>BTN_BILET_S1</td>
    <td>BTN_BILET_S2</td>
    <td>BTN_BILET_S3</td>
    <td>BTN_BILET_S4</td>
    <td>MAKS_BILET</td>
    <td>BILET_KOPYA</td>
    <td>YUKSEKLIK</td>
    <td>GENISLIK</td>
    <td>RENK</td>
    <td>YAZI_RENGI</td>
    <td>RESIM</td>
    <td>RESIM_YON</td>
    <td>RESIM_AD</td>
    <td>ESKI_RESIM_AD</td>
    <td>ACIKLAMA</td>
    <td>AKTIF</td>
    <td>S_YF1</td>
    <td>S_YF2</td>
    <td>S_YF3</td>
    <td>I_YF1</td>
    <td>I_YF2</td>
    <td>I_YF3</td>
    <td>B_YF</td>
    <td>RandevuButonuMu</td>
    <td>GRP_ID2</td>
    <td>GRP1_ORAN</td>
    <td>GRP2_ORAN</td>
    <td>GRP_ID3</td>
    <td>GRP3_ORAN</td>
    <td>GRP_ID4</td>
    <td>GRP4_ORAN</td>
    <td>FONT</td>
    <td>PUNTO</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_butonAyar['BM_ADRES']; ?></td>
      <td><?php echo $row_butonAyar['BTNID']; ?></td>
      <td><?php echo $row_butonAyar['GRP_ID']; ?></td>
      <td><?php echo $row_butonAyar['ANA_BTNID']; ?></td>
      <td><?php echo $row_butonAyar['BTN_EKRAN']; ?></td>
      <td><?php echo $row_butonAyar['BTN_BILET_S1']; ?></td>
      <td><?php echo $row_butonAyar['BTN_BILET_S2']; ?></td>
      <td><?php echo $row_butonAyar['BTN_BILET_S3']; ?></td>
      <td><?php echo $row_butonAyar['BTN_BILET_S4']; ?></td>
      <td><?php echo $row_butonAyar['MAKS_BILET']; ?></td>
      <td><?php echo $row_butonAyar['BILET_KOPYA']; ?></td>
      <td><?php echo $row_butonAyar['YUKSEKLIK']; ?></td>
      <td><?php echo $row_butonAyar['GENISLIK']; ?></td>
      <td><?php echo $row_butonAyar['RENK']; ?></td>
      <td><?php echo $row_butonAyar['YAZI_RENGI']; ?></td>
      <td>	  
	  <?php 
	  $img=base64_encode($row_butonAyar['RESIM']);	  	    ?>
	 <img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/>
	  <?php echo $row_butonAyar['RESIM']; ?></td>
      <td><?php echo $row_butonAyar['RESIM_YON']; ?></td>
      <td><?php echo $row_butonAyar['RESIM_AD']; ?></td>
      <td><?php echo $row_butonAyar['ESKI_RESIM_AD']; ?></td>
      <td><?php echo $row_butonAyar['ACIKLAMA']; ?></td>
      <td><?php echo $row_butonAyar['AKTIF']; ?></td>
      <td><?php echo $row_butonAyar['S_YF1']; ?></td>
      <td><?php echo $row_butonAyar['S_YF2']; ?></td>
      <td><?php echo $row_butonAyar['S_YF3']; ?></td>
      <td><?php echo $row_butonAyar['I_YF1']; ?></td>
      <td><?php echo $row_butonAyar['I_YF2']; ?></td>
      <td><?php echo $row_butonAyar['I_YF3']; ?></td>
      <td><?php echo $row_butonAyar['B_YF']; ?></td>
      <td><?php echo $row_butonAyar['RandevuButonuMu']; ?></td>
      <td><?php echo $row_butonAyar['GRP_ID2']; ?></td>
      <td><?php echo $row_butonAyar['GRP1_ORAN']; ?></td>
      <td><?php echo $row_butonAyar['GRP2_ORAN']; ?></td>
      <td><?php echo $row_butonAyar['GRP_ID3']; ?></td>
      <td><?php echo $row_butonAyar['GRP3_ORAN']; ?></td>
      <td><?php echo $row_butonAyar['GRP_ID4']; ?></td>
      <td><?php echo $row_butonAyar['GRP4_ORAN']; ?></td>
      <td><?php echo $row_butonAyar['FONT']; ?></td>
      <td><?php echo $row_butonAyar['PUNTO']; ?></td>
    </tr>
    <?php } while ($row_butonAyar = mysql_fetch_assoc($butonAyar)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($butonAyar);
?>
