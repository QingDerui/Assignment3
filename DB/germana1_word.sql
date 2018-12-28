CREATE DATABASE  IF NOT EXISTS `germana1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
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
-- Table structure for table `word`
--

DROP TABLE IF EXISTS `word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `word` (
  `wordid` varchar(20) DEFAULT NULL,
  `wordger` varchar(90) DEFAULT NULL,
  `wordeng` varchar(200) DEFAULT NULL,
  `example` varchar(500) DEFAULT NULL,
  `genus` varchar(3) DEFAULT NULL,
  `section` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `word`
--

LOCK TABLES `word` WRITE;
/*!40000 ALTER TABLE `word` DISABLE KEYS */;
INSERT INTO `word` VALUES ('w1','Name','name','Mein Name ist Anna.','m.','1'),('w2','Vorname','first name','Mein Vorname ist Lana.','m.','1'),('w3','Nachname','last name','Mein Nachname ist Lang.','m.','1'),('w4','Telefonnummer','telephone number','Mein Telefonnummer ist +49-163-3232-3232.','f.','1'),('w5','Handynummer','cellphone number','Mein Handynummer ist +49-163-3232-3232.','f.','1'),('w6','Hausnummer','house telephone number','Mein Hausnummer ist 55-5501.','f.','1'),('w7','E-Mail-Adresse','E-mail address','Mein E-Mail-Adresse ist lana.lang@icloud.com.','f.','1'),('w8','Webseite','website','Hast du deine eigene persönliche Website?','f.','1'),('w9','Straße','street','Es gibt einen Supermarkt an der Straße.','f.','1'),('w10','Postleitzahl','post code','Die Postleitzahl von Lübeck ist 23562.','f.','1'),('w11','Stadt','city','Hamburg ist eine große Stadt.','f.','1'),('w12','Land','country','Deutschland ist ein Land.','n.','1'),('w13','Deutschland','Germany','Deutschland ist ein Land.','-','1'),('w14','Östereich','Austria','Deutschland grenzt im Süden an Österreich.','-','1'),('w15','Schweiz','Switzerland','Deutschland grenzt im Süden an Österreich und die Schweiz','f.','1'),('w16','Sprache','language','Welche Sprachen sprichst du?','f.','1'),('w17','deutsch','German','Magst du deutsche Lieder?','-','1'),('w18','buchstabieren','spell','Wie buchstabiert man \"Englisch\"?','-','1'),('w19','heißen','be called','Wie heißen Sie?','-','1'),('w20','kommen','come','Woher kommen Sie?','-','1'),('w21','lernen','learn','Ich lerne gern Deutsch.','-','1'),('w22','sein','be','Ich bin Chinesisch.','-','1'),('w23','sprechen','speak','Welche Sprachen sprechen Sie?','-','1'),('w24','wohnen','live','Jetzt wohne ich in Lübeck.','-','1'),('w25','Hallo','hello','Hallo!','-','1'),('w26','null','zero','Null ist die kleinste natürliche Zahl.','-','1'),('w27','eins','one','Eins ist die zweitkleinste natürliche Zahl.','-','1'),('w28','zwei','two','Es gibt zwei lächelnde Menschen.','-','1');
/*!40000 ALTER TABLE `word` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-28  1:02:11
