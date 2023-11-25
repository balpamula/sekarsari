-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: sekarsari
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (1,'Iqbal','admin','admin');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gambar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` VALUES (1,'sekarsari.png','Paket Basic','•	Nasi Putih<br>\r\n•	Soup<br>\r\n•	Daging Ayam<br>\r\n•	Ikan<br>\r\n•	Tumisan / Cah / Salad<br>\r\n•	Kerupuk<br>\r\n•	Air Mineral<br>\r\n<br>\r\n•	Desert 1 macam<br>\r\n•	Stall 2 macam<br>',30000),(19,'sekarsari.png','Paket Superior','•	Nasi Putih<br>\r\n•	Soup<br>\r\n•	Daging Sapi<br>\r\n•	Ikan / Ayam<br>\r\n•	Tumisan / Cah / Salad<br>\r\n•	Kerupuk<br>\r\n•	Air Mineral<br>\r\n<br>\r\n•	Desert 2 macam<br>\r\n•	Stall 3 macam<br>',35000),(21,'sekarsari.png','Paket Deluxe','•	Nasi Putih<br>\r\n•	Soup<br>\r\n•	Daging Sapi<br>\r\n•	Ikan / Udang / Cumi<br>\r\n•	Tumisan / Cah / Salad<br>\r\n•	Kerupuk<br>\r\n•	Air Mineral<br>\r\n<br>\r\n•	Desert 3 macam<br>\r\n•	Stall 5 macam<br>',40000),(22,'sekarsari.png','Paket Exclusive','•	Nasi Putih<br>\r\n•	Soup<br>\r\n•	Daging Sapi<br>\r\n•	Ikan / Ayam<br>\r\n•	Macaroni Schotel<br>\r\n•	Tumisan / Cah / Salad<br>\r\n•	Kerupuk<br>\r\n•	Air Mineral<br>\r\n<br>\r\n•	Desert 3 macam<br>\r\n•	Stall 6 macam<br>',45000),(23,'sekarsari.png','Paket Luxury','•	Nasi Putih<br>\r\n•	Nasi Goreng<br>\r\n•	Kornet Lidah / Kornet Sapi / Balado Sapi<br>\r\n•	Ayam Nanking / Ayam Kodok<br>\r\n•	Brokoli Tofu<br>\r\n•	Macaroni Schotel<br>\r\n•	Salad Buah Sayur<br>\r\n•	Kerupuk<br>\r\n•	Air Mineral<br>\r\n<br>\r\n•	Desert 4 macam<br>\r\n•	Stall 7 macam<br>',50000);
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `harga` int NOT NULL,
  `namaPemesan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_wa` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_saji` date NOT NULL,
  `waktu_saji` time NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `jumlah` int NOT NULL,
  `total` int NOT NULL,
  `status_bayar` enum('Y','N') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menu` (`id_menu`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_order`
--

LOCK TABLES `tbl_order` WRITE;
/*!40000 ALTER TABLE `tbl_order` DISABLE KEYS */;
INSERT INTO `tbl_order` VALUES (68,1,30000,'Taufik','+628123456789','Jakarta','2023-12-02','20:30:00','2023-11-25 10:25:38',80,2000000,'Y');
/*!40000 ALTER TABLE `tbl_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pesan` int NOT NULL,
  `bukti` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `waktu_konfirmasi` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pesanan` (`id_pesan`),
  CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `tbl_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_payment`
--

LOCK TABLES `tbl_payment` WRITE;
/*!40000 ALTER TABLE `tbl_payment` DISABLE KEYS */;
INSERT INTO `tbl_payment` VALUES (26,68,'Screenshot_2023-09-19_130511.png','2023-11-25 10:27:51');
/*!40000 ALTER TABLE `tbl_payment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-25 16:29:34
