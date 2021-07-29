<?php
session_start();
if (empty($_SESSION['login'])) {
  header('Location: index.php');
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Kasir</title>
  <link rel="shortcut icon" href="img/kasir.PNG">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <script src="asset/js/jquery-1.11.3.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-dark">
    <a class="navbar-brand text-warning " href="#">Kasir Online</a>
  </div>
</nav>

<div class="row no-gutters">
  <div class="col-2 bg-dark pt-4">
    <ul class="nav flex-column ml-3 mb-5">
      <li class="nav-item">
        <a class="nav-link active text-white" href="kasir.php"> 
         <i class="fa fa-tachometer"></i>
       Dashboard</a><hr class="bg-secondary">    
     </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="#"><i class="fa fa-user "></i> Halaman Kasir</a>
      <li class="dropdown">
        <a href="#" class="container dropdown-toggle text-white" data-toggle="dropdown">1. Barang <span class="caret"></span></a>  
        <ul class="dropdown-menu" role="menu">
          <li><a href="?page=barang">Barang</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class=" container dropdown-toggle text-white" data-toggle="dropdown"> 2. Transaksi<span class="caret"></span></a><hr class="bg-secondary"> 
        <ul class="dropdown-menu" role="menu">
          <li><a href="?page=penjualan">Penjualan</a></li>
        </ul>
      </li>
      <li>
      </li>
    </div>

    <div class="col-md-10 p-5 pt-2"><br><br><br><br><br><br><br>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <?php
            include "config/koneksi_p.php";
            if (!isset($_GET['page'])) {
              include 'home.php';
            } else {
              switch ($_GET['page']) {
                case 'home':
                include 'home.php';
                break;
                case 'barang':
                include 'barang.php';
                break;
                case 'penjualan':
                include 'transaksi.php';
                break;
                default:          
                echo "<label>404 Halaman tidak ditemukan</label>";
                break;          
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="fixed-bottom bg-dark text-white">
      <blockquote class="blockquote text-center">
        <p class="mb-0">
         copyright &copy; 2020 Muhammad Ilham Hafizha | 6706190028
       </p>
     </blockquote>
   </div>
 </body>

 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </html>