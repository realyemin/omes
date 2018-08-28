<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
</head>

<body>
<p id="sprytrigger1">sas
</p><p id="sprytrigger2">de</p>
<div class="tooltipContent" id="sprytooltip1">Araç ipucu içeriği buraya gelecek.1</div>

<div class="tooltipContent" id="sprytooltip2">Araç ipucu içeriği buraya gelecek.2</div>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");
</script>
<script type="text/javascript">
var sprytooltip2 = new Spry.Widget.Tooltip("sprytooltip2", "#sprytrigger2");
</script>
</body>
</html>
