<?php
function signedint32($value) {
    $i = (int)$value;
    if (PHP_INT_SIZE > 4)   // e.g. php 64bit
        if($i & 0x80000000) // is negative
            return $i - 0x100000000;
    return $i;
}

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?AnaButonEkle&hata=Bid";
  $BTNID = $_POST['BTNID'];
  $BM_ADRES = $_POST['BM_ADRES'];
  $loginFoundUser = $db->query("SELECT COUNT(*) AS TOPLAMBTN FROM BUTONLAR WHERE BTNID='$BTNID' AND BM_ADRES='$BM_ADRES'")->fetch();

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser['TOPLAMBTN']>0){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."ButonID=".$BTNID;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$Resim=-1;	
	if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){	
	$Resim=$_FILES["RESIM"]["tmp_name"];		
	}
	else
	{
		//eğer yeni resim yüklenmediyse bunu çalıştır	
		//direk bos arkaplan ekle ki kiosk prog çatlamasın
	$Resim="img/bos.png";	
	}
	
  $insertSQL = $db->prepare("INSERT INTO BUTONLAR 
  (BM_ADRES, BTNID, GRP_ID, ANA_BTNID, BTN_EKRAN, BTN_BILET_S1, BTN_BILET_S2, BTN_BILET_S3, 
  BTN_BILET_S4, MAKS_BILET, BILET_KOPYA, YUKSEKLIK, GENISLIK, RENK, YAZI_RENGI, RESIM, 
  RESIM_YON, RESIM_AD, ESKI_RESIM_AD, ACIKLAMA, AKTIF, S_YF1, S_YF2, S_YF3, I_YF1, I_YF2, I_YF3, B_YF, 
  RandevuButonuMu, GRP_ID2, GRP1_ORAN, GRP2_ORAN, GRP_ID3, GRP3_ORAN, GRP_ID4, GRP4_ORAN, FONT, PUNTO) 
  VALUES (:BM_ADRES, :BTNID, :GRP_ID, :ANA_BTNID, :BTN_EKRAN, :BTN_BILET_S1, :BTN_BILET_S2, :BTN_BILET_S3, 
  :BTN_BILET_S4, :MAKS_BILET, :BILET_KOPYA, :YUKSEKLIK, :GENISLIK, :RENK, :YAZI_RENGI, :RESIM, 
  :RESIM_YON, :RESIM_AD, :ESKI_RESIM_AD, :ACIKLAMA, :AKTIF, :S_YF1, :S_YF2, :S_YF3, :I_YF1, :I_YF2, :I_YF3, :B_YF, 
  :RandevuButonuMu, :GRP_ID2, :GRP1_ORAN, :GRP2_ORAN, :GRP_ID3, :GRP3_ORAN, :GRP_ID4, :GRP4_ORAN, :FONT, :PUNTO)");
                       $insertSQL->bindParam(':BM_ADRES',$_POST['BM_ADRES']);
                       $insertSQL->bindParam(':BTNID',$_POST['BTNID']);
                       $insertSQL->bindParam(':GRP_ID',$_POST['GRP_ID']);
                       $insertSQL->bindParam(':ANA_BTNID',$_POST['ANA_BTNID']);
                       $insertSQL->bindParam(':BTN_EKRAN',$_POST['BTN_EKRAN']);
                       $insertSQL->bindParam(':BTN_BILET_S1',$_POST['BTN_BILET_S1']);
                       $insertSQL->bindParam(':BTN_BILET_S2',$_POST['BTN_BILET_S2']);
                       $insertSQL->bindParam(':BTN_BILET_S3',$_POST['BTN_BILET_S3']);
                       $insertSQL->bindParam(':BTN_BILET_S4',$_POST['BTN_BILET_S4']);
                       $insertSQL->bindParam(':MAKS_BILET',$_POST['MAKS_BILET']);
                       $insertSQL->bindParam(':BILET_KOPYA',$_POST['BILET_KOPYA']);
                       $insertSQL->bindParam(':YUKSEKLIK',$_POST['YUKSEKLIK']);
                       $insertSQL->bindParam(':GENISLIK',$_POST['GENISLIK']);
                       $insertSQL->bindParam(':RENK',(signedint32(hexdec('FF'.$_POST['RENK']))));
                       $insertSQL->bindParam(':YAZI_RENGI',(hexdec($_POST['YAZI_RENGI'])));
                       $insertSQL->bindParam(':RESIM',  $resim, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
					 $resim=file_get_contents($Resim);
                       $insertSQL->bindParam(':RESIM_YON',$_POST['RESIM_YON']);
                       $insertSQL->bindParam(':RESIM_AD',$_POST['RESIM_AD']);
                       $insertSQL->bindParam(':ESKI_RESIM_AD',$_POST['ESKI_RESIM_AD']);
                       $insertSQL->bindParam(':ACIKLAMA',$_POST['ACIKLAMA']);
                       $insertSQL->bindParam(':AKTIF',$AKTIF);
		if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
                       $insertSQL->bindParam(':S_YF1',$_POST['S_YF1']);
                       $insertSQL->bindParam(':S_YF2',$_POST['S_YF2']);
                       $insertSQL->bindParam(':S_YF3',$_POST['S_YF3']);
                       $insertSQL->bindParam(':I_YF1',$_POST['I_YF1']);
                       $insertSQL->bindParam(':I_YF2',$_POST['I_YF2']);
                       $insertSQL->bindParam(':I_YF3',$_POST['I_YF3']);
                       $insertSQL->bindParam(':B_YF',$_POST['B_YF']);
                       $insertSQL->bindParam(':RandevuButonuMu',$RandevuButonuMu);
		if($_POST['RandevuButonuMu']=="on"){ $RandevuButonuMu=true;}else{ $RandevuButonuMu=false;}
						$insertSQL->bindParam(':GRP_ID2',$_POST['GRP_ID2']);
						$insertSQL->bindParam(':GRP1_ORAN',$_POST['GRP1_ORAN']);
						$insertSQL->bindParam(':GRP2_ORAN',$_POST['GRP2_ORAN']);
						$insertSQL->bindParam(':GRP_ID3',$_POST['GRP_ID3']);
						$insertSQL->bindParam(':GRP3_ORAN',$_POST['GRP3_ORAN']);
						$insertSQL->bindParam(':GRP_ID4',$_POST['GRP_ID4']);
						$insertSQL->bindParam(':GRP4_ORAN',$_POST['GRP4_ORAN']);
						$insertSQL->bindParam(':FONT',$_POST['FONT']);
						$insertSQL->bindParam(':PUNTO',$_POST['PUNTO']);
					$insertSQL->execute();

  $insertGoTo = "?AnaButonEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$row_BiletMakinesi =$db->query("SELECT MAKINE_ADRESI, MAKINE_ADI FROM BILET_MAKINELERI")->fetchAll();

$row_Grup2 = $db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR")->fetchAll();

$row_Fontlar = $db->query("SELECT * FROM FONTLAR")->fetchAll();

?>

<?php if(isset($_GET["hata"]) and $_GET["hata"]=="Bid" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#hata").click(function(){
        $("#hata").fadeOut();       
    });
});
</script><!-- Jquery ile fadein fadeout için -->
    <div id="hata" class="alert alert-danger">Seçtiğiniz Bilet Makinesi için kayıtlı bir ID <span class="btn btn-red">(<?php echo $_GET["ButonID"]; ?>)</span> mevcuttur. Lütfen Başka Bir Buton ID'si seçiniz. </div>
