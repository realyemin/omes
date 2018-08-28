<?php 
include("db.php");
include("ayar/config/config1.php");
?>
<div style="float:left; margin-left:15px;">
<span class="sutunlar">
<?php echo $Sutun1; ?>
</span>
</div>
<div style="float:right;">
<span class="sutunlar">
<?php echo $Sutun2; ?>
</span>
</div>

<table class='table table-bordered table-responsive table-condensed' style="text-align: center; font-size:50pt">
<tr>
	<td class="text-info"><?php echo $biletNo=10; ?></td>
	<td class="text-danger"><span class="glyphicon glyphicon-arrow-up"></span></td>
	<td class="text-success"><?php echo $vezneNo=2; ?></td>
</tr>
<tr>
	<td class="text-info"><?php echo $biletNo=10; ?></td>
	<td class="text-danger"><span class="glyphicon glyphicon-arrow-down"></span></td>
	<td class="text-success"><?php echo $vezneNo=2; ?></td>
</tr>
<tr>
	<td class="text-info"><?php echo $biletNo=10; ?></td>
	<td class="text-danger"><span class="glyphicon glyphicon-circle-arrow-right"></span></td>
	<td class="text-success"><?php echo $vezneNo=2; ?></td>
</tr>
<tr>
	<td class="text-info"><?php echo $biletNo=10; ?></td>
	<td class="text-danger"><span class="glyphicon glyphicon-arrow-right"></span></td>
	<td class="text-success"><?php echo $vezneNo=2; ?></td>
</tr>

</table>