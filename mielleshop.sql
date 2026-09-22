-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2026 at 06:35 AM
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
-- Database: `db_tokoshinta`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `metode` enum('cod','transfer') NOT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `nomor_rekening` varchar(100) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_verifikasi` enum('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `kode_pesanan` varchar(30) NOT NULL,
  `nama_pelanggan` varchar(150) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `catatan` text DEFAULT NULL,
  `metode_pembayaran` enum('cod','transfer') NOT NULL,
  `status_pembayaran` enum('menunggu','dibayar','dikonfirmasi') NOT NULL DEFAULT 'menunggu',
  `status_pesanan` enum('baru','diproses','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'baru',
  `lokasi_terakhir` varchar(255) DEFAULT 'Toko Mielle Accessories - Simpang Lima, Semarang',
  `total_harga` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `status_stok` enum('tersedia','out_of_order','sold_out') NOT NULL DEFAULT 'tersedia',
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `stok`, `status_stok`, `gambar`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kalung Rantai Minimalis Gold', 35000, 15, 'tersedia', 'Kalung Rantai Minimalis Gold.jpg', 'Kalung dengan desain rantai minimalis berwarna gold yang cocok digunakan untuk gaya sehari-hari maupun acara santai.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(2, 1, 'Kalung Pendant Hati', 28000, 20, 'tersedia', 'Kalung Pendant Hati.jpg', 'Kalung dengan liontin berbentuk hati yang memberikan kesan manis dan feminin. Cocok sebagai aksesori harian atau hadiah.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(3, 1, 'Kalung Mutiara Elegan', 45000, 9, 'tersedia', 'Kalung Mutiara Elegan.jpg', 'Kalung dengan detail mutiara yang memberikan tampilan anggun dan elegan untuk berbagai kesempatan.', '2026-09-20 13:12:38', '2026-09-20 06:43:53'),
(4, 1, 'Kalung Layering Simple', 39000, 12, 'tersedia', 'Kalung Layering Simple.jpg', 'Kalung dengan desain bertingkat yang cocok dipadukan dengan berbagai outfit casual maupun semi-formal.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(5, 1, 'Kalung Butterfly Charm', 32000, 18, 'tersedia', 'Kalung Butterfly Charm.jpg', 'Kalung dengan liontin kupu-kupu yang memberikan kesan cute dan stylish untuk penampilan sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(6, 2, 'Gelang Rantai Gold Minimalis', 27000, 16, 'tersedia', 'Gelang Rantai Gold Minimalis.jpg', 'Gelang rantai berwarna gold dengan desain sederhana yang mudah dipadukan dengan berbagai outfit.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(7, 2, 'Gelang Manik Pastel', 22000, 25, 'tersedia', 'Gelang Manik Pastel.jpg', 'Gelang dari manik-manik warna pastel dengan tampilan ceria dan cute untuk melengkapi gaya sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(8, 2, 'Gelang Charm Bintang', 30000, 14, 'tersedia', 'Gelang Charm Bintang.jpg', 'Gelang dengan hiasan charm berbentuk bintang yang memberikan sentuhan unik dan manis pada pergelangan tangan.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(9, 2, 'Gelang Mutiara Simple', 38000, 11, 'tersedia', 'Gelang Mutiara Simple.jpg', 'Gelang dengan kombinasi mutiara kecil yang memberikan kesan elegan namun tetap cocok digunakan sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(10, 2, 'Gelang Rantai Silver', 26000, 19, 'tersedia', 'Gelang Rantai Silver.jpg', 'Gelang berwarna silver dengan model rantai sederhana yang cocok untuk gaya casual dan minimalis.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(11, 3, 'Anting Stud Bunga', 18000, 22, 'tersedia', 'Anting Stud Bunga.jpg', 'Anting kecil berbentuk bunga dengan desain simpel yang cocok digunakan untuk aktivitas sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(12, 3, 'Anting Hoop Mini Gold', 25000, 17, 'tersedia', 'Anting Hoop Mini Gold.jpg', 'Anting model hoop berukuran mini dengan warna gold yang memberikan kesan modern dan elegan.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(13, 3, 'Anting Mutiara Drop', 35000, 13, 'tersedia', 'Anting Mutiara Drop.jpg', 'Anting dengan detail mutiara yang menjuntai lembut dan cocok digunakan untuk acara spesial.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(14, 3, 'Anting Butterfly Cute', 23000, 20, 'tersedia', 'Anting Butterfly Cute.jpg', 'Anting dengan bentuk kupu-kupu yang memberikan tampilan manis dan feminin.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(15, 3, 'Anting Star Stud', 19000, 24, 'tersedia', 'Anting Star Stud.jpg', 'Anting kecil berbentuk bintang yang cocok untuk kamu yang menyukai aksesori simpel dan cute.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(16, 4, 'Cincin Adjustable Gold', 24000, 18, 'tersedia', 'Cincin Adjustable Gold.jpg', 'Cincin berwarna gold dengan ukuran adjustable sehingga mudah disesuaikan dengan ukuran jari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(17, 4, 'Cincin Heart Minimalis', 21000, 21, 'tersedia', 'Cincin Heart Minimalis.jpg', 'Cincin dengan detail hati kecil yang memberikan kesan romantis dan sederhana.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(18, 4, 'Cincin Silver Simple', 23000, 16, 'tersedia', 'Cincin Silver Simple.jpg', 'Cincin warna silver dengan desain minimalis yang cocok digunakan sendiri maupun dipadukan dengan cincin lainnya.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(19, 4, 'Cincin Pearl Ring', 29000, 13, 'tersedia', 'Cincin Pearl Ring.jpg', 'Cincin dengan aksen mutiara kecil yang memberikan tampilan feminin dan elegan.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(20, 4, 'Cincin Butterfly Adjustable', 26000, 15, 'tersedia', 'Cincin Butterfly Adjustable.jpg', 'Cincin dengan ornamen kupu-kupu dan ukuran yang dapat disesuaikan untuk penggunaan yang nyaman.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(21, 5, 'Jepit Rambut Butterfly', 15000, 30, 'tersedia', 'Jepit Rambut Butterfly.jpg', 'Jepit rambut dengan desain kupu-kupu yang memberikan tampilan cute dan menarik pada rambut.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(22, 5, 'Jepit Rambut Pearl', 17000, 25, 'tersedia', 'Jepit Rambut Pearl.jpg', 'Jepit rambut dengan hiasan mutiara yang cocok digunakan untuk acara formal maupun casual.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(23, 5, 'Jepit Rambut Ribbon', 16000, 28, 'tersedia', 'Jepit Rambut Ribbon.jpg', 'Jepit rambut dengan aksen pita yang memberikan kesan manis dan feminin.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(24, 5, 'Jepit Rambut Flower', 14000, 32, 'tersedia', 'Jepit Rambut Flower.jpg', 'Jepit rambut berbentuk bunga dengan desain cantik yang cocok untuk melengkapi gaya sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(25, 5, 'Jepit Rambut Minimalis Matte', 12000, 35, 'tersedia', 'Jepit Rambut Minimalis Matte.jpg', 'Jepit rambut dengan warna matte dan desain sederhana yang cocok untuk penggunaan sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(26, 6, 'Scrunchie Satin Pink', 13000, 35, 'tersedia', 'Scrunchie Satin Pink.jpg', 'Scrunchie berbahan satin dengan warna pink lembut yang memberikan kesan feminin dan elegan.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(27, 6, 'Scrunchie Pastel Collection', 15000, 30, 'tersedia', 'Scrunchie Pastel Collection.jpg', 'Scrunchie dengan pilihan warna pastel yang cocok dipadukan dengan berbagai gaya outfit.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(28, 6, 'Scrunchie Motif Bunga', 14000, 27, 'tersedia', 'Scrunchie Motif Bunga.jpg', 'Scrunchie dengan motif bunga yang memberikan tampilan ceria dan cute pada rambut.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(29, 6, 'Scrunchie Velvet Brown', 18000, 20, 'tersedia', 'Scrunchie Velvet Brown.jpg', 'Scrunchie berbahan velvet dengan warna cokelat yang memberikan kesan hangat dan elegan.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(30, 6, 'Scrunchie Ribbon Cream', 19000, 23, 'tersedia', 'Scrunchie Ribbon Cream.jpg', 'Scrunchie dengan tambahan pita warna cream yang cocok untuk tampilan manis dan feminin.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(31, 7, 'Bros Bunga Pearl', 22000, 18, 'tersedia', 'Bros Bunga Pearl.jpg', 'Bros berbentuk bunga dengan aksen mutiara yang cocok digunakan pada hijab, pakaian, atau tas.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(32, 7, 'Bros Butterfly Gold', 25000, 15, 'tersedia', 'Bros Butterfly Gold.jpg', 'Bros berbentuk kupu-kupu dengan warna gold yang memberikan sentuhan elegan pada penampilan.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(33, 7, 'Bros Pita Cute', 18000, 20, 'tersedia', 'Bros Pita Cute.jpg', 'Bros dengan desain pita yang cocok untuk menambahkan aksen manis pada outfit.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(34, 7, 'Bros Mutiara Elegan', 30000, 12, 'tersedia', 'Bros Mutiara Elegan.jpg', 'Bros dengan detail mutiara yang memberikan kesan klasik dan anggun untuk berbagai acara.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(35, 7, 'Bros Daisy Mini', 17000, 24, 'tersedia', 'Bros Daisy Mini.jpg', 'Bros kecil berbentuk bunga daisy yang cocok digunakan sebagai aksesori tambahan pada pakaian atau tas.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(36, 8, 'Headband Satin Simple', 25000, 17, 'tersedia', 'Headband Satin Simple.jpg', 'Headband berbahan satin dengan desain sederhana yang nyaman digunakan dan cocok untuk berbagai aktivitas.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(37, 8, 'Bandana Floral Cute', 23000, 19, 'tersedia', 'Bandana Floral Cute.jpg', 'Bandana dengan motif floral yang memberikan tampilan fresh dan feminin.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(38, 8, 'Hair Ribbon Pastel', 16000, 26, 'tersedia', 'Hair Ribbon Pastel.jpg', 'Pita rambut dengan warna pastel yang cocok digunakan untuk mempercantik gaya rambut sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(39, 8, 'Hair Claw Flower', 20000, 22, 'tersedia', 'Hair Claw Flower.jpg', 'Jepit rambut model claw dengan desain bunga yang praktis digunakan untuk menata rambut.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(40, 8, 'Headband Knot Korea', 28000, 14, 'tersedia', 'Headband Knot Korea.jpg', 'Headband dengan model knot yang memberikan kesan stylish dan cocok untuk gaya casual.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(41, 9, 'Keychain Teddy Bear', 18000, 25, 'tersedia', 'Keychain Teddy Bear.jpg', 'Gantungan kunci berbentuk boneka teddy bear dengan desain lucu yang cocok dipasang pada tas atau kunci.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(42, 9, 'Keychain Butterfly Acrylic', 15000, 30, 'tersedia', 'Keychain Butterfly Acrylic.jpg', 'Gantungan kunci berbahan acrylic dengan motif kupu-kupu yang ringan dan cantik.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(43, 9, 'Keychain Heart Pink', 14000, 28, 'tersedia', 'Keychain Heart Pink.jpg', 'Gantungan kunci berbentuk hati berwarna pink yang cocok sebagai aksesori tas maupun hadiah kecil.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(44, 9, 'Keychain Flower Beads', 20000, 21, 'tersedia', 'Keychain Flower Beads.jpg', 'Gantungan kunci dengan rangkaian manik-manik berbentuk bunga yang memberikan tampilan colorful dan cute.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(45, 9, 'Keychain Initial Letter', 17000, 23, 'tersedia', 'Keychain Initial Letter.jpg', 'Gantungan kunci dengan huruf inisial yang dapat digunakan sebagai aksesori personal pada tas atau kunci.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(46, 10, 'Phone Charm Pearl', 22000, 20, 'tersedia', 'Phone Charm Pearl.jpg', 'Aksesori tali manik-manik dengan detail mutiara yang dapat dipasang pada ponsel untuk mempercantik tampilannya.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(47, 10, 'Bag Charm Ribbon', 24000, 18, 'tersedia', 'Bag Charm Ribbon.jpg', 'Hiasan tas dengan desain pita yang memberikan sentuhan cute dan feminin pada tas favoritmu.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(48, 10, 'Cermin Mini Pocket', 15000, 25, 'tersedia', 'Cermin Mini Pocket.jpg', 'Cermin kecil berukuran praktis yang mudah dibawa di dalam tas untuk kebutuhan sehari-hari.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(49, 10, 'Pouch Mini Pastel', 27000, 16, 'tersedia', 'Pouch Mini Pastel.jpg', 'Pouch berukuran kecil dengan warna pastel yang cocok digunakan untuk menyimpan aksesori atau barang-barang kecil.', '2026-09-20 13:12:38', '2026-09-20 13:12:38'),
(50, 10, 'Gelang Kaki Chain Simple', 29000, 14, 'tersedia', 'Gelang Kaki Chain Simple.jpg', 'Aksesori gelang kaki dengan desain rantai minimalis yang cocok digunakan untuk melengkapi gaya casual.', '2026-09-20 13:12:38', '2026-09-20 13:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `fk_detail_pesanan` (`id_pesanan`),
  ADD KEY `fk_detail_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_pembayaran_pesanan` (`id_pesanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `fk_detail_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
