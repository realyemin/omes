<?php //require_once('../Connections/baglantim.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_GET['BiletMakinesiSil'])) && ($_GET['BiletMakinesiSil'] != "")) {
  $deleteSQL1 = sprintf("DELETE FROM bilet_makineleri WHERE MAKINE_ADRESI=%s",
                       GetSQLValueString($_GET['BiletMakinesiSil'], "int"));
$deleteSQL2 = sprintf("DELETE FROM butonlar WHERE BM_ADRES=%s",
                       GetSQLValueString($_GET['BiletMakinesiSil'], "int"));
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($deleteSQL1, $baglantim) or die(mysql_error());
$Result2 = mysql_query($deleteSQL2, $baglantim) or die(mysql_error());
  $deleteGoTo = "?BiletMakinesiEkle&Sil=ok&";
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

<body>
<p>Bilet Makinesi silindiğinde Butonlar tablosundaki BM_Adres'i uyanlarda silinecektir.</p>
</body>
</html>