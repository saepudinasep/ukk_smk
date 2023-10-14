-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2020 pada 13.51
-- Versi server: 10.1.40-MariaDB
-- Versi PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbspp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_guru` varchar(35) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `username`, `password`, `nama_guru`, `alamat`, `telepon`) VALUES
(1, 'ahmadi', 'a5b503a17701e93c3abe8087d58d6129', 'Drs. Ahmadi Yusuf', 'Desa Cikeusik Kec. Cidahu Kab. Kuningan', '081821485664'),
(2, 'warsim', 'f67989f0905c3113ac6d8885a7a536e9', 'Drs. Warsim Sofyandi', 'Desa Karangsari, Kec. Cimahi', '087821345681'),
(3, 'wasminta', '78c8dfa60ffff4871df3e5552129a7c7', 'Ir. Drs. Wasminta', 'Desa Ciuyah Kec. Waled Kab. Cirebon', '087821346781');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL,
  `id_guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`, `id_guru`) VALUES
(46, '10', 'Administrasi Perkantoran', 1),
(47, '10', 'Akuntansi', 2),
(48, '10', 'Rekayasa Perangkat Lunak', 3),
(49, '10', 'Teknik Bisnis Sepeda Motor', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `nisn` char(10) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `nobayar` varchar(20) DEFAULT NULL,
  `jatuh_tempo` date NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `ket` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `bulan`, `nobayar`, `jatuh_tempo`, `tgl_bayar`, `id_spp`, `jumlah_bayar`, `ket`) VALUES
(1, NULL, '78923', 'Mei 2020', NULL, '2020-05-10', NULL, 4, 225000, 'BELUM BAYAR'),
(2, NULL, '78923', 'Juni 2020', NULL, '2020-06-10', NULL, 4, 225000, 'BELUM BAYAR'),
(3, NULL, '78923', 'Juli 2020', NULL, '2020-07-10', NULL, 4, 225000, 'BELUM BAYAR'),
(4, NULL, '78923', 'Agustus 2020', NULL, '2020-08-10', NULL, 4, 225000, 'BELUM BAYAR'),
(5, NULL, '78923', 'September 2020', NULL, '2020-09-10', NULL, 4, 225000, 'BELUM BAYAR'),
(6, NULL, '78923', 'Oktober 2020', NULL, '2020-10-10', NULL, 4, 225000, 'BELUM BAYAR'),
(7, NULL, '78923', 'November 2020', NULL, '2020-11-10', NULL, 4, 225000, 'BELUM BAYAR'),
(8, NULL, '78923', 'Desember 2020', NULL, '2020-12-10', NULL, 4, 225000, 'BELUM BAYAR'),
(9, NULL, '78923', 'Januari 2021', NULL, '2021-01-10', NULL, 4, 225000, 'BELUM BAYAR'),
(10, NULL, '78923', 'Februari 2021', NULL, '2021-02-10', NULL, 4, 225000, 'BELUM BAYAR'),
(11, NULL, '78923', 'Maret 2021', NULL, '2021-03-10', NULL, 4, 225000, 'BELUM BAYAR'),
(12, NULL, '78923', 'April 2021', NULL, '2021-04-10', NULL, 4, 225000, 'BELUM BAYAR'),
(13, 2, '788882', 'Mei 2020', '2005300002', '2020-05-10', '2020-05-30', 1, 200000, 'LUNAS'),
(14, 2, '788882', 'Juni 2020', '2005300004', '2020-06-10', '2020-05-30', 1, 200000, 'LUNAS'),
(15, NULL, '788882', 'Juli 2020', NULL, '2020-07-10', NULL, 1, 200000, 'BELUM BAYAR'),
(16, NULL, '788882', 'Agustus 2020', NULL, '2020-08-10', NULL, 1, 200000, 'BELUM BAYAR'),
(17, NULL, '788882', 'September 2020', NULL, '2020-09-10', NULL, 1, 200000, 'BELUM BAYAR'),
(18, NULL, '788882', 'Oktober 2020', NULL, '2020-10-10', NULL, 1, 200000, 'BELUM BAYAR'),
(19, NULL, '788882', 'November 2020', NULL, '2020-11-10', NULL, 1, 200000, 'BELUM BAYAR'),
(20, NULL, '788882', 'Desember 2020', NULL, '2020-12-10', NULL, 1, 200000, 'BELUM BAYAR'),
(21, NULL, '788882', 'Januari 2021', NULL, '2021-01-10', NULL, 1, 200000, 'BELUM BAYAR'),
(22, NULL, '788882', 'Februari 2021', NULL, '2021-02-10', NULL, 1, 200000, 'BELUM BAYAR'),
(23, NULL, '788882', 'Maret 2021', NULL, '2021-03-10', NULL, 1, 200000, 'BELUM BAYAR'),
(24, NULL, '788882', 'April 2021', NULL, '2021-04-10', NULL, 1, 200000, 'BELUM BAYAR'),
(37, 2, '01234', 'Mei 2020', '2005290001', '2020-05-10', '2020-05-29', 4, 225000, 'LUNAS'),
(38, 2, '01234', 'Juni 2020', '2005290002', '2020-06-10', '2020-05-29', 4, 225000, 'LUNAS'),
(39, 2, '01234', 'Juli 2020', '2005290003', '2020-07-10', '2020-05-29', 4, 225000, 'LUNAS'),
(40, 2, '01234', 'Agustus 2020', '2005300001', '2020-08-10', '2020-05-30', 4, 225000, 'LUNAS'),
(41, 2, '01234', 'September 2020', '2006030001', '2020-09-10', '2020-06-03', 4, 225000, 'LUNAS'),
(42, 2, '01234', 'Oktober 2020', '2006030002', '2020-10-10', '2020-06-03', 4, 225000, 'LUNAS'),
(43, 6, '01234', 'November 2020', '2006080001', '2020-11-10', '2020-06-08', 4, 225000, 'LUNAS'),
(44, 6, '01234', 'Desember 2020', '2006080002', '2020-12-10', '2020-06-08', 4, 225000, 'LUNAS'),
(45, NULL, '01234', 'Januari 2021', NULL, '2021-01-10', NULL, 4, 225000, 'BELUM BAYAR'),
(46, NULL, '01234', 'Februari 2021', NULL, '2021-02-10', NULL, 4, 225000, 'BELUM BAYAR'),
(47, NULL, '01234', 'Maret 2021', NULL, '2021-03-10', NULL, 4, 225000, 'BELUM BAYAR'),
(48, NULL, '01234', 'April 2021', NULL, '2021-04-10', NULL, 4, 225000, 'BELUM BAYAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `alamat`, `telepon`, `level`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Asep Saepudin', 'Desa Ciuyah, Kec. Waled, Kab.Cirebon', '087821485664', 'admin'),
(5, 'Solikin_Tea', 'd01fd4411f53006b65a97f2e21b307d1', 'Muhammad Solikin', 'Desa Ciuyah, Kecamatan Waled', '085721485664', 'petugas'),
(6, 'petugas', '570c396b3fc856eceb8aa7357f32af1a', 'Muhammad Nasuha', 'Desa Cipicung, Kec. Cidahu, Kab. Kuningan', '0895372310562', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_hp`, `id_spp`) VALUES
('01234', '12345', 'Muhammad Fahri Hamzah', 49, 'Desa Rawamangun', '087821678213', 4),
('12345', '123456', 'Wahyudi Hamisi', 46, 'Desa Cikeusik Kidul, Kec. Cidahu Kab. Kuningan', '087821485664', 1),
('178827', '178829', 'Agni Khaerunisa', 48, 'Desa MulyaJaya', '087823456371', 2),
('234567', '2345678', 'Siti Maimunah', 47, 'Desa Cikulak Kidul, Gunung Lewu', '087822345671', 1),
('32011882', '32011882', 'Asep Saepudin', 48, 'Desa Ciuyah, Kec. Waled, Kab. Cirebon', '087821486578', 2),
('567819', '5678198', 'Arida Salsabila', 48, 'Desa Damarguna Kec. Ciledug kab. Cirebon', '087821345718', 2),
('788882', '7888825', 'Juni', 49, 'Desa Cibitung', '087887986713', 1),
('78923', '7892345', 'Sisi Prisilia', 49, 'Desa Cipicung', '089145626781', 4),
('78961', '7894561', 'Arman', 48, 'Desa Bojong, Kec. Pasaleman, Kab. Cirebon', '083821345162', 1),
('87281', '872816', 'Anto Susanto', 48, 'Desa Mulyajaya, Kec. Cimahi Kab. Kuningan', '0878213679281', 2),
('87282', '872845', 'Ahmad Firdaus Sulintang', 48, 'Desa Cipicung', '087821485664', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2019, 200000),
(2, 2018, 175000),
(4, 2020, 225000),
(5, 2021, 250000),
(6, 2022, 275000),
(8, 2019, 190000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_guru` (`id_guru`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_spp`
--
ALTER TABLE `tb_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD CONSTRAINT `tb_kelas_ibfk_1` FOREIGN KEY (`id_guru`) REFERENCES `tb_guru` (`id_guru`);

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_4` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_5` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_siswa_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
