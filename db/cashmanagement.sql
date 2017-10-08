-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2017 at 10:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cashmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `phone`, `email`, `description`, `status`, `created`, `updated`) VALUES
(1, 'Motilal son', '9024978491', 'motilalsoni@gmail.com', 'sdvsd', 1, '2017-09-30 05:25:08', '2017-09-30 12:20:59'),
(4, 'Aman', '9024978492', 'motilalsoni1@gmail.com', 'hello', 1, '2017-09-30 05:28:20', '2017-09-30 11:53:16'),
(5, 'Vansh Soni', '9024978493', 'motilalsoni2@gmail.com', 'hello', 1, '2017-09-30 05:28:50', NULL),
(7, 'Soniya', '1236547896', 'soniyasoni@gmail.com', 'hello', 1, '2017-09-30 06:00:34', '2017-09-30 12:16:17'),
(8, 'Rishabh Soni', '9024698596', 'motilalsjoni@gmail.com', 'khjhk', 127, '2017-09-30 06:13:42', NULL),
(9, 'Gullu Soni', '9632569866', '', '', 127, '2017-09-30 06:35:22', '2017-09-30 12:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('hnq22vt5ve982k9p6o0nhhvb2rkt2ipf', '127.0.0.1', 1506922915, '__ci_last_regenerate|i:1506922652;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('qd7eh6b3nvsjjroi90ldj553i7gqajnm', '127.0.0.1', 1506923535, '__ci_last_regenerate|i:1506923250;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('9crf4nn6fgims1h36iqup4fg9s0r8o7p', '127.0.0.1', 1506923874, '__ci_last_regenerate|i:1506923606;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('1glmtf7falc2g9jes8ci90bjri1b7hio', '127.0.0.1', 1506924264, '__ci_last_regenerate|i:1506923997;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('mkfkbsgndb0kdd9khb25243eqcfqtvcv', '127.0.0.1', 1506924531, '__ci_last_regenerate|i:1506924343;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('nvufaeckh97krg02p70h81o7ovufqjra', '127.0.0.1', 1506925071, '__ci_last_regenerate|i:1506924895;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('10j27iji8j9fnudmmcnqdqtptqv6cab0', '127.0.0.1', 1506924919, '__ci_last_regenerate|i:1506924919;'),
('65r8vjp46cp7hmujq07o1rkphh33npla', '127.0.0.1', 1506925653, '__ci_last_regenerate|i:1506925431;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('ncdshdshkj1dsoe7ih54aruh95ff3ibg', '::1', 1506925720, '__ci_last_regenerate|i:1506925720;'),
('lk69kc2km256e0r0t492si3mntm8nrtj', '::1', 1506925824, '__ci_last_regenerate|i:1506925720;'),
('8a2qj9tp7bv1p2p2ob497hvkd0mn44vd', '::1', 1506926709, '__ci_last_regenerate|i:1506926512;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('l8pu23d27brn5a4aeskna7urulqp00pk', '127.0.0.1', 1506926760, '__ci_last_regenerate|i:1506926760;'),
('i3ahmpq75sm9fl8k25in98dl9gshmj1g', '127.0.0.1', 1506926974, '__ci_last_regenerate|i:1506926760;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('gcdlqk0ql8q41tflns11tpunt5i7ok95', '127.0.0.1', 1506927317, '__ci_last_regenerate|i:1506927105;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}success|s:28:"Payment updted successfully.";__ci_vars|a:1:{s:7:"success";s:3:"old";}'),
('9iaf08u2pud3bvacbdv488kteaa2efhi', '127.0.0.1', 1506927878, '__ci_last_regenerate|i:1506927703;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('glivd12hp0kpdlejrvfve2bvd78kvc2t', '127.0.0.1', 1506928388, '__ci_last_regenerate|i:1506928111;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('63njjr8bhtlaqisso64ta2p8tdefprf5', '127.0.0.1', 1506928738, '__ci_last_regenerate|i:1506928469;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('9qv8rrhrecp0aj2titer884vgpl3ij54', '127.0.0.1', 1506929032, '__ci_last_regenerate|i:1506928794;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('q76iu0f27pm7mqm38u174hmnmakd8e9m', '127.0.0.1', 1506929321, '__ci_last_regenerate|i:1506929120;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('roquusvbta7e9a7fnu3it0n34oitt6pj', '127.0.0.1', 1506929761, '__ci_last_regenerate|i:1506929472;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('o8hmqhdmtfggvpdscbi58odivdbufk14', '127.0.0.1', 1506930114, '__ci_last_regenerate|i:1506929816;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}'),
('j4ss5n9ml2qcjjob4cq1jl38v5i1cqf8', '127.0.0.1', 1506930230, '__ci_last_regenerate|i:1506930117;_auth_data|O:8:"stdClass":3:{s:8:"username";s:5:"admin";s:5:"email";s:15:"admin@admin.com";s:4:"role";s:1:"2";}');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `meta_keywords` text,
  `meta_description` text,
  `created` datetime DEFAULT NULL,
  `update` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `description`, `meta_keywords`, `meta_description`, `created`, `update`, `status`) VALUES
(25, 'asdasda', 'asdasda', '<p>sdasdasasda</p>', 'asd', 'asda', '2016-03-13 08:19:46', NULL, 1),
(10, 'Allegations at Medway Secure Training Centre', 'allegations-at-medway-secure-training-centre', '<p>sfds</p>', 'sdf', 'sdfsd', '2015-11-26 17:34:12', '2016-03-13 02:49:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `type` enum('text','textarea','select','radio') NOT NULL DEFAULT 'text',
  `select_items` text COMMENT 'Comma saprated value',
  `value` text,
  `is_required` tinyint(4) NOT NULL DEFAULT '0',
  `validation_rules` text,
  `created` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `field_name`, `type`, `select_items`, `value`, `is_required`, `validation_rules`, `created`, `status`) VALUES
(1, 'Site Title', 'site_title', 'text', '', 'ShriRam Pipe Factory', 1, 'trim|required', '2013-04-07 23:23:25', 1),
(2, 'Site Email', 'site_email', 'text', '', 'shrirampipes@gmail.com', 1, 'trim|required|valid_email', '2013-04-07 23:24:28', 1),
(7, 'Default Meta Description', 'default_meta_description', 'textarea', NULL, 'All users cards ss', 0, 'trim|required|min_length[70]|max_length[160]', '2014-05-02 08:45:18', 1),
(8, 'Default meta keyworkds (comma seperated)', 'default_meta_keyworkds', 'textarea', NULL, 'Buy, Sell, Trade,mtgo, magic online, magic the gathering online, cards, collection, tickets, ix, store, shop, auctions', 0, 'trim|required', '2014-05-02 08:46:07', 1),
(9, 'Default Meta Author', 'default_meta_author', 'text', NULL, 'Shriram', 0, 'trim', '2014-05-02 08:50:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `type` enum('Cr','Dr') NOT NULL,
  `amount` float(10,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `due_reminder` datetime DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `account_id`, `type`, `amount`, `note`, `due_reminder`, `created`, `updated`) VALUES
(3, 5, 'Dr', 12.00, '', NULL, '2017-10-01 22:23:46', NULL),
(4, 7, 'Dr', 500.00, 'ttesr', NULL, '2017-10-01 22:24:54', NULL),
(5, 7, 'Dr', 89.00, 'hi', NULL, '2017-10-01 22:25:13', NULL),
(6, 5, 'Dr', 200.00, 'ttest', NULL, '2017-10-01 22:32:12', NULL),
(7, 5, 'Dr', 200.00, 'test', NULL, '2017-10-01 22:49:48', NULL),
(8, 1, 'Dr', 85.85, 'hello', NULL, '2017-10-01 22:50:06', '2017-10-02 09:10:59'),
(9, 7, 'Dr', 123.00, 'ok', NULL, '2017-10-01 23:50:42', '2017-10-02 09:09:45'),
(13, 1, 'Cr', 100.00, 'jama karay', NULL, '2017-10-02 01:08:09', NULL),
(14, 4, 'Dr', 562.00, 'udhar diye bhai', NULL, '2017-10-02 01:26:51', '2017-10-02 09:10:07'),
(15, 7, 'Cr', 50.00, 'hii', NULL, '2017-10-02 03:43:00', NULL),
(16, 1, 'Cr', 123.00, 'hello', NULL, '2017-10-02 04:01:39', NULL),
(17, 1, 'Dr', 4.00, 'hello hii', NULL, '2017-10-02 04:04:31', '2017-10-02 09:35:07'),
(18, 4, 'Dr', 58.00, 'hh', NULL, '2017-10-02 04:11:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state` varchar(64) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `zip` varchar(32) DEFAULT NULL,
  `comment` text,
  `profile_image` varchar(255) DEFAULT NULL,
  `activation_sent_time` varchar(255) DEFAULT NULL,
  `forgot_password_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`user_id`, `first_name`, `last_name`, `city`, `state`, `country_id`, `zip`, `comment`, `profile_image`, `activation_sent_time`, `forgot_password_code`) VALUES
(3, 'Girish', 'Jangid', 'Jaipur', 'Rajasthan', NULL, '302018', 'Loading Time: Base Classes 0.0170\r\nController Execution Time ( Users / Add ) 0.0260\r\nTotal Execution Time 0.0450 GET DATA\r\nNo GET data exists MEMORY USAGE\r\n2,139,096 bytes POST DATA\r\nNo POST data exists URI STRING\r\nadmin/users/add CLASS/METHOD\r\nusers/add', '20141117_124457.jpg', NULL, '1444043489'),
(4, 'prv[removed]alert&amp;amp;#40;1&amp;amp;#41;;[removed]', 'Jangid', 'Jaipur', 'Rajasthan', NULL, '302018', 'password', NULL, NULL, NULL),
(5, 'laxya', 'j', 'Jaipur', 'ff', NULL, '302018', 'ddf', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '1' COMMENT '#1: front, #2: admin, #3: sub-admin',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `role`, `is_deleted`, `last_login`, `created`, `updated`, `status`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$11$sqe.oIo4YXUsjZWyMaNFJec1p1GrmeBpIa9J2g/PFfSOJYoOVuaPG', 'sqe+oIo4YXUsjZWyMaNFJq2WfLoN1w==', 2, 0, '2015-10-19 16:49:08', '2015-09-09 00:00:00', '2015-09-09 23:15:33', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `last_activity_idx` (`timestamp`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD UNIQUE KEY `uinx_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
