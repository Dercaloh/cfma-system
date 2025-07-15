-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: cfma_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`),
  KEY `idx_activity_log_subject` (`subject_type`,`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=434 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (98,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 01:57:30','2025-07-06 01:57:30'),(99,'usuarios','El usuario Root Administrator fue updated','App\\Models\\User','updated',1,'App\\Models\\User',21,'{\"attributes\":{\"first_name\":\"Root\",\"last_name\":\"Administrator\",\"email\":\"dercaloh@gmail.com\"},\"old\":{\"first_name\":\"Root\",\"last_name\":\"Administrator\",\"email\":\"dercaloh@gmail.com\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":\"updated\"}',NULL,'2025-07-06 01:57:42','2025-07-06 01:57:42'),(100,'gestión de roles y permisos','Actualizó roles, permisos, área y cargo del usuario.','App\\Models\\User',NULL,1,'App\\Models\\User',21,'{\"roles\":[\"Administrador\"],\"permissions\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"department\":\"Gestion Ti\",\"position\":\"Dinamizador\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}',NULL,'2025-07-06 01:57:42','2025-07-06 01:57:42'),(101,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 01:57:43','2025-07-06 01:57:43'),(102,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 01:58:20','2025-07-06 01:58:20'),(103,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 02:24:13','2025-07-06 02:24:13'),(104,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 02:24:42','2025-07-06 02:24:42'),(105,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 02:27:11','2025-07-06 02:27:11'),(106,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 02:49:53','2025-07-06 02:49:53'),(107,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 02:56:19','2025-07-06 02:56:19'),(108,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 03:02:05','2025-07-06 03:02:05'),(109,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:08:26','2025-07-06 03:08:26'),(110,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:12:35','2025-07-06 03:12:35'),(111,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:14:06','2025-07-06 03:14:06'),(112,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:15:31','2025-07-06 03:15:31'),(113,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:17:03','2025-07-06 03:17:03'),(114,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"ip_address\":\"127.0.0.1\",\"action\":null}',NULL,'2025-07-06 03:22:59','2025-07-06 03:22:59'),(115,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:24:57','2025-07-06 03:24:57'),(116,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:25:00','2025-07-06 03:25:00'),(117,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:25:01','2025-07-06 03:25:01'),(118,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 03:33:30','2025-07-06 03:33:30'),(119,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 03:57:25','2025-07-06 03:57:25'),(120,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 03:58:01','2025-07-06 03:58:01'),(121,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:58:04','2025-07-06 03:58:04'),(122,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:58:07','2025-07-06 03:58:07'),(123,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 03:58:09','2025-07-06 03:58:09'),(124,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:01:20','2025-07-06 04:01:20'),(125,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:01:25','2025-07-06 04:01:25'),(126,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:01:28','2025-07-06 04:01:28'),(127,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:01:29','2025-07-06 04:01:29'),(128,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:05:46','2025-07-06 04:05:46'),(129,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:05:58','2025-07-06 04:05:58'),(130,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:06:01','2025-07-06 04:06:01'),(131,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:06:09','2025-07-06 04:06:09'),(132,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:06:11','2025-07-06 04:06:11'),(133,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:06:12','2025-07-06 04:06:12'),(134,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:11:28','2025-07-06 04:11:28'),(135,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:11:34','2025-07-06 04:11:34'),(136,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:11:37','2025-07-06 04:11:37'),(137,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:11:38','2025-07-06 04:11:38'),(138,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:18:17','2025-07-06 04:18:17'),(139,'default','Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:18:22','2025-07-06 04:18:22'),(140,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:19:03','2025-07-06 04:19:03'),(141,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:19:06','2025-07-06 04:19:06'),(142,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:19:11','2025-07-06 04:19:11'),(143,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:19:12','2025-07-06 04:19:12'),(144,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:20:56','2025-07-06 04:20:56'),(145,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:21:03','2025-07-06 04:21:03'),(146,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:21:08','2025-07-06 04:21:08'),(147,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:21:11','2025-07-06 04:21:11'),(148,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:21:12','2025-07-06 04:21:12'),(149,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:22:46','2025-07-06 04:22:46'),(150,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:22:54','2025-07-06 04:22:54'),(151,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:22:55','2025-07-06 04:22:55'),(152,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:22:57','2025-07-06 04:22:57'),(153,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:30:34','2025-07-06 04:30:34'),(154,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:35:01','2025-07-06 04:35:01'),(155,'default','Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:35:17','2025-07-06 04:35:17'),(156,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:35:29','2025-07-06 04:35:29'),(157,'default','Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:35:35','2025-07-06 04:35:35'),(158,'default','Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:35:42','2025-07-06 04:35:42'),(159,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:36:08','2025-07-06 04:36:08'),(160,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:36:12','2025-07-06 04:36:12'),(161,'default','Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:36:13','2025-07-06 04:36:13'),(162,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:36:18','2025-07-06 04:36:18'),(163,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:36:20','2025-07-06 04:36:20'),(164,'default','Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada',NULL,NULL,NULL,'App\\Models\\User',21,'{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}',NULL,'2025-07-06 04:36:21','2025-07-06 04:36:21'),(165,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:39:06','2025-07-06 04:39:06'),(166,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:48:39','2025-07-06 04:48:39'),(167,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:48:59','2025-07-06 04:48:59'),(168,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:49:08','2025-07-06 04:49:08'),(169,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:49:40','2025-07-06 04:49:40'),(170,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:49:51','2025-07-06 04:49:51'),(171,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 04:50:02','2025-07-06 04:50:02'),(172,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:00:34','2025-07-06 05:00:34'),(173,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:03:11','2025-07-06 05:03:11'),(174,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:05:39','2025-07-06 05:05:39'),(175,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:06:28','2025-07-06 05:06:28'),(176,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:06:54','2025-07-06 05:06:54'),(177,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:07:35','2025-07-06 05:07:35'),(178,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:18:47','2025-07-06 05:18:47'),(179,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:18:56','2025-07-06 05:18:56'),(180,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 05:21:29','2025-07-06 05:21:29'),(181,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-06 22:26:40','2025-07-06 22:26:40'),(182,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:10:46','2025-07-09 02:10:46'),(183,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:11:00','2025-07-09 02:11:00'),(184,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:13:22','2025-07-09 02:13:22'),(185,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:16:07','2025-07-09 02:16:07'),(186,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:16:46','2025-07-09 02:16:46'),(187,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:17:10','2025-07-09 02:17:10'),(188,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:18:25','2025-07-09 02:18:25'),(189,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:18:51','2025-07-09 02:18:51'),(190,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:18:54','2025-07-09 02:18:54'),(191,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:19:45','2025-07-09 02:19:45'),(192,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:19:45','2025-07-09 02:19:45'),(193,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-09 02:40:13','2025-07-09 02:40:13'),(194,'usuarios','El usuario Test User fue created','App\\Models\\Users\\User','created',23,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Test\",\"last_name\":\"User\",\"email\":\"test@user.com\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.store\",\"action\":\"created\"}',NULL,'2025-07-10 02:37:46','2025-07-10 02:37:46'),(195,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 02:38:32','2025-07-10 02:38:32'),(196,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.roles.index\",\"action\":null}',NULL,'2025-07-10 02:43:25','2025-07-10 02:43:25'),(197,'gestión de roles y permisos','Visualizó listado de usuarios con sus roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 02:49:02','2025-07-10 02:49:02'),(198,'gestión de roles','Visualizó listado de roles.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:22:17','2025-07-10 18:22:17'),(199,'gestión de roles','Visualizó listado de roles.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:24:15','2025-07-10 18:24:15'),(200,'gestión de roles','Visualizó listado de roles.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:26:09','2025-07-10 18:26:09'),(201,'gestión de roles','Visualizó listado de roles.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:28:27','2025-07-10 18:28:27'),(202,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:30:00','2025-07-10 18:30:00'),(203,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:47:19','2025-07-10 18:47:19'),(204,'asignación de roles','Actualizó roles y permisos del usuario.','App\\Models\\Users\\User',NULL,5,'App\\Models\\Users\\User',21,'{\"roles\":[\"Vocero Principal\"],\"permissions\":[\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}',NULL,'2025-07-10 18:47:56','2025-07-10 18:47:56'),(205,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:47:56','2025-07-10 18:47:56'),(206,'asignación de roles','Actualizó roles y permisos del usuario.','App\\Models\\Users\\User',NULL,5,'App\\Models\\Users\\User',21,'{\"roles\":[\"Vocero Principal\"],\"permissions\":[\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}',NULL,'2025-07-10 18:48:11','2025-07-10 18:48:11'),(207,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:48:11','2025-07-10 18:48:11'),(208,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 18:48:38','2025-07-10 18:48:38'),(209,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-10 23:52:17','2025-07-10 23:52:17'),(210,'asignación de roles','Actualizó roles y permisos del usuario.','App\\Models\\Users\\User',NULL,23,'App\\Models\\Users\\User',21,'{\"roles\":[\"Aprendiz\"],\"permissions\":[\"gestionar activos\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}',NULL,'2025-07-11 02:25:31','2025-07-11 02:25:31'),(211,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-11 02:25:32','2025-07-11 02:25:32'),(212,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-11 02:26:23','2025-07-11 02:26:23'),(213,'asignación de roles','Actualizó roles y permisos del usuario.','App\\Models\\Users\\User',NULL,23,'App\\Models\\Users\\User',21,'{\"roles\":[\"Aprendiz\"],\"permissions\":[\"gestionar activos\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}',NULL,'2025-07-11 02:26:29','2025-07-11 02:26:29'),(214,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}',NULL,'2025-07-11 02:26:29','2025-07-11 02:26:29'),(215,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',22,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-11 18:09:43','2025-07-11 18:09:43'),(216,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',22,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-11 18:09:48','2025-07-11 18:09:48'),(217,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',22,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-11 18:13:28','2025-07-11 18:13:28'),(218,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',22,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-11 18:14:15','2025-07-11 18:14:15'),(219,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',22,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-11 18:14:30','2025-07-11 18:14:30'),(220,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 05:07:01','2025-07-12 05:07:01'),(221,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 05:13:20','2025-07-12 05:13:20'),(222,'usuarios','El usuario Test2 User2 fue updated','App\\Models\\Users\\User','updated',23,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"suspendido\"},\"old\":{\"first_name\":\"Test\",\"last_name\":\"User\",\"email\":\"test@user.com\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}',NULL,'2025-07-12 05:16:31','2025-07-12 05:16:31'),(223,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,23,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"1\",\"location_id\":\"40\",\"department_id\":\"10\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"suspendido\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"autorizar salidas de activos\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 05:16:31','2025-07-12 05:16:31'),(224,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 05:16:31','2025-07-12 05:16:31'),(225,'usuarios','El usuario Test2 User2 fue updated','App\\Models\\Users\\User','updated',23,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"suspendido\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}',NULL,'2025-07-12 05:18:01','2025-07-12 05:18:01'),(226,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,23,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"2\",\"location_id\":\"49\",\"department_id\":\"6\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"activo\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 05:18:01','2025-07-12 05:18:01'),(227,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 05:18:02','2025-07-12 05:18:02'),(228,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 15:37:01','2025-07-12 15:37:01'),(229,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 15:41:53','2025-07-12 15:41:53'),(230,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,23,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"2\",\"location_id\":\"49\",\"department_id\":\"6\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"activo\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 15:49:23','2025-07-12 15:49:23'),(231,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 15:49:23','2025-07-12 15:49:23'),(232,'usuarios','El usuario Test2 User2 fue updated','App\\Models\\Users\\User','updated',23,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}',NULL,'2025-07-12 15:55:28','2025-07-12 15:55:28'),(233,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,23,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"2\",\"location_id\":\"49\",\"department_id\":\"6\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"activo\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 15:55:28','2025-07-12 15:55:28'),(234,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 15:55:29','2025-07-12 15:55:29'),(235,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 15:58:39','2025-07-12 15:58:39'),(236,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 16:03:16','2025-07-12 16:03:16'),(237,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 16:03:47','2025-07-12 16:03:47'),(238,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 16:03:52','2025-07-12 16:03:52'),(239,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 16:05:10','2025-07-12 16:05:10'),(240,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 16:56:44','2025-07-12 16:56:44'),(241,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:01:46','2025-07-12 17:01:46'),(242,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:03:22','2025-07-12 17:03:22'),(243,'usuarios','El usuario Administrador Cfma fue updated','App\\Models\\Users\\User','updated',22,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Administrador\",\"last_name\":\"Cfma\",\"email\":\"admin@cfma.sena.edu.co\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Administrador\",\"last_name\":\"Cfma\",\"email\":\"admin@cfma.sena.edu.co\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}',NULL,'2025-07-12 17:05:21','2025-07-12 17:05:21'),(244,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,22,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Administrador\",\"last_name\":\"Cfma\",\"email\":\"admin@cfma.sena.edu.co\",\"username\":\"admin.cfma\",\"document_type\":\"CC\",\"identification_number\":\"12345874\",\"branch_id\":\"1\",\"location_id\":\"22\",\"department_id\":\"20\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":null,\"personal_email\":null,\"status\":\"activo\",\"account_valid_from\":\"2025-07-05\",\"account_valid_until\":null,\"consent_data_processing\":\"1\",\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 17:05:21','2025-07-12 17:05:21'),(245,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:05:22','2025-07-12 17:05:22'),(246,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:08:23','2025-07-12 17:08:23'),(247,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:08:39','2025-07-12 17:08:39'),(248,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:12:00','2025-07-12 17:12:00'),(249,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:12:23','2025-07-12 17:12:23'),(250,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:15:20','2025-07-12 17:15:20'),(251,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:16:01','2025-07-12 17:16:01'),(252,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:16:18','2025-07-12 17:16:18'),(253,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 17:19:42','2025-07-12 17:19:42'),(254,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:43:49','2025-07-12 19:43:49'),(255,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:48:04','2025-07-12 19:48:04'),(256,'usuarios','El usuario Harold Antonio Cordero Solera fue updated','App\\Models\\Users\\User','updated',21,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}',NULL,'2025-07-12 19:49:05','2025-07-12 19:49:05'),(257,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,21,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 19:49:05','2025-07-12 19:49:05'),(258,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:49:05','2025-07-12 19:49:05'),(259,'usuarios','El usuario Test 3 User2 fue created','App\\Models\\Users\\User','created',24,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.store\",\"action\":\"created\"}',NULL,'2025-07-12 19:50:06','2025-07-12 19:50:06'),(260,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:50:07','2025-07-12 19:50:07'),(261,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:50:52','2025-07-12 19:50:52'),(262,'usuarios','El usuario Test 3 User2 fue updated','App\\Models\\Users\\User','updated',24,'App\\Models\\Users\\User',21,'{\"attributes\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"status\":\"inactivo\"},\"old\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}',NULL,'2025-07-12 19:51:02','2025-07-12 19:51:02'),(263,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,24,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"username\":\"test-3user2\",\"document_type\":\"TI\",\"identification_number\":\"454545\",\"branch_id\":\"2\",\"location_id\":\"52\",\"department_id\":\"2\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":null,\"personal_email\":null,\"status\":\"inactivo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Aprendiz\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Aprendiz\"],\"permisos\":[\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 19:51:02','2025-07-12 19:51:02'),(264,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:51:03','2025-07-12 19:51:03'),(265,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:52:52','2025-07-12 19:52:52'),(266,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:53:03','2025-07-12 19:53:03'),(267,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:53:30','2025-07-12 19:53:30'),(268,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:53:34','2025-07-12 19:53:34'),(269,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:54:01','2025-07-12 19:54:01'),(270,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:54:06','2025-07-12 19:54:06'),(271,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:54:15','2025-07-12 19:54:15'),(272,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:55:23','2025-07-12 19:55:23'),(273,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 19:56:08','2025-07-12 19:56:08'),(274,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 20:02:11','2025-07-12 20:02:11'),(275,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 20:34:39','2025-07-12 20:34:39'),(276,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 20:37:58','2025-07-12 20:37:58'),(277,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 20:39:01','2025-07-12 20:39:01'),(278,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,21,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\",\"exportar usuarios\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-12 20:41:21','2025-07-12 20:41:21'),(279,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 20:41:22','2025-07-12 20:41:22'),(280,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 20:41:31','2025-07-12 20:41:31'),(281,'default','Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}',NULL,'2025-07-12 20:41:34','2025-07-12 20:41:34'),(282,'default','Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}',NULL,'2025-07-12 20:43:11','2025-07-12 20:43:11'),(283,'default','Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}',NULL,'2025-07-12 20:43:53','2025-07-12 20:43:53'),(284,'default','Exportó usuarios para backup (formato: csv, clasificación: Pública Clasificada)',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"export_format\":\"csv\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}',NULL,'2025-07-12 20:44:56','2025-07-12 20:44:56'),(285,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 23:09:29','2025-07-12 23:09:29'),(286,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 23:58:35','2025-07-12 23:58:35'),(287,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-12 23:58:57','2025-07-12 23:58:57'),(288,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 00:00:25','2025-07-13 00:00:25'),(289,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 02:36:37','2025-07-13 02:36:37'),(290,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 02:59:35','2025-07-13 02:59:35'),(291,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 03:35:16','2025-07-13 03:35:16'),(292,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 03:43:26','2025-07-13 03:43:26'),(293,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,21,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\",\"exportar usuarios\",\"importar usuarios\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-13 04:56:44','2025-07-13 04:56:44'),(294,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 04:56:45','2025-07-13 04:56:45'),(295,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 05:26:09','2025-07-13 05:26:09'),(296,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 05:26:29','2025-07-13 05:26:29'),(297,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 05:28:43','2025-07-13 05:28:43'),(298,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 05:29:19','2025-07-13 05:29:19'),(299,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 05:29:33','2025-07-13 05:29:33'),(300,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 06:00:45','2025-07-13 06:00:45'),(301,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko\\/20100101 Firefox\\/140.0\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 06:40:34','2025-07-13 06:40:34'),(302,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko\\/20100101 Firefox\\/140.0\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 06:44:45','2025-07-13 06:44:45'),(303,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 15:48:31','2025-07-13 15:48:31'),(304,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 15:52:11','2025-07-13 15:52:11'),(305,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:42:18','2025-07-13 16:42:18'),(306,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:42:42','2025-07-13 16:42:42'),(307,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:43:05','2025-07-13 16:43:05'),(308,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:44:28','2025-07-13 16:44:28'),(309,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:46:10','2025-07-13 16:46:10'),(310,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:48:24','2025-07-13 16:48:24'),(311,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:49:20','2025-07-13 16:49:20'),(312,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:49:27','2025-07-13 16:49:27'),(313,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:49:31','2025-07-13 16:49:31'),(314,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:51:58','2025-07-13 16:51:58'),(315,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 16:56:45','2025-07-13 16:56:45'),(316,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 17:09:32','2025-07-13 17:09:32'),(317,'default','Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}',NULL,'2025-07-13 17:09:37','2025-07-13 17:09:37'),(318,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 20:33:24','2025-07-13 20:33:24'),(319,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,21,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\",\"exportar usuarios\",\"importar usuarios\",\"gestionar tipos de activos\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-13 20:51:48','2025-07-13 20:51:48'),(320,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 20:51:49','2025-07-13 20:51:49'),(321,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 20:52:57','2025-07-13 20:52:57'),(322,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 22:52:41','2025-07-13 22:52:41'),(323,'actualización de usuario','Modificó la información general, roles y permisos del usuario.','App\\Models\\Users\\User',NULL,21,'App\\Models\\Users\\User',21,'{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\",\"exportar usuarios\",\"importar usuarios\",\"gestionar tipos de activos\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}',NULL,'2025-07-13 22:59:10','2025-07-13 22:59:10'),(324,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 22:59:10','2025-07-13 22:59:10'),(325,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 23:00:22','2025-07-13 23:00:22'),(326,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 23:25:39','2025-07-13 23:25:39'),(327,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 23:25:43','2025-07-13 23:25:43'),(328,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 23:26:37','2025-07-13 23:26:37'),(329,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 23:26:39','2025-07-13 23:26:39'),(330,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-13 23:27:08','2025-07-13 23:27:08'),(331,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:31:36','2025-07-14 00:31:36'),(332,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:31:45','2025-07-14 00:31:45'),(333,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:32:10','2025-07-14 00:32:10'),(334,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:32:29','2025-07-14 00:32:29'),(335,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:32:43','2025-07-14 00:32:43'),(336,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:32:52','2025-07-14 00:32:52'),(337,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:33:02','2025-07-14 00:33:02'),(338,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:33:08','2025-07-14 00:33:08'),(339,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:33:38','2025-07-14 00:33:38'),(340,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:33:46','2025-07-14 00:33:46'),(341,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:34:31','2025-07-14 00:34:31'),(342,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:35:00','2025-07-14 00:35:00'),(343,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:35:29','2025-07-14 00:35:29'),(344,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:37:17','2025-07-14 00:37:17'),(345,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:45:17','2025-07-14 00:45:17'),(346,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:45:41','2025-07-14 00:45:41'),(347,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 00:46:05','2025-07-14 00:46:05'),(348,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:57:51','2025-07-14 01:57:51'),(349,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:58:03','2025-07-14 01:58:03'),(350,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:58:24','2025-07-14 01:58:24'),(351,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:58:47','2025-07-14 01:58:47'),(352,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:59:07','2025-07-14 01:59:07'),(353,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:59:40','2025-07-14 01:59:40'),(354,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:59:47','2025-07-14 01:59:47'),(355,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 01:59:57','2025-07-14 01:59:57'),(356,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:00:07','2025-07-14 02:00:07'),(357,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:00:25','2025-07-14 02:00:25'),(358,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:00:37','2025-07-14 02:00:37'),(359,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:01:52','2025-07-14 02:01:52'),(360,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:01:59','2025-07-14 02:01:59'),(361,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:02:06','2025-07-14 02:02:06'),(362,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:02:23','2025-07-14 02:02:23'),(363,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:07:33','2025-07-14 02:07:33'),(364,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:07:41','2025-07-14 02:07:41'),(365,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:24:54','2025-07-14 02:24:54'),(366,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:28:56','2025-07-14 02:28:56'),(367,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:31:36','2025-07-14 02:31:36'),(368,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:32:41','2025-07-14 02:32:41'),(369,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:36:37','2025-07-14 02:36:37'),(370,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:39:47','2025-07-14 02:39:47'),(371,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:39:52','2025-07-14 02:39:52'),(372,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:40:18','2025-07-14 02:40:18'),(373,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:40:34','2025-07-14 02:40:34'),(374,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:43:03','2025-07-14 02:43:03'),(375,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:43:57','2025-07-14 02:43:57'),(376,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:44:54','2025-07-14 02:44:54'),(377,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:45:01','2025-07-14 02:45:01'),(378,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:45:15','2025-07-14 02:45:15'),(379,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:45:21','2025-07-14 02:45:21'),(380,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:45:27','2025-07-14 02:45:27'),(381,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:45:37','2025-07-14 02:45:37'),(382,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:49:51','2025-07-14 02:49:51'),(383,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:50:06','2025-07-14 02:50:06'),(384,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:50:47','2025-07-14 02:50:47'),(385,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:51:19','2025-07-14 02:51:19'),(386,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:51:54','2025-07-14 02:51:54'),(387,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:52:12','2025-07-14 02:52:12'),(388,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:52:28','2025-07-14 02:52:28'),(389,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:53:20','2025-07-14 02:53:20'),(390,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:53:38','2025-07-14 02:53:38'),(391,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 02:58:53','2025-07-14 02:58:53'),(392,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:00:21','2025-07-14 03:00:21'),(393,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:03:32','2025-07-14 03:03:32'),(394,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:04:58','2025-07-14 03:04:58'),(395,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:08:04','2025-07-14 03:08:04'),(396,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:08:39','2025-07-14 03:08:39'),(397,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:09:04','2025-07-14 03:09:04'),(398,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:12:16','2025-07-14 03:12:16'),(399,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:13:29','2025-07-14 03:13:29'),(400,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:13:53','2025-07-14 03:13:53'),(401,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:14:24','2025-07-14 03:14:24'),(402,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:21:33','2025-07-14 03:21:33'),(403,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:24:15','2025-07-14 03:24:15'),(404,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:25:24','2025-07-14 03:25:24'),(405,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:27:26','2025-07-14 03:27:26'),(406,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:27:35','2025-07-14 03:27:35'),(407,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:30:50','2025-07-14 03:30:50'),(408,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:34:04','2025-07-14 03:34:04'),(409,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:37:41','2025-07-14 03:37:41'),(410,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:40:05','2025-07-14 03:40:05'),(411,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:41:34','2025-07-14 03:41:34'),(412,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:55:43','2025-07-14 03:55:43'),(413,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 03:57:38','2025-07-14 03:57:38'),(414,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:00:24','2025-07-14 04:00:24'),(415,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:03:02','2025-07-14 04:03:02'),(416,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:03:12','2025-07-14 04:03:12'),(417,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:05:40','2025-07-14 04:05:40'),(418,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:07:27','2025-07-14 04:07:27'),(419,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:08:38','2025-07-14 04:08:38'),(420,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:08:50','2025-07-14 04:08:50'),(421,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:09:28','2025-07-14 04:09:28'),(422,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:10:26','2025-07-14 04:10:26'),(423,'gestión de usuarios y roles','Visualizó listado de usuarios con roles y permisos.',NULL,NULL,NULL,'App\\Models\\Users\\User',21,'{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}',NULL,'2025-07-14 04:16:05','2025-07-14 04:16:05'),(424,'asset_type','created','App\\Models\\Assets\\AssetType','created',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"name\":\"test\",\"description\":\"para hacer pruevas\",\"active\":true,\"created_by\":null,\"updated_by\":null,\"deleted_by\":null},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.store\",\"action\":\"created\"}',NULL,'2025-07-15 00:22:19','2025-07-15 00:22:19'),(425,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"description\":\"para hacer pruebas\"},\"old\":{\"description\":\"para hacer pruevas\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 00:23:16','2025-07-15 00:23:16'),(426,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"description\":\"para hacer pruebas 2\"},\"old\":{\"description\":\"para hacer pruebas\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 00:30:15','2025-07-15 00:30:15'),(427,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"description\":\"para hacer pruebas 3\"},\"old\":{\"description\":\"para hacer pruebas 2\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 00:37:39','2025-07-15 00:37:39'),(428,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"description\":\"para hacer pruebas\"},\"old\":{\"description\":\"para hacer pruebas 3\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 00:39:17','2025-07-15 00:39:17'),(429,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"description\":\"para hacer pruebas 1\"},\"old\":{\"description\":\"para hacer pruebas\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 00:49:34','2025-07-15 00:49:34'),(430,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"name\":\"test 2\",\"description\":\"para hacer pruebas\"},\"old\":{\"name\":\"test\",\"description\":\"para hacer pruebas 1\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 00:51:02','2025-07-15 00:51:02'),(431,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"name\":\"test\"},\"old\":{\"name\":\"test 2\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 01:25:33','2025-07-15 01:25:33'),(432,'asset_type','updated','App\\Models\\Assets\\AssetType','updated',17,'App\\Models\\Users\\User',21,'{\"attributes\":{\"name\":\"test d\",\"description\":\"para hacer pruebasa\"},\"old\":{\"name\":\"test\",\"description\":\"para hacer pruebas\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.update\",\"action\":\"updated\"}',NULL,'2025-07-15 01:46:11','2025-07-15 01:46:11'),(433,'asset_type','deleted','App\\Models\\Assets\\AssetType','deleted',17,'App\\Models\\Users\\User',21,'{\"old\":{\"name\":\"test d\",\"description\":\"para hacer pruebasa\",\"active\":true,\"created_by\":null,\"updated_by\":null,\"deleted_by\":null},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.tipos_activos.destroy\",\"action\":\"deleted\"}',NULL,'2025-07-15 02:52:05','2025-07-15 02:52:05');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_disposals`
--

DROP TABLE IF EXISTS `asset_disposals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_disposals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) unsigned NOT NULL,
  `disposal_date` date NOT NULL,
  `reason` enum('Obsolescencia','Daño','Pérdida','Donación','Otro') NOT NULL,
  `support_document` varchar(255) DEFAULT NULL,
  `observations` text DEFAULT NULL,
  `processed_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_disposals_asset_id_foreign` (`asset_id`),
  KEY `asset_disposals_processed_by_foreign` (`processed_by`),
  CONSTRAINT `asset_disposals_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `asset_disposals_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_disposals`
--

LOCK TABLES `asset_disposals` WRITE;
/*!40000 ALTER TABLE `asset_disposals` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_disposals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_hardware_details`
--

DROP TABLE IF EXISTS `asset_hardware_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_hardware_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) unsigned NOT NULL,
  `mac_address` varchar(17) DEFAULT NULL COMMENT 'MAC física, formato XX:XX:XX:XX:XX:XX',
  `os` varchar(50) DEFAULT NULL COMMENT 'Sistema operativo',
  `bios_version` varchar(50) DEFAULT NULL COMMENT 'Versión BIOS/UEFI',
  `cpu` varchar(100) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `storage` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `asset_hardware_details_asset_id_unique` (`asset_id`),
  UNIQUE KEY `asset_hardware_details_mac_address_unique` (`mac_address`),
  CONSTRAINT `asset_hardware_details_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_hardware_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_hardware_details`
--

LOCK TABLES `asset_hardware_details` WRITE;
/*!40000 ALTER TABLE `asset_hardware_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_hardware_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_software_details`
--

DROP TABLE IF EXISTS `asset_software_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_software_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `license_status` enum('autorizado','no_autorizado','desactualizado') NOT NULL DEFAULT 'autorizado',
  `install_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_software_details_asset_id_license_status_index` (`asset_id`,`license_status`),
  CONSTRAINT `asset_software_details_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_software_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_software_details`
--

LOCK TABLES `asset_software_details` WRITE;
/*!40000 ALTER TABLE `asset_software_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_software_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_types`
--

DROP TABLE IF EXISTS `asset_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Nombre único del tipo de activo (ej. Portátil, Impresora)',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción adicional del tipo',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico del tipo de activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `asset_types_name_unique` (`name`),
  KEY `asset_types_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_types`
--

LOCK TABLES `asset_types` WRITE;
/*!40000 ALTER TABLE `asset_types` DISABLE KEYS */;
INSERT INTO `asset_types` VALUES (1,'Computador de Escritorio','Tipo de activo: Computador de Escritorio',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(2,'Portátil','Tipo de activo: Portátil',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(3,'Tablet','Tipo de activo: Tablet',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(4,'Monitor','Tipo de activo: Monitor',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(5,'Proyector','Tipo de activo: Proyector',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(6,'Impresora','Tipo de activo: Impresora',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(7,'Switch','Tipo de activo: Switch',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(8,'Router','Tipo de activo: Router',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(9,'Servidor','Tipo de activo: Servidor',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(10,'Cámara Web','Tipo de activo: Cámara Web',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(11,'Mouse','Tipo de activo: Mouse',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(12,'Teclado','Tipo de activo: Teclado',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(13,'Software de Oficina','Tipo de activo: Software de Oficina',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(14,'Sistema Operativo','Tipo de activo: Sistema Operativo',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(15,'Antivirus','Tipo de activo: Antivirus',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(16,'Otro','Tipo de activo: Otro',1,'2025-07-02 22:54:52','2025-07-02 22:54:52',NULL),(17,'test d','para hacer pruebasa',1,'2025-07-15 00:22:18','2025-07-15 02:52:05','2025-07-15 02:52:05');
/*!40000 ALTER TABLE `asset_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombre del activo',
  `serial_number` varchar(100) NOT NULL COMMENT 'Número de serie',
  `placa` varchar(50) DEFAULT NULL COMMENT 'Número inventario institucional',
  `type_id` bigint(20) unsigned NOT NULL,
  `ownership` enum('Centro','Personal') NOT NULL DEFAULT 'Centro' COMMENT 'Propiedad',
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year_purchased` year(4) DEFAULT NULL COMMENT 'Año adquisición',
  `status` enum('Disponible','Prestado','En mantenimiento','Para baja','Retirado') NOT NULL DEFAULT 'Disponible',
  `condition` enum('Bueno','Regular','Dañado','En diagnóstico') NOT NULL DEFAULT 'Bueno',
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `loanable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '¿Puede prestarse?',
  `movable` tinyint(1) NOT NULL DEFAULT 0 COMMENT '¿Puede salir del recinto?',
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_serial_placa` (`serial_number`,`placa`),
  KEY `assets_ownership_index` (`ownership`),
  KEY `assets_year_purchased_index` (`year_purchased`),
  KEY `assets_status_index` (`status`),
  KEY `fk_assets_type` (`type_id`),
  KEY `fk_assets_location` (`location_id`),
  KEY `fk_assets_assigned_to` (`assigned_to`),
  KEY `idx_assets_status_location` (`status`,`location_id`),
  FULLTEXT KEY `assets_description_fulltext` (`description`),
  CONSTRAINT `assets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `assets_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `assets_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `asset_types` (`id`),
  CONSTRAINT `fk_assets_assigned_to` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_assets_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  CONSTRAINT `fk_assets_type` FOREIGN KEY (`type_id`) REFERENCES `asset_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombre de la sede (ej: El Bagre, Caucasia)',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Indicador de estado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_name_unique` (`name`),
  KEY `branches_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Sede Principal El Bagre',1,NULL,NULL,NULL),(2,'Sede Alterna El Bagre',1,NULL,NULL,NULL),(3,'Sede Virtual',1,NULL,NULL,NULL),(4,'Formación Extramural – Barrios El Bagre',1,NULL,NULL,NULL),(5,'Formación Extramural – Zonas Rurales El Bagre',1,NULL,NULL,NULL),(6,'Punto De Formación – Caucasia',1,NULL,NULL,NULL),(7,'Punto De Formación – Zaragoza',1,NULL,NULL,NULL),(8,'Punto De Formación – Nechí',1,NULL,NULL,NULL),(9,'Punto De Formación – Segovia',1,NULL,NULL,NULL),(10,'Punto De Formación – Tarazá',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('cfma_system_cache_spatie.permission.cache','a:3:{s:5:\"alias\";a:6:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:11:\"description\";s:1:\"k\";s:5:\"level\";}s:11:\"permissions\";a:12:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:18:\"gestionar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"gestionar activos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:20:\"gestionar préstamos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"ver reportes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:20:\"solicitar préstamos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:5;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:28:\"autorizar salidas de activos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:5;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:34:\"reclamar préstamos como apoderado\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:4;i:2;i:5;i:3;i:7;i:4;i:8;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"modificar perfil\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:9;}}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"crear usuarios\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"exportar usuarios\";s:1:\"c\";s:3:\"web\";}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:17:\"importar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:26:\"gestionar tipos de activos\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:8:{i:0;a:5:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrador\";s:1:\"j\";s:46:\"Acceso total al sistema (nivel técnico TI)...\";s:1:\"k\";i:0;s:1:\"c\";s:3:\"web\";}i:1;a:5:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"Subdirector\";s:1:\"j\";s:79:\"Apoyo en dirección operativa. Supervisa coordinaciones y proyectos especiales.\";s:1:\"k\";i:1;s:1:\"c\";s:3:\"web\";}i:2;a:5:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Coordinador\";s:1:\"j\";s:86:\"Líder de área formativa: diseño curricular, instructores y seguimiento a programas.\";s:1:\"k\";i:2;s:1:\"c\";s:3:\"web\";}i:3;a:5:{s:1:\"a\";i:4;s:1:\"b\";s:10:\"Instructor\";s:1:\"j\";s:93:\"Facilitador técnico-pedagógico. Ejecuta formación, evalúa competencias y guía proyectos.\";s:1:\"k\";i:3;s:1:\"c\";s:3:\"web\";}i:4;a:5:{s:1:\"a\";i:5;s:1:\"b\";s:21:\"Gestor Administrativo\";s:1:\"j\";s:74:\"Apoyo logístico: matrículas, bienestar, recursos físicos y proveedores.\";s:1:\"k\";i:4;s:1:\"c\";s:3:\"web\";}i:5;a:5:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"Vocero Principal\";s:1:\"j\";s:87:\"Representante estudiantil ante consejos directivos. Canaliza iniciativas de aprendices.\";s:1:\"k\";i:6;s:1:\"c\";s:3:\"web\";}i:6;a:5:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"Vocero Suplente\";s:1:\"j\";s:51:\"Apoyo al vocero principal y suplencia en ausencias.\";s:1:\"k\";i:7;s:1:\"c\";s:3:\"web\";}i:7;a:5:{s:1:\"a\";i:9;s:1:\"b\";s:8:\"Aprendiz\";s:1:\"j\";s:84:\"Beneficiario de formación. Acceso limitado a plataformas educativas y autogestión.\";s:1:\"k\";i:8;s:1:\"c\";s:3:\"web\";}}}',1752634304);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombre del departamento administrativo',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Visible en formularios',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`),
  KEY `departments_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'COORDINACIÓN ACADÉMICA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(2,'COORDINACIÓN ADMINISTRATIVA Y FINANCIERA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(3,'COORDINACIÓN DE PROGRAMAS ESPECIALES',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(4,'SUBDIRECCIÓN DE CENTRO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(5,'BIBLIOTECA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(6,'ALMACÉN',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(7,'SERVICIOS GENERALES',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(8,'GESTIÓN DOCUMENTAL (ARCHIVO)',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(9,'SISTEMAS (TIC)',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(10,'BIENESTAR AL APRENDIZ',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(11,'CONTRATACIÓN',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(12,'INVENTARIO Y CONTABILIDAD',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(13,'TESORERÍA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(14,'PRESUPUESTO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(15,'PLANEACIÓN',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(16,'SENNOVA (INNOVACIÓN Y TECNOLOGÍA)',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(17,'EVALUACIÓN Y CERTIFICACIÓN',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(18,'EMPLEO Y EMPRENDIMIENTO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(19,'SISTEMA DE GESTIÓN (SIGA / SOFIA PLUS)',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(20,'Gestion TI',1,'2025-07-06 00:27:31','2025-07-06 00:27:31',NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL COMMENT 'Nombre original del documento',
  `mime_type` varchar(100) NOT NULL COMMENT 'Tipo MIME del archivo',
  `size` bigint(20) unsigned NOT NULL COMMENT 'Tamaño del archivo en bytes',
  `hash_sha256` varchar(64) DEFAULT NULL COMMENT 'Hash SHA-256 para verificar integridad',
  `storage_path` varchar(191) DEFAULT NULL COMMENT 'Ruta del archivo cifrado en Laravel Storage',
  `documentable_id` bigint(20) unsigned NOT NULL COMMENT 'ID del modelo asociado',
  `documentable_type` varchar(191) NOT NULL COMMENT 'Clase del modelo asociado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_documentable` (`documentable_id`,`documentable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entry_exit_logs`
--

DROP TABLE IF EXISTS `entry_exit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entry_exit_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `entry_time` timestamp NULL DEFAULT NULL,
  `exit_time` timestamp NULL DEFAULT NULL,
  `access_point` varchar(255) DEFAULT NULL,
  `observations` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_exit_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `entry_exit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entry_exit_logs`
--

LOCK TABLES `entry_exit_logs` WRITE;
/*!40000 ALTER TABLE `entry_exit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `entry_exit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exit_passes`
--

DROP TABLE IF EXISTS `exit_passes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exit_passes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gate_log_id` bigint(20) unsigned NOT NULL COMMENT 'Registro de entrada/salida relacionado',
  `cuentadante` varchar(100) NOT NULL COMMENT 'Responsable de salida',
  `cedula` varchar(20) NOT NULL COMMENT 'Documento del cuentadante',
  `dependencia` varchar(100) NOT NULL COMMENT 'Área solicitante',
  `permiso` enum('temporal','permanente','definitivo') NOT NULL COMMENT 'Tipo de salida autorizada',
  `autorizado_salida` timestamp NULL DEFAULT NULL COMMENT 'Autorización de salida',
  `autorizado_regreso` timestamp NULL DEFAULT NULL COMMENT 'Autorización de reingreso',
  `signed_by` bigint(20) unsigned DEFAULT NULL COMMENT 'Usuario que firmó la salida',
  `archivo_pdf` varchar(191) DEFAULT NULL COMMENT 'Ruta del archivo PDF firmado',
  `estado` enum('pendiente','autorizado','rechazado','vencido') NOT NULL DEFAULT 'pendiente' COMMENT 'Estado actual del pase',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exit_passes_gate_log_id_index` (`gate_log_id`),
  KEY `exit_passes_permiso_index` (`permiso`),
  KEY `exit_passes_signed_by_index` (`signed_by`),
  KEY `exit_passes_estado_index` (`estado`),
  CONSTRAINT `fk_exit_gate_log` FOREIGN KEY (`gate_log_id`) REFERENCES `gate_logs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_exit_signed_by` FOREIGN KEY (`signed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exit_passes`
--

LOCK TABLES `exit_passes` WRITE;
/*!40000 ALTER TABLE `exit_passes` DISABLE KEYS */;
/*!40000 ALTER TABLE `exit_passes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gate_logs`
--

DROP TABLE IF EXISTS `gate_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gate_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` bigint(20) unsigned NOT NULL COMMENT 'Activo asociado al movimiento',
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Usuario que hizo el movimiento',
  `action` enum('salida','entrada') NOT NULL COMMENT 'Tipo de movimiento',
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del registro',
  `notes` text DEFAULT NULL COMMENT 'Observaciones del movimiento',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_gate_asset_fecha` (`asset_id`,`logged_at`),
  KEY `gate_logs_asset_id_index` (`asset_id`),
  KEY `gate_logs_user_id_index` (`user_id`),
  KEY `gate_logs_logged_at_index` (`logged_at`),
  FULLTEXT KEY `gate_logs_notes_fulltext` (`notes`),
  CONSTRAINT `fk_gate_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_gate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gate_logs`
--

LOCK TABLES `gate_logs` WRITE;
/*!40000 ALTER TABLE `gate_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `gate_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructor_program`
--

DROP TABLE IF EXISTS `instructor_program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructor_program` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `rol` enum('técnico','promotor') NOT NULL DEFAULT 'promotor' COMMENT 'Tipo de rol del instructor en el programa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instructor_program_unique` (`program_id`,`user_id`,`rol`),
  KEY `instructor_program_user_id_foreign` (`user_id`),
  CONSTRAINT `instructor_program_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `instructor_program_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructor_program`
--

LOCK TABLES `instructor_program` WRITE;
/*!40000 ALTER TABLE `instructor_program` DISABLE KEYS */;
/*!40000 ALTER TABLE `instructor_program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intangible_assets`
--

DROP TABLE IF EXISTS `intangible_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intangible_assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `origin` enum('Propio','Adquirido') NOT NULL,
  `type` varchar(255) NOT NULL,
  `license_number` varchar(255) DEFAULT NULL,
  `acquisition_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `acquisition_cost` decimal(12,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `support_document` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intangible_assets`
--

LOCK TABLES `intangible_assets` WRITE;
/*!40000 ALTER TABLE `intangible_assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `intangible_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_approvals`
--

DROP TABLE IF EXISTS `loan_approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_approvals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `decided_by` bigint(20) unsigned DEFAULT NULL,
  `status` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `justification` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_loan_status_decision` (`loan_id`,`status`),
  KEY `idx_loan_approvals_loan_id` (`loan_id`),
  KEY `idx_loan_approvals_decided_by` (`decided_by`),
  KEY `loan_approvals_approved_at_index` (`approved_at`),
  CONSTRAINT `fk_loan_approvals_decided_by` FOREIGN KEY (`decided_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_loan_approvals_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_approvals`
--

LOCK TABLES `loan_approvals` WRITE;
/*!40000 ALTER TABLE `loan_approvals` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_details`
--

DROP TABLE IF EXISTS `loan_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `cantidad` tinyint(3) unsigned NOT NULL DEFAULT 1 COMMENT 'Cantidad de activos prestados',
  `dias_solicitados` tinyint(3) unsigned NOT NULL DEFAULT 1 COMMENT 'Días solicitados para el préstamo',
  `modalidad_entrega` enum('presencial','delegado') NOT NULL DEFAULT 'presencial',
  `hora_entrega` time NOT NULL COMMENT 'Hora pactada de entrega',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_loan_details_loan_id` (`loan_id`),
  CONSTRAINT `fk_loan_details_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_details`
--

LOCK TABLES `loan_details` WRITE;
/*!40000 ALTER TABLE `loan_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_request_data`
--

DROP TABLE IF EXISTS `loan_request_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_request_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `tipo_de_uso` enum('formativo','administrativo') NOT NULL,
  `program_id` bigint(20) unsigned DEFAULT NULL,
  `instructor_id` bigint(20) unsigned DEFAULT NULL,
  `proposito` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `position_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `fecha_entrega_deseada` date DEFAULT NULL,
  `reclamado_por_apoderado` tinyint(1) NOT NULL DEFAULT 0,
  `nombre_apoderado` varchar(100) DEFAULT NULL,
  `documento_apoderado` varchar(20) DEFAULT NULL,
  `proxy_type_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_loan_request_loan_id` (`loan_id`),
  KEY `loan_request_data_program_id_foreign` (`program_id`),
  KEY `loan_request_data_instructor_id_foreign` (`instructor_id`),
  KEY `loan_request_data_position_id_foreign` (`position_id`),
  KEY `loan_request_data_proxy_type_id_foreign` (`proxy_type_id`),
  KEY `loan_request_data_tipo_de_uso_index` (`tipo_de_uso`),
  KEY `loan_request_data_fecha_entrega_deseada_index` (`fecha_entrega_deseada`),
  KEY `fk_request_depto` (`department_id`),
  KEY `fk_request_branch` (`branch_id`),
  CONSTRAINT `fk_loan_request_data_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_request_branch` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `fk_request_depto` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `fk_request_loan` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  CONSTRAINT `loan_request_data_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loan_request_data_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loan_request_data_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loan_request_data_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loan_request_data_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loan_request_data_proxy_type_id_foreign` FOREIGN KEY (`proxy_type_id`) REFERENCES `proxy_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_request_data`
--

LOCK TABLES `loan_request_data` WRITE;
/*!40000 ALTER TABLE `loan_request_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_request_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan_statuses`
--

DROP TABLE IF EXISTS `loan_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Estado único del préstamo',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción del estado',
  `order_index` tinyint(3) unsigned NOT NULL DEFAULT 0 COMMENT 'Posición en listados',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loan_statuses_name_unique` (`name`),
  KEY `loan_statuses_order_index_index` (`order_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_statuses`
--

LOCK TABLES `loan_statuses` WRITE;
/*!40000 ALTER TABLE `loan_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `asset_id` bigint(20) unsigned NOT NULL,
  `status_id` bigint(20) unsigned NOT NULL,
  `approved_by` bigint(20) unsigned DEFAULT NULL,
  `delivered_by` bigint(20) unsigned DEFAULT NULL,
  `received_by` bigint(20) unsigned DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de solicitud',
  `approved_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de aprobación',
  `delivered_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de entrega',
  `returned_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de devolución',
  `notes` text DEFAULT NULL COMMENT 'Observaciones generales',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_approved_by_foreign` (`approved_by`),
  KEY `loans_delivered_by_foreign` (`delivered_by`),
  KEY `loans_received_by_foreign` (`received_by`),
  KEY `loans_user_requested_idx` (`user_id`,`requested_at`),
  KEY `loans_requested_at_index` (`requested_at`),
  KEY `loans_approved_at_index` (`approved_at`),
  KEY `loans_returned_at_index` (`returned_at`),
  KEY `fk_loans_asset` (`asset_id`),
  KEY `fk_loans_status` (`status_id`),
  KEY `idx_loans_user_asset` (`user_id`,`asset_id`),
  CONSTRAINT `1` FOREIGN KEY (`status_id`) REFERENCES `loan_statuses` (`id`),
  CONSTRAINT `fk_loans_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  CONSTRAINT `fk_loans_status` FOREIGN KEY (`status_id`) REFERENCES `loan_statuses` (`id`),
  CONSTRAINT `fk_loans_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `loans_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loans_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `loans_delivered_by_foreign` FOREIGN KEY (`delivered_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loans_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nombre ubicación',
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_name_unique` (`name`),
  KEY `fk_locations_branch_id` (`branch_id`),
  CONSTRAINT `fk_locations_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (11,3,'Ubicación del usuario','Sede Virtual',1,'2025-07-07 00:42:06',NULL,NULL),(12,4,'I.E. 20 de Julio','Extramural Barrios El Bagre',1,'2025-07-07 00:42:06',NULL,NULL),(13,4,'I.E. Bijao','Extramural Barrios El Bagre',1,'2025-07-07 00:42:06',NULL,NULL),(14,4,'I.E. El Bagre','Extramural Barrios El Bagre',1,'2025-07-07 00:42:06',NULL,NULL),(15,4,'I.E. La Esmeralda','Extramural Barrios El Bagre',1,'2025-07-07 00:42:06',NULL,NULL),(16,4,'I.E. Las Delicias','Extramural Barrios El Bagre',1,'2025-07-07 00:42:06',NULL,NULL),(17,7,'Zaragoza','Punto de Formación Zaragoza',1,'2025-07-07 00:42:06',NULL,NULL),(18,8,'Nechí','Punto de Formación Nechí',1,'2025-07-07 00:42:06',NULL,NULL),(19,9,'Segovia','Punto de Formación Segovia',1,'2025-07-07 00:42:06',NULL,NULL),(20,1,'B3 P1 - Biblioteca','Apoyo a la Formación',1,'2025-07-07 00:42:06',NULL,NULL),(21,1,'B3 P1 - Lúdica- Gimnasio','Apoyo a la Formación',1,'2025-07-07 00:42:06',NULL,NULL),(22,1,'B1 P1 - Auditorio','Apoyo a la Formación',1,'2025-07-07 00:42:06',NULL,NULL),(23,1,'B2 P1 - Simuladores','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(24,1,'B2 P1 - Taller Metalmecánica','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(25,1,'B2 P2 - Salvamento','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(26,1,'B2 P2 - Bilingüismo','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(27,1,'B2 P2 - Planometría','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(28,1,'B2 P2 - Neumática','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(29,1,'B3 P2 - Polivalente 2 - STEM','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(30,1,'B3 P2 - Polivalente 3 - Desarrollo empresarial','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(31,1,'B3 P2 - Polivalente 4 - Competencias blandas','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(32,1,'B3 P3 - Polivalente 5 - Joyería','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(33,1,'B3 P3 - Polivalente 6 - Ecominería','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(34,1,'B3 P3 - Polivalente 7 - Energías alternativas','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(35,1,'B1 P1 - Área Administrativa 1','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(36,1,'B2 P1 - Herramentario','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(37,1,'B3 P1 - Polivalente 1 - Instructores','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(38,1,'B3 P2 - Área Administrativa 2','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(39,1,'B3 P3 - Bienestar','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(40,1,'B2 P1 - Bodega','Almacén',1,'2025-07-07 00:42:06',NULL,NULL),(41,1,'B1 P1 - Bodega TIC','Almacén',1,'2025-07-07 00:42:06',NULL,NULL),(42,1,'B2 P2 - Bodega','Almacén',1,'2025-07-07 00:42:06',NULL,NULL),(43,1,'B2 P1 - Laboratorio','Innovación',1,'2025-07-07 00:42:06',NULL,NULL),(44,2,'B2 - Polivalente 1','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(45,2,'B2 - Polivalente 2','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(46,2,'B3 - Polivalente 3','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(47,2,'B3 - Polivalente 4','Formación',1,'2025-07-07 00:42:06',NULL,NULL),(48,2,'B1 - Área administrativa','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(49,2,'B2 - Archivo','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(50,2,'B2 - Almacén','Administrativo',1,'2025-07-07 00:42:06',NULL,NULL),(51,2,'B4 - Bodega 1','Almacén',1,'2025-07-07 00:42:06',NULL,NULL),(52,2,'B5 - Bodega 2','Almacén',1,'2025-07-07 00:42:06',NULL,NULL);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_06_01_000029_create_cache_table',1),(2,'2025_06_01_000030_create_jobs_table',1),(3,'2025_07_01_000000_create_roles_table',1),(4,'2025_07_01_000001_create_users_table',1),(5,'2025_07_01_000002_create_permissions_table',1),(6,'2025_07_01_000003_add_user_fks_to_roles_table',1),(7,'2025_07_01_000003_create_notifications_table',1),(8,'2025_07_01_000003_create_user_security_table',1),(9,'2025_07_01_000004_create_sessions_table',1),(10,'2025_07_01_000005_create_role_permission_table',1),(11,'2025_07_01_000006_create_locations_table',1),(12,'2025_07_01_000007_create_branches_table',1),(13,'2025_07_01_000008_create_assets_types_table',1),(14,'2025_07_01_000009_create_assets_table',1),(15,'2025_07_01_000010_create_asset_hardware_details_table',1),(16,'2025_07_01_000011_create_asset_software_details_table',1),(17,'2025_07_01_000012_create_loan_statuses_table',1),(18,'2025_07_01_000013_create_loans_table',1),(19,'2025_07_01_000014_create_loan_details_table',1),(20,'2025_07_01_000015_create_loan_approvals_table',1),(21,'2025_07_01_000015_create_positions_table',1),(22,'2025_07_01_000015_create_programs_table',1),(23,'2025_07_01_000015_create_proxy_types_table',1),(24,'2025_07_01_000016_create_departments_table',1),(25,'2025_07_01_000016_create_loan_request_data_table',1),(26,'2025_07_01_000017_create_signatures_table',1),(27,'2025_07_01_000018_create_documents_table',1),(28,'2025_07_01_000019_create_gate_logs_table',1),(29,'2025_07_01_000020_create_exit_passes_table',1),(30,'2025_07_01_000021_create_audit_logs_table',1),(31,'2025_07_01_000026_create_instructor_program_table',1),(32,'2025_07_01_000028_add_fks_to_users_table',1),(33,'2025_07_01_000028_create_personal_access_tokens_table',1),(34,'2025_07_03_233643_add_is_system_event_to_audit_logs_table',2),(35,'2025_07_03_235056_create_user_policies_table',3),(36,'2025_07_03_235409_add_user_id_to_user_policies_table',4),(37,'2025_07_03_235611_add_user_id_to_user_policies_table',5),(38,'2025_07_03_235407_add_user_id_to_user_policies_table',6),(39,'2025_07_04_000343_fix_user_policies_structure',7),(40,'2025_07_04_000343_fix_user_policies_structures',8),(41,'2025_07_04_231318_create_activity_log_table',9),(42,'2025_07_04_231319_add_event_column_to_activity_log_table',9),(43,'2025_07_04_231320_add_batch_uuid_column_to_activity_log_table',9),(44,'2025_07_04_231415_create_permission_tables',10),(45,'2025_07_05_011051_add_description_and_level_to_roles_table',11),(46,'2025_07_05_023521_create_policy_views_table',12),(47,'2025_07_06_165502_add_soft_deletes_to_roles_table',13),(48,'2025_07_07_205922_create_additional_asset_tables',14),(49,'2025_07_09_130837_add_document_type_to_users_table',15),(50,'2025_07_10_133419_add_deleted_at_to_permissions_table',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\Users\\User',21),(1,'App\\Models\\User',22),(1,'App\\Models\\Users\\User',22),(2,'App\\Models\\User',1),(2,'App\\Models\\Users\\User',21),(2,'App\\Models\\User',22),(2,'App\\Models\\Users\\User',22),(2,'App\\Models\\Users\\User',23),(3,'App\\Models\\User',1),(3,'App\\Models\\Users\\User',21),(3,'App\\Models\\User',22),(3,'App\\Models\\Users\\User',22),(4,'App\\Models\\User',1),(4,'App\\Models\\Users\\User',21),(4,'App\\Models\\User',22),(4,'App\\Models\\Users\\User',22),(5,'App\\Models\\User',1),(5,'App\\Models\\Users\\User',21),(5,'App\\Models\\User',22),(5,'App\\Models\\Users\\User',22),(5,'App\\Models\\Users\\User',23),(6,'App\\Models\\User',1),(6,'App\\Models\\Users\\User',21),(6,'App\\Models\\User',22),(6,'App\\Models\\Users\\User',22),(6,'App\\Models\\Users\\User',23),(7,'App\\Models\\User',1),(7,'App\\Models\\Users\\User',5),(7,'App\\Models\\Users\\User',21),(7,'App\\Models\\User',22),(7,'App\\Models\\Users\\User',22),(7,'App\\Models\\Users\\User',23),(8,'App\\Models\\User',1),(8,'App\\Models\\Users\\User',5),(8,'App\\Models\\Users\\User',21),(8,'App\\Models\\User',22),(8,'App\\Models\\Users\\User',22),(8,'App\\Models\\Users\\User',23),(8,'App\\Models\\Users\\User',24),(9,'App\\Models\\Users\\User',21),(10,'App\\Models\\Users\\User',21),(11,'App\\Models\\Users\\User',21),(12,'App\\Models\\Users\\User',21);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',21),(1,'App\\Models\\Users\\User',21),(1,'App\\Models\\User',22),(1,'App\\Models\\Users\\User',22),(4,'App\\Models\\Users\\User',23),(7,'App\\Models\\Users\\User',5),(9,'App\\Models\\Users\\User',24);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'Tipo de evento notificado: préstamo, alerta, sistema, etc.',
  `title` varchar(100) NOT NULL COMMENT 'Título breve o resumen visible de la notificación',
  `message` text NOT NULL COMMENT 'Contenido completo de la notificación',
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Marca si el usuario ya la leyó',
  `read_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha y hora exacta en la que fue leída',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_read_status` (`user_id`,`is_read`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'gestionar usuarios','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(2,'gestionar activos','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(3,'gestionar préstamos','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(4,'ver reportes','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(5,'solicitar préstamos','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(6,'autorizar salidas de activos','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(7,'reclamar préstamos como apoderado','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(8,'modificar perfil','web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(9,'crear usuarios','web','2025-07-12 19:47:45','2025-07-12 19:47:45',NULL),(10,'exportar usuarios','web','2025-07-12 20:40:13','2025-07-12 20:40:13',NULL),(11,'importar usuarios','web','2025-07-13 04:56:22','2025-07-13 04:56:22',NULL),(12,'gestionar tipos de activos','web','2025-07-13 20:51:29','2025-07-13 20:51:29',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policy_views`
--

DROP TABLE IF EXISTS `policy_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `policy_views` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `policy_version` varchar(10) NOT NULL DEFAULT '1.0.0',
  PRIMARY KEY (`id`),
  KEY `policy_views_viewed_at_index` (`viewed_at`),
  KEY `policy_views_user_id_foreign` (`user_id`),
  CONSTRAINT `policy_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policy_views`
--

LOCK TABLES `policy_views` WRITE;
/*!40000 ALTER TABLE `policy_views` DISABLE KEYS */;
INSERT INTO `policy_views` VALUES (126,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 02:29:05',NULL,'1.0'),(127,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 02:49:53',NULL,'1.0'),(128,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 02:56:18',NULL,'1.0'),(129,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 03:02:05',NULL,'1.0'),(130,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 03:12:34',NULL,'1.0'),(131,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 03:17:02',NULL,'1.0'),(132,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 03:33:29',NULL,'1.0'),(133,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 03:57:24',NULL,'1.0'),(134,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 03:58:01',NULL,'1.0.0'),(135,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:01:20',NULL,'1.0.0'),(136,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:05:46',NULL,'1.0'),(137,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:05:58',NULL,'1.0'),(138,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:11:28',NULL,'1.0'),(139,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:18:16',NULL,'1.0'),(140,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:20:56',NULL,'1.0'),(141,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:22:46',NULL,'1.0'),(142,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:30:34',NULL,'1.0'),(143,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:35:01',NULL,'1.0'),(144,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:48:39',NULL,'1.0'),(145,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:48:58',NULL,'1.0'),(146,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:49:08',NULL,'1.0'),(147,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:49:40',NULL,'1.0'),(148,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:49:51',NULL,'1.0.0'),(149,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 04:50:02',NULL,'1.0.0'),(150,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:00:34',NULL,'1.0'),(151,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:03:10',NULL,'1.0'),(152,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:05:38',NULL,'1.0'),(153,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:06:28',NULL,'1.0.0'),(154,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:06:54',NULL,'1.0.0'),(155,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:07:34',NULL,'1.0'),(156,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:18:46',NULL,'1.0'),(157,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:18:56',NULL,'1.0.0'),(158,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:19:45',NULL,'1.0'),(159,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:21:29',NULL,'1.0'),(160,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:23:24',NULL,'1.0'),(161,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:23:44',NULL,'1.0'),(162,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:25:51',NULL,'1.0.0'),(163,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:29:16',NULL,'1.0'),(164,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:32:09',NULL,'1.0'),(165,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:33:16',NULL,'1.0'),(166,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:38:46',NULL,'1.0.0'),(167,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:39:07',NULL,'1.0.0'),(168,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:39:29',NULL,'1.0.0'),(169,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:40:21',NULL,'1.0'),(170,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:42:23',NULL,'1.0'),(171,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:42:59',NULL,'1.0'),(172,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0','2025-07-06 05:44:04',NULL,'1.0');
/*!40000 ALTER TABLE `policy_views` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Nombre del cargo o función',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado de uso',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `positions_title_unique` (`title`),
  KEY `positions_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'Apoyo De Almacén',1,'2025-07-02 22:54:51','2025-07-05 23:35:21',NULL),(2,'APOYO DE BIBLIOTECA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(3,'Técnico En Gestión Documental',1,'2025-07-02 22:54:51','2025-07-05 23:35:21',NULL),(4,'ANALISTA DE SOPORTE TIC',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(5,'APOYO CONTABLE',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(6,'PROFESIONAL DE RRHH',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(7,'INSTRUCTOR TITULADA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(8,'Instructor Media Técnica',1,'2025-07-02 22:54:51','2025-07-05 23:35:21',NULL),(9,'INSTRUCTOR VIRTUAL',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(10,'INSTRUCTOR CAMPESENA',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(11,'INSTRUCTOR COMPLEMENTARIO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(12,'EVALUADOR DE COMPETENCIAS LABORALES',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(13,'Coordinador Académico',1,'2025-07-02 22:54:51','2025-07-05 23:35:21',NULL),(14,'Líder De Bienestar Al Aprendiz',1,'2025-07-02 22:54:51','2025-07-05 23:35:21',NULL),(15,'SUBDIRECTOR DE CENTRO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(16,'COORDINADOR ADMINISTRATIVO Y FINANCIERO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(17,'COORDINADOR DE FORMACION',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(18,'Psicólogo(A)',1,'2025-07-02 22:54:51','2025-07-05 23:35:22',NULL),(19,'DINAMIZADOR',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(20,'INGENIERO CIVIL',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(21,'PROFESIONAL',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(22,'Apoyo De Atención Al Ciudadano',1,'2025-07-02 22:54:51','2025-07-05 23:35:22',NULL),(23,'APRENDIZ TITULADO',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(24,'Aprendiz De Media Técnica',1,'2025-07-02 22:54:51','2025-07-05 23:35:22',NULL),(25,'APRENDIZ PRACTICANTE',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(26,'Monitor Académico',1,'2025-07-02 22:54:51','2025-07-05 23:35:22',NULL),(27,'VOCERO DE APRENDICES',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(28,'Soporte en sitio',1,'2025-07-06 00:27:31','2025-07-06 00:27:31',NULL);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Nombre del programa de formación',
  `code` varchar(20) DEFAULT NULL COMMENT 'Código interno del programa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `programs_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proxy_types`
--

DROP TABLE IF EXISTS `proxy_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proxy_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Tipo de apoderado: Vocero, Subvocero, Monitor, etc.',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Habilitado para selección',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proxy_types_name_unique` (`name`),
  KEY `proxy_types_active_index` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proxy_types`
--

LOCK TABLES `proxy_types` WRITE;
/*!40000 ALTER TABLE `proxy_types` DISABLE KEYS */;
INSERT INTO `proxy_types` VALUES (1,'Vocero',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(2,'Vocero Suplente',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(3,'Monitor Académico',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(4,'Aprendiz Practicante',1,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(5,'Apoderado Legal',0,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL);
/*!40000 ALTER TABLE `proxy_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `real_estate_assets`
--

DROP TABLE IF EXISTS `real_estate_assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `real_estate_assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ownership_type` enum('Propiedad','Comodato','Arriendo','Otro') NOT NULL,
  `address` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `area_m2` decimal(10,2) DEFAULT NULL,
  `use_type` enum('Formación','Administrativo','Mixto','Otro') NOT NULL,
  `legal_document` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `real_estate_assets`
--

LOCK TABLES `real_estate_assets` WRITE;
/*!40000 ALTER TABLE `real_estate_assets` DISABLE KEYS */;
/*!40000 ALTER TABLE `real_estate_assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(4,2),(4,3),(5,1),(5,4),(5,5),(6,1),(6,4),(6,5),(7,1),(7,4),(7,5),(7,7),(7,8),(8,1),(8,9),(11,1),(11,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT 9,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','Acceso total al sistema (nivel técnico TI)...',0,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(2,'Subdirector','Apoyo en dirección operativa. Supervisa coordinaciones y proyectos especiales.',1,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(3,'Coordinador','Líder de área formativa: diseño curricular, instructores y seguimiento a programas.',2,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(4,'Instructor','Facilitador técnico-pedagógico. Ejecuta formación, evalúa competencias y guía proyectos.',3,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(5,'Gestor Administrativo','Apoyo logístico: matrículas, bienestar, recursos físicos y proveedores.',4,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(6,'Portería/Vigilancia','Control de accesos, seguridad perimetral y registro de visitas.',5,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(7,'Vocero Principal','Representante estudiantil ante consejos directivos. Canaliza iniciativas de aprendices.',6,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(8,'Vocero Suplente','Apoyo al vocero principal y suplencia en ausencias.',7,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL),(9,'Aprendiz','Beneficiario de formación. Acceso limitado a plataformas educativas y autogestión.',8,'web','2025-07-05 06:20:17','2025-07-05 06:20:17',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL COMMENT 'IP de origen de la sesión',
  `user_agent` varchar(255) DEFAULT NULL COMMENT 'Agente de navegador o dispositivo',
  `payload` text NOT NULL COMMENT 'Datos serializados y cifrados de la sesión',
  `last_activity` int(10) unsigned NOT NULL COMMENT 'Marca de tiempo UNIX de la última actividad',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_activity` (`user_id`,`last_activity`),
  KEY `sessions_last_activity_index` (`last_activity`),
  CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('PF2a2zvg7xbxUwrewK6jDQZgPAXyIJwXw8ptKpzl',21,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','ZXlKcGRpSTZJa1pzZG1FMWRGSnJiRmx3U0c5YWRFVjRTR3R3Y1djOVBTSXNJblpoYkhWbElqb2lkbTVFY1Zod2MycDBiRGgwYUdvNFpqZzRSbE5tV0ZaVE5sQmxWbVkwYkRka1kyOWtMeXRJSzFWV2FrdElURXczYnpNeFJVWmtjbWd3VFVzeGNYRTFZMUpDVnpZeGEzVjVOVzVtZWxnMlFVdERabU5zZFdweWJTOHhiRVp0WjFoTGJtUlBTVWw0Y0N0c1NrZHhNMHQzUjBoclRURnVhekZqWW0xU2JYZ3JSemx0UnpGQ1VXbElkRlJYWlRWWVJIWkRaemRuYjNaQ05HTnRVbUpvWldKTlIwRmtjRWhtVUhSdVRuZHBVaTlaYW14U1NUZFdSWEJCTTFWWU9HRm9iVFJOYURkSGVuWk1Ta2czZERobGNtTkdTV2hzTUN0NFNYWTRkRkl2UzNsUFJtOUplVzVwTTJKVE9YUkNPVzE0V0VKd2JHcHpObkIwVGtncmRYWm5jV1ZvVG01bWVsY3lhRkJyWkN0dFRuUTBNMGRCWmxaU01FZERRVlY0UzJ4dlYydzVkMWhOWTJWaGVtWldialZoSzNoRWIySk1iVkoyTVdOb2VIWkxURkZKTTBSclltZHZhRGhMY1hSdmVqTjBSRmxxTlVacGJHOHZaVThyVFN0SlRqbENSVUZNUm5wR09VOXJORXhxYkZwdVZHRkJXRzlqY0VGRmRVTTBSbVZZUW5kVUlpd2liV0ZqSWpvaU56RTRaalZpTUdOaU56TTFaamt6TXpWaE1UTXlZekV4WldSak16TmpOREUzTWpCbE56RmlNVEUzWWpJeVlqQTRNamd6T1dWbU9EY3hPRGRqWlRsa05TSXNJblJoWnlJNklpSjk=',1752551889,NULL,NULL);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signatures`
--

DROP TABLE IF EXISTS `signatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `signatures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `type` enum('entrega','devolucion') NOT NULL COMMENT 'Tipo de firma',
  `signature_blob` blob NOT NULL COMMENT 'Firma en BLOB',
  `signature_hash` varchar(64) DEFAULT NULL COMMENT 'Hash SHA-256',
  `signed_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha firma',
  `observacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_signature_per_user_type` (`loan_id`,`user_id`,`type`),
  KEY `fk_signatures_user_id` (`user_id`),
  KEY `signatures_signed_at_index` (`signed_at`),
  CONSTRAINT `fk_signatures_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_signatures_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signatures`
--

LOCK TABLES `signatures` WRITE;
/*!40000 ALTER TABLE `signatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `signatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_organizational_data`
--

DROP TABLE IF EXISTS `user_organizational_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_organizational_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `contract_type` enum('planta','temporal','externo','contratista') DEFAULT 'planta',
  `salary` decimal(12,2) DEFAULT NULL,
  `supervisor_id` bigint(20) unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  KEY `user_id` (`user_id`),
  KEY `supervisor_id` (`supervisor_id`),
  CONSTRAINT `user_organizational_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_organizational_data_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_organizational_data`
--

LOCK TABLES `user_organizational_data` WRITE;
/*!40000 ALTER TABLE `user_organizational_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_organizational_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_policies`
--

DROP TABLE IF EXISTS `user_policies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_policies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `policy_name` varchar(255) NOT NULL,
  `policy_version` varchar(255) NOT NULL DEFAULT '1.0',
  `accepted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `accepted_ip` varchar(45) DEFAULT NULL,
  `accepted_user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_policies_user_id_foreign` (`user_id`),
  CONSTRAINT `user_policies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_policies`
--

LOCK TABLES `user_policies` WRITE;
/*!40000 ALTER TABLE `user_policies` DISABLE KEYS */;
INSERT INTO `user_policies` VALUES (1,21,'Política de privacidad','1.0','2025-07-04 05:05:27','127.0.0.1',NULL,'2025-07-04 05:05:27','2025-07-04 05:05:27'),(2,1,'data_protection','1.0.0','2025-07-05 21:13:11','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','2025-07-05 21:13:11','2025-07-05 21:13:11');
/*!40000 ALTER TABLE `user_policies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_security`
--

DROP TABLE IF EXISTS `user_security`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_security` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `mfa_secret` blob DEFAULT NULL COMMENT 'Secreto TOTP encriptado',
  `mfa_enabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'MFA activado',
  `mfa_enabled_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de activación',
  `mfa_last_ip` varchar(45) DEFAULT NULL COMMENT 'Última IP de validación MFA',
  `mfa_last_verified_at` timestamp NULL DEFAULT NULL COMMENT 'Último acceso exitoso con MFA',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_security_user_id_foreign` (`user_id`),
  CONSTRAINT `user_security_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_security`
--

LOCK TABLES `user_security` WRITE;
/*!40000 ALTER TABLE `user_security` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_security` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `document_type` varchar(10) NOT NULL DEFAULT 'CC' COMMENT 'Tipo de documento: CC, TI, CE, NIT, PAS',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `full_name` varchar(101) GENERATED ALWAYS AS (concat(`first_name`,' ',`last_name`)) VIRTUAL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `identification_number` varchar(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_password_change_at` timestamp NULL DEFAULT NULL,
  `password_policy_version` varchar(10) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `position_id` bigint(20) unsigned DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `personal_email` varchar(100) DEFAULT NULL,
  `institutional_email` varchar(100) DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `branch_id` bigint(20) unsigned DEFAULT NULL,
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('activo','inactivo','suspendido','eliminado') NOT NULL DEFAULT 'activo',
  `account_valid_from` date DEFAULT NULL,
  `account_valid_until` date DEFAULT NULL,
  `consent_data_processing` tinyint(1) NOT NULL DEFAULT 0,
  `consent_marketing` tinyint(1) NOT NULL DEFAULT 0,
  `consent_data_sharing` tinyint(1) NOT NULL DEFAULT 0,
  `consent_timestamp` timestamp NULL DEFAULT NULL,
  `privacy_policy_version` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_employee_id_unique` (`employee_id`),
  KEY `idx_email_status` (`email_verified_at`,`status`),
  KEY `idx_user_audit` (`created_at`),
  KEY `users_last_login_at_index` (`last_login_at`),
  KEY `users_status_index` (`status`),
  KEY `users_department_id_foreign` (`department_id`),
  KEY `fk_users_location_id` (`location_id`),
  KEY `fk_users_branch_id` (`branch_id`),
  KEY `users_position_id_foreign` (`position_id`),
  CONSTRAINT `fk_users_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_users_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'CC','Root','Administrator','Root Administrator','root','dercaloh@gmail.com','',NULL,'$2y$12$XmpaZt4VjAX0R3hA4SEd7u3Q370yluQ0VAM.rT9J/myqfUUzwomPW',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,20,NULL,NULL,'activo',NULL,NULL,1,0,0,'2025-07-02 22:54:48','1.0','2025-07-02 22:54:48','2025-07-06 01:57:42',NULL),(3,'CC','María','Pérez','María Pérez','subdirectora','m.perez@sena.edu.co','','2025-07-02 22:54:51','$2y$12$nnQdWc7dpPU99IGr0LZrYuR7.A6y2lW.oopht.E4aIct1ClNXZziK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,5,NULL,NULL,'activo',NULL,NULL,1,0,0,NULL,NULL,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(4,'CC','Luis','Martínez','Luis Martínez','coordtic','l.martinez@sena.edu.co','','2025-07-02 22:54:51','$2y$12$sFc5MjfCnmNd4MaALbKa/.2j3IranSPJjl721zwSiLomIpuj5ku7K',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,10,NULL,NULL,'activo',NULL,NULL,1,0,0,NULL,NULL,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(5,'CC','Laura','López','Laura López','func_admin','l.lopez@sena.edu.co','','2025-07-02 22:54:51','$2y$12$ADW9vjAPzvl8YZxwYMN4k.tF6PU48CQGlUv58Kv9mZoiRyGbUpdDi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,'activo',NULL,NULL,1,0,0,NULL,NULL,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(6,'CC','Camilo','Gómez','Camilo Gómez','porteria1','c.gomez@sena.edu.co','','2025-07-02 22:54:51','$2y$12$.mwGOa4vSexscyNDzc5a1eNlhO1YVHa9ccwnkKOU.vF4RJTsbM4eS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,8,NULL,NULL,'activo',NULL,NULL,1,0,0,NULL,NULL,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(7,'CC','Julián','Mejía','Julián Mejía','aprendiz1','julian.mejia@misena.edu.co','','2025-07-02 22:54:51','$2y$12$OU2vAK/w6Pbb3qF.mgn12OUvvnCtbM7Yju5lbUVAi67Vhbwl3s5L6',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,16,NULL,NULL,'activo',NULL,NULL,1,0,0,NULL,NULL,'2025-07-02 22:54:51','2025-07-02 22:54:51',NULL),(21,'CC','Harold Antonio','Cordero Solera','Harold Antonio Cordero Solera','hacordero','dercaloh@hotmail.com','1040498580',NULL,'$2y$12$eX1EdKQAkiCtL5Z8Pas.1uJceKlx3DHBjnfUFIQn3Ah.ueQcQ4dHy',NULL,NULL,NULL,NULL,NULL,NULL,19,'3218724618','dercaloh@hotmail.com',NULL,20,2,48,'activo',NULL,NULL,0,0,0,NULL,NULL,'2025-07-04 05:05:27','2025-07-13 22:59:10',NULL),(22,'CC','Administrador','Cfma','Administrador Cfma','admin.cfma','admin@cfma.sena.edu.co','12345874',NULL,'$2y$12$DEpYw/0mAk571SXSJhsXPuNxpyQeNQK7myrj3w.nbRN1WqZsm.k/m',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,NULL,20,1,22,'activo','2025-07-05',NULL,1,0,0,'2025-07-05 08:00:58','1.0','2025-07-05 08:00:58','2025-07-12 17:05:21',NULL),(23,'TI','Test2','User2','Test2 User2','tuser','test@user.es','123456789',NULL,'$2y$12$KtJ8L.0gLGL5vHefv.mKcezvYON7H3IOEEtcMD2U5dqHOhoBocY/u',NULL,NULL,NULL,NULL,NULL,NULL,4,'3218724618','test@user.ese',NULL,6,2,49,'activo','2025-07-12','2025-07-25',1,1,1,NULL,NULL,'2025-07-10 02:37:46','2025-07-12 15:55:28',NULL),(24,'TI','Test 3','User2','Test 3 User2','test-3user2','test3@user.ex','454545',NULL,'$2y$12$yjnF5kQTDI1HYUMqcaazBO9/SsWRDHnQj3kuOz6dIi.0mh4LsjgSq',NULL,NULL,NULL,NULL,NULL,NULL,4,NULL,NULL,'test3@user.ex',2,2,52,'inactivo',NULL,NULL,0,0,0,NULL,NULL,'2025-07-12 19:50:06','2025-07-12 19:51:02',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-14 23:11:26
