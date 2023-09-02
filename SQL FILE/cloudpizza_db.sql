-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2023 at 07:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloudpizza_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `username`, `password`) VALUES
(1, 'Emirhan', 'Crimeron', '123'),
(2, 'Deneme', 'dnme', '123'),
(3, 'admin', 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `p_price` decimal(10,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `p_id`, `p_price`, `qty`, `total_price`, `size`) VALUES
(124, 9, 5, '1.00', 1, '1.00', NULL);

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `update_total_price` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN
    SET NEW.total_price = NEW.p_price * NEW.qty;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`category_id`, `name`) VALUES
(1, 'Pizza'),
(2, 'Dessert'),
(3, 'Drink'),
(4, 'Sauce');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Onay Bekliyor',
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `first_name`, `last_name`, `address`, `mobile`, `email`, `status`, `order_date`) VALUES
(47, 8, 'Deneme', 'Den', 'İzmir Deneme', '5078366725', 'deneme@gmail.com', 'Onay Bekliyor', '2023-06-13 23:03:21'),
(53, 11, 'Deneme', 'Dene', 'Adressssss', '5078366721', 'denemee@gmail.com', 'Başarılı', '2023-06-14 20:25:37'),
(54, 11, 'Deneme', 'Dene', 'Adressssss', '5078366721', 'denemee@gmail.com', 'Başarılı', '2023-06-14 20:40:17'),
(55, 11, 'Deneme', 'Dene', 'Adressssss', '5078366721', 'denemee@gmail.com', 'Başarılı', '2023-06-14 20:56:06'),
(56, 11, 'Deneme', 'Dene', 'Adressssss', '5078366721', 'denemee@gmail.com', 'Onay Bekliyor', '2023-06-14 22:17:16'),
(57, 9, 'musteriad', 'musterisoyad', 'Adres Denemmm', '5078366726', 'musteri@gmail.com', 'Onay Bekliyor', '2023-06-14 23:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` int(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `is_successful` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `user_id`, `p_id`, `p_name`, `p_price`, `qty`, `total_price`, `size`, `is_successful`) VALUES
(47, 8, 3, 'Tatlı Deneme 1', 50, 1, 50, '', 0),
(53, 11, 52, 'Yeni Pizza', 100, 1, 100, 'Small', 0),
(53, 11, 4, 'Kola', 10, 1, 10, '', 0),
(54, 11, 5, 'Mayonez Sos', 1, 1, 1, '', 0),
(55, 11, 52, 'Yeni Pizza', 100, 1, 100, 'Small', 0),
(55, 11, 4, 'Kola', 10, 1, 10, '', 0),
(56, 11, 52, 'Yeni Pizza', 100, 1, 100, 'Small', 0),
(57, 9, 5, 'Mayonez Sos', 1, 1, 1, '', 0),
(57, 9, 4, 'Kola', 10, 20, 200, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `p_id` int(11) NOT NULL,
  `category_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `img_path` text NOT NULL,
  `status` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`p_id`, `category_id`, `name`, `description`, `img_path`, `status`, `price`) VALUES
(4, 3, 'Kola', 'Kola Açıklama', '', 1, 10),
(5, 4, 'Mayonez Sos', 'Deneme Sos', '', 1, 1),
(52, 1, 'Yeni Pizza', 'Açıklaması', '', 1, 100),
(60, 2, 'Sufle', 'Sufle Detayları', '', 1, 30),
(65, 1, 'gizli', 'asdfgasdas', '', 0, 123);

-- --------------------------------------------------------

--
-- Table structure for table `p_ingr`
--

CREATE TABLE `p_ingr` (
  `p_id` int(11) NOT NULL,
  `ingr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `p_size`
--

CREATE TABLE `p_size` (
  `p_id` int(11) NOT NULL,
  `small` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `large` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_size`
--

INSERT INTO `p_size` (`p_id`, `small`, `medium`, `large`) VALUES
(52, 100, 150, 200),
(65, 123, 421, 123);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address`, `created_at`) VALUES
(5, 'Emirhan', 'Güngör', 'emirhan@gmail.com', '$2y$10$eevBWPeS4mX9UMXZqLdhOeju9.ZaOY2MPf.7OWKNN.YDsuMYKDSwm', '5078366724', 'Denizli Bağbaşı Mah.', '2023-06-13 22:41:55'),
(8, 'Deneme', 'Den', 'deneme@gmail.com', '$2y$10$EpI6tzaD5i3l7lfIn27vyOyXx9fO8ut9isawDWb7IhBr3TzpotHNm', '5078366725', 'İzmir Deneme', '2023-06-13 22:50:31'),
(9, 'musteriad', 'musterisoyad', 'musteri@gmail.com', '$2y$10$RDHACF9/ycRftfO.9BfstebB3ejtmGTzOkgDlJwOtK6w7UbSYRT5K', '5078366726', 'Adres Denemmm', '2023-06-13 23:09:46'),
(11, 'Deneme', 'Dene', 'denemee@gmail.com', '$2y$10$DJRfnRY9LY/2MDWBrazDQO7ueboKZjFrjE38cGIJs5c/lKnmxoHda', '5078366721', 'Adressssss', '2023-06-14 15:38:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `p_ingr`
--
ALTER TABLE `p_ingr`
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `p_size`
--
ALTER TABLE `p_size`
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product_list` (`p_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`category_id`);

--
-- Constraints for table `p_ingr`
--
ALTER TABLE `p_ingr`
  ADD CONSTRAINT `p_ingr_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_list` (`p_id`);

--
-- Constraints for table `p_size`
--
ALTER TABLE `p_size`
  ADD CONSTRAINT `p_size_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product_list` (`p_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
