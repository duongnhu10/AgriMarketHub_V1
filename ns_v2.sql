-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 06:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ns_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `ten_nguoi_dung` varchar(100) DEFAULT NULL,
  `ho_va_ten` varchar(100) DEFAULT NULL,
  `mat_khau` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `ten_nguoi_dung`, `ho_va_ten`, `mat_khau`) VALUES
(12, 'duongnhu', 'Dương Thị Huỳnh Như', 'e10adc3949ba59abbe56e057f20f883e'),
(13, 'phanthao', 'Phan Phạm Ngọc Thảo', 'e10adc3949ba59abbe56e057f20f883e'),
(14, 'phamthu', 'Phạm Hoàng Minh Thư', 'e10adc3949ba59abbe56e057f20f883e'),
(17, 'duvy', 'Dư Mỹ Vy', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `id` int(11) NOT NULL,
  `san_pham` varchar(150) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `tong_tien` decimal(10,2) DEFAULT NULL,
  `ngay_dat` date DEFAULT NULL,
  `trang_thai` varchar(255) DEFAULT NULL,
  `khach_ten` varchar(150) DEFAULT NULL,
  `khach_sdt` varchar(20) NOT NULL,
  `khach_email` varchar(150) NOT NULL,
  `khach_diachi` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`id`, `san_pham`, `so_luong`, `gia`, `tong_tien`, `ngay_dat`, `trang_thai`, `khach_ten`, `khach_sdt`, `khach_email`, `khach_diachi`, `user_id`) VALUES
