<?php
// *** Redirect if TID ve GRPID exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?TerminalGrupEkle&Thata=ok&TID=".$_POST['TID']."&GRPID=".$_POST['GRPID'];
  $TIDcift = $_POST['TID'];
  $GRPIDcift = $_POST['GRPID'];
  $LoginRS__query = $db->query("SELECT TID FROM TERMINAL_GRUP WHERE TID='$TIDcift' AND GRPID='$GRPIDcift'")->fetch();
  
  $loginFoundUser = $LoginRS__query['TID'];

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser>0){
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

$row_terminal_grup = $db->query("SELECT COUNT(TID) AS TID FROM TERMINAL_GRUP WHERE TID='$terminalid_terminal_grup'")->fetch();

$totalRows_terminal_grup = count($row_terminal_grup);
if ($totalRows_terminal_grup > 0) { 
	$_ONCELIK+=$row_terminal_grup['TID'];
 }
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formTerminalGrup")) {
  $insertSQL = $db->prepare("INSERT INTO TERMINAL_GRUP
  (TID, GRPID, CAGRI_ORAN, TRANSFER_ORAN, YARDIM_GRUBU, CAGRILAN, 
  TRANSFER_CAGRILAN, ONCELIK, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, AYRICALIKLI) 
  VALUES (:TID, :GRPID, :CAGRI_ORAN, :TRANSFER_ORAN, :YARDIM_GRUBU, :CAGRILAN, 
  :TRANSFER_CAGRILAN, :ONCELIK, :S_YF1, :S_YF2, :S_YF3, :I_YF1, :I_YF2, :I_YF3, :B_YF, :AYRICALIKLI)");
               // $insertSQL->bindParam(':TGID', $_POST['TGID']);
                $insertSQL->bindParam(':TID', $_POST['TID']);
                $insertSQL->bindParam(':GRPID', $_POST['GRPID']);
                $insertSQL->bindParam(':CAGRI_ORAN', $_POST['CAGRI_ORAN']);
                $insertSQL->bindParam(':TRANSFER_ORAN', $_POST['TRANSFER_ORAN']);
                 $insertSQL->bindParam(':YARDIM_GRUBU', $YARDIM_GRUBU);
 if($_POST['YARDIM_GRUBU']=="on"){ $YARDIM_GRUBU=true;}else{ $YARDIM_GRUBU=false;}
				$insertSQL->bindParam(':CAGRILAN', $_POST['CAGRILAN']);
				$insertSQL->bindParam(':TRANSFER_CAGRILAN', $_POST['TRANSFER_CAGRILAN']);
				$insertSQL->bindParam(':ONCELIK', $_ONCELIK);
				$insertSQL->bindParam(':S_YF1', $_POST['S_YF1']);
				$insertSQL->bindParam(':S_YF2', $_POST['S_YF2']);
				$insertSQL->bindParam(':S_YF3', $_POST['S_YF3']);
				$insertSQL->bindParam(':I_YF1', $_POST['I_YF1']);
				$insertSQL->bindParam(':I_YF2', $_POST['I_YF2']);
				$insertSQL->bindParam(':I_YF3', $_POST['I_YF3']);
				$insertSQL->bindParam(':B_YF', $_POST['B_YF']);
				$insertSQL->bindParam(':AYRICALIKLI', $AYRICALIKLI);
 if($_POST['AYRICALIKLI']=="on"){ $AYRICALIKLI=true;}else{ $AYRICALIKLI=false;}
                

				$insertSQL->execute();

  $insertGoTo = "?TerminalEkle&TGrup=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));

}

$query_grup = "SELECT GRPID, GRUP_ISMI FROM GRUPLAR";
$grup = $db->query($query_grup,PDO::FETCH_ASSOC);
$row_grup =$grup; 
$totalRows_grup = count($grup);

$query_terminal = "SELECT TID, TERMINAL_AD FROM TERMINALLER";
$terminal = $db->query($query_terminal, PDO::FETCH_ASSOC);
$row_terminal = $terminal;
$totalRows_terminal = count($terminal);


?>
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
foreach($row_terminal as $row_terminal) {  
?>
        <option value="<?php echo $row_terminal['TID']?>" ><?php echo $row_terminal['TERMINAL_AD']?></option>
        <?php
}
?>
      </select></td>
    <tr valign="baseline">
      <td nowrap align="right">GRUP ADI:</td>
      <td><select class="form-control" name="GRPID">
        <?php 
foreach($row_grup as $row_grup) { 
?>
        <option value="<?php echo $row_grup['GRPID']?>" ><?php echo "#".$row_grup['GRPID']."-".$row_grup['GRUP_ISMI']?></option>
        <?php
}
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
      <input type="checkbox" name="YARDIM_GRUBU" value="" >
      <span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AYRICALIKLI:</td>
      <td> <label class="switch"><input type="checkbox" name="AYRICALIKLI" value="">
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
