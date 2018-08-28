<?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 15.04.2018
-- Description:	Randevu sisteminin(randevu.php den) hafta sonu kullanılmasını engellemek için yazıldı
-- ============================================= 
 */?>
<?php
function hafta_sonu($current_day) 
{
	// date parametresi Y-m-d formatında yollanmali
	$str=strtotime(date($current_day));   
	$date=date("w", $str);        
	$durum=false;
	$week=array("0"=>"Pazar",       
					  "1"=>"Pazartesi",             
					  "2"=>"Salı",               
					  "3"=>"Çarşamba",             
					  "4"=>"Perşembe",             
					  "5"=>"Cuma",               
					  "6"=>"Cumartesi",           
		 );  
		if($week[$date]=="Pazar" or $week[$date]=="Cumartesi")
		{
			$durum=true;
		}	
		 return $durum;
}
?>