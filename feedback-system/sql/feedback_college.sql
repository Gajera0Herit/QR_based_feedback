-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2022 at 09:08 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_college`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(11) NOT NULL,
  `a_username` varchar(255) NOT NULL,
  `a_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_username`, `a_password`) VALUES
(1, 'admin', '$2y$10$.x.G9Y06Q8aKEL69zLpwPOwXp8yZq12QY9QonDEmsNOqLnNcM46Dq');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `s_password` varchar(255) NOT NULL,
  `s_phone` varchar(255) NOT NULL,
  `s_branch` varchar(255) NOT NULL,
  `s_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `s_name`, `s_email`, `s_password`, `s_phone`, `s_branch`, `s_year`) VALUES
(1, 'Student', 'student@example.com', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '8064316874', 'Production Engineering', 'Third'),
(2, 'Bebe Drees', 'bdrees1@webnode.com', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '4574928849', 'Information Technology', 'Second'),
(3, 'Chaim Bodega', 'cbodega2@lulu.com', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '9358939812', 'Production Engineering', 'Third'),
(4, 'Derry Shorland', 'dshorland3@answers.com', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '5032288487', 'Production Engineering', 'Third'),
(5, 'Chad Wedlake', 'cwedlake4@about.me', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '4235904987', 'Mechanical Engineering', 'First'),
(6, 'Cary Gerge', 'cgerge5@who.int', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '6902883054', 'Mechanical Engineering', 'Fourth'),
(7, 'Kristi Pudan', 'kpudan6@stanford.edu', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '4259620152', 'Computer Engineering', 'Second'),
(8, 'Hinze Hanscom', 'hhanscom7@nymag.com', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '8884381555', 'Computer Engineering', 'Second'),
(9, 'Augusto Gorrissen', 'agorrissen8@yahoo.co.jp', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '5011850451', 'Production Engineering', 'Second'),
(10, 'Berte Alford', 'balford9@patch.com', '$2y$10$zA5/v/OIab6FzZCC/WXawu7pQDPBsWPqXDZLc54RmSA4Rr.lsi.SW', '2381428101', 'Mechanical Engineering', 'Third');

-- --------------------------------------------------------

--
-- Table structure for table `student_feedback`
--

CREATE TABLE `student_feedback` (
  `f_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `f_comment` text NOT NULL,
  `f_question1` varchar(255) NOT NULL,
  `f_question2` varchar(255) NOT NULL,
  `f_question3` varchar(255) NOT NULL,
  `f_question4` varchar(255) NOT NULL,
  `f_question5` varchar(255) NOT NULL,
  `f_question6` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_email` varchar(255) NOT NULL,
  `t_password` varchar(255) NOT NULL,
  `t_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `t_name`, `t_email`, `t_password`, `t_phone`) VALUES
(1, 'Teacher', 'teacher@example.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '3498235465'),
(2, 'Diarmid Boteman', 'dboteman1@ycombinator.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '2165116945'),
(3, 'Erv Ruston', 'eruston2@bbb.org', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '8553855082'),
(4, 'Rica Gayne', 'rgayne3@studiopress.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '4968620922'),
(5, 'Laraine Crossby', 'lcrossby4@opera.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '6105303835'),
(6, 'Amos Rawstorne', 'arawstorne5@ox.ac.uk', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '9385762434'),
(7, 'Jacklin Gingle', 'jgingle6@nymag.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '3703090321'),
(8, 'Emanuele Mollitt', 'emollitt7@twitter.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '6066678718'),
(9, 'Andromache Sudran', 'asudran8@ning.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '6014273532'),
(10, 'Iosep Kytley', 'ikytley9@booking.com', '$2y$10$hFgI6hIuXTcv3qQSUjCkbe84KAr5by32B7AeJ3nI5N2GpvQzuWh7W', '3473717910');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `sub_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `sub_year` varchar(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`sub_id`, `t_id`, `branch`, `sub_year`, `sub_name`) VALUES
(1, 10, 'Information Technology', 'Fourth', 'Modern History'),
(2, 9, 'Production Engineering', 'First', 'Common Law'),
(3, 1, 'Mechanical Engineering', 'First', 'Common Law'),
(4, 1, 'Information Technology', 'Third', 'Modern History'),
(5, 5, 'Production Engineering', 'Second', 'Philosophy of Psychology'),
(6, 10, 'Production Engineering', 'Third', 'Experimental Economics'),
(7, 1, 'Production Engineering', 'Third', 'Coastal Management'),
(8, 8, 'Production Engineering', 'First', 'Common Law'),
(9, 5, 'Information Technology', 'Second', 'Computer Architecture'),
(10, 4, 'Mechanical Engineering', 'Fourth', 'European Archaeology'),
(11, 6, 'Information Technology', 'First', 'European Archaeology'),
(12, 10, 'Production Engineering', 'Second', 'Analytic Philosophy'),
(13, 3, 'Production Engineering', 'First', 'Modern History'),
(14, 9, 'Production Engineering', 'Second', 'Philosophy of Psychology'),
(15, 4, 'Mechanical Engineering', 'First', 'Sociology of Autism'),
(16, 5, 'Mechanical Engineering', 'Fourth', 'Computer Architecture'),
(17, 4, 'Computer Engineering', 'Third', 'Anthropology of Religion'),
(18, 10, 'Production Engineering', 'Fourth', 'European Archaeology'),
(19, 4, 'Information Technology', 'Fourth', 'Common Law'),
(20, 3, 'Mechanical Engineering', 'Fourth', 'Coastal Management');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `student_feedback`
--
ALTER TABLE `student_feedback`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `student_feedback_ibfk_1` (`s_id`),
  ADD KEY `student_feedback_ibfk_2` (`t_id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `t_id` (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_feedback`
--
ALTER TABLE `student_feedback`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_feedback`
--
ALTER TABLE `student_feedback`
  ADD CONSTRAINT `student_feedback_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_feedback_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `teachers` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_feedback_ibfk_3` FOREIGN KEY (`sub_id`) REFERENCES `teacher_subjects` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD CONSTRAINT `teacher_subjects_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `teachers` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
