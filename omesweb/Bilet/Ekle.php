<?php //require_once('../Connections/baglantim.php'); ?>
<?php
/*
	Bu sayfada Ekleme ve Güncelleme işlemi birlikte yapıldı
	11.08.2017
*/
 
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
$insertSQL = sprintf("INSERT INTO bilet_ayar (KID, BILET_BASLIK_S1, BILET_BASLIK_S2, BILET_BASLIK_S3, BILET_BASLIK_S4, ETIKET_BEKLEYEN, ETIKET_KARSILAMA1, ETIKET_KARSILAMA2, FONT_BEKLEYEN, FONT_KARSILAMA, FONT_BASLIK, FONT_GRUP, FONT_TARIH, FONT_SIRANO, FONT2_SIRANO, PUNTO_BEKLEYEN, PUNTO_KARSILAMA, PUNTO_BASLIK, PUNTO_GRUP, PUNTO_TARIH, PUNTO_SIRANO, YAZ_BEKLEYEN, YAZ_KARSILAMA, YAZ_BASLIK, YAZ_GRUP, YAZ_TARIH, YAZ_SIRANO, OrtalamaBeklemeSuresiYaz) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['KID'], "text"),
GetSQLValueString($_POST['BILET_BASLIK_S1'], "text"),
                       GetSQLValueString($_POST['BILET_BASLIK_S2'], "text"),
                       GetSQLValueString($_POST['BILET_BASLIK_S3'], "text"),
                       GetSQLValueString($_POST['BILET_BASLIK_S4'], "text"),
                       GetSQLValueString($_POST['ETIKET_BEKLEYEN'], "text"),
                       GetSQLValueString($_POST['ETIKET_KARSILAMA1'], "text"),
                       GetSQLValueString($_POST['ETIKET_KARSILAMA2'], "text"),
                       GetSQLValueString($_POST['FONT_BEKLEYEN'], "text"),
                       GetSQLValueString($_POST['FONT_KARSILAMA'], "text"),
                       GetSQLValueString($_POST['FONT_BASLIK'], "text"),
                       GetSQLValueString($_POST['FONT_GRUP'], "text"),
                       GetSQLValueString($_POST['FONT_TARIH'], "text"),
                       GetSQLValueString($_POST['FONT_SIRANO'], "text"),
                       GetSQLValueString($_POST['FONT2_SIRANO'], "text"),
                       GetSQLValueString($_POST['PUNTO_BEKLEYEN'], "int"),
                       GetSQLValueString($_POST['PUNTO_KARSILAMA'], "int"),
                       GetSQLValueString($_POST['PUNTO_BASLIK'], "int"),
                       GetSQLValueString($_POST['PUNTO_GRUP'], "int"),
                       GetSQLValueString($_POST['PUNTO_TARIH'], "int"),
                       GetSQLValueString($_POST['PUNTO_SIRANO'], "int"),
                       GetSQLValueString(isset($_POST['YAZ_BEKLEYEN']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_KARSILAMA']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_BASLIK']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_GRUP']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_TARIH']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_SIRANO']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['OrtalamaBeklemeSuresiYaz']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['KID'], "int"));
					   
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?BiletEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
 
    $updateSQL = sprintf("UPDATE bilet_ayar SET BILET_BASLIK_S1=%s, BILET_BASLIK_S2=%s, BILET_BASLIK_S3=%s, BILET_BASLIK_S4=%s, ETIKET_BEKLEYEN=%s, ETIKET_KARSILAMA1=%s, ETIKET_KARSILAMA2=%s, FONT_BEKLEYEN=%s, FONT_KARSILAMA=%s, FONT_BASLIK=%s, FONT_GRUP=%s, FONT_TARIH=%s, FONT_SIRANO=%s, FONT2_SIRANO=%s, PUNTO_BEKLEYEN=%s, PUNTO_KARSILAMA=%s, PUNTO_BASLIK=%s, PUNTO_GRUP=%s, PUNTO_TARIH=%s, PUNTO_SIRANO=%s, YAZ_BEKLEYEN=%s, YAZ_KARSILAMA=%s, YAZ_BASLIK=%s, YAZ_GRUP=%s, YAZ_TARIH=%s, YAZ_SIRANO=%s, OrtalamaBeklemeSuresiYaz=%s WHERE KID=%s",
                       GetSQLValueString($_POST['BILET_BASLIK_S1'], "text"),
                       GetSQLValueString($_POST['BILET_BASLIK_S2'], "text"),
                       GetSQLValueString($_POST['BILET_BASLIK_S3'], "text"),
                       GetSQLValueString($_POST['BILET_BASLIK_S4'], "text"),
                       GetSQLValueString($_POST['ETIKET_BEKLEYEN'], "text"),
                       GetSQLValueString($_POST['ETIKET_KARSILAMA1'], "text"),
                       GetSQLValueString($_POST['ETIKET_KARSILAMA2'], "text"),
                       GetSQLValueString($_POST['FONT_BEKLEYEN'], "text"),
                       GetSQLValueString($_POST['FONT_KARSILAMA'], "text"),
                       GetSQLValueString($_POST['FONT_BASLIK'], "text"),
                       GetSQLValueString($_POST['FONT_GRUP'], "text"),
                       GetSQLValueString($_POST['FONT_TARIH'], "text"),
                       GetSQLValueString($_POST['FONT_SIRANO'], "text"),
                       GetSQLValueString($_POST['FONT2_SIRANO'], "text"),
                       GetSQLValueString($_POST['PUNTO_BEKLEYEN'], "int"),
                       GetSQLValueString($_POST['PUNTO_KARSILAMA'], "int"),
                       GetSQLValueString($_POST['PUNTO_BASLIK'], "int"),
                       GetSQLValueString($_POST['PUNTO_GRUP'], "int"),
                       GetSQLValueString($_POST['PUNTO_TARIH'], "int"),
                       GetSQLValueString($_POST['PUNTO_SIRANO'], "int"),
                       GetSQLValueString(isset($_POST['YAZ_BEKLEYEN']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_KARSILAMA']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_BASLIK']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_GRUP']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_TARIH']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['YAZ_SIRANO']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['OrtalamaBeklemeSuresiYaz']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['KID'], "int"));
					   
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?BiletEkle=gnc&";
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
$query_Fontlar = "SELECT * FROM fontlar";
$Fontlar = mysql_query($query_Fontlar, $baglantim) or die(mysql_error());
$row_Fontlar = mysql_fetch_assoc($Fontlar);
$totalRows_Fontlar = mysql_num_rows($Fontlar);

