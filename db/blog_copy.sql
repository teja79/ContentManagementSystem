-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2019 at 12:52 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(4) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Tech');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(4) NOT NULL,
  `comment_post_id` int(4) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `comment_email` varchar(255) NOT NULL,
  `comment_ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` varchar(255) DEFAULT '0',
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views`) VALUES
(1, 1, 'Test Post Please Ignore', 'demo', '2019-03-12 17:19:18', 'background-devices-1.png', '<p>Hello this is a test post by demo</p>', 'test,post', '0', 'published', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_firstname` varchar(16) NOT NULL,
  `user_lastname` varchar(16) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_lastlogin` text,
  `user_role` varchar(32) NOT NULL DEFAULT 'subscriber',
  `user_acc_date` datetime NOT NULL,
  `user_last_update` datetime DEFAULT NULL,
  `user_failed_log` text,
  `user_failed_pass` text,
  `failed_now` int(11) DEFAULT NULL,
  `failed_time` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_pass`, `user_firstname`, `user_lastname`, `user_email`, `user_lastlogin`, `user_role`, `user_acc_date`, `user_last_update`, `user_failed_log`, `user_failed_pass`, `failed_now`, `failed_time`) VALUES
(2, 'demo', '$2y$10$K5maYbjZP1MgEVkqM8bJeuoNCiEYDH5r74efh9skM.uVAkHBT90Ea', 'demo', 'demo', 'demo@demo.com', '127.0.0.1 2019-03-12 17:14:32, 127.0.0.1 2019-03-12 17:02:29, 127.0.0.1 2019-03-12 17:01:06, 127.0.0.1 2019-03-12 17:00:01, 127.0.0.1 2019-03-12 16:58:54, 127.0.0.1 2019-03-12 16:58:42, 127.0.0.1 2019-03-12 16:58:28, 127.0.0.1 2019-03-12 16:57:59, 106.0.38.134 2019-03-12 12:31:02, 106.0.38.134 2019-03-12 12:29:45, 106.0.38.134 2019-03-11 20:38:51, 106.0.38.134 2019-03-11 20:27:02, 106.0.38.134 2019-03-11 16:21:53, 223.182.82.238 2019-03-11 15:30:35, 223.182.82.238 2019-03-11 15:30:05, 106.0.38.134 2019-03-11 14:44:17, 106.0.38.134 2019-03-11 12:10:37, 106.0.38.134 2019-03-11 11:04:33, 106.0.38.134 2019-03-11 09:51:40, 106.0.38.134 2019-03-11 09:45:37, 106.0.38.134 2019-03-10 21:11:56, 2405:204:6529:1e8e:0:0:1e57:c8b1 2019-03-06 14:07:47, 2405:204:6529:1e8e:0:0:1e57:c8b1 2019-03-06 14:05:33, 2405:204:6503:2a19:0:0:1f2:50b1 2019-03-05 23:03:25, 115.98.246.161 2019-03-05 18:38:14, ', 'admin', '2019-03-05 13:07:58', NULL, '2405:204:6529:1e8e:0:0:1e57:c8b1 2019-03-06 14:07:29, ', 'dw o 2019-03-06 14:07:29, ', NULL, 1551861449),
(3, 'ravi', '$2y$10$PuZZGF/KLXHYu5kas9dtneXph8AFMFalov2fghHPaaLd0rWNxRMQa', 'ravi', 'teja', 'kkraviteja9999@gmail.com', '106.0.38.134 2019-03-12 12:32:07, 223.182.82.238 2019-03-11 15:35:58, ', 'superadmin', '2019-03-11 10:02:44', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '9nm6n3n9g1pot9v533ttibdquu', 1552391519),
(2, 'c4kobkbhm5br2j2hqo9t1e33vi', 1552390597),
(3, 'sc7s3gjiqrlbgoubs3fee38o8m', 1552390907),
(4, '8lotlrg34q0japtisj92vjl447', 1552391011);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
