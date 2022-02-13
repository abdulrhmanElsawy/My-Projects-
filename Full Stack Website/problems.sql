-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 04:45 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `inputdescription` varchar(500) NOT NULL,
  `outputdescription` varchar(500) NOT NULL,
  `inputexample` varchar(255) NOT NULL,
  `outputexample` varchar(255) NOT NULL,
  `difficulty` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `description`, `inputdescription`, `outputdescription`, `inputexample`, `outputexample`, `difficulty`) VALUES
(1, '                                A bracket sequence is a string containing only characters \"(\" and \")\". A regular bracket sequence is\r\n                    a bracket sequence that can be transformed into a correct arithmetic expression by inserting\r\n                    characters \"1\" and \"+\" between the original characters of the sequence. For example, bracket\r\n                    sequences \"()()\" and \"(())\" are regular (the resulting expressions are: \"(1)+(1)\" and \"((1+1)+1)\"),\r\n                    and \")(\", \"(\" and \")\" are not.\r\n                    You are given an integer n. Your goal is to construct and print exactly n different regular bracket\r\n                    sequences of length 2n.Input                                ', '                                The first line contains one integer t (1≤t≤50) — the number of test cases.\r\n                    Each test case consists of one line containing one integer n (1≤n≤50).                                ', '                                For each test case, print n lines, each containing a regular bracket sequence of length exactly 2n.\r\n                    All bracket sequences you output for a testcase should be different (though they may repeat in\r\n                    different test cases). If there are multiple answers, print any of them. It can be shown that it\'s\r\n                    always possible.                                ', '                                    3\r\n    3\r\n    1\r\n    3                                ', '                                    ()()()\r\n    ((()))\r\n    (()())\r\n    ()\r\n    ((()))\r\n    (())()\r\n    ()(())                                ', 800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
