-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 13 juin 2018 à 08:14
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `fofo`
--

-- --------------------------------------------------------

--
-- Structure de la table `f_categories`
--

CREATE TABLE `f_categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `page` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `f_categories`
--

INSERT INTO `f_categories` (`id`, `nom`, `page`) VALUES
(1, 'Jeux-Video', 'jv.php'),
(2, 'Cuisine', 'cuisine.php'),
(3, 'Start-up', 'startup.php'),
(4, 'Chasse et P&#234che', 'chaspech.php');

-- --------------------------------------------------------

--
-- Structure de la table `f_mp`
--

CREATE TABLE `f_mp` (
  `mp_id` int(11) NOT NULL,
  `mp_expediteur` text NOT NULL,
  `mp_destinataire` int(11) NOT NULL,
  `mp_titre` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `mp_contenu` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `f_topics`
--

CREATE TABLE `f_topics` (
  `id_topic` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_user` text NOT NULL,
  `sujet` text NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `pseudo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mail` text CHARACTER SET utf8 NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `idpublic` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--

--
-- Index pour la table `f_categories`
--
ALTER TABLE `f_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `f_mp`
--
ALTER TABLE `f_mp`
  ADD PRIMARY KEY (`mp_id`);

--
-- Index pour la table `f_reponse`
--
ALTER TABLE `f_reponse`
  ADD PRIMARY KEY (`id_rep`);

--
-- Index pour la table `f_souscategories`
--
ALTER TABLE `f_souscategories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `f_topics`
--
ALTER TABLE `f_topics`
  ADD PRIMARY KEY (`id_topic`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `f_mp`
--
ALTER TABLE `f_mp`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `f_reponse`
--
ALTER TABLE `f_reponse`
  MODIFY `id_rep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `f_souscategories`
--
ALTER TABLE `f_souscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `f_topics`
--
ALTER TABLE `f_topics`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
