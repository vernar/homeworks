create DATABASE `portfolio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

use `portfolio`;
CREATE TABLE `person`(
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8,
  `tagline` varchar(100) CHARACTER SET utf8,
  `email` varchar(100) CHARACTER SET utf8,
  `phone` varchar(100) CHARACTER SET utf8,
  `website_name` varchar(100) CHARACTER SET utf8,
  `website_url` varchar(100) CHARACTER SET utf8,
  `summary` TEXT CHARACTER SET utf8,
   PRIMARY KEY (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `education`(
  `education_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `degree` varchar(100) CHARACTER SET utf8,
  `meta` varchar(500) CHARACTER SET utf8,
  `time_from` DATE ,
  `time_to` DATE ,
   PRIMARY KEY (`education_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `language`(
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `language` varchar(100) CHARACTER SET utf8,
  `level` varchar(50) CHARACTER SET utf8,
   PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `interests`(
  `interests_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `interest` varchar(100) CHARACTER SET utf8,
   PRIMARY KEY (`interests_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `expiriences`(
  `expiriences_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `job` varchar(100) CHARACTER SET utf8,
  `company` varchar(100) CHARACTER SET utf8,
  `details` varchar(500) CHARACTER SET utf8,
  `date_from` DATE,
  `date_to` DATE,
   PRIMARY KEY (`expiriences_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `projects`(
  `projects_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8,
  `url` varchar(100) CHARACTER SET utf8,
  `description` varchar(500) CHARACTER SET utf8,
   PRIMARY KEY (`projects_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `skills`(
  `skills_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8,
  `level` int(10),
   PRIMARY KEY (`skills_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comments`(
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `comment` TEXT,
  `date_submit` DATE NOT NULL,
  `status` varchar(20) DEFAULT '0',
   PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users`(
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
   PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `name`, `email`, `role`, `password`) VALUES
(1, 'admin', 'mail@gmail.com', '0', '123'),
(2, 'moderator', 'asdfl@ad.com', '1', '123');


INSERT INTO `person` (`name`, `tagline`, `email`, `phone`, `website_name`, `website_url`, `summary`) VALUES
('Arbuzov Dmitry', 'Technical support engineer', 'arbuzov.mail@gmail.com', '+375(29) 7447474', 'mtest.su', 'http://php7.mgtest.su/acv/lessons/lesson6/index.html', 'Начал свою карьеру с работы электромонтёром на одном из беларусских предприятий, параллельно заочно получая специальность "Инженер системотехник", что позволило мне через 3 года перевестить на должность "электронщик". <p>По окончанию учёбы, ушёл с работы на предприятии и устроился на работу, сотрудником техподдери, в одну из беларусских компаний веб разработки.');

INSERT INTO `education` (`person_id`, `degree`, `meta`, `time_from`, `time_to`) VALUES
('1', 'Электромонтёр', 'BGMTT', '2004-1-1', '2008-1-1'),
('1', 'Programming and electronic systems', 'Belarusian State University of Informatics and Radioelectronics', '2008-1-1', '2014-1-1');

INSERT INTO `language` (`person_id`, `language`, `level`) VALUES
('1', 'Russian', 'native'),
('1', 'English', 'Intermediate');

INSERT INTO `interests` (`person_id`, `interest`) VALUES
('1', 'Hiking'),
('1', 'Travels'),
('1', 'Running'),
('1', 'Snowboard'),
('1', 'Books');

INSERT INTO `expiriences` (`person_id`, `job`, `date_from`, `date_to`, `company`, `details`) VALUES
('1', 'Электромонтёр', '2008-1-1', '2011-1-1', 'Белшина', 'Электромонтёр по ремонту и обслуживанию промышленного оборудования'),
('1', 'Электронщик', '2011-1-1', '2014-1-1', 'Белшина', 'Наладка, ремонт, обслуживания оборудования с числовым программным управлением'),
('1', 'Technical upport engineer', '2014-1-1', '2018-1-1', 'Aheadworks', 'Оказание технической поддержки клиентам компании, bugfix, customization');

INSERT INTO `projects` (person_id, title, url, description) VALUES
('1', 'Magento community', 'http://mgnt224cesd.mgtest.su/', 'установка интернет магазина'),
('1', 'Debian 7', 'http://mgtest.su/info.php', 'Настройка внешнего сервера'),
('1', 'WordPress', 'http://wordpress.mgtest.su/', 'установка настройка CMS WordPress');

INSERT INTO `skills` (person_id, title, level) VALUES
('1', 'PHP', '50'),
('1', 'HTML/CSS', '40'),
('1', 'javascript', '20'),
('1', 'MySQL', '20'),
('1', 'C++', '30'),
('1', 'Photoshop', '10');


