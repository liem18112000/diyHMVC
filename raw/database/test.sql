-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for application
CREATE DATABASE IF NOT EXISTS `application` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `application`;

-- Dumping structure for table application.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT 'Not Available',
  `gender` int(1) DEFAULT NULL,
  `notes` text,
  `age` int(3) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table application.customer: ~19 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` (`id`, `name`, `gender`, `notes`, `age`, `date_created`) VALUES
	(1, 'Introduction to Basic', 1, 'dbdb bfggs  nfgsfg', 45, '2020-03-21 21:50:44'),
	(4, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(5, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(6, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(7, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(8, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(9, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(10, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(11, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(12, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(13, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(14, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(15, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(16, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(17, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(18, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(19, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(20, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(21, 'Liem', 1, 'wcwd qed edf f f gv', 20, '2020-03-21 21:50:44'),
	(24, 'New customer', 1, 'ad vdvsfsfsbf ', 34, '2020-03-23 00:25:19');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table application.customer_service
CREATE TABLE IF NOT EXISTS `customer_service` (
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `cost` int(10) unsigned NOT NULL,
  PRIMARY KEY (`customer_id`,`service_id`)
--   KEY `service_id` (`service_id`),
--   CONSTRAINT `customer_service_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
--   CONSTRAINT `customer_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table application.customer_service: ~9 rows (approximately)
/*!40000 ALTER TABLE `customer_service` DISABLE KEYS */;
INSERT INTO `customer_service` (`customer_id`, `service_id`, `date`, `duration`, `cost`) VALUES
	(1, 1, '2020-03-22', 60, 10),
	(4, 1, '2020-03-22', 120, 20),
	(5, 1, '2020-03-22', 60, 10),
	(6, 1, '2020-03-22', 60, 10),
	(7, 1, '2020-03-22', 60, 10),
	(8, 1, '2020-03-22', 60, 10),
	(9, 1, '2020-03-22', 60, 10),
	(19, 1, '2020-03-22', 60, 10),
	(20, 1, '2020-03-22', 60, 10),
	(21, 1, '2020-03-23', 60, 10),
	(24, 1, '2020-03-22', 60, 10);
/*!40000 ALTER TABLE `customer_service` ENABLE KEYS */;

-- Dumping structure for table application.service
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table application.service: ~2 rows (approximately)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id`, `name`, `description`) VALUES
	(1, 'Daily treatment', 'Not avaiable'),
	(2, 'Monthly treatment', 'Not avaiable');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Dumping structure for table application.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `authority` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table application.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `date_created`, `authority`) VALUES
	(1, 'liemadmin', '$2y$10$5z7cJZQY75T6oNtPzWw/8O2l6lzQPe6td7Zk82nplhM4VR0q2X2ai', 'liem18112000@gmail.com', '2020-03-16 11:50:47', '1'),
	(3, 'liem00', '$2y$10$jTiqYhrv3Xmqu57j7DM1.eWfANFntRWhgRkJNQb4/.C9dwLRXAvEu', 'liem@gmail.com', '2020-03-18 21:47:37', '1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
