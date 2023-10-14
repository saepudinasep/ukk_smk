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
        <h3>LAPORAN PEMBAYARAN SPP</h3>
        <hr>
        <h4>Tanggal : <?php echo $_GET['tgl1']; ?> - <?php echo $_GET['tgl2']; ?></h4>
        <table width="100%" border="1" cellspacing="0" cellpading="4">
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>No. Bayar</th>
                <th>Pembayaran Bulan</th>
                <th>Petugas</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
            <?php
                $sqlBayar = mysqli_query($konek, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                                                FROM tb_pembayaran
                                                INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                                                INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                                                WHERE tb_pembayaran.tgl_bayar BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
                                                ORDER BY tb_pembayaran.nobayar ASC");
                $no=1;
                $total = 0;
                while ($d=mysqli_fetch_array($sqlBayar)) {
                    $qkelas = mysqli_query($konek, "SELECT * FROM tb_kelas WHERE id_kelas='$d[id_kelas]'");
                    $kelas = mysqli_fetch_array($qkelas);
                    echo "
                <tr>
                    <td><center>$no</center></td>
                    <td>$d[nisn]</td>
                    <td>$d[nis]</td>
                    <td>$d[nama]</td>
                    <td><center>$kelas[nama_kelas] $kelas[kompetensi_keahlian]</center></td>
                    <td><center>$d[nobayar]</center></td>
                    <td><center>$d[bulan]</center></td>
                    <td>$d[nama_petugas]</td>
                    <td><center>$d[ket]</center></td>
                    <td align='right'>Rp. ";
                    echo number_format($d['jumlah_bayar'], 2);
                    echo "</td>
                    
                </tr>";
                $no++;
                $total += $d['jumlah_bayar'];
                }
            ?>
            <tr>
                <td colspan="9" align="center">Total</td>
                <td align="right">Rp. <b><?php echo number_format($total, 2); ?></b></td>
            </tr>
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

        <a href="#" class="no-print" onclick="window.print();">Cetak/Print</a> |
        <a href="excel_laporan_pembayaran.php?tgl1=<?php echo $_GET['tgl1']; ?>&tgl2=<?php echo $_GET['tgl2']; ?>" class="no-print" target="_blank">
                Export ke Excel
        </a>
    </body>
    </html>

    <?php
}else {
    header('location:login.php');
}
?>