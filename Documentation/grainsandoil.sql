-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2025 at 12:28 PM
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
-- Database: `grainsandoil`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket_item`
--

CREATE TABLE `basket_item` (
  `item_basket_customer_id` int(11) NOT NULL COMMENT 'ID of associated Customer for Basket',
  `item_product_id` int(11) NOT NULL COMMENT 'Id of Associated Product',
  `item_quantity` int(5) NOT NULL COMMENT 'Quantity of Items'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Basket Items';

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` int(11) NOT NULL COMMENT 'Id of Business',
  `business_email` varchar(100) NOT NULL COMMENT 'Email of Business',
  `business_name` varchar(80) NOT NULL COMMENT 'Name of Business',
  `business_description` varchar(500) NOT NULL DEFAULT '' COMMENT 'Description of Business',
  `business_contact_email` varchar(80) NOT NULL DEFAULT '' COMMENT 'Business Contact Email',
  `business_postcode` varchar(12) NOT NULL DEFAULT '' COMMENT 'Business Postcode',
  `business_address_line1` varchar(80) NOT NULL DEFAULT '' COMMENT 'Business Address Line 1',
  `business_address_line2` varchar(80) NOT NULL DEFAULT '' COMMENT 'Business Address Line 2',
  `business_geolocation_lat` decimal(8,6) DEFAULT NULL COMMENT 'Business Geolocation Data for Latitude',
  `business_geolocation_long` decimal(9,6) DEFAULT NULL COMMENT 'Business Geolocation Data for Longitude'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_login`
--

CREATE TABLE `business_login` (
  `business_login_id` int(11) NOT NULL COMMENT 'Business Login Id',
  `business_login_password` varchar(100) NOT NULL COMMENT 'Business Login Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_name` varchar(30) NOT NULL COMMENT 'Name of Product Category',
  `category_description` varchar(500) NOT NULL DEFAULT '' COMMENT 'Description of Product Category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product Categories';

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL COMMENT 'ID of Customer',
  `customer_email` varchar(100) NOT NULL COMMENT 'Email of Customer',
  `customer_first_name` varchar(30) NOT NULL COMMENT 'First Name of Customer',
  `customer_last_name` varchar(30) NOT NULL COMMENT 'Last Name of Customer',
  `customer_username` varchar(60) NOT NULL COMMENT 'Username of Customer',
  `customer_postcode` varchar(12) NOT NULL DEFAULT '' COMMENT 'Postcode of Customer',
  `customer_address_line1` varchar(80) NOT NULL DEFAULT '' COMMENT 'Address Line 1 of Customer',
  `customer_address_line2` varchar(80) NOT NULL DEFAULT '' COMMENT 'Address Line 2 of Customer',
  `customer_phone_number` varchar(12) NOT NULL DEFAULT '' COMMENT 'Phone Number of Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `customer_login_id` int(11) NOT NULL COMMENT 'ID of Customer Login',
  `customer_login_password` varchar(100) NOT NULL COMMENT 'Password for Customer Login'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_status_table`
--

CREATE TABLE `order_status_table` (
  `status_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for the status of an order';

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `order_id` int(11) NOT NULL COMMENT 'ID of Order',
  `order_customer_id` int(11) NOT NULL COMMENT 'ID of Order''s Customer',
  `date_of_order` date NOT NULL DEFAULT current_timestamp() COMMENT 'Date of Order',
  `order_status` varchar(30) NOT NULL COMMENT 'Status of Order (Collected, Shipping, Packings, ect.)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Orders';

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'ID of Product',
  `product_business_id` int(11) NOT NULL COMMENT 'ID of Product''s Business',
  `product_category_name` varchar(30) NOT NULL COMMENT 'Product''s Category Name',
  `product_name` varchar(100) NOT NULL COMMENT 'Product''s name',
  `product_price` decimal(7,2) NOT NULL COMMENT 'Product''s Price',
  `product_description` varchar(500) NOT NULL DEFAULT '' COMMENT 'Product''s Description',
  `product_weight` decimal(4,1) DEFAULT NULL COMMENT 'Product''s Weight',
  `product_stock` int(5) NOT NULL DEFAULT 0 COMMENT 'stock of product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product';

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL COMMENT 'ID of Product Order''s Order',
  `product_order_product_id` int(11) NOT NULL COMMENT 'ID of Product Order''s Product',
  `product_order_quantity` int(5) NOT NULL COMMENT 'Quantity of Product Ordered',
  `product_order_unit_cost` decimal(7,2) NOT NULL COMMENT 'Price per Quantity of Product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `product_tag_name` varchar(100) NOT NULL COMMENT 'Name of Linked Tag',
  `tag_product_id` int(11) NOT NULL COMMENT 'Id of Linked Product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product Tag Link';

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_name` varchar(100) NOT NULL COMMENT 'Name of Tag for Products',
  `tag_description` varchar(500) NOT NULL DEFAULT '' COMMENT 'Description of Tag for Products'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product Tags';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket_item`
--
ALTER TABLE `basket_item`
  ADD KEY `ItemProductLink` (`item_product_id`),
  ADD KEY `ItemCustomerLink` (`item_basket_customer_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD UNIQUE KEY `UniqueBusinessEmail` (`business_email`),
  ADD KEY `BusinessLoginKeyed` (`business_id`);

--
-- Indexes for table `business_login`
--
ALTER TABLE `business_login`
  ADD PRIMARY KEY (`business_login_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD UNIQUE KEY `UniqueCustomerEmail` (`customer_email`),
  ADD KEY `CustomerLoginKeyed` (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`customer_login_id`);

--
-- Indexes for table `order_status_table`
--
ALTER TABLE `order_status_table`
  ADD PRIMARY KEY (`status_name`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `OrderCustomerLink` (`order_customer_id`),
  ADD KEY `OrderStatusLink` (`order_status`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ProductBusinessExists` (`product_business_id`),
  ADD KEY `ProductCategoryExists` (`product_category_name`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD KEY `ProductOrderOrderLink` (`product_order_id`),
  ADD KEY `ProductOrderProductLink` (`product_order_product_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`product_tag_name`,`tag_product_id`),
  ADD KEY `ProductTagsToProduct` (`tag_product_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_login`
--
ALTER TABLE `business_login`
  MODIFY `business_login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Business Login Id';

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `customer_login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of Customer Login';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of Product';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket_item`
--
ALTER TABLE `basket_item`
  ADD CONSTRAINT `ItemCustomerLink` FOREIGN KEY (`item_basket_customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `ItemProductLink` FOREIGN KEY (`item_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `BusinessLoginKeyed` FOREIGN KEY (`business_id`) REFERENCES `business_login` (`business_login_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `CustomerLoginKeyed` FOREIGN KEY (`customer_id`) REFERENCES `customer_login` (`customer_login_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `OrderCustomerLink` FOREIGN KEY (`order_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `OrderStatusLink` FOREIGN KEY (`order_status`) REFERENCES `order_status_table` (`status_name`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `ProductBusinessExists` FOREIGN KEY (`product_business_id`) REFERENCES `business` (`business_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ProductCategoryExists` FOREIGN KEY (`product_category_name`) REFERENCES `category` (`category_name`) ON UPDATE CASCADE;

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `ProductOrderOrderLink` FOREIGN KEY (`product_order_id`) REFERENCES `order_table` (`order_id`),
  ADD CONSTRAINT `ProductOrderProductLink` FOREIGN KEY (`product_order_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `ProductTagsToProduct` FOREIGN KEY (`tag_product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ProductTagsToTag` FOREIGN KEY (`product_tag_name`) REFERENCES `tags` (`tag_name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
