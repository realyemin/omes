<?php
$query_terminal = "SELECT * FROM TERMINALLER ORDER BY TID DESC";
$row_terminalListe = $db->query($query_terminal, PDO::FETCH_ASSOC);
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
          <h4 class="modal-title alert alert-danger">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Terminal ve İlişkili Ayarların tümü silindi</strong></p>
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
	if(isset($_GET["Ekle"]) and $_GET["Ekle"]=="ok")
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
          <h4 class="modal-title alert alert-success">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Terminal Eklendi</strong></p>
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
          <h4 class="modal-title alert alert-info">Terminal Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Terminal Güncelleştirildi</strong></p>
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
	if(isset($_GET["TGrup"]) and $_GET["TGrup"]=="ok")
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
          <h4 class="modal-title alert alert-success">Terminal Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Yeni Terminal/Grup Eklendi</strong></p>
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
  <div class="panel panel-heading">Terminal Listesi <a class="btn btn-success" style="float:right" href="?TerminalEkle">Yeni Terminal Ekle</a></div>
  <div class="panel body table-responsive">
<?php if ($row_terminalListe -> rowCount()) { // Show if recordset not empty  ?>
  <table id="tablo" class="table table-hover">
  <thead>
    <tr>
      <th>#TID</th>
      <th>El Terminal ID</th>
      <th>TERMINAL ADI</th>
      <th>OTO. CAGRI</th>
      <th>OTO. SURE</th>
      <th>AKTIF</th>
      <th>Sıralama Tipi</th>
      <th>Çağrılma Tipi</th>
      <th>Terminal Tipi</th>
      <th>Grup Güncelle</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
	</thead>
	<tbody>
  <?php foreach($row_terminalListe as $row_terminalListe){ ?>
      <tr>
        <td><?php echo $row_terminalListe['TID']; ?></td>
        <td><?php echo $row_terminalListe['ELTID']; ?></td>
        <td><?php echo $row_terminalListe['TERMINAL_AD']; ?></td>
        <td><?php if($row_terminalListe['OTO_CAGRI']==0) { echo "Hayır";}else { echo "Evet"; } ?></td>
        <td><?php echo substr($row_terminalListe['OTO_SURE'],0,8); ?></td>
        <td><?php if($row_terminalListe['AKTIF']==0){ echo "Hayır";}else { echo "Evet";} ?></td>
        <td><?php if($row_terminalListe['SiralamaTipi']==0){echo "Bilet Sıralama Türü Seçiniz";} else if($row_terminalListe['SiralamaTipi']==1){ echo "Alınma Sırası";}else if($row_terminalListe['SiralamaTipi']==2){ echo "Bilet No";} ?></td>
        <td><?php if($row_terminalListe['CagriSiralamaTipi']==0){echo "Bilet Sıralama Türü Seçiniz";} else if($row_terminalListe['CagriSiralamaTipi']==1){ echo "Oran";}else if($row_terminalListe['CagriSiralamaTipi']==2){ echo "Kuyruk";} ?></td>
                <td><?php echo $row_terminalListe['TerminalTipi']; ?></td>
                <td><a href="?TerminalGrupListele=<?php echo $row_terminalListe["TID"]."&TERMINAL_AD=".$row_terminalListe['TERMINAL_AD']; ?>" class="btn btn-warning">Terminal/Grup Görüntüle</a></td>
        <td><a href="?TerminalGuncelle=<?php echo $row_terminalListe["TID"]; ?>" class="btn btn-info">Terminal Güncelle</a></td>
        <td><a href="?TerminalSil=<?php echo $row_terminalListe["TID"]; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
      <?php } ?>
	  </body>
  </table>

  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
<?php }else{ // Show if recordset not empty ?>
<p>
    Henüz bir Terminal Kaydı Oluşturulmamıştır. <a href="?TerminalEkle"  class="btn btn-success">Eklemek için tıklayın</a>
  <?php } // Show if recordset empty ?>
</p></div></div></div>