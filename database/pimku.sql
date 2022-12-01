-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pimku.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `company` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `country` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `address` text COLLATE latin1_general_ci,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.clients: ~1 rows (approximately)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
REPLACE INTO `clients` (`id`, `name`, `company`, `country`, `address`, `email`, `phone`, `create_by`, `created_at`, `updated_at`) VALUES
	(1, 'Test', 'Company Test', 'indonesia', 'address in here ...', 'mail@company.com', '0812 1234 1234', 1, '2022-11-22 22:32:52', '2022-11-22 15:46:13');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Dumping structure for table pimku.complexities
CREATE TABLE IF NOT EXISTS `complexities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.complexities: ~4 rows (approximately)
/*!40000 ALTER TABLE `complexities` DISABLE KEYS */;
REPLACE INTO `complexities` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Level 1', '2022-11-22 22:54:44', '2022-11-22 22:54:44'),
	(2, 'Level 2', '2022-11-22 22:54:49', '2022-11-22 22:54:49'),
	(3, 'Level 3', '2022-11-22 22:54:58', '2022-11-22 22:54:58');
/*!40000 ALTER TABLE `complexities` ENABLE KEYS */;

-- Dumping structure for table pimku.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.departments: ~2 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
REPLACE INTO `departments` (`id`, `name`, `create_by`, `created_at`, `updated_at`) VALUES
	(1, 'Department 1', 1, NULL, '2022-11-22 09:29:37'),
	(2, 'Department 2', 1, '2022-11-22 16:33:28', '2022-11-22 16:33:28');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping structure for table pimku.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `employee_type_id` int(11) NOT NULL DEFAULT '0',
  `department_id` int(11) NOT NULL DEFAULT '0',
  `create_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.employees: ~4 rows (approximately)
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
REPLACE INTO `employees` (`id`, `code`, `name`, `employee_type_id`, `department_id`, `create_by`, `created_at`, `updated_at`) VALUES
	(1, 'EMP-001', 'Person 1', 1, 1, 1, '2022-11-22 16:22:05', '2022-11-22 16:22:05'),
	(2, 'EMP-002', 'Person 2', 2, 2, 1, '2022-11-22 09:37:19', '2022-11-22 10:17:48'),
	(3, 'EMP-003', 'Person 3', 2, 2, 1, '2022-11-22 09:37:19', '2022-11-28 10:28:18');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping structure for table pimku.employee_types
CREATE TABLE IF NOT EXISTS `employee_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.employee_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `employee_types` DISABLE KEYS */;
REPLACE INTO `employee_types` (`id`, `name`, `create_by`, `created_at`, `updated_at`) VALUES
	(1, 'Full Time', 1, '2022-11-22 16:06:09', '2022-11-22 16:06:09'),
	(2, 'Part Time', 1, '2022-11-22 09:57:54', '2022-11-22 09:57:54');
/*!40000 ALTER TABLE `employee_types` ENABLE KEYS */;

-- Dumping structure for table pimku.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `description` text COLLATE latin1_general_ci,
  `reference_number` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `remarks` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.expenses: ~3 rows (approximately)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
REPLACE INTO `expenses` (`id`, `project_id`, `date`, `description`, `reference_number`, `amount`, `remarks`, `create_by`, `created_at`, `updated_at`) VALUES
	(4, 1, '2022-11-25', 'Test Expense 1', '123456789', 500000.00, 'AP', 1, '2022-11-25 08:17:15', '2022-11-25 08:17:15'),
	(5, 1, '2022-12-08', 'Test Expense 2', '1234567810', 750000.00, 'AP', 1, '2022-11-25 08:17:33', '2022-11-25 08:17:33'),
	(6, 1, '2022-01-08', 'Test Expense 3', '1234567810', 750000.00, 'AP', 1, '2022-11-25 08:17:33', '2022-11-25 08:17:33');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Dumping structure for table pimku.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table pimku.incomes
CREATE TABLE IF NOT EXISTS `incomes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(20,2) DEFAULT NULL,
  `paid` decimal(20,2) DEFAULT NULL,
  `remarks` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.incomes: ~3 rows (approximately)
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
REPLACE INTO `incomes` (`id`, `project_id`, `invoice_number`, `date`, `amount`, `paid`, `remarks`, `create_by`, `created_at`, `updated_at`) VALUES
	(4, 1, 'INV-001', '2022-11-24', 2675000.00, 1500000.00, 'AP', 1, '2022-11-25 08:16:12', '2022-11-25 08:16:12'),
	(5, 1, 'INV-002', '2022-12-22', 2600000.00, 500000.00, 'AP', 1, '2022-11-25 08:16:38', '2022-11-25 08:16:38'),
	(6, 1, 'INV-003', '2023-01-22', 2600000.00, 500000.00, 'AP', 1, '2022-11-25 08:16:38', '2022-11-25 08:16:38');
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;