<?php
}
?><?php if(isset($_GET["AnaButonEkle"]) and $_GET["AnaButonEkle"]=="ok" )
{
?>
<script>
<!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(6000);
});<!-- Jquery ile fadein fadeout için -->
</script>
    <div id="eklendi" class="btn btn-success">Bilet Makinesi Eklendi. Görüntülemek için <a class="btn btn-red" href="?AnaButonListele">Tıklayabilirisiniz.</a> Veya başka Bir Makine Ekleyebilirsiniz. </div>
<?php
}
?>
<form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
<div class="form-group">
  <div class="panel panel-green">
  <div class="panel panel-heading">Ana Buton Ekleme Ekranı</div>
<div class="row">
<div class="col-md-6">
<div class="panel body table-responsive">
  <table class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right">Bilet Makinesi</th>
      <td colspan="2"><span id="spryselect1">
        <select class="form-control btn btn-success" name="BM_ADRES">
          <option value="-1">Bilet Makinesi Seçiniz</option>
          <?php 
foreach($row_BiletMakinesi as $row_BiletMakinesi) {
?>
          <option value="<?php echo $row_BiletMakinesi['MAKINE_ADRESI']?>" ><?php echo "#".$row_BiletMakinesi['MAKINE_ADRESI']."-".$row_BiletMakinesi['MAKINE_ADI']?></option>
          <?php
}
?>
          </select>
        <span class="selectInvalidMsg">Lütfen geçerli bir öğe seçin.</span><span class="selectRequiredMsg">Lütfen bir öğe seçin.</span></span>
		</td>
      <th>Buton ID <input name="BTNID" type="number" class="form-control" max="1000" min="1" value="1" size="5"></th>
	  </tr>
      <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">1.Grup / Oran</th>
      <td colspan="2"><span id="spryselect2">
        <select class="form-control" name="GRP_ID">
          <option value="-1">1.Grup Seçiniz</option>
          <?php
