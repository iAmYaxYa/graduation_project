-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 04:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al_furaat`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `AttendanceNo` int(11) NOT NULL,
  `Student` int(11) NOT NULL,
  `Class` int(11) NOT NULL,
  `Teacher` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `Season` varchar(50) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Taked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `AttendanceNo`, `Student`, `Class`, `Teacher`, `Status`, `Season`, `Date`, `Taked`) VALUES
(1, 1689290774, 1, 1, 2, 1, '1', '2023-07-14', 1),
(2, 1689290774, 2, 1, 2, 1, '1', '2023-07-14', 1),
(3, 1689290774, 3, 1, 2, 0, '1', '2023-07-14', 1),
(4, 1689290774, 4, 1, 2, 1, '1', '2023-07-14', 1),
(5, 1689290899, 5, 2, 2, 1, '1', '2023-07-14', 1),
(6, 1689290899, 6, 2, 2, 1, '1', '2023-07-14', 1),
(7, 1689290899, 7, 2, 2, 0, '1', '2023-07-14', 1),
(8, 1689290899, 8, 2, 2, 1, '1', '2023-07-14', 1),
(9, 1689293009, 5, 5, 2, 1, '1', '2023-07-14', 1),
(10, 1689293009, 6, 5, 2, 1, '1', '2023-07-14', 1),
(11, 1689293009, 7, 5, 2, 1, '1', '2023-07-14', 1),
(12, 1689293009, 8, 5, 2, 1, '1', '2023-07-14', 1),
(13, 1689293779, 1, 2, 2, 1, '2', '2023-07-14', 1),
(14, 1689293779, 2, 2, 2, 1, '2', '2023-07-14', 1),
(15, 1689293779, 3, 2, 2, 0, '2', '2023-07-14', 1),
(16, 1689293779, 4, 2, 2, 1, '2', '2023-07-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Acc_No` int(11) NOT NULL,
  `Balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`ID`, `Name`, `Acc_No`, `Balance`) VALUES
(1, 'salaam bank', 829833, '94.00'),
(2, 'registration fee', 617938245, '20.00'),
(3, 'examination fee', 682136261, '34.00');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Section` int(11) NOT NULL,
  `Shift` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ID`, `Name`, `Section`, `Shift`) VALUES
(1, 'class one (1aad)', 1, 2),
(2, 'class two (2aad)', 1, 2),
(3, 'class five (5aad)', 3, 2),
(4, 'form one (10aad)', 2, 1),
(5, 'class three (3aad)', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `ID` int(11) NOT NULL,
  `Class` int(11) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Course` int(11) NOT NULL,
  `TimeStart` time NOT NULL,
  `TimeEnd` time NOT NULL,
  `Season` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `Name`, `Class`) VALUES
