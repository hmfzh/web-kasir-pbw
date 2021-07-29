<?php
session_start();
require 'config/koneksi.php';

   
if (isset($_COOKIE['user'])) {
    switch ($_COOKIE['level']) {
        case 'admin' : 
        header('Location: admin.php');
        break;
        case 'kasir' : 
        header('Location: kasir.php');
        break;
    }
}


if (isset($_SESSION['login'])) {
    switch ($_SESSION['level']) {
        case 'admin' : 
        header('Location: admin.php');
        break;
        case 'kasir' : 
        header('Location: kasir.php');
        break;
    }
} 


if (isset($_POST['register'])) {
    
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password-confirm'];

    $queryCek = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $cekUser = mysqli_query($koneksi, $queryCek);

  
    if (mysqli_num_rows($cekUser) > 0) {
        echo '
        <script>
        alert("Username / email telah dipakai!");
        window.location.href="register.php"
        </script>
        ';
        return false;
    }

     
    if ($password != $passwordConfirm) {
        echo '
        <script>
        alert("Password konfirmasi tidak sesuai");
        window.location.href="register.php"
        </script>
        ';
        return false;
    }


    $password = password_hash($password, PASSWORD_DEFAULT);


    $queryRegister = "INSERT INTO users VALUES ('', '$nama', '$email', '$username', '$password', 'pending', 'kasir')";
    $result = mysqli_query($koneksi, $queryRegister);

    if ($result) {
        echo '
        <script>
        alert("Registrasi berhasil!");
        window.location.href="index.php"
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Registrasi gagal!");
        window.location.href="register.php"
        </script>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/kasir.PNG">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registrasi</title>
</head>
<body>
 <nav class="navbar navbar-expand-lg bg-dark">
  <a class="navbar-brand text-warning " href="#">Kasir Online</a></nav>
  
  <form action="" method="POST" class="container">
     <div class="col-md-4">

        <h1 class="my-4">
           <small>Registrasi kasir online</small>
       </h1>

       <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="nama" class="form-control" required>

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" name="email" class="form-control" required>

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="password" class="form-control" required>

    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">Password Konfirmasi</label>
        <input type="password" name="password-confirm" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary" name="register">Register</button>
    
</div>
<br>
</table>
</form>
<p class="container">Sudah punya akun? login <a href="index.php">disini</a></p>
<div class="fixed-bottom bg-dark text-white">
    <blockquote class="blockquote text-center">
        <p class="mb-0">
              copyright &copy; 2020 Muhammad Ilham Hafizha | 6706190028
        </p>
    </blockquote>
</div>
</body>
</html>



