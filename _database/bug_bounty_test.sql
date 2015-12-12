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
-- Table structure for table `Account`
--
CREATE SCHEMA IF NOT EXISTS `bug_bounty_test` DEFAULT CHARACTER SET utf8 ;
USE `bug_bounty_test` ;


/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE IF NOT EXISTS `Account` (
  `userID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `username` VARCHAR(20) NOT NULL COMMENT '',
  `email` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(16) NOT NULL COMMENT '',
  `dateCreated` DATETIME NOT NULL COMMENT '',
  `activated` TINYINT(1) NULL DEFAULT NULL COMMENT '',
  `dateDeactivated` DATETIME NULL DEFAULT NULL COMMENT '',
  `accountType` VARCHAR(10) NOT NULL COMMENT '',
  `loggedIn` TINYINT(1) NOT NULL COMMENT '',
  `dateOfLastActivity` DATETIME NOT NULL COMMENT '',
  `imageLoc` mediumtext NULL COMMENT '',
  `name` VARCHAR(40) NOT NULL COMMENT '',
  `paymentType` VARCHAR(15) NOT NULL COMMENT '',
  `moneyCollected` float(12) NOT NULL COMMENT '',
  PRIMARY KEY (`userID`)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `userID_UNIQUE` (`userID` ASC)  COMMENT '')
ENGINE = InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
INSERT INTO `Account` (userID, username, email,password,dateCreated,activated,dateDeactivated,accountType,loggedIn,dateOfLastActivity,imageLoc, name, paymentType, moneyCollected) VALUES
(1,'testHunter1','testHunter1@me.com','testHunter1','2015-10-29 21:44:18',1,NULL,'hunter',0,'0000-00-00 00:00:00', '/_images/_profiles/_testHunter1/profile.png', 'John Smith', 'paypal', 0),
(2,'testHunter2','testHunter2@me.com','testHunter2','2015-10-29 21:44:18',1,NULL,'hunter',0,'0000-00-00 00:00:00', '/_images/_profiles/_testHunter2/profile.png', 'Mike Jones', 'paypal', 0),
(3,'testMarshall1','testMarshall1@me.com','testMarshall1','2015-10-29 21:44:18',1,NULL,'marshal',0,'0000-00-00 00:00:00', '/_images/_profiles/_testMarshall1/profile.png', 'John Wayne', 'paypal', 0),
(4,'testMarshall2','testMarshall2@me.com','testMarshall2','2015-10-29 21:44:18',1,NULL,'marshal',0,'0000-00-00 00:00:00', '/_images/_profiles/_testMarshall1/profile.png', 'Clint Eastwood', 'paypal', 0),
(5,'testMarshall3','testMarshall3@me.com','testMarshall3','2015-10-29 21:44:18',1,NULL,'marshal',0,'0000-00-00 00:00:00', '/_images/_profiles/_testMarshall1/profile.png', 'Doc Holiday', 'paypal', 0);
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BountyPool`
--


CREATE TABLE IF NOT EXISTS `BountyPool` (
  `poolID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateCreated` datetime NOT NULL,
  `payoutPool` varchar(10) NOT NULL,
  `dateEnding` datetime NOT NULL,
  `bountyMarshallID` int(10) unsigned NOT NULL,
  `bountyLink` varchar(45) NOT NULL,
  `imageLoc` varchar(45) DEFAULT NULL,
  `lineDescription` tinytext,
  `fullDescription` mediumtext,
  `bountyName` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`poolID`),
  UNIQUE KEY `poolID_UNIQUE` (`poolID`),
  UNIQUE INDEX `bountyName_UNIQUE` (`bountyName` ASC)  COMMENT '',
  KEY `fk_BountyPool_Marshall1` (`bountyMarshallID`),
  CONSTRAINT `fk_BountyPool_Marshall1` FOREIGN KEY (`bountyMarshallID`) REFERENCES `Marshall` (`marshallID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BountyPool`
--

LOCK TABLES `BountyPool` WRITE;
/*!40000 ALTER TABLE `BountyPool` DISABLE KEYS */;
INSERT INTO `BountyPool` VALUES
(1,'2015-10-29 21:44:19','1','2020-01-01 00:00:00',3,'http://www.smu.edu','/_images/_bounties/_testMarshal1/bounty1.png','lineDesc1','fullDescription1', 'bounty1'),
(2,'2015-10-29 21:44:19','2','2020-01-01 00:00:00',4,'http://www.smu.edu','/_images/_bounties/_testMarshal2/bounty2.png','lineDesc2','fullDescription2', 'bounty2'),
(3,'2015-10-29 21:44:19','3','2015-09-08 00:00:00',5,'http://www.smu.edu','/_images/_bounties/_testMarshal3/bounty3.png','lineDesc3','fullDescription3', 'bounty3'),
(4,'2015-10-29 21:44:19','4','2015-09-08 00:00:00',3,'http://www.smu.edu','/_images/_bounties/_testMarshal4/bounty4.png','lineDesc4','fullDescription4', 'bounty4'),
(5,'2015-10-29 21:44:19','5','2015-09-08 00:00:00',4,'http://www.smu.edu','/_images/_bounties/_testMarshal5/bounty5.png','lineDesc5','fullDescription5', 'bounty5'),
(6,'2015-10-29 21:44:19','6','2020-01-01 00:00:00',5,'http://www.smu.edu','/_images/_bounties/_testMarshal6/bounty6.png','lineDesc6','fullDescription6', 'bounty6'),
(7,'2015-10-29 21:44:19','7','2020-01-01 00:00:00',3,'http://www.smu.edu','/_images/_bounties/_testMarshal7/bounty7.png','lineDesc7','fullDescription7', 'bounty7'),
(8,'2015-10-29 21:44:19','8','2020-01-01 00:00:00',4,'http://www.smu.edu','/_images/_bounties/_testMarshal8/bounty8.png','lineDesc8','fullDescription8', 'bounty8'),
(9,'2015-10-29 21:44:19','9','2015-01-01 00:00:00',5,'http://www.smu.edu','/_images/_bounties/_testMarshal9/bounty9.png','lineDesc9','fullDescription9', 'bounty9');
/*!40000 ALTER TABLE `BountyPool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marshall`
--


CREATE TABLE IF NOT EXISTS `Marshall` (
  `marshallID` int(10) unsigned NOT NULL,
  `rankingTotal` int(11) NOT NULL,
  `numRankings` int(11) NOT NULL,
  `rankingAvg` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `company` varchar(25) NOT NULL,
  `rssLink` VARCHAR(100) NULL COMMENT '',
  `rssCreated` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`marshallID`),
  UNIQUE KEY `userID_UNIQUE` (`marshallID`),
  CONSTRAINT `fk_Sheriff_Account` FOREIGN KEY (`marshallID`) REFERENCES `Account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marshall`
--

LOCK TABLES `Marshall` WRITE;
/*!40000 ALTER TABLE `marshall` DISABLE KEYS */;
INSERT INTO `Marshall` VALUES
(3,0,0,0,'This is marshallDescription1','company1', 'http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/_rss/_profiles/_testMarshall1/rss_testMarshall1.xml', 1),
(4,0,0,0,'This is marshallDescription2','company2', 'http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/_rss/_profiles/_testMarshall1/rss_testMarshall1.xml', 1),
(5,0,0,0,'This is marshallDescription3','company3', NULL, 0);
/*!40000 ALTER TABLE `marshall` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--


CREATE TABLE IF NOT EXISTS `Message` (
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
  CONSTRAINT `fk_Message_Account1` FOREIGN KEY (`sender`) REFERENCES `Account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Message_Account2` FOREIGN KEY (`recipient`) REFERENCES `Account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Message_BountyPool1` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferredbounties`
--


CREATE TABLE IF NOT EXISTS`PreferredBounties` (
  `bountyID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bountyID`),
  UNIQUE KEY `bountyID_UNIQUE` (`bountyID`),
  CONSTRAINT `fk_PreferredBounties_BountyPool1` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferredbounties`
--

LOCK TABLES `PreferredBounties` WRITE;
/*!40000 ALTER TABLE `preferredbounties` DISABLE KEYS */;
INSERT INTO `PreferredBounties` VALUES (1),(2),(3),(4),(5),(6),(7),(8),(9);
/*!40000 ALTER TABLE `preferredbounties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--


CREATE TABLE IF NOT EXISTS `Report` (
  `bountyID` int(10) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `description` longtext,
  `dateSubmitted` datetime NOT NULL,
  `imageLoc` varchar(100),
  `link` mediumtext,
  `pathToError` mediumtext NOT NULL,
  `filePath` mediumtext,
  `errorName` varchar(30),
  `reportID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paidAmount` float(12) NOT NULL,
  `datePaid` datetime NULL,
  `message` mediumtext NOT NULL,
  `paid` BOOLEAN NOT NULL,
  PRIMARY KEY (`reportID`),
  UNIQUE KEY `reportID_UNIQUE` (`reportID`),
  KEY `fk_Report_BountyPool2` (`bountyID`),
  KEY `fk_Report_Account1` (`username`),
  CONSTRAINT `fk_Report_Account1` FOREIGN KEY (`username`) REFERENCES `Account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Report_BountyPool2` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


CREATE TABLE IF NOT EXISTS `MessageOfDay` (
  `messageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountType` varchar(10) NOT NULL,
  `message` mediumtext NOT NULL,
  `dateMade` datetime NOT NULL,
  PRIMARY KEY (`messageID`),
  UNIQUE KEY `messageID_UNIQUE` (`messageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO MessageOfDay (accountType,message,dateMade) Values ("Hunter","Good luck hunting",NOW());
INSERT INTO MessageOfDay (accountType,message,dateMade) Values ("Marshall","Its a great day to make a bounty!",NOW());

--
-- Dumping data for table `report`
--

LOCK TABLES `Report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `Report` (bountyID, username, description, dateSubmitted, filePath, reportID, paidAmount, datePaid, message, paid, errorName) VALUES
(1,'testHunter1','This is report Text 1 for bounty 1 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter1/report1.jpg',1, -1, NULL, '', false, 'report1'),
(1,'testHunter2','This is report Text 1 for bounty 1 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter2/report1.jpg',2, 10, '2015-12-10 00::00::00', 'Good jorb!', true, 'report2'),
(1,'testHunter2','This is report Text 2 for bounty 1 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter2/report2.jpg',3, 5, '2015-12-10 00::00::00', 'A jorb well done!', false, 'report3'),
(2,'testHunter1','This is reportText 1 for bounty 2 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter1/report1.jpg',4, 100, '2015-3-10 00::00::00', 'Absolutely marvelous, Darling', false, 'report4'),
(2,'testHunter2','This is report Text 1 for bounty 2 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter2/report1.jpg',5, -1, NULL, '', false, 'report5'),
(2,'testHunter2','This is report Text 2 for bounty 2 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter2/report2.jpg',6, -1, NULL, '', false, 'report6'),
(3,'testHunter1','This is report Text 1  for bounty 3 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter1/report1.jpg',7, 1, '2014-10-29 00::00::00', 'Paltry Peasant.', false, 'report7'),
(3,'testHunter2','This is report Text 1 for bounty 3 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter2/report1.jpg',8, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report8'),
(3,'testHunter1','This is report Text 2 for bounty 3 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter1/report2.jpg',9, -1, NULL, '', false, 'report9'),
(4,'testHunter2','This is reportText 1 for bounty 4 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter2/report3.jpg',10, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report10'),
(4,'testHunter1','This is report Text 1 for bounty 4 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter1/report2.jpg',11, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report11'),
(4,'testHunter1','This is report Text 2 for bounty 4 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter1/report3.jpg',12, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report12'),
(5,'testHunter2','This is report Text 1 for bounty 5 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter2/report3.jpg',13, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report13'),
(5,'testHunter1','This is report Text 1 for bounty 5 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter1/report2.jpg',14, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report14'),
(5,'testHunter2','This is report Text 2 for bounty 5 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter2/report4.jpg',15, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report15'),
(6,'testHunter2','This is reportText 1 for bounty 6 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter2/report2.jpg',16, 500, '2015-9-09 00::00::00', 'Ayy lmao', false, 'report16'),
(6,'testHunter1','This is report Text 1 for bounty 6 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter1/report3.jpg',17, -1, NULL, '', false, 'report17'),
(6,'testHunter1','This is report Text 2 for bounty 6 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter1/report4.jpg',18, -1, NULL, '', false, 'report18'),
(7,'testHunter2','This is reportText 1 for bounty 7 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter2/report4.jpg',19, 10, '2015-12-10 00::00::00', 'Good jorb!', true, 'report19'),
(7,'testHunter1','This is report Text 1 for bounty 7 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter1/report4.jpg',20, 10, '2015-12-10 00::00::00', 'Good jorb!', true, 'report20'),
(7,'testHunter2','This is report Text 2 for bounty 7 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall1/_reports/_testHunter2/report5.jpg',21, -1, NULL, '', false, 'report21'),
(8,'testHunter2','This is reportText 1 for bounty 8 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter2/report5.jpg',22, 5, '2015-12-10 00::00::00', 'A jorb well done!', true, 'report22'),
(8,'testHunter1','This is report Text 1 for bounty 8 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter1/report3.jpg',23, -1, NULL, '', false, 'report23'),
(8,'testHunter1','This is report Text 2 for bounty 8 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall2/_reports/_testHunter1/report4.jpg',24, -1, NULL, '', false, 'report24'),
(9,'testHunter2','This is reportText 1 for bounty 9 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter2/report3.jpg',25, 10, '2015-12-10 00::00::00', 'Good jorb!', false, 'report25'),
(9,'testHunter2','This is report Text 2 for bounty 9 by testHunter2','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter2/report4.jpg',26, -1, NULL, '', false, 'report26'),
(9,'testHunter1','This is report Text 1 for bounty 9 by testHunter1','0000-00-00 00:00:00','/_images/_bounties/_testMarshall3/_reports/_testHunter1/report5.jpg',27, 5, '2015-12-10 00::00::00', 'A jorb well done!', false, 'report27');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unpaidreport`
--


CREATE TABLE IF NOT EXISTS `Subscription` (
  `subscriptionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) UNSIGNED NOT NULL,
  `rssLink` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`subscriptionID`),
  UNIQUE KEY `subscriptionID_UNIQUE` (`subscriptionID`),
  CONSTRAINT `fk_subscription_account` FOREIGN KEY (`userID`) REFERENCES `Account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


CREATE TABLE IF NOT EXISTS `Transactions` (
  `transactionID` VARCHAR(8) NOT NULL AUTO_INCREMENT,
  `hunterUsername` VARCHAR(20) NOT NULL,
  `marshalUsername` VARCHAR(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `paymentInfo` mediumtext NOT NULL,
  `reportID` int(10) unsigned NOT NULL,
  `bountyID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`transactionID`),
  UNIQUE KEY `transactionID_UNIQUE` (`transactionID`),
  KEY `fk_hunter_Account` (`hunterUsername`),
  KEY `fk_marshal_Account` (`marshalUsername`),
  KEY `fk_reportID_Report` (`reportID`),
  KEY `fk_bounty_BountyPool` (`bountyID`),
  CONSTRAINT `fk_hunter_Account` FOREIGN KEY (`hunterUsername`) REFERENCES `Account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_marshal_Account` FOREIGN KEY (`marshalUsername`) REFERENCES `Account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_reportID_Report` FOREIGN KEY (`reportID`) REFERENCES `Report` (`reportID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bounty_BountyPool` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-30 21:38:52
