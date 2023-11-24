-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 09:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `userid` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mnumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`userid`, `fname`, `lname`, `password`, `mnumber`, `email`, `filename`, `gender`, `birthday`, `address`, `usertype`) VALUES
(1, 'Domingo James', 'Dy', '123123123', '12312312312', 'jamesdy@gmail.com', 'Profile Pic.jpg', 'Male', '2023-10-31', 'blk 101 lt 18, melody plains subd, muzon, csjdm, bul', 'admin'),
(2, 'Jercy', 'Guevarra', '123123123', '12312312312', 'jercyguevarra@gmail.com', '403685505_344138411555740_1989442184003052509_n.jpg', 'Male', '2023-11-29', 'mark street, estrella homes, gaya-gaya, csjdm, bulacan', 'user'),
(3, 'Mark Dalo', 'Dacullo', '123123123', '12312312312', 'markdacullo@gmail.com', '400149372_882647569707394_1186874067040084144_n.jpg', 'Male', '2023-10-31', 'blk 101 lt 18, melody plains subd, muzon, csjdm, bul', 'staff'),
(4, 'Geofrey', 'Guimbaolibot', '123123123', '12312312312', 'geofreybuimbaolibot@gmail.com', 'geof.jpg', 'Male', '2023-12-05', 'evergreen, gaya-gaya,csjdm,bulacan', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `userid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
