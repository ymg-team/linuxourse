-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2015 at 06:37 
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `available_dir`
--

INSERT INTO `available_dir` (`id`, `directory`) VALUES
(1, '/'),
(10, '/boot'),
(14, '/dev'),
(3, '/etc'),
(12, '/etc/apt'),
(13, '/etc/skel'),
(2, '/home'),
(7, '/home/user'),
(9, '/home/user/.config'),
(8, '/home/user/mydirectory'),
(6, '/media'),
(11, '/proc'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id_badge`, `id_materi`, `id_level`, `id_course`, `title`, `description`, `logo`) VALUES
(1, 1, 1, 1, 'Starting Course', 'congratulations you have embarked on a course here', 'start.png'),
(2, NULL, NULL, NULL, 'Fast', 'faster than the estimated time', 'fast.png');

-- --------------------------------------------------------

--
-- Table structure for table `certivicate`
--

CREATE TABLE IF NOT EXISTS `certivicate` (
  `id_certivicate` bigint(20) NOT NULL AUTO_INCREMENT,
  `reqdate` datetime NOT NULL,
  `acceptdate` datetime NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `status` enum('unread','waiting','sent','failed') NOT NULL,
  PRIMARY KEY (`id_certivicate`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(20) NOT NULL,
  `flag` varchar(20) NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id_country`, `country`, `flag`) VALUES
