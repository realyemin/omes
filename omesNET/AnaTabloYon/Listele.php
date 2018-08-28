<?php 
$query_AnaTabloYon = "SELECT ANATABLO_YON.YID, 
	ANATABLOLAR.TABLO_ADI, 
	TERMINALLER.TERMINAL_AD,
	ANATABLO_YON.YON, 
	ANATABLO_YON.Port FROM ANATABLOLAR 
	INNER JOIN ANATABLO_YON on ANATABLOLAR.ATID=ANATABLO_YON.ATID 
	INNER JOIN TERMINALLER on TERMINALLER.TID=ANATABLO_YON.TID";
$row_AnaTabloYon = $db->query($query_AnaTabloYon, PDO::FETCH_ASSOC);
  
?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Yön Listesi<a class="btn btn-success" style="float:right" href="?AnaTabloYonEkle" >Yeni AnaTablo Yön Ekle</a></div>
  <div class="panel body table-responsive">
<?php if ($row_AnaTabloYon -> rowCount()) {// Show if recordset not empty ?>
  <table id="tablo" class="table table-hover">
  <thead>
    <tr>
      <th>YID</th>
      <th>TABLO ADI</th>
      <th>TERMINAL AD</th>
      <th>YON</th>
      <th>Port</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_AnaTabloYon as $row_AnaTabloYon) { ?>
      <tr>
        <td><?php echo $row_AnaTabloYon['YID']; ?></td>
        <td><?php echo $row_AnaTabloYon['TABLO_ADI']; ?></td>
        <td><?php echo $row_AnaTabloYon['TERMINAL_AD']; ?></td>
        <td><?php if($row_AnaTabloYon['YON']==1){ echo "Yukarı";} else if($row_AnaTabloYon['YON']==2){ echo "     Aşağı";} else if($row_AnaTabloYon['YON']==3){ echo "     Sağ";}else if($row_AnaTabloYon['YON']==4){ echo "Sol";}else if($row_AnaTabloYon['YON']==5){ echo "Kapalı";}else { echo "Yön geçersiz"; }                       ?></td>
        <td><?php echo $row_AnaTabloYon['Port']; ?></td>
        <td><a class="btn btn-info" href="?AnaTabloYonGuncelle=<?php echo $row_AnaTabloYon['YID']; ?>">Güncelle</a></td>
        <td><a href="?AnaTabloYonSil=<?php echo $row_AnaTabloYon['YID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek İstediğinizden Emin misini?');">Sil</a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>
  <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  
<?php }else { ?>
<p>
   Henüz AnaTablo için Yön ayarları eklenmemiştir. Eklemek için <a class="btn btn-success" href="?AnaTabloYonEkle">Tıklayınız.</a>
</p>  <?php } // Show if recordset empty ?>
</div></div></div>
