-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 10:00 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkingmonitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `activity` varchar(500) NOT NULL,
  `log_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`log_id`, `userID`, `activity`, `log_date`) VALUES
(17, 46, 'added new parking area Basement', '2021-04-26 23:02:18'),
(18, 46, 'created new account for Lorenzo Amodia Jr.', '2021-04-26 23:05:33'),
(19, 46, 'added new parking area Outdoor', '2021-04-26 23:45:56'),
(20, 46, 'reassigned user Lorenzo Amodia Jr. to Outdoor', '2021-04-26 23:46:43'),
(21, 46, 'reassigned user Lorenzo Amodia Jr. to Basement', '2021-04-26 23:47:27'),
(22, 46, 'deactivated user Lorenzo Amodia Jr.', '2021-04-27 00:41:09'),
(23, 46, 'deactivated user Lorenzo Amodia Jr.', '2021-04-27 00:51:49'),
(24, 46, 'created new account for Mary Herbito', '2021-04-27 01:02:14'),
(25, 46, 'reassigned user Mary Herbito to Outdoor', '2021-04-27 01:02:23'),
(26, 46, 'reactivated user Lorenzo Amodia Jr.', '2021-04-27 01:08:43'),
(27, 46, 'deactivated user Mary Herbito', '2021-04-27 01:09:08'),
(28, 46, 'deactivated user Lorenzo Amodia Jr.', '2021-04-27 01:09:16'),
(29, 46, 'reactivated user Mary Herbito', '2021-04-27 01:09:23'),
(30, 46, 'deleted the account of  ', '2021-04-27 01:13:26'),
(31, 46, 'deleted the account of Mary Herbito', '2021-04-27 01:15:13'),
(32, 46, 'created new account for Test TestTest', '2021-04-27 01:18:41'),
(33, 46, 'deleted the account of Test TestTest', '2021-04-27 01:19:05'),
(34, 46, 'created new account for Lorenzo Amodia Jr.', '2021-04-27 01:19:31'),
(35, 46, 'deactivated the account of Lorenzo Amodia Jr.', '2021-04-27 01:19:47'),
(36, 46, 'added new parking area 2nd Floor', '2021-04-27 01:21:45'),
(37, 46, 'reactivated the account of Lorenzo Amodia Jr.', '2021-04-27 01:22:01'),
(38, 46, 'added new parking area Testtt', '2021-04-27 01:34:04'),
(39, 46, 'deleted the account of Lorenzo Amodia Jr.', '2021-04-28 22:50:47'),
(40, 46, 'created new account for Lorenzo Amodia Jr.', '2021-04-28 22:51:14'),
(41, 46, 'reassigned user Lorenzo Amodia Jr. to Outdoor', '2021-04-28 22:51:34'),
(42, 46, 'created new account for Mary Herbito', '2021-04-28 23:50:05'),
(43, 46, 'deactivated the account of Mary Herbito', '2021-04-28 23:50:43'),
(44, 46, 'reactivated the account of Mary Herbito', '2021-04-28 23:53:42'),
(45, 46, 'updated parking area Basement with 25 4 wheeler slot(s) and 0 2 wheeler slot(s) to Basement 25 4 wheeler slot(s) and 7 2 wheeler slot(s).', '2021-04-30 01:52:41'),
(46, 46, 'updated parking area 2nd Floor with 100 slot(s) for 4-wheeled and 50 slot(s) for 2-wheeled to 2nd Floor with 100 slot(s) for 4-wheeled and 250 slot(s) for 2-wheeled.', '2021-04-30 01:58:05'),
(47, 46, 'updated parking area Outdoor with 25 slot(s) for 4-wheeled and 25 slot(s) for 2-wheeled to Outdoorsssss with 25 slot(s) for 4-wheeled and 25 slot(s) for 2-wheeled.', '2021-04-30 02:02:34'),
(48, 46, 'updated parking area Outdoorsssss with 25 slot(s) for 4-wheeled and 25 slot(s) for 2-wheeled to Outdoor with 25 slot(s) for 4-wheeled and 25 slot(s) for 2-wheeled.', '2021-04-30 02:04:02'),
(49, 46, 'deactivated Basement area', '2021-04-30 23:28:39'),
(50, 46, 'updated parking area 2nd Floor with 100 slot(s) for 4-wheeled and 250 slot(s) for 2-wheeled to 2nd Floor with 101 slot(s) for 4-wheeled and 250 slot(s) for 2-wheeled.', '2021-04-30 23:31:27'),
(51, 46, 'deactivated 2nd Floor area', '2021-04-30 23:31:45'),
(52, 46, 'reactivated  area', '2021-04-30 23:39:16'),
(53, 46, 'deactivated  area', '2021-04-30 23:46:38'),
(54, 46, 'deactivated 2nd Floor area', '2021-04-30 23:47:31'),
(55, 46, 'deactivated 2nd Floor area', '2021-04-30 23:47:42'),
(56, 46, 'deactivated Testtt area', '2021-04-30 23:47:55'),
(57, 46, 'deactivated Testtt area', '2021-04-30 23:48:07'),
(58, 46, 'deleted Testtt area', '2021-04-30 23:53:11'),
(59, 46, 'deactivated the account of Mary Herbito', '2021-04-30 23:53:59'),
(60, 46, 'deactivated 2nd Floor area', '2021-05-01 02:23:23'),
(61, 46, 'reactivated 2nd Floor area', '2021-05-01 02:38:43'),
(62, 46, 'deleted Basement area', '2021-05-04 18:17:03'),
(63, 46, 'deleted 2nd Floor area', '2021-05-04 18:17:31'),
(64, 46, 'deactivated Outdoor area', '2021-05-04 18:17:44'),
(65, 46, 'reactivated Outdoor area', '2021-05-04 18:18:09'),
(66, 46, 'deactivated Outdoor area', '2021-05-04 19:13:52'),
(67, 46, 'reactivated Outdoor area', '2021-05-04 19:30:48'),
(68, 46, 'reactivated the account of Mary Herbito', '2021-05-10 20:15:30'),
(69, 46, 'checked in 2 Wheeler with a Plate Number HHHHH', '2021-05-10 22:15:47'),
(70, 46, 'checked in a4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 00:53:30'),
(71, 46, 'checked in a2 Wheeler vehicle with a Plate Number 123', '2021-05-11 00:54:07'),
(72, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number TEST', '2021-05-11 13:24:35'),
(73, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number SDSDSD', '2021-05-11 18:16:17'),
(74, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 18:16:30'),
(75, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 2323', '2021-05-11 18:57:24'),
(76, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number ', '2021-05-11 19:04:35'),
(77, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number ', '2021-05-11 19:05:20'),
(78, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number TEST', '2021-05-11 19:06:18'),
(79, 46, 'checked-out a  vehicle with a Plate Number ', '2021-05-11 19:07:32'),
(80, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 2323', '2021-05-11 19:07:42'),
(81, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:09:59'),
(82, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number SDSDSD', '2021-05-11 19:11:31'),
(83, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:13:43'),
(84, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:14:33'),
(85, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:15:01'),
(86, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:15:38'),
(87, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:16:09'),
(88, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:16:19'),
(89, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:17:26'),
(90, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 123', '2021-05-11 19:18:36'),
(91, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number TEST', '2021-05-11 19:22:06'),
(92, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:22:36'),
(93, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number SDSDSD', '2021-05-11 19:22:52'),
(94, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:26:13'),
(95, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:27:34'),
(96, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number AAAAA', '2021-05-11 19:28:43'),
(97, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number AAAAA', '2021-05-11 19:30:01'),
(98, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:31:00'),
(99, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:31:05'),
(100, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:31:24'),
(101, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-11 19:31:41'),
(102, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:31:57'),
(103, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-11 19:32:02'),
(104, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 70240-24024', '2021-05-11 19:33:12'),
(105, 46, 'reassigned user Mary Herbito to Outdoor', '2021-05-11 20:07:24'),
(106, 46, 'deleted the account of Lorenzo Amodia Jr.', '2021-05-11 20:07:37'),
(107, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 70240-24024', '2021-05-12 00:47:50'),
(108, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-12 12:18:43'),
(109, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-12 12:23:02'),
(110, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-12 13:34:26'),
(111, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-12 13:34:33'),
(112, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-13 01:09:00'),
(113, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-13 01:09:13'),
(114, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-13 12:06:42'),
(115, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-13 12:06:49'),
(116, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number TEST', '2021-05-13 12:06:59'),
(117, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-13 12:11:19'),
(118, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-13 13:19:45'),
(119, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number TEST', '2021-05-13 13:21:10'),
(120, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-13 23:36:08'),
(121, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 00:18:43'),
(122, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number ABA2421', '2021-05-14 00:18:54'),
(123, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number ABA2421', '2021-05-14 00:19:02'),
(124, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-14 00:21:01'),
(125, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 00:22:20'),
(126, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number DDDD', '2021-05-14 00:22:55'),
(127, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 00:28:11'),
(128, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 00:33:35'),
(129, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 00:33:47'),
(130, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 00:34:54'),
(131, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 123', '2021-05-14 00:35:03'),
(132, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number SADAS', '2021-05-14 00:35:17'),
(133, 46, 'added new parking area Basement', '2021-05-14 00:42:51'),
(134, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number DDDD', '2021-05-14 01:05:27'),
(135, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 01:06:29'),
(136, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 01:06:35'),
(137, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number 213123AA', '2021-05-14 01:16:15'),
(138, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number 213123AA from Outdoor', '2021-05-14 01:16:35'),
(139, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 2124ASD at Basement', '2021-05-14 01:31:17'),
(140, 46, 'deactivated Outdoor area', '2021-05-14 01:32:20'),
(141, 46, 'reactivated Outdoor area', '2021-05-14 01:32:43'),
(142, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA at Outdoor', '2021-05-14 12:19:31'),
(143, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA from Outdoor', '2021-05-14 12:19:41'),
(144, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA at Outdoor', '2021-05-16 00:22:52'),
(145, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA from Outdoor', '2021-05-16 00:23:38'),
(146, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 213123AA at Outdoor', '2021-05-16 00:24:30'),
(147, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number DDDD at Outdoor', '2021-05-16 00:25:46'),
(148, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 213123AA from Outdoor', '2021-05-16 00:26:01'),
(149, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number DDDD from Outdoor', '2021-05-16 01:19:51'),
(150, 46, 'checked-in a 4 Wheeler vehicle with a Plate Number ABA2421 at Outdoor', '2021-05-16 04:49:15'),
(151, 46, 'checked-out a 4 Wheeler vehicle with a Plate Number ABA2421 from Outdoor', '2021-05-16 04:49:20'),
(152, 46, 'deactivated the account of Mary Herbito', '2021-05-16 06:42:09'),
(153, 46, 'checked-in a 2 Wheeler vehicle with a Plate Number 20525-2502 at Outdoor', '2021-05-19 20:59:00'),
(154, 46, 'checked-out a 2 Wheeler vehicle with a Plate Number 20525-2502 from Outdoor', '2021-05-19 21:02:49'),
(155, 46, 'reactivated the account of Mary Herbito', '2021-06-01 01:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `parking_area_info`
--

CREATE TABLE `parking_area_info` (
  `parking_info_id` int(11) NOT NULL,
  `parking_area_name` varchar(255) NOT NULL,
  `tot_4Wheel_slot` int(11) NOT NULL DEFAULT 0,
  `tot_2Wheel_slot` int(11) NOT NULL DEFAULT 0,
  `pa_status` varchar(255) NOT NULL DEFAULT '''Active''',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_area_info`
