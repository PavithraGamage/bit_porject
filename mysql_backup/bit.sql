-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 08:05 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bit`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(28, 'ASUS'),
(29, 'INTEL'),
(30, 'AMD');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` longtext NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `cat_image`) VALUES
(24, 'Processors', 'A central processing unit (CPU), also called a central processor, main processor or just processor, is the electronic circuitry that executes instructions comprising a computer program. The CPU performs basic arithmetic, logic, controlling, and input/output (I/O) operations specified by the instructions in the program.', 'CPU-Processor.png'),
(25, 'Motherboard', 'A motherboard (also called mainboard, main circuit board,[1] or mobo) is the main printed circuit board (PCB) in general-purpose computers and other expandable systems. It holds and allows communication between many of the crucial electronic components of a system, such as the central processing unit (CPU) and memory, and provides connectors for other peripherals. Unlike a backplane, a motherboard usually contains significant sub-systems, such as the central processor, the chipset&#039;s input/output and memory controllers, interface connectors, and other components integrated for general use.', 'z390-motherboard-20190513-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `recorder_level` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `discount_rate` int(11) NOT NULL,
  `item_description` longtext NOT NULL,
  `date` date NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `warranty` int(11) NOT NULL,
  `warranty_period` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_image`, `item_name`, `sku`, `recorder_level`, `unit_price`, `sale_price`, `discount_rate`, `item_description`, `date`, `stock`, `warranty`, `warranty_period`, `category_id`, `brand_id`, `model_id`) VALUES
(111, 'BsDbnZuclfqlHKAa_setting_xxx_0_90_end_800.png', 'TUF B450-PLUS GAMING', 'TUFB450', 18, 28500, 25500, 11, 'AMD B450 ATX gaming motherboard with Aura Sync RGB LED lighting, DDR4 4400MHz support, 32Gbps M.2, HDMI 2.0b, Type C and native USB 3.1 Gen 2.\r\nFan Xpert 4 Core: Ensures every fan achieves the best balance of cooling performance and acoustics\r\nTUF Protection: SafeSlot, ESD Guards, DDR4 overvoltage protection, Digi+ VRM, and stainless-steel back I/O for long-term reliability\r\nMilitary-grade TUF Components: TUF LANGuard, TUF Chokes, TUF Capacitors, and TUF MOSFETs for maximum durability\r\nExclusive DTS® Custom audio: Delivers positional cues to stereo headphones, helping you to pinpoint enemies and action\r\nAura Sync RGB: Synchronize LED lighting with a vast portfolio of compatible PC gear', '2022-02-20', NULL, 0, 0, 25, 28, 11),
(113, 'BsDbnZuclfqlHKAa_setting_xxx_0_90_end_800.png', 'jakskjdds', 'dajjss', 84930, 122321, 32123, 74, '', '2022-02-20', NULL, 0, 0, 24, 28, 3),
(114, 'cinnamon-1971496.jpg', 'kjdksaj', '112584584', 873, 32131321, 231231, 99, 'description ', '2022-02-20', NULL, 0, 0, 24, 28, 1),
(116, 'peppercorns-6997562.jpg', 'dawad', 'kjshjaki', 15445, 15585848, 23213, 100, 'disc', '2022-02-20', NULL, 0, 0, 24, 29, 1),
(117, 'dasd.png', 'dawads', 'kjshjakis', 15445, 15585848, 23213, 100, 'disc', '2022-02-20', NULL, 0, 0, 24, 29, 1),
(118, '2.jpg', 'spec test', 'jjsiiiajw112', 92, 99217720, 882891, 99, 'suus', '2022-02-20', NULL, 0, 0, 24, 28, 1),
(119, '20220115_121201.jpg', 'testjhjasoio', '1122888', 125, 1254887, 125879, 90, 'sda', '2022-02-20', NULL, 0, 0, 24, 28, 1),
(120, 'Mr janaka Front.jpg', 'daswdwa', 'ijsaij0', 91, 999201, 123321, 88, 'UIWQIU', '2022-02-20', NULL, 0, 0, 24, 28, 1),
(121, 'C&amp;D 2nd Flyer 2 with WM.jpg', 'SDAS', 'HHSUUAW', 773, 7737729, 6535525, 16, '77721', '2022-02-20', NULL, 0, 0, 24, 28, 3);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`model_id`, `model_name`) VALUES
(1, 'RTX 2060'),
(3, 'B450'),
(4, 'RYZEN 9');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` varchar(4) NOT NULL,
  `description` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `view` varchar(50) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `description`, `path`, `view`, `icon`, `status`) VALUES
