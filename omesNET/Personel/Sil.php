<?php 
if ((isset($_GET['PersonelSil'])) && ($_GET['PersonelSil'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM PERSONELLER WHERE PID=:PID");
                       $deleteSQL->bindParam('PID',$_GET['PersonelSil']);
					$deleteSQL->execute();
	
  $deleteGoTo = "?Personel&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
PERSONELLER tabosundan PID ile kayıt silme işlemi
