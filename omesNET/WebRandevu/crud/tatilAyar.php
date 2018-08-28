<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
{			
 if(isset($_GET['tarihGuncelle'])){ $id=$_GET['tarihGuncelle']; 
$tatil = $db->query("SELECT id,tatilTarihi,tatilPeriyot,tatilAciklama,aktif FROM RANDEVU_TATIL_AYAR WHERE id=$id")->fetch();
?>

<div class="col-sm-4">
            <div class="panel panel-info">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Randevu tatil gününü değiştirin</h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="tatilTarihiForm" action="WebRandevu/crud/guncelle.php?guncelle">
			<table class="table table-hover">
				<tr>
					<td>Tarih:</td>
					<td style="padding:5px"><input value="<?php echo date("d.m.Y",strtotime($tatil['tatilTarihi'])); ?>" readonly required type="text" autocomplete="off" id="tatilTarihi" name="tatilTarihi" placeholder="Tarih Seçin" class="datepicker btn btn-default" ></td>
				</tr>
				<tr>
					<td>Periyot:</td>
					<td style="padding:5px"><select class="form-control" name="tatilPeriyot" id="tatilPeriyot">
						<option value="1" <?php if($tatil['tatilPeriyot']==1){ echo "selected";} ?>>Tüm Gün Tatil</option>
						<option value="2" <?php if($tatil['tatilPeriyot']==2){ echo "selected";} ?>>Öğleden Önce Tatil</option>
						<option value="3" <?php if($tatil['tatilPeriyot']==3){ echo "selected";} ?>>Öğleden Sonra Tatil</option>
					</select></td>
				</tr>
				<tr>
					<td data-toggle="tooltip" data-placement="right" title="Tatil sebebi veya gününü yazabilirsiniz. Örn:1 Mayıs İşçi Bayramı">Tatil Adı:</td>
					<td style="padding:5px">
					<textarea required class="form-control" maxlength="50" name="tatilAciklama" cols="30" rows="3"><?php echo $tatil['tatilAciklama']; ?></textarea></td>
				</tr>
				<tr><td>Aktif:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="Aktif olarak işaretlenen tarih takvimde kısıtlanabilir. Pasif olanlar takvime dahil edilmez." >
				<input type="checkbox" name="aktif" value="1" <?php if($tatil['aktif']==1){ echo "checked"; } ?> />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
					<input type="hidden" value="<?php echo $tatil['id']; ?>" name="id" />
					<button name="tatilDurumBtn" onclick="return tarihKontrol();" class="btn btn-primary form-control">Güncelle</button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  Tatiller
		  </div>
        </div>
		</div>
<?php }else{ ?>
<div class="col-sm-6 col-md-4">
             <div class="panel panel-warning">
				<div class="panel-heading">        
			<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Randevu tatil günlerini ekleyin</h4>
			</div>
			<div class="panel-body table-responsive">
			<form method="post" name="tatilTarihiForm" action="WebRandevu/crud/ekle.php?ekle">
			<table class="table table-hover">
				<tr>
					<td>Tarih:</td>
					<td style="padding:5px">
					<input required readonly type="text" autocomplete="off" id="tatilTarihi" name="tatilTarihi" placeholder="Tarih Seçin" class="datepicker btn btn-default" ></td>
				</tr>
				<tr>
					<td>Periyot:</td>
					<td style="padding:5px"><select class="form-control" name="tatilPeriyot" id="tatilPeriyot">
						<option value="1">Tüm Gün Tatil</option>
						<option value="2">Öğleden Önce Tatil</option>
						<option value="3">Öğleden Sonra Tatil</option>
					</select></td>
				</tr>
				<tr>
					<td data-toggle="tooltip" title="Tatil sebebi veya gününü yazabilirsiniz. Örn:1 Mayıs İşçi Bayramı">Tatil Adı:</td>
					<td style="padding:5px">
					<textarea placeholder="Lütfen, randevu ekranında görünücek şekilde bir ifade ekleyiniz." required class="form-control" maxlength="50" name="tatilAciklama" cols="30" rows="3"></textarea></td>
				</tr>
				<tr><td>Aktif:</td>
				<td colspan="2"> <label class="switch" data-toggle="tooltip" title="Aktif olarak işaretlenen tarih takvimde kısıtlanabilir. Pasif olanlar takvime dahil edilmez." >
				<input type="checkbox" name="aktif" value="1" checked />
				<span class="slider round"></span>
				</label></td>
				</tr>
				<tr>				
					<td colspan="2" style="padding:5px">
					<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
			<button name="tatilDurumBtn" onClick="return tarihKontrol();" class="btn btn-warning form-control">Ekle</button>
					</td>
				</tr>
			</table>
			</form>
          </div>
		  <div class="panel-footer">
		  Tatiller
		  </div>
        </div>
</div>
<?php } ?>

        <div class="col-sm-12">
          <div class="panel panel-info">
			<div class="panel-heading">
			<h4><strong><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Servisi için</strong><a name="git" ></a>
				randevu tatil günlerini düzenleyin <?php if(isset($_GET['tarihGuncelle'])){?><a class="btn btn-success" href="?WebRandevu&GRPID=<?php echo $GRPID; ?>&tatil">Yeni Ekle</a><?php }?>
				<a href="WebRandevu/crud/sil.php?GRPID=<?php echo $GRPID; ?>&tumTatilSil" class="btn btn-danger" style="float:right"
				onclick="return confirm('Dikkat! Tüm Tatilleri silmek istediğinizden emin misiniz?');">Tümünü Sil</a> </h4>
			</div>
			<div class="panel-body table-responsive">
		  <?php 
		  		$tatil = $db->query("SELECT id,tatilTarihi,tatilPeriyot,tatilAciklama,aktif FROM RANDEVU_TATIL_AYAR WHERE GRPID='$GRPID' ORDER BY tatilTarihi", PDO::FETCH_ASSOC);
				if ( $tatil->rowCount() ){
					?>
		    <table id="tablo" class="table table-hover">			
			<thead>
			<tr>
				<th>Durum</th><th>Tatil Adı</th><th>Periyot</th><th>Tarih</th><th>Güncelle</th><th>Sil</th>
			</tr>
			</thead>
			<tbody>
          <?php		
						foreach($tatil as $row)
						{				
					?>
			<tr>
				<td><?php if($row['aktif']){?><div class="alert alert-success"><i class="glyphicon glyphicon-ok"></i>Aktif</div><?php }else{?><div class="alert alert-danger"><i class="glyphicon glyphicon-remove"></i>Pasif</div><?php } ?></td>
				<td><?php echo $row['tatilAciklama']; ?></td>
				<td><?php if($row['tatilPeriyot']==1){ echo "Tüm Gün Tatil"; }
					else if($row['tatilPeriyot']==2){ echo "Öğleden Önce Tatil"; }
					else if($row['tatilPeriyot']==3){ echo "Öğleden Sonra Tatil"; }
					else { echo "Belirsiz periyot!"; } ?></td>
				<td><?php echo turkcetarih("d-F-Y, l", $row['tatilTarihi']); ?></td>
				<td><a href="?WebRandevu&GRPID=<?php echo $GRPID; ?>&tatil&tarihGuncelle=<?php echo $row['id']; ?>" class="btn btn-primary">Güncelle</a></td>
				<td><a href="WebRandevu/crud/sil.php?GRPID=<?php echo $GRPID; ?>&tarihSil=<?php echo $row['id']; ?>"
				onclick="return confirm('Silmek istediğinizden emin misiniz?');" class="btn btn-danger">Sil</a></td>
			</tr>					
				<?php
				} }else
				{ ?>

					<div class="alert alert-danger">Henüz bir kayıt eklemediniz. Eklemek için yukarıdaki formu kullanın.</div>
					<?php
				}
				?>
				</tbody>
			</table>
			</div>
			<div class="panel-footer">
			Tatil işlemleri
			</div>
          </div>
        </div>
<?php } ?>