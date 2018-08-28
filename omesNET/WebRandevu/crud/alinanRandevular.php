<div class="col-md-12">
<div class="panel panel-info">
<div class="panel-heading"><h4>Sistemden Alınan Randevular</h4></div>
		<div class="panel-body table-responsive">
		<form action="?WebRandevu&ana&#git" name="randevuAraForm" method="post">
		<div class="col-md-4">
			<?php $row_Gruplar=$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1")->fetchAll(); ?>
					
					<div>Arama Yapılacak Birim</div>
					<div>
							<select name="GRPID" class="form-control">
							<?php foreach($row_Gruplar as $row_Gruplar) { ?>
							<option value="<?php echo $row_Gruplar['GRPID']; ?>" <?php if(isset($_POST['GRPID']) && ($row_Gruplar['GRPID']==$_POST['GRPID'])){echo "selected"; } ?>><?php echo $row_Gruplar['GRUP_ISMI']; ?></option>										
							<?php } ?>
							</select>
					</div>
						<div>Randevu Başlangıç Tarihi:</div>
						<div>
					<input readonly required type="text" autocomplete="off" id="randevuBasTarihi" name="randevuBasTarihi" placeholder="Baş.Tarih Seçin" class="datepicker btn btn-default" >
					</div>
						<div>Randevu Bitiş Tarihi:</div>
						<div>
					<input readonly required type="text" autocomplete="off" id="randevuBitTarihi" name="randevuBitTarihi" placeholder="Bit.Tarih Seçin" class="datepicker btn btn-default" >
					</div>
					<div>&nbsp;</div>
					<div>
					<button name="kriterAraBtn"  onclick="return checkDate();" class="btn btn-warning form-control">Tarihe göre ara</button></td>
					</div>
				
				</div>
				<div class="col-md-8">				
					<div>Kelime ile arama:</div>				
						<input type="text" name="kelime" class="form-control" placeholder="Ad,Soyad,Tc,Tel ara..">
						<div>&nbsp;</div>						
						<button name="cumleAraBtn" class="btn btn-success form-control">Cümle içinde ara</button>
												
				</div>
			</form>
	</div>
</div>	
</div> 
<div class="col-md-12"><?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))	{ ?>
         <div class="panel panel-info">
			<div class="panel-heading"><strong>
			<?php $row_Gruplar=$db->query("SELECT GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1 AND GRPID='$GRPID'")->fetch(); ?>
			<?php if(isset($row_Gruplar['GRUP_ISMI'])){ echo $row_Gruplar['GRUP_ISMI']; } ?> </strong> Servisi için listelenen kayıtlar
			<a href="WebRandevu/crud/sil.php?GRPID=<?php echo $GRPID; ?>&tumRandevuSil" class="btn btn-danger" style="float:right"
				onclick="return confirm('Dikkat! Tüm Randevuları silmek istediğinizden emin misiniz?');" 
				data-toggle="tooltip" title="Dikkat <?php echo $row_Gruplar['GRUP_ISMI']; ?> Servisine ait tüm randevular silinir!">Tümünü Sil</a><a name="git" ></a>
			</div>
			
			<div class="panel-body table table-responsive">
		  <?php 
		  if(isset($_POST['kriterAraBtn']) ){ 
		  $randevuBasTarihi =date("Y-m-d", strtotime($_POST['randevuBasTarihi']));
		  $randevuBitTarihi =date("Y-m-d", strtotime($_POST['randevuBitTarihi']));
		  
		  $randevu = $db->query("SELECT id ,TID	,GRPID,musteriAd ,musteriSoyad ,musteriTc ,musteriTel 
	,randevuTarihi, randevuSaati, biletNo, randevuKayitTarihi ,randevuTalepSayisi
	FROM RANDEVU_KAYDET WHERE (GRPID='$GRPID' AND randevuKayitTarihi BETWEEN '$randevuBasTarihi' AND '$randevuBitTarihi' ) ORDER BY id DESC", PDO::FETCH_ASSOC);
		  }
		   if(isset($_POST['cumleAraBtn']) ){ 
		   $kelime=$_POST['kelime'];
		   
		 
	$randevu = $db->query("SELECT id ,TID ,GRPID ,musteriAd ,musteriSoyad ,musteriTc ,musteriTel 
	,randevuTarihi, randevuSaati, biletNo, randevuKayitTarihi ,randevuTalepSayisi, IPTAL
	FROM RANDEVU_KAYDET WHERE (GRPID='$GRPID') AND (musteriAd LIKE '%$kelime%' OR musteriSoyad LIKE '%$kelime%' OR musteriTc LIKE '%$kelime%' OR musteriTel LIKE '%$kelime%' ) ORDER BY id DESC ", PDO::FETCH_ASSOC);
	}
				if(isset($randevu) && $randevu->rowCount()){	?>
		    <table id="tablo" class="table table-hover">			
			<thead>
			<tr>	
				<th>Güncelle</th>
				<th>Sil</th>
				<th>Musteri Ad</th>
				<th>Soyad</th>
				<th>Tc</th>
				<th>Tel</th>
				<th>Randevu Tarihi</th>
				<th>Saati</th>
				<th>BiletNo</th>
				<th>Randevu Kayit Tarihi</th>
				<th>Randevu Talep Sayisi</th>			
				<th>Durum</th>			
			</tr>
			</thead><tbody>			
          <?php	foreach($randevu as $row)	{ if(isset($_GET['id']) && $_GET['id']==$row['id']){ $secili=true;}else{ $secili=false;}?>
			<tr>
				<td>
				<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#randevuGNC<?php echo $row['id']; ?>" >Güncelle</a>				
				</td>
				<td>
				<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#randevuSIL<?php echo $row['id']; ?>" >Sil</a>
				</td>
				<td><?php echo $row['musteriAd']; ?></td>
				<td><?php echo $row['musteriSoyad'];?></td>		
				<td><?php echo $row['musteriTc']; ?></td>				
				<td><?php echo $row['musteriTel']; ?></td>				
				<td><?php echo turkcetarih("d-F-Y, l", $row['randevuTarihi']);?></td>							
				<td><?php echo substr($row['randevuSaati'],0,5);?></td>								
				<td><?php echo $row['biletNo']; ?></td>								
				<td><?php echo turkcetarih("d-F-Y, l", $row['randevuKayitTarihi']); ?></td>
				<td><?php echo $row['randevuTalepSayisi']; ?></td>								
				<td><?php if($row['IPTAL']){?><span style="color:red;">Iptal Edilmiş</span><?php }else{ ?><span style="color:green">Aktif</span><?php } ?></td>								
					<?php include("WebRandevu/modals/randevuGuncelle.php"); ?>			
					<?php include("WebRandevu/modals/randevuSil.php"); ?>			
			</tr>			
			<?php } ?>
			</tbody>
			</table>
			</div>
			<?php    }else { ?>
			<div class="alert alert-danger">Aramanıza uygun kayıt bulunamadı.</div>			
			 <?php	} }?>
	</div>
</div>


