-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 04:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mitigasi`
--

CREATE TABLE `mitigasi` (
  `id` int(11) NOT NULL,
  `resiko_id` int(11) NOT NULL,
  `mitigasi` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mitigasi`
--

INSERT INTO `mitigasi` (`id`, `resiko_id`, `mitigasi`, `solusi`) VALUES
(20, 31, 'Perkuat Iman', 'banyakin kajian'),
(21, 32, 'Perkuat Iman dan takwa', 'banyakin kajian ustadz');

-- --------------------------------------------------------

--
-- Table structure for table `resiko`
--

CREATE TABLE `resiko` (
  `id` int(3) NOT NULL,
  `resiko` varchar(100) NOT NULL,
  `divisi` enum('Keuangan','Kependidikan','Keamanan','Keagamaan') NOT NULL,
  `tingkat` enum('Tinggi','Sedang','Rendah') NOT NULL,
  `penyebab` varchar(100) NOT NULL,
  `sumber` enum('Internal','Eksternal') NOT NULL,
  `mitigasi` varchar(100) NOT NULL,
  `solusi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resiko`
--

INSERT INTO `resiko` (`id`, `resiko`, `divisi`, `tingkat`, `penyebab`, `sumber`, `mitigasi`, `solusi`) VALUES
(31, 'Keamanan data tambaha', 'Kependidikan', 'Sedang', 'Kurang dana', 'Eksternal', '', ''),
(32, 'Kebanyakan Tugas', 'Kependidikan', 'Tinggi', 'Gweh sudah mwak', 'Eksternal', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mitigasi`
--
ALTER TABLE `mitigasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resiko_id` (`resiko_id`);

--
-- Indexes for table `resiko`
--
ALTER TABLE `resiko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mitigasi`
--
ALTER TABLE `mitigasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `resiko`
--
ALTER TABLE `resiko`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mitigasi`
--
ALTER TABLE `mitigasi`
  ADD CONSTRAINT `mitigasi_ibfk_1` FOREIGN KEY (`resiko_id`) REFERENCES `resiko` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
