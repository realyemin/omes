<?php
/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 05.06.2018
-- Description:	Bu panel web randevu sistemi için Gruplara göre doğrulama kodunu açıp kapamak için yazıldı
-- ============================================= 
 */
 if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
{			
$dogrulama = $db->query("SELECT dogrulamaKoduGoster FROM RANDEVU_AYAR WHERE GRPID='$GRPID'")->fetch();
if(isset($dogrulama['dogrulamaKoduGoster']))
{	
?><div class="clearfix"></div>
<div class="col-md-4">&nbsp;</div>
<div class="col-sm-4">
            <div class="panel panel-warning">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Doğrulama kodu ayarı</h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="dogrulamaKoduForm" action="WebRandevu/crud/guncelle.php?guncelle">
			<table class="table table-hover">
				<tr><td>Göster/Gizle:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="Doğrulama Kodunu gösterip/gizleyebilirsiniz." >
				<input type="checkbox" name="dogrulamaKoduGoster" <?php if($dogrulama['dogrulamaKoduGoster']==1){ echo "checked"; } ?> />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
					<button name="dogrulamaKoduBtn" class="btn btn-primary form-control">Güncelle</button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  Doğrulama kodu Güncelle
		  </div>
        </div>
		</div>
<?php } else{ ?>
<div class="col-sm-4 col-md-4">
            <div class="panel panel-warning">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Doğrulama kodu ayarı</h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="dogrulamaKoduForm" action="WebRandevu/crud/guncelle.php?guncelle">
			<table class="table table-hover">

				<tr><td>Göster/Gizle:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="Doğrulama Kodunu gösterip/gizleyebilirsiniz." >
				<input type="checkbox" name="dogrulamaKoduGoster" checked />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
					<button name="dogrulamaKoduBtn" class="btn btn-success form-control">Kaydet</button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  Doğrulama kodu Kaydet
		  </div>
        </div>
		</div>

<?php } } ?>
<?php if(isset($dogrulama['dogrulamaKoduGoster']) && $dogrulama['dogrulamaKoduGoster']!=0)
{	
?>
<div class="col-sm-4 col-md-4">
            <div class="panel panel-warning">
				<div class="panel-heading">        
			<h4><i class="glyphicon glyphicon-info-sign"></i><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Doğrulama Kodu Ön İzleme</h4>
			</div>
			<div class="panel-body">
			
		<tr>
			<td class="alert alert-info">Güvenlik kodu:
				<button type="button" onClick="this.form.submit();" title="Yenile"><img src="../fonksiyonlar/php/capthca.php" ></button>
				<br><span style="font-size:8pt; color:red">*Büyük-Küçük harfe duyarlıdır.</span>
			</td>
			<td class="alert alert-info" >
			
				<input type="text" maxlength="5" id="dogrulamaKodu" name="dogrulamaKodu"  tabindex="3" class="form-control" placeholder="Yandaki kodu giriniz"  autocomplete="off"  >
			</td>
		</tr>
          </div>
		  <div class="panel-footer">
		  Bilgi Paneli
		  </div>
        </div>
		</div>
<?php } ?>
