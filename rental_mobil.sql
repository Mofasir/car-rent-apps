-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2024 pada 03.31
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_biaya_rental`
--

CREATE TABLE `t_biaya_rental` (
  `id` int(11) NOT NULL,
  `nama_penyewa` varchar(100) DEFAULT NULL,
  `nama_mobil` varchar(50) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `biaya` decimal(10,2) DEFAULT NULL,
  `lama_sewa` int(11) DEFAULT NULL,
  `biaya_paket1` decimal(10,2) DEFAULT NULL,
  `biaya_paket2` decimal(10,2) DEFAULT NULL,
  `biaya_paket3` decimal(10,2) DEFAULT NULL,
  `biaya_harian` decimal(10,2) DEFAULT NULL,
  `biaya_extra` decimal(10,2) DEFAULT NULL,
  `total_biaya` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_biaya_rental`
--

INSERT INTO `t_biaya_rental` (`id`, `nama_penyewa`, `nama_mobil`, `program`, `biaya`, `lama_sewa`, `biaya_paket1`, `biaya_paket2`, `biaya_paket3`, `biaya_harian`, `biaya_extra`, `total_biaya`) VALUES
(1, 'Faikar', 'Avanza', 'Harian', '640000.00', 3, '0.00', '0.00', '0.00', '1920000.00', '200000.00', '2120000.00'),
(2, 'Fira', 'New Altis', 'Paket 1', '1500000.00', 4, '5400000.00', '0.00', '0.00', '0.00', '0.00', '5400000.00'),
(3, 'Abi', 'New Camry', 'Paket 2', '2190000.00', 7, '0.00', '12264000.00', '0.00', '0.00', '0.00', '12264000.00'),
(4, 'Fira', 'Avanza', 'Paket 3', '640000.00', 10, '0.00', '0.00', '4800000.00', '0.00', '200000.00', '5000000.00'),
(5, 'Rizki', 'Innova', 'Harian', '890000.00', 5, '0.00', '0.00', '0.00', '4450000.00', '0.00', '4450000.00'),
(6, 'Ardhan', 'Alphard', 'Paket 1', '3220000.00', 4, '11592000.00', '0.00', '0.00', '0.00', '200000.00', '11792000.00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_biaya_rental`
--
ALTER TABLE `t_biaya_rental`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_biaya_rental`
--
ALTER TABLE `t_biaya_rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
