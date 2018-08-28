function dogrula()
    {
      var yeniform = document.KomekForm;
	  if (yeniform.tckimlik.value.length <11)
      {
          $( "#mesaj" ).text('Lütfen TC Kimlik Numaranızı Eksiksiz Giriniz !');
          yeniform.tckimlik.focus();
        return false;
      }
	  else{
		   var values = {
				'tcKimlik': document.getElementById('tckimlik').value			 
				};
		  	$.ajax({
                    url:'kontrol.php',
                    method:'POST',
                    data:values,
					dataType:'json',
                   success:function(data){
					   if(data.durum)
					   {
						    //alert(data.mesaj);							
							var tc=window.btoa(document.getElementById('tckimlik').value);
							window.location.href="kon.php?t="+tc;
					   }
                      else{
						   //alert(data.mesaj);
						   $( "#mesaj" ).text(data.mesaj);
						   yeniform.tckimlik.value="";
						   yeniform.tckimlik.focus();
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
							alert('[jquery]İstenen JSON ayrıştırması başarısız');
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