<?php

$query_AnaTablo = "SELECT ATID, TABLO_ADI, TABLO_TURU FROM ANATABLOLAR ORDER BY ATID ASC";
$query_AnaTablo = $db->prepare($query_AnaTablo);
$query_AnaTablo->execute();


  $all_AnaTablo = $row_AnaTablo = $query_AnaTablo->fetchAll();
  $totalRows_AnaTablo = count($all_AnaTablo); 
?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Listesi<a class="btn btn-success" style="float:right" href="?AnaTabloEkle" >Yeni Ana Tablo Ekle</a></div>
  <div class="panel body table-responsive">
<?php if ($totalRows_AnaTablo > 0) { // Show if recordset not empty ?>

<table id="tablo" class="table table-hover">
    <thead>
	<tr>
      <th>AnaTablo ID</th>
      <th>TABLO ADI</th>
      <th>TABLO TURU</th>
      <th>Güncelle</th>
      <th>Sil</th>
    </tr>
	</thead>
	<tbody>
    <?php foreach($row_AnaTablo as $row_AnaTablo) { ?>
      <tr>
        <td><?php echo $row_AnaTablo['ATID']; ?></td>
        <td><?php echo $row_AnaTablo['TABLO_ADI']; ?></td>
        <td><?php if($row_AnaTablo['TABLO_TURU']==1){ echo "LCD tablo";} else if($row_AnaTablo['TABLO_TURU']==2){ echo "LED tablo";} else{ echo "Tablo Türü Bilinmiyor";}?></td>
        <td><a class="btn btn-info" href="?AnaTabloGuncelle=<?php echo $row_AnaTablo['ATID']; ?>">Güncelle</a></td>
        <td><a href="?AnaTabloSil=<?php echo $row_AnaTablo['ATID']; ?>" class="btn btn-danger" id="sprytrigger1" onClick="return confirm('Silmek İstediğinizden Emin misiniz?');">Sil</a></td>
      </tr>
      <?php } ?>
	  </tbody>
  </table>
 <div class="tooltipContent" id="sprytooltip1">Dikkat! Silme işlemi geri alınamaz.</div>
  <script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
  <?php } // Show if recordset not empty ?>
  
<p>
  <?php if ($totalRows_AnaTablo == 0) { // Show if recordset empty ?>
    Henüz Anatablo bilgileri eklenmemiştir. Eklemek İçin <a class="btn btn-success" href="?AnaTabloEkle">Tıklayınız</a>
    
  <?php } // Show if recordset empty ?>
</p>
</div></div></div>