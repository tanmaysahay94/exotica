-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: exotica
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
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,1,9,3,'2014-11-13 14:09:15');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` varchar(511) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `contact_no` (`contact_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Abhinav Shukla','9052035715','E128'),(2,'Tanmay Sahay','8886449882','E128');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'abhinavWaiter','iiit123','Abhinav','Shukla','Waiter'),(2,'tanmayWaiter','iiit123','Tanmay','Sahay','Waiter'),(3,'abhinavCashier','iiit123','Abhinav','Shukla','Cashier'),(4,'tanmayCashier','iiit123','Tanmay','Sahay','Cashier'),(5,'abhinavChef','iiit123','Abhinav','Shukla','Chef'),(6,'tanmayChef','iiit123','Tanmay','Sahay','Chef'),(7,'abhinavDelivery','iiit123','Abhinav','Shukla','Deliveryman'),(8,'tanmayDelivery','iiit123','Tanmay','Sahay','Deliveryman'),(9,'abhinavKitchen','iiit123','Abhinav','Shukla','Kitchen_Staff'),(10,'tanmayKitchen','iiit123','Tanmay','Sahay','Kitchen_Staff'),(11,'abhinavSupply','iiit123','Abhinav','Shukla','Supply_Staff'),(12,'tanmaySupply','iiit123','Tanmay','Sahay','Supply_Staff');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `supply_requested` varchar(20) DEFAULT 'NO',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,1,'chilli','NO'),(2,3,'sauce','NO'),(3,4,'onion','YES'),(4,1,'tomato','NO'),(5,2,'cabbage','NO'),(6,1,'chicken','NO'),(7,3,'turmeric','NO'),(8,3,'pepper','NO'),(9,0,'sugar','YES'),(10,0,'spice','YES'),(11,0,'everythingNice','YES'),(12,0,'lamb','YES'),(13,0,'coriander','YES'),(14,0,'beef','YES'),(15,0,'pork','YES'),(16,2000,'fish','NO');
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `price` int(11) NOT NULL,
  `description` varchar(1023) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (699,'more tikkaaaaaa!!!!!','achariTikka'),(275,'Chicken of the North','butterChicken'),(16,'Naan of The North','butterNaan'),(243,':3','chickenBiryani'),(120,'duh.','eggCurry'),(14,'vampires suck.','garlicNaan'),(140,'hariyali, IFYKWIM','harabharaKebab'),(528,'treasure island','khazanaETandoor'),(340,'tikkkkkaaaaaaaaaa!!!','murgTikka'),(15,'isNaan == True','naan'),(10,'Indian Bread','roti'),(200,'tasty :3','tandooriChicken'),(150,'lamb soup','yakhni');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `managers`
--

LOCK TABLES `managers` WRITE;
/*!40000 ALTER TABLE `managers` DISABLE KEYS */;
INSERT INTO `managers` VALUES (1,'Abhinav','Shukla','manager','manager');
/*!40000 ALTER TABLE `managers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items` varchar(255) NOT NULL,
  `waiter_id` int(11) NOT NULL,
  `cook_id` int(11) NOT NULL,
  `prepared` varchar(10) NOT NULL DEFAULT 'NO',
  `delivered` varchar(10) NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `waiter_id` (`waiter_id`),
  KEY `items` (`items`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`waiter_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`items`) REFERENCES `items` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'roti',1,8,'NO','NO'),(3,'achariTikka',1,8,'NO','NO'),(4,'butterNaan',1,9,'YES','YES'),(5,'chickenBiryani',1,8,'NO','NO'),(6,'eggCurry',1,8,'NO','NO'),(7,'garlicNaan',1,8,'NO','NO'),(8,'naan',1,8,'NO','YES'),(9,'murgTikka',2,8,'NO','NO'),(10,'yakhni',2,8,'NO','NO'),(11,'harabharaKebab',2,8,'NO','NO'),(12,'khazanaETandoor',2,8,'NO','NO'),(13,'achariTikka',2,8,'NO','NO'),(14,'eggCurry',2,8,'NO','NO');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant`
--

DROP TABLE IF EXISTS `restaurant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurant` (
  `name` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `contact_no` (`contact_no`),
  UNIQUE KEY `address` (`address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant`
--

LOCK TABLES `restaurant` WRITE;
/*!40000 ALTER TABLE `restaurant` DISABLE KEYS */;
INSERT INTO `restaurant` VALUES ('Exotica','+91-40-33165269','Placeholder address');
/*!40000 ALTER TABLE `restaurant` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-13 20:13:06
