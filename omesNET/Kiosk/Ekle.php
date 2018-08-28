<?php
 /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 11.08.2017
-- Bu sayfada Ekleme ve Güncelleme işlemi birlikte yapıldı
-- ============================================= 
 */
//bu fonksiyon c# içinde form backcolor özelliğinin 
//işaretli sayı değeri ile çalışmasından kaynaklı 
//ARGB renk dönüşümünü sağlamak için sadece kiosk_ayar tablosundaki RENK alanına girilen değerler için kullanılmıştır.
function signedint32($value)//veritabanına kaydederken bunu kullan
 {
   $i = (int)$value;
    if (PHP_INT_SIZE> 4)   // e.g. php 64bit veritabanına kaydederken bunu kullan
        if($i & 0x80000000) // is negative
            return $i - 0x100000000; 
    return $i;
}
function signed2hex($value, $reverseEndianness = false) //4bayt FF,FF,FF,FF şeklinde argb değerini elde etmek için
{
    $packed = pack('N', $value);//veritabanından okurken bunu kullan
    $hex='';
    for ($i=0; $i < 4; $i++){
        $hex .= strtoupper( str_pad( dechex(ord($packed[$i])) , 2, '0', STR_PAD_LEFT) );
    }
    $tmp = str_split($hex, 2);
    $out = implode('', ($reverseEndianness ? array_reverse($tmp) : $tmp));
    return $out;
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
		//direk logoyu arkaplan ekle
	$Resim="img/omes_logo.png";	
	}
  $insertSQL = $db->prepare("INSERT INTO KIOSK_AYAR (KID, BASLIK, ALT_BASLIK, MESAJ_OGLE, MESAJ_SISTEM_KAPALI, 
  MESAJ_SERVIS_KAPALI, SOL_BTN_ADET, SAG_BTN_ADET, SOL_PADDING, SAG_PADDING, FONT, PUNTO, GECIKME, 
  RESIM_AD, ESKI_RESIM_AD, RESIM_YON, BASLIK_KAY, ALT_BASLIK_KAY, YON_BASLIK, 
  YON_ALT_BASLIK, HIZ_BASLIK, HIZ_ALT_BASLIK, AKTIF, TagPreviewHeight, TagPreviewWidth, TagPreviewTimerInterval, 
  TagPreviewZoom, TotalTag, MaxTotalTag, TagOverFlowPerId, TagOverFlowMessage, AltButonSuresi, WebdenRandevu, 
  BeklemeSuresiMetni, EtiketSifirlamasifresi, BarkodlaEtiket,YAZI_RENGI,RENK,RESIM) VALUES 
  (:KID, :BASLIK, :ALT_BASLIK, :MESAJ_OGLE, :MESAJ_SISTEM_KAPALI, :MESAJ_SERVIS_KAPALI, :SOL_BTN_ADET,
  :SAG_BTN_ADET, :SOL_PADDING, :SAG_PADDING, :FONT, :PUNTO, :GECIKME, :RESIM_AD,
  :ESKI_RESIM_AD, :RESIM_YON, :BASLIK_KAY, :ALT_BASLIK_KAY, :YON_BASLIK, :YON_ALT_BASLIK, :HIZ_BASLIK, :HIZ_ALT_BASLIK, 
  :AKTIF, :TagPreviewHeight, :TagPreviewWidth, :TagPreviewTimerInterval, :TagPreviewZoom, :TotalTag, :MaxTotalTag, :TagOverFlowPerId,
  :TagOverFlowMessage, :AltButonSuresi, :WebdenRandevu, :BeklemeSuresiMetni, :EtiketSifirlamasifresi, :BarkodlaEtiket,
  :YAZI_RENGI,:RENK, :RESIM)");                     
					 $insertSQL->bindParam(':KID',  $_POST['KID']);
					 $insertSQL->bindParam(':BASLIK',  $_POST['BASLIK']);
					 $insertSQL->bindParam(':ALT_BASLIK',  $_POST['ALT_BASLIK']);
					 $insertSQL->bindParam(':MESAJ_OGLE',  $_POST['MESAJ_OGLE']);
					 $insertSQL->bindParam(':MESAJ_SISTEM_KAPALI',  $_POST['MESAJ_SISTEM_KAPALI']);
					 $insertSQL->bindParam(':MESAJ_SERVIS_KAPALI',  $_POST['MESAJ_SERVIS_KAPALI']);
					 $insertSQL->bindParam(':SOL_BTN_ADET',  $_POST['SOL_BTN_ADET']);
					 $insertSQL->bindParam(':SAG_BTN_ADET',  $_POST['SAG_BTN_ADET']);
					 $insertSQL->bindParam(':SOL_PADDING',  $_POST['SOL_PADDING']);
					 $insertSQL->bindParam(':SAG_PADDING',  $_POST['SAG_PADDING']);
					 $insertSQL->bindParam(':FONT',  $_POST['FONT']);
					 $insertSQL->bindParam(':PUNTO',  $_POST['PUNTO']);
					 $insertSQL->bindParam(':GECIKME',  $_POST['GECIKME']);
					 $insertSQL->bindParam(':YAZI_RENGI',  $yazirengi);
					 $yazirengi=hexdec($_POST['YAZI_RENGI']);
					 $insertSQL->bindParam(':RENK', $renk);
					 $renk=(signedint32(hexdec('FF'.$_POST['RENK'])));
					 $insertSQL->bindParam(':RESIM',  $resim, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
					 $resim=file_get_contents($Resim);
					 $insertSQL->bindParam(':RESIM_AD',  $_POST['RESIM_AD']);
					 $insertSQL->bindParam(':ESKI_RESIM_AD',  $_POST['ESKI_RESIM_AD']);
					 $insertSQL->bindParam(':RESIM_YON',  $_POST['RESIM_YON']);
					 $insertSQL->bindParam(':BASLIK_KAY',  $BASLIK_KAY, PDO::PARAM_BOOL);				
           	if(isset($_POST['BASLIK_KAY']) && $_POST['BASLIK_KAY']=="on"){ $BASLIK_KAY=1; }else{ $BASLIK_KAY=0;}					
					$insertSQL->bindParam(':ALT_BASLIK_KAY',  $ALT_BASLIK_KAY);
			if(isset($_POST['ALT_BASLIK_KAY']) && $_POST['ALT_BASLIK_KAY']=="on"){ $ALT_BASLIK_KAY=true;}else{ $ALT_BASLIK_KAY=false;}
					$insertSQL->bindParam(':YON_BASLIK',  $YON_BASLIK);	
					$insertSQL->bindParam(':YON_ALT_BASLIK',  $YON_ALT_BASLIK);	
					$insertSQL->bindParam(':HIZ_BASLIK',  $HIZ_BASLIK);	
					$insertSQL->bindParam(':HIZ_ALT_BASLIK',  $HIZ_ALT_BASLIK);	
					$insertSQL->bindParam(':AKTIF',  $AKTIF);	
			if(isset($_POST['AKTIF']) && $_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}
					$insertSQL->bindParam(':TagPreviewHeight',  $_POST['TagPreviewHeight']);
					$insertSQL->bindParam(':TagPreviewWidth',  $_POST['TagPreviewWidth']);
					$insertSQL->bindParam(':TagPreviewTimerInterval',  $_POST['TagPreviewTimerInterval']);
					$insertSQL->bindParam(':TagPreviewZoom',  $_POST['TagPreviewZoom']);
					$insertSQL->bindParam(':TotalTag',  $_POST['TotalTag']);
					$insertSQL->bindParam(':MaxTotalTag',  $_POST['MaxTotalTag']);
					$insertSQL->bindParam(':TagOverFlowPerId',  $_POST['TagOverFlowPerId']);
					$insertSQL->bindParam(':TagOverFlowMessage',  $_POST['TagOverFlowMessage']);
					$insertSQL->bindParam(':AltButonSuresi',  intval($_POST['AltButonSuresi']*1000));
					$insertSQL->bindParam(':WebdenRandevu',  $WebdenRandevu);
			if(isset($_POST['WebdenRandevu']) && $_POST['WebdenRandevu']=="on"){ $WebdenRandevu=true;}else{ $WebdenRandevu=false;}
					$insertSQL->bindParam(':BeklemeSuresiMetni',  $_POST['BeklemeSuresiMetni']);
					$insertSQL->bindParam(':EtiketSifirlamasifresi',  $_POST['EtiketSifirlamasifresi']);
					$insertSQL->bindParam(':BarkodlaEtiket',  $BarkodlaEtiket);
			if(isset($_POST['BarkodlaEtiket']) && $_POST['BarkodlaEtiket']=="on"){ $BarkodlaEtiket=true;}else{ $BarkodlaEtiket=false;}

				$insertSQL->execute();
				
echo hexdec('FF'.$_POST['RENK']);
  $insertGoTo = "?KioskEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
	$updateSQL=-1;
	if((!empty($_FILES["RESIM"]) and $_FILES["RESIM"]["tmp_name"]!="") and ($_POST)){
		//eğer yeni resim yüklendiyse bunu çalıştır
  $updateSQL = $db->prepare("UPDATE KIOSK_AYAR SET BASLIK=:BASLIK, ALT_BASLIK=:ALT_BASLIK, MESAJ_OGLE=:MESAJ_OGLE, 
  MESAJ_SISTEM_KAPALI=:MESAJ_SISTEM_KAPALI, MESAJ_SERVIS_KAPALI=:MESAJ_SERVIS_KAPALI, SOL_BTN_ADET=:SOL_BTN_ADET, 
  SAG_BTN_ADET=:SAG_BTN_ADET, SOL_PADDING=:SOL_PADDING, 
  SAG_PADDING=:SAG_PADDING, FONT=:FONT, PUNTO=:PUNTO, GECIKME=:GECIKME, YAZI_RENGI=:YAZI_RENGI, RENK=:RENK, RESIM=:RESIM, 
  RESIM_AD=:RESIM_AD, 
  ESKI_RESIM_AD=:ESKI_RESIM_AD, RESIM_YON=:RESIM_YON, BASLIK_KAY=:BASLIK_KAY, ALT_BASLIK_KAY=:ALT_BASLIK_KAY, 
  YON_BASLIK=:YON_BASLIK, YON_ALT_BASLIK=:YON_ALT_BASLIK, 
  HIZ_BASLIK=:HIZ_BASLIK, HIZ_ALT_BASLIK=:HIZ_ALT_BASLIK, AKTIF=:AKTIF, TagPreviewHeight=:TagPreviewHeight, 
  TagPreviewWidth=:TagPreviewWidth, TagPreviewTimerInterval=:TagPreviewTimerInterval, 
  TagPreviewZoom=:TagPreviewZoom, TotalTag=:TotalTag, MaxTotalTag=:MaxTotalTag, TagOverFlowPerId=:TagOverFlowPerId,
  TagOverFlowMessage=:TagOverFlowMessage, AltButonSuresi=:AltButonSuresi, WebdenRandevu=:WebdenRandevu, 
  BeklemeSuresiMetni=:BeklemeSuresiMetni, EtiketSifirlamasifresi=:EtiketSifirlamasifresi, BarkodlaEtiket=:BarkodlaEtiket WHERE KID=:KID");
						
						$updateSQL->bindParam(':BASLIK',  $_POST['BASLIK']);
						$updateSQL->bindParam(':ALT_BASLIK',  $_POST['ALT_BASLIK']);
						$updateSQL->bindParam(':MESAJ_OGLE',  $_POST['MESAJ_OGLE']);
						$updateSQL->bindParam(':MESAJ_SISTEM_KAPALI',  $_POST['MESAJ_SISTEM_KAPALI']);
						$updateSQL->bindParam(':MESAJ_SERVIS_KAPALI',  $_POST['MESAJ_SERVIS_KAPALI']);
						$updateSQL->bindParam(':SOL_BTN_ADET',  $_POST['SOL_BTN_ADET']);
						$updateSQL->bindParam(':SAG_BTN_ADET',  $_POST['SAG_BTN_ADET']);
						$updateSQL->bindParam(':SOL_PADDING',  $_POST['SOL_PADDING']);
						$updateSQL->bindParam(':SAG_PADDING',  $_POST['SAG_PADDING']);
						$updateSQL->bindParam(':FONT',  $_POST['FONT']);
						$updateSQL->bindParam(':PUNTO',  $_POST['PUNTO']);
						$updateSQL->bindParam(':GECIKME',  $_POST['GECIKME']);
						$updateSQL->bindParam(':YAZI_RENGI',  hexdec($_POST['YAZI_RENGI']));
						$updateSQL->bindParam(':RENK',  (signedint32(hexdec('FF'.$_POST['RENK']))));
						$updateSQL->bindParam(':RESIM',  file_get_contents($_FILES['RESIM']["tmp_name"]),PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
						$updateSQL->bindParam(':RESIM_AD',  $_POST['RESIM_AD']);
						$updateSQL->bindParam(':ESKI_RESIM_AD',  $_POST['ESKI_RESIM_AD']);
						$updateSQL->bindParam(':RESIM_YON',  $_POST['RESIM_YON']);
						$updateSQL->bindParam(':BASLIK_KAY',  $BASLIK_KAY);
				if($_POST['BASLIK_KAY']=="on"){ $BASLIK_KAY=true;}else{ $BASLIK_KAY=false;}
						$updateSQL->bindParam(':ALT_BASLIK_KAY',  $ALT_BASLIK_KAY);
				if($_POST['ALT_BASLIK_KAY']=="on"){ $ALT_BASLIK_KAY=true;}else{ $ALT_BASLIK_KAY=false;}
						$updateSQL->bindParam(':YON_BASLIK',  $_POST['YON_BASLIK']);
						$updateSQL->bindParam(':YON_ALT_BASLIK',  $_POST['YON_ALT_BASLIK']);
						$updateSQL->bindParam(':HIZ_BASLIK',  $_POST['HIZ_BASLIK']);
						$updateSQL->bindParam(':HIZ_ALT_BASLIK',  $_POST['HIZ_ALT_BASLIK']);
						$updateSQL->bindParam(':AKTIF',  $AKTIF);
				if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}								
						$updateSQL->bindParam(':TagPreviewHeight',  $_POST['TagPreviewHeight']);
						$updateSQL->bindParam(':TagPreviewWidth',  $_POST['TagPreviewWidth']);
						$updateSQL->bindParam(':TagPreviewTimerInterval',  $_POST['TagPreviewTimerInterval']);
						$updateSQL->bindParam(':TagPreviewZoom',  $_POST['TagPreviewZoom']);
						$updateSQL->bindParam(':TotalTag',  $_POST['TotalTag']);
						$updateSQL->bindParam(':MaxTotalTag',  $_POST['MaxTotalTag']);
						$updateSQL->bindParam(':TagOverFlowPerId',  $_POST['TagOverFlowPerId']);
						$updateSQL->bindParam(':TagOverFlowMessage',  $_POST['TagOverFlowMessage']);
						$updateSQL->bindParam(':AltButonSuresi',  intval($_POST['AltButonSuresi']*1000));
						$updateSQL->bindParam(':WebdenRandevu',  $WebdenRandevu);
				if($_POST['WebdenRandevu']=="on"){ $WebdenRandevu=true;}else{ $WebdenRandevu=false;}	
						$updateSQL->bindParam(':BeklemeSuresiMetni',  $_POST['BeklemeSuresiMetni']);
						$updateSQL->bindParam(':EtiketSifirlamasifresi',  $_POST['EtiketSifirlamasifresi']);
						$updateSQL->bindParam(':BarkodlaEtiket',  $BarkodlaEtiket);
				if($_POST['BarkodlaEtiket']=="on"){ $BarkodlaEtiket=true;}else{ $BarkodlaEtiket=false;}		
						$updateSQL->bindParam(':KID',  $_POST['KID']);
	}
	else
	{		
  $updateSQL = $db->prepare("UPDATE KIOSK_AYAR SET BASLIK=:BASLIK, ALT_BASLIK=:ALT_BASLIK, MESAJ_OGLE=:MESAJ_OGLE, 
  MESAJ_SISTEM_KAPALI=:MESAJ_SISTEM_KAPALI, MESAJ_SERVIS_KAPALI=:MESAJ_SERVIS_KAPALI, SOL_BTN_ADET=:SOL_BTN_ADET, 
  SAG_BTN_ADET=:SAG_BTN_ADET, SOL_PADDING=:SOL_PADDING, 
  SAG_PADDING=:SAG_PADDING, FONT=:FONT, PUNTO=:PUNTO, GECIKME=:GECIKME, YAZI_RENGI=:YAZI_RENGI, RENK=:RENK, RESIM_AD=:RESIM_AD, 
  ESKI_RESIM_AD=:ESKI_RESIM_AD, RESIM_YON=:RESIM_YON, BASLIK_KAY=:BASLIK_KAY, ALT_BASLIK_KAY=:ALT_BASLIK_KAY, 
  YON_BASLIK=:YON_BASLIK, YON_ALT_BASLIK=:YON_ALT_BASLIK, 
  HIZ_BASLIK=:HIZ_BASLIK, HIZ_ALT_BASLIK=:HIZ_ALT_BASLIK, AKTIF=:AKTIF, TagPreviewHeight=:TagPreviewHeight, 
  TagPreviewWidth=:TagPreviewWidth, TagPreviewTimerInterval=:TagPreviewTimerInterval, 
  TagPreviewZoom=:TagPreviewZoom, TotalTag=:TotalTag, MaxTotalTag=:MaxTotalTag, TagOverFlowPerId=:TagOverFlowPerId,
  TagOverFlowMessage=:TagOverFlowMessage, AltButonSuresi=:AltButonSuresi, WebdenRandevu=:WebdenRandevu, 
  BeklemeSuresiMetni=:BeklemeSuresiMetni, EtiketSifirlamasifresi=:EtiketSifirlamasifresi, BarkodlaEtiket=:BarkodlaEtiket WHERE KID=:KID");
						
						$updateSQL->bindParam(':BASLIK',  $_POST['BASLIK']);
						$updateSQL->bindParam(':ALT_BASLIK',  $_POST['ALT_BASLIK']);
						$updateSQL->bindParam(':MESAJ_OGLE',  $_POST['MESAJ_OGLE']);
						$updateSQL->bindParam(':MESAJ_SISTEM_KAPALI',  $_POST['MESAJ_SISTEM_KAPALI']);
						$updateSQL->bindParam(':MESAJ_SERVIS_KAPALI',  $_POST['MESAJ_SERVIS_KAPALI']);
						$updateSQL->bindParam(':SOL_BTN_ADET',  $_POST['SOL_BTN_ADET']);
						$updateSQL->bindParam(':SAG_BTN_ADET',  $_POST['SAG_BTN_ADET']);
						$updateSQL->bindParam(':SOL_PADDING',  $_POST['SOL_PADDING']);
						$updateSQL->bindParam(':SAG_PADDING',  $_POST['SAG_PADDING']);
						$updateSQL->bindParam(':FONT',  $_POST['FONT']);
						$updateSQL->bindParam(':PUNTO',  $_POST['PUNTO']);
						$updateSQL->bindParam(':GECIKME',  $_POST['GECIKME']);
						$updateSQL->bindParam(':YAZI_RENGI',  (hexdec($_POST['YAZI_RENGI'])));
						$updateSQL->bindParam(':RENK',  (signedint32(hexdec('FF'.$_POST['RENK']))));
						$updateSQL->bindParam(':RESIM_AD',  $_POST['RESIM_AD']);
						$updateSQL->bindParam(':ESKI_RESIM_AD',  $_POST['ESKI_RESIM_AD']);
						$updateSQL->bindParam(':RESIM_YON',  $_POST['RESIM_YON']);
						$updateSQL->bindParam(':BASLIK_KAY',  $BASLIK_KAY);
				if($_POST['BASLIK_KAY']=="on"){ $BASLIK_KAY=true;}else{ $BASLIK_KAY=false;}
						$updateSQL->bindParam(':ALT_BASLIK_KAY',  $ALT_BASLIK_KAY);
				if($_POST['ALT_BASLIK_KAY']=="on"){ $ALT_BASLIK_KAY=true;}else{ $ALT_BASLIK_KAY=false;}
						$updateSQL->bindParam(':YON_BASLIK',  $_POST['YON_BASLIK']);
						$updateSQL->bindParam(':YON_ALT_BASLIK',  $_POST['YON_ALT_BASLIK']);
						$updateSQL->bindParam(':HIZ_BASLIK',  $_POST['HIZ_BASLIK']);
						$updateSQL->bindParam(':HIZ_ALT_BASLIK',  $_POST['HIZ_ALT_BASLIK']);
						$updateSQL->bindParam(':AKTIF',  $AKTIF);
				if($_POST['AKTIF']=="on"){ $AKTIF=true;}else{ $AKTIF=false;}								
						$updateSQL->bindParam(':TagPreviewHeight',  $_POST['TagPreviewHeight']);
						$updateSQL->bindParam(':TagPreviewWidth',  $_POST['TagPreviewWidth']);
						$updateSQL->bindParam(':TagPreviewTimerInterval',  $_POST['TagPreviewTimerInterval']);
						$updateSQL->bindParam(':TagPreviewZoom',  $_POST['TagPreviewZoom']);
						$updateSQL->bindParam(':TotalTag',  $_POST['TotalTag']);
						$updateSQL->bindParam(':MaxTotalTag',  $_POST['MaxTotalTag']);
						$updateSQL->bindParam(':TagOverFlowPerId',  $_POST['TagOverFlowPerId']);
						$updateSQL->bindParam(':TagOverFlowMessage',  $_POST['TagOverFlowMessage']);
						$updateSQL->bindParam(':AltButonSuresi',  intval($_POST['AltButonSuresi']*1000));
						$updateSQL->bindParam(':WebdenRandevu',  $WebdenRandevu);
				if($_POST['WebdenRandevu']=="on"){ $WebdenRandevu=true;}else{ $WebdenRandevu=false;}	
						$updateSQL->bindParam(':BeklemeSuresiMetni',  $_POST['BeklemeSuresiMetni']);
						$updateSQL->bindParam(':EtiketSifirlamasifresi',  $_POST['EtiketSifirlamasifresi']);
						$updateSQL->bindParam(':BarkodlaEtiket',  $BarkodlaEtiket);
				if($_POST['BarkodlaEtiket']=="on"){ $BarkodlaEtiket=true;}else{ $BarkodlaEtiket=false;}		
						$updateSQL->bindParam(':KID',  $_POST['KID']);
	}
	
		$updateSQL->execute();

  $updateGoTo = "?KioskEkle=gnc&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$query_BiletMakinesi = "SELECT MAKINE_ADRESI, MAKINE_ADI FROM BILET_MAKINELERI";
$row_BiletMakinesi = $db->query($query_BiletMakinesi, PDO::FETCH_ASSOC);

$query_Personel = "SELECT PID, AD, SOYAD FROM PERSONELLER WHERE PID > 1";
$row_Personel = $db->query($query_Personel, PDO::FETCH_ASSOC);

$query_Fontlar = "SELECT * FROM FONTLAR";
$row_Fontlar = $db->query($query_Fontlar, PDO::FETCH_ASSOC);

$colname_KioskAyar = "-1";
if (isset($_GET['Kiosk'])) {
  $colname_KioskAyar = $_GET['Kiosk'];
}

$query_KioskAyar ="SELECT * FROM KIOSK_AYAR WHERE KID = $colname_KioskAyar";
$row_KioskAyar = $db->query($query_KioskAyar)->fetch();

?>
<script type="text/javascript">
function MM_jumpMenuGo(objId,targ,restore){ //v9.0
  var selObj = null;  with (document) { 
  if (getElementById) selObj = getElementById(objId);
  if (selObj) eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0; }
}
</script>
<?php
	if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Kiosk Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Kiosk Ayarları Kaydedildi</strong></p>
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
<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="gnc" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    //$("#hata").click(function(){
        $("#gnc").fadeOut(6000);       
//    });
});
</script><!-- Jquery ile fadein fadeout için -->
<div id="gnc" class="alert alert-success"><strong>Güncelleme işlemi tamam.</strong></div>
<?php
}
?>
<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="SilEksik" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    //$("#hata").click(function(){
        $("#hata").fadeOut(6000);       
