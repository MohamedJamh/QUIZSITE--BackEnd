-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2023 at 10:20 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `answer_content` varchar(255) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_answer`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id_answer`, `id_question`, `answer_content`, `order`, `valid`) VALUES
(1, 3, 'Pretext Hypertext Processor', 1, 0),
(2, 3, 'Preprocessor Home Page', 2, 0),
(3, 3, 'Personal Home Page Hypertext Preprocessor', 3, 1),
(4, 3, 'Pretext Hypertext Processor', 4, 0),
(5, 4, '.html', 1, 0),
(6, 4, '.xml', 2, 0),
(7, 4, '.php', 3, 1),
(8, 4, '.ph', 4, 0),
(9, 8, 'World Wide Web Consortium', 1, 1),
(10, 8, 'Mozila (MDN)', 2, 0),
(11, 8, 'Google', 3, 0),
(12, 8, 'Microsoft', 4, 0),
(13, 7, 'Hyperlinks and Markup Language', 1, 0),
(14, 7, 'Hyper Text Markup language', 2, 1),
(15, 7, 'Extensible hypertext markup language', 3, 1),
(16, 9, '<php', 1, 0),
(17, 9, '<?', 2, 0),
(18, 9, '<?php', 3, 1),
(19, 9, 'php', 4, 0),
(20, 17, 'PHP 4', 1, 0),
(21, 17, 'PHP 5', 2, 1),
(22, 17, 'PHP 5.3', 3, 0),
(23, 17, 'PHP 7.2', 4, 0),
(24, 11, 'PHP 4', 1, 0),
(25, 11, 'PHP 5', 2, 0),
(26, 11, 'PHP 5.3', 3, 0),
(27, 11, 'PHP 6', 4, 1),
(28, 12, 'static', 1, 0),
(29, 12, 'final', 2, 0),
(30, 12, 'public', 3, 0),
(31, 12, 'friendly', 4, 1),
(32, 13, 'les attributs', 1, 1),
(33, 13, 'des proprietes', 2, 1),
(34, 13, 'des instances', 3, 1),
(35, 15, 'abstract', 1, 0),
(36, 15, 'protected', 2, 0),
(37, 15, 'final', 3, 1),
(38, 15, 'static', 4, 0),
(39, 14, 'fonction membre', 1, 1),
(40, 14, 'instances', 2, 0),
(41, 14, 'objects', 3, 0),
(42, 14, 'constructeurs', 4, 0),
(43, 16, '/?', 1, 0),
(44, 16, '#', 2, 0),
(45, 16, '//', 3, 1),
(46, 16, '/* */', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `score` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `ip_adresse` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_quiz` (`id_quiz`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `username`, `id_quiz`, `score`, `date`, `ip_adresse`, `os`, `browser`) VALUES
(114, 'test', 1, 100, '2023-01-03 10:13:24', '::1', 'Windows 10', 'Chrome');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `correct_answer_order` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_question`),
  KEY `id_quiz` (`id_quiz`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_question`, `content`, `id_quiz`, `correct_answer_order`) VALUES
(3, 'Que signifie PHP?', 1, '3'),
(4, 'Les fichiers PHP ont l extension ?', 1, '3'),
(7, 'Abbreviation de html ?', 2, '23'),
(8, 'Qui fait les standards du Web ?', 2, '1'),
(9, 'Un script PHP devrait commencer par ?', 1, '3'),
(11, 'Les espaces de noms ou < namespaces > sont disponibles depuis quelle version ?', 1, '4'),
(12, 'Laquelle des portees suivantes n est pas prise en charge en PHP?', 1, '4'),
(13, 'Les variables membres d une classe sont egalement appelees  ?', 1, '123'),
(14, 'Les methodes sont egalement appelees des ?', 1, '1'),
(15, 'Quelle mot-cle empeche une methode d etre redefinie par une classe file?', 1, '3'),
(16, 'Nous pouvons utiliser pour commenter une seule ligne?', 1, '3'),
(17, 'Quelle version de PHP a introduit Try/catch Exception?', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img_path` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `name`, `img_path`) VALUES
(1, 'PHP quiz', 'https://ih1.redbubble.net/image.276439549.1160/st,small,507x507-pad,600x600,f8f8f8.u9.jpg'),
(2, 'HTML quiz', 'https://usefulangle.com/img/thumb/html.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`) VALUES
(18, 'jehmum'),
(44, 'jemum'),
(48, 'Mohamed Jamh'),
(49, 'test'),
(46, 'ttt');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