-- Dumping structure for table pimku.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.migrations: ~2 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table pimku.milestones
CREATE TABLE IF NOT EXISTS `milestones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.milestones: ~4 rows (approximately)
/*!40000 ALTER TABLE `milestones` DISABLE KEYS */;
REPLACE INTO `milestones` (`id`, `project_id`, `name`, `create_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Milestone 1', 1, '2022-11-23 11:48:08', '2022-11-23 11:48:08'),
	(2, 1, 'Milestone 2', 1, '2022-11-23 11:48:14', '2022-11-23 11:48:14'),
	(3, 1, 'Milestone 3', 1, '2022-11-23 11:48:19', '2022-11-23 11:48:19');
/*!40000 ALTER TABLE `milestones` ENABLE KEYS */;

-- Dumping structure for table pimku.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.password_resets: ~4 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
REPLACE INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
	(1, 'test@mail.com', '46MPOZEJqxNfCNz1o6boGQzMkDAjbiNxB2SFWFjutE4bZpvuXDW23lygVa9lBn8wvBXq1d0JXu8sfJ2SgyOpoLePh7GH3iHcjxhGaTtA6QRp7CYTeWK0kmhsr1ADr7fd', '2022-11-29 08:18:51', '2022-11-29 08:18:51'),
	(2, 'test@mail.com', 'apcbQkJyCJMU6GYlApwQ3fM03BhKSgFjHkxDSv0tX87Ric8YOy9W6PvfCTESr1xyNhkd8vrI4wwitsAeOmiGBYKq2oPoTEdsehDLLBQq5HUWe25pVabdZUHuFxNjl1XZ', '2022-11-29 08:19:19', '2022-11-29 08:19:19'),
	(3, 'test@mail.com', 'zlYgEiSBAVBaW5pjtpsD7uftfTw1LYCyn2ikd6jh3Ertzdq1H6B8QVncqFOvXoR8K8SHwOPI5RMs9dTebfQ1WGWZQD5VUe3SrkPvpIvj0MK3uRu7zXaxxUbZr2gmY0LJ', '2022-11-29 08:20:34', '2022-11-29 08:20:34'),
	(4, 'test@mail.com', 'jU3aWEb9K7ptSZGZsyMwx1HOgyVePbHL3GGcYNoa4m7jNRQrXo8RlL0uDTk2mjCBvs3IFSLEz47hCEdPfaufB5y6MT2CXtKWq1UzPU1gvAQeDYrx6W29wwguD8rKQMin', '2022-11-29 08:25:44', '2022-11-29 08:25:44'),
	(5, 'test@mail.com', 'YfWAnx1JKbE28s2nPgo4vOzit3LInpvL9LRt6sRyl6u3Vc1PjW5KQ6Gfb0UTpME9o4d0mwHZNYhFm7fqMpdAZ8UBeYdVkerAOMEyS4lDGworem1FTqjizPkiy0tW8Kgz', '2022-11-29 08:40:22', '2022-11-29 08:40:22');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table pimku.plans
CREATE TABLE IF NOT EXISTS `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `duration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_projects` int(11) NOT NULL DEFAULT '0',
  `max_clients` int(11) NOT NULL DEFAULT '0',
  `max_incomes` int(11) NOT NULL DEFAULT '0',
  `max_expenses` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_support` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `plans_name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.plans: ~3 rows (approximately)
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
REPLACE INTO `plans` (`id`, `name`, `price`, `duration`, `unit`, `max_projects`, `max_clients`, `max_incomes`, `max_expenses`, `description`, `url`, `is_support`, `created_at`, `updated_at`) VALUES
	(1, 'Free Plan', 0.00, '7', 'day', 3, 10, 10, 10, '<br>', NULL, 0, '2022-11-28 19:19:47', '2022-11-28 19:19:47'),
	(2, 'Lite Plan', 50000.00, '1', 'month', 0, 0, 0, 0, '*Min Terms 6 Month', NULL, 1, '2022-11-28 19:19:47', '2022-11-28 19:19:47'),
	(3, 'Pro Plan', 45000.00, '1', 'month', 0, 0, 0, 0, '*Min Terms 1 Year', NULL, 1, '2022-11-28 19:19:47', '2022-11-28 19:19:47');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;

-- Dumping structure for table pimku.priorities
CREATE TABLE IF NOT EXISTS `priorities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `color` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.priorities: ~3 rows (approximately)
/*!40000 ALTER TABLE `priorities` DISABLE KEYS */;
REPLACE INTO `priorities` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Low', 'success', '2022-11-22 22:55:48', '2022-11-22 22:55:48'),
	(2, 'Medium', 'warning', '2022-11-22 22:55:53', '2022-11-22 22:55:53'),
	(3, 'High', 'danger', '2022-11-22 22:55:58', '2022-11-22 22:55:59');
