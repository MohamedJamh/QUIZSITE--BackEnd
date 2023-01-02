-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 31 déc. 2022 à 21:55
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizsite`
--

-- --------------------------------------------------------
--
-- Structure de la table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;


--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`name`) VALUES
('php quiz'),
('html quiz');

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `correct_answer_order` varchar(11) NOT NULL,
  `id_quiz` int(11),
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`content`, `correct_answer_order`,`id_quiz`) VALUES
('Que signifie PHP?', '3',1),
('Quelle version de PHP a introduit Try/catch Exception?', '2',1),
('Abbreviation html ?', '3',2),
('Qui fait les normes du Web', '4',2);
-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `valid` boolean NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id_answer`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `responses`
--

INSERT INTO `answers` (`content`, `order`, `valid`, `question_id`) VALUES
('Personal Home Page Hypertext Preprocessor', 1, 1, 1),
('Pretext Hypertext Processor', 2, 0, 1),
('Preprocessor Home Page', 3, 0, 1),

('PHP 4', 1, 0, 2),
('PHP 5', 2, 1, 2),
('PHP 5.3', 3, 0, 2),
('PHP 7.2', 4, 0, 2),

('hypelinks And Text Markup language', 1, 0, 3),
('Hyper Tool Markup language', 2, 0, 3),
('Hyper Text Markup language', 3, 1, 3),

('Microsoft', 1, 0, 4),
('Google', 2, 0, 4),
('Ecma', 3, 0, 4),
('World Wide Web Cns ', 4, 1, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
