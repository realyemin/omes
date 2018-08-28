<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = $db->prepare("UPDATE ANATABLO_YON SET ATID=:ATID, TID=:TID, YON=:YON, Port=:Port WHERE YID=:YID");
                       
					$updateSQL->bindParam(':ATID',$_POST['ATID'],PDO::PARAM_INT);
					$updateSQL->bindParam(':TID',$_POST['TID'],PDO::PARAM_INT);
					$updateSQL->bindParam(':YON',$_POST['YON'],PDO::PARAM_INT);
					$updateSQL->bindParam(':Port',$_POST['Port'],PDO::PARAM_INT);
					$updateSQL->bindParam(':YID',$_POST['YID'],PDO::PARAM_INT);
					 
		$updateSQL->execute();
		
  $updateGoTo = "?AnaTabloYonListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}


$row_Terminal = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER")->fetchAll();

$row_AnaTablo = $db->query("SELECT ATID, TABLO_ADI FROM ANATABLOLAR")->fetchAll();

$colname_AnaTabloYon = "-1";
if (isset($_GET['AnaTabloYonGuncelle'])) {
  $colname_AnaTabloYon = $_GET['AnaTabloYonGuncelle'];
}
$row_AnaTabloYon = $db->query("SELECT YID, ATID, TID, YON, Port FROM anatablo_yon WHERE YID = '$colname_AnaTabloYon'")->fetch();

?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Yön Güncelle</div>
  <div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo Yön ID:</th>
      <td><strong><?php echo $row_AnaTabloYon['YID']; ?></strong></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo :</th>
      <td><select class="form-control" name="ATID">
        <?php 
foreach($row_AnaTablo as $row_AnaTablo) {  
?>
        <option value="<?php echo $row_AnaTablo['ATID']?>" <?php if (!(strcmp($row_AnaTablo['ATID'], htmlentities($row_AnaTabloYon['ATID'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_AnaTablo['TABLO_ADI']?></option>
        <?php
}
?>
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right">Terminal:</th>
      <td><select class="form-control" name="TID">
        <?php 
foreach($row_Terminal as $row_Terminal) { 
?>
        <option value="<?php echo $row_Terminal['TID']?>" <?php if (!(strcmp($row_Terminal['TID'], htmlentities($row_AnaTabloYon['TID'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_Terminal['TERMINAL_AD']?></option>
        <?php
}
?>
      </select></td></tr>
    <tr valign="baseline">
      <th nowrap align="right">YÖN:</th>
      <td><select class="form-control" name="YON">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Yukarı</option>
        <option value="2" <?php if (!(strcmp(2, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Aşağı</option>
        <option value="3" <?php if (!(strcmp(3, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Sağ</option>
        <option value="4" <?php if (!(strcmp(4, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Sol</option>
        <option value="5" <?php if (!(strcmp(5, htmlentities($row_AnaTabloYon['YON'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Kapalı</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Port:</th>
      <td><input class="form-control" type="number" min="0" name="Port" value="<?php echo htmlentities($row_AnaTabloYon['Port'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="form-control btn btn-info" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="YID" value="<?php echo $row_AnaTabloYon['YID']; ?>">
</form>
</div></div></div>