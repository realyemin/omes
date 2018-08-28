<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
 $updateSQL = $db->prepare("UPDATE ANATABLOLAR SET TABLO_ADI=:TABLO_ADI, TABLO_TURU=:TABLO_TURU WHERE ATID=:ATID");
  
                       $updateSQL->bindParam(':TABLO_ADI',$_POST['TABLO_ADI'], PDO::PARAM_STR);
                       $updateSQL->bindParam(':TABLO_TURU',$_POST['TABLO_TURU'], PDO::PARAM_INT);
                       $updateSQL->bindParam(':ATID',$_POST['ATID'], PDO::PARAM_INT);
					                      
		$updateSQL->execute();


  $updateGoTo = "?AnaTabloListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_AnaTabloGuncelle = "-1";
if (isset($_GET['AnaTabloGuncelle'])) {
  $colname_AnaTabloGuncelle = $_GET['AnaTabloGuncelle'];
}

$row_AnaTabloGuncelle = $db->query("SELECT ATID, TABLO_ADI, TABLO_TURU FROM ANATABLOLAR WHERE ATID = '$colname_AnaTabloGuncelle'")->fetch();

?>

<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Güncelle</div>
  <div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right">Ana Tablo Adresi:</th>
      <td><strong><?php echo $row_AnaTabloGuncelle['ATID']; ?></strong></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">TABLO ADI:</th>
      <td><span id="sprytextfield1">
        <input class="form-control" name="TABLO_ADI" type="text" value="<?php echo htmlentities($row_AnaTabloGuncelle['TABLO_ADI'], ENT_COMPAT, 'utf-8'); ?>" size="32" maxlength="20">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">TABLO TURU:</th>
      <td><select class="form-control" name="TABLO_TURU">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_AnaTabloGuncelle['TABLO_TURU'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LCD Tablo</option>
        <option value="2" <?php if (!(strcmp(2, htmlentities($row_AnaTabloGuncelle['TABLO_TURU'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>LED Tablo</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="btn btn-info form-control" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="ATID" value="<?php echo $row_AnaTabloGuncelle['ATID']; ?>">
</form></div></div></div>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
</script>
