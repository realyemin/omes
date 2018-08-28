<?php
	/*
		-- =============================================
		-- Author:		EKOMURCU
		-- Create date: 04.07.2018
		-- Description:	tckimlik.nvi.gov.tr tc kimlik Doğrulaması 
		-- ============================================= 
	*/
	function tcKimlikNviDogrula($tc,$ad,$soyad,$dogumYili)
	{		
		try 
		{			
			$istek = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');
			$kisi=array(
			'TCKimlikNo' => $tc,
			'Ad' => $ad,
			'Soyad' => $soyad,
			'DogumYili' => $dogumYili);
			$sonuc = $istek->TCKimlikNoDogrula($kisi);
			
			if ($sonuc->TCKimlikNoDogrulaResult) 
			{
				return true;
			} 
			else 
			{
				return false;
			}			
		} 
		catch (Exception $exc) 
		{			
			echo $exc->getMessage();
		}		
	}
?>