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
//Grubu sil
if ((isset($_GET['GrupSil'])) && ($_GET['GrupSil'] != "")) {
  $deleteSQL = sprintf("DELETE FROM gruplar WHERE GRPID=%s",
                       GetSQLValueString($_GET['GrupSil'], "int"));
					   //Biletleri sil
$deleteSQL2 = sprintf("DELETE FROM biletler WHERE GRPID=%s",
                       GetSQLValueString($_GET['GrupSil'], "int"));
					   //Butonları sil
$deleteSQL3 = sprintf("DELETE FROM butonlar WHERE GRP_ID=%s",
                       GetSQLValueString($_GET['GrupSil'], "int"));
					   //Kuyruk sil
$deleteSQL4 = sprintf("DELETE FROM kuyruk WHERE GRPID=%s",
                       GetSQLValueString($_GET['GrupSil'], "int"));
					   //TerminalGrup sil
$deleteSQL5 = sprintf("DELETE FROM terminal_grup WHERE GRPID=%s",
                       GetSQLValueString($_GET['GrupSil'], "int"));
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($deleteSQL, $baglantim) or die(mysql_error());
$Result2 = mysql_query($deleteSQL2, $baglantim) or die(mysql_error());
$Result3 = mysql_query($deleteSQL3, $baglantim) or die(mysql_error());
$Result4 = mysql_query($deleteSQL4, $baglantim) or die(mysql_error());
$Result5 = mysql_query($deleteSQL5, $baglantim) or die(mysql_error());

  $deleteGoTo = "?GrupListele&Sil=ok&";
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
<p>Bir grup silindiği taktirde:</p>
<p>Grup tablosu, Terminal tablosu, Terminal_Grup tablosu, </p>
<p>Biletler, Butonlar ve Kuyruk tablolarındaki ilgili tüm kayıtlar silinir.</p>
</body>
</html>