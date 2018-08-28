<?php
//kendi hata sayfamı kullanmak istersem diye bunu buraya bırakıyorum
/*
function error_found(){
  header("Location: oops.php");
}
set_error_handler('error_found');
*/
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session variables
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = ".";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<style>
  .affix {
      top:0px;
	  left:0px;
      width: 100%;
      z-index: 9999 !important;
  }
  .navbar {
      margin-bottom: 0px;
	  margin-top:0px;
  }

  .affix ~ .container-fluid {
     position: relative;
     top: 50px;
  }
  .activeMenu
  {
	  background:gray;
	  color:#fff !important;
	  border-radius:10px;
  }
    .activeMenu:hover
  {
	  color:black !important;
	  
  }
      .activeMenu:focus
  {
	  color:black !important;
	  
  }
  </style>
  <nav class="navbar navbar-default" data-spy="affix" data-offset-top="30" >
  <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="."><span class="glyphicon glyphicon-home"></span> OMES WEB
		  <span class="badge label-info"><?php echo $vt_turu; ?></span></a>
        </div>
        <div class="navbar-collapse collapse">
          <?php if(isset($_SESSION['MM_Username'])) {?>
          <ul class="nav navbar-nav">
            <li><a href="" class="dropdown-toggle <?php if(isset($_GET['GrupListele']) || isset($_GET['GrupEkle'])){ echo "activeMenu"; } ?>" data-toggle="dropdown"><span class="glyphicon glyphicon-th-large"></span> Grup Paneli<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?GrupListele">Listele/Sil/Güncelle</a></li>
                <li><a href="?GrupEkle"><span class="glyphicon glyphicon-plus-sign"></span>  Grup Ekle</a></li>
                
              </ul>
            </li>
          </ul>
           
          <ul class="nav navbar-nav">
            <li><a href="" class="dropdown-toggle <?php if(isset($_GET['TerminalListele']) || isset($_GET['TerminalEkle'])){ echo "activeMenu"; } ?>" data-toggle="dropdown"><span class="glyphicon glyphicon-phone"></span> Terminal Paneli<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?TerminalListele">Listele/Sil/Güncelle</a></li>
                <li><a href="?TerminalEkle"><span class="glyphicon glyphicon-plus-sign"></span> Terminal Ekle</a></li>
              </ul>
            </li>
          </ul>
           <ul class="nav navbar-nav">
            <li class=""><a href="" class="dropdown-toggle <?php if(isset($_GET['BiletMakinesiEkle']) || isset($_GET['AnaButonEkle']) || isset($_GET['AltButonEkle'])){ echo "activeMenu"; } ?>" data-toggle="dropdown"><span class="glyphicon glyphicon-barcode"></span> Bilet Makineleri<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?BiletMakinesiEkle"><span class="glyphicon glyphicon-plus-sign"></span> Ekle/Sil/Güncelle</a></li>
                <li class="divider"></li>
                <li><a href="?AnaButonEkle"><span class="glyphicon glyphicon-circle-arrow-up"></span> AnaButon İşlemleri</a></li>
                <li><a href="?AltButonEkle"><span class="glyphicon glyphicon-circle-arrow-down"></span> AltButon İşlemleri</a></li>
              </ul>
              
            </li>
          </ul>
           <ul class="nav navbar-nav">
            <li class=""><a href="" class="dropdown-toggle <?php if(isset($_GET['KioskEkle']) || isset($_GET['BiletEkle'])){ echo "activeMenu"; } ?>" data-toggle="dropdown"><span class="glyphicon glyphicon-hdd"></span> Kioks Ekranı<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?KioskEkle"><span class="glyphicon glyphicon-list-alt"></span> Kiosk Ayarları</a></li>
                <li class="divider"></li>
                <li><a href="?BiletEkle"><span class="glyphicon glyphicon-print"></span> Bilet Yazdırma Ayarları</a></li>               
              </ul>                            
            </li>            
          </ul>         
              
  <ul class="nav navbar-nav">
            <li><a href="" class="dropdown-toggle <?php if(isset($_GET['AnaTabloListele']) || isset($_GET['AnaTabloEkle']) || isset($_GET['AnaTabloYonListele']) || isset($_GET['AnaTabloYonEkle'])){ echo "activeMenu"; } ?>" data-toggle="dropdown">
			<span class="glyphicon glyphicon-th-list"></span> AnaTablo Ekranı<b class="caret"></b></a>			
              <ul class="dropdown-menu">
                <li><a href="?AnaTabloListele"><span class="glyphicon glyphicon-th"></span> AnaTablolar</a></li>
                
                <li><a href="?AnaTabloEkle"><span class="glyphicon glyphicon-plus-sign"></span> AnaTablo Ekle</a></li>
				<li class="divider"></li>
                <li><a href="?AnaTabloYonListele"><span class="glyphicon glyphicon-arrow-left"></span> AnaTablo Yönleri</a></li>
                
                <li><a href="?AnaTabloYonEkle"><span class="glyphicon glyphicon-plus-sign"></span> AnaTabloYön Ekle</a></li>
              </ul>
		</li>			  
          </ul> 			  
         <ul class="nav navbar-nav">
            <li><a href="" class="dropdown-toggle <?php if(isset($_GET['WebRandevu'])){ echo "activeMenu"; } ?>" data-toggle="dropdown">
			<span class="glyphicon glyphicon-globe"></span> WEB RANDEVU<b class="caret"></b></a>			
              <ul class="dropdown-menu"> 
                <li><a href="?WebRandevu&ana"><span class="glyphicon glyphicon-eye-open"></span> Görüntüle</a></li>
                <li><a href="?WebRandevu&tatil=on"><span class="glyphicon glyphicon-plane"></span> Tatil Ayar</a></li>
                <li><a href="?WebRandevu&randevu=on"><span class="glyphicon glyphicon-time"></span> Randevu Ayar</a></li>
                <li><a href="?WebRandevu&takvim=on"><span class="glyphicon glyphicon-calendar"></span> Takvim Ayar</a></li>
                <li><a href="?WebRandevu&oturum=on"><span class="glyphicon glyphicon-hourglass"></span> Oturum Ayar</a></li>
				<li class="divider"></li>
				  <li><a href="?WebRandevu&mail=on"><span class="glyphicon glyphicon-envelope"></span> Eposta Hizmeti</a></li>
				  <li><a href="?WebRandevu&sms=on"><span class="glyphicon glyphicon-phone"></span> SMS Hizmeti</a></li>
				<li class="divider"></li>
                <li><a href="?WebRandevu&sistem=on"><span class="glyphicon glyphicon-cog"></span> Sistem Aç/Kapa</a></li>                        
              </ul>
		</li>			  
          </ul>                
<ul class="nav navbar-nav navbar-right">
      <li>
      	<a class="dropdown-toggle" data-toggle="dropdown" href="">
        <button class="btn btn-danger"><span class="glyphicon glyphicon-log-out"></span>Hesap: <?php echo $_SESSION["kAdi"]; ?></button>
        <b class="caret"></b></a>
           	<ul class="dropdown-menu">
                <li>
                <a href="<?php echo $logoutAction ?>"><span class="glyphicon glyphicon-off"></span> Güvenli Çıkış</a>
                </li>
               <li class="divider"></li> 
                <li>
                <a href="?Personel"><span class="glyphicon glyphicon-user"></span> Hesap Ayarları</a>
                </li>
                <li>
                <a href="?SistemAyarlari"><span class="glyphicon glyphicon-cog"></span> Sistem Ayarları</a>
            </li>
     		</ul>
     </li>
</ul>                    
          
            <?php }else { ?>           
          <ul class="nav navbar-nav navbar-right">
            <li class="active">
           <button class="button" onclick="document.getElementById('id01').style.display='block'"><span class="glyphicon glyphicon-user"></span> Giriş</button>
		   </li>                      
          </ul>
          <?php } ?>
        </div><!--/.nav-collapse -->           
</nav>
<?php include('giris.php'); ?>