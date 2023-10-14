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
            <h3>Data Siswa</h3>
        </div>
        <div class="col-md-8">
          <?php
                $qjumlah = mysqli_query($konek, "SELECT * FROM tb_siswa");
                $jumlah = mysqli_num_rows($qjumlah);
            ?>
          <a class="btn btn-primary" style="margin-bottom: 10px;" href="tambah_siswa.php">Tambah Data</a>
          <button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $jumlah; ?></span></button>
          <a href="?menu=data_pegawai" class="btn btn-sm btn-primary">Refresh</a>
        </div>
        <div class="col-md-4">
          <form method="post">
                <div class="input-group">
                    <input name="inputan" type="text" class="form-control" placeholder="Cari Siswa">
                    <span class="input-group-btn">
                        <input name="cari" class="btn btn-default" value="Cari" type="submit">
                    </span>
                </div><!-- /input-group -->
          </form>
        </div>
        <table class="table table-bordered table-striped">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
<!-- disini -->
<?php
            //paging
            $batas = 5;
            $hal = ceil($jumlah / $batas);
            $page = (isset($_GET['hal'])) ? $_GET['hal']:1;
            $posisi = ($page - 1) * $batas;
            //end paging
            $no = 1+$posisi;
            $inputan = $_POST['inputan'];
            if($_POST['cari']){
                if($inputan==""){
                    $q = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*
                    FROM tb_siswa
                    INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas 
                    ORDER BY tb_kelas.nama_kelas AND tb_kelas.kompetensi_keahlian limit $posisi, $batas");
                }
                elseif($inputan!==""){
                    $q = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*
                    FROM tb_siswa
                    INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas 
                    WHERE tb_siswa.nama LIKE '%$inputan%' limit $posisi, $batas ORDER BY tb_kelas.nama_kelas AND tb_kelas.kompetensi_keahlian ");
                }
            }
            else{
                $q = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*
                FROM tb_siswa
                INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas 
                ORDER BY tb_kelas.nama_kelas AND tb_kelas.kompetensi_keahlian limit $posisi, $batas");
            }
                $cek = mysqli_num_rows($q);

                if($cek < 1){
                    ?>
                    <tr>
                        <td colspan="7">
                            <center>
                                Data tidak tersedia !
                                <a href="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-refresh"></span></a>
                            </center>
                        </td>
                    </tr>
                    <?php
                }
                else{
                    
            while($data = mysqli_fetch_array($q)){
                
            
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nisn']; ?></td>
                <td><?php echo $data['nis']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['nama_kelas']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
                <td><?php echo $data['no_hp']; ?></td>
                <td>
                    <a onclick="return confirm('Menghapus data siswa juga mengahapus transaksi?')" title="Hapus" href="hapus_siswa.php?id=<?php echo $d['nisn']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a> |
                    <a title="Edit" href="edit_siswa.php?id=<?php echo $d['nisn']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                </td>
            </tr>
            <?php
                    }
                }
            ?>

        </table>
        <nav>
            <ul class="pagination">
                <?php
                    for ($i=1; $i <= $hal ; $i++) { 
                        ?>
                        <li <?php if ($page==$i) {
                            echo "class='active'";
                        } ?>><a href="?menu=data_pegawai&hal=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </nav>
    </div>

<?php include "footer.php"; ?>