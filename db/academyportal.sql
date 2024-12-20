# ************************************************************
# Sequel Ace SQL dump
# Version 20077
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 11.2.2-MariaDB-1:11.2.2+maria~ubu2204)
# Database: academyportal
# Generation Time: 2024-11-12 14:38:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table applicants
# ------------------------------------------------------------

DROP TABLE IF EXISTS `applicants`;

CREATE TABLE `applicants` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `application_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `applicants` WRITE;
/*!40000 ALTER TABLE `applicants` DISABLE KEYS */;

INSERT INTO `applicants` (`id`, `name`, `email`, `application_date`)
VALUES
	(1,'Bob','bob@bob.com','2024-01-01'),
	(2,'John Doe','john.doe1@example.com','2024-09-01'),
	(3,'Jane Smith','jane.smith2@example.com','2024-09-02'),
	(4,'Mike Johnson','mike.johnson3@example.com','2024-09-03'),
	(5,'Emily Davis','emily.davis4@example.com','2024-09-04'),
	(6,'William Brown','william.brown5@example.com','2024-09-05'),
	(7,'Olivia Taylor','olivia.taylor6@example.com','2024-09-06'),
	(8,'James Wilson','james.wilson7@example.com','2024-09-07'),
	(9,'Isabella Moore','isabella.moore8@example.com','2024-09-08'),
	(10,'Lucas Anderson','lucas.anderson9@example.com','2024-09-09'),
	(11,'Mia Thomas','mia.thomas10@example.com','2024-09-10'),
	(12,'Daniel Jackson','daniel.jackson11@example.com','2024-09-11'),
	(13,'Sophia White','sophia.white12@example.com','2024-09-12'),
	(14,'Matthew Harris','matthew.harris13@example.com','2024-09-13'),
	(15,'Charlotte Martin','charlotte.martin14@example.com','2024-09-14'),
	(16,'Elijah Lee','elijah.lee15@example.com','2024-09-15'),
	(17,'Amelia Walker','amelia.walker16@example.com','2024-09-16'),
	(18,'Logan Young','logan.young17@example.com','2024-09-17'),
	(19,'Harper Hernandez','harper.hernandez18@example.com','2024-09-18'),
	(20,'Aiden King','aiden.king19@example.com','2024-09-19'),
	(21,'Avery Wright','avery.wright20@example.com','2024-09-20'),
	(22,'Sebastian Scott','sebastian.scott21@example.com','2024-09-21'),
	(23,'Evelyn Green','evelyn.green22@example.com','2024-09-22'),
	(24,'Jack Adams','jack.adams23@example.com','2024-09-23'),
	(25,'Scarlett Baker','scarlett.baker24@example.com','2024-09-24'),
	(26,'Henry Gonzalez','henry.gonzalez25@example.com','2024-09-25'),
	(27,'Abigail Perez','abigail.perez26@example.com','2024-09-26'),
	(28,'Alexander Mitchell','alexander.mitchell27@example.com','2024-09-27'),
	(29,'Ella Roberts','ella.roberts28@example.com','2024-09-28'),
	(30,'Liam Carter','liam.carter29@example.com','2024-09-29'),
	(31,'Grace Phillips','grace.phillips30@example.com','2024-09-30'),
	(32,'Benjamin Clark','benjamin.clark31@example.com','2024-09-01'),
	(33,'Sofia Ramirez','sofia.ramirez32@example.com','2024-09-02'),
	(34,'Noah Lewis','noah.lewis33@example.com','2024-09-03'),
	(35,'Zoe Howard','zoe.howard34@example.com','2024-09-04'),
	(36,'Mason Hall','mason.hall35@example.com','2024-09-05'),
	(37,'Lily Ward','lily.ward36@example.com','2024-09-06'),
	(38,'Ethan Cox','ethan.cox37@example.com','2024-09-07'),
	(39,'Layla Diaz','layla.diaz38@example.com','2024-09-08'),
	(40,'Owen Brooks','owen.brooks39@example.com','2024-09-09'),
	(41,'Chloe Stewart','chloe.stewart40@example.com','2024-09-10'),
	(42,'Jacob Torres','jacob.torres41@example.com','2024-09-11'),
	(43,'Luna Flores','luna.flores42@example.com','2024-09-12'),
	(44,'Michael Sanders','michael.sanders43@example.com','2024-09-13'),
	(45,'Ella Price','ella.price44@example.com','2024-09-14'),
	(46,'Oliver Bell','oliver.bell45@example.com','2024-09-15'),
	(47,'Aubrey Russell','aubrey.russell46@example.com','2024-09-16'),
	(48,'Carter Edwards','carter.edwards47@example.com','2024-09-17'),
	(49,'Aria Hughes','aria.hughes48@example.com','2024-09-18'),
	(50,'Wyatt Hill','wyatt.hill49@example.com','2024-09-19'),
	(51,'Lily Scott','lily.scott50@example.com','2024-09-20');

/*!40000 ALTER TABLE `applicants` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table applications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `applications`;

CREATE TABLE `applications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) DEFAULT NULL,
  `why` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `diversitech` tinyint(1) DEFAULT NULL,
  `circumstance_id` int(11) DEFAULT NULL,
  `funding_id` int(11) DEFAULT NULL,
  `cohort_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `heard_about_id` int(11) DEFAULT NULL,
  `age_confirmation` tinyint(1) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `eligible` tinyint(1) DEFAULT NULL,
  `terms` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;

INSERT INTO `applications` (`id`, `applicant_id`, `why`, `experience`, `diversitech`, `circumstance_id`, `funding_id`, `cohort_id`, `dob`, `phone`, `address`, `heard_about_id`, `age_confirmation`, `newsletter`, `eligible`, `terms`)
VALUES
	(1,1,'Cus I like code','Never done it. Don\'t know what it is tbh',0,1,1,1,'1999-01-04','0123456789','123 test street',1,1,0,1,1);

/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table circumstances
# ------------------------------------------------------------

DROP TABLE IF EXISTS `circumstances`;

CREATE TABLE `circumstances` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `circumstances` WRITE;
/*!40000 ALTER TABLE `circumstances` DISABLE KEYS */;

INSERT INTO `circumstances` (`id`, `option`)
VALUES
	(1,'Changing careers'),
	(2,'Returning to work'),
	(3,'Recent university graduate'),
	(4,'Schol leaver');

/*!40000 ALTER TABLE `circumstances` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cohorts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cohorts`;

