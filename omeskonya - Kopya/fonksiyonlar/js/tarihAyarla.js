/*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 14.04.2018
-- Description:	haftasonu tatilini dahil etmeden takvim gösterme(datepicker.js jquery eklentisi için)
-- ============================================= 
 */


$(document).ready(function() {
    $('#tarih').datepicker({       
        dayNamesMin: [ "Paz","Pzts", "Sal", "Çar", "Per", "Cu", "Cmts"],
        monthNames: ["Ocak", "Subat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],    
        dateFormat: "dd.mm.yy",
        showAnim: "drop",  
        beforeShowDay: $.datepicker.noWeekends,       
		minDate:"+1d",
		maxDate: "+4w",
		firstDay: 1
    });
});

