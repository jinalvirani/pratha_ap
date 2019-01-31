-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2018 at 10:47 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prathadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookfacility_tb`
--

CREATE TABLE `bookfacility_tb` (
  `book_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `facility_id` int(100) NOT NULL,
  `book_status` int(1) NOT NULL,
  `book_date` date NOT NULL,
  `time_slot` varchar(100) NOT NULL,
  `total_charge` bigint(100) NOT NULL,
  `penalty` bigint(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `approve_disapprove_msg` varchar(100) DEFAULT NULL,
  `approve_disapprove_status` int(1) NOT NULL,
  `pay_status` int(1) NOT NULL,
  `confirm_booking_status` int(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookfacility_tb`
--

INSERT INTO `bookfacility_tb` (`book_id`, `user_id`, `facility_id`, `book_status`, `book_date`, `time_slot`, `total_charge`, `penalty`, `added_on`, `added_by`, `status`, `approve_disapprove_msg`, `approve_disapprove_status`, `pay_status`, `confirm_booking_status`, `modified_on`, `modified_by`) VALUES
(11, 69, 1, 1, '2018-05-24', '08:00:pm-10:00:pm', 200, 100, '2018-05-23', 'user', 0, 'Booking confirmed', 0, 1, 1, '2018-05-23', NULL),
(12, 69, 1, 1, '2018-05-24', '08:00:pm-10:00:pm', 200, 0, '2018-05-23', 'user', 0, 'na', 0, 0, 0, NULL, NULL),
(13, 69, 1, 1, '2018-05-24', '08:00:pm-10:00:pm', 200, 0, '2018-05-23', 'user', 0, 'nahi', 0, 0, 0, NULL, NULL),
(14, 69, 1, 1, '2018-05-24', '08:00:pm-10:00:pm', 200, 10, '2018-05-23', 'user', 0, 'Booking confirmed', 0, 1, 1, '2018-05-24', NULL),
(15, 69, 1, 1, '2018-05-25', '08:00:pm-10:00:pm', 200, 0, '2018-05-24', 'user', 1, 'Booking confirmed', 0, 1, 1, '2018-05-24', NULL),
(16, 69, 2, 1, '2018-05-26', '08:00:pm-10:00:pm', 280, 0, '2018-05-24', 'user', 1, 'Booking confirmed', 0, 1, 1, '2018-05-24', NULL),
(17, 69, 1, 1, '2018-05-25', '09:00:am-12:00:pm', 300, 100, '2018-05-24', 'user', 0, 'Booking confirmed', 0, 1, 1, '2018-05-24', NULL),
(18, 69, 1, 1, '2018-05-25', '09:00:am-12:00:pm', 300, 0, '2018-05-24', 'user', 0, 'nathi', 0, 0, 0, NULL, NULL),
(19, 69, 1, 1, '2018-05-26', '08:00:pm-10:00:pm', 200, 100, '2018-05-25', 'user', 0, 'Booking confirmed', 0, 0, 1, NULL, NULL),
(20, 69, 1, 1, '2018-05-27', '10:00:pm-12:00:am', 200, 0, '2018-05-25', 'user', 1, 'Booking confirmed', 0, 0, 1, NULL, NULL),
(21, 69, 1, 1, '2018-05-28', '08:00:pm-10:00:pm', 200, 0, '2018-05-25', 'user', 1, 'Booking confirmed', 0, 0, 1, NULL, NULL),
(22, 69, 1, 1, '2018-05-31', '07:00:am-09:00:pm', 200, 0, '2018-05-26', 'user', 1, NULL, 0, 0, 0, NULL, NULL),
(23, 69, 3, 1, '2018-05-30', '08:00:pm-10:00:pm', 600, 0, '2018-05-29', 'user', 1, 'Booking confirmed', 0, 0, 1, NULL, NULL),
(24, 82, 1, 1, '2018-06-15', '08:00:pm-10:00:pm', 200, 0, '2018-06-13', 'user', 1, 'Booking confirmed', 0, 0, 1, NULL, NULL),
(25, 82, 2, 1, '2018-06-16', '07:00:am-09:00:pm', 280, 0, '2018-06-13', 'user', 1, NULL, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city_tb`
--

CREATE TABLE `city_tb` (
  `city_id` int(100) NOT NULL,
  `city_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_tb`
--

INSERT INTO `city_tb` (`city_id`, `city_name`) VALUES
(1, 'surat'),
(3, 'ahemedabad');

-- --------------------------------------------------------

--
-- Table structure for table `expense_tb`
--

CREATE TABLE `expense_tb` (
  `expense_revenue_id` int(100) NOT NULL,
  `expense_revenue_name` varchar(100) NOT NULL,
  `amount` bigint(100) NOT NULL,
  `expense_date` date NOT NULL,
  `type` varchar(40) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `pay_status` int(1) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(40) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_tb`
--

INSERT INTO `expense_tb` (`expense_revenue_id`, `expense_revenue_name`, `amount`, `expense_date`, `type`, `user_id`, `pay_status`, `added_on`, `added_by`, `modified_on`, `modified_by`) VALUES
(2, 'ganesh chaturthi', 100, '0000-00-00', 'revenue', 52, 1, '2018-05-22', 'admin', '2018-05-23', ''),
(3, 'lightingg', 1000, '2018-05-22', 'expense', NULL, 0, '2018-05-23', 'admin', '2018-05-23', 'admin'),
(4, 'navratri fund', 200, '0000-00-00', 'revenue', 67, 0, '2018-05-23', 'admin', '0000-00-00', ''),
(5, 'navratri fund', 200, '0000-00-00', 'revenue', 69, 0, '2018-05-23', 'admin', '0000-00-00', ''),
(6, 'navratri fund', 200, '0000-00-00', 'revenue', 70, 0, '2018-05-23', 'admin', '0000-00-00', ''),
(7, 'navratri fund', 200, '0000-00-00', 'revenue', 71, 0, '2018-05-23', 'admin', '0000-00-00', ''),
(8, 'navratri fund', 200, '0000-00-00', 'revenue', 73, 0, '2018-05-23', 'admin', '0000-00-00', ''),
(9, 'lighting', 1200, '2018-05-10', 'expense', NULL, 0, '2018-06-13', 'admin', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `facility_tb`
--

CREATE TABLE `facility_tb` (
  `facility_id` int(100) NOT NULL,
  `facility_name` varchar(100) NOT NULL,
  `charge_per_hour` int(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility_tb`
--

INSERT INTO `facility_tb` (`facility_id`, `facility_name`, `charge_per_hour`, `pic`, `status`, `added_on`, `added_by`, `modified_on`, `modified_by`) VALUES
(1, 'banqute hall', 100, 'banqute.jpg', 1, '2018-05-22', 'admin', '2018-05-22', 'admin'),
(2, 'kids play area', 140, 'kids.png', 1, '2018-05-22', 'admin', '0000-00-00', ''),
(3, 'loungue', 300, 'loung.jpg', 1, '2018-05-23', 'admin', '0000-00-00', ''),
(4, 'club house', 150, 'gokull.jpg', 1, '2018-05-25', 'admin', '0000-00-00', ''),
(5, 'swimming pool', 150, 'swim.jpg', 1, '2018-05-25', 'admin', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `home_tb`
--

CREATE TABLE `home_tb` (
  `home_id` int(100) NOT NULL,
  `home_no` int(100) NOT NULL,
  `wing_id` int(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_tb`
--

INSERT INTO `home_tb` (`home_id`, `home_no`, `wing_id`, `added_on`, `added_by`, `status`) VALUES
(35, 1, 19, '2018-05-21', 'admin', 0),
(36, 2, 19, '2018-05-21', 'admin', 1),
(37, 1, 20, '2018-05-22', 'admin', 1),
(38, 2, 20, '2018-05-22', 'admin', 1),
(39, 3, 20, '2018-05-22', 'admin', 1),
(40, 3, 19, '2018-05-22', 'admin', 1),
(41, 2, 22, '2018-06-13', 'admin', 1),
(42, 1, 23, '2018-06-13', 'admin', 1),
(43, 2, 23, '2018-06-13', 'admin', 1),
(44, 4, 23, '2018-06-13', 'admin', 1),
(45, 5, 23, '2018-06-13', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `issue_tb`
--

CREATE TABLE `issue_tb` (
  `issue_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `discription` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `issue_progress_status` int(10) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_tb`
--

INSERT INTO `issue_tb` (`issue_id`, `user_id`, `title`, `discription`, `pic`, `added_on`, `added_by`, `issue_progress_status`, `status`) VALUES
(1, 82, 'parking problem', 'parking slot fooded with water', 'vend5.jpg', '2018-06-13', 'owner', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `like_tb`
--

CREATE TABLE `like_tb` (
  `like_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_tb`
--

INSERT INTO `like_tb` (`like_id`, `post_id`, `user_id`) VALUES
(2, 1, 69),
(3, 1, 71),
(5, 2, 71),
(8, 2, 69),
(9, 3, 70),
(10, 4, 79);

-- --------------------------------------------------------

--
-- Table structure for table `maintanance_tb`
--

CREATE TABLE `maintanance_tb` (
  `maintanance_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `maintanance_date` date NOT NULL,
  `due_date` date NOT NULL,
  `amount` bigint(100) NOT NULL,
  `penalty` bigint(100) NOT NULL,
  `pay_status` int(1) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintanance_tb`
--

INSERT INTO `maintanance_tb` (`maintanance_id`, `user_id`, `maintanance_date`, `due_date`, `amount`, `penalty`, `pay_status`, `added_on`, `added_by`, `modified_on`, `modified_by`) VALUES
(1, 52, '2018-05-22', '2018-05-22', 2000, 10, 1, '2018-05-22', 'admin', '2018-05-23', NULL),
(2, 52, '2018-05-23', '2018-05-23', 2000, 20, 0, '2018-05-23', 'admin', NULL, NULL),
(3, 66, '2018-05-23', '2018-05-23', 2000, 20, 0, '2018-05-23', 'admin', NULL, NULL),
(4, 67, '2018-05-23', '2018-05-23', 2000, 20, 1, '2018-05-23', 'admin', '2018-06-13', NULL),
(5, 69, '2018-05-23', '2018-05-23', 2000, 10, 1, '2018-05-23', 'admin', '2018-05-24', NULL),
(6, 70, '2018-05-23', '2018-05-23', 2000, 20, 0, '2018-05-23', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_tb`
--

CREATE TABLE `member_tb` (
  `member_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `mobile_no` bigint(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `member_type` varchar(100) NOT NULL,
  `emergency_status` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `emergency_notification` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_tb`
--

INSERT INTO `member_tb` (`member_id`, `user_id`, `firstname`, `lastname`, `gender`, `mobile_no`, `pic`, `member_type`, `emergency_status`, `added_on`, `added_by`, `modified_on`, `modified_by`, `status`, `emergency_notification`) VALUES
(16, 73, 'binal', 'shah', 'male', 9632587412, '2.jpg', 'Child', 'yes', '2018-05-23', 'owner', '2018-05-23', 'owner', 1, 0),
(17, 73, 'rajeshrii', 'patel', 'male', 9632587412, '3.jpg', 'Child', 'no', '2018-05-23', 'owner', NULL, NULL, 0, 0),
(18, 69, 'kinajal', 'patel', 'female', 7405028057, '16.jpg', 'Adult', 'no', '2018-05-23', 'owner', NULL, NULL, 0, 0),
(19, 69, 'kinal', 'patell', 'female', 7405028059, 'img2.jpg', 'Adult', 'yes', '2018-05-23', 'owner', '2018-05-29', 'owner', 0, 0),
(20, 69, 'kjnijn', 'jij', 'female', 7405028057, 'img3.jpg', 'Adult', 'yes', '2018-05-29', 'owner', NULL, NULL, 0, 0),
(21, 69, 'uhuy', 'ihiuh', 'female', 7405028057, 'img3.jpg', 'Child', 'no', '2018-05-29', 'owner', NULL, NULL, 0, 0),
(22, 82, 'jyostana', 'patel', 'female', 7405028057, '2.jpg', 'Adult', 'yes', '2018-06-13', 'owner', '2018-06-13', 'owner', 1, 0),
(23, 82, 'jaya', 'patel', 'female', 7405028059, '15.jpg', 'Senior-Citizen', 'yes', '2018-06-13', 'owner', NULL, NULL, 1, 0),
(25, 81, 'aa', 'aa', 'male', 7405028057, '5.jpg', 'Child', 'no', '2018-06-14', 'owner', NULL, NULL, 1, 0),
(27, 70, 'vijay', 'virani', 'male', 7405028057, '6.jpg', 'Senior-Citizen', 'yes', '2018-06-15', 'owner', '2018-06-15', 'owner', 1, 0),
(28, 66, 'aa', 'virani', 'male', 7405028057, '5.jpg', 'Child', 'no', '2018-06-15', 'owner', NULL, NULL, 1, 0),
(29, 66, 'bb', 'bb', 'male', 7405028057, '2.jpg', 'Child', 'no', '2018-06-15', 'owner', NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notice_tb`
--

CREATE TABLE `notice_tb` (
  `notice_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `notice_type` varchar(100) NOT NULL,
  `is_default` varchar(3) NOT NULL,
  `is_sent` varchar(3) NOT NULL,
  `status` int(1) NOT NULL,
  `time` varchar(100) NOT NULL,
  `wing_no` int(100) DEFAULT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `open_close` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice_tb`
--

INSERT INTO `notice_tb` (`notice_id`, `title`, `description`, `notice_type`, `is_default`, `is_sent`, `status`, `time`, `wing_no`, `added_on`, `added_by`, `modified_on`, `modified_by`, `open_close`) VALUES
(1, 'Electricity faliure', 'there will be electricity shortage on 25/5/2018 due to repairing.', 'other', 'no', 'yes', 0, '10:16 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(2, 'poll', 'poll to change admin', 'poll', 'yes', 'no', 0, '22:17 PM', 0, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(3, 'poll', 'poll to change admin', 'poll', 'no', 'yes', 0, '10:17 PM', 0, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(4, 'Electricity faliure', 'there will be electricity shortage on 25/5/2018 due to repairing.', 'other', 'yes', 'no', 1, '22:18 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(5, 'Electricity faliure', 'there will be electricity shortage on 25/5/2018 due to repairing.', 'other', 'no', 'yes', 1, '10:18 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(6, 'maitenance', 'all resident have to paid their maintace before 23-5-2018.amount is 2000', 'maintanance', 'no', 'yes', 1, '10:21 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(7, 'Electricity faliure', 'there will be electricity shortage on 23/5/2018 due to repairing.', 'other', 'yes', 'no', 0, '22:22 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(8, 'Electricity faliure', 'there will be electricity shortage on 23/5/2018 due to repairing.', 'other', 'no', 'yes', 0, '10:22 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(9, 'fund for ganesh chaturthi', 'all resident requested to pay fund before 24-4-2018.amount is 200', 'festival', 'yes', 'no', 0, '22:24 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(10, 'fund for ganesh chaturthi', 'all resident requested to pay fund before 24-4-2018.amount is 200', 'festival', 'no', 'yes', 0, '10:24 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(11, 'ganesh chaturthi', 'all resident requested to pay fund before 24-4-2018.amount is 100', 'festival', 'no', 'yes', 1, '10:26 PM', NULL, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(12, 'poll', 'poll to change associative of B wing.', 'poll', 'yes', 'no', 1, '22:28 PM', 19, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(13, 'poll', 'poll to change associative of B wing.', 'poll', 'no', 'yes', 0, '10:28 PM', 19, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(14, 'poll', 'poll to change associative of A wing.', 'poll', 'no', 'yes', 0, '10:34 PM', 19, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(15, 'poll ', 'poll to change associative of A wing.', 'poll', 'yes', 'no', 1, '23:23 PM', 19, '2018-05-22', 'admin', '0000-00-00', '', NULL),
(16, 'poll ', 'poll to change associative of A wing.', 'poll', 'no', 'no', 0, '11:37 PM', 19, '2018-05-22', 'admin', '0000-00-00', 'admin', 'close'),
(17, 'maitenance', 'all resident have to paid their maintace before 23-5-2018.amount is 2000', 'maintanance', 'yes', 'no', 1, '16:47 PM', NULL, '2018-05-23', 'admin', '0000-00-00', '', NULL),
(18, 'maitenance', 'all resident have to paid their maintace before 23-5-2018.amount is 2000', 'maintanance', 'no', 'yes', 1, '04:47 PM', NULL, '2018-05-23', 'admin', '0000-00-00', '', NULL),
(19, 'navratri fund', 'all resident requested to pay fund before 23-4-2018.amount is 200', 'festival', 'yes', 'no', 1, '16:49 PM', NULL, '2018-05-23', 'admin', '0000-00-00', '', NULL),
(20, 'navratri fund', 'all resident requested to pay fund before 23-4-2018.amount is 200', 'festival', 'no', 'yes', 1, '04:49 PM', NULL, '2018-05-23', 'admin', '0000-00-00', '', NULL),
(21, 'poll', 'poll to change admin', 'poll', 'yes', 'no', 1, '12:28 PM', 0, '2018-06-13', 'admin', '0000-00-00', '', NULL),
(22, 'poll', 'poll to change admin', 'poll', 'no', 'no', 0, '01:21 PM', 0, '2018-06-13', 'admin', '2018-06-08', 'admin', 'close');

-- --------------------------------------------------------

--
-- Table structure for table `poll_registration`
--

CREATE TABLE `poll_registration` (
  `poll_registration_id` int(100) NOT NULL,
  `notice_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modifid_by` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_registration`
--

INSERT INTO `poll_registration` (`poll_registration_id`, `notice_id`, `user_id`, `added_on`, `added_by`, `modified_on`, `modifid_by`, `status`) VALUES
(1, 13, 52, '2018-05-22', 'owner', NULL, NULL, 0),
(2, 16, 69, '2018-05-22', 'owner', NULL, NULL, 0),
(5, 16, 52, '2018-05-22', 'owner', NULL, NULL, 0),
(6, 22, 79, '2018-06-13', 'owner', NULL, NULL, 0),
(7, 22, 67, '2018-06-13', 'owner', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_tb`
--

CREATE TABLE `post_tb` (
  `post_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `caption` varchar(100) DEFAULT NULL,
  `pic` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `time` varchar(100) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `likes` bigint(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_tb`
--

INSERT INTO `post_tb` (`post_id`, `user_id`, `caption`, `pic`, `added_on`, `time`, `added_by`, `likes`, `status`) VALUES
(1, 69, 'heelo friend', 'img2.jpg', '2018-05-23', '15:10 PM', 'user', 2, 1),
(2, 71, 'good morning', '17.jpg', '2018-05-23', '15:19 PM', 'user', 2, 1),
(3, 70, 'my new shop opening date : 13/6/2018\r\ntime : 11:00 to 2:00', 'vend9.jpg', '2018-06-13', '07:24 AM', 'user', 1, 1),
(4, 79, 'good morning', 'teammembru-150x150.jpg', '2018-06-13', '13:15 PM', 'user', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_tb`
--

CREATE TABLE `staff_tb` (
  `staff_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile_no` bigint(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `qrcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_tb`
--

INSERT INTO `staff_tb` (`staff_id`, `user_id`, `firstname`, `lastname`, `gender`, `address`, `mobile_no`, `vehicle_no`, `category`, `pic`, `added_on`, `added_by`, `modified_on`, `modified_by`, `status`, `qrcode`) VALUES
(3, 69, 'jenii', 'desaio', 'female', 'surat', 9087654329, 'GH 8 HJ 8760', '', '2.jpg', '2018-05-23', 'owner', '2018-05-23', 'owner', 0, 'jeni-Qrcode47.png'),
(4, 69, 'ravi', 'patel', 'male', 'sagar', 7405028057, 'GH 6 GH 7654', 'Tutor', '6.jpg', '2018-05-26', 'owner', NULL, NULL, 0, 'ravi-Qrcode144.png'),
(5, 69, 'jeni', 'desai', 'female', 'diamond', 7405028057, 'GH 6 GH 7654', 'Tutor', '8.jpg', '2018-05-28', 'owner', NULL, NULL, 0, 'jeni-Qrcode116.png'),
(6, 69, 'jeni', 'desai', 'female', 'bygu', 7405028057, 'GH 6 GH 7654', 'Tutor', '1.jpg', '2018-05-28', 'owner', NULL, NULL, 0, 'jeni-Qrcode60.png'),
(7, 69, 'jeni', 'desai', 'female', 'tfy', 7405028057, 'GH 6 GH 7654', 'Tutor', '1.jpg', '2018-05-28', 'owner', NULL, NULL, 0, 'jeni-Qrcode18.png'),
(8, 69, 'jeni', 'patel', 'female', 'guyg', 7405028057, 'GJ 09 UJ 7650', 'Tutor', '2.jpg', '2018-05-28', 'owner', NULL, NULL, 0, 'jeni-Qrcode38.png'),
(9, 69, 'jeni', 'desai', 'female', 'diamond', 7405028057, 'GJ 09 UJ 7650', 'Tutor', 'Screenshot (4).png', '2018-05-28', 'owner', NULL, NULL, 0, 'jeni-Qrcode153.png'),
(10, 69, 'mira', 'virani', 'female', 'sagar', 7405028057, 'GH 8 HJ 8765', 'Tutor', 'img2.jpg', '2018-05-28', 'owner', NULL, NULL, 0, 'mira-Qrcode148.png'),
(11, 69, 'jeni', 'desai', 'female', 'jhgfd', 7405028059, 'GH 6 GH 7654', 'Tutor', 'img5.jpg', '2018-05-28', 'owner', '2018-05-28', 'owner', 0, 'jeni-Qrcode69.png'),
(12, 69, 'likujhg', 'oiuy', 'female', 'jhgf', 7417417414, 'GH 6 GH 7654', 'Tutor', 'img3.jpg', '2018-05-29', 'owner', NULL, NULL, 0, 'likujhg-Qrcode78.png'),
(13, 82, 'daksha', 'patel', 'female', 'sagar', 7405028057, 'GH 6 GH 7654', 'Dance Teacher', '12.jpg', '2018-06-13', 'owner', NULL, NULL, 1, 'daksha-Qrcode11.png'),
(14, 82, 'mayank', 'patel', 'male', 'gautam', 7405028057, 'GJ 09 UJ 7650', 'Drwaing Teacher', 'a1.jpg', '2018-06-13', 'owner', NULL, NULL, 1, '740502805-Qrcode40.png'),
(15, 82, 'abc', 'xyz', 'female', 'sagar', 7405028057, 'GF 7 HG 7654', 'Psychologist', '1.jpg', '2018-06-13', 'owner', NULL, NULL, 1, 'abc-Qrcode151.png'),
(16, 81, 'savita', 'patel', 'male', 'sagar', 7405028057, 'GH 8 HJ 8765', 'Dance Teacher', '12.jpg', '2018-06-14', 'owner', NULL, NULL, 1, 'savita-Qrcode137.png'),
(17, 70, 'spsir', 'italita', 'male', 'star', 7405028057, 'GH 6 GH 7654', 'Tutor', '5.jpg', '2018-06-16', 'owner', NULL, NULL, 1, 'spsir7405-Qrcode62.png'),
(18, 70, 'nayan', 'italiya', 'male', 'stra', 7405028057, 'GH 6 GH 7654', 'Karate Master', '9.jpg', '2018-06-16', 'owner', NULL, NULL, 1, 'nayan7405-Qrcode154.png');

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `user_id` int(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `age` int(100) DEFAULT NULL,
  `mobile_no` bigint(100) NOT NULL,
  `land_line_no` bigint(100) DEFAULT NULL,
  `wing_id` int(100) DEFAULT NULL,
  `home_id` int(100) DEFAULT NULL,
  `city_id` int(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `pic` varchar(100) NOT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `shift` varchar(100) DEFAULT NULL,
  `is_resident` varchar(100) DEFAULT NULL,
  `owner_id` int(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `status` int(100) NOT NULL,
  `approve_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`user_id`, `firstname`, `lastname`, `username`, `password`, `email`, `gender`, `age`, `mobile_no`, `land_line_no`, `wing_id`, `home_id`, `city_id`, `address`, `pic`, `qualification`, `shift`, `is_resident`, `owner_id`, `added_on`, `added_by`, `modified_on`, `modified_by`, `status`, `approve_status`) VALUES
(47, 'jinal', 'virani', 'jinalvirani', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', NULL, NULL, 7405028057, NULL, 19, NULL, NULL, NULL, '17.jpg', NULL, NULL, NULL, 0, '2018-05-21', 'admin', '2018-06-13', 'admin', 1, 0),
(52, 'raghavbhai', 'kumbhani', 'raghavbhai', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 19, 35, 1, 'kathor', '4.jpg', NULL, NULL, 'no', 0, '2018-05-22', 'owner', '0000-00-00', '', 1, 1),
(55, 'ravi', 'gujrati', '', '', '', NULL, NULL, 7896541222, NULL, 20, NULL, NULL, NULL, '7.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 0, 0),
(56, 'ri', 'ji', '', '', '', NULL, NULL, 7405028057, NULL, 21, NULL, NULL, NULL, '12.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 0, 0),
(57, 'rdgr', 'dthy', '', '', '', NULL, NULL, 7418528585, NULL, 22, NULL, NULL, NULL, '6.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 0, 0),
(58, 'wetef', 'dfg', '', '', '', NULL, NULL, 7945454545, NULL, 21, NULL, NULL, NULL, '9.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 0, 0),
(59, 'rameshbhai', 'vaholiya', '', '', '', NULL, NULL, 7405028057, NULL, 21, NULL, NULL, NULL, '6.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 0, 0),
(60, 'raju', 'kheni', '', '', '', NULL, NULL, 7405028057, NULL, 20, NULL, NULL, NULL, '3.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 1, 0),
(61, 'rajubhai', 'kheni', '', '', '', NULL, NULL, 7405028057, NULL, 21, NULL, NULL, NULL, '16.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 0, 0),
(62, 'rajubhai', 'kheni', '', '', '', NULL, NULL, 7405028057, NULL, 21, NULL, NULL, NULL, '17.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '0000-00-00', '', 1, 0),
(63, 'chaturbhai', 'sojitra', '', '', '', NULL, NULL, 7405028057, NULL, 22, NULL, NULL, NULL, '6.jpg', NULL, NULL, NULL, 0, '2018-05-22', 'admin', '2018-05-22', 'admin', 0, 0),
(64, 'nilu', 'virani', 'niluvirani', 'fcea920f7412b5da7be0cf42b8c93759', 'jinalvirani79@gmail.com', 'male', NULL, 7405028057, NULL, NULL, NULL, NULL, 'tapi darshan', 's.jpg', 'n.c.c', 'night', NULL, 0, '2018-05-22', 'admin', '2018-05-23', 'guard', 1, 0),
(65, 'bharatbhai', 'virani', 'bharatvirani', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', NULL, 7405028057, NULL, NULL, NULL, NULL, 'tapi darshan', '14.jpg', 'n.c.c', 'day', NULL, 0, '2018-05-22', 'admin', '2018-05-22', 'admin', 1, 0),
(66, 'arvindbhai', 'viradiya', 'arvindviradia', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 40, 7405028057, 78965412, 20, 38, 1, 'varachha', 'a1.jpg', NULL, NULL, 'yes', 0, '2018-05-22', 'owner', '0000-00-00', '', 1, 1),
(67, 'prakashbhai', 'vaghasiya', 'pvaghasiya', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 789654123, 20, 37, 1, 'ashokvatika', 'img1.jpg', NULL, NULL, 'yes', 0, '2018-05-22', 'admin', '0000-00-00', '', 1, 1),
(69, 'vishalbhai', 'virani', 'vishalvirani', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 33, 7405028033, 789654122, 19, 36, 1, 'sagar', '2.jpg', NULL, NULL, 'yes', 0, '2018-05-22', 'admin', '2018-06-14', 'admin', 0, 1),
(70, 'harjibhai', 'virani', 'harjibhaiv', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 19, 40, 1, 'sagar', '6.jpg', NULL, NULL, 'yes', 0, '2018-05-22', 'owner', '0000-00-00', '', 1, 1),
(71, 'jivrajbhai', 'patel', 'jivu', 'fcea920f7412b5da7be0cf42b8c93759', 'jinalvirani79@gmail.com', 'male', 54, 7405028057, 78965412, 19, 35, 1, 'kathor', 'a1.jpg', NULL, NULL, 'yes', 52, '2018-05-23', 'owner', '0000-00-00', '', 1, 1),
(72, 'nareshbhai', 'viradiya', 'nareshv', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 20, 38, 1, 'varachha', '4.jpg', NULL, NULL, 'yes', 66, '2018-05-23', 'owner', '0000-00-00', '', 0, 1),
(73, 'narsh', 'viradiya', 'nareshv', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 20, 38, 1, 'varachha', '5.jpg', NULL, NULL, 'yes', 66, '2018-05-23', 'owner', '2018-06-14', 'owner', 0, 1),
(74, 'ji', 'hiu', 'iuh', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 789654122, 19, 36, 1, 'sagar', 'img3.jpg', NULL, NULL, 'yes', 69, '2018-05-29', 'owner', '2018-06-14', 'admin', 0, 1),
(75, 'uh', 'hjb', 'bhjb', 'd41d8cd98f00b204e9800998ecf8427e', 'jinalvirani79@gmail.com', 'male', 45, 7417417474, 789654122, 19, 36, 1, 'sagar', 'img1.jpg', NULL, NULL, 'yes', 69, '2018-05-29', 'owner', '2018-06-14', 'admin', 0, 1),
(76, 'byubgu', 'uihiuh', 'ihi', 'd41d8cd98f00b204e9800998ecf8427e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 789654122, 19, 36, 1, 'sagar', 'img3.jpg', NULL, NULL, 'yes', 69, '2018-05-29', 'owner', '2018-06-14', 'admin', 0, 1),
(77, 'jkhkhk', 'hjhkj', 'nkjhk', '40ce6a28bbcf30127b315d404e3489f6', 'kefyhj@gmail.com', 'male', 98, 9876543212, 789654122, 19, 36, 1, 'sagar', 'g.png', NULL, NULL, 'yes', 69, '2018-05-29', 'owner', '2018-06-14', 'admin', 0, 1),
(78, 'jiujyhfgt', 'jkhvg', 'kljhvgv', 'c282d0a8da328a3a3bb52ab33684dbb2', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 789654122, 19, 36, 1, 'sagar', 'Screenshot (6).png', NULL, NULL, 'yes', 69, '2018-05-29', 'owner', '2018-06-14', 'admin', 0, 1),
(79, 'aambabhai', 'virani', 'avirani', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 22, 38, 1, 'sagar', '6.jpg', NULL, NULL, 'yes', 0, '2018-06-13', 'owner', '0000-00-00', '', 1, 1),
(81, 'vinubhai', 'virani', 'vinubhai', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74125474, 23, 43, 1, 'sagar', '7.jpg', NULL, NULL, 'yes', 0, '2018-06-13', 'owner', '0000-00-00', '', 1, 1),
(82, 'pari', 'patel', 'paripatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'female', 45, 7405028057, 74125474, 23, 43, 1, 'sagar', '1.jpg', NULL, NULL, 'yes', 81, '2018-06-13', 'owner', '2018-06-14', '', 0, 1),
(83, 'yash', 'patel', 'yeshpatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74174174, 23, 44, 1, 'sagar', '1.jpg', NULL, NULL, 'yes', 0, '2018-06-13', 'owner', '2018-06-14', 'admin', 0, 1),
(84, 'rahi', 'patel', 'rahipatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74128874, 23, 45, 1, 'sagar', '8.jpg', NULL, NULL, 'yes', 0, '2018-06-13', 'owner', '0000-00-00', '', 1, 1),
(85, 'pari', 'patel', 'paripatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74125474, 23, 43, 1, 'sagar', '1.jpg', NULL, NULL, 'yes', 81, '2018-06-14', 'owner', '2018-06-14', '', 0, 1),
(86, 'pari', 'patel', 'paripatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74125474, 23, 43, 1, 'sagar', '9.jpg', NULL, NULL, 'yes', 81, '2018-06-14', 'owner', '2018-06-14', '', 0, 1),
(87, 'pari', 'patel', 'paripatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74125474, 23, 43, 1, 'sagar', '1.jpg', NULL, NULL, 'yes', 81, '2018-06-14', 'owner', '2018-06-14', '', 0, 1),
(88, 'pari', 'patel', 'paripatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7417417474, 74125474, 23, 43, 1, 'sagar', '15.jpg', NULL, NULL, 'yes', 81, '2018-06-14', 'owner', '2018-06-14', 'owner', 0, 1),
(89, 'rami', 'patel', 'ramipatel', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 74125474, 23, 43, 1, 'sagar', '4.jpg', NULL, NULL, 'yes', 81, '2018-06-14', 'owner', '2018-06-14', 'owner', 0, 1),
(90, 'k', 'V', 'K', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 20, 38, 1, 'varachha', '1.jpg', NULL, NULL, 'yes', 66, '2018-06-14', 'owner', '2018-06-14', 'owner', 0, 1),
(91, 'kk', 'vv', 'kk', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 20, 38, 1, 'varachha', '1.jpg', NULL, NULL, 'yes', 66, '2018-06-14', 'owner', '2018-06-14', 'owner', 0, 1),
(93, 'hansa', 'virani', 'hansavirani', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7405028057, 78965412, 19, 40, 1, 'sagar', '1.jpg', NULL, NULL, 'yes', 70, '2018-06-15', 'owner', '2018-06-15', 'owner', 0, 1),
(94, 'g', 'g', 'g', 'e10adc3949ba59abbe56e057f20f883e', 'jinalvirani79@gmail.com', 'male', 45, 7417417474, 78965412, 20, 38, 1, 'varachha', '1.jpg', NULL, NULL, 'yes', 66, '2018-06-15', 'owner', '2018-06-15', 'owner', 0, 1),
(95, 'keyan', 'virani', '', '', '', NULL, NULL, 7405028057, NULL, 22, NULL, NULL, NULL, '4.jpg', NULL, NULL, NULL, 0, '2018-06-16', 'admin', '0000-00-00', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype_tb`
--

CREATE TABLE `usertype_tb` (
  `usertype_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype_tb`
--

INSERT INTO `usertype_tb` (`usertype_id`, `user_id`, `user_type`, `added_on`, `added_by`, `modified_on`, `modified_by`) VALUES
(47, 47, 'admin', '2018-05-21', 'admin', '2018-05-21', 'admin'),
(52, 52, 'owner', '2018-05-22', 'owner', NULL, NULL),
(55, 55, 'associative', '2018-05-22', 'admin', NULL, NULL),
(56, 56, 'associative', '2018-05-22', 'admin', NULL, NULL),
(57, 57, 'associative', '2018-05-22', 'admin', NULL, NULL),
(58, 58, 'associative', '2018-05-22', 'admin', NULL, NULL),
(59, 59, 'associative', '2018-05-22', 'admin', NULL, NULL),
(60, 60, 'associative', '2018-05-22', 'admin', NULL, NULL),
(61, 61, 'associative', '2018-05-22', 'admin', NULL, NULL),
(62, 62, 'associative', '2018-05-22', 'admin', NULL, NULL),
(63, 63, 'associative', '2018-05-22', 'admin', '2018-05-22', 'admin'),
(64, 64, 'securityguard', '2018-05-22', 'admin', '2018-05-22', 'admin'),
(65, 65, 'securityguard', '2018-05-22', 'admin', '2018-05-22', 'admin'),
(66, 66, 'owner', '2018-05-22', 'owner', NULL, NULL),
(67, 67, 'owner', '2018-05-22', 'admin', NULL, NULL),
(69, 69, 'owner', '2018-05-22', 'admin', NULL, NULL),
(70, 70, 'owner', '2018-05-22', 'owner', NULL, NULL),
(71, 71, 'tenant', '2018-05-23', 'owner', NULL, NULL),
(72, 72, 'tenant', '2018-05-23', 'owner', NULL, NULL),
(73, 73, 'tenant', '2018-05-23', 'owner', NULL, NULL),
(74, 74, 'tenant', '2018-05-29', 'owner', NULL, NULL),
(75, 75, 'tenant', '2018-05-29', 'owner', NULL, NULL),
(76, 76, 'tenant', '2018-05-29', 'owner', NULL, NULL),
(77, 77, 'tenant', '2018-05-29', 'owner', NULL, NULL),
(78, 78, 'tenant', '2018-05-29', 'owner', NULL, NULL),
(79, 79, 'owner', '2018-06-13', 'owner', NULL, NULL),
(81, 81, 'owner', '2018-06-13', 'owner', NULL, NULL),
(82, 82, 'tenant', '2018-06-13', 'owner', NULL, NULL),
(83, 83, 'owner', '2018-06-13', 'owner', NULL, NULL),
(84, 84, 'owner', '2018-06-13', 'owner', NULL, NULL),
(85, 85, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(86, 86, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(87, 87, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(88, 88, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(89, 89, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(90, 90, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(91, 91, 'tenant', '2018-06-14', 'owner', NULL, NULL),
(93, 93, 'tenant', '2018-06-15', 'owner', NULL, NULL),
(94, 94, 'tenant', '2018-06-15', 'owner', NULL, NULL),
(95, 95, 'associative', '2018-06-16', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tb`
--

CREATE TABLE `vehicle_tb` (
  `vehicle_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `vehicle_type` varchar(100) NOT NULL,
  `slot_no` varchar(100) NOT NULL,
  `sticker_no` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_tb`
--

INSERT INTO `vehicle_tb` (`vehicle_id`, `user_id`, `vehicle_no`, `vehicle_type`, `slot_no`, `sticker_no`, `added_on`, `added_by`, `modified_on`, `modified_by`, `status`) VALUES
(66, 70, 'GH 6 GH 7654', '2-wheeler', 'A-2', 'A-2', '2018-06-16', 'owner', NULL, NULL, 0),
(67, 70, 'GH 6 GH 7654', '2-wheeler', 'A-3', 'A-3', '2018-06-16', 'owner', NULL, NULL, 0),
(68, 70, 'GH 6 GH 7654', '2-wheeler', 'A-1', 'A-1', '2018-06-16', 'owner', NULL, NULL, 1),
(69, 66, 'GH 6 GH 7654', '2-wheeler', 'B-1', 'B-1', '2018-06-16', 'owner', NULL, NULL, 1),
(70, 66, 'GH 6 GH 7654', '2-wheeler', 'B-2', 'B-2', '2018-06-16', 'owner', NULL, NULL, 1),
(72, 66, 'GH 6 GH 7654', '4-wheeler', 'BB-2', 'BB-2', '2018-06-16', 'owner', NULL, NULL, 1),
(73, 66, 'GH 6 GH 7654', '4-wheeler', 'BB-1', 'BB-1', '2018-06-16', 'owner', NULL, NULL, 0),
(74, 70, 'GH 6 GH 7654', '4-wheeler', 'AA-1', 'AA-1', '2018-06-16', 'owner', NULL, NULL, 1),
(75, 70, 'GH 6 GH 7654', '4-wheeler', 'AA-2', 'AA-2', '2018-06-16', 'owner', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vender_tb`
--

CREATE TABLE `vender_tb` (
  `vender_id` int(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `vender_name` varchar(100) NOT NULL,
  `mobile_no` bigint(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vender_tb`
--

INSERT INTO `vender_tb` (`vender_id`, `service_name`, `vender_name`, `mobile_no`, `address`, `pic`, `added_on`, `added_by`, `modified_on`, `modified_by`, `status`) VALUES
(9, 'carpenterr', 'rajurastogii', 7896541237, 'varachha', '6.jpg', '2018-05-21', 'admin', '2018-05-21', 'admin', 1),
(10, 'old paper recycler', 'sai ram pasti bhandar', 7405028057, 'gautam park', 'vend5.jpg', '2018-05-22', 'admin', '2018-05-22', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `visiter_tb`
--

CREATE TABLE `visiter_tb` (
  `visiter_id` int(100) NOT NULL,
  `staff_id` int(100) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `wing_id` int(100) DEFAULT NULL,
  `home_id` int(100) DEFAULT NULL,
  `mobile_no` bigint(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `vehicle_no` varchar(100) NOT NULL,
  `in_time` varchar(100) NOT NULL,
  `out_time` varchar(100) DEFAULT NULL,
  `out_date` date NOT NULL,
  `enter_by` int(100) NOT NULL,
  `in_out_status` int(1) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visiter_tb`
--

INSERT INTO `visiter_tb` (`visiter_id`, `staff_id`, `firstname`, `lastname`, `address`, `wing_id`, `home_id`, `mobile_no`, `pic`, `vehicle_no`, `in_time`, `out_time`, `out_date`, `enter_by`, `in_out_status`, `added_on`, `added_by`) VALUES
(2, 3, '', '', '', NULL, NULL, 0, '', '', '03:09 PM', '03:09 PM', '2018-05-23', 64, 0, '2018-05-23', 'guard'),
(4, 15, '', '', '', NULL, NULL, 0, '', '', '01:32 PM', '01:33 PM', '2018-06-13', 64, 0, '2018-06-13', 'guard'),
(5, 16, '', '', '', NULL, NULL, 0, '', '', '05:09 PM', NULL, '0000-00-00', 64, 1, '2018-06-14', 'guard'),
(6, 5, '', '', '', NULL, NULL, 0, '', '', '05:59 PM', '06:00 PM', '2018-06-15', 64, 0, '2018-06-15', 'guard');

-- --------------------------------------------------------

--
-- Table structure for table `vote_tb`
--

CREATE TABLE `vote_tb` (
  `vote_id` int(100) NOT NULL,
  `notice_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `given_vote` int(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vote_tb`
--

INSERT INTO `vote_tb` (`vote_id`, `notice_id`, `user_id`, `given_vote`, `added_on`, `added_by`, `status`) VALUES
(1, 16, 70, 69, '2018-05-22', 'owner', 0),
(2, 16, 52, 52, '2018-05-22', 'owner', 0),
(3, 16, 69, 52, '2018-05-22', 'owner', 0),
(4, 22, 67, 67, '2018-06-13', 'owner', 0),
(5, 22, 79, 67, '2018-06-13', 'owner', 0),
(6, 22, 82, 79, '2018-06-13', 'owner', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wing_tb`
--

CREATE TABLE `wing_tb` (
  `wing_id` int(100) NOT NULL,
  `wing_name` varchar(100) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wing_tb`
--

INSERT INTO `wing_tb` (`wing_id`, `wing_name`, `added_on`, `added_by`, `status`) VALUES
(19, 'A', '2018-05-21', 'admin', 1),
(20, 'B', '2018-05-21', 'admin', 1),
(21, 'C', '2018-05-21', 'admin', 1),
(22, 'D', '2018-05-22', 'admin', 1),
(23, 'E', '2018-06-13', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookfacility_tb`
--
ALTER TABLE `bookfacility_tb`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `city_tb`
--
ALTER TABLE `city_tb`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `expense_tb`
--
ALTER TABLE `expense_tb`
  ADD PRIMARY KEY (`expense_revenue_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `facility_tb`
--
ALTER TABLE `facility_tb`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `home_tb`
--
ALTER TABLE `home_tb`
  ADD PRIMARY KEY (`home_id`),
  ADD KEY `wing_id` (`wing_id`);

--
-- Indexes for table `issue_tb`
--
ALTER TABLE `issue_tb`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `like_tb`
--
ALTER TABLE `like_tb`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `maintanance_tb`
--
ALTER TABLE `maintanance_tb`
  ADD PRIMARY KEY (`maintanance_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `member_tb`
--
ALTER TABLE `member_tb`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notice_tb`
--
ALTER TABLE `notice_tb`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `poll_registration`
--
ALTER TABLE `poll_registration`
  ADD PRIMARY KEY (`poll_registration_id`),
  ADD KEY `poll_id` (`notice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_tb`
--
ALTER TABLE `post_tb`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `staff_tb`
--
ALTER TABLE `staff_tb`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `wing_id` (`wing_id`),
  ADD KEY `home_id` (`home_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `usertype_tb`
--
ALTER TABLE `usertype_tb`
  ADD PRIMARY KEY (`usertype_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vehicle_tb`
--
ALTER TABLE `vehicle_tb`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vender_tb`
--
ALTER TABLE `vender_tb`
  ADD PRIMARY KEY (`vender_id`);

--
-- Indexes for table `visiter_tb`
--
ALTER TABLE `visiter_tb`
  ADD PRIMARY KEY (`visiter_id`),
  ADD KEY `wing_id` (`wing_id`),
  ADD KEY `home_id` (`home_id`),
  ADD KEY `enter_by` (`enter_by`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `vote_tb`
--
ALTER TABLE `vote_tb`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `notice_id` (`notice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wing_tb`
--
ALTER TABLE `wing_tb`
  ADD PRIMARY KEY (`wing_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookfacility_tb`
--
ALTER TABLE `bookfacility_tb`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `city_tb`
--
ALTER TABLE `city_tb`
  MODIFY `city_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expense_tb`
--
ALTER TABLE `expense_tb`
  MODIFY `expense_revenue_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `facility_tb`
--
ALTER TABLE `facility_tb`
  MODIFY `facility_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `home_tb`
--
ALTER TABLE `home_tb`
  MODIFY `home_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `issue_tb`
--
ALTER TABLE `issue_tb`
  MODIFY `issue_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `like_tb`
--
ALTER TABLE `like_tb`
  MODIFY `like_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `maintanance_tb`
--
ALTER TABLE `maintanance_tb`
  MODIFY `maintanance_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `member_tb`
--
ALTER TABLE `member_tb`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `notice_tb`
--
ALTER TABLE `notice_tb`
  MODIFY `notice_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `poll_registration`
--
ALTER TABLE `poll_registration`
  MODIFY `poll_registration_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `post_tb`
--
ALTER TABLE `post_tb`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staff_tb`
--
ALTER TABLE `staff_tb`
  MODIFY `staff_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `usertype_tb`
--
ALTER TABLE `usertype_tb`
  MODIFY `usertype_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `vehicle_tb`
--
ALTER TABLE `vehicle_tb`
  MODIFY `vehicle_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `vender_tb`
--
ALTER TABLE `vender_tb`
  MODIFY `vender_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `visiter_tb`
--
ALTER TABLE `visiter_tb`
  MODIFY `visiter_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vote_tb`
--
ALTER TABLE `vote_tb`
  MODIFY `vote_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wing_tb`
--
ALTER TABLE `wing_tb`
  MODIFY `wing_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookfacility_tb`
--
ALTER TABLE `bookfacility_tb`
  ADD CONSTRAINT `bookfacility_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookfacility_tb_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facility_tb` (`facility_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense_tb`
--
ALTER TABLE `expense_tb`
  ADD CONSTRAINT `expense_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `home_tb`
--
ALTER TABLE `home_tb`
  ADD CONSTRAINT `home_tb_ibfk_1` FOREIGN KEY (`wing_id`) REFERENCES `wing_tb` (`wing_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue_tb`
--
ALTER TABLE `issue_tb`
  ADD CONSTRAINT `issue_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_tb`
--
ALTER TABLE `like_tb`
  ADD CONSTRAINT `like_tb_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post_tb` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_tb_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintanance_tb`
--
ALTER TABLE `maintanance_tb`
  ADD CONSTRAINT `maintanance_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_tb`
--
ALTER TABLE `member_tb`
  ADD CONSTRAINT `member_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poll_registration`
--
ALTER TABLE `poll_registration`
  ADD CONSTRAINT `poll_registration_ibfk_1` FOREIGN KEY (`notice_id`) REFERENCES `notice_tb` (`notice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poll_registration_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_tb`
--
ALTER TABLE `post_tb`
  ADD CONSTRAINT `post_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_tb`
--
ALTER TABLE `staff_tb`
  ADD CONSTRAINT `staff_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD CONSTRAINT `users_tb_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city_tb` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_tb_ibfk_2` FOREIGN KEY (`wing_id`) REFERENCES `wing_tb` (`wing_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_tb_ibfk_3` FOREIGN KEY (`home_id`) REFERENCES `home_tb` (`home_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usertype_tb`
--
ALTER TABLE `usertype_tb`
  ADD CONSTRAINT `usertype_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicle_tb`
--
ALTER TABLE `vehicle_tb`
  ADD CONSTRAINT `vehicle_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visiter_tb`
--
ALTER TABLE `visiter_tb`
  ADD CONSTRAINT `visiter_tb_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_tb` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visiter_tb_ibfk_2` FOREIGN KEY (`wing_id`) REFERENCES `wing_tb` (`wing_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visiter_tb_ibfk_3` FOREIGN KEY (`home_id`) REFERENCES `home_tb` (`home_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visiter_tb_ibfk_4` FOREIGN KEY (`enter_by`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote_tb`
--
ALTER TABLE `vote_tb`
  ADD CONSTRAINT `vote_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_tb_ibfk_2` FOREIGN KEY (`notice_id`) REFERENCES `notice_tb` (`notice_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
