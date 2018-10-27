-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2018 at 10:04 PM
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
  `type` int(11) NOT NULL DEFAULT '-1',
  `reply` int(11) NOT NULL DEFAULT '0',
  `replyID` int(11) NOT NULL DEFAULT '0',
  `evidence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`commentID`, `comment`, `commentor`, `referring`, `time`, `state`, `type`, `reply`, `replyID`, `evidence`) VALUES
(1, 'joho is the best governor of county 001', 'ericko', 'joho', '2018-09-30 16:14:07', 1, 1, 0, 0, 'mwananchi/achievements/1/'),
(2, 'Kiraitu ni Muongo sana. Hakuna kitu ametufanyia.', 'fahm_de', 'kiraitu', '2018-09-30 16:14:07', 0, 0, 0, 0, 'mwananchi/achievements/2/'),
(3, 'Mutua was last seen fighting for water for kitui residents. Big up yourself', 'smurfet', 'mutua', '2018-09-30 16:18:21', 1, 1, 0, 0, 'mwananchi/achievements/3/'),
(4, 'Sonko has left his citizens.', 'glokym', 'sonko', '2018-09-30 16:18:21', 1, 0, 0, 0, 'mwananchi/achievements/4/'),
(5, 'I love my county', 'Mirry', 'Kiraitu', '2018-10-08 11:02:19', -1, 1, 0, 0, 'mwananchi/achievements/5/'),
(6, 'Alfred Mutua Should be vetted by the EACC.', 'ericko', 'mutua', '2018-10-08 14:14:01', -1, -1, 0, 0, 'mwananchi/achievements/6/');

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
(1, 'achievements', 1, '2018-10-23 07:41:35', 1, 'ericko');

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
('ericko', 'kevin.kathendu@strathmore.edu', 1, '0734124567', 0, 'male', 'citizen', 3, 'user.png', '$2y$10$7Xa3hLde.SyDF37LgT0BFue7qkkXKvNY3J9kkvX8deu.G6rgBsxgi'),
('fahm_de', 'oboke69@gmail.com', 1, '0792261344', 0, 'male', 'citizen', 5, 'user.png', '$2y$10$BJcM6nxVr7h7Kj1sWDk6auzBa2Qn99UfVH/J/sR.cpWOM.122mfdC'),
('glokym', 'glorynkatha15@gmail.com', 1, '0792141986', 1, 'female', 'citizen', 5, 'userFemale.png', '$2y$10$WtKI13xJ4XtulgpCUVZkdeHO2arV36nuHVj0aGZsy19DG50axYNrq'),
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
(6, 'Alfred Mutua Should be vetted by the EACC.', 'ericko', 'mutua', '2018-10-08 14:14:01', -1, -1, 0, 0),
(7, 'You issalair.', 'mirry', 'ericko', '2018-10-08 14:45:28', -1, -1, 1, 6),
(8, 'Why Do you say that?', 'ericko', 'mirry', '2018-10-08 14:50:32', -1, -1, 1, 6),
(9, 'Because he is the best governor that doesn\'t steal from the same pot that feeds him. Stop spreading propaganda my friend.', 'mirry', 'ericko', '2018-10-08 14:50:32', -1, -1, 1, 6),
(10, 'Very True', 'smurfet', 'ericko', '2018-10-08 14:50:32', -1, -1, 1, 6);

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
  `type` int(11) NOT NULL DEFAULT '-1',
  `reply` int(11) NOT NULL DEFAULT '0',
  `replyID` int(11) NOT NULL DEFAULT '0',
  `evidence` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `critiques`
--

INSERT INTO `critiques` (`commentID`, `comment`, `commentor`, `referring`, `time`, `state`, `type`, `reply`, `replyID`, `evidence`) VALUES
(1, 'joho is the best governor of county 001', 'ericko', 'joho', '2018-09-30 16:14:07', 1, 1, 0, 0, 'mwananchi/critiques/1/'),
(2, 'Kiraitu ni Muongo sana. Hakuna kitu ametufanyia.', 'fahm_de', 'kiraitu', '2018-09-30 16:14:07', 0, 0, 0, 0, 'mwananchi/critiques/2/'),
(3, 'Mutua was last seen fighting for water for kitui residents. Big up yourself', 'smurfet', 'mutua', '2018-09-30 16:18:21', 1, 1, 0, 0, 'mwananchi/critiques/3/'),
(4, 'Sonko has left his citizens.', 'glokym', 'sonko', '2018-09-30 16:18:21', 1, 0, 0, 0, 'mwananchi/critiques/4/');

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
(19, 'fahm_de', 'YSBdzARyiNpfF2Rm', 'password', '2018-10-03 10:37:19', 1, 'Me');

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `Politician` text NOT NULL,
  `Roles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`Politician`, `Roles`) VALUES
