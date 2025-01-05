-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 06:18 PM
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
-- Database: `railsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_support`
--

CREATE TABLE `customer_support` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `issue` text NOT NULL,
  `contact_details` varchar(255) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_support`
--

INSERT INTO `customer_support` (`id`, `customer_id`, `customer_name`, `issue`, `contact_details`, `submitted_at`) VALUES
(1, '013', 'Najmi', 'slow', '0139547856', '2025-01-04 16:34:04'),
(2, '013', 'Najmi', 'slow', '0139547856', '2025-01-04 16:38:29'),
(3, '013', 'mi', 'too slow', '514879643', '2025-01-04 16:40:59'),
(4, '014', 'Mus', 'No seats', '6531458', '2025-01-04 16:50:47'),
(5, '014', 'Mus', 'No seats', '6531458', '2025-01-04 16:53:26'),
(6, '031004010225', 'Najmi', 'lost', '0137750225', '2025-01-04 17:01:48'),
(7, '123456', 'mus', 'lost', '0137750225', '2025-01-04 17:03:29'),
(8, '031004010225', 'Najmi', 'lost', '0137750225', '2025-01-04 17:11:48'),
(9, '031004010225', 'Najmi', 'lost', '0137750225', '2025-01-04 17:12:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_support`
--
ALTER TABLE `customer_support`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_support`
--
ALTER TABLE `customer_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
