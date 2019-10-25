-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 25, 2019 at 04:21 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_pic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_pic`) VALUES
(1, 'Action', 'Action.jpg'),
(2, 'Adventure', 'Adventure.jpg'),
(3, 'Horror', 'Horror.jpg'),
(4, 'Suspense', 'Suspense.jpg'),
(5, 'Comedy', 'Comedy.jpg'),
(6, 'Sci-Fi', 'Sci-Fi.jpg'),
(7, 'Drama', 'Drama.jpg'),
(8, 'Musical', 'Musical.jpg'),
(9, 'Animation', 'Animation.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `date_commented` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `user_id`, `movie_id`, `review_id`, `date_commented`) VALUES
(1, 'good', 3, 4, 1, '2019-10-12 16:47:38'),
(2, 'thank you', 2, 4, 1, '2019-10-12 16:48:03'),
(3, 'thank you', 2, 4, 1, '2019-10-13 05:43:19'),
(4, 'good', 2, 12, 23, '2019-10-14 13:55:23'),
(5, 'thank you', 2, 12, 23, '2019-10-16 14:22:15'),
(6, '', 12, 1, 2, '2019-10-17 12:57:30'),
(7, '', 12, 1, 2, '2019-10-17 12:57:33'),
(8, 'good', 2, 3, 3, '2019-10-24 03:52:05'),
(9, 'bad', 3, 12, 32, '2019-10-25 02:59:58'),
(10, 'thank you', 2, 4, 33, '2019-10-25 04:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`follow_id`, `source_id`, `target_id`) VALUES
(1, 1, 2),
(4, 1, 5),
(9, 3, 1),
(11, 3, 5),
(12, 3, 2),
(46, 1, 11),
(48, 3, 11),
(67, 2, 3),
(68, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `good`
--

CREATE TABLE `good` (
  `good_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `good`
--