('02', 'Brand Management', 'inventory/brands', '', '', 1),
('0201', 'Add Brand', 'inventory/brands', 'add', '', 1),
('03', 'Category Management', 'inventory/categories', '', '', 1),
('0301', 'Add Category', 'inventory/categories', 'add', '', 1),
('05', 'Model Management', 'inventory/models', '', '', 1),
('0501', 'Add Model', 'inventory/models', 'add', '', 1),
('06', 'Item Specifications', 'inventory/specifications', '', '', 1),
('0601', 'Add Specifications', 'inventory/specifications', 'add', '', 1),
('07', 'Item Management', 'inventory/items', '', '', 1),
('0701', 'Add Item', 'inventory/items', 'add', '', 1),
('0702', 'Add to Stock', 'inventory/items', 'stock', '', 1),
('08', 'Staff Management', 'users/staff', '', '', 1),
('0801', 'Add Staff', 'users/staff', 'add', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specifications`
--

CREATE TABLE `specifications` (
  `spec_id` int(11) NOT NULL,
  `spec` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specifications`
--

INSERT INTO `specifications` (`spec_id`, `spec`, `category_id`) VALUES
(20, 'CPU', 25),
(21, 'Chipset', 25),
(22, 'Memory', 25),
(23, 'Graphic', 25),
(24, 'Multi-GPU Support', 25),
(25, 'Expansion Slots', 25),
(26, 'Storage', 25),
(27, 'LAN', 25),
(29, 'USB Ports', 25);

-- --------------------------------------------------------

--
-- Table structure for table `spec_items`
--

CREATE TABLE `spec_items` (
  `id` int(11) NOT NULL,
  `spec_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spec_items`
--

INSERT INTO `spec_items` (`id`, `spec_id`, `item_id`, `value`) VALUES
(246, 3, 107, '2'),
(247, 4, 107, '6'),
(248, 5, 107, '64'),
(249, 7, 107, '3.8'),
(250, 9, 107, '105'),
(251, 3, 108, '1'),
(252, 4, 108, '1'),
(253, 5, 108, '1'),
(254, 7, 108, '1'),
(255, 9, 108, '1'),
(256, 13, 109, '12'),
(257, 13, 110, '1252'),
(258, 20, 111, 'AMD AM4 Socket for AMD Ryzen™ 5000 Series/ 5000 G-Series/ 4000 G-Series/ 3rd/2nd/1st Gen AMD Ryzen™/ 2nd and 1st Gen AMD Ryzen™ with Radeon™ Vega Graphics/ Athlon™ with Radeon™ Vega Graphics'),
(259, 21, 111, 'B450'),
(260, 22, 111, '4 x DIMM, Max. 128GB, DDR4 4400(O.C)/3466(O.C.)/3200(O.C.)/3000(O.C.)/2800(O.C.)/2666/2400/2133 MHz Un-buffered Memory'),
(261, 23, 111, 'Integrated Graphics in the 2nd and 1st Gen AMD Ryzen™ with Radeon™ Vega Graphics/ Athlon™ with Radeon™ Vega Graphics Processors'),
(262, 24, 111, 'Supports AMD CrossFireX™ Technology'),
(263, 25, 111, '3rd/2nd/1st Gen AMD Ryzen™ Processors 1 x PCIe 3.0/2.0 x16 (x16 mode) 2nd and 1st Gen AMD Ryzen™ with Radeon™ Vega Graphics Processors 1 x PCIe 3.0/2.0 x16 (x8 mode)'),
(264, 26, 111, '3rd/2nd/1st Gen AMD Ryzen™/ 2nd and 1st Gen AMD Ryzen™ with Radeon™ Vega Graphics : 1 x M.2 Socket 3, with M key, type 2242/2260/2280/22110 storage devices support (SATA & PCIE 3.0 x 4 mode)*2'),
(265, 27, 111, 'Realtek® RTL8111H TUF LANGuard'),
(266, 28, 111, 'Realtek ALC887/897 8-Channel High Definition Audio CODEC *2 Audio Feature : - Exclusive DTS Custom for GAMING Headsets. - Audio Shielding - Dedicated audio PCB layers'),
(267, 29, 111, '1 x PS/2 keyboard/mouse combo port(s) 1 x DVI-D 1 x HDMI 1 x LAN (RJ45) port(s) 1 x 5Gb/s port(s) USB Type-CTM'),
(268, 20, 112, '89289'),
(269, 21, 112, ''),
(270, 22, 112, ''),
(271, 23, 112, ''),
(272, 24, 112, ''),
(273, 25, 112, ''),
(274, 26, 112, ''),
(275, 27, 112, ''),
(276, 29, 112, ''),
(277, 20, 113, ''),
(278, 21, 113, ''),
(279, 22, 113, ''),
(280, 23, 113, ''),
(281, 24, 113, ''),
(282, 25, 113, ''),
(283, 26, 113, ''),
(284, 27, 113, ''),
(285, 29, 113, ''),
(286, 20, 114, 'cpu'),
(287, 21, 114, 'Chipset '),
(288, 22, 114, 'Memory '),
(289, 23, 114, 'Memory '),
(290, 24, 114, 'Multi-GPU Support'),
(291, 25, 114, 'Multi-GPU Support'),
(292, 26, 114, 'storage'),
(293, 27, 114, 'lan'),
(294, 29, 114, 'usb'),
(295, 20, 115, 'CPU'),
(296, 21, 115, 'Chipset'),
(297, 22, 115, 'memory'),
(298, 23, 115, 'graphic'),
(299, 24, 115, 'multi-gpu'),
(300, 25, 115, 'expation'),
(301, 26, 115, 'storahe'),
(302, 27, 115, 'lan'),
(303, 29, 115, 'usb'),
(304, 20, 116, 'a'),
(305, 21, 116, 'b'),
(306, 22, 116, 'c'),
(307, 23, 116, 'd'),
(308, 24, 116, 'e'),
(309, 25, 116, 'f'),
(310, 26, 116, 'g'),
(311, 27, 116, 'h'),
(312, 29, 116, '1'),
(313, 20, 117, 'a'),
(314, 21, 117, 'b'),
(315, 22, 117, 'c'),
(316, 23, 117, 'd'),
(317, 24, 117, 'e'),
(318, 25, 117, 'f'),
(319, 26, 117, 'g'),
(320, 27, 117, 'h'),
(321, 29, 117, '1'),
(322, 20, 118, '82'),
(323, 21, 118, '82'),
(324, 22, 118, '28'),
(325, 23, 118, '82'),
(326, 24, 118, '28'),
(327, 25, 118, '28'),
(328, 26, 118, '28'),
(329, 27, 118, '28'),
(330, 29, 118, '28'),
(331, 20, 119, '12'),
(332, 21, 119, '14'),
(333, 22, 119, '15'),
(334, 23, 119, '16'),
(335, 24, 119, '18'),
(336, 25, 119, '18'),
(337, 26, 119, '12'),
(338, 27, 119, '12'),
(339, 29, 119, '18'),
(340, 20, 120, '920'),
(341, 21, 120, '9201'),
(342, 22, 120, '0290'),
(343, 23, 120, '09200'),
(344, 24, 120, '0920'),
(345, 25, 120, '092'),
(346, 26, 120, '092'),
(347, 27, 120, '029'),
(348, 29, 120, '092'),
(349, 20, 121, '63'),
(350, 21, 121, '63'),
(351, 22, 121, '6378'),
(352, 23, 121, '389'),
(353, 24, 121, '3678'),
(354, 25, 121, '3788'),
(355, 26, 121, '7739'),
(356, 27, 121, '77391'),
(357, 29, 121, '7279');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `item_serial` varchar(255) NOT NULL,
  `stock_date` date NOT NULL,
  `stock_status` int(2) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `item_serial`, `stock_date`, `stock_status`, `item_id`) VALUES
(33, '1223447747', '2022-02-20', 1, 111),
(34, '122548488', '2022-02-20', 1, 111),
(35, '122548488145', '2022-02-20', 1, 111),
(36, '1225484884874', '2022-02-20', 1, 111),
(37, '1225484884898', '2022-02-20', 1, 111),
(38, '12254848848696', '2022-02-20', 1, 111),
(39, '1225484884869615', '2022-02-20', 1, 112),
(40, '1225484884869618', '2022-02-20', 1, 112),
(41, '1225484884869648', '2022-02-20', 1, 112),
(42, '122548488486964', '2022-02-20', 1, 112),
(43, '1225484884869641', '2022-02-20', 1, 112),
(44, '122548488451', '2022-02-20', 1, 113),
(45, '651516', '2022-02-20', 1, 113),
(46, '65151611', '2022-02-20', 1, 113),
(47, '6515161111', '2022-02-20', 1, 113);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `first_name`, `last_name`, `profile_image`, `created_date`, `status`) VALUES
(1, 'Pavithra', '', '81b05b62cf6df3f025fb551a689d2351cf1c8f1b', 'Pavithra', 'Gamage', '', '2022-01-26', 1),
(2, 'Amal', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Amal', 'Samantha', '', '2022-02-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_modules`
--

CREATE TABLE `users_modules` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_modules`
--

INSERT INTO `users_modules` (`id`, `user_id`, `module_id`) VALUES
(3, 2, '02'),
(4, 2, '0201'),
(5, 2, '03'),
(6, 2, '0301'),
(7, 2, '04'),
(8, 2, '0401'),
(9, 2, '05'),
(10, 2, '0501'),
(11, 2, '06'),
(12, 2, '0601'),
(13, 2, '07'),
(14, 2, '0701'),
(15, 1, '08'),
(16, 1, '0801'),
(17, 2, '0702');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`spec_id`);

--
-- Indexes for table `spec_items`
--
ALTER TABLE `spec_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_modules`
--
ALTER TABLE `users_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `spec_items`
--
ALTER TABLE `spec_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_modules`
--
ALTER TABLE `users_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
