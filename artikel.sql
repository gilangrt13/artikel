-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2024 at 03:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artikel`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `Id_Artikel` int UNSIGNED NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `judul` varchar(250) DEFAULT NULL,
  `sumber` varchar(50) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`Id_Artikel`, `gambar`, `deskripsi`, `judul`, `sumber`, `penulis`, `tanggal`) VALUES
(1, '6751bcac6fa68-okezone.jpg', 'Masyarakat Malaysia di media sosial meledek Timnas Indonesia yang tak lolos ke babak ketiga Kualifikasi Piala Asia 2027. Mereka kompak mengomentari salah satu unggahan yang membagikan pot drawing babak ketiga Kualifikasi Piala Asia 2027.', 'Masyarakat Malaysia Ledek Timnas Indonesia yang Tak Lolos Babak Ketiga Kualifikasi Piala Asia 2027, Malah Blunder!', 'bola.okezone.com', 'Ramdani Bur, Okezone', '2024-12-05'),
(2, '6751beefa1623-bolasport.jpg', 'Timnas Vietnam resmi mengumumkan skuad resmi untuk mengarungi turnamen ASEAN Cup 2024.\r\nKabar tersebut dikonfirmasi dari akun Facebook resmi milik Federasi Sepak Bola Vietnam (VFF) pada Kamis (5/12/2024).', 'Jelang Jumpa Timnas Indonesia, Vietnam Resmi Umumkan 26 Pemain Untuk ASEAN Cup 2024', 'bolasport.com', ' Sasongko Dwi Saputro', '2024-12-05'),
(4, '6751c00e353dc-justin.jpeg', 'Bek Timnas Indonesia, Justin Hubner, mengejutkan publik dikabarkan dia akan meninggalkan Wolverhampton Wanderers U-21 pada akhir musim ini. Keputusan ini diambil karena minimnya waktu bermain yang diberikan kepadanya sepanjang musim.', 'Justin Hubner: Gila Bek Terbaik di Sini Tidak Mendapat Kesempatan Bermain', 'Suara.com', 'Pebriansyah Ariefana', '2024-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin', '$2y$10$AFbcWqUA6GVGH6DxKT.Omuz3s9e/AKoWUdy9DXr.0ufizj1luOa6O'),
(3, 'admin', '$2y$10$VM3IYBeBdh7s98eKvt7IMOal0mh1UK/bwad1sLslLwyOcN8mAywIW'),
(4, 'admin', '$2y$10$CHFDgKOzm/LThhAEMZ5Ztehe3QEymFNeUX98IyuUOIj5mVvNl/5hW'),
(5, 'gilang', '$2y$10$vmCB0SdBHMJeUhIGCNPSX.T1.R8XNXbTNY9SKYzDSs5ynl/KidsZ6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`Id_Artikel`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `Id_Artikel` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
