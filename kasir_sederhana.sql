-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 03:08 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_sederhana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(1) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `nonota` varchar(10) DEFAULT NULL,
  `kode` varchar(8) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `jumlah` int(8) DEFAULT NULL,
  `subtotal` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`nonota`, `kode`, `harga`, `jumlah`, `subtotal`) VALUES
('1', 'brg02', 55000, 1, 55000),
('1', 'brg02', 55000, 1, 55000),
('2', 'brg02', 55000, 2, 110000),
('2', 'K02', 3000, 2, 6000),
('3', 'K02', 3000, 1, 3000),
('4', 'K02', 3000, 4, 12000),
('4', 'Kmn02', 200, 2, 400),
('5', 'K02', 3000, 3, 9000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `nonota` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`nonota`, `tanggal`, `total`) VALUES
('1', '2013-01-17', 55000);

-- --------------------------------------------------------

--
-- Table structure for table `tblbarang`
--

CREATE TABLE `tblbarang` (
  `kode` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `hrg_beli` int(10) NOT NULL,
  `hrg_jual` int(10) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`kode`, `nama`, `hrg_beli`, `hrg_jual`, `stok`) VALUES
('12', '121', 12, 21, 3),
('123', '123', 12, 121, 1),
('brg02', 'Sepatu', 55000, 60000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblsementara`
--

CREATE TABLE `tblsementara` (
  `kode` varchar(30) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `jumlah` int(8) DEFAULT NULL,
  `subtotal` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsementara`
--

INSERT INTO `tblsementara` (`kode`, `nama`, `harga`, `jumlah`, `subtotal`) VALUES
('12', '121', 12, 2, 24),
('123', '123', 12, 1, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`nonota`);

--
-- Indexes for table `tblbarang`
--
ALTER TABLE `tblbarang`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
