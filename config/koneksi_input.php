<?php
$srvr="localhost";
$usr="root";
$pwd="";
$db="tubes"; 

$con = mysqli_connect($srvr,$usr,$pwd);
mysqli_select_db($con,$db);
?>