$colname_BiletAyar = "-1";
if (isset($_GET['Kiosk'])) {
  $colname_BiletAyar = $_GET['Kiosk'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_BiletAyar = sprintf("SELECT * FROM bilet_ayar WHERE KID = %s", GetSQLValueString($colname_BiletAyar, "int"));
$BiletAyar = mysql_query($query_BiletAyar, $baglantim) or die(mysql_error());
$row_BiletAyar = mysql_fetch_assoc($BiletAyar);
$totalRows_BiletAyar = mysql_num_rows($BiletAyar);
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

<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">

<body>
<?php
	if(isset($_GET["BiletEkle"]) and $_GET["BiletEkle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Bilet Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Bilet Ayarları Kaydedildi</strong></p>
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
<?php if(isset($_GET["BiletEkle"]) and $_GET["BiletEkle"]=="gnc" )
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
<?php if(isset($_GET["BiletEkle"]) and $_GET["BiletEkle"]=="SilOk" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    //$("#hata").click(function(){
        $("#SilOk").fadeOut(6000);       
//    });
});
</script><!-- Jquery ile fadein fadeout için -->
<div id="SilOk" class="alert alert-danger"><strong>Seçtiğiniz Bilet İçin Tüm Ayarlar Silindi!</strong></div>
<?php
}
?>
<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["BiletEkle"]) and $_GET["BiletEkle"]=="SilEksik" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    //$("#hata").click(function(){
        $("#hata").fadeOut(6000);       
//    });
});
</script><!-- Jquery ile fadein fadeout için -->
<div id="hata" class="alert alert-danger"><strong>Lütfen Geçerli bir Kioks ID Seçiniz.</strong></div>
<?php
}
?><?php if(isset($_GET["BiletEkle"]) and $_GET["BiletEkle"]=="SilOk" and isset($_GET['?KioskSil']) and $_GET['?KioskSil']!="")
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(10000);
});<!-- Jquery ile fadein fadeout için -->
</script>
<div id="eklendi" class="btn btn-success"><?php echo "#".$_GET['?KioskSil']; ?> Seçtiğiniz Kiosk Makinesi Ayarları Silindi. <strong> Not:Bu işlem Kioks Makinesini Silmez Sadece Ekran Ayarlarını Temizler.</strong></div>
<?php
}
?> <div class="panel-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Bilet Yazdıma Ayarları Paneli</div>
<div class="alert alert-info">
<div class="table-responsive">
<form name="form" id="form">  
  <select class="form-control btn btn-info" role="menu" name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenuGo('jumpMenu','parent',0)">
    <option value="?BiletEkle">Bilet Ayarları için Bilet Makinesi Seçiniz</option>
    <?php
