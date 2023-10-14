<?php
    $konek = mysqli_connect("localhost", "root", "", "dbspp");
    if (!$konek) {
        echo "Koneksi Database Gagal!";
    }
?>