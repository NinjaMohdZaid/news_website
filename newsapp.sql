-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2023 at 08:34 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int NOT NULL,
  `type` char(1) NOT NULL,
  `start_date` int NOT NULL,
  `end_date` int NOT NULL,
  `frequency` int NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `type`, `start_date`, `end_date`, `frequency`, `status`) VALUES
(1, 'I', 1673996400, 1674082800, 44, 'D'),
(2, 'I', 1674082800, 1674774000, 12, 'A'),
(3, 'I', 1674169200, 1674860400, 56, 'A'),
(4, 'I', 1674169200, 1674860400, 56, 'D'),
(5, 'I', 1674169200, 1674860400, 56, 'D'),
(6, 'V', 1674169200, 1674860400, 56, 'A'),
(7, 'V', 1674169200, 1674860400, 56, 'A'),
(8, 'V', 1674169200, 1674860400, 56, 'A'),
(10, 'M', 1673910000, 1674082800, 4, 'A'),
(11, 'M', 1673910000, 1674082800, 4, 'A'),
(12, 'M', 1673910000, 1674082800, 4, 'A'),
(13, 'M', 1673996400, 1674774000, 54, 'A'),
(14, 'M', 1673996400, 1674774000, 54, 'A'),
(15, 'M', 1673996400, 1674774000, 54, 'A'),
(16, 'M', 1673996400, 1674774000, 54, 'A'),
(17, 'I', 1674687600, 1675378800, 34, 'A'),
(18, 'I', 1674687600, 1676070000, 34, 'A'),
(21, 'I', 1677369600, 1677542400, 4, 'A'),
(22, 'T', 1677369600, 1677542400, 4, 'A'),
(23, 'I', 1677456000, 1677628800, 5, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `ad_descriptions`
--

CREATE TABLE `ad_descriptions` (
  `ad_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `lang_code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ad_descriptions`
--

INSERT INTO `ad_descriptions` (`ad_id`, `title`, `description`, `lang_code`) VALUES
(1, 'dsgfdge', '', 'ar'),
(1, 'dsgfdge', '', 'en'),
(1, 'dsgfdge', '', 'ur'),
(2, 'yfy', '', 'ar'),
(2, 'yfy', '', 'en'),
(2, 'yfy', '', 'ur'),
(3, 'hgfty', '', 'ar'),
(3, 'hgfty', '', 'en'),
(3, 'hgfty', '', 'ur'),
(4, 'hgfty', '', 'ar'),
(4, 'hgfty', '', 'en'),
(4, 'hgfty', '', 'ur'),
(5, 'hgfty', '', 'ar'),
(5, 'hgfty', '', 'en'),
(5, 'hgfty', '', 'ur'),
(6, 'hgfty', '', 'ar'),
(6, 'hgfty', '', 'en'),
(6, 'hgfty', '', 'ur'),
(7, 'hgfty', '', 'ar'),
(7, 'hgfty', '', 'en'),
(7, 'hgfty', '', 'ur'),
(8, 'hgfty', '', 'ar'),
(8, 'hgfty', '', 'en'),
(8, 'hgfty', '', 'ur'),
(10, 'This is question', '', 'ar'),
(10, 'This is question', '', 'en'),
(10, 'This is question', '', 'ur'),
(11, 'This is question', '', 'ar'),
(11, 'This is question', '', 'en'),
(11, 'This is question', '', 'ur'),
(12, 'This is question', '', 'ar'),
(12, 'This is question', '', 'en'),
(12, 'This is question', '', 'ur'),
(13, 'dgd', '', 'ar'),
(13, 'dgd', '', 'en'),
(13, 'dgd', '', 'ur'),
(14, 'dgd', '', 'ar'),
(14, 'dgd', '', 'en'),
(14, 'dgd', '', 'ur'),
(15, 'dgd', '', 'ar'),
(15, 'dgd', '', 'en'),
(15, 'dgd', '', 'ur'),
(16, 'dgd', '', 'ar'),
(16, 'dgd', '', 'en'),
(16, 'dgd', '', 'ur'),
(17, 'Image Test', '', 'ar'),
(17, 'Image Test', '', 'en'),
(17, 'Image Test', '', 'ur'),
(18, 'Test', '', 'ar'),
(18, 'Test', '', 'en'),
(18, 'Test', '', 'ur'),
(21, 'text ad', '', 'ar'),
(21, 'text ad', '', 'en'),
(21, 'text ad', '', 'ur'),
(22, 'ttt', '<p>rrr</p>', 'ar'),
(22, 'ttt', '<p>rrr</p>', 'en'),
(22, 'ttt', '<p>rrr</p>', 'ur'),
(23, 'img test', '', 'ar'),
(23, 'img test', '', 'en'),
(23, 'img test', '', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `code` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language`, `code`) VALUES
('عربى', 'ar'),
('English', 'en'),
('اُردُو', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_options`
--

CREATE TABLE `mcq_options` (
  `option_id` int NOT NULL,
  `ad_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_options`
--

INSERT INTO `mcq_options` (`option_id`, `ad_id`) VALUES
(1, 15),
(2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `mcq_option_descriptions`
--

CREATE TABLE `mcq_option_descriptions` (
  `option_id` int NOT NULL,
  `option_text` text NOT NULL,
  `lang_code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mcq_option_descriptions`
--

INSERT INTO `mcq_option_descriptions` (`option_id`, `option_text`, `lang_code`) VALUES
(2, 'fe', 'ar'),
(2, 'fe', 'en'),
(2, 'fe', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `date` int NOT NULL,
  `user_id` int NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment`, `date`, `user_id`, `status`) VALUES
(1, '45.60', 1674514800, 5, 'A'),
(2, '56.00', 1676502000, 3, 'A'),
(3, '45.00', 1675897200, 3, 'A'),
(4, '5.00', 1677542400, 3, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `article_type` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`article_type`, `price`) VALUES
('I', '65.004'),
('N', '449.000'),
('T', '6999.000');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int NOT NULL,
  `Is_Active` int DEFAULT NULL,
  `timestamp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `Is_Active`, `timestamp`) VALUES
(10, 1, 0),
(11, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory_descriptions`
--

CREATE TABLE `tblcategory_descriptions` (
  `id` int NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `lang_code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory_descriptions`
--

INSERT INTO `tblcategory_descriptions` (`id`, `CategoryName`, `Description`, `lang_code`) VALUES
(10, 'cate yghyuf', 'desc', 'ar'),
(10, 'cate yghyuf', 'ddd', 'en'),
(10, 'cate yghyuf', 'descdc', 'ur'),
(11, 'arcbbh', 'uftftd', 'ar'),
(11, 'yfyd', 'uftftd', 'en'),
(11, 'urdu', 'uftftd', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int NOT NULL,
  `postId` int DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `postId`, `name`, `email`, `comment`, `postingDate`, `status`) VALUES
(1, 12, 'Anuj', 'anuj@gmail.com', 'Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.', '2021-11-20 18:30:00', 1),
(2, 12, 'Test user', 'test@gmail.com', 'This is sample text for testing.', '2021-11-20 18:30:00', 1),
(3, 7, 'ABC', 'abc@test.com', 'This is sample text for testing.', '2021-11-20 18:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext,
  `Description` longtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About News Portal', '<font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, å¾®è½¯é›…é»‘, å®‹ä½“, SimSun, STXihei, åŽæ–‡ç»†é»‘, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br>', '2021-06-29 18:30:00', '2021-11-06 18:30:00'),
(2, 'contactus', 'Contact Details', '<p><br></p><p><b>Address :&nbsp; </b>New Delhi India</p><p><b>Phone Number : </b>+91 -01234567890</p><p><b>Email -id : </b>phpgurukulofficial@gmail.com</p>', '2021-06-29 18:30:00', '2021-11-06 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int NOT NULL,
  `CategoryId` int DEFAULT NULL,
  `PostUrl` mediumtext,
  `viewCounter` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `is_deleted` char(1) NOT NULL DEFAULT 'N',
  `type` char(1) NOT NULL,
  `timestamp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `CategoryId`, `PostUrl`, `viewCounter`, `user_id`, `lastUpdatedBy`, `status`, `is_deleted`, `type`, `timestamp`) VALUES
(26, 10, 'Thios-is-test-title', NULL, 1, NULL, 'A', 'Y', 'I', 0),
(27, 10, 'virat', NULL, 1, NULL, 'A', 'N', 'I', 0),
(28, 10, 'test', NULL, 1, NULL, 'A', 'N', 'T', 0),
(29, 10, 'test-image-article', NULL, 1, NULL, 'A', 'N', 'I', 0),
(30, 10, 'test-image-article', NULL, 1, NULL, 'A', 'N', 'I', 0),
(31, 10, 'test-image-article', NULL, 1, NULL, 'A', 'N', 'I', 0),
(36, 10, 'virat', NULL, 1, NULL, 'A', 'N', 'I', 0),
(37, 10, 'dfdgfe-mg', NULL, 1, NULL, 'A', 'N', 'I', 0),
(38, 10, 'aiud7d', NULL, 1, NULL, 'A', 'N', 'V', 0),
(39, 10, 'ggs', NULL, 1, NULL, 'A', 'N', 'T', 0),
(40, 10, 'ddd', NULL, 1, NULL, 'A', 'N', 'T', 0),
(41, 10, 'ddd', NULL, 1, NULL, 'A', 'N', 'T', 0),
(42, 10, 'ggg', NULL, 1, NULL, 'A', 'N', 'T', 0),
(43, 10, 'virat', NULL, 1, NULL, 'A', 'N', 'V', 0),
(44, 10, 'test-text', NULL, 1, NULL, 'A', 'N', 'T', 0),
(46, 10, 'vdo-tets', NULL, 1, NULL, 'A', 'N', 'V', 0),
(48, 10, 'test-time', NULL, 1, NULL, 'A', 'N', 'T', 1678349888);

-- --------------------------------------------------------

--
-- Table structure for table `tblpost_descriptions`
--

CREATE TABLE `tblpost_descriptions` (
  `id` int NOT NULL,
  `PostTitle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `PostDetails` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lang_code` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpost_descriptions`
--

INSERT INTO `tblpost_descriptions` (`id`, `PostTitle`, `PostDetails`, `lang_code`) VALUES
(26, 'Thios is test title', '<p>This is news content</p>', 'ar'),
(26, 'Thios is test title', '<p>This is news content</p>', 'en'),
(26, 'Thios is test title', '<p>This is news content</p>', 'ur'),
(27, 'virat', '<p>ss</p>', 'ar'),
(27, 'virat', '<p>ss</p>', 'en'),
(27, 'virat', '<p>ss</p>', 'ur'),
(28, 'test', '<p>test</p>', 'ar'),
(28, 'test', '<p>test</p>', 'en'),
(28, 'test', '<p>test</p>', 'ur'),
(29, 'test image article', '<p>test content</p>', 'ar'),
(29, 'test image article', '<p>test content</p>', 'en'),
(29, 'test image article', '<p>test content</p>', 'ur'),
(30, 'test image article', '<p>test content</p>', 'ar'),
(30, 'test image article', '<p>test content</p>', 'en'),
(30, 'test image article', '<p>test content</p>', 'ur'),
(31, 'test image article', '<p>test content</p>', 'ar'),
(31, 'test image article', '<p>test content</p>', 'en'),
(31, 'test image article', '<p>test content</p>', 'ur'),
(32, 'test image article', '<p>test content</p>', 'ar'),
(32, 'test image article', '<p>test content</p>', 'en'),
(32, 'test image article', '<p>test content</p>', 'ur'),
(33, 'virat', '<p>dddd</p>', 'ar'),
(33, 'virat', '<p>dddd</p>', 'en'),
(33, 'virat', '<p>dddd</p>', 'ur'),
(34, 'virat', '<p>dddd</p>', 'ar'),
(34, 'virat', '<p>dddd</p>', 'en'),
(34, 'virat', '<p>dddd</p>', 'ur'),
(35, 'virat', '<p>dddd</p>', 'ar'),
(35, 'virat', '<p>dddd</p>', 'en'),
(35, 'virat', '<p>dddd</p>', 'ur'),
(36, 'virat', '<p>dd</p>', 'ar'),
(36, 'virat', '<p>dd</p>', 'en'),
(36, 'virat', '<p>dd</p>', 'ur'),
(37, 'dfdgfe mg', '<p>gg</p>', 'ar'),
(37, 'dfdgfe mg', '<p>gg</p>', 'en'),
(37, 'dfdgfe mg', '<p>gg</p>', 'ur'),
(38, 'aiud7d', '<p>ddd</p>', 'ar'),
(38, 'aiud7d', '<p>ddd</p>', 'en'),
(38, 'aiud7d', '<p>ddd</p>', 'ur'),
(39, 'ggs', '<p>dd</p>', 'ar'),
(39, 'ggs', '<p>dd</p>', 'en'),
(39, 'ggs', '<p>dd</p>', 'ur'),
(40, 'ddd', '<p>dddd</p>', 'ar'),
(40, 'ddd', '<p>dddd</p>', 'en'),
(40, 'ddd', '<p>dddd</p>', 'ur'),
(41, 'ddd', '<p>dddd</p>', 'ar'),
(41, 'ddd', '<p>dddd</p>', 'en'),
(41, 'ddd', '<p>dddd</p>', 'ur'),
(42, 'ggg', '<p>hhh</p>', 'ar'),
(42, 'ggg', '<p>hhh</p>', 'en'),
(42, 'ggg', '<p>hhh</p>', 'ur'),
(43, 'virat', '<p>ggg</p>', 'ar'),
(43, 'virat', '<p>ggg</p>', 'en'),
(43, 'virat', '<p>ggg</p>', 'ur'),
(44, 'test text', '<p>ggg</p>', 'ar'),
(44, 'test text', '<p>gggff</p>', 'en'),
(44, 'test text', '<p>ggg</p>', 'ur'),
(46, 'vdo tets', '<p>test video</p>', 'ar'),
(46, 'vdo tets', '<p>test video</p>', 'en'),
(46, 'vdo tets', '<p>test video</p>', 'ur'),
(48, 'test time', '<p>dd</p>', 'ar'),
(48, 'test time', '<p>dd</p>', 'en'),
(48, 'test time', '<p>dd</p>', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `userType` char(1) NOT NULL,
  `phone` varchar(155) NOT NULL,
  `timestamp` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `userType`, `phone`, `timestamp`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', 'phpgurukulofficial@gmail.com', 'admin', 'A', '0', 0),
(3, 'subadmin', 'f925916e2754e5e03f75dd58a5733251', 'sudamin@gmail.in', 'Content Contributer Name', 'C', '0', 0),
(4, 'suadmin2', 'f925916e2754e5e03f75dd58a5733251', 'sbadmin@test.com', 'sbadmin', 'E', '0', 0),
(5, 'testuser', 'f925916e2754e5e03f75dd58a5733251', 'sales1@siwe.tech', 'ssadmin1', 'C', '0', 0),
(9, 'sub123', '9b569f88da56bc5530c11dca4ea52c58', 'sub123@gmail.com', 'Mohd Zaid', 'M', '0', 0),
(10, 'userggg', 'e10adc3949ba59abbe56e057f20f883e', 'test@gmail.com', 'This is end user', 'E', '0', 0),
(16, 'admin433', 'e10adc3949ba59abbe56e057f20f883e', 'admin433@gmail.com', 'test', 'P', '7655554443', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `ad_descriptions`
--
ALTER TABLE `ad_descriptions`
  ADD PRIMARY KEY (`ad_id`,`lang_code`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `mcq_options`
--
ALTER TABLE `mcq_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `mcq_option_descriptions`
--
ALTER TABLE `mcq_option_descriptions`
  ADD PRIMARY KEY (`option_id`,`lang_code`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `article_type` (`article_type`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory_descriptions`
--
ALTER TABLE `tblcategory_descriptions`
  ADD PRIMARY KEY (`id`,`lang_code`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`);

--
-- Indexes for table `tblpost_descriptions`
--
ALTER TABLE `tblpost_descriptions`
  ADD PRIMARY KEY (`id`,`lang_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `mcq_options`
--
ALTER TABLE `mcq_options`
  MODIFY `option_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
