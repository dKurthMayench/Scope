-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: scope
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `contenido` longtext DEFAULT NULL,
  `op` varchar(16) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `op` (`op`),
  KEY `categoria` (`categoria`),
  CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`op`) REFERENCES `usuarios` (`alias`) ON DELETE CASCADE,
  CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (9,'Como robar fosiles: parte 1','PHA+PHN0cm9uZz5ObyBlcyBpcsOzbmljbywgUmVhbG1lbnRlIGxsZW5vIHVuIHZhY8OtbyBlbiBtaSBjb3JhesOzbiBleHBvbGlhbmRvIG51ZXN0cm8gcGF0cmltb25pbyBnZW9sw7NnaWNvLiBZIGFob3JhIHR1IHRhbWJpw6luIHB1ZWRlcyEhPC9zdHJvbmc+PC9wPjxwPiZuYnNwOzwvcD48b2w+PGxpPjxzdHJvbmc+UGVyZmlsIHBzaXF1acOhdHJpY288L3N0cm9uZz48L2xpPjwvb2w+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij5TZWFtb3Mgc2luY2Vyb3MsIHNpIHBsYW5lYXMgcm9iYXIgZsOzc2lsZXMgcHJvYmFibGVtZW50ZSBlc3TDoXMgbWFsIGRlIGxhIGNhYmV6YS4gUGVybyBoYXkgdW5hcyBjdWFudGFzIGVuZmVybWVkYWRlcyBtZW50YWxlcyBxdWUgdmllbmVuIG1lam9yIG8gcGVvciBhIGxhIGhvcmEgZGUgaGFjZXJsby48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij48c3BhbiBzdHlsZT0iY29sb3I6cmdiKDc2LDIzMCw3Nik7Ij48c3Ryb25nPlZpZW5lbiBiaWVuPC9zdHJvbmc+PC9zcGFuPjwvcD48dWw+PGxpPjxzdHJvbmc+RGVwcmVzacOzbjwvc3Ryb25nPjogU2kgbm8gdGUgb2RpYXMgYSB0aSBtaXNtbywgbm8gdmFzIGEgcG9uZXIgZW4gcGVsaWdybyB0dSBpbnRlZ3JpZGFkIGbDrXNpY2EgcGFyYSBwaWNhciBjYXJhY29sYXMuPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+PHNwYW4gc3R5bGU9ImNvbG9yOnJnYigyMzAsNzYsNzYpOyI+PHN0cm9uZz5WaWVuZW4gbWFsPC9zdHJvbmc+PC9zcGFuPjwvcD48dWw+PGxpPjxzdHJvbmc+RXNxdWl6b2ZyZW5pYTwvc3Ryb25nPjogTXVjaGEgYnJvbWEgeSB0YWwgcGVybyBubyBxdWllcmVzIHRlbmVyIGFsdWNpbmFjaW9uZXMgYXVkaXRpdmFzIGRlIHJ1aWRvcyBkZSBtb3Rvcy48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHA+Jm5ic3A7ICZuYnNwOyAmbmJzcDsyLiDCvzxzdHJvbmc+UXXDqSBuZWNlc2l0bz88L3N0cm9uZz48L3A+PHVsPjxsaT48c3Ryb25nPk1vdmlkYXMgcGEgcGljYXI8L3N0cm9uZz46IEhheSB2YXJpb3MgdGlwb3MgY29uIHZlbnRhamFzIHkgZGVzdmVudGFqYXMuIFB1ZWRlIHNlciB1biBtYXJ0aWxsbyBnZW9sw7NnaWNvLCB1biBtYXJ0aWxsbyBjb24gdW5hIGN1w7FhLCBvIHNpIGVzdMOhcyBtYWwgZGUgbGEgY2FiZXphLCB1biByb3RhZmxleC48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHVsPjxsaT48c3Ryb25nPlJvcGE8L3N0cm9uZz46IFBhcmEgbm8gbW9yaXJ0ZSBkZSBoaXBvdGVybWlhLCBwaWxsYSByb3BhIHkgemFwYXRpbGxhcyBkZSBtb250ZS4gKFRydWNvOiBwdWVkZXMgcm9iYXJsYXMgZW4gZWwgcHJpbWFyayk8L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHVsPjxsaT48c3Ryb25nPk90cmFzIG1vdmlkYXM6PC9zdHJvbmc+IHZpZW5lIGJpZW4gbGxldmFyIHVuYSBsdXBhIGRlIGpveWVybyB5IHRlbmVyIGVuIGVsIG3Ds3ZpbCB1biBtYXBhIEdJUyBkZSBsYXMgZm9ybWFjaW9uZXMgZ2VvbMOzZ2ljYXMgZGUgRXNwYcOxYS48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHA+Jm5ic3A7ICZuYnNwOyAmbmJzcDszLiA8c3Ryb25nPlZhLCDCv3kgZG9uZGUgcm9ibz88L3N0cm9uZz48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij5TZW5jaWxsby4gQWJyZSBsYSBwYWdpbmEgZGVsIG1hcGEgZGUgcHVudG9zIGRlIGludGVyw6lzIGdlb2zDs2dpY28gZGVsIElHTUUsIHkgZWNoYSB1biB2aXN0YXpvIGEgbG9zIHNpdGlvcyBkb25kZSBwb25nYSAiaW50ZXLDqXMgcGFsZW9udG9sw7NnaWNvIi4gU2kgdGUgc2FiZXMgbGFzIGZvcm1hY2lvbmVzIGZvc2lsw61mZXJhcywgdGlyYSBkZSBBUkNHSVMgcGFyYSBidXNjYXIgYWZsb3JhbWllbnRvcy48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij48c3BhbiBzdHlsZT0iY29sb3I6cmdiKDIzMCwyMzAsNzYpOyI+PHN0cm9uZz5UaXBvcyBkZSB5YWNpbWllbnRvczo8L3N0cm9uZz48L3NwYW4+PC9wPjx1bD48bGk+PHN0cm9uZz5FbCBwb2NhY29zYTogPC9zdHJvbmc+Q29tbyBzdSBub21icmUgaW5kaWNhLCBlc3RlIHRpZW5lIHBvY2EgY29zYSwgbyBsYSBjb3NhIGxhIHRpZW5lIHBvciBuaXZlbGVzLjwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPiZuYnNwOzwvcD48dWw+PGxpPjxzdHJvbmc+RWwgaHVldm9raW5kZXI6PC9zdHJvbmc+IGVzdGUgdGllbmUgY29zYSwgcGVybyBsYSB0aWVuZSBkZW50cm8gZGUgbsOzZHVsb3MuIFBhcmEgc2FjYXJsYSwgdGllbmVzIHF1ZSB2ZXIgZWwgbsOzZHVsbyB5IHBhcnRpcmxvLiAoVHJ1Y286IGFwcm92ZWNoYSBsYXMgcmVkZXMgZGUgZGVzcHJlbmRpbWllbnRvKS48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHVsPjxsaT48c3Ryb25nPkVsIG11Y2hhY29zYTo8L3N0cm9uZz4gRXN0ZSBhZmxvcmFtaWVudG8gZXN0w6EgbGxlbm8gZGUgY29zYSwgY29tbyBwb3IgZWplbXBsbyB1biBhcnJlY2lmZS4gUm9iYSBsbyBxdWUgdGUgcGFyZXpjYSBxdWUgcHVlZGUgc2FsaXIgZsOhY2lsLCBwb3JxdWUgbXVjaGFzIHZlY2VzIGhheSB0YW50byBxdWUgZXMgZGlmw61jaWwgY2VudHJhcnNlLiBJbnRlbnRhIG5vIGRlc3Ryb3phciBlbCBzaXRpbyBwb3JxdWUgYWwgcGFyZWNlciBoYXkgZ2VudGUgcXVlIGVzdHVkaWEgZXNvLjwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPiZuYnNwOzwvcD48dWw+PGxpPjxzdHJvbmc+RWwgY29zYTo8L3N0cm9uZz4gRXN0ZSBlcyB1bmEgYmFzdXJhIHBvcnF1ZSBlbCBpbnRlcsOpcyBwYWxlb250b2zDs2dpY28gdmllbmUgZGUgdmVydGVicmFkb3MgeSBubyBtZSBndXN0YW4gbG9zIHZlcnRlYnJhZG9zLjwvbGk+PC91bD48cD4mbmJzcDsgJm5ic3A7ICZuYnNwOzQuIDxzdHJvbmc+RmF1bmEgZGVsIHJvYsOzZHJvbW88L3N0cm9uZz48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij5FcyBpbXBvcnRhbnRlIGNvbm9jZXIgbGEgZmF1bmEgbG9jYWwgcGFyYSBldml0YXIgbXVsdGFzIGRlIGVudHJlIDYwMDAgeSAxMjAwMCBldXJvcy48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij48c3BhbiBzdHlsZT0iY29sb3I6cmdiKDc2LDIzMCw3Nik7Ij48c3Ryb25nPkFtaWdvczo8L3N0cm9uZz48L3NwYW4+PC9wPjx1bD48bGk+PHN0cm9uZz5HZW50ZSBtYXJpc3F1ZWFuZG86PC9zdHJvbmc+IEVzdMOhbiByb2JhbmRvIGlndWFsIHF1ZSB0w7ouIMO6c2Fsb3MgZGUgZXNjdWRvIGh1bWFubyBzaSB2aWVuZSBlbCBzZXByb25hLiZuYnNwOzwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPiZuYnNwOzwvcD48dWw+PGxpPjxzdHJvbmc+Vmllam9zIGRlIHB1ZWJsbzo8L3N0cm9uZz4gTm8gdGllbmVuIG5pIGlkZWEgZGUgbG8gcXVlIGVzdMOhcyBoYWNpZW5kbyBhc8OtIHF1ZSBubyB0ZSB2YW4gYSBkZW51bmNpYXIuIFNpIHByZWd1bnRhbiwgZXJlcyB1biBnZcOzbG9nbyBkZSB2ZXJkYWQgeSBubyB1biBsb2NvLjwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPjxzcGFuIHN0eWxlPSJjb2xvcjpyZ2IoMjMwLDc2LDc2KTsiPjxzdHJvbmc+RW5lbWlnb3M6PC9zdHJvbmc+PC9zcGFuPjwvcD48dWw+PGxpPjxzdHJvbmc+RWwgc2Vwcm9uYTo8L3N0cm9uZz4gZWwgYW50aWNyaXN0bywgc2lydmUgYSBsYXMgb3JkZW5lcyBkZSBsb3MgdHJpbG9iaXRlcyB5IGxvcyByZXB0aWxpYW5vcyBkZSBsYSB0aWVycmEgaHVlY2EuIELDoXNpY2FtZW50ZSBzb24gcm9ib3RzIGRpc2ZyYXphZG9zIGRlIGd1YXJkaWEgY2l2aWwgZW4gbW90bywgYXPDrSBxdWUgc2kgZXNjdWNoYXMgZWwgcnVpZG8gZGUgdW5hIG1vdG8sIGd1YXJkYSBlbCBtYXJ0aWxsbyB5IGNvcnJlLiBObyB0aWVuZW4gcGllZGFkLCB0ZSBhYnJpcsOhbiB1bmEgY3VlbnRhIGRlIHRpbmRlciBzaSB0ZSBwaWxsYW4sIGFzw60gcXVlIMOhbmRhdGUgY29uIG9qby4gUHVlZGVuIGVtcGxlYXIgZXNiaXJyb3MgY29tbyBwb3IgZWplbXBsbyBvc29zLiBUZW4gY3VpZGFkbyBjb24gbG9zIG9zb3MgcG9ycXVlIGhhY2VuIGJhc3RhbnRlIGRhw7FvIHNvYnJlIHRvZG8gc2kgZXN0YXMgcm9iYW5kbyBlbiBBc3R1cmlhcyBvIGVuIExlw7NuLjwvbGk+PC91bD48cD4mbmJzcDsgJm5ic3A7ICZuYnNwOzUuIDxzdHJvbmc+RmF1bmEgcm9iYWJsZTwvc3Ryb25nPjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPkFsIGZpbiB5IGFsIGNhYm8gY3VhbmRvIHZhcyBhIHJvYmFyIGVzIHBhcmEgbGxldmFydGUgY29zYXMgZ3VhcGFzLiBFc3RvcyBzb24gbG9zIGJpY2hvcyBxdWUgcHVlZGVzIHN1c3RyYWVyIGlsZWdhbG1lbnRlOjwvcD48dWw+PGxpPjxzdHJvbmc+Y3Jpbm9pZGVvczogPC9zdHJvbmc+dGllbmVuIHBpbnRhIGRlIGNyaXB0b21vbmVkYSBvIGRlIGVzdHJlbGxpdGEgY29uIHVuIGFndWplcm8gZW4gbWVkaW8sIGRlcGVuZGllbmRvIGRlIGxhIMOpcG9jYS4gTG9zIGdyYW5kZXMgeSBsb3MgY8OhbGljZXMgcmVudGFuIGJhc3RhbnRlLjwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPiZuYnNwOzwvcD48dWw+PGxpPjxzdHJvbmc+TW9sdXNjb3M6IDwvc3Ryb25nPkxvcyBoYXkgZGUgNCB0aXBvcy4gQ2FyYWNvbGlsbG8sIG1lamlsbMOzbiwgY2FsYW1hciB5IGFtbW9ub2lkZW8uIExvcyAyIHByaW1lcm9zIG5vIG5lY2VzaXRhbiBkZXNjcmlwY2nDs24sIHkgbG9zIGRvcyBzZWd1bmRvcyBwdWVzIHNvbiBjb21vIHVuYSBiYWxhIG8gY29tbyB1biBuYXV0aWxvcyBwZXJvIG3DoXMgYm9uaXRvLiBDdWlkYWRvIHBvcnF1ZSB0ZSBwdWVkZW4gc2FsaXIgbmF1dGlsb3MgdGFtYmnDqW4sIGEgdmVjZXMgYWxhcmdhZG9zLCB5IHVuYXMgbW92aWRhcyBxdWUgbmFkaWUgc2FiZSBxdWUgc29uIChUZW50YWN1bGl0ZXMpLjwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPiZuYnNwOzwvcD48dWw+PGxpPjxzdHJvbmc+TG9mb3JhZG9zOiA8L3N0cm9uZz5IYXlvIDIgdGlwb3MsIGNhcmFjb2xuJ3QgeSBtZWppbGxvbid0IChoaW9saXRpZG9zIHkgYnJhcXVpb3BvZG9zKS4gRXN0w6FuIGJhc3RhbnRlIGd1YXBvcyB5IHNvbiBiYXN0YW50ZSBjb211bmVzIGVuIGVsIHBhbGVvem9pY28sIHNvYnJlIHRvZG8gbG9zIGJyYXF1aW9wb2RvcyBncmFuZGVzIGFzw60gYmllbiB0b2Nob3MuPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+Jm5ic3A7PC9wPjx1bD48bGk+PHN0cm9uZz5Cb2xpdDogPC9zdHJvbmc+TG9zIG1hcyBwcmVjaWFkb3MuIEEgdmVjZXMgc2UgaGFjZW4gYm9sYSB5IHNvbiBtdXkgY3VxdWlzLjwvbGk+PC91bD48cD5QdWVzIGVzbyBnZW50ZSwgc2kgbGxlZ28gYSAxMDAwIHZvdG9zIHN1Ymlyw6kgbGEgcGFydGUgMiwgdW4gc2FsdWRvLjwvcD4=','admin',6,'2022-03-14'),(10,'aaaaaaaaaa','PGZpZ3VyZSBjbGFzcz0ibWVkaWEiPjxvZW1iZWQgdXJsPSJodHRwczovL3R3aXR0ZXIuY29tL2JhZG9tZW5zY3VsdC9zdGF0dXMvMTUwMTI2ODA5Nzc5NzI4NzkzNj9yZWZfc3JjPXR3c3JjJTVFZ29vZ2xlJTdDdHdjYW1wJTVFc2VycCU3Q3R3Z3IlNUV0d2VldCU3Q3R3dHIlNUV0cnVlIj48L29lbWJlZD48L2ZpZ3VyZT4=','admin',6,'2022-03-14'),(11,'aaaaaaaaaaaaaaa','PHA+YWFhYWFhYShob2xhKXtodHRwczovL2dvb2dsZS5lc31hYWFhYWFhYWFhYWFhPC9wPg==','admin',6,'2022-03-16'),(12,'asddddddddddddddddddd','PHA+ZGRkZGRkZGRkZGRkZGRkPC9wPg==','admin',11,'2022-03-16');
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(16) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `propietario` varchar(16) DEFAULT NULL,
  `fecha_creacion` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `propietario` (`propietario`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`propietario`) REFERENCES `usuarios` (`alias`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (6,'Fosiles','Q29zYXMgZGUgZsOzc2lsZXM=','admin',NULL),(10,'catalizadores','Q29zYXMgZGUgY2F0YWxpemFkb3Jlcw==','lucas','2022-03-16'),(11,'Ucrania','VWNyYW5pYQ==','admin','2022-03-16');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comentador` varchar(16) DEFAULT NULL,
  `articulo` int(11) DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `fecha_publicacion` date DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `comentador` (`comentador`),
  KEY `articulo` (`articulo`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`comentador`) REFERENCES `usuarios` (`alias`) ON DELETE CASCADE,
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`articulo`) REFERENCES `articulos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (6,'admin',9,'TWUgaGEgYXl1ZGFkbyBtdWNow61zaW1vLCBlc3BlcmFuZG8gbGEgc2VndW5kYSBwYXJ0ZSA6RA==','2022-03-14'),(9,'lucas',9,'RXBpY29uJ3Q=','2022-03-15'),(10,'admin',9,'aG9sYSA6cGRzZnNhZGZkc2Fm','2022-03-15'),(12,'admin',11,'YWFhYWFh','2022-03-16');
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacionesguardadas`
--

DROP TABLE IF EXISTS `publicacionesguardadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacionesguardadas` (
  `alias` varchar(16) NOT NULL,
  `art` int(11) NOT NULL,
  PRIMARY KEY (`alias`,`art`),
  KEY `art` (`art`),
  CONSTRAINT `publicacionesguardadas_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `usuarios` (`alias`),
  CONSTRAINT `publicacionesguardadas_ibfk_2` FOREIGN KEY (`art`) REFERENCES `articulos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacionesguardadas`
--

LOCK TABLES `publicacionesguardadas` WRITE;
/*!40000 ALTER TABLE `publicacionesguardadas` DISABLE KEYS */;
INSERT INTO `publicacionesguardadas` VALUES ('admin',9);
/*!40000 ALTER TABLE `publicacionesguardadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `alias` varchar(16) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('','$2y$10$mxmD8sKoQZrTlVON49FttuOti136nhrHgZETOXaqn33WS1IBeS1b6','',NULL,NULL,NULL,0),('admin','$2y$10$v6Za8BQ8NUinWhaaKo4jFeKQyN7iDiPv8hu1Bqn6dfHPAR6K3Jk2a','admin@gmail.com','Cuenta de administradordsfsdfsd','admin','admin',1),('david','$2y$10$k7dJrFv3x/UlPtVT1ZKjl.Cgm2Ywfi67OYGq.G54L9dKck48RlUhu','davidkurth11@gmail.com',NULL,NULL,NULL,1),('lucas','$2y$10$0qEjpqVvy7wMRWPwBb5Ime1fWo2e0i7Oqt2/Ee4B2JbAj13LxjDwW','lucas@gmail.com','hola :b',NULL,NULL,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuariosxcategorias`
--

DROP TABLE IF EXISTS `usuariosxcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuariosxcategorias` (
  `alias` varchar(16) NOT NULL,
  `idCat` int(11) NOT NULL,
  PRIMARY KEY (`alias`,`idCat`),
  KEY `idCat` (`idCat`),
  CONSTRAINT `usuariosxcategorias_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `usuarios` (`alias`),
  CONSTRAINT `usuariosxcategorias_ibfk_2` FOREIGN KEY (`idCat`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariosxcategorias`
--

LOCK TABLES `usuariosxcategorias` WRITE;
/*!40000 ALTER TABLE `usuariosxcategorias` DISABLE KEYS */;
INSERT INTO `usuariosxcategorias` VALUES ('admin',11),('lucas',6);
/*!40000 ALTER TABLE `usuariosxcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votosxarticulos`
--

DROP TABLE IF EXISTS `votosxarticulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votosxarticulos` (
  `alias` varchar(16) NOT NULL,
  `art` int(11) NOT NULL,
  `positivo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`alias`,`art`),
  KEY `art` (`art`),
  CONSTRAINT `votosxarticulos_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `usuarios` (`alias`) ON DELETE CASCADE,
  CONSTRAINT `votosxarticulos_ibfk_2` FOREIGN KEY (`art`) REFERENCES `articulos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votosxarticulos`
--

LOCK TABLES `votosxarticulos` WRITE;
/*!40000 ALTER TABLE `votosxarticulos` DISABLE KEYS */;
INSERT INTO `votosxarticulos` VALUES ('admin',9,1),('admin',11,1),('admin',12,0),('lucas',9,1);
/*!40000 ALTER TABLE `votosxarticulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votosxcomentarios`
--

DROP TABLE IF EXISTS `votosxcomentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votosxcomentarios` (
  `alias` varchar(16) NOT NULL,
  `comentario` int(11) NOT NULL,
  `positivo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`alias`,`comentario`),
  KEY `comentario` (`comentario`),
  CONSTRAINT `votosxcomentarios_ibfk_1` FOREIGN KEY (`alias`) REFERENCES `usuarios` (`alias`) ON DELETE CASCADE,
  CONSTRAINT `votosxcomentarios_ibfk_2` FOREIGN KEY (`comentario`) REFERENCES `comentarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votosxcomentarios`
--

LOCK TABLES `votosxcomentarios` WRITE;
/*!40000 ALTER TABLE `votosxcomentarios` DISABLE KEYS */;
INSERT INTO `votosxcomentarios` VALUES ('admin',6,1),('admin',9,0),('admin',10,1);
/*!40000 ALTER TABLE `votosxcomentarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-30  7:54:22
