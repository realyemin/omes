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

if ((isset($_GET['BM_ADRES'])) && ($_GET['BM_ADRES'] != "") && (isset($_GET['BTNID'])) && ($_GET['BTNID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM butonlar WHERE BM_ADRES=%s and BTNID=%s or ANA_BTNID=%s",
                       GetSQLValueString($_GET['BM_ADRES'], "int"),
					   GetSQLValueString($_GET['BTNID'], "int"),
					   GetSQLValueString($_GET['BTNID'], "int"));

  mysql_select_db($database_baglantim, $baglantim);
  $Result1 = mysql_query($deleteSQL, $baglantim) or die(mysql_error());

  $deleteGoTo = "?AnaButonEkle&Listele=".$_GET['BM_ADRES']."&#ust&";
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
Butonlar tablosundan bir Ana buton silindiğinde ona ait tüm alt butonlarda silinir.
</body>
</html>