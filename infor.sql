-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 04:50 PM
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
-- Table structure for table `classallo`
--

CREATE TABLE `classallo` (
  `Department` varchar(4) NOT NULL,
  `Semester` int(11) NOT NULL,
  `Section` varchar(1) NOT NULL,
  `TeachersAllo` tinyint(1) NOT NULL DEFAULT 0,
  `PEAllo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classallo`
--

INSERT INTO `classallo` (`Department`, `Semester`, `Section`, `TeachersAllo`, `PEAllo`) VALUES
('CSE', 4, 'A', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gpa`
--

CREATE TABLE `gpa` (
  `USN` varchar(10) NOT NULL,
  `Sem` int(11) NOT NULL,
  `Tgradept` int(11) NOT NULL,
  `SGPA` float NOT NULL,
  `CGPA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gpa`
--

INSERT INTO `gpa` (`USN`, `Sem`, `Tgradept`, `SGPA`, `CGPA`) VALUES
('1NT19CS106', 1, 56, 8, 2),
('1NT19CS106', 2, 79, 8.7778, 4.19445),
('1NT19CS106', 3, 24, 8, 6.19445),
('1NT19CS106', 4, 182, 8.6667, 8.36112);

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
  `MSE1` int(11) DEFAULT 0,
  `MSE2` int(11) DEFAULT 0,
  `MSE3` int(11) DEFAULT 0,
  `LA1` int(11) DEFAULT 0,
  `LA2` int(11) DEFAULT 0,
  `CIE` int(11) NOT NULL DEFAULT 0,
  `SEE_Grade` int(11) DEFAULT 0,
  `Gradept` int(11) NOT NULL DEFAULT 0,
  `traverse` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`USN`, `Sem`, `SubID`, `credit`, `Subname`, `MSE1`, `MSE2`, `MSE3`, `LA1`, `LA2`, `CIE`, `SEE_Grade`, `Gradept`, `traverse`) VALUES
('1NT19CS106', 4, '18MAT41', 4, 'Engineering Mathematics –IV', 18, 27, 25, 10, 9, 45, 9, 36, 1),
('1NT19CS106', 4, '18CS42', 3, 'Design and Analysis of Algorithms', 21, 21, 26, 10, 10, 44, 8, 24, 2),
('1NT19CS106', 4, '18CS43', 3, 'Database Management Systems', 28, 28, 28, 10, 8, 46, 10, 30, 3),
('1NT19CS106', 4, '18CS44', 4, 'Operating Systems', 15, 18, 22, 8, 9, 37, 7, 28, 4),
('1NT19CS106', 3, '18CS33', 3, 'Data Structures', 21, 27, 15, 10, 10, 44, 8, 24, 1),
('1NT19CS106', 1, '18MAT11', 4, 'ENGINEERING\r\nMATHEMATICS-I', 28, 25, 20, 7, 8, 42, 8, 32, 1),
('1NT19CS106', 2, '18MAT21', 4, 'ENGINEERING MATHEMATICS-I', 15, 18, 22, 8, 10, 38, 8, 32, 1),
('1NT19CS106', 2, '18CHE22', 3, 'ENGINEERING CHEMISTRY', 26, 26, 21, 10, 9, 45, 9, 27, 2),
('1NT19CS106', 2, '18CP23', 2, 'C- PROGRAMMING- II', 29, 29, 25, 10, 10, 49, 10, 20, 3),
('1NT19CS106', 1, '18PHY22', 3, 'ENGINEERING PHYSICS ', 22, 25, 0, 10, 9, 43, 8, 24, 2),
('1NT19CS106', 4, '18CS45', 4, 'APPLICATION DEVELOPMENT USING JAVA', 30, 0, 22, 9, 8, 45, 8, 40, 5),
('1NT19CS148', 4, '18CS46', 4, 'APPLICATION DEVELOPMENT USING JAVA', 30, 30, 30, 10, 10, 0, 10, 0, NULL),
('1NT19CS106', 4, '18CSE462', 3, 'WEB APPLICATION DEVELOPMENT', 24, 30, 25, 8, 9, 45, 8, 24, 6),
('1NT19CS107', 4, '18CS45', 4, 'APPLICATION DEVELOPMENT USING JAVA', 28, 29, 0, 10, 6, 0, 10, 0, NULL);

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
('1nt19cs106.mahima@nmit.ac.in', '1nt19cs106', '1NT19CS106', NULL, 'Mahima M', 'CSE', 4, 'B'),
('jagadevi.n.kalshetty@nmit.ac.in', 'jagadevi@nmit', NULL, 'CS030', 'Jagadevi N Kalshetty', 'CSE', NULL, NULL),
('1nt19cs148.rahul@nmit.ac.in ', '1nt19cs148', '1NT19CS148', NULL, 'Rahul Kumar', 'CSE', 4, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `SubName` varchar(50) NOT NULL,
  `SubID` varchar(15) NOT NULL,
  `HoursPerWeek` smallint(6) NOT NULL,
  `Department` varchar(4) NOT NULL,
  `Semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SubName`, `SubID`, `HoursPerWeek`, `Department`, `Semester`) VALUES
('Design and Analysis of Algorithms', '18CS42', 3, 'CSE', 4),
('Data Base Management Systems', '18CS43', 3, 'CSE', 4),
('Operating System', '18CS44', 4, 'CSE', 4),
('Application Development Using Java', '18CS45', 4, 'CSE', 4),
('Introduction to Embedded Systems', '18CSE461', 3, 'CSE', 4),
('Introduction to Web Application Development', '18CSE462', 3, 'CSE', 4),
('Unix System Programming', '18CSE463', 3, 'CSE', 4),
('Introduction to Image Processing', '18CSE464', 3, 'CSE', 4),
('DBMS Lab', '18CSL47', 2, 'CSE', 4),
('Design and Analysis of Algorithms Lab', '18CSL48', 2, 'CSE', 4),
('Engineering Mathematics - IV', '18MAT41', 5, 'Math', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subteach`
--

CREATE TABLE `subteach` (
  `SubID` varchar(15) NOT NULL,
  `TeachID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subteach`
--

INSERT INTO `subteach` (`SubID`, `TeachID`) VALUES
('18CS43', 'CS001'),
('18CS42', 'CS008'),
('18CSL47', 'CS001'),
('18CSL47', 'CS014'),
('18CSL48', 'CS008'),
('18MAT41', 'MAT009'),
('18CSE461', 'CS016'),
('18CSE464', 'CS023'),
('18CSE462', 'CS018'),
('18CS44', 'CS011'),
('18CSE463', 'CS019'),
('18CS42', 'CS024'),
('18CS43', 'CS025'),
('18CS44', 'CS027'),
('18CS45', 'CS028'),
('18CSL47', 'CS018'),
('18CSL47', 'CS027'),
('18CSL47', 'CS029'),
('18CSE462', 'CS030'),
('18MAT41', 'CS032'),
('18CS42', 'CS019'),
('18CS43', 'CS033'),
('18CS44', 'CS0033'),
('18CS45', 'CS034'),
('18CSL47', 'CS024'),
('18CSL47', 'CS0033'),
('18CSL48', 'CS019'),
('18CSL48', 'CS035'),
('18CS45', 'CS012'),
('18CSL48', 'CS012');

-- --------------------------------------------------------

--
-- Table structure for table `teacherallo`
--

CREATE TABLE `teacherallo` (
  `TeachID` varchar(20) NOT NULL,
  `SubID` varchar(15) NOT NULL,
  `Department` varchar(4) NOT NULL,
  `Sem` int(11) NOT NULL,
  `Section` varchar(1) NOT NULL,
  `Batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacherallo`
--

INSERT INTO `teacherallo` (`TeachID`, `SubID`, `Department`, `Sem`, `Section`, `Batch`) VALUES
('CS030', '18CSE462', 'CSE', 4, 'B', 0),
('CS030', '18CSE462', 'CSE', 4, 'A', 0),
('CS030', '18CSL48', 'CSE', 4, 'C', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TeachName` varchar(25) NOT NULL,
  `TeachID` varchar(20) NOT NULL,
  `Department` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeachName`, `TeachID`, `Department`) VALUES
('Mamatha Bai G', 'CS001', 'CSE'),
('Deepthi Shetty', 'CS0033', 'CSE'),
('Sujata Joshi', 'CS008', 'CSE'),
('Vasanth', 'CS011', ''),
('Ramyashree', 'CS012', 'CSE'),
('Chaitra H V', 'CS014', 'CSE'),
('Chethan D Chahwan', 'CS016', 'CSE'),
('Uma R', 'CS018', 'CSE'),
('Kavya B S', 'CS019', 'CSE'),
('Shilpa', 'CS023', 'CSE'),
('Ramya S', 'CS024', 'CSE'),
('Asha H V', 'CS025', 'CSE'),
('Mahadevi', 'CS027', 'CSE'),
('Mohan', 'CS028', 'CSE'),
('Bhuvaneshwari', 'CS029', 'CSE'),
('Jagadevi', 'CS030', 'CSE'),
('Pramod S', 'CS032', 'CSE'),
('Supriya', 'CS033', 'CSE'),
('Shobha', 'CS034', 'CSE'),
('Vinay T R', 'CS035', 'CSE'),
('Dr Chandrakala ', 'MAT009', 'Math');

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

CREATE TABLE `timeslots` (
  `TeachID` varchar(20) NOT NULL,
  `SubID` varchar(15) NOT NULL,
  `Hour` int(11) NOT NULL,
  `Day` int(11) NOT NULL,
  `Department` varchar(4) NOT NULL,
  `Semester` int(11) NOT NULL,
  `Section` varchar(1) NOT NULL,
  `Batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SubID`);

--
-- Indexes for table `subteach`
--
ALTER TABLE `subteach`
  ADD KEY `SubID` (`SubID`),
  ADD KEY `TeachID` (`TeachID`);

--
-- Indexes for table `teacherallo`
--
ALTER TABLE `teacherallo`
  ADD KEY `SubID` (`SubID`),
  ADD KEY `TeachID` (`TeachID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeachID`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD KEY `SubID` (`SubID`),
  ADD KEY `TeachID` (`TeachID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subteach`
--
ALTER TABLE `subteach`
  ADD CONSTRAINT `subteach_ibfk_1` FOREIGN KEY (`SubID`) REFERENCES `subjects` (`SubID`),
  ADD CONSTRAINT `subteach_ibfk_2` FOREIGN KEY (`TeachID`) REFERENCES `teachers` (`TeachID`);

--
-- Constraints for table `teacherallo`
--
ALTER TABLE `teacherallo`
  ADD CONSTRAINT `teacherallo_ibfk_1` FOREIGN KEY (`SubID`) REFERENCES `subjects` (`SubID`),
  ADD CONSTRAINT `teacherallo_ibfk_2` FOREIGN KEY (`TeachID`) REFERENCES `teachers` (`TeachID`);

--
-- Constraints for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD CONSTRAINT `timeslots_ibfk_1` FOREIGN KEY (`SubID`) REFERENCES `subjects` (`SubID`),
  ADD CONSTRAINT `timeslots_ibfk_2` FOREIGN KEY (`TeachID`) REFERENCES `teachers` (`TeachID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
