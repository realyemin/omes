<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">SİSTEM KURULUM</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
     	<li <?php if(isset($_GET['ana'])){ echo 'class="active"'; } ?>><a href="index.php?ana">SUNUCU AYARLARI</a></li>        
        <li <?php if(isset($_GET['create'])){ echo 'class="active"'; } ?>><a href="index.php?create=on">TABLOLAR</a></li>
        <li <?php if(isset($_GET['insert'])){ echo 'class="active"'; } ?>><a href="index.php?insert=on">VERİLER</a></li>
    <li <?php if(empty($_GET)){ echo 'class="active"'; } ?>>
		<?php if(empty($_SESSION["kAdi"])){
			?>
			<button class="button" onclick="document.getElementById('id01').style.display='block'"><span class="glyphicon glyphicon-user"></span> Giriş</button>
			<?php
		}else{ ?> 
		 <a href="?doLogout=true" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span> Güvenli Çıkış</a>
		<?php } ?>
		
		</li>   
      </ul>
    </div>
  </div>
</nav>