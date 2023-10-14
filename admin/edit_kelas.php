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

    <?php
        $id = $_GET['id'];
        $sqlEdit = mysqli_query($konek, "SELECT * FROM tb_kelas WHERE id_kelas='$id'");
        $e = mysqli_fetch_array($sqlEdit);
    ?>
    <div class="container">
        <div class="page-header">
            <h3>Edit Data Kelas</h3>
        </div>
        <form action="" method="post">
            <table class="table">
                <tr>
                    <td>Kelas</td>
                    <td><input class="form-control" type="number" name="kelas" value="<?php echo $e['nama_kelas']; ?>"></td>
                </tr>
                <tr>
                    <td>Kompetensi Keahlian</td>
                    <td><input class="form-control" type="text" name="keahlian" value="<?php echo $e['kompetensi_keahlian']; ?>"></td>
                </tr>
                <tr>
                    <td>Wali Kelas</td>
                    <td>
                        <select class="form-control" name="id_guru">
                            <?php
                                $qguru = mysqli_query($konek, "SELECT * FROM tb_guru");
                                while($dguru = mysqli_fetch_array($qguru)){
                                    if ($dguru['id_guru'] == $e['id_guru']) {
                                        $selected = "selected";
                                    }else {
                                        $selected = "";
                                    }

                            ?>
                            <option value="<?php echo $dguru['id_guru']; ?>" <?php echo $selected; ?>>
                            <?php echo $dguru['nama_guru']; ?>
                            </option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input class="btn btn-success" type="submit" value="Simpan">  
                    <a  class="btn btn-info" href="tampil_kelas.php">Kembali</a></td>
                </tr>
            </table>
        </form>

        <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $kelas = $_POST['kelas'];
                $keahlian = $_POST['keahlian'];
                $id_guru = $_POST['id_guru'];
                
                if ($kelas=='' || $keahlian=='' || $id_guru=='') {
                    echo "Form belum lengkap!";
                }else {
                    $edit = mysqli_query($konek, "UPDATE tb_kelas SET nama_kelas='$kelas', kompetensi_keahlian='$keahlian', id_guru='$id_guru' 
                    WHERE id_kelas='$id'");
                    if (!$edit) {
                        echo "Simpan data gagal!";
                    }else {
                        ?>
                        <script type="text/javascript">
                            alert(' Berhasil Edit Kelas !');
                            document.location.href="tampil_kelas.php";
                        </script>
                        <?php
                    }
                }
            }
        ?>

    </div>
    

<?php include "footer.php"; ?>