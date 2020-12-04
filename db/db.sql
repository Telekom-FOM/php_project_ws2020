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


-- Exportiere Datenbank Struktur für mysql
CREATE DATABASE IF NOT EXISTS `mysql` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mysql`;

-- Exportiere Struktur von Tabelle mysql.user
CREATE TABLE IF NOT EXISTS `user` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(80) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Password` char(41) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `Select_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Insert_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Update_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Delete_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Drop_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Reload_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Shutdown_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Process_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `File_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Grant_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `References_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Index_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_db_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Super_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tmp_table_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Lock_tables_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Execute_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Repl_slave_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Repl_client_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_user_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Event_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Trigger_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tablespace_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Delete_history_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `ssl_type` enum('','ANY','X509','SPECIFIED') CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ssl_cipher` blob NOT NULL,
  `x509_issuer` blob NOT NULL,
  `x509_subject` blob NOT NULL,
  `max_questions` int(11) unsigned NOT NULL DEFAULT 0,
  `max_updates` int(11) unsigned NOT NULL DEFAULT 0,
  `max_connections` int(11) unsigned NOT NULL DEFAULT 0,
  `max_user_connections` int(11) NOT NULL DEFAULT 0,
  `plugin` char(64) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `authentication_string` text COLLATE utf8_bin NOT NULL,
  `password_expired` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `is_role` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `default_role` char(80) COLLATE utf8_bin NOT NULL DEFAULT '',
  `max_statement_time` decimal(12,6) NOT NULL DEFAULT 0.000000,
  PRIMARY KEY (`Host`,`User`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and global privileges';

-- Exportiere Daten aus Tabelle mysql.user: 4 rows
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`Host`, `User`, `Password`, `Select_priv`, `Insert_priv`, `Update_priv`, `Delete_priv`, `Create_priv`, `Drop_priv`, `Reload_priv`, `Shutdown_priv`, `Process_priv`, `File_priv`, `Grant_priv`, `References_priv`, `Index_priv`, `Alter_priv`, `Show_db_priv`, `Super_priv`, `Create_tmp_table_priv`, `Lock_tables_priv`, `Execute_priv`, `Repl_slave_priv`, `Repl_client_priv`, `Create_view_priv`, `Show_view_priv`, `Create_routine_priv`, `Alter_routine_priv`, `Create_user_priv`, `Event_priv`, `Trigger_priv`, `Create_tablespace_priv`, `Delete_history_priv`, `ssl_type`, `ssl_cipher`, `x509_issuer`, `x509_subject`, `max_questions`, `max_updates`, `max_connections`, `max_user_connections`, `plugin`, `authentication_string`, `password_expired`, `is_role`, `default_role`, `max_statement_time`) VALUES
	('localhost', 'root', '', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', _binary '', _binary '', _binary '', 0, 0, 0, 0, 'unix_socket', '', 'N', 'N', '', 0.000000),
	('%', 'app', '*C9FD27CF19EEA13A77E19DAAA7BBD11D4CCFDCBD', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', _binary '', _binary '', _binary '', 0, 0, 0, 0, '', '', 'N', 'N', '', 0.000000),
	('%', 'mbenkert', '*95C8178AB972D5607CA95FC30F18DE5D8203254A', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', _binary '', _binary '', _binary '', 0, 0, 0, 0, '', '', 'N', 'N', '', 0.000000),
	('localhost', 'phpmyadmin', '*6A88F04AB98C3C07109AC7C0A35DE43D62942172', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', _binary '', _binary '', _binary '', 0, 0, 0, 0, '', '', 'N', 'N', '', 0.000000);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=6281 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.article: ~9 rows (ungefähr)
DELETE FROM `article`;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`article_nr`, `name`, `price`, `category`) VALUES
	(4418, 'DVD-Recorder', 249.00, 1),
	(4422, 'DVD-Player', 49.95, 1),
	(4471, 'Fernbedienung', 19.95, 1),
	(4475, 'Portable DVD-Kombi', 279.00, 1),
	(4482, 'DVD-Videokombi', 189.00, 1),
	(6213, 'PMR-Funkerätepaar', 29.95, 2),
	(6265, 'Handscanner', 89.95, 2),
	(6267, 'Doppelstandlader', 14.95, 2),
	(6278, 'Stereoanlage', 1.50, 7);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.article_category
CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.article_category: ~5 rows (ungefähr)
DELETE FROM `article_category`;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
INSERT INTO `article_category` (`id`, `name`) VALUES
	(1, 'DVD/Video'),
	(2, 'Mobilfunk'),
	(7, 'Audio'),
	(14, 'Sanitär'),
	(15, 'Lebensmittel');
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_kdnr` int(11) unsigned NOT NULL,
  `ordered` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_cart_user` (`fk_kdnr`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.cart: ~5 rows (ungefähr)
DELETE FROM `cart`;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`id`, `fk_kdnr`, `ordered`, `date`) VALUES
	(20, 1008, 1, '2020-12-01 11:55:24'),
	(21, 1008, 1, '2020-12-01 17:48:21'),
	(22, 1008, 1, '2020-12-01 19:08:25'),
	(23, 1008, 0, '2020-12-02 15:15:01'),
	(24, 1009, 0, '2020-12-02 17:25:58');
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
INSERT INTO `cart_content` (`fk_cart_id`, `fk_article`, `amount`) VALUES
	(20, 4418, 50),
	(21, 6213, 5),
	(21, 4418, 1),
	(22, 6265, 7);
/*!40000 ALTER TABLE `cart_content` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle webshop.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(10) unsigned NOT NULL DEFAULT 0,
  `stars` int(10) unsigned NOT NULL DEFAULT 0,
  `message` varchar(50) NOT NULL DEFAULT '0',
  `response_id` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_review_user` (`fk_user_id`),
  CONSTRAINT `FK_review_user` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`kd_nr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.review: ~0 rows (ungefähr)
DELETE FROM `review`;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` (`id`, `fk_user_id`, `stars`, `message`, `response_id`) VALUES
	(5, 1008, 5, 'Desch is so geil', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=1018 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle webshop.user: ~3 rows (ungefähr)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`kd_nr`, `email`, `password`, `firstname`, `lastname`, `street`, `zip`, `city`, `country`, `phone`, `is_admin`) VALUES
	(00000001008, 'max.benkert@gmx.de', '1a1dc91c907325c69271ddf0c944bc72', 'Max', 'Benkert', 'Zum Nussacker 16', '97500', 'Ebelsbach', 'Germany', '+4915115886212', 1),
	(00000001009, 'kev.hohm@gmail.com', 'd93dbfca878bec73dcc7ba76f63f958c', 'Kevin', 'Hohm', 'Schiffbauplatz 4b', '96047', 'Bamberg', 'Deutschland', '015174440867', 1),
	(00000001012, 'benkertmax@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'Walter', 'Freiwald', 'Feldweg 8', '12345', 'Kirchturm', 'Deutschland', 'kein telefon', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
