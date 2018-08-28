<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Başlıksız Belge</title>
<script src="jscolor.js"></script>
</head>

<body>
<input type="text" class="jscolor" name="renk">
<?php
echo hexdec("ff54edaf")."-".dechex(hexdec("ff54edaf"));
echo "<br>";
echo dechex(-47361);
echo "<br>";
echo base_convert('-11211345', 32, 16);
echo base_convert('ff54edaf', 16, 10);
echo "<br>";
echo dechex(4283755951);
echo "<br>";
echo dechex(2147483647);
echo "<hr>";
//echo PHP_INT_MAX*2+1;
echo "<hr>";
echo signedint32(4283755951);
?>
<?php 
function signedint32($value) {
    $i = (int)$value;
    if (PHP_INT_SIZE > 4)   // e.g. php 64bit
        if($i & 0x80000000) // is negative
            return $i - 0x100000000;
    return $i;
} 
?>
</body>
</html>