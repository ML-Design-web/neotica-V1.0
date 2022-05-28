-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 28 mai 2022 à 11:21
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `neotica`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `id` varchar(10) NOT NULL,
  `mot_de_passe` varchar(40) NOT NULL,
  `droit` int(11) NOT NULL,
  `nom_adh` varchar(30) NOT NULL,
  `pre_adh` varchar(30) NOT NULL,
  `ad_adh` varchar(80) DEFAULT NULL,
  `cp_adh` varchar(6) NOT NULL,
  `ville_adh` varchar(40) NOT NULL,
  `date_nais_adh` date NOT NULL,
  `tel_adh` varchar(15) NOT NULL,
  `email_adh` varchar(60) NOT NULL,
  `activ_adh` varchar(20) NOT NULL,
  `date_crea_adh` date NOT NULL,
  `date_deliv_carte_adh` date NOT NULL,
  `date_exp_carte_adh` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id`, `mot_de_passe`, `droit`, `nom_adh`, `pre_adh`, `ad_adh`, `cp_adh`, `ville_adh`, `date_nais_adh`, `tel_adh`, `email_adh`, `activ_adh`, `date_crea_adh`, `date_deliv_carte_adh`, `date_exp_carte_adh`) VALUES
('07052022T', '4d234a42af1067a8af3aa9366e5fddb3', 1, 'Test', 'Test', '460 impasse martin duby', '13390', 'Auriol', '2003-04-29', '0651050167', 'mathis.lambert27@gmail.com', 'Handball', '2022-05-07', '2022-05-14', '2023-05-07'),
('15042022AT', '3ecc3d1e8301d59c6ab59e907a2fe643', 1, 'Test', 'Test', '460 impasse martin duby', '13390', 'Auriol', '2003-04-20', '0651050167', 'mathis.lambert27@gmail.com', 'Football', '2022-05-07', '2022-05-14', '2023-05-07'),
('15042022ML', '97b200cbdcdac0345aa6c344438064b2', 2, 'Lambert', 'Mathis', NULL, '13390', 'Auriol', '2003-04-29', '0651050167', 'mathis.lambert27@gmail.com', 'handball', '2022-04-15', '2022-04-15', '2023-04-15'),
('230422CL', '098f6bcd4621d373cade4e832627b4f6', 3, 'Lachaume', 'Christophe', NULL, '83000', 'Toulon', '1970-01-01', '0601020304', 'cl.mmi@univ-tln.fr', 'Voile', '2022-04-23', '2022-04-23', '2026-04-22'),
('AUDD', '9dc730e49525329bc5019b1c2ab271ad', 1, 'Deschamps', 'Didier', 'La canebière', '13000', 'Marseille', '1998-06-12', '0601020304', 'audd@gmail.com', 'Football', '2022-05-17', '2022-05-24', '2023-05-17'),
('DimPayet', '4bbe691ac21d41ab2d0598d6b74a17ac', 1, 'Payet', 'Dimitri', 'Avenue de la republique', '13000', 'Marseille', '2003-04-29', '0101010101', 'mathis.lambert27@gmail.com', 'Football', '2022-05-07', '2022-05-14', '2023-05-07'),
('john', '527bd5b5d689e2c32ae974c6229ff785', 1, 'Doe', 'John', 'je sais pas ', '13000', 'Marseille', '1990-01-01', '0601020304', 'john@gmail.com', 'je sais pas', '2022-05-18', '2022-05-25', '2023-05-18'),
('lamb', '64ccd04ef5a1d352bc0c5c83f668c532', 1, 'Lambert', 'Mathis', '460, Impasse martin duby', '13390', 'Auriol', '2003-04-29', '0651050167', 'mathis.lambert27@gmail.com', 'Handball', '2022-05-17', '2022-05-24', '2023-05-17'),
('Mathilde', '2917b441db21509270e1cb2ae28cbf9f', 1, 'plumet', 'mathilde', '27 chemin des aires ste madeleine', '83740', 'La cadiÃ¨re', '2004-11-13', '0660010101', 'exemple@mail.com', 'danse', '2022-05-07', '2022-05-14', '2023-05-07'),
('matthieu', 'bdaae16837dd5768988bdd91205a77e8', 1, 'Cohen', 'Mathieu', 'boulevard je sais pas', '83000', 'Toulon', '2003-06-27', '0601020304', 'matthieu@gmail', 'Escrime', '2022-05-17', '2022-05-24', '2023-05-17'),
('NonoBonav', 'ff8dbef7870b55438fbae4ed0d16ab93', 1, 'Bonaventure', 'Noah', '2 A, clos saint joseph', '13390', 'Auriol', '2003-09-02', '0782010101', 'nounours.bonav@gmail.com', 'Danse', '2022-05-17', '2022-05-24', '2023-05-17'),
('zizou', '6fa6bf8390d5ce21a4a3797a91c1c86b', 3, 'Zidane', 'Zinedine', 'La canebière', '13000', 'Marseille', '1970-06-19', '0601020304', 'zizou@gmail.com', 'Football', '2022-05-17', '2022-05-24', '2023-05-17');

-- --------------------------------------------------------

--
-- Structure de la table `cotiser`
--

DROP TABLE IF EXISTS `cotiser`;
CREATE TABLE IF NOT EXISTS `cotiser` (
  `date_cotise` date NOT NULL,
  `id` varchar(10) NOT NULL,
  `montant_cot` float NOT NULL,
  `role_adh` varchar(50) NOT NULL,
  PRIMARY KEY (`date_cotise`,`id`),
  KEY `COTISER_ADHERENT0_FK` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cotiser`
