-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 05:45 AM
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
-- Database: `inventory_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kodeBarang` varchar(50) NOT NULL,
  `namaBarang` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kodeBarang`, `namaBarang`, `stok`, `harga`) VALUES
('Hand Sanitizer', '8994096225046', '50', '150000'),
('Hand Sanitizer', '89940962250467', '50', '150000'),
('8994096225046', 'Gula', '30', '150000'),
('89940962250467', 'Hand Sanitizer', '50', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `kodeBayar` varchar(100) NOT NULL,
  `tglPenjualan` varchar(100) NOT NULL,
  `kasir` varchar(100) NOT NULL,
  `totalBayar` int(11) NOT NULL,
  `metodeBayar` varchar(100) NOT NULL,
  `jumlahBayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`kodeBayar`, `tglPenjualan`, `kasir`, `totalBayar`, `metodeBayar`, `jumlahBayar`, `kembali`) VALUES
('TRX-20250427-141305-549', '27-04-2025 14:13', '', 40000, '', 100000, 60000),
('TRX-20250427-141305-549', '27-04-2025 14:13', '', 40000, '', 100000, 60000),
('TRX-20250427-141508-117', '27-04-2025 14:15', '', 40000, '', 100000, 60000),
('TRX-20250427-144543-160', '27-04-2025 14:45', '', 60000, 'Tunai', 100000, 40),
('TRX-20250427-150212-819', '27-04-2025 15:02', '', 180000, 'Tunai', 200000, 20),
('TRX-20250427-150454-371', '27-04-2025 15:04', '', 180000, 'Tunai', 3, -179),
('', '', '', 360000, 'Tunai', 400000, 40);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`username`, `password`) VALUES
('admin', 'admin123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
