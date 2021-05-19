-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 28 avr. 2021 à 18:16
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `spirity`
--

-- --------------------------------------------------------

--
-- Structure de la table `act`
--

CREATE TABLE `act` (
  `id_act` int(11) NOT NULL,
  `nom_act` varchar(50) NOT NULL,
  `type_act` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `act`
--

INSERT INTO `act` (`id_act`, `nom_act`, `type_act`, `image`) VALUES
(1, 'mp', 'yoga', ''),
(6, 'guitar', 'musique', ''),
(7, 'yoga', 'aa', ''),
(8, 'yoga', 'mus', 'téléchargement.jpeg'),
(9, 'mp', 'll', 'C:\\Users\\Islem\\Desktop\\téléchargement (1).jpg'),
(10, 'mm', 'll', 'C:\\Users\\Islem\\Desktop\\téléchargement (1).jpg'),
(11, 'ok', 'lkk', 'C:\\xampp\\htdocs\\piWeb\\pi\\public\\upload\\téléchargement.jpeg'),
(12, 'tt', 'cash', 'téléchargement.jpeg'),
(13, 'll', 'mm', 'téléchargement.jpeg'),
(14, 'mm', 'ff', 'téléchargement.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_user`, `username`, `password`, `mail`) VALUES
(16, 'mgkadmin', '$2a$13$h84ZE897OC3M1c1TghADruMr6ATIvqKQ8lbV32NqqWTXo.46eqwxK', 'mgkadmin@mgk2.tn'),
(18, 'finaltestadmin', '$2a$13$cCGTxqoWPE4ToeyGXBNsgOdISMKnTJYHkeFaQXbqt1ypEE5fxhPQ6', 'finaltestadmin@aaaa.aa');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_art` int(11) NOT NULL,
  `titre_art` varchar(255) NOT NULL,
  `auteur_art` varchar(255) DEFAULT NULL,
  `description_art` varchar(1500) DEFAULT NULL,
  `date_art` datetime DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0,
  `id_cat` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_art`, `titre_art`, `auteur_art`, `description_art`, `date_art`, `likes`, `id_cat`, `photo`) VALUES
(22, 'régime guide complet pour perdre du poids', 'mgknutri', 'Pour perdre du poids durablement il est essentiel de combiner des changements alimentaires ET une activité sportive\nface à ce double défi certains régimes proposent de véritables plans d\'exercices\nnos experts ont élu les meilleurs régimes qui associent harmonieusement rééquilibrage alimentaire et activité physique', '2021-03-27 02:11:23', 6, 6, 'file:/C:/xampp/htdocs/img/palmares-des-regimes.jpg'),
(23, 'pourquoi aimons nous dessiner', 'test1Coach', 'Dessiner nous pousse à expérimenter des méthodes\ndes techniques afin de se rapprocher le plus possible de la réalité dans le but de la figer dans le temps \nà tout jamais ou au contraire à s’en éloigner tout en l’exprimant à travers notre prisme émotionnel', '2021-03-27 02:22:15', 2, 61, 'file:/C:/xampp/htdocs/img/téléchargement.jpg'),
(24, 'les bienfaits du sport sur la santé', 'mgkcoach', 'L\'activité physique est également un élément de prévention essentiel pour garder des os solides \net prévenir ainsi l\'ostéoporose Pratiquer un sport permet de prévenir les lombalgies et la récurrence des symptômes\nLe renforcement musculaire occasionné lors des exercices physiques est aussi bénéfique pour les rhumatismes inflammatoires chroniques', '2021-03-27 02:26:17', 5, 23, 'file:/C:/xampp/htdocs/img/sp.jpg'),
(46, 'kkkk', 'mgkcoach', 'jjjjjjj', '2021-04-01 01:41:56', 0, 61, 'https://i.pinimg.com/736x/5b/b4/8b/5bb48b07fa6e3840bb3afa2bc821b882.jpg'),
(47, 'nbnbnnbnn', 'mgkcoach', 'hfhfhfhfhfhfhf', '2021-04-01 01:42:59', 0, 23, 'http://www..'),
(48, 'uuuuuuux', 'mgkcoach', 'uuuuuuuuuuuuuuuuuuuuuu', '2021-04-01 01:43:36', 0, 23, 'f6e6c7aa9f54f3672f8500e8b9de96f7.png'),
(49, 'Test', 'ahmed', 'testff', '2021-04-28 04:04:17', 0, 6, '87afc617785cfcfddf847b0985e9efcd.png'),
(50, 'TestXX', 'ahmed', 'Wow', '2021-04-28 04:12:02', 0, 61, 'efb7663af9124584ba0113a342a51afc.png'),
(52, 'dd', 'ahmed', 'dd', '2021-04-28 14:20:15', 0, 61, '438d594895ef787bd2547da29de9bd8f.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_cat` int(11) NOT NULL,
  `titre_cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `titre_cat`) VALUES
(61, 'arts'),
(27, 'Méditation'),
(6, 'Nourriture'),
(23, 'santé'),
(5, 'sport');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(50) NOT NULL,
  `nom_cat` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `nom_cat`) VALUES
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
(30, 'marathon'),
(31, 'Esprit'),
(32, 'Esprit'),
(33, 'dddd'),
(34, 'Esprit'),
(35, 'dddd');

-- --------------------------------------------------------

--
-- Structure de la table `coach`
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
-- Déchargement des données de la table `coach`
--

INSERT INTO `coach` (`id_user`, `username`, `password`, `mail`, `date_n`, `code`) VALUES
(1, 'mgkcoach', '$2a$13$qBxEx/7EVV03YoUof1xGzOKVcAZyenXXL9SRGvljEpzZr2vXFwOgG', 'mgkcoach@mgk2.tn', '2021-03-11', 'ompo'),
(786, 'mourad', '$2a$13$UpkLwSCwnOXFPXUEMXmDuuQdTTUysX9yaLCM7vDLPq7eGgBCGS/Ke', 'mourad@esprit.tn', '1997-04-11', 'tgtgtg');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `id_pub` int(11) NOT NULL,
  `contenu` varchar(500) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_user`, `username`, `id_pub`, `contenu`, `date`) VALUES
(26, 1, 'jeff', 262, 'dr', '2021-04-28 12:10:32'),
(27, 1, 'jeff', 262, 'dfg', '2021-04-28 12:18:16'),
(28, 1, 'jeff', 262, 'dfg', '2021-04-28 12:18:16'),
(29, 1, 'jeff', 263, 'ssss', '2021-04-28 12:25:12'),
(30, 1, 'jeff', 262, 'zer', '2021-04-28 12:25:41'),
(31, 1, 'jeff', 263, 'dfgsd', '2021-04-28 12:25:51'),
(32, 54, 'ahmed', 263, 'Test Ahmid', '2021-04-28 12:27:14'),
(33, 54, 'ahmed', 264, 'Test Ahmind COm', '2021-04-28 12:28:19'),
(34, 54, 'ahmed', 264, 'Test Ahmind COm', '2021-04-28 12:28:19'),
(35, 54, 'ahmed', 262, 'dqzsdqsdqzqdqzd', '2021-04-28 12:28:41'),
(36, 54, 'ahmed', 265, 'dqzsdqsdqzqdqzd', '2021-04-28 12:31:46'),
(37, 1, 'DumB', 265, 'rrr', '2021-04-28 12:32:46'),
(38, 54, 'ahmed', 263, 'Test', '2021-04-28 14:53:16'),
(40, 54, 'ahmed', 265, 'Wow', '2021-04-28 15:37:59');

-- --------------------------------------------------------

--
-- Structure de la table `discussion`
--

CREATE TABLE `discussion` (
  `id_disc` int(11) NOT NULL,
  `datetemps_disc` timestamp NULL DEFAULT current_timestamp(),
  `nom_source` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `nom_destinaire` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `vue_disc` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `discussion`
--

INSERT INTO `discussion` (`id_disc`, `datetemps_disc`, `nom_source`, `nom_destinaire`, `vue_disc`) VALUES
(1, '2021-04-01 03:43:00', 'mgkpsy', 'mgk', 0),
(2, '2021-04-01 03:57:05', 'mgkpsy', 'shidono', 0);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
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
  `image` varchar(255) NOT NULL,
  `id_act` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_ev`, `titre_ev`, `type_ev`, `emplacement_ev`, `date_dev`, `date_fev`, `temps_dev`, `temps_fev`, `age_min`, `age_max`, `image`, `id_act`) VALUES
(71, 'islemx', 'sportif', 'ml', '2021-03-04', '2021-03-20', '15:00:00', '15:15:00', 13, 26, '6.png', 1),
(90, 'islem', 'sportif', 'ml', '2021-03-11', '2021-03-12', '12:00:00', '12:00:00', 15, 15, 'téléchargement.jpeg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_Ev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_msg` int(11) NOT NULL,
  `contenu_msg` varchar(255) NOT NULL,
  `id_disc` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `datetemps_msg` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
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
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='La table qui va contenir tous les messages voyons !';

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `author`, `content`, `created_at`) VALUES
(1, 'shidono', 'qsdqsdqsdq', '2021-04-22 05:02:44');

-- --------------------------------------------------------

--
-- Structure de la table `nutri`
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
-- Déchargement des données de la table `nutri`
--

INSERT INTO `nutri` (`id_user`, `username`, `password`, `mail`, `date_n`, `code`) VALUES
(6, 'mgknutri', '$2a$13$ymwEH1yMOSd1UpSxv2CtY.6V8xnPLstu1y6QghlT6WXVkQMx4MCbi', 'mgknutri@mgk2.tn', '2021-03-05', 'dododo');

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id_par` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `nbr_par` int(255) DEFAULT 0,
  `username` varchar(50) DEFAULT NULL,
  `date_par` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `participation`
--

INSERT INTO `participation` (`id_par`, `id_user`, `id_event`, `nbr_par`, `username`, `date_par`) VALUES
(7, 4, 3, 1, 'Anas', '2021-03-03 20:13:56'),
(8, 2, 3, 1, 'Islem', '2021-03-03 20:14:49'),
(10, 5, 3, 1, 'Mourad', '2021-03-03 20:15:33'),
(11, 6, 3, 1, 'Yasmine', '2021-03-03 20:17:07');

-- --------------------------------------------------------

--
-- Structure de la table `photo_publication`
--

CREATE TABLE `photo_publication` (
  `id_ph` int(255) NOT NULL,
  `id_pub` int(255) NOT NULL,
  `lien` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photo_publication`
--

INSERT INTO `photo_publication` (`id_ph`, `id_pub`, `lien`) VALUES
(167, 262, 'https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg'),
(168, 264, 'https://img-19.ccm2.net/8vUCl8TXZfwTt7zAOkBkuDRHiT8=/1240x/smart/b829396acc244fd484c5ddcdcb2b08f3/ccmcms-commentcamarche/20494859.jpg'),
(169, 262, 'https://interactive-examples.mdn.mozilla.net/media/cc0-images/grapefruit-slice-332-332.jpg'),
(170, 265, 'https://images.theconversation.com/files/12874/original/7tw6cstf-1342069683.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1200&h=675.0&fit=crop');

-- --------------------------------------------------------

--
-- Structure de la table `psycho`
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
-- Déchargement des données de la table `psycho`
--

INSERT INTO `psycho` (`id_user`, `username`, `password`, `mail`, `date_n`, `code`) VALUES
(1015, 'mgkpsy', '$2a$13$XqJEY.kvpYqNGbhlfCNyY.rb1ZlDRfB8FgJZSFpjqYVAsv0tidiS.', 'mgkpsy@mgk2.tn', '2021-03-03', 'fdsilfk'),
(1016, 'finaltestpsy', '$2a$13$9m34hhoZLMMPcSPcE9zc/.bK/18/9FZXAC8Z60ee.f9cz1RUMX0Cu', 'finaltestpsy@ddd.dd', '2000-03-10', 'dsdzdzdz'),
(1017, 'mgkpsy2', 'mgkpsy2', 'shidonosan@gmail.com', '2021-04-14', '');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id_pub` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `nb_reaction` int(255) NOT NULL,
  `texte` varchar(1000) NOT NULL,
  `date_pub` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`id_pub`, `id_user`, `username`, `nb_reaction`, `texte`, `date_pub`) VALUES
(262, 1, 'jeff', 1, 'test', '2021-04-28 11:08:11'),
(266, 54, 'ahmed', 0, 'Hi !', '2021-04-28 14:46:58');

-- --------------------------------------------------------

--
-- Structure de la table `pub_like_tracks`
--

CREATE TABLE `pub_like_tracks` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pub_like_tracks`
--

INSERT INTO `pub_like_tracks` (`id`, `id_user`, `id_pub`) VALUES
(9, 1, 265),
(10, 1, 263),
(12, 54, 262);

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `id_rec` int(11) NOT NULL,
  `id_cat` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `obj_rec` varchar(50) DEFAULT NULL,
  `suj_rec` varchar(150) DEFAULT NULL,
  `etat_rec` varchar(20) DEFAULT 'To do',
  `date_rec` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id_rec`, `id_cat`, `username`, `obj_rec`, `suj_rec`, `etat_rec`, `date_rec`) VALUES
(42, 13, 'ahmed', 'Pi', 'edde', 'To do', '2021-04-28 16:58:27'),
(43, 13, 'Salma', 'Test', 'TestSujet', 'Done', '2021-04-28 16:02:26'),
(44, 14, 'ahmed', 'ABCDEFG', ':O', 'To do', '2021-04-28 17:05:11');

-- --------------------------------------------------------

--
-- Structure de la table `simple`
--

CREATE TABLE `simple` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `simple`
--

INSERT INTO `simple` (`id_user`, `username`, `password`, `mail`, `date_n`) VALUES
(0, 'mgk', '$2a$13$L5cAtXVWc559U5FqH3U/EOCoiHMgzqLt7AszGKCG7EWmrpj0kd3aG', 'mgk@mgk2.tn', '2021-03-03'),
(52, 'finaltestsimple', '$2a$13$7xaKYKJ4eRDUB5J.BWH3G.bIQy8bg5Yvri9N6iSPBE7Bre5GpmfRO', 'finaltestsimple@test.com', '2001-03-08'),
(53, 'shidono', '$2a$13$aDk42uZG/wJ/6g/PdfsgcegAT7YA4yOF.i4/uqJKm/XrBOD6kWxZO', 'shidonosan@gmail.com', '2000-01-12'),
(54, 'ahmed', 'azerty123', 'shidonosan@gmail.com', '2016-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `suivi`
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
-- Déchargement des données de la table `suivi`
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
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id_tache` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `etat_tache` tinyint(1) DEFAULT 0,
  `difficulte_tache` varchar(30) NOT NULL,
  `description_tache` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tache`
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
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id_tag` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tag_publication`
--

CREATE TABLE `tag_publication` (
  `id_rel` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `date_n` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `act`
--
ALTER TABLE `act`
  ADD PRIMARY KEY (`id_act`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_art`),
  ADD KEY `FK_cat_art` (`id_cat`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_cat`),
  ADD UNIQUE KEY `titre_cat` (`titre_cat`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id_disc`),
  ADD KEY `fk_simple_disc` (`nom_destinaire`),
  ADD KEY `fk_source` (`nom_source`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_ev`),
  ADD KEY `fk_art_cat` (`id_act`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_event` (`id_Ev`),
  ADD KEY `FK_user` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_msg`),
  ADD KEY `fk_id_disc` (`id_disc`);

--
-- Index pour la table `nutri`
--
ALTER TABLE `nutri`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id_par`),
  ADD KEY `fk_par_user` (`id_user`),
  ADD KEY `fk_par_event` (`id_event`);

