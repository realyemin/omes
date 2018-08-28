<?php

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?TerminalEkle&hata=".$_POST['ELTID']."";
  $loginUsername = $_POST['ELTID'];
  $LoginRS__query = $db->query("SELECT ELTID FROM TERMINALLER WHERE ELTID='$loginUsername'")->fetch();

  $loginFoundUser =$LoginRS__query['ELTID'];

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser>0){
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
$insertSQL =$db->prepare("INSERT INTO TERMINALLER 
(ELTID, TERMINAL_AD, OTO_CAGRI, OTO_SURE, DURUM,
 AKTIF, AKTIF_BID, SON_CAGRILAN_GRUP, SON_CAGRILAN_TUR,
 SIL, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF,
 TerminalTipi, DoubleClick, SiralamaTipi, CagriSiralamaTipi) 
 VALUES (:ELTID, :TERMINAL_AD, :OTO_CAGRI, :OTO_SURE, :DURUM,
 :AKTIF, :AKTIF_BID, :SON_CAGRILAN_GRUP, :SON_CAGRILAN_TUR,
 :SIL, :S_YF1, :S_YF2, :S_YF3, :I_YF1, :I_YF2, :I_YF3, :B_YF,
 :TerminalTipi, :DoubleClick, :SiralamaTipi, :CagriSiralamaTipi)");
		
		$insertSQL->bindParam(':ELTID', $_POST['ELTID']);
		$insertSQL->bindParam(':TERMINAL_AD', $_POST['TERMINAL_AD']);
		$insertSQL->bindParam(':OTO_CAGRI', $OTO_CAGRI);
 if($_POST['OTO_CAGRI']=="on"){ $OTO_CAGRI=true;}else{ $OTO_CAGRI=false;}
		$insertSQL->bindParam(':OTO_SURE', $_POST['OTO_SURE']);
		$insertSQL->bindParam(':DURUM', $_POST['DURUM']);
		$insertSQL->bindParam(':AKTIF', $AKTIF);
if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
		$insertSQL->bindParam(':AKTIF_BID', $_POST['AKTIF_BID']);
		$insertSQL->bindParam(':SON_CAGRILAN_GRUP', $_POST['SON_CAGRILAN_GRUP']);
		$insertSQL->bindParam(':SON_CAGRILAN_TUR', $_POST['SON_CAGRILAN_TUR']);
		$insertSQL->bindParam(':SIL', $_POST['SIL']);
		$insertSQL->bindParam(':S_YF1', $_POST['S_YF1']);
		$insertSQL->bindParam(':S_YF2', $_POST['S_YF2']);
		$insertSQL->bindParam(':S_YF3', $_POST['S_YF3']);
		$insertSQL->bindParam(':I_YF1', $_POST['I_YF1']);
		$insertSQL->bindParam(':I_YF2', $_POST['I_YF2']);
		$insertSQL->bindParam(':I_YF3', $_POST['I_YF3']);
		$insertSQL->bindParam(':B_YF', $_POST['B_YF']);
		$insertSQL->bindParam(':TerminalTipi', $_POST['TerminalTipi']);
		$insertSQL->bindParam(':DoubleClick', $DoubleClick);
if($_POST['DoubleClick']=="on"){ $DoubleClick=true;}else{ $DoubleClick=false;}                                
		$insertSQL->bindParam(':SiralamaTipi', $_POST['SiralamaTipi']);
		$insertSQL->bindParam(':CagriSiralamaTipi', $_POST['CagriSiralamaTipi']);


	$insertSQL->execute();

  $insertGoTo = "?TerminalEkle&Ekle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
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
      <label class="switch"><input class="form-control" type="checkbox" name="OTO_CAGRI"><span class="slider round"></span>  </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>OTO. SURE:</td>
      <td><span id="sprytextfield3">
      <input class="form-control" type="text" name="OTO_SURE" value="00:00:00" size="32">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap>AKTIF:</td>
      <td><label class="switch"><input class="form-control" type="checkbox" name="AKTIF" checked><span class="slider round"></span>  </label></td>
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
      <input class="form-control" type="checkbox" name="DoubleClick" checked><span class="slider round"></span>  </label></td>
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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
</script>