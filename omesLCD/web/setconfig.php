<?php
//arkaplan rengi windows için (-)negatif değerli ifade (+)pozitife çevrildi
function signedint32($value) {
    $i = (int)$value;
    if (PHP_INT_SIZE > 4)   // e.g. php 64bit
        if($i & 0x80000000) // is negative
            return $i - 0x100000000;
    return $i;
}
function signed2hex($value, $reverseEndianness = false) //4bayt FF,FF,FF,FF şeklinde argb değerini elde etmek için
{
    $packed = pack('N', $value);//veritabanından okurken bunu kullan
    $hex='';
    for ($i=0; $i < 4; $i++){
        $hex .= strtoupper( str_pad( dechex(ord($packed[$i])) , 2, '0', STR_PAD_LEFT) );
    }
    $tmp = str_split($hex, 2);
    $out = implode('', ($reverseEndianness ? array_reverse($tmp) : $tmp));
    return $out;
}

$EkranNo=0;
$UstBaslik="LCD Demo1";
$AltBaslik="LCD Demo2";
$VideoURL="http://www.trt.net.tr/anasayfa/canli.aspx?y=tv&amp;k=trt1";
$SesURL="";
$PORT_Gonderici=505;
$PORT_Alici=506;
$DefaultFormID=1;
$AnatabloID=130; //BeklemeListesiSet.php 
$ClientIP="";
$OtoIP=True;
$KayanYaziFont="Microsoft Sans Serif, Consolas, Arial, Helvetica, sans-serif";
$KayanYaziPunto=36;
$KayanYaziRenk=-657931;
$KayanYaziArkaPlanRenk=-13395457;
$Sutun1="Bilet No";
$Sutun2="Vezne No";
$SutunRenk=-16777216; 
$SutunYaziOzellik="italic"; //italic, 2 regular cagrilar için başlık tipi
$SutunYaziKalinlik="900"; //100-900 arası
$LCDArkaplanRenk=-6703919;
$UstBaslikKaysin=True;
$AltBaslikKaysin=True;
$UstBaslikYon=True;
$AltBaslikYon=True;
$UstBaslikHiz=10;
$AltBaslikHiz=10;
$LCDFormArkaplanRenk=-13395457;
$CagNoFont="Arial, Helvetica, sans-serif";
$CagNoRenk=0;
$CagNoPunto=60;
$SaatYukseklik=140;
$TvKaynak="Yok";
$TvKaynakIndex="-1";
$TvKanal=0;
$ServerIP="ekomurcu";
$MediaTipi=4;
$WebBrowserUrl="http://omes.net/";
$CagNoPuntoTekSatir=250;
$Ses="Dosyadan";
$SatirSayisi=5;
$dbUserName="root";
$dbPassword="nichtwar";
$dbName="qcu";
//..........ertu
$bekleyenler_metni="BEKLEYENLER";
$sirano_metni="SIRA NO";
$bekleyenFont="Consolas, Arial, Helvetica, sans-serif";
$bekleyenPunto=30;
$bekleyenRenk=0;
$bekleyenArkaPlanRenk=-13395457;
$saatpunto=36;
$SutunPunto=36;
$SutunFont="Arial, Helvetica, sans-serif";
$SutunArkaplanRenk=-6703919;
?>