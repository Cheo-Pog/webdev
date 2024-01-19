-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 19, 2024 at 12:41 PM
-- Server version: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`id`, `username`, `password`, `rank`) VALUES
(2, 'Jesse321', 'WEED', 'admin'),
(12, 'waltuh', 'finger', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(65,2) NOT NULL,
  `description` varchar(999) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `category`) VALUES
(19, 'cool cat', 999.00, 'this cat does not give a damn', 'uploads/doigiveadamn.jpg', 'cats'),
(20, 'shirt', 6.99, 'this is a basic shirt', 'uploads/shirt.jpg', 'shirts'),
(21, 'blue shirt', 9.99, 'a blue shirt', 'uploads/bshirt.jpg', 'shirts'),
(22, 'MIKU', 1000000.00, 'omg, MIKU!', 'uploads/mikucat.jpg', 'cats'),
(23, 'black skirt', 6.99, 'this is a black skirt', 'uploads/bskirt.jpg', 'skirts'),
(24, 'brown skirt', 6.99, 'this is a brown skirt', 'uploads/8521c187-1040-4e1b-9daf-75c79e7d90fa.eae5e9e8d428f2a31a9a2a6d220eb445.jpg', 'skirts'),
(25, 'estrogen', 0.01, 'hmmmm yummers', 'uploads/estrogen.jpg', 'hormones'),
(26, 'testosterone', 0.02, 'hmmm yummy', 'uploads/testosterone.jpg', 'hormones');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `orderId` int(255) NOT NULL,
  `userId` int(255) NOT NULL,
  `productId` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`orderId`, `userId`, `productId`, `quantity`) VALUES
(5, 8, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`orderId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `orderId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
