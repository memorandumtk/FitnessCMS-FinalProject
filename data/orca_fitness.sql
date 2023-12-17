-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 07:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orca_fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructor_member_tb`
--

CREATE TABLE `instructor_member_tb` (
  `imid` mediumint(9) NOT NULL COMMENT 'Primary key of this table',
  `iid` mediumint(9) NOT NULL COMMENT 'ID of instructor',
  `mid` mediumint(9) DEFAULT NULL COMMENT 'ID of member',
  `requested_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'Date requested'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Relation of instructors and members';

-- --------------------------------------------------------

--
-- Table structure for table `instructor_tb`
--

CREATE TABLE `instructor_tb` (
  `iid` mediumint(9) NOT NULL COMMENT 'Instructor''s id',
  `fname` varchar(50) NOT NULL COMMENT 'First name',
  `lname` varchar(50) NOT NULL COMMENT 'Last name',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `pass` varchar(100) NOT NULL COMMENT 'Pass',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Phone number',
  `gender` varchar(50) DEFAULT NULL COMMENT 'Gender',
  `age` mediumint(11) DEFAULT NULL COMMENT 'Age',
  `requests` varchar(50) DEFAULT NULL COMMENT 'Requests from members',
  `members` varchar(50) DEFAULT NULL COMMENT 'Members'' ID each instructor has '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor_tb`
--

INSERT INTO `instructor_tb` (`iid`, `fname`, `lname`, `email`, `pass`, `phone`, `gender`, `age`, `requests`, `members`) VALUES
(1, 'Arnold', 'Schwarzenegger', 'arnold@example.com', 'arnold', '9876561234', 'male', 76, NULL, NULL),
(2, 'Dummy', 'Instructor', 'dummy@example.com', 'dummy', '5673297564', 'fmale', 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_tb`
--

CREATE TABLE `member_tb` (
  `mid` mediumint(9) NOT NULL COMMENT 'Member''s id',
  `fname` varchar(50) NOT NULL COMMENT 'First name',
  `lname` varchar(50) NOT NULL COMMENT 'Last name',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `pass` varchar(100) NOT NULL COMMENT 'Password',
  `phone` varchar(50) DEFAULT NULL COMMENT 'Phone number',
  `gender` varchar(50) DEFAULT NULL COMMENT 'Gender',
  `joined` date DEFAULT NULL COMMENT 'Joined date',
  `status` varchar(50) DEFAULT NULL COMMENT 'Status of workout request',
  `level` varchar(50) DEFAULT NULL COMMENT 'Difficulty level',
  `goal` varchar(50) DEFAULT NULL COMMENT 'Members'' own goal',
  `days` mediumint(11) DEFAULT NULL COMMENT 'Available days per week',
  `note` text DEFAULT NULL COMMENT 'Members'' note',
  `ifname` varchar(50) DEFAULT NULL COMMENT 'First name of instructor',
  `age` mediumint(9) DEFAULT NULL COMMENT 'Age of member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_tb`
--

INSERT INTO `member_tb` (`mid`, `fname`, `lname`, `email`, `pass`, `phone`, `gender`, `joined`, `status`, `level`, `goal`, `days`, `note`, `ifname`, `age`) VALUES
(1, 'Kosuke', 'Takagi', 'kosuke@example.com', 'kosuke', '1234561234', 'male', '2023-12-14', NULL, 'intermidiate', 'burn fat', 2, 'test3', NULL, 24),
(2, 'test1', 'some1', 'test1@example.com', 'test1', '4567897564', 'female', '2023-12-20', NULL, 'beginner', 'burn fat', 6, 'test2', NULL, 56),
(5, 'test2', 'some2', 'test2@example.com', 'test2', '1234561256', 'male', '2023-12-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workout_member_tb`
--

CREATE TABLE `workout_member_tb` (
  `wmid` mediumint(9) NOT NULL COMMENT 'Primary key of table',
  `wid` mediumint(9) NOT NULL COMMENT 'ID of workout',
  `mid` mediumint(9) NOT NULL COMMENT 'ID of member',
  `assigned_date` date NOT NULL COMMENT 'Date assigned workout'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Relation of workouts and members';

-- --------------------------------------------------------

--
-- Table structure for table `workout_tb`
--

CREATE TABLE `workout_tb` (
  `wid` mediumint(9) NOT NULL COMMENT 'ID of workout',
  `wname` varchar(50) NOT NULL COMMENT 'Name of workout',
  `target` varchar(50) NOT NULL COMMENT 'Muscle target',
  `difficulty` varchar(50) NOT NULL COMMENT 'Option of difficulty',
  `sets` int(11) NOT NULL COMMENT 'Number of sets',
  `reps` int(11) NOT NULL COMMENT 'Number of reps',
  `type` varchar(50) NOT NULL COMMENT 'Type of workout'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workout_tb`
--

INSERT INTO `workout_tb` (`wid`, `wname`, `target`, `difficulty`, `sets`, `reps`, `type`) VALUES
(1, 'Dumbel rows', 'Back', 'Beginner', 2, 10, 'Free weight'),
(2, 'Chest fly', 'Chest', 'Intermidiate', 2, 12, 'Cable'),
(3, 'Shoulder press', 'Shoulders', 'Advanced', 3, 8, 'Arms'),
(4, 'Rope Pulldown', 'Triceps', 'Beginner', 2, 10, 'Arms');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructor_member_tb`
--
ALTER TABLE `instructor_member_tb`
  ADD PRIMARY KEY (`imid`) USING BTREE,
  ADD KEY `fk_mid_i` (`mid`),
  ADD KEY `fk_iid_i` (`iid`);

--
-- Indexes for table `instructor_tb`
--
ALTER TABLE `instructor_tb`
  ADD PRIMARY KEY (`iid`);

--
-- Indexes for table `member_tb`
--
ALTER TABLE `member_tb`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `workout_member_tb`
--
ALTER TABLE `workout_member_tb`
  ADD PRIMARY KEY (`wmid`),
  ADD KEY `fk_mid_w` (`mid`),
  ADD KEY `fk_wid_w` (`wid`);

--
-- Indexes for table `workout_tb`
--
ALTER TABLE `workout_tb`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructor_member_tb`
--
ALTER TABLE `instructor_member_tb`
  MODIFY `imid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of this table';

--
-- AUTO_INCREMENT for table `instructor_tb`
--
ALTER TABLE `instructor_tb`
  MODIFY `iid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'Instructor''s id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member_tb`
--
ALTER TABLE `member_tb`
  MODIFY `mid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'Member''s id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workout_member_tb`
--
ALTER TABLE `workout_member_tb`
  MODIFY `wmid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of table';

--
-- AUTO_INCREMENT for table `workout_tb`
--
ALTER TABLE `workout_tb`
  MODIFY `wid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'ID of workout', AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instructor_member_tb`
--
ALTER TABLE `instructor_member_tb`
  ADD CONSTRAINT `fk_iid_i` FOREIGN KEY (`iid`) REFERENCES `instructor_tb` (`iid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mid_i` FOREIGN KEY (`mid`) REFERENCES `member_tb` (`mid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_member_tb`
--
ALTER TABLE `workout_member_tb`
  ADD CONSTRAINT `fk_mid_w` FOREIGN KEY (`mid`) REFERENCES `member_tb` (`mid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wid_w` FOREIGN KEY (`wid`) REFERENCES `workout_tb` (`wid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
