-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2024 at 03:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aids_awareness`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 11, 1, 'Yes, let\'s use condoms for safer sex.\r\n', '2024-05-16 20:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `flagged` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image_url`, `created_at`, `flagged`) VALUES
(1, 1, 'Prevention is better than Cure!', 'Let prevent ourselves from HIV/AIDS.', '', '2024-05-16 07:41:16', 0),
(2, 1, 'Prevention! Prevention!', 'Protect Yourself and Others from HIV/AIDS\r\nHIV/AIDS prevention is essential to curb the spread of the virus. Here are some key prevention strategies:\r\n\r\nUse Condoms Consistently and Correctly: Always use condoms during sexual intercourse to reduce the risk of HIV transmission.\r\n\r\nGet Tested Regularly: Know your HIV status and that of your partner. Regular testing is crucial for early detection and management.\r\n\r\nLimit Sexual Partners: Reducing the number of sexual partners can decrease the risk of HIV exposure.\r\n\r\nPre-Exposure Prophylaxis (PrEP): If you are at high risk of HIV, consider PrEP, a daily pill that significantly reduces the risk of getting HIV.\r\n\r\nAvoid Sharing Needles: Use only sterile needles and never share them to prevent HIV transmission through blood.\r\n\r\nGet Educated: Stay informed about HIV/AIDS and educate others about prevention methods.\r\n\r\nRemember, prevention is key! Protect yourself and your loved ones by following these guidelines and spreading awareness about HIV/AIDS prevention.', '', '2024-05-16 07:51:17', 1),
(3, 1, 'It\'s awareness time!', 'AIDS (Acquired Immunodeficiency Syndrome) awareness is crucial in the global fight against this life-threatening condition caused by the HIV (Human Immunodeficiency Virus). Understanding how HIV is transmitted—through unprotected sex, sharing needles, or from mother to child during childbirth or breastfeeding—is essential for prevention. Awareness efforts emphasize the importance of regular testing, safe sex practices, and the use of antiretroviral therapy (ART) to manage the virus and reduce transmission risk. Stigma reduction and education are key, empowering individuals to seek testing and treatment without fear of discrimination, thereby improving health outcomes and saving lives.', '', '2024-05-16 08:00:20', 0),
(11, 1, 'Prevention Tips!', 'Let\'s all prevent HIV/AIDS...', 'uploads/prevent-aids.png', '2024-05-16 08:19:05', 0),
(12, 1, 'HIV Prevention is as easy as...', 'Don\'t wait until you wish you knew, prevent it!', 'uploads/hiv-prevention.jpeg', '2024-05-16 20:11:06', 0),
(13, 1, 'HIV/AIDS', 'AIDS is real!', 'uploads/download (1).png', '2024-05-16 20:12:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `profile_pic`, `reset_token`, `reset_token_expire`, `is_admin`) VALUES
(1, 'wamae', 'wamaejoseph392@gmail.com', '$2y$10$0sF78HUpvb4iL2rueKM.uO1/QgRCXTSFeQ6wzWGJ7vtF0zFubwfmC', '2024-04-15 04:35:17', NULL, 'a62fdbbf4f5650134779bda029058d05', '2024-05-31 18:22:25', 1),
(4, 'ndiritu', 'ndirituwamae@students.uonbi.ac.ke', '$2y$10$40vYY6pMGM0mAixOZeoWnecg6pRfoiaofr.wQpqUIylxecWE7wmV.', '2024-04-15 04:42:27', NULL, NULL, NULL, 0),
(5, 'debby', 'deborahnyarinda3@gmail.com', '$2y$10$3DVEue0qMd1hDSidOEgoK.bmPMmmWVI5zaJA6MGhevrD.SfhiIAhe', '2024-04-16 05:31:41', NULL, NULL, NULL, 0),
(6, 'johndoe1', 'johndoe@gmail.com', '$2y$10$.jfZLefkyXzbBLLVeoWqF.jzL0l/MDWcBHfmR48tRY5MMcrnoFrb2', '2024-06-02 19:18:58', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
