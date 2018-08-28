<?php
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 10.04.2018
-- Description:	Veritabanı ve ayarlar
-- ============================================= 
 */
$vt_turu="Mssql"; //Mssql veya Mysql seçebilirsiniz.
$sunucu="EKOMURCU\\SQLEXPRESS"; //Mssql için localhost veya EKOMURCU\\SQLEXPRESS
$veritabani="QCU.MDF";
$kullanici="sa";
$parola="1234";
$kiosk_id=130;//hangi kiosk için çalışacak ise onun id'sini girin
date_default_timezone_set('Etc/GMT-3'); //istanbul için yerel saat ayarı 
try {

    switch($vt_turu)
	{
		case "Mysql":
		$db = new PDO("mysql:host=$sunucu;dbname=$veritabani", "$kullanici", "$parola");
		//$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");	
		break;
		case "Mssql": //Sqlserver için pdo extension yüklü olmalı!
		$db = new PDO("sqlsrv:Server=$sunucu;Database=$veritabani", "$kullanici", "$parola");
		//$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		break;
		default:
		echo "Veri tabanı için bir tür seçin(Mysql veya Mssql)";
		break;
	 
	}	
		
} catch(PDOException $e ){
	echo "Sunucu bağlantı ayarlarını kontrol ediniz!";
    print $e->getMessage();
}
?>