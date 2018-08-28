<?php

    $gruplar = $db -> query("SELECT top 1 * FROM GRUPLAR WHERE Webrandevu=1")->fetch();
			     
				 
       /* foreach ($gruplar as $item)
		{
			echo "Grup ID:".$item["GRPID"]."<br>";
            echo "Grup Adı:".$item["GRUP_ISMI"]."<br>";
			echo "Min Hizmet Süresi:".$item["MIN_HIZMET_SURESI"]."<br>";
			echo "Mesai baş:".$item["MESAI_BAS"]."</br>";
			echo "Mesai Bitiş:".$item["MESAI_BIT"]."</br>";
			echo "Öğle Baş:".$item["OGLE_BAS"]."</br>";
			echo "Öğle Bitiş:".$item["OGLE_BIT"]."<hr>";
		}  
		*/
?>