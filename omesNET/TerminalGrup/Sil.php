<?php 
if ((isset($_GET['TerminalGrupSil'])) && ($_GET['TerminalGrupSil'] != "")) {
	$deleteSQL = $db->prepare("DELETE FROM TERMINAL_GRUP WHERE TGID=:TGID");
	$deleteSQL->bindParam(':TGID', $_GET['TerminalGrupSil']);	
	$deleteSQL->execute(); 


  $deleteGoTo = "?TerminalListele&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
Terminal grup tablosundan ilişkili kayıt silindi.