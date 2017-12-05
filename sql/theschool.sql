-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2017 at 01:56 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `image` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `role`, `phone`, `email`, `password`, `image`) VALUES
(1, 'admin', 1, '0129876543', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'owner.jpg'),
(2, 'sales', 3, '0123334455', 'sales@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'sales.jpg'),
(3, 'manager', 2, '0129998877', 'manager@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'manager.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `image`) VALUES
(1, 'Full Stack', 'Web', 'fullstack.png'),
(2, 'seo', 'Search Engine Optimization', 'seo.jpg'),
(3, 'cyber', 'Cyber Security', 'cyber.png'),
(4, 'QA', 'Quality assurance', 'QA.jpg'),
(5, 'graphics', 'graphic design', 'graphics-design.png'),
(6, 'css', 'Cascading Style Sheets', 'CSS3.jpg'),
(7, 'JS', 'JavaScript', 'js.png'),
(8, 'PHP', 'Hypertext Preprocessor', 'PHP.png'),
(9, 'angular', 'Application platform', 'angular.png'),
(10, 'jquery', 'JavaScript library', 'jquery.jpg'),
(11, 'Node.js', 'server framework', 'Nodejs.png'),
(12, 'html', 'Hypertext Markup Language', 'HTML5.png'),
(13, 'MySQL', 'database management system', 'MySQL.png'),
(14, 'java', 'Computer software', 'java.jpg'),
(15, 'Python', 'High-level programming language', 'Python.png');

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `course` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses_students`
--

INSERT INTO `courses_students` (`course`, `student`) VALUES
(1, 2),
(1, 3),
(1, 14),
(2, 3),
(2, 4),
(2, 14),
(3, 4),
(3, 5),
(3, 6),
(4, 2),
(4, 5),
(4, 6),
(5, 6),
(5, 10),
(5, 15),
(6, 8),
(6, 10),
(6, 15),
(7, 7),
(7, 10),
(7, 15),
(8, 11),
(8, 12),
(8, 16),
(9, 7),
(9, 11),
(9, 16),
(10, 8),
(10, 13),
(10, 16),
(11, 7),
(11, 11),
(12, 8),
(12, 13),
(13, 9),
(13, 13),
(14, 9),
(14, 12),
(15, 9),
(15, 12),
(15, 14);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `phone`, `email`, `image`) VALUES
(2, 'Jacob', '0129878787', 'jacob@gmail.com', 'ball.png'),
(3, 'Daniel', '0129998765', 'daniel@gmail.com', 'students-cap.jpg'),
(4, 'Helen', '0129996633', 'helen@gmail.com', 'hat-and-diploma.jpg'),
(5, 'Michael', '0123216549', 'michael@gmail.com', 'student.png'),
(6, 'Elena', '0123663939', 'elena@gmail.com', 'hat.jpg'),
(7, 'Ilana', '0124552525', 'ilana@gmail.com', 'scroll-hat.jpg'),
(8, 'Megan', '0123334353', 'megan@gmail.com', 'student-girl.png'),
(9, 'Tzippy', '0129997766', 'tzippy@gmail.com', 'graduation.png'),
(10, 'Sarah', '0128887799', 'sarah@gmail.com', 'graduation-cap.png'),
(11, 'Miriam', '0126667788', 'miriam@gmail.com', 'hat-book.jpg'),
(12, 'Devorah', '0123334455', 'devorah@gmail.com', 'hat-books-diploma.jpg'),
(13, 'Channah', '0122345678', 'channah@gmail.com', 'books.png'),
(14, 'Avigail', '0123223232', 'avigail@gmail.com', 'owl.jpg'),
(15, 'Chuldah', '0123663636', 'chuldah@gmail.com', 'graduate-cap.png'),
(16, 'Esther', '0123443434', 'esther@gmail.com', 'female-graduate.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_administrator_to_role_idx` (`role`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`course`,`student`),
  ADD KEY `fk_to_students_idx` (`student`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `fk_administrator_to_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD CONSTRAINT `fk_to_courses` FOREIGN KEY (`course`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_to_students` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
