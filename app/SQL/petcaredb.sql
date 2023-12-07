-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2023 at 07:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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

CREATE TABLE `petcare_appointments` (
  `id` int(11) NOT NULL,
  `appointment_id` varchar(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `petowner_id` int(11) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `appointment_type` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Confirmed',
  `vet_id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_appointments`
--

INSERT INTO `petcare_appointments` (`id`, `appointment_id`, `pet_id`, `petowner_id`, `appointment_date`, `appointment_time`, `appointment_type`, `status`, `vet_id`) VALUES
(1, 'AID-001', 1, 16, '2023-11-18', '09:00:00', 'Vaccination', 'Completed', '30'),
(2, 'AID-002', 2, 18, '2023-11-18', '10:30:00', 'Checkup', 'Confirmed', '35'),
(3, 'AID-003', 3, 20, '2023-11-19', '11:15:00', 'Grooming', 'Confirmed', '30'),
(4, 'AID-004', 5, 16, '2023-11-20', '14:00:00', 'Surgery', 'Reshedule', '35'),
(5, 'AID-005', 4, 23, '2023-11-20', '15:30:00', 'Dental Cleaning', 'Confirmed', '30'),
(6, 'AID-006', 5, 16, '2023-11-20', '18:30:00', 'Surgery', 'Confirmed', '35');

--
-- Triggers `petcare_appointments`
--
DELIMITER $$
CREATE TRIGGER `before_insert_appointment_id_trigger` BEFORE INSERT ON `petcare_appointments` FOR EACH ROW BEGIN
  DECLARE nextId INT;

  -- Get the next auto-increment value for the table
  SELECT AUTO_INCREMENT INTO nextId
  FROM information_schema.tables
  WHERE table_name = 'petcare_appointments'
  AND table_schema = DATABASE();

  -- Set the appointment_id based on the nextId
  SET NEW.appointment_id = CONCAT('AID-', LPAD(nextId, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petcare_inventory`
--

CREATE TABLE `petcare_inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_inventory`
--

INSERT INTO `petcare_inventory` (`id`, `name`, `brand`, `category`, `stock`, `price`) VALUES
(1, 'Royal Canin Medium', 'Royal Canin', 'Food', 20, 390.00),
(2, 'Greenies', 'Green', 'Treats', 5, 500.00),
(3, 'Kong Toy', 'Kong', 'Toys', 1, 1500.00),
(4, 'Nylabone Bone', 'Nylabone', 'Toys', 3, 70.00),
(11, 'Frontline Plus', 'Frontline', 'Accessories', 20, 250.00),
(20, 'ABCD', 'ABCD', 'Food', 6, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `petcare_pet`
--

CREATE TABLE `petcare_pet` (
  `id` int(11) NOT NULL,
  `pet_id_generate` varchar(11) DEFAULT NULL,
  `pet` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `breed` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `species` varchar(255) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL,
  `petowner_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_pet`
--

INSERT INTO `petcare_pet` (`id`, `pet_id_generate`, `pet`, `DOB`, `breed`, `sex`, `age`, `species`, `profileImage`, `petowner_id`) VALUES
(1, 'PET-001', 'Rocky', '2023-06-01', 'Golden Retriever', 'Male', 5, 'Dog', 'pet1.png', 16),
(2, 'PET-002', 'Rex', '2023-01-01', 'Golden Retriever', 'Male', 1, 'Dog', 'pet2.png', 19),
(3, 'PET-003', 'Garfield', '2023-02-02', 'Maine Coon', 'Female', 2, 'Cat', 'pet3.png', 19),
(4, 'PET-004', 'Kitty', '2023-03-03', 'Netherland Dwarf', 'Male', 3, 'Cat', 'pet4.png', 19),
(5, 'PET-005', 'Oreo', '2023-04-04', 'Syrian', 'Female', 4, 'Dog', 'pet5.png', 16);

--
-- Triggers `petcare_pet`
--
DELIMITER $$
CREATE TRIGGER `before_insert_pet_id_trigger` BEFORE INSERT ON `petcare_pet` FOR EACH ROW BEGIN
  DECLARE nextId INT;

  -- Get the next auto-increment value for the table
  SELECT AUTO_INCREMENT INTO nextId
  FROM information_schema.tables
  WHERE table_name = 'petcare_pet'
  AND table_schema = DATABASE();

  -- Set the pet_id based on the nextId
  SET NEW.pet_id_generate = CONCAT('PET-', LPAD(nextId, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petcare_petowner`
--

CREATE TABLE `petcare_petowner` (
  `id` int(11) NOT NULL,
  `petowner_id_generate` varchar(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_petowner`
--

INSERT INTO `petcare_petowner` (`id`, `petowner_id_generate`, `first_name`, `last_name`, `address`, `mobile`, `email`, `password`, `profileImage`) VALUES
(16, 'PO-016', 'John', 'Carter', 'Colombo', '771234567', 'johncarter@petcare.com', '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'nopic.png'),
(18, 'PO-018', 'Abdulla', 'Abdulla', 'Colombo', '771234566', 'abdulla@petcare.com', '$2y$10$mtHH2aWdi0FfUlNcSXzHAeglp44Tf.mFxe077cekobzpHVbVt4iKa', 'user1.jpg'),
(19, 'PO-019', 'Tharindu', 'Liyanage', 'Colombo', '773135268', 'tharindu@petcare.com', '$2y$10$mtHH2aWdi0FfUlNcSXzHAeglp44Tf.mFxe077cekobzpHVbVt4iKa', 'user4.jpeg'),
(20, 'PO-020', 'Sanandi', 'Sithumya', 'Colombo', '771234567', 'sanandi@petcare.com', '$2y$10$jrQpvB7iUVgAsVfHGb.UNuiv5AdSGP/LqnoEtLCdn.2Q5MrwPfvki', 'user2.jpeg'),
(23, 'PO-023', 'Tharindu', 'Liyanage', NULL, '773135261', 'test123@gmail.com', '$2y$10$aYkTnBxdtxKnH7oFS4TS/O5YG.RqUscyPIeckJMEyiMsgzuHjALoS', 'user1.jpg'),
(25, 'PO-025', 'abc', 'aaf', 'afa', '34234', 'aafa', 'ac', NULL);

--
-- Triggers `petcare_petowner`
--
DELIMITER $$
CREATE TRIGGER `before_insert_petowner_id_trigger` BEFORE INSERT ON `petcare_petowner` FOR EACH ROW BEGIN
  DECLARE nextId INT;

  -- Get the next auto-increment value for the table
  SELECT AUTO_INCREMENT INTO nextId
  FROM information_schema.tables
  WHERE table_name = 'petcare_petowner'
  AND table_schema = DATABASE();

  -- Set the petowner_id based on the nextId
  SET NEW.petowner_id_generate = CONCAT('PO-', LPAD(nextId, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petcare_staff`
--

CREATE TABLE `petcare_staff` (
  `staff_id` int(10) NOT NULL,
  `staff_id_generate` varchar(11) DEFAULT NULL,
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
  `address` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_staff`
--

INSERT INTO `petcare_staff` (`staff_id`, `staff_id_generate`, `firstname`, `lastname`, `email`, `phone`, `role`, `certification`, `specialization`, `licensenumber`, `salary`, `password`, `profileImage`, `address`) VALUES
(29, 'STF-029', 'John', 'Doe', 'nurse@petcare.com', '123-456-7890', 'Nurse', NULL, NULL, NULL, 80000.00, '$2y$10$Nh/fSgrikdShuCVN7TEJFO5RbEySeq6ivx6Ct07jyHpvcO7fO9ItS', 'user1.jpg', '123 Main St, Los Angeles, CA 90001'),
(30, 'STF-030', 'Jane', 'Smith', 'doctor@petcare.com', '741234567', 'Doctor', NULL, NULL, NULL, 60000.00, '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user2.jpeg', '456 Elm St, New York, NY 10001'),
(31, 'STF-031', 'Mike', 'Johnson', 'assistant@petcare.com', '555-123-4567', 'Assistant', NULL, NULL, NULL, 45000.00, '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user3.jpeg', '789 Oak St, Chicago, IL 60007'),
(32, 'STF-032', 'Jason', 'Brown', 'storemanager@petcare.com', '444-789-1234', 'Store Manager', NULL, NULL, NULL, 55000.00, '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user4.jpeg', '111 Pine St, Seattle, WA 98101'),
(33, 'STF-033', 'Tharindu', 'Liyanage', 'admin@petcare.com', '773135268', 'Admin', NULL, NULL, NULL, NULL, '$2y$10$4bEVxjMxMX5eZRs.GNnWMOpeYTJj9lZEy1voZ1.pbV43iSE8hBdey', 'nopic.png', 'adaddd'),
(34, 'STF-034', 'Ann', 'Lee', 'anna@petcare2.com', '777777777', 'Assistant', NULL, NULL, NULL, NULL, '$2y$10$lVgJmAbECCA9WdNkCxB1m..oEGl4.526yASPOnHCvstlfKSiwJh9e', 'nopic.png', 'addwd'),
(35, 'STF-035', 'Anna', 'Marie', 'anjjjna@petcare2.com', '777777776', 'Doctor', NULL, NULL, NULL, NULL, '$2y$10$NPW66ryypE4pVVHuqB4CY.3RLc/Hj7JaCWkGFFc2jzKei20U8K9T.', 'user5.jpeg', 'addwd');

--
-- Triggers `petcare_staff`
--
DELIMITER $$
CREATE TRIGGER `before_insert_staff_id_trigger` BEFORE INSERT ON `petcare_staff` FOR EACH ROW BEGIN
  DECLARE nextId INT;

  -- Get the next auto-increment value for the table
  SELECT AUTO_INCREMENT INTO nextId
  FROM information_schema.tables
  WHERE table_name = 'petcare_staff'
  AND table_schema = DATABASE();

  -- Set the staff_id based on the nextId
  SET NEW.staff_id_generate = CONCAT('STF-', LPAD(nextId, 3, '0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petcare_appointments`
--
ALTER TABLE `petcare_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `petowner_id` (`petowner_id`),
  ADD KEY `fk_petcare_appointments_vet` (`vet_id`);

--
-- Indexes for table `petcare_inventory`
--
ALTER TABLE `petcare_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petcare_pet`
--
ALTER TABLE `petcare_pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_petcare_pet_petowner` (`petowner_id`);

--
-- Indexes for table `petcare_petowner`
--
ALTER TABLE `petcare_petowner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petcare_staff`
--
ALTER TABLE `petcare_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petcare_appointments`
--
ALTER TABLE `petcare_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `petcare_inventory`
--
ALTER TABLE `petcare_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `petcare_pet`
--
ALTER TABLE `petcare_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `petcare_petowner`
--
ALTER TABLE `petcare_petowner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
