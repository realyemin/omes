<?php include("Connections/baglantim.php"); 
	if(!isset($_SESSION))
	{
		session_start();
	}
?>
<?php
	if(isset($db)){
		if(isset($_SESSION['onay']) && isset($_SESSION['dogrula']))
		{
			if(isset($_GET['t']) && $_GET['t']!="" && isset($_GET['g']) && $_GET['g']!="")
			{ 
				
				include("fonksiyonlar/php/getIP.php"); //ip adresini al
				include("fonksiyonlar/php/turkceTarih.php"); //ip adresini al
				$tc=base64_decode($_GET['t']);  //tc kimlikNo
				$GRPID =base64_decode($_GET['g']); //GRPID
				$gruplar = $db -> query("SELECT GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1 AND AKTIF =1 AND GRPID='$GRPID'")->fetch();
				$kullanici = $db -> query("SELECT * FROM RANDEVU_KULLANICI WHERE musteriTC='$tc'")->fetch();
			} }else{  header("Location: oturumKapat.php?doLogout=true"); }?>
			<!DOCTYPE HTML>
			<html lang="en-US">
				<head>
					<meta charset="UTF-8">	
					<title>Konya Büyükşehir Belediyesi Elkart Başvuru Ekranı</title>
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<link rel="stylesheet" href="dist/css/bootstrap.min.css" type="text/css" />
					<script type="text/javascript" src="dist/js/jquery-1.10.2.min.js"></script>
					<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
					
					<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700'>
					<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'> 
					<link rel="stylesheet" href="dist/css/style.css"><!-- omes -->
					<link rel="stylesheet" href="images/modal.css"><!-- modal -->
					<link rel="stylesheet" href="images/style.css"><!-- konya bel-->
					<link rel="stylesheet" href="images/font-awesome.min.css">
					<link rel="stylesheet" href="images/font-awesome-ie7.min.css">
					
					<?php include("fonksiyonlar/php/tarihAyarla.php"); ?>
					<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/<?php echo $row_RandevuAyar['takvimTema']; ?>/jquery-ui.css"><!--datepicker -->
					<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
					<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>datepicker -->
					<script src="dist/plugin/datepicker/jquery-ui.js"></script><!--datepicker -->
					
					<!-- FlipClock CountDown-->
					<link rel="stylesheet" href="dist/plugin/FlipClock/compiled/flipclock.css">
					<script src="dist/plugin/FlipClock/compiled/flipclock.js"></script>	
					<!-- FlipClock CountDown-->
					
					<script type="text/javascript">
						window.onbeforeunload = function() {
							window.location.href="index.php";
						}
					</script>
					<script src="fonksiyonlar/js/jquery.mask.min.js" type="text/javascript"></script><!-- masked  phone -->
					<script src="fonksiyonlar/js/maskele.js" type="text/javascript"></script><!-- masked  phone -->
					<script src="fonksiyonlar/js/konya.js" type="text/javascript"></script><!-- konya bel-->
					<script src="fonksiyonlar/js/randevuSistemi.js" type="text/javascript"></script>
					<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.5.3/modernizr.min.js"></script>	
				</head>
				<body>
					<div class="container" >
						<div class="row">
							<div class="col-md-8 col-md-offset-2">
								<table style="background:#fff;" class="table">
									<tbody><tr>
										<td>
											<table >
												<tbody><tr><td class="ortatablo"><img class="img-responsive center-block" src="images/komeklogo.jpg"></td></tr>
													<tr><td bgcolor="#C0C0C0" align="center" id="signup-btn"><a style="height:40px"><?php echo $gruplar['GRUP_ISMI']; ?> E-Randevu</a></td></tr>
													
													
													<tr><td class="ortatablo1">
														<table cellpadding="2" align="center" width="100%" border="0">
															<tbody>
																<tr>
																	<td colspan="2" bgcolor="#EFEFEF">
																		<table cellpadding="5" align="center" cellspacing="0">
																			<tbody><tr>
																				<td valign="top">
																					<table cellpadding="4" cellspacing="0">
																						<tbody><tr><td align="right" class="buyukfont">T.C. Kimlik No : </td>      
																							<td class="buyukfont" style="font-size: 16pt;"><b><?php echo $tc; ?>					
																							</b></td></tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<tr><td colspan="4" bgcolor="#6dcaf1" align="left">
																<font style="color:black" size="3pt"><b>Aşağıdaki Alanları Doldurunuz</b></font></td></tr>
																
																<tr><td style="height: 15px;"></td></tr>
																<form id="KomekForm1" name="KomekForm1" class="form-inline">
																	<tr id="CepTelR" align="center">
																		<td align="center">	
																			<input type="hidden" value="<?php echo $GRPID; ?>" id="GRPID">
																			<input type="hidden" value="<?php echo GetIP(); ?>" id="IPAdresi">
																			<input type="hidden" value="<?php echo $tc; ?>" id="tc" >					
																			<b>Adınız </b>&nbsp;<input type="text" value="<?php echo $kullanici['musteriAd']; ?>" id="adi" name="adi" class="form-control" required maxlength="50" size="20" placeholder="Adınız">
																			
																			<b>Soyadınız </b>&nbsp;<input type="text" value="<?php echo $kullanici['musteriSoyad']; ?>" id="soyadi" name="soyadi" class="form-control" required maxlength="50" placeholder="Soyadınız">
																			
																			<b>Telefon Numarası</b>&nbsp;<input type="text" value="<?php echo $kullanici['musteriTel']; ?>" id="phone" autocomplete="off"  name="telefon1" placeholder="(___) ___-____"  class="phone form-control" required maxlength="14">						
																																					
																				<span class="help-block alert-danger" id="mesajGenel"></span>
																		</td>
																	</tr>             
																</form>
																<tr>
																	<td>
																		<?php if(isset($db)){ include("randevu.php");  }else { echo "Üzgünüz! Randevu sistemimiz şuan teknik bir arızadan dolayı hizmet verememektedir.<br> Lütfen, Daha sonra tekrar deneyiniz."; } ?>
																		
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
													</tr>  
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
									<td align="center" style="color:#a0a0a0">
									<table align="center" cellpadding="4" cellspacing="4" class="ortatablo" width="100%">
									<tbody><tr><td align="center">Konya Büyükşehir Belediyesi Bilgi İşlem Dairesi Başkanlığı © Tüm Hakları Saklıdır</td></tr>
									<tr><td>
									<table align="center">
									<tbody><tr><td><a href="index.php"><b>Kayıt Ana Sayfası</b></a></td><td width="10p" align="center">|</td><td><a href="http://konya.bel.tr" target="_blank"><b>www.konya.bel.tr</b></a></td><td width="10p" align="center">|</td></tr>
									</tbody></table>
									</td>
									</tr>
									</tbody></table>
									</td>
									</tr>
									</tbody>
									</table>
									</div>
									</div>
									</div>
									
									<!-- Trigger/Open The Modal -->
									<button id="myBtn" style="display:none"></button>
									<!-- The Modal -->
									<div class="modal" id="myModal" role="dialog">
									<div class="modal-dialog modal-lg">
									<div class="modal-content">
									<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 class="modal-title">E-RANDEVU</h3>
									</div>
									<div class="modal-body table-responsive">
									<!-- randevu bilgisi alanı -->
									</div>
									<div class="modal-footer">
									<h4>Konya Belediyesi Elkart Basvurusu</h4>
									<button type="button" id="clsBtn" class="btn btn-danger" data-dismiss="modal">Kapat</button>		
									</div>
									</div>
									</div>
									</div>
									
									<script>
									// Get the modal
									var modal = document.getElementById('myModal');
									// Get the button that opens the modal
									var btn = document.getElementById("myBtn");
									// Get the <span> element that closes the modal
									var span = document.getElementsByClassName("close")[0];
									// Get the <clsBtn> element that closes the modal
									var clsBtn = document.getElementById("clsBtn");
									// When the user clicks the button, open the modal 
									btn.onclick = function() {
									modal.style.display = "block";
									}
									// When the user clicks on <span> (x), close the modal
									span.onclick = function() {
									modal.style.display = "none";
									//alert("Anasayfaya yönlendiriliyorsunuz..");	
									//window.location.href="index.php";	
									}
									clsBtn.onclick = function() {
									modal.style.display = "none";
									}
									// When the user clicks anywhere outside of the modal, close it
									window.onclick = function(event) {
									if (event.target == modal) {
									modal.style.display = "none";
									}
									}		
									
									</script>
									</body>
									</html>
									<?php
									}else{  header("Location: index.php"); }?>													