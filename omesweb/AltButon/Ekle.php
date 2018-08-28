<?php //require_once('../Connections/baglantim.php'); ?>
<?php
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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?AltButonEkle&hata=Bid";
  $BTNID = $_POST['BTNID'];
  $BM_ADRES = $_POST['BM_ADRES'];
  $LoginRS__query = sprintf("SELECT BTNID FROM butonlar WHERE BTNID=%s AND BM_ADRES=%s", GetSQLValueString($BTNID, "int"),
  GetSQLValueString($BM_ADRES, "int")
  );
  mysql_select_db($database_baglantim, $baglantim);
  $LoginRS=mysql_query($LoginRS__query, $baglantim) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."ButonID=".$BTNID;
    header ("Location: $MM_dupKeyRedirect");
    exit;
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
		//direk bos arkaplan ekle ki kiosk prog çatlamasın
	$Resim="img/bos.png";	
	}
	mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi =sprintf("SELECT BTNID FROM Butonlar WHERE BM_ADRES = %s",GetSQLValueString($_POST['BM_ADRES'], "int"));
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);
	//$row_BiletMakinesi['BTNID'] alt buton olarak ANA_BTNID idi alanına eklenecek
	
	
	
  $insertSQL = sprintf("INSERT INTO butonlar (BM_ADRES, BTNID, GRP_ID, ANA_BTNID, BTN_EKRAN, BTN_BILET_S1, BTN_BILET_S2, BTN_BILET_S3, BTN_BILET_S4, MAKS_BILET, BILET_KOPYA, YUKSEKLIK, GENISLIK, RENK, YAZI_RENGI, RESIM, RESIM_YON, RESIM_AD, ESKI_RESIM_AD, ACIKLAMA, AKTIF, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, RandevuButonuMu, GRP_ID2, GRP1_ORAN, GRP2_ORAN, GRP_ID3, GRP3_ORAN, GRP_ID4, GRP4_ORAN, FONT, PUNTO) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['BM_ADRES'], "int"),
                       GetSQLValueString($_POST['BTNID'], "int"),
                       GetSQLValueString($_POST['GRP_ID'], "int"),
                       GetSQLValueString($row_BiletMakinesi['BTNID'], "int"),
                       GetSQLValueString($_POST['BTN_EKRAN'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S1'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S2'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S3'], "text"),
                       GetSQLValueString($_POST['BTN_BILET_S4'], "text"),
                       GetSQLValueString($_POST['MAKS_BILET'], "int"),
                       GetSQLValueString($_POST['BILET_KOPYA'], "int"),
                       GetSQLValueString($_POST['YUKSEKLIK'], "int"),
                       GetSQLValueString($_POST['GENISLIK'], "int"),
                       GetSQLValueString(hexdec($_POST['RENK']), "int"),
                       GetSQLValueString(hexdec($_POST['YAZI_RENGI']), "int"),
                       GetSQLValueString(file_get_contents($Resim), "text"),
                       GetSQLValueString($_POST['RESIM_YON'], "int"),
                       GetSQLValueString($_POST['RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ESKI_RESIM_AD'], "text"),
                       GetSQLValueString($_POST['ACIKLAMA'], "text"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString(isset($_POST['RandevuButonuMu']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['GRP_ID2'], "int"),
                       GetSQLValueString($_POST['GRP1_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP2_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID3'], "int"),
                       GetSQLValueString($_POST['GRP3_ORAN'], "int"),
                       GetSQLValueString($_POST['GRP_ID4'], "int"),
                       GetSQLValueString($_POST['GRP4_ORAN'], "int"),
                       GetSQLValueString($_POST['FONT'], "text"),
                       GetSQLValueString($_POST['PUNTO'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?AltButonEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi = "SELECT BTNID, BM_ADRES, BTN_EKRAN FROM Butonlar WHERE ANA_BTNID = 0 ORDER BY BTNID DESC";
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);

mysql_select_db($database_baglantim, $baglantim);
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);

mysql_select_db($database_baglantim, $baglantim);
$query_Fontlar = "SELECT * FROM fontlar";
$Fontlar = mysql_query($query_Fontlar, $baglantim) or die(mysql_error());
$row_Fontlar = mysql_fetch_assoc($Fontlar);
$totalRows_Fontlar = mysql_num_rows($Fontlar);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<!-- Jquery ile fadein fadeout için -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["hata"]) and $_GET["hata"]=="Bid" and !(isset($_GET["AltButonEkle"]) and $_GET["AltButonEkle"]=="ok"))
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
   // $("#hata").click(function(){
        $("#hata").fadeOut(6000);       
   // }); eğer açıklama satırları kaldırılsa tıklanmaya göre çalışır
});
</script><!-- Jquery ile fadein fadeout için -->
    <div id="hata" class="alert alert-danger">Seçtiğiniz Ana Buton için kayıtlı bir Buton ID <span class="btn btn-red">(<?php echo $_GET["ButonID"]; ?>)</span> mevcuttur. Lütfen Başka Bir Buton ID'si seçiniz. </div>
<?php
}
?><?php if(isset($_GET["AltButonEkle"]) and $_GET["AltButonEkle"]=="ok" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(6000);
});<!-- Jquery ile fadein fadeout için -->
</script>
    <div id="eklendi" class="btn btn-success">Alt Buton Eklendi. Görüntülemek için <a class="btn btn-red" href="?AltButonListele">Tıklayabilirisiniz.</a> Veya başka Bir Buton Ekleyebilirsiniz. </div>
