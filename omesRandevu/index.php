<?php include("Connections/baglantim.php"); ?>
<!DOCTYPE html>
<html lang="en">
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
	<link rel="stylesheet" type="text/css" href="dist/css/util.css">
	<link rel="stylesheet" type="text/css" href="dist/css/main.css">
<!--===============================================================================================-->
<script>
function ackapa(kblt)
        {
            var yeniform = document.RandevuForm;
            if (yeniform.kabulet.checked)
                {
                    document.getElementById('kartvar').style.display='block';
                }
                else
                    {
                        document.getElementById('kartvar').style.display='none';
                    }
        }
</script>
</head>
<body>
<noscript>
<h1>TARAYICINIZIN JAVASCRIPT DESTEKLEDIĞINDEN EMIN OLUNUZ VEYA TARAYICI AYARLARINIZDAN AKTİF HALE GETIRINIZ.</h1>
<h2>RANDEVU ALMABİLMEK İÇİN TARAYICINIZIN JAVASCRİPT DESTEĞİNİ AÇARAK YENİDEN DENEYİNİZ!</h2>
</noscript>
	<?php
if(isset($db)){ 
$row_RandevuAyar = $db->query("SELECT * FROM GRUPLAR WHERE Webrandevu=1 AND AKTIF=1")->fetchAll();
if(count($row_RandevuAyar)>0)//sistemde randevu verebilecek herhangi bir grup varsa ve açıksa
{
	if(!isset($_SESSION))
	{
		session_start();
		$_SESSION['onay']=true;
	}
}else { if(isset($_SESSION)){session_destroy(); unset($_SESSION['onay']); unset($_SESSION['oturum']); } }
}
?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<a href="index.php"><img src="dist/images/logo.png" alt="IMG"></a>
				</div>
				
				<form class="login100-form validate-form" action="dogrula.php" method="post" name="RandevuForm">
				
				<span class="login100-form-title">
						Randevu Sistemi
					</span>
						<table><tr>
							<td>
								<table width="100%">
									<tr>
										<td >
										<ul>
											   <li><a style="color: blue;" href="http://konya.bel.tr/sayfadetay.php?sayfaID=81" target="_blank">www.konya.bel.tr</a> Elkart sayfamızdan ‘<a href="http://konya.bel.tr/sayfadetay.php?sayfaID=1469" style="color: blue;">Genel Bilgiler</a>’ ile ‘<a href="http://www.konya.bel.tr/sayfadetay.php?sayfaID=84" style="color: blue;">İstenen Belgeler</a>’  bölümünü inceleyiniz,</li>
	                                           <li>Elkart işleminizi lütfen süresi içinde yaptırınız.</li>
	                                           <li>Randevu saati geçen kişi, normal işlem sırasına tabidir.</li>
									    </ul>
										</td>
									</tr>
									<tr><td bgcolor="#C0C0C0"><input type="Checkbox" style="width:20px;height:20px" name="kabulet" onclick="ackapa(this.name)">&nbsp;Okudum, kabul ediyorum </td></tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<div id="kartvar" style="display:none">
							<div class="container-login100-form-btn">
											
									<table align="center">
										<tr><td>
										<?php
										if(isset($db) && count($row_RandevuAyar)>0)//sistem açıksa
										{ ?>

										<input type="submit" class="login100-form-btn" name="devambutonu" value="Devam Et">
									<?php }else{ ?>
									<div class="alert alert-danger">Randevu Sistemi Kapalıdır veya Şuan Hizmet Vermemektedir.</div>
									<?php } ?>
										</td></tr>
									</table>
								</div>
								</div>
							</td>
						</tr>
							</table>
						</form>
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

	<script src="dist/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

</body>
</html>