CREATE TABLE `cohorts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `cohorts` WRITE;
/*!40000 ALTER TABLE `cohorts` DISABLE KEYS */;

INSERT INTO `cohorts` (`id`, `date`, `course_id`)
VALUES
	(1,'2025-01-13',1),
	(2,'2025-03-10',1);

/*!40000 ALTER TABLE `cohorts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `short_name` varchar(5) DEFAULT NULL,
  `remote` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;

INSERT INTO `courses` (`id`, `name`, `short_name`, `remote`)
VALUES
	(1,'Full Stack Track','FST',0),
	(2,'Software Developer Essentials','SDE',1),
	(3,'Data Science Pathway','DSP',1),
	(4,'Coding Quick Start','CQS',1);

/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table funding_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `funding_options`;

CREATE TABLE `funding_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `funding_options` WRITE;
/*!40000 ALTER TABLE `funding_options` DISABLE KEYS */;

INSERT INTO `funding_options` (`id`, `option`)
VALUES
	(1,'Full up-front payment'),
	(2,'Split monthly payments'),
	(3,'0% interest deffered playment plan (StepEx)');

/*!40000 ALTER TABLE `funding_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table hear_about
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hear_about`;

CREATE TABLE `hear_about` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

LOCK TABLES `hear_about` WRITE;
/*!40000 ALTER TABLE `hear_about` DISABLE KEYS */;

INSERT INTO `hear_about` (`id`, `option`)
VALUES
	(1,'Google'),
	(2,'Word of mouth'),
	(3,'Course Report'),
	(4,'Social Media'),
	(5,'Other');

/*!40000 ALTER TABLE `hear_about` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(65) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `password`)
VALUES
	(1,'test@test.com','$2y$10$fWtYjzjVLKyCig.L1Gg4D.gi0E/soqW2nzDtER9P.3lbzItQMerk.');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
