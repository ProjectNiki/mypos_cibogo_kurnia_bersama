-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Okt 2020 pada 09.51
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypos_cibogo_kurnia_bersama`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_pengurusan`
--

CREATE TABLE `biaya_pengurusan` (
  `pengurusan_id` int(6) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `fee_oprasional` bigint(20) DEFAULT NULL,
  `oprasional` bigint(20) DEFAULT NULL,
  `pajak_tax` bigint(20) DEFAULT NULL,
  `lab` bigint(20) DEFAULT NULL,
  `jasa_perushaan` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `user_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(6) NOT NULL,
  `items_id` int(6) DEFAULT NULL,
  `harga_items` bigint(20) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `user_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash_in_cash_out`
--

CREATE TABLE `cash_in_cash_out` (
  `cico_id` int(6) NOT NULL,
  `type` varchar(3) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pj` varchar(50) DEFAULT NULL,
  `payment` int(1) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `noted` text DEFAULT NULL,
  `created` time DEFAULT current_timestamp(),
  `user_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(6) NOT NULL,
  `name_categories` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_created` int(1) DEFAULT NULL,
  `user_updated` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`categories_id`, `name_categories`, `created`, `updated`, `user_created`, `user_updated`) VALUES
(1, 'Pakain Jadi', '2020-10-02 19:36:19', NULL, 1, NULL),
(2, 'Aksesoris', '2020-10-02 19:36:23', NULL, 1, NULL),
(3, 'Bahan', '2020-10-02 19:36:28', NULL, 1, NULL),
(4, 'Mesin', '2020-10-02 19:36:33', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customers_id` int(6) NOT NULL,
  `customers_key` varchar(6) DEFAULT NULL,
  `pt_customers` varchar(50) DEFAULT NULL,
  `inisial_pt` varchar(2) DEFAULT NULL,
  `name_customers` varchar(50) DEFAULT NULL,
  `gander_customers` int(1) DEFAULT NULL,
  `phone_customers` varchar(13) DEFAULT NULL,
  `email_customers` varchar(50) DEFAULT NULL,
  `address_customers` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_updated` int(1) DEFAULT NULL,
  `user_created` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `items_id` int(6) NOT NULL,
  `items_key` varchar(6) DEFAULT NULL,
  `name_items` varchar(128) DEFAULT NULL,
  `categories_id` int(6) DEFAULT NULL,
  `sub_categories_id` int(6) DEFAULT NULL,
  `harga_items` bigint(20) DEFAULT NULL,
  `qty_items` bigint(20) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_created` int(1) DEFAULT NULL,
  `user_updated` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(6) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `no_urut_invoice` varchar(50) DEFAULT NULL,
  `customers_id` int(6) DEFAULT NULL,
  `total_price` bigint(20) DEFAULT NULL,
  `cash` bigint(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `pembayaran_oprasional` int(1) DEFAULT NULL,
  `lunas_down_payment` int(1) DEFAULT NULL,
  `noted` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `user_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_detail`
--

CREATE TABLE `pembayaran_detail` (
  `detail_id` int(6) NOT NULL,
  `pembayaran_id` int(6) DEFAULT NULL,
  `items_id` int(128) DEFAULT NULL,
  `harga_items` bigint(20) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `pembayaran_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `pembayaran_detail` FOR EACH ROW BEGIN 
	UPDATE items SET qty_items = qty_items - NEW.qty 
    WHERE items_id = NEW.items_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_down_payment`
--

CREATE TABLE `pembayaran_down_payment` (
  `pembayaran_dp_id` int(6) NOT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `down_payment_id` varchar(128) DEFAULT NULL,
  `down_payment` bigint(20) DEFAULT NULL,
  `noted` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `user_id` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_id` int(6) NOT NULL,
  `items_id` int(6) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `qty_stock_in` bigint(20) DEFAULT NULL,
  `date` date DEFAULT current_timestamp(),
  `detail` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `user_created` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_out`
--

CREATE TABLE `stock_out` (
  `stock_out_id` int(6) NOT NULL,
  `items_id` int(6) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `qty_stock_out` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `user_created` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_categories_id` int(6) NOT NULL,
  `name_sub_categories` varchar(128) DEFAULT NULL,
  `categories_id` int(6) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_created` int(1) DEFAULT NULL,
  `user_updated` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(2) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `is_active` varchar(250) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `in` datetime DEFAULT NULL,
  `log` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `nama`, `email`, `alamat`, `password`, `is_active`, `level`, `in`, `log`, `ip`) VALUES
(1, 'Pak. Dayat', 'dayat@gmail.com', 'Jakarta Timuur', '$2y$10$hRqpgjIMsdB5vPxeQUWZnubFz7q5qjJCPWPNOank0ERGI0dx/QU3O', '1', 1, '2020-10-04 12:26:43', '2020-10-03 01:29:17', '127.0.0.1'),
(2, 'Pak. Lucky', 'lucky@gmail.com', 'Jakarta Selatan', '$2y$10$hRqpgjIMsdB5vPxeQUWZnubFz7q5qjJCPWPNOank0ERGI0dx/QU3O', '1', 1, '2020-09-26 23:03:47', '2020-09-27 00:40:25', '127.0.0.1'),
(3, 'Ika', 'ika@gmail.com', 'Jakarta Selatan', '$2y$10$hRqpgjIMsdB5vPxeQUWZnubFz7q5qjJCPWPNOank0ERGI0dx/QU3O', '1', 1, '2020-09-26 23:03:47', '2020-09-27 00:40:25', '127.0.0.1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_pengurusan`
--
ALTER TABLE `biaya_pengurusan`
  ADD PRIMARY KEY (`pengurusan_id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indeks untuk tabel `cash_in_cash_out`
--
ALTER TABLE `cash_in_cash_out`
  ADD PRIMARY KEY (`cico_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`),
  ADD KEY `sub_categories_id` (`sub_categories_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD KEY `customers_id` (`customers_id`);

--
-- Indeks untuk tabel `pembayaran_detail`
--
ALTER TABLE `pembayaran_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pembayaran_id` (`pembayaran_id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indeks untuk tabel `pembayaran_down_payment`
--
ALTER TABLE `pembayaran_down_payment`
  ADD PRIMARY KEY (`pembayaran_dp_id`);

--
-- Indeks untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`stock_in_id`),
  ADD KEY `items_id` (`items_id`);

--
-- Indeks untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_id`),
  ADD KEY `FK_stock_out_items` (`items_id`);

--
-- Indeks untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_categories_id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_pengurusan`
--
ALTER TABLE `biaya_pengurusan`
  MODIFY `pengurusan_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cash_in_cash_out`
--
ALTER TABLE `cash_in_cash_out`
  MODIFY `cico_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customers_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_detail`
--
ALTER TABLE `pembayaran_detail`
  MODIFY `detail_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembayaran_down_payment`
--
ALTER TABLE `pembayaran_down_payment`
  MODIFY `pembayaran_dp_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `stock_in_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_categories_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart_items` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`);

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_items_sub_categories` FOREIGN KEY (`sub_categories_id`) REFERENCES `sub_categories` (`sub_categories_id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `FK_pembayaran_customers` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`customers_id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran_detail`
--
ALTER TABLE `pembayaran_detail`
  ADD CONSTRAINT `FK_pembayaran_detail_items` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`),
  ADD CONSTRAINT `FK_pembayaran_detail_pembayaran` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`pembayaran_id`);

--
-- Ketidakleluasaan untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD CONSTRAINT `FK_stock_in_items` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`);

--
-- Ketidakleluasaan untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  ADD CONSTRAINT `FK_stock_out_items` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`);

--
-- Ketidakleluasaan untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `FK_sub_categories_categories` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`categories_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
