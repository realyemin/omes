<?php 
$query_AnaButon = "SELECT * FROM BUTONLAR WHERE ANA_BTNID <>0 ORDER BY BM_ADRES, BTNID ASC";
$query_AnaButon = $db->prepare($query_AnaButon);
$query_AnaButon->execute();

  $all_biletMakinesi = $row_AnaButon = $query_AnaButon->fetchAll();
  $totalRows_AnaButon = count($all_biletMakinesi);
?>

<?php if ($totalRows_AnaButon > 0) { // Show if recordset not empty ?>
  <a name="ust"></a>
<div class="form-group">
  <div class="panel panel-pink">
      <div class="panel panel-heading">Alt Buton Listesi</div>
      <div class="panel body table-responsive">
        <table id="tablo" class="table table-hover table-condensed ">
          <thead>
            <tr class="alert alert-info">
              <th>Bilet Makinesi</th>
              <th>ANA BUTON ID</th>
              <th>ALT BUTON ID</th>
              <th>1.Grup</th>
              <th>1.Oran</th>
              <th>2.Grup</th>
              <th>2.Oran</th>
              <th>3.Grup</th>
              <th>3.Oran</th>
              <th>4.Grup</th>
              <th>4.Oran</th>
              <th>&nbsp;</th>
              <th>AKTIF</th>
              <th>Randevu Butonu Mu?</th>
              <th>Detay</th>
              <th>Güncelle</th>
              <th>Sil</th>
          </tr></thead><tbody>
          <?php foreach($row_AnaButon as $row_AnaButon) { ?>
            <tr>
              <td><?php 
	
$row_BiletMakinesi =$db->query("SELECT MAKINE_ADRESI, MAKINE_ADI FROM BILET_MAKINELERI WHERE MAKINE_ADRESI = '$row_AnaButon[BM_ADRES]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon["BM_ADRES"]."</span></br>".$row_BiletMakinesi['MAKINE_ADI']; ?>
                
              </td>
              <td><?php if($row_AnaButon['ANA_BTNID']==0){echo "Evet";}else{ echo "<span class='label label-success'>".$row_AnaButon['ANA_BTNID']."</span>";} 
	   ?></td>
              <td><span class="label label-dark"><?php echo $row_AnaButon['BTNID']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-info"> <?php echo $row_AnaButon['GRP1_ORAN']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID2]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID2']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-success"><?php echo $row_AnaButon['GRP2_ORAN']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID3]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID3']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-warning"><?php echo $row_AnaButon['GRP3_ORAN']; ?></span></td>
              <td><?php 
$row_Grup =$db->query("SELECT GRPID, GRUP_ISMI FROM GRUPLAR WHERE GRPID= '$row_AnaButon[GRP_ID4]'")->fetch();
	  
	  echo "<span class='label label-default'>#".$row_AnaButon['GRP_ID4']."</span></br>".$row_Grup["GRUP_ISMI"]; ?></td>
              <td><span class="badge badge-danger"><?php echo $row_AnaButon['GRP4_ORAN']; ?></span></td>
              <td>&nbsp;</td>
              <td><?php if($row_AnaButon['AKTIF']==1){echo "Evet";} else{ echo "Hayır";} ?></td>
              <td><?php if($row_AnaButon['RandevuButonuMu']==0){echo "Hayır";} else{ echo "Evet";} ?></td>
              <td><a href="?AltButonDetay&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-success">Detay</a></td>
              <td><a href="?AltButonGuncelle&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-info">Güncelle</a></td>
              <td><a href="?AltButonSil&BTNID=<?php echo $row_AnaButon["BTNID"];?>&BM_ADRES=<?php echo $row_AnaButon["BM_ADRES"]; ?>" class="btn btn-danger" id="sprytriggerSil" onClick="return confirm('Silmek İstediğinizden Emin misiniz?');">Sil</a></td>
            </tr>
            <?php } ?>
			</tbody>
        </table>
        <div class="tooltipContent" id="sprytooltipSil">Dikkat! Silme işlemi geri alınamaz.</div>
  </div></div></div>

<script type="text/javascript">
var sprytooltipSil = new Spry.Widget.Tooltip("sprytooltipSil", "#sprytriggerSil");
    </script>
 <?php } else{ ?>
  <div class="btn btn-danger form-control">Henüz Bir Alt Buton Eklenmemiştir.</div>
  <?php } // Show if recordset empty ?>