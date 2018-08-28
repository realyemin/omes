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

// *** Redirect if TID ve GRPID exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?TerminalGrupEkle&Thata=ok&TID=".$_POST['TID']."&GRPID=".$_POST['GRPID'];
  $TIDcift = $_POST['TID'];
  $GRPIDcift = $_POST['GRPID'];
  $LoginRS__query = sprintf("SELECT TID FROM terminal_grup WHERE TID=%s and GRPID=%s", GetSQLValueString($TIDcift, "int"), GetSQLValueString($GRPIDcift, "int"));
  mysql_select_db($database_baglantim, $baglantim);
  $LoginRS=mysql_query($LoginRS__query, $baglantim) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$TIDcift;
    header ("Location: $MM_dupKeyRedirect");
	
    exit;
  }
}

//eğer kayıt oluşturulurken Terminal Id yoksa oncelik 1'den
// başlayacak. Kayıt varsa 1 artarak devam edecek.
$_ONCELIK=1;
if(isset($_POST["TID"]) && isset($_POST["GRPID"]))
{
$terminalid_terminal_grup = $_POST["TID"];

//$grupid_terminal_grup = $_POST["GRPID"];
//and grpid=%s,GetSQLValueString($grupid_terminal_grup, "int") 
// bu ifadeler eğer hem Tid hem grpid tabloda aynı anda
// 1 tane olsun ve buna göre öncelik değeri alsın isteniyorsa eklenecek!! şimdilik elleme

mysql_select_db($database_baglantim, $baglantim);
$query_terminal_grup = sprintf("SELECT count(tid) FROM terminal_grup WHERE tid=%s", GetSQLValueString($terminalid_terminal_grup, "int"));
$terminal_grup = mysql_query($query_terminal_grup, $baglantim) or die(mysql_error());
$row_terminal_grup = mysql_fetch_assoc($terminal_grup);
$totalRows_terminal_grup = mysql_num_rows($terminal_grup);
if ($totalRows_terminal_grup > 0) { 
	$_ONCELIK+=$row_terminal_grup['count(tid)'];
 }
mysql_free_result($terminal_grup);
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formTerminalGrup")) {
  $insertSQL = sprintf("INSERT INTO terminal_grup (TGID, TID, GRPID, CAGRI_ORAN, TRANSFER_ORAN, YARDIM_GRUBU, CAGRILAN, TRANSFER_CAGRILAN, ONCELIK, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, AYRICALIKLI) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['TGID'], "int"),
                       GetSQLValueString($_POST['TID'], "int"),
                       GetSQLValueString($_POST['GRPID'], "int"),
                       GetSQLValueString($_POST['CAGRI_ORAN'], "int"),
                       GetSQLValueString($_POST['TRANSFER_ORAN'], "int"),
                       GetSQLValueString(isset($_POST['YARDIM_GRUBU']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['CAGRILAN'], "int"),
                       GetSQLValueString($_POST['TRANSFER_CAGRILAN'], "int"),
                       GetSQLValueString($_ONCELIK, "int"),
                       GetSQLValueString($_POST['S_YF1'], "text"),
                       GetSQLValueString($_POST['S_YF2'], "text"),
                       GetSQLValueString($_POST['S_YF3'], "text"),
                       GetSQLValueString($_POST['I_YF1'], "int"),
                       GetSQLValueString($_POST['I_YF2'], "int"),
                       GetSQLValueString($_POST['I_YF3'], "int"),
                       GetSQLValueString($_POST['B_YF'], "int"),
                       GetSQLValueString(isset($_POST['AYRICALIKLI']) ? "true" : "", "defined","1","0"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($insertSQL, $baglantim) or die(mysql_error());

  $insertGoTo = "?TerminalEkle&TGrup=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));

}

mysql_select_db($database_baglantim, $baglantim);
$query_grup = "SELECT GRPID, GRUP_ISMI FROM gruplar";
$grup = mysql_query($query_grup, $baglantim) or die(mysql_error());
$row_grup = mysql_fetch_assoc($grup);
$totalRows_grup = mysql_num_rows($grup);

mysql_select_db($database_baglantim, $baglantim);
$query_terminal = "SELECT TID, TERMINAL_AD FROM terminaller";
$terminal = mysql_query($query_terminal, $baglantim) or die(mysql_error());
$row_terminal = mysql_fetch_assoc($terminal);
$totalRows_terminal = mysql_num_rows($terminal);


?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
     
</head>

<body>
<?php
	if(isset($_GET["Thata"]) and $_GET["Thata"]=="ok" and empty($_GET["TGrup"]))
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
          <h4 class="modal-title alert alert-danger">Terminal Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>#<?php echo $_GET["TID"]; ?>. Terminal ve #<?php echo $_GET["GRPID"]; ?>.İlişkili Grup Tekrarı. Lütfen başka bir grup belirleyiniz.</strong></p>
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
<form method="post" name="formTerminalGrup" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">2-Terminal/GRUP Giriş Paneli</div><div class="panel body table-responsive">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right">Terminal ADI:</td>
      <td><select class="form-control" name="TID">
        <?php 
do {  
?>
        <option value="<?php echo $row_terminal['TID']?>" ><?php echo $row_terminal['TERMINAL_AD']?></option>
        <?php
} while ($row_terminal = mysql_fetch_assoc($terminal));
?>
      </select></td>
    <tr valign="baseline">
      <td nowrap align="right">GRUP ADI:</td>
      <td><select class="form-control" name="GRPID">
        <?php 
do {  
?>
        <option value="<?php echo $row_grup['GRPID']?>" ><?php echo "#".$row_grup['GRPID']."-".$row_grup['GRUP_ISMI']?></option>
        <?php
} while ($row_grup = mysql_fetch_assoc($grup));
?>
      </select></td>
    <tr valign="baseline">
      <td nowrap align="right">ÇAĞRI ORANI:</td>
      <td><input type="number"  min="1"  max="100" name="CAGRI_ORAN" value="1" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TRANSFER ORANI:</td>
      <td><input type="number" min="1" max="100" name="TRANSFER_ORAN" value="1" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">YARDIM GRUBU:</td>
      <td>
      <label class="switch">
      <input type="checkbox" name="YARDIM_GRUBU" >
      <span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AYRICALIKLI:</td>
      <td> <label class="switch"><input type="checkbox" name="AYRICALIKLI" >
      <span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="hidden" name="CAGRILAN" value="0" size="32">        <input type="hidden" name="TRANSFER_CAGRILAN" value="0" size="32"></td>
      <td><input class="form-control btn btn-info" type="submit" value="Terminal Grup Ekle"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="TGID" value="">
  <input type="hidden" name="MM_insert" value="formTerminalGrup">
</form>

</body>
</html>
<?php
mysql_free_result($grup);

mysql_free_result($terminal);


?>
