-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 09:38 AM
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
-- Database: `newsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `frequency` int(11) NOT NULL,
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
(9, 'I', 1674428400, 1674774000, 56, 'D'),
(10, 'M', 1673910000, 1674082800, 4, 'A'),
(11, 'M', 1673910000, 1674082800, 4, 'A'),
(12, 'M', 1673910000, 1674082800, 4, 'A'),
(13, 'M', 1673996400, 1674774000, 54, 'A'),
(14, 'M', 1673996400, 1674774000, 54, 'A'),
(15, 'M', 1673996400, 1674774000, 54, 'A'),
(16, 'M', 1673996400, 1674774000, 54, 'A'),
(17, 'I', 1674687600, 1675378800, 34, 'A'),
(18, 'I', 1674687600, 1676070000, 34, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `ad_descriptions`
--

CREATE TABLE `ad_descriptions` (
  `ad_id` int(11) NOT NULL,
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
(9, 'gyf', '', 'ar'),
(9, 'gyf', '', 'en'),
(9, 'gyf', '', 'ur'),
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
(18, 'Test', '', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` char(2) CHARACTER SET utf8 NOT NULL
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
  `option_id` int(11) NOT NULL,
  `ad_id` int(11) NOT NULL
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
  `option_id` int(11) NOT NULL,
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
  `payment_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment`, `date`, `user_id`) VALUES
