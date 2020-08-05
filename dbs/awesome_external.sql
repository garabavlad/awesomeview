-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 05, 2020 at 03:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awesome_external`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id_booking` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time_start` time DEFAULT NULL,
  `booking_time_end` time DEFAULT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id_booking`, `id_service`, `id_user`, `booking_date`, `booking_time_start`, `booking_time_end`, `cancelled`) VALUES
(3, 7, 1, '2021-11-29', NULL, NULL, 0),
(6, 2, 1, '2019-09-26', '00:00:00', '06:00:00', 1),
(7, 2, 1, '2019-10-09', '10:00:00', '14:00:00', 0),
(8, 2, 1, '2019-10-08', '10:00:00', '14:00:00', 1),
(9, 2, 1, '2019-10-10', '12:00:00', '16:00:00', 1),
(10, 2, 1, '2019-10-24', '10:00:00', '14:00:00', 0),
(11, 2, 1, '2019-10-10', '12:00:00', '16:00:00', 0),
(12, 2, 1, '2020-01-17', '14:00:00', '18:00:00', 1),
(13, 2, 8, '2020-01-17', '10:00:00', '14:00:00', 1),
(14, 2, 1, '2020-01-16', '14:00:00', '18:00:00', 0),
(15, 7, 8, '2020-06-19', NULL, NULL, 0),
(16, 2, 8, '2020-01-21', '16:00:00', '20:00:00', 0),
(17, 2, 1, '2020-07-24', '14:00:00', '18:00:00', 1),
(18, 2, 1, '2020-07-30', '10:00:00', '14:00:00', 0),
(19, 2, 1, '2020-07-31', '16:00:00', '20:00:00', 0),
(20, 2, 1, '2020-08-02', '10:00:00', '14:00:00', 1),
(21, 5, 1, '2020-08-19', '14:00:00', '15:00:00', 1),
(22, 6, 1, '2020-08-20', '10:00:00', '11:00:00', 1),
(23, 6, 1, '2020-08-12', '13:00:00', '14:00:00', 1),
(24, 6, 1, '2020-08-06', '10:00:00', '11:00:00', 1),
(25, 6, 1, '2020-08-21', '10:00:00', '11:00:00', 1),
(26, 5, 1, '2020-08-22', '10:00:00', '11:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `passes`
--

CREATE TABLE `passes` (
  `id_pass` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pass_amount` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passes`
--

INSERT INTO `passes` (`id_pass`, `id_service`, `id_user`, `pass_amount`) VALUES
(1, 3, 1, 10),
(7, 5, 1, 11),
(8, 2, 7, 1),
(9, 2, 1, 8),
(10, 2, 8, 0),
(11, 6, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `passes_actions`
--

CREATE TABLE `passes_actions` (
  `id_passes_action` int(11) NOT NULL,
  `id_pass` int(11) DEFAULT NULL,
  `id_subscription` int(11) DEFAULT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action_type` varchar(256) NOT NULL,
  `pass_amount` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passes_actions`
--

INSERT INTO `passes_actions` (`id_passes_action`, `id_pass`, `id_subscription`, `action_timestamp`, `action_type`, `pass_amount`) VALUES
(1, 8, NULL, '2019-09-19 21:31:27', 'New Pass', 1),
(2, NULL, 11, '2019-09-20 06:53:36', 'Subscription Activation: Created New Booking', 180),
(3, NULL, 11, '2019-09-20 06:53:52', 'Subscription Activation: Updated Existing Booking', 180),
(4, NULL, 11, '2019-09-20 06:54:59', 'Subscription Activation: Updated Existing Booking', 180),
(5, NULL, 11, '2019-09-20 06:55:02', 'Subscription Activation: Updated Existing Booking', 180),
(6, NULL, 11, '2019-09-20 06:57:00', 'Subscription Activation: Updated Existing Booking', 180),
(7, NULL, 11, '2019-09-20 07:44:44', 'Subscription Activation: Updated Existing Booking', 180),
(8, NULL, 11, '2019-09-20 07:44:47', 'Subscription Activation: Updated Existing Booking', 180),
(9, NULL, 11, '2019-09-20 07:45:57', 'Subscription Activation: Updated Existing Booking', 180),
(10, NULL, 11, '2019-09-20 07:48:11', 'Subscription Activation: Updated Existing Booking', 180),
(11, NULL, 11, '2019-09-20 07:50:00', 'Subscription Activation: Updated Existing Booking', 180),
(12, NULL, 11, '2019-09-20 07:50:03', 'Subscription Activation: Updated Existing Booking', 180),
(13, NULL, 11, '2019-09-20 07:50:07', 'Subscription Activation: Updated Existing Booking', 180),
(14, NULL, 11, '2019-09-20 07:50:11', 'Subscription Activation: Updated Existing Booking', 180),
(15, NULL, 11, '2019-09-20 07:50:20', 'Subscription Activation: Updated Existing Booking', 180),
(16, NULL, 11, '2019-09-20 07:53:42', 'Subscription Activation: Updated Existing Booking', 180),
(17, NULL, 12, '2019-09-20 07:55:40', 'Subscription Activation: Updated Existing Booking', 180),
(18, NULL, 13, '2019-09-20 07:59:18', 'Subscription Activation: Updated Existing Booking', 180),
(19, NULL, 13, '2019-09-20 07:59:22', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(20, NULL, 13, '2019-09-20 07:59:26', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(21, NULL, 14, '2019-09-20 08:04:38', 'Subscription Activation: Updated Existing Booking', 180),
(22, NULL, 14, '2019-09-20 08:04:41', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(23, 9, NULL, '2019-09-20 08:06:17', 'New Pass', 1),
(24, NULL, 15, '2019-09-20 08:06:17', 'New Subscription', 90),
(25, NULL, 16, '2019-09-20 20:44:16', 'New Subscription', 90),
(26, NULL, 16, '2019-09-20 20:44:25', 'Subscription Activation: Created New Booking', 90),
(27, NULL, 16, '2019-09-20 20:47:10', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(28, 9, NULL, '2019-10-08 07:31:31', 'Passes Decreased', 1),
(29, 9, NULL, '2019-10-08 07:31:31', '', 0),
(30, 9, NULL, '2019-10-08 07:32:06', 'Pass Decreasing Failure: Not Enough Passes', 1),
(31, 9, NULL, '2019-10-08 07:32:06', '', 0),
(32, 9, NULL, '2019-10-08 08:31:24', 'Pass Decreasing Failure: Not Enough Passes', 1),
(33, 9, NULL, '2019-10-08 08:31:24', 'Booking: Decreasing pass failed', 0),
(34, 9, NULL, '2019-10-08 08:33:57', 'Passes Decreased', 1),
(35, 9, NULL, '2019-10-08 08:33:57', 'Booking: New Booking Made Successfully', 0),
(36, 9, NULL, '2019-10-08 08:35:47', 'Booking: Requested date in the past:2019-10-08 & current date is 2019-10-08', 0),
(37, 9, NULL, '2019-10-08 08:36:20', 'Passes Decreased', 1),
(38, 9, NULL, '2019-10-08 08:36:25', 'Booking: New Booking Made Successfully', 0),
(39, 9, NULL, '2019-10-08 08:46:39', 'Passes Decreased', 1),
(40, 9, NULL, '2019-10-08 08:46:39', 'Booking: New Booking Made Successfully', 0),
(41, 9, NULL, '2019-10-08 08:47:11', 'Passes Decreased', 1),
(42, 9, NULL, '2019-10-08 08:47:11', 'Booking: New Booking Made Successfully', 0),
(43, 9, NULL, '2019-10-08 08:47:21', 'Booking: Requested time is already booked by another booking: 2019-10-08 at 10:00', 0),
(44, 9, NULL, '2019-10-08 08:52:26', 'Booking: Requested time is already booked by another booking: 2019-10-08 at 10:00', 0),
(45, 9, NULL, '2019-10-08 08:54:41', 'Booking: Requested time is already booked by another booking: 2019-10-08 at 10:00', 0),
(46, 9, NULL, '2019-10-08 08:59:57', 'Booking: Requested time is already booked by another booking: 2019-10-08 at 10:00', 0),
(47, NULL, 15, '2019-10-08 09:01:02', 'Subscription Activation: Updated Existing Booking', 90),
(48, 9, NULL, '2019-10-08 09:40:33', 'Booking: Requested time is already booked by another booking: 2019-10-08 at 10:00', 0),
(49, 9, NULL, '2019-10-08 09:45:50', 'Booking: Requested time is already booked by another booking: 2019-10-08 at 10:00', 0),
(50, NULL, NULL, '2019-10-09 23:32:48', 'Booking: Requested date in the past:2019-10-07 & current date is 2019-10-09', 0),
(51, 9, NULL, '2019-10-09 23:33:48', 'Passes Decreased', 1),
(52, 9, NULL, '2019-10-09 23:33:48', 'Booking: New Booking Made Successfully', 0),
(53, 9, NULL, '2019-10-09 23:35:50', 'Booking: Requested time is already booked by another booking: 2019-10-10 at 12:00', 0),
(54, 9, NULL, '2019-10-09 23:39:37', 'Booking: Requested date in the past:2019-10-08 & current date is 2019-10-09', 0),
(55, 9, NULL, '2019-10-09 23:39:53', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(56, 9, NULL, '2019-10-09 23:40:02', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(57, 9, NULL, '2019-10-09 23:40:09', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(58, 9, NULL, '2019-10-10 00:40:21', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(59, 9, NULL, '2019-10-10 01:20:24', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(60, 9, NULL, '2019-10-10 01:21:46', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(61, 9, NULL, '2019-10-10 01:22:20', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(62, 9, NULL, '2019-10-10 01:22:23', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(63, 9, NULL, '2019-10-10 01:22:27', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(64, 9, NULL, '2019-10-10 01:22:39', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(65, 9, NULL, '2019-10-10 01:22:50', 'Passes Decreased', 1),
(66, 9, NULL, '2019-10-10 01:22:50', 'Booking: New Booking Made Successfully', 0),
(67, 9, NULL, '2019-10-10 01:23:28', 'Booking: Requested time is already booked by another booking: 2019-10-24 at 10:00', 0),
(68, 9, NULL, '2019-10-10 01:23:59', 'Booking: Requested time is already booked by another booking: 2019-10-24 at 10:00', 0),
(69, 9, NULL, '2019-10-10 01:24:01', 'Booking: Requested time is already booked by another booking: 2019-10-24 at 10:00', 0),
(70, 9, NULL, '2019-10-10 01:24:02', 'Booking: Requested time is already booked by another booking: 2019-10-24 at 10:00', 0),
(71, 9, NULL, '2019-10-10 01:29:36', 'Booking: Requested date in the past:2019-10-09 & current date is 2019-10-09', 0),
(72, 9, NULL, '2019-10-10 02:17:19', 'Passes Increased', 1),
(73, 9, NULL, '2019-10-10 02:17:19', 'Booking Cancellation: Cancellation Successfully: 9', 0),
(74, 9, NULL, '2019-10-10 02:17:41', 'Passes Increased', 1),
(75, 9, NULL, '2019-10-10 02:17:41', 'Booking Cancellation: Cancellation Successfully: 8', 0),
(76, 9, NULL, '2019-10-10 02:28:04', 'Passes Increased', 1),
(77, 9, NULL, '2019-10-10 02:28:04', 'Booking Cancellation: Cancellation Successfully: 6', 0),
(78, 9, NULL, '2019-10-10 02:28:13', 'Booking Cancellation: Spotted cancellation request on a cancelled booking: 6', 0),
(79, 9, NULL, '2019-10-10 03:25:33', 'Passes Decreased', 1),
(80, 9, NULL, '2019-10-10 03:25:33', 'Booking: New Booking Made Successfully', 0),
(81, NULL, 12, '2019-10-11 10:35:20', 'Subscription Activation: Updated Existing Booking', 180),
(82, NULL, 12, '2019-10-11 10:36:41', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(83, NULL, 13, '2019-10-11 10:36:52', 'Subscription Activation: Updated Existing Booking', 180),
(84, NULL, 13, '2019-10-11 10:37:54', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(85, NULL, 13, '2019-10-11 10:38:51', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(86, NULL, 13, '2019-10-11 10:38:53', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(87, NULL, 13, '2019-10-11 10:38:56', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(88, NULL, 13, '2019-10-11 10:39:00', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(89, NULL, 14, '2019-10-11 10:39:11', 'Subscription Activation: Updated Existing Booking', 180),
(90, NULL, 14, '2019-10-11 10:39:16', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(91, NULL, 14, '2019-10-11 10:39:19', 'Subscription Activation Failure: Subscription Already Activated or Cancelled.', -1),
(92, NULL, NULL, '2019-10-15 16:38:10', 'Booking: Requested date in the past:2019-10-15 & current date is 2019-10-15', 0),
(93, NULL, NULL, '2019-10-15 16:38:29', 'Booking: Decreasing pass failed', 0),
(94, 9, NULL, '2020-01-07 18:20:23', 'Passes Decreased', 1),
(95, 9, NULL, '2020-01-07 18:20:23', 'Booking: New Booking Made Successfully', 0),
(96, 9, NULL, '2020-01-07 18:20:29', 'Passes Increased', 1),
(97, 9, NULL, '2020-01-07 18:20:29', 'Booking Cancellation: Cancellation Successfully: 12', 0),
(98, NULL, 17, '2020-01-08 06:43:37', 'New Subscription', 90),
(99, 10, NULL, '2020-01-08 06:43:37', 'New Pass', 1),
(100, NULL, 17, '2020-01-08 06:44:04', 'Subscription Activation: Created New Booking', 90),
(101, 10, NULL, '2020-01-08 06:44:24', 'Passes Decreased', 1),
(102, 10, NULL, '2020-01-08 06:44:24', 'Booking: New Booking Made Successfully', 0),
(103, 10, NULL, '2020-01-08 06:44:29', 'Passes Increased', 1),
(104, 10, NULL, '2020-01-08 06:44:29', 'Booking Cancellation: Cancellation Successfully: 13', 0),
(105, 9, NULL, '2020-01-08 10:19:36', 'Passes Decreased', 1),
(106, 9, NULL, '2020-01-08 10:19:36', 'Booking: New Booking Made Successfully', 0),
(107, NULL, 18, '2020-01-21 09:45:52', 'New Subscription', 30),
(108, NULL, 19, '2020-01-21 09:45:52', 'New Subscription', 30),
(109, NULL, 13, '2020-01-21 09:54:32', 'Subscription Activation: Updated Existing Booking', 180),
(110, NULL, 18, '2020-01-21 09:54:39', 'Subscription Activation: Updated Existing Booking', 30),
(111, NULL, 17, '2020-01-21 09:57:01', 'Subscription Activation: Created New Booking', 90),
(112, NULL, 17, '2020-01-21 10:00:30', 'Subscription Activation: Created New Booking', 90),
(113, NULL, 20, '2020-01-21 10:01:08', 'New Subscription', 30),
(114, NULL, 21, '2020-01-21 10:01:08', 'New Subscription', 30),
(115, NULL, 22, '2020-01-21 10:01:08', 'New Subscription', 30),
(116, NULL, 20, '2020-01-21 10:01:17', 'Subscription Activation: Updated Existing Booking', 30),
(117, NULL, 21, '2020-01-21 10:01:21', 'Subscription Activation: Updated Existing Booking', 30),
(118, 10, NULL, '2020-01-21 10:01:55', 'Passes Decreased', 1),
(119, 10, NULL, '2020-01-21 10:01:55', 'Booking: New Booking Made Successfully', 0),
(120, 9, NULL, '2020-07-22 13:27:00', 'Passes Decreased', 1),
(121, 9, NULL, '2020-07-22 13:27:00', 'Booking: New Booking Made Successfully', 0),
(122, 9, NULL, '2020-07-22 13:27:19', 'Passes Increased', 1),
(123, 9, NULL, '2020-07-22 13:27:19', 'Booking Cancellation: Cancellation Successfully: 17', 0),
(124, 9, NULL, '2020-07-22 13:28:13', 'Passes Increased', 1),
(125, 9, NULL, '2020-07-22 13:28:17', 'Passes Increased', 1),
(141, NULL, 33, '2020-07-23 05:27:16', 'New Subscription', 30),
(142, NULL, 34, '2020-07-23 05:27:24', 'New Subscription', 30),
(143, NULL, 35, '2020-07-23 05:36:11', 'New Subscription', 90),
(144, NULL, 36, '2020-07-23 05:36:39', 'New Subscription', 90),
(145, 9, NULL, '2020-07-23 05:43:00', 'Booking: Requested date in the past:2020-07-19 & current date is 2020-07-23', 0),
(146, 9, NULL, '2020-07-23 05:43:09', 'Passes Decreased', 1),
(147, 9, NULL, '2020-07-23 05:43:09', 'Booking: New Booking Made Successfully', 0),
(148, 9, NULL, '2020-07-23 05:43:26', 'Booking: Requested time is already booked by another booking: 2020-07-30 at 10:00', 0),
(149, 9, NULL, '2020-07-29 06:33:35', 'Passes Decreased', 1),
(150, 9, NULL, '2020-07-29 06:33:35', 'Booking: New Booking Made Successfully', 0),
(151, 9, NULL, '2020-08-01 11:25:43', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(152, 9, NULL, '2020-08-01 11:25:52', 'Passes Decreased', 1),
(153, 9, NULL, '2020-08-01 11:25:52', 'Booking: New Booking Made Successfully', 0),
(154, 9, NULL, '2020-08-01 11:26:14', 'Passes Increased', 1),
(155, 9, NULL, '2020-08-01 11:26:14', 'Booking Cancellation: Cancellation Successfully: 20', 0),
(156, 7, NULL, '2020-08-01 11:51:06', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(157, 7, NULL, '2020-08-01 11:51:19', 'Passes Decreased', 1),
(158, 7, NULL, '2020-08-01 11:51:19', 'Booking: New Booking Made Successfully', 0),
(159, 7, NULL, '2020-08-01 11:53:20', 'Booking: Requested time is already booked by another booking: 2020-08-19 at 14:00', 0),
(160, 7, NULL, '2020-08-01 11:53:26', 'Booking: Requested time is already booked by another booking: 2020-08-19 at 14:00', 0),
(161, 7, NULL, '2020-08-01 11:54:30', 'Booking: Requested time is already booked by another booking: 2020-08-19 at 14:00', 0),
(162, 7, NULL, '2020-08-01 11:54:54', 'Booking: Requested time is already booked by another booking: 2020-08-19 at 14:00', 0),
(163, 7, NULL, '2020-08-01 11:55:08', 'Passes Decreased', 1),
(164, 7, NULL, '2020-08-01 11:55:08', 'Booking: New Booking Made Successfully', 0),
(165, 7, NULL, '2020-08-01 11:55:12', 'Booking: Requested time is already booked by another booking: 2020-08-20 at 10:00', 0),
(166, 7, NULL, '2020-08-01 12:04:29', 'Booking: Requested time is already booked by another booking: 2020-08-20 at 10:00', 0),
(167, 7, NULL, '2020-08-01 12:16:56', 'Booking: Requested time is already booked by another booking: 2020-08-20 at 10:00', 0),
(168, 7, NULL, '2020-08-01 12:21:00', 'Booking: Requested time is already booked by another booking: 2020-08-20 at 10:00', 0),
(169, 11, NULL, '2020-08-01 12:32:54', 'New Pass', 1),
(170, 11, NULL, '2020-08-01 12:32:54', 'Booking Cancellation: Cancellation Successfully: 22', 0),
(171, 11, NULL, '2020-08-01 12:33:33', 'Booking Cancellation: Spotted cancellation request on a cancelled booking: 22', 0),
(172, 7, NULL, '2020-08-01 13:23:02', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(173, 7, NULL, '2020-08-01 15:02:18', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(174, 7, NULL, '2020-08-01 15:05:13', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(175, 7, NULL, '2020-08-01 15:07:36', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(176, 7, NULL, '2020-08-01 15:12:35', 'Booking: Requested date in the past:2020-08-01 & current date is 2020-08-01', 0),
(177, 11, NULL, '2020-08-01 15:23:04', 'Passes Decreased', 1),
(178, 11, NULL, '2020-08-01 15:23:04', 'Booking: New Booking Made Successfully', 0),
(179, 7, NULL, '2020-08-01 15:23:17', 'Passes Increased', 1),
(180, 7, NULL, '2020-08-01 15:23:17', 'Booking Cancellation: Cancellation Successfully: 21', 0),
(181, 7, NULL, '2020-08-01 15:23:24', 'Booking Cancellation: Spotted cancellation request on a cancelled booking: 21', 0),
(182, NULL, NULL, '2020-08-05 09:43:59', 'Booking Cancellation: Spotted cancellation request on a cancelled booking: 21', 0),
(183, 11, NULL, '2020-08-05 11:41:47', 'Passes Increased', 7),
(184, 11, NULL, '2020-08-05 11:41:52', 'Passes Increased', 7),
(185, 11, NULL, '2020-08-05 11:42:11', 'Passes Decreased', 1),
(186, 11, NULL, '2020-08-05 11:42:11', 'Booking: New Booking Made Successfully', 0),
(187, 11, NULL, '2020-08-05 11:44:45', 'Booking: Requested date in the past:2020-08-05 & current date is 2020-08-05', 0),
(188, 11, NULL, '2020-08-05 11:44:56', 'Booking: Requested date in the past:2020-08-05 & current date is 2020-08-05', 0),
(189, 11, NULL, '2020-08-05 11:45:30', 'Passes Increased', 1),
(190, 11, NULL, '2020-08-05 11:45:30', 'Booking Cancellation: Cancellation Successfully: 24', 0),
(191, 11, NULL, '2020-08-05 11:45:37', 'Passes Increased', 1),
(192, 11, NULL, '2020-08-05 11:45:37', 'Booking Cancellation: Cancellation Successfully: 23', 0),
(193, 11, NULL, '2020-08-05 11:58:09', 'Passes Decreased', 1),
(194, 11, NULL, '2020-08-05 11:58:09', 'Booking: New Booking Made Successfully', 0),
(195, 11, NULL, '2020-08-05 12:03:11', 'Booking: Requested time is already booked by another booking: 2020-08-21 at 10:00', 0),
(196, 11, NULL, '2020-08-05 12:03:15', 'Booking: Requested time is already booked by another booking: 2020-08-21 at 10:00', 0),
(197, NULL, NULL, '2020-08-05 12:12:24', 'Booking: Decreasing pass failed', 0),
(198, 11, NULL, '2020-08-05 12:16:19', 'Passes Increased', 1),
(199, 11, NULL, '2020-08-05 12:16:19', 'Booking Cancellation: Cancellation Successfully: 25', 0),
(200, NULL, NULL, '2020-08-05 12:16:32', 'Booking: Decreasing pass failed', 0),
(201, NULL, NULL, '2020-08-05 12:18:22', 'Booking: Requested date in the past:2020-08-05 & current date is 2020-08-05', 0),
(202, NULL, NULL, '2020-08-05 12:18:37', 'Booking: Decreasing pass failed', 0),
(203, NULL, NULL, '2020-08-05 12:21:20', 'Booking: Decreasing pass failed', 0),
(204, 7, NULL, '2020-08-05 12:21:25', 'Booking: Requested date in the past:2020-08-05 & current date is 2020-08-05', 0),
(205, 7, NULL, '2020-08-05 12:21:32', 'Passes Decreased', 1),
(206, 7, NULL, '2020-08-05 12:21:32', 'Booking: New Booking Made Successfully', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_check` int(16) NOT NULL,
  `quantity` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sales`, `id_service`, `id_user`, `id_check`, `quantity`) VALUES
(6, 5, 1, 407, 1),
(7, 3, 1, 409, 3),
(8, 3, 1, 409, 3),
(9, 9, 1, 409, 2),
(10, 3, 1, 409, 3),
(11, 9, 1, 409, 2),
(12, 9, 1, 409, 2),
(13, 2, 7, 410, 1),
(14, 2, 1, 411, 1),
(15, 8, 1, 411, 1),
(16, 8, 7, 412, 1),
(17, 8, 8, 414, 1),
(18, 2, 8, 414, 1),
(19, 7, 1, 417, 2),
(20, 7, 1, 417, 2),
(21, 7, 8, 418, 3),
(22, 7, 8, 418, 3),
(23, 7, 8, 418, 3),
(24, 2, 1, 420, 1),
(25, 2, 1, 420, 1),
(26, 7, 1, 421, 1),
(27, 7, 1, 421, 1),
(28, 7, 1, 423, 1),
(29, 7, 1, 423, 1),
(30, 7, 1, 427, 1),
(31, 7, 1, 427, 1),
(32, 7, 1, 428, 1),
(33, 7, 1, 428, 1),
(34, 2, 1, 429, 1),
(35, 2, 1, 429, 1),
(36, 7, 1, 430, 1),
(37, 7, 1, 430, 1),
(38, 7, 1, 431, 1),
(39, 7, 1, 431, 1),
(40, 8, 1, 432, 1),
(41, 8, 1, 432, 1),
(42, 6, 1, 434, 7),
(43, 6, 1, 434, 7);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id_service` int(11) NOT NULL,
  `service_name` varchar(128) NOT NULL,
  `wp_sku_code` int(16) NOT NULL,
  `is_pass` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id_service`, `service_name`, `wp_sku_code`, `is_pass`) VALUES
(2, 'Swimming Pass', 130000, 1),
(3, 'Weekday SPA Pass', 140000, 1),
(4, 'Weekend SPA Pass', 140001, 1),
(5, 'Hot Stone Massage', 120000, 1),
(6, 'Deep Tissue Massage', 120001, 1),
(7, '30 Days Fitness Subscription', 110000, 0),
(8, '90 Days Fitness Subscription', 110001, 0),
(9, '180 Days Fitness Subscription', 110002, 0),
(10, '360 Days Fitness Subscription', 110003, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id_subscription` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_check` int(11) NOT NULL,
  `duration` int(8) NOT NULL,
  `cancelled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id_subscription`, `id_service`, `id_user`, `id_check`, `duration`, `cancelled`) VALUES
(11, 9, 1, 409, 180, 1),
(12, 9, 1, 409, 180, 1),
(13, 9, 1, 409, 180, 1),
(14, 9, 1, 409, 180, 0),
(15, 8, 1, 411, 90, 1),
(16, 8, 7, 412, 90, 1),
(17, 8, 8, 414, 90, 1),
(18, 7, 1, 417, 30, 1),
(19, 7, 1, 417, 30, 0),
(20, 7, 8, 418, 30, 1),
(21, 7, 8, 418, 30, 1),
(22, 7, 8, 418, 30, 0),
(33, 7, 1, 431, 30, 0),
(34, 7, 1, 431, 30, 0),
(35, 8, 1, 432, 90, 0),
(36, 8, 1, 432, 90, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birth_date` datetime NOT NULL,
  `email` varchar(64) NOT NULL,
  `call_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `gender`, `birth_date`, `email`, `call_number`) VALUES
(1, 'Vladislav', 'Garaba', 'M', '2019-09-03 00:00:00', 'garaba.vlad@gmail.com', '0747397117'),
(6, 'Albert', 'Dodun', 'M', '2005-09-13 00:00:00', 'ablert@tt.com', '7023446620'),
(7, 'Vladislav', 'Garaba', 'M', '2019-09-10 00:00:00', 'abc@abc.abc', '0747397117'),
(8, 'tt', 'ee', 'M', '2019-12-30 00:00:00', 'aa@am.com', '23874823749'),
(9, 'user', 'user', 'M', '2020-07-22 00:00:00', 'user@user.com', '0759466118');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `fk_booking_serv` (`id_service`),
  ADD KEY `fk_booking_usr` (`id_user`);

--
-- Indexes for table `passes`
--
ALTER TABLE `passes`
  ADD PRIMARY KEY (`id_pass`),
  ADD UNIQUE KEY `id_pass` (`id_pass`),
  ADD KEY `id_service` (`id_service`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `passes_actions`
--
ALTER TABLE `passes_actions`
  ADD PRIMARY KEY (`id_passes_action`),
  ADD KEY `fk_passes_actions_passes` (`id_pass`),
  ADD KEY `fk_passes_actions_subscr` (`id_subscription`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sales`),
  ADD KEY `fk_sales_service` (`id_service`),
  ADD KEY `fk_sales_user` (`id_user`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id_subscription`),
  ADD KEY `fk_subscription_usr` (`id_user`),
  ADD KEY `fk_subscriptions_serv` (`id_service`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `passes`
--
ALTER TABLE `passes`
  MODIFY `id_pass` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `passes_actions`
--
ALTER TABLE `passes_actions`
  MODIFY `id_passes_action` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id_subscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_booking_serv` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`),
  ADD CONSTRAINT `fk_booking_usr` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `passes`
--
ALTER TABLE `passes`
  ADD CONSTRAINT `fk_passes_serv` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`),
  ADD CONSTRAINT `fk_passes_usr` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `passes_actions`
--
ALTER TABLE `passes_actions`
  ADD CONSTRAINT `fk_passes_actions_passes` FOREIGN KEY (`id_pass`) REFERENCES `passes` (`id_pass`),
  ADD CONSTRAINT `fk_passes_actions_subscr` FOREIGN KEY (`id_subscription`) REFERENCES `subscriptions` (`id_subscription`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`),
  ADD CONSTRAINT `fk_sales_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `fk_subscription_usr` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subscriptions_serv` FOREIGN KEY (`id_service`) REFERENCES `services` (`id_service`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
