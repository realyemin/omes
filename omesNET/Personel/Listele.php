<?php 
//PID =1 ise SÜPER ADMINDIR
$row_Personel = "SELECT PID, TID, AD, SOYAD, ADRES, TEL, GSM, EMAIL, ACIKLAMA, CALISIYOR, KAYIT_TARIHI, KULLANICI_ADI, SIFRE, OTURUM_DURUM FROM PERSONELLER WHERE PID <> 1";
$row_Personel = $db->query($row_Personel)->fetchAll();

  $totalRows_Personel = count($row_Personel);
?>
<?php
	if(isset($_GET["Personel"]) and $_GET["Personel"]=="ok")
	{
	?>
<script>
    $(document).ready(function(){
$('#my-modal').modal('show');
});
</script>
        <div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title alert alert-success">Personel Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Personel Kaydı Yapıldı</strong></p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>
<?php
	}
?>
<?php
	if(isset($_GET["Personel"]) and $_GET["Personel"]=="gnc")
	{
	?>
<script>
    $(document).ready(function(){
$('#my-modal').modal('show');
});
</script>
        <div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title alert alert-info">Personel Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Personel Bilgileri Güncelleştirildi.</strong></p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>
<?php
	}
?>
<div class="panel panel-primary">
<div class="panel panel-heading">Personel Bilgileri <a class="btn btn-success" href="?PersonelEkle">Yeni Personel Kaydı</a></div>
<div class="panel body table-responsive" style="overflow:auto;">
<?php if ($totalRows_Personel > 0) { // Show if recordset not empty ?>
<table id="tablo" class="table table-hover table-condensed">
<thead>
  <tr>
    <th>#</th>
    <th>Kullanıcı Adı</th>
    <th>Terminal AD</th>
    <th>Ad</th>
    <th>Soyad</th>
    <th>Adres</th>
    <th>Tel</th>
    <th>Gsm</th>
    <th>Email</th>
    <th>Çalışıyor</th>
    <th>Kayıt Tarihi</th>
    <th>Güncelle</th>
    <th>Sil</th>
    </tr>
	</thead>
	<tbody>
  <?php foreach($row_Personel as $row_Personel){ ?>
    <tr>
      <td><?php echo $row_Personel['PID']; ?></td>
      <td><?php echo $row_Personel['KULLANICI_ADI']; ?></td>
      <td>
	 <?php 

$row_Terminal = $db->query("SELECT TID, TERMINAL_AD FROM TERMINALLER WHERE TID ='$row_Personel[TID]'")->fetch();

	 ?> 
	  <?php echo $row_Terminal['TERMINAL_AD']; ?></td>
      <td><?php echo $row_Personel['AD']; ?></td>
      <td><?php echo $row_Personel['SOYAD']; ?></td>
      <td><?php echo $row_Personel['ADRES']; ?></td>
      <td><?php echo $row_Personel['TEL']; ?></td>
      <td><?php echo $row_Personel['GSM']; ?></td>
      <td><?php echo $row_Personel['EMAIL']; ?></td>
      <td><label class="switch"><input type="checkbox" disabled <?php if($row_Personel['CALISIYOR']==1){echo 'checked';} ?>><span class="slider round"></span></label></td>
      <td><?php echo substr($row_Personel['KAYIT_TARIHI'],0,19); ?></td>
      <td><a href="?PersonelGuncelle=<?php echo $row_Personel["PID"]; ?>" class="btn btn-info">Güncelle</a></td>
      <td><a href="?PersonelSil=<?php echo $row_Personel["PID"]; ?>" class="btn btn-danger" id="sprytrigger1"  onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
    <?php } ?>
	</tbody>
</table>
<div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Geri Alınamaz.</div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
<?php }else{ ?>
  <p>Henüz Personel Eklenmemiştir. Eklemek için Ekle Formunu Kullanın.</p>
<?php } ?>
</div></div>