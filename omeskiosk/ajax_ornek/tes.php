<script src="dist/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	//id değeri btn olan butona tıklandığına
		$('#btn').click(function(){
		//aşağıda ki ajax metodu çalışacak
			$.ajax
			({	
			//type:Göndereceimiz metodu belirler
				type	: "POST",
			//url :veri istenilen php dosyasının adresi
				url	:'veri.php',
			//data :verileri göndermek için
				data	:$('#formum').serialize(),
			//success :İstenilen veri geldi ise
				success	:function(donen_veri)
				{
					alert(donen_veri);
				},
			})
		})
	});
</script>
<form id="formum">
    isim      <input type="text" name="isim"/>
    soyisim   <input type="text" name="soyisim"/>
    <input type="button" id="btn" value="gonder"/>
</form>