<?php
session_start();
if (isset($_SESSION['login'])) {
    include "../inc/koneksi.php";
    $id = $_GET['id'];
    $hapus = mysqli_query($konek, "DELETE FROM tb_kelas WHERE id_kelas='$id'");

    if ($hapus) {
        header('location:tampil_kelas.php');
    }else {
        echo "Hapus data gagal, data petugas digunakan di tabel Transaksi <br>
        <a href='tampil_kelas.php'></a>";
    }
}else {
    echo "Anda tidak memiliki akses ke halaman ini!";
}
?>
