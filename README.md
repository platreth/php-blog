## Projet Open Classroom 

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/a9c379c6a08b4ced81cfa3c1824adb1f)](https://app.codacy.com/app/platreth/php-blog?utm_source=github.com&utm_medium=referral&utm_content=platreth/php-blog&utm_campaign=Badge_Grade_Dashboard)

#Créez votre premier blog en PHP

## INSTALLATION :

- BDD : 
	- Créer une nouvelle base qui s'appelle "phpblog" le reste se fait automatiquement.
	- Changement d'identifiants de connexion à la base de donnée : index.php

- php composer.phar install

ou 

- composer install


Script base test :

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 10 juin 2019 à 10:12
-- Version du serveur :  5.7.23
-- Version de PHP :  5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `phpblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `author` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL,
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_date` datetime NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CBDAFD8C8` (`author`),
  KEY `IDX_9474526CD1AA708F` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`author`, `id_post`, `id`, `created_date`, `content`, `status`) VALUES
(20, 11, 4, '2019-05-07 14:23:45', 'test\r\n', '1'),
(20, 11, 5, '2019-05-07 15:32:08', 'test 2', '1'),
(20, 11, 6, '2019-05-07 15:34:17', 'test3', '1'),
(20, 10, 7, '2019-05-07 15:35:54', 'test 3', '1'),
(20, 23, 8, '2019-05-22 13:40:49', 'aa', '0');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5A8A6C8DBDAFD8C8` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `author`, `title`, `image`, `subtitle`, `created_date`, `modified_date`, `content`, `status`) VALUES
(10, 20, 'post1', 'Public/img/post/logan2.jpg', 'zfafze', '2019-05-07 13:51:31', '2019-05-07 13:51:31', '<p>agegzgagagag</p>', 'active'),
(11, 20, 'sqvgbqr', 'Public/img/post/logan.jpg', 'qrbrqbqsb', '2019-05-07 13:51:40', '2019-05-07 13:51:40', '<p>qrbebqbqb</p>', 'active'),
(12, 20, '1', 'Public/img/post/air.jpg', '1', '2019-05-15 07:42:43', '2019-05-15 07:42:43', '<p>1</p>', 'active'),
(13, 20, '2', 'Public/img/post/air.jpg', '2', '2019-05-15 07:42:47', '2019-05-15 07:42:47', '<p>2</p>', 'active'),
(14, 20, '3', 'Public/img/post/air.jpg', '3', '2019-05-15 07:42:53', '2019-05-15 07:42:53', '<p>3</p>', 'active'),
(15, 20, '4', 'Public/img/post/air.jpg', '4', '2019-05-15 07:42:57', '2019-05-15 07:42:57', '<p>4</p>', 'active'),
(16, 20, '5', 'Public/img/post/air.jpg', '5', '2019-05-15 07:43:02', '2019-05-15 07:43:02', '<p>5</p>', 'active'),
(17, 20, '6', 'Public/img/post/air.jpg', '6', '2019-05-15 07:43:07', '2019-05-15 07:43:07', '<p>6</p>', 'active'),
(18, 20, '7', 'Public/img/post/air.jpg', '7', '2019-05-15 07:43:10', '2019-05-15 07:43:10', '<p>7</p>', 'active'),
(19, 20, '8', 'Public/img/post/air.jpg', '8', '2019-05-15 07:43:17', '2019-05-15 07:43:17', '<p>8</p>', 'active'),
(20, 20, '9', 'Public/img/post/air.jpg', '9', '2019-05-15 07:43:22', '2019-05-15 07:43:22', '<p>9</p>', 'active'),
(21, 20, 'a', 'Public/img/post/image_milieu.PNG', 'a', '2019-05-22 13:33:18', '2019-05-22 13:33:18', '<p>a</p>', 'active'),
(22, 20, 'rr', 'Public/img/post/air.jpg', 'rr', '2019-05-22 13:38:51', '2019-05-22 13:39:52', '<p>rrr</p>', 'active'),
(23, 20, 'ereee', 'Public/img/post/plein_air.jpg.png', 'oui oui', '2019-05-22 13:40:15', '2019-05-22 13:40:15', '<p>eee</p>', 'active'),
(24, 20, 'sefsfgq', 'Public/img/post/image_right.PNG', 'oui oui', '2019-05-22 13:40:31', '2019-05-22 13:40:31', '<p>zzfzfzf</p>', 'active');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `firstname`, `image`, `token`) VALUES
(20, 'admin', 'admin@gmail.com', 'adminadmin', '1', 'admin', 'Public/img/user/20/logan2.jpg', NULL),
(22, 'platret', 'hugo.platret@gmail.com', 'adminadmin', '1', 'hugo', 'Public/img/user/user-profile.png', '5cdac9e830f5f'),
(23, 'George', 'george@gmail.com', 'hihihihi', '1', 'demajungle', 'Public/img/user/user-profile.png', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_fk_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_fk_user` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_fk_user` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


