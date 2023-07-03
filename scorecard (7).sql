-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2023 pada 15.04
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `beritaacara`
--

INSERT INTO `beritaacara` (`id`, `pengirim`, `penerima`, `tanggal`, `tanggalterima`, `namapenerima`, `tanggalkembali`, `filename`, `statuspengirim`) VALUES
(2, '1', '2', '2023-07-03', '2023-07-03', 'azzz', '2023-07-06', '1688387943.png', 'CLOSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbu`
--

DROP TABLE IF EXISTS `cbu`;
CREATE TABLE IF NOT EXISTS `cbu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namacbu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cbu`
--

INSERT INTO `cbu` (`id`, `namacbu`) VALUES
(1, 'AQUA'),
(3, 'AQUA X dd'),
(999, 'SPP');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `delivery`
--

INSERT INTO `delivery` (`id`, `idcbu`, `idregion`, `idsitename`, `serialnumber`, `idforklifttype`, `capacity`, `masheight`, `dateestimated`, `reason`, `mitigationplan`, `dateactual`, `confirmationplan`, `statusspp`, `statuscustomer`) VALUES
(1, 1, 1, 1, 'C881R01958S', 1, 2, 2, '2023-07-02', NULL, NULL, NULL, NULL, 'OPEN', 'CLOSE');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentrouble`
--

DROP TABLE IF EXISTS `dokumentrouble`;
CREATE TABLE IF NOT EXISTS `dokumentrouble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `idtrouble` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Struktur dari tabel `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE IF NOT EXISTS `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(5) DEFAULT NULL,
  `iddokter` int(11) DEFAULT NULL,
  `jmlpendaftar` int(11) NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `tanggal`, `jam`, `iddokter`, `jmlpendaftar`, `status`) VALUES
