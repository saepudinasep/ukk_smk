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
        <title>Cetak Laporan Data Siswa</title>
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
        <h3>LAPORAN DATA SISWA</h3>
        <hr>
        <table width="100%" border="1" cellspacing="0" cellpading="4">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Telepon</th>
            </tr>
            <?php
                $sqlSiswa = mysqli_query($konek, "SELECT tb_siswa.*, tb_kelas.*
                FROM tb_siswa
                INNER JOIN tb_kelas ON tb_kelas.id_kelas=tb_siswa.id_kelas 
                ORDER BY tb_kelas.nama_kelas AND tb_kelas.kompetensi_keahlian ASC");
                $no=1;
                while ($d=mysqli_fetch_array($sqlSiswa)) {
                    echo "
                <tr>
                    <td>$no</td>
                    <td>$d[nisn]</td>
                    <td>$d[nis]</td>
                    <td>$d[nama]</td>
                    <td>$d[nama_kelas] $d[kompetensi_keahlian]</td>
                    <td>$d[alamat]</td>
                    <td>$d[no_hp]</td>
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