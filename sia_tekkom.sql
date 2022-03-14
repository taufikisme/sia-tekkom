-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2022 at 09:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia_tekkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Taufik', 'mohtaufikafandi@gmail.com', '$2y$10$IAL3E2Gzvy8E2kN6w5m2R.mqurItyItIk1p2NJTuhbWH4LhcgoZgu'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$PtWQPmz4J1.LI7lzaN4iSOZHgz8QEleDmpY53oOcLIa8IBAXbSGiK');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(20) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `alamat`, `telp`, `is_delete`) VALUES
(1, 'John Doe, M.Kom.', 'Semarang', '12345', 0),
(2, 'Jane Doe, M.Eng.', 'Salatiga', '12345', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `semester` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jenis_kelamin`, `kota`, `provinsi`, `telp`, `status`, `angkatan`, `tgl_lahir`, `semester`, `is_delete`) VALUES
(1, 'Moh. Taufik Afandi', 'laki-laki', 'Semarang', 'Jawa Tengah', '085648341874', 'aktif', '2019', '2000-04-12', 5, 0),
(2, 'Barbarosa Simanjutak', 'laki-laki', 'Medan', 'Sumatera Utara', '12345', 'belum her-reg', '2019', '2000-01-01', 5, 0),
(3, 'Sandy Chicks', 'laki-laki', 'Bikini Bottom', 'Atlantic', '12345', 'cuti', '2019', '2000-11-26', 5, 0),
(4, 'S. Toni R.', 'laki-laki', 'Jember', 'Jawa Timur', '12345', 'non-aktif', '2019', '2000-11-26', 5, 1),
(5, 'Testing Mahasiswa', 'laki-laki', 'Semarang', 'Jawa Tengah', '12345', 'cuti', '2019', '2001-06-12', 5, 1),
(6, 'Patrick Star', 'laki-laki', 'Semarang', 'Jawa Tengah', '12345', 'aktif', '2019', '2000-02-10', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kode_mk` int(11) NOT NULL,
  `nama_mk` varchar(255) NOT NULL,
  `kuota_mk` int(11) NOT NULL,
  `sks_mk` int(11) NOT NULL,
  `status_mk` varchar(100) NOT NULL,
  `kurikulum_mk` varchar(100) NOT NULL,
  `semester_mk` int(11) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `nidn` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mk`, `nama_mk`, `kuota_mk`, `sks_mk`, `status_mk`, `kurikulum_mk`, `semester_mk`, `hari`, `waktu`, `nidn`, `is_delete`) VALUES
(1, 'Sistem Basis Data', 25, 2, 'ditawarkan', '2017', 5, 'senin', '10.40 WIB', 1, 0),
(2, 'Pemrograman Perangkat Bergerak', 20, 2, 'ditawarkan', '2017', 5, 'senin', '12.50 WIB', 2, 0),
(3, 'Kriptografi', 35, 3, 'ditawarkan', '2017', 5, 'Selasa', '13.00 WIB', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rencana_studi`
--

CREATE TABLE `rencana_studi` (
  `id` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `kode_mk` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT 1,
  `status` varchar(100) NOT NULL,
  `tahun_ajaran` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `nilai_mk` int(11) DEFAULT NULL,
  `status_persetujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rencana_studi`
--

INSERT INTO `rencana_studi` (`id`, `nim`, `kode_mk`, `id_admin`, `status`, `tahun_ajaran`, `semester`, `nilai_mk`, `status_persetujuan`) VALUES
(1, 1, 1, 1, 'wajib', '2020/2021', 4, NULL, 'disetujui'),
(11, 1, 2, 1, 'wajib', '2020/2021', 5, NULL, 'belum'),
(12, 1, 3, 1, 'perbaikan', '2020/2021', 5, NULL, 'belum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `rencana_studi`
--
ALTER TABLE `rencana_studi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `nidn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `nim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `kode_mk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rencana_studi`
--
ALTER TABLE `rencana_studi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
