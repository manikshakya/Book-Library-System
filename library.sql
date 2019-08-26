-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 11:32 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5


-- My Updated Version
CREATE TABLE `books` (
  `ISBN` varchar(13) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `Available` ENUM('Yes', 'No') DEFAULT 'Yes',
   PRIMARY KEY (ISBN)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
--
INSERT INTO `books` (`ISBN`, `title`, `author`) VALUES
('9780140443974', 'Early Irish Myths and Sagas', 'Penguin Classics'),
('9781407230023', 'Do Androids Dream of Electric Sheep?', 'Philip K. Dick'),
('9781853267338', 'The Count of Monte Cristo', 'Alexandre Dumas'),
('9780241950432', 'The Catcher In The Rye', 'J.D. Salinger'),
('9780575099487', 'The Fall of Hyperion', 'Dan Simmons');
--



-- --------------------------------------------------------

-- My Updated Version
CREATE TABLE `members` (
  `studentNo` int(10) NOT NULL ,
  `firstName` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
   PRIMARY KEY (studentNo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
--
INSERT INTO `members` (`firstName`, `surname`, `street`, `city`, `email`) VALUES
('Shane', 'Browne', 'Longford', 'Longford', 'shanebrowne258@gmail.com');
--


-- My Updated Version
CREATE TABLE `bookTracker` (
  `ISBN` varchar(13) NOT NULL,
  `studentNo` int(11) NOT NULL,
   PRIMARY KEY (ISBN, studentNo),
   FOREIGN KEY (ISBN) REFERENCES books (ISBN),
   FOREIGN KEY (studentNo) REFERENCES members (studentNo)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--


