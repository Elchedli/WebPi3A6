-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2021 at 12:20 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spirity`
--

-- --------------------------------------------------------

--
-- Table structure for table `act`
--

CREATE TABLE `act` (
  `id_act` int(11) NOT NULL,
  `nom_act` varchar(50) NOT NULL,
  `type_act` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `act`
--

INSERT INTO `act` (`id_act`, `nom_act`, `type_act`) VALUES
(1, 'mp', 'yoga');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `mail`) VALUES
(16, 'mgkadmin', '$2a$13$h84ZE897OC3M1c1TghADruMr6ATIvqKQ8lbV32NqqWTXo.46eqwxK', 'mgkadmin@mgk2.tn'),
(18, 'finaltestadmin', '$2a$13$cCGTxqoWPE4ToeyGXBNsgOdISMKnTJYHkeFaQXbqt1ypEE5fxhPQ6', 'finaltestadmin@aaaa.aa');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id_art` int(11) NOT NULL,
  `titre_art` varchar(255) NOT NULL,
  `auteur_art` varchar(255) DEFAULT NULL,
  `description_art` varchar(1500) DEFAULT NULL,
  `date_art` datetime DEFAULT CURRENT_TIMESTAMP,
  `likes` int(11) DEFAULT '0',
  `id_cat` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id_art`, `titre_art`, `auteur_art`, `description_art`, `date_art`, `likes`, `id_cat`, `photo`) VALUES
(22, 'régime guide complet pour perdre du poids', 'mgknutri', 'Pour perdre du poids durablement il est essentiel de combiner des changements alimentaires ET une activité sportive\nface à ce double défi certains régimes proposent de véritables plans d\'exercices\nnos experts ont élu les meilleurs régimes qui associent harmonieusement rééquilibrage alimentaire et activité physique', '2021-03-27 02:11:23', 6, 6, 'file:/C:/xampp/htdocs/img/palmares-des-regimes.jpg'),
(23, 'pourquoi aimons nous dessiner', 'test1Coach', 'Dessiner nous pousse à expérimenter des méthodes\ndes techniques afin de se rapprocher le plus possible de la réalité dans le but de la figer dans le temps \nà tout jamais ou au contraire à s’en éloigner tout en l’exprimant à travers notre prisme émotionnel', '2021-03-27 02:22:15', 2, 61, 'file:/C:/xampp/htdocs/img/téléchargement.jpg'),
(24, 'les bienfaits du sport sur la santé', 'mgkcoach', 'L\'activité physique est également un élément de prévention essentiel pour garder des os solides \net prévenir ainsi l\'ostéoporose Pratiquer un sport permet de prévenir les lombalgies et la récurrence des symptômes\nLe renforcement musculaire occasionné lors des exercices physiques est aussi bénéfique pour les rhumatismes inflammatoires chroniques', '2021-03-27 02:26:17', 5, 23, 'file:/C:/xampp/htdocs/img/sp.jpg'),
(45, 'iuiuiu', 'mgkcoach', 'ityghtjty', '2021-04-01 01:40:34', 0, 27, 'http://www..'),
(46, 'kkkk', 'mgkcoach', 'jjjjjjj', '2021-04-01 01:41:56', 0, 61, 'https://i.pinimg.com/736x/5b/b4/8b/5bb48b07fa6e3840bb3afa2bc821b882.jpg'),
(47, 'nbnbnnbnn', 'mgkcoach', 'hfhfhfhfhfhfhf', '2021-04-01 01:42:59', 0, 23, 'http://www..'),
(48, 'uuuuuuu', 'mgkcoach', 'uuuuuuuuuuuuuuuuuuuuuu', '2021-04-01 01:43:36', 0, 6, 'file:/C:/Users/HP/Desktop/Nouveau%20dossier/imgcache0.350705.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `titre_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `titre_cat`) VALUES
(61, 'arts'),
(27, 'Méditation'),
(6, 'Nourriture'),
(23, 'santé'),
(5, 'sport');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(50) NOT NULL,
  `nom_cat` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_cat`, `nom_cat`) VALUES
(10, 'Posts'),
(11, 'Msg'),
(13, 'Technical'),
(14, 'Suivi'),
(16, 'Login'),
(17, 'Articles'),
(19, 'Events'),
(21, 'lol'),
(22, 'lol'),
(23, 'lol'),
(26, 'ppp'),
(29, 'ss'),
(30, 'marathon');

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`id_user`, `username`, `password`, `mail`, `date_n`, `code`) VALUES
(1, 'mgkcoach', '$2a$13$qBxEx/7EVV03YoUof1xGzOKVcAZyenXXL9SRGvljEpzZr2vXFwOgG', 'mgkcoach@mgk2.tn', '2021-03-11', 'ompo'),
(786, 'mourad', '$2a$13$UpkLwSCwnOXFPXUEMXmDuuQdTTUysX9yaLCM7vDLPq7eGgBCGS/Ke', 'mourad@esprit.tn', '1997-04-11', 'tgtgtg');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `suj_com` varchar(500) DEFAULT NULL,
  `date_com` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nb_reaction` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `id_user`, `id_pub`, `suj_com`, `date_com`, `nb_reaction`) VALUES
