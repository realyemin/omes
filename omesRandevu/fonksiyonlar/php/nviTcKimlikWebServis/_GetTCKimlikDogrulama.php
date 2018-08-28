<?php

try {

    $istek = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');

    print_r($istek->__getFunctions());

    echo "<hr />";

    print_r($istek->__getTypes());

    echo "<hr />";
    
} catch (Exception $exc) {

    echo $exc->getMessage();
}

?>
<?php

try {

    $istek = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');

    $sonuc = $istek->TCKimlikNoDogrula(array(
        'TCKimlikNo' => 30319855442,
        'Ad' => 'ERTUĞRUL',
        'Soyad' => 'KÖMÜRCÜ',
        'DogumYili' => 1985)
    );

    if ($sonuc->TCKimlikNoDogrulaResult) {
        echo "Bilgiler doğru";
    } else {
        echo "Bilgiler hatalı";
    }

} catch (Exception $exc) {

    echo $exc->getMessage();
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