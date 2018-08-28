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
				$epostaAyar = $db -> query("SELECT Aktif FROM RANDEVU_EPOSTA_AYAR WHERE GRPID='$GRPID'")->fetch();
			} }else{  header("Location: oturumKapat.php?doLogout=true"); }?>
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
					<link rel="stylesheet" href="dist/css/style.css"><!-- omes -->
					<link rel="stylesheet" href="images/modal.css"><!-- modal -->
					<link rel="stylesheet" href="images/loader.css"><!-- modal -->
					<link rel="stylesheet" href="images/style.css"><!-- konya bel-->
					<link rel="stylesheet" href="images/font-awesome.min.css">
					<link rel="stylesheet" href="images/font-awesome-ie7.min.css">
					
					<!--datepicker -->
					<script type="text/javascript" src="dist/js/jquery-1.10.2.min.js"></script>
					<?php include("fonksiyonlar/php/tarihAyarla.php"); ?>	
					<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/<?php echo $row_RandevuAyar['takvimTema']; ?>/jquery-ui.css">
					
					<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
					<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
					<!--datepicker -->
					
					
					<!-- FlipClock CountDown-->
					<link rel="stylesheet" href="dist/plugin/FlipClock/compiled/flipclock.css">
					<script src="dist/plugin/FlipClock/compiled/flipclock.js"></script>	
					<script src="dist/plugin/validator.min.js"></script>	
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
					
					<div class="limiter">
						<div class="container-login100">
							<div class="wrap-login100">	
								<div class="login100-pic js-tilt" data-tilt>
									<img src="dist/images/logo.png" style="width:100px" alt="IMG">
								</div>			
								<span class="login100-form-title">
									<?php echo $gruplar['GRUP_ISMI']; ?> E-Randevu
								</span>
								<div><strong>T.C. Kimlik No : </strong><?php echo $tc; ?></div>
								
								<form id="RandevuForm1" name="RandevuForm1" class="form-inline" data-toggle="validator">
									<input type="hidden" value="<?php echo $GRPID; ?>" id="GRPID">
									<input type="hidden" value="<?php echo GetIP(); ?>" id="IPAdresi">
									<input type="hidden" value="<?php echo $tc; ?>" id="tc" >		
									<strong>Adınız:&nbsp;</strong><div class="wrap-input100 validate-input">
										<input type="text" value="<?php echo $kullanici['musteriAd']; ?>" id="adi" name="adi" class="input100" required maxlength="50" size="20" placeholder="Adınız">
										<span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="fa fa-user-circle" aria-hidden="true"></i>
										</span>
									</div>
									<strong>Soyadınız:&nbsp;</strong><div class="wrap-input100 validate-input">
										<input type="text" value="<?php echo $kullanici['musteriSoyad']; ?>" id="soyadi" name="soyadi" class="input100" required maxlength="50" placeholder="Soyadınız">
										<span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="fa fa-user-circle-o" aria-hidden="true"></i>
										</span>
									</div>
									<strong>Telefon Numarası:&nbsp;</strong><div class="wrap-input100 validate-input">
										<input type="text"  value="<?php echo $kullanici['musteriTel']; ?>" id="phone" autocomplete="off"  name="telefon1" placeholder="(___) ___-____"  class="phone input100"  maxlength="14">
										<span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
										</span>				
									</div>				
									<?php if($epostaAyar['Aktif'])
										{ ?>
										<strong>Eposta Adresiniz:&nbsp;</strong><div class="wrap-input100 validate-input">
											<input data-error="hatalı emal" type="text" value="<?php if($kullanici['musteriEposta']!="false"){ echo $kullanici['musteriEposta'];}  ?>" id="eposta" autocomplete="off"  name="eposta" placeholder="Geçerli bir eposta adresi giriniz"  class="input100"  maxlength="120">						
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fa fa-address-card" aria-hidden="true"></i>
											</span>				
										</div>								
										<?php }else{
										?>
										<input type="hidden" value="false" id="eposta" >	
										<?php
										}?>	
										<span class="help-block alert-danger" id="mesajGenel"></span>
								</form>
								<script type="text/javascript">$('#myForm').validator();</script>

								<?php if(isset($db)){ include("randevu.php");  }else { echo "Üzgünüz! Randevu sistemimiz şuan teknik bir arızadan dolayı hizmet verememektedir.<br> Lütfen, Daha sonra tekrar deneyiniz."; } ?>
								
								<div class="container">
									<div class="text-center p-t-136">
										<div class="txt2">								
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
					
					<!--===============================================================================================-->
					<script src="dist/vendor/bootstrap/js/popper.js"></script>
					<script src="dist/vendor/bootstrap/js/bootstrap.min.js"></script>
					<!--===============================================================================================-->
					<script src="dist/vendor/select2/select2.min.js"></script>
					<script src="dist/vendor/tilt/tilt.jquery.min.js"></script>
					<script >
						$('.js-tilt').tilt({
							scale: 1.1
						})
					</script>
					<!--===============================================================================================-->
					<script src="dist/js/main.js"></script>
					
					<!-- Trigger/Open The Modal -->
					<button id="myBtn" style="display:none"></button>
					<!-- The Modal -->
					<div class="modal" id="myModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 class="modal-title">E-RANDEVU</h3>
								</div>
								<div class="modal-body">
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