foreach($row_Grup2 as $row_Grup){
?>
          <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
          <?php
} 
?>
          </select>
        <span class="selectInvalidMsg">Lütfen geçerli bir öğe seçin.</span><span class="selectRequiredMsg">Lütfen bir öğe seçin.</span></span></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP1_ORAN" value="100" size="5"></td>
	  </tr>
    <tr valign="baseline">
      <th nowrap align="right">2.Grup / Oran</th>
      <td colspan="2"><select class="form-control" name="GRP_ID2">
        <option value="0">2.Grup Seçiniz</option>
        <?php
foreach($row_Grup2 as $row_Grup) {  
?>
        <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
        <?php
}
?>
      </select></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP2_ORAN" value="0" size="5"></td>
	  </tr>
    <tr valign="baseline">
      <th nowrap align="right">3.Grup / Oran</th>
      <td colspan="2"><select class="form-control" name="GRP_ID3">
        <option value="0">3.Grup Seçiniz</option>
        <?php
foreach($row_Grup2 as $row_Grup) {  
?>
        <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
        <?php
} 
?>
      </select></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP3_ORAN" value="0" size="5"></td>
	  </tr>
    <tr valign="baseline">
      <th nowrap align="right">4.Grup / Oran</th>
      <td colspan="2"><select class="form-control" name="GRP_ID4">
        <option value="0">4.Grup Seçiniz</option>
        <?php
foreach($row_Grup2 as $row_Grup) {   
?>
        <option value="<?php echo $row_Grup['GRPID']?>"><?php echo "#".$row_Grup['GRPID']."-".$row_Grup['GRUP_ISMI']?></option>
        <?php
}
?>
      </select></td>
      <td><input class="form-control" type="number" min="0" max="100" name="GRP4_ORAN" value="0" size="5"></td>
	  </tr>
    <tr valign="baseline">
      <th nowrap align="right" valign="top">Açıklama:</th>
      <td colspan="3"><span id="sprytextarea2">
      <textarea class="form-control" name="ACIKLAMA" cols="50" rows="5"></textarea>
      <span id="countsprytextarea2">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Bilet kopya Sayısı:</th>
      <td><input type="number" min="1" max="10" name="BILET_KOPYA" value="1" class="form-control"></td>
      <th align="right" nowrap>YUKSEKLIK:</th>
      <td><input type="number" min="10" max="1000" name="YUKSEKLIK" value="100" class="form-control"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Maksimum Bilet:</th>
      <td><input type="number" min="1" max="9999" name="MAKS_BILET" value="5000" class="form-control"></td>
      <th align="right" nowrap>GENISLIK:</th>
      <td><input type="number" min="10" max="1000" name="GENISLIK" value="500" class="form-control"></td>
      </tr>
    <tr valign="baseline">
      <th align="right" nowrap>Soldan Konum:</th>
      <td><input type="number" min="5" max="1000" name="I_YF1" value="100" class="form-control"></td>
      <th align="right" nowrap>Yukarıdan Konum</th>
      <td><input type="number" min="5" max="2000" name="I_YF2" value="100" class="form-control"></td>
      </tr>
    <tr valign="baseline">
      <th align="right" nowrap>AKTIF:</th>
      <td><label class="switch">
        <input type="checkbox" name="AKTIF" checked>
        <span class="slider round"></span></label></td>
      <th align="right" nowrap>Randevu Butonu var mı?:</th>
      <td><label class="switch">
        <input type="checkbox" name="RandevuButonuMu">
        <span class="slider round"></span></label></td>
      </tr>
    </table>		
	</div>
    </div>
    
    <div class="col-md-6">
    <div class="panel body table-responsive">
    <table id="tableID" class="table table-hover">
    <tr valign="baseline">
      <th nowrap align="right">Buton Ekran Metni:</th>
      <td><span id="sprytextarea1">
      <textarea class="form-control" name="BTN_EKRAN" cols="50" rows="5"></textarea>
      <span id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı(250) aşıldı.</span><span class="textareaMinCharsMsg">.</span></span></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 1:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S1" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 2:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S2" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 3:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S3" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Çıktı Metni 4:</th>
      <td><input class="form-control" type="text" name="BTN_BILET_S4" value="" size="32" maxlength="50"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Buton Rengi:</th>
      <td><input class="jscolor form-control" type="text" name="RENK" value="" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Yazı Rengi:</th>
      <td><input class="jscolor form-control" type="text" name="YAZI_RENGI" value="" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th nowrap align="right">Yazı Tipi(Font)</th>
      <td>
      <select class="form-control" name="FONT">
        <?php
