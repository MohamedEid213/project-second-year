-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 10:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `repair-center`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `states` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `basket_id` int(11) NOT NULL,
  `Client_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`basket_id`, `Client_id`, `Product_id`, `added_at`, `service_id`) VALUES
(33, 17, 15, '2025-04-23 20:41:00', NULL),
(43, 17, 17, '2025-04-28 18:53:58', NULL),
(44, 17, 11, '2025-04-28 18:54:03', NULL),
(45, 19, 14, '2025-04-28 19:34:49', NULL),
(53, 19, 17, '2025-05-03 09:09:34', NULL),
(54, 19, 8, '2025-05-03 09:20:55', NULL),
(55, 19, 15, '2025-05-03 11:32:29', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `baskets_products`
-- (See below for the actual view)
--
CREATE TABLE `baskets_products` (
`product_name` varchar(255)
,`product_id` int(11)
,`price` decimal(20,2)
,`Images` text
,`description` text
,`Client_id` int(11)
,`basket_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `b_name`) VALUES
(1, 'Acura'),
(2, 'Alfa Romeo'),
(3, 'Audi'),
(4, 'BMW'),
(5, 'Buick'),
(6, 'Cadillac'),
(7, 'Volkswagen	'),
(8, 'Subaru'),
(9, 'Porsche'),
(10, 'Mazda'),
(11, 'Kia'),
(12, 'Mitsubishi'),
(13, 'Ford'),
(14, 'Mercedes-Benz'),
(15, 'Lincoln'),
(16, 'Infiniti'),
(17, 'Nissan'),
(18, 'Dodge'),
(19, 'Renault'),
(20, 'Hyundai'),
(21, 'Toyota'),
(22, 'Fisker'),
(23, 'Honda'),
(24, 'Chrysler'),
(25, 'Peugeot'),
(26, 'Isuzu'),
(27, 'Zenvo'),
(28, 'Vauxhall'),
(29, 'Toyota'),
(30, 'Tesla'),
(31, 'Tata'),
(32, 'SsangYong'),
(33, 'Spyker'),
(34, 'Smart'),
(35, 'Shelby'),
(36, 'Seat'),
(37, 'Scion'),
(38, 'Ferrari'),
(39, 'Alfa Romeo'),
(40, 'Chevrolet'),
(41, 'Fiat'),
(42, 'Genesis'),
(43, 'GMC'),
(44, 'Hyundai'),
(45, 'Jaguar'),
(46, 'Jeep'),
(47, 'Lamborghini'),
(48, 'Kia'),
(49, 'Rolls-Royce');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `C_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `C_name`) VALUES
(17, 'Engine'),
(18, 'Transmission & Drivetrain'),
(19, 'Suspension & Steering'),
(20, 'Brakes System'),
(21, 'Cooling System'),
(22, 'Electrical & Electronics'),
(23, 'Fuel System'),
(24, 'Exhaust System'),
(25, 'Body Parts'),
(26, 'Lighting'),
(27, 'Interior & Accessories'),
(28, 'Air Conditioning & Heating'),
(29, 'Filters'),
(30, 'Tools & Maintenance');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `Client_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `feature_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status` enum('Pending','Processing','Shipped','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
  `order_date` date DEFAULT curdate(),
  `delivery_date` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL CHECK (`total_price` >= 0),
  `payment_status` enum('Unpaid','Paid','Refunded') NOT NULL DEFAULT 'Unpaid',
  `shipped_address` varchar(255) DEFAULT NULL,
  `payment_system` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `O_I_id` int(11) NOT NULL,
  `Order_id` int(11) DEFAULT NULL,
  `Product_id` int(11) DEFAULT NULL,
  `quantity_order` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `total_price` decimal(10,2) GENERATED ALWAYS AS (`quantity_order` * `price` - `discount`) STORED,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `phone_Id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `model_year` year(4) DEFAULT NULL,
  `Images` text NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `Category_id` int(11) NOT NULL,
  `Brand_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `Added by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `model_year`, `Images`, `price`, `Category_id`, `Brand_id`, `description`, `Added by`) VALUES
(6, 'Oil Filter', '2001', 'OIP.jfif', 10.00, 17, 43, 'Filters impurities from engine oil to keep it clean.', 17),
(7, 'Car Battery', '2001', 'OIP (1).jfif', 90.00, 22, 20, 'Supplies power to start the engine and power electronics.', 17),
(8, 'Brake Pads', '2001', 'OIP (2).jfif', 50.00, 20, 4, 'Helps stop the car by creating friction with the brake disc.', 17),
(9, 'Spark Plugs', '2001', 'istockphoto-187456483-612x612.jpg', 20.00, 17, 40, 'Ignite the fuel-air mixture inside the engine cylinders.', 17),
(10, 'Car Tire', '2001', 'OIP (3).jfif', 120.00, 25, 1, 'Provides traction, balance, and support for the car.', 17),
(11, 'Side Mirror', '2001', 'OIP (4).jfif', 45.00, 24, 1, 'Allows the driver to see vehicles on the sides.	', 17),
(12, 'Brake Shoes', '2001', 'brake-shoes.jpg', 55.00, 20, 41, 'Used in drum brake systems, usually in rear wheels.', 17),
(13, 'Timing Belt', '2001', 'R.jfif', 80.00, 17, 4, 'Synchronizes the crankshaft and camshaft movement.', 17),
(14, 'AC Condenser', '2001', 'OIP (5).jfif', 110.00, 21, 24, 'Cools down refrigerant in the air conditioning system.', 17),
(15, 'Ignition Coils', '2001', 'R.png', 70.00, 22, 39, 'Transforms battery voltage into high voltage for spark plugs.', 17),
(16, 'Fuel Filter', '2001', 'OIP (6).jfif', 12.00, 17, 5, 'Removes dirt and rust from the fuel before it reaches the engine.', 17),
(17, 'Car Battery', '2001', 'OIP (1).jfif', 43.00, 29, 22, 'fhkgv', 17);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promotion_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `discount` decimal(5,2) DEFAULT NULL CHECK (`discount` >= 0 and `discount` <= 100),
  `start_date` date NOT NULL,
  `end_date` date NOT NULL CHECK (`end_date` > `start_date`),
  `promotion_description` text DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `evaluation` int(11) DEFAULT NULL CHECK (`evaluation` >= 1 and `evaluation` <= 5),
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `s_name`, `s_description`, `status`, `image`, `video`, `create_at`) VALUES
(1, 'Brake Service', 'Professional brake repair and maintenance including:', 'actitive', 'brakes.png', '', '2025-04-30 11:46:05'),
(2, 'Engine Repair', 'Complete diagnostics and repair for all engine types. We specialize in:', 'actitive', 'maintenance_Engine.png', '', '2025-04-30 11:46:05'),
(3, 'Oil Change', 'Regular maintenance and oil changes with:', 'actitive', 'oil-change.png', '', '2025-04-30 11:46:05'),
(4, 'Transmission', 'Transmission repair and replacement services including:', 'actitive', 'transmission.png', '', '2025-04-30 11:46:05'),
(5, 'AC Service', 'Complete air conditioning system service featuring:', 'actitive', 'air-conditioner.png', '', '2025-04-30 11:46:05'),
(6, 'Tire Service', 'Comprehensive tire care including:', 'actitive', 'car-repair.png', '', '2025-04-30 11:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `staff_status` enum('Active','Inactive','On Leave') NOT NULL DEFAULT 'Active',
  `store_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Store_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `street` varchar(60) NOT NULL,
  `ctiy` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` enum('female','male','custom') NOT NULL,
  `birthday` varchar(25) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `User_Permissions` enum('user','admin','moderator') DEFAULT 'user',
  `ban` tinyint(4) DEFAULT 0 CHECK (`ban` in (0,1,2,3,4,5)),
  `image_profile` varchar(255) DEFAULT 'photo_private.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `birthday`, `address_id`, `User_Permissions`, `ban`, `image_profile`) VALUES
(17, 'mohamed eid ramadan', 'mhm@gmail.com', '$2y$10$1Kgh754oRRxmzbtjVH8h7.OilGs2CBQKovfAuMsJnWTxwLV4gZTxi', 'custom', '2008-12-19', NULL, 'admin', 0, 'photo_private.png'),
(18, 'mohamed ashraf', 'myg4527@gmail.com', '$2y$10$nDH9Q9j84YkKASMz3bT..ug3Haq2sOdczCqp9KPZZgq5i6dco.q3C', 'custom', '2009-10-17', NULL, 'user', 0, 'photo_private.png'),
(19, 'mariam mohame', 'ziadout360@gmail.com', '$2y$10$I6ed65Y3MU82xUTe8tavEufJe4xyBZoKkxhPQeMDEuXXA3wPFh/LK', 'male', '2010-09-09', NULL, 'moderator', 0, 'photo_private.png');

-- --------------------------------------------------------

--
-- Structure for view `baskets_products`
--
DROP TABLE IF EXISTS `baskets_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `baskets_products`  AS SELECT `products`.`product_name` AS `product_name`, `products`.`product_id` AS `product_id`, `products`.`price` AS `price`, `products`.`Images` AS `Images`, `products`.`description` AS `description`, `basket`.`Client_id` AS `Client_id`, `basket`.`basket_id` AS `basket_id` FROM (`basket` join `products` on(`basket`.`Product_id` = `products`.`product_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basket_id`),
  ADD KEY `Client_id` (`Client_id`),
  ADD KEY `Product_id` (`Product_id`),
  ADD KEY `fk_service` (`service_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `Client_id` (`Client_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_service_featuer` (`service_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`O_I_id`),
  ADD KEY `Order_id` (`Order_id`),
  ADD KEY `Product_id` (`Product_id`),
  ADD KEY `f_service` (`service_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`phone_Id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Category_id` (`Category_id`),
  ADD KEY `Brand_id` (`Brand_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotion_id`),
  ADD KEY `Product_id` (`Product_id`),
  ADD KEY `fk_service_promotion` (`service_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_service_review` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `Product_id` (`Product_id`),
  ADD KEY `Store_id` (`Store_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `basket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `O_I_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `phone_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`Client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`Client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `features_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `fk_service_featuer` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `f_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`Brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `fk_service_promotion` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_service_review` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `reviews_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `staff` (`staff_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`Store_id`) REFERENCES `stores` (`store_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
