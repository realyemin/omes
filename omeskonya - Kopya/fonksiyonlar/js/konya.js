	function kontrol()
		{
			var theForm = document.KomekForm1;
			var tarih=document.getElementById('tarih');
		
				if (theForm.adi.value == '')
				{
				  alert('Lütfen Adınızı Yazınız');
				  theForm.adi.focus();
				  return false;
				}
				else if (theForm.soyadi.value == '')
				{
				  alert('Lütfen Soyadınızı Yazınız');
				  theForm.soyadi.focus();
				  return false;
				}
				else if (theForm.telefon1.value == '')
				{
				  alert('Lütfen Telefon Numarası Yazınız');
				  theForm.telefon1.focus();
				  return false;
				}	
				else if (theForm.telefon1.value.length < 14)
				{
				  alert('Telefon Numarasını Doğru Giriniz Örn.(544) 100-2030)');
				  theForm.telefon1.focus();
				  return false;
				}
				else if (tarih.value == '')
				{
				  alert('Lütfen Bir Randevu Tarihi Seçiniz');
				  tarih.focus();
				  return false;
				}
				else{
					return true;
				}
		}
	
