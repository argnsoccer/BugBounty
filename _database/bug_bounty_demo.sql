-- MySQL dump 10.15  Distrib 10.0.17-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: bug_bounty_demo
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
CREATE SCHEMA IF NOT EXISTS `bug_bounty_demo` DEFAULT CHARACTER SET utf8 ;
USE `bug_bounty_demo` ;


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
  `rssLink` VARCHAR(100) NULL COMMENT '',
  `rssCreated` TINYINT(1) NOT NULL COMMENT '',
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
(1,'SMUHunter1911','SMUHunter1911@gmail.com','SMUHunter1911','2015-11-29 21:44:18',1,NULL,'hunter',0,'0000-00-00 00:00:00', '_images/_profiles/_testHunter1/default_profile.png', 'Mark Fontenot', 'paypal', 0),
(2,'ProHunter7','ProHunter7@gmail.com','ProHunter7','2015-11-29 21:44:18',1,NULL,'hunter',0,'0000-00-00 00:00:00', '_images/_profiles/_testHunter2/default_profile.png', 'Mike Jones', 'paypal', 0),
(3,'ESPNMarshall4','ESPNMarshall4@gmail.com','ESPNMarshall4','2015-11-29 21:44:18',1,NULL,'marshal',0,'0000-00-00 00:00:00', '_images/_profiles/_testMarshall1/default_profile.png', 'John Wayne', 'paypal', 0),
(4,'SMUMarshall1911','SMUMarshall1911@gmail.com','SMUMarshall1911','2015-11-29 21:44:18',1,NULL,'marshal',0,'0000-00-00 00:00:00', '_images/_profiles/_testMarshall1/default_profile.png', 'Clint Eastwood', 'paypal', 0),
(5,'DMNMarshall3','DMNMarshall3@gmail.com','DMNMarshall3','2015-11-29 21:44:18',1,NULL,'marshal',0,'0000-00-00 00:00:00', '_images/_profiles/_testMarshall1/default_profile.png', 'Doc Holiday', 'paypal', 0);
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
  CONSTRAINT `fk_BountyPool_Marshall1` FOREIGN KEY (`bountyMarshallID`) REFERENCES `Marshall` (`marshallID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BountyPool`
--

LOCK TABLES `BountyPool` WRITE;
/*!40000 ALTER TABLE `BountyPool` DISABLE KEYS */;
INSERT INTO `BountyPool` VALUES
(1,'2015-11-29 21:44:19','1000','2016-01-01 00:00:00',3,'http://espn.go.com/mens-college-basketball/team/_/id/2567/smu-mustangs','_images/_bounties/_testMarshal1/bounty1.png','Video player on team pages breaks.','Please find the conditions that cause our video player to crash.', 'ESPN Video Player'),
(2,'2015-11-29 21:44:19','250','2016-01-01 00:00:00',4,'http://www.smu.edu','_images/_bounties/_testMarshal2/bounty2.png','The give now button has a strange bug.','The give now button tends to insert four zeros onto the amount given.', 'Give Now Button'),
(3,'2015-11-29 21:44:19','750','2016-09-08 00:00:00',5,'http://www.dallasnews.com/','_images/_bounties/_testMarshal3/bounty3.png','Our website displays the news from yesterday.','All of our news reports show up a day later than intended.', 'Live Updates'),
(4,'2015-11-29 21:44:19','5000','2016-09-08 00:00:00',3,'http://espn.go.com/mens-college-basketball/scoreboard','_images/_bounties/_testMarshal4/bounty4.png','The scores are slightly off from real time.','The score in the basketball game between SMU and TCU are off by 20 points each.', 'Live Update Feed is Incorrect'),
(5,'2015-11-29 21:44:19','1300','2016-09-08 00:00:00',4,'http://www.smumustangs.com/sports/m-footbl/smu-m-footbl-body.html','_images/_bounties/_testMarshal5/bounty5.png','The central image fails to show.','The page loads fine, but the center image sometimes fails to load.', 'Image Link Broken'),
(6,'2015-11-29 21:44:19','6750','2016-01-01 00:00:00',5,'http://www.dallasnews.com/weather/','_images/_bounties/_testMarshal6/bounty6.png','Weather page links to wrong location.','The weather page shows the weather in Fort Worth, not Dallas.', 'Weather Page'),
(7,'2015-11-29 21:44:19','2250','2016-01-01 00:00:00',3,'http://espn.go.com/nfl/','_images/_bounties/_testMarshal7/bounty7.png','The links to individual teams link to incorrect pages.','When a user clicks on a link for their favorite team, it takes them to the incorrect page.', 'Team Links'),
(8,'2015-11-29 21:44:19','400','2016-01-01 00:00:00',4,'http://www.smu.edu/BusinessFinance/CampusServices/ParkingAndIDcardServices','_images/_bounties/_testMarshal8/bounty8.png','Link sends users to wrong webpage.','Instead of sending users to get more information about the DART, it sends them to the donations page.', 'DART Pass Link'),
(9,'2015-11-29 21:44:19','3200','2016-01-01 00:00:00',5,'http://store.dallasnews.com/','_images/_bounties/_testMarshal9/bounty9.png','Prices of items are incorrect.','Some items in the store are given the wrong price value.', 'Store Page Prices');
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

LOCK TABLES `Marshall` WRITE;
/*!40000 ALTER TABLE `marshall` DISABLE KEYS */;
INSERT INTO `Marshall` (marshallID,rankingTotal,numRankings,rankingAvg,description,company) VALUES
(3,0,33,4,'This is the official page for all bounties posted by ESPN','ESPN'),
(4,0,7,5,'SMU is a university located in Dallas, Texas. New bounties posted frequently.','Southern Methodist University'),
(5,0,15,4,'Official marshall page for the Dallas Morning News.','Dallas Morning News');
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
  CONSTRAINT `fk_Message_Account1` FOREIGN KEY (`sender`) REFERENCES `Account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_Account2` FOREIGN KEY (`recipient`) REFERENCES `Account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_BountyPool1` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
-- Table structure for table `paidreport`
--

-- CREATE TABLE IF NOT EXISTS `paidReport` (
--   `reportID` int(10) unsigned NOT NULL,
--   `paidAmount` varchar(10) NOT NULL,
--   `datePaid` datetime NOT NULL,
--   `message` mediumtext NOT NULL,
--   `publish` int(1) NOT NULL,
--   PRIMARY KEY (`reportID`),
--   UNIQUE KEY `reportID_UNIQUE` (`reportID`),
--   CONSTRAINT `fk_paidReport_Report1` FOREIGN KEY (`reportID`) REFERENCES `Report` (`reportID`) ON DELETE NO ACTION ON UPDATE NO ACTION
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- /*!40101 SET character_set_client = @saved_cs_client */;

-- --
-- -- Dumping data for table `paidreport`
-- --

-- INSERT INTO paidReport (reportID, paidAmount, message, publish) VALUES (5,25,'Thank you!', 0);
-- INSERT INTO paidReport (reportID, paidAmount, message, publish) VALUES (25,100,'We need to hire someone like you.', 0);
-- INSERT INTO paidReport (reportID, paidAmount, message, publish) VALUES (15,75,'Fantastic', 0);
-- INSERT INTO paidReport (reportID, paidAmount, message, publish) VALUES (21,200,'Great work!', 0);

-- LOCK TABLES `paidReport` WRITE;
-- /*!40000 ALTER TABLE `paidreport` DISABLE KEYS */;
-- /*!40000 ALTER TABLE `paidreport` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `preferredbounties`
--


CREATE TABLE IF NOT EXISTS`PreferredBounties` (
  `bountyID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bountyID`),
  UNIQUE KEY `bountyID_UNIQUE` (`bountyID`),
  CONSTRAINT `fk_PreferredBounties_BountyPool1` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE NO ACTION ON UPDATE NO ACTION
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

INSERT INTO MessageOfDay (accountType,message,dateMade) Values ("hunter","Good luck hunting",NOW());
INSERT INTO MessageOfDay (accountType,message,dateMade) Values ("marshall","Its a great day to make a bounty!",NOW());

--
-- Dumping data for table `report`
--

LOCK TABLES `Report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `Report` (bountyID, username, description, dateSubmitted, filePath, reportID, paidAmount, datePaid, message, paid, errorName) VALUES
(1,'SMUHunter1911','This website works fine for me.','2015-11-30 20:11:11','_images/_bounties/_testMarshall1/_reports/_testHunter1/report1.jpg',1, -1, NULL, '', false, 'report1'),
(1,'ProHunter7','Your videos only seem to work half the time.','2015-11-30 20:22:44','_images/_bounties/_testMarshall1/_reports/_testHunter2/report1.jpg',2, 10, '2015-12-10 00::00::00', 'Great work!', true, 'report2'),
(1,'ProHunter7','Ignore my previous report, I disconnected to from the internet while the video was loading.','2015-11-30 20:18:33','_images/_bounties/_testMarshall1/_reports/_testHunter2/report2.jpg',3, 5, '2015-12-10 00::00::00', 'Well done!', false, 'report3'),
(2,'SMUHunter1911','Every time I click I donate to SMU.','2015-11-30 20:59:59','_images/_bounties/_testMarshall2/_reports/_testHunter1/report1.jpg',4, 100, '2015-3-10 00::00::00', 'Fantastic work!', false, 'report4'),
(2,'ProHunter7','I donated $1000000 by accident.','2015-11-30 21:45:33','_images/_bounties/_testMarshall2/_reports/_testHunter2/report1.jpg',5, -1, NULL, '', false, 'report5'),
(2,'ProHunter7','Your website took all my money!','2015-11-30 22:19:23','_images/_bounties/_testMarshall2/_reports/_testHunter2/report2.jpg',6, -1, NULL, '', false, 'report6'),
(3,'SMUHunter1911','All the links I see here I saw yesterday on The Daily Campus website.','2015-11-30 18:19:20','_images/_bounties/_testMarshall3/_reports/_testHunter1/report1.jpg',7, 1, '2014-10-29 00::00::00', 'We were looking for something more.', false, 'report7'),
(3,'ProHunter7','When I click on trending, it gives me what was trending this day last year.','2015-11-30 20:05:33','_images/_bounties/_testMarshall3/_reports/_testHunter2/report1.jpg',8, 500, '2015-9-09 00::00::00', 'Great find.', false, 'report8'),
(3,'SMUHunter1911','I can not find any articles from today.','2015-11-30 21:01:13','_images/_bounties/_testMarshall3/_reports/_testHunter1/report2.jpg',9, -1, NULL, '', false, 'report9'),
(4,'ProHunter7','Every live score I see is at least five minutes behind.','2015-11-30 20:16:33','_images/_bounties/_testMarshall1/_reports/_testHunter2/report3.jpg',10, 500, '2015-9-09 00::00::00', 'You are a master hunter!', false, 'report10'),
(4,'SMUHunter1911','The score on the Kansas vs Duke game are flipped!','2015-11-30 20:17:33','_images/_bounties/_testMarshall1/_reports/_testHunter1/report2.jpg',11, 500, '2015-9-09 00::00::00', 'We need more hunters like you.', false, 'report11'),
(4,'SMUHunter1911','It is faster to wait for the newspaper to get a score update.','2015-11-30 20:18:32','_images/_bounties/_testMarshall1/_reports/_testHunter1/report3.jpg',12, 500, '2015-9-09 00::00::00', 'Outstanding job!', false, 'report12'),
(5,'ProHunter7','The image loads fine in Google Chrome.','2015-11-30 20:11:23','_images/_bounties/_testMarshall2/_reports/_testHunter2/report3.jpg',13, 500, '2015-9-09 00::00::00', 'Great!', false, 'report13'),
(5,'SMUHunter1911','This is a great image! I love your website!!','2015-11-30 20:48:11','_images/_bounties/_testMarshall2/_reports/_testHunter1/report2.jpg',14, 500, '2015-9-09 00::00::00', 'Amazing!', false, 'report14'),
(5,'ProHunter7','Okay, the image does not load in Internet Explorer. It is probably their problem, not yours.','2015-11-30 21:34:31','_images/_bounties/_testMarshall2/_reports/_testHunter2/report4.jpg',15, 500, '2015-9-09 00::00::00', 'This is exactly what we needed.', false, 'report15'),
(6,'ProHunter7','Not only is this the weather in Fort Worth, it is the weather from yesterday!','2015-11-30 19:12:33','_images/_bounties/_testMarshall3/_reports/_testHunter2/report2.jpg',16, 500, '2015-9-09 00::00::00', 'Way to go!', false, 'report16'),
(6,'SMUHunter1911','I am currently in Fort Worth, so this works fine for me.','2015-11-30 20:18:33','_images/_bounties/_testMarshall3/_reports/_testHunter1/report3.jpg',17, -1, NULL, '', false, 'report17'),
(6,'SMUHunter1911','Now that I am back in Dallas, this is a much larger problem.','2015-11-30 20:38:33','_images/_bounties/_testMarshall3/_reports/_testHunter1/report4.jpg',18, -1, NULL, '', false, 'report18'),
(7,'ProHunter7','Why does every team link to the Dallas Cowboys??','2015-11-30 18:28:38','_images/_bounties/_testMarshall1/_reports/_testHunter2/report4.jpg',19, 10, '2015-12-10 00::00::00', 'Well done.', true, 'report19'),
(7,'SMUHunter1911','I LOVE THE COWBOYS. DEZ CAUGHT IT.','2015-11-30 20:18:33','_images/_bounties/_testMarshall1/_reports/_testHunter1/report4.jpg',20, 10, '2015-12-10 00::00::00', 'Great!', true, 'report20'),
(7,'ProHunter7','Oh, it seems to link to whomever you currently have as your favorite team.','2015-11-30 21:13:43','_images/_bounties/_testMarshall1/_reports/_testHunter2/report5.jpg',21, -1, NULL, '', false, 'report21'),
(8,'ProHunter7','I really think you guys did this one on purpose.','2015-11-30 20:08:23','_images/_bounties/_testMarshall2/_reports/_testHunter2/report5.jpg',22, 5, '2015-12-10 00::00::00', 'Thanks for your input.', true, 'report22'),
(8,'SMUHunter1911','That is really weird, every click seems to donate more and more.','2015-11-30 20:48:23','_images/_bounties/_testMarshall2/_reports/_testHunter1/report3.jpg',23, -1, NULL, '', false, 'report23'),
(8,'SMUHunter1911','I just lost my life savings.','2015-11-30 22:18:33','_images/_bounties/_testMarshall2/_reports/_testHunter1/report4.jpg',24, -1, NULL, '', false, 'report24'),
(9,'ProHunter7','The prices seem off by one, probably just indexed wrong.','2015-11-30 20:18:33','_images/_bounties/_testMarshall3/_reports/_testHunter2/report3.jpg',25, 10, '2015-12-10 00::00::00', 'Nice!', false, 'report25'),
(9,'ProHunter7','I just bought a 24K gold watch for $5! Great deal!','2015-11-30 20:28:33','_images/_bounties/_testMarshall3/_reports/_testHunter2/report4.jpg',26, -1, NULL, '', false, 'report26'),
(9,'SMUHunter1911','The prices also seem to change every time I reload the page.','2015-11-30 23:58:39','_images/_bounties/_testMarshall3/_reports/_testHunter1/report5.jpg',27, 5, '2015-12-10 00::00::00', 'Thank you!', false, 'report27');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unpaidreport`
--


CREATE TABLE IF NOT EXISTS `Subscription` (
  `subscriptionID` int(10) unsigned NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `rssLink` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`subscriptionID`),
  UNIQUE KEY `subscriptionID_UNIQUE` (`subscriptionID`),
  CONSTRAINT `fk_subscription_account` FOREIGN KEY (`userID`) REFERENCES `Account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unpaidreport`
--



CREATE TABLE IF NOT EXISTS `Transactions` (
  `transactionID` VARCHAR(8) NOT NULL,
  `hunterID` int(10) unsigned NOT NULL,
  `marshallID` int(10) unsigned NOT NULL,
  `amount` int(10) NOT NULL,
  `paymentInfo` mediumtext NOT NULL,
  `reportID` int(10) unsigned NOT NULL,
  `bountyID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`transactionID`),
  UNIQUE KEY `transactionID_UNIQUE` (`transactionID`),
  KEY `fk_hunter_Account` (`hunterID`),
  KEY `fk_marshall_Marshall` (`marshallID`),
  KEY `fk_reportID_Report` (`reportID`),
  KEY `fk_bounty_BountyPool` (`bountyID`),
  CONSTRAINT `fk_hunter_Account` FOREIGN KEY (`hunterID`) REFERENCES `Account` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_marshall_Marshall` FOREIGN KEY (`marshallID`) REFERENCES `Marshall` (`marshallID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reportID_Report` FOREIGN KEY (`reportID`) REFERENCES `Report` (`reportID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bounty_BountyPool` FOREIGN KEY (`bountyID`) REFERENCES `BountyPool` (`poolID`) ON DELETE NO ACTION ON UPDATE NO ACTION

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
