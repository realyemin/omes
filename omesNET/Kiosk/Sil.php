<?php 
if ((isset($_GET['KioskSil'])) && ($_GET['KioskSil'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM KIOSK_AYAR WHERE KID=:KID");
  $deleteSQL->bindParam(':KID',$_GET['KioskSil']);
  $deleteSQL->execute();

  $deleteGoTo = "?KioskEkle=SilOk&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
else
{
	 header(sprintf("Location: %s", "?KioskEkle=SilEksik"));
}
?>
Koisk Ayar tablosundan ilgili kiosk silinir