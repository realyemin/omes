<?php //require_once('../Connections/baglantim.php'); ?>
<?php
//arkaplan rengi windows için - değerli ifadeye çevrildi
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
/*resim önceden yüklenmişse ve yeni güncelleme yapılmayacaksa img olarak eski resmin vt de kalması gerek
*/


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	$updateSQL=-1;
	if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){
		//eğer yeni resim yüklendiyse bunu çalıştır
  $updateSQL = sprintf("UPDATE butonlar SET BTNID=%s, ANA_BTNID=%s, GRP_ID=%s, GRP1_ORAN=%s, GRP_ID2=%s, GRP2_ORAN=%s, GRP_ID3=%s, GRP3_ORAN=%s, GRP_ID4=%s, GRP4_ORAN=%s, ANA_BTNID=%s, BTN_EKRAN=%s, BTN_BILET_S1=%s, BTN_BILET_S2=%s, BTN_BILET_S3=%s, BTN_BILET_S4=%s, MAKS_BILET=%s, BILET_KOPYA=%s, YUKSEKLIK=%s, GENISLIK=%s, I_YF1=%s, I_YF2=%s, RENK=%s, YAZI_RENGI=%s, RESIM=%s, RESIM_YON=%s, RESIM_AD=%s, ESKI_RESIM_AD=%s, ACIKLAMA=%s, AKTIF=%s, S_YF1=%s, S_YF2=%s, S_YF3=%s, I_YF3=%s, B_YF=%s, RandevuButonuMu=%s, FONT=%s, PUNTO=%s WHERE BM_ADRES=%s and BTNID=%s",
                       GetSQLValueString($_POST['BTNID'], "int"),
					   GetSQLValueString($_POST['ANA_BTNID'], "int"),
                       GetSQLValueString($_POST['GRP_ID'], "int"),
                       GetSQLValueString($_POST['GRP1_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID2'], "int"),
                       GetSQLValueString($_POST['GRP2_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID3'], "int"),
                       GetSQLValueString($_POST['GRP3_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID4'], "int"),
                       GetSQLValueString($_POST['GRP4_ORAN'], "int"),
                       GetSQLValueString($_POST['ANA_BTNID'], "int"),
                       GetSQLValueString($_POST['BTN_EKRAN'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S1'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S2'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S3'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S4'], "text"),
                       GetSQLValueString($_POST['MAKS_BILET'], "int"),
                       GetSQLValueString($_POST['BILET_KOPYA'], "int"),
                       GetSQLValueString($_POST['YUKSEKLIK'], "int"),
                       GetSQLValueString($_POST['GENISLIK'], "int"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString(signedint32(hexdec('FF'.$_POST['RENK'])), "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),
                       GetSQLValueString(file_get_contents($_FILES['RESIM']["tmp_name"]), "text"),
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ACIKLAMA'], "text"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString(isset($_POST['RandevuButonuMu']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['FONT'], "text"),
                       GetSQLValueString($_POST['PUNTO'], "int"),
                       GetSQLValueString($_POST['BM_ADRES_TEMP'], "int"),
					   GetSQLValueString($_POST['BTNID_TEMP'], "int"));
	}
	else
	{
		  $updateSQL = sprintf("UPDATE butonlar SET BTNID=%s, ANA_BTNID=%s, GRP_ID=%s, GRP1_ORAN=%s, GRP_ID2=%s, GRP2_ORAN=%s, GRP_ID3=%s, GRP3_ORAN=%s, GRP_ID4=%s, GRP4_ORAN=%s, ANA_BTNID=%s, BTN_EKRAN=%s, BTN_BILET_S1=%s, BTN_BILET_S2=%s, BTN_BILET_S3=%s, BTN_BILET_S4=%s, MAKS_BILET=%s, BILET_KOPYA=%s, YUKSEKLIK=%s, GENISLIK=%s, I_YF1=%s, I_YF2=%s, RENK=%s, YAZI_RENGI=%s, RESIM_YON=%s, RESIM_AD=%s, ESKI_RESIM_AD=%s, ACIKLAMA=%s, AKTIF=%s, S_YF1=%s, S_YF2=%s, S_YF3=%s, I_YF3=%s, B_YF=%s, RandevuButonuMu=%s, FONT=%s, PUNTO=%s WHERE BM_ADRES=%s and BTNID=%s",
                       GetSQLValueString($_POST['BTNID'], "int"),
					   GetSQLValueString($_POST['ANA_BTNID'], "int"),
                       GetSQLValueString($_POST['GRP_ID'], "int"),
                       GetSQLValueString($_POST['GRP1_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID2'], "int"),
                       GetSQLValueString($_POST['GRP2_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID3'], "int"),
                       GetSQLValueString($_POST['GRP3_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID4'], "int"),
                       GetSQLValueString($_POST['GRP4_ORAN'], "int"),
                       GetSQLValueString($_POST['ANA_BTNID'], "int"),
                       GetSQLValueString($_POST['BTN_EKRAN'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S1'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S2'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S3'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S4'], "text"),
                       GetSQLValueString($_POST['MAKS_BILET'], "int"),
                       GetSQLValueString($_POST['BILET_KOPYA'], "int"),
                       GetSQLValueString($_POST['YUKSEKLIK'], "int"),
                       GetSQLValueString($_POST['GENISLIK'], "int"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString(signedint32(hexdec('FF'.$_POST['RENK'])), "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),                       
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ACIKLAMA'], "text"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString(isset($_POST['RandevuButonuMu']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['FONT'], "text"),
                       GetSQLValueString($_POST['PUNTO'], "int"),
                       GetSQLValueString($_POST['BM_ADRES_TEMP'], "int"),
					   GetSQLValueString($_POST['BTNID_TEMP'], "int"));
	}
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?AltButonGuncelle=ok&";
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
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);

$BM_ADRES = "-1";
$BTNID = "-1";
if (isset($_GET['BM_ADRES']) and isset($_GET['BTNID'])) {
  $BM_ADRES = $_GET['BM_ADRES'];
    $BTNID = $_GET['BTNID'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_Butonlar = sprintf("SELECT * FROM butonlar WHERE BM_ADRES = %s and BTNID = %s", GetSQLValueString($BM_ADRES, "int"),GetSQLValueString($BTNID, "int"));
$Butonlar = mysql_query($query_Butonlar, $baglantim) or die(mysql_error());
$row_Butonlar = mysql_fetch_assoc($Butonlar);
$totalRows_Butonlar = mysql_num_rows($Butonlar);

mysql_select_db($database_baglantim, $baglantim);
$query_Fontlar = "SELECT * FROM fontlar";
$Fontlar = mysql_query($query_Fontlar, $baglantim) or die(mysql_error());
$row_Fontlar = mysql_fetch_assoc($Fontlar);
$totalRows_Fontlar = mysql_num_rows($Fontlar);

mysql_select_db($database_baglantim, $baglantim);
$query_AnaButonlar = "SELECT BTNID, BTN_EKRAN FROM butonlar WHERE ANA_BTNID = 0";
$AnaButonlar = mysql_query($query_AnaButonlar, $baglantim) or die(mysql_error());
$row_AnaButonlar = mysql_fetch_assoc($AnaButonlar);
$totalRows_AnaButonlar = mysql_num_rows($AnaButonlar);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
</head>

<body>  
<?php if(isset($_GET["AltButonGuncelle"]) and $_GET["AltButonGuncelle"]=="ok" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").click(function(){
        $("#eklendi").fadeOut();       
    });
});<!-- Jquery ile fadein fadeout için -->
</script>
    <div id="eklendi"><span class="btn btn-success">Bilet Makinesi Güncelledi. Görüntülemek için <a class="btn btn-red" href="?AltButonListele">Tıklayabilirisiniz.</a> Veya başka Bir Buton <a class="btn btn-info" href="?AltButonEkle">Ekleyebilirsiniz.</a> </span></div>
<?php
}
?>

<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-blue">
    <div class="panel panel-heading">Alt Buton Güncelleme Ekranı</div>
    <div class="row">
<div class="col-md-6">
<div class="panel body table-responsive">    
      <table class="table table-hover">
              <tr valign="baseline">
                <th nowrap align="right">Bilet Makinesi</th>
                <td><select class="form-control" name="BM_ADRES" disabled>
                  <?php 
do {  
?>
                  <option value="<?php echo $row_BiletMakinesi['MAKINE_ADRESI']?>" <?php if (!(strcmp($row_BiletMakinesi['MAKINE_ADRESI'], $row_Butonlar['BM_ADRES']))) {echo "SELECTED";} ?>><?php echo $row_BiletMakinesi['MAKINE_ADI']?></option>
                  <?php
} while ($row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi));
?>
                </select></td>
                <th align="right"><p>Ana Buton ID
                    <span id="spryselect2">
                    <select class="form-control" name="ANA_BTNID" id="ANA_BTNID">
                      <option value="-1" <?php if (!(strcmp(-1, $row_Butonlar['BTNID']))) {echo "selected=\"selected\"";} ?>>Seçiniz</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_AnaButonlar['BTNID']?>"<?php if (!(strcmp($row_AnaButonlar['BTNID'], $row_Butonlar['ANA_BTNID']))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_AnaButonlar['BTNID']."-".$row_AnaButonlar['BTN_EKRAN']?></option>
                      <?php
} while ($row_AnaButonlar = mysql_fetch_assoc($AnaButonlar));
  $rows = mysql_num_rows($AnaButonlar);
  if($rows > 0) {
      mysql_data_seek($AnaButonlar, 0);
	  $row_AnaButonlar = mysql_fetch_assoc($AnaButonlar);
  }
