-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 juin 2024 à 11:45
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `librairie`
--
CREATE DATABASE IF NOT EXISTS `librairie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `librairie`;

-- --------------------------------------------------------

--
-- Structure de la table `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE IF NOT EXISTS `auth` (
  `name` varchar(10) NOT NULL,
  `pass` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `auth`
--

INSERT INTO `auth` (`name`, `pass`) VALUES
('testuser1', 'motdepasse1'),
('testuser2', 'motdepasse2'),
('testuser3', 'motdepasse3'),
('testuser4', 'motdepasse4'),
('testuser5', 'motdepasse5');

-- --------------------------------------------------------

--
-- Structure de la table `auth_admin`
--

DROP TABLE IF EXISTS `auth_admin`;
CREATE TABLE IF NOT EXISTS `auth_admin` (
  `name` varchar(10) NOT NULL,
  `pass` varchar(30) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `auth_admin`
--

INSERT INTO `auth_admin` (`name`, `pass`) VALUES
('testadmin1', 'motdepasseadmin1');

-- --------------------------------------------------------

--
-- Structure de la table `cdes`
--

DROP TABLE IF EXISTS `cdes`;
CREATE TABLE IF NOT EXISTS `cdes` (
  `IdCde` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `produits` varchar(200) NOT NULL DEFAULT '',
  `montantCde` float(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `nomPrenomCli` varchar(100) NOT NULL DEFAULT '',
  `adressecli` varchar(30) DEFAULT NULL,
  `dateCde` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`IdCde`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cdes`
--

INSERT INTO `cdes` (`IdCde`, `produits`, `montantCde`, `nomPrenomCli`, `adressecli`, `dateCde`) VALUES
(1, 'Array', 0.00, 'Ref', 'douala cameroun', '2024-05-11 09:41:02'),
(2, 'Array', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 09:58:55'),
(3, 'listeproduits', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 11:17:14'),
(4, 'listeproduits', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 11:18:23'),
(5, 'listeproduits', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 11:18:57'),
(6, 'Array', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 11:19:12'),
(7, 'Array', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 11:19:16'),
(8, 'Array', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 11:19:34'),
(9, 'Array', 0.00, 'name', 'douala cameroun', '2024-05-11 21:17:07'),
(10, 'Array', 0.00, 'Ref', 'douala cameroun', '2024-05-11 22:18:40'),
(11, 'Array', 0.00, 'Codelivre', 'douala cameroun', '2024-05-11 22:21:25'),
(12, ',0,0,0,0,0,0,0,0,0,0,0', 37616.68, ' testuser1', 'Makepe, Douala', '2024-06-01 13:22:53'),
(13, ',0,0,0,0,0,0,0,0,0,0,0', 37150.01, ' testuser5', 'Makepe, Douala', '2024-06-01 14:03:25'),
(14, ',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 50616.68, ' testuser5', 'Makepe, Douala', '2024-06-01 14:14:10');

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `codeLivre` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `REF` char(10) NOT NULL DEFAULT '0',
  `ISBN` char(16) DEFAULT NULL,
  `titre` char(60) DEFAULT NULL,
  `auteur` char(30) DEFAULT NULL,
  `stock` tinyint UNSIGNED DEFAULT NULL,
  `pu` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`codeLivre`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`codeLivre`, `REF`, `ISBN`, `titre`, `auteur`, `stock`, `pu`) VALUES
(1, '0', '978-2-300-014147', 'Algèbre linéaire', 'Marcel Blaise', 10, 2500.00),
(2, '0', '978-2-300-023918', 'PHP&MySQL 2eme Edition', 'Luke Welling', 14, 4000.00),
(3, '0', '978-2-300-012435', 'Droits des Sociétés', 'Jean Laloi', 30, 3616.67),
(4, '0', '978-2-300-034152', 'Lettres africaines', 'Oban Guema', 6, 2850.00),
(5, '0', '978-2-300-087363', 'Management des organisations', 'HelRiegel', 11, 3000.00),
(6, '0', '978-2-300-013525', 'Rédaction adm. en Afrique', 'J.Gandouin', 16, 3100.00);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
