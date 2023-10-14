<?php
    session_start();
    if($_SESSION['id']==""){
      header('location:../login.php');
    }
     

    include "inc/koneksi.php";
    $qprofil = mysqli_query($konek, "SELECT * FROM tb_siswa WHERE nisn='$_SESSION[id]'");
    $profil = mysqli_fetch_array($qprofil);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/favicon.png">
 
    <title>Pembayaran SPP - SISWA</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

</head>
<body>
     <!-- Fixed navbar -->
     <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index_siswa.php">SISWA - (<?php echo $profil['nama']; ?>)</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="riwayat_siswa.php">History Pembayaran</a></li>
            <li><a href="profile_siswa.php">Profile</a></li>
            <li><a href="inc/logout.php">Keluar</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 