/*!40000 ALTER TABLE `priorities` ENABLE KEYS */;

-- Dumping structure for table pimku.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `manager` int(10) DEFAULT '0' COMMENT 'relation from employees table',
  `client_id` int(10) DEFAULT '0',
  `budget` decimal(20,2) DEFAULT '0.00',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `complexity_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `plan_hours` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.projects: ~4 rows (approximately)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
REPLACE INTO `projects` (`id`, `name`, `manager`, `client_id`, `budget`, `start_date`, `end_date`, `complexity_id`, `priority_id`, `status_id`, `plan_hours`, `create_by`, `created_at`, `updated_at`) VALUES
	(1, 'Project 1', 1, 1, 3000000.00, '2022-11-22', '2023-01-30', 1, 1, 2, 5000, 1, '2022-11-22 23:09:27', '2022-11-28 08:35:36'),
	(3, 'Project 2', 2, 1, 2000000.00, '2022-11-22', '2022-12-06', 2, 2, 2, 2000, 1, '2022-11-22 16:34:30', '2022-11-28 08:35:48'),
	(4, 'Project 2', 2, 1, 2000000.00, '2023-11-22', '2023-12-06', 2, 2, 1, 2000, 1, '2022-11-22 16:34:30', '2022-11-22 16:43:46');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;

-- Dumping structure for table pimku.statuses
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.statuses: ~4 rows (approximately)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
REPLACE INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Open', '2022-11-22 23:00:44', '2022-11-22 23:00:45'),
	(2, 'In Progress', '2022-11-22 23:01:02', '2022-11-22 23:01:02'),
	(3, 'Completed', '2022-11-22 23:01:03', '2022-11-22 23:01:03'),
	(4, 'On Hold', '2022-11-22 23:01:23', '2022-11-22 23:01:24'),
	(5, 'Cancelled', '2022-11-22 23:01:32', '2022-11-22 23:01:32');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Dumping structure for table pimku.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `milestone_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `wbs_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `complexity_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `plan_hours` int(11) DEFAULT NULL,
  `actual_hours` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Dumping data for table pimku.tasks: ~19 rows (approximately)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
