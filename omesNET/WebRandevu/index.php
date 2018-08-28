<?php
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 11.05.2018
-- Description:	Randevu Sistemi Yönetim Paneli
-- ============================================= 
 */
// include("Connections/baglantim.php"); 
 include("fonksiyonlar/php/turkceTarih.php");
 ?>
 	<link rel="stylesheet" href="dist/plugin/datepicker/jquery-ui.css"><!--datepicker -->	
	<script src="dist/plugin/datepicker/jquery-ui.js"></script><!--datepicker -->
	<script type="text/javascript">
$(document).ready(function() {
    $('#tatilTarihi').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
        showAnim: "drop",   
		firstDay: 1
    });
	 $('#randevuBasTarihi').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
		firstDay: 1
    });
	$('#randevuBitTarihi').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
		maxDate:30,
		firstDay: 1
    });
});
</script>

  <?php include("crud/sistemAyarListele.php"); ?>    
  <div class="row ">
  <div class="col-sm-12">  
 <div class="row">  
	  <?php
	  if(isset($_GET['ana'])){ 
	  include('crud/alinanRandevular.php'); //<!-- randevu listele -->
	  }
	  ?>
	   <?php if(isset($_GET['takvim'])){ ?>
	  
		<?php include("crud/grupSecici.php"); ?>
		<?php include("crud/takvimAyar.php"); ?>
	

	  <?php } ?>
	   <?php if(isset($_GET['randevu'])){ ?>

		<?php include("crud/grupSecici.php"); ?>
		<?php include("crud/randevuAyar.php"); ?><!-- randevu kısıtlayıcı -->

	  <?php } ?>
	  <?php if(isset($_GET['sistem'])){ ?>

		<?php include("crud/sistemAyar.php"); ?><!-- sistem ac/kapat -->
  
	  <?php } ?>

	  <?php if(isset($_GET['tatil'])){ ?>
  
	    <?php include("crud/grupSecici.php"); ?>
		<?php include("crud/tatilAyar.php"); ?><!-- takvime tatil günü ekle -->

	  <?php }?>
	  <?php if(isset($_GET['oturum'])){ ?>
  
	    <?php include("crud/grupSecici.php"); ?>	
		<?php include("crud/oturumAyar.php"); ?><!-- randevu oturum süresi ekle -->	
		<?php include("crud/dogrulamaKodu.php"); ?><!-- randevu doğrulama kodu ekle -->
		
	  <?php }?>
	  <?php if(isset($_GET['mail'])){ ?>
  
	    <?php include("crud/grupSecici.php"); ?>
		<?php include("crud/epostaAyar.php"); ?><!-- takvime tatil günü ekle -->

	  <?php }?>
	<?php include('siteParts/sayfaBilgisi.php'); ?>
 </div>
    </div>
	</div>
<?php  include("siteParts/popupMesaj.php"); ?>
