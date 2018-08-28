 <?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 14.04.2018
-- Description:	haftasonu tatilini dahil etmeden takvim gösterme(datepicker.js jquery eklentisi için)
-- ============================================= 
 */
 if(isset($db)){ 
$row_RandevuAyar = $db->query("SELECT randevuSecimi,minimumTarihSayisi,minimumTarihTuru,maksimumTarihSayisi,maksimumTarihTuru,takvimTema,takvimAnimasyon,animasyonHizi,biletSinirla,biletSinirSayisi FROM RANDEVU_AYAR WHERE GRPID='$GRPID'")->fetch();
$tarihDizisi="";
$tarihler = $db->query("SELECT tatilTarihi,tatilPeriyot,aktif FROM RANDEVU_TATIL_AYAR", PDO::FETCH_ASSOC);
				if ( $tarihler->rowCount() ){
				
				foreach( $tarihler as $row ){
					if($row['tatilPeriyot']==1 && $row['aktif']==1) //sadece aktif ve tam gün olan tarihleri randevu takvimine ekle
					{ 
					$tarihDizisi.="\"".date("j-n-Y",strtotime($row['tatilTarihi']))."\",";////tarih formatı gün-ay-yıl şeklinde(15-5-2018 gibi,sıfırlar yok)
					}
				}
				}		
$tarihDizisi=trim($tarihDizisi,",");	//virgulü buda			
?>
 <script type="text/javascript">
 <?php 
switch($row_RandevuAyar["randevuSecimi"])//sadece haftasonunda randevu almayı engelle
{
case 1:	?> 
	 $(document).ready(function() {
    $('#tarih').datepicker({      
		changeMonth: true,		
        dayNamesMin: ["Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 
        monthNamesShort: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 		
		duration: "<?php echo trim($row_RandevuAyar['animasyonHizi']," ");?>",			
        dateFormat: "dd.mm.yy",
        showAnim: "<?php echo trim($row_RandevuAyar['takvimAnimasyon']," ");?>",  
		beforeShowDay: $.datepicker.noWeekends,
		minDate:"+<?php echo trim($row_RandevuAyar['minimumTarihSayisi'].$row_RandevuAyar['minimumTarihTuru']," ");?>",
		maxDate: "+<?php echo trim($row_RandevuAyar['maksimumTarihSayisi'].$row_RandevuAyar['maksimumTarihTuru']," ");?>",
		firstDay: 1
    });
}); 
 <?php break;
case 2: //hem hafta sonu hem de hafta içi seçili günlerde randevuyu engelle
 ?>
	 var disabledSpecificDays = [<?php echo $tarihDizisi; ?>]; //dahil edilmeyecek olan tarihler 
 
function disableSpecificDaysAndWeekends(date) {
	var m = date.getMonth();
	var d = date.getDate();
	var y = date.getFullYear();
 
	for (var i = 0; i < disabledSpecificDays.length; i++) {
		//BU SATIR ESKİ || new Date() > date ÖZELLİĞİ İLE AYNI GÜN RANDEVU ALINMASI ENGELLENMEK İSTENİRSE AKTİF EDİLEBİLİR!
		// if ($.inArray(d + '-' + (m + 1)  + '-' + y, disabledSpecificDays) != -1 || new Date() > date) {
		if ($.inArray(d + '-' + (m + 1)  + '-' + y, disabledSpecificDays) != -1) {
			return [false];
		}
	}
 
	var noWeekend = $.datepicker.noWeekends(date);
	return !noWeekend[0] ? noWeekend : [true];
}
 
 
$(document).ready(function() {
    $('#tarih').datepicker({   
		changeMonth: true,	    
        dayNamesMin: ["Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 
        monthNamesShort: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 		
		duration: "<?php echo trim($row_RandevuAyar['animasyonHizi']," ");?>",
        dateFormat: "dd.mm.yy",
        showAnim: "<?php echo trim($row_RandevuAyar['takvimAnimasyon']," ");?>",  
		beforeShowDay: disableSpecificDaysAndWeekends,
		minDate:"+<?php echo trim($row_RandevuAyar['minimumTarihSayisi'].$row_RandevuAyar['minimumTarihTuru']," ");?>",
		maxDate: "+<?php echo trim($row_RandevuAyar['maksimumTarihSayisi'].$row_RandevuAyar['maksimumTarihTuru']," ");?>",		
		firstDay: 1
    });
}); 
	 <?php
 break;
 case 3://sadece seçili günleri randevu almayı engelle
	 ?>
	  var unavailableDates = [<?php echo $tarihDizisi; ?>];

    function unavailable(date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if ($.inArray(dmy, unavailableDates) == -1) {
            return [true, ""];
        } else {
            return [false, "", "Unavailable"];
        }
    }
	$(document).ready(function() {
    $('#tarih').datepicker({   
		changeMonth: true,	    
        dayNamesMin: ["Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
		monthNamesShort: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 		
		duration: "<?php echo trim($row_RandevuAyar['animasyonHizi']," ");?>",
        dateFormat: "dd.mm.yy",
        showAnim: "<?php echo trim($row_RandevuAyar['takvimAnimasyon']," ");?>",  
		beforeShowDay: unavailable,
		minDate:"+<?php echo trim($row_RandevuAyar['minimumTarihSayisi'].$row_RandevuAyar['minimumTarihTuru']," ");?>",
		maxDate: "+<?php echo trim($row_RandevuAyar['maksimumTarihSayisi'].$row_RandevuAyar['maksimumTarihTuru']," ");?>",
		firstDay: 1
    });
}); 
	 <?php
 break;
case 4: //her zaman randevu ver
?>
	 $(document).ready(function() {
    $('#tarih').datepicker({       
		changeMonth: true,	
        dayNamesMin: ["Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 
        monthNamesShort: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"], 		
		duration: "<?php echo trim($row_RandevuAyar['animasyonHizi']," ");?>",		
        dateFormat: "dd.mm.yy",
        showAnim: "<?php echo trim($row_RandevuAyar['takvimAnimasyon']," ");?>",  
		minDate:"+<?php echo trim($row_RandevuAyar['minimumTarihSayisi'].$row_RandevuAyar['minimumTarihTuru']," ");?>",
		maxDate: "+<?php echo trim($row_RandevuAyar['maksimumTarihSayisi'].$row_RandevuAyar['maksimumTarihTuru']," ");?>",
		firstDay: 1
    });
}); 
<?php break; }  ?>
</script>
 <?php } ?>