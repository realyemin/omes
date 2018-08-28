function kontrol()
{
	var theForm = document.KomekForm1;
	var tarih=document.getElementById('tarih');
	
	if (theForm.adi.value == '')
	{
		$("#adi").attr("placeholder", "Lütfen Adınızı Yazınız");				  
		theForm.adi.focus();
		return false;
	}
	
	if (theForm.soyadi.value == '')
	{
		$("#soyadi").attr("placeholder", 'Lütfen Soyadınızı Yazınız');
		theForm.soyadi.focus();
		return false;
	}
		
	if (theForm.telefon1.value == '')
	{
		$("#telefon1").attr("placeholder",'Lütfen Telefon Numarası Yazınız');
		theForm.telefon1.focus();
		return false;
	}	
	else if (theForm.telefon1.value.length < 14)
	{
		$("#mesajTelefon").text('Telefon Numarasını Doğru Giriniz Örn.(544) 100-2030)');
		theForm.telefon1.focus();
		return false;
	}
	else{
		$("#mesajSoyad").text('');
	}
	if (tarih.value == '')
	{
		$("#mesajTelefon").text('Lütfen Bir Randevu Tarihi Seçiniz');
		tarih.focus();
		return false;
	}
	else{
		$("#mesajTelefon").text("");
		return true;
	}
	
}
