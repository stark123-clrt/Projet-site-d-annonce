-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql113.infinityfree.com
-- Généré le :  ven. 14 juin 2024 à 07:00
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `if0_36084790_lbc`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `ida` int(2) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `vendeur` int(2) NOT NULL,
  `date` varchar(30) NOT NULL,
  `detail` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `categorie` int(2) NOT NULL,
  `prix` int(10) NOT NULL,
  `etat` varchar(40) NOT NULL,
  `favoris` int(4) NOT NULL,
  `livraison` int(2) NOT NULL,
  `vue` int(6) NOT NULL,
  `time` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`ida`, `titre`, `vendeur`, `date`, `detail`, `photo`, `categorie`, `prix`, `etat`, `favoris`, `livraison`, `vue`, `time`) VALUES
(5, 'iphone 15 PROX MAX', 3, '2024-05-05 12:37:16', 'JE VEND MON IPHONE EN BONNE ETAT', 'image/annonce/iphone 15 PROX MAX.png', 1, 200, 'Neuf', 2, 0, 0, 1714927035),
(6, 'iphone 15 PROX MAX', 3, '2024-05-05 12:37:19', 'JE VEND MON IPHONE EN BONNE ETAT', 'image/annonce/iphone 15 PROX MAX.png', 1, 200, 'Neuf', 0, 1, 0, 1714927038),
(7, 'iphone 15 PROX MAX', 3, '2024-05-05 12:39:46', 'JE VEND MON IPHONE EN BONNE ETAT', 'image/annonce/iphone 15 PROX MAX.png', 1, 200, 'Neuf', 0, 1, 0, 1714927186);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idc` int(2) NOT NULL,
  `nomCat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idc`, `nomCat`) VALUES
(1, 'Téléphones mobiles'),
(2, 'Ordinateurs portables'),
(3, 'Ordinateurs de bureau '),
(4, 'Tablettes '),
(5, 'Accessoires électroniques');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `idc` int(11) NOT NULL,
  `idan` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `idv` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`idc`, `idan`, `idu`, `idv`, `time`) VALUES
(3, 5, 5, 3, 1714927719);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `idf` int(4) NOT NULL,
  `ida` int(2) NOT NULL,
  `idu` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`idf`, `ida`, `idu`) VALUES
(4, 5, 3),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idm` int(2) NOT NULL,
  `idu_q` int(2) NOT NULL,
  `idu_r` int(2) NOT NULL,
  `idc` int(2) NOT NULL,
  `contenu` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idm`, `idu_q`, `idu_r`, `idc`, `contenu`, `time`) VALUES
(6, 5, 3, 3, 'Salut, c\'est combien?', 1714927719),
(7, 3, 5, 3, 'c\'est à 200 Euro', 1714927766);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idu` int(2) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `numRue` varchar(10) NOT NULL,
  `nomRue` varchar(50) NOT NULL,
  `nomVille` varchar(30) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `statue` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idu`, `nom`, `prenom`, `mail`, `tel`, `mdp`, `numRue`, `nomRue`, `nomVille`, `cp`, `avatar`, `statue`) VALUES
(3, 'ONDIYO', 'CHRISTIAN', 'ondiyochristian10@gmail.com', '0758982621', '3072d80b350895e1bae05ccfe8b8a931', '12', '102 RUE DE STRASBOURG', 'LE MEE SUR SEINE', '77350', NULL, 0),
(4, 'Ondiyo', 'Christian', 'ondiyochristian12@gmail.com', '0758982621', '90969477f146f6152151fa2737151b07', '102', '102 rue de Strasbourg', 'Le mée sur seine', '77350', NULL, 0),
(5, 'NZINGA', 'Liza', 'lizanzinga920@gmail.com', '0815684828', '90969477f146f6152151fa2737151b07', '14', 'Commune/ Nsele Kinkole efobanc tunnel avenue/Bonge', 'Kinshasa', '2112', NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`ida`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idc`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`idc`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`idf`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idm`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idu`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `ida` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idc` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `idf` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idm` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
