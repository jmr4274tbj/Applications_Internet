-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1:3306
-- Généré le :  Lun 11 Novembre 2019 à 21:44
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cake_cms`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_published` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `books`
--

INSERT INTO `books` (`id`, `loan_id`, `title`, `author`, `date_published`, `description`, `created`, `modified`) VALUES
(1, 3, 'Hunger Games', 'Suzanne Collins', '2008-07-17', '16-year-old Katniss Everdeen, who lives in the future, \r\npost-apocalyptic nation of Panem in North America. The Capitol, a highly advanced metropolis, exercises political \r\ncontrol over the rest of the nation. The Hunger Games is an annual event in which one boy and one girl aged 12–18 \r\nfrom each of the twelve districts surrounding the Capitol are selected by lottery to compete in a televised battle \r\n to the death.', '2019-08-29 23:13:03', '2019-08-29 23:13:03'),
(2, 2, 'The Outsider', 'Stephen King', '2019-02-14', 'Police detective Ralph Anderson arrests popular teacher and Little \r\nLeague Baseball coach Terry Maitland in front of a crowd of baseball spectators, charging him with raping, mutilating, \r\nand killing an 11-year-old boy. The town quickly turns against Maitland. Maitland insists he is innocent.', '2019-08-30 13:36:36', '2019-08-30 13:36:36'),
(3, 1, 'Asterix. The secret of the magic potion', 'Fabrice Tarrin', '2019-01-21', 'In this adventure, Asterix and Obelix embark on a quest across Gaul \r\nlooking for a young druid worthy of learning the secret of the magic potion, after elderly village druid Getafix breaks \r\nhis leg when he falls from a tree while picking mistletoe.', '2019-08-29 23:18:39', '2019-08-29 23:18:39');

-- --------------------------------------------------------

--
-- Structure de la table `i18n`
--

CREATE TABLE `i18n` (
  `id` int(11) NOT NULL,
  `locale` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `i18n`
--

INSERT INTO `i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(1, 'en_US', 'Tags', 1, 'title', 'Library');

-- --------------------------------------------------------

--
-- Structure de la table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fine` decimal(6,2) NOT NULL,
  `note` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `date_issued` date NOT NULL,
  `date_due` date NOT NULL,
  `date_returned` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `fine`, `note`, `slug`, `date_issued`, `date_due`, `date_returned`, `created`, `modified`) VALUES
(1, 1, '3.55', 'First Loan', 'first-loan.', '2019-08-11', '2019-08-18', '2019-08-16', '2019-08-21 20:47:19', '2019-08-21 20:47:19'),
(2, 3, '2.78', 'Loan added', 'loan-added', '2019-08-20', '2019-08-27', '2019-08-26', '2019-08-21 20:47:19', '2019-08-21 20:47:19'),
(3, 2, '4.36', 'Other add modified', 'other-add-modified', '2019-08-05', '2019-08-12', '2019-08-10', '2019-08-21 20:47:19', '2019-08-21 20:47:19');

-- --------------------------------------------------------

--
-- Structure de la table `loans_files`
--

CREATE TABLE `loans_files` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `loans_files`
--

INSERT INTO `loans_files` (`id`, `loan_id`, `file_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `created`, `modified`, `status`) VALUES
(3, 'Tulips.jpg', 'Files/', '2019-09-09 08:43:12', '2019-09-09 08:43:12', 1);

-- --------------------------------------------------------

--
-- Structure de la table `loans_tags`
--

CREATE TABLE `loans_tags` (
  `loan_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `loans_tags`
--

INSERT INTO `loans_tags` (`loan_id`, `tag_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `title`, `created`, `modified`) VALUES
(1, 'Comic', '2019-08-30 00:51:01', '2019-08-30 14:21:53'),
(2, 'Science fiction', '2019-08-30 00:51:10', '2019-08-30 00:51:10'),
(3, 'Crime', '2019-08-30 00:51:20', '2019-08-30 00:51:20');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created`, `modified`) VALUES
(1, 'bernardf@hotmail.com', '$2y$10$ZBeA5PWBihKwgKHV3g3kGeZEkC5v.9Un2cBuKyLGIpT1r47Z0sBq.', '2019-08-21 20:47:19', '2019-08-21 20:47:19'),
(2, 'jonathanmr@outlook.com', '$2y$10$zsXCnh99OaekR.KCzXEClebkskVIo7uTKaDR.5qWj5scKA9lO9i1y', '2019-08-28 18:35:22', '2019-08-28 18:35:22'),
(3, 'rogerl@gmail.com', '$2y$10$CROeL.QyE82ct2YxAp37pe9g0qGTrTtJeLQ6T5j2BYEn19t/lDhYq', '2019-08-28 22:25:30', '2019-08-28 22:25:30');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `i18n`
--
ALTER TABLE `i18n`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `I18N_LOCALE_FIELD` (`locale`,`model`,`foreign_key`,`field`),
  ADD KEY `I18N_FIELD` (`model`,`foreign_key`,`field`);

--
-- Index pour la table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_key` (`user_id`);

--
-- Index pour la table `loans_files`
--
ALTER TABLE `loans_files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `loans_tags`
--
ALTER TABLE `loans_tags`
  ADD PRIMARY KEY (`loan_id`,`tag_id`),
  ADD KEY `tag_key` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `i18n`
--
ALTER TABLE `i18n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `articles_files`
--
ALTER TABLE `loans_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `loans_tags`
--
ALTER TABLE `loans_tags`
  ADD CONSTRAINT `loans_tags_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `loans_tags_ibfk_2` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
