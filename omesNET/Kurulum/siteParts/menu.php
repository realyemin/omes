 <div class="col-sm-2 sidenav hidden-xs">
      <h2>SİSTEM KURULUM</h2>
      <ul class="nav nav-pills nav-stacked">
     	<li <?php if(isset($_GET['ana'])){ echo 'class="active"'; } ?>><a href="index.php?ana">1)SUNUCU AYARLARI</a></li>        
        <li <?php if(isset($_GET['create'])){ echo 'class="active"'; } ?>><a href="index.php?create=on">2)TABLOLAR</a></li>
        <li <?php if(isset($_GET['insert'])){ echo 'class="active"'; } ?>><a href="index.php?insert=on">3)VERİLER</a></li>    
        <li <?php if(empty($_GET)){ echo 'class="active"'; } ?>>
		<?php if(empty($_SESSION["kAdi"])){
			?>
			<button class="button" onclick="document.getElementById('id01').style.display='block'"><span class="glyphicon glyphicon-user"></span> Giriş</button>
			<?php
		}else{ ?> 
		 <a href="?doLogout=true" class="btn btn-danger"><span class="glyphicon glyphicon-off"></span> Güvenli Çıkış</a>
		<?php } ?>
		
		</li>    
      </ul><br>
    </div>