(24, 53, 247, 'sdqsdsqdqsd', '2021-04-25 04:52:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `id_disc` int(11) NOT NULL,
  `datetemps_disc` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_source` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `nom_destinaire` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `vue_disc` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`id_disc`, `datetemps_disc`, `nom_source`, `nom_destinaire`, `vue_disc`) VALUES
(1, '2021-04-01 03:43:00', 'mgkpsy', 'mgk', 0),
(2, '2021-04-01 03:57:05', 'mgkpsy', 'shidono', 0);

-- --------------------------------------------------------

--
-- Table structure for table `evenement`
--

CREATE TABLE `evenement` (
  `id_ev` int(11) NOT NULL,
  `titre_ev` varchar(80) NOT NULL,
  `type_ev` varchar(50) NOT NULL,
  `emplacement_ev` varchar(30) NOT NULL,
  `date_dev` date NOT NULL,
  `date_fev` date NOT NULL,
  `temps_dev` time NOT NULL,
  `temps_fev` time NOT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `id_act` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evenement`
--

INSERT INTO `evenement` (`id_ev`, `titre_ev`, `type_ev`, `emplacement_ev`, `date_dev`, `date_fev`, `temps_dev`, `temps_fev`, `age_min`, `age_max`, `id_act`) VALUES
(3, 'islem', 'sportif', 'ml', '2021-03-04', '2021-03-20', '15:00:00', '15:00:00', 13, 26, 1),
(73, 'hello', 'sportif', 'from', '2021-03-12', '2021-03-12', '07:00:00', '07:00:00', 12, 26, NULL),
(74, 'ev', 'sportif', 'terrain', '2021-03-04', '2021-03-04', '13:00:00', '13:00:00', 13, 13, NULL),
(76, 'sport', 'sportif', 'tunis', '2021-03-01', '2021-03-02', '15:00:00', '15:00:00', 18, 18, NULL),
(80, 'event', 'loisir', 'ariana', '2021-03-02', '2021-03-03', '15:00:00', '15:00:00', 16, 16, NULL),
(81, 'event', 'loisir', 'ariana', '2021-03-02', '2021-03-03', '15:00:00', '15:00:00', 16, 16, NULL),
(82, 'ayevTEST', 'loisir', 'eee', '2021-03-26', '2021-03-26', '12:00:00', '12:00:00', 15, 15, NULL),
(90, 'islem', 'sportif', 'ml', '2021-03-11', '2021-03-12', '12:00:00', '12:00:00', 15, 15, NULL),
(91, 'islem', 'educatif', 'esprit', '2021-03-04', '2021-03-04', '12:03:00', '12:03:00', 12, 12, NULL),
(93, 'mm', 'sportif', 'ww', '2021-03-05', '2021-03-27', '21:42:00', '14:42:00', 12, 12, NULL),
(94, 'ui', 'educatif', 'ml', '2021-03-14', '2021-03-21', '15:40:00', '15:40:00', 13, 13, NULL),
(95, 'izlem', 'educatif', 'okkk', '2021-03-21', '2021-03-14', '14:51:00', '14:52:00', 12, 12, NULL),
(96, 'islem', 'sportif', 'lmp', '2021-03-21', '2021-03-21', '15:54:00', '14:54:00', 15, 15, NULL),
(97, 'islem', 'educatif', 'olo', '2021-03-21', '2021-03-20', '13:05:00', '15:05:00', 15, 15, NULL),
(100, 'islem', 'educatif', 'qsdqsd', '2021-03-04', '2021-03-31', '13:28:00', '16:28:00', 5, 5, NULL),
(101, 'hj', 'educatif', 'xthg', '2021-04-01', '2021-04-28', '10:23:00', '03:23:00', 22, 22, NULL),
(102, 'hj', 'educatif', 'xthg', '2021-04-01', '2021-04-28', '10:23:00', '03:23:00', 22, 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `id_user`, `id_ev`) VALUES
(5, -1, 93),
(6, 22, 80),
(7, 31, 74),
(9, -1, -1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_msg` int(11) NOT NULL,
  `contenu_msg` varchar(255) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `datetemps_msg` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_msg`, `contenu_msg`, `id_disc`, `sender`, `datetemps_msg`) VALUES
(1, 'salut', 2, 'mgkpsy', '2021-04-01 03:58:15'),
(2, 'cava?', 2, 'mgkpsy', '2021-04-01 04:00:22'),
(3, 'oui trés bien monsieur', 2, 'shidono', '2021-04-01 04:00:31'),
(4, 'je suis ravie d\'écouter ca', 2, 'mgkpsy', '2021-04-01 04:00:41'),
(5, 'labess', 2, 'shidono', '2021-04-21 22:42:08'),
(6, 'oui trés bien', 2, 'mgkpsy', '2021-04-21 22:42:15'),
(7, 'merci beaucoup', 2, 'shidono', '2021-04-21 22:42:20'),
(8, 'qsdqsdsq', 2, 'mgkpsy', '2021-04-21 22:42:30'),
(9, 'qsd', 2, 'mgkpsy', '2021-04-21 22:42:30'),
(10, 'sqd', 2, 'mgkpsy', '2021-04-21 22:42:30'),
(11, 'qsd', 2, 'mgkpsy', '2021-04-21 22:42:30'),
(12, 'qsdq', 2, 'mgkpsy', '2021-04-21 22:42:31'),
(13, 'cava', 2, 'shidono', '2021-04-24 01:08:43'),
(14, 'oui trés bien', 2, 'mgkpsy', '2021-04-24 01:08:50'),
(15, 'je suis satisfait', 2, 'shidono', '2021-04-24 01:08:58'),
(16, 'ok', 2, 'mgkpsy', '2021-04-24 01:09:03'),
(17, 'cool', 2, 'shidono', '2021-04-24 01:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='La table qui va contenir tous les messages voyons !';

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `author`, `content`, `created_at`) VALUES
(1, 'shidono', 'qsdqsdqsdq', '2021-04-22 05:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `nutri`
--

CREATE TABLE `nutri` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nutri`
--

INSERT INTO `nutri` (`id_user`, `username`, `password`, `mail`, `date_n`, `code`) VALUES
(6, 'mgknutri', '$2a$13$ymwEH1yMOSd1UpSxv2CtY.6V8xnPLstu1y6QghlT6WXVkQMx4MCbi', 'mgknutri@mgk2.tn', '2021-03-05', 'dododo');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id_par` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `date_par` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id_par`, `id_user`, `id_event`, `username`, `date_par`) VALUES
(7, 0, 3, 'Anas', '2021-03-30 21:01:13'),
(10, 0, 3, 'Mourad', '2021-03-30 21:01:20'),
(23, 0, 73, 'mgk', '2021-03-31 23:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `photo_publications`
--

CREATE TABLE `photo_publications` (
  `id_ph` int(255) NOT NULL,
  `id_pub` int(255) NOT NULL,
  `lien` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photo_publications`
--

INSERT INTO `photo_publications` (`id_ph`, `id_pub`, `lien`) VALUES
(163, 250, 'file:/C:/Users/HP/Pictures/Capture.PNG'),
(165, 250, 'file:/C:/Users/HP/Pictures/Sketchpad.png'),
(166, 261, 'https://static.wikia.nocookie.net/lemondededisney/images/e/e0/Hakunamatata.jpg/revision/latest?cb=20151215190528&path-prefix=fr');

-- --------------------------------------------------------

--
-- Table structure for table `psycho`
--

CREATE TABLE `psycho` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `psycho`
--

INSERT INTO `psycho` (`id_user`, `username`, `password`, `mail`, `date_n`, `code`) VALUES
(1015, 'mgkpsy', '$2a$13$XqJEY.kvpYqNGbhlfCNyY.rb1ZlDRfB8FgJZSFpjqYVAsv0tidiS.', 'mgkpsy@mgk2.tn', '2021-03-03', 'fdsilfk'),
(1016, 'finaltestpsy', '$2a$13$9m34hhoZLMMPcSPcE9zc/.bK/18/9FZXAC8Z60ee.f9cz1RUMX0Cu', 'finaltestpsy@ddd.dd', '2000-03-10', 'dsdzdzdz'),
(1017, 'mgkpsy2', 'mgkpsy2', 'shidonosan@gmail.com', '2021-04-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `id_pub` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `nb_reaction` int(255) NOT NULL,
  `texte` varchar(1000) NOT NULL,
  `date_pub` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`id_pub`, `id_user`, `nb_reaction`, `texte`, `date_pub`) VALUES
(247, 1, 0, 'dddddsq', '2021-03-31 17:56:50'),
(248, 1, 5, '#1', '2021-03-31 18:05:51'),
(250, 1015, 0, '#145', '2021-03-31 19:33:49'),
(256, 1015, 0, 'ffff', '2021-03-31 20:04:55'),
(257, 1, 1, 'zzzea', '2021-03-31 20:06:50'),
(259, 6, 0, 'ddd', '2021-03-31 20:23:36'),
(260, 16, 2, 'ssss', '2021-03-31 20:25:29'),
(261, 786, 3, 'hakuna matata\n#Kel_phrase_manyfike', '2021-03-31 22:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `pub_like_tracks`
--

CREATE TABLE `pub_like_tracks` (
  `id_track` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pub_like_tracks`
--

INSERT INTO `pub_like_tracks` (`id_track`, `id_user`, `id_pub`) VALUES
(5, 53, 257);

-- --------------------------------------------------------

--
-- Table structure for table `reclamation`
--

CREATE TABLE `reclamation` (
  `id_rec` int(11) NOT NULL,
  `id_cat` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `obj_rec` varchar(50) DEFAULT NULL,
  `suj_rec` varchar(150) DEFAULT NULL,
  `etat_rec` varchar(20) DEFAULT 'To do',
  `date_rec` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reclamation`
--

INSERT INTO `reclamation` (`id_rec`, `id_cat`, `username`, `obj_rec`, `suj_rec`, `etat_rec`, `date_rec`) VALUES
(29, 19, 'Salma', 'Problem', 'lol', 'Done', '2021-04-22 02:38:24'),
(32, 17, 'Salma', 'Problem', 'lol', 'To do', '2021-04-22 12:08:46'),
(33, 10, 'Salma', 'je ne sais pas', 'cool life', 'To do', '2021-04-23 01:58:23'),
(34, 13, 'Salma', 'sqsd', 'qsdqsdqsd', 'Done', '2021-04-23 04:05:53'),
(35, 11, 'Salma', 'qsdsqdqs', 'qsdqsdqdqsd', 'To do', '2021-04-25 04:01:13'),
(36, 14, 'shidono', 'sqsdqsd', 'qsdsqdqsd', 'To do', '2021-04-25 04:07:23'),
(37, 13, 'mgkcoach', 'qsdsqd', 'qsdqsdqs', 'To do', '2021-04-25 04:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `simple`
--

CREATE TABLE `simple` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simple`
--

INSERT INTO `simple` (`id_user`, `username`, `password`, `mail`, `date_n`) VALUES
(0, 'mgk', '$2a$13$L5cAtXVWc559U5FqH3U/EOCoiHMgzqLt7AszGKCG7EWmrpj0kd3aG', 'mgk@mgk2.tn', '2021-03-03'),
(52, 'finaltestsimple', '$2a$13$7xaKYKJ4eRDUB5J.BWH3G.bIQy8bg5Yvri9N6iSPBE7Bre5GpmfRO', 'finaltestsimple@test.com', '2001-03-08'),
(53, 'shidono', '$2a$13$aDk42uZG/wJ/6g/PdfsgcegAT7YA4yOF.i4/uqJKm/XrBOD6kWxZO', 'shidonosan@gmail.com', '2000-01-12'),
(54, 'ahmed', 'azerty123', 'shidonosan@gmail.com', '2016-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `suivi`
--

CREATE TABLE `suivi` (
  `id_s` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `client` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `titre_s` varchar(50) DEFAULT NULL,
  `date_ds` date NOT NULL,
  `date_fs` date NOT NULL,
  `temps_ds` time NOT NULL,
  `temps_fs` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suivi`
--

INSERT INTO `suivi` (`id_s`, `username`, `client`, `titre_s`, `date_ds`, `date_fs`, `temps_ds`, `temps_fs`) VALUES
(1, 'mgkpsy', 'mgk', 'avoir moins de stress', '2021-04-08', '2021-04-22', '01:42:00', '05:42:00'),
(6, 'mgkpsy', 'shidono', 'azeazeaze', '2021-04-05', '2021-05-01', '01:18:00', '12:18:00'),
(7, 'mgkpsy', 'shidono', 'avoir moins de stress', '2021-04-05', '2021-04-22', '02:20:00', '14:20:00'),
(8, 'mgkpsy', 'finaltestsimple', 'qsdqsdqs', '2011-09-29', '2011-09-29', '01:00:00', '02:00:00'),
(10, 'mgkpsy', 'shidono', 'faire du sport', '2021-12-01', '2021-12-03', '12:01:00', '13:20:00'),
(11, 'mgkpsy', 'shidono', 'faire du sport', '2021-12-01', '2021-12-03', '12:01:00', '13:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `etat_tache` tinyint(1) DEFAULT '0',
  `difficulte_tache` varchar(30) NOT NULL,
  `description_tache` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`id_tache`, `username`, `etat_tache`, `difficulte_tache`, `description_tache`) VALUES
(1, 'mgk', 0, 'easy', 'voila'),
(12, 'shidono', 0, 'difficile', 'faire des devoirs'),
(14, 'shidono', 0, 'dqsdsqd', 'ddddd'),
(15, 'qsdqsdqsd', 0, 'qsdqsd', 'sqdqsdqsd'),
(16, 'qsdqsdq', 0, 'qsdqsdqsd', 'qsdsqd'),
(17, 'dqsdqsdqsd', 0, 'qsdqsdqsd', 'qsdqsdqs'),
(18, 'shidono', 0, 'qsdqsdqsqsdsqd', 'qsdqsd');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `tag`) VALUES
(64, '1'),
(65, '145'),
(66, 'Kel_phrase_manyfike');

-- --------------------------------------------------------

--
-- Table structure for table `tag_publication`
--

CREATE TABLE `tag_publication` (
  `id_rel` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag_publication`
--

INSERT INTO `tag_publication` (`id_rel`, `id_pub`, `id_tag`) VALUES
(129, 248, 64),
(130, 250, 65),
(131, 261, 66);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `act`
--
ALTER TABLE `act`
  ADD PRIMARY KEY (`id_act`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_art`),
  ADD KEY `FK_cat_art` (`id_cat`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`),
  ADD UNIQUE KEY `titre_cat` (`titre_cat`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `fk_com_user` (`id_user`),
  ADD KEY `fk_com_pub` (`id_pub`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id_disc`),
  ADD KEY `fk_simple_disc` (`nom_destinaire`),
  ADD KEY `fk_source` (`nom_source`);

--
-- Indexes for table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_ev`),
  ADD KEY `fk_art_cat` (`id_act`);

--
-- Indexes for table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id` (`id_user`),
  ADD KEY `fk_id_ev` (`id_ev`) USING BTREE;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_msg`),
  ADD KEY `fk_id_disc` (`id_disc`);

--
-- Indexes for table `nutri`
--
ALTER TABLE `nutri`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id_par`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_event` (`id_event`),
  ADD KEY `fk_user_part` (`id_user`);

--
-- Indexes for table `photo_publications`
--
ALTER TABLE `photo_publications`
  ADD PRIMARY KEY (`id_ph`),
  ADD KEY `fk_pub` (`id_pub`);

--
-- Indexes for table `psycho`
--
ALTER TABLE `psycho`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_pub`);

--
-- Indexes for table `pub_like_tracks`
--
ALTER TABLE `pub_like_tracks`
  ADD PRIMARY KEY (`id_track`),
  ADD KEY `FK_pub_likes` (`id_pub`),
  ADD KEY `fk_simple` (`id_user`);

--
-- Indexes for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id_rec`),
  ADD KEY `reclamation_ibfk_2` (`id_cat`);

--
-- Indexes for table `simple`
--
ALTER TABLE `simple`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `suivi`
--
ALTER TABLE `suivi`
  ADD PRIMARY KEY (`id_s`),
  ADD KEY `fk_psycho_username` (`username`),
  ADD KEY `fk_simple_client` (`client`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `U_tag` (`tag`);

--
-- Indexes for table `tag_publication`
--
ALTER TABLE `tag_publication`
  ADD PRIMARY KEY (`id_rel`),
  ADD KEY `FK_pub_rel` (`id_pub`),
  ADD KEY `FK_tag_rel` (`id_tag`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_ev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nutri`
--
ALTER TABLE `nutri`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id_par` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `photo_publications`
--
ALTER TABLE `photo_publications`
  MODIFY `id_ph` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `psycho`
--
ALTER TABLE `psycho`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_pub` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `pub_like_tracks`
--
ALTER TABLE `pub_like_tracks`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `simple`
--
ALTER TABLE `simple`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tag_publication`
--
ALTER TABLE `tag_publication`
  MODIFY `id_rel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_usercom_suivi` FOREIGN KEY (`id_user`) REFERENCES `simple` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `fk_simple_disc` FOREIGN KEY (`nom_destinaire`) REFERENCES `simple` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_source` FOREIGN KEY (`nom_source`) REFERENCES `psycho` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `fk_art_cat` FOREIGN KEY (`id_act`) REFERENCES `act` (`id_act`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_id_disc` FOREIGN KEY (`id_disc`) REFERENCES `discussion` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`id_event`) REFERENCES `evenement` (`id_ev`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_part` FOREIGN KEY (`id_user`) REFERENCES `simple` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo_publications`
--
ALTER TABLE `photo_publications`
  ADD CONSTRAINT `fk_pub` FOREIGN KEY (`id_pub`) REFERENCES `publication` (`id_pub`);

--
-- Constraints for table `pub_like_tracks`
--
ALTER TABLE `pub_like_tracks`
  ADD CONSTRAINT `FK_pub_likes` FOREIGN KEY (`id_pub`) REFERENCES `publication` (`id_pub`),
  ADD CONSTRAINT `fk_simple` FOREIGN KEY (`id_user`) REFERENCES `simple` (`id_user`);

--
-- Constraints for table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suivi`
--
ALTER TABLE `suivi`
  ADD CONSTRAINT `fk_psycho_username` FOREIGN KEY (`username`) REFERENCES `psycho` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_simple_client` FOREIGN KEY (`client`) REFERENCES `simple` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tag_publication`
--
ALTER TABLE `tag_publication`
  ADD CONSTRAINT `FK_pub_rel` FOREIGN KEY (`id_pub`) REFERENCES `publication` (`id_pub`),
  ADD CONSTRAINT `FK_tag_rel` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
