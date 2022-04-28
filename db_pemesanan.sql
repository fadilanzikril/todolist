-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2021 pada 21.07
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pemesanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_menu`
--

CREATE TABLE `data_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `status_menu` enum('Tersedia','Kosong','','') NOT NULL,
  `harga` int(25) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_menu`
--

INSERT INTO `data_menu` (`id_menu`, `nama_menu`, `status_menu`, `harga`, `gambar`) VALUES
(12, 'Gulai-taboh', 'Tersedia', 35200, 'Gulai-Taboh.jpg'),
(1234, 'Gulai-Tempoyak', 'Tersedia', 35000, 'Gulai-tempoyak.jpeg'),
(12345, 'Seruit-Lampung', 'Tersedia', 30000, 'seruit.jpg'),
(112233, 'Umbu', 'Kosong', 20000, 'Umbu.jpg'),
(123456, 'Lempok-durian', 'Kosong', 25000, 'lempok-durian.jpg'),
(1234567, 'Pisro', 'Tersedia', 27000, 'Pisro.jpg'),
(12345678, 'Pindang', 'Tersedia', 36000, 'pindang-lampung.jpg'),
(123456789, 'Geguduh', 'Kosong', 20000, 'Geguduh.jpg'),
(2147483647, 'Benjak-Enjak', 'Tersedia', 24000, 'Benjak-Enjak.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_menu`
--

CREATE TABLE `pesan_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_menu` varchar(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `jumlah` int(200) NOT NULL,
  `total` int(200) NOT NULL,
  `waktu` date NOT NULL,
  `status` varchar(200) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `telepon` varchar(200) NOT NULL,
  `email` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan_menu`
--

INSERT INTO `pesan_menu` (`id`, `nama_menu`, `harga`, `jumlah`, `total`, `waktu`, `status`, `nama_lengkap`, `telepon`, `email`, `alamat`) VALUES
(19, 'Gulai-taboh', 35200, 12, 422400, '2021-11-24', 'Di Pemesanan', 'Fadilahn Dzikril', '081388289012', 'fz23@gmail.com', 'ds.asrama kalibening'),
(25, 'Umbu', 20000, 1, 20000, '2021-11-24', 'Di Pemesanan', 'Fadil', '123', 'fz23@gmail.com', 'ds.asrama kalibening');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(2, 'zikril', 'user', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'Fadilahn Dzikril', 'admin', '202cb962ac59075b964b07152d234b70', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_menu`
--
ALTER TABLE `data_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pesan_menu`
--
ALTER TABLE `pesan_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_menu`
--
ALTER TABLE `data_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT untuk tabel `pesan_menu`
--
ALTER TABLE `pesan_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
