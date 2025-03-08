-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 08:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elevate`
--

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_category` varchar(255) NOT NULL,
  `goal_description` text NOT NULL,
  `target_date` date NOT NULL,
  `starting_date` date NOT NULL,
  `goal_completion_type` varchar(50) NOT NULL,
  `numeric_target` int(11) DEFAULT NULL,
  `starting_value` int(255) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goal_progress`
--

CREATE TABLE `goal_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `progress_percentage` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goal_status`
--

CREATE TABLE `goal_status` (
  `id` int(11) NOT NULL,
  `goal_id` int(11) DEFAULT NULL,
  `status` enum('IN_PROGRESS','ON_HOLD','COMPLETED','MISSED') DEFAULT 'IN_PROGRESS',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_user_id` (`user_id`);

--
-- Indexes for table `goal_progress`
--
ALTER TABLE `goal_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- Indexes for table `goal_status`
--
ALTER TABLE `goal_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_goal_id` (`goal_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `goal_progress`
--
ALTER TABLE `goal_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `goal_status`
--
ALTER TABLE `goal_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `goal_progress`
--
ALTER TABLE `goal_progress`
  ADD CONSTRAINT `goal_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `goal_progress_ibfk_2` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `goal_status`
--
ALTER TABLE `goal_status`
  ADD CONSTRAINT `fk_goal_id` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
