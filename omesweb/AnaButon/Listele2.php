<?php require_once('../Connections/baglantim.php'); ?>
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

$maxRows_Butonlar = 10;
$pageNum_Butonlar = 0;
if (isset($_GET['pageNum_Butonlar'])) {
  $pageNum_Butonlar = $_GET['pageNum_Butonlar'];
}
$startRow_Butonlar = $pageNum_Butonlar * $maxRows_Butonlar;

mysql_select_db($database_baglantim, $baglantim);
$query_Butonlar = "SELECT * FROM butonlar Where ANA_BTNID=0 ORDER BY BM_ADRES DESC";
$query_limit_Butonlar = sprintf("%s LIMIT %d, %d", $query_Butonlar, $startRow_Butonlar, $maxRows_Butonlar);
$Butonlar = mysql_query($query_limit_Butonlar, $baglantim) or die(mysql_error());
$row_Butonlar = mysql_fetch_assoc($Butonlar);

if (isset($_GET['totalRows_Butonlar'])) {
  $totalRows_Butonlar = $_GET['totalRows_Butonlar'];
} else {
  $all_Butonlar = mysql_query($query_Butonlar);
  $totalRows_Butonlar = mysql_num_rows($all_Butonlar);
}
$totalPages_Butonlar = ceil($totalRows_Butonlar/$maxRows_Butonlar)-1;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script>
        $(function () {
            var $chk = $("#grpChkBox input:checkbox");
            var $tbl = $("#AnaButon");

            $chk.prop('checked', true);

            $chk.click(function () {
                var colToHide = $tbl.find("." + $(this).attr("name"));
                $(colToHide).toggle();
            });
        });
    </script>

</head>

<body>
<div class="form-group">
  <div class="panel panel-blue">
  <div class="panel panel-heading">Ana Buton Listesi</div><div class="panel body">
  <div id="grpChkBox">
        <span><input type="checkbox" name="BM_ADRES" /> Bilet Makinesi ID</span>
        <span><input type="checkbox" name="BTNID" />
       Buton ID</span>
         <span>
         <input type="checkbox" name="GRP1_ORAN" />
         1.Grup/Oran</span>         
           <span><input type="checkbox" name="GRP2_ORAN" />
          2.Grup/Oran</span>
           <span><input type="checkbox" name="GRP3_ORAN" />
           3.Grup/Oran</span>
           <span><input type="checkbox" name="GRP4_ORAN" />
           4.Grup/Oran</span>
           <span><input type="checkbox" name="ANA_BTNID" />
          ANA Buton?</span>
           <span><input type="checkbox" name="BTN_EKRAN" />
           Buton Ekran Metni</span>
            
    </div>

