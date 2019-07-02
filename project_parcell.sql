-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2019 at 05:20 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_parcell`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Brunei Darussalam'),
(2, 'Cambodia'),
(3, 'Indonesia'),
(4, 'Laos'),
(5, 'Malaysia'),
(6, 'Myanmar'),
(7, 'Philippines'),
(8, 'Singapore'),
(9, 'Thailand'),
(10, 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `cost_distance` int(11) NOT NULL,
  `cost_weight` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `name`, `cost_distance`, `cost_weight`, `description`) VALUES
(1, 'JNE', 5000, 15000, 'JNE Provider'),
(2, 'TIKI', 4500, 12000, 'Tiki'),
(3, 'Pos Indonesia', 6000, 10000, 'Pos Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` double NOT NULL,
  `stock` int(11) NOT NULL,
  `is_broken` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `price`, `stock`, `is_broken`, `created_at`, `deleted_at`) VALUES
(1, 4, 'Action Figure Togame - Katanagatari', 700000, 1, 1, 1561964035, 0),
(2, 1, 'Action figure Gundam XYZ', 2500000, 2, 1, 1561913352, 0),
(3, 4, 'Action Figure Megumi Katou 1/1 Size', 35000000, 1, 0, 1561861210, 0),
(5, 4, 'Machine Learning Item Pack 212', 2000000, 2, 0, 1561898162, 0),
(6, 4, 'Action Figure Gundam Build', 300000, 3, 0, 1561900508, 0),
(7, 4, 'Sword Real Online', 3000000, 5, 1, 1561908993, 0),
(8, 2, 'Laptop Macintosh Winux', 9300000, 3, 1, 1561917340, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_auctions`
--

CREATE TABLE `item_auctions` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `description`) VALUES
(1, 'Electronic', 'Barang - Barang elektro'),
(2, 'Handphone & Accessories', 'Barang - barang yang berisi handphone dan aksesoris'),
(3, 'Computer & Laptop', 'Barang - barang yang berisi Computer & Laptop'),
(4, 'Collection', 'Barang barang hobby koleksi'),
(5, 'Otomotif', 'Kendaraan - kendaraan'),
(6, 'Sport', 'Olaharaga'),
(7, 'Fashion', 'Pakaian - Pakaian');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `is_active`, `created_at`) VALUES
(1, 1, 'rizaldoeta98@gmail.com', '$2y$10$YQT.6Eg8NhXITIymhkKj5Okv9L35aHqAN4KAtzVzO.93xvB/BRiZW', 1, 1561217202),
(12, 2, 'suryadijogja@gmail.com', '$2y$10$t8VjHfH6uZuA3bLT6tKuWudsKfo/lW4LaQNprMVB7m5x1/zQB8yi.', 1, 1561396099);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birth_date` date DEFAULT NULL,
  `avatar` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `country_id` int(11) NOT NULL,
  `postcode` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `phone_number`, `gender`, `birth_date`, `avatar`, `address`, `city`, `country_id`, `postcode`) VALUES
(1, 12, 'Suryadi', '087808505477', 'Male', '1968-09-08', '404.jpg', 'Jagalan Beji PAI/437', 'Yogyakarta', 8, '55112'),
(2, 1, 'Muhammad Rizal', '087781383892', 'Male', '1998-04-15', '4041.jpg', 'Jalan KH Agus Salim No 5', 'Kota Tangerang', 9, '15141');

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

CREATE TABLE `user_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `item_code` varchar(6) NOT NULL,
  `total` int(11) NOT NULL,
  `cost` double NOT NULL,
  `address_to` text NOT NULL,
  `address_from` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_items`
--

INSERT INTO `user_items` (`id`, `user_id`, `item_id`, `delivery_id`, `item_code`, `total`, `cost`, `address_to`, `address_from`, `country_id`, `city`, `postcode`, `description`, `status`, `created_at`, `deleted_at`) VALUES
(1, 12, 1, 1, 'OMnU/f', 1, 715000, 'Jagalan Beji PAI/437', 'Japan', 3, 'Yogyakarta', '55112', 'Barang gampang rusak harap hati hati dalam membawanya', 0, 1561707079, 0),
(2, 12, 2, 1, 'ZM2GCz', 2, 6420000, 'Jalan KH Agus Salim', 'Japan Inc', 5, 'Penang', '320131', 'Hati hati', 0, 1561819978, 0),
(3, 12, 3, 3, 'RpDDv3', 1, 44655000, 'Jagalan Beji', 'Japan', 8, 'Yogyakarta', '55112', 'Hati hati ya', 0, 1561861210, 0),
(4, 1, 4, 1, 'wcIrK/', 1, 30030000, 'Jalan KH Agus Salim No 5', 'USA America', 3, 'Jakarta', '131241', 'Hati hati ya', 0, 1561891233, 0),
(5, 1, 5, 2, 'SxsyNM', 2, 5124000, 'Jalan KH Agus Salim', 'Japan Inc', 8, 'Penang', '320131', 'Untuk pelajaran', 0, 1561898162, 0),
(6, 12, 6, 2, 'w6Lnwb', 3, 972000, 'Jagalan Beji PAI/437', 'Japan Inc', 3, 'Yogyakarta', '555311', 'Nhahahha', 0, 1561900508, 0),
(7, 12, 8, 2, 'ad6ZBH', 3, 35680500, 'Jalan KH Agus Salim', 'Japan Inc', 8, 'Singapore', '320131', 'Hati hati ya', 0, 1561917340, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `created_at`) VALUES
(15, 'suryadijogja@gmail.com', 'MFGRdG0U8mb7aRrVuTvVbF9A7ithN5JCp7zTloBRn6k=', 1561446701),
(16, 'suryadijogja@gmail.com', 'r5JLfPro05XbtreqVpuGK5MVLyyqd441E6MN8zNZuV4=', 1561474141);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` int(11) NOT NULL,
  `user_item_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `user_item_id`, `image`, `status`, `created_at`) VALUES
(2, 1, 'Application-flow-codeigniter1.PNG', 0, 1561996869),
(4, 3, '45891355_2371302216230653_1716980495893397504_n.jpg', 1, 1562000251),
(5, 2, 'config.png', 0, 1562000334);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_auctions`
--
ALTER TABLE `item_auctions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fkRolesId` (`role_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkUserId` (`user_id`);

--
-- Indexes for table `user_items`
--
ALTER TABLE `user_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_code` (`item_code`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item_auctions`
--
ALTER TABLE `item_auctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fkRolesId` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `fkUserId` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