('Member of Parliament', '>MP represents the people of the constituencies and special groups\r\n>MP deliberates on and resolves issues of concern to the people\r\n>MP makes National Laws in parliament\r\n>MP decides on the allocation of national revenue between the levels of Government and other National State organs\r\n>MP reviews the conduct of President, Deputy President and other state officers and may initiate the process of removing them from office\r\n'),
('Member of Parliament', '>MP represents the people of the constituencies and special groups\r\n>MP deliberates on and resolves issues of concern to the people\r\n>MP makes National Laws in parliament\r\n>MP decides on the allocation of national revenue between the levels of Government and other National State organs\r\n>MP reviews the conduct of President, Deputy President and other state officers and may initiate the process of removing them from office\r\n'),
('Governor', '	execute the functions diligently and exercise the authority that the Constitution and the law provides;\r\n	perform State functions within the county that the President may assign from time to time on the basis of mutual consultations;\r\n	represent the county in national and international fora and events;\r\n	appoint, with the approval of the county assembly, the county executive committee in accordance with Article 179(2)(b) of the Constitution;\r\n	come up with the portfolio structure for the county executive committee to respond to the functions and competencies that the law assigns and transfers to each county.\r\n	submit the county plans and policies to the county assembly for approval;\r\n	consider, approve and assent to bills that the county assembly passes;\r\n	chair the meetings of the county executive committee;\r\n	by a decision notified in the county gazette, assign to every member of the county executive committee responsibility to ensure the performance of any function within the county and the provision of related services to the people.\r\n	submit an annual report to the county assembly on the implementation status of the county policies and plans;\r\n	deliver the annual state of the county address containing such matters county laws may specify; and\r\n	sign the notice of all important formal decisions made by the governor or by the county executive committee, and ensure they are published in the county gazette.\r\n'),
('Governor', '	execute the functions diligently and exercise the authority that the Constitution and the law provides;\r\n	perform State functions within the county that the President may assign from time to time on the basis of mutual consultations;\r\n	represent the county in national and international fora and events;\r\n	appoint, with the approval of the county assembly, the county executive committee in accordance with Article 179(2)(b) of the Constitution;\r\n	come up with the portfolio structure for the county executive committee to respond to the functions and competencies that the law assigns and transfers to each county.\r\n	submit the county plans and policies to the county assembly for approval;\r\n	consider, approve and assent to bills that the county assembly passes;\r\n	chair the meetings of the county executive committee;\r\n	by a decision notified in the county gazette, assign to every member of the county executive committee responsibility to ensure the performance of any function within the county and the provision of related services to the people.\r\n	submit an annual report to the county assembly on the implementation status of the county policies and plans;\r\n	deliver the annual state of the county address containing such matters county laws may specify; and\r\n	sign the notice of all important formal decisions made by the governor or by the county executive committee, and ensure they are published in the county gazette.\r\n'),
('MCA', '	MAINTAINING CLOSE CONTACT WITH THE ELECTORATE\r\n	PRESENT VIEWS, OPINIONS, AND PROPOSALS OF THE ELECTORATE TO THE COUNTY ASSEMBLY\r\n	ATTEND SESSIONS OF THE COUNTY ASSEMBLY AND ITS COMMITTEES\r\n	PROVIDE A LINKAGE BETWEEN THE COUNTY ASSEMBLY AND THE ELECTORATE ON PUBLIC SERVICE DELIVERY\r\n	EXTEND PROFESSIONAL KNOWLEDGE, EXPERIENCE OR SPECIALIZED KNOWLEDGE TO ANY ISSUE FOR DISCUSSION IN THE COUNTY ASSEMBLY\r\n'),
('MCA', '	MAINTAINING CLOSE CONTACT WITH THE ELECTORATE\r\n	PRESENT VIEWS, OPINIONS, AND PROPOSALS OF THE ELECTORATE TO THE COUNTY ASSEMBLY\r\n	ATTEND SESSIONS OF THE COUNTY ASSEMBLY AND ITS COMMITTEES\r\n	PROVIDE A LINKAGE BETWEEN THE COUNTY ASSEMBLY AND THE ELECTORATE ON PUBLIC SERVICE DELIVERY\r\n	EXTEND PROFESSIONAL KNOWLEDGE, EXPERIENCE OR SPECIALIZED KNOWLEDGE TO ANY ISSUE FOR DISCUSSION IN THE COUNTY ASSEMBLY\r\n'),
('Senator', '	The Senate represents the counties and serves to protect the interests of the counties and their governments.\r\n	The Senate participates in the law-making function of Parliament by considering, debating and approving Bills concerning counties, as provided in Articles 109 to 113.\r\n	The Senate determines the allocation of national revenue among counties, as provided in Article 217, and exercises oversight over national revenue allocated to the county governments.\r\n	The Senate participates in the oversight of State officers by considering and determining any resolution to remove the President or Deputy President from office in accordance with Article 145.\r\n'),
('Senator', '	The Senate represents the counties and serves to protect the interests of the counties and their governments.\r\n	The Senate participates in the law-making function of Parliament by considering, debating and approving Bills concerning counties, as provided in Articles 109 to 113.\r\n	The Senate determines the allocation of national revenue among counties, as provided in Article 217, and exercises oversight over national revenue allocated to the county governments.\r\n	The Senate participates in the oversight of State officers by considering and determining any resolution to remove the President or Deputy President from office in accordance with Article 145.\r\n'),
('Women Representative', '	Legislation\r\n	Engendering the Budget\r\n	Vetting of appointees\r\n	Protection of the constitution, democratic governance and rule of law\r\n	Bringing decency and human face to the Kenyan politics\r\n'),
('Women Representative', '	Legislation\r\n	Engendering the Budget\r\n	Vetting of appointees\r\n	Protection of the constitution, democratic governance and rule of law\r\n	Bringing decency and human face to the Kenyan politics\r\n');

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
(1, 'Admins', 'I am an admin. I do whatever i want.', 'dopesky', 'dopesky', 0, 'Important'),
(2, 'Admins', 'I am an admin. I do whatever i want.', 'essnj', 'dopesky', 0, 'Important'),
(3, 'Admins', 'I am an admin. I do whatever i want.', 'Mirry', 'dopesky', 0, 'Important'),
(4, 'Admins', 'I am an admin. I do whatever i want.', 'ericko', 'dopesky', 0, 'Important'),
(5, 'Admins', 'I am an admin. I do whatever i want.', 'fahm_de', 'dopesky', 0, 'Important'),
(6, 'Admins', 'I am an admin. I do whatever i want.', 'glokym', 'dopesky', 0, 'Important'),
(7, 'Admins', 'I am an admin. I do whatever i want.', 'olamide', 'dopesky', 0, 'Important'),
(8, 'Admins', 'I am an admin. I do whatever i want.', 'julz', 'dopesky', 0, 'Important'),
(9, 'Admins', 'I am an admin. I do whatever i want.', 'mathenge', 'dopesky', 0, 'Important'),
(10, 'Admins', 'I am an admin. I do whatever i want.', 'smurfet', 'dopesky', 0, 'Important'),
(11, 'Admins', 'I am an admin. I do whatever i want.', 'waititu', 'dopesky', 0, 'Important'),
(12, 'Admins', 'I am an admin. I do whatever i want.', 'sonko', 'dopesky', 0, 'Important'),
(13, 'Admins', 'I am an admin. I do whatever i want.', 'mutua', 'dopesky', 0, 'Important'),
(14, 'Admins', 'I am an admin. I do whatever i want.', 'kiraitu', 'dopesky', 0, 'Important'),
(15, 'Admins', 'I am an admin. I do whatever i want.', 'joho', 'dopesky', 0, 'Important'),
(16, 'I am real Admin', 'People care about my work.', 'dopesky', 'dopesky', 0, 'Important'),
(17, 'I am real Admin', 'People care about my work.', 'essnj', 'dopesky', 0, 'Important'),
(18, 'Length Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'dopesky', 'dopesky', 0, 'Important'),
(19, 'Length Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'essnj', 'dopesky', 0, 'Important'),
(20, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'dopesky', 'dopesky', 0, 'Important'),
(21, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'essnj', 'dopesky', 0, 'Important'),
(22, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Mirry', 'dopesky', 0, 'Important'),
(23, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'ericko', 'dopesky', 0, 'Important'),
(24, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'fahm_de', 'dopesky', 0, 'Important'),
(25, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'glokym', 'dopesky', 0, 'Important'),
(26, 'Height Test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'olamide', 'dopesky', 0, 'Important'),
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
(37, 13, 'olamide', 'I am 21 years of age', '2018-10-27 19:21:53');

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
