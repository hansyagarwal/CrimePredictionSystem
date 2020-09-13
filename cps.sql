-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2018 at 01:40 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `firstname`, `middlename`, `lastname`) VALUES
(2, 'admin', 'admin', 'Administrator', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `fir`
--

CREATE TABLE IF NOT EXISTS `fir` (
  `fir_no` varchar(4) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `middlename` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `birthdate` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `crime_type` varchar(30) NOT NULL,
  `crime_area` varchar(30) NOT NULL,
  `crime_date` varchar(30) NOT NULL,
  `crime_period` varchar(25) NOT NULL,
  `crime_time` varchar(30) NOT NULL,
  `man` int(2) NOT NULL,
  `woman` int(2) NOT NULL,
  `total` int(2) NOT NULL,
  PRIMARY KEY (`fir_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fir`
--

INSERT INTO `fir` (`fir_no`, `firstname`, `middlename`, `lastname`, `birthdate`, `age`, `address`, `gender`, `crime_type`, `crime_area`, `crime_date`, `crime_period`, `crime_time`, `man`, `woman`, `total`) VALUES
('1', 'Akshar', 'L', 'Muley', '04/01/1966', 34, 'Sayajipura', 'Male', 'Pick Pocketing', 'Mandvi', '01/01/2017', 'Afternoon', '2:30 PM', 2, 0, 2),
('2', 'Mahesh', 'A', 'Makwana', '03/05/1972', 36, 'Mandvi', 'Male', 'Murder', 'Mandvi', '06/04/2017', 'Night', '10.45 PM', 2, 1, 3),
('3', 'Lata', 'P', 'Patel', '04/06/1995', 25, 'Fatehgunj', 'Female', 'Chain Snatching', 'Chhani', '05/15/2018', 'Afternoon', '3.00 PM', 2, 0, 2),
('4', 'Mina', 'M', 'Suthar', '05/04/1971', 29, 'Jalesar', 'Female', 'Chain Snatching', 'Mandvi', '05/16/2018', 'Afternoon', '3.00 PM', 2, 0, 2),
('5', 'Seema', 'L', 'Joshi', '02/03/1971', 46, 'Fatehgunj', 'Female', 'Murder', 'Mandvi', '06/06/2018', 'Night', '11:00 PM', 3, 0, 3),
('6', 'Hima', '', 'Shah', '05/11/1974', 40, 'Kalol', 'Female', 'Chain Snatching', 'Chhani', '07/07/2018', 'Afternoon', '3.00 PM', 2, 0, 2),
('7', 'Nisha', '', 'Patel', '04/05/2018', 25, 'Fatehgunj', 'Female', 'Eve Teasing', 'Alkapuri', '01/01/2018', 'Evening', '6:30 PM', 4, 0, 4),
('8', 'Rajesh', 'Kumar', 'Sharma', '02/03/1980', 50, 'Freeganj', 'Male', 'Vehicle Theft', 'Waghodiya', '10/25/2017', 'Afternoon', '2:00 AM', 1, 1, 2),
('9', 'Ramesh', 'A', 'Shah', '03/15/1980', 40, 'Alkapuri', 'Male', 'Road Raze', 'Akota', '02/06/2018', 'Evening', '6:00 PM', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainingset`
--

CREATE TABLE IF NOT EXISTS `trainingset` (
  `S_NO` int(11) NOT NULL AUTO_INCREMENT,
  `document` text,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S_NO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `trainingset`
--

INSERT INTO `trainingset` (`S_NO`, `document`, `category`) VALUES
(120, 'Afternoon Mandvi man', 'Pick Pocketing'),
(121, 'Night Mandvi man', 'Murder'),
(122, 'Afternoon Chhani woman', 'Chain Snatching'),
(123, 'Afternoon Mandvi woman', 'Chain Snatching'),
(124, 'Night Mandvi woman', 'Murder'),
(125, 'Afternoon Chhani woman', 'Chain Snatching'),
(126, 'Evening Alkapuri woman', 'Eve Teasing'),
(127, 'Afternoon Waghodiya man', 'Vehicle Theft'),
(128, 'Evening Akota man', 'Road Raze');

-- --------------------------------------------------------

--
-- Table structure for table `wordfrequency`
--

CREATE TABLE IF NOT EXISTS `wordfrequency` (
  `S_NO` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`S_NO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `wordfrequency`
--

INSERT INTO `wordfrequency` (`S_NO`, `word`, `count`, `category`) VALUES
(58, 'afternoon', 3, 'Pick Pocketing'),
(59, 'mandvi', 2, 'Pick Pocketing'),
(60, 'man', 1, 'Pick Pocketing'),
(61, 'night', 2, 'Murder'),
(62, 'mandvi', 2, 'Murder'),
(63, 'man', 1, 'Murder'),
(64, 'afternoon', 3, 'Chain Snatching'),
(65, 'chhani', 2, 'Chain Snatching'),
(66, 'woman', 3, 'Chain Snatching'),
(67, 'mandvi', 2, 'Chain Snatching'),
(68, 'woman', 2, 'Murder'),
(69, 'evening', 1, 'Eve Teasing'),
(70, 'alkapuri', 1, 'Eve Teasing'),
(71, 'woman', 1, 'Eve Teasing'),
(72, 'afternoon', 1, 'Vehicle Theft'),
(73, 'waghodiya', 1, 'Vehicle Theft'),
(74, 'man', 1, 'Vehicle Theft'),
(75, 'evening', 1, 'Road Raze'),
(76, 'akota', 1, 'Road Raze'),
(77, 'man', 1, 'Road Raze');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
