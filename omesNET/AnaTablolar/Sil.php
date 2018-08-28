<?php 
if ((isset($_GET['AnaTabloSil'])) && ($_GET['AnaTabloSil'] != "")) {

  $deleteSQL = $db->prepare("DELETE FROM ANATABLOLAR WHERE ATID=:ATID");
				$deleteSQL->bindParam(':ATID', $_GET['AnaTabloSil']);   
                $deleteSQL->execute();
				 
  $deleteGoTo = "?AnaTabloListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
Sadece Ana Tablo silindi.
