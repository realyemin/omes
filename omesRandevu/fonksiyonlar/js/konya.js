function kontrol()
{
	var theForm = document.RandevuForm1;
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
		$("#telefon1").attr("placeholder",'Lütfen Telefon Numarası Yazınız.');
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
	if (theForm.eposta.value == '')
	{
		$("#eposta").attr("placeholder",'Eposta Hesabınızı Yazınız.');
		theForm.eposta.focus();
		return false;
	}
	else if(!isValidEmailAddress(theForm.eposta.value) && theForm.eposta.value!='true')
	{
		theForm.eposta.value="";
		$("#eposta").attr("placeholder",'Geçerli bir eposta giriniz.');
		theForm.eposta.focus();
		return false;
	}
	if (tarih.value == '')
	{
		$("#mesajTelefon").text('Lütfen Bir Randevu Tarihi Seçiniz.');
		tarih.focus();
		return false;
	}
	else{
		$("#mesajTelefon").text("");
		return true;
	}
}

function isValidEmailAddress(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    return (false)
}