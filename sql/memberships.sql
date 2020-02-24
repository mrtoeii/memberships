-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 04:33 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memberships`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$ooBltdXqiX1wqtuuiPDFxuDu9amn4kqClVu170gmIBjWLoj.H9PBy');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(5) NOT NULL,
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `code`, `name`) VALUES
(1, '10', 'กรุงเทพมหานคร   '),
(2, '11', 'สมุทรปราการ   '),
(3, '12', 'นนทบุรี   '),
(4, '13', 'ปทุมธานี   '),
(5, '14', 'พระนครศรีอยุธยา   '),
(6, '15', 'อ่างทอง   '),
(7, '16', 'ลพบุรี   '),
(8, '17', 'สิงห์บุรี   '),
(9, '18', 'ชัยนาท   '),
(10, '19', 'สระบุรี'),
(11, '20', 'ชลบุรี   '),
(12, '21', 'ระยอง   '),
(13, '22', 'จันทบุรี   '),
(14, '23', 'ตราด   '),
(15, '24', 'ฉะเชิงเทรา   '),
(16, '25', 'ปราจีนบุรี   '),
(17, '26', 'นครนายก   '),
(18, '27', 'สระแก้ว   '),
(19, '30', 'นครราชสีมา   '),
(20, '31', 'บุรีรัมย์   '),
(21, '32', 'สุรินทร์   '),
(22, '33', 'ศรีสะเกษ   '),
(23, '34', 'อุบลราชธานี   '),
(24, '35', 'ยโสธร   '),
(25, '36', 'ชัยภูมิ   '),
(26, '37', 'อำนาจเจริญ   '),
(27, '39', 'หนองบัวลำภู   '),
(28, '40', 'ขอนแก่น   '),
(29, '41', 'อุดรธานี   '),
(30, '42', 'เลย   '),
(31, '43', 'หนองคาย   '),
(32, '44', 'มหาสารคาม   '),
(33, '45', 'ร้อยเอ็ด   '),
(34, '46', 'กาฬสินธุ์   '),
(35, '47', 'สกลนคร   '),
(36, '48', 'นครพนม   '),
(37, '49', 'มุกดาหาร   '),
(38, '50', 'เชียงใหม่   '),
(39, '51', 'ลำพูน   '),
(40, '52', 'ลำปาง   '),
(41, '53', 'อุตรดิตถ์   '),
(42, '54', 'แพร่   '),
(43, '55', 'น่าน   '),
(44, '56', 'พะเยา   '),
(45, '57', 'เชียงราย   '),
(46, '58', 'แม่ฮ่องสอน   '),
(47, '60', 'นครสวรรค์   '),
(48, '61', 'อุทัยธานี   '),
(49, '62', 'กำแพงเพชร   '),
(50, '63', 'ตาก   '),
(51, '64', 'สุโขทัย   '),
(52, '65', 'พิษณุโลก   '),
(53, '66', 'พิจิตร   '),
(54, '67', 'เพชรบูรณ์   '),
(55, '70', 'ราชบุรี   '),
(56, '71', 'กาญจนบุรี   '),
(57, '72', 'สุพรรณบุรี   '),
(58, '73', 'นครปฐม   '),
(59, '74', 'สมุทรสาคร   '),
(60, '75', 'สมุทรสงคราม   '),
(61, '76', 'เพชรบุรี   '),
(62, '77', 'ประจวบคีรีขันธ์   '),
(63, '80', 'นครศรีธรรมราช   '),
(64, '81', 'กระบี่   '),
(65, '82', 'พังงา   '),
(66, '83', 'ภูเก็ต   '),
(67, '84', 'สุราษฎร์ธานี   '),
(68, '85', 'ระนอง   '),
(69, '86', 'ชุมพร   '),
(70, '90', 'สงขลา   '),
(71, '91', 'สตูล   '),
(72, '92', 'ตรัง   '),
(73, '93', 'พัทลุง   '),
(74, '94', 'ปัตตานี   '),
(75, '95', 'ยะลา   '),
(76, '96', 'นราธิวาส   '),
(77, '97', 'บึงกาฬ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `province_id` int(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `password`, `gender`, `province_id`, `image`, `created`, `modified`, `status`) VALUES
(4, 'อัครชาติ', 'ศิริบุตร', '$2y$10$/wGjT3PgzDLby9r3H7gTLuVCWkui703fTtDQOxVawkjM2LKGNwYAu', 'male', 29, 'images/hD3jS25zzo.jpg', '2020-02-23 13:13:07', NULL, 'user'),
(6, 'สมใจ', 'ใจดี', '$2y$10$6boYEwVKiUCG6877Yk3FNOMh/CBSO4gqQf4AgxxPq6qKOerdyxxDm', 'male', 4, 'no', '2020-02-24 09:57:22', NULL, 'user'),
(7, 'สมหมาย', 'ใจดี', '$2y$10$6xJoK2Lo7RTjDl1RbYOW0.iwCywAtFx4Ib6RxVL/nBiSlzB9MGhfC', 'male', 1, 'no', '2020-02-24 10:00:35', '2020-02-24 10:12:02', 'user'),
(8, 'ประภาส', 'สีมา', '$2y$10$INlN547iuFl57gQwfPs3iei2ERK.jgDc8L1F4MqozkDqlKKFCCe.e', 'male', 1, 'no', '2020-02-24 10:03:10', NULL, 'user'),
(9, 'อรอุมา', 'สิริ', '$2y$10$UN5R9qNpt47ysRI00dVDk.GShRINCUW591TDNU004haWC.BTP4bGK', 'female', 1, 'no', '2020-02-24 10:04:13', NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
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
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
