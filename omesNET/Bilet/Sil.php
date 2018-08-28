<?php 
if ((isset($_GET['BiletSil'])) && ($_GET['BiletSil'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM BILET_AYAR WHERE KID=:KID");
	$deleteSQL->bindParam(':KID', $_GET['BiletSil']);	
	$deleteSQL->execute(); 
	
 $deleteGoTo = "?BiletEkle=SilOk&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>
Bilet ayar tablosundan ilgili bilet ayarları silinir
<body>
</body>
</html>