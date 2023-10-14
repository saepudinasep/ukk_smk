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
    <?php
        $id = $_GET['id'];
        $sqlEdit = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*, tb_spp.*
        FROM tb_siswa
        INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas
        INNER JOIN tb_spp ON tb_spp.id_spp=tb_siswa.id_spp
        WHERE tb_siswa.nisn='$id'");
        $e = mysqli_fetch_array($sqlEdit);
    ?>
    <div class="container">
        <div class="page-header">
            <h3>Edit Data Siswa</h3>
        </div>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td>NISN</td>
                    <td><input class="form-control" type="number" name="nisn" value="<?php echo $e['nisn']; ?>" readonly></td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td><input class="form-control" type="number" name="nis" value="<?php echo $e['nis']; ?>"></td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td><input class="form-control" type="text" name="nama" value="<?php echo $e['nama']; ?>"></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>
                        <select class="form-control" name="id_kelas">
                            <?php
                                $qkelas = mysqli_query($konek, "SELECT * FROM tb_kelas ORDER BY nama_kelas AND kompetensi_keahlian ASC");
                                while($dkelas = mysqli_fetch_array($qkelas)){
                                    if ($dkelas['id_kelas'] == $e['id_kelas']) {
                                        $selected = "selected";
                                    }else {
                                        $selected = "";
                                    }
                            ?>
                            <option value="<?php echo $dkelas['id_kelas']; ?>" <?php echo $selected; ?>>
                            <?php echo $dkelas['nama_kelas']." ".$dkelas['kompetensi_keahlian']; ?> 
                            </option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><textarea class="form-control" name="alamat"><?php echo $e['alamat']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Telepon</td>
                    <td><input class="form-control" type="number" name="telp" value="<?php echo $e['no_hp']; ?>"></td>
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
                
                if ($nisn=='' || $nis=='' || $nama=='' || $id_kelas=='' || $alamat=='' || $telp=='') {
                    echo "Form belum lengkap!";
                }else {
                    $edit = mysqli_query($konek, "UPDATE tb_siswa SET nis='$nis', nama='$nama', id_kelas='$id_kelas',
                    alamat='$alamat', no_hp='$telp' WHERE nisn='$nisn'");
                    if (!$edit) {
                        echo "Simpan data gagal!";
                    }else {
                        ?>
                        <script type="text/javascript">
                            alert(' Berhasil Edit Siswa !');
                            document.location.href="tampil_siswa.php";
                        </script>
                        <?php
                    }
                }
            }
        ?>

    </div>
    
<?php include "footer.php"; ?>