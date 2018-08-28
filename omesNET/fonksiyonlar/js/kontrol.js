 function checkDate()
		{
			var tarih1=document.getElementById('randevuBasTarihi');
			var tarih2=document.getElementById('randevuBitTarihi');			
		
		
				if (tarih1.value == '')
				{
				  tarih1.focus();
				  return false;
				}
				else if (tarih2.value == '')
				{
				  tarih2.focus();
				  return false;
				}
				else{
		
					return true;
				}
							 
				
				
	}
function tarihKontrol()
	{
			var tarih3=document.getElementById('tatilTarihi');
		if (tarih3.value == '')
				{
				  tarih3.focus();
				  return false;
				}
				else{
		
					return true;
				}
}