<table id="AnaButon" class="table table-hover">
  <tr class="alert alert-info">
    <th class="BM_ADRES">Bilet Makinesi</th>
    <th class="BTNID">Buton ID</th>
    <th class="GRP1_ORAN">1.Grup/Oran</th>
    <th class="GRP2_ORAN">2.Grup/Oran</th>
    <th class="GRP3_ORAN">3.Grup/Oran</th>
    <th class="GRP4_ORAN">4.Grup/Oran</th>
    <th class="ANA_BTNID">ANA Buton?</th>
    <th>AKTIF</th>
    <th>Randevu Butonu Mu?</th>
    <th>Detay</th>
    <th>Güncelle</th>
    <th>Sil</th>
    </tr>
  <?php do { ?>
    <tr>
      <td class="BM_ADRES"><?php mysql_select_db($database_baglantim, $baglantim);
$query_BiletMakinesi = "SELECT MAKINE_ADRESI, MAKINE_ADI FROM bilet_makineleri WHERE MAKINE_ADRESI = $row_Butonlar[BM_ADRES]";
$BiletMakinesi = mysql_query($query_BiletMakinesi, $baglantim) or die(mysql_error());
$row_BiletMakinesi = mysql_fetch_assoc($BiletMakinesi);
$totalRows_BiletMakinesi = mysql_num_rows($BiletMakinesi);

	echo "#".$row_Butonlar['BM_ADRES']."-".$row_BiletMakinesi['MAKINE_ADI'];

 ?></td>
      <td class="BTNID"><?php echo $row_Butonlar['BTNID']; ?></td>
      <td class="GRP1_ORAN">
        <?php mysql_select_db($database_baglantim, $baglantim);
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID = $row_Butonlar[GRP_ID]";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);


echo "#".$row_Butonlar['GRP_ID']."-".$row_Grup['GRUP_ISMI'];
?>     
        /<span class="badge badge-info"> <?php echo $row_Butonlar['GRP1_ORAN']; ?></span></td>
      <td class="GRP2_ORAN">
        <?php mysql_select_db($database_baglantim, $baglantim);
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID = $row_Butonlar[GRP_ID2]";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);


echo "#".$row_Butonlar['GRP_ID2']."-".$row_Grup['GRUP_ISMI']; 
?>
      /<span class="badge badge-warning"> <?php echo $row_Butonlar['GRP2_ORAN']; ?></span></td>
      <td class="GRP3_ORAN"><?php mysql_select_db($database_baglantim, $baglantim);
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID = $row_Butonlar[GRP_ID3]";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);


echo "#".$row_Butonlar['GRP_ID3']."-".$row_Grup['GRUP_ISMI']; 
?>
        / <span class="badge badge-success"><?php echo $row_Butonlar['GRP3_ORAN']; ?></span></td>
      <td class="GRP4_ORAN"><?php mysql_select_db($database_baglantim, $baglantim);
$query_Grup = "SELECT GRPID, GRUP_ISMI FROM gruplar WHERE GRPID = $row_Butonlar[GRP_ID4]";
$Grup = mysql_query($query_Grup, $baglantim) or die(mysql_error());
$row_Grup = mysql_fetch_assoc($Grup);
$totalRows_Grup = mysql_num_rows($Grup);

echo "#".$row_Butonlar['GRP_ID4']."-".$row_Grup['GRUP_ISMI']; 
?> /<span class="badge badge-danger"> <?php echo $row_Butonlar['GRP4_ORAN']; ?></span></td>
      <td class="ANA_BTNID"><?php if($row_Butonlar['ANA_BTNID']==0){echo "Evet";}else{ echo "Alt Btn:".$row_Butonlar['ANA_BTNID'];}  ?></td>
      <td><?php if($row_Butonlar['AKTIF']==1){echo "Evet";} else{ echo "Hayır";} ?></td>
      <td><?php if($row_Butonlar['RandevuButonuMu']==0){echo "Hayır";} else{ echo "Evet";} ?></td>
      <td><a href="?AnaButonDetay&BtnID=<?php echo $row_Butonlar["BTNID"];?>&BM_ADRES=<?php echo $row_Butonlar["BM_ADRES"]; ?>" class="btn btn-success">Detay</a></td>
      <td><a href="?AnaButonGuncelle&BtnID=<?php echo $row_Butonlar["BTNID"];?>&BM_ADRES=<?php echo $row_Butonlar["BM_ADRES"]; ?>" class="btn btn-info">Güncelle</a></td>
      <td><a href="?AnaButonSil&BtnID=<?php echo $row_Butonlar["BTNID"];?>&BM_ADRES=<?php echo $row_Butonlar["BM_ADRES"]; ?>" onClick="return confirm('Silmek İstediğinizden Emin misiniz?');" class="btn btn-danger">Sil</a></td>
      </tr>
    <?php } while ($row_Butonlar = mysql_fetch_assoc($Butonlar)); ?>
</table>
  </div></div></div>
</body>
</html>
<?php
mysql_free_result($Grup);
mysql_free_result($BiletMakinesi);
mysql_free_result($Butonlar);
?>
