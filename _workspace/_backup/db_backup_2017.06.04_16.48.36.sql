-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `tbl_course`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` smallint(6) NOT NULL,
  `grade` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_documentation`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_documentation`;
CREATE TABLE IF NOT EXISTS `tbl_documentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `postulant_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_documentation_requirement_id` (`requirement_id`),
  KEY `idx_documentation_postulant_id` (`postulant_id`),
  CONSTRAINT `fk_documentation_postulant_id` FOREIGN KEY (`postulant_id`) REFERENCES `tbl_postulant` (`id`),
  CONSTRAINT `fk_documentation_requirement_id` FOREIGN KEY (`requirement_id`) REFERENCES `tbl_requirement` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_evaluation`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_evaluation`;
CREATE TABLE IF NOT EXISTS `tbl_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tracing_id` int(11) NOT NULL,
  `indicator_id` int(11) NOT NULL,
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_evaluation_tracing_id` (`tracing_id`),
  KEY `idx_evaluation_indicator_id` (`indicator_id`),
  CONSTRAINT `fk_evaluation_indicator_id` FOREIGN KEY (`indicator_id`) REFERENCES `tbl_indicator` (`id`),
  CONSTRAINT `fk_evaluation_tracing_id` FOREIGN KEY (`tracing_id`) REFERENCES `tbl_tracing` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_indicator`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_indicator`;
CREATE TABLE IF NOT EXISTS `tbl_indicator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_period`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_period`;
CREATE TABLE IF NOT EXISTS `tbl_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `star` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_person`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_person`;
CREATE TABLE IF NOT EXISTS `tbl_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `gender` smallint(6) NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_postulant`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_postulant`;
CREATE TABLE IF NOT EXISTS `tbl_postulant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_postulant_person_id` (`person_id`) USING BTREE,
  KEY `idx_postulant_period_id` (`period_id`) USING BTREE,
  CONSTRAINT `fk_postulant_period_id` FOREIGN KEY (`period_id`) REFERENCES `tbl_period` (`id`),
  CONSTRAINT `fk_postulant_person_id` FOREIGN KEY (`person_id`) REFERENCES `tbl_person` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_report`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_report`;
