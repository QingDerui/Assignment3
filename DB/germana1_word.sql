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
INSERT INTO `word` VALUES ('w1','Name','name','Mein Name ist Anna.','m.','1'),('w2','Vorname','first name','Mein Vorname ist Lana.','m.','1'),('w3','Nachname','last name','Mein Nachname ist Lang.','m.','1'),('w4','Telefonnummer','telephone number','Mein Telefonnummer ist +49-163-3232-3232.','f.','1'),('w5','Handynummer','cellphone number','Mein Handynummer ist +49-163-3232-3232.','f.','1'),('w6','Hausnummer','house telephone number','Mein Hausnummer ist 55-5501.','f.','1'),('w7','E-Mail-Adresse','E-mail address','Mein E-Mail-Adresse ist lana.lang@icloud.com.','f.','1'),('w8','Webseite','website','Hast du deine eigene persönliche Website?','f.','1'),('w9','Straße','street','Es gibt einen Supermarkt an der Straße.','f.','1'),('w10','Postleitzahl','post code','Die Postleitzahl von Lübeck ist 23562.','f.','1'),('w11','Stadt','city','Hamburg ist eine große Stadt.','f.','1'),('w12','Land','country','Deutschland ist ein Land.','n.','1'),('w13','Deutschland','Germany','Deutschland ist ein Land.','-','1'),('w14','Östereich','Austria','Deutschland grenzt im Süden an Österreich.','-','1'),('w15','Schweiz','Switzerland','Deutschland grenzt im Süden an Österreich und die Schweiz','f.','1'),('w16','Sprache','language','Welche Sprachen sprichst du?','f.','1'),('w17','deutsch','German','Magst du deutsche Lieder?','-','1'),('w18','buchstabieren','spell','Wie buchstabiert man \"Englisch\"?','-','1'),('w19','heißen','be called','Wie heißen Sie?','-','1'),('w20','kommen','come','Woher kommen Sie?','-','1'),('w21','lernen','learn','Ich lerne gern Deutsch.','-','1'),('w22','sein','be','Ich bin Chinesisch.','-','1'),('w23','sprechen','speak','Welche Sprachen sprechen Sie?','-','1'),('w24','wohnen','live','Jetzt wohne ich in Lübeck.','-','1'),('w25','Hallo','hello','Hallo!','-','1'),('w26','null','zero','Null ist die kleinste natürliche Zahl.','-','1'),('w27','eins','one','Eins ist die zweitkleinste natürliche Zahl.','-','1'),('w28','zwei','two','Es gibt zwei lächelnde Menschen.','-','1'),('w29','drei','three','','-','1'),('w30','vier','four','','-','1'),('w31','fünf','five','','-','1'),('w32','sechs','six','','-','1'),('w33','sieben','seven','','-','1'),('w34','acht','eight','','-','1'),('w35','neun','nine','','-','1'),('w36','zehn','ten','','-','1'),('w37','elf','eleven','','-','1'),('w38','zwölf','twelve','','-','1'),('w39','dreizehn','thirteen','','-','1'),('w40','vierzehn','fourteen','','-','1'),('w41','fünfzehn','fifteen','','-','1'),('w42','sechzehn','sixteen','','-','1'),('w43','siebzehn','seventeen','','-','1'),('w44','achtzehn','eighteen','','-','1'),('w45','neunzehn','nineteen','','-','1'),('w46','zwanzig','twenty','','-','1'),('w47','Frau','woman','','f.','2'),('w48','Freund','friend','','m.','2'),('w49','Freundin','friend','','f.','2'),('w50','Herr','mister','','m.','2'),('w51','Kollege','colleague','','m.','2'),('w52','Kollegin','colleague','','f.','2'),('w53','Leute','people','','pl.','2'),('w54','Mensch','human','','m.','2'),('w55','Partner','partner','','m.','2'),('w56','Pertnerin','partner','','f.','2'),('w57','Person','person','Es gibt 2 Personen.','f.','2'),('w58','Buch','book','Ich lese gern Bücher.','n.','2'),('w59','Foto','photo','Das Foto hängt an der Wand.','n.','2'),('w60','fotografieren','take photos','','-','2'),('w61','Hobby','hobby','','n.','2'),('w62','Freizeit','free time','','f.','2'),('w63','Lieblingsfilm','favourite movie','','m.','2'),('w64','Musik','music','','f.','2'),('w65','Lieblingsmusik','favourite music','','f.','2'),('w66','chatten','chat','','-','2'),('w67','kochen','cook','','-','2'),('w68','lesen','read','','-','2'),('w69','reisen','travel','','-','2'),('w70','schwimmen','swim','','-','2'),('w71','singen','sing','','-','2'),('w72','spielen','play','','-','2'),('w73','tanzen','dance','','-','2'),('w74','gern','with pleasure','','-','2'),('w75','Café','café','','n.','2'),('w76','Fußballstadion','Football stadium','','n.','2'),('w77','Kino','cinema','','n.','2'),('w78','Museum','museum','','n.','2'),('w79','Restaurant','restaurant','','n.','2'),('w80','Schwimmbad','swimming pool','','n.','2'),('w81','Theater','theater','','n.','2'),('w82','freihaben','be free','Ich habe frei am Sonntag.','-','2'),('w83','Beruf','job','','f.','2'),('w84','Architekt','architect','','m.','2'),('w85','Architektin','architect','','f.','2'),('w86','Arzt','doctor','','m.','2'),('w87','Ärztin','doctor','','f.','2'),('w88','Boxer','boxer','','m.','2'),('w89','Boxerin','boxer','','f.','2'),('w90','Firma','company','','f.','2'),('w91','Ingenieur','engineer','','m.','2'),('w92','Ingenieurin','engineer','','f.','2'),('w93','Journalist','journalist','','m.','2'),('w94','Journalistin','journalist','','f.','2'),('w95','Koch','cook','','m.','2'),('w96','Köchin','cook','','f.','2'),('w97','Professor','professor','','m.','2'),('w98','Professorin','professor','','f.','2'),('w99','Student','student','','m.','2'),('w100','Studentin','student','','f.','2'),('w101','Taxifahrer','taxi driver','','m.','2'),('w102','Taxifahrerin','taxi driver','','f.','2'),('w103','Techniker','technician','','m.','2'),('w104','Technikerin','technician','','f.','2'),('w105','studieren','sduty','','-','2'),('w106','Formular','form','','n.','2'),('w107','Geburtsdatum','birth date','','n.','2'),('w108','Geburtsort','birthplace','','m.','2'),('w109','Geburtstag','birthday','','m.','2'),('w110','Wohnort','place of residence','','m.','2'),('w111','männlich','male','','-','2'),('w112','weiblich','female','','-','2'),('w113','ausfüllen','fill in','Ausfüllen Sie das Formular bitte.','-','2'),('w114','Montag','Monday','','m.','2'),('w115','Dienstag','Tuesday','','m.','2'),('w116','Mittwoch','Wednesday','','m.','2'),('w117','Donnerstag','Thursday','','m.','2'),('w118','Freitag','Friday','','m.','2'),('w119','Samstag','Saturday','','m.','2'),('w120','Sonntag','Sunday','','m.','2'),('w121','Kalender','calendar','','m.','2'),('w122','Tag','day','','m.','2'),('w123','Woche','week','','f.','2'),('w124','Wochenende','weekend','','n.','2'),('w125','Januar','January','','m.','2'),('w126','Februar','February','','m.','2'),('w127','März','March','','m.','2'),('w128','April','April','','m.','2'),('w129','Juni','June','','m.','2'),('w130','Juli','July','','m.','2'),('w131','August','August','','m.','2'),('w132','September','September','','m.','2'),('w133','Oktober','October','','m.','2'),('w134','November','Novenber','','m.','2'),('w135','Dezember','December','','m.','2'),('w136','Jahreszeit','season','','f.','2'),('w137','Frühling','spring','','m.','2'),('w138','Sommer','summer','','m.','2'),('w139','Herbst','autumn','','m.','2'),('w140','Winter','winter','','m.','2'),('w141','Bus','bus','','m.','3'),('w142','Fahrrad','bicycle','','n.','3'),('w143','Flugzeug','airplane','','n.','3'),('w144','Passagier','passenger','','m.','3'),('w145','Schiff','ship','','n.','3'),('w146','S-Bahn','train','','f.','3'),('w147','Straßenbahn','tram','','f.','3'),('w148','Ticket','ticket','','n.','3'),('w149','Fahrkarte','ticket','','f.','3'),('w150','U-Bahn','subway','','f.','3'),('w151','Zug','train','','m.','3'),('w152','fahren','drive','','-','3'),('w153','kaufen','buy','','-','3'),('w154','Bahnhof','train station','','m.','3'),('w155','Flughafen','airport','','m.','3'),('w156','Fluss','river','','m.','3');
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

-- Dump completed on 2018-12-28  2:50:57
