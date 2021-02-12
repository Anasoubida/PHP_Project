#NOM?				
-- version 5.0.4				
-- https://www.phpmyadmin.net/				
--				
-- Hôte : 127.0.0.1				
-- Généré le : ven. 12 fév. 2021 à 21:12				
-- Version du serveur :  10.4.17-MariaDB				
-- Version de PHP : 8.0.1				
				
"SET SQL_MODE = ""NO_AUTO_VALUE_ON_ZERO"";"				
"START TRANSACTION;"				
"SET time_zone = ""+00:00"";"				
				
				
"/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;"				
"/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;"				
"/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;"				
"/*!40101 SET NAMES utf8mb4 */;"				
				
--				
-- Base de données : `superventes`				
--				
				
-- --------------------------------------------------------				
				
--				
-- Structure de la table `clients`				
--				
				
CREATE TABLE `clients` (				
  `email` varchar(50) NOT NULL,				
  `nomClient` varchar(50) NOT NULL,				
  `prénom` varchar(50) NOT NULL,				
  `password` varchar(50) NOT NULL				
") ENGINE=InnoDB DEFAULT CHARSET=utf8;"				
				
--				
-- Déchargement des données de la table `clients`				
--				
				
INSERT INTO `clients` (`email`, `nomClient`, `prénom`, `password`) VALUES				
"('claire.delune@gmail.com', 'Delune', 'Claire', '');"				
				
-- --------------------------------------------------------				
				
--				
				
-- --------------------------------------------------------				
				
--				
-- Structure de la table `produits1`				
--				
				
CREATE TABLE `produits1` (				
  `numProduit` int(11) NOT NULL,				
  `Nom` varchar(50) COLLATE utf8_bin NOT NULL,				
  `Marque` varchar(50) COLLATE utf8_bin NOT NULL,				
  `Catégorie` varchar(50) COLLATE utf8_bin NOT NULL,				
  `Prix` int(11) NOT NULL				
") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;"				
				
--				
-- Déchargement des données de la table `produits1`				
--				
				
INSERT INTO `produits1` (`numProduit`, `Nom`, `Marque`, `Catégorie`, `Prix`) VALUES				
(1, 'Galaxy A20', 'Samsung ', 'telephone', 155),				
(2, 'Galaxy  S12E', 'Samsung ', 'telephone', 500),				
(3, 'Iphone X', 'apple', 'telephone', 729),				
(4, 'Oxygne', 'Archos', 'tablette', 169),				
(5, 'Ipad air 2', 'apple', 'tablette', 199),				
(6, 'AIR pods 2', 'apple', 'ecouteurs', 179),				
(7, 'elitebook', 'HP', 'ordinateur', 400),				
(8, 'macbook', 'apple', 'ordinateur', 800),				
(9, 'nova', 'Redmi', 'telephone', 251),				
(10, 'chromebook', 'ASUS', 'ordinateur', 231),				
(11, 'A5', 'oppo', 'telephone', 150),				
(12, 'Iphone 6+', 'apple', 'telephone', 300),				
(13, 'A20 ', 'Samsung ', 'tablette', 200),				
(14, 'AKB', 'Toshiba', 'Disque dur', 120),				
(15, 'kodak1', 'Kodak', 'Appareil photo', 200),				
"(16, 'CANON350', 'Canon', 'Appareil photo', 600);"				
				
-- --------------------------------------------------------				
				
--				
-- Structure de la table `produitspaniers`				
--				
				
CREATE TABLE `produitspaniers` (				
  `numProduitPanier` int(11) NOT NULL,				
  `emailClient` varchar(50) NOT NULL,				
  `numProduit` int(11) NOT NULL,				
  `quantité` int(11) NOT NULL				
") ENGINE=InnoDB DEFAULT CHARSET=utf8;"				
				
--				
-- Déchargement des données de la table `produitspaniers`				
--				
				
INSERT INTO `produitspaniers` (`numProduitPanier`, `emailClient`, `numProduit`, `quantité`) VALUES				
(1, 'claire.delune@gmail.com', 1, 1),				
(2, 'claire.delune@gmail.com', 1, 1),				
(3, 'claire.delune@gmail.com', 1, 1),				
(4, 'claire.delune@gmail.com', 1, 1),				
(5, 'claire.delune@gmail.com', 14, 1),				
(6, 'claire.delune@gmail.com', 14, 1),				
"(7, 'claire.delune@gmail.com', 7, 1);"				
				
--				
-- Index pour les tables déchargées				
--				
				
--				
-- Index pour la table `clients`				
--				
ALTER TABLE `clients`				
"  ADD PRIMARY KEY (`email`);"				
				
--				
-- Index pour la table `produits`				
--				
ALTER TABLE `produits`				
"  ADD PRIMARY KEY (`numProduit`);"				
				
--				
-- Index pour la table `produits1`				
--				
ALTER TABLE `produits1`				
"  ADD PRIMARY KEY (`numProduit`);"				
				
--				
-- Index pour la table `produitspaniers`				
--				
ALTER TABLE `produitspaniers`				
"  ADD PRIMARY KEY (`numProduitPanier`);"				
				
--				
-- AUTO_INCREMENT pour les tables déchargées				
--				
				
--				
-- AUTO_INCREMENT pour la table `produitspaniers`				
--				
ALTER TABLE `produitspaniers`				
"  MODIFY `numProduitPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;"				
"COMMIT;"				
				
"/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;"				
"/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;"				
"/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;"				
