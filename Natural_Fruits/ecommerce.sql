-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2024 at 11:24 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_id` char(36) NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `admin_id`) VALUES
(3, 'admin1', 'minhkhai8252@gmail.com', 'a0d19691fc8f4c1b4c73201781ccd5c4', '9ce52fcf-12e2-11ef-b040-f7eed6c56f01');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `ProductImage` varchar(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `user_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `ProductName`, `Price`, `ProductImage`, `Quantity`, `user_id`) VALUES
(34, 'Gift Box Tình Yêu 2', '200', 'holiday_gift-9.jpg', 1, 'b22eba0c-129a-11ef-a20c-f7eed6c56f01'),
(35, 'Mận Mỹ', '40', 'fresh_fruit-8.jpg', 1, 'b22eba0c-129a-11ef-a20c-f7eed6c56f01'),
(44, 'Dưa hấu không hạt', '20', 'fresh_fruit-6.jpg', 1, ''),
(45, 'Nho Mỹ', '50', 'imported-7.png', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `ap_number` varchar(12) NOT NULL,
  `street` varchar(100) NOT NULL,
  `sub_address` varchar(50) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `total_products` varchar(50) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `user_id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `name`, `email`, `phone`, `method`, `ap_number`, `street`, `sub_address`, `city`, `country`, `zip_code`, `total_products`, `total_price`, `user_id`) VALUES
(1, 'admin1', '', '0323121', 'thanh toán tiền mặt', '10', 'Pham Dang Chieu', 'Quan 10', 'TP HCM', 'Viet Nam', '123155', 'Thanh Long Bình Thuận (1), Bưởi xanh (1), Dâu Tây ', '330', ''),
(2, 'admin1', 'admin@gmail.com', '03394813', 'thanh toán tiền mặt', '10', 'Nguyen Quang Luan', 'Quan 12', 'TP HCM', 'Viet Nam ', '123515', 'Thanh Long Bình Thuận (1), Bưởi xanh (1), Dâu Tây ', '330', ''),
(3, 'Nguyen Minh Khai', 'minhkhai@gmail.com', '0323131312', 'thanh toán tiền mặt', '10', 'Phạm Đăng Chiểu', 'Quận 10', 'TP HCM', 'Việt Nam ', '124156', 'Thanh Long Bình Thuận (1), Bưởi xanh (1), Dâu Tây ', '330', ''),
(4, 'Nguyen Minh Khai', 'minhkhai@gmail.com', '0323131312', 'thanh toán tiền mặt', '10', 'Phạm Đăng Chiểu', 'Quận 10', 'TP HCM', 'Việt Nam ', '123456', 'Bơ tươi(1), Nho Mỹ(1), Gift Box Tình Yêu 2(1), Mận', '370', ''),
(5, 'Nguyen Khai', 'minhkhai8252@gmail.com', '0339863704', 'thanh toán tiền mặt', '10 ABC', '10 Phạm Ngọc Thạch, Thị Trấn Phan Rí Cửa, Tuy Phong, Bình Thuận', 'Binh Thuận', 'Phan Thiết', 'Vietnam', '77216', 'Cam vàng(1), Dưa hấu không hạt(1), Bơ tươi(1), Nho', '130', ''),
(6, 'Nguyen Khai', 'minhkhai8252@gmail.com', '0339863704', 'thanh toán tiền mặt', '10 ABC', '10 Phạm Ngọc Thạch, Thị Trấn Phan Rí Cửa, Tuy Phong, Bình Thuận', 'Bình Thuận', 'Phan Thiết', 'Vietnam', '77216', 'Dưa hấu không hạt(1), Cam vàng(1), Cam vàng(1), Bơ', '160', 'c453b47f-12a4-11ef-a20c-f7eed6c56f01'),
(7, 'Nguyen Khai', 'minhkhai8252@gmail.com', '0339863704', 'thanh toán tiền mặt', '10 ABC', '10 Phạm Ngọc Thạch, Thị Trấn Phan Rí Cửa, Tuy Phong, Bình Thuận', 'Bình Thuận', 'Phan Thiết', 'Vietnam', '77216', 'Dưa hấu không hạt(1), Cam vàng(1), Cam vàng(1), Bơ', '160', 'c453b47f-12a4-11ef-a20c-f7eed6c56f01'),
(8, 'Nguyen Khai', 'minhkhai8252@gmail.com', '0339863704', 'thanh toán tiền mặt', '10 ABC', '10 Phạm Ngọc Thạch, Thị Trấn Phan Rí Cửa, Tuy Phong, Bình Thuận', 'Bình Thuận', 'Phan Thiết', 'Vietnam', '77216', 'Dưa hấu không hạt(1), Cam vàng(1), Cam vàng(1), Bơ', '160', 'c453b47f-12a4-11ef-a20c-f7eed6c56f01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `ProductImage` varchar(100) NOT NULL,
  `ProductType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `ProductName`, `Price`, `ProductImage`, `ProductType`) VALUES
