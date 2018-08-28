<?php
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 14.04.2018
-- Description:	Randevu Sistemi
-- ============================================= 
 */
require("baglanti.php");
require("fonksiyonlar/php/haftasonu.php");
require("veriler/gruplar.php");
?>
<?php if(hafta_sonu(date("d-m-Y H:i:s")) && false ){ //haftasonu randevu alınmasını önlemek istiyorsanız && false ifadesini silin! ?><button class="button kirmizi" >Üzgünüz. Hafta sonu tatili(Randevu alınamaz)</button> <?php }else{?>
<noscript><h1>TARAYICINIZIN JAVASCRIPT DESTEKLEDIĞINDEN EMIN OLUNUZ VEYA TARAYICI AYARLARINIZDAN AKTİF HALE GETIRINIZ.</h1>
<h2>RANDEVU ALMABİLMEK İÇİN TARAYICINIZIN JAVASCRİPT DESTEĞİNİ AÇARAK YENİDEN DENEYİNİZ!</h2></noscript>
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<span class="button mavi">Randevu Tarihi Seçin:<input readonly type="text" autocomplete="off" onchange="randevuYukle();"  onblur="randevuYukle()" onclick="randevuYukle();" id="tarih" name="tarih" placeholder="Tarih Seçin" size="40" class="datepicker button gri" >
			</span>
		</div>
		<div class="col-md-6 col-lg-6">
			<span>
			<ul>
				<li>Hafta sonları ve aynı gün için randevu verilmez.</li>
				<li>Randevular ertesi günden başlar.</li>
				<li>Hafta içi, 4 hafta sonrasına kadar randevu alabilirsiniz.</li>
				<li>Lütfen; Randevu günü, saati ve bilet numaranızı kaydetmeyi unutmayınız.</li>
			</ul>
			</span> 
		</div>
	</div>
	<button class="accordion">
		<span class="button siyah" onClick="randevuYukle();" style="z-index:30" id="saat"></span>
	</button>
		<div class="panel">
		<!--Dinamik Randevu Listesi Yeri -->
		</div>
	<div align="center">
		<button class="button yesil" id="ok" onClick="kaydet(); ">
		<i class="icon-ok" style="font-size: 40px"></i>Bilgileri Onaylıyorum Randevuyu Kaydet
		</button>
	</div>
 <?php } ?>
