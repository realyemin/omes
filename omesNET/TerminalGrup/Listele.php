<?php
$colname_TerminalGrup = "-1";
if (isset($_GET['TerminalGrupListele'])) {
  $colname_TerminalGrup = $_GET['TerminalGrupListele'];
}
$row_TerminalGrup = $db->query("SELECT * FROM TERMINAL_GRUP WHERE TID ='$colname_TerminalGrup'")->fetchAll();

  $totalRows_TerminalGrup = count($row_TerminalGrup);
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
          <h4 class="modal-title alert alert-info">Terminal Grup Ayarları</h4>
        </div>
        <div class="modal-body">
          <p><strong>Terminal Grupları Güncelleştirildi</strong></p>
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
<?php if ($totalRows_TerminalGrup > 0) { // Show if recordset not empty ?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">Terminal/GRUP Listesi<a class="btn btn-success" style="float:right" href="?TerminalGrupEkle" >Yeni Terminal Grup Ekle</a></div><div class="panel body table-responsive">
  <table id="tablo" class="table table-hover">
  <thead>
    <tr class="alert alert-info">
      <th>TGID</th>
      <th>Terminal</th>
      <th>Grup İsmi</th>
      <th>ÇAĞRI ORANI</th>
      <th>TRANSFER ORANI</th>
      <th>CAGRILAN</th>
      <th>TRANSFER CAGRILAN</th>
      <th>YARDIM GRUBU</th>
      <th>AYRICALIKLI</th>
      <th>ÖNCELİK</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_TerminalGrup as $row_TerminalGrup) { ?>
      <tr>
        <td><?php echo $row_TerminalGrup['TGID']; ?></td>
        <td><strong>
          <em>
          <?php 
$query_terminal = "SELECT TERMINAL_AD FROM TERMINALLER WHERE TID = '$row_TerminalGrup[TID]'";
$terminal = $db->query($query_terminal)->fetch();
$row_terminal = $terminal;
$totalRows_terminal = count($terminal);
 echo $row_terminal['TERMINAL_AD']; 
?>
        </em></strong></td>
        <td><strong>
          <em>
          <?php
$query_grup = "SELECT GRUP_ISMI FROM GRUPLAR WHERE GRPID = '$row_TerminalGrup[GRPID]'";
$grup = $db->query($query_grup)->fetch();
$row_grup = $grup;
$totalRows_grup = count($grup); echo $row_grup['GRUP_ISMI'];
 ?>
        </em></strong></td>
        <td><?php echo $row_TerminalGrup['CAGRI_ORAN']; ?></td>
        <td><?php echo $row_TerminalGrup['TRANSFER_ORAN']; ?></td>
        <td><?php echo $row_TerminalGrup['CAGRILAN']; ?></td>
        <td><?php echo $row_TerminalGrup['TRANSFER_CAGRILAN']; ?></td>
        <td><?php if($row_TerminalGrup['YARDIM_GRUBU']==1){echo "EVET";}else {echo "HAYIR";} ?></td>
        <td><?php if($row_TerminalGrup['AYRICALIKLI']==1){ echo "Evet";}else { echo "Hayır"; } ?></td>
        <td><?php echo $row_TerminalGrup['ONCELIK']; ?></td>
        <td><a class="btn btn-info" href="?TerminalGrupGuncelle=<?php echo $row_TerminalGrup['TGID']; ?>">Güncelle</a></td>
        <td><a href="?TerminalGrupSil=<?php echo $row_TerminalGrup['TGID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek istediğinizden emin misiniz?');">Sil</a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>
</div></div></div>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
    </script>
<?php }else{ // Show if recordset not empty ?>

    <p class="alert alert-danger"><span class="btn btn-success">#<?php echo $_GET['TerminalGrupListele']."-".$_GET['TERMINAL_AD']; ?> </span>nolu Terminalin Henüz Grupları oluşturulmamıştır. Oluşturmak İçin <a href="?TerminalGrupEkle" class="btn btn-success" >Tıklayınız.</a></p>
    <?php } // Show if recordset empty ?>