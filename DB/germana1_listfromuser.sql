CREATE DATABASE  IF NOT EXISTS `germana1` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `germana1`;
-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: germana1
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `listfromuser`
--

DROP TABLE IF EXISTS `listfromuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8;
CREATE TABLE `listfromuser` (
  `userid` varchar(20) DEFAULT NULL,
  `wordid` varchar(20) DEFAULT NULL,
  `wordger` varchar(90) DEFAULT NULL,
  `wordeng` varchar(200) DEFAULT NULL,
  `genus` varchar(20) DEFAULT NULL,
  `example` varchar(255) DEFAULT NULL,
  `listname` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listfromuser`
--

LOCK TABLES `listfromuser` WRITE;
/*!40000 ALTER TABLE `listfromuser` DISABLE KEYS */;
INSERT INTO `listfromuser` VALUES ('Yuxuan Wang','w1','muessen','must','-','Muss ich arbeiten?','my test list 3'),('Yuxuan','w1','bekommen','receive','-','Heute bekomme ich ein Packet.','Test 1'),('Yuxuan','w2','holen','get','-','','Test 1'),('Yuxuan','w1','aufhören','stop','-','Willst du, dass ich aufhöre?','Test 2'),('Yuxuan','w2','zumachen','close','-','Mach das Fenster zu!','Test 2');
/*!40000 ALTER TABLE `listfromuser` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-13  1:00:59