(1, 'Af-somali 1aad', 1),
(2, 'Biology 10aad', 4),
(3, 'xisaab 1aad', 1),
(4, 'english 2aad', 2),
(5, 'arabic 2aad', 2),
(6, 'xisaab 2aad', 2),
(7, 'arabic 3aad', 5),
(8, 'xisaab 3aad', 5);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `User` tinyint(1) NOT NULL DEFAULT 0,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `JobTitle` varchar(50) NOT NULL,
  `Photo` text NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `Salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `FullName`, `Address`, `User`, `Phone`, `Email`, `Gender`, `JobTitle`, `Photo`, `Date`, `Status`, `Salary`) VALUES
(1, 'Yaxye Ciise Maxamed', 'W.nabada', 1, '343434', 'cali@gmail.com', 'male', 'super admin', '972132384.jpg', '2023-01-22', 1, '300.00'),
(2, 'cali jamac xuseen', 'hodan', 1, '52345234', 'abgroup@gmail.com', 'male', 'admin', '1742994929.jpg', '2023-06-12', 0, '200.00'),
(3, 'daahir cali xasan', 'hodan', 1, '5345345', 'abgroup@gmail.com', 'male', 'admin', '1588788631.jpg', '2023-07-02', 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`ID`, `Name`) VALUES
(1, 'monthly one'),
(2, 'midteram exam'),
(3, 'monthly two'),
(4, 'final exam');

-- --------------------------------------------------------

--
-- Table structure for table `exam_grade`
--

CREATE TABLE `exam_grade` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `GradePoint` varchar(10) NOT NULL,
  `percentageFrom` int(11) NOT NULL,
  `percentageUpto` int(11) NOT NULL,
  `Comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_grade`
--

INSERT INTO `exam_grade` (`ID`, `Name`, `GradePoint`, `percentageFrom`, `percentageUpto`, `Comment`) VALUES
(1, 'A+', '4.00', 95, 100, 'good result'),
(2, 'B+', '3.65', 90, 95, 'good result'),
(3, 'A', '3.65', 85, 90, 'nice result'),
(4, 'B', '3.50', 80, 85, 'wake up');

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `ID` int(11) NOT NULL,
  `ExamNo` int(11) NOT NULL,
  `Student` int(11) NOT NULL,
  `Class` int(11) NOT NULL,
  `Course` int(11) NOT NULL,
  `Marks` int(11) NOT NULL DEFAULT 0,
  `Exam` int(11) NOT NULL,
  `Teacher` int(11) NOT NULL,
  `Season` int(11) NOT NULL,
  `Submited` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_marks`
--

