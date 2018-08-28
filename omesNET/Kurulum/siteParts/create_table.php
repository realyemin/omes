<?php 
	/*
		-- =============================================
		-- Author:		EKOMURCU
		-- Create date: 10.06.2018
		-- Description:	Mysql ve MSSql veritabani için TABLO OLUŞTURMA ve SİLME işlemleri birlikte yapıldı
		-- ============================================= 
	*/
include("../Connections/baglantim.php"); ?>

<div class="jumbotron alert alert-warning">
    <h2><img src="images/tablo_icon.png"> 2) TABLOLAR</h2>      
    <p>Veritabanınızı oluşturduktan sonra gerekli tabloları oluşturabilirsiniz.</p>
</div>

<?php
	
	// Create_Scripts/ klasöründeki hazır SQL script dosyalarından tablo oluşturur
	if(isset($_POST['islem']))
	{
		try{
			$sql = file_get_contents("Create_Scripts/".$vt_turu."/".$_POST['tabloAdi'].".sql");
			$sql = htmlspecialchars($sql);
			$sql=preg_replace("-GO-","",$sql); //sql içinden ayıklama
			$qr = $db->exec($sql);
			$mesaj = $_POST['tabloAdi']." Tablosunu ".$veritabani." Veritabanınıza Ekledik.";
			$mesajHata=false;
		}
		catch(PDOException $ex) 
		{	if($ex->getCode()=="42S01")//tablo zaten varsa hata kodu
			{
				$mesaj = $veritabani." içinde ".$_POST['tabloAdi']."- Zaten böyle bir tablonuz var!";
			}
			else{
				echo $mesaj= $ex->getMessage();	
			}
			$mesajHata=true;
		}
	}
	// Create_Scripts/ klasöründeki hazır SQL script dosyalarından tablo oluşturur
	// tabloları SİLER
	if(isset($_POST['islemSil']))
	{
		try{
			$sql="DROP TABLE ".$_POST['tabloAdi'];
			$qr = $db->exec($sql);
			$mesaj = $_POST['tabloAdi']." Tablosunu ".$veritabani." Veritabanınızdan kaldırdınız.";
			$mesajHata=false;
		}
		catch(PDOException $ex) 
		{	if($ex->getCode()=="42S01")//tablo zaten varsa hata kodu
			{
				$mesaj = $veritabani." içinde ".$_POST['tabloAdi']."- Böyle bir tablonuz yok!";
			}
			else{
				echo $mesaj= $ex->getMessage();	
			}
			$mesajHata=true;
		}
	}
	// tabloları SİLER
?>

<?php
	if($vt_turu=='Mssql')
	{
		$dizi=array();
		$tablolar= $db->query("select TABLE_NAME from INFORMATION_SCHEMA.TABLES WHERE TABLE_CATALOG='$veritabani'")->fetchAll();
		foreach($tablolar as $row)
		{
			array_push($dizi, $row['TABLE_NAME']);//eklenen tabloları dizeye at
		}
	} 
?>
<?php
	if($vt_turu=='Mysql')
	{
		$dizi=array();
		$veritabani=strtolower($veritabani);
		$tablolar= $db->query("select TABLE_NAME from INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='$veritabani'")->fetchAll();
		foreach($tablolar as $row)
		{
			array_push($dizi, strtoupper($row['TABLE_NAME']));//eklenen tabloları dizeye at
		}
	} 
?>
<div class="alert <?php if(isset($_POST['secim'])){ echo "alert-danger"; }else{ echo "alert-success";} ?>">
	<?php if($vt_turu=="Mysql"){ ?>
		<img src="images/MySQL.png" class="img-responsive">
		<?php }else{ ?>
		<img src="images/MsSQL.png" class="img-responsive">
	<?php } ?><h4><img src="images/veritabani_icon.png" height="25px"><?php echo $veritabani; ?>  veritabanı için aşağıdaki tabloları ekleyebilir veya silebilirsiniz.</h4> 
	<form method="post">
		<strong>
			</strong> Tablo Oluştur(Create):<label class="switch">
			<input name="secim" onChange="this.form.submit();" type="checkbox" <?php if(isset($_POST['secim'])){ echo "checked"; } ?>>
		<span class="slider round"></span></label>:Kaldır(Drop)<?php if(isset($_POST['secim'])){ echo "<br><strong>DİKKAT BU AYARLAR YALNIZCA SİSTEM YÖNETİCİLERİ TARAFINDAN YAPILMALIDIR!</strong>"; } ?> 
	</form>
