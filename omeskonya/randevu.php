<?php
	/*
		-- =============================================
		-- Author:		EKOMURCU
		-- Create date: 14.04.2018
		-- Description:	Randevu Sistemi
		-- ============================================= 
	*/
	if(!isset($_SESSION))
	{
		session_start();
		if(!isset($_SESSION['onay'])){ header("Location: index.php"); }else{ session_destroy(); unset($_SESSION['onay']);}
	}
	
	//$row_RandevuAyar fonksiyonlar/php/tarihAyarla.php içinden geliyor
	
?>

<noscript><h1>TARAYICINIZIN JAVASCRIPT DESTEKLEDIĞINDEN EMIN OLUNUZ VEYA TARAYICI AYARLARINIZDAN AKTİF HALE GETIRINIZ.</h1>
<h2>RANDEVU ALMABİLMEK İÇİN TARAYICINIZIN JAVASCRİPT DESTEĞİNİ AÇARAK YENİDEN DENEYİNİZ!</h2></noscript>
<div class="row">
	<div class="col-md-6 col-lg-6">
		<span class="button mavi" onclick="randevuYukle();" >Randevu Tarihi Seçin:<input readonly type="text" autocomplete="off" onchange="randevuYukle();"  onblur="randevuYukle()" onclick="randevuYukle(); $('#saat').click();" id="tarih" name="tarih" placeholder="Tarih Seçin" size="40" class="datepicker button gri" >
		</span>
		</div>
	<div class="col-md-6 col-lg-6">
		<span>
			<ul>
				<?php if($row_RandevuAyar['randevuSecimi']==1){ ?><li>Hafta içi iş günleri için randevu talep edebilirsiniz.</li><?php } ?>
				<?php if($row_RandevuAyar['randevuSecimi']==2){ ?><li>Hafta sonu ve hafta içi tatil günleri hariç randevu alabilirsiniz.</li><?php } ?>
				<?php if($row_RandevuAyar['randevuSecimi']==3){ ?><li>Resmi tatil günlerinde randevu verilmez.</li><?php } ?>
				<?php if($row_RandevuAyar['randevuSecimi']==4){ ?><li>Randevu için herhangi bir tarih seçebilirsiniz.</li><?php } ?>
				
				<li><span class="label label-success"><?php echo $row_RandevuAyar['maksimumTarihSayisi'];?>
					<?php switch($row_RandevuAyar['maksimumTarihTuru']){
						case 'd': echo "gün"; break;
						case 'w': echo "hafta"; break;
						case 'm': echo "ay"; break;
					case 'y': echo "yıl"; break; }	?> </span>sonrasına kadar randevu alabilirsiniz.</li>
					<?php if(($row_RandevuAyar['biletSinirla'])){
					?>
					<li>Randevular kişiye özgü olup herkesin <span class="label label-danger"><?php echo $row_RandevuAyar['biletSinirSayisi'];?> adete</span> kadar randevu talep hakkı bulunmaktadır.</li>
					<?php					
					} ?>
					<li style="color:red">Lütfen; Randevu günü, saati ve bilet numaranızı kaydetmeyi unutmayınız.</li>
					<li style="color:red">Randevu saati geçen kişi, normal işlem sırasına tabidir.</li>
			</ul>
		</span> 
		<a href="#randevu" class="btn btn-warning">Randevularım</a>
		<a href="oturumKapat.php?doLogout=true" class="btn btn-danger">Oturum Kapat</a>
	</div>
</div>
<button class="accordion">
	<span class="button siyah" style="z-index:30" id="saat"></span>
</button>
<div class="panel">
	<!--Dinamik Randevu Listesi Yeri -->
</div>
<!-- akerdeon kullanılacaksa bunu ve style.css içinden .panel css i display:none açın #ertu
<script src='fonksiyonlar/js/accordion.js'></script> -->


<!-- kullanicinin önceki randevuları dinamik olarak yenilendi -->
<div class="table-responsive"><div id="randevuContainer" ></div>	</div>
<script>
	function update() { 
		var values = {
			'tc':  document.getElementById('tc').value,		
		};
		$.ajax({
			type: 'POST',
			url: 'randevularim.php',
			timeout: 2000,
			data:values,
			success: function(data) {
				$("#randevuContainer").html(data);
				window.setTimeout(update, 2000);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$("#randevuContainer").html('Yükleniyor..');
				window.setTimeout(update, 10000);
			}
		});
	}
	$(document).ready(function() {
		update();
	});
	</script>
	<!-- kullanicinin önceki randevuları dinamik olarak yenilendi -->	