<?php 
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = $db->prepare("UPDATE TERMINAL_GRUP 
  SET TID=:TID, GRPID=:GRPID, CAGRI_ORAN=:CAGRI_ORAN, TRANSFER_ORAN=:TRANSFER_ORAN, 
  YARDIM_GRUBU=:YARDIM_GRUBU, CAGRILAN=:CAGRILAN, TRANSFER_CAGRILAN=:TRANSFER_CAGRILAN, 
  ONCELIK=:ONCELIK, S_YF1=:S_YF1, S_YF2=:S_YF2, S_YF3=:S_YF3, I_YF1=:I_YF1, I_YF2=:I_YF2, 
  I_YF3=:I_YF3, B_YF=:B_YF, AYRICALIKLI=:AYRICALIKLI WHERE TGID=:TGID");
                       $updateSQL->bindParam(':TID', $_POST['TID']);
                       $updateSQL->bindParam(':GRPID', $_POST['GRPID']);
                       $updateSQL->bindParam(':CAGRI_ORAN', $_POST['CAGRI_ORAN']);
                       $updateSQL->bindParam(':TRANSFER_ORAN', $_POST['TRANSFER_ORAN']);
                       $updateSQL->bindParam(':YARDIM_GRUBU', $YARDIM_GRUBU);
			if($_POST['YARDIM_GRUBU']=="on"){ $YARDIM_GRUBU=true;}else{ $YARDIM_GRUBU=false;}
                       $updateSQL->bindParam(':CAGRILAN', $_POST['CAGRILAN']);
                       $updateSQL->bindParam(':TRANSFER_CAGRILAN', $_POST['TRANSFER_CAGRILAN']);
                       $updateSQL->bindParam(':ONCELIK', $_POST['ONCELIK']);
                       $updateSQL->bindParam(':S_YF1', $_POST['S_YF1']);
                       $updateSQL->bindParam(':S_YF2', $_POST['S_YF2']);
                       $updateSQL->bindParam(':S_YF3', $_POST['S_YF3']);
                       $updateSQL->bindParam(':I_YF1', $_POST['I_YF1']);
                       $updateSQL->bindParam(':I_YF2', $_POST['I_YF2']);
                       $updateSQL->bindParam(':I_YF3', $_POST['I_YF3']);
                       $updateSQL->bindParam(':B_YF', $_POST['B_YF']);
                       $updateSQL->bindParam(':AYRICALIKLI', $AYRICALIKLI);
            if($_POST['AYRICALIKLI']=="on"){ $AYRICALIKLI=true;}else{ $AYRICALIKLI=false;}
                       $updateSQL->bindParam(':TGID', $_POST['TGID']);
					$updateSQL->execute();


  $updateGoTo = "?TerminalGrupListele=".$_POST["TID"]."&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$row_gruplar = $db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR")->fetchAll();

$row_terminaller = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER")->fetchAll();

$colname_terminal_grup = "-1";
if (isset($_GET['TerminalGrupGuncelle'])) {
  $colname_terminal_grup = $_GET['TerminalGrupGuncelle'];
}

$row_terminal_grup = $db->query("SELECT * FROM TERMINAL_GRUP WHERE TGID = '$colname_terminal_grup'")->fetch();

?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">Terminal/GRUP Güncelleme Paneli </div>
  <div class="panel body table-responsive">
  <table class="table table-hover table-bordered" align="center">
    <tr valign="baseline">
      <td nowrap align="right">Terminal ADI:</td>
      <td>
      <?php
      $row_terminaller = $db->query("SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = '$row_terminal_grup[TID]'")->fetch();


	   ?>
      <input name="TID" type="hidden" id="TID" value="<?php echo $row_terminal_grup['TID']; ?>">  
       <strong><?php echo $row_terminaller["TERMINAL_AD"]; ?></strong>
     
                    
      </td>
    <tr valign="baseline">
      <td nowrap align="right">GRUP ADI:</td>
      <td><select class="form-control" name="GRPID">
        <?php 
foreach($row_gruplar as $row_gruplar){
?>
        <option value="<?php echo $row_gruplar['GRPID']?>" <?php if (!(strcmp($row_gruplar['GRPID'], htmlentities($row_terminal_grup['GRPID'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo "#".$row_gruplar['GRPID']."-". $row_gruplar['GRUP_ISMI']?></option>
        <?php
} 
?>
      </select></td>
    <tr valign="baseline">
      <td nowrap align="right">ÇAĞRI ORANI:</td>
      <td><input class="form-control" type="number" min="1"  max="100" name="CAGRI_ORAN" value="<?php echo htmlentities($row_terminal_grup['CAGRI_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TRANSFER ORANI:</td>
      <td><input class="form-control" type="number" min="1"  max="100" name="TRANSFER_ORAN" value="<?php echo htmlentities($row_terminal_grup['TRANSFER_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">YARDIM GRUBU:</td>
      <td><label class="switch"><input type="checkbox" name="YARDIM_GRUBU" <?php if (!(strcmp(htmlentities($row_terminal_grup['YARDIM_GRUBU'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">ÖNCELIK:</td>
      <td><input class="form-control" type="number" min="1"  max="100" name="ONCELIK" value="<?php echo htmlentities($row_terminal_grup['ONCELIK'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">AYRICALIKLI:</td>
      <td><label class="switch"><input type="checkbox" name="AYRICALIKLI" <?php if (!(strcmp(htmlentities($row_terminal_grup['AYRICALIKLI'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><input type="hidden" name="CAGRILAN" value="<?php echo htmlentities($row_terminal_grup['CAGRILAN'], ENT_COMPAT, 'utf-8'); ?>" size="32">        <input type="hidden" name="TRANSFER_CAGRILAN" value="<?php echo htmlentities($row_terminal_grup['TRANSFER_CAGRILAN'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
      <td><input class="form-control btn btn-primary" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="TGID" value="<?php echo $row_terminal_grup['TGID']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="TGID" value="<?php echo $row_terminal_grup['TGID']; ?>">
</form>
<p>&nbsp;</p>