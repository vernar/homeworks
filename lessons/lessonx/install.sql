CREATE DATABASE IF NOT EXISTS `mystore` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mystore`;

CREATE TABLE `products` (
  `product_id` int(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET utf8,
  `name` varchar(100) CHARACTER SET utf8,
  `article` varchar(100) CHARACTER SET utf8,
  `price` float(20),
  `weight` varchar(100) CHARACTER SET utf8,
  `attribute1` varchar(100) CHARACTER SET utf8,
  `attribute2` varchar(100) CHARACTER SET utf8,
  PRIMARY KEY (`product_id`)
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE `cart` (
  `product_sku` varchar(100) CHARACTER SET utf8,
  `count` varchar(100) CHARACTER SET utf8,
   UNIQUE (`product_sku`)
)ENGINE=InnoDB CHARSET=utf8;