INSERT INTO `exam_marks` (`ID`, `ExamNo`, `Student`, `Class`, `Course`, `Marks`, `Exam`, `Teacher`, `Season`, `Submited`) VALUES
(1, 1689291010, 1, 1, 1, 10, 1, 2, 1, 1),
(2, 1689291010, 2, 1, 1, 12, 1, 2, 1, 1),
(3, 1689291010, 3, 1, 1, 15, 1, 2, 1, 1),
(4, 1689291010, 4, 1, 1, 12, 1, 2, 1, 1),
(5, 1689291061, 1, 1, 3, 15, 1, 2, 1, 1),
(6, 1689291061, 2, 1, 3, 11, 1, 2, 1, 1),
(7, 1689291061, 3, 1, 3, 12, 1, 2, 1, 1),
(8, 1689291061, 4, 1, 3, 14, 1, 2, 1, 1),
(9, 1689291085, 5, 2, 4, 15, 1, 2, 1, 1),
(10, 1689291085, 6, 2, 4, 11, 1, 2, 1, 1),
(11, 1689291085, 7, 2, 4, 14, 1, 2, 1, 1),
(12, 1689291085, 8, 2, 4, 13, 1, 2, 1, 1),
(13, 1689291118, 5, 2, 5, 15, 1, 2, 1, 1),
(14, 1689291118, 6, 2, 5, 7, 1, 2, 1, 1),
(15, 1689291118, 7, 2, 5, 10, 1, 2, 1, 1),
(16, 1689291118, 8, 2, 5, 13, 1, 2, 1, 1),
(17, 1689291155, 5, 2, 6, 15, 1, 2, 1, 1),
(18, 1689291155, 6, 2, 6, 11, 1, 2, 1, 1),
(19, 1689291155, 7, 2, 6, 15, 1, 2, 1, 1),
(20, 1689291155, 8, 2, 6, 12, 1, 2, 1, 1),
(21, 1689291993, 5, 2, 4, 25, 2, 2, 1, 1),
(22, 1689291993, 6, 2, 4, 22, 2, 2, 1, 1),
(23, 1689291993, 7, 2, 4, 23, 2, 2, 1, 1),
(24, 1689291993, 8, 2, 4, 18, 2, 2, 1, 1),
(25, 1689292011, 5, 2, 5, 25, 2, 2, 1, 1),
(26, 1689292011, 6, 2, 5, 20, 2, 2, 1, 1),
(27, 1689292011, 7, 2, 5, 22, 2, 2, 1, 1),
(28, 1689292011, 8, 2, 5, 24, 2, 2, 1, 1),
(29, 1689292051, 5, 2, 6, 25, 2, 2, 1, 1),
(30, 1689292051, 6, 2, 6, 20, 2, 2, 1, 1),
(31, 1689292051, 7, 2, 6, 22, 2, 2, 1, 1),
(32, 1689292051, 8, 2, 6, 24, 2, 2, 1, 1),
(33, 1689292600, 5, 2, 4, 15, 3, 2, 1, 1),
(34, 1689292600, 6, 2, 4, 11, 3, 2, 1, 1),
(35, 1689292600, 7, 2, 4, 10, 3, 2, 1, 1),
(36, 1689292600, 8, 2, 4, 13, 3, 2, 1, 1),
(37, 1689292620, 5, 2, 5, 15, 3, 2, 1, 1),
(38, 1689292620, 6, 2, 5, 12, 3, 2, 1, 1),
(39, 1689292620, 7, 2, 5, 12, 3, 2, 1, 1),
(40, 1689292620, 8, 2, 5, 11, 3, 2, 1, 1),
(41, 1689292644, 5, 2, 6, 15, 3, 2, 1, 1),
(42, 1689292644, 6, 2, 6, 11, 3, 2, 1, 1),
(43, 1689292644, 7, 2, 6, 10, 3, 2, 1, 1),
(44, 1689292644, 8, 2, 6, 8, 3, 2, 1, 1),
(45, 1689292665, 5, 2, 4, 45, 4, 2, 1, 1),
(46, 1689292665, 6, 2, 4, 40, 4, 2, 1, 1),
(47, 1689292665, 7, 2, 4, 43, 4, 2, 1, 1),
(48, 1689292665, 8, 2, 4, 44, 4, 2, 1, 1),
(49, 1689292707, 5, 2, 5, 45, 4, 2, 1, 1),
(50, 1689292707, 6, 2, 5, 44, 4, 2, 1, 1),
(51, 1689292707, 7, 2, 5, 41, 4, 2, 1, 1),
(52, 1689292707, 8, 2, 5, 44, 4, 2, 1, 1),
(53, 1689292732, 5, 2, 6, 45, 4, 2, 1, 1),
(54, 1689292732, 6, 2, 6, 44, 4, 2, 1, 1),
(55, 1689292732, 7, 2, 6, 40, 4, 2, 1, 1),
(56, 1689292732, 8, 2, 6, 41, 4, 2, 1, 1),
(57, 1689293033, 1, 1, 1, 25, 2, 2, 1, 1),
(58, 1689293033, 2, 1, 1, 22, 2, 2, 1, 1),
(59, 1689293033, 3, 1, 1, 20, 2, 2, 1, 1),
(60, 1689293033, 4, 1, 1, 21, 2, 2, 1, 1),
(61, 1689293050, 1, 1, 3, 22, 2, 2, 1, 1),
(62, 1689293050, 2, 1, 3, 20, 2, 2, 1, 1),
(63, 1689293050, 3, 1, 3, 21, 2, 2, 1, 1),
(64, 1689293050, 4, 1, 3, 25, 2, 2, 1, 1),
(65, 1689293107, 1, 1, 1, 14, 3, 2, 1, 1),
(66, 1689293107, 2, 1, 1, 11, 3, 2, 1, 1),
(67, 1689293107, 3, 1, 1, 14, 3, 2, 1, 1),
(68, 1689293107, 4, 1, 1, 15, 3, 2, 1, 1),
(69, 1689293125, 1, 1, 3, 15, 3, 2, 1, 1),
(70, 1689293125, 2, 1, 3, 10, 3, 2, 1, 1),
(71, 1689293125, 3, 1, 3, 11, 3, 2, 1, 1),
(72, 1689293125, 4, 1, 3, 15, 3, 2, 1, 1),
(73, 1689293144, 1, 1, 1, 45, 4, 2, 1, 1),
(74, 1689293144, 2, 1, 1, 44, 4, 2, 1, 1),
(75, 1689293144, 3, 1, 1, 33, 4, 2, 1, 1),
(76, 1689293144, 4, 1, 1, 40, 4, 2, 1, 1),
(77, 1689293335, 1, 1, 3, 45, 4, 2, 1, 1),
(78, 1689293335, 2, 1, 3, 44, 4, 2, 1, 1),
(79, 1689293335, 3, 1, 3, 40, 4, 2, 1, 1),
(80, 1689293335, 4, 1, 3, 43, 4, 2, 1, 1),
(81, 1689297227, 5, 5, 7, 13, 1, 2, 2, 1),
(82, 1689297227, 6, 5, 7, 15, 1, 2, 2, 1),
(83, 1689297227, 7, 5, 7, 14, 1, 2, 2, 1),
(84, 1689297227, 8, 5, 7, 11, 1, 2, 2, 1),
(85, 1689297245, 5, 5, 8, 15, 1, 2, 2, 1),
(86, 1689297245, 6, 5, 8, 11, 1, 2, 2, 1),
(87, 1689297245, 7, 5, 8, 14, 1, 2, 2, 1),
(88, 1689297245, 8, 5, 8, 11, 1, 2, 2, 1),
(89, 1689297317, 5, 5, 7, 25, 2, 2, 2, 1),
(90, 1689297317, 6, 5, 7, 22, 2, 2, 2, 1),
(91, 1689297317, 7, 5, 7, 23, 2, 2, 2, 1),
(92, 1689297317, 8, 5, 7, 20, 2, 2, 2, 1),
(93, 1689297507, 5, 5, 8, 24, 2, 2, 2, 1),
(94, 1689297507, 6, 5, 8, 22, 2, 2, 2, 1),
(95, 1689297507, 7, 5, 8, 20, 2, 2, 2, 1),
(96, 1689297507, 8, 5, 8, 19, 2, 2, 2, 1),
(97, 1689297546, 1, 2, 4, 14, 1, 2, 2, 1),
(98, 1689297546, 2, 2, 4, 12, 1, 2, 2, 1),
(99, 1689297546, 3, 2, 4, 12, 1, 2, 2, 1),
(100, 1689297546, 4, 2, 4, 11, 1, 2, 2, 1),
(101, 1689297564, 1, 2, 4, 20, 2, 2, 2, 1),
(102, 1689297564, 2, 2, 4, 22, 2, 2, 2, 1),
(103, 1689297564, 3, 2, 4, 25, 2, 2, 2, 1),
(104, 1689297564, 4, 2, 4, 20, 2, 2, 2, 1),
(105, 1689297586, 1, 2, 5, 15, 1, 2, 2, 1),
(106, 1689297586, 2, 2, 5, 12, 1, 2, 2, 1),
(107, 1689297586, 3, 2, 5, 11, 1, 2, 2, 1),
(108, 1689297586, 4, 2, 5, 13, 1, 2, 2, 1),
(109, 1689297603, 1, 2, 5, 24, 2, 2, 2, 1),
(110, 1689297603, 2, 2, 5, 22, 2, 2, 2, 1),
(111, 1689297603, 3, 2, 5, 25, 2, 2, 2, 1),
(112, 1689297603, 4, 2, 5, 20, 2, 2, 2, 1),
(113, 1689297621, 1, 2, 6, 13, 1, 2, 2, 1),
(114, 1689297621, 2, 2, 6, 12, 1, 2, 2, 1),
(115, 1689297621, 3, 2, 6, 14, 1, 2, 2, 1),
(116, 1689297621, 4, 2, 6, 15, 1, 2, 2, 1),
(117, 1689297637, 1, 2, 6, 25, 2, 2, 2, 1),
(118, 1689297637, 2, 2, 6, 22, 2, 2, 2, 1),
(119, 1689297637, 3, 2, 6, 20, 2, 2, 2, 1),
(120, 1689297637, 4, 2, 6, 22, 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_result`
--

CREATE TABLE `exam_result` (
  `ID` int(11) NOT NULL,
  `Student` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Grade` varchar(5) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Class` int(11) NOT NULL,
  `Season` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedule`
--

CREATE TABLE `exam_schedule` (
  `ID` int(11) NOT NULL,
  `Exam` int(11) NOT NULL,
  `Class` int(11) NOT NULL,
  `Course` int(11) NOT NULL,
  `Date` date NOT NULL,
  `TimeStart` time NOT NULL,
  `TimeEnd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `InvoiceNo` int(11) NOT NULL,
  `Invoice` int(11) NOT NULL,
  `Student` int(11) NOT NULL,
  `Class` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `Account` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Month` date NOT NULL,
  `Season` int(11) NOT NULL,
  `Phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`ID`, `InvoiceNo`, `Invoice`, `Student`, `Class`, `User`, `Amount`, `Account`, `Status`, `Date`, `Month`, `Season`, `Phone`) VALUES
(1, 1689290959, 1, 5, 2, 1, '10', 2, 1, '2023-07-14', '2023-02-14', 1, '53454353'),
(2, 1689298657, 2, 1, 2, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(3, 1689298657, 2, 2, 2, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(4, 1689298657, 2, 3, 2, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(5, 1689298657, 2, 4, 2, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(6, 1689298657, 2, 5, 5, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(7, 1689298657, 2, 6, 5, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(8, 1689298657, 2, 7, 5, 1, '3', 3, 0, '2023-07-14', '2023-02-14', 2, ''),
(9, 1689298657, 2, 8, 5, 1, '3', 3, 1, '2023-07-14', '2023-02-14', 2, '5435345');

--
-- Triggers `invoices`
--
DELIMITER $$
CREATE TRIGGER `update_bank_balance` AFTER UPDATE ON `invoices` FOR EACH ROW BEGIN
UPDATE bank SET Balance = Balance + new.Amount WHERE ID = new.Account;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_category`
--

CREATE TABLE `invoice_category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Method` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_category`
--

INSERT INTO `invoice_category` (`ID`, `Name`, `Method`, `Price`) VALUES
(1, 'registration fee', 1, '10'),
(2, 'examination fee', 2, '3'),
(3, 'tuition fee', 2, '18');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `ID` int(11) NOT NULL,
  `text` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `Role` varchar(50) NOT NULL DEFAULT 'users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`ID`, `text`, `icon`, `link`, `Role`) VALUES
(1, 'dashboard', 'bx bxs-dashboard', 'index', 'users'),
(2, 'employees', 'fa fa-users', 'Employees', 'users'),
(3, 'users', 'fa-solid fa-user-group', 'Users', 'users'),
(4, 'shifts', 'bx bxs-time-five', 'Shifts', 'users'),
(5, 'sections', 'bx bx-server', 'Sections', 'users'),
(6, 'classes', 'fa-solid fa-chalkboard-user', 'Classes', 'users'),
(7, 'teachers', 'bx bxl-microsoft-teams', 'Teachers', 'users'),
(8, 'courses', 'bx bxs-book', 'Courses', 'users'),
(9, 'parents', 'fa-solid fa-people-roof', 'Parents', 'users'),
(10, 'students', 'fa-solid fa-person', 'Students', 'users'),
(11, 'student dashboard', 'bx bxs-dashboard', 'StudentDashboard', 'students'),
(12, 'parent dashboard', 'bx bxs-dashboard', 'ParentDashboard', 'parents'),
(13, 'attendance', 'bx bxs-calendar-check', 'Attendance', 'users'),
(14, 'exam', 'bx bx-qr', 'Exam', 'users'),
(15, 'exam schedule', 'bx bxs-copy-alt', 'ExamSchedule', 'users'),
(16, 'exam grade', 'bx bxs-bar-chart-alt-2', 'ExamGrades', 'users'),
(17, 'accounts', 'fa-solid fa-building-columns', 'Accounts', 'users'),
(18, 'exam marks', 'bx bx-scatter-chart', 'ExamMarks', 'users'),
(19, 'finance', 'bx bx-coin-stack', 'Invoices', 'users'),
(20, 'invoice category', 'fa-solid fa-file-invoice', 'InvoiceCategories', 'users'),
(21, 'student promotion', 'fa-solid fa-solid fa-graduation-cap', 'StudentPromotions', 'users'),
(22, 'classes schedule', 'bx bxs-notepad', 'ClassSchedule', 'users'),
(23, 'seasons', 'fa-solid fa-tree', 'Seasons', 'users'),
(24, 'attendance report', 'bx bx-notepad', 'AttendanceReport', 'users'),
(26, 'finance report', 'bx bx-line-chart', 'FinanceReport', 'users');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Occubation` varchar(50) NOT NULL,
  `Photo` text NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Privileges` varchar(50) NOT NULL DEFAULT '12',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`ID`, `FullName`, `Address`, `Phone`, `Email`, `Occubation`, `Photo`, `UserName`, `Password`, `Gender`, `Status`, `Privileges`, `Date`) VALUES
(1, 'xuseen abshir cali', 'wadajir', '5435445', 'abgroup@gmail.com', 'wardiye', '', 'P118070', '583744', 'male', 1, '12', '2023-07-02'),
(2, 'null', 'null', '0', 'null@gmail.com', 'null', '', 'P800611', '587354', 'male', 1, '12', '2023-07-02'),
(3, 'cali jamac xuseen', 'hodan', '534345', 'abgroup@gmail.com', 'wardiye', '', 'P21228', '120551', 'male', 1, '12', '2023-07-14'),
(4, 'xaashi maxamed cali', 'wadajir', '5345435', 'abgroup@gmail.com', 'bussines manager', '', 'P24137', '597270', 'male', 1, '12', '2023-07-14'),
(5, 'sahro cabdi dahir', 'hilwaa', '534534543', 'abgroup@gmail.com', 'bussines manager', '', 'P16850', '535171', 'female', 1, '12', '2023-07-14'),
(6, 'cali cartan suleyma', 'wadajir', '5345345', 'abgroup@gmail.com', 'wardiye', '', 'P10130', '912443', 'male', 1, '12', '2023-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`ID`, `Name`, `Status`) VALUES
(1, '2022-2023', 0),
(2, '2023-2024', 1),
(3, '2024-2025', 0),
(4, '2025-2026', 0);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`ID`, `Name`) VALUES
(1, 'primary'),
(2, 'secondary'),
(3, 'middle');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `DateBegin` time NOT NULL,
  `DateEnd` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`ID`, `Name`, `DateBegin`, `DateEnd`) VALUES
(1, 'morning', '07:00:00', '12:30:00'),
(2, 'afternoon', '12:30:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Class` int(11) NOT NULL,
  `Parent` int(11) NOT NULL,
  `Photo` text NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Privileges` varchar(50) NOT NULL DEFAULT '11',
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `FullName`, `Address`, `Phone`, `Class`, `Parent`, `Photo`, `Gender`, `DOB`, `Status`, `UserName`, `Password`, `Privileges`, `Date`) VALUES
(1, 'cumar cali cartan', 'hodan', '5453', 2, 1, '', 'male', '2003-02-23', 1, 'S170359', '534454', '11', '2023-07-02'),
(2, 'yoonis jamac xuseen', 'hilwaa', '5345345', 2, 2, '', 'male', '2002-01-23', 1, 'S945495', '453453', '11', '2023-07-02'),
(3, 'bashiir cabdi cali', 'warta nabada', '54354', 2, 2, '', 'male', '2000-01-17', 1, 'S369223', '423434', '11', '2023-07-02'),
(4, 'farxiyo cali dahir', 'wadajir', '5435345', 2, 1, '', 'female', '2023-06-07', 1, 'S788975', '542096', '11', '2023-07-02'),
(5, 'muno xasan maxamed', 'hilwa', '53454354', 5, 5, '', 'female', '2005-02-01', 1, 'S20851', '322973', '11', '2023-07-14'),
(6, 'xudeyfi xaashi maxamed', 'warta nabada', '534534', 5, 4, '', 'male', '2003-02-14', 1, 'S57751', '816380', '11', '2023-07-14'),
(7, 'suleyman maxamed dahir', 'hodan', '534534', 5, 6, '', 'male', '2023-07-14', 1, 'S57565', '165768', '11', '2023-07-14'),
(8, 'salmo adan cabdi', 'hilwaa', '534534', 5, 5, '', 'female', '2023-07-14', 1, 'S84862', '554084', '11', '2023-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `student_promotion`
--

CREATE TABLE `student_promotion` (
  `ID` int(11) NOT NULL,
  `Student` int(11) NOT NULL,
  `ClassFrom` int(11) NOT NULL,
  `ClassTo` int(11) NOT NULL,
  `CurrentSeason` int(11) NOT NULL,
  `PromotionSeason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_promotion`
--

INSERT INTO `student_promotion` (`ID`, `Student`, `ClassFrom`, `ClassTo`, `CurrentSeason`, `PromotionSeason`) VALUES
(1, 5, 2, 5, 1, 2),
(2, 6, 2, 5, 1, 2),
(3, 7, 2, 5, 1, 2),
(4, 8, 2, 5, 1, 2),
(5, 1, 1, 2, 1, 2),
(6, 2, 1, 2, 1, 2),
(7, 3, 1, 2, 1, 2),
(8, 4, 1, 2, 1, 2);

--
-- Triggers `student_promotion`
--
DELIMITER $$
CREATE TRIGGER `update_student_class_when_promote_student` AFTER INSERT ON `student_promotion` FOR EACH ROW BEGIN
UPDATE students SET Class = new.ClassTo WHERE Class = new.ClassFrom;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `ID` int(11) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Photo` text NOT NULL,
  `Classes` varchar(255) NOT NULL,
  `Courses` varchar(255) NOT NULL,
  `Privileges` varchar(255) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`ID`, `FullName`, `Email`, `Phone`, `Address`, `Gender`, `Photo`, `Classes`, `Courses`, `Privileges`, `UserName`, `Password`, `Status`, `Date`) VALUES
(2, 'cali jamac xuseen', 'cali@gmail.com', '53545435', 'hodan', 'male', '1741066250.jpg', '1,2,3,4,5', '1,2,3,4,5,6,7,8', '13,18', 'caliiyg', '753847', 1, '2023-07-02'),
(3, 'xuseen abshir cali', 'cali@gmail.com', '53454534', 'wadajir', 'male', '800156181.jpg', '4', '2', '13,18', 'calii', '534534', 1, '2023-07-02'),
(4, 'yoonis jamac xuseen', 'abgroup@gmail.com', '5345345', 'hodan', 'male', '539299751.jpg', '5', '7,8', '13', 'yonis', '123456', 1, '2023-07-14'),
(5, 'cabdi raxman dirie', 'abgroup@gmail.com', '453435', 'hodan', 'male', '1854138180.jpg', '4,5', '7', '13,18', 'T72249', '147852', 1, '2023-07-14'),
(6, 'farxiyo cali dahir', 'abgroup@gmail.com', '534534', 'hodan', 'female', '1055586131.jpg', '1', '1,3', '13,18', 'T73735', '299488', 1, '2023-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Privileges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `Password`, `Privileges`) VALUES
(1, 'iamyahya', '$2y$10$rJTbbxqcrPfhtxKNKCF1c.9x89QwDAgG2R3qDzGOC.GeHFs5OD/hW', '1,2,3,4,5,6,7,8,9,10,13,14,15,16,17,18,19,20,21,22,23,24,26'),
(2, 'calii', '$2y$10$0PG8LC1MHo4ASQHgfU48IessTz5W8BPuYaRpP46fHPw3GN4Z0LYF6', '4'),
(3, 'dahir', '$2y$10$KOgQu3nXGqG2Ub792r5nX.iGP.BIKn5DS73tORdtaeyP8ONOcv8M.', '21,22');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `update_employee_when_delete_user` AFTER DELETE ON `user` FOR EACH ROW BEGIN
UPDATE employee SET user = false WHERE ID = OLD.ID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_user` AFTER INSERT ON `user` FOR EACH ROW BEGIN
UPDATE employee set User = true WHERE ID = new.ID;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Section` (`Section`),
  ADD KEY `Shift` (`Shift`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exam_grade`
--
ALTER TABLE `exam_grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Student` (`Student`),
  ADD KEY `Exam` (`Exam`),
  ADD KEY `Course` (`Course`),
  ADD KEY `Class` (`Class`),
  ADD KEY `Teacher` (`Teacher`),
  ADD KEY `Season` (`Season`);

--
-- Indexes for table `exam_result`
--
ALTER TABLE `exam_result`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Season` (`Season`),
  ADD KEY `Student` (`Student`),
  ADD KEY `Account` (`Account`),
  ADD KEY `User` (`User`),
  ADD KEY `Invoice` (`Invoice`);

--
-- Indexes for table `invoice_category`
--
ALTER TABLE `invoice_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Class` (`Class`),
  ADD KEY `Parent` (`Parent`);

--
-- Indexes for table `student_promotion`
--
ALTER TABLE `student_promotion`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClassFrom` (`ClassFrom`),
  ADD KEY `ClassTo` (`ClassTo`),
  ADD KEY `CurrentSeason` (`CurrentSeason`),
  ADD KEY `Student` (`Student`),
  ADD KEY `PromotionSeason` (`PromotionSeason`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_grade`
--
ALTER TABLE `exam_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_marks`
--
ALTER TABLE `exam_marks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `exam_result`
--
ALTER TABLE `exam_result`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_schedule`
--
ALTER TABLE `exam_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_category`
--
ALTER TABLE `invoice_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_promotion`
--
ALTER TABLE `student_promotion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`Section`) REFERENCES `section` (`ID`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`Shift`) REFERENCES `shifts` (`ID`);

--
-- Constraints for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD CONSTRAINT `exam_marks_ibfk_1` FOREIGN KEY (`Student`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `exam_marks_ibfk_2` FOREIGN KEY (`Exam`) REFERENCES `exams` (`ID`),
  ADD CONSTRAINT `exam_marks_ibfk_3` FOREIGN KEY (`Course`) REFERENCES `courses` (`ID`),
  ADD CONSTRAINT `exam_marks_ibfk_4` FOREIGN KEY (`Class`) REFERENCES `classes` (`ID`),
  ADD CONSTRAINT `exam_marks_ibfk_5` FOREIGN KEY (`Teacher`) REFERENCES `teachers` (`ID`),
  ADD CONSTRAINT `exam_marks_ibfk_6` FOREIGN KEY (`Season`) REFERENCES `seasons` (`ID`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`Season`) REFERENCES `seasons` (`ID`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`Student`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`Account`) REFERENCES `bank` (`ID`),
  ADD CONSTRAINT `invoices_ibfk_4` FOREIGN KEY (`User`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `invoices_ibfk_5` FOREIGN KEY (`Invoice`) REFERENCES `invoices` (`ID`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`Class`) REFERENCES `classes` (`ID`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`Parent`) REFERENCES `parent` (`ID`);

--
-- Constraints for table `student_promotion`
--
ALTER TABLE `student_promotion`
  ADD CONSTRAINT `student_promotion_ibfk_1` FOREIGN KEY (`ClassFrom`) REFERENCES `classes` (`ID`),
  ADD CONSTRAINT `student_promotion_ibfk_2` FOREIGN KEY (`ClassTo`) REFERENCES `classes` (`ID`),
  ADD CONSTRAINT `student_promotion_ibfk_3` FOREIGN KEY (`CurrentSeason`) REFERENCES `seasons` (`ID`),
  ADD CONSTRAINT `student_promotion_ibfk_4` FOREIGN KEY (`Student`) REFERENCES `students` (`ID`),
  ADD CONSTRAINT `student_promotion_ibfk_5` FOREIGN KEY (`PromotionSeason`) REFERENCES `seasons` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
