<?php 
	/*
		-- =============================================
		-- Author:		EKOMURCU
		-- Create date: 06.06.2018
		-- Description:	Bu modül önceki ranvuları kullanıcının düzenlemesi(iptal) için yazıldı 
		-- Location: randevu.php içinde ajax(randevuSistemi.js ->randevuIptal()-> fonksiyonlar/php/randevuIptal.php) 
		--	ile çalışıyor
		-- ============================================= 
	*/?>
	<?php
		include("Connections/baglantim.php"); 
		include("fonksiyonlar/php/turkceTarih.php"); //ip adresini al
		if(isset($_POST['tc']))
		{	
			$tc=$_POST['tc'];
			if(isset($_POST['eposta'])){ $eposta=$_POST['eposta'];	} else{	 $eposta=false; }
			$randevularim=$db->query("SELECT * FROM RANDEVU_KAYDET WHERE musteriTC= '$tc' ORDER BY id DESC",PDO::FETCH_ASSOC);
			if ($randevularim->rowCount() ){
			?>
			
			<table class="table table-hover" >
				<thead>
					<tr>
						<th>İptal Et</th><th>Hizmet Birimi</th><th>Randevu Tarihi</th><th>Randevu Saati</th><th>Bilet No</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						foreach( $randevularim as $row ) {?>
						<tr>
							<td><?php if($row['IPTAL']){ ?><strong style="color:red">İptal Edildi</strong><?php }else{ ?>		
								<button onClick="randevuIptal('<?php echo $row['id']; ?>','<?php echo $tc; ?>','<?php echo $row['GRPID']; ?>','<?php echo $eposta; ?>','<?php echo $row['randevuTarihi']; ?>','<?php echo $row['randevuSaati']; ?>');" class="btn btn-danger">
								İptal Et</button></td>
							<?php } ?>
							<td>
								<?php  
									$GRPID=$row['GRPID'];
									$randevularim=$db->query("SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$GRPID'")->fetch();
									echo $randevularim['GRUP_ISMI'];
								?>
							</td>
							<td><?php echo turkcetarih("d-F-Y, l", $row['randevuTarihi']); ?></td>
							<td><?php echo substr($row['randevuSaati'],0,5); ?></td>
							<td><?php echo $row['biletNo']; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<?php }else{ echo "<div class='alert alert-danger'>Randevu kaydınız bulunmuyor.</h4>";} 
		}else{ echo "Hatalı işlem.";} ?>		