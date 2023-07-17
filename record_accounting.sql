-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for record_accounting
CREATE DATABASE IF NOT EXISTS `record_accounting` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `record_accounting`;

-- Dumping structure for table record_accounting.investment_type
CREATE TABLE IF NOT EXISTS `investment_type` (
  `investment_id` int NOT NULL AUTO_INCREMENT,
  `record_id` int NOT NULL,
  `necessity_account` decimal(10,2) DEFAULT NULL,
  `financial_freedom` decimal(10,2) DEFAULT NULL,
  `education_account` decimal(10,2) DEFAULT NULL,
  `long_term_save` decimal(10,2) DEFAULT NULL,
  `entertainment` decimal(10,2) DEFAULT NULL,
  `give_account` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`investment_id`),
  KEY `record_id` (`record_id`),
  CONSTRAINT `investment_type_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `record_account` (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table record_accounting.investment_type: ~0 rows (approximately)
REPLACE INTO `investment_type` (`investment_id`, `record_id`, `necessity_account`, `financial_freedom`, `education_account`, `long_term_save`, `entertainment`, `give_account`) VALUES
	(1, 2, 825.00, 150.00, 150.00, 150.00, 150.00, 75.00),
	(2, 3, 8250.00, 1500.00, 1500.00, 1500.00, 1500.00, 750.00),
	(3, 4, 8250.00, 1500.00, 1500.00, 1500.00, 1500.00, 750.00);

-- Dumping structure for table record_accounting.record_account
CREATE TABLE IF NOT EXISTS `record_account` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `date_record` varchar(50) DEFAULT NULL,
  `amount_income` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table record_accounting.record_account: ~0 rows (approximately)
REPLACE INTO `record_account` (`record_id`, `date_record`, `amount_income`) VALUES
	(1, '2023-07-05', 1500.00),
	(2, '2023-07-05', 1500.00),
	(3, '2023-06-29', 15000.00),
	(4, '2023-06-29', 15000.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
