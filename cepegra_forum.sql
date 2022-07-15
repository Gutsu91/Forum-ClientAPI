-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 08:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cepegra_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(10) UNSIGNED NOT NULL,
  `name_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'JavaScript');

-- --------------------------------------------------------

--
-- Stand-in structure for view `lj cat topic message user`
-- (See below for the actual view)
--
CREATE TABLE `lj cat topic message user` (
`id_category` int(10) unsigned
,`name_category` varchar(255)
,`id_topic` int(10) unsigned
,`topic_name` varchar(255)
,`id_message` int(10) unsigned
,`message` text
,`id_user` int(10) unsigned
,`date_message` datetime
,`user_name` varchar(42)
);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(10) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_topic` int(10) UNSIGNED NOT NULL,
  `is_topic_starter` enum('true','false') NOT NULL,
  `date_message` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `message`, `id_user`, `id_topic`, `is_topic_starter`, `date_message`) VALUES
(1, 'Hello admin, this is your first topic. Amazing, init ? \r\n\r\nTime for a coffee break already?', 1, 1, 'true', '2022-07-12 10:27:30'),
(2, 'J\'ai découvert le couple de balise summary/details il y a quelques jours. Très pratique pour avoir un contenu masqué nativement en HTML !', 1, 2, 'true', '2022-07-12 10:27:30'),
(3, 'Tout est dans le titre. Quand pensez-vous arsène ? ', 1, 3, 'true', '2022-07-12 10:29:02'),
(4, 'Claquez ici vos plus beaux mèmes JS. \r\n\r\nSi vous me montrez le votre je vous montre le mien', 1, 4, 'true', '2022-07-12 10:29:02'),
(5, 'Et ceci est une réponse de type qualitative', 2, 1, 'false', '2022-07-12 10:29:37'),
(6, 'test', 2, 1, 'false', '2022-07-12 13:49:25'),
(7, 'Is this the real life? \r\nIs this just fantasy\r\nCaught in a landside,\r\nNo Escape from Reality', 2, 5, 'true', '2022-07-12 16:12:42'),
(8, 'ce message AUSSI a été créé avec Insomnia', 2, 24, 'true', '2022-07-13 11:39:26'),
(9, 'Faut dire que t\'es pas bien fort aussi', 1, 25, 'true', '2022-07-13 11:43:28'),
(10, 'Faut dire que t\'es pas bien fort aussi', 1, 26, 'true', '2022-07-13 11:43:48'),
(11, 'Faut dire que t\'es pas bien fort aussi', 1, 27, 'true', '2022-07-13 11:44:02'),
(12, 'Faut dire que t\'es pas bien fort aussi', 1, 28, 'true', '2022-07-13 11:44:14'),
(13, 'Par contre j\'ai créé ce topic en step 1, y\'avait pas encore l\'insert de message. Du coup j\'aurais pu créer ce message via le post de la partie message, sauf que non. parce que flemme de faire une requête avec is_topic_starter = true alors que ce sera la seule fois ou je m\'en servirai. Du coup je fais le premier message du topic via PHPMyAdmin. Du coup je raconte ma vie. Du coup je m\'arrête la\r\n\r\n(c\'est une bonne situation ça, scribe)', 2, 10, 'true', '2022-07-13 11:47:46'),
(15, 'et ceci est une réponse faite avec insomnia', 1, 1, '', '2022-07-13 12:23:31'),
(17, 'et celle-ci une réponse insomnia en passant l\'id_topic dans l\'URL', 1, 1, 'false', '2022-07-13 12:25:44'),
(19, 'et je peux répondre sur d\'autres topic aussi', 1, 1, 'false', '2022-07-13 12:31:19'),
(20, 'réponse faite uniquement en POST', 3, 1, 'false', '2022-07-13 12:33:20'),
(21, 'réponse faite uniquement en POST', 3, 1, 'false', '2022-07-13 12:33:20'),
(22, 'Test pour voir si j\'ai cassé la requête full post', 1, 1, 'false', '2022-07-13 12:37:56'),
(23, 'Test pour voir si j\'ai cassé la requête full post', 2, 1, 'false', '2022-07-13 12:38:25'),
(24, 'Test requête mi-GET, mi-POST et re mi-GET derrière', 2, 1, 'false', '2022-07-13 12:39:09'),
(25, 'Ca fonctionne toujours par API', 3, 29, 'true', '2022-07-13 17:17:16'),
(26, 'zazdzadazd', 3, 30, 'true', '2022-07-13 17:26:49'),
(27, 'zazdzadazdadzadaz', 3, 31, 'true', '2022-07-13 17:27:49'),
(28, 'daddazdazd', 3, 32, 'true', '2022-07-13 17:28:37'),
(29, 'fzefzefezff', 3, 33, 'true', '2022-07-13 17:31:32'),
(30, 'nvrlmgjvlrnelkvgn,lrf', 3, 34, 'true', '2022-07-13 17:33:09'),
(31, 'ezfazfazefr', 3, 35, 'true', '2022-07-13 17:33:46'),
(32, 'azdzedzerf', 3, 35, 'false', '2022-07-13 17:39:18'),
(33, 'Oui', 3, 3, 'false', '2022-07-13 17:41:26'),
(34, 'ezadeazdad', 3, 36, 'true', '2022-07-13 17:51:26'),
(35, 'will this work didier ? ', 3, 37, 'true', '2022-07-13 17:57:55'),
(36, 'will it work jean didier ? n\'oublie pas de masquer revue du sujet !', 3, 38, 'true', '2022-07-13 17:58:19'),
(37, 'ok', 3, 36, 'false', '2022-07-13 20:09:03'),
(38, 'C\'est un echec\'', 1, 39, 'true', '2022-07-14 10:42:24'),
(39, 'Test requête mi-GET, mi-POST et re mi-GET derrière', 2, 39, 'false', '2022-07-14 10:45:37'),
(40, 'Le message ci-dessus doit être édité, c\'était un ajout de message post-implémentation du token. Et c\'est pas Oli qui l\'a posté, c\'est Pierre, faut revoir les routes', 1, 39, 'false', '2022-07-14 10:46:34'),
(41, 'l\'id user a été pris dans $_SESSION', 2, 40, 'true', '2022-07-14 10:50:38'),
(42, 'même démarche mais avec un autre compte', 1, 41, 'true', '2022-07-14 10:51:40'),
(43, 'Ok avec les messages aussi', 0, 41, 'false', '2022-07-14 11:03:18'),
(44, 'Quand ça veut pas', 1, 41, 'false', '2022-07-14 11:06:22'),
(45, 'ben ça veut bien quand même', 2, 41, 'false', '2022-07-14 11:06:55'),
(46, 'Bon et la ? ', 2, 41, 'false', '2022-07-14 11:07:27'),
(47, 'Bon et la ? ', 2, 41, 'false', '2022-07-14 11:07:52');

