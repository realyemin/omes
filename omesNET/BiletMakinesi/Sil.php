<?php
if ((isset($_GET['BiletMakinesiSil'])) && ($_GET['BiletMakinesiSil'] != "")) {
	$deleteSQL1 = $db->prepare("DELETE FROM BILET_MAKINELERI WHERE MAKINE_ADRESI='$_GET[BiletMakinesiSil]'")->execute();
	$deleteSQL2 = $db->prepare("DELETE FROM BUTONLAR WHERE BM_ADRES='$_GET[BiletMakinesiSil]'")->execute();

  $deleteGoTo = "?BiletMakinesiEkle&Sil=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<p>Bilet Makinesi silindiğinde Butonlar tablosundaki BM_Adres'i uyanlarda silinecektir.</p>
