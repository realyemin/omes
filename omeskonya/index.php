<?php include("Connections/baglantim.php"); ?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title>Konya Büyükşehir Belediyesi Elkart Başvuru Ekranı</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="stylesheet" href="dist/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="dist/css/style.css" type="text/css" />	


	<script src='dist/js/jquery-2.2.4.min.js'></script><!-- jquery -->
	<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
<title>Konya Büyükşehir Belediyesi</title>
<script>
function ackapa(kblt)
        {
            var yeniform = document.KomekForm;
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
<body class="container" >
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
<noscript><h1>TARAYICINIZIN JAVASCRIPT DESTEKLEDIĞINDEN EMIN OLUNUZ VEYA TARAYICI AYARLARINIZDAN AKTİF HALE GETIRINIZ.</h1>
<h2>RANDEVU ALMABİLMEK İÇİN TARAYICINIZIN JAVASCRİPT DESTEĞİNİ AÇARAK YENİDEN DENEYİNİZ!</h2></noscript>
<div class="container" >
<div class="row">
   <div class="col-md-8 col-md-offset-2">
<table class="table"  style="background:#fff;">
	<tr>
		<td>

<table class="table table-responsive">
	<tr><td class="ortatablo"><img class="img-responsive center-block" src="images/komeklogo.jpg"></td></tr>
    <tr><td style="background:#C0C0C0;" align="center" id="signup-btn"><a style="height:40px;">E-Randevu</a></td></tr>
 </table>
 
<table class="table table-responsive">
						<form action="dogrula.php" method="post" name="KomekForm">
						<input name="Devam" value="1523801062" type="hidden">
						<tr>
							<td>
								<table width="100%">
									<tr>
										<td style="font-size:10pt">
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
									<table align="center">
										<tr><td>
										<?php
										if(isset($db) && count($row_RandevuAyar)>0)//sistem açıksa
										{ ?>
										<input type="submit" class="btn btn-primary" name="devambutonu" value="Devam Et">
									<?php }else{ ?>
									<div class="alert alert-danger">Randevu Sistemi Kapalıdır veya Şuan Hizmet Vermemektedir.</div>
									<?php } ?>
										</td></tr>
									</table>
								</div>
							</td>
						</tr>
						</form>
					</table>
		</td>
	</tr>
		<tr>
		<td align="center" style="color:#a0a0a0">
			<table class="table table-responsive" class="ortatablo">
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
</body>
</html>