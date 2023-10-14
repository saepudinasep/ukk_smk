<?php
session_start();
if (isset($_SESSION['login'])) {
    include "../inc/koneksi.php";
    $id = $_GET['id'];
    $hapus = mysqli_query($konek, "DELETE FROM tb_spp WHERE id_spp='$id'");

    if ($hapus) {
        header('location:tampil_spp.php');
    }else {
        echo "Hapus data gagal, data petugas digunakan di tabel Transaksi <br>
        <a href='tampil_spp.php'></a>";
    }
}else {
    echo "Anda tidak memiliki akses ke halaman ini!";
}
?>