(1, '45.60', 1674514800, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, '2021-06-05 18:30:00', '2021-06-13 18:30:00', 1),
(5, '2021-06-13 18:30:00', '2021-06-13 18:30:00', 1),
(6, '2021-06-21 18:30:00', '0000-00-00 00:00:00', 1),
(7, '2021-06-21 18:30:00', '0000-00-00 00:00:00', 1),
(8, '2021-11-07 18:17:28', NULL, 1),
(10, '2023-01-14 07:28:46', NULL, 1),
(11, '2023-01-14 08:08:26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory_descriptions`
--

CREATE TABLE `tblcategory_descriptions` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `lang_code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory_descriptions`
--

INSERT INTO `tblcategory_descriptions` (`id`, `CategoryName`, `Description`, `lang_code`) VALUES
(10, 'cate yghyuf', 'desc', 'ar'),
(10, 'cate yghyuf', 'desc', 'en'),
(10, 'cate yghyuf', 'descdc', 'ur'),
(11, 'arcbbh', 'uftftd', 'ar'),
(11, 'yfyd', 'uftftd', 'en'),
(11, 'urdu', 'uftftd', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
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
  `id` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `is_deleted` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `CategoryId`, `PostingDate`, `UpdationDate`, `PostUrl`, `PostImage`, `viewCounter`, `user_id`, `lastUpdatedBy`, `status`, `is_deleted`) VALUES
(7, 3, '2021-07-07 18:30:00', '2021-11-10 18:42:01', 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', '6d08a26c92cf30db69197a1fb7230626.jpg', 24, 1, NULL, 'A', 'N'),
(10, 7, '2021-06-30 18:30:00', '2023-01-15 11:13:59', 'Tata-Steel,-Thyssenkrupp-Finalise-Landmark-Steel-Deal', '505e59c459d38ce4e740e3c9f5c6caf7.jpg', 1, 1, NULL, 'D', 'N'),
(11, 6, '2021-06-30 18:30:00', '2021-11-10 18:41:22', 'UNs-Jean-Pierre-Lacroix-thanks-India-for-contribution-to-peacekeeping', '27095ab35ac9b89abb8f32ad3adef56a.jpg', 34, 1, NULL, 'A', 'N'),
(12, 6, '2021-06-30 18:30:00', '2021-11-10 19:00:27', 'Shah-holds-meeting-with-NE-states-leaders-in-Manipur', '7fdc1a630c238af0815181f9faa190f5.jpg', 22, 1, NULL, 'A', 'N'),
(13, 3, '2021-11-10 18:50:09', '2023-01-15 10:21:10', 'T20-World-Cup-2021:-Semi-final-1,-England-vs-New-Zealand-â€“-Who-Said-What', '8bc5c30be91dca9d07c1db858c60e39f.jpg', 6, 1, 'NULL', 'A', 'N'),
(14, 3, '2022-12-21 17:31:59', NULL, 'ufyyuy', '1e6ae4ada992769567b71815f124fac5.jpg', NULL, 1, NULL, 'A', 'N'),
(15, 3, '2023-01-13 18:38:14', NULL, 'title', '8df0d543a1411c7f9ea0507cabb50a91.png', NULL, 1, NULL, 'A', 'N'),
(16, 6, '2023-01-13 18:41:14', NULL, 'dfdgfe', '8df0d543a1411c7f9ea0507cabb50a91.png', NULL, 1, NULL, 'A', 'N'),
(17, 3, '2023-01-13 18:42:19', NULL, 'testsfsygfs', '8df0d543a1411c7f9ea0507cabb50a91.png', NULL, 1, NULL, 'A', 'N'),
(18, 3, '2023-01-13 18:45:17', NULL, 'ydyrdy', '8df0d543a1411c7f9ea0507cabb50a91.png', NULL, 1, NULL, 'A', 'N'),
(19, 5, '2023-01-13 18:47:09', NULL, 'ufyyuyhtdft', '8df0d543a1411c7f9ea0507cabb50a91.png', NULL, 1, NULL, 'A', 'N'),
(20, 5, '2023-01-13 18:49:21', '2023-01-15 11:41:23', 'yfytd', '8df0d543a1411c7f9ea0507cabb50a91.png', NULL, 1, NULL, 'D', 'N'),
(21, 11, '2023-01-15 09:58:51', '2023-01-15 14:22:03', 'title-of-news-fahad', '1673792523_6b228d5f49f370cef3a1ffe634f44fdc.jpg', NULL, 1, NULL, 'A', 'N'),
(22, 11, '2023-01-15 10:37:00', '2023-01-15 11:40:32', 'virat', '6b228d5f49f370cef3a1ffe634f44fdc.jpg', NULL, 1, NULL, 'D', 'N'),
(23, 11, '2023-01-15 10:38:01', '2023-01-15 14:23:12', 'virat', '6b228d5f49f370cef3a1ffe634f44fdc.jpg', NULL, 1, NULL, 'A', 'N'),
(26, 10, '2023-01-26 08:00:49', NULL, 'Thios-is-test-title', '1674720049_6b228d5f49f370cef3a1ffe634f44fdc.jpg', NULL, 1, NULL, 'A', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tblpost_descriptions`
--

CREATE TABLE `tblpost_descriptions` (
  `id` int(11) NOT NULL,
  `PostTitle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `PostDetails` longtext CHARACTER SET utf8 NOT NULL,
  `lang_code` char(2) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpost_descriptions`
--

INSERT INTO `tblpost_descriptions` (`id`, `PostTitle`, `PostDetails`, `lang_code`) VALUES
(20, 'yfytd', '<p>tdytd</p>', 'ar'),
(20, 'yfytd', '<p>tdytd</p>', 'en'),
(20, 'yfytd', '<p>tdytd</p>', 'ur'),
(21, 'title of news fahad', '<p>fahad new descsss</p>', ''),
(21, 'title of news fahad', '<p>fahad new desc</p>', 'ar'),
(21, 'titl en e of news fahad', '<p>fahad en new desc</p>', 'en'),
(21, 'title of news fahadee', '<p>fahad new descsss</p>', 'ur'),
(22, 'virat', '<p>gd</p>', 'ar'),
(22, 'virat', '<p>gd</p>', 'en'),
(22, 'virat', '<p>gd</p>', 'ur'),
(23, 'virat', '<p>xvd</p>', 'ar'),
(23, 'virat', '<p>xvd</p>', 'en'),
(23, 'virat', '<p>xvd</p>', 'ur'),
(26, 'Thios is test title', '<p>This is news content</p>', 'ar'),
(26, 'Thios is test title', '<p>This is news content</p>', 'en'),
(26, 'Thios is test title', '<p>This is news content</p>', 'ur');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 5, 'Bollywood ', 'Bollywood masala', '2021-06-21 18:30:00', '2021-11-07 17:59:57', 1),
(4, 3, 'Cricket', 'Cricket\r\n\r\n', '2021-06-29 18:30:00', '2021-11-07 17:59:57', 1),
(5, 3, 'Football', 'Football', '2021-06-29 18:30:00', '2021-11-07 17:59:57', 1),
(6, 5, 'Television', 'TeleVision', '2021-06-30 18:30:00', '2021-11-07 17:59:57', 1),
(7, 6, 'National', 'National', '2021-06-30 18:30:00', '2021-11-07 17:59:57', 1),
(8, 6, 'International', 'International', '2021-06-30 18:30:00', '2021-11-07 17:59:57', 1),
(9, 7, 'India', 'India', '2021-06-30 18:30:00', '2021-11-07 17:59:57', 1),
(10, 8, 'Vaccination', 'Vaccination', '2021-11-07 18:18:25', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `userType` char(1) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', 'phpgurukulofficial@gmail.com', 'admin', 'A', '2021-05-26 18:30:00', '2023-01-14 13:18:28'),
(3, 'subadmin', 'f925916e2754e5e03f75dd58a5733251', 'sudamin@gmail.in', 'Content Contributer Name', 'C', '2021-11-10 18:28:11', '2023-01-29 07:32:29'),
(4, 'suadmin2', 'f925916e2754e5e03f75dd58a5733251', 'sbadmin@test.com', 'sbadmin', 'E', '2021-11-10 18:28:32', '2023-01-14 13:52:13'),
(5, 'testuser', 'f925916e2754e5e03f75dd58a5733251', 'sales1@siwe.tech', 'ssadmin1', 'C', '2022-12-21 00:07:55', '2023-01-14 14:22:16'),
(9, 'sub123', '9b569f88da56bc5530c11dca4ea52c58', 'sub123@gmail.com', 'Mohd Zaid', 'M', '2023-01-15 07:48:36', NULL);

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
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblpost_descriptions`
--
ALTER TABLE `tblpost_descriptions`
  ADD PRIMARY KEY (`id`,`lang_code`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

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
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mcq_options`
--
ALTER TABLE `mcq_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD CONSTRAINT `pid` FOREIGN KEY (`postId`) REFERENCES `tblposts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `postcatid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD CONSTRAINT `catid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
