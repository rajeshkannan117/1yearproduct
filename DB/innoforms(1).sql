-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2017 at 07:03 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innoforms`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `organization_id` varchar(255) NOT NULL,
  `job_site_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '1-active, 0-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `uuid`, `title`, `description`, `organization_id`, `job_site_id`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
(1, '70ea3851-c34f-49b9-82d5-a19c60743600', 'Issue 1', 'This\'s the test issue to check..!!!', '41', 47, 80, '2017-01-05 09:54:36', '2017-01-05 09:54:36', 0),
(2, 'cba05432-18cf-46c5-a51d-d7b93b17f83a', 'Test 2', 'Test Issue 2', '41', 47, 80, '2017-01-05 11:58:55', '2017-01-05 11:58:55', 0),
(3, 'c5725f0e-dbad-42c2-831b-1dd1137a4abc', 'Test 3', 'Test 3', '41', 47, 80, '2017-01-05 13:06:21', '2017-01-05 13:06:21', 0),
(4, '76e87942-0459-4afc-bbc6-8d340b1698e3', 'Test 4', 'Test 4', '41', 47, 80, '2017-01-05 13:09:33', '2017-01-05 13:09:33', 0),
(5, '080426d0-f4b9-41c7-884c-cdf4243989c9', 'TEST 5', 'TEST 5', '41', 47, 80, '2017-01-05 13:12:11', '2017-01-05 13:12:11', 0),
(6, '0eae82c8-54de-410f-87e2-60dc966d7968', 'test ', 'Form of detail', '46', 53, 89, '2017-01-12 07:33:47', '2017-01-12 07:33:47', 1),
(7, '02e4c00c-730b-47d4-8541-6c58cfd2eb77', '', '', '43', 50, 85, '2017-01-12 12:11:50', '2017-01-12 12:11:50', 1),
(8, '1261b73e-e45b-42fa-b103-376723075294', 'gttjfyj', 'Yfy', '43', 50, 85, '2017-01-12 15:00:16', '2017-01-12 15:00:16', 1),
(9, 'e16c057a-3f98-4343-bb28-ec39a77673c3', 'unable to present today', 'Todo pending', '47', 54, 94, '2017-01-13 12:13:58', '2017-01-13 12:13:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alert_comments`
--

CREATE TABLE `alert_comments` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `alert_id` int(11) NOT NULL COMMENT 'id from alert table primary key',
  `user_id` int(11) NOT NULL COMMENT 'primary key from users table',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-active, 0-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_comments`
--

INSERT INTO `alert_comments` (`id`, `comment`, `alert_id`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Test Comment 1', 1, 80, '2017-01-05 09:54:36', '0000-00-00 00:00:00', 1),
(2, 'Test 2', 2, 80, '2017-01-05 11:58:55', '0000-00-00 00:00:00', 1),
(3, 'Text 1', 2, 80, '2017-01-05 11:59:55', '0000-00-00 00:00:00', 1),
(4, 'Test 3', 3, 80, '2017-01-05 13:06:21', '0000-00-00 00:00:00', 1),
(5, 'Test 4', 4, 80, '2017-01-05 13:09:33', '0000-00-00 00:00:00', 1),
(6, 'TEST 5', 5, 80, '2017-01-05 13:12:11', '0000-00-00 00:00:00', 1),
(7, 'Comment 1', 5, 80, '2017-01-05 13:13:40', '0000-00-00 00:00:00', 1),
(8, 'Commsfvisaajbfu', 4, 79, '2017-01-05 13:16:26', '0000-00-00 00:00:00', 1),
(9, 'What is this', 4, 79, '2017-01-05 13:31:02', '0000-00-00 00:00:00', 1),
(10, 'What', 4, 79, '2017-01-05 13:33:49', '0000-00-00 00:00:00', 1),
(11, 'asd', 4, 79, '2017-01-05 13:34:07', '0000-00-00 00:00:00', 1),
(12, 'asdd', 4, 79, '2017-01-05 13:35:58', '0000-00-00 00:00:00', 1),
(13, 'sd', 4, 79, '2017-01-05 13:39:43', '0000-00-00 00:00:00', 1),
(14, 'hgf', 4, 79, '2017-01-05 13:41:29', '0000-00-00 00:00:00', 1),
(15, 'asdad', 4, 79, '2017-01-05 14:02:15', '0000-00-00 00:00:00', 1),
(16, 'Test', 6, 89, '2017-01-12 07:33:47', '0000-00-00 00:00:00', 1),
(17, 'Jko', 7, 85, '2017-01-12 12:11:50', '0000-00-00 00:00:00', 1),
(18, 'Hi', 7, 85, '2017-01-12 16:50:41', '0000-00-00 00:00:00', 1),
(19, 'Comments needed', 9, 94, '2017-01-13 12:13:58', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `alert_details`
--

CREATE TABLE `alert_details` (
  `id` int(11) NOT NULL,
  `alert_id` int(11) NOT NULL,
  `resolved_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_details`
--

INSERT INTO `alert_details` (`id`, `alert_id`, `resolved_by`, `created_at`, `updated_at`) VALUES
(1, 4, 79, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 5, 79, '2017-01-05 10:07:30', '2017-01-05 10:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `alert_images`
--

CREATE TABLE `alert_images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `alert_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_images`
--

INSERT INTO `alert_images` (`id`, `image_name`, `alert_id`) VALUES
(1, 'c2f94f43e8a3b01f68a4ea95242822c6.jpg', 1),
(2, '0bce1b5d13c0464d441f6ee3689c2c08.jpg', 1),
(3, '1f5a90dcc69844379e64c299db3bcd94.jpg', 2),
(4, '1300f7f57638bb40369e45a5934438a0.jpg', 3),
(5, 'af1a2f1929d3a21ab1543dc3befd84a9.jpg', 4),
(6, '189a65dc947d07bb663818a8b66b15ae.jpg', 5),
(7, '5694cc26d5bb493bd044042c8f7f7447.jpg', 5),
(8, '2a2646b02d2ba64208f788f91e83b00d.jpg', 7),
(9, 'cffd3734e7b49dcb91ffa3f68aed2470.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `alert_reporting_mapping`
--

CREATE TABLE `alert_reporting_mapping` (
  `id` int(11) NOT NULL,
  `alert_id` int(11) NOT NULL COMMENT 'primary_key from alerts table',
  `reporting_to` int(11) NOT NULL COMMENT 'primary key from users table - the users who must be reported to'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_reporting_mapping`
--

INSERT INTO `alert_reporting_mapping` (`id`, `alert_id`, `reporting_to`) VALUES
(1, 1, 79),
(2, 2, 79),
(3, 3, 79),
(4, 4, 79),
(5, 5, 79),
(6, 8, 90),
(7, 9, 92),
(8, 9, 93);

-- --------------------------------------------------------

--
-- Table structure for table `appapi`
--

CREATE TABLE `appapi` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appapi`
--

INSERT INTO `appapi` (`id`, `token`, `created_time`, `modified_time`, `user_id`) VALUES
(2, '9af8db4b339b53179a5a50e4a7c39121', '2016-08-17 11:46:05', '2016-08-17 11:46:53', 1),
(5, '9b6aec3d9abd696ed51c4ba7a3f15790', '2016-06-23 05:39:57', '2016-06-23 05:47:28', 5),
(6, '9762a832f825895bd9a6cf79b60c0f97', '2016-06-22 12:21:34', '2016-06-22 14:00:14', 11),
(7, 'ca4103ddd60318cdfc5d5464d5851123', '2016-06-22 13:04:57', '2016-06-22 15:31:30', 2),
(8, 'e570e94f0fc2c00706e3b63c6eb0cf21', '2016-06-24 09:19:25', '2016-06-24 12:59:55', 18),
(9, '6d447372f308b36bb8df252af645d7cd', '2016-06-23 07:28:30', '2016-06-23 07:55:11', 19),
(10, '8a4272c3236dabcf98c51412d1ac739c', '2016-06-23 08:27:29', '2016-06-23 09:57:07', 25),
(16, '0e286f15d315c98457a7fce3fb46a0c0', '2016-06-27 07:55:17', '2016-06-27 07:55:17', NULL),
(17, '2bd36ac32b4b569288b9952231b0edd6', '2016-06-27 07:59:12', '2016-06-27 07:59:12', NULL),
(29, 'd3c16fc9e334436e8f9a6993857755e0', '2016-07-15 09:35:58', '2016-07-15 09:37:01', 39),
(43, '005dc3ab63d3c990fdbbd57e435d7172', '2016-08-17 12:14:48', '2016-08-17 12:14:48', 31),
(44, '5cd3e2e2b570407660a40130bdf0fd75', '2016-07-30 06:57:30', '2016-07-30 08:18:40', 43),
(45, '348aa7030bbbb29e4afb84ddf6474899', '2016-07-29 15:59:58', '2016-07-29 16:00:16', 44),
(51, 'a3608efc41912f308975370caf772466', '2016-08-17 08:47:59', '2016-08-17 13:18:17', 42),
(53, '8a1bdcb78a6884a3ea77262359eec47e', '2016-08-17 05:49:46', '2016-08-17 05:49:48', 45),
(54, '2e5ae918dd791f63bab2708e3f22ad63', '2016-09-27 16:25:56', '2016-09-27 16:25:56', 17),
(57, '9538a153ac65c9cc7b80dc2e9cdedde0', '2016-09-14 15:29:43', '2016-09-14 15:31:48', 29),
(58, '96424c4ae19f7259626c8ea947824d4d', '2016-10-04 13:44:41', '2016-10-04 13:44:41', 30),
(59, '0c75a15e42e57e564383968b5edff474', '2016-10-04 23:11:30', '2016-10-04 23:11:30', 37),
(60, 'cd614df71ad0e7ef4a0b9c5b81e929d4', '2016-11-11 09:28:34', '2016-11-11 09:28:34', 46),
(61, '0d507f651026232b6b480a37fc71b22e', '2016-11-11 09:59:15', '2016-11-11 09:59:15', 50),
(62, '3f2a72bb4e126d5de4013606dd075e9c', '2016-12-19 06:09:26', '2016-12-19 06:09:26', 59),
(63, '4a4dbcdee840c1603b1cedba58bb2a43', '2016-12-21 12:28:46', '2016-12-21 12:28:46', 61),
(64, '9485d67b67232abe364c247ab64a3465', '2016-12-21 11:26:19', '2016-12-21 11:26:19', 62),
(65, '736dfee3530f507ee0aa558f66bce60c', '2016-12-21 12:40:25', '2016-12-21 12:40:25', 67),
(66, 'c22a02e92d9b8c0978fd215d32fbc774', '2016-12-17 08:59:46', '2016-12-17 08:59:46', 64),
(67, '8146b5be4dde8421fcd82188adba63b3', '2016-12-17 09:08:14', '2016-12-17 09:08:14', 66),
(68, 'b2af411d5ba68bf281eb630348c263bb', '2016-12-22 09:55:16', '2016-12-22 09:55:16', 74),
(69, '75a4d56cd1790330b9b109d9e1264d5c', '2017-01-12 19:01:47', '2017-01-12 19:01:47', 80),
(70, '4f921a9f7030e6a8b2702344847290aa', '2017-01-05 13:37:52', '2017-01-05 13:37:52', 79),
(71, 'becb5b67787c03ea2e72c61f66224f96', '2017-01-13 09:59:38', '2017-01-13 09:59:38', 81),
(72, 'e620c57c4097eccf9ee911b2ce76a72e', '2017-01-13 09:23:30', '2017-01-13 09:23:30', 82),
(73, 'e1e08dca59c7cf4531b39266ec484127', '2017-01-12 07:32:50', '2017-01-12 07:32:50', 89),
(74, '0d778256af81efe109231f7985938c8f', '2017-01-12 14:59:38', '2017-01-12 14:59:38', 85),
(75, 'c5f209faf16b0f537f7da0fceb50bb4d', '2017-01-13 10:42:39', '2017-01-13 10:42:39', 90),
(76, '9f5f6a4851e247fa231784a9f137ecba', '2017-01-12 19:03:02', '2017-01-12 19:03:02', 78),
(77, 'daa3db99b5b0022afa2a00bef963c4a0', '2017-01-13 10:17:48', '2017-01-13 10:17:48', 83),
(78, '28858f1a4e3372ac21fc977a5ec9f835', '2017-01-13 11:05:48', '2017-01-13 11:05:48', 95),
(79, 'b93c18c1aed338bb1effd9ff62c84b0b', '2017-01-13 12:28:56', '2017-01-13 12:28:56', 94),
(80, '9d40b65de6ca889742c6cb1f80e7d1fb', '2017-02-08 13:51:25', '2017-02-08 13:51:25', 93),
(81, 'c575fd74c9143e87f52fefcf2bf31a8b', '2017-01-13 12:40:10', '2017-01-13 12:40:10', 92),
(82, 'e923039ddf0806f375c5ffd0fda1f6ca', '2017-01-24 05:30:28', '2017-01-24 05:30:28', 103),
(83, '651cb9d9d29d4ae38975afe04bf6602c', '2017-01-13 16:19:29', '2017-01-13 16:19:29', 101),
(84, '08aa735114651fdfd189fe06c5edbcc5', '2017-01-13 16:21:28', '2017-01-13 16:21:28', 100),
(85, 'b71f90f0eee4a5c11efe18edd85fad8a', '2017-01-14 06:37:51', '2017-01-14 06:37:51', 98),
(86, '3ad039073b4779efa108749051998998', '2017-01-16 09:22:10', '2017-01-16 09:22:10', 91),
(87, '631334085c69917641ee1b7e9ad7b999', '2017-01-23 10:31:27', '2017-01-23 10:31:27', 108),
(88, 'd04ff39e64b84ec0debf8bf62379ff80', '2017-02-01 08:37:41', '2017-02-01 08:37:41', 84),
(89, '3d219222b23727a43864065cef178092', '2017-02-14 13:04:14', '2017-02-14 13:04:14', 112),
(90, '1ec3e4a2a0cb6a8e47784c09a805a0ca', '2017-02-09 08:46:23', '2017-02-09 08:46:23', 113);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` text NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `default` enum('0','1') NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `uuid`, `category_name`, `category_desc`, `parent`, `status`, `created_at`, `updated_at`, `created_by`, `default`, `org_id`) VALUES
(1, '5086591c-5fd3-43f9-a08e-837d3d061568', 'Test Categorys', 'Test Category', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(2, 'c07d9398-531d-435b-b6ec-6b59f2c9202b', 'Developement', 'Developement', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45, '0', 31),
(3, '78bcdce2-9607-4e73-a658-00e4caa912d1', 'Sample Category', 'hello', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45, '0', 31),
(4, 'baee9bd4-01bf-45f7-b24a-379790f95f87', 'Pure cotton', 'Pure Cotton', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(5, '', 'sadfsdf', 'sadfasdf', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(6, '09805edd-23bd-4fcd-8580-148e21f288b3', 'INFORMATION TECHNOLOGIES', 'Only technologies', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(7, 'dfa2425d-cc98-472e-b616-6cc4d563edf7', 'Management', 'Manage', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(8, '271ac9c6-9e58-4398-9284-a8a7289d0cef', 'HR', '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 64, '0', 35),
(9, '89e2a8fc-82b9-4608-97ca-404e4cad124d', 'Finance', 'All Finance related analysis', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(10, '510ebdd4-548f-4122-a578-e6f6fc1a3ff1', 'Test Category1', '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(11, 'c4aa6b2f-63c5-453d-a0b7-67393d128698', 'Test Category2', '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '0', 1),
(13, '289f454d-8098-46a3-adbd-de9945d1adfb', 'Test Category1', '', 0, 1, '2017-01-03 06:21:06', '2017-01-03 06:21:06', 78, '0', 41),
(14, '5af17ee6-a026-42f6-965d-c506a9eb40f7', 'Test Category2', '', 0, 1, '2017-01-03 06:21:06', '2017-01-03 06:21:06', 78, '0', 41),
(15, '0d250839-2ef5-4ee5-8e20-fdf0e6f6bfe9', 'Test Categorys', 'Test Category', 0, 1, '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, '0', 42),
(16, '41938168-13ff-46a3-8b18-cc89e7d1df4f', 'sadfsdf', 'sadfasdf', 0, 1, '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, '0', 42),
(17, 'd3fc4f29-897f-4288-8dd9-7c3c12f30bb9', 'INFORMATION TECHNOLOGIES', 'Only technologies', 0, 1, '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, '0', 42),
(18, '04b02d43-4227-48f4-9833-791f87e1a18b', 'testing', 'testingtesting', 0, 1, '2017-01-11 07:26:58', '2017-01-11 07:26:58', 1, '0', 1),
(19, 'ae592740-2efa-47e8-bb2e-9574d8c30545', 'chemo doc', 'test1', 0, 1, '2017-01-11 08:00:47', '2017-01-11 08:00:47', 1, '0', 1),
(20, '88d5b52b-f95e-460f-aefb-d1b8b5767bed', 'chemo doc', 'test1', 0, 1, '2017-01-12 02:13:34', '2017-01-12 02:13:34', 87, '0', 45),
(21, '379d4f33-7b94-4cc2-ae8d-e070222c9558', 'chemo doc', 'test1', 0, 1, '2017-01-12 02:16:50', '2017-01-12 02:16:50', 88, '0', 46),
(22, 'b97a8798-ba83-4797-acee-1e92c9911795', 'plottreat', 'test QA team', 0, 1, '2017-01-12 02:22:45', '2017-01-12 02:22:45', 1, '0', 1),
(23, 'dbcb5675-8263-4a04-ab50-bbf62ea65f03', 'Application Forms', 'Forms for the application', 0, 1, '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, '0', 47),
(24, 'df97b001-13d9-4f53-a7fb-061bb2e848d0', 'PF Forms', 'forms regarding employee pf', 0, 1, '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, '0', 47),
(25, 'a8250b28-5faf-43f5-9306-5197c942199c', 'Employee forms', 'Forms for empleyees', 0, 1, '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, '0', 47),
(26, 'c9e96cd8-66be-4d47-b66c-e04c71b1c572', 'Billing forms', '', 0, 1, '2017-01-13 08:18:20', '2017-01-13 08:18:20', 97, '0', 48),
(27, 'b0fb31ed-a9bf-4cce-bad8-609bbee60eb8', 'Construction forms', '', 0, 1, '2017-01-13 09:09:26', '2017-01-13 09:09:26', 99, '0', 49),
(28, '71ad7538-981b-4124-bb46-bb9d4f365414', 'troy', 'trop qat', 0, 1, '2017-01-17 00:22:12', '2017-01-17 00:22:12', 104, '0', 50),
(29, 'e83d0347-0864-4d7a-b561-6fc1bb13120f', 'popy', 'poper', 0, 1, '2017-01-23 01:11:26', '2017-01-23 01:11:26', 107, '0', 51),
(30, 'a3fd4b39-674c-41cf-be9f-44f6cd271ef5', 'Test Categorys', 'Test Category', 0, 1, '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, '0', 52),
(31, '8dc94831-9045-4364-ace9-9ef277a79631', 'sadfsdf', 'sadfasdf', 0, 1, '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, '0', 52),
(32, 'cb127cfa-e62a-4d4e-afa8-d8738b102d4e', 'INFORMATION TECHNOLOGIES', 'Only technologies', 0, 1, '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, '0', 52),
(33, '37bc4029-591e-4ad4-bde0-b49b655c5dff', 'Test Categorys', 'Test Category', 0, 1, '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, '0', 53),
(34, '5bfe5661-ea05-4c83-9527-22a09cfa7fab', 'sadfsdf', 'sadfasdf', 0, 1, '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, '0', 53),
(35, '934bbabc-ec85-4fab-ba10-cf3bba44c79e', 'INFORMATION TECHNOLOGIES', 'Only technologies', 0, 1, '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, '0', 53);

-- --------------------------------------------------------

--
-- Table structure for table `category_department`
--

CREATE TABLE `category_department` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_department`
--

INSERT INTO `category_department` (`id`, `cat_id`, `dept_id`, `default`) VALUES
(19, 1, 1, 0),
(20, 2, 1, 0),
(21, 2, 2, 0),
(22, 2, 3, 0),
(23, 3, 1, 0),
(24, 3, 2, 0),
(25, 3, 3, 0),
(26, 4, 4, 0),
(27, 5, 1, 0),
(28, 6, 1, 0),
(29, 6, 3, 0),
(30, 6, 8, 0),
(31, 7, 10, 0),
(32, 8, 11, 0),
(33, 9, 12, 0),
(34, 10, 14, 0),
(35, 10, 15, 0),
(36, 11, 15, 0),
(39, 13, 16, 0),
(40, 13, 17, 0),
(41, 14, 16, 0),
(42, 14, 17, 0),
(43, 15, 18, 0),
(44, 16, 18, 0),
(45, 17, 18, 0),
(46, 17, 21, 0),
(47, 18, 23, 0),
(48, 19, 28, 0),
(49, 20, 31, 0),
(50, 21, 34, 0),
(51, 22, 35, 0),
(52, 23, 36, 0),
(53, 24, 36, 0),
(54, 25, 36, 0),
(55, 25, 39, 0),
(56, 26, 44, 0),
(57, 27, 45, 0),
(58, 27, 46, 0),
(59, 28, 48, 0),
(60, 29, 49, 0),
(61, 30, 50, 0),
(62, 31, 50, 0),
(63, 32, 50, 0),
(64, 32, 53, 0),
(65, 33, 55, 0),
(66, 34, 55, 0),
(67, 35, 55, 0),
(68, 35, 58, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `user_form_info_text_id` int(11) NOT NULL COMMENT 'user_form_info_text_id from user_form_info_text table',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comments`, `submission_id`, `user_form_info_text_id`, `created_by`, `created_date`) VALUES
(1, 'Change the number', 38, 131, 81, '2017-01-13 07:59:08'),
(2, 'This is wrong', 38, 130, 81, '2017-01-13 09:44:20'),
(3, 'Change...!!!!!!!!', 38, 130, 81, '2017-01-13 09:50:26'),
(4, 'Name is invalid', 42, 140, 93, '2017-01-13 12:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_desc` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `default` int(1) NOT NULL COMMENT '0-notdefault,1-default',
  `status` int(1) NOT NULL,
  `org_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `uuid`, `dept_name`, `dept_desc`, `created_at`, `updated_at`, `created_by`, `default`, `status`, `org_id`) VALUES
(1, 'a4c65676-0e33-478e-9584-4ef2c5e3e60f', 'HR Department', 'HR Department', '2016-10-18 03:38:17', '2016-10-18 03:38:17', 1, 0, 1, 1),
(2, 'f17b53d7-1910-43d0-978c-7c52abe4f388', 'Sample Department', 'Sample Department', '2016-10-18 08:28:16', '2016-10-18 08:28:16', 1, 0, 1, 1),
(3, '03e19889-fb82-4d4e-8c6d-08f0dff835ca', 'IT', 'IT', '2016-11-11 03:57:49', '2016-11-11 03:57:49', 45, 0, 1, 31),
(4, 'f5f8ab47-8bb3-4322-9c37-443004ef8940', 'Cotton', '', '2016-11-21 05:21:39', '2016-11-21 05:21:39', 1, 0, 1, 1),
(5, 'a119ca08-4435-4835-b2a0-db2305439159', 'Fabric', '', '2016-11-21 05:22:07', '2016-11-21 05:22:07', 1, 0, 1, 1),
(6, '372ebb5f-f2da-4b47-a293-a1066984d4ef', 'Dhoties', 'Dhoties', '2016-11-21 05:22:22', '2016-11-21 05:22:22', 1, 0, 1, 1),
(7, '', 'Test Department', 'sdfsdf', '2016-11-22 09:04:30', '2016-11-22 09:04:30', 1, 0, 1, 1),
(8, '6564128b-dca0-4383-ab83-91a948a7db11', 'Support Team', 'Information tech-related help', '2016-12-07 05:16:50', '2016-12-07 05:16:50', 1, 0, 1, 1),
(9, '2d02e4a1-ce88-4191-ad78-c68a4b988fd2', 'tech support team1', 'support team1', '2016-12-08 07:20:36', '2016-12-08 07:20:36', 61, 0, 1, 34),
(10, '7b9062ed-f7e3-475f-8e85-58591fd8b104', 'Marketing', 'The exchange of goods or services', '2016-12-15 08:42:49', '2016-12-15 08:42:49', 1, 0, 1, 35),
(11, '241e6615-a3ff-410f-a459-aad2e6ce60bd', 'HR Department', 'HR', '2016-12-19 05:43:07', '2016-12-19 05:43:07', 64, 0, 1, 35),
(12, '23da6470-94ad-47cb-87e1-5d7376904343', 'Account', 'In order to find Profit and loss, Risk management.', '2016-12-22 02:54:49', '2016-12-22 02:54:49', 1, 0, 1, 1),
(13, '052bf714-4dda-4f42-b0fe-0c50ad104ab4', 'Account', 'verify all Money related  Jobs', '2016-12-22 04:47:44', '2016-12-22 04:47:44', 71, 0, 1, 38),
(14, '356e08e9-98ac-4acc-811b-da0b47b8aa2b', 'Test Department1', '', '2017-01-03 06:06:08', '2017-01-03 06:06:08', 1, 0, 1, 1),
(15, '274b8b1a-51b8-44ef-8699-d44f290f57de', 'Test Department2', '', '2017-01-03 06:06:27', '2017-01-03 06:06:27', 1, 0, 1, 1),
(16, 'cb9749cd-c18c-4b84-9d89-32238a17f358', 'Test Department1', '', '2017-01-03 06:21:06', '2017-01-03 06:21:06', 78, 0, 1, 41),
(17, '40b15937-e0f2-45e5-bb26-8e5fe6f59ce4', 'Test Department2', '', '2017-01-03 06:21:06', '2017-01-03 06:21:06', 78, 0, 1, 41),
(18, 'f9c3a39b-7ab3-40fc-bfab-8e3fd436ab85', 'HR Department', 'HR Department', '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, 0, 1, 42),
(19, '587aca00-a6db-4cba-9557-4f95e501f2a3', 'Sample Department', 'Sample Department', '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, 0, 1, 42),
(20, '4fc6a19c-f5b3-408c-94ee-ada3bdf5737f', 'Test Department', 'sdfsdf', '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, 0, 1, 42),
(21, '374e7560-becd-40b9-8feb-2beb4b896d0d', 'Support Team', 'Information tech-related help', '2017-01-09 02:28:24', '2017-01-09 02:28:24', 81, 0, 1, 42),
(22, '7d2c8b9d-7081-4794-8b63-42344a7b10b2', 'Floor Admin', 'Admin', '2017-01-11 04:40:02', '2017-01-11 04:40:02', 81, 0, 0, 42),
(23, '6ff0b1c1-32cb-4c7d-af74-67836c17458c', 'testingtestingtestingtesting', 'testingtestingtestingtestingtestingtesting', '2017-01-11 07:21:53', '2017-01-11 07:21:53', 1, 0, 1, 1),
(24, '3cd20d00-ef5f-4aa9-9729-d179656c46ff', 'testingindia', 'testingtestingtestingtestingtestingtestingtestingtestingtestingv', '2017-01-11 07:35:04', '2017-01-11 07:35:04', 1, 0, 0, 1),
(25, '7d55675c-e457-42c2-972c-10d16a4e4853', 'testingLead', 'testinginnoppl', '2017-01-11 07:45:18', '2017-01-11 07:45:18', 84, 0, 1, 43),
(26, 'e326d252-6a8b-45d1-b6c0-0f69cf4ce5cc', 'chemotheraphy', 'chemo', '2017-01-11 07:57:06', '2017-01-11 07:57:06', 1, 0, 0, 1),
(27, '996b31f8-3f57-4a36-85e2-5f46c661f99d', 'chemotheraphy', 'chemo', '2017-01-11 07:57:21', '2017-01-11 07:57:21', 1, 0, 1, 1),
(28, '198903d2-8408-4d9e-9385-8ae4cae02fda', 'bloodtest', 'bloodtest', '2017-01-11 07:59:37', '2017-01-11 07:59:37', 1, 0, 0, 1),
(29, '1956f905-3ca9-4800-b6f9-090bfebf2892', 'chemotheraphy', 'chemo', '2017-01-12 02:13:34', '2017-01-12 02:13:34', 87, 0, 1, 45),
(30, '3e71c50b-3dd2-4284-9de4-2dfe74ff0c69', 'chemotheraphy', 'chemo', '2017-01-12 02:13:34', '2017-01-12 02:13:34', 87, 0, 1, 45),
(31, '3519b193-3c7f-42e6-a8c8-0b3f0f66c88c', 'bloodtest', 'bloodtest', '2017-01-12 02:13:34', '2017-01-12 02:13:34', 87, 0, 1, 45),
(32, 'ce54ef47-8c46-460c-8f12-ec773cd644e8', 'chemotheraphy', 'chemo', '2017-01-12 02:16:49', '2017-01-12 02:16:49', 88, 0, 1, 46),
(33, '0d02f89e-b0e0-49b7-9a76-b302f77bc93f', 'chemotheraphy', 'chemo', '2017-01-12 02:16:49', '2017-01-12 02:16:49', 88, 0, 1, 46),
(34, '48c2871b-dfd6-4ef8-b744-dcb1fcac59ef', 'bloodtest', 'bloodtest', '2017-01-12 02:16:50', '2017-01-12 02:16:50', 88, 0, 1, 46),
(35, '1b10a159-1de1-40dc-8f08-55e0ed213765', 'alphateam', 'blood report', '2017-01-12 02:17:23', '2017-01-12 02:17:23', 1, 0, 1, 1),
(36, '16769f0a-95c7-4492-97a3-b302f97478e3', 'HR Department', 'HR Department', '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, 0, 1, 47),
(37, '78fa89d1-4921-473e-a2fd-b7ec72beed44', 'Sample Department', 'Sample Department', '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, 0, 0, 47),
(38, '5230b68f-a4d5-48f9-9bc4-463a9d883614', 'Test Department', 'sdfsdf', '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, 0, 0, 47),
(39, 'a879fda3-249f-4811-acc6-9a5f4fbc22b3', 'Support Team', 'Information tech-related help', '2017-01-12 09:01:51', '2017-01-12 09:01:51', 91, 0, 1, 47),
(40, 'd86c0c1e-a0ad-4ec4-8866-7860b62f1807', 'Project Team', '', '2017-01-12 09:10:11', '2017-01-12 09:10:11', 91, 0, 1, 47),
(41, 'e5257479-47f1-4e2c-9fc1-da139e65bc13', 'dev', 'developing', '2017-01-13 05:38:10', '2017-01-13 05:38:10', 84, 0, 1, 43),
(42, '3b5ea6ae-d2bc-4887-a6eb-067ace5ff2bf', 'Mobile Team', '', '2017-01-13 06:58:39', '2017-01-13 06:58:39', 91, 0, 1, 47),
(43, '5dd83d9c-2900-426c-835f-84a1cdb9920d', 'Bluegreencontruction', 'Bluegreencontruction Details', '2017-01-13 07:55:13', '2017-01-13 07:55:13', 1, 0, 0, 1),
(44, '09fd8b75-c5b4-4acc-ad4c-1c3d42889528', 'Bluegreencontruction', 'Bluegreencontruction Details', '2017-01-13 07:58:23', '2017-01-13 07:58:23', 97, 0, 1, 48),
(45, 'fa677d61-c401-40d7-8e54-96c39e8ac4a2', 'Support Team', '', '2017-01-13 08:55:34', '2017-01-13 08:55:34', 99, 0, 1, 49),
(46, '335e22ad-e800-4fa6-8492-8638b6546b21', 'Project Team', '', '2017-01-13 08:55:45', '2017-01-13 08:55:45', 99, 0, 1, 49),
(47, 'b8b8986d-94e4-4afa-902a-939d11ccc521', 'qat 123456', 'qat', '2017-01-17 00:20:07', '2017-01-17 00:20:07', 1, 0, 1, 1),
(48, 'a8dd53ed-4ce6-4038-a27d-37e2d1a0c7f8', 'qat 123456', 'test12345', '2017-01-17 00:21:34', '2017-01-17 00:21:34', 104, 0, 1, 50),
(49, 'e21339f8-a7b8-4203-a14c-26760515fef0', 'management', 'management', '2017-01-23 01:09:25', '2017-01-23 01:09:25', 107, 0, 1, 51),
(50, '80a40539-ea5b-4357-8771-533e511ce187', 'HR Department', 'HR Department', '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, 0, 1, 52),
(51, '8a52f831-5423-4a2a-81b1-8448e25599ec', 'Sample Department', 'Sample Department', '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, 0, 1, 52),
(52, '297aa056-359c-48d7-be85-cd6f0c5bfaad', 'Test Department', 'sdfsdf', '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, 0, 1, 52),
(53, '4e316f59-90ca-40b6-99db-1ee5c5a6bb1f', 'Support Team', 'Information tech-related help', '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, 0, 1, 52),
(54, '5b12a42c-bf4a-4921-9af6-3bd86c09570b', 'qat 123456', 'qat', '2017-02-01 05:25:51', '2017-02-01 05:25:51', 109, 0, 1, 52),
(55, 'ef1f7834-5f3b-4df9-8be3-cd2c644e78d6', 'HR Department', 'HR Department', '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, 0, 1, 53),
(56, '67bb134d-2855-4e09-ab7d-0bb79c5e4548', 'Sample Department', 'Sample Department', '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, 0, 1, 53),
(57, '719834d9-5d36-4cd3-85e5-2e4013c97d21', 'Test Department', 'sdfsdf', '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, 0, 1, 53),
(58, '54c8023e-9f2a-4dcc-a6ed-47afe811ee6f', 'Support Team', 'Information tech-related help', '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, 0, 1, 53),
(59, '39084ea2-540d-4bf5-8861-bf9371f71202', 'qat 123456', 'qat', '2017-02-02 06:17:26', '2017-02-02 06:17:26', 110, 0, 1, 53),
(60, '8fb8855e-511a-4207-ad5b-76118ce42d31', 'testingNewtoday', 'testing', '2017-02-02 06:18:50', '2017-02-02 06:18:50', 1, 0, 1, 1),
(61, 'a5cc08d8-ae5f-40a2-8e3f-4a82e40d1c0f', 'combined', 'combined', '2017-02-07 06:58:58', '2017-02-07 06:58:58', 1, 0, 1, 1),
(62, 'e54d5507-5a11-47b5-ba99-20c61e209b14', 'combined', 'combined', '2017-02-07 07:02:18', '2017-02-07 07:02:18', 111, 0, 1, 54),
(63, 'aa1a97a6-7178-4337-a2e2-84f42a4d08e1', 'testingNewtoday', 'today', '2017-02-07 07:38:13', '2017-02-07 07:38:13', 111, 0, 1, 54),
(64, '03033a22-8f93-431f-a86b-ebc7ebfb2938', 'Staff', 'Staff to maintain', '2017-02-08 07:52:46', '2017-02-08 07:52:46', 112, 0, 1, 54),
(65, '26d6999e-fd36-4bee-951c-4a845fc15838', 'Manager', 'manager', '2017-02-09 05:03:28', '2017-02-09 05:03:28', 111, 0, 1, 54);

-- --------------------------------------------------------

--
-- Table structure for table `department_domain`
--

CREATE TABLE `department_domain` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_domain`
--

INSERT INTO `department_domain` (`id`, `dept_id`, `domain_id`, `default`) VALUES
(27, 1, 1, 0),
(28, 2, 1, 0),
(29, 3, 1, 0),
(30, 4, 2, 0),
(31, 5, 2, 0),
(32, 6, 2, 0),
(33, 7, 1, 0),
(34, 7, 2, 0),
(35, 8, 1, 0),
(36, 9, 1, 0),
(37, 10, 3, 0),
(38, 11, 3, 0),
(39, 12, 4, 0),
(40, 13, 3, 0),
(41, 14, 5, 0),
(42, 15, 5, 0),
(43, 16, 5, 0),
(44, 17, 5, 0),
(45, 18, 1, 0),
(46, 19, 1, 0),
(47, 20, 1, 0),
(48, 21, 1, 0),
(49, 22, 1, 0),
(50, 23, 6, 0),
(51, 24, 6, 0),
(52, 25, 3, 0),
(53, 26, 7, 0),
(54, 27, 7, 0),
(55, 28, 7, 0),
(56, 29, 7, 0),
(57, 30, 7, 0),
(58, 31, 7, 0),
(59, 32, 7, 0),
(60, 33, 7, 0),
(61, 34, 7, 0),
(62, 35, 7, 0),
(63, 36, 1, 0),
(64, 37, 1, 0),
(65, 38, 1, 0),
(66, 39, 1, 0),
(67, 40, 1, 0),
(68, 41, 3, 0),
(69, 42, 1, 0),
(70, 43, 8, 0),
(71, 44, 8, 0),
(72, 45, 8, 0),
(73, 46, 8, 0),
(74, 47, 1, 0),
(75, 48, 1, 0),
(76, 49, 9, 0),
(77, 50, 1, 0),
(78, 51, 1, 0),
(79, 52, 1, 0),
(80, 53, 1, 0),
(81, 54, 1, 0),
(82, 55, 1, 0),
(83, 56, 1, 0),
(84, 57, 1, 0),
(85, 58, 1, 0),
(86, 59, 1, 0),
(87, 60, 10, 0),
(88, 61, 11, 0),
(89, 62, 11, 0),
(90, 63, 11, 0),
(91, 64, 11, 0),
(92, 65, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `device_token`
--

CREATE TABLE `device_token` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_token`
--

INSERT INTO `device_token` (`id`, `token`, `user_id`, `created_date`, `updated_date`) VALUES
(6, 'be0d0aa9d644bddd8d3103aa47d80287e355687b629aebcea90f693fa3f64c8b', 79, '2017-01-05 12:48:30', '2017-01-05 12:48:30'),
(7, '8577d24b050074656efe3ea39ef4e8d8718033f30bb4db5874970dfeb3f9a3e9', 79, '2017-01-05 13:04:09', '2017-01-05 13:04:09'),
(8, 'd84be24b3289fa808ff7430e40c8e000c0362be816e66c7ceabe02b204d9dac7', 80, '2017-01-05 14:00:06', '2017-01-05 14:00:06'),
(9, '1f4aec0cd3ff7ae30bb51923a97186c31863e4f0a26f320c2ac29c9a8f7555c5', 80, '2017-01-06 11:23:11', '2017-01-06 11:23:11'),
(10, '4a2fb55e8f92d1df5a9f1bfbba88a145bf9eb7b7dcd9e8575ed0c08870c99c3b', 82, '2017-01-11 11:20:54', '2017-01-11 11:20:56'),
(11, '9fb8e4edbe244d70a23ea7967177b260d215ca8aa5fe9142dee82b0f0b0da23b', 89, '2017-01-12 07:32:52', '2017-01-12 07:32:52'),
(12, '94ecc98206168b073cb61e2e9345431a46a12b862162448721ab0d43d32b847c', 85, '2017-01-12 14:59:39', '2017-01-12 14:59:39'),
(13, '8fd2fd65cfd66183ad1bed58f890c2824ae876b251e986a70ee36f132bdce5c3', 90, '2017-01-12 15:28:57', '2017-01-12 15:28:57'),
(14, '623c7b3ac58400defa6e5b7ce8f88923485a2983bbbe1df05bc31638e25244d9', 83, '2017-01-13 08:20:56', '2017-01-13 10:17:49'),
(15, '43c8e5978da887ff71f9c92d330045be473a630986e3fea041f0f5126d5917fc', 95, '2017-01-13 11:05:49', '2017-01-13 11:05:49'),
(16, '26c2dc4858a3ab679f01a5341ca6830d3a7923cdeba640069ae919f667e42559', 91, '2017-01-13 11:08:20', '2017-01-16 09:22:26'),
(17, '4974f9ab5c7b0d4d3e77499f1207ee1d24dfe47a892d6c2071cd02defdf2a0b7', 98, '2017-01-14 06:37:52', '2017-01-14 06:37:52'),
(18, 'dafb61cfb8ecf776135729da3967e1088cd46fe4e625f7c0bfa9a95d70488724', 108, '2017-01-23 06:21:09', '2017-01-23 06:21:09'),
(19, '701784457e0eb4aab8b1f38df90172d78cfef4e3bacd0fbd56b0a51229e67d61', 103, '2017-01-23 06:53:59', '2017-01-23 07:46:20'),
(20, '332bbc7502a4d95025c91f1cab76eb8155683a6c014f6d1b63513284255affbb', 103, '2017-01-24 05:30:29', '2017-01-24 05:30:29'),
(21, 'e8d8ed0d10678c57c2d2cd1a4ba069005d66fc86bf0d7f42d74a2dfbe7066fba', 84, '2017-02-01 08:37:42', '2017-02-01 08:37:42'),
(22, '7a06eba8061154c00072bc55f8052c7d5f340b2b2a44858207333c5bdba3d13f', 113, '2017-02-08 12:49:09', '2017-02-09 09:02:01'),
(23, 'cNeZZZhNjMs:APA91bG4a1idsNFfxRxxKWM1muGY60cVmuSjMeHW9eFKpTROaStz1pVlGeCCBfGyqXfe69ZoibUL8j92xUTyIbglEniZ2jLyn0WIMGkCQZQZjuui6mIX01RNwII5dXvmJRMJx4d5hGzQ', 93, '2017-02-08 13:51:26', '2017-02-08 13:51:26'),
(24, 'eev9OpLw3uw:APA91bGRynFl4jGLsjutt2tGXr6OiM_1nD_pYEgaPBGejy1-rxMoKZcOUSY3e6hkPsC_ZixfPgvctSgqvIYlfu34KE78csSvuwRtxlftKgArkYY8WEeMusCUcw2Q3w2t66huWExeTd0d', 112, '2017-02-09 07:51:32', '2017-02-09 08:02:34'),
(25, 'fY5XoD3wNbM:APA91bHkgjmsVMA8SxgBsPd-qYzh5wNn1TkgY8JbiSFvMPd-lAcsuEEen9lV4o8bMaRyuP3fN4GOST0RLDrF5m4cQo1HSYX330-aEg9w4tZoekgAoke-seKTJWC8TePts8fwS3rEz_2n', 113, '2017-02-09 08:46:23', '2017-02-09 08:47:04'),
(26, 'dJ4fsNNhTBg:APA91bEF-7GkXP-67T1tJfiHTQ2a9PCHgvT0C3D2rj1uuVXxCOFKB7cdQTlyAscOsg0Sk4xNCcOsLe4mldhrqP5jwYr4KuHNvDYyX02OPJvVNoQlSXYGuvV--cAoLnE5Y7JTNbYLinVS', 113, '2017-02-09 09:01:08', '2017-02-09 09:03:14'),
(27, 'fyKQ3Ciu0H4:APA91bHYXEknvwFmzf2XdkA68RyU7iAe-S00mLku37egsfOUdr4x9bj1akC7F7JKqBiVAE8psjepa6wzulN3zQ6kd5fQ5hNGn-8JK5BojkvOu-yTIbHpDrKip-KC-C_am18QgHvGmn_j', 112, '2017-02-14 13:04:15', '2017-02-14 13:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `domain_id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `domain_desc` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `default` enum('0','1') NOT NULL,
  `status` enum('0','1','-1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`domain_id`, `uuid`, `domain_name`, `domain_desc`, `created_at`, `updated_at`, `created_by`, `default`, `status`) VALUES
(1, '4dd76455-0630-4e9a-b4ea-96e5fbf1fbe8', 'Information Technology', 'Information technology', '2016-10-18 03:37:10', '2016-10-18 03:37:10', 1, '0', '1'),
(2, '7aab63a7-6fef-4a75-ab5e-fb1d47043d09', 'Textiles', 'Textile industry', '2016-11-21 05:21:16', '2016-11-22 08:31:38', 1, '', '1'),
(3, '3fc388fe-fcec-4c54-9f25-0f04dfd6b1da', 'Marketing', 'SEO - the action or business of promoting and selling products or services, including market research and advertising.', '2016-12-15 07:41:13', '2016-12-15 07:41:13', 1, '0', '1'),
(4, '4824adc7-cc7b-4293-af25-9687a4a8ab30', 'Audit', 'Find Profit and loss', '2016-12-22 02:05:43', '2016-12-22 02:05:43', 1, '0', '1'),
(5, 'ea2d8670-3c78-477e-a103-cbaf5b16418b', 'Test Default', '', '2017-01-03 06:05:42', '2017-01-03 06:05:42', 1, '0', '1'),
(6, 'b94d54d4-c467-4540-9d83-126154295105', 'testing', 'testinginno', '2017-01-11 07:03:13', '2017-01-11 07:15:44', 1, '', '1'),
(7, '4bfd1278-b825-473e-b0b9-4a64af200234', 'medical -cancer specialist', 'cancer treatment', '2017-01-11 07:50:57', '2017-01-11 07:50:57', 1, '0', '1'),
(8, '686e9fb5-8bd0-41bd-a0a4-4314f2725b33', 'Builders', 'Construction', '2017-01-13 07:54:27', '2017-01-13 07:54:27', 1, '0', '1'),
(9, '6817b579-df82-4fd7-b00d-65b1a0e68a05', 'realestate', 'builders sales and buy', '2017-01-23 01:06:52', '2017-01-23 01:06:52', 1, '0', '1'),
(10, '09ee156c-eae7-4af9-b8f2-552aa3eb2360', 'newIndustry', 'New', '2017-02-02 06:14:37', '2017-02-02 06:14:37', 1, '0', '1'),
(11, '24b08dd1-fed4-446c-afad-f81deb8a86ed', 'pastfuture', 'Dont knew', '2017-02-07 06:56:01', '2017-02-07 06:56:01', 1, '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `domain_country`
--

CREATE TABLE `domain_country` (
  `id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `default` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain_country`
--

INSERT INTO `domain_country` (`id`, `domain_id`, `country_id`, `default`) VALUES
(44, 1, 105, 0),
(45, 2, 105, 0),
(46, 2, 105, 0),
(47, 3, 2, 0),
(48, 4, 2, 0),
(49, 5, 2, 0),
(50, 6, 2, 0),
(51, 6, 2, 0),
(52, 7, 38, 0),
(53, 8, 2, 0),
(54, 9, 105, 0),
(55, 9, 2, 0),
(56, 10, 2, 0),
(57, 11, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fields_master`
--

CREATE TABLE `fields_master` (
  `fields_master_id` int(11) NOT NULL,
  `fields_name` varchar(255) NOT NULL,
  `fields_type` int(1) NOT NULL COMMENT '1-option,2-text,3-file,5-reset,4-submit',
  `status` int(1) NOT NULL COMMENT '1-active,0-inactive',
  `api_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields_master`
--

INSERT INTO `fields_master` (`fields_master_id`, `fields_name`, `fields_type`, `status`, `api_type`) VALUES
(1, 'Textbox', 2, 1, 'element-single-line-text'),
(2, 'Radio', 1, 1, 'element-either-or-choice'),
(3, 'Checkbox', 1, 1, 'element-multi-choice'),
(4, 'Date', 6, 1, 'element-date'),
(5, 'Time', 7, 1, 'element-time'),
(6, 'Textarea', 2, 1, 'element-multi-line-text'),
(7, 'Password', 2, 1, 'element-password'),
(8, 'Dropdown-single', 1, 1, 'element-single-select'),
(9, 'Dropdown-multiple', 1, 1, 'element-multi-select'),
(10, 'E-mail', 2, 1, 'element-email'),
(11, 'File-upload', 3, 1, 'element-single-file'),
(12, 'Date of Birth', 2, 1, 'element-dob'),
(13, 'Reset', 5, 1, 'element-reset'),
(14, 'Submit', 4, 1, 'element-button-submit'),
(15, 'Google-map', 2, 1, 'element-google-map'),
(16, 'Signature', 3, 1, 'element-signature'),
(17, 'heading', 2, 1, 'element-label'),
(18, 'Number', 2, 1, 'element-number');

-- --------------------------------------------------------

--
-- Table structure for table `form_category`
--

CREATE TABLE `form_category` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `form_hierarchy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_category`
--

INSERT INTO `form_category` (`id`, `form_id`, `cat_id`, `form_hierarchy_id`) VALUES
(75, 35, 4, 3),
(76, 36, 4, 4),
(78, 38, 6, 6),
(79, 39, 6, 7),
(80, 40, 4, 8),
(81, 41, 4, 9),
(82, 42, 4, 10),
(83, 43, 4, 11),
(84, 44, 6, 12),
(85, 45, 6, 13),
(86, 46, 6, 14),
(87, 47, 6, 15),
(88, 48, 6, 16),
(89, 49, 6, 17),
(90, 50, 6, 18),
(91, 51, 6, 19),
(92, 52, 6, 20),
(93, 53, 4, 21),
(94, 54, 6, 22),
(95, 55, 6, 23),
(96, 56, 7, 24),
(97, 57, 7, 25),
(98, 58, 7, 26),
(99, 59, 4, 27),
(100, 60, 7, 28),
(101, 61, 4, 29),
(102, 62, 7, 30),
(103, 63, 7, 31),
(104, 64, 7, 32),
(105, 65, 7, 33),
(106, 66, 7, 34),
(107, 67, 7, 35),
(109, 69, 10, 37),
(110, 70, 13, 38),
(111, 71, 13, 39),
(112, 72, 7, 40),
(113, 73, 7, 41),
(114, 74, 21, 42),
(115, 75, 7, 43),
(116, 76, 24, 44),
(117, 77, 15, 45),
(118, 78, 15, 46),
(119, 79, 23, 47),
(120, 80, 7, 48),
(121, 81, 23, 49),
(122, 82, 27, 50),
(123, 83, 27, 51),
(128, 88, 27, 56),
(129, 89, 29, 57),
(130, 90, 29, 58),
(131, 91, 29, 59),
(132, 92, 29, 60);

-- --------------------------------------------------------

--
-- Table structure for table `form_dept`
--

CREATE TABLE `form_dept` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_details`
--

CREATE TABLE `form_details` (
  `form_id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `form_desc` text NOT NULL,
  `form_content` text NOT NULL,
  `default` enum('0','1') NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `response_to` varchar(255) DEFAULT NULL,
  `due_date` varchar(255) NOT NULL,
  `assign_to` varchar(255) DEFAULT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_details`
--

INSERT INTO `form_details` (`form_id`, `uuid`, `form_name`, `form_desc`, `form_content`, `default`, `status`, `created_at`, `updated_at`, `created_by`, `response_to`, `due_date`, `assign_to`, `org_id`) VALUES
(35, '3d48db39-e4d2-4532-b5c2-23b8ef454325', 'Sample', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"142\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"143\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-07 08:38:43', '2016-12-07 08:38:43', 0, NULL, '', 'user', 33),
(36, '26355cc7-1ab3-4c91-88f9-f829b71c0cca', 'Test Form', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"144\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"145\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"146\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-07 08:46:50', '2016-12-07 08:46:50', 0, NULL, '', 'workflow', 33),
(38, '6ff1f40d-f6cf-479c-9beb-7a255cfb4da7', 'Tech test', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"148\",\"type\":\"heading\",\"title\":\"User \",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"11\",\"formfieldid\":\"149\",\"type\":\"file\",\"title\":\"File Upload\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"}],[{\"fieldid\":\"5\",\"formfieldid\":\"150\",\"type\":\"time\",\"title\":\"Time\",\"format\":\"hh:mm:ss\",\"required\":\"0\",\"api_type\":\"element-time\",\"fieldtype\":\"7\"},{\"fieldid\":\"16\",\"formfieldid\":\"151\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-08 06:09:56', '2016-12-08 06:09:56', 0, NULL, '', '', 34),
(39, '61bd0b20-68dc-4df7-9c24-b6d6960e64ad', 'Support 1', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"152\",\"type\":\"text\",\"title\":\"Issue\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"4\",\"formfieldid\":\"153\",\"type\":\"date\",\"title\":\"Date\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"fieldid\":\"11\",\"formfieldid\":\"154\",\"type\":\"file\",\"title\":\"File Upload\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"},{\"fieldid\":\"16\",\"formfieldid\":\"155\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-08 07:24:45', '2016-12-08 07:24:45', 0, NULL, '', 'user', 34),
(40, '4f1a4306-b1a3-4f1a-a4dc-3801d2473916', 'test', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"156\",\"type\":\"heading\",\"title\":\"Title\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-08 08:41:46', '2016-12-08 08:41:46', 0, NULL, '', 'workflow', 33),
(41, '998db73c-68f0-4c0c-b7b2-c78502fe66a6', 'test', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"157\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-08 08:42:12', '2016-12-08 08:42:12', 0, NULL, '', 'workflow', 33),
(42, '25df5c23-bc5e-497a-a0e6-ad700af3429b', 'Sample Forms', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"158\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"159\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-08 08:45:07', '2016-12-08 08:45:07', 0, NULL, '', 'workflow', 33),
(43, '7500c6b4-cd25-40c7-b93e-1ad61ff71a85', 'Sample', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"160\",\"type\":\"heading\",\"title\":\"Sample\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"161\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"162\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"163\",\"type\":\"textarea\",\"title\":\"Multi Line Text\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"164\",\"type\":\"radio\",\"title\":\"Do you have a mobile?\",\"choices\":[{\"title\":\"Yes\",\"id\":\"71\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"72\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"8\",\"formfieldid\":\"165\",\"type\":\"select\",\"title\":\"Single Select Label\",\"choices\":[{\"title\":\"First Option\",\"id\":\"73\",\"checked\":\"0\"},{\"title\":\"Second Option\",\"id\":\"74\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-single-select\",\"fieldtype\":\"1\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-14 09:31:10', '2016-12-14 09:31:10', 0, NULL, '', '', 1),
(44, '199229ee-bdf3-4365-a6d9-ae492c069144', 'a', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"166\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"167\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"168\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-15 06:14:53', '2016-12-15 06:14:53', 0, NULL, '', 'dept', 34),
(45, 'f593c01e-a14b-44f7-a6cb-c052794a9440', 'a', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"169\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"170\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"171\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-15 06:17:24', '2016-12-15 06:17:24', 0, NULL, '', 'dept', 34),
(46, 'f09d14ed-f8ba-40cb-9cda-370fabbdaec2', 'a', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"172\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"173\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"174\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-15 06:17:30', '2016-12-15 06:17:30', 0, NULL, '', 'dept', 34),
(47, '456be80f-a8de-4933-8d58-517cae67193d', 'a', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"175\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"176\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"177\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-15 06:17:36', '2016-12-15 06:17:36', 0, NULL, '', 'dept', 34),
(48, '20dbb511-a43e-413a-b3d8-c3eb40a1717b', 'hgfghf', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"178\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:20:08', '2016-12-15 06:20:08', 0, NULL, '', 'user', 34),
(49, '07abc7f7-5b9a-41c1-9707-9a0163db9a1d', 'hgfghf', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"179\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:20:16', '2016-12-15 06:20:16', 0, NULL, '', 'user', 34),
(50, '78c60095-a49f-41c5-ac2f-e0432f33b88a', 'Yrtsdrt', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"180\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"},{\"fieldid\":\"17\",\"formfieldid\":\"181\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:22:35', '2016-12-15 06:22:35', 0, NULL, '', 'user', 34),
(51, '6380865e-ffce-4820-86ba-066037e4fccd', 'Yrtsdrt', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"182\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"},{\"fieldid\":\"17\",\"formfieldid\":\"183\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:24:50', '2016-12-15 06:24:50', 0, NULL, '', 'user', 34),
(52, '86147093-881e-4775-b73a-2c2abaf82823', 'Yrtsdrt', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"184\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"},{\"fieldid\":\"17\",\"formfieldid\":\"185\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:25:24', '2016-12-15 06:25:24', 0, NULL, '', 'user', 34),
(53, '8139749e-16a0-4a95-ad3a-a811748a4251', 'saamp', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"186\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"187\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"188\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:46:23', '2016-12-15 06:46:23', 0, NULL, '', 'workflow', 33),
(54, '06e4f13d-44d7-4e0d-a0c5-db1fde550777', 'sa', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"189\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"},{\"fieldid\":\"6\",\"formfieldid\":\"190\",\"type\":\"textarea\",\"title\":\"Multi Line Text\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"191\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"},{\"fieldid\":\"18\",\"formfieldid\":\"192\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"193\",\"type\":\"radio\",\"title\":\"Radio\",\"choices\":[{\"title\":\"Yes\",\"id\":\"75\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"76\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"},{\"fieldid\":\"8\",\"formfieldid\":\"194\",\"type\":\"select\",\"title\":\"Single Select Label\",\"choices\":[{\"title\":\"First Option\",\"id\":\"77\",\"checked\":\"0\"},{\"title\":\"Second Option\",\"id\":\"78\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-single-select\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"3\",\"formfieldid\":\"195\",\"type\":\"checkbox\",\"title\":\"Multi choice\",\"choices\":[{\"title\":\"First Option\",\"id\":\"79\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-multi-choice\",\"fieldtype\":\"1\"},{\"fieldid\":\"11\",\"formfieldid\":\"196\",\"type\":\"file\",\"title\":\"File Upload\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"},{\"fieldid\":\"5\",\"formfieldid\":\"197\",\"type\":\"time\",\"title\":\"Time\",\"format\":\"hh:mm:ss\",\"required\":\"0\",\"api_type\":\"element-time\",\"fieldtype\":\"7\"}],[{\"fieldid\":\"16\",\"formfieldid\":\"198\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 06:51:07', '2016-12-15 06:51:07', 0, NULL, '', 'user', 34),
(55, 'f16b8787-2fb1-4014-be9f-39736e934f53', 'hgfghf', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"199\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 07:07:12', '2016-12-15 07:07:12', 0, NULL, '', 'user', 34),
(56, '671259d7-2509-49cf-ac3f-b1d45d77fe20', 'FAVOURITE ADD', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"200\",\"type\":\"heading\",\"title\":\"Your favourite add\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"201\",\"type\":\"text\",\"title\":\"Your area\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"202\",\"type\":\"email\",\"title\":\"Your email ID\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"203\",\"type\":\"textarea\",\"title\":\"What you see in add\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"4\",\"formfieldid\":\"204\",\"type\":\"date\",\"title\":\"Date\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"fieldid\":\"16\",\"formfieldid\":\"205\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 09:24:36', '2016-12-15 09:24:36', 0, NULL, '', 'user', 35),
(57, '42986acc-f4b9-4712-9465-691dc912f7f6', 'Test', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"206\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"207\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"10\",\"formfieldid\":\"208\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 09:30:23', '2016-12-15 09:30:23', 0, NULL, '', 'workflow', 35),
(58, '8eb37c44-52f9-4dc3-9386-e9e98f34e19f', 'Review', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"209\",\"type\":\"heading\",\"title\":\"Product Details\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"210\",\"type\":\"text\",\"title\":\"Product Name \",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"211\",\"type\":\"textarea\",\"title\":\"Product Descr\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"3\",\"formfieldid\":\"212\",\"type\":\"checkbox\",\"title\":\"Age group\",\"choices\":[{\"title\":\"20-30\",\"id\":\"80\",\"checked\":\"0\"},{\"title\":\"30-40\",\"id\":\"81\",\"checked\":\"0\"},{\"title\":\"40-60\",\"id\":\"82\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-multi-choice\",\"fieldtype\":\"1\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-15 09:37:29', '2016-12-15 09:37:29', 0, NULL, '', 'workflow', 35),
(59, 'b69cd612-dd15-4f79-a7b6-2e162e054afa', 'Samlle2', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"213\",\"type\":\"heading\",\"title\":\"\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-16 06:07:20', '2016-12-16 06:07:20', 0, NULL, '', 'workflow', 33),
(60, '37502950-8dab-4b30-a38f-3284aa658c69', 'Feedback - Food Festival - Team 2', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"214\",\"type\":\"heading\",\"title\":\"Feedback - Food Festival - 2016\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"215\",\"type\":\"text\",\"title\":\"First Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"216\",\"type\":\"text\",\"title\":\"Middle Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"217\",\"type\":\"text\",\"title\":\"Last Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"218\",\"type\":\"text\",\"title\":\"Employee ID\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"10\",\"formfieldid\":\"219\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"},{\"fieldid\":\"8\",\"formfieldid\":\"220\",\"type\":\"select\",\"title\":\"Department\",\"choices\":[{\"title\":\"Mobile\",\"id\":\"83\",\"checked\":\"0\"},{\"title\":\"Magento\",\"id\":\"84\",\"checked\":\"0\"},{\"title\":\"Drupal\",\"id\":\"85\",\"checked\":\"0\"},{\"title\":\"Design\",\"id\":\"86\",\"checked\":\"0\"},{\"title\":\"QA\",\"id\":\"87\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-single-select\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"221\",\"type\":\"heading\",\"title\":\"Food Varities\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"},{\"fieldid\":\"2\",\"formfieldid\":\"222\",\"type\":\"radio\",\"title\":\"\",\"choices\":[{\"title\":\"One\",\"id\":\"88\",\"checked\":\"0\"},{\"title\":\"Two\",\"id\":\"89\",\"checked\":\"0\"},{\"title\":\"Three\",\"id\":\"90\",\"checked\":\"0\"},{\"title\":\"Four\",\"id\":\"91\",\"checked\":\"0\"},{\"title\":\"Five\",\"id\":\"92\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"223\",\"type\":\"heading\",\"title\":\"Food Taste\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"224\",\"type\":\"heading\",\"title\":\"Food Quality\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"225\",\"type\":\"heading\",\"title\":\"Quality Of Service\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-16 07:51:14', '2016-12-16 07:51:14', 0, NULL, '', 'user', 35),
(61, '8f479041-80ec-423e-9ac4-d84b198a252f', 'Test', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"226\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"227\",\"type\":\"radio\",\"title\":\"Radio\",\"choices\":[{\"title\":\"Rajesh\",\"id\":\"93\",\"checked\":\"0\"},{\"title\":\"Kannan\",\"id\":\"94\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2016-12-19 01:06:30', '2016-12-19 01:06:30', 0, NULL, '', 'user', 33),
(62, '375d0cfb-0923-40d1-a00b-1ceaabae03af', 'Montly', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"228\",\"type\":\"heading\",\"title\":\"Balance sheet\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"11\",\"formfieldid\":\"229\",\"type\":\"file\",\"title\":\"File Upload\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-22 05:17:23', '2016-12-22 05:17:23', 0, NULL, '', '', 38),
(63, 'fb9e20fd-2655-46bd-8326-b50cee6637fe', 'Risk ratio', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"230\",\"type\":\"heading\",\"title\":\"Risk Ratio\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"231\",\"type\":\"textarea\",\"title\":\"Risk Description\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"4\",\"formfieldid\":\"232\",\"type\":\"date\",\"title\":\"Date\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"233\",\"type\":\"number\",\"title\":\"Ratio\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"fieldid\":\"11\",\"formfieldid\":\"234\",\"type\":\"file\",\"title\":\"File Upload\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"},{\"fieldid\":\"16\",\"formfieldid\":\"235\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-22 05:28:33', '2016-12-22 05:28:33', 0, NULL, '', 'workflow', 38),
(64, 'f5d49c3d-2d82-47cc-8251-893874750953', 'sdsd', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"236\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-22 05:48:36', '2016-12-22 05:48:36', 0, NULL, '', 'workflow', 38),
(65, '5b1eab57-b9ae-436e-9bd5-ef32522cc733', 'sdsd', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"237\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-22 05:56:30', '2016-12-22 05:56:30', 0, NULL, '', 'workflow', 38),
(66, '356221af-c844-4439-bd87-b7fe954db9fa', 'sdfsdf', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"238\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-22 06:03:39', '2016-12-22 06:03:39', 0, NULL, '', 'workflow', 38),
(67, '3dde66d7-b46a-4bff-afba-b38c529675a9', 'Test', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"239\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2016-12-22 06:09:59', '2016-12-22 06:09:59', 0, NULL, '', 'workflow', 38),
(69, 'd1e396a7-c0cb-4d66-bcfa-8fed9cb0bfd5', 'Test Forms default', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"243\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"244\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"245\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":null,\"fieldtype\":\"\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2017-01-03 06:19:38', '2017-01-03 06:19:38', 1, NULL, '', '', 1),
(70, '061233d3-6699-421e-8d3f-facd75d83380', 'Test Forms default', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"246\",\"type\":\"text\",\"title\":\"Single Line Text\\n\\t                        \\n\\t                        \\n\\t                        \\n\\t                        \\n\\t                        \\n\\t                        \\n\\t                        \\n\\t                        \",\"required\":\"1\",\"api_type\":\"element-single-line-text\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"247\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"1\",\"api_type\":\"element-email\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"248\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"1\",\"api_type\":null}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-03 06:21:06', '2017-01-03 06:54:56', 78, NULL, '', 'user', 41),
(71, '965465b0-bf27-48bb-9016-84eee4f5e9cb', 'Test workflow', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"249\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"250\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-03 06:55:28', '2017-01-03 06:55:28', 78, NULL, '', 'workflow', 41),
(72, 'a775ad8d-412c-4b93-80d3-3eb23d9e6480', 'testing', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"251\",\"type\":\"heading\",\"title\":\"Testing\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"252\",\"type\":\"textarea\",\"title\":\"Welcome\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"4\",\"formfieldid\":\"253\",\"type\":\"date\",\"title\":\"Date\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-11 07:50:37', '2017-01-11 07:50:37', 84, NULL, '', 'workflow', 43),
(73, '654543a9-8326-4e9a-af37-02d9e1e034cc', 'TesterTesting', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"254\",\"type\":\"heading\",\"title\":\"Fill the Form\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"11\",\"formfieldid\":\"255\",\"type\":\"file\",\"title\":\"Resume\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"},{\"fieldid\":\"16\",\"formfieldid\":\"256\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-12 02:30:22', '2017-01-12 02:30:22', 84, NULL, '', 'user', 43),
(74, 'ff06f646-fcd2-458d-ab21-c195df1cc16d', 'QAT IN ACTION', '', '{\"fields\":[[[{\"fieldid\":\"18\",\"formfieldid\":\"258\",\"type\":\"number\",\"title\":\"TEST 2\",\"required\":\"1\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"},{\"fieldid\":\"2\",\"formfieldid\":\"259\",\"type\":\"radio\",\"title\":\"RADIO BUTTON \",\"choices\":[{\"title\":\"Yes\",\"id\":\"95\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"96\",\"checked\":\"0\"}],\"required\":\"1\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"},{\"fieldid\":\"18\",\"formfieldid\":\"0\",\"type\":\"number\",\"title\":\"TEEST\",\"required\":\"1\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"5\",\"formfieldid\":\"260\",\"type\":\"time\",\"title\":\"Time\",\"format\":\"HH:mm:ss\",\"required\":\"1\",\"api_type\":\"element-time\",\"fieldtype\":\"7\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-12 02:32:16', '2017-01-12 02:55:35', 88, NULL, '', 'dept', 46),
(75, '9da9164e-503f-4326-82d3-0b4ee47147d9', 'new', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"262\",\"type\":\"text\",\"title\":\"name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"11\",\"formfieldid\":\"263\",\"type\":\"file\",\"title\":\"File Upload\",\"required\":\"0\",\"api_type\":\"element-single-file\",\"fieldtype\":\"3\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"264\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-12 09:06:57', '2017-01-12 09:06:57', 84, NULL, '', 'user', 43),
(76, '50ba5c02-7be9-4203-bf58-78de62674e23', 'PF Details', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"265\",\"type\":\"heading\",\"title\":\"PF Details\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"266\",\"type\":\"text\",\"title\":\"First name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"267\",\"type\":\"text\",\"title\":\"Last Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"268\",\"type\":\"number\",\"title\":\"Employee ID\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"269\",\"type\":\"number\",\"title\":\"PF Account Number\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"},{\"fieldid\":\"18\",\"formfieldid\":\"270\",\"type\":\"number\",\"title\":\"PAN Card number\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"271\",\"type\":\"radio\",\"title\":\"Working Status\",\"choices\":[{\"title\":\"Working\",\"id\":\"97\",\"checked\":\"0\"},{\"title\":\"Relieved\",\"id\":\"98\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"3\",\"formfieldid\":\"272\",\"type\":\"checkbox\",\"title\":\"PF Details available for years\",\"choices\":[{\"title\":\"2014\",\"id\":\"99\",\"checked\":\"0\"},{\"title\":\"2015\",\"id\":\"100\",\"checked\":\"0\"},{\"title\":\"2016\",\"id\":\"101\",\"checked\":\"0\"},{\"title\":\"2017\",\"id\":\"102\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-multi-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"16\",\"formfieldid\":\"273\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2017-01-12 09:16:50', '2017-01-13 06:03:16', 91, NULL, '', 'workflow', 47),
(77, '8781b74a-b03c-4b80-ac01-de357d0a5269', 'Check Forms', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"274\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-12 02:05:22', '2017-01-12 02:05:22', 81, NULL, '', 'user', 42),
(78, 'f928f36f-1a3b-41c0-8f18-d5af7695f76c', 'Check Reporting', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"275\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"18\",\"formfieldid\":\"276\",\"type\":\"number\",\"title\":\"Number\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-12 02:05:48', '2017-01-12 02:05:48', 81, NULL, '', 'workflow', 42),
(79, '8d6801c7-2b75-455a-9b14-0c544b843371', 'Manpower Requisition Form', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"277\",\"type\":\"text\",\"title\":\"MRF ID\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"4\",\"formfieldid\":\"278\",\"type\":\"date\",\"title\":\"Date of Requirement\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"279\",\"type\":\"text\",\"title\":\"Reporting Manager Name\\/ Emp ID\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"280\",\"type\":\"text\",\"title\":\"Department\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"281\",\"type\":\"text\",\"title\":\"Designation \\/ Role \\/ Level\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"18\",\"formfieldid\":\"282\",\"type\":\"number\",\"title\":\"No of Positions\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"283\",\"type\":\"text\",\"title\":\"New \\/ Replacement\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"284\",\"type\":\"text\",\"title\":\"Permanent \\/ Contract\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"285\",\"type\":\"text\",\"title\":\"Location\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"286\",\"type\":\"heading\",\"title\":\"Please answer the queries as Yes (Y) or No (N) only:\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"287\",\"type\":\"radio\",\"title\":\"Has the option of clubbing this job with another role holder considered\",\"choices\":[{\"title\":\"Yes\",\"id\":\"103\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"104\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"288\",\"type\":\"radio\",\"title\":\"Has the option of internal promotion considered for this role\",\"choices\":[{\"title\":\"Yes\",\"id\":\"105\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"106\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"289\",\"type\":\"radio\",\"title\":\"Age \\/ Gender (Preference)\",\"choices\":[{\"title\":\"Male\",\"id\":\"107\",\"checked\":\"0\"},{\"title\":\"Female\",\"id\":\"108\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"290\",\"type\":\"text\",\"title\":\"Basic Qualification\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"291\",\"type\":\"text\",\"title\":\"Experience Range (Min - Max)\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"292\",\"type\":\"textarea\",\"title\":\"Mandatory Skills\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"16\",\"formfieldid\":\"293\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-13 06:00:58', '2017-01-13 06:04:00', 93, NULL, '', 'workflow', 47),
(80, '442061a7-1bf2-456b-9aa0-589810fb888b', 'Test Wworkflow', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"294\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2017-01-13 06:15:14', '2017-01-13 06:15:21', 84, NULL, '', 'workflow', 43),
(81, 'd478c898-884c-4890-80ca-01f752e64d60', 'Profile Form', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"295\",\"type\":\"heading\",\"title\":\"Profile Form\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"296\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"297\",\"type\":\"text\",\"title\":\"Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-13 07:06:09', '2017-01-13 07:06:09', 91, NULL, '', 'workflow', 47),
(82, 'd3c0127f-967f-42cb-b0e9-cfcc327c471f', 'Construction Release of Liability', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"298\",\"type\":\"heading\",\"title\":\"Construction Release of Liability\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"299\",\"type\":\"text\",\"title\":\"Construction company name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"300\",\"type\":\"textarea\",\"title\":\"Address\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"301\",\"type\":\"text\",\"title\":\"Location\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"302\",\"type\":\"text\",\"title\":\"State\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"303\",\"type\":\"number\",\"title\":\"Tel no\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"},{\"fieldid\":\"18\",\"formfieldid\":\"304\",\"type\":\"number\",\"title\":\"Mobile No\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"305\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"306\",\"type\":\"text\",\"title\":\"Employee Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"307\",\"type\":\"text\",\"title\":\"Job Title\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"308\",\"type\":\"text\",\"title\":\"Employee Number\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"309\",\"type\":\"text\",\"title\":\"Job Status\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"310\",\"type\":\"textarea\",\"title\":\"Address\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"311\",\"type\":\"text\",\"title\":\"Location\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"1\",\"formfieldid\":\"312\",\"type\":\"text\",\"title\":\"State\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"313\",\"type\":\"number\",\"title\":\"Tel No\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"},{\"fieldid\":\"18\",\"formfieldid\":\"314\",\"type\":\"number\",\"title\":\"Mobile No\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-13 09:14:19', '2017-01-14 01:47:29', 99, NULL, '', 'workflow', 49);
INSERT INTO `form_details` (`form_id`, `uuid`, `form_name`, `form_desc`, `form_content`, `default`, `status`, `created_at`, `updated_at`, `created_by`, `response_to`, `due_date`, `assign_to`, `org_id`) VALUES
(83, '6344b7e4-caaa-4654-bb34-6af0efb75a5c', 'Commercial Construction', '', '{\"fields\":[[[{\"fieldid\":\"4\",\"formfieldid\":\"315\",\"type\":\"date\",\"title\":\"Date\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"316\",\"type\":\"textarea\",\"title\":\"Job Site Address\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"317\",\"type\":\"text\",\"title\":\"Name of Business\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"318\",\"type\":\"text\",\"title\":\"Name of Project\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"319\",\"type\":\"text\",\"title\":\"Name of General Contractor\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"320\",\"type\":\"textarea\",\"title\":\"Address\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"321\",\"type\":\"text\",\"title\":\"Description of construction\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"322\",\"type\":\"radio\",\"title\":\"Isn\'t a new construction\",\"choices\":[{\"title\":\"Yes\",\"id\":\"109\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"110\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"},{\"fieldid\":\"2\",\"formfieldid\":\"323\",\"type\":\"radio\",\"title\":\"Are you remodelling the building\",\"choices\":[{\"title\":\"Yes\",\"id\":\"111\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"112\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"324\",\"type\":\"heading\",\"title\":\"Project Details\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"325\",\"type\":\"text\",\"title\":\"Total Project cost $\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"4\",\"formfieldid\":\"326\",\"type\":\"date\",\"title\":\"Deadline of the project\",\"format\":\"MM\\/dd\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"327\",\"type\":\"number\",\"title\":\"How many people will be working directly in this project\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"16\",\"formfieldid\":\"328\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-13 09:20:37', '2017-01-13 10:43:33', 99, NULL, '', 'workflow', 49),
(88, '6ed02677-e466-4773-bc39-268607189ff8', 'Construction Bid', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"357\",\"type\":\"text\",\"title\":\"Constructor Name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"358\",\"type\":\"textarea\",\"title\":\"Address\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"359\",\"type\":\"number\",\"title\":\"Phone Number\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"10\",\"formfieldid\":\"360\",\"type\":\"email\",\"title\":\"Email Address\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"361\",\"type\":\"text\",\"title\":\"Project Site\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"6\",\"formfieldid\":\"362\",\"type\":\"textarea\",\"title\":\"Description of the project\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"363\",\"type\":\"number\",\"title\":\"Lump Sum bid price $\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"364\",\"type\":\"heading\",\"title\":\"Contractor\'s fee will be determined with the following\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"365\",\"type\":\"number\",\"title\":\"Payroll costs $\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"366\",\"type\":\"number\",\"title\":\"Material and Equipments $\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"367\",\"type\":\"number\",\"title\":\"Payment for Sub contractor $\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"368\",\"type\":\"number\",\"title\":\"Payment for special consultant $\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"18\",\"formfieldid\":\"369\",\"type\":\"number\",\"title\":\"Maximum amount payable to contractor will not exceed $\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"16\",\"formfieldid\":\"370\",\"type\":\"signature\",\"title\":\"Signature\",\"required\":\"0\",\"api_type\":\"element-signature\",\"fieldtype\":\"3\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-13 11:06:49', '2017-01-13 11:10:43', 99, NULL, '', 'workflow', 49),
(89, 'e6947450-6139-4083-a689-a6337c153987', 'CHANDU', '', '{\"fields\":[[[{\"fieldid\":\"4\",\"formfieldid\":\"371\",\"type\":\"date\",\"title\":\"Date\",\"format\":\"dd\\/MM\\/yyyy\",\"required\":\"0\",\"api_type\":\"element-date\",\"fieldtype\":\"6\"},{\"fieldid\":\"18\",\"formfieldid\":\"372\",\"type\":\"number\",\"title\":\"phone\",\"required\":\"0\",\"api_type\":\"element-number\",\"fieldtype\":\"2\"},{\"fieldid\":\"10\",\"formfieldid\":\"373\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"17\",\"formfieldid\":\"374\",\"type\":\"heading\",\"title\":\"TEST\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"375\",\"type\":\"text\",\"title\":\"NOTIFICATION\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '0', '2017-01-23 01:13:29', '2017-01-23 01:13:29', 107, NULL, '', '', 51),
(90, 'db1d26ab-a60e-463b-b5b2-d11a75ec9b96', 'pot', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"376\",\"type\":\"text\",\"title\":\"first name\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-23 01:25:42', '2017-01-23 01:25:42', 107, NULL, '', 'dept', 51),
(91, 'd4c37419-0444-4070-94c5-973a5c0c9fbe', 'plop', '', '{\"fields\":[[[{\"fieldid\":\"1\",\"formfieldid\":\"377\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"10\",\"formfieldid\":\"378\",\"type\":\"email\",\"title\":\"Email\",\"required\":\"0\",\"api_type\":\"element-email\",\"fieldtype\":\"2\"},{\"fieldid\":\"17\",\"formfieldid\":\"379\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"2\",\"formfieldid\":\"380\",\"type\":\"radio\",\"title\":\"Radio\",\"choices\":[{\"title\":\"Yes\",\"id\":\"121\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"122\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-either-or-choice\",\"fieldtype\":\"1\"},{\"fieldid\":\"6\",\"formfieldid\":\"381\",\"type\":\"textarea\",\"title\":\"Multi Line Text\",\"required\":\"0\",\"api_type\":\"element-multi-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"17\",\"formfieldid\":\"382\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"fieldid\":\"1\",\"formfieldid\":\"383\",\"type\":\"text\",\"title\":\"Single Line Text\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"},{\"fieldid\":\"3\",\"formfieldid\":\"384\",\"type\":\"checkbox\",\"title\":\"Multi choice\",\"choices\":[{\"title\":\"First Option\",\"id\":\"123\",\"checked\":\"0\"}],\"required\":\"0\",\"api_type\":\"element-multi-choice\",\"fieldtype\":\"1\"},{\"fieldid\":\"1\",\"formfieldid\":\"385\",\"type\":\"text\",\"title\":\"\",\"required\":\"0\",\"api_type\":\"element-single-line-text\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-23 02:15:24', '2017-01-23 02:15:24', 107, NULL, '', 'dept', 51),
(92, 'a6cdf326-3266-4341-b72d-c2ee1c3e0216', 'Rasdasd', '', '{\"fields\":[[[{\"fieldid\":\"17\",\"formfieldid\":\"386\",\"type\":\"heading\",\"title\":\"Heading\",\"required\":\"0\",\"api_type\":\"element-label\",\"fieldtype\":\"2\"}],[{\"type\":\"reset\",\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\"},{\"type\":\"submit\",\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\"}]]]}', '1', '1', '2017-01-23 02:29:22', '2017-01-23 02:29:22', 107, NULL, '', 'user', 51);

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `form_fields_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `page` int(1) NOT NULL,
  `row` int(1) NOT NULL,
  `col` int(1) NOT NULL,
  `field_id` int(2) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8 NOT NULL,
  `placeholder` varchar(255) CHARACTER SET utf8 NOT NULL,
  `survey_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Form id from form_details table';

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`form_fields_id`, `form_id`, `page`, `row`, `col`, `field_id`, `question`, `placeholder`, `survey_name`) VALUES
(142, 35, 0, 0, 0, 17, 'Heading', '', ''),
(143, 35, 0, 1, 0, 1, 'Single Line Text', '', ''),
(144, 36, 0, 0, 0, 17, 'Heading', '', ''),
(145, 36, 0, 1, 0, 1, 'Single Line Text', '', ''),
(146, 36, 0, 2, 0, 10, 'Email', '', ''),
(148, 38, 0, 0, 0, 17, 'User ', '', ''),
(149, 38, 0, 1, 0, 11, 'File Upload', '', ''),
(150, 38, 0, 2, 0, 5, 'Time', '', ''),
(151, 38, 0, 2, 1, 16, 'Signature', '', ''),
(152, 39, 0, 0, 0, 1, 'Issue', '', ''),
(153, 39, 0, 0, 1, 4, 'Date', '', ''),
(154, 39, 0, 1, 0, 11, 'File Upload', '', ''),
(155, 39, 0, 1, 1, 16, 'Signature', '', ''),
(156, 40, 0, 0, 0, 17, 'Title', '', ''),
(157, 41, 0, 0, 0, 17, 'Heading', '', ''),
(158, 42, 0, 0, 0, 17, 'Heading', '', ''),
(159, 42, 0, 1, 0, 1, 'Single Line Text', '', ''),
(160, 43, 0, 0, 0, 17, 'Sample', '', ''),
(161, 43, 0, 1, 0, 1, 'Single Line Text', '', ''),
(162, 43, 0, 2, 0, 10, 'Email', '', ''),
(163, 43, 0, 3, 0, 6, 'Multi Line Text', '', ''),
(164, 43, 0, 4, 0, 2, 'Do you have a mobile?', '', ''),
(165, 43, 0, 5, 0, 8, 'Single Select Label', '', ''),
(166, 44, 0, 0, 0, 17, 'Heading', '', ''),
(167, 44, 0, 1, 0, 10, 'Email', '', ''),
(168, 44, 0, 2, 0, 18, 'Number', '', ''),
(169, 45, 0, 0, 0, 17, 'Heading', '', ''),
(170, 45, 0, 1, 0, 10, 'Email', '', ''),
(171, 45, 0, 2, 0, 18, 'Number', '', ''),
(172, 46, 0, 0, 0, 17, 'Heading', '', ''),
(173, 46, 0, 1, 0, 10, 'Email', '', ''),
(174, 46, 0, 2, 0, 18, 'Number', '', ''),
(175, 47, 0, 0, 0, 17, 'Heading', '', ''),
(176, 47, 0, 1, 0, 10, 'Email', '', ''),
(177, 47, 0, 2, 0, 18, 'Number', '', ''),
(178, 48, 0, 0, 0, 17, 'Heading', '', ''),
(179, 49, 0, 0, 0, 17, 'Heading', '', ''),
(180, 50, 0, 0, 0, 17, 'Heading', '', ''),
(181, 50, 0, 0, 1, 17, 'Heading', '', ''),
(182, 51, 0, 0, 0, 17, 'Heading', '', ''),
(183, 51, 0, 0, 1, 17, 'Heading', '', ''),
(184, 52, 0, 0, 0, 17, 'Heading', '', ''),
(185, 52, 0, 0, 1, 17, 'Heading', '', ''),
(186, 53, 0, 0, 0, 1, 'Single Line Text', '', ''),
(187, 53, 0, 0, 1, 1, 'Single Line Text', '', ''),
(188, 53, 0, 0, 2, 1, 'Single Line Text', '', ''),
(189, 54, 0, 0, 0, 17, 'Heading', '', ''),
(190, 54, 0, 0, 1, 6, 'Multi Line Text', '', ''),
(191, 54, 0, 1, 0, 10, 'Email', '', ''),
(192, 54, 0, 1, 1, 18, 'Number', '', ''),
(193, 54, 0, 2, 0, 2, 'Radio', '', ''),
(194, 54, 0, 2, 1, 8, 'Single Select Label', '', ''),
(195, 54, 0, 3, 0, 3, 'Multi choice', '', ''),
(196, 54, 0, 3, 1, 11, 'File Upload', '', ''),
(197, 54, 0, 3, 2, 5, 'Time', '', ''),
(198, 54, 0, 4, 0, 16, 'Signature', '', ''),
(199, 55, 0, 0, 0, 17, 'Heading', '', ''),
(200, 56, 0, 0, 0, 17, 'Your favourite add', '', ''),
(201, 56, 0, 1, 0, 1, 'Your area', '', ''),
(202, 56, 0, 2, 0, 10, 'Your email ID', '', ''),
(203, 56, 0, 3, 0, 6, 'What you see in add', '', ''),
(204, 56, 0, 3, 1, 4, 'Date', '', ''),
(205, 56, 0, 4, 0, 16, 'Signature', '', ''),
(206, 57, 0, 0, 0, 17, 'Heading', '', ''),
(207, 57, 0, 1, 0, 1, 'Single Line Text', '', ''),
(208, 57, 0, 1, 1, 10, 'Email', '', ''),
(209, 58, 0, 0, 0, 17, 'Product Details', '', ''),
(210, 58, 0, 1, 0, 1, 'Product Name ', '', ''),
(211, 58, 0, 2, 0, 6, 'Product Descr', '', ''),
(212, 58, 0, 3, 0, 3, 'Age group', '', ''),
(213, 59, 0, 0, 0, 17, '', '', ''),
(214, 60, 0, 0, 0, 17, 'Feedback - Food Festival - 2016', '', ''),
(215, 60, 0, 1, 0, 1, 'First Name', '', ''),
(216, 60, 0, 1, 1, 1, 'Middle Name', '', ''),
(217, 60, 0, 1, 2, 1, 'Last Name', '', ''),
(218, 60, 0, 2, 0, 1, 'Employee ID', '', ''),
(219, 60, 0, 2, 1, 10, 'Email', '', ''),
(220, 60, 0, 2, 2, 8, 'Department', '', ''),
(221, 60, 0, 3, 0, 17, 'Food Varities', '', ''),
(222, 60, 0, 3, 1, 2, '', '', ''),
(223, 60, 0, 4, 0, 17, 'Food Taste', '', ''),
(224, 60, 0, 5, 0, 17, 'Food Quality', '', ''),
(225, 60, 0, 6, 0, 17, 'Quality Of Service', '', ''),
(226, 61, 0, 0, 0, 1, 'Single Line Text', '', ''),
(227, 61, 0, 1, 0, 2, 'Radio', '', ''),
(228, 62, 0, 0, 0, 17, 'Balance sheet', '', ''),
(229, 62, 0, 1, 0, 11, 'File Upload', '', ''),
(230, 63, 0, 0, 0, 17, 'Risk Ratio', '', ''),
(231, 63, 0, 1, 0, 6, 'Risk Description', '', ''),
(232, 63, 0, 2, 0, 4, 'Date', '', ''),
(233, 63, 0, 3, 0, 18, 'Ratio', '', ''),
(234, 63, 0, 4, 0, 11, 'File Upload', '', ''),
(235, 63, 0, 4, 1, 16, 'Signature', '', ''),
(236, 64, 0, 0, 0, 17, 'Heading', '', ''),
(237, 65, 0, 0, 0, 17, 'Heading', '', ''),
(238, 66, 0, 0, 0, 17, 'Heading', '', ''),
(239, 67, 0, 0, 0, 17, 'Heading', '', ''),
(240, 68, 0, 0, 0, 1, 'Single Line Text', '', ''),
(241, 68, 0, 1, 0, 10, 'Email', '', ''),
(242, 68, 0, 2, 0, 18, 'Number', '', ''),
(243, 69, 0, 0, 0, 1, 'Single Line Text', '', ''),
(244, 69, 0, 1, 0, 10, 'Email', '', ''),
(245, 69, 0, 2, 0, 18, 'Number', '', ''),
(246, 70, 0, 0, 0, 1, 'Single Line Text\n	                        \n	                        \n	                        \n	                        \n	                        \n	                        \n	                        \n	                        ', '', ''),
(247, 70, 0, 1, 0, 10, 'Email', '', ''),
(248, 70, 0, 2, 0, 18, 'Number', '', ''),
(249, 71, 0, 0, 0, 1, 'Single Line Text', '', ''),
(250, 71, 0, 1, 0, 10, 'Email', '', ''),
(251, 72, 0, 0, 0, 17, 'Testing', '', ''),
(252, 72, 0, 1, 0, 6, 'Welcome', '', ''),
(253, 72, 0, 1, 1, 4, 'Date', '', ''),
(254, 73, 0, 0, 0, 17, 'Fill the Form', '', ''),
(255, 73, 0, 1, 0, 11, 'Resume', '', ''),
(256, 73, 0, 1, 1, 16, 'Signature', '', ''),
(257, 74, 0, 0, 0, 18, 'TEST', '', ''),
(258, 74, 0, 0, 0, 18, 'TEST 2', '', ''),
(259, 74, 0, 0, 1, 2, 'RADIO BUTTON ', '', ''),
(260, 74, 0, 1, 0, 5, 'Time', '', ''),
(261, 74, 0, 0, 2, 18, 'TEEST', '', ''),
(262, 75, 0, 0, 0, 1, 'name', '', ''),
(263, 75, 0, 1, 0, 11, 'File Upload', '', ''),
(264, 75, 0, 2, 0, 10, 'Email', '', ''),
(265, 76, 0, 0, 0, 17, 'PF Details', '', ''),
(266, 76, 0, 1, 0, 1, 'First name', '', ''),
(267, 76, 0, 1, 1, 1, 'Last Name', '', ''),
(268, 76, 0, 2, 0, 18, 'Employee ID', '', ''),
(269, 76, 0, 3, 0, 18, 'PF Account Number', '', ''),
(270, 76, 0, 3, 1, 18, 'PAN Card number', '', ''),
(271, 76, 0, 4, 0, 2, 'Working Status', '', ''),
(272, 76, 0, 5, 0, 3, 'PF Details available for years', '', ''),
(273, 76, 0, 6, 0, 16, 'Signature', '', ''),
(274, 77, 0, 0, 0, 1, 'Single Line Text', '', ''),
(275, 78, 0, 0, 0, 1, 'Single Line Text', '', ''),
(276, 78, 0, 0, 1, 18, 'Number', '', ''),
(277, 79, 0, 0, 0, 1, 'MRF ID', '', ''),
(278, 79, 0, 1, 0, 4, 'Date of Requirement', '', ''),
(279, 79, 0, 2, 0, 1, 'Reporting Manager Name/ Emp ID', '', ''),
(280, 79, 0, 2, 1, 1, 'Department', '', ''),
(281, 79, 0, 3, 0, 1, 'Designation / Role / Level', '', ''),
(282, 79, 0, 3, 1, 18, 'No of Positions', '', ''),
(283, 79, 0, 4, 0, 1, 'New / Replacement', '', ''),
(284, 79, 0, 4, 1, 1, 'Permanent / Contract', '', ''),
(285, 79, 0, 5, 0, 1, 'Location', '', ''),
(286, 79, 0, 6, 0, 17, 'Please answer the queries as Yes (Y) or No (N) only:', '', ''),
(287, 79, 0, 7, 0, 2, 'Has the option of clubbing this job with another role holder considered', '', ''),
(288, 79, 0, 8, 0, 2, 'Has the option of internal promotion considered for this role', '', ''),
(289, 79, 0, 9, 0, 2, 'Age / Gender (Preference)', '', ''),
(290, 79, 0, 10, 0, 1, 'Basic Qualification', '', ''),
(291, 79, 0, 11, 0, 1, 'Experience Range (Min - Max)', '', ''),
(292, 79, 0, 12, 0, 6, 'Mandatory Skills', '', ''),
(293, 79, 0, 13, 0, 16, 'Signature', '', ''),
(294, 80, 0, 0, 0, 1, 'Single Line Text', '', ''),
(295, 81, 0, 0, 0, 17, 'Profile Form', '', ''),
(296, 81, 0, 1, 0, 10, 'Email', '', ''),
(297, 81, 0, 1, 1, 1, 'Name', '', ''),
(298, 82, 0, 0, 0, 17, 'Construction Release of Liability', '', ''),
(299, 82, 0, 1, 0, 1, 'Construction company name', '', ''),
(300, 82, 0, 2, 0, 6, 'Address', '', ''),
(301, 82, 0, 3, 0, 1, 'Location', '', ''),
(302, 82, 0, 3, 1, 1, 'State', '', ''),
(303, 82, 0, 4, 0, 18, 'Tel no', '', ''),
(304, 82, 0, 4, 1, 18, 'Mobile No', '', ''),
(305, 82, 0, 5, 0, 10, 'Email', '', ''),
(306, 82, 0, 6, 0, 1, 'Employee Name', '', ''),
(307, 82, 0, 6, 1, 1, 'Job Title', '', ''),
(308, 82, 0, 7, 0, 1, 'Employee Number', '', ''),
(309, 82, 0, 8, 0, 1, 'Job Status', '', ''),
(310, 82, 0, 9, 0, 6, 'Address', '', ''),
(311, 82, 0, 10, 0, 1, 'Location', '', ''),
(312, 82, 0, 10, 1, 1, 'State', '', ''),
(313, 82, 0, 11, 0, 18, 'Tel No', '', ''),
(314, 82, 0, 11, 1, 18, 'Mobile No', '', ''),
(315, 83, 0, 0, 0, 4, 'Date', '', ''),
(316, 83, 0, 1, 0, 6, 'Job Site Address', '', ''),
(317, 83, 0, 2, 0, 1, 'Name of Business', '', ''),
(318, 83, 0, 3, 0, 1, 'Name of Project', '', ''),
(319, 83, 0, 4, 0, 1, 'Name of General Contractor', '', ''),
(320, 83, 0, 5, 0, 6, 'Address', '', ''),
(321, 83, 0, 6, 0, 1, 'Description of construction', '', ''),
(322, 83, 0, 7, 0, 2, 'Isn\'t a new construction', '', ''),
(323, 83, 0, 7, 1, 2, 'Are you remodelling the building', '', ''),
(324, 83, 0, 8, 0, 17, 'Project Details', '', ''),
(325, 83, 0, 9, 0, 1, 'Total Project cost $', '', ''),
(326, 83, 0, 9, 1, 4, 'Deadline of the project', '', ''),
(327, 83, 0, 10, 0, 18, 'How many people will be working directly in this project', '', ''),
(328, 83, 0, 11, 0, 16, 'Signature', '', ''),
(329, 84, 0, 0, 0, 17, 'Heading', '', ''),
(330, 84, 0, 1, 0, 1, 'Single Line Text', '', ''),
(331, 84, 0, 1, 1, 10, 'Email', '', ''),
(332, 85, 0, 0, 0, 17, 'Heading', '', ''),
(333, 85, 0, 1, 0, 1, 'Single Line Text', '', ''),
(334, 86, 0, 0, 0, 17, 'Heading', '', ''),
(335, 86, 0, 1, 0, 1, 'Single Line Text', '', ''),
(336, 86, 0, 1, 1, 1, 'Single Line Text', '', ''),
(337, 86, 0, 2, 0, 10, 'Email', '', ''),
(338, 86, 0, 2, 1, 10, 'Email', '', ''),
(339, 86, 0, 3, 0, 6, 'Multi Line Text', '', ''),
(340, 86, 0, 4, 0, 18, 'Number', '', ''),
(341, 86, 0, 5, 0, 2, 'Radio', '', ''),
(342, 86, 0, 6, 0, 8, 'Single Select Label', '', ''),
(343, 86, 0, 7, 0, 4, 'Date', '', ''),
(344, 86, 0, 8, 0, 16, 'Signature', '', ''),
(345, 87, 0, 0, 0, 17, 'Heading', '', ''),
(346, 87, 0, 1, 0, 1, 'Single Line Text', '', ''),
(347, 87, 0, 1, 1, 1, 'Single Line Text', '', ''),
(348, 87, 0, 2, 0, 10, 'Email', '', ''),
(349, 87, 0, 2, 1, 10, 'Email', '', ''),
(350, 87, 0, 3, 0, 6, 'Multi Line Text', '', ''),
(351, 87, 0, 4, 0, 18, 'Number', '', ''),
(352, 87, 0, 5, 0, 2, 'Radio', '', ''),
(353, 87, 0, 6, 0, 8, 'Single Select Label', '', ''),
(354, 87, 0, 7, 0, 4, 'Date', '', ''),
(355, 87, 0, 8, 0, 16, 'Signature', '', ''),
(356, 88, 0, 0, 0, 17, 'Construction Bid', '', ''),
(357, 88, 0, 0, 0, 1, 'Constructor Name', '', ''),
(358, 88, 0, 1, 0, 6, 'Address', '', ''),
(359, 88, 0, 2, 0, 18, 'Phone Number', '', ''),
(360, 88, 0, 3, 0, 10, 'Email Address', '', ''),
(361, 88, 0, 4, 0, 1, 'Project Site', '', ''),
(362, 88, 0, 5, 0, 6, 'Description of the project', '', ''),
(363, 88, 0, 6, 0, 18, 'Lump Sum bid price $', '', ''),
(364, 88, 0, 7, 0, 17, 'Contractor\'s fee will be determined with the following', '', ''),
(365, 88, 0, 8, 0, 18, 'Payroll costs $', '', ''),
(366, 88, 0, 9, 0, 18, 'Material and Equipments $', '', ''),
(367, 88, 0, 10, 0, 18, 'Payment for Sub contractor $', '', ''),
(368, 88, 0, 11, 0, 18, 'Payment for special consultant $', '', ''),
(369, 88, 0, 12, 0, 18, 'Maximum amount payable to contractor will not exceed $', '', ''),
(370, 88, 0, 13, 0, 16, 'Signature', '', ''),
(371, 89, 0, 0, 0, 4, 'Date', '', ''),
(372, 89, 0, 0, 1, 18, 'phone', '', ''),
(373, 89, 0, 0, 2, 10, 'Email', '', ''),
(374, 89, 0, 1, 0, 17, 'TEST', '', ''),
(375, 89, 0, 2, 0, 1, 'NOTIFICATION', '', ''),
(376, 90, 0, 0, 0, 1, 'first name', '', ''),
(377, 91, 0, 0, 0, 1, 'Single Line Text', '', ''),
(378, 91, 0, 0, 1, 10, 'Email', '', ''),
(379, 91, 0, 0, 2, 17, 'Heading', '', ''),
(380, 91, 0, 1, 0, 2, 'Radio', '', ''),
(381, 91, 0, 1, 1, 6, 'Multi Line Text', '', ''),
(382, 91, 0, 1, 2, 17, 'Heading', '', ''),
(383, 91, 0, 2, 0, 1, 'Single Line Text', '', ''),
(384, 91, 0, 2, 1, 3, 'Multi choice', '', ''),
(385, 91, 0, 2, 2, 1, '', '', ''),
(386, 92, 0, 0, 0, 17, 'Heading', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `form_hierarchy`
--

CREATE TABLE `form_hierarchy` (
  `form_hierarchy_id` int(11) NOT NULL,
  `form_hierarchy_name` varchar(50) NOT NULL,
  `form_id` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_hierarchy`
--

INSERT INTO `form_hierarchy` (`form_hierarchy_id`, `form_hierarchy_name`, `form_id`, `uuid`) VALUES
(3, 'Sample Work Flow', 35, '4979f524-6139-4e72-a719-08258242f105'),
(4, 'Test Form Work Flow', 36, '85000c6b-2957-4f75-8a20-acec22e3978c'),
(6, 'Tech test Work Flow', 38, 'b365ecdc-cb53-4907-ad03-5b2fb6418d7b'),
(7, 'Support 1 Work Flow', 39, 'cba6d6f0-0aa1-4522-b9b2-cf0b51204b50'),
(8, 'test Work Flow', 40, 'ac5f9c56-3079-4ed1-abe0-2aec55e214f1'),
(9, 'test Work Flow', 41, 'a82062cc-89da-4010-af68-665fb2326153'),
(10, 'Sample Forms Work Flow', 42, '1f926ccc-d33d-4691-a932-549abef99a7b'),
(11, 'Sample Work Flow', 43, '1f40ee74-710e-41ac-a9eb-e746bb4a7a68'),
(12, 'a Work Flow', 44, 'b505e2f8-8f96-482c-9a21-30a979280dc9'),
(13, 'a Work Flow', 45, '73b34d11-7bce-4d6d-bb04-7713bdb19d28'),
(14, 'a Work Flow', 46, 'd3150265-65f4-4b48-917d-9d2abe906a7a'),
(15, 'a Work Flow', 47, '9e36e26f-9771-49f6-83bd-ac278cf05025'),
(16, 'hgfghf Work Flow', 48, '8eb66d71-3d12-4092-bfe0-ed7dbb06af6b'),
(17, 'hgfghf Work Flow', 49, '89bd5e0d-a1db-440c-9f3b-1781e0af842a'),
(18, 'Yrtsdrt Work Flow', 50, '1d35b5a6-36e5-42f6-a1ff-f04978829228'),
(19, 'Yrtsdrt Work Flow', 51, '23a95f42-8609-468a-9741-c51bbc65562c'),
(20, 'Yrtsdrt Work Flow', 52, '5808f080-76fe-404f-b1d8-bfcbcbe295cd'),
(21, 'saamp Work Flow', 53, 'c978c3e2-ebd2-4538-95b6-49aa28323fab'),
(22, 'sa Work Flow', 54, 'd95d4757-8a2a-4a66-964f-41dcb71594a7'),
(23, 'hgfghf Work Flow', 55, '2e313644-bb81-4bea-bff7-8184ab5a5f5c'),
(24, 'FAVOURITE ADD Work Flow', 56, '7063073f-0751-4ed1-b64b-99ce97f2d6d5'),
(25, 'Test Work Flow', 57, '067d008c-7bfc-4014-9d46-b06853dec62f'),
(26, 'Review Work Flow', 58, '24570088-ed6b-4a35-bbef-29240042c2a1'),
(27, 'Samlle2 Work Flow', 59, '8db7e12d-c53a-4f41-93b3-b1e485697c33'),
(28, 'Feedback - Food Festival - Team 2 Work Flow', 60, 'df7dad1f-2962-45b6-a847-999a4b3b4c09'),
(29, 'Test Work Flow', 61, '73450db5-3893-4e70-8a17-3f34df83005c'),
(30, 'Montly Work Flow', 62, '83d9cd37-c554-4829-a00f-9ef480185b45'),
(31, 'Risk ratio Work Flow', 63, '2da381f2-80a6-4112-a226-a975a16eabb4'),
(32, 'sdsd Work Flow', 64, '53007582-c73c-4f4c-8926-f89f9726acca'),
(33, 'sdsd Work Flow', 65, 'b20ba2aa-9f10-4184-a25e-d0a150599933'),
(34, 'sdfsdf Work Flow', 66, 'af6d69ab-b628-4823-ba9d-c136a827e59f'),
(35, 'Test Work Flow', 67, 'f79af085-5c56-4d29-82b2-b74c1b4a3593'),
(37, 'Test Forms default Work Flow', 69, '5658baf8-dcf0-4894-8d40-b52184709bdb'),
(38, 'Test Forms default Work Flow', 70, 'ba07b121-b042-4358-92e4-7ea34ec64db5'),
(39, 'Test workflow Work Flow', 71, '1fa9bba4-7ee4-4e40-b0c5-240d5f43b220'),
(40, 'testing Work Flow', 72, '3d04e3c9-54d0-47a9-ac4c-713ed2aaa17f'),
(41, 'TesterTesting Work Flow', 73, 'aac415d3-59e5-4354-a823-80a41153454d'),
(42, 'QAT IN ACTION Work Flow', 74, '5985aa27-767b-4f8f-b71e-6f718b57ecc0'),
(43, 'new Work Flow', 75, '2917fd5b-4829-46c5-ab4e-86c7cf9f5b36'),
(44, 'PF Details Work Flow', 76, '702878f3-1658-47ab-820f-5d05a6216ece'),
(45, 'Check Forms Work Flow', 77, 'd03fcdaf-957c-4c6f-a238-98d4f105e60e'),
(46, 'Check Reporting Work Flow', 78, 'bb3293e5-543a-430b-afdb-393520134486'),
(47, 'Manpower Requisition Form Work Flow', 79, '1aca5edb-2ad9-4da3-92cb-40214d92b078'),
(48, 'Test Wworkflow Work Flow', 80, 'f0813386-3cc5-43c1-b143-2eed58663de0'),
(49, 'Profile Form Work Flow', 81, '6fcd934f-6e73-41a3-afe8-c226e6f63e19'),
(50, 'Construction Release of Liability Work Flow', 82, '96830024-4ca6-4e7c-8546-252c6f490afc'),
(51, 'Commercial Construction Work Flow', 83, 'a5c96747-cd44-432f-b2c8-6048e1342ecf'),
(56, 'Construction Bid Work Flow', 88, '0304b795-d70b-40dd-af7e-c986f4286323'),
(57, 'CHANDU Work Flow', 89, '323cd5c9-b1a5-45c5-9f22-37672cbbc3fb'),
(58, 'pot Work Flow', 90, 'b53045ff-80c7-467d-9760-407842192ac6'),
(59, 'plop Work Flow', 91, '79159d6b-30cd-4eb7-b7bf-b70988a00f2b'),
(60, 'Rasdasd Work Flow', 92, 'e0727628-7fa9-430b-8048-46e47f7a18b5');

-- --------------------------------------------------------

--
-- Table structure for table `form_hierarchy_position`
--

CREATE TABLE `form_hierarchy_position` (
  `form_hierarchy_position_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_hierarchy_id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_hierarchy_position`
--

INSERT INTO `form_hierarchy_position` (`form_hierarchy_position_id`, `form_id`, `user_id`, `form_hierarchy_id`, `sort_id`) VALUES
(1, 35, 57, 3, 0),
(2, 36, 58, 4, 0),
(3, 36, 57, 4, 1),
(7, 41, 57, 9, 0),
(8, 41, 58, 9, 1),
(9, 43, 1, 11, 0),
(19, 53, 57, 21, 0),
(20, 53, 58, 21, 1),
(29, 61, 57, 29, 0),
(32, 69, 1, 37, 0),
(33, 70, 78, 38, 0),
(34, 71, 78, 39, 0),
(35, 71, 79, 39, 1),
(36, 72, 84, 40, 0),
(37, 73, 84, 41, 0),
(38, 74, 88, 42, 0),
(39, 75, 84, 43, 0),
(40, 76, 91, 44, 0),
(41, 77, 81, 45, 0),
(42, 78, 81, 46, 0),
(43, 78, 83, 46, 1),
(44, 79, 93, 47, 0),
(45, 79, 92, 47, 1),
(46, 80, 84, 48, 0),
(47, 81, 93, 49, 0),
(48, 81, 92, 49, 1),
(54, 82, 101, 50, 0),
(55, 82, 100, 50, 1),
(56, 83, 101, 51, 0),
(57, 83, 100, 51, 1),
(58, 88, 101, 56, 0),
(59, 88, 100, 56, 1),
(60, 89, 107, 57, 0),
(61, 90, 107, 58, 0),
(62, 91, 107, 59, 0),
(63, 92, 107, 60, 0);

-- --------------------------------------------------------

--
-- Table structure for table `form_location`
--

CREATE TABLE `form_location` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `form_hierarchy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='form_id from form_details table';

--
-- Dumping data for table `form_location`
--

INSERT INTO `form_location` (`id`, `form_id`, `location_id`, `form_hierarchy_id`) VALUES
(1, 35, 36, 3),
(2, 36, 36, 4),
(3, 36, 37, 4),
(4, 39, 38, 7),
(5, 40, 36, 8),
(6, 41, 36, 9),
(7, 42, 36, 10),
(8, 42, 37, 10),
(9, 48, 38, 16),
(10, 49, 38, 17),
(11, 50, 38, 18),
(12, 51, 38, 19),
(13, 52, 38, 20),
(14, 53, 36, 21),
(15, 54, 38, 22),
(16, 55, 38, 23),
(17, 56, 39, 24),
(18, 57, 39, 25),
(19, 58, 39, 26),
(20, 59, 37, 27),
(21, 60, 39, 28),
(22, 61, 36, 29),
(23, 62, 44, 30),
(24, 63, 44, 31),
(25, 64, 44, 32),
(26, 65, 44, 33),
(27, 66, 44, 34),
(28, 67, 44, 35),
(29, 70, 47, 38),
(30, 71, 47, 39),
(31, 72, 50, 40),
(32, 73, 50, 41),
(33, 74, 53, 42),
(34, 75, 50, 43),
(35, 76, 54, 44),
(36, 77, 48, 45),
(37, 78, 48, 46),
(38, 78, 49, 46),
(39, 79, 54, 47),
(40, 80, 50, 48),
(41, 81, 54, 49),
(42, 82, 58, 50),
(43, 82, 59, 50),
(44, 82, 60, 50),
(45, 83, 58, 51),
(46, 83, 59, 51),
(47, 83, 60, 51),
(48, 84, 58, 52),
(49, 85, 58, 53),
(50, 85, 59, 53),
(51, 85, 60, 53),
(52, 86, 58, 54),
(53, 86, 59, 54),
(54, 86, 60, 54),
(55, 87, 58, 55),
(56, 87, 59, 55),
(57, 87, 60, 55),
(58, 88, 58, 56),
(59, 88, 59, 56),
(60, 88, 60, 56),
(61, 89, 62, 57),
(62, 90, 62, 58),
(63, 91, 62, 59),
(64, 92, 62, 60);

-- --------------------------------------------------------

--
-- Table structure for table `form_options`
--

CREATE TABLE `form_options` (
  `form_option_id` int(11) NOT NULL,
  `form_fields_id` int(11) NOT NULL,
  `option_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `option_value` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_options`
--

INSERT INTO `form_options` (`form_option_id`, `form_fields_id`, `option_name`, `option_value`) VALUES
(71, 164, 'Yes', 'Yes'),
(72, 164, 'No', 'No'),
(73, 165, 'First Option', 'First Option'),
(74, 165, 'Second Option', 'Second Option'),
(75, 193, 'Yes', 'Yes'),
(76, 193, 'No', 'No'),
(77, 194, 'First Option', 'First Option'),
(78, 194, 'Second Option', 'Second Option'),
(79, 195, 'First Option', 'First Option'),
(80, 212, '20-30', '20-30'),
(81, 212, '30-40', '30-40'),
(82, 212, '40-60', '40-60'),
(83, 220, 'Mobile', 'Mobile'),
(84, 220, 'Magento', 'Magento'),
(85, 220, 'Drupal', 'Drupal'),
(86, 220, 'Design', 'Design'),
(87, 220, 'QA', 'QA'),
(88, 222, 'One', 'One'),
(89, 222, 'Two', 'Two'),
(90, 222, 'Three', 'Three'),
(91, 222, 'Four', 'Four'),
(92, 222, 'Five', 'Five'),
(93, 227, 'Rajesh', 'Rajesh'),
(94, 227, 'Kannan', 'Kannan'),
(95, 259, 'Yes', 'Yes'),
(96, 259, 'No', 'No'),
(97, 271, 'Working', 'Working'),
(98, 271, 'Relieved', 'Relieved'),
(99, 272, '2014', '2014'),
(100, 272, '2015', '2015'),
(101, 272, '2016', '2016'),
(102, 272, '2017', '2017'),
(103, 287, 'Yes', 'Yes'),
(104, 287, 'No', 'No'),
(105, 288, 'Yes', 'Yes'),
(106, 288, 'No', 'No'),
(107, 289, 'Male', 'Male'),
(108, 289, 'Female', 'Female'),
(109, 322, 'Yes', 'Yes'),
(110, 322, 'No', 'No'),
(111, 323, 'Yes', 'Yes'),
(112, 323, 'No', 'No'),
(113, 341, 'Yes', 'Yes'),
(114, 341, 'No', 'No'),
(115, 342, 'First Option', 'First Option'),
(116, 342, 'Second Option', 'Second Option'),
(117, 352, 'Yes', 'Yes'),
(118, 352, 'No', 'No'),
(119, 353, 'First Option', 'First Option'),
(120, 353, 'Second Option', 'Second Option'),
(121, 380, 'Yes', 'Yes'),
(122, 380, 'No', 'No'),
(123, 384, 'First Option', 'First Option');

-- --------------------------------------------------------

--
-- Table structure for table `form_review_history`
--

CREATE TABLE `form_review_history` (
  `form_review_history_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `createddate` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 - waiting for approval ,1 - Approved , 2- Rejected , 3- Reassign'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_review_history`
--

INSERT INTO `form_review_history` (`form_review_history_id`, `form_id`, `submission_id`, `user_id`, `createddate`, `status`) VALUES
(1, 39, 9, 61, '2016-12-13 14:06:33', 1),
(2, 60, 10, 64, '2016-12-16 12:56:57', 1),
(3, 60, 11, 64, '2016-12-16 12:57:20', 1),
(4, 60, 12, 64, '2016-12-17 06:38:39', 1),
(5, 58, 13, 64, '2016-12-17 09:20:32', 0),
(6, 58, 13, 66, '2016-12-17 09:20:32', 0),
(7, 58, 14, 64, '2016-12-17 09:59:53', 0),
(8, 58, 14, 66, '2016-12-17 09:59:53', 0),
(9, 58, 15, 64, '2016-12-17 09:59:56', 0),
(10, 58, 15, 66, '2016-12-17 09:59:56', 0),
(11, 58, 16, 64, '2016-12-17 09:59:58', 0),
(12, 58, 16, 66, '2016-12-17 09:59:58', 0),
(13, 61, 17, 57, '2016-12-19 06:50:48', 1),
(14, 61, 18, 57, '2016-12-19 06:51:52', 1),
(15, 61, 19, 57, '2016-12-19 06:52:39', 1),
(16, 60, 20, 64, '2016-12-21 13:16:31', 1),
(17, 60, 21, 64, '2016-12-21 13:35:28', 1),
(18, 60, 22, 64, '2016-12-21 13:51:52', 1),
(19, 60, 23, 64, '2016-12-21 13:52:18', 1),
(20, 60, 24, 64, '2016-12-21 13:57:12', 1),
(21, 60, 25, 64, '2016-12-21 13:57:42', 1),
(22, 60, 26, 64, '2016-12-21 13:59:27', 1),
(23, 72, 27, 84, '2017-01-12 07:40:13', 0),
(24, 73, 28, 84, '2017-01-12 08:11:52', 1),
(25, 73, 29, 84, '2017-01-12 08:11:53', 1),
(26, 75, 30, 84, '2017-01-12 14:09:07', 1),
(27, 75, 31, 84, '2017-01-12 14:09:07', 1),
(28, 75, 32, 84, '2017-01-12 14:11:53', 1),
(29, 75, 33, 84, '2017-01-12 14:11:53', 1),
(30, 75, 34, 84, '2017-01-12 15:05:02', 1),
(31, 75, 35, 84, '2017-01-12 15:33:01', 1),
(32, 75, 36, 84, '2017-01-12 15:33:01', 1),
(33, 71, 37, 78, '2017-01-12 19:02:28', 0),
(34, 71, 37, 79, '2017-01-12 19:02:28', 0),
(35, 78, 38, 81, '2017-01-12 19:07:30', 2),
(36, 78, 38, 83, '2017-01-12 19:07:30', 2),
(37, 78, 39, 81, '2017-01-13 10:02:31', 1),
(38, 78, 39, 83, '2017-01-13 10:02:31', 0),
(39, 75, 40, 84, '2017-01-13 10:44:37', 1),
(40, 75, 41, 84, '2017-01-13 10:44:38', 1),
(41, 81, 42, 93, '2017-01-13 12:19:33', 1),
(42, 81, 42, 92, '2017-01-13 12:19:33', 1),
(43, 88, 43, 101, '2017-01-13 16:18:21', 1),
(44, 88, 43, 100, '2017-01-13 16:18:21', 1),
(45, 90, 44, 107, '2017-01-23 06:26:39', 1),
(46, 91, 45, 107, '2017-01-23 07:17:19', 1),
(47, 92, 46, 107, '2017-01-23 07:29:54', 1),
(48, 92, 47, 107, '2017-01-23 07:30:25', 1),
(49, 92, 48, 107, '2017-01-23 10:27:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_submission`
--

CREATE TABLE `form_submission` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__forms.id',
  `submission` longtext NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `form_hierarchy_position_id` int(11) NOT NULL,
  `status` int(4) NOT NULL COMMENT '1 - Approved/ 2- Rejected/ 3- Reaasign',
  `reassigned_by` int(11) NOT NULL,
  `reassigned_to` int(11) NOT NULL,
  `declined_by` int(11) NOT NULL,
  `uuid` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_submission`
--

INSERT INTO `form_submission` (`id`, `user_id`, `org_id`, `location_id`, `created_at`, `updated_at`, `form_id`, `submission`, `token`, `form_hierarchy_position_id`, `status`, `reassigned_by`, `reassigned_to`, `declined_by`, `uuid`) VALUES
(9, 62, 34, 38, '2016-12-13 14:06:33', '2016-12-13 14:06:33', 39, '{\"title\":\"Support 1\",\"fields\":[[[{\"formfieldid\":\"152\",\"title\":\"Issue\",\"api_type\":\"element-single-line-text\",\"value\":\"1\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":33},{\"format\":\"MM\\/dd\\/yyyy\",\"formfieldid\":\"153\",\"title\":\"Date\",\"api_type\":\"element-date\",\"value\":\"12\\/13\\/2016\",\"type\":\"date\",\"required\":\"0\",\"fieldtype\":\"6\",\"fieldid\":\"4\",\"user_info_text_id\":34}],[{\"formfieldid\":\"154\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/formpro.enterpriseapplicationdevelopers.com\\/uploads\\/34\\/38\\/39\\/62\\/cached.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":35},{\"formfieldid\":\"155\",\"title\":\"Signature\",\"api_type\":\"element-signature\",\"value\":\"http:\\/\\/formpro.enterpriseapplicationdevelopers.com\\/uploads\\/34\\/38\\/39\\/62\\/cached1.jpg\",\"type\":\"signature\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"16\",\"user_info_text_id\":36}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'OGAksy2UvS', 0, 1, 0, 0, 0, '0717f7fb-c415-4f4b-b199-5f80b032d960'),
(10, 67, 35, 39, '2016-12-16 12:56:57', '2016-12-16 12:56:57', 60, '{\"title\":\"Feedback - Food Festival - Team 2\",\"fields\":[[[{\"formfieldid\":\"214\",\"title\":\"Feedback - Food Festival - 2016\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"215\",\"title\":\"First Name\",\"api_type\":\"element-single-line-text\",\"value\":\"Lo\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":42},{\"formfieldid\":\"216\",\"title\":\"Middle Name\",\"api_type\":\"element-single-line-text\",\"value\":\"\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":null},{\"formfieldid\":\"217\",\"title\":\"Last Name\",\"api_type\":\"element-single-line-text\",\"value\":\"Ku\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":39}],[{\"formfieldid\":\"218\",\"title\":\"Employee ID\",\"api_type\":\"element-single-line-text\",\"value\":\"INNO0162\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":37},{\"formfieldid\":\"219\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"log@inno.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":38},{\"fieldtype\":\"1\",\"formfieldid\":\"220\",\"title\":\"Department\",\"choices\":[{\"title\":\"Mobile\",\"id\":\"83\",\"checked\":0},{\"title\":\"Magento\",\"id\":\"84\",\"checked\":0},{\"title\":\"Drupal\",\"id\":\"85\",\"checked\":1},{\"title\":\"Design\",\"id\":\"86\",\"checked\":0},{\"title\":\"QA\",\"id\":\"87\",\"checked\":0}],\"value\":\"Drupal\",\"type\":\"select\",\"required\":\"0\",\"api_type\":\"element-single-select\",\"fieldid\":\"8\",\"user_info_text_id\":40}],[{\"formfieldid\":\"221\",\"title\":\"Food Varities\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null},{\"fieldtype\":\"1\",\"formfieldid\":\"222\",\"title\":\"\",\"choices\":[{\"title\":\"One\",\"id\":\"88\",\"checked\":0},{\"title\":\"Two\",\"id\":\"89\",\"checked\":0},{\"title\":\"Three\",\"id\":\"90\",\"checked\":0},{\"title\":\"Four\",\"id\":\"91\",\"checked\":0},{\"title\":\"Five\",\"id\":\"92\",\"checked\":1}],\"value\":\"Five\",\"type\":\"radio\",\"api_type\":\"element-either-or-choice\",\"required\":\"0\",\"fieldid\":\"2\",\"user_info_text_id\":41}],[{\"formfieldid\":\"223\",\"title\":\"Food Taste\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"224\",\"title\":\"Food Quality\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"225\",\"title\":\"Quality Of Service\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'OxWgnMXasz', 0, 1, 0, 0, 0, 'cf461c1c-30e4-4215-8e0e-b15ab4976197'),
(11, 67, 35, 39, '2016-12-16 12:57:20', '2016-12-16 12:57:20', 60, '{\"title\":\"Feedback - Food Festival - Team 2\",\"fields\":[[[{\"formfieldid\":\"214\",\"title\":\"Feedback - Food Festival - 2016\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"215\",\"title\":\"First Name\",\"api_type\":\"element-single-line-text\",\"value\":\"Logesh\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":48},{\"formfieldid\":\"216\",\"title\":\"Middle Name\",\"api_type\":\"element-single-line-text\",\"value\":\"\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":null},{\"formfieldid\":\"217\",\"title\":\"Last Name\",\"api_type\":\"element-single-line-text\",\"value\":\"Kumaraguru\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":45}],[{\"formfieldid\":\"218\",\"title\":\"Employee ID\",\"api_type\":\"element-single-line-text\",\"value\":\"INNO0162\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":43},{\"formfieldid\":\"219\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"log@inno.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":44},{\"fieldtype\":\"1\",\"formfieldid\":\"220\",\"title\":\"Department\",\"api_type\":\"element-single-select\",\"value\":\"Drupal\",\"type\":\"select\",\"choices\":[{\"title\":\"Mobile\",\"id\":\"83\",\"checked\":0},{\"title\":\"Magento\",\"id\":\"84\",\"checked\":0},{\"title\":\"Drupal\",\"id\":\"85\",\"checked\":1},{\"title\":\"Design\",\"id\":\"86\",\"checked\":0},{\"title\":\"QA\",\"id\":\"87\",\"checked\":0}],\"required\":\"0\",\"fieldid\":\"8\",\"user_info_text_id\":46}],[{\"formfieldid\":\"221\",\"title\":\"Food Varities\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null},{\"fieldtype\":\"1\",\"formfieldid\":\"222\",\"title\":\"\",\"api_type\":\"element-either-or-choice\",\"value\":\"Five\",\"choices\":[{\"title\":\"One\",\"id\":\"88\",\"checked\":0},{\"title\":\"Two\",\"id\":\"89\",\"checked\":0},{\"title\":\"Three\",\"id\":\"90\",\"checked\":0},{\"title\":\"Four\",\"id\":\"91\",\"checked\":0},{\"title\":\"Five\",\"id\":\"92\",\"checked\":1}],\"required\":\"0\",\"type\":\"radio\",\"fieldid\":\"2\",\"user_info_text_id\":47}],[{\"formfieldid\":\"223\",\"title\":\"Food Taste\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"224\",\"title\":\"Food Quality\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"225\",\"title\":\"Quality Of Service\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', '3RC4P0sbrB', 0, 1, 0, 0, 0, 'fdd309a5-9cfb-4b3e-bcba-7ccf9a429192'),
(12, 67, 35, 39, '2016-12-17 06:38:39', '2016-12-17 06:38:39', 60, '{\"title\":\"Feedback - Food Festival - Team 2\",\"fields\":[[[{\"formfieldid\":\"214\",\"title\":\"Feedback - Food Festival - 2016\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"215\",\"title\":\"First Name\",\"api_type\":\"element-single-line-text\",\"value\":\"Sa\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":49},{\"formfieldid\":\"216\",\"title\":\"Middle Name\",\"api_type\":\"element-single-line-text\",\"value\":\"\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":null},{\"formfieldid\":\"217\",\"title\":\"Last Name\",\"api_type\":\"element-single-line-text\",\"value\":\"Ka\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":50}],[{\"formfieldid\":\"218\",\"title\":\"Employee ID\",\"api_type\":\"element-single-line-text\",\"value\":\"\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":null},{\"formfieldid\":\"219\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":null},{\"fieldtype\":\"1\",\"formfieldid\":\"220\",\"title\":\"Department\",\"choices\":[{\"title\":\"Mobile\",\"id\":\"83\",\"checked\":\"0\"},{\"title\":\"Magento\",\"id\":\"84\",\"checked\":\"0\"},{\"title\":\"Drupal\",\"id\":\"85\",\"checked\":\"0\"},{\"title\":\"Design\",\"id\":\"86\",\"checked\":\"0\"},{\"title\":\"QA\",\"id\":\"87\",\"checked\":\"0\"}],\"value\":\"\",\"type\":\"select\",\"required\":\"0\",\"api_type\":\"element-single-select\",\"fieldid\":\"8\",\"user_info_text_id\":null}],[{\"formfieldid\":\"221\",\"title\":\"Food Varities\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null},{\"fieldtype\":\"1\",\"formfieldid\":\"222\",\"title\":\"\",\"choices\":[{\"title\":\"One\",\"id\":\"88\",\"checked\":\"0\"},{\"title\":\"Two\",\"id\":\"89\",\"checked\":\"0\"},{\"title\":\"Three\",\"id\":\"90\",\"checked\":\"0\"},{\"title\":\"Four\",\"id\":\"91\",\"checked\":\"0\"},{\"title\":\"Five\",\"id\":\"92\",\"checked\":\"0\"}],\"value\":\"\",\"type\":\"radio\",\"api_type\":\"element-either-or-choice\",\"required\":\"0\",\"fieldid\":\"2\",\"user_info_text_id\":null}],[{\"formfieldid\":\"223\",\"title\":\"Food Taste\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"224\",\"title\":\"Food Quality\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"225\",\"title\":\"Quality Of Service\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', '0xkcMpGzPR', 0, 1, 0, 0, 0, '5004e2f6-b1e7-4894-929f-1277518996cc'),
(13, 67, 35, 39, '2016-12-17 09:20:32', '2016-12-17 09:20:32', 58, '{\"description\":\"\",\"fields\":[[[{\"api_type\":\"element-label\",\"choices\":[],\"fieldid\":17,\"fieldtype\":\"2\",\"formfieldid\":\"209\",\"isenabled\":0,\"required\":0,\"title\":\"Product Details\",\"type\":\"heading\",\"value\":\"\",\"user_info_text_id\":null}],[{\"api_type\":\"element-single-line-text\",\"choices\":[],\"fieldid\":1,\"fieldtype\":\"2\",\"formfieldid\":\"210\",\"isenabled\":0,\"required\":0,\"title\":\"Product Name \",\"type\":\"text\",\"value\":\"apple\",\"user_info_text_id\":51}],[{\"api_type\":\"element-multi-line-text\",\"choices\":[],\"fieldid\":6,\"fieldtype\":\"2\",\"formfieldid\":\"211\",\"isenabled\":0,\"required\":0,\"title\":\"Product Descr\",\"type\":\"textarea\",\"value\":\"very costly\",\"user_info_text_id\":52}],[{\"api_type\":\"element-multi-choice\",\"choices\":[{\"checked\":1,\"id\":\"80\",\"isSelected\":true,\"title\":\"20-30\"},{\"checked\":0,\"id\":\"81\",\"isSelected\":false,\"title\":\"30-40\"},{\"checked\":0,\"id\":\"82\",\"isSelected\":false,\"title\":\"40-60\"}],\"fieldid\":3,\"fieldtype\":\"1\",\"formfieldid\":\"212\",\"isenabled\":0,\"required\":0,\"title\":\"Age group\",\"type\":\"checkbox\",\"value\":\"20-30\",\"user_info_text_id\":53}],[{\"api_type\":\"element-reset\",\"choices\":[],\"fieldid\":0,\"formfieldid\":\"0\",\"isenabled\":0,\"required\":0,\"title\":\"Reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"api_type\":\"element-button-submit\",\"choices\":[],\"fieldid\":0,\"formfieldid\":\"1\",\"isenabled\":0,\"required\":0,\"title\":\"Submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"title\":\"Review\"}', 'FwjNpBy_Ad', 0, 0, 0, 0, 0, '7ac204df-0004-4325-9319-5055682075a3'),
(14, 67, 35, 39, '2016-12-17 09:59:53', '2016-12-17 09:59:53', 58, '{\"title\":\"Review\",\"fields\":[[[{\"formfieldid\":\"209\",\"title\":\"Product Details\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"210\",\"title\":\"Product Name \",\"api_type\":\"element-single-line-text\",\"value\":\"Apple\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":54}],[{\"formfieldid\":\"211\",\"title\":\"Product Descr\",\"api_type\":\"element-multi-line-text\",\"value\":\"Costly \",\"type\":\"textarea\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"6\",\"user_info_text_id\":55}],[{\"required\":\"0\",\"formfieldid\":\"212\",\"title\":\"Age group\",\"choices\":[{\"title\":\"20-30\",\"id\":\"80\",\"checked\":0},{\"title\":\"30-40\",\"id\":\"81\",\"checked\":1},{\"title\":\"40-60\",\"id\":\"82\",\"checked\":0}],\"value\":\"30-40\",\"api_type\":\"element-multi-choice\",\"type\":\"checkbox\",\"fieldtype\":\"1\",\"fieldid\":\"3\",\"user_info_text_id\":56}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'PVOwD8WZyQ', 0, 0, 0, 0, 0, 'bed0089b-4730-4cc1-ae9b-188d6ba23243'),
(15, 67, 35, 39, '2016-12-17 09:59:56', '2016-12-17 09:59:56', 58, '{\"title\":\"Review\",\"fields\":[[[{\"formfieldid\":\"209\",\"title\":\"Product Details\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"210\",\"title\":\"Product Name \",\"api_type\":\"element-single-line-text\",\"value\":\"Apple\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":57}],[{\"formfieldid\":\"211\",\"title\":\"Product Descr\",\"api_type\":\"element-multi-line-text\",\"value\":\"Costly \",\"type\":\"textarea\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"6\",\"user_info_text_id\":58}],[{\"api_type\":\"element-multi-choice\",\"formfieldid\":\"212\",\"title\":\"Age group\",\"choices\":[{\"title\":\"20-30\",\"id\":\"80\",\"checked\":0},{\"title\":\"30-40\",\"id\":\"81\",\"checked\":1},{\"title\":\"40-60\",\"id\":\"82\",\"checked\":0}],\"value\":\"30-40\",\"type\":\"checkbox\",\"required\":\"0\",\"fieldtype\":\"1\",\"fieldid\":\"3\",\"user_info_text_id\":59}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'J2FQA6h5Tz', 0, 0, 0, 0, 0, 'b2b14a5f-2868-45ae-bcd5-3cfec2702280'),
(16, 67, 35, 39, '2016-12-17 09:59:58', '2016-12-17 09:59:58', 58, '{\"title\":\"Review\",\"fields\":[[[{\"formfieldid\":\"209\",\"title\":\"Product Details\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"210\",\"title\":\"Product Name \",\"api_type\":\"element-single-line-text\",\"value\":\"Apple\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":60}],[{\"formfieldid\":\"211\",\"title\":\"Product Descr\",\"api_type\":\"element-multi-line-text\",\"value\":\"Costly \",\"type\":\"textarea\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"6\",\"user_info_text_id\":61}],[{\"required\":\"0\",\"formfieldid\":\"212\",\"title\":\"Age group\",\"api_type\":\"element-multi-choice\",\"choices\":[{\"title\":\"20-30\",\"id\":\"80\",\"checked\":0},{\"title\":\"30-40\",\"id\":\"81\",\"checked\":1},{\"title\":\"40-60\",\"id\":\"82\",\"checked\":0}],\"type\":\"checkbox\",\"value\":\"30-40\",\"fieldtype\":\"1\",\"fieldid\":\"3\",\"user_info_text_id\":62}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'pN3gAbnxES', 0, 0, 0, 0, 0, 'f832dc85-7a5e-445d-97b2-bfc7ecdc280d'),
(17, 59, 33, 36, '2016-12-19 06:50:48', '2016-12-19 06:50:48', 61, '\"{         \\\"title\\\": \\\"Test\\\",         \\\"description\\\": \\\"\\\",         \\\"fields\\\": [             [                 [                     {                         \\\"fieldid\\\": \\\"1\\\",                         \\\"formfieldid\\\": \\\"226\\\",                         \\\"type\\\": \\\"text\\\",                         \\\"title\\\": \\\"Single Line Text\\\",                         \\\"required\\\": \\\"0\\\",                         \\\"api_type\\\": \\\"element-single-line-text\\\",                         \\\"fieldtype\\\": \\\"2\\\", \\\"value\\\":\\\"Rajesh\\\"                     }                 ],                 [                     {                         \\\"fieldid\\\": \\\"2\\\",                         \\\"formfieldid\\\": \\\"227\\\",                         \\\"type\\\": \\\"radio\\\",                         \\\"title\\\": \\\"Radio\\\",                         \\\"choices\\\": [                             {                                 \\\"title\\\": \\\"Rajesh\\\",                                 \\\"id\\\": \\\"93\\\",                                 \\\"checked\\\": \\\"0\\\"                             },                             {                                 \\\"title\\\": \\\"Kannan\\\",                                 \\\"id\\\": \\\"94\\\",                                 \\\"checked\\\": \\\"0\\\"                             }                         ],                         \\\"required\\\": \\\"0\\\",                         \\\"api_type\\\": \\\"element-either-or-choice\\\",                         \\\"fieldtype\\\": \\\"1\\\",    \\\"value\\\":\\\"Rajesh\\\"                     }                 ],                 [                     {                         \\\"type\\\": \\\"reset\\\",                         \\\"formfieldid\\\": \\\"0\\\",                         \\\"title\\\": \\\"Reset\\\",                         \\\"api_type\\\": \\\"element-reset\\\"                     },                     {                         \\\"type\\\": \\\"submit\\\",                         \\\"formfieldid\\\": \\\"1\\\",                         \\\"title\\\": \\\"Submit\\\",                         \\\"api_type\\\": \\\"element-button-submit\\\"                     }                 ]             ]         ]     }\"', 'Mm0O7ZjYwT', 0, 1, 0, 0, 0, '65fd42f4-717c-4570-812f-0de578ba2b37'),
(18, 59, 33, 36, '2016-12-19 06:51:52', '2016-12-19 06:51:52', 61, '\"{         \\\"title\\\": \\\"Test\\\",         \\\"description\\\": \\\"\\\",         \\\"fields\\\": [             [                 [                     {                         \\\"fieldid\\\": \\\"1\\\",                         \\\"formfieldid\\\": \\\"226\\\",                         \\\"type\\\": \\\"text\\\",                         \\\"title\\\": \\\"Single Line Text\\\",                         \\\"required\\\": \\\"0\\\",                         \\\"api_type\\\": \\\"element-single-line-text\\\",                         \\\"fieldtype\\\": \\\"2\\\", \\\"value\\\":\\\"Ramesh\\\"                     }                 ],                 [                     {                         \\\"fieldid\\\": \\\"2\\\",                         \\\"formfieldid\\\": \\\"227\\\",                         \\\"type\\\": \\\"radio\\\",                         \\\"title\\\": \\\"Radio\\\",                         \\\"choices\\\": [                             {                                 \\\"title\\\": \\\"Rajesh\\\",                                 \\\"id\\\": \\\"93\\\",                                 \\\"checked\\\": \\\"0\\\"                             },                             {                                 \\\"title\\\": \\\"Kannan\\\",                                 \\\"id\\\": \\\"94\\\",                                 \\\"checked\\\": \\\"0\\\"                             }                         ],                         \\\"required\\\": \\\"0\\\",                         \\\"api_type\\\": \\\"element-either-or-choice\\\",                         \\\"fieldtype\\\": \\\"1\\\",    \\\"value\\\":\\\"Rajesh\\\"                     }                 ],                 [                     {                         \\\"type\\\": \\\"reset\\\",                         \\\"formfieldid\\\": \\\"0\\\",                         \\\"title\\\": \\\"Reset\\\",                         \\\"api_type\\\": \\\"element-reset\\\"                     },                     {                         \\\"type\\\": \\\"submit\\\",                         \\\"formfieldid\\\": \\\"1\\\",                         \\\"title\\\": \\\"Submit\\\",                         \\\"api_type\\\": \\\"element-button-submit\\\"                     }                 ]             ]         ]     }\"', 'z78S9yb1EU', 0, 1, 0, 0, 0, 'fa0e0f25-c2c2-46cf-90e9-2389888968f0'),
(19, 59, 33, 36, '2016-12-19 06:52:39', '2016-12-19 06:52:39', 61, '\"{         \\\"title\\\": \\\"Test\\\",         \\\"description\\\": \\\"\\\",         \\\"fields\\\": [             [                 [                     {                         \\\"fieldid\\\": \\\"1\\\",                         \\\"formfieldid\\\": \\\"226\\\",                         \\\"type\\\": \\\"text\\\",                         \\\"title\\\": \\\"Single Line Text\\\",                         \\\"required\\\": \\\"0\\\",                         \\\"api_type\\\": \\\"element-single-line-text\\\",                         \\\"fieldtype\\\": \\\"2\\\", \\\"value\\\":\\\"Kannan\\\"                     }                 ],                 [                     {                         \\\"fieldid\\\": \\\"2\\\",                         \\\"formfieldid\\\": \\\"227\\\",                         \\\"type\\\": \\\"radio\\\",                         \\\"title\\\": \\\"Radio\\\",                         \\\"choices\\\": [                             {                                 \\\"title\\\": \\\"Rajesh\\\",                                 \\\"id\\\": \\\"93\\\",                                 \\\"checked\\\": \\\"0\\\"                             },                             {                                 \\\"title\\\": \\\"Kannan\\\",                                 \\\"id\\\": \\\"94\\\",                                 \\\"checked\\\": \\\"0\\\"                             }                         ],                         \\\"required\\\": \\\"0\\\",                         \\\"api_type\\\": \\\"element-either-or-choice\\\",                         \\\"fieldtype\\\": \\\"1\\\",    \\\"value\\\":\\\"Rajesh\\\"                     }                 ],                 [                     {                         \\\"type\\\": \\\"reset\\\",                         \\\"formfieldid\\\": \\\"0\\\",                         \\\"title\\\": \\\"Reset\\\",                         \\\"api_type\\\": \\\"element-reset\\\"                     },                     {                         \\\"type\\\": \\\"submit\\\",                         \\\"formfieldid\\\": \\\"1\\\",                         \\\"title\\\": \\\"Submit\\\",                         \\\"api_type\\\": \\\"element-button-submit\\\"                     }                 ]             ]         ]     }\"', 'k3OC09KEV8', 0, 1, 0, 0, 0, '9e3baf1a-5afd-4f17-a6db-44de4775bd24'),
(20, 67, 35, 39, '2016-12-21 13:16:31', '2016-12-21 13:16:31', 60, '{\n  \"title\" : \"Feedback - Food Festival - Team 2\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"formfieldid\" : \"214\",\n          \"title\" : \"Feedback - Food Festival - 2016\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"215\",\n          \"title\" : \"First Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Satheesh\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"216\",\n          \"title\" : \"Middle Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"217\",\n          \"title\" : \"Last Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Kannan\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"218\",\n          \"title\" : \"Employee ID\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"INO0187\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"219\",\n          \"title\" : \"Email\",\n          \"api_type\" : \"element-email\",\n          \"value\" : \"a@a.in\",\n          \"type\" : \"email\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"10\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"220\",\n          \"title\" : \"Department\",\n          \"choices\" : [\n            {\n              \"title\" : \"Mobile\",\n              \"id\" : \"83\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Magento\",\n              \"id\" : \"84\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Drupal\",\n              \"id\" : \"85\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Design\",\n              \"id\" : \"86\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"QA\",\n              \"id\" : \"87\",\n              \"checked\" : \"0\"\n            }\n          ],\n          \"value\" : \"\",\n          \"type\" : \"select\",\n          \"required\" : \"0\",\n          \"api_type\" : \"element-single-select\",\n          \"fieldid\" : \"8\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"221\",\n          \"title\" : \"Food Varities\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"222\",\n          \"title\" : \"\",\n          \"choices\" : [\n            {\n              \"title\" : \"One\",\n              \"id\" : \"88\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Two\",\n              \"id\" : \"89\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Three\",\n              \"id\" : \"90\",\n              \"checked\" : 1\n            },\n            {\n              \"title\" : \"Four\",\n              \"id\" : \"91\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Five\",\n              \"id\" : \"92\",\n              \"checked\" : 0\n            }\n          ],\n          \"value\" : \"Three\",\n          \"type\" : \"radio\",\n          \"api_type\" : \"element-either-or-choice\",\n          \"required\" : \"0\",\n          \"fieldid\" : \"2\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"223\",\n          \"title\" : \"Food Taste\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"224\",\n          \"title\" : \"Food Quality\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"225\",\n          \"title\" : \"Quality Of Service\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"api_type\" : \"element-reset\",\n          \"type\" : \"reset\",\n          \"value\" : \"\"\n        },\n        {\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"api_type\" : \"element-button-submit\",\n          \"type\" : \"submit\",\n          \"value\" : \"\"\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', '9RaBGqEQZX', 0, 1, 0, 0, 0, 'cc82ba2d-fa76-4a25-af10-b4cad6d69fa2'),
(21, 67, 35, 39, '2016-12-21 13:35:28', '2016-12-21 13:35:28', 60, '{         \"title\": \"Feedback - Food Festival - Team 2\",         \"description\": \"\",         \"fields\": [             [                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"214\",                         \"type\": \"heading\",                         \"title\": \"Feedback - Food Festival - 2016\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"215\",                         \"type\": \"text\",                         \"title\": \"First Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\",    \"value\":\"Rajesh\"                     },                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"216\",                         \"type\": \"text\",                         \"title\": \"Middle Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"217\",                         \"type\": \"text\",                         \"title\": \"Last Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\",    \"value\" :\"Kannan\"                     }                 ],                 [                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"218\",                         \"type\": \"text\",                         \"title\": \"Employee ID\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"10\",                         \"formfieldid\": \"219\",                         \"type\": \"email\",                         \"title\": \"Email\",                         \"required\": \"0\",                         \"api_type\": \"element-email\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"8\",                         \"formfieldid\": \"220\",                         \"type\": \"select\",                         \"title\": \"Department\",                         \"choices\": [                             {                                 \"title\": \"Mobile\",                                 \"id\": \"83\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Magento\",                                 \"id\": \"84\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Drupal\",                                 \"id\": \"85\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Design\",                                 \"id\": \"86\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"QA\",                                 \"id\": \"87\",                                 \"checked\": \"0\"                             }                         ],                         \"required\": \"0\",                         \"api_type\": \"element-single-select\",                         \"fieldtype\": \"1\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"221\",                         \"type\": \"heading\",                         \"title\": \"Food Varities\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"2\",                         \"formfieldid\": \"222\",                         \"type\": \"radio\",                         \"title\": \"\",                         \"choices\": [                             {                                 \"title\": \"One\",                                 \"id\": \"88\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Two\",                                 \"id\": \"89\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Three\",                                 \"id\": \"90\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Four\",                                 \"id\": \"91\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Five\",                                 \"id\": \"92\",                                 \"checked\": \"0\"                             }                         ],                         \"required\": \"0\",                         \"api_type\": \"element-either-or-choice\",                         \"fieldtype\": \"1\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"223\",                         \"type\": \"heading\",                         \"title\": \"Food Taste\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"224\",                         \"type\": \"heading\",                         \"title\": \"Food Quality\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"225\",                         \"type\": \"heading\",                         \"title\": \"Quality Of Service\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"type\": \"reset\",                         \"formfieldid\": \"0\",                         \"title\": \"Reset\",                         \"api_type\": \"element-reset\"                     },                     {                         \"type\": \"submit\",                         \"formfieldid\": \"1\",                         \"title\": \"Submit\",                         \"api_type\": \"element-button-submit\"                     }                 ]             ]         ]     }', 'n9bFvfa_xT', 0, 1, 0, 0, 0, 'b01fbe37-155f-4462-948a-90752420a49e'),
(22, 67, 35, 39, '2016-12-21 13:51:52', '2016-12-21 13:51:52', 60, '{         \"title\": \"Feedback - Food Festival - Team 2\",         \"description\": \"\",         \"fields\": [             [                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"214\",                         \"type\": \"heading\",                         \"title\": \"Feedback - Food Festival - 2016\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"215\",                         \"type\": \"text\",                         \"title\": \"First Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\",    \"value\":\"Rajesh\"                     },                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"216\",                         \"type\": \"text\",                         \"title\": \"Middle Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"217\",                         \"type\": \"text\",                         \"title\": \"Last Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\",    \"value\" :\"Kannan\"                     }                 ],                 [                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"218\",                         \"type\": \"text\",                         \"title\": \"Employee ID\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"10\",                         \"formfieldid\": \"219\",                         \"type\": \"email\",                         \"title\": \"Email\",                         \"required\": \"0\",                         \"api_type\": \"element-email\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"8\",                         \"formfieldid\": \"220\",                         \"type\": \"select\",                         \"title\": \"Department\",                         \"choices\": [                             {                                 \"title\": \"Mobile\",                                 \"id\": \"83\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Magento\",                                 \"id\": \"84\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Drupal\",                                 \"id\": \"85\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Design\",                                 \"id\": \"86\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"QA\",                                 \"id\": \"87\",                                 \"checked\": \"0\"                             }                         ],                         \"required\": \"0\",                         \"api_type\": \"element-single-select\",                         \"fieldtype\": \"1\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"221\",                         \"type\": \"heading\",                         \"title\": \"Food Varities\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"2\",                         \"formfieldid\": \"222\",                         \"type\": \"radio\",                         \"title\": \"\",                         \"choices\": [                             {                                 \"title\": \"One\",                                 \"id\": \"88\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Two\",                                 \"id\": \"89\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Three\",                                 \"id\": \"90\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Four\",                                 \"id\": \"91\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Five\",                                 \"id\": \"92\",                                 \"checked\": \"0\"                             }                         ],                         \"required\": \"0\",                         \"api_type\": \"element-either-or-choice\",                         \"fieldtype\": \"1\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"223\",                         \"type\": \"heading\",                         \"title\": \"Food Taste\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"224\",                         \"type\": \"heading\",                         \"title\": \"Food Quality\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"225\",                         \"type\": \"heading\",                         \"title\": \"Quality Of Service\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"type\": \"reset\",                         \"formfieldid\": \"0\",                         \"title\": \"Reset\",                         \"api_type\": \"element-reset\"                     },                     {                         \"type\": \"submit\",                         \"formfieldid\": \"1\",                         \"title\": \"Submit\",                         \"api_type\": \"element-button-submit\"                     }                 ]             ]         ]     }', '4jB90DyfVP', 0, 1, 0, 0, 0, 'ae111332-307d-4651-a84f-8121afb3e536');
INSERT INTO `form_submission` (`id`, `user_id`, `org_id`, `location_id`, `created_at`, `updated_at`, `form_id`, `submission`, `token`, `form_hierarchy_position_id`, `status`, `reassigned_by`, `reassigned_to`, `declined_by`, `uuid`) VALUES
(23, 67, 35, 39, '2016-12-21 13:52:18', '2016-12-21 13:52:18', 60, '{\n  \"title\" : \"Feedback - Food Festival - Team 2\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"formfieldid\" : \"214\",\n          \"title\" : \"Feedback - Food Festival - 2016\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"215\",\n          \"title\" : \"First Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Sdcdc\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"216\",\n          \"title\" : \"Middle Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"217\",\n          \"title\" : \"Last Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Bgbg\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"218\",\n          \"title\" : \"Employee ID\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"219\",\n          \"title\" : \"Email\",\n          \"api_type\" : \"element-email\",\n          \"value\" : \"\",\n          \"type\" : \"email\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"10\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"220\",\n          \"title\" : \"Department\",\n          \"choices\" : [\n            {\n              \"title\" : \"Mobile\",\n              \"id\" : \"83\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Magento\",\n              \"id\" : \"84\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Drupal\",\n              \"id\" : \"85\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Design\",\n              \"id\" : \"86\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"QA\",\n              \"id\" : \"87\",\n              \"checked\" : \"0\"\n            }\n          ],\n          \"value\" : \"\",\n          \"type\" : \"select\",\n          \"required\" : \"0\",\n          \"api_type\" : \"element-single-select\",\n          \"fieldid\" : \"8\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"221\",\n          \"title\" : \"Food Varities\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"222\",\n          \"title\" : \"\",\n          \"choices\" : [\n            {\n              \"title\" : \"One\",\n              \"id\" : \"88\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Two\",\n              \"id\" : \"89\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Three\",\n              \"id\" : \"90\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Four\",\n              \"id\" : \"91\",\n              \"checked\" : \"0\"\n            },\n            {\n              \"title\" : \"Five\",\n              \"id\" : \"92\",\n              \"checked\" : \"0\"\n            }\n          ],\n          \"value\" : \"\",\n          \"type\" : \"radio\",\n          \"api_type\" : \"element-either-or-choice\",\n          \"required\" : \"0\",\n          \"fieldid\" : \"2\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"223\",\n          \"title\" : \"Food Taste\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"224\",\n          \"title\" : \"Food Quality\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"225\",\n          \"title\" : \"Quality Of Service\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"api_type\" : \"element-reset\",\n          \"type\" : \"reset\",\n          \"value\" : \"\"\n        },\n        {\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"api_type\" : \"element-button-submit\",\n          \"type\" : \"submit\",\n          \"value\" : \"\"\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', 'JActqPQ3xn', 0, 1, 0, 0, 0, 'b84f4801-342a-4bcc-9854-0c0dca9e0578'),
(24, 67, 35, 39, '2016-12-21 13:57:12', '2016-12-21 13:57:12', 60, '{         \"title\": \"Feedback - Food Festival - Team 2\",         \"description\": \"\",         \"fields\": [             [                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"214\",                         \"type\": \"heading\",                         \"title\": \"Feedback - Food Festival - 2016\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"215\",                         \"type\": \"text\",                         \"title\": \"First Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\",    \"value\":\"Rajesh\"                     },                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"216\",                         \"type\": \"text\",                         \"title\": \"Middle Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"217\",                         \"type\": \"text\",                         \"title\": \"Last Name\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\",    \"value\" :\"Kannan\"                     }                 ],                 [                     {                         \"fieldid\": \"1\",                         \"formfieldid\": \"218\",                         \"type\": \"text\",                         \"title\": \"Employee ID\",                         \"required\": \"0\",                         \"api_type\": \"element-single-line-text\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"10\",                         \"formfieldid\": \"219\",                         \"type\": \"email\",                         \"title\": \"Email\",                         \"required\": \"0\",                         \"api_type\": \"element-email\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"8\",                         \"formfieldid\": \"220\",                         \"type\": \"select\",                         \"title\": \"Department\",                         \"choices\": [                             {                                 \"title\": \"Mobile\",                                 \"id\": \"83\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Magento\",                                 \"id\": \"84\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Drupal\",                                 \"id\": \"85\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Design\",                                 \"id\": \"86\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"QA\",                                 \"id\": \"87\",                                 \"checked\": \"0\"                             }                         ],                         \"required\": \"0\",                         \"api_type\": \"element-single-select\",                         \"fieldtype\": \"1\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"221\",                         \"type\": \"heading\",                         \"title\": \"Food Varities\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     },                     {                         \"fieldid\": \"2\",                         \"formfieldid\": \"222\",                         \"type\": \"radio\",                         \"title\": \"\",                         \"choices\": [                             {                                 \"title\": \"One\",                                 \"id\": \"88\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Two\",                                 \"id\": \"89\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Three\",                                 \"id\": \"90\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Four\",                                 \"id\": \"91\",                                 \"checked\": \"0\"                             },                             {                                 \"title\": \"Five\",                                 \"id\": \"92\",                                 \"checked\": \"0\"                             }                         ],                         \"required\": \"0\",                         \"api_type\": \"element-either-or-choice\",                         \"fieldtype\": \"1\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"223\",                         \"type\": \"heading\",                         \"title\": \"Food Taste\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"224\",                         \"type\": \"heading\",                         \"title\": \"Food Quality\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"fieldid\": \"17\",                         \"formfieldid\": \"225\",                         \"type\": \"heading\",                         \"title\": \"Quality Of Service\",                         \"required\": \"0\",                         \"api_type\": \"element-label\",                         \"fieldtype\": \"2\"                     }                 ],                 [                     {                         \"type\": \"reset\",                         \"formfieldid\": \"0\",                         \"title\": \"Reset\",                         \"api_type\": \"element-reset\"                     },                     {                         \"type\": \"submit\",                         \"formfieldid\": \"1\",                         \"title\": \"Submit\",                         \"api_type\": \"element-button-submit\"                     }                 ]             ]         ]     }', 'bkwnW34IvC', 0, 1, 0, 0, 0, '2dc8df31-07d3-40dd-ae08-3f7b75518ac2'),
(25, 67, 35, 39, '2016-12-21 13:57:42', '2016-12-21 13:57:42', 60, '{\n  \"title\" : \"Feedback - Food Festival - Team 2\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"formfieldid\" : \"214\",\n          \"title\" : \"Feedback - Food Festival - 2016\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"215\",\n          \"title\" : \"First Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Sa\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"216\",\n          \"title\" : \"Middle Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Ka\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"217\",\n          \"title\" : \"Last Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Av\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"218\",\n          \"title\" : \"Employee ID\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"INO0187\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"219\",\n          \"title\" : \"Email\",\n          \"api_type\" : \"element-email\",\n          \"value\" : \"a@a.in\",\n          \"type\" : \"email\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"10\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"220\",\n          \"title\" : \"Department\",\n          \"choices\" : [\n            {\n              \"title\" : \"Mobile\",\n              \"id\" : \"83\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Magento\",\n              \"id\" : \"84\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Drupal\",\n              \"id\" : \"85\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Design\",\n              \"id\" : \"86\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"QA\",\n              \"id\" : \"87\",\n              \"checked\" : 1\n            }\n          ],\n          \"value\" : \"QA\",\n          \"type\" : \"select\",\n          \"required\" : \"0\",\n          \"api_type\" : \"element-single-select\",\n          \"fieldid\" : \"8\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"221\",\n          \"title\" : \"Food Varities\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"222\",\n          \"title\" : \"\",\n          \"choices\" : [\n            {\n              \"title\" : \"One\",\n              \"id\" : \"88\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Two\",\n              \"id\" : \"89\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Three\",\n              \"id\" : \"90\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Four\",\n              \"id\" : \"91\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Five\",\n              \"id\" : \"92\",\n              \"checked\" : 1\n            }\n          ],\n          \"value\" : \"Five\",\n          \"type\" : \"radio\",\n          \"api_type\" : \"element-either-or-choice\",\n          \"required\" : \"0\",\n          \"fieldid\" : \"2\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"223\",\n          \"title\" : \"Food Taste\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"224\",\n          \"title\" : \"Food Quality\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"225\",\n          \"title\" : \"Quality Of Service\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"api_type\" : \"element-reset\",\n          \"type\" : \"reset\",\n          \"value\" : \"\"\n        },\n        {\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"api_type\" : \"element-button-submit\",\n          \"type\" : \"submit\",\n          \"value\" : \"\"\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', 'PjsUMNXmIq', 0, 1, 0, 0, 0, '559bea37-5822-4e75-bc8a-127f7c5fd8e6'),
(26, 67, 35, 39, '2016-12-21 13:59:27', '2016-12-21 13:59:27', 60, '{\n  \"title\" : \"Feedback - Food Festival - Team 2\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"formfieldid\" : \"214\",\n          \"title\" : \"Feedback - Food Festival - 2016\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"215\",\n          \"title\" : \"First Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Sa\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"216\",\n          \"title\" : \"Middle Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Ka\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"217\",\n          \"title\" : \"Last Name\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Av\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"218\",\n          \"title\" : \"Employee ID\",\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"INO0187\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"formfieldid\" : \"219\",\n          \"title\" : \"Email\",\n          \"api_type\" : \"element-email\",\n          \"value\" : \"a@a.in\",\n          \"type\" : \"email\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"10\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"220\",\n          \"title\" : \"Department\",\n          \"choices\" : [\n            {\n              \"title\" : \"Mobile\",\n              \"id\" : \"83\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Magento\",\n              \"id\" : \"84\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Drupal\",\n              \"id\" : \"85\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Design\",\n              \"id\" : \"86\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"QA\",\n              \"id\" : \"87\",\n              \"checked\" : 1\n            }\n          ],\n          \"value\" : \"QA\",\n          \"type\" : \"select\",\n          \"required\" : \"0\",\n          \"api_type\" : \"element-single-select\",\n          \"fieldid\" : \"8\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"221\",\n          \"title\" : \"Food Varities\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        },\n        {\n          \"fieldtype\" : \"1\",\n          \"formfieldid\" : \"222\",\n          \"title\" : \"\",\n          \"choices\" : [\n            {\n              \"title\" : \"One\",\n              \"id\" : \"88\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Two\",\n              \"id\" : \"89\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Three\",\n              \"id\" : \"90\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Four\",\n              \"id\" : \"91\",\n              \"checked\" : 0\n            },\n            {\n              \"title\" : \"Five\",\n              \"id\" : \"92\",\n              \"checked\" : 1\n            }\n          ],\n          \"value\" : \"Five\",\n          \"type\" : \"radio\",\n          \"api_type\" : \"element-either-or-choice\",\n          \"required\" : \"0\",\n          \"fieldid\" : \"2\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"223\",\n          \"title\" : \"Food Taste\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"224\",\n          \"title\" : \"Food Quality\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"225\",\n          \"title\" : \"Quality Of Service\",\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"17\"\n        }\n      ],\n      [\n        {\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"api_type\" : \"element-reset\",\n          \"type\" : \"reset\",\n          \"value\" : \"\"\n        },\n        {\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"api_type\" : \"element-button-submit\",\n          \"type\" : \"submit\",\n          \"value\" : \"\"\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', '4wkH_L0Xfq', 0, 1, 0, 0, 0, '66fb9a76-ef4c-4e33-a8f7-27a0c141f546'),
(27, 85, 43, 50, '2017-01-12 07:40:13', '2017-01-12 07:40:13', 72, '{\"title\":\"testing\",\"fields\":[[[{\"formfieldid\":\"251\",\"title\":\"Testing\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"252\",\"title\":\"Welcome\",\"api_type\":\"element-multi-line-text\",\"value\":\"Hi\",\"type\":\"textarea\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"6\",\"user_info_text_id\":101},{\"format\":\"MM\\/dd\\/yyyy\",\"formfieldid\":\"253\",\"title\":\"Date\",\"api_type\":\"element-date\",\"value\":\"02\\/12\\/2017\",\"type\":\"date\",\"required\":\"0\",\"fieldtype\":\"6\",\"fieldid\":\"4\",\"user_info_text_id\":102}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'Oz3jFkN1sW', 0, 0, 0, 0, 0, 'dc65a2fc-6318-4bd9-b770-49d3f4a421e8'),
(28, 85, 43, 50, '2017-01-12 08:11:52', '2017-01-12 08:11:52', 73, '{\"title\":\"TesterTesting\",\"fields\":[[[{\"formfieldid\":\"254\",\"title\":\"Fill the Form\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"255\",\"title\":\"Resume\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/73\\/85\\/cached1.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":103},{\"formfieldid\":\"256\",\"title\":\"Signature\",\"api_type\":\"element-signature\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/73\\/85\\/cached.jpg\",\"type\":\"signature\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"16\",\"user_info_text_id\":104}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'HUT2jYBZ5O', 0, 1, 0, 0, 0, '3eb15c94-9eff-441c-a6ed-23952634fd69'),
(29, 85, 43, 50, '2017-01-12 08:11:53', '2017-01-12 08:11:53', 73, '{\"title\":\"TesterTesting\",\"fields\":[[[{\"formfieldid\":\"254\",\"title\":\"Fill the Form\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"255\",\"title\":\"Resume\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/73\\/85\\/cached3.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":105},{\"formfieldid\":\"256\",\"title\":\"Signature\",\"api_type\":\"element-signature\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/73\\/85\\/cached2.jpg\",\"type\":\"signature\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"16\",\"user_info_text_id\":106}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'fDB_y627hX', 0, 1, 0, 0, 0, '83d1d2f0-44ba-495e-9574-7b49a6bec909'),
(30, 90, 43, 50, '2017-01-12 14:09:07', '2017-01-12 14:09:07', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Bhuji\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":107}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":109}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"ghjkkkkl@gmail.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":108}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'R2FBZTfVPD', 0, 1, 0, 0, 0, '669614c6-0249-48a0-bb89-1cbe722a5fe3'),
(31, 90, 43, 50, '2017-01-12 14:09:07', '2017-01-12 14:09:07', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Bhuji\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":110}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached1.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":112}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"ghjkkkkl@gmail.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":111}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', '9LTUfy_mjA', 0, 1, 0, 0, 0, '979ad9c9-6248-4684-89ff-f7f4b8aba09a'),
(32, 90, 43, 50, '2017-01-12 14:11:53', '2017-01-12 14:11:53', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Hukk\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":113}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached2.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":115}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"ghj@gmkil.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":114}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'rxPC1cJghf', 0, 1, 0, 0, 0, 'acd2675f-53a6-475b-badc-022cdcbd2df1'),
(33, 90, 43, 50, '2017-01-12 14:11:53', '2017-01-12 14:11:53', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Hukk\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":116}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached3.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":118}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"ghj@gmkil.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":117}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'I1tw8Kh3GD', 0, 1, 0, 0, 0, '8d5885c2-1e1c-46d7-8e41-49b5e0c56b1e'),
(34, 90, 43, 50, '2017-01-12 15:05:02', '2017-01-12 15:05:02', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Fhuj\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":119}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached4.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":121}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"fghjk@gmail.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":120}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'nc9KjMzqVR', 0, 1, 0, 0, 0, '1a74343f-780d-4acb-9978-61898db880de'),
(35, 90, 43, 50, '2017-01-12 15:33:01', '2017-01-12 15:33:01', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Nanthan\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":122}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":124}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"m@n.cc\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":123}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'a8M5y63nYs', 0, 1, 0, 0, 0, 'a643e4b2-7d70-4513-a277-e834cefcf85d'),
(36, 90, 43, 50, '2017-01-12 15:33:01', '2017-01-12 15:33:01', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Nanthan\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":125}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":127}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"m@n.cc\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":126}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'bhgjUn2ANX', 0, 1, 0, 0, 0, '52b60550-1e80-4109-83ac-9edb99c131eb'),
(37, 80, 41, 47, '2017-01-12 19:02:28', '2017-01-12 19:02:28', 71, '{\"title\":\"Test workflow\",\"fields\":[[[{\"formfieldid\":\"249\",\"title\":\"Single Line Text\",\"api_type\":\"element-single-line-text\",\"value\":\"Hah\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":128}],[{\"formfieldid\":\"250\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"hsh@he.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":129}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'qfyx08DvEa', 0, 0, 0, 0, 0, '5aec7204-a51a-406e-9c3c-dc34490e9d5a'),
(38, 82, 42, 48, '2017-01-12 19:07:30', '2017-01-13 09:54:14', 78, '{\n  \"title\" : \"Check Reporting\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"comments\" : \"Change...!!!!!!!!\",\n          \"user_info_text_id\" : 130,\n          \"formfieldid\" : \"275\",\n          \"title\" : \"Single Line Text\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Yes\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"comments\" : \"Change the number\",\n          \"user_info_text_id\" : 131,\n          \"formfieldid\" : \"276\",\n          \"title\" : \"Number\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"1234567\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"18\"\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-reset\",\n          \"value\" : \"\",\n          \"type\" : \"reset\",\n          \"user_info_text_id\" : null\n        },\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-button-submit\",\n          \"value\" : \"\",\n          \"type\" : \"submit\",\n          \"user_info_text_id\" : null\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', 'd8H54STEgV', 0, 2, 81, 81, 81, 'c4dd1e12-f21e-41f6-beb9-b649583dfcc3'),
(39, 82, 42, 48, '2017-01-13 10:02:31', '2017-01-13 10:22:11', 78, '{\n  \"title\" : \"Check Reporting\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"comments\" : \" \",\n          \"user_info_text_id\" : 132,\n          \"formfieldid\" : \"275\",\n          \"title\" : \"Single Line Text\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Kannan\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"1\"\n        },\n        {\n          \"comments\" : \" \",\n          \"user_info_text_id\" : 133,\n          \"formfieldid\" : \"276\",\n          \"title\" : \"Number\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"12345\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"fieldid\" : \"18\"\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-reset\",\n          \"value\" : \"\",\n          \"type\" : \"reset\",\n          \"user_info_text_id\" : null\n        },\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-button-submit\",\n          \"value\" : \"\",\n          \"type\" : \"submit\",\n          \"user_info_text_id\" : null\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', 'XEAaLYy1Zg', 0, 0, 0, 0, 0, '3859c1a9-b6c2-4900-b547-b3c476bedc16'),
(40, 90, 43, 50, '2017-01-13 10:44:37', '2017-01-13 10:44:37', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Wioih\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":134}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached5.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":136}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"hiio@dmm.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":135}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 's9wAICZY7K', 0, 1, 0, 0, 0, 'e522fd29-c5de-4418-8498-f530bd59371f'),
(41, 90, 43, 50, '2017-01-13 10:44:38', '2017-01-13 10:44:38', 75, '{\"title\":\"new\",\"fields\":[[[{\"formfieldid\":\"262\",\"title\":\"name\",\"api_type\":\"element-single-line-text\",\"value\":\"Wioih\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":137}],[{\"formfieldid\":\"263\",\"title\":\"File Upload\",\"api_type\":\"element-single-file\",\"value\":\"http:\\/\\/www.innoforms.com\\/uploads\\/43\\/50\\/75\\/90\\/cached6.jpg\",\"type\":\"file\",\"required\":\"0\",\"fieldtype\":\"3\",\"fieldid\":\"11\",\"user_info_text_id\":139}],[{\"formfieldid\":\"264\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"hiio@dmm.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":138}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'dYxVaLWzNJ', 0, 1, 0, 0, 0, 'bf97bb1b-e22c-48a1-9652-63e96a1872ae'),
(42, 94, 47, 54, '2017-01-13 12:19:33', '2017-01-13 12:40:24', 81, '{\n  \"title\" : \"Profile Form\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"17\",\n          \"formfieldid\" : \"295\",\n          \"title\" : \"Profile Form\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : null\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"10\",\n          \"formfieldid\" : \"296\",\n          \"title\" : \"Email\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-email\",\n          \"value\" : \"tamilselvan.k@innoppl.com\",\n          \"type\" : \"email\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 141\n        },\n        {\n          \"comments\" : \"Name is invalid\",\n          \"fieldid\" : \"1\",\n          \"formfieldid\" : \"297\",\n          \"title\" : \"Name\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Tamilselvan kalimuthu\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 140\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-reset\",\n          \"value\" : \"\",\n          \"type\" : \"reset\",\n          \"user_info_text_id\" : null\n        },\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-button-submit\",\n          \"value\" : \"\",\n          \"type\" : \"submit\",\n          \"user_info_text_id\" : null\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', 'Wh1ayxJ7Rc', 0, 1, 93, 93, 0, '3fe48542-76b6-4e04-8ac6-1edd91e46cd5');
INSERT INTO `form_submission` (`id`, `user_id`, `org_id`, `location_id`, `created_at`, `updated_at`, `form_id`, `submission`, `token`, `form_hierarchy_position_id`, `status`, `reassigned_by`, `reassigned_to`, `declined_by`, `uuid`) VALUES
(43, 103, 49, 58, '2017-01-13 16:18:21', '2017-01-13 16:21:48', 88, '{\n  \"title\" : \"Construction Bid\",\n  \"fields\" : [\n    [\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"1\",\n          \"formfieldid\" : \"357\",\n          \"title\" : \"Constructor Name\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"Mahboob\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 146\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"6\",\n          \"formfieldid\" : \"358\",\n          \"title\" : \"Address\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-multi-line-text\",\n          \"value\" : \"Kuwait\",\n          \"type\" : \"textarea\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 145\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"359\",\n          \"title\" : \"Phone Number\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"567894321\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 142\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"10\",\n          \"formfieldid\" : \"360\",\n          \"title\" : \"Email Address\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-email\",\n          \"value\" : \"mahaboob@innoppl.com\",\n          \"type\" : \"email\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 149\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"1\",\n          \"formfieldid\" : \"361\",\n          \"title\" : \"Project Site\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-single-line-text\",\n          \"value\" : \"\",\n          \"type\" : \"text\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : null\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"6\",\n          \"formfieldid\" : \"362\",\n          \"title\" : \"Description of the project\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-multi-line-text\",\n          \"value\" : \"100 story building\",\n          \"type\" : \"textarea\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 151\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"363\",\n          \"title\" : \"Lump Sum bid price $\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"500000\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 148\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"17\",\n          \"formfieldid\" : \"364\",\n          \"title\" : \"Contractor\'s fee will be determined with the following\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-label\",\n          \"value\" : \"\",\n          \"type\" : \"heading\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : null\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"365\",\n          \"title\" : \"Payroll costs $\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"5000\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 143\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"366\",\n          \"title\" : \"Material and Equipments $\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"1000\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 152\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"367\",\n          \"title\" : \"Payment for Sub contractor $\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"5000\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 150\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"368\",\n          \"title\" : \"Payment for special consultant $\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"50000\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 147\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"18\",\n          \"formfieldid\" : \"369\",\n          \"title\" : \"Maximum amount payable to contractor will not exceed $\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-number\",\n          \"value\" : \"1000\",\n          \"type\" : \"number\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"2\",\n          \"user_info_text_id\" : 144\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"fieldid\" : \"16\",\n          \"formfieldid\" : \"370\",\n          \"title\" : \"Signature\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-signature\",\n          \"value\" : \"http:\\/\\/www.innoforms.com\\/uploads\\/49\\/58\\/88\\/103\\/cached.jpg\",\n          \"type\" : \"signature\",\n          \"required\" : \"0\",\n          \"fieldtype\" : \"3\",\n          \"user_info_text_id\" : 153\n        }\n      ],\n      [\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"0\",\n          \"title\" : \"Reset\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-reset\",\n          \"value\" : \"\",\n          \"type\" : \"reset\",\n          \"user_info_text_id\" : null\n        },\n        {\n          \"comments\" : \" \",\n          \"formfieldid\" : \"1\",\n          \"title\" : \"Submit\",\n          \"isenabled\" : 0,\n          \"api_type\" : \"element-button-submit\",\n          \"value\" : \"\",\n          \"type\" : \"submit\",\n          \"user_info_text_id\" : null\n        }\n      ]\n    ]\n  ],\n  \"description\" : \"\"\n}', '1tfV5S90k3', 0, 1, 0, 0, 0, '8547c9e7-2b08-43ba-b778-3b125f406b40'),
(44, 108, 51, 62, '2017-01-23 06:26:39', '2017-01-23 06:26:39', 90, '{\"title\":\"pot\",\"fields\":[[[{\"formfieldid\":\"376\",\"title\":\"first name\",\"api_type\":\"element-single-line-text\",\"value\":\"Testing\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":154}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'SwfOTLabDI', 0, 1, 0, 0, 0, 'd5d1b876-aa87-4702-9c55-9125dc10f5b2'),
(45, 108, 51, 62, '2017-01-23 07:17:19', '2017-01-23 07:17:19', 91, '{\"title\":\"plop\",\"fields\":[[[{\"formfieldid\":\"377\",\"title\":\"Single Line Text\",\"api_type\":\"element-single-line-text\",\"value\":\"Poper\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":155},{\"formfieldid\":\"378\",\"title\":\"Email\",\"api_type\":\"element-email\",\"value\":\"b@b.com\",\"type\":\"email\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"10\",\"user_info_text_id\":156},{\"formfieldid\":\"379\",\"title\":\"Heading\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"fieldid\":\"2\",\"formfieldid\":\"380\",\"title\":\"Radio\",\"choices\":[{\"title\":\"Yes\",\"id\":\"121\",\"checked\":\"0\"},{\"title\":\"No\",\"id\":\"122\",\"checked\":\"0\"}],\"value\":\"\",\"type\":\"radio\",\"required\":\"0\",\"fieldtype\":\"1\",\"api_type\":\"element-either-or-choice\",\"user_info_text_id\":null},{\"formfieldid\":\"381\",\"title\":\"Multi Line Text\",\"api_type\":\"element-multi-line-text\",\"value\":\"\",\"type\":\"textarea\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"6\",\"user_info_text_id\":null},{\"formfieldid\":\"382\",\"title\":\"Heading\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"383\",\"title\":\"Single Line Text\",\"api_type\":\"element-single-line-text\",\"value\":\"\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":null},{\"fieldid\":\"3\",\"formfieldid\":\"384\",\"title\":\"Multi choice\",\"choices\":[{\"title\":\"First Option\",\"id\":\"123\",\"checked\":\"0\"}],\"value\":\"\",\"api_type\":\"element-multi-choice\",\"required\":\"0\",\"fieldtype\":\"1\",\"type\":\"checkbox\",\"user_info_text_id\":null},{\"formfieldid\":\"385\",\"title\":\"\",\"api_type\":\"element-single-line-text\",\"value\":\"\",\"type\":\"text\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"1\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'qdg7xT1Etv', 0, 1, 0, 0, 0, 'bb948bbe-ab0f-4894-970e-bdc4e926cbc5'),
(46, 108, 51, 62, '2017-01-23 07:29:54', '2017-01-23 07:29:54', 92, '{\"title\":\"Rasdasd\",\"fields\":[[[{\"formfieldid\":\"386\",\"title\":\"Heading\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'jRI1Ersq6B', 0, 1, 0, 0, 0, '7101e7eb-4b54-49aa-a523-c1a6a9b94425'),
(47, 108, 51, 62, '2017-01-23 07:30:25', '2017-01-23 07:30:25', 92, '{\"title\":\"Rasdasd\",\"fields\":[[[{\"formfieldid\":\"386\",\"title\":\"Heading\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'F1zjt4xJ6Q', 0, 1, 0, 0, 0, '957dea40-e2d3-47c1-9fda-99af69e0c8a1'),
(48, 108, 51, 62, '2017-01-23 10:27:46', '2017-01-23 10:27:46', 92, '{\"title\":\"Rasdasd\",\"fields\":[[[{\"formfieldid\":\"386\",\"title\":\"Heading\",\"api_type\":\"element-label\",\"value\":\"\",\"type\":\"heading\",\"required\":\"0\",\"fieldtype\":\"2\",\"fieldid\":\"17\",\"user_info_text_id\":null}],[{\"formfieldid\":\"0\",\"title\":\"Reset\",\"api_type\":\"element-reset\",\"type\":\"reset\",\"value\":\"\",\"user_info_text_id\":null},{\"formfieldid\":\"1\",\"title\":\"Submit\",\"api_type\":\"element-button-submit\",\"type\":\"submit\",\"value\":\"\",\"user_info_text_id\":null}]]],\"description\":\"\"}', 'YpJQky380c', 0, 1, 0, 0, 0, 'ac9d7e27-0ea0-482e-8eaa-6d3713662b3e');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loc_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `default` enum('0','1') NOT NULL,
  `status` enum('0','1','-1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `country_name`, `created_at`, `updated_at`, `created_by`, `default`, `status`) VALUES
(2, 'United Arab Emirates', '0000-00-00 00:00:00', '2016-04-25 03:13:21', 0, '1', '1'),
(3, 'Afghanistan', '0000-00-00 00:00:00', '2017-01-04 03:25:10', 1, '0', '1'),
(4, 'Antigua and Barbuda', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(5, 'Anguilla', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(6, 'Albania', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(7, 'Armenia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(8, 'Angola', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '0'),
(9, 'Antarctica', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(10, 'Argentina', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(11, 'American Samoa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(12, 'Austria', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(13, 'Australia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(14, 'Aruba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(15, 'Åland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(16, 'Azerbaijan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(17, 'Bosnia and Herzegovina', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(18, 'Barbados', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(19, 'Bangladesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(20, 'Belgium', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(21, 'Burkina Faso', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(22, 'Bulgaria', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(23, 'Bahrain', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(24, 'Burundi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(25, 'Benin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(26, 'Saint Barthélemy', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(27, 'Bermuda', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(28, 'Brunei', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(29, 'Bolivia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(30, 'Bonaire', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(31, 'Brazil', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(32, 'Bahamas', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(33, 'Bhutan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(34, 'Bouvet Island', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(35, 'Botswana', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(36, 'Belarus', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(37, 'Belize', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(38, 'Canada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(39, 'Cocos [Keeling] Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(40, 'Democratic Republic of the Congo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(41, 'Central African Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(42, 'Republic of the Congo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(43, 'Switzerland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(44, 'Ivory Coast', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(45, 'Cook Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(46, 'Chile', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(47, 'Cameroon', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(48, 'China', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(49, 'Colombia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(50, 'Costa Rica', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(51, 'Cuba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(52, 'Cape Verde', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(53, 'Curacao', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(54, 'Christmas Island', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(55, 'Cyprus', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(56, 'Czech Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(57, 'Germany', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(58, 'Djibouti', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(59, 'Denmark', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(60, 'Dominica', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(61, 'Dominican Republic', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(62, 'Algeria', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(63, 'Ecuador', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(64, 'Estonia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(65, 'Egypt', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(66, 'Western Sahara', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(67, 'Eritrea', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(68, 'Spain', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(69, 'Ethiopia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(70, 'Finland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(71, 'Fiji', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(72, 'Falkland Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(73, 'Micronesia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(74, 'Faroe Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(75, 'France', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(76, 'Gabon', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(77, 'United Kingdom', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(78, 'Grenada', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(79, 'Georgia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(80, 'French Guiana', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(81, 'Guernsey', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(82, 'Ghana', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(83, 'Gibraltar', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(84, 'Greenland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(85, 'Gambia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(86, 'Guinea', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(87, 'Guadeloupe', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(88, 'Equatorial Guinea', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(89, 'Greece', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(90, 'South Georgia and the South Sandwich Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(91, 'Guatemala', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(92, 'Guam', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(93, 'Guinea-Bissau', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(94, 'Guyana', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(95, 'Hong Kong', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(96, 'Heard Island and McDonald Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(97, 'Honduras', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(98, 'Croatia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(99, 'Haiti', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(100, 'Hungary', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(101, 'Indonesia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(102, 'Ireland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(103, 'Israel', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(104, 'Isle of Man', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(105, 'India', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(106, 'British Indian Ocean Territory', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(107, 'Iraq', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(108, 'Iran', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(109, 'Iceland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(110, 'Italy', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(111, 'Jersey', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(112, 'Jamaica', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(113, 'Jordan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(114, 'Japan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(115, 'Kenya', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(116, 'Kyrgyzstan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(117, 'Cambodia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(118, 'Kiribati', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(119, 'Comoros', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(120, 'Saint Kitts and Nevis', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(121, 'North Korea', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(122, 'South Korea', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(123, 'Kuwait', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(124, 'Cayman Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(125, 'Kazakhstan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(126, 'Laos', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(127, 'Lebanon', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(128, 'Saint Lucia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(129, 'Liechtenstein', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(130, 'Sri Lanka', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(131, 'Liberia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(132, 'Lesotho', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(133, 'Lithuania', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(134, 'Luxembourg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(135, 'Latvia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(136, 'Libya', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(137, 'Morocco', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(138, 'Monaco', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(139, 'Moldova', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(140, 'Montenegro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(141, 'Saint Martin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(142, 'Madagascar', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(143, 'Marshall Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(144, 'Macedonia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(145, 'Mali', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(146, 'Myanmar [Burma]', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(147, 'Mongolia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(148, 'Macao', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(149, 'Northern Mariana Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(150, 'Martinique', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(151, 'Mauritania', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(152, 'Montserrat', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(153, 'Malta', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(154, 'Mauritius', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(155, 'Maldives', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(156, 'Malawi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(157, 'Mexico', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(158, 'Malaysia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(159, 'Mozambique', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(160, 'Namibia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(161, 'New Caledonia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(162, 'Niger', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(163, 'Norfolk Island', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(164, 'Nigeria', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(165, 'Nicaragua', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(166, 'Netherlands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(167, 'Norway', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(168, 'Nepal', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(169, 'Nauru', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(170, 'Niue', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(171, 'New Zealand', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(172, 'Oman', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(173, 'Panama', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(174, 'Peru', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(175, 'French Polynesia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(176, 'Papua New Guinea', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(177, 'Philippines', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(178, 'Pakistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(179, 'Poland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(180, 'Saint Pierre and Miquelon', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(181, 'Pitcairn Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(182, 'Puerto Rico', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(183, 'Palestine', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(184, 'Portugal', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(185, 'Palau', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(186, 'Paraguay', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(187, 'Qatar', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(188, 'Réunion', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(189, 'Romania', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(190, 'Serbia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(191, 'Russia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(192, 'Rwanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(193, 'Saudi Arabia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(194, 'Solomon Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(195, 'Seychelles', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(196, 'Sudan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(197, 'Sweden', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(198, 'Singapore', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(199, 'Saint Helena', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(200, 'Slovenia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(201, 'Svalbard and Jan Mayen', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(202, 'Slovakia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(203, 'Sierra Leone', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(204, 'San Marino', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(205, 'Senegal', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(206, 'Somalia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(207, 'Suriname', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(208, 'South Sudan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(209, 'São Tomé and Príncipe', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(210, 'El Salvador', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(211, 'Sint Maarten', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(212, 'Syria', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(213, 'Swaziland', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(214, 'Turks and Caicos Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(215, 'Chad', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(216, 'French Southern Territories', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(217, 'Togo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(218, 'Thailand', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(219, 'Tajikistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(220, 'Tokelau', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(221, 'East Timor', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(222, 'Turkmenistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(223, 'Tunisia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(224, 'Tonga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(225, 'Turkey', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(226, 'Trinidad and Tobago', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(227, 'Tuvalu', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(228, 'Taiwan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(229, 'Tanzania', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(230, 'Ukraine', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(231, 'Uganda', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(232, 'U.S. Minor Outlying Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(233, 'United States', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(234, 'Uruguay', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(235, 'Uzbekistan', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(236, 'Vatican City', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(237, 'Saint Vincent and the Grenadines', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(238, 'Venezuela', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(239, 'British Virgin Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(240, 'U.S. Virgin Islands', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(241, 'Vietnam', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(242, 'Vanuatu', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(243, 'Wallis and Futuna', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(244, 'Samoa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(245, 'Kosovo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(246, 'Yemen', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(247, 'Mayotte', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(248, 'South Africa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(249, 'Zambia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(250, 'Zimbabwe', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '1'),
(251, 'canada', '2017-01-11 07:50:09', '2017-01-11 07:50:09', 1, '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notify_to` int(11) NOT NULL,
  `org_id` bigint(20) NOT NULL,
  `form_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `alert_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `type_id` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notify_to`, `org_id`, `form_id`, `submission_id`, `alert_id`, `status`, `type`, `type_id`, `message`, `created_at`, `updated_at`) VALUES
(13, 59, 33, 61, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":61,\"org_id\":\"33\",\"title\":\"Test form is assigned to you and ready for your submission \"}', '2016-12-19 06:06:30', '2016-12-19 06:06:30'),
(14, 57, 33, 61, 17, 0, 1, 'Form Submission', '1.2', '{\"title\":\"Submission against  is created\",\"form_id\":\"61\",\"org_id\":\"33\",\"submission_id\":17}', '2016-12-19 06:50:48', '2016-12-19 06:50:48'),
(15, 57, 33, 61, 18, 0, 1, 'Form Submission', '1.2', '{\"title\":\"Submission against  is created\",\"form_id\":\"61\",\"org_id\":\"33\",\"submission_id\":18}', '2016-12-19 06:51:52', '2016-12-19 06:51:52'),
(16, 57, 33, 61, 19, 0, 1, 'Form Submission', '1.2', '{\"title\":\"Submission against  is created\",\"form_id\":\"61\",\"org_id\":\"33\",\"submission_id\":19}', '2016-12-19 06:52:39', '2016-12-19 06:52:39'),
(24, 80, 41, 70, 0, 0, 1, '1.1', '1.1', '{\"form_id\":\"70\",\"org_id\":\"41\",\"title\":\"Test Forms default form is assigned to you and ready for your submission \"}', '2017-01-03 11:46:35', '2017-01-03 11:46:35'),
(25, 80, 41, 70, 0, 0, 1, '1.1', '1.1', '{\"form_id\":\"70\",\"org_id\":\"41\",\"title\":\"Test Forms default form is assigned to you and ready for your submission \"}', '2017-01-03 11:49:22', '2017-01-03 11:49:22'),
(26, 80, 41, 71, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"71\",\"org_id\":\"41\",\"title\":\"Test workflow form is assigned to you and ready for your submission \"}', '2017-01-03 11:55:54', '2017-01-03 11:55:54'),
(27, 85, 43, 72, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"72\",\"org_id\":\"43\",\"title\":\"testing form is assigned to you and ready for your submission \"}', '2017-01-11 12:50:58', '2017-01-11 12:50:58'),
(28, 85, 43, 73, 0, 0, 1, '1.1', '1.1', '{\"form_id\":73,\"org_id\":\"43\",\"title\":\"TesterTesting form is assigned to you and waiting for your submission \"}', '2017-01-12 07:30:22', '2017-01-12 07:30:22'),
(29, 89, 46, 74, 0, 0, 1, '1.1', '1.1', '{\"form_id\":74,\"org_id\":\"46\",\"title\":\"QAT IN ACTION form is assigned to you and waiting for your submission \"}', '2017-01-12 07:32:16', '2017-01-12 07:32:16'),
(30, 84, 43, 72, 27, 0, 1, 'Form Submission waiting for review', '1.3', '{\"title\":\"Submission against  is waiting for your review \",\"form_id\":\"72\",\"org_id\":\"43\",\"submission_id\":27,\"location_id\":\"50\"}', '2017-01-12 07:40:13', '2017-01-12 07:40:13'),
(31, 84, 43, 73, 28, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"73\",\"org_id\":\"43\",\"submission_id\":28,\"location_id\":\"50\"}', '2017-01-12 08:11:52', '2017-01-12 08:11:52'),
(32, 84, 43, 73, 29, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"73\",\"org_id\":\"43\",\"submission_id\":29,\"location_id\":\"50\"}', '2017-01-12 08:11:53', '2017-01-12 08:11:53'),
(33, 90, 43, 75, 0, 0, 1, '1.1', '1.1', '{\"form_id\":75,\"org_id\":\"43\",\"title\":\"new form is assigned to you and waiting for your submission \"}', '2017-01-12 14:06:57', '2017-01-12 14:06:57'),
(34, 84, 43, 75, 30, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":30,\"location_id\":\"50\"}', '2017-01-12 14:09:07', '2017-01-12 14:09:07'),
(35, 84, 43, 75, 31, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":31,\"location_id\":\"50\"}', '2017-01-12 14:09:07', '2017-01-12 14:09:07'),
(36, 84, 43, 75, 32, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":32,\"location_id\":\"50\"}', '2017-01-12 14:11:53', '2017-01-12 14:11:53'),
(37, 84, 43, 75, 33, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":33,\"location_id\":\"50\"}', '2017-01-12 14:11:53', '2017-01-12 14:11:53'),
(38, 84, 43, 75, 34, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":34,\"location_id\":\"50\"}', '2017-01-12 15:05:02', '2017-01-12 15:05:02'),
(39, 84, 43, 75, 35, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":35,\"location_id\":\"50\"}', '2017-01-12 15:33:01', '2017-01-12 15:33:01'),
(40, 84, 43, 75, 36, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":36,\"location_id\":\"50\"}', '2017-01-12 15:33:01', '2017-01-12 15:33:01'),
(41, 78, 41, 71, 37, 0, 1, 'Form Submission waiting for review', '1.3', '{\"title\":\"Submission against  is waiting for your review \",\"form_id\":\"71\",\"org_id\":\"41\",\"submission_id\":37,\"location_id\":\"47\"}', '2017-01-12 19:02:28', '2017-01-12 19:02:28'),
(42, 82, 42, 77, 0, 0, 1, '1.1', '1.1', '{\"form_id\":77,\"org_id\":\"42\",\"title\":\"Check Forms form is assigned to you and waiting for your submission \"}', '2017-01-12 19:05:22', '2017-01-12 19:05:22'),
(43, 82, 42, 78, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"78\",\"org_id\":\"42\",\"title\":\"Check Reporting form is assigned to you and ready for your submission \"}', '2017-01-12 19:06:06', '2017-01-12 19:06:06'),
(44, 81, 42, 78, 38, 0, 1, 'Form Submission waiting for review', '1.3', '{\"title\":\"Submission against  is waiting for your review \",\"form_id\":\"78\",\"org_id\":\"42\",\"submission_id\":38,\"location_id\":\"48\"}', '2017-01-12 19:07:30', '2017-01-12 19:07:30'),
(45, 81, 42, 78, 39, 0, 1, 'Form Submission waiting for review', '1.3', '{\"title\":\"Submission against  is waiting for your review \",\"form_id\":\"78\",\"org_id\":\"42\",\"submission_id\":39,\"location_id\":\"48\"}', '2017-01-13 10:02:31', '2017-01-13 10:02:31'),
(46, 84, 43, 75, 40, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":40,\"location_id\":\"50\"}', '2017-01-13 10:44:37', '2017-01-13 10:44:37'),
(47, 84, 43, 75, 41, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"75\",\"org_id\":\"43\",\"submission_id\":41,\"location_id\":\"50\"}', '2017-01-13 10:44:38', '2017-01-13 10:44:38'),
(48, 95, 47, 79, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"79\",\"org_id\":\"47\",\"title\":\"Manpower Requisition Form form is assigned to you and ready for your submission \"}', '2017-01-13 11:02:46', '2017-01-13 11:02:46'),
(49, 94, 47, 81, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"81\",\"org_id\":\"47\",\"title\":\"Profile Form form is assigned to you and ready for your submission \"}', '2017-01-13 12:08:26', '2017-01-13 12:08:26'),
(50, 93, 47, 81, 42, 0, 1, 'Form Submission waiting for review', '1.3', '{\"title\":\"Submission against  is waiting for your review \",\"form_id\":\"81\",\"org_id\":\"47\",\"submission_id\":42,\"location_id\":\"54\"}', '2017-01-13 12:19:33', '2017-01-13 12:19:33'),
(51, 102, 49, 84, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"84\",\"org_id\":\"49\",\"title\":\"sample form is assigned to you and ready for your submission \"}', '2017-01-13 14:50:17', '2017-01-13 14:50:17'),
(52, 102, 49, 82, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"82\",\"org_id\":\"49\",\"title\":\"Construction Release of Liability form is assigned to you and ready for your submission \"}', '2017-01-13 15:43:08', '2017-01-13 15:43:08'),
(53, 103, 49, 82, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"82\",\"org_id\":\"49\",\"title\":\"Construction Release of Liability form is assigned to you and ready for your submission \"}', '2017-01-13 15:43:08', '2017-01-13 15:43:08'),
(54, 102, 49, 83, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"83\",\"org_id\":\"49\",\"title\":\"Commercial Construction form is assigned to you and ready for your submission \"}', '2017-01-13 15:43:48', '2017-01-13 15:43:48'),
(55, 103, 49, 83, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"83\",\"org_id\":\"49\",\"title\":\"Commercial Construction form is assigned to you and ready for your submission \"}', '2017-01-13 15:43:48', '2017-01-13 15:43:48'),
(56, 102, 49, 88, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"88\",\"org_id\":\"49\",\"title\":\"Construction Bid form is assigned to you and ready for your submission \"}', '2017-01-13 16:07:09', '2017-01-13 16:07:09'),
(57, 103, 49, 88, 0, 0, 1, 'Form Creation', '1.1', '{\"form_id\":\"88\",\"org_id\":\"49\",\"title\":\"Construction Bid form is assigned to you and ready for your submission \"}', '2017-01-13 16:07:09', '2017-01-13 16:07:09'),
(58, 101, 49, 88, 43, 0, 1, 'Form Submission waiting for review', '1.3', '{\"title\":\"Submission against  is waiting for your review \",\"form_id\":\"88\",\"org_id\":\"49\",\"submission_id\":43,\"location_id\":\"58\"}', '2017-01-13 16:18:21', '2017-01-13 16:18:21'),
(59, 108, 51, 90, 0, 0, 1, '1.1', '1.1', '{\"form_id\":90,\"org_id\":\"51\",\"title\":\"pot form is assigned to you and waiting for your submission \"}', '2017-01-23 06:25:42', '2017-01-23 06:25:42'),
(60, 107, 51, 90, 44, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"90\",\"org_id\":\"51\",\"submission_id\":44,\"location_id\":\"62\"}', '2017-01-23 06:26:39', '2017-01-23 06:26:39'),
(61, 108, 51, 91, 0, 0, 1, '1.1', '1.1', '{\"form_id\":91,\"org_id\":\"51\",\"title\":\"plop form is assigned to you and waiting for your submission \"}', '2017-01-23 07:15:24', '2017-01-23 07:15:24'),
(62, 107, 51, 91, 45, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"91\",\"org_id\":\"51\",\"submission_id\":45,\"location_id\":\"62\"}', '2017-01-23 07:17:19', '2017-01-23 07:17:19'),
(63, 108, 51, 92, 0, 0, 1, '1.1', '1.1', '{\"form_id\":92,\"org_id\":\"51\",\"title\":\"Rasdasd form is assigned to you and waiting for your submission \"}', '2017-01-23 07:29:22', '2017-01-23 07:29:22'),
(64, 107, 51, 92, 46, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"92\",\"org_id\":\"51\",\"submission_id\":46,\"location_id\":\"62\"}', '2017-01-23 07:29:54', '2017-01-23 07:29:54'),
(65, 107, 51, 92, 47, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"92\",\"org_id\":\"51\",\"submission_id\":47,\"location_id\":\"62\"}', '2017-01-23 07:30:25', '2017-01-23 07:30:25'),
(66, 107, 51, 92, 48, 0, 1, 'Form Submission', '1.3', '{\"title\":\"Submission against  is created\",\"form_id\":\"92\",\"org_id\":\"51\",\"submission_id\":48,\"location_id\":\"62\"}', '2017-01-23 10:27:46', '2017-01-23 10:27:46');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` bigint(20) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `org_name` varchar(300) NOT NULL,
  `org_token` varchar(255) NOT NULL,
  `org_logo` varchar(300) NOT NULL,
  `dept_not_in` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=inactive, 1=active',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL,
  `org_dept_not_in` text,
  `org_cat_not_in` text,
  `system_default` int(11) DEFAULT NULL,
  `subscription_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `uuid`, `org_name`, `org_token`, `org_logo`, `dept_not_in`, `status`, `created_on`, `modified_on`, `org_dept_not_in`, `org_cat_not_in`, `system_default`, `subscription_id`) VALUES
(1, '539b1cb0-501e-4649-8292-da0e71e3c5c4', 'Innoforms', '', '', '', 1, '2017-01-13 04:47:48', '0000-00-00 00:00:00', '0', '0', 0, 0),
(33, '0afc9203-d134-4ef3-8c84-94ba60ebe5cc', 'Pothys', 'Wee2o1QGsbkNlyhLEVKtFvpVf/s=', '', '', 1, '2016-12-21 08:12:22', '2016-11-21 05:24:38', '0', '0', 1, 1),
(41, '399778a6-f17e-4c6b-927a-06629a1a6184', 'Chennai Silks', 'hOjGykSVjzxmQE5BSBp0PWSsqGQ=', '', '', 1, '2017-01-03 11:21:06', '2017-01-03 06:21:06', '0,14,15', '0,10,10,11', 1, 1),
(42, 'df407fa4-f676-4682-9fca-51fce989b781', 'Default Organization', 'AsrbjNIY1D9fgu3xcnVJ+eWuvVE=', '', '', 1, '2017-01-09 07:28:24', '2017-01-09 02:28:24', '0,1,2,7,8', '0,1,5,6', 1, 2),
(43, '3c9831b7-13bc-43d0-8425-e3297023e236', 'testing', '36D9BbHaoKposyjpz0jFAlIu5hU=', '', '', 1, '2017-01-11 12:20:02', '2017-01-11 07:20:02', '0', '0', 1, 1),
(44, 'cec3268d-98f8-49a4-8818-b1a773eb79df', 'cancer care unit', '6Xap1Vtz/fnqQ9zSMp+crhiSMHQ=', '1484139355-453859528b76397a5a12a9d2f36ba702.jpg', '', 0, '2017-01-12 06:26:57', '2017-01-11 07:55:55', '0', '0', 1, 1),
(45, 'a58c74ae-6a67-426d-8b1c-7589f4eff976', 'pharmacy', 'AUl3wu1hTuLos9oJ3RWddLTJxdE=', '1484205214-571e32a9497bc9ce85a05dda04543fd6.jpg', '', 0, '2017-01-17 05:10:56', '2017-01-12 02:13:34', '0,26,27,28', '0,19', 1, 1),
(46, '3ef5cf07-0ad5-4013-aad1-a667d0244d73', 'medicare', 'jGug4M0+9B8zTRYmmHH9idwydPM=', '', '', 0, '2017-01-17 05:11:11', '2017-01-12 02:16:49', '0,26,27,28', '0,19', 1, 1),
(47, '2f0c430e-8eeb-4ce8-bf1b-7f9310173db5', 'Innoppl Inc', 'dGmN+ZhiEtNUa+GA3HzV8DcQ9Qw=', '', '', 1, '2017-01-12 14:01:51', '2017-01-12 09:01:51', '0,1,2,7,8', '0,1,5,6', 1, 1),
(48, 'c4dad120-4278-4ab5-9c04-a3d2ce3752e5', 'BluegreenConstruction', 'tbv1QT0nAVgY1BCJctLEOFfbIFs=', '1484312302-3f71fc9744eb5262ccb538c8ccdb5e7f.jpg', '', 0, '2017-01-13 13:45:36', '2017-01-13 07:59:05', '0,43', '0', 1, 1),
(49, 'e9e29cd6-0e09-47fe-a6ec-219be41ece18', 'UAE Constructions', 'QoQpkeGpd/s2O7seIm/iNIPmJY8=', '', '', 1, '2017-01-13 13:52:54', '2017-01-13 08:52:54', '43', '', 0, 3),
(50, 'cdaac723-7b4c-446c-99b0-4cc613143e15', 'pinetree', 'eoozwTeUuJaZl4CnzHKQFEE2gEA=', '', '', 0, '2017-02-01 10:10:02', '2017-01-17 00:13:01', '1,2,7,8', '1,5,6,6', 0, 1),
(51, '5e9960e3-c7f1-44c8-b105-cdb7e1caafd0', 'pinacle', 'fnGQOS+7JUSOFre3Pu05nw7X8g8=', '', '', 0, '2017-02-01 09:47:28', '2017-01-23 01:08:14', '', '1,4,5,6,6,6,7,9,10,10,11,18,19,22', 0, 1),
(52, '2a516a12-74a3-4b15-8635-54bd5b9a7037', 'innomarketing', 'KK/cDqggwKW/gg53Q8mAbfV3Fyc=', '1485944751-3f71fc9744eb5262ccb538c8ccdb5e7f.jpg', '', 1, '2017-02-01 10:25:51', '2017-02-01 05:25:51', '0,1,2,7,8,47', '0,1,5,6', 1, 1),
(53, 'fd1a3b4b-4f81-447b-97c2-9dcd64da8233', 'New today', 'HU/f8i/N/b1TVq8HCMot250DjVo=', '1486034246-3f71fc9744eb5262ccb538c8ccdb5e7f.jpg', '', 0, '2017-02-07 11:39:29', '2017-02-02 06:17:26', '0,1,2,7,8,47', '0,1,5,6', 1, 1),
(54, '02db24c8-05bc-4260-aa8e-b9a5a856f4c8', 'Currenttrend', 'FbvzgW6aZQb4DkDCqUbEpUqBe0I=', '1486468938-3f71fc9744eb5262ccb538c8ccdb5e7f.jpg', '', 1, '2017-02-07 12:02:19', '2017-02-07 07:02:18', '0,61', '0', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization_subscription_plan`
--

CREATE TABLE `organization_subscription_plan` (
  `org_sub_plan_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `organization_id` bigint(20) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_subscription_plan`
--

INSERT INTO `organization_subscription_plan` (`org_sub_plan_id`, `subscription_id`, `organization_id`, `from_date`, `to_date`, `status`) VALUES
(6, 1, 33, '2016-12-21', '2017-03-21', 1),
(14, 1, 41, '2017-01-03', '2017-04-03', 1),
(15, 2, 42, '2017-01-09', '2017-04-09', 1),
(16, 1, 43, '2017-01-11', '2017-04-11', 1),
(17, 1, 44, '2017-01-11', '2017-04-11', 1),
(18, 1, 45, '2017-01-12', '2017-04-12', 1),
(19, 1, 46, '2017-01-12', '2017-04-12', 1),
(20, 1, 47, '2017-01-12', '2017-04-12', 1),
(21, 1, 48, '2017-01-13', '2017-04-13', 1),
(22, 3, 49, '2017-01-13', '2017-04-13', 1),
(23, 1, 50, '2017-01-17', '2017-04-17', 1),
(24, 1, 51, '2017-01-23', '2017-04-23', 1),
(25, 1, 52, '2017-02-01', '2017-05-01', 1),
(26, 1, 53, '2017-02-02', '2017-05-02', 1),
(27, 1, 54, '2017-02-07', '2017-05-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `org_domain`
--

CREATE TABLE `org_domain` (
  `id` int(11) NOT NULL,
  `org_location_id` bigint(20) NOT NULL,
  `domain_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `org_domain`
--

INSERT INTO `org_domain` (`id`, `org_location_id`, `domain_id`) VALUES
(1, 1, 1),
(6, 36, 2),
(14, 47, 5),
(15, 48, 1),
(16, 50, 3),
(17, 51, 7),
(18, 52, 7),
(19, 53, 7),
(20, 54, 1),
(21, 55, 8),
(22, 58, 8),
(23, 61, 1),
(24, 62, 9),
(25, 63, 1),
(26, 64, 1),
(27, 65, 11);

-- --------------------------------------------------------

--
-- Table structure for table `org_location`
--

CREATE TABLE `org_location` (
  `id` bigint(20) NOT NULL,
  `org_id` bigint(20) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `location_name` varchar(300) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=inactive, 1=active',
  `headbranch` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_location`
--

INSERT INTO `org_location` (`id`, `org_id`, `uuid`, `location_id`, `location_name`, `address`, `city`, `state`, `country`, `zip_code`, `status`, `headbranch`, `created_on`, `modified_on`) VALUES
(1, 1, '', 'CH001', 'Chennai', 'EMM Yes Park', 'Chennai', 'Tamilnadu', '105', '', 1, 1, '2016-08-22 09:37:43', '0000-00-00 00:00:00'),
(35, 1, '', 'Test', 'Test', 'Test', 'Test', 'Test', '105', '23234', 1, 0, '2016-11-18 09:25:46', '0000-00-00 00:00:00'),
(36, 33, 'eacd088c-b99b-44d7-bd03-b78e48eb65f7', '', 'T-Nagar', 'Usman Road', 'Chennai', 'Tamilnadu', '105', '623672', 1, 1, '2016-12-19 06:02:38', '2016-11-21 05:24:38'),
(37, 33, '69ee98e5-2f9d-4379-9c2f-54bc72d79cf5', 'CBE', 'Coimbatore', 'Gandhipuram', 'Coimbatore', 'Tamilnadu', '105', '342421', 1, 0, '2016-12-19 06:01:30', '0000-00-00 00:00:00'),
(41, 33, '35ddbdb5-27ef-4f24-8edb-2b8d0abdaecd', 'etsdgf', 'TGest', 'ffffdsfgsdfg', 'dsfgsdfg', 'dsfg', '105', '214234', 1, 0, '2016-12-16 11:24:03', '0000-00-00 00:00:00'),
(47, 41, '0643bc25-6c30-49a1-9835-0d10a9f60882', '', 'Test', 'Tet', 'Test', 'Test', '2', '124234', 1, 1, '2017-01-03 11:21:06', '2017-01-03 06:21:06'),
(48, 42, '0adc71f2-fcf2-4ccf-8338-3b4a53cd9612', 'DE000', 'Default', 'Organization', 'Default', 'Tamilnadu', '105', '21313212', 1, 1, '2017-01-09 07:28:24', '2017-01-09 02:28:24'),
(49, 42, 'd8109c2e-fab1-4789-89ea-9868ea83f236', '00001', 'Newyork', 'newyorks', 'newyork', 'CA', '233', '22222', 1, 0, '2017-01-11 10:06:03', '2017-01-11 10:06:03'),
(50, 43, 'cacc4fff-d912-4d33-aacd-d487607c7912', 'NE000', 'welcome, JOHN SMITH 300 BOYLSTON AVE', 'newyork', 'newyork', 'newyork', '2', '22222', 1, 1, '2017-01-11 12:20:02', '2017-01-11 07:01:40'),
(51, 44, 'a7d67fcb-1fe2-4599-8a23-38af501a181f', 'VO000', 'canada', 'cananda bristish colony', 'vontoro', 'cananda', '38', '678908', 1, 1, '2017-01-11 12:55:55', '2017-01-11 07:55:55'),
(52, 45, '39ffd715-9269-4d53-8750-d01485b8751e', 'CH000', 'canada', 'ab block', 'chennai', 'cananda', '38', '676877', 1, 1, '2017-01-12 07:13:34', '2017-01-12 02:13:34'),
(53, 46, '5e4dbe90-8f07-44a3-aa12-c5a66ed925e9', 'VO000', 'poper', 'ab block', 'vontoro', 'cananda', '38', '13723784', 1, 1, '2017-01-12 07:16:49', '2017-01-12 02:16:49'),
(54, 47, '3404cdad-92fc-448e-ae96-fd730e1306da', 'CH000', 'Ekkattuthangal', 'Ekkattuthangal,Chennai  32', 'Chennai', 'Tamilnadu', '105', '625012', 1, 1, '2017-01-12 14:01:51', '2017-01-12 09:01:51'),
(55, 48, '8a7f087d-aa70-4f97-a719-3edc5cd57457', 'DU000', 'Dubai', 'Dubai', 'Dubai', 'Saudi Arabia', '2', '00000', 1, 1, '2017-01-13 12:59:05', '2017-01-13 07:58:23'),
(56, 48, '0fd52f81-e3e1-484a-b8f7-9ccb8d112279', 'Qua1', 'Quatar', 'Quatar', 'Quatar', 'Quatar', '2', '99999', 1, 0, '2017-01-13 13:01:58', '0000-00-00 00:00:00'),
(57, 48, 'e561c66e-2943-42ce-b1df-a9b120f27a7a', 'Abu2', 'Abudhabi', 'Abu', 'Abudhabi', 'Abudhabi', '2', '88888', 1, 0, '2017-01-13 13:02:41', '0000-00-00 00:00:00'),
(58, 49, '3d198365-b7bf-419e-90a8-2cee52937c82', 'QA000', 'Qatar', 'Qatar', 'Doha', 'Doha', '2', '501023', 1, 1, '2017-01-23 07:44:16', '2017-01-23 07:44:16'),
(59, 49, '3356c43f-ecad-4a94-a7e5-e11caeffce69', 'AD01', 'UAE', 'abudhabi', 'abudhabi', 'Abudhabi', '2', '300294', 1, 0, '2017-01-23 07:46:29', '2017-01-23 07:46:29'),
(60, 49, '1d27f5ea-57bc-401d-9703-ea71c99afc9e', 'KU01', 'Kuwait', 'Kuwait', 'Al Ahmadi', 'Al Ahmadi', '2', '305782', 1, 0, '2017-01-23 07:46:12', '2017-01-23 07:46:12'),
(61, 50, '5fb4c8ba-f880-4f03-b992-4dc6b7db4a2f', 'CH000', 'annanagar', 'ab block', 'chennai', 'tamilnadu', '105', '090890', 1, 1, '2017-01-17 05:13:01', '2017-01-17 00:13:01'),
(62, 51, 'dbb5b528-cae1-433d-bc8e-c929f88c9918', 'CH000', 'annanagar', 'ab block', 'chennai', 'tamilnadu', '105', '76879', 1, 1, '2017-01-23 06:08:15', '2017-01-23 01:08:15'),
(63, 52, '61026880-8ef3-47d1-8d55-3c511d6909e0', 'AB000', 'United Arab Emirates', 'Quatar', 'Abudhabi', 'Quatar', '105', '99999', 1, 1, '2017-02-01 10:25:51', '2017-02-01 05:25:51'),
(64, 53, '61736cdd-58dc-44bd-9f5c-7af7c2eaed30', 'AB000', 'Abu', 'Abu', 'Abudhabi', 'CA', '105', '12345', 1, 1, '2017-02-02 11:17:26', '2017-02-02 06:17:26'),
(65, 54, 'fe2a08b4-416d-4187-9d00-3414eb4f1939', 'DU000', 'Arab', 'welcome, JOHN SMITH 300 BOYLSTON AVE', 'Dubai', 'Gulf', '2', '33444', 1, 1, '2017-02-07 12:02:18', '2017-02-07 07:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `org_user_department`
--

CREATE TABLE `org_user_department` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `org_user_department`
--

INSERT INTO `org_user_department` (`id`, `dept_id`, `user_id`, `role_id`) VALUES
(32, 1, 1, 1),
(46, 4, 58, 7),
(47, 5, 58, 7),
(48, 6, 58, 7),
(49, 4, 59, 8),
(50, 5, 59, 8),
(51, 6, 59, 8),
(52, 4, 60, 8),
(53, 5, 60, 8),
(54, 4, 57, 1),
(55, 5, 57, 1),
(56, 6, 57, 1),
(62, 4, 69, 8),
(68, 16, 78, 1),
(69, 17, 78, 1),
(70, 16, 79, 22),
(71, 17, 79, 22),
(72, 16, 80, 23),
(73, 17, 80, 23),
(75, 19, 81, 1),
(76, 20, 81, 1),
(77, 21, 81, 1),
(78, 22, 81, 1),
(79, 18, 81, 1),
(80, 18, 82, 25),
(81, 19, 82, 25),
(82, 20, 82, 25),
(83, 21, 82, 25),
(84, 22, 82, 25),
(85, 18, 83, 24),
(86, 19, 83, 24),
(87, 20, 83, 24),
(88, 21, 83, 24),
(89, 22, 83, 24),
(90, 25, 84, 1),
(91, 25, 85, 28),
(92, 29, 87, 1),
(93, 30, 87, 1),
(94, 31, 87, 1),
(95, 32, 88, 1),
(96, 33, 88, 1),
(97, 34, 88, 1),
(98, 34, 89, 31),
(99, 25, 90, 32),
(100, 36, 91, 1),
(101, 37, 91, 1),
(102, 38, 91, 1),
(103, 39, 91, 1),
(104, 40, 92, 33),
(105, 40, 93, 34),
(106, 40, 94, 35),
(107, 40, 95, 35),
(108, 41, 96, 32),
(109, 42, 93, 34),
(110, 44, 97, 1),
(111, 44, 98, 39),
(112, 46, 100, 40),
(113, 46, 101, 41),
(114, 46, 102, 42),
(115, 46, 103, 42),
(116, 48, 104, 1),
(117, 48, 105, 43),
(118, 48, 106, 43),
(119, 49, 107, 1),
(120, 49, 108, 44),
(121, 50, 109, 1),
(122, 51, 109, 1),
(123, 52, 109, 1),
(124, 53, 109, 1),
(125, 54, 109, 1),
(126, 55, 110, 1),
(127, 56, 110, 1),
(128, 57, 110, 1),
(129, 58, 110, 1),
(130, 59, 110, 1),
(131, 62, 111, 1),
(132, 63, 111, 1),
(133, 62, 112, 45),
(134, 64, 112, 45),
(135, 64, 113, 46),
(136, 63, 114, 47),
(137, 65, 114, 47);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_desc` text NOT NULL,
  `status` enum('0','1','-1') NOT NULL,
  `organiser_id` int(11) NOT NULL COMMENT '0-superadmin',
  `default` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `uuid`, `role_name`, `role_desc`, `status`, `organiser_id`, `default`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'e20bde75-86ae-4eca-a425-8770b179b4c9', 'Super Admin', '', '1', 1, '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, '424d31b6-cf38-40f1-8477-8232078bc941', 'Administrator', 'Administrator Roles can have permission to add anything in that page', '1', 1, '', '2016-10-18 03:14:46', '2016-10-18 05:43:10', 1),
(3, 'd2e91b1c-10bf-4f8f-9390-6b34f30ed85b', 'Staff', 'Staff roles for staff users', '1', 1, '', '2016-10-18 05:33:13', '2016-10-18 05:33:13', 39),
(4, '107e723f-f16a-44dc-a3d1-ae0f9a0c9109', 'Manager', 'Manager', '1', 31, '', '2016-11-11 03:56:43', '2016-11-17 03:26:53', 45),
(5, '9c3c2de9-fe71-4006-8dae-a90887d7a9fb', 'Staff', 'Staff', '1', 31, '', '2016-11-11 03:57:07', '2016-11-17 06:58:55', 45),
(6, '97f5cf6e-c511-4d0a-9e0d-9bffb04fbf2e', 'Staff', '', '1', 32, '', '2016-11-11 04:30:32', '2016-11-11 04:30:32', 46),
(7, '18006e15-3116-4829-841b-9b23b7b1927c', 'Manager', 'Manager roles they can add and edit his own creation ,view and review permission', '1', 33, '', '2016-11-21 05:29:40', '2016-11-21 05:29:40', 57),
(8, '32b754c6-f072-489d-bf27-35c584be7290', 'Staff', 'Staff can view all the others creation (view only).No review option', '1', 33, '', '2016-11-21 05:30:54', '2016-11-21 05:30:54', 57),
(9, '585e6447-8e03-4a87-8181-665fe2e0ab5b', 'wgf', 'dsfgdsfg', '1', 1, '', '2016-11-22 09:07:53', '2016-11-22 09:07:53', 1),
(10, 'ff5245e0-462b-43fd-be7d-b45cad479487', 'Techical support eng', 'Technical support eng will be supporting team to all', '1', 1, '', '2016-12-07 05:26:35', '2016-12-07 05:26:35', 1),
(11, '5c134a84-7207-477a-b037-d44fb8ad06aa', 'tech admin', 'Admin will manage all the tech problem and assign to co', '1', 34, '', '2016-12-08 07:19:16', '2016-12-08 07:19:16', 61),
(12, 'f5b99211-e6a6-44c7-8c57-dbe6d8b1527a', 'Manager', 'Manages the management', '1', 1, '', '2016-12-15 08:48:04', '2016-12-15 08:48:04', 1),
(13, '20b78f45-9eea-4d96-b520-eefc0598a2a0', 'Manager', 'manages the management', '1', 35, '', '2016-12-15 09:02:08', '2016-12-15 09:46:20', 64),
(14, 'c5bdc0ff-d3fe-4b8f-861f-f3a7e545a654', 'Sr Seo', 'Seo analysis the current market expectation', '1', 35, '', '2016-12-15 09:13:16', '2016-12-15 09:31:44', 66),
(15, 'ba08cfaa-b3d1-4d75-93fb-dce2bd88098e', 'HR Manager', 'HR', '1', 35, '', '2016-12-19 05:45:03', '2016-12-19 05:45:03', 64),
(16, '3aedf419-ff40-4fd7-9df0-09d3cba25551', 'CA', 'Manages all account related task', '1', 38, '', '2016-12-22 03:54:37', '2016-12-22 03:54:37', 71),
(17, '501e792b-5066-44db-aa4e-c01f9df0bc2a', 'Account manager', 'Manages Account related matter', '1', 38, '', '2016-12-22 03:58:01', '2016-12-22 03:58:01', 71),
(18, '67dd54e6-074b-44ca-b367-2f126827edc6', 'SR Accountant', 'Maintaining Profit and Loss', '1', 38, '', '2016-12-22 04:04:07', '2016-12-22 04:04:07', 71),
(19, '58310ca6-b8b2-4ea0-b8cb-5a311aac0823', 'Accountant', 'Calculate Risk By measuring Profit and loss', '1', 38, '', '2016-12-22 04:07:37', '2016-12-22 04:07:37', 71),
(20, '309e31db-493a-447a-8a80-6b8010f62afd', 'Jr Accountant', 'Find Profit or loss', '1', 38, '', '2016-12-22 04:08:54', '2016-12-22 04:08:54', 71),
(21, '44243824-715e-4436-8038-5f728c252761', 'Trainee', 'Getting Kt and Building to get into', '1', 38, '', '2016-12-22 04:09:55', '2016-12-22 06:10:17', 71),
(22, 'c1fe11d9-5408-4de7-946b-2b8f2cee2a63', 'Manager', '', '1', 41, '', '2017-01-03 06:24:45', '2017-01-03 06:24:45', 78),
(23, '1a1bc269-67bb-40ca-b28a-4d0764064e74', 'Staff', '', '1', 41, '', '2017-01-03 06:25:02', '2017-01-03 06:25:02', 78),
(24, '33dccf21-eaa5-4964-87c1-cb7bf89a566e', 'Manager', 'Manager', '1', 42, '', '2017-01-09 02:35:15', '2017-01-09 02:35:15', 81),
(25, 'd9802ec8-41c7-437e-89b2-86a2e728b8f6', 'Staff', 'Staff', '1', 42, '', '2017-01-09 02:35:45', '2017-01-09 02:35:45', 81),
(26, 'e23324bf-0bc2-47bb-94b1-5b367d9cbc56', 'testinghead', 'testingtestingtesting', '1', 1, '', '2017-01-11 07:29:07', '2017-01-11 07:29:07', 1),
(27, 'f48ecc61-2a63-4291-ac95-f6cb6aeac2ea', 'testinglead', 'testingtestingtestingtestingtesting', '1', 1, '', '2017-01-11 07:32:03', '2017-01-11 07:32:03', 1),
(28, 'ae1e2666-cea3-4642-be5a-1ff465656c27', 'Testingsr', 'testitestingtestingtestingng', '1', 43, '', '2017-01-11 07:46:07', '2017-01-12 08:40:36', 84),
(29, 'd2564991-0f00-488b-8825-b0aa8377e17a', 'chemist', 'chemo', '1', 1, '', '2017-01-11 08:03:25', '2017-01-11 08:03:25', 1),
(30, '10fd63d8-6cae-435f-b65c-4a68615c509b', 'admin', 'organization head', '1', 1, '', '2017-01-12 02:24:02', '2017-01-12 02:24:02', 1),
(31, '7e304427-0995-4756-853f-21c381756141', 'manager', 'manages the team', '1', 46, '', '2017-01-12 02:28:35', '2017-01-12 02:28:35', 88),
(32, 'cecb53d7-3ded-4140-bb78-ded1408e2d48', 'jrtester', 'juni', '1', 43, '', '2017-01-12 08:39:01', '2017-01-12 11:13:03', 84),
(33, 'bc0be34a-c596-4c4f-a89b-dcedad1b2cfc', 'Delivery Manager', 'Managing the project deliveries', '1', 47, '', '2017-01-12 09:06:30', '2017-01-12 09:06:30', 91),
(34, '73164ccb-d668-4182-ab1e-7fc74a5e0efd', 'Project Manager', 'managing the projects', '1', 47, '', '2017-01-12 09:07:12', '2017-01-12 09:07:12', 91),
(35, '46363cb3-c2c1-4dc5-8c8b-4ec15e1d567f', 'Developers', '', '1', 47, '', '2017-01-12 09:07:50', '2017-01-12 09:07:50', 91),
(36, 'bb3b0158-9667-45fb-a6c0-647416169f07', 'Staff', 'Staff', '1', 43, '', '2017-01-12 11:15:40', '2017-01-12 11:15:40', 84),
(37, 'c0b879f6-710b-4f73-aec5-6208fa169ba2', 'Supervisor', '', '1', 48, '', '2017-01-13 08:19:19', '2017-01-13 08:19:19', 97),
(38, '1bb99e20-1bba-46bc-a1ca-a041c47f417c', 'Staff', 'form submitting persons', '1', 48, '', '2017-01-13 08:19:44', '2017-01-13 08:19:44', 97),
(39, '4686e40a-3d2a-4400-b310-3fd8f6d05753', 'Manager', 'Managing person for the job site', '1', 48, '', '2017-01-13 08:20:34', '2017-01-13 08:20:34', 97),
(40, '7002834b-a638-4f4f-96a9-ddd0a66684e5', 'Manager', '', '1', 49, '', '2017-01-13 08:54:03', '2017-01-13 08:54:03', 99),
(41, '3a5c1841-c74c-4a96-a32e-761abb3970e6', 'Supervisor', '', '1', 49, '', '2017-01-13 08:54:36', '2017-01-13 08:54:36', 99),
(42, '2e407e1e-b3ab-4994-b61b-75fee935b145', 'Staff', '', '1', 49, '', '2017-01-13 08:54:56', '2017-01-13 08:54:56', 99),
(43, 'dc9c6bc6-fa5d-4e46-825b-46dc3f8fb4a3', 'manager', 'manages', '1', 50, '', '2017-01-17 00:23:32', '2017-01-17 00:23:32', 104),
(44, '399524a5-306c-40e9-855a-a5a767e7bc75', 'manager', 'manager manges', '1', 51, '', '2017-01-23 01:10:19', '2017-01-23 01:10:19', 107),
(45, 'fd56510e-b92d-4c12-9f7a-25c66b3928e6', 'admin', 'admin', '1', 54, '', '2017-02-08 07:43:08', '2017-02-08 07:43:08', 111),
(46, 'e8440ece-ebce-40f1-afe4-7f6fec6920f5', 'staff', 'Maintain', '1', 54, '', '2017-02-08 07:51:13', '2017-02-08 07:51:13', 112),
(47, '140c9d44-7abf-48a6-bbb7-92b3825ef23f', 'Project manager', 'Managing Project', '1', 54, '', '2017-02-09 04:53:57', '2017-02-09 04:53:57', 111);

-- --------------------------------------------------------

--
-- Table structure for table `roles_category_type`
--

CREATE TABLE `roles_category_type` (
  `roles_category_type_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles_category_type`
--

INSERT INTO `roles_category_type` (`roles_category_type_id`, `name`) VALUES
(1, 'country'),
(2, 'domain'),
(3, 'department'),
(4, 'category'),
(5, 'users'),
(6, 'forms'),
(7, 'roles'),
(8, 'organization'),
(9, 'submissions'),
(10, 'location\r\n'),
(11, 'Reports'),
(12, 'Reviews'),
(13, 'workflow');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `roles_category_type_id` int(11) NOT NULL,
  `create` enum('0','1') NOT NULL,
  `read` enum('0','1') NOT NULL,
  `update` enum('0','1') NOT NULL,
  `delete` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `roles_category_type_id`, `create`, `read`, `update`, `delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 1, 2, '1', '1', '1', '1'),
(3, 1, 3, '1', '1', '1', '1'),
(4, 1, 4, '1', '1', '1', '1'),
(5, 1, 5, '1', '1', '1', '1'),
(6, 1, 6, '1', '1', '1', '1'),
(7, 1, 7, '1', '1', '1', '1'),
(8, 2, 1, '1', '1', '0', '0'),
(9, 2, 2, '1', '1', '0', '0'),
(10, 2, 3, '1', '1', '0', '0'),
(11, 2, 4, '1', '1', '0', '0'),
(12, 2, 5, '1', '1', '0', '0'),
(13, 2, 6, '1', '1', '1', '0'),
(14, 2, 8, '1', '1', '0', '0'),
(15, 1, 8, '1', '1', '1', '1'),
(16, 2, 8, '1', '1', '0', '0'),
(17, 2, 7, '1', '1', '0', '0'),
(18, 3, 1, '0', '1', '0', '0'),
(19, 3, 2, '0', '1', '0', '0'),
(20, 3, 3, '0', '1', '0', '0'),
(21, 3, 4, '0', '1', '0', '0'),
(22, 3, 7, '0', '1', '0', '0'),
(23, 3, 5, '0', '1', '0', '0'),
(24, 3, 6, '0', '1', '0', '0'),
(25, 3, 8, '0', '1', '0', '0'),
(26, 4, 3, '1', '1', '1', '1'),
(27, 4, 4, '1', '1', '1', '1'),
(28, 4, 7, '1', '1', '1', '1'),
(29, 4, 5, '1', '1', '1', '1'),
(30, 4, 6, '1', '1', '1', '1'),
(31, 5, 3, '0', '1', '0', '0'),
(32, 5, 4, '0', '1', '0', '0'),
(33, 5, 7, '0', '1', '0', '0'),
(34, 5, 5, '0', '1', '0', '0'),
(35, 5, 6, '0', '1', '0', '0'),
(36, 6, 3, '0', '1', '0', '0'),
(37, 6, 4, '0', '1', '0', '0'),
(38, 6, 7, '0', '1', '0', '0'),
(39, 6, 5, '0', '1', '0', '0'),
(40, 6, 6, '0', '1', '1', '0'),
(41, 1, 10, '1', '1', '1', '1'),
(42, 2, 10, '1', '1', '1', '1'),
(43, 4, 10, '1', '1', '1', '1'),
(44, 4, 1, '0', '0', '0', '0'),
(45, 4, 2, '0', '0', '0', '0'),
(46, 4, 12, '1', '1', '1', '1'),
(47, 4, 8, '0', '0', '0', '0'),
(48, 5, 1, '0', '0', '0', '0'),
(49, 5, 2, '0', '0', '0', '0'),
(50, 5, 12, '0', '0', '0', '0'),
(51, 5, 8, '0', '0', '0', '0'),
(52, 5, 10, '0', '1', '0', '0'),
(53, 7, 3, '1', '1', '0', '0'),
(54, 7, 4, '1', '1', '0', '0'),
(55, 7, 7, '1', '1', '0', '0'),
(56, 7, 5, '1', '1', '0', '0'),
(57, 7, 6, '1', '1', '0', '0'),
(58, 7, 12, '1', '1', '1', '1'),
(59, 7, 10, '1', '1', '0', '0'),
(60, 8, 3, '0', '1', '0', '0'),
(61, 8, 4, '0', '1', '0', '0'),
(62, 8, 7, '0', '1', '0', '0'),
(63, 8, 5, '0', '1', '0', '0'),
(64, 8, 6, '0', '1', '0', '0'),
(65, 8, 10, '0', '1', '0', '0'),
(66, 1, 13, '1', '1', '1', '1'),
(67, 10, 1, '0', '1', '0', '0'),
(68, 10, 2, '0', '1', '0', '0'),
(69, 10, 3, '0', '1', '0', '0'),
(70, 10, 4, '0', '1', '0', '0'),
(71, 10, 7, '1', '1', '0', '0'),
(72, 10, 5, '1', '1', '0', '0'),
(73, 10, 6, '1', '1', '0', '0'),
(74, 10, 12, '1', '1', '1', '1'),
(75, 10, 8, '0', '1', '0', '0'),
(76, 10, 10, '1', '1', '0', '0'),
(77, 11, 3, '0', '1', '0', '0'),
(78, 11, 4, '0', '1', '0', '0'),
(79, 11, 7, '0', '1', '0', '0'),
(80, 11, 5, '0', '1', '0', '0'),
(81, 11, 6, '0', '1', '0', '0'),
(82, 11, 12, '1', '1', '1', '1'),
(83, 11, 10, '1', '1', '0', '0'),
(84, 1, 12, '1', '1', '1', '1'),
(85, 12, 1, '0', '1', '0', '0'),
(86, 12, 2, '0', '1', '0', '0'),
(87, 12, 3, '1', '1', '1', '0'),
(88, 12, 4, '1', '1', '1', '0'),
(89, 12, 7, '1', '1', '1', '1'),
(90, 12, 5, '1', '1', '1', '1'),
(91, 12, 6, '1', '1', '1', '1'),
(92, 12, 12, '1', '1', '1', '1'),
(93, 12, 8, '0', '1', '0', '0'),
(94, 12, 10, '0', '1', '0', '0'),
(95, 13, 3, '1', '1', '1', '0'),
(96, 13, 4, '1', '1', '1', '0'),
(97, 13, 7, '1', '1', '1', '1'),
(98, 13, 5, '1', '1', '1', '1'),
(99, 13, 6, '1', '1', '1', '1'),
(100, 13, 12, '1', '1', '1', '1'),
(101, 13, 10, '1', '1', '0', '0'),
(102, 14, 6, '0', '1', '0', '0'),
(103, 14, 12, '0', '0', '0', '0'),
(104, 14, 10, '0', '1', '0', '0'),
(105, 14, 1, '0', '0', '0', '0'),
(106, 14, 2, '0', '0', '0', '0'),
(107, 14, 3, '0', '0', '0', '0'),
(108, 14, 4, '0', '0', '0', '0'),
(109, 14, 7, '0', '0', '0', '0'),
(110, 14, 5, '0', '0', '0', '0'),
(111, 14, 8, '0', '0', '0', '0'),
(112, 13, 1, '0', '0', '0', '0'),
(113, 13, 2, '0', '0', '0', '0'),
(114, 13, 8, '0', '0', '0', '0'),
(115, 15, 3, '1', '1', '0', '0'),
(116, 15, 4, '1', '1', '0', '0'),
(117, 15, 7, '1', '1', '0', '0'),
(118, 15, 5, '1', '1', '0', '0'),
(119, 15, 6, '1', '1', '0', '0'),
(120, 15, 12, '1', '1', '1', '1'),
(121, 15, 10, '0', '1', '0', '0'),
(122, 16, 3, '0', '1', '0', '0'),
(123, 16, 4, '0', '1', '0', '0'),
(124, 16, 7, '0', '1', '0', '0'),
(125, 16, 5, '1', '1', '1', '1'),
(126, 16, 6, '1', '1', '1', '1'),
(127, 16, 12, '1', '1', '1', '1'),
(128, 16, 10, '0', '1', '0', '0'),
(129, 17, 3, '0', '1', '0', '0'),
(130, 17, 4, '0', '1', '0', '0'),
(131, 17, 7, '0', '1', '0', '0'),
(132, 17, 5, '0', '1', '0', '0'),
(133, 17, 6, '1', '1', '0', '1'),
(134, 17, 12, '1', '1', '1', '1'),
(135, 17, 10, '0', '1', '0', '0'),
(136, 18, 3, '1', '1', '0', '1'),
(137, 18, 7, '0', '1', '0', '0'),
(138, 18, 5, '0', '1', '0', '0'),
(139, 18, 6, '1', '1', '0', '0'),
(140, 18, 12, '1', '1', '1', '1'),
(141, 18, 10, '1', '1', '1', '1'),
(142, 19, 3, '0', '1', '0', '0'),
(143, 19, 7, '0', '1', '0', '0'),
(144, 19, 6, '0', '1', '0', '0'),
(145, 19, 12, '1', '1', '1', '1'),
(146, 20, 6, '0', '1', '1', '0'),
(147, 20, 12, '1', '1', '1', '1'),
(148, 21, 3, '0', '1', '0', '0'),
(149, 21, 7, '0', '1', '0', '0'),
(150, 21, 5, '0', '1', '0', '0'),
(151, 21, 6, '1', '1', '1', '0'),
(152, 21, 12, '0', '0', '0', '0'),
(153, 21, 10, '0', '1', '0', '0'),
(154, 21, 1, '0', '0', '0', '0'),
(155, 21, 2, '0', '0', '0', '0'),
(156, 21, 4, '0', '0', '0', '0'),
(157, 21, 8, '0', '0', '0', '0'),
(158, 22, 3, '1', '1', '1', '0'),
(159, 22, 4, '1', '1', '1', '0'),
(160, 22, 7, '1', '1', '1', '0'),
(161, 22, 5, '1', '1', '1', '0'),
(162, 22, 6, '1', '1', '1', '0'),
(163, 22, 12, '1', '1', '1', '1'),
(164, 22, 10, '1', '1', '1', '0'),
(165, 23, 3, '0', '1', '0', '0'),
(166, 23, 4, '0', '1', '0', '0'),
(167, 23, 7, '0', '1', '0', '0'),
(168, 23, 5, '0', '1', '0', '0'),
(169, 23, 6, '0', '1', '0', '0'),
(170, 23, 10, '0', '1', '0', '0'),
(171, 24, 3, '1', '1', '1', '0'),
(172, 24, 4, '1', '1', '1', '0'),
(173, 24, 7, '0', '1', '0', '0'),
(174, 24, 5, '1', '1', '1', '0'),
(175, 24, 6, '1', '1', '1', '0'),
(176, 24, 12, '1', '1', '1', '1'),
(177, 24, 10, '1', '1', '1', '0'),
(178, 25, 3, '0', '1', '0', '0'),
(179, 25, 4, '0', '1', '0', '0'),
(180, 25, 7, '0', '1', '0', '0'),
(181, 25, 5, '0', '1', '0', '0'),
(182, 25, 6, '0', '1', '0', '0'),
(183, 25, 10, '0', '1', '0', '0'),
(184, 26, 1, '1', '1', '0', '0'),
(185, 26, 2, '0', '1', '0', '0'),
(186, 26, 3, '0', '1', '0', '0'),
(187, 26, 4, '0', '1', '0', '0'),
(188, 26, 7, '0', '1', '0', '0'),
(189, 26, 5, '0', '1', '0', '0'),
(190, 26, 6, '1', '1', '1', '1'),
(191, 26, 12, '1', '1', '1', '1'),
(192, 26, 10, '0', '1', '0', '0'),
(193, 27, 1, '0', '1', '0', '0'),
(194, 27, 6, '0', '1', '0', '0'),
(195, 27, 8, '0', '1', '0', '0'),
(196, 28, 4, '0', '1', '0', '0'),
(197, 28, 5, '0', '1', '0', '0'),
(198, 28, 6, '0', '1', '0', '0'),
(199, 28, 10, '0', '1', '0', '0'),
(200, 29, 1, '1', '1', '1', '1'),
(201, 29, 3, '1', '1', '1', '1'),
(202, 29, 4, '1', '1', '1', '1'),
(203, 29, 7, '1', '1', '1', '0'),
(204, 29, 5, '1', '1', '1', '0'),
(205, 29, 6, '1', '1', '1', '1'),
(206, 29, 12, '1', '1', '1', '1'),
(207, 29, 8, '1', '1', '1', '1'),
(208, 29, 10, '1', '1', '1', '1'),
(209, 30, 1, '1', '1', '1', '1'),
(210, 30, 2, '1', '1', '1', '1'),
(211, 30, 3, '1', '1', '1', '1'),
(212, 30, 4, '1', '1', '1', '1'),
(213, 30, 7, '1', '1', '1', '1'),
(214, 30, 5, '1', '1', '1', '1'),
(215, 30, 6, '1', '1', '1', '1'),
(216, 30, 12, '1', '1', '1', '1'),
(217, 30, 8, '1', '1', '1', '1'),
(218, 30, 10, '1', '1', '1', '1'),
(219, 31, 3, '1', '1', '1', '0'),
(220, 31, 4, '1', '1', '1', '1'),
(221, 31, 7, '1', '1', '1', '1'),
(222, 31, 5, '1', '1', '1', '1'),
(223, 31, 6, '1', '1', '1', '1'),
(224, 31, 12, '1', '1', '1', '1'),
(225, 31, 10, '1', '1', '1', '0'),
(226, 32, 3, '0', '1', '0', '0'),
(227, 32, 4, '0', '1', '0', '0'),
(228, 32, 7, '0', '1', '0', '0'),
(229, 32, 5, '0', '1', '0', '0'),
(230, 32, 6, '1', '1', '1', '0'),
(231, 32, 12, '1', '1', '1', '1'),
(232, 32, 10, '0', '1', '0', '0'),
(233, 28, 1, '0', '0', '0', '0'),
(234, 28, 2, '0', '0', '0', '0'),
(235, 28, 3, '0', '0', '0', '0'),
(236, 28, 7, '0', '0', '0', '0'),
(237, 28, 12, '0', '0', '0', '0'),
(238, 28, 8, '0', '0', '0', '0'),
(239, 33, 3, '1', '1', '1', '1'),
(240, 33, 4, '1', '1', '1', '1'),
(241, 33, 7, '1', '1', '1', '1'),
(242, 33, 5, '1', '1', '1', '1'),
(243, 33, 6, '1', '1', '1', '1'),
(244, 33, 12, '1', '1', '1', '1'),
(245, 33, 10, '1', '1', '1', '1'),
(246, 34, 3, '1', '1', '1', '0'),
(247, 34, 4, '1', '1', '1', '0'),
(248, 34, 7, '1', '1', '1', '0'),
(249, 34, 5, '1', '1', '1', '0'),
(250, 34, 6, '1', '1', '1', '0'),
(251, 34, 12, '1', '1', '1', '1'),
(252, 34, 10, '1', '1', '1', '0'),
(253, 35, 3, '0', '1', '0', '0'),
(254, 35, 4, '0', '1', '0', '0'),
(255, 35, 7, '0', '1', '0', '0'),
(256, 35, 5, '0', '1', '0', '0'),
(257, 35, 6, '0', '1', '1', '0'),
(258, 35, 10, '0', '1', '0', '0'),
(259, 32, 1, '0', '0', '0', '0'),
(260, 32, 2, '0', '0', '0', '0'),
(261, 32, 8, '0', '0', '0', '0'),
(262, 36, 3, '0', '1', '0', '0'),
(263, 36, 4, '0', '1', '0', '0'),
(264, 36, 7, '0', '1', '0', '0'),
(265, 36, 5, '0', '1', '0', '0'),
(266, 36, 6, '0', '1', '0', '0'),
(267, 36, 10, '0', '1', '0', '0'),
(268, 37, 6, '1', '1', '1', '1'),
(269, 37, 12, '1', '1', '1', '1'),
(270, 38, 6, '0', '1', '1', '0'),
(271, 39, 5, '1', '1', '1', '0'),
(272, 39, 6, '1', '1', '1', '1'),
(273, 39, 12, '1', '1', '1', '1'),
(274, 39, 10, '1', '1', '1', '1'),
(275, 40, 5, '1', '1', '1', '1'),
(276, 40, 6, '1', '1', '1', '1'),
(277, 40, 12, '1', '1', '1', '1'),
(278, 41, 5, '1', '1', '1', '1'),
(279, 41, 6, '1', '1', '1', '1'),
(280, 41, 12, '1', '1', '1', '1'),
(281, 42, 6, '1', '1', '1', '0'),
(282, 43, 3, '1', '1', '1', '1'),
(283, 43, 4, '1', '1', '1', '1'),
(284, 43, 7, '1', '1', '0', '1'),
(285, 43, 5, '1', '1', '1', '0'),
(286, 43, 6, '1', '1', '1', '0'),
(287, 43, 12, '1', '1', '1', '1'),
(288, 43, 10, '1', '1', '1', '1'),
(289, 44, 3, '1', '1', '0', '0'),
(290, 44, 4, '1', '1', '1', '1'),
(291, 44, 7, '1', '1', '1', '1'),
(292, 44, 5, '1', '1', '1', '1'),
(293, 44, 6, '1', '1', '1', '0'),
(294, 44, 12, '1', '1', '1', '1'),
(295, 44, 10, '0', '1', '0', '0'),
(296, 45, 3, '1', '1', '1', '1'),
(297, 45, 7, '1', '1', '1', '1'),
(298, 45, 5, '1', '1', '1', '1'),
(299, 45, 6, '0', '1', '0', '0'),
(300, 45, 12, '1', '1', '1', '1'),
(301, 45, 10, '0', '1', '0', '0'),
(302, 46, 7, '0', '1', '0', '0'),
(303, 46, 5, '0', '1', '0', '0'),
(304, 46, 6, '0', '1', '1', '0'),
(305, 46, 12, '1', '1', '1', '1'),
(306, 46, 10, '0', '1', '0', '0'),
(307, 47, 3, '0', '1', '0', '0'),
(308, 47, 4, '1', '1', '1', '0'),
(309, 47, 7, '1', '1', '1', '1'),
(310, 47, 5, '1', '1', '1', '1'),
(311, 47, 6, '1', '1', '1', '1'),
(312, 47, 12, '1', '1', '1', '1'),
(313, 47, 10, '0', '1', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `subscription_name` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `subscription_name`, `duration`, `price`) VALUES
(1, 'Normal', '3 Months', 0),
(2, 'Name 1', '3 Months', 0),
(3, 'Name 1', '3 Months', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plan_details`
--

CREATE TABLE `subscription_plan_details` (
  `plan_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `plans` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='subscription_id';

--
-- Dumping data for table `subscription_plan_details`
--

INSERT INTO `subscription_plan_details` (`plan_id`, `subscription_id`, `plans`) VALUES
(1, 1, '{\n  \"plans\": {\n    \"users\": \"5\",\n    \"forms\": \"5\",\n    \"jobsites\": \"3\"\n  }\n}'),
(2, 2, '{\"plans\":\"{\\\"users\\\":\\\"6\\\",\\\"jobsites\\\":\\\"4\\\",\\\"forms\\\":\\\"5\\\"}\"}'),
(3, 3, '{\"plans\":\"{\\\"users\\\":\\\"10\\\",\\\"jobsites\\\":\\\"3\\\",\\\"forms\\\":\\\"1000\\\"}\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '',
  `user_token` text NOT NULL,
  `imgname` text NOT NULL,
  `thumbimg` text NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL,
  `lastvisitDate` datetime NOT NULL,
  `activation` varchar(100) NOT NULL DEFAULT '',
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `static_role` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL COMMENT 'Permission for module wise',
  `user_org_loc_id` bigint(20) NOT NULL,
  `org_id` int(11) NOT NULL,
  `user_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `firstname`, `lastname`, `email`, `phone`, `password`, `user_token`, `imgname`, `thumbimg`, `block`, `created_by`, `createdDate`, `updatedDate`, `lastvisitDate`, `activation`, `lastResetTime`, `static_role`, `user_role_id`, `user_org_loc_id`, `org_id`, `user_post`) VALUES
(1, 'ff59a010-4694-47e3-a664-324e3b7eb2a8', 'Administrator', 'Innoforms', 'superadmin@innoforms.com', '(127) 831-2367', '85459408fb002637777ef24890180780', '', '1483970259-f121d135f39f03e48da5fe5e8ced5b0a.jpg', '', 0, 0, '0000-00-00 00:00:00', '2016-06-20 12:40:13', '2017-02-07 06:32:27', '1', '2016-06-20 11:54:36', 0, 1, 1, 1, 0),
(57, 'fc721d10-f740-4254-a37e-2b87080e7335', 'Superadmin', 'Pothys', 'superadmin@pothys.com', '2332423', '827ccb0eea8a706c4c34a16891f84e7b', 'H8Hd3jBnH/PR3AFegx2YeNJOl9M=', '1481884241-7ae83d21a54d1048fb9f51b2a5b8f216.gif', '', 0, 0, '0000-00-00 00:00:00', '2016-11-21 10:24:38', '2017-01-13 05:08:29', '1', '0000-00-00 00:00:00', 0, 1, 36, 33, 0),
(58, '68535fd9-9e10-48dd-bce5-9a5212be8001', 'Manager1', 'Pothys', 'rajeshsun117@gmail.com', '(121) 212-1211', '6ea7293de9d16ad971787a38caad6b37', 'pkzjSyZDjHO2ueHbHM3A6seHVmE=', '', '', 0, 57, '0000-00-00 00:00:00', '2016-11-21 05:31:44', '2016-11-29 04:48:06', '1', '0000-00-00 00:00:00', 0, 7, 36, 33, 0),
(59, 'c9dcc517-4b48-42a1-b26c-cae092f3017b', 'Staff1', 'Pothys', 'staff1@pothys.com', '22323423', '827ccb0eea8a706c4c34a16891f84e7b', 'VZbipSwJSl95olM7ueGt4ooku8Q=', '', '', 0, 58, '0000-00-00 00:00:00', '2016-11-21 05:33:43', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 8, 36, 33, 0),
(60, 'f13e5589-4efa-48da-b098-105fa1b1c05e', 'Staff2', 'Pothys', 'staff2@pothys.com', '3423', '827ccb0eea8a706c4c34a16891f84e7b', 'tw+LHZXOJMAk61Y2xCG/CP3gFH8=', '', '', 0, 58, '0000-00-00 00:00:00', '2016-11-21 06:26:09', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 8, 36, 33, 0),
(69, 'd9732af1-0323-4a26-9252-ee66555c3c56', 'Test', 'etst', 'testsdfsd@tre.com', '(121) 132-3123', '827ccb0eea8a706c4c34a16891f84e7b', 'O8LHil1Eo5Z4mpkVZsYqkWyxkDw=', '', '', 0, 57, '0000-00-00 00:00:00', '2016-12-21 03:24:51', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 8, 36, 33, 0),
(78, '2c612c48-c305-41d9-8b65-adc4253848a2', 'Admin', 'Chennai', 'admin@chennaisilks.com', '(132) 342-3423', '827ccb0eea8a706c4c34a16891f84e7b', 'WUv7/I8XJzP2setv+iE2uIeLwyw=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-03 11:21:06', '2017-01-12 14:00:53', '1', '0000-00-00 00:00:00', 0, 1, 47, 41, 0),
(79, '94a9c11b-242d-41bd-8b35-cb4e40bb7655', 'Manager', 'Chennai', 'manager@chennaisilks.com', '(123) 123-1231', '827ccb0eea8a706c4c34a16891f84e7b', 't6cve0uepm6G81ZLzZH/Br1xqcM=', '1483684670-e4dc917ada102e417a48a585ad394df4.gif', '', 0, 78, '0000-00-00 00:00:00', '2017-01-03 06:25:37', '2017-01-06 01:37:11', '1', '0000-00-00 00:00:00', 0, 22, 47, 41, 0),
(80, '36328edc-953a-4729-ad2f-14785fe700e4', 'Staff', 'Chennai', 'staff@chennaisilks.com', '(123) 131-2312', '827ccb0eea8a706c4c34a16891f84e7b', '7DBZmgH5vLKIM6NvpwPwuIDvS+k=', '', '', 0, 78, '0000-00-00 00:00:00', '2017-01-03 06:26:03', '2017-01-05 08:31:42', '1', '0000-00-00 00:00:00', 0, 23, 47, 41, 0),
(81, 'f209a6a1-c6f5-4691-873e-f719cf869b50', 'Default', 'Organization', 'default@org.com', '(123) 123-1231', '827ccb0eea8a706c4c34a16891f84e7b', 'euId9BUBQCiGqoPOBiKpmr7q8a8=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-09 07:28:24', '2017-01-27 07:59:25', '1', '0000-00-00 00:00:00', 0, 1, 48, 42, 0),
(82, 'b3061571-0446-4ed8-9c14-0e33f7e57da2', 'Staff', 'Organization', 'staff@org.com', '(987) 989-2342', '827ccb0eea8a706c4c34a16891f84e7b', 'ff/9kTjh+1SwG8e83uj5gU938I0=', '', '', 0, 81, '0000-00-00 00:00:00', '2017-01-11 05:47:56', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 25, 48, 42, 0),
(83, '520428f9-33cc-4937-ae0f-cd04ffd8b117', 'Manager', 'Organization', 'manager@org.com', '(978) 626-3172', '827ccb0eea8a706c4c34a16891f84e7b', 'momvhtZuqAZ3THqCSh7tO459O/4=', '', '', 0, 81, '0000-00-00 00:00:00', '2017-01-11 05:48:28', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 24, 48, 42, 0),
(84, '97d03424-7019-4505-8853-a529de107fd9', 'Testing', 'innoppl', 'testinginnoppl@gmail.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'd8vvh7hit60Zc5fXcb99lQZjJ9Y=', '1484228262-3f71fc9744eb5262ccb538c8ccdb5e7f.jpg', '', 0, 0, '0000-00-00 00:00:00', '2017-01-11 12:01:40', '2017-01-13 06:14:49', '1', '0000-00-00 00:00:00', 0, 1, 50, 43, 0),
(85, '55785424-cdc0-43ce-bf1a-c2797b75e79a', 'testing', 'testing', 'Testing@gmail.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'r2lWPhDhuupUv5lKha3+vGC9a+8=', '', '', 0, 84, '0000-00-00 00:00:00', '2017-01-11 07:48:22', '2017-01-13 05:31:34', '1', '0000-00-00 00:00:00', 0, 28, 50, 43, 0),
(86, '4534d90c-7de3-4938-af03-bd7e407282b3', 'TESTER', 'test', 'chandu@gmail.com', '(989) 089-0890', '827ccb0eea8a706c4c34a16891f84e7b', 'by41X714NiiA0cUp5kWn+Z0dGvk=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-11 12:55:55', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 1, 51, 44, 0),
(87, '7bc7fc49-96ad-46ed-97b7-0834efe55f8b', 'chandu', 'qat', 'test@gmail.com', '(898) 909-8908', '827ccb0eea8a706c4c34a16891f84e7b', 'rZ/Kx1sdbzLZi1Wpmjs08FqWihc=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-12 07:13:34', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 1, 52, 45, 0),
(88, '5891865c-fdc1-4edc-a304-347bc241fb45', 'pettest', 'beta', 'betatest@gmail.com', '(997) 783-7463', '827ccb0eea8a706c4c34a16891f84e7b', 'UyVds1GosHskM3Wv1oi00MSU8fM=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-12 07:16:49', '2017-01-12 02:41:15', '1', '0000-00-00 00:00:00', 0, 1, 53, 46, 0),
(89, '7b287227-2959-4cfe-a35f-1514a506ee04', 'manager', 'alphateam', 'manages@g.com', '(678) 908-9076', '827ccb0eea8a706c4c34a16891f84e7b', 'zwBsWjkK/mEwHEJinJ+1/IApnww=', '', '', 0, 88, '0000-00-00 00:00:00', '2017-01-12 02:29:54', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 31, 53, 46, 0),
(90, '3e8bcc45-567b-44c4-ae0d-61c42d01c8cc', 'jr', 'testing', 'jrtester@gmail.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'QtVImGv+gMJGxmhZlgnYp+QekEY=', '1484245538cached.jpg', '', 0, 84, '0000-00-00 00:00:00', '2017-01-12 06:25:39', '2017-01-12 09:01:29', '1', '0000-00-00 00:00:00', 0, 32, 50, 43, 0),
(91, 'fcc8aa54-5489-46dd-8e35-a2fac268f215', 'Admin', 'Innoppl', 'admin@innoppl.com', '(123) 456-7890', '827ccb0eea8a706c4c34a16891f84e7b', 'mClq58e9522yHXZce47XgHpLsJ0=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-12 14:01:51', '2017-01-13 06:40:33', '1', '0000-00-00 00:00:00', 0, 1, 54, 47, 0),
(92, 'f2f01fbe-260d-4ce5-9e82-6da85f05101f', 'Senthilkumar', 'Swaminathan', 'senthilkumar@innoppl.com', '(123) 456-7891', '827ccb0eea8a706c4c34a16891f84e7b', 'BqqAsn+CY87MPMDSwFs/cXfOIhs=', '', '', 0, 91, '0000-00-00 00:00:00', '2017-01-12 09:10:41', '2017-01-13 05:43:17', '1', '0000-00-00 00:00:00', 0, 33, 54, 47, 0),
(93, '61506888-caa0-4edf-97e3-a35c431383c1', 'Logesh', 'K', 'logesh@innoppl.com', '(123) 456-7892', '827ccb0eea8a706c4c34a16891f84e7b', 'mhwrj/tQCh9JZ31yxVZo2waNve8=', '', '', 0, 91, '0000-00-00 00:00:00', '2017-01-12 09:11:05', '2017-02-08 08:30:56', '1', '0000-00-00 00:00:00', 0, 34, 54, 47, 0),
(94, '2f710159-77d1-4bf1-96d1-8f5c791deeb8', 'Rajesh Kannan', 'Chandrasekar', 'rajesh@innoppl.com', '(123) 456-7893', '827ccb0eea8a706c4c34a16891f84e7b', 'BbR6EGX+0ZrSmJ01f5oTjTXwaOE=', '', '', 0, 91, '0000-00-00 00:00:00', '2017-01-12 09:11:46', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 35, 54, 47, 0),
(95, '8ace5971-ef7b-4cc8-820d-25f6c13ccde8', 'Satheesh Kannan', 'Arumugam', 'satheesh@innoppl.com', '(123) 456-7894', '827ccb0eea8a706c4c34a16891f84e7b', '0A27iE1g/T9xRjdOqYcefcV+BbQ=', '', '', 0, 91, '0000-00-00 00:00:00', '2017-01-12 09:12:20', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 35, 54, 47, 0),
(96, 'd7040156-baf2-4430-a5b7-2b36e661337f', 'vinu', 'kannan', 'rkmsaranya@gmail.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'O/pTu8slGTIx4chesV8cjkwgkbA=', '', '', 0, 84, '0000-00-00 00:00:00', '2017-01-13 05:38:58', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 32, 50, 43, 0),
(97, '737dea9c-771a-4093-82ee-2df734de1722', 'Blue', 'Green', 'Bluegreen@gmail.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'w29ENBjoS7CtHVrs7wV91mnjQvE=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-13 12:58:23', '2017-01-13 08:10:47', '1', '0000-00-00 00:00:00', 0, 1, 55, 48, 0),
(98, 'f3111197-4ffa-4edc-a3b7-3dc750ea24d0', 'Mahboob', 'Subuhani', 'mahboob@innoppl.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'CEJ5DGn6iOS+h/yCmeVbmFWQAXg=', '', '', 0, 97, '0000-00-00 00:00:00', '2017-01-13 08:25:17', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 39, 55, 48, 0),
(99, 'fa3c695f-1f0a-4ab6-bb25-32ed74318e7d', 'Admin', 'User', 'admin@uaeconstruction.com', '(999) 999-9999', '827ccb0eea8a706c4c34a16891f84e7b', 'J+Ve7fJAUJD19duoN2PWpQtaHiw=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-13 13:52:54', '2017-01-24 00:33:09', '1', '0000-00-00 00:00:00', 0, 1, 58, 49, 0),
(100, 'd43fa0b4-67c1-49ea-9388-b465940dd372', 'Mahboob', 'Subuhani', 'mahboob@uaeconstruction.com', '(123) 123-1234', '827ccb0eea8a706c4c34a16891f84e7b', '2W1xJAvr6qE37AcThj/mCj7ePh8=', '', '', 0, 99, '0000-00-00 00:00:00', '2017-01-13 09:04:15', '2017-01-16 02:32:54', '1', '0000-00-00 00:00:00', 0, 40, 58, 49, 0),
(101, 'b387bff6-802b-4911-ba89-b02a87816343', 'John ', 'Smith', 'john@uaeconstruction.com', '(234) 234-2112', '827ccb0eea8a706c4c34a16891f84e7b', 'kOOXNPRdbC0ApQ2QUHVFP41cMNU=', '', '', 0, 99, '0000-00-00 00:00:00', '2017-01-13 09:26:49', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 41, 58, 49, 0),
(102, 'e60e4afc-d6b8-4a30-9e31-a4034feda362', 'Stephen', 'J', 'stephen@uaeconstruction.com', '(234) 239-3933', '827ccb0eea8a706c4c34a16891f84e7b', 'JAjvsJOTsYaB5Mh9M2Zem5O+k7s=', '', '', 0, 99, '0000-00-00 00:00:00', '2017-01-13 09:27:33', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 42, 58, 49, 0),
(103, '57e2fbf2-44c2-4c74-ae57-c386bad46890', 'Kavin', 'R', 'kavin@uaeconstruction.com', '(234) 939-9243', '827ccb0eea8a706c4c34a16891f84e7b', 'Dw75pFkBhDekTJDumOVq7x5mr1E=', '', '', 0, 99, '0000-00-00 00:00:00', '2017-01-13 09:28:09', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 42, 58, 49, 0),
(104, '9e637707-7a34-4981-adaf-2d3a73ba77bf', 'test', 'QAE', 'qat@gmail.com', '(123) 456-7890', '827ccb0eea8a706c4c34a16891f84e7b', '+BnIz57bkEBE4Vy6lrOCtsbYDak=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-17 05:13:01', '2017-01-17 00:30:12', '1', '0000-00-00 00:00:00', 0, 1, 61, 50, 0),
(105, '214fb749-50ce-40d4-b8ae-1c070053a928', 'pop', 'pop', 'm@g.com', '(_76) 899-0090', '827ccb0eea8a706c4c34a16891f84e7b', 'eDhB8sdf4A9PTjCNNOuaDyCRVuA=', '', '', 0, 1, '0000-00-00 00:00:00', '2017-01-17 00:25:32', '2017-01-17 00:32:53', '1', '0000-00-00 00:00:00', 0, 43, 61, 50, 0),
(106, '6889b771-7ee1-4b4e-8944-8c1f5331810a', 'manager', 's', 'man@g.com', '(678) 678-6789', '827ccb0eea8a706c4c34a16891f84e7b', '3kKFSHIR1NUnNpyWkrRSGNmwGCI=', '', '', 0, 1, '0000-00-00 00:00:00', '2017-01-23 00:45:49', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 43, 61, 50, 0),
(107, '8af74164-af37-453e-831a-7a749709929c', 'taun', 'tarun', 'tarun@gmail.com', '(678) 678-6789', '827ccb0eea8a706c4c34a16891f84e7b', 'gP9kuLq7oJx5YE2KTWklAO9498E=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-01-23 06:08:15', '2017-01-23 02:28:22', '1', '0000-00-00 00:00:00', 0, 1, 62, 51, 0),
(108, '52422729-145e-4400-9244-265637ef95b5', 'manager', 'kumar', 'man@gmail.com', '(687) 980-6857', '827ccb0eea8a706c4c34a16891f84e7b', '4Q04OjqncXo0tNGcUY/eaEO8jug=', '', '', 0, 107, '0000-00-00 00:00:00', '2017-01-23 01:11:00', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 44, 62, 51, 0),
(109, 'e7e38dc9-7b42-44df-9a40-64cac6f7b7b0', 'Sarantesting', 'tester', 'testersaro@jmail.com', '(222) 222-2222', '827ccb0eea8a706c4c34a16891f84e7b', '4xCA0rUP4Mm9/Mbac1HQQsdYs1A=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-02-01 10:25:51', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 1, 63, 52, 0),
(110, '09d4e0b4-f4ce-4075-b642-0b0373bd4570', 'testing', 'Saro', 'newtoday@gmail.com', '(888) 888-8888', '827ccb0eea8a706c4c34a16891f84e7b', 'lQcvmfJfBotQGzlrl+mhuHBlo2I=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-02-02 11:17:26', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00', 0, 1, 64, 53, 0),
(111, '6349bc10-8b3a-4269-8418-6191b0526a85', 'Today', 'inno', 'todayinno@gmail.com', '(666) 666-6666', '827ccb0eea8a706c4c34a16891f84e7b', 'Ek7hpFagQpubu4ugsOs0LbBDv9w=', '', '', 0, 0, '0000-00-00 00:00:00', '2017-02-07 12:02:18', '2017-02-09 04:23:06', '1', '0000-00-00 00:00:00', 0, 1, 65, 54, 0),
(112, '61df8d6c-43a4-4786-8ed4-568958b32a37', 'Saranya', 'baskaran', 'Yesterdayinno@gmail.com', '(777) 777-7777', '827ccb0eea8a706c4c34a16891f84e7b', 'ijXNAkJZmV0MjjYB0+fx1WOK/84=', '', '', 0, 111, '0000-00-00 00:00:00', '2017-02-08 07:46:22', '2017-02-09 03:53:05', '1', '0000-00-00 00:00:00', 0, 45, 65, 54, 0),
(113, 'd6c2a119-f608-4352-915b-227b0a8b58b6', 'Saran', 'bask', 'TodayYesterday@gmail.com', '(444) 444-4444', '827ccb0eea8a706c4c34a16891f84e7b', 'zrdJhmHGX6BHwbbnxQqX+XtCgfE=', '', '', 0, 112, '0000-00-00 00:00:00', '2017-02-08 07:54:41', '2017-02-09 03:50:55', '1', '0000-00-00 00:00:00', 0, 46, 65, 54, 0),
(114, '83f85fdb-d42a-4336-9eb1-a00b7f20103c', 'Saron', 'Gvk', 'YesterdayToday@gmail.com', '(333) 333-3333', '827ccb0eea8a706c4c34a16891f84e7b', 'obhy7kg/ImzIGZYikqiGOpGwAhU=', '', '', 0, 111, '0000-00-00 00:00:00', '2017-02-09 05:02:12', '2017-02-09 05:04:20', '1', '0000-00-00 00:00:00', 0, 47, 65, 54, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_post`
--

CREATE TABLE `users_post` (
  `users_post` int(11) NOT NULL,
  `users_post_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_post`
--

INSERT INTO `users_post` (`users_post`, `users_post_name`) VALUES
(1, 'General manager'),
(2, 'Managing Director'),
(3, 'Executive Chief'),
(4, 'Hygeneic Manager'),
(5, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `user_forgot_reset_pwd`
--

CREATE TABLE `user_forgot_reset_pwd` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reset` varchar(255) NOT NULL,
  `activation` text NOT NULL,
  `active` int(11) DEFAULT NULL COMMENT '0 for inactive 1 for active',
  `call_from` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `lastaccess` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_forgot_reset_pwd`
--

INSERT INTO `user_forgot_reset_pwd` (`id`, `email`, `reset`, `activation`, `active`, `call_from`, `created_at`, `updated_at`, `lastaccess`) VALUES
(1, 'superadmin@formpro.com', 'M1RyWHUy', 'f483b2728d3102cfb2fb9ce37361408b', 2, 'api', '2016-06-21 05:54:16', '2016-06-21 05:54:16', 0),
(6, 'test@innoppl.com', 'Qk5KZXRU', '9c09f6deb9fa1bdb243a32c890ac8d32', 2, 'api', '2016-06-24 13:05:36', '2016-06-24 13:05:36', 0),
(7, 'rajeshkannan.c@innoppl.com', 'ckgzcWdjNw==', 'f237d5740031a8b953e52b640fce22e3', 2, 'web', '2016-11-29 08:29:47', '2016-11-29 08:29:47', 0),
(8, 'chandrashekar.s@innoppl.com', 'WGJXOGhqQw==', '77e37d469848b8fc38440872459251f0', 2, 'web', '2016-11-29 09:46:15', '2016-11-29 09:46:15', 0),
(9, 'saranya.b@innoppl.com', 'TDFqc0kkeg==', '68c161e4a00df38a0296d1b54af3878d', 1, 'api', '2016-12-22 09:37:33', '2016-12-22 09:37:33', 0),
(10, 'rajeshsun117@gmail.com', 'WnNYdjdO', 'a154ecb4631519016307c872f869c6b4', 0, 'api', '2016-12-22 10:34:37', '2016-12-22 10:34:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `form_hierarchy_id` int(11) NOT NULL,
  `important` int(11) DEFAULT NULL,
  `submission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `user_id`, `form_id`, `form_hierarchy_id`, `important`, `submission`) VALUES
(43, 59, 35, 3, 0, 0),
(44, 60, 35, 3, 0, 0),
(45, 59, 36, 4, 0, 0),
(46, 60, 36, 4, 0, 0),
(48, 58, 40, 8, 0, 0),
(49, 59, 40, 8, 0, 0),
(51, 59, 41, 9, 0, 0),
(61, 59, 53, 21, 0, 0),
(69, 59, 61, 29, 0, 3),
(70, 80, 70, 38, 0, 0),
(71, 80, 71, 39, 0, 0),
(72, 85, 72, 40, 0, 0),
(73, 85, 73, 41, 0, 0),
(74, 89, 74, 42, 0, 0),
(75, 90, 75, 43, 0, 0),
(76, 82, 77, 45, 0, 0),
(77, 82, 78, 46, 0, 0),
(78, 95, 79, 47, 0, 0),
(79, 94, 79, 47, 0, 0),
(80, 94, 81, 49, 0, 0),
(81, 92, 81, 0, NULL, 1),
(83, 102, 82, 50, 0, 0),
(84, 103, 82, 50, 0, 0),
(85, 102, 83, 51, 0, 0),
(86, 103, 83, 51, 0, 0),
(87, 102, 88, 56, 0, 0),
(88, 103, 88, 56, 0, 0),
(89, 100, 88, 0, NULL, 1),
(90, 108, 90, 58, 0, 0),
(91, 108, 91, 59, 0, 0),
(92, 108, 92, 60, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_form_info_options`
--

CREATE TABLE `user_form_info_options` (
  `user_form_info` int(11) NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_option_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_form_info_text`
--

CREATE TABLE `user_form_info_text` (
  `user_form_info_text_id` int(11) NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `status` int(4) NOT NULL COMMENT '1 - approved / 2 - rejected'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_form_info_text`
--

INSERT INTO `user_form_info_text` (`user_form_info_text_id`, `form_field_id`, `user_id`, `form_id`, `submission_id`, `answer`, `comment_id`, `status`) VALUES
(33, 152, 62, 39, 9, '1', 0, 0),
(34, 153, 62, 39, 9, '12/13/2016', 0, 0),
(35, 154, 62, 39, 9, 'http://formpro.enterpriseapplicationdevelopers.com/uploads/34/38/39/62/cached.jpg', 0, 0),
(36, 155, 62, 39, 9, 'http://formpro.enterpriseapplicationdevelopers.com/uploads/34/38/39/62/cached1.jpg', 0, 0),
(37, 218, 67, 60, 10, 'Lo', 0, 0),
(38, 219, 67, 60, 10, 'log@inno.com', 0, 0),
(39, 217, 67, 60, 10, 'Ku', 0, 0),
(40, 220, 67, 60, 10, 'Drupal', 0, 0),
(41, 222, 67, 60, 10, 'Five', 0, 0),
(42, 215, 67, 60, 10, 'Lo', 0, 0),
(43, 218, 67, 60, 11, 'Logesh', 0, 0),
(44, 219, 67, 60, 11, 'log@inno.com', 0, 0),
(45, 217, 67, 60, 11, 'Kumaraguru', 0, 0),
(46, 220, 67, 60, 11, 'Drupal', 0, 0),
(47, 222, 67, 60, 11, 'Five', 0, 0),
(48, 215, 67, 60, 11, 'Logesh', 0, 0),
(49, 215, 67, 60, 12, 'Sa', 0, 0),
(50, 217, 67, 60, 12, 'Ka', 0, 0),
(51, 210, 67, 58, 13, 'apple', 0, 0),
(52, 211, 67, 58, 13, 'very costly', 0, 0),
(53, 212, 67, 58, 13, '20-30', 0, 0),
(54, 210, 67, 58, 14, 'Apple', 0, 0),
(55, 211, 67, 58, 14, 'Costly ', 0, 0),
(56, 212, 67, 58, 14, '30-40', 0, 0),
(57, 210, 67, 58, 15, 'Apple', 0, 0),
(58, 211, 67, 58, 15, 'Costly ', 0, 0),
(59, 212, 67, 58, 15, '30-40', 0, 0),
(60, 210, 67, 58, 16, 'Apple', 0, 0),
(61, 211, 67, 58, 16, 'Costly ', 0, 0),
(62, 212, 67, 58, 16, '30-40', 0, 0),
(63, 226, 59, 61, 17, 'Rajesh', 0, 0),
(64, 227, 59, 61, 17, 'Rajesh', 0, 0),
(65, 226, 59, 61, 18, 'Ramesh', 0, 0),
(66, 227, 59, 61, 18, 'Rajesh', 0, 0),
(67, 226, 59, 61, 19, 'Kannan', 0, 0),
(68, 227, 59, 61, 19, 'Rajesh', 0, 0),
(69, 218, 67, 60, 20, 'INO0187', 0, 0),
(70, 219, 67, 60, 20, 'a@a.in', 0, 0),
(71, 217, 67, 60, 20, 'Kannan', 0, 0),
(72, 222, 67, 60, 20, 'Three', 0, 0),
(73, 215, 67, 60, 20, 'Satheesh', 0, 0),
(74, 215, 67, 60, 21, 'Rajesh', 0, 0),
(75, 217, 67, 60, 21, 'Kannan', 0, 0),
(76, 215, 67, 60, 22, 'Sdcdc', 0, 0),
(77, 217, 67, 60, 22, 'Bgbg', 0, 0),
(78, 215, 67, 60, 23, 'Sdcdc', 0, 0),
(79, 217, 67, 60, 23, 'Bgbg', 0, 0),
(80, 215, 67, 60, 24, 'Sa', 0, 0),
(81, 217, 67, 60, 24, 'av', 0, 0),
(82, 216, 67, 60, 24, 'ka', 0, 0),
(83, 218, 67, 60, 24, 'INOO187', 0, 0),
(84, 219, 67, 60, 24, 'a@a.in', 0, 0),
(85, 220, 67, 60, 24, 'QA', 0, 0),
(86, 222, 67, 60, 24, 'Five', 0, 0),
(87, 217, 67, 60, 25, 'Av', 0, 0),
(88, 218, 67, 60, 25, 'INO0187', 0, 0),
(89, 219, 67, 60, 25, 'a@a.in', 0, 0),
(90, 220, 67, 60, 25, 'QA', 0, 0),
(91, 222, 67, 60, 25, 'Five', 0, 0),
(92, 215, 67, 60, 25, 'Sa', 0, 0),
(93, 216, 67, 60, 25, 'Ka', 0, 0),
(94, 217, 67, 60, 26, 'Av', 0, 0),
(95, 218, 67, 60, 26, 'INO0187', 0, 0),
(96, 219, 67, 60, 26, 'a@a.in', 0, 0),
(97, 220, 67, 60, 26, 'QA', 0, 0),
(98, 222, 67, 60, 26, 'Five', 0, 0),
(99, 215, 67, 60, 26, 'Sa', 0, 0),
(100, 216, 67, 60, 26, 'Ka', 0, 0),
(101, 252, 85, 72, 27, 'Hi', 0, 0),
(102, 253, 85, 72, 27, '02/12/2017', 0, 0),
(103, 255, 85, 73, 28, 'http://www.innoforms.com/uploads/43/50/73/85/cached1.jpg', 0, 0),
(104, 256, 85, 73, 28, 'http://www.innoforms.com/uploads/43/50/73/85/cached.jpg', 0, 0),
(105, 255, 85, 73, 29, 'http://www.innoforms.com/uploads/43/50/73/85/cached3.jpg', 0, 0),
(106, 256, 85, 73, 29, 'http://www.innoforms.com/uploads/43/50/73/85/cached2.jpg', 0, 0),
(107, 262, 90, 75, 30, 'Bhuji', 0, 0),
(108, 264, 90, 75, 30, 'ghjkkkkl@gmail.com', 0, 0),
(109, 263, 90, 75, 30, 'http://www.innoforms.com/uploads/43/50/75/90/cached.jpg', 0, 0),
(110, 262, 90, 75, 31, 'Bhuji', 0, 0),
(111, 264, 90, 75, 31, 'ghjkkkkl@gmail.com', 0, 0),
(112, 263, 90, 75, 31, 'http://www.innoforms.com/uploads/43/50/75/90/cached1.jpg', 0, 0),
(113, 262, 90, 75, 32, 'Hukk', 0, 0),
(114, 264, 90, 75, 32, 'ghj@gmkil.com', 0, 0),
(115, 263, 90, 75, 32, 'http://www.innoforms.com/uploads/43/50/75/90/cached2.jpg', 0, 0),
(116, 262, 90, 75, 33, 'Hukk', 0, 0),
(117, 264, 90, 75, 33, 'ghj@gmkil.com', 0, 0),
(118, 263, 90, 75, 33, 'http://www.innoforms.com/uploads/43/50/75/90/cached3.jpg', 0, 0),
(119, 262, 90, 75, 34, 'Fhuj', 0, 0),
(120, 264, 90, 75, 34, 'fghjk@gmail.com', 0, 0),
(121, 263, 90, 75, 34, 'http://www.innoforms.com/uploads/43/50/75/90/cached4.jpg', 0, 0),
(122, 262, 90, 75, 35, 'Nanthan', 0, 0),
(123, 264, 90, 75, 35, 'm@n.cc', 0, 0),
(124, 263, 90, 75, 35, 'http://www.innoforms.com/uploads/43/50/75/90/', 0, 0),
(125, 262, 90, 75, 36, 'Nanthan', 0, 0),
(126, 264, 90, 75, 36, 'm@n.cc', 0, 0),
(127, 263, 90, 75, 36, 'http://www.innoforms.com/uploads/43/50/75/90/', 0, 0),
(128, 249, 80, 71, 37, 'Hah', 0, 0),
(129, 250, 80, 71, 37, 'hsh@he.com', 0, 0),
(130, 275, 82, 78, 38, 'Yes', 3, 0),
(131, 276, 82, 78, 38, '1234567', 1, 0),
(132, 275, 82, 78, 39, 'Kannan', 0, 0),
(133, 276, 82, 78, 39, '12345', 0, 0),
(134, 262, 90, 75, 40, 'Wioih', 0, 0),
(135, 264, 90, 75, 40, 'hiio@dmm.com', 0, 0),
(136, 263, 90, 75, 40, 'http://www.innoforms.com/uploads/43/50/75/90/cached5.jpg', 0, 0),
(137, 262, 90, 75, 41, 'Wioih', 0, 0),
(138, 264, 90, 75, 41, 'hiio@dmm.com', 0, 0),
(139, 263, 90, 75, 41, 'http://www.innoforms.com/uploads/43/50/75/90/cached6.jpg', 0, 0),
(140, 297, 94, 81, 42, 'Tamilselvan kalimuthu', 4, 0),
(141, 296, 94, 81, 42, 'tamilselvan.k@innoppl.com', 0, 0),
(142, 359, 103, 88, 43, '567894321', 0, 0),
(143, 365, 103, 88, 43, '5000', 0, 0),
(144, 369, 103, 88, 43, '1000', 0, 0),
(145, 358, 103, 88, 43, 'Kuwait', 0, 0),
(146, 357, 103, 88, 43, 'Mahboob', 0, 0),
(147, 368, 103, 88, 43, '50000', 0, 0),
(148, 363, 103, 88, 43, '500000', 0, 0),
(149, 360, 103, 88, 43, 'mahaboob@innoppl.com', 0, 0),
(150, 367, 103, 88, 43, '5000', 0, 0),
(151, 362, 103, 88, 43, '100 story building', 0, 0),
(152, 366, 103, 88, 43, '1000', 0, 0),
(153, 370, 103, 88, 43, 'http://www.innoforms.com/uploads/49/58/88/103/cached.jpg', 0, 0),
(154, 376, 108, 90, 44, 'Testing', 0, 0),
(155, 377, 108, 91, 45, 'Poper', 0, 0),
(156, 378, 108, 91, 45, 'b@b.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'User id from users table',
  `location_id` bigint(20) NOT NULL COMMENT 'Location id from org_location table primary key'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`id`, `user_id`, `location_id`) VALUES
(1, 1, 1),
(65, 57, 36),
(66, 58, 36),
(67, 59, 36),
(68, 57, 37),
(69, 58, 37),
(70, 59, 37),
(71, 60, 36),
(72, 60, 37),
(80, 57, 41),
(81, 59, 41),
(82, 60, 41),
(85, 69, 36),
(94, 78, 47),
(95, 79, 47),
(96, 80, 47),
(97, 81, 48),
(101, 82, 48),
(102, 83, 48),
(103, 83, 49),
(104, 84, 50),
(105, 85, 50),
(106, 86, 51),
(107, 87, 52),
(108, 88, 53),
(109, 89, 53),
(110, 90, 50),
(111, 91, 54),
(112, 92, 54),
(113, 93, 54),
(114, 94, 54),
(115, 95, 54),
(116, 96, 50),
(117, 97, 55),
(118, 97, 56),
(119, 97, 57),
(120, 98, 55),
(121, 98, 56),
(122, 98, 57),
(123, 99, 58),
(124, 99, 59),
(125, 99, 60),
(126, 100, 58),
(127, 100, 59),
(128, 100, 60),
(129, 101, 58),
(130, 101, 59),
(131, 101, 60),
(132, 102, 58),
(133, 102, 59),
(134, 102, 60),
(135, 103, 58),
(136, 103, 59),
(137, 103, 60),
(138, 104, 61),
(139, 105, 61),
(140, 106, 61),
(141, 107, 62),
(142, 108, 62),
(143, 109, 63),
(144, 110, 64),
(145, 111, 65),
(146, 112, 65),
(147, 113, 65),
(148, 114, 65);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_76`
-- (See below for the actual view)
--
CREATE TABLE `view_76` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_265` varchar(255)
,`value_266` varchar(255)
,`value_267` varchar(255)
,`value_268` varchar(255)
,`value_269` varchar(255)
,`value_270` varchar(255)
,`value_271` varchar(255)
,`value_272` varchar(255)
,`value_273` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_77`
-- (See below for the actual view)
--
CREATE TABLE `view_77` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_274` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_78`
-- (See below for the actual view)
--
CREATE TABLE `view_78` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_275` varchar(255)
,`value_276` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_79`
-- (See below for the actual view)
--
CREATE TABLE `view_79` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_277` varchar(255)
,`value_278` varchar(255)
,`value_279` varchar(255)
,`value_280` varchar(255)
,`value_281` varchar(255)
,`value_282` varchar(255)
,`value_283` varchar(255)
,`value_284` varchar(255)
,`value_285` varchar(255)
,`value_286` varchar(255)
,`value_287` varchar(255)
,`value_288` varchar(255)
,`value_289` varchar(255)
,`value_290` varchar(255)
,`value_291` varchar(255)
,`value_292` varchar(255)
,`value_293` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_81`
-- (See below for the actual view)
--
CREATE TABLE `view_81` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_295` varchar(255)
,`value_296` varchar(255)
,`value_297` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_82`
-- (See below for the actual view)
--
CREATE TABLE `view_82` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_298` varchar(255)
,`value_299` varchar(255)
,`value_300` varchar(255)
,`value_301` varchar(255)
,`value_302` varchar(255)
,`value_303` varchar(255)
,`value_304` varchar(255)
,`value_305` varchar(255)
,`value_306` varchar(255)
,`value_307` varchar(255)
,`value_308` varchar(255)
,`value_309` varchar(255)
,`value_310` varchar(255)
,`value_311` varchar(255)
,`value_312` varchar(255)
,`value_313` varchar(255)
,`value_314` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_83`
-- (See below for the actual view)
--
CREATE TABLE `view_83` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_315` varchar(255)
,`value_316` varchar(255)
,`value_317` varchar(255)
,`value_318` varchar(255)
,`value_319` varchar(255)
,`value_320` varchar(255)
,`value_321` varchar(255)
,`value_322` varchar(255)
,`value_323` varchar(255)
,`value_324` varchar(255)
,`value_325` varchar(255)
,`value_326` varchar(255)
,`value_327` varchar(255)
,`value_328` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_88`
-- (See below for the actual view)
--
CREATE TABLE `view_88` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_356` varchar(255)
,`value_357` varchar(255)
,`value_358` varchar(255)
,`value_359` varchar(255)
,`value_360` varchar(255)
,`value_361` varchar(255)
,`value_362` varchar(255)
,`value_363` varchar(255)
,`value_364` varchar(255)
,`value_365` varchar(255)
,`value_366` varchar(255)
,`value_367` varchar(255)
,`value_368` varchar(255)
,`value_369` varchar(255)
,`value_370` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_90`
-- (See below for the actual view)
--
CREATE TABLE `view_90` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_376` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_91`
-- (See below for the actual view)
--
CREATE TABLE `view_91` (
`submission_id` int(11)
,`form_field_id` int(11)
,`user_id` int(11)
,`value_377` varchar(255)
,`value_378` varchar(255)
,`value_379` varchar(255)
,`value_380` varchar(255)
,`value_381` varchar(255)
,`value_382` varchar(255)
,`value_383` varchar(255)
,`value_384` varchar(255)
,`value_385` varchar(255)
,`form_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_76`
--
DROP TABLE IF EXISTS `view_76`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_76`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '265'),`user_form_info_text`.`answer`,NULL)) AS `value_265`,max(if((`user_form_info_text`.`form_field_id` = '266'),`user_form_info_text`.`answer`,NULL)) AS `value_266`,max(if((`user_form_info_text`.`form_field_id` = '267'),`user_form_info_text`.`answer`,NULL)) AS `value_267`,max(if((`user_form_info_text`.`form_field_id` = '268'),`user_form_info_text`.`answer`,NULL)) AS `value_268`,max(if((`user_form_info_text`.`form_field_id` = '269'),`user_form_info_text`.`answer`,NULL)) AS `value_269`,max(if((`user_form_info_text`.`form_field_id` = '270'),`user_form_info_text`.`answer`,NULL)) AS `value_270`,max(if((`user_form_info_text`.`form_field_id` = '271'),`user_form_info_text`.`answer`,NULL)) AS `value_271`,max(if((`user_form_info_text`.`form_field_id` = '272'),`user_form_info_text`.`answer`,NULL)) AS `value_272`,max(if((`user_form_info_text`.`form_field_id` = '273'),`user_form_info_text`.`answer`,NULL)) AS `value_273`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 76) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_77`
--
DROP TABLE IF EXISTS `view_77`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_77`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '274'),`user_form_info_text`.`answer`,NULL)) AS `value_274`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 77) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_78`
--
DROP TABLE IF EXISTS `view_78`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_78`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '275'),`user_form_info_text`.`answer`,NULL)) AS `value_275`,max(if((`user_form_info_text`.`form_field_id` = '276'),`user_form_info_text`.`answer`,NULL)) AS `value_276`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 78) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_79`
--
DROP TABLE IF EXISTS `view_79`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_79`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '277'),`user_form_info_text`.`answer`,NULL)) AS `value_277`,max(if((`user_form_info_text`.`form_field_id` = '278'),`user_form_info_text`.`answer`,NULL)) AS `value_278`,max(if((`user_form_info_text`.`form_field_id` = '279'),`user_form_info_text`.`answer`,NULL)) AS `value_279`,max(if((`user_form_info_text`.`form_field_id` = '280'),`user_form_info_text`.`answer`,NULL)) AS `value_280`,max(if((`user_form_info_text`.`form_field_id` = '281'),`user_form_info_text`.`answer`,NULL)) AS `value_281`,max(if((`user_form_info_text`.`form_field_id` = '282'),`user_form_info_text`.`answer`,NULL)) AS `value_282`,max(if((`user_form_info_text`.`form_field_id` = '283'),`user_form_info_text`.`answer`,NULL)) AS `value_283`,max(if((`user_form_info_text`.`form_field_id` = '284'),`user_form_info_text`.`answer`,NULL)) AS `value_284`,max(if((`user_form_info_text`.`form_field_id` = '285'),`user_form_info_text`.`answer`,NULL)) AS `value_285`,max(if((`user_form_info_text`.`form_field_id` = '286'),`user_form_info_text`.`answer`,NULL)) AS `value_286`,max(if((`user_form_info_text`.`form_field_id` = '287'),`user_form_info_text`.`answer`,NULL)) AS `value_287`,max(if((`user_form_info_text`.`form_field_id` = '288'),`user_form_info_text`.`answer`,NULL)) AS `value_288`,max(if((`user_form_info_text`.`form_field_id` = '289'),`user_form_info_text`.`answer`,NULL)) AS `value_289`,max(if((`user_form_info_text`.`form_field_id` = '290'),`user_form_info_text`.`answer`,NULL)) AS `value_290`,max(if((`user_form_info_text`.`form_field_id` = '291'),`user_form_info_text`.`answer`,NULL)) AS `value_291`,max(if((`user_form_info_text`.`form_field_id` = '292'),`user_form_info_text`.`answer`,NULL)) AS `value_292`,max(if((`user_form_info_text`.`form_field_id` = '293'),`user_form_info_text`.`answer`,NULL)) AS `value_293`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 79) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_81`
--
DROP TABLE IF EXISTS `view_81`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_81`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '295'),`user_form_info_text`.`answer`,NULL)) AS `value_295`,max(if((`user_form_info_text`.`form_field_id` = '296'),`user_form_info_text`.`answer`,NULL)) AS `value_296`,max(if((`user_form_info_text`.`form_field_id` = '297'),`user_form_info_text`.`answer`,NULL)) AS `value_297`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 81) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_82`
--
DROP TABLE IF EXISTS `view_82`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_82`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '298'),`user_form_info_text`.`answer`,NULL)) AS `value_298`,max(if((`user_form_info_text`.`form_field_id` = '299'),`user_form_info_text`.`answer`,NULL)) AS `value_299`,max(if((`user_form_info_text`.`form_field_id` = '300'),`user_form_info_text`.`answer`,NULL)) AS `value_300`,max(if((`user_form_info_text`.`form_field_id` = '301'),`user_form_info_text`.`answer`,NULL)) AS `value_301`,max(if((`user_form_info_text`.`form_field_id` = '302'),`user_form_info_text`.`answer`,NULL)) AS `value_302`,max(if((`user_form_info_text`.`form_field_id` = '303'),`user_form_info_text`.`answer`,NULL)) AS `value_303`,max(if((`user_form_info_text`.`form_field_id` = '304'),`user_form_info_text`.`answer`,NULL)) AS `value_304`,max(if((`user_form_info_text`.`form_field_id` = '305'),`user_form_info_text`.`answer`,NULL)) AS `value_305`,max(if((`user_form_info_text`.`form_field_id` = '306'),`user_form_info_text`.`answer`,NULL)) AS `value_306`,max(if((`user_form_info_text`.`form_field_id` = '307'),`user_form_info_text`.`answer`,NULL)) AS `value_307`,max(if((`user_form_info_text`.`form_field_id` = '308'),`user_form_info_text`.`answer`,NULL)) AS `value_308`,max(if((`user_form_info_text`.`form_field_id` = '309'),`user_form_info_text`.`answer`,NULL)) AS `value_309`,max(if((`user_form_info_text`.`form_field_id` = '310'),`user_form_info_text`.`answer`,NULL)) AS `value_310`,max(if((`user_form_info_text`.`form_field_id` = '311'),`user_form_info_text`.`answer`,NULL)) AS `value_311`,max(if((`user_form_info_text`.`form_field_id` = '312'),`user_form_info_text`.`answer`,NULL)) AS `value_312`,max(if((`user_form_info_text`.`form_field_id` = '313'),`user_form_info_text`.`answer`,NULL)) AS `value_313`,max(if((`user_form_info_text`.`form_field_id` = '314'),`user_form_info_text`.`answer`,NULL)) AS `value_314`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 82) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_83`
--
DROP TABLE IF EXISTS `view_83`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_83`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '315'),`user_form_info_text`.`answer`,NULL)) AS `value_315`,max(if((`user_form_info_text`.`form_field_id` = '316'),`user_form_info_text`.`answer`,NULL)) AS `value_316`,max(if((`user_form_info_text`.`form_field_id` = '317'),`user_form_info_text`.`answer`,NULL)) AS `value_317`,max(if((`user_form_info_text`.`form_field_id` = '318'),`user_form_info_text`.`answer`,NULL)) AS `value_318`,max(if((`user_form_info_text`.`form_field_id` = '319'),`user_form_info_text`.`answer`,NULL)) AS `value_319`,max(if((`user_form_info_text`.`form_field_id` = '320'),`user_form_info_text`.`answer`,NULL)) AS `value_320`,max(if((`user_form_info_text`.`form_field_id` = '321'),`user_form_info_text`.`answer`,NULL)) AS `value_321`,max(if((`user_form_info_text`.`form_field_id` = '322'),`user_form_info_text`.`answer`,NULL)) AS `value_322`,max(if((`user_form_info_text`.`form_field_id` = '323'),`user_form_info_text`.`answer`,NULL)) AS `value_323`,max(if((`user_form_info_text`.`form_field_id` = '324'),`user_form_info_text`.`answer`,NULL)) AS `value_324`,max(if((`user_form_info_text`.`form_field_id` = '325'),`user_form_info_text`.`answer`,NULL)) AS `value_325`,max(if((`user_form_info_text`.`form_field_id` = '326'),`user_form_info_text`.`answer`,NULL)) AS `value_326`,max(if((`user_form_info_text`.`form_field_id` = '327'),`user_form_info_text`.`answer`,NULL)) AS `value_327`,max(if((`user_form_info_text`.`form_field_id` = '328'),`user_form_info_text`.`answer`,NULL)) AS `value_328`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 83) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_88`
--
DROP TABLE IF EXISTS `view_88`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_88`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '356'),`user_form_info_text`.`answer`,NULL)) AS `value_356`,max(if((`user_form_info_text`.`form_field_id` = '357'),`user_form_info_text`.`answer`,NULL)) AS `value_357`,max(if((`user_form_info_text`.`form_field_id` = '358'),`user_form_info_text`.`answer`,NULL)) AS `value_358`,max(if((`user_form_info_text`.`form_field_id` = '359'),`user_form_info_text`.`answer`,NULL)) AS `value_359`,max(if((`user_form_info_text`.`form_field_id` = '360'),`user_form_info_text`.`answer`,NULL)) AS `value_360`,max(if((`user_form_info_text`.`form_field_id` = '361'),`user_form_info_text`.`answer`,NULL)) AS `value_361`,max(if((`user_form_info_text`.`form_field_id` = '362'),`user_form_info_text`.`answer`,NULL)) AS `value_362`,max(if((`user_form_info_text`.`form_field_id` = '363'),`user_form_info_text`.`answer`,NULL)) AS `value_363`,max(if((`user_form_info_text`.`form_field_id` = '364'),`user_form_info_text`.`answer`,NULL)) AS `value_364`,max(if((`user_form_info_text`.`form_field_id` = '365'),`user_form_info_text`.`answer`,NULL)) AS `value_365`,max(if((`user_form_info_text`.`form_field_id` = '366'),`user_form_info_text`.`answer`,NULL)) AS `value_366`,max(if((`user_form_info_text`.`form_field_id` = '367'),`user_form_info_text`.`answer`,NULL)) AS `value_367`,max(if((`user_form_info_text`.`form_field_id` = '368'),`user_form_info_text`.`answer`,NULL)) AS `value_368`,max(if((`user_form_info_text`.`form_field_id` = '369'),`user_form_info_text`.`answer`,NULL)) AS `value_369`,max(if((`user_form_info_text`.`form_field_id` = '370'),`user_form_info_text`.`answer`,NULL)) AS `value_370`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 88) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_90`
--
DROP TABLE IF EXISTS `view_90`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_90`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '376'),`user_form_info_text`.`answer`,NULL)) AS `value_376`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 90) group by `user_form_info_text`.`submission_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_91`
--
DROP TABLE IF EXISTS `view_91`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_91`  AS  select `user_form_info_text`.`submission_id` AS `submission_id`,`user_form_info_text`.`form_field_id` AS `form_field_id`,`user_form_info_text`.`user_id` AS `user_id`,max(if((`user_form_info_text`.`form_field_id` = '377'),`user_form_info_text`.`answer`,NULL)) AS `value_377`,max(if((`user_form_info_text`.`form_field_id` = '378'),`user_form_info_text`.`answer`,NULL)) AS `value_378`,max(if((`user_form_info_text`.`form_field_id` = '379'),`user_form_info_text`.`answer`,NULL)) AS `value_379`,max(if((`user_form_info_text`.`form_field_id` = '380'),`user_form_info_text`.`answer`,NULL)) AS `value_380`,max(if((`user_form_info_text`.`form_field_id` = '381'),`user_form_info_text`.`answer`,NULL)) AS `value_381`,max(if((`user_form_info_text`.`form_field_id` = '382'),`user_form_info_text`.`answer`,NULL)) AS `value_382`,max(if((`user_form_info_text`.`form_field_id` = '383'),`user_form_info_text`.`answer`,NULL)) AS `value_383`,max(if((`user_form_info_text`.`form_field_id` = '384'),`user_form_info_text`.`answer`,NULL)) AS `value_384`,max(if((`user_form_info_text`.`form_field_id` = '385'),`user_form_info_text`.`answer`,NULL)) AS `value_385`,`user_form_info_text`.`form_id` AS `form_id` from `user_form_info_text` where (`user_form_info_text`.`form_id` = 91) group by `user_form_info_text`.`submission_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_comments`
--
ALTER TABLE `alert_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_details`
--
ALTER TABLE `alert_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alert id` (`alert_id`);

--
-- Indexes for table `alert_images`
--
ALTER TABLE `alert_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_reporting_mapping`
--
ALTER TABLE `alert_reporting_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appapi`
--
ALTER TABLE `appapi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `category_department`
--
ALTER TABLE `category_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat` (`cat_id`),
  ADD KEY `dept_domain` (`dept_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `submission` (`submission_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `department_domain`
--
ALTER TABLE `department_domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dept` (`dept_id`),
  ADD KEY `domaincountry` (`domain_id`);

--
-- Indexes for table `device_token`
--
ALTER TABLE `device_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`domain_id`);

--
-- Indexes for table `domain_country`
--
ALTER TABLE `domain_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `domain` (`domain_id`),
  ADD KEY `country` (`country_id`);

--
-- Indexes for table `fields_master`
--
ALTER TABLE `fields_master`
  ADD PRIMARY KEY (`fields_master_id`);

--
-- Indexes for table `form_category`
--
ALTER TABLE `form_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `Category id` (`cat_id`);

--
-- Indexes for table `form_dept`
--
ALTER TABLE `form_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_details`
--
ALTER TABLE `form_details`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`form_fields_id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `form_hierarchy`
--
ALTER TABLE `form_hierarchy`
  ADD PRIMARY KEY (`form_hierarchy_id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `form_hierarchy_position`
--
ALTER TABLE `form_hierarchy_position`
  ADD PRIMARY KEY (`form_hierarchy_position_id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `form_location`
--
ALTER TABLE `form_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `form_options`
--
ALTER TABLE `form_options`
  ADD PRIMARY KEY (`form_option_id`),
  ADD KEY `form_fields_id` (`form_fields_id`);

--
-- Indexes for table `form_review_history`
--
ALTER TABLE `form_review_history`
  ADD PRIMARY KEY (`form_review_history_id`);

--
-- Indexes for table `form_submission`
--
ALTER TABLE `form_submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notify_to` (`notify_to`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_subscription_plan`
--
ALTER TABLE `organization_subscription_plan`
  ADD PRIMARY KEY (`org_sub_plan_id`),
  ADD KEY `subscription_id` (`subscription_id`),
  ADD KEY `organization_id` (`organization_id`);

--
-- Indexes for table `org_domain`
--
ALTER TABLE `org_domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_location` (`org_location_id`),
  ADD KEY `domian` (`domain_id`);

--
-- Indexes for table `org_location`
--
ALTER TABLE `org_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org` (`org_id`);

--
-- Indexes for table `org_user_department`
--
ALTER TABLE `org_user_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department id` (`dept_id`),
  ADD KEY `user id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `roles_category_type`
--
ALTER TABLE `roles_category_type`
  ADD PRIMARY KEY (`roles_category_type_id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles` (`role_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `subscription_plan_details`
--
ALTER TABLE `subscription_plan_details`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_permission` (`user_role_id`),
  ADD KEY `usr_org_loc` (`user_org_loc_id`);

--
-- Indexes for table `users_post`
--
ALTER TABLE `users_post`
  ADD PRIMARY KEY (`users_post`);

--
-- Indexes for table `user_forgot_reset_pwd`
--
ALTER TABLE `user_forgot_reset_pwd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `form_hierarchy_id` (`form_hierarchy_id`);

--
-- Indexes for table `user_form_info_options`
--
ALTER TABLE `user_form_info_options`
  ADD PRIMARY KEY (`user_form_info`),
  ADD KEY `submisison_id` (`submission_id`);

--
-- Indexes for table `user_form_info_text`
--
ALTER TABLE `user_form_info_text`
  ADD PRIMARY KEY (`user_form_info_text_id`),
  ADD KEY `submisison_id` (`submission_id`);

--
-- Indexes for table `user_location`
--
ALTER TABLE `user_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user id` (`user_id`),
  ADD KEY `location id` (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `alert_comments`
--
ALTER TABLE `alert_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `alert_details`
--
ALTER TABLE `alert_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `alert_images`
--
ALTER TABLE `alert_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `alert_reporting_mapping`
--
ALTER TABLE `alert_reporting_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `appapi`
--
ALTER TABLE `appapi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `category_department`
--
ALTER TABLE `category_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `department_domain`
--
ALTER TABLE `department_domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `device_token`
--
ALTER TABLE `device_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `domain_country`
--
ALTER TABLE `domain_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `fields_master`
--
ALTER TABLE `fields_master`
  MODIFY `fields_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `form_category`
--
ALTER TABLE `form_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT for table `form_dept`
--
ALTER TABLE `form_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `form_details`
--
ALTER TABLE `form_details`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `form_fields_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;
--
-- AUTO_INCREMENT for table `form_hierarchy`
--
ALTER TABLE `form_hierarchy`
  MODIFY `form_hierarchy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `form_hierarchy_position`
--
ALTER TABLE `form_hierarchy_position`
  MODIFY `form_hierarchy_position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `form_location`
--
ALTER TABLE `form_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `form_options`
--
ALTER TABLE `form_options`
  MODIFY `form_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `form_review_history`
--
ALTER TABLE `form_review_history`
  MODIFY `form_review_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `form_submission`
--
ALTER TABLE `form_submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `organization_subscription_plan`
--
ALTER TABLE `organization_subscription_plan`
  MODIFY `org_sub_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `org_domain`
--
ALTER TABLE `org_domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `org_location`
--
ALTER TABLE `org_location`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `org_user_department`
--
ALTER TABLE `org_user_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `roles_category_type`
--
ALTER TABLE `roles_category_type`
  MODIFY `roles_category_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `subscription_plan_details`
--
ALTER TABLE `subscription_plan_details`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT for table `users_post`
--
ALTER TABLE `users_post`
  MODIFY `users_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_forgot_reset_pwd`
--
ALTER TABLE `user_forgot_reset_pwd`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `user_form_info_options`
--
ALTER TABLE `user_form_info_options`
  MODIFY `user_form_info` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_form_info_text`
--
ALTER TABLE `user_form_info_text`
  MODIFY `user_form_info_text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `user_location`
--
ALTER TABLE `user_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert_details`
--
ALTER TABLE `alert_details`
  ADD CONSTRAINT `alert_details_ibfk_1` FOREIGN KEY (`alert_id`) REFERENCES `alerts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_department`
--
ALTER TABLE `category_department`
  ADD CONSTRAINT `category_department_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_department_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `form_submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_domain`
--
ALTER TABLE `department_domain`
  ADD CONSTRAINT `department_domain_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `domain_country`
--
ALTER TABLE `domain_country`
  ADD CONSTRAINT `domain_country_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`domain_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domain_country_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `location` (`loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_category`
--
ALTER TABLE `form_category`
  ADD CONSTRAINT `form_category_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form_details` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `form_category_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_hierarchy`
--
ALTER TABLE `form_hierarchy`
  ADD CONSTRAINT `form_hierarchy_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form_details` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_hierarchy_position`
--
ALTER TABLE `form_hierarchy_position`
  ADD CONSTRAINT `form_hierarchy_position_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form_details` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `form_hierarchy_position_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form_options`
--
ALTER TABLE `form_options`
  ADD CONSTRAINT `form_options_ibfk_1` FOREIGN KEY (`form_fields_id`) REFERENCES `form_fields` (`form_fields_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`notify_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organization_subscription_plan`
--
ALTER TABLE `organization_subscription_plan`
  ADD CONSTRAINT `organization_subscription_plan_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `organization_subscription_plan_ibfk_2` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `org_domain`
--
ALTER TABLE `org_domain`
  ADD CONSTRAINT `org_domain_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`domain_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `org_domain_ibfk_2` FOREIGN KEY (`org_location_id`) REFERENCES `org_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `org_location`
--
ALTER TABLE `org_location`
  ADD CONSTRAINT `org_location_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `org_user_department`
--
ALTER TABLE `org_user_department`
  ADD CONSTRAINT `org_user_department_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `org_user_department_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_org_loc_id`) REFERENCES `org_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_form`
--
ALTER TABLE `user_form`
  ADD CONSTRAINT `user_form_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_form_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `form_details` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_form_info_options`
--
ALTER TABLE `user_form_info_options`
  ADD CONSTRAINT `user_form_info_options_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `form_submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_form_info_text`
--
ALTER TABLE `user_form_info_text`
  ADD CONSTRAINT `user_form_info_text_ibfk_1` FOREIGN KEY (`submission_id`) REFERENCES `form_submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_location`
--
ALTER TABLE `user_location`
  ADD CONSTRAINT `user_location_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_location_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `org_location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
