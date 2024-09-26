-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 03:15 PM
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
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `salt`) VALUES
(1, 'johnrylcandelon26@gmail.com', 'f04a5a910bbc5c09af05c60f2e654dc8da40123d0671f148ac8fed7bda656790', '9395a03b488fe57b72447c2c7f3eb4c679f796fa7af855c0ac100e5a97e063e2'),
(3, 'johnrylcandelon26@gmail.com', '3631fe463f591e8693e0680454a2a35e2f476ec1f4707e7142aa31859dae6288', '5e9967e9003abfd3f62a46882c81a0fed21bf5c8925b4549ceb8f449a690b84c'),
(4, 'johnrylcandelon26@gmail.com', 'bd977b4361bfaadec69236b726c474b5de63281e860ef3b16eea81ed386f249e', '50ad8a80d070fa2c26cf1d6a20a502acefc3be0c9b2cfad040db6a3e7b6f6769'),
(5, 'johnrylcandelon26@gmail.com', '9fe34c2c9ed3fe8e661dc68dc04f284070228a8cc2c975dbdba61535a9c9e3b1', '93c202eb403fa3d665665fea5d98ef7ea65d0e856638fd29f8d015fc1948d478'),
(6, 'johnrylcandelon26@gmail.com', '5f44f0878bebfcc9a71b75528590fad759aad7183c2dc182db9076c4b3733c8c', '64542755c3b3d1d7b10d45e621f25c37b6185c936a27ca8ac9314942cc85739d'),
(7, 'johnrylcandelon26@gmail.com', '4063c8205a3d30234c72f0d679dc260b32c5327b24aff36ae96fda9159442b90', '8d7d4c397289c49ab9a6791d7d1101c8645b328a941bcf8b1e16e02f50848831'),
(8, 'johnrylcandelon26@gmail.com', '169893ca07f33af66ff445f6596af83910b3be0477f7f510b859880c075ad932', 'b243b8baac5f1ee03fb7f7b2fd37df8f88203b8aa3628ba0b35ccf552bd194d1'),
(9, 'johnrylcandelon@gmail.com', 'cb7bf9f3ec3c1c886971eb8325928db68b0b26f4c9b2dcf56ffcc4310b6d897e', '7a781b947bd39ba25027195ab10322e14b6b13cd9f673c6653f7e6836ecc9920'),
(10, 'johnryl@gmail.com', 'd5e78d2e8e5ac7a9dd721ac3551a46f84dfe15ff581b833d45e8962c2c0a218c', '592979a8901df5815b704df8932ab1fee966eff2189b60aefe01ac23bbfb0e8a'),
(11, 'yap@gmail.com', '30a7133453f5b85cd7e40b2d30c7d71ce130b90a7265dac25bbbea1ba9f043ed', '1f11dcbeff4c95c5fb8bf25a05c047ba18e25cdaa8405d8a43dfa1fdac1e792c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
