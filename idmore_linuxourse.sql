-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2015 at 06:20 
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `idmore_linuxourse`
--
CREATE DATABASE IF NOT EXISTS `idmore_linuxourse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `idmore_linuxourse`;

-- --------------------------------------------------------

--
-- Table structure for table `available_dir`
--

CREATE TABLE IF NOT EXISTS `available_dir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `directory` (`directory`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `available_dir`
--

INSERT INTO `available_dir` (`id`, `directory`) VALUES
(1, '/'),
(3, '/etc'),
(2, '/home'),
(7, '/home/user'),
(9, '/home/user/.config'),
(8, '/home/user/mydirectory'),
(6, '/media'),
(4, '/usr'),
(5, '/var');

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
  `custom_controller` varchar(20) NOT NULL,
  `status` enum('posted','draft') NOT NULL,
  `editdate` datetime NOT NULL,
  PRIMARY KEY (`id_course`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `id_level`, `step`, `title`, `description`, `estimate`, `course_case_en`, `course_case_id`, `hint_en`, `hint_id`, `command`, `custom_controller`, `status`, `editdate`) VALUES
(1, 1, 1, 'Hello Student', 'Hello Student', '1', 'lest begin to learn about Linux', 'Mari mulai belajar linux', '', '', 'y', '', 'posted', '0000-00-00 00:00:00'),
(2, 1, 2, 'Linux History', 'Knowing Linux History', '5', 'Linux created by Linus Torvald', '[h5]Linux History[/h5]\nLinux adalah nama yang diberikan kepada sistem operasi komputer bertipe Unix. Linux merupakan salah satu contoh hasil pengembangan perangkat lunak bebas dan sumber terbuka utama. Seperti perangkat lunak bebas dan sumber terbuka lainnya pada umumnya, kode sumber Linux dapat dimodifikasi, digunakan dan didistribusikan kembali secara bebas oleh siapa saja.\n\nNama "Linux" berasal dari nama pembuatnya, yang diperkenalkan tahun 1991 oleh Linus Torvalds. Sistemnya, peralatan sistem dan pustakanya umumnya berasal dari sistem operasi GNU, yang diumumkan tahun 1983 oleh Richard Stallman. Kontribusi GNU adalah dasar dari munculnya nama alternatif GNU/Linux.\n\n[h5]GNU Project[/h5]\nProyek GNU yang mulai pada 1984 memiliki tujuan untuk membuat sebuah sistem operasi yang kompatibel dengan Unix dan lengkap dan secara total terdiri atas perangkat lunak bebas.Tahun 1985, Richard Stallman mendirikan Yayasan Perangkat Lunak Bebas dan mengembangkan Lisensi Publik Umum GNU (GNU General Public License atau GNU GPL). Kebanyakan program yang dibutuhkan oleh sebuah sistem operasi (seperti pustaka, kompiler, penyunting teks, shell Unix dan sistem jendela) diselesaikan pada awal tahun 1990-an, walaupun elemen-elemen tingkat rendah seperti device driver, jurik dan kernel masih belum selesai pada saat itu.Linus Torvalds pernah berkata bahwa jika kernel GNU sudah tersedia pada saat itu (1991), dia tidak akan memutuskan untuk menulis versinya sendiri.\n\nLinux telah lama dikenal untuk penggunaannya di server, dan didukung oleh perusahaan-perusahaan komputer ternama seperti Intel, Dell, Hewlett-Packard, IBM, Novell, Oracle Corporation, Red Hat, dan Sun Microsystems. Linux digunakan sebagai sistem operasi di berbagai macam jenis perangkat keras komputer, termasuk komputer desktop, superkomputer, dan sistem benam seperti pembaca buku elektronik, sistem permainan video (PlayStation 2, PlayStation 3 dan XBox), telepon genggam dan router. Para pengamat teknologi informatika beranggapan kesuksesan Linux dikarenakan Linux tidak bergantung kepada vendor (vendor independence), biaya operasional yang rendah, dan kompatibilitas yang tinggi dibandingkan versi UNIX tak bebas, serta faktor keamanan dan kestabilannya yang tinggi dibandingkan dengan sistem operasi lainnya seperti Microsoft Windows. Ciri-ciri ini juga menjadi bukti atas keunggulan model pengembangan perangkat lunak sumber terbuka (opensource software).\n\nSistem operasi Linux yang dikenal dengan istilah distribusi Linux (Linux distribution) atau distro Linux umumnya sudah termasuk perangkat-perangkat lunak pendukung seperti server web, bahasa pemrograman, basisdata, tampilan desktop (desktop environment) seperti GNOME,KDE dan Xfce juga memiliki paket aplikasi perkantoran (office suite) seperti OpenOffice.org, KOffice, Abiword, Gnumeric dan LibreOffice\n\n[h5]Hak Cipta dan Merek Dagang[/h5]\nLinux kernel dan sebagian besar perangkat lunak GNU menggunakan GNU General Public License (GPL) sebagai basis lisensinya. GPL mengharuskan siapapun yang mendistribusikan kernel linux harus membuat kode sumber (dan semua modifikasi atas itu) tersedia bagi pengguna dengan kriteria yang sama. Tahun 1997, Linus Torvald menyatakan, "Menjadikan Linux berbasis GPL sungguh merupakan hal terbaik yang pernah saya lakukan."\n\n[span class="instructions"][h5]Instruction[/h5]\nUntuk percobaan pertama silahkan tekan command [code]y[/code] kemudian [code]enter[/code], dan klik tombol "check" untuk melanjutkan\n[/span]\n', '', 'masukan command [code]y[/code] dan eksekusi [code]enter[/code], kemudian cek hasilnya', 'y', '', 'posted', '0000-00-00 00:00:00'),
(3, 1, 3, 'Open Source Movement', 'Open Source Movement', '5', 'Open Source Movement', '[h5]Open Source / Sumber Terbuka[/h5]\nadalah sistem pengembangan yang tidak dikoordinasi oleh suatu individu / lembaga pusat, tetapi oleh para pelaku yang bekerja sama dengan memanfaatkan kode sumber (source-code) yang tersebar dan tersedia bebas (biasanya menggunakan fasilitas komunikasi internet). Pola pengembangan ini mengambil model ala bazaar, sehingga pola Open Source ini memiliki ciri bagi komunitasnya yaitu adanya dorongan yang bersumber dari budaya memberi, yang artinya ketika suatu komunitas menggunakan sebuah program Open Source dan telah menerima sebuah manfaat kemudian akan termotivasi untuk menimbulkan sebuah pertanyaan apa yang bisa pengguna berikan balik kepada orang banyak.\n\nPola Open Source lahir karena kebebasan berkarya, tanpa intervensi berpikir dan mengungkapkan apa yang diinginkan dengan menggunakan pengetahuan dan produk yang cocok. Kebebasan menjadi pertimbangan utama ketika dilepas ke publik. Komunitas yang lain mendapat kebebasan untuk belajar, mengutak-ngatik, merevisi ulang, membenarkan ataupun bahkan menyalahkan, tetapi kebebasan ini juga datang bersama dengan tanggung jawab, bukan bebas tanpa tanggung jawab.\n\nMelalui open source, perkembangan software akan sangat cepat, karena dikerjakan oleh banyak orang secara sukarela.Melalui open source masalah dan solusi akan dipecahkan dan dicari bersama.\n\nSebagai contoh open source adalah : Linux, sebuah kernel yang dari pertama kali dibuat sampai sekarang masih populer keberadaannya.\n\nDan lihat juga Android dari Google, merupakan salah satu produk open source yang palinng populer saat ini\n\n[i]wikipedia[/i]\n\n[span class="instructions"][h5]Instruction[/h5]\nuntuk melanjutkan eksekusi command [code]y[/code] \n[/span]', '', 'preses [code]y[/code] lalu klik [code]enter[/code]', 'y', '', 'posted', '0000-00-00 00:00:00'),
(4, 1, 4, 'Kernel Module,library, applications', 'Kernel Module,library, applications\r\n', '5', 'Kernel Module,library, applications', '[h5]Kernel[/h5]\nSistem operasi Linux bisa berjalan karena adanya fondasi yang disebut kernel Linux. Kernel adalah software yang bekerja di low level (tingkat dasar) untuk berinteraksi dengan berbagai hardware di komputer. Jadi, jika Anda sedang berselancar (browsing) lewat Firefox, kernel lah yang mengatur penerimaan dan pengiriman data Anda lewat kartu jaringan atau Wi-Fi komputer. Begitu juga jika Anda memasukkan USB stick atau USB flash drive (UFD) ke port USB, kernel bertugas mendeteksi adanya disk ini dan menyiapkannya agar siap diakses pengguna.\n\nDalam Linux, kernel bisa anda temui di directory [code]/boot[/code] dengan nama file [code]vmlinuz[/code] disertai dengan angka yang menjelaskan versi tertentu.\n\n[h5]Modul[/h5]\n\n\n[h5]Library[/h5]\n\n[h5]Aplikasi[/h5]\n\n[span class="instructions"][h5]Instruction[/h5]\n[strong]1 [/strong] Silahkan lihat versi kernel yang anda gunakan sekarang dengan perintah [code]ls /boot[/code]\n\n[strong]2 [/strong] Silahkan lihat versi kernel yang anda gunakan sekarang dengan perintah [code]ls /boot[/code]\n[/span]', '', 'try this command', '', '', 'posted', '0000-00-00 00:00:00'),
(5, 1, 5, 'Distributions', 'Knowing Linux Distributions', '5', 'Knowing Linux Distributions', '0', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(6, 1, 6, 'Multiuser', 'Multiuser on Linux', '5', 'Multiuser is', '0', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(7, 1, 7, 'Multitasking', 'Multitasking on Linux', '5', 'Multitasking is...', '0', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(8, 2, 8, 'Knowing Open Source', 'Knowing Open Source', '5', 'Knowing Open Source', '0', '', '', 'y', '', 'posted', '0000-00-00 00:00:00'),
(9, 3, 2, 'command line', 'Know Linux command line', '30', '', 'Setiap pemakai Linux harus mmpunyai nama login (user account) yang sebelumnya harus didaftarkan pada administrator sistem. Nama login umumnya dibatasi maksimum 8 karakter dan umumnya dalam huruf kecil. Prompt shell bash pada Linux menggunakan tanda [pre]$[/pre].\r\n\r\nSebuah sesi Linux terdiri dari :\r\n1. Login\r\n2. Bekerja dengan Shell / menjalankan aplikasi\r\n3. Logout\r\n\r\n[h5]Format Instruksi Linux[/h5]\r\nInstruksi Linux standar umumnya mempunyai format sebagai berikut :\r\n$<command> <pilihan> <argument>\r\npilihan/options dimulai dengan tanda - (minus), argument dapat kosong, atau diisi satu atau beberapa argumen (parameter).\r\ncontoh :\r\n[code]ls[/code] : tanpa argumen\r\n[code]ls -a[/code] : option adalah [pre]-a[/pre] = all, tanpa argumen\r\n[code]ls /bin[/code] : tanpa option, menggunakan argumen [pre]/etc[/pre]\r\n[code]ls -l /usr[/code] : menggunakan option [pre]-l[/pre] , dan argumen [pre]/usr[/pre]\r\n\r\n[h5]Manual[/h5]\r\nlinux halaman manual yang berisi penjelasan dan cara penggunaan dari command yang ada, melalui halaman manual tersebut juga bisa diketahui option dan atribut apa saja yang di dukung oleh command tersebut.\r\n\r\n[span class="instructions"][h5]Instructions[/h5]\r\neksekusi command [code]y[/code] untuk melanjutkan\r\n[/span]', '', 'eksekusi command [code]y[/code] dan cek', 'y', '', 'posted', '0000-00-00 00:00:00'),
(10, 3, 3, 'Working directories and hierarchal relationships', 'Structure and explanation directory in Linux', '30', '', '[h5]Direktori[/h5]\nDirectori adalah suatu file yang berisi daftar-daftar nama file dan direktori lainnya, sehingga seolah-oleh direktori terlihat sebagai penampung file.\n\nDirektori disusun secara hierarkis, sebagai contoh : direktori A berada didalam direktori B sehingga secara hirarkis direktori B dipanggil sebagai [strong]parent[/strong] dan A sebagai [strong]child[/strong]. Sedangkan suatu direktori yang tidak memiliki [strong]parent[/strong] dinamakan [strong]root[/strong] atau dituliskan [code]/[/code]. Pada directory juga dikenal istilah [strong]active[/strong] yang berarti direktori dimana saat ini anda berada, untuk cek direktori active bisa menggunakan perintah [code]pwd[/code].\n\n[h5]Struktur direktori Linux[/h5]\nBerikut adalah struktur utama direktori di linux yang bisa dicek dengan command [code]ls /[/code].\n[pre]\n- /\n--/usr\n--/var\n--/bin\n--/home\n--/root\n--/tmp\n--/dev\n--/etc\n[/pre]\n\nberikut adalah penjelasan dari beberapa direktori penting di Linux \n[strong]/[/strong] adalah direktori root, direktori paling dasar yang berisi seluruh direktori lainnya.\n[strong]/home[/strong] berisi directory home untuk user, tempat menyimpan berbagai data aygn bersifat personal.\n[strong]/bin[/strong] merupakan singkatan dari binary. Direktori ini berisi sejumlah aplikasi/program dasar Linux.\n[strong]/usr[/strong] berisi sejumlah directori yang berisi program yang digunakan oleh user, berupa hal-hal berikut :\ndocs : dokumentasi perihal informasi tentang Linux.\nman : dokumen yang digunakan program man, berisi manual dari suatu perintah.\ngame : berisi beberapa games.\n[strong]usr/bin[/strong] berisi banyak program-program yang digunakan oleh user.\n[strong]usr/sbin[/strong] berisi banyak program-program yang digunakan oleh super user.\n[strong]/sbin[/strong] berisi file sistem yang dijalankan seara otomatis oleh Linux.\n[strong]/var[/strong] atau singkatandari variabel, berisi beragam temporary data seperti spool untuk menampung file yang akan dicetak, uucp untuk menampung fule yang akan disalin dari mesin Linux lain.\n[code]/dev[/code] berisi file yang digunakan untuk berhubungan dengan piranti output seperti : CD-ROM,floppy-disk, hard-disk dan lain-lain. \n[code]/etc[/code] berisi banyak file konfigurasi. File ini beruppa teks dan dapat diubah untuk mengubah konfigursi sistem.\n\n[h5]Aturan Penamaan direktori[/h5]\nAturan penamaan direktori sama dengan aturan penamaan file, diperbolehkan menggunakan tanda ''-'' ataupun ''_'' sebagai nama. Terus bagaimana untuk membedakan itu adalah file atau folder. Silahkan lihat isi direktori aktif anda sekarang ini dengan perintah [code]ls[/code], maka akan menampilkan isi dari direktori tersebut, ada dua macam input, untuk nama yang diakhiri notasi ''/'' berarti itu adalah direktori, sedangkan lainnya adalah file.\n\nDisamping itu pada Linux terdapat dua buah penamaan yang istimewa, yaitu direktori dot ''.'' dan double ''..'', direktori dot merupakan merupakan lokasi anda sekarang ini. sedangkah double dot digunakan untuk perbindah ke direktori parent dorektorinya.\n\n[h5]Berpindah Direktori[/h5]\ncommand utama yang digunakan adalah [code]cd[/code] untuk lihat detail dari perintah [code]cd[/code] gunakan command [code]man cd[/code]. Penulisannya adalah [code]cd [directory location][/code].\n\n[span class="instructions"][h5]Instructions[/h5]\n[strong]1 [/strong] tampilkan lokasi active directory\n[strong]2 [/strong] tampilkan struktur dari directory root\n[strong]3 [/strong] dari lokasi active directory, pindahkan ke parent directorynya. \n[/span]', '', 'menampilkan active directory [code]pwd[/code]\r\nroot directory di Linux dibaca "/" untuk menampilkan isi dari root directory menggunakan [code]ls /[/code]\r\nberpindah ke directory sebelumnya menggunakan [code]cd ..[/code]', 'pwd:ls /:cd ..', '', 'posted', '0000-00-00 00:00:00'),
(11, 4, 5, 'Environment', 'Linux Environtment', '10', '', '0', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(12, 5, 6, 'Structure', 'Process Structure', '40', '', '0', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(13, 6, 7, 'Boot Process Management', 'Boot Process Management', '30', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(14, 7, 8, 'System Administration', 'System Administration', '30', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(15, 8, 9, 'Storage Management', 'Storage Management', '30', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(16, 9, 10, 'Shell scripting', 'Shell scripting', '', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(17, 10, 11, 'Scheduling', 'Scheduling', '30', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(18, 11, 13, 'Software Instalation', 'Software Instalation', '30', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(19, 10, 12, 'Step 2', 'Step 2', '25', '', '', '', '', '', '', 'posted', '0000-00-00 00:00:00'),
(20, 3, 4, 'Path Absolut dan Relatif', 'Knowing diference active directory and other directories', '5', '', 'Ingatkah anda tentang active directory. saat ini lokasi anda ada di [code]/home/user[/code], memiliki satu buah child directory yang bernama [code]mydirectory[/code]. untuk berpindah ke directory [code]mydirectory[/code] cukup dengan [code]cd mydirectory[/code].\r\n\r\nHal tersebut berbeda jika anda berpindah ke direktori yang bukan merupakan child directory. Sebagai contoh, saat ini posisi anda ada di directory [code]/home/user[/code], untuk berpindah ke direktori yang berada di luar dari child directory atau tempat lainnya [code]/home[/code], maka commandnya adalah sebagai berikut [code]cd /directory/directory[/code], dari root dilanjutkan ke child directory berikutnya.\r\n\r\n[span style="display:none" class="instructions"][h5 style="display:none"]Instructions[/h5][/span]\r\n\r\n[span class="instructions"][h5]Instructions[/h5]\r\ntampilkan semua child dari active directory saat ini.\r\npindah ke directory [code]mydirectory[/code], kemudian tampilkan active directory saat ini.\r\nSekarang pindahkan lokasi anda saat ini ke directory yang berada di [code] /etc [/code] kemudian tampilkan active directorinya\r\n[/span]\r\n', '', 'untuk berpindah ke dalam child directory [code]cd mydirectory[/code]\r\nuntuk berpindah ke directory lain di luar child gunakan command [code]cd /etc[/code]\r\nUntuk mengtahui lokasi active directory gunakan [code]pwd[/code]', 'cd mydirectory:pwd:cd /etc:pwd', '', 'posted', '0000-00-00 00:00:00'),
(21, 3, 1, 'Welcome To Materi', 'Welcome To Materi', '', 'About Materi', 'Tentang Materi\r\n[span class="instructions"][h5]Instructions[/h5]\r\nexecute command [code]to start next step[/code]\r\n[/span]', '', '', 'y', '', 'posted', '0000-00-00 00:00:00'),
(22, 6, 14, 'Repository', 'bla bla bla', '20', 'case en', 'case id', 'hint en', 'hint id', 'ps:int:', '', 'posted', '2015-01-28 05:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE IF NOT EXISTS `discussion` (
  `id_discuss` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `postdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `type` enum('ask','thread') NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id_discuss`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`id_discuss`, `title`, `content`, `postdate`, `updatedate`, `id_user`, `type`, `views`) VALUES
(1, 'Change Directory then Execute Files', 'i''m confused on materi : Linux Shell, level 2\nchange to directory then execute file.\nso this my case :\nrecent directory [code]/home/user[/code]\nfile location\n[code]/home/user/programs/myprogram.sh[/code]', '2014-12-25 00:00:00', '2015-01-02 04:10:35', 2, 'ask', 23),
(2, 'create multiple file in one folder', 'any body can help me\r\ncreate multiple file in one folder', '2014-12-25 21:41:05', '2014-12-25 21:41:05', 5, 'ask', 2),
(7, 'How to make Linux to TV', 'sdfsdfsd', '2014-12-30 03:24:51', '2014-12-30 03:24:51', 2, 'thread', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discussion_comment`
--

CREATE TABLE IF NOT EXISTS `discussion_comment` (
  `id_comment` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_discussion` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `commentdate` datetime NOT NULL,
  `updatedate` datetime NOT NULL,
  `comment` varchar(500) NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_discussion` (`id_discussion`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `discussion_comment`
--

INSERT INTO `discussion_comment` (`id_comment`, `id_discussion`, `id_user`, `commentdate`, `updatedate`, `comment`) VALUES
(3, 2, 2, '2014-12-28 05:49:39', '2015-01-02 05:10:00', 'its secret haha, sorry');

-- --------------------------------------------------------

--
-- Table structure for table `discussion_comment_action`
--

CREATE TABLE IF NOT EXISTS `discussion_comment_action` (
  `id_comment` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `give` enum('up','down') NOT NULL,
  KEY `id_comment` (`id_comment`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `ls_dir`
--

CREATE TABLE IF NOT EXISTS `ls_dir` (
  `id_ls_dir` int(11) NOT NULL AUTO_INCREMENT,
  `id_available_dir` int(11) NOT NULL,
  `type` enum('-','s') NOT NULL,
  `name` varchar(50) NOT NULL,
  `attributes` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id_ls_dir`),
  KEY `id_available_dir` (`id_available_dir`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ls_dir`
--

INSERT INTO `ls_dir` (`id_ls_dir`, `id_available_dir`, `type`, `name`, `attributes`, `content`) VALUES
(1, 7, '-', 'myfile', 'rwx--x--x:0|user|user|7000|1Jan2015|24:00', 'this is text inside myfile'),
(3, 7, '-', '.hiddenname', 'rwx--x--x:0|user|user|7000|1Jan2015|24:00', 'this is hidden file');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(300) NOT NULL,
  `status` enum('published','unpublish') NOT NULL,
  `adddate` datetime NOT NULL,
  PRIMARY KEY (`id_materi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `title`, `description`, `status`, `adddate`) VALUES
(1, 'Introduce Linux', 'introduction to the history of Linux, components and excess', 'published', '2014-12-31 05:00:00'),
(2, 'Linux Shell and Command', 'learn linux from the basic commands to shell scripting', 'published', '2015-01-01 03:15:47'),
(3, 'Linux Networking', 'Learn Linux networking configuration', 'published', '2015-01-09 04:26:35');

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
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id_country` (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `fullname`, `id_country`, `register_date`, `last_login`, `password`, `level`, `status`, `pp`, `about`, `verified`) VALUES
(2, 'yussan', 'yusuf@kompetisi.id', 'Yusuf Akhsan Hidayat', NULL, '2014-11-26 00:00:00', '2015-01-18 03:29:27', 'be71a8e61b64f613366380071fae3b38', 'admin', 'active', 'yussan.png', 'happy command', 1),
(5, 'mudaw', 'mudaw.qulub@gmail.co', 'Mudawil Qulub', NULL, '2014-12-18 00:00:00', '2015-01-18 03:29:27', 'be71a8e61b64f613366380071fae3b38', 'admin', 'active', '', '', 1),
(6, 'lisa', 'lisa@japan.jp', 'Risa Oribe', NULL, '2015-01-14 11:36:02', '2015-01-18 03:29:27', 'be71a8e61b64f613366380071fae3b38', 'admin', 'active', 'lisa.jpg', 'prety linuxer', 1);

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
  `status` enum('incomplete','completed') NOT NULL,
  PRIMARY KEY (`id_user_course`),
  KEY `id_user` (`id_user`),
  KEY `id_course` (`id_course`),
  KEY `id_materi` (`id_materi`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id_user_course`, `id_user`, `id_materi`, `id_level`, `id_course`, `startdate`, `lastdate`, `status`) VALUES
(2, 2, 1, 1, 3, '2014-12-13 03:57:44', '2015-01-21 15:19:49', 'incomplete'),
(3, 5, 1, 1, 2, '2014-12-17 03:17:25', '2015-01-21 15:19:56', 'incomplete'),
(8, 2, 2, 3, 20, '2014-12-22 02:37:18', '2015-01-21 15:20:03', 'incomplete'),
(9, 5, 2, 3, 9, '2015-01-14 11:32:52', '2015-01-21 15:20:11', 'incomplete'),
(10, 6, 1, 1, 1, '2015-01-14 11:36:13', '2015-01-21 15:20:17', 'incomplete');

-- --------------------------------------------------------

--
-- Table structure for table `user_manage`
--

CREATE TABLE IF NOT EXISTS `user_manage` (
  `id_user_manage` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `pp` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('admin','moderator') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `registerdate` datetime NOT NULL,
  `loginlog` text NOT NULL,
  PRIMARY KEY (`id_user_manage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_manage`
--

INSERT INTO `user_manage` (`id_user_manage`, `username`, `password`, `fullname`, `pp`, `email`, `level`, `status`, `registerdate`, `loginlog`) VALUES
(1, 'yussan', 'be71a8e61b64f613366380071fae3b38', 'Yusuf A.H', '', 'yusuf.hi@students.amikom.ac.id', 'admin', 'active', '2015-01-19 22:45:04', '|2015-01-19 04:46:54|2015-01-20 02:55:20|2015-01-20 05:45:03|2015-01-20 04:06:11|2015-01-21 02:21:50|2015-01-21 08:19:03|2015-01-21 10:59:23|2015-01-22 04:32:22|2015-01-22 05:16:37|2015-01-22 12:47:39|2015-01-23 02:48:04|2015-01-24 02:54:49|2015-01-24 05:14:21|2015-01-26 02:49:46|2015-01-27 10:47:54|2015-01-27 12:58:40|2015-01-28 01:27:12');

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
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussion_comment`
--
ALTER TABLE `discussion_comment`
  ADD CONSTRAINT `discussion_comment_ibfk_1` FOREIGN KEY (`id_discussion`) REFERENCES `discussion` (`id_discuss`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussion_comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discussion_comment_action`
--
ALTER TABLE `discussion_comment_action`
  ADD CONSTRAINT `discussion_comment_action_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `discussion_comment` (`id_comment`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussion_comment_action_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ls_dir`
--
ALTER TABLE `ls_dir`
  ADD CONSTRAINT `ls_dir_ibfk_1` FOREIGN KEY (`id_available_dir`) REFERENCES `available_dir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
