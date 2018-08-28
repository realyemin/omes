<div class="modalRandevu">
<div id="randevuSIL<?php echo $row['id']; ?>" class="modal fade" role="dialog">
  <!-- Modal content -->
  <div class="modal-content" style="background:white; max-width:600px;cursor:auto">
    <div class="modal-header ">
     <span class="close" data-dismiss="modal">&times;</span>
      <h1>Randevu Sil</h1>
      <hr>
    </div>
    <div class="modal-body">
	<form method="post" action="WebRandevu/crud/sil.php" name="randevuSilForm">
      <label for="musteriAd"><b>Müsteri Adı:</b></label>
      <input type="text" value="<?php  echo $row['musteriAd']; ?>" disabled>
	
      <label for="musteriSoyad"><b>Müsteri Soyadı</b></label>
      <input type="text" value="<?php  echo $row['musteriSoyad']; ?>" disabled>
     
	  <label for="musteriTc"><b>TC</b></label>
      <input type="number" name="musteriTc" value="<?php  echo $row['musteriTc']; ?>" disabled>	
      <div class="clearfix">
	  <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
	  <input type="hidden" name="musteriTc" value="<?php  echo $row['musteriTc']; ?>">	
	  <input type="hidden" name="GRPID" value="<?php echo $row['GRPID']; ?>" />        
	  <input type="hidden" name="randevuTarihi" value="<?php echo $row['randevuTarihi']; ?>" />        
	  <input type="hidden" name="randevuSaati" value="<?php echo $row['randevuSaati']; ?>" />        
        <button type="submit" onclick="return confirm('Silmek istediğinizden emin misiniz?');" name="randevuSilTekBtn" class="btn btn-warning">Geçerli Randevu Sil</button>       		
	</form>
	<form style="display:inline-block" method="post" action="WebRandevu/crud/sil.php" name="randevuSilForm">
	<input type="hidden" name="musteriTc" value="<?php  echo $row['musteriTc']; ?>">	
	 <button type="submit" onclick="return confirm('Silmek istediğinizden emin misiniz?');" name="randevuSilTumuBtn" class="btn btn-danger">Kişinin Tüm Randevularını Sil</button>
	 <button type="button" data-dismiss="modal" class="btn btn-success">VAZGEC</button> 
	</form>
	</div>
	</div>
    <div class="modal-footer">
      <h3>Web Randevu</h3>
    </div>
  </div>
</div>
</div>