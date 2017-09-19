-- CIFullCalendar v2 SQL Dump
-- version 2.6.5.0
-- https://www.cifullcalendar.com/v2
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2017 at 12:14 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apps_calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `ic_captcha`
--

CREATE TABLE IF NOT EXISTS `ic_captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `word` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ic_captcha`
--

INSERT INTO `ic_captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(22, 1472071845, '::1', '91882193'),
(23, 1472071848, '::1', '27489846');

-- --------------------------------------------------------

--
-- Table structure for table `ic_category`
--

CREATE TABLE IF NOT EXISTS `ic_category` (
  `category_id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_desc` text NOT NULL,
  `backgroundColor` varchar(11) NOT NULL,
  `borderColor` varchar(11) NOT NULL,
  `textColor` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_category`
--

INSERT INTO `ic_category` (`category_id`, `username`, `category_name`, `category_desc`, `backgroundColor`, `borderColor`, `textColor`) VALUES
(16, 'user', 'Sports', 'Sporting activities', '#db044f', '#ffffff', '#ffffff'),
(17, 'admin', 'Meeting', 'All my business meeting', '#73db04', '#ffffff', '#ffffff'),
(28, 'admin', 'Hours', 'Daily hours', '#05b0dc', '#ffffff', '#ffffff'),
(31, 'admin', 'Activities', 'Sporting activities', '#0335db', '#ffffff', '#ffffff'),
(34, 'user', 'Meeting', 'Business Meeting', '#2fdb04', '#ffffff', '#ffffff'),
(35, 'user', 'Installations', 'Building installations', '#dba204', '#ff0000', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `ic_events`
--

CREATE TABLE IF NOT EXISTS `ic_events` (
  `eid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
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
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_events`
--

INSERT INTO `ic_events` (`eid`, `gid`, `id`, `category`, `username`, `title`, `backgroundColor`, `borderColor`, `textColor`, `description`, `start`, `end`, `url`, `allDay`, `rendering`, `overlap`, `recurdays`, `recurend`, `location`, `latitude`, `longitude`, `filename`, `pubDate`) VALUES
(1, 0, 14802684, 17, 'admin', 'adadasd asd adasd asd', '#73db04', '#ffffff', '#ffffff', '', '2016-09-22 00:00:00', '2016-09-24 00:01:00', '', 'true', '', 'true', 0, '0000-00-00', '', 18.473790323586805, -77.92278243655392, '', '2016-09-08 19:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `ic_eventsources`
--

CREATE TABLE IF NOT EXISTS `ic_eventsources` (
  `source_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `source_name` varchar(90) NOT NULL,
  `source_url` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_eventsources`
--

INSERT INTO `ic_eventsources` (`source_id`, `username`, `source_name`, `source_url`) VALUES
(7, 'user', 'Canadian Holidays', 'canadian__en@holiday.calendar.google.com'),
(8, 'admin', 'JM Holidays', 'http://www.google.com/calendar/feeds/jm__en@holiday.calendar.google.com/public/basic'),
(9, 'admin', 'USA Holidays', 'usa__en@holiday.calendar.google.com'),
(10, 'user', 'Jamaican Holidays', 'jm__en@holiday.calendar.google.com'),
(11, 'user', 'Shared GCal', 'necb6q98eqdql2oa0qnl6delig@group.calendar.google.com'),
(12, 'admin', 'Canadian Holidays', 'canadian__en@holiday.calendar.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `ic_eventsqueues`
--

CREATE TABLE IF NOT EXISTS `ic_eventsqueues` (
  `eid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
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
(2, 'members', 'General User');

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
  `markers_address` varchar(255) NOT NULL,
  `markers_lat` double NOT NULL,
  `markers_lng` double NOT NULL,
  `markers_url` varchar(110) NOT NULL,
  `markers_desc` text NOT NULL,
  `pubDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_markers`
--

INSERT INTO `ic_markers` (`markers_id`, `markers_category_id`, `event_id`, `username`, `markers_name`, `markers_logo`, `markers_address`, `markers_lat`, `markers_lng`, `markers_url`, `markers_desc`, `pubDate`) VALUES
(1, 17, 14802684, 'admin', 'adadasd asd adasd asd', 'pin2.png', '', 18.473790323586805, -77.92278243655392, '', '', '2016-09-08 19:51:13');

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
  `meta_description` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `access` int(3) NOT NULL,
  `pubdates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ic_pages`
--

INSERT INTO `ic_pages` (`id`, `uname`, `title`, `seo`, `content`, `meta_keywords`, `meta_description`, `access`, `pubdates`) VALUES
(5, 'admin', 'Members page', 'members-page', '<p>Members page</p>', 'cifullcalendar,scheduler', 'CIFullCalendar is a responsive web application that gives you the “Super Saiyan Fusion” power of organizing, planning, grouping and sharing your event', 2, '2016-03-29 20:01:10'),
(6, 'admin', 'public page', 'public-page', '<p>Hi public</p>', 'cifullcalendar,scheduler', 'CIFullCalendar is a responsive web application that gives you the “Super Saiyan Fusion” power of organizing, planning, grouping and sharing your event', 0, '2016-03-29 20:00:54'),
(7, 'admin', 'admin page', 'admin-page', 'this is administrator page', 'cifullcalendar,scheduler', 'CIFullCalendar is a responsive web application that gives you the “Super Saiyan Fusion” power of organizing, planning, grouping and sharing your event', 1, '2016-03-29 20:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `ic_session`
--

CREATE TABLE IF NOT EXISTS `ic_session` (
  `session_id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(150) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `ic_setting`
--

CREATE TABLE IF NOT EXISTS `ic_setting` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(2048) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ic_setting`
--

INSERT INTO `ic_setting` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'CIFullCalendar v2'),
(2, 'site_logo', 'logo.png'),
(3, 'site_email', 'andre@sirdre.com'),
(4, 'site_timezone', 'America/Jamaica'),
(5, 'site_language', 'en'),
(6, 'site_latitude', '18.473790323586805'),
(7, 'site_longitude', '-77.92278243655392'),
(8, 'meta_description', 'CIFullCalendar v2 is a server-side dynamic web application that is responsive to any layout of a viewing screen. The “Super Saiyan Fusion” power of CIFullCalendar allows users to organize, plan and share events to everyone.'),
(9, 'meta_keywords', 'cifullcalendar, agenda, meeting, personal organizer, fullcalendar, codeigniter, jquery, scheduler, cms, maps, location'),
(10, 'current_theme', 'bootlaces'),
(11, 'captcha_verification', '1'),
(12, 'debug', '1'),
(13, 'profile_max_upload_width', '1200'),
(14, 'profile_max_upload_height', '1200'),
(15, 'profile_max_upload_filesize', '25000'),
(16, 'profile_allowed_extensions', 'gif|jpg|png'),
(17, 'attach_max_size', '150096'),
(18, 'attach_allowed_extension', 'gif|jpg|png|docx|pptx|ppt|xls|accdb|psd|txt|pdf|zip|ics'),
(19, 'sync_max_size', '4096'),
(20, 'sync_allowed_extension', 'ics|ical'),
(21, 'sync_path_location', './assets/ics/'),
(22, 'cal_defaultview', 'list'),
(23, 'cal_header_left', 'month,agendaWeek,agendaDay,list'),
(24, 'cal_header_center', 'title'),
(25, 'cal_header_right', 'prev,next,today'),
(26, 'cal_editable', 'true'),
(27, 'cal_isrtl', 'false'),
(28, 'cal_weeknumbers', 'false'),
(29, 'cal_eventlimit', 'true'),
(30, 'cal_alldayslot', 'true'),
(31, 'cal_hiddendays', '-1'),
(32, 'cal_slotduration', '00:30:00'),
(34, 'cal_firstday', '0'),
(36, 'cal_businessdays', ''),
(37, 'cal_businessstart', ''),
(38, 'cal_businessend', ''),
(39, 'cal_aspectratio', '1.35'),
(40, 'cal_slotlabeling', 'true'),
(41, 'cal_slotlabelformat', 'hh:mm a'),
(42, 'cal_mintime', '00:00:00'),
(43, 'cal_maxtime', '24:00:00'),
(44, 'current_version', '2.6.5.0'),
(45, 'cal_apikey', 'AIzaSyC_8gKr-UIdbPGxnG5w2vf5cKnrfGlyFGA');

-- --------------------------------------------------------

--
-- Table structure for table `ic_tasks`
--

CREATE TABLE IF NOT EXISTS `ic_tasks` (
  `task_id` int(10) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `position` int(5) NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `code` int(10) unsigned NOT NULL,
  `status` tinyint(4) unsigned NOT NULL,
  `priority` tinyint(4) unsigned NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `filename` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_tasks`
--

INSERT INTO `ic_tasks` (`task_id`, `event_id`, `position`, `parent_id`, `user_id`, `code`, `status`, `priority`, `title`, `description`, `filename`, `date_created`) VALUES
(1, 3928147, 2, NULL, 1, 1, 2, 2, 'test run', '', '', '2016-04-04 19:01:53'),
(2, 3708916, 3, NULL, 1, 0, 1, 1, 'test', '', '', '2016-04-04 19:16:38'),
(3, 5796018, 4, 0, 1, 0, 1, 2, 'My new Task', '', '', '2016-04-07 16:49:33'),
(4, 1907624, 1, NULL, 1, 1, 1, 1, 'Another Tasks', 'Hello World', '', '2016-04-07 17:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `ic_tasks_logs`
--

CREATE TABLE IF NOT EXISTS `ic_tasks_logs` (
  `log_id` int(10) unsigned NOT NULL,
  `task_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_finished` datetime DEFAULT NULL,
  `duration` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'registration', 'Registration successful', '<div style="height: 2px; background-color: #535353;"></div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">Thanks for joining {SITE_NAME}. The following details below is your login information. Please keep in mind this information is sensitive.<br>To open your {SITE_NAME} homepage, please follow this link:<br><big><b><a href="{SITE_URL}">{SITE_NAME} Account!</a></b></big><br>Link doesn''t work? Copy the following link to your browser address bar:<br><a href="{SITE_URL}">{SITE_URL}</a><br>Your username: {USERNAME}<br>Your email address: {EMAIL}<br>Your password: {PASSWORD}<p>Enjoy!<br>{SITE_NAME}</p></div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 18:04:58'),
(2, 'notify_message', 'Notification Message', '<div style="height: 2px; background-color: #535353;"></div> <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hi {RECIPIENT},</p><p>You have received a notification: </p><blockquote>{MESSAGE}</blockquote><br><big><b><a href="{SITE_URL}">Go to Account</a></b></big><br><br>Regards<br>{SITE_NAME}</div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:18:19'),
(3, 'change_email', 'Change Email', '<div style="height: 2px; background-color: #535353;"></div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You have changed your email address for {SITE_NAME}.<br>Follow this link to confirm your new email address:<br><big><b><a href="{KEY_URL}">Confirm your new email</a></b></big><br>Copy the following link to your browser address bar if the link above did not work:<br><a href="{KEY_URL}">{KEY_URL}</a><br><br>Your new email address: {NEW_EMAIL}<br><br>You received this email, because it was requested by a <a href="{SITE_URL}">{SITE_NAME}</a> user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.<br>Thank you,<br>{SITE_NAME}</div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:10:42'),
(4, 'reset_email', 'New Email', '<div style="height: 2px; background-color: #535353;"></div><div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You have changed your email address for {SITE_NAME}.<br>Follow this link to confirm your new email address:<br><big><b><a href="{KEY_URL}">Confirm your new email</a></b></big><br>Copy the following link to your browser address bar if the link above did not work:<br><a href="{KEY_URL}">{KEY_URL}</a><br><br>Your new email address: {NEW_EMAIL}<br><br>You received this email, because it was requested by a <a href="{SITE_URL}">{SITE_NAME}</a> user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.<br>Thank you,<br>{SITE_NAME}</div><div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:19:11'),
(5, 'forgot_password', 'Forgot Password', '<div style="height: 2px; background-color: #535353;"></div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You received this email because it was requested by a member of <a href="{SITE_URL}">{SITE_NAME}</a>.<p>To create a new password, click the follow link below:<br><big><b><a href="{KEY_URL}">Change password</a></b></big><br> If the link doesn''t work simply copy the following link to your browser address bar:<br><a href="{KEY_URL}">{KEY_URL}</a></p>\r\n<p></p>\r\n<p>If you DID NOT request a new password. Please ignore this email or contact your administrator.</p>\r\n<br>Thank you,<br>{SITE_NAME}</div>\r\n</div>\r\n<div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:18:08'),
(6, 'reset_password', 'New Password', '<div style="height: 2px; background-color: #535353;"></div>\r\n<div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;">You received this email because it was requested by a member of <a href="{SITE_URL}">{SITE_NAME}</a>.<p>To create a new password, click the follow link below:<br><big><b><a href="{KEY_URL}">Change password</a></b></big><br> If the link doesn''t work simply copy the following link to your browser address bar:<br><a href="{KEY_URL}">{KEY_URL}</a></p>\r\n<p></p>\r\n<p>If you DID NOT request a new password. Please ignore this email or contact your administrator.</p>\r\n<br>Thank you,<br>{SITE_NAME}</div>\r\n</div>\r\n<div style="height: 2px; background-color: #535353;"></div>', '2015-10-22 19:20:31');

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
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `lang` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `cal_timezone` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'America/Jamaica',
  `cal_defaultview` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'month',
  `cal_header_left` varchar(95) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'month,agendaWeek,basicDay,agendaList',
  `cal_header_center` varchar(95) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'title',
  `cal_header_right` varchar(95) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'prev,next,today',
  `cal_editable` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_firstday` int(2) NOT NULL DEFAULT '0',
  `cal_businessstart` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cal_businessend` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cal_businessdays` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cal_hiddendays` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '-1',
  `cal_isrtl` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `cal_weeknumbers` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_eventlimit` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_alldayslot` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `cal_slotduration` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '00:30:00',
  `cal_slotlabeling` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `cal_slotlabelformat` varchar(11) NOT NULL DEFAULT 'hh:mm a',
  `cal_aspectratio` float NOT NULL DEFAULT '1.45',
  `cal_mintime` varchar(9) NOT NULL DEFAULT '00:00:00',
  `cal_maxtime` varchar(9) NOT NULL DEFAULT '24:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_users`
--

INSERT INTO `ic_users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `last_page`, `active`, `first_name`, `last_name`, `company`, `phone`, `image`, `lang`, `cal_timezone`, `cal_defaultview`, `cal_header_left`, `cal_header_center`, `cal_header_right`, `cal_editable`, `cal_firstday`, `cal_businessstart`, `cal_businessend`, `cal_businessdays`, `cal_hiddendays`, `cal_isrtl`, `cal_weeknumbers`, `cal_eventlimit`, `cal_alldayslot`, `cal_slotduration`, `cal_slotlabeling`, `cal_slotlabelformat`, `cal_aspectratio`, `cal_mintime`, `cal_maxtime`) VALUES
(1, '::1', 'admin', '$2y$08$TU258r82.WdLqfrQhARwm.Y.rRhdjcdo5cYKbkJq6Mv.US.0lEbg6', '', 'admin@sirdre.com', '', 'QPArQN7hvJoccD9NddTMie1b50fc5b566dfeb588', 1451852903, '186VHRF4AOapr/JRsdz8gO', 1268889823, 1476641708, 'admin', 1, 'Admin', 'istrator', 'sirdre', '9799805200', '1414029756_internt_web_technology-13-256_png_589403_png_30772115.png', 'en', 'America/Jamaica', 'month', 'month,agendaWeek,agendaDay,agendaList', 'title', 'prev,next,today', 'true', 1, '', '', '', '-1', 'false', 'true', 'true', 'true', '01:30:00', 'true', 'hh:mm a', 2.45, '00:00:00', '24:00:00'),
(8, '::1', 'user', '$2y$08$rinqEuqhx1hoYCllYayCLO0YS6MYhTmxqKSSsM.OSLy15wYoS863q', NULL, 'user@sirdre.com', NULL, NULL, NULL, NULL, 1452912693, 1459699662, 'profile', 1, 'John', 'Smith', '', '', 'default.png', 'en', 'America/Jamaica', 'month', 'month,agendaWeek,basicDay,agendaList', 'title', 'prev,next,today', 'true', 0, '', '', '', '-1', 'false', 'true', 'true', 'true', '00:30:00', 'false', 'hh:mm a', 2.45, '00:00:00', '24:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ic_users_groups`
--

CREATE TABLE IF NOT EXISTS `ic_users_groups` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ic_users_groups`
--

INSERT INTO `ic_users_groups` (`id`, `user_id`, `group_id`) VALUES
(45, 1, 1),
(41, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ic_users_tasks`
--

CREATE TABLE IF NOT EXISTS `ic_users_tasks` (
  `user_id` int(10) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ic_users_tasks`
--

INSERT INTO `ic_users_tasks` (`user_id`, `event_id`, `date_created`) VALUES
(1, 23470859, '2014-09-02 11:52:34');

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
-- Indexes for table `ic_session`
--
ALTER TABLE `ic_session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `ci_sessions_timestamp` (`last_activity`);

--
-- Indexes for table `ic_setting`
--
ALTER TABLE `ic_setting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ic_tasks`
--
ALTER TABLE `ic_tasks`
  ADD PRIMARY KEY (`task_id`,`user_id`) USING BTREE,
  ADD KEY `status` (`event_id`,`status`),
  ADD KEY `parent` (`parent_id`);

--
-- Indexes for table `ic_tasks_logs`
--
ALTER TABLE `ic_tasks_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `ic_tasks` (`task_id`,`status`) USING BTREE,
  ADD KEY `ic_users` (`user_id`) USING BTREE;

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
-- Indexes for table `ic_users_tasks`
--
ALTER TABLE `ic_users_tasks`
  ADD PRIMARY KEY (`user_id`,`event_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ic_captcha`
--
ALTER TABLE `ic_captcha`
  MODIFY `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ic_category`
--
ALTER TABLE `ic_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `ic_events`
--
ALTER TABLE `ic_events`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ic_eventsources`
--
ALTER TABLE `ic_eventsources`
  MODIFY `source_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
  MODIFY `markers_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ic_pages`
--
ALTER TABLE `ic_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ic_setting`
--
ALTER TABLE `ic_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `ic_tasks`
--
ALTER TABLE `ic_tasks`
  MODIFY `task_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ic_tasks_logs`
--
ALTER TABLE `ic_tasks_logs`
  MODIFY `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
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
