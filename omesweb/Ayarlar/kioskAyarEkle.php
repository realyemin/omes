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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO kiosk_ayar (KID, BASLIK, ALT_BASLIK, MESAJ_OGLE, MESAJ_SISTEM_KAPALI, MESAJ_SERVIS_KAPALI, SOL_BTN_ADET, SAG_BTN_ADET, SOL_PADDING, SAG_PADDING, FONT, PUNTO, BTN_FONT, BTN_PUNTO, GECIKME, YAZI_RENGI, RENK, RESIM, RESIM_AD, ESKI_RESIM_AD, RESIM_YON, BASLIK_KAY, ALT_BASLIK_KAY, YON_BASLIK, YON_ALT_BASLIK, HIZ_BASLIK, HIZ_ALT_BASLIK, AKTIF, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, TagPreviewHeight, TagPreviewWidth, TagPreviewTimerInterval, TagPreviewZoom, TotalTag, MaxTotalTag, TagOverFlowPerId, TagOverFlowMessage, RandevuButonMetni, AltButonSuresi, WebdenRandevu, BeklemeSuresiMetni, EtiketSifirlamasifresi, BarkodlaEtiket) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['KID'], "int"),
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
                       GetSQLValueString($_POST['RESIM'], "text"),
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
                       GetSQLValueString($_POST['BarkodlaEtiket'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "../Ayarlar/KioskEkrani.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-responsive" align="center">
    <tr valign="baseline">
      <td nowrap>KID:</td>
      <td><input type="text" name="KID" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap valign="top">BASLIK:</td>
      <td><textarea name="BASLIK" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap valign="top">ALT_BASLIK:</td>
      <td><textarea name="ALT_BASLIK" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap valign="top">MESAJ_OGLE:</td>
      <td><textarea name="MESAJ_OGLE" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap valign="top">MESAJ_SISTEM_KAPALI:</td>
      <td><textarea name="MESAJ_SISTEM_KAPALI" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>MESAJ_SERVIS_KAPALI:</td>
      <td><input type="text" name="MESAJ_SERVIS_KAPALI" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>SOL_BTN_ADET:</td>
      <td><input type="text" name="SOL_BTN_ADET" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>SAG_BTN_ADET:</td>
      <td><input type="text" name="SAG_BTN_ADET" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>SOL_PADDING:</td>
      <td><input type="text" name="SOL_PADDING" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>SAG_PADDING:</td>
      <td><input type="text" name="SAG_PADDING" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>FONT:</td>
      <td><input type="text" name="FONT" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>PUNTO:</td>
      <td><input type="text" name="PUNTO" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>BTN_FONT:</td>
      <td><input type="text" name="BTN_FONT" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>BTN_PUNTO:</td>
      <td><input type="text" name="BTN_PUNTO" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>GECIKME:</td>
      <td><input type="text" name="GECIKME" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>YAZI_RENGI:</td>
      <td>
      <input class="jscolor" type="text" name="YAZI_RENGI" value="" size="32">
      
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap>RENK:</td>
      <td><input type="text" name="RENK" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>RESIM:</td>
      <td><input type="text" name="RESIM" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>RESIM_AD:</td>
      <td><input type="text" name="RESIM_AD" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>ESKI_RESIM_AD:</td>
      <td><input type="text" name="ESKI_RESIM_AD" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>RESIM_YON:</td>
      <td><input type="text" name="RESIM_YON" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>BASLIK_KAY:</td>
      <td><input type="text" name="BASLIK_KAY" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>ALT_BASLIK_KAY:</td>
      <td><input type="text" name="ALT_BASLIK_KAY" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>YON_BASLIK:</td>
      <td><input type="text" name="YON_BASLIK" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>YON_ALT_BASLIK:</td>
      <td><input type="text" name="YON_ALT_BASLIK" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>HIZ_BASLIK:</td>
      <td><input type="text" name="HIZ_BASLIK" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>HIZ_ALT_BASLIK:</td>
      <td><input type="text" name="HIZ_ALT_BASLIK" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>AKTIF:</td>
      <td><input type="text" name="AKTIF" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>S_YF1:</td>
      <td><input type="text" name="S_YF1" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>S_YF2:</td>
      <td><input type="text" name="S_YF2" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>S_YF3:</td>
      <td><input type="text" name="S_YF3" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>I_YF1:</td>
      <td><input type="text" name="I_YF1" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>I_YF2:</td>
      <td><input type="text" name="I_YF2" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>I_YF3:</td>
      <td><input type="text" name="I_YF3" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>B_YF:</td>
      <td><input type="text" name="B_YF" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TagPreviewHeight:</td>
      <td><input type="text" name="TagPreviewHeight" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TagPreviewWidth:</td>
      <td><input type="text" name="TagPreviewWidth" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TagPreviewTimerInterval:</td>
      <td><input type="text" name="TagPreviewTimerInterval" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TagPreviewZoom:</td>
      <td><input type="text" name="TagPreviewZoom" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TotalTag:</td>
      <td><input type="text" name="TotalTag" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>MaxTotalTag:</td>
      <td><input type="text" name="MaxTotalTag" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TagOverFlowPerId:</td>
      <td><input type="text" name="TagOverFlowPerId" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TagOverFlowMessage:</td>
      <td><input type="text" name="TagOverFlowMessage" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>RandevuButonMetni:</td>
      <td><input type="text" name="RandevuButonMetni" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>AltButonSuresi:</td>
      <td><input type="text" name="AltButonSuresi" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>WebdenRandevu:</td>
      <td><input type="text" name="WebdenRandevu" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>BeklemeSuresiMetni:</td>
      <td><input type="text" name="BeklemeSuresiMetni" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>EtiketSifirlamasifresi:</td>
      <td><input type="text" name="EtiketSifirlamasifresi" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>BarkodlaEtiket:</td>
      <td><input type="text" name="BarkodlaEtiket" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>&nbsp;</td>
      <td><input type="submit" value="Kayıt Ekle"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
