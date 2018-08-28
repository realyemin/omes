		<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
		{
			?>
		<div class="col-sm-4">
          <div class="panel panel-warning">
				<div class="panel-heading">
            <h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Randevuları kısıtlayın</h4>
            </div>
			<div class="panel-body table-responsive">
				<form name="haftaSonuDurumFormu" <?php if($row->rowCount()){ echo "action='webrandevu/crud/guncelle.php?guncelle'";}else {echo "action='webrandevu/crud/ekle.php?ekle'";} ?> method="post">	
				<table class="table table-hover">	
					<tr><td>1</td><td>Sadece hafta sonu verme:</td>
					<td>
				 <label class="switch" data-toggle="tooltip" title="Hafta sonu(Cumartesi ve Pazar) Randevu verilmesini engelleyebilirsiniz! Not: Sistem kapatılmaz sadece randevu verilmez" >
					<input type="radio" name="randevuSecimi" value="1" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==1){ echo "checked"; }?>
					>
					<span class="slider round"></span>
				</label>
				</td>
				</tr>
				<tr><td>2</td><td>Hem hafta sonu hem de hafta içi <strong><a href="?WebRandevu&tatil=on">seçili</a></strong> günlerde verme:</td>
					<td>
				<label class="switch" data-toggle="tooltip" title="Hem hafta sonu hem de hafta içi seçili günlerde randevuyu engelleyebilirsiniz! Not: Sistem kapatılmaz sadece randevu verilmez" >
					<input type="radio" name="randevuSecimi" value="2" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==2){ echo "checked"; }?>
					>
					<span class="slider round"></span>
				</label>
				</td>
				</tr>
				<tr><td>3</td><td>Sadece <strong><a href="?WebRandevu&tatil=on">seçili</a></strong> günlerde verme:</td>
					<td>
				<label class="switch" data-toggle="tooltip" title="Sadece seçili günlerde randevu almayı engelleyebilirsiniz! Not: Sistem kapatılmaz sadece randevu verilmez" >
					<input type="radio" name="randevuSecimi" value="3" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==3){ echo "checked"; }?>
					>
					<span class="slider round"></span>
				</label>
				</td>
				</tr>
				<tr><td>4</td><td>Her güne randevu ver(Kısıtlama Yok):</td> 
					<td>
				<label class="switch" data-toggle="tooltip" title="Tatiller dahil! Her güne randevu verebilirsiniz." >
					<input type="radio" name="randevuSecimi" value="4" <?php if(isset($row_RandevuAyar['randevuSecimi']) && $row_RandevuAyar['randevuSecimi']==4){ echo "checked"; }?>
					>
					<span class="slider round"></span>
				</label>				
				</td>
				</tr>
				<tr><td colspan="2">
				<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
				<?php if($row->rowCount()){ ?>
				<button name="haftaSonuDurumBtn" class="btn btn-warning form-control">Güncelle</button>
				<?php }else{ ?>
				<button name="haftaSonuDurumBtn" class="btn btn-success form-control">Kaydet</button>	
				<?php } ?>
				</td>
				</tr>
				</form>
			</table>
			</div>
			<div class="panel-footer">
			Randevu Kısıtlayıcı
			</div>
          </div>
        </div>
 <div class="col-sm-4">
	   <div class="panel panel-info">
          <div class="panel-heading">
            <h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Müsteri Randevu Adeti Sınırlayın</h4>
			</div>
			<div class="panel-body">
            <p>
				<form name="biletSinirlamaDurumFormu" <?php if($row->rowCount()){ echo "action='webrandevu/crud/guncelle.php?guncelle'";}else {echo "action='webrandevu/crud/ekle.php?ekle'";} ?> method="post">		
				 Sınırlama:<label class="switch" data-toggle="tooltip" title="Müsterilerin sistemden alabilecekleri bilet sayısını sınırlandırabilirsiniz." >
					<input type="checkbox" name="biletSinirla" <?php if(isset($row_RandevuAyar['biletSinirla']) && $row_RandevuAyar['biletSinirla']){ echo "checked"; }?>
					>
					<span class="slider round"></span>
				</label><?php if(isset($row_RandevuAyar['biletSinirla']) && $row_RandevuAyar['biletSinirla']){ echo "Açık"; }else{ echo "Kapalı";} ?>
				<div style="margin-bottom:5px;"><input class="form-control alert-success" type="number" min="1" max="1000" required name="biletSinirSayisi" value="<?php if(isset($row_RandevuAyar['biletSinirSayisi'])){ echo $row_RandevuAyar['biletSinirSayisi']; } ?>" data-toggle="tooltip" title="Dilerseniz 1000 adete kadar bilet verebilirsiniz."></div>
		
				<div>
				<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
				<?php if($row->rowCount()){ ?>
					<button name="biletSinirlamaDurumBtn" class="btn btn-info form-control">Güncelle</button>
					<?php }else{ ?>
					<button name="biletSinirlamaDurumBtn" class="btn btn-success form-control">Kaydet</button>
					<?php } ?>
				</div>
				</form>
			</p>
			</div>			
         <div class="panel-footer">
		 Randevu Sınırlama
		 </div>
		</div>
        </div>
		<?php } ?>