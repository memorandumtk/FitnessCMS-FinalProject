-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 09:46 AM
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
  `menu` mediumint(9) DEFAULT NULL COMMENT 'ID of workout menu',
  `level` varchar(50) DEFAULT NULL COMMENT 'Difficulty level',
  `goal` varchar(50) DEFAULT NULL COMMENT 'Members'' own goal',
  `days` mediumint(11) DEFAULT NULL COMMENT 'Available days per week',
  `note` varchar(100) DEFAULT NULL COMMENT 'Members'' note',
  `iid` mediumint(9) DEFAULT NULL COMMENT 'ID of instructor',
  `age` mediumint(9) DEFAULT NULL COMMENT 'Age of member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_tb`
--

INSERT INTO `member_tb` (`mid`, `fname`, `lname`, `email`, `pass`, `phone`, `gender`, `joined`, `menu`, `level`, `goal`, `days`, `note`, `iid`, `age`) VALUES
(1, 'Kosuke', 'Takagi', 'kosuke@example.com', 'kosuke', '1234561234', 'male', '2023-12-14', NULL, 'intermidiate', 'burn fat', 3, NULL, NULL, 24),
(2, 'test1', 'some1', 'test1@example.com', 'test1', '4567897564', 'female', '2023-12-20', NULL, 'advanced', 'build muscle', 4, NULL, NULL, 56),
(5, 'test2', 'some2', 'test2@example.com', 'test2', '1234561256', 'male', '2023-12-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
