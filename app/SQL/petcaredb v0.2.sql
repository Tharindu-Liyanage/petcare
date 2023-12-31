-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `appointment_time` varchar(10) NOT NULL,
  `appointment_type` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Confirmed',
  `vet_id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_appointments`
--

INSERT INTO `petcare_appointments` (`id`, `appointment_id`, `pet_id`, `petowner_id`, `appointment_date`, `appointment_time`, `appointment_type`, `status`, `vet_id`) VALUES
(1, 'AID-001', 1, 16, '2023-12-20', '10:30 AM', 'Vaccination', 'Completed', '30'),
(2, 'AID-002', 2, 18, '2023-12-13', '9:31 AM', 'Checkup', 'Confirmed', '30'),
(3, 'AID-003', 3, 20, '2023-12-13', '9:45 AM', 'Grooming', 'Confirmed', '30'),
(4, 'AID-004', 5, 16, '2023-12-17', '5:10 PM', 'Surgery', 'Reshedule', '30'),
(5, 'AID-005', 4, 23, '2023-12-17', '4:00 PM', 'Dental Cleaning', 'Confirmed', '30'),
(6, 'AID-006', 5, 16, '2023-11-20', '6:00 PM', 'Surgery', 'Confirmed', '35'),
(19, 'AID-019', 2, 16, '2023-12-20', '9:00 AM', 'Parasite Control', 'Pending', '30');

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
-- Table structure for table `petcare_appointment_reason`
--

