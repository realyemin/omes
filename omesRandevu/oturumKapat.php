<?php
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session variables
  $_SESSION['dogrula'] = NULL;
  $_SESSION['onay'] = NULL;
  $_SESSION['randevu'] = NULL;
  unset($_SESSION['sure']);
  unset($_SESSION['dogrula']);

	
  $logoutGoTo = ".";
  if ($logoutGoTo) {
    $konak  = $_SERVER['HTTP_HOST'];
	$yol   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$ek = '';

		header("Location: http://$konak$yol/$ek");
    exit;
  }
}


?>