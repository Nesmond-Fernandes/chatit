-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 12:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_it`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_logged_in` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `created_at`, `last_logged_in`) VALUES
(1, 'admin123', 'Nesmond', 'Fernandes', 'admin@gmail.com', '$2y$10$4HFSdWhGb0FKtj5imDPR3.rw8TMQl/OBLM68Bf6NC3YbCvUcFvjRi', '2024-09-10 12:18:37', '2024-09-19 05:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` int(40) NOT NULL,
  `chat_id` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_active` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `chat_id`, `created_at`, `last_active`) VALUES
(1, '66ebf41b08d3d9.83096116', '2024-09-19 09:51:23', '2024-09-19 09:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `chatroom_users`
--

CREATE TABLE `chatroom_users` (
  `id` int(11) NOT NULL,
  `chat_id` varchar(40) NOT NULL,
  `user_id` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatroom_users`
--

INSERT INTO `chatroom_users` (`id`, `chat_id`, `user_id`) VALUES
(1, '66ebf41b08d3d9.83096116', 3),
(2, '66ebf41b08d3d9.83096116', 5);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(40) NOT NULL,
  `sent_from` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `chat_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sent_from`, `message`, `created_at`, `chat_id`) VALUES
(1, 3, 'hi tonny', '2024-09-19 09:54:34', '66ebf41b08d3d9.83096116'),
(2, 5, 'hi test', '2024-09-19 09:54:50', '66ebf41b08d3d9.83096116'),
(3, 5, 'how are you', '2024-09-19 09:55:00', '66ebf41b08d3d9.83096116'),
(4, 3, 'im fine', '2024-09-19 09:55:22', '66ebf41b08d3d9.83096116'),
(5, 3, 'how are you', '2024-09-19 09:55:39', '66ebf41b08d3d9.83096116'),
(6, 5, 'oh good to knw , im doing well', '2024-09-19 09:55:51', '66ebf41b08d3d9.83096116');

-- --------------------------------------------------------

--
-- Table structure for table `chat_requests`
--

