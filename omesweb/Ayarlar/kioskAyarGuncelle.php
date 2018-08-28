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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE kiosk_ayar SET BASLIK=%s, ALT_BASLIK=%s, MESAJ_OGLE=%s, MESAJ_SISTEM_KAPALI=%s, MESAJ_SERVIS_KAPALI=%s, SOL_BTN_ADET=%s, SAG_BTN_ADET=%s, SOL_PADDING=%s, SAG_PADDING=%s, FONT=%s, PUNTO=%s, BTN_FONT=%s, BTN_PUNTO=%s, GECIKME=%s, YAZI_RENGI=%s, RENK=%s, RESIM=%s, RESIM_AD=%s, ESKI_RESIM_AD=%s, RESIM_YON=%s, BASLIK_KAY=%s, ALT_BASLIK_KAY=%s, YON_BASLIK=%s, YON_ALT_BASLIK=%s, HIZ_BASLIK=%s, HIZ_ALT_BASLIK=%s, AKTIF=%s, S_YF1=%s, S_YF2=%s, S_YF3=%s, I_YF1=%s, I_YF2=%s, I_YF3=%s, B_YF=%s, TagPreviewHeight=%s, TagPreviewWidth=%s, TagPreviewTimerInterval=%s, TagPreviewZoom=%s, TotalTag=%s, MaxTotalTag=%s, TagOverFlowPerId=%s, TagOverFlowMessage=%s, RandevuButonMetni=%s, AltButonSuresi=%s, WebdenRandevu=%s, BeklemeSuresiMetni=%s, EtiketSifirlamasifresi=%s, BarkodlaEtiket=%s WHERE KID=%s",
                       GetSQLValueString($_POST['BASLIK'], "text"),
                       GetSQLValueString($_POST['ALT_BASLIK'], "text"),
                       GetSQLValueString($_POST['MESAJ_OGLE'], "text"),
                       GetSQLValueString($_POST['MESAJ_SISTEM_KAPALI'], "text"),
                       GetSQLValueString($_POST['MESAJ_SERVIS_KAPALI'], "text"),
                       GetSQLValueString($_POST['SOL_BTN_ADET'], "int"),
                       GetSQLValueString($_POST['SAG_BTN_ADET'], "int"),
                       GetSQLValueString($_POST['SOL_PADDING'], "int"),
                       GetSQLValueString($_POST['SAG_PADDING'], "int"),
                       GetSQLValueString($_POST['FONT'], "text"),
                       GetSQLValueString($_POST['PUNTO'], "int"),
                       GetSQLValueString($_POST['BTN_FONT'], "text"),
                       GetSQLValueString($_POST['BTN_PUNTO'], "int"),
                       GetSQLValueString($_POST['GECIKME'], "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),
                       GetSQLValueString($_POST['RENK'], "int"),
                       GetSQLValueString(file_get_contents($_FILES['RESIM']["tmp_name"]), "text"),
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString($_POST['BASLIK_KAY'], "int"),
                       GetSQLValueString($_POST['ALT_BASLIK_KAY'], "int"),
                       GetSQLValueString($_POST['YON_BASLIK'], "int"),
                       GetSQLValueString($_POST['YON_ALT_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_ALT_BASLIK'], "int"),
                       GetSQLValueString($_POST['AKTIF'], "int"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString($_POST['TagPreviewHeight'], "int"),
                       GetSQLValueString($_POST['TagPreviewWidth'], "int"),
                       GetSQLValueString($_POST['TagPreviewTimerInterval'], "int"),
                       GetSQLValueString($_POST['TagPreviewZoom'], "double"),
                       GetSQLValueString($_POST['TotalTag'], "int"),
                       GetSQLValueString($_POST['MaxTotalTag'], "int"),
                       GetSQLValueString($_POST['TagOverFlowPerId'], "int"),
                       GetSQLValueString($_POST['TagOverFlowMessage'], "text"),
                       GetSQLValueString($_POST['RandevuButonMetni'], "text"),
                       GetSQLValueString($_POST['AltButonSuresi'], "int"),
                       GetSQLValueString($_POST['WebdenRandevu'], "int"),
                       GetSQLValueString($_POST['BeklemeSuresiMetni'], "text"),
                       GetSQLValueString($_POST['EtiketSifirlamasifresi'], "int"),
                       GetSQLValueString($_POST['BarkodlaEtiket'], "int"),
                       GetSQLValueString($_POST['KID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "../Ayarlar/KioskEkrani.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_kioskGuncelle = "-1";
if (isset($_GET['KID'])) {
  $colname_kioskGuncelle = $_GET['KID'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_kioskGuncelle = sprintf("SELECT * FROM kiosk_ayar WHERE KID = %s", GetSQLValueString($colname_kioskGuncelle, "int"));
$kioskGuncelle = mysql_query($query_kioskGuncelle, $baglantim) or die(mysql_error());
$row_kioskGuncelle = mysql_fetch_assoc($kioskGuncelle);
$totalRows_kioskGuncelle = mysql_num_rows($kioskGuncelle);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>
<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td>KID:</td>
      <td><?php echo $row_kioskGuncelle['KID']; ?></td>
    </tr>
    <tr valign="baseline">
      <td>BASLIK:</td>
      <td><input type="text" name="BASLIK" value="<?php echo htmlentities($row_kioskGuncelle['BASLIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>ALT_BASLIK:</td>
      <td><input type="text" name="ALT_BASLIK" value="<?php echo htmlentities($row_kioskGuncelle['ALT_BASLIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>MESAJ_OGLE:</td>
      <td><input type="text" name="MESAJ_OGLE" value="<?php echo htmlentities($row_kioskGuncelle['MESAJ_OGLE'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>MESAJ_SISTEM_KAPALI:</td>
      <td><input type="text" name="MESAJ_SISTEM_KAPALI" value="<?php echo htmlentities($row_kioskGuncelle['MESAJ_SISTEM_KAPALI'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>MESAJ_SERVIS_KAPALI:</td>
      <td><input type="text" name="MESAJ_SERVIS_KAPALI" value="<?php echo htmlentities($row_kioskGuncelle['MESAJ_SERVIS_KAPALI'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>SOL_BTN_ADET:</td>
      <td><input type="text" name="SOL_BTN_ADET" value="<?php echo htmlentities($row_kioskGuncelle['SOL_BTN_ADET'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>SAG_BTN_ADET:</td>
      <td><input type="text" name="SAG_BTN_ADET" value="<?php echo htmlentities($row_kioskGuncelle['SAG_BTN_ADET'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>SOL_PADDING:</td>
      <td><input type="text" name="SOL_PADDING" value="<?php echo htmlentities($row_kioskGuncelle['SOL_PADDING'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>SAG_PADDING:</td>
      <td><input type="text" name="SAG_PADDING" value="<?php echo htmlentities($row_kioskGuncelle['SAG_PADDING'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>FONT:</td>
      <td><input type="text" name="FONT" value="<?php echo htmlentities($row_kioskGuncelle['FONT'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>PUNTO:</td>
      <td><input type="text" name="PUNTO" value="<?php echo htmlentities($row_kioskGuncelle['PUNTO'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>BTN_FONT:</td>
      <td><input type="text" name="BTN_FONT" value="<?php echo htmlentities($row_kioskGuncelle['BTN_FONT'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>BTN_PUNTO:</td>
      <td><input type="text" name="BTN_PUNTO" value="<?php echo htmlentities($row_kioskGuncelle['BTN_PUNTO'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>GECIKME:</td>
      <td><input type="text" name="GECIKME" value="<?php echo htmlentities($row_kioskGuncelle['GECIKME'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>YAZI_RENGI:</td>
      <td><input class="jscolor" type="text" name="YAZI_RENGI" value="<?php echo dechex($row_kioskGuncelle['YAZI_RENGI']); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>RENK:</td>
      <td><input type="text" name="RENK" value="<?php echo htmlentities($row_kioskGuncelle['RENK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>RESIM:</td>
      <td>
      <input type="file" name="RESIM" />
      
      	  <?php 
	  $img=base64_encode($row_kioskGuncelle['RESIM']);	  	    ?>
	 <img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/>
	  </td>
    </tr>
    <tr valign="baseline">
      <td>RESIM_AD:</td>
      <td><input type="text" disabled value="<?php echo htmlentities($row_kioskGuncelle['RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32">
      <input type="hidden" name="RESIM_AD" value="<?php echo time(); ?>" />
      </td>
    </tr>
    <tr valign="baseline">
      <td>ESKI_RESIM_AD:</td>
      <td><input type="text" name="ESKI_RESIM_AD" value="<?php echo htmlentities($row_kioskGuncelle['ESKI_RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>RESIM_YON:</td>
      <td><input type="text" name="RESIM_YON" value="<?php echo htmlentities($row_kioskGuncelle['RESIM_YON'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>BASLIK_KAY:</td>
      <td><input type="text" name="BASLIK_KAY" value="<?php echo htmlentities($row_kioskGuncelle['BASLIK_KAY'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>ALT_BASLIK_KAY:</td>
      <td><input type="text" name="ALT_BASLIK_KAY" value="<?php echo htmlentities($row_kioskGuncelle['ALT_BASLIK_KAY'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>YON_BASLIK:</td>
      <td><input type="text" name="YON_BASLIK" value="<?php echo htmlentities($row_kioskGuncelle['YON_BASLIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>YON_ALT_BASLIK:</td>
      <td><input type="text" name="YON_ALT_BASLIK" value="<?php echo htmlentities($row_kioskGuncelle['YON_ALT_BASLIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>HIZ_BASLIK:</td>
      <td><input type="text" name="HIZ_BASLIK" value="<?php echo htmlentities($row_kioskGuncelle['HIZ_BASLIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>HIZ_ALT_BASLIK:</td>
      <td><input type="text" name="HIZ_ALT_BASLIK" value="<?php echo htmlentities($row_kioskGuncelle['HIZ_ALT_BASLIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>AKTIF:</td>
      <td><input type="text" name="AKTIF" value="<?php echo htmlentities($row_kioskGuncelle['AKTIF'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>S_YF1:</td>
      <td><input type="text" name="S_YF1" value="<?php echo htmlentities($row_kioskGuncelle['S_YF1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>S_YF2:</td>
      <td><input type="text" name="S_YF2" value="<?php echo htmlentities($row_kioskGuncelle['S_YF2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>S_YF3:</td>
      <td><input type="text" name="S_YF3" value="<?php echo htmlentities($row_kioskGuncelle['S_YF3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>I_YF1:</td>
      <td><input type="text" name="I_YF1" value="<?php echo htmlentities($row_kioskGuncelle['I_YF1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>I_YF2:</td>
      <td><input type="text" name="I_YF2" value="<?php echo htmlentities($row_kioskGuncelle['I_YF2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>I_YF3:</td>
      <td><input type="text" name="I_YF3" value="<?php echo htmlentities($row_kioskGuncelle['I_YF3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>B_YF:</td>
      <td><input type="text" name="B_YF" value="<?php echo htmlentities($row_kioskGuncelle['B_YF'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TagPreviewHeight:</td>
      <td><input type="text" name="TagPreviewHeight" value="<?php echo htmlentities($row_kioskGuncelle['TagPreviewHeight'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TagPreviewWidth:</td>
      <td><input type="text" name="TagPreviewWidth" value="<?php echo htmlentities($row_kioskGuncelle['TagPreviewWidth'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TagPreviewTimerInterval:</td>
      <td><input type="text" name="TagPreviewTimerInterval" value="<?php echo htmlentities($row_kioskGuncelle['TagPreviewTimerInterval'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TagPreviewZoom:</td>
      <td><input type="text" name="TagPreviewZoom" value="<?php echo htmlentities($row_kioskGuncelle['TagPreviewZoom'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TotalTag:</td>
      <td><input type="text" name="TotalTag" value="<?php echo htmlentities($row_kioskGuncelle['TotalTag'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>MaxTotalTag:</td>
      <td><input type="text" name="MaxTotalTag" value="<?php echo htmlentities($row_kioskGuncelle['MaxTotalTag'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TagOverFlowPerId:</td>
      <td><input type="text" name="TagOverFlowPerId" value="<?php echo htmlentities($row_kioskGuncelle['TagOverFlowPerId'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>TagOverFlowMessage:</td>
      <td><input type="text" name="TagOverFlowMessage" value="<?php echo htmlentities($row_kioskGuncelle['TagOverFlowMessage'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>RandevuButonMetni:</td>
      <td><input type="text" name="RandevuButonMetni" value="<?php echo htmlentities($row_kioskGuncelle['RandevuButonMetni'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>AltButonSuresi:</td>
      <td><input type="text" name="AltButonSuresi" value="<?php echo htmlentities($row_kioskGuncelle['AltButonSuresi'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>WebdenRandevu:</td>
      <td><input type="text" name="WebdenRandevu" value="<?php echo htmlentities($row_kioskGuncelle['WebdenRandevu'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>BeklemeSuresiMetni:</td>
      <td><input type="text" name="BeklemeSuresiMetni" value="<?php echo htmlentities($row_kioskGuncelle['BeklemeSuresiMetni'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>EtiketSifirlamasifresi:</td>
      <td><input type="text" name="EtiketSifirlamasifresi" value="<?php echo htmlentities($row_kioskGuncelle['EtiketSifirlamasifresi'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>BarkodlaEtiket:</td>
      <td><input type="text" name="BarkodlaEtiket" value="<?php echo htmlentities($row_kioskGuncelle['BarkodlaEtiket'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
      <td><input type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="KID" value="<?php echo $row_kioskGuncelle['KID']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($kioskGuncelle);
?>
