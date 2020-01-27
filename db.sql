-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               5.6.21 - MySQL Community Server (GPL)
-- Serwer OS:                    Win32
-- HeidiSQL Wersja:              9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Zrzut struktury tabela f1wm.authors
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `downloaded` timestamp NULL DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Zrzut struktury tabela f1wm.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `downloaded` timestamp NULL DEFAULT NULL,
  `author_id` int(6) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `contents` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42005 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Zrzut struktury tabela f1wm.phinxlog
DROP TABLE IF EXISTS `phinxlog`;
CREATE TABLE IF NOT EXISTS `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
