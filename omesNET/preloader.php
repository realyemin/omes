<style>
/* Preloader */
#preloader {
	background-color:#FFF; /* change if the mask should have another color then white */
	z-index:99; /* makes sure it stays on top */
}
.loader {
position: fixed;
top:0;left:0;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-bottom: 16px solid red;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<script type="text/javascript">
	//<![CDATA[
		$(window).on('load', function() { // makes sure the whole site is loaded 
			$('#status').fadeOut(); // will first fade out the loading animation 
            $('#preloader').delay(5).fadeOut('slow'); // will fade out the white DIV that covers the website. 
            $('body').delay(5).css({'overflow':'visible'});
		})
	//]]>
</script> 
    <div id="preloader" class="loader">
	<div id="status">&nbsp;</div>
    </div>