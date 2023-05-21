-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 09:21 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rfid_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_username`, `admin_password`, `status`) VALUES
(1, 'sysadmin', 'sysadmin', 'active'),
(4, 'admin', 'admin', 'inactive'),
(5, 'admin1', 'admin1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `announcement_id` int(11) NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `announce` varchar(1000) NOT NULL,
  `member_number` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`announcement_id`, `gradelevel_id`, `member_type`, `announce`, `member_number`, `date_created`) VALUES
(1, 1, 'student', 'no classes', '', '2023-04-12 18:02:47'),
(3, 2, 'student', 'loop', '', '2023-04-12 19:26:58'),
(4, 1, 'student', 'jade', '', '2023-04-12 19:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `member_rfid` text NOT NULL,
  `time_in` text NOT NULL,
  `time_out` text NOT NULL,
  `status` text NOT NULL,
  `logdate` varchar(255) DEFAULT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `member_rfid`, `time_in`, `time_out`, `status`, `logdate`, `member_id`) VALUES
(1, '1202743617', '10:55:21', '10:55:44', '1', '2023-04-14', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gradelevel`
--

CREATE TABLE `tbl_gradelevel` (
  `gradelevel_id` int(11) NOT NULL,
  `glevel_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gradelevel`
--

INSERT INTO `tbl_gradelevel` (`gradelevel_id`, `glevel_name`) VALUES
(1, 'Grade 1'),
(2, 'Grade 2'),
(6, 'Grade 3'),
(7, 'Grade 4 - Rose');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `member_id` int(11) NOT NULL,
  `member_rfid` int(11) NOT NULL,
  `member_image` varchar(255) NOT NULL,
  `member_fname` varchar(255) NOT NULL,
  `member_mname` varchar(255) NOT NULL,
  `member_lname` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `guardian_number` text NOT NULL,
  `gradelevel_id` int(11) NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `member_status` varchar(255) NOT NULL,
  `visitor_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`member_id`, `member_rfid`, `member_image`, `member_fname`, `member_mname`, `member_lname`, `purpose`, `guardian`, `guardian_number`, `gradelevel_id`, `member_type`, `member_status`, `visitor_status`) VALUES
(11, 1203128881, '../uploads/WIN_20220914_15_47_52_Pro.jpg', 'John', 'Die', 'Doe', '', 'Jay', '+639605895653', 1, 'student', 'inactive', NULL),
(12, 1202743617, '../uploads/admin.png', 'Jeffrey', 'ZAPANTA', 'Tan', '', 'John', '+639605895653', 2, 'student', 'active', NULL),
(13, 285224227, '../uploads/staff.png', 'QUEENIE', 'DELAMBOTIQUE', 'NEQUINTO', '', 'Pamela', '+639605895653', 1, 'student', 'inactive', NULL),
(14, 1296344467, '../uploads/student.png', 'Junil', 'D.', 'Todelodo', '', 'merasha', '+639605895653', 1, 'student', 'active', NULL),
(16, 301676067, '../uploads/daily.png', 'QUEENIE', 'DELAMBOTIQUE', 'NEQUINTO', '', '', '1', 1, 'staff', 'active', NULL),
(26, 1111111111, '../uploads/1.webp', 'QUEENIE', 'DELAMBOTIQUE', 'NEQUINTO', 'im visit you', '', '2', 0, 'visitor', '', 'Approved'),
(27, 0, '../uploads/11.jpg', 'JOHN JUSTINE', 'ZAPANTA', 'FERANIL', 'Visiting', '', '3', 0, 'visitor', '', 'Approved'),
(28, 0, '../uploads/download.jpg', 'raymond', 'a', 'toling', 'my kukunin lang', '', '4', 0, 'visitor', '', 'Pending'),
(29, 0, '../uploads/download (1).jpg', 'ryan', 'e', 'zuwa', 'may pick apin', '', '5', 0, 'visitor', '', 'Pending'),
(30, 0, '../uploads/11.jpg', 'JOHN JUSTINE', 'ZAPANTA', 'FERANIL', 'sample', '', '7', 0, 'visitor', '', 'Pending'),
(33, 0, '../uploads/11.jpg', 'JOHN JUSTINE', 'ZAPANTA', 'FERANIL', 'asdasd', '', '', 0, 'visitor', '', 'Pending'),
(35, 0, '../uploads/11.jpg', '123', '12313', '1233', '12312', '', '', 0, 'visitor', '', 'Pending'),
(36, 1202743617, '../uploads/2x2.png', 'JOHN JUSTINE', 'ZAPANTA', 'FERANIL', '', 'anicita', '123321123', 1, 'student', 'active', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `tbl_gradelevel`
--
ALTER TABLE `tbl_gradelevel`
  ADD PRIMARY KEY (`gradelevel_id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_gradelevel`
--
ALTER TABLE `tbl_gradelevel`
  MODIFY `gradelevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
