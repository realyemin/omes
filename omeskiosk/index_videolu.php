﻿<?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 08.11.2017
-- Description:	Grup Sınıfı
-- ============================================= 
 */ ?>
<?php include('db.php');?>
<?php include("Binary/Classes/DB/KioskAyar.php");?>
<?php include("Binary/Classes/TicketLayer/Grup.php");?>
<?php include("Binary/Classes/TicketLayer/BiletDB.php");?>
<?php include("Binary/Classes/TicketLayer/GrupDB.php");?>
<!DOCTYPE HTML>
<html><head>
<title><?php echo "Kiosk".$kiosk_id;?></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kiosk Browser">
    <meta name="author" content="EKOMURCU">
	  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oxygen:400,300,700">
    <link rel="shortcut icon" href="dist/img/ico/favicon.ico">
	 <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
   <script src="dist/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="jquery.print.js"></script>

<?php if($kayitvar && $Aktif){//eğer kiosk ayarları geliyorsa kiosku yükle?>
<style type="text/css">
body{
	background-color:<?php echo $renk; ?>;
	background-image:url('<?php echo $arkaplan; ?>');
	background-repeat: no-repeat;
	background-position: <?php echo $yon; ?>;
	background-attachment: fixed;
	
}
#baslik{
	text-align:center;
	position: fixed;
	top:10px;
	width:100%;
	font-family:<?php echo $font; ?>;
	font-size:<?php echo $punto; ?>pt;
	color:<?php echo $yazi_renk; ?>;
}
#alt_baslik{
	text-align:center;
	position: fixed;
	width:100%;
	bottom: 10px;	
	font-family:<?php echo $font; ?>;
	font-size:<?php echo $punto; ?>pt;
	color:<?php echo $yazi_renk; ?>;
	
}
button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

button:hover span {
  padding-right: 25px;
}

button:hover span:after {
  opacity: 1;
  right: 0;
}
button:hover
{
	 box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
#barkod{
	position: fixed;
	font-family:Arial;
	font-size:25px;
	font-weight:bold;
	z-index:5;
	background-color:<?php echo $renk; ?>;
}
</style>
</head>
<body>
<div class="content">
<?php 	if($barkodlaEtiket==1){ ?>
 <div id="barkod"><span>Lütfen Barkodunuzu Okutun:</span><input type="text" name="barkod" ></div>
 <?php } ?>
    <div class="container-fluid">
		<?php if($baslik_kaysin_mi){ ?>
		<marquee id="baslik" direction="<?php echo $baslik_yon; ?>" scrollamount="<?php echo $hiz_baslik; ?>" scrolldelay="<?php echo $hiz_baslik; ?>"><?php echo $baslik; ?></marquee>
		<?php }else{?>
		<div id="baslik"><?php echo $baslik; ?></div>
		<?php } ?>
				<?php include("buton.php"); ?>
		<?php if($alt_baslik_kaysin_mi){ ?>
		<marquee id="alt_baslik" direction="<?php echo $alt_baslik_yon; ?>" scrollamount="<?php echo $hiz_alt_baslik; ?>" scrolldelay="<?php echo $hiz_alt_baslik; ?>"><?php echo $alt_baslik; ?></marquee>
		<?php }else {?>
		<div id="alt_baslik"><?php echo $alt_baslik; ?></div>
		</div>
		<?php } ?>
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="dist/js/bootstrap.min.js"></script>
<?php }//kayıt var bitis
else if(!$kayitvar){//kiosk kaydı yoksa uyarı ver?>
</head>
<body style="background-color:black;">
<div class="jumbotron alert alert-danger"><span class="glyphicon glyphicon-cog" style="font-size:1.5em;"></span> Kiosk - Uyarı [OMES]</div>
<div class="jumbotron alert alert-info"><?php echo " Belirtilen Kiosk için ayar bunumadı! Lütfen $kiosk_id'nolu kioks kaydını kontrol ediniz."; ?></div>
<?php }else if(!$Aktif){//kiosk aktif değilse uyarı ver?>
</head>
<body style="background-color:black;">
<div class="jumbotron alert alert-danger"><span class="glyphicon glyphicon-cog" style="font-size:1.5em;"></span>Kiosk - Uyarı [OMES]</div>
<div class="jumbotron alert alert-info"><?php echo $SistemKapaliMesaji." <br>$kiosk_id'nolu kioks şuan hizmet dışıdır."; ?></div>
<?php }?>
</div>
<video id="my-video" class="video" muted loop>
  <source src="media/demo.mp4" type="video/mp4">
</video><!-- /video -->

<script>
(function() {
  /**
   * Video element
   * @type {HTMLElement}
   */
  var video = document.getElementById("my-video");

  /**
   * Check if video can play, and play it
   */
  video.addEventListener( "canplay", function() {
    video.play();
  });
})();
</script>
</body>
</html>
	