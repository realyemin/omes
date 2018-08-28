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
				<?php if($row_RandevuAyar['randevuSecimi']==2){ ?><li>Hafta sonu ve hafta içi tatil günleri hariç diğer günler için randevu alabilirsiniz.</li><?php } ?>
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
		<button class="btn btn-warning" data-toggle="modal" data-target="#randevularim<?php echo $tc; ?>">Randevularım</button>
		<button onclick="location.href='oturumKapat.php?doLogout=true'" class="btn btn-danger">Oturum Kapat</button>
	</div>
</div>
<button class="accordion">
	<span class="button siyah" style="z-index:30" id="saat"></span>
</button>
<div class="container">
	<div class="panel">
		<!--Dinamik Randevu Listesi Yeri -->
	</div>
</div>
<!-- akerdeon kullanılacaksa bunu ve style.css içinden .panel css i display:none açın #ertu
<script src='fonksiyonlar/js/accordion.js'></script> -->

<div class="modalRandevu" style="z-index:21999">
	<div id="randevularim<?php echo $tc; ?>" class="modal" role="dialog">
		<!-- Modal content -->
		<div class="modal-content" style="background:white; max-width:600px;cursor:auto">
			<div class="modal-header ">
				<span class="close" data-dismiss="modal">&times;</span>
				<h1 class="modal-title">Randevularım</h1>
				<hr>
			</div>
			
			<!-- kullanicinin önceki randevuları dinamik olarak yenilendi -->
			<div class="table-responsive" ><div id="randevuContainer" ></div></div>
			
			<div class="modal-footer">
				<h3>Web Randevu</h3>
			</div>
		</div>
	</div>
</div>

<script>
	function update() { 
		var values = {
			'tc':  document.getElementById('tc').value,	
			'eposta':  document.getElementById('eposta').value,	
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