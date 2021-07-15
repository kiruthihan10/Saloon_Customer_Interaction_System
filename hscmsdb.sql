-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 12:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hscmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentID` int(11) NOT NULL,
  `customer_ID` varchar(10) NOT NULL,
  `employee_ID` varchar(10) NOT NULL,
  `shave` tinyint(1) NOT NULL,
  `hair_cut` tinyint(1) NOT NULL,
  `Massage` tinyint(1) NOT NULL,
  `dye` tinyint(1) NOT NULL,
  `dop` date NOT NULL,
  `toa` time NOT NULL,
  `customer_rating` int(11) NOT NULL,
  `employee_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `customer_ID`, `employee_ID`, `shave`, `hair_cut`, `Massage`, `dye`, `dop`, `toa`, `customer_rating`, `employee_rating`) VALUES
(25, 'Batman', 'penguin', 1, 0, 1, 0, '1997-10-10', '11:17:00', 4, 4),
(26, 'batman', 'lcorp', 1, 0, 0, 0, '2020-12-31', '11:17:00', 0, 2),
(30, 'batman', 'twoface', 0, 0, 1, 0, '2021-02-03', '11:17:00', 0, 5),
(31, 'batman', 'twoface', 1, 0, 0, 0, '2021-03-05', '13:43:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `User_ID` varchar(10) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`User_ID`, `email`) VALUES
('Batman', 'bruce@waynetech.org'),
('superman', 'kent@dailyplanet.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `User_ID` varchar(10) NOT NULL,
  `Salary` float NOT NULL,
  `Saloon_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`User_ID`, `Salary`, `Saloon_ID`) VALUES
('joker', 12500, 7),
('lcorp', 6000, 6),
('penguin', 10000, 5),
('punchline', 8000, 7),
('twoface', 9000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_ID` int(11) NOT NULL,
  `Saloon_ID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date_of_deposit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Payment_ID`, `Saloon_ID`, `Price`, `Date_of_deposit`) VALUES
(1, 5, 15, '2020-12-02'),
(2, 5, 5, '2021-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `saloon`
--

CREATE TABLE `saloon` (
  `Saloon_ID` int(11) NOT NULL,
  `Location` text NOT NULL,
  `Saloon_Name` text NOT NULL,
  `Phone_Number` text NOT NULL,
  `Agent_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saloon`
--

INSERT INTO `saloon` (`Saloon_ID`, `Location`, `Saloon_Name`, `Phone_Number`, `Agent_ID`) VALUES
(5, 'Jaffna', 'new style', '0112563159', 'ir0ngh0st1'),
(6, 'Batticaloa', 'youth spot', '0115698653', 'ir0ngh0st1'),
(7, 'Kandy', 'Hair Master', '0112653219', 'ir0ngh0st1');

-- --------------------------------------------------------

--
-- Table structure for table `system_admins`
--

CREATE TABLE `system_admins` (
  `User_ID` varchar(10) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_admins`
--

INSERT INTO `system_admins` (`User_ID`, `email`) VALUES
('ir0ngh0st1', 'kiruthihan10@gmail.com'),
('springyboi', 'springy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` varchar(10) NOT NULL,
  `Name` text NOT NULL,
  `Phone_Number` varchar(11) NOT NULL,
  `Pword` text NOT NULL,
  `Rating` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Name`, `Phone_Number`, `Pword`, `Rating`) VALUES
('Batman', 'Bruce Wayne', '07586424587', '$2y$10$vM5uklKQ9jYDvGMRKncUCOHIlfVuV/uuqKB6hZoqDsZ66XCYzRhHu', 0),
('ir0ngh0st1', 'Kiruthihan Nagarajan', '0770069968', '$2y$10$UcW5/cLqUfsALsBH7odmy.SpnyDvoBN5F3XIJagO59N2wYM.bFd.K', 0),
('joker', 'Jack Napier', '07777777777', '$2y$10$IuRJbXCXcNSMhQlENXAaYep4UMGORP87yYec3uujnSwcNBqcho/6S', 0),
('lcorp', 'Lex Luthor', '0779683241', '$2y$10$oEfsHYmnuABtLGVMTxGxiu1LYwLbNUDLMf18TxcC0VViUPYBJP2v.', 0),
('penguin', 'Oswald Cobblepot', '0758694687', '$2y$10$uvTlKyMkOn048FGDkOC25uxRV4zQk/Fve2CunFGF2t1NVZyL58YfW', 0),
('punchline', 'Alexis Kaye', '0779988660', '$2y$10$PdlBLjJYL2XxcumzVSHjkuG/ZmpHM9ZGqx4xT9Bynqd1wM7TfWR8e', 0),
('springyboi', 'Arvinth Sugumar', '0776665552', '$2y$10$lq/W1yOjqC8xKubhZR9kR.P56BtHpj/TrEdxEfRG8cZ5fz/q7lCWq', 0),
('superman', 'Clark Kent', '0796843215', '$2y$10$mr1Z5b7qtDAECL5vaOOR2elfZ/gBKh9bKFadIkI/JrfKsF8g63Z0.', 0),
('twoface', 'Harvey Dent', '0761237595', '$2y$10$myULPTfxen6VawsaBXeZte2h.txyTzG8gyMrDrk5ThfcXeYiuMOZ2', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `appointment_ibfk_2` (`employee_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `employee_ibfk_2` (`Saloon_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Saloon_ID` (`Saloon_ID`);

--
-- Indexes for table `saloon`
--
ALTER TABLE `saloon`
  ADD PRIMARY KEY (`Saloon_ID`),
  ADD KEY `saloon_ibfk_1` (`Agent_ID`);

--
-- Indexes for table `system_admins`
--
ALTER TABLE `system_admins`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saloon`
--
ALTER TABLE `saloon`
  MODIFY `Saloon_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`User_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`User_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Saloon_ID`) REFERENCES `saloon` (`Saloon_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`Saloon_ID`) REFERENCES `saloon` (`Saloon_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `saloon`
--
ALTER TABLE `saloon`
  ADD CONSTRAINT `saloon_ibfk_1` FOREIGN KEY (`Agent_ID`) REFERENCES `users` (`User_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `system_admins`
--
ALTER TABLE `system_admins`
  ADD CONSTRAINT `system_admins_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
