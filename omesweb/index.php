<!DOCTYPE HTML>
<html lang="en"><!-- InstanceBegin template="/Templates/sablon.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="dist/img/ico/favicon.ico">
        <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
<script src="dist/js/jquery-1.10.2.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template Toggle chekbox -->
    <link href="dist/css/CustomToggleStyle.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="dist/css/main.css" rel="stylesheet">
<script src="jscolor.js"></script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
 

<title>Omes Web</title>
 </head>
 
  <body>
<?php require_once('Connections/baglantim.php'); ?>
    <div class="container">

      <!-- Static navbar -->
	  <?php require_once"menu/ustMenu.php"; ?>
    
<!-- InstanceBeginEditable name="icerik" --><?php 
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
else
{
	include("icerik/istatistik.php");
	//include("icerik/thumbnail.php");
}
}
else
{
	include("icerik/istatistik.php");
	//include("icerik/thumbnail.php");
}

?>
<?php
function getRealIpAddr()  
{  
    if (!empty($_SERVER['HTTP_CLIENT_IP']))  
    {  
        $ip=$_SERVER['HTTP_CLIENT_IP'];  
    }  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //Proxy den bağlanıyorsa gerçek IP yi alır.
     
    {  
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];  
    }  
    else  
    {  
        $ip=$_SERVER['REMOTE_ADDR'];  
    }  
    return $ip;  
}  

echo "<span class='label label-warning'>Local IP:</span><span class='label label-success'>".getRealIpAddr()."</span>";

?>


<?php
$ip = "<span class='label label-info'>Çıkış Ip:</span><span class='label label-danger'>".gethostbyname(gethostname())."</span>";

echo $ip;
?>


<?php ob_end_flush(); ?><!-- InstanceEndEditable -->

<div id="footer"> 
    <div class="container">
        <p class="text-muted credit">GELİŞTİRİCİ <a href="#">E.KÖMÜRCÜ</a>.</p>
    </div>
    </div>



    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
       
  </body>
<!-- InstanceEnd --></html>