(1, 'Indonesia', ''),
(2, 'United Kingdom', ''),
(3, 'other', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `id_level`, `step`, `title`, `description`, `estimate`, `course_case_en`, `course_case_id`, `hint_en`, `hint_id`, `command`, `custom_controller`, `status`, `editdate`) VALUES
(1, 1, 1, 'Hello Student', 'Hello Student', '1', 'lest begin to learn about Linux', 'Mari mulai belajar linux', '', '', 'y', '', 'posted', '0000-00-00 00:00:00'),
(2, 1, 2, 'Linux History', 'Knowing Linux History', '5', 'Linux created by Linus Torvald', '[h5]Linux History[/h5]\nLinux adalah nama yang diberikan kepada sistem operasi komputer bertipe Unix. Linux merupakan salah satu contoh hasil pengembangan perangkat lunak bebas dan sumber terbuka utama. Seperti perangkat lunak bebas dan sumber terbuka lainnya pada umumnya, kode sumber Linux dapat dimodifikasi, digunakan dan didistribusikan kembali secara bebas oleh siapa saja.\n\nNama "Linux" berasal dari nama pembuatnya, yang diperkenalkan tahun 1991 oleh Linus Torvalds. Sistemnya, peralatan sistem dan pustakanya umumnya berasal dari sistem operasi GNU, yang diumumkan tahun 1983 oleh Richard Stallman. Kontribusi GNU adalah dasar dari munculnya nama alternatif GNU/Linux.\n\n[h5]GNU Project[/h5]\nProyek GNU yang mulai pada 1984 memiliki tujuan untuk membuat sebuah sistem operasi yang kompatibel dengan Unix dan lengkap dan secara total terdiri atas perangkat lunak bebas.Tahun 1985, Richard Stallman mendirikan Yayasan Perangkat Lunak Bebas dan mengembangkan Lisensi Publik Umum GNU (GNU General Public License atau GNU GPL). Kebanyakan program yang dibutuhkan oleh sebuah sistem operasi (seperti pustaka, kompiler, penyunting teks, shell Unix dan sistem jendela) diselesaikan pada awal tahun 1990-an, walaupun elemen-elemen tingkat rendah seperti device driver, jurik dan kernel masih belum selesai pada saat itu.Linus Torvalds pernah berkata bahwa jika kernel GNU sudah tersedia pada saat itu (1991), dia tidak akan memutuskan untuk menulis versinya sendiri.\n\nLinux telah lama dikenal untuk penggunaannya di server, dan didukung oleh perusahaan-perusahaan komputer ternama seperti Intel, Dell, Hewlett-Packard, IBM, Novell, Oracle Corporation, Red Hat, dan Sun Microsystems. Linux digunakan sebagai sistem operasi di berbagai macam jenis perangkat keras komputer, termasuk komputer desktop, superkomputer, dan sistem benam seperti pembaca buku elektronik, sistem permainan video (PlayStation 2, PlayStation 3 dan XBox), telepon genggam dan router. Para pengamat teknologi informatika beranggapan kesuksesan Linux dikarenakan Linux tidak bergantung kepada vendor (vendor independence), biaya operasional yang rendah, dan kompatibilitas yang tinggi dibandingkan versi UNIX tak bebas, serta faktor keamanan dan kestabilannya yang tinggi dibandingkan dengan sistem operasi lainnya seperti Microsoft Windows. Ciri-ciri ini juga menjadi bukti atas keunggulan model pengembangan perangkat lunak sumber terbuka (opensource software).\n\nSistem operasi Linux yang dikenal dengan istilah distribusi Linux (Linux distribution) atau distro Linux umumnya sudah termasuk perangkat-perangkat lunak pendukung seperti server web, bahasa pemrograman, basisdata, tampilan desktop (desktop environment) seperti GNOME,KDE dan Xfce juga memiliki paket aplikasi perkantoran (office suite) seperti OpenOffice.org, KOffice, Abiword, Gnumeric dan LibreOffice\n\n[h5]Hak Cipta dan Merek Dagang[/h5]\nLinux kernel dan sebagian besar perangkat lunak GNU menggunakan GNU General Public License (GPL) sebagai basis lisensinya. GPL mengharuskan siapapun yang mendistribusikan kernel linux harus membuat kode sumber (dan semua modifikasi atas itu) tersedia bagi pengguna dengan kriteria yang sama. Tahun 1997, Linus Torvald menyatakan, "Menjadikan Linux berbasis GPL sungguh merupakan hal terbaik yang pernah saya lakukan."\n\n[span class="instructions"][h5]Instruction[/h5]\nUntuk percobaan pertama silahkan tekan command [code]y[/code] kemudian [code]enter[/code], dan klik tombol "check" untuk melanjutkan\n[/span]\n', '', 'masukan command [code]y[/code] dan eksekusi [code]enter[/code], kemudian cek hasilnya', 'y', '', 'posted', '0000-00-00 00:00:00'),
(3, 1, 3, 'Open Source Movement', 'Open Source Movement', '5', 'Open Source Movement', '[h5]Open Source / Sumber Terbuka[/h5]\nadalah sistem pengembangan yang tidak dikoordinasi oleh suatu individu / lembaga pusat, tetapi oleh para pelaku yang bekerja sama dengan memanfaatkan kode sumber (source-code) yang tersebar dan tersedia bebas (biasanya menggunakan fasilitas komunikasi internet). Pola pengembangan ini mengambil model ala bazaar, sehingga pola Open Source ini memiliki ciri bagi komunitasnya yaitu adanya dorongan yang bersumber dari budaya memberi, yang artinya ketika suatu komunitas menggunakan sebuah program Open Source dan telah menerima sebuah manfaat kemudian akan termotivasi untuk menimbulkan sebuah pertanyaan apa yang bisa pengguna berikan balik kepada orang banyak.\n\nPola Open Source lahir karena kebebasan berkarya, tanpa intervensi berpikir dan mengungkapkan apa yang diinginkan dengan menggunakan pengetahuan dan produk yang cocok. Kebebasan menjadi pertimbangan utama ketika dilepas ke publik. Komunitas yang lain mendapat kebebasan untuk belajar, mengutak-ngatik, merevisi ulang, membenarkan ataupun bahkan menyalahkan, tetapi kebebasan ini juga datang bersama dengan tanggung jawab, bukan bebas tanpa tanggung jawab.\n\nMelalui open source, perkembangan software akan sangat cepat, karena dikerjakan oleh banyak orang secara sukarela.Melalui open source masalah dan solusi akan dipecahkan dan dicari bersama.\n\nSebagai contoh open source adalah : Linux, sebuah kernel yang dari pertama kali dibuat sampai sekarang masih populer keberadaannya.\n\nDan lihat juga Android dari Google, merupakan salah satu produk open source yang palinng populer saat ini\n\n[i]wikipedia[/i]\n\n[span class="instructions"][h5]Instruction[/h5]\nuntuk melanjutkan eksekusi command [code]y[/code] \n[/span]', '', 'preses [code]y[/code] lalu klik [code]enter[/code]', 'y', '', 'posted', '0000-00-00 00:00:00'),
(4, 1, 4, 'Kernel', 'Knowing kernel and Linux kernel', '5', 'Kernel Module,library, applications', '[h5]Kernel[/h5]\nSistem operasi Linux bisa berjalan karena adanya fondasi yang disebut kernel Linux. Kernel adalah software yang bekerja di low level (tingkat dasar) untuk berinteraksi dengan berbagai hardware di komputer. Jadi, jika Anda sedang berselancar (browsing) lewat Firefox, kernel lah yang mengatur penerimaan dan pengiriman data Anda lewat kartu jaringan atau Wi-Fi komputer. Begitu juga jika Anda memasukkan USB stick atau USB flash drive (UFD) ke port USB, kernel bertugas mendeteksi adanya disk ini dan menyiapkannya agar siap diakses pengguna.\n\nDalam Linux, kernel bisa anda temui di directory [code]/boot[/code] dengan nama file [code]vmlinuz[/code] disertai dengan angka yang menjelaskan versi tertentu.\n\n[span class="instructions"][h5]Instruction[/h5]\n[strong]1 [/strong] Silahkan lihat versi kernel ada di sistem yang anda gunakan sekarang dengan perintah [code]ls /boot[/code]\n[/span]\n\n[h5]Chek Linux dan Kernel Version[/h5]\nDari semua kernel yang bisa dilihat di [pre]/boot[/pre] hanya ada satu saja kernel saja yang digunakan, biasanya yang terinstall terakhir terbaru, ditunjukan dengan nomor seri paling besar\n\n[span class="instructions"][h5]Instruction[/h5]\nBerikut beberapa perintah yang digunakan untuk cek kernel\n[code]uname -a[/code]: menampilkan semua informasi kernel \n[code]uname -r[/code] : menampilkan release kernel \n[code]uname -v[/code] : menampilkan versi kernel \n[code]uname -o[/code] : menampilkan sistem operasi kernel \n[/span]\n', 'try this command', 'Tampilkan semua versi kernel Linux yang tersedia di sistem dengan [code]ls /boot[/code]. Selanjutnya ketahui berbagai macam command yang digunakan untuk mengetahui kernel yang sedang digunakan :\n[code]uname -a[/code] \n[code]uname -r[/code] \n[code]uname -v[/code]\n[code]uname -o[/code]', 'ls /boot:uname -a:uname -r:uname -v:uname -o', '', 'posted', '2015-02-14 10:55:34'),
(5, 1, 5, 'Distributions', 'Knowing Linux Distributions', '5', 'Knowing Linux Distributions', '[h5]Kernel[/h5]\nSejak versi stabil kernel Linux dikeluarkan, perkembangan distro Linuxpun mulai berkembang dengan pesat, bahkan hingga menjadi distro besar dan menghasilkan puluhan bahkan ratusan distro turunannya.\n\n[strong]Distro[/strong], atau bisa disebut distribusi Linux (singkatan dari distribusi Linux) adalah sebutan untuk sistem operasi komputer dan aplikasinya, merupakan keluarga Unix yang menggunakan kernel Linux. Distribusi Linux bisa berupa perangkat lunak bebas dan bisa juga berupa perangkat lunak komersial seperti Red Hat Enterprise, SuSE, dan lain-lain.\n\nBeberapa distro populer antara lain : Red Hat, Debian, Ubuntu, Fedora, Kali Linux dan sebagainya\n\n[h5]Repositori[/h5]\nRepositori adalah sebuah tempat penyimpanan yang berada di  dalam server, atau bisa dibilang server repo. Repository menyediakan berbagai macam distro, update kernel linux dan aplikasi yang dibutuhkan sistem operasi Linux. Pengguna bisa mengatur server repo mana yang digunakan, beberapa alasan untuk memilih server repo karena, kecepatannya, keandalannya, lokasi dan kelengkapannya.\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk mengetahui server repo mana saja yang digunakan bisa dibaca di [code]cat /etc/apt/sources.list[/code]\n[/span]\n\n[a target="_blank" href="http://id.wikipedia.org/wiki/Distribusi_Linux"]wikipedia[/a]', 'Hint en', 'untuk mengetahui server repo mana saja yang digunakan bisa dibaca di [code]cat /etc/apt/sources.list[/code]', 'cat /etc/apt/sources.list', '', 'posted', '2015-02-14 11:27:12'),
(6, 1, 6, 'Multiuser And Multitasking', 'Multiuser and Multitasking on Linux', '5', 'Multiuser is', '[h5]Multiuser[/h5]\nMultiuser adalah salah satu kelebihan Linux yang memungkinkan untuk digunakan banyak pengguna secara bersamaan atau sendiri-sendiri. Daftar user yang terdaftar pada sistem bisa dilihat pada file yang terletak di [pre]/etc/passwd[/pre]. Dalam memanagemen user ini Linux menyediakan fasilitas yang namanya ''Grup''. untuk mempelajari konsep proses maka dikenal istilah ''User and Group Management'' yang bisa dipelajari pada materi ''Linux Shell and Command'' level ''User and Group Management''.\n\n[h5]Multitasking[/h5]\nMultitasking adalah kemampuan sistem untuk menjalankan beberapa proses sekaligus, sebenarnya beberapa proses ini bukanlah dikerjakan dalam satu waktu yang sama, melainkan bergantian dalam waktu sepersekian detik. untuk mempelajari konsep proses maka dikenal istilah ''Process Management'' yang bisa dipelajari pada materi ''Linux Shell and Command'' level ''Process Management''.\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk melanjutkan eksekusi command [code]y[/code]\n[/span]', 'execute command [code]y[/code] to next case', 'eksekusi command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-14 11:35:26'),
(9, 3, 2, 'command line', 'Know Linux command line', '30', '', 'Setiap pemakai Linux harus mmpunyai nama login (user account) yang sebelumnya harus didaftarkan pada administrator sistem. Nama login umumnya dibatasi maksimum 8 karakter dan umumnya dalam huruf kecil. Prompt shell bash pada Linux menggunakan tanda [pre]$[/pre].\r\n\r\nSebuah sesi Linux terdiri dari :\r\n1. Login\r\n2. Bekerja dengan Shell / menjalankan aplikasi\r\n3. Logout\r\n\r\n[h5]Format Instruksi Linux[/h5]\r\nInstruksi Linux standar umumnya mempunyai format sebagai berikut :\r\n$<command> <pilihan> <argument>\r\npilihan/options dimulai dengan tanda - (minus), argument dapat kosong, atau diisi satu atau beberapa argumen (parameter).\r\ncontoh :\r\n[code]ls[/code] : tanpa argumen\r\n[code]ls -a[/code] : option adalah [pre]-a[/pre] = all, tanpa argumen\r\n[code]ls /bin[/code] : tanpa option, menggunakan argumen [pre]/etc[/pre]\r\n[code]ls -l /usr[/code] : menggunakan option [pre]-l[/pre] , dan argumen [pre]/usr[/pre]\r\n\r\n[h5]Manual[/h5]\r\nlinux halaman manual yang berisi penjelasan dan cara penggunaan dari command yang ada, melalui halaman manual tersebut juga bisa diketahui option dan atribut apa saja yang di dukung oleh command tersebut.\r\n\r\n[span class="instructions"][h5]Instructions[/h5]\r\neksekusi command [code]y[/code] untuk melanjutkan\r\n[/span]', '', 'eksekusi command [code]y[/code] dan cek', 'y', '', 'posted', '0000-00-00 00:00:00'),
(10, 3, 3, 'Working directories and hierarchal relationships', 'Structure and explanation directory in Linux', '30', 'case en', '[h5]Direktori[/h5]\nDirectori adalah suatu file yang berisi daftar-daftar nama file dan direktori lainnya, sehingga seolah-oleh direktori terlihat sebagai penampung file.\n\nDirektori disusun secara hierarkis, sebagai contoh : direktori A berada didalam direktori B sehingga secara hirarkis direktori B dipanggil sebagai [strong]parent[/strong] dan A sebagai [strong]child[/strong]. Sedangkan suatu direktori yang tidak memiliki [strong]parent[/strong] dinamakan [strong]root[/strong] atau dituliskan [code]/[/code]. Pada directory juga dikenal istilah [strong]active[/strong] yang berarti direktori dimana saat ini anda berada, untuk cek direktori active bisa menggunakan perintah [code]pwd[/code].\n\n[h5]Struktur direktori Linux[/h5]\nBerikut adalah struktur utama direktori di linux yang bisa dicek dengan command [code]ls /[/code].\n[pre]\n- /\n--/usr\n--/var\n--/bin\n--/home\n--/root\n--/tmp\n--/dev\n--/etc\n[/pre]\n\nberikut adalah penjelasan dari beberapa direktori penting di Linux \n[strong]/[/strong] adalah direktori root, direktori paling dasar yang berisi seluruh direktori lainnya.\n[strong]/home[/strong] berisi directory home untuk user, tempat menyimpan berbagai data aygn bersifat personal.\n[strong]/bin[/strong] merupakan singkatan dari binary. Direktori ini berisi sejumlah aplikasi/program dasar Linux.\n[strong]/usr[/strong] berisi sejumlah directori yang berisi program yang digunakan oleh user, berupa hal-hal berikut :\ndocs : dokumentasi perihal informasi tentang Linux.\nman : dokumen yang digunakan program man, berisi manual dari suatu perintah.\ngame : berisi beberapa games.\n[strong]usr/bin[/strong] berisi banyak program-program yang digunakan oleh user.\n[strong]usr/sbin[/strong] berisi banyak program-program yang digunakan oleh super user.\n[strong]/sbin[/strong] berisi file sistem yang dijalankan seara otomatis oleh Linux.\n[strong]/var[/strong] atau singkatandari variabel, berisi beragam temporary data seperti spool untuk menampung file yang akan dicetak, uucp untuk menampung fule yang akan disalin dari mesin Linux lain.\n[code]/dev[/code] berisi file yang digunakan untuk berhubungan dengan piranti output seperti : CD-ROM,floppy-disk, hard-disk dan lain-lain. \n[code]/etc[/code] berisi banyak file konfigurasi. File ini beruppa teks dan dapat diubah untuk mengubah konfigursi sistem.\n\n[h5]Aturan Penamaan direktori[/h5]\nAturan penamaan direktori sama dengan aturan penamaan file, diperbolehkan menggunakan tanda ''-'' ataupun ''_'' sebagai nama. Terus bagaimana untuk membedakan itu adalah file atau folder. Silahkan lihat isi direktori aktif anda sekarang ini dengan perintah [code]ls[/code], maka akan menampilkan isi dari direktori tersebut, ada dua macam input, untuk nama yang diakhiri notasi ''/'' berarti itu adalah direktori, sedangkan lainnya adalah file.\n\nDisamping itu pada Linux terdapat dua buah penamaan yang istimewa, yaitu direktori dot ''.'' dan double ''..'', direktori dot merupakan merupakan lokasi anda sekarang ini. sedangkah double dot digunakan untuk perbindah ke direktori parent dorektorinya.\n\n[h5]Berpindah Direktori[/h5]\ncommand utama yang digunakan adalah [code]cd[/code] untuk lihat detail dari perintah [code]cd[/code] gunakan command [code]man cd[/code]. Penulisannya adalah [code]cd [directory location][/code].\n\n[span class="instructions"][h5]Instructions[/h5]\n[strong]1 [/strong] tampilkan lokasi active directory\n[strong]2 [/strong] tampilkan struktur dari directory root\n[strong]3 [/strong] dari lokasi active directory, pindahkan ke parent directorynya. \n[/span]', 'hint en', 'menampilkan active directory [code]pwd[/code]\nroot directory di Linux dibaca "/" untuk menampilkan isi dari root directory menggunakan [code]ls /[/code]\nberpindah ke directory sebelumnya menggunakan [code]cd ..[/code]', 'pwd:ls /:cd ..', '', 'posted', '2015-03-01 04:13:01'),
(11, 3, 4, 'Environment Variable', 'Linux Environtment', '10', 'case en', '[h5]Environment Variable[/h5]\nAtau variabel lingkungan, adalah sebuah variabel khusus yang digunakan oleh Shell atau sistem Linux, untuk proses kerja seperti variabel [pre]PS1, PS2, HOME, PATH, USER, SHELL dsb[/pre] yang jika digunakan akan berdampak pada sistem. \n\n[span class="instructions"][h5]Instructions[/h5]\nUntuk mengetahui environment variabel yang tersedia di sistem sekarang gunakan command [code]echo $PATH[/code]\n[/span]\n\nMaka shell akan menampilkan daftar environment variable sebagai berikut :\n[pre]cat: /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games: No such file or directory[/pre]\n', 'hint en', 'untuk mengetahui environment variable yang tersedia di sistem gunakan command [code]echo $PATH[/code]', 'echo $PATH', '', 'posted', '2015-03-01 04:37:28'),
(12, 5, 22, 'Linux Process Concept', 'Process Structure', '40', 'case en', 'Proses adalah program yang sedang dieksekusi. Setiap kali menggunakan utilitas sistem atau program aplikasi dari shell, satu atau lebih proses ''child'' akan dibuat oleh shell sesuai command yang diberikan.\n\nSetiap kali instruksi diberikan pada Linux shell, maka kernal akan menciptkan sebuah process-id, dalam terminology Unix process-id ini disebut juga dengan Job. Process-Id (PID) dimulai dari 0, yaitu proses INIT, kemudian diikuti proses berikutnya.\n\nBerikut adalah beberapa tipe proses :\n[strong]Foreground [/strong]\nProses yang diciptakan oleh pemakai langsung pada terminal (command interaktif/dialog)\n\n[strong]Batch [/strong]\nProses yang dikumpulkan dan dijalankan secara sekuensial (satu persatu). Proses batch tidak diasosiasikan (berinteraksi) dengan terminal.\n\n[strong]Daemon [/strong]\nProses yang menunggu perminataan (request) dari proses lainnya dan menjalankan tugas sesuai dengn permintaan tersebut. Bila tidak ada request, maka program ini akan berada dalam kondisi idle dan tidak menggunakan waktu hitung CPU. Umumnya nama proses daemon di UNIX berakhiran d, misalnya [pre]netd[/pre] , [pre]named[/pre] ,\n[pre]popd[/pre] dll\n\n[span class="instructions"][h5]Instructions[/h5]\neksekusi command [code]y[/code] untuk melanjutkan\n[/span]', 'hint en', 'eksekusi command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-25 06:37:00'),
(13, 6, 27, 'Booting', 'Boot Process Management', '30', 'case en', '[h5]What is Booting[/h5]\n\nAdalah beberapa tahapan proses booting dalam system operasi Linux. Berikut adalah proses yang dikerjakan dalam booting :\n\n[strong]Booting Process[/strong]\npertama lilo akan meload kernel, kemudian kernel akan memeriksa setiap device yang ada di mesin, dan seanjutnya akan menjalankan script init.\n\n[strong]Script Init[/strong]\nInit adalah process pertama yang dijalankan oleh system, init sendiri kemudian menjalankan proses-proses lain yang dijalankan pada saat booting. Init menjalankan semua proses berdasarkan [pre]/etc/inittab[/pre].\n\n[span class="instructions"][h5]Instructions[/h5]\nBaca isi file dari [pre]/etc/inittab[/pre] menggunakan command [code]cat[/code]\n[/span]\n\n[strong]Mekanisme Log dan Pesan Sistem[/strong]\nDidalam Linux dikenal dua cara logging, yaitu dengan :\n[pre]syslogd[/pre]\n[pre]klogd[/pre] \n\n[pre]Syslogd[/pre], digunakan oleh berbagai macam program yang menggunakan fungsi [pre]syslog()[/pre] unutk memasukan catatan log ke dalam log file yang disediakan fasilitasnya oleh [pre]syslog()[/pre] yang konfigurasi filenya terletak di [pre]/etc/syslog.conf[/pre]. Dari file konfigurasi tersebut adminstrator dapat menentukan dimana log file diletakan. Secara default log file akan diletakan di [pre]/var/log[/pre].\n\n[span class="instructions"][h5]Instructions[/h5]\nSilahkan baca isi file [pre]/etc/syslog.conf[/pre] menggunakan [code]cat[/code]\n\nSetelah mengetahui fungsi [pre]syslog[/pre], selanjutnya adalah menggunaan command [code]cat[/code] tampilkan isi dari file [pre]klogd[/pre] didalam direktori [pre]/etc/[/pre], adalah system daemon yang mencatat segala aktifitas kernel dan kemudian mendokumentasikan ke dalam file.\n[/span]', 'hint en', 'Menggunakan command [code]cat[/code], silahkan baca beberapa file dibawah ini :\n- /etc/ininttab\n- /etc/syslog.conf\n- /etc/klog.conf', 'cat /etc/syslog.conf:cat /etc/inittab:cat /etc/klog.conf', '', 'posted', '2015-02-25 09:14:11'),
(14, 7, 28, 'Administration System', 'System Administration', '30', 'case en', 'Sistem administrasi adalah melakukan beberapa hal penting yang berkaitan dengan user dan group, beberapa hal penting tersebut antara lain :\n- Pendaftaran nama login\n- Pembekuan nama login user\n- Penghapusan nama login user\n- Pembuatan group baru\n- Pembagian group\n- Pengaturan direktori home\n- pengamanan file-file password\n\nDalam sistem Linux, nama login dapat diberikan pada :\n- User biasa, contoh : Pailus, Rizqi, Yussan,dsb\n- Aplikasi, contoh : mysql, facebook,dsb\n- Device, contoh : lp\n- Service, contoh : uget, ftp\n\nTujuan pemberian nama login adalah untuk memberikan identitas pada tiap entitas\n\nberikut beberapa command penting yang digunakan untuk Manajemen Administrasi di Linux :\n[strong]useradd[/strong], digunakan untuk menambahkan sebuah user.\n[strong]userdel[/strong], digunakan untuk menghapus sebuah user.\n[strong]usermod[/strong], digunakan untuk memodifikasi data-data user.\n[strong]passwd[/strong], digunakan untuk merubah password setiap user.\n[strong]groupadd[/strong], digunakan untuk menambah group baru.\n[strong]groupdel[/strong], digunakan untuk menghapus sebuah group.\n[strong]groupmod[/strong], digunakan untuk memodifikasi sebuah group.\n\ndata-data yang berhubungan dengan user group secara default berada di dalam [pre]/etc/passwd[/pre], berikut contoh isi dari file tersebut.\n\n[pre]student:x:500:500:FOSSIL Linuxourse 97:/home/user:/bin/bash[/pre]\nstudent = nama login user tertentu.\nx = password yang dienkripsi, disimpan didalam [pre]/etc/shadow[/pre].\n500 = nomor UID (User ID).\n500 = nomor GID (Group ID).\nuser1 = komentar atau deskripsi dari user student.\n/home/user = direktori home untuk user student.\n/bin/bash = default shell yang digunakan.\n\n[span class="instructions"][h5]Instructions[/h5]\nUntuk lebih memahami beberapa command untuk manajemen administrasi, silahkan jalankan command manual di bawah ini dan baca dengan seksama.\n[code]man useradd[/code], [code]man userdel[/code], [code]man usermod[/code], [code]man passwd[/code], [code]man groupadd[/code], [code]man groupdel[/code], [code]man groupmod[/code]\n\nuntuk selanjutnya silahkan baca isi dari dalam file [pre]/etc/passwd[/pre] menggunakan [code]cat /etc/passwd[/code] yang berisi daftar user yang ada pada sistem yang digunakan.\n\npassword yang dienkripsi berada pada file [pre]/etc/shadow[/pre], [code]cat /etc/shadow[/code] file tersebut berisi enkripsi password yang mengandung serangkaian karakter yang sulit untuk dikenali\n\nuntuk melihat daftar group yang ada di sistem bisa dilihat pada file [pre]cat /etc/group[/pre], file tersebut hanya berisi nama group, GID dan user-user yang menjadi anggota group tersebut.\n[/span]', 'hint en', 'jalankan semua command yang ada pada bagian instruksi untuk menuju step berikutnya.', 'man useradd:man userdel:man usermod:man passwd:man groupadd:man groupdel:man groupmod:cat /etc/passwd:cat /etc/shadow:cat /etc/group', '', 'posted', '2015-02-25 10:11:35'),
(15, 8, 31, 'Knowing Harddisk', 'Knowing Harddisk', '30', 'case en', 'Didalam menajemen penyimpanan (storage) ini, kita akan mempelajari bagaimana suatu storage dalam hal ini harddisk kita atur agar dapat bekerja secara optimal.\n\n[h5]Harddisk[/h5]\nBerfungsi sebagai tempat penyimpanan data. Tujuan utama harddisk adalah menyimpan informasi dan berdasarkan permintaan, mengirim kembali informasi itu. Fungsi harddisk mirip dengan perekam tape audio.\n\n[strong]Konstruksi Harddisk[/strong]\nPiringan dan head, merupakan inti dari harddisk yang digunakan sebagai media magnetik untuk menyimpan berbagai macam data.\n\n[strong]Track dan Cylinder[/strong]\nMerupakan head yang dibagi-bagi lagi menjadi bagian yang yang lebih kecil secara vertikal atau horisontal.\n\n[h5]Produk Harddisk Standar[/h5]\n[strong]ESDI[/strong]\nAtau bisa dibilang harddisk kecil.\n\n[strong]SCSI[/strong]\nMerupakan tipe harddisk yang mampu untuk bekerja dalam 24jam setiap harinya tanpa stop, sehingga tipe harddisk ini cocok digunakan untuk server.\n\n[strong]IDE/ATA[/strong], tipe harddisk yang paling banyak digunakan pada computer tipe PC, dengan harga yang murah dan peforma tinggi memungkinakan untuk dimiliki setiap rumah. \n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk menlajutkan eksekusi command [code]y[/code]\n[/span]', 'hint en', 'eksekusi command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-27 11:05:47'),
(16, 9, 34, 'Shell scripting', 'Shell scripting', '45', 'case en', 'Shell adalah "command excecutive" artinya program yang menunggu instruksi user, memeriksa sintaks dan menerjemahkan instruksi yang diberikan kemudian mengeksekusinya.\n\nPada umumnya shell ditandai dengan command promp, di Linux untuk user biasanya tanda [pre]$[/pre] dan untuk super user biasanya tanda [pre]#[/pre]. Shell yang digunakan bermacam-macam untuk e-course ini sendiri menggunakan shell [pre]bash[/pre].\n\n[h5][strong]File Permission[/strong][/h5]\nPerizina file dan direktori dibagi atas 3 macam akses, antara lain :\n[strong]READ[/strong](r), membaca file dan direktori.\n[strong]WRITE[/strong](w), menulis dan mencipta file atau direktori.\n[strong]EXECUTE[/strong](x), mengeksekusi file dan memasuki direktori.\n\nKepemilikan file dan direktori dibagi atas 3 macam kepemilikan, antara lain :\n\n[strong]Owner[/strong] u, yaitu user tertentu.\n[strong]Group[/strong] g, yaitu group tertentu.\n[strong]Others[/strong] o, yaitu selain owner dan group diatas.\n\nMateri diatas telah dibahas pada [a href="#"]Level 2 : File dan Direktori Manajemen[/a].\n\n[span class="instructions"][h5]Instructions[/h5]untuk melanjutkan ke step berikutnya eksekusi command [code]y[/code][/span]', 'hint en', 'eksekusi command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-28 10:08:33'),
(20, 3, 5, 'Path Absolut dan Relatif', 'Knowing diference active directory and other directories', '5', 'case en', '[h5]Linux Path[/h5]\nKetika berpindah dari satu direktori ke direktori lainnya di Linux dikenal 2 macam path, yaitu absolute dan relatif. Path absolut mengacu nama sebuah direktori  dari root directory linux (/). Jadi jika  kita  ingin  mengacu  nama  path dari  direktori  secara langsung yang merupakan subdirektori dari direktori sekarang, akan seperti ini /parent/child directory, sedangkan  yang  satunya lagi akan seperti ini bisa langsung dipanggil child directory asal masih merupakan child directory dari active directory sekarang.\n\n[span class="instructions"][h5]Instructions[/h5]\n[strong]Tes relatif path[/strong]\npindah ke directory [pre]/home[/pre] menggunakan command [code]cd /home[/code] kemudian masuk ke directory [pre]user[/pre] menggunakan command [code]cd user[/code].\n\ncek lokasi active directory sekarang dengan command [code]pwd[/code], maka active directory sekarang berada di [pre]/home/user[/pre]\n\n[strong]Tes absolute path[/strong]\ndari posisi sekarang pindah ke directory [pre]/home/user[/pre] menggunakan command [code]cd /home/user[/code]\n\ncek lokasi active directory sekarang dengan command [code]pwd[/code], maka active directory sekarang berada di [pre]/home/user[/pre]\n[/span]', 'hint en', 'jalankan semua command yang ada didalam kota instruksi untuk melanjutkan', 'cd /home:cd user:cd /home/user:pwd', '', 'posted', '2015-03-01 04:36:55'),
(21, 3, 1, 'Welcome To Materi', 'Welcome To Materi', '1', 'About Materi', 'Tentang Materi\r\n[span class="instructions"][h5]Instructions[/h5]\r\nexecute command [code]to start next step[/code]\r\n[/span]', '', '', 'y', '', 'posted', '0000-00-00 00:00:00'),
(23, 14, 1, 'First Case', 'this is first case', '1', 'blah blah', 'blah blah', 'blah blah', '[code]y[/code]', 'y', '', 'posted', '2015-02-01 02:31:36'),
(24, 15, 3, 'Third Case', 'Third Case', '1', 'blah blah', 'blah blah', '[code]y[/code]', '[code]y[/code]', 'y', '', 'posted', '2015-02-01 02:36:30'),
(25, 14, 2, 'Second Case', 'blah blah', '1', 'blah blah', 'blah blah', '[code]y[/code]', '[code]y[/code]', 'y', '', 'posted', '2015-02-01 02:37:08'),
(26, 15, 4, 'Fourth Case', 'this is fourth case', '1', 'blah blah', 'blah blah', '[code]y[/code]', '[code]y[/code]', 'y', '', 'posted', '2015-02-01 03:34:50'),
(27, 3, 6, 'Manual Page', 'Mengetahui fungsi dan penggunaan dari halaman manual', '5', 'case en', 'Halaman Manual adalah fasilitas bawaan Linux yang berisi referensi tentang berbagai command yang ada di Linux. Man sangat membantu Linux user untuk mepelajari command dan optionsnya. Dengan [code]man[/code] anda akan mengetahui berbagai hal berikut :\n[strong]1 [/strong]program yang bisa dieksekusi atau shell command\n[strong]2 [/strong]System calls (function yang disediakan oleh kernel)\n[strong]3 [/strong]Library calls (function yang berada didalam library program)\n[strong]4 [/strong]Spesial file yang biasa didapatkan di [code]/dev[/code]\n[strong]5 [/strong]File Formats and conventions eg [code]/etc/passwd[/code]\n[strong]6 [/strong]Games\n[strong]7 [/strong]Miscellaneous (meliputi macro packages dan convetions)\n[strong]8 [/strong]System administration commands (yang hanya digunakan oleh root)\n[strong]9 [/strong]Kernel rountines\n\n[h5]Contoh Penggunaan[/h5]\n\n[code]man ls[/code], menampilkan halaman manual dari program [ls]\n\nUntuk mengetahui lebih lengkap options yang disediakan oleh [code]man[/code] silahkan cek manual man dengan menggunakan perintah [code]man man[/code]. Berikut adalah beberapa options yang sering digunakan di [code]man[/code]\n\n[code]man -k printf[/code], melakukan pencarian deskripsi singkat dan nama halaman manual untuk beberapa command yang menggunakan kata [code]prinf[/code].\n[code]man -f ls[/code] atau [code]man -r ls[/code], melakukan pencarian deskripsi singkat dan nama halaman manual untuk command [code]ls[/code].\n\n[span class="instructions"][h5]Instructions[/h5]\nmenggunakan command [code]man[/code] silahkan tampilkan halaman manual dari beberapa command dibawah ini :\n[code]pwd[/code]\n[code]ls[/code]\n[code]cd[/code]\n[code]mv[/code]\n[code]cp[/code]\n[code]rm[/code]\npahami command diatas karena merupakan command yang paling sering digunakan ketika menggunakan Linux.\n[/span]\n', 'hint en', 'menggunakan command [code]man[/code] silahkan tampilkan halaman manual dari beberapa command dibawah ini :\n[code]man pwd[/code]\n[code]man ls[/code]\n[code]man cd[/code]\n[code]man mv[/code]\n[code]man cp[/code]\n[code]man rm[/code]\npahami command diatas karena merupakan command yang paling sering digunakan ketika menggunakan Linux.\n', 'man pwd:man ls:man cd:man mv:man cp:man rm', '', 'posted', '2015-02-16 02:07:49'),
(28, 3, 7, 'Input Output Standar', 'Input output standar on Linux Shell', '10', 'case en', '[h5]Linux Input/Output Standar[/h5]\nCommand yang diberikan pada Linux melalui Shell disebut sebagai eksekusi program yang selanjutnya disebut sebagai proses. Setiap kali instruksi diberikan, maka linux akan membuat sebuah proses dengan memberikan sebuah PID(Process Identity).\n\nDalam konteks Linux input/output adalah :\nkeyboard (input)\nlayar (output)\nFiles \nstruktur data kernel \nperalatan I/O lainnya (misalkan network)\n\n[h5]File Descriptor[/h5]\nLinux berkomunikasi dengan file melalui file descriptor yang dipresentasikan dari angka 0,1,2 dan seterusnya. tiga buah descriptor standar yang digunakan sebagai proses adalah :\n0 = keyboard (standar input)\n1 = layar (standar output)\n2 = layar (standar error)\n*)Linux tidak membedakan antara hardware dan file, karena Linux memanipulasi agar hardware dianggap sebagai file.\n\n[span class="instructions"][h5]Instructions[/h5]\neksekusi command [code]y[/code] untuk melanjutkan\n[/span]', 'hint en', 'eksekusi command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-16 02:17:51'),
(29, 3, 8, 'Input Output Standar :: 2', 'more about Linux input output standart', '20', 'case en', 'Didalam linux ada 2 symbol penting yang digunakan untuk majemen standar input output, yaitu ''redirection'' dan pipeline.\n\n[strong]Redirection[/strong], atau bisa dibilang pembelokan yang dimaksud adalah pembelokan untuk standar input/output.\n\n[h5]Pembelokan Standar Input[/h5] \n[pre]<[/pre] , merupakan standart input dengan format penulisan [code]output > input[/code], sebagai contoh adalah [code]cat < publicfile[/code], cat merupakan command untuk menampilkan isi dari suatu file. Dalam kasus ini cat akan menampilkan isi dari file yang menjadi standar inputnya melalui redirection yaitu file [pre]publicfile[/pre].\n[span class="instructions"][h5]Instructions[/h5]\ntampilkan isi dari file publicfile dengan [code]cat publicfile[/code], kemudian tampilkan publicfile sebagai standar input untuk command cat [code]cat < publicfile[/code]\n[/span]\n\n[h5]Pembelokan Standar Input[/h5]\n[pre]>[/pre], langsung ke contoh kasus ada command [code]echo ''hello'' > publicfile[/code]. Hasil command echo yang digunakan utuk menampilkan string di layar akan dibelokan kedalam file publicfile, sehingga isi publicfile berubahan menjadi ''hello''.\n[span class="instructions"][h5]Instructions[/h5]\ntampilkan isi dari file publicfile dengan [code]echo ''hello'' > publicfile[/code], kemudian tampilkan isi publicfile [code]cat publicfile[/code]\n[/span]\n\n[pre]>>[/pre], langsung ke contoh kasus ada command [code]echo ''whats up'' > publicfile[/code]. Hasil command echo yang digunakan utuk menampilkan string di layar akan dibelokan kedalam file publicfile tanpa menghapus sebelumnya, sehingga isi publicfile berubahan menjadi ''hello'' dan ''whats up''.\n[span class="instructions"][h5]Instructions[/h5]\ntampilkan isi dari file publicfile dengan [code]echo ''whats up'' >> publicfile[/code], kemudian tampilkan isi publicfile [code]cat publicfile[/code]\n[/span]\n\n[h5]Pembelokan Standar Error[/h5]\n[pre]2>[/pre], salah satu kekurangan dari pembelokan standar output adalah tidak bisa digunakan untuk membelokan ketika ternyata terjadi error ketika mengeksekusi command, sehingga diperlukan pembelokan standar error, dengan tujuan pesan error yang dibelokan sebagai standar output. Disamping itu ciri lain dari pembelokan standar error juga akan menampilkan dilayar objek apa yang menjadi standar ouputnya. \n[span class="instructions"][h5]Instructions[/h5]\n[code]echo ''mama'' 2> publicfile[/code], disamping membelokan echo ''mama'' ke publicfile, juga menampilkan hasil eksekusi dari echo ''mama''\n[/span]', 'hint en', 'jalankan semua command yang ada pada bagian intruksi agar bisa melanjutkan ke step berikutnya', 'cat /home/user/publicfile:echo ''hello'' > publicfile:echo whats up >> publicfile:echo mama 2> publicfile', '', 'posted', '2015-03-01 06:08:34'),
(30, 3, 9, 'Redirection', 'redirection', '5', 'case en', '[h5]Linux Input/Output : Redirection[/h5]\nPembelokan dilakukan untuk standar input, output / error. Yaitu untuk mengalihakan file descriptor 0,1 dan 2. Simbol yang digunakan untuk redirection adalah sebagai berikut.\n[code]0 <[/code] atau [code]<[/code] menggantikan standar input\n[code]1 >[/code] atau [code]>[/code] menggantikan standar output\n[code]2>[/code] mengganti standar error\n[code]>>[/code] menambahkan isi file hasil redirection standar output\n[code]2>>[/code] menambahkan isi file hasil redirection standar error\n\n[span class="instructions"][h5]Instructions[/h5]\n[strong]Standar error[/strong]\n[code]mkdir mydir[/code], kemudian coba lagi [code]mkdir[/code] maka muncul pesan eeror karena sudah ada direktori dengan nama yang sama. \n\n[strong]Standar Input[/strong]\n[code]cat < publicfile[/code], maka mebelokan isi file publicfile untuk dijadikan input perintah cat.\n\n[strong]Standar Output[/strong]\n[code]echo ''whats up world[/code], menampilkan ke layar pesan [i]whats up world[/i]\n\n[strong]Redirection[/strong]\n[code]echo ''whats up world'' > publicfile[/code], membelokan output dari perintah echo kedalam file publicfile, kemudian baca isi dari [pre]publicfile[/pre] dengan command [code]cat publicfile[/code]\n\nmencari file [pre]passwd[/pre] di dalam directory [pre]/etc[/pre] [code]find /etc -name passwd[/code].\nmembelokan ouput hasil pencarian kedalam file [pre]publicfile[/pre] [code]find /etc -name passwd > publicfile[/code], kemudian baca isi dari file publicfile, maka isi sebelumnya akan hilang dan ditindih oleh input terbaru.\n\nAgar data tidak tertindih maka menggunakan [code]>>[/code] pada redirectionnya.\nlakukan pencarian file [pre]hosts[/pre] pada directori [pre]/etc[/pre] kemudian belokkan output hasil pencarian untuk menambah isi dari [pre]publicfile[/pre] [code]find /etc -name hosts >> publicfile[/code]\n[/span]', 'hint en', 'Jalankan semua command yang ada didalam box instructions untuk bisa melanjutkan ke step berikutnya', 'mkdir mydir:cat < publicfile:echo ''whats up world'' > publicfile:cat /home/user/publicfile:find /etc -name passwd:find /etc -name passwd > publicfile:find /etc -name hosts >> publicfile', '', 'posted', '2015-02-21 09:39:33'),
(31, 3, 10, 'Redirection Case', 'Redirection ', '10', 'case en', '[h5]Membelokan Standar Input[/h5]\nUntuk lebih memahami tentang start input dan output pada Linux, silahkan kerjakan kasus dibawah ini.\n[span class="instructions"][h5]Instructions[/h5]\nbuat file baru bernama [pre]iofile[/pre] dengan command [code]touch iofile[/code] di didalam direktori saat ini.\n\nBelokan standar output [code]echo ''whats up''[/code]  ke file [pre]iofile[/pre] yang baru saja dibuat.\n\nTampilkan isi dari [pre]iofile[/pre], untuk memastikan bahwa pembelokan standar output berhasil dilakukan.\n[/span]\n\n[h5]Membelokan Standar Output[/h5]\n[span class="instructions"][h5]Instructions[/h5]\ndengan menggunakan [pre]cat[/pre] gunakan file [pre]iofile[/pre] sebagai standar inputnya. Maka shell akan menampilkan isi dari file [pre]iofile[/pre].\n[/span]\n\n[h5]Replace dan Marging Standar Pembelokan Output[/h5]\n2 macam pembelokan standar output. [code]>[/code] menggantikan isi dari standar output sebelumnya dan [code]>>[/code] menambah isi dari standar output sebelumnya.\n[span class="instructions"][h5]Instructions[/h5]\nBelokan hasil output [code]echo ''first input''[/code] kedalam file [code]iofile[/code]. Tampilkan isi dari file iofile [code]cat iofile[/code], maka isi dari standar input sebelumnya yaitu ''whats up world'' akan hilang, digantikan dengan standar output berikutnya. \n\nAgar isi dari standart output berikutnya, lakukan contoh command berikut :\nMembelokan hasil echo sebagai standar input ke file [pre]iofile[/pre] tanpa merubah isi sebelumnya. [code]echo ''second'' >> iofile[/code].\n\nTampilkan isi [pre]iofile[/pre] untuk perbandingan\n[/span]', 'hint en', 'Buat file baru bernama iofile dengan command [code]touch iofile[/code]. Redirect hasil echo ''hello world'' dengan command [code]echo ''whats up'' > iofile[/code]. Menggunakan iofile sebagai standar input untuk cat dengan command [code]cat < iofile[/code]. Gunakan >> agar hasil pemeblokan standar output tidak mengahapus isi sebelumnya dari iofile [code]echo ''second'' >> iofile[/code]', 'touch iofile:echo ''whats up'' > iofile:cat /home/user/iofile:cat < iofile:echo ''first input'' > iofile:echo ''second'' >> iofile', '', 'posted', '2015-02-21 09:57:21'),
(32, 3, 11, 'Pipeline', 'Pipeline to manage command on Linux shell', '5', 'case en', '[h5]Linux Input/Output : Pipeline[/h5]\nTujuan utama penggunaan pipeline adalah menggunakan output dari proses untuk dijadikan sebuah input bagi proses berikutnya. Untuk lebih jelasnya silahkan cek mekanisme gambar dibawah ini.\n[pre]input=>proses1=>output=input=>proses2=>output[/pre]\n\nHubungan antar ouput dan input ini dinamakan pipeline dan dinyatakan dengan simbol [code]|[/code].\n[pre]proses 1 | proses 2[/pre]\n\n[span class="instructions"][h5]Instructions[/h5]\nBerikut adalah contoh singkat penggunaan pipeline, jalankan command [code]ps -aux[/code] untuk mengetahui semua proses yang sedang berjalan di shell saat ini. Untuk berikutnya adalah menampilkan semua proses yang berjalan dishell dengan syarat proses tersebut mempunya kata-kata ''sbin'', menggunakan pipeline dan grep maka commandnya menjadi seperti [code]ps -aux | grep sbin[/code]\n[/span]', 'hint en', 'Jalankan command sesuai petunjuk yang diberikan di kotak instructions untuk melanjutkan ke step berikutnya', 'ps -aux', '', 'posted', '2015-02-21 11:27:00'),
(33, 3, 12, 'Pipeline Case', 'Linux pipeline case', '10', 'case en', '[h5]Case :[/h5]\nmengkombinasikan pipeline untuk mempermudah filterisasi tampilan. Menggunakan pipeline lakukan beberapa hal berikut :\n[span class="instructions"][h5]Instructions[/h5]\n1)Tampilkan semua proses yang berjalan di shell saat ini.\n2)Tampilkan semua proses yang berada di ''/sbin'' dan sedang berjalan di shell saat ini, gunakan [code]grep[/code] untuk melakukan pencarian berdasarkan keyword.\n3)Tampilkan semua proses yang berada di ''/sbin'' dan sortir berdasarkan ''ascending'', gunakan [code]sort[/code] untuk melakukan penyortiran data\n[/span]', 'hint en', '1)Menampilkan semua proses gunakan comman [code]ps -aux[/code]\n2)Menampilkan semua proses yang berada di /sbin, menggunakan command [code]ps -aux|grep /sbin[/code]\n3)Menampilkan semua proses yang berada di /sbin dan menampilkan berdasarkan ascendig, menggunakan [code]pas -aux|grep /sbin|sort[/code]', 'ps -aux', '', 'posted', '2015-02-22 10:30:58'),
(34, 4, 13, 'Linux FIle System', 'Linux file system description, standart and using', '10', 'case en', 'File System merupakan struktur yang digunakan sebuah sistem informasi untuk membaca harddisk. Ada banyak tipe file sytem yang ada. Contohnya pada Windows mengenal (FAT, FAT31,NTFS), pada Machintos mengenal (JFS), untuk Linux sendiri menggunakan (EXT)Extended File Type, untuk macamnya sendiri ada EXT1,EXT2,EXT3 dan hingga saat ini tahun 2015 adalah EXT4.\n\n[h5]Direktori dan Partisi[/h5]\nFilesystem di Linux sama saja dengan Windows, sama-sama mengenal isstilah ''root directory''. Didalam Windows tidak terdapat direktori bernama ''root'', tapi sebenarnya yang dimaksud root directory di Windows adalah c://, d:// dan seterusnya, root directory adalah tempat dimana nantinya semua direktori akan bercabang\n\n[h5]Linux Tidak Mengenal Drive C,D,E[/h5]\nDisinilah perbedaan organisasi file dari Linux. Bisa dikatakan [pre]/etc[/pre] , [pre]/boot[/pre] , dll itu adalah partisi yang sama seperti yang dikenal dalam Windows. Sebab di Windows hanya bisa mengenal 1 partisi utama dan dan 1 partisi extended(sedangkan di Linux bisa kita bisa membuat direktori atau partisi itu sangat banyak). Partisi Windows ketika dibaca pada Sistem Operasi Linux hanya akan terbaca sebagai direktori biasa saja.\n\n[h5]Penamaan File[/h5]\nSistem penamaan file di Linux lebih fleksibel. Dalam artian tidak semua file memerlukan ekstension sama seperti di Windows. Sebagai contoh kita membuat file dengan nama [pre]datasaya[/pre] maka Linux akan bisa membacanya dengan mudah. Selain itu ektensi file di Linux hanya berguna untuk menandakan apa fungsi dari file tersebut, sebagai contoh [pre]nama.conf[/pre] sebagai konfigurasi, [pre]app.sh[/pre] untuk file script.\n\n[h5]Device = Nama File[/h5]\nSatu lagi yang menarik dari Linux. Device-device seperti harddisk, CDROM, model, dsb, ditulis dalam bentuk sebuah file. Daftar device tersebut dapat dilihat dalam direktori [pre]/dev[/pre]\n\n[h5]Direktori Dalam Linux[/h5]\nSeluruh informasi yang tersimpan dalam Linux berada pada sebuah struktur file. Sistem file yang tersusun dalam direktori-direktori yang menyerupai struktur pohon (seperti pohon dengan akar berada diatas dan cabang dibawah).\n\n[span class="instructions"][h5]Instructions[/h5]\neksekusi command [code]y[/code] untuk melanjutkan\n[/span]', 'hint en', 'hint id', 'y', '', 'posted', '2015-02-16 02:39:38'),
(35, 4, 14, 'Virtual Memory', 'Virtual memory is importand part of Linux shell', '5', 'case en', 'Memory virtual adalah sebuah mekanisme yang digunakan oleh aplikasi untuk menggunakan sebagaian dari memory sekunder(storage) seolah-olah menggunakan memory primary(RAM) yang terinstall didalam sebuah sistem.\n\nMekanisme ini beroperasi dengan cara memindahkan beberapa kode yang tidak dibuthkan ke sebuah berkas di dalam hard drive yang disebut dengan swap file, page file atau swap partition.\n\n[h5]Swap di Linux[/h5]\nUntuk memudahkan penjelasan kita ibaratkan sebagai berikut :\nProsesor = direktur\nRAM = meja kerja\nkernel = ruangan kerja\nproses = berkas-berkas\n\nSaat direktur bekerja, maka meja kerjanya akan ditumpuk oleh berbagai berkas-berkas yang ada. Ketika berkas kerjanya terlalu banyak maka direktur tidak mempunyai tempat lagi untuk bekerja, untuk itu disediakan ruang baru lagi (swap) yang digunakan sebagai tempat penampungan berkas sementara, untuk kemudian dikerjakan kemudian.\n\nAnda juga harus tahu bahwa Linux memungkinkan seseorang untuk menggunakan beberapa partisi swap dan / atau file swap pada saat yang sama, sehingga anda bisa menambah partisi swap sebanyak apapun yang anda butuhkan\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk melanjutkan eksekusi command [code]y[/code]\n[/span]\n', 'hint en', 'untuk melanjutkan eksekusi command [code]y[/code]\n', 'y', '', 'posted', '2015-02-22 10:39:30'),
(36, 4, 15, 'Ownership 1 : Introduce', 'Ownership on Linux file and directory management', '10', 'case en', 'File di Linux memiliki hak aksesnya masing-masing, hak akses tersebut terbagi menjadi 3 bagian, yaitu :\nr (read/baca)\nw (write/baca)\nx (execute/eksekusi)\n\nUntuk melakukan cek terhadap suatu file bisa dilakukan dengan menjalankan command [code]ls -l[/code].\ndari command tersebut dapat akan menghasilkan tampilan sebagai berikut.\n[pre]\ndrw-rw-rw-  4 user users  4096 Nov 3 21:50 mydirectory\n-rwxrwxrwx  0 user users 4096 Nov 3 21:50 myfile\n[/pre]\n\ndari tampilan diatas terbagi menjadi 6 kolom utama sebagai berikut.\nKolom 1 [pre]drw-rw-rw[/pre]\nkolom 2 [pre]4[/pre]\nkolom 3 [pre]user users 4096[/pre]\nkolom 4 [pre]Nov 3 21:50[/pre]\nkolom 5 [pre]mydirectory[/pre]\n\n[h5]Kolom 1 [pre]drw-rw-rw-[/pre][/h5]\ndibagi lagi menjadi beberapa bagian\n[pre]d[/pre] mengartikan bahwa direktori, disamping itu masih ada banyak lagi atribut untuk kolom pertama ini, sebagai berikut :\n[pre]-[/pre], file biasa\n[pre]d[/pre], direktori biasa\n[pre]l[/pre], symbolic link\n[pre]b[/pre], block special file\n[pre]c[/pre], character special file\n[pre]s[/pre], socket link\n[pre]p[/pre], FIFO\n\n[pre]rw-[/pre] hak akses yang diberikan untuk user atau pemilik utama, user diberikan hak akses r+w yang artinya read dan write.\n\n[pre]rw-[/pre] hak akses yang diberikan untuk grup tempat user utama, grup diberikan hak akses r+w yang artinya read dan write.\n\n[pre]rw-[/pre] hak akses yang diberikan untuk other atau publik, other diberikan hak akses r+w yang artinya read dan write.\n\n[h5]kolom 2 [pre]4[/pre][/h5]\njumlah link yang berhubungan ke direktori tersebut\n\n[h5]kolom 3 [pre]user users 4096[/pre][/h5]\nuser menunjukan nama user pemilik file/direktori tersebut, users adalah grup tempat pemilik berada, dan angka terakhir adalah jumlah karakter.\n\n[h5]kolom 4 [pre]Nov 3 21:50[/pre][/h5]\nWaktu kapan terakhir kali file/direktori dimodifikasi/diubah\n\n[h5]kolom 5 [pre]mydirectory[/pre][/h5]\nNama dari fle /direktori\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk melanjutkan eksekusi command [code]y[/code]\n[/span]', 'hint en', 'eksekusi dan check command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-24 11:06:51');
INSERT INTO `course` (`id_course`, `id_level`, `step`, `title`, `description`, `estimate`, `course_case_en`, `course_case_id`, `hint_en`, `hint_id`, `command`, `custom_controller`, `status`, `editdate`) VALUES
(37, 4, 16, 'Ownership 2 : Permisions', 'Manage permision on Linux file and directory permissions', '15', 'case en', 'Setelah mempelajari atribut file melalui perintah [code]ls -l[/code] tujuan berikutnya adalah mempelajari bagian yang tidak kalah pentingnya.\n\n[h5]Permissions[/h5]\nSetiap objek(file, link,dsb) pada Linux harus mempunyai pemilik, yaitu nama pemakai Linux (account) yang terdaftarn pada [pre]/etc/passwd[/pre], dengan peran rwx yang sudah dijelaskan di case sebelumnya.\n\nSebagai pemilik tentu saja memiliki hak untuk merubah hak akses yang telah ada sebelumnya. Command yang digunakan adalah [code]chmod[/code], berikut cara penulisannya\n\n[code]chmod (ugoa) (= + -) (rwx) (file/dierktori)[/code]\ndimana :\nu = user / pemilik\ng = grup / kelompok\no = other / lainnya\na = all / semua\nformat lain dari chmod bisa juga menggunakan bilangan octal sebagai berikut :\nr = 4\nw = 2\nx = 1\n_____ + \n     7\n\n[strong]contoh penggunaan[/strong]\n[strong]1[/strong][code]sudo chmod 755 myfile[/code]\nmemberikan akses user = 7 , group = 5 , other = 5 untuk file [pre]myfile[/pre], dimana angka-angka tersebut mengartikan.\nuser = 7 => 4+2+1 => r+w+x\ngroup = 5 => 4+1 => r+x\nother = 5 => 4+1 => r+x \n\n[strong]2[/strong][code]sudo chmod u=rwx g=rx o=rx myfile[/code]\nmemberikan hak akses\nuser = rwx\ngroup = rx\nother = rx\n\n[strong]3[/strong]dari contoh nomor 2 akan diberikan hak akses tambahan untuk grup, yaitu ''execute'' maka commandnya menjadi seperti ini [code]chmod g+x myfile[/code]\nuser = rwx\ngroup = rwx\nother = rx\n\n[span class="instructions"][h5]Instructions[/h5]\nPastikan bahwa direktori aktif sekarang adalah [pre]/home/user[/pre] cek dengan command [code]pwd[/code]. Untuk selanjutnya lihat permission dari directory [pre]publicdirectory[/pre] menggunakan command [code]ls -l[/code] di directory [pre]/home/user[/pre] default hak akses untuk [pre]publicdirectory[/pre] adalah 777 atau u=rwx,g=rwx,o=rwx.\n\n<strong>Merubah hak akses menggunakan huruf</strong>\nMenggunakan chmod versi huruf ubah permission directory ''publicdirectory'' menjadi : user = rwx, group = r, other = r. Maka commandnya menjadi seperti [code]chmod u=rwx,g=r,o=r publicdirectory[/code]. Cek permissions terbaru dengan [code]ls -l[/code]\n\n<strong>Merubah hak akses menggunakan angka</strong>\nMenggunakan chmod versi angka ubah permission directory ''publicdirectory'' menjadi : user = rwx, group = r, other = r. Maka commandnya menjadi seperti [code]chmod 774 publicdirectory[/code]. Cek permissions terbaru dengan [code]ls -l[/code]\n[/span]', 'hint en', 'Cek lokasi sekarang dengan [code]pwd[/code].\nCek isi active directory sekalian dengan data selengkapnya [code]ls -l[/code].\nMerubah hak akses menjadi rwx untuk user, r untuk group dan r untuk other [code]chmod u=rwx,g=r,o=r publicdirectory[/code].\nMerubah hak akses menjadi rwx untuk user, rwx untuk group dan r untuk other [code]chmod 774 publicdirectory[/code].', 'pwd:ls -l:chmod u=rwx,g=r,o=r publicdirectory :ls -l:chmod 774 publicdirectory:ls -l', '', 'posted', '2015-02-24 08:12:15'),
(38, 4, 17, 'Ownership 3 : Umask', 'Pengenalan dan configurasi umask', '15', 'case en', 'Umask atau usermask digunakan Untuk menentukan ijin akses awal pada suatu file atau direktori dibuat perintah menggunakan [code]umask[/code], dengan adanya command ini memungkinkan pemilik tidak perlu membuat hak akses satu persatu untuk setiap file yang baru dibuat.\n\n[h5]Umask untuk File[/h5] \nuser ingin membuat default hak akses (umask) untuk file/biasa adalah 644(yang berarti u=rw,g=r,o=r).\nMaka perhitungan nilai umasknya sebagai berikut :\n\n666 (umask untuk file)\n644 (hak akses untuk file yang diinginkan)\n--- -\n022 (nilai umask)\n\n[h5]Umask untuk direktori[/h5]\nuser ingin membuat default hak akses (umask) untuk file/biasa adalah 644(yang berarti u=rwx,g=rw,o=rw).\nMaka perhitungan nilai umasknya sebagai berikut :\n\n777 (umask untuk direktori)\n755 (hak akses untuk file yang diinginkan)\n--- -\n022 (nilai umask)\n\n[h5]Merubah Nilai Umask[/h5]\nsebelumnya masuk terlebih dahulu ke direktori yang ingin dirubah nilai umasknya. \ncek terlebih dahulu nilai umask direktori tersebut dengan command [code]umask[/code], kemudian untuk merubah gunakan command [code]umask (nilai umask)[/code]. contoh [code]umask 022[/code]\n\n[span class="instructions"][h5]Instructions[/h5]\ncheck nilai umask untuk direktori [pre]/home/user/[/pre]. Kemudian ubah nilai umask untuk direktori dengan ketentuan u=rwx,g=rx,o=x. Untuk cek apakah pengaturan umask berhasil buat direktori baru bernama ''umaskdir'' [code]mkdir umaskdir[/code], kemudian cek hak aksesnya dengan command [code]ls -l[/code].\n[/span]\n', 'hint en', 'menghitung nilai umask untuk direktori.\nHak akses yang diinginkan adalah : u = rwx = 7, g = rx = 5, o = x = 1.\nMenghitung nilai umask : \n777\n751\n----- -\n026 (nilai umask)\nmaka command untuk mengatur nilai umask menjadi [code]umask 026[/code]\n', 'umask:umask 026:mkdir umaskdir:ls -l', '', 'posted', '2015-02-24 07:23:25'),
(39, 4, 18, 'Ownership 4 : Change Owner', 'Changer owner file or folder to other user or group', '20', 'case en', 'Linux juga memberikan hak pengguna untuk merubah kepemilikan suatu untuk user/grup lainnya. 2 perintah yang paling berperan dalah hal ini adalah [code]chown[/code] dan [code]chgrp[/code]. User yang bisa mengeksekusi command ini adalah user pemilik file yang akan di eksekusi.\n\nLinuxourse memberikan hak akses user yang login hanya didalam direktori [pre]/home/user[/pre]. File atau direktori yang menjadi milik user bisa dilihat dengan menggunakan command [code]ls -l /home/user[/code], ditandai dengan username user yang login.\n\nSebagai contih berikut adalah struktur dari salah satu direktori didalam [pre]/home/user[/pre] :\n[pre]drwxrwxrwx:0 username  username 7000 24Feb2015 19:29 publicdirectory/[/pre]\nUsername pertama menjelaskan nama user pemillik direktori tersebut.\nUsername kedua menjelaskan nama group pemilik direktori tersebut.\n\n[h5]Penggunaan chown Untuk Merubah User Kepemilikan[/h5]\nPenggunaannya adalah sebagai berikut [code]chown <namauser> <file>[/code].\ncontoh : [code]chown user2 myfile[/code]\nmemberikan hak akses myfile kepada user2.\n\n[span class="instructions"][h5]Instructions[/h5]\nUbah active directory ke  [pre]/home/user/[/pre] didalamnya ada file [pre]publicfile[/pre], cek pemilik dari file tersebut dengan command [code]ls -l[/code].Untuk kemudian ubah kepemilikan [pre]publicfile[/pre] kepada ''bob'' dengan command [code]chown bob publicfile[/code], cek dengan command [code]ls -l[/code] apakah pemilik sudah berubah.\n[/span]\n\n[h5]Penggunaan chgrp Untuk Mengubah Grup Kepemilikan[/h5]\nPenggunaannya adalah sebagai berikut [code]chgrp <namagrup> <file>[/code].\ncontoh : [code]chgrp grup2 myfile[/code]\nmemberikan hak akses myfile kepada grup2.\n\n[span class="instructions"][h5]Instructions[/h5]\nUbah active directory ke  [pre]/home/user/[/pre] didalamnya ada directory [pre]publicdirectory[/pre], cek pemilik dari directory tersebut dengan command [code]ls -l[/code].Untuk kemudian ubah kepemilikan [pre]publicdirectory[/pre] kepada  grup ''class2'' dengan command [code]chgrp class2 publicdirectory[/code], cek dengan command [code]ls -l[/code] apakah pemilik sudah berubah.\n[/span]', 'hint en', '[code]chown[/code] digunakan untuk merubah kepemilikan suatu file/directory ke userlain.\n[code]chgrp[/code] digunakan untuk merubah kepemilikan suatu file/directory ke gruplain.', 'ls -l:chown bob publicfile:chgrp class2 publicdirectory', '', 'posted', '2015-02-24 10:28:02'),
(40, 4, 19, 'Link', 'link functional on Linux Shell', '10', 'case en', 'Pada level 2 step 12 dimateri ''Linux Shell and Command'', sempat dijelaskan beberapa macam file, salah satunya adalah ''link''/''simbolic link''. [strong]Link[/strong] adalah sebuah teknik untuk memberikan lebih dari satu nama file dengan data yang sama. Bila file asli dihapus, maka data yang baru juga terhapus. Konsep mirip dengan shortcuts di Windows, perbedaannya di Linux lebh banyak option untuk konfigurasi link.\n\n[h5]Hard Link[/h5]\nKonsep dari hardlink adalah ketika user melakukan penghapusan pada link yang ada, maka objek asli tidak akan hilang. Hard Link hany berperan sebagai shortcuts saja.\nUntuk pembuatannya [code]ln <filename> <linname>[/code].\ncontoh : [code]ln myfile link_myfile[/code]\n\n[h5]Soft Link[/h5]\nKonsep dari soft link adalah ketika user melakukan penghapusan pada link maka objek aslinya juga akan terhapus, sehingga perlu penangan khusus untuk softlink ini agar tidak semua orang bisa mengaksesnya. [code]ln -s <filename> <linkname>[/code].\nContoh : [code]ln -sd myfile link_myfile[/code]\n\n[span class="instructions"][h5]instructions[/h5]\nTampilkan isi dari active direktori, maka akan didapat file ''publicfile'', buatlah hardlink untuk ''publicfile'' pada direktori yang sama kemudian beri nama ''hardlink''.\nBuat softlink untuk ''publicfile'' kemudian beri nama ''softlink''.\nJika hardlink dihapus maka file ''publicfile'' tidak akan ikut terhapus. Jika softlink dihapus maka file ''publicfile'' akan ikut terhapus. Begitulah perbedaan dari softlink dan hardlink.\n[/span]', 'hint en', 'Buat hardlink untuk publicfile dengan command [code]ln publicfile hardlink[/code].\nBuat hardlink untuk publicfile dengan command [code]ln -sd publicfile softlink[/code].', 'ln publicfile hardlink:ln -sd publicfile softlink', '', 'posted', '2015-02-25 08:43:37'),
(41, 4, 20, 'Editing Files', 'How to edit a file on Linux Shell', '20', 'case en', '[h5]Edit File Via Redirection[/h5]\nPada level 1 step 9 telah dipelajari tentang redirection pada standart input dan output. Shell pada linuxourse menggunakan metode tersebut untuk edit sebuah isi dari file. Jumlah karakter maksimal yang diperbolehkan adalah 40 karakter termasuk spasi.\n\n[span class="instructions"][h5]instructions[/h5]\nUbah active directory ke [pre]/home/user[/pre]. Tampilkan isi dari file [pre]publicfile[/pre] menggunakan command [code]cat[/code]. Menggunakan pembelokan output ubah isi [pre]publicfile[/pre] menjadi ''update content'' , tanpa tanda petik. Kemudian [code]cat publicfile[/code] sekali lagi untuk memastikan bahwa file telah berubah.\n[/span] ', 'hint en', 'Tampilkan isi dari file publicfile dengan command [code]cat publicfile[/code].\nUbah isi menggunakan pembelokan output dari echo dengan command [code]echo ''update content'' > publicfile[/code]', 'cat /home/user/publicfile:echo ''update content'' > publicfile', '', 'posted', '2015-02-25 10:35:52'),
(42, 4, 21, 'File and Directory Management Final Test', 'File and Directory Managemen Final Test', '30', 'case en', '[h5]Final Test[/h5]\nDitahap ini adalah tes terakhir untuk level ''File and Directory Management'', merupakan gabungan dari kasus-kasus dan soal-soal yang telah dipecahkan sebelumnya.\n\n[span class="instructions"][h5]instructions[/h5]\nPastikan lokasi anda sudah berada di [pre]/home/user[/pre], untuk kemudian cek didalamnya apakah tersedia file [pre]publicfile[/pre]. Jika semua kondisi sudah memungkingkan kerjakan beberapa kasus dibawah ini :\n[strong]1[/strong] buat umask untuk direktori [pre]/home/user[/pre] dengan ketentuan sebagai berikut \nuntuk file ::: user = rw, group = rx, dan others = x\n[strong]2[/strong] Buat file baru dengan nama ''file''.\n[strong]3[/strong] Menggunakan pembelokan standar output, ubah isi file menjadi ''bob data''.\n[strong]4[/strong] Menggunakan [code]chmod[/code] versi angka, ubah hak akses ''file'' untuk group menjadi rwx, sedang hak akses untuk user dan others masih sama seperti sebelumnya.\n[strong]5[/strong] Berikan hak kepemilikan file tersebut untuk ''bob''.\nCek hasil pekerjaan anda\n[/span]', 'hint en', '[code]umask 015[/code]\nMembuat default permissions untuk file menjadi :\n666\n015\n--- -\n651\nuser => 6 = r+w\ngroup => 5 = r+x\nothers => 1 = x\n\n[code]touch file[/code] membuat file kosong baru.\n\n[code]echo ''bob data'' > file[/code] merubaha isi file ''file'' melalui pembelokan standar ouput.\n\n[code]chmod 671 file[/code] merubah permission ''file'' menjadi :\nuser => 6 = r+w\ngroup => 7 = r+w+x\nothers => 1 = x\n\n[code]chown bob file[/code] merubah kepemilikan file kepada ''bob''.', 'umask 015:touch file:echo ''bob data'' > file:chmod 671 file:chown bob file', '', 'posted', '2015-02-25 10:58:14'),
(43, 5, 23, 'Signal', 'Signal on linux process management', '5', 'case en', 'Proses dapat mengirim dan meneria sinyal dari dan ke proses lainnya. Proses mengirim sinyal melalui command [code]kill[/code], berikut tata cara penulisannya [code]kill -<signal number> <PID>[/code]\n\n[h5]Signal Number[/h5]\nSignal number adalah 1 s/d maksimum signal number yang didefinisikan sistem. Standar signal number yang terpenting adalah :\nhardlink\n\n[strong]SignalNumber\nNama\nDeskripsi[/strong]\n\n1\nSIGHUB\nHangup, sinyal dikirim bila proses terputus, misal melalui putusnya koneksi internet dengan modem\n\n2\nSIGINT\nsinyal interrupt, melalui ^C\n\n3\nSIGQUIT\nSinyal Quit, melalui ^\\\n\n9\nSIGKILL\nsinyal Kill, menghentikan proses\n\n15\nSIGTERM\nSinyal terminasi software\n\n[h5]Mengirim Sinyal[/h5]\nMengirim sinyal adalah satu alat komunikasi antar proses, yaitu memberitahu proses yang sedang berjalan bahawa ada sesuatu yang harus dikendalikan. Sebelum mengirim sinyal, PID proses yang akan dikirim harus diketahui terlebih dahulu, berikut commandnya : [code]kill -<nomor sinyal> PID[/code].\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk melanjutkan step berikutnya eksekusi command [code]y[/code]\n[/span]', 'hint en', 'eksekusi command [code]y[/code] untuk melanjutkan ke step berikutnya', 'y', '', 'posted', '2015-02-25 06:48:36'),
(44, 5, 24, 'Controll Process On Shell :: 1', 'How to controll process on shell part one', '20', 'case en', '[h5]Shell Process[/h5]\nShell menyediakan fasilitas job control yang memungkinkan beberap job atau proses yang sedang berjalan pada waktu yang sama, misalnya bila melakukan pengeditan file teks dan ingin melakukan interrupt pengeditan untuk mengerjakn hal lainnya.\n\nPada penjelasan sebelumnya dijelaskan bahwa Job bekerja pada foreground atau background. Pada foregrond hanya diperuntukan untuk satu job satu waktu. Job pada foreground akan mengontrol shell - menrima input dari keyboard dan mengirim output ke layar. Job pada ackground tidak menerima input dan terminal, biasanya berjalan tanpa memerlukan interaksi.\n\nJob pada foreground memungkinkan dihentikan sementara (suspend), dengan menekan [code]Ctrl+Z[/code], job yang dihentikan sementara sangat berbeda dengan mengeluarkan interrupt job / [code]ctrl+X[/code], dimana job yang diinterupt akan dimatikan secara permanen dan tidak dapat dijalankan lagi.\n\n[span class="instructions"][h5]instructions[/h5]\nKetahui semua job yang sedang berjalan di shell saat ini dengan command [code]ps -aux[/code]. Maka akan menghasilkan tampilan seperti ini\n[/span]\n[pre]:USER PID %CPU %MEM VSZ RSS TTY STAT START TIME COMMAND[/pre]\n[pre]user 3355 31.6  8.4 2033056 287048 ? Ssl 10:27 53:27 compiz[/pre]\n\ndari contoh result diatas bisa didapat.\nuser yang mengeksekusi : user\nPID : 3355\nPenggunaan CPU : 31.6%\nPenggunaan memory : 8.4%\nprogram yang berjalan : compiz\nhentikan program compiz tersebut dengan command [code]kill <pidnya>[/code].\n', 'hint en', 'untuk mengetahui semua proses yang sedang berjalan di shell gunakan command [code]ps -aux[/code]', 'ps -aux', '', 'posted', '2015-02-25 07:31:04'),
(45, 5, 25, 'Controll Process On Shell :: 2', 'How to controll process on shell part 2, job controll', '20', 'case en', '[h5]Job Control[/h5]\nShell menyediakan fasilitas job control yang memungkinkan mengontrol beberapa job atau proses yang sedang berjalan pada waktu yang sama. Job pada foreground kemungkinan dihentikan sementara (suspend), dengan menekan [code]Ctrl-Z[/code]. Job yang dihentikan sementara dapat dijalankan kembali pada foreground atau background sesuai keperluan dengan menekan [code]fg[/code] atau [code]bg[/code]. Sebagai catatan, menghentikan job sementara sangat berbeda dengan melakuakan interrupt job menggunakan [code]ctrl+c[/code], dimana job yang diinterrup akan dimatikan secara permanen dan tidak dapat dijalankan lagi.\n\nCommand [code]ps[/code] dapat digunakan untuk menunjukkan semua proses yang sedang berjalan pada mesin (bukan hanya proses pada shell saat ini) dengan format : [code]ps -fae[/code] atau [code]ps -aux[/code] \n\n[span class="instructions"][h5]instructions[/h5]\nKetahui lebih dalam tentang command [code]ps[code] dan options yang berlaku menggunakan [code]man ps[/code].\n\ngunakan perintah [code]ps[/code] untuk mengetahui status proses yang ada sedang berada di shell berapa (linux mampu menjalankan 7 shell secara bersamaan).\n\nGunakan command [code]ps -u[/code] untuk mengetahui penggunaan resource dari user yang sedang aktif sekarang. PID adalah process id, %CPU adalah presentase CPU/Prosesor yang digunakan, %MEM adalah presentasi jumlah memori yang sedang digunakan, SIZE adalah jumlah memori yang digunakan, RSS (Real System Storage) adalah jumlah memori yang digunakan, START adalah kapan proses tersebut diaktifkan\n\nuntuk lebih spesifik dalam penggunaan resource yang dilakukan oleh user maka bisa menggunakan command berikut [code]ps -u student [/code], student adalah nama user yang tersedia di linux shell.\n\nCommand [code]ps -au[/code]digunakan untuk mencari proses lainnya a = all , u = user.\n[/span]', 'hint en', 'Jalan beberapa command dasar yang berhubunga dengan proses, sebagai berikut :\n[code]man ps[/code] membaca manual dari command [code]ps[/code]\n[code]ps[/code] untuk mengetahui semua proses yang sedang berjalan di shell.\n[code]ps -u[/code] untuk mengetahui resource yang digunakan oleh user yang sedang aktif didalam Linux Shell.\n[code]ps -au[/code] untuk mengetahui semua proses dan user yang sedang aktif didalam Linux shell.\n', 'man ps:ps:ps -u:ps -au', '', 'posted', '2015-02-25 08:11:41'),
(46, 5, 26, 'Process Management Final Test', 'Proces management final test', '30', 'case en', '[h5]Final Test[/h5]\nSebelum melanjutkan ke level selanjutnya, berikut adalah test terakhir yang harus diselesaikan untuk ke level selanjutnya.\n\n[span class="instructions"][h5]instructions[/h5]\n[strong]1[/strong] Tampilkan proses-proses yang dijalankan oleh user ''bob''.\n[strong]2[/strong] Tampilkan semua proses dan user yang sedang berjalan di shell.\n[strong]3[/strong] uji coba penggunaan shortcuts untuk suspen dan interupt proses.\n[strong]4[/strong] Dari daftar proses yang sudah ditampilkan di atas, menggunakan command [code]kill --[/code], hentikan salah satu pidnya.\n[/span]\n\nPastikan menjalankan command sesuai dengan urutan case.', 'hint en', '[strong]1[/strong] Menampilkan proses yang dilakukan oleh user ''bob'' menggunakan command [code]ps -u bob[/code]\n[strong]2[/strong] menampilkan semua proses yang user yang sedang berjalan di shell [code]ps -aux[/code].\n[strong]3[/strong] suspend proses menggunakan shortcut [code]^+z[/code] dan untuk interrupt pproses menggunakan shortcut [code]^+x[/code]\n[strong]4[/strong] setelah mengetahui salah satu PID proses, gunakan command [code]kill (pid)[/code] untuk menghentikan prosesnya.\n', 'ps -aux:ps -u bob', '', 'posted', '2015-02-25 08:20:04'),
(47, 7, 29, 'User dan Group', 'Pencatatan User dan Group', '15', 'case en', '[h5]Pencatatan User dan Group[/h5]\n\nBerikut ini adalah utilitas uang digunakan untuk memodifikas [pre]/etc/passwd[/pre],[pre]/etc/shadow[/pre] dan [pre]/etc/group[/pre].\n\nSebelumnya telah diketahui beberapa utilitas yang digunakan untuk memodifikasi [pre]/etc/passwd[/pre],[pre]/etc/shadow[/pre] dan [pre]/etc/group[/pre]\n\n[h4][strong]useradd[/strong][/h4]\nCommand useradd berada pada [pre]/usr/sbin/useradd[/pre], fungsi utilitas ini adalah untuk menambahkan user ke sistem. Sintaksnya : \n[pre]\nuseradd [-u uid [-o]] [-g group] [-G group,?]\n[-d home] [-s shell] [-c comment] [-m [-k template]]\n[-f inactive] [-e expire] [-p passwd] [-n] [-r] name\n[/pre]\n\natau \n\n[pre]\nuseradd -D [-g group] [-b base] [-s shell]\n[-f inactive] [-e expire]\n[/pre]\n\nketerangan :\n[pre]-u[/pre] : nomor UID (UserID)\n[pre]-g[/pre] : nomor GID (GroupID)\n[pre]-G[/pre] : group tambahan\n[pre]-d[/pre] : direktori home untuk user\n[pre]-s[/pre] : default shell (biasanya /bin/bash)\n[pre]-c[/pre] : info dan deskripsi nama login\n[pre]-m[/pre] : direktori home akan diciptakan bila belum ada\n[pre]-k[/pre] : bersama -m memberi isi direktori home\n[pre]-f[/pre] : jumlah hari sebelum account tersebut kedaluarsa (password lewat masa berlakunya)\n[pre]-e[/pre] : tanggal nama login beakhir atau kedaluarsa (expired)\n[pre]-p[/pre] : password yang telah di enkripsi\n[pre]-D[/pre] : menetapkan konfigurasi default\n[pre]name[/pre] : nama login\n\n[h4][strong]userdel[/strong][/h4]\nperintah ini berada di [pre]/user/sbin/userdel[/pre], fungsi dari utilitas ini untuk menghapus user dari sistem dengan sintaks : [code]userdel [-r] name[/code].\n\nKeterangan :\n[pre]-r[/pre] : bila disertakan parameter ini maka direktori home user juga akan ikut terhapus.\n\n[h4][strong]passwd[/strong][/h4]\n[pre]/user/bin/passwd[/pre], utilitas ini berfungsi untuk perubah password user. Sintaksnua : [code]passwd <name>[/code].\n\n[span class="instructions"][h5]Instructions[/h5]\nBuat sebuah user baru bernama ''alex'' untuk Linux saat ini menggunakan command [code]useradd alex[/code] (perhatikan besar kecil teks, karena Linux case sensitive). Check apakah user baru sudah terdaftar di sistem dengan command [code]checkuser[/code].\n\nBuat sebuah group baru bernama matchclass menggunakan command [code]groupadd math[/code].\nUbah default group ''linuxourse'' untuk user ''alex'' menjadi group ''math'' menggunakan command [code]usermod -g math alex[/code]\nBerikutnya hapus group tadi menggunakan [code]groupdel -r math[/code]\nCheck, maka user ''alex'' juga hilang [code]checkuser[/code].\n[/span]\n\n[strong]*NB:[/strong]\nPencatatan user dan group merupakan salah satu hal yang sensitif di sistem linux. Untuk itu linuxourse menggunakan virtualisasi manajemen user/group tanpa memasukan datanya ke dalam [pre]/etc/passwd[/pre] atau [pre]/etc/group[/pre]', 'hint en', 'jalankan semua command yang ada didalam box instructions untuk melanjutkan ke step berikutnya.\n', 'useradd alex:groupadd math:usermod -m math alex:groupdel -r math\n', '', 'posted', '2015-02-27 11:02:21'),
(48, 7, 30, 'Home Directory', 'Knowing Home directory on Linux', '5', 'case en', '[h5]Home Diretory[/h5]\n\nBila sebuah user mengakses sebuah sistem Linux melalui proses login, maka user tersebut pastilah memasukan direktori awal yang disebut dengan home, letak direktori home ini biasanya dibawah [pre]home[/pre].\n\nSistem telah memberi direktori [pre]/etc/skel[/pre] sebagai default template bagi direktori home. Dan directory home anda adalah [pre]/home/user[/pre].\n\n[span class="instructions"][h5]Instructions[/h5]\nlakukan [code]ls -la /home/user[/code] untuk mengetahui default isi dari directory home untuk anda\n[/span]\n\nPerhatikan bahwa ada 3 file diatas merupakan file-file yang akan dijalankan apabila user login atau logout ke shell bash sebagai default shell Linux.\n\n[span class="instructions"][h5]Instructions[/h5]\nMenggunaan command cat silahkan tampilkan isi file-file berikut dari directory [pre]/home/user[/pre] :\n[pre].bash_logout[/pre], isi file ini akan dijalankan apabila user logout.\n[pre].bash_profile[/pre], berisi variabbel-variabel lobal yang akan dieksport ke environment sistem.\n[pre].bashrc[/pre], isis file ini akan dijalankan bila user memasuki atau login ke shell bash.\n[/span]', 'hint en', 'jalan semua instruksi yang ada didalam kotak ''instructions'' untuk melanjutkan', 'cat /home/user/.bashrc:ls -la /home/user:cat /home/user/.bash_logout:cat /home/user/.bash_profile', '', 'posted', '2015-02-27 10:16:44'),
(49, 8, 32, 'Linux FIle System 2', 'Linux File System Part 2', '20', 'case en', 'Seperti yang sudah dijelaskan pada level [a href=""]1:Shell[/a]. Berikut adalah beberapa aplikasi-aplikasi yang umum digunakan dalam manajemen storage.\n\n[strong]fsck[/strong]\n[pre]fsck[/pre], digunakan untuk memeriksa dan memperbaiki secaraoptional satu lebih Linux file sistem. [pre]fsck[/pre] ini mencoba untuk menjalankan file sistem pada disk drive fisik yang berbeda secara paralel, untuk mengurangi jumlah yang waktu yang diperlukan dalam memeriksa semua file sistem yang ada. Perintah yang digunakan :\n[code]fsck <nama_dev>[/code]\ncotoh :\n[code]fsck /dev/hda1[/code]\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk lebih jelas tentang [pre]fsck[/pre] anda dapat melilhat manualnya di [code]man fsck[/code].\n[/span]\n\n[strong]e2fsck[/strong]\n\n[pre]e2fsck[/pre],  aplikasi ini mirip dengan fsck namun lebih dikhususkan untuk file sistem yang bertipe extended dua. Perintah yang digunakan :\n[code]e2fsk <nama_device>[/code]\nContoh :\n[code]e2fsk /dev/hda2[/code]\n\n[span class="instructions"][h5]Instructions[/h5]\nuntuk lebih jelas tentang [pre]e2fsck[/pre] anda dapat melihat manualnya di [code]man e2fsck[/code].\n[/span]\n\n[strong]hdparm[/strong]\n\nhdparm merupakan aplikasi yang umum digunakan untuk meningkatkan kinerja harddisk agar dapat bekerja secara optimal. Hdparm ini mendukung harddisk IDE?ST 506. APlikasi ini membutuhkan kernel linux versi 1.2.13 keatas. Beberapa option tidak bisa bekerja pada kernel-kernel awal. Sebagai tambahan beberapa option didukung hanya untuk kernel yang memasukan device IDE \nHint IDmax 200 Character\nSeparate With ":", Ex : Ls -L:ps -Aux:ls / > Grep User:driver yang baru. , seperti versi\n2.0.10 ke atas.\n\nPerintah yang bisa digunakan :\n[code]hdparm [options] <nama_device>[/code]\n\n[span class="instructions"][h5]Instructions[/h5]\nKeterangan untuk option-optionnya dapat anda baca dari manual hdparm. [code]man hdparm[/code].\n[/span]\n\nDi bawah ini merupakan beberapa contoh yang umum digunakan :\nMelihat status 32 Bit I/O :\n[code]hdparm -c /dev/hda[/code]\nUntuk mengetahui kecepatan akses disk anda\n[code]hdparm -t /dev/had[/code]\nUntuk menset hardisk anda yang 16 bit menjadi 32 Bit dan mendukung DMA\n[code]hdparm -c1 -d1 /dev/had[/code]\nUntuk menjaga agar settingan di atas tetap berlangsung, gunakan perintah :\n[code]hdparm -k1 /dev/hda[/code]\n', 'hint en', 'Untuk bisa melanjutkan ke step berikutnya, jalankan dan pahami seluruh command yang berada didalam kotak instruksi', 'man fsck:man e2fsck:man hdparm', '', 'posted', '2015-02-28 09:32:43'),
(50, 8, 33, 'Extended Filesystem', 'Linux using Extended Filesystem', '10', 'case en', 'Versi extended file hingga soal ini dibuat adalah ext4(extended 4). Di case kali ini dijelaskan tentang beragam versi extended file yang pernah ada dan apa saja perbedaanya dengan versi sebelumnya.\n\n[h5]EXT2 (2nd Extended)[/h5]\nEXT2 adalah file sistem yang ampuh di linux. EXT2 juga merupakan salah satu file sistem yang paling ampuh dan menjadi dasar dari segala distribusi linux. Pada EXT2 file sistem, file data disimpan sebagai data blok. Data blok ini mempunyai panjang yang sama dan meskipun panjangnya bervariasi diantara EXT2 file sistem, besar blok tersebut ditentukan pada saat file sistem dibuat dengan perintah mk2fs. Jika besar blok adalah 1024 bytes, maka file dengan besar 1025 bytes akan memakai 2 blok. Ini berarti kita membuang setengah blok per file.\nEXT2 mendefinisikan topologi file sistem dengan memberikan arti bahwa setiap file pada sistem diasosiasiakan dengan struktur data inode. Sebuah inode menunjukkan blok mana dalam suatu file tentang hak akses setiap file, waktu modifikasi file, dan tipe file. Setiap file dalam EXT2 file sistem terdiri dari inode tunggal dan setiap inode mempunyai nomor identifikasi yang unik. Inode-inode file sistem disimpan dalam tabel inode. Direktori dalam EXT2 file sistem adalah file khusus yang mengandung pointer ke inode masing-masing isi direktori tersebut.\n\n[h5]EXT3 (3rd Extended)[/h5]\nEXT3 adalah peningkatan dari EXT2 file sistem. Peningkatan ini memiliki beberapa keuntungan, diantaranya:\n[strong]a[/strong] Setelah kegagalan sumber daya, unclean shutdown, atau kerusakan sistem, EXT2 file sistem harus melalui proses pengecekan dengan program e2fsck. Proses ini dapat membuang waktu sehingga proses booting menjadi sangat lama, khususnya untuk disk besar yang mengandung banyak sekali data. Dalam proses ini, semua data tidak dapat diakses.\nJurnal yang disediakan oleh EXT3 menyebabkan tidak perlu lagi dilakukan pengecekan data setelah kegagalan sistem. EXT3 hanya dicek bila ada kerusakan hardware seperti kerusakan hard disk, tetapi kejadian ini sangat jarang. Waktu yang diperlukan EXT3 file sistem setelah terjadi unclean shutdown tidak tergantung dari ukuran file sistem atau banyaknya file, tetapi tergantung dari besarnya jurnal yang digunakan untuk menjaga konsistensi. Besar jurnal default memerlukan waktu kira-kira sedetik untuk pulih, tergantung kecepatan hardware.\n[strong]b[/strong] Integritas data\nEXT3 menjamin adanya integritas data setelah terjadi kerusakan atau unclean shutdown. EXT3 memungkinkan kita memilih jenis dan tipe proteksi dari data.\n[strong]c[/strong]Kecepatan\nDaripada menulis data lebih dari sekali, EXT3 mempunyai throughput yang lebih besar daripada EXT2 karena EXT3 memaksimalkan pergerakan head hard disk. Kita bisa memilih tiga jurnal mode untuk memaksimalkan kecepatan, tetapi integritas data tidak terjamin.\n[strong]d[/strong]Mudah dilakukan migrasi\nKita dapat berpindah dari EXT2 ke sistem EXT3 tanpa melakukan format ulang.\n\n[h5]EXT4 (4th Extended)[/h5]\nExt4 dirilis secara komplit dan stabil berawal dari kernel 2.6.28 jadi apabila distro anda yang secara default memiliki versi kernel tersebuat atau di atas nya otomatis system anda sudah support ext4 (dengan catatan sudah di include kedalam kernelnya) selain itu versi e2fsprogs harus mengunakan versi 1.41.5 atau lebih.\nApabila anda masih menggunakan fs ext3 dapat mengkonversi ke ext4 dengan beberapa langkah yang tidak terlalu rumit.\nKeuntungan yang bisa didapat dengan mengupgrade filesystem ke ext4 dibanding ext3 adalah mempunyai pengalamatan 48-bit block yang artinya dia akan mempunyai 1EB = 1,048,576 TB ukuran maksimum filesystem dengan 16 TB untuk maksimum file size nya,Fast fsck,Journal checksumming,Defragmentation support.\n\n[span class="instructions"][h5]Instructions[/h5]\neksekusi [code]y[/code] untuk melanjutkan[/span]', 'hint en', 'eksekusi command [code]y[/code] untuk melanjutkan', 'y', '', 'posted', '2015-02-28 09:44:08'),
(51, 9, 35, 'History', 'Smart history on Linux Shell', '15', 'case en', 'History diadaptasi dari C-shell (csh), yaitu pencatatan dari semua instruksi yang telah dilakukan. History dapat dipilih kembali dan perintah yang dipilih dapat dijalankan kembali. Variabel yang berkenaan dengan besar history dari suatu sistem adalah variabel [pre]HISTSIZE[/pre] yang di-set dalam system wide environtment [pre]/etc/profile[/pre].\n\n[span class="instructions"][h5]Instructions[/h5]\nHistory bisa diakses dengan menggunakan command [code]history[/code].\nMaka history akan menampilkan semua command yangtelah dijalankan oleh user linux shell\n[/span]', 'hint en', 'Eksekusi dan pahami semua command yang ada didalam box instruksi untuk melanjutkan.', 'history', '', 'posted', '2015-03-06 11:14:32'),
(52, 9, 36, 'bash Scripting', 'Knowing bash scripting and how to use it', '10', 'case en', '[h5]Bash Shell[/h5]\nSalah satu jenis shell yang paling umum digunakan adalah BASH (Bourne-Again Shell) yang diciptakan oleh Bryan Fox pada tahun 1988. Shell ini merupakan pengganti dari Bourne Shell (sh) yang sudah ada lebih dahulu dan masih digunakan pada beberapa distribusi Linux. Saat ini BASH sudah menjadi shell de facto untuk hampir semua distribusi Linux karena dianggap paling kaya fitur serta memiliki tingkat portabilitas yang cukup tinggi. Untuk perbandingan antar varian shell bisa dilihat pada situs Wikipedia [a href="https://en.wikipedia.org/wiki/Comparison_of_command_shells" target="_blank"]-wikipedia-[/a]\n\nHistory bisa diakses dengan menggunakan command [code]history[/code].\nseperti biasa langkah awal untuk belajar shell scripting adalah menampilkan tampilan ke layar.\nJalankan shell dibawah ini untuk melanjutkan ke step berikutnya\n\n[span class="instructions"][h5]Instructions[/h5]\n[code]echo ''hello world''[/code].\n\nketahui semua option yang tersedia untuk command ''echo'' dengan mambaca di [code]man echo[/code]\n\nKemudian jalankan beberapa modifikasi dari echo untuk menampilkan karakter tertentu dilayar.\n[code]echo ''line1 \\n line2''[/code], menambah spasi bari dengan ''\\n''.\n[/span]', 'hint en', 'jalankan semua perintah yang ada di dalam kota instruksi untuk melanjutkan ke step berikutnya', 'echo ''hello world'':echo ''line1 \\n line2'':man echo', '', 'posted', '2015-03-07 12:03:52');

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
  `status` enum('posted','locked') NOT NULL,
  PRIMARY KEY (`id_discuss`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`id_discuss`, `title`, `content`, `postdate`, `updatedate`, `id_user`, `type`, `views`, `status`) VALUES
