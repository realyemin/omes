<?php 

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="?AnaTabloEkle&hata=aid";
	 $ATID = $_POST['ATID'];
	 $TABLO_ADI = $_POST['TABLO_ADI'];
  $loginFoundUser = $db->query("SELECT COUNT(*) AS TOPLAMBTN FROM ANATABLOLAR WHERE ATID='$ATID' AND TABLO_ADI='$TABLO_ADI'")->fetch();

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser['TOPLAMBTN']>0){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."ATID=".$ATID."&TABLO_ADI=".$TABLO_ADI;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$insertSQL = $db->prepare("INSERT INTO ANATABLOLAR (ATID, TABLO_ADI, TABLO_TURU) VALUES (:ATID, :TABLO_ADI, :TABLO_TURU)");
                       $insertSQL->bindParam(':ATID',$_POST['ATID'], PDO::PARAM_INT);
                       $insertSQL->bindParam(':TABLO_ADI',$_POST['TABLO_ADI'], PDO::PARAM_STR);
                       $insertSQL->bindParam(':TABLO_TURU',$_POST['TABLO_TURU'], PDO::PARAM_INT);
                       $insertSQL->execute();

  $insertGoTo = "?AnaTabloEkle=ok&";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>


<!-- Jquery ile fadein fadeout için -->
<?php if(isset($_GET["hata"]) and $_GET["hata"]=="aid" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#hata").click(function(){
        $("#hata").fadeOut();       
    });
});
</script><!-- Jquery ile fadein fadeout için -->
    <div id="hata" class="alert alert-danger">Seçtiğiniz Ana Tablo için kayıtlı bir ID <span class="btn btn-red">(<?php echo $_GET['ATID']; ?>)</span> ve isim <span class="btn btn-red">(<?php echo $_GET['TABLO_ADI']; ?>)</span>mevcuttur. Lütfen Başka Bir Buton ID'si seçiniz. </div>
<?php
}
?><?php if(isset($_GET["AnaTabloEkle"]) and $_GET["AnaTabloEkle"]=="ok" )
{
	?>	<script><!-- Jquery ile fadein fadeout için -->
$(document).ready(function(){
    $("#eklendi").fadeOut(6000);
});<!-- Jquery ile fadein fadeout için -->
</script>
    <div id="eklendi" class="btn btn-success">Ana Tablo Eklendi. Görüntülemek için <a class="btn btn-red" href="?AnaTabloListele">Tıklayabilirisiniz.</a> Veya başka Bir Makine Ekleyebilirsiniz. </div>
<?php
}
?>
<div class="form-group">
  <div class="panel panel-grey">
  <div class="panel panel-heading">AnaTablo Ekle</div>
  <div class="panel body table-responsive">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table class="table table-hover">
    <tr valign="baseline">
      <td nowrap align="right">Ana Tablo Adresi:</td>
      <td><span id="sprytextfield1">
      <input class="form-control" type="number" min="1" name="ATID" value="1" placeholder="Sayısal bir değer girin" required size="32">
      <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span><span class="textfieldInvalidFormatMsg">Geçersiz format. Sadece sayısal değer girin!</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TABLO ADI:</td>
      <td><span id="sprytextfield2">
        <input name="TABLO_ADI" type="text" class="form-control" value="" size="32" required maxlength="20">
        <span class="textfieldRequiredMsg">Bir değer gerekiyor.</span></span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TABLO TURU:</td>
      <td><select class="form-control" name="TABLO_TURU">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>LCD Tablo</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>LED Tablo</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap><input class="btn btn-success form-control" type="submit" value="Kayıt Ekle"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
</div></div></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {useCharacterMasking:true, validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>