(25, 'Dâu tây', 3, 117600.00, 352800.00, '2024-04-14', 'Chờ xác nhận', 'Nguyễn Văn A', '0356628291', 'a@gmail.com', 'Cần Thơ', 0),
(26, 'Dâu tây', 1, 117600.00, 117600.00, '2024-04-14', 'Chờ xác nhận', 'a', 'a', 'a@gmail.com', 'a', 0),
(27, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '1@gmail.omc', '1', 21),
(28, 'Đu đủ', 5, 19400.00, 97000.00, '2024-04-14', 'Chờ xác nhận', 'a', 'a', 'a@ha.l', 'a', 20),
(29, 'Cà chua', 1, 14700.00, 14700.00, '2024-04-14', 'Chờ xác nhận', 'nhu', 'a', 'a@g.k', 'a', 21),
(30, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '12@gmail.com', '1', 21),
(31, 'Cà chua', 1, 14700.00, 14700.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '1@gmail.com', '1', 21),
(32, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '12@gmail.com1', '1', 21),
(36, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', 'a', '1', 'a@g.k', '1', 24),
(37, 'Cá nục', 1, 15000.00, 15000.00, '2024-04-14', 'Đã giao hàng', '1', '1', '12@gmail.com', '1', 24),
(47, 'Đu đủ', 3, 19400.00, 58200.00, '2024-04-18', 'Đã giao hàng', 'va', '323', '12@gmail.com1', '1', 32),
(48, 'Đu đủ', 3, 19400.00, 58200.00, '2024-04-19', 'Đã giao hàng', 'Duong Hoa', '0455682921', 'h@gmail.com', '34, Hồng Dân, Bạc Liêu', 30),
(50, 'Dâu tây', 1, 120000.00, 120000.00, '2024-04-20', 'Đã giao hàng', '1', '1', '1@gmail.com', '1', 33),
(51, 'Đu đủ', 1, 18000.00, 18000.00, '2024-04-20', 'Đã giao hàng', '1', '1233', '12@gmail.com', '12', 30),
(52, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-20', 'Chờ xác nhận', '1', '1', '1@gmail.com', '1', 30),
(54, 'Đu đủ', 34, 19400.00, 659600.00, '2024-04-21', 'Chờ xác nhận', '1', '1', '2@ad.v', '3', 35),
(55, 'Cà chua', 1, 14700.00, 14700.00, '2024-04-21', 'Đã giao hàng', 'Duong Th', '12', '1@gmail.com1', '21', 36),
(59, 'Kiwi', 1, 270000.00, 270000.00, '2024-04-25', 'Chờ xác nhận', '1', '1', '12@gmail.com', '1', 35),
(60, 'Cà chua', 5, 14700.00, 73500.00, '2024-04-25', 'Đã giao hàng', '12', '1', '1@gmail.com1', '21', 40),
(62, 'Dâu tây', 3, 117600.00, 352800.00, '2024-04-26', 'Chờ xác nhận', '1', '12', '12@gmail.com', '2', 35),
(109, 'Đu đủ', 6, 20000.00, 120000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(110, 'Cà chua', 4, 15000.00, 60000.00, '2024-05-02', 'Đã giao hàng', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41);

-- --------------------------------------------------------

--
-- Table structure for table `don_huy`
--

CREATE TABLE `don_huy` (
  `id` int(11) NOT NULL,
  `san_pham` varchar(150) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `tong_tien` decimal(10,2) DEFAULT NULL,
  `ngay_dat` date DEFAULT NULL,
  `trang_thai` varchar(255) DEFAULT NULL,
  `khach_ten` varchar(150) DEFAULT NULL,
  `khach_sdt` varchar(20) NOT NULL,
  `khach_email` varchar(150) NOT NULL,
  `khach_diachi` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_huy`
--

INSERT INTO `don_huy` (`id`, `san_pham`, `so_luong`, `gia`, `tong_tien`, `ngay_dat`, `trang_thai`, `khach_ten`, `khach_sdt`, `khach_email`, `khach_diachi`, `user_id`) VALUES
(9, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '1@gmail.com', '1', 0),
(10, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '12@gmail.com', '1', 0),
(11, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '12@gmail.com1', '1', 0),
(12, 'Đu đủ', 2, 18000.00, 36000.00, '2024-04-14', 'Chờ xác nhận', '1', '1', '12@gmail.com', '1', 0),
(13, 'Đu đủ', 29999, 18000.00, 99999999.99, '2024-04-18', 'Chờ xác nhận', '1', '1', '1@gmail.com', '1', 0),
(14, 'Đu đủ', 100000, 18000.00, 99999999.99, '2024-04-18', 'Chờ xác nhận', '1', '1', '12@gmail.com', '1', 0),
(15, 'Cà chua', 20, 12000.00, 240000.00, '2024-04-18', 'Chờ xác nhận', '1', '1', '2@ad.v', '1', 0),
(16, 'Đu đủ', 200, 18000.00, 3600000.00, '2024-04-18', 'Chờ xác nhận', '1', '1', '12@gmail.com', '23', 0),
(17, 'Đu đủ', 101, 18000.00, 1818000.00, '2024-04-18', 'Chờ xác nhận', '1', '3', '1@gmail.com1', '1', 0),
(18, 'Đu đủ', 12, 18000.00, 216000.00, '2024-04-18', 'Chờ xác nhận', '1', '1', '1@gmail.com', '1', 0),
(19, 'Đu đủ', 6, 18000.00, 108000.00, '2024-04-18', 'Chờ xác nhận', '1', '1', '12@gmail.com', '1', 0),
(20, 'Đu đủ', 6, 18000.00, 108000.00, '2024-04-18', 'Chờ xác nhận', '1', '1', '1@gmail.com1', '1', 0),
(21, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-19', 'Chờ xác nhận', 'Duong Hoa', '0388357292', 'a@gmail.com', 'Bạc Liêu', 0),
(22, 'Đu đủ', 1, 19400.00, 19400.00, '2024-04-20', 'Đang giao hàng', '1', '09999', '12@gmail.com', '1', 0),
(23, 'Nho', 1, 178200.00, 178200.00, '2024-04-21', 'Chờ xác nhận', '1', '12', '1@gmail.com1', '12', 35),
(24, 'Nho', 1, 178200.00, 178200.00, '2024-04-25', 'Chờ xác nhận', '1', '23', '323@df', '32', 39),
(25, 'Dâu tây', 7, 117600.00, 823200.00, '2024-04-25', 'Chờ xác nhận', 'va', '2123', '2@ad.v', '123', 39),
(26, '', 1, 300000.00, 0.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(27, '', 3, 120000.00, 0.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(28, '', 1, 300000.00, 0.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(29, '', 3, 120000.00, 0.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(30, '', 1, 300000.00, 300000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(31, '', 3, 120000.00, 360000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(32, 'Khóm', 1, 25000.00, 25000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(33, 'Đu đủ', 1, 20000.00, 20000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(34, 'Cà chua', 1, 15000.00, 15000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(35, 'Dâu tây', 1, 117600.00, 117600.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(36, 'Sầu riêng', 1, 350000.00, 350000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(37, 'Kiwi', 1, 300000.00, 300000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(38, 'Dâu tây', 3, 120000.00, 360000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(39, 'Kiwi', 1, 300000.00, 300000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(40, 'Dâu tây', 3, 120000.00, 360000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(41, 'Sầu riêng', 1, 350000.00, 350000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(42, 'Dâu tây', 3, 120000.00, 360000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(43, 'Cà chua', 10, 14700.00, 147000.00, '2024-04-25', 'Chờ xác nhận', 'Van a', '03833', '12@gmail.com', '12', 41),
(44, 'Đu đủ', 0, 20000.00, 0.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(45, 'Khóm', 2, 25000.00, 50000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(46, 'Đu đủ', 2, 20000.00, 40000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(47, 'Khóm', 1, 25000.00, 25000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(48, 'Đu đủ', 1, 20000.00, 20000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(49, 'Khóm', 1, 25000.00, 25000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(50, 'Đu đủ', 1, 20000.00, 20000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(51, 'Đu đủ', 1, 20000.00, 20000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(52, 'Đu đủ', 1, 20000.00, 20000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(53, 'Cà chua', 1, 15000.00, 15000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(54, 'Đu đủ', 1, 20000.00, 20000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(55, 'Cà chua', 1, 15000.00, 15000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(56, 'Đu đủ', 1, 20000.00, 20000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(57, 'Cà chua', 1, 15000.00, 15000.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(58, 'Cà chua', 1, 14700.00, 14700.00, '2024-04-27', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(59, 'Cà chua', 2, 15000.00, 30000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(60, 'Đu đủ', 1, 20000.00, 20000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(61, 'Cà chua', 1, 15000.00, 15000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(62, 'Đu đủ', 12, 20000.00, 240000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(63, 'Cà chua', 14, 15000.00, 210000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(64, 'Đu đủ', 56, 20000.00, 1120000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(65, 'Đu đủ', 1, 20000.00, 20000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(66, 'Cà chua', 2, 15000.00, 30000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(67, 'Đu đủ', 4, 20000.00, 80000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(68, 'Đu đủ', 4, 20000.00, 80000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(69, 'Đu đủ', 8, 20000.00, 160000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(70, 'Cà chua', 2, 15000.00, 30000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(71, 'Cà chua', 4, 15000.00, 60000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41),
(72, 'Đu đủ', 6, 20000.00, 120000.00, '2024-05-02', 'Chờ xác nhận', 'Van A', '0388453673', 'nhu@gmail.com', 'Cần Thơ', 41);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(150) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `so_luong` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `gia_khuyen_mai` int(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gia_dn` decimal(10,2) NOT NULL,
  `chon` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`id`, `ten_san_pham`, `gia`, `anh`, `so_luong`, `san_pham_id`, `gia_khuyen_mai`, `user_id`, `gia_dn`, `chon`) VALUES
(89, 'Cá hồi', 300000.00, 'Nong_San_7976.PNG', 2, 41, 4, 20, 0.00, 0),
(90, 'Cà chua', 15000.00, 'Nong_San_3313.jpg', 2, 21, 2, 21, 0.00, 0),
(93, 'Đu đủ', 20000.00, 'Nong_San_1654.jpg', 20, 20, 3, 24, 18000.00, 0),
(94, 'Dâu tây', 120000.00, 'Nong_San_5556.jpg', 4, 23, 2, 24, 0.00, 0),
(95, 'Nho', 180000.00, 'Nong_San_9910.jpg', 2, 25, 1, 26, 0.00, 0),
(96, 'Bưởi', 100000.00, 'Nong_San_6597.jpg', 2, 27, 0, 29, 0.00, 0),
(101, 'Đu đủ', 20000.00, 'Nong_San_1654.jpg', 20, 20, 3, 30, 18000.00, 0),
(107, 'Cà chua', 15000.00, 'Nong_San_3313.jpg', 9, 21, 2, 36, 12000.00, 0),
(108, 'Sầu riêng', 350000.00, 'Nong_San_5814.jpg', 6, 24, 5, 36, 310000.00, 0),
(109, 'Khóm', 25000.00, 'Nong_San_6744.jpg', 3, 26, 1, 36, 22000.00, 0),
(111, 'Dâu tây', 120000.00, 'Nong_San_5556.jpg', 4, 23, 2, 35, 120000.00, 0),
(112, 'Đu đủ', 20000.00, 'Nong_San_1654.jpg', 7, 20, 3, 37, 18000.00, 0),
(115, 'Dâu tây', 120000.00, 'Nong_San_5556.jpg', 3, 23, 2, 38, 120000.00, 0),
(117, 'Nho', 180000.00, 'Nong_San_9910.jpg', 1, 25, 1, 39, 160000.00, 0),
(119, 'Cà chua', 15000.00, 'Nong_San_3313.jpg', 3, 21, 2, 40, 13000.00, 0),
(133, 'Đu đủ', 20000.00, 'Nong_San_1654.jpg', 6, 20, 3, 41, 18000.00, 1),
(134, 'Cà chua', 15000.00, 'Nong_San_3313.jpg', 4, 21, 2, 41, 13000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `id` int(11) NOT NULL,
  `ten_nguoi_dung` varchar(100) NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL,
  `mat_khau` varchar(255) DEFAULT NULL,
  `doanh_nghiep` tinyint(1) DEFAULT NULL,
  `ho_va_ten` varchar(100) DEFAULT NULL,
  `anh` varchar(255) NOT NULL,
  `ten_doanh_nghiep` varchar(250) NOT NULL,
  `ma_so_thue` varchar(50) NOT NULL,
  `sdt` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diachi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`id`, `ten_nguoi_dung`, `gioi_tinh`, `mat_khau`, `doanh_nghiep`, `ho_va_ten`, `anh`, `ten_doanh_nghiep`, `ma_so_thue`, `sdt`, `email`, `diachi`) VALUES
(35, 'duongvana', 1, 'e10adc3949ba59abbe56e057f20f883e', 0, 'Duong Hoa', 'Avatar7960.jpg', '', '', '0388453673', 'nhu@gmail.com', 'Cần Thơ'),
(36, 'e3', 0, 'e10adc3949ba59abbe56e057f20f883e', 1, 'Nhu', '', '', '', '', '', ''),
(37, 'n5', 1, 'e10adc3949ba59abbe56e057f20f883e', 0, 'Nhu', '', '', '', '', '', ''),
(38, 'e1', 0, 'e10adc3949ba59abbe56e057f20f883e', 1, 'e1', '', '', '', '', '', ''),
(39, 'r4', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 'Nhu', 'Avatar1161.jpg', '', '', '', '', ''),
(40, 'w1', 1, 'e10adc3949ba59abbe56e057f20f883e', 1, 'Nhu', 'Avatar5064.jpg', '', '', '', '', ''),
(41, 'a1', 1, 'e10adc3949ba59abbe56e057f20f883e', 0, 'Van A', 'Avatar9299.jpg', '', '', '0388453673', 'nhu@gmail.com', 'Cần Thơ');

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `id` int(11) NOT NULL,
  `ngay_batdau` date NOT NULL,
  `ngay_ketthuc` date NOT NULL,
  `sanpham_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`id`, `ngay_batdau`, `ngay_ketthuc`, `sanpham_id`) VALUES
(11, '2024-04-02', '2024-04-18', 20),
(12, '2024-04-10', '2024-04-18', 20),
(13, '2024-04-02', '2024-04-15', 21),
(14, '2024-04-02', '2024-04-24', 24),
(15, '2024-04-02', '2024-04-15', 25),
(16, '2024-04-02', '2024-04-15', 26),
(17, '2024-04-10', '2024-04-12', 32),
(18, '2024-04-02', '2024-04-15', 47),
(19, '2024-04-02', '2024-04-12', 46),
(20, '2024-04-02', '2024-04-24', 45),
(21, '2024-04-23', '2024-04-24', 41),
(22, '2024-04-10', '2024-04-24', 28),
(23, '2024-04-08', '2024-04-18', 27),
(24, '2024-04-02', '2024-04-18', 33),
(25, '2024-04-02', '2024-04-24', 35),
(26, '2024-04-02', '2024-04-15', 36),
(27, '2024-04-02', '2024-04-18', 38),
(28, '2024-04-02', '2024-04-24', 39),
(29, '2024-04-02', '2024-04-18', 40),
(30, '2024-04-04', '2024-04-18', 23),
(31, '2024-04-02', '2024-04-24', 37),
(32, '2024-04-02', '2024-04-02', 64),
(33, '2024-04-02', '2024-04-02', 64),
(34, '2024-04-02', '2024-04-18', 20);

-- --------------------------------------------------------

--
-- Table structure for table `lien_he`
--

CREATE TABLE `lien_he` (
  `id` int(11) NOT NULL,
  `khach_ten` varchar(100) NOT NULL,
  `khach_email` varchar(100) NOT NULL,
  `khach_diachi` varchar(100) NOT NULL,
  `khach_sdt` varchar(100) NOT NULL,
  `noi_dung` varchar(1024) NOT NULL,
  `ngay` date NOT NULL,
  `donhang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lien_he`
--

INSERT INTO `lien_he` (`id`, `khach_ten`, `khach_email`, `khach_diachi`, `khach_sdt`, `noi_dung`, `ngay`, `donhang_id`) VALUES
(18, '1', 'a@g.k', '3', '3', '3', '2024-04-21', 55),
(19, '1', '12@gmail.com1', '12', '12', '12', '2024-04-25', 57),
(20, 'Van A', 'nhu@gmail.com', 'Cần Thơ', '0388453673', 'Tot', '2024-05-02', 110);

-- --------------------------------------------------------

--
-- Table structure for table `loai_san_pham`
--

CREATE TABLE `loai_san_pham` (
  `id` int(11) NOT NULL,
  `ten_loai` varchar(255) DEFAULT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `trang_thai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loai_san_pham`
--

INSERT INTO `loai_san_pham` (`id`, `ten_loai`, `anh`, `trang_thai`) VALUES
(31, 'Rau củ', 'Loai_NongSan_168.jpg', 'Còn hàng'),
(32, 'Trái cây', 'Loai_NongSan_825.jpg', 'Còn hàng'),
(33, 'Thịt cá', 'Loai_NongSan_500.jpg', 'Còn hàng');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `gia` decimal(10,2) DEFAULT NULL,
  `anh` varchar(255) DEFAULT NULL,
  `loai_id` int(11) DEFAULT NULL,
  `trang_thai` varchar(20) DEFAULT NULL,
  `gia_goc` decimal(10,2) DEFAULT NULL,
  `gia_khuyen_mai` int(11) DEFAULT NULL,
  `gia_dn` decimal(10,2) NOT NULL,
  `ton_kho` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`id`, `ten_san_pham`, `mo_ta`, `gia`, `anh`, `loai_id`, `trang_thai`, `gia_goc`, `gia_khuyen_mai`, `gia_dn`, `ton_kho`) VALUES
(20, 'Đu đủ', 'Cung cấp vitamin C, A, và các loại khoáng chất như kali và magie.', 20000.00, 'Nong_San_1654.jpg', 32, 'Còn hàng', 15000.00, 3, 18000.00, 22),
(21, 'Cà chua', 'Nguồn dồi dào của vitamin và khoáng chất, đặc biệt là vitamin C và vitamin A. Nó cũng chứa một lượng lớn chất chống oxy hóa.', 15000.00, 'Nong_San_3313.jpg', 31, 'Còn hàng', 10000.00, 2, 13000.00, 18),
(23, 'Dâu tây', 'Cung cấp lượng lớn vitamin C và mangan, cùng với chất xơ.', 120000.00, 'Nong_San_5556.jpg', 32, 'Còn hàng', 110000.00, 2, 120000.00, 14),
(24, 'Sầu riêng', 'Nguồn cung cấp chất dinh dưỡng đa dạng.', 350000.00, 'Nong_San_5814.jpg', 32, 'Còn hàng', 300000.00, 5, 310000.00, 12),
(25, 'Nho', 'Nguồn cung cấp các dưỡng chất quan trọng như vitamin C, K và A.', 180000.00, 'Nong_San_9910.jpg', 32, 'Còn hàng', 150000.00, 1, 160000.00, 1),
(26, 'Khóm', 'Chứa một số dưỡng chất quan trọng như vitamin C, kali, và chất xơ.', 25000.00, 'Nong_San_6744.jpg', 32, 'Còn hàng', 20000.00, 1, 22000.00, 9),
(27, 'Bưởi', 'Nguồn cung cấp chất dinh dưỡng quan trọng như vitamin C, A, và kali. Nó cũng chứa một lượng đáng kể chất xơ, giúp cải thiện tiêu hóa và duy trì sức khỏe tim mạch.', 100000.00, 'Nong_San_6597.jpg', 32, 'Còn hàng', 90000.00, 0, 95000.00, 19),
(28, 'Dưa hấu', 'Nguồn cung cấp chất dinh dưỡng quan trọng như vitamin C, A, kali và magiê. Nó cũng chứa một lượng đáng kể chất xơ, giúp hỗ trợ hệ tiêu hóa và duy trì sức khỏe tim mạch.', 10000.00, 'Nong_San_6120.jpg', 32, 'Còn hàng', 9000.00, 20, 9500.00, 19),
(32, 'Khoai lang', 'Nguồn cung cấp chất dinh dưỡng quan trọng, bao gồm carbohydrate, chất xơ, vitamin C, vitamin B6, kali và magiê. Chúng cũng chứa một lượng nhỏ protein và không chứa cholesterol.', 50000.00, 'Nong_San_8940.jpg', 31, 'Còn hàng', 40000.00, 1, 45000.00, 11),
(33, 'Bắp cải', 'Nguồn cung cấp chất dinh dưỡng quan trọng, bao gồm vitamin C, vitamin K, acid folic, kali và chất xơ. Nó cũng chứa các hợp chất chống oxy hóa và các hợp chất chống vi khuẩn có lợi cho sức khỏe.', 16000.00, 'Nong_San_8474.jpg', 31, 'Còn hàng', 10000.00, 10, 17000.00, 45),
(35, 'Ớt chuông', 'Nguồn cung cấp chất dinh dưỡng quan trọng, bao gồm vitamin C, vitamin K, acid folic, kali và chất xơ.', 30000.00, 'Nong_San_3791.jpg', 31, 'Còn hàng', 20000.00, 2, 23000.00, 55),
(36, 'Hành tây', 'Nguồn cung cấp chất dinh dưỡng quan trọng, bao gồm vitamin C, vitamin K, acid folic, kali và chất xơ.', 40000.00, 'Nong_San_9607.jpg', 31, 'Còn hàng', 30000.00, 60, 34000.00, 4),
(37, 'Cá mè', 'Nguồn cung cấp protein chất lượng cao, axit béo omega-3, và các dưỡng chất khác như vitamin D, vitamin B12 và sắt. ', 140000.00, 'Nong_San_4423.jpg', 33, 'Còn hàng', 30000.00, 90, 250000.00, 12),
(38, 'Cua', 'Nguồn cung cấp protein chất lượng cao, axit béo omega-3, và các dưỡng chất khác như vitamin D, vitamin B12 và sắt. ', 40000.00, 'Nong_San_4586.jpg', 33, 'Còn hàng', 30000.00, 12, 37000.00, 12),
(39, 'Tôm', 'Nguồn cung cấp protein chất lượng cao, axit béo omega-3, và các dưỡng chất khác như vitamin D, vitamin B12 và sắt.', 100000.00, 'Nong_San_971.jpg', 33, 'Còn hàng', 20000.00, 90, 27000.00, 45),
(40, 'Mực', 'Nguồn cung cấp protein chất lượng cao, axit béo omega-3, và các dưỡng chất khác như vitamin D, vitamin B12 và sắt.', 500000.00, 'Nong_San_4051.PNG', 33, 'Còn hàng', 200000.00, 10, 260000.00, 43),
(41, 'Cá hồi', 'Nguồn cung cấp protein chất lượng cao, axit béo omega-3.', 300000.00, 'Nong_San_7976.PNG', 33, 'Còn hàng', 200000.00, 4, 250000.00, 12),
(43, 'Cá nục', 'Nguồn cung cấp protein chất lượng cao, axit béo omega-3, và các dưỡng chất khác như vitamin D, vitamin B12 và sắt.', 15000.00, 'Nong_San_7640.PNG', 33, 'Còn hàng', 10000.00, 0, 15000.00, 12),
(44, 'Cá điêu hồng', 'Nguồn cung cấp chất dinh dưỡng quan trọng như vitamin C, A, kali và magiê. ', 40000.00, 'Nong_San_4901.PNG', 33, 'Còn hàng', 20000.00, 0, 25000.00, 45),
(45, 'Kiwi', 'Nguồn cung cấp chất dinh dưỡng quan trọng như vitamin C, A, kali và magiê. Nó cũng chứa một lượng đáng kể chất xơ, giúp hỗ trợ hệ tiêu hóa và duy trì sức khỏe tim mạch.', 300000.00, 'Nong_San_2922.jpg', 32, 'Còn hàng', 200000.00, 10, 230000.00, 12),
(46, 'Hành', 'Nguồn cung cấp chất dinh dưỡng quan trọng như vitamin C, B6, kali, magiê và chất xơ. Nó cũng chứa các hợp chất chống oxy hóa và chất chống vi khuẩn, có thể có lợi cho sức khỏe.', 14000.00, 'Nong_San_3019.jpg', 31, 'Còn hàng', 9000.00, 3, 9800.00, 44),
(47, 'Bí ngô', 'Nguồn cung cấp chất dinh dưỡng quan trọng, bao gồm carbohydrate, chất xơ, vitamin C, vitamin B6, kali và magiê. Chúng cũng chứa một lượng nhỏ protein và không chứa cholesterol.', 25000.00, 'Nong_San_294.jpg', 31, 'Còn hàng', 20000.00, 2, 21000.00, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_huy`
--
ALTER TABLE `don_huy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ten_nguoi_dung` (`ten_nguoi_dung`);

--
-- Indexes for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loai_id` (`loai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `don_huy`
--
ALTER TABLE `don_huy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `khach_hang`
--
ALTER TABLE `khach_hang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`loai_id`) REFERENCES `loai_san_pham` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
