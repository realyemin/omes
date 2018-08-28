<?php
if(isset($db)){
try{

@$query_GrupSayisi = "SELECT COUNT(*) AS GRUPSAYISI FROM GRUPLAR";
@$GrupSayisi = $db->query($query_GrupSayisi)->fetch();

@$query_TerminalSayisi = "SELECT COUNT(*) AS TERMINALSAYISI FROM TERMINALLER";
@$TerminalSayisi = $db->query($query_TerminalSayisi)->fetch();

@$query_BiletMakineSayisi = "SELECT COUNT(*) AS BILETMAKINESISAYISI FROM BILET_MAKINELERI";
@$BiletMakineSayisi = $db->query($query_BiletMakineSayisi)->fetch();

}catch(Exception $hata)
{
	echo "Opss! Üzgünüz bir hatayla karşılaştık. Muhtemelen veriler getirilirken hatalı bir işlem yaptık.";
}
?>
  <style>
.gauge {
    width: 250px;
    height: 250px;
    display: inline-block;
}
.row.display-flex {
  display: flex;
  flex-wrap: wrap;
}
.thumbnail {
  height: 100%;
}
/* extra positioning */
.thumbnail {
  display: flex;
  flex-direction: column;
}

.thumbnail .caption {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}
  </style>
<div class="row display-flex">
    <div class="col-md-4">
    <div class="thumbnail" style="text-align:justify">
      <center><div id="gg1" class="gauge" data-value="<?php echo $GrupSayisi['GRUPSAYISI']; ?>"></div></center>
      <div class="caption">
        <h3> Gruplarınızı Oluşturun</h3>
        <p>Tebrikler! Satın almış olduğunuz sıramatik sistemiyle web uyumlu pratik bir kurulum panelininde sahibi oldunuz.</p>
        <p>İşe öncelikle Sıra Numarası vereceğiniz Birimlerin Grup Bilgilerini<strong>(Grup İsmi, Biletlerin Gruplara göre başlangıç ve bitiş numaralarını örn: 1.Banko 1000 -1500 arası 2.Banko 2000-2700 arası bilet verecek şeklinde., Minumum ve Maksimum çalışma sürelerini, Bilet üzerinde istatistiki bilgileri, Çalışma zamanını(sabah,öğle molası, akşam mesaisi) ve Verilecek Bilet Sınırı gibi )</strong>bu panel yardımıyla ayarlayabilirsiniz.</p>
        <p><a href="?GrupEkle" class="form-control btn btn-primary" role="button">Başla</a></p>
      </div>
    </div>
  </div>  
    <div class="col-md-4">
    <div class="thumbnail" style="text-align:justify">
      <center><div id="gg2" class="gauge" data-value="<?php echo $TerminalSayisi['TERMINALSAYISI']; ?>"></div></center>
      <div class="caption">
        <h3>Terminal ve Terminal Gruplarınızı Ekleyin</h3>
        <p>El terminalleri ile sıradaki müsterinizi çağırabilirsiniz. Dilerseniz Sanal Terminal kurulumu yaparak herhangi bir terminal cihazı olmadan da Sıramatik sisteminizin kolay kullanım imkanlarından yararlanabilirsiniz.</p>
        <p>Terminal Panelinde Sizin için en uygun çalışma mantığını<strong> (Terminal bilgileri, Terminallerinizle Gruplarınız arasındaki çalışma ilişkisini)</strong> ayarlayabilirsiniz.</p>
        <p><a href="?TerminalEkle" class="form-control btn btn-warning" role="button">Devam</a> </p>
      </div>
    </div>
  </div>
    <div class="col-md-4">
    <div class="thumbnail" style="text-align:justify">
    <center><div id="gg3" class="gauge" data-value="<?php echo $BiletMakineSayisi['BILETMAKINESISAYISI']; ?>"></div></center>      
      <div class="caption">
        <h3>Bilet Makineleri ve Kioks Ayarlarınızı Yapın</h3>
        <p>Satın almış olduğunuz ürüne göre Biletleriniz ya normal bir bilet makinesi ya da kiosk sistemi içine entegre bilet makinesi şeklinde bulunmaktadır. </p>
        <p>Bu paneller sayesinde daha çok Kiosk Ekranından bilet verme işlemi için gerekli ayarları yapabilirsiniz. <strong>(Kioks ekran tasarımı, Bilet Makinesi ve Buton Tasarım ayarları bu panelden yapılmaktadır.)</strong></p>
        <p><a href="?BiletMakinesiEkle" class="form-control btn btn-danger" role="button">Bitir</a></p>
      </div>
    </div>
  </div>
</div>
  <script src="dist/js/raphael-2.1.4.min.js"></script>
  <script src="dist/js/justgage.js"></script>
  <script>
  document.addEventListener("DOMContentLoaded", function(event) {

    var dflt = {
      min: 0,
      max: 20,
      donut: true,
      gaugeWidthScale: 0.6,
      counter: true,
      hideInnerShadow: true,
	  startAnimationTime: 2000,
      startAnimationType: ">",
      refreshAnimationTime: 1000,
      refreshAnimationType: "bounce"

    }
    var gg1 = new JustGage({
      id: 'gg1',      
      title: 'Grup Sayısı',
      defaults: dflt
    });
    var gg2 = new JustGage({
      id: 'gg2',
      title: 'Terminal Sayısı',
      defaults: dflt
    });
 	var gg3 = new JustGage({
      id: 'gg3',
      title: 'Bilet Makinesi Sayısı',
      defaults: dflt
    });
  });
</script>
<?php }else{ ?><div class="alert alert-danger">SUNUCU AYARLARI YAPILANDIRLMAMIŞ! MUHTEMELEN VERİTABANINA BAĞLANAMADIK.<br> Lütfen Kurulum Yönergelerini İzleyiniz.</div><?php } ?>