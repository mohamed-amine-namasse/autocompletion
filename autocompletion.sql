-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2025 at 11:54 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autocompletion`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `year` int NOT NULL,
  `color` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vin` varchar(17) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mileage` int NOT NULL,
  `price` int NOT NULL,
  `available` tinyint(1) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `color`, `vin`, `mileage`, `price`, `available`, `image`) VALUES
(1, 'Honda', 'Civic', 2022, 'Silver', '1HGFC2B54NA701358', 15000, 25500, 1, '/autocompletion/assets/images/1_honda_civic.jpg'),
(2, 'BMW', 'X5', 2021, 'Black', 'WBAJT2C51MB684210', 22000, 59000, 1, '/autocompletion/assets/images/2_bmw_x5.jpg'),
(3, 'Ford', 'F-150', 2018, 'Red', '1FTNW1E93KFA88901', 95000, 18500, 0, '/autocompletion/assets/images/3_ford_f150.jpg'),
(4, 'Tesla', 'Model 3', 2024, 'White', '5YJSA1E28PAB34567', 150, 42000, 1, '/autocompletion/assets/images/4_tesla_model3.jpg'),
(5, 'Chevrolet', 'Corvette Stingray', 1969, 'Yellow', '194379S725000', 65000, 120000, 1, '/autocompletion/assets/images/5_chevy_corvette.jpg'),
(6, 'Kia', 'Rio', 2023, 'Blue', '3KPFX4A30PE123456', 5000, 18999, 1, '/autocompletion/assets/images/6_kia_rio.jpg'),
(7, 'Porsche', '911 Carrera', 2020, 'Red', 'WP0AA2996LS400001', 30000, 98500, 1, '/autocompletion/assets/images/7_porsche_911.jpg'),
(8, 'Toyota', 'Sienna', 2022, 'Gray', '5TDUHGFV6NS901122', 12000, 39950, 1, '/autocompletion/assets/images/8_toyota_sienna.jpg'),
(9, 'Nissan', 'Altima', 2005, 'Beige', '1N4BL21E25C112233', 185000, 2500, 0, '/autocompletion/assets/images/9_nissan_altima.jpg'),
(10, 'Mercedes-Benz', 'E-Class', 2021, 'White', 'WDC2130081T254789', 18000, 49999, 1, '/autocompletion/assets/images/10_merc_eclass.jpg'),
(11, 'Subaru', 'Forester', 2023, 'Green', 'JF1SG5G28PH334455', 8000, 32100, 1, '/autocompletion/assets/images/11_subaru_forester.jpg'),
(12, 'Ram', '2500', 2019, 'Black', '3C6JR6EL7KG678901', 75000, 45900, 1, '/autocompletion/assets/images/12_ram_2500.jpg'),
(13, 'Audi', 'A4', 2024, 'Silver', 'WAUZZZF45PA000123', 500, 48000, 1, '/autocompletion/assets/images/13_audi_a4.jpg'),
(14, 'Dodge', 'Challenger R/T', 1970, 'Orange', 'JS23N0B123456', 55000, 95000, 1, '/autocompletion/assets/images/14_dodge_challenger.jpg'),
(15, 'Hyundai', 'Kona Electric', 2023, 'Teal', 'KM8K33A7XPX887766', 10000, 35000, 1, '/autocompletion/assets/images/15_hyundai_kona.jpg'),
(16, 'Mitsubishi', 'Mirage', 2024, 'White', 'ML32P2F9XRH445566', 100, 17000, 1, '/autocompletion/assets/images/16_mitsubishi_mirage.jpg'),
(17, 'Jeep', 'Wrangler', 2017, 'Army Green', '1C4HJFEN2HW010203', 60000, 15000, 0, '/autocompletion/assets/images/17_jeep_wrangler.jpg'),
(18, 'Mazda', 'Mazda3', 2022, 'Polymetal Gray', 'JM1BP1N95N1567890', 28000, 24500, 1, '/autocompletion/assets/images/18_mazda_mazda3.jpg'),
(19, 'Cadillac', 'Escalade', 2020, 'Bronze', '1GYF6PREXLH112233', 45000, 65000, 1, '/autocompletion/assets/images/19_cadillac_escalade.jpg'),
(20, 'BMW', 'Z4', 2021, 'Yellow', 'WBAJT2C51MB600000', 10000, 52000, 1, '/autocompletion/assets/images/20_bmw_z4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vin` (`vin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
