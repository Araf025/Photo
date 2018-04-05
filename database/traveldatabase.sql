-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 06:22 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveldatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagetable`
--

CREATE TABLE `imagetable` (
  `ID` int(5) NOT NULL,
  `UserID` int(5) NOT NULL,
  `ImagePath` varchar(160) NOT NULL,
  `ImageLocation` varchar(160) NOT NULL,
  `Tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagetable`
--

INSERT INTO `imagetable` (`ID`, `UserID`, `ImagePath`, `ImageLocation`, `Tag`) VALUES
(8, 1, 'images/London4999.jpeg', 'London', 'sea'),
(9, 1, 'images/Noakhali110.jpeg', 'Noakhali', 'Tree'),
(10, 3, 'images/Jaka2702.jpeg', 'Jaka', 'Naka'),
(11, 3, 'images/Paka4930.jpeg', 'Paka', 'Pepe');

-- --------------------------------------------------------

--
-- Table structure for table `userinfotable`
--

CREATE TABLE `userinfotable` (
  `userID` int(20) NOT NULL,
  `FullName` varchar(25) NOT NULL,
  `EmailAddress` varchar(25) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `ProfilePic` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfotable`
--

INSERT INTO `userinfotable` (`userID`, `FullName`, `EmailAddress`, `Username`, `Password`, `ProfilePic`) VALUES
(1, 'RaSeL', 'rasel.00x@gmail.com', 'rsl', 'rasel', 'images/1822.jpeg'),
(3, 'Tony Stark', 'tron@gmail.com', 'iron', 'man', 'images/6848.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagetable`
--
ALTER TABLE `imagetable`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userinfotable`
--
ALTER TABLE `userinfotable`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagetable`
--
ALTER TABLE `imagetable`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `userinfotable`
--
ALTER TABLE `userinfotable`
  MODIFY `userID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
