create database homework;
use homework;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8,
  `author` varchar(50) CHARACTER SET utf8,
  `rate` int(4) UNSIGNED,
  `year` int(8) UNSIGNED,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `books` (`title`,`author`,`rate`,`year`) VALUES 
('Меч без имени','Александр Белялнин','7','2010'),
('Алмазный меч, деревянный меч','Ник Перумов','6','2007'),
('Империя','Роман Злотников','8','2012'),
('Эпоха Мёртвых','Андрей Круз','10','2015'),
('Древний','Сергей Тармашев','8','2016'),
('Хроники Эхо','Макс Фрай','6','2010'),
('Ник','Анджей Ясинский','9','2010'),
('Лесовик','Евгений Старухин','3','2017'),
('Стальная крыса','Гарри Гаррисон','9','2004'),
('Планета смерти','Гарри Гаррисон','8','2005');

ALTER TABLE books ADD country varchar(50) CHARACTER SET utf8;
ALTER TABLE books CHANGE `country` `country` INT(50) NULL DEFAULT NULL;
ALTER TABLE `books` DROP `country`;

SELECT * FROM books;
SELECT title,author FROM books;
SELECT * FROM books WHERE rate > 5;
SELECT * FROM books ORDER BY rate desc;
SELECT * FROM books WHERE rate > 7 and year > 2015 ORDER BY year asc;
