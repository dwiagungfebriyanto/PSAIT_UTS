-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 05:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sait_db_uts`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `data_mahasiswa`
-- (See below for the actual view)
--
CREATE TABLE `data_mahasiswa` (
`nim` varchar(10)
,`nama` varchar(20)
,`alamat` varchar(40)
,`tanggal_lahir` date
,`kode_mk` varchar(10)
,`nama_mk` varchar(20)
,`sks` int(2)
,`nilai` double
);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_001', 'joko', 'bantul', '1999-12-07'),
('sv_002', 'paul', 'sleman', '2000-10-07'),
('sv_003', 'andy', 'surabaya', '2000-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(20) NOT NULL,
  `sks` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_001', 'database', 2),
('svpl_002', 'kecerdasan artifisia', 2),
('svpl_003', 'interoperabilitas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `perkuliahan`
--

CREATE TABLE `perkuliahan` (
  `id_perkuliahan` int(5) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `kode_mk` varchar(10) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perkuliahan`
--

INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(1, 'sv_001', 'svpl_001', 90),
(2, 'sv_001', 'svpl_002', 87),
(3, 'sv_001', 'svpl_003', 88),
(4, 'sv_002', 'svpl_001', 100),
(5, 'sv_002', 'svpl_002', 78);

-- --------------------------------------------------------

--
-- Structure for view `data_mahasiswa`
--
DROP TABLE IF EXISTS `data_mahasiswa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_mahasiswa`  AS SELECT `perkuliahan`.`nim` AS `nim`, `mahasiswa`.`nama` AS `nama`, `mahasiswa`.`alamat` AS `alamat`, `mahasiswa`.`tanggal_lahir` AS `tanggal_lahir`, `perkuliahan`.`kode_mk` AS `kode_mk`, `matakuliah`.`nama_mk` AS `nama_mk`, `matakuliah`.`sks` AS `sks`, `perkuliahan`.`nilai` AS `nilai` FROM ((`perkuliahan` join `matakuliah` on(`perkuliahan`.`kode_mk` = `matakuliah`.`kode_mk`)) join `mahasiswa` on(`mahasiswa`.`nim` = `perkuliahan`.`nim`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD PRIMARY KEY (`id_perkuliahan`),
  ADD KEY `FK_MAHASISWA` (`nim`),
  ADD KEY `FK_MATAKULIAH` (`kode_mk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  MODIFY `id_perkuliahan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perkuliahan`
--
ALTER TABLE `perkuliahan`
  ADD CONSTRAINT `FK_MAHASISWA` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MATAKULIAH` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode_mk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
