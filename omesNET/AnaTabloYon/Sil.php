<?php
if ((isset($_GET['AnaTabloYonSil'])) && ($_GET['AnaTabloYonSil'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM ANATABLO_YON WHERE YID=:YID");
	$deleteSQL->bindParam(':YID',$_GET['AnaTabloYonSil'], PDO::PARAM_INT);
	$deleteSQL->execute();
                 
  $deleteGoTo = "?AnaTabloYonListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
Sadece AnaTabloYon silindi.