-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: famlog
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `purchasehistory`
--

DROP TABLE IF EXISTS `purchasehistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchasehistory` (
  `purchaseID` int(6) NOT NULL,
  `belongsTo` varchar(30) NOT NULL,
  `buyer` varchar(30) NOT NULL,
  `quantity` int(6) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`purchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchasehistory`
--

LOCK TABLES `purchasehistory` WRITE;
/*!40000 ALTER TABLE `purchasehistory` DISABLE KEYS */;
INSERT INTO `purchasehistory` VALUES (1,'Jeffrey','Erin',1,'2019-10-15',2.00),(2,'Jeffrey','Erin',1,'2019-10-15',4.99),(3,'Jeffrey','Erin',1,'2019-10-15',2.99),(4,'Jeffrey','Erin',1,'2019-10-15',2.99),(5,'Jeffrey','Erin',1,'2019-10-15',2.99),(6,'Ben','Ben',1,'2019-10-13',37.99),(7,'Ben','Ben',1,'2019-10-13',3.99),(8,'Ben','Ben',1,'2019-10-13',5.99),(9,'Ben','Ben',1,'2019-10-13',37.99),(10,'Ben','Ben',1,'2019-10-13',37.99),(11,'Cynthia','Ben',1,'2019-10-13',7.99),(12,'Cynthia','Ben',1,'2019-10-13',8.99),(13,'Grace','Grace',1,'2019-10-14',10.99),(14,'Grace','Grace',1,'2019-10-14',5.99),(15,'Grace','Grace',1,'2019-10-14',8.99);
/*!40000 ALTER TABLE `purchasehistory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-27 20:56:15
