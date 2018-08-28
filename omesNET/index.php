<!DOCTYPE HTML>
<html lang="en">
<!-- InstanceBegin template="/Templates/sablon.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<title>Omes Web</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Kiosk, Bilet, Sıramatik Sistemleri">
<meta name="author" content="E.KÖMÜRCÜ">
<link rel="shortcut icon" href="dist/img/ico/favicon.ico">
<!-- Bootstrap core CSS -->
<script src="dist/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="dist/js/bootstrap.min.js" type="text/javascript"></script>   
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template Toggle chekbox -->
<link href="dist/css/CustomToggleStyle.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="dist/css/main.css" rel="stylesheet">
<!-- JsColor Selector -->
<script src="dist/js/jscolor.js"></script>
<link href="dist/css/tooltip.css" rel="stylesheet"><!-- omes -->
<link href="dist/css/girisModal.css" rel="stylesheet">
<link href="dist/css/yonetim.css" rel="stylesheet"><!-- omes -->
<script src="fonksiyonlar/js/kontrol.js" type="text/javascript"></script><!--dinamik kontroller -->
<script src="fonksiyonlar/js/jquery.maskedinput.js" type="text/javascript"></script><!-- masked  phone -->
<script src="fonksiyonlar/js/maskele.js" type="text/javascript"></script><!-- masked  phone -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
		<!-- FlipClock CountDown-->
	<link rel="stylesheet" href="dist/plugin/FlipClock/compiled/flipclock.css">
	<script src="dist/plugin/FlipClock/compiled/flipclock.js" type="text/javascript"></script>	
	<!-- FlipClock CountDown-->
	
	<!-- SpryAssets validation all-->
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css">


<!-- SpryAssets validation all-->
<style>
/* datatables butonları için */
.btn-group {
  display: flex;
max-width:100px;
} 
</style>	
				
</head>
<body data-spy="scroll" data-target=".navbar" >
<div class="container-fluid" >

