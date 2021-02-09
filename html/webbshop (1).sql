-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 29 sep 2020 kl 14:32
-- Serverversion: 10.4.6-MariaDB
-- PHP-version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `webbshop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `customers`
--

CREATE TABLE `customers` (
  `customerID` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `adress` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `zip` int(10) NOT NULL,
  `city` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `customers`
--

INSERT INTO `customers` (`customerID`, `username`, `firstname`, `lastname`, `adress`, `zip`, `city`, `phone`) VALUES
(1, 'kalle123', 'kalle', 'sten', 'stenvägen', 33333, 'stenstaden', '33333333');

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) UNSIGNED NOT NULL,
  `productID` int(10) UNSIGNED NOT NULL,
  `amount` int(5) NOT NULL,
  `customersID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `productID` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `price` int(50) NOT NULL,
  `picture` varchar(200) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`productID`, `name`, `description`, `price`, `picture`) VALUES
(1, 'Äpple', 'Ätbart', 15, './img/apple.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `username` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `status`) VALUES
('kalle', 'kalle@example.se', 'kalle123', 0);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `username` (`username`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `porductID` (`productID`),
  ADD KEY `customersID` (`customersID`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `password` (`password`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customersID`) REFERENCES `customers` (`customerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON UPDATE CASCADE;

--
-- Restriktioner för tabell `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
