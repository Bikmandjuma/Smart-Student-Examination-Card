-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2021 at 12:39 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `register_student`
--

CREATE TABLE `register_student` (
  `stu_id` int(11) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_users`
--

CREATE TABLE `sec_users` (
  `su_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `responsability` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sec_users`
--

INSERT INTO `sec_users` (`su_id`, `firstname`, `lastname`, `gender`, `email`, `phone`, `username`, `password`, `responsability`, `image`, `dob`) VALUES
(2, 'Admin_fname', 'Admin_lname', 'm', 'admin@gmail.com', '0788888888', 'Admin', 'pass12345', 'Admin', '', '20/12/1998');

-- --------------------------------------------------------

--
-- Table structure for table `students_fees`
--

CREATE TABLE `students_fees` (
  `stu_id` int(11) NOT NULL,
  `fk_student_id` int(11) NOT NULL,
  `payment` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_attendance`
--

CREATE TABLE `test_attendance` (
  `t_id` int(11) NOT NULL,
  `fk_students_fees_id` int(11) DEFAULT NULL,
  `time_in` varchar(50) DEFAULT NULL,
  `time_out` varchar(50) DEFAULT NULL,
  `submit_exam` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register_student`
--
ALTER TABLE `register_student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `sec_users`
--
ALTER TABLE `sec_users`
  ADD PRIMARY KEY (`su_id`);

--
-- Indexes for table `students_fees`
--
ALTER TABLE `students_fees`
  ADD PRIMARY KEY (`stu_id`),
  ADD KEY `fk_student_id` (`fk_student_id`);

--
-- Indexes for table `test_attendance`
--
ALTER TABLE `test_attendance`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `fk_students_fees_id` (`fk_students_fees_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register_student`
--
ALTER TABLE `register_student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sec_users`
--
ALTER TABLE `sec_users`
  MODIFY `su_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students_fees`
--
ALTER TABLE `students_fees`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_attendance`
--
ALTER TABLE `test_attendance`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `students_fees`
--
ALTER TABLE `students_fees`
  ADD CONSTRAINT `students_fees_ibfk_1` FOREIGN KEY (`fk_student_id`) REFERENCES `register_student` (`stu_id`);

--
-- Constraints for table `test_attendance`
--
ALTER TABLE `test_attendance`
  ADD CONSTRAINT `test_attendance_ibfk_1` FOREIGN KEY (`fk_students_fees_id`) REFERENCES `students_fees` (`stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
