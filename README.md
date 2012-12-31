Algorithm
同济好算法
=========
#数据库创建表SQL
#The SQL Script of database:

CREATE TABLE IF NOT EXISTS `commentsforproblem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stat` int(11) NOT NULL,
  `probID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text,
  `time` datetime DEFAULT NULL,
  `lastModify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`probID`),
  KEY `uid` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `commentsforspring` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stat` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text,
  `week` int(11) NOT NULL,
  `time` datetime DEFAULT NULL,
  `team` int(11) NOT NULL,
  `lastModify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spring_uid` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stat` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `pojProblemID` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `Context` longtext NOT NULL,
  `time` datetime DEFAULT NULL,
  `week` int(11) NOT NULL,
  `source` longtext,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `problems_uid` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `probID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `AC` int(11) NOT NULL,
  `stat` int(11) NOT NULL,
  `code` longtext,
  `language` text NOT NULL,
  `ACtime` datetime DEFAULT NULL,
  `lastModify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `score_uid` (`userID`),
  KEY `score_pid` (`probID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) DEFAULT NULL,
  `stat` int(11) NOT NULL,
  `sex` text,
  `POJ_user_name` text NOT NULL,
  `mail` text NOT NULL,
  `name` text NOT NULL,
  `nickname` text NOT NULL,
  `type` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `photo` mediumblob,
  `photoPath` longtext,
  `photoType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `commentsforproblem`
  ADD CONSTRAINT `commend_problem_pid` FOREIGN KEY (`probID`) REFERENCES `problems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `commend_problem_uid` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `commentsforspring`
  ADD CONSTRAINT `spring_uid` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `problems`
  ADD CONSTRAINT `problems_uid` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `score`
  ADD CONSTRAINT `score_pid` FOREIGN KEY (`probID`) REFERENCES `problems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `score_uidproblems` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;