<?php
}
?>
<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-pink">
  <div class="panel panel-heading">Alt Buton Ekleme Ekranı</div>
  
  <div class="row">
<div class="col-md-6">
<div class="panel body table-responsive">
<table class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right">ANA BUTON:</th>
      <td colspan="2"><span id="spryselect1">
        <select class="form-control btn btn-pink" name="BM_ADRES" >
        <option value="-1" selected>Ana Buton Seçiniz</option>
          <?php 
do {  
?>
          <option value="<?php echo $row_BiletMakinesi['BM_ADRES']?>" ><?php echo "#".$row_BiletMakinesi['BTNID']."-".$row_BiletMakinesi['BTN_EKRAN']?></option>
          <?php
} while ($row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi));
?>
        </select>
        <span class="selectInvalidMsg">Lütfen geçerli bir öğe seçin.</span><span class="selectRequiredMsg">Lütfen bir öğe seçin.</span></span></td>
      
      <th>Alt Buton ID        <input name="BTNID" type="number" class="form-control" max="1000" min="1" value="1" size="5"></th>
	  </tr>
      <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">1.Grup / Oran</th>
      <td colspan="2"><span id="spryselect2">
        <select class="form-control" name="GRP_ID">
          <option value="-1" selected>1.Grup Seçiniz</option>
          <?php
