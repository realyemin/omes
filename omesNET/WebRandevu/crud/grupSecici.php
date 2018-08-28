<!-- Web Randevu Panelinde Grup Bilgisi göstermek için -->
<?php
 
if(isset($_GET['GRPID'])){ $GRPID=$_GET['GRPID']; }
if(isset($_POST['GRPID'])){ $GRPID=$_POST['GRPID']; }
	@$row_GrupAdi=$db->query("SELECT GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1 AND GRPID = '$GRPID'")->fetch(); 
?>
<!-- Web Randevu Panelinde Grup Bilgisi göstermek için -->	
	<div class="col-sm-4 ">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h4 data-toggle="tooltip" title="Hangi grup için ayar yapacaksanız onu seçiniz. Not:Randevu sistemi anasayfası için geçerlidir." >GRUP/SERVİS SEÇİN</h4>            
				</div>
				<div class="panel-body table-responsive">
				<?php @$row_Gruplar=$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE Webrandevu=1")->fetchAll(); ?>
					<form action="" name="animasyonForm" method="post">
					<table class="table table-hover">
					<tr><td>Gruplar:</td></tr>
						<tr><td style="padding:5px;">
						<select name="GRPID" class="form-control">
							<?php foreach($row_Gruplar as $row_Gruplar) { ?>
							<option value="<?php echo $row_Gruplar['GRPID']; ?>" 
							<?php if(@$row_Gruplar['GRPID']==@$GRPID){echo "selected"; } ?>>
							<?php echo $row_Gruplar['GRUP_ISMI']; ?></option>										
							<?php } ?>
						</select>						
						</td></tr>
						<tr>
							<td>
							<button name="grupDurumBtn" class="btn btn-success form-control">Seç</button>
							</td>
						</tr>						
					</table>
					</form>
				</div>
				<div class="panel-footer">
				Grup Seçici
				</div>
			</div>
		</div>