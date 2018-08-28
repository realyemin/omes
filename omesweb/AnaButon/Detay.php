<?php //require_once('../Connections/baglantim.php'); ?>
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


mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi = "SELECT MAKINE_ADRESI, MAKINE_ADI FROM bilet_makineleri";
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);

mysql_select_db($database_baglantim, $baglantim);
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);

$BM_ADRES = "-1";
$BTNID = "-1";
if (isset($_GET['BM_ADRES']) and isset($_GET['BTNID'])) {
  $BM_ADRES = $_GET['BM_ADRES'];
    $BTNID = $_GET['BTNID'];
}
mysql_select_db($database_baglantim, $baglantim);
$query_Butonlar = sprintf("SELECT * FROM butonlar WHERE BM_ADRES = %s and BTNID = %s", GetSQLValueString($BM_ADRES, "int"),GetSQLValueString($BTNID, "int"));
$Butonlar = mysql_query($query_Butonlar, $baglantim) or die(mysql_error());
$row_Butonlar = mysql_fetch_assoc($Butonlar);
$totalRows_Butonlar = mysql_num_rows($Butonlar);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
</head>

<body>  


<form method="post" name="form1">
<div class="form-group">
  <div class="panel panel-pink">
    <div class="panel panel-heading">Ana Buton Detay Ekranı</div>
   <div class="row">
<div class="col-md-6">
<div class="panel body table-responsive">
 <table class="table table-hover">
              <tr valign="baseline">
                <th nowrap align="right">Bilet Makinesi</th>
                <td>
                <?php
				
				$query_BiletMakinesi =sprintf("SELECT MAKINE_ADI FROM bilet_makineleri WHERE MAKINE_ADRESI = %s",GetSQLValueString($row_Butonlar['BM_ADRES'],"int")); ;
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);

echo $row_BiletMakinesi['MAKINE_ADI'];
?></td>
                <th align="right" nowrap>                  Buton ID</th>
                <td><input type="hidden" name="BTNID" value="<?php echo htmlentities($row_Butonlar['BTNID'], ENT_COMPAT, 'utf-8'); ?>" size="32">
                 <span class="label label-default"> <?php echo htmlentities($row_Butonlar['BTNID'], ENT_COMPAT, 'utf-8'); ?></span></td>
				 </tr>
                <tr valign="baseline">
                  <td nowrap align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="baseline">
                <th nowrap align="right">1.Grup / Oran</th>
                <td> 
                  <?php 
