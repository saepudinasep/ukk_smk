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
    <link rel="icon" href="./assets/favicon.png">

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
            <li class="active"><a href="tampil_kelas.php">Data Kelas</a></li>
            <li><a href="tampil_spp.php">Data SPP</a></li>
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

<div class="container">
    <div class="page-header">
        <h3>Data Kelas</h3>
    </div>
    <a class="btn btn-primary" style="margin-bottom: 10px;" href="tambah_kelas.php">Tambah Data</a>
    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Kompetensi Keahlian</th>
            <th>Wali Kelas</th>
            <th>Aksi</th>
        </tr>
        <?php 
            $sql = mysqli_query($konek, "SELECT tb_guru.*, tb_kelas.*
            FROM tb_kelas
            INNER JOIN tb_guru ON tb_guru.id_guru=tb_kelas.id_guru
            ORDER BY tb_kelas.kompetensi_keahlian ASC");
            $no=1;
            while ($d=mysqli_fetch_array($sql)) {
                echo "
            <tr>
                <td width='40px' align='center'>$no</td>
                <td>$d[nama_kelas]</td>
                <td>$d[kompetensi_keahlian]</td>
                <td>$d[nama_guru]</td>
                <td width='60px'>";
                ?>
                    <a onclick="return confirm('Anda akan menghapusnya?')" title="Hapus" href="hapus_kelas.php?id=<?php echo $d['id_kelas']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> |
                    <a title="Edit" href="edit_kelas.php?id=<?php echo $d['id_kelas']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                <?php
                echo "</td>
            </tr>";
            $no++;
            }
        ?>
    </table>
</div>

<?php include "footer.php"; ?>
