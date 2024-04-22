-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2024 at 01:31 PM
-- Server version: 10.5.18-MariaDB-0+deb11u1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sppscorecardallsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `beritaacara`
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
  `filereply` text DEFAULT NULL,
  `statuspengirim` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cbu`
--

DROP TABLE IF EXISTS `cbu`;
CREATE TABLE IF NOT EXISTS `cbu` (
  `id` varchar(20) NOT NULL,
  `namacbu` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cbu`
--

INSERT INTO `cbu` (`id`, `namacbu`) VALUES
('C999', 'SPP'),
('CABC', 'ABC'),
('CCS-0107', 'TIRTA SIBAYAKINDO, PT'),
('CCS-013', 'AQUA GOLDEN MISSISSIPPI, PT'),
('CCS-113', 'TIRTA INVESTAMA, PT'),
('CCS-155', 'SARIHUSADA GENERASI MAHARDHIKA, PT'),
('CCS-351', 'NUTRICIA INDONESIA SEJAHTERA, PT'),
('CCS-639', 'SUGIZINDO, PT');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `kdcustomer` varchar(50) NOT NULL,
  `namacustomer` text NOT NULL,
  `location` text DEFAULT NULL,
  `category` varchar(2) NOT NULL,
  PRIMARY KEY (`kdcustomer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kdcustomer`, `namacustomer`, `location`, `category`) VALUES
