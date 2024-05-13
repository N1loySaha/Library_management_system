-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 10:20 PM
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
-- Database: `online_library_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `a_first_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `a_last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_password`, `a_first_name`, `email`, `a_last_name`) VALUES
(11, 'password123', 'John', 'john@example.com', 'Doe'),
(12, 'securepass', 'Alice', 'alice@email.com', 'Smith'),
(13, 'adminpass', 'Admin', 'admin@admin.com', 'Adminsson'),
(14, 'p@$$w0rd', 'Jane', 'jane@example.org', 'Doe'),
(15, 'pass1234', 'Bob', 'bob@gmail.com', 'Johnson');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `a_first_name` varchar(50) NOT NULL,
  `a_last_name` varchar(50) NOT NULL,
  `biography` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `a_first_name`, `a_last_name`, `biography`) VALUES
(101, 'Harper', 'Lee', 'Harper Lee was an American novelist best known for her 1960 novel To Kill a Mockingbird.'),
(102, 'George', 'Orwell', 'George Orwell was an English novelist, essayist, journalist, and critic.'),
(103, 'F. Scott', 'Fitzgerald', 'F. Scott Fitzgerald was an American fiction writer, whose works illustrate the Jazz Age.'),
(104, 'Jane', 'Austen', 'Jane Austen was an English novelist known primarily for her six major novels, which interpret, critique and comment upon the British landed gentry at the end of the 18th century.'),
(105, 'J.K.', 'Rowling', 'J.K. Rowling is a British author and screenwriter best known for her seven-book Harry Potter children\'s book series.');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `average_rating` decimal(2,1) DEFAULT NULL,
  `language` varchar(50) NOT NULL,
  `author_id` int(11) NOT NULL,
  `borrow_count` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) DEFAULT NULL,
  `no_of_copies` int(11) NOT NULL DEFAULT 1,
  `publishers_id` int(11) DEFAULT NULL,
  `year_of_publication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `description`, `average_rating`, `language`, `author_id`, `borrow_count`, `image_url`, `no_of_copies`, `publishers_id`, `year_of_publication`) VALUES
(1, 'To Kill a Mockingbird', 'A novel by Harper Lee, published in 1960, widely read in high schools and middle schools in the USA.', 8.3, 'English', 101, 12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTr3IP4y1QmTxC6oBcVkkNMIdF8JX1Ch1OMFMN55scW6Q&s', 5, NULL, 0),
(2, '1984', 'A dystopian social science fiction novel and cautionary tale by the English writer George Orwell.', 8.9, 'English', 102, 7, 'https://images.booksense.com/images/333/869/9781328869333.jpg', 9, NULL, 0),
(3, 'The Great Gatsby', 'A novel by American author F. Scott Fitzgerald that follows a cast of characters living in the fictional towns of West Egg and East Egg on prosperous Long Island.', 7.5, 'English', 103, 8, 'https://th.bing.com/th/id/OIP.mp3cuHClNElkTmZn-sBlWwHaLX?rs=1&pid=ImgDetMain', 2, NULL, 0),
(4, 'Pride and Prejudice', 'A romantic novel of manners written by Jane Austen in 1813.', 8.5, 'English', 104, 16, 'https://th.bing.com/th/id/R.a8683262b19fe61325eb22265b0f2165?rik=jSuXsoSkwzL1sg&pid=ImgRaw&r=0', 4, NULL, 0),
(5, 'Harry Potter and the Sorcerer\'s Stone', 'The first novel in the Harry Potter series written by J.K. Rowling, featuring a young wizard, Harry Potter.', 9.0, 'English', 105, 7, 'https://th.bing.com/th/id/R.6f100d06897c528ba1b1b4c39a234689?rik=lNc4cTSk2J1fDA&pid=ImgRaw&r=0', 10, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `book_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_id`, `category`) VALUES
(1, 'Fiction'),
(1, 'Mystery'),
(2, 'Biography'),
(2, 'Non-Fiction'),
(3, 'Fiction'),
(3, 'Thriller'),
(4, 'Historical'),
(4, 'Romance'),
(5, 'Fantasy'),
(5, 'Young Adult');

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrowed_id` int(11) NOT NULL,
  `borrowed_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`borrowed_id`, `borrowed_date`, `return_date`, `member_id`) VALUES
(7, '2024-04-10', '2024-04-23', 4),
(8, '2024-04-02', '2024-04-23', 4),
(9, '2024-04-01', '2024-04-23', 4),
(10, '2024-04-01', '2024-04-24', 4),
(11, '2024-04-11', '2024-04-29', 4),
(12, '2024-04-02', '2024-04-13', 5),
(13, '2024-04-06', '2024-04-24', 5),
(14, '2024-04-22', '2024-04-25', 5),
(15, '2024-04-22', '2024-04-26', 4),
(16, '2024-04-10', '2024-04-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_info`
--

