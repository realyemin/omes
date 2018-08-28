<?php
	try{
		
				//Grubu sil
if ((isset($_GET['GrupSil'])) && ($_GET['GrupSil'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM GRUPLAR WHERE GRPID=:GRPID");
	$deleteSQL->bindParam(':GRPID', $_GET['GrupSil']);	
	$deleteSQL->execute(); //sorguyu çalıştır

					   //Biletleri sil
 $deleteSQL = $db->prepare("DELETE FROM BILETLER WHERE GRPID=:GRPID");
	$deleteSQL->bindParam(':GRPID', $_GET['GrupSil']);	
	$deleteSQL->execute(); //sorguyu çalıştır
					   //Butonları sil
 $deleteSQL = $db->prepare("DELETE FROM BUTONLAR WHERE GRP_ID=:GRPID");
	$deleteSQL->bindParam(':GRPID', $_GET['GrupSil']);	
	$deleteSQL->execute(); //sorguyu çalıştır
					   //Kuyruk sil
 $deleteSQL = $db->prepare("DELETE FROM KUYRUK WHERE GRPID=:GRPID");
	$deleteSQL->bindParam(':GRPID', $_GET['GrupSil']);	
	$deleteSQL->execute(); //sorguyu çalıştır
					   //TerminalGrup sil
 $deleteSQL = $db->prepare("DELETE FROM TERMINAL_GRUP WHERE GRPID=:GRPID");
	$deleteSQL->bindParam(':GRPID', $_GET['GrupSil']);	
	$deleteSQL->execute(); //sorguyu çalıştır
 
}
	}
	catch(PDOExeption $ex)
	{
		
	}
	finally
	{
		
		$deleteGoTo = "?GrupListele&Sil=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
	}
	
?>
<p>Bir grup silindiği taktirde:</p>
<p>Grup tablosu, Terminal tablosu, Terminal_Grup tablosu, </p>
<p>Biletler, Butonlar ve Kuyruk tablolarındaki ilgili tüm kayıtlar silinir.</p>