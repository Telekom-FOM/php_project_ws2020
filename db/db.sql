-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.3.25-MariaDB-0ubuntu0.20.04.1-log - Ubuntu 20.04
-- Server Betriebssystem:        debian-linux-gnu
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE USER 'app'@'%' IDENTIFIED BY ';(=xc3*8Ce]j5g!Y:G;UMPFr!if/}sfG';

-- Exportiere Datenbank Struktur für webshop
CREATE DATABASE IF NOT EXISTS `webshop` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `webshop`;

-- Exportiere Struktur von Tabelle webshop.article
CREATE TABLE IF NOT EXISTS `article` (
  `article_nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `price` double(6,2) unsigned DEFAULT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`article_nr`),
  KEY `FK_article_article_category` (`category`),
  CONSTRAINT `FK_article_article_category` FOREIGN KEY (`category`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6301 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.article: ~22 rows (ungefähr)
DELETE FROM `article`;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`article_nr`, `name`, `price`, `category`) VALUES
	(6265, 'Albrecht AE65H ', 89.95, 16),
	(6267, 'Doppelstandlader', 14.95, 2),
	(6278, 'Soundkarte', 69.99, 7),
	(6281, 'Funkmeldeempfänger', 499.99, 16),
	(6282, 'ESP32', 9.99, 17),
	(6283, 'Raspberry Pi 4GB', 49.99, 17),
	(6284, 'Arduino Uno', 14.99, 17),
	(6285, 'Samsung GT-S8500', 79.99, 2),
	(6286, 'Samsung S5 mini', 149.99, 2),
	(6287, 'Arbeitsspeicher', 49.99, 18),
	(6288, 'Samsung Galaxy A8', 149.99, 2),
	(6289, 'Samsung Galaxy Watch', 249.99, 2),
	(6290, 'Logitech G Pro Wireless', 0.01, 18),
	(6291, 'Speedport W500v', 99.95, 16),
	(6292, 'DSL Splitter', 79.99, 16),
	(6293, 'NTBA', 19.99, 16),
	(6294, 'Samsung GT-S5230', 29.99, 2),
	(6295, 'Externe Festplatte 1TB', 50.99, 18),
	(6296, 'Akku', 19.99, 18),
	(6297, 'Docking Station', 35.49, 18),
	(6298, 'Apfel', 0.99, 15),
	(6299, 'Nudeln', 1.99, 15),
	(6300, 'Switch', 17.34, 16);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.article_category
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.article_category: ~7 rows (ungefähr)
DELETE FROM `article_category`;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` (`id`, `name`) VALUES
	(2, 'Mobilfunk'),
	(7, 'Audio'),
	(15, 'Lebensmittel'),
	(16, 'Telekommunikation'),
	(17, 'Mikrocontroller'),
	(18, 'PC-Zubehör');
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_kdnr` int(11) unsigned NOT NULL,
  `ordered` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_cart_user` (`fk_kdnr`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.cart: ~4 rows (ungefähr)
DELETE FROM `cart`;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.cart_content
CREATE TABLE IF NOT EXISTS `cart_content` (
  `fk_cart_id` int(11) unsigned NOT NULL,
  `fk_article` int(11) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  KEY `FK__cart` (`fk_cart_id`),
  KEY `FK_cart_content_article` (`fk_article`),
  CONSTRAINT `FK__cart` FOREIGN KEY (`fk_cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cart_content_article` FOREIGN KEY (`fk_article`) REFERENCES `article` (`article_nr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.cart_content: ~4 rows (ungefähr)
DELETE FROM `cart_content`;
/*!40000 ALTER TABLE `cart_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_content` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_article_id` int(11) unsigned NOT NULL,
  `fk_user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `stars` int(10) unsigned DEFAULT 0,
  `message` varchar(255) NOT NULL DEFAULT '0',
  `response_id` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_review_user` (`fk_user_id`),
  KEY `FK_review_article` (`fk_article_id`),
  CONSTRAINT `FK_review_article` FOREIGN KEY (`fk_article_id`) REFERENCES `article` (`article_nr`),
  CONSTRAINT `FK_review_user` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`kd_nr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.review: ~3 rows (ungefähr)
DELETE FROM `review`;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` (`id`, `fk_article_id`, `fk_user_id`, `stars`, `message`, `response_id`) VALUES
	(49, 6292, 1008, 5, 'Nur zu empfehlen!', 0),
	(50, 6267, 1008, 1, 'schlechte Verbindung', 0),
	(51, 6299, 1008, 5, 'top', 0);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.user
CREATE TABLE IF NOT EXISTS `user` (
  `kd_nr` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`kd_nr`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1019 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.user: ~3 rows (ungefähr)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`kd_nr`, `email`, `password`, `firstname`, `lastname`, `street`, `zip`, `city`, `country`, `phone`, `is_admin`) VALUES
	(00000001001, 'admin@localhost.tld', '1a1dc91c907325c69271ddf0c944bc72', 'Linus', 'Torvalds', 'Main Street 5', '12345', 'Berlin', 'Deutschland', '+4912348712', 1),
	(00000001002, 'customer@localhost.tld', '1a1dc91c907325c69271ddf0c944bc72', 'Jonas', 'Meier', 'Alexanderplatz 1', '10115', 'Berlin', 'Deutschland', '+491234812412', 0);

GRANT ALL PRIVILEGES ON webshop.* TO 'app'@'%';
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
