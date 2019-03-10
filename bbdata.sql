-- MySQL dump 10.13  Distrib 5.1.30, for Win32 (ia32)
--
-- Host: localhost    Database: bbdata
-- ------------------------------------------------------
-- Server version	5.1.30-community

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
-- Table structure for table `bb1`
--

DROP TABLE IF EXISTS `bb1`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bb1` (
  `name` varchar(40) DEFAULT NULL,
  `CATEGORY` varchar(4) DEFAULT NULL,
  `TIME` varchar(7) DEFAULT NULL,
  `DISTANCE` double DEFAULT NULL,
  `MEASURE` varchar(1) DEFAULT NULL,
  `FILLER1` varchar(9) DEFAULT NULL,
  `POINTS` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;



--
-- Table structure for table `bb2`
--

DROP TABLE IF EXISTS `bb2`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bb2` (
  `name` varchar(40) DEFAULT NULL,
  `CATEGORY` varchar(4) DEFAULT NULL,
  `TIME1` varchar(9) DEFAULT NULL,
  `TIME2` varchar(9) DEFAULT NULL,
  `TIME3` varchar(9) DEFAULT NULL,
  `TIME4` varchar(9) DEFAULT NULL,
  `PT1` double DEFAULT NULL,
  `PT2` double DEFAULT NULL,
  `PT3` double DEFAULT NULL,
  `PT4` double DEFAULT NULL,
  `PTOTAL` double DEFAULT NULL,
  `CAT2` varchar(3) DEFAULT NULL,
  `CRANK` double DEFAULT NULL,
  `PRANK` double DEFAULT NULL,
  `NRACES` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `bb3`
--

DROP TABLE IF EXISTS `bb3`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bb3` (
  `corder` double DEFAULT NULL,
  `cat2` varchar(3) DEFAULT NULL,
  `crank` double DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `ptotal` double DEFAULT NULL,
  `nraces` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;


--
-- Table structure for table `bb4`
--

DROP TABLE IF EXISTS `bb4`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bb4` (
  `CAT2` varchar(3) DEFAULT NULL,
  `CORDER` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bb4`
--

LOCK TABLES `bb4` WRITE;
/*!40000 ALTER TABLE `bb4` DISABLE KEYS */;
INSERT INTO `bb4` VALUES ('OpM',1),('M30',2),('M40',3),('M50',4),('M60',5),('OpW',6),('W30',7),('W40',8),('W50',9),('W60',10);
/*!40000 ALTER TABLE `bb4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bbimport`
--

DROP TABLE IF EXISTS `bbimport`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bbimport` (
  `name` varchar(40) DEFAULT NULL,
  `CATEGORY` varchar(4) DEFAULT NULL,
  `TIME` varchar(7) DEFAULT NULL,
  `DISTANCE` double DEFAULT NULL,
  `MEASURE` varchar(1) DEFAULT NULL,
  `FILLER1` varchar(9) DEFAULT NULL,
  `POINTS` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