?>
                    </select>
                    <span class="selectInvalidMsg">Lütfen geçerli bir öğe seçin.</span><span class="selectRequiredMsg">Lütfen bir öğe seçin.</span></span> </p>
               </th>
                <th>Buton ID
                  <input type="hidden" name="BTNID" value="<?php echo htmlentities($row_Butonlar['BTNID'], ENT_COMPAT, 'utf-8'); ?>" size="32">
                 <span class="label label-default"><?php echo htmlentities($row_Butonlar['BTNID'], ENT_COMPAT, 'utf-8'); ?></span></th>
				 </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              <tr valign="baseline">
                <th nowrap align="right">1.Grup / Oran</th>
                <td colspan="2"><span id="spryselect1">
                  <select class="form-control" name="GRP_ID">
                    <option value="-1" <?php if (!(strcmp(-1, htmlentities($row_Butonlar['GRP_ID'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>>1.Grup Seçiniz</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], htmlentities($row_Butonlar['GRP_ID'], ENT_COMPAT, 'utf-8')))) {echo " selected=\"selected\"";}  ?> >
                    <?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?>
                    </option>
                    <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
                   
                  </select>
                <span class="selectInvalidMsg">Lütfen geçerli bir öğe seçin.</span><span class="selectRequiredMsg">Lütfen bir öğe seçin.</span></span></td>
                <td><input class="form-control" type="number" min="0" max="100" name="GRP1_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP1_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
				</tr>
                <tr valign="baseline">
                  <th nowrap align="right">2.Grup / Oran</th>
                  <td colspan="2"><select class="form-control" name="GRP_ID2">
                    <option value="0">2.Grup Seçiniz</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], $row_Butonlar['GRP_ID2']))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
                    <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
                  </select></td>
                  <td><input class="form-control" type="number" min="0" max="100"  name="GRP2_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP2_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
				  </tr>
                <tr valign="baseline">
                  <th nowrap align="right">3.Grup / Oran</th>
                  <td colspan="2"><select class="form-control" name="GRP_ID3">
                    <option value="0">3.Grup Seçiniz</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], htmlentities($row_Butonlar['GRP_ID3'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
                    <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
                  </select></td>
                  <td><input class="form-control" type="number" min="0" max="100" name="GRP3_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP3_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
				  </tr>
                <tr valign="baseline">
                  <th nowrap align="right">4.Grup / Oran</th>
                  <td colspan="2"><select class="form-control" name="GRP_ID4">
                    <option value="0">4.Grup Seçiniz</option>
                    <?php
do {  
?>
                    <option value="<?php echo $row_Grup['GRPID']?>"<?php if (!(strcmp($row_Grup['GRPID'], htmlentities($row_Butonlar['GRP_ID4'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
                    <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
                  </select></td>
                  <td><input class="form-control" type="number" min="0" max="100" name="GRP4_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP4_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
				  </tr>
                <tr valign="baseline">
                  <th nowrap align="right" valign="top">Açıklama:</th>
                  <td colspan="3"><textarea class="form-control" name="ACIKLAMA" cols="50" rows="5"><?php echo htmlentities($row_Butonlar['ACIKLAMA'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                </tr>
              <tr valign="baseline">
                <th nowrap align="right">Bilet kopya Sayısı:</th>
                <td><input type="number" min="1" max="10" class="form-control" name="BILET_KOPYA" value="<?php echo htmlentities($row_Butonlar['BILET_KOPYA'], ENT_COMPAT, 'utf-8'); ?>"></td>
                <th align="right" nowrap>YUKSEKLIK:</th>
                <td><input type="number" min="10" max="1000" class="form-control" name="YUKSEKLIK" value="<?php echo htmlentities($row_Butonlar['YUKSEKLIK'], ENT_COMPAT, 'utf-8'); ?>" ></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Maksimum Bilet:</th>
                <td><input type="number" min="1" max="9999" class="form-control" name="MAKS_BILET" value="<?php echo htmlentities($row_Butonlar['MAKS_BILET'], ENT_COMPAT, 'utf-8'); ?>" ></td>
                <th align="right" nowrap>GENISLIK:</th>
                <td><input type="number" min="10" max="1000" class="form-control" name="GENISLIK" value="<?php echo htmlentities($row_Butonlar['GENISLIK'], ENT_COMPAT, 'utf-8'); ?>" ></td>
              </tr>
              <tr valign="baseline">
                <th align="right" nowrap>Soldan Konum:</th>
                <td><input type="number" min="5" max="1000" class="form-control" name="I_YF1" value="<?php echo htmlentities($row_Butonlar['I_YF1'], ENT_COMPAT, 'utf-8'); ?>" ></td>
                <th align="right" nowrap>Yukarıdan Konum</th>
                <td><input type="number" min="5" max="2000" class="form-control" name="I_YF2" value="<?php echo htmlentities($row_Butonlar['I_YF2'], ENT_COMPAT, 'utf-8'); ?>"></td>
              </tr>
              <tr valign="baseline">
                <th align="right" nowrap>AKTIF:</th>
                <td><label class="switch"><input type="checkbox" name="AKTIF" value=""  <?php if (!(strcmp(htmlentities($row_Butonlar['AKTIF'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
                <th align="right" nowrap>Randevu Butonu var mı?:</th>
                <td><label class="switch">
                  <input type="checkbox" name="RandevuButonuMu" value=""  <?php if (!(strcmp(htmlentities($row_Butonlar['RandevuButonuMu'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>>
               <span class="slider round"></span></label></td>
              </tr>
              <tr valign="baseline">
                <th align="right" nowrap>&nbsp;</th>
                <td colspan="3">
								<?php 
	  $img=base64_encode($row_Butonlar['RESIM']);	
	 
	    	    ?>
                  <img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/></td>
                </tr>
</table>      
</div>
</div>
<div class="col-md-6">
<div class="panel body table-responsive">
         <table id="tableID" class="table table-hover">
              <tr valign="baseline">
                <th nowrap align="right">Buton Ekran Metni:</th>
                <td><textarea class="form-control" name="BTN_EKRAN" cols="50" rows="5"><?php echo htmlentities($row_Butonlar['BTN_EKRAN'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
			  </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 1:</th>
                <td><input class="form-control" type="text" name="BTN_BILET_S1" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 2:</th>
                <td><input class="form-control" type="text" name="BTN_BILET_S2" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 3:</th>
                <td><input class="form-control" type="text" name="BTN_BILET_S3" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 4:</th>
                <td><input class="form-control" type="text" name="BTN_BILET_S4" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S4'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Rengi:</th>
                <td>
                <input class="jscolor form-control"  type="text" name="RENK" value="<?php echo substr(dechex($row_Butonlar['RENK']),2,6); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Yazı Rengi:</th>
                <td><input class="jscolor form-control" type="text" name="YAZI_RENGI" value="<?php echo dechex($row_Butonlar['YAZI_RENGI']); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Yazı Tipi(Font)</th>
                <td><select class="form-control" name="FONT">
                  <?php
do {  
?>
                  <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
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
              <tr valign="baseline">
                <th nowrap align="right">Yazı Boyutu(Punto)</th>
                <td><input class="form-control" type="number" name="PUNTO" min="10" max="120" value="<?php echo htmlentities($row_Butonlar['PUNTO'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Resim Eklensin mi?</th>
                <td><label class="switch">
                  <input class="form-control" type="checkbox" id="checkboxID">
                  <span class="slider round"></span></label></td>
              </tr>
              <tr class="rowClass" valign="baseline">
                <th nowrap align="right">Resim Seçin:</th>
                <td><input type="file" name="RESIM"></td>
              </tr>
              <tr class="rowClass" valign="baseline">
                <th nowrap align="right">Resim Hizalama Yönü</th>
                <td valign="baseline"><table class="table table-bordered table-hover">
                  <tr>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="1" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="2" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="4" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),4))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                    </tr>
                    <tr>
                      <td>Üst Sol</td>
                      <td>Üst Orta</td>
                      <td>Üst Sağ</td>
                    </tr>
                    <tr>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="16" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),16))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="32" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),32))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="64" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),64))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                    </tr>
                    <tr>
                      <td>Orta Sol</td>
                      <td>Tam Orta</td>
                      <td>Orta Sağ</td>
                    </tr>
                    <tr>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="256" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),256))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="512" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),512))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input type="radio" name="RESIM_YON" value="1024" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1024))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                    </tr>
                    <tr>
                      <td>Alt Sol</td>
                      <td>Alt Orta</td>
                      <td>Alt Sağ</td>
                    </tr>
                </table></td>
              </tr>
              <tr valign="baseline">
                <td colspan="2" align="right" nowrap><input type="hidden" name="RESIM_AD" value="<?php echo htmlentities($row_Butonlar['RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32">
                  <input type="hidden" name="ESKI_RESIM_AD" value="<?php echo htmlentities($row_Butonlar['ESKI_RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32">                  
                  <input type="hidden" name="S_YF1" value="<?php echo htmlentities($row_Butonlar['S_YF1'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="S_YF2" value="<?php echo htmlentities($row_Butonlar['S_YF2'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="S_YF3" value="<?php echo htmlentities($row_Butonlar['S_YF3'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="I_YF3" value="<?php echo htmlentities($row_Butonlar['I_YF3'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="B_YF" value="<?php echo htmlentities($row_Butonlar['B_YF'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="MM_update" value="form1">
                  <input type="hidden" name="BM_ADRES_TEMP" value="<?php echo $row_Butonlar['BM_ADRES']; ?>">
                  <input class="btn btn-info form-control" type="submit" value="Kaydı Güncelleştir">
                  <input type="hidden" name="BTNID_TEMP" value="<?php echo $row_Butonlar['BTNID']; ?>"></td>
              </tr>
</table>
</div>
</div>

</div>
</div>
    </div>
</form>
<script type="text/javascript">
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {validateOn:["blur", "change"], invalidValue:"-1"});
</script>
</body>
</html>
<?php
mysql_free_result($BiletMakinesi);

mysql_free_result($Grup);

mysql_free_result($Butonlar);

mysql_free_result($Fontlar);

mysql_free_result($AnaButonlar);
?>
<script>	
//<![CDATA[
$(window).load(function(){
$("#checkboxID").change(function(){
    var self = this;
    $("#tableID tr.rowClass").toggle(self.checked); 
}).change();
});//]]> 
      </script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->