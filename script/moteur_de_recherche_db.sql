-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 08 mai 2020 à 15:47
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `moteur_de_recherche_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

DROP TABLE IF EXISTS `actualite`;
CREATE TABLE IF NOT EXISTS `actualite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(500) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actualite`
--

INSERT INTO `actualite` (`id`, `image_path`, `description`) VALUES
(6, 'images/Concours-dâ€™accÃ¨s-en-3Ã¨me-annÃ©e-ENSA-Safi-2017.png', NULL),
(7, 'images/1 Abir.JPG', NULL),
(8, 'images/event_1.jpg', NULL),
(9, 'images/news_2.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(100) NOT NULL,
  `date_upload` datetime NOT NULL,
  `genre` varchar(100) NOT NULL,
  `niveau` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `path` varchar(500) NOT NULL,
  `document` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_filiere_document` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cne` varchar(20) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `niveau` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_filiere_etudiant` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `id_filiere` int(11) NOT NULL AUTO_INCREMENT,
  `nom_filiere` varchar(100) NOT NULL,
  PRIMARY KEY (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `relation_filiere_document` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `relation_filiere_etudiant` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
