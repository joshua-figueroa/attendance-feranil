-- MariaDB dump 10.19  Distrib 10.11.3-MariaDB, for osx10.18 (arm64)
--
-- Host: 127.0.0.1    Database: rfid_attendance
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES
(1,'sysadmin','sysadmin','active'),
(4,'admin','admin','inactive'),
(5,'admin1','admin1','active');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_announcement`
--

DROP TABLE IF EXISTS `tbl_announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_announcement` (
  `announcement_id` int NOT NULL AUTO_INCREMENT,
  `gradelevel_id` int NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `announce` varchar(1000) NOT NULL,
  `member_number` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_announcement`
--

LOCK TABLES `tbl_announcement` WRITE;
/*!40000 ALTER TABLE `tbl_announcement` DISABLE KEYS */;
INSERT INTO `tbl_announcement` VALUES
(1,1,'student','no classes','','2023-04-12 18:02:47'),
(3,2,'student','loop','','2023-04-12 19:26:58'),
(4,1,'student','jade','','2023-04-12 19:44:38');
/*!40000 ALTER TABLE `tbl_announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_attendance`
--

DROP TABLE IF EXISTS `tbl_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_attendance` (
  `attendance_id` int NOT NULL AUTO_INCREMENT,
  `member_rfid` text NOT NULL,
  `time_in` text NOT NULL,
  `time_out` text NOT NULL,
  `status` text NOT NULL,
  `logdate` varchar(255) DEFAULT NULL,
  `member_id` int NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53536 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_attendance`
--

LOCK TABLES `tbl_attendance` WRITE;
/*!40000 ALTER TABLE `tbl_attendance` DISABLE KEYS */;
INSERT INTO `tbl_attendance` VALUES
(1,'1202743617','10:55:21','10:55:44','1','2023-04-14',12),
(2,'1202743617','08:42:21','17:30:31','1','2023-05-17',12);
/*!40000 ALTER TABLE `tbl_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_gradelevel`
--

DROP TABLE IF EXISTS `tbl_gradelevel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_gradelevel` (
  `gradelevel_id` int NOT NULL AUTO_INCREMENT,
  `glevel_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gradelevel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_gradelevel`
--

LOCK TABLES `tbl_gradelevel` WRITE;
/*!40000 ALTER TABLE `tbl_gradelevel` DISABLE KEYS */;
INSERT INTO `tbl_gradelevel` VALUES
(1,'Grade 1'),
(2,'Grade 2'),
(6,'Grade 3'),
(7,'Grade 4 - Rose');
/*!40000 ALTER TABLE `tbl_gradelevel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_members`
--

DROP TABLE IF EXISTS `tbl_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_members` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `member_rfid` int NOT NULL,
  `member_image` varchar(255) NOT NULL,
  `member_fname` varchar(255) NOT NULL,
  `member_mname` varchar(255) NOT NULL,
  `member_lname` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `guardian_number` text NOT NULL,
  `gradelevel_id` int NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `member_status` varchar(255) NOT NULL,
  `visitor_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_members`
--

LOCK TABLES `tbl_members` WRITE;
/*!40000 ALTER TABLE `tbl_members` DISABLE KEYS */;
INSERT INTO `tbl_members` VALUES
(11,1203128881,'../uploads/WIN_20220914_15_47_52_Pro.jpg','John','Die','Doe','','Jay','+639605895653',1,'student','inactive',NULL),
(12,1202743617,'../uploads/admin.png','Jeffrey','ZAPANTA','Tan','','John','+639605895653',2,'student','active',NULL),
(13,285224227,'../uploads/staff.png','QUEENIE','DELAMBOTIQUE','NEQUINTO','','Pamela','+639605895653',1,'student','inactive',NULL),
(14,1296344467,'../uploads/student.png','Junil','D.','Todelodo','','merasha','+639605895653',1,'student','active',NULL),
(16,301676067,'../uploads/daily.png','QUEENIE','DELAMBOTIQUE','NEQUINTO','','','1',1,'staff','active',NULL),
(26,1111111111,'../uploads/1.webp','QUEENIE','DELAMBOTIQUE','NEQUINTO','im visit you','','2',0,'visitor','','Approved'),
(27,0,'../uploads/11.jpg','JOHN JUSTINE','ZAPANTA','FERANIL','Visiting','','3',0,'visitor','','Approved'),
(28,0,'../uploads/download.jpg','raymond','a','toling','my kukunin lang','','4',0,'visitor','','Pending'),
(29,0,'../uploads/download (1).jpg','ryan','e','zuwa','may pick apin','','5',0,'visitor','','Pending'),
(30,0,'../uploads/11.jpg','JOHN JUSTINE','ZAPANTA','FERANIL','sample','','7',0,'visitor','','Pending'),
(33,0,'../uploads/11.jpg','JOHN JUSTINE','ZAPANTA','FERANIL','asdasd','','',0,'visitor','','Pending'),
(35,0,'../uploads/11.jpg','123','12313','1233','12312','','',0,'visitor','','Pending'),
(36,1202743617,'../uploads/2x2.png','JOHN JUSTINE','ZAPANTA','FERANIL','','anicita','123321123',1,'student','active',NULL);
/*!40000 ALTER TABLE `tbl_members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-22  5:04:12