</div>
<!-- HATA MESAJLARI -->
<?php 
	if($mesajHata){ ?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><?php echo $mesaj; ?></strong>
	</div>
	<?php }else{ ?>
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong><?php echo $mesaj; ?></strong>
	</div>
<?php } ?>
<!-- HATA MESAJLARI -->
<?php if(!isset($_POST['secim']) ) { ?>
	<div class="alert alert-info table-responsive"><a name="ust"></a>
		<table class="table table-hover">
			<thead>
				<tr><th colspan="4">
				<button class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> EKLENEN TABLO</i></button>
				<button class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> HENÜZ EKLENMEYEN TABLO</i></button>
			</td>
		</thead>
		<tbody>
			<tr>
				<td>
					<form method="post" action="#ust" style="display:inline-block">
						<input type="hidden" value="ANATABLOLAR_CR" name="tabloAdi">
						<button name="islem" class="btn <?php if(in_array("ANATABLOLAR",$dizi)){ echo " btn-success"; }
							else{ echo "btn-warning";} ?>">
							<i class="glyphicon glyphicon-<?php if(in_array("ANATABLOLAR",$dizi)){ echo "ok"; }
							else{ echo "plus";} ?>"></i> ANATABLOLAR</i></button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="ANATABLO_YON_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("ANATABLO_YON",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("ANATABLO_YON",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> ANATABLO_YON</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="ANKET_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("ANKET",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("ANKET",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> ANKET</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="BILETLER_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("BILETLER",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("BILETLER",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> BILETLER</button>
				</form>
			</td>
		</tr>
		<tr>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="BILET_AYAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("BILET_AYAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("BILET_AYAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> BILET_AYAR</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="BILET_MAKINELERI_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("BILET_MAKINELERI",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("BILET_MAKINELERI",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> BILET_MAKINELERI</button>
				</form>
			</td>
			
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="BUTONLAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("BUTONLAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("BUTONLAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> BUTONLAR</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="FONTLAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("FONTLAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("FONTLAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> FONTLAR</button>
				</form>
			</td>
		</tr>
		<tr>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="GRUPLAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("GRUPLAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("GRUPLAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> GRUPLAR</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="HAVUZ_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("HAVUZ",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("HAVUZ",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> HAVUZ</button>
				</form>
			</td>
			
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="KIOSK_AYAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("KIOSK_AYAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("KIOSK_AYAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> KIOSK_AYAR</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="KUYRUK_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("KUYRUK",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("KUYRUK",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> KUYRUK</button>
				</form>
			</td>
		</tr>
		<tr>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="MOLALAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("MOLALAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("MOLALAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> MOLALAR</button>
				</form>
			</td>
			
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="OTURUMLAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("OTURUMLAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("OTURUMLAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> OTURUMLAR</button>
				</form>
			</td>
			
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="PERSONELLER_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("PERSONELLER",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("PERSONELLER",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> PERSONELLER</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="RANDEVU_AYAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("RANDEVU_AYAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("RANDEVU_AYAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> RANDEVU_AYAR</button>
				</form>
			</td>
		</tr>
		<tr>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="RANDEVU_EPOSTA_AYAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("RANDEVU_EPOSTA_AYAR",$dizi)){ echo "btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("RANDEVU_EPOSTA_AYAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> RANDEVU_EPOSTA_AYAR</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="RANDEVU_KAYDET_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("RANDEVU_KAYDET",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("RANDEVU_KAYDET",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> RANDEVU_KAYDET</button>
				</form>
			</td>
			
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="RANDEVU_KULLANICI_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("RANDEVU_KULLANICI",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("RANDEVU_KULLANICI",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> RANDEVU_KULLANICI</button>
				</form>
			</td>
			
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="RANDEVU_TATIL_AYAR_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("RANDEVU_TATIL_AYAR",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("RANDEVU_TATIL_AYAR",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> RANDEVU_TATIL_AYAR</button>
				</form>
			</td>
		</tr>
		<tr>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="SERVIS_HAREKET_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("SERVIS_HAREKET",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("SERVIS_HAREKET",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> SERVIS_HAREKET</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="SISTEM_CONFIG_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("SISTEM_CONFIG",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("SISTEM_CONFIG",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> SISTEM_CONFIG</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="SYS_MESAJ_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("SYS_MESAJ",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("SYS_MESAJ",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> SYS_MESAJ</button>
				</form>
			</td>
			<td>
				<form method="post" action="#ust" style="display:inline-block">
					<input type="hidden" value="SYS_MESAJ_MASTER_CR" name="tabloAdi">
					<button name="islem" class="btn <?php if(in_array("SYS_MESAJ_MASTER",$dizi)){ echo " btn-success"; }
						else{ echo "btn-warning";}  ?>">
						<i class="glyphicon glyphicon-<?php if(in_array("SYS_MESAJ_MASTER",$dizi)){ echo "ok"; }
						else{ echo "plus";} ?>"></i> SYS_MESAJ_MASTER</button>
				</form>
			</td>
			
		</tr>
		<tr>	<td>
			<form method="post" action="#ust" style="display:inline-block">
				<input type="hidden" value="TERMINALLER_CR" name="tabloAdi">
				<button name="islem" class="btn <?php if(in_array("TERMINALLER",$dizi)){ echo " btn-success"; }
					else{ echo "btn-warning";}  ?>">
					<i class="glyphicon glyphicon-<?php if(in_array("TERMINALLER",$dizi)){ echo "ok"; }
					else{ echo "plus";} ?>"></i> TERMINALLER</button>
			</form>
		</td>
		<td>
			
			<form method="post" action="#ust" style="display:inline-block">
				<input type="hidden" value="TERMINAL_BIRIM_CR" name="tabloAdi">
				<button name="islem" class="btn <?php if(in_array("TERMINAL_BIRIM",$dizi)){ echo " btn-success"; }
					else{ echo "btn-warning";}  ?>">
					<i class="glyphicon glyphicon-<?php if(in_array("TERMINAL_BIRIM",$dizi)){ echo "ok"; }
					else{ echo "plus";} ?>"></i> TERMINAL_BIRIM</button>
			</form>
		</td>
		
		<td>
			<form method="post" action="#ust" style="display:inline-block">
				<input type="hidden" value="TERMINAL_GRUP_CR" name="tabloAdi">
				<button name="islem" class="btn <?php if(in_array("TERMINAL_GRUP",$dizi)){ echo " btn-success"; }
					else{ echo "btn-warning";}  ?>">
					<i class="glyphicon glyphicon-<?php if(in_array("TERMINAL_GRUP",$dizi)){ echo "ok"; }
					else{ echo "plus";} ?>"></i> TERMINAL_GRUP</button>
			</form>
		</td>
		
		<td>
			<form method="post" action="#ust" style="display:inline-block">
				<input type="hidden" value="T_DURUM_MASTER_CR" name="tabloAdi">
				<button name="islem" class="btn <?php if(in_array("T_DURUM_MASTER",$dizi)){ echo "btn-success"; }
					else{ echo "btn-warning";}  ?>">
					<i class="glyphicon glyphicon-<?php if(in_array("T_DURUM_MASTER",$dizi)){ echo "ok"; }
					else{ echo "plus";} ?>"></i> T_DURUM_MASTER</button>
			</form>
		</td>
		
		</tr>
	</tbody>
</table>
</div>
<?php } else {
?>
<?php
	if(isset($_POST['islemTumunuSil']))
	{
		try{
			foreach($dizi as $row)
			{
				$sql="DROP TABLE ".$row;
				$qr = $db->exec($sql);
				$mesaj = "Bütün tabloları [".$veritabani."] Veritabanınızdan kaldırdınız.";
				$mesajHata=false;
			}
		}
		catch(PDOException $ex) 
		{	if($ex->getCode()=="42S01")//tablo zaten varsa hata kodu
			{
				$mesaj = $veritabani." içinde ".$_POST['tabloAdi']."- Böyle bir tablonuz yok!";
			}
			else{
				echo $mesaj= $ex->getMessage();	
			}
			$mesajHata=true;
		}
	}
?>
<div class="alert alert-warning table-responsive">
	<table class="table table-hover">
		<thead>
			<tr><th colspan="3">EKLİ OLAN TABLOLAR</th><th>
				<form method="post" action="#ust" style="display:inline-block">
					<button name="islemTumunuSil" onclick="return confirm('Dikkat silme işlemi geri alınamaz');" class="btn btn-warning" data-toggle="tooltip" title="TÜM TABLOLARI KALDIRIR!">
					<i class="glyphicon glyphicon-remove"></i> TÜMÜNÜ SİL </button>
					<input type="hidden" name="secim" value="<?php echo $_POST['secim']; ?>">
				</form> 
			</th></tr>
		</thead>
		<tbody>
			<tr>
				
				<?php	
					$sayac=0;
					sort($dizi);
					foreach($dizi as $row)
					{
						$sayac++;
					?>	
					<td>
						<form method="post" action="#ust" style="display:inline-block"><a name="ust"></a>
							<input type="hidden" value="<?php echo $row; ?>" name="tabloAdi">
							<button name="islemSil" onclick="return confirm('Dikkat silme işlemi geri alınamaz');" class="btn btn-danger" data-toggle="tooltip" title="Seçili tabloyu kaldırır">
							<i class="glyphicon glyphicon-remove"></i> <?php echo $row; ?></button>
							<input type="hidden" name="secim" value="<?php echo $_POST['secim']; ?>">
						</form>
					</td>
					<?php if($sayac%4==0){ ?>
					</tr><?php } ?>
			<?php } ?>
			
		</tbody>
	</table>
</div>
<?php } ?>