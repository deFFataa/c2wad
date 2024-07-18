-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 06:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c2wad`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_order`
--

CREATE TABLE `client_order` (
  `order_id` int(20) NOT NULL,
  `order_uid` int(20) NOT NULL,
  `client_name` varchar(30) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `order_location` varchar(20) NOT NULL,
  `order_detail` varchar(30) NOT NULL,
  `order_payment` varchar(10) NOT NULL,
  `municipality` varchar(20) NOT NULL,
  `barangay` varchar(20) NOT NULL,
  `street` varchar(20) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `order_placeTime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT NULL,
  `reason` varchar(50) NOT NULL,
  `rider_name` varchar(30) NOT NULL,
  `client_rating` int(5) DEFAULT NULL,
  `proof` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_order`
--

INSERT INTO `client_order` (`order_id`, `order_uid`, `client_name`, `phoneNumber`, `order_location`, `order_detail`, `order_payment`, `municipality`, `barangay`, `street`, `landmark`, `order_placeTime`, `status`, `reason`, `rider_name`, `client_rating`, `proof`) VALUES
(20230768, 53, 'Isaac Luis Balabbo', '09123456789', 'Jollibee', 'Burger', 'COD', 'San Pablo', 'Calamagui', 'Purok 6', 'Yellow na gate', '2023-11-13 14:40:06', 'Delivered', '', 'William D. Albano Jr', 5, 'images/ProofOrder/401182772_122125370552040720_5477305997409457137_n.jpg'),
(20230769, 53, 'Isaac Luis Balabbo', '09123456789', 'Franks', 'Cheeseburger', 'COD', 'San Pablo', 'Calamagui', 'Purok 6', '', '2023-11-13 14:46:42', 'Delivered', '', 'William D. Albano Jr', 5, 'images/ProofOrder/404978814_1103435154347615_2260354383335482819_n.jpg'),
(20230770, 55, 'Rica Denguray', '09123456789', 'Dimsum', 'Shomai Rice', 'COD', 'Tumauini', 'Barangay District 1 ', 'Purok 3', '', '2023-11-13 14:58:31', 'Delivered', '', 'Kim Fredimil G. Lopez', 5, 'images/ProofOrder/400387110_1098159958208468_1146396028581775989_n.jpg'),
(20230771, 58, 'Jefferson Allapitan', '09123456789', 'pintag', 'sisig', 'COD', 'Tumauini', 'San Vicente', 'Purok 5', '', '2023-11-13 15:22:37', 'Delivered', '', 'Kim Fredimil G. Lopez', 5, 'images/ProofOrder/405133756_1103434871014310_4899382460243127376_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(46, 162457569, 581603220, 'Hello ma\'am, papunta na ako'),
(47, 367955775, 581603220, 'hello po sir, papunta na po ako');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` enum('Unread','Read') DEFAULT 'Unread',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `order_id`, `content`, `status`, `timestamp`) VALUES
(19, 53, 20230768, 'Your order has been accepted by William D. Albano Jr.', 'Read', '2023-11-13 06:50:47'),
(20, 53, 20230768, 'The rider is on its way to your address.', 'Read', '2023-11-13 06:52:49'),
(21, 53, 20230768, 'Your order has been delivered.', 'Read', '2023-11-13 06:53:00'),
(22, 53, 20230769, 'Your order has been accepted by William D. Albano Jr.', 'Read', '2023-11-13 06:58:46'),
(23, 55, 20230770, 'Your order has been accepted by Kim Fredimil G. Lopez.', 'Read', '2023-11-13 06:59:51'),
(24, 55, 20230770, 'The rider is on its way to your address.', 'Read', '2023-11-13 07:24:34'),
(25, 55, 20230770, 'Your order has been delivered.', 'Read', '2023-11-13 07:25:12'),
(26, 58, 20230771, 'Your order has been accepted by Kim Fredimil G. Lopez.', 'Read', '2023-11-13 07:48:12'),
(27, 53, 20230769, 'The rider is on its way to your address.', 'Read', '2023-11-14 07:49:15'),
(28, 53, 20230769, 'Your order has been delivered.', 'Read', '2023-11-14 07:49:27'),
(29, 58, 20230771, 'The rider is on its way to your address.', 'Read', '2023-11-23 06:55:48'),
(30, 58, 20230771, 'Your order has been delivered.', 'Read', '2023-11-23 06:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `rider_orderupdate`
--

CREATE TABLE `rider_orderupdate` (
  `rider_uid` int(20) NOT NULL,
  `order_uid` int(20) NOT NULL,
  `rider_name` varchar(30) NOT NULL,
  `order_accept_time` datetime NOT NULL,
  `rider_location` varchar(50) NOT NULL,
  `location_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rider_orderupdate`
--

INSERT INTO `rider_orderupdate` (`rider_uid`, `order_uid`, `rider_name`, `order_accept_time`, `rider_location`, `location_time`) VALUES
(14, 20230768, 'Ethan Thompson', '2023-11-13 14:50:47', 'Order Accepted', '2023-11-13 14:50:47'),
(14, 20230768, '', '0000-00-00 00:00:00', 'Arrived at Location', '2023-11-13 14:52:09'),
(14, 20230768, '', '0000-00-00 00:00:00', 'Out for Delivery', '2023-11-13 14:52:49'),
(14, 20230768, '', '0000-00-00 00:00:00', 'Delivered', '2023-11-13 14:53:00'),
(14, 20230769, 'Ethan Thompson', '2023-11-13 14:58:46', 'Order Accepted', '2023-11-13 14:58:46'),
(15, 20230770, 'Sophia Davis', '2023-11-13 14:59:51', 'Order Accepted', '2023-11-13 14:59:51'),
(15, 20230770, '', '0000-00-00 00:00:00', 'Arrived at Location', '2023-11-13 15:24:18'),
(15, 20230770, '', '0000-00-00 00:00:00', 'Out for Delivery', '2023-11-13 15:24:34'),
(15, 20230770, '', '0000-00-00 00:00:00', 'Delivered', '2023-11-13 15:25:12'),
(15, 20230771, 'Sophia Davis', '2023-11-13 15:48:12', 'Order Accepted', '2023-11-13 15:48:12'),
(14, 20230769, '', '0000-00-00 00:00:00', 'Arrived at Location', '2023-11-14 15:49:00'),
(14, 20230769, '', '0000-00-00 00:00:00', 'Out for Delivery', '2023-11-14 15:49:15'),
(14, 20230769, '', '0000-00-00 00:00:00', 'Delivered', '2023-11-14 15:49:27'),
(15, 20230771, '', '0000-00-00 00:00:00', 'Arrived at Location', '2023-11-23 14:55:43'),
(15, 20230771, '', '0000-00-00 00:00:00', 'Out for Delivery', '2023-11-23 14:55:48'),
(15, 20230771, '', '0000-00-00 00:00:00', 'Delivered', '2023-11-23 14:55:57'),
(14, 20230772, 'William D. Albano Jr', '2024-06-25 23:25:43', 'Order Accepted', '2024-06-25 23:25:43'),
(14, 20230772, '', '0000-00-00 00:00:00', 'Arrived at Location', '2024-06-25 23:27:02'),
(14, 20230772, '', '0000-00-00 00:00:00', 'Out for Delivery', '2024-06-25 23:27:07'),
(14, 20230779, 'William D. Albano Jr', '2024-06-25 23:36:47', 'Order Accepted', '2024-06-25 23:36:47'),
(14, 20230779, '', '0000-00-00 00:00:00', 'Arrived at Location', '2024-06-25 23:47:34'),
(14, 20230779, '', '0000-00-00 00:00:00', 'Out for Delivery', '2024-06-25 23:47:38'),
(14, 20230780, 'William D. Albano Jr', '2024-06-25 23:50:32', 'Order Accepted', '2024-06-25 23:50:32'),
(14, 20230780, '', '0000-00-00 00:00:00', 'Arrived at Location', '2024-06-25 23:52:01'),
(14, 20230780, '', '0000-00-00 00:00:00', 'Out for Delivery', '2024-06-25 23:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `temp_rider`
--

CREATE TABLE `temp_rider` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `fbLink` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `COR` varchar(100) NOT NULL,
  `ORM` varchar(100) NOT NULL,
  `driverLicense` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_rider`
--

INSERT INTO `temp_rider` (`id`, `username`, `password`, `firstName`, `lastName`, `sex`, `fbLink`, `phoneNumber`, `COR`, `ORM`, `driverLicense`) VALUES
(16, '', '', 'John', 'Doe', 'Male', 'https://www.facebook.com/', '09123456789', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg'),
(17, '', '', 'Jane', 'Doe', 'Female', 'https://www.facebook.com/', '09123456789', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg'),
(18, '', '', 'Rosemary', 'Buraga', 'Female', 'https://www.facebook.com/', '09123456789', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg'),
(19, '', '', 'Alexander', 'Martinez', 'Male', 'https://www.facebook.com/', '09123456789', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg'),
(20, '', '', 'Olivia', 'Anderson', 'Female', 'https://www.facebook.com/', '90123456789', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `sex` char(10) NOT NULL,
  `municipality` varchar(20) NOT NULL,
  `barangay` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `fblink` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `idPic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`id`, `username`, `password`, `firstName`, `lastName`, `sex`, `municipality`, `barangay`, `street`, `fblink`, `phoneNumber`, `idPic`) VALUES
(124, 'lance', 'c2wad', 'Lance', 'Aranzado', 'Male', 'San Pablo', 'Calamagui', 'Purok 6', 'https://www.facebook.com/lance.aranzado.79', '09654797220', 'images/IDForClient/368934452_243965525129316_1944906952117861915_n.jpg'),
(125, 'mabli', 'c2wad', 'Christian', 'Libao', 'Male', 'San Pablo', 'Calamagui', 'Purok 2', 'https://www.facebook.com/Christian.Libao1026', '09157040517', 'images/IDForClient/393875282_675984487996055_3530024930177261737_n.jpg'),
(126, 'Emman26', 'Password123', 'Emmanuel Jr', 'Garcia', 'Male', 'Cabagan', 'Luquilu', 'Purok 2', 'https://www.facebook.com/emem.26.04', '09190957138', 'images/IDForClient/403410598_1285993645422880_7853370368598157535_n.jpg'),
(127, 'angel', 'c2wad', 'Angel Simeona Mae', 'Balisi', 'Female', 'Cabagan', 'Catabayungan', 'Purok 6', 'https://www.facebook.com/geltheawesome07', '09752760443', 'images/IDForClient/368505263_1543021949871411_5073278908838210316_n.jpg'),
(128, 'sheng', 'c2wad', 'Reyshelle Mae', 'Sagun', 'Female', 'Cabagan', 'Ugad', 'Purok 3', 'https://www.facebook.com/reyshellemae.cammayosagun', '09602291536', 'images/IDForClient/368462734_312642405050196_7892962705693564600_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `municipality` varchar(20) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street` varchar(30) NOT NULL,
  `fblink` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `account_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `unique_id`, `username`, `password`, `firstName`, `lastName`, `sex`, `municipality`, `barangay`, `street`, `fblink`, `phoneNumber`, `account_status`) VALUES
(53, '1426567829', 'ice', '$2y$10$vi8ucDsmWE/eufheI1tG8.2tWZbqS3iromxhKTlPDfAB/zEyl9gRa', 'Isaac Luis', 'Balabbo', 'Male', 'San Pablo', 'Calamagui', 'Purok 6', 'https://www.facebook.com/deFFataa/', '09056623529', 'Activated'),
(55, '162457569', 'rica', '$2y$10$75..tcPq7zWqOIK9qtKN5ea3aZB/cW0GEhqB7qLoRcBmWV8hYryxG', 'Rica', 'Denguray', 'Female', 'Tumauini', 'Barangay District 1 (Poblacion', 'Purok 3', 'https://www.facebook.com/RJ.denguray', '09123456789', 'Activated'),
(56, '379783372', 'kristel', '$2y$10$NhgMXCY1GsSJhrbe5sJWb.I5o39Fcqy88OEu.WzkkEbahqo5FKkzm', 'Kristel', 'Allam', 'Female', 'Cabagan', 'Catabayungan', 'Purok 1', 'https://www.facebook.com/tel.allam', '09637613424', 'Activated'),
(57, '1023542400', 'sarah', '$2y$10$JbJqNCuH/R7pPZIXg5DzO.Htmy.vPoCN9SYU9s0J9VhEebMxnHLcO', 'Sarah', 'Gatan', 'Female', 'Cabagan', 'Anao', 'Purok 5', 'https://www.facebook.com/', '09756620041', 'activated'),
(58, '367955775', 'jeff', '$2y$10$C0vMbS2CKpXiUMEtyraZcOQ1yJKdfadxL7dVBffQNXUU9uy39zMYm', 'Jefferson', 'Allapitan', 'Male', 'Tumauini', 'San Vicente', 'Purok 5', 'https://www.facebook.com/', '09123456789', 'activated');

-- --------------------------------------------------------

--
-- Table structure for table `user_rider`
--

CREATE TABLE `user_rider` (
  `rider_id` int(10) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `fblink` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `account_status` varchar(15) NOT NULL,
  `COR` varchar(255) NOT NULL,
  `ORM` varchar(255) NOT NULL,
  `driverLicense` varchar(255) NOT NULL,
  `day1` varchar(10) NOT NULL,
  `day2` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_rider`
--

INSERT INTO `user_rider` (`rider_id`, `unique_id`, `username`, `password`, `fullName`, `sex`, `fblink`, `phoneNumber`, `account_status`, `COR`, `ORM`, `driverLicense`, `day1`, `day2`) VALUES
(11, '', 'admin', 'c2wad123', '', '', '', '', '', '', '', '', '', ''),
(14, '201313510', 'wiliam', 'c2wad', 'William D. Albano Jr', 'Male', 'https://www.facebook.com/', '09610331372', 'Activated', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg', 'Monday', 'Tuesday'),
(15, '581603220', 'kim', 'c2wad', 'Kim Fredimil G. Lopez', 'Male', 'https://www.facebook.com/', '09278934523', 'Activated', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg', 'Monday', 'Tuesday'),
(16, '1349511664', 'jefferson', 'c2wad', 'Jefferson Esquillo', 'Male', 'https://www.facebook.com/', '09357635086', 'Activated', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg', 'Monday', 'Tuesday'),
(17, '1437399811', 'jaymark', 'c2wad', 'Jaymark Romero', 'Male', 'https://www.facebook.com/', '09690683640', 'Activated', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg', 'Monday', 'Tuesday'),
(18, '784126855', 'rodito', 'c2wad', 'Rodito Taguinod', 'Male', 'https://www.facebook.com/', '09397139901', 'Activated', 'images/IDForRider/lto-motor-vehicle-registration-requirements-1649406081.jpg', 'images/IDForRider/or-385b.jpg', 'images/IDForRider/10_2021-07-23_18-27-24.jpg', 'Monday', 'Tuesday');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_order`
--
ALTER TABLE `client_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_uid` (`order_uid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `rider_orderupdate`
--
ALTER TABLE `rider_orderupdate`
  ADD KEY `order_uid` (`order_uid`),
  ADD KEY `rider_uid` (`rider_uid`);

--
-- Indexes for table `temp_rider`
--
ALTER TABLE `temp_rider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_rider`
--
ALTER TABLE `user_rider`
  ADD PRIMARY KEY (`rider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_order`
--
ALTER TABLE `client_order`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20230781;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `temp_rider`
--
ALTER TABLE `temp_rider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_rider`
--
ALTER TABLE `user_rider`
  MODIFY `rider_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_order`
--
ALTER TABLE `client_order`
  ADD CONSTRAINT `client_order_ibfk_1` FOREIGN KEY (`order_uid`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `client_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rider_orderupdate`
--
ALTER TABLE `rider_orderupdate`
  ADD CONSTRAINT `rider_orderupdate_ibfk_2` FOREIGN KEY (`rider_uid`) REFERENCES `user_rider` (`rider_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
