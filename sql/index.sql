-- Create database
CREATE DATABASE IF NOT EXISTS aids_awareness;

-- Use aids_awareness database
USE aids_awareness;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_admin BOOLEAN DEFAULT FALSE,
    profile_pic VARCHAR(255),
    reset_token VARCHAR(255),
    reset_token_expire DATETIME
);


-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'wamae', 'wamaejoseph392@gmail.com', '$2y$10$0sF78HUpvb4iL2rueKM.uO1/QgRCXTSFeQ6wzWGJ7vtF0zFubwfmC', '2024-04-15 07:35:17'),
(4, 'ndiritu', 'ndirituwamae@students.uonbi.ac.ke', '$2y$10$40vYY6pMGM0mAixOZeoWnecg6pRfoiaofr.wQpqUIylxecWE7wmV.', '2024-04-15 07:42:27'),
(5, 'debby', 'deborahnyarinda3@gmail.com', '$2y$10$3DVEue0qMd1hDSidOEgoK.bmPMmmWVI5zaJA6MGhevrD.SfhiIAhe', '2024-04-16 08:31:41');

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `image_url`, `created_at`) VALUES
(1, 1, 'Prevention is better than Cure!', 'Let prevent ourselves from HIV/AIDS.', '', '2024-05-16 10:41:16'),
(2, 1, 'Prevention! Prevention!', 'Protect Yourself and Others from HIV/AIDS\r\nHIV/AIDS prevention is essential to curb the spread of the virus. Here are some key prevention strategies:\r\n\r\nUse Condoms Consistently and Correctly: Always use condoms during sexual intercourse to reduce the risk of HIV transmission.\r\n\r\nGet Tested Regularly: Know your HIV status and that of your partner. Regular testing is crucial for early detection and management.\r\n\r\nLimit Sexual Partners: Reducing the number of sexual partners can decrease the risk of HIV exposure.\r\n\r\nPre-Exposure Prophylaxis (PrEP): If you are at high risk of HIV, consider PrEP, a daily pill that significantly reduces the risk of getting HIV.\r\n\r\nAvoid Sharing Needles: Use only sterile needles and never share them to prevent HIV transmission through blood.\r\n\r\nGet Educated: Stay informed about HIV/AIDS and educate others about prevention methods.\r\n\r\nRemember, prevention is key! Protect yourself and your loved ones by following these guidelines and spreading awareness about HIV/AIDS prevention.', '', '2024-05-16 10:51:17'),
(3, 1, 'It\'s awareness time!', 'AIDS (Acquired Immunodeficiency Syndrome) awareness is crucial in the global fight against this life-threatening condition caused by the HIV (Human Immunodeficiency Virus). Understanding how HIV is transmitted—through unprotected sex, sharing needles, or from mother to child during childbirth or breastfeeding—is essential for prevention. Awareness efforts emphasize the importance of regular testing, safe sex practices, and the use of antiretroviral therapy (ART) to manage the virus and reduce transmission risk. Stigma reduction and education are key, empowering individuals to seek testing and treatment without fear of discrimination, thereby improving health outcomes and saving lives.', '', '2024-05-16 11:00:20'),
(11, 1, 'Prevention Tips!', 'Let\'s all prevent HIV/AIDS...', 'uploads/prevent-aids.png', '2024-05-16 11:19:05');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);