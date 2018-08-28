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

$maxRows_kioskAyar = 10;
$pageNum_kioskAyar = 0;
if (isset($_GET['pageNum_kioskAyar'])) {
  $pageNum_kioskAyar = $_GET['pageNum_kioskAyar'];
}
$startRow_kioskAyar = $pageNum_kioskAyar * $maxRows_kioskAyar;

mysql_select_db($database_baglantim, $baglantim);
$query_kioskAyar = "SELECT * FROM kiosk_ayar";
$query_limit_kioskAyar = sprintf("%s LIMIT %d, %d", $query_kioskAyar, $startRow_kioskAyar, $maxRows_kioskAyar);
$kioskAyar = mysql_query($query_limit_kioskAyar, $baglantim) or die(mysql_error());
$row_kioskAyar = mysql_fetch_assoc($kioskAyar);

if (isset($_GET['totalRows_kioskAyar'])) {
  $totalRows_kioskAyar = $_GET['totalRows_kioskAyar'];
} else {
  $all_kioskAyar = mysql_query($query_kioskAyar);
  $totalRows_kioskAyar = mysql_num_rows($all_kioskAyar);
}
$totalPages_kioskAyar = ceil($totalRows_kioskAyar/$maxRows_kioskAyar)-1;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>
<table class="table table-responsive">
  <tr>
    <td>KID</td>
    <td>BASLIK</td>
    <td>ALT_BASLIK</td>
    <td>MESAJ_OGLE</td>
    <td>MESAJ_SISTEM_KAPALI</td>
    <td>MESAJ_SERVIS_KAPALI</td>
    <td>SOL_BTN_ADET</td>
    <td>SAG_BTN_ADET</td>
    <td>SOL_PADDING</td>
    <td>SAG_PADDING</td>
    <td>FONT</td>
    <td>PUNTO</td>
    <td>BTN_FONT</td>
    <td>BTN_PUNTO</td>
    <td>GECIKME</td>
    <td>YAZI_RENGI</td>
    <td>RENK</td>
    <td>RESIM</td>
    <td>RESIM_AD</td>
    <td>ESKI_RESIM_AD</td>
    <td>RESIM_YON</td>
    <td>BASLIK_KAY</td>
    <td>ALT_BASLIK_KAY</td>
    <td>YON_BASLIK</td>
    <td>YON_ALT_BASLIK</td>
    <td>HIZ_BASLIK</td>
    <td>HIZ_ALT_BASLIK</td>
    <td>AKTIF</td>
    <td>S_YF1</td>
    <td>S_YF2</td>
    <td>S_YF3</td>
    <td>I_YF1</td>
    <td>I_YF2</td>
    <td>I_YF3</td>
    <td>B_YF</td>
    <td>TagPreviewHeight</td>
    <td>TagPreviewWidth</td>
    <td>TagPreviewTimerInterval</td>
    <td>TagPreviewZoom</td>
    <td>TotalTag</td>
    <td>MaxTotalTag</td>
    <td>TagOverFlowPerId</td>
    <td>TagOverFlowMessage</td>
    <td>RandevuButonMetni</td>
    <td>AltButonSuresi</td>
    <td>WebdenRandevu</td>
    <td>BeklemeSuresiMetni</td>
    <td>EtiketSifirlamasifresi</td>
    <td>BarkodlaEtiket</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a class="form-control btn-success" href="../Ayarlar2/KioskEkraniGuncelle.php?KID=<?php echo $row_kioskAyar['KID']; ?>">Güncelle-#<?php echo $row_kioskAyar['KID']; ?></a></td>
      <td><?php echo $row_kioskAyar['BASLIK']; ?></td>
      <td><?php echo $row_kioskAyar['ALT_BASLIK']; ?></td>
      <td><?php echo $row_kioskAyar['MESAJ_OGLE']; ?></td>
      <td><?php echo $row_kioskAyar['MESAJ_SISTEM_KAPALI']; ?></td>
      <td><?php echo $row_kioskAyar['MESAJ_SERVIS_KAPALI']; ?></td>
      <td><?php echo $row_kioskAyar['SOL_BTN_ADET']; ?></td>
      <td><?php echo $row_kioskAyar['SAG_BTN_ADET']; ?></td>
      <td><?php echo $row_kioskAyar['SOL_PADDING']; ?></td>
      <td><?php echo $row_kioskAyar['SAG_PADDING']; ?></td>
      <td><?php echo $row_kioskAyar['FONT']; ?></td>
      <td><?php echo $row_kioskAyar['PUNTO']; ?></td>
      <td><?php echo $row_kioskAyar['BTN_FONT']; ?></td>
      <td><?php echo $row_kioskAyar['BTN_PUNTO']; ?></td>
      <td><?php echo $row_kioskAyar['GECIKME']; ?></td>
      <td><?php echo $row_kioskAyar['YAZI_RENGI']; ?></td>
      <td><?php echo $row_kioskAyar['RENK']; ?></td>
      <td><?php 
	  $img=base64_encode($row_kioskAyar['RESIM']);	  	    ?>
	 <img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/>
	  </td>
      <td><?php echo $row_kioskAyar['RESIM_AD']; ?></td>
      <td><?php echo $row_kioskAyar['ESKI_RESIM_AD']; ?></td>
      <td><?php echo $row_kioskAyar['RESIM_YON']; ?></td>
      <td><?php echo $row_kioskAyar['BASLIK_KAY']; ?></td>
      <td><?php echo $row_kioskAyar['ALT_BASLIK_KAY']; ?></td>
      <td><?php echo $row_kioskAyar['YON_BASLIK']; ?></td>
      <td><?php echo $row_kioskAyar['YON_ALT_BASLIK']; ?></td>
      <td><?php echo $row_kioskAyar['HIZ_BASLIK']; ?></td>
      <td><?php echo $row_kioskAyar['HIZ_ALT_BASLIK']; ?></td>
      <td><?php echo $row_kioskAyar['AKTIF']; ?></td>
      <td><?php echo $row_kioskAyar['S_YF1']; ?></td>
      <td><?php echo $row_kioskAyar['S_YF2']; ?></td>
      <td><?php echo $row_kioskAyar['S_YF3']; ?></td>
      <td><?php echo $row_kioskAyar['I_YF1']; ?></td>
      <td><?php echo $row_kioskAyar['I_YF2']; ?></td>
      <td><?php echo $row_kioskAyar['I_YF3']; ?></td>
      <td><?php echo $row_kioskAyar['B_YF']; ?></td>
      <td><?php echo $row_kioskAyar['TagPreviewHeight']; ?></td>
      <td><?php echo $row_kioskAyar['TagPreviewWidth']; ?></td>
      <td><?php echo $row_kioskAyar['TagPreviewTimerInterval']; ?></td>
      <td><?php echo $row_kioskAyar['TagPreviewZoom']; ?></td>
      <td><?php echo $row_kioskAyar['TotalTag']; ?></td>
      <td><?php echo $row_kioskAyar['MaxTotalTag']; ?></td>
      <td><?php echo $row_kioskAyar['TagOverFlowPerId']; ?></td>
      <td><?php echo $row_kioskAyar['TagOverFlowMessage']; ?></td>
      <td><?php echo $row_kioskAyar['RandevuButonMetni']; ?></td>
      <td><?php echo $row_kioskAyar['AltButonSuresi']; ?></td>
      <td><?php echo $row_kioskAyar['WebdenRandevu']; ?></td>
      <td><?php echo $row_kioskAyar['BeklemeSuresiMetni']; ?></td>
      <td><?php echo $row_kioskAyar['EtiketSifirlamasifresi']; ?></td>
      <td><?php echo $row_kioskAyar['BarkodlaEtiket']; ?></td>
    </tr>
    <?php } while ($row_kioskAyar = mysql_fetch_assoc($kioskAyar)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($kioskAyar);
?>
