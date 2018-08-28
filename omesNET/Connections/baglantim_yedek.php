<?php
	/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 2018-06-09 00:00:52
-- Description:	Veritabanı ve ayarlar
-- ============================================= 
 */

$vt_turu="Mssql"; //Mssql veya Mysql seçebilirsiniz.
$sunucu="EKOMURCU\SQLEXPRESS"; //Mssql için localhost veya EKOMURCU\SQLEXPRESS
$veritabani="QCU2.MDF"; //sunucuda QCU
$kullanici="sa";
$parola="1234";
$durum=true;
if($durum){
	error_reporting(E_ALL);	
}else
{
	error_reporting(0);	
	function error_found(){
	header('Location: oops.php');
	}
	set_error_handler('error_found');
}
date_default_timezone_set('Etc/GMT-3'); //Türkiye için yerel saat ayarı 
try {

    switch($vt_turu)
	{
		case "Mysql":
		$db = new PDO("mysql:host=$sunucu;dbname=$veritabani", "$kullanici", "$parola");
		$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");	
		$mesaj= "Bağlantı ayarlarınız yapıldı!";
		$mesajHata=false;
		break;
		case "Mssql": //Sqlserver için pdo extension yüklü olmalı!
		$db = new PDO("sqlsrv:Server=$sunucu;Database=$veritabani", "$kullanici", "$parola");
		$db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$mesaj= "Bağlantı ayarlarınız yapıldı!";
		$mesajHata=false;		
		break;
		default:
		$mesaj= "Veri tabanı için bir tür seçin(Mysql veya Mssql)";
		$mesajHata=true;
		break;
	 
	}	$mesaj= "Bağlantı ayarlarınız yapıldı!";
		$mesajHata=false;

} catch(PDOException $e ){
	$mesaj= "Sunucu bağlantı ayarlarını kontrol ediniz!<br>".$e->getMessage();
	$mesajHata=true;
}
finally
{
	ob_start();
}
?>