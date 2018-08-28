<?php //require_once('../Connections/baglantim.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_baglantim, $baglantim);
$query_GrupSayisi = "SELECT count(*) FROM gruplar";
$GrupSayisi = mysql_query($query_GrupSayisi, $baglantim) or die(mysql_error());
$row_GrupSayisi = mysql_fetch_assoc($GrupSayisi);
$totalRows_GrupSayisi = mysql_num_rows($GrupSayisi);

mysql_select_db($database_baglantim, $baglantim);
$query_TerminalSayisi = "SELECT count(*) FROM terminaller";
$TerminalSayisi = mysql_query($query_TerminalSayisi, $baglantim) or die(mysql_error());
$row_TerminalSayisi = mysql_fetch_assoc($TerminalSayisi);
$totalRows_TerminalSayisi = mysql_num_rows($TerminalSayisi);

mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakineSayisi = "SELECT count(*) FROM bilet_makineleri";
$BiletMakineSayisi = mysql_query($query_BiletMakineSayisi, $baglantim) or die(mysql_error());
$row_BiletMakineSayisi = mysql_fetch_assoc($BiletMakineSayisi);
$totalRows_BiletMakineSayisi = mysql_num_rows($BiletMakineSayisi);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Defaults</title>
  <meta name="viewport" content="width=device-width">
  <style>

  .gauge {
    width: 250px;
    height: 250px;
    display: inline-block;
  }

  </style>
</head>

<body>
<div class="container">
<div class="row" style="margin-top:20px">
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail" style="text-align:justify">
      <center><div id="gg1" class="gauge" data-value="<?php echo $row_GrupSayisi['count(*)']; ?>"></div></center>
      <div class="caption">
        <h3> Gruplarınızı Oluşturun</h3>
        <p>Tebrikler! Satın almış olduğunuz sıramatik sistemiyle web uyumlu pratik bir kurulum panelininde sahibi oldunuz.</p>
        <p>İşe öncelikle Sıra Numarası vereceğiniz Birimlerin Grup Bilgilerini<strong>(Grup İsmi, Biletlerin Gruplara göre başlangıç ve bitiş numaralarını örn: 1.Banko 1000 -1500 arası 2.Banko 2000-2700 arası bilet verecek şeklinde., Minumum ve Maksimum çalışma sürelerini, Bilet üzerinde istatistiki bilgileri, Çalışma zamanını(sabah,öğle molası, akşam mesaisi) ve Verilecek Bilet Sınırı gibi )</strong>bu panel yardımıyla ayarlayabilirsiniz.</p>
        <p><a href="?GrupEkle" class="form-control btn btn-primary" role="button">Başla</a></p>
      </div>
    </div>
  </div>
  
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail" style="text-align:justify">
      <center><div id="gg2" class="gauge" data-value="<?php echo $row_TerminalSayisi['count(*)']; ?>"></div></center>
      <div class="caption">
        <h3>Terminal ve Terminal Gruplarınızı Ekleyin</h3>
        <p>El terminalleri ile sıradaki müsterinizi çağırabilirsiniz. Dilerseniz Sanal Terminal kurulumu yaparak herhangi bir terminal cihazı olmadan da Sıramatik sisteminizin kolay kullanım imkanlarından yararlanabilirisiniz.</p>
        <p>Terminal Panelinde Sizin için en uygun çalışma mantığını<strong> (Terminal bilgileri, Terminallerinizle Gruplarınız arasındaki çalışma ilişkisini)</strong> ayarlayabilirsiniz.</p>
        <p><a href="?TerminalEkle" class="form-control btn btn-warning" role="button">Devam</a> </p>
      </div>
    </div>
  </div>
  
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail" style="text-align:justify">
    <center><div id="gg3" class="gauge" data-value="<?php echo $row_BiletMakineSayisi['count(*)']; ?>"></div></center>
      
      <div class="caption">
        <h3>Bilet Makineleri ve Kioks Ayarlarınızı Yapın</h3>
        <p>Satın almış olduğunuz ürüne göre Biletleriniz ya normal bir bilet makinesi ya da kiosk sistemi içine entegre bilet makinesi şeklinde bulunmaktadır. </p>
        <p>Bu paneller sayesinde daha çok Kiosk Ekranından bilet verme işlemi için gerekli ayarları yapabilirsiniz. <strong>(Kioks ekran tasarımı, Bilet Makinesi ve Buton Tasarım ayarları bu panelden yapılmaktadır.)</strong></p>
        <p><a href="?BiletMakinesiEkle" class="form-control btn btn-danger" role="button">Bitir</a></p>
      </div>
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
</body>

</html>
<?php
mysql_free_result($GrupSayisi);

mysql_free_result($TerminalSayisi);

mysql_free_result($BiletMakineSayisi);
?>
