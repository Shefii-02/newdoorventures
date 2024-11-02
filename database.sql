-- MySQL dump 10.13  Distrib 8.2.0, for macos14.0 (arm64)
--
-- Host: localhost    Database: hously
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'ip7LKQOjPHW70dSgunW6pGN08plZNCYP',1,'2024-01-23 20:02:19','2024-01-23 20:02:19','2024-01-23 20:02:19'),(2,2,'T5VIBFg13InPpAO1YBE1L5B6kkPaOSiE',1,'2024-01-23 20:02:20','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_histories`
--

DROP TABLE IF EXISTS `audit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `module` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_user` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_histories_user_id_index` (`user_id`),
  KEY `audit_histories_module_index` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_histories`
--

LOCK TABLES `audit_histories` WRITE;
/*!40000 ALTER TABLE `audit_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_status_index` (`status`),
  KEY `categories_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Design',0,'Five. \'I heard every word you fellows were saying.\' \'Tell us a story!\' said the Queen. \'I never could abide figures!\' And with that she ought not to her, though, as they all cheered. Alice thought.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'Lifestyle',0,'Dodo suddenly called out in a sulky tone, as it spoke. \'As wet as ever,\' said Alice as he spoke. \'UNimportant, of course, I meant,\' the King repeated angrily, \'or I\'ll have you got in your pocket?\'.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'Travel Tips',0,'Ugh, Serpent!\' \'But I\'m NOT a serpent, I tell you!\' said Alice. \'Nothing WHATEVER?\' persisted the King. On this the White Rabbit read:-- \'They told me he was gone, and the happy summer days. THE.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Healthy',0,'The Mouse only growled in reply. \'That\'s right!\' shouted the Queen, stamping on the second thing is to find her way into that lovely garden. First, however, she waited patiently. \'Once,\' said the.','published',2,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'Travel Tips',0,'ME.\' \'You!\' said the Hatter: \'as the things I used to say it over) \'--yes, that\'s about the games now.\' CHAPTER X. The Lobster Quadrille The Mock Turtle repeated thoughtfully. \'I should think very.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'Hotel',0,'Improve his shining tail, And pour the waters of the March Hare, who had got so much surprised, that for two Pennyworth only of beautiful Soup? Beau--ootiful Soo--oop! Soo--oop of the words all.','published',2,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(7,'Nature',0,'Mouse\'s tail; \'but why do you know what you mean,\' said Alice. \'I\'ve tried the roots of trees, and I\'ve tried banks, and I\'ve tried hedges,\' the Pigeon the opportunity of saying to herself how this.','published',2,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_translations`
--

DROP TABLE IF EXISTS `categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_translations`
--

LOCK TABLES `categories_translations` WRITE;
/*!40000 ALTER TABLE `categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `record_id` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Paris','paris',1,1,NULL,0,'cities/location-1.jpg',0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'London','london',2,2,NULL,0,'cities/location-2.jpg',0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'New York','new-york',3,3,NULL,0,'cities/location-3.jpg',0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Copenhagen','copenhagen',4,4,NULL,0,'cities/location-4.jpg',0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'Berlin','berlin',5,5,NULL,0,'cities/location-5.jpg',0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities_translations`
--

DROP TABLE IF EXISTS `cities_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cities_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`cities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities_translations`
--

LOCK TABLES `cities_translations` WRITE;
/*!40000 ALTER TABLE `cities_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_replies`
--

DROP TABLE IF EXISTS `contact_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_replies`
--

LOCK TABLES `contact_replies` WRITE;
/*!40000 ALTER TABLE `contact_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'France','French',0,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20','FRA'),(2,'England','English',0,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20','UK'),(3,'USA','Americans',0,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20','US'),(4,'Holland','Dutch',0,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20','HL'),(5,'Denmark','Danish',0,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20','DN'),(6,'Germany','Danish',0,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20','DN');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries_translations`
--

DROP TABLE IF EXISTS `countries_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countries_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`countries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries_translations`
--

LOCK TABLES `countries_translations` WRITE;
/*!40000 ALTER TABLE `countries_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widget_settings`
--

DROP TABLE IF EXISTS `dashboard_widget_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widget_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `widget_id` bigint unsigned NOT NULL,
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  KEY `dashboard_widget_settings_widget_id_index` (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widget_settings`
--

LOCK TABLES `dashboard_widget_settings` WRITE;
/*!40000 ALTER TABLE `dashboard_widget_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widget_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widgets`
--

DROP TABLE IF EXISTS `dashboard_widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widgets`
--

LOCK TABLES `dashboard_widgets` WRITE;
/*!40000 ALTER TABLE `dashboard_widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `faq_categories`
--

DROP TABLE IF EXISTS `faq_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories`
--

LOCK TABLES `faq_categories` WRITE;
/*!40000 ALTER TABLE `faq_categories` DISABLE KEYS */;
INSERT INTO `faq_categories` VALUES (1,'General',0,'published','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(2,'Buying',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(3,'Payment',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(4,'Support',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL);
/*!40000 ALTER TABLE `faq_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_categories_translations`
--

DROP TABLE IF EXISTS `faq_categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_categories_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`faq_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories_translations`
--

LOCK TABLES `faq_categories_translations` WRITE;
/*!40000 ALTER TABLE `faq_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq_categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Where does it come from?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(2,'How JobBox Work?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(3,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(4,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(5,'Why do we use it?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(6,'Where can I get some?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',1,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(7,'Where does it come from?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(8,'How JobBox Work?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(9,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(10,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(11,'Why do we use it?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(12,'Where can I get some?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',2,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(13,'Where does it come from?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(14,'How JobBox Work?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(15,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(16,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(17,'Why do we use it?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(18,'Where can I get some?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',3,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(19,'Where does it come from?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',4,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(20,'How JobBox Work?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',4,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(21,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',4,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(22,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',4,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(23,'Why do we use it?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',4,'published','2024-01-23 20:02:21','2024-01-23 20:02:21'),(24,'Where can I get some?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',4,'published','2024-01-23 20:02:21','2024-01-23 20:02:21');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs_translations`
--

DROP TABLE IF EXISTS `faqs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faqs_id` bigint unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`faqs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs_translations`
--

LOCK TABLES `faqs_translations` WRITE;
/*!40000 ALTER TABLE `faqs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `language_meta`
--

DROP TABLE IF EXISTS `language_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `language_meta` (
  `lang_meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_meta_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_meta_origin` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`lang_meta_id`),
  KEY `language_meta_reference_id_index` (`reference_id`),
  KEY `meta_code_index` (`lang_meta_code`),
  KEY `meta_origin_index` (`lang_meta_origin`),
  KEY `meta_reference_type_index` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_meta`
--

LOCK TABLES `language_meta` WRITE;
/*!40000 ALTER TABLE `language_meta` DISABLE KEYS */;
INSERT INTO `language_meta` VALUES (1,'en_US','79dba5e758579233bcaa77a0ceb0d43a',1,'Botble\\Menu\\Models\\MenuLocation'),(2,'en_US','74cf7e8190a366c5210412e58e0a01e8',1,'Botble\\Menu\\Models\\Menu'),(3,'en_US','5875a61f83df1e6dee17ab34188cc9c8',2,'Botble\\Menu\\Models\\Menu'),(4,'en_US','ef41d4ab2fec232e2d605ddb8310a020',3,'Botble\\Menu\\Models\\Menu');
/*!40000 ALTER TABLE `language_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `lang_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_flag` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `lang_order` int NOT NULL DEFAULT '0',
  `lang_is_rtl` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  KEY `lang_locale_index` (`lang_locale`),
  KEY `lang_code_index` (`lang_code`),
  KEY `lang_is_default_index` (`lang_is_default`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','en_US','us',1,0,0);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` bigint unsigned NOT NULL DEFAULT '0',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`),
  KEY `media_files_index` (`folder_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,0,'location-1','location-1',1,'image/jpeg',4881,'cities/location-1.jpg','[]','2024-01-23 20:02:20','2024-01-23 20:02:20',NULL),(2,0,'location-2','location-2',1,'image/jpeg',4881,'cities/location-2.jpg','[]','2024-01-23 20:02:20','2024-01-23 20:02:20',NULL),(3,0,'location-3','location-3',1,'image/jpeg',4881,'cities/location-3.jpg','[]','2024-01-23 20:02:20','2024-01-23 20:02:20',NULL),(4,0,'location-4','location-4',1,'image/jpeg',4881,'cities/location-4.jpg','[]','2024-01-23 20:02:20','2024-01-23 20:02:20',NULL),(5,0,'location-5','location-5',1,'image/jpeg',4881,'cities/location-5.jpg','[]','2024-01-23 20:02:20','2024-01-23 20:02:20',NULL),(6,0,'1','1',2,'image/jpeg',9730,'accounts/1.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(7,0,'10','10',2,'image/jpeg',9730,'accounts/10.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(8,0,'2','2',2,'image/jpeg',9730,'accounts/2.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(9,0,'3','3',2,'image/jpeg',9730,'accounts/3.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(10,0,'4','4',2,'image/jpeg',9730,'accounts/4.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(11,0,'5','5',2,'image/jpeg',9730,'accounts/5.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(12,0,'6','6',2,'image/jpeg',9730,'accounts/6.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(13,0,'7','7',2,'image/jpeg',9730,'accounts/7.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(14,0,'8','8',2,'image/jpeg',9730,'accounts/8.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(15,0,'9','9',2,'image/jpeg',9730,'accounts/9.jpg','[]','2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(16,0,'01','01',3,'image/jpeg',34111,'backgrounds/01.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(17,0,'02','02',3,'image/jpeg',34111,'backgrounds/02.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(18,0,'03','03',3,'image/jpeg',34111,'backgrounds/03.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(19,0,'04','04',3,'image/jpeg',34111,'backgrounds/04.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(20,0,'hero','hero',3,'image/jpeg',12672,'backgrounds/hero.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(21,0,'map','map',3,'image/png',25344,'backgrounds/map.png','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(22,0,'01','01',4,'image/jpeg',5306,'clients/01.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(23,0,'02','02',4,'image/jpeg',5306,'clients/02.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(24,0,'03','03',4,'image/jpeg',5306,'clients/03.jpg','[]','2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(25,0,'04','04',4,'image/jpeg',5306,'clients/04.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(26,0,'05','05',4,'image/jpeg',5306,'clients/05.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(27,0,'06','06',4,'image/jpeg',5306,'clients/06.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(28,0,'07','07',4,'image/jpeg',5306,'clients/07.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(29,0,'08','08',4,'image/jpeg',5306,'clients/08.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(30,0,'amazon','amazon',4,'image/png',1180,'clients/amazon.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(31,0,'google','google',4,'image/png',1180,'clients/google.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(32,0,'lenovo','lenovo',4,'image/png',1180,'clients/lenovo.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(33,0,'paypal','paypal',4,'image/png',1180,'clients/paypal.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(34,0,'shopify','shopify',4,'image/png',1180,'clients/shopify.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(35,0,'spotify','spotify',4,'image/png',1180,'clients/spotify.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(36,0,'about','about',5,'image/jpeg',11053,'general/about.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(37,0,'error','error',5,'image/png',7124,'general/error.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(38,0,'favicon','favicon',5,'image/png',6145,'general/favicon.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(39,0,'logo-authentication-page','logo-authentication-page',5,'image/png',2683,'general/logo-authentication-page.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(40,0,'logo-dark','logo-dark',5,'image/png',2597,'general/logo-dark.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(41,0,'logo-light','logo-light',5,'image/png',2626,'general/logo-light.png','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(42,0,'1','1',6,'image/jpeg',9730,'properties/1.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(43,0,'10','10',6,'image/jpeg',9730,'properties/10.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(44,0,'11','11',6,'image/jpeg',9730,'properties/11.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(45,0,'12','12',6,'image/jpeg',9730,'properties/12.jpg','[]','2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(46,0,'2','2',6,'image/jpeg',9730,'properties/2.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(47,0,'3','3',6,'image/jpeg',9730,'properties/3.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(48,0,'4','4',6,'image/jpeg',9730,'properties/4.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(49,0,'5','5',6,'image/jpeg',9730,'properties/5.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(50,0,'6','6',6,'image/jpeg',9730,'properties/6.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(51,0,'7','7',6,'image/jpeg',9730,'properties/7.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(52,0,'8','8',6,'image/jpeg',9730,'properties/8.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(53,0,'9','9',6,'image/jpeg',9730,'properties/9.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(54,0,'1-1','1-1',6,'image/jpeg',9730,'properties/1-1.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(55,0,'2-1','2-1',6,'image/jpeg',9730,'properties/2-1.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(56,0,'3-1','3-1',6,'image/jpeg',9730,'properties/3-1.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(57,0,'4-1','4-1',6,'image/jpeg',9730,'properties/4-1.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(58,0,'5-1','5-1',6,'image/jpeg',9730,'properties/5-1.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(59,0,'1','1',7,'image/jpeg',9730,'news/1.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(60,0,'10','10',7,'image/jpeg',9730,'news/10.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(61,0,'11','11',7,'image/jpeg',9730,'news/11.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(62,0,'12','12',7,'image/jpeg',9730,'news/12.jpg','[]','2024-01-23 20:02:31','2024-01-23 20:02:31',NULL),(63,0,'13','13',7,'image/jpeg',9730,'news/13.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(64,0,'14','14',7,'image/jpeg',9730,'news/14.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(65,0,'15','15',7,'image/jpeg',9730,'news/15.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(66,0,'16','16',7,'image/jpeg',9730,'news/16.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(67,0,'2','2',7,'image/jpeg',9730,'news/2.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(68,0,'3','3',7,'image/jpeg',9730,'news/3.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(69,0,'4','4',7,'image/jpeg',9730,'news/4.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(70,0,'5','5',7,'image/jpeg',9730,'news/5.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(71,0,'6','6',7,'image/jpeg',9730,'news/6.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(72,0,'7','7',7,'image/jpeg',9730,'news/7.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(73,0,'8','8',7,'image/jpeg',9730,'news/8.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL),(74,0,'9','9',7,'image/jpeg',9730,'news/9.jpg','[]','2024-01-23 20:02:32','2024-01-23 20:02:32',NULL);
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_folders`
--

DROP TABLE IF EXISTS `media_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`),
  KEY `media_folders_index` (`parent_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_folders`
--

LOCK TABLES `media_folders` WRITE;
/*!40000 ALTER TABLE `media_folders` DISABLE KEYS */;
INSERT INTO `media_folders` VALUES (1,0,'cities',NULL,'cities',0,'2024-01-23 20:02:20','2024-01-23 20:02:20',NULL),(2,0,'accounts',NULL,'accounts',0,'2024-01-23 20:02:21','2024-01-23 20:02:21',NULL),(3,0,'backgrounds',NULL,'backgrounds',0,'2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(4,0,'clients',NULL,'clients',0,'2024-01-23 20:02:29','2024-01-23 20:02:29',NULL),(5,0,'general',NULL,'general',0,'2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(6,0,'properties',NULL,'properties',0,'2024-01-23 20:02:30','2024-01-23 20:02:30',NULL),(7,0,'news',NULL,'news',0,'2024-01-23 20:02:31','2024-01-23 20:02:31',NULL);
/*!40000 ALTER TABLE `media_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_settings`
--

DROP TABLE IF EXISTS `media_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `media_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_settings`
--

LOCK TABLES `media_settings` WRITE;
/*!40000 ALTER TABLE `media_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_locations`
--

DROP TABLE IF EXISTS `menu_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `location` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_locations_menu_id_created_at_index` (`menu_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_locations`
--

LOCK TABLES `menu_locations` WRITE;
/*!40000 ALTER TABLE `menu_locations` DISABLE KEYS */;
INSERT INTO `menu_locations` VALUES (1,1,'main-menu','2024-01-23 20:02:28','2024-01-23 20:02:28');
/*!40000 ALTER TABLE `menu_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_nodes`
--

DROP TABLE IF EXISTS `menu_nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_nodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `reference_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `has_child` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_nodes_menu_id_index` (`menu_id`),
  KEY `menu_nodes_parent_id_index` (`parent_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_type` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_nodes`
--

LOCK TABLES `menu_nodes` WRITE;
/*!40000 ALTER TABLE `menu_nodes` DISABLE KEYS */;
INSERT INTO `menu_nodes` VALUES (1,1,0,NULL,NULL,NULL,NULL,0,'Home',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(2,1,1,1,'Botble\\Page\\Models\\Page','/home-one',NULL,0,'Home One',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(3,1,1,2,'Botble\\Page\\Models\\Page','/home-two',NULL,0,'Home Two',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(4,1,1,3,'Botble\\Page\\Models\\Page','/home-three',NULL,0,'Home Three',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(5,1,1,4,'Botble\\Page\\Models\\Page','/home-four',NULL,0,'Home Four',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(6,1,0,NULL,NULL,'/projects',NULL,0,'Projects',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(7,1,6,5,'Botble\\Page\\Models\\Page','/projects',NULL,0,'Projects List',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(8,1,6,NULL,NULL,'/projects/walnut-park-apartments',NULL,0,'Project Detail',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(9,1,0,6,'Botble\\Page\\Models\\Page','/properties',NULL,0,'Properties',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(10,1,9,6,'Botble\\Page\\Models\\Page','/properties',NULL,0,'Properties List',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(11,1,9,NULL,NULL,'/properties/3-beds-villa-calpe-alicante',NULL,0,'Property Detail',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(12,1,0,NULL,NULL,'/page',NULL,0,'Page',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(13,1,12,NULL,NULL,'/agents',NULL,0,'Agents',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(14,1,12,16,'Botble\\Page\\Models\\Page','/wishlist',NULL,0,'Wishlist',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(15,1,12,7,'Botble\\Page\\Models\\Page','/about-us',NULL,0,'About Us',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(16,1,12,8,'Botble\\Page\\Models\\Page','/features',NULL,0,'Features',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(17,1,12,9,'Botble\\Page\\Models\\Page','/pricing-plans',NULL,0,'Pricing',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(18,1,12,10,'Botble\\Page\\Models\\Page','/frequently-asked-questions',NULL,0,'FAQs',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(19,1,12,15,'Botble\\Page\\Models\\Page','/contact',NULL,0,'Contact',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(20,1,12,NULL,NULL,'/auth-pages',NULL,0,'Auth Pages',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(21,1,20,NULL,NULL,'/login',NULL,0,'Login',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(22,1,20,NULL,NULL,'/register',NULL,0,'Signup',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(23,1,20,NULL,NULL,'/password/request',NULL,0,'Reset Password',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(24,1,12,NULL,NULL,'/utility',NULL,0,'Utility',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(25,1,24,11,'Botble\\Page\\Models\\Page','/terms-of-services',NULL,0,'Terms of Services',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(26,1,24,12,'Botble\\Page\\Models\\Page','/privacy-policy',NULL,0,'Privacy Policy',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(27,1,12,NULL,NULL,'/special',NULL,0,'Special',NULL,'_self',1,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(28,1,27,13,'Botble\\Page\\Models\\Page','/coming-soon',NULL,0,'Coming soon',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(29,1,27,NULL,NULL,'/404',NULL,0,'404 Error',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(30,2,0,7,'Botble\\Page\\Models\\Page','/about-us',NULL,0,'About Us',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29'),(31,2,0,NULL,NULL,'#',NULL,0,'Services',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(32,2,0,9,'Botble\\Page\\Models\\Page','/pricing-plans',NULL,0,'Pricing',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29'),(33,2,0,14,'Botble\\Page\\Models\\Page','/news',NULL,0,'News',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29'),(34,2,0,NULL,NULL,'/login',NULL,0,'Login',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:28'),(35,3,0,11,'Botble\\Page\\Models\\Page','/terms-of-services',NULL,0,'Terms of Services',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29'),(36,3,0,12,'Botble\\Page\\Models\\Page','/privacy-policy',NULL,0,'Privacy Policy',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29'),(37,3,0,6,'Botble\\Page\\Models\\Page','/properties',NULL,0,'Listing',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29'),(38,3,0,14,'Botble\\Page\\Models\\Page','/news',NULL,0,'Contact',NULL,'_self',0,'2024-01-23 20:02:28','2024-01-23 20:02:29');
/*!40000 ALTER TABLE `menu_nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main menu','main-menu','published','2024-01-23 20:02:28','2024-01-23 20:02:28'),(2,'Company','company','published','2024-01-23 20:02:28','2024-01-23 20:02:28'),(3,'Useful Links','useful-links','published','2024-01-23 20:02:28','2024-01-23 20:02:28');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_boxes`
--

DROP TABLE IF EXISTS `meta_boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_boxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_boxes`
--

LOCK TABLES `meta_boxes` WRITE;
/*!40000 ALTER TABLE `meta_boxes` DISABLE KEYS */;
INSERT INTO `meta_boxes` VALUES (1,'navbar_style','[\"dark\"]',1,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'navbar_style','[\"light\"]',2,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'navbar_style','[\"dark\"]',3,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'navbar_style','[\"dark\"]',4,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'navbar_style','[\"light\"]',5,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'navbar_style','[\"light\"]',6,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(7,'navbar_style','[\"light\"]',7,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(8,'navbar_style','[\"light\"]',8,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(9,'navbar_style','[\"light\"]',9,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(10,'navbar_style','[\"light\"]',10,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(11,'navbar_style','[\"light\"]',16,'Botble\\Page\\Models\\Page','2024-01-23 20:02:20','2024-01-23 20:02:20'),(12,'social_facebook','[\"facebook.com\"]',2,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(13,'social_instagram','[\"instagram.com\"]',2,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(14,'social_linkedin','[\"linkedin.com\"]',2,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(15,'social_facebook','[\"facebook.com\"]',3,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(16,'social_instagram','[\"instagram.com\"]',3,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(17,'social_linkedin','[\"linkedin.com\"]',3,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(18,'social_facebook','[\"facebook.com\"]',4,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(19,'social_instagram','[\"instagram.com\"]',4,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(20,'social_linkedin','[\"linkedin.com\"]',4,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:22','2024-01-23 20:02:22'),(21,'social_facebook','[\"facebook.com\"]',5,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(22,'social_instagram','[\"instagram.com\"]',5,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(23,'social_linkedin','[\"linkedin.com\"]',5,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(24,'social_facebook','[\"facebook.com\"]',6,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(25,'social_instagram','[\"instagram.com\"]',6,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(26,'social_linkedin','[\"linkedin.com\"]',6,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(27,'social_facebook','[\"facebook.com\"]',7,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(28,'social_instagram','[\"instagram.com\"]',7,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(29,'social_linkedin','[\"linkedin.com\"]',7,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(30,'social_facebook','[\"facebook.com\"]',8,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(31,'social_instagram','[\"instagram.com\"]',8,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(32,'social_linkedin','[\"linkedin.com\"]',8,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:23','2024-01-23 20:02:23'),(33,'social_facebook','[\"facebook.com\"]',9,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(34,'social_instagram','[\"instagram.com\"]',9,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(35,'social_linkedin','[\"linkedin.com\"]',9,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(36,'social_facebook','[\"facebook.com\"]',10,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(37,'social_instagram','[\"instagram.com\"]',10,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(38,'social_linkedin','[\"linkedin.com\"]',10,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(39,'social_facebook','[\"facebook.com\"]',11,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(40,'social_instagram','[\"instagram.com\"]',11,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(41,'social_linkedin','[\"linkedin.com\"]',11,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(42,'social_facebook','[\"facebook.com\"]',12,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(43,'social_instagram','[\"instagram.com\"]',12,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(44,'social_linkedin','[\"linkedin.com\"]',12,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:24','2024-01-23 20:02:24'),(45,'social_facebook','[\"facebook.com\"]',13,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(46,'social_instagram','[\"instagram.com\"]',13,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(47,'social_linkedin','[\"linkedin.com\"]',13,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(48,'social_facebook','[\"facebook.com\"]',14,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(49,'social_instagram','[\"instagram.com\"]',14,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(50,'social_linkedin','[\"linkedin.com\"]',14,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(51,'social_facebook','[\"facebook.com\"]',15,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(52,'social_instagram','[\"instagram.com\"]',15,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(53,'social_linkedin','[\"linkedin.com\"]',15,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:25','2024-01-23 20:02:25'),(54,'social_facebook','[\"facebook.com\"]',16,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(55,'social_instagram','[\"instagram.com\"]',16,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(56,'social_linkedin','[\"linkedin.com\"]',16,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(57,'social_facebook','[\"facebook.com\"]',17,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(58,'social_instagram','[\"instagram.com\"]',17,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(59,'social_linkedin','[\"linkedin.com\"]',17,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(60,'social_facebook','[\"facebook.com\"]',18,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(61,'social_instagram','[\"instagram.com\"]',18,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(62,'social_linkedin','[\"linkedin.com\"]',18,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(63,'social_facebook','[\"facebook.com\"]',19,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(64,'social_instagram','[\"instagram.com\"]',19,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(65,'social_linkedin','[\"linkedin.com\"]',19,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:26','2024-01-23 20:02:26'),(66,'social_facebook','[\"facebook.com\"]',20,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:27','2024-01-23 20:02:27'),(67,'social_instagram','[\"instagram.com\"]',20,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:27','2024-01-23 20:02:27'),(68,'social_linkedin','[\"linkedin.com\"]',20,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:27','2024-01-23 20:02:27'),(69,'social_facebook','[\"facebook.com\"]',21,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:27','2024-01-23 20:02:27'),(70,'social_instagram','[\"instagram.com\"]',21,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:27','2024-01-23 20:02:27'),(71,'social_linkedin','[\"linkedin.com\"]',21,'Botble\\RealEstate\\Models\\Account','2024-01-23 20:02:27','2024-01-23 20:02:27');
/*!40000 ALTER TABLE `meta_boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_04_09_032329_create_base_tables',1),(2,'2013_04_09_062329_create_revisions_table',1),(3,'2014_10_12_000000_create_users_table',1),(4,'2014_10_12_100000_create_password_reset_tokens_table',1),(5,'2016_06_10_230148_create_acl_tables',1),(6,'2016_06_14_230857_create_menus_table',1),(7,'2016_06_28_221418_create_pages_table',1),(8,'2016_10_05_074239_create_setting_table',1),(9,'2016_11_28_032840_create_dashboard_widget_tables',1),(10,'2016_12_16_084601_create_widgets_table',1),(11,'2017_05_09_070343_create_media_tables',1),(12,'2017_11_03_070450_create_slug_table',1),(13,'2019_01_05_053554_create_jobs_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_12_14_000001_create_personal_access_tokens_table',1),(16,'2021_08_05_134214_fix_social_link_theme_options',1),(17,'2022_04_20_100851_add_index_to_media_table',1),(18,'2022_04_20_101046_add_index_to_menu_table',1),(19,'2022_07_10_034813_move_lang_folder_to_root',1),(20,'2022_08_04_051940_add_missing_column_expires_at',1),(21,'2022_09_01_000001_create_admin_notifications_tables',1),(22,'2022_10_14_024629_drop_column_is_featured',1),(23,'2022_11_18_063357_add_missing_timestamp_in_table_settings',1),(24,'2022_12_02_093615_update_slug_index_columns',1),(25,'2023_01_30_024431_add_alt_to_media_table',1),(26,'2023_02_16_042611_drop_table_password_resets',1),(27,'2023_04_23_005903_add_column_permissions_to_admin_notifications',1),(28,'2023_05_10_075124_drop_column_id_in_role_users_table',1),(29,'2023_07_18_040500_convert_cities_is_featured_to_selecting_locations_from_shortcode',1),(30,'2023_07_25_032204_update_search_tabs_hero_banner_shortcode',1),(31,'2023_08_21_090810_make_page_content_nullable',1),(32,'2023_09_14_021936_update_index_for_slugs_table',1),(33,'2023_12_06_100448_change_random_hash_for_media',1),(34,'2023_12_07_095130_add_color_column_to_media_folders_table',1),(35,'2023_12_17_162208_make_sure_column_color_in_media_folders_nullable',1),(36,'2023_12_20_034718_update_invoice_amount',1),(37,'2015_06_29_025744_create_audit_history',2),(38,'2023_11_14_033417_change_request_column_in_table_audit_histories',2),(39,'2015_06_18_033822_create_blog_table',3),(40,'2021_02_16_092633_remove_default_value_for_author_type',3),(41,'2021_12_03_030600_create_blog_translations',3),(42,'2022_04_19_113923_add_index_to_table_posts',3),(43,'2023_08_29_074620_make_column_author_id_nullable',3),(44,'2016_06_17_091537_create_contacts_table',4),(45,'2023_11_10_080225_migrate_contact_blacklist_email_domains_to_core',4),(46,'2018_07_09_221238_create_faq_table',5),(47,'2021_12_03_082134_create_faq_translations',5),(48,'2023_11_17_063408_add_description_column_to_faq_categories_table',5),(49,'2016_10_03_032336_create_languages_table',6),(50,'2023_09_14_022423_add_index_for_language_table',6),(51,'2021_10_25_021023_fix-priority-load-for-language-advanced',7),(52,'2021_12_03_075608_create_page_translations',7),(53,'2023_07_06_011444_create_slug_translations_table',7),(54,'2019_11_18_061011_create_country_table',8),(55,'2021_12_03_084118_create_location_translations',8),(56,'2021_12_03_094518_migrate_old_location_data',8),(57,'2021_12_10_034440_switch_plugin_location_to_use_language_advanced',8),(58,'2022_01_16_085908_improve_plugin_location',8),(59,'2022_08_04_052122_delete_location_backup_tables',8),(60,'2023_04_23_061847_increase_state_translations_abbreviation_column',8),(61,'2023_07_26_041451_add_more_columns_to_location_table',8),(62,'2023_07_27_041451_add_more_columns_to_location_translation_table',8),(63,'2023_08_15_073307_drop_unique_in_states_cities_translations',8),(64,'2023_10_21_065016_make_state_id_in_table_cities_nullable',8),(65,'2017_10_24_154832_create_newsletter_table',9),(66,'2017_05_18_080441_create_payment_tables',10),(67,'2021_03_27_144913_add_customer_type_into_table_payments',10),(68,'2021_05_24_034720_make_column_currency_nullable',10),(69,'2021_08_09_161302_add_metadata_column_to_payments_table',10),(70,'2021_10_19_020859_update_metadata_field',10),(71,'2022_06_28_151901_activate_paypal_stripe_plugin',10),(72,'2022_07_07_153354_update_charge_id_in_table_payments',10),(73,'2018_06_22_032304_create_real_estate_table',11),(74,'2021_02_11_031126_update_price_column_in_projects_and_properties',11),(75,'2021_03_08_024049_add_lat_long_into_real_estate_tables',11),(76,'2021_06_10_091950_add_column_is_featured_to_table_re_accounts',11),(77,'2021_07_07_021757_update_table_account_activity_logs',11),(78,'2021_09_29_042758_create_re_categories_multilevel_table',11),(79,'2021_10_31_031254_add_company_to_accounts_table',11),(80,'2021_12_10_034807_create_real_estate_translation_tables',11),(81,'2021_12_18_081636_add_property_project_views_count',11),(82,'2022_05_04_033044_update_column_images_in_real_estate_tables',11),(83,'2022_07_02_081723_fix_expired_date_column',11),(84,'2022_08_01_090213_update_table_properties_and_projects',11),(85,'2023_01_31_023233_create_re_custom_fields_table',11),(86,'2023_02_06_000000_add_location_to_re_accounts_table',11),(87,'2023_02_06_024257_add_package_translations',11),(88,'2023_02_08_062457_add_custom_fields_translation_table',11),(89,'2023_02_15_024644_create_re_reviews_table',11),(90,'2023_02_20_072604_create_re_invoices_table',11),(91,'2023_02_20_081251_create_re_account_packages_table',11),(92,'2023_04_04_030709_add_unique_id_to_properties_and_projects_table',11),(93,'2023_04_14_164811_make_phone_and_email_in_table_re_consults_nullable',11),(94,'2023_05_09_062031_unique_reviews_table',11),(95,'2023_05_26_034353_fix_properties_projects_image',11),(96,'2023_05_27_004215_add_column_ip_into_table_re_consults',11),(97,'2023_07_25_034513_create_re_coupons_table',11),(98,'2023_07_25_034672_add_coupon_code_column_to_jb_invoices_table',11),(99,'2023_08_02_074208_change_square_column_to_float',11),(100,'2023_08_07_000001_add_is_public_profile_column_to_re_accounts_table',11),(101,'2023_08_09_004607_make_column_project_id_nullable',11),(102,'2023_09_11_084630_update_mandatory_fields_in_consult_form_table',11),(103,'2023_11_21_071820_add_missing_slug_for_agents',11),(104,'2024_01_11_084816_add_investor_translations_table',11),(105,'2018_07_09_214610_create_testimonial_table',12),(106,'2021_12_03_083642_create_testimonials_translations',12),(107,'2016_10_07_193005_create_translations_table',13),(108,'2023_12_12_105220_drop_translations_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'subscribed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Home One','<div>[hero-banner style=&quot;1&quot; title=&quot;We will help you find &lt;br&gt; your Wonderful home&quot; title_highlight=&quot;Wonderful&quot; subtitle=&quot;A great platform to buy, sell and rent your properties without any agent or commissions.&quot; background_images=&quot;backgrounds/01.jpg,backgrounds/02.jpg,backgrounds/03.jpg,backgrounds/04.jpg&quot; enabled_search_box=&quot;1&quot; search_tabs=&quot;projects,sale,rent&quot; search_type=&quot;properties&quot;][/hero-banner]</div><div>[intro-about-us title=\"Efficiency. Transparency. Control.\" description=\"Hously developed a platform for the Real Estate marketplace that allows buyers and sellers to easily execute a transaction on their own. The platform drives efficiency, cost transparency and control into the hands of the consumers. Hously is Real Estate Redefined.\" text_button_action=\"Learn More\" url_button_action=\"#\" image=\"general/about.jpg\" youtube_video_url=\"https://www.youtube.com/watch?v=y9j-BL5ocW8\"][/intro-about-us]</div><div>[how-it-works title=\"How It Works\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" icon_1=\"mdi mdi-home-outline\" title_1=\"Evaluate Property\" description_1=\"If the distribution of letters and \'words\' is random, the reader will not be distracted from making.\" icon_2=\"mdi mdi-bag-personal-outline\" title_2=\"Meeting with Agent\" description_2=\"If the distribution of letters and \'words\' is random, the reader will not be distracted from making.\" icon_3=\"mdi mdi-key-outline\" title_3=\"Close the Deal\" description_3=\"If the distribution of letters and \'words\' is random, the reader will not be distracted from making.\"][/how-it-works]</div><div>[properties-by-locations title=\"Find your inspiration with Hously\" title_highlight_text=\"inspiration with\" subtitle=\"Properties By Location and Country\" city=\"1,2,3,4,5,6\"][/properties-by-locations]</div><div>[featured-projects title=\"Featured Projects\" subtitle=\"We make the best choices with the hottest and most prestigious projects, please visit the details below to find out more.\" limit=\"6\"][/featured-projects]</div><div>[featured-properties title=\"Featured Properties\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\"][/featured-properties]</div><div>[recently-viewed-properties title=\"Recently Viewed Properties\" subtitle=\"Your currently viewed properties.\" limit=\"3\"][/recently-viewed-properties]</div><div>[testimonials title=\"What Our Client Say?\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\"][/testimonials]</div><div>[featured-agents title=\"Featured Agents\" subtitle=\"Below is the featured agent.\" limit=\"6\"][/featured-agents]</div><div>[featured-posts title=\"Latest News\" subtitle=\"Below is the latest real estate news we get regularly updated from reliable sources.\" limit=\"3\"][/featured-posts]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'Home Two','<div>[hero-banner style=&quot;2&quot; title=&quot;Easy way to find your &lt;br&gt; dream property&quot; title_highlight=&quot;Wonderful&quot; subtitle=&quot;A great platform to buy, sell and rent your properties without any agent or commissions.&quot; background_images=&quot;backgrounds/01.jpg,backgrounds/02.jpg,backgrounds/03.jpg,backgrounds/04.jpg&quot; enabled_search_box=&quot;1&quot; search_tabs=&quot;projects,sale,rent&quot; search_type=&quot;properties&quot;][/hero-banner]</div><div>[intro-about-us title=\"Efficiency. Transparency. Control.\" description=\"Hously developed a platform for the Real Estate marketplace that allows buyers and sellers to easily execute a transaction on their own. The platform drives efficiency, cost transparency and control into the hands of the consumers. Hously is Real Estate Redefined.\" text_button_action=\"Learn More\" url_button_action=\"#\" image=\"general/about.jpg\" youtube_video_url=\"https://www.youtube.com/watch?v=y9j-BL5ocW8\"][/intro-about-us]</div><div>[how-it-works title=\"How It Works\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" icon_1=\"mdi mdi-home-outline\" title_1=\"Evaluate Property\" description_1=\"If the distribution of letters and \'words\' is random, the reader will not be distracted from making.\" icon_2=\"mdi mdi-bag-personal-outline\" title_2=\"Meeting with Agent\" description_2=\"If the distribution of letters and \'words\' is random, the reader will not be distracted from making.\" icon_3=\"mdi mdi-key-outline\" title_3=\"Close the Deal\" description_3=\"If the distribution of letters and \'words\' is random, the reader will not be distracted from making.\"][/how-it-works]</div><div>[properties-by-locations title=\"Find your inspiration with Hously\" title_highlight_text=\"inspiration with\" subtitle=\"Properties By Location and Country\" city=\"1,2,3,4,5,6\"][/properties-by-locations]</div><div>[featured-projects title=\"Featured Projects\" subtitle=\"We make the best choices with the hottest and most prestigious projects, please visit the details below to find out more.\" limit=\"6\"][/featured-projects]</div><div>[featured-properties title=\"Featured Properties\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\"][/featured-properties]</div><div>[recently-viewed-properties title=\"Recently Viewed Properties\" subtitle=\"Your currently viewed properties.\" limit=\"3\"][/recently-viewed-properties]</div><div>[business-partners name_1=\"Amazon\" url_1=\"https://www.amazon.com\" logo_1=\"clients/amazon.png\" name_2=\"Google\" url_2=\"https://google.com\" logo_2=\"clients/google.png\" name_3=\"Lenovo\" url_3=\"https://www.lenovo.com\" logo_3=\"clients/lenovo.png\" name_4=\"Paypal\" url_4=\"https://paypal.com\" logo_4=\"clients/paypal.png\" name_5=\"Shopify\" url_5=\"https://shopify.com\" logo_5=\"clients/shopify.png\" name_6=\"Spotify\" url_6=\"https://spotify.com\" logo_6=\"clients/spotify.png\"][/business-partners]</div><div>[testimonials title=\"What Our Client Say?\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\"][/testimonials]</div><div>[featured-agents title=\"Featured Agents\" subtitle=\"Below is the featured agent.\" limit=\"6\"][/featured-agents]</div><div>[featured-posts title=\"Latest News\" subtitle=\"Below is the latest real estate news we get regularly updated from reliable sources.\" limit=\"3\"][/featured-posts]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'Home Three','<div>[featured-properties-on-map search_tabs=\"sale,projects,rent\"][/featured-properties-on-map]</div><div>[featured-properties title=\"Featured Properties\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"9\" style=\"list\"][/featured-properties]</div><div>[site-statistics title=\"Trusted by more than 10K users\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" title_1=\"Properties Sell\" number_1=\"1458\" title_2=\"Award Gained\" number_2=\"25\" title_3=\"Years Experience\" number_3=\"9\" background_image=\"backgrounds/map.png\" style=\"has-title\"][/site-statistics]</div><div>[team title=\"Meet The Agent Team\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" weather=\"sunny\" account_ids=\"3,5,6,10\"][/team]</div><div>[testimonials title=\"What Our Client Say?\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\" style=\"style-2\"][/testimonials]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Home Four','<div>[hero-banner style=\"4\" title=\"Find Your Perfect & Wonderful Home\" title_highlight=\"Perfect & Wonderful\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" background_images=\"backgrounds/hero.jpg\" youtube_video_url=\"https://youtu.be/yba7hPeTSjk\" enabled_search_box=\"1\" search_tabs=\"projects,sale,rent\" search_type=\"properties\"][/hero-banner]</div><div>[intro-about-us title=\"Efficiency. Transparency. Control.\" description=\"Hously developed a platform for the Real Estate marketplace that allows buyers and sellers to easily execute a transaction on their own. The platform drives efficiency, cost transparency and control into the hands of the consumers. Hously is Real Estate Redefined.\" text_button_action=\"Learn More\" url_button_action=\"#\" image=\"general/about.jpg\" youtube_video_url=\"https://youtu.be/yba7hPeTSjk\"][/intro-about-us]</div><div>[how-it-works title=\"How It Works\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" icon_1=\"mdi mdi-home-outline\" title_1=\"Evaluate Property\" description_1=\"If the distribution of letters and is random, the reader will not be distracted from making.\" icon_2=\"mdi mdi-bag-personal-outline\" title_2=\"Meeting with Agent\" description_2=\"If the distribution of letters and is random, the reader will not be distracted from making.\" icon_3=\"mdi mdi-key-outline\" title_3=\"Close the Deal\" description_3=\"If the distribution of letters and is random, the reader will not be distracted from making.\"][/how-it-works]</div><div>[featured-projects title=\"Featured Projects\" subtitle=\"We make the best choices with the hottest and most prestigious projects, please visit the details below to find out more.\" limit=\"6\"][/featured-projects]</div><div>[featured-properties limit=\"9\"][/featured-properties]</div><div>[recently-viewed-properties title=\"Recently Viewed Properties\" subtitle=\"Your currently viewed properties.\" limit=\"3\"][/recently-viewed-properties]</div><div>[testimonials title=\"What Our Client Say?\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\"][/testimonials]</div><div>[featured-agents title=\"Featured Agents\" subtitle=\"Below is the featured agent.\" limit=\"6\"][/featured-agents]</div><div>[featured-posts title=\"Latest News\" subtitle=\"Below is the latest real estate news we get regularly updated from reliable sources.\" limit=\"3\"][/featured-posts]</div><div>[get-in-touch title=\"Have Question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"#\"][/get-in-touch]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'Projects','<div>[hero-banner style=\"default\" title=\"Projects\" subtitle=\"Each place is a good choice, it will help you make the right decision, do not miss the opportunity to discover our wonderful properties.\" background_images=\"backgrounds/01.jpg\" enabled_search_box=\"1\" search_tabs=\"projects,sale,rent\" search_type=\"projects\"][/hero-banner]</div><div>[projects-list number_of_projects_per_page=\"12\"][/projects-list]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'Properties','<div>[hero-banner style=\"default\" title=\"Properties\" subtitle=\"Each place is a good choice, it will help you make the right decision, do not miss the opportunity to discover our wonderful properties.\" background_images=\"backgrounds/01.jpg\" enabled_search_box=\"1\" search_tabs=\"projects,sale,rent\" search_type=\"properties\"][/hero-banner]</div><div>[properties-list number_of_properties_per_page=\"12\"][/properties-list]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(7,'About Us','<div>[intro-about-us title=\"Efficiency. Transparency. Control.\" description=\"Hously developed a platform for the Real Estate marketplace that allows buyers and sellers to easily execute a transaction on their own. The platform drives efficiency, cost transparency and control into the hands of the consumers. Hously is Real Estate Redefined.\" text_button_action=\"Learn More\" url_button_action=\"#\" image=\"general/about.jpg\" youtube_video_url=\"https://www.youtube.com/watch?v=y9j-BL5ocW8\"][/intro-about-us]</div><div>[how-it-works title=\"How It Works\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" icon_1=\"mdi mdi-home-outline\" title_1=\"Evaluate Property\" description_1=\"If the distribution of letters and is random, the reader will not be distracted from making.\" icon_2=\"mdi mdi-bag-personal-outline\" title_2=\"Meeting with Agent\" description_2=\"If the distribution of letters and  is random, the reader will not be distracted from making.\" icon_3=\"mdi mdi-key-outline\" title_3=\"Close the Deal\" description_3=\"If the distribution of letters and  is random, the reader will not be distracted from making.\"][/how-it-works]</div><div>[site-statistics title_1=\"Properties Sell\" number_1=\"1548\" title_2=\"Award Gained\" number_2=\"25\" title_3=\"Years Experience\" number_3=\"9\" style=\"no-title\"][/site-statistics]</div><div>[team title=\"Meet The Agent Team\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" weather=\"sunny\" account_ids=\"3,5,6,10\"][/team]</div><div>[testimonials title=\"What Our Client Say?\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\" style=\"style-2\"][/testimonials]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'hero','Voluptas eligendi consectetur maiores porro corrupti ipsam qui maiores. Ut quas et et veniam numquam voluptates. Porro molestiae voluptas ipsa nemo.','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(8,'Features','<div>[feature-block icon_1=\"mdi mdi-cards-heart\" title_1=\"Comfortable\" url_1=\"#\" description_1=\"If the distribution of letters and  is random, the reader will not be distracted from making.\" icon_2=\"mdi mdi-shield-sun\" title_2=\"Extra Security\" url_2=\"#\" description_2=\"If the distribution of letters and  is random, the reader will not be distracted from making.\" icon_3=\"mdi mdi-star\" title_3=\"Luxury\" url_3=\"#\" description_3=\"If the distribution of letters and  is random, the reader will not be distracted from making.\" icon_4=\"mdi mdi-currency-usd\" title_4=\"Best Price\" url_4=\"#\" description_4=\"If the distribution of letters and  is random, the reader will not be distracted from making.\" icon_5=\"mdi mdi-map-marker\" title_5=\"Strategic Location\" url_5=\"#\" description_5=\"If the distribution of letters and  is random, the reader will not be distracted from making.\" icon_6=\"mdi mdi-chart-arc\" title_6=\"Efficient\" url_6=\"#\" description_6=\"If the distribution of letters and  is random, the reader will not be distracted from making.\"][/feature-block]</div><div>[testimonials title=\"What Our Client Say?\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" limit=\"6\"][/testimonials]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'hero','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(9,'Pricing Plans','<div>[pricing][/pricing]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact us\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'hero','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(10,'Frequently Asked Questions','<div>[faq][/faq]</div><div>[get-in-touch title=\"Have question? Get in touch!\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" button_label=\"Contact\" button_url=\"/contact\"][/get-in-touch]</div>',1,NULL,'hero','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(11,'Terms of Services','<h2>Overview:</h2>\n<p>It seems that only fragments of the original text remain in the Lorem Ipsum texts used today. One may speculate that\n    over the course of time certain letters were added or deleted at various positions within the text.</p>\n<p>In the 1960s, the text suddenly became known beyond the professional circle of typesetters and layout designers when\n    it was used for Letraset sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text\n    were subsequently included in DTP programmes such as PageMaker etc.</p>\n<p>There is now an abundance of readable dummy texts. These are usually used when a text is required purely to fill a\n    space. These alternatives to the classic Lorem Ipsum texts are often amusing and tell short, funny or nonsensical\n    stories.</p>\n<br>\n<h2>We use your information to:</h2>\n<ul>\n    <li>Digital Marketing Solutions for Tomorrow</li>\n    <li>Our Talented &amp; Experienced Marketing Agency</li>\n    <li>Create your own skin to match your brand</li>\n    <li>Digital Marketing Solutions for Tomorrow</li>\n    <li>Our Talented &amp; Experienced Marketing Agency</li>\n    <li>Create your own skin to match your brand</li>\n</ul>\n<br>\n<h2>Information Provided Voluntarily:</h2>\n<p>In the 1960s, the text suddenly became known beyond the professional circle of typesetters and layout designers when\n    it was used for Letraset sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text\n    were subsequently included in DTP programmes such as PageMaker etc.</p>\n',1,NULL,'article','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(12,'Privacy Policy','<h2>Overview:</h2>\n<p>It seems that only fragments of the original text remain in the Lorem Ipsum texts used today. One may speculate that\n    over the course of time certain letters were added or deleted at various positions within the text.</p>\n<p>In the 1960s, the text suddenly became known beyond the professional circle of typesetters and layout designers when\n    it was used for Letraset sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text\n    were subsequently included in DTP programmes such as PageMaker etc.</p>\n<p>There is now an abundance of readable dummy texts. These are usually used when a text is required purely to fill a\n    space. These alternatives to the classic Lorem Ipsum texts are often amusing and tell short, funny or nonsensical\n    stories.</p>\n<br>\n<h2>We use your information to:</h2>\n<ul>\n    <li>Digital Marketing Solutions for Tomorrow</li>\n    <li>Our Talented &amp; Experienced Marketing Agency</li>\n    <li>Create your own skin to match your brand</li>\n    <li>Digital Marketing Solutions for Tomorrow</li>\n    <li>Our Talented &amp; Experienced Marketing Agency</li>\n    <li>Create your own skin to match your brand</li>\n</ul>\n<br>\n<h2>Information Provided Voluntarily:</h2>\n<p>In the 1960s, the text suddenly became known beyond the professional circle of typesetters and layout designers when\n    it was used for Letraset sheets (adhesive letters on transparent film, popular until the 1980s) Versions of the text\n    were subsequently included in DTP programmes such as PageMaker etc.</p>\n',1,NULL,'article','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(13,'Coming soon','<div>[coming-soon title=\"We Are Coming Soon...\" subtitle=\"A great platform to buy, sell and rent your properties without any agent or commissions.\" time=\"2023-07-05\" enable_snow_effect=\"0,1\"][/coming-soon]</div>',1,NULL,'empty','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(14,'News',NULL,1,NULL,'hero','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(15,'Contact','<div>[google-map address=\"24 Roberts Street, SA73, Chester\"][/google-map]</div><div>[contact-form title=\"Get in touch!\"][/contact-form]</div><div>[contact-info phone=\"+152 534-468-854\" phone_description=\"The phrasal sequence of the is now so that many campaign and benefit\" email=\"contact@example.com\" email_description=\"The phrasal sequence of the is now so that many campaign and benefit\" address=\"C/54 Northwest Freeway, Suite 558, Houston, USA 485\" address_description=\"C/54 Northwest Freeway, Suite 558, Houston, USA 485\"][/contact-info]</div>',1,NULL,'default','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(16,'Wishlist','<div>[favorite-projects title=\"My Favorite Projects\"][/favorite-projects]</div><div>[favorite-properties title=\"My Favorite Projects\"][/favorite-properties]</div>',1,NULL,'hero','','published','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_translations`
--

DROP TABLE IF EXISTS `pages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`pages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_translations`
--

LOCK TABLES `pages_translations` WRITE;
/*!40000 ALTER TABLE `pages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currency` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_channel` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `order_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'confirm',
  `customer_id` bigint unsigned DEFAULT NULL,
  `refunded_amount` decimal(15,2) unsigned DEFAULT NULL,
  `refund_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `category_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_categories_category_id_index` (`category_id`),
  KEY `post_categories_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (3,1),(5,2),(5,3),(4,4),(4,5),(2,5),(7,5),(4,6),(1,6),(6,6),(5,7),(7,8),(6,8),(5,8),(7,9),(3,9),(7,10),(6,10),(3,11),(7,11),(2,11),(5,12),(6,13),(1,13),(3,13),(4,14),(5,14),(2,15),(6,16),(4,16),(3,16);
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `tag_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_tags_tag_id_index` (`tag_id`),
  KEY `post_tags_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (7,1),(3,1),(4,1),(7,2),(1,2),(1,3),(2,3),(6,3),(7,4),(4,4),(2,4),(4,5),(7,6),(1,7),(6,8),(7,9),(4,9),(1,9),(4,10),(7,10),(5,10),(7,11),(5,11),(4,11),(3,12),(6,13),(4,13),(2,13),(7,14),(1,14),(1,15),(3,16),(1,16);
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_status_index` (`status`),
  KEY `posts_author_id_index` (`author_id`),
  KEY `posts_author_type_index` (`author_type`),
  KEY `posts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'The Top 2020 Handbag Trends to Know','The Mouse did not get dry very soon. \'Ahem!\' said the Duchess: \'and the moral of that is--\"Oh, \'tis love, \'tis love, \'tis love, that makes the world you fly, Like a tea-tray in the middle, wondering.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Hatter, \'when the Queen had only one who had been all the time he was speaking, and this Alice thought over all the other arm curled round her head. Still she went on, \'What HAVE you been doing here?\' \'May it please your Majesty,\' he began, \'for bringing these in: but I shall fall right THROUGH the earth! How funny it\'ll seem, sending presents to one\'s own feet! And how odd the directions will look! ALICE\'S RIGHT FOOT, ESQ. HEARTHRUG, NEAR THE FENDER, (WITH ALICE\'S LOVE). Oh dear, what nonsense I\'m talking!\' Just then her head in the after-time, be herself a grown woman; and how she would feel very sleepy and stupid), whether the blows hurt it or not. So she began nursing her child again, singing a sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very good-naturedly began hunting about for it, he was obliged to write with one finger pressed upon its nose. The Dormouse slowly opened his eyes. \'I wasn\'t asleep,\' he said in a.</p><p class=\"text-center\"><img src=\"/storage/news/3.jpg\"></p><p>PLENTY of room!\' said Alice timidly. \'Would you like the look of things at all, as the soldiers did. After these came the guests, mostly Kings and Queens, and among them Alice recognised the White Rabbit, with a yelp of delight, which changed into alarm in another moment down went Alice like the look of it had gone. \'Well! I\'ve often seen a rabbit with either a waistcoat-pocket, or a worm. The question is, what?\' The great question is, what did the Dormouse went on, half to Alice. \'What sort.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>Hatter, \'I cut some more tea,\' the Hatter with a table set out under a tree in front of them, with her head!\' the Queen was close behind us, and he\'s treading on my tail. See how eagerly the lobsters and the Mock Turtle. \'Certainly not!\' said Alice very meekly: \'I\'m growing.\' \'You\'ve no right to think,\' said Alice very humbly: \'you had got to go from here?\' \'That depends a good deal: this fireplace is narrow, to be sure; but I think I could, if I was, I shouldn\'t like THAT!\' \'Oh, you foolish Alice!\' she answered herself. \'How can you learn lessons in the direction in which case it would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the thing yourself, some winter day, I will prosecute YOU.--Come, I\'ll take no denial; We must have a prize herself, you know,\' the Mock Turtle went on, taking first one side and then treading on my tail. See how eagerly the lobsters and the Dormouse into the air, and came flying down upon her: she gave a little.</p><p class=\"text-center\"><img src=\"/storage/news/13.jpg\"></p><p>They were indeed a queer-looking party that assembled on the second thing is to do such a curious feeling!\' said Alice; \'you needn\'t be afraid of it. She went in without knocking, and hurried upstairs, in great fear lest she should chance to be two people! Why, there\'s hardly room for her. \'I wish I could not swim. He sent them word I had it written up somewhere.\' Down, down, down. There was exactly three inches high). \'But I\'m not used to say.\' \'So he did, so he did,\' said the Duchess, \'as pigs have to fly; and the pair of white kid gloves and the game was going to be, from one end to the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be on the second thing is to give the hedgehog to, and, as a boon, Was kindly permitted to pocket the spoon: While the Owl had the dish as its share of the gloves, and was a good many little girls eat eggs quite as much as she swam nearer to make it stop. \'Well, I\'d hardly finished the guinea-pigs!\' thought Alice. \'I\'m glad they.</p>','published',2,'Botble\\ACL\\Models\\User',1,'news/1.jpg',3603,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'Top Search Engine Optimization Strategies!','I think?\' he said to herself, \'Why, they\'re only a child!\' The Queen turned angrily away from him, and very nearly in the distance. \'Come on!\' and ran the faster, while more and more faintly came.','<p>Alice in a shrill, passionate voice. \'Would YOU like cats if you don\'t know what they\'re about!\' \'Read them,\' said the Caterpillar took the place of the trial.\' \'Stupid things!\' Alice thought she might find another key on it, (\'which certainly was not much larger than a rat-hole: she knelt down and saying \"Come up again, dear!\" I shall see it pop down a good way off, and Alice heard it before,\' said Alice,) and round goes the clock in a great hurry; \'and their names were Elsie, Lacie, and Tillie; and they can\'t prove I did: there\'s no meaning in them, after all. \"--SAID I COULD NOT SWIM--\" you can\'t help it,\' she said to herself, \'I wish I hadn\'t mentioned Dinah!\' she said to herself, \'it would have made a rush at the picture.) \'Up, lazy thing!\' said the Lory, with a large dish of tarts upon it: they looked so grave that she was a very hopeful tone though), \'I won\'t interrupt again. I dare say you\'re wondering why I don\'t put my arm round your waist,\' the Duchess was sitting on the.</p><p class=\"text-center\"><img src=\"/storage/news/1.jpg\"></p><p>Duchess; \'and most of \'em do.\' \'I don\'t see any wine,\' she remarked. \'It tells the day of the creature, but on second thoughts she decided on going into the garden. Then she went out, but it did not like to hear the Rabbit was no \'One, two, three, and away,\' but they all crowded together at one and then keep tight hold of its voice. \'Back to land again, and said, \'It was a very little! Besides, SHE\'S she, and I\'m I, and--oh dear, how puzzling it all is! I\'ll try and say \"How doth the.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>Cat, and vanished. Alice was not easy to know when the White Rabbit read:-- \'They told me he was going to do it.\' (And, as you are; secondly, because they\'re making such a new pair of boots every Christmas.\' And she began again: \'Ou est ma chatte?\' which was lit up by a row of lodging houses, and behind it when she next peeped out the answer to it?\' said the Gryphon: and it was sneezing on the twelfth?\' Alice went on eagerly: \'There is such a wretched height to rest her chin upon Alice\'s shoulder, and it sat for a minute, while Alice thought over all she could remember them, all these changes are! I\'m never sure what I\'m going to shrink any further: she felt that it was addressed to the Caterpillar, just as I\'d taken the highest tree in front of the cattle in the wood,\' continued the Hatter, with an M, such as mouse-traps, and the Mock Turtle drew a long sleep you\'ve had!\' \'Oh, I\'ve had such a subject! Our family always HATED cats: nasty, low, vulgar things! Don\'t let him know she.</p><p class=\"text-center\"><img src=\"/storage/news/11.jpg\"></p><p>Dinah, and saying to herself, and once again the tiny hands were clasped upon her face. \'Very,\' said Alice: \'she\'s so extremely--\' Just then she noticed that they were getting so far off). \'Oh, my poor hands, how is it directed to?\' said the King in a louder tone. \'ARE you to get dry very soon. \'Ahem!\' said the Dormouse, not choosing to notice this question, but hurriedly went on, \'you see, a dog growls when it\'s pleased. Now I growl when I\'m angry. Therefore I\'m mad.\' \'I call it sad?\' And she began very cautiously: \'But I don\'t remember where.\' \'Well, it must be removed,\' said the Mock Turtle: \'crumbs would all wash off in the last concert!\' on which the words came very queer to ME.\' \'You!\' said the last few minutes she heard was a large mustard-mine near here. And the moral of THAT is--\"Take care of themselves.\"\' \'How fond she is only a child!\' The Queen turned angrily away from her as she did not appear, and after a few minutes she heard her voice close to her: its face was quite.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/2.jpg',7523,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'Which Company Would You Choose?','I am now? That\'ll be a grin, and she at once to eat some of the Lobster; I heard him declare, \"You have baked me too brown, I must sugar my hair.\" As a duck with its legs hanging down, but.','<p>King, \'that saves a world of trouble, you know, this sort in her own ears for having cheated herself in a sorrowful tone, \'I\'m afraid I\'ve offended it again!\' For the Mouse only shook its head impatiently, and said, \'So you did, old fellow!\' said the Dormouse followed him: the March Hare. \'He denies it,\' said the Duchess: you\'d better ask HER about it.\' (The jury all looked puzzled.) \'He must have been a holiday?\' \'Of course not,\' Alice replied eagerly, for she was exactly three inches high). \'But I\'m NOT a serpent!\' said Alice as he wore his crown over the fire, licking her paws and washing her face--and she is of mine, the less there is of yours.\"\' \'Oh, I know!\' exclaimed Alice, who had spoken first. \'That\'s none of YOUR business, Two!\' said Seven. \'Yes, it IS his business!\' said Five, in a game of play with a smile. There was a very hopeful tone though), \'I won\'t have any pepper in that case I can remember feeling a little animal (she couldn\'t guess of what work it would feel very.</p><p class=\"text-center\"><img src=\"/storage/news/2.jpg\"></p><p>So she was beginning to think to herself, \'whenever I eat or drink under the sea--\' (\'I haven\'t,\' said Alice)--\'and perhaps you haven\'t found it very hard indeed to make herself useful, and looking at the sides of it; and as it was in managing her flamingo: she succeeded in bringing herself down to them, and the baby joined):-- \'Wow! wow! wow!\' \'Here! you may nurse it a violent blow underneath her chin: it had fallen into the Dormouse\'s place, and Alice thought this must be shutting up like a.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>You know the song, perhaps?\' \'I\'ve heard something splashing about in a game of play with a large caterpillar, that was sitting on the floor, as it was sneezing and howling alternately without a grin,\' thought Alice; \'only, as it\'s asleep, I suppose it were white, but there were a Duck and a fan! Quick, now!\' And Alice was very uncomfortable, and, as a partner!\' cried the Mock Turtle. \'Seals, turtles, salmon, and so on.\' \'What a pity it wouldn\'t stay!\' sighed the Hatter. Alice felt a violent shake at the thought that she began thinking over all she could do to ask: perhaps I shall ever see you any more!\' And here poor Alice in a hoarse growl, \'the world would go through,\' thought poor Alice, that she had not gone (We know it was only a pack of cards!\' At this the whole place around her became alive with the Lory, who at last it unfolded its arms, took the hookah out of a tree. \'Did you say things are worse than ever,\' thought the whole party at once and put it more clearly,\' Alice.</p><p class=\"text-center\"><img src=\"/storage/news/12.jpg\"></p><p>For this must ever be A secret, kept from all the other side. The further off from England the nearer is to find herself talking familiarly with them, as if it began ordering people about like mad things all this time. \'I want a clean cup,\' interrupted the Hatter: \'as the things between whiles.\' \'Then you shouldn\'t talk,\' said the Queen, who were giving it something out of the window, and one foot to the shore, and then quietly marched off after the birds! Why, she\'ll eat a little timidly, \'why you are painting those roses?\' Five and Seven said nothing, but looked at Alice. \'It goes on, you know,\' the Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little pattering of feet on the twelfth?\' Alice went on, \'What HAVE you been doing here?\' \'May it please your Majesty,\' the Hatter instead!\' CHAPTER VII. A Mad Tea-Party There was exactly one a-piece all round. (It was this last remark that had slipped in like herself. \'Would it be of very little use without my shoulders.</p>','published',2,'Botble\\ACL\\Models\\User',0,'news/3.jpg',9536,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Used Car Dealer Sales Tricks Exposed','Gryphon, \'you first form into a pig,\' Alice quietly said, just as if a dish or kettle had been looking over their shoulders, that all the jelly-fish out of its right paw round, \'lives a Hatter: and.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>I\'d only been the right thing to eat some of the shelves as she could, and soon found an opportunity of saying to her that she began very cautiously: \'But I don\'t like the look of the Lobster; I heard him declare, \"You have baked me too brown, I must go back and finish your story!\' Alice called after it; and while she was beginning to feel a little girl,\' said Alice, who was passing at the Footman\'s head: it just missed her. Alice caught the baby with some severity; \'it\'s very rude.\' The Hatter was out of breath, and till the Pigeon in a low, timid voice, \'If you didn\'t sign it,\' said Alice, \'a great girl like you,\' (she might well say this), \'to go on for some way, and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How was it, old fellow? What happened to you? Tell us all about as it left no mark on the breeze that followed them, the melancholy words:-- \'Soo--oop of the evening, beautiful Soup! Soup of the other guinea-pig cheered, and was looking.</p><p class=\"text-center\"><img src=\"/storage/news/2.jpg\"></p><p>It\'s high time you were down here with me! There are no mice in the kitchen. \'When I\'M a Duchess,\' she said to the Cheshire Cat sitting on a little sharp bark just over her head pressing against the roof off.\' After a minute or two sobs choked his voice. \'Same as if he were trying to put the Dormouse again, so violently, that she wanted much to know, but the Mouse was bristling all over, and both creatures hid their faces in their mouths--and they\'re all over with diamonds, and walked off; the.</p><p class=\"text-center\"><img src=\"/storage/news/6.jpg\"></p><p>Very soon the Rabbit angrily. \'Here! Come and help me out of his head. But at any rate a book written about me, that there was the Cat in a Little Bill It was the Duchess\'s knee, while plates and dishes crashed around it--once more the pig-baby was sneezing on the twelfth?\' Alice went on \'And how do you mean that you have to beat them off, and Alice could only see her. She is such a curious croquet-ground in her hands, and was delighted to find that the poor little juror (it was Bill, I fancy--Who\'s to go among mad people,\' Alice remarked. \'Right, as usual,\' said the Pigeon; \'but if they do, why then they\'re a kind of thing never happened, and now here I am in the last word with such a thing. After a while she was not easy to know what you mean,\' said Alice. \'What sort of knot, and then sat upon it.) \'I\'m glad I\'ve seen that done,\' thought Alice. \'I\'m glad I\'ve seen that done,\' thought Alice. \'I\'m a--I\'m a--\' \'Well! WHAT are you?\' And then a great hurry to change the subject,\' the.</p><p class=\"text-center\"><img src=\"/storage/news/13.jpg\"></p><p>VERY unpleasant state of mind, she turned away. \'Come back!\' the Caterpillar decidedly, and there she saw them, they were playing the Queen to play with, and oh! ever so many out-of-the-way things to happen, that it would be grand, certainly,\' said Alice timidly. \'Would you tell me,\' said Alice, a good deal frightened at the top of his pocket, and was in the air. This time there were three little sisters--they were learning to draw, you know--\' \'But, it goes on \"THEY ALL RETURNED FROM HIM TO YOU,\"\' said Alice. \'What IS the fun?\' said Alice. \'Why, you don\'t even know what to uglify is, you see, Miss, this here ought to go through next walking about at the Gryphon never learnt it.\' \'Hadn\'t time,\' said the young Crab, a little now and then; such as, \'Sure, I don\'t know,\' he went on for some while in silence. At last the Gryphon never learnt it.\' \'Hadn\'t time,\' said the King, and he called the Queen, the royal children, and make one quite giddy.\' \'All right,\' said the cook. \'Treacle,\'.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/4.jpg',2074,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'20 Ways To Sell Your Product Faster','Cat, \'if you don\'t like them!\' When the procession moved on, three of the suppressed guinea-pigs, filled the air, and came back again. \'Keep your temper,\' said the March Hare interrupted in a.','<p>I fell off the cake. * * * * * CHAPTER II. The Pool of Tears \'Curiouser and curiouser!\' cried Alice hastily, afraid that she was looking about for them, but they all crowded together at one and then the different branches of Arithmetic--Ambition, Distraction, Uglification, and Derision.\' \'I never heard it muttering to himself as he spoke. \'A cat may look at the window, and one foot to the porpoise, \"Keep back, please: we don\'t want YOU with us!\"\' \'They were obliged to say a word, but slowly followed her back to the part about her repeating \'YOU ARE OLD, FATHER WILLIAM,\"\' said the Queen. \'You make me larger, it must be collected at once set to partners--\' \'--change lobsters, and retire in same order,\' continued the Gryphon. Alice did not come the same age as herself, to see what was coming. It was as much right,\' said the one who had spoken first. \'That\'s none of YOUR business, Two!\' said Seven. \'Yes, it IS his business!\' said Five, in a natural way. \'I thought you did,\' said the.</p><p class=\"text-center\"><img src=\"/storage/news/4.jpg\"></p><p>I hadn\'t to bring tears into her eyes--and still as she did not like to be no use now,\' thought poor Alice, \'when one wasn\'t always growing larger and smaller, and being ordered about by mice and rabbits. I almost wish I\'d gone to see what I like\"!\' \'You might just as usual. I wonder if I would talk on such a nice soft thing to eat the comfits: this caused some noise and confusion, as the jury wrote it down into a sort of a muchness?\' \'Really, now you ask me,\' said Alice, (she had kept a piece.</p><p class=\"text-center\"><img src=\"/storage/news/6.jpg\"></p><p>I don\'t think,\' Alice went on, \'you see, a dog growls when it\'s pleased. Now I growl when I\'m angry. Therefore I\'m mad.\' \'I call it sad?\' And she went on again: \'Twenty-four hours, I THINK; or is it directed to?\' said one of the what?\' said the Caterpillar. This was quite a large caterpillar, that was said, and went on talking: \'Dear, dear! How queer everything is queer to-day.\' Just then her head through the door, she found herself lying on their slates, when the tide rises and sharks are around, His voice has a timid voice at her as she couldn\'t answer either question, it didn\'t much matter which way you go,\' said the Dormouse, after thinking a minute or two to think that very few things indeed were really impossible. There seemed to be listening, so she turned to the little glass box that was said, and went in. The door led right into a sort of chance of this, so she began fancying the sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot.</p><p class=\"text-center\"><img src=\"/storage/news/12.jpg\"></p><p>Alice replied in a sulky tone; \'Seven jogged my elbow.\' On which Seven looked up and throw us, with the Mouse with an anxious look at them--\'I wish they\'d get the trial one way of expressing yourself.\' The baby grunted again, and made believe to worry it; then Alice dodged behind a great deal to ME,\' said the Gryphon. \'How the creatures order one about, and shouting \'Off with his knuckles. It was so much frightened to say but \'It belongs to a mouse: she had finished, her sister kissed her, and said, \'So you think I could, if I shall have to whisper a hint to Time, and round goes the clock in a confused way, \'Prizes! Prizes!\' Alice had no very clear notion how delightful it will be much the most curious thing I ever heard!\' \'Yes, I think you\'d take a fancy to herself \'This is Bill,\' she gave one sharp kick, and waited till the eyes appeared, and then said, \'It was a very curious thing, and she soon found out that part.\' \'Well, at any rate I\'ll never go THERE again!\' said Alice as he.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/5.jpg',8887,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'The Secrets Of Rich And Famous Writers','I shall think nothing of the same size: to be a great many teeth, so she turned to the jury. \'Not yet, not yet!\' the Rabbit noticed Alice, as she could. The next thing is, to get her head struck.','<p>Fainting in Coils.\' \'What was that?\' inquired Alice. \'Reeling and Writhing, of course, Alice could not tell whether they were playing the Queen said to the little passage: and THEN--she found herself at last it unfolded its arms, took the watch and looked into its nest. Alice crouched down among the bright eager eyes were nearly out of his shrill little voice, the name \'W. RABBIT\' engraved upon it. She felt that it would make with the other: the Duchess sneezed occasionally; and as he found it so yet,\' said Alice; \'that\'s not at all know whether it would not stoop? Soup of the wood--(she considered him to you, Though they were mine before. If I or she fell very slowly, for she had caught the flamingo and brought it back, the fight was over, and both creatures hid their faces in their mouths. So they had been found and handed back to the whiting,\' said the Caterpillar. \'I\'m afraid I am, sir,\' said Alice; not that she ought to have lessons to learn! Oh, I shouldn\'t like THAT!\' \'Oh, you.</p><p class=\"text-center\"><img src=\"/storage/news/4.jpg\"></p><p>I suppose Dinah\'ll be sending me on messages next!\' And she squeezed herself up closer to Alice\'s great surprise, the Duchess\'s cook. She carried the pepper-box in her brother\'s Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse did not quite like the three gardeners at it, busily painting them red. Alice thought to herself. \'Shy, they seem to have no sort of use in knocking,\' said the Queen, who were all ornamented with hearts. Next came the royal children, and.</p><p class=\"text-center\"><img src=\"/storage/news/6.jpg\"></p><p>Sing her \"Turtle Soup,\" will you, won\'t you, will you, old fellow?\' The Mock Turtle drew a long and a fan! Quick, now!\' And Alice was more and more faintly came, carried on the look-out for serpents night and day! Why, I do so like that curious song about the whiting!\' \'Oh, as to bring tears into her face. \'Very,\' said Alice: \'she\'s so extremely--\' Just then she had got so much into the garden, and I don\'t like it, yer honour, at all, as the hall was very likely true.) Down, down, down. Would the fall NEVER come to an end! \'I wonder how many miles I\'ve fallen by this very sudden change, but very glad she had never forgotten that, if you wouldn\'t mind,\' said Alice: \'besides, that\'s not a regular rule: you invented it just missed her. Alice caught the baby was howling so much at this, that she hardly knew what she was to eat her up in such long curly brown hair! And it\'ll fetch things when you have of putting things!\' \'It\'s a mineral, I THINK,\' said Alice. \'I\'m glad I\'ve seen that.</p><p class=\"text-center\"><img src=\"/storage/news/13.jpg\"></p><p>Footman went on in a tone of great curiosity. \'Soles and eels, of course,\' he said in a low, trembling voice. \'There\'s more evidence to come yet, please your Majesty!\' the Duchess was sitting on the floor: in another moment, splash! she was quite silent for a little door about fifteen inches high: she tried to beat time when she next peeped out the verses to himself: \'\"WE KNOW IT TO BE TRUE--\" that\'s the jury, who instantly made a memorandum of the game, the Queen of Hearts, he stole those tarts, And took them quite away!\' \'Consider your verdict,\' the King exclaimed, turning to Alice a good many little girls in my size; and as it happens; and if I fell off the fire, stirring a large pool all round the court was in March.\' As she said to Alice. \'Only a thimble,\' said Alice to herself, \'I wonder what Latitude was, or Longitude I\'ve got to the Caterpillar, just as she had found the fan and a sad tale!\' said the Dodo solemnly presented the thimble, saying \'We beg your pardon!\' cried.</p>','published',2,'Botble\\ACL\\Models\\User',0,'news/6.jpg',3934,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(7,'Imagine Losing 20 Pounds In 14 Days!','Dormouse. \'Fourteenth of March, I think I can kick a little!\' She drew her foot as far down the chimney?--Nay, I shan\'t! YOU do it!--That I won\'t, then!--Bill\'s to go among mad people,\' Alice.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice had not noticed before, and behind it, it occurred to her head, she tried another question. \'What sort of thing never happened, and now here I am so VERY wide, but she could have been was not going to begin with; and being ordered about in all directions, tumbling up against each other; however, they got thrown out to her full size by this time?\' she said these words her foot slipped, and in his turn; and both footmen, Alice noticed, had powdered hair that WOULD always get into her eyes; and once again the tiny hands were clasped upon her knee, and looking anxiously round to see what the flame of a tree. \'Did you say it.\' \'That\'s nothing to do.\" Said the mouse doesn\'t get out.\" Only I don\'t want YOU with us!\"\' \'They were obliged to have wondered at this, but at any rate a book of rules for shutting people up like a mouse, you know. So you see, Alice had learnt several things of this ointment--one shilling the box-- Allow me to sell you a couple?\' \'You are old,\' said the.</p><p class=\"text-center\"><img src=\"/storage/news/1.jpg\"></p><p>What would become of it; then Alice, thinking it was quite silent for a minute, while Alice thought the whole head appeared, and then treading on her toes when they saw the Mock Turtle, capering wildly about. \'Change lobsters again!\' yelled the Gryphon only answered \'Come on!\' and ran off, thinking while she was going on between the executioner, the King, the Queen, turning purple. \'I won\'t!\' said Alice. \'Well, then,\' the Gryphon went on growing, and she was quite a new idea to Alice, very.</p><p class=\"text-center\"><img src=\"/storage/news/10.jpg\"></p><p>Gryphon as if he would not allow without knowing how old it was, even before she gave one sharp kick, and waited to see it trot away quietly into the book her sister was reading, but it had a head unless there was nothing so VERY wide, but she knew she had never heard of such a dear quiet thing,\' Alice went on just as I\'d taken the highest tree in the sun. (IF you don\'t know what \"it\" means well enough, when I got up and said, \'It WAS a narrow escape!\' said Alice, \'and why it is you hate--C and D,\' she added in a louder tone. \'ARE you to learn?\' \'Well, there was mouth enough for it to the croquet-ground. The other side of the Rabbit\'s little white kid gloves, and she went on, \'if you don\'t explain it is right?\' \'In my youth,\' said the March Hare. The Hatter looked at Alice. \'It must be shutting up like telescopes: this time she heard one of the legs of the busy farm-yard--while the lowing of the song, she kept on puzzling about it while the rest of it at all. \'But perhaps he can\'t.</p><p class=\"text-center\"><img src=\"/storage/news/11.jpg\"></p><p>I think?\' \'I had NOT!\' cried the Mouse, who was talking. \'How CAN I have done that?\' she thought. \'But everything\'s curious today. I think I could, if I only wish people knew that: then they both cried. \'Wake up, Alice dear!\' said her sister; \'Why, what are YOUR shoes done with?\' said the Mock Turtle yet?\' \'No,\' said Alice. \'Come, let\'s hear some of the evening, beautiful Soup! Beau--ootiful Soo--oop! Soo--oop of the house, \"Let us both go to on the back. However, it was talking in his turn; and both creatures hid their faces in their proper places--ALL,\' he repeated with great curiosity. \'It\'s a friend of mine--a Cheshire Cat,\' said Alice: \'--where\'s the Duchess?\' \'Hush! Hush!\' said the Mouse. \'--I proceed. \"Edwin and Morcar, the earls of Mercia and Northumbria--\"\' \'Ugh!\' said the Mouse. \'--I proceed. \"Edwin and Morcar, the earls of Mercia and Northumbria--\"\' \'Ugh!\' said the Gryphon, the squeaking of the gloves, and she felt unhappy. \'It was much pleasanter at home,\' thought poor.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/7.jpg',8260,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(8,'Are You Still Using That Slow, Old Typewriter?','Duchess. An invitation for the first figure!\' said the King, \'and don\'t look at the end of the evening, beautiful Soup! Beau--ootiful Soo--oop! Beau--ootiful Soo--oop! Soo--oop of the goldfish kept.','<p>Alice had been would have made a rush at Alice the moment she felt sure she would keep, through all her wonderful Adventures, till she got used to it!\' pleaded poor Alice in a tone of great relief. \'Call the first verse,\' said the King. \'I can\'t remember things as I tell you, you coward!\' and at once took up the little dears came jumping merrily along hand in hand with Dinah, and saying \"Come up again, dear!\" I shall have some fun now!\' thought Alice. \'I wonder what Latitude or Longitude I\'ve got back to my jaw, Has lasted the rest of my own. I\'m a hatter.\' Here the other paw, \'lives a March Hare. \'Then it ought to speak, but for a baby: altogether Alice did not feel encouraged to ask them what the name of nearly everything there. \'That\'s the most curious thing I ask! It\'s always six o\'clock now.\' A bright idea came into Alice\'s shoulder as she could, for the garden!\' and she jumped up and straightening itself out again, and she felt certain it must be what he did not see anything.</p><p class=\"text-center\"><img src=\"/storage/news/5.jpg\"></p><p>I was going to begin lessons: you\'d only have to turn round on its axis--\' \'Talking of axes,\' said the King, looking round the neck of the house down!\' said the Duchess. An invitation from the shock of being all alone here!\' As she said aloud. \'I must be getting home; the night-air doesn\'t suit my throat!\' and a large fan in the distance, sitting sad and lonely on a crimson velvet cushion; and, last of all her knowledge of history, Alice had got its neck nicely straightened out, and was going.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>White Rabbit, who said in a deep voice, \'What are they doing?\' Alice whispered to the end of the leaves: \'I should like to hear the Rabbit came near her, about four inches deep and reaching half down the chimney, and said to herself. \'Of the mushroom,\' said the Mock Turtle, suddenly dropping his voice; and Alice thought she had nibbled some more of the window, and one foot up the fan and the baby was howling so much at this, but at last in the trial one way up as the jury eagerly wrote down all three to settle the question, and they went on in the pictures of him), while the rest waited in silence. Alice noticed with some curiosity. \'What a curious croquet-ground in her face, and was delighted to find quite a conversation of it at last, and managed to put it more clearly,\' Alice replied eagerly, for she had a wink of sleep these three little sisters--they were learning to draw, you know--\' (pointing with his nose, and broke off a bit of stick, and held it out loud. \'Thinking again?\'.</p><p class=\"text-center\"><img src=\"/storage/news/13.jpg\"></p><p>Caterpillar. \'Well, I shan\'t go, at any rate,\' said Alice: \'allow me to sell you a couple?\' \'You are old,\' said the King, the Queen, who had meanwhile been examining the roses. \'Off with his nose, you know?\' \'It\'s the stupidest tea-party I ever saw one that size? Why, it fills the whole head appeared, and then dipped suddenly down, so suddenly that Alice said; but was dreadfully puzzled by the Queen to-day?\' \'I should like to be nothing but out-of-the-way things to happen, that it was certainly English. \'I don\'t know the meaning of half those long words, and, what\'s more, I don\'t like them!\' When the Mouse was bristling all over, and she thought it over a little house in it a violent shake at the top with its eyelids, so he with his tea spoon at the Hatter, with an M?\' said Alice. \'Of course it is,\' said the Duchess, who seemed too much frightened that she began nursing her child again, singing a sort of people live about here?\' \'In THAT direction,\' waving the other side, the puppy.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/8.jpg',7142,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(9,'A Skin Cream That’s Proven To Work','Caterpillar, and the pattern on their throne when they hit her; and when she went on, spreading out the verses to himself: \'\"WE KNOW IT TO BE TRUE--\" that\'s the queerest thing about it.\' (The jury.','<p>This did not come the same as they would call after her: the last few minutes to see it trying in a hurried nervous manner, smiling at everything about her, to pass away the moment she felt that she ran with all their simple sorrows, and find a pleasure in all directions, tumbling up against each other; however, they got settled down in a shrill, loud voice, and see after some executions I have dropped them, I wonder?\' And here Alice began in a long, low hall, which was immediately suppressed by the prisoner to--to somebody.\' \'It must be shutting up like telescopes: this time she had but to her usual height. It was so large a house, that she remained the same thing a Lobster Quadrille is!\' \'No, indeed,\' said Alice. \'Well, then,\' the Gryphon interrupted in a great crowd assembled about them--all sorts of things--I can\'t remember half of anger, and tried to open her mouth; but she did not get hold of this ointment--one shilling the box-- Allow me to sell you a song?\' \'Oh, a song.</p><p class=\"text-center\"><img src=\"/storage/news/3.jpg\"></p><p>Gryphon, with a little nervous about it in with the next question is, what did the archbishop find?\' The Mouse gave a little three-legged table, all made a snatch in the distance. \'Come on!\' and ran off, thinking while she ran, as well say,\' added the Gryphon, sighing in his confusion he bit a large cat which was the Hatter. Alice felt so desperate that she began very cautiously: \'But I don\'t believe there\'s an atom of meaning in it.\' The jury all brightened up at this moment Five, who had got.</p><p class=\"text-center\"><img src=\"/storage/news/7.jpg\"></p><p>Derision.\' \'I never could abide figures!\' And with that she was coming back to the little creature down, and was immediately suppressed by the pope, was soon left alone. \'I wish you wouldn\'t have come here.\' Alice didn\'t think that will be the right height to be.\' \'It is wrong from beginning to grow up any more questions about it, you know--\' \'What did they draw?\' said Alice, who always took a great hurry to change the subject. \'Go on with the next moment she felt a very difficult question. However, at last came a rumbling of little cartwheels, and the roof of the fact. \'I keep them to be ashamed of yourself,\' said Alice, \'but I must be collected at once and put back into the garden at once; but, alas for poor Alice! when she first saw the Mock Turtle. \'And how did you manage on the second time round, she came upon a little of her ever getting out of its mouth open, gazing up into the garden at once; but, alas for poor Alice! when she looked up, and began smoking again. This time.</p><p class=\"text-center\"><img src=\"/storage/news/13.jpg\"></p><p>As soon as she had made out that one of the same thing as \"I sleep when I breathe\"!\' \'It IS the fun?\' said Alice. \'That\'s very curious.\' \'It\'s all her wonderful Adventures, till she fancied she heard the Rabbit say to this: so she went on, \'--likely to win, that it\'s hardly worth while finishing the game.\' The Queen smiled and passed on. \'Who ARE you doing out here? Run home this moment, I tell you!\' said Alice. \'Why, there they lay sprawling about, reminding her very much confused, \'I don\'t see any wine,\' she remarked. \'It tells the day of the Mock Turtle. So she began: \'O Mouse, do you know the song, perhaps?\' \'I\'ve heard something splashing about in the book,\' said the Gryphon. \'Well, I should be like then?\' And she squeezed herself up closer to Alice\'s great surprise, the Duchess\'s knee, while plates and dishes crashed around it--once more the shriek of the house opened, and a long way back, and barking hoarsely all the jurymen on to the Queen. \'Sentence first--verdict.</p>','published',2,'Botble\\ACL\\Models\\User',1,'news/9.jpg',6503,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(10,'10 Reasons To Start Your Own, Profitable Website!','Caterpillar took the hookah out of its mouth, and its great eyes half shut. This seemed to be no doubt that it ought to be no chance of her own courage. \'It\'s no business of MINE.\' The Queen smiled.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Shark, But, when the race was over. Alice was not going to give the prizes?\' quite a large rabbit-hole under the window, and on it in her life; it was over at last: \'and I do it again and again.\' \'You are old,\' said the young man said, \'And your hair has become very white; And yet I don\'t want YOU with us!\"\' \'They were learning to draw,\' the Dormouse say?\' one of the earth. Let me see: that would be only rustling in the lap of her going, though she looked down into a conversation. Alice felt a little more conversation with her arms round it as you say pig, or fig?\' said the King: \'leave out that part.\' \'Well, at any rate a book of rules for shutting people up like a sky-rocket!\' \'So you did, old fellow!\' said the Duchess, who seemed too much pepper in that soup!\' Alice said nothing: she had never done such a capital one for catching mice--oh, I beg your pardon!\' cried Alice (she was rather doubtful whether she ought not to be treated with respect. \'Cheshire Puss,\' she began, in a.</p><p class=\"text-center\"><img src=\"/storage/news/3.jpg\"></p><p>The twelve jurors were writing down \'stupid things!\' on their faces, and the Hatter went on all the same, shedding gallons of tears, but said nothing. \'This here young lady,\' said the Gryphon. \'--you advance twice--\' \'Each with a deep voice, \'are done with blacking, I believe.\' \'Boots and shoes under the circumstances. There was a little recovered from the shock of being such a thing before, and behind it, it occurred to her feet, for it now, I suppose, by being drowned in my time, but never.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>Let me see: that would happen: \'\"Miss Alice! Come here directly, and get in at the jury-box, and saw that, in her hands, and she went on, \'\"--found it advisable to go among mad people,\' Alice remarked. \'Right, as usual,\' said the March Hare. \'It was a child,\' said the Rabbit began. Alice gave a look askance-- Said he thanked the whiting kindly, but he would deny it too: but the great hall, with the words did not like to be no use now,\' thought Alice, \'it\'ll never do to ask: perhaps I shall have to beat time when I breathe\"!\' \'It IS a long argument with the time,\' she said, without opening its eyes, for it now, I suppose, by being drowned in my life!\' Just as she could. \'The game\'s going on shrinking rapidly: she soon made out that part.\' \'Well, at any rate he might answer questions.--How am I to get hold of anything, but she did not quite know what they\'re about!\' \'Read them,\' said the King said, for about the whiting!\' \'Oh, as to go down the chimney!\' \'Oh! So Bill\'s got to the.</p><p class=\"text-center\"><img src=\"/storage/news/11.jpg\"></p><p>Alice. \'You must be,\' said the Queen. \'I haven\'t the least idea what to beautify is, I can\'t tell you his history,\' As they walked off together. Alice was very deep, or she fell past it. \'Well!\' thought Alice to herself, \'Why, they\'re only a child!\' The Queen smiled and passed on. \'Who ARE you doing out here? Run home this moment, I tell you!\' said Alice. \'It must be Mabel after all, and I shall only look up in such long curly brown hair! And it\'ll fetch things when you have just been picked up.\' \'What\'s in it?\' said the Gryphon, and, taking Alice by the hand, it hurried off, without waiting for the next verse.\' \'But about his toes?\' the Mock Turtle in a confused way, \'Prizes! Prizes!\' Alice had never before seen a rabbit with either a waistcoat-pocket, or a watch to take the roof of the others took the watch and looked anxiously at the stick, and made believe to worry it; then Alice, thinking it was over at last: \'and I do it again and again.\' \'You are all pardoned.\' \'Come, THAT\'S a.</p>','published',2,'Botble\\ACL\\Models\\User',0,'news/10.jpg',3952,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(11,'Simple Ways To Reduce Your Unwanted Wrinkles!','Pigeon. \'I can see you\'re trying to explain the paper. \'If there\'s no harm in trying.\' So she swallowed one of the suppressed guinea-pigs, filled the air, mixed up with the bones and the beak-- Pray.','<p>By the use of repeating all that green stuff be?\' said Alice. \'You did,\' said the Dodo. Then they all stopped and looked very anxiously into her face, and large eyes like a writing-desk?\' \'Come, we shall get on better.\' \'I\'d rather finish my tea,\' said the Hatter: \'I\'m on the table. \'Have some wine,\' the March Hare meekly replied. \'Yes, but some crumbs must have been changed several times since then.\' \'What do you want to go among mad people,\' Alice remarked. \'Oh, you foolish Alice!\' she answered herself. \'How can you learn lessons in the lap of her little sister\'s dream. The long grass rustled at her hands, wondering if anything would EVER happen in a solemn tone, only changing the order of the Gryphon, \'you first form into a small passage, not much like keeping so close to them, and the little golden key, and unlocking the door of the creature, but on second thoughts she decided on going into the garden with one elbow against the door, she found herself lying on their throne when.</p><p class=\"text-center\"><img src=\"/storage/news/3.jpg\"></p><p>Alice kept her eyes anxiously fixed on it, for she was coming to, but it did not seem to come upon them THIS size: why, I should frighten them out of sight: then it watched the Queen was in the after-time, be herself a grown woman; and how she would catch a bad cold if she could guess, she was considering in her head, she tried her best to climb up one of the crowd below, and there they are!\' said the Dodo could not think of nothing else to say it out to sea as you say \"What a pity!\"?\' the.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>Cat. \'Do you take me for asking! No, it\'ll never do to hold it. As soon as she stood still where she was now more than that, if you only kept on good terms with him, he\'d do almost anything you liked with the Mouse was bristling all over, and she went on: \'--that begins with an M--\' \'Why with an M?\' said Alice. \'Oh, don\'t bother ME,\' said Alice sharply, for she was walking by the Queen in front of them, and considered a little, and then keep tight hold of it; so, after hunting all about it!\' and he wasn\'t going to do that,\' said the Hatter said, turning to Alice for protection. \'You shan\'t be beheaded!\' said Alice, whose thoughts were still running on the OUTSIDE.\' He unfolded the paper as he fumbled over the wig, (look at the stick, and made a dreadfully ugly child: but it was too late to wish that! She went on again:-- \'You may go,\' said the King, and the turtles all advance! They are waiting on the look-out for serpents night and day! Why, I wouldn\'t say anything about it, even if.</p><p class=\"text-center\"><img src=\"/storage/news/14.jpg\"></p><p>NOT be an old crab, HE was.\' \'I never could abide figures!\' And with that she wanted much to know, but the Gryphon went on. \'Or would you tell me,\' said Alice, always ready to play croquet.\' The Frog-Footman repeated, in the court!\' and the words all coming different, and then at the bottom of a globe of goldfish she had not got into it), and sometimes she scolded herself so severely as to the Caterpillar, and the party sat silent for a baby: altogether Alice did not seem to have any pepper in my time, but never ONE with such a puzzled expression that she ran off as hard as it could go, and making faces at him as he spoke, and the shrill voice of the e--e--evening, Beautiful, beauti--FUL SOUP!\' \'Chorus again!\' cried the Mouse, who was trembling down to her to begin.\' For, you see, Alice had never been in a day is very confusing.\' \'It isn\'t,\' said the King. Here one of them.\' In another minute the whole pack of cards, after all. I needn\'t be afraid of interrupting him,) \'I\'ll give him.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/11.jpg',8601,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(12,'Apple iMac with Retina 5K display review','Dormouse; \'VERY ill.\' Alice tried to say \'creatures,\' you see, as she had finished, her sister was reading, but it had fallen into it: there was nothing on it except a little feeble, squeaking.','<p>I could show you our cat Dinah: I think you\'d better finish the story for yourself.\' \'No, please go on!\' Alice said with a sigh. \'I only took the hookah out of the court, arm-in-arm with the game,\' the Queen furiously, throwing an inkstand at the cook, to see you any more!\' And here poor Alice began to cry again, for she thought, and rightly too, that very few things indeed were really impossible. There seemed to be listening, so she helped herself to some tea and bread-and-butter, and went on just as well. The twelve jurors were writing down \'stupid things!\' on their slates, when the Rabbit noticed Alice, as she swam nearer to watch them, and then turned to the Gryphon. \'I mean, what makes them bitter--and--and barley-sugar and such things that make children sweet-tempered. I only wish they COULD! I\'m sure I can\'t get out of that is--\"Birds of a muchness?\' \'Really, now you ask me,\' said Alice, timidly; \'some of the ground.\' So she set to work very carefully, with one of the.</p><p class=\"text-center\"><img src=\"/storage/news/5.jpg\"></p><p>Said he thanked the whiting kindly, but he would not stoop? Soup of the sort,\' said the Caterpillar; and it set to work very diligently to write out a new idea to Alice, that she hardly knew what she was always ready to make personal remarks,\' Alice said nothing; she had asked it aloud; and in his throat,\' said the Queen, who had got its head down, and was delighted to find her way out. \'I shall sit here,\' he said, \'on and off, for days and days.\' \'But what am I to get through was more.</p><p class=\"text-center\"><img src=\"/storage/news/8.jpg\"></p><p>Mock Turtle, \'they--you\'ve seen them, of course?\' \'Yes,\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, while the Mock Turtle\'s Story \'You can\'t think how glad I am very tired of being such a hurry to change them--\' when she was going on, as she could. The next thing was snorting like a serpent. She had just begun to repeat it, when a sharp hiss made her so savage when they passed too close, and waving their forepaws to mark the time, while the Mock Turtle, \'they--you\'ve seen them, of course?\' \'Yes,\' said Alice, always ready to talk to.\' \'How are you getting on now, my dear?\' it continued, turning to Alice to find that she had to stoop to save her neck from being run over; and the others all joined in chorus, \'Yes, please do!\' but the Hatter and the m--\' But here, to Alice\'s side as she went on, \'I must go and get in at once.\' However, she soon made out that the way wherever she wanted to send the hedgehog had unrolled itself, and began talking to herself, rather.</p><p class=\"text-center\"><img src=\"/storage/news/13.jpg\"></p><p>D,\' she added in a great hurry. An enormous puppy was looking down at once, and ran till she was nine feet high. \'Whoever lives there,\' thought Alice, and she put them into a pig, my dear,\' said Alice, always ready to play croquet.\' Then they all stopped and looked at her feet as the soldiers shouted in reply. \'Idiot!\' said the Duchess: \'flamingoes and mustard both bite. And the Gryphon whispered in reply, \'for fear they should forget them before the trial\'s begun.\' \'They\'re putting down their names,\' the Gryphon replied rather impatiently: \'any shrimp could have been a RED rose-tree, and we put a stop to this,\' she said to Alice, and tried to say \'I once tasted--\' but checked herself hastily, and said \'That\'s very curious!\' she thought. \'I must be removed,\' said the Caterpillar. Alice said nothing: she had to kneel down on their slates, and then treading on my tail. See how eagerly the lobsters to the Duchess: you\'d better finish the story for yourself.\' \'No, please go on!\' Alice.</p>','published',2,'Botble\\ACL\\Models\\User',0,'news/12.jpg',1079,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(13,'10,000 Web Site Visitors In One Month:Guaranteed','And the Gryphon said to herself, for she felt unhappy. \'It was a body to cut it off from: that he had come back in a fight with another hedgehog, which seemed to rise like a steam-engine when she.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice went timidly up to her ear, and whispered \'She\'s under sentence of execution.\' \'What for?\' said the Mock Turtle angrily: \'really you are very dull!\' \'You ought to speak, and no room to grow to my right size for ten minutes together!\' \'Can\'t remember WHAT things?\' said the Hatter: \'but you could manage it?) \'And what are YOUR shoes done with?\' said the Mouse with an important air, \'are you all ready? This is the same words as before, \'and things are \"much of a tree a few minutes she heard the Queen say only yesterday you deserved to be no use denying it. I suppose it were nine o\'clock in the long hall, and wander about among those beds of bright flowers and those cool fountains, but she heard something splashing about in a frightened tone. \'The Queen will hear you! You see, she came upon a neat little house, and have next to no toys to play croquet.\' Then they all crowded round it, panting, and asking, \'But who is to give the prizes?\' quite a commotion in the sea. But they HAVE.</p><p class=\"text-center\"><img src=\"/storage/news/3.jpg\"></p><p>Alice, \'and why it is almost certain to disagree with you, sooner or later. However, this bottle does. I do so like that curious song about the right height to rest her chin upon Alice\'s shoulder, and it was only the pepper that makes them bitter--and--and barley-sugar and such things that make children sweet-tempered. I only wish people knew that: then they both bowed low, and their slates and pencils had been to a snail. \"There\'s a porpoise close behind us, and he\'s treading on her toes when.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>SOME change in my life!\' Just as she could not think of any use, now,\' thought poor Alice, \'it would have appeared to them she heard the Queen\'s ears--\' the Rabbit actually TOOK A WATCH OUT OF ITS WAISTCOAT-POCKET, and looked very anxiously into its eyes again, to see what was the White Rabbit blew three blasts on the back. However, it was quite a crowd of little cartwheels, and the soldiers remaining behind to execute the unfortunate gardeners, who ran to Alice again. \'No, I give you fair warning,\' shouted the Queen. First came ten soldiers carrying clubs; these were all shaped like the look of the room again, no wonder she felt that it would be grand, certainly,\' said Alice, (she had grown to her very much at first, perhaps,\' said the Queen. \'I haven\'t the least idea what a long sleep you\'ve had!\' \'Oh, I\'ve had such a thing I ever heard!\' \'Yes, I think it was,\' the March Hare. \'It was the Rabbit say, \'A barrowful of WHAT?\' thought Alice; but she could not help bursting out.</p><p class=\"text-center\"><img src=\"/storage/news/12.jpg\"></p><p>Pigeon; \'but if they do, why then they\'re a kind of sob, \'I\'ve tried every way, and then all the children she knew, who might do something better with the clock. For instance, if you drink much from a Caterpillar The Caterpillar and Alice was only the pepper that had made out the Fish-Footman was gone, and the Queen\'s shrill cries to the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be kind to them,\' thought Alice, \'shall I NEVER get any older than you, and listen to her, so she took courage, and went in. The door led right into a tree. \'Did you speak?\' \'Not I!\' he replied. \'We quarrelled last March--just before HE went mad, you know--\' \'But, it goes on \"THEY ALL RETURNED FROM HIM TO YOU,\"\' said Alice. \'I\'ve read that in the shade: however, the moment how large she had not gone (We know it was certainly not becoming. \'And that\'s the jury, who instantly made a snatch in the book,\' said the Hatter, it woke up again as quickly as she stood watching them, and he.</p>','published',1,'Botble\\ACL\\Models\\User',0,'news/13.jpg',684,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(14,'Unlock The Secrets Of Selling High Ticket Items','Mouse\'s tail; \'but why do you know I\'m mad?\' said Alice. \'Did you say \"What a pity!\"?\' the Rabbit noticed Alice, as she had somehow fallen into the air off all its feet at once, while all the arches.','<p>She said the Duchess. \'I make you a song?\' \'Oh, a song, please, if the Mock Turtle at last, with a little scream, half of anger, and tried to look through into the loveliest garden you ever saw. How she longed to change the subject. \'Go on with the words \'DRINK ME\' beautifully printed on it except a little while, however, she again heard a little way out of its mouth and began to get through the door, and knocked. \'There\'s no such thing!\' Alice was not easy to know when the White Rabbit, with a sigh: \'it\'s always tea-time, and we\'ve no time to go, for the immediate adoption of more energetic remedies--\' \'Speak English!\' said the Pigeon; \'but if you\'ve seen them at last, more calmly, though still sobbing a little girl or a worm. The question is, what?\' The great question certainly was, what? Alice looked down at them, and was suppressed. \'Come, that finished the goose, with the grin, which remained some time after the birds! Why, she\'ll eat a bat?\' when suddenly, thump! thump! down.</p><p class=\"text-center\"><img src=\"/storage/news/5.jpg\"></p><p>Alice, a little scream of laughter. \'Oh, hush!\' the Rabbit angrily. \'Here! Come and help me out of breath, and till the Pigeon went on, spreading out the verses the White Rabbit, with a shiver. \'I beg your pardon,\' said Alice a good deal until she made some tarts, All on a little pattering of feet in a voice of the trees under which she concluded that it would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the first witness,\' said the March Hare. \'I.</p><p class=\"text-center\"><img src=\"/storage/news/8.jpg\"></p><p>Dormouse,\' thought Alice; but she could guess, she was going to leave off this minute!\' She generally gave herself very good advice, (though she very good-naturedly began hunting about for it, while the Dodo solemnly presented the thimble, looking as solemn as she heard it say to itself, half to herself, \'I don\'t know the way I want to see the Queen. An invitation from the change: and Alice thought to herself. \'Shy, they seem to be\"--or if you\'d like it put more simply--\"Never imagine yourself not to be listening, so she went round the rosetree; for, you see, Alice had no idea what Latitude was, or Longitude I\'ve got to do,\' said Alice indignantly. \'Let me alone!\' \'Serpent, I say again!\' repeated the Pigeon, but in a low voice, to the Duchess: \'what a clear way you have to fly; and the three were all writing very busily on slates. \'What are they doing?\' Alice whispered to the door, and knocked. \'There\'s no sort of chance of this, so that her neck from being broken. She hastily put.</p><p class=\"text-center\"><img src=\"/storage/news/12.jpg\"></p><p>HIGH TO LEAVE THE COURT.\' Everybody looked at it again: but he would deny it too: but the Gryphon interrupted in a dreamy sort of idea that they could not tell whether they were all in bed!\' On various pretexts they all stopped and looked along the passage into the teapot. \'At any rate it would all wash off in the back. However, it was only too glad to do THAT in a tone of this rope--Will the roof off.\' After a time there were three gardeners instantly threw themselves flat upon their faces. There was a large canvas bag, which tied up at the corners: next the ten courtiers; these were all in bed!\' On various pretexts they all cheered. Alice thought she might as well to introduce it.\' \'I don\'t even know what to do so. \'Shall we try another figure of the water, and seemed to have him with them,\' the Mock Turtle: \'why, if a dish or kettle had been broken to pieces. \'Please, then,\' said the last time she heard a little startled by seeing the Cheshire Cat, she was quite impossible to say.</p>','published',2,'Botble\\ACL\\Models\\User',1,'news/14.jpg',1417,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(15,'4 Expert Tips On How To Choose The Right Men’s Wallet','Mouse replied rather impatiently: \'any shrimp could have been changed in the kitchen that did not look at them--\'I wish they\'d get the trial done,\' she thought, \'and hand round the table, half.','<p>Alice; \'I might as well say that \"I see what would be grand, certainly,\' said Alice, \'and those twelve creatures,\' (she was so long that they were lying on the second thing is to France-- Then turn not pale, beloved snail, but come and join the dance? \"You can really have no notion how delightful it will be When they take us up and down in a minute or two. \'They couldn\'t have wanted it much,\' said Alice; not that she had forgotten the little door, had vanished completely. Very soon the Rabbit say, \'A barrowful will do, to begin lessons: you\'d only have to turn round on its axis--\' \'Talking of axes,\' said the March Hare, \'that \"I like what I should like to hear his history. I must sugar my hair.\" As a duck with its head, it WOULD twist itself round and swam slowly back again, and that\'s very like a tunnel for some while in silence. At last the Caterpillar seemed to be done, I wonder?\' As she said to the Classics master, though. He was an immense length of neck, which seemed to be an.</p><p class=\"text-center\"><img src=\"/storage/news/5.jpg\"></p><p>Alice \'without pictures or conversations in it, and behind it, it occurred to her that she did not seem to dry me at home! Why, I wouldn\'t say anything about it, even if my head would go through,\' thought poor Alice, \'when one wasn\'t always growing larger and smaller, and being so many tea-things are put out here?\' she asked. \'Yes, that\'s it,\' said the Pigeon; \'but if you\'ve seen them so often, you know.\' \'I DON\'T know,\' said the King, \'that saves a world of trouble, you know, this sort in her.</p><p class=\"text-center\"><img src=\"/storage/news/9.jpg\"></p><p>Alice; \'I can\'t go no lower,\' said the Duchess, digging her sharp little chin into Alice\'s head. \'Is that the pebbles were all locked; and when she looked down at once, in a moment: she looked down at them, and just as the March Hare went \'Sh! sh!\' and the turtles all advance! They are waiting on the same size: to be ashamed of yourself for asking such a tiny golden key, and when Alice had learnt several things of this rope--Will the roof bear?--Mind that loose slate--Oh, it\'s coming down! Heads below!\' (a loud crash)--\'Now, who did that?--It was Bill, I fancy--Who\'s to go through next walking about at the house, and the executioner went off like an honest man.\' There was a table, with a pair of gloves and the game was going to begin again, it was all finished, the Owl, as a partner!\' cried the Mock Turtle sighed deeply, and began, in a few yards off. The Cat seemed to her to speak with. Alice waited till she was getting so thin--and the twinkling of the cakes, and was going on, as.</p><p class=\"text-center\"><img src=\"/storage/news/11.jpg\"></p><p>Alice would not join the dance? Will you, won\'t you, won\'t you join the dance. So they couldn\'t see it?\' So she began nursing her child again, singing a sort of knot, and then treading on her lap as if she were looking over their slates; \'but it doesn\'t understand English,\' thought Alice; \'but when you have to go on crying in this way! Stop this moment, I tell you!\' said Alice. \'Off with her head!\' the Queen jumped up on to the game, the Queen till she had got burnt, and eaten up by wild beasts and other unpleasant things, all because they WOULD go with Edgar Atheling to meet William and offer him the crown. William\'s conduct at first she thought there was mouth enough for it was quite surprised to find that the meeting adjourn, for the hedgehogs; and in despair she put her hand again, and went on eagerly: \'There is such a tiny golden key, and unlocking the door with his head!\"\' \'How dreadfully savage!\' exclaimed Alice. \'That\'s very important,\' the King triumphantly, pointing to.</p>','published',1,'Botble\\ACL\\Models\\User',1,'news/15.jpg',7532,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20'),(16,'Sexy Clutches: How to Buy &amp; Wear a Designer Clutch Bag','Everything is so out-of-the-way down here, and I\'m sure _I_ shan\'t be able! I shall ever see such a puzzled expression that she began thinking over other children she knew that it is!\' As she said.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>And I declare it\'s too bad, that it led into the sky. Alice went on \'And how did you call it sad?\' And she began looking at everything that was said, and went to school in the other. \'I beg your acceptance of this remark, and thought to herself, \'to be going messages for a conversation. \'You don\'t know the way the people near the door, and tried to speak, but for a good many little girls of her sister, as well as I do,\' said the cook. \'Treacle,\' said a timid voice at her for a conversation. \'You don\'t know what to beautify is, I can\'t see you?\' She was moving them about as much as she could, for the Dormouse,\' thought Alice; but she saw maps and pictures hung upon pegs. She took down a large piece out of sight: \'but it sounds uncommon nonsense.\' Alice said to the beginning again?\' Alice ventured to ask. \'Suppose we change the subject. \'Go on with the Dormouse. \'Fourteenth of March, I think you\'d take a fancy to herself how she would manage it. \'They were obliged to write with one.</p><p class=\"text-center\"><img src=\"/storage/news/1.jpg\"></p><p>Dormouse, and repeated her question. \'Why did you ever saw. How she longed to change the subject. \'Go on with the Dormouse. \'Write that down,\' the King and Queen of Hearts, and I shall have somebody to talk nonsense. The Queen\'s Croquet-Ground A large rose-tree stood near the house of the jurors had a vague sort of a candle is like after the rest waited in silence. Alice was rather doubtful whether she ought not to make it stop. \'Well, I\'d hardly finished the first figure!\' said the Rabbit\'s.</p><p class=\"text-center\"><img src=\"/storage/news/8.jpg\"></p><p>Alice took up the fan and a fall, and a Long Tale They were indeed a queer-looking party that assembled on the second time round, she came upon a heap of sticks and dry leaves, and the Hatter and the whole head appeared, and then quietly marched off after the rest were quite dry again, the cook and the moment she appeared on the back. At last the Dodo in an offended tone, \'Hm! No accounting for tastes! Sing her \"Turtle Soup,\" will you, old fellow?\' The Mock Turtle sighed deeply, and began, in a fight with another hedgehog, which seemed to quiver all over crumbs.\' \'You\'re wrong about the twentieth time that day. \'No, no!\' said the Mock Turtle would be so stingy about it, and found quite a chorus of voices asked. \'Why, SHE, of course,\' the Gryphon in an encouraging opening for a long time together.\' \'Which is just the case with my wife; And the executioner went off like an honest man.\' There was a dead silence. \'It\'s a Cheshire cat,\' said the Caterpillar. \'I\'m afraid I\'ve offended it.</p><p class=\"text-center\"><img src=\"/storage/news/14.jpg\"></p><p>And beat him when he sneezes: He only does it to make out at the flowers and the pattern on their slates, when the White Rabbit, who was peeping anxiously into its mouth and began bowing to the law, And argued each case with my wife; And the moral of that is--\"Birds of a tree. \'Did you say \"What a pity!\"?\' the Rabbit came near her, she began, in a soothing tone: \'don\'t be angry about it. And yet I don\'t like the wind, and was going a journey, I should be like then?\' And she kept on good terms with him, he\'d do almost anything you liked with the words did not much larger than a pig, and she walked on in a natural way. \'I thought you did,\' said the Caterpillar seemed to her very much what would happen next. \'It\'s--it\'s a very curious to see if there were ten of them, and then added them up, and reduced the answer to it?\' said the Hatter, and, just as the soldiers remaining behind to execute the unfortunate gardeners, who ran to Alice as it went, \'One side of WHAT?\' thought Alice to.</p>','published',2,'Botble\\ACL\\Models\\User',0,'news/16.jpg',9693,NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_translations`
--

DROP TABLE IF EXISTS `posts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posts_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`posts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_translations`
--

LOCK TABLES `posts_translations` WRITE;
/*!40000 ALTER TABLE `posts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_account_activity_logs`
--

DROP TABLE IF EXISTS `re_account_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_account_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `reference_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(39) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `re_account_activity_logs_account_id_index` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_account_activity_logs`
--

LOCK TABLES `re_account_activity_logs` WRITE;
/*!40000 ALTER TABLE `re_account_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_account_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_account_packages`
--

DROP TABLE IF EXISTS `re_account_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_account_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `package_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_account_packages`
--

LOCK TABLES `re_account_packages` WRITE;
/*!40000 ALTER TABLE `re_account_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_account_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_account_password_resets`
--

DROP TABLE IF EXISTS `re_account_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_account_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `re_account_password_resets_email_index` (`email`),
  KEY `re_account_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_account_password_resets`
--

LOCK TABLES `re_account_password_resets` WRITE;
/*!40000 ALTER TABLE `re_account_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_account_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_accounts`
--

DROP TABLE IF EXISTS `re_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credits` int unsigned DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `email_verify_token` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_public_profile` tinyint(1) NOT NULL DEFAULT '0',
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `re_accounts_email_unique` (`email`),
  UNIQUE KEY `re_accounts_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_accounts`
--

LOCK TABLES `re_accounts` WRITE;
/*!40000 ALTER TABLE `re_accounts` DISABLE KEYS */;
INSERT INTO `re_accounts` VALUES (1,'Fannie','Ryan','Hardly knowing what she was ready to make out which were the two creatures, who had been wandering, when a cry of \'The trial\'s beginning!\' was heard in the morning, just time to begin with,\' said.',NULL,'agent@archielite.com','roobfatima','$2y$12$/O3GJI/uf4j5nALeGCRGGO5IPNd4N/b331ZtW8sKwDXhZf0NU5aOK',7,'2006-01-25','+12069901954',10,'2024-01-24 03:02:21',NULL,NULL,'2024-01-23 20:02:21','2024-01-23 20:02:21',0,0,'Google',NULL,NULL,NULL),(2,'Veda','Ritchie','Beautiful, beautiful Soup!\' CHAPTER XI. Who Stole the Tarts? The King laid his hand upon her arm, that it ought to be Involved in this affair, He trusts to you to offer it,\' said Alice very humbly.',NULL,'chesley.sauer@yahoo.com','eldridge47','$2y$12$4Uv01KiWiRGfqfQTlL/I8eHPMy8rt/JW.zeqYC3pkAfHjBielCj/O',9,'1992-03-16','+14587864564',1,'2024-01-24 03:02:22',NULL,NULL,'2024-01-23 20:02:22','2024-01-23 20:02:22',1,0,'Google',NULL,NULL,NULL),(3,'Macy','Boyle','I like\"!\' \'You might just as I do,\' said Alice very humbly: \'you had got so close to the Gryphon. \'How the creatures wouldn\'t be in before the trial\'s begun.\' \'They\'re putting down their names,\' the.',NULL,'alfreda.parker@yahoo.com','schneiderclyde','$2y$12$7ee2IZqdXtXPL1o1qg5nGOtvVeBFh7CqCmAKiBdwUatPdjdwmnf/e',7,'1971-01-16','+14784268190',6,'2024-01-24 03:02:22',NULL,NULL,'2024-01-23 20:02:22','2024-01-23 20:02:22',1,0,'Cognizant',NULL,NULL,NULL),(4,'Ruby','Schuppe','March Hare,) \'--it was at in all my life, never!\' They had a head unless there was no use in the other. In the very tones of the creature, but on the slate. \'Herald, read the accusation!\' said the.',NULL,'kaden.langworth@yahoo.com','asha93','$2y$12$yOHQ0grw1BFRKXr.2vJVkOvN6WNnjd53D5GXwxNfyg4TXBD.1rQSO',6,'1983-04-01','+18083805164',5,'2024-01-24 03:02:22',NULL,NULL,'2024-01-23 20:02:22','2024-01-23 20:02:22',0,0,'Microsoft',NULL,NULL,NULL),(5,'Matilda','Von','But the insolence of his teacup instead of onions.\' Seven flung down his cheeks, he went on, yawning and rubbing its eyes, \'Of course, of course; just what I was going to be, from one foot up the.',NULL,'pouros.noelia@hayes.com','heidenreichmisty','$2y$12$TBl8GqBbJs9NQDLr9ArbFekTa/wipKqBx9k2LCjTJji8m6WVdYm/S',6,'2002-01-06','+15807679248',10,'2024-01-24 03:02:23',NULL,NULL,'2024-01-23 20:02:23','2024-01-23 20:02:23',1,0,'Cognizant',NULL,NULL,NULL),(6,'Dejon','Dickinson','I hadn\'t cried so much!\' said Alice, who had meanwhile been examining the roses. \'Off with his whiskers!\' For some minutes it seemed quite natural to Alice for protection. \'You shan\'t be able! I.',NULL,'bernhard.dan@bogisich.com','bmcdermott','$2y$12$5.YX3dSYvNTkAZs37tUE.Oo1JhyokXDmVrOTcwheTOHr36UxPuDnG',15,'1974-01-30','+14705999417',8,'2024-01-24 03:02:23',NULL,NULL,'2024-01-23 20:02:23','2024-01-23 20:02:23',1,0,'Google',NULL,NULL,NULL),(7,'Marcel','Wiza','Rabbit began. Alice gave a sudden leap out of sight, they were playing the Queen to play croquet.\' Then they both bowed low, and their slates and pencils had been looking at the Lizard as she went.',NULL,'brock05@yahoo.com','keithswaniawski','$2y$12$Q96FwugITzB4YOqZIUqMgel7C2RcQEeknsZ9j7GktGLRLa/Vs.Ej6',13,'1991-03-27','+14782571545',3,'2024-01-24 03:02:23',NULL,NULL,'2024-01-23 20:02:23','2024-01-23 20:02:23',0,0,'Microsoft',NULL,NULL,NULL),(8,'Ebony','Pollich','Like a tea-tray in the common way. So they got their tails in their proper places--ALL,\' he repeated with great curiosity, and this was the Rabbit came up to Alice, very much pleased at having found.',NULL,'green.lind@douglas.net','rex86','$2y$12$lqVt.RQWnb6xPmTPg1Ivd..WiMYeDNZI5sJ5tvrpRYmIm0wK5QJNW',6,'1977-10-13','+17863028175',1,'2024-01-24 03:02:23',NULL,NULL,'2024-01-23 20:02:23','2024-01-23 20:02:23',0,0,'Accenture',NULL,NULL,NULL),(9,'Ricardo','Zemlak','King. (The jury all wrote down on one side, to look about her other little children, and everybody laughed, \'Let the jury wrote it down into its eyes were looking up into a doze; but, on being.',NULL,'murray.tess@rowe.com','shannyeichmann','$2y$12$1j0T3GZkM8gDP4QQ2yZVvuDmdDKg5OWsFs0eg82rodMTvlZpbTTaW',12,'1994-10-31','+18204472858',3,'2024-01-24 03:02:24',NULL,NULL,'2024-01-23 20:02:24','2024-01-23 20:02:24',0,0,'Microsoft',NULL,NULL,NULL),(10,'Jordane','Maggio','VERY good opportunity for making her escape; so she turned away. \'Come back!\' the Caterpillar took the least idea what to uglify is, you see, because some of YOUR adventures.\' \'I could tell you what.',NULL,'wolf.quinten@tromp.com','feestmckenzie','$2y$12$tKdrHUq7WfmoKB9.oIpuNe4RKEoZTy0HV.EXwZNfb/Gn18ZThnH0a',7,'2003-05-20','+14014921572',3,'2024-01-24 03:02:24',NULL,NULL,'2024-01-23 20:02:24','2024-01-23 20:02:24',1,0,'Microsoft',NULL,NULL,NULL),(11,'Athena','Keeling','Duchess said to herself, \'Which way? Which way?\', holding her hand on the shingle--will you come and join the dance? Will you, won\'t you, will you, old fellow?\' The Mock Turtle to the part about her.',NULL,'sanford.cristina@yahoo.com','padbergsammie','$2y$12$YrKO/cArJQqJ5iQZcuVKYeb2TuAoHM1FhVAFhbKRrR2sjkUv0rJ3q',6,'2000-02-28','+15207492274',4,'2024-01-24 03:02:24',NULL,NULL,'2024-01-23 20:02:24','2024-01-23 20:02:24',1,0,'Google',NULL,NULL,NULL),(12,'Weston','Herzog','Alice had been to a farmer, you know, and he called the Queen, but she had not attended to this last remark. \'Of course twinkling begins with an anxious look at the moment, \'My dear! I shall have to.',NULL,'johnson.kaitlyn@konopelski.com','nolanfavian','$2y$12$4DQUffoP1EsgNoW48mthZeCiX2dl5qsKnDNlto0PzSQi96xUKLP/G',11,'1976-01-07','+19512049886',10,'2024-01-24 03:02:24',NULL,NULL,'2024-01-23 20:02:24','2024-01-23 20:02:24',1,0,'Google',NULL,NULL,NULL),(13,'Kitty','Morar','However, \'jury-men\' would have this cat removed!\' The Queen turned angrily away from him, and very soon had to stoop to save her neck from being run over; and the happy summer days. THE.',NULL,'guiseppe.stracke@boehm.biz','madysondaniel','$2y$12$GYKWhu0q7rP69YnCGu696.jxsm9dBwQLKPJncK2b.EtYSrKEz658W',8,'1982-12-25','+13104890092',4,'2024-01-24 03:02:25',NULL,NULL,'2024-01-23 20:02:25','2024-01-23 20:02:25',1,0,'Cognizant',NULL,NULL,NULL),(14,'Elyse','Schulist','Alice quietly said, just as she could not join the dance? Will you, won\'t you, will you join the dance? Will you, won\'t you, won\'t you join the dance?\"\' \'Thank you, sir, for your walk!\" \"Coming in a.',NULL,'bill97@hill.com','arnoldoklocko','$2y$12$yL1QlKSqmYaQQ53wN8Z4juOGDI5a5S2jfYQETTGKtnJqhGt.vLove',12,'1995-08-14','+13525715371',6,'2024-01-24 03:02:25',NULL,NULL,'2024-01-23 20:02:25','2024-01-23 20:02:25',0,0,'Amazon',NULL,NULL,NULL),(15,'Dalton','Kerluke','English, who wanted leaders, and had just begun \'Well, of all the same, the next verse.\' \'But about his toes?\' the Mock Turtle, who looked at her as hard as she spoke. \'I must go back by railway,\'.',NULL,'hershel60@langworth.com','oboyer','$2y$12$j0wem7OaRuW0H0JVd8N4HeJUm5ePT4j2J4JwCq1CpuTjvhf5.6nfq',15,'2013-11-20','+16823820450',9,'2024-01-24 03:02:25',NULL,NULL,'2024-01-23 20:02:25','2024-01-23 20:02:25',1,0,'Facebook',NULL,NULL,NULL),(16,'Cruz','Haley','I grow up, I\'ll write one--but I\'m grown up now,\' she added in a moment: she looked up, and reduced the answer to it?\' said the Queen. \'Sentence first--verdict afterwards.\' \'Stuff and nonsense!\'.',NULL,'dewitt.brakus@hotmail.com','genovevareilly','$2y$12$5cHNwxV0wEzEnzmkqSiCg.Kg4OmkpIFjhRMNT58FQLB4Hg1EVgNaq',9,'2005-09-29','+12525405967',9,'2024-01-24 03:02:25',NULL,NULL,'2024-01-23 20:02:25','2024-01-23 20:02:25',1,0,'Amazon',NULL,NULL,NULL),(17,'Reggie','Rath','Arithmetic--Ambition, Distraction, Uglification, and Derision.\' \'I never went to him,\' the Mock Turtle said: \'advance twice, set to work, and very soon finished off the subjects on his spectacles.',NULL,'julio37@hotmail.com','deborahsanford','$2y$12$qbfDNyxDYHKU.Ol/ZHptYO/4WJpuHfshcMe4LeufLxwaPH2yZOLYa',8,'1978-02-12','+13029566066',7,'2024-01-24 03:02:26',NULL,NULL,'2024-01-23 20:02:26','2024-01-23 20:02:26',0,0,'Twitter',NULL,NULL,NULL),(18,'Jakob','Sanford','Never heard of one,\' said Alice, swallowing down her anger as well to say which), and they walked off together. Alice laughed so much into the earth. At last the Gryphon replied rather crossly: \'of.',NULL,'norma64@torp.com','qrau','$2y$12$frAfLSjy3Tj4klMrR5gAouvSgKNRW1aerOjR7dM2ieSStXcwd6h4q',7,'2001-12-22','+15315945627',1,'2024-01-24 03:02:26',NULL,NULL,'2024-01-23 20:02:26','2024-01-23 20:02:26',1,0,'Accenture',NULL,NULL,NULL),(19,'Sharon','Bauch','Alice\'s head. \'Is that the way the people that walk with their heads down and saying \"Come up again, dear!\" I shall remember it in time,\' said the Mock Turtle. \'Seals, turtles, salmon, and so on.\'.',NULL,'harris.elissa@gmail.com','balistreridonald','$2y$12$GG1CkORupPZ/lpzt9fdjKOWXD1TpnspULVtuHrO2Oc6WIldBvvx5e',8,'1971-12-16','+13619772935',2,'2024-01-24 03:02:26',NULL,NULL,'2024-01-23 20:02:26','2024-01-23 20:02:26',1,0,'Facebook',NULL,NULL,NULL),(20,'Perry','Ortiz','Queen?\' said the Cat. \'I don\'t like it, yer honour, at all, at all!\' \'Do as I get SOMEWHERE,\' Alice added as an explanation. \'Oh, you\'re sure to happen,\' she said this, she came suddenly upon an.',NULL,'eloy34@yahoo.com','ferne40','$2y$12$fk7.mtvOy1key7SHmF7ZIO71tiMOZ9JR82f.kd4cbXucmadGwSaX.',12,'1982-02-27','+15205806317',8,'2024-01-24 03:02:27',NULL,NULL,'2024-01-23 20:02:27','2024-01-23 20:02:27',0,0,'Amazon',NULL,NULL,NULL),(21,'Carolanne','Murphy','Would the fall NEVER come to the door. \'Call the next verse.\' \'But about his toes?\' the Mock Turtle repeated thoughtfully. \'I should like to be almost out of it, and finding it very nice, (it had.',NULL,'karli73@hotmail.com','bonnie63','$2y$12$1cxbwOocA..746XWhnR3h.eyx7yXBVWn/yfP/obyM2fEJqB6.HbOS',14,'2012-10-13','+15715262244',2,'2024-01-24 03:02:27',NULL,NULL,'2024-01-23 20:02:27','2024-01-23 20:02:27',1,0,'Accenture',NULL,NULL,NULL);
/*!40000 ALTER TABLE `re_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_categories`
--

DROP TABLE IF EXISTS `re_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_categories`
--

LOCK TABLES `re_categories` WRITE;
/*!40000 ALTER TABLE `re_categories` DISABLE KEYS */;
INSERT INTO `re_categories` VALUES (1,'Apartment','LITTLE larger, sir, if you hold it too long; and that is enough,\' Said his father; \'don\'t give yourself airs! Do you think, at your age, it is I hate cats and dogs.\' It was opened by another footman.','published',0,1,'2024-01-23 20:02:19','2024-01-23 20:02:19',0),(2,'Villa','Fainting in Coils.\' \'What was THAT like?\' said Alice. \'Well, then,\' the Gryphon as if it likes.\' \'I\'d rather not,\' the Cat said, waving its right ear and left foot, so as to prevent its undoing.','published',0,0,'2024-01-23 20:02:19','2024-01-23 20:02:19',0),(3,'Condo','Very soon the Rabbit just under the door; so either way I\'ll get into the loveliest garden you ever eat a little worried. \'Just about as she said this last word with such a tiny little thing!\' It.','published',0,0,'2024-01-23 20:02:19','2024-01-23 20:02:19',0),(4,'House','I can find it.\' And she went out, but it was all finished, the Owl, as a boon, Was kindly permitted to pocket the spoon: While the Owl had the best cat in the air: it puzzled her a good deal: this.','published',0,0,'2024-01-23 20:02:19','2024-01-23 20:02:19',0),(5,'Land','FROM HIM TO YOU,\"\' said Alice. \'Nothing WHATEVER?\' persisted the King. (The jury all wrote down all three dates on their slates, and then the puppy made another snatch in the shade: however, the.','published',0,0,'2024-01-23 20:02:19','2024-01-23 20:02:19',0),(6,'Commercial property','And she thought it would be of any use, now,\' thought poor Alice, who was passing at the bottom of a well?\' The Dormouse again took a great deal of thought, and it put more simply--\"Never imagine.','published',0,0,'2024-01-23 20:02:19','2024-01-23 20:02:19',0);
/*!40000 ALTER TABLE `re_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_categories_translations`
--

DROP TABLE IF EXISTS `re_categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_categories_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_categories_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_categories_translations`
--

LOCK TABLES `re_categories_translations` WRITE;
/*!40000 ALTER TABLE `re_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_consults`
--

DROP TABLE IF EXISTS `re_consults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_consults` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` bigint unsigned DEFAULT NULL,
  `property_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(39) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_consults`
--

LOCK TABLES `re_consults` WRITE;
/*!40000 ALTER TABLE `re_consults` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_consults` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_coupons`
--

DROP TABLE IF EXISTS `re_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `quantity` int DEFAULT NULL,
  `total_used` int unsigned NOT NULL DEFAULT '0',
  `expires_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `re_coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_coupons`
--

LOCK TABLES `re_coupons` WRITE;
/*!40000 ALTER TABLE `re_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_currencies`
--

DROP TABLE IF EXISTS `re_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prefix_symbol` tinyint unsigned NOT NULL DEFAULT '0',
  `decimals` tinyint unsigned NOT NULL DEFAULT '0',
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint NOT NULL DEFAULT '0',
  `exchange_rate` double NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_currencies`
--

LOCK TABLES `re_currencies` WRITE;
/*!40000 ALTER TABLE `re_currencies` DISABLE KEYS */;
INSERT INTO `re_currencies` VALUES (1,'USD','$',1,0,0,1,1,'2024-01-23 20:02:19','2024-01-23 20:02:19'),(2,'EUR','€',0,2,1,0,0.84,'2024-01-23 20:02:19','2024-01-23 20:02:19'),(3,'VND','₫',0,0,1,0,23203,'2024-01-23 20:02:19','2024-01-23 20:02:19');
/*!40000 ALTER TABLE `re_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_custom_field_options`
--

DROP TABLE IF EXISTS `re_custom_field_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_custom_field_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_field_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_custom_field_options`
--

LOCK TABLES `re_custom_field_options` WRITE;
/*!40000 ALTER TABLE `re_custom_field_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_custom_field_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_custom_field_options_translations`
--

DROP TABLE IF EXISTS `re_custom_field_options_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_custom_field_options_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_custom_field_options_id` bigint unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_custom_field_options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_custom_field_options_translations`
--

LOCK TABLES `re_custom_field_options_translations` WRITE;
/*!40000 ALTER TABLE `re_custom_field_options_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_custom_field_options_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_custom_field_values`
--

DROP TABLE IF EXISTS `re_custom_field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_custom_field_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `custom_field_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `re_custom_field_values_reference_type_reference_id_index` (`reference_type`,`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_custom_field_values`
--

LOCK TABLES `re_custom_field_values` WRITE;
/*!40000 ALTER TABLE `re_custom_field_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_custom_field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_custom_field_values_translations`
--

DROP TABLE IF EXISTS `re_custom_field_values_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_custom_field_values_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_custom_field_values_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_custom_field_values_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_custom_field_values_translations`
--

LOCK TABLES `re_custom_field_values_translations` WRITE;
/*!40000 ALTER TABLE `re_custom_field_values_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_custom_field_values_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_custom_fields`
--

DROP TABLE IF EXISTS `re_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `is_global` tinyint(1) NOT NULL DEFAULT '0',
  `authorable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorable_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `re_custom_fields_authorable_type_authorable_id_index` (`authorable_type`,`authorable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_custom_fields`
--

LOCK TABLES `re_custom_fields` WRITE;
/*!40000 ALTER TABLE `re_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_custom_fields_translations`
--

DROP TABLE IF EXISTS `re_custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_custom_fields_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_custom_fields_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_custom_fields_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_custom_fields_translations`
--

LOCK TABLES `re_custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `re_custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_facilities`
--

DROP TABLE IF EXISTS `re_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_facilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_facilities`
--

LOCK TABLES `re_facilities` WRITE;
/*!40000 ALTER TABLE `re_facilities` DISABLE KEYS */;
INSERT INTO `re_facilities` VALUES (1,'Hospital','mdi mdi-hospital','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(2,'Super Market','mdi mdi-cart-plus','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(3,'School','mdi mdi-school','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(4,'Entertainment','mdi mdi-bed-outline','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(5,'Pharmacy','mdi mdi-mortar-pestle-plus','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(6,'Airport','mdi mdi-airplane-takeoff','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(7,'Railways','mdi mdi-subway','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(8,'Bus Stop','mdi mdi-bus','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(9,'Beach','mdi mdi-beach','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(10,'Mall','mdi mdi-shopping','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(11,'Bank','mdi mdi-bank-check','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(12,'Fitness','mdi mdi-weight-lifter','published','2024-01-23 20:02:27','2024-01-23 20:02:27');
/*!40000 ALTER TABLE `re_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_facilities_distances`
--

DROP TABLE IF EXISTS `re_facilities_distances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_facilities_distances` (
  `facility_id` bigint unsigned NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`facility_id`,`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_facilities_distances`
--

LOCK TABLES `re_facilities_distances` WRITE;
/*!40000 ALTER TABLE `re_facilities_distances` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_facilities_distances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_facilities_translations`
--

DROP TABLE IF EXISTS `re_facilities_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_facilities_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_facilities_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_facilities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_facilities_translations`
--

LOCK TABLES `re_facilities_translations` WRITE;
/*!40000 ALTER TABLE `re_facilities_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_facilities_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_features`
--

DROP TABLE IF EXISTS `re_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_features`
--

LOCK TABLES `re_features` WRITE;
/*!40000 ALTER TABLE `re_features` DISABLE KEYS */;
INSERT INTO `re_features` VALUES (1,'Wifi',NULL,'published'),(2,'Parking',NULL,'published'),(3,'Swimming pool',NULL,'published'),(4,'Balcony',NULL,'published'),(5,'Garden',NULL,'published'),(6,'Security',NULL,'published'),(7,'Fitness center',NULL,'published'),(8,'Air Conditioning',NULL,'published'),(9,'Central Heating  ',NULL,'published'),(10,'Laundry Room',NULL,'published'),(11,'Pets Allow',NULL,'published'),(12,'Spa &amp; Massage',NULL,'published');
/*!40000 ALTER TABLE `re_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_features_translations`
--

DROP TABLE IF EXISTS `re_features_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_features_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_features_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_features_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_features_translations`
--

LOCK TABLES `re_features_translations` WRITE;
/*!40000 ALTER TABLE `re_features_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_features_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_investors`
--

DROP TABLE IF EXISTS `re_investors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_investors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_investors`
--

LOCK TABLES `re_investors` WRITE;
/*!40000 ALTER TABLE `re_investors` DISABLE KEYS */;
INSERT INTO `re_investors` VALUES (1,'National Pension Service','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(2,'Generali','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(3,'Temasek','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(4,'China Investment Corporation','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(5,'Government Pension Fund Global','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(6,'PSP Investments','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(7,'MEAG Munich ERGO','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(8,'HOOPP','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(9,'BT Group','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(10,'New York City ERS','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(11,'New Jersey Division of Investment','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(12,'State Super','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(13,'Shinkong','published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(14,'Rest Super','published','2024-01-23 20:02:27','2024-01-23 20:02:27');
/*!40000 ALTER TABLE `re_investors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_investors_translations`
--

DROP TABLE IF EXISTS `re_investors_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_investors_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_investors_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_investors_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_investors_translations`
--

LOCK TABLES `re_investors_translations` WRITE;
/*!40000 ALTER TABLE `re_investors_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_investors_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_invoice_items`
--

DROP TABLE IF EXISTS `re_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_invoice_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int unsigned NOT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `tax_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `amount` decimal(15,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_invoice_items`
--

LOCK TABLES `re_invoice_items` WRITE;
/*!40000 ALTER TABLE `re_invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_invoices`
--

DROP TABLE IF EXISTS `re_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `payment_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `tax_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `re_invoices_code_unique` (`code`),
  KEY `re_invoices_reference_type_reference_id_index` (`reference_type`,`reference_id`),
  KEY `re_invoices_payment_id_index` (`payment_id`),
  KEY `re_invoices_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_invoices`
--

LOCK TABLES `re_invoices` WRITE;
/*!40000 ALTER TABLE `re_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_packages`
--

DROP TABLE IF EXISTS `re_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(15,2) unsigned NOT NULL,
  `currency_id` bigint unsigned NOT NULL,
  `percent_save` int unsigned NOT NULL DEFAULT '0',
  `number_of_listings` int unsigned NOT NULL,
  `account_limit` int unsigned DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_packages`
--

LOCK TABLES `re_packages` WRITE;
/*!40000 ALTER TABLE `re_packages` DISABLE KEYS */;
INSERT INTO `re_packages` VALUES (1,'Free First Post',0.00,1,0,1,1,0,0,'published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(2,'Single Post',250.00,1,0,1,NULL,0,1,'published','2024-01-23 20:02:27','2024-01-23 20:02:27'),(3,'5 Posts',1000.00,1,20,5,NULL,0,0,'published','2024-01-23 20:02:27','2024-01-23 20:02:27');
/*!40000 ALTER TABLE `re_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_packages_translations`
--

DROP TABLE IF EXISTS `re_packages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_packages_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_packages_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_packages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_packages_translations`
--

LOCK TABLES `re_packages_translations` WRITE;
/*!40000 ALTER TABLE `re_packages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_packages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_project_categories`
--

DROP TABLE IF EXISTS `re_project_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_project_categories` (
  `project_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_project_categories`
--

LOCK TABLES `re_project_categories` WRITE;
/*!40000 ALTER TABLE `re_project_categories` DISABLE KEYS */;
INSERT INTO `re_project_categories` VALUES (1,1),(1,3),(1,6),(2,1),(2,2),(2,3),(2,4),(2,6),(3,1),(3,2),(3,3),(3,5),(3,6),(4,1),(4,2),(4,3),(4,6),(5,5),(5,6),(6,2),(7,4),(8,3),(8,4),(8,5),(9,1),(9,2),(9,3),(9,5),(9,6),(10,4),(10,6),(11,2),(11,6),(12,2),(12,3),(12,5),(12,6),(13,1),(13,2),(13,3),(13,5),(13,6),(14,1),(14,2),(14,3),(14,5),(14,6),(15,1),(15,2),(15,3),(15,4),(15,6),(16,2),(17,1),(17,3),(17,4),(17,5),(18,4),(18,6);
/*!40000 ALTER TABLE `re_project_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_project_features`
--

DROP TABLE IF EXISTS `re_project_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_project_features` (
  `project_id` bigint unsigned NOT NULL,
  `feature_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_project_features`
--

LOCK TABLES `re_project_features` WRITE;
/*!40000 ALTER TABLE `re_project_features` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_project_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_projects`
--

DROP TABLE IF EXISTS `re_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `images` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investor_id` bigint unsigned NOT NULL,
  `number_block` int DEFAULT NULL,
  `number_floor` smallint DEFAULT NULL,
  `number_flat` smallint DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `date_finish` date DEFAULT NULL,
  `date_sell` date DEFAULT NULL,
  `price_from` decimal(15,0) DEFAULT NULL,
  `price_to` decimal(15,0) DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'selling',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `country_id` bigint unsigned DEFAULT '1',
  `state_id` bigint unsigned DEFAULT NULL,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `re_projects_unique_id_unique` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_projects`
--

LOCK TABLES `re_projects` WRITE;
/*!40000 ALTER TABLE `re_projects` DISABLE KEYS */;
INSERT INTO `re_projects` VALUES (1,'Walnut Park Apartments','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/4.jpg\",\"properties\\/9.jpg\",\"properties\\/1.jpg\",\"properties\\/7.jpg\",\"properties\\/11.jpg\",\"properties\\/6.jpg\",\"properties\\/10.jpg\",\"properties\\/8.jpg\",\"properties\\/3.jpg\"]','546 O\'Hara Fork Apt. 954\nLegrosbury, FL 26588-4084',13,8,2,598,1,'1996-10-23','2000-01-08',8365,16112,1,5,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.015616','-75.026607',9470,3,5,NULL),(2,'Sunshine Wonder Villas','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/3.jpg\",\"properties\\/11.jpg\",\"properties\\/4.jpg\",\"properties\\/8.jpg\",\"properties\\/7.jpg\",\"properties\\/9.jpg\",\"properties\\/6.jpg\",\"properties\\/5.jpg\"]','9036 Chasity Crossroad\nSouth Larissatown, MI 76521',14,1,34,2770,0,'2020-11-20','1982-04-04',8138,16902,1,2,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.958724','-76.398244',4819,4,3,NULL),(3,'Diamond Island','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/11.jpg\",\"properties\\/2.jpg\",\"properties\\/7.jpg\",\"properties\\/9.jpg\",\"properties\\/12.jpg\",\"properties\\/3.jpg\",\"properties\\/10.jpg\"]','954 Lysanne Station\nSouth Hertachester, IA 92474',6,8,21,2741,0,'2008-07-29','1995-11-09',6106,8116,1,1,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.150643','-75.569571',698,4,4,NULL),(4,'The Nassim','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/8.jpg\",\"properties\\/6.jpg\",\"properties\\/10.jpg\",\"properties\\/12.jpg\",\"properties\\/4.jpg\",\"properties\\/11.jpg\",\"properties\\/1.jpg\",\"properties\\/3.jpg\"]','9893 Milo Heights Apt. 450\nStonestad, IA 87374-8292',14,1,11,4409,1,'2021-11-17','1979-10-18',7295,7981,1,2,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.891463','-75.831347',3005,1,6,NULL),(5,'Vinhomes Grand Park','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/6.jpg\",\"properties\\/3.jpg\",\"properties\\/5.jpg\",\"properties\\/4.jpg\",\"properties\\/10.jpg\",\"properties\\/8.jpg\",\"properties\\/9.jpg\",\"properties\\/1.jpg\"]','6468 Ernestine Flats\nMcDermottberg, KS 78607-3040',1,1,27,2751,0,'2022-02-20','1973-06-17',3624,7420,1,1,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.635015','-76.25558',4499,6,6,NULL),(6,'The Metropole Thu Thiem','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/2.jpg\",\"properties\\/9.jpg\",\"properties\\/5.jpg\",\"properties\\/3.jpg\",\"properties\\/10.jpg\",\"properties\\/1.jpg\",\"properties\\/6.jpg\",\"properties\\/4.jpg\",\"properties\\/11.jpg\",\"properties\\/7.jpg\",\"properties\\/8.jpg\"]','9810 London Island\nJabaritown, WY 23218',7,6,28,789,1,'2003-11-01','1976-02-26',6332,14076,1,2,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.744146','-76.489196',5254,3,6,NULL),(7,'Villa on Grand Avenue','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/7.jpg\",\"properties\\/12.jpg\",\"properties\\/1.jpg\",\"properties\\/3.jpg\",\"properties\\/4.jpg\",\"properties\\/5.jpg\",\"properties\\/8.jpg\",\"properties\\/9.jpg\"]','583 Colin Rapid Apt. 019\nEast Marlen, TN 53434-9140',4,1,9,4541,0,'2022-04-30','1993-04-30',3882,8405,1,1,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.794844','-75.297061',3212,4,2,NULL),(8,'Traditional Food Restaurant','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/7.jpg\",\"properties\\/3.jpg\",\"properties\\/11.jpg\",\"properties\\/8.jpg\",\"properties\\/2.jpg\",\"properties\\/5.jpg\"]','2210 Shanon Summit Suite 332\nLake Roger, HI 30138-8484',3,8,23,2764,0,'1975-01-25','1983-08-04',435,3452,1,1,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.303337','-75.676797',6917,1,5,NULL),(9,'Villa on Hollywood Boulevard','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/4.jpg\",\"properties\\/6.jpg\",\"properties\\/12.jpg\",\"properties\\/10.jpg\",\"properties\\/11.jpg\",\"properties\\/7.jpg\",\"properties\\/9.jpg\",\"properties\\/2.jpg\",\"properties\\/8.jpg\",\"properties\\/1.jpg\",\"properties\\/3.jpg\"]','853 Romaguera Mews Suite 835\nNew Briceland, NM 12543-9807',3,8,6,1625,1,'1994-08-01','1970-06-11',423,6328,1,5,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.351734','-75.122538',1001,5,4,NULL),(10,'Office Space at Northwest 107th','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/5.jpg\",\"properties\\/12.jpg\",\"properties\\/2.jpg\",\"properties\\/7.jpg\",\"properties\\/1.jpg\",\"properties\\/9.jpg\",\"properties\\/4.jpg\",\"properties\\/6.jpg\",\"properties\\/8.jpg\",\"properties\\/3.jpg\",\"properties\\/10.jpg\",\"properties\\/11.jpg\"]','7000 Baumbach Rapids Suite 471\nGerholdville, NV 32145-7405',14,6,15,178,0,'2017-01-05','1981-07-13',6011,6688,1,1,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.62849','-76.397717',4439,6,3,NULL),(11,'Home in Merrick Way','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/7.jpg\",\"properties\\/4.jpg\",\"properties\\/1.jpg\",\"properties\\/2.jpg\",\"properties\\/9.jpg\",\"properties\\/8.jpg\",\"properties\\/11.jpg\",\"properties\\/6.jpg\"]','2926 Anderson Manors\nWalkerchester, CO 36234-1515',3,10,22,4988,0,'1992-09-30','2019-11-30',3096,6889,1,2,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.510784','-75.685699',4816,5,1,NULL),(12,'Adarsh Greens','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/4.jpg\",\"properties\\/2.jpg\",\"properties\\/12.jpg\",\"properties\\/1.jpg\",\"properties\\/11.jpg\",\"properties\\/6.jpg\",\"properties\\/5.jpg\",\"properties\\/9.jpg\",\"properties\\/10.jpg\",\"properties\\/8.jpg\",\"properties\\/7.jpg\"]','520 Schowalter Station\nStokeshaven, NE 87455',8,1,23,2628,1,'2014-08-24','2007-09-18',740,9219,1,4,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.801287','-76.551667',8464,3,1,NULL),(13,'Rustomjee Evershine Global City','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/9.jpg\",\"properties\\/1.jpg\",\"properties\\/4.jpg\",\"properties\\/8.jpg\",\"properties\\/12.jpg\",\"properties\\/11.jpg\",\"properties\\/5.jpg\",\"properties\\/7.jpg\",\"properties\\/6.jpg\"]','3080 Rath Groves\nNorth Zoiebury, WV 84294',11,6,30,2794,0,'2001-06-16','1992-09-21',3604,5929,1,5,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.771427','-75.711575',3623,5,3,NULL),(14,'Godrej Exquisite','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/2.jpg\",\"properties\\/1.jpg\",\"properties\\/7.jpg\",\"properties\\/11.jpg\",\"properties\\/9.jpg\",\"properties\\/6.jpg\",\"properties\\/12.jpg\",\"properties\\/4.jpg\",\"properties\\/8.jpg\",\"properties\\/5.jpg\"]','6702 Brielle Radial\nFelicitaside, IA 09008',6,8,5,1892,1,'2012-05-14','1993-10-09',1476,4782,1,5,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.718148','-76.415888',5827,1,5,NULL),(15,'Godrej Prime','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/1.jpg\",\"properties\\/12.jpg\",\"properties\\/10.jpg\",\"properties\\/7.jpg\",\"properties\\/2.jpg\",\"properties\\/8.jpg\"]','8819 Veronica Parkway Apt. 946\nKenyaview, ID 79513-5942',6,8,37,3471,0,'1973-04-21','1997-06-27',3630,11114,1,3,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.66251','-76.357538',7929,3,5,NULL),(16,'PS Panache','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/7.jpg\",\"properties\\/6.jpg\",\"properties\\/3.jpg\",\"properties\\/8.jpg\",\"properties\\/5.jpg\",\"properties\\/11.jpg\",\"properties\\/12.jpg\",\"properties\\/1.jpg\",\"properties\\/9.jpg\",\"properties\\/2.jpg\"]','5788 McKenzie Knoll\nLake Jadynhaven, PA 29007-7398',10,7,20,2468,0,'2009-09-17','2015-08-09',8020,13286,1,2,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','42.976241','-76.050471',9153,6,3,NULL),(17,'Upturn Atmiya Centria','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/3.jpg\",\"properties\\/10.jpg\",\"properties\\/8.jpg\",\"properties\\/12.jpg\",\"properties\\/1.jpg\",\"properties\\/4.jpg\",\"properties\\/7.jpg\",\"properties\\/11.jpg\",\"properties\\/5.jpg\",\"properties\\/2.jpg\"]','23953 Daugherty Lock\nPort Erickburgh, MN 04294',9,5,35,1240,0,'1995-09-05','2006-01-21',7103,13846,1,5,'selling',2,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.942322','-76.205126',4508,6,6,NULL),(18,'Brigade Oasis','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','[\"properties\\/12.jpg\",\"properties\\/2.jpg\",\"properties\\/6.jpg\",\"properties\\/9.jpg\",\"properties\\/3.jpg\",\"properties\\/5.jpg\",\"properties\\/4.jpg\",\"properties\\/10.jpg\"]','84397 Larkin Burg\nWest Sheridan, FL 28964',7,8,35,1941,1,'1999-06-05','2021-07-15',1760,5338,1,2,'selling',1,'Botble\\ACL\\Models\\User','2024-01-23 20:02:27','2024-01-23 20:02:27','43.814797','-75.76057',9456,1,5,NULL);
/*!40000 ALTER TABLE `re_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_projects_translations`
--

DROP TABLE IF EXISTS `re_projects_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_projects_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_projects_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_projects_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_projects_translations`
--

LOCK TABLES `re_projects_translations` WRITE;
/*!40000 ALTER TABLE `re_projects_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_projects_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_properties`
--

DROP TABLE IF EXISTS `re_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_properties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sale',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci,
  `project_id` bigint unsigned DEFAULT '0',
  `number_bedroom` int DEFAULT NULL,
  `number_bathroom` int DEFAULT NULL,
  `number_floor` int DEFAULT NULL,
  `square` double DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `currency_id` bigint unsigned DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `city_id` bigint unsigned DEFAULT NULL,
  `period` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'month',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'selling',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `moderation_status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `expire_date` date DEFAULT NULL,
  `auto_renew` tinyint(1) NOT NULL DEFAULT '0',
  `never_expired` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `country_id` bigint unsigned DEFAULT '1',
  `state_id` bigint unsigned DEFAULT NULL,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `re_properties_unique_id_unique` (`unique_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_properties`
--

LOCK TABLES `re_properties` WRITE;
/*!40000 ALTER TABLE `re_properties` DISABLE KEYS */;
INSERT INTO `re_properties` VALUES (1,'3 Beds Villa Calpe, Alicante','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','8138 Schroeder Roads\nPort Geovanniberg, ID 56211-8919','[\"properties\\/12.jpg\",\"properties\\/6.jpg\",\"properties\\/7.jpg\",\"properties\\/4.jpg\",\"properties\\/5.jpg\",\"properties\\/2.jpg\",\"properties\\/11.jpg\",\"properties\\/10.jpg\"]',6,4,4,29,640,609800.00,NULL,1,3,'month','selling',6,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:27','2024-01-23 20:02:27','43.960685','-74.784172',82691,4,5,NULL),(2,'Lavida Plus Office-tel 1 Bedroom','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','44370 Sanford Land Suite 056\nEast Nathan, WI 51265-9975','[\"properties\\/3.jpg\",\"properties\\/8.jpg\",\"properties\\/11.jpg\",\"properties\\/9.jpg\",\"properties\\/12.jpg\",\"properties\\/4.jpg\",\"properties\\/6.jpg\",\"properties\\/1.jpg\",\"properties\\/2.jpg\",\"properties\\/7.jpg\",\"properties\\/10.jpg\",\"properties\\/5.jpg\"]',16,1,5,26,820,326500.00,NULL,0,5,'month','selling',12,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:27','2024-01-23 20:02:27','42.613902','-75.610532',47530,6,4,NULL),(3,'Vinhomes Grand Park Studio 1 Bedroom','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','2052 Blanca Mission\nNew Silas, AR 86064-4412','[\"properties\\/3.jpg\",\"properties\\/2.jpg\",\"properties\\/10.jpg\",\"properties\\/6.jpg\",\"properties\\/11.jpg\",\"properties\\/5.jpg\",\"properties\\/8.jpg\",\"properties\\/7.jpg\",\"properties\\/12.jpg\",\"properties\\/9.jpg\",\"properties\\/4.jpg\"]',16,1,7,45,970,393700.00,NULL,0,2,'month','selling',6,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:27','2024-01-23 20:02:27','43.663754','-75.883282',95806,5,2,NULL),(4,'The Sun Avenue Office-tel 1 Bedroom','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','9153 Wisozk Landing\nBorerfurt, DC 03096','[\"properties\\/3.jpg\",\"properties\\/10.jpg\",\"properties\\/5.jpg\",\"properties\\/11.jpg\",\"properties\\/7.jpg\",\"properties\\/2.jpg\",\"properties\\/9.jpg\",\"properties\\/12.jpg\",\"properties\\/6.jpg\",\"properties\\/1.jpg\",\"properties\\/4.jpg\",\"properties\\/8.jpg\"]',12,6,8,94,160,58400.00,NULL,1,5,'month','selling',9,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:27','2024-01-23 20:02:27','42.70956','-76.67473',90335,4,5,NULL),(5,'Property For sale, Johannesburg, South Africa','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','4152 Janie Tunnel Apt. 437\nAlessiamouth, HI 83615','[\"properties\\/5.jpg\",\"properties\\/8.jpg\",\"properties\\/1.jpg\",\"properties\\/7.jpg\",\"properties\\/11.jpg\",\"properties\\/3.jpg\",\"properties\\/10.jpg\",\"properties\\/12.jpg\",\"properties\\/9.jpg\"]',15,3,6,3,620,252500.00,NULL,0,3,'month','selling',6,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:27','2024-01-23 20:02:27','43.360038','-75.038483',8459,3,3,NULL),(6,'Stunning French Inspired Manor','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','227 Marks Neck\nPort Odieberg, NV 49359-0382','[\"properties\\/3.jpg\",\"properties\\/6.jpg\",\"properties\\/4.jpg\",\"properties\\/11.jpg\",\"properties\\/5.jpg\"]',14,3,10,35,920,464400.00,NULL,1,1,'month','selling',19,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','42.909648','-76.079178',15693,6,4,NULL),(7,'Villa for sale at Bermuda Dunes','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','86474 Arthur Falls\nAlfredoville, NH 74270-2804','[\"properties\\/7.jpg\",\"properties\\/1.jpg\",\"properties\\/9.jpg\",\"properties\\/8.jpg\",\"properties\\/2.jpg\",\"properties\\/10.jpg\",\"properties\\/4.jpg\",\"properties\\/12.jpg\",\"properties\\/6.jpg\",\"properties\\/3.jpg\"]',11,10,6,16,790,845700.00,NULL,0,5,'month','selling',17,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','42.94519','-74.814882',45644,4,4,NULL),(8,'Walnut Park Apartment','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','22992 Jacobson Glens Apt. 036\nLindville, DE 80966','[\"properties\\/11.jpg\",\"properties\\/6.jpg\",\"properties\\/10.jpg\",\"properties\\/4.jpg\",\"properties\\/1.jpg\",\"properties\\/5.jpg\",\"properties\\/7.jpg\",\"properties\\/3.jpg\",\"properties\\/2.jpg\",\"properties\\/9.jpg\",\"properties\\/8.jpg\"]',5,5,5,21,650,767300.00,NULL,0,2,'month','selling',3,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.974426','-74.847582',36735,6,5,NULL),(9,'5 beds luxury house','rent','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','151 Fahey Circles\nRubymouth, MA 15275-0021','[\"properties\\/5.jpg\",\"properties\\/2.jpg\",\"properties\\/10.jpg\",\"properties\\/4.jpg\",\"properties\\/6.jpg\",\"properties\\/3.jpg\",\"properties\\/1.jpg\",\"properties\\/9.jpg\",\"properties\\/12.jpg\",\"properties\\/7.jpg\"]',3,7,1,22,190,553300.00,NULL,1,4,'month','renting',13,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.034542','-76.231567',15474,1,6,NULL),(10,'Family Victorian \"View\" Home','rent','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','2820 Kaylie Light\nWest Alva, VA 39738-1792','[\"properties\\/11.jpg\",\"properties\\/8.jpg\",\"properties\\/9.jpg\",\"properties\\/7.jpg\",\"properties\\/12.jpg\",\"properties\\/6.jpg\",\"properties\\/5.jpg\",\"properties\\/3.jpg\",\"properties\\/2.jpg\",\"properties\\/4.jpg\"]',8,10,1,16,250,344400.00,NULL,1,1,'month','renting',10,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.700419','-75.471682',57413,1,4,NULL),(11,'Osaka Heights Apartment','rent','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','8378 Maureen Rue\nEast Daleview, NJ 09412','[\"properties\\/4.jpg\",\"properties\\/2.jpg\",\"properties\\/10.jpg\",\"properties\\/5.jpg\",\"properties\\/9.jpg\",\"properties\\/11.jpg\",\"properties\\/3.jpg\",\"properties\\/12.jpg\",\"properties\\/7.jpg\",\"properties\\/8.jpg\"]',8,8,3,11,60,657300.00,NULL,0,4,'month','renting',9,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.240287','-74.841137',58681,4,2,NULL),(12,'Private Estate Magnificent Views','rent','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','4803 Odie Crest Apt. 947\nOlestad, MI 91684','[\"properties\\/8.jpg\",\"properties\\/4.jpg\",\"properties\\/2.jpg\",\"properties\\/9.jpg\",\"properties\\/6.jpg\",\"properties\\/12.jpg\"]',6,8,8,86,930,482200.00,NULL,0,3,'month','renting',17,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.450542','-75.23015',44444,5,2,NULL),(13,'Thompson Road House for rent','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','6829 Schaefer Squares Apt. 914\nNorth Vickyland, ID 01079-0218','[\"properties\\/5.jpg\",\"properties\\/10.jpg\",\"properties\\/6.jpg\",\"properties\\/7.jpg\",\"properties\\/1.jpg\",\"properties\\/4.jpg\",\"properties\\/2.jpg\",\"properties\\/3.jpg\"]',4,1,10,21,300,637600.00,NULL,0,2,'month','selling',15,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','42.744418','-76.056193',95716,5,6,NULL),(14,'Brand New 1 Bedroom Apartment In First Class Location','rent','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','388 Aileen Throughway\nEast Pietro, HI 25691','[\"properties\\/3.jpg\",\"properties\\/9.jpg\",\"properties\\/11.jpg\",\"properties\\/7.jpg\",\"properties\\/8.jpg\",\"properties\\/5.jpg\",\"properties\\/10.jpg\",\"properties\\/12.jpg\"]',10,1,4,38,90,719000.00,NULL,1,3,'month','renting',9,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.054346','-76.358601',88382,5,2,NULL),(15,'Elegant family home presents premium modern living','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','5251 Bergnaum Isle\nSouth Ansley, WV 84355','[\"properties\\/7.jpg\",\"properties\\/6.jpg\",\"properties\\/1.jpg\",\"properties\\/11.jpg\",\"properties\\/3.jpg\"]',2,8,8,7,180,321800.00,NULL,1,1,'month','selling',10,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','42.606021','-76.293079',46961,4,5,NULL),(16,'Luxury Apartments in Singapore for Sale','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','607 Hirthe Avenue Suite 366\nToyfort, MS 79232','[\"properties\\/7.jpg\",\"properties\\/3.jpg\",\"properties\\/1.jpg\",\"properties\\/12.jpg\",\"properties\\/4.jpg\",\"properties\\/9.jpg\"]',18,3,1,36,920,673400.00,NULL,0,1,'month','selling',8,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.413975','-75.782685',28763,6,1,NULL),(17,'5 room luxury penthouse for sale in Kuala Lumpur','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','27496 Langworth Loaf Suite 175\nEast Hermantown, NV 41329-7654','[\"properties\\/4.jpg\",\"properties\\/11.jpg\",\"properties\\/7.jpg\",\"properties\\/3.jpg\",\"properties\\/12.jpg\",\"properties\\/5.jpg\"]',8,7,9,16,140,689300.00,NULL,0,4,'month','selling',19,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.303219','-75.783056',80945,4,6,NULL),(18,'2 Floor house in Compound Pejaten Barat Kemang','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','607 Jalon Expressway Apt. 112\nHilpertmouth, NE 52265','[\"properties\\/4.jpg\",\"properties\\/3.jpg\",\"properties\\/9.jpg\",\"properties\\/12.jpg\",\"properties\\/5.jpg\",\"properties\\/2.jpg\",\"properties\\/1.jpg\",\"properties\\/6.jpg\",\"properties\\/11.jpg\",\"properties\\/8.jpg\",\"properties\\/7.jpg\"]',7,9,7,77,700,270600.00,NULL,1,1,'month','selling',6,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.127618','-74.971358',14,5,3,NULL),(19,'Apartment Muiderstraatweg in Diemen','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','58567 Bernice Valleys\nKuvalisland, SD 85951-1225','[\"properties\\/1.jpg\",\"properties\\/7.jpg\",\"properties\\/5.jpg\",\"properties\\/2.jpg\",\"properties\\/9.jpg\",\"properties\\/8.jpg\",\"properties\\/10.jpg\",\"properties\\/12.jpg\"]',18,5,9,90,790,843600.00,NULL,1,1,'month','selling',9,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.853816','-76.615651',64558,3,4,NULL),(20,'Nice Apartment for rent in Berlin','rent','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','609 Deshaun Port Suite 307\nNorth Clarabelle, MO 28165-0288','[\"properties\\/12.jpg\",\"properties\\/2.jpg\",\"properties\\/7.jpg\",\"properties\\/3.jpg\",\"properties\\/1.jpg\",\"properties\\/10.jpg\",\"properties\\/5.jpg\",\"properties\\/4.jpg\",\"properties\\/6.jpg\",\"properties\\/9.jpg\"]',5,1,8,14,800,606800.00,NULL,1,3,'month','renting',12,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.394021','-76.528763',80320,5,1,NULL),(21,'Pumpkin Key - Private Island','sale','<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen sink with drain board and\n    provisions for water purifier , electric hood , exhaust fan will be provided</p>\n','<h4>Kitchen</h4>\n<p>Ceramic tiled flooring, Granite counter top , Single bowl stainless steel kitchen\n    sink with drain board and provisions for water purifier , electric hood , exhaust fan will be provided</p>\n<br>\n<h4>Toilets</h4>\n<p>Anti-skid Ceramic tiles on floor and ceramic wall tiles up to 7 feet height. White\n    coloured branded sanitary fittings, Chromium plated taps , concealed plumbing</p>\n<br>\n<h4>Doors</h4>\n<p>Main door will be high quality wooden door, premium Windows quality pre-hung internal\n    doors with wooded frame, UPVC or aluminum sliding doors and aluminum frame with glass for windows</p>\n<ul>\n    <li> 9 km to Katunayaka airport expressway entrance</li>\n    <li> 12 km to Southern expressway entrance at Kottawa</li>\n    <li> 2 km to Kalubowila General hospital</li>\n    <li> All leading banks within a few kilometer radii</li>\n    <li> Very close proximity to railway stations</li>\n    <li> Many leading schools including CIS within 5 km radius</li>\n</ul>\n','730 Paul Rue\nLake Stewart, AZ 21570','[\"properties\\/6.jpg\",\"properties\\/8.jpg\",\"properties\\/1.jpg\",\"properties\\/4.jpg\",\"properties\\/3.jpg\"]',3,7,8,79,570,926100.00,NULL,0,1,'month','selling',17,'Botble\\RealEstate\\Models\\Account','approved','1970-01-01',0,1,'2024-01-23 20:02:28','2024-01-23 20:02:28','43.617427','-76.306407',40472,5,1,NULL);
/*!40000 ALTER TABLE `re_properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_properties_translations`
--

DROP TABLE IF EXISTS `re_properties_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_properties_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `re_properties_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`re_properties_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_properties_translations`
--

LOCK TABLES `re_properties_translations` WRITE;
/*!40000 ALTER TABLE `re_properties_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_properties_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_property_categories`
--

DROP TABLE IF EXISTS `re_property_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_property_categories` (
  `property_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`property_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_property_categories`
--

LOCK TABLES `re_property_categories` WRITE;
/*!40000 ALTER TABLE `re_property_categories` DISABLE KEYS */;
INSERT INTO `re_property_categories` VALUES (1,1),(1,2),(1,4),(2,1),(3,1),(3,2),(3,4),(3,6),(4,1),(4,3),(4,4),(4,6),(5,1),(5,6),(6,1),(6,2),(6,3),(6,5),(7,2),(7,3),(8,1),(8,3),(8,4),(9,1),(10,1),(10,2),(10,3),(10,4),(10,6),(11,1),(11,2),(11,3),(11,5),(11,6),(12,3),(12,6),(13,2),(13,3),(13,4),(13,5),(14,1),(14,2),(14,3),(14,4),(14,6),(15,3),(15,4),(15,5),(16,1),(16,2),(17,3),(17,4),(17,6),(18,2),(19,2),(19,3),(19,4),(19,6),(20,3),(20,4),(20,5),(21,1),(21,2),(21,4),(21,5),(21,6);
/*!40000 ALTER TABLE `re_property_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_property_features`
--

DROP TABLE IF EXISTS `re_property_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_property_features` (
  `property_id` bigint unsigned NOT NULL,
  `feature_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_property_features`
--

LOCK TABLES `re_property_features` WRITE;
/*!40000 ALTER TABLE `re_property_features` DISABLE KEYS */;
/*!40000 ALTER TABLE `re_property_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `re_reviews`
--

DROP TABLE IF EXISTS `re_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `re_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `reviewable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewable_id` bigint unsigned NOT NULL,
  `star` tinyint NOT NULL,
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_unique` (`account_id`,`reviewable_id`,`reviewable_type`),
  KEY `re_reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `re_reviews`
--

LOCK TABLES `re_reviews` WRITE;
/*!40000 ALTER TABLE `re_reviews` DISABLE KEYS */;
INSERT INTO `re_reviews` VALUES (1,16,'Botble\\RealEstate\\Models\\Project',2,4,'He sent them word I had our Dinah here, I know is, it would be quite.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(2,20,'Botble\\RealEstate\\Models\\Project',1,4,'ONE with such sudden violence that Alice had got so close to them, and the Queen in front of them, with her head was so small as this is May it won\'t be raving mad--at.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(3,16,'Botble\\RealEstate\\Models\\Property',13,2,'Soup,\" will you, won\'t you, will you.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(4,11,'Botble\\RealEstate\\Models\\Property',18,1,'O Mouse!\' (Alice thought this a good opportunity for showing off a head unless there was a.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(5,19,'Botble\\RealEstate\\Models\\Project',6,1,'Queen. \'Sentence first--verdict afterwards.\' \'Stuff and nonsense!\' said Alice sharply, for she had hurt the poor little thing sobbed again (or grunted, it was certainly English. \'I don\'t think--\' \'Then you.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(6,15,'Botble\\RealEstate\\Models\\Property',13,4,'Suppress him! Pinch him! Off with his nose Trims his belt and his buttons, and turns out his toes.\' [later editions continued as.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(7,3,'Botble\\RealEstate\\Models\\Property',18,3,'Mock Turtle. \'No, no! The adventures first,\' said the Dormouse; \'VERY ill.\' Alice tried to fancy to cats if you please! \"William the Conqueror, whose cause was favoured by the little door into that lovely garden.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(8,9,'Botble\\RealEstate\\Models\\Project',16,1,'Gryphon. \'Turn a somersault in the direction in which the cook took the hookah out of the window, I only knew the name of nearly everything there. \'That\'s the reason so many out-of-the-way things to happen, that it was an.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(9,9,'Botble\\RealEstate\\Models\\Property',3,4,'Rabbit\'s voice along--\'Catch him, you by the end of the e--e--evening, Beautiful, beautiful Soup! Soup of the officers of the lefthand bit of stick, and held out its arms folded.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(10,1,'Botble\\RealEstate\\Models\\Project',16,2,'Hatter, \'you wouldn\'t talk about wasting IT. It\'s HIM.\' \'I don\'t think it\'s at all anxious to have any pepper in that soup!\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(11,12,'Botble\\RealEstate\\Models\\Property',13,5,'Alice, \'and if it had lost something; and she looked up, but it was.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(12,8,'Botble\\RealEstate\\Models\\Property',2,1,'Alice had not gone (We know it to her great delight it fitted! Alice opened the door began sneezing all at once. \'Give your evidence,\' said.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(13,14,'Botble\\RealEstate\\Models\\Project',13,2,'I can creep under the door; so either way I\'ll get into the garden, where Alice could speak again. In a little before she had drunk half the bottle, she found she could not think of anything to say, she simply bowed, and took the regular course.\' \'What was THAT.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(14,4,'Botble\\RealEstate\\Models\\Property',8,4,'I beg your pardon!\' cried Alice (she was obliged to write with one of the court. \'What do you know I\'m mad?\' said Alice. \'I mean what I could not.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(15,13,'Botble\\RealEstate\\Models\\Project',13,1,'Queen said to Alice, she went on. \'We had the best thing to eat some of the wood to listen. The Fish-Footman began by.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(16,15,'Botble\\RealEstate\\Models\\Property',4,1,'Duchess\'s knee, while plates and dishes crashed around it--once more the shriek of.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(17,12,'Botble\\RealEstate\\Models\\Property',7,1,'Pray how did you manage to do anything but sit with its wings. \'Serpent!\' screamed the Queen. \'Well, I shan\'t go, at any rate: go and get in at the mushroom for a moment to be seen--everything seemed to be otherwise.\"\' \'I think you might knock, and I had not got into a pig,\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(18,4,'Botble\\RealEstate\\Models\\Project',3,3,'Rome, and Rome--no, THAT\'S all wrong, I\'m certain! I must be kind.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(19,14,'Botble\\RealEstate\\Models\\Property',5,5,'Queen, pointing to the jury, and the reason of that?\' \'In my youth,\' said his father, \'I took to the fifth bend, I think?\' he said to the table for it, she found she could not remember ever having heard of uglifying!\' it.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(20,13,'Botble\\RealEstate\\Models\\Project',12,3,'Dodo suddenly called out \'The Queen! The Queen!\' and the fall was over. However, when they liked, and left off writing on his flappers, \'--Mystery, ancient and modern, with Seaography: then Drawling--the Drawling-master was an immense length of neck, which seemed to.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(21,5,'Botble\\RealEstate\\Models\\Property',18,2,'Alice, swallowing down her anger as well say,\' added the Dormouse. \'Write that down,\' the King said, turning to Alice to find that she never knew so much contradicted in her face, with such sudden violence that Alice quite jumped; but she could for sneezing. There was no use.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(22,8,'Botble\\RealEstate\\Models\\Project',1,3,'NOT!\' cried the Gryphon, before Alice could bear: she got up, and there they are!\' said the Mock Turtle said: \'no wise.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(23,21,'Botble\\RealEstate\\Models\\Project',4,4,'Alice said nothing: she had wept when she turned to the cur, \"Such a trial, dear Sir, With no jury or judge, would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the patience of an.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(24,20,'Botble\\RealEstate\\Models\\Property',5,5,'Sir, With no jury or judge, would be.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(25,21,'Botble\\RealEstate\\Models\\Project',18,1,'When they take us up and walking away.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(26,19,'Botble\\RealEstate\\Models\\Project',5,5,'He sent them word I had it written up somewhere.\' Down, down, down. Would the fall NEVER come to the other, looking uneasily at the stick, running a very curious sensation, which puzzled her too much, so she went on to the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(27,4,'Botble\\RealEstate\\Models\\Property',10,1,'I\'m somebody else\"--but, oh dear!\' cried Alice hastily, afraid that it would not open any of them. However, on the trumpet, and called out to sea. So they had at the end of the jury eagerly wrote down all three to.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(28,21,'Botble\\RealEstate\\Models\\Property',8,5,'Alice kept her waiting!\' Alice felt that it might be some sense in your pocket?\' he went on, looking anxiously about her.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(29,10,'Botble\\RealEstate\\Models\\Project',12,2,'Caterpillar. \'Not QUITE right, I\'m afraid,\' said Alice, \'I\'ve often seen them at last, and managed to put his mouth close to the end of trials, \"There was some attempts at applause, which was full of smoke from.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(30,8,'Botble\\RealEstate\\Models\\Project',16,4,'CHAPTER VII. A Mad Tea-Party There was a table in the last words.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(31,7,'Botble\\RealEstate\\Models\\Property',6,3,'THAT direction,\' waving the other side of the tale was something like this:-- \'Fury.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(32,14,'Botble\\RealEstate\\Models\\Property',11,1,'Dormouse; \'--well in.\' This answer so confused.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(33,13,'Botble\\RealEstate\\Models\\Property',6,4,'Mock Turtle said: \'I\'m too stiff. And the executioner went off like an arrow. The Cat\'s head with great curiosity. \'It\'s a mineral, I THINK,\' said Alice. \'Come on, then,\' said the Duchess; \'and the moral of that is--\"The more there is of yours.\"\' \'Oh, I beg your pardon!\' said the Queen. \'I.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(34,13,'Botble\\RealEstate\\Models\\Project',16,5,'White Rabbit, \'but it sounds uncommon nonsense.\' Alice said to herself; \'I should have liked teaching it tricks very much, if--if I\'d only been the whiting,\' said Alice, rather alarmed at the other side, the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(35,20,'Botble\\RealEstate\\Models\\Property',19,1,'Gryphon, \'she wants for to know what to beautify is, I suppose?\' \'Yes,\' said Alice, very loudly and decidedly, and he says it\'s so useful, it\'s worth a hundred pounds! He says it kills all the jurymen on to her usual height. It was so small as this before, never! And I declare it\'s too.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(36,19,'Botble\\RealEstate\\Models\\Property',18,5,'Alice\'s shoulder, and it set to work throwing everything within her reach at the Mouse\'s tail; \'but why do you know about it, you know.\' It was, no doubt: only Alice did not like to hear her try and say \"How doth the little--\"\' and she crossed her hands on.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(37,4,'Botble\\RealEstate\\Models\\Property',5,3,'I can reach the key; and if it makes rather a handsome pig, I think.\' And she squeezed herself up closer to Alice\'s side as she went on, without attending to her, though, as they would go, and making faces at him as he spoke. \'UNimportant, of course, to begin again, it was.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(38,5,'Botble\\RealEstate\\Models\\Property',9,1,'I\'ll write one--but I\'m grown up now,\' she said, without even looking round. \'I\'ll fetch the executioner ran wildly up and picking the daisies, when suddenly a footman in livery came running out of court! Suppress him! Pinch him! Off.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(39,3,'Botble\\RealEstate\\Models\\Project',3,4,'As soon as the White Rabbit with pink eyes ran close by her. There was certainly too much of it had made. \'He took me for his housemaid,\' she said to herself, in.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(40,5,'Botble\\RealEstate\\Models\\Project',14,2,'Mary Ann!\' said the Duchess. An invitation from the time it all came different!\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(41,1,'Botble\\RealEstate\\Models\\Project',10,1,'When I used to read fairy-tales, I fancied that kind of authority over Alice. \'Stand up and saying, \'Thank.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(42,17,'Botble\\RealEstate\\Models\\Project',11,5,'The Queen had ordered. They very soon came to the conclusion that it might not escape.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(43,4,'Botble\\RealEstate\\Models\\Project',1,5,'Dodo. Then they both sat silent for a baby: altogether Alice did not look at all for any of them. \'I\'m sure.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(44,8,'Botble\\RealEstate\\Models\\Property',19,2,'The Hatter was out of a muchness?\' \'Really, now you ask me,\' said Alice, \'I\'ve often seen.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(45,14,'Botble\\RealEstate\\Models\\Property',12,2,'Why, I wouldn\'t say anything about it, even if my head would go through,\' thought poor Alice, that she wasn\'t a bit of stick, and tumbled head over heels in its sleep \'Twinkle.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(47,8,'Botble\\RealEstate\\Models\\Project',15,5,'I\'ll tell him--it was for bringing the cook and the three gardeners at it, busily painting them red. Alice thought over all she could have been was not going to give the hedgehog had unrolled itself, and began staring at the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(48,19,'Botble\\RealEstate\\Models\\Project',15,1,'Hatter. Alice felt a little while, however, she waited patiently. \'Once,\' said the young lady to see it pop down a jar from one end of the cattle in the distance, and she said to the baby, and not to lie down on the hearth and grinning from ear to.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(49,11,'Botble\\RealEstate\\Models\\Project',10,3,'I shan\'t grow any more--As it is, I can\'t get out again. Suddenly she came upon a Gryphon, lying fast asleep in the middle.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(50,7,'Botble\\RealEstate\\Models\\Project',18,1,'Hatter was the cat.) \'I hope.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(51,19,'Botble\\RealEstate\\Models\\Property',20,1,'Oh dear! I wish I had to stoop to save her neck from being broken. She hastily put down yet, before the trial\'s begun.\' \'They\'re putting down their names,\' the Gryphon only answered \'Come on!\' and ran off, thinking while she ran.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(52,15,'Botble\\RealEstate\\Models\\Project',13,1,'Alice cautiously replied, not feeling at all fairly,\' Alice began, in a piteous tone. And she went on in a court of justice before, but she did it so yet,\' said the Caterpillar contemptuously. \'Who are YOU?\' said the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(53,5,'Botble\\RealEstate\\Models\\Project',18,4,'There was nothing on it except a little hot tea upon its forehead (the position in dancing.\' Alice said; but was dreadfully puzzled by the time she had but to her great disappointment it was very likely it can be,\' said the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(54,5,'Botble\\RealEstate\\Models\\Property',12,4,'He got behind Alice as he shook both his shoes off. \'Give your evidence,\' said the Hatter, with an important air, \'are you all ready? This is the same year for such a thing I ask! It\'s always six o\'clock now.\' A bright idea came into Alice\'s head. \'Is that all?\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(55,18,'Botble\\RealEstate\\Models\\Project',11,3,'While the Duchess sneezed occasionally; and as he shook both his shoes on. \'--and just take his head off outside,\' the Queen was in.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(57,9,'Botble\\RealEstate\\Models\\Project',8,3,'Nobody moved. \'Who cares for fish, Game, or any other dish? Who would not give all else for two Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup?.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(58,8,'Botble\\RealEstate\\Models\\Project',13,2,'Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse did not wish to offend the Dormouse denied nothing, being fast asleep. \'After that,\' continued the Hatter, \'you wouldn\'t talk about wasting IT. It\'s HIM.\' \'I don\'t think--\' \'Then you.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(59,3,'Botble\\RealEstate\\Models\\Project',4,4,'There could be beheaded, and that you never.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(60,17,'Botble\\RealEstate\\Models\\Project',9,1,'Rabbit, and had to pinch it to speak good English); \'now I\'m opening out like the largest telescope.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(61,3,'Botble\\RealEstate\\Models\\Project',9,2,'Hatter. \'Nor I,\' said the Gryphon.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(62,7,'Botble\\RealEstate\\Models\\Property',3,5,'Beautiful, beautiful Soup!\' CHAPTER XI. Who Stole the Tarts? The King looked anxiously over his shoulder as he spoke. \'UNimportant, of course, to begin lessons: you\'d only have to turn into a doze; but, on being pinched by the Hatter, it woke up again with a whiting. Now you know.\' Alice had been.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(63,11,'Botble\\RealEstate\\Models\\Project',9,5,'Alice. \'That\'s the judge,\' she.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(64,12,'Botble\\RealEstate\\Models\\Property',10,4,'Dormouse crossed the court, she said to herself; \'his eyes are so VERY wide, but she was beginning to see the Hatter said, tossing his head mournfully. \'Not I!\' he replied. \'We quarrelled last.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(65,17,'Botble\\RealEstate\\Models\\Property',21,2,'I\'d nearly forgotten to ask.\' \'It turned into a graceful zigzag, and was in the trial one way up as the soldiers did. After these came.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(66,5,'Botble\\RealEstate\\Models\\Project',5,3,'Dormouse went on, \'\"--found it advisable to go from here?\' \'That depends a good opportunity for croqueting one of the singers in the distance would take the roof of the earth. At last the Caterpillar.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(68,17,'Botble\\RealEstate\\Models\\Project',17,2,'A WATCH OUT OF ITS WAISTCOAT-POCKET, and looked at it again: but he now hastily began.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(69,21,'Botble\\RealEstate\\Models\\Property',17,2,'Rabbit\'s voice along--\'Catch him, you by the way, and then the other, saying, in a very difficult question. However, at last turned sulky, and would only say, \'I am older than you, and don\'t speak a word till I\'ve finished.\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(70,10,'Botble\\RealEstate\\Models\\Property',12,3,'However, this bottle was NOT marked \'poison,\' so Alice went on, \'you throw the--\' \'The lobsters!\' shouted the Queen. \'You make me larger, it must be on the bank--the birds with draggled feathers, the animals.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(72,17,'Botble\\RealEstate\\Models\\Property',4,5,'As she said to herself; \'his eyes are so VERY wide, but she heard her sentence three of the Gryphon, half to itself, half to herself, rather sharply; \'I advise you to get out of the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(73,5,'Botble\\RealEstate\\Models\\Project',9,3,'Alice remarked. \'Right, as usual,\' said the March Hare went \'Sh! sh!\' and the whole window!\' \'Sure, it does, yer honour: but it\'s an arm for all that.\' \'With extras?\' asked the Mock Turtle, \'they--you\'ve seen them, of course?\' \'Yes,\' said Alice, (she had grown up,\' she said to the law, And argued.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(74,1,'Botble\\RealEstate\\Models\\Project',15,5,'BEST butter,\' the March Hare interrupted in a great deal too flustered to tell you--all I know I have done that.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(75,5,'Botble\\RealEstate\\Models\\Property',11,1,'I could say if I like being that person, I\'ll come up: if not, I\'ll stay down here!.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(76,15,'Botble\\RealEstate\\Models\\Property',2,4,'March Hare, who had got its neck nicely straightened out, and was coming to, but it was good manners for her to carry it further. So she set the little thing howled so, that Alice.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(77,4,'Botble\\RealEstate\\Models\\Project',7,1,'The King laid his hand upon her face. \'Very,\' said Alice: \'allow me to him: She gave me a good deal frightened by this time). \'Don\'t grunt,\' said Alice; \'that\'s not at all comfortable.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(78,9,'Botble\\RealEstate\\Models\\Property',10,3,'There was nothing on it (as she had felt quite strange at first; but she gained courage as she was out of the house, and wondering whether she ought to speak, and no one to listen to me! When I used to it!\' pleaded poor Alice. \'But you\'re so easily offended.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(79,8,'Botble\\RealEstate\\Models\\Project',6,1,'The Gryphon lifted up both its paws in surprise. \'What! Never heard of one,\' said Alice, who felt ready to agree to everything that was trickling down his brush, and had just begun \'Well, of all her coaxing. Hardly knowing what she was coming back to them, and he called the Queen, in a.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(81,1,'Botble\\RealEstate\\Models\\Property',12,5,'Alice. One of the hall; but, alas! either the locks were too large, or the key was too late to wish that! She went on again: \'Twenty-four hours, I THINK; or is it directed to?\' said one of the sort. Next came an angry tone, \'Why, Mary Ann, what ARE you doing out here? Run.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(82,15,'Botble\\RealEstate\\Models\\Project',10,1,'Mock Turtle said: \'advance twice, set to partners--\' \'--change lobsters, and retire in same order,\' continued the Hatter, and, just as if he would not join the dance? Will you, won\'t you, will you, won\'t you join the dance. So they sat down, and.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(83,18,'Botble\\RealEstate\\Models\\Property',10,5,'Alice, flinging the baby at her with large eyes like a writing-desk?\' \'Come, we shall get on better.\' \'I\'d rather finish my tea,\' said the Duchess. An.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(84,16,'Botble\\RealEstate\\Models\\Property',15,3,'And I declare it\'s too bad, that it seemed quite natural); but when the White Rabbit, with a lobster as a last resource, she put one arm out of THIS!\' (Sounds of more.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(85,11,'Botble\\RealEstate\\Models\\Property',8,1,'And in she went. Once more she found herself falling down a very long silence, broken only by an occasional exclamation of.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(86,11,'Botble\\RealEstate\\Models\\Project',14,3,'Caterpillar sternly. \'Explain yourself!\' \'I can\'t help it,\' said Alice. \'Oh, don\'t talk about her other little children, and everybody else. \'Leave off that!\' screamed the Pigeon. \'I can tell you how it was the BEST butter, you know.\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(87,5,'Botble\\RealEstate\\Models\\Project',12,1,'I\'d been the whiting,\' said the Queen. \'Their heads are gone, if it makes rather a handsome pig, I think.\' And she began very cautiously: \'But I don\'t like it, yer honour, at all, as the Caterpillar sternly. \'Explain yourself!\' \'I.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(88,8,'Botble\\RealEstate\\Models\\Project',14,3,'Alice alone with the grin, which remained some time after the others. \'Are their heads down! I am to see that the best plan.\' It sounded an.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(89,6,'Botble\\RealEstate\\Models\\Property',17,3,'I suppose?\' said Alice. \'You must be,\' said the Mock Turtle. Alice was so full of tears, but said nothing. \'When we were little,\' the Mock Turtle, and said \'What else had you to learn?\' \'Well, there was a good character, But said I could shut.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(90,21,'Botble\\RealEstate\\Models\\Property',13,5,'Caterpillar\'s making such VERY short remarks, and she set to work shaking him and punching him in.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(91,13,'Botble\\RealEstate\\Models\\Property',11,2,'Rabbit actually TOOK A WATCH OUT OF ITS WAISTCOAT-POCKET, and looked at them with one eye; but to open them again, and that\'s all the things I used to.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(92,1,'Botble\\RealEstate\\Models\\Property',2,5,'The Caterpillar and Alice rather unwillingly took the place where it had no pictures or conversations?\' So she tucked it away under her arm, that it was YOUR table,\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(93,15,'Botble\\RealEstate\\Models\\Property',5,1,'MORE than nothing.\' \'Nobody asked YOUR opinion,\' said Alice. \'Of course not,\' said the last time she had read several nice little dog near our house I should like to see if there are, nobody attends to them--and you\'ve no idea how confusing it is I hate cats and dogs.\' It was as long as.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(95,20,'Botble\\RealEstate\\Models\\Project',10,1,'The Queen smiled and passed on. \'Who ARE you talking.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(96,13,'Botble\\RealEstate\\Models\\Property',4,3,'Alice. \'I mean what I say,\' the Mock Turtle.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(97,19,'Botble\\RealEstate\\Models\\Project',3,4,'What made you so awfully clever?\' \'I have answered three questions, and that in the way the people near the door, and knocked. \'There\'s no such thing!\' Alice was so much at first, but, after watching it a very.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(98,3,'Botble\\RealEstate\\Models\\Property',9,2,'The Cat only grinned when it saw Alice. It looked good-natured, she thought: still it had come back again, and she did not seem to come once a week: HE taught us Drawling, Stretching, and Fainting in Coils.\' \'What was THAT like?\' said Alice. \'Then it.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(99,11,'Botble\\RealEstate\\Models\\Project',6,5,'Alice was very provoking to find it out, we should all have our heads cut off, you know. Please, Ma\'am, is.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(100,10,'Botble\\RealEstate\\Models\\Project',11,4,'Hatter. \'He won\'t stand beating. Now, if you were all ornamented with hearts. Next came an angry tone, \'Why, Mary Ann, and be turned out of sight, he said do. Alice looked round, eager to see if he wasn\'t one?\' Alice asked. \'We called him Tortoise because he was in such a thing before, but.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(101,2,'Botble\\RealEstate\\Models\\Property',1,2,'YOUR temper!\' \'Hold your tongue, Ma!\' said the Gryphon: and Alice was not a bit of the Rabbit\'s voice along--\'Catch him, you by the officers of the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(102,6,'Botble\\RealEstate\\Models\\Project',17,1,'Alice a little quicker. \'What a funny watch!\' she remarked. \'There isn\'t any,\' said the King was the first minute or two, looking for eggs, I know I have done.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(103,18,'Botble\\RealEstate\\Models\\Project',9,2,'There are no mice in the pool, \'and she sits purring so nicely by the carrier,\' she thought; \'and how funny it\'ll.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(104,15,'Botble\\RealEstate\\Models\\Property',19,3,'WOULD twist itself round and swam slowly back to them, and the Queen, \'Really, my dear, YOU must cross-examine the next verse.\' \'But about his toes?\' the Mock.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(105,5,'Botble\\RealEstate\\Models\\Property',21,3,'Alice did not feel encouraged to ask his neighbour to tell.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(107,4,'Botble\\RealEstate\\Models\\Project',18,1,'Alice; \'it\'s laid for a conversation. \'You don\'t know much,\' said Alice, (she had kept a piece of it had struck her foot! She was a.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(108,16,'Botble\\RealEstate\\Models\\Property',5,1,'There seemed to think about it, you know.\' \'And what an ignorant little girl or a watch to take MORE than nothing.\' \'Nobody asked YOUR opinion,\' said Alice. \'Anything you like,\' said the Footman, and began to cry again, for this curious child.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(109,2,'Botble\\RealEstate\\Models\\Property',19,2,'It was the Duchess\'s voice died away, even in the sea!\' cried the Mock Turtle, suddenly dropping his voice; and Alice was silent. The King looked anxiously over his shoulder as he spoke. \'A cat may look at it!\' This speech caused a remarkable.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(110,12,'Botble\\RealEstate\\Models\\Property',3,4,'Latitude was, or Longitude I\'ve got to the Cheshire Cat sitting on the English coast you find a pleasure in all my limbs very supple By the use of repeating all that stuff,\' the Mock Turtle interrupted, \'if you don\'t explain it is right?\' \'In my youth,\' said the Hatter: \'it\'s very.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(111,14,'Botble\\RealEstate\\Models\\Property',20,5,'Dormouse said--\' the Hatter continued, \'in this way:-- \"Up above the world you fly, Like a tea-tray in the sea. But they HAVE their tails fast in their paws. \'And how did you.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(112,17,'Botble\\RealEstate\\Models\\Project',3,1,'On which Seven looked up and down, and nobody spoke for some minutes. The Caterpillar and Alice rather.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(113,18,'Botble\\RealEstate\\Models\\Project',4,1,'ME,\' but nevertheless she uncorked it and put back into the way I ought to go from here?\' \'That depends a good opportunity for making her.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(114,13,'Botble\\RealEstate\\Models\\Project',7,2,'She hastily put down the little golden key and hurried off to trouble myself about you: you must manage the best thing to eat her up in a rather offended tone, and.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(115,18,'Botble\\RealEstate\\Models\\Property',12,5,'So Alice began to feel a little glass table. \'Now, I\'ll manage better this time,\' she said, \'and see whether it\'s marked \"poison\" or not\'; for she was to get in at the righthand bit again, and said, very gravely.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(116,10,'Botble\\RealEstate\\Models\\Property',9,4,'However, I\'ve got to go on. \'And so.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(117,6,'Botble\\RealEstate\\Models\\Property',14,1,'How she longed to change them--\' when she had gone through that day. \'No, no!\' said the Duchess. \'Everything\'s got a moral, if only you can find it.\' And she tried the roots of trees, and I\'ve tried to fancy to cats if you only walk long enough.\' Alice felt.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(118,5,'Botble\\RealEstate\\Models\\Property',17,5,'Alice led the way, was the same words as before, \'It\'s all his fancy, that: he hasn\'t got no business of MINE.\' The Queen turned crimson with fury, and, after.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(119,18,'Botble\\RealEstate\\Models\\Project',15,2,'Alice indignantly, and she told her sister, who was reading the list of singers. \'You may not have lived much under the window, she suddenly spread out her hand, and Alice guessed in a low, trembling voice. \'There\'s.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(120,6,'Botble\\RealEstate\\Models\\Property',18,5,'Alice ventured to ask. \'Suppose we change the subject. \'Go on with the game,\' the Queen said to herself \'Now I can reach the key; and if the Queen put on her hand, watching the setting sun, and thinking of little birds and beasts.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(121,11,'Botble\\RealEstate\\Models\\Project',3,5,'Some of the suppressed guinea-pigs, filled the air, I\'m afraid, but you might do something better with the distant sobs of the treat. When.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(122,14,'Botble\\RealEstate\\Models\\Property',13,3,'Alice like the Queen?\' said the Cat. \'Do you know why it\'s called a whiting?\' \'I never went to the Mock Turtle\'s Story.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(123,8,'Botble\\RealEstate\\Models\\Property',1,4,'Presently the Rabbit asked. \'No, I give it up,\' Alice replied: \'what\'s the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(124,16,'Botble\\RealEstate\\Models\\Project',1,1,'In another minute the whole she thought it had been. But her sister kissed her, and said, \'That\'s right, Five! Always lay the blame on others!\' \'YOU\'D better not do that.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(125,15,'Botble\\RealEstate\\Models\\Property',8,4,'Alice began to cry again. \'You ought to be trampled under its feet, ran round the court was a little way off, and found quite a crowd of little Alice and all must have been changed for any lesson-books!\' And so it was addressed to the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(126,12,'Botble\\RealEstate\\Models\\Property',17,3,'It\'ll be no chance of her age knew the right way of keeping up the fan and gloves. \'How queer it seems,\' Alice said very humbly; \'I won\'t interrupt again. I dare say you\'re wondering why I.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(127,16,'Botble\\RealEstate\\Models\\Project',15,1,'Let me see: four times seven is--oh dear! I wish you were all in bed!\' On various pretexts they all looked so grave and anxious.) Alice could see it again, but it did not.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(129,13,'Botble\\RealEstate\\Models\\Property',18,2,'I used to come out among the branches, and every now and then, if I fell off the cake. * * * * * * * * * * * * * * * \'Come, my head\'s free at last!\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry for it, she found she could do, lying down with her friend. When she.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(130,2,'Botble\\RealEstate\\Models\\Property',15,1,'THEN--she found herself in.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(131,6,'Botble\\RealEstate\\Models\\Project',6,5,'Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse gave a little different. But if I\'m.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(132,10,'Botble\\RealEstate\\Models\\Property',2,2,'Come on!\' So they sat down, and was just going to be, from one foot up the fan and gloves, and, as.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(133,9,'Botble\\RealEstate\\Models\\Project',3,1,'But do cats eat bats? Do cats eat.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(134,17,'Botble\\RealEstate\\Models\\Project',15,5,'This did not come the same year for such dainties would not join the dance? \"You can really have no sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(135,16,'Botble\\RealEstate\\Models\\Project',5,4,'Alice hastily replied; \'at least--at least I mean what I used to say.\' \'So he did, so he with his nose, you know?\' \'It\'s the Cheshire Cat: now I shall be late!\' (when she thought it must.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(137,8,'Botble\\RealEstate\\Models\\Property',14,2,'Queen, pointing to the Queen. \'You make me giddy.\' And.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(139,19,'Botble\\RealEstate\\Models\\Property',14,4,'But she went on to himself in an offended tone, and everybody laughed, \'Let the jury eagerly wrote down on the other paw, \'lives a March Hare. \'He denies it,\' said Alice, a little animal (she couldn\'t guess of.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(140,12,'Botble\\RealEstate\\Models\\Property',4,2,'Presently the Rabbit noticed Alice, as she could, for the hot day.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(142,19,'Botble\\RealEstate\\Models\\Project',1,2,'Caterpillar\'s making such a fall as this, I shall think nothing of the house!\' (Which was very fond.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(144,19,'Botble\\RealEstate\\Models\\Project',14,3,'I am very tired of this. I vote the young Crab, a little of her going, though she knew that were of the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(145,5,'Botble\\RealEstate\\Models\\Property',5,5,'Mock Turtle Soup is made from,\' said the Hatter, with an M?\' said Alice. \'What sort of way, \'Do cats eat bats? Do cats eat bats? Do cats eat bats?\' and.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(147,14,'Botble\\RealEstate\\Models\\Property',18,1,'I wonder what Latitude was, or Longitude either, but thought they were getting extremely small for a few minutes to see the earth takes.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(148,7,'Botble\\RealEstate\\Models\\Project',10,4,'Alice! when she caught it, and finding it.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(149,3,'Botble\\RealEstate\\Models\\Project',8,5,'Alice: \'she\'s so extremely--\' Just then her head made her next remark. \'Then the words all coming different, and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(151,20,'Botble\\RealEstate\\Models\\Property',6,4,'THIS witness.\' \'Well, if I can go back and finish your.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(152,7,'Botble\\RealEstate\\Models\\Project',6,1,'I to do it! Oh dear! I wish I could let you out, you know.\' \'I DON\'T know,\' said the Gryphon. Alice did not seem to have wondered at this, but at the Hatter, \'or you\'ll be telling me next that you think you can find them.\' As she said to Alice, and.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(153,17,'Botble\\RealEstate\\Models\\Project',5,3,'So she swallowed one of the tea--\' \'The twinkling of the moment they saw the Mock Turtle said: \'advance twice, set to work very diligently to write out a box of comfits, (luckily the salt water had not noticed before, and she told her sister, as well as she listened, or.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(154,4,'Botble\\RealEstate\\Models\\Project',10,1,'Alice, thinking it was quite surprised to see its meaning. \'And just as I\'d taken the highest tree in the distance, and she thought it had VERY long claws and a Canary called out.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(155,9,'Botble\\RealEstate\\Models\\Property',20,4,'Arithmetic--Ambition, Distraction, Uglification, and Derision.\' \'I never.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(156,13,'Botble\\RealEstate\\Models\\Property',13,4,'Alice, \'shall I NEVER get any older than I am now? That\'ll be a LITTLE larger, sir, if you could manage it?) \'And what an ignorant little girl she\'ll think me at all.\' \'In.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(157,8,'Botble\\RealEstate\\Models\\Property',12,1,'March Hare and his friends shared their never-ending meal, and the whole thing, and longed to change the subject of conversation. While she was appealed to by all three dates on their backs was the Cat.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(159,9,'Botble\\RealEstate\\Models\\Property',4,2,'And mentioned me to introduce some.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(160,13,'Botble\\RealEstate\\Models\\Property',5,4,'Cat: \'we\'re all mad here. I\'m mad. You\'re mad.\' \'How do you want to stay with it as she could, for the White Rabbit hurried by--the frightened Mouse splashed his way through the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(162,19,'Botble\\RealEstate\\Models\\Project',4,5,'Alice called after it; and as he spoke. \'A cat may look at me like that!\' But she did not like the three gardeners, oblong and flat.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(163,1,'Botble\\RealEstate\\Models\\Project',13,4,'Queen, turning purple. \'I won\'t!\' said Alice. \'I\'m glad.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(164,11,'Botble\\RealEstate\\Models\\Property',10,1,'So they sat down again in a fight with another hedgehog, which seemed to be listening, so she felt that it was done. They had not noticed before, and she tried the effect of lying down with her head!\' Alice glanced rather anxiously at the.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(166,3,'Botble\\RealEstate\\Models\\Project',14,3,'IS the same thing, you know.\' \'Who is it I can\'t understand it myself to begin at HIS time.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(167,7,'Botble\\RealEstate\\Models\\Project',14,2,'Cat. \'--so long as it can talk: at any rate, there\'s no room at all comfortable, and it said in a solemn tone, only changing the order of the Nile On every.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(168,11,'Botble\\RealEstate\\Models\\Property',19,5,'I should like it very hard indeed to make out what she did, she picked up a little timidly, \'why you are very dull!\' \'You ought.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(169,14,'Botble\\RealEstate\\Models\\Project',3,4,'Mouse\'s tail; \'but why do you know about it, you know--\' \'But, it.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(170,13,'Botble\\RealEstate\\Models\\Project',3,5,'I fancied that kind of thing that would happen: \'\"Miss Alice! Come here directly, and get ready to ask them what the name \'Alice!\' CHAPTER XII. Alice\'s Evidence \'Here!\' cried Alice, jumping up and ran till she heard the Rabbit say to itself in a natural.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(171,15,'Botble\\RealEstate\\Models\\Project',8,3,'Caterpillar; and it set to work throwing everything.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(172,12,'Botble\\RealEstate\\Models\\Project',6,5,'Queen say only yesterday you deserved to be no doubt that it led into the sea, though you mayn\'t believe it--\' \'I never heard of \"Uglification,\"\' Alice ventured to ask. \'Suppose we change the subject. \'Ten hours the first witness,\' said the voice. \'Fetch.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(173,18,'Botble\\RealEstate\\Models\\Project',13,2,'And so she began nursing her child again, singing a sort of life! I do hope it\'ll make me grow large again, for really I\'m quite tired of this. I vote the young man said, \'And your hair has become very.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(174,14,'Botble\\RealEstate\\Models\\Project',12,2,'Mock Turtle, \'but if you\'ve seen them at dinn--\' she checked herself hastily. \'I don\'t think they play at all what had become of me? They\'re dreadfully fond of beheading people here.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(177,1,'Botble\\RealEstate\\Models\\Project',3,2,'Alice asked in a thick wood. \'The first thing she heard was a queer-shaped little creature, and held out its arms and frowning at the time they were nice grand words to say.) Presently she began very cautiously: \'But I don\'t understand. Where did they live on?\' said.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(179,15,'Botble\\RealEstate\\Models\\Property',11,4,'Lory, as soon as the other.\' As soon as it spoke. \'As wet as ever,\' said Alice hastily; \'but I\'m not Ada,\' she said, \'and see whether it\'s marked \"poison\" or not\'; for she had tired herself out with his head!\"\' \'How dreadfully savage!\'.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(180,2,'Botble\\RealEstate\\Models\\Project',18,3,'I do it again and again.\' \'You are old,\' said the King. The White Rabbit put on your head-- Do you think, at your age, it is.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(181,7,'Botble\\RealEstate\\Models\\Project',3,2,'Alice whispered to the shore, and then a row of lamps hanging from the trees behind him. \'--or next day, maybe,\' the Footman continued in the sea, \'and in that soup!\' Alice said to the Hatter. \'You might just as if it.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(182,7,'Botble\\RealEstate\\Models\\Property',7,2,'Mary Ann, and be turned out of sight: then it chuckled. \'What fun!\' said the Duck: \'it\'s generally a ridge or furrow in the middle, being held up by a very fine day!\' said a sleepy voice behind her. \'Collar that Dormouse,\' the Queen said to.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(183,15,'Botble\\RealEstate\\Models\\Project',2,5,'Alice, in a voice sometimes choked with sobs, to sing you a present of everything I\'ve said as yet.\' \'A cheap sort of meaning in it,\' said Five, \'and I\'ll tell you his.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(185,2,'Botble\\RealEstate\\Models\\Project',3,5,'WHAT things?\' said the Cat: \'we\'re all mad here. I\'m mad. You\'re mad.\' \'How do you mean \"purpose\"?\' said Alice. \'It.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(186,16,'Botble\\RealEstate\\Models\\Property',8,4,'Hatter: and in another moment that it would be very likely to eat her up in a minute or two, which gave the Pigeon in a very short time the Queen said--\' \'Get to your tea; it\'s.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(188,14,'Botble\\RealEstate\\Models\\Project',18,3,'I shall be punished for it flashed across her mind that she was beginning to end,\' said.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(191,4,'Botble\\RealEstate\\Models\\Project',2,1,'Alice, always ready to make SOME change in my own tears! That WILL be a book written about me, that there was no use in knocking,\' said the Hatter. \'Nor I,\' said the Caterpillar, just as she could, and soon found herself lying on their slates, and then said, \'It WAS a curious appearance in.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(192,2,'Botble\\RealEstate\\Models\\Project',8,2,'Queen, and Alice, were in custody and under sentence of execution.\' \'What for?\' said Alice. \'Why, you don\'t know of any good reason, and as for the Dormouse,\' thought Alice; \'I can\'t explain MYSELF, I\'m afraid, sir\' said Alice, as she was now.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(193,12,'Botble\\RealEstate\\Models\\Property',21,4,'March Hare. \'Exactly so,\' said Alice. \'Come, let\'s hear some of the door and found that, as nearly as large as the hall was very hot, she kept on puzzling about it just missed her. Alice caught the baby violently up and leave the court; but on second thoughts she decided to remain where she was.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(194,2,'Botble\\RealEstate\\Models\\Property',9,1,'Alice soon began talking again. \'Dinah\'ll miss me very much what would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(195,1,'Botble\\RealEstate\\Models\\Project',12,3,'The Caterpillar was the Rabbit began. Alice thought to herself. \'Shy, they seem to encourage.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(196,15,'Botble\\RealEstate\\Models\\Project',6,1,'This time there were three little.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(197,8,'Botble\\RealEstate\\Models\\Project',5,4,'CURTSEYING as you\'re falling through the little passage: and THEN--she found herself safe in a moment: she looked down at.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(198,3,'Botble\\RealEstate\\Models\\Property',10,5,'Mouse to tell them something more. \'You promised to tell him. \'A nice muddle their.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(199,19,'Botble\\RealEstate\\Models\\Project',13,5,'Alice had not a bit afraid of interrupting him,) \'I\'ll give him sixpence. _I_ don\'t believe there\'s an atom of meaning in it.\' The jury all brightened up at this moment.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28'),(200,2,'Botble\\RealEstate\\Models\\Project',12,1,'Oh, how I wish I had our Dinah here, I know.','approved','2024-01-23 20:02:28','2024-01-23 20:02:28');
/*!40000 ALTER TABLE `re_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisions`
--

DROP TABLE IF EXISTS `revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisions`
--

LOCK TABLES `revisions` WRITE;
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_users` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_users_user_id_index` (`user_id`),
  KEY `role_users_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.manage.license\":true,\"extensions.index\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.cronjob\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"widgets.index\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"plugins.captcha\":true,\"captcha.settings\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.settings\":true,\"plugin.faq\":true,\"faq.index\":true,\"faq.create\":true,\"faq.edit\":true,\"faq.destroy\":true,\"faq_category.index\":true,\"faq_category.create\":true,\"faq_category.edit\":true,\"faq_category.destroy\":true,\"faqs.settings\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"plugin.location\":true,\"country.index\":true,\"country.create\":true,\"country.edit\":true,\"country.destroy\":true,\"state.index\":true,\"state.create\":true,\"state.edit\":true,\"state.destroy\":true,\"city.index\":true,\"city.create\":true,\"city.edit\":true,\"city.destroy\":true,\"location.bulk-import.index\":true,\"location.export.index\":true,\"newsletter.index\":true,\"newsletter.destroy\":true,\"newsletter.settings\":true,\"payment.index\":true,\"payments.settings\":true,\"payment.destroy\":true,\"plugins.real-estate\":true,\"real-estate.settings\":true,\"property.index\":true,\"property.create\":true,\"property.edit\":true,\"property.destroy\":true,\"project.index\":true,\"project.create\":true,\"project.edit\":true,\"project.destroy\":true,\"property_feature.index\":true,\"property_feature.create\":true,\"property_feature.edit\":true,\"property_feature.destroy\":true,\"investor.index\":true,\"investor.create\":true,\"investor.edit\":true,\"investor.destroy\":true,\"review.index\":true,\"review.create\":true,\"review.edit\":true,\"review.destroy\":true,\"consult.index\":true,\"consult.create\":true,\"consult.edit\":true,\"consult.destroy\":true,\"property_category.index\":true,\"property_category.create\":true,\"property_category.edit\":true,\"property_category.destroy\":true,\"facility.index\":true,\"facility.create\":true,\"facility.edit\":true,\"facility.destroy\":true,\"account.index\":true,\"account.create\":true,\"account.edit\":true,\"account.destroy\":true,\"package.index\":true,\"package.create\":true,\"package.edit\":true,\"package.destroy\":true,\"consults.index\":true,\"consults.edit\":true,\"consults.destroy\":true,\"real-estate.custom-fields.index\":true,\"real-estate.custom-fields.create\":true,\"real-estate.custom-fields.edit\":true,\"real-estate.custom-fields.destroy\":true,\"invoice.index\":true,\"invoice.edit\":true,\"invoice.destroy\":true,\"invoice.template\":true,\"import-properties.index\":true,\"export-properties.index\":true,\"import-projects.index\":true,\"export-projects.index\":true,\"coupons.index\":true,\"coupons.destroy\":true,\"real-estate.settings.general\":true,\"real-estate.settings.currencies\":true,\"real-estate.settings.accounts\":true,\"real-estate.settings.invoices\":true,\"real-estate.settings.invoice-template\":true,\"social-login.settings\":true,\"testimonial.index\":true,\"testimonial.create\":true,\"testimonial.edit\":true,\"testimonial.destroy\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true}','Admin users role',1,2,2,'2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (2,'api_enabled','0',NULL,'2024-01-23 20:02:20'),(3,'activated_plugins','[\"language\",\"language-advanced\",\"analytics\",\"audit-log\",\"backup\",\"blog\",\"captcha\",\"contact\",\"cookie-consent\",\"faq\",\"location\",\"newsletter\",\"payment\",\"paypal\",\"paystack\",\"razorpay\",\"real-estate\",\"rss-feed\",\"social-login\",\"sslcommerz\",\"stripe\",\"testimonial\",\"translation\"]',NULL,'2024-01-23 20:02:20'),(6,'language_hide_default','1',NULL,'2024-01-23 20:02:20'),(7,'language_switcher_display','dropdown',NULL,'2024-01-23 20:02:20'),(8,'language_display','all',NULL,'2024-01-23 20:02:20'),(9,'language_hide_languages','[]',NULL,'2024-01-23 20:02:20'),(10,'media_random_hash','4fa2b8558070e32019c661b647e75311',NULL,NULL),(11,'theme','hously',NULL,NULL),(12,'show_admin_bar','1',NULL,NULL),(15,'permalink-botble-blog-models-post','news',NULL,NULL),(16,'permalink-botble-blog-models-category','news',NULL,NULL),(17,'payment_cod_status','1',NULL,NULL),(18,'payment_cod_description','Please pay money directly to the postman, if you choose cash on delivery method (COD).',NULL,NULL),(19,'payment_bank_transfer_status','1',NULL,NULL),(20,'payment_bank_transfer_description','Please send money to our bank account: ACB - 69270 213 19.',NULL,NULL),(21,'payment_stripe_payment_type','stripe_checkout',NULL,NULL),(22,'admin_logo','general/logo-light.png',NULL,NULL),(23,'admin_favicon','general/favicon.png',NULL,NULL),(25,'cookie_consent_message','Your experience on this site will be improved by allowing cookies',NULL,NULL),(26,'cookie_consent_learn_more_url','https://hously.test/cookie-policy',NULL,NULL),(27,'cookie_consent_learn_more_text','Cookie Policy',NULL,NULL),(28,'real_estate_enable_review_feature','1',NULL,NULL),(29,'real_estate_reviews_per_page','10',NULL,NULL),(30,'theme-hously-site_title','Hously',NULL,NULL),(31,'theme-hously-seo_title','Find your favorite homes at Hously',NULL,NULL),(32,'theme-hously-site_description','A great platform to buy, sell and rent your properties without any agent or commissions.',NULL,NULL),(33,'theme-hously-seo_description','A great platform to buy, sell and rent your properties without any agent or commissions.',NULL,NULL),(34,'theme-hously-copyright','© 2024 Archi Elite JSC. All right reserved.',NULL,NULL),(35,'theme-hously-favicon','general/favicon.png',NULL,NULL),(36,'theme-hously-logo','general/logo-light.png',NULL,NULL),(37,'theme-hously-logo_dark','general/logo-dark.png',NULL,NULL),(38,'theme-hously-404_page_image','general/error.png',NULL,NULL),(39,'theme-hously-primary_font','League Spartan',NULL,NULL),(40,'theme-hously-primary_color','#16a34a',NULL,NULL),(41,'theme-hously-secondary_color','#15803D',NULL,NULL),(42,'theme-hously-homepage_id','1',NULL,NULL),(43,'theme-hously-authentication_enable_snowfall_effect','1',NULL,NULL),(44,'theme-hously-authentication_background_image','backgrounds/01.jpg',NULL,NULL),(45,'theme-hously-categories_background_image','backgrounds/01.jpg',NULL,NULL),(46,'theme-hously-logo_authentication_page','general/logo-authentication-page.png',NULL,NULL),(47,'theme-hously-default_page_cover_image','backgrounds/01.jpg',NULL,NULL),(48,'theme-hously-projects_list_page_id','5',NULL,NULL),(49,'theme-hously-properties_list_page_id','6',NULL,NULL),(50,'theme-hously-blog_page_id','14',NULL,NULL),(51,'theme-hously-projects_list_layout','grid',NULL,NULL),(52,'theme-hously-properties_list_layout','grid',NULL,NULL),(53,'theme-hously-number_of_related_properties','6',NULL,NULL),(54,'theme-hously-social_links','[[{\"key\":\"social-name\",\"value\":\"Facebook\"},{\"key\":\"social-icon\",\"value\":\"mdi mdi-facebook\"},{\"key\":\"social-url\",\"value\":\"#\"}],[{\"key\":\"social-name\",\"value\":\"Instagram\"},{\"key\":\"social-icon\",\"value\":\"mdi mdi-instagram\"},{\"key\":\"social-url\",\"value\":\"#\"}],[{\"key\":\"social-name\",\"value\":\"Twitter\"},{\"key\":\"social-icon\",\"value\":\"mdi mdi-twitter\"},{\"key\":\"social-url\",\"value\":\"#\"}],[{\"key\":\"social-name\",\"value\":\"LinkedIn\"},{\"key\":\"social-icon\",\"value\":\"mdi mdi-linkedin\"},{\"key\":\"social-url\",\"value\":\"#\"}]]',NULL,NULL),(55,'theme-hously-enabled_toggle_theme_mode','1',NULL,NULL),(56,'theme-hously-default_theme_mode','system',NULL,NULL),(57,'theme-hously-show_whatsapp_button_on_consult_form','1',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs`
--

DROP TABLE IF EXISTS `slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slugs_reference_id_index` (`reference_id`),
  KEY `slugs_key_index` (`key`),
  KEY `slugs_prefix_index` (`prefix`),
  KEY `slugs_reference_index` (`reference_id`,`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
INSERT INTO `slugs` VALUES (1,'apartment',1,'Botble\\RealEstate\\Models\\Category','property-category','2024-01-23 20:02:19','2024-01-23 20:02:19'),(2,'villa',2,'Botble\\RealEstate\\Models\\Category','property-category','2024-01-23 20:02:19','2024-01-23 20:02:19'),(3,'condo',3,'Botble\\RealEstate\\Models\\Category','property-category','2024-01-23 20:02:19','2024-01-23 20:02:19'),(4,'house',4,'Botble\\RealEstate\\Models\\Category','property-category','2024-01-23 20:02:19','2024-01-23 20:02:19'),(5,'land',5,'Botble\\RealEstate\\Models\\Category','property-category','2024-01-23 20:02:19','2024-01-23 20:02:19'),(6,'commercial-property',6,'Botble\\RealEstate\\Models\\Category','property-category','2024-01-23 20:02:19','2024-01-23 20:02:19'),(7,'home-one',1,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(8,'home-two',2,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(9,'home-three',3,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(10,'home-four',4,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(11,'projects',5,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(12,'properties',6,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(13,'about-us',7,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(14,'features',8,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(15,'pricing-plans',9,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(16,'frequently-asked-questions',10,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(17,'terms-of-services',11,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(18,'privacy-policy',12,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(19,'coming-soon',13,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(20,'news',14,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(21,'contact',15,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(22,'wishlist',16,'Botble\\Page\\Models\\Page','','2024-01-23 20:02:20','2024-01-23 20:02:20'),(23,'design',1,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(24,'lifestyle',2,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(25,'travel-tips',3,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(26,'healthy',4,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(27,'travel-tips',5,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(28,'hotel',6,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(29,'nature',7,'Botble\\Blog\\Models\\Category','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(30,'new',1,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(31,'event',2,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(32,'villa',3,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(33,'apartment',4,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(34,'condo',5,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(35,'luxury-villa',6,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(36,'family-home',7,'Botble\\Blog\\Models\\Tag','tag','2024-01-23 20:02:20','2024-01-23 20:02:20'),(37,'the-top-2020-handbag-trends-to-know',1,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(38,'top-search-engine-optimization-strategies',2,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(39,'which-company-would-you-choose',3,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(40,'used-car-dealer-sales-tricks-exposed',4,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(41,'20-ways-to-sell-your-product-faster',5,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(42,'the-secrets-of-rich-and-famous-writers',6,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(43,'imagine-losing-20-pounds-in-14-days',7,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(44,'are-you-still-using-that-slow-old-typewriter',8,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(45,'a-skin-cream-thats-proven-to-work',9,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(46,'10-reasons-to-start-your-own-profitable-website',10,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(47,'simple-ways-to-reduce-your-unwanted-wrinkles',11,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(48,'apple-imac-with-retina-5k-display-review',12,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(49,'10000-web-site-visitors-in-one-monthguaranteed',13,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(50,'unlock-the-secrets-of-selling-high-ticket-items',14,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(51,'4-expert-tips-on-how-to-choose-the-right-mens-wallet',15,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(52,'sexy-clutches-how-to-buy-wear-a-designer-clutch-bag',16,'Botble\\Blog\\Models\\Post','news','2024-01-23 20:02:20','2024-01-23 20:02:20'),(53,'walnut-park-apartments',1,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(54,'sunshine-wonder-villas',2,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(55,'diamond-island',3,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(56,'the-nassim',4,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(57,'vinhomes-grand-park',5,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(58,'the-metropole-thu-thiem',6,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(59,'villa-on-grand-avenue',7,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(60,'traditional-food-restaurant',8,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(61,'villa-on-hollywood-boulevard',9,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(62,'office-space-at-northwest-107th',10,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(63,'home-in-merrick-way',11,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(64,'adarsh-greens',12,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(65,'rustomjee-evershine-global-city',13,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(66,'godrej-exquisite',14,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(67,'godrej-prime',15,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(68,'ps-panache',16,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(69,'upturn-atmiya-centria',17,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(70,'brigade-oasis',18,'Botble\\RealEstate\\Models\\Project','projects','2024-01-23 20:02:27','2024-01-23 20:02:27'),(71,'3-beds-villa-calpe-alicante',1,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:27','2024-01-23 20:02:27'),(72,'lavida-plus-office-tel-1-bedroom',2,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:27','2024-01-23 20:02:27'),(73,'vinhomes-grand-park-studio-1-bedroom',3,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:27','2024-01-23 20:02:27'),(74,'the-sun-avenue-office-tel-1-bedroom',4,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:27','2024-01-23 20:02:27'),(75,'property-for-sale-johannesburg-south-africa',5,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(76,'stunning-french-inspired-manor',6,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(77,'villa-for-sale-at-bermuda-dunes',7,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(78,'walnut-park-apartment',8,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(79,'5-beds-luxury-house',9,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(80,'family-victorian-view-home',10,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(81,'osaka-heights-apartment',11,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(82,'private-estate-magnificent-views',12,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(83,'thompson-road-house-for-rent',13,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(84,'brand-new-1-bedroom-apartment-in-first-class-location',14,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(85,'elegant-family-home-presents-premium-modern-living',15,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(86,'luxury-apartments-in-singapore-for-sale',16,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(87,'5-room-luxury-penthouse-for-sale-in-kuala-lumpur',17,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(88,'2-floor-house-in-compound-pejaten-barat-kemang',18,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(89,'apartment-muiderstraatweg-in-diemen',19,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(90,'nice-apartment-for-rent-in-berlin',20,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(91,'pumpkin-key-private-island',21,'Botble\\RealEstate\\Models\\Property','properties','2024-01-23 20:02:28','2024-01-23 20:02:28'),(92,'fannie-ryan',1,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(93,'veda-ritchie',2,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(94,'macy-boyle',3,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(95,'ruby-schuppe',4,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(96,'matilda-von',5,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(97,'dejon-dickinson',6,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(98,'marcel-wiza',7,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(99,'ebony-pollich',8,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(100,'ricardo-zemlak',9,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(101,'jordane-maggio',10,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(102,'athena-keeling',11,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(103,'weston-herzog',12,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(104,'kitty-morar',13,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(105,'elyse-schulist',14,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(106,'dalton-kerluke',15,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(107,'cruz-haley',16,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(108,'reggie-rath',17,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(109,'jakob-sanford',18,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(110,'sharon-bauch',19,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(111,'perry-ortiz',20,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33'),(112,'carolanne-murphy',21,'Botble\\RealEstate\\Models\\Account','agents','2024-01-23 20:02:33','2024-01-23 20:02:33');
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs_translations`
--

DROP TABLE IF EXISTS `slugs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slugs_id` bigint unsigned NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`lang_code`,`slugs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs_translations`
--

LOCK TABLES `slugs_translations` WRITE;
/*!40000 ALTER TABLE `slugs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `states_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'France','france','FR',1,0,NULL,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'England','england','EN',2,0,NULL,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'New York','new-york','NY',1,0,NULL,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Holland','holland','HL',4,0,NULL,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'Denmark','denmark','DN',5,0,NULL,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'Germany','germany','GER',1,0,NULL,0,'published','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states_translations`
--

DROP TABLE IF EXISTS `states_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `states_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`states_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states_translations`
--

LOCK TABLES `states_translations` WRITE;
/*!40000 ALTER TABLE `states_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `states_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'New',2,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'Event',2,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'Villa',2,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Apartment',1,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'Condo',2,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'Luxury villa',2,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(7,'Family home',2,'Botble\\ACL\\Models\\User','','published','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_translations`
--

DROP TABLE IF EXISTS `tags_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_translations`
--

LOCK TABLES `tags_translations` WRITE;
/*!40000 ALTER TABLE `tags_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Christa Smith','I am, sir,\' said Alice; not that she was a most extraordinary noise going on shrinking rapidly: she soon found out a new idea to Alice, and tried to beat them off, and that is enough,\' Said his.','clients/01.jpg','Manager','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'John Smith','Alice; \'but when you throw them, and the Gryphon replied very solemnly. Alice was only sobbing,\' she thought, and it sat down again into its nest. Alice crouched down among the party. Some of the.','clients/02.jpg','Product designer','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'Sayen Ahmod','Alice to herself. (Alice had no pictures or conversations in it, and on it were white, but there was a dead silence instantly, and neither of the day; and this was her dream:-- First, she dreamed of.','clients/03.jpg','Developer','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'Tayla Swef','Alice; and Alice was just in time to begin lessons: you\'d only have to fly; and the Hatter hurriedly left the court, arm-in-arm with the edge of the other guinea-pig cheered, and was suppressed.','clients/04.jpg','Graphic designer','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'Christa Smith','Duchess: you\'d better leave off,\' said the Duchess, who seemed to be Involved in this affair, He trusts to you never had fits, my dear, I think?\' \'I had NOT!\' cried the Gryphon, \'she wants for to.','clients/05.jpg','Graphic designer','published','2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'James Garden','I? Ah, THAT\'S the great hall, with the next moment a shower of saucepans, plates, and dishes. The Duchess took her choice, and was just in time to see a little different. But if I\'m Mabel, I\'ll stay.','clients/06.jpg','Web Developer','published','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials_translations`
--

DROP TABLE IF EXISTS `testimonials_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonials_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `company` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`testimonials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials_translations`
--

LOCK TABLES `testimonials_translations` WRITE;
/*!40000 ALTER TABLE `testimonials_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `credits` int unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `account_id` bigint unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'add',
  `payment_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_meta`
--

DROP TABLE IF EXISTS `user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `manage_supers` tinyint(1) NOT NULL DEFAULT '0',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'rodger.ebert@zemlak.com',NULL,'$2y$12$FROv.5wYAQ.1I3RwIHQ0LeSS8QALOVjqhvcB6tqwyS4oRwbe2PWs.',NULL,'2024-01-23 20:02:19','2024-01-23 20:02:19','Meaghan','Abbott','botble',NULL,1,1,NULL,NULL),(2,'charris@schoen.com',NULL,'$2y$12$DkVSp5aTcBAU5mJAmV3ZIecvd4zk7JeyRMaFmKRCCBkuCeK2rtANy',NULL,'2024-01-23 20:02:20','2024-01-23 20:02:20','Florian','Cole','admin',NULL,1,1,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'NewsletterWidget','pre_footer','hously',0,'{\"name\":\"Subscribe to Newsletter.\",\"description\":\"Subscribe to get latest updates and information.\",\"title\":null,\"subtitle\":null}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(2,'SiteInformationWidget','footer_menu','hously',1,'{\"name\":\"Site Information\",\"logo\":\"general\\/logo-light.png\",\"url\":\"#\",\"description\":\"A great platform to buy, sell and rent your properties without any agent or commissions.\"}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(3,'CustomMenuWidget','footer_menu','hously',2,'{\"id\":\"CustomMenuWidget\",\"name\":\"Company\",\"menu_id\":\"company\"}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(4,'CustomMenuWidget','footer_menu','hously',3,'{\"id\":\"CustomMenuWidget\",\"name\":\"Useful Links\",\"menu_id\":\"useful-links\"}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(5,'ContactInformationWidget','footer_menu','hously',4,'{\"name\":\"Contact Details\",\"address\":\"C\\/54 Northwest Freeway, Suite 558, Houston, USA 485\",\"email\":\"contact@example.com\",\"phone\":\"+152 534-468-854\"}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(6,'BlogSearchWidget','blog_sidebar','hously',1,'{\"name\":\"Blog Search\"}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(7,'BlogPopularCategoriesWidget','blog_sidebar','hously',2,'{\"name\":\"Popular Categories\",\"limit\":5}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(8,'BlogPostsWidget','blog_sidebar','hously',3,'{\"name\":\"Popular Posts\",\"type\":\"popular\",\"limit\":5}','2024-01-23 20:02:20','2024-01-23 20:02:20'),(9,'BlogPopularTagsWidget','blog_sidebar','hously',4,'{\"name\":\"Popular Tags\",\"limit\":6}','2024-01-23 20:02:20','2024-01-23 20:02:20');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-24 10:02:35
