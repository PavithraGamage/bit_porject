-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2022 at 10:28 PM
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
-- Table structure for table `appoiments`
--

CREATE TABLE `appoiments` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appoiments`
--

INSERT INTO `appoiments` (`id`, `status_id`, `date`, `time_id`, `user_id`) VALUES
(1, 2, '2022-04-19', 2, 5),
(2, 1, '2022-04-19', 1, 5),
(3, 1, '2022-05-05', 2, 5),
(4, 1, '2022-04-21', 2, 5),
(5, 1, '2022-04-21', 2, 5),
(6, 2, '2022-04-20', 2, 5),
(7, 2, '2022-04-20', 2, 5),
(8, 2, '2022-04-26', 2, 5),
(9, 2, '2022-04-21', 2, 5),
(10, 2, '2022-04-22', 2, 5),
(11, 2, '2022-04-29', 2, 5),
(12, 2, '2022-04-20', 2, 5),
(13, 2, '2022-04-29', 1, 5),
(14, 2, '2022-04-29', 1, 5),
(15, 2, '2022-04-22', 2, 5),
(16, 2, '2022-04-21', 2, 2),
(17, 1, '2022-04-20', 2, 1),
(18, 1, '2022-05-12', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `app_status`
--

CREATE TABLE `app_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_status`
--

INSERT INTO `app_status` (`id`, `status`) VALUES
(1, 'No Power'),
(2, 'No Display');

-- --------------------------------------------------------

--
-- Table structure for table `app_time`
--

CREATE TABLE `app_time` (
  `id` int(11) NOT NULL,
  `time` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_time`
--

INSERT INTO `app_time` (`id`, `time`) VALUES
(1, '08.30 AM'),
(2, '09.30 AM');

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(122) NOT NULL,
  `last_name` varchar(122) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(122) NOT NULL,
  `address_line_1` varchar(122) NOT NULL,
  `address_line_2` varchar(122) NOT NULL,
  `provinces` int(11) NOT NULL,
  `city` varchar(122) NOT NULL,
  `zip` int(6) NOT NULL,
  `order_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_details`
--