CREATE TABLE `petcare_appointment_reason` (
  `reason_id` int(11) NOT NULL,
  `reason_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_appointment_reason`
--

INSERT INTO `petcare_appointment_reason` (`reason_id`, `reason_name`) VALUES
(1, 'Routine Check-up'),
(2, 'Vaccinations'),
(3, 'Spaying or Neutering'),
(4, 'Dental Care'),
(5, 'Parasite Control'),
(6, 'Illness or Injury'),
(7, 'Behavioral Concerns'),
(8, 'Nutritional Guidance'),
(9, 'Senior Pet Care'),
(10, 'Emergency Care');

-- --------------------------------------------------------

--
-- Table structure for table `petcare_holiday`
--

CREATE TABLE `petcare_holiday` (
  `id` int(3) NOT NULL,
  `day` varchar(20) NOT NULL,
  `holiday` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_holiday`
--

INSERT INTO `petcare_holiday` (`id`, `day`, `holiday`) VALUES
(1, 'monday', 'false'),
(2, 'tuesday', 'false'),
(3, 'wednesday', 'false'),
(4, 'thursday', 'false'),
(5, 'friday', 'false'),
(6, 'saturday', 'false'),
(7, 'sunday', 'false');

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
(2, 'PET-002', 'Rex', '2023-01-01', 'Golden Retriever', 'Male', 1, 'Dog', 'pet2.png', 16),
(3, 'PET-003', 'Garfield', '2023-02-02', 'Maine Coon', 'Female', 2, 'Cat', 'pet3.png', 16),
(4, 'PET-004', 'Kitty', '2023-03-03', 'Netherland Dwarf', 'Male', 3, 'Cat', 'pet4.png', 16),
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
(16, 'PO-016', 'Chamara ', 'Fernando', 'Colombo', '771234567', 'petowner@petcare.com', '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'nopic.png'),
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
(29, 'STF-029', 'Thilini ', 'Jayawardene', 'nurse@petcare.com', '123-456-7890', 'Nurse', NULL, NULL, NULL, 80000.00, '$2y$10$Nh/fSgrikdShuCVN7TEJFO5RbEySeq6ivx6Ct07jyHpvcO7fO9ItS', 'user1.jpg', '123 Main St, Los Angeles, CA 90001'),
(30, 'STF-030', 'Anusha ', 'de Silva', 'doctor@petcare.com', '741234567', 'Doctor', NULL, NULL, NULL, 60000.00, '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user2.jpeg', '456 Elm St, New York, NY 10001'),
(31, 'STF-031', 'Ishara ', 'Weerasinghe', 'assistant@petcare.com', '555-123-4567', 'Assistant', NULL, NULL, NULL, 45000.00, '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user3.jpeg', '789 Oak St, Chicago, IL 60007'),
(32, 'STF-032', 'Malith ', 'Perera', 'storemanager@petcare.com', '444-789-1234', 'Store Manager', NULL, NULL, NULL, 55000.00, '$2y$10$/JwQOIswJC1x0OkKdk8XJ.o21rTKK5oeOTN./WAJIpiCOhcrmfMFK', 'user4.jpeg', '111 Pine St, Seattle, WA 98101'),
(33, 'STF-033', 'Tharindu', 'Liyanage', 'admin@petcare.com', '773135268', 'Admin', NULL, NULL, NULL, NULL, '$2y$10$4bEVxjMxMX5eZRs.GNnWMOpeYTJj9lZEy1voZ1.pbV43iSE8hBdey', 'nopic.png', 'adaddd'),
(34, 'STF-034', 'Ann', 'Lee', 'anna@petcare2.com', '777777777', 'Assistant', NULL, NULL, NULL, NULL, '$2y$10$lVgJmAbECCA9WdNkCxB1m..oEGl4.526yASPOnHCvstlfKSiwJh9e', 'nopic.png', 'addwd'),
(35, 'STF-035', 'Kavindi', 'Ranasinghe', 'Kavindi@petcare.com', '777777776', 'Doctor', NULL, NULL, NULL, NULL, '$2y$10$NPW66ryypE4pVVHuqB4CY.3RLc/Hj7JaCWkGFFc2jzKei20U8K9T.', 'user5.jpeg', 'addwd');

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

-- --------------------------------------------------------

--
-- Table structure for table `petcare_temp_lock_timeslots`
--

CREATE TABLE `petcare_temp_lock_timeslots` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `vet_id` int(11) NOT NULL,
  `receive_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'status 1 mean locked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_temp_lock_timeslots`
--

INSERT INTO `petcare_temp_lock_timeslots` (`id`, `date`, `time`, `vet_id`, `receive_time`, `end_time`, `status`) VALUES
(4, '2023-12-13', '9:30 AM', 30, '03:13:20', '03:14:20', 0),
(5, '2023-12-14', '12:00 PM', 30, '11:26:31', '11:58:31', 0),
(6, '2023-12-15', '11:00 AM', 30, '15:33:32', '16:05:32', 0),
(7, '2023-12-17', '5:00 PM', 30, '10:24:08', '10:56:08', 0),
(8, '2023-12-16', '10:00 AM', 30, '10:42:46', '11:14:46', 0),
(9, '2023-12-17', '9:30 AM', 30, '10:44:18', '11:16:18', 0),
(10, '2023-12-20', '9:00 AM', 30, '18:03:22', '18:35:22', 0),
(11, '2023-12-19', '11:15 AM', 30, '18:05:27', '18:37:27', 0),
(12, '2023-12-19', '5:30 PM', 30, '18:58:21', '19:30:21', 0),
(13, '2023-12-20', '11:00 AM', 30, '19:54:55', '20:26:55', 0),
(14, '2023-12-17', '5:30 PM', 30, '20:07:27', '20:39:27', 1),
(15, '2023-12-17', '9:30 AM', 35, '20:35:43', '21:07:43', 1),
(16, '2023-12-20', '11:30 AM', 30, '19:46:15', '20:18:15', 1),
(17, '2023-12-20', '9:30 AM', 30, '20:11:18', '20:43:18', 1),
(18, '2023-12-22', '9:30 AM', 30, '20:27:53', '20:59:53', 1),
(19, '2023-12-16', '8:30 PM', 30, '20:29:45', '21:01:45', 1),
(20, '2023-12-17', '8:00 AM', 30, '20:45:26', '21:17:26', 1),
(21, '2023-12-17', '8:30 AM', 30, '20:48:34', '21:20:34', 1),
(22, '2023-12-17', '9:00 AM', 30, '20:56:31', '21:28:31', 1),
(23, '2023-12-17', '9:30 AM', 30, '21:01:24', '21:33:24', 1),
(24, '2023-12-20', '9:00 AM', 30, '21:12:16', '21:44:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `petcare_timeslots`
--

CREATE TABLE `petcare_timeslots` (
  `id` int(3) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `intervel` int(11) NOT NULL,
  `part_of_day` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petcare_timeslots`
--

INSERT INTO `petcare_timeslots` (`id`, `day`, `start_time`, `end_time`, `intervel`, `part_of_day`) VALUES
(1, 'monday', '09:00:00', '12:00:00', 30, 'morning'),
(2, 'monday', '13:00:00', '18:00:00', 30, 'afternoon'),
(3, 'tuesday', '09:00:00', '12:00:00', 45, 'morning'),
(4, 'tuesday', '13:00:00', '18:00:00', 30, 'afternoon'),
(5, 'wednesday', '09:00:00', '12:00:00', 30, 'morning'),
(6, 'wednesday', '14:00:00', '18:00:00', 30, 'afternoon'),
(7, 'thursday', '09:00:00', '12:00:00', 30, 'morning'),
(8, 'thursday', '13:00:00', '18:00:00', 30, 'afternoon'),
(9, 'friday', '09:00:00', '12:00:00', 30, 'morning'),
(10, 'friday', '13:00:00', '18:00:00', 30, 'afternoon'),
(11, 'saturday', '10:00:00', '12:00:00', 30, 'morning'),
(12, 'saturday', '15:00:00', '20:30:00', 30, 'afternoon'),
(13, 'sunday', '08:00:00', '11:00:00', 30, 'morning'),
(14, 'sunday', '16:00:00', '22:00:00', 30, 'afternoon');

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
-- Indexes for table `petcare_appointment_reason`
--
ALTER TABLE `petcare_appointment_reason`
  ADD PRIMARY KEY (`reason_id`);

--
-- Indexes for table `petcare_holiday`
--
ALTER TABLE `petcare_holiday`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `petcare_temp_lock_timeslots`
--
ALTER TABLE `petcare_temp_lock_timeslots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petcare_timeslots`
--
ALTER TABLE `petcare_timeslots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petcare_appointments`
--
ALTER TABLE `petcare_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `petcare_appointment_reason`
--
ALTER TABLE `petcare_appointment_reason`
  MODIFY `reason_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

--
-- AUTO_INCREMENT for table `petcare_staff`
--
ALTER TABLE `petcare_staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `petcare_temp_lock_timeslots`
--
ALTER TABLE `petcare_temp_lock_timeslots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
