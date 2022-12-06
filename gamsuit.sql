-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 04:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamsuit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pemain`
--

CREATE TABLE `tabel_pemain` (
  `id_pemain` int(11) NOT NULL,
  `nama_pemain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pemenang`
--

CREATE TABLE `tabel_pemenang` (
  `id_pemenang` int(11) NOT NULL,
  `id_pertandingan` int(11) NOT NULL,
  `ronde` int(11) NOT NULL,
  `id_pemain` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pemenang_pertandingan`
--

CREATE TABLE `tabel_pemenang_pertandingan` (
  `id_pemenang_pertandingan` int(11) NOT NULL,
  `id_pertandingan` int(11) NOT NULL,
  `id_pemain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pertandingan`
--

CREATE TABLE `tabel_pertandingan` (
  `id_pertandingan` int(11) NOT NULL,
  `id_pemain_1` int(11) NOT NULL,
  `id_pemain_2` int(11) DEFAULT NULL,
  `status_pertandingan` enum('Belum mulai','Sedang bermain','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_rincian_pertandingan`
--

CREATE TABLE `tabel_rincian_pertandingan` (
  `id_rincian_pertandingan` int(11) NOT NULL,
  `id_pertandingan` int(11) NOT NULL,
  `ronde` int(11) NOT NULL,
  `pilihan_pemain` enum('Batu','Gunting','Kertas') DEFAULT NULL,
  `id_pemain` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pemain`
--
ALTER TABLE `tabel_pemain`
  ADD PRIMARY KEY (`id_pemain`);

--
-- Indexes for table `tabel_pemenang`
--
ALTER TABLE `tabel_pemenang`
  ADD PRIMARY KEY (`id_pemenang`),
  ADD KEY `pemenang_pertandingan` (`id_pertandingan`),
  ADD KEY `pemenang` (`id_pemain`);

--
-- Indexes for table `tabel_pemenang_pertandingan`
--
ALTER TABLE `tabel_pemenang_pertandingan`
  ADD PRIMARY KEY (`id_pemenang_pertandingan`),
  ADD KEY `id_pertandingan_pemenang` (`id_pertandingan`),
  ADD KEY `id_pemain_pemenang` (`id_pemain`);

--
-- Indexes for table `tabel_pertandingan`
--
ALTER TABLE `tabel_pertandingan`
  ADD PRIMARY KEY (`id_pertandingan`),
  ADD KEY `pemain_1` (`id_pemain_1`),
  ADD KEY `pemain_2` (`id_pemain_2`);

--
-- Indexes for table `tabel_rincian_pertandingan`
--
ALTER TABLE `tabel_rincian_pertandingan`
  ADD PRIMARY KEY (`id_rincian_pertandingan`),
  ADD KEY `id_pertandingan` (`id_pertandingan`),
  ADD KEY `id_pemain` (`id_pemain`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pemain`
--
ALTER TABLE `tabel_pemain`
  MODIFY `id_pemain` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_pemenang`
--
ALTER TABLE `tabel_pemenang`
  MODIFY `id_pemenang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_pemenang_pertandingan`
--
ALTER TABLE `tabel_pemenang_pertandingan`
  MODIFY `id_pemenang_pertandingan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_pertandingan`
--
ALTER TABLE `tabel_pertandingan`
  MODIFY `id_pertandingan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabel_rincian_pertandingan`
--
ALTER TABLE `tabel_rincian_pertandingan`
  MODIFY `id_rincian_pertandingan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_pemenang`
--
ALTER TABLE `tabel_pemenang`
  ADD CONSTRAINT `pemenang` FOREIGN KEY (`id_pemain`) REFERENCES `tabel_pemain` (`id_pemain`),
  ADD CONSTRAINT `pemenang_pertandingan` FOREIGN KEY (`id_pertandingan`) REFERENCES `tabel_pertandingan` (`id_pertandingan`);

--
-- Constraints for table `tabel_pemenang_pertandingan`
--
ALTER TABLE `tabel_pemenang_pertandingan`
  ADD CONSTRAINT `id_pemain_pemenang` FOREIGN KEY (`id_pemain`) REFERENCES `tabel_pemain` (`id_pemain`),
  ADD CONSTRAINT `id_pertandingan_pemenang` FOREIGN KEY (`id_pertandingan`) REFERENCES `tabel_pertandingan` (`id_pertandingan`);

--
-- Constraints for table `tabel_pertandingan`
--
ALTER TABLE `tabel_pertandingan`
  ADD CONSTRAINT `pemain_1` FOREIGN KEY (`id_pemain_1`) REFERENCES `tabel_pemain` (`id_pemain`),
  ADD CONSTRAINT `pemain_2` FOREIGN KEY (`id_pemain_2`) REFERENCES `tabel_pemain` (`id_pemain`);

--
-- Constraints for table `tabel_rincian_pertandingan`
--
ALTER TABLE `tabel_rincian_pertandingan`
  ADD CONSTRAINT `id_pemain` FOREIGN KEY (`id_pemain`) REFERENCES `tabel_pemain` (`id_pemain`),
  ADD CONSTRAINT `id_pertandingan` FOREIGN KEY (`id_pertandingan`) REFERENCES `tabel_pertandingan` (`id_pertandingan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
