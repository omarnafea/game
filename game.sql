-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2022 at 08:17 PM
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
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name_en`, `name_ar`) VALUES
(3, '7 years old', 'عمر 7 سنوات'),
(4, ' 2 years old', 'عمر سنتين');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('TEXT_QUESTIONS','PICK_IMAGE') NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sound` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `user_id`, `type`, `name_en`, `name_ar`, `category_id`, `image`, `sound`, `is_active`) VALUES
(1, 1, 'PICK_IMAGE', 'Colors Game', 'لعبة الالوان', 4, 'http://localhost/game/upload/images/66967_file-20170918-8245-fvelv2.png', '', 1),
(2, 1, 'PICK_IMAGE', 'Flags Game', 'لعبة الاعلام', 3, 'http://localhost/game/upload/images/158636_download(2).png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game_stages`
--

CREATE TABLE `game_stages` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `content_type` enum('STRING','IMAGE','VOICE') NOT NULL DEFAULT 'STRING',
  `content` varchar(500) NOT NULL,
  `correct_answer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game_stages`
--

INSERT INTO `game_stages` (`id`, `game_id`, `content_type`, `content`, `correct_answer_id`) VALUES
(1, 1, 'VOICE', 'http://localhost/game/upload/voices/591552_احمر.mp3', 1),
(2, 1, 'VOICE', 'http://localhost/game/upload/voices/918215_وردي.mp3', 6),
(3, 1, 'VOICE', 'http://localhost/game/upload/voices/262324_اخضر.mp3', 9),
(4, 1, 'VOICE', 'http://localhost/game/upload/voices/813994_اسود.mp3', 14),
(5, 1, 'VOICE', 'http://localhost/game/upload/voices/96999_برتقالي.mp3', 19),
(6, 2, 'STRING', 'علم الاردن', 21),
(7, 2, 'STRING', 'علم السودان', 27),
(8, 2, 'STRING', 'علم تونس', 32),
(9, 2, 'STRING', 'علم فلسطين', 34);

-- --------------------------------------------------------

--
-- Table structure for table `stage_options`
--

CREATE TABLE `stage_options` (
  `id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stage_options`
--

INSERT INTO `stage_options` (`id`, `stage_id`, `option`) VALUES
(1, 1, 'http://localhost/game/upload/images/852807_87033fcb65eaf4cadac3cdc2b60ffe25.jpg'),
(2, 1, 'http://localhost/game/upload/images/154357_blue.jpg'),
(3, 1, 'http://localhost/game/upload/images/661863_naples-yellow-painted-swatch-300x300.jpg'),
(4, 1, 'http://localhost/game/upload/images/507292_green.jpg'),
(5, 2, 'http://localhost/game/upload/images/301768_87033fcb65eaf4cadac3cdc2b60ffe25.jpg'),
(6, 2, 'http://localhost/game/upload/images/826026_download(2).jfif'),
(7, 2, 'http://localhost/game/upload/images/654308_blue.jpg'),
(8, 2, 'http://localhost/game/upload/images/386354_naples-yellow-painted-swatch-300x300.jpg'),
(9, 3, 'http://localhost/game/upload/images/500334_green.jpg'),
(10, 3, 'http://localhost/game/upload/images/338184_blue.jpg'),
(11, 3, 'http://localhost/game/upload/images/978826_download(2).jfif'),
(12, 3, 'http://localhost/game/upload/images/602702_naples-yellow-painted-swatch-300x300.jpg'),
(13, 4, 'http://localhost/game/upload/images/893925_download.jfif'),
(14, 4, 'http://localhost/game/upload/images/942957_download(3).jfif'),
(15, 4, 'http://localhost/game/upload/images/207911_naples-yellow-painted-swatch-300x300.jpg'),
(16, 4, 'http://localhost/game/upload/images/285364_blue.jpg'),
(17, 5, 'http://localhost/game/upload/images/555605_download(2).jfif'),
(18, 5, 'http://localhost/game/upload/images/503240_blue.jpg'),
(19, 5, 'http://localhost/game/upload/images/864185_download(4).jfif'),
(20, 5, 'http://localhost/game/upload/images/998766_download(3).jfif'),
(21, 6, 'http://localhost/game/upload/images/302567_download.png'),
(22, 6, 'http://localhost/game/upload/images/300582_download(1).png'),
(23, 6, 'http://localhost/game/upload/images/83135_download(12).jfif'),
(24, 6, 'http://localhost/game/upload/images/548477_download(5).jfif'),
(25, 7, 'http://localhost/game/upload/images/867083_download(5).jfif'),
(26, 7, 'http://localhost/game/upload/images/162011_download(1).png'),
(27, 7, 'http://localhost/game/upload/images/150744_download(8).jfif'),
(28, 7, 'http://localhost/game/upload/images/898149_download.png'),
(29, 8, 'http://localhost/game/upload/images/886127_download(5).jfif'),
(30, 8, 'http://localhost/game/upload/images/359117_download.png'),
(31, 8, 'http://localhost/game/upload/images/690174_download(8).jfif'),
(32, 8, 'http://localhost/game/upload/images/109334_download(12).jfif'),
(33, 9, 'http://localhost/game/upload/images/54764_download(1).png'),
(34, 9, 'http://localhost/game/upload/images/355726_download(5).jfif'),
(35, 9, 'http://localhost/game/upload/images/640207_download.png'),
(36, 9, 'http://localhost/game/upload/images/470684_download(10).jfif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `password`, `is_active`) VALUES
(1, 'omar', 'omar', 'omar@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(2, 'ahmad', 'ahmad', 'ahmad@gmail.com', 'fb96549631c835eb239cd614cc6b5cb7d295121a', 1),
(3, 'omar11', 'omar11', 'omar2@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`name_en`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_stages`
--
ALTER TABLE `game_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stage_options`
--
ALTER TABLE `stage_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `game_stages`
--
ALTER TABLE `game_stages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stage_options`
--
ALTER TABLE `stage_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
