-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2018 at 05:58 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_Maryam_Alwash_php_car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_model` varchar(100) DEFAULT NULL,
  `car_color` varchar(100) DEFAULT NULL,
  `car_year` int(11) DEFAULT NULL,
  `fk_office_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_model`, `car_color`, `car_year`, `fk_office_id`) VALUES
(1, 'BMW', 'red', 2010, 3),
(2, 'vw', 'black', 2017, 3),
(3, 'audi', 'white', 2015, 4),
(4, 'Jeep', 'gray', 2018, 4),
(5, 'Hyundai', 'black', 2015, 2),
(6, 'Ferrari', 'green', 2016, 2),
(7, 'GMC', 'red', 2013, 1),
(8, 'KIA', 'blue', 2018, 1),
(9, 'Mercedes', 'red', 2014, 1),
(10, 'Jaguar', 'brown', 2018, 2),
(11, 'Nissan', 'black', 2017, 3),
(12, 'Toyota', 'blue', 2016, 4);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(100) DEFAULT NULL,
  `cust_email` varchar(200) DEFAULT NULL,
  `cust_password` varchar(400) DEFAULT NULL,
  `cust_number` int(11) DEFAULT NULL,
  `cust_age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_password`, `cust_number`, `cust_age`) VALUES
(1, 'Maryam Alwash', 'maryamalwash@yahoo.com', 'Maryam19', 660121314, 19),
(9, 'sameh', 'shahinsameh1000@yahoo.com', 'Meandonlyme1', 1234567876, 19),
(10, 'sss', 'sss@sss.com', '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e', 1234567, 20),
(11, 'mmm', 'mmm@mmm.com', '4a3060bc175997e46ebe57224fb3d7477e3f6a71984c1dc980e5abaff5b9dd4e', 22445566, 19),
(12, 'Admin', 'admin@admin.com', '0afb00138d8e73348ec1fe41fd3d3a8fcbd90156b263bfa5791ba0e095f42cfc', 12345678, 19);

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`office_id`, `office_location`) VALUES
(1, 'Landstrasse-Hauptstrasse  1/1'),
(2, 'Kaertner Ring 1'),
(3, 'karlsplatz 11'),
(4, 'kettenbrückengasse 20');

-- --------------------------------------------------------

--
-- Table structure for table `rented_cars`
--

CREATE TABLE `rented_cars` (
  `rented_car_id` int(11) NOT NULL,
  `fk_car_id` int(11) DEFAULT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `rented_car_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rented_cars`
--

INSERT INTO `rented_cars` (`rented_car_id`, `fk_car_id`, `fk_cust_id`, `rented_car_location`) VALUES
(1, 3, 1, 'karlsplaz 122'),
(2, 1, 1, 'baumgarten 130'),
(3, 6, 11, 'mariahilferstrasse 12,1060'),
(4, 7, 9, 'burggasse 24, 1070'),
(5, 12, 10, 'meidling 123,1120'),
(6, 4, 11, 'Johnstrasse 145,1050');

-- --------------------------------------------------------

--
-- Table structure for table `retun`
--

CREATE TABLE `retun` (
  `return_id` int(11) NOT NULL,
  `fk_cust_id` int(11) DEFAULT NULL,
  `fk_car_id` int(11) DEFAULT NULL,
  `fk_office_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `retun`
--

INSERT INTO `retun` (`return_id`, `fk_cust_id`, `fk_car_id`, `fk_office_id`) VALUES
(1, 1, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_office_id` (`fk_office_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `rented_cars`
--
ALTER TABLE `rented_cars`
  ADD PRIMARY KEY (`rented_car_id`),
  ADD KEY `fk_car_id` (`fk_car_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`);

--
-- Indexes for table `retun`
--
ALTER TABLE `retun`
  ADD PRIMARY KEY (`return_id`),
  ADD KEY `fk_car_id` (`fk_car_id`),
  ADD KEY `fk_cust_id` (`fk_cust_id`),
  ADD KEY `fk_office_id` (`fk_office_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rented_cars`
--
ALTER TABLE `rented_cars`
  MODIFY `rented_car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `retun`
--
ALTER TABLE `retun`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`);

--
-- Constraints for table `rented_cars`
--
ALTER TABLE `rented_cars`
  ADD CONSTRAINT `rented_cars_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `rented_cars_ibfk_2` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`);

--
-- Constraints for table `retun`
--
ALTER TABLE `retun`
  ADD CONSTRAINT `retun_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `retun_ibfk_2` FOREIGN KEY (`fk_cust_id`) REFERENCES `customer` (`cust_id`),
  ADD CONSTRAINT `retun_ibfk_3` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
