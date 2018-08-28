<?php
		$RandevuTarihi =date("Y-m-d", strtotime($_POST['tarih'])) ; //randevu tarihi
		$tarih=$RandevuTarihi." 00:00:00";

$biletler = $db->query("SELECT BILET_NO FROM BILETLER WHERE Zaman='$tarih'", PDO::FETCH_ASSOC);
				if ( $biletler->rowCount() ){
				
				    foreach( $biletler as $row ){
			
					echo $row["BILET_NO"];
					}
				}
				
?>