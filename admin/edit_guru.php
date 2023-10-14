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
          <a class="navbar-brand" href="./">ADMIN - (<?php echo $profil['nama_petugas']; ?>)</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="tampil_siswa.php">Data Siswa</a></li>
            <li class="active"><a href="tampil_guru.php">Data Guru</a></li>
            <li><a href="tampil_petugas.php">Data Petugas</a></li>
            <li><a href="tampil_kelas.php">Data Kelas</a></li>
            <li><a href="tampil_spp.php">Data SPP</a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

    <?php
        $id = $_GET['id'];
        $sqlEdit = mysqli_query($konek, "SELECT * FROM tb_guru WHERE id_guru='$id'");
        $e = mysqli_fetch_array($sqlEdit);
    ?> 
    <div class="container">
        <div class="page-header">
            <h3>Tambah Data Petugas</h3>
        </div>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td>Nama Petugas</td>
                    <td><input class="form-control" type="text" name="nama" value="<?php echo $e['nama_guru']; ?>"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea class="form-control" name="alamat"><?php echo $e['alamat']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td><input class="form-control" type="number" name="telp" value="<?php echo $e['telepon']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-success" type="submit" value="Simpan">  
                        <a class="btn btn-info" href="tampil_guru.php">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $nama = $_POST['nama'];
                $alamat = $_POST['alamat'];
                $telp = $_POST['telp'];
                
                if ($nama=='' || $alamat=='' || $telp=='') {
                    echo "Form belum lengkap!";
                }else {
                    $edit = mysqli_query($konek, "UPDATE tb_guru SET nama_guru='$nama', alamat='$alamat', telepon='$telp' 
                    WHERE id_guru='$id'");
                    if (!$edit) {
                        echo "Simpan data gagal!";
                    }else {
                        ?>
                        <script type="text/javascript">
                            alert(' Berhasil Edit Guru !');
                            document.location.href="tampil_guru.php";
                        </script>
                        <?php
                    }
                }
            }
        ?>
    </div>
    

<?php include "footer.php"; ?>
