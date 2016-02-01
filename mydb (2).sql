-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2015 at 12:35 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE IF NOT EXISTS `dates` (
`id` int(10) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `date`) VALUES
(1, '2015-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `donationdonor`
--

CREATE TABLE IF NOT EXISTS `donationdonor` (
`id` int(10) NOT NULL,
  `donationID` int(10) NOT NULL,
  `donorID` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `donationdonor`
--

INSERT INTO `donationdonor` (`id`, `donationID`, `donorID`) VALUES
(1, 1, 54);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(10) NOT NULL,
  `header` varchar(400) NOT NULL,
  `body` varchar(4000) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `header`, `body`, `date`) VALUES
(4, '&lt;script&gt;alert(&quot;test&quot;)&lt;/script&gt;', '&lt;script&gt;alert(&quot;test&quot;)&lt;/script&gt;', '15/01/2015 13:40'),
(5, ';&gt;&lt;ScRiPt&gt;alErT(String.FromCharCode(77, 97, 108, 97, 107, 97, 115))&lt;/sCrIpT&gt;', ';&gt;&lt;ScRiPt&gt;alErT(String.FromCharCode(77, 97, 108, 97, 107, 97, 115))&lt;/sCrIpT&gt;', '15/01/2015 13:41');

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE IF NOT EXISTS `recipient` (
`id` int(20) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `hospital` varchar(30) NOT NULL,
  `hospitalCity` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL,
  `flasks` int(30) NOT NULL,
  `donorID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
`id` int(30) NOT NULL,
  `title` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(4000) COLLATE utf8_unicode_ci NOT NULL,
  `userID` int(30) NOT NULL,
  `answered` int(11) NOT NULL DEFAULT '0',
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `readMSG` int(30) NOT NULL DEFAULT '0',
  `forID` int(30) NOT NULL,
  `forUser` int(30) NOT NULL,
  `root` int(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `usertype` int(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `flasks` int(11) NOT NULL,
  `sent` int(11) NOT NULL DEFAULT '0',
  `email` mediumtext NOT NULL,
  `fatherName` varchar(30) NOT NULL,
  `birthDate` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `bloodType` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `TK` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usertype`, `username`, `password`, `firstName`, `lastName`, `flasks`, `sent`, `email`, `fatherName`, `birthDate`, `gender`, `bloodType`, `phone`, `mobile`, `city`, `address`, `TK`) VALUES
(51, 1, 'stef', '93de224944e20bc5c65dc3e2d1a62497', 'Stefanoss', 'Petrakis', 0, 0, '', '', '', 'Άνδρας', 'O+', '', '', '', '', ''),
(52, 2, 'asdas', '', 'sd', '', 0, 0, '', '', '', 'Άνδρας', 'O+', '', '<script>alert("k");</script>', '', '', 'dsf'),
(53, 2, 'stee', '', 'undefined', 'undefined', 0, 0, 'undefined', 'undefined', 'undefined', 'Άνδρας', 'O+', 'undefined', 'undefined', 'undefined', 'undefined', 'undefined'),
(54, 2, 'dddd', '', 'Στέφανος', 'Πετράκης  Πυρετζίδης', 1, 0, '<script>asdf</script>', '', '//', 'Άνδρας', 'O+', '', 'sdd', '', '', ''),
(55, 2, 'asdf', '6a204bd89f3c8348afd5c77c717a097a', 'asdf', 'asdf', 0, 0, '&lt;script&gt;', '', '//', 'Άνδρας', 'O+', '', '', '', '', ''),
(56, 2, 'sdwe', '9fd69e227281ac34ff1fc7bed73ba89b', 'e', 'r', 0, 0, '', '', '//', 'Άνδρας', 'O+', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donationdonor`
--
ALTER TABLE `donationdonor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `donationdonor`
--
ALTER TABLE `donationdonor`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
