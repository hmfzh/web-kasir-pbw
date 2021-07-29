<?php 
session_start();
require 'config/koneksi.php';

if (empty($_SESSION['login'])) {
    header('Location: index.php');
} 

if (isset($_COOKIE['user'])) {
    switch($_COOKIE['level']) {
        case 'admin': 
        header('Location: admin.php');
        break;
        case 'kasir': 
        $_SESSION['login'] = true;
        $username = $_COOKIE['user'];
        break;
    }
} else if (isset($_SESSION['level'])) {
    switch($_SESSION['level']) {
        case 'admin': 
        header('Location: admin.php');
        break;
        case 'kasir': 
        $username = $_SESSION['user'];
        break;
    }
} 


$cek = "SELECT * FROM users WHERE username = '$username'";

$data = mysqli_query($koneksi, $cek);

$data = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kasir</title>
            <link rel="shortcut icon" href="img/kasir.PNG">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
.nav-link:hover{
    background-color: grey;
}
</style>
<body>
 <nav class="navbar navbar-expand-lg bg-dark">
  <a class="navbar-brand text-warning " href="#">Kasir Online</a>

</div>
</nav>

<div class="row no-gutters mr-5" style="height: 100px;">
    <div class="col-md-2 bg-dark pr-3 pt-4 pb-12">
        <ul class="nav flex-column ml-3 mb-5">
          <li class="nav-item">
            <a class="nav-link active text-white" href="#"> 
             <i class="fa fa-tachometer"></i>
         Dashboard</a><hr class="bg-secondary">    
     </li>
     
     <li class="nav-item">
        <a class="nav-link text-white" href="functions/logout.php"><i class="fa fa-sign-out "></i> Logout</a><hr class="bg-secondary">   
    </li>

    
</div>
<div class="col-md-10 p-5 pt-2">
 <h1> <i class="fa fa-tachometer "></i> Dashboard</h1><hr>
 <h2>Selamat  <?= $data['nama'] ?>!</h2>
 <?php if($data['status'] == 'pending') : ?>
    <h2>Status anda saat ini masih pending. Tunggu admin menyetujui kamu dulu yah!</h2> 

</div>
</div>  



<?php elseif($data['status'] == 'accepted') : ?>
    <p>Pendaftaran akun anda sudah di terima!</p>
    <h1>Selamat datang <?= $data['nama'] ?>!</h1> 
    <h5 class="container">Alasan Pembuatan Aplikasi</h5><br>
    <p  class="container "> 1. Memudahkan User yang awam</p><br>
    <p  class="container"> 2. Pengguna dapat memakai sesusai kebutuhan Kasir   </p><br>
    <p  class="container"> 3. Tidak membutuhkan alat yang begitu besar</p><br>
    <p  class="container"> 4. Dapat diakases dengan mudah</p><br>
    <p  class="container"> 5. Pengguna bisa menggunakan aplikasi dengan syarat terkoneksi internet</p><br>
    <p  class="container"> 6. Digunakan secara free </p><br>
    <p  class="container"> 7. Selamat mencoba :) </p><br>
    <p  class="container"> 8. Terimakasih :) </p><br>
    <h5 > Author Muhammad lham Hafizha</h5><br>
    <hr class="bg-secondary">  
    
    <a class="nav-link text-dark" href="halaman_kasir.php"><i class="fa fa-user "></i> Halaman Kasir</a><hr class="bg-secondary">   
    

<?php endif ?> 



<div class="fixed-bottom bg-dark text-white">
    <blockquote class="blockquote text-center">
        <p class="mb-0">
           copyright &copy; 2020 Muhammad Ilham Hafizha | 6706190028
       </p>
   </blockquote>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>