-- --------------------------------------------------------

--
-- Stand-in structure for view `nb topic par categorie`
-- (See below for the actual view)
--
CREATE TABLE `nb topic par categorie` (
`id_category` int(10) unsigned
,`name_category` varchar(255)
,`number_topic` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(10) UNSIGNED NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `id_category` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id_topic`, `topic_name`, `id_category`) VALUES
(1, 'Your first topic', 1),
(2, 'Connaissez-vous la balise summary ? ', 1),
(3, 'Est-ce que tailwind est une usine à gaz ?', 2),
(4, 'Meme JS', 3),
(5, 'je devienne fou', 1),
(10, 'Ce topic est créé via insomnia', 3),
(24, 'Insomnia next step', 3),
(25, 'SASS c\'est plus fort que toi', 2),
(29, 'test debug client forum', 3),
(30, 'dadazd', 1),
(31, 'dadazddazda', 1),
(32, 'azdzefrzgze', 1),
(33, 'efzeffzrfgr', 1),
(34, 'jfnzhkgngnrk', 1),
(35, 'da\"fdzefdrea', 1),
(36, 'zea\"er\"a', 1),
(37, 'test final depuis la cat html', 1),
(38, 'test final dans la cat html depuis un topic', 1),
(39, 'test topic après création script auth', 3),
(40, 'creation d\'un topic avec id_user auto', 3),
(41, 'creation d\'un topic avec id_user auto', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(42) NOT NULL,
  `password` varchar(42) NOT NULL,
  `email` varchar(42) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `password`, `email`, `registration_date`) VALUES
(1, 'pierre', 'pass', 'coucou@yopmail.com', '2022-07-12 11:14:55'),
(2, 'oli', 'pass', 'tvvmb@yopmail.com', '2022-07-12 11:14:55'),
(3, 'guest', 'pass', 'titeca.f@gmail.com', '2022-07-13 11:48:48');

-- --------------------------------------------------------

--
-- Structure for view `lj cat topic message user`
--
DROP TABLE IF EXISTS `lj cat topic message user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `lj cat topic message user`  AS SELECT `c`.`id_category` AS `id_category`, `c`.`name_category` AS `name_category`, `t`.`id_topic` AS `id_topic`, `t`.`topic_name` AS `topic_name`, `m`.`id_message` AS `id_message`, `m`.`message` AS `message`, `m`.`id_user` AS `id_user`, `m`.`date_message` AS `date_message`, `u`.`user_name` AS `user_name` FROM (((`category` `c` left join `topic` `t` on(`c`.`id_category` = `t`.`id_category`)) left join `message` `m` on(`t`.`id_topic` = `m`.`id_topic`)) left join `user` `u` on(`m`.`id_user` = `u`.`id_user`))  ;

-- --------------------------------------------------------

--
-- Structure for view `nb topic par categorie`
--
DROP TABLE IF EXISTS `nb topic par categorie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nb topic par categorie`  AS SELECT `c`.`id_category` AS `id_category`, `c`.`name_category` AS `name_category`, count(`t`.`id_topic`) AS `number_topic` FROM (`category` `c` left join `topic` `t` on(`c`.`id_category` = `t`.`id_category`)) GROUP BY `c`.`name_category` ORDER BY `c`.`id_category` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `topic_key` (`id_topic`),
  ADD KEY `user_key` (`id_user`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
