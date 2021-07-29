<?php
$srvr="localhost";
$usr="root";
$pwd="";
$db="tubes";

$con = mysqli_connect($srvr,$usr,$pwd);
mysqli_select_db($con,$db);

if (mysqli_connect_error() == true) {
        die('Gagal terhubung ke database');
    } 
?>


