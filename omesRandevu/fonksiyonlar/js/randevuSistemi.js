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
					'GRPID': document.getElementById("GRPID").value ,
					'IPAdresi': document.getElementById("IPAdresi").value ,
					'eposta': document.getElementById("eposta").value ,
					'saat': randevuSaati     
				};
				$.ajax({
                    url:'siteParts/randevuKaydet.php',
                    type:'POST',					
					timeout: 30000,
                    data:values,
					dataType:'json',
					success:function(data){
						if(data.durum)
						{
							a.disabled=true;						
							a.className = "selected";
							//birlikte kullanılacak
							$('.modal-body').html(data.mesaj);						
							$("#myBtn").click();
						    //birlikte kullanılacak
							
						}
						else{
							$("#mesajGenel").text(data.mesaj);//HATA MESAJI
						}
					},
					beforeSend: function() 
					{
						loadingGoster();//işlem başladı
					},
					complete:function()
					{
						loadingGizle();//işlem bitti
						
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
							$("#mesajGenel").text('[jquery]İstenen JSON ayrıştırması başarısız'+ma.responseText);
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
			//$("#mesajGenel").text("Lütfen Bir randevu saati seçiniz!");
			$('.modal-body').html("<div class='alert alert-warning'>Lütfen Bir randevu saati seçiniz!</div>");														
			$("#myBtn").click();
			
			
		}						
	}
}
function randevuYukle()
{		
	b=document.getElementById("saat");
	randevuTarihi=document.getElementById("tarih").value;
	b.innerHTML="SEÇTİĞİNİZ RANDEVU TARİHİ: <span class='button yesil' style='font-weight:bold;'>"+randevuTarihi+"</span>"
	var values = {
		'tarih': document.getElementById("tarih").value,   
		'GRPID': document.getElementById("GRPID").value         
	};
	$.ajax({
		url:'siteParts/randevuListele.php',
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
			loading();			
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
function randevuIptal(randevuId,tc,grpid,eposta,randevuTarihi,randevuSaati)
{
	
	var durum= confirm('Dikkat! Randevunuzu iptal etmek istiyor musunuz?');
	if(durum)
	{
		var values = {
			'randevuId': randevuId,   
			'tc': tc,   
			'GRPID': grpid, 
			'eposta': eposta,
			'randevuTarihi': randevuTarihi,    
			'randevuSaati': randevuSaati    
		};
		$.ajax({
			url:'siteParts/randevuIptal.php',
			type: 'POST',
			data:values,
			dataType:'json',
			success:function(data){
				if(data.durum)
				{								   
					$('.modal-body').html(data.mesaj);											
					$("#myBtn").click(); 
				}
				else{
					$("#mesajGenel").text("İşlem Tamamlanamadı!");
				}
			},
			beforeSend: function() 
			{
				loadingGoster();//işlem başladı
			},
			complete:function()
			{
				loadingGizle();//işlem bitti				
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
					$("#mesajGenel").text('[jquery]İstenen JSON ayrıştırması başarısız'+ma.responseText);
					} else if (ydin === 'timeout') {
					$("#mesajGenel").text('[jquery]Zaman aşımı hatası.');
					} else if (ydin === 'abort') {
					$("#mesajGenel").text('[jquery]Ajax isteği reddedildi.');
					} else {
					$("#mesajGenel").text('[jquery]Yakalanmamış Hata.\n' + ma.responseText);
				}
			}, 
		});
		}else{
		return false;
	}
}	

function loadingGoster()
{
	$('.modal-body').html("<div class='alert alert-info'>İşleminiz yapılıyor..<div class='loader'></div></div>");
	$("#myBtn").click();
}
function loadingGizle()
{
	$('.panel').html("<div class='alert alert-success'>İşlem Tamam</div>");
}
function loading()
{
	$('.panel').html("<div class='alert alert-info'>Yükleniyor..<div class='loader'></div></div>");
}