-- CIFullCalendar v3 SQL Dump
-- version 3.6.1.0
-- http://www.cifullcalendar.com/v3
--
-- Host: localhost
-- Generation Time: Mar 21, 2018 at 06:01 PM
-- Server version: 5.6.30
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cifullcalendar_v3`
--

-- --------------------------------------------------------

--
-- Table structure for table `ic_captcha`
--

CREATE TABLE IF NOT EXISTS `ic_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL,
  `captcha_time` int(10) NOT NULL,
  `ip_address` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_captcha`
--

INSERT INTO `ic_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(16, 1494021436, '::1', '82204924');

-- --------------------------------------------------------

--
-- Table structure for table `ic_category`
--

CREATE TABLE IF NOT EXISTS `ic_category` (
  `category_id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_desc` text NOT NULL,
  `backgroundColor` varchar(11) NOT NULL,
  `borderColor` varchar(11) NOT NULL,
  `textColor` varchar(11) NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_category`
--

INSERT INTO `ic_category` (`category_id`, `gid`, `username`, `category_name`, `category_desc`, `backgroundColor`, `borderColor`, `textColor`, `pubDate`) VALUES
(31, 2, 'admin', 'Daily Activities', 'Daily activities', '#14c746', '#ffffff', '#ffffff', '2016-12-08 21:22:54'),
(32, 0, 'admin', 'Business', 'Business Activities', '#119908', '#ffffff', '#ffffff', '2017-01-08 20:04:02'),
(33, 2, 'admin', 'Sports', 'Sports Activities', '#9704db', '#ffffff', '#ffffff', '2017-05-01 19:41:29'),
(34, -1, 'admin', 'Public Events', 'Public Events', '#db045a', '#ffffff', '#ffffff', '2017-05-05 16:27:27');

-- --------------------------------------------------------

--
-- Table structure for table `ic_events`
--

CREATE TABLE IF NOT EXISTS `ic_events` (
  `eid` int(16) NOT NULL,
  `gid` int(16) NOT NULL,
  `rid` int(16) NOT NULL,
  `id` int(16) NOT NULL,
  `category` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `title` text,
  `backgroundColor` varchar(11) NOT NULL,
  `borderColor` varchar(11) NOT NULL,
  `textColor` varchar(11) NOT NULL,
  `description` text,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `url` varchar(255) NOT NULL,
  `allDay` enum('true','false') NOT NULL DEFAULT 'true',
  `rendering` varchar(10) NOT NULL,
  `constrainting` varchar(14) NOT NULL,
  `overlap` enum('true','false') NOT NULL DEFAULT 'true',
  `recurdays` int(4) NOT NULL,
  `recurend` date NOT NULL,
  `reminder` tinyint(1) NOT NULL DEFAULT '0',
  `location` varchar(255) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `filename` varchar(250) NOT NULL,
  `filesize` float NOT NULL,
  `fileblob` mediumblob NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_eventsources`
--

CREATE TABLE IF NOT EXISTS `ic_eventsources` (
  `source_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `source_name` varchar(90) NOT NULL,
  `source_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_eventsources`
--

INSERT INTO `ic_eventsources` (`source_id`, `username`, `source_name`, `source_url`) VALUES
(4, 'admin', 'JM Holidays', 'jm__en@holiday.calendar.google.com'),
(5, 'admin', 'USA Holidays', 'usa__en@holiday.calendar.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `ic_eventsqueues`
--

CREATE TABLE IF NOT EXISTS `ic_eventsqueues` (
  `eid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `resourceId` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `title` text,
  `backgroundColor` varchar(11) NOT NULL,
  `borderColor` varchar(11) NOT NULL,
  `textColor` varchar(11) NOT NULL,
  `description` text,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `url` varchar(255) NOT NULL,
  `allDay` enum('true','false') NOT NULL DEFAULT 'true',
  `rendering` varchar(10) NOT NULL,
  `overlap` enum('true','false') NOT NULL DEFAULT 'true',
  `recurdays` int(4) NOT NULL,
  `recurend` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `filename` varchar(250) NOT NULL,
  `filesize` float NOT NULL,
  `fileblob` mediumblob NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_groups`
--

CREATE TABLE IF NOT EXISTS `ic_groups` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_groups`
--

INSERT INTO `ic_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'Members');

-- --------------------------------------------------------

--
-- Table structure for table `ic_login_attempts`
--

CREATE TABLE IF NOT EXISTS `ic_login_attempts` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_markers`
--

CREATE TABLE IF NOT EXISTS `ic_markers` (
  `markers_id` int(11) NOT NULL,
  `markers_category_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `markers_name` varchar(45) NOT NULL,
  `markers_logo` varchar(80) NOT NULL,
  `markers_address` varchar(255) DEFAULT '',
  `markers_lat` double NOT NULL,
  `markers_lng` double NOT NULL,
  `markers_url` varchar(110) NOT NULL,
  `markers_desc` text NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_pages`
--

CREATE TABLE IF NOT EXISTS `ic_pages` (
  `id` int(11) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `seo` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `access` int(3) NOT NULL,
  `pubdates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_pages`
--

INSERT INTO `ic_pages` (`id`, `uname`, `title`, `seo`, `content`, `meta_keywords`, `meta_description`, `access`, `pubdates`) VALUES
(6, 'admin', 'Thank you for your support and purchase.', 'thank-you-for-your-support-and-purchase', '<p><span style="color: rgb(34, 34, 34); font-family: &quot;Helvetica Neue&quot;, Arial, Helvetica, sans-serif; font-size: 12.8px;">Thank you for your support and purchase.</span></p><p><span style="color: rgb(34, 34, 34); font-family: &quot;Helvetica Neue&quot;, Arial, Helvetica, sans-serif; font-size: 12.8px;">I’d be glad to help you if you have any questions relating to this web application. No guarantees, but I’ll do my best to assist. </span></p><p><span style="color: rgb(34, 34, 34); font-family: &quot;Helvetica Neue&quot;, Arial, Helvetica, sans-serif; font-size: 12.8px;">If you have a more general question relating to the web application on sirdre.com, you might consider visiting the forums and asking your question in the “<b>Item Discussion</b>” section.</span><br></p>', 'cifullcalendar,scheduler', 'CIFullCalendar is a responsive web application that gives you the “Super Saiyan Fusion” power of organizing, planning, grouping and sharing your events.', 1, '2017-04-04 00:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `ic_sessions`
--

CREATE TABLE IF NOT EXISTS `ic_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(150) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ic_setting`
--

CREATE TABLE IF NOT EXISTS `ic_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(2048) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ic_setting`
--

INSERT INTO `ic_setting` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'CIFullcalendar'),
(2, 'site_logo', 'logo.png'),
(3, 'site_email', 'andre@sirdre.com'),
(4, 'site_timezone', 'America/Jamaica'),
(5, 'site_language', 'en'),
(6, 'site_latitude', '18.473790323586805'),
(7, 'site_longitude', '-77.92278243655392'),
(8, 'meta_description', 'CIFullCalendar is a server-side dynamic web application that is responsive to any layout of a viewing screen. The “Super Saiyan Fusion” power of CIFullCalendar allows users to organize, plan and share events to everyone.'),
(9, 'meta_keywords', 'cifullcalendar, agenda, meeting, personal organizer, fullcalendar, codeigniter, jquery, scheduler, cms, maps, location'),
(10, 'current_theme', 'bootlaces'),
(11, 'captcha_verification', '1'),
(12, 'debug', '1'),
(13, 'profile_max_upload_width', '1200'),
(14, 'profile_max_upload_height', '1200'),
(15, 'profile_max_upload_filesize', '25000'),
(16, 'profile_allowed_extensions', 'gif|jpg|png'),
(17, 'attach_max_size', '190096'),
(18, 'attach_allowed_extension', 'gif|jpg|png|docx|pptx|ppt|xls|accdb|psd|txt|pdf|zip|ics'),
(19, 'sync_max_size', '4096'),
(20, 'sync_allowed_extension', 'ics|ical'),
(21, 'sync_path_location', './assets/ics/'),
(22, 'cal_defaultview', 'month'),
(23, 'cal_header_left', 'month,agendaWeek,basicDay,listDay'),
(24, 'cal_header_center', 'title'),
(25, 'cal_header_right', 'prev,next,today'),
(26, 'cal_editable', 'true'),
(27, 'cal_isrtl', 'false'),
(28, 'cal_weeknumbers', 'true'),
(29, 'cal_weeknumberswithindays', 'true'),
(30, 'cal_eventlimit', 'true'),
(31, 'cal_alldayslot', 'true'),
(32, 'cal_hiddendays', ''),
(33, 'cal_slotduration', '01:00:00'),
(34, 'cal_firstday', '0'),
(35, 'cal_businessdays', '1,2,3,4,5'),
(36, 'cal_businessstart', '09:50'),
(37, 'cal_businessend', '17:30'),
(38, 'cal_aspectratio', '1.35'),
(40, 'cal_slotlabeling', 'false'),
(41, 'cal_slotlabelformat', 'hh:mm a'),
(42, 'cal_mintime', '00:00:00'),
(43, 'cal_maxtime', '24:00:00'),
(45, 'current_version', '3.6.1.0'),
(46, 'cal_apikey', ''),
(47, 'cal_schedulerkey', 'GPL-My-Project-Is-Open-Source');

-- --------------------------------------------------------

--
-- Table structure for table `ic_templates`
--

CREATE TABLE IF NOT EXISTS `ic_templates` (
  `id` int(11) NOT NULL,
  `types` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `pubdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ic_templates`
--

INSERT INTO `ic_templates` (`id`, `types`, `subject`, `body`, `pubdate`) VALUES
(1, 'registration', 'Registration successful', '<div style="height: 2px; background-color: #535353;"></div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">Thanks for joining {SITE_NAME}. The following details below is your login information. Please keep in mind this information is sensitive.<br>To open your {SITE_NAME} homepage, please follow this link:<br><big><b><a href="{SITE_URL}">{SITE_NAME} Account!</a></b></big><br>Link doesn''t work? Copy the following link to your browser address bar:<br><a href="{SITE_URL}">{SITE_URL}</a><br>Your username: {USERNAME}<br>Your email address: {EMAIL}<br><p>Enjoy!<br>{SITE_NAME}</p>\r\n</div>\r\n<div style="height: 2px; background-color: #535353;"></div>', '2016-06-04 22:14:30'),
(2, 'notify_message', 'Notification Message', '<div style="height: 2px; background-color: #535353;"></div> <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hi {RECIPIENT},</p><p>You have received a notification: </p><blockquote>{MESSAGE}</blockquote><br><big><b><a href="{SITE_URL}">Go to Account</a></b></big><br><br>Regards<br>{SITE_NAME}</div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:18:19'),
(3, 'change_email', 'Change Email', '<div style="height: 2px; background-color: #535353;"></div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You have changed your email address for {SITE_NAME}.<br>Follow this link to confirm your new email address:<br><big><b><a href="{KEY_URL}">Confirm your new email</a></b></big><br>Copy the following link to your browser address bar if the link above did not work:<br><a href="{KEY_URL}">{KEY_URL}</a><br><br>Your new email address: {NEW_EMAIL}<br><br>You received this email, because it was requested.&nbsp;If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email.<br><br>Thank you,<br>{SITE_NAME}</div>\r\n<div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:53:24'),
(4, 'reset_email', 'New Email', '<div style="height: 2px; background-color: #535353;"></div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>You have changed your email from&nbsp;<span style="line-height: 18.5714px;">{EMAIL} to&nbsp;</span><span style="line-height: 18.5714px;">{NEW_EMAIL} successfully</span><span style="line-height: 1.42857;">.</span><span style="line-height: 1.42857;">&nbsp;</span></p><br>Thank you,<br>{SITE_NAME}</div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:54:13'),
(5, 'forgot_password', 'Forgot Password', '<div style="height: 2px; background-color: #535353;"></div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You received this email because it was requested by a member of <a href="{SITE_URL}">{SITE_NAME}</a>.<p>To create a new password, click the follow link below:<br><big><b><a href="{KEY_URL}">Change password</a></b></big><br> If the link doesn''t work simply copy the following link to your browser address bar:<br><a href="{KEY_URL}">{KEY_URL}</a></p>\r\n<p></p>\r\n<p><span style="line-height: 18.5714px;">You received this email, because it was requested.&nbsp;If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email.</span><br></p>\r\n<br>Thank you,<br>{SITE_NAME}</div>\r\n\r\n<div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:53:53'),
(6, 'reset_password', 'New Password', '<div style="height: 2px; background-color: #535353;"></div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>You have changed your password.<br>Please keep records secure.<br></p>Your username: {USERNAME}<br>Your email address: {EMAIL}<br>Your new password: {NEW_PASSWORD}<br><br>Thank you,<br>{SITE_NAME}</div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `ic_users`
--

CREATE TABLE IF NOT EXISTS `ic_users` (
  `id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `last_page` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(250) NOT NULL DEFAULT '',
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `lang` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `cal_timezone` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'US/Central',
  `cal_defaultview` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'month',
  `cal_header_left` varchar(95) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'month,timelineWeek,timelineDay,agendaList,list',
  `cal_header_center` varchar(95) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'title',
  `cal_header_right` varchar(95) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'prev,next,today',
  `cal_editable` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_firstday` int(2) NOT NULL DEFAULT '0',
  `cal_businessstart` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cal_businessend` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cal_businessdays` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cal_hiddendays` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '-1',
  `cal_isrtl` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `cal_weeknumberswithindays` enum('true','false') NOT NULL DEFAULT 'false',
  `cal_weeknumbers` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_eventlimit` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_alldayslot` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_slotduration` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '01:00:00',
  `cal_slotlabeling` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `cal_slotlabelformat` varchar(11) NOT NULL DEFAULT 'hh:mm a',
  `cal_aspectratio` varchar(5) NOT NULL DEFAULT 'auto',
  `cal_mintime` varchar(9) NOT NULL DEFAULT '00:00:00',
  `cal_maxtime` varchar(9) NOT NULL DEFAULT '24:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_users`
--

INSERT INTO `ic_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `last_page`, `active`, `first_name`, `last_name`, `address`, `company`, `phone`, `image`, `lang`, `cal_timezone`, `cal_defaultview`, `cal_header_left`, `cal_header_center`, `cal_header_right`, `cal_editable`, `cal_firstday`, `cal_businessstart`, `cal_businessend`, `cal_businessdays`, `cal_hiddendays`, `cal_isrtl`, `cal_weeknumberswithindays`, `cal_weeknumbers`, `cal_eventlimit`, `cal_alldayslot`, `cal_slotduration`, `cal_slotlabeling`, `cal_slotlabelformat`, `cal_aspectratio`, `cal_mintime`, `cal_maxtime`) VALUES
(1, '::1', 'admin', '$2y$07$j/EczsMGm8Pkxk.pePct8uzNwwKUfkPDtTylPiAtLvZyrYjCSY1oi', '', 'admin@sirdre.com', '', 'QPArQN7hvJoccD9NddTMie1b50fc5b566dfeb588', 1451852903, NULL, 1268889823, 1494372876, 'calendar', 1, 'Admin', 'istrator', '', 'sirdre', '9799805200', 'pro_png_18423095_png_86752094_png_18765940.png', 'en', 'America/Los_Angeles', 'agendaDay', 'month,timelineWeek,agendaWeek,basicDay,agendaList,listYear', 'title', 'prevYear,prev,next,nextYear,today', 'true', 1, '08:00', '16:00', '1,2,3,4,5', '-1', 'false', 'false', 'true', 'false', 'true', '01:00:00', 'true', 'hh:mm a', 'auto', '00:00:00', '24:00:00'),
(8, '::1', 'user', '$2y$08$rinqEuqhx1hoYCllYayCLO0YS6MYhTmxqKSSsM.OSLy15wYoS863q', NULL, 'user@sirdre.com', NULL, NULL, NULL, NULL, 1452912693, 1481232211, 'profile', 1, 'John', 'Smith', '12 ave', '', '', 'default.png', 'en', 'US/Central', 'month', 'month,agendaWeek', 'title', 'prev,next,today', 'true', 0, '', '', '', '-1', 'false', 'true', 'true', 'true', 'true', '00:30:00', 'false', 'hh:mm a', '2.45', '00:00:00', '24:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ic_users_groups`
--

CREATE TABLE IF NOT EXISTS `ic_users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_users_groups`
--

INSERT INTO `ic_users_groups` (`id`, `user_id`, `group_id`) VALUES
(88, 1, 1),
(89, 8, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ic_captcha`
--
ALTER TABLE `ic_captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `ic_category`
--
ALTER TABLE `ic_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `ic_events`
--
ALTER TABLE `ic_events`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `ic_eventsources`
--
ALTER TABLE `ic_eventsources`
  ADD PRIMARY KEY (`source_id`),
  ADD UNIQUE KEY `source_id` (`source_id`);

--
-- Indexes for table `ic_eventsqueues`
--
ALTER TABLE `ic_eventsqueues`
  ADD PRIMARY KEY (`eid`),
  ADD UNIQUE KEY `eid` (`eid`);

--
-- Indexes for table `ic_groups`
--
ALTER TABLE `ic_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ic_login_attempts`
--
ALTER TABLE `ic_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ic_markers`
--
ALTER TABLE `ic_markers`
  ADD PRIMARY KEY (`markers_id`),
  ADD UNIQUE KEY `event_id` (`event_id`);

--
-- Indexes for table `ic_pages`
--
ALTER TABLE `ic_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ic_sessions`
--
ALTER TABLE `ic_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `ic_setting`
--
ALTER TABLE `ic_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ic_templates`
--
ALTER TABLE `ic_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ic_users`
--
ALTER TABLE `ic_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ic_users_groups`
--
ALTER TABLE `ic_users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ic_captcha`
--
ALTER TABLE `ic_captcha`
  MODIFY `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ic_category`
--
ALTER TABLE `ic_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `ic_events`
--
ALTER TABLE `ic_events`
  MODIFY `eid` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_eventsources`
--
ALTER TABLE `ic_eventsources`
  MODIFY `source_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ic_eventsqueues`
--
ALTER TABLE `ic_eventsqueues`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_groups`
--
ALTER TABLE `ic_groups`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ic_login_attempts`
--
ALTER TABLE `ic_login_attempts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_markers`
--
ALTER TABLE `ic_markers`
  MODIFY `markers_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ic_pages`
--
ALTER TABLE `ic_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ic_setting`
--
ALTER TABLE `ic_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `ic_templates`
--
ALTER TABLE `ic_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ic_users`
--
ALTER TABLE `ic_users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ic_users_groups`
--
ALTER TABLE `ic_users_groups`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ic_users_groups`
--
ALTER TABLE `ic_users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `ic_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `ic_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
