-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2021 at 09:24 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infor`
--

-- --------------------------------------------------------

--
-- Table structure for table `gpa`
--

CREATE TABLE `gpa` (
  `USN` varchar(10) NOT NULL,
  `Sem` int(11) NOT NULL,
  `Tgradept` int(11) NOT NULL,
  `SGPA` int(11) NOT NULL,
  `CGPA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `USN` varchar(10) NOT NULL,
  `Sem` int(11) NOT NULL,
  `SubID` varchar(10) NOT NULL,
  `credit` int(11) NOT NULL,
  `Subname` text NOT NULL,
  `MSE1` int(11) DEFAULT NULL,
  `MSE2` int(11) DEFAULT NULL,
  `MSE3` int(11) DEFAULT NULL,
  `LA1` int(11) DEFAULT NULL,
  `LA2` int(11) DEFAULT NULL,
  `CIE` int(11) NOT NULL,
  `SEE_Grade` int(11) DEFAULT NULL,
  `Gradept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`USN`, `Sem`, `SubID`, `credit`, `Subname`, `MSE1`, `MSE2`, `MSE3`, `LA1`, `LA2`, `CIE`, `SEE_Grade`, `Gradept`) VALUES
('1NT19CS106', 4, '18MAT41', 4, 'Engineering Mathematics –IV', 18, 27, 25, 10, 9, 64, 9, 36);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `email` varchar(70) NOT NULL,
  `password` varchar(25) NOT NULL,
  `USN` varchar(10) DEFAULT NULL,
  `TeachID` varchar(10) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Dept` varchar(20) NOT NULL,
  `Sem` int(11) DEFAULT NULL,
  `Sec` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`email`, `password`, `USN`, `TeachID`, `Name`, `Dept`, `Sem`, `Sec`) VALUES
('1nt19cs106.mahima@nmit.ac.in', '1nt19cs106', '1NT19CS106', NULL, 'Mahima M', 'CSE', 4, 'B');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
