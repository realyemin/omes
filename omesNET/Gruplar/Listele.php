<?php
$query_GrupListele = "SELECT * FROM GRUPLAR ORDER BY GRPID DESC";
$row_GrupListele = $db->query($query_GrupListele, PDO::FETCH_ASSOC);
?>
<?php
	if(isset($_GET["Sil"]) and $_GET["Sil"]=="ok")
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
          <h4 class="modal-title alert alert-danger">Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Gruplar ve İlişkili Ayarların tümü silindi</strong></p>
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
	if(isset($_GET["GrupEkle"]) and $_GET["GrupEkle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Grup Eklendi</strong></p>
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
	if(isset($_GET["gnc"]) and $_GET["gnc"]=="ok")
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
          <h4 class="modal-title alert alert-info">Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Gruplar Güncelleştirildi</strong></p>
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
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">GRUP Listesi <a class="btn btn-success" style="float:right" href="?GrupEkle&">Yeni Grup Ekle</a></div>
  <div class="panel body table-responsive">
  <?php if ($row_GrupListele -> rowCount()) { // Show if recordset not empty 
	  ?>
  <table id="tablo" class="table table-hover">
  <thead>
    <tr class="label-info">
      <th>GRUP ISMI</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_GrupListele as $row_GrupListele){ ?>
      <tr>
        <td class="alert alert-success"><strong><?php echo $row_GrupListele['GRUP_ISMI']; ?></strong>
		<?php if($row_GrupListele['Webrandevu']){ echo "(Web Randevu)";}else{ echo "(Normal)"; } ?>
		</td>
        <td><a class="btn btn-primary" href="?GrupGuncelle=<?php echo $row_GrupListele['GRPID']; ?>">Güncelle</a></td>
        <td><a onClick="return confirm('Silmek istediğinizden emin misiniz?');" href="?GrupSil=<?php echo $row_GrupListele['GRPID']; ?>" class="btn btn-danger" id="sprytrigger1">Sil</a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>

  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme İşlemi Bir Daha Geri Alınamaz!</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  <?php }else{ ?>
	<p> 
    Listelenecek Grup Bulunamadı. <a href="?GrupEkle" class="btn btn-success"> Yeni Grup Eklemek İçin Tıklayınız</a>  
	</p>
	  <?php } // Show if recordset not empty ?>
  </div></div></div>
  