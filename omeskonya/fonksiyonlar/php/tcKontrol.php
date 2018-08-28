<?php
require("tcKimlikSinifi.php");

if(!isset($_SESSION))
{
	session_start();
}

 if(isset($_POST['dogrulamaKodu']) && isset($_SESSION['guvenlik_kodu']) && $_POST['dogrulamaKodu'] != $_SESSION['guvenlik_kodu'] && $_POST['dogrulamaKodu']!="bos") {
 $mesaj= ' -Güvenlik kodu hatalı!';
 echo '{"durum":"dcFalse", "mesaj":"'.$mesaj.'"}'; 
 }
 else{
	
		$tc=new tcKimlik();
			if($tc->Dogrumu($_POST['tcKimlik']))
			{				
				$kimlik="TC: ".$_POST['tcKimlik']." doğrulandı.";
								
				 echo '{"durum":"tcTrue", "mesaj":"'.$kimlik.'"}'; 			
			}
			else{
			$kimlik=" -Lütfen geçerli bir kimlik numarası giriniz. [".$_POST['tcKimlik']."] hatalı tc.";
				echo '{"durum":"tcFalse", "mesaj":"'.$kimlik.'"}'; 							 			
			}
	}
//echo json_encode($data); 
?>