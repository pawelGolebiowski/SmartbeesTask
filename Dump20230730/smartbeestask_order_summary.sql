-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: smartbeestask
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `order_summary`
--

DROP TABLE IF EXISTS `order_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_summary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `shipping_method_id` int DEFAULT NULL,
  `payment_method_id` int DEFAULT NULL,
  `discount_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `total_price` double NOT NULL,
  `purchased_products` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3852CF28A76ED395` (`user_id`),
  KEY `IDX_3852CF285F7D6850` (`shipping_method_id`),
  KEY `IDX_3852CF285AA1164F` (`payment_method_id`),
  CONSTRAINT `FK_3852CF285AA1164F` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`id`),
  CONSTRAINT `FK_3852CF285F7D6850` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`id`),
  CONSTRAINT `FK_3852CF28A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_summary`
--

LOCK TABLES `order_summary` WRITE;
/*!40000 ALTER TABLE `order_summary` DISABLE KEYS */;
INSERT INTO `order_summary` VALUES (1,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(2,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(3,NULL,NULL,NULL,NULL,'ghfghfgh',23,'testowy produkt'),(4,NULL,NULL,NULL,NULL,'test',115,'testowy produkt'),(5,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(6,NULL,NULL,NULL,NULL,'adadasd',115,'testowy produkt'),(7,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(8,NULL,NULL,NULL,NULL,'dsfdafs',115,'testowy produkt'),(9,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(10,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(11,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(12,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(13,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(14,NULL,NULL,NULL,NULL,'fjghjghj',115,'testowy produkt'),(15,NULL,NULL,NULL,NULL,'aaaaa',115,'testowy produkt'),(16,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(17,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(18,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(19,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(20,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(21,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(22,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(23,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(24,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(25,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(26,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(27,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(28,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(29,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(30,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(31,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(32,NULL,NULL,NULL,NULL,'',115,'testowy produkt'),(33,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(34,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(35,NULL,NULL,NULL,NULL,'comment',23,'testowy produkt'),(36,NULL,NULL,NULL,NULL,'',115,'testowy produkt');
/*!40000 ALTER TABLE `order_summary` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-30 23:50:53
