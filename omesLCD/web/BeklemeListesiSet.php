<?php	
include("db.php");
include("ayar/config/config1.php");

				$Columns="DISTINCT GRUPLAR.GRUP_ISMI, KUYRUK.BID, KUYRUK.GRPID, KUYRUK.BILET_NO, B.MusteriAdi"; 
				$TableName="KUYRUK INNER JOIN GRUPLAR ON KUYRUK.GRPID = GRUPLAR.GRPID 
				JOIN BILETLER B ON KUYRUK.BID = B.BID 
				JOIN TERMINAL_GRUP TG ON GRUPLAR.GRPID = TG.GRPID 
                JOIN ANATABLO_YON AT ON TG.TID = AT.TID AND AT.ATID = ".$AnatabloID;          
                $Where="limit $SatirSayisi";
				$OrderBy="";          
            
			 $strCommand = "SELECT " . $Columns . " FROM " . $TableName . " " . $Where . " " . $OrderBy;			
			 $bekleyenler = $db->query($strCommand, PDO::FETCH_ASSOC);
			 $sayac=1;
				if ($bekleyenler->rowCount())
				{		echo "<table id='bekleyenler' class='table table-bordered table-responsive table-condensed table-striped'>";	
						echo "<thead><tr class='text-danger'><th style='text-align: center;'><span class='glyphicon glyphicon-time'></span> $bekleyenler_metni</th></tr></thead>";
						echo "<tbody><tr class='text-warning'><th style='text-align: center;'><span class='glyphicon glyphicon-th-list'></span> $biletno_metni</th></tr>";
						
				    foreach($bekleyenler as $row){
			?>
					<tr  <?php if($sayac%2==0){echo "class='danger'"; }else{ echo "class='warning'";  } ?>>				
						<th id="bilet<?php echo $sayac; ?>" class='text-info text-center'><?php echo $row['BILET_NO']; ?></th>					
					</tr>  
					 
			<?php
					$sayac++;}echo "</tbody></table>";
				}          
            $panelTv_Visible = false;
            $panelWeb_Visible = false;
   
?>