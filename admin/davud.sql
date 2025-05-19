-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 09:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `davud`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL,
  `p_title` text NOT NULL,
  `p_body` longtext NOT NULL,
  `p_cover` varchar(255) NOT NULL,
  `p_status` int(255) NOT NULL DEFAULT 1,
  `p_view_count` int(255) NOT NULL DEFAULT 0,
  `p_createdBy` varchar(255) NOT NULL,
  `p_updatedBy` varchar(255) DEFAULT NULL,
  `p_createdAt` datetime DEFAULT NULL,
  `p_updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`p_id`, `p_title`, `p_body`, `p_cover`, `p_status`, `p_view_count`, `p_createdBy`, `p_updatedBy`, `p_createdAt`, `p_updatedAt`) VALUES
(21, 'Enterprise Azerbaijan və Nevada Universiteti Özmen Sahibkarlıq Mərkəzi arasında Anlaşma Memorandumu imzalanıb', '<p>İqtisadi İslahatların Təhlili və Kommunikasiya Mərkəzinin innovativ layihəsi olan EnterpriseAzerbaijan.com portalı və Nevada&nbsp;Universiteti &Ouml;zmen Sahibkarlıq Mərkəzi arasında Anlaşma Memorandumu imzalanıb.</p>\r\n<p>Anlaşmaya əsasən, Nevada&nbsp;Universiteti &Ouml;zmen Sahibkarlıq Mərkəzi ilə Enterprise Azerbaijan-ın birlikdə &ldquo;StartUp School&rdquo; yaratması, potensial investorların tapılmasına dəstək g&ouml;stərilməsi, akselerasiya mərkəzlərinin təşviqi, Azərbaycandan se&ccedil;ilmiş startapların Nevada&nbsp;Universitetində təcr&uuml;bə ke&ccedil;mələrinə yardım,&nbsp; xarici ekosistemə uyğun gələn b&uuml;t&uuml;n startapların məlumatlandırılması və investisiya imkanlarının araşdırılması, birgə tədbirlərin təşkili, o c&uuml;mlədən, &Ouml;zmen Mərkəzinin ekspertlərinin yerli və beynəlxalq tədbirlər zamanı həm mentor, həm də m&uuml;hazirə&ccedil;i kimi iştirakı və gələcək perspektivdə g&ouml;r&uuml;ləcək bir sıra işlər nəzərdə tutulub.</p>\r\n<p>Daha sonra silsilə tədbirlər &ccedil;ər&ccedil;ivəsində EnterpriseAzerbaijan.com portalının təşkilat&ccedil;ılığı ilə Nevada&nbsp;Universiteti, &ldquo;Barbara Smith Campbell&rdquo;in İqtisadiyyat &uuml;zrə professoru, Beynəlxalq Biznes Proqramları direktoru <strong>Mehmet Serkan Tosun</strong> tərəfindən Enterprise Azerbaijan və digər inkubasiya mərkəzlərinin startap&ccedil;ıları &uuml;&ccedil;&uuml;n &ldquo;Sahibkarlığa dəstək &uuml;&ccedil;&uuml;n startapların inkişaf etdirilməsi&rdquo; m&ouml;vzusunda master-klass ke&ccedil;irilib.</p>\r\n<p>Təlimdə Enterprise Azerbaijan və Sabah.lab Akselerasiya Mərkəzinin&nbsp; m&uuml;xtəlif yerli və beynəlxalq yarışlarda uğur qazanmış startapları təqdim olunub. Eyni zamanda, gənc startap&ccedil;ılar <strong>M.Tosunun </strong>dəyərli fikirlərini dinləmək və &ouml;z startaplarını beynəlxalq səviyyədə tanıtmaq şansı əldə ediblər. <strong>M.Tosun</strong> gənclərə &ouml;z t&ouml;vsiyələrini verib və startapdan sahibkarlığa gedən yolda onların hər birinə uğurlar arzu edib.</p>\r\n<p>&nbsp;</p>', '1552714402a4a77dbd6225906b54907029cc25513.jpg', 1, 0, '23', '40', '2022-07-27 09:02:34', '2022-08-03 09:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `s_sitename` varchar(255) NOT NULL,
  `s_sitetitle` varchar(255) NOT NULL,
  `s_sitedesc` varchar(255) NOT NULL,
  `s_logo_url` varchar(255) NOT NULL,
  `s_updatedAt` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`s_sitename`, `s_sitetitle`, `s_sitedesc`, `s_logo_url`, `s_updatedAt`) VALUES
('a', 'cxbcxbcb', 'xcbxcbxcb', '', '2022-08-17 10:53:29.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(100) NOT NULL DEFAULT 1,
  `phonenumber` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `user_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `status`, `phonenumber`, `birthdate`, `createdAt`, `user_image`) VALUES
(47, 'Davud Nasrullayev', 'davudn2006@gmail.com', '8b3df71ef4323ac59618185c3fa0c63a', 1, '050-543-99-22', '0000-00-00', '2025-05-19 21:24:37', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