CREATE TABLE `chat_requests` (
  `id` int(40) NOT NULL,
  `req_from` int(40) NOT NULL,
  `req_to` int(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_code` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_requests`
--

INSERT INTO `chat_requests` (`id`, `req_from`, `req_to`, `created_at`, `status_code`) VALUES
(1, 3, 5, '2024-09-19 09:51:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `id` int(40) NOT NULL,
  `status_code` int(40) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`id`, `status_code`, `status`) VALUES
(1, 1, 'Requested'),
(2, 2, 'Accepted'),
(3, 3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_logged_in` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `created_at`, `last_logged_in`) VALUES
(3, 'test', 'code', 'test@gmail.com', 'test123', '$2y$10$4HFSdWhGb0FKtj5imDPR3.rw8TMQl/OBLM68Bf6NC3YbCvUcFvjRi', '2024-09-09 06:50:11', '2024-09-19 05:21:52'),
(5, 'Tonny', 'Chopper', 'tonny@gmail.com', 'tonny', '$2y$10$MnNvTBzYQCyJkqxEA0zLVOP1FsWAitO.ujoddMNpP6KvSOMP.id26', '2024-09-11 07:49:24', '2024-09-19 05:38:57'),
(6, 'Bat', 'Man', 'batman@gmail.com', 'batman', '$2y$10$YKQI.98Kw.nL0ufNMiK/de.X1Xhm7WFlpf1ZlpiFes7PVnABToE1i', '2024-09-11 07:56:38', '2024-09-16 13:35:28'),
(7, 'Ursa', 'Wolf', 'kyhajazeze@gmail.com', 'tahyju', '$2y$10$WBdcOEc.sDiemHR6Qs7wReNHewjjuKV0IyTlxixVLRzJQ3MkIzzGW', '2024-09-11 16:55:52', '2024-09-17 13:13:39'),
(8, 'Sharon', 'Juarez', 'lyrywaf@gmail.com', 'sacuho', '$2y$10$rDziSYJ1L/OHABUgi0fZo.2lVvgXXGkrx0nxSMSi/7B6EgyAqfZfm', '2024-09-11 16:56:10', '0000-00-00 00:00:00'),
(9, 'Odette', 'Hooper', 'pegepuwy@gmail.com', 'pysytubo', '$2y$10$nmiP3QdnNFKvmqzEMlVweOFglXoeD6l76v5gPUlzfNMg5Qj8s18im', '2024-09-11 16:56:34', '0000-00-00 00:00:00'),
(10, 'Amal', 'Thornton', 'naqojyk@gmail.com', 'nafyc', '$2y$10$CLxs6vzo0Qu4ZEuges.EhubxkmRnb0sVVULGSu53CT4NTV6E.lPB.', '2024-09-11 16:56:47', '0000-00-00 00:00:00'),
(11, 'Lara', 'Holt', 'xywy@gmail.com', 'saryqiqoji', '$2y$10$DxDAWlL48FdzrLN9O2V3HOsZ8RxM8BmvQ7mnrNQiX6Q/pUvDIKFyi', '2024-09-11 16:57:10', '0000-00-00 00:00:00'),
(12, 'Robin', 'Mcbride', 'gehagaryci@gmail.com', 'wezymok', '$2y$10$sRBCczQhvvBSuQe9Ha8vtOhCPdi1ubEt7DxmH9TK2YkZqHYdcpEDy', '2024-09-11 16:57:45', '0000-00-00 00:00:00'),
(13, 'Sebastian', 'Stone', 'noterimumy@gmail.com', 'hesidos', '$2y$10$FceDJ8jyqCqLUzIHIzmJ3uWFpC1B7knm5LU7N9qILoN6DLnD4b8hG', '2024-09-11 16:58:01', '0000-00-00 00:00:00'),
(14, 'Ariana', 'Jones', 'sygehulu@gmail.com', 'xeqawym', '$2y$10$eWbbav7vLO6drErHaEduFO6LtcWALFo5ym.Sf3nZ4/HZm8RC3mnMO', '2024-09-11 16:58:17', '0000-00-00 00:00:00'),
(15, 'George', 'Rutledge', 'lykoholyx@gmail.com', 'mujosogu', '$2y$10$TH8PPRwnvX4aoYgRFrJsLOCEDN.k1mtfN.oNDyFd/YZGhz.zEhKGC', '2024-09-11 16:58:33', '0000-00-00 00:00:00'),
(16, 'Gray', 'Espinoza', 'leky@gmail.com', 'silis', '$2y$10$1C.kL7nzOO4e3E2Qq15Z2ukre8B8C6ppgNjPDFxTf3JFlZ2d4Ujgi', '2024-09-11 16:59:59', '0000-00-00 00:00:00'),
(17, 'Vielka', 'Armstrong', 'lejunu@gmail.com', 'jisujydyk', '$2y$10$VK7nIdwtxkUpH5ZG7t6K5OXcADC5PZx9wwV.4V7HZjt0Lrcq3TWR.', '2024-09-12 20:19:42', '0000-00-00 00:00:00'),
(18, 'Macy', 'Kerr', 'kupuhypeju@gmail.com', 'judugewe', '$2y$10$NX2ujb1YiWoy/s8.wQrw7uGh.y175Hn0CWOc2abhijP1lVicphEvO', '2024-09-12 20:19:57', '0000-00-00 00:00:00'),
(19, 'Oren', 'Fulton', 'culafe@gmail.com', 'dixisafavo', '$2y$10$J4VkofiDsRim6usYaZYxW.BWLK22q4eDaGAPxixBAFPynKrzAUuyW', '2024-09-12 20:20:11', '0000-00-00 00:00:00'),
(20, 'Erasmus', 'Moon', 'lywukyb@gmail.com', 'zajicegyju', '$2y$10$JZPJxI8l2WAgSJuWW31MdewV4fPUW4cb/UiDANtapK/YrhPY3Ht1W', '2024-09-12 20:20:23', '0000-00-00 00:00:00'),
(21, 'Sharon', 'Cabrera', 'vipado@gmail.com', 'degehyvu', '$2y$10$v.zOs8MB7/fVEXdMvyTSUeJsTwtjX6k69Xem3PiFF42/N7m6IkeNi', '2024-09-12 20:20:36', '0000-00-00 00:00:00'),
(22, 'Len', 'Carney', 'qulafakyl@gmail.com', 'cisexi', '$2y$10$wQS4RJG5tysHM0VyzCOFEuXBKhKYdYVkd5cJyuR.yBeHuJfMIfd2m', '2024-09-12 20:22:32', '0000-00-00 00:00:00'),
(23, 'Elvis', 'Brewer', 'cysigy@gmail.com', 'widev', '$2y$10$7l.QfdaU009c75LJyzLKn.FGiQAamjWyld1vqm8mWU1eSXDGiuXey', '2024-09-12 20:22:59', '0000-00-00 00:00:00'),
(24, 'Burton', 'Pruitt', 'lyxywetiw@gmail.com', 'tavecy', '$2y$10$zLGOsRdwbcUyXomkdUbQtuHEEPn7/CMbgarXN/De42hkTJCw87TJ.', '2024-09-12 20:23:11', '2024-09-18 09:18:37'),
(25, 'Lev', 'Donaldson', 'kutocyrynu@gmail.com', 'bidigirydo', '$2y$10$meRWgzZoX7Yicyv4BsHRDuTcOu.jZvK.bbpm2Akn8U5tJnmrd.T1.', '2024-09-12 20:23:22', '2024-09-12 20:23:22'),
(26, 'Colorado', 'Colorado', 'bikur@gmail.com', 'byhejipywa', '$2y$10$UN0Zu4bOIxKZ3YTPoAToTe/qIO1G77MPMFme/sT0XYCkG4KyDUvrq', '2024-09-13 06:22:13', '2024-09-13 06:22:13'),
(27, 'Dai', 'Dai', 'sawiju@hotmail.com', 'xekytor', '$2y$10$Flq.xc7DgVFjUHztp4EVYufFi.yoU1o4T2baOz7BbquqbiDuVxB/u', '2024-09-13 06:22:57', '2024-09-13 06:22:57'),
(28, 'Gareth', 'Gareth', 'nygu@gmail.com', 'sivita', '$2y$10$/pin1F.PfDC.TGxRXAxzXu2hyylMffQwe7D4GuAcCMZTPalhWSa7O', '2024-09-13 18:54:53', '2024-09-13 18:54:53'),
(29, 'Colorado', 'Colorado', 'bujicovogi@gmail.com', 'hugaxosuli', '$2y$10$Beskj5I3/QzBl2RGOXSFN..6ayHO4c2j7yotATWHSBAX0woNjR6qO', '2024-09-16 15:41:44', '2024-09-16 15:41:44'),
(30, 'April', 'April', 'suju@gmail.com', 'capig', '$2y$10$gPAxAXaS2F.2qeeLmDFfjepXL5BU4DbgfaGgUThMkijTKhaT/aKgC', '2024-09-16 15:42:04', '2024-09-16 15:42:04'),
(31, 'Ivor', 'Ivor', 'jules@gmail.com', 'nykiqofi', '$2y$10$yvHNOwSsmnR1ugtS2wzX1.ht5jiIAAXLeiO9S4YcW99lkZZLlL/Si', '2024-09-16 15:42:22', '2024-09-16 15:42:22'),
(32, 'Brennan', 'Brennan', 'viho@gmail.com', 'zysikoka', '$2y$10$c.08OvIUkMY8tPJhwPvyB./PIT.RPsClLpKdiLd5M5oD/Nrc7B0rW', '2024-09-16 15:42:58', '2024-09-16 15:42:58'),
(33, 'Gretchen', 'Gretchen', 'qexysipel@gmail.com', 'toxohogap', '$2y$10$6FiNo5QZ5GGqqRA0w4SIoe7Xd7PkMCaP4fh13bdaUVyeGTi9EgFze', '2024-09-16 15:43:22', '2024-09-18 09:19:53'),
(34, 'Amos', 'Amos', 'vedew@gmail.com', 'rejocoj', '$2y$10$PdEkZqq9HygdxVanZlHrMuEom/lSH682tGnqaNVreEFqaeigv7Y6e', '2024-09-18 08:17:05', '2024-09-18 08:17:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `chatroom_users`
--
ALTER TABLE `chatroom_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_requests`
--
ALTER TABLE `chat_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chatroom_users`
--
ALTER TABLE `chatroom_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_requests`
--
ALTER TABLE `chat_requests`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request_status`
--
ALTER TABLE `request_status`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