(1, 'Change Directory then Execute Files', 'i''m confused on materi : Linux Shell, level 2\nchange to directory then execute file.\nso this my case :\nrecent directory [code]/home/user[/code]\nfile location\n[code]/home/user/programs/myprogram.sh[/code]', '2014-12-25 00:00:00', '2015-01-02 04:10:35', 2, 'ask', 23, 'locked'),
(7, 'How to make Linux to TV', 'sdfsdfsd', '2014-12-30 03:24:51', '2014-12-30 03:24:51', 2, 'thread', 0, 'posted'),
(8, 'Tannya', '[code]jfkdfj;lasdjf;lkasd[/code]....\n\n[ppppp]ljdslfkja;ldsj[pppp]', '2015-02-12 10:31:47', '2015-02-12 10:31:47', 2, 'ask', 0, 'posted');

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
  `status` enum('posted','locked') NOT NULL,
  PRIMARY KEY (`id_comment`),
  KEY `id_discussion` (`id_discussion`,`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `discussion_comment`
--

INSERT INTO `discussion_comment` (`id_comment`, `id_discussion`, `id_user`, `commentdate`, `updatedate`, `comment`, `status`) VALUES
(4, 1, 2, '2015-02-20 02:56:55', '2015-02-20 02:56:55', 'test', 'posted'),
(5, 7, 6, '2015-03-16 11:07:53', '2015-03-16 11:07:53', 'komentar', 'posted');

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

--
-- Dumping data for table `discussion_comment_action`
--

INSERT INTO `discussion_comment_action` (`id_comment`, `id_user`, `give`) VALUES
(4, 2, 'down'),
(5, 6, 'up');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `id_materi`, `level`, `title`, `description`) VALUES
(1, 1, 1, 'Knowing Linux', 'introduction to the history of Linux, components and excess'),
(3, 2, 1, 'Shell', 'Working with Linux shell'),
(4, 2, 2, 'File And Directory Management', 'manajemen file dan direktori di Linux'),
(5, 2, 3, 'Process Management', 'Manage process on linux'),
(6, 2, 4, 'Boot Processes Management', 'Boot Processes Management'),
(7, 2, 5, 'System Administration', 'System Administration'),
(8, 2, 6, 'Storage Management', 'Storage Management'),
(9, 2, 7, 'Shell scripting', 'Shell scripting'),
(12, 3, 1, 'linkstart', 'bla bla'),
(13, 3, 1, 'startto', 'bla bla'),
(14, 5, 1, 'Level 1 Testing Materi', 'Level 1 Testing Materi'),
(15, 5, 2, 'Level 2 Testing Materi', 'Level 2 testing Materi');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `ls_dir`
--

INSERT INTO `ls_dir` (`id_ls_dir`, `id_available_dir`, `type`, `name`, `attributes`, `content`) VALUES
(3, 7, '-', '.hiddenname', 'rwx--x--x:0|admin|linuxourse|7000|1Jan2015|24:00', 'this is hidden file'),
(7, 10, '-', 'vmlinuz-3.16.0-30-generic', 'rwx--x--x:0 admin linuxourse 7000 1Jan2015 24:00', 'you can''t read this file'),
(8, 11, '-', 'version', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', 'Linux version 3.16.0-30-generic (buildd@komainu) (gcc version 4.9.1 (Ubuntu 4.9.1-16ubuntu6) ) #40-Ubuntu SMP Mon Jan 12 22:06:37 UTC 2015\n'),
(9, 10, '-', 'vmlinuz-3.16.0-29-generic', 'rwx--x--x:0 admin linuxourse 7000 1Jan2015 24:00', 'this file can''t to read'),
(10, 12, '-', 'sources.list', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', '# deb cdrom:[Ubuntu 14.04 LTS _Trusty Tahr_ - Release amd64 (20140417)]/ trusty main restricted\n\n# See http://help.ubuntu.com/community/UpgradeNotes for how to upgrade to\n# newer versions of the distribution.\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic main restricted\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic main restricted\n\n## Major bug fix updates produced after the final release of the\n## distribution.\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-updates main restricted\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-updates main restricted\n\n## N.B. software from this repository is ENTIRELY UNSUPPORTED by the Ubuntu\n## team. Also, please note that software in universe WILL NOT receive any\n## review or updates from the Ubuntu security team.\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic universe\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic universe\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-updates universe\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-updates universe\n\n## N.B. software from this repository is ENTIRELY UNSUPPORTED by the Ubuntu \n## team, and may not be under a free licence. Please satisfy yourself as to \n## your rights to use the software. Also, please note that software in \n## multiverse WILL NOT receive any review or updates from the Ubuntu\n## security team.\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic multiverse\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic multiverse\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-updates multiverse\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-updates multiverse\n\n## N.B. software from this repository may not have been tested as\n## extensively as that contained in the main release, although it includes\n## newer versions of some applications which may provide useful features.\n## Also, please note that software in backports WILL NOT receive any review\n## or updates from the Ubuntu security team.\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-backports main restricted universe multiverse\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-backports main restricted universe multiverse\n\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-security main restricted\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-security main restricted\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-security universe\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-security universe\ndeb http://us.archive.ubuntu.com/ubuntu/ utopic-security multiverse\ndeb-src http://us.archive.ubuntu.com/ubuntu/ utopic-security multiverse\n\n## Uncomment the following two lines to add software from Canonical''s\n## ''partner'' repository.\n## This software is not part of Ubuntu, but is offered by Canonical and the\n## respective vendors as a service to Ubuntu users.\ndeb http://archive.canonical.com/ubuntu trusty partner\ndeb-src http://archive.canonical.com/ubuntu trusty partner\n\n## This software is not part of Ubuntu, but is offered by third-party\n## developers who want to ship their latest software.\ndeb http://extras.ubuntu.com/ubuntu utopic main\ndeb-src http://extras.ubuntu.com/ubuntu utopic main'),
(11, 7, '-', 'noeditfile', 'rwx--x--x:0 admin linuxourse 7000 1Jan2015 24:00', 'user cannot edit this file'),
(12, 3, '-', 'syslog.conf', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', '# /etc/syslog.conf\nConfiguration file for syslogd.\n#\n# For more information see syslog.conf(5)\n# manpage.\n#\n# First some standard logfiles.\n#\nauth,authpriv.*\n*.*;auth,authpriv.none\n#cron.*\ndaemon.*\nkern.*\nlpr.*\nmail.*\nuser.*\nuucp.*\n/var/log/auth.log\n-/var/log/syslog\n/var/log/cron.log\n-/var/log/daemon.log\n-/var/log/kern.log\n-/var/log/lpr.log\n/var/log/mail.log\n-/var/log/user.log\n-/var/log/uucp.log\n#\n# Logging for the mail system. Split it up so that\n# it is easy to write scripts to parse these files.\n#\nmail.info\n-/var/log/mail.info\nmail.warn\n-/var/log/mail.warn\nmail.err\n/var/log/mail.err\n# Logging for INN news system\n#\nnews.crit\nnews.err\nnews.notice\n#\n# Some ’catch-all’ logfiles.\n#\n*.=debug;\\\nauth,authpriv.none;\\\nnews.none;mail.none\n*.=info;*.=notice;*.=warn;\\\nauth,authpriv.none;\\\ncron,daemon.none;\\\nmail,news.none\n/var/log/news/news.crit\n/var/log/news/news.err\n-/var/log/news/news.notice\n-/var/log/debug\n-/var/log/messages\n#\n# Emergencies are sent to everybody logged in.\n#\n*.emerg\n*\n#\n# I like to have messages displayed on the console, but only on a virtual\n# console I usually leave idle.\n#\n#daemon,mail.*;\\\n#\nnews.=crit;news.=err;news.=notice;\\\n#\n*.=debug;*.=info;\\\n#\n*.=notice;*.=warn\n/dev/tty8\n# The named pipe /dev/xconsole is for the nsole’ utility. To use it,\n# you must invoke nsole’ with the -file’ option:\n#\n#\n$ xconsole -file /dev/xconsole [...]\n#\n# NOTE: adjust the list below, or you’ll go crazy if you have a reasonably\n#\nbusy site..\n#\ndaemon.*;mail.*;\\\nnews.crit;news.err;news.notice;\\\n*.=debug;*.=info;\\\n#\n*.emerg\n*\n#\n# I like to have messages displayed on the console, but only on a virtual\n# console I usually leave idle.\n#\n#daemon,mail.*;\\\n#\nnews.=crit;news.=err;news.=notice;\\\n#\n*.=debug;*.=info;\\\n#\n*.=notice;*.=warn\n/dev/tty8\n# The named pipe /dev/xconsole is for the nsole’ utility. To use it,\n# you must invoke nsole’ with the -file’ option:\n#\n#\n$ xconsole -file /dev/xconsole [...]\n#\n# NOTE: adjust the list below, or you’ll go crazy if you have a reasonably\n#\nbusy site..\n#\ndaemon.*;mail.*;\\\nnews.crit;news.err;news.notice;\\\n*.=debug;*.=info;\\\n#\n*.emerg\n*\n#\n# I like to have messages displayed on the console, but only on a virtual\n# console I usually leave idle.\n#\n#daemon,mail.*;\\\n#\nnews.=crit;news.=err;news.=notice;\\\n#\n*.=debug;*.=info;\\\n#\n*.=notice;*.=warn\n/dev/tty8\n# The named pipe /dev/xconsole is for the nsole’ utility. To use it,\n# you must invoke nsole’ with the -file’ option:\n#\n#\n$ xconsole -file /dev/xconsole [...]\n#\n# NOTE: adjust the list below, or you’ll go crazy if you have a reasonably\n#\nbusy site..\n#\ndaemon.*;mail.*;\\\nnews.crit;news.err;news.notice;\\\n*.=debug;*.=info;\\\n*.=notice;*.=warn\n|/dev/xconsole'),
(13, 3, '-', 'inittab', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', '# /etc/inittab: init(8) configuration.\n# $Id: inittab,v 1.8 1998/05/10 10:37:50 miquels Exp $\n# The default runlevel.\nid:2:initdefault:\n# Boot-time system configuration/initialization script.\n# This is run first except when booting in emergency (-b) mode.\nsi::sysinit:/etc/init.d/rcS\n# What to do in single-user mode.\n ? ?:S:wait:/sbin/sulogin\n#\n#\n#\n#\n#\n#\n#\n/etc/init.d executes the S and K scripts upon change\nof runlevel.\nRunlevel 0 is\nRunlevel 1 is\nRunlevels 2-5\nRunlevel 6 is\nhalt.\nsingle-user.\nare multi-user.\nreboot.\nl0:0:wait:/etc/init.d/rc 0\nl1:1:wait:/etc/init.d/rc 1\nl2:2:wait:/etc/init.d/rc 2\nl3:3:wait:/etc/init.d/rc 3\nl4:4:wait:/etc/init.d/rc 4\nl5:5:wait:/etc/init.d/rc 5\nl6:6:wait:/etc/init.d/rc 6\n# Normally not reached, but fallthrough in case of emergency.\nz6:6:respawn:/sbin/sulogin\n# What to do when CTRL-ALT-DEL is pressed.\n#ca:12345:ctrlaltdel:/sbin/shutdown -t1 -a -r now\nca:12345:ctrlaltdel:/root/ctrlaltdel\n# Action on special keypress (ALT-UpArrow).\nkb::kbrequest:/bin/echo "Keyboard Request--\nedit /etc/inittab to let this work."\n# What to do when the power fails/returns.\npf::powerwait:/etc/init.d/powerfail start\npn::powerfailnow:/etc/init.d/powerfail now\npo::powerokwait:/etc/init.d/powerfail stop\n# /sbin/getty invocations for the runlevels.\n#\n# The "id" field MUST be the same as the last\n# characters of the device (after "tty").\n#\n# Format:\n# <id>:<runlevels>:<action>:<process>\n1:2345:respawn:/sbin/getty 38400 tty1\n2:23:respawn:/sbin/getty 38400 tty2\n3:23:respawn:/sbin/getty 38400 tty3\n4:23:respawn:/sbin/getty 38400 tty4\n5:23:respawn:/sbin/getty 38400 tty5\n6:23:respawn:/sbin/getty 38400 tty6\n# Example how to put a getty on a serial line (for a terminal)\n#\n#T0:23:respawn:/sbin/getty -L ttyS0 9600 vt100\n#T1:23:respawn:/sbin/getty -L ttyS1 9600 vt100\n# Example how to put a getty on a modem line.\n#\n#T3:23:respawn:/sbin/mgetty -x0 -s 57600 ttyS3'),
(14, 3, '-', 'klog.conf', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', '#this is content of klog.conf'),
(15, 3, '-', 'passwd', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', 'root:x:0:0:root:/root:/bin/bash\ndaemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin\nbin:x:2:2:bin:/bin:/usr/sbin/nologin\nsys:x:3:3:sys:/dev:/usr/sbin/nologin\nsync:x:4:65534:sync:/bin:/bin/sync\nman:x:6:12:man:/var/cache/man:/usr/sbin/nologin\nadmin:x:1000:1000:admin,,,:/:/bin/bash'),
(16, 3, '-', 'shadow', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', 'root:x:0:0:root:/root:/bin/bash\ndaemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin\nbin:x:2:2:bin:/bin:/usr/sbin/nologin\nsys:x:3:3:sys:/dev:/usr/sbin/nologin\nsync:x:4:65534:sync:/bin:/bin/sync\nman:x:6:12:man:/var/cache/man:/usr/sbin/nologin\nadmin:x:1000:1000:admin,,,:/:/bin/bash'),
(17, 3, '-', 'group', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', 'root:x:0:\nstudent:x:0:'),
(18, 3, '-', 'passwd.bak', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', 'backup file of /etc/passwd'),
(19, 13, '-', 'examples.desktop', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', 'this is home drectory template'),
(20, 7, '-', '.bash_logout', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', '.bash_logout'),
(21, 7, '-', '.bash_profile', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', ''),
(22, 7, '-', '.bashrc', 'rwx--x--x:0 user user 7000 1Jan2015 24:00', '# ~/.bashrc: executed by bash(1) for non-login shells.\n# see /usr/share/doc/bash/examples/startup-files (in the package bash-doc)\n# for examples\n\n# If not running interactively, don''t do anything\ncase $- in\n    *i*) ;;\n      *) return;;\nesac\n\n# don''t put duplicate lines or lines starting with space in the history.\n# See bash(1) for more options\nHISTCONTROL=ignoreboth\n\n# append to the history file, don''t overwrite it\nshopt -s histappend\n\n# for setting history length see HISTSIZE and HISTFILESIZE in bash(1)\nHISTSIZE=1000\nHISTFILESIZE=2000\n\n# check the window size after each command and, if necessary,\n# update the values of LINES and COLUMNS.\nshopt -s checkwinsize\n\n# If set, the pattern "**" used in a pathname expansion context will\n# match all files and zero or more directories and subdirectories.\n#shopt -s globstar\n\n# make less more friendly for non-text input files, see lesspipe(1)\n[ -x /usr/bin/lesspipe ] && eval "$(SHELL=/bin/sh lesspipe)"\n\n# set variable identifying the chroot you work in (used in the prompt below)\nif [ -z "${debian_chroot:-}" ] && [ -r /etc/debian_chroot ]; then\n    debian_chroot=$(cat /etc/debian_chroot)\nfi\n\n# set a fancy prompt (non-color, unless we know we "want" color)\ncase "$TERM" in\n    xterm-color) color_prompt=yes;;\nesac\n\n# uncomment for a colored prompt, if the terminal has the capability; turned\n# off by default to not distract the user: the focus in a terminal window\n# should be on the output of commands, not on the prompt\n#force_color_prompt=yes\n\nif [ -n "$force_color_prompt" ]; then\n    if [ -x /usr/bin/tput ] && tput setaf 1 >&/dev/null; then\n	# We have color support; assume it''s compliant with Ecma-48\n	# (ISO/IEC-6429). (Lack of such support is extremely rare, and such\n	# a case would tend to support setf rather than setaf.)\n	color_prompt=yes\n    else\n	color_prompt=\n    fi\nfi\n\nif [ "$color_prompt" = yes ]; then\n    PS1=''${debian_chroot:+($debian_chroot)}\\[\\033[01;32m\\]\\u@\\h\\[\\033[00m\\]:\\[\\033[01;34m\\]\\w\\[\\033[00m\\]\\$ ''\nelse\n    PS1=''${debian_chroot:+($debian_chroot)}\\u@\\h:\\w\\$ ''\nfi\nunset color_prompt force_color_prompt\n\n# If this is an xterm set the title to user@host:dir\ncase "$TERM" in\nxterm*|rxvt*)\n    PS1="\\[\\e]0;${debian_chroot:+($debian_chroot)}\\u@\\h: \\w\\a\\]$PS1"\n    ;;\n*)\n    ;;\nesac\n\n# enable color support of ls and also add handy aliases\nif [ -x /usr/bin/dircolors ]; then\n    test -r ~/.dircolors && eval "$(dircolors -b ~/.dircolors)" || eval "$(dircolors -b)"\n    alias ls=''ls --color=auto''\n    #alias dir=''dir --color=auto''\n    #alias vdir=''vdir --color=auto''\n\n    alias grep=''grep --color=auto''\n    alias fgrep=''fgrep --color=auto''\n    alias egrep=''egrep --color=auto''\nfi\n\n# some more ls aliases\nalias ll=''ls -alF''\nalias la=''ls -A''\nalias l=''ls -CF''\n\n# Add an "alert" alias for long running commands.  Use like so:\n#   sleep 10; alert\nalias alert=''notify-send --urgency=low -i "$([ $? = 0 ] && echo terminal || echo error)" "$(history|tail -n1|sed -e ''\\''''s/^\\s*[0-9]\\+\\s*//;s/[;&|]\\s*alert$//''\\'''')"''\n\n# Alias definitions.\n# You may want to put all your additions into a separate file like\n# ~/.bash_aliases, instead of adding them here directly.\n# See /usr/share/doc/bash-doc/examples in the bash-doc package.\n\nif [ -f ~/.bash_aliases ]; then\n    . ~/.bash_aliases\nfi\n\n# enable programmable completion features (you don''t need to enable\n# this, if it''s already enabled in /etc/bash.bashrc and /etc/profile\n# sources /etc/bash.bashrc).\nif ! shopt -oq posix; then\n  if [ -f /usr/share/bash-completion/bash_completion ]; then\n    . /usr/share/bash-completion/bash_completion\n  elif [ -f /etc/bash_completion ]; then\n    . /etc/bash_completion\n  fi\nfi');

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
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_materi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `title`, `description`, `status`, `adddate`, `logo`) VALUES
(1, 'Introduce Linux', 'introduction to the history of Linux, components and excess', 'published', '2014-12-31 05:00:00', 'introduce logo.png'),
(2, 'Linux Shell and Command', 'learn linux from the basic commands to shell scripting', 'published', '2015-01-01 03:15:47', 'terminal logo.png'),
(3, 'Linux Networking', 'Learn Linux networking configuration', 'published', '2015-01-09 04:26:35', 'network logo.png'),
(5, 'Testing Materi', 'Materi For Testing', 'published', '2015-01-29 05:00:01', '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_user` int(20) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `postdate` datetime NOT NULL,
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('published','draft') NOT NULL,
  PRIMARY KEY (`id_news`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `id_user`, `title`, `content`, `postdate`, `updatedate`, `status`) VALUES
(1, 1, 'About', 'About e-course', '2014-12-14 20:35:10', '2015-01-31 03:42:33', 'published'),
(2, 1, 'Help', 'help content', '2014-12-14 20:35:20', '2015-01-31 03:42:47', 'published'),
(3, 1, 'Terms And Conditions', 'Sebelum mengikuti kursus, diharapkan untuk membaca beberapa terms and conditions dibawah ini :\n\nShell yang digunakan pada kursus online ini berbasis distro Linux Debian.\n\nKasus dan soal 100% dikerjakan oleh anda sendiri, tanpa campur tangan dari pihak manapun.\n\nPenilaian berdasarkan waktu yang anda butuhkan untuk memecahkan kasus/soal menggunakan Linux Shell.\n\nJika penyelesaian materi sudah 100%, maka anda langsung bisa mendapatkan sertifikat sesuai dengan materi dan nilai yang didapat.\n\nada pertanyaan kontak ke faq@linuxourse.com', '2014-12-14 20:35:32', '2015-03-06 02:22:58', 'published'),
(4, 1, 'Locked Content', 'Locked status ditunjukan untuk konsen diskusi dan comment yang telah dibuat user, Locked diberikan karena konten tersebut dianggap pernah di post oleh user/waktu yang lain atau mengandung konten sara, porngrafi atau melanggar Undang-Undang di Indonesia. Konten yang di locked secara otomatis akan terhapus dalam waktu 1x24 jam kecuali dilakukan perubahan isi dari konten, hingga tidak mendapatkan status locked', '2014-12-14 20:35:32', '2015-02-24 23:49:12', 'published'),
(5, 1, 'FAQ', '[strong]Apakah bisa mendapatkan sertifikat setelah menyelesaikan kursus online?[/strong]\nBisa, sertifikat bisa didapatkan setiap menyelesaikan materi pada kursus online secara langasung.', '2014-12-14 20:35:32', '2015-02-25 05:22:51', 'published'),
(6, 1, 'Start Course', 'Beberapa hal yang perlu disiapkan untuk memulai kursus. Kursus hanya boleh iikuti oleh member yang terdaftar.\n\n[strong]Materi Wajib[/strong] yang diikuti oleh member secara otomatis adalah "Introduce Linux", untuk selanjutnya member dapat memilih materi kursus lain sesuai dengan minatnya.\n\n[strong]Sertifikat[/strong] secara langsung diberikan dalam bentuk PDF ketika member telah menyelesaikan salah satu materi kursus. Sertifikat bisa saja hilang ketka terjadi penambahan kasus/soal pada materi yang telah selesai dikerjakan.', '2014-12-14 20:35:32', '2015-02-24 23:52:55', 'published'),
(7, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(8, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(9, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(10, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(11, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(12, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(13, 1, 'contoh', 'contoh', '2014-12-14 20:35:46', '2015-01-31 03:42:47', 'published'),
(14, 1, 'contoh', 'contoh', '2014-12-14 20:35:47', '2015-01-31 03:42:47', 'published'),
(15, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(16, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(17, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(18, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(19, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(20, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(21, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(22, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(23, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(24, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(25, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published'),
(26, 1, 'contoh', 'contoh', '2014-12-14 20:35:49', '2015-01-31 03:42:47', 'published');

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE IF NOT EXISTS `signature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL,
  `name` varchar(200) NOT NULL,
  `signature` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `signature`
--

INSERT INTO `signature` (`id`, `startdate`, `enddate`, `name`, `signature`) VALUES
(1, '2014-05-01 00:00:00', '2015-04-30 00:00:00', 'Zaenul Fatah Muharrom', 'zaenul.gif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `id_country` int(11) DEFAULT '3',
  `register_date` datetime NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` text NOT NULL,
  `level` enum('student') NOT NULL,
  `status` enum('waiting','active','banned') NOT NULL,
  `pp` text NOT NULL,
  `about` varchar(200) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id_country` (`id_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `fullname`, `id_country`, `register_date`, `last_login`, `password`, `level`, `status`, `pp`, `about`, `verified`) VALUES
(2, 'yussan', 'yusuf@kompetisi.id', 'Yusuf Akhsan Hidayat', 1, '2014-11-26 00:00:00', '2015-03-16 04:05:04', 'be71a8e61b64f613366380071fae3b38', 'student', 'active', 'cd790f1e7cfb7eef1fe75a2e5a25fc34.jpg', 'happy command', 1),
(6, 'lisa', 'lisa@japan.jp', 'Risa Oribe', 1, '2015-01-14 11:36:02', '2015-03-16 04:05:04', 'be71a8e61b64f613366380071fae3b38', 'student', 'active', 'lisa.jpg', 'prety linuxer', 1),
(19, 'lucy', 'yussandeveloper@gmail.com', 'Lucy Airgard', 3, '2015-03-05 10:45:48', '2015-03-16 04:05:04', 'be71a8e61b64f613366380071fae3b38', 'student', 'active', '08ca6985c149142b0813f540731ced35.jpg', '', 1),
(20, 'ahmadfuad', 'ahmad.fuad1945@gmail.com', 'Ahmad Fuad', 3, '2015-03-09 03:26:55', '2015-03-16 04:05:04', 'be71a8e61b64f613366380071fae3b38', 'student', 'active', '', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_badge`
--

INSERT INTO `user_badge` (`id_user_badge`, `id_user`, `id_badge`, `getdate`) VALUES
(1, 6, 1, '2015-03-15 19:58:23'),
(2, 19, 1, '2015-03-15 23:02:23');

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
  `finishtime` text NOT NULL,
  `status` enum('incomplete','completed') NOT NULL,
  PRIMARY KEY (`id_user_course`),
  KEY `id_user` (`id_user`),
  KEY `id_course` (`id_course`),
  KEY `id_materi` (`id_materi`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id_user_course`, `id_user`, `id_materi`, `id_level`, `id_course`, `startdate`, `lastdate`, `finishtime`, `status`) VALUES
(2, 2, 1, 1, 6, '2014-12-13 03:57:44', '2015-03-06 12:00:51', '{"1":3,"2":3,"3":5,"4":5,"5":4,"6":5}', 'completed'),
(8, 2, 2, 9, 52, '2014-12-22 02:37:18', '2015-03-15 11:36:18', '{"21":1,"9":2,"10":10,"11":4,"20":6,"27":8,"28":5,"29":4,"30":7,"31":12,"32":7,"33":10,"34":10,"35":7,"36":7,"37":5,"38":7,"39":7,"40":5,"41":12,"42":9,"43":8,"44":12,"45":14,"46":27,"13":2,"14":7,"47":1,"48":15,"15":1,"49":1,"50":3,"51":0,"12":2,"16":7,"52":0}', 'completed'),
(19, 6, 2, 3, 30, '2015-03-06 09:37:27', '2015-03-16 02:38:55', '{"21":1,"9":0,"10":1,"11":0,"20":0,"27":1,"28":0,"29":1,"30":6,"31":2}', 'incomplete'),
(20, 6, 5, 15, 26, '2015-03-06 09:57:32', '2015-03-06 14:58:21', '{"23":1,"25":0,"24":0,"26":0}', 'completed'),
(21, 19, 5, 15, 26, '2015-03-07 06:59:21', '2015-03-06 23:59:50', '{"23":1,"25":0,"24":0,"26":0}', 'completed'),
(22, 6, 1, 1, 6, '2015-03-15 07:58:23', '2015-03-15 12:59:38', '{"1":1,"2":0,"3":0,"4":0,"5":0,"6":0}', 'completed'),
(23, 19, 1, 1, 1, '2015-03-15 11:02:23', '2015-03-15 04:02:23', '', '');

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
  `status` enum('active','banned') NOT NULL,
  `registerdate` datetime NOT NULL,
  `loginlog` text NOT NULL,
  PRIMARY KEY (`id_user_manage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_manage`
--

INSERT INTO `user_manage` (`id_user_manage`, `username`, `password`, `fullname`, `pp`, `email`, `level`, `status`, `registerdate`, `loginlog`) VALUES
(1, 'yussan', 'be71a8e61b64f613366380071fae3b38', 'Yusuf A.H', '', 'yusuf.hi@students.amikom.ac.id', 'admin', 'active', '2015-01-19 22:45:04', '|2015-01-19 04:46:54|2015-01-20 02:55:20|2015-01-20 05:45:03|2015-01-20 04:06:11|2015-01-21 02:21:50|2015-01-21 08:19:03|2015-01-21 10:59:23|2015-01-22 04:32:22|2015-01-22 05:16:37|2015-01-22 12:47:39|2015-01-23 02:48:04|2015-01-24 02:54:49|2015-01-24 05:14:21|2015-01-26 02:49:46|2015-01-27 10:47:54|2015-01-27 12:58:40|2015-01-28 01:27:12|2015-01-29 11:39:54|2015-01-30 12:08:36|2015-01-30 08:57:02|2015-01-30 12:35:27|2015-01-30 03:41:45|2015-01-31 03:22:20|2015-01-31 05:16:00|2015-01-31 08:31:57|2015-01-31 10:02:34|2015-02-01 02:16:01|2015-02-03 06:52:46|2015-02-05 11:40:12|2015-02-06 10:43:37|2015-02-06 08:05:12|2015-02-07 08:05:46|2015-02-08 05:34:37|2015-02-10 12:07:58|2015-02-11 11:40:31|2015-02-12 06:43:44|2015-02-13 09:51:38|2015-02-13 05:45:19|2015-02-14 11:26:12|2015-02-16 10:08:08|2015-02-16 01:46:23|2015-02-16 06:34:16|2015-02-18 11:59:06|2015-02-19 12:03:54|2015-02-21 08:07:35|2015-02-21 08:38:09|2015-02-22 08:53:51|2015-02-23 08:58:21|2015-02-24 08:03:33|2015-02-24 11:05:51|2015-02-24 07:15:26|2015-02-25 12:21:16|2015-02-25 06:46:25|2015-02-25 07:54:57|2015-02-25 08:32:10|2015-02-25 08:42:44|2015-02-25 09:26:58|2015-02-25 06:35:47|2015-02-25 09:49:53|2015-02-26 07:15:59|2015-02-26 08:40:04|2015-02-27 07:33:00|2015-02-28 09:24:28|2015-03-01 08:31:51|2015-03-01 10:36:53|2015-03-01 10:58:52|2015-03-01 11:10:46|2015-03-01 01:05:17|2015-03-01 03:38:15|2015-03-06 09:18:28|2015-03-06 09:18:33|2015-03-06 09:18:39|2015-03-06 09:19:08|2015-03-06 09:20:05|2015-03-06 09:20:30|2015-03-06 06:18:47|2015-03-07 12:03:21|2015-03-09 10:48:17|2015-03-09 11:36:00|2015-03-09 11:56:02|2015-03-15 06:24:12|2015-03-16 09:41:09');

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
-- Constraints for table `certivicate`
--
ALTER TABLE `certivicate`
  ADD CONSTRAINT `certivicate_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_manage` (`id_user_manage`) ON DELETE SET NULL ON UPDATE SET NULL;

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
