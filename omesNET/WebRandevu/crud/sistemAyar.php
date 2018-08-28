  <div class="col-sm-8">
          <div class="panel panel-warning">
			<div class="panel-heading">
				<h4>WebRandevu Gruplarını/Servislerini Hizmete Açma-Kapama <?php if(isset($_GET['tarihGuncelle'])){?><a class="btn btn-success" href="?tatil">Yeni Ekle</a><?php }?></h4>
			</div>
			<div class="panel-body table-responsive">
		  <?php 
		  		$gruplar = $db->query("SELECT * FROM GRUPLAR WHERE Webrandevu=1 ORDER BY GRPID", PDO::FETCH_ASSOC);
				if ( $gruplar->rowCount() ){
					?>
		    <table class="table table-hover">			
			<thead>
			<tr>
				<th>Durum</th><th>Grup Adı</th><th>Sistem Aç/Kapat</th><th>İşlem</th>
			</tr>
			</thead>
          <?php		
						foreach($gruplar as $row)
						{				
					?>
			<tr>
				<td><?php if($row['AKTIF']){?><div class="alert alert-success"><i class="glyphicon glyphicon-ok"></i>Aktif</div><?php }else{?><div class="alert alert-danger"><i class="glyphicon glyphicon-remove"></i>Pasif</div><?php } ?></td>
				<td><?php echo $row['GRUP_ISMI']; ?></td>
			<td><form action="WebRandevu/crud/guncelle.php?guncelle" name="sistemDurumFormu" method="post">		
				 <label class="switch" data-toggle="tooltip" title="WEB Randevu sistemini kapatıp açabilirsiniz!" >
					<input type="checkbox" name="AKTIF" value="1" <?php if($row['AKTIF']){ echo "checked"; }?>>
					<span class="slider round"></span>
				</label>
				<?php if($row['AKTIF']){ echo "Açık"; }else{ echo "Kapalı";} ?>
				</td>
				<td>
				<input type="hidden" name="GRPID" value="<?php echo $row['GRPID']; ?>" />
					<button name="sistemDurumBtn" class="btn btn-<?php if($row['AKTIF']){ echo "success"; }else{ echo "danger";} ?> form-control">
					<span class="glyphicon glyphicon-floppy-disk"></span> Kaydet</button>
				</form>
			</td>					
			</tr>					
				<?php
				} }else
				{ ?>
					<div class="alert alert-danger">Henüz eklenmiş bir web randevu grubu yoktur. Lütfen Gruplar menusunden bir Grup ekleyerek Web Randevu olacak şekilde ayarlamalarını yapınız.</div>
					<?php
				}
				?>
			</table>
			</div>
			<div class="panel-footer">
			Sistem Grup işlemleri
			</div>
          </div>
        </div>