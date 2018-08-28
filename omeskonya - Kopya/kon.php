<?php if(isset($_GET['t']) && $_GET['t']!=""){ $tc=base64_decode($_GET['t']); require("baglanti.php"); }
else
{
	header("Location: index.php");//eğer tc(t) yoksa index'e gitsin
}	
if(!isset($_SESSION))
{
	session_start();
}
if(isset($_SESSION['onay']))
{
	
}
?>
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
	<link rel="stylesheet" href="style.css"><!-- omes -->
	<link rel="stylesheet" href="images/modal.css"><!-- modal -->
	<link rel="stylesheet" href="images/style.css"><!-- konya bel-->
	<link rel="stylesheet" href="images/font-awesome.min.css">
	<link rel="stylesheet" href="images/font-awesome-ie7.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"><!--datepicker -->
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script><!--datepicker -->

<script src="fonksiyonlar/js/jquery.maskedinput.js" type="text/javascript"></script><!-- masked  phone -->
<script src="fonksiyonlar/js/maskele.js" type="text/javascript"></script><!-- masked  phone -->
<script type="text/javascript" src="fonksiyonlar/js/konya.js"></script><!-- konya bel-->
<script src="fonksiyonlar/js/tarihAyarla.js" type="text/javascript"></script>	
<script type="text/javascript">
    window.onbeforeunload = function() {
       window.location.href="index.php";
    }
</script>
	<script type="text/javascript" language="JavaScript">
	var a,b,randevuTarihi,randevuSaati;
	function mesaj(id,deger)
	{		
		randevuSaati=deger;
		randevuTarihi=document.getElementById("tarih").value;
		a=document.getElementById(id);
		b=document.getElementById("saat");
		b.style = "display:block";
		b.innerHTML="SEÇTİĞİNİZ RANDEVU SAATİ: <span class='button yesil' style='font-weight:bold;'>"+randevuTarihi+"-"+randevuSaati+"</span>";
	}
	function kaydet()
	{
		if(kontrol()) //telefon no girildiyse devam et
		{		randevuTarihi=document.getElementById("tarih").value;
			if(a!=null) //herhangi bir saat(radio) seçilmişse
			{
				
				if(confirm("Seçtiğiniz randevu saati: "+randevuTarihi+"-"+randevuSaati+'.\n Randevuyu kaydetmek istediğinizden emin misiniz?'))
				{
				
				 var values = {
				'ad': document.getElementById('adi').value,
				'soyad': document.getElementById('soyadi').value,
				'tel':  document.getElementById('phone').value,
				'tc':  document.getElementById('tc').value,
				'tarih': document.getElementById("tarih").value,
				'saat': randevuSaati     
				};
					$.ajax({
                    url:'randevuKaydet.php',
                    type:'POST',
                    data:values,
					dataType:'json',
                   success:function(data){
                     if(data.durum)
					   {
						   a.disabled=true;						
							a.className = "selected";
								$('.modal-body').html(data.mesaj);						
								//bilet modal'ini tetikleyen buton
								$("#myBtn").click();						    
							//window.location.href="index.php";		//modalsiz direk indexe gider					
					    }
                      else{
						   alert(data.mesaj);
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
			else{
					b=document.getElementById("saat");
					b.style = "display:block";
					b.innerHTML="<span style='color:yellow;'>Lütfen Bir randevu saati seçiniz!</span>";
					alert("Lütfen Bir randevu saati seçiniz!");
					//$("#saat").click();
					
			}						
			}
	}
	function randevuYukle()
	{		
	b=document.getElementById("saat");
	randevuTarihi=document.getElementById("tarih").value;
	b.innerHTML="SEÇTİĞİNİZ RANDEVU TARİHİ: <span class='button yesil' style='font-weight:bold;'>"+randevuTarihi+"</span>"
			var values = {
				'tarih': document.getElementById("tarih").value     
				};
				$.ajax({
                    url:'randevuListele.php',
                    type: 'POST',
                    data:values,
			        success:function(data){
                     if(data)
					   {								   
							$('.panel').html(data);		
					    }
                      else{
						  $('.panel').text("VERİ YOK!");
					  }
                   },
				   beforeSend: function() {
					$('.panel').text('Yükleniyor...');
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
	</script>
</head>
<body>
<div class="container-fluid" >
<div class="row">
   <div class="col-md-8 col-md-offset-2 ">
<table style="background:#fff;">
	<tbody><tr>
		<td>
<table class="table table-responsive">
	<tbody><tr><td class="ortatablo"><img class="img-responsive center-block" src="images/komeklogo.jpg"></td></tr>
    <tr><td bgcolor="#C0C0C0" align="center" id="signup-btn"><a style="height:40px">Elkart E-Randevu</a></td></tr>
    
<tr><td class="ortatablo1"></td></tr>
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
						<input type="hidden" id="tc" value="<?php echo $tc; ?>" />
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
				<form id="KomekForm1" name="KomekForm1">
                    <tr id="CepTelR" align="center">
                        <td align="center">
                            <b>Adınız </b>&nbsp;<input type="text" id="adi" name="adi" class="form-control" required maxlength="50" placeholder="Adınız">
                            <b>Soyadınız </b>&nbsp;<input type="text" id="soyadi" name="soyadi" class="form-control" required maxlength="50" placeholder="Soyadınız">
                            <b>Telefon Numarası</b>&nbsp;<input id="phone" autocomplete="off"  name="telefon1" placeholder="0(___) ___-____"  class="phone form-control"  maxlength="14">
                         </td>
                    </tr>             
				</form>
				<tr>
					<td>
						<?php if($db){ include("randevu.php");  }else { echo "Üzgünüz! Randevu sistemimiz şuan teknik bir arızadan dolayı hizmet verememektedir.<br> Lütfen, Daha sonra tekrar deneyiniz."; } ?>
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
  <script src='fonksiyonlar/js/accordion.js'></script>
<!-- Trigger/Open The Modal -->
<button id="myBtn" style="display:none"></button>
<!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>ELKART RANDEVU BİLGİLERİNİZ</h2>
    </div>
    <div class="modal-body">
 <!-- randevu bilgisi alanı -->
    </div>
	<div class="button kirmizi" style='margin:20px;' >Randevu günü ve saatini kaydetmeyi unutmayınız.</div>
    <div class="modal-footer">
      <h3>Konya Belediyesi Elkart Basvurusu</h3>
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
// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
	alert("Anasayfaya yönlendiriliyorsunuz..");	
	window.location.href="index.php";	
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
       modal.style.display = "none";
	  alert("Anasayfaya yönlendiriliyorsunuz..");	
	  window.location.href="index.php";
    }
}										
</script>
</body>
</html>