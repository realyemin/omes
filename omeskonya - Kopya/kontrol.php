<?php
require("fonksiyonlar/php/tcKimlikSinifi.php");


		$tc=new tcKimlik();
			if($tc->Dogrumu($_POST['tcKimlik']))
			{				
				$kimlik="TC: ".$_POST['tcKimlik']." doğrulandı.";
								
				 echo '{"durum":true, "mesaj":"'.$kimlik.'"}'; 			
			}
			else{
			$kimlik="Lütfen geçerli bir kimlik numarası giriniz. [".$_POST['tcKimlik']."] hatalı tc.";
				echo '{"durum":false, "mesaj":"'.$kimlik.'"}'; 		
				 				
			}
//echo json_encode($data); 
?>