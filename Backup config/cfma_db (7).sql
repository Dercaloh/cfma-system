-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2025 a las 22:45:23
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cfma_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(98, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 01:57:30', '2025-07-06 01:57:30'),
(99, 'usuarios', 'El usuario Root Administrator fue updated', 'App\\Models\\User', 'updated', 1, 'App\\Models\\User', 21, '{\"attributes\":{\"first_name\":\"Root\",\"last_name\":\"Administrator\",\"email\":\"dercaloh@gmail.com\"},\"old\":{\"first_name\":\"Root\",\"last_name\":\"Administrator\",\"email\":\"dercaloh@gmail.com\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":\"updated\"}', NULL, '2025-07-06 01:57:42', '2025-07-06 01:57:42'),
(100, 'gestión de roles y permisos', 'Actualizó roles, permisos, área y cargo del usuario.', 'App\\Models\\User', NULL, 1, 'App\\Models\\User', 21, '{\"roles\":[\"Administrador\"],\"permissions\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"department\":\"Gestion Ti\",\"position\":\"Dinamizador\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}', NULL, '2025-07-06 01:57:42', '2025-07-06 01:57:42'),
(101, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 01:57:43', '2025-07-06 01:57:43'),
(102, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 01:58:20', '2025-07-06 01:58:20'),
(103, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 02:24:13', '2025-07-06 02:24:13'),
(104, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 02:24:42', '2025-07-06 02:24:42'),
(105, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 02:27:11', '2025-07-06 02:27:11'),
(106, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 02:49:53', '2025-07-06 02:49:53'),
(107, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 02:56:19', '2025-07-06 02:56:19'),
(108, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 03:02:05', '2025-07-06 03:02:05'),
(109, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:08:26', '2025-07-06 03:08:26'),
(110, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:12:35', '2025-07-06 03:12:35'),
(111, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:14:06', '2025-07-06 03:14:06'),
(112, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:15:31', '2025-07-06 03:15:31'),
(113, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:17:03', '2025-07-06 03:17:03'),
(114, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"ip_address\":\"127.0.0.1\",\"action\":null}', NULL, '2025-07-06 03:22:59', '2025-07-06 03:22:59'),
(115, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:24:57', '2025-07-06 03:24:57'),
(116, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:25:00', '2025-07-06 03:25:00'),
(117, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:25:01', '2025-07-06 03:25:01'),
(118, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 03:33:30', '2025-07-06 03:33:30'),
(119, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 03:57:25', '2025-07-06 03:57:25'),
(120, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 03:58:01', '2025-07-06 03:58:01'),
(121, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:58:04', '2025-07-06 03:58:04'),
(122, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:58:07', '2025-07-06 03:58:07'),
(123, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 03:58:09', '2025-07-06 03:58:09'),
(124, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:01:20', '2025-07-06 04:01:20'),
(125, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:01:25', '2025-07-06 04:01:25'),
(126, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:01:28', '2025-07-06 04:01:28'),
(127, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:01:29', '2025-07-06 04:01:29'),
(128, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:05:46', '2025-07-06 04:05:46'),
(129, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:05:58', '2025-07-06 04:05:58'),
(130, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:06:01', '2025-07-06 04:06:01'),
(131, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:06:09', '2025-07-06 04:06:09'),
(132, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:06:11', '2025-07-06 04:06:11'),
(133, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:06:12', '2025-07-06 04:06:12'),
(134, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:11:28', '2025-07-06 04:11:28'),
(135, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:11:34', '2025-07-06 04:11:34'),
(136, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:11:37', '2025-07-06 04:11:37'),
(137, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:11:38', '2025-07-06 04:11:38'),
(138, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:18:17', '2025-07-06 04:18:17'),
(139, 'default', 'Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:18:22', '2025-07-06 04:18:22'),
(140, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:19:03', '2025-07-06 04:19:03'),
(141, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:19:06', '2025-07-06 04:19:06'),
(142, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:19:11', '2025-07-06 04:19:11'),
(143, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:19:12', '2025-07-06 04:19:12'),
(144, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:20:56', '2025-07-06 04:20:56'),
(145, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:21:03', '2025-07-06 04:21:03'),
(146, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:21:08', '2025-07-06 04:21:08'),
(147, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:21:11', '2025-07-06 04:21:11'),
(148, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:21:12', '2025-07-06 04:21:12'),
(149, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:22:46', '2025-07-06 04:22:46'),
(150, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:22:54', '2025-07-06 04:22:54'),
(151, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:22:55', '2025-07-06 04:22:55'),
(152, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:22:57', '2025-07-06 04:22:57'),
(153, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:30:34', '2025-07-06 04:30:34'),
(154, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:35:01', '2025-07-06 04:35:01'),
(155, 'default', 'Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:35:17', '2025-07-06 04:35:17'),
(156, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:35:29', '2025-07-06 04:35:29'),
(157, 'default', 'Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:35:35', '2025-07-06 04:35:35'),
(158, 'default', 'Exportó usuarios, tipo: all, formato: xlsx, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:35:42', '2025-07-06 04:35:42'),
(159, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:36:08', '2025-07-06 04:36:08'),
(160, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:36:12', '2025-07-06 04:36:12'),
(161, 'default', 'Exportó usuarios, tipo: current, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"current\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:36:13', '2025-07-06 04:36:13'),
(162, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:36:18', '2025-07-06 04:36:18'),
(163, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:36:20', '2025-07-06 04:36:20'),
(164, 'default', 'Exportó usuarios, tipo: all, formato: pdf, clasificación: Pública Clasificada', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"export_type\":\"all\",\"export_format\":\"pdf\",\"classification\":\"P\\u00fablica Clasificada\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.export\",\"action\":null}', NULL, '2025-07-06 04:36:21', '2025-07-06 04:36:21'),
(165, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:39:06', '2025-07-06 04:39:06'),
(166, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:48:39', '2025-07-06 04:48:39'),
(167, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:48:59', '2025-07-06 04:48:59'),
(168, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:49:08', '2025-07-06 04:49:08'),
(169, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:49:40', '2025-07-06 04:49:40'),
(170, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:49:51', '2025-07-06 04:49:51'),
(171, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 04:50:02', '2025-07-06 04:50:02'),
(172, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:00:34', '2025-07-06 05:00:34'),
(173, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:03:11', '2025-07-06 05:03:11'),
(174, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:05:39', '2025-07-06 05:05:39'),
(175, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:06:28', '2025-07-06 05:06:28'),
(176, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:06:54', '2025-07-06 05:06:54'),
(177, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:07:35', '2025-07-06 05:07:35'),
(178, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:18:47', '2025-07-06 05:18:47'),
(179, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:18:56', '2025-07-06 05:18:56'),
(180, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 05:21:29', '2025-07-06 05:21:29'),
(181, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-06 22:26:40', '2025-07-06 22:26:40'),
(182, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:10:46', '2025-07-09 02:10:46'),
(183, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:11:00', '2025-07-09 02:11:00'),
(184, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:13:22', '2025-07-09 02:13:22'),
(185, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:16:07', '2025-07-09 02:16:07'),
(186, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:16:46', '2025-07-09 02:16:46'),
(187, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:17:10', '2025-07-09 02:17:10'),
(188, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:18:25', '2025-07-09 02:18:25'),
(189, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:18:51', '2025-07-09 02:18:51'),
(190, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:18:54', '2025-07-09 02:18:54'),
(191, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:19:45', '2025-07-09 02:19:45'),
(192, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:19:45', '2025-07-09 02:19:45'),
(193, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/137.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-09 02:40:13', '2025-07-09 02:40:13'),
(194, 'usuarios', 'El usuario Test User fue created', 'App\\Models\\Users\\User', 'created', 23, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Test\",\"last_name\":\"User\",\"email\":\"test@user.com\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.store\",\"action\":\"created\"}', NULL, '2025-07-10 02:37:46', '2025-07-10 02:37:46'),
(195, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 02:38:32', '2025-07-10 02:38:32'),
(196, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.roles.index\",\"action\":null}', NULL, '2025-07-10 02:43:25', '2025-07-10 02:43:25'),
(197, 'gestión de roles y permisos', 'Visualizó listado de usuarios con sus roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 02:49:02', '2025-07-10 02:49:02'),
(198, 'gestión de roles', 'Visualizó listado de roles.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:22:17', '2025-07-10 18:22:17'),
(199, 'gestión de roles', 'Visualizó listado de roles.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:24:15', '2025-07-10 18:24:15'),
(200, 'gestión de roles', 'Visualizó listado de roles.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:26:09', '2025-07-10 18:26:09');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(201, 'gestión de roles', 'Visualizó listado de roles.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:28:27', '2025-07-10 18:28:27'),
(202, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:30:00', '2025-07-10 18:30:00'),
(203, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:47:19', '2025-07-10 18:47:19'),
(204, 'asignación de roles', 'Actualizó roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 5, 'App\\Models\\Users\\User', 21, '{\"roles\":[\"Vocero Principal\"],\"permissions\":[\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}', NULL, '2025-07-10 18:47:56', '2025-07-10 18:47:56'),
(205, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:47:56', '2025-07-10 18:47:56'),
(206, 'asignación de roles', 'Actualizó roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 5, 'App\\Models\\Users\\User', 21, '{\"roles\":[\"Vocero Principal\"],\"permissions\":[\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}', NULL, '2025-07-10 18:48:11', '2025-07-10 18:48:11'),
(207, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:48:11', '2025-07-10 18:48:11'),
(208, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 18:48:38', '2025-07-10 18:48:38'),
(209, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-10 23:52:17', '2025-07-10 23:52:17'),
(210, 'asignación de roles', 'Actualizó roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 23, 'App\\Models\\Users\\User', 21, '{\"roles\":[\"Aprendiz\"],\"permissions\":[\"gestionar activos\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}', NULL, '2025-07-11 02:25:31', '2025-07-11 02:25:31'),
(211, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-11 02:25:32', '2025-07-11 02:25:32'),
(212, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-11 02:26:23', '2025-07-11 02:26:23'),
(213, 'asignación de roles', 'Actualizó roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 23, 'App\\Models\\Users\\User', 21, '{\"roles\":[\"Aprendiz\"],\"permissions\":[\"gestionar activos\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.update\",\"action\":null}', NULL, '2025-07-11 02:26:29', '2025-07-11 02:26:29'),
(214, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.users.index\",\"action\":null}', NULL, '2025-07-11 02:26:29', '2025-07-11 02:26:29'),
(215, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 22, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-11 18:09:43', '2025-07-11 18:09:43'),
(216, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 22, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-11 18:09:48', '2025-07-11 18:09:48'),
(217, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 22, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-11 18:13:28', '2025-07-11 18:13:28'),
(218, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 22, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-11 18:14:15', '2025-07-11 18:14:15'),
(219, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 22, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-11 18:14:30', '2025-07-11 18:14:30'),
(220, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 05:07:01', '2025-07-12 05:07:01'),
(221, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 05:13:20', '2025-07-12 05:13:20'),
(222, 'usuarios', 'El usuario Test2 User2 fue updated', 'App\\Models\\Users\\User', 'updated', 23, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"suspendido\"},\"old\":{\"first_name\":\"Test\",\"last_name\":\"User\",\"email\":\"test@user.com\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}', NULL, '2025-07-12 05:16:31', '2025-07-12 05:16:31'),
(223, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 23, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"1\",\"location_id\":\"40\",\"department_id\":\"10\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"suspendido\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"autorizar salidas de activos\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 05:16:31', '2025-07-12 05:16:31'),
(224, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 05:16:31', '2025-07-12 05:16:31'),
(225, 'usuarios', 'El usuario Test2 User2 fue updated', 'App\\Models\\Users\\User', 'updated', 23, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"suspendido\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}', NULL, '2025-07-12 05:18:01', '2025-07-12 05:18:01'),
(226, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 23, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"2\",\"location_id\":\"49\",\"department_id\":\"6\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"activo\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 05:18:01', '2025-07-12 05:18:01'),
(227, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 05:18:02', '2025-07-12 05:18:02'),
(228, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 15:37:01', '2025-07-12 15:37:01'),
(229, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 15:41:53', '2025-07-12 15:41:53'),
(230, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 23, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"2\",\"location_id\":\"49\",\"department_id\":\"6\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"activo\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 15:49:23', '2025-07-12 15:49:23'),
(231, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 15:49:23', '2025-07-12 15:49:23'),
(232, 'usuarios', 'El usuario Test2 User2 fue updated', 'App\\Models\\Users\\User', 'updated', 23, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}', NULL, '2025-07-12 15:55:28', '2025-07-12 15:55:28'),
(233, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 23, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Test2\",\"last_name\":\"User2\",\"email\":\"test@user.es\",\"username\":\"tuser\",\"document_type\":\"TI\",\"identification_number\":\"123456789\",\"branch_id\":\"2\",\"location_id\":\"49\",\"department_id\":\"6\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"test@user.ese\",\"status\":\"activo\",\"account_valid_from\":\"2025-07-12\",\"account_valid_until\":\"2025-07-25\",\"consent_data_processing\":\"1\",\"consent_data_sharing\":true,\"consent_marketing\":true,\"role\":\"Instructor\"},\"roles\":[\"Instructor\"],\"permisos\":[\"gestionar activos\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 15:55:28', '2025-07-12 15:55:28'),
(234, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 15:55:29', '2025-07-12 15:55:29'),
(235, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 15:58:39', '2025-07-12 15:58:39'),
(236, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 16:03:16', '2025-07-12 16:03:16'),
(237, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 16:03:47', '2025-07-12 16:03:47'),
(238, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 16:03:52', '2025-07-12 16:03:52'),
(239, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 16:05:10', '2025-07-12 16:05:10'),
(240, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 16:56:44', '2025-07-12 16:56:44'),
(241, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:01:46', '2025-07-12 17:01:46'),
(242, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:03:22', '2025-07-12 17:03:22'),
(243, 'usuarios', 'El usuario Administrador Cfma fue updated', 'App\\Models\\Users\\User', 'updated', 22, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Administrador\",\"last_name\":\"Cfma\",\"email\":\"admin@cfma.sena.edu.co\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Administrador\",\"last_name\":\"Cfma\",\"email\":\"admin@cfma.sena.edu.co\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}', NULL, '2025-07-12 17:05:21', '2025-07-12 17:05:21'),
(244, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 22, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Administrador\",\"last_name\":\"Cfma\",\"email\":\"admin@cfma.sena.edu.co\",\"username\":\"admin.cfma\",\"document_type\":\"CC\",\"identification_number\":\"12345874\",\"branch_id\":\"1\",\"location_id\":\"22\",\"department_id\":\"20\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":null,\"personal_email\":null,\"status\":\"activo\",\"account_valid_from\":\"2025-07-05\",\"account_valid_until\":null,\"consent_data_processing\":\"1\",\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 17:05:21', '2025-07-12 17:05:21'),
(245, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:05:22', '2025-07-12 17:05:22'),
(246, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:08:23', '2025-07-12 17:08:23'),
(247, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:08:39', '2025-07-12 17:08:39'),
(248, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:12:00', '2025-07-12 17:12:00'),
(249, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:12:23', '2025-07-12 17:12:23'),
(250, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:15:20', '2025-07-12 17:15:20'),
(251, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:16:01', '2025-07-12 17:16:01'),
(252, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:16:18', '2025-07-12 17:16:18'),
(253, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 17:19:42', '2025-07-12 17:19:42'),
(254, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:43:49', '2025-07-12 19:43:49'),
(255, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:48:04', '2025-07-12 19:48:04'),
(256, 'usuarios', 'El usuario Harold Antonio Cordero Solera fue updated', 'App\\Models\\Users\\User', 'updated', 21, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"status\":\"activo\"},\"old\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}', NULL, '2025-07-12 19:49:05', '2025-07-12 19:49:05'),
(257, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 21, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 19:49:05', '2025-07-12 19:49:05'),
(258, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:49:05', '2025-07-12 19:49:05'),
(259, 'usuarios', 'El usuario Test 3 User2 fue created', 'App\\Models\\Users\\User', 'created', 24, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.store\",\"action\":\"created\"}', NULL, '2025-07-12 19:50:06', '2025-07-12 19:50:06'),
(260, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:50:07', '2025-07-12 19:50:07'),
(261, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:50:52', '2025-07-12 19:50:52'),
(262, 'usuarios', 'El usuario Test 3 User2 fue updated', 'App\\Models\\Users\\User', 'updated', 24, 'App\\Models\\Users\\User', 21, '{\"attributes\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"status\":\"inactivo\"},\"old\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"status\":\"activo\"},\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":\"updated\"}', NULL, '2025-07-12 19:51:02', '2025-07-12 19:51:02'),
(263, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 24, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Test 3\",\"last_name\":\"User2\",\"email\":\"test3@user.ex\",\"username\":\"test-3user2\",\"document_type\":\"TI\",\"identification_number\":\"454545\",\"branch_id\":\"2\",\"location_id\":\"52\",\"department_id\":\"2\",\"position_id\":\"4\",\"employee_id\":null,\"phone_number\":null,\"personal_email\":null,\"status\":\"inactivo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Aprendiz\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Aprendiz\"],\"permisos\":[\"modificar perfil\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 19:51:02', '2025-07-12 19:51:02'),
(264, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:51:03', '2025-07-12 19:51:03'),
(265, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:52:52', '2025-07-12 19:52:52'),
(266, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:53:03', '2025-07-12 19:53:03'),
(267, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:53:30', '2025-07-12 19:53:30'),
(268, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:53:34', '2025-07-12 19:53:34'),
(269, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:54:01', '2025-07-12 19:54:01'),
(270, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:54:06', '2025-07-12 19:54:06'),
(271, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:54:15', '2025-07-12 19:54:15'),
(272, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:55:23', '2025-07-12 19:55:23'),
(273, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 19:56:08', '2025-07-12 19:56:08'),
(274, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 20:02:11', '2025-07-12 20:02:11'),
(275, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 20:34:39', '2025-07-12 20:34:39'),
(276, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 20:37:58', '2025-07-12 20:37:58'),
(277, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 20:39:01', '2025-07-12 20:39:01'),
(278, 'actualización de usuario', 'Modificó la información general, roles y permisos del usuario.', 'App\\Models\\Users\\User', NULL, 21, 'App\\Models\\Users\\User', 21, '{\"usuario_actualizado\":{\"first_name\":\"Harold Antonio\",\"last_name\":\"Cordero Solera\",\"email\":\"dercaloh@hotmail.com\",\"username\":\"hacordero\",\"document_type\":\"CC\",\"identification_number\":\"1040498580\",\"branch_id\":\"2\",\"location_id\":\"48\",\"department_id\":\"20\",\"position_id\":\"19\",\"employee_id\":null,\"phone_number\":\"3218724618\",\"personal_email\":\"dercaloh@hotmail.com\",\"status\":\"activo\",\"account_valid_from\":null,\"account_valid_until\":null,\"role\":\"Administrador\",\"consent_data_sharing\":false,\"consent_marketing\":false},\"roles\":[\"Administrador\"],\"permisos\":[\"gestionar usuarios\",\"gestionar activos\",\"gestionar pr\\u00e9stamos\",\"ver reportes\",\"solicitar pr\\u00e9stamos\",\"autorizar salidas de activos\",\"reclamar pr\\u00e9stamos como apoderado\",\"modificar perfil\",\"crear usuarios\",\"exportar usuarios\"],\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.update\",\"action\":null}', NULL, '2025-07-12 20:41:21', '2025-07-12 20:41:21'),
(279, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 20:41:22', '2025-07-12 20:41:22'),
(280, 'gestión de usuarios y roles', 'Visualizó listado de usuarios con roles y permisos.', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"ip\":\"127.0.0.1\",\"ip_address\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.index\",\"action\":null}', NULL, '2025-07-12 20:41:31', '2025-07-12 20:41:31'),
(281, 'default', 'Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}', NULL, '2025-07-12 20:41:34', '2025-07-12 20:41:34'),
(282, 'default', 'Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}', NULL, '2025-07-12 20:43:11', '2025-07-12 20:43:11'),
(283, 'default', 'Exportó usuarios para backup (formato: xlsx, clasificación: Pública Clasificada)', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"export_format\":\"xlsx\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}', NULL, '2025-07-12 20:43:53', '2025-07-12 20:43:53'),
(284, 'default', 'Exportó usuarios para backup (formato: csv, clasificación: Pública Clasificada)', NULL, NULL, NULL, 'App\\Models\\Users\\User', 21, '{\"export_format\":\"csv\",\"classification\":\"P\\u00fablica Clasificada\",\"user_count\":\"Todos\",\"ip_address\":\"127.0.0.1\",\"ip\":\"127.0.0.1\",\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/138.0.0.0 Safari\\/537.36\",\"module\":\"admin.usuarios.export\",\"action\":null}', NULL, '2025-07-12 20:44:56', '2025-07-12 20:44:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assets`
--

CREATE TABLE `assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nombre del activo',
  `serial_number` varchar(100) NOT NULL COMMENT 'Número de serie',
  `placa` varchar(50) DEFAULT NULL COMMENT 'Número inventario institucional',
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `ownership` enum('Centro','Personal') NOT NULL DEFAULT 'Centro' COMMENT 'Propiedad',
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year_purchased` year(4) DEFAULT NULL COMMENT 'Año adquisición',
  `status` enum('Disponible','Prestado','En mantenimiento','Para baja','Retirado') NOT NULL DEFAULT 'Disponible',
  `condition` enum('Bueno','Regular','Dañado','En diagnóstico') NOT NULL DEFAULT 'Bueno',
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `loanable` tinyint(1) NOT NULL DEFAULT 1 COMMENT '¿Puede prestarse?',
  `movable` tinyint(1) NOT NULL DEFAULT 0 COMMENT '¿Puede salir del recinto?',
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asset_disposals`
--

CREATE TABLE `asset_disposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `disposal_date` date NOT NULL,
  `reason` enum('Obsolescencia','Daño','Pérdida','Donación','Otro') NOT NULL,
  `support_document` varchar(255) DEFAULT NULL,
  `observations` text DEFAULT NULL,
  `processed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asset_hardware_details`
--

CREATE TABLE `asset_hardware_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `mac_address` varchar(17) DEFAULT NULL COMMENT 'MAC física, formato XX:XX:XX:XX:XX:XX',
  `os` varchar(50) DEFAULT NULL COMMENT 'Sistema operativo',
  `bios_version` varchar(50) DEFAULT NULL COMMENT 'Versión BIOS/UEFI',
  `cpu` varchar(100) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `storage` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asset_software_details`
--

CREATE TABLE `asset_software_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `license_status` enum('autorizado','no_autorizado','desactualizado') NOT NULL DEFAULT 'autorizado',
  `install_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asset_types`
--

CREATE TABLE `asset_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Nombre único del tipo de activo (ej. Portátil, Impresora)',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción adicional del tipo',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico del tipo de activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `asset_types`
--

INSERT INTO `asset_types` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Computador de Escritorio', 'Tipo de activo: Computador de Escritorio', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(2, 'Portátil', 'Tipo de activo: Portátil', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(3, 'Tablet', 'Tipo de activo: Tablet', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(4, 'Monitor', 'Tipo de activo: Monitor', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(5, 'Proyector', 'Tipo de activo: Proyector', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(6, 'Impresora', 'Tipo de activo: Impresora', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(7, 'Switch', 'Tipo de activo: Switch', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(8, 'Router', 'Tipo de activo: Router', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(9, 'Servidor', 'Tipo de activo: Servidor', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(10, 'Cámara Web', 'Tipo de activo: Cámara Web', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(11, 'Mouse', 'Tipo de activo: Mouse', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(12, 'Teclado', 'Tipo de activo: Teclado', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(13, 'Software de Oficina', 'Tipo de activo: Software de Oficina', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(14, 'Sistema Operativo', 'Tipo de activo: Sistema Operativo', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(15, 'Antivirus', 'Tipo de activo: Antivirus', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL),
(16, 'Otro', 'Tipo de activo: Otro', 1, '2025-07-02 22:54:52', '2025-07-02 22:54:52', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nombre de la sede (ej: El Bagre, Caucasia)',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Indicador de estado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `branches`
--

INSERT INTO `branches` (`id`, `name`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sede Principal El Bagre', 1, NULL, NULL, NULL),
(2, 'Sede Alterna El Bagre', 1, NULL, NULL, NULL),
(3, 'Sede Virtual', 1, NULL, NULL, NULL),
(4, 'Formación Extramural – Barrios El Bagre', 1, NULL, NULL, NULL),
(5, 'Formación Extramural – Zonas Rurales El Bagre', 1, NULL, NULL, NULL),
(6, 'Punto De Formación – Caucasia', 1, NULL, NULL, NULL),
(7, 'Punto De Formación – Zaragoza', 1, NULL, NULL, NULL),
(8, 'Punto De Formación – Nechí', 1, NULL, NULL, NULL),
(9, 'Punto De Formación – Segovia', 1, NULL, NULL, NULL),
(10, 'Punto De Formación – Tarazá', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('cfma_system_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:6:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";s:1:\"j\";s:11:\"description\";s:1:\"k\";s:5:\"level\";}s:11:\"permissions\";a:10:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:18:\"gestionar usuarios\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:17:\"gestionar activos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:20:\"gestionar préstamos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"ver reportes\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:20:\"solicitar préstamos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:5;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:28:\"autorizar salidas de activos\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:5;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:34:\"reclamar préstamos como apoderado\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:4;i:2;i:5;i:3;i:7;i:4;i:8;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:16:\"modificar perfil\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:9;}}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"crear usuarios\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"exportar usuarios\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:8:{i:0;a:5:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrador\";s:1:\"j\";s:46:\"Acceso total al sistema (nivel técnico TI)...\";s:1:\"k\";i:0;s:1:\"c\";s:3:\"web\";}i:1;a:5:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"Subdirector\";s:1:\"j\";s:79:\"Apoyo en dirección operativa. Supervisa coordinaciones y proyectos especiales.\";s:1:\"k\";i:1;s:1:\"c\";s:3:\"web\";}i:2;a:5:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"Coordinador\";s:1:\"j\";s:86:\"Líder de área formativa: diseño curricular, instructores y seguimiento a programas.\";s:1:\"k\";i:2;s:1:\"c\";s:3:\"web\";}i:3;a:5:{s:1:\"a\";i:4;s:1:\"b\";s:10:\"Instructor\";s:1:\"j\";s:93:\"Facilitador técnico-pedagógico. Ejecuta formación, evalúa competencias y guía proyectos.\";s:1:\"k\";i:3;s:1:\"c\";s:3:\"web\";}i:4;a:5:{s:1:\"a\";i:5;s:1:\"b\";s:21:\"Gestor Administrativo\";s:1:\"j\";s:74:\"Apoyo logístico: matrículas, bienestar, recursos físicos y proveedores.\";s:1:\"k\";i:4;s:1:\"c\";s:3:\"web\";}i:5;a:5:{s:1:\"a\";i:7;s:1:\"b\";s:16:\"Vocero Principal\";s:1:\"j\";s:87:\"Representante estudiantil ante consejos directivos. Canaliza iniciativas de aprendices.\";s:1:\"k\";i:6;s:1:\"c\";s:3:\"web\";}i:6;a:5:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"Vocero Suplente\";s:1:\"j\";s:51:\"Apoyo al vocero principal y suplencia en ausencias.\";s:1:\"k\";i:7;s:1:\"c\";s:3:\"web\";}i:7;a:5:{s:1:\"a\";i:9;s:1:\"b\";s:8:\"Aprendiz\";s:1:\"j\";s:84:\"Beneficiario de formación. Acceso limitado a plataformas educativas y autogestión.\";s:1:\"k\";i:8;s:1:\"c\";s:3:\"web\";}}}', 1752439245);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nombre del departamento administrativo',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Visible en formularios',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'COORDINACIÓN ACADÉMICA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(2, 'COORDINACIÓN ADMINISTRATIVA Y FINANCIERA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(3, 'COORDINACIÓN DE PROGRAMAS ESPECIALES', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(4, 'SUBDIRECCIÓN DE CENTRO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(5, 'BIBLIOTECA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(6, 'ALMACÉN', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(7, 'SERVICIOS GENERALES', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(8, 'GESTIÓN DOCUMENTAL (ARCHIVO)', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(9, 'SISTEMAS (TIC)', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(10, 'BIENESTAR AL APRENDIZ', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(11, 'CONTRATACIÓN', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(12, 'INVENTARIO Y CONTABILIDAD', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(13, 'TESORERÍA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(14, 'PRESUPUESTO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(15, 'PLANEACIÓN', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(16, 'SENNOVA (INNOVACIÓN Y TECNOLOGÍA)', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(17, 'EVALUACIÓN Y CERTIFICACIÓN', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(18, 'EMPLEO Y EMPRENDIMIENTO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(19, 'SISTEMA DE GESTIÓN (SIGA / SOFIA PLUS)', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(20, 'Gestion TI', 1, '2025-07-06 00:27:31', '2025-07-06 00:27:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL COMMENT 'Nombre original del documento',
  `mime_type` varchar(100) NOT NULL COMMENT 'Tipo MIME del archivo',
  `size` bigint(20) UNSIGNED NOT NULL COMMENT 'Tamaño del archivo en bytes',
  `hash_sha256` varchar(64) DEFAULT NULL COMMENT 'Hash SHA-256 para verificar integridad',
  `storage_path` varchar(191) DEFAULT NULL COMMENT 'Ruta del archivo cifrado en Laravel Storage',
  `documentable_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID del modelo asociado',
  `documentable_type` varchar(191) NOT NULL COMMENT 'Clase del modelo asociado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entry_exit_logs`
--

CREATE TABLE `entry_exit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `entry_time` timestamp NULL DEFAULT NULL,
  `exit_time` timestamp NULL DEFAULT NULL,
  `access_point` varchar(255) DEFAULT NULL,
  `observations` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_passes`
--

CREATE TABLE `exit_passes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gate_log_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Registro de entrada/salida relacionado',
  `cuentadante` varchar(100) NOT NULL COMMENT 'Responsable de salida',
  `cedula` varchar(20) NOT NULL COMMENT 'Documento del cuentadante',
  `dependencia` varchar(100) NOT NULL COMMENT 'Área solicitante',
  `permiso` enum('temporal','permanente','definitivo') NOT NULL COMMENT 'Tipo de salida autorizada',
  `autorizado_salida` timestamp NULL DEFAULT NULL COMMENT 'Autorización de salida',
  `autorizado_regreso` timestamp NULL DEFAULT NULL COMMENT 'Autorización de reingreso',
  `signed_by` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Usuario que firmó la salida',
  `archivo_pdf` varchar(191) DEFAULT NULL COMMENT 'Ruta del archivo PDF firmado',
  `estado` enum('pendiente','autorizado','rechazado','vencido') NOT NULL DEFAULT 'pendiente' COMMENT 'Estado actual del pase',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gate_logs`
--

CREATE TABLE `gate_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Activo asociado al movimiento',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Usuario que hizo el movimiento',
  `action` enum('salida','entrada') NOT NULL COMMENT 'Tipo de movimiento',
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora del registro',
  `notes` text DEFAULT NULL COMMENT 'Observaciones del movimiento',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor_program`
--

CREATE TABLE `instructor_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rol` enum('técnico','promotor') NOT NULL DEFAULT 'promotor' COMMENT 'Tipo de rol del instructor en el programa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intangible_assets`
--

CREATE TABLE `intangible_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `asset_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `delivered_by` bigint(20) UNSIGNED DEFAULT NULL,
  `received_by` bigint(20) UNSIGNED DEFAULT NULL,
  `requested_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de solicitud',
  `approved_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de aprobación',
  `delivered_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de entrega',
  `returned_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de devolución',
  `notes` text DEFAULT NULL COMMENT 'Observaciones generales',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_approvals`
--

CREATE TABLE `loan_approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `decided_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `justification` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_details`
--

CREATE TABLE `loan_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Cantidad de activos prestados',
  `dias_solicitados` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Días solicitados para el préstamo',
  `modalidad_entrega` enum('presencial','delegado') NOT NULL DEFAULT 'presencial',
  `hora_entrega` time NOT NULL COMMENT 'Hora pactada de entrega',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_request_data`
--

CREATE TABLE `loan_request_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_de_uso` enum('formativo','administrativo') NOT NULL,
  `program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proposito` varchar(255) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_entrega_deseada` date DEFAULT NULL,
  `reclamado_por_apoderado` tinyint(1) NOT NULL DEFAULT 0,
  `nombre_apoderado` varchar(100) DEFAULT NULL,
  `documento_apoderado` varchar(20) DEFAULT NULL,
  `proxy_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan_statuses`
--

CREATE TABLE `loan_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Estado único del préstamo',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción del estado',
  `order_index` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Posición en listados',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nombre ubicación',
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `branch_id`, `name`, `description`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 3, 'Ubicación del usuario', 'Sede Virtual', 1, '2025-07-07 00:42:06', NULL, NULL),
(12, 4, 'I.E. 20 de Julio', 'Extramural Barrios El Bagre', 1, '2025-07-07 00:42:06', NULL, NULL),
(13, 4, 'I.E. Bijao', 'Extramural Barrios El Bagre', 1, '2025-07-07 00:42:06', NULL, NULL),
(14, 4, 'I.E. El Bagre', 'Extramural Barrios El Bagre', 1, '2025-07-07 00:42:06', NULL, NULL),
(15, 4, 'I.E. La Esmeralda', 'Extramural Barrios El Bagre', 1, '2025-07-07 00:42:06', NULL, NULL),
(16, 4, 'I.E. Las Delicias', 'Extramural Barrios El Bagre', 1, '2025-07-07 00:42:06', NULL, NULL),
(17, 7, 'Zaragoza', 'Punto de Formación Zaragoza', 1, '2025-07-07 00:42:06', NULL, NULL),
(18, 8, 'Nechí', 'Punto de Formación Nechí', 1, '2025-07-07 00:42:06', NULL, NULL),
(19, 9, 'Segovia', 'Punto de Formación Segovia', 1, '2025-07-07 00:42:06', NULL, NULL),
(20, 1, 'B3 P1 - Biblioteca', 'Apoyo a la Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(21, 1, 'B3 P1 - Lúdica- Gimnasio', 'Apoyo a la Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(22, 1, 'B1 P1 - Auditorio', 'Apoyo a la Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(23, 1, 'B2 P1 - Simuladores', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(24, 1, 'B2 P1 - Taller Metalmecánica', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(25, 1, 'B2 P2 - Salvamento', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(26, 1, 'B2 P2 - Bilingüismo', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(27, 1, 'B2 P2 - Planometría', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(28, 1, 'B2 P2 - Neumática', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(29, 1, 'B3 P2 - Polivalente 2 - STEM', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(30, 1, 'B3 P2 - Polivalente 3 - Desarrollo empresarial', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(31, 1, 'B3 P2 - Polivalente 4 - Competencias blandas', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(32, 1, 'B3 P3 - Polivalente 5 - Joyería', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(33, 1, 'B3 P3 - Polivalente 6 - Ecominería', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(34, 1, 'B3 P3 - Polivalente 7 - Energías alternativas', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(35, 1, 'B1 P1 - Área Administrativa 1', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(36, 1, 'B2 P1 - Herramentario', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(37, 1, 'B3 P1 - Polivalente 1 - Instructores', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(38, 1, 'B3 P2 - Área Administrativa 2', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(39, 1, 'B3 P3 - Bienestar', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(40, 1, 'B2 P1 - Bodega', 'Almacén', 1, '2025-07-07 00:42:06', NULL, NULL),
(41, 1, 'B1 P1 - Bodega TIC', 'Almacén', 1, '2025-07-07 00:42:06', NULL, NULL),
(42, 1, 'B2 P2 - Bodega', 'Almacén', 1, '2025-07-07 00:42:06', NULL, NULL),
(43, 1, 'B2 P1 - Laboratorio', 'Innovación', 1, '2025-07-07 00:42:06', NULL, NULL),
(44, 2, 'B2 - Polivalente 1', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(45, 2, 'B2 - Polivalente 2', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(46, 2, 'B3 - Polivalente 3', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(47, 2, 'B3 - Polivalente 4', 'Formación', 1, '2025-07-07 00:42:06', NULL, NULL),
(48, 2, 'B1 - Área administrativa', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(49, 2, 'B2 - Archivo', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(50, 2, 'B2 - Almacén', 'Administrativo', 1, '2025-07-07 00:42:06', NULL, NULL),
(51, 2, 'B4 - Bodega 1', 'Almacén', 1, '2025-07-07 00:42:06', NULL, NULL),
(52, 2, 'B5 - Bodega 2', 'Almacén', 1, '2025-07-07 00:42:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_06_01_000029_create_cache_table', 1),
(2, '2025_06_01_000030_create_jobs_table', 1),
(3, '2025_07_01_000000_create_roles_table', 1),
(4, '2025_07_01_000001_create_users_table', 1),
(5, '2025_07_01_000002_create_permissions_table', 1),
(6, '2025_07_01_000003_add_user_fks_to_roles_table', 1),
(7, '2025_07_01_000003_create_notifications_table', 1),
(8, '2025_07_01_000003_create_user_security_table', 1),
(9, '2025_07_01_000004_create_sessions_table', 1),
(10, '2025_07_01_000005_create_role_permission_table', 1),
(11, '2025_07_01_000006_create_locations_table', 1),
(12, '2025_07_01_000007_create_branches_table', 1),
(13, '2025_07_01_000008_create_assets_types_table', 1),
(14, '2025_07_01_000009_create_assets_table', 1),
(15, '2025_07_01_000010_create_asset_hardware_details_table', 1),
(16, '2025_07_01_000011_create_asset_software_details_table', 1),
(17, '2025_07_01_000012_create_loan_statuses_table', 1),
(18, '2025_07_01_000013_create_loans_table', 1),
(19, '2025_07_01_000014_create_loan_details_table', 1),
(20, '2025_07_01_000015_create_loan_approvals_table', 1),
(21, '2025_07_01_000015_create_positions_table', 1),
(22, '2025_07_01_000015_create_programs_table', 1),
(23, '2025_07_01_000015_create_proxy_types_table', 1),
(24, '2025_07_01_000016_create_departments_table', 1),
(25, '2025_07_01_000016_create_loan_request_data_table', 1),
(26, '2025_07_01_000017_create_signatures_table', 1),
(27, '2025_07_01_000018_create_documents_table', 1),
(28, '2025_07_01_000019_create_gate_logs_table', 1),
(29, '2025_07_01_000020_create_exit_passes_table', 1),
(30, '2025_07_01_000021_create_audit_logs_table', 1),
(31, '2025_07_01_000026_create_instructor_program_table', 1),
(32, '2025_07_01_000028_add_fks_to_users_table', 1),
(33, '2025_07_01_000028_create_personal_access_tokens_table', 1),
(34, '2025_07_03_233643_add_is_system_event_to_audit_logs_table', 2),
(35, '2025_07_03_235056_create_user_policies_table', 3),
(36, '2025_07_03_235409_add_user_id_to_user_policies_table', 4),
(37, '2025_07_03_235611_add_user_id_to_user_policies_table', 5),
(38, '2025_07_03_235407_add_user_id_to_user_policies_table', 6),
(39, '2025_07_04_000343_fix_user_policies_structure', 7),
(40, '2025_07_04_000343_fix_user_policies_structures', 8),
(41, '2025_07_04_231318_create_activity_log_table', 9),
(42, '2025_07_04_231319_add_event_column_to_activity_log_table', 9),
(43, '2025_07_04_231320_add_batch_uuid_column_to_activity_log_table', 9),
(44, '2025_07_04_231415_create_permission_tables', 10),
(45, '2025_07_05_011051_add_description_and_level_to_roles_table', 11),
(46, '2025_07_05_023521_create_policy_views_table', 12),
(47, '2025_07_06_165502_add_soft_deletes_to_roles_table', 13),
(48, '2025_07_07_205922_create_additional_asset_tables', 14),
(49, '2025_07_09_130837_add_document_type_to_users_table', 15),
(50, '2025_07_10_133419_add_deleted_at_to_permissions_table', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\Users\\User', 21),
(1, 'App\\Models\\User', 22),
(1, 'App\\Models\\Users\\User', 22),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\Users\\User', 21),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\Users\\User', 22),
(2, 'App\\Models\\Users\\User', 23),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\Users\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\Users\\User', 22),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\Users\\User', 21),
(4, 'App\\Models\\User', 22),
(4, 'App\\Models\\Users\\User', 22),
(5, 'App\\Models\\User', 1),
(5, 'App\\Models\\Users\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\Users\\User', 22),
(5, 'App\\Models\\Users\\User', 23),
(6, 'App\\Models\\User', 1),
(6, 'App\\Models\\Users\\User', 21),
(6, 'App\\Models\\User', 22),
(6, 'App\\Models\\Users\\User', 22),
(6, 'App\\Models\\Users\\User', 23),
(7, 'App\\Models\\User', 1),
(7, 'App\\Models\\Users\\User', 5),
(7, 'App\\Models\\Users\\User', 21),
(7, 'App\\Models\\User', 22),
(7, 'App\\Models\\Users\\User', 22),
(7, 'App\\Models\\Users\\User', 23),
(8, 'App\\Models\\User', 1),
(8, 'App\\Models\\Users\\User', 5),
(8, 'App\\Models\\Users\\User', 21),
(8, 'App\\Models\\User', 22),
(8, 'App\\Models\\Users\\User', 22),
(8, 'App\\Models\\Users\\User', 23),
(8, 'App\\Models\\Users\\User', 24),
(9, 'App\\Models\\Users\\User', 21),
(10, 'App\\Models\\Users\\User', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 21),
(1, 'App\\Models\\Users\\User', 21),
(1, 'App\\Models\\User', 22),
(1, 'App\\Models\\Users\\User', 22),
(4, 'App\\Models\\Users\\User', 23),
(7, 'App\\Models\\Users\\User', 5),
(9, 'App\\Models\\Users\\User', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'Tipo de evento notificado: préstamo, alerta, sistema, etc.',
  `title` varchar(100) NOT NULL COMMENT 'Título breve o resumen visible de la notificación',
  `message` text NOT NULL COMMENT 'Contenido completo de la notificación',
  `is_read` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Marca si el usuario ya la leyó',
  `read_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha y hora exacta en la que fue leída',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'gestionar usuarios', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(2, 'gestionar activos', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(3, 'gestionar préstamos', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(4, 'ver reportes', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(5, 'solicitar préstamos', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(6, 'autorizar salidas de activos', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(7, 'reclamar préstamos como apoderado', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(8, 'modificar perfil', 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(9, 'crear usuarios', 'web', '2025-07-12 19:47:45', '2025-07-12 19:47:45', NULL),
(10, 'exportar usuarios', 'web', '2025-07-12 20:40:13', '2025-07-12 20:40:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `policy_views`
--

CREATE TABLE `policy_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `policy_version` varchar(10) NOT NULL DEFAULT '1.0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `policy_views`
--

INSERT INTO `policy_views` (`id`, `ip_address`, `user_agent`, `viewed_at`, `user_id`, `policy_version`) VALUES
(126, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 02:29:05', NULL, '1.0'),
(127, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 02:49:53', NULL, '1.0'),
(128, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 02:56:18', NULL, '1.0'),
(129, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 03:02:05', NULL, '1.0'),
(130, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 03:12:34', NULL, '1.0'),
(131, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 03:17:02', NULL, '1.0'),
(132, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 03:33:29', NULL, '1.0'),
(133, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 03:57:24', NULL, '1.0'),
(134, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 03:58:01', NULL, '1.0.0'),
(135, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:01:20', NULL, '1.0.0'),
(136, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:05:46', NULL, '1.0'),
(137, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:05:58', NULL, '1.0'),
(138, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:11:28', NULL, '1.0'),
(139, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:18:16', NULL, '1.0'),
(140, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:20:56', NULL, '1.0'),
(141, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:22:46', NULL, '1.0'),
(142, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:30:34', NULL, '1.0'),
(143, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:35:01', NULL, '1.0'),
(144, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:48:39', NULL, '1.0'),
(145, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:48:58', NULL, '1.0'),
(146, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:49:08', NULL, '1.0'),
(147, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:49:40', NULL, '1.0'),
(148, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:49:51', NULL, '1.0.0'),
(149, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 04:50:02', NULL, '1.0.0'),
(150, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:00:34', NULL, '1.0'),
(151, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:03:10', NULL, '1.0'),
(152, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:05:38', NULL, '1.0'),
(153, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:06:28', NULL, '1.0.0'),
(154, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:06:54', NULL, '1.0.0'),
(155, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:07:34', NULL, '1.0'),
(156, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:18:46', NULL, '1.0'),
(157, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:18:56', NULL, '1.0.0'),
(158, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:19:45', NULL, '1.0'),
(159, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:21:29', NULL, '1.0'),
(160, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:23:24', NULL, '1.0'),
(161, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:23:44', NULL, '1.0'),
(162, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:25:51', NULL, '1.0.0'),
(163, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:29:16', NULL, '1.0'),
(164, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:32:09', NULL, '1.0'),
(165, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:33:16', NULL, '1.0'),
(166, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:38:46', NULL, '1.0.0'),
(167, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:39:07', NULL, '1.0.0'),
(168, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:39:29', NULL, '1.0.0'),
(169, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:40:21', NULL, '1.0'),
(170, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:42:23', NULL, '1.0'),
(171, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:42:59', NULL, '1.0'),
(172, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:140.0) Gecko/20100101 Firefox/140.0', '2025-07-06 05:44:04', NULL, '1.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL COMMENT 'Nombre del cargo o función',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Estado de uso',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`id`, `title`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Apoyo De Almacén', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:21', NULL),
(2, 'APOYO DE BIBLIOTECA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(3, 'Técnico En Gestión Documental', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:21', NULL),
(4, 'ANALISTA DE SOPORTE TIC', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(5, 'APOYO CONTABLE', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(6, 'PROFESIONAL DE RRHH', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(7, 'INSTRUCTOR TITULADA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(8, 'Instructor Media Técnica', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:21', NULL),
(9, 'INSTRUCTOR VIRTUAL', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(10, 'INSTRUCTOR CAMPESENA', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(11, 'INSTRUCTOR COMPLEMENTARIO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(12, 'EVALUADOR DE COMPETENCIAS LABORALES', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(13, 'Coordinador Académico', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:21', NULL),
(14, 'Líder De Bienestar Al Aprendiz', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:21', NULL),
(15, 'SUBDIRECTOR DE CENTRO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(16, 'COORDINADOR ADMINISTRATIVO Y FINANCIERO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(17, 'COORDINADOR DE FORMACION', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(18, 'Psicólogo(A)', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:22', NULL),
(19, 'DINAMIZADOR', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(20, 'INGENIERO CIVIL', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(21, 'PROFESIONAL', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(22, 'Apoyo De Atención Al Ciudadano', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:22', NULL),
(23, 'APRENDIZ TITULADO', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(24, 'Aprendiz De Media Técnica', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:22', NULL),
(25, 'APRENDIZ PRACTICANTE', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(26, 'Monitor Académico', 1, '2025-07-02 22:54:51', '2025-07-05 23:35:22', NULL),
(27, 'VOCERO DE APRENDICES', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(28, 'Soporte en sitio', 1, '2025-07-06 00:27:31', '2025-07-06 00:27:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Nombre del programa de formación',
  `code` varchar(20) DEFAULT NULL COMMENT 'Código interno del programa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proxy_types`
--

CREATE TABLE `proxy_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Tipo de apoderado: Vocero, Subvocero, Monitor, etc.',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Habilitado para selección',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proxy_types`
--

INSERT INTO `proxy_types` (`id`, `name`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vocero', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(2, 'Vocero Suplente', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(3, 'Monitor Académico', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(4, 'Aprendiz Practicante', 1, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(5, 'Apoderado Legal', 0, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `real_estate_assets`
--

CREATE TABLE `real_estate_assets` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `level` tinyint(3) UNSIGNED NOT NULL DEFAULT 9,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `level`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrador', 'Acceso total al sistema (nivel técnico TI)...', 0, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(2, 'Subdirector', 'Apoyo en dirección operativa. Supervisa coordinaciones y proyectos especiales.', 1, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(3, 'Coordinador', 'Líder de área formativa: diseño curricular, instructores y seguimiento a programas.', 2, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(4, 'Instructor', 'Facilitador técnico-pedagógico. Ejecuta formación, evalúa competencias y guía proyectos.', 3, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(5, 'Gestor Administrativo', 'Apoyo logístico: matrículas, bienestar, recursos físicos y proveedores.', 4, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(6, 'Portería/Vigilancia', 'Control de accesos, seguridad perimetral y registro de visitas.', 5, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(7, 'Vocero Principal', 'Representante estudiantil ante consejos directivos. Canaliza iniciativas de aprendices.', 6, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(8, 'Vocero Suplente', 'Apoyo al vocero principal y suplencia en ausencias.', 7, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL),
(9, 'Aprendiz', 'Beneficiario de formación. Acceso limitado a plataformas educativas y autogestión.', 8, 'web', '2025-07-05 06:20:17', '2025-07-05 06:20:17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 4),
(5, 5),
(6, 1),
(6, 4),
(6, 5),
(7, 1),
(7, 4),
(7, 5),
(7, 7),
(7, 8),
(8, 1),
(8, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL COMMENT 'IP de origen de la sesión',
  `user_agent` varchar(255) DEFAULT NULL COMMENT 'Agente de navegador o dispositivo',
  `payload` text NOT NULL COMMENT 'Datos serializados y cifrados de la sesión',
  `last_activity` int(10) UNSIGNED NOT NULL COMMENT 'Marca de tiempo UNIX de la última actividad',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`) VALUES
('ANqfKof8ndBE119zuVWJz9kXOtf81ox5kJqbMFlc', 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJbFpXVTJwRFNUVnBiV1IwZUhKUU5qSktjak40UjNjOVBTSXNJblpoYkhWbElqb2lZVFJQYW5CU1N6bGFkVTVyY1VsVlJHOVFhWGxEZERKM1dtRm5WMWRDTTJWaVVtOVlWMWxSY1VVek1HOU9TR1prZFcwd1ZVaG9PREphVFVoQ1VscHpNMDQzUldGQ1F6Smxla1JvWlVGcFkyVlhhMVUzWkVSbFlsQTFUamROTUd0elduQTBLMDg0UTNSM00zZHljRzlITVRkSU1EQnVPV1pVUVZoVWRHUXdiMXBYVURKcll6Wk1jVTV5ZDNRdlQwbENVRU5TWmk5UFkwbHdWRVJYVUhaRVJHeDVla2xXTUN0elMzVm1lVlJhWld4VFp6RnhaRkZNYjNWaVNWSXJTM1oyWlVGYWJEWmlXWEV6YUdFeFZITklRVzlCTldjNVlsRnhOemN6UjIxTk5qaEpLMXBKVm1oYWNWTlZWaTlTY1ZSc01XZ3ZlbFp4WVRCaWNYZHRNSHBVUW1RM2RtTjVaR3B2YTAxTEt6ZG5Sa1YxVGpKSWIxb3ZUbEprTHl0NlNqZEdUVlpuZUhFNVl5OWFSRVU1VVhCc2FHWkdWRlo2YkdwQ1JFMXZNMHhDZFdkMFQwOUdVa2M1V1U1Q1kwaFVkV2RZY0VGV1VGUkNjVUV4TWxVNFprTTVaSE5WY1M5YU0wOWhTVXBWUFNJc0ltMWhZeUk2SWpFNFpUSTJNR1UxWWpOalpHTXpZekF6Wm1Kak5qUTRNVEE0TkRRd1kyRmtNRGN6TkRReVkyWTFaRFE0WmpKa1pXWTFNV0l6WXpZMVpXWXdNRFpqTkRjaUxDSjBZV2NpT2lJaWZRPT0=', 1752353096, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `signatures`
--

CREATE TABLE `signatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('entrega','devolucion') NOT NULL COMMENT 'Tipo de firma',
  `signature_blob` blob NOT NULL COMMENT 'Firma en BLOB',
  `signature_hash` varchar(64) DEFAULT NULL COMMENT 'Hash SHA-256',
  `signed_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha firma',
  `observacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `personal_email` varchar(100) DEFAULT NULL,
  `institutional_email` varchar(100) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
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
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `document_type`, `first_name`, `last_name`, `username`, `email`, `identification_number`, `email_verified_at`, `password`, `remember_token`, `last_password_change_at`, `password_policy_version`, `last_login_at`, `last_login_ip`, `employee_id`, `position_id`, `phone_number`, `personal_email`, `institutional_email`, `department_id`, `branch_id`, `location_id`, `status`, `account_valid_from`, `account_valid_until`, `consent_data_processing`, `consent_marketing`, `consent_data_sharing`, `consent_timestamp`, `privacy_policy_version`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CC', 'Root', 'Administrator', 'root', 'dercaloh@gmail.com', '', NULL, '$2y$12$XmpaZt4VjAX0R3hA4SEd7u3Q370yluQ0VAM.rT9J/myqfUUzwomPW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, 'activo', NULL, NULL, 1, 0, 0, '2025-07-02 22:54:48', '1.0', '2025-07-02 22:54:48', '2025-07-06 01:57:42', NULL),
(3, 'CC', 'María', 'Pérez', 'subdirectora', 'm.perez@sena.edu.co', '', '2025-07-02 22:54:51', '$2y$12$nnQdWc7dpPU99IGr0LZrYuR7.A6y2lW.oopht.E4aIct1ClNXZziK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, 'activo', NULL, NULL, 1, 0, 0, NULL, NULL, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(4, 'CC', 'Luis', 'Martínez', 'coordtic', 'l.martinez@sena.edu.co', '', '2025-07-02 22:54:51', '$2y$12$sFc5MjfCnmNd4MaALbKa/.2j3IranSPJjl721zwSiLomIpuj5ku7K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, 'activo', NULL, NULL, 1, 0, 0, NULL, NULL, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(5, 'CC', 'Laura', 'López', 'func_admin', 'l.lopez@sena.edu.co', '', '2025-07-02 22:54:51', '$2y$12$ADW9vjAPzvl8YZxwYMN4k.tF6PU48CQGlUv58Kv9mZoiRyGbUpdDi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 'activo', NULL, NULL, 1, 0, 0, NULL, NULL, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(6, 'CC', 'Camilo', 'Gómez', 'porteria1', 'c.gomez@sena.edu.co', '', '2025-07-02 22:54:51', '$2y$12$.mwGOa4vSexscyNDzc5a1eNlhO1YVHa9ccwnkKOU.vF4RJTsbM4eS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, 'activo', NULL, NULL, 1, 0, 0, NULL, NULL, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(7, 'CC', 'Julián', 'Mejía', 'aprendiz1', 'julian.mejia@misena.edu.co', '', '2025-07-02 22:54:51', '$2y$12$OU2vAK/w6Pbb3qF.mgn12OUvvnCtbM7Yju5lbUVAi67Vhbwl3s5L6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, 'activo', NULL, NULL, 1, 0, 0, NULL, NULL, '2025-07-02 22:54:51', '2025-07-02 22:54:51', NULL),
(21, 'CC', 'Harold Antonio', 'Cordero Solera', 'hacordero', 'dercaloh@hotmail.com', '1040498580', NULL, '$2y$12$eX1EdKQAkiCtL5Z8Pas.1uJceKlx3DHBjnfUFIQn3Ah.ueQcQ4dHy', NULL, NULL, NULL, NULL, NULL, NULL, 19, '3218724618', 'dercaloh@hotmail.com', NULL, 20, 2, 48, 'activo', NULL, NULL, 0, 0, 0, NULL, NULL, '2025-07-04 05:05:27', '2025-07-12 19:49:05', NULL),
(22, 'CC', 'Administrador', 'Cfma', 'admin.cfma', 'admin@cfma.sena.edu.co', '12345874', NULL, '$2y$12$DEpYw/0mAk571SXSJhsXPuNxpyQeNQK7myrj3w.nbRN1WqZsm.k/m', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 20, 1, 22, 'activo', '2025-07-05', NULL, 1, 0, 0, '2025-07-05 08:00:58', '1.0', '2025-07-05 08:00:58', '2025-07-12 17:05:21', NULL),
(23, 'TI', 'Test2', 'User2', 'tuser', 'test@user.es', '123456789', NULL, '$2y$12$KtJ8L.0gLGL5vHefv.mKcezvYON7H3IOEEtcMD2U5dqHOhoBocY/u', NULL, NULL, NULL, NULL, NULL, NULL, 4, '3218724618', 'test@user.ese', NULL, 6, 2, 49, 'activo', '2025-07-12', '2025-07-25', 1, 1, 1, NULL, NULL, '2025-07-10 02:37:46', '2025-07-12 15:55:28', NULL),
(24, 'TI', 'Test 3', 'User2', 'test-3user2', 'test3@user.ex', '454545', NULL, '$2y$12$yjnF5kQTDI1HYUMqcaazBO9/SsWRDHnQj3kuOz6dIi.0mh4LsjgSq', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, 'test3@user.ex', 2, 2, 52, 'inactivo', NULL, NULL, 0, 0, 0, NULL, NULL, '2025-07-12 19:50:06', '2025-07-12 19:51:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_organizational_data`
--

CREATE TABLE `user_organizational_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `contract_type` enum('planta','temporal','externo','contratista') DEFAULT 'planta',
  `salary` decimal(12,2) DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_policies`
--

CREATE TABLE `user_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `policy_name` varchar(255) NOT NULL,
  `policy_version` varchar(255) NOT NULL DEFAULT '1.0',
  `accepted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `accepted_ip` varchar(45) DEFAULT NULL,
  `accepted_user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_policies`
--

INSERT INTO `user_policies` (`id`, `user_id`, `policy_name`, `policy_version`, `accepted_at`, `accepted_ip`, `accepted_user_agent`, `created_at`, `updated_at`) VALUES
(1, 21, 'Política de privacidad', '1.0', '2025-07-04 05:05:27', '127.0.0.1', NULL, '2025-07-04 05:05:27', '2025-07-04 05:05:27'),
(2, 1, 'data_protection', '1.0.0', '2025-07-05 21:13:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '2025-07-05 21:13:11', '2025-07-05 21:13:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_security`
--

CREATE TABLE `user_security` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mfa_secret` blob DEFAULT NULL COMMENT 'Secreto TOTP encriptado',
  `mfa_enabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'MFA activado',
  `mfa_enabled_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de activación',
  `mfa_last_ip` varchar(45) DEFAULT NULL COMMENT 'Última IP de validación MFA',
  `mfa_last_verified_at` timestamp NULL DEFAULT NULL COMMENT 'Último acceso exitoso con MFA',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`),
  ADD KEY `idx_activity_log_subject` (`subject_type`,`subject_id`);

--
-- Indices de la tabla `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_serial_placa` (`serial_number`,`placa`),
  ADD KEY `assets_ownership_index` (`ownership`),
  ADD KEY `assets_year_purchased_index` (`year_purchased`),
  ADD KEY `assets_status_index` (`status`),
  ADD KEY `fk_assets_type` (`type_id`),
  ADD KEY `fk_assets_location` (`location_id`),
  ADD KEY `fk_assets_assigned_to` (`assigned_to`),
  ADD KEY `idx_assets_status_location` (`status`,`location_id`);
ALTER TABLE `assets` ADD FULLTEXT KEY `assets_description_fulltext` (`description`);

--
-- Indices de la tabla `asset_disposals`
--
ALTER TABLE `asset_disposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_disposals_asset_id_foreign` (`asset_id`),
  ADD KEY `asset_disposals_processed_by_foreign` (`processed_by`);

--
-- Indices de la tabla `asset_hardware_details`
--
ALTER TABLE `asset_hardware_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_hardware_details_asset_id_unique` (`asset_id`),
  ADD UNIQUE KEY `asset_hardware_details_mac_address_unique` (`mac_address`);

--
-- Indices de la tabla `asset_software_details`
--
ALTER TABLE `asset_software_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_software_details_asset_id_license_status_index` (`asset_id`,`license_status`);

--
-- Indices de la tabla `asset_types`
--
ALTER TABLE `asset_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_types_name_unique` (`name`),
  ADD KEY `asset_types_active_index` (`active`);

--
-- Indices de la tabla `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_name_unique` (`name`),
  ADD KEY `branches_active_index` (`active`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`),
  ADD KEY `departments_active_index` (`active`);

--
-- Indices de la tabla `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_documentable` (`documentable_id`,`documentable_type`);

--
-- Indices de la tabla `entry_exit_logs`
--
ALTER TABLE `entry_exit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entry_exit_logs_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `exit_passes`
--
ALTER TABLE `exit_passes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exit_passes_gate_log_id_index` (`gate_log_id`),
  ADD KEY `exit_passes_permiso_index` (`permiso`),
  ADD KEY `exit_passes_signed_by_index` (`signed_by`),
  ADD KEY `exit_passes_estado_index` (`estado`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gate_logs`
--
ALTER TABLE `gate_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gate_asset_fecha` (`asset_id`,`logged_at`),
  ADD KEY `gate_logs_asset_id_index` (`asset_id`),
  ADD KEY `gate_logs_user_id_index` (`user_id`),
  ADD KEY `gate_logs_logged_at_index` (`logged_at`);
ALTER TABLE `gate_logs` ADD FULLTEXT KEY `gate_logs_notes_fulltext` (`notes`);

--
-- Indices de la tabla `instructor_program`
--
ALTER TABLE `instructor_program`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructor_program_unique` (`program_id`,`user_id`,`rol`),
  ADD KEY `instructor_program_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `intangible_assets`
--
ALTER TABLE `intangible_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_approved_by_foreign` (`approved_by`),
  ADD KEY `loans_delivered_by_foreign` (`delivered_by`),
  ADD KEY `loans_received_by_foreign` (`received_by`),
  ADD KEY `loans_user_requested_idx` (`user_id`,`requested_at`),
  ADD KEY `loans_requested_at_index` (`requested_at`),
  ADD KEY `loans_approved_at_index` (`approved_at`),
  ADD KEY `loans_returned_at_index` (`returned_at`),
  ADD KEY `fk_loans_asset` (`asset_id`),
  ADD KEY `fk_loans_status` (`status_id`),
  ADD KEY `idx_loans_user_asset` (`user_id`,`asset_id`);

--
-- Indices de la tabla `loan_approvals`
--
ALTER TABLE `loan_approvals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_loan_status_decision` (`loan_id`,`status`),
  ADD KEY `idx_loan_approvals_loan_id` (`loan_id`),
  ADD KEY `idx_loan_approvals_decided_by` (`decided_by`),
  ADD KEY `loan_approvals_approved_at_index` (`approved_at`);

--
-- Indices de la tabla `loan_details`
--
ALTER TABLE `loan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_loan_details_loan_id` (`loan_id`);

--
-- Indices de la tabla `loan_request_data`
--
ALTER TABLE `loan_request_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_loan_request_loan_id` (`loan_id`),
  ADD KEY `loan_request_data_program_id_foreign` (`program_id`),
  ADD KEY `loan_request_data_instructor_id_foreign` (`instructor_id`),
  ADD KEY `loan_request_data_position_id_foreign` (`position_id`),
  ADD KEY `loan_request_data_proxy_type_id_foreign` (`proxy_type_id`),
  ADD KEY `loan_request_data_tipo_de_uso_index` (`tipo_de_uso`),
  ADD KEY `loan_request_data_fecha_entrega_deseada_index` (`fecha_entrega_deseada`),
  ADD KEY `fk_request_depto` (`department_id`),
  ADD KEY `fk_request_branch` (`branch_id`);

--
-- Indices de la tabla `loan_statuses`
--
ALTER TABLE `loan_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_statuses_name_unique` (`name`),
  ADD KEY `loan_statuses_order_index_index` (`order_index`);

--
-- Indices de la tabla `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_name_unique` (`name`),
  ADD KEY `fk_locations_branch_id` (`branch_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_read_status` (`user_id`,`is_read`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `policy_views`
--
ALTER TABLE `policy_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_views_viewed_at_index` (`viewed_at`),
  ADD KEY `policy_views_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `positions_title_unique` (`title`),
  ADD KEY `positions_active_index` (`active`);

--
-- Indices de la tabla `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_name_unique` (`name`);

--
-- Indices de la tabla `proxy_types`
--
ALTER TABLE `proxy_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proxy_types_name_unique` (`name`),
  ADD KEY `proxy_types_active_index` (`active`);

--
-- Indices de la tabla `real_estate_assets`
--
ALTER TABLE `real_estate_assets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_activity` (`user_id`,`last_activity`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_signature_per_user_type` (`loan_id`,`user_id`,`type`),
  ADD KEY `fk_signatures_user_id` (`user_id`),
  ADD KEY `signatures_signed_at_index` (`signed_at`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_employee_id_unique` (`employee_id`),
  ADD KEY `idx_email_status` (`email_verified_at`,`status`),
  ADD KEY `idx_user_audit` (`created_at`),
  ADD KEY `users_last_login_at_index` (`last_login_at`),
  ADD KEY `users_status_index` (`status`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `fk_users_location_id` (`location_id`),
  ADD KEY `fk_users_branch_id` (`branch_id`),
  ADD KEY `users_position_id_foreign` (`position_id`);

--
-- Indices de la tabla `user_organizational_data`
--
ALTER TABLE `user_organizational_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `supervisor_id` (`supervisor_id`);

--
-- Indices de la tabla `user_policies`
--
ALTER TABLE `user_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_policies_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `user_security`
--
ALTER TABLE `user_security`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_security_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT de la tabla `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asset_disposals`
--
ALTER TABLE `asset_disposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asset_hardware_details`
--
ALTER TABLE `asset_hardware_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asset_software_details`
--
ALTER TABLE `asset_software_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asset_types`
--
ALTER TABLE `asset_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entry_exit_logs`
--
ALTER TABLE `entry_exit_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `exit_passes`
--
ALTER TABLE `exit_passes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gate_logs`
--
ALTER TABLE `gate_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instructor_program`
--
ALTER TABLE `instructor_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `intangible_assets`
--
ALTER TABLE `intangible_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loan_approvals`
--
ALTER TABLE `loan_approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loan_details`
--
ALTER TABLE `loan_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loan_request_data`
--
ALTER TABLE `loan_request_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loan_statuses`
--
ALTER TABLE `loan_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `policy_views`
--
ALTER TABLE `policy_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proxy_types`
--
ALTER TABLE `proxy_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `real_estate_assets`
--
ALTER TABLE `real_estate_assets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `user_organizational_data`
--
ALTER TABLE `user_organizational_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_policies`
--
ALTER TABLE `user_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user_security`
--
ALTER TABLE `user_security`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assets_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assets_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `asset_types` (`id`),
  ADD CONSTRAINT `fk_assets_assigned_to` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_assets_location` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`),
  ADD CONSTRAINT `fk_assets_type` FOREIGN KEY (`type_id`) REFERENCES `asset_types` (`id`);

--
-- Filtros para la tabla `asset_disposals`
--
ALTER TABLE `asset_disposals`
  ADD CONSTRAINT `asset_disposals_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asset_disposals_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `asset_hardware_details`
--
ALTER TABLE `asset_hardware_details`
  ADD CONSTRAINT `asset_hardware_details_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_hardware_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`);

--
-- Filtros para la tabla `asset_software_details`
--
ALTER TABLE `asset_software_details`
  ADD CONSTRAINT `asset_software_details_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_software_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`);

--
-- Filtros para la tabla `entry_exit_logs`
--
ALTER TABLE `entry_exit_logs`
  ADD CONSTRAINT `entry_exit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `exit_passes`
--
ALTER TABLE `exit_passes`
  ADD CONSTRAINT `fk_exit_gate_log` FOREIGN KEY (`gate_log_id`) REFERENCES `gate_logs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_exit_signed_by` FOREIGN KEY (`signed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `gate_logs`
--
ALTER TABLE `gate_logs`
  ADD CONSTRAINT `fk_gate_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_gate_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `instructor_program`
--
ALTER TABLE `instructor_program`
  ADD CONSTRAINT `instructor_program_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `instructor_program_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `1` FOREIGN KEY (`status_id`) REFERENCES `loan_statuses` (`id`),
  ADD CONSTRAINT `fk_loans_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  ADD CONSTRAINT `fk_loans_status` FOREIGN KEY (`status_id`) REFERENCES `loan_statuses` (`id`),
  ADD CONSTRAINT `fk_loans_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `loans_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_delivered_by_foreign` FOREIGN KEY (`delivered_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_received_by_foreign` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `loan_approvals`
--
ALTER TABLE `loan_approvals`
  ADD CONSTRAINT `fk_loan_approvals_decided_by` FOREIGN KEY (`decided_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_loan_approvals_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `loan_details`
--
ALTER TABLE `loan_details`
  ADD CONSTRAINT `fk_loan_details_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `loan_request_data`
--
ALTER TABLE `loan_request_data`
  ADD CONSTRAINT `fk_loan_request_data_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_request_branch` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `fk_request_depto` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `fk_request_loan` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`),
  ADD CONSTRAINT `loan_request_data_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_request_data_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_request_data_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_request_data_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_request_data_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `loan_request_data_proxy_type_id_foreign` FOREIGN KEY (`proxy_type_id`) REFERENCES `proxy_types` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `fk_locations_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `policy_views`
--
ALTER TABLE `policy_views`
  ADD CONSTRAINT `policy_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `signatures`
--
ALTER TABLE `signatures`
  ADD CONSTRAINT `fk_signatures_loan_id` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_signatures_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_users_location_id` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_organizational_data`
--
ALTER TABLE `user_organizational_data`
  ADD CONSTRAINT `user_organizational_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_organizational_data_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `user_policies`
--
ALTER TABLE `user_policies`
  ADD CONSTRAINT `user_policies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_security`
--
ALTER TABLE `user_security`
  ADD CONSTRAINT `user_security_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
