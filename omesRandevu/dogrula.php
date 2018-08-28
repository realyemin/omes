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
<!DOCTYPE html>
<html lang="en" manifest="site.appcache">
<head>
	<title><?php 
	$title="Konya Büyükşehir Belediyesi Elkart Başvuru Ekranı"; 
	echo $title; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="dist/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="dist/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="dist/css/main.css">
<!--===============================================================================================-->
	<script src="dist/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="fonksiyonlar/js/jquery.mask.min.js" type="text/javascript"></script>
	<script src="fonksiyonlar/js/maskele.js" type="text/javascript"></script><!-- masked  phone -->
	<script src="fonksiyonlar/js/tcdogrula.js" type="text/javascript"></script>
</head>
<body>
<?php if(isset($db)){ //bağlantı tamamsa ?>
<noscript>
<h1>TARAYICINIZIN JAVASCRIPT DESTEKLEDIĞINDEN EMIN OLUNUZ VEYA TARAYICI AYARLARINIZDAN AKTİF HALE GETIRINIZ.</h1>
<h2>RANDEVU ALMABİLMEK İÇİN TARAYICINIZIN JAVASCRİPT DESTEĞİNİ AÇARAK YENİDEN DENEYİNİZ!</h2>
</noscript>
<?php
$row_Gruplar=$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1 AND AKTIF=1")->fetchAll();
			//hem aktif hem de webrandevu olarak ayarlanmış olan grupları listele
		if(count($row_Gruplar)>0){ ?>
		
		
		<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<a href="index.php"><img src="dist/images/logo.png" alt="IMG"></a>
				</div>

				<form method="post" name="RandevuForm" class="login100-form validate-form">
					<span class="login100-form-title">
						Randevu Sistemi
					</span>



					<div class="wrap-input100 validate-input" data-validate = "Servis Seçiniz">
					
			<select class="input100" id="GRPID" name="GRPID" onChange="this.form.submit();" tabindex="2">
			<option value="0">Bir Servis Seçiniz</option>
				<?php foreach($row_Gruplar as $row_Gruplar) { ?>
					<option value="<?php echo $row_Gruplar['GRPID']; ?>"
					<?php if(isset($_POST['GRPID']) && $row_Gruplar['GRPID']==$_POST['GRPID']){ echo "selected"; } ?>
					><?php echo $row_Gruplar['GRUP_ISMI']; ?></option>										
				<?php } ?>
			</select>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-list" aria-hidden="true"></i>
						</span>
					</div>
					<?php if(isset($_POST['GRPID']) && $_POST['GRPID']!=0){ ?>  
								<div class="wrap-input100">
						<input tabindex="2"
						class="tckimlik input100" 
						id="tckimlik" 
						name="tckimlik" 
						maxlength="11" 
						type="text" 
						placeholder="T.C. Kimlik No"
						required autocomplete="off" >
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
		<?php $dogrulamaKoduGoster = $db->query("SELECT dogrulamaKoduGoster FROM RANDEVU_AYAR WHERE GRPID ='$_POST[GRPID]' ")->fetch(); ?>
		<?php if($dogrulamaKoduGoster['dogrulamaKoduGoster']){ ?>
		<tr>
			<td class="alert alert-info">Güvenlik kodu:
				<button type="button" onClick="this.form.submit();" title="Yenile"><img src="fonksiyonlar/php/capthca.php" ></button>
				<br><span style="font-size:8pt; color:red">*Büyük-Küçük harfe duyarlıdır.</span>
			</td>
			<td class="alert alert-info" >
			
		<input type="text" maxlength="5" id="dogrulamaKodu" name="dogrulamaKodu"  tabindex="3" class="form-control" placeholder="Kodu giriniz"  autocomplete="off"  >
			</td>
		</tr>
		<?php }else{ //mutlaka olması gerek dogrulamaKodu js'de tanımlı olması için ?>
		<input type="hidden" name="dogrulamaKodu" id="dogrulamaKodu" value="bos" />
		<?php }?>
			<div class="container-login100-form-btn">
						<button type="button" class="login100-form-btn btn btn-primary form-control" onclick="dogrula();" name="Gonder"  tabindex="4" <?php if(empty($_POST['GRPID']) || $_POST['GRPID']==0){ echo "disabled"; } ?>>Devam</button>
					</div>
		<?php } ?>
				
<div class="container-login100-form-btn" id="uyari" width="200px">
<span class="help-block alert-danger" id="mesaj"></span>
</div>
					<div class="text-center p-t-12">
						<span class="txt1">
							Sıkça
						</span>
						<a class="txt2" href="#">
							Sorulan Sorular
						</a>
						
					</div>

					
				</form>
				<?php } else{ ?>
					<tr><td colspan="2"><div class="alert alert-danger">Randevu Sistemi Kapalıdır veya Şuan Hizmet Vermemektedir.</div></td></tr>
		<?php } ?>
	<div class="container">
		<div class="text-center p-t-136">
		<div class="txt2" href="#">								
			Konya Büyükşehir Belediyesi Bilgi İşlem Dairesi Başkanlığı © Tüm Hakları Saklıdır
			<a>
			<div>
			<span>
			<a href="index.php"><b>Kayıt Ana Sayfası</b></a>
			</span> | 
			<span>
			<a href="http://konya.bel.tr" target="_blank"><b>www.konya.bel.tr</b></a>
			</span>	| 
			</div>
		</a>
		</div>
		</div>
	</div>
		</div>
	</div>
	</div>
	

	
<!--===============================================================================================-->	
	<script src="dist/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="dist/vendor/bootstrap/js/popper.js"></script>
	<script src="dist/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="dist/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="dist/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="dist/js/main.js"></script>
<?php }else{ header("Location: index.php"); } ?>
</body>
</html>