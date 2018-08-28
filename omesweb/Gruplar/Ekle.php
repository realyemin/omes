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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO gruplar (GRPID, GRUP_ISMI, BAS_NO, BIT_NO, DONGU, MIN_HIZMET_SURESI, MAX_HIZMET_SURESI, AKTIF, MESAI_BAS, MESAI_BIT, OGLE_BAS, OGLE_BIT, OGLEN_BILET_VER, BILET_SINIRLA, OO_MAX_BILET, OS_MAX_BILET, SIL, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, BeklemeSuresiTipi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['GRPID'], "int"),
                       GetSQLValueString($_POST['GRUP_ISMI'], "text"),
                       GetSQLValueString($_POST['BAS_NO'], "int"),
                       GetSQLValueString($_POST['BIT_NO'], "int"),
                       GetSQLValueString(isset($_POST['DONGU']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['MIN_HIZMET_SURESI'], "date"),
                       GetSQLValueString($_POST['MAX_HIZMET_SURESI'], "date"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['MESAI_BAS'], "date"),
                       GetSQLValueString($_POST['MESAI_BIT'], "date"),
                       GetSQLValueString($_POST['OGLE_BAS'], "date"),
                       GetSQLValueString($_POST['OGLE_BIT'], "date"),
                       GetSQLValueString(isset($_POST['OGLEN_BILET_VER']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['BILET_SINIRLA']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['OO_MAX_BILET'], "int"),
                       GetSQLValueString($_POST['OS_MAX_BILET'], "int"),
                       GetSQLValueString($_POST['SIL'], "int"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString($_POST['BeklemeSuresiTipi'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?GrupListele&GrupEkle=ok&";
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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Grup Paneli Giriş Ekranı</div><div class="panel body table-responsive">
  <table id="tableID" class="table table-hover">
  <tr>
    <td width="362" valign="top">  
    <div class="panel panel-blue">
  <div class="panel panel-heading">Grup Bilgileri</div>
  <div class="panel body table-responsive">
      <table class="table table-hover">
        <tr >
          <td  >GRUP ISMI:
            <input type="hidden" name="GRPID" value="" size="32"></td>
          <td ><span id="sprytextfield1">
            <input class="form-control" type="text" name="GRUP_ISMI" value="" maxlength="25" size="32" placeholder="Grup Adını Yazınız">
            <span class="textfieldRequiredMsg">Grup Adı Boş geçilemez!.</span></span></td>
          </tr>
        <tr >
          <td  >Başlangıç No:</td>
          <td ><input name="BAS_NO" type="number" class="form-control" id="sprytrigger1" placeholder="1" max="2147483647" min="1" value="1"size="32"></td>
          </tr>
        <tr >
          <td  >Bitiş No:</td>
          <td ><input name="BIT_NO" type="number" class="form-control" id="sprytrigger2" placeholder="1" max="2147483647" min="1" value="1" size="32"></td>
          </tr>
        <tr >
          <td  >Döngü:(Bitince Başa Dön)</td>
          <td align="left" ><label class="switch"><input name="DONGU" type="checkbox" checked><span class="slider round"></span>  </label></td>
          </tr>
        <tr >
          <td  >Aktif:</td>
          <td align="left" ><label class="switch"><input name="AKTIF" type="checkbox" checked><span class="slider round"></span>  </label></td>
          </tr>        
      </table></div></div>
    </td>
  <td width="270" valign="top">
  <div class="panel panel-green">
  <div class="panel panel-heading">Hizmet Bilgileri</div>
  <div class="panel body table-responsive">
  	<table class="table table-hover">
    <tr >
      <td  >MIN. HIZMET SURESI:</td>
      </tr>
    <tr >
      <td  ><span id="sprytextfield2">
      <input class="form-control" type="text" name="MIN_HIZMET_SURESI" value="00:00:20" size="32" placeholder="00:00:20">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      </tr>
    <tr >
      <td  >MAX. HIZMET SURESI:</td>
      </tr>
    <tr >
      <td  ><span id="sprytextfield3">
      <input class="form-control" type="text" name="MAX_HIZMET_SURESI" value="00:02:00" size="32" placeholder="00:02:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr >
      <td class="alert alert-info"><strong>Ortalama Bekleme Süresi Yazdırma Şekli</strong></td>
    </tr>
      <tr >
      <td  ><table class="table table-responsive">
        <tr>
          <td><label class="switch"><input type="radio" name="BeklemeSuresiTipi" value="1" class="form-control"><span class="slider round"></span>  </label></td>
          <td> Min.Hizmet Süresini Kullanın</td>
        </tr>
        <tr>
          <td><label class="switch"><input name="BeklemeSuresiTipi" type="radio" class="form-control" value="2" checked><span class="slider round"></span>  </label></td>
          <td>Otomatik Hesaplasın</td>
        </tr>
      </table></td>
      </tr>    
    </table></div></div>
    </td>    
    </tr>    
  <tr><td colspan="2">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Çalışma Saati Bilgileri</div><div class="panel body table-responsive">
  <table class="table table-hover">
  <tr >
      <td  >Mesai Başlangıcı:</td>
      <td ><span id="sprytextfield4">
      <input class="form-control" type="text" name="MESAI_BAS" value="07:00:00" size="32" placeholder="07:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td >Öğle Molası Başlangıcı:</td>
      <td ><span id="sprytextfield6">
      <input class="form-control" type="text" name="OGLE_BAS" value="12:00:00" size="32" placeholder="12:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr >
      <td  >Mesai Bitiş:</td>
      <td ><span id="sprytextfield5">
      <input class="form-control" type="text" name="MESAI_BIT" value="17:00:00" size="32" placeholder="17:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td >Öğle Molası Bitiş:</td>
      <td><span id="sprytextfield7">
      <input class="form-control" type="text" name="OGLE_BIT" value="13:00:00" size="32" placeholder="13:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr >
      <td  >Bilet Sınırlaması Yapılsın mı?:</td>
      <td ><label class="switch"><input type="checkbox" name="BILET_SINIRLA" id="checkboxID"><span class="slider round"></span>  </label></td>
      <td >Öğle Tatilinde Bilet Verilsin mi?:</td>
      <td ><label class="switch"><input type="checkbox" name="OGLEN_BILET_VER" checked><span class="slider round"></span>  </label></td>
    </tr>
    <tr class="rowClass" >
      <td colspan="4" class="alert alert-info" ><strong>Bilet Sınırlama Bilgileri</strong></td>
      </tr>
      
    <tr class="rowClass" >
      <td  >Öğleden Önce Max. Bilet Sayısı:</td>
      <td ><input class="form-control" type="number" min="0" max="1000" name="OO_MAX_BILET" value="0" size="32"></td>
      <td colspan="2" class="alert alert-success">Bilet sınırlaması, bir gruba öğleden önce ve<br>
öğleden sonra en fazla ne kadar bilet <br>
verileceğini belirler.</td>
      </tr>
    <tr class="rowClass" >
      <td  >Öğleden Sonra Max. Bilet Sayısı</td>
      <td ><input class="form-control" type="number" min="0" max="1000" name="OS_MAX_BILET" value="0" size="32"></td>
      <td colspan="2" rowspan="2" class="aler alert-danger"><strong><p>Eğer herhangi bir sınırlama olmaksızın bilet <br>
verilmesini istiyorsanız <br>
&quot;Bilet Sınırlaması Yap&quot; kutucuğunun işaretini kaldırınız.</p></strong></td>
      </tr>
    <tr >
      <td colspan="2"  ><input class="form-control" type="hidden" name="SIL" value="0" size="32">
        <input class="form-control" type="hidden" name="S_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="B_YF" value="" size="32"></td>
      </tr>
    <tr >
      <td  >&nbsp;</td>
      <td ><input class="form-control btn btn-success" type="submit" value="Kayıt Ekle"></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
  </table>
  </div></div>
  </td></tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
  </div></div></div>
</form>

<div class="tooltipContent" id="sprytooltip1"><span class="alert alert-danger">Numaratörden verilen Bilet Başlangıç numarasıdır</span></div>
<div class="tooltipContent" id="sprytooltip2"><span class="alert alert-danger">Numaratörden verilen Bilet Bitiş numarasıdır</span></div>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time", {format:"HH:mm:ss", useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {useCharacterMasking:true, format:"HH:mm:ss", validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1", {useEffect:"blind", followMouse:true, closeOnTooltipLeave:true});
var sprytooltip2 = new Spry.Widget.Tooltip("sprytooltip2", "#sprytrigger2", {closeOnTooltipLeave:true, followMouse:true, useEffect:"blind"});
</script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
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
</body>
</html>