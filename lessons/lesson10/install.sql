CREATE DATABASE IF NOT EXISTS `checklogin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `checklogin`;

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) CHARACTER SET utf8,
  `name` varchar(100) CHARACTER SET utf8,
  `password` varchar(100) CHARACTER SET utf8,
  `color` varchar(100) CHARACTER SET utf8,
  `confirm_key` varchar(100) CHARACTER SET utf8,
  `is_active` int(4),
  PRIMARY KEY (`user_id`)
)ENGINE=InnoDB CHARSET=utf8;

