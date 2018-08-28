<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
 <style>
	  body {
	overflow: hidden;
}

/* Preloader */
#preloader {
	position: fixed;
	top:0;
	left:0;
	right:0;
	bottom:0;
	background-color:#FFF; /* change if the mask should have another color then white */
	z-index:99; /* makes sure it stays on top */
}

#status {
	width:200px;
	height:200px;
	position:absolute;
	left:50%; /* centers the loading animation horizontally one the screen */
	top:50%; /* centers the loading animation vertically one the screen */
	background-image:url(img/status.gif); /* path to your loading animation */
	background-repeat:no-repeat;
	background-position:center;
	margin:-100px 0 0 -100px; /* is width and height divided by two */
}
	  </style>
	  

     <script type="text/javascript">
	//<![CDATA[
		$(window).on('load', function() { // makes sure the whole site is loaded 
			$('#status').fadeOut(); // will first fade out the loading animation 
            $('#preloader').delay(50).fadeOut('slow'); // will fade out the white DIV that covers the website. 
            $('body').delay(50).css({'overflow':'visible'});
		})
	//]]>
</script> 
</head>

<body>
    <div id="preloader">
	<div id="status">&nbsp;</div>
    </div>
      
  

</body>
</html>