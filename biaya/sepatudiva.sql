-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 15 Sep 2017 pada 08.05
-- Versi Server: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sepatudiva`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya`
--

CREATE TABLE `biaya` (
  `id_biaya` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kategori_id` int(3) NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` text NOT NULL,
  `status_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` int(11) NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `kategori_id` int(5) NOT NULL,
  `kreditur_hutang` varchar(50) NOT NULL,
  `jumlah_hutang` double NOT NULL,
  `keterangan_hutang` text NOT NULL,
  `status_hutang` enum('belum lunas','lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hutang`
--

INSERT INTO `hutang` (`id_hutang`, `tanggal_hutang`, `kategori_id`, `kreditur_hutang`, `jumlah_hutang`, `keterangan_hutang`, `status_hutang`) VALUES
(1, '2017-09-15', 1, 'eko', 1000000, 'Pembayaran SPP Anak', 'belum lunas'),
(2, '2017-09-14', 2, 'okda', 500000, 'Pembelian Pulsa', 'lunas'),
(3, '2017-09-14', 2, 'okda', 500000, 'Pembelian Pulsa', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'operasional'),
(2, 'transportasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `nama`, `alamat`) VALUES
(1, 'admin', '$2y$10$2bmwVKjIGZx1HYGKEtAs9eYHr3izLHD/4biQI1YOhkvMYrZj.SJBG', 'administrator', 'Tomang Banjir Kanal No. 30 Rt. 004/013, , Penjaringan, Jakarta Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang`
--

CREATE TABLE `piutang` (
  `id_piutang` int(11) NOT NULL,
  `tanggal_piutang` date NOT NULL,
  `kategori_id` int(5) NOT NULL,
  `kreditur_piutang` varchar(50) NOT NULL,
  `jumlah_piutang` double NOT NULL,
  `keterangan_piutang` text NOT NULL,
  `status_piutang` enum('belum lunas','lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `piutang`
--

INSERT INTO `piutang` (`id_piutang`, `tanggal_piutang`, `kategori_id`, `kreditur_piutang`, `jumlah_piutang`, `keterangan_piutang`, `status_piutang`) VALUES
(1, '2017-09-14', 1, 'Abdul', 1000000, 'Pembayaran tiket pesawat', 'belum lunas'),
(2, '2017-09-15', 2, 'Somad', 550000, 'Pembayaran kursi', 'lunas'),
(3, '2017-09-15', 2, 'Somad', 550000, 'Pembayaran kursi', 'lunas'),
(4, '2017-09-15', 1, 'Satya', 500000, 'bla...', 'belum lunas'),
(5, '2017-09-15', 2, 'Gama', 560000, 'bal..bla...bla....', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id_status` int(2) NOT NULL,
  `nama_status` varchar(15) NOT NULL,
  `label_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id_status`, `nama_status`, `label_status`) VALUES
(1, 'belum lunas', 'fa-warning'),
(2, 'lunas', 'fa-success');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya`
--
ALTER TABLE `biaya`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id_piutang`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya`
--
ALTER TABLE `biaya`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id_hutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
