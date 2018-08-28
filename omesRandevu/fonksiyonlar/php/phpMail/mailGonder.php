<?php /*
-- =============================================
-- Author:		EKOMURCU
-- Create date: 03.07.2018
-- Description:	phpMailer sınıf ile smtp mail işlemi 
-- Randevu bilgileri müsterilere gönderebilmek için
-- ============================================= 
 */?><?php
include("class.phpmailer.php");
	function MailGonder($adsoyad,$eposta,$mesaj,$sunucuAyar)
	{
	
		$adsoyad = htmlspecialchars(trim($adsoyad));
		$eposta = htmlspecialchars(trim($eposta));
	
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = htmlspecialchars(trim($sunucuAyar['host']));
		$mail->Port = htmlspecialchars(trim($sunucuAyar['port']));//465 ssl için 587 tsl için
		//$mail->SMTPSecure = 'tls'; natro icin gerek yok gmail vs için var ama gmail artık kota koyuyor
		$mail->Username = htmlspecialchars(trim($sunucuAyar['username']));
		$mail->Password = htmlspecialchars(trim($sunucuAyar['password']));
		$mail->SetFrom($mail->Username, htmlspecialchars(trim($sunucuAyar['fromMesaj'])));
		$mail->AddAddress($eposta, $adsoyad);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = htmlspecialchars(trim($sunucuAyar['subject']));
		$mail->IsHTML(true);
		$mail->MsgHTML($mesaj);
		if($mail->Send()) {
			// e-posta başarılı ile gönderildi
			//echo '<div class="success">E-posta başarıyla gönderildi, lütfen kontrol edin.</div>';
		} else {
			// bir sorun var, sorunu ekrana bastıralım
			//echo '<div class="error">'.$mail->ErrorInfo.'</div>';
		}
	
	}		
?>