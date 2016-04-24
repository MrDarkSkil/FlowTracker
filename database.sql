-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 20 Avril 2016 à 23:34
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  5.6.19-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `flowtracker`
--

-- --------------------------------------------------------

--
-- Structure de la table `aidants`
--

CREATE TABLE IF NOT EXISTS `aidants` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `profil` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ajax_chat_bans`
--

CREATE TABLE IF NOT EXISTS `ajax_chat_bans` (
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ajax_chat_invitations`
--

CREATE TABLE IF NOT EXISTS `ajax_chat_invitations` (
  `userID` int(11) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `ajax_chat_messages`
--

CREATE TABLE IF NOT EXISTS `ajax_chat_messages` (
`id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `userRole` int(1) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL,
  `text` text COLLATE utf8_bin
) ENGINE=InnoDB AUTO_INCREMENT=660 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `ajax_chat_messages`
--

INSERT INTO `ajax_chat_messages` (`id`, `userID`, `userName`, `userRole`, `channel`, `dateTime`, `ip`, `text`) VALUES
(1, 2147483647, 'ChatBot', 4, 0, '2016-04-19 23:42:42', 0x527fa49a, '/login (885277)'),
(2, 417439935, '(885277)', 0, 0, '2016-04-19 23:42:46', 0x527fa49a, 'ls'),
(3, 2147483647, 'ChatBot', 4, 0, '2016-04-19 23:44:41', 0x527fa49a, '/login (511207)');

-- --------------------------------------------------------

--
-- Structure de la table `ajax_chat_online`
--

CREATE TABLE IF NOT EXISTS `ajax_chat_online` (
  `userID` int(11) NOT NULL,
  `userName` varchar(64) COLLATE utf8_bin NOT NULL,
  `userRole` int(1) NOT NULL,
  `channel` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `ip` varbinary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `ajax_chat_online`
--

INSERT INTO `ajax_chat_online` (`userID`, `userName`, `userRole`, `channel`, `dateTime`, `ip`) VALUES
(415138758, '(Gendarme_63818)', 0, 0, '2016-04-20 22:06:10', 0x50d7aa50);

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `session`
--

INSERT INTO `session` (`token`, `user_id`, `id`) VALUES
('466a02c38159405b9c2f4b633d257c67', 9, 60);

-- --------------------------------------------------------

--
-- Structure de la table `sessionApp`
--

CREATE TABLE IF NOT EXISTS `sessionApp` (
`id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `grade` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `image` varchar(300) NOT NULL DEFAULT '/images/users/default.png'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pwd`, `grade`, `nom`, `prenom`, `image`) VALUES
(9, 'root@root.com', '7b24afc8bc80e548d66c4e7ff72171c5', 1, 'Root', 'Admin', '/images/users/default.png');

-- --------------------------------------------------------

--
-- Structure de la table `victime`
--

CREATE TABLE IF NOT EXISTS `victime` (
`id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nombre` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `id_creator` int(11) NOT NULL,
  `traitement` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `hauteur` float NOT NULL,
  `vitesse` float NOT NULL,
  `accuracy` float NOT NULL,
  `date` varchar(255) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `aidants`
--
ALTER TABLE `aidants`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ajax_chat_bans`
--
ALTER TABLE `ajax_chat_bans`
 ADD PRIMARY KEY (`userID`), ADD KEY `userName` (`userName`), ADD KEY `dateTime` (`dateTime`);

--
-- Index pour la table `ajax_chat_invitations`
--
ALTER TABLE `ajax_chat_invitations`
 ADD PRIMARY KEY (`userID`,`channel`), ADD KEY `dateTime` (`dateTime`);

--
-- Index pour la table `ajax_chat_messages`
--
ALTER TABLE `ajax_chat_messages`
 ADD PRIMARY KEY (`id`), ADD KEY `message_condition` (`id`,`channel`,`dateTime`), ADD KEY `dateTime` (`dateTime`);

--
-- Index pour la table `ajax_chat_online`
--
ALTER TABLE `ajax_chat_online`
 ADD PRIMARY KEY (`userID`), ADD KEY `userName` (`userName`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessionApp`
--
ALTER TABLE `sessionApp`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `victime`
--
ALTER TABLE `victime`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `aidants`
--
ALTER TABLE `aidants`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ajax_chat_messages`
--
ALTER TABLE `ajax_chat_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=660;
--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT pour la table `sessionApp`
--
ALTER TABLE `sessionApp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `victime`
--
ALTER TABLE `victime`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
