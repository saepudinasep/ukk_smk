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
            <li><a href="tampil_guru.php">Data Guru</a></li>
            <li><a href="tampil_petugas.php">Data Petugas</a></li>
            <li><a href="tampil_kelas.php">Data Kelas</a></li>
            <li class="active"><a href="tampil_spp.php">Data SPP</a></li>
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
        $sqlEdit = mysqli_query($konek, "SELECT * FROM tb_spp WHERE id_spp='$id'");
        $e = mysqli_fetch_array($sqlEdit);
    ?> 
    <div class="container">
        <div class="page-header">
            <h3>Tambah Data Petugas</h3>
        </div>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td>Tahun</td>
                    <td><input class="form-control" type="number" name="tahun" value="<?php echo $e['tahun']; ?>"></td>
                </tr>
                <tr>
                    <td>Nominal</td>
                    <td><input class="form-control" type="number" name="nominal" value="<?php echo $e['nominal']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-success" type="submit" value="Simpan">  
                        <a class="btn btn-info" href="tampil_spp.php">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $tahun = $_POST['tahun'];
                $nominal = $_POST['nominal'];
                
                if ($tahun=='' || $nominal=='') {
                    echo "Form belum lengkap!";
                }else {
                    $edit = mysqli_query($konek, "UPDATE tb_spp SET tahun='$tahun', nominal='$nominal' 
                    WHERE id_spp='$id'");
                    if (!$edit) {
                        echo "Simpan data gagal!";
                    }else {
                        ?>
                        <script type="text/javascript">
                            alert(' Berhasil Edit SPP !');
                            document.location.href="tampil_spp.php";
                        </script>
                        <?php
                    }
                }
            }
        ?>
    </div>
    

<?php include "footer.php"; ?>