(3, '2023-06-16', '08.00', 4, 0, '1'),
(6, '2023-06-16', '10.00', 4, 0, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `loglogin`
--

INSERT INTO `loglogin` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '2023-07-03 05:28:46', '2023-07-03 05:28:46'),
(2, 'adminsite@gmail.com', '2023-07-03 05:57:17', '2023-07-03 05:57:17');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mekanik`
--

INSERT INTO `mekanik` (`id`, `userid`, `namamekanik`, `gender`, `address`, `nohp`, `idsitename`, `created_at`, `updated_at`) VALUES
(5, 116, 'mekanik', 'male', NULL, NULL, 2, NULL, NULL);

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
-- Struktur dari tabel `pasien`
--

DROP TABLE IF EXISTS `pasien`;
CREATE TABLE IF NOT EXISTS `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `namapasien` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `tempat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `agama` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pekerjaan` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nokartu` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nohp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `kelurahan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `statuskeluarga` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `userid`, `namapasien`, `gender`, `address`, `birthday`, `tempat`, `agama`, `pekerjaan`, `status`, `nokartu`, `nohp`, `kelurahan`, `statuskeluarga`, `created_at`, `updated_at`) VALUES
(1, 2, 'cbcvbc', 'cvbcvb', 'cvbcvb', '2023-06-14', 'vbvcb', 'vbvcb', 'cvbcvb', 'vcbvcb', 'cvbvcb', 'vcbvb', 'cvbvc', 'vcbvcb', '2023-06-14 23:56:27', '2023-06-14 23:56:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

DROP TABLE IF EXISTS `pendaftaran`;
CREATE TABLE IF NOT EXISTS `pendaftaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idjadwal` int(11) NOT NULL,
  `idpasien` int(11) NOT NULL,
  `noantrian` int(11) DEFAULT NULL,
  `mediadaftar` set('offline','online') DEFAULT 'online',
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpasien` (`idpasien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `physicalavailable`
--

INSERT INTO `physicalavailable` (`id`, `idcbu`, `idregion`, `idsitename`, `periode`, `kdunit`, `harikerja`, `planunitkerja`, `totalbreakdown`, `totaljamkerja`, `paforklift`) VALUES
(11, 1, 1, 1, '2023-07', '19-301', 31, 44640, 0, 44640, 100),
(12, 1, 1, 1, '2023-07', 'E7254', 31, 44640, 0, 44640, 100),
(13, 1, 1, 1, '2023-07', 'E7255', 31, 44640, 0, 44640, 100),
(14, 1, 1, 1, '2023-07', 'E7506', 31, 44640, 0, 44640, 100);

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
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `region`
--

INSERT INTO `region` (`id`, `namaregion`, `idcbu`) VALUES
(1, 'AQUA R2', 1),
(999, 'SPP', 999);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam`
--

DROP TABLE IF EXISTS `rekam`;
CREATE TABLE IF NOT EXISTS `rekam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpasien` int(11) NOT NULL,
  `iddokter` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(5) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `object` text DEFAULT NULL,
  `assasment` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `resep` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpasien` (`idpasien`),
  KEY `iddokter` (`iddokter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'mekanik', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sitename`
--

INSERT INTO `sitename` (`id`, `namasitename`, `idregion`) VALUES
(1, 'PLANT BEKASI', 1),
(2, 'PLANT CARINGIN', 1),
(4, 'PLANT Klaten x', 1),
(999, 'SPP', 999);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suratjalan`
--

INSERT INTO `suratjalan` (`id`, `pengirim`, `penerima`, `tanggal`, `tanggalterima`, `filename`, `statuspengirim`, `namapenerima`, `tanggalkembali`) VALUES
(1, '1', '4', '2023-07-03', '2023-07-03', '1688388909.png', 'CLOSE', 'azzz', '2023-07-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `troubleaction`
--

DROP TABLE IF EXISTS `troubleaction`;
CREATE TABLE IF NOT EXISTS `troubleaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kdunit` varchar(20) DEFAULT NULL,
  `periode` varchar(7) DEFAULT NULL,
  `idtrouble` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggalmulai` datetime DEFAULT NULL,
  `tanggalakhir` datetime DEFAULT NULL,
  `lapsetime` int(11) DEFAULT 0,
  `shift` varchar(20) DEFAULT NULL,
  `actionplan` text DEFAULT NULL,
  `sparepart` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `troubleaction`
--

INSERT INTO `troubleaction` (`id`, `kdunit`, `periode`, `idtrouble`, `iduser`, `tanggalmulai`, `tanggalakhir`, `lapsetime`, `shift`, `actionplan`, `sparepart`) VALUES
(2, '19-301', '2023-07', 1, 1, '2023-07-03 17:17:37', '2023-07-03 18:17:37', 50, 'pagi', NULL, NULL),
(3, '19-301', '2023-07', 1, 1, '2023-07-03 17:17:37', '2023-07-03 18:17:37', 190, 'pagi', NULL, NULL);

--
-- Trigger `troubleaction`
--
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
  PRIMARY KEY (`kdunit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`kdunit`, `namaunit`, `serialnumber`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `statusspp`, `statusmekanik`) VALUES
('19-301', '19-301', '12344', 0, NULL, 1, 1, 1, 'CLOSE', 'CLOSE'),
('E7254', 'E7254', 'Q1BA06384', 400, '1970-01-01', 1, 1, 1, 'OPEN', 'OPEN'),
('E7255', 'E7255', 'Q1BA06384', 9000, '2023-06-07', 1, 1, 1, 'OPEN', 'OPEN'),
('E7506', 'E7506', '1212214', 0, NULL, 1, 1, 1, 'CLOSE', 'CLOSE');

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
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `roles_id`, `access_token`, `idsitename`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$fWTV6C9DEbNqlybXyXw9Q..W6wAe3Sorvrg7b0/kSQjDp.CSuUb.C', 1, NULL, 999, '2023-04-18 05:42:36', '2023-06-24 01:44:40'),
(116, 'mekanik', 'mekanik@gmail.com', '$2y$10$6CHxgtH9SDtMNN9k0CdSvOIRJmJumoyAGR5U8ttiQoq5zgW386JNS', 3, NULL, 1, '2023-06-16 09:55:31', '2023-06-16 09:55:31'),
(118, 'Adminsite', 'adminsite@gmail.com', '$2y$10$jeerfUsAxJlBCDRORC1CFO/T2A0a23y1YMR9AJVCrPrlcAUVYa3GG', 2, NULL, 1, '2023-06-30 05:03:05', '2023-06-30 05:03:05');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `mekanik`
--
ALTER TABLE `mekanik`
  ADD CONSTRAINT `mekanik_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pasien` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekam`
--
ALTER TABLE `rekam`
  ADD CONSTRAINT `rekam_ibfk_1` FOREIGN KEY (`idpasien`) REFERENCES `pasien` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_ibfk_2` FOREIGN KEY (`iddokter`) REFERENCES `mekanik` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
