-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 12:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prakom_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Userid` int(20) NOT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `UserPassword` varchar(35) NOT NULL,
  `UserLevel` enum('ADM','PTG','PMJ') NOT NULL,
  `UserFullName` varchar(30) NOT NULL,
  `UserContact` varchar(30) DEFAULT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserAddress` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Userid`, `Username`, `UserPassword`, `UserLevel`, `UserFullName`, `UserContact`, `UserEmail`, `UserAddress`) VALUES
(1, 'Redprix', 'rectangle', 'ADM', 'CodenameRedprix', '558792449378', 'zzranchlmao@gmail.com', 'Some Random City'),
(2, 'razan', 'salmon', 'PMJ', 'razan syaputraa', NULL, 'razy@gmail.com', 'grijak'),
(200, NULL, 'salmon', 'PMJ', 'becker claire', NULL, 'ebb@gmail.com', NULL),
(201, NULL, '123', 'PTG', 'Febri Aldrea', NULL, 'FebbAldre@gmail.com', NULL),
(202, NULL, '123', 'PTG', 'wildan kholid', NULL, 'wingladang@gmail.com', NULL),
(203, NULL, '123', 'PMJ', 'Anggoro jati praukom', NULL, 'anggora@gmail.com', NULL),
(204, NULL, '123', 'PMJ', 'Joshua ransha', NULL, 'joshrand@gmail.com', NULL),
(205, NULL, '123', 'PMJ', 'zarya mobes', NULL, 'wwparrot@gmail.com', NULL),
(206, NULL, '123', 'PMJ', 'rick henry', NULL, 'henry11@gmail.com', NULL),
(207, NULL, '123', 'PMJ', 'figo alghifari', NULL, 'figoo9@gmail.com', NULL),
(208, NULL, '123', 'PMJ', 'Weedy vereena', NULL, 'Weedy09@gmail.com', NULL),
(209, NULL, '123', 'PMJ', 'kardelia pesk', NULL, 'kardelxd@gmail.com', NULL),
(210, NULL, '123', 'PMJ', 'bimba raksa', NULL, 'bbmba@gmail.com', NULL),
(211, NULL, '123', 'PMJ', 'jordi tackhe', NULL, 'jordqwer@gmail.com', NULL),
(212, NULL, '123', 'PMJ', 'Surya riki maulana ibrahim', NULL, 'Kitsuu@gmail.com', NULL),
(213, NULL, '123', 'PMJ', 'David reksana', NULL, 'davtech@review.com', NULL),
(214, NULL, '123', 'PMJ', 'David maulana ibrahim', NULL, 'maulanafamily@gmail.com', NULL),
(215, NULL, '123', 'PMJ', 'zerry robsthe', NULL, 'zzzzerry@gmail.com', NULL),
(217, NULL, '123', 'PMJ', 'salmonella', NULL, 'salmon@fish.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Userid`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Userid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