foreach($row_Fontlar as $row_Fontlar) {   
?>
        <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"><?php echo $row_Fontlar['FONT']?></option>
        <?php
}
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Yazı Boyutu(Punto)</th>
      <td><input class="form-control" type="number" name="PUNTO" value="25" min="1" max="120"></td>
    </tr>
    <tr valign="baseline">
      <th nowrap align="right">Resim Eklensin mi?</th>
      <td><label class="switch"><input class="form-control" type="checkbox" id="checkboxID"><span class="slider round"></span>  </label></td>
    </tr>
    <tr class="rowClass" valign="baseline">
      <th nowrap align="right">Resim Seçin:</th>
      <td><input type="file" name="RESIM" value="" accept="image/*" size="32" >    
     </td>
      </tr>
    <tr class="rowClass" valign="baseline">
      <th nowrap align="right">Resim Hizalama Yönü</th>
      <td valign="baseline">
      <table class="table table-bordered table-hover">
        <tr>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="1" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="2" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="4" ><span class="slider round"></span></label></td>
          </tr>
        <tr>
          <td>Üst Sol</td>
          <td>Üst Orta</td>
          <td> Üst Sağ</td>
          </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="16" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input name="RESIM_YON" type="radio" value="32" checked ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="64" ><span class="slider round"></span></label></td>
          </tr>
        <tr>
          <td>Orta Sol</td>
          <td>Tam
            Orta</td>
          <td>Orta Sağ</td>
          </tr>
        <tr>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="256" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="512" ><span class="slider round"></span></label></td>
          <td><label class="switch"><input type="radio" name="RESIM_YON" value="1024" ><span class="slider round"></span></label></td>
          </tr>
        <tr>
          <td>Alt Sol</td>
          <td>Alt Orta</td>
          <td>Alt Sağ</td>
          </tr>
      </table></td>
      </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="form-control" type="hidden" name="RESIM_AD" value="<?php echo time(); ?>" size="32">
        <input class="form-control" type="hidden" name="ESKI_RESIM_AD" value="" size="32">
        <input type="hidden" name="B_YF" value="" size="32">
        <input type="hidden" name="I_YF3" value="" size="32">
        <input type="hidden" name="S_YF3" value="" size="32">
        <input type="hidden" name="S_YF2" value="" size="32">
        <input type="hidden" name="S_YF1" value="" size="32">        
        <input type="hidden" name="ANA_BTNID" value="0" size="32">       
		<input class="form-control btn btn-success" type="submit" value="Kayıt Ekle"></td>
      </tr>
  </table>
  </div>
  </div>
</div></div></div>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>

<script type="text/javascript">
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:250, counterId:"countsprytextarea1", counterType:"chars_remaining", hint:"Kioks Ekranında G\xF6r\xFCnecek Buton İ\xE7in Bir Metin Yazabilirsiniz.", isRequired:false});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"-1", validateOn:["blur", "change"]});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"-1", validateOn:["blur", "change"]});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {maxChars:250, isRequired:false, counterId:"countsprytextarea2", hint:"Bir A\xE7ıklama Ekleyebilirsiniz.", validateOn:["blur", "change"]});
</script>
</script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
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
