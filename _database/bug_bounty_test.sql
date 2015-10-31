-- MySQL dump 10.15  Distrib 10.0.17-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: bug_bounty_test
-- ------------------------------------------------------
-- Server version	10.0.17-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(16) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `activated` tinyint(1) DEFAULT NULL,
  `dateDeactivated` datetime DEFAULT NULL,
  `accountType` varchar(10) NOT NULL,
  `loggedIn` tinyint(1) DEFAULT NULL,
  `dateOfLastActivity` datetime NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `userID_UNIQUE` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'testHunter1','testHunter1@me.com','testHunter1','2015-10-29 21:44:18',1,NULL,'hunter',NULL,'0000-00-00 00:00:00'),(2,'testHunter2','testHunter2@me.com','testHunter2','2015-10-29 21:44:18',1,NULL,'hunter',NULL,'0000-00-00 00:00:00'),(3,'testMarshall1','testMarshall1@me.com','testMarshall1','2015-10-29 21:44:18',1,NULL,'marshall',NULL,'0000-00-00 00:00:00'),(4,'testMarshall2','testMarshall2@me.com','testMarshall2','2015-10-29 21:44:18',1,NULL,'marshall',NULL,'0000-00-00 00:00:00'),(5,'testMarshall3','testMarshall3@me.com','testMarshall3','2015-10-29 21:44:18',1,NULL,'marshall',NULL,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bountypool`
--

DROP TABLE IF EXISTS `bountypool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bountypool` (
  `poolID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime NOT NULL,
  `payoutPool` varchar(10) NOT NULL,
  `dateEnding` datetime NOT NULL,
  `bountyMarshallID` int(10) unsigned NOT NULL,
  `bountyLink` varchar(45) NOT NULL,
  `imageLoc` varchar(45) DEFAULT NULL,
  `lineDescription` tinytext,
  `fullDescription` mediumtext,
  PRIMARY KEY (`poolID`),
  UNIQUE KEY `poolID_UNIQUE` (`poolID`),
  KEY `fk_BountyPool_Marshall1` (`bountyMarshallID`),
  CONSTRAINT `fk_BountyPool_Marshall1` FOREIGN KEY (`bountyMarshallID`) REFERENCES `marshall` (`marshallID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bountypool`
--

LOCK TABLES `bountypool` WRITE;
/*!40000 ALTER TABLE `bountypool` DISABLE KEYS */;
INSERT INTO `bountypool` VALUES (1,'2015-10-29 21:44:19','1','0000-00-00 00:00:00',3,'www.google.com','_images/_bounties/_testMarshall1/bounty1.jpg','lineDesc1','fullDescription1'),(2,'2015-10-29 21:44:19','2','0000-00-00 00:00:00',4,'www.google.com','_images/_bounties/_testMarshall2/bounty2.jpg','lineDesc2','fullDescription2'),(3,'2015-10-29 21:44:19','3','0000-00-00 00:00:00',5,'www.google.com','_images/_bounties/_testMarshall3/bounty3.jpg','lineDesc3','fullDescription3'),(4,'2015-10-29 21:44:19','4','0000-00-00 00:00:00',3,'www.google.com','_images/_bounties/_testMarshall1/bounty4.jpg','lineDesc4','fullDescription4'),(5,'2015-10-29 21:44:19','5','0000-00-00 00:00:00',4,'www.google.com','_images/_bounties/_testMarshall2/bounty5.jpg','lineDesc5','fullDescription5'),(6,'2015-10-29 21:44:19','6','0000-00-00 00:00:00',5,'www.google.com','_images/_bounties/_testMarshall3/bounty6.jpg','lineDesc6','fullDescription6'),(7,'2015-10-29 21:44:19','7','0000-00-00 00:00:00',3,'www.google.com','_images/_bounties/_testMarshall1/bounty7.jpg','lineDesc7','fullDescription7'),(8,'2015-10-29 21:44:19','8','0000-00-00 00:00:00',4,'www.google.com','_images/_bounties/_testMarshall2/bounty8.jpg','lineDesc8','fullDescription8'),(9,'2015-10-29 21:44:19','9','0000-00-00 00:00:00',5,'www.google.com','_images/_bounties/_testMarshall3/bounty9.jpg','lineDesc9','fullDescription9'),(11,'2015-10-29 21:47:39','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(12,'2015-10-29 21:54:38','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(13,'2015-10-29 21:55:03','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(14,'2015-10-29 21:55:36','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(15,'2015-10-29 21:56:25','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(16,'2015-10-29 21:57:03','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(17,'2015-10-29 21:58:02','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(18,'2015-10-29 21:59:57','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(19,'2015-10-29 22:00:12','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description'),(20,'2015-10-29 22:00:50','123','0000-00-00 00:00:00',3,'www.google.com',NULL,NULL,'Hello, description');
/*!40000 ALTER TABLE `bountypool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marshall`
--

DROP TABLE IF EXISTS `marshall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marshall` (
  `marshallID` int(10) unsigned NOT NULL,
  `rankingTotal` int(11) NOT NULL,
  `numRankings` int(11) NOT NULL,
  `rankingAvg` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `imageLoc` varchar(45) NOT NULL,
  `company` varchar(25) NOT NULL,
  PRIMARY KEY (`marshallID`),
  UNIQUE KEY `userID_UNIQUE` (`marshallID`),
  CONSTRAINT `fk_Sheriff_Account` FOREIGN KEY (`marshallID`) REFERENCES `account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marshall`
--

LOCK TABLES `marshall` WRITE;
/*!40000 ALTER TABLE `marshall` DISABLE KEYS */;
INSERT INTO `marshall` VALUES (3,0,0,0,'This is marshallDescription1','','company1'),(4,0,0,0,'This is marshallDescription2','','company2'),(5,0,0,0,'This is marshallDescription3','','company3');
/*!40000 ALTER TABLE `marshall` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `messageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` int(10) unsigned NOT NULL,
  `recipient` int(10) unsigned NOT NULL,
  `messageText` longtext,
  `bountyID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`messageID`),
  UNIQUE KEY `messageID_UNIQUE` (`messageID`),
  UNIQUE KEY `recipient_UNIQUE` (`recipient`),
  UNIQUE KEY `sender_UNIQUE` (`sender`),
  UNIQUE KEY `bountyID_UNIQUE` (`bountyID`),
  CONSTRAINT `fk_Message_Account1` FOREIGN KEY (`sender`) REFERENCES `account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_Account2` FOREIGN KEY (`recipient`) REFERENCES `account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_BountyPool1` FOREIGN KEY (`bountyID`) REFERENCES `bountypool` (`poolID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paidreport`
--

DROP TABLE IF EXISTS `paidreport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paidreport` (
  `reportID` int(10) unsigned NOT NULL,
  `paidAmount` varchar(10) NOT NULL,
  `datePaid` datetime NOT NULL,
  `message` mediumtext NOT NULL,
  `publish` tinyint(1) NOT NULL,
  PRIMARY KEY (`reportID`),
  UNIQUE KEY `reportID_UNIQUE` (`reportID`),
  CONSTRAINT `fk_paidReport_Report1` FOREIGN KEY (`reportID`) REFERENCES `report` (`bountyID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paidreport`
--

LOCK TABLES `paidreport` WRITE;
/*!40000 ALTER TABLE `paidreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `paidreport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferredbounties`
--

DROP TABLE IF EXISTS `preferredbounties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferredbounties` (
  `bountyID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bountyID`),
  UNIQUE KEY `bountyID_UNIQUE` (`bountyID`),
  CONSTRAINT `fk_PreferredBounties_BountyPool1` FOREIGN KEY (`bountyID`) REFERENCES `bountypool` (`poolID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferredbounties`
--

LOCK TABLES `preferredbounties` WRITE;
/*!40000 ALTER TABLE `preferredbounties` DISABLE KEYS */;
INSERT INTO `preferredbounties` VALUES (1),(2),(3),(4),(5),(6),(7),(8),(9);
/*!40000 ALTER TABLE `preferredbounties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `bountyID` int(10) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `ReportText` mediumtext,
  `dateSubmitted` datetime NOT NULL,
  `imageLoc` varchar(100) NOT NULL,
  `reportID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`reportID`),
  UNIQUE KEY `reportID_UNIQUE` (`reportID`),
  KEY `fk_Report_BountyPool2` (`bountyID`),
  KEY `fk_Report_Account1` (`username`),
  CONSTRAINT `fk_Report_Account1` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Report_BountyPool2` FOREIGN KEY (`bountyID`) REFERENCES `bountypool` (`poolID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (1,'testHunter1','This is report Text 1 for bounty 1 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter1/report1.jpg',1),(1,'testHunter2','This is report Text 1 for bounty 1 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter2/report1.jpg',2),(1,'testHunter2','This is report Text 2 for bounty 1 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter2/report2.jpg',3),(2,'testHunter1','This is reportText 1 for bounty 2 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter1/report1.jpg',4),(2,'testHunter2','This is report Text 1 for bounty 2 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter2/report1.jpg',5),(2,'testHunter2','This is report Text 2 for bounty 2 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter2/report2.jpg',6),(3,'testHunter1','This is report Text 1  for bounty 3 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter1/report1.jpg',7),(3,'testHunter2','This is report Text 1 for bounty 3 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter2/report1.jpg',8),(3,'testHunter1','This is report Text 2 for bounty 3 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter1/report2.jpg',9),(4,'testHunter2','This is reportText 1 for bounty 4 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter2/report3.jpg',10),(4,'testHunter1','This is report Text 1 for bounty 4 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter1/report2.jpg',11),(4,'testHunter1','This is report Text 2 for bounty 4 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter1/report3.jpg',12),(5,'testHunter2','This is report Text 1 for bounty 5 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter2/report3.jpg',13),(5,'testHunter1','This is report Text 1 for bounty 5 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter1/report2.jpg',14),(5,'testHunter2','This is report Text 2 for bounty 5 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter2/report4.jpg',15),(6,'testHunter2','This is reportText 1 for bounty 6 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter2/report2.jpg',16),(6,'testHunter1','This is report Text 1 for bounty 6 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter1/report3.jpg',17),(6,'testHunter1','This is report Text 2 for bounty 6 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter1/report4.jpg',18),(7,'testHunter2','This is reportText 1 for bounty 7 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter2/report4.jpg',19),(7,'testHunter1','This is report Text 1 for bounty 7 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter1/report4.jpg',20),(7,'testHunter2','This is report Text 2 for bounty 7 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall1/_reports/_testHunter2/report5.jpg',21),(8,'testHunter2','This is reportText 1 for bounty 8 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter2/report5.jpg',22),(8,'testHunter1','This is report Text 1 for bounty 8 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter1/report3.jpg',23),(8,'testHunter1','This is report Text 2 for bounty 8 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall2/_reports/_testHunter1/report4.jpg',24),(9,'testHunter2','This is reportText 1 for bounty 9 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter2/report3.jpg',25),(9,'testHunter2','This is report Text 2 for bounty 9 by testHunter2','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter2/report4.jpg',26),(9,'testHunter1','This is report Text 1 for bounty 9 by testHunter1','0000-00-00 00:00:00','_images/_bounties/_testMarshall3/_reports/_testHunter1/report5.jpg',27);
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unpaidreport`
--

DROP TABLE IF EXISTS `unpaidreport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unpaidreport` (
  `reportID` int(10) unsigned NOT NULL,
  `dateAssessed` datetime NOT NULL,
  `message` mediumtext NOT NULL,
  PRIMARY KEY (`reportID`),
  UNIQUE KEY `reportID_UNIQUE` (`reportID`),
  CONSTRAINT `fk_unpaidReport_Report1` FOREIGN KEY (`reportID`) REFERENCES `report` (`reportID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unpaidreport`
--

LOCK TABLES `unpaidreport` WRITE;
/*!40000 ALTER TABLE `unpaidreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `unpaidreport` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-30 21:38:52