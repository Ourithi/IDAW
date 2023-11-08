-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 08 nov. 2023 à 12:31
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `ID_ACTIVITE` int NOT NULL AUTO_INCREMENT,
  `NOM_ACTIVITE` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_ACTIVITE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `aliment`
--

DROP TABLE IF EXISTS `aliment`;
CREATE TABLE IF NOT EXISTS `aliment` (
  `ID_ALIMENT` int NOT NULL AUTO_INCREMENT,
  `NOM_ALIMENT` varchar(50) NOT NULL,
  `ENERGIE` decimal(15,1) DEFAULT NULL,
  `LIPIDES` decimal(15,1) DEFAULT NULL,
  `GLUCIDES` decimal(15,1) DEFAULT NULL,
  `SUCRE` decimal(15,1) DEFAULT NULL,
  `FIBRES` decimal(15,1) DEFAULT NULL,
  `PROTEINES` decimal(15,1) DEFAULT NULL,
  `SEL` decimal(15,1) DEFAULT NULL,
  PRIMARY KEY (`ID_ALIMENT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `ID_ALIMENT` int NOT NULL,
  `ID_REPAS` int NOT NULL,
  `QUANTITE` int NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`,`ID_REPAS`),
  KEY `FK_CONTENIR_CONTENIR2_REPAS` (`ID_REPAS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `repas`
--

DROP TABLE IF EXISTS `repas`;
CREATE TABLE IF NOT EXISTS `repas` (
  `ID_REPAS` int NOT NULL AUTO_INCREMENT,
  `ID_TYPE` int NOT NULL,
  `ID_USER` int NOT NULL,
  `DATE_REPAS` date DEFAULT NULL,
  PRIMARY KEY (`ID_REPAS`),
  KEY `FK_REPAS_ETRE_TYPE` (`ID_TYPE`),
  KEY `FK_REPAS_ETRE_MANG_USER` (`ID_USER`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `ID_TYPE` int NOT NULL AUTO_INCREMENT,
  `NOM_TYPE` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int NOT NULL AUTO_INCREMENT,
  `ID_ACTIVITE` int NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `POIDS` int NOT NULL,
  `TAILLE` int NOT NULL,
  `AGE` int NOT NULL,
  `PWD` varchar(50) NOT NULL,
  `SEXE` char(1) NOT NULL,
  PRIMARY KEY (`ID_USER`),
  KEY `FK_USER_PRATIQUER_ACTIVITE` (`ID_ACTIVITE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
