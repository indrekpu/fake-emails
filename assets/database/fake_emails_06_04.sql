-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

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
-- Table structure for table `activation`
--

DROP TABLE IF EXISTS `activation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activation_key` varchar(100) NOT NULL,
  `activated` bit(1) NOT NULL DEFAULT b'0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `activation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activation`
--

LOCK TABLES `activation` WRITE;
/*!40000 ALTER TABLE `activation` DISABLE KEYS */;
INSERT INTO `activation` VALUES (9,'98ae50f802c0c764ec8611ec00ba806f','',12),(10,'efd7f3afd6d277db3039abaa74e36d73','',13),(11,'c31d5c5e79e93469a3d2910e70f2ad34','',14),(12,'c1854e2ecc570fdec3a94cddaf63324c','\0',15),(13,'0386964fcea17a85830e88bb0cef4309','\0',16),(14,'28d6f6fdaa6b436c3cc9be6ecf6df5ed','\0',17),(15,'bc05343526576b4b9f6b00e53427f432','\0',18);
/*!40000 ALTER TABLE `activation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `activation_view`
--

DROP TABLE IF EXISTS `activation_view`;
/*!50001 DROP VIEW IF EXISTS `activation_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `activation_view` (
  `id` tinyint NOT NULL,
  `activation_key` tinyint NOT NULL,
  `activated` tinyint NOT NULL,
  `user_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Tambet','tambet@gmail.com','Minu sõnum');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `files_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (14,'teksfail.txt',12);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `files_view`
--

DROP TABLE IF EXISTS `files_view`;
/*!50001 DROP VIEW IF EXISTS `files_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `files_view` (
  `id` tinyint NOT NULL,
  `file_name` tinyint NOT NULL,
  `owner_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `passwords`
--

DROP TABLE IF EXISTS `passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwords`
--

LOCK TABLES `passwords` WRITE;
/*!40000 ALTER TABLE `passwords` DISABLE KEYS */;
INSERT INTO `passwords` VALUES (12,12,'$2y$10$8ifhWUA1hfYetSs3jdEE4.bWo.8msPf7CY8vLQELJhKuLAKdRtzQm'),(13,13,'$2y$10$EeIN5sob50JWdjjahDQ3bOOpXB6z87lEgj2zjXkzgi4o3qtnmaSyG'),(14,14,'$2y$10$YDQDv.mqs34EV8fUWkgl.uX5ZYHWm7N5RXfBM0UxWV5I1s6BoO6nu'),(15,15,'$2y$10$UFRhFOaZFRNZU9MHFksoj.SCJFoIXJHZe48QGR2QBTnNhNAJRP2aS'),(16,16,'$2y$10$4lr.G2lvUIN8Klw/z0vMdu0mcVVdU2arcsyOUQx4FWNLZxItpL.Oi'),(17,17,'$2y$10$TsvSc5Vgreo/GfvaMWrs8uFNyUkepFzDhWUJoBnKnPHcEV/qJrRam'),(18,18,'$2y$10$cD3mWISwkpAuu6cg4DgQ3uJDcZd7VqvfJuW9Zwcxs1uTQlGZL18Sm');
/*!40000 ALTER TABLE `passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `passwords_view`
--

DROP TABLE IF EXISTS `passwords_view`;
/*!50001 DROP VIEW IF EXISTS `passwords_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `passwords_view` (
  `id` tinyint NOT NULL,
  `user_id` tinyint NOT NULL,
  `password` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unknown',
  `browser` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unknown',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `platform` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unknown',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES (1,'192.168.1.1','Estonia','Chrome','2018-03-21 18:01:55','Win10'),(2,'192.168.1.1','Estonia','Chrome','2018-03-21 18:35:18','Win10'),(3,'192.168.1.1','Estonia','Chrome','2018-03-21 18:36:15','Win10'),(4,'::1','Estonia','Chrome','2018-03-22 11:20:46','Win7'),(5,'::1','Estonia','Chrome','2018-03-22 14:06:09','Win7'),(6,'::1','Estonia','Chrome','2018-03-29 08:43:27','Win7'),(7,'::1','Estonia','Chrome','2018-03-29 11:11:09','Win7'),(8,'::1','Estonia','Chrome','2018-03-29 19:47:57','Win7'),(9,'::1','Estonia','Chrome','2018-03-29 20:24:20','Win7'),(10,'::1','Estonia','Chrome','2018-03-30 09:35:17','Win7'),(11,'::1','Estonia','Chrome','2018-03-30 10:35:18','Win7'),(12,'::1','Estonia','Chrome','2018-04-01 08:36:06','Win7'),(13,'::1','Estonia','Chrome','2018-04-01 09:08:49','Win7'),(14,'192.168.1.1','Estonia','Chrome','2018-04-01 13:20:13','Win10'),(15,'::1','Estonia','Chrome','2018-04-01 13:20:16','Win10'),(16,'::1','Estonia','Chrome','2018-04-01 15:27:56','Win10'),(17,'::1','Estonia','Chrome','2018-04-01 15:27:56','Win10'),(18,'192.168.1.1','Estonia','Chrome','2018-04-01 15:30:59','Win10'),(19,'128.30.52.66','Estonia','Default Browser','2018-04-01 15:31:17','unknown'),(20,'192.168.1.1','Estonia','Chrome','2018-04-01 18:19:13','Win10'),(21,'192.168.1.1','Estonia','Chrome','2018-04-01 18:22:55','Win10'),(22,'128.30.52.96','Estonia','Default Browser','2018-04-01 18:41:21','unknown'),(23,'128.30.52.64','Estonia','Default Browser','2018-04-01 18:41:23','unknown'),(24,'128.30.52.64','Estonia','Default Browser','2018-04-01 18:42:23','unknown'),(25,'128.30.52.134','Estonia','Default Browser','2018-04-01 18:47:56','unknown'),(26,'128.30.52.64','Estonia','Default Browser','2018-04-01 18:48:44','unknown'),(27,'128.30.52.134','Estonia','Default Browser','2018-04-01 18:48:58','unknown'),(28,'128.30.52.64','Estonia','Default Browser','2018-04-01 18:52:52','unknown'),(29,'128.30.52.64','Estonia','Default Browser','2018-04-01 18:53:00','unknown'),(30,'128.30.52.72','Estonia','Default Browser','2018-04-01 18:53:05','unknown'),(31,'128.30.52.64','Estonia','Default Browser','2018-04-01 18:54:58','unknown'),(32,'192.168.1.1','Estonia','Chrome','2018-04-01 19:00:23','Win10'),(33,'192.168.1.1','Estonia','Chrome','2018-04-01 19:03:14','Win10'),(34,'192.168.1.1','Estonia','Chrome','2018-04-01 19:45:13','Win10'),(35,'66.102.9.11','Estonia','Chrome','2018-04-01 20:02:57','Linux'),(36,'66.249.81.188','Estonia','Chrome','2018-04-01 20:02:58','Linux'),(37,'128.30.52.96','Estonia','Default Browser','2018-04-01 20:15:57','unknown'),(38,'128.30.52.96','Estonia','Default Browser','2018-04-01 20:15:58','unknown'),(39,'128.30.52.66','Estonia','Default Browser','2018-04-01 20:16:07','unknown'),(40,'192.168.1.1','Estonia','Chrome','2018-04-01 20:23:03','Win10'),(41,'84.50.238.73','Estonia','IE','2018-04-01 20:29:43','Win10'),(42,'40.107.202.11','Estonia','Chrome','2018-04-01 20:32:16','Win7'),(43,'84.50.238.73','Estonia','IE','2018-04-01 20:32:29','Win10'),(44,'154.59.123.106','Estonia','IE','2018-04-01 20:35:19','Win32'),(45,'84.50.238.73','Estonia','IE','2018-04-02 05:30:16','Win10'),(46,'192.168.1.1','Estonia','Chrome','2018-04-02 07:25:30','Win10'),(47,'66.102.9.11','Estonia','Chrome','2018-04-02 09:24:09','Linux'),(48,'192.168.1.1','Estonia','Chrome','2018-04-02 20:27:11','Win10'),(49,'70.42.131.170','Estonia','IE','2018-04-03 00:41:00','Win7'),(50,'192.168.1.1','Estonia','Chrome','2018-04-03 08:17:13','Win10'),(51,'213.184.43.179','Estonia','Chrome','2018-04-03 13:00:40','Win10'),(52,'213.184.43.179','Estonia','Chrome','2018-04-03 13:02:46','Win10'),(53,'213.184.43.179','Estonia','Chrome','2018-04-03 13:03:37','Win10'),(54,'192.168.1.1','Estonia','Chrome','2018-04-03 15:00:02','Win10'),(55,'192.168.1.1','Estonia','Chrome','2018-04-03 17:18:34','Win10'),(56,'213.184.43.179','Estonia','IE','2018-04-04 07:30:12','Win10'),(57,'192.168.1.1','Estonia','Chrome','2018-04-04 07:44:33','Win10'),(58,'192.168.1.1','Estonia','Chrome','2018-04-04 18:03:46','Win10'),(59,'192.168.1.1','Estonia','Chrome','2018-04-04 18:09:58','Win10'),(60,'192.168.1.1','Estonia','Chrome','2018-04-04 18:11:48','Win10'),(61,'192.168.1.1','Estonia','Chrome','2018-04-04 18:12:38','Win10'),(62,'128.30.52.134','Estonia','Default Browser','2018-04-04 18:14:37','unknown'),(63,'128.30.52.134','Estonia','Default Browser','2018-04-04 18:14:38','unknown'),(64,'192.168.1.1','Estonia','Chrome','2018-04-04 18:18:00','Win10'),(65,'192.168.1.1','Estonia','Chrome','2018-04-05 07:23:42','Win10'),(66,'192.168.1.1','Estonia','Chrome','2018-04-05 08:18:15','Win10'),(67,'128.30.52.96','Estonia','Default Browser','2018-04-05 08:33:14','unknown'),(68,'128.30.52.96','Estonia','Default Browser','2018-04-05 08:33:15','unknown'),(69,'128.30.52.64','Estonia','Default Browser','2018-04-05 08:33:22','unknown'),(70,'128.30.52.95','Estonia','Default Browser','2018-04-05 08:33:26','unknown'),(71,'128.30.52.66','Estonia','Default Browser','2018-04-05 08:33:41','unknown'),(72,'193.40.13.163','Estonia','Chrome','2018-04-05 09:45:36','Win7'),(73,'192.168.1.1','Estonia','Chrome','2018-04-05 10:52:47','Win10'),(74,'193.40.13.163','Estonia','Chrome','2018-04-05 11:16:34','Win7'),(75,'193.40.13.163','Estonia','Chrome','2018-04-05 11:51:56','Win10'),(76,'193.40.13.163','Estonia','Chrome','2018-04-05 11:54:30','Win7'),(77,'193.40.13.163','Estonia','Chrome','2018-04-05 11:54:39','Win7'),(78,'66.102.9.5','Estonia','Chrome','2018-04-05 12:10:52','Linux'),(79,'193.40.13.163','Estonia','IE','2018-04-05 12:46:59','Win10'),(80,'192.168.1.1','Estonia','Chrome','2018-04-05 14:56:24','Win10'),(81,'::1','Estonia','Chrome','2018-04-05 14:56:26','Win10'),(82,'192.168.1.1','Estonia','Chrome','2018-04-06 06:15:09','Win10'),(83,'192.168.1.1','Estonia','Chrome','2018-04-06 06:20:31','Win10'),(84,'::1','Estonia','Chrome','2018-04-06 06:20:39','Win10'),(85,'192.168.1.1','Estonia','Chrome','2018-04-06 08:07:32','Win10'),(86,'192.168.1.1','Estonia','Chrome','2018-04-06 08:26:07','Win10'),(87,'192.168.1.1','Estonia','Chrome','2018-04-06 08:29:33','Win10'),(88,'192.168.1.1','Estonia','Chrome','2018-04-06 08:42:35','Win10'),(89,'192.168.1.1','Estonia','Chrome','2018-04-06 09:32:16','Win10'),(90,'192.168.1.1','Estonia','Chrome','2018-04-06 09:45:57','Win10'),(91,'192.168.1.1','Estonia','Safari','2018-04-06 10:18:12','iOS'),(92,'192.168.1.1','Estonia','Safari','2018-04-06 10:18:19','iOS'),(93,'128.30.52.72','Estonia','Default Browser','2018-04-06 12:04:37','unknown'),(94,'128.30.52.134','Estonia','Default Browser','2018-04-06 12:04:38','unknown'),(95,'128.30.52.96','Estonia','Default Browser','2018-04-06 12:05:59','unknown'),(96,'192.168.1.1','Estonia','Safari','2018-04-06 12:20:17','iOS'),(97,'128.30.52.96','Estonia','Default Browser','2018-04-06 12:34:40','unknown'),(98,'128.30.52.96','Estonia','Default Browser','2018-04-06 12:34:42','unknown'),(99,'192.168.1.1','Estonia','Chrome','2018-04-06 15:14:39','Win10'),(100,'192.168.1.1','Estonia','Chrome','2018-04-06 17:29:11','Win10'),(101,'192.168.1.1','Estonia','Chrome','2018-04-06 17:51:26','Win10'),(102,'192.168.1.1','Estonia','Chrome','2018-04-06 17:52:46','Win10');
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `statistics_view`
--

DROP TABLE IF EXISTS `statistics_view`;
/*!50001 DROP VIEW IF EXISTS `statistics_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `statistics_view` (
  `id` tinyint NOT NULL,
  `ip` tinyint NOT NULL,
  `country` tinyint NOT NULL,
  `browser` tinyint NOT NULL,
  `time` tinyint NOT NULL,
  `platform` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('M','F','O') COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (12,'teats','TambetTanilsoo@gmail.com','0000-00-00','M',NULL),(13,'Tambet-Telvis','tampz787@gmail.com','0000-00-00','M',NULL),(14,'Indrek Purga','Indrek.Purga@eas.ee','0000-00-00','M',NULL),(15,'Test kasutaja','Random@gmail.comm','0000-00-00','M',NULL),(16,'Suvaline Kasutaj','kasutajasuvaline@gmaill.com','0000-00-00','M',NULL),(17,'uuskasutaj','suvaline@gmail.ce','0000-00-00','M',NULL),(18,'Test jalle','kasutajatest215321@gmailll.com','0000-00-00','M',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `user_view`
--

DROP TABLE IF EXISTS `user_view`;
/*!50001 DROP VIEW IF EXISTS `user_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `user_view` (
  `id` tinyint NOT NULL,
  `full_name` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `birthday` tinyint NOT NULL,
  `gender` tinyint NOT NULL,
  `activation` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `activation_view`
--

/*!50001 DROP TABLE IF EXISTS `activation_view`*/;
/*!50001 DROP VIEW IF EXISTS `activation_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `activation_view` AS select `activation`.`id` AS `id`,`activation`.`activation_key` AS `activation_key`,`activation`.`activated` AS `activated`,`activation`.`user_id` AS `user_id` from `activation` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `files_view`
--

/*!50001 DROP TABLE IF EXISTS `files_view`*/;
/*!50001 DROP VIEW IF EXISTS `files_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `files_view` AS select `files`.`id` AS `id`,`files`.`file_name` AS `file_name`,`files`.`owner_id` AS `owner_id` from `files` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `passwords_view`
--

/*!50001 DROP TABLE IF EXISTS `passwords_view`*/;
/*!50001 DROP VIEW IF EXISTS `passwords_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `passwords_view` AS select `passwords`.`id` AS `id`,`passwords`.`user_id` AS `user_id`,`passwords`.`password` AS `password` from `passwords` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `statistics_view`
--

/*!50001 DROP TABLE IF EXISTS `statistics_view`*/;
/*!50001 DROP VIEW IF EXISTS `statistics_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `statistics_view` AS select `statistics`.`id` AS `id`,`statistics`.`ip` AS `ip`,`statistics`.`country` AS `country`,`statistics`.`browser` AS `browser`,`statistics`.`time` AS `time`,`statistics`.`platform` AS `platform` from `statistics` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `user_view`
--

/*!50001 DROP TABLE IF EXISTS `user_view`*/;
/*!50001 DROP VIEW IF EXISTS `user_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `user_view` AS select `user`.`id` AS `id`,`user`.`full_name` AS `full_name`,`user`.`email` AS `email`,`user`.`birthday` AS `birthday`,`user`.`gender` AS `gender`,`user`.`activation` AS `activation` from `user` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-06 20:55:58
