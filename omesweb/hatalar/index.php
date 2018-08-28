<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Hata Sayfası</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<div class="jumbotron">
  <h1>

<?php 
switch($_GET['hata'])
{
	case 404:
		echo "Opss! Aradığınız Sayfa bulunamadı! 404";
	break;
	case 400:
		echo "Opss! Aradığınız Sayfa bulunamadı! 400";
	break;
	case 401:
		echo "Opss! Aradığınız Sayfa bulunamadı! 401";
	break;
	case 403:
		echo "Opss! Aradığınız Sayfa bulunamadı! 403";
	break;
	case 500:
		echo "Opss! Aradığınız Sayfa bulunamadı! 500";
	break;
	case 501:
		echo "Opss! Aradığınız Sayfa bulunamadı! 501";
	break;
	case 502:
		echo "Opss! Aradığınız Sayfa bulunamadı! 502";
	break;
	case 503:
		echo "Opss! Aradığınız Sayfa bulunamadı! 503";
	break;
}
404
?></h1> </div>
</body>
</html> 