<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();

}
if(!isset($_SESSION['kAdi']))//kullanıcı yoksa giris'i yukle
{
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['uname']) and isset($_POST['psw'])) {
  $loginUsername=$_POST['uname'];
  $password=$_POST['psw'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "?login=on";
  $MM_redirectLoginFailed = "?login=off";
  $MM_redirecttoReferrer = false;
  
 
//sadece B_YF=1 olan yani yöneticiler oturum açabilir. 
	
	if (!strcmp($loginUsername,"omes") &&  !strcmp($password,"omes1202")){
				
		$_SESSION['kAdi'] = $loginUsername ;
					
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
 
<div id="id01" class="modal">
<form METHOD="POST" name="giris_formu" style="background:white; max-width:600px;cursor:auto" class="modal-content animate" action="<?php echo $loginFormAction; ?>">
    <div class="imgcontainer" >
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Kapat">&times;</span>
      <img src="../img/avatar.png" alt="Avatar" class="avatar">
    </div>
    <div class="container1">
      <label><b>Kullanıcı Adı</b></label>
      <input type="text" class="giris" placeholder="Kullanıcı Adı" name="uname" required>

      <label><b>Parola</b></label>
      <input type="password" class="giris" placeholder="Parola" name="psw" required>
        
      <button class="button" type="submit">Oturum Aç</button>
      
    

    <div class="container1" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-danger">Vazgeç</button></div>      
      <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
      </script>

    </div>
  </form>
  </div>

<?php
if(isset($_GET['login']) and $_GET['login']=="on")
{
?>
<script>
$(document).ready(function(){
$('#my-modal').modal('show');
});
</script>

<div id="my-modal" class="modal fade" role="dialog" >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hoşgeldiniz!</h4>
        </div>
        <div class="modal-body">
          <p>Merhaba. Sisteme başarılı bir şekilde giriş yaptınız.</p>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-success" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>

<?php	
}else if(isset($_GET['login']) and $_GET['login']=="off")
{
?>

<script>
$(document).ready(function(){
$('#my-modal').modal('show');
});
</script>

<div id="my-modal" class="modal fade" data-show role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="max-width:600px;cursor:auto">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hatalı Giriş</h4>
        </div>
        <div class="modal-body">
          <p>Girdiğiniz bilgiler hatalı veya eksiktir. Lütfen Kontrol Ederek Tekrar deneyiniz.</p>
        </div>
        <div class="modal-footer">
         <button type="button" onClick="document.getElementById('id01').style.display='block'"" class="btn btn-success" data-dismiss="modal">Tekrar Dene</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        </div>
      </div>
    </div>
</div>
<?php
} }
?>