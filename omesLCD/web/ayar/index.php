<?php 
error_reporting(0);
if(isset($_POST) && isset($_POST['kaydet']))
{
		@($_POST['animasyonDurum']==true)?$_POST['animasyonDurum']='true':$_POST['animasyonDurum']='false';
$string="<?php
$"."EkranNo='".$_POST['EkranNo']."';
$"."UstBaslik='".$_POST['UstBaslik']."';
$"."AltBaslik='".$_POST['AltBaslik']."';
$"."VideoURL='".$_POST['VideoURL']."';
$"."SesURL='".$_POST['SesURL']."';
$"."PORT_Gonderici='".$_POST['PORT_Gonderici']."';
$"."PORT_Alici='".$_POST['PORT_Alici']."';
$"."DefaultFormID='".$_POST['DefaultFormID']."';
$"."AnatabloID='".$_POST['AnatabloID']."'; //BeklemeListesiSet.php 
$"."ClientIP='".$_POST['ClientIP']."';
$"."OtoIP='".$_POST['OtoIP']."';
$"."KayanYaziFont='".$_POST['KayanYaziFont']."';
$"."KayanYaziPunto='".$_POST['KayanYaziPunto']."';
$"."KayanYaziRenk='".hexdec('FF'.$_POST['KayanYaziRenk'])."';
$"."KayanYaziArkaPlanRenk='".hexdec($_POST['KayanYaziArkaPlanRenk'])."';
$"."Sutun1='".$_POST['Sutun1']."';
$"."Sutun2='".$_POST['Sutun2']."';
$"."SutunRenk='".hexdec($_POST['SutunRenk'])."';
$"."SutunYaziOzellik='".$_POST['SutunYaziOzellik']."'; // italic,  regular cagrilar için başlık stili
$"."SutunYaziKalinlik='".$_POST['SutunYaziKalinlik']."'; // 100-900
$"."LCDArkaplanRenk='".hexdec($_POST['LCDArkaplanRenk'])."';
$"."UstBaslikKaysin='".$_POST['UstBaslikKaysin']."';
$"."AltBaslikKaysin='".$_POST['AltBaslikKaysin']."';
$"."UstBaslikYon='".$_POST['UstBaslikYon']."';
$"."AltBaslikYon='".$_POST['AltBaslikYon']."';
$"."UstBaslikHiz='".$_POST['UstBaslikHiz']."';
$"."AltBaslikHiz='".$_POST['AltBaslikHiz']."';
$"."LCDFormArkaplanRenk='".hexdec($_POST['LCDFormArkaplanRenk'])."';
$"."CagNoFont='".$_POST['CagNoFont']."';
$"."CagNoRenk='".hexdec($_POST['CagNoRenk'])."';
$"."CagNoPunto='".$_POST['CagNoPunto']."';
$"."SaatYukseklik='".$_POST['SaatYukseklik']."';
$"."TvKaynak='".$_POST['TvKaynak']."';
$"."TvKaynakIndex='".$_POST['TvKaynakIndex']."';
$"."TvKanal='".$_POST['TvKanal']."';
$"."ServerIP='".$_POST['ServerIP']."';
$"."MediaTipi='".$_POST['MediaTipi']."';
$"."WebBrowserUrl='".$_POST['WebBrowserUrl']."';
$"."CagNoPuntoTekSatir='".$_POST['CagNoPuntoTekSatir']."';
$"."Ses='".$_POST['Ses']."';
$"."SatirSayisi='".$_POST['SatirSayisi']."';
$"."dbUserName='".$_POST['dbUserName']."';
$"."dbPassword='".$_POST['dbPassword']."';
$"."dbName='".$_POST['dbName']."';
//..........ertu
$"."bekleyenler_metni='".$_POST['bekleyenler_metni']."';
$"."biletno_metni='".$_POST['biletno_metni']."';
$"."bekleyenFont='".$_POST['bekleyenFont']."';
$"."bekleyenPunto='".$_POST['bekleyenPunto']."';
$"."bekleyenRenk='".hexdec($_POST['bekleyenRenk'])."';
$"."bekleyenArkaPlanRenk='".hexdec($_POST['bekleyenArkaPlanRenk'])."';
$"."saatFont='".$_POST['saatFont']."';
$"."saatPunto='".$_POST['saatPunto']."';
$"."saatRenk='".hexdec($_POST['saatRenk'])."';
$"."saatArkaplanRenk='".hexdec($_POST['saatArkaplanRenk'])."';
$"."SutunPunto='".$_POST['SutunPunto']."';
$"."SutunFont='".$_POST['SutunFont']."';
$"."SutunArkaplanRenk='".hexdec($_POST['SutunArkaplanRenk'])."';
$"."animasyonDurum='".$_POST['animasyonDurum']."';
$"."animasyonRenk='".hexdec($_POST['animasyonRenk'])."';
$"."animasyonArkaplanRenk='".hexdec($_POST['animasyonArkaplanRenk'])."';
$"."animasyonSure='".$_POST['animasyonSure']."';
$"."sayfaYinelemeSuresi='".(($_POST['sayfaYinelemeSuresi'])*1000)."';

?>";
$klasor="config";
$dosya="config1.php";
$yol=$klasor."/".$dosya;
if(!file_exists($klasor))
{
	if(mkdir($klasor,700))
	{
		
		if(!file_exists($yol))
		{
			if(touch($yol))
			{
				$kaynak=fopen($yol,"w");
				$fwrite($kaynak,$string);
				fclose($kaynak);
			}
		}
	}
}
else
	{
		if(touch($yol))
			{
				$kaynak=fopen($yol,"w");
				fwrite($kaynak,$string);
				fclose($kaynak);
			}
	}
}
?>
<?php 
//veritabanından okurken bunu kullan
function signed2hex($value, $reverseEndianness = false) //4bayt FF,FF,FF,FF şeklinde argb değerini elde etmek için
{
    $packed = pack('N', $value);
    $hex='';
    for ($i=0; $i < 4; $i++){
        $hex .= strtoupper( str_pad( dechex(ord($packed[$i])) , 2, '0', STR_PAD_LEFT) );
    }
    $tmp = str_split($hex, 2);
    $out = implode('', ($reverseEndianness ? array_reverse($tmp) : $tmp));
    return $out;
}
 include("config/config1.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>LCD PANO Ayarları</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <script src="../dist/js/jscolor.js"></script>
<link rel="stylesheet" href="../dist/css/style.css">
<link rel="shortcut icon" href="../dist/img/ico/favicon.ico">
	</style>
</head>
<body>
<div class="container">
  <div class="jumbotron alert alert-success">
    <h2>LCD Ayarları (BETA)</h2>      
    <p>Bu arayüz sayesinde LCD panel özelliklerini değiştirebilirsiniz.</p>
  </div>
<form name="form1" method="post" action="" enctype="multipart/form-data">
   
  <ul class="nav nav-tabs nav nav-pills">
    <li class="active"><a data-toggle="tab" href="#lcd">LCD AYARLARI</a></li>
    <li><a data-toggle="tab" href="#form">FORM AYARLARI</a></li>
    <li><a data-toggle="tab" href="#sunucu">SUNUCU AYARLARI</a></li>
  </ul>

  <div class="tab-content">
    <div id="lcd" class="tab-pane fade in active">
       <?php include("siteParts/lcdAyar.php"); ?>
    </div>
    <div id="form" class="tab-pane fade">
      <?php include("siteParts/formAyar.php"); ?>
  </div>
    <div id="sunucu" class="tab-pane fade">
      <?php include("siteParts/sunucuAyar.php"); ?>
   </div>

</div>

  <div id="mySidenav">
  <div id="kaydet">
  <input class="btn btn-success" type="submit" value="Kaydet" name="kaydet">
  </div>  
  </div>
</form>
	<div class="well">Geliştirici EKOMURCU</div>
</div>
</body>
</html>