(1, 'Dâu Tây Anh Đào', '60', 'fresh_fruit-12.jfif', 'feature_fruit'),
(2, 'Sẩu riêng Dona', '70', 'fresh_fruit-3.jpg', 'feature_fruit'),
(3, 'Quýt Úc', '50', 'product-1.jpg', 'feature_fruit'),
(4, 'Mận Mỹ', '40', 'fresh_fruit-8.jpg', 'bestseller_fruit'),
(5, 'Gift Box Tình Yêu 2', '200', 'holiday_gift-9.jpg', 'bestseller_fruit'),
(6, 'Dưa hấu không hạt', '20', 'fresh_fruit-6.jpg', 'fresh_fruit'),
(7, 'Cam vàng', '30', 'fresh_fruit-5.jpg', 'fresh_fruit'),
(8, 'Bơ tươi', '30', 'fresh_fruit-10.jfif', 'fresh_fruit'),
(9, 'Khây trái cây hồng phát 1', '200', 'gift_fruit-1.png', 'gift_fruit'),
(10, 'Quà tặng tri ân 1', '200', 'holiday_gift-5.jpg', 'holiday_gift'),
(11, 'Nho Mỹ', '50', 'imported-7.png', 'imported_fruit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `UserImage` varchar(100) NOT NULL,
  `UserPhone` varchar(20) NOT NULL,
  `Ap_number` varchar(100) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `Sub_address` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `user_id` char(36) NOT NULL DEFAULT uuid()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `UserName`, `Email`, `Password`, `UserImage`, `UserPhone`, `Ap_number`, `Street`, `Sub_address`, `Country`, `City`, `user_id`) VALUES
(1, 'Nguyen Minh Khai', 'minhkhai@gmail.com', '7aab6cc652347dc80218d721fb2a5909', '˚₊· ͟͟͞͞➳ ❝ ƙᥙj᥆zᥱᥒᥒ ; ίᥴ᥆ꪀ ❞.jfif', '0323131312', '10', 'Phạm Đăng Chiểu', 'Quận 10', 'Việt Nam ', 'TP HCM', '678a0654-1294-11ef-a20c-f7eed6c56f01'),
(4, 'Minh Khai', 'minhkhai8252@gmail.com', 'a0d19691fc8f4c1b4c73201781ccd5c4', '', '', '', '', '', '', '', 'b22eba0c-129a-11ef-a20c-f7eed6c56f01'),
(5, 'Nguyen Minh Khai', 'minhkhai8252@gmail.com', 'a0d19691fc8f4c1b4c73201781ccd5c4', 'cat_birthday.png', '0339863704', '10 ABC', '10 Phạm Ngọc Thạch, Thị Trấn Phan Rí Cửa, Tuy Phong, Bình Thuận', 'Bình Thuận', 'Vietnam', 'Phan Thiết', 'c453b47f-12a4-11ef-a20c-f7eed6c56f01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
