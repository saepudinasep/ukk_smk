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
            <li class="active"><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
    <div class="container">
        <div class="page-header">
            <h3>Transaksi Pembayaran SPP</h3>
        </div>
        <div class="page-header">
        
            <form action="" method="get">
                <div class="col-xs-12 col-md-8">
                    <input class="form-control" type="text" name="nisn" placeholder="Masukkan NISN Siswa">
                </div>
                <input class="btn btn-primary" type="submit" name="cari" value="Cari Siswa">
            </form>
            <?php
                if (isset($_GET['nisn']) && $_GET['nisn']!='') {
                    $sqlSiswa = mysqli_query($konek, "SELECT * FROM tb_siswa WHERE nisn='$_GET[nisn]'");
                    $ds = mysqli_fetch_array($sqlSiswa);
                    $nisn = $ds['nisn'];
                    $id_kelas = $ds['id_kelas'];
                    $sqlKelas = mysqli_query($konek, "SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'");
                    $dk = mysqli_fetch_array($sqlKelas);
                    ?>
                    <div class="container">
                        <div class="page-header">
                            <h3>Biodata Siswa</h3>
                        </div>
                        
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>NISN</td>
                                    <td>:</td>
                                    <td><?php echo $ds['nisn']; ?></td>
                                </tr>
                                <tr>
                                    <td>NIS</td>
                                    <td>:</td>
                                    <td><?php echo $ds['nis']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?php echo $ds['nama']; ?></td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td><?php echo $dk['nama_kelas']." ".$dk['kompetensi_keahlian']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="container">
                        <div class="page-header">
                            <h3>Tagihan SPP Siswa</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>No.</th>
                                <th>Bulan</th>
                                <th>Jatuh Tempo</th>
                                <th>No. Bayar</th>
                                <th>Tgl Bayar</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Bayar</th>
                            </tr>
                        <?php
                            $sql = mysqli_query($konek, "SELECT * FROM tb_pembayaran WHERE nisn='$nisn'");
                            $no = 1;
                            while ($d=mysqli_fetch_array($sql)) {
                                echo "
                                <tr>
                                    <td>$no</td>
                                    <td>$d[bulan]</td>
                                    <td>$d[jatuh_tempo]</td>
                                    <td>$d[nobayar]</td>
                                    <td>$d[tgl_bayar]</td>
                                    <td>$d[jumlah_bayar]</td>
                                    <td>$d[ket]</td>
                                    <td align='center'>";
                                        if($d['tgl_bayar']==''){
                                            echo "<a class='btn btn-success' href='proses_transaksi.php?nisn=$nisn&act=bayar&id=$d[id_spp]&bulan=$d[bulan]'>Bayar</a>";
                                        }else {
                                            ?>
                                            <a onclick="return confirm('Anda akan menghapusnya membatalkan?')" title="Batal" class="btn btn-danger" href="proses_transaksi.php?nisn=<?php echo $nisn; ?>&act=batal&id=<?php echo $d['id_spp']; ?>&bulan=<?php echo $d['bulan']; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></a>
                                            <a class="btn btn-default" title="Cetak" href="cetak_slip_transaksi.php?nisn=<?php echo $nisn; ?>&id=<?php echo $d['id_spp']; ?>&bulan=<?php echo $d['bulan']; ?>" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></a>
                                            <?php
                                        }
                                    echo "</td>
                                </tr>";
                                $no++;
                            }

                        ?>

                        </table>
                    </div>

                    <?php
                }
            ?>
        </div>
            <p>Pembayaran SPP dilakukan dengan cara mencari tagihan siswa dengan NISN melalui form di atas, kemudian proses Pembayaran</p>

    </div>
    
<?php
    include "footer.php";
?>