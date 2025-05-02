-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 29 avr. 2025 à 12:42
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `frais.mdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhérents`
--

DROP TABLE IF EXISTS `adhérents`;
CREATE TABLE IF NOT EXISTS `adhérents` (
  `numero-licence` float NOT NULL,
  `Nom` int(11) NOT NULL,
  `Prenom` int(11) NOT NULL,
  `num-ligue` float NOT NULL,
  `dtnaissance` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  PRIMARY KEY (`numero-licence`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `demandeurs`
--

DROP TABLE IF EXISTS `demandeurs`;
CREATE TABLE IF NOT EXISTS `demandeurs` (
  `adresse-mail` text COLLATE utf8_bin NOT NULL,
  `nom` int(11) NOT NULL,
  `prenom` int(11) NOT NULL,
  `rue` text COLLATE utf8_bin NOT NULL,
  `cp` char(5) COLLATE utf8_bin NOT NULL,
  `ville` text COLLATE utf8_bin NOT NULL,
  `num-recu` int(11) NOT NULL,
  PRIMARY KEY (`num-recu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lien`
--

DROP TABLE IF EXISTS `lien`;
CREATE TABLE IF NOT EXISTS `lien` (
  `numero-licence` float NOT NULL,
  `adresse-mail` int(11) NOT NULL,
  PRIMARY KEY (`numero-licence`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lignes-frais`
--

DROP TABLE IF EXISTS `lignes-frais`;
CREATE TABLE IF NOT EXISTS `lignes-frais` (
  `adresse-mail` varchar(23) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `motif` text COLLATE utf8_bin NOT NULL,
  `trajet` varchar(10) COLLATE utf8_bin NOT NULL,
  `km` float NOT NULL,
  `cout-peage` decimal(3,0) NOT NULL,
  `cout-hebergement` decimal(3,0) NOT NULL,
  `km-validé` tinyint(1) NOT NULL,
  `peage-validé` tinyint(1) NOT NULL,
  `repas-validé` tinyint(1) NOT NULL,
  `hebergement-validé` tinyint(1) NOT NULL,
  PRIMARY KEY (`adresse-mail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ligues`
--

DROP TABLE IF EXISTS `ligues`;
CREATE TABLE IF NOT EXISTS `ligues` (
  `n°` int(11) NOT NULL,
  `Nom` int(11) NOT NULL,
  `sigle` char(10) COLLATE utf8_bin NOT NULL,
  `président` int(11) NOT NULL,
  PRIMARY KEY (`n°`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

DROP TABLE IF EXISTS `motifs`;
CREATE TABLE IF NOT EXISTS `motifs` (
  `libelle` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`libelle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
