-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: db_chickensoup
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CallLog`
--

DROP TABLE IF EXISTS `CallLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CallLog` (
  `call_time` datetime DEFAULT NULL,
  `VID` int(4) NOT NULL,
  `EID` int(4) NOT NULL,
  PRIMARY KEY (`EID`,`VID`),
  KEY `VID` (`VID`),
  CONSTRAINT `CallLog_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `Volunteers` (`VID`),
  CONSTRAINT `CallLog_ibfk_2` FOREIGN KEY (`EID`) REFERENCES `Events` (`EID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Events`
--

DROP TABLE IF EXISTS `Events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Events` (
  `event_type` int(2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `arrive_time` char(15) DEFAULT NULL,
  `end_time` char(15) DEFAULT 'null',
  `appt_time` char(15) DEFAULT NULL,
  `portion` char(15) DEFAULT NULL,
  `destion` char(100) DEFAULT NULL,
  `comments` text,
  `instructions` text,
  `stay` int(1) DEFAULT NULL,
  `recurring` int(1) DEFAULT '0',
  `round_trip` int(1) DEFAULT '0',
  `VID` int(4) DEFAULT NULL,
  `RID` int(4) NOT NULL,
  `EID` int(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`EID`),
  KEY `VID` (`VID`),
  KEY `RID` (`RID`),
  CONSTRAINT `Events_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `Volunteers` (`VID`),
  CONSTRAINT `Events_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `Recipients` (`RID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Recipients`
--

DROP TABLE IF EXISTS `Recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recipients` (
  `first_name` char(75) DEFAULT NULL,
  `last_name` char(75) DEFAULT NULL,
  `home_phone` char(20) DEFAULT NULL,
  `cell_phone` char(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `ZIP` int(5) DEFAULT NULL,
  `directions` text,
  `contact` char(75) DEFAULT NULL,
  `contact_relationship` char(25) DEFAULT NULL,
  `team_leader` char(20) DEFAULT NULL,
  `limitations` text,
  `child` int(1) DEFAULT NULL,
  `SUV` int(1) DEFAULT NULL,
  `RID` int(4) NOT NULL AUTO_INCREMENT,
  `email` char(75) DEFAULT 'NULL',
  PRIMARY KEY (`RID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COMMENT='latin1_swedish_ci';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VAvailable`
--

DROP TABLE IF EXISTS `VAvailable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VAvailable` (
  `VAID` int(10) NOT NULL AUTO_INCREMENT,
  `weekday` int(2) DEFAULT NULL,
  `AM` int(1) DEFAULT NULL,
  `PM` int(1) DEFAULT NULL,
  `VID` int(4) NOT NULL,
  PRIMARY KEY (`VAID`),
  KEY `VAvailable_ibfk_1` (`VID`),
  CONSTRAINT `VAvailable_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `Volunteers` (`VID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Volunteers`
--

DROP TABLE IF EXISTS `Volunteers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Volunteers` (
  `first_name` char(75) DEFAULT NULL,
  `last_name` char(75) DEFAULT NULL,
  `email` char(250) DEFAULT NULL,
  `home_phone` char(20) DEFAULT NULL,
  `cell_phone` char(20) DEFAULT NULL,
  `work_phone` char(20) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `child1` int(4) DEFAULT NULL,
  `child2` int(4) DEFAULT NULL,
  `child3` int(4) DEFAULT NULL,
  `other_acts` text,
  `comments` text,
  `sencond_lang` char(25) DEFAULT NULL,
  `SUV` int(1) DEFAULT NULL,
  `meal` int(1) DEFAULT NULL,
  `trans` int(1) DEFAULT NULL,
  `visit` int(1) DEFAULT NULL,
  `errands` int(1) DEFAULT NULL,
  `VID` int(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`VID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-06 12:21:06