//    });
});
</script><!-- Jquery ile fadein fadeout için -->
<div id="hata" class="alert alert-danger">Lütfen Geçerli bir Kioks ID Seçiniz.</div>
<?php
}
?><?php if(isset($_GET["KioskEkle"]) and $_GET["KioskEkle"]=="SilOk" and isset($_GET['?KioskSil']) and $_GET['?KioskSil']!="")
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(10000);
});<!-- Jquery ile fadein fadeout için -->
</script>
<div id="eklendi" class="btn btn-danger"><?php echo "#".$_GET['?KioskSil']; ?> Seçtiğiniz Kiosk Makinesi Ayarları Silindi. <strong> Not:Bu işlem Kioks Makinesini Silmez Sadece Ekran Ayarlarını Temizler.</strong></div>
<?php
}
?>
  <div class="panel panel-green">
  <div class="panel panel-heading">Kiosk Ayar Paneli</div>
<div class="alert alert-info">
<div class="table-responsive">
<form name="form" id="form">  
  <select class="form-control btn btn-success" role="menu" name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenuGo('jumpMenu','parent',0)">
    <option value="?KioskEkle">Kiosk için Bilet Makinesi Seçiniz</option>
    <?php
foreach($row_BiletMakinesi as $row_BiletMakinesi){ 
?>
    <option value="?KioskEkle&Kiosk=<?php echo $row_BiletMakinesi['MAKINE_ADRESI'];?>" <?php if (isset($_GET['Kiosk']) and !(strcmp($_GET['Kiosk'], htmlentities($row_BiletMakinesi['MAKINE_ADRESI'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo "#".$row_BiletMakinesi['MAKINE_ADRESI']."-".$row_BiletMakinesi['MAKINE_ADI']?></option>
    <?php
} 
  
?>
  </select>
  </form>
 <a href="?KioskSil=<?php if(isset($_GET['Kiosk'])){echo $_GET['Kiosk'];} ?>" class="form-control btn btn-danger btn-md" id="sprytrigger1" onClick="return confirm('Seçili Bilet Makinesi İçin Kiosk Ayarları Silinsin mi?');" role="button">Seçili Bilet Makinesi için Kiosk Ayarlarını Sil</a> 
(Eğer Kaydedilmiş Bir Kiosk varsa güncelleme bilgileri yüklenecektir. Yoksa Yeni Bilgi İçin Boş Form Açılacaktır.)</div>
</div>
</div>
<div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Geri Alınamaz.</div>
<?php 
	if(isset($_GET['Kiosk']) and $_GET['Kiosk']!="")
	{//form göster gizle başlangıç
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data" >
  <div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">1-Kiosk Bilgileri</div>
	<div class="table-responsive">
	<table class="table table-hover">
    <tr>
      <th>Seçili Kiosk ID:</th>
      <td colspan="3"><?php if(isset($_GET['Kiosk'])){ echo "<span class='alert alert-danger'><strong># ".$_GET['Kiosk']." (Kiosk Kimliği)</strong></span>"; }else { echo "<span class='btn btn-danger'><strong>Henüz Bir Kiosk Seçmediğiniz İçin İşlem Yapamazsınız.</strong></span>"; } ?></td>
    </tr>
    <tr>
      <th>Kiosk Başlık:</th>
      <td style=" min-width:200px"><span id="sprytextarea1">
      <textarea name="BASLIK" class="form-control" cols="30" rows="3" required><?php echo $row_KioskAyar['BASLIK']; ?></textarea>
      <span id="countsprytextarea1">&nbsp;</span><span class="textareaRequiredMsg">Bir değer gerekiyor.</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
      <th>Alt Başlık:</th>
      <td><span id="sprytextarea2">
      <textarea name="ALT_BASLIK" class="form-control" cols="30" rows="3"><?php echo $row_KioskAyar['ALT_BASLIK']; ?></textarea>
      <span id="countsprytextarea2">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
    </tr>
    <tr >
      <th valign="top">Öğle Mesajı:</th>
      <td><span id="sprytextarea3">
      <textarea name="MESAJ_OGLE" class="form-control" cols="30" rows="3"><?php if($row_KioskAyar['MESAJ_OGLE']!=""){ echo $row_KioskAyar['MESAJ_OGLE'];}else { echo "Öğle Molası"; } ?></textarea>
      <span id="countsprytextarea3">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
      <th valign="top">Sistem Kapalı Mesajı:</th>
      <td><span id="sprytextarea4">
      <textarea name="MESAJ_SISTEM_KAPALI" class="form-control" cols="30" rows="3"><?php if($row_KioskAyar['MESAJ_SISTEM_KAPALI']!=""){echo $row_KioskAyar['MESAJ_SISTEM_KAPALI'];} else { echo "Sistem Kapalı"; } ?></textarea>
      <span id="countsprytextarea4">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span></td>
    </tr>
    <tr>
      <th valign="top">Servis Kapalı Mesajı:</th>
      <td><span id="sprytextarea5">
        <textarea name="MESAJ_SERVIS_KAPALI" class="form-control" cols="30" rows="3"><?php if($row_KioskAyar['MESAJ_SERVIS_KAPALI']!=""){ echo $row_KioskAyar['MESAJ_SERVIS_KAPALI'];} else { echo "Servis Kapalı"; } ?></textarea>
        <span id="countsprytextarea5">&nbsp;</span><span class="textareaMaxCharsMsg">Maksimum karakter sayısı aşıldı.</span></span>
	</td>
      <td colspan="2">       
      <table class="table">
        <tr>
          <th colspan="2">Bilet Basma Aralığı(sn):
           </th>
            <td colspan="4"> <input class="form-control" type="number" min="1" max="100" name="GECIKME" value="<?php if($row_KioskAyar['GECIKME']!=""){echo $row_KioskAyar['GECIKME'];}else { echo 1; } ?>" size="32"></td>
          </tr>
        <tr>
          <th>Aktif:</th>
          <td><label class="switch"><input class="form-control" type="checkbox" name="AKTIF" <?php if($row_KioskAyar['AKTIF']=='1'){ echo "checked"; }?>><span class="slider round"></span></label></td>
          <th>Web Randevu?</th>
          <td><label class="switch"><input class="form-control" type="checkbox" name="WebdenRandevu" <?php if($row_KioskAyar['WebdenRandevu']=='1'){ echo "checked"; }?>><span class="slider round"></span></label></td>
          <th>BarkodlaEtiket:</th>
          <td><label class="switch">
            <input class="form-control" type="checkbox" name="BarkodlaEtiket" <?php if ($row_KioskAyar['BarkodlaEtiket']=='1') {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
          </tr>
    </table></td>
    </tr>
    </table>
	</div>  
</div>
</div>    
  <div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">2-Kiosk Tasarım Bilgileri</div>
  <div class="panel body table-responsive">
    <table class="table table-hover">
    <tr valign="baseline">
      <th > Kayan Yazı Başlık Fontu:</th>
      <td ><select class="form-control" name="FONT">
        <?php
foreach($row_Fontlar as $row_Fontlar){  
?>
        <option style="font-family:<?php echo $row_Fontlar['FONT']; ?>" value="<?php echo $row_Fontlar['FONT']?>"<?php if (!(strcmp($row_Fontlar['FONT'], htmlentities($row_KioskAyar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "selected=\"selected\"";} ?>><?php echo $row_Fontlar['FONT']?></option>
        <?php
  }
?>
      </select></td>
      <th>&nbsp;</th>
      <td >&nbsp;</td>
	</tr>
    <tr valign="baseline">
      <th >Yazı Punto:</th>
      <td ><input class="form-control" type="number" min="1" max="100" name="PUNTO" value="<?php if($row_KioskAyar['PUNTO']!=""){echo $row_KioskAyar['PUNTO'];}else{ echo 30; } ?>" size="32">
        </td>
      <th >&nbsp;</th>
      <td >&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th >Yazı Rengi:</th>
      <td ><input type="text" class="form-control jscolor" name="YAZI_RENGI" value="<?php echo dechex($row_KioskAyar['YAZI_RENGI']); ?>" size="32"></td>
      <th >Arka Plan Rengi:</th>
      <td ><input type="text" class="form-control jscolor" name="RENK" value="<?php echo substr(signed2hex($row_KioskAyar['RENK']),2,6); ?>" size="32"></td> 
	 </tr>
    <tr valign="baseline">
      <th >Başlık Kaysın mı?</th>
      <td ><label class="switch">
        <input type="checkbox" name="BASLIK_KAY" <?php if ($row_KioskAyar['BASLIK_KAY']==1) {echo "checked=\"checked\"";} ?>>
        <span class="slider round"></span></label></td>
      <th >Alt Başlık Kaysın mı?</th>
      <td ><label class="switch">
        <input type="checkbox" name="ALT_BASLIK_KAY" <?php if ($row_KioskAyar['ALT_BASLIK_KAY']==1) {echo "checked=\"checked\"";} ?>>
        <span class="slider round"></span></label></td>
    </tr>
    <tr valign="baseline">
      <th >Başlık Kayma Hızı:</th>
      <td ><input type="number"class="form-control  min="1" max="100" name="HIZ_BASLIK" value="<?php if($row_KioskAyar['HIZ_BASLIK']!=""){echo $row_KioskAyar['HIZ_BASLIK'];}else{ echo 1; } ?>" size="32">
        ms </td>
      <th >Alt Başlık Kayma Hızı:</th>
      <td ><input type="number" class="form-control min="1" max="100" name="HIZ_ALT_BASLIK" value="<?php if($row_KioskAyar['HIZ_ALT_BASLIK']!=""){echo $row_KioskAyar['HIZ_ALT_BASLIK'];}else{ echo 1; } ?>" size="32">
        ms </td>
    </tr>
    <tr valign="baseline">
      <th >Başlık Kayma Yönü:</th>
      <td >
	  <table>
        <tr>
          <td>Sola Kaysın</td>
          <td>Sağa Kaysın</td>
          </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="YON_BASLIK" value="0" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_BASLIK'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";}else if ($row_KioskAyar['YON_BASLIK']=="") {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="YON_BASLIK" value="1" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_BASLIK'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
          </tr>
      </table>
	  </td>
      <th>Alt Başlık Kayma Yönü:</th>
      <td>
	  <table>
        <tr>
          <td>Sola Kaysın</td>
          <td>Sağa Kaysın</td>
        </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="YON_ALT_BASLIK" value="0" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_ALT_BASLIK'], ENT_COMPAT, 'utf-8'),0))) {echo "checked=\"checked\"";}else if ($row_KioskAyar['YON_ALT_BASLIK']=="") {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="YON_ALT_BASLIK" value="1" <?php if (!(strcmp(htmlentities($row_KioskAyar['YON_ALT_BASLIK'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
            <span class="slider"></span></label></td>
        </tr>
      </table>
	  </td>
    </tr>
    </table>
    </div>
    </div>
	</div>
  <div class="panel body table-responsive" style="overflow:auto;">
   <table class="table table-hover">
    <tr class="warning">
      <th valign="baseline">Kiosk Ekran Resmi:</th>
      <td><div class="responsive" style="width:200px"><p>
        <input type="file" name="RESIM" value="" accept="image/*" size="32" >        
        <?php 
	  $img=base64_encode($row_KioskAyar['RESIM']);	  	    ?>
        <img class="img-responsive"  src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/>
        <input type="hidden" name="RESIM_AD" value="<?php if(isset($_GET['KioskEkle']) and  empty($row_KioskAyar['KID'])){ echo time(); }else { echo time(); }?>" size="32">
        <input type="hidden" name="ESKI_RESIM_AD" value="<?php echo $row_KioskAyar['RESIM_AD']; ?>" size="32">
      </p></div></td>
      <th>Kiosk Resim Yerleşim Planı:</th>
      <td>
	  <table class="table table-bordered table-hover">
        <tr>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="1" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="2" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="4" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),4))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
        </tr>
        <tr>
          <td>Üst Sol</td>
          <td>Üst Orta</td>
          <td>Üst Sağ</td>
        </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="16" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),16))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="32" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),32))) {echo "checked=\"checked\"";}else if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),""))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="64" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),64))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
        </tr>
        <tr>
          <td>Orta Sol</td>
          <td>Tam Orta</td>
          <td>Orta Sağ</td>
        </tr>
        <tr>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="256" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),256))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="512" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),512))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
          <td><label class="switch">
            <input type="radio" name="RESIM_YON" value="1024" <?php if (!(strcmp(htmlentities($row_KioskAyar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1024))) {echo "checked=\"checked\"";} ?>>
            <span class="slider round"></span></label></td>
        </tr>
        <tr>
          <td>Alt Sol</td>
          <td>Alt Orta</td>
          <td>Alt Sağ</td>
        </tr>
      </table>
	  </td>
      </tr>
 </table>
 </div>
 <div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">3-Etiket Tasarım Bilgileri</div>
  <div class="panel body table-responsive">
 <table class="table table-hover">
    <tr valign="baseline">
      <th>Etiket Yükseklik</th>
      <th>Etiket Ön İzleme Süresi</th>
      <th>Rulo Etiket Adeti:</th>
      <td><input type="number" class="form-control" min="0" max="1000" name="TotalTag" value="<?php if($row_KioskAyar['TotalTag']!=""){ echo $row_KioskAyar['TotalTag'];}else {echo 1;} ?>" ></td>
    </tr>
    <tr valign="baseline">
      <td><input type="number" class="form-control" min="1" max="9999" name="TagPreviewHeight" value="<?php if($row_KioskAyar['TagPreviewHeight']!=""){echo $row_KioskAyar['TagPreviewHeight'];}else { echo 250;} ?>" ></td>
      <td><input type="number" class="form-control" min="1" max="9999" name="TagPreviewTimerInterval" value="<?php if($row_KioskAyar['TagPreviewTimerInterval']!=""){echo $row_KioskAyar['TagPreviewTimerInterval']; }else { echo 1000; }?>" >sn </td>
      <th>Maks. Rulo Etiket Adeti:</th>
      <td><input type="number" class="form-control" min="0" max="1000" name="MaxTotalTag" value="<?php if($row_KioskAyar['MaxTotalTag']!=""){echo $row_KioskAyar['MaxTotalTag'];}else{echo 500;} ?>" ></td>
      </tr>
    <tr valign="baseline">
      <th>Etiket Genişlik</th>
      <th>Etiket Ön İzleme Yakınlaştırma Oranı</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td><input type="number" class="form-control" min="1" max="9999" name="TagPreviewWidth" value="<?php if($row_KioskAyar['TagPreviewWidth']!=""){echo $row_KioskAyar['TagPreviewWidth'];}else{echo 200;} ?>" ></td>
      <td><input type="number" class="form-control" min="0" max="2" step="0.01" name="TagPreviewZoom" value="<?php if($row_KioskAyar['TagPreviewZoom']!=""){ echo floatval($row_KioskAyar['TagPreviewZoom']); }else{echo 0.9;} ?>" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
   </table>
   </div>
   </div>
   </div>
 
 <div class="form-group">
  <div class="panel panel-red">
  <div class="panel panel-heading">4-Diğer Bilgiler</div>
  <div class="panel body table-responsive">
   <table class="table table-hover">
    <tr valign="baseline">
      <th valign="baseline">Sorumlu Personel</th>
      <td style="min-width:200px">
        <select class="form-control" name="TagOverFlowPerId">
          <?php 
foreach($row_Personel as $row_Personel) {
?>
          <option value="<?php echo $row_Personel['PID']?>" <?php if (!(strcmp($row_Personel['PID'], htmlentities($row_KioskAyar['TagOverFlowPerId'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_Personel['AD']?></option>
          <?php
} 
?>
          </select>
        </td>
      <td>&nbsp;</td>
      <td style="min-width:200px">&nbsp;</td>
	</tr>
    <tr valign="baseline">
      <th valign="baseline">Bitik Etiket Mesajı:</th>
      <td><input class="form-control" type="text" maxlength="100" name="TagOverFlowMessage" value="<?php if($row_KioskAyar['TagOverFlowMessage']!=""){echo $row_KioskAyar['TagOverFlowMessage'];}else {echo "Kağıt Bitti";} ?>" size="32">
      </td>
      <th>Bekleme Suresi Metni:</th>
      <td><input class="form-control" type="text" maxlength="100" name="BeklemeSuresiMetni" value="<?php if($row_KioskAyar['BeklemeSuresiMetni']!=""){echo $row_KioskAyar['BeklemeSuresiMetni']; } else {echo "Lütfen Bekleyiniz"; } ?>" size="32"></td>
      </tr>
    <tr valign="baseline">
      <th valign="baseline">Alt Buton Suresi(sn):</th>
      <td><input class="form-control" type="number" min="1" max="500" name="AltButonSuresi" value="<?php if($row_KioskAyar['AltButonSuresi']!=""){echo ($row_KioskAyar['AltButonSuresi'])/1000;}else { echo 3;} ?>" size="32"></td>
      <th>Etiket Sıfırlama şifresi:</th>
      <td><span id="sprytextfield1">
      <input name="EtiketSifirlamasifresi" type="text" class="form-control" value="<?php if($row_KioskAyar['EtiketSifirlamasifresi']!=""){ echo $row_KioskAyar['EtiketSifirlamasifresi'];}else { echo 1234; } ?>" size="32" maxlength="11">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format.Sadece sayı</span></span></td>
      </tr>
    <tr valign="baseline">
      <th valign="baseline">Sol Buton Adeti:</th>
      <td><input class="form-control" type="number" min="1" max="100"  name="SOL_BTN_ADET" value="<?php if($row_KioskAyar['SOL_BTN_ADET']!=""){echo $row_KioskAyar['SOL_BTN_ADET'];}else {echo 1;} ?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">Sağ Buton Adeti:</th>
      <td><input class="form-control" type="number" min="1" max="100" name="SAG_BTN_ADET" value="<?php if($row_KioskAyar['SAG_BTN_ADET']!=""){ echo $row_KioskAyar['SAG_BTN_ADET'];} else {echo 1; } ?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">Sol Boşluk:</th>
      <td><input class="form-control" type="number" min="1" max="100" name="SOL_PADDING" value="<?php if($row_KioskAyar['SOL_PADDING']!=""){ echo $row_KioskAyar['SOL_PADDING']; } else{ echo 1; }?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">Sağ Boşluk:</th>
      <td><input class="form-control" type="number" min="1" max="100" name="SAG_PADDING" value="<?php if($row_KioskAyar['SAG_PADDING']!="") {echo $row_KioskAyar['SAG_PADDING'];} else { echo 1;} ?>" size="32">
        yok </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <th valign="baseline">&nbsp;</th>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" valign="baseline"><?php if(isset($_GET['KioskEkle']) and  empty($row_KioskAyar['KID']) and isset($_GET['Kiosk'])){?>
        <input class="form-control btn btn-success" type="submit" value="Yeni Kiosk Ekle">
        <input type="hidden" name="KID" value="<?php echo $_GET['Kiosk']; ?>">
        <input type="hidden" name="MM_insert" value="form1">
        <?php } else if(isset($_GET['Kiosk']) and  !empty($row_KioskAyar['KID'])){?>    
        <input type="submit" class="form-control btn btn-primary" value="Kiosk Güncelleştir">
        <input type="hidden" name="MM_update" value="form2">
        <input type="hidden" name="KID" value="<?php echo $row_KioskAyar['KID']; ?>">
        <?php } ?></td>
      </tr>
  </table>
  </div>
  </div>
  </div>
</form>
<?php
	} //form göster gizle bitiş
	?>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"], maxChars:200, counterId:"countsprytextarea1", counterType:"chars_remaining"});
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2", {maxChars:200, isRequired:false, validateOn:["blur", "change"], counterId:"countsprytextarea2", counterType:"chars_remaining"});
var sprytextarea3 = new Spry.Widget.ValidationTextarea("sprytextarea3", {maxChars:50, validateOn:["blur", "change"], counterId:"countsprytextarea3", counterType:"chars_remaining", isRequired:false});
var sprytextarea4 = new Spry.Widget.ValidationTextarea("sprytextarea4", {maxChars:50, isRequired:false, validateOn:["blur", "change"], counterId:"countsprytextarea4", counterType:"chars_remaining"});
var sprytextarea5 = new Spry.Widget.ValidationTextarea("sprytextarea5", {validateOn:["blur", "change"], isRequired:false, maxChars:50, counterId:"countsprytextarea5", counterType:"chars_remaining"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur", "change"], useCharacterMasking:true});
</script>