CREATE TABLE `borrow_info` (
  `borrowed_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_info`
--

INSERT INTO `borrow_info` (`borrowed_id`, `book_id`) VALUES
(7, 1),
(14, 1),
(15, 1),
(8, 2),
(10, 2),
(11, 2),
(16, 4),
(12, 5),
(13, 5);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category`) VALUES
('Biography'),
('Fantasy'),
('Fiction'),
('Historical'),
('Mystery'),
('Non-Fiction'),
('Romance'),
('Science Fiction'),
('Thriller'),
('Young Adult');

-- --------------------------------------------------------

--
-- Table structure for table `fav_category`
--

CREATE TABLE `fav_category` (
  `member_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `fine_id` int(11) NOT NULL,
  `borrowed_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `fine_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`fine_id`, `borrowed_id`, `member_id`, `fine_amount`) VALUES
(8, 11, 4, 18.00),
(9, 11, 4, 18.00),
(10, 8, 4, 21.00),
(11, 8, 4, 21.00);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `total_book_borrow_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_password`, `first_name`, `last_name`, `email`, `phone`, `total_book_borrow_count`) VALUES
(1, 'password123', 'John', 'Doe', 'john@example.com', '123-456-7890', 0),
(2, 'securepass', 'Alice', 'Smith', 'alice@email.com', '987-654-3210', 1),
(3, 'adminpass', 'Admin', 'Adminsson', 'admin@admin.com', '555-555-5555', 0),
(4, 'p@$$w0rd', 'Jane', 'Doe', 'jane@example.org', '111-222-3333', 1),
(5, 'pass1234', 'Bob', 'Johnson', 'bob@gmail.com', '999-888-7777', 2);

-- --------------------------------------------------------

--
-- Table structure for table `popular`
--

CREATE TABLE `popular` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popular`
--

INSERT INTO `popular` (`book_id`, `book_name`) VALUES
(1, 'To Kill a Mockingbird'),
(2, '1984'),
(3, 'The Great Gatsby'),
(4, 'Pride and Prejudice'),
(5, 'Harry Potter and the Sorcerer\'s Stone');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publishers_id` int(11) NOT NULL,
  `pub_name` varchar(255) NOT NULL,
  `pub_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishes`
--

CREATE TABLE `publishes` (
  `publishers_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `publication_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_date` date NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `review_text` text DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `writes`
--

CREATE TABLE `writes` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `writes`
--

INSERT INTO `writes` (`book_id`, `author_id`) VALUES
(1, 101),
(2, 102),
(3, 103),
(4, 104),
(5, 103),
(5, 105);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `fk_publishers_id` (`publishers_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`book_id`,`category`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrowed_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `borrow_info`
--
ALTER TABLE `borrow_info`
  ADD PRIMARY KEY (`borrowed_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `fav_category`
--
ALTER TABLE `fav_category`
  ADD PRIMARY KEY (`member_id`,`category`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`fine_id`),
  ADD KEY `borrowed_id` (`borrowed_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `popular`
--
ALTER TABLE `popular`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publishers_id`);

--
-- Indexes for table `publishes`
--
ALTER TABLE `publishes`
  ADD PRIMARY KEY (`publishers_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `writes`
--
ALTER TABLE `writes`
  ADD PRIMARY KEY (`book_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrowed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `fine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publishers_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_publishers_id` FOREIGN KEY (`publishers_id`) REFERENCES `publisher` (`publishers_id`);

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`category`);

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `borrow_info`
--
ALTER TABLE `borrow_info`
  ADD CONSTRAINT `borrow_info_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `fav_category`
--
ALTER TABLE `fav_category`
  ADD CONSTRAINT `fav_category_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `fav_category_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`category`);

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fine_ibfk_1` FOREIGN KEY (`borrowed_id`) REFERENCES `borrows` (`borrowed_id`),
  ADD CONSTRAINT `fine_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`);

--
-- Constraints for table `popular`
--
ALTER TABLE `popular`
  ADD CONSTRAINT `popular_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `publishes`
--
ALTER TABLE `publishes`
  ADD CONSTRAINT `publishes_ibfk_1` FOREIGN KEY (`publishers_id`) REFERENCES `publisher` (`publishers_id`),
  ADD CONSTRAINT `publishes_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `writes`
--
ALTER TABLE `writes`
  ADD CONSTRAINT `writes_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `writes_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
