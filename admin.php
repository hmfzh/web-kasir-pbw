<?php
session_start();
require 'config/koneksi.php';


if (empty($_SESSION['login'])) {
  header('Location: index.php');
} 

if (isset($_COOKIE['user'])) {
  switch($_COOKIE['level']) {
    case 'admin': 
    $_SESSION['login'] = true;
    break;
    case 'kasir': 
    header('Location: kasir.php');
    break;
  }
} else if (isset($_SESSION['level'])) {
  switch($_SESSION['level']) {
    case 'kasir': 
    header('Location: kasir.php');
    break;
  }
} 

$user = "SELECT * FROM users WHERE username NOT LIKE 'admin'";
$result = mysqli_query($koneksi,$user);
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link   rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-dark">
    <a class="navbar-brand text-warning " href="#">Kasir Online</a>

    <form class="form-inline my-2 my-lg-0 ml-auto">
     
      <a class="btn btn-outline-warning"  href="functions/logout.php" role="button">logout</a>
    </form>
  </div>
</nav>

<h1 class="col-12">Halaman Admin</h1>
<div class="col-12">
         <div clas="container ml-auto" style="text-align:right;">
                <a href="registeradmin.php">Create Account Admin</a>
            </div>
</div>

<div class="container">   


  <table class="table table-hover table-ligth">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Username</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($result as $data) : ?>
        <tr>

          <td><?= $no++ ?></td>
          <td><?= $data['nama'] ?></td>
          <td><?= $data['email'] ?></td>
          <td><?= $data['username'] ?></td>
          <td><?= $data['status'] ?></td>
          <td><a class="btn btn-outline-success" href="editUser.php?idUser=<?= $data['id_user'] ?>" role="button">Edit</a>
            <a class="btn btn-outline-danger" href="hapus.php?idUser=<?= $data['id_user'] ?>" role="button">Hapus</a></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <br>


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