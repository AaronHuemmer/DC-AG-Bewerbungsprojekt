-- TSC Pottenstein Fan-Shop (MySQL)
-- Erstelle Datenbank (falls nicht vorhanden) und wechsle hinein:
CREATE DATABASE IF NOT EXISTS `tsc_shop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tsc_shop`;

DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10,2) NOT NULL,
  `image` VARCHAR(200) NOT NULL,
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_name` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `address` VARCHAR(300) NOT NULL,
  `city` VARCHAR(120) NOT NULL,
  `zip` VARCHAR(20) NOT NULL,
  `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  CONSTRAINT `fk_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_items_product` FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Kategorien
INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Trikots'),
(2, 'Accessoires');

-- Produkte
INSERT INTO `products` (`category_id`, `name`, `description`, `price`, `image`) VALUES
(1, 'TSC Heimtrikot 2025', 'Das offizielle Heimtrikot der Saison 2025. Leicht, atmungsaktiv, perfekter Sitz.', 79.90, 'heimtrikot.png'),
(1, 'TSC Auswärtstrikot 2025', 'Dezentes Design für Auswärts – gleicher Stolz, gleiche Qualität.', 79.90, 'auswaertstrikot.png'),
(2, 'TSC Fanschal', 'Weich, warm und doppelseitig gewebt – ideal für kühle Spieltage.', 24.90, 'fanschal.png'),
(2, 'TSC Kappe', 'Verstellbare Snapback – klassischer Look mit TSC-Emblem.', 19.90, 'kappe.png'),
(2, 'TSC Tasse', 'Robuste Keramiktasse – dein Morgen startet in Vereinsfarben.', 12.90, 'tasse.png');