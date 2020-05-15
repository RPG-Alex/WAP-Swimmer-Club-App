-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 16, 2020 at 01:06 AM
-- Server version: 8.0.20-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swim`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `fid` int NOT NULL,
  `parentID` int NOT NULL,
  `childID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userID` int NOT NULL,
  `hash` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userID`, `hash`, `username`) VALUES
(1, '$2y$10$PEpDMFtGX1zC9gw/otti5O5P24IMIvsbEe1En5pX2isHfGUKW8lSq', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

CREATE TABLE `practice` (
  `praID` int NOT NULL,
  `date` date DEFAULT NULL,
  `location` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE `race` (
  `raceID` int NOT NULL,
  `date` datetime DEFAULT NULL,
  `raceName` varchar(250) DEFAULT NULL,
  `location` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raceLocations`
--

CREATE TABLE `raceLocations` (
  `locID` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `swimmersOnPractice`
--

CREATE TABLE `swimmersOnPractice` (
  `sopID` int NOT NULL,
  `practiceID` int NOT NULL,
  `swimmerID` int NOT NULL,
  `lap1` varchar(20) DEFAULT NULL,
  `lap2` varchar(20) DEFAULT NULL,
  `lap3` varchar(20) DEFAULT NULL,
  `lap4` varchar(20) DEFAULT NULL,
  `lap5` varchar(20) DEFAULT NULL,
  `lap6` varchar(20) DEFAULT NULL,
  `lap7` varchar(20) DEFAULT NULL,
  `lap8` varchar(20) DEFAULT NULL,
  `lap9` varchar(20) DEFAULT NULL,
  `lap10` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `swimmersOnRace`
--

CREATE TABLE `swimmersOnRace` (
  `sorID` int NOT NULL,
  `swimID` int DEFAULT NULL,
  `raceID` int DEFAULT NULL,
  `lap1` varchar(20) DEFAULT NULL,
  `lap2` varchar(20) DEFAULT NULL,
  `lap3` varchar(20) DEFAULT NULL,
  `lap4` varchar(20) DEFAULT NULL,
  `lap5` varchar(20) DEFAULT NULL,
  `lap6` varchar(20) DEFAULT NULL,
  `lap7` varchar(20) DEFAULT NULL,
  `lap8` varchar(20) DEFAULT NULL,
  `lap9` varchar(20) DEFAULT NULL,
  `lap10` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int NOT NULL,
  `DOB` date DEFAULT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `sname` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `post` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `userTYPE` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `DOB`, `fname`, `sname`, `address`, `post`, `email`, `phone`, `userTYPE`) VALUES
(1, '1989-04-19', 'generic', 'man', 'some address', 'postit', 'myemailisawesome@email.com', '8675309', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `usID` int NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`usID`, `usertype`) VALUES
(1, 'admin'),
(2, 'coach'),
(3, 'parent'),
(4, 'swimmer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`fid`),
  ADD KEY `parentID` (`parentID`),
  ADD KEY `childID` (`childID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`praID`),
  ADD KEY `location` (`location`);

--
-- Indexes for table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`raceID`),
  ADD KEY `location` (`location`);

--
-- Indexes for table `raceLocations`
--
ALTER TABLE `raceLocations`
  ADD PRIMARY KEY (`locID`);

--
-- Indexes for table `swimmersOnPractice`
--
ALTER TABLE `swimmersOnPractice`
  ADD PRIMARY KEY (`sopID`),
  ADD KEY `practiceID` (`practiceID`),
  ADD KEY `swimmerID` (`swimmerID`);

--
-- Indexes for table `swimmersOnRace`
--
ALTER TABLE `swimmersOnRace`
  ADD PRIMARY KEY (`sorID`),
  ADD KEY `swimID` (`swimID`),
  ADD KEY `raceID` (`raceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`usID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `fid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `practice`
--
ALTER TABLE `practice`
  MODIFY `praID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `raceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `raceLocations`
--
ALTER TABLE `raceLocations`
  MODIFY `locID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `swimmersOnPractice`
--
ALTER TABLE `swimmersOnPractice`
  MODIFY `sopID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `swimmersOnRace`
--
ALTER TABLE `swimmersOnRace`
  MODIFY `sorID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `usID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `family_ibfk_1` FOREIGN KEY (`parentID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `family_ibfk_2` FOREIGN KEY (`childID`) REFERENCES `users` (`uid`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`uid`);

--
-- Constraints for table `practice`
--
ALTER TABLE `practice`
  ADD CONSTRAINT `practice_ibfk_1` FOREIGN KEY (`location`) REFERENCES `raceLocations` (`locID`);

--
-- Constraints for table `race`
--
ALTER TABLE `race`
  ADD CONSTRAINT `race_ibfk_1` FOREIGN KEY (`location`) REFERENCES `raceLocations` (`locID`);

--
-- Constraints for table `swimmersOnPractice`
--
ALTER TABLE `swimmersOnPractice`
  ADD CONSTRAINT `swimmersOnPractice_ibfk_1` FOREIGN KEY (`practiceID`) REFERENCES `practice` (`praID`),
  ADD CONSTRAINT `swimmersOnPractice_ibfk_2` FOREIGN KEY (`swimmerID`) REFERENCES `users` (`uid`);

--
-- Constraints for table `swimmersOnRace`
--
ALTER TABLE `swimmersOnRace`
  ADD CONSTRAINT `swimmersOnRace_ibfk_1` FOREIGN KEY (`swimID`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `swimmersOnRace_ibfk_2` FOREIGN KEY (`raceID`) REFERENCES `race` (`raceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
