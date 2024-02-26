-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2024 at 12:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scrapbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'New album',
  `tieser` varchar(512) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `tieser`, `date_created`, `date_updated`) VALUES
(1, 'Поездка 2024', 'Классно сгоняли на концерт Глызина', '2024-02-16 15:30:37', '2024-02-16 15:31:05'),
(2, 'Поход 2022', 'Поход за пивом удался на славу!!!!', '2024-02-16 15:30:37', '2024-02-22 17:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(15) NOT NULL,
  `image_id` int(15) NOT NULL,
  `text` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(15) NOT NULL,
  `album_id` int(15) NOT NULL,
  `caption` text DEFAULT NULL,
  `path` varchar(512) NOT NULL,
  `likes` int(15) DEFAULT 0,
  `dislikes` int(15) DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `album_id`, `caption`, `path`, `likes`, `dislikes`, `date_added`) VALUES
(1, 1, 'Это мы на фоне', '/uploads/images/image-1.jpg', 10, 3, '2024-02-23 14:28:23'),
(2, 1, 'Классная картинка', '/uploads/images/image-2.jpg', 2, 2, '2024-02-23 14:31:26'),
(3, 1, 'content-1.jpg', '/uploads/images/content-1.jpg', 0, 0, '2024-02-26 14:19:08'),
(4, 1, 'call-banner.jpg', '/uploads/images/call-banner.jpg', 0, 0, '2024-02-26 14:19:23'),
(5, 1, 'main-banner.jpg', '/uploads/images/main-banner.jpg', 0, 0, '2024-02-26 14:19:23'),
(6, 1, 'testimonials.jpg', '/uploads/images/testimonials.jpg', 0, 0, '2024-02-26 14:19:23'),
(7, 2, 'blog-01.jpg', '/uploads/images/blog-01.jpg', 0, 0, '2024-02-26 14:20:11'),
(8, 2, 'blog-02.jpg', '/uploads/images/blog-02.jpg', 0, 0, '2024-02-26 14:20:11'),
(9, 2, 'contact-form-04.png', '/uploads/images/contact-form-04.png', 0, 0, '2024-02-26 14:20:11'),
(10, 2, 'features_block.png', '/uploads/images/features_block.png', 0, 0, '2024-02-26 14:20:11'),
(11, 2, 'footer-05-brochure.jpg', '/uploads/images/footer-05-brochure.jpg', 0, 0, '2024-02-26 14:20:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
