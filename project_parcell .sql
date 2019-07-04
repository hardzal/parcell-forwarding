-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 02:38 AM
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
  `weight` int(11) NOT NULL,
  `is_broken` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deleted_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `name`, `price`, `stock`, `weight`, `is_broken`, `created_at`, `deleted_at`) VALUES
(1, 6, 'Action Figure Togame - Katanagatari', 700000, 5, 1, 1, 1562177041, 0),
(2, 3, 'Action figure Gundam XYZ', 2500000, 2, 1, 1, 1562176526, 0),
(3, 2, 'Action Figure Megumi Katou 1/1 Size', 35000000, 1, 1, 0, 1562176533, 0),
(5, 4, 'Machine Learning Item Pack 212', 2000000, 2, 1, 0, 1561898162, 0),
(6, 4, 'Action Figure Gundam Build', 300000, 3, 1, 0, 1561900508, 0),
(7, 4, 'Sword Real Online', 3000000, 5, 1, 1, 1561908993, 0),
(8, 2, 'Laptop Macintosh Winux', 9300000, 3, 1, 1, 1561917340, 0),
(9, 4, 'Guttling Gun SFX PUBG', 83000000, 10, 1, 1, 1562073753, 0),
(10, 4, 'Book Learning  Everything', 30000, 100, 1, 0, 1562077104, 0),
(11, 6, 'Full Course How to be a Ninja', 100000000, 100, 1, 0, 1562077337, 0),
(12, 2, 'Laptop Samsung', 250, 1, 2, 1, 1562146698, 0),
(13, 6, 'gundu', 20, 1, 3, 1, 1562147938, 0),
(14, 6, 'kelereng', 25, 2, 2, 1, 1562149547, 0),
(15, 4, 'Cobaan the series', 44, 3, 3, 0, 1562187811, 0),
(16, 5, 'Percobaan barang kembali', 55550, 3, 2, 1, 1562188936, 0),
(17, 4, 'Makanan big boss', 50000, 100, 15, 1, 1562189340, 0),
(18, 3, 'Game Mencari jodoh', 5000, 10, 2, 0, 1562189568, 0),
(19, 5, 'Belajar Bareng yuk', 12314141, 1, 1, 0, 1562197496, 0),
(20, 4, 'Ebook belajar Membaca', 100, 5, 3, 0, 1562198013, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_auctions`
--

CREATE TABLE `item_auctions` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_auctions`
--

INSERT INTO `item_auctions` (`id`, `item_id`, `price`, `stock`, `status`, `created_at`, `deleted_at`) VALUES
(2, 6, 486000, 3, 0, 1562051970, 1562199944),
(3, 5, 2562000, 2, 1, 1562051970, 1562199947),
(5, 11, 2147483647, 100, 0, 1562078032, 1562078032),
(8, 13, 36020, 1, 1, 1562157910, 1562199949),
(10, 16, 227583, 3, 0, 1562189687, 1562190287),
(14, 20, 144510, 5, 0, 1562198621, 1562199221);

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

CREATE TABLE `site_info` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 2, 'suryadijogja@gmail.com', '$2y$10$/WsYmkB9bf3fwhJi26uRPuGEasRMDudui0Pn228HdJg6YZtJj1/Da', 1, 1561396099),
(13, 2, 'dionugroho22@gmail.com', '$2y$10$dsgkiNGlu3JyEufNLpIYoe9xYofJvE4j1BZ8oTSRmJ4DW/lwsC2Ui', 1, 1562145471);

-- --------------------------------------------------------

--
-- Table structure for table `user_auctions`
--

CREATE TABLE `user_auctions` (
  `id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_auctions`
--

INSERT INTO `user_auctions` (`id`, `auction_id`, `user_id`, `price`, `status`, `created_at`) VALUES
(7, 8, 12, 6000000, 1, 1562186744),
(10, 3, 12, 312331312, 1, 1562186759);

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
(2, 1, 'Muhammad Rizal', '087781383892', 'Male', '1998-04-15', '4041.jpg', 'Jalan KH Agus Salim No 5', 'Kota Tangerang', 9, '15141'),
(3, 13, 'Dio Nugroho', '031241213', 'Male', '0000-00-00', 'config.jpg', 'Jalan Kamya', 'Kota Tangerang', 3, '123141');

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
(1, 12, 1, 1, 'OMnU/f', 1, 715000, 'Jagalan Beji PAI/437', 'Japan', 3, 'Yogyakarta', '55112', 'Barang gampang rusak harap hati hati dalam membawanya', 1, 1561707079, 1562043549),
(2, 12, 2, 1, 'ZM2GCz', 2, 6420000, 'Jalan KH Agus Salim', 'Japan Inc', 5, 'Penang', '320131', 'Hati hati', 1, 1561819978, 1562043549),
(3, 12, 3, 3, 'RpDDv3', 1, 44655000, 'Jagalan Beji', 'Japan', 8, 'Yogyakarta', '55112', 'Hati hati ya', 1, 1561861210, 1562043549),
(4, 1, 4, 1, 'wcIrK/', 1, 30030000, 'Jalan KH Agus Salim No 5', 'USA America', 3, 'Jakarta', '131241', 'Hati hati ya', 0, 1561891233, 1562043549),
(11, 12, 12, 1, 'fewiZp', 1, 30318.75, 'Jalan Benteng', 'USA America', 4, 'Wakacity', '102102', 'Lawak', 0, 1562146698, 1562150298);

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
(2, 1, 'Application-flow-codeigniter1.PNG', 1, 1561996869),
(4, 3, '45891355_2371302216230653_1716980495893397504_n.jpg', 1, 1562000251),
(5, 2, 'config.png', 1, 1562000334),
(9, 11, 'jekyll-now-theme-screenshot.jpg', 0, 1562147210);

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
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fkRolesId` (`role_id`);

--
-- Indexes for table `user_auctions`
--
ALTER TABLE `user_auctions`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `item_auctions`
--
ALTER TABLE `item_auctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_info`
--
ALTER TABLE `site_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_auctions`
--
ALTER TABLE `user_auctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_items`
--
ALTER TABLE `user_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