INSERT INTO `good` (`good_id`, `review_id`, `user_id`, `movie_id`) VALUES
(74, 23, 2, 12),
(76, 4, 2, 2),
(77, 9, 2, 4),
(81, 24, 3, 10),
(82, 6, 3, 1),
(87, 33, 3, 4),
(88, 3, 2, 3),
(89, 33, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `loginid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'U'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginid`, `email`, `password`, `status`) VALUES
(7, 'taro@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'U'),
(8, 'ziro@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'U'),
(9, 'saburo@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'U'),
(12, 'tom@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'U'),
(13, 'bob@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'U'),
(14, 'ken@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'U'),
(16, 'koki@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'U'),
(18, 'admin@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `playdate` date NOT NULL,
  `summary` text NOT NULL,
  `performer` varchar(50) NOT NULL,
  `director` varchar(50) NOT NULL,
  `picture` varchar(200) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_id`, `title`, `category_id`, `country`, `playdate`, `summary`, `performer`, `director`, `picture`, `user_id`, `date_added`) VALUES
(1, 'IRONMAN', 1, 'America', '2019-12-30', 'Ironman', 'Robert Downey Jr.', 'Jon Favreau', 'hr_iron_man_poster1.jpg', 1, '2019-10-09 01:13:54'),
(2, 'Captain America', 1, 'America', '2019-12-31', 'Captain America', 'Christopher Robert Evans', 'Anthony Russo', 'captain-america.jpg', 1, '2019-10-09 01:13:54'),
(3, 'IRONMAN2', 1, 'America', '2019-12-31', 'Ironman2', 'Robert Downey Jr.', 'Jon Favreau', 'Ironman2.jpg', 1, '2019-10-09 01:13:54'),
(4, 'Journey to the Center of the Earth', 2, 'America', '2018-12-31', 'Journey to the Center of the Earth', 'Brendan Fraser', 'Eric ', '11170037_800.jpg', 1, '2019-10-11 04:24:12'),
(5, 'The Silence of the Lambs', 3, 'America', '2011-12-30', 'The Silence of the Lambs', 'Jodie Foster,', 'Jonathan Demme', 'The-Silence-Of-The-Lambs.jpg', 2, '2019-10-13 13:21:40'),
(6, 'The Exorcist', 3, 'America', '2013-12-31', 'The Exorcist', 'Linda Blair', 'William Friedkin', 'oWyQdmhVgUIbNuRpn272ShJrrcZ.jpg', 2, '2019-10-13 13:23:13'),
(7, 'Seven', 4, 'America', '2013-12-31', 'Seven', 'Brad Pitt', 'David Fincher', 'Seven_(movie)_poster.jpg', 2, '2019-10-13 13:24:36'),
(8, 'The Hangover', 5, 'America', '2015-12-30', 'The Hangover', ' Zach Galifianakis', ' Todd Phillips', 'MV5BNGQwZjg5YmYtY2VkNC00NzliLTljYTctNzI5NmU3MjE2ODQzXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX675_CR0,0,675,999_AL_.jpg', 2, '2019-10-13 13:25:36'),
(9, 'Inception', 6, 'America', '2016-12-30', 'Inception', ' Leonardo DiCaprio', ' Christopher Nolan', 'MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SY1000_CR0,0,675,1000_AL_.jpg', 2, '2019-10-13 13:26:32'),
(10, 'The Intern', 7, 'America', '2017-12-31', 'The Intern', ' Robert De Niro', 'Nancy Meyers', 'MV5BMTUyNjE5NjI5OF5BMl5BanBnXkFtZTgwNzYzMzU3NjE@._V1_SY1000_CR0,0,674,1000_AL_.jpg', 2, '2019-10-13 13:27:30'),
(11, 'La La Land', 8, 'America', '2016-12-30', 'La La Land', ' Ryan Gosling', 'Damien Chazelle', 'MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SY1000_SX675_AL_.jpg', 2, '2019-10-13 13:28:44'),
(12, 'Toy Story 4', 9, 'America', '2018-12-30', 'Toy Story 4', ' Tom Hanks', ' Josh Cooley', 'MV5BMTYzMDM4NzkxOV5BMl5BanBnXkFtZTgwNzM1Mzg2NzM@._V1_SY1000_CR0,0,674,1000_AL_.jpg', 2, '2019-10-13 13:29:39'),
(13, 'LEON', 2, 'awae', '2018-12-31', 'Captain America', 'Brad Pitt', 'David Fincher', '_.jpg', 12, '2019-10-25 04:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review_content` text NOT NULL,
  `rating_number` int(1) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_content`, `rating_number`, `movie_id`, `user_id`, `review_date`) VALUES
(3, 'csLZFNDJFOHZ?ISfhba?OZAB>ouhs.odjzh.goushedxz./fouvz./degv/z;.de', 3, 3, 1, '2019-10-14 02:36:58'),
(4, 'fozs/;diheeea/fl;eukbg/ljdz;/foiwb/;aoibfgszeg', 4, 2, 1, '2019-10-14 02:36:58'),
(6, 'jhg', 2, 1, 2, '2019-10-17 04:41:25'),
(7, 'ftyikvfykvgtulov tcokyfkory', 1, 2, 2, '2019-10-14 02:36:58'),
(10, 'rdyftghkl;', 4, 1, 3, '2019-10-14 02:36:58'),
(11, 'cftu.viuko;trdesweh', 4, 3, 3, '2019-10-14 02:36:58'),
(12, 'vujftuiol;l,:lkjhjft', 4, 2, 3, '2019-10-14 02:36:58'),
(17, 'easfesdvfawr', 2, 4, 5, '2019-10-12 02:36:58'),
(18, 'rvagesrfvgsaefgase', 4, 1, 5, '2019-10-14 02:36:58'),
(19, 'aregvsfvgszaetfg', 2, 2, 5, '2019-10-14 02:36:58'),
(20, 'svbasdfbvtefabstefbgsr', 2, 3, 5, '2019-10-14 02:36:58'),
(22, 'srgsert', 2, 11, 2, '2019-10-14 02:36:58'),
(23, 'aaaaaaaaaaaa', 3, 12, 3, '2019-10-14 02:40:00'),
(24, 'good', 4, 10, 2, '2019-10-22 02:52:15'),
(32, 'o', 1, 12, 2, '2019-10-24 03:52:31'),
(33, 'kkk', 3, 4, 3, '2019-10-25 03:00:56'),
(34, 'ooo', 2, 4, 2, '2019-10-25 04:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `loginid` int(11) NOT NULL,
  `icon` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `address`, `number`, `loginid`, `icon`) VALUES
(1, 'Taro', 'Tokyo', '123', 7, '03-thumbnail.jpg'),
(2, 'Ziro', 'Tokyo', '123', 8, '04-thumbnail.jpg'),
(3, 'Saburo3', 'Tokyo', '123', 9, '01-thumbnail.jpg'),
(6, 'Tom', 'U.S.A', '123', 12, 'oWyQdmhVgUIbNuRpn272ShJrrcZ.jpg'),
(7, 'Bob', 'U.S.A', '123', 13, 'The-Silence-Of-The-Lambs.jpg'),
(8, 'Ken', 'U.S.A', '123', 14, 'MV5BMzUzNDM2NzM2MV5BMl5BanBnXkFtZTgwNTM3NTg4OTE@._V1_SY1000_SX675_AL_.jpg'),
(10, 'Koki', 'Osaka', '123', 16, 'MV5BMTYzMDM4NzkxOV5BMl5BanBnXkFtZTgwNzM1Mzg2NzM@._V1_SY1000_CR0,0,674,1000_AL_.jpg'),
(12, 'admin', '123', '1111', 18, 'star.png');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unwatch'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wish_id`, `user_id`, `movie_id`, `status`) VALUES
(1, 1, 4, 'unwatch'),
(2, 1, 1, 'unwatch'),
(3, 1, 2, 'unwatch'),
(4, 1, 3, 'unwatch'),
(10, 3, 1, 'unwatch'),
(11, 3, 3, 'unwatch'),
(12, 3, 2, 'unwatch'),
(17, 5, 4, 'unwatch'),
(18, 5, 1, 'unwatch'),
(19, 5, 2, 'unwatch'),
(20, 5, 3, 'unwatch'),
(191, 2, 9, 'unwatch'),
(193, 2, 8, 'unwatch'),
(194, 2, 2, 'unwatch'),
(195, 2, 3, 'unwatch'),
(201, 2, 10, 'unwatch'),
(209, 2, 12, 'unwatch'),
(211, 3, 4, 'unwatch'),
(212, 3, 12, 'unwatch'),
(213, 2, 4, 'unwatch');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`good_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`loginid`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `good`
--
ALTER TABLE `good`
  MODIFY `good_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `loginid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
