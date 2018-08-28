<?php
 /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 10.06.2018
-- Description:	Mysql ve MSSql veritabani için oluşturma ve silme işlemleri birlikte yapıldı
-- Dinamik olarak Connections/baglantim.php dosyasını oluşturur ve Create / Drop işlemlerini
-- Ayrı ayrı yapabilir
-- ============================================= 
 */
if(isset($_POST) && isset($_POST['kaydet']))
{
	@($_POST['serverType'])?$_POST['serverType']='Mysql':$_POST['serverType']='Mssql';
	@($_POST['serverName']=="")?$_POST['serverName']='SUNUCU_ADI':$_POST['serverName'];
	@($_POST['databaseName']=="")?$_POST['databaseName']='QCU':$_POST['databaseName'];
	@($_POST['userName']=="")?$_POST['userName']='sa':$_POST['userName'];
	@($_POST['userPassword']=="")?$_POST['userPassword']='1234':$_POST['userPassword'];
	@($_POST['errorOnOff']=="on")?$_POST['errorOnOff']='true':$_POST['errorOnOff']='false';
	$scriptCreateDate=date("Y-m-d H:i:s");
$string="<?php
	/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: ".$scriptCreateDate."
-- Description:	Veritabanı ve ayarlar
-- ============================================= 
 */

$"."vt_turu=".'"'.$_POST['serverType'].'"'."; //Mssql veya Mysql seçebilirsiniz.
$"."sunucu=".'"'.$_POST['serverName'].'"'."; //Mssql için localhost veya EKOMURCU\\SQLEXPRESS
$"."veritabani=".'"'.$_POST['databaseName'].'"'."; //sunucuda QCU
$"."kullanici=".'"'.$_POST['userName'].'"'.";
$"."parola=".'"'.$_POST['userPassword'].'"'.";
$"."durum=".$_POST['errorOnOff'].";
if($"."durum){
	error_reporting(E_ALL);	
}else
{
	error_reporting(0);	
	function error_found(){
	header('Location: index.php');
	}
	set_error_handler('error_found');
}
date_default_timezone_set('Etc/GMT-3'); //Türkiye için yerel saat ayarı 
try {

    switch($"."vt_turu)
	{
		case \"Mysql\":
		$"."db = new PDO(\"mysql:host=$"."sunucu;dbname=mysql\", \"$"."kullanici\", \"$"."parola\");
		$"."db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$"."db->query(\"CREATE DATABASE IF NOT EXISTS $"."veritabani\");
		$"."db->query(\"use $"."veritabani\");
		$"."mesaj= \"Bağlantı hazır!\";
		$"."mesajHata=false;
		break;
		case \"Mssql\": //Sqlserver için pdo extension yüklü olmalı!
		$"."db = new PDO(\"sqlsrv:Server=$"."sunucu;Database=master\", \"$"."kullanici\", \"$"."parola\");
		$"."db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$"."db->query(\"if not exists(select * from sys.databases where name = '$"."veritabani')
			create database $"."veritabani\");
		$"."db->query(\"use $"."veritabani \");
		$"."mesaj= \"Bağlantı hazır!\";
		$"."mesajHata=false;		
		break;
		default:
		$"."mesaj= \"Veri tabanı için bir tür seçin(Mysql veya Mssql)\";
		$"."mesajHata=true;
		break;
	 
	}	
		$"."mesajHata=false;

} catch(PDOException $"."e ){
	$"."mesaj= \"Sunucu bağlantı ayarlarını kontrol ediniz!<br>\".$"."e->getMessage();
	$"."mesajHata=true;
}
finally
{
	ob_start();
}
?>";
	
$klasor="../Connections";
$dosya="baglantim.php";
$yol=$klasor."/".$dosya;
if(!file_exists($klasor))
{
	if(mkdir($klasor,700))
	{
		
		if(!file_exists($yol))
		{
			if(touch($yol))
			{
				$kaynak=fopen($yol,"w");
				$fwrite($kaynak,$string);
				fclose($kaynak);
			}
		}
	}
}
else
	{
		if(touch($yol))
			{
				$kaynak=fopen($yol,"w");
				fwrite($kaynak,$string);
				fclose($kaynak);
			}
	}
}
?>
<?php include("../Connections/baglantim.php"); ?>

  <div class="jumbotron alert alert-success">
    <h2><img src="images/veritabani_icon.png"> 1) SUNUCU PARAMETRELERİ</h2>      
    <p>Bu arayüz sayesinde veritabanı sunucusu için gerekli parametreleri ayarlayabilirsiniz.</p>
  </div>
  <div class="alert <?php if(isset($_POST['secim'])){ echo "alert-danger"; }else{ echo "alert-success";} ?>">
<form method="post">
 <strong>
 <?php if($vt_turu=="Mysql"){ ?>
 <img src="images/MySQL.png" class="img-responsive">
 <?php }else{ ?>
 <img src="images/MsSQL.png" class="img-responsive">
 <?php } ?></strong> Veritabanı Oluştur(Create):<label class="switch">
        <input name="secim" onChange="this.form.submit();" type="checkbox" <?php if(isset($_POST['secim'])){ echo "checked"; } ?>>
        <span class="slider round"></span></label>:Kaldır(Drop)<?php if(isset($_POST['secim'])){ echo "<br><strong>DİKKAT BU AYARLAR YALNIZCA SİSTEM YÖNETİCİLERİ TARAFINDAN YAPILMALIDIR!</strong>"; } ?> 
</form>
</div>
<?php
// DROP DATABASES

if(isset($_GET['dbName']) && isset($_POST['dbNameMysqlSilBtn']))
{
	$mesajHata=true;
	$mesaj="Seçili VERİTABANI(".$_GET['dbName'].") silindi! Silme işlemi hemen yansımayabilir.";
	try
	{
	//MYSQL DROP DATABASE
$drop="DROP DATABASE IF EXISTS ".$_GET['dbName'].";";
$drop=	$db->query($drop);
	}
	catch(PDOException $ex) 
	{
		
	$mesaj= $ex;
	$mesajHata=false;
	}
	
	
}
if(isset($_GET['dbName']) && isset($_POST['dbNameMssqlSilBtn']))
{	
	$mesajHata=true;
	$mesaj="Seçili VERİTABANI(".$_GET['dbName'].") silindi! Silme işlemi hemen yansımayabilir.";
	try{
	//MSSQL DROP DATABASE
	$string="USE master;
	DROP DATABASE IF EXISTS ".$_GET['dbName'].";";
	$drop=	$db->exec($string);
	}
	catch(PDOException $ex)
	{
	$mesaj= $ex;
	$mesajHata=false;
	}
}
?>
<!-- HATA MESAJLARI -->
<?php 
if($mesajHata){ ?>
 <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?php echo $mesaj; ?></strong>
  </div>
<?php }else{ ?>
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><?php echo $mesaj; ?></strong>
  </div>
<?php } ?>
<!-- HATA MESAJLARI -->
<?php if(!isset($_POST['secim']) ) { ?>
<form name="form1" method="post" action="" class="table table-responsive">
  <table class="table table-bordered table-hover">
  <thead>
    <tr>
        <th>Sunucu Türü(server type):</th>
      <td>Mssql:<label class="switch">
        <input name="serverType" type="checkbox" <?php if($vt_turu=="Mysql"){ echo "checked"; } ?>>
        <span class="slider round"></span></label>:Mysql
        </td>
		<th>Hata Ayıklama Modu(Error Mod):</th>
      <td>Kapalı:<label class="switch" data-toggle="tooltip" title="Aktif halde iken sunucu taraflı tüm hata kodları gözükür! (Açık olması önerilmez)">
        <input name="errorOnOff" type="checkbox" <?php if($durum){ echo "checked"; } ?> >
        <span class="slider round"></span></label>:Açık
        </td>
    </tr>
	</thead>
	<tbody>
	<tr>
      <th>Sunucu:</th>
      <td colspan="3">
        <input required class="form-control" name="serverName" type="text" value="<?php echo $sunucu; ?>">
       </td>	      
    </tr>
	<tr>
	<th>Veritabanı Adı(databaseName):</th>
	   <td colspan="3">
		<input required class="form-control" name="databaseName" type="text" value="<?php echo $veritabani; ?>">
		</td>
	</tr>
	<tr>		
	<th>Kullanıcı(userName):</th>
	<td>
		<input required class="form-control" name="userName" type="text" value="<?php echo $kullanici; ?>">
	</td>     	
      <th>Parola(password):</th>
      <td>
	  <input required class="form-control" name="userPassword" type="text" value="<?php echo $parola; ?>">
        </td>
    </tr>
	<tr><th colspan="4"><span style="color:red">*Not: Eğer mevcut bir veritabanı varsa sadece ayarları kaydeder. Kayıtlı olmayan bir veritabanı girilirse yeni bir veritabanı oluşturulur ve bu yeni veritabanı geçerli olur.</span></th></tr>
   </tbody>
  </table>
  <div id="mySidenav">
  <div id="kaydet">
  <input class="btn btn-success" type="submit" value="Kaydet" name="kaydet">
  </div>  
  </div>
</form>

<?php
 }else{ 
 
 if($vt_turu=="Mssql")
{
// MsSQL için veritabanı listesi
?>
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>VERİTABANI KALDIR</th>
<th colspan="2">Aktif Veritabanı:<span style="color:red"><?php echo $veritabani; ?></span><br>Kullanımda Olan Veritabanı Silenemez!</th>
</tr>
</thead>
<tbody>
<tr><th>Ad</th><th>Oluşturulma Tarihi</th><th>Kaldır</th></tr>	
<?php $rs = $db->query("SELECT name,create_date FROM sys.databases d WHERE d.database_id > 4 AND name <> '$veritabani'");
foreach($rs as $row) {
	?>
<tr>
<td>
<?php echo $row['name']; ?></td>
<td><?php echo substr($row['create_date'],0,19); ?></td>
<td>
<form method="post" action="?ana&dbName=<?php echo $row['name']; ?>">
<button name="dbNameMssqlSilBtn" class="btn btn-danger" onClick="if(confirm('Silmek istediğinizden emin misiniz?')){ this.form.submit(); }" data-toggle="tooltip" title="Dikkat bu işlem geri alınamaz ve tüm verileriniz kaybedersiniz">Kaldır</button>
<input type="hidden" value="<?php echo $_POST['secim']; ?>" name="secim">
</form>
</td>
</tr>
<?php } // MsSQL için veritabanı listesi ?>
</tbody>	 
</table>

<?php }else{
	//MYSQL için veritabani listesi
	?>

<table class="table table-bordered table-hover">
<thead>
<tr>
<th>VERİTABANI KALDIR</th>
<th>Aktif Veritabanı:<span style="color:red"><?php echo $veritabani; ?></span><br>Kullanımda Olan Veritabanı Silenemez!</th>
</tr>
</thead>
<tbody>
<tr><th>Ad</th><th>Kaldır</th></tr>	
<?php 
$rs = $db->query("select schema_name from information_schema.schemata WHERE schema_name NOT IN ('$veritabani','information_schema','mysql','performance_schema','sys')");
foreach($rs as $row) {
	?>
<tr>
<td>
<?php echo $row['schema_name']; ?></td>
<td><form method="post" action="?ana&dbName=<?php echo $row['schema_name']; ?>">
<button name="dbNameMysqlSilBtn" class="btn btn-danger" onClick="if(confirm('Silmek istediğinizden emin misiniz?')){ this.form.submit(); }" data-toggle="tooltip" title="Dikkat bu işlem geri alınamaz ve tüm verileriniz kaybedersiniz">Kaldır</button>
<input type="hidden" value="<?php echo $_POST['secim']; ?>" name="secim">
</form>
</td>
</tr>
<?php } //MYSQL için veritabani listesi?>
</tbody>	 
</table>

	<?php
} } ?>
