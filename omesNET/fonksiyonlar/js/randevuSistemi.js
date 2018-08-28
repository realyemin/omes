var a,b,randevuTarihi,randevuSaati;
	function mesaj(id,deger)
	{		
		randevuSaati=deger;
		randevuTarihi=document.getElementById("tarih").value;
		a=document.getElementById(id);
		b=document.getElementById("saat");
		b.style = "display:block";
		b.innerHTML="SEÇTİĞİNİZ RANDEVU SAATİ: <span class='button yesil' style='font-weight:bold;'>"+randevuTarihi+"-"+randevuSaati+"</span>";
	}
	function kaydet()
	{
		if(kontrol()) //telefon no girildiyse devam et
		{		randevuTarihi=document.getElementById("tarih").value;
			if(a!=null) //herhangi bir saat(radio) seçilmişse
			{
				
				if(confirm("Seçtiğiniz randevu saati: "+randevuTarihi+"-"+randevuSaati+'.\n Randevuyu kaydetmek istediğinizden emin misiniz?'))
				{
				
				 var values = {
				'ad': document.getElementById('adi').value,
				'soyad': document.getElementById('soyadi').value,
				'tel':  document.getElementById('phone').value,
				'tc':  document.getElementById('tc').value,
				'tarih': document.getElementById("tarih").value,
				'saat': randevuSaati     
				};
					$.ajax({
                    url:'randevuKaydet.php',
                    type:'POST',
                    data:values,
					dataType:'json',
                   success:function(data){
                     if(data.durum)
					   {
						   a.disabled=true;						
							a.className = "selected";
								$('.modal-body').html(data.mesaj);						
								//bilet modal'ini tetikleyen buton
								$("#myBtn").click();						    
							//window.location.href="index.php";		//modalsiz direk indexe gider					
					    }
                      else{
						   $("#mesajGenel").text(data.mesaj);
					  }
                   },
				  beforeSend: function() {
					$('.panel').html("<div class='alert alert-info'>Yükleniyor..<div class='loader'></div></div>");
					},
				   error:function(ma,ydin)
					{
						if (ma.status === 0) {
							$("#mesajGenel").text('[jquery]Bağlantı yok, ağı doğrulayın.');
						} else if (ma.status == 404) {
							$("#mesajGenel").text('[jquery]Talep edilen sayfa bulunamadı. [404]');
						} else if (ma.status == 500) {
							$("#mesajGenel").text('[jquery]Dahili Sunucu Hatası [500].');
						} else if (ydin === 'parsererror') {
							$("#mesajGenel").text('[jquery]İstenen JSON ayrıştırması başarısız');
						} else if (ydin === 'timeout') {
							$("#mesajGenel").text('[jquery]Zaman aşımı hatası.');
						} else if (ydin === 'abort') {
							$("#mesajGenel").text('[jquery]Ajax isteği reddedildi.');
						} else {
							$("#mesajGenel").text('[jquery]Yakalanmamış Hata.\n' + ma.responseText);
						}
					}, 
                });
				}
			}
			else{
					b=document.getElementById("saat");
					b.style = "display:block";
					b.innerHTML="<span style='color:yellow;'>Lütfen Bir randevu saati seçiniz!</span>";
					$("#mesajGenel").text("Lütfen Bir randevu saati seçiniz!");
					//$("#saat").click();
					
			}						
			}
	}
	function randevuYukle()
	{		
	b=document.getElementById("saat");
	randevuTarihi=document.getElementById("tarih").value;
	b.innerHTML="SEÇTİĞİNİZ RANDEVU TARİHİ: <span class='button yesil' style='font-weight:bold;'>"+randevuTarihi+"</span>"
			var values = {
				'tarih': document.getElementById("tarih").value     
				};
				$.ajax({
                    url:'randevuListele.php',
                    type: 'POST',
                    data:values,
			        success:function(data){
                     if(data)
					   {								   
							$('.panel').html(data);		
					    }
                      else{
						  $('.panel').text("VERİ YOK!");
					  }
                   },
				   beforeSend: function() {
					$('.panel').html("<div class='alert alert-info'>Yükleniyor..<div class='loader'></div></div>");
					},
				   error:function(ma,ydin)
					{
						if (ma.status === 0) {
							$("#mesajGenel").text('[jquery]Bağlantı yok, ağı doğrulayın.');
						} else if (ma.status == 404) {
							$("#mesajGenel").text('[jquery]Talep edilen sayfa bulunamadı. [404]');
						} else if (ma.status == 500) {
							$("#mesajGenel").text('[jquery]Dahili Sunucu Hatası [500].');
						} else if (ydin === 'parsererror') {
							$("#mesajGenel").text('[jquery]İstenen JSON ayrıştırması başarısız');
						} else if (ydin === 'timeout') {
							$("#mesajGenel").text('[jquery]Zaman aşımı hatası.');
						} else if (ydin === 'abort') {
							$("#mesajGenel").text('[jquery]Ajax isteği reddedildi.');
						} else {
							$("#mesajGenel").text('[jquery]Yakalanmamış Hata.\n' + ma.responseText);
						}
					}, 
                });
	}	