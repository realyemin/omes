<?php
if(isset($_POST['GRPID']))
{
$GRPID=$_POST['GRPID'];
 }else { $GRPID=-1; }
    $gruplar = $db -> query("SELECT * FROM GRUPLAR WHERE Webrandevu=1 AND AKTIF =1 AND GRPID='$GRPID'");
			     
				 if ( $gruplar->rowCount() ){
					$gruplar=$gruplar ->fetch();
					$grupDurum=true;
				 }else
				 {
					 $grupDurum=false;
				 }
 
?>