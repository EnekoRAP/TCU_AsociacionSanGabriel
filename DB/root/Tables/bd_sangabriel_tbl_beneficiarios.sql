-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_sangabriel
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `tbl_beneficiarios`
--

DROP TABLE IF EXISTS `tbl_beneficiarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_beneficiarios` (
  `id_beneficiario` int NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int NOT NULL,
  `alergias` varchar(100) DEFAULT NULL,
  `medicamentos` varchar(100) DEFAULT NULL,
  `fecha_ingreso` date NOT NULL,
  `encargado` varchar(100) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `pago` decimal(10,2) DEFAULT NULL,
  `id_programa` int DEFAULT NULL,
  `id_grupo` int DEFAULT NULL,
  PRIMARY KEY (`id_beneficiario`),
  KEY `id_programa` (`id_programa`),
  KEY `id_grupo` (`id_grupo`),
  CONSTRAINT `tbl_beneficiarios_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `tbl_programas` (`id_programa`),
  CONSTRAINT `tbl_beneficiarios_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_grupos` (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_beneficiarios`
--

LOCK TABLES `tbl_beneficiarios` WRITE;
/*!40000 ALTER TABLE `tbl_beneficiarios` DISABLE KEYS */;
INSERT INTO `tbl_beneficiarios` VALUES (1,'403000564','Santiago','Hidalgo Molina','2012-12-20',13,'Asma','Bomba de Salbutamol','2023-05-08','Katherine Molina Sánchez','8612-1617',40000.00,1,1);
/*!40000 ALTER TABLE `tbl_beneficiarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-04 18:04:18
