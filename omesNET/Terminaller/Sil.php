<?php
if ((isset($_GET['TerminalSil'])) && ($_GET['TerminalSil'] != "")) {
  	$deleteSQL = $db->prepare("DELETE FROM TERMINALLER WHERE TID=:TGID");
	$deleteSQL->bindParam(':TGID', $_GET['TerminalSil']);	
	$deleteSQL->execute(); 

  	$deleteSQL = $db->prepare("DELETE FROM TERMINAL_GRUP WHERE TID=:TGID");
	$deleteSQL->bindParam(':TGID', $_GET['TerminalSil']);	
	$deleteSQL->execute(); 
  
                      
  $deleteGoTo = "?TerminalListele&Sil=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
Hem <strong>terminal</strong> hem de <strong>terminal_grup</strong> tablosundaki veriler terminal ID'ye göre silindi
