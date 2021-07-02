-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 09:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merry-fish`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_type` text NOT NULL,
  `admin_name` text NOT NULL,
  `admin_username` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_uid` int(11) NOT NULL,
  `cart_order` text DEFAULT NULL,
  `cart_size` int(11) NOT NULL DEFAULT 0,
  `cart_start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cart_end_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `o_price` int(11) NOT NULL,
  `o_tracking_id` text NOT NULL,
  `invoice_file` text NOT NULL,
  `invoice_price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_uid`, `cart_order`, `cart_size`, `cart_start_date`, `cart_end_date`, `cart_status`, `o_price`, `o_tracking_id`, `invoice_file`, `invoice_price`) VALUES
(1, 1, NULL, 2, '2021-07-02 22:38:21', '2021-07-02 23:40:59', 1, 11300, '', '', ''),
(2, 1, NULL, 0, '2021-07-02 23:40:59', '2021-07-02 23:40:59', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `d_id` int(10) NOT NULL,
  `d_name` text NOT NULL,
  `dist_id` text NOT NULL,
  `d_address` text NOT NULL,
  `d_username` text NOT NULL,
  `d_password` text NOT NULL,
  `d_tier` int(10) NOT NULL DEFAULT 0,
  `d_phone` text NOT NULL,
  `d_email` text NOT NULL,
  `d_gst` text NOT NULL,
  `f_cart` int(11) NOT NULL DEFAULT 0,
  `dcart_id` int(11) NOT NULL,
  `d_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`d_id`, `d_name`, `dist_id`, `d_address`, `d_username`, `d_password`, `d_tier`, `d_phone`, `d_email`, `d_gst`, `f_cart`, `dcart_id`, `d_status`) VALUES
(1, 'test distributor', 'T01', 'test address', 'test', '1234', 1, '8141283971', 'test@test.com', '1231231', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(11) NOT NULL,
  `o_uid` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `o_status` int(11) NOT NULL,
  `o_product_id` int(11) NOT NULL,
  `o_product_code` text NOT NULL,
  `o_quantity` text NOT NULL,
  `o_price` text NOT NULL,
  `o_price_total` int(11) NOT NULL,
  `o_user_teir` text NOT NULL,
  `o_tracking_id` text NOT NULL,
  `o_create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `o_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `o_uid`, `cart_id`, `o_status`, `o_product_id`, `o_product_code`, `o_quantity`, `o_price`, `o_price_total`, `o_user_teir`, `o_tracking_id`, `o_create_date`, `o_update_date`) VALUES
(30, 1, 1, 1, 1, 'P01', '10', '10', 100, '1', '', '2021-07-02 17:55:14', '2021-07-02 18:10:59'),
(31, 1, 1, 1, 3, 'T02', '112', '100', 11200, '1', '', '2021-07-02 18:10:51', '2021-07-02 18:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_code` text NOT NULL,
  `p_name` text NOT NULL,
  `p_qty` text NOT NULL,
  `p_mrp` int(11) NOT NULL,
  `p_lending_price` int(11) NOT NULL,
  `p_price1` int(11) NOT NULL,
  `p_price2` int(11) NOT NULL,
  `p_create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `p_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `p_code`, `p_name`, `p_qty`, `p_mrp`, `p_lending_price`, `p_price1`, `p_price2`, `p_create_date`, `p_update_date`) VALUES
(1, 'P01', 'Prod test', '100', 12, 8, 10, 11, '2021-07-02 16:45:42', '2021-07-02 16:45:42'),
(3, 'T02', 'tset entry', '1000', 150, 80, 100, 110, '2021-07-02 17:18:20', '2021-07-02 17:18:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_name` varchar(30) DEFAULT NULL,
  `u_nickname` varchar(30) DEFAULT NULL,
  `u_username` varchar(30) DEFAULT NULL,
  `u_password` varchar(30) DEFAULT NULL,
  `u_role` text DEFAULT NULL,
  `u_phone` varchar(10) DEFAULT NULL,
  `u_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `u_nickname`, `u_username`, `u_password`, `u_role`, `u_phone`, `u_email`) VALUES
(1, 'Abas', 'Abas', 'abas', '1234', 'admin', NULL, 'abas@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `d_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
