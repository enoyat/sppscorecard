-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jul 2023 pada 11.34
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scorecard`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beritaacara`
--

DROP TABLE IF EXISTS `beritaacara`;
CREATE TABLE IF NOT EXISTS `beritaacara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengirim` varchar(10) NOT NULL,
  `penerima` varchar(10) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tanggalterima` date DEFAULT NULL,
  `namapenerima` varchar(100) DEFAULT NULL,
  `tanggalkembali` date DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `statuspengirim` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbu`
--

DROP TABLE IF EXISTS `cbu`;
CREATE TABLE IF NOT EXISTS `cbu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namacbu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cbu`
--

INSERT INTO `cbu` (`id`, `namacbu`) VALUES
(1, 'SN'),
(999, 'AQUA'),
(1001, 'SPP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `serialnumber` varchar(50) DEFAULT NULL,
  `idforklifttype` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `masheight` int(11) DEFAULT NULL,
  `dateestimated` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `mitigationplan` text DEFAULT NULL,
  `dateactual` date DEFAULT NULL,
  `confirmationplan` text DEFAULT NULL,
  `statusspp` varchar(10) NOT NULL DEFAULT 'open',
  `statuscustomer` varchar(10) NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumenmaintenance`
--

DROP TABLE IF EXISTS `dokumenmaintenance`;
CREATE TABLE IF NOT EXISTS `dokumenmaintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `idaction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentrouble`
--

DROP TABLE IF EXISTS `dokumentrouble`;
CREATE TABLE IF NOT EXISTS `dokumentrouble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `idaction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forklifttype`
--

DROP TABLE IF EXISTS `forklifttype`;
CREATE TABLE IF NOT EXISTS `forklifttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaforklifttype` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `forklifttype`
--

INSERT INTO `forklifttype` (`id`, `namaforklifttype`) VALUES
(1, 'COUNTER BALANCE'),
(2, 'REACH TRUCK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `listoftrouble`
--

DROP TABLE IF EXISTS `listoftrouble`;
CREATE TABLE IF NOT EXISTS `listoftrouble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `kdunit` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `issue` text DEFAULT NULL,
  `documentation` varchar(50) DEFAULT NULL,
  `targetcompletedate` date DEFAULT NULL,
  `actionplanspp` text DEFAULT NULL,
  `actualcompletedate` date DEFAULT NULL,
  `lapsetime` int(11) DEFAULT NULL,
  `confirmationplan` text DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT 'OPEN',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `loglogin`
--

DROP TABLE IF EXISTS `loglogin`;
CREATE TABLE IF NOT EXISTS `loglogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `loglogin`
--

INSERT INTO `loglogin` (`id`, `email`, `created_at`, `updated_at`) VALUES
(4, 'admin@gmail.com', '2023-07-03 23:53:14', '2023-07-03 23:53:14'),
(5, 'admin@gmail.com', '2023-07-03 23:59:49', '2023-07-03 23:59:49'),
(6, 'admin@gmail.com', '2023-07-04 01:10:36', '2023-07-04 01:10:36'),
(7, 'admin@gmail.com', '2023-07-04 02:22:16', '2023-07-04 02:22:16'),
(8, 'admin@gmail.com', '2023-07-04 02:46:07', '2023-07-04 02:46:07'),
(9, 'admin@gmail.com', '2023-07-04 03:22:34', '2023-07-04 03:22:34'),
(10, 'admin@gmail.com', '2023-07-04 05:01:37', '2023-07-04 05:01:37'),
(11, 'manajerallsite@gmail.com', '2023-07-04 05:03:57', '2023-07-04 05:03:57'),
(12, 'admin@gmail.com', '2023-07-04 05:04:04', '2023-07-04 05:04:04'),
(13, 'admin@gmail.com', '2023-07-04 05:10:09', '2023-07-04 05:10:09'),
(14, 'admin@gmail.com', '2023-07-04 07:21:01', '2023-07-04 07:21:01'),
(15, 'admin@gmail.com', '2023-07-04 18:17:34', '2023-07-04 18:17:34'),
(16, 'admin@gmail.com', '2023-07-04 18:26:31', '2023-07-04 18:26:31'),
(17, 'admin@gmail.com', '2023-07-04 18:52:53', '2023-07-04 18:52:53'),
(18, 'admin@gmail.com', '2023-07-04 22:15:55', '2023-07-04 22:15:55'),
(19, 'admin@gmail.com', '2023-07-04 23:55:09', '2023-07-04 23:55:09'),
(20, 'admin@gmail.com', '2023-07-06 22:22:31', '2023-07-06 22:22:31'),
(21, 'admin@gmail.com', '2023-07-07 01:45:43', '2023-07-07 01:45:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `kdunit` varchar(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hm` int(11) DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT 'OPEN',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenanceaction`
--

DROP TABLE IF EXISTS `maintenanceaction`;
CREATE TABLE IF NOT EXISTS `maintenanceaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kdunit` varchar(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggalmulai` date DEFAULT NULL,
  `tanggalakhir` date DEFAULT NULL,
  `shift` varchar(20) DEFAULT NULL,
  `actionplan` text DEFAULT NULL,
  `sparepart` text DEFAULT NULL,
  `hm` int(11) DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kdunit` (`kdunit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `maintenanceaction`
--

INSERT INTO `maintenanceaction` (`id`, `kdunit`, `iduser`, `tanggalmulai`, `tanggalakhir`, `shift`, `actionplan`, `sparepart`, `hm`, `statusmekanik`) VALUES
(2, '19-181', 1, '2023-07-28', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mekanik`
--

DROP TABLE IF EXISTS `mekanik`;
CREATE TABLE IF NOT EXISTS `mekanik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `namamekanik` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'male',
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nohp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mekanik`
--

INSERT INTO `mekanik` (`id`, `userid`, `namamekanik`, `gender`, `address`, `nohp`, `idsitename`, `created_at`, `updated_at`) VALUES
(5, 116, 'mekanik', 'male', NULL, NULL, 2, NULL, NULL),
(6, 122, 'Ardiyan Saputra', 'male', NULL, NULL, 999, NULL, NULL),
(7, 123, 'Danang Dwiyanto', 'male', NULL, NULL, 999, NULL, NULL),
(8, 124, 'Adib Budi Setyawan', 'male', NULL, NULL, 999, NULL, NULL),
(9, 125, 'Mardi Kusumo', 'male', NULL, NULL, 999, NULL, NULL),
(10, 126, 'Budi Prasetyo', 'male', NULL, NULL, 999, NULL, NULL),
(11, 127, 'Syahruddin', 'male', NULL, NULL, 999, NULL, NULL),
(12, 128, 'Agus Supriyanto', 'male', NULL, NULL, 999, NULL, NULL),
(13, 129, 'Markus Ibnu Pramono', 'male', NULL, NULL, 999, NULL, NULL),
(14, 130, 'Stefanus Niko Efendi', 'male', NULL, NULL, 999, NULL, NULL),
(16, 132, 'Yohanes Hari Tri Susilo', 'male', NULL, NULL, 1, NULL, NULL),
(17, 133, 'Syahrian Riza Maramis', 'male', NULL, NULL, 1, NULL, NULL),
(18, 134, 'Adytya Mandra Kusuma', 'male', NULL, NULL, 1000, NULL, NULL),
(19, 135, 'Arga Resmayudha', 'male', NULL, NULL, 1000, NULL, NULL),
(20, 136, 'Wahyu Tegar Prasetya', 'male', NULL, NULL, 1000, NULL, NULL),
(21, 137, 'Najib', 'male', NULL, NULL, 1000, NULL, NULL),
(22, 138, 'Pebriyansah', 'male', NULL, NULL, 1015, NULL, NULL),
(23, 139, 'Ichwan Zakiatudin', 'male', NULL, NULL, 1012, NULL, NULL),
(24, 140, 'Apip Zakaria', 'male', NULL, NULL, 1015, NULL, NULL),
(25, 141, 'Adam Munandar', 'male', NULL, NULL, 1011, NULL, NULL),
(26, 142, 'Sigi Migel Mondoringin', 'male', NULL, NULL, 1019, NULL, NULL),
(27, 143, 'Franky', 'male', NULL, NULL, 1019, NULL, NULL),
(28, 144, 'Qilas Sulis Pratama', 'male', NULL, NULL, 1009, NULL, NULL),
(29, 145, 'Krisdi Ambika Syahputra', 'male', NULL, NULL, 1006, NULL, NULL),
(30, 146, 'Arif Riyan Dermawan', 'male', NULL, NULL, 1008, NULL, NULL),
(31, 148, 'Yang Yang', 'male', NULL, NULL, 1022, NULL, NULL),
(32, 149, 'Riconaldi Pasaribu', 'male', NULL, NULL, 1007, NULL, NULL),
(33, 150, 'Cecep Purnairawan', 'male', NULL, NULL, 1013, NULL, NULL),
(34, 151, 'Mustakim', 'male', NULL, NULL, 1003, NULL, NULL),
(35, 152, 'I Komang Arya Wedana', 'male', NULL, NULL, 1003, NULL, NULL),
(36, 153, 'Samsul Arifin', 'male', NULL, NULL, 1003, NULL, NULL),
(37, 154, 'Teguh Fathur Rohman', 'male', NULL, NULL, 1003, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `office`
--

DROP TABLE IF EXISTS `office`;
CREATE TABLE IF NOT EXISTS `office` (
  `idoffice` varchar(10) NOT NULL,
  `namaoffice` varchar(100) NOT NULL,
  PRIMARY KEY (`idoffice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `office`
--

INSERT INTO `office` (`idoffice`, `namaoffice`) VALUES
('O001', 'Jawa Tengah dan DIY'),
('O002', 'Jakarta'),
('O003', 'Jawa Timur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pallete`
--

DROP TABLE IF EXISTS `pallete`;
CREATE TABLE IF NOT EXISTS `pallete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `jenisrequest` enum('Withdrawal','Delivery') DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `daterequest` date DEFAULT NULL,
  `targetdate` date DEFAULT NULL,
  `actualdate` date DEFAULT NULL,
  `lapsetime` int(11) DEFAULT NULL,
  `gap` int(11) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `palleterenew`
--

DROP TABLE IF EXISTS `palleterenew`;
CREATE TABLE IF NOT EXISTS `palleterenew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `totalrent` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `physicalavailable`
--

DROP TABLE IF EXISTS `physicalavailable`;
CREATE TABLE IF NOT EXISTS `physicalavailable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `periode` varchar(7) DEFAULT NULL,
  `kdunit` varchar(10) DEFAULT NULL,
  `harikerja` int(11) DEFAULT NULL,
  `planunitkerja` int(11) DEFAULT NULL,
  `totalbreakdown` int(11) DEFAULT 0,
  `totaljamkerja` int(11) DEFAULT 0,
  `paforklift` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `kdunit` (`kdunit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `physicalavailable`
--

INSERT INTO `physicalavailable` (`id`, `idcbu`, `idregion`, `idsitename`, `periode`, `kdunit`, `harikerja`, `planunitkerja`, `totalbreakdown`, `totaljamkerja`, `paforklift`) VALUES
(2, 999, 1000, 1001, '2023-07', '19-181', 31, 44640, 0, 44640, 100),
(3, 999, 1000, 1001, '2023-07', '19-181', 31, 44640, 0, 44640, 100),
(4, 999, 1000, 1001, '2023-07', '19-181', 30, 44640, 0, 44640, 100),
(5, 999, 1000, 1000, '2023-07', 'E7170', 31, 44640, 0, 44640, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaregion` varchar(100) NOT NULL,
  `idcbu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1009 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `region`
--

INSERT INTO `region` (`id`, `namaregion`, `idcbu`) VALUES
(1, 'SN West', 1),
(999, 'SN East', 1),
(1000, 'Aqua R3', 999),
(1001, 'Aqua R4', 999),
(1002, 'Aqua R1', 999),
(1003, 'Aqua R2', 999),
(1007, 'SPP Plant', 1001),
(1008, 'SPP Pusat', 1001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '2020-12-22 02:12:09', '2020-12-22 02:12:09'),
(2, 'manajersite', '2020-12-22 02:12:09', '2020-12-22 02:12:09'),
(3, 'mekanik', NULL, NULL),
(5, 'manajerallsite', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sitename`
--

DROP TABLE IF EXISTS `sitename`;
CREATE TABLE IF NOT EXISTS `sitename` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namasitename` varchar(100) NOT NULL,
  `idregion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1027 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sitename`
--

INSERT INTO `sitename` (`id`, `namasitename`, `idregion`) VALUES
(1, 'Sarihusada Jogja Factory', 999),
(999, 'Sarihusada Prambanan Factory', 999),
(1000, 'TIV Klaten', 1000),
(1001, 'TIV Wonosobo', 1000),
(1002, 'SPP Jawa Tengah', 1007),
(1003, 'SPP Jawa Timur', 1007),
(1004, 'SPP Cibitung', 1008),
(1006, 'Tirta Sibayakindo Berastagi', 1002),
(1007, 'TIV Langkat', 1002),
(1008, 'TIV Solok', 1002),
(1009, 'TIV Tanggamus', 1002),
(1010, 'Aqua Golden Bekasi', 1003),
(1011, 'TIV Sentul', 1003),
(1012, 'TIV Citeureup', 1003),
(1013, 'TIV Ciherang', 1003),
(1014, 'TIV Babakan Pari', 1003),
(1015, 'TIV Caringin', 1003),
(1016, 'Aqua Golden Mekarsari', 1003),
(1017, 'TIV Subang', 1003),
(1018, 'TIV Cianjur', 1003),
(1019, 'TIV Manado', 1001),
(1020, 'Sugizindo', 1),
(1021, 'Nutricia', 1),
(1022, 'Sarihusada Cileungsi', 1),
(1023, 'TIV Mambal', 1001),
(1024, 'TIV Sembung Gedhe', 1001),
(1025, 'TIV Kebon Candi', 1001),
(1026, 'TIV Banyuwangi', 1001);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepart`
--

DROP TABLE IF EXISTS `sparepart`;
CREATE TABLE IF NOT EXISTS `sparepart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `namasparepart` varchar(100) NOT NULL,
  `uom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sparepart`
--

INSERT INTO `sparepart` (`id`, `namasparepart`, `uom`) VALUES
(1, 'Ban Depan & Velg', 'pcs x'),
(3, 'Grease', 'kg'),
(5, 'Ban Belakang & Velg', 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepartstok`
--

DROP TABLE IF EXISTS `sparepartstok`;
CREATE TABLE IF NOT EXISTS `sparepartstok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `idsparepart` int(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sparepartstoktrans`
--

DROP TABLE IF EXISTS `sparepartstoktrans`;
CREATE TABLE IF NOT EXISTS `sparepartstoktrans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `idsparepart` int(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `tanggal` varchar(7) DEFAULT NULL,
  `qtytrans` int(11) DEFAULT NULL,
  `stockpros` double DEFAULT NULL,
  `confirmation` text DEFAULT NULL,
  `avgpros` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratjalan`
--

DROP TABLE IF EXISTS `suratjalan`;
CREATE TABLE IF NOT EXISTS `suratjalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengirim` varchar(10) NOT NULL,
  `penerima` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggalterima` date DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `statuspengirim` varchar(10) DEFAULT NULL,
  `namapenerima` varchar(100) DEFAULT NULL,
  `tanggalkembali` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `troubleaction`
--

DROP TABLE IF EXISTS `troubleaction`;
CREATE TABLE IF NOT EXISTS `troubleaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kdunit` varchar(20) DEFAULT NULL,
  `periode` varchar(7) DEFAULT NULL,
  `iduser` int(11) NOT NULL,
  `tanggalmulai` datetime DEFAULT NULL,
  `tanggalakhir` datetime DEFAULT NULL,
  `lapsetime` int(11) DEFAULT 0,
  `shift` varchar(20) DEFAULT NULL,
  `actionplan` text DEFAULT NULL,
  `sparepart` text DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kdunit` (`kdunit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `troubleaction`
--
DROP TRIGGER IF EXISTS `T_batalbeli`;
DELIMITER $$
CREATE TRIGGER `T_batalbeli` AFTER DELETE ON `troubleaction` FOR EACH ROW BEGIN
	UPDATE physicalavailable 
	set totalbreakdown=totalbreakdown-OLD.lapsetime,
    totaljamkerja=totaljamkerja+OLD.lapsetime,
    paforklift=(totaljamkerja/planunitkerja)*100
	WHERE kdunit=OLD.kdunit AND periode=OLD.periode;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `ttrouble`;
DELIMITER $$
CREATE TRIGGER `ttrouble` AFTER INSERT ON `troubleaction` FOR EACH ROW BEGIN
	UPDATE physicalavailable 
	set totalbreakdown=totalbreakdown+NEW.lapsetime,
    totaljamkerja=totaljamkerja-NEW.lapsetime,
    paforklift=(totaljamkerja/planunitkerja)*100
	WHERE kdunit=NEW.kdunit AND periode=NEW.periode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `kdunit` varchar(10) NOT NULL,
  `namaunit` varchar(100) DEFAULT NULL,
  `serialnumber` varchar(50) DEFAULT NULL,
  `hm` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idcbu` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT NULL,
  `equipment` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `capcity` varchar(100) DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`kdunit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`kdunit`, `namaunit`, `serialnumber`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `statusspp`, `statusmekanik`, `equipment`, `merk`, `model`, `type`, `capcity`, `specification`, `qty`) VALUES
('11111', '11111', 'X0001', 0, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', 'battery', 'ep', 'battery', 'Zl 483420', '360 AH', '48 V', 1),
('19-181', '19-181', '19568', 12685, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('19-182', '19-182', '31591', 10686, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('19-257', '19-257', '1907353', 10905, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('19-341', '19-341', '1910506', 3774, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('19-478', '19-478', '221E08470', 2939, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('20-028', '20-028', '00518', 0, NULL, 1, 999, 1, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('21-036', '21-036', '2010422', 5890, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('21-219', '21-219', 'CF50-52176', 0, NULL, 1, 999, 1, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('21-269', '21-269', 'CF50-52176', 0, NULL, 1, 999, 1, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('21-273', '21-273', 'Q1BA06392', 0, NULL, 1, 999, 1, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('21-274', '21-274', 'Q1BA06393', 0, NULL, 1, 999, 1, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('21-409', '21-409', '08015JG6580', 0, NULL, 1, 999, 1, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7004A', 'E7004A', 'CPD25-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7169', 'E7169', 'CPD25-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7170', 'E7170', 'Q1BB10041', 2000, '1970-01-01', 999, 1000, 1000, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7184', 'E7184', 'Q1BB10008', 0, NULL, 999, 1001, 1024, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7187', 'E7187', 'Q1BB10011', 0, NULL, 999, 1001, 1024, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7188', 'E7188', 'Q1BB10012', 0, NULL, 999, 1001, 1024, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7189', 'E7189', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7190', 'E7190', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7191', 'E7191', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7193', 'E7193', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7206', 'E7206', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7207', 'E7207', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7209', 'E7209', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7210', 'E7210', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7257', 'E7257', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7258', 'E7258', 'CPD30-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7271', 'E7271', 'CPD25-XD4-S126', 0, NULL, 999, 1001, 1023, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('E7706', 'E7706', '23030711', 33, NULL, 1, 1, 1020, 'CLOSE', 'CLOSE', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(2) NOT NULL,
  `access_token` text DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `roles_id` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `roles_id`, `access_token`, `idsitename`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$fWTV6C9DEbNqlybXyXw9Q..W6wAe3Sorvrg7b0/kSQjDp.CSuUb.C', 1, NULL, 999, '2023-04-18 05:42:36', '2023-06-24 01:44:40'),
(116, 'mekanik', 'mekanik@gmail.com', '$2y$10$6CHxgtH9SDtMNN9k0CdSvOIRJmJumoyAGR5U8ttiQoq5zgW386JNS', 3, NULL, 1, '2023-06-16 09:55:31', '2023-06-16 09:55:31'),
(118, 'Adminsite', 'adminsite@gmail.com', '$2y$10$jeerfUsAxJlBCDRORC1CFO/T2A0a23y1YMR9AJVCrPrlcAUVYa3GG', 2, NULL, 1, '2023-06-30 05:03:05', '2023-06-30 05:03:05'),
(122, 'Ardiyan Saputra', 'ardiyan891990@gmail.com', '$2y$10$/XKSc3oD8UY1boDHMxL/WuCzvuVgm1oDKwCJjiPLyFIIjH6y.Sig6', 3, NULL, 999, '2023-07-04 06:53:24', '2023-07-04 06:53:24'),
(123, 'Danang Dwiyanto', 'danangdwiyanto28041992@gmail.com', '$2y$10$XfoKzppGYGhoZP5NbVFn6ORELeAgTPXZB0LK17LyIc8QG2ohB9Inu', 3, NULL, 999, '2023-07-04 06:59:18', '2023-07-04 06:59:18'),
(124, 'Adib Budi Setyawan', 'hajnugisover@gmail.com', '$2y$10$ePgumovcITqaAys7EeowPexTg4wrypnChNdzXxGDu97FaVcijNg7.', 3, NULL, 999, '2023-07-04 07:09:08', '2023-07-04 07:09:08'),
(125, 'Mardi Kusumo', 'kusumo.mardi@gmail.com', '$2y$10$ilvePwdPMNYnI/jyTTjNfe0qID0ncvJcpAaQrY3bpML1girUPihqq', 3, NULL, 999, '2023-07-04 07:10:05', '2023-07-04 07:10:05'),
(126, 'Budi Prasetyo', 'prasetyabrigata077@gmail.com', '$2y$10$7hbGX1JhT6H026PCPjg/I.aOPwRFtS90hpGOKxMNix737qzse8Q52', 3, NULL, 999, '2023-07-04 07:10:56', '2023-07-04 07:10:56'),
(127, 'Syahruddin', 'ruddiensyach@gmail.com', '$2y$10$9l.iY8kn/FptnLBGc5M5luOX/xZF1BXSagRxvQ2ON3aDFF59gVUAe', 3, NULL, 999, '2023-07-04 07:12:51', '2023-07-04 07:12:51'),
(128, 'Agus Supriyanto', 'agsupriyanto83@gmail.com', '$2y$10$ycNXKuInBIMgeO9TFjwg0.HvnlOeSI2nygawvd/sIMJ8Cyy4nGkRS', 3, NULL, 999, '2023-07-04 07:14:14', '2023-07-04 07:14:14'),
(129, 'Markus Ibnu Pramono', 'markus80ibnu@gmail.com', '$2y$10$2wymgJ.dm.iJVCs9HM.SlOwXTf/Y9v6RqJ8V0rzyxUr5rRQoVrUDO', 3, NULL, 999, '2023-07-04 07:15:12', '2023-07-04 07:15:12'),
(130, 'Stefanus Niko Efendi', 'stefanusnikoefendi999@gmail.com', '$2y$10$zgkkOLKKbeTCM/IDlYJPUefOBCBMSlfTdm9S2PtAD1Dhzx5Q7Kzc6', 3, NULL, 999, '2023-07-04 07:16:13', '2023-07-04 07:16:13'),
(132, 'Yohanes Hari Tri Susilo', 'yohaneshariii@gmail.com', '$2y$10$QF5jkoRSUZ.qYnke1NTwYeXX7vmqSu3z7zH0q.QLKjxWXSon5nkyO', 3, NULL, 1, '2023-07-04 07:29:48', '2023-07-04 07:29:48'),
(133, 'Syahrian Riza Maramis', 'riyanrezaa@gmail.com', '$2y$10$zGpLbUKzuVk2OECzCZcQuuFjuNa7SKocwdAOMDuyJGAG4HQOO8eK6', 3, NULL, 1, '2023-07-04 07:31:59', '2023-07-04 07:31:59'),
(134, 'Adytya Mandra Kusuma', 'emkakusuma767@gmail.com', '$2y$10$pZ/asqjbkbww0zcV0.3lkOc9gk0p04Z1rHRLutBwdRGB2E4noi/uW', 3, NULL, 1000, '2023-07-04 07:32:56', '2023-07-04 07:32:56'),
(135, 'Arga Resmayudha', 'aliansiindraashura@gmail.com', '$2y$10$LEJ3mPltufkttrLcNQLcROUOWwye6Zamgvtef1zcEvVdzZHKeAzK6', 3, NULL, 1000, '2023-07-04 07:33:51', '2023-07-04 07:33:51'),
(136, 'Wahyu Tegar Prasetya', 'tegarprasetyo135@gmail.com', '$2y$10$1.UpAm2ELuU7whWUrPMt4O8.bQiFkqcPwaIEiH95TshlzaQ0hFJ/y', 3, NULL, 1000, '2023-07-04 07:35:51', '2023-07-04 07:35:51'),
(137, 'Najib', 'najibnay@gmail.com', '$2y$10$vJhT6EeDI/vZ7SwzTczwSeMvU/Yu4qOb93b.UwupRS1oHEdzn7i1C', 3, NULL, 1000, '2023-07-04 08:29:32', '2023-07-04 08:29:32'),
(138, 'Pebriyansah', 'abbifebry344@gmail.com', '$2y$10$vEVMSsDJkTnkor4QdarPhe3FYqlA.3AIZJaK5AqZ0iwXKjSsY9znu', 3, NULL, 1015, '2023-07-04 10:09:17', '2023-07-04 10:09:17'),
(139, 'Ichwan Zakiatudin', 'iwankmamen1111@gmail.com', '$2y$10$YEp0BreNBZ3PEztigQq0mOdUmhFcGH79wT55wzs5n6SeZh3KjfnPC', 3, NULL, 1012, '2023-07-04 10:13:13', '2023-07-04 10:13:13'),
(140, 'Apip Zakaria', 'apipzakaria24@gmail.com', '$2y$10$py3j550FtRtj799xccnByuquGGCe2Ot8Pj6kh7PZ2EuoPVUI29Ssq', 3, NULL, 1015, '2023-07-04 10:17:05', '2023-07-04 10:17:05'),
(141, 'Adam Munandar', 'doangdamz@gmail.com', '$2y$10$O/VhBq16vkLJFdcYWom/G.NsolSNfP.wD6HM326cuJ1Nm2t4srCuW', 3, NULL, 1011, '2023-07-04 10:29:20', '2023-07-04 10:29:20'),
(142, 'Sigi Migel Mondoringin', 'migelmondoringin@gmail.com', '$2y$10$YqspLsOPgcfFw4S04CP24uVsLl4VMZv7/k82r2rKCWPFaKDPQgUDO', 3, NULL, 1019, '2023-07-04 11:44:51', '2023-07-04 11:44:51'),
(143, 'Yeszy Frangky Pitoy', 'pitoyyeszy@gmail.com', '$2y$10$tLF3rEE264uQUEfWvNHhCOtUR9dyw6uEMchKzapdHYy7ow6vGBdG.', 3, NULL, 1019, '2023-07-04 11:45:48', '2023-07-04 14:43:15'),
(144, 'Qilas Sulis Pratama', 'sulis251083@gmail.com', '$2y$10$kKYIoyaHqvAcaPOZxZ4yuuyZBYU3YMkM21agyPWnu2F2MID8eAPwS', 3, NULL, 1009, '2023-07-04 11:47:08', '2023-07-04 11:47:08'),
(145, 'Krisdi Ambika Syahputra', 'krisdisahputra@gmail.com', '$2y$10$xGNnIQxWoNEun6GSbCwNbOVsKx67BVQAv/2aPBwhY1PLZ6StU3Bhy', 3, NULL, 1006, '2023-07-04 11:48:57', '2023-07-04 11:48:57'),
(146, 'Arif Riyan Dermawan', 'arvriyan@gmail.com', '$2y$10$tMQwdVBFcYQLKZtUTRXB..rgIU9ZjH.UdQ3nMbdgbnwIXIpSKPudW', 3, NULL, 1008, '2023-07-04 11:51:02', '2023-07-04 11:51:02'),
(147, 'Manajerallsite', 'manajerallsite@gmail.com', '$2y$10$jBlX.bB2SySJWVy.ZgtPt.8JUhp/dExMYc4.mwAewA8bYehfVx7Ty', 5, NULL, NULL, '2023-07-04 12:03:13', '2023-07-04 12:03:13'),
(148, 'Yang Yang', 'yangyangvixy@gmail.com', '$2y$10$l6d8MZ2FUkbmCkceUyQKSe7nL/Yo2/qGtbzKvwyZmgm0rhT9h1DZ2', 3, NULL, 1022, '2023-07-04 12:21:24', '2023-07-04 12:21:24'),
(149, 'Riconaldi Pasaribu', 'rikopasaribu26@gmail.com', '$2y$10$L369nm1xFnJxHRml1IeKMeDBBVnFsCq6RS9R5m/ol7OWjJClI4KdG', 3, NULL, 1007, '2023-07-04 14:41:57', '2023-07-04 14:41:57'),
(150, 'Cecep Purnairawan', 'ikiwmartin60@gmail.com', '$2y$10$KaQ7cPTafuRQ/ao8Yh9YROD5LCNZnM0izDr9H43A764FjHv/M0ha.', 3, NULL, 1013, '2023-07-05 02:08:29', '2023-07-05 02:08:29'),
(151, 'Mustakim', 'baliipunk35@gmail.com', '$2y$10$9GVtKxznolvSpUAmiwZG2.12FPa55.unO8YOjdKsA.weeJLvS5u2G', 3, NULL, 1023, '2023-07-05 02:16:40', '2023-07-05 02:38:38'),
(152, 'I Komang Arya Wedana', 'komangaryawedana20@gmail.com', '$2y$10$x9bGmtnax/d6bajB.e4ZM.K5aLlPBldbZaz78niacZEUipsktCHSC', 3, NULL, 1024, '2023-07-05 02:22:05', '2023-07-05 02:39:03'),
(153, 'Samsul Arifin', 'samsoelvano82@gmail.com', '$2y$10$VTHzy54./GjF2GyvUZElUOIJ32BgPt5.PGQt6401KlFUjBzEc1cfi', 3, NULL, 1025, '2023-07-05 02:24:06', '2023-07-05 02:37:25'),
(154, 'Teguh Fathur Rohman', 'teguhfr0@gmail.com', '$2y$10$qFCvbA9w0OBtntcAdTamP.oaCTdG60E5/Pt9N4pkWwkHixg1OCfRO', 3, NULL, 1026, '2023-07-05 02:25:27', '2023-07-05 02:36:46');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `maintenanceaction`
--
ALTER TABLE `maintenanceaction`
  ADD CONSTRAINT `maintenanceaction_ibfk_1` FOREIGN KEY (`kdunit`) REFERENCES `unit` (`kdunit`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mekanik`
--
ALTER TABLE `mekanik`
  ADD CONSTRAINT `mekanik_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `physicalavailable`
--
ALTER TABLE `physicalavailable`
  ADD CONSTRAINT `physicalavailable_ibfk_1` FOREIGN KEY (`kdunit`) REFERENCES `unit` (`kdunit`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `troubleaction`
--
ALTER TABLE `troubleaction`
  ADD CONSTRAINT `troubleaction_ibfk_1` FOREIGN KEY (`kdunit`) REFERENCES `unit` (`kdunit`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