CREATE TABLE IF NOT EXISTS `tbl_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postulant_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postulant_id` (`postulant_id`),
  CONSTRAINT `fk_report_postulant_id` FOREIGN KEY (`postulant_id`) REFERENCES `tbl_postulant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_requirement`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_requirement`;
CREATE TABLE IF NOT EXISTS `tbl_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_school`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_school`;
CREATE TABLE IF NOT EXISTS `tbl_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_subject`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_teaching`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_teaching`;
CREATE TABLE IF NOT EXISTS `tbl_teaching` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_teaching_person_id` (`person_id`),
  KEY `idx_teaching_period_id` (`period_id`),
  KEY `idx_teaching_school_id` (`school_id`),
  KEY `idx_teaching_course_id` (`course_id`),
  KEY `idx_teaching_subject_id` (`subject_id`),
  CONSTRAINT `fk_teaching_course_id` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`id`),
  CONSTRAINT `fk_teaching_period_id` FOREIGN KEY (`period_id`) REFERENCES `tbl_period` (`id`),
  CONSTRAINT `fk_teaching_person_id` FOREIGN KEY (`person_id`) REFERENCES `tbl_person` (`id`),
  CONSTRAINT `fk_teaching_school_id` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`),
  CONSTRAINT `fk_teaching_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_tracing`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_tracing`;
CREATE TABLE IF NOT EXISTS `tbl_tracing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `person_id` int(11) NOT NULL,
  `period_id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `observation` text,
  PRIMARY KEY (`id`),
  KEY `idx_tracing_person_id` (`person_id`),
  KEY `idx_tracing_period_id` (`period_id`),
  KEY `idx_tracing_school_id` (`school_id`),
  CONSTRAINT `fk_tracing_period_id` FOREIGN KEY (`period_id`) REFERENCES `tbl_period` (`id`),
  CONSTRAINT `fk_tracing_person_id` FOREIGN KEY (`person_id`) REFERENCES `tbl_person` (`id`),
  CONSTRAINT `fk_tracing_school_id` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `tbl_user`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `role` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE DATA tbl_course
-- -------------------------------------------
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('1','1','1');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('2','1','2');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('3','1','3');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('4','1','4');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('5','1','5');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('8','1','6');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('9','2','1');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('10','2','2');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('11','2','3');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('12','2','4');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('13','2','5');;;
INSERT INTO `tbl_course` (`id`,`level`,`grade`) VALUES
('14','2','6');;;
-- -------------------------------------------
-- TABLE DATA tbl_course
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_documentation
-- -------------------------------------------
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('47','1','1494/9854/95591bab17e4e279.30999906.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('48','2','1494/9854/95591bab17ebcdc9.18910955.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('49','3','1494/9854/95591bab17ee2519.39341485.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('50','4','1494/9854/95591bab17f06409.66987477.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('51','5','1494/9854/96591bab18064d50.85588305.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('52','6','1494/9854/96591bab180b7827.96513754.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('53','7','1494/9854/96591bab180cfc26.02985089.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('54','8','1494/9854/96591bab180f1120.41941355.jpg','73');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('56','1','1494/9857/17591babf5b2d071.30863851.jpg','74');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('57','1','1494/9859/00591bacac35e218.25799785.png','75');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('58','2','1494/9859/00591bacac3e3cb3.97688630.png','75');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('60','6','1494/9860/18591bad22a2b935.21440996.png','76');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('65','1','1495/1636/37591e62f5049a73.49909237.png','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('66','2','1495/1636/37591e62f50c3234.61658706.jpg','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('67','3','1495/1636/37591e62f50e1985.56786998.jpg','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('68','4','1495/1636/37591e62f50f8e15.43430753.png','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('69','5','1495/1636/37591e62f51a9004.44946298.jpg','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('70','6','1495/1636/37591e62f51bdba0.28968014.gif','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('71','7','1495/1636/37591e62f51da751.96752345.png','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('72','8','1495/1636/37591e62f51f65d9.28353525.png','79');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('73','1','1495/2142/79591f28c7c57d04.12727762.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('74','2','1495/2142/79591f28c7c9b011.07721413.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('75','3','1495/2142/79591f28c7cb33f7.91477629.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('76','4','1495/2142/79591f28c7ccb313.07883347.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('77','5','1495/2142/79591f28c7ce4862.94612325.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('78','6','1495/2142/79591f28c7d08162.17883254.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('79','7','1495/2142/79591f28c7d1ef33.87676135.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('80','8','1495/2142/79591f28c7d39820.86342968.jpg','80');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('81','1','1495/2145/28591f29c0707be7.69039562.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('82','2','1495/2145/28591f29c0744578.59791646.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('83','3','1495/2145/28591f29c075c624.30855183.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('84','4','1495/2145/28591f29c07b0b33.91856324.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('85','5','1495/2145/28591f29c07fa946.17563106.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('86','6','1495/2145/28591f29c0812767.66488934.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('87','7','1495/2145/28591f29c084ae64.67447211.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('88','8','1495/2145/28591f29c0862f91.23477574.jpg','81');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('89','1','1495/2156/92591f2e4c45a703.44046373.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('90','2','1495/2156/92591f2e4c4bf5e5.06642042.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('91','3','1495/2156/92591f2e4c503b04.95854066.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('92','4','1495/2156/92591f2e4c5228b8.70871475.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('93','5','1495/2156/92591f2e4c538f05.30230753.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('94','6','1495/2156/92591f2e4c54f4a0.89839567.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('95','7','1495/2156/92591f2e4c565513.50832924.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('96','8','1495/2156/92591f2e4c57b023.70175525.jpg','89');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('97','1','1495/2158/42591f2ee2dd2050.71821347.jpg','90');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('98','2','1495/2158/42591f2ee2e03280.73014765.jpg','90');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('99','3','1495/2158/42591f2ee2e66f16.88538429.jpg','90');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('100','1','1495/3990/775921faa5cc5131.87952950.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('101','2','1495/3990/775921faa5d19e09.77687273.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('102','3','1495/3990/775921faa5d3cbc3.43622375.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('103','4','1495/3990/775921faa5d52c75.97933827.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('104','5','1495/3990/775921faa5da4da5.88610145.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('105','6','1495/3990/775921faa5e37b09.01178088.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('106','7','1495/3990/775921faa5e4e7a2.33903621.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('107','8','1495/3990/775921faa5e65190.49327381.png','92');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('108','1','1495/6559/245925e5f4391ea3.30233187.jpg','93');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('109','3','1495/6559/245925e5f444f7f0.69181442.jpg','93');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('110','4','1495/6559/245925e5f446a948.11790196.jpg','93');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('111','5','1495/6559/245925e5f44c7328.37414344.jpg','93');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('112','6','1495/6559/245925e5f46282e4.89221540.jpg','93');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('113','8','1495/6559/245925e5f46876b0.41337005.jpg','93');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('114','1','1495/6657/4159260c4d4c7bf9.03714971.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('115','2','1495/6657/4159260c4d55be11.92569747.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('116','3','1495/6657/4159260c4d572898.02694346.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('117','4','1495/6657/4159260c4d58ae28.09365316.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('118','5','1495/6657/4159260c4d5a0685.44998698.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('119','6','1495/6657/4159260c4d5b75f2.21490655.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('120','7','1495/6657/4159260c4d5d6f64.66304843.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('121','8','1495/6657/4159260c4d5ec912.00625588.jpg','94');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('122','1','1495/6662/4259260e424c6cd5.35553667.jpg','95');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('123','2','1495/6662/4259260e424f73c5.81388279.jpg','95');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('124','3','1495/6662/4259260e425602c0.50391217.jpg','95');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('125','1','1495/6665/9459260fa21339d1.54317374.jpg','96');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('126','3','1495/6665/9459260fa215f801.55571150.jpg','96');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('127','4','1495/6665/9459260fa2184295.83587562.jpg','96');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('128','5','1495/6665/9459260fa219d542.94437064.jpg','96');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('129','1','1495/6670/055926113dec3b79.22806486.jpg','97');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('130','3','1495/6670/055926113df37576.81387692.jpg','97');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('131','4','1495/6670/065926113e00d444.41051419.jpg','97');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('132','5','1495/6670/065926113e0953b7.46211749.jpg','97');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('133','6','1495/6670/065926113e0f3183.01748495.jpg','97');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('134','1','1495/6673/77592612b17b3321.81127364.jpg','98');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('135','3','1495/6673/77592612b17e0568.18183158.jpg','98');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('136','4','1495/6673/77592612b17f9d30.27919845.jpg','98');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('137','1','1495/6676/66592613d21de344.23684927.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('138','3','1495/6676/66592613d2287ab8.58918740.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('139','4','1495/6676/66592613d22a9772.62966954.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('140','5','1495/6676/66592613d22c2153.61419929.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('141','6','1495/6676/66592613d22d6735.65807303.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('142','7','1495/6676/66592613d22eb764.14365297.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('143','8','1495/6676/66592613d2302418.44551821.jpg','99');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('144','1','1495/7160/405926d0c8804642.70099156.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('145','2','1495/7160/405926d0c883f3f8.76394497.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('146','3','1495/7160/405926d0c8856035.62787794.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('147','4','1495/7160/405926d0c886c0a9.11710285.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('148','5','1495/7160/405926d0c88803e0.53293807.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('149','6','1495/7160/405926d0c8897af4.64722947.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('150','7','1495/7160/405926d0c8b83ab2.70477312.jpg','100');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('151','1','1495/7165/115926d29fc9ab80.86026202.jpg','101');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('152','2','1495/7165/115926d29fccd769.81630579.jpg','101');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('153','4','1495/7165/115926d29fcec1a4.14135224.jpg','101');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('154','5','1495/7165/115926d29fd02420.00797851.jpg','101');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('155','6','1495/7165/115926d29fd189e7.33709032.jpg','101');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('156','1','1495/7240/015926efe1710775.98296507.jpg','104');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('157','3','1495/7240/015926efe1786c63.34448423.jpg','104');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('158','4','1495/7240/015926efe17c8939.60887381.jpg','104');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('159','5','1495/7240/015926efe1835456.76352517.jpg','104');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('160','6','1495/7240/015926efe18c1f70.27499968.jpg','104');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('161','7','1495/7240/015926efe191a0d3.28382215.jpg','104');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('162','1','1495/7243/845926f16068f688.15941056.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('163','2','1495/7243/845926f1606c9aa6.96081893.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('164','3','1495/7243/845926f1606dec38.56001865.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('165','4','1495/7243/845926f1606f8e04.55133073.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('166','5','1495/7243/845926f16070e214.09539650.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('167','6','1495/7243/845926f160722af4.36073922.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('168','7','1495/7243/845926f16077ecd9.38146110.jpg','105');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('169','1','1496/0660/49592c2801d4d096.78575409.jpg','108');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('170','2','1496/0660/49592c2801d86ea5.63466384.jpg','108');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('171','3','1496/0660/49592c2801dd3f67.54203751.jpg','108');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('172','5','1496/0660/49592c2801e21af4.66390888.jpg','108');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('173','6','1496/0660/49592c2801e387f5.66444605.jpg','108');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('174','7','1496/0660/49592c2801e57266.08640155.jpg','108');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('175','1','1496/0664/49592c2991adc5c9.31867128.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('176','3','1496/0664/49592c2991b49e63.46266245.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('177','4','1496/0664/49592c2991bfbcd7.97446814.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('178','5','1496/0664/49592c2991c15214.52894963.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('179','6','1496/0664/49592c2991c2daa0.21699329.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('180','7','1496/0664/49592c2991c44386.43740130.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('181','8','1496/0664/49592c2991c5b719.25012776.jpg','109');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('182','1','1496/5235/11593322f7817533.63129764.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('183','2','1496/5235/11593322f787edf9.55350365.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('184','3','1496/5235/11593322f78944c0.89364144.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('185','4','1496/5235/11593322f78adc98.50827095.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('186','5','1496/5235/11593322f78e9717.05634142.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('187','6','1496/5235/11593322f799b160.95134645.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('188','7','1496/5235/11593322f79fd683.66917961.jpg','110');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('189','1','1496/5240/625933251e8bb7a9.26891799.jpg','111');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('190','4','1496/5240/625933251e8f6268.07324963.jpg','111');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('191','5','1496/5240/625933251e912873.44300111.jpg','111');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('192','6','1496/5240/625933251e92c273.39001358.jpg','111');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('193','8','1496/5240/625933251e943a00.12890037.jpg','111');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('194','1','1496/5244/79593326bf637385.21268248.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('195','2','1496/5244/79593326bf6a4066.51207956.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('196','3','1496/5244/79593326bf6bb747.94009411.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('197','4','1496/5244/79593326bf6d5539.18944367.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('198','5','1496/5244/79593326bf7adb33.66310942.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('199','6','1496/5244/79593326bf7c43c0.10964558.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('200','7','1496/5244/79593326bf7e7695.37873768.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('201','8','1496/5244/79593326bf8019c5.36564507.jpg','112');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('202','1','1496/5262/5459332dae829235.99041304.jpg','113');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('203','3','1496/5262/5459332dae889000.21999222.jpg','113');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('204','5','1496/5262/5459332dae8a4c44.33091955.jpg','113');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('205','6','1496/5262/5459332dae8bf675.70723277.jpg','113');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('206','7','1496/5262/5459332dae8d4687.37155338.jpg','113');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('207','8','1496/5262/5459332dae8e8fa7.73690085.jpg','113');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('208','1','1496/5266/9059332f6288c927.42112736.jpg','114');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('209','4','1496/5266/9059332f628c7258.35360314.jpg','114');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('210','6','1496/5266/9059332f62913fd5.92263088.jpg','114');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('211','7','1496/5266/9059332f629282f2.95303932.jpg','114');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('212','1','1496/5270/29593330b55f3525.30301888.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('213','3','1496/5270/29593330b57f1004.60189523.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('214','4','1496/5270/29593330b5806bc1.09702508.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('215','5','1496/5270/29593330b5820755.01301289.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('216','6','1496/5270/29593330b585b165.00663018.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('217','7','1496/5270/29593330b586edf3.97500002.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('218','8','1496/5270/29593330b5881d38.32452532.jpg','115');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('226','1','1496/5277/00593333546a1125.40532502.jpg','117');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('227','3','1496/5277/0059333354712081.64600862.jpg','117');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('228','4','1496/5277/005933335472adb0.47585688.jpg','117');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('229','5','1496/5277/0059333354742a30.09436655.jpg','117');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('230','6','1496/5277/0059333354758c98.30243379.jpg','117');;;
INSERT INTO `tbl_documentation` (`id`,`requirement_id`,`value`,`postulant_id`) VALUES
('231','7','1496/5277/005933335476e552.37023832.jpg','117');;;
-- -------------------------------------------
-- TABLE DATA tbl_documentation
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_evaluation
-- -------------------------------------------
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('1','1','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('2','1','3','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('3','1','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('4','1','5','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('5','1','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('6','2','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('7','2','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('8','2','4','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('9','2','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('10','2','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('11','3','2','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('12','3','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('13','3','4','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('14','3','5','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('15','3','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('16','4','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('17','4','3','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('18','4','4','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('19','4','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('20','4','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('21','5','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('22','5','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('23','5','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('24','5','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('25','5','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('26','6','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('27','6','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('28','6','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('29','6','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('30','6','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('31','7','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('32','7','3','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('33','7','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('34','7','5','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('35','7','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('36','8','2','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('37','8','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('38','8','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('39','8','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('40','8','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('41','9','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('42','9','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('43','9','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('44','9','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('45','9','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('46','10','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('47','10','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('48','10','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('49','10','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('50','10','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('51','11','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('52','11','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('53','11','4','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('54','11','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('55','11','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('56','12','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('57','12','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('58','12','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('59','12','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('60','12','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('61','13','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('62','13','3','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('63','13','4','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('64','13','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('65','13','6','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('66','14','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('67','14','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('68','14','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('69','14','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('70','14','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('71','15','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('72','15','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('73','15','4','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('74','15','5','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('75','15','6','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('76','16','2','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('77','16','3','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('78','16','4','0');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('79','16','5','1');;;
INSERT INTO `tbl_evaluation` (`id`,`tracing_id`,`indicator_id`,`value`) VALUES
('80','16','6','0');;;
-- -------------------------------------------
-- TABLE DATA tbl_evaluation
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_indicator
-- -------------------------------------------
INSERT INTO `tbl_indicator` (`id`,`name`) VALUES
('2','Asiste puntualmente');;;
INSERT INTO `tbl_indicator` (`id`,`name`) VALUES
('3','Planificaciones anuales');;;
INSERT INTO `tbl_indicator` (`id`,`name`) VALUES
('4','Plan de clase');;;
INSERT INTO `tbl_indicator` (`id`,`name`) VALUES
('5','Registro pedagógico');;;
INSERT INTO `tbl_indicator` (`id`,`name`) VALUES
('6','Participacion extacurricular de la U.E.');;;
-- -------------------------------------------
-- TABLE DATA tbl_indicator
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_migration
-- -------------------------------------------
INSERT INTO `tbl_migration` (`version`,`apply_time`) VALUES
('m000000_000000_base','1479664502');;;
INSERT INTO `tbl_migration` (`version`,`apply_time`) VALUES
('m161120_161258_init','1479664512');;;
INSERT INTO `tbl_migration` (`version`,`apply_time`) VALUES
('m161204_172022_docencia','1480876135');;;
-- -------------------------------------------
-- TABLE DATA tbl_migration
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_period
-- -------------------------------------------
INSERT INTO `tbl_period` (`id`,`name`,`star`,`end`) VALUES
('1','Gestion 2016','2016-11-20','2016-11-21');;;
INSERT INTO `tbl_period` (`id`,`name`,`star`,`end`) VALUES
('2','Gestion 2 - 2016','2016-11-30','2016-12-30');;;
INSERT INTO `tbl_period` (`id`,`name`,`star`,`end`) VALUES
('3','Gestion 2017','2017-01-06','2017-12-06');;;
-- -------------------------------------------
-- TABLE DATA tbl_period
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_person
-- -------------------------------------------
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('2','4961756','Henrry Surco Alvan','0','1','1988-04-25','74001038','Barrio Paraiso','1494/9854/22591baacec412d2.25016074.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('3','7586024','Miguel Mendez Jimenez','0','1','2016-11-16','75462290','Barrio Brisas el Acre','');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('5','348759384','Ruddy Mochairo Aguada','1','1','1980-03-07','76452523','barrio Amistad','1494/9855/78591bab6a6297a4.00362406.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('9','869809','Juan Perez','0','1','1960-06-16','78234567','Calle del Pecado','1494/9857/87591bac3bbcad43.31493323.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('14','7892930','Jermina Mamani Gabriel','0','2','1990-11-20','78920392','Barrio 27 de Mayo','1494/9858/05591bac4d8c9380.26827522.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('20','1820202','Juancito Pinto','0','1','2006-02-24','60213243','Barrio Paraiso','1494/9858/26591bac621eb167.00543852.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('22','7835232','Karen Saravia Mamani','1','2','2017-05-18','67309288','Zona Alto Lima','1495/1635/07591e627368d564.42277033.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('23','548091','Marcela Vega Sainz','1','2','1989-05-05','71546289','Zona 16 de Febrero','1495/2141/91591f286fe982f4.16048288.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('24','310920','Amanda Velarde Perez','1','2','1989-07-16','71590234','Zona 16 de Febrero','1495/2146/08591f2a1047a642.81463907.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('25','762893','Maicol Alderete M.','0','1','2001-04-06','72679810','Barrio Brisas del Acre','1495/2149/99591f2b97e3e6c7.86001048.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('26','468901','Melisa Mosqueria M.','0','2','2000-06-28','67662309','Barrio 27 de Mayo','1495/2150/76591f2be41578c9.55316666.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('27','334982','Edwin Mamani Huanca','1','1','1989-07-28','72919694','Barrio San Juan','1495/2156/45591f2e1d4e7819.31991549.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('28','738190','Reinaldo Rossel Mitchel','0','1','1989-10-05','73609187','Barrio Paraiso','1495/2158/03591f2ebb9d2032.89688713.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('29','798120','Samuel Arrazola Humaza','0','1','1989-07-19','67668921','Barrio Santa Clara','1495/2159/18591f2f2e06b8d3.11830151.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('30','6582911','Dayane Justiniano Hinojosa','1','2','1990-09-14','66531200','Zona Brasil','1495/3990/295921fa7524f562.87974424.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('31','6772459','Marilin Quispe Apaza','0','2','1990-07-13','71692833','Villa Tunari S/N','1495/6555/115925e4576a8a55.79100970.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('32','5124483','Carlos Condori Calatayud','0','1','1981-07-15','76109022','Conquista Mun. Puerto Rico','1495/6656/7959260c0f34cf67.85936558.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('33','8234569','Dayana Mendoza Franco','0','2','1990-08-29','76148900','Barrio Mapajo','');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('34','4510728','Dionicia Argandoña Velasco','0','2','1990-09-19','75103455','Barrio Senac','');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('35','3537161','Ely Estela Velasco Meneses','1','2','1976-06-14','67662344','Barrio Villa Cruz','');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('36','4206873','Eva Esperanza Mendez Apinaye','0','2','1991-06-20','67662322','Barrio Paraiso','1495/6673/3459261286737615.03613439.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('37','6006020','Gladys Silvia Guerra Marcarani','0','2','1984-05-15','71523879','Calatayud','1495/6675/875926138322a136.50307225.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('38','9996051','Hector Yapuchura Chambilla','0','1','1996-05-30','71522347','Barrio Perla del Acre','1495/7159/375926d0618f2982.81646061.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('39','5700993','Hedil Edilson Mamani Mamani','0','1','1991-08-20','75182900','Barrio 27 de Mayo ','1495/7163/345926d1eea7db16.52109242.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('40','6788362','Jacqueline Herrera Pinto','0','1','1988-10-20','7121902','Av. Pando / Barrio Santa Clara','1495/7239/265926ef966c7916.91086387.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('41','7089586','Jordi Ariel Espinoza Valdez','0','1','1991-09-21','67664567','Av. 9 de Febrero ','1495/7242/575926f0e1c61c92.20637968.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('42','6146411','Jose Luis Condori Pillco','0','1','1982-08-20','71921998','Barrio 1ro de Mayo','1496/0659/38592c2792be4951.25026348.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('43','1929829','Lenida Roca Guasace','0','2','1968-10-20','67661009','Barrio Paraiso','1496/0663/58592c293686be65.30758995.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('44','7080767','Luis Alberto Condori Choque','0','1','1989-01-06','67118200','Barrio Santa Clara, Av. Pando','1496/5234/0959332291bfdb38.54445780.png');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('45','1760413','Maria Marcela Fernandez Sosa','0','2','1965-02-22','76101089','Barrio 27 de Junio','1496/5239/91593324d783d296.81099622.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('46','6036588','Maria Soledad Ticona Sanga','0','2','1984-05-05','71511890','Av. Pando','1496/5243/3859332632b78617.30206301.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('47','7614858','Modesta Hurtado Quevedo','0','2','1988-09-27','76102890','Barrio Perla del Acre','1496/5261/8759332d6b90d743.98101867.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('48','4202911','Monica Regina Fernandez Figueredo','1','2','1990-07-15','67771900','Barrio Mapajo','1496/5266/3359332f293453c3.28417857.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('49','4886478','Morelia Chura Choquehuanca','0','2','1995-06-26','75100090','Barrio Pantanal','1496/5269/715933307b5298c3.38073657.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('50','7039425','Nelly Jenny Ramos Chavarria','0','2','1980-12-06','71566279','Av. Pando','1496/5273/39593331eb46ef52.05279198.jpg');;;
INSERT INTO `tbl_person` (`id`,`identity`,`name`,`status`,`gender`,`birthdate`,`phone`,`address`,`picture`) VALUES
('51','6948920','Ninoska Perez Zapata','0','2','1993-03-31','71921900','Barrio Puerto Alto','1496/5276/4859333320ed7925.35858151.jpg');;;
-- -------------------------------------------
-- TABLE DATA tbl_person
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_postulant
-- -------------------------------------------
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('73','2','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('74','5','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('75','14','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('76','20','3','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('77','3','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('79','22','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('80','23','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('81','24','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('82','25','3','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('83','26','3','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('84','26','1','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('85','26','2','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('86','25','2','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('87','24','2','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('88','24','1','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('89','27','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('90','28','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('91','29','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('92','30','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('93','31','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('94','32','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('95','33','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('96','34','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('97','35','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('98','36','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('99','37','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('100','38','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('101','39','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('102','33','1','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('103','38','1','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('104','40','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('105','41','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('106','34','1','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('107','35','1','0');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('108','42','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('109','43','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('110','44','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('111','45','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('112','46','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('113','47','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('114','48','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('115','49','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('116','50','3','1');;;
INSERT INTO `tbl_postulant` (`id`,`person_id`,`period_id`,`approved`) VALUES
('117','51','3','1');;;
-- -------------------------------------------
-- TABLE DATA tbl_postulant
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_report
-- -------------------------------------------
INSERT INTO `tbl_report` (`id`,`postulant_id`,`file`,`description`) VALUES
('1','73','1496/1591/39592d93a3b2a124.48085400.jpg','Informe del mes de Abril');;;
INSERT INTO `tbl_report` (`id`,`postulant_id`,`file`,`description`) VALUES
('2','108','1496/1580/95592d8f8ff322c9.20649922.jpg','Informe del mes de Abril');;;
-- -------------------------------------------
-- TABLE DATA tbl_report
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_requirement
-- -------------------------------------------
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('1','Título Profesional o Certificado de Egreso','1');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('2','Libreta Servicio Militar','0');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('3','Certificado de Nacimiento','1');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('4','Carta de solicitud','0');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('5','Carnet de Indentidad','1');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('6','Certificado del R.E.J.A.P.','1');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('7','Declaración Jurada','1');;;
INSERT INTO `tbl_requirement` (`id`,`name`,`type`) VALUES
('8','RDA Actualizado','0');;;
-- -------------------------------------------
-- TABLE DATA tbl_requirement
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_school
-- -------------------------------------------
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('1','Mariano Baptista','8420542','Avenida 9 de Febrero');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('2','Dr. Antonio Vaca Diez (Primaria)','8423456','Barrio Brisas del Acre');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('3','Defensores del Acre','8425734','Barrio Paraíso');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('4','Heroes de la Distancia','8423578','Barrio Mapajo');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('5','Dr. Antonio Vaca Diez (Nivel Secundario)','8425689','Barrio Brisas del Acre');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('6','Unidad Educativa Rogelia Menacho deBalcazar','8429076','Barrio Santa Clara');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('7','Fé y Alegría Nuestra Señora del Pilar','8421109','Villa Buch');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('8','Fé y Alegría San Francisco de Assis','8425672','Villa Buch');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('9','Unidad Educativa Bella Vista','8424466','Barrio Paz Zamora');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('10','Rogelia Menacho de Balcazar','834549','Barrio San Juan');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('11','Simón Bolivar','8429870','Barrio Perla del Acre');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('12','Manuela Rojas Dominguez','8421098','Barrio 11 de Junio Ex Cacique');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('13','C.E.A. Juan Oliveira Barros','8427743','Barrio Cataratas');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('14','Juana Azurduy de Padilla','8429900','Barri Petrolero');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('15','Jose Manuel Pando','8421233','Avenida Pando Barrio Santa Clara');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('16','German Buch Becerra','8427571','Villa Buch');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('17','Educación Especial Esther Campos','8424499','Villa Buch');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('18','Bella Vista','8429901','Villa Buch');;;
INSERT INTO `tbl_school` (`id`,`name`,`phone`,`address`) VALUES
('19','Unidad Educativa Madre Nazaria','8429901','Barrio Nazaria');;;
-- -------------------------------------------
-- TABLE DATA tbl_school
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_subject
-- -------------------------------------------
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('2','MAT-110','Matematicas');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('3','FISICA 120','Fisica');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('4','Prim 01','Docente de aula Primaria');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('5','E01','Educación Física');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('6','Len02','Lengua originaria');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('7','01FIS','Física');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('8','01quim','Química');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('9','01cn','Ciencias Naturales');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('10','CSOCIALES','Ciencias Sociales');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('11','Leng01','Lenguaje ');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('12','tec01','Técnica Tecnológica');;;
INSERT INTO `tbl_subject` (`id`,`code`,`name`) VALUES
('13','ap01','Artes Plásticas');;;
-- -------------------------------------------
-- TABLE DATA tbl_subject
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_teaching
-- -------------------------------------------
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('22','2','3','5','8','2');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('23','5','3','10','3','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('24','14','3','1','8','8');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('26','3','3','7','1','2');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('27','22','3','3','1','2');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('28','23','3','8','5','5');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('29','24','3','3','4','9');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('30','27','3','2','2','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('31','28','3','5','3','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('32','29','3','5','4','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('33','30','3','10','2','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('34','32','3','10','1','6');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('35','33','3','11','8','9');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('36','34','3','12','1','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('37','35','3','13','12','11');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('38','36','3','14','12','9');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('40','37','3','3','8','9');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('41','38','3','15','12','9');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('43','39','3','13','13','12');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('44','33','3','11','11','6');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('45','38','3','15','8','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('46','40','3','15','5','9');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('47','41','3','15','9','12');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('48','34','3','12','2','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('49','35','3','13','14','12');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('50','42','3','16','4','2');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('51','43','3','10','5','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('52','44','3','16','3','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('53','45','3','15','8','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('54','46','3','17','8','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('55','31','3','18','3','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('56','47','3','4','4','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('57','48','3','8','14','12');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('58','49','3','19','12','13');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('59','50','3','17','2','4');;;
INSERT INTO `tbl_teaching` (`id`,`person_id`,`period_id`,`school_id`,`course_id`,`subject_id`) VALUES
('60','51','3','15','2','4');;;
-- -------------------------------------------
-- TABLE DATA tbl_teaching
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_tracing
-- -------------------------------------------
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('1','2017-03-06','2','2','1','Algo?');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('2','2017-03-08','2','2','1','Llega frecuentemente atrasado');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('3','2017-03-20','2','2','1','este joven se ralla');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('4','2017-04-12','5','1','4','No lleva adecuadamente el registro pedagógico');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('5','2017-04-20','2','2','1','');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('6','2017-04-28','2','2','1','No planifica bien sus clases');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('7','2017-04-30','3','3','2','');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('8','2017-05-03','9','3','5','Este docente no participa activamente en actividades extra curriculares de la unidad educativa');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('9','2017-05-11','2','3','5','Participa poco , en las actividades extracurriculares de la Unidad Educativa, se sugiere que el Docente sea mas participativo en las diferentes actividades y horas civicas');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('10','2017-05-12','14','3','1','Ninguna');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('11','2017-05-14','14','3','1','');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('12','2017-05-15','20','3','9','es bueno');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('13','2017-05-19','23','3','8','No planifica bien sus clases');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('14','2017-05-19','24','3','3','Sin observción');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('15','2017-05-21','30','3','10','No registra de manera oportuna actividades de los estudiantes en su registro pedagogico');;;
INSERT INTO `tbl_tracing` (`id`,`date`,`person_id`,`period_id`,`school_id`,`observation`) VALUES
('16','2017-05-24','33','3','11','No planifica correctamete su plan de clase , al no coincidir con su plan anual , y la participación extracurricular dentro de la Unidad Educativa no es optima.');;;
-- -------------------------------------------
-- TABLE DATA tbl_tracing
-- -------------------------------------------



-- -------------------------------------------
-- TABLE DATA tbl_user
-- -------------------------------------------
INSERT INTO `tbl_user` (`id`,`username`,`password_hash`,`email`,`auth_key`,`status`,`role`) VALUES
('1','root','$2y$13$A2EfJKjRre2Y8rGdjVgT0OMHkfIpItIYSqQaOzWayWfHYdKCW3lxe','admin@gmail.com','sR02Tt4OLi4fZmhgaHh5Jv2yiJrPLC2I','1','admin');;;
INSERT INTO `tbl_user` (`id`,`username`,`password_hash`,`email`,`auth_key`,`status`,`role`) VALUES
('2','director','$2y$13$vNHqXKHvXjzHKvQOm.IdpOU3wYsVPmMsB.WCAC1OtR7hoOHvgRfhC','algo@gmail.com','7ZRcPSZ0GwZGi-kkrI7Kz3gMqQyHYqzN','1','director');;;
-- -------------------------------------------
-- TABLE DATA tbl_user
-- -------------------------------------------



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
