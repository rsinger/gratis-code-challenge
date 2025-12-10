-- MySQL dump 10.13  Distrib 8.4.7, for Linux (aarch64)
--
-- Host: localhost    Database: gratis_code_challenge
-- ------------------------------------------------------
-- Server version	8.4.7

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(255) NOT NULL COMMENT 'Location Name',
  `address` varchar(512) DEFAULT NULL COMMENT 'Address',
  `phone_number` varchar(20) DEFAULT NULL COMMENT 'Phone Number',
  `tagline` text COMMENT 'Tagline',
  `description` text COMMENT 'Description',
  `image_url` varchar(512) DEFAULT NULL COMMENT 'Image URL',
  `url` varchar(512) DEFAULT NULL COMMENT 'Location URL',
  `created_at` datetime DEFAULT NULL COMMENT 'Create Time',
  `updated_at` datetime DEFAULT NULL COMMENT 'Update Time',
  `default_location` tinyint(1) DEFAULT '0' COMMENT 'Is Default Location',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Long of Athens','1900 Congress Parkway South • Athens , TN 37303','(423) 745-1962','Chevrolet Buick GMC','Saphura Long, a member of Long Automotive of Chattanooga has acquired the previously known Don Ledford AutoPark of Athens. Saphura is an entrepreneur who has for many years owned technology companies which have served the automotive industry. For that matter her present company Gratis Technologies, serves many dealerships across the nation in the realm of customer management. Saphura believes that all successful companies have one thing primarily in common, and that is to value customers most of all and to assure their experience at the dealership exceeds their expectations. Saphura, the wife of Nelson Long of Long Automotive of Chattanooga is an engineer by education and has a masters in Nuclear Physics. And, upon moving to Chattanooga her first position was that of a research engineer at Combustion Engineering.  Saphura believes that being active in one\'s community is a matter of paying one\'s \"community dues\". In doing so she has served on numerous boards. Some of those positions are past chairman of the Advocacy Public Affairs of Junior League of Chattanooga, where she and her team successfully advocated for instating the seat belt law in the state of Tennessee.  Long Chevrolet Buick GMC of Athens, would like to be a place where both co-workers and customers feel like they belong. We realize that there are many long-term dealership customers who would like to work with us and we are honored for that and will do all that we can to earn and retain their trust.  We are a new company, yes, we have retained some of the great \"old employees\" that fit our philosophy of proper and fair treatment of customers. But most of us are new and we have a new attitude and a new agenda and that is to earn the trust of this community and to serve them in their automotive needs second to none. Please come see us, have a cup of coffee with us and let us introduce ourselves.','https://longofathens.com/site-images/dealers/0/athens-logo.jpg','https://longofathens.com/','2025-12-10 00:00:00','2025-12-10 00:00:00',1);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `create_time` datetime DEFAULT NULL COMMENT 'Create Time',
  `email` varchar(255) DEFAULT NULL COMMENT 'User Email',
  `password_hash` varchar(255) DEFAULT NULL COMMENT 'Password Hash',
  `location_id` int DEFAULT NULL COMMENT 'Location ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,NULL,'ross@example.com','12345',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `model_trim` varchar(255) DEFAULT NULL,
  `inventory_type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `model_year` int DEFAULT NULL,
  `mileage` int DEFAULT NULL,
  `vin` varchar(17) DEFAULT NULL,
  `exterior_color` varchar(100) DEFAULT NULL,
  `interior_color` varchar(100) DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_url` varchar(512) DEFAULT NULL,
  `added_by_user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'Chevrolet','Colorado','Trail Boss','new',55954.00,2026,3,'1GCPTEEK2T1139199','black','black',1,NULL,'2025-12-10 23:07:11','2025-12-10 23:33:44','https://vehicle-photos-published.vauto.com/c5/08/51/37-d50f-4d6f-8281-23412d8b8afa/image-1.jpg',3),(2,'Buick','Thing','Deluxe','new',23000.00,2020,10000,'M1234567890','red','black',1,NULL,'2025-12-10 23:22:58','2025-12-10 23:34:51','https://vehicle-photos-published.vauto.com/c7/a9/be/8c-7d4c-4682-a1bc-df2c0ec6fdb4/image-1.jpg',3);
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-10 23:41:35
bash-5.1# RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
