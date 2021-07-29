<?php 
session_start();
require 'config/koneksi.php';


if (empty($_SESSION['login'])) {
    header('Location: index.php');
    } else if ($_SESSION['level'] == 'kasir') { 
        header('Location: kasir.php');
    }
    $idUser = $_GET['idUser'];
    $queryTampil = "SELECT * FROM users WHERE  id_user = $idUser";
    $result = mysqli_query($koneksi, $queryTampil);
    $data = mysqli_fetch_assoc($result);

    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $status = $_POST['status'];

        $queryUpdate = "UPDATE users SET nama = '$nama', email = '$email', 
        username = '$username', status = '$status' WHERE id_user = $idUser";
        $hasil = mysqli_query($koneksi, $queryUpdate);
        if ($hasil) {
            echo '
            <script>
            alert("Update berhasil!");
            window.location.href="admin.php"
            </script>
            ';
        } else {
            echo '
            <script>
            alert("Update gagal!");
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
        <title>Edit User</title>
        <style>
        tr, td {
            padding: 2px
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-dark">
      <a class="navbar-brand text-warning " href="#">Kasir Online</a>

      
  </nav>

  <form action="" method="POST" class="container">
    <div class="col-md-4">

        <h1 class="my-4">
          <small>Edit Data</small>
      </h1>

      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>">

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>">

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Username</label>
        <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>">

    </div>
    <div>
      <label for="exampleInputStatu">Status</label><br>

      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">

        <option lass="form-control" value="pending" <?php if ($data['status'] == 'pending') echo 'selected' ?>>Pending</option>
        <option class="form-control"  value="accepted" <?php if ($data['status'] == 'accepted') echo 'selected' ?>>Accepted</option>
        
    </select>
</div>
<br>
<button type="submit" class="btn btn-primary" name="update">Update Data</button><br><br>
<p class="container">Kembali <a href="kasir.php">disini</a></p>
</div>
</form>


</body>
<div class="fixed-bottom bg-dark text-white">
    <blockquote class="blockquote text-center">
        <p class="mb-0">
         copyright &copy; 2020 Muhammad Ilham Hafizha | 6706190028
     </p>
 </blockquote>
</div>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>