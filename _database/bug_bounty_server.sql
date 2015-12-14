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
CREATE SCHEMA IF NOT EXISTS `bug_bounty_server` DEFAULT CHARACTER SET utf8 ;
USE `bug_bounty_server` ;


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
  `rssLink` VARCHAR(255) NULL COMMENT '',
  `rssCreated` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`marshallID`),
  UNIQUE KEY `userID_UNIQUE` (`marshallID`),
  CONSTRAINT `fk_Sheriff_Account` FOREIGN KEY (`marshallID`) REFERENCES `Account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marshall`
--



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



--
-- Table structure for table `unpaidreport`
--


CREATE TABLE IF NOT EXISTS `Subscription` (
  `subscriptionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(10) UNSIGNED NOT NULL,
  `rssLink` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`userID`, `rssLink`),
  UNIQUE KEY `subscriptionID_UNIQUE` (`subscriptionID`),
  CONSTRAINT `fk_subscription_account` FOREIGN KEY (`userID`) REFERENCES `Account` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


CREATE TABLE IF NOT EXISTS `Transactions` (
  `transactionID` VARCHAR(8) NOT NULL,
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
