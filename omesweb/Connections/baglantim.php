<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_baglantim = "localhost";
$database_baglantim = "qcu";
$username_baglantim = "root";
$password_baglantim = "nichtwar";
$baglantim = @mysql_pconnect($hostname_baglantim, $username_baglantim, $password_baglantim) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES 'utf8' ");
ob_start();
?>