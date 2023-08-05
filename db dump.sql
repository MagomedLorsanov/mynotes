
-- First create DB
CREATE DATABASE IF NOT EXISTS notes;


-- THEN CREATE TABLE IN THE DB
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- IN CASE IF YOU NEED DATA FIRST
INSERT INTO `notes` VALUES (1,'architecture ','e\'ve tested the best architecture software for building design. As part of our review process, we\'ve assessed user interfaces and experiences, platform compatibility, pricing, performance, and output.','2023-08-05 07:52:59'),(2,'REASONS TO AVOID','You’ll also find many other architectural programs are compatible with standard','2023-08-05 07:53:25');