--
-- Index pour la table `photo_publication`
--
ALTER TABLE `photo_publication`
  ADD PRIMARY KEY (`id_ph`);

--
-- Index pour la table `psycho`
--
ALTER TABLE `psycho`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_pub`);

--
-- Index pour la table `pub_like_tracks`
--
ALTER TABLE `pub_like_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id_rec`),
  ADD KEY `reclamation_ibfk_2` (`id_cat`);

--
-- Index pour la table `simple`
--
ALTER TABLE `simple`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `suivi`
--
ALTER TABLE `suivi`
  ADD PRIMARY KEY (`id_s`),
  ADD KEY `fk_psycho_username` (`username`),
  ADD KEY `fk_simple_client` (`client`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id_tache`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`),
  ADD UNIQUE KEY `U_tag` (`tag`);

--
-- Index pour la table `tag_publication`
--
ALTER TABLE `tag_publication`
  ADD PRIMARY KEY (`id_rel`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `act`
--
ALTER TABLE `act`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `coach`
--
ALTER TABLE `coach`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id_disc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_ev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT pour la table `invitation`
--
ALTER TABLE `invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `nutri`
--
ALTER TABLE `nutri`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id_par` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `photo_publication`
--
ALTER TABLE `photo_publication`
  MODIFY `id_ph` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT pour la table `psycho`
--
ALTER TABLE `psycho`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1018;

--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_pub` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT pour la table `pub_like_tracks`
--
ALTER TABLE `pub_like_tracks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id_rec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `simple`
--
ALTER TABLE `simple`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `suivi`
--
ALTER TABLE `suivi`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id_tache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `tag_publication`
--
ALTER TABLE `tag_publication`
  MODIFY `id_rel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `fk_simple_disc` FOREIGN KEY (`nom_destinaire`) REFERENCES `simple` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_source` FOREIGN KEY (`nom_source`) REFERENCES `psycho` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `fk_art_cat` FOREIGN KEY (`id_act`) REFERENCES `act` (`id_act`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `simple` (`id_user`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_id_disc` FOREIGN KEY (`id_disc`) REFERENCES `discussion` (`id_disc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `reclamation_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `suivi`
--
ALTER TABLE `suivi`
  ADD CONSTRAINT `fk_psycho_username` FOREIGN KEY (`username`) REFERENCES `psycho` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_simple_client` FOREIGN KEY (`client`) REFERENCES `simple` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