do {  
?>
          <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
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
      <td><input class="form-control" type="number" min="0" max="100" name="GRP1_ORAN" value="100" size="5"></td>
	</tr>
    <tr valign="baseline">
      <th nowrap align="right">2.Grup / Oran</th>
      <td colspan="2"><select class="form-control" name="GRP_ID2">
        <option value="0">2.Grup Seçiniz</option>
        <?php
do {  
?>
        <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
        <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
      </select></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP2_ORAN" value="0" size="5"></td>
	</tr>
    <tr valign="baseline">
      <th nowrap align="right">3.Grup / Oran</th>
      <td colspan="2"><select class="form-control" name="GRP_ID3">
        <option value="0">3.Grup Seçiniz</option>
        <?php
do {  
?>
        <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
        <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
      </select></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP3_ORAN" value="0" size="5"></td>
	</tr>
    <tr valign="baseline">
      <th nowrap align="right">4.Grup / Oran</th>
      <td colspan="2"><select class="form-control" name="GRP_ID4">
        <option value="0">3.Grup Seçiniz</option>
        <?php
do {  
?>
        <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
        <?php
} while ($row_Grup = mysql_fetch_assoc($Grup));
  $rows = mysql_num_rows($Grup);
  if($rows > 0) {
      mysql_data_seek($Grup, 0);
	  $row_Grup = mysql_fetch_assoc($Grup);
  }
?>
      </select></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP4_ORAN" value="0" size="5"></td>
	</tr>
    <tr valign="baseline">
      <th nowrap align="right" valign="top">Açıklama:</th>
      <td colspan="3"><span id="sprytextarea2">
      <textarea class="form-control" name="ACIKLAMA" cols="50" rows="5"></textarea>
      <span id="countsprytextarea2">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Bilet Kopya Sayısı:</th>
      <td><input type="number" min="1" max="10" name="BILET_KOPYA" value="1" class="form-control"></td>
      <th align="right" nowrap>YUKSEKLIK:</th>
      <td><input type="number" min="10" max="1000" name="YUKSEKLIK" value="100" class="form-control"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Maksimum Bilet:</th>
      <td><input type="number" min="1" max="9999" name="MAKS_BILET" value="5000" class="form-control"></td>
      <th align="right" nowrap>GENISLIK:</th>
      <td><input type="number" min="10" max="1000" name="GENISLIK" value="500" class="form-control"></td>
      </tr>
    <tr valign="baseline">
      <th align="right" nowrap>Soldan Konum:</th>
      <td><input type="number" min="5" max="1000" name="I_YF1" value="100" class="form-control"></td>
      <th align="right" nowrap>Yukarıdan Konum</th>
      <td><input type="number" min="5" max="2000" name="I_YF2" value="100" class="form-control"></td>
      </tr>
    <tr valign="baseline">
      <th align="right" nowrap>AKTIF:</th>
      <td><label class="switch">
        <input type="checkbox" name="AKTIF" value="" checked>
        <span class="slider round"></span></label></td>
      <th align="right" nowrap>Randevu Butonu var mı?:</th>
      <td><label class="switch">
        <input type="checkbox" name="RandevuButonuMu" value="" >
        <span class="slider round"></span></label></td>
      </tr>
    </table>
</div>
</div>
<div class="col-md-6">
<div class="panel body table-responsive">
  <table id="tableID" class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right">Buton Ekran Metni:</th>
      <td><span id="sprytextarea1">
      <textarea class="form-control" name="BTN_EKRAN" cols="50" rows="5"></textarea>
      <span id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı(250) aşıldı.</span></span></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 1:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S1" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 2:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S2" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 3:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S3" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 4:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S4" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Rengi:</th>
      <td><input class="jscolor form-control" type="text" name="RENK" value="" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Yazı Rengi:</th>
      <td><input class="jscolor form-control" type="text" name="YAZI_RENGI" value="" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Yazı Tipi(Font)</th>
      <td>
      <select class="form-control" name="FONT">
        <?php
do {  
?>
        <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"><?php echo $row_Fontlar['FONT']?></option>
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
      <td><input class="form-control" type="number" name="PUNTO" value="25" min="1" max="120"></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Resim Eklensin mi?</th>
      <td><label class="switch"><input class="form-control" type="checkbox" id="checkboxID"><span class="slider round"></span>  </label></td>
    </tr>
    <tr class="rowClass" valign="baseline">
      <th nowrap align="right">Resim Seçin:</th>
      <td><input type="file" name="RESIM">
     </td>
      </tr>
    <tr class="rowClass" valign="baseline">
      <th nowrap align="right">Resim Hizalama Yönü</th>
      <td valign="baseline">
      <table class="table table-bordered table-hover">
        <tr>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="1" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="2" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="4" ><span class="slider round"></span></label></td>
          </tr>
        <tr>
          <td>Üst Sol</td>
          <td>Üst Orta</td>
          <td> Üst Sağ</td>
          </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="16" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input name="RESIM_YON" type="radio" value="32" checked ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="64" ><span class="slider round"></span></label></td>
          </tr>
        <tr>
          <td>Orta Sol</td>
          <td>Tam
            Orta</td>
          <td>Orta Sağ</td>
          </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="256" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="512" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="1024" ><span class="slider round"></span></label></td>
          </tr>
        <tr>
          <td>Alt Sol</td>
          <td> Alt Orta</td>
          <td> Alt Sağ</td>
          </tr>
      </table></td>
      </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input class="form-control" type="hidden" name="RESIM_AD" value="<?php echo time(); ?>" size="32">
        <input class="form-control" type="hidden" name="ESKI_RESIM_AD" value="" size="32">
  <input type="hidden" name="B_YF" value="" size="32">
        <input type="hidden" name="I_YF3" value="" size="32">
        <input type="hidden" name="S_YF3" value="" size="32">
        <input type="hidden" name="S_YF2" value="" size="32">
        <input type="hidden" name="S_YF1" value="" size="32"></td>
      <td><input class="form-control btn btn-success" type="submit" value="Kayıt Ekle"></td>
    </tr>
  </table>
</div>
</div>
    
   </div>
   </div>   
  <input type="hidden" name="MM_insert" value="form1">
  <script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:250, counterId:"countsprytextarea1", counterType:"chars_remaining", hint:"Kioks Ekranında G\xF6r\xFCnecek Buton İ\xE7in Bir Metin Yazabilirsiniz.", isRequired:false});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1", validateOn:["blur", "change"]});
  </script>
</script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->
</div>
</form>
<script>
//<![CDATA[
$(window).load(function(){
$("#checkboxID").change(function(){
    var self = this;
    $("#tableID tr.rowClass").toggle(self.checked); 
}).change();
});//]]>
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {counterId:"countsprytextarea2", counterType:"chars_remaining", maxChars:250, hint:"Bir A\xE7ıklama Ekleyebilirsiniz.", isRequired:false, validateOn:["blur", "change"]});
</script>
</body>
</html>
<?php
mysql_free_result($BiletMakinesi);

mysql_free_result($Grup);
?>
