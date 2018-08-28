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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?TerminalEkle&hata=".$_POST['ELTID']."&";
  $loginUsername = $_POST['ELTID'];
  $LoginRS__query = sprintf("SELECT ELTID FROM terminaller WHERE ELTID=%s", GetSQLValueString($loginUsername, "int"));
  mysql_select_db($database_baglantim, $baglantim);
  $LoginRS=mysql_query($LoginRS__query, $baglantim) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formTerminal")) {
  $insertSQL = sprintf("INSERT INTO terminaller (TID, ELTID, TERMINAL_AD, OTO_CAGRI, OTO_SURE, DURUM, AKTIF, AKTIF_BID, SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR, SIL, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, TerminalTipi, DoubleClick, SiralamaTipi, CagriSiralamaTipi) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['TID'], "int"),
                       GetSQLValueString($_POST['ELTID'], "int"),
                       GetSQLValueString($_POST['TERMINAL_AD'], "text"),
                       GetSQLValueString(isset($_POST['OTO_CAGRI']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['OTO_SURE'], "date"),
                       GetSQLValueString($_POST['DURUM'], "int"),
                       GetSQLValueString(isset($_POST['AKTIF']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['AKTIF_BID'], "int"),
                       GetSQLValueString($_POST['SON_CAGRILAN_GRUP'], "int"),
                       GetSQLValueString($_POST['SON_CAGRILAN_TUR'], "int"),
                       GetSQLValueString($_POST['SIL'], "int"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString($_POST['TerminalTipi'], "text"),
                       GetSQLValueString(isset($_POST['DoubleClick']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['SiralamaTipi'], "text"),
                       GetSQLValueString($_POST['CagriSiralamaTipi'], "text"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?TerminalEkle&Ekle=ok&";
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
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	if(isset($_GET["hata"]) and $_GET["hata"]!="")
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
          <h4 class="modal-title alert alert-danger">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>#<?php echo $_GET["hata"]; ?> nolu terminal daha önce kaydedilmiştir. Başka bir terminal kimliği belirleyiniz.</strong></p>
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
<form method="post" name="formTerminal" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">1-Terminal Paneli Giriş Ekranı</div><div class="panel body table-responsive">
  <table class="table table-hover">
    <tr valign="baseline">
      <td nowrap>EL Terminal ID:</td>
      <td><span id="sprytextfield1">
        <input class="form-control" type="number" name="ELTID" value="1" min="1" max="1000" size="32" placeholder="1">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TERMINAL ADI:</td>
      <td><span id="sprytextfield2"><input class="form-control" type="text" name="TERMINAL_AD" value="" size="32" maxlength="20" placeholder="Bir terminal adı yazınız">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. CAGRI:</td>
      <td>
      <label class="switch"><input class="form-control" type="checkbox" name="OTO_CAGRI" value="" ><span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. SURE:</td>
      <td><span id="sprytextfield3">
      <input class="form-control" type="text" name="OTO_SURE" value="00:00:00" size="32">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>AKTIF:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="AKTIF" value="" checked><span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Terminal Tipi:</td>
      <td><select class="form-control" name="TerminalTipi">
        <option value="Oda" <?php if (!(strcmp("Oda", ""))) {echo "SELECTED";} ?>>Oda</option>
        <option value="Poliklinik" <?php if (!(strcmp("Poliklinik", ""))) {echo "SELECTED";} ?>>Poliklinik</option>
        <option value="Masa" <?php if (!(strcmp("Masa", ""))) {echo "SELECTED";} ?>>Masa</option>
        <option value="Vezne" <?php if (!(strcmp("Vezne", ""))) {echo "SELECTED";} ?>>Vezne</option>
        <option value="Banko" <?php if (!(strcmp("Banko", ""))) {echo "SELECTED";} ?>>Banko</option>
        <option value="Ünite" <?php if (!(strcmp("Ünite", ""))) {echo "SELECTED";} ?>>Ünite</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>DoubleClick:</td>
      <td><label class="switch">
      <input class="form-control" type="checkbox" name="DoubleClick" value="" checked><span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Sıralama Tipi:</td>
      <td><select class="form-control" name="SiralamaTipi">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Alınma Sırası</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Bilet No</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Çağrı Siralama Tipi:</td>
      <td><select class="form-control" name="CagriSiralamaTipi">       
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Oran</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Kuyruk</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap><input type="hidden" name="SIL" value="0" size="32">
        <input type="hidden" name="DURUM" value="6"> 
        <input type="hidden" name="AKTIF_BID" value="0" size="32">
        <input type="hidden" name="SON_CAGRILAN_GRUP" value="0" size="32">
        <input type="hidden" name="SON_CAGRILAN_TUR" value="0" size="32">
        <input type="hidden" name="TID" value="" size="32"></td>
      <td><input class="form-control btn btn-success" type="submit" value="Yeni Terminal Ekle"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_insert" value="formTerminal">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
</script>
</body>
</html>