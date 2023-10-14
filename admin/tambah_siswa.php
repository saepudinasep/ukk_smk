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
            <li class="active"><a href="tampil_siswa.php">Data Siswa</a></li>
            <li><a href="tampil_guru.php">Data Guru</a></li>
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
    <div class="container">
        <div class="page-header">
            <h3>Tambah Data Siswa</h3>
        </div>
        
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td>NISN</td>
                    <td><input class="form-control" type="number" name="nisn"></td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td><input class="form-control" type="number" name="nis"></td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td><input class="form-control" type="text" name="nama"></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>
                        <select class="form-control" name="id_kelas">
                            <?php
                                $qkelas = mysqli_query($konek, "SELECT * FROM tb_kelas ORDER BY nama_kelas AND kompetensi_keahlian ASC");
                                while($dkelas = mysqli_fetch_array($qkelas)){
                            ?>
                            <option value="<?php echo $dkelas['id_kelas']; ?>">
                            <?php echo $dkelas['nama_kelas']." ".$dkelas['kompetensi_keahlian']; ?> 
                            </option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea class="form-control" name="alamat"></textarea></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td><input class="form-control" type="number" name="telp"></td>
                </tr>
                <tr>
                    <td>SPP</td>
                    <td>
                        <select class="form-control" name="id_spp">
                            <?php
                                $qspp = mysqli_query($konek, "SELECT * FROM tb_spp ORDER BY tahun ASC");
                                while($dspp = mysqli_fetch_array($qspp)){
                            ?>
                            <option value="<?php echo $dspp['id_spp']; ?>">
                            <?php echo $dspp['tahun']." / ".$dspp['nominal']; ?> 
                            </option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-success" type="submit" value="Simpan">  
                        <a class="btn btn-info" href="tampil_siswa.php">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $nisn = $_POST['nisn'];
                $nis = $_POST['nis'];
                $nama = $_POST['nama'];
                $id_kelas = $_POST['id_kelas'];
                $alamat = $_POST['alamat'];
                $telp = $_POST['telp'];
                $id_spp = $_POST['id_spp'];
                $ket = "BELUM BAYAR";
                
                // nyambil nominal / jumlah bayar spp
                $nspp = mysqli_query($konek, "SELECT * FROM tb_spp WHERE id_spp='$id_spp'");
                $nominal = mysqli_fetch_array($nspp);
                
                $bulanIndo = array(
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember'
                );
                if ($nisn=='' || $nis=='' || $nama=='' || $id_kelas=='' || $alamat=='' || $telp=='' || $id_spp=='') {
                    echo "Form belum lengkap!";
                }else {
                    $simpan = mysqli_query($konek, "INSERT INTO tb_siswa (nisn, nis, nama, id_kelas, alamat, no_hp, id_spp)
                    VALUES('$nisn', '$nis', '$nama', '$id_kelas', '$alamat', '$telp', '$id_spp')");
                    if (!$simpan) {
                        echo "Simpan data gagal!";
                    }else {
                        $simpan;
                        
                        for ($i=0; $i < 12 ; $i++) { 
                            //membuat tanggal jatuh tempo dengan bulan Indo
                            $jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime(date('Y-m-d'))));

                            $bulan = $bulanIndo[date('m', strtotime($jatuhtempo))]." ".date('Y',strtotime($jatuhtempo));
                            //membuat tanggal jatuh tempo nya setiap tanggal 10
                            $date = mktime(0,0,0,date('m')+$i,date('10'),date('Y'));
                            $date = date('Y-m-d', $date);
    // insert pembayaran
                            $qpembayaran = "INSERT INTO tb_pembayaran(nisn, bulan, jatuh_tempo, id_spp, jumlah_bayar, ket)
                            VALUES('$nisn', '$bulan', '$date', '$id_spp', '$nominal[nominal]', '$ket')";
                            mysqli_query($konek, $qpembayaran);
                        }
                        header('location:tampil_siswa.php');
                    }
                }
            }
        ?>
    </div>

<?php include "footer.php"; ?>
