CREATE TABLE IF NOT EXISTS `namedays` (
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `primary` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `namedays`
 ADD KEY `month` (`month`), ADD KEY `day` (`day`);