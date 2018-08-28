<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = $db->prepare("UPDATE BILET_MAKINELERI SET MAKINE_ADI=:MAKINE_ADI, MAKINE_TURU=:MAKINE_TURU WHERE MAKINE_ADRESI=:MAKINE_ADRESI");
                      $updateSQL->bindParam(':MAKINE_ADI',$_POST['MAKINE_ADI']);
                      $updateSQL->bindParam(':MAKINE_TURU',$_POST['MAKINE_TURU']);
                      $updateSQL->bindParam(':MAKINE_ADRESI',$_POST['MAKINE_ADRESI']);
			$updateSQL->execute();



  $updateGoTo = "?BiletMakinesiEkle&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_BiletMakinesi = "-1";
if (isset($_GET['BiletMakinesiGuncelle'])) {
  $colname_BiletMakinesi = $_GET['BiletMakinesiGuncelle'];
}

$row_BiletMakinesi = $db->query("SELECT MAKINE_ADRESI, MAKINE_ADI, MAKINE_TURU FROM BILET_MAKINELERI WHERE MAKINE_ADRESI = '$colname_BiletMakinesi'")->fetch();
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">Bilet Makinesi Güncelle </div>
  <div class="panel body table-responsive">
  <table class="table table-hover" align="center">
    <tr valign="baseline">
      <td nowrap align="right">MAKINE ADRESI:</td>
      <td><input class="form-control" type="text" name="MAKINE_ADI2" value="<?php echo htmlentities($row_BiletMakinesi['MAKINE_ADRESI'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MAKINE ADI:</td>
      <td><input class="form-control" type="text" name="MAKINE_ADI" value="<?php echo htmlentities($row_BiletMakinesi['MAKINE_ADI'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">MAKINE TÜRÜ:</td>
      <td valign="baseline"><table>
        <tr>
          <td><label class="switch"><input type="radio" name="MAKINE_TURU" value="1" <?php if (!(strcmp(htmlentities($row_BiletMakinesi['MAKINE_TURU'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label>
            Kiosk</td>
        </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="MAKINE_TURU" value="2" <?php if (!(strcmp(htmlentities($row_BiletMakinesi['MAKINE_TURU'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label>
            Buton</td>
        </tr>
      </table></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input class="form-control btn btn-info" type="submit" value="Kaydı Güncelleştir"></td>
    </tr>
  </table></div></div></div>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="MAKINE_ADRESI" value="<?php echo $row_BiletMakinesi['MAKINE_ADRESI']; ?>">
</form>
<p>&nbsp;</p>