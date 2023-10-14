<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }
    if($_SESSION['status']=="admin"){
      header('location:../admin/index.php');
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

    <title>Pembayaran SPP - PETUGAS</title>

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
          <a class="navbar-brand" href="index.php">PETUGAS - (<?php echo $profil['nama_petugas']; ?>)</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="transaksi.php">Transaksi</a></li>
            <li class="active"><a href="riwayat.php">History Pembayaran</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
        <div class="page-header">
            <h3>Riwayat Transaksi Pembayaran</h3>
        </div>
        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>No. Bayar</th>
                <th>Pembayaran Bulan</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
            <?php
                $id_petugas = $profil['id_petugas'];
                $sqlBayar = mysqli_query($konek, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                                                FROM tb_pembayaran
                                                INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                                                INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                                                WHERE tb_pembayaran.id_petugas='$id_petugas'
                                                ORDER BY tb_pembayaran.tgl_bayar ASC");
                $no=1;
                $total = 0;
                while ($d=mysqli_fetch_array($sqlBayar)) {
                    $qkelas = mysqli_query($konek, "SELECT * FROM tb_kelas WHERE id_kelas='$d[id_kelas]'");
                    $kelas = mysqli_fetch_array($qkelas);
                    echo "
                <tr>
                    <td><center>$no</center></td>
                    <td>$d[nisn]</td>
                    <td>$d[nis]</td>
                    <td>$d[nama]</td>
                    <td><center>$kelas[nama_kelas] $kelas[kompetensi_keahlian]</center></td>
                    <td><center>$d[nobayar]</center></td>
                    <td><center>$d[bulan]</center></td>
                    <td><center>$d[ket]</center></td>
                    <td align='right'>Rp. ";
                    echo number_format($d['jumlah_bayar'], 2);
                    echo "</td>
                    
                </tr>";
                $no++;
                $total += $d['jumlah_bayar'];
                }
            ?>
            <tr>
                <td colspan="8" align="center">Total</td>
                <td align="right">Rp. <b><?php echo number_format($total, 2); ?></b></td>
            </tr>
        </table>
    </div>
    
<?php
    include "footer.php";
?>