REPLACE INTO `tasks` (`id`, `project_id`, `milestone_id`, `employee_id`, `wbs_code`, `name`, `start_date`, `end_date`, `status_id`, `complexity_id`, `priority_id`, `plan_hours`, `actual_hours`, `remarks`, `create_by`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 1, 'P1.M1.T1', 'Task 1', '2022-11-01', '2022-11-07', 5, 1, 1, 100, 10, 'AP', 1, NULL, '2022-11-28 02:11:30'),
	(3, 1, 1, 1, 'P1.M1.T2', 'Task 2', '2022-11-07', '2022-11-10', 3, 2, 2, 200, 200, 'AP', 1, NULL, '2022-11-26 17:27:00'),
	(4, 1, 1, 1, 'P1.M1.T3', 'Task 3', '2022-11-10', '2022-11-13', 3, 3, 3, 300, 30, 'AP', 1, NULL, NULL),
	(5, 1, 2, 2, 'P1.M2.T1', 'Task 1', '2022-11-13', '2022-11-16', 1, 1, 1, 100, 10, 'AP', 1, NULL, NULL),
	(6, 1, 2, 2, 'P1.M2.T2', 'Task 2', '2022-11-16', '2022-11-18', 1, 2, 2, 200, 20, 'AP', 1, NULL, '2022-11-28 02:12:36'),
	(7, 1, 2, 2, 'P1.M2.T3', 'Task 3', '2022-11-18', '2022-11-21', 3, 3, 3, 300, 30, 'AP', 1, NULL, NULL),
	(8, 1, 3, 2, 'P1.M3.T1', 'Task 1', '2022-11-21', '2022-11-23', 1, 1, 1, 100, 10, 'AP', 1, NULL, NULL),
	(9, 1, 3, 2, 'P1.M3.T2', 'Task 2', '2022-11-23', '2022-11-26', 2, 2, 2, 200, 20, 'AP', 1, NULL, NULL),
	(10, 1, 3, 2, 'P1.M3.T3', 'Task 3', '2022-11-23', '2022-11-26', 3, 3, 3, 300, 30, 'AP', 1, NULL, NULL),
	(11, 1, 1, 1, 'P1.M1.T4', 'Task 5', '2022-11-26', '2022-11-30', 1, 1, 1, 100, 30, 'AP', 1, NULL, NULL),
	(12, 1, 1, 1, 'P1.M1.T5', 'Task 6', '2022-12-01', '2022-12-03', 2, 2, 2, 200, 60, 'AP', 1, NULL, NULL),
	(13, 1, 1, 1, 'P1.M1.T6', 'Task 7', '2022-12-01', '2022-12-03', 3, 3, 3, 300, 100, 'AP', 1, NULL, NULL),
	(14, 1, 2, 2, 'P1.M2.T4', 'Task 5', '2022-12-03', '2022-12-06', 1, 1, 1, 100, 30, 'AP', 1, NULL, NULL),
	(15, 1, 2, 2, 'P1.M2.T5', 'Task 6', '2022-12-03', '2022-12-06', 2, 2, 2, 200, 60, 'AP', 1, NULL, NULL),
	(16, 1, 2, 2, 'P1.M2.T6', 'Task 7', '2022-12-06', '2022-12-09', 3, 3, 3, 300, 100, 'AP', 1, NULL, NULL),
	(17, 1, 3, 2, 'P1.M3.T4', 'Task 5', '2022-12-06', '2022-12-09', 1, 1, 1, 100, 30, 'AP', 1, NULL, NULL),
	(18, 1, 3, 2, 'P1.M3.T5', 'Task 6', '2022-12-06', '2022-12-09', 3, 2, 2, 200, 60, 'AP', 1, NULL, '2022-11-26 15:55:43'),
	(19, 1, 3, 2, 'P1.M3.T6', 'Task 7', '2022-12-09', '2022-12-12', 3, 3, 3, 300, 100, 'AP', 1, NULL, NULL),
	(20, 1, 3, 3, 'P1.M3.T6', 'Task 7', '2022-12-09', '2022-12-12', 3, 3, 3, 300, 100, 'AP', 1, NULL, '2022-11-25 15:12:54'),
	(21, 1, 3, 3, 'P1.M3.T20', 'Test 33', '2022-12-12', '2022-12-18', 3, 3, 2, 100, 100, 'AP', 1, '2022-11-25 08:49:01', '2022-11-25 08:49:01'),
	(22, 1, 1, 3, 'P1.M3.T15', 'Task 15', '2023-01-02', '2023-01-04', 1, 1, 1, 200, 150, 'AP', 1, '2022-11-25 14:07:41', '2022-11-25 14:07:41');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Dumping structure for table pimku.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` int(11) DEFAULT NULL,
  `plan_expire_date` date DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pimku.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `plan`, `plan_expire_date`, `type`, `is_active`, `remember_token`, `register_token`, `last_login_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Arbi Pramana', 'arbipram@gmail.com', '081290080600', '2022-11-22 07:30:04', '$2y$10$tv6VQt.pnCOmll/lZHVpt..loCeIEyN1OWeqRSHTKyzWb64.rzAru', 2, '2022-12-22', 'users', 1, NULL, '1', NULL, '2022-11-22 06:55:41', '2022-11-28 12:17:01', NULL),
	(2, 'arbi@dedicated-it.com', 'arbi@dedicated-it.com', '6281290080600', '2022-11-28 13:28:57', '$2y$10$U.zGlOQfDS4GS8zuiJHZK.DKZe.8niroF7o4iMWUs3fbIp/12zce2', 1, '2022-12-27', 'users', 1, NULL, '1', NULL, '2022-11-28 13:27:18', '2022-11-28 13:28:57', NULL),
	(6, 'test', 'test@mail.com', '234832483204', '2022-11-29 07:52:24', '$2y$10$Lk7IkVsirxo82t5mX/TpgOuEgsIb0fVnoEsEQFcgATwCouB2Iasa6', 1, '2022-12-06', 'users', 1, NULL, '1', NULL, '2022-11-29 07:51:58', '2022-11-29 08:40:40', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
