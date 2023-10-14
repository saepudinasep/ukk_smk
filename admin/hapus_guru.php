<?php
session_start();
if (isset($_SESSION['login'])) {
    include "../inc/koneksi.php";
    $id = $_GET['id'];
    $hapus = mysqli_query($konek, "DELETE FROM tb_guru WHERE id_guru='$id'");

    if ($hapus) {
        header('location:tampil_guru.php');
    }else {
        echo "Hapus data gagal, data petugas digunakan di tabel Transaksi <br>
        <a href='tampil_guru.php'>Kembali</a>";
    }
}else {
    echo "Anda tidak memiliki akses ke halaman ini!";
}
?>
