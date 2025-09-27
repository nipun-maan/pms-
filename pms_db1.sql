-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2025 at 07:56 AM
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
-- Database: `pms_db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `appointment_date` datetime DEFAULT NULL COMMENT 'Appointment time',
  `status` enum('Scheduled','Completed','Cancelled') NOT NULL DEFAULT 'Scheduled' COMMENT 'Status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `patient_id`, `doctor_id`, `appointment_date`, `status`) VALUES
(1, 1, 1, '2025-10-01 09:00:00', 'Scheduled'),
(2, 2, 2, '2025-10-02 10:30:00', 'Completed'),
(3, 3, 1, '2025-10-03 14:00:00', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) DEFAULT NULL COMMENT 'Ticket subject',
  `description` text DEFAULT NULL COMMENT 'Ticket details',
  `status` enum('Open','In Progress','Closed') NOT NULL DEFAULT 'Open' COMMENT 'Ticket status',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Creation time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ticket_id`, `patient_id`, `subject`, `description`, `status`, `created_at`) VALUES
(1, 1, 'Login Issue', 'Unable to access online portal.', 'Open', '2025-09-25 14:04:38'),
(2, 2, 'Medical Report', 'Need a copy of last appointment report.', 'In Progress', '2025-09-25 14:04:38'),
(3, 3, 'Counselling Request', 'Requesting appointment with counsellor.', 'Closed', '2025-09-25 14:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_faq`
--

CREATE TABLE `chatbot_faq` (
  `faq_id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot_faq`
--

INSERT INTO `chatbot_faq` (`faq_id`, `question`, `answer`, `created_at`) VALUES
(1, 'How to book an appointment?', 'To book an appointment, please log in to the patient portal, go to the Appointments section, and select your preferred doctor and time.', '2025-09-26 05:51:12'),
(2, 'How to login?', 'Go to the hospital portal and enter your username and password. If you are a new user, please register first.', '2025-09-26 05:51:12'),
(3, 'How to check my treatment?', 'After logging in, go to the Treatments section to view your diagnosis, prescriptions, and treatment history.', '2025-09-26 05:51:12'),
(4, 'How to contact support?', 'You can create a ticket in the Attendance section or call the hospital helpdesk at +61-400-123-456.', '2025-09-26 05:51:12'),
(5, 'What are hospital working hours?', 'Our hospital operates 24/7, but specialists are available from 9:00 AM to 6:00 PM.', '2025-09-26 05:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL COMMENT 'Doctor first name',
  `last_name` varchar(50) DEFAULT NULL COMMENT 'Doctor last name',
  `specialization` varchar(100) DEFAULT NULL COMMENT 'Medical specialty',
  `phone` varchar(15) DEFAULT NULL COMMENT 'Phone',
  `email` varchar(100) DEFAULT NULL COMMENT 'Unique email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `first_name`, `last_name`, `specialization`, `phone`, `email`) VALUES
(1, 'Alice', 'Brown', 'Cardiology', '0409876543', 'alice.brown@hospital.com'),
(2, 'Bob', 'Wilson', 'Dermatology', '0418765432', 'bob.wilson@hospital.com');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL COMMENT 'Patient first name',
  `last_name` varchar(50) DEFAULT NULL COMMENT 'Patient last name',
  `dob` date DEFAULT NULL COMMENT 'Date of birth',
  `gender` enum('Male','Female','Other') DEFAULT NULL COMMENT 'Patient gender',
  `phone` varchar(15) DEFAULT NULL COMMENT 'Phone number',
  `email` varchar(100) DEFAULT NULL COMMENT 'Unique email',
  `address` text DEFAULT NULL COMMENT 'Address',
  `disciplinary_record` text DEFAULT NULL COMMENT 'Notes on discipline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `first_name`, `last_name`, `dob`, `gender`, `phone`, `email`, `address`, `disciplinary_record`) VALUES
(1, 'John', 'Doe', '1985-06-12', 'Male', '0401234567', 'john.doe@example.com', '12 Main St, Melbourne', NULL),
(2, 'Jane', 'Smith', '1990-02-25', 'Female', '0412345678', 'jane.smith@example.com', '45 Queen St, Sydney', 'Late payment issues'),
(3, 'Alex', 'Nguyen', '2000-11-10', 'Other', '0423456789', 'alex.nguyen@example.com', '99 King Rd, Brisbane', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `treatment_id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `diagnosis` text DEFAULT NULL COMMENT 'Diagnosis notes',
  `prescription` text DEFAULT NULL COMMENT 'Prescription notes',
  `treatment_date` datetime DEFAULT NULL COMMENT 'Date of treatment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatments`
--

INSERT INTO `treatments` (`treatment_id`, `patient_id`, `doctor_id`, `diagnosis`, `prescription`, `treatment_date`) VALUES
(1, 1, 1, 'High blood pressure', 'Prescribed beta blockers', '2025-10-01 09:30:00'),
(2, 2, 2, 'Skin rash', 'Prescribed ointment', '2025-10-02 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL COMMENT 'Store hashed password',
  `role` enum('patient','doctor','admin') NOT NULL DEFAULT 'patient' COMMENT 'User role',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Alice_Brown', 'Alice1', 'doctor', '2025-09-26 05:28:27'),
(2, 'Bob_Wilson', 'Bob1', 'doctor', '2025-09-26 05:28:27'),
(3, 'admin1', 'admin1', 'admin', '2025-09-26 05:28:27');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_appt_patient` (`patient_id`),
  ADD KEY `fk_appt_doctor` (`doctor_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_att_patient` (`patient_id`);

--
-- Indexes for table `chatbot_faq`
--
ALTER TABLE `chatbot_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `fk_treat_patient` (`patient_id`),
  ADD KEY `fk_treat_doctor` (`doctor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ticket_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chatbot_faq`
--
ALTER TABLE `chatbot_faq`
  MODIFY `faq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `treatments`
--
ALTER TABLE `treatments`
  MODIFY `treatment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appt_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `fk_appt_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_att_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);

--
-- Constraints for table `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `fk_treat_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  ADD CONSTRAINT `fk_treat_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
