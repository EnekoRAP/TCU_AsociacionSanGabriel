CREATE DATABASE  IF NOT EXISTS `bd_sangabriel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bd_sangabriel`;
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
-- Table structure for table `tbl_auditoria`
--

DROP TABLE IF EXISTS `tbl_auditoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_auditoria` (
  `id_error` int NOT NULL AUTO_INCREMENT,
  `accion` varchar(100) DEFAULT NULL,
  `origen` varchar(250) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `mensaje` text,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_error`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `tbl_auditoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_auditoria`
--

LOCK TABLES `tbl_auditoria` WRITE;
/*!40000 ALTER TABLE `tbl_auditoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_auditoria` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_beneficiarios`
--

LOCK TABLES `tbl_beneficiarios` WRITE;
/*!40000 ALTER TABLE `tbl_beneficiarios` DISABLE KEYS */;
INSERT INTO `tbl_beneficiarios` VALUES (1,'403040729','Jacob','Calderón Unfried','2013-11-08',11,'huevo','no','2022-04-01','Griselda Guitta','6091-2053',0.00,2,1),(2,'403240639','Elian','Lépiz Ortuño','2017-10-03',8,'rinitis-clima','no','2019-11-01','Lilliam Ortuño Alfaro','7238-78-53',15000.00,1,1),(3,'403110706','Ethan','Sánchez Raiith','2015-03-27',10,'no','amoxicilina','2020-10-01','Maryelli Raitth Guzman','8303-9230',0.00,2,1),(4,'403110446','María Celeste','Montero Lara','2015-03-21',10,'conejos y hormigas','no','2020-06-11','Ashly Lara Salas','7032-2270',2666.00,1,1),(5,'403000564','Santiago','Hidalgo Molina','2012-12-20',12,'asma','Bomba de Salbutamol','2023-05-08','Katherine Molina Sánchez','8612-1617',40000.00,3,1),(6,'403320425','Alana','Hidalgo Molina','2019-05-08',6,'Tomate, Canela','no','2023-05-08','Katherine Molina Sánchez','8612-1617',40000.00,3,1),(7,'403280633','Saul Andrés','Cordero Hernandéz','2018-07-27',7,'salsa de tomate en la piel','no','2023-01-12','Juliana Hernandez Orozco','8580-0899',5000.00,1,1),(8,'403020337','Genesis','Araya Araya','2013-05-18',12,'no','no','2022-04-01','Yuliana Araya Brenes','6131-9057',0.00,1,1),(9,'403150839','Jeikol','Araya Araya','2016-01-12',9,'no','no','2022-04-01','Yuliana Araya Brenes','6131-9057',0.00,1,1),(10,'403260150','Samantha','Bermúdez Guadamuz','2018-01-05',7,'no','no','2022-08-08','Carmen Guadamuz Bonilla','7131-5990',0.00,2,1),(11,'403070858','Fabrizzio','Castro Leiva','2014-06-30',11,'no','no','2019-11-01','Eneida Tatiana Leiva Sánchez','7199-3850',0.00,2,1),(12,'403150984','Danna','Castro Witter','2016-01-15',9,'no','no','2020-06-11','Stefanny Witter Vargas','8324-0659',4000.00,1,1),(13,'403320726','Ian','Chavarría Sandí','2019-05-03',6,'no','no','2019-10-01','Kattia Sandí Araya','8862-1134',10000.00,1,1),(14,'403270102','Sebastián','Chavarría Sandí','2018-04-24',7,'no','no','2020-03-02','Kattia Sandí Araya','8862-1134',10000.00,1,1),(15,'210080388','Isaac','Chaves Solano','2016-01-26',9,'no','no','2022-06-01','Marianela Solano Rodríguez','8411-0707',0.00,1,1);
/*!40000 ALTER TABLE `tbl_beneficiarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_grupos`
--

DROP TABLE IF EXISTS `tbl_grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_grupos` (
  `id_grupo` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `nivel` varchar(50) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_grupos`
--

LOCK TABLES `tbl_grupos` WRITE;
/*!40000 ALTER TABLE `tbl_grupos` DISABLE KEYS */;
INSERT INTO `tbl_grupos` VALUES (1,'G001','Oruguitas','Niños recién nacidos hasta 1 año de edad.','Pre-materno','2025-01-03','2025-11-29',1),(2,'G002','Pollitos','Niños de 2 hasta 3 años de edad.','Materno','2025-01-04','2025-11-29',1),(3,'G003','Ovejitas','Niños de 4 hasta 6 años de edad.','Kinder','2025-01-05','2025-11-29',1),(4,'G004','Leones','Niños de 7 hasta 12 años de edad.','Primaria','2025-01-06','2025-11-29',1);
/*!40000 ALTER TABLE `tbl_grupos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_programas`
--

DROP TABLE IF EXISTS `tbl_programas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_programas` (
  `id_programa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `tipo` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_programas`
--

LOCK TABLES `tbl_programas` WRITE;
/*!40000 ALTER TABLE `tbl_programas` DISABLE KEYS */;
INSERT INTO `tbl_programas` VALUES (1,'PANI','Institución autónoma que protege y garantiza los derechos de la niñez y adolescencia en Costa Rica.','Público',1),(2,'IMAS','Institución que promueve el bienestar social y combatir la pobreza mediante programas de ayuda económica y social en Costa Rica.','Público',1),(3,'Privado','Programa financiado y administrado por entidades particulares o fundaciones sin fines de lucro que brindan apoyo directo a la niñez y sus familias.','Privado',1);
/*!40000 ALTER TABLE `tbl_programas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Master'),(2,'Admin');
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasenna` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_rol` int DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `identificacion` (`identificacion`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,'208600279','Cristopher','Rodríguez Fernández','crodriguez@gmail.com','Cris1204','2025-10-08 11:40:44',1,1),(2,'304700478','Tifanny','Miranda Morales','tmiranda@gmail.com','Tif0599','2025-10-08 11:40:44',2,1);
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-08 11:44:43
