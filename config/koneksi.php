<?php 
$srvr="localhost";
$db="tubes"; 
$usr="root";
$pwd="";

$koneksi = mysqli_connect($srvr, $usr ,$pwd, $db);

if (mysqli_connect_error() == true) {
	die('Gagal terhubung ke database');
} 
?>