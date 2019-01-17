create DATABASE `les_galery` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
use `les_galery`;

CREATE TABLE `files`(
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `original_name` varchar(100) CHARACTER SET utf8,
  `storage_name` varchar(100) CHARACTER SET utf8,
  `extension` varchar(100) CHARACTER SET utf8,
   PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;