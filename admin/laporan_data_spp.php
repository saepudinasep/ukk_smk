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
        <title>Cetak Laporan Data SPP</title>
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
        <h3>LAPORAN Data SPP</h3>
        <hr>
        <table width="100%" border="1" cellspacing="0" cellpading="4">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Tahun</th>
                <th>Nominal</th>
            </tr>
            <?php
                $sqlSPP = mysqli_query($konek, "SELECT * FROM tb_spp ORDER BY id_spp ASC");
                $no=1;
                while ($d=mysqli_fetch_array($sqlSPP)) {
                    echo "<tr>
                        <td>$no</td>
                        <td>$d[id_spp]</td>
                        <td>$d[tahun]</td>
                        <td>";
                        echo "Rp. ";
                        echo number_format($d['nominal'], 2);
                        echo "</td> </tr>";
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