<?php //veritabanı baglantısı
require_once('Connections/baglantim.php'); ?>
<div class="container">
<?php //Static navbar
require_once"menu/ustMenu.php"; ?>    
<!-- InstanceBeginEditable name="icerik" -->
<?php //ön yükleme animasyonu
include('preloader.php'); ?>
<?php 
if(isset($_SESSION["MM_Username"]))
{
	if(isset($_GET["SistemAyarlari"]))
	{
		include("SistemAyarlari/Guncelle.php");
	}
	else if(isset($_GET["SistemAyarSil"]))
	{
		include("SistemAyarlari/Sil.php");
	}
	else if(isset($_GET["GrupListele"]))
	{
		include("Gruplar/Listele.php");
	}
	else if(isset($_GET["GrupEkle"]))
	{
		include("Gruplar/Ekle.php");
	}
	else if(isset($_GET["GrupGuncelle"]))
	{
		include("Gruplar/Guncelle.php");
	}
	else if(isset($_GET["GrupSil"]))
	{
		include("Gruplar/Sil.php");
	}
	else if(isset($_GET["TerminalListele"]))
	{
		include("Terminaller/Listele.php");
	}
	else if(isset($_GET["TerminalEkle"]))
	{
		?>
		<div class="row">
		<div class="col-md-6"> 
		<?php
		include("Terminaller/Ekle.php");	
		?>
	</div>
		<div class="col-md-6">
		<?php
		include("TerminalGrup/Ekle.php");
		?>
		</div></div>
		<?php
		include("Terminaller/Listele.php");
		
	}
	else if(isset($_GET["TerminalGuncelle"]))
	{
		include("Terminaller/Guncelle.php");
	}
	else if(isset($_GET["TerminalSil"]))
	{
		include("Terminaller/Sil.php");
	}
	else if(isset($_GET["TerminalGrupListele"]))
	{
		include("TerminalGrup/Listele.php");
	}
	else if(isset($_GET["TerminalGrupGuncelle"]))
	{
		include("TerminalGrup/Guncelle.php");
	}
	else if(isset($_GET["TerminalGrupEkle"]))
	{
		include("TerminalGrup/Ekle.php");
	}
	else if(isset($_GET["TerminalGrupSil"]))
	{
		include("TerminalGrup/Sil.php");
	}
	else if(isset($_GET["BiletMakinesiEkle"]))
	{
		?>   
		<div class="row">
		<div class="col-md-6"> 
		<?php
		include("BiletMakinesi/Ekle.php");
		?></div>
		<div class="col-md-6">
		<?php
		include("BiletMakinesi/Listele.php");
		?></div></div>
		<?php
	}
	else if(isset($_GET["BiletMakinesiSil"]))
	{
		include("BiletMakinesi/Sil.php");
	}
	else if(isset($_GET["BiletMakinesiGuncelle"]))
	{
		?>   
		<div class="row">
		<div class="col-md-6"> 
		<?php
		include("BiletMakinesi/Guncelle.php");
		?></div>
		<div class="col-md-6">
		<?php
		include("BiletMakinesi/Listele.php");
		?></div></div>
		<?php
	}
	else if(isset($_GET["AnaButonEkle"]))
	{
		include("AnaButon/Ekle.php");
		include("AnaButon/Listele.php");
	}
	else if(isset($_GET["AnaButonListele"]))
	{
		include("AnaButon/Listele.php");
	}
	else if(isset($_GET["AnaButonGuncelle"]))
	{
		include("AnaButon/Guncelle.php");
		include("AnaButon/Listele.php");
	}
	else if(isset($_GET["AnaButonDetay"]))
	{
		include("AnaButon/Detay.php");	
	}
	else if(isset($_GET["AnaButonSil"]))
	{
		//Ana Buton silinince alt butonlarında silinmesi gerekecek, bu nedenle şimdilik silme işlemi yapmadım. 09.08.2017
		include("AnaButon/Sil.php");	
	}
	else if(isset($_GET["AltButonEkle"]))
	{
		include("AltButon/Ekle.php");	
		include("AltButon/Listele.php");
	}
	else if(isset($_GET["AltButonGuncelle"]))
	{
		include("AltButon/Guncelle.php");	
		include("AltButon/Listele.php");
	}
	else if(isset($_GET["AltButonListele"]))
	{		
		include("AltButon/Listele.php");
	}
	else if(isset($_GET["AltButonDetay"]))
	{
		include("AltButon/Detay.php");	
	}
	else if(isset($_GET["AltButonSil"]))
	{
		include("AltButon/Sil.php");	
	}
	else if(isset($_GET["KioskEkle"]))
	{
		include("Kiosk/Ekle.php");	
	}
	else if(isset($_GET["KioskSil"]))
	{
	include("Kiosk/Sil.php");	
	}
	else if(isset($_GET["BiletEkle"]))
	{
		include("Bilet/Ekle.php");	
	}
	else if(isset($_GET["BiletSil"]))
	{
		include("Bilet/Sil.php");	
	}
	else if(isset($_GET["Personel"]))
	{
		include("Personel/Listele.php");	
	}
	else if(isset($_GET["PersonelEkle"]))
	{
		include("Personel/Ekle.php");	
	}
	else if(isset($_GET["PersonelGuncelle"]))
	{
		include("Personel/Guncelle.php");	
	}
	else if(isset($_GET["PersonelSil"]))
	{
	include("Personel/Sil.php");	
	}
	else if(isset($_GET["AnaTabloListele"]))
	{
		include("AnaTablolar/Listele.php");	
	}
	else if(isset($_GET["AnaTabloEkle"]))
	{
		include("AnaTablolar/Ekle.php");
		include("AnaTablolar/Listele.php");	
	}
	else if(isset($_GET["AnaTabloGuncelle"]))
	{
		include("AnaTablolar/Guncelle.php");
		include("AnaTablolar/Listele.php");	
	}
	else if(isset($_GET["AnaTabloSil"]))
	{
		include("AnaTablolar/Sil.php");	
	}
	else if(isset($_GET["AnaTabloYonListele"]))
	{
		include("AnaTabloYon/Listele.php");	
	}
	else if(isset($_GET["AnaTabloYonEkle"]))
	{
		include("AnaTabloYon/Ekle.php");
		include("AnaTabloYon/Listele.php");	
	}
	else if(isset($_GET["AnaTabloYonGuncelle"]))
	{
		include("AnaTabloYon/Guncelle.php");
		include("AnaTabloYon/Listele.php");	
	}
	else if(isset($_GET["AnaTabloYonSil"]))
	{
		include("AnaTabloYon/Sil.php");
		include("AnaTabloYon/Listele.php");	
	}
	else if(isset($_GET["WebRandevu"]))
	{
		include("WebRandevu/index.php");	
	}
	else
	{
		include("icerik/istatistik.php");
	}
}
else
{
	include("icerik/istatistik.php");
}
?>
<?php include("fonksiyonlar/php/getRealip.php"); ?>

<div style="margin-top:30px">
<span class='label label-warning'>Local IP:</span>
<span class='label label-success'><?php echo getRealIpAddr(); ?></span>
<span class='label label-info'>Çıkış Ip:</span>
<span class='label label-danger'><?php echo gethostbyname(gethostname()); ?></span>
</div>
<!-- InstanceEndEditable -->
<p></p><p></p>
	<div id="footer" class="well" style="margin-top:20px"> 
	
			<p class="text-muted credit"><?php echo base64_decode("R0VMxLDFnlTEsFLEsEPEsCA8YSBocmVmPScjJz5FLkvDlk3DnFJDw5w8L2E+"); ?></p>	
    </div>
</div> 
<!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
<link rel="stylesheet" type="text/css" href="dist/plugin/datatables/datatables.min.css"/>
 
<script type="text/javascript" src="dist/plugin/datatables/pdfmake.min.js"></script>
<script type="text/javascript" src="dist/plugin/datatables/vfs_fonts.js"></script>
<script type="text/javascript" src="dist/plugin/datatables/datatables.min.js"></script>
<script type="text/javascript" src="dist/plugin/datatables/config.datatables.js"></script>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
});

</script>
<?php ob_end_flush(); ?>
</div>
</body>
</html>
