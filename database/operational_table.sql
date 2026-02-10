-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 09:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `operational_table`
--

CREATE TABLE `operational_table` (
  `ProblemID` int(11) NOT NULL,
  `Block` varchar(100) NOT NULL,
  `Room` varchar(100) NOT NULL,
  `Assets` varchar(100) NOT NULL,
  `Issue` varchar(1000) NOT NULL,
  `Sender_email` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operational_table`
--

INSERT INTO `operational_table` (`ProblemID`, `Block`, `Room`, `Assets`, `Issue`, `Sender_email`, `Status`, `Date`) VALUES
(1, 'B', '201', 'Projector-assets', 'hdmi', 'kit23i.yns@ismt.edu.np', 'Completed', '2024-07-25 05:53:28'),
(2, 'A', '101', 'Chair-assets', 'broken chairs', 'kit23i.yns@ismt.edu.np', 'pending', '2024-07-24 13:43:24'),
(3, 'A', '101', 'Lights', 'bulb fuse', 'kit23i.yns@ismt.edu.np', 'completed', '2024-07-25 04:41:17'),
(4, 'London-Block', '201', 'Internet', 'The wifi is slow', 'kit23i.yns@ismt.edu.np', 'pending', '2024-07-24 14:53:34'),
(5, 'A', '201', 'Air-conditioner', 'The AC is not working.', 'kit23i.yns@ismt.edu.np', 'pending', '2024-07-24 16:33:41'),
(6, 'London-Block', '101', 'Internet', 'The wifi speed is very slow.', 'kit23i.yns@ismt.edu.np', 'pending', '2024-07-25 03:40:41'),
(7, 'C', '101', 'White-board-assets', 'It is not working', 'kit23i.yns@ismt.edu.np', 'completed', '2024-07-25 04:40:39'),
(8, 'C', '301', 'Projector-screen', 'The projector screen of our class has torn', 'kit23i.yns@ismt.edu.np', 'Completed', '2024-07-25 07:19:49'),
(9, 'C', '401', 'Air-conditioner', 'The AC remote is broken', 'prasutamu94@gmail.com', 'Completed', '2024-07-25 07:17:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `operational_table`
--
ALTER TABLE `operational_table`
  ADD PRIMARY KEY (`ProblemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `operational_table`
--
ALTER TABLE `operational_table`
  MODIFY `ProblemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
