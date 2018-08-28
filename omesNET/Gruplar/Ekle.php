<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL =$db->prepare("INSERT INTO GRUPLAR 
  (GRUP_ISMI, BAS_NO, BIT_NO, DONGU, MIN_HIZMET_SURESI, 
  MAX_HIZMET_SURESI, AKTIF, MESAI_BAS, MESAI_BIT, OGLE_BAS, 
  OGLE_BIT, OGLEN_BILET_VER, BILET_SINIRLA, OO_MAX_BILET, 
  OS_MAX_BILET, SIL, BeklemeSuresiTipi,Webrandevu) 
  VALUES (:GRUP_ISMI,:BAS_NO,:BIT_NO,:DONGU,:MIN_HIZMET_SURESI,
  :MAX_HIZMET_SURESI,:AKTIF,:MESAI_BAS,:MESAI_BIT,:OGLE_BAS,
  :OGLE_BIT,:OGLEN_BILET_VER,:BILET_SINIRLA,:OO_MAX_BILET,
  :OS_MAX_BILET,:SIL,:BeklemeSuresiTipi,:Webrandevu)");
             
               $insertSQL->bindParam(':GRUP_ISMI', $_POST['GRUP_ISMI']);
               $insertSQL->bindParam(':BAS_NO', $_POST['BAS_NO']);
               $insertSQL->bindParam(':BIT_NO', $_POST['BIT_NO']);
               $insertSQL->bindParam(':DONGU', $DONGU);
		if($_POST['DONGU']=="on"){ $DONGU=true;}else{ $DONGU=false;}
               $insertSQL->bindParam(':MIN_HIZMET_SURESI', $_POST['MIN_HIZMET_SURESI']);
               $insertSQL->bindParam(':MAX_HIZMET_SURESI', $_POST['MAX_HIZMET_SURESI']);
               $insertSQL->bindParam(':AKTIF', $AKTIF);
		if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
               $insertSQL->bindParam(':MESAI_BAS', $_POST['MESAI_BAS']);
               $insertSQL->bindParam(':MESAI_BIT', $_POST['MESAI_BIT']);
               $insertSQL->bindParam(':OGLE_BAS', $_POST['OGLE_BAS']);
               $insertSQL->bindParam(':OGLE_BIT', $_POST['OGLE_BIT']);
               $insertSQL->bindParam(':OGLEN_BILET_VER', $OGLEN_BILET_VER);
		if(isset($_POST['OGLEN_BILET_VER'])){ $OGLEN_BILET_VER=true;}else{ $OGLEN_BILET_VER=false;}
               $insertSQL->bindParam(':BILET_SINIRLA', $BILET_SINIRLA);  
	if(isset($_POST['BILET_SINIRLA'])){ $BILET_SINIRLA=true;}else{ $BILET_SINIRLA=false;}
               $insertSQL->bindParam(':OO_MAX_BILET', $_POST['OO_MAX_BILET']);
               $insertSQL->bindParam(':OS_MAX_BILET', $_POST['OS_MAX_BILET']);
               $insertSQL->bindParam(':SIL', $_POST['SIL']);
               $insertSQL->bindParam(':BeklemeSuresiTipi', $_POST['BeklemeSuresiTipi']);                                             
			   $insertSQL->bindParam(':Webrandevu', $Webrandevu, PDO::PARAM_BOOL);                
		if(isset($_POST['Webrandevu'])){ $Webrandevu=true;}else{ $Webrandevu=false;}
  
  				$insertSQL->execute();

  $insertGoTo = "?GrupListele&GrupEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Grup Paneli Giriş Ekranı</div><div class="panel body table-responsive">
  <table id="tableID" class="table table-hover">
  <tr>
    <td width="362" valign="top">  
    <div class="panel panel-blue">
  <div class="panel panel-heading">Grup Bilgileri</div>
  <div class="panel body table-responsive">
      <table class="table table-hover">
        <tr >
          <td  >GRUP ISMI:
            <input type="hidden" name="GRPID" value="" size="32"></td>
          <td ><span id="sprytextfield1">
            <input required class="form-control" type="text" name="GRUP_ISMI" value="" maxlength="25" size="32" placeholder="Grup Adını Yazınız">
            <span class="textfieldRequiredMsg">Grup Adı Boş geçilemez!.</span></span></td>
          </tr>
        <tr >
          <td  >Başlangıç No:</td>
          <td ><input name="BAS_NO" type="number" class="form-control" id="sprytrigger1" placeholder="1" max="2147483647" min="1" value="1"size="32"></td>
          </tr>
        <tr >
          <td  >Bitiş No:</td>
          <td ><input name="BIT_NO" type="number" class="form-control" id="sprytrigger2" placeholder="1" max="2147483647" min="1" value="1" size="32"></td>
          </tr>
        <tr >
          <td  >Döngü:(Bitince Başa Dön)</td>
          <td align="left" ><label class="switch"><input name="DONGU" type="checkbox" checked><span class="slider round"></span>  </label></td>
          </tr>
        <tr >
          <td  >Aktif:</td>
          <td align="left" ><label class="switch"><input name="AKTIF" type="checkbox" checked><span class="slider round"></span>  </label></td>
          </tr>
		 <tr class="alert alert-success" data-toggle="tooltip" title="EĞER BU GRUBUN WEB RANDEVULARINA BAKACAK ŞEKİLDE OLMASINI İSTİYORSANIZ İŞARETLEYİNİZ!">
          <td>WEB RANDEVU:</td>
          <td align="left" ><label class="switch"><input name="Webrandevu" type="checkbox"><span class="slider round"></span>  </label></td>
          </tr> 		  
      </table></div></div>
    </td>
  <td width="270" valign="top">
  <div class="panel panel-green">
  <div class="panel panel-heading">Hizmet Bilgileri</div>
  <div class="panel body table-responsive">
  	<table class="table table-hover">
    <tr >
      <td  >MIN. HIZMET SURESI(Saat:Dak:Sn):</td>
      </tr>
    <tr >
      <td  ><span id="sprytextfield2">
      <input class="form-control" data-toggle="tooltip" title="Aynı Zamanda Web Randevu için Randevu aralığı yerine geçer" type="text" name="MIN_HIZMET_SURESI" value="00:05:00" size="32" placeholder="00:05:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      </tr>
    <tr >
      <td  >MAX. HIZMET SURESI(Saat:Dak:Sn):</td>
      </tr>
    <tr >
      <td  ><span id="sprytextfield3">
      <input class="form-control" type="text" name="MAX_HIZMET_SURESI" value="00:20:00" size="32" placeholder="00:20:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr >
      <td class="alert alert-info"><strong>Ortalama Bekleme Süresi Yazdırma Şekli</strong></td>
    </tr>
      <tr >
      <td  ><table class="table table-responsive">
        <tr>
          <td><label class="switch"><input type="radio" name="BeklemeSuresiTipi" value="1" class="form-control"><span class="slider round"></span>  </label></td>
          <td> Min.Hizmet Süresini Kullanın</td>
        </tr>
        <tr>
          <td><label class="switch"><input name="BeklemeSuresiTipi" type="radio" class="form-control" value="2" checked><span class="slider round"></span>  </label></td>
          <td>Otomatik Hesaplasın</td>
        </tr>
      </table></td>
      </tr>    
    </table></div></div>
    </td>    
    </tr>    
  <tr><td colspan="2">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Çalışma Saati Bilgileri</div><div class="panel body table-responsive">
  <table class="table table-hover">
  <tr >
      <td  >Mesai Başlangıcı(Saat:Dak:Sn):</td>
      <td ><span id="sprytextfield4">
      <input class="form-control" type="text" name="MESAI_BAS" value="09:00:00" size="32" placeholder="09:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td >Öğle Molası Başlangıcı(Saat:Dak:Sn):</td>
      <td ><span id="sprytextfield6">
      <input class="form-control" type="text" name="OGLE_BAS" value="12:00:00" size="32" placeholder="12:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr >
      <td  >Mesai Bitiş(Saat:Dak:Sn):</td>
      <td ><span id="sprytextfield5">
      <input class="form-control" type="text" name="MESAI_BIT" value="17:00:00" size="32" placeholder="17:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
      <td >Öğle Molası Bitiş(Saat:Dak:Sn):</td>
      <td><span id="sprytextfield7">
      <input class="form-control" type="text" name="OGLE_BIT" value="13:00:00" size="32" placeholder="13:00:00">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.</span></span></td>
    </tr>
    <tr >
      <td  >Bilet Sınırlaması Yapılsın mı?:</td>
      <td ><label class="switch"><input type="checkbox" name="BILET_SINIRLA" id="checkboxID"><span class="slider round"></span>  </label></td>
      <td >Öğle Tatilinde Bilet Verilsin mi?:</td>
      <td ><label class="switch"><input type="checkbox" name="OGLEN_BILET_VER"><span class="slider round"></span>  </label></td>
    </tr>
    <tr class="rowClass" >
      <td colspan="4" class="alert alert-info" ><strong>Bilet Sınırlama Bilgileri</strong></td>
      </tr>
      
    <tr class="rowClass" >
      <td  >Öğleden Önce Max. Bilet Sayısı:</td>
      <td ><input class="form-control" type="number" min="0" max="1000" name="OO_MAX_BILET" value="0" size="32"></td>
      <td colspan="2" class="alert alert-success">Bilet sınırlaması, bir gruba öğleden önce ve<br>
öğleden sonra en fazla ne kadar bilet <br>
verileceğini belirler.</td>
      </tr>
    <tr class="rowClass" >
      <td  >Öğleden Sonra Max. Bilet Sayısı</td>
      <td ><input class="form-control" type="number" min="0" max="1000" name="OS_MAX_BILET" value="0" size="32"></td>
      <td colspan="2" rowspan="2" class="aler alert-danger"><strong><p>Eğer herhangi bir sınırlama olmaksızın bilet <br>
verilmesini istiyorsanız <br>
&quot;Bilet Sınırlaması Yap&quot; kutucuğunun işaretini kaldırınız.</p></strong></td>
      </tr>
    <tr >
      <td colspan="2"  ><input class="form-control" type="hidden" name="SIL" value="0" size="32">
        <input class="form-control" type="hidden" name="S_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="S_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF1" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF2" value="" size="32">
        <input class="form-control" type="hidden" name="I_YF3" value="" size="32">
        <input class="form-control" type="hidden" name="B_YF" value="" size="32"></td>
      </tr>
    <tr >
      <td  >&nbsp;</td>
      <td ><input class="form-control btn btn-success" type="submit" value="Kayıt Ekle"></td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
  </table>
  </div></div>
  </td></tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
  </div></div></div>
</form>

<div class="tooltipContent" id="sprytooltip1"><span class="alert alert-danger">Numaratörden verilen Bilet Başlangıç numarasıdır</span></div>
<div class="tooltipContent" id="sprytooltip2"><span class="alert alert-danger">Numaratörden verilen Bilet Bitiş numarasıdır</span></div>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "time", {format:"HH:mm:ss", useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "time", {useCharacterMasking:true, format:"HH:mm:ss", validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "time", {validateOn:["blur", "change"], useCharacterMasking:true, format:"HH:mm:ss"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "time", {useCharacterMasking:true, validateOn:["blur", "change"], format:"HH:mm:ss"});
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1", {closeOnTooltipLeave:true, followMouse:true, useEffect:"blind"});
var sprytooltip2 = new Spry.Widget.Tooltip("sprytooltip2", "#sprytrigger2", {closeOnTooltipLeave:true, followMouse:true, useEffect:"blind"});
</script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->

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
