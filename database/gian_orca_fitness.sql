-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 19, 2023 at 11:46 PM
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
(1, 'Arnold', 'Schwarzenegger', 'arnold@mail.com', 'arnold', '9876561234', 'Male', 35, NULL, NULL),
(2, 'Ronnie', 'Coleman', 'ronnie@mail.com', 'ronnie', '5673297564', 'Male', 33, NULL, NULL),
(3, 'Lauren', 'Taylor', 'lauren@mail.com', 'lauren', '7256389245', 'Female', 27, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `programs_tb`
--

CREATE TABLE `programs_tb` (
  `pid` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  `mfname` varchar(50) NOT NULL,
  `iid` int(10) NOT NULL,
  `ifname` varchar(50) NOT NULL,
  `wids` varchar(100) NOT NULL,
  `inotes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs_tb`
--

INSERT INTO `programs_tb` (`pid`, `mid`, `mfname`, `iid`, `ifname`, `wids`, `inotes`) VALUES
(1000, 12345, 'Gianluca', 1, 'Arnold', '108,109,110,111,112,113', '');

-- --------------------------------------------------------

--
-- Table structure for table `requests_tb`
--

CREATE TABLE `requests_tb` (
  `reqid` int(20) NOT NULL,
  `memid` int(11) NOT NULL,
  `memfname` varchar(50) NOT NULL,
  `memlname` varchar(50) NOT NULL,
  `dlevel` varchar(50) NOT NULL,
  `dpw` int(5) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `goal` varchar(50) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests_tb`
--

INSERT INTO `requests_tb` (`reqid`, `memid`, `memfname`, `memlname`, `dlevel`, `dpw`, `instructor`, `goal`, `notes`) VALUES
(4, 12346, 'Test Fname', 'Test Lname', 'Intermediate', 4, 'Ronnie', 'Burn fat', 'I want a good leg workout.'),
(5, 12347, 'Test Fname 2', 'Test Lname 2', 'Beginner', 2, 'Arnold', 'Gain strength', 'I want to be very strong!');

-- --------------------------------------------------------

--
-- Table structure for table `workouts_tb`
--

CREATE TABLE `workouts_tb` (
  `wid` int(10) NOT NULL,
  `wname` varchar(50) NOT NULL,
  `mtarget` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `diff` varchar(20) NOT NULL,
  `sets` int(10) NOT NULL,
  `reps` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workouts_tb`
--

INSERT INTO `workouts_tb` (`wid`, `wname`, `mtarget`, `type`, `diff`, `sets`, `reps`) VALUES
(101, 'Dumbell Rows', 'Back', 'Free weight', 'Intermediate', 2, 12),
(102, 'Chest Fly', 'Chest', 'Cable', 'Intermediate', 2, 10),
(103, 'Shoulder Press', 'Shoulders', 'Machine', 'Easy', 2, 10),
(104, 'Rope Pulldown', 'Triceps', 'Cable', 'Easy', 2, 12),
(105, 'Bicep Curl', 'Biceps', 'Free weight', 'Easy', 2, 12),
(106, 'Leg Press', 'Legs', 'Machine', 'Easy', 2, 10),
(107, 'Sit-Ups', 'Abs', 'Body weight', 'Easy', 3, 15),
(108, 'Push-ups', 'Upper Body', 'Body weight', 'Intermediate', 2, 15),
(109, 'Pull-ups', 'Upper Body', 'Body weight', 'Advanced', 3, 10),
(110, 'Squats', 'Legs', 'Free weight', 'Advanced', 2, 10),
(111, 'Bench Press', 'Chest', 'Free weight', 'Intermediate', 2, 10),
(112, 'Dips', 'Triceps', 'Body weight', 'Advanced', 3, 12),
(113, 'Hip-Thrusts', 'Glutes', 'Free weight', 'Intermediate', 2, 12),
(114, 'Deadlift', 'Lower Body', 'Free weight', 'Intermediate', 2, 10),
(115, 'Lateral Raises', 'Shoulders', 'Free weight', 'Easy', 3, 12),
(116, 'Leg Extensions', 'Legs', 'Machine', 'Easy', 2, 12),
(117, 'Barbell Curls', 'Biceps', 'Free weight', 'Easy', 2, 10);

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
-- Indexes for table `programs_tb`
--
ALTER TABLE `programs_tb`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `requests_tb`
--
ALTER TABLE `requests_tb`
  ADD PRIMARY KEY (`reqid`);

--
-- Indexes for table `workouts_tb`
--
ALTER TABLE `workouts_tb`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructor_tb`
--
ALTER TABLE `instructor_tb`
  MODIFY `iid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'Instructor''s id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member_tb`
--
ALTER TABLE `member_tb`
  MODIFY `mid` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT 'Member''s id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `programs_tb`
--
ALTER TABLE `programs_tb`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `requests_tb`
--
ALTER TABLE `requests_tb`
  MODIFY `reqid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workouts_tb`
--
ALTER TABLE `workouts_tb`
  MODIFY `wid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