('ABC', 'PT. ABC', '-', '2'),
('DHL', 'PT. BIROTIKA SEMESTA', 'JAKARTA', '1'),
('PANDORA', 'PANDORA PT.', 'JAKARTA', '2'),
('PUNINAR', 'PT. PUNINAR', 'JAKARTA', '1'),
('SPP', 'PT. SPP', '-', '10'),
('SUZUKI', 'PT. SUZUKI INDOMOBIL MOTOR', 'BEKASI', '1');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE IF NOT EXISTS `delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `daterequest` date DEFAULT NULL,
  `ponumber` text DEFAULT NULL,
  `kdunit` varchar(20) DEFAULT NULL,
  `serialnumber` varchar(50) DEFAULT NULL,
  `idforklifttype` int(11) DEFAULT NULL,
  `capacity` decimal(5,1) DEFAULT NULL,
  `mast` decimal(5,1) DEFAULT NULL,
  `masheight` decimal(3,1) DEFAULT NULL,
  `dateestimated` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `daysoflapse` int(11) DEFAULT NULL,
  `remarkplan` text DEFAULT NULL,
  `mitigationplan` text DEFAULT NULL,
  `dateactual` date DEFAULT NULL,
  `confirmationplan` text DEFAULT NULL,
  `statusspp` varchar(10) NOT NULL DEFAULT 'open',
  `statuscustomer` varchar(10) NOT NULL DEFAULT 'open',
  `price` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idsitename` (`idsitename`)
) ENGINE=InnoDB AUTO_INCREMENT=388 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `idcbu`, `idregion`, `idsitename`, `daterequest`, `ponumber`, `kdunit`, `serialnumber`, `idforklifttype`, `capacity`, `mast`, `masheight`, `dateestimated`, `reason`, `daysoflapse`, `remarkplan`, `mitigationplan`, `dateactual`, `confirmationplan`, `statusspp`, `statuscustomer`, `price`) VALUES
(354, 'BS', 'DHL', 'BPN', '2024-02-01', NULL, NULL, '185F-03698', 2, '2500.0', '3.0', '7.0', '2024-01-29', NULL, 0, NULL, NULL, '2024-01-29', NULL, 'CLOSE', 'CLOSE', 0),
(355, 'BS', 'DHL', 'BPN', '2024-02-01', NULL, NULL, '185F-03506', 2, '1500.0', '3.0', '7.0', '2024-01-29', NULL, 0, NULL, NULL, '2024-01-29', NULL, 'CLOSE', 'CLOSE', 0),
(356, 'BS', 'DHL', 'BTH', '2024-02-01', NULL, NULL, '257D02123', 1, '2500.0', '3.0', '4.7', '2024-02-01', NULL, 0, NULL, NULL, '2024-02-01', NULL, 'CLOSE', 'CLOSE', 0),
(357, 'BS', 'DHL', 'SUB', '2024-02-01', NULL, NULL, '185F-03984', 2, '2000.0', '3.0', '6.0', '2024-02-01', NULL, 0, NULL, NULL, '2024-02-01', NULL, 'CLOSE', 'CLOSE', 0),
(358, 'BS', 'DHL', 'TXZ', '2023-03-10', NULL, NULL, '185F02991', 2, '1800.0', '3.0', '7.0', '2023-03-10', NULL, 0, NULL, NULL, '2023-03-10', NULL, 'CLOSE', 'CLOSE', 0),
(368, 'BS', 'DHL', 'BQZ', '2024-02-01', NULL, NULL, '185F-03813', 2, '2000.0', '3.0', '6.5', '2024-01-29', NULL, 0, NULL, NULL, '2024-01-29', NULL, 'CLOSE', 'CLOSE', 0),
(369, 'BS', 'DHL', 'UPG', '2024-02-01', NULL, NULL, '185F-03508', 2, '1500.0', '3.0', '7.0', '2024-01-24', NULL, 0, NULL, NULL, '2024-01-24', NULL, 'CLOSE', 'CLOSE', 0),
(370, 'BS', 'DHL', 'KXZ', '2024-02-01', NULL, NULL, '185F-03988', 2, '1800.0', '3.0', '6.0', '2024-01-25', NULL, 0, NULL, NULL, '2024-01-25', NULL, 'CLOSE', 'CLOSE', 0),
(371, 'BS', 'DHL', 'KXZ', '2024-02-01', NULL, NULL, '185F-03793', 2, '1800.0', '3.0', '6.0', '2024-01-25', NULL, 0, NULL, NULL, '2024-01-25', NULL, 'CLOSE', 'CLOSE', 0),
(372, 'BS', 'DHL', 'DHL1', '2023-09-26', NULL, NULL, 'B226R07049M', 1, '2500.0', '2.0', '3.0', '2023-09-26', NULL, 189, NULL, NULL, '2023-09-26', NULL, 'CLOSE', 'CLOSE', 0),
(374, 'BS', 'DHL', 'SRG', '2024-02-01', NULL, NULL, '185F-03512', 2, '2500.0', '3.0', '7.0', '2024-01-25', NULL, 0, NULL, NULL, '2024-01-25', NULL, 'CLOSE', 'CLOSE', 0),
(376, 'BS', 'DHL', 'TIM', '2024-02-01', NULL, NULL, '42233', 1, '3000.0', '2.0', '3.0', '2024-01-19', NULL, 0, NULL, NULL, '2024-01-19', NULL, 'CLOSE', 'CLOSE', 0),
(377, 'BS', 'DHL', 'JDC', '2024-08-31', NULL, NULL, '-', 2, '2000.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(378, 'BS', 'DHL', 'JDC', '2024-08-31', NULL, NULL, '-', 2, '1800.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(379, 'BS', 'DHL', 'JDC', '2024-08-31', NULL, NULL, '-', 2, '1800.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(380, 'BS', 'DHL', 'JDC', '2024-08-31', NULL, NULL, '-', 2, '1800.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(381, 'BS', 'DHL', 'JDC', '2024-08-31', NULL, NULL, '-', 2, '1800.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(382, 'BS', 'DHL', 'JDC', '2024-08-31', NULL, NULL, '-', 2, '2000.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(383, 'BS', 'DHL', 'DPS', '2024-08-31', NULL, NULL, '-', 2, '1800.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(384, 'BS', 'DHL', 'GTW', '2024-08-31', NULL, NULL, '-', 2, '1500.0', '3.0', '7.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(385, 'BS', 'DHL', 'NEM', '2024-08-31', NULL, NULL, '-', 2, '1500.0', '3.0', '7.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(386, 'BS', 'DHL', 'SRG', '2024-08-31', NULL, NULL, '-', 2, '1800.0', '3.0', '6.0', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0),
(387, 'BS', 'DHL', 'SOC', '2024-08-31', NULL, NULL, '-', 1, '1500.0', '3.0', '4.5', '2024-08-31', NULL, 0, NULL, NULL, NULL, NULL, 'OPEN', 'OPEN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detailorder`
--

DROP TABLE IF EXISTS `detailorder`;
CREATE TABLE IF NOT EXISTS `detailorder` (
  `iddetailorder` int(11) NOT NULL AUTO_INCREMENT,
  `noorder` varchar(20) NOT NULL,
  `codepart` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `qty` int(6) NOT NULL,
  PRIMARY KEY (`iddetailorder`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailorder`
--

INSERT INTO `detailorder` (`iddetailorder`, `noorder`, `codepart`, `description`, `qty`) VALUES
(3, '6', '99999', 'ts12', 1),
(4, '6', '99999', 'test3', 1),
(5, '7', NULL, 'ts12', 1),
(6, '7', NULL, 'test3', 1),
(7, '8', NULL, 'ts12', 1),
(8, '8', NULL, 'test3', 1),
(9, '9', NULL, 'ts12', 1),
(10, '9', NULL, 'test3', 1),
(11, '10', NULL, 'test', 1),
(12, '10', NULL, '1ssec', 2),
(13, '11', NULL, 'test', 2),
(14, '12', NULL, 'gzyshjajznav', 2),
(15, '13', NULL, 'Bearing 30TAG12', 1),
(16, '14', NULL, 'Bearing 30TAG12', 1),
(17, '15', NULL, 'BALANCE WHEEL', 1),
(18, '15', NULL, 'REL REACH 00010-2', 1),
(19, '16', NULL, '06JF-06JF-204-1570', 1),
(20, '17', NULL, 'kunci pintu batrai', 1),
(21, '18', NULL, 'CHAIN LUBE 500ML', 1),
(22, '19', NULL, 'CHAIN LUBE 500ML', 1),
(23, '20', NULL, 'DRIVE WHEEL 1334675 LPE200 BT', 1),
(24, '20', NULL, 'DRIVE MOTOR ASSY 30304000005', 1),
(25, '20', NULL, 'LAMPU ROTARY 48V YELLOW', 1),
(26, '21', NULL, 'DRIVE WHEEL 1334675 LPE200 BT', 1),
(27, '21', NULL, 'DRIVE MOTOR ASSY 30304000005', 1),
(28, '21', NULL, 'LAMPU ROTARY 48V YELLOW', 1),
(29, '22', NULL, 'DRIVE WHEEL 1334675 LPE200 BT', 1),
(30, '23', NULL, 'Seal Hidrolik', 1),
(31, '24', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 2),
(32, '25', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 1),
(33, '26', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 1),
(34, '27', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 1),
(35, '28', NULL, 'SOLID 23-9-10/6.50 B-102 GNAS', 2),
(36, '29', NULL, 'HOSE RETURN', 1),
(37, '30', NULL, 'HOSE RETURN', 1),
(38, '31', NULL, 'HOSE RETURN', 1),
(39, '32', NULL, 'MUR KEMBANG MUR-01', 1),
(40, '33', NULL, 'oli hydrolik', 2),
(41, '34', NULL, 'oli hydrolik', 2),
(42, '35', NULL, 'oli hydrolik', 2),
(43, '36', NULL, 'oli hydrolik', 2),
(44, '37', NULL, 'oli hydrolik', 2),
(45, '38', NULL, 'oli hydrolik', 2),
(46, '39', NULL, 'oli hydrolik', 2),
(47, '40', NULL, 'oli hydrolik', 2),
(48, '41', NULL, 'oli hydrilik', 2),
(49, '42', NULL, 'oli hydrolik', 2),
(50, '43', NULL, 'oli hydrolik', 2),
(51, '44', NULL, 'oli hdrolik', 2),
(52, '45', NULL, 'oli hydrolik', 2),
(53, '46', NULL, 'oli hdrolik', 2),
(54, '47', NULL, 'oli hydrolik', 2),
(55, '48', NULL, 'oli hydrolik', 2),
(56, '49', NULL, 'oli hydrolik', 2),
(57, '50', NULL, 'oli hydrolik', 2),
(58, '51', NULL, 'oli hydrolik', 2),
(59, '52', NULL, 'oli hydrolik', 2),
(60, '53', NULL, 'oli hydrolik', 2),
(61, '54', NULL, 'oli hydrolik', 2),
(62, '55', NULL, 'oli hydrolik', 2),
(63, '56', NULL, 'oli hydrolik', 2),
(64, '57', NULL, 'oli hydrolik', 2),
(65, '58', NULL, 'oli hydrolik', 2),
(66, '59', NULL, 'SPION KACA FORKLIFT', 1),
(67, '60', NULL, 'roda belakang 18x7-8', 2),
(68, '61', NULL, 'CHAIN LUBE 500ML', 2),
(69, '62', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 2),
(70, '63', NULL, 'BRAKE FLUID DOT 3 GLOBAL', 4),
(71, '64', NULL, 'RANTAI BL60', 1),
(72, '65', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 2),
(73, '66', NULL, 'Hose Hidrolik', 2),
(74, '67', NULL, 'Hose Hidrolik', 2),
(75, '68', NULL, 'Hose Hidrolik R1 3/8 inch x 5,3 meter', 2),
(76, '69', NULL, 'Hose Hidrolik R1 3/8 inch x 5,3 meter', 2),
(77, '70', NULL, 'Bearing Mast Crown 45x127x25 mm', 2),
(78, '71', NULL, 'ROTRA MP ID 90 AGIP', 6),
(79, '72', NULL, 'pengunci tutup batrai', 1),
(80, '73', NULL, 'SOLID 18-7-8/4.33 B-102 GNAS', 2),
(81, '73', NULL, 'SOLID 23-9-10/6.50 B-102 GNAS', 2),
(82, '74', NULL, 'kampas rem depa.  minyak rem.. seal weel xylender 2 pcs', 1),
(83, '74', NULL, 'kampas rem', 2),
(84, '75', NULL, 'kampas rem depa.  minyak rem.. seal weel xylender 2 pcs', 1),
(85, '75', NULL, 'kampas rem', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dokumenmaintenance`
--

DROP TABLE IF EXISTS `dokumenmaintenance`;
CREATE TABLE IF NOT EXISTS `dokumenmaintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `idaction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumenmaintenance`
--

INSERT INTO `dokumenmaintenance` (`id`, `keterangan`, `filename`, `idaction`) VALUES
(1, 'Service Report', '1712108811.jpg', 1),
(2, 'Service Report', '1712110027.jpg', 2),
(3, 'Service Report', '1712110116.jpg', 3),
(4, 'Service Report', '1712110208.jpg', 4),
(5, 'Service Report', '1712110874.jpg', 6),
(6, 'Service Report', '1712110948.jpg', 7),
(7, 'Service Report', '1712111026.jpg', 8),
(8, 'Service Report', '1712114668.jpg', 9),
(9, 'Service Report', '1712114724.jpg', 10),
(10, 'Service Report', '1712114795.jpg', 11),
(11, 'Service Report', '1712114851.jpg', 12),
(12, 'Service Report', '1712115004.jpg', 13),
(13, 'Service Report', '1712115063.jpg', 14),
(14, 'Service Report', '1712115133.jpg', 15),
(15, 'Service Report', '1712115242.jpg', 16),
(16, 'Service Report', '1712115252.jpg', 16),
(17, 'Service Report', '1712115327.jpg', 17),
(18, 'Service Report', '1712115656.jpg', 18),
(19, 'Service Report', '1712116493.jpg', 19),
(20, 'Service Report', '1712116544.jpg', 20),
(21, 'Service Report', '1712116596.jpg', 21),
(22, 'Service Report', '1712116645.jpg', 22),
(23, 'Service Report', '1712116694.jpg', 23),
(24, 'Service Report', '1712140993.jpg', 24),
(25, 'Before Unit', '1712141064.jpg', 25),
(26, 'Service Report', '1712141131.jpg', 26),
(27, 'Service Report', '1712141135.jpg', 26),
(28, 'Service Report', '1712141212.jpg', 27),
(29, 'Checklist', '1712141271.jpg', 28),
(30, 'Checklist', '1712141330.jpg', 29),
(31, 'Checklist', '1712153796.jpg', 30),
(32, 'Checklist', '1712153863.jpg', 31),
(35, 'Checklist', '1712153992.jpg', 32),
(36, 'Checklist', '1712154040.jpg', 33),
(37, 'Checklist', '1712154090.jpg', 34),
(38, 'Checklist', '1712154139.jpg', 35),
(39, 'Checklist', '1712154402.jpg', 36),
(40, 'Checklist', '1712154483.jpg', 37),
(41, 'Checklist', '1712154611.jpg', 39),
(42, 'Checklist', '1712154657.jpg', 40),
(43, 'Checklist', '1712154699.jpg', 41),
(44, 'Checklist', '1712154744.jpg', 42),
(45, 'Checklist', '1712154796.jpg', 43),
(46, 'Checklist', '1712154843.jpg', 44),
(47, 'Checklist', '1712154887.jpg', 45),
(48, 'Checklist', '1712154980.jpg', 46),
(49, 'Checklist', '1712155047.jpg', 47),
(50, 'Checklist', '1712155318.jpg', 49),
(51, 'Checklist', '1712155371.jpg', 50),
(52, 'Checklist', '1712155418.jpg', 51),
(53, 'Checklist', '1712155559.jpg', 52),
(54, 'Checklist', '1712155635.jpg', 53),
(55, 'Checklist', '1712155684.jpg', 54),
(56, 'Checklist', '1712155731.jpg', 55),
(57, 'Checklist', '1712155788.jpg', 56),
(58, 'Checklist', '1712155839.jpg', 57),
(59, 'Checklist', '1712155928.jpg', 59),
(60, 'Checklist', '1712155970.jpg', 60),
(61, 'Checklist', '1712156017.jpg', 61),
(62, 'Checklist', '1712156167.jpg', 62),
(63, 'Service Report', '1713496114.jpg', 63),
(64, 'Before Unit', '1713508127.jpg', 64),
(65, 'After Unit', '1713508163.jpg', 64);

-- --------------------------------------------------------

--
-- Table structure for table `dokumentrouble`
--

DROP TABLE IF EXISTS `dokumentrouble`;
CREATE TABLE IF NOT EXISTS `dokumentrouble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(100) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `idaction` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumentrouble`
--

INSERT INTO `dokumentrouble` (`id`, `keterangan`, `filename`, `idaction`) VALUES
(1, 'Service Report', '1712109654.jpg', 1),
(2, 'Service Report', '1712117257.jpg', 2),
(3, 'Service Report', '1712117387.jpg', 4),
(4, 'Service Report', '1712118708.jpg', 5),
(5, 'Service Report', '1712309812.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `forklifttype`
--

DROP TABLE IF EXISTS `forklifttype`;
CREATE TABLE IF NOT EXISTS `forklifttype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaforklifttype` varchar(100) NOT NULL,
  `f_dashboard` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forklifttype`
--

INSERT INTO `forklifttype` (`id`, `namaforklifttype`, `f_dashboard`) VALUES
(1, 'COUNTER BALANCE', 'Y'),
(2, 'REACH TRUCK', 'Y'),
(3, 'PALLET MOVER', 'Y'),
(4, 'PALLET STACKER', 'Y'),
(5, 'COUNTER BALANCE 3 WHEELS', 'Y'),
(6, 'REACHTRUCK TELESCOPIC DD', 'Y'),
(7, 'REACHTRUCK PANTOGRAPH DD', 'Y'),
(8, 'BATTERY', 'N'),
(9, 'HAND PALLET ELECTRIC', 'Y'),
(10, 'HAND PALLET MANUAL', 'N'),
(11, 'UNIT BACK UP FORKLIFT', 'N'),
(12, 'ATTACHMENT', 'N'),
(13, 'UNIT BACK UP REACH TRUCK', 'N'),
(14, 'UNIT BACK UP STACKER', 'N'),
(15, 'BATTERY SPARE', 'N'),
(17, 'TOWING TRUCK', 'N'),
(18, 'ORDER PICKER', 'N'),
(19, 'DRUM LIFTER', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `listoftrouble`
--

DROP TABLE IF EXISTS `listoftrouble`;
CREATE TABLE IF NOT EXISTS `listoftrouble` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `kdunit` varchar(20) DEFAULT NULL,
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
-- Table structure for table `loglogin`
--

DROP TABLE IF EXISTS `loglogin`;
CREATE TABLE IF NOT EXISTS `loglogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loglogin`
--

INSERT INTO `loglogin` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '2024-03-20 03:19:44', '2024-03-20 03:19:44'),
(2, 'admin@gmail.com', '2024-03-20 03:24:10', '2024-03-20 03:24:10'),
(3, 'admin@gmail.com', '2024-03-20 03:26:15', '2024-03-20 03:26:15'),
(4, 'irfan.agussandi@satriapiranti.co.id', '2024-03-20 03:28:35', '2024-03-20 03:28:35'),
(5, 'admin@gmail.com', '2024-03-20 05:58:00', '2024-03-20 05:58:00'),
(6, 'admin@gmail.com', '2024-03-20 20:45:21', '2024-03-20 20:45:21'),
(7, 'irfan.agussandi@satriapiranti.co.id', '2024-03-20 21:26:12', '2024-03-20 21:26:12'),
(8, 'arief.zunaidi@dhl.com', '2024-03-20 21:34:51', '2024-03-20 21:34:51'),
(9, 'irfan.agussandi@satriapiranti.co.id', '2024-03-20 21:35:21', '2024-03-20 21:35:21'),
(10, 'dimas-albert@satriapiranti.com', '2024-03-20 23:05:35', '2024-03-20 23:05:35'),
(11, 'farobi.bilhaq@dhl.com', '2024-03-21 02:14:30', '2024-03-21 02:14:30'),
(12, 'irfan.agussandi@satriapiranti.co.id', '2024-03-21 05:47:48', '2024-03-21 05:47:48'),
(13, 'irfan.agussandi@satriapiranti.co.id', '2024-03-21 18:17:46', '2024-03-21 18:17:46'),
(14, 'irfan.agussandi@satriapiranti.co.id', '2024-03-22 01:03:16', '2024-03-22 01:03:16'),
(15, 'irfan.agussandi@satriapiranti.co.id', '2024-03-24 20:39:15', '2024-03-24 20:39:15'),
(16, 'dimas-albert@satriapiranti.com', '2024-03-25 20:02:55', '2024-03-25 20:02:55'),
(17, 'bayu.p@satriapiranti.co.id', '2024-03-26 23:24:49', '2024-03-26 23:24:49'),
(18, 'admin@gmail.com', '2024-03-26 23:27:59', '2024-03-26 23:27:59'),
(19, 'admin@gmail.com', '2024-03-27 00:27:59', '2024-03-27 00:27:59'),
(20, 'admin@gmail.com', '2024-03-27 01:06:54', '2024-03-27 01:06:54'),
(21, 'admin@gmail.com', '2024-03-27 19:25:21', '2024-03-27 19:25:21'),
(22, 'admin@gmail.com', '2024-03-27 21:59:14', '2024-03-27 21:59:14'),
(23, 'admin@gmail.com', '2024-03-28 01:38:02', '2024-03-28 01:38:02'),
(24, 'irfan.agussandi@satriapiranti.co.id', '2024-04-01 04:57:51', '2024-04-01 04:57:51'),
(25, 'arief.zunaidi@dhl.com', '2024-04-01 06:15:32', '2024-04-01 06:15:32'),
(26, 'widhya.sari@dhl.com', '2024-04-01 06:22:21', '2024-04-01 06:22:21'),
(27, 'andika.purnama@dhl.com', '2024-04-01 06:25:28', '2024-04-01 06:25:28'),
(28, 'chairun.rezki@dhl.com', '2024-04-01 06:27:03', '2024-04-01 06:27:03'),
(29, 'indra.sukmono@dhl.com', '2024-04-01 06:28:35', '2024-04-01 06:28:35'),
(30, 'irfan.agussandi@satriapiranti.co.id', '2024-04-01 18:16:38', '2024-04-01 18:16:38'),
(31, 'ikhsan.tahir@dhl.com', '2024-04-01 18:20:35', '2024-04-01 18:20:35'),
(32, 'paskah.kurniawan@dhl.com', '2024-04-01 18:21:57', '2024-04-01 18:21:57'),
(33, 'paskah.kurniawan2@dhl.com', '2024-04-01 18:23:25', '2024-04-01 18:23:25'),
(34, 'amirah.a.madilao@dhl.com', '2024-04-01 18:25:11', '2024-04-01 18:25:11'),
(35, 'gitra.hendrawan@dhl.com', '2024-04-01 18:27:15', '2024-04-01 18:27:15'),
(36, 'nani.kusuma@dhl.co.id', '2024-04-01 18:30:04', '2024-04-01 18:30:04'),
(37, 'yungki.alhamdi@dhl.com', '2024-04-01 18:31:19', '2024-04-01 18:31:19'),
(38, 'ika.radita@dhl.com', '2024-04-01 18:32:48', '2024-04-01 18:32:48'),
(39, 'farobi.bilhaq@dhl.com', '2024-04-01 18:33:58', '2024-04-01 18:33:58'),
(40, 'jesse.valentino@dhl.com', '2024-04-01 18:35:42', '2024-04-01 18:35:42'),
(41, 'demodhl@gmail.com', '2024-04-01 18:41:38', '2024-04-01 18:41:38'),
(42, 'irfan.agussandi@satriapiranti.co.id', '2024-04-01 18:41:51', '2024-04-01 18:41:51'),
(43, 'admin@gmail.com', '2024-04-01 20:38:59', '2024-04-01 20:38:59'),
(44, 'irfan.agussandi@satriapiranti.co.id', '2024-04-02 01:03:15', '2024-04-02 01:03:15'),
(45, 'irfan.agussandi@satriapiranti.co.id', '2024-04-02 05:27:10', '2024-04-02 05:27:10'),
(46, 'paskah.kurniawan@dhl.com', '2024-04-02 05:38:21', '2024-04-02 05:38:21'),
(47, 'purwakarta@dhl.com', '2024-04-02 06:10:28', '2024-04-02 06:10:28'),
(48, 'irfan.agussandi@satriapiranti.co.id', '2024-04-02 18:26:01', '2024-04-02 18:26:01'),
(49, 'puninarnagrak@gmail.com', '2024-04-03 00:33:04', '2024-04-03 00:33:04'),
(50, 'chairun.rezki@dhl.com', '2024-04-03 00:33:29', '2024-04-03 00:33:29'),
(51, 'irfan.agussandi@satriapiranti.co.id', '2024-04-03 00:56:25', '2024-04-03 00:56:25'),
(52, 'bayu.p@satriapiranti.co.id', '2024-04-03 01:25:04', '2024-04-03 01:25:04'),
(53, 'irfan.agussandi@satriapiranti.co.id', '2024-04-03 07:14:00', '2024-04-03 07:14:00'),
(54, 'irfan.agussandi@satriapiranti.co.id', '2024-04-03 21:01:09', '2024-04-03 21:01:09'),
(55, 'irfan.agussandi@satriapiranti.co.id', '2024-04-05 01:03:25', '2024-04-05 01:03:25'),
(56, 'irfan.agussandi@satriapiranti.co.id', '2024-04-05 18:37:46', '2024-04-05 18:37:46'),
(57, 'arief.zunaidi@dhl.com', '2024-04-05 18:40:41', '2024-04-05 18:40:41'),
(58, 'widhya.sari@dhl.com', '2024-04-05 18:41:16', '2024-04-05 18:41:16'),
(59, 'andika.purnama@dhl.com', '2024-04-05 18:42:06', '2024-04-05 18:42:06'),
(60, 'jesse.valentino@dhl.com', '2024-04-05 18:42:19', '2024-04-05 18:42:19'),
(61, 'chairun.rezki@dhl.com', '2024-04-05 18:42:40', '2024-04-05 18:42:40'),
(62, 'farobi.bilhaq@dhl.com', '2024-04-05 18:42:50', '2024-04-05 18:42:50'),
(63, 'indra.sukmono@dhl.com', '2024-04-05 18:43:01', '2024-04-05 18:43:01'),
(64, 'ikhsan.tahir@dhl.com', '2024-04-05 18:43:10', '2024-04-05 18:43:10'),
(65, 'paskah.kurniawan@dhl.com', '2024-04-05 18:43:28', '2024-04-05 18:43:28'),
(66, 'paskah.kurniawan@dhl.com', '2024-04-05 18:43:37', '2024-04-05 18:43:37'),
(67, 'amirah.a.madilao@dhl.com', '2024-04-05 18:43:49', '2024-04-05 18:43:49'),
(68, 'gitra.hendrawan@dhl.com', '2024-04-05 18:44:08', '2024-04-05 18:44:08'),
(69, 'ika.radita@dhl.com', '2024-04-05 18:44:16', '2024-04-05 18:44:16'),
(70, 'nani.kusuma@dhl.com', '2024-04-05 18:45:02', '2024-04-05 18:45:02'),
(71, 'jesse.valentino@dhl.com', '2024-04-05 18:45:35', '2024-04-05 18:45:35'),
(72, 'nani.kusuma@dhl.co.id', '2024-04-05 21:13:18', '2024-04-05 21:13:18'),
(73, 'irfan.agussandi@satriapiranti.co.id', '2024-04-05 21:13:30', '2024-04-05 21:13:30'),
(74, 'demodhl@gmail.com', '2024-04-05 21:15:51', '2024-04-05 21:15:51'),
(75, 'demodhl@gmail.com', '2024-04-05 21:19:41', '2024-04-05 21:19:41'),
(76, 'irfan.agussandi@satriapiranti.co.id', '2024-04-08 02:58:47', '2024-04-08 02:58:47'),
(77, 'irfan.agussandi@satriapiranti.co.id', '2024-04-08 23:49:39', '2024-04-08 23:49:39'),
(78, 'irfan.agussandi@satriapiranti.co.id', '2024-04-15 17:53:38', '2024-04-15 17:53:38'),
(79, 'irfan.agussandi@satriapiranti.co.id', '2024-04-16 18:30:57', '2024-04-16 18:30:57'),
(80, 'bayu.p@satriapiranti.co.id', '2024-04-16 22:46:28', '2024-04-16 22:46:28'),
(81, 'irfan.agussandi@satriapiranti.co.id', '2024-04-18 00:49:03', '2024-04-18 00:49:03'),
(82, 'dimas-albert@satriapiranti.com', '2024-04-18 00:49:20', '2024-04-18 00:49:20'),
(83, 'jesse.valentino@dhl.com', '2024-04-18 01:54:27', '2024-04-18 01:54:27'),
(84, 'bayu.p@satriapiranti.co.id', '2024-04-18 01:54:35', '2024-04-18 01:54:35'),
(85, 'admin@gmail.com', '2024-04-18 02:05:52', '2024-04-18 02:05:52'),
(86, 'admin@gmail.com', '2024-04-18 02:50:14', '2024-04-18 02:50:14'),
(87, 'irfan.agussandi@satriapiranti.co.id', '2024-04-18 18:25:25', '2024-04-18 18:25:25'),
(88, 'indra.sukmono@dhl.com', '2024-04-18 18:30:52', '2024-04-18 18:30:52'),
(89, 'admin@gmail.com', '2024-04-18 20:05:09', '2024-04-18 20:05:09'),
(90, 'admin@gmail.com', '2024-04-18 20:22:45', '2024-04-18 20:22:45'),
(91, 'dimas-albert@satriapiranti.com', '2024-04-19 02:16:57', '2024-04-19 02:16:57'),
(92, 'andika.purnama@dhl.com', '2024-04-19 02:45:03', '2024-04-19 02:45:03'),
(93, 'irfan.agussandi@satriapiranti.co.id', '2024-04-19 19:02:44', '2024-04-19 19:02:44'),
(94, 'demodhl@gmail.com', '2024-04-19 19:17:12', '2024-04-19 19:17:12'),
(95, 'demodhl@gmail.com', '2024-04-19 19:18:03', '2024-04-19 19:18:03'),
(96, 'irfan.agussandi@satriapiranti.co.id', '2024-04-19 20:35:02', '2024-04-19 20:35:02'),
(97, 'ajat.agustina@satriapiranti.co.id', '2024-04-20 01:05:43', '2024-04-20 01:05:43'),
(98, 'irfan.agussandi@satriapiranti.co.id', '2024-04-20 01:06:51', '2024-04-20 01:06:51'),
(99, 'ajat.agustina@satriapiranti.co.id', '2024-04-20 01:08:57', '2024-04-20 01:08:57'),
(100, 'surya.ambrullah@gmail.com', '2024-04-21 07:18:53', '2024-04-21 07:18:53'),
(101, 'demodhl@gmail.com', '2024-04-21 18:59:56', '2024-04-21 18:59:56'),
(102, 'bayu.p@satriapiranti.co.id', '2024-04-21 19:32:10', '2024-04-21 19:32:10'),
(103, 'admin@gmail.com', '2024-04-21 19:32:12', '2024-04-21 19:32:12'),
(104, 'demodhl@gmail.com', '2024-04-21 20:52:33', '2024-04-21 20:52:33'),
(105, 'dimas-albert@satriapiranti.com', '2024-04-21 21:09:09', '2024-04-21 21:09:09'),
(106, 'amirah.a.madilao@dhl.com', '2024-04-21 21:17:55', '2024-04-21 21:17:55'),
(107, 'andika.purnama@dhl.com', '2024-04-21 21:18:22', '2024-04-21 21:18:22'),
(108, 'amirah.a.madilao@dhl.com', '2024-04-21 21:18:31', '2024-04-21 21:18:31'),
(109, 'farobi.bilhaq@dhl.com', '2024-04-21 21:19:45', '2024-04-21 21:19:45'),
(110, 'andika.purnama@dhl.com', '2024-04-21 21:20:04', '2024-04-21 21:20:04'),
(111, 'jesse.valentino@dhl.com', '2024-04-21 21:21:16', '2024-04-21 21:21:16'),
(112, 'demodhl@gmail.com', '2024-04-21 21:21:53', '2024-04-21 21:21:53'),
(113, 'ikhsan.tahir@dhl.com', '2024-04-21 21:21:55', '2024-04-21 21:21:55'),
(114, 'hendra.sudrajat@puninar.com', '2024-04-21 21:22:36', '2024-04-21 21:22:36'),
(115, 'jesse.valentino@dhl.com', '2024-04-21 21:35:58', '2024-04-21 21:35:58'),
(116, 'amirah.a.madilao@dhl.com', '2024-04-21 21:39:42', '2024-04-21 21:39:42'),
(117, 'indra.sukmono@dhl.com', '2024-04-21 21:45:36', '2024-04-21 21:45:36'),
(118, 'chairun.rezki@dhl.com', '2024-04-21 21:53:38', '2024-04-21 21:53:38'),
(119, 'chairun.rezki@dhl.com', '2024-04-21 22:04:31', '2024-04-21 22:04:31'),
(120, 'arief.zunaidi@dhl.com', '2024-04-21 22:05:50', '2024-04-21 22:05:50'),
(121, 'arief.zunaidi@dhl.com', '2024-04-21 22:08:02', '2024-04-21 22:08:02'),
(122, 'arief.zunaidi@dhl.com', '2024-04-21 22:08:18', '2024-04-21 22:08:18'),
(123, 'widhya.sari@dhl.com', '2024-04-21 22:10:15', '2024-04-21 22:10:15'),
(124, 'andika.purnama@dhl.com', '2024-04-21 22:10:42', '2024-04-21 22:10:42'),
(125, 'andika.purnama@dhl.com', '2024-04-21 22:10:49', '2024-04-21 22:10:49'),
(126, 'andika.purnama@dhl.com', '2024-04-21 22:13:04', '2024-04-21 22:13:04'),
(127, 'indra.sukmono@dhl.com', '2024-04-21 22:13:44', '2024-04-21 22:13:44'),
(128, 'indra.sukmono@dhl.com', '2024-04-21 22:15:37', '2024-04-21 22:15:37'),
(129, 'ikhsan.tahir@dhl.com', '2024-04-21 22:16:17', '2024-04-21 22:16:17'),
(130, 'ikhsan.tahir@dhl.com', '2024-04-21 23:02:34', '2024-04-21 23:02:34'),
(131, 'farobi.bilhaq@dhl.com', '2024-04-21 23:04:57', '2024-04-21 23:04:57'),
(132, 'andika.purnama@dhl.com', '2024-04-21 23:05:07', '2024-04-21 23:05:07'),
(133, 'paskah.kurniawan@dhl.com', '2024-04-21 23:06:56', '2024-04-21 23:06:56'),
(134, 'paskah.kurniawan@dhl.com', '2024-04-21 23:11:12', '2024-04-21 23:11:12'),
(135, 'paskah.kurniawan2@dhl.com', '2024-04-21 23:11:25', '2024-04-21 23:11:25'),
(136, 'amirah.a.madilao@dhl.com', '2024-04-21 23:12:45', '2024-04-21 23:12:45'),
(137, 'amirah.a.madilao@dhl.com', '2024-04-21 23:13:12', '2024-04-21 23:13:12'),
(138, 'amirah.a.madilao@dhl.com', '2024-04-21 23:15:58', '2024-04-21 23:15:58'),
(139, 'gitra.hendrawan@dhl.com', '2024-04-21 23:16:08', '2024-04-21 23:16:08'),
(140, 'gitra.hendrawan@dhl.com', '2024-04-21 23:17:48', '2024-04-21 23:17:48'),
(141, 'gitra.hendrawan@dhl.com', '2024-04-21 23:22:34', '2024-04-21 23:22:34'),
(142, 'nani.kusuma@dhl.com', '2024-04-21 23:24:34', '2024-04-21 23:24:34'),
(143, 'nani.kusuma@dhl.com', '2024-04-21 23:24:56', '2024-04-21 23:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` int(11) DEFAULT NULL,
  `kdunit` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `hm` int(11) DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT 'OPEN',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenanceaction`
--

DROP TABLE IF EXISTS `maintenanceaction`;
CREATE TABLE IF NOT EXISTS `maintenanceaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kdunit` varchar(20) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggalmulai` date DEFAULT NULL,
  `tanggalakhir` date DEFAULT NULL,
  `shift` varchar(20) DEFAULT NULL,
  `actionplan` text DEFAULT NULL,
  `sparepart` text DEFAULT NULL,
  `hm` int(11) DEFAULT NULL,
  `statusspp` varchar(10) DEFAULT 'OPEN',
  `statusmekanik` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT 'OPEN',
  PRIMARY KEY (`id`),
  KEY `kdunit` (`kdunit`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenanceaction`
--

INSERT INTO `maintenanceaction` (`id`, `kdunit`, `iduser`, `tanggalmulai`, `tanggalakhir`, `shift`, `actionplan`, `sparepart`, `hm`, `statusspp`, `statusmekanik`, `statuscustomer`) VALUES
(1, '19-131', 330, '2024-02-08', '2024-02-08', '1', 'Maintenance dan pengecekan battery', '-', 12602, 'OPEN', 'CLOSE', 'OPEN'),
(2, '19-074', 330, '2024-01-24', '2024-01-24', '1', 'Pengisian air accu', 'Air accu', 1152, 'OPEN', 'CLOSE', 'OPEN'),
(3, '17-124', 330, '2024-01-29', '2024-01-29', '1', 'Pengisian air accu', 'Air accu', 4729, 'OPEN', 'CLOSE', 'OPEN'),
(4, '19-131', 330, '2024-01-29', '2024-01-29', '1', 'Pengisian air accu', 'Air accu', 11170, 'OPEN', 'CLOSE', 'OPEN'),
(5, '13-153', 330, '2024-01-29', '2024-01-29', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(6, '13-153', 330, '2024-01-29', '2024-01-29', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(7, '19-130', 330, '2024-01-29', '2024-01-29', '1', 'Pengisian air accu', 'Air accu', 131219, 'OPEN', 'CLOSE', 'OPEN'),
(8, '19-129', 330, '2024-01-29', '2024-01-29', '1', 'Pengisian air accu', 'Air accu', 11410, 'OPEN', 'CLOSE', 'OPEN'),
(9, '17-124', 330, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(10, '19-131', 330, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(11, '13-153', 330, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(12, '19-074', 330, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(13, '19-130', 330, '2024-02-07', '2024-02-07', '1', 'Penambahan oli hydraulic', 'Oli hydraulic', 0, 'OPEN', 'CLOSE', 'OPEN'),
(14, '13-153', 330, '2024-02-07', '2024-02-07', '1', 'Penambahan oli hydraulic', 'Oli hydraulic', 0, 'OPEN', 'CLOSE', 'OPEN'),
(15, '17-124', 330, '2024-02-07', '2024-02-07', '1', 'Penambahan oli hydraulic', 'Oli hydraulic', 0, 'OPEN', 'CLOSE', 'OPEN'),
(16, '19-131', 330, '2024-02-07', '2024-02-07', '1', 'Penambahan oli hydraulic', 'Oli hydraulic', 0, 'OPEN', 'CLOSE', 'OPEN'),
(17, '19-074', 330, '2024-02-07', '2024-02-07', '1', 'Penambahan oli hydraulic', 'Oli hydraulic', 0, 'OPEN', 'CLOSE', 'OPEN'),
(18, 'E7660', 331, '2024-02-07', '2024-02-07', '1', 'Penambahan oli hydraulic', 'Oli hydraulic', 0, 'OPEN', 'CLOSE', 'OPEN'),
(19, '20-331', 333, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(20, '20-325', 333, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(21, '20-326', 333, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(22, '20-327', 333, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(23, '20-324', 333, '2024-02-07', '2024-02-07', '1', 'Pengisian air accu', 'Air accu', 0, 'OPEN', 'CLOSE', 'OPEN'),
(24, '20-326', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(25, '20-325', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(26, '20-324', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(27, '20-331', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(28, '20-330', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(29, '20-332', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(30, '20-327', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(31, '20-377', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(32, '20-328', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(33, '21-488', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(34, '15-165', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(35, 'E7336', 333, '2024-01-24', '2024-01-24', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(36, 'E7336', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(37, '15-165', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(38, '21-488', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(39, '21-488', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(40, '20-377', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(41, '20-328', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(42, '20-327', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(43, '20-324', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(44, '20-330', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(45, '20-331', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(46, '20-332', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(47, '20-325', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(48, '20-326', 333, '2024-02-07', '2024-02-07', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(49, '20-328', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(50, '21-488', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(51, '20-327', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(52, '20-332', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(53, '20-325', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(54, '15-165', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(55, '20-324', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(56, '20-331', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(57, '20-330', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(58, '20-326', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(59, '20-377', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(60, 'E7336', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(61, '20-335', 333, '2023-12-21', '2023-12-21', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(62, '14-307', 336, '2024-02-20', '2024-02-20', '1', 'Maintenance Rutin', '-', 0, 'OPEN', 'CLOSE', 'OPEN'),
(63, 'E8069', 334, '2024-02-23', '2024-02-23', '1', 'penggantian Drive dan Caster wheel', 'Drive dan Caster wheel', 0, 'CLOSE', 'CLOSE', 'OPEN'),
(64, '19-043', 321, '2024-04-19', '2024-04-19', '1', 'preventive maitenance', '0', 0, 'OPEN', 'CLOSE', 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `mekanik`
--

DROP TABLE IF EXISTS `mekanik`;
CREATE TABLE IF NOT EXISTS `mekanik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `namamekanik` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'male',
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nohp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `idsitename` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mekanik`
--

INSERT INTO `mekanik` (`id`, `userid`, `namamekanik`, `gender`, `address`, `nohp`, `idsitename`, `created_at`, `updated_at`) VALUES
(1, 320, 'Mitra 10 Solo', 'male', NULL, NULL, 'SM1', NULL, NULL),
(2, 321, 'Mitra 10 Jogja', 'male', NULL, NULL, 'SM2', NULL, NULL),
(3, 322, 'Pt. Schenker Petrolog Utama Solo', 'male', NULL, NULL, 'SPG1', NULL, NULL),
(4, 323, 'Pt Parama Global Inspira Jogja', 'male', NULL, NULL, 'SPG2', NULL, NULL),
(5, 324, 'Bukitmega Massabadi Solo', 'male', NULL, NULL, 'SB1', NULL, NULL),
(6, 325, 'Sinarmas Distribusi Nusantara Solo', 'male', NULL, NULL, 'SS1', NULL, NULL),
(7, 326, 'Pt Tigaraksa Satria Cangkringan', 'male', NULL, NULL, 'ST2', NULL, NULL),
(8, 327, 'Pt Macrosentra Niagaboga', 'male', NULL, NULL, 'SMN1', NULL, NULL),
(9, 330, 'Abdurrohman', 'male', NULL, NULL, 'JDC', NULL, NULL),
(10, 331, 'Faisal', 'male', NULL, NULL, 'TXZ', NULL, NULL),
(11, 333, 'M Subeki', 'male', NULL, NULL, 'LOC1', NULL, NULL),
(12, 334, 'Surya Ambrullah', 'male', NULL, NULL, 'BPN', NULL, NULL),
(13, 336, 'Sopiandi', 'male', NULL, NULL, 'GTW', NULL, NULL),
(14, 340, 'Sugeng', 'male', NULL, NULL, 'DHL1', NULL, NULL),
(15, 342, 'Agus Supriyanto', 'male', NULL, NULL, 'SOC', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
CREATE TABLE IF NOT EXISTS `office` (
  `idoffice` varchar(10) NOT NULL,
  `namaoffice` varchar(100) NOT NULL,
  PRIMARY KEY (`idoffice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`idoffice`, `namaoffice`) VALUES
('O001', 'Jawa Tengah dan DIY'),
('O002', 'Jakarta'),
('O003', 'Jawa Timur');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `noorder` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `dateorder` date NOT NULL,
  `dateaccsite` date DEFAULT NULL,
  `dateaccho` date DEFAULT NULL,
  `dateaccgudang` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kdunit` varchar(20) NOT NULL,
  `f_accsite` varchar(1) NOT NULL DEFAULT '0',
  `f_accho` varchar(1) NOT NULL DEFAULT '0',
  `f_accgudang` varchar(1) NOT NULL DEFAULT '0',
  `emailaccsite` varchar(100) DEFAULT NULL,
  `emailaccho` varchar(100) DEFAULT NULL,
  `emailaccgudang` varchar(100) DEFAULT NULL,
  `f_status` varchar(10) NOT NULL DEFAULT 'order',
  `idsitename` varchar(10) NOT NULL,
  PRIMARY KEY (`noorder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pallete`
--

DROP TABLE IF EXISTS `pallete`;
CREATE TABLE IF NOT EXISTS `pallete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
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
-- Table structure for table `palleterenew`
--

DROP TABLE IF EXISTS `palleterenew`;
CREATE TABLE IF NOT EXISTS `palleterenew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `totalrent` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `statusspp` varchar(10) DEFAULT NULL,
  `statuscustomer` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physicalavailable`
--

DROP TABLE IF EXISTS `physicalavailable`;
CREATE TABLE IF NOT EXISTS `physicalavailable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `periode` varchar(7) DEFAULT NULL,
  `kdunit` varchar(20) DEFAULT NULL,
  `harikerja` int(11) DEFAULT NULL,
  `planunitkerja` int(11) DEFAULT NULL,
  `totalbreakdown` int(11) DEFAULT 0,
  `totalbackup` int(11) DEFAULT 0,
  `totaljamkerja` int(11) DEFAULT 0,
  `paforklift` double DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `kdunit` (`kdunit`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `physicalavailable`
--

INSERT INTO `physicalavailable` (`id`, `idcbu`, `idregion`, `idsitename`, `periode`, `kdunit`, `harikerja`, `planunitkerja`, `totalbreakdown`, `totalbackup`, `totaljamkerja`, `paforklift`) VALUES
(1, 'BS', 'DHL', 'DHL1', '2024-03', 'E8061', 31, 44640, 0, 0, 44640, 100),
(2, 'BS', 'DHL', 'DHL1', '2024-03', 'E8063', 31, 44640, 0, 0, 44640, 100),
(4, 'BS', 'DHL', 'DHL11', '2024-03', '13-153', 31, 44640, 0, 0, 44640, 100),
(5, 'BS', 'DHL', 'DHL11', '2024-03', '17-124', 31, 44640, 0, 0, 44640, 100),
(6, 'BS', 'DHL', 'DHL11', '2024-03', '19-074', 31, 44640, 0, 0, 44640, 100),
(7, 'BS', 'DHL', 'DHL11', '2024-03', '19-129', 31, 44640, 0, 0, 44640, 100),
(8, 'BS', 'DHL', 'DHL11', '2024-03', '19-130', 31, 44640, 0, 0, 44640, 100),
(9, 'BS', 'DHL', 'DHL11', '2024-03', '19-131', 31, 44640, 0, 0, 44640, 100),
(10, 'BS', 'DHL', 'DHL12', '2024-03', 'E7660', 31, 44640, 0, 0, 44640, 100),
(11, 'BS', 'DHL', 'DHL13', '2024-03', '13-259', 31, 44640, 0, 0, 44640, 100),
(12, 'BS', 'DHL', 'DHL2', '2024-03', 'E8062', 31, 44640, 0, 0, 44640, 100),
(13, 'BS', 'DHL', 'DHL3', '2024-03', '18-349', 31, 44640, 0, 0, 44640, 100),
(14, 'BS', 'DHL', 'DHL3', '2024-03', 'E8075', 31, 44640, 0, 0, 44640, 100),
(15, 'BS', 'DHL', 'DHL4', '2024-03', 'E8060', 31, 44640, 0, 0, 44640, 100),
(16, 'BS', 'DHL', 'DHL5', '2024-03', 'E8064', 31, 44640, 0, 0, 44640, 100),
(17, 'BS', 'DHL', 'DHL5', '2024-03', 'E8069', 31, 44640, 0, 0, 44640, 100),
(18, 'BS', 'DHL', 'DHL6', '2024-03', 'E8092', 31, 44640, 0, 0, 44640, 100),
(19, 'BS', 'DHL', 'DHL7', '2024-03', 'E8070', 31, 44640, 0, 0, 44640, 100),
(20, 'BS', 'DHL', 'DHL8', '2024-03', '14-307', 31, 44640, 0, 0, 44640, 100),
(21, 'BS', 'DHL', 'DHL8', '2024-03', '14-308', 31, 44640, 0, 0, 44640, 100),
(22, 'BS', 'DHL', 'DHL9', '2024-03', 'E8055', 31, 44640, 0, 0, 44640, 100),
(23, 'PSR', 'PSR1', 'LOC1', '2024-03', '15-165', 31, 44640, 0, 0, 44640, 100),
(24, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-324', 31, 44640, 0, 0, 44640, 100),
(25, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-325', 31, 44640, 0, 0, 44640, 100),
(26, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-326', 31, 44640, 0, 0, 44640, 100),
(27, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-327', 31, 44640, 0, 0, 44640, 100),
(28, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-328', 31, 44640, 0, 0, 44640, 100),
(29, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-330', 31, 44640, 0, 0, 44640, 100),
(30, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-331', 31, 44640, 0, 0, 44640, 100),
(31, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-332', 31, 44640, 0, 0, 44640, 100),
(32, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-335', 31, 44640, 0, 0, 44640, 100),
(33, 'PSR', 'PSR1', 'LOC1', '2024-03', '20-377', 31, 44640, 0, 0, 44640, 100),
(34, 'PSR', 'PSR1', 'LOC1', '2024-03', '21-488', 31, 44640, 0, 0, 44640, 100),
(35, 'PSR', 'PSR1', 'LOC1', '2024-03', 'E7336', 31, 44640, 0, 0, 44640, 100),
(36, 'SJ1', 'STSJ1', 'SB1', '2024-03', '20-107', 31, 44640, 0, 0, 44640, 100),
(37, 'SJ1', 'STSJ1', 'SB1', '2024-03', '20-240', 31, 44640, 0, 0, 44640, 100),
(38, 'SJ1', 'STSJ1', 'SB1', '2024-03', 'E8010', 31, 44640, 0, 0, 44640, 100),
(39, 'SJ1', 'STSJ1', 'SB1', '2024-02', '20-107', 29, 41760, 0, 0, 41760, 100),
(40, 'SJ1', 'STSJ1', 'SB1', '2024-02', '20-240', 29, 41760, 0, 0, 41760, 100),
(41, 'SJ1', 'STSJ1', 'SB1', '2024-02', 'E8010', 29, 41760, 0, 0, 41760, 100),
(42, 'SJ1', 'STSJ1', 'SB1', '2024-01', '20-107', 31, 44640, 0, 0, 44640, 100),
(43, 'SJ1', 'STSJ1', 'SB1', '2024-01', '20-240', 31, 44640, 0, 0, 44640, 100),
(44, 'SJ1', 'STSJ1', 'SB1', '2024-01', 'E8010', 31, 44640, 0, 0, 44640, 100),
(45, 'SJ1', 'STSJ1', 'SM1', '2024-03', '19-092', 31, 44640, 0, 0, 44640, 100),
(46, 'SJ1', 'STSJ1', 'SM1', '2024-03', '19-269', 31, 44640, 0, 0, 44640, 100),
(47, 'SJ1', 'STSJ1', 'SM1', '2024-03', '19-270', 31, 44640, 0, 0, 44640, 100),
(48, 'SJ1', 'STSJ1', 'SM1', '2024-03', 'XT0219', 31, 44640, 0, 0, 44640, 100),
(49, 'SJ1', 'STSJ1', 'SM1', '2024-02', '19-092', 29, 41760, 0, 0, 41760, 100),
(50, 'SJ1', 'STSJ1', 'SM1', '2024-02', '19-269', 29, 41760, 0, 0, 41760, 100),
(51, 'SJ1', 'STSJ1', 'SM1', '2024-02', '19-270', 29, 41760, 0, 0, 41760, 100),
(52, 'SJ1', 'STSJ1', 'SM1', '2024-02', 'XT0219', 29, 41760, 0, 0, 41760, 100),
(53, 'SJ1', 'STSJ1', 'SM1', '2024-01', '19-092', 31, 44640, 0, 0, 44640, 100),
(54, 'SJ1', 'STSJ1', 'SM1', '2024-01', '19-269', 31, 44640, 0, 0, 44640, 100),
(55, 'SJ1', 'STSJ1', 'SM1', '2024-01', '19-270', 31, 44640, 0, 0, 44640, 100),
(56, 'SJ1', 'STSJ1', 'SM1', '2024-01', 'XT0219', 31, 44640, 0, 0, 44640, 100),
(57, 'SJ1', 'STSJ1', 'SM2', '2024-03', '19-043', 31, 44640, 0, 0, 44640, 100),
(58, 'SJ1', 'STSJ1', 'SM2', '2024-03', '19-128', 31, 44640, 0, 0, 44640, 100),
(59, 'SJ1', 'STSJ1', 'SM2', '2024-03', '19-164', 31, 44640, 0, 0, 44640, 100),
(60, 'SJ1', 'STSJ1', 'SM2', '2024-03', '20-112', 31, 44640, 0, 0, 44640, 100),
(61, 'SJ1', 'STSJ1', 'SM2', '2024-03', 'E7308', 31, 44640, 0, 0, 44640, 100),
(62, 'SJ1', 'STSJ1', 'SM2', '2024-02', '19-043', 29, 41760, 0, 0, 41760, 100),
(63, 'SJ1', 'STSJ1', 'SM2', '2024-02', '19-128', 29, 41760, 0, 0, 41760, 100),
(64, 'SJ1', 'STSJ1', 'SM2', '2024-02', '19-164', 29, 41760, 0, 0, 41760, 100),
(65, 'SJ1', 'STSJ1', 'SM2', '2024-02', '20-112', 29, 41760, 0, 0, 41760, 100),
(66, 'SJ1', 'STSJ1', 'SM2', '2024-02', 'E7308', 29, 41760, 0, 0, 41760, 100),
(67, 'SJ1', 'STSJ1', 'SM2', '2024-01', '19-043', 31, 44640, 0, 0, 44640, 100),
(68, 'SJ1', 'STSJ1', 'SM2', '2024-01', '19-128', 31, 44640, 0, 0, 44640, 100),
(69, 'SJ1', 'STSJ1', 'SM2', '2024-01', '19-164', 31, 44640, 0, 0, 44640, 100),
(70, 'SJ1', 'STSJ1', 'SM2', '2024-01', '20-112', 31, 44640, 0, 0, 44640, 100),
(71, 'SJ1', 'STSJ1', 'SM2', '2024-01', 'E7308', 31, 44640, 0, 0, 44640, 100),
(72, 'SJ1', 'STSJ1', 'SMN1', '2024-03', 'E8111', 31, 44640, 0, 0, 44640, 100),
(73, 'SJ1', 'STSJ1', 'SMN1', '2024-03', 'E8112', 31, 44640, 0, 0, 44640, 100),
(74, 'SJ1', 'STSJ1', 'SMN1', '2024-02', 'E8111', 29, 41760, 0, 0, 41760, 100),
(75, 'SJ1', 'STSJ1', 'SMN1', '2024-02', 'E8112', 29, 41760, 0, 0, 41760, 100),
(76, 'SJ1', 'STSJ1', 'SPG1', '2024-03', '19-479', 31, 44640, 0, 0, 44640, 100),
(77, 'SJ1', 'STSJ1', 'SPG1', '2024-02', '19-479', 29, 41760, 0, 0, 41760, 100),
(78, 'SJ1', 'STSJ1', 'SPG1', '2024-01', '19-479', 31, 44640, 0, 0, 44640, 100),
(79, 'SJ1', 'STSJ1', 'SPG2', '2024-03', 'E7150', 31, 44640, 0, 0, 44640, 100),
(80, 'SJ1', 'STSJ1', 'SPG2', '2024-02', 'E7150', 29, 41760, 0, 0, 41760, 100),
(81, 'SJ1', 'STSJ1', 'SPG2', '2024-01', 'E7150', 31, 44640, 0, 0, 44640, 100),
(82, 'SJ1', 'STSJ1', 'SS1', '2024-03', '20-350', 31, 44640, 0, 0, 44640, 100),
(83, 'SJ1', 'STSJ1', 'SS1', '2024-02', '20-350', 29, 41760, 0, 0, 41760, 100),
(84, 'SJ1', 'STSJ1', 'SS1', '2024-01', '20-350', 31, 44640, 0, 0, 44640, 100),
(85, 'SJ1', 'STSJ1', 'ST2', '2024-03', '19-158', 31, 44640, 0, 0, 44640, 100),
(86, 'SJ1', 'STSJ1', 'ST2', '2024-02', '19-158', 29, 41760, 0, 0, 41760, 100),
(87, 'SJ1', 'STSJ1', 'ST2', '2024-01', '19-158', 31, 44640, 0, 0, 44640, 100),
(88, 'SJ1', 'STSJ1', 'SM1', '2024-03', 'E 8139', 31, 44640, 0, 0, 44640, 100),
(89, 'SJ1', 'STSJ1', 'SM1', '2024-02', 'E 8139', 29, 41760, 0, 0, 41760, 100),
(90, 'SJ1', 'STSJ1', 'SM1', '2024-01', 'E 8139', 31, 44640, 0, 0, 44640, 100),
(93, 'BS', 'DHL', 'BPN', '2024-04', 'E8064', 30, 43200, 0, 0, 43200, 100),
(94, 'BS', 'DHL', 'BPN', '2024-04', 'E8069', 30, 43200, 0, 0, 43200, 100),
(95, 'BS', 'DHL', 'BQZ', '2024-04', 'E8062', 30, 43200, 0, 0, 43200, 100),
(96, 'BS', 'DHL', 'BTH', '2024-04', 'E8092', 30, 43200, 0, 0, 43200, 100),
(97, 'BS', 'DHL', 'DHL1', '2024-04', '20-428', 30, 43200, 73, 0, 43127, 99.8310185),
(98, 'BS', 'DHL', 'DPS', '2024-04', '18-322', 30, 43200, 0, 0, 43200, 100),
(99, 'BS', 'DHL', 'GTW', '2024-04', '14-307', 30, 43200, 0, 0, 43200, 100),
(100, 'BS', 'DHL', 'JDC', '2024-04', '13-153', 30, 43200, 0, 0, 43200, 100),
(101, 'BS', 'DHL', 'JDC', '2024-04', '17-124', 30, 43200, 0, 0, 43200, 100),
(102, 'BS', 'DHL', 'JDC', '2024-04', '19-074', 30, 43200, 0, 0, 43200, 100),
(103, 'BS', 'DHL', 'JDC', '2024-04', '19-129', 30, 43200, 0, 0, 43200, 100),
(104, 'BS', 'DHL', 'JDC', '2024-04', '19-130', 30, 43200, 30, 0, 43170, 99.9305555),
(105, 'BS', 'DHL', 'JDC', '2024-04', '19-131', 30, 43200, 0, 0, 43200, 100),
(106, 'BS', 'DHL', 'KXZ', '2024-04', 'E8061', 30, 43200, 0, 0, 43200, 100),
(107, 'BS', 'DHL', 'KXZ', '2024-04', 'E8063', 30, 43200, 0, 0, 43200, 100),
(108, 'BS', 'DHL', 'NEM', '2024-04', '14-308', 30, 43200, 0, 0, 43200, 100),
(109, 'BS', 'DHL', 'SOC', '2024-04', '13-259', 30, 43200, 0, 0, 43200, 100),
(110, 'BS', 'DHL', 'SRG', '2024-04', '18-349', 30, 43200, 0, 0, 43200, 100),
(111, 'BS', 'DHL', 'SRG', '2024-04', 'E8075', 30, 43200, 0, 0, 43200, 100),
(112, 'BS', 'DHL', 'SUB', '2024-04', 'E8060', 30, 43200, 0, 0, 43200, 100),
(113, 'BS', 'DHL', 'TIM', '2024-04', 'E8055', 30, 43200, 0, 0, 43200, 100),
(114, 'BS', 'DHL', 'TXZ', '2024-04', 'E7660', 30, 43200, 0, 0, 43200, 100),
(115, 'BS', 'DHL', 'UPG', '2024-04', 'E8070', 30, 43200, 0, 0, 43200, 100);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` varchar(20) NOT NULL,
  `namaregion` varchar(100) NOT NULL,
  `idcbu` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `namaregion`, `idcbu`) VALUES
('ABC', 'ABC', 'ABC'),
('CS-0107', 'TIRTA SIBAYAKINDO, PT', 'CS-0107'),
('CS-013', 'AQUA GOLDEN MISSISSIPPI, PT', 'CS-013'),
('CS-113', 'TIRTA INVESTAMA, PT', 'CS-113'),
('CS-155', 'SARIHUSADA GENERASI MAHARDHIKA, PT', 'CS-155'),
('CS-351', 'NUTRICIA INDONESIA SEJAHTERA, PT', 'CS-351'),
('CS-639', 'SUGIZINDO, PT', 'CS-639'),
('R999', 'SPP', '999');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', '2020-12-22 02:12:09', '2020-12-22 02:12:09'),
(2, 'manajersite', '2020-12-22 02:12:09', '2020-12-22 02:12:09'),
(3, 'mekanik', NULL, NULL),
(4, 'customersite', '2020-12-22 02:12:09', '2020-12-22 02:12:09'),
(5, 'customerallsite', NULL, NULL),
(6, 'cnp', NULL, NULL),
(100, 'headofficepart', NULL, NULL),
(101, 'inventorypart', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sitename`
--

DROP TABLE IF EXISTS `sitename`;
CREATE TABLE IF NOT EXISTS `sitename` (
  `id` varchar(11) NOT NULL,
  `namasitename` varchar(100) NOT NULL,
  `kategori` varchar(10) DEFAULT NULL,
  `kdcustomer` varchar(50) NOT NULL,
  `parentid` varchar(20) DEFAULT NULL,
  `f_aktif` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitename`
--

INSERT INTO `sitename` (`id`, `namasitename`, `kategori`, `kdcustomer`, `parentid`, `f_aktif`) VALUES
('1000', 'SPP JATENG', 'sitename', 'DANONE', 'R999', '1'),
('1005', 'Sitename ABC', 'sitename', 'ABC', 'RABC', '1'),
('999', 'SITENAME SPP', 'sitename', 'DANONE', 'R999', '1'),
('BPN', 'DHL EXPRESS - BALIKPAPAN', 'sitename', 'DHL', 'DHL', '1'),
('BQZ', 'DHL EXPRESS - CIKARANG', 'sitename', 'DHL', 'DHL', '1'),
('BS', 'PT. BIROTIKA SEMESTA', 'cbu', 'DHL', NULL, '1'),
('BTH', 'DHL EXPRESS - BATAM', 'sitename', 'DHL', 'DHL', '1'),
('C999', 'CBU SPP', 'cbu', 'DANONE', NULL, '1'),
('CABC', 'ABC', 'cbu', 'ABC', NULL, '1'),
('DHL', 'PT. BIROTIKA SEMESTA', 'region', 'DHL', 'BS', '1'),
('DHL1', 'DHL EXPRESS - PURWAKARTA', 'sitename', 'DHL', 'DHL', '1'),
('DM', 'DELTAMAS - CIKARANG', 'sitename', 'SUZUKI', 'P49', '1'),
('DPS', 'DHL EXPRESS - DENPASAR', 'sitename', 'DHL', 'DHL', '1'),
('East', 'East', 'region', 'DANONE', 'SN', '1'),
('GTW', 'DHL EXPRESS - MEDAN CARGO 2 LINI 2 KUALANAMU AIRPORT', 'sitename', 'DHL', 'DHL', '1'),
('JDC', 'DHL EXPRESS - CENGKARENG', 'sitename', 'DHL', 'DHL', '1'),
('KXZ', 'DHL EXPRESS - PULOGADUNG', 'sitename', 'DHL', 'DHL', '1'),
('LOC1', 'SHELL MARUNDA CENTER', 'sitename', 'PUNINAR', 'PSR1', '1'),
('LOC2', 'PROJECT EXXON CILEGON', 'sitename', 'PUNINAR', 'PSR1', '1'),
('ML', 'PT MULTI LAND', 'cbu', 'PUNINAR', NULL, '1'),
('MLR', 'PT MULTI LAND', 'region', 'PUNINAR', 'ML', '1'),
('MLS1', 'PROJECT ELECTROLUX -  NAGRAK', 'sitename', 'PUNINAR', 'MLR', '1'),
('MLS2', 'ELUX GRESIK', 'sitename', 'PUNINAR', 'MLR', '1'),
('MLS3', 'KEMAYORAN JAKARTA PUSAT', 'sitename', 'PUNINAR', 'MLR', '1'),
('NEM', 'DHL EXPRESS - JL. CEMARA NO.29 PULO BRAYAN  MEDAN', 'sitename', 'DHL', 'DHL', '1'),
('P10', 'DC BALI', 'sitename', 'DANONE', 'R4', '1'),
('P11', 'DC BANDUNG', 'sitename', 'DANONE', 'R2', '1'),
('P12', 'DC CIBINONG', 'sitename', 'DANONE', 'R2', '1'),
('P13', 'DC CIKARANG', 'sitename', 'DANONE', 'R2', '1'),
('P14', 'DC CIPUTAT', 'sitename', 'DANONE', 'R2', '1'),
('P15', 'DC JATIASIH', 'sitename', 'DANONE', 'R2', '1'),
('P16', 'DC KAWASAN', 'sitename', 'DANONE', 'R2', '1'),
('P17', 'DC KLENDER', 'sitename', 'DANONE', 'R2', '1'),
('P18', 'DC LAMPUNG', 'sitename', 'DANONE', 'R1', '1'),
('P19', 'DC MANADO', 'sitename', 'DANONE', 'R4', '1'),
('P2', 'WH WONOBOYO', 'sitename', 'DANONE', 'East', '1'),
('P20', 'DC MEDAN', 'sitename', 'DANONE', 'R1', '1'),
('P21', 'DC PALAPA', 'sitename', 'DANONE', 'R2', '1'),
('P22', 'DC PULOKAMBING', 'sitename', 'DANONE', 'R2', '1'),
('P23', 'DC RAWA DOMBA', 'sitename', 'DANONE', 'R2', '1'),
('P24', 'DC RUNGKUT', 'sitename', 'DANONE', 'R3', '1'),
('P25', 'DC SEMARANG', 'sitename', 'DANONE', 'R3', '1'),
('P26', 'DC SOLO', 'sitename', 'DANONE', 'R3', '1'),
('P27', 'DC YOGYAKARTA', 'sitename', 'DANONE', 'R3', '1'),
('P28', 'PLANT SOLOK', 'sitename', 'DANONE', 'R1', '1'),
('P29', 'PLANT TANGGAMUS', 'sitename', 'DANONE', 'R1', '1'),
('P3', 'WH CILEUNGSI', 'sitename', 'DANONE', 'West', '1'),
('P30', 'PLANT LANGKAT', 'sitename', 'DANONE', 'R1', '1'),
('P31', 'PLANT BERASTAGI', 'sitename', 'DANONE', 'R1', '1'),
('P32', 'PLANT KLATEN', 'sitename', 'DANONE', 'R3', '1'),
('P33', 'PLANT WONOSOBO', 'sitename', 'DANONE', 'R3', '1'),
('P34', 'PLANT KEBONCANDI', 'sitename', 'DANONE', 'R3', '1'),
('P35', 'PLANT PANDAAN', 'sitename', 'DANONE', 'R3', '1'),
('P36', 'PLANT MAMBAL', 'sitename', 'DANONE', 'R4', '1'),
('P37', 'PLANT SEMBUNG GEDE', 'sitename', 'DANONE', 'R4', '1'),
('P38', 'PLANT BANYUWANGI', 'sitename', 'DANONE', 'R4', '1'),
('P39', 'PLANT MANADO', 'sitename', 'DANONE', 'R4', '1'),
('P4', 'WH PONDOK UNGU', 'sitename', 'DANONE', 'West', '1'),
('P40', 'PLANT SENTUL', 'sitename', 'DANONE', 'R2', '1'),
('P41', 'PLANT CITEUREUP', 'sitename', 'DANONE', 'R2', '1'),
('P42', 'PLANT SUBANG', 'sitename', 'DANONE', 'R2', '1'),
('P43', 'PLANT CIHERANG', 'sitename', 'DANONE', 'R2', '1'),
('P44', 'PLANT CARINGIN', 'sitename', 'DANONE', 'R2', '1'),
('P45', 'PLANT MEKARSARI', 'sitename', 'DANONE', 'R2', '1'),
('P46', 'PLANT BABAKANPARI', 'sitename', 'DANONE', 'R2', '1'),
('P47', 'PLANT CIANJUR', 'sitename', 'DANONE', 'R2', '1'),
('P48', 'PLANT BEKASI', 'sitename', 'DANONE', 'R2', '1'),
('P49', 'SUZUKI INDOMOBIL MOTOR', 'region', 'SUZUKI', 'SUZUKI', '1'),
('P5', 'WH JOMBOR', 'sitename', 'DANONE', 'East', '1'),
('P6', 'PLANT SARIHUSADA JOGJA', 'sitename', 'DANONE', 'East', '1'),
('P7', 'PLANT SARIHUSADA PRAMBANAN', 'sitename', 'DANONE', 'East', '1'),
('P8', 'PLANT SUGIZINDO', 'sitename', 'DANONE', 'West', '1'),
('P9', 'PLANT NUTRICIA', 'sitename', 'DANONE', 'West', '1'),
('PIR', 'PT PUNINAR INFINITE RAYA', 'cbu', 'PUNINAR', NULL, '1'),
('PIRR1', 'PT PUNINAR INFINITE RAYA', 'region', 'PUNINAR', 'PIR', '1'),
('PIRS1', 'BALIKPAPAN', 'sitename', 'PUNINAR', 'PIRR1', '1'),
('PIRS2', 'GRESIK', 'sitename', 'PUNINAR', 'PIRR1', '1'),
('PIRS3', 'CAKUNG NAGRAK', 'sitename', 'PUNINAR', 'PIRR1', '1'),
('PIRS4', 'MEDAN', 'sitename', 'PUNINAR', 'PIRR1', '1'),
('PJ', 'PT PUNINAR JAYA', 'cbu', 'PUNINAR', NULL, '1'),
('PJR1', 'PT PUNINAR JAYA', 'region', 'PUNINAR', 'PJ', '1'),
('PJS1', 'GUDANG BAYER - RUNGKUT SURABAYA', 'sitename', 'PUNINAR', 'PJR1', '1'),
('PJS2', 'PLB - CAKUNG', 'sitename', 'PUNINAR', 'PJR1', '1'),
('PSR', 'PT PUNINAR SARANARAYA', 'cbu', 'PUNINAR', NULL, '1'),
('PSR1', 'PT PUNINAR SARANARAYA', 'region', 'PUNINAR', 'PSR', '1'),
('R1', 'REGION 1', 'region', 'DANONE', 'Waters', '1'),
('R1000', 'STORING SPP JATENG', 'region', 'DANONE', 'C999', '1'),
('R2', 'REGION 2', 'region', 'DANONE', 'Waters', '1'),
('R3', 'REGION 3', 'region', 'DANONE', 'Waters', '1'),
('R4', 'REGION 4', 'region', 'DANONE', 'Waters', '1'),
('R999', 'REGION SPP', 'region', 'DANONE', 'C999', '1'),
('RABC', 'Region ABC', 'region', 'ABC', 'CABC', '1'),
('SB1', 'PT BUKITMEGA MASABADI SOLO', 'sitename', 'SPP', 'STSJ1', '1'),
('SJ1', 'SPP JATENG', 'cbu', 'SPP', NULL, '1'),
('SM1', 'MITRA 10 SOLO', 'sitename', 'SPP', 'STSJ1', '1'),
('SM2', 'MITRA 10 JOGJA', 'sitename', 'SPP', 'STSJ1', '1'),
('SMN1', 'PT MACROSENTRA NIAGABOGA', 'sitename', 'SPP', 'STSJ1', '1'),
('SN', 'SN', 'cbu', 'DANONE', '', '1'),
('SOC', 'DHL EXPRESS  - SOLO', 'sitename', 'DHL', 'DHL', '1'),
('SPG1', 'PT PARAMA GLOBAL INSPIRA SOLO', 'sitename', 'SPP', 'STSJ1', '1'),
('SPG2', 'PT PARAMA GLOBAL INSPIRA JOGJA', 'sitename', 'SPP', 'STSJ1', '1'),
('SRG', 'DHL EXPRESS - SEMARANG', 'sitename', 'DHL', 'DHL', '1'),
('SS1', 'SINARMAS DISTRIBUSI NUSANTARA SOLO', 'sitename', 'SPP', 'STSJ1', '1'),
('ST2', 'PT TIGARAKSA SATRIA CANGKRINGAN', 'sitename', 'SPP', 'STSJ1', '1'),
('STSJ1', 'STORING SPP JATENG', 'region', 'SPP', 'SJ1', '1'),
('SUB', 'DHL EXPRESS - SURABAYA', 'sitename', 'DHL', 'DHL', '1'),
('SUZUKI', 'SUZUKI INDOMOBIL MOTOR', 'cbu', 'SUZUKI', NULL, '1'),
('TB1', 'TAMBUN 1', 'sitename', 'SUZUKI', 'P49', '1'),
('TB2', 'TAMBUN 2', 'sitename', 'SUZUKI', 'P49', '1'),
('TBS', 'TAMBUN - SPAREPART', 'sitename', 'SUZUKI', 'P49', '1'),
('TIM', 'DHL EXPRESS - TIMIKA', 'sitename', 'DHL', 'DHL', '1'),
('TXZ', 'DHL EXPRESS - CIKOKOL', 'sitename', 'DHL', 'DHL', '1'),
('UPG', 'DHL EXPRESS - MAKASSAR', 'sitename', 'DHL', 'DHL', '1'),
('Waters', 'Waters', 'cbu', 'DANONE', '', '1'),
('West', 'West', 'region', 'DANONE', 'SN', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

DROP TABLE IF EXISTS `sparepart`;
CREATE TABLE IF NOT EXISTS `sparepart` (
  `codepart` varchar(50) NOT NULL,
  `produkcategory` text DEFAULT NULL,
  `partno` text DEFAULT NULL,
  `partname` text DEFAULT NULL,
  `simplename` text DEFAULT NULL,
  `merkjenisforklift` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `merkpart` text DEFAULT NULL,
  PRIMARY KEY (`codepart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparepartstok`
--

DROP TABLE IF EXISTS `sparepartstok`;
CREATE TABLE IF NOT EXISTS `sparepartstok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `codepart` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idsparepart` (`codepart`),
  KEY `idsitename` (`idsitename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparepartstoktrans`
--

DROP TABLE IF EXISTS `sparepartstoktrans`;
CREATE TABLE IF NOT EXISTS `sparepartstoktrans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `codepart` varchar(50) DEFAULT NULL,
  `transaction` set('in','out') NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `tanggal` varchar(7) DEFAULT NULL,
  `qtytrans` int(11) DEFAULT NULL,
  `stockpros` double DEFAULT NULL,
  `confirmation` text DEFAULT NULL,
  `avgpros` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idsparepart` (`codepart`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `sparepartstoktrans`
--
DROP TRIGGER IF EXISTS `batalstoktrans`;
DELIMITER $$
CREATE TRIGGER `batalstoktrans` AFTER DELETE ON `sparepartstoktrans` FOR EACH ROW if (OLD.transaction="out")
THEN
	UPDATE sparepartstok 
	set stok=stok+OLD.qtytrans
	WHERE codepart=OLD.codepart AND idsitename=OLD.idsitename;
END IF
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `instoktrans`;
DELIMITER $$
CREATE TRIGGER `instoktrans` AFTER INSERT ON `sparepartstoktrans` FOR EACH ROW if (NEW.transaction="in")
THEN
	UPDATE sparepartstok 
	set stok=stok+NEW.qtytrans
	WHERE codepart=NEW.codepart AND idsitename=NEW.idsitename;
END IF
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `outstoktrans`;
DELIMITER $$
CREATE TRIGGER `outstoktrans` AFTER INSERT ON `sparepartstoktrans` FOR EACH ROW if (NEW.transaction="out")
THEN
	UPDATE sparepartstok 
	set stok=stok-NEW.qtytrans
	WHERE codepart=NEW.codepart AND idsitename=NEW.idsitename;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `suratjalan`
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
  `filereply` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `subject` text DEFAULT NULL,
  `message` text NOT NULL,
  `type` varchar(1) NOT NULL DEFAULT '1',
  `status` varchar(10) NOT NULL DEFAULT 'open',
  `parentid` int(11) DEFAULT NULL,
  `idsitename` varchar(20) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `actualdate` date DEFAULT NULL,
  `datepost` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `userid`, `subject`, `message`, `type`, `status`, `parentid`, `idsitename`, `duedate`, `actualdate`, `datepost`, `created_at`, `updated_at`) VALUES
(58, 328, 'Trouble Hose Hydraulic Bocor 19-131', '<p>Dear team spp,</p><p>Mohon dibantu unit Reachtruck dengan kode 19-131 mengalami bocor hose hydraulic.</p>', '0', 'close', NULL, 'JDC', '2024-04-06', '2024-04-07', NULL, '2024-04-05 21:18:26', '2024-04-05 21:25:50'),
(59, 163, 'Trouble Hose Hydraulic Bocor 19-131', '<p>Dear Bapak/Ibu,</p><p>kami akan jadwalkan mekanik untuk melakukan perbaikan,terima kasih.</p>', '0', 'open', 58, NULL, NULL, NULL, '2024-04-05 21:22:48', '2024-04-05 21:22:48', '2024-04-05 21:22:48'),
(60, 163, NULL, '<p>Dear Bapak/Ibu,</p><p>kami akan jadwalkan mekanik untuk melakukan perbaikan,terima kasih.</p>', '0', 'open', 58, NULL, NULL, NULL, '2024-04-05 21:24:23', '2024-04-05 21:24:23', '2024-04-05 21:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `troubleaction`
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
  `terbackup` varchar(1) NOT NULL DEFAULT '0',
  `shift` varchar(20) DEFAULT NULL,
  `actionplan` text DEFAULT NULL,
  `sparepart` text DEFAULT NULL,
  `statusmekanik` varchar(10) DEFAULT NULL,
  `statusspp` varchar(10) NOT NULL DEFAULT 'OPEN',
  `statuscustomer` varchar(10) NOT NULL DEFAULT 'OPEN',
  PRIMARY KEY (`id`),
  KEY `kdunit` (`kdunit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `troubleaction`
--

INSERT INTO `troubleaction` (`id`, `kdunit`, `periode`, `iduser`, `tanggalmulai`, `tanggalakhir`, `lapsetime`, `terbackup`, `shift`, `actionplan`, `sparepart`, `statusmekanik`, `statusspp`, `statuscustomer`) VALUES
(1, '19-130', '2024-04', 330, '2024-01-04 12:30:00', '2024-01-04 13:00:00', 30, '0', '1', 'Perbaikan bracket lampu mundur & ganti lampu yang putus', 'Lampu 24v', 'CLOSE', 'OPEN', 'OPEN'),
(5, '19-259', '2024-04', 335, '2024-02-23 09:52:00', '2024-02-23 12:00:00', 128, '0', '1', 'Ganti seal power steering,cleaning unit', 'repair kit power cylinder, kepala aki, isolasi,oli hydraulic,wd', 'CLOSE', 'OPEN', 'OPEN'),
(6, '20-428', '2024-04', 340, '2024-02-26 14:47:00', '2024-02-26 16:00:00', 73, '0', '1', 'Penggantian carbon brush & Motor power steering assy', 'Carbon brush, motor power steering', 'CLOSE', 'OPEN', 'OPEN');

--
-- Triggers `troubleaction`
--
DROP TRIGGER IF EXISTS `trouble-batal`;
DELIMITER $$
CREATE TRIGGER `trouble-batal` AFTER DELETE ON `troubleaction` FOR EACH ROW BEGIN
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
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `kdunit` varchar(20) NOT NULL,
  `namaunit` varchar(100) DEFAULT NULL,
  `idforklifttype` int(11) NOT NULL DEFAULT 1,
  `serialnumber` varchar(50) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `hm` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idcbu` varchar(20) DEFAULT NULL,
  `idregion` varchar(20) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `equipment` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `capcity` decimal(10,0) DEFAULT NULL,
  `capcity2` decimal(11,0) DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `mast` decimal(5,2) DEFAULT NULL,
  `masheight` decimal(5,2) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `showcustomer` varchar(1) DEFAULT 'Y',
  `dateactual` date DEFAULT NULL,
  `daterequest` date DEFAULT NULL,
  `dateestimated` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `flag_aktif` varchar(1) NOT NULL DEFAULT 'Y',
  `flag_baru` varchar(1) DEFAULT NULL,
  `flag_target` varchar(1) DEFAULT NULL,
  `flag_actual` varchar(1) DEFAULT NULL,
  `flag_otif` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kdunit`),
  KEY `idsitename` (`idsitename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`kdunit`, `namaunit`, `idforklifttype`, `serialnumber`, `price`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `equipment`, `merk`, `model`, `type`, `capcity`, `capcity2`, `specification`, `qty`, `mast`, `masheight`, `foto`, `showcustomer`, `dateactual`, `daterequest`, `dateestimated`, `reason`, `flag_aktif`, `flag_baru`, `flag_target`, `flag_actual`, `flag_otif`) VALUES
('11-114', '11-114', 2, 'H2X115B00829', 22000000, 19725, '2023-11-29', 'Waters', 'R2', 'P42', 'FORKLIFT RT', 'LINDE', 'Electric', 'R16SN', '1600', '1600', '3 Stage 9.5 m Battery Spare', 1, '3.00', '9.50', 'forklift.jpg', 'Y', '2015-06-01', '2015-06-01', '2015-06-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('12-226', '12-226', 17, '11726', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'TOYOTA', 'ELECTRIC', '4 CBTY 2', '2000', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('13-019', '13-019', 17, '451AB0313', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'NICHIYU', 'ELECTRIC', 'NTT50-70C', '2500', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('13-153', '13-153', 2, 'R1H-02062', 0, 0, '2024-02-07', 'BS', 'DHL', 'JDC', 'REACH TRUCK', 'SUMITOMO', 'Electric', '8FBR15SJXII', '1500', NULL, 'L/H : 6.020 mm', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('13-259', '13-259', 1, 'B1J-01318', 0, 0, NULL, 'BS', 'DHL', 'SOC', 'FORKLIFT CB', 'SUMITOMO', 'Electric', '8FB15PX', '1500', NULL, '3', 4, '3.00', '4.50', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('13-357', '13-357', 11, 'B3D-01063', 0, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'SUMITOMO', 'ELECTRIC', '8FB30-PZX', '3000', '3000', '0', 1, '2.00', '3.00', 'default.png', 'N', '2013-02-01', '2013-01-01', '2013-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('14-033', '14-033', 1, 'H2X386DO4064', 0, 32248, '2024-01-20', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C-01', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-056', '14-056', 1, 'H2X386D04257', 0, 20218, '2024-03-07', 'SN', 'East', 'P7', 'THREE WHEELER CB', 'LINDE', 'Electric', 'E12(386)', '1200', '1200', '2 Stage 4 m', 1, '2.00', '4.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-059', '14-059', 1, 'H2X386D04042', 0, 10052, '2024-03-07', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'R16S (115)', '1200', '1200', '2 Stage 4 m', 1, '2.00', '4.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-060', '14-060', 1, 'H2X386D04308', 0, 18945, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E12(386)', '1600', '1600', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-062', '14-062', 11, 'H2X386DO4086', 0, 24744, '2024-03-16', 'SN', 'East', 'P6', 'FORKLIFT CB', 'Linde', 'Electric', 'E 16', '1600', '1600', '-', 1, '2.00', '3.00', 'default.png', 'N', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('14-063', '14-063', 1, 'H2X386D04104', 0, 31018, '2024-01-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (386)', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-067', '14-067', 1, 'H2X386D04169', 0, 36462, '2024-01-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (386)', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-069', '14-069', 1, 'H2X386D04189', 0, 36277, '2024-01-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (386)', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-071', '14-071', 1, 'H2X386D04242', 0, 5170, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (386)', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-072', '14-072', 1, 'H2X386DO4292', 0, 28064, '2024-01-20', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E 16', '1600', '1600', '3 meter', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2014-02-01', '2014-01-01', '2014-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('14-165', '14-165', 1, 'B226R07053M', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'FORKLIFT CB', 'HYSTER', 'ELECTRIC', 'J2.50EX2', '2500', NULL, '3 Stage 6 m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('14-307', '14-307', 2, '182ZR3389', 0, 0, '2024-02-20', 'BS', 'DHL', 'GTW', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW18-75C-600MSF', '1800', NULL, '3 Stage 7 m', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('14-308', '14-308', 2, '182ZR3391', 0, 0, NULL, 'BS', 'DHL', 'NEM', 'REACH TRUCK', 'NICHIYU', 'Electric', 'FBRW18-75C-600MSF', '1800', NULL, '3 Stage 6 m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('14-356', '14-356', 2, 'D264N01949M', 0, 0, NULL, 'PSR', 'PSR1', 'LOC2', 'REACH TRUCK', 'HYSTER', 'Electric', 'N35ZDR2', '1400', NULL, '3 Stage 7 m', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('14-390', '14-390', 1, '216ZT0746', 11000000, 10983, '2023-11-28', 'SN', 'East', 'P5', 'FORKLIFT CB', 'Nichiyu', 'Electric', 'FBT15PN-80C-470M', '1500', '1500', '3 stage 4,7 m', 1, '3.00', '4.70', 'default.png', 'Y', '2023-07-19', '2023-07-19', '2023-07-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('14-392', '14-392', 5, '265E00040', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'THREE WHEELER CB', 'NICHIYU', 'ELECTRIC', 'FBT15PN-80C-470M', '1500', NULL, '3 Stage 4.7 m', 1, '3.00', '4.70', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('14–034', '14–034', 1, 'H2X386DO4121', 0, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E 16', '1600', '1600', '', 1, '3.00', '3.00', 'forklift.jpg', 'Y', '2022-02-01', '2022-01-01', '2022-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('15-003', '15-003', 5, '265E00088', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'THREE WHEELER CB', 'NICHIYU', 'ELECTRIC', 'FBT15-80-470M', '1500', NULL, '3 Stage 4.7 m', 1, '3.00', '4.70', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-004', '15-004', 5, '266E00074', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'THREE WHEELER CB', 'NICHIYU', 'ELECTRIC', 'FBT18-80-470M', '1800', NULL, '3 Stage 4.7 m', 1, '3.00', '4.70', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-008', '15-008', 17, '451AB0369', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'NICHIYU', 'ELECTRIC', 'NTT50-70C', '2500', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-009', '15-009', 17, '451AB0370', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'NICHIYU', 'ELECTRIC', 'NTT50-70C', '2500', NULL, '0.0', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-067', '15-067', 17, '451AB0470', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'NICHIYU', 'ELECTRIC', 'NTT50-70', '2500', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-069', '15-069', 17, '451AB0472', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'NICHIYU', 'ELECTRIC', 'NTT50-70', '2500', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-070', '15-070', 17, '451AB0473', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'TOWING TRUCK', 'NICHIYU', 'ELECTRIC', 'NTT50-70', '2500', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-133', '15-133', 1, 'CF17D-68088', 10000000, 0, NULL, 'Waters', 'R3', 'P24', '-', '-', '-', '-', '2500', '2500', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2020-03-03', '2020-03-03', '2020-03-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('15-165', '15-165', 1, '14641', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'TOYOTA', 'FORKLIFT CB', 'Electric', '8FBN25', '2500', NULL, '3 Stage 4.7 m, FL1070 mm', 1, '3.00', '4.70', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('15-215', '15-215', 11, '14601', 0, 0, NULL, 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '3 Stage 4.7 m Full Free', 1, '3.00', '4.00', 'forklift.jpg', 'N', '2015-02-01', '2015-01-01', '2015-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('15-260', '15-260', 13, 'C1X115F00351/2015', 0, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20SDD', '2000', '2000', 'Mast TYPE : Triplex Mast Lifting Height : 10.155 mm', 1, '3.00', '10.00', 'default.png', 'N', '2015-02-01', '2015-01-01', '2015-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('16-030', '16-030', 11, 'C1X115F01239/2015', 0, 22067, '2023-07-17', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20SDD', '2000', '2000', '-', 1, '3.00', '10.00', 'default.png', 'N', '2016-02-01', '2016-01-01', '2016-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('16-051', '16-051', 13, 'C1X115F01416/2015', 0, 25502, '2023-09-04', 'SN', 'West', 'P3', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20SDD', '2000', '2000', 'Triplex Mast 10155/4430/3581', 1, '0.00', '0.00', 'default.png', 'N', '2016-02-01', '2016-01-01', '2016-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('16-053', '16-053', 11, 'C1X115F01449/2015', 0, 25123, '2023-07-16', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20SDD', '2000', '2000', 'Triplex Mast 10155/4430/3581', 1, '0.00', '0.00', 'default.png', 'N', '2016-02-01', '2016-01-01', '2016-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('16-059', '16-059', 1, '15324', 8500000, 10437, '2024-03-04', 'SN', 'East', 'P2', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', 'FV3 m c/w : 4 C/Valve+Hoseline+Pneumatic Tire+Excl.Charger', 1, '2.00', '3.00', 'default.png', 'Y', '2019-01-31', '2019-01-31', '2019-01-31', NULL, 'Y', 'B', NULL, 'Y', 'OTIF'),
('16-155', '16-155', 11, '17177', 0, 0, NULL, 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '3 m (V), Solid Tire, SAS, OPS, (No Fork, No Charger, No ASS)', 1, '2.00', '3.00', NULL, 'N', '2016-02-01', '2016-01-01', '2016-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('16-201', '16-201', 1, '17070', 8500000, 10752, '2024-03-04', 'SN', 'East', 'P2', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', 'Solid Tire, 4 Way CV No Hose, Fork 1070 mm', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2019-01-31', '2019-01-31', '2019-01-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('17-120', '17-120', 11, '17775', 0, 8245, '2023-12-04', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'TOYOTA', 'Electric', '7FB30', '3000', '3000', '-', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2017-02-01', '2017-01-01', '2017-02-01', NULL, 'N', 'L', 'N', 'N', ''),
('17-124', '17-124', 2, 'R2B-03805', 0, 0, '2024-02-07', 'BS', 'DHL', 'JDC', 'REACH TRUCK', 'SUMITOMO', 'Electric', 'SMTM-8FBR20LTX-5.000 m', '2000', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('17-138', '17-138', 1, '265 E00175', 0, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'NICHIYU', 'Electric', 'FBT 15', '1500', '1500', '3 Stage 4.5 m', 1, '3.00', '4.00', 'forklift.jpg', 'Y', '2022-02-01', '2022-01-01', '2022-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('17-203', '17-203', 1, 'CF13F-48233', 10000000, 0, NULL, 'Waters', 'R3', 'P24', '-', '-', '-', '-', '3000', '3000', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2019-09-03', '2019-09-03', '2019-09-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('17-204', '17-204', 1, 'CF13F-48234', 10000000, 0, NULL, 'Waters', 'R3', 'P24', '-', '-', '-', '-', '3000', '3000', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2019-09-03', '2019-09-03', '2019-09-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('17-244', '17-244', 1, '12104', 0, 0, NULL, 'PSR', 'PSR1', 'LOC2', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FB25', '2500', NULL, '3 m(V) Mast', 1, '3.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('17-315', '17-315', 2, 'H2X115D00139', 25000000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'LINDE', 'Electric', 'R16S N (115)', '1600', '1600', '3 Stage 9.5 m, Battery Spare', 1, '3.00', '9.50', 'default.png', 'Y', '2023-11-30', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('18-002', '18-002', 11, '8FBJ35-10607', 0, 19911, '2023-11-09', 'Waters', 'R4', 'P37', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '8FBN30', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2018-01-01', '2018-02-01', '2018-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('18-139', '18-139', 7, '1A522587', 0, 14935, '2024-03-15', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095S-32TT475', '1450', '1450', '-', 1, '3.00', '12.00', 'default.png', 'Y', '2018-02-01', '2018-01-01', '2018-02-01', NULL, 'Y', 'L', 'Y', 'Y', ''),
('18-140', '18-140', 7, '1A522588', 0, 14346, '2024-03-15', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095S-32TT475', '1450', '1450', '-', 1, '3.00', '12.00', 'forklift.jpg', 'Y', '2018-02-01', '2018-01-01', '2018-02-01', NULL, 'Y', 'L', 'Y', 'Y', ''),
('18-143', '18-143', 7, '1A522591', 0, 13353, '2024-03-16', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095S-32TT475', '1450', '1450', '-', 1, '3.00', '12.00', 'forklift.jpg', 'Y', '2018-02-01', '2018-01-01', '2018-02-01', NULL, 'Y', 'L', 'Y', 'Y', ''),
('18-155', '18-155', 1, '8FBN25-30518', 8500000, 7511, '2024-03-04', 'SN', 'East', 'P2', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '2 Stage 3 m Full Free Lift, Include Spare Battery', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2019-01-31', '2019-01-31', '2019-01-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('18-188', '18-188', 11, '8FBN25-30728', 0, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '-', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2018-01-01', '2018-02-01', '2018-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('18-243', '18-243', 7, '1A528508', 0, 14040, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095S-32TT475', '1450', '1450', '-', 1, '3.00', '12.00', 'forklift.jpg', 'Y', '2018-02-01', '2018-01-01', '2018-02-01', NULL, 'Y', 'L', 'Y', 'Y', ''),
('18-245', '18-245', 7, '1A528510', 0, 14434, '2024-03-16', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095S-32TT475', '1450', '1450', '-', 1, '3.00', '12.00', 'forklift.jpg', 'Y', '2018-02-01', '2018-01-01', '2018-02-01', NULL, 'Y', 'L', 'Y', 'Y', ''),
('18-322', '18-322', 2, 'C900R01819S', 0, 0, NULL, 'BS', 'DHL', 'DPS', 'REACH TRUCK', 'YALE', 'ELECTRIC', 'FBR18SZ', '1800', NULL, '3 Stage 6 m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('18-349', '18-349', 2, 'C900R01850S', 0, 0, NULL, 'BS', 'DHL', 'SRG', 'REACH TRUCK', 'YALE', 'Electric', 'FBR18SZ', '1800', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('18-376', '18-376', 13, '185F00376', 0, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT RT', 'NICHIYU', 'Electric', 'FBRW18-80 700MSF', '1800', '1800', '-', 1, '3.00', '6.00', 'forklift.jpg', 'N', '2018-01-01', '2018-02-01', '2018-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-043', '19-043', 4, 'B16140D0009', 6300000, 0, '2024-04-19', 'SJ1', 'STSJ1', 'SM2', 'PALLET STACKER', 'BAOLI', 'ELECTRIC', 'ES15-P VM300 LF560 X 1150', '1500', NULL, '-', 1, '0.00', '5.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-069', '19-069', 1, '8FBN30-30071', 13500000, 0, NULL, 'Waters', 'R3', 'P25', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '8FBN30', '3000', '3000', NULL, 1, '2.00', '3.00', 'default.png', 'Y', '2021-09-09', '2021-09-09', '2021-09-09', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-070', '19-070', 11, '30145', 0, 0, '2024-03-07', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '8FBN30', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-071', '19-071', 1, '8FBN30-30146', 13500000, 0, NULL, 'Waters', 'R3', 'P25', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '8FBN30', '3000', '3000', NULL, 1, '2.00', '3.00', 'default.png', 'Y', '2021-09-09', '2021-09-09', '2021-09-09', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-074', '19-074', 2, 'C900R01965S', 0, 0, '2024-02-07', 'BS', 'DHL', 'JDC', 'REACH TRUCK', 'YALE', 'Electric', 'FBR18SZ', '1800', NULL, '0.0', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('19-076', '19-076', 1, '60-8FD15-62262', 11000000, 13010, '2024-01-09', 'SN', 'East', 'P5', 'FORKLIFT CB', 'Toyota', 'Electric', '60-8FD15', '1500', '1500', '-', 1, '0.00', '0.00', 'default.png', 'Y', '2023-08-18', '2023-08-18', '2023-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-092', '19-092', 1, '62-8FD25-71396', 7000000, 0, NULL, 'SJ1', 'STSJ1', 'SM1', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '62-8FD25', '2500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-128', '19-128', 2, 'C900R0191S', 8750000, 0, NULL, 'SJ1', 'STSJ1', 'SM2', 'REACH TRUCK', 'YALE', 'ELECTRIC', 'FBR18SZ', '1800', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-129', '19-129', 2, 'C900R02183S', 0, 11410, '2024-01-29', 'BS', 'DHL', 'JDC', 'REACH TRUCK', 'YALE', 'Electric', 'FBR18SZ', '1800', NULL, '3 Stage 6  m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('19-130', '19-130', 2, 'C900R02207S', 0, 0, '2024-02-07', 'BS', 'DHL', 'JDC', 'REACH TRUCK', 'YALE', 'Electric', 'FBR18SZ', '1800', NULL, '3 Stage 6  m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('19-131', '19-131', 2, 'C900R02175S', 0, 0, '2024-02-07', 'BS', 'DHL', 'JDC', 'REACH TRUCK', 'YALE', 'Electric', 'FBR18SZ', '1800', NULL, '3 Stage 6  m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('19-158', '19-158', 1, '8FBN25-31002', 13000000, 0, NULL, 'SJ1', 'STSJ1', 'ST2', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '8FBN25', '2500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2022-10-01', '2022-10-01', '2022-10-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-164', '19-164', 4, '080127C6887', 6300000, 0, NULL, 'SJ1', 'STSJ1', 'SM2', 'STACKER', 'HELI', 'ELECTRIC', 'CDD12-030', '1200', NULL, '-', 1, '0.00', '5.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-169', '19-169', 11, 'C881R01924S', 0, 1471, '2023-09-29', 'Waters', 'R1', 'P31', 'FORKLIFT CB', 'YALE', 'Electric', 'FB30RZ', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-181', '19-181', 1, '8FBN20-19568', 12300000, 43935, '2024-02-29', 'SN', 'West', 'P8', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN20', '2000', '2000', '3 Stage 4,7  m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2019-05-23', '2019-05-23', '2019-05-23', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-182', '19-182', 1, '8FBN20-31591', 12300000, 11875, '2024-02-29', 'SN', 'West', 'P8', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN20', '2000', '2000', '3 Stage 4,7  m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2019-05-23', '2019-05-23', '2019-05-23', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-192', '19-192', 2, '511909V00008', 0, 0, '2023-12-19', 'Waters', 'R2', 'P21', 'FORKLIFT RT', 'STILL', 'Electric', 'FM-X17N-9500MM', '1700', '1700', '3 Stage 9,5  m', 1, '3.00', '9.00', 'forklift.jpg', 'Y', '2019-02-01', '2019-01-01', '2019-02-01', NULL, 'Y', 'L', 'Y', 'Y', ''),
('19-248', '19-248', 3, '19070779', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-250', '19-250', 3, '19070781', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-02-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-252', '19-252', 3, '19070782', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-257', '19-257', 4, '1907353', 5300000, 12906, '2024-02-29', 'SN', 'West', 'P8', 'STACKER MM', 'XILIN', 'Electric', 'CQD15R', '1500', '1500', '3 Stage 4,5  m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-259', '19-259', 1, 'CF14E-19059', 0, 0, NULL, 'PIR', 'PIRR1', 'PIRS3', 'FORKLIFT CB', 'MITSUBISHI', 'Diesel', 'FD30NT-3FP47-PS/PS', '3000', NULL, '3 Stage 4,7 m', 1, '3.00', '4.70', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('19-269', '19-269', 2, 'C900R02348T', 8750000, 0, NULL, 'SJ1', 'STSJ1', 'SM1', 'REACH TRUCK', 'YALE', 'ELECTRIC', 'FBR18SZ', '1800', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-270', '19-270', 2, 'C900R02324T', 8750000, 0, NULL, 'SJ1', 'STSJ1', 'SM1', 'REACH TRUCK', 'YALE', 'ELECTRIC', 'FBR18SZ', '1800', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-294', '19-294', 13, 'C900R02532T', 0, 4673, '2023-08-30', 'Waters', 'R2', 'P47', 'FORKLIFT RT', 'YALE', 'Electric', 'FBR18SZ', '1800', '1800', '3 Stage 6  m', 1, '3.00', '6.00', 'forklift.jpg', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-339', '19-339', 11, '19101304', 0, 0, '2024-03-15', 'SN', 'East', 'P6', 'Hand Pallet Electric', 'Xilin', 'Electric', '-', '2000', '2000', '-', 1, '0.00', '0.00', 'default.png', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-341', '19-341', 4, '1910506', 5300000, 4611, '2024-02-29', 'SN', 'West', 'P8', 'STACKER MM', 'XILIN', 'Electric', 'CQD15R', '1500', '1500', '3 Stage 4,5  m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-347', '19-347', 3, '3281500189', 6500000, 0, NULL, 'SN', 'West', 'P3', 'PALLET TRUCK', 'TCMC', 'Electric', 'PAP25T-ES  LF1150x685', '2500', '2500', '-', 1, '0.00', '0.00', 'default.png', 'Y', '2023-11-27', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-351', '19-351', 11, 'Q1AI00881', 0, 7932, '1970-01-01', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-S126', '2500', '2500', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-352', '19-352', 1, 'Q1AI00880', 12900000, 0, NULL, 'Waters', 'R4', 'P38', '-', '-', '-', '-', '2500', '2500', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-01-11', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('19-358', '19-358', 11, 'Q1AI00860', 0, 0, NULL, 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 4 m', 1, '2.00', '4.00', 'forklift.jpg', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-361', '19-361', 1, '61096', 10000000, 12175, '2024-01-09', 'SN', 'East', 'P5', 'FORKLIFT CB', 'TOYOTA', 'Diesel', '60-8FD15', '1500', '1500', '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', '2023-01-01', '2023-01-01', '2023-01-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-410', '19-410', 11, 'B226R07090M', 0, 11528, '2023-08-25', 'Waters', 'R1', 'P28', 'FORKLIFT CB', 'HYSTER', 'Electric', 'J3.00EX 2', '3000', '3000', '3 Stage VMast 4531 mm Side Shifter', 1, '3.00', '4.00', 'forklift.jpg', 'N', '2019-01-01', '2019-02-01', '2019-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('19-472', '19-472', 1, '266 B00078', 0, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'NICHIYU', 'Electric', 'FBT18-80', '1800', '1800', '3 Stage 4.5 m', 1, '3.00', '4.00', 'forklift.jpg', 'Y', '2022-02-01', '2022-01-01', '2022-02-01', NULL, 'Y', 'L', 'Y', 'N', ''),
('19-478', '19-478', 1, '221E08470', 15500000, 3843, '2024-02-29', 'SN', 'West', 'P8', 'FORKLIFT CB', 'NICHIYU', 'Electric', 'FB15P-75C-500', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-04-15', '2022-04-15', '2022-04-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-479', '19-479', 1, 'BIJ-01053', 10000000, 0, NULL, 'SJ1', 'STSJ1', 'SPG1', 'FORKLIFT CB', 'SUMITOMO', 'ELECTRIC', '8FB15PX', '1500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('19-493', '19-493', 1, '266E 00148', 11000000, 11243, '2023-11-28', 'SN', 'East', 'P5', 'FORKLIFT CB', 'Nichiyu', 'Electric', 'FBT18-80 650M', '1800', '1800', '3 stage 4,7 m', 1, '3.00', '4.70', 'default.png', 'Y', '2023-07-19', '2023-07-19', '2023-07-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-002', '20-002', 3, '19111311', 4400000, 0, '2024-02-27', 'SN', 'West', 'P9', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-003', '20-003', 3, '19111312', 4400000, 0, '2023-08-31', 'SN', 'West', 'P9', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-004', '20-004', 3, '19111313', 4400000, 0, '2024-02-27', 'SN', 'West', 'P9', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-005', '20-005', 3, '19111314', 4400000, 0, '2024-02-27', 'SN', 'West', 'P9', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-028', '20-028', 19, '518', 9200000, 0, '2024-03-15', 'SN', 'East', 'P6', 'STACKER', 'CARLIFT', 'Electric', 'CDT 0.35/2,5 M', '350', '350', '2 Stage 2,5 m', 1, '2.00', '2.50', 'default.png', 'Y', '2020-01-30', '2023-01-01', '2020-01-30', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-071', '20-071', 1, 'C881R02155S', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'FORKLIFT CB', 'YALE', 'ELECTRIC', 'FB25RZ', '2500', NULL, '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-107', '20-107', 1, '73021', 6250000, 0, NULL, 'SJ1', 'STSJ1', 'SB1', 'FORKLIFT CB', 'TOYOTA', 'DIESEL', '60-8FD25', '2500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2020-01-01', '2020-01-01', '2020-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-112', '20-112', 2, '185F01598', 8750000, 0, NULL, 'SJ1', 'STSJ1', 'SM2', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW18-85 600MSF', '1800', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-131', '20-131', 14, '2003007', 0, 0, '2023-09-22', 'Waters', 'R3', 'P32', 'STACKER', 'XILIN', 'ELECTRIC', 'CPD15R', '1500', '1500', '3 Stage 4,2 m', 1, '3.00', '4.00', 'forklift.jpg', 'N', '2020-01-01', '2020-02-01', '2020-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('20-158', '20-158', 3, '20010053', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2023-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-229', '20-229', 11, 'CF14E-19551', 0, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT DIESEL', 'MITSUBISHI', 'Diesel', 'FD30NT-2SP30-US/US', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'N', '2020-01-01', '2020-02-01', '2020-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('20-240', '20-240', 1, '73727', 6250000, 0, NULL, 'SJ1', 'STSJ1', 'SB1', 'FORKLIFT CB', 'TOYOTA', 'DIESEL', '60-8FD25', '2500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2020-01-01', '2020-01-01', '2020-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-258', '20-258', 1, '2291600467', 9800000, 3584, '2024-02-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'POWERLIFT', 'Electric', 'CPD15L1', '1500', '1500', '3 Stage 4,8 m', 1, '3.00', '4.80', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-259', '20-259', 1, '2291600468', 9800000, 0, '2024-02-29', 'SN', 'West', 'P9', 'FORKLIFT CB', 'POWERLIFT', 'Electric', 'CPD15L1', '1500', '1500', '3 Stage 4,8  m', 1, '3.00', '4.80', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-260', '20-260', 1, '2291600469', 9800000, 6283, '2023-07-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'POWERLIFT', 'Electric', 'CPD15L1', '1500', '1500', '3 Stage 4,8  m', 1, '3.00', '4.80', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-324', '20-324', 1, '8FBN25-31639', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Diesel', '60-8FDN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-325', '20-325', 1, '8FBN25-32899', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-326', '20-326', 1, '8FBN25-33583', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-327', '20-327', 1, '8FBN25-33462', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-328', '20-328', 1, '8FBN25-33571', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-330', '20-330', 1, '14672', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-331', '20-331', 1, '14649', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-332', '20-332', 1, '17570', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-335', '20-335', 1, '13734', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-350', '20-350', 2, '6646272', 13500000, 0, NULL, 'SJ1', 'STSJ1', 'SS1', 'REACH TRUCK', 'BT', 'ELECTRIC', 'RRE160B', '1600', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', '2020-01-01', '2020-01-01', '2020-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-351', '20-351', 2, '6646270', 24900000, 0, NULL, 'SN', 'West', 'P4', 'FORKLIFT RT', 'BT', 'Electric', 'RRE160B', '1600', '1600', '3 Stage 8,5 m', 1, '3.00', '8.50', 'forklift.jpg', 'Y', '2022-02-24', '2023-02-24', '2023-02-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('20-377', '20-377', 1, '8FBN20-32920', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2000', NULL, '0.0', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('20-428', '20-428', 1, 'B226R07049M', 0, 0, NULL, 'BS', 'DHL', 'DHL1', 'FORKLIFT CB', 'HYSTER', 'ELECTRIC', 'J2.50EX2', '2500', NULL, '2 Stage 3 m FFL', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('21-027', '21-027', 1, '2281400174', 9800000, 8490, '2024-02-29', 'SN', 'West', 'P8', 'FORKLIFT CB', 'POWERLIFT', 'Electric', 'CPD15L1', '1500', '1500', '0', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-036', '21-036', 4, '2010422', 5300000, 73420, '2024-02-29', 'SN', 'West', 'P8', 'STACKER MM', 'XILIN', 'Electric', 'CQD15R', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-037', '21-037', 3, '20010056', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'XILIN', 'Electric', 'CBD15W-LiX', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-052', '21-052', 14, 'R1BA04376', 0, 0, NULL, 'Waters', 'R2', 'P47', 'STACKER', 'HANGCHA', 'Electric', 'CDD16-AC1S MAST3000', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2021-01-01', '2021-02-01', '2021-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('21-086', '21-086', 11, 'R2103082', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'XILIN', 'Electric', 'FB25', '2500', '2500', '3 Stage 4,5  m', 1, '3.00', '4.00', 'forklift.jpg', 'N', '2021-01-01', '2021-02-01', '2021-01-01', NULL, 'N', 'L', 'N', 'N', ''),
('21-117', '21-117', 1, 'Q1BA06722', 13100000, 6, '2023-12-11', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-26', '2023-01-01', '2022-12-26', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-171', '21-171', 2, 'B2K-00539', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW18-85 700 MSF', '1800', NULL, '3 Stage 4 m', 1, '3.00', '4.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('21-172', '21-172', 1, 'B2K-00530', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'FORKLIFT CB', 'SUMITOMO', 'ELECTRIC', '8FB15PXII', '1500', NULL, '3 Stage 4 m', 1, '3.00', '4.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('21-189', '21-189', 3, '08015JG6578', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'HELI', 'Electric', 'CBD15J', '1500', '1500', '0', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-220', '21-220', 2, 'C2X115Y01058/2021', 0, 7047, '2024-03-15', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R16S (115)', '1600', '1600', '0', 1, '3.00', '9.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-221', '21-221', 2, 'C2X115Y01059/2021', 0, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R16S (115)', '1600', '1600', '0', 1, '3.00', '9.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-226', '21-226', 1, 'C11275Y00964/2021', 0, 8409, '2024-03-20', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (1275)', '1600', '1600', '0', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-227', '21-227', 1, 'C11275Y00985/2021', 0, 8432, '2024-03-15', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (1275)', '1600', '1600', '0', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-228', '21-228', 1, 'C11275Y00990/2021', 0, 6003, '2024-03-15', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (1275)', '1600', '1600', '0', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-229', '21-229', 1, 'C11275Y01002/2021', 0, 11583, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (1275)', '1600', '1600', '0', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-230', '21-230', 1, 'C11275Y01004/2021', 0, 11411, '2024-03-18', 'SN', 'East', 'P7', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (1275)', '1600', '1600', '0', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-233', '21-233', 3, 'C21158Y00680/2021', 0, 3053, '2024-03-06', 'SN', 'East', 'P7', 'PALLET TRUCK', 'LINDE', 'Electric', 'T20AP (1158)', '2000', '2000', '0', 1, '0.00', '0.00', 'default.png', 'Y', '2021-09-03', '2021-09-01', '2021-09-03', NULL, 'Y', 'L', 'Y', 'N', ''),
('21-269', '21-269', 1, 'Q1BA06384', 11300000, 0, NULL, 'SN', 'East', 'P6', 'FORKLIFT CB', 'MITSUBISHI', 'Electric', 'CPD15-XD4-SI26', '1500', '1500', '', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-270', '21-270', 1, 'Q1BA06385', 11300000, 3887, '2024-03-19', 'SN', 'East', 'P6', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4-SI26', '1500', '1500', '3 Stage 4,5  m, SIDE SHIFTER', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-271', '21-271', 1, 'Q1BA06390', 11300000, 4851, '2024-03-14', 'SN', 'East', 'P6', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4-SI26', '1500', '1500', '2 Stage 3 m, SIDE SHIFTER', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-272', '21-272', 1, 'Q1BA06391', 11300000, 2817, '2024-03-19', 'SN', 'East', 'P6', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4-SI26', '1500', '1500', '2 Stage 3 m, SIDE SHIFTER', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-273', '21-273', 1, 'Q1BA06392', 11300000, 4264, '2024-03-18', 'SN', 'East', 'P6', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4-SI26', '1500', '1500', '2 Stage 3 m, SIDE SHIFTER', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-274', '21-274', 1, 'Q1BA06393', 11300000, 5851, '2024-03-13', 'SN', 'East', 'P6', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4-SI26', '1500', '1500', '2 Stage 3 m, SIDE SHIFTER', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-390', '21-390', 6, 'C2X115Y01408/2021', 0, 9370, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-11-02', '2021-11-01', '2021-11-02', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-391', '21-391', 6, 'C2X115Y01419/2021', 0, 8678, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-11-02', '2021-11-01', '2021-11-02', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-392', '21-392', 6, 'C2X115Y01428/2021', 0, 8016, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-11-02', '2021-11-01', '2021-11-02', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-393', '21-393', 6, 'C2X115Y01429/2021', 0, 6989, '2024-03-20', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-11-02', '2021-11-01', '2021-11-02', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-394', '21-394', 6, 'C2X115Y01448/2021', 0, 10679, '2024-03-18', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-10-29', '2021-10-01', '2021-10-29', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-395', '21-395', 6, 'C2X115Y01449/2021', 0, 10753, '2024-03-18', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-10-29', '2021-10-01', '2021-10-29', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-396', '21-396', 6, 'C2X115Y01456/2021', 0, 10449, '2024-03-18', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-10-29', '2021-10-01', '2021-10-29', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-397', '21-397', 6, 'C2X115Y01457/2021', 0, 12074, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-10-29', '2021-10-01', '2021-10-29', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-398', '21-398', 6, 'C2X115Y01465/2021', 0, 10028, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-10-29', '2021-10-01', '2021-10-29', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-399', '21-399', 6, 'C2X115Y01472/2021', 0, 9829, '2024-03-19', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-10-29', '2021-10-01', '2021-10-29', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-400', '21-400', 6, 'C2X115Y01473/2021', 0, 11072, '2024-03-20', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-11-05', '2021-11-01', '2021-11-05', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-401', '21-401', 6, 'C2X115Y01545/2021', 0, 9705, '2024-03-20', 'SN', 'East', 'P7', 'FORKLIFT RT', 'LINDE', 'Electric', 'R20S', '2000', '2000', '0', 1, '3.00', '10.00', 'forklift.jpg', 'Y', '2021-11-05', '2021-11-01', '2021-11-05', NULL, 'Y', 'L', 'Y', 'Y', ''),
('21-409', '21-409', 10, '08015JG6580', 6500000, 0, NULL, 'SN', 'East', 'P6', 'Hand Pallet Electric', 'HELI', 'Electric', 'CBD15J', '1500', '1500', '', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-12-14', '2023-01-01', '2022-12-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('21-488', '21-488', 1, '8FBN25-32103', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', NULL, '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('21-711', '21-711', 1, 'H2X386D04175', 11000000, 20444, '2023-11-28', 'SN', 'East', 'P5', 'FORKLIFT CB', 'LINDE', 'Electric', 'E16C (386)', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', '2023-01-01', '2023-01-01', '2023-01-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('B20-217', 'B20-217', 8, 'H00912E20S', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HITACHI', 'Battery', 'VTI 470 - 72V', '0', '0', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-257.', 'B20-257.', 8, 'A2820020750000043900C01408A20191115001.', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014-80-271', '271', '271', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-269.', 'B20-269.', 8, 'A2820020750000043900C01408A20191207012.', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014-80-271', '271', '271', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-343', 'B20-343', 8, 'X011129170014', 0, 0, NULL, 'SN', 'West', 'P9', 'BATTERY', 'EP', 'Battery', 'ZL48360 ( Li-ion )', '360', '360', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-345', 'B20-345', 8, 'X011129160099', 0, 0, NULL, 'SN', 'West', 'P9', 'BATTERY', 'EP', 'Battery', 'ZL48360 ( Li-ion )', '360', '360', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-346', 'B20-346', 8, 'X011129160128', 0, 0, NULL, 'SN', 'West', 'P9', 'BATTERY', 'EP', 'Battery', 'ZL48360 ( Li-ion )', '360', '360', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-523', 'B20-523', 8, '30S19163', 0, 0, NULL, 'SN', 'West', 'P4', 'BATTERY', 'REMICO', 'Battery', '4EPzS620 - 48V', '620', '620', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B20-547', 'B20-547', 8, 'GR319i25', 0, 0, NULL, 'SN', 'West', 'P4', 'BATTERY', 'HAWKER', 'Battery', '4PZS620 - 48V', '620', '620', '-', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B21-540', 'B21-540', 15, 'A20210511003.', 0, 0, NULL, 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-047', 'B22-047', 8, 'A28200207500000983C014S103A20220606002', 0, 1241, '2023-07-31', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-086', 'B22-086', 8, '2201012014', 0, 0, '2024-01-18', 'Waters', 'R2', 'P44', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-097', 'B22-097', 8, '00C093', 0, 0, NULL, 'Waters', 'R2', 'P13', 'BATTERY', 'ENEROC', 'Battery', 'HL-C093-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-230', 'B22-230', 8, 'ET006-26E22A', 0, 3577, '2023-10-03', 'Waters', 'R3', 'P32', 'BATTERY', 'ETERNITY', 'Battery', '4PzS620 - 48V', '620', '620', '48V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-274', 'B22-274', 8, 'A28200207500060147C009S103A20220328005', 0, 0, '2024-01-18', 'Waters', 'R1', 'P28', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-275', 'B22-275', 15, 'A28200207500060147C009S103A20220328003', 0, 0, NULL, 'Waters', 'R1', 'P28', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-277', 'B22-277', 15, 'A28200207500000983C014S103A20220328004', 0, 0, '2023-08-25', 'Waters', 'R1', 'P28', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-278', 'B22-278', 8, 'A28200207500060147C009S103A20220328004', 0, 0, '2023-12-18', 'Waters', 'R1', 'P28', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-279', 'B22-279', 8, 'A20220318009..', 0, 0, '2023-08-10', 'Waters', 'R1', 'P28', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-280', 'B22-280', 8, 'A20220313005..', 0, 0, '2024-01-02', 'Waters', 'R1', 'P28', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-283', 'B22-283', 8, 'A20220416002', 0, 4446, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-284', 'B22-284', 8, 'A28200207500000983C014S103A20220416001', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-285', 'B22-285', 8, 'A20220427006', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-286', 'B22-286', 8, 'A20220328001', 0, 0, NULL, 'Waters', 'R4', 'P37', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-287', 'B22-287', 8, 'A20220322001', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-288', 'B22-288', 8, 'A20220328002', 0, 0, NULL, 'Waters', 'R4', 'P37', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-290', 'B22-290', 8, 'A28200207500060147C009S103A20220401002', 0, 0, NULL, 'Waters', 'R4', 'P37', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-292', 'B22-292', 8, 'A20220427007', 0, 0, '2023-08-04', 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-293', 'B22-293', 8, 'A20220427005', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', '');
INSERT INTO `unit` (`kdunit`, `namaunit`, `idforklifttype`, `serialnumber`, `price`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `equipment`, `merk`, `model`, `type`, `capcity`, `capcity2`, `specification`, `qty`, `mast`, `masheight`, `foto`, `showcustomer`, `dateactual`, `daterequest`, `dateestimated`, `reason`, `flag_aktif`, `flag_baru`, `flag_target`, `flag_actual`, `flag_otif`) VALUES
('B22-294', 'B22-294', 8, 'A20220318006', 0, 3517, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '2500', '2500', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-295', 'B22-295', 8, 'A20220427004', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '48V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-296', 'B22-296', 8, 'A20220415002', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-302', 'B22-302', 8, 'L113-30E22A', 0, 0, NULL, 'Waters', 'R1', 'P31', 'BATTERY', 'LIFTTOP', 'Battery', 'VTI470 - 72V', '0', '0', '72', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-306', 'B22-306', 8, 'A20220415001', 0, 0, '2023-09-10', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-307', 'B22-307', 8, 'A20220318007', 0, 0, '2023-08-04', 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-313', 'B22-313', 8, 'L014-01G22S', 0, 2500, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'LIFTTOP', 'Battery', 'VTI470 - 80V', '470488', '470488', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-314', 'B22-314', 8, 'L016-01G22S', 0, 0, NULL, 'Waters', 'R3', 'P32', 'BATTERY', 'LIFTTOP', 'Battery', 'VTI470 - 80V', '470488', '470488', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-320', 'B22-320', 8, 'A28200207500000983C014S103A20220318004', 0, 1885, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-332', 'B22-332', 8, 'A28200207500060147C009S103A20220427002', 0, 0, '2023-08-03', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-346', 'B22-346', 8, '00C09313A20220328009', 0, 0, NULL, 'Waters', 'R2', 'P13', 'BATTERY', 'ENEROC', 'Battery', 'HL-C093-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-362', 'B22-362', 8, 'A28200207500060147C009S103A20220521001', 0, 0, '2024-01-10', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-363', 'B22-363', 15, 'A28200207500060147C009S103A20220523003', 0, 0, '2024-03-19', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-364', 'B22-364', 15, 'A28200207500060147C009S103A20220523004', 0, 0, '2024-03-20', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-374', 'B22-374', 8, 'TFLJLCC242021L170382', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 20AH', '20', '20', '-', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-387', 'B22-387', 8, 'A28200207500000983C014S103A20220606001', 0, 0, NULL, 'Waters', 'R4', 'P36', 'BATTERY', 'HANGCHA', '-', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-394', 'B22-394', 8, '-', 0, 0, '2023-09-07', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-399CE7', 'B22-399CE7', 8, 'JD2901108FP20NB', 0, 0, NULL, 'SN', 'East', 'P2', 'BATTERY', 'BT', 'Battery', '24 V 0.65 KW', '0', '0', '24 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-400', 'B22-400', 8, '-', 0, 0, '2023-11-22', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-417', 'B22-417', 8, 'A20220519003', 0, 5261, '2023-12-18', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-418', 'B22-418', 8, 'AC609009', 0, 5133, '2023-12-27', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-419', 'B22-419', 8, 'A20220523006', 0, 2959, '2023-12-27', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-422', 'B22-422', 8, 'A20220510001', 0, 3658, '2023-12-14', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-423', 'B22-423', 8, 'A20220510003', 0, 1250, '2023-12-22', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-426', 'B22-426', 8, 'AC610002', 0, 4833, '2023-12-22', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-429', 'B22-429', 8, 'A282002075000601470000C009S103AC823005', 0, 5270, '2023-12-27', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-430', 'B22-430', 8, 'A28200207500060140000C009S103AC609001', 0, 6182, '2024-03-08', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-431', 'B22-431', 8, 'A282002075000601470000C009S103AC614001', 0, 4640, '2023-12-14', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-443', 'B22-443', 8, 'A28200207500000983C014S103A20220322001', 0, 3336, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-444', 'B22-444', 8, 'A28200207500000983C014S103A20220318001', 0, 3350, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-445', 'B22-445', 8, 'A28200207500000983C014S103A20220328001', 0, 3291, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-446', 'B22-446', 8, 'A28200207500000983C014S103A20220318003', 0, 2894, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-447', 'B22-447', 8, 'A28200207500000983C014S103A20220401004', 0, 2769, '2023-09-20', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-448', 'B22-448', 8, 'A28200207500000983C014S103A20220401003', 0, 2032, '2023-10-03', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-458', 'B22-458', 8, 'YSYJJL243022517255', 0, 0, NULL, 'SN', 'West', 'P8', 'BATTERY', 'HELI', '-', '24V 30AH', '30', '30', '24', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-463', 'B22-463', 8, 'A28200207500000983C014S103A20220328002', 0, 3098, '2023-12-22', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-464', 'B22-464', 8, 'A28200207500000983C014S103A20220318002', 0, 3209, '2023-12-22', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-465', 'B22-465', 8, 'A28200207500000983C014A103A20220401005', 0, 3672, '2023-12-15', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-469', 'B22-469', 8, 'A282002075000009830000C014S103AC610001', 0, 0, NULL, 'SN', 'West', 'P3', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80 V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-477', 'B22-477', 8, 'A282002075000601470000C009S103AC609004', 0, 5292, '2024-03-08', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-478', 'B22-478', 8, 'A282002075000601470000C009S103AC609008', 0, 3691, '2023-08-11', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-479', 'B22-479', 8, 'A282002075000601470000C009S103AC614006', 0, 2885, '2023-12-18', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-483', 'B22-483', 8, 'A282002075000601470000C009S103AC609007', 0, 3649, '2023-12-27', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-484', 'B22-484', 8, 'A282002075000601470000C009S03AC608002', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-484(72', 'B22-484(72', 8, 'A282002075000601470000C009S03AC608002', 0, 5197, '2023-12-18', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-485', 'B22-485', 8, 'A282002075000601470000C009S103AC614004', 0, 5225, '2023-12-14', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-495(73', 'B22-495(73', 8, 'YSYJJL243022517390', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24 V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-512(7289)', 'B22-512(7289)', 8, 'A282002075000601470000C009S103AC609010', 0, 1473, '2023-11-17', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-515', 'B22-515', 15, 'A282002075000601470000C009S103AC614007', 0, 1473, '2023-11-17', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-517(7220)', 'B22-517(7220)', 8, 'A282002075000601470000C009S103AC609002', 0, 1125, '2023-09-21', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '404', '404', '80 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-532(73', 'B22-532(73', 8, 'TFLJLCC243022E09315', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-533(73', 'B22-533(73', 8, 'TFLJLCC243022E17174', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-534(73', 'B22-534(73', 8, 'YSYJJL243022720113', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-535(73', 'B22-535(73', 8, 'YSYJJL243022720114', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-536(73', 'B22-536(73', 8, 'TFLJLCC243022G27061', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-537(73', 'B22-537(73', 8, 'TFLJLCC243022E17135', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-538(73', 'B22-538(73', 8, 'TFLJLCC243022G27449', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-539(73', 'B22-539(73', 8, 'TFLJLCC243022E17171', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-540(73', 'B22-540(73', 8, 'TFLJLCC243022E17160', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-541(73', 'B22-541(73', 8, 'YSYJJL243022720146', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-542(73', 'B22-542(73', 8, 'TFLJLCC243022E17170', 0, 0, NULL, 'SN', 'East', 'P7', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-551', 'B22-551', 8, 'A28200207500000983C014S103A20220510002', 0, 0, '2023-08-19', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-558', 'B22-558', 8, 'A282002075000601470000C009S103AC608004', 0, 2341, '2023-09-07', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-564', 'B22-564', 15, 'A28200207500000983C014S103A20220318008', 0, 1920, '2023-08-18', 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-565', 'B22-565', 8, '-', 0, 0, '2023-08-12', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-566', 'B22-566', 8, '-', 0, 0, '2024-01-03', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-567', 'B22-567', 8, '-', 0, 0, '2023-09-08', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-568', 'B22-568', 8, 'A282002075000601470000C009S103AC823007', 0, 1151, '2023-09-07', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-572', 'B22-572', 8, '-', 0, 0, '2023-09-07', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-603', 'B22-603', 8, 'A282002075000601470000C009S103AC914011', 0, 0, '2024-01-05', 'Waters', 'R1', 'P31', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-604', 'B22-604', 8, 'A282002075000601470000C009S103AC829008', 0, 0, '2023-09-29', 'Waters', 'R1', 'P31', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-605', 'B22-605', 8, 'A282002075000601470000C009S103AC713002', 0, 0, '2024-01-04', 'Waters', 'R1', 'P31', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-606', 'B22-606', 15, 'A282002075000601470000C009S103AC916003', 0, 0, '2024-01-05', 'Waters', 'R1', 'P31', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-607', 'B22-607', 15, 'A282002075000601470000C009S103AC914012', 0, 0, '2023-10-03', 'Waters', 'R1', 'P31', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-608', 'B22-608', 8, 'A282002075000601470000C009S103AC914013', 0, 0, '2023-10-06', 'Waters', 'R1', 'P31', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-610', 'B22-610', 8, 'A282002075000009830000C014S103AC916012', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-611', 'B22-611', 8, 'A282002075000009830000C014S103AC916004', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-612', 'B22-612', 8, 'A282002075000009830000C014S103AC916007', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-613', 'B22-613', 8, 'A282002075000009830000C014S103AC916002', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-614', 'B22-614', 8, 'A282002075000009830000C014S103AC916005', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-615', 'B22-615', 8, 'A282002075000601470000C009S103AC916006', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-616', 'B22-616', 8, 'A282002075000009830000C014S103AC916003', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-617', 'B22-617', 8, 'A282002075000009830000C014S103AC916013', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-618', 'B22-618', 8, 'A282002075000009830000C014S103AC916001', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-619', 'B22-619', 8, '06PPB3147AD5AAC72C6D0106', 0, 0, '2023-08-10', 'Waters', 'R1', 'P28', 'BATTERY', 'EIKTO', 'Battery', '51.2 V-270 AH', '270', '270', '51.2V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-624', 'B22-624', 8, 'A282002075000601470000C009S103AC920003', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-625', 'B22-625', 15, 'A282002075000601470000C009S103AC829009', 0, 0, '2023-09-01', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-626', 'B22-626', 15, 'A282002075000009830000C014S103AC909001', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-627', 'B22-627', 15, 'A282002075000009830000C014S103AC719005', 0, 0, '2023-08-21', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-629', 'B22-629', 8, 'A282002075000601470000C009S103AC914006', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-630', 'B22-630', 15, 'A282002075000009830000C014S103AAC907016', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-631', 'B22-631', 15, 'A282002075000009830000C014S103AC718002', 0, 0, '2023-09-17', 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-633', 'B22-633', 15, 'A282002075000601470000C009S103AC829014', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-635', 'B22-635', 8, 'A282002075000601470000C009S103AC823002', 0, 0, '2023-09-01', 'Waters', 'R3', 'P33', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-636', 'B22-636', 8, 'A282002075000009830000C014S103AC720001', 0, 0, '2023-09-01', 'Waters', 'R3', 'P33', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-647', 'B22-647', 8, 'A282002075000601470000C009S103AC823006', 0, 0, NULL, 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-648', 'B22-648', 8, 'A282002075000009830000C014S103AC916019', 0, 0, '2023-09-06', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-650', 'B22-650', 8, 'A282002075000601470000C009S103AC914010', 0, 0, '2023-08-10', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-651', 'B22-651', 8, 'A282002075000601470000C009S103AC914009', 0, 0, '2023-08-05', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-653', 'B22-653', 8, 'A282002075000009830000C014S103AC916020', 0, 750, '2023-11-01', 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-655', 'B22-655', 8, 'A282002075000601470000C009S103AC823013', 0, 0, NULL, 'Waters', 'R1', 'P20', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-657', 'B22-657', 8, 'A282002075000601470000C009S103AC823010', 0, 0, NULL, 'Waters', 'R1', 'P20', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-659', 'B22-659', 8, 'A282002075000601470000C009S103AC829011', 0, 899, '2023-11-15', 'Waters', 'R2', 'P46', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-660', 'B22-660', 8, 'A28200207500000983C014S103A20220401002', 0, 0, '2023-09-06', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-664', 'B22-664', 8, '06PPB83147AD5AAC72C8D0105', 0, 0, NULL, 'Waters', 'R2', 'P43', 'BATTERY', 'EIKTO', 'Battery', '51.2 V-270 AH', '270', '270', '51.2V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-665', 'B22-665', 8, 'A282002075000601470000C009S103AC914004', 0, 0, '2024-03-07', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-666', 'B22-666', 8, 'A282002075000601470000C009S103AC823001', 0, 2341, '2023-09-07', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-669', 'B22-669', 8, 'A282002075000009830000C014S103AC916010', 0, 0, NULL, 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-670', 'B22-670', 8, 'A282002075000009830000C014S103AC916006', 0, 0, '2023-08-19', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-671', 'B22-671', 8, 'A282002075000601470000C009S103AC914007', 0, 0, NULL, 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-672', 'B22-672', 8, 'A282002075000601470000C009S103AC920009', 0, 0, '2023-09-06', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-673', 'B22-673', 8, 'A282002075000601470000C009S103AC914001', 0, 0, NULL, 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-674', 'B22-674', 8, 'A282002075000009830000C014S103AC916017', 0, 0, '2023-08-16', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-675', 'B22-675', 8, 'A282002075000009830000C014S103AC916014', 0, 0, '2023-09-06', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-676', 'B22-676', 8, 'A282002075000009830000C014S103AC916008', 0, 0, NULL, 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-677', 'B22-677', 8, 'A282002075000009830000C014S103AC916015', 0, 0, '2023-09-06', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-678', 'B22-678', 8, 'A282002075000009830000C014S103AC916018', 0, 0, '2023-08-31', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-679', 'B22-679', 8, 'A282002075000009830000C014S103AC916009', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-680', 'B22-680', 8, 'A28200207500000983C014S103A20220401001', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-681', 'B22-681', 8, 'A282002075000601470000C009S103AC829003', 0, 0, '2023-08-19', 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-682', 'B22-682', 8, 'A282002075000009830000C014S103AC909004', 0, 0, NULL, 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-687', 'B22-687', 8, 'A282002075000601470000C009S103AC914002', 0, 87, '2023-10-03', 'Waters', 'R2', 'P46', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-688', 'B22-688', 8, 'A282002075000601470000C009S103AC920004', 0, 0, NULL, 'Waters', 'R2', 'P42', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-689', 'B22-689', 8, 'A282002075000601470000C009S103AC92005', 0, 0, NULL, 'Waters', 'R2', 'P42', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-692', 'B22-692', 8, 'A282002075000601470000C009S103AC914005', 0, 748, '2023-10-03', 'Waters', 'R2', 'P46', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-693', 'B22-693', 8, 'A282002075000601470000C009S103AC920008', 0, 0, '2023-11-03', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-695', 'B22-695', 8, 'A282002075000601470000C009S103AC920006', 0, 0, '2023-11-02', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-696', 'B22-696', 8, 'A282002075000601470000C009S103AC914008', 0, 0, '2024-03-18', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-697', 'B22-697', 8, 'A282002075000601470000C009S103AC829006', 0, 0, NULL, 'Waters', 'R2', 'P42', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-698', 'B22-698', 8, 'A282002075000601470000C009S103AC829004', 0, 0, NULL, 'Waters', 'R2', 'P42', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-699', 'B22-699', 15, 'A282002075000601470000C009S103AC829002', 0, 0, '2023-11-02', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-700', 'B22-700', 8, 'R040630120490S', 0, 0, NULL, 'Waters', 'R1', 'P30', 'BATTERY', 'EP', 'Battery', 'ZL24210 ( Li-ion )', '210', '210', '24', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B22-701', 'B22-701', 8, 'LP-25.6F225ES-22F19-0019', 0, 0, NULL, 'Waters', 'R1', 'P30', 'BATTERY', 'XILIN', 'Battery', '35304000050', '225', '225', '25,6', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-012', 'B23-012', 8, '2205012010W', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-024', 'B23-024', 8, 'A28200207500060147C009S103A20220427005', 0, 0, NULL, 'Waters', 'R2', 'P42', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '404', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-026', 'B23-026', 8, 'A282002075000601470000C009S103AC920013', 0, 0, NULL, 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-027', 'B23-027', 8, 'A282002075000601470000C009S103AC829007', 0, 0, '2024-03-15', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-041', 'B23-041', 8, 'A282002075000009830000C014S103AC930004', 0, 4131, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-044', 'B23-044', 8, 'A282002075000601470000C009S103ACA08005', 0, 0, '2023-11-02', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-045', 'B23-045', 8, 'A282002075000009830000C014S103AC930003', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-046', 'B23-046', 8, 'A282002075000601470000C009S103ACA08008', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-047', 'B23-047', 8, 'A28200207500000983C014S103A20220606002', 0, 3174, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-052', 'B23-052', 8, '2210012033W', 0, 0, '2023-08-19', 'Waters', 'R2', 'P45', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-053', 'B23-053', 8, '2211012014W', 0, 0, '2023-08-19', 'Waters', 'R2', 'P45', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6 V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-056', 'B23-056', 8, 'A282002075000009830000C104S103AC930001', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-068', 'B23-068', 8, '2210012036W', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-069', 'B23-069', 8, '2211012013W', 0, 0, '2023-08-28', 'Waters', 'R2', 'P47', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-070', 'B23-070', 8, 'A282002075000009830000C014S103ACA10006', 0, 0, '2023-08-31', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-080', 'B23-080', 8, 'A282002075000601470000C009S103AC916005', 0, 0, '2023-11-03', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-083', 'B23-083', 8, '-', 0, 0, NULL, 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-084', 'B23-084', 8, 'A282002075000009830000C014S103AC930007', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-085', 'B23-085', 8, '2211012001W', 0, 0, NULL, 'Waters', 'R3', 'P32', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-087', 'B23-087', 15, 'A282002075000601470000C009S103ACA08005', 0, 0, '2023-10-02', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-089', 'B23-089', 8, '-', 0, 0, '2024-02-28', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-090', 'B23-090', 8, '-', 0, 0, NULL, 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-092', 'B23-092', 8, '2211012006W', 0, 0, NULL, 'Waters', 'R3', 'P32', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-093', 'B23-093', 8, '-', 0, 0, '2024-02-28', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD30', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-094', 'B23-094', 8, '-', 0, 0, '2023-07-25', 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', '-', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-094(76', 'B23-094(76', 8, '2211012007W', 0, 0, NULL, 'Waters', 'R3', 'P32', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-095', 'B23-095', 8, 'A28200207500009830000C014S103AC907011', 0, 3471, '2023-12-27', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C0141S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-103', 'B23-103', 8, 'A282002075000601470000C009S103AC920002', 0, 0, NULL, 'Waters', 'R4', 'P19', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-104', 'B23-104', 15, 'A282002075000601470000C009S103AC930003', 0, 0, '2023-11-01', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-107', 'B23-107', 8, 'A282002075000009830000C014S103AC930010', 0, 0, '2023-09-05', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-116', 'B23-116', 8, '2210012058W', 0, 0, '2023-08-31', 'Waters', 'R2', 'P47', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '210', '210', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-117', 'B23-117', 8, '2210012035W', 0, 0, NULL, 'Waters', 'R2', 'P42', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '210', '210', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-125', 'B23-125', 8, '-', 0, 0, NULL, 'Waters', 'R3', 'P34', 'BATTERY', 'HANGCHA', 'Battery', 'CPD15', '0', '0', '0', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-128', 'B23-128', 8, 'A282002075000009830000C014S103AC720003', 0, 2644, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-132', 'B23-132', 8, '2211012010W', 0, 0, NULL, 'Waters', 'R2', 'P43', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-133', 'B23-133', 8, '2211012004W', 0, 0, NULL, 'Waters', 'R2', 'P43', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '25.6V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-136', 'B23-136', 8, 'A282002075000009830000C014S103ACA10005', 0, 4460, '1970-01-01', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-137(7651)', 'B23-137(7651)', 8, 'A282002075000009830000C014S103AC930002', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-139', 'B23-139', 8, 'A282002075000601470000C009S103AC916002', 0, 4206, '2023-10-04', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-140(7647)', 'B23-140(7647)', 8, 'A282002075000009830000C014S103AC916016', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-141', 'B23-141', 8, 'A282002075000009830000C014S103AC720002', 0, 4766, '2023-12-18', 'Waters', 'R3', 'P32', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-148', 'B23-148', 8, 'TFLJLCC243022E17126', 0, 0, NULL, 'SN', 'West', 'P8', 'BATTERY', 'HELI', 'Battery', '24V 30AH', '30', '30', '24', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-188(76', 'B23-188(76', 8, 'A282002075000009830000C014S103AC930009', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-190', 'B23-190', 8, '06PPB3569AD5AACBXCBD0079', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'EIKTO', 'Battery', '51.2 V-270 AH', '270', '270', '48V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-191(7682)', 'B23-191(7682)', 8, 'A282002075000601470000C009S103AC823016', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-192(7683)', 'B23-192(7683)', 8, 'A282002075000601470000C009S103AC823014', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-201', 'B23-201', 8, 'A282002075000601470000C009S103ACA08002', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '0', '0', '80 V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-202', 'B23-202', 8, 'A282002075000009830000C014S103ACA10001', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80 V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-203(7647)', 'B23-203(7647)', 8, 'A282002075000009830000C014S103AC909003', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '0', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-205', 'B23-205', 8, 'A282002075000601470000C009S103AC920001', 0, 0, '2023-10-05', 'Waters', 'R2', 'P40', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-215', 'B23-215', 15, 'A282002075000601470000C009S103AC930001', 0, 0, NULL, 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-231', 'B23-231', 15, 'A282002075000601470000C009S103AC930005', 0, 0, '2023-11-01', 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-233', 'B23-233', 8, 'LP-48F450ES-21B25-0001', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'XILIN', 'Battery', '35304000005', '450', '450', '48', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-234(77', 'B23-234(77', 8, 'A282002075000009830000C014S103AC930006', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-236', 'B23-236', 8, 'A282002075000601470000C009S103AC920014.', 0, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-237', 'B23-237', 8, 'A282002075000009830000C014S103ACA10002', 0, 0, NULL, 'Waters', 'R4', 'P38', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-250', 'B23-250', 8, '2303012056W', 0, 0, NULL, 'SN', 'West', 'P3', 'BATTERY', 'HONG XUN', 'Battery', 'HXYA-LFP-25.6V210-VI', '5376', '5376', '24V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', '');
INSERT INTO `unit` (`kdunit`, `namaunit`, `idforklifttype`, `serialnumber`, `price`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `equipment`, `merk`, `model`, `type`, `capcity`, `capcity2`, `specification`, `qty`, `mast`, `masheight`, `foto`, `showcustomer`, `dateactual`, `daterequest`, `dateestimated`, `reason`, `flag_aktif`, `flag_baru`, `flag_target`, `flag_actual`, `flag_otif`) VALUES
('B23-266', 'B23-266', 8, 'A282002075000009830000C014S103ACB16014', 0, 0, NULL, 'Waters', 'R4', 'P39', 'Battery', 'HANGCHA', 'BATTERY', 'HC-C014S1-80.50-271', '0', '271', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-267', 'B23-267', 8, 'A282002075000009830000C014S103ACB16002', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '271', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-268', 'B23-268', 8, 'A282002075000009830000C014S103ACB16001', 0, 0, NULL, 'Waters', 'R4', 'P39', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '0', '271', '80V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-269', 'B23-269', 8, 'A282002075000009830000C014S103ACB16016', 0, 0, NULL, 'Waters', 'R1', 'P29', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009S1-80.50-404', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-270(7729)', 'B23-270(7729)', 8, 'A282002075000009830000C014S103ACB16004', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-271(7730)', 'B23-271(7730)', 8, 'A282002075000009830000C014S103ACB16010', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-272', 'B23-272', 8, 'A282002075000009830000C014S103ACB16012', 0, 0, '2023-09-19', 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-273(7732)', 'B23-273(7732)', 8, 'A282002075000009830000C014S103ACB16019', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-274(7733)', 'B23-274(7733)', 8, 'A282002075000009830000C014S103ACB16013', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-275', 'B23-275', 8, 'A282002075000009830000C014S103ACB16015', 0, 0, '2024-03-18', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-276(7735)', 'B23-276(7735)', 8, 'A282002075000009830000C014S103ACB16003', 0, 0, NULL, 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-277', 'B23-277', 8, 'A282002075000009830000C014S103ACB16020', 0, 659, '2023-09-06', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-278(7737)', 'B23-278(7737)', 8, 'A282002075000009830000C014S103ACB16008', 0, 0, NULL, 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-279(7738)', 'B23-279(7738)', 8, 'A282002075000009830000C014S103ACB16007', 0, 0, NULL, 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-280', 'B23-280', 8, 'A282002075000009830000C014S103ACB16006', 0, 695, '2023-09-06', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-281', 'B23-281', 8, 'A282002075000009830000C014S103ACB16009', 0, 666, '2023-09-06', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '850V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-282', 'B23-282', 8, 'A282002075000009830000C014S103ACB16017', 0, 0, '2023-08-31', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-283', 'B23-283', 8, 'A282002075000009830000C014S103ACB16011', 0, 0, '2024-03-19', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-284(7743)', 'B23-284(7743)', 8, 'A282002075000009830000C014S103ACB16005', 0, 0, NULL, 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-298', 'B23-298', 15, 'A282002075000009830000C014S103AC909002', 0, 2551, '2023-11-01', 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-300', 'B23-300', 15, 'A282002075000009830000C014S103AC909006', 0, 0, '2024-03-15', 'Waters', 'R2', 'P44', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-305', 'B23-305', 15, 'A282002075000009830000C014S103AC718001', 0, 1800, '2023-11-01', 'Waters', 'R2', 'P41', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-306', 'B23-306', 8, 'A282002075000009830000C014S103AC907012', 0, 0, '2023-08-31', 'Waters', 'R2', 'P47', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-307(7733)', 'B23-307(7733)', 15, 'A282002075000009830000C014S103AC909005', 0, 1240, '2023-11-17', 'Waters', 'R2', 'P43', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C014S1-80.50-271', '271', '271', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-347', 'B23-347', 8, '06PPAA00818D5AD46D3D0241', 0, 0, NULL, 'Waters', 'R2', 'P11', 'BATTERY', 'EIKTO', 'BATTERY', 'EKT 51.2V-270AH', '0', '0', '270AH', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-416', 'B23-416', 8, '000000C21403AD615001', 0, 0, NULL, 'Waters', 'R2', 'P11', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-417', 'B23-417', 8, '000000C21403AD615011', 0, 0, NULL, 'Waters', 'R2', 'P11', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-418', 'B23-418', 8, '06PPB3569AD5AACBXCBD0053', 0, 0, NULL, 'Waters', 'R2', 'P14', 'BATTERY', 'EIKTO', 'Battery', 'EKT 51.2V-270AH', '270', '270', '48', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-422(7833)', 'B23-422(7833)', 8, '000000C21403AD614002', 0, 0, NULL, 'Waters', 'R2', 'P16', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-423(7840)', 'B23-423(7840)', 8, '000000C21403AD615008', 0, 0, NULL, 'Waters', 'R2', 'P16', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-424(7846)', 'B23-424(7846)', 8, '000000C21403AD615006', 0, 0, NULL, 'Waters', 'R2', 'P16', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-425(7834)', 'B23-425(7834)', 8, '000000C21403AD614001', 0, 0, NULL, 'Waters', 'R2', 'P16', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-431', 'B23-431', 8, '000000C21403AD615009', 0, 0, NULL, 'Waters', 'R2', 'P21', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-432', 'B23-432', 8, '000000C21403AD615003', 0, 0, NULL, 'Waters', 'R2', 'P21', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-433', 'B23-433', 8, '000000C21403AD615010', 0, 0, NULL, 'Waters', 'R2', 'P21', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-434', 'B23-434', 8, '000000C21403AD615004', 0, 0, NULL, 'Waters', 'R2', 'P21', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-436', 'B23-436', 8, 'A2820020750000044200C00908A20190711003', 0, 0, NULL, 'Waters', 'R2', 'P45', 'BATTERY', 'HANGCHA', 'Battery', 'HC-C009-80-404', '404', '404', '80V', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-479(7839)', 'B23-479(7839)', 8, '000000C21403AD615002', 0, 0, NULL, 'Waters', 'R2', 'P15', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-480(7843)', 'B23-480(7843)', 8, '000000C21403AD614003', 0, 0, NULL, 'Waters', 'R2', 'P14', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-483(7837)', 'B23-483(7837)', 8, '000000C21403AD615005', 0, 0, NULL, 'Waters', 'R2', 'P14', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-484(7842)', 'B23-484(7842)', 8, '000000C21403AD615012', 0, 0, NULL, 'Waters', 'R2', 'P14', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-488(7838)', 'B23-488(7838)', 8, '000000C21403AD615007', 0, 0, NULL, 'Waters', 'R2', 'P15', 'BATTERY', 'ENEROC', 'Battery', 'HL-C214-80.50-404', '404', '404', '80', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-643(7962)', 'B23-643(7962)', 8, 'G809750230520012', 0, 0, NULL, 'SN', 'West', 'P3', 'BATTERY', 'JUNGHEINRICH', 'Battery', '48V5PZS775', '0', '0', '48V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-644(7963)', 'B23-644(7963)', 8, 'G809750230520014', 0, 0, NULL, 'SN', 'West', 'P3', 'BATTERY', 'JUNGHEINRICH', 'Battery', '48V5PZS775', '0', '0', '775AH 48V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-645(7964)', 'B23-645(7964)', 8, 'G809750230520009', 0, 0, NULL, 'SN', 'West', 'P3', 'BATTERY', 'JUNGHEINRICH', 'Battery', '48V5PZS775', '0', '0', '48V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('B23-646(7965)', 'B23-646(7965)', 8, 'G809750230520015', 0, 0, NULL, 'SN', 'West', 'P3', 'BATTERY', 'JUNGHEINRICH', 'Battery', '48V5PZS775', '0', '0', '48V', 1, '0.00', '0.00', 'default.png', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('BT0220', 'BT0220', 8, 'T19C1631', 0, 0, NULL, 'SN', 'West', 'P9', 'BATTERY', 'XILIN', 'Battery', 'DZL482001.Q00', '20', '20', '48', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('BT0320', 'BT0320', 8, 'T19C1632', 0, 0, NULL, 'SN', 'West', 'P9', 'BATTERY', 'XILIN', 'Battery', 'DZL482001.Q00', '20', '20', '48', 1, '0.00', '0.00', 'forklift.jpg', 'N', NULL, NULL, NULL, NULL, 'N', '', 'N', 'N', ''),
('dummy1', 'dummy1', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy10', 'dummy10', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy11', 'dummy11', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy12', 'dummy12', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy13', 'dummy13', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'Y', NULL, '2023-01-01', '2024-05-31', NULL, 'Y', 'B', NULL, 'Y', 'LATE'),
('dummy14', 'dummy14', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'Y', NULL, '2023-01-01', '2024-05-31', NULL, 'Y', 'B', NULL, 'Y', 'LATE'),
('dummy15', 'dummy15', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'Y', NULL, '2023-01-01', '2024-05-31', NULL, 'Y', 'B', NULL, 'Y', 'LATE'),
('dummy16', 'dummy16', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'N', NULL, '2023-01-01', '2024-12-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy17', 'dummy17', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'N', NULL, '2023-01-01', '2024-12-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy18', 'dummy18', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'N', NULL, '2023-01-01', '2025-01-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy19', 'dummy19', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'N', NULL, '2023-01-01', '2024-05-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy2', 'dummy2', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy20', 'dummy20', 7, '-', 38200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'default.png', 'N', NULL, '2023-01-01', '2024-05-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy21', 'dummy21', 2, '-', 26000000, 0, NULL, 'Waters', 'R2', 'P21', '-', '-', '-', '-', '1800', '1800', '-', 1, '3.00', '8.00', 'default.png', 'N', NULL, '2023-05-19', '2024-07-31', NULL, 'N', 'B', NULL, 'N', 'OTIF'),
('dummy3', 'dummy3', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy4', 'dummy4', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy5', 'dummy5', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy6', 'dummy6', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy7', 'dummy7', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy8', 'dummy8', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('dummy9', 'dummy9', 6, '-', 31200000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '3.00', '10.40', 'default.png', 'N', NULL, '2023-01-01', '2024-08-31', NULL, 'N', 'B', NULL, 'N', 'LATE'),
('E 8139', 'E 8139', 4, '080157AQ725', 6300000, 0, NULL, 'SJ1', 'STSJ1', 'SM1', 'STACKER', 'HELI', 'ELECTRIC', 'CQDM15-810', '1500', NULL, '-', 1, '3.00', '4.50', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7004', 'E7004', 1, 'Q1BA06701', 12300000, 4945, '2023-09-26', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 6 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7069', 'E7069', 4, '080157V5049', 5400000, 1146, '2024-01-16', 'Waters', 'R2', 'P44', 'STACKER MM', 'HELI', 'Electric', 'CQDM15-810', '1500', '1500', '-', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-03-14', '2023-01-01', '2023-03-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7078', 'E7078', 1, '05030DG5558', 15800000, 2943, '2023-11-10', 'Waters', 'R2', 'P13', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD30-GB2LI-M', '3000', '3000', '3 Stage 4,5 m, Side Shifter', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-07-07', '2023-07-01', '2023-07-07', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7080', 'E7080', 9, '08015JL4320', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'Electric', 'CBD15J', '1500', '1500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-03-12', '2023-01-01', '2022-03-12', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7100', 'E7100', 1, '05030DG5560', 15300000, 0, NULL, 'Waters', 'R4', 'P10', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GB2LI-M', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', '2022-12-26', '2023-07-01', '2022-12-26', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7105', 'E7105', 3, '080307V5410', 6500000, 891, '2024-03-20', 'SN', 'East', 'P7', '-', '-', '-', '-', '2000', '2000', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-11-30', '2023-01-01', '2023-11-30', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7150', 'E7150', 1, 'B2K-00544', 11000000, 0, NULL, 'SJ1', 'STSJ1', 'SPG2', 'FORKLIFT CB', 'SUMITOMO', 'ELECTRIC', '8FB15PX', '1500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2022-01-01', '2022-01-01', '2022-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7166', 'E7166', 11, 'B2K-00088', 0, 135050, '2023-11-08', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'SUMITOMO', 'Electric', '8FB25PXII', '2500', '2500', '-', 1, '2.00', '3.00', 'forklift.jpg', 'N', '2023-01-01', '2023-01-01', '2023-02-10', NULL, 'N', 'L', 'N', 'N', ''),
('E7169', 'E7169', 1, 'Q1BB10040', 12300000, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7170', 'E7170', 1, 'Q1BB10041', 11400000, 3435, '1970-01-01', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-07-13', '2023-01-01', '2022-07-13', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7171', 'E7171', 1, 'Q1BB10042', 11400000, 1039, '2024-03-04', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-11-11', '2023-01-01', '2022-11-11', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7172', 'E7172', 1, 'Q1BB10043', 15300000, 3025, '2023-09-12', 'Waters', 'R1', 'P28', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-07', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7173', 'E7173', 1, 'Q1BB10044', 15300000, 460, '2024-01-02', 'Waters', 'R1', 'P28', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-07', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7174', 'E7174', 1, 'Q1BB10045', 11400000, 3499, '1970-01-01', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-07-13', '2023-01-01', '2022-07-13', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7175', 'E7175', 1, 'Q1BB10046', 11400000, 2356, '2024-03-19', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-27', '2023-01-01', '2022-09-26', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7176', 'E7176', 1, 'Q1BB10047', 11400000, 2798, '2023-12-14', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-23', '2023-01-01', '2022-09-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7177', 'E7177', 1, 'Q1BB10048', 11400000, 3037, '2024-03-15', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-23', '2023-01-01', '2022-11-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7178', 'E7178', 1, 'Q1BB10049', 11400000, 3128, '2023-12-06', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-23', '2023-01-01', '2022-09-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7179', 'E7179', 1, 'Q1BB10050', 11400000, 1776, '2024-03-11', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-23', '2023-01-01', '2022-09-23', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7181', 'E7181', 1, 'Q1BB10052', 11400000, 3959, '2024-01-22', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-27', '2023-01-01', '2022-09-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7183', 'E7183', 1, 'Q1BB10054', 16500000, 92, '2023-09-04', 'SN', 'West', 'P3', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-05-17', '2023-01-01', '2023-05-17', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7184', 'E7184', 1, 'Q1BB10008', 14800000, 5980, '2023-11-09', 'Waters', 'R4', 'P37', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-02-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7185', 'E7185', 1, 'Q1BB10009', 13100000, 6010, '2024-01-16', 'Waters', 'R1', 'P28', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-07', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7186', 'E7186', 1, 'Q1BB10010', 13100000, 5821, '2024-01-02', 'Waters', 'R1', 'P28', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-07', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7187', 'E7187', 1, 'Q1BB10011', 14800000, 6141, '2023-11-09', 'Waters', 'R4', 'P37', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-02-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7188', 'E7188', 1, 'Q1BB10012', 14800000, 6299, '2023-11-09', 'Waters', 'R4', 'P37', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-03-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7189', 'E7189', 1, 'Q1BB10013', 14800000, 6245, '2023-08-04', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7190', 'E7190', 1, 'Q1BB10014', 14800000, 5213, '2023-09-27', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7191', 'E7191', 1, 'Q1BB10015', 14800000, 6509, '2023-09-27', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7192', 'E7192', 1, 'Q1BB10020', 13100000, 4051, '2024-01-17', 'Waters', 'R3', 'P34', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-07-19', '2023-01-01', '2022-07-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7193', 'E7193', 1, 'Q1BB10022', 14800000, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7206', 'E7206', 1, 'Q1BB10019', 14800000, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7207', 'E7207', 1, 'Q1BB10021', 14800000, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7209', 'E7209', 1, 'Q1BB10016', 14800000, 0, NULL, 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7210', 'E7210', 1, 'Q1BB10018', 14800000, 7112, '2023-09-27', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7242', 'E7242', 1, '05030DH3052', 15800000, 1554, '2023-10-12', 'Waters', 'R2', 'P13', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD30-GB2LI-M', '3000', '3000', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-07-27', '2023-07-01', '2023-07-07', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7252', 'E7252', 1, '36BB00402', 13100000, 4723, '2023-12-22', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-13', '2023-01-01', '2022-09-04', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7253', 'E7253', 1, '36BB00401', 13100000, 6308, '2024-03-18', 'Waters', 'R2', 'P44', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-08-10', '2023-01-01', '2022-08-04', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7254', 'E7254', 1, '36BB00403', 13100000, 6733, '2024-03-18', 'Waters', 'R2', 'P44', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-08-10', '2023-01-01', '2022-08-04', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7255', 'E7255', 1, '36BB00398', 13100000, 6271, '2024-03-17', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-13', '2023-01-01', '2022-09-04', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7256', 'E7256', 1, '36BB00404', 15300000, 0, NULL, 'Waters', 'R3', 'P27', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-08-14', '2023-08-14', '2023-08-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7257', 'E7257', 1, '36BB00400', 14800000, 2461, '2023-09-27', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-13', '2023-01-01', '2022-11-04', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7258', 'E7258', 1, '36BB00405', 12300000, 1703, '2023-08-04', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-S126', '2500', '2500', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-13', '2023-01-01', '2022-11-04', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7264', 'E7264', 9, '08015JL4321', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-08-13', '2023-01-01', '2022-08-13', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7271', 'E7271', 1, '36BB00884', 13000000, 2764, '2023-08-04', 'Waters', 'R4', 'P36', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-12-22', '2023-01-01', '2022-12-08', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7274', 'E7274', 1, '36BB00880', 11400000, 4666, '2024-03-11', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-17', '2023-01-01', '2022-09-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7275', 'E7275', 1, '36BB00881', 11400000, 6045, '2024-03-15', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-17', '2023-01-01', '2022-09-14', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7276', 'E7276', 1, '36BB00882', 11400000, 1333, '1970-01-01', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-15', '2023-01-01', '2023-02-15', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7277', 'E7277', 1, '36BB00883', 11400000, 1975, '2023-12-22', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2022-12-28', '2023-01-01', '2023-02-06', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7281', 'E7281', 1, '36BB00907', 13100000, 6308, '2024-03-08', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-19', '2023-01-01', '2022-09-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7282', 'E7282', 1, '36BB00908', 13100000, 6217, '2024-03-12', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-19', '2023-01-01', '2022-09-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7283', 'E7283', 1, '36BB00909', 13100000, 0, '2024-03-10', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-10-05', '2023-01-01', '2022-09-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7284', 'E7284', 1, '36BB00910', 13100000, 4508, '2024-03-13', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-10-05', '2023-01-01', '2022-09-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7285', 'E7285', 1, '36BB00911', 13100000, 5049, '2023-12-18', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-30', '2023-01-01', '2022-09-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7286', 'E7286', 1, '36BB00912', 13100000, 4441, '2024-03-10', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-30', '2023-01-01', '2022-09-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7288', 'E7288', 1, '36BB00914', 13100000, 4646, '2024-03-17', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-11-07', '2023-01-01', '2022-11-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7290', 'E7290', 1, '36BB00916', 13100000, 4319, '2024-03-17', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-10-27', '2023-01-01', '2022-10-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7291', 'E7291', 1, '36BB02326', 15350000, 4420, '2024-01-05', 'Waters', 'R1', 'P31', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-17', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7292', 'E7292', 1, '36BB02327', 15350000, 8625, '2023-09-10', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-11-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7295', 'E7295', 1, '36BB00407', 11300000, 0, '2024-03-01', 'SN', 'East', 'P6', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4.7 m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-05-26', '2023-01-01', '2023-05-27', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7300', 'E7300', 2, '185F02576', 9800000, 0, '2023-09-17', 'Waters', 'R1', 'P29', 'FORKLIFT RT', 'NICHIYU', 'ELECTRIC', 'FBRW15-85 600MSF', '1500', '1500', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2022-12-20', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7304', 'E7304', 9, '20220500843', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'BT', 'ELECTRIC', 'LHE150', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-01', '2023-01-01', '2022-09-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7308', 'E7308', 1, 'CT18C-88136', 7250000, 0, NULL, 'SJ1', 'STSJ1', 'SM2', 'FORKLIFT CB', 'CATERPILLAR', 'ELECTRIC', 'DP25ND', '2500', NULL, '-', 1, '2.00', '3.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7336', 'E7336', 2, '1A 580603', 0, 0, '2023-12-21', 'PSR', 'PSR1', 'LOC1', 'REACH TRUCK', 'CROWN', 'ELECTRIC', 'RD 5725-32TT270CR', '1460', NULL, 'Lifting Height : 6.855 mm', 1, '3.00', '6.80', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E7349', 'E7349', 3, '08015JN5781', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-10-29', '2023-01-01', '2023-10-29', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7359', 'E7359', 9, '08015JN5780', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-09-22', '2023-01-01', '2022-09-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7360', 'E7360', 4, '080157W0910', 9700000, 67, '2024-03-17', 'SN', 'East', 'P7', 'STACKER', 'HELI', 'Electric', 'CQDM15-810', '1500', '1500', NULL, 1, '2.00', '3.30', NULL, 'Y', '2023-05-28', '2023-01-01', '2023-05-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7384', 'E7384', 9, '08015JP5492', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7385', 'E7385', 9, '08015JP5498', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7386', 'E7386', 9, '08015JP5499', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7387', 'E7387', 9, '08015JP5500', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7388', 'E7388', 9, '08015JP5502', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7389', 'E7389', 9, '08015JP5505', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7390', 'E7390', 9, '08015JP5506', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7391', 'E7391', 9, '08015JP5495', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7392', 'E7392', 9, '08015JP5494', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7393', 'E7393', 9, '08015JP5504', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7394', 'E7394', 9, '08015JP5496', 6500000, 0, NULL, 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J-LiS', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-02', '2023-01-01', '2022-11-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7407', 'E7407', 1, '36BB01496', 13100000, 3229, '2024-01-18', 'Waters', 'R3', 'P34', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-11-14', '2023-01-01', '2022-11-11', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7408', 'E7408', 1, '36BB01497', 15800000, 1628, '2023-07-17', 'Waters', 'R3', 'P26', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-10-24', '2023-10-24', '2023-10-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7409', 'E7409', 1, '36BB01498', 13100000, 2051, '2024-03-17', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 6 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-10-24', '2023-01-01', '2023-10-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7410', 'E7410', 1, '36BB01499', 15300000, 0, NULL, 'Waters', 'R3', 'P27', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30', '3000', '3000', NULL, 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-14', '2023-08-14', '2023-08-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7412', 'E7412', 4, '080167V7803', 5400000, 41202, '2023-08-07', 'Waters', 'R2', 'P45', 'STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-07', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7415', 'E7415', 1, '36BB02299', 11400000, 2098, '2023-08-09', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-24', '2023-01-01', '2023-01-05', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7416', 'E7416', 1, '36BB02300', 11400000, 1105, '2023-08-01', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-24', '2023-01-01', '2023-01-05', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7417', 'E7417', 1, '36BB02301', 11400000, 2200, '2023-08-25', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2023-01-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7418', 'E7418', 1, '36BB02315', 15350000, 2571, '2024-01-12', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-19', '2023-01-01', '2022-12-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7419', 'E7419', 1, '36BB02362', 15350000, 918, '2024-01-04', 'Waters', 'R1', 'P31', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-16', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7420', 'E7420', 1, '36BB02363', 15350000, 2738, '2024-01-05', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-19', '2023-01-01', '2022-12-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7427', 'E7427', 1, '36BB02317', 15350000, 2366, '2024-01-04', 'Waters', 'R1', 'P31', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-16', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7428', 'E7428', 1, '36BB02318', 15350000, 825, '2024-01-05', 'Waters', 'R1', 'P31', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-16', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7429', 'E7429', 1, '36BB02357', 16300000, 3833, '2023-12-18', 'Waters', 'R1', 'P18', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 6 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-24', '2023-07-01', '2022-12-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7430', 'E7430', 1, '36BB02358', 16000000, 1577, '2023-09-11', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2022-12-22', '2023-01-01', '2022-12-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7467', 'E7467', 4, '080167V7808', 7550000, 0, '2023-10-25', 'Waters', 'R1', 'P31', 'STACKER', 'HELI', 'ELECTRIC', 'CDD16-950', '1600', '1600', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-02-07', '2023-01-01', '2023-02-07', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7468', 'E7468', 3, '080307W0763', 7700000, 446, '2023-09-01', 'Waters', 'R1', 'P30', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD30-460Li', '3000', '3000', '1,220mm fork length Outer fork width 685mm, Platform and side guard', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-17', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7469', 'E7469', 4, '080167V7805', 8500000, 0, NULL, 'Waters', 'R1', 'P29', 'STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-20', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7470', 'E7470', 1, '36BB02304', 12100000, 7287, '2023-09-17', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7471', 'E7471', 1, '36BB02305', 12100000, 5722, '2023-09-17', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7472', 'E7472', 1, '36BB02306', 12100000, 4552, '2023-09-17', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7473', 'E7473', 1, '36BB02307', 12100000, 4526, '2023-09-17', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7474', 'E7474', 1, '36BB02308', 13800000, 1575, '2023-12-06', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7475', 'E7475', 1, '36BB02309', 13800000, 1141, '2023-12-06', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7476', 'E7476', 1, '36BB02310', 13800000, 481, '2023-09-03', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7477', 'E7477', 1, '36BB02311', 13800000, 1235, '2024-01-09', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-19', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7478', 'E7478', 1, '36BB02351', 13100000, 7741, '2023-12-04', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7484', 'E7484', 1, '36BB01482', 15600000, 0, NULL, 'Waters', 'R4', 'P10', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 6 m', 1, '3.00', '6.00', 'default.png', 'Y', '2022-12-22', '2023-07-01', '2022-12-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7485', 'E7485', 1, '36BB01500', 13000000, 1179, '2023-12-07', 'Waters', 'R3', 'P33', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-12-19', '2023-01-01', '2023-01-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7486', 'E7486', 1, '36BB01487', 11600000, 233, '2023-12-07', 'Waters', 'R3', 'P33', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-12-15', '2023-01-01', '2023-01-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7487', 'E7487', 1, '36BB01503', 13700000, 1684, '2023-09-11', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-22', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7489', 'E7489', 1, '36BB01502', 13100000, 4037, '2024-03-18', 'Waters', 'R2', 'P44', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 4 m', 1, '2.00', '4.00', 'forklift.jpg', 'Y', '2022-12-22', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7490', 'E7490', 1, '36BB02312', 11400000, 2393, '2023-08-16', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7491', 'E7491', 1, '36BB02313', 11400000, 1965, '2023-08-07', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7492', 'E7492', 1, '36BB02320', 13100000, 2899, '2023-09-04', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-24', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7493', 'E7493', 1, '36BB02321', 13100000, 2836, '2023-09-04', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-24', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF');
INSERT INTO `unit` (`kdunit`, `namaunit`, `idforklifttype`, `serialnumber`, `price`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `equipment`, `merk`, `model`, `type`, `capcity`, `capcity2`, `specification`, `qty`, `mast`, `masheight`, `foto`, `showcustomer`, `dateactual`, `daterequest`, `dateestimated`, `reason`, `flag_aktif`, `flag_baru`, `flag_target`, `flag_actual`, `flag_otif`) VALUES
('E7496', 'E7496', 1, '36BB01505', 15800000, 0, '2023-12-16', 'Waters', 'R1', 'P20', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-24', '2023-07-01', '2022-12-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7497', 'E7497', 1, '36BB01506', 15800000, 0, '2023-12-16', 'Waters', 'R1', 'P20', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-24', '2023-07-01', '2022-12-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7498', 'E7498', 1, '36BB01488', 15600000, 3257, '2024-01-18', 'Waters', 'R1', 'P18', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2022-12-24', '2023-07-01', '2022-12-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7499', 'E7499', 1, '36BB02294', 12900000, 2008, '2023-09-19', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2022-11-27', '2023-01-01', '2022-11-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7500', 'E7500', 2, '185F03110', 9800000, 0, '2023-09-17', 'Waters', 'R1', 'P30', 'FORKLIFT RT', 'NICHIYU', 'ELECTRIC', 'FBRW15-85', '1500', '1500', '3 Stage 6,5 m', 1, '3.00', '6.50', 'forklift.jpg', 'Y', '2022-12-24', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7501', 'E7501', 2, '185F03111', 12300000, 0, NULL, 'Waters', 'R2', 'P16', 'FORKLIFT RT', 'NICHIYU', 'ELECTRIC', 'FBRW15-85', '1500', '1500', '3 Stage 6,5 m', 1, '3.00', '6.50', 'forklift.jpg', 'Y', '2022-12-27', '2023-07-01', '2022-12-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7502', 'E7502', 1, '36BB01501', 13100000, 2801, '2024-03-17', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 4 m', 1, '2.00', '4.00', 'forklift.jpg', 'Y', '2022-12-26', '2023-01-01', '2022-11-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7505', 'E7505', 1, '36BB02345', 13100000, 2722, '2023-11-25', 'Waters', 'R2', 'P40', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-26', '2023-01-01', '2022-12-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7506', 'E7506', 1, '36BB02316', 13100000, 4098, '2024-03-17', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-26', '2023-01-01', '2022-12-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7507', 'E7507', 2, '185F03109', 12300000, 981, '2023-12-09', 'Waters', 'R2', 'P12', 'FORKLIFT RT', 'NICHIYU', 'ELECTRIC', 'FBRW15-85', '1500', '1500', '3 Stage 6,5 m', 1, '3.00', '6.50', 'forklift.jpg', 'Y', '2022-12-27', '2023-07-01', '2022-12-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7511', 'E7511', 1, '36BB02322', 13100000, 2969, '2023-09-04', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7512', 'E7512', 1, '36BB02325', 13100000, 2679, '2023-09-04', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-20', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7513', 'E7513', 1, '36BB02296', 11400000, 1372, '2023-07-31', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2023-01-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7514', 'E7514', 1, '36BB02297', 11400000, 1187, '2023-08-14', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2023-01-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7515', 'E7515', 1, '36BB02298', 11400000, 1180, '2023-08-30', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '2.00', '4.70', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2023-01-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7516', 'E7516', 1, '36BB02344', 13100000, 2607, '2023-08-15', 'Waters', 'R2', 'P45', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-22', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7517', 'E7517', 1, '36BB02302', 11400000, 2319, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-28', '2023-01-01', '2022-12-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7518', 'E7518', 4, '330110766', 5400000, 922, '2023-08-29', 'Waters', 'R2', 'P47', 'PALLET STACKER', 'POWERLIFT', 'ELECTRIC', 'ES16-RS', '1600', '1600', '3 Stage 5 m', 1, '3.00', '5.00', 'forklift.jpg', 'Y', '2022-12-28', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7519', 'E7519', 1, '36BB02303', 11400000, 2282, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-28', '2023-01-01', '2022-12-27', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7521', 'E7521', 1, '36BB02319', 13100000, 4189, '2023-11-26', 'Waters', 'R2', 'P40', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-30', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7522', 'E7522', 1, '36BB01507', 13100000, 5414, '2023-11-29', 'Waters', 'R2', 'P42', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 4 m', 1, '2.00', '4.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7523', 'E7523', 1, '36BB02346', 15800000, 457, '2023-12-09', 'Waters', 'R2', 'P12', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-08-30', '2023-08-30', '2023-06-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7524', 'E7524', 1, '36BB02347', 13100000, 5627, '2023-11-29', 'Waters', 'R2', 'P42', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7525', 'E7525', 1, '36BB02348', 13100000, 5414, '2023-11-29', 'Waters', 'R2', 'P42', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7526', 'E7526', 1, '36BB02349', 13100000, 5616, '2023-11-29', 'Waters', 'R2', 'P42', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7527', 'E7527', 1, '36BB02350', 15800000, 664, '2023-12-09', 'Waters', 'R2', 'P12', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-08-30', '2023-08-30', '2023-06-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7528', 'E7528', 1, '36BB02323', 13100000, 1130, '2024-01-27', 'Waters', 'R2', 'P46', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-29', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7529', 'E7529', 1, '36BB02352', 13100000, 4150, '2023-11-26', 'Waters', 'R2', 'P40', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-30', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7532', 'E7532', 1, '36BB02324', 13100000, 105, '2024-01-19', 'Waters', 'R2', 'P46', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-29', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7533', 'E7533', 4, '330110767', 8500000, 657, '2023-09-01', 'Waters', 'R1', 'P30', 'STACKER', 'POWERLIFT', 'ELECTRIC', 'ES16-RS', '1600', '1600', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-07', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7534', 'E7534', 4, '22020165', 8500000, 0, '2023-09-01', 'Waters', 'R1', 'P30', 'STACKER', 'XILIN', 'ELECTRIC', 'CDDK15-II', '1500', '1500', 'MAST HEIGHT 4500MM', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-29', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7548', 'E7548', 3, '080307W0954', 4900000, 9114, '2023-08-15', 'Waters', 'R2', 'P47', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD30-460', '3000', '3000', '1,220mm fork length Outer fork width 685mm, Platform and side guard, Lithium Battery', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-01-05', '2023-01-01', '2023-01-05', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7553', 'E7553', 1, '36BB01448', 9800000, 1385, '2024-02-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD20-XD4-SI26', '2000', '2000', '3 Stage 4,5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2022-08-18', '2023-01-01', '2022-08-18', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7558', 'E7558', 1, '36BB02353', 13100000, 4051, '2023-11-26', 'Waters', 'R2', 'P40', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-01-11', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7559', 'E7559', 1, '36BB02354', 13100000, 1556, '2024-03-20', 'Waters', 'R2', 'P44', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-01-12', '2023-01-01', '2023-01-12', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7560', 'E7560', 1, '36BB02355', 13100000, 1042, '2024-01-21', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-01-12', '2023-01-01', '2023-01-12', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7565', 'E7565', 1, '36BB02761', 13100000, 6753, '2023-12-05', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-28', '2023-01-01', '2023-02-12', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7566', 'E7566', 1, '36BB02762', 13100000, 1766, '2024-02-28', 'Waters', 'R3', 'P34', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m,', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-11', '2023-01-01', '2023-02-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7567', 'E7567', 1, '36BB02763', 13100000, 2748, '2024-02-27', 'Waters', 'R3', 'P34', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m,', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-11', '2023-01-01', '2023-02-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7568', 'E7568', 1, '36BB02764', 13100000, 0, NULL, 'Waters', 'R3', 'P34', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-11', '2023-01-01', '2023-02-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7572', 'E7572', 1, '36BB02755', 11400000, 4368, '2024-03-13', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-15', '2023-01-01', '2023-01-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7573', 'E7573', 1, '36BB02754', 11400000, 2547, '2023-09-05', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-07', '2023-01-01', '2023-02-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7592', 'E7592', 4, '080167X4335', 5400000, 2566, '2023-08-10', 'Waters', 'R2', 'P45', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-01-30', '2023-01-01', '2023-01-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7593', 'E7593', 4, '080167X4349', 5400000, 2499, '2023-08-07', 'Waters', 'R2', 'P45', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-01-30', '2023-01-01', '2023-01-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7594', 'E7594', 1, '36BB02359', 13100000, 3741, '2023-11-25', 'Waters', 'R2', 'P40', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,3 m', 1, '3.00', '4.30', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-02-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7603', 'E7603', 1, '36BB02752', 11400000, 1296, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-03-02', '2023-01-01', '2023-03-02', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7604', 'E7604', 1, '36BB02753', 11400000, 1494, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-01', '2023-01-01', '2023-02-01', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7605', 'E7605', 1, '36BB02756', 11400000, 4754, '2024-01-16', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-01-25', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7616', 'E7616', 4, '080167X4336', 5400000, 162, '2023-12-08', 'Waters', 'R2', 'P41', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-09', '2023-01-01', '2023-02-01', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7619', 'E7619', 4, '080167X4343', 5400000, 2894, '2023-10-05', 'Waters', 'R2', 'P47', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-07', '2023-01-01', '2023-02-01', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7620', 'E7620', 4, '080176X4345', 5400000, 537, '2023-08-29', 'Waters', 'R2', 'P47', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-07', '2023-01-01', '2023-02-06', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7622', 'E7622', 4, '080167X4338', 7550000, 0, '2023-10-25', 'Waters', 'R1', 'P31', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-12-17', '2023-01-01', '2022-12-17', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7624', 'E7624', 4, '080167X4342', 5400000, 216, '2024-01-16', 'Waters', 'R2', 'P41', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-10', '2023-01-01', '2023-02-01', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7625', 'E7625', 4, '080167X4347', 5400000, 0, NULL, 'Waters', 'R3', 'P32', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-15', '2023-01-01', '2023-02-01', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7626', 'E7626', 4, '080167X4348', 5400000, 0, NULL, 'Waters', 'R3', 'P32', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-15', '2023-01-01', '2023-02-20', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7627', 'E7627', 4, '080167X4337', 5400000, 0, NULL, 'Waters', 'R3', 'P32', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-15', '2023-01-01', '2023-02-15', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7631', 'E7631', 1, '36BB02360', 13100000, 4138, '2023-11-29', 'Waters', 'R2', 'P42', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,3 m', 1, '3.00', '4.30', 'forklift.jpg', 'Y', '2022-12-29', '2023-01-01', '2022-12-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7632', 'E7632', 1, '36BB02341', 16600000, 0, NULL, 'Waters', 'R4', 'P19', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-06-23', '2023-07-01', '2023-06-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7641', 'E7641', 4, '080167X4344', 5400000, 162, '2023-08-29', 'Waters', 'R2', 'P47', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-22', '2023-01-01', '2023-02-25', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7642', 'E7642', 4, '080167X4346', 5400000, 736, '2023-11-29', 'Waters', 'R2', 'P42', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-02-22', '2023-01-01', '2023-02-25', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7646', 'E7646', 1, '36BB02732', 9900000, 1318, '2024-02-29', 'Waters', 'R3', 'P34', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD15', '1500', '1500', '3 Stage 4,7 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-02-27', '2023-01-01', '2023-02-27', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7647', 'E7647', 1, '36BB02295', 13130000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 4,7 Mtr', 1, '2.00', '4.70', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7648', 'E7648', 1, '36BB02361', 15800000, 1256, '2023-09-10', 'Waters', 'R3', 'P26', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 4,3 m', 1, '3.00', '4.30', 'forklift.jpg', 'Y', '2023-10-31', '2023-10-31', '2023-10-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7649', 'E7649', 1, '36BB01485', 11400000, 3868, '2024-03-18', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-03-11', '2023-01-01', '2023-03-13', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7650', 'E7650', 1, '36BB01486', 11400000, 3262, '2024-03-16', 'Waters', 'R3', 'P32', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,5 m', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-03-11', '2023-01-01', '2023-03-13', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7651', 'E7651', 1, '36BB02750', 13130000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 4,7 Mtr', 1, '2.00', '4.70', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7653', 'E7653', 4, '080167X4340', 5400000, 1003, '2023-09-12', 'Waters', 'R2', 'P43', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-03-01', '2023-01-01', '2023-02-28', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7654', 'E7654', 4, '080167X4341', 5400000, 1839, '2023-09-12', 'Waters', 'R2', 'P43', 'PALLET STACKER', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-03-01', '2023-01-01', '2023-02-28', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7659', 'E7659', 3, '08015JP5501', 4400000, 0, '2024-02-29', 'SN', 'West', 'P8', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD15J', '1500', '1500', '-', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2022-03-06', '2023-01-01', '2023-03-06', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7660', 'E7660', 2, '185F02991', 0, 0, '2024-02-07', 'BS', 'DHL', 'TXZ', 'REACH TRUCK', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', NULL, '3 Stage 7 m, Full free', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E7662', 'E7662', 4, '080167W0912', 5400000, 337, '2023-12-29', 'Waters', 'R2', 'P44', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CDD16-D930', '1600', '1600', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-03-14', '2023-01-01', '2023-03-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7682', 'E7682', 1, '36BB01509', 16000000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 4,5 Mtr', 1, '2.00', '4.50', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7683', 'E7683', 1, '36BB01510', 16000000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 4,5 Mtr', 1, '2.00', '4.50', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7684', 'E7684', 2, '185F03201', 16300000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT RT', 'TCM', 'Lithium', 'FRHB18-9LW', '1800', '1800', '7 Mtr 3 Stage', 1, '3.00', '7.00', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7685', 'E7685', 2, '185F03202', 16300000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT RT', 'TCM', 'Lithium', 'FRHB18-9LW', '1800', '1800', '7 Mtr 3 Stage', 1, '3.00', '7.00', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7686', 'E7686', 2, '185F-03195', 13300000, 1228, '2024-01-02', 'Waters', 'R1', 'P28', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', '1800', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-04-17', '2023-01-01', '2023-04-14', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7687', 'E7687', 1, '36BB02293', 11400000, 2094, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-03-31', '2023-01-01', '2023-04-03', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7688', 'E7688', 1, '36BB02751', 16000000, 1897, '2023-11-15', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 4,7 m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2022-12-22', '2023-01-01', '2022-12-19', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7689', 'E7689', 2, '185F-03194', 11700000, 196, '2023-07-15', 'Waters', 'R4', 'P38', 'FORKLIFT RT', 'TCM', '-', 'FRHB18-9LW', '1800', '1800', '3 Stage 7 m', 1, '3.00', '7.00', 'forklift.jpg', 'Y', '2023-03-31', '2023-01-01', '2023-04-03', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7693', 'E7693', 2, '185F03204', 16300000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT RT', 'TCM', 'Lithium', 'FRHB18-9LW', '1800', '1800', '7 Mtr 3 Stage', 1, '3.00', '7.00', 'forklift.jpg', 'Y', '2023-04-20', '2023-01-01', '2023-04-19', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7696', 'E7696', 1, '36BB02356', 13100000, 3161, '2023-11-25', 'Waters', 'R2', 'P40', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-04-05', '2023-01-01', '2023-04-04', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7697', 'E7697', 2, '185F-03197', 11700000, 309, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', '1800', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-04-10', '2023-01-01', '2023-04-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7698', 'E7698', 2, '185F-03198', 11700000, 978, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', '1800', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-04-10', '2023-01-01', '2023-04-10', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7703', 'E7703', 1, '36BB02747', 16000000, 1132, '2023-09-14', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2022-11-14', '2023-01-01', '2022-11-11', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7704', 'E7704', 1, '36BB02343', 15350000, 4720, '2023-09-10', 'Waters', 'R1', 'P30', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD30-XD4-SI26', '3000', '3000', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2022-10-24', '2023-01-01', '2022-10-24', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7705', 'E7705', 4, '23030710', 5100000, 0, '2024-02-29', 'SN', 'West', 'P8', 'STACKER', 'XILIN', 'ELECTRIC', 'CTD12R-E', '1200', '1200', '2,5 m', 1, '2.00', '2.50', 'forklift.jpg', 'Y', '2023-05-08', '2023-07-31', '2023-05-08', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7706', 'E7706', 4, '23030711', 5100000, 826, '2024-02-29', 'SN', 'West', 'P8', 'STACKER', 'XILIN', 'ELECTRIC', 'CTD12R-E', '1200', '1200', '2,5 m', 1, '2.00', '2.50', 'forklift.jpg', 'Y', '2023-05-08', '2023-07-31', '2023-05-08', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7707', 'E7707', 4, '23030712', 5100000, 0, '2024-02-29', 'SN', 'West', 'P8', 'STACKER', 'XILIN', 'ELECTRIC', 'CTD12R-E', '1200', '1200', '2,5 m', 1, '2.00', '2.50', 'forklift.jpg', 'Y', '2023-05-08', '2023-07-31', '2023-05-08', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7716', 'E7716', 3, '080307Y2221', 6500000, 797, '2023-09-04', 'SN', 'West', 'P3', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD30-460Li', '3000', '3000', 'Forks Length 1220 mm', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-05-22', '2023-01-01', '2023-05-22', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7717', 'E7717', 3, '080307Y2222', 6500000, 180, '2024-03-20', 'SN', 'East', 'P7', 'PALLET TRUCK', 'HELI', 'Electric', 'CBD30-460LI', '3000', '3000', NULL, 1, '0.00', '0.00', NULL, 'Y', '2023-05-28', '2023-01-01', '2023-05-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7718', 'E7718', 4, '080157Y2249', 5300000, 525, '2023-09-04', 'SN', 'West', 'P3', 'STACKER', 'HELI', 'ELECTRIC', 'CQDM15-810', '1500', '1500', 'Forks Length 1.070 mm', 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-05-22', '2023-01-01', '2023-05-22', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7721', 'E7721', 4, '080157Y2250', 9700000, 70, '2024-03-17', 'SN', 'East', 'P7', 'STACKER', 'HELI', 'Electric', 'CQDM15-810', '1500', '1500', NULL, 1, '2.00', '3.30', NULL, 'Y', '2023-05-28', '2023-01-01', '2023-05-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7725', 'E7725', 1, '36BB03446', 13130000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-23', '2023-01-01', '2023-06-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7726', 'E7726', 1, '36BB03454', 13130000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-23', '2023-01-01', '2023-06-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7727', 'E7727', 1, '36BB03455', 13130000, 0, '2023-09-27', 'Waters', 'R4', 'P39', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-23', '2023-01-01', '2023-06-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7728', 'E7728', 1, '36BB03457', 13800000, 285, '2023-12-07', 'Waters', 'R1', 'P29', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-09', '2023-01-01', '2023-06-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7729', 'E7729', 1, '36BB03458', 11400000, 3988, '2023-12-07', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-06', '2023-01-01', '2023-06-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7730', 'E7730', 1, '36BB03459', 11400000, 5080, '2024-01-15', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-06', '2023-01-01', '2023-06-09', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7731', 'E7731', 1, '36BB03461', 11400000, 1944, '2023-12-04', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-08-23', '2023-01-01', '2023-08-11', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7732', 'E7732', 1, '36BB03464', 11400000, 2189, '2023-12-04', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-06', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7733', 'E7733', 1, '36BB03447', 11400000, 3060, '2024-01-18', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-09', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7734', 'E7734', 1, '36BB03448', 11400000, 730, '2024-03-04', 'Waters', 'R2', 'P44', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-07', '2023-01-01', '2023-07-23', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7735', 'E7735', 1, '36BB03449', 11400000, 801, '2023-09-05', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-08', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7736', 'E7736', 1, '36BB03450', 11400000, 1156, '2023-11-08', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-07', '2023-01-01', '2023-06-23', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7737', 'E7737', 1, '36BB03451', 11400000, 1219, '2023-08-29', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-08', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7738', 'E7738', 1, '36BB03452', 11400000, 1232, '2023-10-06', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-13', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7739', 'E7739', 1, '36BB03453', 11400000, 1672, '2024-01-18', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-07', '2023-01-01', '2023-06-23', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7740', 'E7740', 1, '36BB03456', 11400000, 1340, '2023-11-27', 'Waters', 'R2', 'P43', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-08', '2023-01-01', '2023-06-23', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7741', 'E7741', 1, '36BB03460', 11400000, 924, '2023-09-07', 'Waters', 'R2', 'P47', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-13', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7742', 'E7742', 1, '36BB03462', 11400000, 1373, '2024-02-28', 'Waters', 'R2', 'P44', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-10', '2023-01-01', '2023-06-23', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7743', 'E7743', 1, '36BB03463', 11400000, 3760, '2024-01-16', 'Waters', 'R2', 'P41', 'FORKLIFT CB', 'HANGCHA', 'Lithium', 'CPD25-XD4-SI26', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-06-09', '2023-01-01', '2023-06-16', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7744', 'E7744', 1, '36BB03465', 12900000, 0, NULL, 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4-SI26', '2500', '2500', '0', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-01-11', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7761', 'E7761', 2, '185F-03207', 11700000, 5553, '2023-11-17', 'Waters', 'R2', 'P43', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', '1800', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-06-13', '2023-01-01', '2023-05-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7762', 'E7762', 2, '185F-03209', 12300000, 0, NULL, 'Waters', 'R2', 'P14', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', '1800', '3 Stage 6.3 m', 1, '3.00', '7.00', 'forklift.jpg', 'Y', '2023-09-08', '2023-09-08', '2023-06-15', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7763', 'E7763', 2, '185F-03206', 12300000, 545, '2023-12-13', 'Waters', 'R2', 'P11', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRHB18-9LW', '1800', '1800', '3 Stage 6 m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-08-03', '2023-08-03', '2023-08-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7802', 'E7802', 1, '36BB02748', 13800000, 264, '2023-09-19', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-S126', '1500', '1500', NULL, 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-08-05', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7805', 'E7805', 7, '10544795', 38200000, 2060, '2024-03-15', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095 S-32TT475', '1450', '1450', NULL, 1, '3.00', '12.00', NULL, 'Y', '2023-07-20', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7806', 'E7806', 7, '10544796', 38200000, 2217, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095 S-32TT475', '1450', '1450', NULL, 1, '3.00', '12.00', 'default.png', 'Y', '2023-07-20', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7807', 'E7807', 7, '10544797', 38200000, 2465, '2024-03-16', 'SN', 'East', 'P7', 'FORKLIFT RT', 'CROWN', 'Electric', 'RMD 6095 S-32TT475', '1450', '1450', NULL, 1, '3.00', '12.00', NULL, 'Y', '2023-07-20', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7823', 'E7823', 4, '080157Z0638', 6800000, 0, NULL, 'Waters', 'R4', 'P38', 'STACKER', 'HELI', 'ELECTRIC', 'CQDM', '0', '0', NULL, 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-08-05', '2023-01-01', '2023-06-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7824', 'E7824', 4, '080167Y2253', 6800000, 0, NULL, 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CDD', '0', '0', NULL, 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-08-05', '2023-01-01', '2023-06-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7833', 'E7833', 1, '05030DL3411', 15800000, 164, '2023-09-06', 'Waters', 'R2', 'P16', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-04', '2023-07-01', '2023-08-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7834', 'E7834', 1, '05030DL3412', 15800000, 0, NULL, 'Waters', 'R2', 'P16', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-04', '2023-07-01', '2023-08-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7835', 'E7835', 1, '05030DL3413', 15800000, 915, '2024-02-01', 'Waters', 'R2', 'P11', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-03', '2023-08-03', '2023-08-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7836', 'E7836', 1, '05030DL3414', 15800000, 649, '2023-12-13', 'Waters', 'R2', 'P11', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-03', '2023-08-03', '2023-08-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7837', 'E7837', 1, '05030DL3415', 15800000, 0, NULL, 'Waters', 'R2', 'P14', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-09-09', '2023-09-09', '2023-08-25', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7838', 'E7838', 1, '05030DL3416', 15800000, 0, NULL, 'Waters', 'R2', 'P15', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-09-12', '2023-09-12', '2023-08-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7839', 'E7839', 1, '05030DL3417', 15800000, 0, NULL, 'Waters', 'R2', 'P15', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-09-08', '2023-09-08', '2023-08-28', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7840', 'E7840', 1, '05030DL3418', 15800000, 0, NULL, 'Waters', 'R2', 'P16', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-04', '2023-07-31', '2023-08-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7841', 'E7841', 1, '05030DL3419', 15800000, 0, '2023-10-30', 'Waters', 'R2', 'P21', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-07', '2023-09-09', '2023-08-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7842', 'E7842', 1, '05030DL3420', 15800000, 449, '2023-12-14', 'Waters', 'R2', 'P14', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-09-09', '2023-09-09', '2023-08-25', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7843', 'E7843', 1, '05030DL3421', 15800000, 0, NULL, 'Waters', 'R2', 'P14', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-09-08', '2023-09-08', '2023-08-25', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7844', 'E7844', 1, '05030DL3422', 15800000, 0, '2023-10-30', 'Waters', 'R2', 'P21', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-07', '2023-09-09', '2023-08-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7845', 'E7845', 1, '05030DL3423', 15800000, 0, NULL, 'Waters', 'R2', 'P21', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-07', '2023-09-09', '2023-08-03', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7846', 'E7846', 1, '05030DL3424', 15800000, 0, NULL, 'Waters', 'R2', 'P16', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-04', '2023-07-31', '2023-08-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7847', 'E7847', 1, '05030DL3425', 15800000, 0, NULL, 'Waters', 'R2', 'P21', 'FORKLIFT CB', 'HELI', 'ELECTRIC', 'CPD30-GE2DLI', '3000', '3000', '3 Stage 4.5 m', 1, '3.00', '4.50', 'forklift.jpg', 'Y', '2023-08-07', '2023-09-09', '2023-08-02', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7852', 'E7852', 1, '36BB02749', 13800000, 322, '2023-09-14', 'Waters', 'R4', 'P38', 'FORKLIFT CB', 'HANGCHA', 'ELECTRIC', 'CPD25-XD4-SI26', '1500', '1500', NULL, 1, '0.00', '0.00', 'forklift.jpg', 'Y', '2023-08-05', '2023-01-01', '2023-09-30', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7859', 'E7859', 1, '257C02416', 13850000, 0, NULL, 'SN', 'West', 'P4', 'FORKLIFT CB', 'NICHIYU', 'ELECTRIC', 'FB25-77', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2022-08-16', '2023-08-16', '2023-08-16', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7896', 'E7896', 2, 'P21903M91788', 19900000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT RT', 'STILL', 'Electric', 'FM-X17', '1600', '1600', '', 1, '3.00', '10.50', '1698941818.png', 'Y', '2023-11-04', '2023-01-01', '2023-11-30', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7920', 'E7920', 2, 'P21903M92127', 19900000, 0, NULL, 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '3.00', '11.00', 'forklift.jpg', 'Y', '2023-11-04', '2023-01-01', '2024-05-29', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7926', 'E7926', 2, '185F03575', 12300000, 0, NULL, 'Waters', 'R2', 'P15', 'FORKLIFT RT', 'TCM', 'ELECTRIC', 'FRB18-9LW', '1800', '1800', '3 Stage 6m', 1, '3.00', '6.00', 'forklift.jpg', 'Y', '2023-10-27', '2023-10-27', '2024-08-31', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7962', 'E7962', 2, 'F5011537', 36900000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'JUNGHEINRICH', 'ELECTRIC', 'ETV MC320-1150-11510DZ', '2000', '2000', '3 Stage 11,5m', 1, '3.00', '11.50', 'default.png', 'Y', '2023-11-30', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7963', 'E7963', 2, 'F5011538', 36900000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'JUNGHEINRICH', 'ELECTRIC', 'ETV MC320-1150-11510DZ', '2000', '2000', '3 Stage 11,5m', 1, '3.00', '11.50', 'default.png', 'Y', '2023-11-30', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7964', 'E7964', 2, 'F5011539', 36900000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'JUNGHEINRICH', 'ELECTRIC', 'ETV MC320-1150-11510DZ', '2000', '2000', '3 Stage 11,5m', 1, '3.00', '11.50', 'default.png', 'Y', '2023-11-30', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7965', 'E7965', 2, 'F5011541', 36900000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'JUNGHEINRICH', 'ELECTRIC', 'ETV MC320-1150-11510DZ', '2000', '2000', '3 Stage 11,5m', 1, '3.00', '11.50', 'default.png', 'Y', '2023-11-30', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7966', 'E7966', 3, '080307AA245', 9500000, 0, NULL, 'SN', 'West', 'P3', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD30-460', '3000', '3000', 'Fork 685 x 2,250 mm', 1, '0.00', '0.00', 'default.png', 'Y', '2023-11-27', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7967', 'E7967', 3, '080307AA246', 9500000, 0, NULL, 'SN', 'West', 'P3', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD30-460', '3000', '3000', 'Fork 685 x 2,250 mm', 1, '0.00', '0.00', 'default.png', 'Y', '2023-11-27', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7968', 'E7968', 3, '080307AA247', 9500000, 0, NULL, 'SN', 'West', 'P3', 'PALLET TRUCK', 'HELI', 'ELECTRIC', 'CBD30-460', '3000', '3000', 'Fork 685 x 2,250 mm', 1, '0.00', '0.00', 'default.png', 'Y', '2023-11-27', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7969', 'E7969', 1, '30699', 16500000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', '2023-11-28', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7970', 'E7970', 1, '31630', 16500000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', '2023-11-28', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7971', 'E7971', 1, '31225', 16500000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT CB', 'TOYOTA', 'Electric', '8FBN25', '2500', '2500', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'default.png', 'Y', '2023-11-28', '2023-11-30', '2023-12-01', NULL, 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E7982', 'E7982', 2, 'P21904M93170', 25000000, 23220, '2023-09-04', 'SN', 'West', 'P3', 'FORKLIFT RT', 'STILL', 'Electric', 'FM-X20', '2000', '2000', '-', 1, '3.00', '13.00', 'forklift.jpg', 'Y', '2023-12-19', '2023-01-01', '2024-02-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7983', 'E7983', 2, 'P21904M93146', 25000000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'STILL', 'Electric', 'FM-X20', '2000', '2000', '-', 1, '3.00', '13.00', 'forklift.jpg', 'Y', '2023-12-19', '2023-01-01', '2024-02-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7984', 'E7984', 2, 'P21904M93142', 25000000, 0, NULL, 'SN', 'West', 'P3', 'FORKLIFT RT', 'STILL', 'Electric', 'FM-X20', '2000', '2000', '', 1, '3.00', '13.00', 'forklift.jpg', 'Y', '2023-12-19', '2023-01-01', '2024-02-29', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E7987', 'E7987', 5, '06016DM2471', 13100000, 208, '2024-03-17', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7988', 'E7988', 5, '06016DM3566', 13100000, 179, '2024-03-16', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7989', 'E7989', 5, '06016DM3567', 13100000, 193, '2024-03-17', 'SN', 'East', 'P7', '-', '-', '-', '-', '1600', '1600', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7990', 'E7990', 5, '06016DM3568', 13100000, 223, '2024-03-16', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7991', 'E7991', 5, '06016DM3569', 13100000, 232, '2024-03-16', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7992', 'E7992', 5, '06016DM3570', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7993', 'E7993', 5, '06016DM3571', 13100000, 182, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7994', 'E7994', 5, '06016DM3572', 13100000, 131, '2024-03-17', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7995', 'E7995', 5, '06016DM3573', 13100000, 61, '2024-03-17', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7996', 'E7996', 5, '06016DM3574', 13100000, 10, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E7997', 'E7997', 5, '06016DM3575', 13100000, 26, '2024-03-14', 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4,7 Mtr', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2023-12-24', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8000', 'E8000', 1, '36BC02524', 11300000, 261, '2024-02-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4SI26', '2500', '2500', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-01-05', '2023-07-31', '2023-12-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E8010', 'E8010', 1, 'FDZN25-40643', 6250000, 0, NULL, 'SJ1', 'STSJ1', 'SB1', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', 'FDZN25', '2500', NULL, '-', 1, '2.00', '5.00', 'default.png', 'Y', '2020-01-01', '2020-01-01', '2020-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E8011', 'E8012', 1, '36BC02518', 9800000, 463, '2024-02-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4SI26', '1500', '1500', '-', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2024-01-05', '2023-07-31', '2023-12-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E8012', 'E8013', 1, '36BC02519', 9800000, 446, '2024-02-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD15-XD4SI26', '1500', '1500', '2 Stage 3 m', 1, '3.00', '4.70', 'forklift.jpg', 'Y', '2024-01-05', '2023-07-31', '2023-12-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E8013', 'E8013', 1, '36BC02530', 11300000, 389, '2024-02-27', 'SN', 'West', 'P9', 'FORKLIFT CB', 'HANGCHA', 'Electric', 'CPD25-XD4SI26', '2500', '2500', '-', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-01-05', '2023-07-31', '2023-12-31', NULL, 'Y', 'B', 'Y', 'Y', 'LATE'),
('E8055', 'E8055', 1, 'FDZN30-42233', 0, 0, NULL, 'BS', 'DHL', 'TIM', 'FORKLIFT CB', 'TOYOTA', 'DIESEL', 'FDZN30', '3000', NULL, '2 Stage 3m', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8060', 'E8060', 2, '185F-03984', 0, 0, NULL, 'BS', 'DHL', 'SUB', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW20-85', '2000', NULL, '3 Stage 6 m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8061', 'E8061', 2, '185F-03988', 0, 0, NULL, 'BS', 'DHL', 'KXZ', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW18-85', '1800', NULL, '3 Stage 6 m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8062', 'E8062', 2, '185F-03813', 9875000, 0, NULL, 'BS', 'DHL', 'BQZ', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW20-85', '2000', NULL, '3 Stage 6,5m', 1, '3.00', '6.50', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8063', 'E8063', 2, '185F-03793', 0, 0, NULL, 'BS', 'DHL', 'KXZ', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW18-85', '1800', NULL, '3 Stage 6m', 1, '3.00', '6.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8064', 'E8064', 2, '185F-03698', 12950000, 0, NULL, 'BS', 'DHL', 'BPN', 'REACH TRUCK', 'NICHIYU', 'ELECTRIC', 'FBRW25-85', '2500', NULL, '3 Stage 7 m', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL);
INSERT INTO `unit` (`kdunit`, `namaunit`, `idforklifttype`, `serialnumber`, `price`, `hm`, `tanggal`, `idcbu`, `idregion`, `idsitename`, `equipment`, `merk`, `model`, `type`, `capcity`, `capcity2`, `specification`, `qty`, `mast`, `masheight`, `foto`, `showcustomer`, `dateactual`, `daterequest`, `dateestimated`, `reason`, `flag_aktif`, `flag_baru`, `flag_target`, `flag_actual`, `flag_otif`) VALUES
('E8069', 'E8069', 2, '185F-03506', 8950000, 0, '2024-02-23', 'BS', 'DHL', 'BPN', 'REACH TRUCK', 'CATERPILLAR', 'ELECTRIC', 'NRS15CB', '1500', NULL, '3 Stage 7m', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8070', 'E8070', 2, '185F-03508', 0, 0, NULL, 'BS', 'DHL', 'UPG', 'REACH TRUCK', 'CATERPILLAR', 'ELECTRIC', 'NRS15CB', '1500', NULL, '3 Stage 7m', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8075', 'E8075', 2, '185F-03512', 0, 0, NULL, 'BS', 'DHL', 'SRG', 'REACH TRUCK', 'CATERPILLAR', 'ELECTRIC', 'NRS25CB', '2500', NULL, '3 Stage 7m', 1, '3.00', '7.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8077', 'E8077', 5, '06016DM5549', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4.7 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-02-02', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8078', 'E8078', 5, '06016DM5550', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4.7 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-02-02', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8079', 'E8079', 5, '06016DM5551', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4.7 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-02-02', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8080', 'E8080', 5, '06016DM5552', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4.7 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-02-02', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8081', 'E8081', 5, '06016DM5553', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4.7 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-02-02', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8082', 'E8082', 5, '06016DM5554', 13100000, 0, NULL, 'SN', 'East', 'P7', 'FORKLIFT CB', 'HELI', 'Electric', 'CPD16SQ', '1600', '1600', '3 Stage 4.7 m', 1, '2.00', '3.00', 'forklift.jpg', 'Y', '2024-02-02', '2023-01-01', '2023-12-31', NULL, 'N', 'B', 'N', 'Y', 'LATE'),
('E8092', 'E8092', 1, '257D02123', 9450000, 0, NULL, 'BS', 'DHL', 'BTH', 'FORKLIFT CB', 'TCM', 'ELECTRIC', 'FB25-9', '2500', NULL, '3 Stage 4,7m', 1, '3.00', '4.70', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('E8111', 'E8111', 1, '185F-03795', 12000000, 0, NULL, 'SJ1', 'STSJ1', 'SMN1', 'FORKLIFT CB', 'NICHIYU', 'ELECTRIC', 'FBRW18-85', '1800', NULL, '-', 1, '3.00', '7.00', 'default.png', 'Y', '2024-01-01', '2024-01-01', '2024-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('E8112', 'E8112', 1, '185F-03863', 13300000, 0, NULL, 'SJ1', 'STSJ1', 'SMN1', 'FORKLIFT CB', 'NICHIYU', 'ELECTRIC', 'FBRW18-85', '1800', NULL, '-', 1, '3.00', '6.00', 'default.png', 'Y', '2024-01-01', '2024-01-01', '2024-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF'),
('FRI-289', 'FRI-289', 1, '20511', 0, 0, NULL, 'SUZUKI', 'P49', 'DM', 'FORKLIFT CB', 'TOYOTA', 'ELECTRIC', '8FBN25', '2500', NULL, '2 Stage 3 m', 1, '2.00', '3.00', 'default.png', 'Y', NULL, NULL, NULL, NULL, 'Y', 'B', NULL, 'Y', NULL),
('kdunit', 'namaunit', 0, 'serialnumber', 0, 0, '0000-00-00', 'idcbu', 'idregion', 'idsitename', 'equipment', 'merk', 'model', 'type', '0', '0', 'specification', 0, '0.00', '0.00', 'foto', 's', '0000-00-00', '0000-00-00', '0000-00-00', 'reason', 'f', 'f', 'f', 'f', 'flag_otif'),
('XT0219', 'XT0219', 12, 'XT0219', 250000, 0, NULL, 'SJ1', 'STSJ1', 'SM1', 'ATTACHMENT', 'SPP', 'XT0219', 'EXTENTION FORK', '2500', NULL, '-', 1, '0.00', '0.00', 'default.png', 'Y', '2019-01-01', '2019-01-01', '2019-01-01', '-', 'Y', 'B', 'Y', 'Y', 'OTIF');

-- --------------------------------------------------------

--
-- Table structure for table `unitactual`
--

DROP TABLE IF EXISTS `unitactual`;
CREATE TABLE IF NOT EXISTS `unitactual` (
  `kdunit` varchar(20) NOT NULL,
  `showunit` varchar(2) NOT NULL,
  `dateactual` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unithapus`
--

DROP TABLE IF EXISTS `unithapus`;
CREATE TABLE IF NOT EXISTS `unithapus` (
  `id` int(11) NOT NULL DEFAULT 0,
  `idcbu` varchar(11) DEFAULT NULL,
  `idregion` varchar(11) DEFAULT NULL,
  `idsitename` varchar(11) DEFAULT NULL,
  `periode` varchar(7) DEFAULT NULL,
  `kdunit` varchar(20) DEFAULT NULL,
  `harikerja` int(11) DEFAULT NULL,
  `planunitkerja` int(11) DEFAULT NULL,
  `totalbreakdown` int(11) DEFAULT 0,
  `totalbackup` int(11) DEFAULT 0,
  `totaljamkerja` int(11) DEFAULT 0,
  `paforklift` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unitout`
--

DROP TABLE IF EXISTS `unitout`;
CREATE TABLE IF NOT EXISTS `unitout` (
  `kdunit` varchar(20) NOT NULL,
  `kdunit2` varchar(20) NOT NULL,
  `dateout` date NOT NULL,
  `idcbu` varchar(10) DEFAULT NULL,
  `idregion` varchar(10) DEFAULT NULL,
  `idsitename` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`kdunit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles_id` int(2) NOT NULL,
  `access_token` text DEFAULT NULL,
  `idsitename` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdcustomer` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `roles_id` (`roles_id`),
  KEY `idsitename` (`idsitename`)
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `roles_id`, `access_token`, `idsitename`, `kdcustomer`, `created_at`, `updated_at`) VALUES
(155, 'Bayu Purbawanto', 'bayu.p@satriapiranti.co.id', '$2y$10$HWxN1c/j4mlRePJWR1b/hOQZAH79rDwO3TkMqgY0tFRJG17cyDBR6', 1, NULL, '999', 'SPP', '2023-07-05 17:26:05', '2023-07-05 17:26:05'),
(156, 'Mujiono', 'muji.satriapirantiperkasa@gmail.com', '$2y$10$MayAbuOhM2z4/PVhAp0lweQEBIKFV7z5ftKD7V6Kt8bdceE1bVrMe', 1, NULL, '999', 'SPP', '2023-07-05 17:28:45', '2023-11-02 12:27:22'),
(163, 'Irfan Agussandi', 'irfan.agussandi@satriapiranti.co.id', '$2y$10$RjZguAzo9I1A2xWRdQ4B6ehsoqAdvnnN3gHmE.KTGgd/D1HdmpNL6', 1, NULL, '999', 'SPP', '2023-07-07 06:45:44', '2023-07-11 12:00:00'),
(164, 'Dimas Albert', 'dimas-albert@satriapiranti.com', '$2y$10$M80UDwBdXBl0GJFhv17vp.IuoLSub5biIkNgz37puImc6TY7M8lK2', 1, NULL, '999', 'SPP', '2023-07-07 07:03:02', '2023-07-07 07:03:02'),
(165, 'Ajat Agustina', 'ajat.agustina@satriapiranti.co.id', '$2y$10$MjXMKEFysSpfzF8I4uiGAepkL2zj2s1yasi731y1Dk.naA21vDXri', 1, NULL, 'JDC', 'SPP', '2023-07-07 07:03:54', '2024-04-20 08:08:04'),
(166, 'Panji Kusuma', 'sales@satriapiranti.co.id', '$2y$10$w9zjQ.Q0nREaRd5M.DL8E.SLECKCv9hS8vTTE0eDnOuokCooa22SO', 1, NULL, '999', 'SPP', '2023-07-07 07:09:26', '2023-07-07 07:09:26'),
(176, 'Anisa', 'anisa.spp@gmail.com', '$2y$10$Z8QHUXiH/Aqf8SrpPELwCuGAuftQ7U84Qtp05Nho/qXJMNh1qU.0S', 1, NULL, '999', 'SPP', '2023-07-26 08:45:07', '2023-07-26 08:45:07'),
(226, 'abc', 'abc@gmail.com', '$2y$10$bxLTh3Puv0eYI7ScGaaBdO7yO0RQ..fE9vv4KhX/PxXAhfPVIsla2', 5, NULL, '1005', 'ABC', '2023-10-07 07:22:26', '2023-10-07 07:22:26'),
(304, 'Admin', 'admin@gmail.com', '$2y$10$fWTV6C9DEbNqlybXyXw9Q..W6wAe3Sorvrg7b0/kSQjDp.CSuUb.C', 1, NULL, '1005', 'SPP', '2023-10-07 07:22:26', '2023-10-07 07:22:26'),
(305, 'Arief Zunaidi', 'arief.zunaidi@dhl.com', '$2y$10$5sIEkxTnP19QKxXIwxNNvuvDFILxARhnnWynraEXRzIHo97qWQ9B6', 4, NULL, 'BPN', 'DHL', '2024-03-21 04:32:39', '2024-03-21 04:32:39'),
(306, 'Widhya Sari', 'widhya.sari@dhl.com', '$2y$10$nA8OXZeBiPt5eHlxLvBadeSoGOgs4fu.CMU31j07Nh5btYqU9RoF6', 4, NULL, 'BTH', 'DHL', '2024-03-21 04:38:00', '2024-03-21 04:38:00'),
(307, 'Andika Purnama', 'andika.purnama@dhl.com', '$2y$10$aNUF.gbFhEJeWhwxVLPcf.//WwjMMfLG.BKK0MQ2n5CkBWb2JpZ/6', 4, NULL, 'BQZ', 'DHL', '2024-03-21 04:41:40', '2024-03-21 04:41:40'),
(308, 'Jesse Valentino', 'jesse.valentino@dhl.com', '$2y$10$qgEhAdD1OYpExm2HCPCBk.INkjTMXA8K/0AXauFQsHB2Ett05qYoq', 5, NULL, 'JDC', 'DHL', '2024-03-21 05:17:49', '2024-03-21 05:17:49'),
(309, 'Chairun Rezki', 'chairun.rezki@dhl.com', '$2y$10$AOMIKbTGZDApAcDQDyksK.3H55P0h.FgFzm/jZ70gGfBjIsZ76AaO', 4, NULL, 'DPS', 'DHL', '2024-03-21 05:18:43', '2024-03-21 05:18:43'),
(310, 'Indra Sukmono', 'indra.sukmono@dhl.com', '$2y$10$kff8CbuOEyqY2DezPRn5cuQVtL2yDDYGT/JCiLNVVfzB2NcZcv20y', 4, NULL, 'JDC', 'DHL', '2024-03-21 05:19:48', '2024-03-21 05:19:48'),
(311, 'Ikhsan Tahir', 'ikhsan.tahir@dhl.com', '$2y$10$W1bXCcY6qoBlMsM6ZGZYFurcJs6BEMXYYuMW07kaw0lJ0H4UgPkI2', 4, NULL, 'UPG', 'DHL', '2024-03-21 05:20:43', '2024-03-21 05:20:43'),
(312, 'Paskah Kurniawan', 'paskah.kurniawan@dhl.com', '$2y$10$PZubZCAH1rctzgCPvNCCSOpOREJTqIdm/BsxgVUZgWKO51dkYkdam', 4, NULL, 'GTW', 'DHL', '2024-03-21 05:21:34', '2024-03-21 05:21:34'),
(313, 'Paskah Kurniawan', 'paskah.kurniawan2@dhl.com', '$2y$10$ePuNXReZNSgtOME9hqgE7uom5dFZVEsZMSWCeZ9sJ4nqFnVIZMCbG', 4, NULL, 'NEM', 'DHL', '2024-03-21 05:22:15', '2024-03-21 05:22:15'),
(314, 'Amirah Madilao', 'amirah.a.madilao@dhl.com', '$2y$10$scAOW/AIhObM/jk09pgfjuOGU4yJZOHjigIzLsNFFAK8.zWOm6286', 4, NULL, 'KXZ', 'DHL', '2024-03-21 05:23:26', '2024-03-21 05:23:26'),
(315, 'Gitra Hendrawan', 'gitra.hendrawan@dhl.com', '$2y$10$w8WVyN6Zk5N90//9FSf/wuPc32db3ttuSojYNhBMvjAAJKz9ukOzO', 4, NULL, 'SRG', 'DHL', '2024-03-21 05:24:12', '2024-03-21 05:24:12'),
(316, 'Nani Kusuma', 'nani.kusuma@dhl.com', '$2y$10$VAlExQeLoaJP8OLyw3bple9EGdKDiVVdGHTm.X1H5tTcNo51n6xB2', 4, NULL, 'SOC', 'DHL', '2024-03-21 05:33:15', '2024-04-02 01:37:36'),
(317, 'Yungki Alhamdi', 'yungki.alhamdi@dhl.com', '$2y$10$2wf9FDQbHjyAjh5YJcmSaOe5tXhVBrw0ThSNOqq5wR/xnTuVbp5ju', 4, NULL, 'SUB', 'DHL', '2024-03-21 05:34:10', '2024-03-21 05:34:10'),
(318, 'Ika Radita', 'ika.radita@dhl.com', '$2y$10$o2HCcdZwj2GCOdThz1UoIe6V486fLU3SYWlvpa4cXOeq7jYWww0DG', 4, NULL, 'TXZ', 'DHL', '2024-03-21 05:34:46', '2024-03-21 05:34:46'),
(319, 'Farobi Bilhaq', 'farobi.bilhaq@dhl.com', '$2y$10$8IFf/VHaR1C5NBgvyQdKOuWZ7bJZytgn14LvbUdUByhc6ow/m1QAu', 4, NULL, 'TIM', 'DHL', '2024-03-21 05:35:30', '2024-03-21 05:35:30'),
(320, 'Mitra 10 Solo', 'mitra10solo@gmail.com', '$2y$10$ftgDeh5nQolQTTl7nEM2euhzKRieiA.DvZSBLIfqdCEjY5uNIDoEa', 3, NULL, 'SM1', 'SPP', '2024-03-28 03:00:29', '2024-03-28 03:00:29'),
(321, 'Mitra 10 Jogja', 'mitra10jogja@gmail.com', '$2y$10$r7eBjDvB5ozInh8DVmPX4umnD7v6MBqDNB0SSk62sCLSLRmjGsAEq', 3, NULL, 'SM2', 'SPP', '2024-03-28 03:01:48', '2024-03-28 03:01:48'),
(322, 'Pt. Schenker Petrolog Utama Solo', 'paramasolo@gmail.com', '$2y$10$/ConUFOSadhznTMCcx5oS.9I.ct6Ss8/I3.1z6iH4dsx/er4kIrsW', 3, NULL, 'SPG1', 'SPP', '2024-03-28 03:08:21', '2024-03-28 03:08:21'),
(323, 'Pt Parama Global Inspira Jogja', 'paramajogja@gmail.com', '$2y$10$z1NTKPZjkkdNTgxBvbkH3uSI2tyuVPHIXDRTrt1MmD7dKqgDi2bZe', 3, NULL, 'SPG2', 'SPP', '2024-03-28 03:09:27', '2024-03-28 03:09:27'),
(324, 'Bukitmega Massabadi Solo', 'bukitmegasolo@gmail.com', '$2y$10$1xWLyjM7P8u66/jC2mTr9urxVPxAFyB193nqHajxbEby6g1ECSTI2', 3, NULL, 'SB1', 'SPP', '2024-03-28 03:15:22', '2024-03-28 03:15:22'),
(325, 'Sinarmas Distribusi Nusantara Solo', 'sdnsolo@gmail.com', '$2y$10$/V6syRKsrnGzz2K2HdFj4.GQsSM/VB4FdmleiupLoe1XDWwF.n3vG', 3, NULL, 'SS1', 'SPP', '2024-03-28 03:33:29', '2024-03-28 03:33:29'),
(326, 'Pt Tigaraksa Satria Cangkringan', 'trscangkringan@gmail.com', '$2y$10$Oi9rr4j22UyrugJ9KyZobeZ2WshwV6XttnNrW8e7jdSs9iVf1nUhO', 3, NULL, 'ST2', 'SPP', '2024-03-28 03:34:38', '2024-03-28 03:34:38'),
(327, 'Pt Macrosentra Niagaboga', 'cimoryjogja@gmail.com', '$2y$10$Y.lACT7Fm7sD9/l0KNG/HeJqjmEprWyNKyXqO/gMorDYhVBrlvGOq', 3, NULL, 'SMN1', 'SPP', '2024-03-28 03:36:59', '2024-03-28 03:36:59'),
(328, 'Demo Website', 'demodhl@gmail.com', '$2y$10$iRjyvtfMzwWS7GRN3.7cMegKfUoM2a2bsntV.02mYX/SFKEkWepii', 5, NULL, 'JDC', 'DHL', '2024-04-02 01:41:26', '2024-04-20 02:17:57'),
(329, 'Dhl Purwakarta', 'purwakarta@dhl.com', '$2y$10$XMNJ8VG7cC/1/eXy2R/oAeLTiWEEViAXwQAuOaPcx./Pax9WUrJRK', 4, NULL, 'DHL1', 'DHL', '2024-04-02 13:09:53', '2024-04-02 13:09:53'),
(330, 'Abdurrohman', 'dhlcengkareng@gmail.com', '$2y$10$27eTXVRVm85ZbCCSh70a.uIpBo3PfBwvsx91PJJILJOIKtQDvMvhG', 3, NULL, 'JDC', 'DHL', '2024-04-03 01:44:51', '2024-04-03 01:44:51'),
(331, 'Faisal', 'dhlcikokol@gmail.com', '$2y$10$TRu53xztgrKIr58uQX3uk.nA6NFq7/1ZCBLYDEytk3VQPJLnjpxAq', 3, NULL, 'TXZ', 'DHL', '2024-04-03 03:38:24', '2024-04-03 03:38:24'),
(332, 'Indra Noor', 'indra.noor@puninar.com', '$2y$10$m0Tp6tORXuZM9XVGio9aQ.u0atGvUVVMdVffSZfn8Rs78zDhnjSEW', 4, NULL, 'LOC1', 'PUNINAR', '2024-04-03 03:44:14', '2024-04-04 04:03:35'),
(333, 'M Subeki', 'puninarshell@gmail.com', '$2y$10$Xbda21Vvp9ZFZjI6c8hbO.SvIg3eZ7cNfOtK4087K/ssW.orW316i', 3, NULL, 'LOC1', 'PUNINAR', '2024-04-03 03:53:31', '2024-04-03 03:53:31'),
(334, 'Surya Ambrullah', 'dhlbalikpapan@gmail.com', '$2y$10$PjWy0RxmQgSKT9DAqf44oemTwZgR3yRs65D08VEdm32ftYyA3wpEm', 3, NULL, 'BPN', 'DHL', '2024-04-03 04:04:06', '2024-04-03 04:04:06'),
(335, 'Endi Suhendi', 'puninarnagrak@gmail.com', '$2y$10$QNIa7ASTBH5vSZOoznCOm.JIO79TViWandSPyuJ2C0HIzA1jFE8Za', 3, NULL, 'PIRS3', 'PUNINAR', '2024-04-03 04:17:23', '2024-04-03 04:19:49'),
(336, 'Sopiandi', 'dhlmedan@gmail.com', '$2y$10$dYl.KylWEQtpIpAYA.LNT.aqMyMFzw3Hj4wLLjrKkHOE/s1AUP60a', 3, NULL, 'GTW', 'DHL', '2024-04-03 14:54:56', '2024-04-03 14:54:56'),
(337, 'Bambang Wahyu', 'bambang.wahyu@puninar.com', '$2y$10$P7v49.ehs5GS8/gmPFe4FeCZrxnk.sLcuCF7tzRk2m1x1IMrNThbq', 4, NULL, 'LOC2', 'PUNINAR', '2024-04-04 04:04:32', '2024-04-04 04:04:32'),
(338, 'Mahastra Gita', 'mahastra.gita@puninar.com', '$2y$10$Qs.deeCwRpwqMNBcVznIXO36yxKiKEwcCR5dYNaO3MefCASOLduCO', 4, NULL, 'LOC1', 'PUNINAR', '2024-04-04 04:05:46', '2024-04-04 04:05:46'),
(339, 'Hendra Sudrajat', 'hendra.sudrajat@puninar.com', '$2y$10$6pYrwC5bgKZ/XBqnfNCoSe30rt5ca4Ib8SG1QWy9U/LGGFi7GsjxG', 4, NULL, 'LOC1', 'PUNINAR', '2024-04-04 04:06:40', '2024-04-04 04:06:40'),
(340, 'Sugeng', 'dhlpurwakarta@gmail.com', '$2y$10$dJr2WwWkukmBtoCYzTvUrueRXwpt6K4MgNJbIzy9ZNrrg6Xu4A7Ti', 3, NULL, 'DHL1', 'DHL', '2024-04-05 09:25:21', '2024-04-05 09:25:21'),
(341, 'Nani Kusuma', 'nani.kusuma@dhl.co.id', '$2y$10$qe.KxRuMHD3tLYipiei/x.3aGJAnkhsu7lLq.T3GUzwhmPu06ZRc6', 4, NULL, 'SOC', 'DHL', '2024-04-06 01:50:09', '2024-04-06 01:50:09'),
(342, 'Agus Supriyanto', 'dhlsolo@gmail.com', '$2y$10$4h0NdDxNmBH8330bYl.n/OLCK4zCRPEd/jm3PcoM69TrV3NN.XF62', 3, NULL, 'SOC', 'DHL', '2024-04-18 09:58:08', '2024-04-18 09:58:08'),
(343, 'Surya Ambrullah', 'surya.ambrullah@gmail.com', '$2y$10$CK58z4uwup943zMCtJ8z8.SQD1pUUorc8tqWopLXRrcfjDw.a0MaK', 1, NULL, 'BPN', 'DHL', '2024-04-20 04:52:17', '2024-04-20 04:52:17');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`idsitename`) REFERENCES `sitename` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenanceaction`
--
ALTER TABLE `maintenanceaction`
  ADD CONSTRAINT `maintenanceaction_ibfk_1` FOREIGN KEY (`kdunit`) REFERENCES `unit` (`kdunit`) ON UPDATE CASCADE;

--
-- Constraints for table `mekanik`
--
ALTER TABLE `mekanik`
  ADD CONSTRAINT `mekanik_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `physicalavailable`
--
ALTER TABLE `physicalavailable`
  ADD CONSTRAINT `physicalavailable_ibfk_1` FOREIGN KEY (`kdunit`) REFERENCES `unit` (`kdunit`) ON UPDATE CASCADE;

--
-- Constraints for table `troubleaction`
--
ALTER TABLE `troubleaction`
  ADD CONSTRAINT `troubleaction_ibfk_1` FOREIGN KEY (`kdunit`) REFERENCES `unit` (`kdunit`) ON UPDATE CASCADE;

--
-- Constraints for table `unit`
--
ALTER TABLE `unit`
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`idsitename`) REFERENCES `sitename` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`idsitename`) REFERENCES `sitename` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
