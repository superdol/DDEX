-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 22 Octobre 2010 à 17:58
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ddex`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL DEFAULT '0',
  `path` tinytext NOT NULL COMMENT 'path in the URL : ex : new-brocoli-album for a www.brocoli.org/news/new-brocoli-album',
  `title` tinytext NOT NULL COMMENT 'news title (one line of text)',
  `content` mediumtext NOT NULL COMMENT 'main news content',
  `datetime` datetime NOT NULL COMMENT 'date/time of the news',
  `hires_image_path` tinytext NOT NULL COMMENT 'local path in the filesystem relative to dynamic_img folder',
  `mp3_url` tinytext NOT NULL COMMENT 'Full URL of a MP3 linked to that news',
  `youtube_id` tinytext NOT NULL COMMENT 'ID of a Youtube video linked to that news',
  `other_link_url` tinytext NOT NULL COMMENT 'Any URL linked to that news',
  `lang` tinytext NOT NULL COMMENT 'IETF language tag',
  UNIQUE KEY `id` (`id`),
  FULLTEXT KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `path`, `title`, `content`, `datetime`, `hires_image_path`, `mp3_url`, `youtube_id`, `other_link_url`, `lang`) VALUES
(3, 'open-implementation-meeting-on-5th-november-in-la', 'Open Implementation Meeting on 5th November in Los Angeles, CA.', '<p><strong>DDEX will be hosting an Open Implementation Meeting on 5th November in Los Angeles.</strong></p>\n<p>The meeting will be beginning with an update on DDEX''s standards (including those just published). This will be followed by a series of "mentoring sessions" during which representatives from companies that have carried out implementation of one or more of the DDEX standards will work with small groups explaining how they approached implementations, what problems they encountered, how these were solved, what benefits have been derived from implementation.</p>\n<p>For details, <a href="http://example.com/">please read on here</a>.</p>', '2010-08-11 16:29:00', '', '', '', '', 'en_EN'),
(2, 'new-membership-structure-and-fees', 'New Membership Structure and Fees', '<p>From 1st January 2010 DDEX has introduced a new membership structure, which is aimed at accommodating further membership growth following recent increases in membership and in particular the addition of three new Charter Members. Microgen Aptitude Limited, Phonographic Performance Limited and Société Civile des Producteurs Phonographiques (SCPP) have all recently accepted invitations from the DDEX Board to become Charter Members and take seats on the DDEX Board.</p>\n<p>Details of the new membership structure and fees <a href="http://example.com/">are available here</a>.</p>', '2010-08-04 16:29:00', '', '', '', '', 'en_EN'),
(1, 'ddex-publishes-white-paper', 'DDEX Publishes White Paper', '<p>On 13th January DDEX published a white paper entitled "Standardisation for an Automated Transaction Processing Environment in the Digital Media Supply Chain" (click on the following links for a <a href="http://example.com/">HTML</a> and <a href="http://example.com/">PDF</a> version).</p>\n<p>The white paper sets out six components that DDEX believes require standardisation if an automated transaction processing environment for digital media is to be achieved. <a href="http://example.com/">Read more</a>.</p>', '2010-01-04 00:00:00', '', '', '', '', 'en_EN');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL DEFAULT '0',
  `path` tinytext NOT NULL COMMENT 'path in the URL : ex : new-brocoli-album for a www.brocoli.org/news/new-brocoli-album',
  `title` tinytext NOT NULL COMMENT 'news title (one line of text)',
  `content` mediumtext NOT NULL COMMENT 'main news content',
  `datetime` datetime NOT NULL COMMENT 'date/time of the news',
  `lang` tinytext NOT NULL COMMENT 'IETF language tag'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`id`, `path`, `title`, `content`, `datetime`, `lang`) VALUES
(0, 'ddex-for-record-labels', 'DDEX for record labels', 'DDEX for record labels', '2010-10-22 13:21:10', 'en_EN'),
(0, 'tests', 'test', 'dxfdsg', '2010-01-04 00:00:00', 'en_EN');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `role` int(11) NOT NULL COMMENT '0 : regular user / 1 : admin'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'Geoffroy Montel', 'g_montel@yahoo.com', 'admin', 1),
(2, 'geoffroy', 'Geogeo', 'bla@bla.fr', 'notadmin', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
