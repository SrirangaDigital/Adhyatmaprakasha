-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: apk
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `topviewed`
--

DROP TABLE IF EXISTS `topviewed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topviewed` (
  `serial` int(5) NOT NULL AUTO_INCREMENT,
  `bookid` int(6) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `hits` int(6) DEFAULT NULL,
  `viewed_date` date DEFAULT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM AUTO_INCREMENT=11081 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topviewed`
--

LOCK TABLES `topviewed` WRITE;
/*!40000 ALTER TABLE `topviewed` DISABLE KEYS */;
INSERT INTO `topviewed` VALUES (11064,1,'english',1,'2015-02-26'),(11065,2,'english',1,'2015-02-27'),(11066,3,'english',1,'2015-02-27'),(11070,3,'kannada',1,'2015-02-27'),(11069,2,'kannada',1,'2015-03-02'),(11068,1,'kannada',3,'0000-00-00'),(11067,4,'english',2,'0000-00-00'),(11076,5,'kannada',1,'2015-02-28'),(11071,1,'sanskrit',1,'2015-02-27'),(11072,2,'sanskrit',1,'2015-02-27'),(11073,3,'sanskrit',1,'2015-02-27'),(11074,6,'kannada',1,'2015-02-28'),(11075,4,'kannada',1,'2015-02-28');
/*!40000 ALTER TABLE `topviewed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `top`
--

DROP TABLE IF EXISTS `top`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `top` (
  `bookid` int(6) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `hits` int(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `top`
--

LOCK TABLES `top` WRITE;
/*!40000 ALTER TABLE `top` DISABLE KEYS */;
INSERT INTO `top` VALUES (147,'sanskrit',26),(149,'sanskrit',7),(148,'sanskrit',8),(1,'kannada',61),(4,'kannada',13),(2,'kannada',26),(141,'english',20),(137,'english',16),(130,'english',37),(97,'kannada',10),(15,'sanskrit',61),(81,'kannada',12),(146,'english',51),(150,'sanskrit',7),(96,'kannada',17),(100,'kannada',12),(131,'english',14),(145,'english',13),(57,'kannada',10),(71,'kannada',14),(68,'kannada',9),(126,'kannada',46),(17,'kannada',12),(58,'kannada',13),(12,'kannada',15),(127,'kannada',14),(18,'kannada',12),(144,'english',17),(119,'kannada',7),(138,'english',59),(132,'english',24),(133,'english',22),(134,'english',19),(136,'english',24),(135,'english',10),(139,'english',12),(152,'sanskrit',6),(153,'sanskrit',6),(154,'sanskrit',7),(140,'english',17),(143,'english',14),(142,'english',12),(155,'sanskrit',7),(161,'sanskrit',7),(162,'sanskrit',5),(163,'sanskrit',12),(158,'sanskrit',7),(170,'sanskrit',4),(165,'sanskrit',8),(166,'sanskrit',8),(173,'sanskrit',6),(157,'sanskrit',6),(167,'sanskrit',5),(169,'sanskrit',7),(164,'sanskrit',8),(156,'sanskrit',6),(174,'sanskrit',24),(159,'sanskrit',6),(160,'sanskrit',6),(8,'kannada',8),(3,'kannada',11),(5,'kannada',11),(7,'kannada',8),(53,'kannada',10),(6,'kannada',8),(33,'kannada',11),(77,'kannada',8),(34,'kannada',8),(36,'kannada',9),(61,'kannada',9),(41,'kannada',12),(44,'kannada',10),(75,'kannada',8),(19,'kannada',14),(76,'kannada',8),(27,'kannada',14),(22,'kannada',8),(23,'kannada',11),(59,'kannada',8),(70,'kannada',8),(21,'kannada',13),(40,'kannada',10),(16,'kannada',18),(60,'kannada',9),(49,'kannada',9),(78,'kannada',10),(28,'kannada',11),(42,'kannada',13),(54,'kannada',9),(51,'kannada',8),(72,'kannada',9),(20,'kannada',14),(62,'kannada',11),(88,'kannada',7),(25,'kannada',12),(24,'kannada',11),(9,'kannada',7),(47,'kannada',8),(45,'kannada',8),(91,'kannada',9),(90,'kannada',9),(73,'kannada',10),(37,'kannada',10),(50,'kannada',8),(52,'kannada',8),(64,'kannada',8),(63,'kannada',9),(74,'kannada',8),(55,'kannada',8),(10,'kannada',10),(13,'kannada',10),(35,'kannada',9),(29,'kannada',9),(30,'kannada',11),(83,'kannada',13),(56,'kannada',9),(43,'kannada',10),(11,'kannada',9),(32,'kannada',7),(46,'kannada',8),(89,'kannada',9),(26,'kannada',12),(66,'kannada',7),(98,'kannada',13),(106,'kannada',9),(114,'kannada',8),(116,'kannada',8),(101,'kannada',7),(117,'kannada',9),(129,'kannada',11),(99,'kannada',11),(125,'kannada',19),(93,'kannada',8),(110,'kannada',10),(120,'kannada',10),(115,'kannada',8),(103,'kannada',9),(128,'kannada',11),(124,'kannada',9),(105,'kannada',6),(109,'kannada',8),(107,'kannada',7),(122,'kannada',9),(113,'kannada',8),(102,'kannada',8),(92,'kannada',8),(104,'kannada',7),(112,'kannada',6),(108,'kannada',7),(121,'kannada',9),(94,'kannada',8),(111,'kannada',10),(86,'kannada',8),(82,'kannada',11),(80,'kannada',9),(79,'kannada',14),(85,'kannada',7),(84,'kannada',9),(38,'kannada',10),(48,'kannada',72),(87,'kannada',11),(39,'kannada',10),(95,'kannada',10);
/*!40000 ALTER TABLE `top` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitor` (
  `count` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` VALUES (64534);
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-02 12:36:29
