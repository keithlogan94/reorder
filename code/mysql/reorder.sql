-- MySQL dump 10.13  Distrib 8.0.14, for Linux (x86_64)
--
-- Host: localhost    Database: reorder
-- ------------------------------------------------------
-- Server version	8.0.14
USE reorder;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `crm_account`
--

DROP TABLE IF EXISTS `crm_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `crm_account` (
  `crm_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`crm_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crm_account`
--

LOCK TABLES `crm_account` WRITE;
/*!40000 ALTER TABLE `crm_account` DISABLE KEYS */;
INSERT INTO `crm_account` VALUES (1,'2019-02-01 22:12:12'),(2,'2019-02-01 22:45:30'),(3,'2019-02-01 22:46:03'),(4,'2019-02-02 21:27:11'),(5,'2019-02-02 21:29:10'),(6,'2019-02-02 21:29:58'),(7,'2019-02-02 21:30:24'),(8,'2019-02-02 21:31:49'),(9,'2019-02-02 21:35:44'),(10,'2019-02-02 21:56:56'),(11,'2019-02-02 22:05:55'),(12,'2019-02-02 22:09:17'),(13,'2019-02-02 22:10:48'),(14,'2019-02-02 22:11:00'),(15,'2019-02-02 22:20:17'),(16,'2019-02-02 22:21:43'),(17,'2019-02-02 22:22:11'),(18,'2019-02-02 22:22:36'),(19,'2019-02-02 22:22:41'),(20,'2019-02-02 22:29:19'),(21,'2019-02-02 22:30:32'),(22,'2019-02-02 22:31:06'),(23,'2019-02-02 22:32:08'),(24,'2019-02-02 22:32:13'),(25,'2019-02-02 22:33:27'),(26,'2019-02-02 22:34:44'),(27,'2019-02-02 22:39:40'),(28,'2019-02-02 22:40:15'),(29,'2019-02-02 22:42:25'),(30,'2019-02-02 22:43:01'),(31,'2019-02-02 22:44:10'),(32,'2019-02-02 22:46:28'),(33,'2019-02-02 22:50:27');
/*!40000 ALTER TABLE `crm_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crm_address`
--

DROP TABLE IF EXISTS `crm_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `crm_address` (
  `crm_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `crm_account_id` int(11) NOT NULL,
  `street1` varchar(200) NOT NULL,
  `street2` varchar(200) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(10) NOT NULL,
  `is_billing` tinyint(1) NOT NULL DEFAULT '0',
  `billing_first_name` varchar(40) DEFAULT NULL,
  `billing_last_name` varchar(40) DEFAULT NULL,
  `is_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_first_name` varchar(40) DEFAULT NULL,
  `shipping_last_name` varchar(40) DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`crm_address_id`),
  KEY `crm_account_id` (`crm_account_id`),
  KEY `is_billing` (`is_billing`),
  KEY `is_shipping` (`is_shipping`),
  CONSTRAINT `crm_address_ibfk_1` FOREIGN KEY (`crm_account_id`) REFERENCES `crm_account` (`crm_account_id`),
  CONSTRAINT `crm_address_ibfk_2` FOREIGN KEY (`crm_address_id`) REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crm_address`
--

LOCK TABLES `crm_address` WRITE;
/*!40000 ALTER TABLE `crm_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `crm_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crm_email`
--

DROP TABLE IF EXISTS `crm_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `crm_email` (
  `crm_email_id` int(11) NOT NULL AUTO_INCREMENT,
  `crm_account_id` int(11) NOT NULL,
  `email_address` varchar(250) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`crm_email_id`),
  KEY `crm_account_id` (`crm_account_id`),
  KEY `email_address` (`email_address`),
  CONSTRAINT `crm_email_ibfk_1` FOREIGN KEY (`crm_account_id`) REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crm_email`
--

LOCK TABLES `crm_email` WRITE;
/*!40000 ALTER TABLE `crm_email` DISABLE KEYS */;
INSERT INTO `crm_email` VALUES (1,2,'keithloganbecker94@gmail.com',0,'2019-02-01 22:45:30',NULL),(2,3,'keithloganbecker94@gmail.com',0,'2019-02-01 22:46:03',NULL),(3,4,'testaccount92612376@test.com',0,'2019-02-02 21:27:11',NULL),(4,5,'testaccount41831782@test.com',0,'2019-02-02 21:29:10',NULL),(5,6,'testaccount61414742@test.com',0,'2019-02-02 21:29:58',NULL),(6,7,'testaccount85794397@test.com',0,'2019-02-02 21:30:24',NULL),(7,8,'testaccount34962135@test.com',0,'2019-02-02 21:31:49',NULL),(8,9,'testaccount99931759@test.com',0,'2019-02-02 21:35:44',NULL),(9,10,'testaccount10928241@test.com',0,'2019-02-02 21:56:56',NULL),(10,11,'testaccount34738065@test.com',0,'2019-02-02 22:05:55',NULL),(11,12,'testaccount55046592@test.com',0,'2019-02-02 22:09:17',NULL),(12,13,'testaccount99291087@test.com',0,'2019-02-02 22:10:48',NULL),(13,14,'testaccount69391125@test.com',0,'2019-02-02 22:11:00',NULL),(14,15,'testaccount72635625@test.com',0,'2019-02-02 22:20:17',NULL),(15,16,'testaccount40414086@test.com',0,'2019-02-02 22:21:43',NULL),(16,17,'testaccount40840232@test.com',0,'2019-02-02 22:22:11',NULL),(17,18,'testaccount60528479@test.com',0,'2019-02-02 22:22:37',NULL),(18,19,'testaccount54023270@test.com',0,'2019-02-02 22:22:41',NULL),(19,20,'testaccount98533466@test.com',0,'2019-02-02 22:29:19',NULL),(20,21,'testaccount79799476@test.com',0,'2019-02-02 22:30:32',NULL),(21,22,'testaccount43879665@test.com',0,'2019-02-02 22:31:06',NULL),(22,23,'testaccount66652794@test.com',0,'2019-02-02 22:32:08',NULL),(23,24,'testaccount10384335@test.com',0,'2019-02-02 22:32:13',NULL),(24,25,'testaccount77503753@test.com',0,'2019-02-02 22:33:27',NULL),(25,26,'testaccount24713052@test.com',0,'2019-02-02 22:34:44',NULL),(26,27,'testaccount86040546@test.com',0,'2019-02-02 22:39:41',NULL),(27,28,'testaccount46585286@test.com',0,'2019-02-02 22:40:15',NULL),(28,29,'testaccount11291974@test.com',0,'2019-02-02 22:42:25',NULL),(29,30,'testaccount19854394@test.com',0,'2019-02-02 22:43:02',NULL),(30,31,'testaccount23052071@test.com',0,'2019-02-02 22:44:10',NULL),(31,32,'testaccount74154672@test.com',0,'2019-02-02 22:46:28',NULL),(32,33,'testaccount62119689@test.com',0,'2019-02-02 22:50:27',NULL);
/*!40000 ALTER TABLE `crm_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crm_login_credentials`
--

DROP TABLE IF EXISTS `crm_login_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `crm_login_credentials` (
  `crm_login_credentials_id` int(11) NOT NULL AUTO_INCREMENT,
  `crm_account_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`crm_login_credentials_id`),
  UNIQUE KEY `crm_account_id` (`crm_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crm_login_credentials`
--

LOCK TABLES `crm_login_credentials` WRITE;
/*!40000 ALTER TABLE `crm_login_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `crm_login_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crm_person`
--

DROP TABLE IF EXISTS `crm_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `crm_person` (
  `crm_person_id` int(11) NOT NULL AUTO_INCREMENT,
  `crm_account_id` int(11) NOT NULL,
  `first_name` varchar(27) NOT NULL,
  `last_name` varchar(27) NOT NULL,
  `middle_name` varchar(27) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female') NOT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`crm_person_id`),
  UNIQUE KEY `crm_account_id` (`crm_account_id`),
  CONSTRAINT `crm_person_ibfk_1` FOREIGN KEY (`crm_account_id`) REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crm_person`
--

LOCK TABLES `crm_person` WRITE;
/*!40000 ALTER TABLE `crm_person` DISABLE KEYS */;
INSERT INTO `crm_person` VALUES (1,2,'Keith','Becker','Logan',NULL,'male','8082258615'),(2,3,'Keith','Becker','Logan',NULL,'male','8082258615'),(3,4,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(4,5,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(5,6,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(6,7,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(7,8,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(8,9,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(9,10,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(10,11,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(11,12,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(12,13,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(13,14,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(14,15,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(15,16,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(16,17,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(17,18,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(18,19,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(19,20,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(20,21,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(21,22,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(22,23,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(23,24,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(24,25,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(25,26,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(26,27,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(27,28,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(28,29,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(29,30,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(30,31,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(31,32,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL),(32,33,'TestFirstName','TestLastName','TestMiddleName',NULL,'male',NULL);
/*!40000 ALTER TABLE `crm_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fin_credit_card`
--

DROP TABLE IF EXISTS `fin_credit_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `fin_credit_card` (
  `fin_credit_card_id` int(11) NOT NULL AUTO_INCREMENT,
  `crm_account_id` int(11) NOT NULL,
  `name_on_card` varchar(150) NOT NULL,
  `number` varchar(30) NOT NULL,
  `security_code` varchar(10) DEFAULT NULL,
  `expiration_month` tinyint(4) NOT NULL,
  `expiration_year` smallint(6) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`fin_credit_card_id`),
  KEY `number` (`number`),
  KEY `crm_account_id` (`crm_account_id`),
  CONSTRAINT `fin_credit_card_ibfk_1` FOREIGN KEY (`crm_account_id`) REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fin_credit_card`
--

LOCK TABLES `fin_credit_card` WRITE;
/*!40000 ALTER TABLE `fin_credit_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `fin_credit_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_retailer_login`
--

DROP TABLE IF EXISTS `sec_retailer_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sec_retailer_login` (
  `sec_retailer_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `retailer` enum('amazon','walmart') NOT NULL,
  `crm_account_id` int(11) NOT NULL,
  `login_email` varchar(250) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  PRIMARY KEY (`sec_retailer_login_id`),
  KEY `retailer` (`retailer`),
  KEY `crm_account_id` (`crm_account_id`),
  KEY `login_email` (`login_email`),
  CONSTRAINT `sec_retailer_login_ibfk_1` FOREIGN KEY (`crm_account_id`) REFERENCES `crm_account` (`crm_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_retailer_login`
--

LOCK TABLES `sec_retailer_login` WRITE;
/*!40000 ALTER TABLE `sec_retailer_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `sec_retailer_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_config`
--

DROP TABLE IF EXISTS `sys_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sys_config` (
  `sys_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_key` varchar(40) NOT NULL,
  `description` varchar(200) NOT NULL,
  `value` varchar(70) NOT NULL,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sys_config_id`),
  KEY `config_key` (`config_key`),
  KEY `value` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_config`
--

LOCK TABLES `sys_config` WRITE;
/*!40000 ALTER TABLE `sys_config` DISABLE KEYS */;
INSERT INTO `sys_config` VALUES (1,'zinc_api_key','Zinc API Key','7FDBEEFF099AD8D902CC80D7','2019-02-01 18:03:34');
/*!40000 ALTER TABLE `sys_config` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-03  0:33:46
