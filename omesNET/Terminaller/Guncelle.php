<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = $db->prepare("UPDATE TERMINALLER 
  SET ELTID=:ELTID, TERMINAL_AD=:TERMINAL_AD, OTO_CAGRI=:OTO_CAGRI, 
  OTO_SURE=:OTO_SURE, DURUM=:DURUM, AKTIF=:AKTIF, AKTIF_BID=:AKTIF_BID, 
  SON_CAGRILAN_GRUP=:SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR=:SON_CAGRILAN_TUR, 
  TerminalTipi=:TerminalTipi, DoubleClick=:DoubleClick, SiralamaTipi=:SiralamaTipi, 
  CagriSiralamaTipi=:CagriSiralamaTipi WHERE TID=:TID");
                       $updateSQL->bindParam(':ELTID',$_POST['ELTID']);
                       $updateSQL->bindParam(':TERMINAL_AD',$_POST['TERMINAL_AD']);
                       $updateSQL->bindParam(':OTO_CAGRI',$OTO_CAGRI);
            if($_POST['OTO_CAGRI']=="on"){ $OTO_CAGRI=true;}else{ $OTO_CAGRI=false;}
					   $updateSQL->bindParam(':OTO_SURE',$_POST['OTO_SURE']);
					   $updateSQL->bindParam(':DURUM',$DURUM);
            if($_POST['DURUM']=="on"){ $DURUM=true;}else{ $DURUM=false;} 
                      $updateSQL->bindParam(':AKTIF',$AKTIF);
			if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;} 
                      $updateSQL->bindParam(':AKTIF_BID',$_POST['AKTIF_BID']);
                      $updateSQL->bindParam(':SON_CAGRILAN_GRUP',$_POST['SON_CAGRILAN_GRUP']);
                      $updateSQL->bindParam(':SON_CAGRILAN_TUR',$_POST['SON_CAGRILAN_TUR']);
                      $updateSQL->bindParam(':TerminalTipi',$_POST['TerminalTipi']);
                      $updateSQL->bindParam(':DoubleClick',$DoubleClick);
			if($_POST['DoubleClick']=="on"){ $DoubleClick=true;}else{ $DoubleClick=false;}
                       $updateSQL->bindParam(':SiralamaTipi',$_POST['SiralamaTipi']);
                       $updateSQL->bindParam(':CagriSiralamaTipi',$_POST['CagriSiralamaTipi']);
                       $updateSQL->bindParam(':TID',$_POST['TID']);
					
					$updateSQL->execute();
					

  $updateGoTo = "?TerminalListele&gnc=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_TerminalGuncelle = "-1";
if (isset($_GET['TerminalGuncelle'])) {
  $colname_TerminalGuncelle = $_GET['TerminalGuncelle'];
}

$row_TerminalGuncelle = $db->query("SELECT * FROM TERMINALLER WHERE TID = '$colname_TerminalGuncelle'")->fetch();

?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Terminal Paneli Güncelleme Ekranı <span class="alert alert-info">(Terminal ID:<?php echo $row_TerminalGuncelle['TID']; ?>)</span></div>
  <div class="panel body table-responsive">
  <table class="table table-hover">
    <tr valign="baseline">
      <td nowrap>EL Terminal ID:</td>
      <td><span id="sprytextfield1">
        <input class="form-control" type="number" name="ELTID" value="<?php echo htmlentities($row_TerminalGuncelle['ELTID'], ENT_COMPAT, 'utf-8'); ?>" min="1" max="1000" size="32" placeholder="1">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>TERMINAL ADI:</td>
      <td><span id="sprytextfield2">
        <input class="form-control" type="text" name="TERMINAL_AD" value="<?php echo htmlentities($row_TerminalGuncelle['TERMINAL_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32" maxlength="20">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. CAGRI:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="OTO_CAGRI" <?php if($row_TerminalGuncelle['OTO_CAGRI']==1){ echo "checked";} ?> ><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. SURE:</td>
      <td><span id="sprytextfield3">
      <input class="form-control" type="text" name="OTO_SURE" value="<?php echo substr(htmlentities($row_TerminalGuncelle['OTO_SURE'], ENT_COMPAT, 'utf-8'),0,8); ?>" size="32">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>AKTIF:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="AKTIF" <?php if($row_TerminalGuncelle['AKTIF']==1){ echo "checked"; } ?> >
     <span class="slider round"></span></label> </td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Terminal Tipi:</td>
      <td><select class="form-control" name="TerminalTipi">
        <option value="Oda" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Poliklinik"))) {echo "SELECTED";} ?>>Oda</option>
        <option value="Poliklinik" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Poliklinik"))) {echo "SELECTED";} ?>>Poliklinik</option>
        <option value="Masa" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Masa"))) {echo "SELECTED";} ?>>Masa</option>
        <option value="Vezne" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Vezne"))) {echo "SELECTED";} ?>>Vezne</option>
        <option value="Banko" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Banko"))) {echo "SELECTED";} ?>>Banko</option>
        <option value="Ünite" <?php if (!(strcmp($row_TerminalGuncelle['TerminalTipi'], "Ünite"))) {echo "SELECTED";} ?>>Ünite</option>
        </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>DoubleClick:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="DoubleClick" <?php if($row_TerminalGuncelle['DoubleClick']==1){ echo "checked"; } ?>><span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Sıralama Tipi:</td>
      <td><select class="form-control" name="SiralamaTipi">
        <option value="1" <?php if (!(strcmp($row_TerminalGuncelle['SiralamaTipi'], "1"))) {echo "SELECTED";} ?>>Alınma Sırası</option>
        <option value="2" <?php if (!(strcmp($row_TerminalGuncelle['SiralamaTipi'], "2"))) {echo "SELECTED";} ?>>Bilet No</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>Çağrı Sıralama Tipi:</td>
      <td><select class="form-control" name="CagriSiralamaTipi">       
        <option value="1" <?php if (!(strcmp($row_TerminalGuncelle['CagriSiralamaTipi'], "1"))) {echo "SELECTED";} ?>>Oran</option>
        <option value="2" <?php if (!(strcmp($row_TerminalGuncelle['CagriSiralamaTipi'], "2"))) {echo "SELECTED";} ?>>Kuyruk</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" nowrap><input type="hidden" name="SIL" value="0" size="32">
        <input type="hidden" name="DURUM" value="<?php echo htmlentities($row_TerminalGuncelle['DURUM'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <input type="hidden" name="AKTIF_BID" value="<?php echo htmlentities($row_TerminalGuncelle['AKTIF_BID'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <input type="hidden" name="SON_CAGRILAN_GRUP" value="<?php echo htmlentities($row_TerminalGuncelle['SON_CAGRILAN_GRUP'], ENT_COMPAT, 'utf-8'); ?>" size="32">
        <input type="hidden" name="SON_CAGRILAN_TUR" value="<?php echo htmlentities($row_TerminalGuncelle['SON_CAGRILAN_TUR'], ENT_COMPAT, 'utf-8'); ?>" size="32">        <input class="form-control btn btn-primary" type="submit" value="Kaydı Güncelleştir"></td>
      </tr>
  </table></div></div></div>
<input type="hidden" name="TID" value="<?php echo $row_TerminalGuncelle['TID']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  
</form><input type="hidden" name="TID" value="<?php echo $row_TerminalGuncelle['TID']; ?>">
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
</script>
