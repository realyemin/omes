<?php if(isset($_POST['GRPID']) || isset($_GET['GRPID']))
	{
	?>
	<div class="col-sm-8">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<h4><strong><?php echo $row_GrupAdi['GRUP_ISMI']; ?></strong> Eposta Sunucu Ayarları</h4>
			</div>
			<div class="panel-body table-responsive">
				<form name="epostaAyarFormu" <?php if($row->rowCount()){ echo "action='webrandevu/crud/guncelle.php?guncelle'";}else {echo "action='webrandevu/crud/ekle.php?ekle'";} ?> method="post">	
					<table class="table table-hover">	
						<tr>
							<td>Eposta Sunucu(host):</td>
							<td><input required type="text" class="form-control" maxlength="50" placeholder="örn:mail.siteadiniz.com" name="host" value="<?php if(isset($row_EpostaAyar['host'])){ echo $row_EpostaAyar['host'];}?>"></td>
						</tr>
						<tr>
							<td>Port Adresi:</td>
							<td><input required type="text" class="form-control" maxlength="10"placeholder="örn:ssl için:465, tsl için:587" name="port" value="<?php if(isset($row_EpostaAyar['port'])){ echo $row_EpostaAyar['port'];}?>"></td>
						</tr>
						<tr>
							<td>Kullanıcı(username):</td>
							<td><input required type="text" class="form-control" maxlength="50" placeholder="örn:hesap@siteadiniz.com" name="username" value="<?php if(isset($row_EpostaAyar['username'])){ echo $row_EpostaAyar['username'];}?>"></td>
						</tr>
						<tr>
							<td>Parola(password):</td>
							<td><input required type="text" class="form-control" maxlength="50" name="password" value="<?php if(isset($row_EpostaAyar['password'])){ echo $row_EpostaAyar['password'];}?>"></td>
						</tr>
						<tr>
							<td>Gönderici Kimliği(from):</td>
							<td><input required type="text" class="form-control" maxlength="50" placeholder="örn:Kurum veya Servis adı" name="fromMesaj" value="<?php if(isset($row_EpostaAyar['fromMesaj'])){ echo $row_EpostaAyar['fromMesaj'];}?>"></td>
						</tr>
					</tr>
					<tr>
						<td>Mesaj Başlığı(subject):</td>
						<td><input required type="text" class="form-control" maxlength="50" placeholder="örn:Eposta Başlığı" name="subject" value="<?php if(isset($row_EpostaAyar['subject'])){ echo $row_EpostaAyar['subject'];}?>"></td>
					</tr>				
					<tr><td>Aktif</td>
						<td>
							<label class="switch" data-toggle="tooltip" title="Eposta hizmetini açıp kapatabilirsiniz." >
								<input type="checkbox" name="Aktif" value="1" <?php if(isset($row_EpostaAyar['Aktif']) && $row_EpostaAyar['Aktif']==1){ echo "checked"; }?>>
								<span class="slider round"></span>
							</label> Aktif yapılırsa müsteriden eposta bilgisi de istenir.				
						</td>
					</tr>
					<tr><td colspan="2">
						<input type="hidden" name="GRPID" value="<?php echo $GRPID; ?>" />
						<?php if($row->rowCount()){ ?>
							<button name="epostaAyarBtn" class="btn btn-warning form-control">Güncelle</button>
							<?php }else{ ?>
							<button name="epostaAyarBtn" class="btn btn-success form-control">Kaydet</button>	
						<?php } ?>
					</td>
					</tr>
				</form>
			</table>
		</div>
		<div class="panel-footer">
			Eposta Sunucu Ayarları
		</div>
	</div>
</div>

<?php } ?>