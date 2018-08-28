<?php
include("db.php");
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
include("ayar/config/config1.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>OMES LCD</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kiosk Browser">
    <meta name="author" content="EKOMURCU">
	  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oxygen:400,300,700">
    <link rel="shortcut icon" href="dist/img/ico/favicon.ico">
	 <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet"> 
    <script src="dist/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
  function updateContent() {
	$.get("BeklemeListesiSet.php", function(data, status){
        $('#bekleyenler').html(data);
    });
	$.get("Cagrilar.php", function(data, status){
        $('#cagrilar').html(data);
    });		
}
var a=1;//setReset icin
function updateBiletAlert() {
	
	if(a)
	{
		$('#bilet1').css({"background":"<?php echo "#".substr(signed2hex($animasyonArkaplanRenk),2,6); ?>","color":"<?php echo "#".substr(signed2hex($animasyonRenk),2,6); ?>"});
		a=0;
	}else{
		$('#bilet1').css({"background":"<?php echo "#".substr(signed2hex($animasyonRenk),2,6); ?>","color":"<?php echo "#".substr(signed2hex($animasyonArkaplanRenk),2,6); ?>"});
		a=1;
	}
	
	
}
updateContent(); updateBiletAlert();
setInterval(updateContent, <?php echo $sayfaYinelemeSuresi; ?>);
var animasyonDurum=<?=$animasyonDurum ?>;
if(animasyonDurum)
{
	setInterval(updateBiletAlert, <?php echo $animasyonSure; ?>);
}
	


});
</script>
	<style type="text/css">
body{
	margin:0px;
	padding:0px;
	background-color:<?php echo "#".substr(signed2hex($LCDFormArkaplanRenk),2,6); ?>;
	overflow-x: hidden;
}
#baslik{	
	width:100%;
	font-family:<?php echo $KayanYaziFont; ?>;
	font-size:<?php echo $KayanYaziPunto; ?>pt;
	color:<?php echo "#".substr(signed2hex($KayanYaziRenk),2,6); ?>;
	background-color:<?php echo "#".substr(signed2hex($KayanYaziArkaPlanRenk),2,6); ?>;
}
#alt_baslik{	
	position:fixed;
	width:100%;	bottom:0px;	right:0px;
	font-family:<?php echo $KayanYaziFont; ?>;
	font-size:<?php echo $KayanYaziPunto; ?>pt;
	color:<?php echo "#".substr(signed2hex($KayanYaziRenk),2,6); ?>;
	background-color:<?php echo "#".substr(signed2hex($KayanYaziArkaPlanRenk),2,6); ?>;
}
#bekleyenler
{
	width:100%;
	font-family:<?php echo $bekleyenFont; ?>;
	font-size:<?php echo $bekleyenPunto; ?>pt;
	color:<?php echo "#".substr(signed2hex($bekleyenRenk),2,6); ?>;
	background-color:<?php echo "#".substr(signed2hex($bekleyenArkaPlanRenk),2,6); ?>;
}
#cagrilar
{
	width:100%;
	font-family:<?php echo $SutunFont; ?>;
	font-size:<?php echo $SutunPunto; ?>pt;
	color:<?php echo "#".substr(signed2hex($SutunRenk),2,6); ?>;
	background-color:<?php echo "#".substr(signed2hex($SutunArkaplanRenk),2,6); ?>;
}
.sutunlar
{
	/* Cagrilar.php içinde */
	font-style:<?php echo $SutunYaziOzellik; ?>;
	font-weight:<?php echo $SutunYaziKalinlik; ?>;
}
.nopadding {
   padding: 0 !important;
   
}
</style>
</head>
<body onLoad="digitalsaat();">
	  <div class="container-fluid">
	  	<div class="row">
		<div class="col-md-3 nopadding">
		<?php include("saat/saat.html"); ?>
		</div>
		<div class="col-md-9 nopadding">
		<?php if($UstBaslikKaysin){ ?>
		<marquee 
			id="baslik" 
			direction="<?php if($UstBaslikYon){ echo "right"; }else{ echo "left"; } ?>" 
			scrollamount="<?php echo $UstBaslikHiz; ?>" 
			scrolldelay="<?php echo $UstBaslikHiz; ?>">
			<?php echo $UstBaslik; ?>
		</marquee>
		</div>
		<?php }else{?>
		<div id="baslik" class="text-center"><?php echo $UstBaslik; ?></div></div>
		<?php } ?>
			<div class="row">
				<div class="col-md-6">
				<span id="cagrilar"></span>
				</div>
				<div class="col-md-6">
				<span id="bekleyenler"></span>
				</div>
			</div>
		<div class="row">
		<div class="col-md-12">
		<?php if($AltBaslikKaysin){ ?>
		<marquee 
			id="alt_baslik" 
			direction="<?php if($AltBaslikYon){ echo "right"; }else{ echo "left"; } ?>" 
			scrollamount="<?php echo $AltBaslikHiz; ?>" 
			scrolldelay="<?php echo $AltBaslikHiz; ?>">
			<?php echo $AltBaslik; ?>
		</marquee>
		
		<?php }else {?>
		<div id="alt_baslik" class="text-center"><?php echo $AltBaslik; ?></div>
		</div></div>
		</div>
		<?php } ?>
	
</body>
</html>