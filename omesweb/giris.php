<?php require_once('Connections/baglantim.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

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
  mysql_select_db($database_baglantim, $baglantim);
  
  $LoginRS__query=sprintf("SELECT KULLANICI_ADI, SIFRE, AD FROM personeller WHERE KULLANICI_ADI=%s AND SIFRE=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $baglantim) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  //sonradan ekledim personel Adını göstermek için 
	$row_oturum=  mysql_fetch_assoc($LoginRS);
  $_SESSION["kAdi"]=$row_oturum["AD"];
  //sonradan ekledim personel Adını göstermek için
  if ($loginFoundUser) {
     $loginStrGroup = "";
   	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

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

<style>
/* Full-width input fields */
.giris {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
.button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
.button_cikis {
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
.button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    border-radius: 50%;
}

.container1 {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index:9999; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>

<div id="id01" class="modal">
<form METHOD="POST" name="giris_formu" class="modal-content animate" action="<?php echo $loginFormAction; ?>">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Kapat">&times;</span>
      <img src="img/avatar.png" alt="Avatar" class="avatar">
    </div>
    <div class="container1">
      <label><b>Kullanıcı Adı</b></label>
      <input type="text" class="giris" placeholder="Kullanıcı Adı" name="uname" required>

      <label><b>Parola</b></label>
      <input type="password" class="giris" placeholder="Parola" name="psw" required>
        
      <button class="button" type="submit">Oturum Aç</button>
      
    </div>

    <div class="container1" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Vazgeç</button>      
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
      <div class="modal-content">
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
}
?>