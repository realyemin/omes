﻿<?php //require_once('../Connections/baglantim.php'); ?>
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

if ((isset($_GET['TerminalSil'])) && ($_GET['TerminalSil'] != "")) {
  $deleteSQL = sprintf("DELETE FROM terminaller WHERE TID=%s",
                       GetSQLValueString($_GET['TerminalSil'], "int"));
$deleteSQL2 = sprintf("DELETE FROM terminal_grup WHERE TID=%s",
                       GetSQLValueString($_GET['TerminalSil'], "int"));
  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($deleteSQL, $baglantim) or die(mysql_error());
$Result2 = mysql_query($deleteSQL2, $baglantim) or die(mysql_error());
  $deleteGoTo = "?TerminalListele&Sil=ok&";
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
Hem <strong>terminal</strong> hemde <strong>terminal_grup</strong> tablosundaki veriler terminal ID'ye göre silindi
</body>
</html>