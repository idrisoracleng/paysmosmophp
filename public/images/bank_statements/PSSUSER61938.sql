-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 09:54 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydc`
--

-- --------------------------------------------------------

--
-- Table structure for table `disciplinary_cases`
--

CREATE TABLE `disciplinary_cases` (
  `id` int(11) NOT NULL,
  `offender` varchar(255) NOT NULL,
  `offence` varchar(255) NOT NULL,
  `penalty` varchar(255) NOT NULL,
  `officer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disciplinary_cases`
--

INSERT INTO `disciplinary_cases` (`id`, `offender`, `offence`, `penalty`, `officer`) VALUES
(1, '247', 'None', 'None', 'Akeem Oladipupo'),
(2, 'Select Name of Offender', '', '', 'Select Officer Name');

-- --------------------------------------------------------

--
-- Table structure for table `dutypositions`
--

CREATE TABLE `dutypositions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `side` varchar(255) NOT NULL,
  `added _by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dutypositions`
--

INSERT INTO `dutypositions` (`id`, `name`, `side`, `added _by`) VALUES
(8, 'field', 'brothers', '');

-- --------------------------------------------------------

--
-- Table structure for table `scanned`
--

CREATE TABLE `scanned` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `ptime_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ptime_out` timestamp NOT NULL DEFAULT current_timestamp(),
  `vtime_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vtime_out` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `id` int(11) NOT NULL,
  `pid` int(255) NOT NULL,
  `duty` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `clock_in` time NOT NULL,
  `clock_out` time NOT NULL,
  `daily_report` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `securityreport`
--

CREATE TABLE `securityreport` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `brothersScanned_in` varchar(100) NOT NULL,
  `sistersScanned_in` varchar(100) NOT NULL,
  `totalScanned_in` varchar(100) NOT NULL,
  `brothesrScanned_out` varchar(100) NOT NULL,
  `sistersScanned_out` varchar(100) NOT NULL,
  `totalScanned_out` varchar(100) NOT NULL,
  `b_personnel_clocked_in` varchar(100) NOT NULL,
  `s_personnel_clocked_in` varchar(100) NOT NULL,
  `t_personnel_clocked_in` varchar(100) NOT NULL,
  `disciplinary_cases` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `vehicleType` varchar(55) NOT NULL,
  `vehicleColour` varchar(55) NOT NULL,
  `plateNumber` varchar(10) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `pid`, `vehicleType`, `vehicleColour`, `plateNumber`, `date`) VALUES
(1, 1, 'benz car', 'white', 'lsd234an', '0000-00-00'),
(2, 1, 'volvo', 'white', 'krd123gh', '0000-00-00'),
(3, 2, 'benz', 'red', 'jjj624hd', '0000-00-00'),
(4, 0, '', '', '', '0000-00-00'),
(5, 0, '', '', '', '0000-00-00'),
(6, 0, '', '', '', '0000-00-00'),
(7, 0, '', '', '', '0000-00-00'),
(8, 1, 'BMW', 'white', 'lsd234an', '0000-00-00'),
(9, 1, 'audi', 'white', 'lsd234an', '0000-00-00'),
(10, 536, 'latest ford IA', 'black ', 'TOYKAM', '0000-00-00'),
(11, 166, 'benz', 'white', '1LA3', '0000-00-00'),
(12, 582, 'volvo suv', 'purple', 'JAMBITO', '0000-00-00'),
(13, 0, '', '', '', '0000-00-00'),
(14, 0, '', '', '', '0000-00-00'),
(15, 0, '', '', '', '0000-00-00'),
(16, 0, '', '', '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disciplinary_cases`
--
ALTER TABLE `disciplinary_cases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dutypositions`
--
ALTER TABLE `dutypositions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scanned`
--
ALTER TABLE `scanned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `securityreport`
--
ALTER TABLE `securityreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disciplinary_cases`
--
ALTER TABLE `disciplinary_cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dutypositions`
--
ALTER TABLE `dutypositions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `scanned`
--
ALTER TABLE `scanned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `securityreport`
--
ALTER TABLE `securityreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
