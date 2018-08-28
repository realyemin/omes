<?php //require_once('../Connections/baglantim.php'); ?>
<?php
/*
	Bu sayfada Ekleme ve Güncelleme işlemi birlikte yapıldı
	11.08.2017
*/
//bu fonksiyon c# içinde form backcolor özelliğinin 
//işaretli sayı değeri ile çalışmasından kaynaklı 
//ARGB renk dönüşümünü sağlamak için sadece kiosk_ayar tablosundaki RENK alanına girilen değerler için kullanılmıştır.
function signedint32($value) {
    $i = (int)$value;
    if (PHP_INT_SIZE > 4)   // e.g. php 64bit
        if($i & 0x80000000) // is negative
            return $i - 0x100000000;
    return $i;
} 
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

$Resim=-1;	
	if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){	
	$Resim=$_FILES["RESIM"]["tmp_name"];		
	}
	else
	{
		//eğer yeni resim yüklenmediyse bunu çalıştır	
		//direk logoyu arkaplan ekle
	$Resim="img/omes_logo.png";	
	}
  $insertSQL = sprintf("INSERT INTO kiosk_ayar (KID, BASLIK, ALT_BASLIK, MESAJ_OGLE, MESAJ_SISTEM_KAPALI, MESAJ_SERVIS_KAPALI, SOL_BTN_ADET, SAG_BTN_ADET, SOL_PADDING, SAG_PADDING, FONT, PUNTO, GECIKME, YAZI_RENGI, RENK, RESIM, RESIM_AD, ESKI_RESIM_AD, RESIM_YON, BASLIK_KAY, ALT_BASLIK_KAY, YON_BASLIK, YON_ALT_BASLIK, HIZ_BASLIK, HIZ_ALT_BASLIK, AKTIF, TagPreviewHeight, TagPreviewWidth, TagPreviewTimerInterval, TagPreviewZoom, TotalTag, MaxTotalTag, TagOverFlowPerId, TagOverFlowMessage, AltButonSuresi, WebdenRandevu, BeklemeSuresiMetni, EtiketSifirlamasifresi, BarkodlaEtiket) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['GECIKME'], "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),
                       GetSQLValueString(signedint32(hexdec('FF'.$_POST['RENK'])), "int"), 
                       GetSQLValueString(file_get_contents($Resim), "text"),
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString(isset($_POST['BASLIK_KAY']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['ALT_BASLIK_KAY']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['YON_BASLIK'], "int"),
                       GetSQLValueString($_POST['YON_ALT_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_ALT_BASLIK'], "int"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),                 
                       GetSQLValueString($_POST['TagPreviewHeight'], "int"),
                       GetSQLValueString($_POST['TagPreviewWidth'], "int"),
                       GetSQLValueString($_POST['TagPreviewTimerInterval'], "int"),
                       GetSQLValueString($_POST['TagPreviewZoom'], "double"),
                       GetSQLValueString($_POST['TotalTag'], "int"),
                       GetSQLValueString($_POST['MaxTotalTag'], "int"),
                       GetSQLValueString($_POST['TagOverFlowPerId'], "int"),
                       GetSQLValueString($_POST['TagOverFlowMessage'], "text"),
                       GetSQLValueString($_POST['AltButonSuresi'], "int"),
                       GetSQLValueString(isset($_POST['WebdenRandevu']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['BeklemeSuresiMetni'], "text"),
                       GetSQLValueString($_POST['EtiketSifirlamasifresi'], "int"),
                       GetSQLValueString(isset($_POST['BarkodlaEtiket']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?KioskEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	$updateSQL=-1;
	if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){
		//eğer yeni resim yüklendiyse bunu çalıştır
  $updateSQL = sprintf("UPDATE kiosk_ayar SET BASLIK=%s, ALT_BASLIK=%s, MESAJ_OGLE=%s, MESAJ_SISTEM_KAPALI=%s, MESAJ_SERVIS_KAPALI=%s, SOL_BTN_ADET=%s, SAG_BTN_ADET=%s, SOL_PADDING=%s, SAG_PADDING=%s, FONT=%s, PUNTO=%s, GECIKME=%s, YAZI_RENGI=%s, RENK=%s, RESIM=%s, RESIM_AD=%s, ESKI_RESIM_AD=%s, RESIM_YON=%s, BASLIK_KAY=%s, ALT_BASLIK_KAY=%s, YON_BASLIK=%s, YON_ALT_BASLIK=%s, HIZ_BASLIK=%s, HIZ_ALT_BASLIK=%s, AKTIF=%s, TagPreviewHeight=%s, TagPreviewWidth=%s, TagPreviewTimerInterval=%s, TagPreviewZoom=%s, TotalTag=%s, MaxTotalTag=%s, TagOverFlowPerId=%s, TagOverFlowMessage=%s, AltButonSuresi=%s, WebdenRandevu=%s, BeklemeSuresiMetni=%s, EtiketSifirlamasifresi=%s, BarkodlaEtiket=%s WHERE KID=%s",
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
                       GetSQLValueString($_POST['GECIKME'], "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),
                       GetSQLValueString(signedint32(hexdec('FF'.$_POST['RENK'])), "int"),
                       GetSQLValueString(file_get_contents($_FILES['RESIM']["tmp_name"]), "text"),
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString(isset($_POST['BASLIK_KAY']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['ALT_BASLIK_KAY']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['YON_BASLIK'], "int"),
                       GetSQLValueString($_POST['YON_ALT_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_ALT_BASLIK'], "int"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['TagPreviewHeight'], "int"),
                       GetSQLValueString($_POST['TagPreviewWidth'], "int"),
                       GetSQLValueString($_POST['TagPreviewTimerInterval'], "int"),
                       GetSQLValueString($_POST['TagPreviewZoom'], "double"),
                       GetSQLValueString($_POST['TotalTag'], "int"),
                       GetSQLValueString($_POST['MaxTotalTag'], "int"),
                       GetSQLValueString($_POST['TagOverFlowPerId'], "int"),
                       GetSQLValueString($_POST['TagOverFlowMessage'], "text"),                      
                       GetSQLValueString($_POST['AltButonSuresi'], "int"),
                       GetSQLValueString(isset($_POST['WebdenRandevu']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['BeklemeSuresiMetni'], "text"),
                       GetSQLValueString($_POST['EtiketSifirlamasifresi'], "int"),
                       GetSQLValueString(isset($_POST['BarkodlaEtiket']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['KID'], "int"));
	}
	else
	{		
$updateSQL = sprintf("UPDATE kiosk_ayar SET BASLIK=%s, ALT_BASLIK=%s, MESAJ_OGLE=%s, MESAJ_SISTEM_KAPALI=%s, MESAJ_SERVIS_KAPALI=%s, SOL_BTN_ADET=%s, SAG_BTN_ADET=%s, SOL_PADDING=%s, SAG_PADDING=%s, FONT=%s, PUNTO=%s, GECIKME=%s, YAZI_RENGI=%s, RENK=%s, RESIM_AD=%s, ESKI_RESIM_AD=%s, RESIM_YON=%s, BASLIK_KAY=%s, ALT_BASLIK_KAY=%s, YON_BASLIK=%s, YON_ALT_BASLIK=%s, HIZ_BASLIK=%s, HIZ_ALT_BASLIK=%s, AKTIF=%s, TagPreviewHeight=%s, TagPreviewWidth=%s, TagPreviewTimerInterval=%s, TagPreviewZoom=%s, TotalTag=%s, MaxTotalTag=%s, TagOverFlowPerId=%s, TagOverFlowMessage=%s, AltButonSuresi=%s, WebdenRandevu=%s, BeklemeSuresiMetni=%s, EtiketSifirlamasifresi=%s, BarkodlaEtiket=%s WHERE KID=%s",
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
                       GetSQLValueString($_POST['GECIKME'], "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),
                       GetSQLValueString(signedint32(hexdec('FF'.$_POST['RENK'])), "int"),                       
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString(isset($_POST['BASLIK_KAY']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['ALT_BASLIK_KAY']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['YON_BASLIK'], "int"),
                      GetSQLValueString($_POST['YON_ALT_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_BASLIK'], "int"),
                       GetSQLValueString($_POST['HIZ_ALT_BASLIK'], "int"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['TagPreviewHeight'], "int"),
                       GetSQLValueString($_POST['TagPreviewWidth'], "int"),
                       GetSQLValueString($_POST['TagPreviewTimerInterval'], "int"),
                       GetSQLValueString($_POST['TagPreviewZoom'], "double"),
                       GetSQLValueString($_POST['TotalTag'], "int"),
                       GetSQLValueString($_POST['MaxTotalTag'], "int"),
                       GetSQLValueString($_POST['TagOverFlowPerId'], "int"),
                       GetSQLValueString($_POST['TagOverFlowMessage'], "text"),                       
                       GetSQLValueString($_POST['AltButonSuresi'], "int"),
                       GetSQLValueString(isset($_POST['WebdenRandevu']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['BeklemeSuresiMetni'], "text"),
                       GetSQLValueString($_POST['EtiketSifirlamasifresi'], "int"),
                       GetSQLValueString(isset($_POST['BarkodlaEtiket']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['KID'], "int"));
	}
	
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?KioskEkle=gnc&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi = "SELECT MAKINE_ADRESI, MAKINE_ADI FROM bilet_makineleri";
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);

mysql_select_db($database_baglantim, $baglantim);
$query_Personel = "SELECT PID, AD, SOYAD FROM personeller WHERE PID > 1";
$Personel = mysql_query($query_Personel, $baglantim) or die(mysql_error());
$row_Personel = mysql_fetch_assoc($Personel);
$totalRows_Personel = mysql_num_rows($Personel);

mysql_select_db($database_baglantim, $baglantim);
$query_Fontlar = "SELECT * FROM fontlar";
$Fontlar = mysql_query($query_Fontlar, $baglantim) or die(mysql_error());
$row_Fontlar = mysql_fetch_assoc($Fontlar);
$totalRows_Fontlar = mysql_num_rows($Fontlar);

$colname_KioskAyar = "-1";
if (isset($_GET['Kiosk'])) {
  $colname_KioskAyar = $_GET['Kiosk'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_KioskAyar = sprintf("SELECT * FROM kiosk_ayar WHERE KID = %s", GetSQLValueString($colname_KioskAyar, "int"));
$KioskAyar = mysql_query($query_KioskAyar, $baglantim) or die(mysql_error());
$row_KioskAyar = mysql_fetch_assoc($KioskAyar);
$totalRows_KioskAyar = mysql_num_rows($KioskAyar);
?>

<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_jumpMenuGo(objId,targ,restore){ //v9.0
  var selObj = null;  with (document) { 
  if (getElementById) selObj = getElementById(objId);
  if (selObj) eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0; }
}
</script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">

<body>
<?php
	if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Kiosk Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Kiosk Ayarları Kaydedildi</strong></p>
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
<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="gnc" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    //$("#hata").click(function(){
        $("#gnc").fadeOut(6000);       
//    });
});
</script><!-- Jquery ile fadein fadeout için -->
<div id="gnc" class="alert alert-success"><strong>Güncelleme işlemi tamam.</strong></div>
<?php
}
?>
<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="SilEksik" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    //$("#hata").click(function(){
        $("#hata").fadeOut(6000);       
//    });
});
</script><!-- Jquery ile fadein fadeout için -->
<div id="hata" class="alert alert-danger">Lütfen Geçerli bir Kioks ID Seçiniz.</div>
<?php
}
?><?php if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="SilOk" and isset($_GET['?KioskSil']) and $_GET['?KioskSil']!="")
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(10000);
});<!-- Jquery ile fadein fadeout için -->
</script>
<div id="eklendi" class="btn btn-danger"><?php echo "#".$_GET['?KioskSil']; ?> Seçtiğiniz Kiosk Makinesi Ayarları Silindi. <strong> Not:Bu işlem Kioks Makinesini Silmez Sadece Ekran Ayarlarını Temizler.</strong></div>
<?php
}
?>
  <div class="panel panel-green">
  <div class="panel panel-heading">Kiosk Ayar Paneli</div>
<div class="alert alert-info">
<div class="table-responsive">
<form name="form" id="form">  
  <select class="form-control btn btn-success" role="menu" name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenuGo('jumpMenu','parent',0)">
    <option value="?KioskEkle">Kiosk için Bilet Makinesi Seçiniz</option>
    <?php
do {  
?>
    <option value="?KioskEkle&Kiosk=<?php echo $row_BiletMakinesi['MAKINE_ADRESI'];?>" <?php if (isset($_GET['Kiosk']) and !(strcmp($_GET['Kiosk'], htmlentities($row_BiletMakinesi['MAKINE_ADRESI'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_BiletMakinesi['MAKINE_ADRESI']."-".$row_BiletMakinesi['MAKINE_ADI']?></option>
    <?php
} while ($row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi));
  $rows = mysql_num_rows($BiletMakinesi);
  if($rows > 0) {
      mysql_data_seek($BiletMakinesi, 0);
	  $row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
  }
?>
  </select>
  </form>
 <a href="?KioskSil=<?php if(isset($_GET['Kiosk'])){echo $_GET['Kiosk'];} ?>" class="form-control btn btn-danger btn-md" id="sprytrigger1" onClick="return confirm('Seçili Bilet Makinesi İçin Kiosk Ayarları Silinsin mi?');" role="button">Seçili Bilet Makinesi için Kiosk Ayarlarını Sil</a> 
(Eğer Kaydedilmiş Bir Kiosk varsa güncelleme bilgileri yüklenecektir. Yoksa Yeni Bilgi İçin Boş Form Açılacaktır.)</div>
</div>
</div>
<div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Geri Alınamaz.</div>
<?php 
	if(isset($_GET['Kiosk']) and $_GET['Kiosk']!="")
	{//form göster gizle başlangıç
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" >
  <div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">1-Kiosk Bilgileri</div>
	<div class="table-responsive">
	<table class="table table-hover">
    <tr>
      <th>Seçili Kiosk ID:</th>
      <td colspan="3"><?php if(isset($_GET['Kiosk'])){ echo "<span class='alert alert-danger'><strong># ".$_GET['Kiosk']." (Kiosk Kimliği)</strong></span>"; }else { echo "<span class='btn btn-danger'><strong>Henüz Bir Kiosk Seçmediğiniz İçin İşlem Yapamazsınız.</strong></span>"; } ?></td>
    </tr>
    <tr>
      <th>Kiosk Başlık:</th>
      <td style=" min-width:200px"><span id="sprytextarea1">
      <textarea name="BASLIK" class="form-control" cols="30" rows="3" required><?php echo $row_KioskAyar['BASLIK']; ?></textarea>
      <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">Bir değer gerekiyor.</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
      <th>Alt Başlık:</th>
      <td><span id="sprytextarea2">
      <textarea name="ALT_BASLIK" class="form-control" cols="30" rows="3"><?php echo $row_KioskAyar['ALT_BASLIK']; ?></textarea>
      <span id="countsprytextarea2">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
    </tr>
    <tr >
      <th valign="top">Öğle Mesajı:</th>
      <td><span id="sprytextarea3">
      <textarea name="MESAJ_OGLE" class="form-control" cols="30" rows="3"><?php if($row_KioskAyar['MESAJ_OGLE']!=""){ echo $row_KioskAyar['MESAJ_OGLE'];}else { echo "Öğle Molası"; } ?></textarea>
      <span id="countsprytextarea3">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
      <th valign="top">Sistem Kapalı Mesajı:</th>
      <td><span id="sprytextarea4">
      <textarea name="MESAJ_SISTEM_KAPALI" class="form-control" cols="30" rows="3"><?php if($row_KioskAyar['MESAJ_SISTEM_KAPALI']!=""){echo $row_KioskAyar['MESAJ_SISTEM_KAPALI'];} else { echo "Sistem Kapalı"; } ?></textarea>
      <span id="countsprytextarea4">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
    </tr>
    <tr>
      <th valign="top">Servis Kapalı Mesajı:</th>
      <td><span id="sprytextarea5">
        <textarea name="MESAJ_SERVIS_KAPALI" class="form-control" cols="30" rows="3"><?php if($row_KioskAyar['MESAJ_SERVIS_KAPALI']!=""){ echo $row_KioskAyar['MESAJ_SERVIS_KAPALI'];} else { echo "Servis Kapalı"; } ?></textarea>
        <span id="countsprytextarea5">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span>
	</td>
      <td colspan="2">       
      <table class="table">
        <tr>
          <th colspan="2">Bilet Basma Aralığı(sn):
           </th>
            <td colspan="4"> <input class="form-control" type="number" min="1" max="100" name="GECIKME" value="<?php if($row_KioskAyar['GECIKME']!=""){echo $row_KioskAyar['GECIKME'];}else { echo 1; } ?>" size="32"></td>
          </tr>
        <tr>
          <th>Aktif:</th>
          <td><label class="switch"><input class="form-control" type="checkbox" name="AKTIF" value="" <?php if (!(strcmp(htmlentities($row_KioskAyar['AKTIF'],ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_KioskAyar['AKTIF'],ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
          <th>Web Randevu?</th>
          <td><label class="switch"><input class="form-control" type="checkbox" name="WebdenRandevu" value=""  <?php if (!(strcmp(htmlentities($row_KioskAyar['WebdenRandevu'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
          <th>BarkodlaEtiket:</th>
          <td><label class="switch">
            <input class="form-control" type="checkbox" name="BarkodlaEtiket" value=""  <?php if (!(strcmp(htmlentities($row_KioskAyar['BarkodlaEtiket'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
          </tr>
    </table></td>
    </tr>
    </table>
	</div>  
</div>
</div>    
  <div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">2-Kiosk Tasarım Bilgileri</div>
  <div class="panel body table-responsive">
    <table class="table table-hover">
    <tr valign="baseline">
      <th > Kayan Yazı Başlık Fontu:</th>
      <td ><select class="form-control" name="FONT">
        <?php
do {  
?>
        <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_KioskAyar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
        <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
      </select></td>
      <th>&nbsp;</th>
      <td >&nbsp;</td>
	</tr>
    <tr valign="baseline">
      <th >Yazı Punto:</th>
      <td ><input class="form-control" type="number" min="1" max="100" name="PUNTO" value="<?php if($row_KioskAyar['PUNTO']!=""){echo $row_KioskAyar['PUNTO'];}else{ echo 30; } ?>" size="32">
        </td>
      <th >&nbsp;</th>
      <td >&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th >Yazı Rengi:</th>
      <td ><input type="text" class="form-control jscolor" name="YAZI_RENGI" value="<?php echo dechex($row_KioskAyar['YAZI_RENGI']); ?>" size="32"></td>
      <th >Arka Plan Rengi:</th>
      <td ><input type="text" class="form-control jscolor" name="RENK" value="<?php echo substr(dechex($row_KioskAyar['RENK']),2,6); ?>" size="32"></td> 
	 </tr>
    <tr valign="baseline">
      <th >Başlık Kaysın mı?</th>
      <td ><label class="switch">
        <input type="checkbox" name="BASLIK_KAY" value=""  <?php if (!(strcmp(htmlentities($row_KioskAyar['BASLIK_KAY'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} else if(!(strcmp(htmlentities($row_KioskAyar['BASLIK_KAY'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";}?>>
        <span class="slider round"></span></label></td>
      <th >Alt Başlık Kaysın mı?</th>
      <td ><label class="switch">
        <input type="checkbox" name="ALT_BASLIK_KAY" value=""  <?php if (!(strcmp(htmlentities($row_KioskAyar['ALT_BASLIK_KAY'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_KioskAyar['ALT_BASLIK_KAY'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>>
        <span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <th >Başlık Kayma Hızı:</th>
      <td ><input type="number" min="1" max="100" name="HIZ_BASLIK" value="<?php if($row_KioskAyar['HIZ_BASLIK']!=""){echo $row_KioskAyar['HIZ_BASLIK'];}else{ echo 1; } ?>" size="32">
        ms </td>
      <th >Alt Başlık Kayma Hızı:</th>
      <td ><input type="number" min="1" max="100" name="HIZ_ALT_BASLIK" value="<?php if($row_KioskAyar['HIZ_ALT_BASLIK']!=""){echo $row_KioskAyar['HIZ_ALT_BASLIK'];}else{ echo 1; } ?>" size="32">
        ms </td>
    </tr>
    <tr valign="baseline">
      <th >Başlık Kayma Yönü:</th>
      <td >
	  <table>
        <tr>
          <td>Sola Kaysın</td>
          <td>Sağa Kaysın</td>
          </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="YON_BASLIK" value="0" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_BASLIK'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";}else if ($row_KioskAyar['YON_BASLIK']=="") {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="YON_BASLIK" value="1" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_BASLIK'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
          </tr>
      </table>
	  </td>
      <th>Alt Başlık Kayma Yönü:</th>
      <td>
	  <table>
        <tr>
          <td>Sola Kaysın</td>
          <td>Sağa Kaysın</td>
        </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="YON_ALT_BASLIK" value="0" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_ALT_BASLIK'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";}else if ($row_KioskAyar['YON_ALT_BASLIK']=="") {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="YON_ALT_BASLIK" value="1" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_ALT_BASLIK'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
        </tr>
      </table>
	  </td>
    </tr>
    </table>
    </div>
    </div>
	</div>
  <div class="panel body table-responsive" style="overflow:auto;">
   <table class="table table-hover">
    <tr class="warning">
      <th valign="baseline">Kiosk Ekran Resmi:</th>
      <td><p>
        <input type="file" name="RESIM" value="" accept="image/*" size="32" >        
        <?php 
	  $img=base64_encode($row_KioskAyar['RESIM']);	  	    ?>
        <img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/>
        <input type="hidden" name="RESIM_AD" value="<?php if(isset($_GET['KioskEkle']) and  empty($row_KioskAyar['KID'])){ echo time(); }else { echo time(); }?>" size="32">
        <input type="hidden" name="ESKI_RESIM_AD" value="<?php echo $row_KioskAyar['RESIM_AD']; ?>" size="32">
      </p></td>
      <th>Kiosk Resim Yerleşim Planı:</th>
      <td>
	  <table class="table table-bordered table-hover">
        <tr>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="1" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="2" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="4" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),4))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
        </tr>
        <tr>
          <td>Üst Sol</td>
          <td>Üst Orta</td>
          <td>Üst Sağ</td>
        </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="16" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),16))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="32" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),32))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="64" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),64))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
        </tr>
        <tr>
          <td>Orta Sol</td>
          <td>Tam Orta</td>
          <td>Orta Sağ</td>
        </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="256" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),256))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="512" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),512))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="1024" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1024))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
        </tr>
        <tr>
          <td>Alt Sol</td>
          <td>Alt Orta</td>
          <td>Alt Sağ</td>
        </tr>
      </table>
	  </td>
      </tr>
 </table>
 </div>
 <div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">3-Etiket Tasarım Bilgileri</div>
  <div class="panel body table-responsive">
 <table class="table table-hover">
    <tr valign="baseline">
      <th>Etiket Yükseklik        </th>
      <th>Etiket Ön İzleme Süresi</th>
      <th>Rulo Etiket Adeti:</th>
      <td><input type="number" min="0" max="1000" name="TotalTag" value="<?php if($row_KioskAyar['TotalTag']!=""){ echo $row_KioskAyar['TotalTag'];}else {echo 1;} ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <th><input type="number" min="1" max="9999" name="TagPreviewHeight" value="<?php if($row_KioskAyar['TagPreviewHeight']!=""){echo $row_KioskAyar['TagPreviewHeight'];}else { echo 250;} ?>" size="32"></th>
      <td><input type="number" min="1" max="9999" name="TagPreviewTimerInterval" value="<?php if($row_KioskAyar['TagPreviewTimerInterval']!=""){echo $row_KioskAyar['TagPreviewTimerInterval']; }else { echo 1000; }?>" size="32">
      sn </td>
      <th>Maks. Rulo Etiket Adeti:</th>
      <td><input type="number" min="0" max="1000" name="MaxTotalTag" value="<?php if($row_KioskAyar['MaxTotalTag']!=""){echo $row_KioskAyar['MaxTotalTag'];}else{echo 500;} ?>" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th>Etiket Genişlik</th>
      <th>Etiket Ön İzleme Yakınlaştırma Oranı</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th><input type="number" min="1" max="9999" name="TagPreviewWidth" value="<?php if($row_KioskAyar['TagPreviewWidth']!=""){echo $row_KioskAyar['TagPreviewWidth'];}else{echo 200;} ?>" size="32"></th>
      <td><input type="number" min="0" max="2" step="0.01" name="TagPreviewZoom" value="<?php if($row_KioskAyar['TagPreviewZoom']!=""){ echo $row_KioskAyar['TagPreviewZoom'];}else{echo 0.9;} ?>" size="32"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   </table>
   </div>
   </div>
   </div>
 
 <div class="form-group">
  <div class="panel panel-red">
  <div class="panel panel-heading">4-Diğer Bilgiler</div>
  <div class="panel body table-responsive">
   <table class="table table-hover">
    <tr valign="baseline">
      <th valign="baseline">Sorumlu Personel</th>
      <td style="min-width:200px">
        <select class="form-control" name="TagOverFlowPerId">
          <?php 
do {  
?>
          <option value="<?php echo $row_Personel['PID']?>" <?php if (!(strcmp($row_Personel['PID'], htmlentities($row_KioskAyar['TagOverFlowPerId'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_Personel['AD']?></option>
          <?php
} while ($row_Personel = mysql_fetch_assoc($Personel));
?>
          </select>
        </td>
      <td>&nbsp;</td>
      <td style="min-width:200px">&nbsp;</td>
	</tr>
    <tr valign="baseline">
      <th valign="baseline">Bitik Etiket Mesajı:</th>
      <td><input class="form-control" type="text" maxlength="100" name="TagOverFlowMessage" value="<?php if($row_KioskAyar['TagOverFlowMessage']!=""){echo $row_KioskAyar['TagOverFlowMessage'];}else {echo "Kağıt Bitti";} ?>" size="32">
      </td>
      <th>Bekleme Suresi Metni:</th>
      <td><input class="form-control" type="text" maxlength="100" name="BeklemeSuresiMetni" value="<?php if($row_KioskAyar['BeklemeSuresiMetni']!=""){echo $row_KioskAyar['BeklemeSuresiMetni']; } else {echo "Lütfen Bekleyiniz"; } ?>" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th valign="baseline">Alt Buton Suresi(ms):</th>
      <td><input class="form-control" type="number" min="1" max="10000" name="AltButonSuresi" value="<?php if($row_KioskAyar['AltButonSuresi']!=""){echo $row_KioskAyar['AltButonSuresi'];}else { echo 10;} ?>" size="32"></td>
      <th>Etiket Sıfırlama şifresi:</th>
      <td><span id="sprytextfield1">
      <input name="EtiketSifirlamasifresi" type="text" class="form-control" value="<?php if($row_KioskAyar['EtiketSifirlamasifresi']!=""){ echo $row_KioskAyar['EtiketSifirlamasifresi'];}else { echo 1234; } ?>" size="32" maxlength="11">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.Sadece sayı</span></span></td>
      </tr>
    <tr valign="baseline">
      <th valign="baseline">Sol Buton Adeti:</th>
      <td><input class="form-control" type="number" min="1" max="100"  name="SOL_BTN_ADET" value="<?php if($row_KioskAyar['SOL_BTN_ADET']!=""){echo $row_KioskAyar['SOL_BTN_ADET'];}else {echo 1;} ?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">Sağ Buton Adeti:</th>
      <td><input class="form-control" type="number" min="1" max="100" name="SAG_BTN_ADET" value="<?php if($row_KioskAyar['SAG_BTN_ADET']!=""){ echo $row_KioskAyar['SAG_BTN_ADET'];} else {echo 1; } ?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">Sol Boşluk:</th>
      <td><input class="form-control" type="number" min="1" max="100" name="SOL_PADDING" value="<?php if($row_KioskAyar['SOL_PADDING']!=""){ echo $row_KioskAyar['SOL_PADDING']; } else{ echo 1; }?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">Sağ Boşluk:</th>
      <td><input class="form-control" type="number" min="1" max="100" name="SAG_PADDING" value="<?php if($row_KioskAyar['SAG_PADDING']!="") {echo $row_KioskAyar['SAG_PADDING'];} else { echo 1;} ?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" valign="baseline"><?php if(isset($_GET['KioskEkle']) and  empty($row_KioskAyar['KID']) and isset($_GET['Kiosk'])){?>
        <input class="form-control btn btn-success" type="submit" value="Yeni Kiosk Ekle">
        <input type="hidden" name="KID" value="<?php echo $_GET['Kiosk']; ?>">
        <input type="hidden" name="MM_insert" value="form1">
        <?php } else if(isset($_GET['Kiosk']) and  !empty($row_KioskAyar['KID'])){?>    
        <input type="submit" class="form-control btn btn-primary" value="Kiosk Güncelleştir">
        <input type="hidden" name="MM_update" value="form2">
        <input type="hidden" name="KID" value="<?php echo $row_KioskAyar['KID']; ?>">
        <?php } ?></td>
      </tr>
  </table>
  </div>
  </div>
  </div>
</form>
<?php
	} //form göster gizle bitiş
	?>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:200, counterId:"countsprytextarea1", counterType:"chars_remaining"});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {maxChars:200, isRequired:false, validateOn:["blur", "change"], counterId:"countsprytextarea2", counterType:"chars_remaining"});
var sprytextarea3 = new Spry.Widget.ValidationTextarea("sprytextarea3", {maxChars:50, validateOn:["blur", "change"], counterId:"countsprytextarea3", counterType:"chars_remaining", isRequired:false});
var sprytextarea4 = new Spry.Widget.ValidationTextarea("sprytextarea4", {maxChars:50, isRequired:false, validateOn:["blur", "change"], counterId:"countsprytextarea4", counterType:"chars_remaining"});
var sprytextarea5 = new Spry.Widget.ValidationTextarea("sprytextarea5", {validateOn:["blur", "change"], isRequired:false, maxChars:50, counterId:"countsprytextarea5", counterType:"chars_remaining"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"], useCharacterMasking:true});
</script>
</body>
<?php 
mysql_free_result($BiletMakinesi);

mysql_free_result($Personel);

mysql_free_result($Fontlar);

mysql_free_result($KioskAyar);
?>