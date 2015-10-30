-- MySQL Script generated by MySQL Workbench
-- 10/29/15 19:56:06
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema bug_bounty_test
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bug_bounty_test
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bug_bounty_test` DEFAULT CHARACTER SET utf8 ;
USE `bug_bounty_test` ;

-- -----------------------------------------------------
-- Table `bug_bounty_test`.`Account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`Account` (
  `userID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `username` VARCHAR(20) NOT NULL COMMENT '',
  `email` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(16) NOT NULL COMMENT '',
  `dateCreated` DATETIME NOT NULL COMMENT '',
  `activated` TINYINT(1) NULL DEFAULT NULL COMMENT '',
  `dateDeactivated` DATETIME NULL DEFAULT NULL COMMENT '',
  `accountType` VARCHAR(10) NOT NULL COMMENT '',
  `loggedIn` TINYINT(1) NULL COMMENT '',
  `dateOfLastActivity` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`userID`)  COMMENT '',
  UNIQUE INDEX `username_UNIQUE` (`username` ASC)  COMMENT '',
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)  COMMENT '',
  UNIQUE INDEX `userID_UNIQUE` (`userID` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`Marshall`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`Marshall` (
  `marshallID` INT UNSIGNED NOT NULL COMMENT '',
  `rankingTotal` INT NOT NULL COMMENT '',
  `numRankings` INT NOT NULL COMMENT '',
  `rankingAvg` INT NOT NULL COMMENT '',
  `description` VARCHAR(200) NOT NULL COMMENT '',
  `imageLoc` VARCHAR(45) NOT NULL COMMENT '',
  `company` VARCHAR(25) NOT NULL COMMENT '',
  UNIQUE INDEX `userID_UNIQUE` (`marshallID` ASC)  COMMENT '',
  PRIMARY KEY (`marshallID`)  COMMENT '',
  CONSTRAINT `fk_Sheriff_Account`
    FOREIGN KEY (`marshallID`)
    REFERENCES `bug_bounty_test`.`Account` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`BountyPool`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`BountyPool` (
  `poolID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `dateCreated` DATETIME NOT NULL COMMENT '',
  `payoutPool` VARCHAR(10) NOT NULL COMMENT '',
  `dateEnding` DATETIME NOT NULL COMMENT '',
  `bountyMarshallID` INT UNSIGNED NOT NULL COMMENT '',
  `bountyLink` VARCHAR(45) NOT NULL COMMENT '',
  `imageLoc` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `lineDescription` TINYTEXT NULL DEFAULT NULL COMMENT '',
  `fullDescription` MEDIUMTEXT NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`poolID`)  COMMENT '',
  UNIQUE INDEX `poolID_UNIQUE` (`poolID` ASC)  COMMENT '',
  CONSTRAINT `fk_BountyPool_Marshall1`
    FOREIGN KEY (`bountyMarshallID`)
    REFERENCES `bug_bounty_test`.`Marshall` (`marshallID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`Report`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`Report` (
  `bountyID` INT UNSIGNED NOT NULL COMMENT '',
  `username` VARCHAR(20) NOT NULL COMMENT '',
  `ReportText` MEDIUMTEXT NULL DEFAULT NULL COMMENT '',
  `dateSubmitted` DATETIME NOT NULL COMMENT '',
  `imageLoc` VARCHAR(100) NOT NULL COMMENT '',
  `reportID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  PRIMARY KEY (`reportID`)  COMMENT '',
  UNIQUE INDEX `reportID_UNIQUE` (`reportID` ASC)  COMMENT '',
  CONSTRAINT `fk_Report_BountyPool2`
    FOREIGN KEY (`bountyID`)
    REFERENCES `bug_bounty_test`.`BountyPool` (`poolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Report_Account1`
    FOREIGN KEY (`username`)
    REFERENCES `bug_bounty_test`.`Account` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`Message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`Message` (
  `messageID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `sender` INT UNSIGNED NOT NULL COMMENT '',
  `recipient` INT UNSIGNED NOT NULL COMMENT '',
  `messageText` LONGTEXT NULL DEFAULT NULL COMMENT '',
  `bountyID` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`messageID`)  COMMENT '',
  UNIQUE INDEX `messageID_UNIQUE` (`messageID` ASC)  COMMENT '',
  UNIQUE INDEX `recipient_UNIQUE` (`recipient` ASC)  COMMENT '',
  UNIQUE INDEX `sender_UNIQUE` (`sender` ASC)  COMMENT '',
  UNIQUE INDEX `bountyID_UNIQUE` (`bountyID` ASC)  COMMENT '',
  CONSTRAINT `fk_Message_Account1`
    FOREIGN KEY (`sender`)
    REFERENCES `bug_bounty_test`.`Account` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_Account2`
    FOREIGN KEY (`recipient`)
    REFERENCES `bug_bounty_test`.`Account` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Message_BountyPool1`
    FOREIGN KEY (`bountyID`)
    REFERENCES `bug_bounty_test`.`BountyPool` (`poolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`Subscription`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`Subscription` (
  `subID` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '',
  `subMarshallID` INT UNSIGNED NOT NULL COMMENT '',
  `subHunterID` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`subID`)  COMMENT '',
  UNIQUE INDEX `subID_UNIQUE` (`subID` ASC)  COMMENT '',
  UNIQUE INDEX `sheriffID_UNIQUE` (`subMarshallID` ASC)  COMMENT '',
  UNIQUE INDEX `subHunterID_UNIQUE` (`subHunterID` ASC)  COMMENT '',
  CONSTRAINT `fk_Subscription_Sheriff1`
    FOREIGN KEY (`subMarshallID`)
    REFERENCES `bug_bounty_test`.`Marshall` (`marshallID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Subscription_Account1`
    FOREIGN KEY (`subHunterID`)
    REFERENCES `bug_bounty_test`.`Account` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`PreferredBounties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`PreferredBounties` (
  `bountyID` INT UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`bountyID`)  COMMENT '',
  UNIQUE INDEX `bountyID_UNIQUE` (`bountyID` ASC)  COMMENT '',
  CONSTRAINT `fk_PreferredBounties_BountyPool1`
    FOREIGN KEY (`bountyID`)
    REFERENCES `bug_bounty_test`.`BountyPool` (`poolID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`unpaidReport`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`unpaidReport` (
  `reportID` INT UNSIGNED NOT NULL COMMENT '',
  `dateAssessed` DATETIME NOT NULL COMMENT '',
  `message` MEDIUMTEXT NOT NULL COMMENT '',
  PRIMARY KEY (`reportID`)  COMMENT '',
  UNIQUE INDEX `reportID_UNIQUE` (`reportID` ASC)  COMMENT '',
  CONSTRAINT `fk_unpaidReport_Report1`
    FOREIGN KEY (`reportID`)
    REFERENCES `bug_bounty_test`.`Report` (`reportID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bug_bounty_test`.`paidReport`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bug_bounty_test`.`paidReport` (
  `reportID` INT UNSIGNED NOT NULL COMMENT '',
  `paidAmount` VARCHAR(10) NOT NULL COMMENT '',
  `datePaid` DATETIME NOT NULL COMMENT '',
  `message` MEDIUMTEXT NOT NULL COMMENT '',
  `publish` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`reportID`)  COMMENT '',
  UNIQUE INDEX `reportID_UNIQUE` (`reportID` ASC)  COMMENT '',
  CONSTRAINT `fk_paidReport_Report1`
    FOREIGN KEY (`reportID`)
    REFERENCES `bug_bounty_test`.`Report` (`bountyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO Account (username, email, password, dateCreated, activated, accountType) VALUES ('testHunter1', 'testHunter1@me.com', 'testHunter1', now(), true, 'hunter');
INSERT INTO Account (username, email, password, dateCreated, activated, accountType) VALUES ('testHunter2', 'testHunter2@me.com', 'testHunter2', now(), true, 'hunter');
INSERT INTO Account (username, email, password, dateCreated, activated, accountType) VALUES ('testMarshall1', 'testMarshall1@me.com', 'testMarshall1', now(), true, 'marshall');
INSERT INTO Account (username, email, password, dateCreated, activated, accountType) VALUES ('testMarshall2', 'testMarshall2@me.com', 'testMarshall2', now(), true, 'marshall');
INSERT INTO Account (username, email, password, dateCreated, activated, accountType) VALUES ('testMarshall3', 'testMarshall3@me.com', 'testMarshall3', now(), true, 'marshall');

INSERT INTO Marshall (company, description, marshallID) VALUES ('company1', 'This is marshallDescription1', 3);
INSERT INTO Marshall (company, description, marshallID) VALUES ('company2', 'This is marshallDescription2', 4);
INSERT INTO Marshall (company, description, marshallID) VALUES ('company3', 'This is marshallDescription3', 5);

INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (3, 'www.google.com', now(), '_images/_bounties/_testMarshall1/bounty1.jpg', 'lineDesc1', 'fullDescription1', '1');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (4, 'www.google.com', now(), '_images/_bounties/_testMarshall2/bounty2.jpg', 'lineDesc2', 'fullDescription2', '2');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (5, 'www.google.com', now(), '_images/_bounties/_testMarshall3/bounty3.jpg', 'lineDesc3', 'fullDescription3', '3');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (3, 'www.google.com', now(), '_images/_bounties/_testMarshall1/bounty4.jpg', 'lineDesc4', 'fullDescription4', '4');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (4, 'www.google.com', now(), '_images/_bounties/_testMarshall2/bounty5.jpg', 'lineDesc5', 'fullDescription5', '5');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (5, 'www.google.com', now(), '_images/_bounties/_testMarshall3/bounty6.jpg', 'lineDesc6', 'fullDescription6', '6');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (3, 'www.google.com', now(), '_images/_bounties/_testMarshall1/bounty7.jpg', 'lineDesc7', 'fullDescription7', '7');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (4, 'www.google.com', now(), '_images/_bounties/_testMarshall2/bounty8.jpg', 'lineDesc8', 'fullDescription8', '8');
INSERT INTO BountyPool (bountyMarshallID, bountyLink, dateCreated, imageLoc, lineDescription, fullDescription, payoutPool) VALUES (5, 'www.google.com', now(), '_images/_bounties/_testMarshall3/bounty9.jpg', 'lineDesc9', 'fullDescription9', '9');

INSERT INTO PreferredBounties(bountyID) VALUES (1);
INSERT INTO PreferredBounties(bountyID) VALUES (2);
INSERT INTO PreferredBounties(bountyID) VALUES (3);
INSERT INTO PreferredBounties(bountyID) VALUES (4);
INSERT INTO PreferredBounties(bountyID) VALUES (5);
INSERT INTO PreferredBounties(bountyID) VALUES (6);
INSERT INTO PreferredBounties(bountyID) VALUES (7);
INSERT INTO PreferredBounties(bountyID) VALUES (8);
INSERT INTO PreferredBounties(bountyID) VALUES (9);

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (1, 'testHunter1', 'This is report Text 1 for bounty 1 by testHunter1', '_images/_bounties/_testMarshall1/_reports/_testHunter1/report1.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (1, 'testHunter2', 'This is report Text 1 for bounty 1 by testHunter2', '_images/_bounties/_testMarshall1/_reports/_testHunter2/report1.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (1, 'testHunter2', 'This is report Text 2 for bounty 1 by testHunter2', '_images/_bounties/_testMarshall1/_reports/_testHunter2/report2.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (2, 'testHunter1', 'This is reportText 1 for bounty 2 by testHunter1', '_images/_bounties/_testMarshall2/_reports/_testHunter1/report1.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (2, 'testHunter2', 'This is report Text 1 for bounty 2 by testHunter2', '_images/_bounties/_testMarshall2/_reports/_testHunter2/report1.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (2, 'testHunter2', 'This is report Text 2 for bounty 2 by testHunter2', '_images/_bounties/_testMarshall2/_reports/_testHunter2/report2.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (3, 'testHunter1', 'This is report Text 1  for bounty 3 by testHunter1', '_images/_bounties/_testMarshall3/_reports/_testHunter1/report1.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (3, 'testHunter2', 'This is report Text 1 for bounty 3 by testHunter2', '_images/_bounties/_testMarshall3/_reports/_testHunter2/report1.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (3, 'testHunter1', 'This is report Text 2 for bounty 3 by testHunter1', '_images/_bounties/_testMarshall3/_reports/_testHunter1/report2.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (4, 'testHunter2', 'This is reportText 1 for bounty 4 by testHunter2', '_images/_bounties/_testMarshall1/_reports/_testHunter2/report3.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (4, 'testHunter1', 'This is report Text 1 for bounty 4 by testHunter1', '_images/_bounties/_testMarshall1/_reports/_testHunter1/report2.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (4, 'testHunter1', 'This is report Text 2 for bounty 4 by testHunter1', '_images/_bounties/_testMarshall1/_reports/_testHunter1/report3.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (5, 'testHunter2', 'This is report Text 1 for bounty 5 by testHunter2', '_images/_bounties/_testMarshall2/_reports/_testHunter2/report3.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (5, 'testHunter1', 'This is report Text 1 for bounty 5 by testHunter1', '_images/_bounties/_testMarshall2/_reports/_testHunter1/report2.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (5, 'testHunter2', 'This is report Text 2 for bounty 5 by testHunter2', '_images/_bounties/_testMarshall2/_reports/_testHunter2/report4.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (6, 'testHunter2', 'This is reportText 1 for bounty 6 by testHunter2', '_images/_bounties/_testMarshall3/_reports/_testHunter2/report2.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (6, 'testHunter1', 'This is report Text 1 for bounty 6 by testHunter1', '_images/_bounties/_testMarshall3/_reports/_testHunter1/report3.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (6, 'testHunter1', 'This is report Text 2 for bounty 6 by testHunter1', '_images/_bounties/_testMarshall3/_reports/_testHunter1/report4.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (7, 'testHunter2', 'This is reportText 1 for bounty 7 by testHunter2', '_images/_bounties/_testMarshall1/_reports/_testHunter2/report4.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (7, 'testHunter1', 'This is report Text 1 for bounty 7 by testHunter1', '_images/_bounties/_testMarshall1/_reports/_testHunter1/report4.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (7, 'testHunter2', 'This is report Text 2 for bounty 7 by testHunter2', '_images/_bounties/_testMarshall1/_reports/_testHunter2/report5.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (8, 'testHunter2', 'This is reportText 1 for bounty 8 by testHunter2', '_images/_bounties/_testMarshall2/_reports/_testHunter2/report5.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (8, 'testHunter1', 'This is report Text 1 for bounty 8 by testHunter1', '_images/_bounties/_testMarshall2/_reports/_testHunter1/report3.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (8, 'testHunter1', 'This is report Text 2 for bounty 8 by testHunter2', '_images/_bounties/_testMarshall2/_reports/_testHunter1/report4.jpg');

INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (9, 'testHunter2', 'This is reportText 1 for bounty 9 by testHunter2', '_images/_bounties/_testMarshall3/_reports/_testHunter2/report3.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (9, 'testHunter2', 'This is report Text 2 for bounty 9 by testHunter2', '_images/_bounties/_testMarshall3/_reports/_testHunter2/report4.jpg');
INSERT INTO Report(bountyID, username, reportText, imageLoc) VALUES (9, 'testHunter1', 'This is report Text 1 for bounty 9 by testHunter1', '_images/_bounties/_testMarshall3/_reports/_testHunter1/report5.jpg');