INSERT INTO `billing_details` (`id`, `first_name`, `last_name`, `phone`, `email`, `address_line_1`, `address_line_2`, `provinces`, `city`, `zip`, `order_id`) VALUES
(1, 'nishan', 'Amarabandu', 757003662, 'amara@bandu.com', 'bandu line 1', 'bandu line 2', 1, 'bandaragama', 2548, '1'),
(2, 'nishan', 'Amarabandu', 758778, 'bsb@sa.lk', 'kjaskjio1', 'kjskajlj2', 1, 'naskjlj', 83297, '2'),
(3, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 2, 'bandaragama', 12530, '3'),
(4, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 3, 'bandaragama', 12530, '4'),
(5, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '5'),
(6, 'Pavithra', 'Gamage', 757003662, 'pavithra@gmail.com', 'khaskjhkl', 'kjljlj', 1, 'jslajol', 372987, '6'),
(7, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 4, 'bandaragama', 12530, '7'),
(8, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 2, 'bandaragama', 12530, '8'),
(9, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 4, 'bandaragama', 12530, '9'),
(10, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 7, 'bandaragama', 12530, '10'),
(11, 'Pavithra', 'Gamage', 757003662, 'pavithra@gmail.com', '58/E, Kamburugoda', 'ksaj', 1, 'kjksj', 5646, '11'),
(12, 'Amal', 'Samantha', 757003662, 'pavithra@gmail.com', 'lasjklj', 'kjlksjlkj', 1, 'kjlskj', 545, '12'),
(13, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 7, 'Bandarawela', 5001, '13'),
(14, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 3, 'Bandarawela', 5001, '14'),
(15, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 2, 'Bandarawela', 5001, '15'),
(16, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 4, 'Bandarawela', 5001, '16'),
(17, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '17'),
(18, 'Samudara', 'Ranathunga', 712487644, 'samudra@gmail.com', '350/A, Colombo Road', 'Kubuka', 9, 'Horana', 12535, '18'),
(19, 'himashi', 'wasana', 757003665, 'himashi@gmail.com', 'Horana Road', '', 9, 'Bandaragama', 12530, '19'),
(20, 'dhamsa', 'sethnadee', 112200051, 'dahamsa_s@gmail.com', '12/4 C', 'Rawathawaththa', 2, 'Moratuwa', 51200, '20'),
(21, 'dhamsa', 'sethnadee', 112200051, 'dahamsa_s@gmail.com', '12/4 C', 'Rawathawaththa', 2, 'Moratuwa', 51200, '21'),
(22, 'shashika', 'lakshan', 112484848, 'shashika@gmail.com', '588/E, Ahangama Road', 'Colombo Road', 2, 'Colombo', 121254, '22'),
(23, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '23'),
(24, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '24'),
(25, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '25'),
(26, 'Amal', 'Samantha', 712487887, 'samatha@sas.lk', 'kslakow', '', 1, 'jkasdj', 123131, '26'),
(27, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '27'),
(28, 'Nishan', 'Amarabandu', 757003662, 'pavithra@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '28'),
(29, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 1, 'bandaragama', 12530, '29'),
(30, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 7, 'bandaragama', 12530, '30');

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
(30, 'AMD'),
(32, 'HP'),
(33, 'G.SKILL'),
(34, 'MSI');

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
(25, 'Motherboard', 'A motherboard (also called mainboard, main circuit board,[1] or mobo) is the main printed circuit board (PCB) in general-purpose computers and other expandable systems. It holds and allows communication between many of the crucial electronic components of a system, such as the central processing unit (CPU) and memory, and provides connectors for other peripherals. Unlike a backplane, a motherboard usually contains significant sub-systems, such as the central processor, the chipset&#039;s input/output and memory controllers, interface connectors, and other components integrated for general use.', 'z390-motherboard-20190513-1.jpg'),
(26, 'MEMORY (RAM)', 'RAM is short for “random access memory” and while it might sound mysterious, RAM is one of the most fundamental elements of computing.', '960x0.jpg'),
(27, 'GRAPHIC CARDS', 'A graphics card (also called a video card, display card, graphics adapter,vga card/vga, video adapter, or display adapter) is an expansion card which', '1644578115_Les-meilleurs-GPU-2022-cartes-graphiques-neuves-et-doccasion-758x442.jpg'),
(28, 'POWER SUPPLY', 'A power supply is an electrical device that supplies electric power to an electrical load. The main purpose of a power supply is to convert electric current ...', 'evga-power-supply-100883513-orig.jpg'),
(29, 'COOLING', 'Phase-change cooling is an extremely effective way to cool the processor. A vapor compression phase-change cooler is a unit that usually sits underneath the PC', 'WCPC.jpg'),
(30, 'STORAGE', 'Storage is a mechanism that enables a computer to retain data, either temporarily or permanently.', 'shutterstock_10323187-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courier_companies`
--

CREATE TABLE `courier_companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `contact_number` int(13) NOT NULL,
  `contact_number_opp` int(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `tracking_url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier_companies`
--

INSERT INTO `courier_companies` (`company_id`, `company_name`, `contact_number`, `contact_number_opp`, `email`, `address_line_1`, `address_line_2`, `tracking_url`, `status`) VALUES
(2, 'Prompt Xpress (Pvt) Ltd', 114422733, 2147483647, 'customercare@promptxpress.lk', 'No. 40, Ferry Road,  Borupana,', 'Rathmalana, Sri Lanka', 'http://promptxpress.lk/tracking.php?wbno', 0),
(3, 'Domestic Express (Pvt) Ltd', 117759759, 123456789, 'sales@domex.lk', 'No.511 10th Mile Post Rd, Boralesgamuwa', '', 'http://domex.lk/tracking.php?wbno', 0),
(4, 'Grasshoppers', 117759759, 123456789, 'info@grasshoppers.lk', '467 1 /1, Old Kotta rd Udahamulla, Nugegoda', '', 'http://grass.lk/tracking.php?wbno', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courier_status`
--

CREATE TABLE `courier_status` (
  `id` int(11) NOT NULL,
  `courier_status` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier_status`
--

INSERT INTO `courier_status` (`id`, `courier_status`, `status`) VALUES
(1, 'Processing', 0),
(2, 'Pending', 0),
(8, 'Complete', 0),
(9, 'skajsssssssss6545', 1),
(11, 'sdasdada', 1),
(12, 'dasdawdad', 1),
(13, 'sadawd', 1),
(14, 'dasdadada', 1),
(15, 'Pending Payments', 1),
(16, 'Pending Payment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `contact_nmuber` int(11) NOT NULL,
  `address_l1` varchar(255) NOT NULL,
  `address_l2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `contact_nmuber`, `address_l1`, `address_l2`, `city`, `postal_code`, `user_id`, `province_id`) VALUES
(2, 757003662, 'address line 1', 'address line 2', 'bandaragama', 12530, 16, 1),
(3, 1191881007, 'address line 1', 'address line 2', 'cus city', 12458, 12, 2),
(4, 11111111, 'cus address line 1', 'cus addr line 2', 'cus city', 1235145, 14, 3),
(5, 712487645, '58/B, kandewatta', 'Galaboda Road', 'Bandarawela', 5001, 18, 4),
(6, 112487645, '57/E, Horana Road', '', 'Panadura', 12748, 20, 6),
(12, 712487645, '12/4 C, Dharmarathna Mawatha', 'Rawathawaththa', 'Moratuwa', 10015, 21, 9),
(13, 712487644, '350/A, Colombo Road', 'Kubuka', 'Horana', 12535, 22, 9),
(14, 757003665, 'Horana Road', '', 'Bandaragama', 12530, 30, 9),
(15, 112200051, '12/4 C', 'Rawathawaththa', 'Moratuwa', 51200, 40, 2),
(16, 112484848, '588/E, Ahangama Road', 'Colombo Road', 'Colombo', 121254, 41, 2),
(17, 757003662, 'dawdad', 'dasad', 'dadsad', 12323, 42, 5);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `id` int(11) NOT NULL,
  `frist_name` varchar(122) NOT NULL,
  `last_name` varchar(122) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(122) NOT NULL,
  `address_line_1` varchar(122) NOT NULL,
  `address_line_2` varchar(122) NOT NULL,
  `city` text NOT NULL,
  `province_id` varchar(122) NOT NULL,
  `zip` int(6) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`id`, `frist_name`, `last_name`, `phone`, `email`, `address_line_1`, `address_line_2`, `city`, `province_id`, `zip`, `order_id`) VALUES
(1, 'nishan', 'Amarabandu', 757003662, 'amara@bandu.com', 'bandu line 1', 'bandu line 2', 'bandaragama', '1', 2548, 1),
(2, 'nishan', 'Amarabandu', 758778, 'bsb@sa.lk', 'kjaskjio1', 'kjskajlj2', 'naskjlj', '1', 83297, 2),
(3, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '2', 12530, 3),
(4, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '3', 12530, 4),
(5, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 5),
(6, 'Pavithra', 'Gamage', 757003662, 'pavithra@gmail.com', 'khaskjhkl', 'kjljlj', 'jslajol', '1', 372987, 6),
(7, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '4', 12530, 7),
(8, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '2', 12530, 8),
(9, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '4', 12530, 9),
(10, 'nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '7', 12530, 10),
(11, 'Pavithra', 'Gamage', 757003662, 'pavithra@gmail.com', '58/E, Kamburugoda', 'ksaj', 'kjksj', '1', 5646, 11),
(12, 'Amal', 'Samantha', 757003662, 'pavithra@gmail.com', 'lasjklj', 'kjlksjlkj', 'kjlskj', '1', 545, 12),
(13, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 'Bandarawela', '7', 5001, 13),
(14, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 'Bandarawela', '3', 5001, 14),
(15, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 'Bandarawela', '2', 5001, 15),
(16, 'saman', 'Kumara', 712487645, 'saman@gmail.com', '58/B, kandewatta', 'Galaboda Road', 'Bandarawela', '4', 5001, 16),
(17, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 17),
(18, 'Pavithra', 'Gamage', 757003662, 'pavithra@gmail.com', '587/B,', 'Walimada Road', 'Bandarawela', '6', 12554, 18),
(19, 'himashi', 'wasana', 757003665, 'himashi@gmail.com', 'Horana Road', '', 'Bandaragama', '9', 12530, 19),
(20, 'dhamsa', 'sethnadee', 112200051, 'dahamsa_s@gmail.com', '12/4 C', 'Rawathawaththa', 'Moratuwa', '2', 51200, 20),
(21, 'dhamsa', 'sethnadee', 112200051, 'dahamsa_s@gmail.com', '12/4 C', 'Rawathawaththa', 'Moratuwa', '2', 51200, 21),
(22, 'shashika', 'lakshan', 112484848, 'shashika@gmail.com', '588/E, Ahangama Road', 'Colombo Road', 'Colombo', '2', 121254, 22),
(23, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 23),
(24, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 24),
(25, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '3', 12530, 25),
(26, 'Amal', 'Samantha', 712487887, 'samatha@sas.lk', 'kslakow', '', 'jkasdj', '1', 123131, 26),
(27, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 27),
(28, 'Nishan', 'Amarabandu', 757003662, 'pavithra@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 28),
(29, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '1', 12530, 29),
(30, 'Nishan', 'Amarabandu', 757003662, 'nishan@ustar.com', 'address line 1', 'address line 2', 'bandaragama', '4', 12530, 30);

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
  `grn_price` int(100) NOT NULL,
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

INSERT INTO `items` (`item_id`, `item_image`, `item_name`, `sku`, `recorder_level`, `grn_price`, `unit_price`, `sale_price`, `discount_rate`, `item_description`, `date`, `stock`, `warranty`, `warranty_period`, `category_id`, `brand_id`, `model_id`) VALUES
(131, '1348-20200312162621-13079129_3.png', 'AMD RYZEN 9 3950X', '125548874', 12, 140000, 159000, 150000, 6, 'Ryzen™ 9 3950X is the world\'s most powerful 16-Core desktop processor that gives extreme performance for gamers, streamers and creators. ', '2022-03-05', NULL, 0, 0, 24, 30, 4),
(132, '1742-20210201100428-1720-20210111130433-Untitled-1.png', 'AMD Ryzen 9 5950X', '122548858874', 10, 16900, 18900, 18000, 5, 'AMD Ryzen™ 9 5950X. One processor that can game as well as it creates. 16 Cores. 0 Compromises.', '2022-03-05', NULL, 0, 0, 24, 30, 4),
(133, '2058-20211127083807-i9 (1).png', 'Intel Core i9-12900KF', '12252554848', 12, 122000, 149000, 132000, 11, 'Processor Number i9-12900KF · Recommended Customer Price ; Total Cores 16 · Maximum Turbo Power ; Embedded Options Available No; Datasheet ; ', '2022-03-05', NULL, 0, 0, 24, 29, 12),
(134, '2057-20211119103726-12900.png', 'Intel Core i9-12900K', '1225255484812', 12, 122000, 153000, 142000, 7, 'Processor Number i9-12900KF · Recommended Customer Price ; Total Cores 16 · Maximum Turbo Power ; Embedded Options Available No; Datasheet ; ', '2022-03-05', NULL, 0, 0, 24, 29, 12),
(135, '2089-20211228142409-ROG MAXIMUS XIII EXTREME GLACIAL-with-Box.png', 'ASUS ROG MAXIMUS Z690 EXTREME GLACIAL', '122525548481211', 12, 14000, 16500, 0, 0, 'Processor Number i9-12900KF · Recommended Customer Price ; Total Cores 16 · Maximum Turbo Power ; Embedded Options Available No; Datasheet ; ', '2022-03-05', NULL, 0, 0, 25, 29, 12),
(136, '2070-20211202161114-max.png', 'ASUS ROG MAXIMUS Z690 EXTREME', '122548481211', 12, 130000, 153000, 142000, 7, 'Processor Number i9-12900KF · Recommended Customer Price ; Total Cores 16 · Maximum Turbo Power ; Embedded Options Available No; Datasheet ; ', '2022-03-05', NULL, 0, 0, 25, 29, 12),
(137, '1527-20211215042417-hero.png', 'ASUS ROG MAXIMUS Z690 HERO', '12254848121111', 12, 125000, 143000, 132000, 7, 'Processor Number i9-12900KF · Recommended Customer Price ; Total Cores 16 · Maximum Turbo Power ; Embedded Options Available No; Datasheet ; ', '2022-03-05', NULL, 0, 0, 25, 29, 12),
(138, '1743-20211110102052-h732 (3).png', 'ASUS ROG STRIX Z690-F GAMING WIFI', '1254548588784', 12, 145000, 153000, 150000, 7, 'Processor Number i9-12900KF · Recommended Customer Price ; Total Cores 16 · Maximum Turbo Power ; Embedded Options Available No; Datasheet ; ', '2022-03-05', NULL, 0, 0, 25, 29, 12),
(139, '2161-20220211133312-164022912511 (1).png', 'G.SKILL TridentZ5 RGB 32GB (2 x 16GB) DDR5 5600Mhz', '12554787878', 12, 120000, 135000, 130000, 4, 'This memory kit will boot at the SPD speed when BIOS settings are at default.\r\nEnable the XMP/DOCP/A-XMP profile in the BIOS to reach the rated overclock speed of this memory kit.\r\nMaximum memory speed and system stability depends on the capability of the motherboard & CPU.', '2022-03-06', NULL, 0, 0, 26, 33, 13),
(140, '1181-1593-1181-1593-1181-1593-1181-1593-1181-20190823151643-ROG-THOR-850P_box+vga color.png', 'ASUS ROG-THOR-850P 850W 80+ PLATINUM MODULAR', '11225548758', 25, 44000, 69500, 55000, 21, 'Aura Sync : Advanced customization with addressable RGB LEDs and Aura Sync compatibility\r\nOLED Power Display : Real-time power draw monitoring with OLED Power Display\r\nROG Thermal Solution : 0dB cooling with dustproof IP5X Wing-blade Fan and ROG heatsink design\r\n80 PLUS Platinum : Built with 100% Japanese capacitors and other premium components\r\nSleeved Cables : For easy building and superior aesthetics', '2022-04-14', NULL, 0, 0, 28, 28, 3),
(141, '1692-20220111102315-product_162251863439fae359288e142419893b494a6bbece.png', 'MSI RTX 3080TI GAMING TRIO 12GB', '1422254478', 25, 400000, 529000, 500000, 5, '3 Years Warranty\r\n\r\nThe GeForce RTX™ 3080 Ti delivers the ultra performance that gamers crave, powered by Ampere—NVIDIA’s 2nd gen RTX architecture. It’s built with enhanced RT Cores and Tensor Cores, new streaming multiprocessors, and superfast G6X memory for an amazing gaming experience.\r\n\r\n\r\nModel Name GeForce RTX™ 3080 Ti GAMING TRIO 12G\r\nGraphics Processing Unit NVIDIA®\r\nGeForce RTX™ 3080 Ti\r\nInterface PCI Express®\r\nGen 4\r\nCores 10240 Units\r\nCore Clocks Boost: 1695 MHz\r\nMemory Speed 19 Gbps\r\nMemory 12GB GDDR6X\r\nMemory Bus 384-bit\r\nOutput\r\nDisplayPort x 3 (v1.4)\r\nHDMI x 1 (Supports 4K@120Hz as specified\r\nin HDMI 2.1)\r\nHDCP Support Y\r\nPower consumption 350W\r\nPower connectors 8-pin x 3\r\nRecommended PSU 750w\r\nCard Dimension (mm) 324 x 140 x 56mm\r\nWeight (Card / Package) 1572 g / 2356 g\r\nDirectX Version Support 12 API\r\nOpenGL Version Support 4.6\r\nNVLink Support N/A\r\nMaximum Displays 4\r\nVR Ready Y\r\nG-SYNC®\r\ntechnology Y\r\nAdaptive Vertical Sync Y\r\nDigital Maximum Resolution 7680x4320', '2022-04-14', NULL, 0, 0, 27, 34, 14),
(142, '1631-20210913111609-download (2).png', 'ASUS TUF GAMING GeForce RTX 3080Ti 12GB', '2125485544', 25, 580000, 699000, 600000, 14, '3 Years Warranty\r\n\r\nNVIDIA Ampere Streaming Multiprocessors: The building blocks for the world’s fastest, most efficient GPUs, the all-new Ampere SM brings 2X the FP32 throughput and improved power efficiency.\r\n2nd Generation RT Cores: Experience 2X the throughput of 1st gen RT Cores, plus concurrent RT and shading for a whole new level of ray tracing performance.\r\n3rd Generation Tensor Cores: Get up to 2X the throughput with structural sparsity and advanced AI algorithms such as DLSS. These cores deliver a massive boost in game performance and all-new AI capabilities.\r\nAxial-tech Fan Design has been newly tuned with a reversed central fan direction for less turbulence.\r\nDual Ball Fan Bearings can last up to twice as long as sleeve bearing designs.\r\nMilitary-grade Capacitors and other TUF components enhance durability and performance.\r\nGPU Tweak II provides intuitive performance tweaking, thermal controls, and system monitoring.', '2022-04-14', NULL, 0, 0, 27, 28, 14);

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
(3, '850W 80+ PLATINUM MODULAR'),
(4, 'RYZEN 9'),
(12, 'Core i9'),
(13, 'TridentZ5 RGB'),
(14, 'RTX 3080TI');

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
('01', 'Troubleshooting FAQ', 'troubleshooting/faq', '', 'test', 1),
('0101', 'Add FAQ', 'troubleshooting/faq', 'add', '', 1),
('0102', 'Add Status', 'troubleshooting', 'add_status', '', 1),
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
('0801', 'Add Staff', 'users/staff', 'add', '', 1),
('0802', 'Add Permissions', 'users/staff', 'add_permission', '', 1),
('0803', 'Grant Privileges', 'users/staff', 'add_privileges', '', 1),
('09', 'Customer Management', 'users/customers', '', '', 1),
('0901', 'Add Customer', 'users/customers', 'add', '', 1),
('10', 'Module Management', 'users/modules', '', '', 1),
('1001', 'Add Main Module', 'users/modules', 'add', '', 1),
('1002', 'Add Sub Module', 'users/modules', 'add_sub', '', 1),
('11', 'Appointments', 'appointments', '', 'insert', 1),
('1101', 'View Appointments', 'appointments', 'view', '', 1),
('12', 'Job Management', 'jobs/customers', '', 'jobs', 1),
('1201', 'View Job Cards', 'jobs/customers', 'view_jobs', '', 1),
('13', 'Delivery Management', 'delivery/companies', '', '', 1),
('1301', 'Courier Companies', 'delivery/companies', 'add', '', 1),
('1302', 'Delivery Status', 'delivery/companies', 'add_status', '', 1),
('1303', 'Delivery Chargers', 'delivery/companies', 'add_delivery_chargers', '', 1),
('14', 'Delivery Orders', 'delivery/orders', '', '', 1),
('1401', 'Delivery Order List', 'delivery/orders', 'view', '', 1),
('1402', 'Delivery List', 'delivery/orders', 'list', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `order_total` int(11) NOT NULL,
  `total_discount` int(11) NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `courier_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `order_total`, `total_discount`, `delivery_charge`, `order_date`, `order_time`, `user_id`, `payment_id`, `grand_total`, `courier_status`) VALUES
(1, '202204230001', 160000, 11900, 1, '2022-04-23', '17:27:18', 16, 6, 148600, 8),
(2, '202204230002', 160000, 11900, 1, '2022-04-23', '17:44:06', 16, 6, 148600, 1),
(3, '202204230003', 130000, 5000, 2, '2022-04-23', '20:32:09', 16, 6, 125600, 1),
(4, '202204230004', 922000, 54000, 3, '2022-04-23', '20:35:31', 16, 5, 868300, 1),
(5, '202204230005', 922000, 54000, 1, '2022-04-23', '20:39:44', 16, 6, 868500, 8),
(6, '202204230006', 191500, 11000, 1, '2022-04-23', '20:42:38', 1, 5, 181000, 1),
(7, '202204230007', 18000, 900, 4, '2022-04-23', '21:12:48', 16, 5, 17500, 0),
(8, '202204230008', 130000, 5000, 2, '2022-04-23', '21:59:19', 16, 6, 125600, 5),
(9, '202204240009', 130000, 5000, 4, '2022-04-24', '00:29:19', 16, 5, 125400, 0),
(10, '202204240010', 1469000, 99500, 7, '2022-04-24', '00:32:13', 16, 5, 1371000, 0),
(11, '202204240011', 16500, 0, 1, '2022-04-24', '00:46:10', 1, 5, 17000, 1),
(12, '202204240012', 49500, 0, 1, '2022-04-24', '00:47:36', 2, 5, 50000, 0),
(13, '202204240013', 430000, 23000, 7, '2022-04-24', '00:55:50', 18, 5, 408500, 0),
(14, '202204240014', 16500, 0, 3, '2022-04-24', '01:07:46', 18, 5, 16800, 0),
(15, '202204240015', 1351500, 86500, 2, '2022-04-24', '11:35:50', 18, 5, 1265600, 0),
(16, '202204240016', 130000, 5000, 4, '2022-04-24', '17:39:47', 18, 5, 125400, 0),
(17, '202204240017', 150000, 9000, 1, '2022-04-24', '21:19:47', 16, 5, 141500, 0),
(18, '202204240018', 284000, 22000, 6, '2022-04-24', '21:26:25', 22, 5, 262900, 0),
(19, '202204240019', 130000, 5000, 9, '2022-04-24', '22:19:08', 30, 5, 125470, 0),
(20, '202204240020', 132000, 11000, 2, '2022-04-24', '22:43:26', 40, 5, 121600, 0),
(21, '202204240021', 132000, 11000, 2, '2022-04-24', '22:49:14', 40, 5, 121600, 0),
(22, '202204250022', 142000, 11000, 2, '2022-04-25', '23:41:49', 41, 5, 131600, 0),
(23, '202204270023', 130000, 5000, 1, '2022-04-27', '21:56:34', 16, 5, 125500, 0),
(24, '202204280024', 142000, 11000, 1, '2022-04-28', '00:31:34', 16, 5, 131500, 1),
(25, '202204280025', 36000, 1800, 3, '2022-04-28', '01:48:46', 16, 5, 34500, 0),
(26, '202204290026', 130000, 5000, 1, '2022-04-29', '00:40:43', 2, 6, 125500, 0),
(27, '202204290027', 130000, 5000, 1, '2022-04-29', '00:41:17', 16, 5, 125500, 1),
(28, '202204290028', 130000, 5000, 1, '2022-04-29', '00:43:01', 16, 5, 125500, 0),
(29, '202205010029', 16500, 0, 1, '2022-05-01', '00:19:10', 16, 5, 17000, 8),
(30, '202205010030', 150000, 9000, 4, '2022-05-01', '14:18:05', 16, 5, 141400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_company`
--

CREATE TABLE `orders_company` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `dispatch_date` date NOT NULL,
  `tracking_number` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_company`
--

INSERT INTO `orders_company` (`id`, `order_id`, `company_id`, `dispatch_date`, `tracking_number`, `status`) VALUES
(1, 1, 3, '2022-05-19', 122254, 1),
(2, 2, 3, '2022-05-19', 0, 1),
(3, 3, 2, '2022-05-03', 362256, 1),
(4, 5, 3, '2022-05-03', 2155, 0),
(5, 29, 2, '2022-05-18', 123348, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `orders_items_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `grn_price` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`orders_items_id`, `order_id`, `item_id`, `item_qty`, `grn_price`, `unit_price`, `sale_price`) VALUES
(1, 4, 131, 1, 140000, 159000, 150000),
(2, 4, 136, 1, 130000, 153000, 142000),
(3, 4, 139, 1, 120000, 135000, 130000),
(4, 4, 141, 3, 400000, 529000, 500000),
(5, 5, 131, 1, 140000, 159000, 150000),
(6, 5, 136, 1, 130000, 153000, 142000),
(7, 5, 139, 1, 120000, 135000, 130000),
(8, 5, 141, 1, 400000, 529000, 500000),
(9, 6, 134, 1, 122000, 153000, 142000),
(10, 6, 135, 3, 14000, 16500, 0),
(11, 7, 132, 1, 16900, 18900, 18000),
(12, 8, 139, 1, 120000, 135000, 130000),
(13, 9, 139, 1, 120000, 135000, 130000),
(14, 10, 134, 1, 122000, 153000, 142000),
(15, 10, 136, 1, 130000, 153000, 142000),
(16, 10, 139, 1, 120000, 135000, 130000),
(17, 10, 141, 2, 400000, 529000, 500000),
(18, 10, 140, 1, 44000, 69500, 55000),
(19, 11, 135, 1, 14000, 16500, 0),
(20, 12, 135, 3, 14000, 16500, 0),
(21, 13, 131, 2, 140000, 159000, 150000),
(22, 13, 139, 1, 120000, 135000, 130000),
(23, 14, 135, 1, 14000, 16500, 0),
(24, 15, 131, 1, 140000, 159000, 150000),
(25, 15, 135, 1, 14000, 16500, 0),
(26, 15, 139, 1, 120000, 135000, 130000),
(27, 15, 141, 2, 400000, 529000, 500000),
(28, 15, 140, 1, 44000, 69500, 55000),
(29, 16, 139, 1, 120000, 135000, 130000),
(30, 17, 131, 1, 140000, 159000, 150000),
(31, 18, 136, 2, 130000, 153000, 142000),
(32, 19, 139, 1, 120000, 135000, 130000),
(33, 20, 137, 1, 125000, 143000, 132000),
(34, 21, 137, 1, 125000, 143000, 132000),
(35, 22, 136, 1, 130000, 153000, 142000),
(36, 23, 139, 1, 120000, 135000, 130000),
(37, 24, 136, 1, 130000, 153000, 142000),
(38, 25, 132, 2, 16900, 18900, 18000),
(39, 26, 139, 1, 120000, 135000, 130000),
(40, 27, 139, 1, 120000, 135000, 130000),
(41, 28, 139, 1, 120000, 135000, 130000),
(42, 29, 135, 1, 14000, 16500, 0),
(43, 30, 131, 1, 140000, 159000, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methord`
--

CREATE TABLE `payment_methord` (
  `id` int(11) NOT NULL,
  `name` varchar(122) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_methord`
--

INSERT INTO `payment_methord` (`id`, `name`) VALUES
(5, 'Cash On Delivery (COD)'),
(6, 'Direct Bank Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name` varchar(122) NOT NULL,
  `price` int(5) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`, `price`, `status`) VALUES
(1, 'Central', 500, 0),
(2, 'Eastern', 600, 0),
(3, 'North Central', 300, 1),
(4, 'North Central', 400, 0),
(5, 'North Western', 800, 0),
(6, 'Sabaragamuwa', 900, 0),
(7, 'Southern', 1500, 0),
(8, 'Uva', 650, 0),
(9, 'Western', 470, 0),
(10, 'Northern', 850, 0),
(11, 'jaffana', 1254, 1),
(12, 'ioaus', 92830, 1);

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
(29, 'USB Ports', 25),
(30, 'Cores', 27),
(31, 'Core Clocks Boost', 27),
(32, 'Memory Speed', 27),
(33, 'Graphic Memory', 27),
(34, 'Memory Bus', 27);

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
(421, 20, 127, 'tada'),
(422, 20, 129, 'CPU'),
(423, 21, 129, 'CHIP'),
(424, 22, 129, 'MEM'),
(425, 23, 129, 'GRAP'),
(426, 24, 129, 'MGP'),
(427, 25, 129, 'ES'),
(428, 26, 129, 'STORE'),
(429, 27, 129, 'LAN'),
(430, 29, 129, 'USB'),
(431, 20, 130, 'DASDAD'),
(432, 21, 130, 'DASDD'),
(433, 22, 130, 'DSAWQW'),
(434, 23, 130, 'EWQEQ2'),
(435, 24, 130, '2313'),
(436, 25, 130, 'EWQWE2142'),
(437, 26, 130, '3213'),
(438, 27, 130, '3212313'),
(439, 29, 130, '3123123'),
(440, 20, 131, '16'),
(441, 21, 131, 'B450'),
(442, 22, 131, '65'),
(443, 23, 131, '1'),
(444, 24, 131, '12'),
(445, 25, 131, '4'),
(446, 26, 131, 'ks'),
(447, 27, 131, '5484'),
(448, 29, 131, '545'),
(449, 20, 132, '12'),
(450, 21, 132, '2312'),
(451, 22, 132, '3213'),
(452, 23, 132, '3123'),
(453, 24, 132, '3212'),
(454, 25, 132, '3123'),
(455, 26, 132, '321'),
(456, 27, 132, '3123'),
(457, 29, 132, '312'),
(458, 20, 133, '21'),
(459, 21, 133, '21'),
(460, 22, 133, '21'),
(461, 23, 133, '21'),
(462, 24, 133, '21'),
(463, 25, 133, '21'),
(464, 26, 133, '21'),
(465, 27, 133, '21'),
(466, 29, 133, '212'),
(467, 20, 134, '12'),
(468, 21, 134, '21'),
(469, 22, 134, '21'),
(470, 23, 134, '32'),
(471, 24, 134, '123'),
(472, 25, 134, '321'),
(473, 26, 134, '3213'),
(474, 27, 134, '312'),
(475, 29, 134, '3213'),
(476, 20, 135, 'dasd'),
(477, 21, 135, 'dsad'),
(478, 22, 135, 'dasd'),
(479, 23, 135, 'dasd'),
(480, 24, 135, 'dasd'),
(481, 25, 135, 'dasd'),
(482, 26, 135, 'dasd'),
(483, 27, 135, 'dasd'),
(484, 29, 135, 'dsada'),
(485, 20, 136, '212'),
(486, 21, 136, '21'),
(487, 22, 136, '21'),
(488, 23, 136, '21'),
(489, 24, 136, '21'),
(490, 25, 136, '212'),
(491, 26, 136, '212'),
(492, 27, 136, '212'),
(493, 29, 136, '2123'),
(494, 20, 137, '3213'),
(495, 21, 137, '3213'),
(496, 22, 137, '3213'),
(497, 23, 137, '3213'),
(498, 24, 137, '3213'),
(499, 25, 137, '3213'),
(500, 26, 137, '3213'),
(501, 27, 137, '3213'),
(502, 29, 137, '321313'),
(503, 20, 138, 'dsad'),
(504, 21, 138, 'dasd'),
(505, 22, 138, 'dad'),
(506, 23, 138, 'asdad'),
(507, 24, 138, 'dasd'),
(508, 25, 138, 'dsada'),
(509, 26, 138, 'dasd'),
(510, 27, 138, 'dsada'),
(511, 29, 138, 'dasdad'),
(512, 20, 139, 'ewq'),
(513, 21, 139, 'ewqe'),
(514, 22, 139, 'eqw'),
(515, 23, 139, 'ewqe'),
(516, 24, 139, 'eqw'),
(517, 25, 139, 'ewqe'),
(518, 26, 139, 'eqwe'),
(519, 27, 139, 'eqwe'),
(520, 29, 139, 'ewqe'),
(521, 20, 140, '21'),
(522, 21, 140, '21'),
(523, 22, 140, '21'),
(524, 23, 140, '21'),
(525, 24, 140, '21'),
(526, 25, 140, '21'),
(527, 26, 140, '21'),
(528, 27, 140, '1'),
(529, 29, 140, '12'),
(530, 20, 141, '12'),
(531, 21, 141, '12'),
(532, 22, 141, '12'),
(533, 23, 141, '1'),
(534, 24, 141, '21'),
(535, 25, 141, '21'),
(536, 26, 141, '212'),
(537, 27, 141, '121'),
(538, 29, 141, '2'),
(539, 30, 141, '212'),
(540, 31, 141, '121'),
(541, 32, 141, '1'),
(542, 33, 141, '12'),
(543, 34, 141, '21'),
(544, 20, 142, '215'),
(545, 21, 142, '1584'),
(546, 22, 142, '8484'),
(547, 23, 142, '8484'),
(548, 24, 142, '84'),
(549, 25, 142, '88'),
(550, 26, 142, '8484'),
(551, 27, 142, '84'),
(552, 29, 142, '8484'),
(553, 30, 142, '8'),
(554, 31, 142, '84'),
(555, 32, 142, '8484'),
(556, 33, 142, '84'),
(557, 34, 142, '848');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `nic` varchar(18) NOT NULL,
  `dob` date NOT NULL,
  `contact_number` int(10) NOT NULL,
  `address_l1` varchar(255) NOT NULL,
  `address_l2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `nic`, `dob`, `contact_number`, `address_l1`, `address_l2`, `city`, `postal_code`, `user_id`) VALUES
(4, '19881224488', '1976-12-18', 123456789, '58/E, Kesbewa Road', 'Kamburugoda', 'Bandaragama', 12530, 10),
(8, '94021285588V', '1900-12-12', 712487645, '58/E, Kosgoda Road', 'Alpitiya', 'Ambilipitiya', 12480, 16),
(9, '930402036V', '1995-12-30', 757003662, '58/E, Kesbewa Road', 'Kamburugoda', 'Piliyandala', 5310, 48);

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
(50, '122554848', '2022-03-05', 1, 131),
(51, '12548496989', '2022-03-05', 1, 131),
(52, '15848984789', '2022-03-05', 1, 131),
(53, '1848848415848', '2022-03-05', 1, 131),
(54, '158484845848', '2022-03-05', 1, 131),
(55, '12684898469', '2022-03-05', 1, 131),
(56, '18489848989', '2022-03-05', 1, 131),
(57, '184898489896', '2022-03-05', 1, 131),
(58, '1254548877574', '2022-04-14', 1, 140),
(59, '123548484984', '2022-04-14', 1, 141),
(60, '15844584848', '2022-04-14', 1, 141),
(61, '558484584', '2022-04-14', 1, 141),
(62, '54584454840', '2022-04-14', 1, 141),
(63, '487487484', '2022-04-14', 1, 141),
(64, '4548456949648', '2022-04-14', 1, 142),
(65, '54584808874', '2022-04-14', 1, 142),
(66, '4848489890898', '2022-04-14', 1, 142),
(67, '888889874', '2022-04-14', 1, 142),
(68, '7848989890', '2022-04-14', 1, 142);

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
(1, 'Pavithra', 'pavithra@gmail.com', '81b05b62cf6df3f025fb551a689d2351cf1c8f1b', 'Pavithra', 'Gamage', 'pavithra_gamage.jpg', '2022-01-26', 1),
(2, 'Amal', '', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Amal', 'Samantha', '', '2022-02-06', 1),
(16, 'nishan', 'nishan@ustar.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Nishan', 'Amarabandu', '0.jpg', '2022-04-15', 1),
(18, 'saman', 'saman@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Saman', 'Kumara', '', '2022-04-24', 1),
(19, 'sanket_gru', 'sanket@gur.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'sanket', 'gurushinha', '', '2022-04-24', 1),
(20, 'sameera_m', 'sameera@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'sameera', 'malshan', '', '2022-04-24', 1),
(21, 'samntha_p', 'samantha@gmail.com', '4b4b04529d87b5c318702bc1d7689f70b15ef4fc', 'samantha', 'priyashan', '', '2022-04-24', 1),
(22, 'samudra_r', 'samudra@gmail.com', '4b4b04529d87b5c318702bc1d7689f70b15ef4fc', 'Samudara', 'Ranathunga', '', '2022-04-24', 1),
(24, 'pavithra', 'dahamsa@gmail.com', '4b4b04529d87b5c318702bc1d7689f70b15ef4fc', 'dahamsa', 'sethnadee', '', '0000-00-00', 1),
(40, 'dhamsa', 'dahamsa_s@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'dhamsa', 'sethnadee', '', '0000-00-00', 1),
(41, 'shashika', 'shashika@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'shashika', 'lakshan', '', '0000-00-00', 1),
(42, 'hjhajhjh', 'jhjsah@jhsa.lk', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'hjashj', 'jhjshja', '', '0000-00-00', 1),
(43, 'test1233', 'test@testkk.lk', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'test', 'test', '', '0000-00-00', 1),
(44, 'savinda_s', 'savinda@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Savinda', 'Sulochana', '', '0000-00-00', 1),
(45, 'opsoapop', 'pospao@sa.lk', 'ed79568a98d83de44b3016d15134b37ac80e9c31', 'dpoas', 'ospaop', '', '2022-04-28', 1),
(46, 'kkasj', 'kjkasj2kjas@kjs.lk', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'kjsak', 'kjkjas', '', '0000-00-00', 1),
(47, 'dasd', 'dasd@sa.lk', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'dasd', 'dasd', '', '0000-00-00', 1),
(48, 'savinda', 'savinda_s@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'Savinda', 'Sulochana', '', '2022-04-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_modules`
--

CREATE TABLE `users_modules` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_modules`
--

INSERT INTO `users_modules` (`id`, `user_id`, `module_id`, `status`) VALUES
(1, 1, '08', 0),
(2, 1, '10', 0),
(3, 1, '0801', 0),
(4, 1, '0802', 0),
(5, 1, '1001', 0),
(6, 1, '1002', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appoiments`
--
ALTER TABLE `appoiments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_status`
--
ALTER TABLE `app_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_time`
--
ALTER TABLE `app_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `courier_companies`
--
ALTER TABLE `courier_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `courier_status`
--
ALTER TABLE `courier_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `orders_company`
--
ALTER TABLE `orders_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`orders_items_id`);

--
-- Indexes for table `payment_methord`
--
ALTER TABLE `payment_methord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

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
-- AUTO_INCREMENT for table `appoiments`
--
ALTER TABLE `appoiments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `app_status`
--
ALTER TABLE `app_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_time`
--
ALTER TABLE `app_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `courier_companies`
--
ALTER TABLE `courier_companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courier_status`
--
ALTER TABLE `courier_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders_company`
--
ALTER TABLE `orders_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `orders_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `payment_methord`
--
ALTER TABLE `payment_methord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `specifications`
--
ALTER TABLE `specifications`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `spec_items`
--
ALTER TABLE `spec_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users_modules`
--
ALTER TABLE `users_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
