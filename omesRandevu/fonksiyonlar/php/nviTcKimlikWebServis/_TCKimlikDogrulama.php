<?php
  function tcno_dogrula($bilgiler){
    $gonder = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
    <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
    <TCKimlikNo>'.$bilgiler["tcno"].'</TCKimlikNo>
    <Ad>'.$bilgiler["isim"].'</Ad>
    <Soyad>'.$bilgiler["soyisim"].'</Soyad>
    <DogumYili>'.$bilgiler["dogumyili"].'</DogumYili>
    </TCKimlikNoDogrula>
    </soap:Body>
    </soap:Envelope>';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,            "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_POST,           true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS,    $gonder);
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
    'POST /Service/KPSPublic.asmx HTTP/1.1',
    'Host: tckimlik.nvi.gov.tr',
    'Content-Type: text/xml; charset=utf-8',
    'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
    'Content-Length: '.strlen($gonder)
    ));
    $gelen = curl_exec($ch);
    curl_close($ch);
      return strip_tags($gelen);
  }
$bilgiler = array(
"isim"      => "ERTUĞRUL", // Isım büyük harflerle yazılmak zorunda
"soyisim"   => "KÖMÜRCÜ", // Soyisim Buyuk harflerle yazılmak zorunda
"dogumyili" => "1985",
"tcno"      => "30319855442"
);
$sonuc = tcno_dogrula($bilgiler);
if($sonuc=="true"){
echo "Doğrulama başarılı";
}else{
echo "Doğrulama başarısız";
}
?>
<?php
$sure_baslangici = microtime(true);

 
$sure_bitimi = microtime(true);
$sure = $sure_bitimi - $sure_baslangici;
echo "<br>Bekleme süresi: ".substr($sure,0,4)." saniye.\n";
 
//PHP kodlarına ayrılan belleğin miktarını bayt cinsinden döndürür.
echo 'Hafıza kullanımı: ',round(memory_get_peak_usage()/1048576, 2), 'MB';
?>