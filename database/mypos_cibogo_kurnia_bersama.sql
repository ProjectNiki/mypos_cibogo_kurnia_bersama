-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Sep 2020 pada 11.48
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
(2, 'Aksesoris', '2020-09-19 21:26:49', NULL, NULL, NULL),
(3, 'Bahan', '2020-09-19 21:26:54', NULL, NULL, NULL),
(4, 'Mesin', '2020-09-19 21:26:59', NULL, NULL, NULL),
(5, 'Pakain Jadi', '2020-09-19 21:32:34', '2020-09-19 22:09:43', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `customers_id` int(6) NOT NULL,
  `customers_key` varchar(6) DEFAULT NULL,
  `pt_customers` varchar(50) DEFAULT NULL,
  `name_customers` varchar(50) DEFAULT NULL,
  `gander_customers` int(1) DEFAULT NULL,
  `phone_customers` varchar(13) DEFAULT NULL,
  `email_customers` varchar(50) DEFAULT NULL,
  `address_customers` text DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`customers_id`, `customers_key`, `pt_customers`, `name_customers`, `gander_customers`, `phone_customers`, `email_customers`, `address_customers`, `created`, `updated`, `user_updated`, `user_created`) VALUES
(1, 'C_0001', 'PT. Bersama', 'Jordan', 1, '081214000096', 'jordan@gmail.com', 'Jakarta Selatan', '2020-09-19 18:21:29', NULL, NULL, 2147483647);

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
  `harga_items` int(11) DEFAULT NULL,
  `qty_items` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_created` int(1) DEFAULT NULL,
  `user_updated` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`items_id`, `items_key`, `name_items`, `categories_id`, `sub_categories_id`, `harga_items`, `qty_items`, `created`, `updated`, `user_created`, `user_updated`) VALUES
(6, 'P_0001', 'Testing Barang', 2, 4, 3000, 100, '2020-09-22 01:11:48', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_in`
--

CREATE TABLE `stock_in` (
  `stock_in_id` int(6) NOT NULL,
  `items_id` int(6) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `qty_stock_in` int(11) DEFAULT NULL,
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
  `qty_stock_out` int(11) DEFAULT NULL,
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

--
-- Dumping data untuk tabel `sub_categories`
--

INSERT INTO `sub_categories` (`sub_categories_id`, `name_sub_categories`, `categories_id`, `created`, `updated`, `user_created`, `user_updated`) VALUES
(4, 'Kancing', 2, '2020-09-20 20:53:24', NULL, 1, NULL),
(5, 'Katun', 3, '2020-09-20 20:54:28', NULL, 1, NULL),
(6, 'Jahit', 4, '2020-09-20 20:54:35', NULL, 1, NULL),
(7, 'Baju Hype', 5, '2020-09-20 20:54:42', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(2) NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
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

INSERT INTO `user` (`user_id`, `nama`, `email`, `password`, `is_active`, `level`, `in`, `log`, `ip`) VALUES
(1, 'Dayat', 'dayat@gmail.com', '$2y$10$hRqpgjIMsdB5vPxeQUWZnubFz7q5qjJCPWPNOank0ERGI0dx/QU3O', '1', 1, '2020-09-21 23:56:49', '2020-09-20 19:05:53', '127.0.0.1');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`items_id`);

--
-- Indeks untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`stock_in_id`);

--
-- Indeks untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`stock_out_id`);

--
-- Indeks untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_categories_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `customers_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `stock_in_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `stock_out_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_categories_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
