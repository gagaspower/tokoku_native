-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2018 at 08:35 AM
-- Server version: 10.0.36-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ameliade_tokoku`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(10) NOT NULL,
  `nama_bank` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `rek_bank` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_pemilik` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`, `rek_bank`, `nama_pemilik`) VALUES
(2, 'gagas', '345456345634', 'gagas');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul` text COLLATE latin1_general_ci NOT NULL,
  `judul_seo` text COLLATE latin1_general_ci NOT NULL,
  `isi_berita` text COLLATE latin1_general_ci NOT NULL,
  `hari` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `dibaca` int(5) NOT NULL DEFAULT '1',
  `tag` text COLLATE latin1_general_ci NOT NULL,
  `meta_deskripsi` text COLLATE latin1_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `user_id`, `judul`, `judul_seo`, `isi_berita`, `hari`, `tanggal`, `jam`, `dibaca`, `tag`, `meta_deskripsi`) VALUES
(15, 11, 'React Native adalah salah satu framework', 'react-native-adalah-salah-satu-framework', '&lt;p&gt;Ya, React Native adalah salah satu framework javascript yang digunakan untuk mengembangkan aplikasi mobile. Jika dahulu kita mengenal Ionic Framework React Native, maka React Native sangat berbeda dengan Ionic karena dia memang ditujukan untuk membuat aplikasi mobile yang benar-benar real native sedangkan Ionic ditujukan untuk membuat aplikasi Web App.&lt;/p&gt;', 'Senin', '2018-07-30', '09:26:18', 120, 'tag-satu,tag-kedua', 'React Native adalah salah satu framework'),
(18, 11, 'Yang menjadi pemasalahan untuk', 'yang-menjadi-pemasalahan-untuk', '&lt;p&gt;Selamat malam teman-teman, malam ini saya akan share bagaimana sih cara upload file lebih dari 1 (satu) menggunakan &lt;strong&gt;Framework Codeigniter&lt;/strong&gt;, karena dalam membuat aplikasi terkadang kita membutuhkan CRUD (Create, read, Update, Delete) yang bisa &lt;em&gt;Multiple Insert &lt;/em&gt;&lt;/p&gt;', 'Senin', '2018-07-30', '09:25:55', 69, 'tag-satu', 'sdf asdf asd');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `hits` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id`, `judul`, `nama_file`, `tgl_posting`, `hits`) VALUES
(12, 'test', 'Bestseller_free_css_template.zip', '2018-07-28', 10);

-- --------------------------------------------------------

--
-- Table structure for table `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `id` int(10) NOT NULL,
  `nama_ekspedisi` varchar(50) DEFAULT NULL,
  `logo_ekspedisi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ekspedisi`
--