--

INSERT INTO `parking_area_info` (`parking_info_id`, `parking_area_name`, `tot_4Wheel_slot`, `tot_2Wheel_slot`, `pa_status`, `date_added`) VALUES
(10, 'Outdoor', 25, 25, 'Active', '2021-04-26 23:45:56'),
(13, 'Basement', 100, 50, 'Active', '2021-05-14 00:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `parking_transaction`
--

CREATE TABLE `parking_transaction` (
  `transactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `parking_info_id` int(11) NOT NULL,
  `plate_num` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `date_parked_in` varchar(255) NOT NULL,
  `time_check_in` varchar(255) NOT NULL,
  `time_checked_out` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL DEFAULT '0',
  `parking_rate` double NOT NULL DEFAULT 0,
  `parking_status` varchar(255) NOT NULL DEFAULT '''Unpaid'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking_transaction`
--

INSERT INTO `parking_transaction` (`transactionID`, `userID`, `parking_info_id`, `plate_num`, `vehicle_type`, `date_parked_in`, `time_check_in`, `time_checked_out`, `duration`, `parking_rate`, `parking_status`) VALUES
(97, 46, 10, '213123AA', '2 Wheeler', '2021-05-14', '12:19', '12:19', '00:00', 40, 'Paid'),
(98, 46, 10, '213123AA', '2 Wheeler', '2021-05-03', '12:19', '12:19', '00:00', 40, 'Paid'),
(99, 46, 10, '213123AA', '2 Wheeler', '2021-05-04', '12:19', '12:19', '00:00', 40, 'Paid'),
(100, 46, 10, '213123AA', '2 Wheeler', '2021-05-05', '12:19', '12:19', '00:00', 40, 'Paid'),
(101, 46, 10, '213123AA', '2 Wheeler', '2021-05-04', '12:19', '12:19', '00:00', 40, 'Paid'),
(102, 46, 10, '213123AA', '2 Wheeler', '2021-05-04', '12:19', '12:19', '00:00', 40, 'Paid'),
(103, 46, 10, '213123AA', '2 Wheeler', '2021-05-05', '12:19', '12:19', '00:00', 40, 'Paid'),
(104, 46, 10, '213123AA', '2 Wheeler', '2021-05-05', '12:19', '12:19', '00:00', 40, 'Paid'),
(106, 46, 10, '213123AA', '2 Wheeler', '2021-05-16', '00:05', '00:26', '00:20', 7, 'Paid'),
(107, 46, 10, 'DDDD', '4 Wheeler', '2021-05-16', '00:25', '01:19', '00:54', 18, 'Paid'),
(108, 46, 10, 'ABA2421', '4 Wheeler', '2021-05-16', '04:49', '04:49', '00:00', 0, 'Paid'),
(109, 46, 10, '20525-2502', '2 Wheeler', '2021-05-19', '20:59', '21:02', '00:03', 1, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT '''cashier''',
  `assigned_pArea` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `acct_status` varchar(255) NOT NULL DEFAULT '''Active''',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `user_role`, `assigned_pArea`, `first_name`, `last_name`, `username`, `password`, `acct_status`, `date_created`) VALUES
(46, 'admin', '', 'Lorenzo', 'Amodia Jr.', 'admin', '$2y$10$6kAXeceulZRPnbskT09beOme8C7GidXnOAl3Zs.GnSp32mVl4wlP.', 'Active', '2021-04-12 13:09:13'),
(88, 'cashier', 'Outdoor', 'Mary', 'Herbito', 'cashier2', '$2y$10$tDSsIeKRB54s5NWnJeY7PeG.sdQlBMxR89f1y..mXe5bk5k2pURJ6', 'Active', '2021-04-28 15:50:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `name` (`userID`);

--
-- Indexes for table `parking_area_info`
--
ALTER TABLE `parking_area_info`
  ADD PRIMARY KEY (`parking_info_id`);

--
-- Indexes for table `parking_transaction`
--
ALTER TABLE `parking_transaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `parking_info_id` (`parking_info_id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `parking_area_info`
--
ALTER TABLE `parking_area_info`
  MODIFY `parking_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `parking_transaction`
--
ALTER TABLE `parking_transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `parking_transaction`
--
ALTER TABLE `parking_transaction`
  ADD CONSTRAINT `parking_transaction_ibfk_1` FOREIGN KEY (`parking_info_id`) REFERENCES `parking_area_info` (`parking_info_id`),
  ADD CONSTRAINT `parking_transaction_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