do {  
?>
    <option value="?BiletEkle&Kiosk=<?php echo $row_BiletMakinesi['MAKINE_ADRESI'];?>" <?php if (isset($_GET['Kiosk']) and !(strcmp($_GET['Kiosk'], htmlentities($row_BiletMakinesi['MAKINE_ADRESI'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_BiletMakinesi['MAKINE_ADRESI']."-".$row_BiletMakinesi['MAKINE_ADI']?></option>
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
 <a href="?BiletSil=<?php if(isset($_GET['Kiosk'])){echo $_GET['Kiosk'];} ?>" class="form-control btn btn-danger" id="sprytrigger1" onClick="return confirm('Seçili Bilet Makinesi İçin Kiosk Ayarları Silinsin mi?');" role="button">Seçili Bilet Makinesi için Bilet Ayarlarını Sil</a> 
(Eğer Kaydedilmiş Bir Bilet Ayarı varsa güncelleme bilgileri yüklenecektir. Yoksa Yeni Bilgi İçin Boş Form Açılacaktır.)</div>
</div>
</div>
</div>
<div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Geri Alınamaz.</div>
<?php 
	if(isset($_GET['Kiosk']) and $_GET['Kiosk']!="")
	{//form göster gizle başlangıç
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Bilet Yazdırma Ayarları</div>
 <div class="row">
 <div class="col-md-6">
 <div class="panel body">
 <table class="table table-hover">
  <tr>
    <th colspan="2" class="warning">Bilet yazıları</th>
    </tr>
  <tr>
    <th>Seçili Kiosk ID:</th>
    <td><?php if(isset($_GET['Kiosk'])){ echo "<span class='alert alert-danger'><strong># ".$_GET['Kiosk']." (Kiosk Kimliği)</strong></span>"; }else { echo "<span class='btn btn-danger'><strong>Henüz Bir Kiosk Seçmediğiniz İçin İşlem Yapamazsınız.</strong></span>"; } ?></td>
  </tr>
  <tr>
    <th>BILET BASLIK S1:</th>
    <td><span id="sprytextfield1">
      <input class="form-control" maxlength="30" type="text" name="BILET_BASLIK_S1" value="<?php echo htmlentities($row_BiletAyar['BILET_BASLIK_S1'], ENT_COMPAT, 'utf-8'); ?>" size="32" required>
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
  </tr>
  <tr>
    <th>BILET BASLIK S2:</th>
    <td><input class="form-control" maxlength="30" type="text" name="BILET_BASLIK_S2" value="<?php echo htmlentities($row_BiletAyar['BILET_BASLIK_S2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
  </tr>
  <tr>
    <th>BILET BASLIK S3:</th>
    <td><input class="form-control" maxlength="30" type="text" name="BILET_BASLIK_S3" value="<?php echo htmlentities($row_BiletAyar['BILET_BASLIK_S3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
  </tr>
  <tr>
    <th>BILET BASLIK S4:</th>
    <td><input class="form-control" maxlength="30" type="text" name="BILET_BASLIK_S4" value="<?php echo htmlentities($row_BiletAyar['BILET_BASLIK_S4'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
  </tr>
  <tr>
    <th>FONT BASLIK:</th>
    <td><select class="form-control" name="FONT_BASLIK">
      <?php
do {  
?>
      <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT_BASLIK'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
      <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
    </select></td></tr>
  <tr>
    <th>PUNTO BASLIK:</th>
    <td><input class="form-control" type="number" min="10" max="100" name="PUNTO_BASLIK" value="<?php if($row_BiletAyar['PUNTO_BASLIK']!=""){ echo htmlentities($row_BiletAyar['PUNTO_BASLIK'], ENT_COMPAT, 'utf-8'); } else { echo 10;}?>" size="32"></td>
  </tr>
  <tr>
    <th nowrap align="right"> Bilet üzerinde başlıklar gösterilsin mi?:</th>
    <td><label class="switch"><input type="checkbox" name="YAZ_BASLIK" value="" <?php if (!(strcmp(htmlentities($row_BiletAyar['YAZ_BASLIK'],ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_BiletAyar['YAZ_BASLIK'],ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
  </tr>
</table>
</div>
</div>
<div class="col-md-6">
<div class="panel body">
<table class="table table-hover">
  <tr>
    <th colspan="2" class="success">Bekleme Yazıları</th>
    </tr>
  <tr>
    <th>ETIKET BEKLEYEN:</th>
    <td><input class="form-control" maxlength="30" type="text" name="ETIKET_BEKLEYEN" value="<?php if($row_BiletAyar['ETIKET_BEKLEYEN']!=""){ echo htmlentities($row_BiletAyar['ETIKET_BEKLEYEN'], ENT_COMPAT, 'utf-8'); }else{ echo "Bekleyen Kişi"; }?>" size="32"></td>
  </tr> 
  <tr>
    <th>FONT BEKLEYEN:</th>
    <td><select class="form-control" name="FONT_BEKLEYEN">
      <?php
do {  
?>
      <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT_BEKLEYEN'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
      <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
    </select></td>
  </tr>
  <tr>
    <th>PUNTO BEKLEYEN:</th>
    <td><input class="form-control" type="number" min="10" max="100" name="PUNTO_BEKLEYEN" value="<?php if(empty($row_BiletAyar['PUNTO_BEKLEYEN'])){echo 10;}else{ echo htmlentities($row_BiletAyar['PUNTO_BEKLEYEN'], ENT_COMPAT, 'utf-8'); }?>" size="32"></td>
  </tr>
  <tr>
    <th>Sırada Bekleyen Kişi Sayısını Göster?</th>
    <td><label class="switch"><input type="checkbox" name="YAZ_BEKLEYEN" value=""  <?php if (!(strcmp(htmlentities($row_BiletAyar['YAZ_BEKLEYEN'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_BiletAyar['YAZ_BEKLEYEN'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
  </tr>
  <tr>
    <th>Ortalama Bekleme Suresi Göster?</th>
    <td><label class="switch"><input type="checkbox" name="OrtalamaBeklemeSuresiYaz" value=""  <?php if (!(strcmp(htmlentities($row_BiletAyar['OrtalamaBeklemeSuresiYaz'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}?>><span class="slider round"></span></label></td>
    </tr>
  </table>
  </div>
  </div>
  </div>
  
  <div class="row">
  <div class="col-md-6">
  <div class="panel body">
  <table class="table table-hover">
  <tr>
    <th colspan="2" class="label-red">Servis/Grup Yazıları</th>
    </tr>
  <tr>
    <th>FONT GRUP:</th>
    <td><select class="form-control" name="FONT_GRUP">
      <?php
do {  
?>
      <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT_GRUP'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
      <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
    </select></td>
  </tr>
  <tr>
    <th>PUNTO GRUP:</th>
    <td><input class="form-control" type="number" min="10" max="100" name="PUNTO_GRUP" value="<?php if($row_BiletAyar['PUNTO_GRUP']!=""){ echo htmlentities($row_BiletAyar['PUNTO_GRUP'], ENT_COMPAT, 'utf-8'); } else { echo 10; }?>" size="32"></td>
  </tr>
  <tr>
    <th>Grup bilgisi gösterilsin mi?:</th>
    <td><label class="switch"><input type="checkbox" name="YAZ_GRUP" value=""  <?php if (!(strcmp(htmlentities($row_BiletAyar['YAZ_GRUP'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}else  if (!(strcmp(htmlentities($row_BiletAyar['YAZ_GRUP'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
  </tr>
</table>
</div>
</div>
<div class="col-md-6">
<div class="panel body">
<table class="table table-hover">
        <tr>
          <th colspan="2" class="label-blue">Karşılama Yazıları</th>
          </tr>
        <tr>
          <th>ETIKET KARSILAMA1:</th>
          <td><input class="form-control" type="text" name="ETIKET_KARSILAMA1" value="<?php echo htmlentities($row_BiletAyar['ETIKET_KARSILAMA1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr>
          <th>ETIKET KARSILAMA2:</th>
          <td><input class="form-control" type="text" name="ETIKET_KARSILAMA2" value="<?php echo htmlentities($row_BiletAyar['ETIKET_KARSILAMA2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
        </tr>
        <tr>
          <th>FONT KARSILAMA:</th>
          <td><select class="form-control" name="FONT_KARSILAMA">
            <?php
do {  
?>
            <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT_KARSILAMA'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
            <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
          </select></td>
        </tr>
        <tr>
          <th>PUNTO KARSILAMA:</th>
          <td><input class="form-control" type="number" min="10" max="100" name="PUNTO_KARSILAMA" value="<?php if($row_BiletAyar['PUNTO_KARSILAMA']!=""){ echo htmlentities($row_BiletAyar['PUNTO_KARSILAMA'], ENT_COMPAT, 'utf-8'); } else {echo 10;} ?>" size="32"></td></tr>
        <tr>
          <th>Karşılama Yazısı Gösterilsin mi?:</th>
          <td><label class="switch"><input type="checkbox" name="YAZ_KARSILAMA" value=""  <?php if (!(strcmp(htmlentities($row_BiletAyar['YAZ_KARSILAMA'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_BiletAyar['YAZ_KARSILAMA'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";}  ?>><span class="slider round"></span></label></td> </tr>
        </table>
       </div>
     </div>
    </div>        
        <div class="row">
        <div class="col-md-6">
        <div class="panel body">
        <table class="table table-hover">
        <tr>
          <th colspan="2" class="label-yellow">Bilet Numarası Yazısı</th>
          </tr>
        <tr>
          <th>FONT SIRANO:</th>
          <td><select class="form-control" name="FONT_SIRANO">
            <?php
do {  
?>
            <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT_SIRANO'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
            <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
          </select></td></tr>
        <tr>
          <th>FONT2 SIRANO:</th>
          <td><select class="form-control" name="FONT2_SIRANO">
            <?php
do {  
?>
            <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT2_SIRANO'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
            <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
          </select></td>
          </tr>
        <tr>
          <th>PUNTO SIRANO:</th>
          <td><input class="form-control" type="number" min="10" max="100" name="PUNTO_SIRANO" value="<?php if($row_BiletAyar['PUNTO_SIRANO']!=""){ echo htmlentities($row_BiletAyar['PUNTO_SIRANO'], ENT_COMPAT, 'utf-8'); }else { echo 60; }?>" size="32"></td>
          </tr>
        <tr>
          <th>Bilet Sıra No Gösterilsin mi?:</th>
          <td><label class="switch"><input type="checkbox" name="YAZ_SIRANO" value=""  <?php if (!(strcmp(htmlentities($row_BiletAyar['YAZ_SIRANO'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} else if (!(strcmp(htmlentities($row_BiletAyar['YAZ_SIRANO'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
        </tr>
      </table>
      </div>
	</div>      
      <div class="col-md-6">
      <div class="panel body">
        <table class="table table-hover">
        <tr>
          <th colspan="2" class="label-green">Tarih Yazısı</th>
          </tr>
        <tr>
          <th>FONT TARIH:</th>
          <td><select class="form-control" name="FONT_TARIH">
            <?php
do {  
?>
            <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_BiletAyar['FONT_TARIH'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
            <?php
} while ($row_Fontlar = mysql_fetch_assoc($Fontlar));
  $rows = mysql_num_rows($Fontlar);
  if($rows > 0) {
      mysql_data_seek($Fontlar, 0);
	  $row_Fontlar = mysql_fetch_assoc($Fontlar);
  }
?>
          </select></td>
          </tr>
        <tr>
          <th>PUNTO TARIH:</th>
          <td><input class="form-control" type="number" min="10" max="100" name="PUNTO_TARIH" value="<?php if($row_BiletAyar['PUNTO_TARIH']!=""){ echo htmlentities($row_BiletAyar['PUNTO_TARIH'], ENT_COMPAT, 'utf-8'); }else { echo 10;}?>" size="32"></td>
          </tr>
        <tr>
          <th>Tarih Gösterilsin mi?:</th>
          <td><label class="switch"><input type="checkbox" name="YAZ_TARIH" value=""  <?php if (!(strcmp(htmlentities($row_BiletAyar['YAZ_TARIH'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} else if (!(strcmp(htmlentities($row_BiletAyar['YAZ_TARIH'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";}?>><span class="slider round"></span></label></td>
          </tr>
        </table>
        </div>
</div>
</div>
<div class="row">
	<div class="col-md-6">
        <table class="table table-responsive">  
        <tr> 
        <td>
          <?php if(isset($_GET['BiletEkle']) and  empty($row_BiletAyar['KID']) and isset($_GET['Kiosk'])){?>
          <input class="form-control btn btn-success" type="submit" value="Yeni Bilet Ayarı Ekle">
          <input type="hidden" name="KID" value="<?php echo $_GET['Kiosk']; ?>">
          <input type="hidden" name="MM_insert" value="form1">
          <?php } else if(isset($_GET['Kiosk']) and  !empty($row_BiletAyar['KID'])){
		   ?>    
          <input type="submit" class="form-control btn btn-primary" value="Bilet Ayar Güncelleştir">
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="KID" value="<?php echo $row_BiletAyar['KID']; ?>">
          <?php } ?>        </td> 
      </tr>
  </table>
  </div></div>
  
  </div></div>
</form>
<?php
	} //form göster gizle bitiş
	?>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
</script>
</body>
<?php
mysql_free_result($BiletMakinesi);

mysql_free_result($Fontlar);

mysql_free_result($BiletAyar);
?>
