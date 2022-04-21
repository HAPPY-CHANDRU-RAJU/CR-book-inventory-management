-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2022 at 08:06 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr_book_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookId` varchar(250) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `BookDesc` varchar(500) NOT NULL,
  `BookPrice` int(10) NOT NULL DEFAULT 0,
  `BookAvailable` int(5) NOT NULL,
  `BookStatus` enum('INACTIVE','ACTIVE','','') NOT NULL,
  `BookDoc` timestamp NULL DEFAULT current_timestamp(),
  `UserId` varchar(250) NOT NULL,
  `storeId` varchar(250) NOT NULL,
  `CatId` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookId`, `BookName`, `BookDesc`, `BookPrice`, `BookAvailable`, `BookStatus`, `BookDoc`, `UserId`, `storeId`, `CatId`) VALUES
('FJKbBgAAQBAJ', 'The Science Book', 'The Science Book presents 80 of the most trailblazing ideas in physics, chemistry, and biology. It is packed with short, pithy explanations that cut through the jargon, step-by-step diagrams that untangle knotty theories.', 1488, 0, 'ACTIVE', '2022-04-13 17:07:00', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b245d7fdr860d43e5d57b15b36f607ee', 'sigfyss67fdg6sagysgaf7sa8a24'),
('FKEiLJoYGIEC', 'The New Flower Expert', 'Revised and updated, twice the size--and with over two and a half million copies sold! He\'s the world\'s best-selling gardening author and this is now the definitive manual on flower gardening. As big as The Houseplant Expert, the new, greatly expanded, and amazingly comprehensive Millennium Edition is packed with every detail, every secret, and every trick Hessayon has uncovered through years of experience. Filled with facts on everything from choosing the right type of flower to cultivate', 1560, 12, 'ACTIVE', '2022-04-13 08:24:43', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b860d433efde5d3ffd57b15b36f607ee', 'sigfyss676sagysgaffg7sa8a24'),
('JDhAEAAAQBAJ', 'Untold Horror', 'Insightful interviews of horror legends George Romero, John Landis, Joe Dante, Brian Yuzna, and more, by former editor-in-chief of Rue Morgue, Dave Alexander, about the scariest horror movies never made! Take a behind-the-scenes look into development hell to find the most frightening horror movies that never were, from unmade Re-Animator sequels to alternate takes on legendary franchises like Frankenstein and Dracula!', 315, 26, 'ACTIVE', '2022-04-13 10:43:45', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b245d7fdr860d43e5d57b15b36f607ee', 'sigfyss66gfdg76sagysgaf7sa8a'),
('LOgDAAAAMBAJ', 'Competition Science Vision', 'Competition Science Vision (monthly magazine) is published by Pratiyogita Darpan Group in India and is one of the best Science monthly magazines available for medical entrance examination students in India. Well-qualified professionals of Physics, Chemistry, Zoology and Botany make contributions to this magazine and craft it with focus on providing complete and to-the-point study material for aspiring candidates.', 750, 0, 'ACTIVE', '2022-04-13 17:09:56', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b245d7fdr860d43e5d57b15b36f607ee', 'sigfyss676sagysgaf7ereysa8a'),
('MnKdAfqLG14C', 'The Art of Fiction', 'In this entertaining and enlightening collection David Lodge considers the art of fiction under a wide range of headings, drawing on writers as diverse as Henry James, Martin Amis, Jane Austen and James Joyce.', 256, 21, 'ACTIVE', '2022-04-13 11:03:20', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b245d7fdr860d43e5d57b15b36f607ee', 'sigfyss67fdg6sagysgaf7sa8a24'),
('qdTgpEwSiIQC', '101 Inspiring Stories', 'This is one of the many inspiring books from the renowned “Motivator” Dr. G. Francis Xavier. Evidently, this harvest of stories has been gleaned from lands he visited and books he read. Xavier, who conducts full-house personal growth courses', 246, 52, 'ACTIVE', '2022-04-13 17:01:51', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b245d7fdr860d43e5d57b15b36f607ee', 'sigfyss67fdg6sagysgaf7sa8a24'),
('sgEAAAAAMBAJ', 'Popular Science', 'Popular Science gives our readers the information and tools to improve their technology and their world. The core belief that Popular Science and our readers share: The future is going to be better, and science and technology are the driving forces that will help make it better.', 142, 5, 'ACTIVE', '2022-04-13 17:08:53', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b245d7fdr860d43e5d57b15b36f607ee', 'sigfyss676sagysgaf7ereysa8a'),
('T-FNDwAAQBAJ', 'Crepe Paper Flowers', 'With 30 projects and an introduction to both crafting paper flowers and working with crepe paper, this book is full of inspiration and expert advice for beginners. If you have a Cricut Maker, you can download the templates to your machine so you can enjoy your own homemade bouquets in no time. Crepe paper is the best material for creating paper flowers, especially for beginners', 200, 75, 'ACTIVE', '2022-04-13 08:35:40', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b860d433efde5d3ffd57b15b36f607ee', 'sigfyss676sagysgaffg7sa8a24'),
('xNKGGQAACAAJ', 'Indian Garden Flowers', 'Treat yourself with some mouth-watering vegetarian dishes prepared by Prabhjot Monga. The recipes are intended to save cooking time and energy without compromising on taste. From delicious soups and salads to unusual sauces, from different kinds of rice and roti to mouth-watering desserts, this is innovative, exciting fare guaranteed to stimulate even the most jaded palate.', 420, 10, 'ACTIVE', '2022-04-13 08:37:23', '8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b860d433efde5d3ffd57b15b36f607ee', 'sigfyss676sagysgaffg7sa8a24');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CatId` varchar(250) NOT NULL,
  `CatName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatId`, `CatName`) VALUES
('sigfyss67fdg6sagysgaf7sa8a24', 'Arts'),
('sigfyss676sagysgaffg7sa8a24', 'Gardening'),
('sigfyss66gfdg76sagysgaf7sa8a', 'Horror'),
('sigfyss676sagysgaf7ereysa8a', 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `StoreId` varchar(250) NOT NULL,
  `UserId` varchar(250) NOT NULL,
  `StoreName` varchar(150) NOT NULL,
  `StoreStatus` enum('INACTIVE','ACTIVE','','') NOT NULL,
  `StoreDoc` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`StoreId`, `UserId`, `StoreName`, `StoreStatus`, `StoreDoc`) VALUES
('05c0e1160a257fc405c067b104e6da97', '8c23aea5b860d43e5d57b15b36f607ee', '  Chandru Book,Mangalore', 'ACTIVE', '2022-04-12 14:24:59'),
('8c23aea5b245d7fdr860d43e5d57b15b36f607ee', '8c23aea5b860d43e5d57b15b36f607ee', 'MK Books', 'ACTIVE', '2022-04-12 12:04:17'),
('8c23aea5b860d433efde5d3ffd57b15b36f607ee', '8c23aea5b860d43e5d57b15b36f607ee', 'Sharma Ji Ki Books', 'ACTIVE', '2022-04-12 12:04:59'),
('8c23aea5b860d43e5d57b15b36f607ee8c23aea5b860d43e5d57b15b36f607ee', '8c23aea5b860d43e5d57b15b36f607ee', 'Elon Books', 'ACTIVE', '2022-04-12 12:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` varchar(250) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(250) NOT NULL,
  `userDoc` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPassword`, `userDoc`) VALUES
('8c23aea5b860d43e5d57b15b36f607ee', 'TEMP', 'temp@mail.com', 'd6767885bf2cc81e0b59536d17ecaa1a8419a3790559ccaf762a3f036809bcdc', '2022-04-12 10:49:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatId`),
  ADD UNIQUE KEY `CatName` (`CatName`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`StoreId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
