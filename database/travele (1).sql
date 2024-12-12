-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 02:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travele`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `budget` bigint(11) NOT NULL,
  `date` date NOT NULL,
  `rid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `budget`, `date`, `rid`) VALUES
(7, 11999, '2024-09-04', 2),
(8, 11999, '2024-09-04', 1),
(9, 12222, '2024-09-17', 2),
(10, 2333434, '2024-09-16', 6);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`) VALUES
(2, 'sana', 'Sana123@gmail.com', 'hello'),
(3, 'sana', 'Sana123@gmail.com', 'hello'),
(4, 'saa', 'saa@gmail.com', 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `dateexpense` date NOT NULL,
  `cost_of_expense` decimal(10,2) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `remain_amount` decimal(10,2) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `dateexpense`, `cost_of_expense`, `category`, `notes`, `remain_amount`, `uid`, `trip_id`) VALUES
(1, '2024-09-21', '3000.00', 'Food', 'iii', '67000.00', 1, 31),
(2, '2024-09-21', '5000.00', 'Food', '11', '65000.00', 1, 31),
(3, '2024-09-21', '2000.00', 'Food', 'khaya hai', '40000.00', 1, 32),
(4, '2024-09-22', '8000.00', 'Transport', 'hello', '34000.00', 1, 32),
(14, '2024-09-15', '1200.00', 'Transport', 'i eat', '68800.00', 1, 31),
(15, '2024-09-16', '12.00', 'Food', 'i eat', '11866.00', 6, 34);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `password`, `img`) VALUES
(1, 'neha', 'neh@gmail.com', '676878', 'img/dp.jfif'),
(2, 'Admin', 'admin@gmail.com', 'ADM123,a', ''),
(6, 'sana', 'Sana123@gmail.com', 'sana1233', 'img/dp.jfif'),
(7, 'jelani', 'jelani@gmail.com', 'jelani1233', 'img/dpg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `travel_packages`
--

CREATE TABLE `travel_packages` (
  `id` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_packages`
--

INSERT INTO `travel_packages` (`id`, `destination`, `description`, `original_price`, `discounted_price`, `discount`, `image_path`) VALUES
(13, 'CANADA', 'Experience the natural beauty of glacier', '1500.00', '1200.00', 20, 'assets/img/img10.jpg'),
(14, 'NEW ZEALAND', 'Trekking to the mountain camp site', '1300.00', '1089.00', 15, 'assets/img/img1.jpg'),
(15, 'MALAYSIA', 'Sunset view of beautiful lakeside city', '1800.00', '1489.00', 15, 'assets/img/img50.jpg'),
(16, 'SWITZERLAND', 'Hiking to the far west mount region', '1200.00', '1098.00', 20, 'assets/img/img11.jpg'),
(17, 'SOUTH WALES', 'Couple vacation to South Wales', '1099.00', '809.00', 16, 'assets/img/img51.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `budget` decimal(10,2) NOT NULL,
  `tripname` varchar(255) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `days` int(11) NOT NULL,
  `transport` varchar(255) NOT NULL,
  `transport_cost` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `trip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`trip_id`, `budget`, `tripname`, `currency`, `days`, `transport`, `transport_cost`, `uid`, `created_at`, `trip`) VALUES
(27, '55000.00', 'First Trip', 'PKR', 5, 'Bus', 5000, 7, '2024-09-21 12:46:29', NULL),
(28, '20000.00', 'second trip', 'PKR', 3, 'Train', 3000, 7, '2024-09-21 12:47:30', NULL),
(30, '12000.00', 'First Trip', 'EUR', 5, 'Flight', 0, 1, '2024-09-21 13:39:46', NULL),
(31, '70000.00', 'second trip', 'PKR', 4, 'Train', 10000, 1, '2024-09-21 13:53:57', NULL),
(32, '42000.00', 'third trip', 'PKR', 4, 'Train', 8000, 1, '2024-09-21 14:08:01', NULL),
(34, '11878.00', 'First Trip', 'PKR', 3, 'Train', 122, 6, '2024-09-21 19:18:19', NULL),
(35, '11878.00', 'First Trip', 'PKR', 3, 'Train', 122, 6, '2024-09-21 19:19:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `upcome`
--

CREATE TABLE `upcome` (
  `id` int(11) NOT NULL,
  `des` text NOT NULL,
  `desti` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upcome`
--

INSERT INTO `upcome` (`id`, `des`, `desti`, `img`) VALUES
(2, 'As the sun sets, the sky transforms into a palette of colors, casting a warm glow over the water. Gathered around a campfire', 'Canada', 'assets/img/img11.jpg'),
(3, 'As the sun sets, the sky transforms into a palette of colors, casting a warm glow over the water. Gathered around a campfire', 'Europe', 'assets/img/img50.jpg'),
(6, 'As the sun sets, the sky transforms into a palette of colors, casting a warm glow over the water. Gathered around a campfire', 'Australia', 'assets/img/img9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trip_id` (`trip_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_packages`
--
ALTER TABLE `travel_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `upcome`
--
ALTER TABLE `upcome`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `upcome`
--
ALTER TABLE `upcome`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `register` (`id`);

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `register` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
