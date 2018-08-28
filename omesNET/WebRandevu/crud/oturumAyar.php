<?php
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 05.06.2018
-- Description:	Bu panel web randevu sistemi için Gruplara göre oturum süre ayarları yapmak için yazıldı
-- ============================================= 
 */
 if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
{			
$oturum = $db->query("SELECT oturumSuresi, oturumSuresiGoster, dogrulamaKoduGoster FROM RANDEVU_AYAR WHERE GRPID='$GRPID'")->fetch();
if(isset($oturum['oturumSuresi']))
{	
?>
<div class="col-sm-4">
            <div class="panel panel-info">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Oturum Süresini Düzenleyin</h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="oturumSuresiForm" action="WebRandevu/crud/guncelle.php?guncelle">
			<table class="table table-hover">
				<tr>
					<td>Oturum Süresi(dk):</td>
					<td style="padding:5px" data-toggle="tooltip" title="Dakika cinsinden bir değer girebilirsiniz. Örn:5.">
					<input value="<?php echo $oturum['oturumSuresi']; ?>" required type="number" min="1" max="100" autocomplete="off" id="oturumSuresi" name="oturumSuresi" class="form-control"></td>
				</tr>
				<tr><td>Aktif:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="Oturum zamanlayıcısını gösterip/gizleyebilirsiniz." >
				<input type="checkbox" name="oturumSuresiGoster" <?php if($oturum['oturumSuresiGoster']==1){ echo "checked"; } ?> />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
					<button name="oturumDurumBtn" class="btn btn-primary form-control">Güncelle</button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  Oturum Güncelle
		  </div>
        </div>
		</div>
<?php } else{ ?>
<div class="col-sm-4 col-md-4">
            <div class="panel panel-info">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Oturum Süresini Kaydedin</h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="oturumSuresiForm" action="WebRandevu/crud/guncelle.php?guncelle">
			<table class="table table-hover">
				<tr>
					<td>Oturum Süresi(dk):</td>
					<td style="padding:5px" data-toggle="tooltip" title="Dakika cinsinden bir değer girebilirsiniz. Örn:5 dk">
					<input type="number" min="1" max="100" required autocomplete="off" id="oturumSuresi" name="oturumSuresi" class="form-control"></td>
				</tr>
				<tr><td>Aktif:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="Oturum zamanlayıcısını gösterip/gizleyebilirsiniz." >
				<input type="checkbox" name="oturumSuresiGoster" checked />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
					<button name="oturumDurumBtn" class="btn btn-success form-control">Kaydet</button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  Oturum Kaydet
		  </div>
        </div>
		</div>

<?php } ?>

		<div class="col-sm-4 col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h4><i class="glyphicon glyphicon-info-sign"></i><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Oturum Süresi Ön İzleme</h4>           
				</div>
				<div class="panel-body">
				<style>
.clock {
transform: scale(.4);
-ms-transform: scale(.4); 
-webkit-transform: scale(.4);
-o-transform: scale(.4); 
-moz-transform: scale(.4); 
}
.flip-clock-label{ display: none !important; }
</style>	
<div>Kalan Süreniz <div class="clock"></div></div>
<div class="message"></div>
<?php 

		$oturumSuresi = $db->query("SELECT oturumSuresi, oturumSuresiGoster FROM RANDEVU_AYAR WHERE GRPID='$GRPID'")->fetch();	
		if($oturumSuresi["oturumSuresiGoster"])
		{
			$oturumSureGoster=true;
			$_SESSION["sure"]=time()+intval($oturumSuresi["oturumSuresi"]*60); //dk cinsiden oturum sayacı			
		}
		else{
			$oturumSureGoster=false;
		}
		
	
	?>
	<script type="text/javascript">
		var clock;
		<?php if(isset($_SESSION["sure"])){
			?>
		var girisZamani=<?php echo intval($_SESSION["sure"]) ?>;
		var sure = <?php echo intval(time()); ?>;
			<?php
			 }else { ?>
		var girisZamani=100;
		var sure = 0;
		<?php } ?>
		var kalan=girisZamani-sure;	
		if(kalan<0){ kalan=100; }
		$(document).ready(function() {

			clock = $('.clock').FlipClock(kalan, {
		        clockFace: 'MinuteCounter',
		        countdown: true,
				language: "tr",
		        callbacks: {
		        	stop: function() {
		        		$('.message').html('Mesaj:Oturum Süreniz doldu!');
		
		        	}
						
		        }		
		    });			
		});	
	</script>
				</div>
				<div class="panel-footer">
				Bilgi Paneli
				</div>
			</div>
		</div>
<?php } ?>
