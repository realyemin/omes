function dogrula()
    {
      var yeniform = document.RandevuForm;
	  if(yeniform.tckimlik.value=="10000000146"){  
	  //M.Kemal Atatürk için TC bilgisi
	  $( "#mesaj" ).text(' -Ulu Önder Mustafa Kemal Atatürk\'ü Saygı, Sevgi ve Rahmetle Anıyoruz.');
	  return false;
	  }
	  if (yeniform.tckimlik.value.length < 11)
      {
          $( "#mesaj" ).text(' -Lütfen TC Kimlik Numaranızı Eksiksiz Giriniz !');
          yeniform.tckimlik.focus();
        return false;
      }
	  else if (yeniform.dogrulamaKodu.value=="")
      {
          $( "#mesaj" ).text(' -Doğrulama kodunu giriniz !');
          yeniform.dogrulamaKodu.focus();
        return false;
      } 
	  else{
		   var values = {
				'tcKimlik': document.getElementById('tckimlik').value,			 
				'dogrulamaKodu': document.getElementById('dogrulamaKodu').value			 
				};
		  	$.ajax({
                    url:'fonksiyonlar/php/tcKimlikBasitKontrol/tcKontrol.php',
                    method:'POST',
                    data:values,
					dataType:'json',
                   success:function(data){
					   if(data.durum=='tcTrue')
					   {						  				
							var tc=window.btoa(document.getElementById('tckimlik').value);
							var grpid=window.btoa(document.getElementById('GRPID').value);
							window.location.href="kon.php?t="+tc+"&g="+grpid;
					   }
					   else if(data.durum=='tcFalse'){
						   $( "#mesaj" ).text(data.mesaj);
						   yeniform.tckimlik.value="";
						   yeniform.tckimlik.focus();
					   }
                      else if(data.durum=='dcFalse'){						  
						   $( "#mesaj" ).text(data.mesaj);
							yeniform.dogrulamaKodu.value="";
							yeniform.dogrulamaKodu.focus();
					  }
					   
                   },
				    error:function(ma,ydin)
					{
						if (ma.status === 0) {
							alert('[jquery]Bağlantı yok, ağı doğrulayın.');
						} else if (ma.status == 404) {
							alert('[jquery]Talep edilen sayfa bulunamadı. [404]');
						} else if (ma.status == 500) {
							alert('[jquery]Dahili Sunucu Hatası [500].');
						} else if (ydin === 'parsererror') {
							alert('[jquery]İstenen JSON ayrıştırması başarısız'+ma);
						} else if (ydin === 'timeout') {
							alert('[jquery]Zaman aşımı hatası.');
						} else if (ydin === 'abort') {
							alert('[jquery]Ajax isteği reddedildi.');
						} else {
							alert('[jquery]Yakalanmamış Hata.\n' + ma.responseText);
						}
					}, 
                });
	  }
    }
	