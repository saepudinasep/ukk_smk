<?php 
    session_start();
    if (isset($_SESSION['login'])) {

        include "../inc/koneksi.php";
        if ($_GET['act']=='bayar') {
            $id_spp = $_GET['id'];
            $nisn = $_GET['nisn'];
            $bulan = $_GET['bulan'];

            //id admin
            $admin = $_SESSION['id'];

            // membuat nomor pembayaran
            $today = date("ymd");
            $query = mysqli_query($konek, "SELECT max(nobayar) AS last FROM tb_pembayaran WHERE nobayar LIKE '$today%'");
            $data = mysqli_fetch_array($query);
            $lastNoBayar = $data['last'];
            $lastNoUrut = substr($lastNoBayar, 6, 4);
            $nextNoUrut = $lastNoUrut + 1;
            $nextNoBayar = $today.sprintf('%04s', $nextNoUrut);

            $tgl_bayar = date("Y-m-d");

            mysqli_query($konek, "UPDATE tb_pembayaran SET id_petugas='$admin',
                                                             tgl_bayar='$tgl_bayar', nobayar='$nextNoBayar',
                                                              ket='LUNAS'
                                                              WHERE nisn='$nisn' AND bulan='$bulan'");

                                                              ?>
                                                              <?php

            header('location:transaksi.php?nisn='.$nisn);
        }elseif ($_GET['act']=='batal') {
            $id_spp = $_GET['id'];
            $nisn = $_GET['nisn'];
            $bulan = $_GET['bulan'];
            
            mysqli_query($konek, "UPDATE tb_pembayaran SET id_petugas=null,
                                                             tgl_bayar=null, nobayar=null,
                                                              ket='BELUM BAYAR'
                                                              WHERE nisn='$nisn' AND bulan='$bulan'");

                                                              ?>
                                                              <?php

            header('location:transaksi.php?nisn='.$nisn);
        }
    }
?>