<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title>Konya Büyükşehir Belediyesi Elkart Başvuru Ekranı</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="dist/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="images/style.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />

<script type="text/javascript" src="dist/js/jquery-1.10.2.min.js"></script>
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
<body>
<div class="container-fluid">
<div class="row">
   <div class="col-md-8 col-md-offset-2 ">
<table style="background:#fff;">
	<tr>
		<td>

<table class="table table-responsive">
	<tr><td class="ortatablo"><img class="img-responsive center-block" src="images/komeklogo.jpg"></td></tr>
    <tr><td style="background:#C0C0C0;" align="center" id="signup-btn"><a style="height:40px;">Elkart E-Randevu</a></td></tr>
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
											   <li><a style="color: blue;" href="http://konya.bel.tr/sayfadetay.php?sayfaID=81" target="_blank">www.konya.bel.tr</a> Elkart sayfamızdan ‘Genel Bilgiler’ ile ‘İstenen Belgeler’  bölümünü inceleyiniz,</li>
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
										<tr><td><input type="submit" class="btn btn-primary" name="devambutonu" value="Devam Et"></td></tr>
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