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
            <li class="active"><a href="laporan.php">Laporan</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

    <div class="container">
        <div class="page-header">
            <h3>Laporan</h3>
        </div>
        <ul class="nav nav-pills nav-stacked">
            <li><a href="laporan_data_siswa.php" target="_blank">Laporan Data Siswa</a></li>
            <li><a href="laporan_data_guru.php" target="_blank">Laporan Data Guru</a></li>
            <li><a href="laporan_data_petugas.php" target="_blank">Laporan Data Petugas</a></li>
            <li><a href="laporan_data_spp.php" target="_blank">Laporan Data SPP</a></li>
            <li><a href="laporan_tunggakan.php" target="_blank">Laporan Tunggakan</a></li>
            <li>
                <strong>Laporan Pembayaran</strong>
                <form action="laporan_pembayaran.php" method="get">
                    Mulai Tanggal <input type="date" name="tgl1" value="<?php echo date('Y-m-d'); ?>" />
                    Sampai Tanggal <input type="date" name="tgl2" value="<?php echo date('Y-m-d'); ?>" />
                    <input class="btn btn-success" type="submit" value="Tampilkan" />
                </form>
            </li>
        </ul>
    </div>

<?php include "footer.php"; ?>