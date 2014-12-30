-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2014 at 06:32 
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `idmore_linux_ecourse`
--
CREATE DATABASE IF NOT EXISTS `idmore_linux_ecourse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `idmore_linux_ecourse`;

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE IF NOT EXISTS `badge` (
  `id_badge` int(11) NOT NULL AUTO_INCREMENT,
  `id_materi` int(11) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `id_course` int(11) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `logo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_badge`),
  KEY `id_course` (`id_course`),
  KEY `id_materi` (`id_materi`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id_badge`, `id_materi`, `id_level`, `id_course`, `title`, `description`, `logo`) VALUES
(1, 1, 1, 1, 'Starting Course', 'congratulations you have embarked on a course here', '');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(20) NOT NULL,
  `flag` varchar(20) NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `estimate` varchar(20) NOT NULL,
  `course_case_en` text NOT NULL,
  `course_case_id` text NOT NULL,
  `hint_en` text NOT NULL,
  `hint_id` text NOT NULL,
  `command` text NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`id_course`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `id_level`, `step`, `title`, `description`, `estimate`, `course_case_en`, `course_case_id`, `hint_en`, `hint_id`, `command`, `result`) VALUES
(1, 1, 1, 'Hello Student', 'Hello Student', '1', 'lest begin to learn about Linux', '0', '', '', 'y', ''),
(2, 1, 2, 'Linux History', 'Knowing Linux History', '5', 'Linux created by Linus Torvald', '<h5>Linux History</h5>\nLinux adalah nama yang diberikan kepada sistem operasi komputer bertipe Unix. Linux merupakan salah satu contoh hasil pengembangan perangkat lunak bebas dan sumber terbuka utama. Seperti perangkat lunak bebas dan sumber terbuka lainnya pada umumnya, kode sumber Linux dapat dimodifikasi, digunakan dan didistribusikan kembali secara bebas oleh siapa saja.\n<br/><br/>\nNama "Linux" berasal dari nama pembuatnya, yang diperkenalkan tahun 1991 oleh Linus Torvalds. Sistemnya, peralatan sistem dan pustakanya umumnya berasal dari sistem operasi GNU, yang diumumkan tahun 1983 oleh Richard Stallman. Kontribusi GNU adalah dasar dari munculnya nama alternatif GNU/Linux.\n<br/><br/>\n<h5>GNU Project</h5>\nProyek GNU yang mulai pada 1984 memiliki tujuan untuk membuat sebuah sistem operasi yang kompatibel dengan Unix dan lengkap dan secara total terdiri atas perangkat lunak bebas.Tahun 1985, Richard Stallman mendirikan Yayasan Perangkat Lunak Bebas dan mengembangkan Lisensi Publik Umum GNU (GNU General Public License atau GNU GPL). Kebanyakan program yang dibutuhkan oleh sebuah sistem operasi (seperti pustaka, kompiler, penyunting teks, shell Unix dan sistem jendela) diselesaikan pada awal tahun 1990-an, walaupun elemen-elemen tingkat rendah seperti device driver, jurik dan kernel masih belum selesai pada saat itu.Linus Torvalds pernah berkata bahwa jika kernel GNU sudah tersedia pada saat itu (1991), dia tidak akan memutuskan untuk menulis versinya sendiri.\n<br/><br/>\nLinux telah lama dikenal untuk penggunaannya di server, dan didukung oleh perusahaan-perusahaan komputer ternama seperti Intel, Dell, Hewlett-Packard, IBM, Novell, Oracle Corporation, Red Hat, dan Sun Microsystems. Linux digunakan sebagai sistem operasi di berbagai macam jenis perangkat keras komputer, termasuk komputer desktop, superkomputer, dan sistem benam seperti pembaca buku elektronik, sistem permainan video (PlayStation 2, PlayStation 3 dan XBox), telepon genggam dan router. Para pengamat teknologi informatika beranggapan kesuksesan Linux dikarenakan Linux tidak bergantung kepada vendor (vendor independence), biaya operasional yang rendah, dan kompatibilitas yang tinggi dibandingkan versi UNIX tak bebas, serta faktor keamanan dan kestabilannya yang tinggi dibandingkan dengan sistem operasi lainnya seperti Microsoft Windows. Ciri-ciri ini juga menjadi bukti atas keunggulan model pengembangan perangkat lunak sumber terbuka (opensource software).\n<br/><br/>\nSistem operasi Linux yang dikenal dengan istilah distribusi Linux (Linux distribution) atau distro Linux umumnya sudah termasuk perangkat-perangkat lunak pendukung seperti server web, bahasa pemrograman, basisdata, tampilan desktop (desktop environment) seperti GNOME,KDE dan Xfce juga memiliki paket aplikasi perkantoran (office suite) seperti OpenOffice.org, KOffice, Abiword, Gnumeric dan LibreOffice.<br/><br/>\n<h5>Hak Cipta dan Merek Dagang</h5>\nLinux kernel dan sebagian besar perangkat lunak GNU menggunakan GNU General Public License (GPL) sebagai basis lisensinya. GPL mengharuskan siapapun yang mendistribusikan kernel linux harus membuat kode sumber (dan semua modifikasi atas itu) tersedia bagi pengguna dengan kriteria yang sama. Tahun 1997, Linus Torvald menyatakan, “Menjadikan Linux berbasis GPL sungguh merupakan hal terbaik yang pernah saya lakukan.”\n<br/><br/>\nUntuk percobaan pertama silahkan tekan command <code>y</code> kemudian <code>enter</code>, dan klik tombol "check" untuk melanjutkan', '', 'masukan command <code>y</code> dan eksekusi <code>enter</code>, kemudian cek hasilnya', 'y', ''),
(3, 1, 3, 'Open Source Movement', 'Open Source Movement', '5', 'Open Source Movement', '0', '', '', '', ''),
(4, 1, 4, 'Kernel Module,library, applications', 'Kernel Module,library, applications\r\n', '5', 'Kernel Module,library, applications', '0', '', '', '', ''),
(5, 1, 5, 'Distributions', 'Knowing Linux Distributions', '5', 'Knowing Linux Distributions', '0', '', '', '', ''),
(6, 1, 6, 'Multiuser', 'Multiuser on Linux', '5', 'Multiuser is', '0', '', '', '', ''),
(7, 1, 7, 'Multitasking', 'Multitasking on Linux', '5', 'Multitasking is...', '0', '', '', '', ''),
(8, 2, 8, 'Knowing Open Source', 'Knowing Open Source', '5', 'Knowing Open Source', '0', '', '', 'y', ''),
(9, 3, 1, 'command line', 'Know Linux command line', '30', '', '0', '', '', '', ''),
(10, 3, 2, 'Working directories and hierarchal relationships', 'Structure and explanation directory in Linux', '30', '', '0', '', '', '', ''),
(11, 4, 1, 'File types', 'File types supporting on Linux', '10', '', '0', '', '', '', ''),
(12, 5, 1, 'Structure', 'Structure\r\n', '40', '', '0', '', '', '', ''),
(13, 6, 1, 'Boot Process Management', 'Boot Process Management', '30', '', '', '', '', '', ''),
(14, 7, 1, 'System Administration', 'System Administration', '30', '', '', '', '', '', ''),
(15, 8, 1, 'Storage Management', 'Storage Management', '30', '', '', '', '', '', ''),
(16, 9, 1, 'Shell scripting', 'Shell scripting', '', '', '', '', '', '', ''),
(17, 10, 1, 'Scheduling', 'Scheduling', '30', '', '', '', '', '', ''),
(18, 11, 1, 'Software Instalation', 'Software Instalation', '30', '', '', '', '', '', ''),
(19, 10, 2, 'Step 2', 'Step 2', '25', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `id_materi` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(3000) NOT NULL,
  PRIMARY KEY (`id_level`),
  KEY `id_materi` (`id_materi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `id_materi`, `level`, `title`, `description`) VALUES
(1, 1, 1, 'Knowing Linux', 'introduction to the history of Linux, components and excess'),
(2, 1, 2, 'Open Source', 'Knowing Open Source'),
(3, 2, 1, 'Shell', 'Working with Linux shell'),
(4, 2, 2, 'File And Directory Management', 'manajemen file dan direktori di Linux'),
(5, 2, 3, 'Process Management', 'Manage process on linux'),
(6, 2, 4, 'Boot Processes Management', 'Boot Processes Management'),
(7, 2, 5, 'System Administration', 'System Administration'),
(8, 2, 6, 'Storage Management', 'Storage Management'),
(9, 2, 7, 'Shell scripting', 'Shell scripting'),
(10, 2, 8, 'Scheduling', 'Scheduling'),
(11, 2, 9, 'Software Instalation', 'Software Instalation');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  PRIMARY KEY (`id_materi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `title`, `description`) VALUES
(1, 'Introduce Linux', 'introduction to the history of Linux, components and excess'),
(2, 'Linux Shell and Command', 'learn linux from the basic commands to shell scripting'),
(3, 'Networking', 'Learn Linux networking configuration');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `postdate` datetime NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_news`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `id_user`, `title`, `content`, `postdate`, `updatedate`) VALUES
(1, 2, 'About', 'About e-course', '2014-12-14 20:35:10', '2014-12-14 14:14:00'),
(2, 2, 'Help', 'help content', '2014-12-14 20:35:20', '2014-12-15 02:30:06'),
(3, 2, 'Terms And Conditions', 'This is terms and conditions before starting new course materi', '2014-12-14 20:35:32', '2014-12-22 11:31:38'),
(4, 2, 'contoh', 'contoh', '2014-12-14 20:35:32', '2014-12-14 13:35:32'),
(5, 2, 'contoh 4', 'contoh', '2014-12-14 20:35:32', '2014-12-14 13:40:16'),
(6, 2, 'contoh', 'contoh', '2014-12-14 20:35:32', '2014-12-14 13:35:32'),
(7, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(8, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(9, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(10, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(11, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(12, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(13, 2, 'contoh', 'contoh', '2014-12-14 20:35:46', '2014-12-14 13:35:46'),
(14, 2, 'contoh', 'contoh', '2014-12-14 20:35:47', '2014-12-14 13:35:47'),
(15, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(16, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(17, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(18, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(19, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(20, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(21, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(22, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(23, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(24, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(25, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49'),
(26, 2, 'contoh', 'contoh', '2014-12-14 20:35:49', '2014-12-14 13:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `id_country` int(11) DEFAULT NULL,
  `register_date` datetime NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` text NOT NULL,
  `level` enum('admin','student') NOT NULL,
  `status` enum('waiting','active','banned') NOT NULL,
  `pp` text NOT NULL,
  `about` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id_country` (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `fullname`, `id_country`, `register_date`, `last_login`, `password`, `level`, `status`, `pp`, `about`) VALUES
(2, 'yussan', 'yusuf@kompetisi.id', 'Yusuf Akhsan Hidayat', NULL, '2014-11-26 00:00:00', '2014-12-22 20:01:22', 'be71a8e61b64f613366380071fae3b38', 'admin', 'active', '', 'happy command'),
(5, 'mudaw', 'mudaw.qulub@gmail.co', 'Mudawil Qulub', NULL, '2014-12-18 00:00:00', '2014-12-22 20:01:22', 'be71a8e61b64f613366380071fae3b38', 'admin', 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_badge`
--

CREATE TABLE IF NOT EXISTS `user_badge` (
  `id_user_badge` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `id_badge` int(11) NOT NULL,
  `getdate` datetime NOT NULL,
  PRIMARY KEY (`id_user_badge`),
  KEY `id_user` (`id_user`,`id_badge`),
  KEY `id_badge` (`id_badge`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE IF NOT EXISTS `user_course` (
  `id_user_course` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_course` int(11) DEFAULT NULL,
  `startdate` datetime NOT NULL,
  `lastdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('incompleted','completed') NOT NULL,
  PRIMARY KEY (`id_user_course`),
  KEY `id_user` (`id_user`),
  KEY `id_course` (`id_course`),
  KEY `id_materi` (`id_materi`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id_user_course`, `id_user`, `id_materi`, `id_level`, `id_course`, `startdate`, `lastdate`, `status`) VALUES
(2, 2, 1, 1, 1, '2014-12-13 03:57:44', '2014-12-19 01:27:42', 'incompleted'),
(3, 5, 1, 1, 1, '2014-12-17 03:17:25', '2014-12-19 01:27:51', 'incompleted'),
(8, 2, 2, 10, 17, '2014-12-22 02:37:18', '2014-12-22 15:27:18', 'incompleted');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badge`
--
ALTER TABLE `badge`
  ADD CONSTRAINT `badge_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `badge_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `badge_ibfk_3` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id_country`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `user_badge_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_badge_ibfk_2` FOREIGN KEY (`id_badge`) REFERENCES `badge` (`id_badge`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `user_course_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_ibfk_3` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_ibfk_4` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