INSERT INTO `ekspedisi` (`id`, `nama_ekspedisi`, `logo_ekspedisi`) VALUES
(9, 'JNE', 'jne.jpg'),
(10, 'TIKI', 'tiki2.jpg'),
(11, 'POS INDONESIA', 'pos.jpg'),
(12, 'J&amp;T', 'jnt.jpg'),
(13, 'Agen Touna', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `halamanstatis`
--

CREATE TABLE `halamanstatis` (
  `id` int(5) NOT NULL,
  `judul` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `judul_seo` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `isi_halaman` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halamanstatis`
--

INSERT INTO `halamanstatis` (`id`, `judul`, `judul_seo`, `isi_halaman`, `tgl_posting`) VALUES
(4, 'halaman statis', 'halaman-statis', '&lt;p&gt;Menghilangkan index.php merupakan suatu tuntutan dalam &lt;a title=&quot;Lihat semua artikel tentang SEO di nyingspot.com&quot; href=&quot;https://www.nyingspot.com/?s=seo&quot; target=&quot;_blank&quot;&gt;SEO&lt;/a&gt; yaitu bagaimana cara membuat url yang rapih dan SEO &lt;em&gt;friendly&lt;/em&gt;. Sebagai seorang programmer tentu hal ini akan sangat sulit apabila terjadi kesalahan. Butuh &lt;em&gt;effort&lt;/em&gt; yang cukup lama dalam mengatasi masalah ini. Tapi untuk seorang Digital Marketer, tentu saja ini hal yang basic yang harus ditempuh untuk menjalankan strateginya.&lt;/p&gt;', '2018-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `hubungi`
--

CREATE TABLE `hubungi` (
  `id_hubungi` int(10) NOT NULL,
  `tgl_hubungi` date NOT NULL,
  `jam_hubungi` time NOT NULL,
  `nama_hubungi` varchar(25) NOT NULL,
  `email_hubungi` varchar(30) NOT NULL,
  `subjek_hubungi` varchar(50) DEFAULT NULL,
  `pesan_hubungi` text NOT NULL,
  `status_hubungi` varchar(10) NOT NULL DEFAULT 'Baru'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hubungi`
--

INSERT INTO `hubungi` (`id_hubungi`, `tgl_hubungi`, `jam_hubungi`, `nama_hubungi`, `email_hubungi`, `subjek_hubungi`, `pesan_hubungi`, `status_hubungi`) VALUES
(1, '2018-06-23', '16:02:51', 'gagas', 'gagas@email.com', '', 'askdjfa sdfasdf asdf', 'Baru');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int(5) NOT NULL,
  `nama_website` varchar(100) NOT NULL,
  `url_website` varchar(100) NOT NULL,
  `meta_deskripsi` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `logo` varchar(50) NOT NULL,
  `cache` enum('Y','N') DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `nama_website`, `url_website`, `meta_deskripsi`, `meta_keyword`, `logo`, `cache`) VALUES
(1, 'Tokoku', 'http://tokoku.yatoreh.com', 'deskripsi, deskripsi kedua', 'keyword, keyword,testing', 'logo.png', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(10) NOT NULL,
  `provinsi_id` int(10) DEFAULT NULL,
  `nama_kabupaten` varchar(191) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `provinsi_id`, `nama_kabupaten`) VALUES
(2, 2, 'Banyumas'),
(3, 2, 'Purbalingga'),
(4, 4, 'Kota Palu'),
(5, 4, 'Toli-Toli'),
(6, 0, 'Ampana');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(5) NOT NULL,
  `nama_kategori` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori_slug` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `kategori_slug`) VALUES
(6, 'Undangan', 'undangan'),
(7, 'Aksesoris', 'aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id` int(10) NOT NULL,
  `tgl_konfirmasi` date NOT NULL,
  `jam_konfirmasi` time NOT NULL,
  `id_orders` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_penyetor` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nominal` double NOT NULL,
  `bank_penyetor` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_bank` int(10) NOT NULL,
  `bukti_konfirmasi` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id`, `tgl_konfirmasi`, `jam_konfirmasi`, `id_orders`, `nama_penyetor`, `nominal`, `bank_penyetor`, `id_bank`, `bukti_konfirmasi`, `status`) VALUES
(1, '2018-08-08', '22:18:10', '20180808001', 'gagas power', 287500, 'gagsdfasdf', 2, '43cms.jpg', '99'),
(2, '2018-08-08', '22:20:52', '20180808809', 'gagas power', 2015000, 'testing', 2, '94image-compress.jpg', '99');

-- --------------------------------------------------------

--
-- Table structure for table `kustomer`
--

CREATE TABLE `kustomer` (
  `id` int(5) NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `nama_kustomer` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `alamat_kustomer` text COLLATE latin1_general_ci NOT NULL,
  `email_kustomer` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `provinsi_id_kustomer` int(10) DEFAULT NULL,
  `kabupaten_id_kustomer` int(10) DEFAULT NULL,
  `kodepos_kustomer` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `tanggal_registrasi_kustomer` date DEFAULT NULL,
  `aktif` enum('N','Y') COLLATE latin1_general_ci DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kustomer`
--

INSERT INTO `kustomer` (`id`, `password`, `nama_kustomer`, `alamat_kustomer`, `email_kustomer`, `provinsi_id_kustomer`, `kabupaten_id_kustomer`, `kodepos_kustomer`, `tanggal_registrasi_kustomer`, `aktif`) VALUES
(1, '$2a$16$YTxDjwxk7UGFsXicglznMuFhVquY4LQOVoRDQba5qPl/jvC.A5J1i', 'gagas power', 'Purwokerto', 'pahlitamanata@gmail.com', 2, 3, '53111', '2018-08-06', 'Y'),
(6, '$2a$16$fYKG3AsRQO2A1L4tRWEYpeR9e7dQz3YTjJZioYAtoZMr/Bs/Lk1rm', 'amelia puspita', 'testing testin', 'puspitaamelia67@gmail.com', 2, 3, '53772', '2018-08-08', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(5) NOT NULL,
  `nama_level` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `nama_level`) VALUES
(1, 'admin'),
(2, 'author');

-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE `mainmenu` (
  `id` int(5) NOT NULL,
  `nama_menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `posisi` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`id`, `nama_menu`, `link`, `aktif`, `posisi`) VALUES