--

INSERT INTO `cotiser` (`date_cotise`, `id`, `montant_cot`, `role_adh`) VALUES
('2022-04-25', '07052022T', 150, 'Administrateur'),
('2022-05-13', 'mathilde', 150, 'Administreur'),
('2022-05-17', 'NonoBonav', 150, 'adherent'),
('2022-05-20', '230422CL', 250, 'admin'),
('2022-05-21', 'john', 150, 'adherent');

-- --------------------------------------------------------

--
-- Structure de la table `embarcation`
--

DROP TABLE IF EXISTS `embarcation`;
CREATE TABLE IF NOT EXISTS `embarcation` (
  `imm_emb` varchar(10) NOT NULL,
  `type_emb` varchar(20) NOT NULL,
  `type_abrege_emb` varchar(10) NOT NULL,
  `prop_emb` varchar(20) NOT NULL,
  `nom_serie_emb` varchar(20) NOT NULL,
  `constr_emb` varchar(20) NOT NULL,
  `annee_constr_emb` date NOT NULL,
  `nom_emb` varchar(20) NOT NULL,
  `proprio_emb` varchar(30) NOT NULL,
  `large_mb` float NOT NULL,
  `long_emb` float NOT NULL,
  PRIMARY KEY (`imm_emb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `embarcation`
--

INSERT INTO `embarcation` (`imm_emb`, `type_emb`, `type_abrege_emb`, `prop_emb`, `nom_serie_emb`, `constr_emb`, `annee_constr_emb`, `nom_emb`, `proprio_emb`, `large_mb`, `long_emb`) VALUES
('EZ234', 'Catamaran', 'CTM', 'Voile', 'CATALUXE', 'CATASEA', '2022-01-01', 'LEOGOFUN', 'LEGO', 7, 15);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `id` varchar(10) NOT NULL,
  `date_empr` datetime NOT NULL,
  `imm_emb` varchar(10) NOT NULL,
  `date_retour_empr` datetime NOT NULL,
  `etat_retour_empr` varchar(10) NOT NULL,
  `etat_debut_empr` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`date_empr`,`imm_emb`),
  KEY `EMPRUNT_EMBARCATION1_FK` (`imm_emb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`id`, `date_empr`, `imm_emb`, `date_retour_empr`, `etat_retour_empr`, `etat_debut_empr`) VALUES
('230422CL', '2022-05-18 19:41:00', 'EZ234', '2022-05-31 19:41:00', 'inconnu', 't_bon'),
('john', '2022-05-21 19:28:00', 'EZ234', '2022-05-25 19:28:00', 'inconnu', 'neuf'),
('john', '2022-05-26 19:38:00', 'EZ234', '2022-05-30 19:38:00', 'inconnu', 'neuf');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cotiser`
--
ALTER TABLE `cotiser`
  ADD CONSTRAINT `COTISER_ADHERENT0_FK` FOREIGN KEY (`id`) REFERENCES `adherent` (`id`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `EMPRUNT_ADHERENT_FK` FOREIGN KEY (`id`) REFERENCES `adherent` (`id`),
  ADD CONSTRAINT `EMPRUNT_EMBARCATION1_FK` FOREIGN KEY (`imm_emb`) REFERENCES `embarcation` (`imm_emb`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
