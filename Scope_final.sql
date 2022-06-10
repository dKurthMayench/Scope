-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: Scope
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (2,'Odio los cocos','bm8gbWUgZ3VzdGFu','admin',4,'2022-03-07'),(9,'Como robar fosiles: parte 1','PHA+PHN0cm9uZz5ObyBlcyBpcsOzbmljbywgUmVhbG1lbnRlIGxsZW5vIHVuIHZhY8OtbyBlbiBtaSBjb3JhesOzbiBleHBvbGlhbmRvIG51ZXN0cm8gcGF0cmltb25pbyBnZW9sw7NnaWNvLiBZIGFob3JhIHR1IHRhbWJpw6luIHB1ZWRlcyEhPC9zdHJvbmc+PC9wPjxwPiZuYnNwOzwvcD48b2w+PGxpPjxzdHJvbmc+UGVyZmlsIHBzaXF1acOhdHJpY288L3N0cm9uZz48L2xpPjwvb2w+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij5TZWFtb3Mgc2luY2Vyb3MsIHNpIHBsYW5lYXMgcm9iYXIgZsOzc2lsZXMgcHJvYmFibGVtZW50ZSBlc3TDoXMgbWFsIGRlIGxhIGNhYmV6YS4gUGVybyBoYXkgdW5hcyBjdWFudGFzIGVuZmVybWVkYWRlcyBtZW50YWxlcyBxdWUgdmllbmVuIG1lam9yIG8gcGVvciBhIGxhIGhvcmEgZGUgaGFjZXJsby48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij48c3BhbiBzdHlsZT0iY29sb3I6cmdiKDc2LDIzMCw3Nik7Ij48c3Ryb25nPlZpZW5lbiBiaWVuPC9zdHJvbmc+PC9zcGFuPjwvcD48dWw+PGxpPjxzdHJvbmc+RGVwcmVzacOzbjwvc3Ryb25nPjogU2kgbm8gdGUgb2RpYXMgYSB0aSBtaXNtbywgbm8gdmFzIGEgcG9uZXIgZW4gcGVsaWdybyB0dSBpbnRlZ3JpZGFkIGbDrXNpY2EgcGFyYSBwaWNhciBjYXJhY29sYXMuPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+PHNwYW4gc3R5bGU9ImNvbG9yOnJnYigyMzAsNzYsNzYpOyI+PHN0cm9uZz5WaWVuZW4gbWFsPC9zdHJvbmc+PC9zcGFuPjwvcD48dWw+PGxpPjxzdHJvbmc+RXNxdWl6b2ZyZW5pYTwvc3Ryb25nPjogTXVjaGEgYnJvbWEgeSB0YWwgcGVybyBubyBxdWllcmVzIHRlbmVyIGFsdWNpbmFjaW9uZXMgYXVkaXRpdmFzIGRlIHJ1aWRvcyBkZSBtb3Rvcy48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHA+Jm5ic3A7ICZuYnNwOyAmbmJzcDsyLiDCvzxzdHJvbmc+UXXDqSBuZWNlc2l0bz88L3N0cm9uZz48L3A+PHVsPjxsaT48c3Ryb25nPk1vdmlkYXMgcGEgcGljYXI8L3N0cm9uZz46IEhheSB2YXJpb3MgdGlwb3MgY29uIHZlbnRhamFzIHkgZGVzdmVudGFqYXMuIFB1ZWRlIHNlciB1biBtYXJ0aWxsbyBnZW9sw7NnaWNvLCB1biBtYXJ0aWxsbyBjb24gdW5hIGN1w7FhLCBvIHNpIGVzdMOhcyBtYWwgZGUgbGEgY2FiZXphLCB1biByb3RhZmxleC48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHVsPjxsaT48c3Ryb25nPlJvcGE8L3N0cm9uZz46IFBhcmEgbm8gbW9yaXJ0ZSBkZSBoaXBvdGVybWlhLCBwaWxsYSByb3BhIHkgemFwYXRpbGxhcyBkZSBtb250ZS4gKFRydWNvOiBwdWVkZXMgcm9iYXJsYXMgZW4gZWwgcHJpbWFyayk8L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHVsPjxsaT48c3Ryb25nPk90cmFzIG1vdmlkYXM6PC9zdHJvbmc+IHZpZW5lIGJpZW4gbGxldmFyIHVuYSBsdXBhIGRlIGpveWVybyB5IHRlbmVyIGVuIGVsIG3Ds3ZpbCB1biBtYXBhIEdJUyBkZSBsYXMgZm9ybWFjaW9uZXMgZ2VvbMOzZ2ljYXMgZGUgRXNwYcOxYS48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHA+Jm5ic3A7ICZuYnNwOyAmbmJzcDszLiA8c3Ryb25nPlZhLCDCv3kgZG9uZGUgcm9ibz88L3N0cm9uZz48L3A+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij5TZW5jaWxsby4gQWJyZSBsYSBwYWdpbmEgZGVsIG1hcGEgZGUgcHVudG9zIGRlIGludGVyw6lzIGdlb2zDs2dpY28gZGVsIElHTUUsIHkgZWNoYSB1biB2aXN0YXpvIGEgbG9zIHNpdGlvcyBkb25kZSBwb25nYSAiaW50ZXLDqXMgcGFsZW9udG9sw7NnaWNvIi4gU2kgdGUgc2FiZXMgbGFzIGZvcm1hY2lvbmVzIGZvc2lsw61mZXJhcyB0b3JhIGRlIEFSQ0dJUyBwYXJhIGJ1c2NhciBhZmxvcmFtaWVudG9zLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPjxzcGFuIHN0eWxlPSJjb2xvcjpyZ2IoMjMwLDIzMCw3Nik7Ij48c3Ryb25nPlRpcG9zIGRlIHlhY2ltaWVudG9zOjwvc3Ryb25nPjwvc3Bhbj48L3A+PHVsPjxsaT48c3Ryb25nPkVsIHBvY2Fjb3NhOiA8L3N0cm9uZz5Db21vIHN1IG5vbWJyZSBpbmRpY2EsIGVzdGUgdGllbmUgcG9jYSBjb3NhLCBvIGxhIGNvc2EgbGEgdGllbmUgcG9yIG5pdmVsZXMuPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+Jm5ic3A7PC9wPjx1bD48bGk+PHN0cm9uZz5FbCBodWV2b2tpbmRlcjo8L3N0cm9uZz4gZXN0ZSB0aWVuZSBjb3NhLCBwZXJvIGxhIHRpZW5lIGRlbnRybyBkZSBuw7NkdWxvcy4gUGFyYSBzYWNhcmxhLCB0aWVuZXMgcXVlIHZlciBlbCBuw7NkdWxvIHkgcGFydGlybG8uIChUcnVjbzogYXByb3ZlY2hhIGxhcyByZWRlcyBkZSBkZXNwcmVuZGltaWVudG8pLjwvbGk+PC91bD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPiZuYnNwOzwvcD48dWw+PGxpPjxzdHJvbmc+RWwgbXVjaGFjb3NhOjwvc3Ryb25nPiBFc3RlIGFmbG9yYW1pZW50byBlc3TDoSBsbGVubyBkZSBjb3NhLCBjb21vIHBvciBlamVtcGxvIHVuIGFycmVjaWZlLiBSb2JhIGxvIHF1ZSB0ZSBwYXJlemNhIHF1ZSBwdWVkZSBzYWxpciBmw6FjaWwsIHBvcnF1ZSBtdWNoYXMgdmVjZXMgaGF5IHRhbnRvIHF1ZSBlcyBkaWbDrWNpbCBjZW50cmFyc2UuIEludGVudGEgbm8gZGVzdHJvemFyIGVsIHNpdGlvIHBvcnF1ZSBhbCBwYXJlY2VyIGhheSBnZW50ZSBxdWUgZXN0dWRpYSBlc28uPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+Jm5ic3A7PC9wPjx1bD48bGk+PHN0cm9uZz5FbCBjb3NhOjwvc3Ryb25nPiBFc3RlIGVzIHVuYSBiYXN1cmEgcG9ycXVlIGVsIGludGVyw6lzIHBhbGVvbnRvbMOzZ2ljbyB2aWVuZSBkZSB2ZXJ0ZWJyYWRvcyB5IG5vIG1lIGd1c3RhbiBsb3MgdmVydGVicmFkb3MuPC9saT48L3VsPjxwPiZuYnNwOyAmbmJzcDsgJm5ic3A7NC4gPHN0cm9uZz5GYXVuYSBkZWwgcm9iw7Nkcm9tbzwvc3Ryb25nPjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPkVzIGltcG9ydGFudGUgY29ub2NlciBsYSBmYXVuYSBsb2NhbCBwYXJhIGV2aXRhciBtdWx0YXMgZGUgZW50cmUgNjAwMCB5IDEyMDAwIGV1cm9zLjwvcD48cCBzdHlsZT0ibWFyZ2luLWxlZnQ6NDBweDsiPjxzcGFuIHN0eWxlPSJjb2xvcjpyZ2IoNzYsMjMwLDc2KTsiPjxzdHJvbmc+QW1pZ29zOjwvc3Ryb25nPjwvc3Bhbj48L3A+PHVsPjxsaT48c3Ryb25nPkdlbnRlIG1hcmlzcXVlYW5kbzo8L3N0cm9uZz4gRXN0w6FuIHJvYmFuZG8gaWd1YWwgcXVlIHTDui4gw7pzYWxvcyBkZSBlc2N1ZG8gaHVtYW5vIHNpIHZpZW5lIGVsIHNlcHJvbmEuJm5ic3A7PC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+Jm5ic3A7PC9wPjx1bD48bGk+PHN0cm9uZz5WaWVqb3MgZGUgcHVlYmxvOjwvc3Ryb25nPiBObyB0aWVuZW4gbmkgaWRlYSBkZSBsbyBxdWUgZXN0w6FzIGhhY2llbmRvIGFzw60gcXVlIG5vIHRlIHZhbiBhIGRlbnVuY2lhci4gU2kgcHJlZ3VudGFuLCBlcmVzIHVuIGdlw7Nsb2dvIGRlIHZlcmRhZCB5IG5vIHVuIGxvY28uPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+PHNwYW4gc3R5bGU9ImNvbG9yOnJnYigyMzAsNzYsNzYpOyI+PHN0cm9uZz5FbmVtaWdvczo8L3N0cm9uZz48L3NwYW4+PC9wPjx1bD48bGk+PHN0cm9uZz5FbCBzZXByb25hOjwvc3Ryb25nPiBlbCBhbnRpY3Jpc3RvLCBzaXJ2ZSBhIGxhcyBvcmRlbmVzIGRlIGxvcyB0cmlsb2JpdGVzIHkgbG9zIHJlcHRpbGlhbm9zIGRlIGxhIHRpZXJyYSBodWVjYS4gQsOhc2ljYW1lbnRlIHNvbiByb2JvdHMgZGlzZnJhemFkb3MgZGUgZ3VhcmRpYSBjaXZpbCBlbiBtb3RvLCBhc8OtIHF1ZSBzaSBlc2N1Y2hhcyBlbCBydWlkbyBkZSB1bmEgbW90bywgZ3VhcmRhIGVsIG1hcnRpbGxvIHkgY29ycmUuIE5vIHRpZW5lbiBwaWVkYWQsIHRlIGFicmlyw6FuIHVuYSBjdWVudGEgZGUgdGluZGVyIHNpIHRlIHBpbGxhbiwgYXPDrSBxdWUgw6FuZGF0ZSBjb24gb2pvLiBQdWVkZW4gZW1wbGVhciBlc2JpcnJvcyBjb21vIHBvciBlamVtcGxvIG9zb3MuIFRlbiBjdWlkYWRvIGNvbiBsb3Mgb3NvcyBwb3JxdWUgaGFjZW4gYmFzdGFudGUgZGHDsW8gc29icmUgdG9kbyBzaSBlc3RhcyByb2JhbmRvIGVuIEFzdHVyaWFzIG8gZW4gTGXDs24uPC9saT48L3VsPjxwPiZuYnNwOyAmbmJzcDsgJm5ic3A7NS4gPHN0cm9uZz5GYXVuYSByb2JhYmxlPC9zdHJvbmc+PC9wPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+QWwgZmluIHkgYWwgY2FibyBjdWFuZG8gdmFzIGEgcm9iYXIgZXMgcGFyYSBsbGV2YXJ0ZSBjb3NhcyBndWFwYXMuIEVzdG9zIHNvbiBsb3MgYmljaG9zIHF1ZSBwdWVkZXMgc3VzdHJhZXIgaWxlZ2FsbWVudGU6PC9wPjx1bD48bGk+PHN0cm9uZz5jcmlub2lkZW9zOiA8L3N0cm9uZz50aWVuZW4gcGludGEgZGUgY3JpcHRvbW9uZWRhIG8gZGUgZXN0cmVsbGl0YSBjb24gdW4gYWd1amVybyBlbiBtZWRpbywgZGVwZW5kaWVuZG8gZGUgbGEgw6lwb2NhLiBMb3MgZ3JhbmRlcyB5IGxvcyBjw6FsaWNlcyByZW50YW4gYmFzdGFudGUuPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+Jm5ic3A7PC9wPjx1bD48bGk+PHN0cm9uZz5Nb2x1c2NvczogPC9zdHJvbmc+TG9zIGhheSBkZSA0IHRpcG9zLiBDYXJhY29saWxsbywgbWVqaWxsw7NuLCBjYWxhbWFyIHkgYW1tb25vaWRlby4gTG9zIDIgcHJpbWVyb3Mgbm8gbmVjZXNpdGFuIGRlc2NyaXBjacOzbiwgeSBsb3MgZG9zIHNlZ3VuZG9zIHB1ZXMgc29uIGNvbW8gdW5hIGJhbGEgbyBjb21vIHVuIG5hdXRpbG9zIHBlcm8gbcOhcyBib25pdG8uIEN1aWRhZG8gcG9ycXVlIHRlIHB1ZWRlbiBzYWxpciBuYXV0aWxvcyB0YW1iacOpbiwgYSB2ZWNlcyBhbGFyZ2Fkb3MsIHkgdW5hcyBtb3ZpZGFzIHF1ZSBuYWRpZSBzYWJlIHF1ZSBzb24gKFRlbnRhY3VsaXRlcykuPC9saT48L3VsPjxwIHN0eWxlPSJtYXJnaW4tbGVmdDo0MHB4OyI+Jm5ic3A7PC9wPjx1bD48bGk+PHN0cm9uZz5Mb2ZvcmFkb3M6IDwvc3Ryb25nPkhheW8gMiB0aXBvcywgY2FyYWNvbG4ndCB5IG1lamlsbG9uJ3QgKGhpb2xpdGlkb3MgeSBicmFxdWlvcG9kb3MpLiBFc3TDoW4gYmFzdGFudGUgZ3VhcG9zIHkgc29uIGJhc3RhbnRlIGNvbXVuZXMgZW4gZWwgcGFsZW96b2ljbywgc29icmUgdG9kbyBsb3MgYnJhcXVpb3BvZG9zIGdyYW5kZXMgYXPDrSBiaWVuIHRvY2hvcy48L2xpPjwvdWw+PHAgc3R5bGU9Im1hcmdpbi1sZWZ0OjQwcHg7Ij4mbmJzcDs8L3A+PHVsPjxsaT48c3Ryb25nPkJvbGl0OiA8L3N0cm9uZz5Mb3MgbWFzIHByZWNpYWRvcy4gQSB2ZWNlcyBzZSBoYWNlbiBib2xhIHkgc29uIG11eSBjdXF1aXMuPC9saT48L3VsPjxwPlB1ZXMgZXNvIGdlbnRlLCBzaSBsbGVnbyBhIDEwMDAgdm90b3Mgc3ViaXLDqSBsYSBwYXJ0ZSAyLCB1biBzYWx1ZG8uPC9wPg==','admin',6,'2022-03-14'),(13,'Denuncia colectiva','PHA+QXllciBlbnRyYXJvbiBlbiB1biB5YWNpbWllbnRvIGRlIGZvc2lsZXMgeSByb2Jhcm9uIDM0IGVzcGVjaW1lbmVzIGRpc3RpbnRvcy4gRGVqYXJvbiBhdHJhcyBjYXJ0ZWxlcyBpbnN1bHRhbmRvIGFsIHNlcHJvbmEuIEhheSBxdWUgZW5jb250cmFyIGEgbG9zIGN1bHBhYmxlcyBsbyBhbnRlcyBwb3NpYmxlLjwvcD4=','MrJant',6,'2022-05-16');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (3,'Cocodrilos','Q29zYXMgZGUgY29jb2RyaWxvcw==','david','2022-03-04'),(4,'Cocos','Q29zYXMgZGUgY29jb3M=','david','2022-03-04'),(6,'Fosiles','Q29zYXMgZGUgZsOzc2lsZXM=','admin','2022-05-04'),(10,'catalizadores','Q29zYXMgZGUgY2F0YWxpemFkb3Jlcw==','lucas','2022-03-16');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (6,'admin',9,'TWUgaGEgYXl1ZGFkbyBtdWNow61zaW1vLCBlc3BlcmFuZG8gbGEgc2VndW5kYSBwYXJ0ZSA6RA==','2022-03-14'),(7,'admin',9,'YWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWFhYWE=','2022-03-14'),(9,'lucas',9,'RXBpY29uJ3Q=','2022-03-15');
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
/*!40000 ALTER TABLE `publicacionesguardadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siguiendo`
--

DROP TABLE IF EXISTS `siguiendo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siguiendo` (
  `seguidor` varchar(16) NOT NULL,
  `siguiendo` varchar(16) NOT NULL,
  PRIMARY KEY (`seguidor`,`siguiendo`),
  KEY `siguiendo` (`siguiendo`),
  CONSTRAINT `siguiendo_ibfk_1` FOREIGN KEY (`seguidor`) REFERENCES `usuarios` (`alias`),
  CONSTRAINT `siguiendo_ibfk_2` FOREIGN KEY (`siguiendo`) REFERENCES `usuarios` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siguiendo`
--

LOCK TABLES `siguiendo` WRITE;
/*!40000 ALTER TABLE `siguiendo` DISABLE KEYS */;
INSERT INTO `siguiendo` VALUES ('MrJant','admin');
/*!40000 ALTER TABLE `siguiendo` ENABLE KEYS */;
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
  `rep` int(11) DEFAULT 0,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 0,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('admin','$2y$10$r2FX1gsFqs9oizU0CioSEuziC5tzDnJbQ8ejkdpuSc/qyukgdM.Qm','admin@gmail.com',0,'Cuenta de administrador \"hola\"',1,'','Kurth Mayench','2022-06-06'),('david','$2y$10$48ZkHk3J5NupQoby7g7tQux.6lrD2KEraG1.gsfSrrm6R.8gsGVZ2','davidkurth10@gmail.com',0,NULL,1,NULL,NULL,'2022-06-06'),('lucas','$2y$10$0qEjpqVvy7wMRWPwBb5Ime1fWo2e0i7Oqt2/Ee4B2JbAj13LxjDwW','lucas@gmail.com',0,'hola :b',1,NULL,NULL,'2022-06-06'),('MrJant','$2y$10$wlcuHCU96J3..T3iC9dTJO8oY81buA88UGHPl/wgumnoPnBBAJJtq','davidkurth11@gmail.com',0,'Descripción épica',1,'David','ja','2022-06-06');
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
INSERT INTO `usuariosxcategorias` VALUES ('admin',3),('admin',6),('david',4),('lucas',6);
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
INSERT INTO `votosxarticulos` VALUES ('david',9,0),('lucas',2,1),('lucas',9,1),('MrJant',9,1);
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
INSERT INTO `votosxcomentarios` VALUES ('admin',6,1),('admin',7,0),('admin',9,1);
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

-- Dump completed on 2022-06-10  9:30:11
