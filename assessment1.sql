-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 10:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assessment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(5) NOT NULL,
  `worker$id` int(4) NOT NULL,
  `date` varchar(10) NOT NULL,
  `complaint` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `worker$id`, `date`, `complaint`) VALUES
(22, 1, '2021-01-06', 'This is a complaint'),
(23, 1, '2021-06-14', 'This is a complaint, and I have \' and \" in it!'),
(24, 2, '2021-01-30', 'She\'s been really cranky, she said \"you smell\". And I didn\'t smell at all!');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(4) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sex` varchar(25) NOT NULL,
  `age` int(3) NOT NULL,
  `currentlyEmployed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `fname`, `lname`, `sex`, `age`, `currentlyEmployed`) VALUES
(1, 'Bob', 'Viego', 'Male', 21, 0),
(2, 'Jane ', 'Doe', 'Female', 18, 1),
(3, 'hello', 'there', 'Male', 46, 1),
(4, 'blob', 'blurp', 'Male', 88, 1),
(5, 'Jonny', 'Alpha', 'Male', 29, 1),
(15, 'Bobby', 'Jr', 'Female', 22, 1),
(16, 'Isabella', 'Ash', 'Female', 19, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker to complaint` (`worker$id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `worker to complaint` FOREIGN KEY (`worker$id`) REFERENCES `workers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
