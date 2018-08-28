<?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 15.04.2018
-- Description:	Kişi(tc) Bilgilerini(kontrol.php den) Ajax ile doğrulamak için yazıldı
-- ============================================= 
 */?>
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
<script src="fonksiyonlar/js/jquery.maskedinput.js" type="text/javascript"></script>
  <script src="fonksiyonlar/js/maskele.js" type="text/javascript"></script><!-- masked  phone -->
  <script type="text/javascript">
function dogrula()
    {
      var yeniform = document.KomekForm;
	  if (yeniform.tckimlik.value.length <11)
      {
          alert('Lütfen TC Kimlik Numaranızı Eksiksiz Giriniz !');
          yeniform.tckimlik.focus();
        return false;
      }
	  else{
		   var values = {
				'tcKimlik': document.getElementById('tckimlik').value			 
				};
		  	$.ajax({
                    url:'kontrol.php',
                    method:'POST',
                    data:values,
					dataType:'json',
                   success:function(data){
					   if(data.durum)
					   {
						    alert(data.mesaj);							
							var tc=window.btoa(document.getElementById('tckimlik').value);
							window.location.href="kon.php?t="+tc;
					   }
                      else{
						   //alert(data.mesaj);
						   $( "#mesaj" ).text(data.mesaj);
						   yeniform.tckimlik.value="";
						   yeniform.tckimlik.focus();
					  }
					   
                   },
				    error:function(ma,ydin)
					{
						if (ma.status === 0) {
							alert('[jquery]Bağlantı yok, ağı doğrulayın.');
						} else if (ma.status == 404) {
							alert('[jquery]Talep edilen sayfa bulunamadı. [404]');
						} else if (ma.status == 500) {
							alert('[jquery]Dahili Sunucu Hatası [500].');
						} else if (ydin === 'parsererror') {
							alert('[jquery]İstenen JSON ayrıştırması başarısız');
						} else if (ydin === 'timeout') {
							alert('[jquery]Zaman aşımı hatası.');
						} else if (ydin === 'abort') {
							alert('[jquery]Ajax isteği reddedildi.');
						} else {
							alert('[jquery]Yakalanmamış Hata.\n' + ma.responseText);
						}
					}, 
                });
	  }
    }
</script>	
</head>
<body>
<div class="container-fluid">
<div class="row">
   <div class="col-md-8 col-md-offset-2 col-sm-offset-0">
<table style="background:#fff;">
	<tr>
		<td>
<table class="table table-responsive">
	<tr><td class="ortatablo"><img class="img-responsive " src="images/komeklogo.jpg"></td></tr>
    <tr><td bgcolor="#C0C0C0" align="center" id="signup-btn"><a style="height:40px">Elkart E-Randevu</a></td></tr>
                        <tr>
                                <td>
                                        <table align="center" cellpadding="5" border="0">
                                                <form method="post" name="KomekForm">
                                                <input name="Devam" value="1523801062" type="Hidden">
                                                <tr><td align="right">T.C. Kimlik Numaranız </td> 
												<td>
												<input style="font-size:11pt;color:#ff0000;letter-spacing:1pt;" required autocomplete="off" class="form-control tckimlik" id="tckimlik" name="tckimlik" maxlength="11" /><span class="help-block" id="mesaj"></span></td> </tr>
                                                <tr><td align="right">Doğum Tarihiniz</td>
													<td>
                                                        <table>
																<tr>
                                                                    <td>
                                                                           Gün :   
																		<select name="FormGun" required class="form-control" style="color:#f00;">
																			<option>Seçiniz</option>
																		<?php for($gun=1; $gun<=31; $gun++){ ?>
																		<option value='<?php echo $gun < 10 ? "0".$gun : $gun ?>'><?php echo $gun < 9 ? "0".$gun : $gun ?></option>
																		<?php } ?>
																		</select>	
																	</td>
																	<td>	
                                                                           Ay :    <select name="FormAy" required class="form-control" style="color:#f00;">
																		   <option>Seçiniz</option>
																		<?php for($ay=1; $ay<=12; $ay++){ ?>
																		<option value='<?php echo $ay < 10 ? "0".$ay : $ay ?>'><?php echo $ay < 9 ? "0".$ay : $ay ?></option>
																		<?php } ?>
																		</select>
																	</td>
																	<td>
                                                                           Yıl :   <select name='FormYil' required class="form-control" style="color:#f00;">
																		   <option>Seçiniz</option>
																		<?php for($yil=1920; $yil<=date('Y', strtotime('-6 year')); $yil++){ ?>
																		<option value='<?php echo $yil; ?>'><?php echo $yil; ?></option>
																		<?php } ?>
																		</select>
																	</td>
                                                                </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr><td></td><td><input type="button" class="btn btn-primary" onclick="dogrula()" name="Gonder" value="Devam" /></td></tr>
                                                <tr><td colspan="3" id="uyari" width="200px"></td></tr>
                                                </form>
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
</body>
</html>