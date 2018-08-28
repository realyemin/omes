<?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 15.04.2018
-- Description:	Kişi(tc) Bilgilerini(kontrol.php den) Ajax(tcDogrula.js) ile doğrulamak için yazıldı
-- ============================================= 
 */
 if(!isset($_SESSION))
{
	session_start();
}
if(isset($_SESSION['onay']))
	{
		$_SESSION['dogrula']=true;
	}
else { if(isset($_SESSION)){session_destroy(); unset($_SESSION['dogrula']); unset($_SESSION['oturum']); } } ?>
 <?php include("Connections/baglantim.php"); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title>Konya Büyükşehir Belediyesi Elkart Başvuru Ekranı</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="dist/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="dist/css/style.css" type="text/css" />

	<script src='dist/js/jquery-2.2.4.min.js'></script><!-- jquery -->
	<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
	<script src="fonksiyonlar/js/jquery.mask.min.js" type="text/javascript"></script>
	<script src="fonksiyonlar/js/maskele.js" type="text/javascript"></script><!-- masked  phone -->
	<script src="fonksiyonlar/js/tcdogrula.js" type="text/javascript"></script>
</head>
<body>
<?php if(isset($db)){ //bağlantı tamamsa ?>
<noscript><h1>TARAYICINIZIN JAVASCRIPT DESTEKLEDIĞINDEN EMIN OLUNUZ VEYA TARAYICI AYARLARINIZDAN AKTİF HALE GETIRINIZ.</h1>
<h2>RANDEVU ALMABİLMEK İÇİN TARAYICINIZIN JAVASCRİPT DESTEĞİNİ AÇARAK YENİDEN DENEYİNİZ!</h2></noscript>
<div class="container">
<div class="row">
   <div class="col-md-8 col-md-offset-2">
<table style="background:#fff;" class="table">
	<tr>
		<td>
<table class="table table-responsive">
	<tr><td class="ortatablo"><img class="img-responsive " src="images/komeklogo.jpg"></td></tr>
    <tr><td bgcolor="#C0C0C0" align="center" id="signup-btn"><a style="height:40px">E-Randevu</a></td></tr>
                        <tr>
                                <td>
       <table align="center" cellpadding="5" border="0">
<?php
$row_Gruplar=$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1 AND AKTIF=1")->fetchAll();
			//hem aktif hem de webrandevu olarak ayarlanmış olan grupları listele
		if(count($row_Gruplar)>0){ ?>
		
 <form method="post" name="KomekForm"> 
		<tr>
		<td align="right" class="alert alert-info">Randevu Servisi:	</td>
		<td class="alert alert-info">
			<select id="GRPID" name="GRPID" class="form-control" onChange="this.form.submit();" tabindex="1">
			<option value="0">Bir Servis Seçiniz</option>
				<?php foreach($row_Gruplar as $row_Gruplar) { ?>
					<option value="<?php echo $row_Gruplar['GRPID']; ?>"
					<?php if(isset($_POST['GRPID']) && $row_Gruplar['GRPID']==$_POST['GRPID']){ echo "selected"; } ?>
					><?php echo $row_Gruplar['GRUP_ISMI']; ?>
					</option>										
				<?php } ?>
			</select>
		</td>
		</tr>
		<?php if(isset($_POST['GRPID']) && $_POST['GRPID']!=0){ ?> 
        <tr>
		<td align="right" class="alert alert-info">T.C. Kimlik Numaranız:</td> 
			<td class="alert alert-info">
				<input type="text" style="font-size:11pt;color:#ff0000;letter-spacing:1pt;" tabindex="2"  placeholder="Örn:12345678910" required autocomplete="off" class="form-control tckimlik" id="tckimlik" name="tckimlik" maxlength="11" />
			</td>
		</tr>
		<?php if(isset($_POST['GRPID'])){ ?>  
		<?php $dogrulamaKoduGoster = $db->query("SELECT dogrulamaKoduGoster FROM RANDEVU_AYAR WHERE GRPID ='$_POST[GRPID]' ")->fetch(); ?>
		<?php if($dogrulamaKoduGoster['dogrulamaKoduGoster']){ ?>
		<tr>
			<td class="alert alert-info">Güvenlik kodu:
				<button type="button" onClick="this.form.submit();" title="Yenile"><img src="fonksiyonlar/php/capthca.php" ></button>
				<br><span style="font-size:8pt; color:red">*Büyük-Küçük harfe duyarlıdır.</span>
			</td>
			<td class="alert alert-info" >
			
				<input type="text" maxlength="5" id="dogrulamaKodu" name="dogrulamaKodu"  tabindex="3" class="form-control" placeholder="Yandaki kodu giriniz"  autocomplete="off"  >
			</td>
		</tr>
		<?php }else{ //mutlaka olması gerek dogrulamaKodu js'de tanımlı olması için ?>
		<input type="hidden" name="dogrulamaKodu" id="dogrulamaKodu" value="bos" />
		<?php } } ?>
        <tr>
			<td class="alert alert-info"></td>
			<td class="alert alert-info">				
				<button type="button" class="btn btn-primary form-control" onclick="dogrula();" name="Gonder"  tabindex="4" <?php if(empty($_POST['GRPID']) || $_POST['GRPID']==0){ echo "disabled"; } ?>>Devam</button>
			</td>
		</tr>
        <tr>
			<td colspan="2" id="uyari" width="200px"><span class="help-block alert-danger" id="mesaj"></span></td>
		</tr>
		<?php }  ?>
		</form>
		<?php } else{ ?>
					<tr><td colspan="2"><div class="alert alert-danger">Randevu Sistemi Kapalıdır veya Şuan Hizmet Vermemektedir.</div></td></tr>
		<?php } ?>
         </table>
          </td>
                        </tr>
                </table>


		</td>
	</tr>
		<tr>
		<td align="center" style="color:#a0a0a0">
			<table align="center" cellpadding="4" cellspacing="4" class="ortatablo" width="100%">
				<tr><td align="center">Konya Büyükşehir Belediyesi Bilgi İşlem Dairesi Başkanlığı © Tüm Hakları Saklıdır</td></tr>
				<tr><td>
					<table align="center">
						<tr><td><a href="index.php"><b>Kayıt Ana Sayfası</b></a></td><td width="10p" align="center">|</td><td><a href="http://konya.bel.tr" target="_blank"><b>www.konya.bel.tr</b></a></td><td width="10p" align="center">|</td></tr>
					</table>
				</td>
				</tr>
			</table>
			
		</td>
	</tr>
</table>
</div>
</div>
</div>
<?php }else{ header("Location: index.php"); } ?>
</body>
</html>