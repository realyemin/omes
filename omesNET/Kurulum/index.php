<?php include("../Connections/baglantim.php");
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
		$_SESSION['kAdi'] = NULL;
		$_SESSION['PrevUrl'] = NULL;
		unset($_SESSION['kAdi']);
		unset($_SESSION['MM_UserGroup']);
		unset($_SESSION['PrevUrl']);
		
		$logoutGoTo = ".";
		if ($logoutGoTo) {
			header("Location: $logoutGoTo");
			exit;
		}
	} ?>
	<!DOCTYPE HTML>
	<html lang="en">
		<head>
			<title>Omes Web</title>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="description" content="Kiosk, Bilet, Sıramatik Sistemleri">
			<meta name="author" content="E.KÖMÜRCÜ">
			<link rel="shortcut icon" href="../dist/img/ico/favicon.ico">
			<!-- Bootstrap core CSS -->
			<script src="../dist/js/jquery-1.10.2.min.js" type="text/javascript"></script>
			<script src="../dist/js/bootstrap.min.js" type="text/javascript"></script>   
			<link href="../dist/css/bootstrap.min.css" rel="stylesheet">
			<link href="../dist/css/girisModal.css" rel="stylesheet">
			<link href="css/custom_style.css" rel="stylesheet">
		</head>
		<body>
			<?php 
				include('siteParts/navbar.php');
				include('siteParts/menu.php');
			include("giris.php"); ?>
			<div class="container">
				<div class="row ">
					<div class="col-sm-10"> 
						<?php
							if(isset($_SESSION['kAdi']))
							{
								if(isset($_GET['ana']) || empty($_GET) || isset($_GET['login'])){ include("siteParts/create_server.php"); }
								else if(isset($_GET['create'])){ include("siteParts/create_table.php"); }
								else if(isset($_GET['insert'])){ include("siteParts/insert_data.php"); }
								}else{
							?>
							<div class="alert alert-danger">Lütfen Giriş Yapınız</div>
							<?php
							}
						?>	
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('[data-toggle="tooltip"]').tooltip(); 
				});
			</script>
		</body>
	</html>	