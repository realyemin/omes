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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE gruplar SET GRUP_ISMI=%s, BAS_NO=%s, BIT_NO=%s, DONGU=%s, MIN_HIZMET_SURESI=%s, MAX_HIZMET_SURESI=%s, AKTIF=%s, MESAI_BAS=%s, MESAI_BIT=%s, OGLE_BAS=%s, OGLE_BIT=%s, OGLEN_BILET_VER=%s, BILET_SINIRLA=%s, OO_MAX_BILET=%s, OS_MAX_BILET=%s, SIL=%s, S_YF1=%s, S_YF2=%s, S_YF3=%s, I_YF1=%s, I_YF2=%s, I_YF3=%s, B_YF=%s, BeklemeSuresiTipi=%s WHERE GRPID=%s",
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
                       GetSQLValueString($_POST['BeklemeSuresiTipi'], "int"),
                       GetSQLValueString($_POST['GRPID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($updateSQL, $baglantim) or die(mysql_error());

  $updateGoTo = "?GrupListele&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Guncelle = "-1";
if (isset($_GET['GrupGuncelle'])) {
  $colname_Guncelle = $_GET['GrupGuncelle'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_Guncelle = sprintf("SELECT * FROM gruplar WHERE GRPID = %s", GetSQLValueString($colname_Guncelle, "int"));
$Guncelle = mysql_query($query_Guncelle, $baglantim) or die(mysql_error());
$row_Guncelle = mysql_fetch_assoc($Guncelle);
$totalRows_Guncelle = mysql_num_rows($Guncelle);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
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
</head>

<body><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Grup Paneli Güncelleme Ekranı</div><div class="panel body table-responsive">
  <table class="table table-hover">
  <tr>
    <td width="362" valign="top">  
    <div class="panel panel-blue">
  <div class="panel panel-heading">Grup Bilgileri #<?php echo $row_Guncelle['GRPID']; ?></div>
  <div class="panel body table-responsive">
      <table class="table table-hover">
        <tr valign="baseline">
          <td valign="baseline" >GRUP ISMI:
            <input type="hidden" name="GRPID" value="" size="32"></td>
          <td valign="baseline"><span id="sprytextfield1">
            <input class="form-control" type="text" name="GRUP_ISMI" value="<?php echo htmlentities($row_Guncelle['GRUP_ISMI'], ENT_COMPAT, 'utf-8'); ?>" maxlength="25" size="32" placeholder="Grup Adını Yazınız">
            <span class="textfieldRequiredMsg">Grup Adı Boş geçilemez!.</span></span></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Başlangıç No:</td>
          <td valign="baseline"><input class="form-control" type="number" min="1" max="2147483647" name="BAS_NO"size="32" value="<?php echo htmlentities($row_Guncelle['BAS_NO'], ENT_COMPAT, 'utf-8'); ?>" placeholder="1"></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Bitiş No:</td>
          <td valign="baseline"><input class="form-control" type="number" min="1" max="2147483647" name="BIT_NO" value="<?php echo htmlentities($row_Guncelle['BIT_NO'], ENT_COMPAT, 'utf-8'); ?>" placeholder="1" size="32"></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Döngü:(Bitince Başa Dön)</td>
          <td align="left" valign="baseline"><label class="switch"><input name="DONGU" type="checkbox" class="form-control" <?php if($row_Guncelle['DONGU']==1){ echo "checked"; } ?> ><span class="slider round"></span></label></td>
          </tr>
        <tr valign="baseline">
          <td valign="baseline" >Aktif:</td>
          <td align="left" valign="baseline"><label class="switch"><input name="AKTIF" type="checkbox" <?php if($row_Guncelle['AKTIF']=='1'){ echo "checked"; } ?> ><span class="slider round"></span></label></td>
          </tr>        
      </table></div></div>
    </td>
  <td width="270" valign="top">
  <div class="panel panel-green">
  <div class="panel panel-heading">Hizmet Bilgileri</div>
  <div class="panel body table-responsive">
  	<table class="table table-hover">
    <tr valign="baseline">
      <td valign="baseline" >MIN. HIZMET SURESI:</td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" ><span id="sprytextfield2">
      <input class="form-control" type="text" name="MIN_HIZMET_SURESI" value="<?php echo htmlentities($row_Guncelle['MIN_HIZMET_SURESI'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" >MAX. HIZMET SURESI:</td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" ><span id="sprytextfield3">
      <input class="form-control" type="text" name="MAX_HIZMET_SURESI" value="<?php echo htmlentities($row_Guncelle['MAX_HIZMET_SURESI'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td class="alert alert-info"><strong>Ortalama Bekleme Süresi Yazdırma Şekli</strong></td>
    </tr>
      <tr valign="baseline">
      <td valign="baseline" ><table class="table table-responsive">
        <tr>
          <td><label class="switch"><input name="BeklemeSuresiTipi" type="radio" value="1" <?php if($row_Guncelle['BeklemeSuresiTipi']==1){ echo "checked"; } ?>><span class="slider round"></span></label></td>
          <td> Min.Hizmet Süresini Kullanın</td>
        </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="BeklemeSuresiTipi" value="2" <?php if($row_Guncelle['BeklemeSuresiTipi']==2){ echo "checked"; } ?>><span class="slider round"></span></label></td>
          <td>Otomatik Hesapla</td>
        </tr>
      </table></td>
      </tr>    
    </table></div></div>
    </td>    
    </tr>    
  <tr><td colspan="2">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Çalışma Saati Bilgileri</div><div class="panel body table-responsive">
  <table id="tableID" class="table table-hover">
  <tr valign="baseline">
      <td valign="baseline">Mesai Başlangıcı:</td>
      <td valign="baseline"><span id="sprytextfield4">
      <input class="form-control" type="text" name="MESAI_BAS" value="<?php echo htmlentities($row_Guncelle['MESAI_BAS'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td valign="baseline">Öğle Molası Başlangıcı:</td>
      <td valign="baseline"><span id="sprytextfield6">
      <input class="form-control" type="text" name="OGLE_BAS" value="<?php echo htmlentities($row_Guncelle['OGLE_BAS'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td valign="baseline">Mesai Bitiş:</td>
      <td valign="baseline"><span id="sprytextfield5">
      <input class="form-control" type="text" name="MESAI_BIT" value="<?php echo htmlentities($row_Guncelle['MESAI_BIT'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td valign="baseline">Öğle Molası Bitiş:</td>
      <td valign="baseline"><span id="sprytextfield7">
      <input class="form-control" type="text" name="OGLE_BIT" value="<?php echo htmlentities($row_Guncelle['OGLE_BIT'], ENT_COMPAT, 'utf-8'); ?>" size="32" placeholder="00:00:00 şeklinde">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td valign="baseline" >Bilet Sınırlaması Yapılsın mı?:</td>
      <td valign="baseline"><label class="switch"><input class="form-control" type="checkbox" name="BILET_SINIRLA" id="checkboxID" <?php if($row_Guncelle['BILET_SINIRLA']==1){ echo "checked"; } ?>><span class="slider round"></span></label>
      
      </td>
      <td valign="baseline">Öğle Tatilinde Bilet Verilsin mi?:</td>
      <td valign="baseline"><label class="switch"><input class="form-control" type="checkbox" name="OGLEN_BILET_VER" <?php if($row_Guncelle['OGLEN_BILET_VER']==1){ echo "checked"; } ?>><span class="slider round"></span></label></td>
    </tr>
    <tr class="rowClass" valign="baseline">
      <td colspan="4" class="alert alert-info" ><strong>Bilet Sınırlama Bilgileri</strong></td>
      </tr>
      
    <tr class="rowClass" valign="baseline">
      <td valign="baseline" >Öğleden Önce Max. Bilet Sayısı:</td>
      <td class="rowClass" valign="baseline"><input class="form-control" type="number" min="0" max="1000" name="OO_MAX_BILET" value="<?php echo htmlentities($row_Guncelle['OO_MAX_BILET'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      <td colspan="2" class="alert alert-success">Bilet sınırlaması, bir gruba öğleden önce ve<br>
öğleden sonra en fazla ne kadar bilet <br>
verileceğini belirler.</td>
      </tr>
    <tr class="rowClass" valign="baseline">
      <td valign="baseline" >Öğleden Sonra Max. Bilet Sayısı</td>
      <td valign="baseline"><input class="form-control" type="number" min="0" max="1000" name="OS_MAX_BILET" value="<?php echo htmlentities($row_Guncelle['OS_MAX_BILET'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      <td colspan="2" rowspan="2" class="aler alert-danger"><strong><p>Eğer herhangi bir sınırlama olmaksızın bilet <br>
verilmesini istiyorsanız <br>
&quot;Bilet Sınırlaması Yap&quot; kutucuğunun işaretini kaldırınız.</p></strong></td>
      </tr>
    <tr valign="baseline">
      <td colspan="2" valign="baseline" ><input class="form-control" type="hidden" name="SIL" value="0" size="32">
        <input class="form-control" type="hidden" name="S_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="B_YF" value="" size="32"></td>
      </tr>
    <tr valign="baseline">
      <td valign="baseline" >&nbsp;</td>
      <td valign="baseline"><input class="form-control btn btn-primary" type="submit" value="Kayıt Güncelleştir"></td>
      <td valign="baseline">&nbsp;</td>
      <td valign="baseline">&nbsp;</td>
    </tr>
  </table></div>
  </div></td></tr>
  </table>
   <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="GRPID" value="<?php echo $row_Guncelle['GRPID']; ?>">
 
  </div></div></div>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time", {format:"HH:mm:ss", useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {useCharacterMasking:true, format:"HH:mm:ss", validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
</script>
</body>
</html>
<?php
mysql_free_result($Guncelle);
?>
