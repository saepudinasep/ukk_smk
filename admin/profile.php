<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }
    if($_SESSION['status']=="petugas"){
      header('location:../petugas/index.php');
    } 

    include "../inc/koneksi.php";

    $qprofil = mysqli_query($konek, "SELECT * FROM tb_petugas WHERE id_petugas='$_SESSION[id]'");
    $profil = mysqli_fetch_array($qprofil);
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
    <link rel="icon" href="./../assets/favicon.png">

    <title>Aplikasi Pembayaran SPP</title>

    <!-- Bootstrap core CSS -->
    <link href="./../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./../assets/style.css" rel="stylesheet">

</head>
<body>
     <!-- Fixed navbar -->
     <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ADMIN - (<?php echo $profil['nama_petugas']; ?>)</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="tampil_siswa.php">Data Siswa</a></li>
            <li><a href="tampil_guru.php">Data Guru</a></li>
            <li><a href="tampil_petugas.php">Data Petugas</a></li>
            <li><a href="tampil_kelas.php">Data Kelas</a></li>
            <li><a href="tampil_spp.php">Data SPP</a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li class="active"><a href="profile.php">Profile</a></li>
            <li><a href="../inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

    <div class="container">
        <div class="page-header">
            <h3>Profile</h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informasi Tentang Anda !</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><?php echo $profil['nama_petugas']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?php echo $profil['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>:</td>
                                <td><?php echo $profil['telepon']; ?></td>
                            </tr>
                        </table>
                        <a href="edit_profile.php" class="btn btn-sm btn-primary">Edit data saya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Panel title</h3>
                    </div>
                    
                    <div class="panel-body">
                        <fieldset>
                            <legend>Edit Username</legend>
                            <form class="form" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User saat ini</span>
                                    <input type="text" class="form-control" value="<?php echo $profil['username']; ?>" aria-describedby="basic-addon1" readonly>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User baru</span>
                                    <input type="text" name="userbaru" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Password Anda</span>
                                    <input type="password" name="pass" class="form-control" placeholder="Password Anda" aria-describedby="basic-addon1">
                                </div>
                                <br>
                                    <input type="submit" name="edit_user" value="Simpan" class="btn btn-sm btn-success">
                            </form>
                        <!-- fungsi edit username -->
                        <?php
                            if(isset($_POST['edit_user'])){
                                $userbaru = $_POST['userbaru'];
                                $pass = $_POST['pass'];
                                if(md5($pass)==$profil['password']){
                                    mysqli_query($konek, "UPDATE tb_petugas SET username='$userbaru' WHERE id_petugas='$profil[id_petugas]'");
                                    ?>
                                    <script type="text/javascript">
                                        alert('Username anda berhasil di Ubah ! Silahkan Login kembali.');
                                        document.location.href="../inc/logout.php";
                                    </script>
                                    <?php
                                }else{
                                    echo "tidak menjalankan fungsinya";
                                }
                            }
                        ?>
                        </fieldset>
                        <hr>
                        <fieldset>
                            <legend>Edit Password</legend>
                            <form class="form" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Password Baru</span>
                                    <input type="password" name="pass1" class="form-control" placeholder="password baru" aria-describedby="basic-addon1">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Ketik Ulang Password Baru</span>
                                    <input type="password" name="pass2" class="form-control" placeholder="Ketik Ulang" aria-describedby="basic-addon1">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Password Anda saat ini</span>
                                    <input type="password" name="pass_awal" class="form-control" placeholder="password saat ini" aria-describedby="basic-addon1">
                                </div>
                                <br>
                                    <input type="submit" name="edit_password" value="Simpan" class="btn btn-sm btn-success">
                            </form>
                            <!-- fungsi edit Password -->
                            <?php
                                if(isset($_POST['edit_password'])){
                                    $pass1 = md5($_POST['pass1']);
                                    $pass2 = md5($_POST['pass2']);
                                    $pass = $_POST['pass_awal'];
                                    if($pass1 != $pass2){
                                        ?>
                                        <script type="text/javascript">
                                            alert('Password konfirmasi tidak cocok !');
                                        </script>
                                        <?php
                                    }else{
                                        if(md5($pass)==$profil['password']){
                                            mysqli_query($konek, "UPDATE tb_petugas SET password='$pass1' WHERE id_petugas='$profil[id_petugas]'");
                                            ?>
                                            <script type="text/javascript">
                                                alert('Password anda berhasil di Ubah ! Silahkan Login kembali.');
                                                document.location.href="../inc/keluar.php";
                                            </script>
                                            <?php
                                        }else{
                                            // echo "tidak menjalankan fungsinya";
                                        }
                                    }
                                }
                            ?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

<?php include "footer.php"; ?>
