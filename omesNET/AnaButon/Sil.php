<?php 
if ((isset($_GET['BM_ADRES'])) && ($_GET['BM_ADRES'] != "") && (isset($_GET['BTNID'])) && ($_GET['BTNID'] != "")) {
  $deleteSQL = $db->prepare("DELETE FROM BUTONLAR WHERE BM_ADRES=:BM_ADRES AND BTNID=:BTNID OR ANA_BTNID=:ANA_BTNID");
                       $deleteSQL->bindParam(':BM_ADRES', $_GET['BM_ADRES']);
                       $deleteSQL->bindParam(':BTNID', $_GET['BTNID']);
                       $deleteSQL->bindParam(':ANA_BTNID', $_GET['BTNID']);
                 $deleteSQL->execute();


  $deleteGoTo = "?AnaButonEkle&Listele=".$_GET['BM_ADRES']."&#ust&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
Butonlar tablosundan bir Ana buton silindiğinde ona ait tüm alt butonlar da silinir.
