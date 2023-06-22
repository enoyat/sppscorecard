-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2023 pada 20.59
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

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
-- Struktur dari tabel `cbu`
--

DROP TABLE IF EXISTS `cbu`;
CREATE TABLE IF NOT EXISTS `cbu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namacbu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cbu`
--

INSERT INTO `cbu` (`id`, `namacbu`) VALUES
(1, 'AQUA');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `delivery`
--

INSERT INTO `delivery` (`id`, `idcbu`, `idregion`, `idsitename`, `serialnumber`, `idforklifttype`, `capacity`, `masheight`, `dateestimated`, `reason`, `mitigationplan`, `dateactual`, `confirmationplan`, `statusspp`, `statuscustomer`) VALUES
(1, 1, 1, 2, '05030DG7552', 2, 3, 3, '2023-06-20', 'Pihak Plant Bekasi minta di tunda sampai habis p.o Lead Acid yang lama desember 2023', '2023-06-22', '2023-06-22', 'csczxczxc', 'open', 'open'),
(3, 1, 1, 1, '1111', 2, 1, 2, '2023-06-21', 'Pihak Plant Bekasi minta di tunda sampai habis p.o Lead Acid yang lama desember 2023', '2023-06-21', '2023-06-21', 'ccing', 'OPEN', 'CLOSE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

DROP TABLE IF EXISTS `dokter`;
CREATE TABLE IF NOT EXISTS `dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `namadokter` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'male',
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nohp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `spesialis` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `userid`, `namadokter`, `gender`, `address`, `birthday`, `nohp`, `spesialis`, `created_at`, `updated_at`) VALUES
(1, 1, 'dokter', 'male', 'alamat', '2023-06-15', '082', 'penyakit dalam', NULL, NULL),
(4, 113, 'dr. pepep asdsadsd', 'female', 'papringan', '2023-06-16', '08222', NULL, '2023-06-16 09:55:31', '2023-06-16 09:55:31');

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
  `id` int(11) NOT NULL DEFAULT 0,
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
  `statuscustomer` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `listoftrouble`
--

INSERT INTO `listoftrouble` (`id`, `idcbu`, `idregion`, `idsitename`, `kdunit`, `tanggal`, `issue`, `documentation`, `targetcompletedate`, `actionplanspp`, `actualcompletedate`, `lapsetime`, `confirmationplan`, `statusspp`, `statuscustomer`) VALUES
(0, 1, 1, 1, 'E 7506', '2023-06-22', 'Bearing Mast Crown unit 18-141 pecah', 's', '2023-06-22', 'sd', '2023-06-22', 0, 'ccing', 'OPEN', 'OPEN');

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
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `maintenance`
--

INSERT INTO `maintenance` (`id`, `idcbu`, `idregion`, `idsitename`, `kdunit`, `tanggal`, `statusspp`, `statuscustomer`) VALUES
(1, 1, 1, 1, 'E 7506', '2023-06-22', 'CLOSE', 'OPEN');

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
  `jenisrequest` enum('withdrawal','delivery') DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pallete`
--

INSERT INTO `pallete` (`id`, `idcbu`, `idregion`, `idsitename`, `jenisrequest`, `qty`, `daterequest`, `targetdate`, `actualdate`, `lapsetime`, `gap`, `remark`, `statusspp`, `statuscustomer`) VALUES
(2, 1, 1, 1, 'withdrawal', 4, '2023-06-23', '2023-06-23', '2023-06-23', 0, 4, '-', 'CLOSE', 'OPEN');

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
  `qty` int(11) NOT NULL,
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
  `tanggal` date DEFAULT NULL,
  `kdunit` varchar(10) DEFAULT NULL,
  `serialnumber` varchar(50) DEFAULT NULL,
  `harikerja` int(11) DEFAULT NULL,
  `planunitkerja` int(11) DEFAULT NULL,
  `totalbreakdown` int(11) DEFAULT NULL,
  `totaljamkerja` int(11) DEFAULT NULL,
  `paforklift` double DEFAULT NULL,
  `remarkunit` text DEFAULT NULL,
  `confirmationplan` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `physicalavailable`
--

INSERT INTO `physicalavailable` (`id`, `idcbu`, `idregion`, `idsitename`, `tanggal`, `kdunit`, `serialnumber`, `harikerja`, `planunitkerja`, `totalbreakdown`, `totaljamkerja`, `paforklift`, `remarkunit`, `confirmationplan`, `remarks`, `statusspp`, `statuscustomer`) VALUES
(2, 1, 1, 1, '2023-06-22', 'E 7506', 'E 7506', 31, 44640, 0, 44640, 100, '-', 'ccing', '-', 'CLOSE', 'CLOSE'),
(3, 1, 1, 2, NULL, '19-301', 'C881R01954S', 31, 44640, 0, 44640, 100, '-', 'ccing', '-', 'CLOSE', 'OPEN');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `region`
--

INSERT INTO `region` (`id`, `namaregion`, `idcbu`) VALUES
(1, 'AQUA R2', 1);

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
(2, 'manajer', '2020-12-22 02:12:09', '2020-12-22 02:12:09'),
(3, 'member', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sitename`
--

INSERT INTO `sitename` (`id`, `namasitename`, `idregion`) VALUES
(1, 'PLANT BEKASI', 1),
(2, 'PLANT CARINGIN', 1);

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
(1, 'Ban Depan & Velg', 'pcs'),
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
  `tanggal` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qtyuom` int(11) DEFAULT NULL,
  `stockprosentase` double DEFAULT NULL,
  `confirmationplan` text DEFAULT NULL,
  `average` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sparepartstok`
--

INSERT INTO `sparepartstok` (`id`, `idcbu`, `idregion`, `idsitename`, `idsparepart`, `tanggal`, `qty`, `qtyuom`, `stockprosentase`, `confirmationplan`, `average`) VALUES
(3, 1, 1, 1, 5, '2023-06-23', 4, 12, 100, 'ccing', 122);

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `roles_id` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `roles_id`, `access_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$ocRCWT1BBpSh5Kb0VG3/Du5Ipcrcy1icZx6bqv5ZO6nzW8kq7roYq', 1, NULL, '2023-04-18 05:42:36', '2023-04-18 05:42:36'),
(113, 'dr. pepep asdsadsd', 'dokter@gmail.com', '$2y$10$BDC0RyJgj7izd3Fs4.8b5.f1No7tnLVRzEwtWVzb9Y2H9ckKYLFka', 2, NULL, '2023-06-16 09:55:31', '2023-06-16 09:55:31');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `rekam_ibfk_2` FOREIGN KEY (`iddokter`) REFERENCES `dokter` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
