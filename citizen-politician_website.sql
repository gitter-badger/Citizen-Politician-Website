-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2018 at 05:00 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citizen-politician website`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `commentID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commentor` varchar(255) NOT NULL,
  `referring` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '-1',
  `type` int(11) NOT NULL DEFAULT '1',
  `reply` int(11) NOT NULL DEFAULT '0',
  `replyID` int(11) NOT NULL DEFAULT '0',
  `evidence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`commentID`, `comment`, `commentor`, `referring`, `time`, `state`, `type`, `reply`, `replyID`, `evidence`) VALUES
(1, 'joho is the best governor of county 001', 'ericko', 'joho', '2018-09-30 16:14:07', 1, 1, 0, 0, 'mwananchi/achievements/1/'),
(2, 'Kiraitu ni Muongo sana. Hakuna kitu ametufanyia.', 'fahm_de', 'kiraitu', '2018-09-30 16:14:07', 0, 1, 0, 0, 'mwananchi/achievements/2/'),
(3, 'Mutua was last seen fighting for water for kitui residents. Big up yourself', 'smurfet', 'mutua', '2018-09-30 16:18:21', 1, 1, 0, 0, 'mwananchi/achievements/3/'),
(4, 'Sonko is developing nairobi alot', 'glokym', 'sonko', '2018-09-30 16:18:21', 1, 1, 0, 0, 'mwananchi/achievements/4/'),
(5, 'I love my county', 'Mirry', 'Kiraitu', '2018-10-08 11:02:19', 1, 1, 0, 0, 'mwananchi/achievements/5/'),
(6, 'Alfred Mutua has really tried to help the water situation in machakos.', 'ericko', 'mutua', '2018-10-08 14:14:01', 1, 1, 0, 0, 'mwananchi/achievements/6/'),
(7, 'Sonko is really trying to improve nairobi. Big up Sonko rescue team #lit', 'glokym', 'sonko', '2018-10-30 19:07:01', 1, 1, 0, 0, 'mwananchi/achievements/7/');

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `adminUserName` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `userGender` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `userType` varchar(255) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`adminUserName`, `adminPassword`, `userGender`, `photo`, `userType`) VALUES
('dopesky', '$2y$10$QLJ.ITobnhfNE.8HbOKDZOYi6IrE5aWbjz3VknTwPNlgN6KwNVEIm', 'male', 'user.png', 'admin'),
('essnj', '$2y$10$vBCaC5SVDwAqDxUoKa8/Vu1dF/QixjczlS4at.4/gF0HUDVZbOCTi', 'female', 'userFemale.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `analysisdata`
--

CREATE TABLE `analysisdata` (
  `analysisID` int(11) NOT NULL,
  `analysis` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parentID` int(11) NOT NULL,
  `analysor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analysisdata`
--

INSERT INTO `analysisdata` (`analysisID`, `analysis`, `type`, `time`, `parentID`, `analysor`) VALUES
(1, 'achievements', 1, '2018-10-23 07:41:35', 1, 'ericko'),
(2, 'comments', 1, '2018-10-27 20:49:51', 6, 'mathenge'),
(3, 'Comments', -1, '2018-10-29 08:34:39', 6, 'ericko'),
(4, 'Comments', 1, '2018-10-29 08:37:19', 6, 'ericko'),
(5, 'Comments', -1, '2018-10-29 08:51:37', 5, 'ericko'),
(6, 'Comments', 1, '2018-10-29 08:51:49', 5, 'ericko'),
(7, 'Comments', 0, '2018-10-29 09:03:13', 4, 'ericko'),
(8, 'Achievements', 1, '2018-10-29 09:14:56', 6, 'ericko'),
(9, 'Achievements', -1, '2018-10-29 09:15:12', 6, 'ericko'),
(10, 'Comments', -1, '2018-10-29 09:19:38', 1, 'ericko'),
(11, 'Comments', 1, '2018-10-29 09:19:47', 1, 'ericko'),
(12, 'Achievements', 0, '2018-10-29 09:20:07', 5, 'ericko'),
(13, 'Achievements', -1, '2018-10-29 09:20:22', 5, 'ericko'),
(14, 'Comments', -1, '2018-10-29 09:40:23', 4, 'ericko'),
(15, 'Comments', -1, '2018-10-29 09:40:32', 3, 'ericko'),
(16, 'Comments', 0, '2018-10-29 09:40:34', 3, 'ericko'),
(17, 'Critiques', -1, '2018-10-29 09:42:38', 4, 'ericko'),
(18, 'Critiques', 1, '2018-10-29 09:42:41', 4, 'ericko'),
(19, 'Achievements', -1, '2018-10-29 09:43:28', 4, 'ericko'),
(20, 'Critiques', -1, '2018-10-29 09:44:22', 3, 'ericko'),
(21, 'Critiques', -1, '2018-10-29 09:44:26', 1, 'ericko'),
(22, 'Achievements', -1, '2018-10-29 09:44:38', 3, 'ericko'),
(23, 'Achievements', -1, '2018-10-29 09:44:42', 1, 'ericko'),
(24, 'Achievements', 1, '2018-10-29 09:48:22', 4, 'ericko'),
(25, 'Achievements', 0, '2018-10-29 09:48:31', 3, 'ericko'),
(26, 'Comments', -1, '2018-10-29 09:52:27', 6, 'Mirry'),
(27, 'Comments', 0, '2018-10-29 09:54:24', 5, 'Mirry'),
(28, 'Comments', -1, '2018-10-29 09:54:26', 5, 'Mirry'),
(29, 'Comments', -1, '2018-10-29 09:54:30', 4, 'Mirry'),
(30, 'Comments', 0, '2018-10-29 09:54:33', 4, 'Mirry'),
(31, 'Comments', -1, '2018-10-29 09:54:37', 3, 'Mirry'),
(32, 'Comments', 1, '2018-10-29 09:54:39', 3, 'Mirry'),
(33, 'Comments', -1, '2018-10-29 09:54:43', 1, 'Mirry'),
(34, 'Comments', 1, '2018-10-29 09:54:45', 1, 'Mirry'),
(35, 'Achievements', -1, '2018-10-29 10:11:07', 6, 'Mirry'),
(36, 'Achievements', 1, '2018-10-29 10:11:10', 6, 'Mirry'),
(37, 'Achievements', 1, '2018-10-29 10:11:21', 5, 'Mirry'),
(38, 'Achievements', -1, '2018-10-29 10:11:26', 5, 'Mirry'),
(39, 'Critiques', -1, '2018-10-29 13:05:54', 4, 'Mirry'),
(40, 'Critiques', 1, '2018-10-29 13:06:00', 4, 'Mirry'),
(41, 'Comments', 1, '2018-10-30 07:30:23', 12, 'Mirry'),
(42, 'Comments', -1, '2018-10-30 07:30:27', 12, 'Mirry'),
(43, 'Comments', -1, '2018-10-30 08:07:36', 1, 'glokym'),
(44, 'Comments', 1, '2018-10-30 08:07:43', 1, 'glokym'),
(45, 'Comments', 1, '2018-10-30 19:38:03', 17, 'glokym'),
(46, 'Comments', 0, '2018-10-31 07:10:03', 20, 'Mirry'),
(47, 'Comments', 1, '2018-10-31 07:10:09', 19, 'Mirry'),
(48, 'Comments', 1, '2018-10-31 07:10:58', 18, 'Mirry'),
(49, 'Comments', 0, '2018-10-31 07:11:13', 16, 'Mirry'),
(50, 'Comments', 1, '2018-10-31 07:11:22', 15, 'Mirry'),
(51, 'Comments', 1, '2018-10-31 07:11:31', 14, 'Mirry'),
(52, 'Comments', 1, '2018-10-31 07:11:41', 13, 'Mirry'),
(53, 'Comments', 1, '2018-10-31 07:12:00', 11, 'Mirry'),
(54, 'Comments', 0, '2018-10-31 07:12:07', 6, 'Mirry'),
(55, 'Comments', -1, '2018-10-31 10:28:30', 16, 'Mirry'),
(56, 'Achievements', 1, '2018-10-31 10:29:05', 7, 'Mirry'),
(57, 'Achievements', -1, '2018-10-31 10:29:06', 7, 'Mirry'),
(58, 'Comments', -1, '2018-10-31 10:30:57', 20, 'Mirry'),
(59, 'Comments', -1, '2018-10-31 17:30:05', 20, 'olamide'),
(60, 'Comments', 1, '2018-10-31 17:30:12', 20, 'olamide'),
(61, 'Comments', 1, '2018-10-31 17:30:18', 19, 'olamide'),
(62, 'Comments', 1, '2018-10-31 17:30:22', 18, 'olamide'),
(63, 'Comments', 0, '2018-10-31 17:30:26', 17, 'olamide'),
(64, 'Comments', 0, '2018-10-31 17:30:34', 16, 'olamide'),
(65, 'Comments', 0, '2018-10-31 17:30:38', 15, 'olamide'),
(66, 'Comments', 1, '2018-10-31 17:30:44', 14, 'olamide'),
(67, 'Comments', 0, '2018-10-31 17:30:51', 13, 'olamide'),
(68, 'Comments', 1, '2018-10-31 17:30:59', 12, 'olamide'),
(69, 'Comments', 0, '2018-10-31 17:31:18', 11, 'olamide'),
(70, 'Comments', 0, '2018-10-31 17:31:23', 6, 'olamide'),
(71, 'Comments', 1, '2018-10-31 17:31:34', 5, 'olamide'),
(72, 'Comments', 0, '2018-10-31 17:32:45', 1, 'olamide'),
(73, 'Comments', -1, '2018-10-31 17:32:54', 3, 'olamide'),
(74, 'Comments', 1, '2018-10-31 17:32:56', 3, 'olamide');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_profile`
--

CREATE TABLE `citizen_profile` (
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `verifyEmail` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(255) NOT NULL,
  `verifyPhone` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT 'citizen',
  `County` int(11) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `Secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citizen_profile`
--

INSERT INTO `citizen_profile` (`UserName`, `Email`, `verifyEmail`, `phone`, `verifyPhone`, `gender`, `type`, `County`, `photo`, `Secret`) VALUES
('ericko', 'kevin.kathendu@strathmore.edu', 1, '0734124567', 0, 'male', 'citizen', 3, 'user.png', '$2y$10$QZ9HYc2dB5Hg5zZJIbM5JuN7EfPZLMyo6gyiwGaaEs3ZTWm7Zs6J.'),
('fahm_de', 'oboke69@gmail.com', 1, '0792261344', 0, 'male', 'citizen', 5, 'user.png', '$2y$10$BJcM6nxVr7h7Kj1sWDk6auzBa2Qn99UfVH/J/sR.cpWOM.122mfdC'),
('glokym', 'glorynkatha15@gmail.com', 1, '0792141986', 1, 'female', 'citizen', 5, 'userFemale.png', '$2y$10$u/z4nkcu2zrY7deN9sXl3OYZxZso3hRmLwNQg.LnW2TafJu.EY4KC'),
('julz', 'julie.munyui@strathmore.edu', 0, '0797345678', 0, 'female', 'citizen', 7, 'userFemale.png', '$2y$10$yxqaTMt70A2Dfg33uUwNOOQ8kI6OdaRNqlcurV8n32jxwNPj5M6wG'),
('mathenge', 'oboke69@yahoo.com', 1, '0765423433', 0, 'male', 'citizen', 9, 'user.png', '$2y$10$4rYIid0Zh2HePW0zgjLWju2QXCOj61k07sQWiD9IxieiVtJ2irw6q'),
('Mirry', 'mirrymukami@gmail.com', 0, '0712345678', 0, 'female', 'citizen', 2, 'userFemale.png', '$2y$10$NHNRwm3JYNp1S7/feqfQiOBn9jW0H3MyM7BXdP2bMGxKfLSJSBzzq'),
('olamide', 'wole.olamide@strathmore.edu', 0, '0789564321', 0, 'male', 'citizen', 6, 'user.png', '$2y$10$vGfkZEPVZozDmG8mjartVuSh9nRtPB.VjbnTXWSIrwpLuQ/Kb1WKO'),
('smurfet', 'njoroge.esther@strathmore.edu', 1, '0743215786', 0, 'female', 'citizen', 10, 'userFemale.png', '$2y$10$.C/PtzLkHz9MIbaJ03LI2O/va787JAJlepru1DF5b32S2e.84UbN.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commentor` varchar(255) NOT NULL,
  `referring` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '-1',
  `type` int(11) NOT NULL DEFAULT '-1',
  `reply` int(11) NOT NULL DEFAULT '0',
  `replyID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `comment`, `commentor`, `referring`, `time`, `state`, `type`, `reply`, `replyID`) VALUES
(1, 'joho is the best governor of county 001', 'ericko', 'joho', '2018-09-30 16:14:07', 1, 1, 0, 0),
(2, 'Kiraitu ni Muongo sana. Hakuna kitu ametufanyia.', 'fahm_de', 'kiraitu', '2018-09-30 16:14:07', 0, 0, 0, 0),
(3, 'Mutua was last seen fighting for water for kitui residents. Big up yourself', 'smurfet', 'mutua', '2018-09-30 16:18:21', 1, 1, 0, 0),
(4, 'Sonko has left his citizens.', 'glokym', 'sonko', '2018-09-30 16:18:21', 1, 0, 0, 0),
(5, 'I love my county', 'Mirry', 'Kiraitu', '2018-10-08 11:02:19', -1, 1, 0, 0),
(6, 'Alfred Mutua Should be vetted by the EACC.', 'ericko', 'mutua', '2018-10-08 14:14:01', 1, 0, 0, 0),
(7, 'You issalair.', 'mirry', 'ericko', '2018-10-08 14:45:28', -1, -1, 1, 6),
(8, 'Why Do you say that?', 'ericko', 'mirry', '2018-10-08 14:50:32', -1, -1, 1, 6),
(9, 'Because he is the best governor that doesn\'t steal from the same pot that feeds him. Stop spreading propaganda my friend.', 'mirry', 'ericko', '2018-10-08 14:50:32', -1, -1, 1, 6),
(10, 'Very True', 'smurfet', 'ericko', '2018-10-08 14:50:32', -1, -1, 1, 6),
(11, 'He is the best governor in Kenya as we speak.', 'Mirry', 'sonko', '2018-10-30 04:39:35', 1, 1, 0, 0),
(12, 'Joho can do alot more if he stopped finding fault in everything the government does.', 'Mirry', 'joho', '2018-10-30 04:44:34', -1, -1, 0, 0),
(13, 'Mutua should be more vigilant', 'Mirry', 'mutua', '2018-10-30 07:58:25', -1, -1, 0, 0),
(14, 'Kiraitu amefanyia watu wa buuri kazi mzuri', 'glokym', 'kiraitu', '2018-10-30 08:05:19', 0, -1, 0, 0),
(15, 'Sonko is going to be impeached whether he likes it or not.', 'glokym', 'sonko', '2018-10-30 09:07:30', 0, -1, 0, 0),
(16, 'He is really trying', 'glokym', 'sonko', '2018-10-30 15:15:01', 0, 1, 0, 0),
(17, 'Our lovely governor', 'glokym', 'Kiraitu', '2018-10-30 19:36:27', 1, 1, 0, 0),
(18, 'The best governor in kenya', 'glokym', 'Mutua', '2018-10-30 19:38:18', 1, 1, 0, 0),
(19, 'Where did joho go?', 'glokym', 'Joho', '2018-10-30 19:39:40', 1, 0, 0, 0),
(20, 'nasa tibiiim #nasa', 'glokym', 'joho', '2018-10-30 19:50:36', -1, 1, 0, 0),
(21, 'Joho really fights for the benefits of his citizens.', 'olamide', 'joho', '2018-10-31 17:49:59', -1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `constituencies`
--

CREATE TABLE `constituencies` (
  `constituencyID` int(11) NOT NULL,
  `constituency` varchar(255) DEFAULT NULL,
  `countyNo` int(11) NOT NULL,
  `MP` varchar(255) NOT NULL DEFAULT 'Undefined'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `constituencies`
--

INSERT INTO `constituencies` (`constituencyID`, `constituency`, `countyNo`, `MP`) VALUES
(1, 'Gatundu South', 2, 'Undefined'),
(2, 'Buuri', 5, 'Undefined'),
(3, 'Masinga', 4, 'Undefined'),
(4, 'Kasarani', 3, 'Undefined'),
(5, 'Changamawe', 6, 'Undefined'),
(6, 'Mukurweini', 7, 'Undefined'),
(7, 'Mbati', 1, 'Undefined'),
(8, 'Mwea', 8, 'Undefined'),
(9, 'Bobasi', 9, 'Undefined'),
(10, 'Kandara', 10, 'Undefined');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `replied` int(11) NOT NULL DEFAULT '0',
  `reply` text NOT NULL,
  `faq` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `name`, `email`, `question`, `replied`, `reply`, `faq`, `time`) VALUES
(1, 'dopesky', 'oboke69@gmail.com', 'What is this site all about?', 1, 'This site is a social media site.', 1, '2018-11-05 12:13:17'),
(2, 'ericko', 'ericgburugu@gmail.com', 'Where can i sign up?', 1, 'There is a sign up button at the login form. Please use that to sign up to the site.', 1, '2018-11-05 12:18:40'),
(3, 'brayo', 'kevin.kathendu@strathmore.edu', 'What can i do to be a part of this amazing project?', 0, '', 0, '2018-11-05 13:16:37'),
(4, 'shawn', 'amthatguy3@gmail.com', 'Where can i go to get a face to face with you guys?', 0, '', 0, '2018-11-05 13:17:51'),
(5, 'rozey', 'rosekathendu@gmail.com', 'I think this is a very good idea that has been implemented here. Big up yourselves.', 0, '', 0, '2018-11-05 13:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE `counties` (
  `CountyID` int(11) NOT NULL,
  `County` varchar(255) DEFAULT NULL,
  `Governor` varchar(255) NOT NULL DEFAULT 'Undefined'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`CountyID`, `County`, `Governor`) VALUES
(1, 'Homa Bay', 'Undefined'),
(2, 'Kiambu', 'Undefined'),
(3, 'Nairobi', 'Undefined'),
(4, 'Machakos', 'Undefined'),
(5, 'Meru', 'Undefined'),
(6, 'Mombasa', 'Undefined'),
(7, 'Nyeri', 'Undefined'),
(8, 'Kirinyaga', 'Undefined'),
(9, 'Kisii', 'Undefined'),
(10, 'Murang\'a', 'Undefined');

-- --------------------------------------------------------

--
-- Table structure for table `critiques`
--

CREATE TABLE `critiques` (
  `commentID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commentor` varchar(255) NOT NULL,
  `referring` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '-1',
  `type` int(11) NOT NULL DEFAULT '0',
  `reply` int(11) NOT NULL DEFAULT '0',
  `replyID` int(11) NOT NULL DEFAULT '0',
  `evidence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `critiques`
--

INSERT INTO `critiques` (`commentID`, `comment`, `commentor`, `referring`, `time`, `state`, `type`, `reply`, `replyID`, `evidence`) VALUES
(1, 'Yaani joho got a D??? Dissapointed.', 'ericko', 'joho', '2018-09-30 16:14:07', 1, 0, 0, 0, 'mwananchi/critiques/1/'),
(2, 'This is the only thing waititu has done for his citizens', 'fahm_de', 'waititu', '2018-09-30 16:14:07', 0, 0, 0, 0, 'mwananchi/critiques/2/'),
(3, 'Mutua was last seen fighting for water for kitui residents. Big up yourself', 'smurfet', 'mutua', '2018-09-30 16:18:21', 1, 0, 0, 0, 'mwananchi/critiques/3/'),
(4, 'Sonko is being impeached from his office and he is busy saying yeye si mtu wa vitisho.', 'glokym', 'sonko', '2018-09-30 16:18:21', 1, 0, 0, 0, 'mwananchi/critiques/4/');

-- --------------------------------------------------------

--
-- Table structure for table `deactivated_accounts`
--

CREATE TABLE `deactivated_accounts` (
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emailVerified` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `phoneVerified` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `accountType` varchar(255) NOT NULL,
  `countyNo` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deactivated_education`
--

CREATE TABLE `deactivated_education` (
  `userName` varchar(255) NOT NULL,
  `bachelors` varchar(255) DEFAULT NULL,
  `primarySchool` varchar(255) DEFAULT NULL,
  `secondarySchool` varchar(255) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `masters` varchar(255) DEFAULT NULL,
  `phd` varchar(255) DEFAULT NULL,
  `schoolCertificates` varchar(255) DEFAULT NULL,
  `display` int(11) DEFAULT '0',
  `mastersCourse` varchar(255) DEFAULT NULL,
  `phdCourse` varchar(255) DEFAULT NULL,
  `otherCourses` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deactivated_politics`
--

CREATE TABLE `deactivated_politics` (
  `userName` varchar(255) NOT NULL,
  `FullNames` varchar(255) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `PoliticalSeat` varchar(255) NOT NULL,
  `PoliticalYears` int(11) NOT NULL,
  `CreationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Vying` varchar(255) NOT NULL,
  `ConstituencyNo` int(11) NOT NULL,
  `WardNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emailgetcredentials`
--

CREATE TABLE `emailgetcredentials` (
  `eventID` int(11) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `passCode` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used` int(11) NOT NULL DEFAULT '0',
  `requestor` varchar(255) NOT NULL DEFAULT 'Me'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emailgetcredentials`
--

INSERT INTO `emailgetcredentials` (`eventID`, `userEmail`, `passCode`, `type`, `timestamp`, `used`, `requestor`) VALUES
(1, 'essnj', 'e47W0nXR9SizegLVPTqXMazkTWs', 'password', '2018-09-28 12:44:01', 1, 'dopesky'),
(2, 'essnj', 'bbyJ4MzBrOBkt8bfD', 'password', '2018-09-28 18:35:25', 1, 'dopesky'),
(3, 'essnj', 'HqCM04qG2Clvx6EsAP', 'password', '2018-09-28 18:35:43', 0, 'dopesky'),
(4, 'dopesky', 'SbEx2LKRuGgH4', 'password', '2018-09-28 18:40:22', 1, 'essnj'),
(5, 'dopesky', 'ukbLeRSnPWK4d', 'password', '2018-09-28 18:40:38', 0, 'essnj'),
(6, 'kevin.kathendu@strathmore.edu', 'wiD0TJPhQJlJx', 'password', '2018-10-02 02:51:50', 1, 'Me'),
(7, 'kevin.kathendu@strathmore.edu', 'Pw0LrqMkhLk', 'password', '2018-10-02 02:53:24', 1, 'Me'),
(8, 'oboke69@gmail.com', 'Mn7ZXGYpUMCZL', 'password', '2018-10-02 02:56:29', 1, 'Me'),
(9, 'kevin.kathendu@strathmore.edu', '82OAT5wQiKfBG5', 'password', '2018-10-02 03:09:52', 1, 'Me'),
(10, 'kevin.kathendu@strathmore.edu', 'B6WcjWzp008jWjHzqgJ', 'password', '2018-10-02 03:10:11', 1, 'Me'),
(11, 'oboke69@gmail.com', '97GjaLmQug', 'password', '2018-10-02 04:46:11', 0, 'Me'),
(12, 'kevin.kathendu@strathmore.edu', 'eJIKaKc71teY3m0', 'password', '2018-10-02 04:51:49', 0, 'Me'),
(13, 'ericko', 'MiMTR0J2AnV8S5T4Mo', 'password', '2018-10-02 05:00:57', 1, 'Me'),
(14, 'ericko', '47RBVrcS3Rk', 'password', '2018-10-02 05:12:27', 1, 'Me'),
(15, 'fahm_de', '7ked1kq2cN5YXJ', 'password', '2018-10-02 08:03:34', 1, 'Me'),
(16, 'ericko', 'rJSQxxCWmEsfsrZgkL', 'password', '2018-10-02 08:07:42', 1, 'Me'),
(17, 'fahm_de', '2Z9QBRzaDvA', 'password', '2018-10-02 08:10:41', 1, 'Me'),
(18, 'fahm_de', '4kyFfzZL1eABeC1a37', 'password', '2018-10-02 08:27:30', 1, 'Me'),
(19, 'fahm_de', 'YSBdzARyiNpfF2Rm', 'password', '2018-10-03 10:37:19', 1, 'Me'),
(20, 'ericko', '1NnupEiFYztDm7JYR', 'password', '2018-10-29 07:58:18', 1, 'Me'),
(21, 'glokym', 'ueF0ZrbejciEPZRDOSLv', 'password', '2018-11-04 18:14:01', 1, 'Me'),
(22, 'glokym', 'SQE1z60R49oPjtwMYU', 'password', '2018-11-04 18:14:41', 1, 'Me'),
(23, 'julz', 'lEiTlC9xlxeGUUXg69X', 'password', '2018-11-04 18:21:11', 0, 'Me');

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `functionID` int(11) NOT NULL,
  `Politician` varchar(255) NOT NULL,
  `Roles` varchar(255) NOT NULL,
  `Explanation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`functionID`, `Politician`, `Roles`, `Explanation`) VALUES
(1, 'Governor', 'Head of County Executive Committee.', 'The county governor should appoint the county executive committee as stipulated in article 179(2) (b) of the Constitution with the approval of the County Assembly.\r\n\r\nHe or she should also chair the meetings of the county executive committee. See the structure of the county government to find out more about the membership of the county executive committee.\r\n\r\nThe governor should come up with the portfolio structure for the county executive committee to respond to the functions and competencies that the law assigns and transfers to each county. See the functions of the county governments in Kenya.\r\n\r\nBy a decision notified in the county gazette, the county governor should assign to every member of the county executive committee the responsibility to ensure the performance of any function within the county and the provision of related services to the people.'),
(2, 'Governor', 'Coordination of County Departments.', 'As the head of a county government, the governor, his deputy and cabinet members, who constitute the county executive are responsible for managing county functions in order to deliver services to citizens. The governor therefore coordinates county departments, which are headed by cabinet executive members known as county executive committee members to deliver on county government functions.'),
(3, 'Governor', 'Appointment of County Executive Committee Members.', 'County Executive Committee (CEC) members are the county equivalent of Cabinet Secretaries as we see in the national level. As the head of county government, a governor is responsible for appointing not more than 10 people, with the approval of the County Assembly, to serve as county executive committee members. The governor is also mandated by law to appoint the head of the County Public Service, as well as members of town and municipal management boards or committees.'),
(4, 'Governor', 'Preparation of County Policies, Reports and Plans.', 'Under the leadership of the governor, the county executive prepares county policies and plans. This includes preparing legislations for consideration by the County Assembly that the governor assents upon passage by the assembly. The county executive also prepares the county budget and plans that are tabled at the county assembly for approval. The county executive under the headship of the governor is required to table reports on matters relating to the county at the county assembly on a regular basis.'),
(5, 'Governor', 'Implementation of County Plans and Policies.', 'The governor is responsible for providing leadership in county governance and development. He/she leads CECs and the entire county administration in implementing laws, policies and plans as approved by the county assembly. Implementation of county plans and policies is intended to result in delivery of quality services to citizens.'),
(6, 'Governor', 'Ensuring Competitiveness in the County.', 'The governor is responsible for ensuring competitiveness within a county. He or she should ensure that county resources are managed and utilized in a prudent, efficient manner for the benefit of citizens. The executive arm, led by the governor and his or her deputy is expected facilitate public participation in development of county plans and policies.'),
(7, 'Governor', 'Engaging in Intergovernmental Relations.', 'This has to do with interacting with a network of institutions at national, county and local levels. As such, the governor is a member of the National and County Government Summit which is chaired by the President and is also a member of the Council of Governors. County Governors are also members of the County Governor’s committee which coordinates regional development priorities.'),
(8, 'wrep', 'Representation of the People.', 'Women representatives, as the title suggests play the role of representing women in the national assembly. They advocate for the interests of women in by ensuring that the needs of women and girls as a special interest group are addressed as the National Assembly transacts its business.'),
(9, 'wrep', 'Approval of Budget and Plans.', 'Women representatives are responsible for approving budgets and plans at national level. In participating in debates regarding budgets and plans, women representatives need to ensure that documents approved by the house address the needs of women and girls. Women representatives are allocated a fund known as the Affirmative Action Social Development Fund which is similar to the Constituency Development Fund (CDF). This fund is in line with female gender empowerment and is supposed to assist Women Representatives implement projects in their counties.'),
(10, 'wrep', 'Exercising Oversight.', 'As part of the National Assembly, women representatives exercise oversight over the executive, the national government arm responsible for implementing national laws and plans. They are expected to scrutinize financial, administration and management by public resources at national level and ensure there is accountability and transparency in national expenditure and service delivery. They are also expected to review the conduct of state and public officers at national government.'),
(11, 'wrep', 'Legislation.', 'Women representatives participate in legislative debates in the national assembly and add the voice of women to the debates. The National assembly is responsible for debating and passing bills which upon assent by the President, become county laws. These laws may emanate from the executive, the members themselves or from private members. The law requires that citizens be involved in the process of making national laws.'),
(12, 'mp', 'Making National Laws.', 'The National assembly is responsible for debating and passing bills which upon assent by the President, become county laws. These laws may emanate from the executive, the members themselves or from private members. The law requires that citizens be involved in the process of making national laws.'),
(13, 'mp', 'Exercising Oversight.', 'Members of the National Assembly exercise oversight over the executive, which is the national government arm responsible for implementing national laws and plans. They are expected to scrutinize financial, administration and management by public resources at national level and ensure there is accountability and transparency in national expenditure and service delivery. They are also expected to review the conduct of state and public officers at national government.'),
(14, 'mp', 'Representing the People.', 'Members of the National Assembly represent the people living in their sub-counties in decisions that are made in the national assembly. They are the voice of their constituents in debates that take place in the assembly. As such, they are expected to present the needs or grievances of their constituents in the national assembly so that they can be integrated in laws, budgets or plans that are either passed or approved by the national assembly.'),
(15, 'mp', 'Approval of National Budgets and Plans', 'The National Assembly is mandated by the constitution to review and approve the national budget and plans as well as reports prepared by the national government. Members of the National Assembly are therefore expected to review, debate and approve national budgets and plans including measures that the executive at national proposes to raise revenue.'),
(16, 'senate', 'Revenue Sharing.', 'Arguably, the most important role of the Senate in Kenya is revenue sharing. This is a function that involves both the vertical sharing of revenue and the horizontal sharing of revenue. The vertical sharing of revenue is a joint function between the Senate and the National Assembly.\r\n\r\nOnce every five years, the Senate should determine the basis for sharing the equitable share among the counties (Article 217 of the Constitution). The Senate can amend the revenue sharing formula anytime within the five years.\r\n\r\nThe function of approving the formula is a joint function with the National Assembly. The Senate should seek also the approval of the National Assembly to amend the formula.\r\n\r\nThe Division of Revenue Bill (Article 218:1a) determines the vertical sharing of revenue. The County Allocation of Revenue Bill (Article 218:1b) determines the revenue each county should receive (horizontal sharing).\r\n\r\nThe Senate ensures that the National Assembly does not shortchange counties by denying them enough funds. In doing so, the amount of revenue allocated to the counties has continued to rise every financial year.\r\n\r\nThrough horizontal sharing, the Senate determines the amount of money each county receives from the vertical sharing.'),
(17, 'senate', 'Oversite of County Revenue Expenditure.', 'After the counties spend the equitable share, the Senate has to ensure that the expenditure is prudent. Therefore, it has to keep the county governments accountable to enhance transparency and fiscal discipline.\r\n\r\nIt performs that role by adopting and acting on reports from the Controller of Budget and the Auditor General. These reports relate to county revenue expenditure.\r\n\r\nThe Controller of Budget reports reviews the county expenditure every financial quarter (3 months). They should come out within one month after the end of every quarter.\r\n\r\nThe Auditor General reports are audit reports of the county expenditure that should come out within six months after the end of every financial year (financial year ends in June, so by December).As a result, the Senate issues summons periodically to governors and other county executive officials. They appear before the respective Senate Committees. The purpose of the summons is to provide information or evidence on revenue expenditure based on these reports. (Article 125 of the Kenyan Constitution).\r\n\r\nHowever, the role of the Senate in Kenya in oversight is limited. The Senate only plays oversight over the national revenue allocated to Counties. However, it cannot do so for the other sources of revenue for the counties. That is the role of the County Assembly.'),
(18, 'senate', 'Legislation.', 'The Senate also formulates laws that are crucial to the counties. It should consider, debate and approve bills that concern the counties (Article 110 of the Kenyan Constitution). A “Bill concerning county government” means a Bill–containing provisions affecting the functions and powers of the county governments set out in the Fourth Schedule;\r\nrelating to the election of members of a county assembly or a county executive; and\r\nreferred to in Chapter Twelve affecting the finances of county governments.\r\nA Bill concerning county governments can be a special bill or an ordinary bill.\r\nA Bill is a special Bill to consider under Article 111 of the Kenyan Constitution if it:\r\n- relates to the election of members of a county assembly or a county executive; or\r\n- is the annual County Allocation of Revenue Bill referred to in Article 218.\r\nThe National Assembly may amend or veto a special Bill that originates from the Senate. However, this is only possible by a resolution of at least two-thirds of the members of the Assembly.\r\nIf the resolution fails to pass, the Speaker of the Assembly, within seven days, shall refer the Bill, in the form the Senate adopted, to the President for assent.\r\n\r\nA Bill is an ordinary Bill if the Senate considers it under Article 112 of the Kenyan Constitution. This bill concerning county governments can originate from either the National Assembly or the Senate.\r\n\r\n- If one House passes an ordinary Bill concerning counties, and the second House —\r\n\r\n- rejects the Bill, it shall be referred to a mediation committee appointed under Article 113 of the Kenyan Constitution; or\r\n- passes the Bill in an amended form, it shall be referred back to the originating House for reconsideration.\r\nIf, after the originating House has reconsidered a Bill referred back to it, that House–\r\n\r\n- passes the Bill as amended, the Speaker of that House shall refer the Bill to the President within seven days for assent; or\r\n- rejects the Bill as amended, the Bill shall be referred to a mediation committee under Article 113 of the Kenyan Constitution.\r\nSome of the Bills originating from the Senate include the:\r\n\r\nThe Assumption of Office of the County Governor Bill, 2018;\r\nThe Office of the County Attorney Bill, 2018;\r\nThe Public Participation Bill, 2018; and\r\nThe Petition to County Assemblies (Procedure) Bill, 2018.'),
(19, 'senate', 'Ensuring Integrity of Public Offices.', 'This is the last role of the Senate in Kenya. The Senate determines the integrity of public office by impeaching the President and his deputy. In determining the impeachment of the President and his Deputy, the Senate in Kenya follows:\r\n\r\nArticle 145 of the Constitution; and\r\nStanding Order No. 66 and 67 of the Senate.\r\nIn addition, it determines the removal of Governors from office as part of its oversight role:\r\n\r\nin accordance with Article 181 of the Constitution;\r\nSection 33 of the County Governments Act; and\r\nStanding Order No. 68 of the Senate.\r\nTherefore, in summary, the role of the Senate in Kenya is the representation of the people, legislation, and oversight.');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeID` int(11) NOT NULL,
  `liker` varchar(255) NOT NULL,
  `liked` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeID`, `liker`, `liked`, `time`) VALUES
(2, 'Mirry', 'kiraitu', '2018-10-31 12:10:58'),
(4, 'Mirry', 'mutua', '2018-10-31 12:11:03'),
(5, 'Mirry', 'sonko', '2018-10-31 12:11:11'),
(6, 'Mirry', 'waititu', '2018-10-31 12:11:14'),
(9, 'olamide', 'joho', '2018-10-31 21:39:06'),
(10, 'olamide', 'kiraitu', '2018-11-01 08:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `manifestos`
--

CREATE TABLE `manifestos` (
  `manifestoID` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `manifesto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manifestos`
--

INSERT INTO `manifestos` (`manifestoID`, `owner`, `time`, `manifesto`) VALUES
(1, 'sonko', '2018-11-01 17:01:56', 'https://res.cloudinary.com/dkgtd3pil/image/upload/v1541110297/mwananchi/manifestos/1.pdf'),
(2, 'joho', '2018-11-01 17:01:56', 'https://res.cloudinary.com/dkgtd3pil/image/upload/v1541109259/mwananchi/manifestos/2.pdf'),
(3, 'kiraitu', '2018-11-01 22:23:13', 'https://res.cloudinary.com/dkgtd3pil/image/upload/v1541111103/mwananchi/manifestos/3.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationID` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL DEFAULT 'No Subject',
  `notification` longtext NOT NULL,
  `target` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `isRead` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notificationID`, `subject`, `notification`, `target`, `sender`, `isRead`, `type`) VALUES
(1, 'Admins', 'I am an admin. I do whatever i want.', 'dopesky', 'dopesky', 1, 'Important'),
(2, 'Admins', 'I am an admin. I do whatever i want.', 'essnj', 'dopesky', 0, 'Important'),
(3, 'Admins', 'I am an admin. I do whatever i want.', 'Mirry', 'dopesky', 0, 'Important'),
(4, 'Admins', 'I am an admin. I do whatever i want.', 'ericko', 'dopesky', 0, 'Important'),
(5, 'Admins', 'I am an admin. I do whatever i want.', 'fahm_de', 'dopesky', 0, 'Important'),
(6, 'Admins', 'I am an admin. I do whatever i want.', 'glokym', 'dopesky', 0, 'Important'),
(7, 'Admins', 'I am an admin. I do whatever i want.', 'olamide', 'dopesky', 1, 'Important'),
(8, 'Admins', 'I am an admin. I do whatever i want.', 'julz', 'dopesky', 0, 'Important'),
(9, 'Admins', 'I am an admin. I do whatever i want.', 'mathenge', 'dopesky', 0, 'Important'),
(10, 'Admins', 'I am an admin. I do whatever i want.', 'smurfet', 'dopesky', 0, 'Important'),
(11, 'Admins', 'I am an admin. I do whatever i want.', 'waititu', 'dopesky', 0, 'Important'),
(12, 'Admins', 'I am an admin. I do whatever i want.', 'sonko', 'dopesky', 0, 'Important'),
(13, 'Admins', 'I am an admin. I do whatever i want.', 'mutua', 'dopesky', 0, 'Important'),
(14, 'Admins', 'I am an admin. I do whatever i want.', 'kiraitu', 'dopesky', 0, 'Important'),
(15, 'Admins', 'I am an admin. I do whatever i want.', 'joho', 'dopesky', 0, 'Important'),
(16, 'I am real Admin', 'People care about my work.', 'dopesky', 'dopesky', 1, 'Important'),
(17, 'I am real Admin', 'People care about my work.', 'essnj', 'dopesky', 0, 'Important'),
(18, 'Length Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'dopesky', 'dopesky', 1, 'Important'),
(19, 'Length Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'essnj', 'dopesky', 0, 'Important'),
(20, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'dopesky', 'dopesky', 1, 'Important'),
(21, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'essnj', 'dopesky', 0, 'Important'),
(22, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Mirry', 'dopesky', 0, 'Important'),
(23, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'ericko', 'dopesky', 0, 'Important'),
(24, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'fahm_de', 'dopesky', 0, 'Important'),
(25, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'glokym', 'dopesky', 0, 'Important'),
(26, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'olamide', 'dopesky', 1, 'Important'),
(27, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'julz', 'dopesky', 0, 'Important'),
(28, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'mathenge', 'dopesky', 0, 'Important'),
(29, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'smurfet', 'dopesky', 0, 'Important'),
(30, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'waititu', 'dopesky', 0, 'Important'),
(31, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'sonko', 'dopesky', 0, 'Important'),
(32, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'mutua', 'dopesky', 0, 'Important'),
(33, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'kiraitu', 'dopesky', 0, 'Important'),
(34, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'joho', 'dopesky', 0, 'Important');

-- --------------------------------------------------------

--
-- Table structure for table `opinionpolls`
--

CREATE TABLE `opinionpolls` (
  `pollID` int(11) NOT NULL,
  `poll` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `poller` varchar(255) NOT NULL,
  `potw` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opinionpolls`
--

INSERT INTO `opinionpolls` (`pollID`, `poll`, `type`, `time`, `poller`, `potw`) VALUES
(1, 'What Percentage would you give your area MP?', 'Percentage', '2018-09-26 00:37:57', 'dopesky', 1),
(2, 'How good is the governor of your area?', 'Good/Bad', '2018-09-26 01:21:15', 'dopesky', 0),
(3, 'Would you vote for your current governor in the coming elections?', 'Yes/No', '2018-09-26 01:27:40', 'dopesky', 0),
(4, 'How well do you think the Women Representative is doing to represent women affairs?', 'Good/Bad', '2018-09-26 01:28:29', 'dopesky', 0),
(5, 'Who is the governor of your area?', 'Words', '2018-09-26 01:37:31', 'essnj', 0),
(6, 'What do you think about your current governor?', 'Words', '2018-09-26 01:37:58', 'essnj', 0),
(7, 'Who is the MCA of your ward and which ward is it?', 'Words', '2018-09-26 01:38:37', 'essnj', 0),
(8, 'Would you willingly accept increase in taxes to help repay the China loan?', 'Yes/No', '2018-09-26 01:42:00', 'essnj', 0),
(9, 'What is your opinion on this site?', 'Words', '2018-09-26 01:42:56', 'essnj', 0),
(10, 'Did you participate in the previous elections?', 'Yes/No', '2018-09-26 01:44:23', 'essnj', 0),
(11, 'What is the state of roads in your county?', 'Words', '2018-09-26 17:19:10', 'dopesky', 0),
(12, 'Are you likely to vote in 2022?', 'Likely/Unlikely', '2018-09-27 00:22:52', 'dopesky', 0),
(13, 'How old are you?', 'Words', '2018-10-24 15:53:21', 'dopesky', 1),
(14, 'How is nairobi life?', 'Good/Bad', '2018-10-24 15:55:33', 'sonko', 0),
(15, 'We have an initiative to plant grass in nairobi. What do you think?', 'Words', '2018-10-24 15:57:00', 'sonko', 0),
(16, 'Where was shawn today', 'Words', '2018-10-26 16:05:08', 'dopesky', 0);

-- --------------------------------------------------------

--
-- Table structure for table `political seats`
--

CREATE TABLE `political seats` (
  `COUNTY` text NOT NULL,
  `GOVERNOR` text NOT NULL,
  `SENATOR` text NOT NULL,
  `MP` text NOT NULL,
  `WOMEN REP` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `political seats`
--

INSERT INTO `political seats` (`COUNTY`, `GOVERNOR`, `SENATOR`, `MP`, `WOMEN REP`) VALUES
('Kiambu', 'Ferdinand Waititu\r\n', 'Paul Kimani', 'Moses Kuria', 'Gathoni Wambuchomba'),
('Nairobi', 'Mike Mbuvi Kioko', 'Johnson Sakaja', 'Mercy Gakuya', 'Esther Passaris'),
('Nairobi', 'Mike Mbuvi Kioko', 'Johnson Sakaja', 'Mercy Gakuya', 'Esther Passaris'),
('Machakos', 'Alfred Mutua', 'Boniface Kabak', 'Joshua Mwalyo', 'Joyce Kamene'),
('Meru', 'Kiraitu Murungi', 'Mithika Linturi', 'Mugambi Rindiriki', 'Kawira Mwanjara'),
('Mombasa', 'Hassan Ali Joho', 'Mohamed Faki', 'Omar Shimbwa', 'Asha Mohamed'),
('Nyeri', 'Patrick Gakuru', 'Ephraim Maina', 'Antony Kiai', 'Rahab Wachira'),
('Homa-Bay', 'Cyprian Awiti', 'Moses Ojwang', 'Millie Odhiambo', 'Gladys Wanga'),
('Kirinyaga', 'Ann Waiguru', 'Daniel Karabu', 'Josphat Wachira', 'Purity Ngirici'),
('Kisii', 'James Ongware', 'Sam Ongeri', 'Innocent Obisi', 'Janet Ongera'),
('Muranga', 'Mwangi Wa Iria', 'Irungu Kanguta', 'Alice Wahome', 'Sabina Chege');

-- --------------------------------------------------------

--
-- Table structure for table `politician_education`
--

CREATE TABLE `politician_education` (
  `userName` varchar(255) NOT NULL,
  `bachelors` varchar(255) NOT NULL,
  `primaryGrade` varchar(255) NOT NULL DEFAULT 'B',
  `secondaryGrade` varchar(255) NOT NULL DEFAULT 'B',
  `primarySchool` varchar(255) NOT NULL DEFAULT 'N/A',
  `secondarySchool` varchar(255) NOT NULL DEFAULT 'N/A',
  `university` varchar(255) NOT NULL DEFAULT 'N/A',
  `masters` varchar(255) NOT NULL DEFAULT 'N/A',
  `phd` varchar(255) NOT NULL DEFAULT 'N/A',
  `schoolCertificates` varchar(255) NOT NULL DEFAULT 'N/A',
  `display` int(11) NOT NULL DEFAULT '0',
  `mastersCourse` varchar(255) NOT NULL DEFAULT 'N/A',
  `phdCourse` varchar(255) NOT NULL,
  `otherCourses` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `politician_education`
--

INSERT INTO `politician_education` (`userName`, `bachelors`, `primaryGrade`, `secondaryGrade`, `primarySchool`, `secondarySchool`, `university`, `masters`, `phd`, `schoolCertificates`, `display`, `mastersCourse`, `phdCourse`, `otherCourses`) VALUES
('joho', 'Cooking', 'B', 'B', 'Mombasa Primary School', 'Malindi Secondary School', 'University of Mombasa', 'University of Compton', 'N/A', 'N/A', 0, 'Hotel Management', 'Hotel Management', 'CPA, CPS, DBIT'),
('kiraitu', 'Engineering', 'B', 'B', 'Fred\'s Academy', 'Mang\'u High School', 'University of Nairobi', 'Havard University', 'N/A', 'N/A', 0, 'Software Engineering', 'Networking', 'CPA,CPS, DBIT, Cisco'),
('mutua', 'Engineering', 'B', 'B', 'Machacos Primary School', 'Mang\'u High School', 'University of Nairobi', 'University of Nairobi', 'N/A', 'N/A', 0, 'Mechanical Engineering', 'N/A', 'CPA,CPS'),
('sonko', 'Hospitality', 'B', 'B', 'Nairobi Primany School', 'Nairobi School', 'University of Nairobi', 'Catholic University', 'N/A', 'N/A', 0, 'Hotel and Catering', 'Hotel Management', 'CPA,CPS,CIFA,ACCA'),
('waititu', 'Economics', 'B', 'B', 'Kiambu Primary School', 'Chania Boys', 'USIU', 'USIU', 'N/A', 'N/A', 0, 'Advanced Economics', 'Economics and Statistics', 'CPA,CPS,ACCA,DBIT');

-- --------------------------------------------------------

--
-- Table structure for table `politician_politics`
--

CREATE TABLE `politician_politics` (
  `userName` varchar(255) NOT NULL,
  `FullNames` varchar(255) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `PoliticalSeat` varchar(255) NOT NULL,
  `PoliticalYears` int(11) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Vying` int(11) NOT NULL DEFAULT '0',
  `ConstituencyNo` int(11) NOT NULL,
  `WardNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `politician_politics`
--

INSERT INTO `politician_politics` (`userName`, `FullNames`, `DateOfBirth`, `PoliticalSeat`, `PoliticalYears`, `CreationDate`, `Vying`, `ConstituencyNo`, `WardNo`) VALUES
('joho', 'Hassan Ali Joho', '1980-09-04', 'Governor', 10, '2018-09-09 23:58:11', 0, 5, 14),
('kiraitu', 'Kiraitu Murungi', '1978-01-02', 'Governor', 20, '2018-09-09 23:58:11', 0, 2, 9),
('mutua', 'Alfred Mutua', '1990-08-09', 'Governor', 13, '2018-09-09 23:58:11', 0, 3, 7),
('sonko', 'Mike Mbuvi Sonko', '1988-04-20', 'Governor', 10, '2018-09-09 23:58:11', 0, 4, 4),
('waititu', 'Ferdinand Waititu', '1978-05-07', 'Governor', 20, '2018-09-09 23:58:11', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `politician_profile`
--

CREATE TABLE `politician_profile` (
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `emailVerified` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(255) NOT NULL,
  `phoneVerified` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(255) NOT NULL,
  `accountType` varchar(255) NOT NULL DEFAULT 'politician',
  `countyNo` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `accountVerified` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `politician_profile`
--

INSERT INTO `politician_profile` (`userName`, `email`, `emailVerified`, `phone`, `phoneVerified`, `gender`, `accountType`, `countyNo`, `photo`, `accountVerified`, `password`) VALUES
('joho', 'kevin.kathendu@strathmore.edu', 1, '0701234123', 0, 'male', 'politician', 6, 'user.png', 1, '$2y$10$x6WlpzZ5s4EYBgZ9dvB6fu5HkoTS4qGFe.wgWk.fsU09TtXwVYQ8y'),
('kiraitu', 'kiraitu.murungi@govt.ke', 0, '0755456756', 0, 'male', 'politician', 5, 'user.png', 1, '$2y$10$jsL0AnRqhZBC1.KEK6m.S.gr81ZjqeP.Gcy31ePK9GJXq6cdo8aoO'),
('mutua', 'mutua.alfred@govt.ke', 0, '0712453785', 0, 'male', 'politician', 4, 'user.png', 0, '$2y$10$OTEVEZpswaMMdTkWZLXIf.iS24ffqI6l1DpoX.AZzpdJ9aPAGJU5.'),
('sonko', 'mike.sonko@govt.ke', 0, '0755678432', 0, 'male', 'politician', 3, 'user.png', 0, '$2y$10$Yh/6sFQm4.z61kI3ay8F5Oih6UFZUhHR6avOSfeXoJCNE7Siye5pq'),
('waititu', 'ferd.waititu@govt.ke', 0, '0700456789', 0, 'male', 'politician', 2, 'user.png', 0, '$2y$10$8DIWecGJUO4MZYlcJZsOBe1hR5p7TVid8ixctQGe6t9rXdJ2DshTy');

-- --------------------------------------------------------

--
-- Table structure for table `pollanswers`
--

CREATE TABLE `pollanswers` (
  `answerID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `answerer` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pollanswers`
--

INSERT INTO `pollanswers` (`answerID`, `postID`, `answerer`, `answer`, `time`) VALUES
(1, 8, 'ericko', 'No', '2018-09-26 02:50:03'),
(2, 8, 'mirry', 'No', '2018-09-26 02:52:37'),
(3, 8, 'smurfet', 'No', '2018-09-26 02:53:37'),
(4, 8, 'fahm_de', 'Yes', '2018-09-26 02:54:37'),
(5, 8, 'glokym', 'No', '2018-09-26 02:55:37'),
(6, 8, 'julz', 'No', '2018-09-26 02:56:37'),
(7, 10, 'olamide', 'Yes', '2018-09-26 03:04:15'),
(8, 11, 'ericko', 'The state is unthinkable.', '2018-09-26 17:21:08'),
(9, 11, 'fahm_de', 'The roads are good but we can do better.', '2018-09-26 17:25:03'),
(10, 11, 'smurfet', 'Bad, terrible. Dont even ask.', '2018-09-26 17:25:03'),
(11, 11, 'glokym', 'I live in thika so yeah, its as bad as you think.', '2018-09-26 17:25:03'),
(12, 11, 'olamide', 'We have good roads hapa kwa superhighway.', '2018-09-26 17:25:03'),
(13, 4, 'fahm_de', 'V.Good', '2018-09-26 17:33:47'),
(14, 4, 'olamide', 'Good', '2018-09-26 17:35:32'),
(15, 4, 'julz', 'V.Good', '2018-09-26 17:35:32'),
(16, 4, 'mirry', 'V.Good', '2018-09-26 17:35:32'),
(17, 4, 'glokym', 'Good', '2018-09-26 17:35:32'),
(18, 1, 'glokym', '69', '2018-09-26 17:42:00'),
(19, 13, 'Mirry', '16', '2018-10-26 21:08:29'),
(20, 16, 'Mirry', 'He was in tric', '2018-10-26 21:08:43'),
(21, 15, 'Mirry', 'I think we should concentrate on development and not grass.', '2018-10-26 21:09:10'),
(22, 14, 'Mirry', 'V.Bad', '2018-10-26 21:09:18'),
(23, 12, 'Mirry', 'Likely', '2018-10-26 21:09:23'),
(24, 10, 'Mirry', 'Yes', '2018-10-26 21:09:30'),
(25, 2, 'Mirry', 'Good', '2018-10-26 21:09:46'),
(26, 1, 'Mirry', '75', '2018-10-26 21:09:55'),
(27, 14, 'olamide', 'V.Good', '2018-10-26 21:11:02'),
(28, 12, 'olamide', 'Unlikely', '2018-10-26 21:11:07'),
(29, 8, 'olamide', 'Yes', '2018-10-26 21:11:18'),
(30, 3, 'olamide', 'No', '2018-10-26 21:11:36'),
(31, 1, 'olamide', '100', '2018-10-26 21:11:42'),
(32, 3, 'Mirry', 'Yes', '2018-10-26 21:35:44'),
(33, 11, 'Mirry', 'We have good roads kwa superhighway otherwise its murram road. Someone should do sth about it', '2018-10-26 21:37:53'),
(34, 13, 'mathenge', '21', '2018-10-26 21:46:21'),
(35, 14, 'mathenge', 'Bad', '2018-10-26 22:35:50'),
(36, 2, 'olamide', 'Good', '2018-10-27 19:21:38'),
(37, 13, 'olamide', 'I am 21 years of age', '2018-10-27 19:21:53'),
(38, 1, 'mathenge', '46', '2018-10-27 21:34:42'),
(39, 2, 'mathenge', 'V.Good', '2018-10-27 21:34:48'),
(40, 3, 'mathenge', 'No', '2018-10-27 21:34:53'),
(41, 12, 'mathenge', 'V.Unlikely', '2018-10-27 21:35:43'),
(42, 4, 'mathenge', 'Bad', '2018-10-27 21:37:30'),
(43, 16, 'mathenge', 'He was at tric', '2018-10-27 21:42:58'),
(44, 11, 'mathenge', 'Very Good', '2018-10-27 21:43:09'),
(45, 14, 'glokym', 'V.Good', '2018-10-28 17:29:12'),
(46, 2, 'glokym', 'V.Good', '2018-10-28 17:29:29'),
(47, 3, 'glokym', 'No', '2018-10-28 17:29:37'),
(48, 16, 'glokym', 'He was at siwaka', '2018-10-28 17:30:00'),
(49, 16, 'glokym', 'He was at siwaka', '2018-10-28 17:30:00'),
(50, 13, 'glokym', 'i am 21 years of age', '2018-10-28 17:35:01'),
(51, 1, 'ericko', '90', '2018-10-29 08:04:24'),
(52, 7, 'Mirry', 'I literally have no clue...', '2018-10-29 10:18:33'),
(53, 6, 'Mirry', 'He isnt so bad. If only he spent more time with us', '2018-10-29 10:19:00'),
(54, 5, 'Mirry', 'Kiraitu Murungi - Meru', '2018-10-29 10:19:24'),
(55, 9, 'Mirry', 'This is a really awesome site', '2018-10-29 10:19:40'),
(56, 16, 'olamide', 'He is home in meru', '2018-10-31 21:29:46'),
(57, 7, 'olamide', 'I have no clue', '2018-11-01 08:45:08'),
(58, 6, 'olamide', 'I think he is an amazing guy', '2018-11-01 08:45:20'),
(59, 5, 'olamide', 'Kiraitu Murungi', '2018-11-01 08:45:36'),
(60, 15, 'olamide', 'I think its a good idea. We need to make our city look good.', '2018-11-01 12:39:01'),
(61, 9, 'olamide', 'It is a very good site', '2018-11-01 22:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `wardID` int(11) NOT NULL,
  `Ward` varchar(255) NOT NULL,
  `constituencyID` int(11) NOT NULL,
  `MCA` varchar(255) NOT NULL DEFAULT 'Undefined'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`wardID`, `Ward`, `constituencyID`, `MCA`) VALUES
(1, 'Kiganjo', 1, 'Undefined'),
(2, 'Ndarangu', 1, 'Undefined'),
(3, 'Clay City', 4, 'Undefined'),
(4, 'Mwiki', 4, 'Undefined'),
(5, 'Ruai', 4, 'Undefined'),
(6, 'Ikaatani', 3, 'Undefined'),
(7, 'Kivaa', 3, 'Undefined'),
(8, 'Ndithini', 3, 'Undefined'),
(9, 'Timau', 2, 'Undefined'),
(10, 'Kisima', 2, 'Undefined'),
(11, 'Kiirua', 2, 'Undefined'),
(12, 'Kipevu', 5, 'Undefined'),
(13, 'Mikindani', 5, 'Undefined'),
(14, 'Miritini', 5, 'Undefined'),
(15, 'Gakindu', 6, 'Undefined'),
(16, 'Giathugu', 6, 'Undefined'),
(17, 'Gikondi', 6, 'Undefined'),
(18, 'Kasunga Central', 7, 'Undefined'),
(19, 'Kasunga West', 7, 'Undefined'),
(20, 'Wanyama', 7, 'Undefined'),
(21, 'Kianyaga', 8, 'Undefined'),
(22, 'Kutus South', 8, 'Undefined'),
(23, 'Kangai', 8, 'Undefined'),
(24, 'Nyantira', 9, 'Undefined'),
(25, 'Mosora', 9, 'Undefined'),
(26, 'Sameta', 9, 'Undefined'),
(27, 'Gakui', 10, 'Undefined'),
(28, 'Gathugu', 10, 'Undefined'),
(29, 'Gatundu', 10, 'Undefined');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`adminUserName`);

--
-- Indexes for table `analysisdata`
--
ALTER TABLE `analysisdata`
  ADD PRIMARY KEY (`analysisID`);

--
-- Indexes for table `citizen_profile`
--
ALTER TABLE `citizen_profile`
  ADD PRIMARY KEY (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Phone Number` (`phone`),
  ADD KEY `FK_County` (`County`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `constituencies`
--
ALTER TABLE `constituencies`
  ADD PRIMARY KEY (`constituencyID`),
  ADD KEY `FK` (`countyNo`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `counties`
--
ALTER TABLE `counties`
  ADD PRIMARY KEY (`CountyID`);

--
-- Indexes for table `critiques`
--
ALTER TABLE `critiques`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `deactivated_accounts`
--
ALTER TABLE `deactivated_accounts`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `deactivated_education`
--
ALTER TABLE `deactivated_education`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `deactivated_politics`
--
ALTER TABLE `deactivated_politics`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `emailgetcredentials`
--
ALTER TABLE `emailgetcredentials`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`functionID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `manifestos`
--
ALTER TABLE `manifestos`
  ADD PRIMARY KEY (`manifestoID`),
  ADD UNIQUE KEY `owner` (`owner`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `fk_noti` (`sender`);

--
-- Indexes for table `opinionpolls`
--
ALTER TABLE `opinionpolls`
  ADD PRIMARY KEY (`pollID`);

--
-- Indexes for table `politician_education`
--
ALTER TABLE `politician_education`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `politician_politics`
--
ALTER TABLE `politician_politics`
  ADD PRIMARY KEY (`userName`),
  ADD KEY `fk_cons` (`ConstituencyNo`),
  ADD KEY `fk_wardss` (`WardNo`);

--
-- Indexes for table `politician_profile`
--
ALTER TABLE `politician_profile`
  ADD PRIMARY KEY (`userName`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `fk_politician` (`countyNo`);

--
-- Indexes for table `pollanswers`
--
ALTER TABLE `pollanswers`
  ADD PRIMARY KEY (`answerID`),
  ADD KEY `fk_polls` (`postID`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`wardID`),
  ADD KEY `FK_Ward` (`constituencyID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citizen_profile`
--
ALTER TABLE `citizen_profile`
  ADD CONSTRAINT `FK_County` FOREIGN KEY (`County`) REFERENCES `counties` (`CountyID`);

--
-- Constraints for table `constituencies`
--
ALTER TABLE `constituencies`
  ADD CONSTRAINT `FK` FOREIGN KEY (`countyNo`) REFERENCES `counties` (`CountyID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_noti` FOREIGN KEY (`sender`) REFERENCES `admin_profile` (`adminUserName`);

--
-- Constraints for table `politician_education`
--
ALTER TABLE `politician_education`
  ADD CONSTRAINT `fk_education` FOREIGN KEY (`userName`) REFERENCES `politician_profile` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `politician_politics`
--
ALTER TABLE `politician_politics`
  ADD CONSTRAINT `fk_cons` FOREIGN KEY (`ConstituencyNo`) REFERENCES `constituencies` (`constituencyID`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userName`) REFERENCES `politician_profile` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wardss` FOREIGN KEY (`WardNo`) REFERENCES `wards` (`wardID`);

--
-- Constraints for table `politician_profile`
--
ALTER TABLE `politician_profile`
  ADD CONSTRAINT `fk_politician` FOREIGN KEY (`countyNo`) REFERENCES `counties` (`CountyID`);

--
-- Constraints for table `pollanswers`
--
ALTER TABLE `pollanswers`
  ADD CONSTRAINT `fk_polls` FOREIGN KEY (`postID`) REFERENCES `opinionpolls` (`pollID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `FK_Ward` FOREIGN KEY (`constituencyID`) REFERENCES `constituencies` (`constituencyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