(3, 'Tentang', 'pages/halaman-statis', 'Y', 'footer'),
(4, 'Hubungi', 'hubungi-kami', 'Y', 'footer'),
(8, 'Download', 'download', 'Y', 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `ongkos_kirim`
--

CREATE TABLE `ongkos_kirim` (
  `id` int(3) NOT NULL,
  `kabupaten_id` int(10) DEFAULT NULL,
  `ekspedisi_id` int(10) DEFAULT NULL,
  `ongkos` double(25,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkos_kirim`
--

INSERT INTO `ongkos_kirim` (`id`, `kabupaten_id`, `ekspedisi_id`, `ongkos`) VALUES
(2, 2, 10, 15000),
(3, 3, 9, 15000),
(4, 5, 11, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `status_order` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'Baru',
  `tgl_order` date NOT NULL,
  `jam_order` time NOT NULL,
  `id_kustomer` int(5) NOT NULL,
  `ekspedisi_id` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status_order`, `tgl_order`, `jam_order`, `id_kustomer`, `ekspedisi_id`) VALUES
('20180808001', 'Batal', '2018-08-08', '22:17:34', 1, 9),
('20180808809', 'Batal', '2018-08-08', '22:20:04', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_orders` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_produk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_orders`, `id_produk`, `jumlah`) VALUES
('20180808001', 6, 1),
('20180808809', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_temp`
--

CREATE TABLE `orders_temp` (
  `id_orders_temp` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `id_session` text COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tgl_order_temp` date NOT NULL,
  `jam_order_temp` time NOT NULL,
  `stok_temp` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orders_temp`
--

INSERT INTO `orders_temp` (`id_orders_temp`, `id_produk`, `id_session`, `jumlah`, `tgl_order_temp`, `jam_order_temp`, `stok_temp`) VALUES
(13, 6, 'admin@gmail.com', 1, '2018-10-04', '20:03:05', 8),
(14, 7, 'admin@gmail.com', 1, '2018-10-15', '13:58:34', 99);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `subjek` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `pesan` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phpmailer_seting`
--

CREATE TABLE `phpmailer_seting` (
  `id` int(5) NOT NULL,
  `host` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `port` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpmailer_seting`
--

INSERT INTO `phpmailer_seting` (`id`, `host`, `username`, `password`, `port`) VALUES
(1, 'smtp.gmail.com', 'pahlitamanata@gmail.com', 'gquqdqoasmxrrsvc', '587');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(5) NOT NULL,
  `kategori_id` int(5) NOT NULL,
  `user_id` int(10) NOT NULL,
  `nama_produk` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `produk_slug` varchar(191) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `deskripsi_produk` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `harga_produk` int(20) NOT NULL,
  `stok_produk` double(25,0) NOT NULL,
  `diskon_produk` int(25) DEFAULT NULL,
  `berat_produk` float DEFAULT NULL,
  `deskripsi_seo_produk` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `tag_produk` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `gambar_produk` varchar(191) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `dibeli` int(10) DEFAULT '0',
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `user_id`, `nama_produk`, `produk_slug`, `deskripsi_produk`, `harga_produk`, `stok_produk`, `diskon_produk`, `berat_produk`, `deskripsi_seo_produk`, `tag_produk`, `gambar_produk`, `dibeli`, `tanggal`) VALUES
(4, 6, 11, 'update input produk', 'update-input-produk', '&lt;p&gt;asdkfa sdf asdhf asdf asdasd&lt;/p&gt;', 190000, 99, 0, 1000, 'asdf asdf asdfasd fasd', 'tag-kedua,tag-keempat', '56product10.jpg', 1, '2018-08-04'),
(5, 6, 11, 'produk kedua', 'produk-kedua', '&lt;p&gt;asdf asdf asdfasdfasdfasdfas dfas&lt;/p&gt;', 150000, 0, 5, 3000, 'asdf asdfasdfasdfasdf asdfasdfa sdfasdfa sdf asdf asd', 'tag-satu,tag-ketiga', '52product8.jpg', 0, '2018-08-04'),
(6, 6, 11, 'Produk ketiga', 'produk-ketiga', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.&lt;/p&gt;', 250000, 8, 0, 2500, 'Lorem Ipsum is simply dummy text', 'tag-satu', '64product7.jpg', 2, '2018-08-04'),
(7, 6, 11, 'nama produk lagi', 'nama-produk-lagi', '&lt;p&gt;asdf asdfasdfasdf asdfasdfasdf asdfasdfasdf asdfasdfasdfasd&lt;/p&gt;', 90000, 99, 0, 1000, 'asdf asdfasdfasdf asdfasdfasdf asdfasdfasdf asdfasdfasdfasd', 'tag-satu', '30product2.jpg', 1, '2018-08-04'),
(8, 7, 11, 'Produk kelima', 'produk-kelima', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&lt;/p&gt;\r\n&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry.&lt;/p&gt;', 2500000, 89, 0, 2000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'tag kesati,tag kedua,tag ketiga,1,2,3,4,5,6,7', '49product18.jpg', 0, '2018-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(10) NOT NULL,
  `nama_provinsi` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama_provinsi`) VALUES
(2, 'Jawa Tengah'),
(3, 'Jawa Timur'),
(4, 'Sulawesi Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `serp_manage`
--

CREATE TABLE `serp_manage` (
  `id` int(5) NOT NULL,
  `google_verifikasi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `bing_verifikasi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `yandex_verifikasi` text CHARACTER SET latin1 COLLATE latin1_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serp_manage`
--

INSERT INTO `serp_manage` (`id`, `google_verifikasi`, `bing_verifikasi`, `yandex_verifikasi`) VALUES
(1, 'lkjhlkjho87089uhijh', 'jjlkjlkjhk8987098yoihho', 'asdfasdfasdfasdfas');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(5) NOT NULL,
  `main_id` int(10) DEFAULT NULL,
  `nama_sub` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link_sub` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `password` text COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level_id` int(5) NOT NULL,
  `blokir` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `nama_lengkap`, `email`, `level_id`, `blokir`) VALUES
(11, '$2a$16$juEvvfRxqXSssiGeVwoCoe4USQqtoSxR1.tWBvm22b9SgYNU7.HGO', 'new project', 'admin@gmail.com', 1, 'N'),
(18, '$2a$16$sPjL6rstBOlBGlFbOwHFhOh2U/IYW80T7nxtHsYvrJ6ljwr14x9EW', 'amelia pustpita', 'puspitaamelia67@gmail.com', 2, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `halamanstatis`
--
ALTER TABLE `halamanstatis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hubungi`
--
ALTER TABLE `hubungi`
  ADD PRIMARY KEY (`id_hubungi`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kustomer`
--
ALTER TABLE `kustomer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mainmenu`
--
ALTER TABLE `mainmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ongkos_kirim`
--
ALTER TABLE `ongkos_kirim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_orders_temp`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpmailer_seting`
--
ALTER TABLE `phpmailer_seting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serp_manage`
--
ALTER TABLE `serp_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
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
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `halamanstatis`
--
ALTER TABLE `halamanstatis`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hubungi`
--
ALTER TABLE `hubungi`
  MODIFY `id_hubungi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kustomer`
--
ALTER TABLE `kustomer`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mainmenu`
--
ALTER TABLE `mainmenu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ongkos_kirim`
--
ALTER TABLE `ongkos_kirim`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_temp`
--
ALTER TABLE `orders_temp`
  MODIFY `id_orders_temp` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phpmailer_seting`
--
ALTER TABLE `phpmailer_seting`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `serp_manage`
--
ALTER TABLE `serp_manage`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