$query_Grup =sprintf("SELECT GRUP_ISMI FROM gruplar WHERE GRPID=%s", GetSQLValueString($row_Butonlar['GRP_ID'],"int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);				  				  
				  
				  echo $row_Grup['GRUP_ISMI']?>
                 
                </td>
                <td><input disabled="disabled" class="form-control" type="number" min="0" max="100" name="GRP1_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP1_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
                <td>&nbsp;</td>		
				</tr>
                <tr valign="baseline">
                  <th nowrap align="right">2.Grup / Oran</th>
                  <td><?php 
$query_Grup =sprintf("SELECT GRUP_ISMI FROM gruplar WHERE GRPID=%s", GetSQLValueString($row_Butonlar['GRP_ID2'],"int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);				  				  
				  
				  echo $row_Grup['GRUP_ISMI']?></td>
                  <td><input disabled="disabled" class="form-control" type="number" min="0" max="100"  name="GRP2_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP2_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
                  <td>&nbsp;</td>
				</tr>
                <tr valign="baseline">
                  <th nowrap align="right">3.Grup / Oran</th>
                  <td><?php 
$query_Grup =sprintf("SELECT GRUP_ISMI FROM gruplar WHERE GRPID=%s", GetSQLValueString($row_Butonlar['GRP_ID3'],"int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);				  				  
				  
				  echo $row_Grup['GRUP_ISMI']?></td>
                  <td><input disabled="disabled" class="form-control" type="number" min="0" max="100" name="GRP3_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP3_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
                  <td>&nbsp;</td>
				  </tr>
                <tr valign="baseline">
                  <th nowrap align="right">4.Grup / Oran</th>
                  <td><?php 
$query_Grup =sprintf("SELECT GRUP_ISMI FROM gruplar WHERE GRPID=%s", GetSQLValueString($row_Butonlar['GRP_ID4'],"int"));
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);				  				  
				  
				  echo $row_Grup['GRUP_ISMI']?></td>
                  <td><input disabled="disabled" class="form-control" type="number" min="0" max="100" name="GRP4_ORAN" value="<?php echo htmlentities($row_Butonlar['GRP4_ORAN'], ENT_COMPAT, 'utf-8'); ?>" size="5"></td>
                  <td>&nbsp;</td>
				  </tr>
                <tr valign="baseline">
                  <th nowrap align="right" valign="top">Açıklama:</th>
                  <td colspan="3"><textarea name="ACIKLAMA" cols="50" rows="5" readonly class="form-control"><?php echo htmlentities($row_Butonlar['ACIKLAMA'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
                </tr>
              <tr valign="baseline">
                <th nowrap align="right">Bilet kopya Sayısı:</th>
                <td><input readonly type="number" min="1" max="10" class="form-control" name="BILET_KOPYA" value="<?php echo htmlentities($row_Butonlar['BILET_KOPYA'], ENT_COMPAT, 'utf-8'); ?>"></td>
                <th align="right" nowrap>YUKSEKLIK:</th>
                <td><input readonly type="number" min="10" max="1000" class="form-control" name="YUKSEKLIK" value="<?php echo htmlentities($row_Butonlar['YUKSEKLIK'], ENT_COMPAT, 'utf-8'); ?>" ></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Maksimum Bilet:</th>
                <td><input readonly type="number" min="1" max="9999" class="form-control" name="MAKS_BILET" value="<?php echo htmlentities($row_Butonlar['MAKS_BILET'], ENT_COMPAT, 'utf-8'); ?>" ></td>
                <th align="right" nowrap>GENISLIK:</th>
                <td><input readonly type="number" min="10" max="1000" class="form-control" name="GENISLIK" value="<?php echo htmlentities($row_Butonlar['GENISLIK'], ENT_COMPAT, 'utf-8'); ?>" ></td>
              </tr>
              <tr valign="baseline">
                <th align="right" nowrap>Soldan Konum:</th>
                <td><input readonly type="number" min="5" max="1000" class="form-control" name="I_YF1" value="<?php echo htmlentities($row_Butonlar['I_YF1'], ENT_COMPAT, 'utf-8'); ?>" ></td>
                <th align="right" nowrap>Yukarıdan Konum</th>
                <td><input readonly type="number" min="5" max="2000" class="form-control" name="I_YF2" value="<?php echo htmlentities($row_Butonlar['I_YF2'], ENT_COMPAT, 'utf-8'); ?>"></td>
              </tr>
              <tr valign="baseline">
                <th align="right" nowrap>AKTIF:</th>
                <td><label class="switch"><input disabled type="checkbox" name="AKTIF" value=""  <?php if (!(strcmp(htmlentities($row_Butonlar['AKTIF'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>><span class="slider round"></span></label></td>
                <th align="right" nowrap>Randevu Butonu var mı?:</th>
                <td><label class="switch">
                  <input disabled type="checkbox" name="RandevuButonuMu" value=""  <?php if (!(strcmp(htmlentities($row_Butonlar['RandevuButonuMu'], ENT_COMPAT, 'utf-8'),"1"))) {echo "checked=\"checked\"";} ?>>
               <span class="slider round"></span></label></td>
              </tr>
              <tr valign="baseline">
                <td align="right" nowrap>&nbsp;</td>
                <td colspan="3">
								<?php 
	  $img=base64_encode($row_Butonlar['RESIM']);	
	 
	    	    ?>
                  <img class="img-responsive" src="data:image/jpg;charset=utf8;base64,<?php echo $img ?>"/></td>
                </tr>
</table>
</div>
</div>
<div class="col-md-6">
<div class="panel body table-responsive">
<table id="tableID" class="table table-hover">
              <tr valign="baseline">
                <th nowrap align="right">Buton Ekran Metni:</th>
                <td><textarea readonly class="form-control" name="BTN_EKRAN" cols="50" rows="5"><?php echo htmlentities($row_Butonlar['BTN_EKRAN'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
				</tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 1:</th>
                <td><input readonly class="form-control" type="text" name="BTN_BILET_S1" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 2:</th>
                <td><input readonly class="form-control" type="text" name="BTN_BILET_S2" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 3:</th>
                <td><input readonly class="form-control" type="text" name="BTN_BILET_S3" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Çıktı Metni 4:</th>
                <td><input readonly class="form-control" type="text" name="BTN_BILET_S4" value="<?php echo htmlentities($row_Butonlar['BTN_BILET_S4'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Buton Rengi:</th>
                <td>
                  <input disabled class="jscolor form-control"  type="text" name="RENK" value="<?php echo substr(dechex($row_Butonlar['RENK']),2,6); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Yazı Rengi::</th>
                <td><input disabled class="jscolor form-control" type="text" name="YAZI_RENGI" value="<?php echo dechex($row_Butonlar['YAZI_RENGI']); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Yazı Tipi(Font)</th>
                <td><select disabled class="form-control" name="FONT">
                  <option value="Arial" <?php if (!(strcmp("Arial", htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Arial</option>
                  <option value="Verdana" <?php if (!(strcmp("Verdana", htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Verdana</option>
                  <option value="Tahoma" <?php if (!(strcmp("Tahoma", htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Tahoma</option>
                  <option value="Times New Roman" <?php if (!(strcmp("Times New Roman", htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Times New Roman</option>
                  <option value="Comic Sans Serif" <?php if (!(strcmp("Comic Sans Serif", htmlentities($row_Butonlar['FONT'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Comic Sans Serif</option>
                </select></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Yazı Boyutu(Punto)</th>
                <td><input readonly class="form-control" type="number" name="PUNTO" min="10" max="120" value="<?php echo htmlentities($row_Butonlar['PUNTO'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
              </tr>
              <tr valign="baseline">
                <th nowrap align="right">Resim Eklensin mi?</th>
                <td><label class="switch">
                  <input class="form-control" type="checkbox" id="checkboxID">
                  <span class="slider round"></span></label></td>
              </tr>
              <tr class="rowClass" valign="baseline">
                <th nowrap align="right">Resim Seçin:</th>
                <td><input type="file" name="RESIM"></td>
              </tr>
              <tr class="rowClass" valign="baseline">
                <th nowrap align="right">Resim Hizalama Yönü</th>
                <td valign="baseline"><table class="table table-bordered table-hover">
                  <tr>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="1" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="2" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),2))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="4" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),4))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                    </tr>
                    <tr>
                      <td>Üst Sol</td>
                      <td>Üst Orta</td>
                      <td>Üst Sağ</td>
                    </tr>
                    <tr>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="16" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),16))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="32" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),32))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="64" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),64))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                    </tr>
                    <tr>
                      <td>Orta Sol</td>
                      <td>Tam Orta</td>
                      <td>Orta Sağ</td>
                    </tr>
                    <tr>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="256" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),256))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input disabled  type="radio" name="RESIM_YON" value="512" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),512))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                      <td><label class="switch">
                        <input disabled type="radio" name="RESIM_YON" value="1024" <?php if (!(strcmp(htmlentities($row_Butonlar['RESIM_YON'], ENT_COMPAT, 'utf-8'),1024))) {echo "checked=\"checked\"";} ?>>
                        <span class="slider round"></span></label></td>
                    </tr>
                    <tr>
                      <td>Alt Sol</td>
                      <td>Alt Orta</td>
                      <td>Alt Sağ</td>
                    </tr>
                </table></td>
              </tr>
              <tr valign="baseline">
                <td nowrap align="right"><input type="hidden" name="RESIM_AD" value="<?php echo htmlentities($row_Butonlar['RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32">
                  <input type="hidden" name="ESKI_RESIM_AD" value="<?php echo htmlentities($row_Butonlar['ESKI_RESIM_AD'], ENT_COMPAT, 'utf-8'); ?>" size="32">
                  <input type="hidden" name="ANA_BTNID" value="<?php echo htmlentities($row_Butonlar['ANA_BTNID'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="S_YF1" value="<?php echo htmlentities($row_Butonlar['S_YF1'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="S_YF2" value="<?php echo htmlentities($row_Butonlar['S_YF2'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="S_YF3" value="<?php echo htmlentities($row_Butonlar['S_YF3'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="I_YF3" value="<?php echo htmlentities($row_Butonlar['I_YF3'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="B_YF" value="<?php echo htmlentities($row_Butonlar['B_YF'], ENT_COMPAT, 'utf-8'); ?>">
                  <input type="hidden" name="MM_update" value="form1">
                  <input type="hidden" name="BM_ADRES_TEMP" value="<?php echo $row_Butonlar['BM_ADRES']; ?>"></td>
                <td><a class="btn btn-success" href="?AnaButonGuncelle&BTNID=<?php echo $_GET['BTNID']; ?>&BM_ADRES=<?php echo $_GET['BM_ADRES']; ?>">Kaydı Güncelleştir</a> <a class="btn btn-danger" onclick="return confirm('Silmek istediğinizden emin misiniz');" href="?AnaButonSil&BTNID=<?php echo $_GET['BTNID']; ?>&BM_ADRES=<?php echo $_GET['BM_ADRES']; ?>">Kaydı Sil</a>
                  <input type="hidden" name="BTNID_TEMP" value="<?php echo $row_Butonlar['BTNID']; ?>"></td>
              </tr>
</table>
</div>
</div>    
	</div>  
   </div>
   </div>                       
</form>
</body>
</html>
<?php
mysql_free_result($BiletMakinesi);

mysql_free_result($Grup);

mysql_free_result($Butonlar);
?>
<script>	
//<![CDATA[
$(window).load(function(){
$("#checkboxID").change(function(){
    var self = this;
    $("#tableID tr.rowClass").toggle(self.checked); 
}).change();
});//]]> 
      </script>
<!--toggle checkedbox ile tablo gizlemek ve açmak için-->