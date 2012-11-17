delimiter $$

CREATE TABLE `diary` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `in_city` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `text_UNIQUE` (`text`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8$$


delimiter $$

CREATE TABLE `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `description` varchar(256) DEFAULT '',
  `godpower` int(3) DEFAULT '0',
  PRIMARY KEY (`id`,`title`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8$$

delimiter $$

CREATE TABLE `quests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8$$


