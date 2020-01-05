-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 01:58 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fullName` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullName`, `email`, `notes`, `date`) VALUES
(1, 'test', 'i2771995@gmail.com', '1', '2016-08-01 12:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `url` varchar(300) NOT NULL,
  `title_ar` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `url`, `title_ar`, `title_en`, `img`) VALUES
(2, 'url', 'الهام', 'inspiration', 'bg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `user_name` varchar(35) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `name` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `mbti` varchar(4) DEFAULT NULL,
  `enneagram` varchar(1) DEFAULT NULL,
  `skills` char(1) DEFAULT NULL,
  `value` char(1) DEFAULT NULL,
  `holland` char(1) DEFAULT NULL,
  `countryid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `lang` char(2) NOT NULL DEFAULT 'en',
  `organisationid` int(1) DEFAULT NULL,
  `organisation` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`name`, `password`, `mail`, `phone`, `mbti`, `enneagram`, `skills`, `value`, `holland`, `countryid`, `id`, `lang`, `organisationid`, `organisation`) VALUES
('ibrahem', '25d55ad283aa400af464c76d713c07ad', 'i2771995@gmail.com', '01093051309', NULL, NULL, NULL, NULL, '1', 0, 1, 'en', 0, 'الفلاح'),
('ahmed12', '25d55ad283aa400af464c76d713c07ad', 'ibrahem_9595@yahoo.com', '01093051309', NULL, NULL, NULL, NULL, NULL, 0, 2, 'en', 0, 'مدرسه الفلاح'),
('ibrahem1', '25f9e794323b453885f5181f1b624d0b', 'i2771995@gmail.com1', '12345678910', NULL, NULL, NULL, NULL, NULL, 0, 3, 'en', 0, 'test'),
('ibrahim11', '25f9e794323b453885f5181f1b624d0b', 'ibrahem_9595@yahoo.com1', '01093051309', NULL, NULL, NULL, NULL, NULL, 0, 4, 'en', 0, 'test'),
('ibrahim', '25f9e794323b453885f5181f1b624d0b', 'ibrahem_9595@yahoo.com11', '01093051309', NULL, NULL, NULL, NULL, NULL, 0, 5, 'en', 0, 'test'),
('ibrahim1', '25f9e794323b453885f5181f1b624d0b', 'i2771995@gmail.com111', '01093051309', NULL, NULL, NULL, NULL, NULL, 0, 6, 'en', 1, 'ss');

-- --------------------------------------------------------

--
-- Table structure for table `userresults`
--

CREATE TABLE `userresults` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `mbti` varchar(5) DEFAULT NULL,
  `enneagram` char(1) DEFAULT NULL,
  `skills` longtext,
  `value` mediumtext,
  `holland` longtext,
  `lang` char(2) DEFAULT 'en',
  `reserved` tinyint(1) NOT NULL,
  `seen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userresults`
--

INSERT INTO `userresults` (`id`, `name`, `mbti`, `enneagram`, `skills`, `value`, `holland`, `lang`, `reserved`, `seen`) VALUES
(1, 'ibrahem', NULL, NULL, NULL, NULL, '["ACS","ACR","ACI","ACE","AES","AER","AEI","AEC","AIS","AIR","AIE","AIC","ARS","ARI","ARE","ARC","ASR","ASI","ASE","ASC","CAS","CAR","CAI","CAE","CES","CER","CEI","CEA","CIS","CIR","CIE","CIA","CRS","CRI","CRE","CRA","CSR","CSI","CSE","CSA","EAS","EAR","EAI","EAC","ECS","ECR","ECI","ECA","EIS","EIR","EIC","EIA","ERS","ERI","ERC","ERA","ESR","ESI","ESC","ESA","IAS","IAR","IAE","IAC","ICS","ICR","ICE","ICA","IES","IER","IEC","IEA","IRS","IRE","IRC","IRA","ISR","ISE","ISC","ISA","RAS","RAI","RAE","RAC","RCS","RCI","RCE","RCA","RES","REI","REC","REA","RIS","RIE","RIC","RIA","RSI","RSE","RSC","RSA","SAR","SAI","SAE","SAC","SCR","SCI","SCE","SCA","SER","SEI","SEC","SEA","SIR","SIE","SIC","SIA","SRI","SRE","SRC","SRA"]', 'en', 0, 0),
(2, 'ahmed12', NULL, NULL, NULL, NULL, NULL, 'en', 0, 0),
(3, 'ibrahem1', NULL, NULL, NULL, NULL, NULL, 'en', 0, 0),
(4, 'ibrahim11', NULL, NULL, NULL, NULL, NULL, 'en', 0, 0),
(5, 'ibrahim', NULL, NULL, NULL, NULL, NULL, 'en', 0, 0),
(6, 'ibrahim1', NULL, NULL, NULL, NULL, NULL, 'en', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userresults`
--
ALTER TABLE `userresults`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `userresults`
--
ALTER TABLE `userresults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
