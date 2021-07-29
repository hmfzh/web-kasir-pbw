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

if (isset($_POST['login'])) {
 
    $userEmail = $_POST['email'];
    $password = $_POST['password'];
       
    $cek = "SELECT * FROM users WHERE username = '$userEmail' OR email = '$userEmail'";
    $user = mysqli_query($koneksi, $cek);
    
 
    if (mysqli_num_rows($user) > 0) {
       
        $data = mysqli_fetch_assoc($user);

         
        if (password_verify($password, $data['password'])) {
         
            if ($data['level'] == 'admin') {
                  
                $_SESSION['user'] = $data['username'];
                $_SESSION['login'] = true;
                $_SESSION['level'] = 'admin';
                header('Location: admin.php');
            } else if ($data['level'] == 'kasir') {
                $_SESSION['user'] = $data['username'];
                $_SESSION['login'] = true;
                $_SESSION['level'] = 'kasir';
                header('Location: kasir.php');
            }

               
            if (isset($_POST['rememberme'])) {
                setcookie('user', $data['username'], time() + 3600, '/');
                setcookie('level', $data['level'], time() + 3600, '/');
            }
            } else { 
                echo '
                <script>
                alert("Username/password salah!");
                window.location.href="index.php"
                </script>
                ';
                return false;
            }
        } else { 
            echo '
            <script>
            alert("Username/password salah!");
            window.location.href="index.php"
            </script>
            ';
            return false;
        }
    }
    ?>

    <html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/themify-icons.css">
        <link rel="shortcut icon" href="img/kasir.PNG">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body class="bg-white">

   
        <nav class="navbar navbar-light bg-dark">
          <a class="navbar-brand text-warning" href="#">Kasir Online</a>
      </nav>

      <center><table>
       <tr>
        <td class="img"><img src="img/hm-6.png" alt=""></td>
        <td><h2>easy to share</h2></td>
        <td><h2>Kasir Online</h2></td>
    </tr>
    <tr>
        <td>
            <h2>Let's get using with apps</h2>
        </td>
    </tr>
    

    
</table></center>

<div class="container">
<!-- Button trigger modal -->
<button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModalLong">
  Informasi Akun
</button>

<!-- Modal -->
<div class=" container modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pemberitahuan Informasi Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h5>Admin</h5>
       <p>Username/Email : admin</p>
       <p>Password : 123</p><br>
       <p>Username/Email : admin1</p>
       <p>Password : 123</p><br>
       <h5>Kasir</h5>
       <p>Username/Email : kasironline</p>
       <p>Password : 123</p><br>
       <p>Username/Email : contoh</p>
       <p>Password : 123</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</div>

<div class="container" >
    <div class="row justify-content-md-center mt-12">

        <div class="col-sm-8">
            <div class="row border-box">
                <div class="col-sm-6 p-0">
                    <img src="img/mosting-login.png" class="img-fluid">
                </div>
                <div class="col-sm-6 p-0">
                    <div class="container">
                        <div class="card-header">
                            <img src="img/mz-logo-login.png">
                            <div class="sub-title">
                             Login
                         </div>
                     </div>
                     
                     <div class="card-body">
                        
                        <form action="" method="POST">
                           <table>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control input-login" placeholder="username/email" name="email">
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" class="form-control input-login" placeholder="Kata sandi" name="password">
                        </div>
                        <div class="form-group">
                           <label class="mz-check">
                            <input type="checkbox" name="rememberme">
                            <i class="mz-blue"></i>
                            Ingat Selalu
                        </label>
                        <label class="float-right"> <a href="register.php">belum punya akun?</a></label>
                        <button type="submit" class="btn btn-primary float-right" name="login">Masuk <i class="ti-angle-double-right" style="font-size: 12px"></i></button>
                    </div>
                    
                </form>
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
</div>

</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>