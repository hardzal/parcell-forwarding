-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 03, 2020 at 01:01 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

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

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `cost_distance` int(11) NOT NULL,
  `cost_weight` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `price` double NOT NULL,
  `stock` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `is_broken` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `price`, `stock`, `weight`, `is_broken`, `created_at`, `deleted_at`) VALUES
(23, 3, 'Sushis', 10000, 10, 3, 0, 1577751582, 0),
(24, 3, 'Makanan', 10231, 3, 2, 1, 1577752532, 0),
(25, 4, 'siapa yang bisa', 1231, 2, 3, 1, 1577752761, 0),
(26, 3, 'Lagu', 35000, 3, 2, 1, 1577753064, 0),
(28, 3, 'mencoba', 2000, 2, 2, 0, 1577762125, 0),
(29, 5, 'koala', 2000000, 3, 5, 1, 1577762282, 0),
(30, 3, 'isi lagi', 30000, 3, 3, 0, 1577762826, 0),
(31, 5, 'Makanan', 100000, 11, 22, 1, 1577767079, 0),
(32, 4, 'dsdsadas3', 35000, 2, 3, 1, 1577767116, 0),
(33, 5, 'Sushis', 30000, 20, 3, 0, 1577769328, 0),
(34, 2, 'Katsuya', 15000, 3, 5, 1, 1577784666, 0),
(35, 1, 'Handphone', 1, 1, 1, 1, 1578048295, 0),
(36, 3, 'Laptop', 10, 1, 7, 1, 1578048732, 0),
(37, 1, 'Loli', 1, 1, 1, 1, 1578055560, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_auctions`
--

DROP TABLE IF EXISTS `item_auctions`;
CREATE TABLE IF NOT EXISTS `item_auctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_auctions`
--

INSERT INTO `item_auctions` (`id`, `item_id`, `price`, `stock`, `status`, `created_at`, `deleted_at`) VALUES
(16, 22, 665280, 12, 0, 1577751453, 1577752053),
(17, 23, 440000, 10, 0, 1577752198, 1577752798),
(18, 24, 88907, 3, 0, 1577760786, 1577761386),
(19, 25, 74511, 2, 0, 1577760786, 1577761386),
(20, 26, 30000, 3, 0, 1577760787, 1577761387),
(21, 27, 92520, 3, 0, 1577761857, 1577762457),
(22, 28, 42480, 2, 0, 1577762788, 1577763388),
(24, 30, 20000, 3, 0, 1577763494, 1577764094),
(25, 24, 3058000, 11, 0, 1577769262, 1577769862),
(26, 35, 12001, 1, 1, 1578048951, 1578049551),
(27, 36, 84008, 1, 1, 1578053751, 1578054351);

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

DROP TABLE IF EXISTS `item_categories`;
CREATE TABLE IF NOT EXISTS `item_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `description`, `created_at`) VALUES
(2, 'Parcell Forwarding Good Service', 'WhatsApp_Image_2019-07-03_at_18_45_151.jpeg', 'Parcell Good Service adalah sebuah website yang melayani pemesanan online, serta melayani pelelangan barang yang berharga murah semua itu bisa didapat dengan mudah.', 0),
(3, 'Well Done Parcell', 'parcel.png', 'Berbagai barang bisa didapatkan mudah tanpa perlu sulit mencari di situs situs lain, harga bisa terjangkau serta beban pajak yang rendah.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

DROP TABLE IF EXISTS `site_info`;
CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'About Us', 'Parcell Forwarding adalah sebuah layanan pihak ketiga yang menjembatani antara pembeli dengan produsen di luar jangkauan pembeli, sehingga pembeli bisa membeli barang apapun tanpa terhalang oleh jarak serta bisa lebih berhemat oleh beban pajak yang berlebih. Selain melayani pemesanan barang, Kami juga mengadakan pelelangan barang yang lebih murah dari harga aslinya sehigga pembeli bisa membeli barang tersebut', 2147483647),
(2, 'Facebook', 'http://www.facebook.com/parcell-forwarding', 2147483647),
(3, 'Twitter', '@parcellforwarding', 2147483647),
(4, 'Instagram', '@parcellforwarding', 2147483647),
(5, 'Email', 'parcellforwarding@pf.id', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fkRolesId` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `is_active`, `created_at`) VALUES
(1, 1, 'admin@gmail.com', '$2y$10$YQT.6Eg8NhXITIymhkKj5Okv9L35aHqAN4KAtzVzO.93xvB/BRiZW', 1, 1561217202),
(12, 2, 'member@gmail.com', '$2y$10$/WsYmkB9bf3fwhJi26uRPuGEasRMDudui0Pn228HdJg6YZtJj1/Da', 1, 1561396099),
(13, 2, 'dionugroho22@gmail.com', '$2y$10$0W7VRejQP8i5zZF9j7HW0u457.KaXT3EMuvWXQJOi7JqWrkMBVG6m', 1, 1562145471),
(17, 2, 'suryad793@gmail.com', '$2y$10$iy65xuL1uMVqNrVUL9Vt3.80qAxANCrpNREW3PsWcHWQKH5RLicey', 0, 1577807040),
(18, 2, 'langkahkita02@gmail.com', '$2y$10$xmAfF.kmeAt6PQxYI/vvsu5mDwVzvMfBenco8XBrX9qYOgarzFlNm', 0, 1577807095),
(19, 2, 'langkahkita01@gmail.com', '$2y$10$zXUJsj1YkeViwrB8Vf5o9ubl7sUfCEC4xP25WqKl2zVJsKKTmqSju', 1, 1577807219),
(20, 2, 'cobacoba@gmail.com', '$2y$10$m1PHcZK/gzDsF/wczDr2LOfsUrdmKPBY9FjFVrntGtWQdpAt4ugPa', 0, 1577850490),
(21, 2, 'cobaini@gmail.com', '$2y$10$N.GOAovF2OTQ.IBWkS8ZIuQDZlfqHRxL1bV3SvO5K1uc9N9pJTB0G', 0, 1578047644),
(22, 2, 'ini@gmail.com', '$2y$10$fLLFKKe7I2sNFqDPQxK5T.X.3Uc3KcuT6dsgf4U4ciwf4xxDyPt.i', 0, 1578048092),
(23, 2, 'itu@gmail.com', '$2y$10$8RVxxUuGhbFf2/eB.7VdDOa/FmllCgNMlWTVQ0LZD8/uLIMSIeGiW', 0, 1578048159);

-- --------------------------------------------------------

--
-- Table structure for table `user_auctions`
--

DROP TABLE IF EXISTS `user_auctions`;
CREATE TABLE IF NOT EXISTS `user_auctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birth_date` date DEFAULT NULL,
  `avatar` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `country_id` int(11) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkUserId` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `phone_number`, `gender`, `birth_date`, `avatar`, `address`, `city`, `country_id`, `postcode`) VALUES
