<?php
session_start();
if (isset($_SESSION['login'])) {
    include "../inc/koneksi.php";
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cetak Laporan Pembayaran</title>
        <style type="text/css">
            body{
                font-family: Arial;

            }
            @media print{
                .no-print{
                    display: none;
                }
            }

            table{
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <h3>SLIP PEMBAYARAN SPP</h3>
        <hr>
        <?php
            $qSiswa = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*
                                            FROM tb_siswa
                                            INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas
                                            WHERE nisn='$_GET[nisn]'");
            $ds = mysqli_fetch_array($qSiswa);
        ?>
        <table>
            <tr>
                <td width="100">Nama Siswa</td>
                <td>:</td>
                <td><?php echo $ds['nama']; ?></td>
            </tr>
            <tr>
                <td width="100">NISN</td>
                <td>:</td>
                <td><?php echo $ds['nisn']; ?></td>
            </tr>
            <tr>
                <td width="100">NIS</td>
                <td>:</td>
                <td><?php echo $ds['nis']; ?></td>
            </tr>
            <tr>
                <td width="100">Kelas</td>
                <td>:</td>
                <td><?php echo $ds['nama_kelas']." ".$ds['kompetensi_keahlian']; ?></td>
            </tr>
        </table>
        <hr>
        <table width="100%" border="1" cellspacing="0" cellpading="4">
            <tr>
                <th>No</th>
                <th>No. Bayar</th>
                <th>Pembayaran Bulan</th>
                <th>Petugas</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
            <?php
                $sqlBayar = mysqli_query($konek, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                                                FROM tb_pembayaran
                                                INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                                                INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                                                WHERE tb_pembayaran.tgl_bayar!='' AND tb_pembayaran.bulan='$_GET[bulan]'
                                                AND tb_pembayaran.id_spp='$_GET[id]' AND tb_pembayaran.nisn='$_GET[nisn]'
                                                ORDER BY tb_pembayaran.tgl_bayar ASC");
                $no=1;
                while ($d=mysqli_fetch_array($sqlBayar)) {
                    $qkelas = mysqli_query($konek, "SELECT * FROM tb_kelas WHERE id_kelas='$d[id_kelas]'");
                    $kelas = mysqli_fetch_array($qkelas);
                    echo "
                <tr>
                    <td><center>$no</center></td>
                    <td><center>$d[nobayar]</center></td>
                    <td><center>$d[bulan]</center></td>
                    <td>$d[nama_petugas]</td>
                    <td align='right'>Rp. ";
                    echo number_format($d['jumlah_bayar'], 2);
                    echo "</td>
                    <td><center>$d[ket]</center></td>
                </tr>";
                $no++;
                }
            ?>
        </table>

        <table width="100%">
            <tr>
                <td></td>
                <td width="200px">
                    <p>Ciuyah, <?php echo date('d/m/Y'); ?><br>
                    Petugas,</p>
                    <br>
                    <br>
                    <p>__________________</p>
                </td>
            </tr>
        </table>

        <a href="#" class="no-print" onclick="window.print();">Cetak/Print</a>
    </body>
    </html>

    <?php
}else {
    header('location:login.php');
}
?>