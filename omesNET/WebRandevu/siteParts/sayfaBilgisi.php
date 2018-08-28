<?php if(isset($_GET['tatil']) && $_GET['tatil']=="on" && empty($GRPID)){ ?>
		<div class="col-sm-8">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i>Randevu Tatil Günleri</h4>           
				</div>
				<div class="panel-body">
				Bu sayfadan Randevu Sisteminde kullanıcıların randevu alabilecekleri veya alamayacakları günleri belirleyebilirsiniz.
				<br>Kısıtlama koyduğunuz günlerde eğer <strong><a href="?WebRandevu&randevu=on">Randevu Kısıtlama</a></strong> ayarları açık ise kullanıcılar o tarihlerde seçili grup  veya hizmet biriminden randevu talep edemezler.
				<br> Örneğin: Kart randevu grubu/servisinden 1 Mayıs İşçi bayramında randevu alınmasını engelleyebilirsiniz.
				<br> <strong>* Her grup veya servis için ayarlar ayrı ayrı yapılabilir.</strong>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>
<?php if(isset($_GET['randevu']) && $_GET['randevu']=="on" && empty($GRPID)){ ?>
		<div class="col-sm-8">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i>Randevu Kısıtlama Ayarları</h4>           
				</div>
				<div class="panel-body">
				Bu sayfadan Randevu Sisteminde kullanıcıların randevu alımlarına sınır koyabilirsiniz.
				<br>Kısıtlama koyduğunuz günlerde eğer <strong><a href="?WebRandevu&randevu=on">Randevu Kısıtlama</a></strong> ayarları açık ise kullanıcılar o tarihlerde seçili grup  veya hizmet biriminden randevu talep edemezler.
				<br> Örneğin: Kart randevu grubu/servisinden tatil günlerinde, hafta sonlarında, hafta içi seçili tatil günlerinde randevu alınmasını engelleyebilirsiniz.
				<br> <strong>* Her grup veya servis için ayarlar ayrı ayrı yapılabilir.</strong>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>
<?php if(isset($_GET['takvim']) && $_GET['takvim']=="on" && empty($GRPID)){ ?>
		<div class="col-sm-8">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i>Randevu Takvim Ayarları</h4>           
				</div>
				<div class="panel-body">
				Bu sayfadan Randevu takvimi için görüntülenme animasyonu seçebilir, 
				Takvimin randevu dağıtmaya ne zaman başlayıp ne zaman son vereceğini ayarlayabilirsiniz.
				<br><strong>* Her grup veya servis için ayarlar ayrı ayrı yapılabilir.</strong>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>
<?php if(isset($_GET['sistem']) && $_GET['sistem']=="on" && empty($GRPID)){ ?>
		<div class="col-sm-4">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i>Randevu Sistem Ayarları</h4>           
				</div>
				<div class="panel-body">
				Bu sayfadan ilgili randevu grup veya servislerini hizmete açabilir 
				veya kapatarak randevu alınmasını tamamen engelleyebilirsiniz.<br>
				<strong>* Normal Kiosk bilet verme işlemini etkilemez. Sadece web randevuları için geçerlidir.</strong>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>
<?php if(isset($_GET['oturum']) && $_GET['oturum']=="on" && empty($GRPID)){ ?>
		<div class="col-sm-8">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i>Oturum Ayarları</h4>           
				</div>
				<div class="panel-body">
				Bu sayfadan ilgili müşterilerin/kullanıcıların  randevu almak için geçirdikleri 
				<ul><li>Oturum sürelerini ve</li>
				<li>Güvenlik için doğrulama kodu ayarlarını</li>
				</ul>yapabilirsiniz.
				<br> Bu ayar ile kullanıcılar oturum açtıklarında sayfada işlem yapabilecekleri süreyi görüntülerler ve süre sonunda sitemden atılırlar.
				<br><strong>* Sistemde yoğunluk oluştuğu durumlarda sürenin kısa tutulması önerilir.</strong>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>
<?php if(isset($_GET['mail']) && $_GET['mail']=="on" && empty($GRPID)){ ?>
		<div class="col-sm-8">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i>Eposta Sunucu Ayarları</h4>           
				</div>
				<div class="panel-body">
				Bu sayfadan ilgili müşterilerin/kullanıcıların  randevu taleplerini 
				eposta aracılığıyla kendilerine bildirmek için gerekli eposta sunucu ayarlarını yapabilirsiniz.
	
				<br> Bu ayar ile kullanıcılar randevu tarih ve saatlerini eposta olarak ayrıca alırlar.
				<br><strong>* Sistemin çalışabilmesi için aktif bir smtp mail hesabına ihtiyaç vardır.</strong>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>