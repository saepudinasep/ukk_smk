<?php
    include "inc/koneksi.php";
    session_start();
    if(@$_SESSION['id'] != ""){
        if($_SESSION['status']=="admin"){
        header('location:admin/index.php');
        }else if($_SESSION['status']=="petugas"){
        header('location:petugas/index.php');
        }else {
            header('location:index_siswa.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/favicon.png">

    <title>Login Aplikasi Pembayaran SPP</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">
    
</head>
<body>

    <div class="container">
    
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Silahkan Login Menggunakan Username dan Password Anda</h4>
                </div>
                <div class="panel-body">
                    <form action="" method="post">
                        <div class="col-md-11">
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Username</span>
                                <input class="form-control" type="text" name="username" placeholder="Username" aria-describedby="basic-addon1" required="required">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Password</span>
                                <input class="form-control" type="password" name="password" placeholder="Password" aria-describedby="basic-addon1" required="required">
                            </div>
                            <br>
                        </div>
                        <b><center>
                                    <input class="btn btn-primary" type="submit" value="Login">
                                    <a class="btn btn-success" href="index.php">Kembali</a>
                                    </center>
                        </b>
                    </form>
                    <?php
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $user = $_POST['username'];
                            $pass = md5($_POST['password']);

                            if ($user=='' || $pass=='') {
                                echo "Form Belum Lengkap!";
                            }else {
                                include "inc/koneksi.php";
                                $sqlLogin = mysqli_query($konek, "SELECT * FROM tb_petugas WHERE username='$user' AND password='$pass'");
                                $jml = mysqli_num_rows($sqlLogin);
                                $d = mysqli_fetch_array($sqlLogin);

                                if ($jml > 0) {
                                    session_start();
                                    $_SESSION['login'] = true;
                                    $_SESSION['id'] = $d['id_petugas'];
                                    $_SESSION['nama'] = $d['nama_petugas'];
                                    $_SESSION['status'] = $d['level'];
                                    if($d['level']=="admin"){
                                    
                                        header('location:admin/index.php');
                                    }else if($d['level']=="petugas"){
                                        
                                        header('location:petugas/index.php');
                                    }
                                }else {
                                    ?>
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        <center>
                                            Username atau Password Anda Salah
                                        </center>
                                    </div>
                                    <?php
                                    // echo "Username dan Password Anda Salah";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        
        
        
    </div>
    

    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>
</html>