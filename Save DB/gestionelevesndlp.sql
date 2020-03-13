-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 13 mars 2020 à 08:08
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionelevesndlp`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diplome_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_scolaire` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F87BF9626F859E2` (`diplome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cour_option`
--

DROP TABLE IF EXISTS `cour_option`;
CREATE TABLE IF NOT EXISTS `cour_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cour_option_diplome`
--

DROP TABLE IF EXISTS `cour_option_diplome`;
CREATE TABLE IF NOT EXISTS `cour_option_diplome` (
  `cour_option_id` int(11) NOT NULL,
  `diplome_id` int(11) NOT NULL,
  PRIMARY KEY (`cour_option_id`,`diplome_id`),
  KEY `IDX_33A809141BF1158C` (`cour_option_id`),
  KEY `IDX_33A8091426F859E2` (`diplome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cour_option_etudiant`
--

DROP TABLE IF EXISTS `cour_option_etudiant`;
CREATE TABLE IF NOT EXISTS `cour_option_etudiant` (
  `cour_option_id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  PRIMARY KEY (`cour_option_id`,`etudiant_id`),
  KEY `IDX_FA187E4D1BF1158C` (`cour_option_id`),
  KEY `IDX_FA187E4DDDEAB1A3` (`etudiant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `diplome`
--

DROP TABLE IF EXISTS `diplome`;
CREATE TABLE IF NOT EXISTS `diplome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_formation_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lv2_obligatoire` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EB4C4D4ED543922B` (`type_formation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseignement_comp`
--

DROP TABLE IF EXISTS `enseignement_comp`;
CREATE TABLE IF NOT EXISTS `enseignement_comp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diplome_id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_86E81FC626F859E2` (`diplome_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etablissement_origine`
--

DROP TABLE IF EXISTS `etablissement_origine`;
CREATE TABLE IF NOT EXISTS `etablissement_origine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etablissement_origine_id` int(11) DEFAULT NULL,
  `classe_id` int(11) NOT NULL,
  `enseignement_comp_id` int(11) DEFAULT NULL,
  `lastname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lv2` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `arrangement` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_717E22E334849FFF` (`etablissement_origine_id`),
  KEY `IDX_717E22E38F5EA509` (`classe_id`),
  KEY `IDX_717E22E390E84B90` (`enseignement_comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

DROP TABLE IF EXISTS `identifiant`;
CREATE TABLE IF NOT EXISTS `identifiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C90409ECF85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `identifiant`
--

INSERT INTO `identifiant` (`id`, `username`, `roles`, `password`) VALUES
(1, 'User', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$SUtOSFROL1RjUm1VeS9QWA$46KEq4HFS97Hbj/tw75U+DepSG23IsJ5lR/fDX3NwKM'),
(2, 'Admin', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$SG9rbU1xZUxtUDVKcUxsNQ$GNPExtMS5bn/XyIZ5/3KP/4F8wdyzAQS6o8AiZUg+Oo'),
(3, 'SuperAdmin', '[\"ROLE_SUPERADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$V2FpbXRJS2dEaXZXc2NHNw$lfl1xBPVZgVI+dRDKkmgmd+FMnHW+4WDggWwGR52Y+o');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191212164240', '2020-01-09 13:47:41'),
('20200109132655', '2020-01-09 13:47:42');

-- --------------------------------------------------------

--
-- Structure de la table `specialisation`
--

DROP TABLE IF EXISTS `specialisation`;
CREATE TABLE IF NOT EXISTS `specialisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialisation_classe`
--

DROP TABLE IF EXISTS `specialisation_classe`;
CREATE TABLE IF NOT EXISTS `specialisation_classe` (
  `specialisation_id` int(11) NOT NULL,
  `classe_id` int(11) NOT NULL,
  PRIMARY KEY (`specialisation_id`,`classe_id`),
  KEY `IDX_5FC772FB5627D44C` (`specialisation_id`),
  KEY `IDX_5FC772FB8F5EA509` (`classe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialisation_etudiant`
--

DROP TABLE IF EXISTS `specialisation_etudiant`;
CREATE TABLE IF NOT EXISTS `specialisation_etudiant` (
  `specialisation_id` int(11) NOT NULL,
  `etudiant_id` int(11) NOT NULL,
  PRIMARY KEY (`specialisation_id`,`etudiant_id`),
  KEY `IDX_44F859445627D44C` (`specialisation_id`),
  KEY `IDX_44F85944DDEAB1A3` (`etudiant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_formation`
--

DROP TABLE IF EXISTS `type_formation`;
CREATE TABLE IF NOT EXISTS `type_formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_8F87BF9626F859E2` FOREIGN KEY (`diplome_id`) REFERENCES `diplome` (`id`);

--
-- Contraintes pour la table `cour_option_diplome`
--
ALTER TABLE `cour_option_diplome`
  ADD CONSTRAINT `FK_33A809141BF1158C` FOREIGN KEY (`cour_option_id`) REFERENCES `cour_option` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_33A8091426F859E2` FOREIGN KEY (`diplome_id`) REFERENCES `diplome` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cour_option_etudiant`
--
ALTER TABLE `cour_option_etudiant`
  ADD CONSTRAINT `FK_FA187E4D1BF1158C` FOREIGN KEY (`cour_option_id`) REFERENCES `cour_option` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FA187E4DDDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `diplome`
--
ALTER TABLE `diplome`
  ADD CONSTRAINT `FK_EB4C4D4ED543922B` FOREIGN KEY (`type_formation_id`) REFERENCES `type_formation` (`id`);

--
-- Contraintes pour la table `enseignement_comp`
--
ALTER TABLE `enseignement_comp`
  ADD CONSTRAINT `FK_86E81FC626F859E2` FOREIGN KEY (`diplome_id`) REFERENCES `diplome` (`id`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_717E22E334849FFF` FOREIGN KEY (`etablissement_origine_id`) REFERENCES `etablissement_origine` (`id`),
  ADD CONSTRAINT `FK_717E22E38F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `FK_717E22E390E84B90` FOREIGN KEY (`enseignement_comp_id`) REFERENCES `enseignement_comp` (`id`);

--
-- Contraintes pour la table `specialisation_classe`
--
ALTER TABLE `specialisation_classe`
  ADD CONSTRAINT `FK_5FC772FB5627D44C` FOREIGN KEY (`specialisation_id`) REFERENCES `specialisation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5FC772FB8F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `specialisation_etudiant`
--
ALTER TABLE `specialisation_etudiant`
  ADD CONSTRAINT `FK_44F859445627D44C` FOREIGN KEY (`specialisation_id`) REFERENCES `specialisation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_44F85944DDEAB1A3` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