(1, 12, 'Suryadi', '087808505477', 'Male', '1968-09-08', '404.jpg', 'Jagalan Beji PAI/437', 'Yogyakarta', 8, '55112'),
(2, 1, 'Muhammad Rizal', '087781383892', 'Male', '1998-04-15', '4041.jpg', 'Jalan KH Agus Salim No 5', 'Kota Tangerang', 9, '15141'),
(3, 13, 'Dio Nugroho', '031241213', 'Male', '2017-12-05', 'default.jpg', 'Jalan Kamya', 'Kota Tangerang', 3, '123141'),
(4, 19, 'Langkah kita', '08779123131', 'Male', '2019-12-19', 'jual_MieMie_InstanIndomieIndomie_Ayam_Bawang.jpg', 'siapa yang bisa, kdoaskdoas', 'singapura', 0, '230201'),
(5, 22, 'Ini', '08975021621', 'Male', '2000-10-10', 'default.jpg', 'Jakarta', 'Jakarta', 0, '12250'),
(6, 23, 'itu', '089750216621', 'Male', '2000-10-10', 'default.jpg', 'Jakarta', 'Jakarta', 0, '12260');

-- --------------------------------------------------------

--
-- Table structure for table `user_items`
--

DROP TABLE IF EXISTS `user_items`;
CREATE TABLE IF NOT EXISTS `user_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `item_code` varchar(6) NOT NULL,
  `total` int(11) NOT NULL,
  `cost_delivery` double DEFAULT NULL,
  `cost_tax` double DEFAULT NULL,
  `cost_total` double NOT NULL,
  `address_to` text NOT NULL,
  `address_from` text NOT NULL,
  `city` varchar(128) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_code` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_items`
--

INSERT INTO `user_items` (`id`, `user_id`, `item_id`, `delivery_id`, `country_id`, `item_code`, `total`, `cost_delivery`, `cost_tax`, `cost_total`, `address_to`, `address_from`, `city`, `postcode`, `description`, `status`, `created_at`, `deleted_at`) VALUES
(24, 12, 23, 2, 6, 'LSRObv', 20, 36000, 8250, 1485000, 'jalan menuju keadilan', 'jalanan', 'burma', '31312', 'kepada siapa kamu bertanya?', 1, 1577769328, 1577769928),
(25, 13, 34, 2, 7, 'ZvJeR8', 3, 60000, 4125, 237375, 'Jalanan', 'Jalan KH Agus Salim', 'Manila', '123131', 'vi hance', 1, 1577784666, 1577785266),
(28, 23, 37, 1, 3, 'nkMguX', 1, 15000, 0, 15001, 'Timur', 'Jogja', 'Bali', '15520', 'Okedah', 1, 1578055560, 1578056160);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `created_at`) VALUES
(7, 'cobacoba@gmail.com', 'QCEiQwQTq5FLXDRgU1C5yH2VQUUPGd+aUrzs3Cqh38I=', 1577850489),
(8, 'cobaini@gmail.com', 'WzLtRSQUM2BdhGPeLkRQ50kS7yk5SEn/sy9LcNGlif8=', 1578047644);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

DROP TABLE IF EXISTS `user_transactions`;
CREATE TABLE IF NOT EXISTS `user_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_item_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `user_item_id`, `image`, `status`, `created_at`) VALUES
(10, 24, '80637125_2643851305663731_1438791869243850752_n.jpg', 1, 1577769606),
(11, 25, 'IP^-1.PNG', 1, 1577784807),
(12, 28, '25634.png', 1, 1578055632);

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
