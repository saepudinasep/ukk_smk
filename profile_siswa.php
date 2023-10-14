<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }

    include "inc/koneksi.php";

    $qprofil = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*, tb_guru.*
                                    FROM tb_siswa
                                    INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas
                                    INNER JOIN tb_guru ON tb_guru.id_guru=tb_kelas.id_guru
                                    WHERE tb_siswa.nisn='$_SESSION[id]'");
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
    <link rel="icon" href="./assets/favicon.png">

    <title>Aplikasi Pembayaran SPP</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

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
          <a class="navbar-brand" href="index_siswa.php">SISWA - (<?php echo $profil['nama']; ?>)</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="riwayat_siswa.php">History Pembayaran</a></li>
            <li class="active"><a href="profile_siswa.php">Profile</a></li>
            <li><a href="inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

    <div class="container">
        <div class="page-header">
            <h3>Profile</h3>
        </div>
        <table class="table">
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><?php echo $profil['nisn']; ?></td>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $profil['nama']; ?></td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td><?php echo $profil['nis']; ?></td>
                <td>Kelas</td>
                <td>:</td>
                <td><?php echo $profil['nama_kelas']." ".$profil['kompetensi_keahlian']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>WaliKelas</td>
                <td>:</td>
                <td><?php echo $profil['nama_guru']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $profil['alamat']; ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>:</td>
                <td><?php echo $profil['no_hp']; ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

<?php include "footer_siswa.php"; ?>
