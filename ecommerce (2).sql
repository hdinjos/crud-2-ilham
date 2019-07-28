-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 06:37 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(13, 'Gadget'),
(14, 'Fashion'),
(15, 'Olahraga'),
(16, 'Furniture'),
(17, 'Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id` int(10) NOT NULL,
  `nama_merk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id`, `nama_merk`) VALUES
(4, 'Samsul'),
(5, 'Xioami'),
(7, 'BJ Home'),
(8, 'Levi\'s'),
(9, 'INtel');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(10) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `warna` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `id_merk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `warna`, `jumlah`, `harga`, `id_kategori`, `id_merk`) VALUES
(78623873, 'Samsung Galaxy S8+', 'Prism Blac', 100, 8500000, 13, 4),
(78623876, 'Levi\'s Jeans', 'Biru', 5, 100000, 14, 8),
(78623877, 'Monitor', 'Hitam', 100, 500000, 13, 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
('admin', 'Administrator'),
('pelanggan', 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `status` enum('dipesan','dikirim') NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_produk`, `id_user`, `jumlah_transaksi`, `total_transaksi`, `status`, `tanggal_transaksi`) VALUES
(988008, 78623875, 89811, 10, 6000000, 'dipesan', '2019-07-24 16:27:46'),
(988009, 78623876, 89812, 5, 500000, 'dipesan', '2019-07-24 17:56:44'),
(988010, 78623873, 0, 5, 42500000, 'dipesan', '2019-07-25 01:55:48'),
(988012, 78623877, 89811, 5, 2500000, 'dikirim', '2019-07-25 03:10:53'),
(988013, 78623873, 89811, 1, 8500000, 'dikirim', '2019-07-25 03:18:29'),
(988014, 78623877, 89816, 3000, 1500000000, 'dikirim', '2019-07-25 03:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` enum('admin','pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `alamat`, `jenis_kelamin`, `username`, `password`, `role_id`) VALUES
(89810, 'Ilham Syah', 'Bantul, Yogyakarta, ID', 'L', 'swegger', '$2y$10$Eio/DaB2MP4ORtolO4RXPe6FSXMC.mZVo5Tg3JWyrvoidVdy6GuNy', 'admin'),
(89811, 'Amir Musa Baharsyah', 'Sleman, ID', 'L', 'ambaharsyah', '$2y$10$QKmzBH/RBOELU9l1rNC88O1stoN/msUp8NI95zrbW24YKDM31YxSa', 'pelanggan'),
(89815, 'fajarsyah', 'Magelang, ID', 'L', 'fajarsyah', '$2y$10$.wg.teF.RUD3BXoEFPn4E..EguMU0VUaL/VJLmesSrFtnJtdM86Pq', 'admin'),
(89816, 'fajarbro', 'Yogyakarta, ID', 'L', 'fajarbro', '$2y$10$zESZ4PmBv/p0fCaB.CreL.Ngpg5i/mdDQnfk8I0i7YF1FrXzntZLy', 'pelanggan'),
(89817, '', '', 'L', '', '$2y$10$11pyoZAOylz2H1CqfkQV..Z/mkpuvfErVVM0w.fPfSXrqjHH8bRiW', 'admin'),
(89818, '', '', 'L', 'admin', '$2y$10$LNU8oEV3oFhzt61nITajC.h9OlHxAa/fMHgWJH2oGMawzZgAC.o4y', 'admin'),
(89819, 'Johar', '', 'L', 'adminjohar', '$2y$10$UocZPZVASfHq..WJNgElHuAd8A80tcljVSK/yNAk8w9Z6ktSidGIG', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_kategori` (`id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_produk` (`id`),
  ADD KEY `id_merk` (`id_merk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pelanggan` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78623878;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=988015;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89820;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
