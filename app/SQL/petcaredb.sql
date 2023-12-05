-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 30, 2023 at 04:02 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petcaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `petcare_appointments`
--

DROP TABLE IF EXISTS `petcare_appointments`;
CREATE TABLE IF NOT EXISTS `petcare_appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pet_id` int DEFAULT NULL,
  `petowner_id` int DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_type` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Confirmed',
  `vet_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pet_id` (`pet_id`),
  KEY `petowner_id` (`petowner_id`),
  KEY `fk_petcare_appointments_vet` (`vet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_appointments`
--

INSERT INTO `petcare_appointments` (`id`, `pet_id`, `petowner_id`, `appointment_date`, `appointment_time`, `appointment_type`, `status`, `vet_id`) VALUES
(1, 1, 16, '2023-11-18', '09:00:00', 'Vaccination', 'Completed', 2),
(2, 2, 18, '2023-11-18', '10:30:00', 'Checkup', 'Confirmed', 2),
(3, 3, 20, '2023-11-19', '11:15:00', 'Grooming', 'Confirmed', 28),
(4, 5, 16, '2023-11-20', '14:00:00', 'Surgery', 'Reshedule', 28),
(5, 4, 23, '2023-11-20', '15:30:00', 'Dental Cleaning', 'Confirmed', 2),
(6, 5, 16, '2023-11-20', '18:30:00', 'Surgery', 'Confirmed', 2);

-- --------------------------------------------------------

--
-- Table structure for table `petcare_inventory`
--

DROP TABLE IF EXISTS `petcare_inventory`;
CREATE TABLE IF NOT EXISTS `petcare_inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `stock` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_inventory`
--

INSERT INTO `petcare_inventory` (`id`, `name`, `brand`, `category`, `stock`, `price`) VALUES
(1, 'Royal Canin Medium', 'Royal Canin', 'Food', 20, '390.00'),
(2, 'Greenies', 'Green', 'Treats', 5, '500.00'),
(3, 'Kong Toy', 'Kong', 'Toys', 1, '1500.00'),
(4, 'Nylabone Bone', 'Nylabone', 'Toys', 3, '70.00'),
(11, 'Frontline Plus', 'Frontline', 'Accessories', 20, '250.00'),
(20, 'ABCD', 'ABCD', 'Food', 6, '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `petcare_pet`
--

DROP TABLE IF EXISTS `petcare_pet`;
CREATE TABLE IF NOT EXISTS `petcare_pet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pet` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `breed` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `species` varchar(255) NOT NULL,
  `profileImage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `petowner_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_petcare_pet_petowner` (`petowner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_pet`
--

INSERT INTO `petcare_pet` (`id`, `pet`, `DOB`, `breed`, `sex`, `age`, `species`, `profileImage`, `petowner_id`) VALUES
(1, 'Rocky', '2023-06-01', 'Golden Retriever', 'Male', 5, 'Dog', 'pet1.png', 16),
(2, 'Rex', '2023-01-01', 'Golden Retriever', 'Male', 1, 'Dog', 'pet2.png', 19),
(3, 'Garfield', '2023-02-02', 'Maine Coon', 'Female', 2, 'Cat', 'pet3.png', 19),
(4, 'Kitty', '2023-03-03', 'Netherland Dwarf', 'Male', 3, 'Cat', 'pet4.png', 19),
(5, 'Oreo', '2023-04-04', 'Syrian', 'Female', 4, 'Dog', 'pet5.png', 16);

-- --------------------------------------------------------

--
-- Table structure for table `petcare_petowner`
--

DROP TABLE IF EXISTS `petcare_petowner`;
CREATE TABLE IF NOT EXISTS `petcare_petowner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_petowner`
--

INSERT INTO `petcare_petowner` (`id`, `first_name`, `last_name`, `address`, `mobile`, `email`, `password`, `profileImage`) VALUES
(16, 'John', 'Carter', 'Colombo', '771234567', 'johncarter@petcare.com', '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'nopic.png'),
(18, 'Abdulla', 'Abdulla', 'Colombo', '771234566', 'abdulla@petcare.com', '$2y$10$mtHH2aWdi0FfUlNcSXzHAeglp44Tf.mFxe077cekobzpHVbVt4iKa', 'user1.jpg'),
(19, 'Tharindu', 'Liyanage', 'Colombo', '773135268', 'tharindu@petcare.com', '$2y$10$mtHH2aWdi0FfUlNcSXzHAeglp44Tf.mFxe077cekobzpHVbVt4iKa', 'user4.jpeg'),
(20, 'Sanandi', 'Sithumya', 'Colombo', '771234567', 'sanandi@petcare.com', '$2y$10$jrQpvB7iUVgAsVfHGb.UNuiv5AdSGP/LqnoEtLCdn.2Q5MrwPfvki', 'user2.jpeg'),
(23, 'Tharindu', 'Liyanage', NULL, '773135261', 'test123@gmail.com', '$2y$10$aYkTnBxdtxKnH7oFS4TS/O5YG.RqUscyPIeckJMEyiMsgzuHjALoS', 'user1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petcare_staff`
--

DROP TABLE IF EXISTS `petcare_staff`;
CREATE TABLE IF NOT EXISTS `petcare_staff` (
  `StaffID` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `certification` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `licensenumber` varchar(50) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_staff`
--

INSERT INTO `petcare_staff` (`StaffID`, `firstname`, `lastname`, `email`, `phone`, `role`, `certification`, `specialization`, `licensenumber`, `salary`, `password`, `profileImage`, `address`) VALUES
(1, 'John', 'Doe', 'nurse@petcare.com', '123-456-7890', 'Nurse', NULL, NULL, NULL, '80000.00', '$2y$10$Nh/fSgrikdShuCVN7TEJFO5RbEySeq6ivx6Ct07jyHpvcO7fO9ItS', 'user1.jpg', '123 Main St, Los Angeles, CA 90001'),
(2, 'Jane', 'Smith', 'doctor@petcare.com', '741234567', 'Doctor', NULL, NULL, NULL, '60000.00', '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user2.jpeg', '456 Elm St, New York, NY 10001'),
(3, 'Mike', 'Johnson', 'assistant@petcare.com', '555-123-4567', 'Assistant', NULL, NULL, NULL, '45000.00', '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user3.jpeg', '789 Oak St, Chicago, IL 60007'),
(4, 'Jason', 'Brown', 'storemanager@petcare.com', '444-789-1234', 'Store Manager', NULL, NULL, NULL, '55000.00', '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user4.jpeg', '111 Pine St, Seattle, WA 98101'),
(21, 'Tharindu', 'Liyanage', 'admin@petcare.com', '773135268', 'Admin', NULL, NULL, NULL, NULL, '$2y$10$4bEVxjMxMX5eZRs.GNnWMOpeYTJj9lZEy1voZ1.pbV43iSE8hBdey', 'nopic.png', 'adaddd'),
(27, 'Ann', 'Lee', 'anna@petcare2.com', '777777777', 'Assistant', NULL, NULL, NULL, NULL, '$2y$10$lVgJmAbECCA9WdNkCxB1m..oEGl4.526yASPOnHCvstlfKSiwJh9e', 'nopic.png', 'addwd'),
(28, 'Anna', 'Marie', 'anjjjna@petcare2.com', '777777776', 'Doctor', NULL, NULL, NULL, NULL, '$2y$10$NPW66ryypE4pVVHuqB4CY.3RLc/Hj7JaCWkGFFc2jzKei20U8K9T.', 'user5.jpeg', 'addwd');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
