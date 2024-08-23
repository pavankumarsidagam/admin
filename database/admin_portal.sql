-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 12:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_login_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_date_time` datetime NOT NULL,
  `modify_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_login_id`, `admin_username`, `admin_password`, `last_login`, `status`, `created_date_time`, `modify_date_time`) VALUES
(1, 'pavankumar', 'pavankumar@2001', '2023-12-10 23:37:11', '1', '2023-12-10 16:00:17', '2023-12-10 16:00:17'),
(2, 'ravi', 'ravi7095', '2023-12-13 05:52:13', '1', '2023-12-13 06:51:35', '2023-12-13 06:51:35'),
(3, 'ali_shain', 'ali12345', '2023-12-13 05:53:10', '1', '2023-12-13 06:52:20', '2023-12-13 06:52:20'),
(4, 'hemanth', 'hemanth123', '2023-12-13 05:53:33', '1', '2023-12-13 06:53:14', '2023-12-13 06:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `bootcamp`
--

CREATE TABLE `bootcamp` (
  `bc_id` int(11) NOT NULL,
  `bc_email` varchar(50) NOT NULL,
  `bc_contact` bigint(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bootcamp`
--

INSERT INTO `bootcamp` (`bc_id`, `bc_email`, `bc_contact`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'pavankumar@gmail.com', 9652824478, '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 19:34:16'),
(2, 'mohankumar@gmail.com', 7894561230, '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 19:35:11'),
(3, 'ananthjonnada@gmail.com', 7852489657, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 05:17:11'),
(4, 'pavanimkaena@gmail.com', 5214789621, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 10:07:55'),
(5, 'pavankumar@12345', 0, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 10:07:51'),
(6, 'ssssssssssss', 44, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 10:07:45'),
(7, 'ffffffff', 7574444, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 16:00:39'),
(8, 'ananthjonnada@gmail.comjummmmmmmmmmkkkkkk', 444444444, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:51:44');

-- --------------------------------------------------------

--
-- Table structure for table `counts`
--

CREATE TABLE `counts` (
  `count_id` int(11) NOT NULL,
  `finished_sessions` int(11) NOT NULL,
  `online_enrollment` int(11) NOT NULL,
  `subjects_taught` int(11) NOT NULL,
  `satisfaction_rate` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counts`
--

INSERT INTO `counts` (`count_id`, `finished_sessions`, `online_enrollment`, `subjects_taught`, `satisfaction_rate`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 367, 254, 864, 96, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 23:59:30'),
(2, 1524, 5347, 220, 100, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 23:59:09'),
(3, 2204, 204, 1234, 100, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 23:59:48');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` varchar(100) NOT NULL,
  `course_image` varchar(100) NOT NULL,
  `course_share_image` varchar(100) NOT NULL,
  `course_banner_image` varchar(50) NOT NULL,
  `course_share_desc` longtext NOT NULL,
  `related_courses` varchar(50) NOT NULL,
  `iframe_url` varchar(500) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `lessions` int(11) NOT NULL,
  `students` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `course_image`, `course_share_image`, `course_banner_image`, `course_share_desc`, `related_courses`, `iframe_url`, `instructor_id`, `lessions`, `students`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(18, 'Full Stack Essentials', 'This advanced-level', '18.png', '18.png', '18.png', 'This advanced-level Digital Marketing course is tailored for individuals seeking to deepen their expertise in the ever-evolving landscape of digital marketing. Designed to refine skills and strategies, this program delves into sophisticated techniques and emerging trends to propel marketing endeavors to new heights.', 'Full Stack Advanced', 'Courses/fullStackEssentials', 1, 10, 11, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:41:35'),
(19, 'Full Stack Advanced', 'This course covers concepts in React Native for developing Hybrid App, ReactJS for developing web ap', '19.png', '19.png', '19.png', 'This course covers concepts in React Native for developing Hybrid App, ReactJS for developing web application, NodeJS for developing server side web applications and MySQL for storing data in database.1111', 'React Native,Digital market Essentials', 'Courses/fullStackAdvanced', 2, 11, 11, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:25:11'),
(20, 'Android Native Developer', 'We built this curriculum for aspiring Android builders who\'re new to programming to make certain tha', '20.png', '20.png', '20.png', 'We built this curriculum for aspiring Android builders who\'re new to programming to make certain that you get the actual-world abilities you need to know how to build and accelerate your journey closer to becoming a professional Android Developer.', 'UI Designer,Digital market Essentials', 'Courses/AndroidNativeDeveloper', 1, 10, 10, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:46:03'),
(21, 'Node Expert', 'This Node JS training permits you to build network applications fast and efficiently using JavaScrip', '21.png', '21.png', '21.png', 'This Node JS training permits you to build network applications fast and efficiently using JavaScript. This program is designed to assist developers to apprehend and build web applications with the help of JavaScript. This helps you gain an in-depth knowledge of concepts such as Express.js, Node Packet Manager (NPM), shrink-wrap, NPM Vet, REST, Express.js with MongoDB, and SQLite CRUD operations. This Node JS training focuses on the essential concepts of Node JS and provides hands-on experience in building an HTTP server.', 'UI Designer,Digital market Essentials', 'Courses/NodeExpert', 3, 10, 11, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:45:25'),
(22, 'UI Designer', 'In this program, you\'ll study industry-widespread principles and methods for developing successful u', '22.png', '22.png', '22.png', 'In this program, you\'ll study industry-widespread principles and methods for developing successful user interfaces (UIs). Upon finishing this program, you may have fluency with the user research, prototyping and assessment strategies essential for developing intuitive interfaces that facilitate suitable person stories. you will also have demonstrated this fluency thru an in-depth Capstone Project that can be shown to potential employers in the speedy-growing subject of UI layout.', 'Android Native Developer', 'Courses/uiDesigner', 3, 10, 11, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:44:36'),
(23, 'React Native', 'React Native allows you to build native mobile apps using JavaScript and React. ', '23.png', '23.png', '23.png', 'React Native allows you to build native mobile apps using JavaScript and React. In this project-based course, learn how to use React Native to build production-ready, native mobile apps on both iOS and Android. To help acquaint you with the fundamentals of React Native, we take a hands-on approach, showing how to build applications from scratch.', 'Digital market Essentials,UI Designer', 'Courses/reactNative', 1, 10, 11, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:31:30'),
(24, 'Digital market Essentials', 'This comprehensive Digital Marketing course equips participants with the essential skills and knowle', '24.png', '24.png', '24.png', 'This comprehensive Digital Marketing course equips participants with the essential skills and knowledge needed to thrive in the dynamic world of online marketing. Through a blend of theoretical concepts and practical applications, this program covers a wide spectrum of topics integral to modern digital marketing strategies.', 'Full Stack Advanced,React Native', 'Courses/DigitalmarketEssentials', 1, 10, 11, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:30:59'),
(25, 'Digital market Advanced', 'This advanced-level Digital Marketing course is tailored for individuals seeking to deepen their exp', '25.png', '25.png', '25.png', 'This advanced-level Digital Marketing course is tailored for individuals seeking to deepen their expertise in the ever-evolving landscape of digital marketing. Designed to refine skills and strategies, this program delves into sophisticated techniques and emerging trends to propel marketing endeavors to new heights.', 'Digital market Essentials,UI Designer', 'Courses/digitalMarketingAdvanced', 2, 10, 0, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 10:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `courses_technologies`
--

CREATE TABLE `courses_technologies` (
  `courses_technologies_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `technology_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_technologies`
--

INSERT INTO `courses_technologies` (`courses_technologies_id`, `course_id`, `technology_id`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(2, 19, 2, '1', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:20:37'),
(3, 20, 1, '0', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:22:53'),
(4, 21, 8, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 10:48:39'),
(5, 22, 11, '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 05:14:58'),
(6, 20, 8, '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 10:48:45'),
(7, 19, 1, '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 05:15:17'),
(8, 20, 9, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:59:45'),
(9, 19, 14, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:59:54'),
(10, 22, 4, '1', 1, 2, '0000-00-00 00:00:00', '2023-12-13 05:54:17'),
(11, 24, 9, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:50:42'),
(12, 19, 4, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-15 09:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_curriculum`
--

CREATE TABLE `course_curriculum` (
  `curriculum_id` int(11) NOT NULL,
  `day_no` varchar(100) NOT NULL,
  `technology_details` varchar(100) NOT NULL,
  `technology_id` int(11) NOT NULL,
  `training_time` varchar(50) NOT NULL,
  `practice_time` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_curriculum`
--

INSERT INTO `course_curriculum` (`curriculum_id`, `day_no`, `technology_details`, `technology_id`, `training_time`, `practice_time`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, '1 day', 'Tags, Introduction of Tables', 14, '1hr', '30min', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 04:48:18'),
(2, '2 day', 'Tables (row span, col span), misc. tags, heading tag(h1,h2....h6)', 14, '1hr', '2hr', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 04:48:34'),
(3, '3 day', 'iframe (embed, Albums-embed, video-embed, maps, Input tag introduction)', 14, '1hr', '2hr', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 10:56:55'),
(4, '4 day', 'Introduction of Java', 4, '1hr', '1hr', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 10:57:40'),
(5, '3 day', '1', 8, '1hr', '2hr', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:45:02'),
(6, 'fffffffffff', 'iframe (embed, Albums-embed, video-embed, maps, Input tag introduction)', 4, '1hr', '2hr', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `currentopening`
--

CREATE TABLE `currentopening` (
  `co_id` int(11) NOT NULL,
  `coursename` varchar(200) NOT NULL,
  `noofopean` int(11) NOT NULL,
  `hiring` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currentopening`
--

INSERT INTO `currentopening` (`co_id`, `coursename`, `noofopean`, `hiring`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'Android Native Developer', 6, 'Vulcan Tech - 3 Openings, Ford - 3 Openings', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:02:57'),
(2, 'UI Designer', 2, 'DreamHyre - 2 Openings', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:04:26'),
(3, 'Node Expert', 10, 'Phenom - 6 Openings , Tech - 4 Openings', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:04:16'),
(4, 'Android Native Developer', 44444, '4444444', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 16:01:45'),
(5, 'Android Native Developer', -12, '4445555', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `about_instructor` longtext NOT NULL,
  `instructor_designation` varchar(100) NOT NULL,
  `instructor_profile_image` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `instructor_name`, `about_instructor`, `instructor_designation`, `instructor_profile_image`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'Mohan K', 'Bringing two years of experience to web and backend development, I specialize in PHP, MySQL, and JavaScript.', 'Full Stack Developer', '1.png', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 09:40:40'),
(2, 'Ravi Teja Y', 'Enthusiast Entrepreneur. Built 3 startups from scratch.', 'Full Stack Developer', '2.png', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 09:41:25'),
(3, 'Venkatesh P', 'have accumulated 3 years of expertise as a Mobile and Web Application Developer.', 'Mobile Developer', '3.png', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 09:42:01'),
(4, 'Dinesh N', 'With two years of expertise in Mobile and Web Application Development, I specialize in React Native and React for seamless app creation. ', 'Mobile Developer', '4.png', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 09:40:57'),
(5, ' Sandeep R', 'With over a 3 years of expertise in the ever-evolving realm of digital marketing,', 'Digital Marketing Manager', '5.png', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-15 09:40:08'),
(11, 'Pavan Kumar', 'hii prends uruke hii chepali anipinchindhi ', 'Hii Prends -just an example.', '11.png', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-15 09:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_social_tags`
--

CREATE TABLE `instructor_social_tags` (
  `instructor_social_tags_id` int(11) NOT NULL,
  `instructor_social_tags_url` varchar(100) NOT NULL,
  `instructor_social_tags_type` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_social_tags`
--

INSERT INTO `instructor_social_tags` (`instructor_social_tags_id`, `instructor_social_tags_url`, `instructor_social_tags_type`, `instructor_id`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'https://fullstackworld.co.in/index.php', 3, 2, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 15:53:25'),
(2, 'https://fullstackworld.co.in/index.php', 1, 2, '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 15:53:50'),
(3, 'https://fullstackworld.co.in/index.php', 1, 1, '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 16:16:34'),
(4, 'https://fullstackworld.co.in/index.php', 2, 1, '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 15:51:51'),
(5, 'https://fullstackworld.co.in/index.php', 1, 2, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 10:15:25'),
(6, 'https://fullstackworld.co.in/index.php	', 1, 4, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 10:16:53'),
(7, 'https://instagram.com/001.12.9?igshid=OGQ5ZDc2ODk2ZA==', 3, 11, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 14:13:29'),
(12, '1111', 1, 11, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 23:25:05'),
(13, 'ffffffffffffff', 1, 3, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `icons` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `icons`, `parent_id`, `menu_url`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'Dashboard', 'monitor', 119, 'http://localhost/admin_portal/admin_page.php', '1', 1, 1, '2023-12-12 15:35:12', '2023-12-12 14:36:33'),
(2, 'Courses', 'layout', 0, '0', '1', 1, 1, '2023-12-05 08:17:27', '2023-12-11 18:45:51'),
(3, 'Instructors', 'slack', 0, 'http://localhost/admin_portal/add_instructor.php', '1', 1, 1, '2023-12-05 08:17:27', '2023-12-11 18:41:47'),
(5, 'Add Instructor', '', 3, 'http://localhost/admin_portal/add_instructor.php', '1', 1, 1, '2023-12-05 09:53:01', '2023-12-10 11:04:21'),
(6, 'Add Course', '', 2, 'http://localhost/admin_portal/add_course.php', '1', 1, 1, '2023-12-05 15:38:07', '2023-12-10 11:04:38'),
(7, 'Student Registration', 'user', 119, 'http://localhost/admin_portal/registration.php', '1', 1, 1, '2023-12-05 15:38:53', '2023-12-11 20:33:13'),
(9, 'Instructor Social Tags', '', 3, 'http://localhost/admin_portal/Instructor_socialTag.php', '1', 1, 1, '2023-12-10 01:46:38', '2023-12-10 00:48:16'),
(10, 'Meta Tags', 'share-2', 0, '0', '1', 1, 1, '2023-12-10 05:32:21', '2023-12-11 18:54:47'),
(11, 'Add MetaTag', '', 10, 'http://localhost/admin_portal/add_metaTag.php', '1', 1, 1, '2023-12-10 05:33:47', '2023-12-10 11:04:56'),
(12, 'Add Tag', '', 10, 'http://localhost/admin_portal/add_tag.php', '1', 1, 1, '2023-12-10 05:35:37', '2023-12-10 11:05:28'),
(13, 'Technologies', 'cpu', 0, '0', '1', 1, 1, '2023-12-10 08:34:35', '2023-12-11 19:01:43'),
(14, ' Add Technology', '', 13, 'http://localhost/admin_portal/add_technology.php', '1', 1, 1, '2023-12-10 08:36:17', '2023-12-10 07:37:31'),
(15, 'Course Technologies', '', 13, 'http://localhost/admin_portal/courses_technologies.php', '1', 1, 1, '2023-12-10 08:46:05', '2023-12-10 07:47:33'),
(16, 'Access Key', 'codepen', 119, 'http://localhost/admin_portal/acessKey.php', '1', 1, 1, '2023-12-11 17:53:27', '2023-12-11 20:33:25'),
(17, 'Bootcamp', 'aperture', 119, 'http://localhost/admin_portal/bootcamp.php', '1', 1, 1, '2023-12-11 18:52:58', '2023-12-11 20:33:35'),
(19, 'Course Curriculum', '', 2, 'http://localhost/admin_portal/course_curriculum.php', '1', 1, 1, '2023-12-11 22:24:06', '2023-12-11 21:24:58'),
(20, 'Reach Us', 'send', 119, 'http://localhost/admin_portal/reach_us.php', '1', 1, 1, '2023-12-12 14:53:05', '2023-12-12 14:00:19'),
(21, 'Course Count', '', 2, 'http://localhost/admin_portal/course_count.php', '1', 1, 1, '2023-12-11 20:41:20', '2023-12-12 14:37:41'),
(22, 'Current Openings', 'globe', 119, 'http://localhost/admin_portal/currentopening_table.php', '1', 1, 1, '2023-12-12 15:40:31', '2023-12-12 15:06:40'),
(23, 'Counts', 'bar-chart-2', 119, 'http://localhost/admin_portal/count_table.php', '1', 1, 1, '2023-12-12 17:25:29', '2023-12-12 16:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `meta_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `property` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `menu_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`meta_id`, `name`, `property`, `content`, `menu_id`, `tag_id`, `course_id`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'Full Stack Essentials', 'https://fullstackworld.co.in/course-details.php', 'FSW Essentials program makes you capable in abilities to work with front-end and back-end web technologies. The front-end area incorporates working with HTML, CSS3, and Bootstrap to plan intelligent and responsive site pages while the back-end segment comprises programming in PHP with MySQL.', 5, 1, 18, '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 09:56:29'),
(2, 'Andriod native', 'https://fullstackworld.co.in/course-details.php', 'Ui Designer', 15, 1, 20, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 09:56:20'),
(3, 'Full Stack Advanced', 'https://fullstackworld.co.in/course-details.php', 'Full Stack Advanced', 2, 1, 19, '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 14:32:20'),
(4, 'Full Stack Essentials', 'https://fullstackworld.co.in/course-details.php', 'zzzzzzzzzz', 7, 2, 24, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 09:57:10'),
(5, 'UI Designer', 'https://fullstackworld.co.in/course-details.php', 'UI Designer', 15, 4, 22, '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 14:33:03'),
(6, 'Ui Designer', 'https://fullstackworld.co.in/course-details.php', 'qqqqqqqqqqq', 1, 1, 21, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:58:33'),
(7, 'hhhhhhhhhhhhhhlllllllllllll', 'https://fullstackworld.co.in/course-details.php', 'ffffffffff', 17, 2, 20, '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `number_verify_access_key`
--

CREATE TABLE `number_verify_access_key` (
  `ak_id` int(11) NOT NULL,
  `ak` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `number_verify_access_key`
--

INSERT INTO `number_verify_access_key` (`ak_id`, `ak`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'Type', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 17:15:29'),
(2, 'Type', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 17:16:17'),
(3, 'Type', '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 11:34:06'),
(5, 'Access Key', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 11:33:54'),
(6, 'Access Key', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 11:33:48'),
(7, 'Type', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 11:34:02'),
(8, 'g', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:29:26'),
(9, 'sssssssssssfffffffff', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 16:00:20'),
(10, 'Typeaaaaaaaa', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `reach_us`
--

CREATE TABLE `reach_us` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(150) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_subject` varchar(300) NOT NULL,
  `contact_message` longtext NOT NULL,
  `email_headers` varchar(300) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reach_us`
--

INSERT INTO `reach_us` (`contact_id`, `contact_name`, `contact_email`, `contact_subject`, `contact_message`, `email_headers`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'pavankumar', 'pavankumar@gmail.com', 'About Course', 'Hello Sir, I would like to purchase the Full Stack Essentials course. Additionally, I am interested in acquiring the Full Stack Advanced course. Is it possible to purchase both of these courses simultaneously?', 'From: Pavan Kumar <pavankumar@gmail.com> To: Fullstack World <fullstackwoeld@gmal.com> Subject: About Course Date: Mon, 12 Dec 2023 14:30:00 -0500', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 13:46:33'),
(2, 'mohankumar', 'mohankumar@gmail.com', 'Availability', 'Hello Full Stack World,\r\nAre offline classes available for these courses?', 'From: Mohan Kumar <mohankumar@gmail.com> To: Fullstack World <fullstackwoeld@gmal.com> Subject: Availability  Date: Mon, 24 Dec 2023 14:30:00 -0500', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 13:52:29'),
(3, '11111ssssssssss', '111@amial', '111', '1111', '1111', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 16:01:22');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `student_id` int(11) NOT NULL,
  `student_fname` varchar(100) NOT NULL,
  `student_lname` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `student_alt_number` varchar(50) NOT NULL,
  `student_gender` varchar(50) NOT NULL,
  `student_address` varchar(200) NOT NULL,
  `student_courses` varchar(50) NOT NULL,
  `student_program1` enum('0','1') NOT NULL,
  `student_program2` enum('0','1') NOT NULL,
  `student_program3` enum('0','1') NOT NULL,
  `student_hear_aboutus` enum('1','2','3','4','5') NOT NULL,
  `student_recommend` enum('Y','M','N') NOT NULL,
  `ref1` varchar(100) NOT NULL,
  `ref1_number` varchar(50) NOT NULL,
  `ref2` varchar(100) NOT NULL,
  `ref2_number` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`student_id`, `student_fname`, `student_lname`, `student_email`, `student_number`, `student_alt_number`, `student_gender`, `student_address`, `student_courses`, `student_program1`, `student_program2`, `student_program3`, `student_hear_aboutus`, `student_recommend`, `ref1`, `ref1_number`, `ref2`, `ref2_number`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'Pavan', 'Kumar', 'pavankumar@gmail.com', '9652824475', '9618428147', 'male', '4-17/1/5,Rajeev nagar Yendada', 'Full Stack Essentials', '1', '0', '1', '5', 'Y', '', '', '', '', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 20:13:31'),
(2, 'Mohan', 'Kumar', 'mohankumar@gmail.com', '7845963214', '7845963214', 'male', '4-17/1/5,Rajeev nagar Yendada', 'Android Native Developer', '1', '0', '1', '1', 'M', '', '', '', '', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 20:14:28'),
(3, 'Pavani', 'Makena', 'pavanimakena@gmail.com', '5412368749', '5412368749', 'female', '4-17/1/5,Rajeev nagar Yendada', 'Full Stack Essentials', '1', '0', '0', '3', 'Y', '', '', '', '', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 20:13:47'),
(4, 'Ananth', 'Jonnada', 'ananthjonnada@gmail.com', '9347932041', '9347932041', 'male', '4-17/1/5,Rajeev nagar Yendada', 'Android Native Developer', '0', '0', '1', '4', 'Y', '', '', '', '', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 20:14:39'),
(5, 'Vinay', 'Jonnada', 'vinayjonnada@gmail.com', '9546875210', '9546875210', 'male', '4-17/1/5,Rajeev nagar Yendada', 'Android Native Developer', '0', '0', '1', '1', 'Y', '', '', '', '', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 20:14:52'),
(6, 'PavanI', 'Makena', 'pavanimakena@gmail.com', '9632587410', '9632587410', 'female', '4-17/1/5,Rajeev nagar Yendada', 'Node Expert', '1', '1', '1', '4', 'Y', '', '', '', '', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 16:46:49'),
(7, 'Mohan', 'Kumar', 'mohankumar@gmail.com', '7894561230', '7894561230', 'male', '4-17/1/5,Rajeev nagar Yendada', 'Android Native Developer', '0', '0', '0', '2', 'Y', '', '', '', '', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 11:18:28'),
(8, 'Pawan', 'Kalyan', 'pawankalyan@gmail.com', '7894561230', '7894561230', 'male', '4-17/1/5,Rajeev nagar Yendada', 'Node Expert', '1', '1', '1', '2', 'Y', 'kumar', '9654781250', '', '', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-13 00:17:17'),
(9, 'Pavan', 'Makena', 'pavanimakena@gmail.com', '44444', '4444444', 'male', '555555', 'Android Native Developer', '1', '0', '0', '2', 'Y', '', '', '', '', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:56:37'),
(10, 'Mohan', 'Kumar', 'pavankumar@gmail.com', '4444444444', '', 'male', 'ffffffffff', 'Full Stack Advanced', '0', '0', '0', '1', 'Y', '', '', '', '', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-13 07:02:35'),
(11, 'fffffffffffffffff', 'Kalyan', 'wwwwwwwww@gmail.com', '33333333333333', '333333333', 'male', '3333333', 'jumma', '0', '0', '0', '2', 'Y', '', '', '', '', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'https://fullstackworld.co.in', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 09:41:05'),
(2, 'https://fullstacddddd', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 09:41:10'),
(3, 'sss', '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 09:43:09'),
(4, 'https://fullstackworld.co.in/course-details.php', '1', 0, 1, '0000-00-00 00:00:00', '2023-12-12 09:41:20'),
(5, 'https:', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 09:43:14'),
(6, 'pavan kumar', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 09:43:20'),
(7, 'aaaaa', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 09:42:51'),
(8, 'https://fullstackworld.co.in/course-details.php', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 09:43:00'),
(9, 'eeeeeeeeeeeeeeffffffff', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:58:57'),
(10, 'https://fullstackworld.co.in/course-details.phpjjj', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE `technologies` (
  `technology_id` int(11) NOT NULL,
  `technology_name` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `modify_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`technology_id`, `technology_name`, `status`, `created_by`, `modified_by`, `created_date_time`, `modify_date_time`) VALUES
(1, 'HTML', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 16:25:01'),
(2, 'Python', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 16:10:03'),
(3, 'Php', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 16:14:59'),
(4, 'Java', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:35:54'),
(5, 'Node', '0', 0, 1, '0000-00-00 00:00:00', '2023-12-12 11:24:40'),
(6, 'Search Engine Optimization', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:44:48'),
(7, 'Social Media Optimization & Marketing', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:44:34'),
(8, 'Mobile Marketing', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:40:02'),
(9, 'Web Analytics', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:41:40'),
(10, 'Pay-Per-Click (PPC) Advertising', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:42:37'),
(11, 'Email Marketing', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-10 12:43:10'),
(12, 'Ajax', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-11 16:06:08'),
(13, 'Python', '0', 0, 0, '0000-00-00 00:00:00', '2023-12-11 16:18:48'),
(14, 'HTML', '1', 0, 0, '0000-00-00 00:00:00', '2023-12-12 01:53:01'),
(15, 'Node', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 11:24:32'),
(16, 'Node', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-12 02:20:34'),
(17, 'Python ', '1', 1, 1, '0000-00-00 00:00:00', '2023-12-14 05:36:11'),
(18, 'jumma', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 11:25:02'),
(19, 'fffffffffffffaaaaaaaaaaa', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-12 15:59:22'),
(20, 'jumamaaaaaaaaaaaaaaaa', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-14 06:52:03'),
(21, 'HTML1', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-15 01:26:14'),
(22, '12', '0', 1, 1, '0000-00-00 00:00:00', '2023-12-15 01:26:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_login_id`);

--
-- Indexes for table `bootcamp`
--
ALTER TABLE `bootcamp`
  ADD PRIMARY KEY (`bc_id`);

--
-- Indexes for table `counts`
--
ALTER TABLE `counts`
  ADD PRIMARY KEY (`count_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `courses_technologies`
--
ALTER TABLE `courses_technologies`
  ADD PRIMARY KEY (`courses_technologies_id`);

--
-- Indexes for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indexes for table `currentopening`
--
ALTER TABLE `currentopening`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `instructor_social_tags`
--
ALTER TABLE `instructor_social_tags`
  ADD PRIMARY KEY (`instructor_social_tags_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `number_verify_access_key`
--
ALTER TABLE `number_verify_access_key`
  ADD PRIMARY KEY (`ak_id`);

--
-- Indexes for table `reach_us`
--
ALTER TABLE `reach_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`technology_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bootcamp`
--
ALTER TABLE `bootcamp`
  MODIFY `bc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `counts`
--
ALTER TABLE `counts`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `courses_technologies`
--
ALTER TABLE `courses_technologies`
  MODIFY `courses_technologies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currentopening`
--
ALTER TABLE `currentopening`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `instructor_social_tags`
--
ALTER TABLE `instructor_social_tags`
  MODIFY `instructor_social_tags_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `number_verify_access_key`
--
ALTER TABLE `number_verify_access_key`
  MODIFY `ak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reach_us`
--
ALTER TABLE `reach_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `technologies`
--
ALTER TABLE `technologies`
  MODIFY `technology_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
