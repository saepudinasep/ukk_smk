<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_pembayaran.xls");
    include "../inc/koneksi.php";
?>

    
        <h3>LAPORAN PEMBAYARAN SPP</h3>
        
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
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
            <?php
                $sqlBayar = mysqli_query($konek, "SELECT tb_pembayaran.*, tb_siswa.*, tb_petugas.*
                                                FROM tb_pembayaran
                                                INNER JOIN tb_siswa ON tb_siswa.nisn=tb_pembayaran.nisn
                                                INNER JOIN tb_petugas ON tb_petugas.id_petugas=tb_pembayaran.id_petugas
                                                WHERE tb_pembayaran.tgl_bayar!='' AND tgl_bayar BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
                                                ORDER BY tb_pembayaran.tgl_bayar ASC");
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
                    <td align='right'>Rp. ";
                    echo number_format($d['jumlah_bayar'], 2);
                    echo "</td>
                    <td><center>$d[ket]</center></td>
                </tr>";
                $no++;
                $total += $d['jumlah_bayar'];
                }
            ?>
            <tr>
                <td colspan="7" align="center">Total</td>
                <td align="right">Rp. <b><?php echo number_format($total, 2); ?></b></td>
            </tr>
        </table>
