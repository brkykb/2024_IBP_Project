-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 24 May 2024, 20:14:43
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `librarydatabase1`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`) VALUES
(4, 'deneme', 'deneme deneme'),
(5, 'deneme1', 'deneme1 deneme1'),
(6, 'deneme2', 'deneme2 deneme2');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `bookname` varchar(50) NOT NULL,
  `pages` int(10) NOT NULL,
  `author` varchar(50) NOT NULL,
  `bookfile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`id`, `bookname`, `pages`, `author`, `bookfile`) VALUES
(12, 'Algoritmalar ve Programlama', 183, 'Burcu YILMAZEL', 'pdfs/Algoritmalar ve Programlama.pdf'),
(13, 'C Programming in Linux', 80, 'David Haskins', 'pdfs/C Programming in Linux.pdf'),
(15, 'Java ile Nesne Yönelik Programlama', 203, 'Oğuz Aslantürk', 'pdfs/Java ile Nesneye Yönelik Programlama.pdf'),
(16, 'Learning Python', 443, 'Fabrizio Romano', 'pdfs/Learning Python.pdf'),
(17, 'C Sharp Kitabı', 186, 'Memik Yanık', 'pdfs/C Sharp Kitabı.pdf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `senderid` int(11) DEFAULT NULL,
  `receiverid` int(11) DEFAULT NULL,
  `content` varchar(100) DEFAULT NULL,
  `read_status` enum('yes','no') DEFAULT 'no',
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `senderid`, `receiverid`, `content`, `read_status`, `sent_at`) VALUES
(11, 45, 44, '12345', 'yes', '2024-05-23 22:20:01'),
(12, 45, 44, 'deneme1 deneme2 deneme3', 'yes', '2024-05-23 22:20:15'),
(13, 45, 44, 'mesaj mesaj', 'no', '2024-05-23 22:20:45'),
(14, 44, 45, 'deneme4 deneme5 deneme6', 'yes', '2024-05-23 22:21:34'),
(15, 44, 45, 'deneme7 deneme8 deneme9', 'yes', '2024-05-23 22:21:51'),
(16, 44, 46, 'denemedenemedeneme', 'no', '2024-05-23 22:47:21'),
(17, 44, 46, 'deneme1 deneme1', 'no', '2024-05-23 22:47:34'),
(18, 44, 46, 'deneme1 deneme2 deneme3', 'no', '2024-05-23 22:47:37'),
(19, 44, 46, 'deneme4 deneme5 deneme6', 'no', '2024-05-23 22:47:41'),
(20, 44, 45, 'deneme deneme', 'yes', '2024-05-24 16:41:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stdregister`
--

CREATE TABLE `stdregister` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `utype` varchar(50) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `stdregister`
--

INSERT INTO `stdregister` (`id`, `username`, `email`, `password`, `date`, `utype`) VALUES
(44, 'admin', 'admin@gmail.com', '$2y$10$CFPp2OSYs9A1q/FBwXAz/e6CedtuYLXXr/O8HjUVmQWnJ9VNFm2JW', '2024-05-19 11:45:35.546267', 'teacher'),
(45, 'berkay', 'berkay@gmail.com', '$2y$10$IjymRpXRvyym0MTpukMH6.x9UCBU6HV5iJSh2mso.OcPChSlUwRbO', '2024-05-19 19:04:16.531146', 'student'),
(46, 'berkay1', 'berkay1@gmail.com', '$2y$10$VdE2OYZXdQhLQbVc3wWj9u2Rt4/MkwRgnxgeMmTB9aZMZMXky5Rgy', '2024-05-19 19:04:27.900673', 'student'),
(47, 'berkay2', 'berkay2@gmail.com', '$2y$10$nFmKE0JtbM/cjNY5ObZZOO9prKdudhtApCTfe3FrMTNjue6ey.Plm', '2024-05-19 19:04:37.252208', 'student'),
(48, 'berkay3', 'berkay3@gmail.com', '$2y$10$nSyKAAb9JO6ktq.Ap..f7uvWUyrmSrCXeYnsv9AJUyBkax0tv.tMe', '2024-05-19 19:04:48.318163', 'student'),
(49, 'berkay4', 'berkay4@gmail.com', '$2y$10$Wv8DEc/z5U/e2.2btbM8fO9x4I9B9WtBx2YBWRjQbjK8UkScFYrlS', '2024-05-24 01:48:14.239634', 'student'),
(50, 'berkay5', 'berkay5@gmail.com', '$2y$10$MUb2zo3eHR7IRssMxWevp.PR9IK.jh7z1CqjSaxRdnGzDz35neh1S', '2024-05-24 01:48:21.426089', 'student'),
(51, 'berkay6', 'berkay6@gmail.com', '$2y$10$YGnG6vP..ziHqME.hqgVPu1CRygNuknHYjXSJ4tvW89k1jT1nZx8a', '2024-05-24 01:48:27.706637', 'student'),
(52, 'berkay7', 'berkay7@gmail.com', '$2y$10$c.9WG2tUepD.OHKTVd9/c.ibvw6fSCYDeqpubrLU9TZtOXo00uqOa', '2024-05-24 01:48:33.114281', 'student'),
(53, 'berkay8', 'berkay8@gmail.com', '$2y$10$DIJrxLiN.G4LJM9pTh2f.e7yKt3AIE8haILbkGiIdxTYlfZt3AK5a', '2024-05-24 01:48:39.634489', 'student'),
(54, 'berkay9', 'berkay9@gmail.com', '$2y$10$UUYrg7jL7QQKIJAGfjt/o.0L.4wwuoofnpDmUs.n1TFiL1nvHFrrW', '2024-05-24 01:48:45.413426', 'student');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `stdregister`
--
ALTER TABLE `stdregister`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `stdregister`
--
ALTER TABLE `stdregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
