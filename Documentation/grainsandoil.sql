-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 11:51 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL COMMENT 'Admin ID',
  `admin_email` varchar(100) NOT NULL COMMENT 'Admin Email',
  `admin_first_name` varchar(30) NOT NULL COMMENT 'First name of Admin',
  `admin_last_name` varchar(30) NOT NULL COMMENT 'Last name of Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Admin Table';

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL COMMENT 'Admin ID',
  `admin_login_password` varchar(100) NOT NULL COMMENT 'Admin Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Login Details of Admin';

-- --------------------------------------------------------

--
-- Table structure for table `basket_item`
--

CREATE TABLE `basket_item` (
  `item_basket_customer_id` int(11) NOT NULL COMMENT 'Basket Item Customer ID',
  `item_product_id` int(11) NOT NULL COMMENT 'Basket Item Product ID',
  `item_quantity` int(11) NOT NULL COMMENT 'Basket Item Quantity'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Customer Basket';

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` int(11) NOT NULL COMMENT 'Id of Business',
  `business_email` varchar(100) NOT NULL COMMENT 'Email of Business',
  `business_name` varchar(80) NOT NULL COMMENT 'Name of Business',
  `business_description` varchar(500) DEFAULT NULL COMMENT 'Description of Business',
  `business_contact_email` varchar(80) DEFAULT NULL COMMENT 'Business Contact Email',
  `business_postcode` varchar(12) DEFAULT NULL COMMENT 'Business Postcode',
  `business_address_line1` varchar(80) DEFAULT NULL COMMENT 'Business Address Line 1',
  `business_address_line2` varchar(80) DEFAULT NULL COMMENT 'Business Address Line 2',
  `business_geolocation_lat` decimal(8,6) DEFAULT NULL COMMENT 'Business Geolocation Data for Latitude',
  `business_geolocation_long` decimal(9,6) DEFAULT NULL COMMENT 'Business Geolocation Data for Longitude'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `business_email`, `business_name`, `business_description`, `business_contact_email`, `business_postcode`, `business_address_line1`, `business_address_line2`, `business_geolocation_lat`, `business_geolocation_long`) VALUES
(1, 'jamie.nic1@gmail.com', 'test', '', 'jamie.nic1@gmail.com', 'EH1 2RX', '609 Websters Land', '', 55.946606, -3.199658),
(2, 'test@gmail.com', 'Test', 'test', 'test@test', 'ML75SY', 't', 't', 55.859000, -3.747930);

-- --------------------------------------------------------

--
-- Table structure for table `business_login`
--

CREATE TABLE `business_login` (
  `business_login_id` int(11) NOT NULL COMMENT 'Business Login Id',
  `business_login_password` varchar(100) NOT NULL COMMENT 'Business Login Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_login`
--

INSERT INTO `business_login` (`business_login_id`, `business_login_password`) VALUES
(1, '$2y$10$ddx0hGYX652dPN/Ibc8kUOa77Br2MFiU6gflDHTTjBfQHFN1UZG0C'),
(2, '$2y$10$nwloacNa9T7lQT1l6njk6OuLwF0nUjJe3.hXo7lvY4Gy2lvN5q4uu');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_name` varchar(30) NOT NULL COMMENT 'Name of Product Category',
  `description` varchar(1000) NOT NULL DEFAULT '' COMMENT 'Description of Product Category'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product Categories';

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_name`, `description`) VALUES
('Grain', 'Grains');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_us_id` int(11) NOT NULL COMMENT 'Contact Us ID',
  `contact_us_email` varchar(100) NOT NULL COMMENT 'Contact Us Email',
  `contact_us_subject` varchar(100) NOT NULL COMMENT 'Contact Us Subject',
  `contact_us_text` text NOT NULL COMMENT 'Contact Us Input',
  `contact_us_name` varchar(60) NOT NULL COMMENT 'contact''s name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Contact Us Table';

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_us_id`, `contact_us_email`, `contact_us_subject`, `contact_us_text`, `contact_us_name`) VALUES
(2, 'test@gmail.com', '', 'test123', 'testy'),
(3, 'test@gmail.com', 'test2', 'test123', 'testy'),
(4, 'f@fg', 'ff', 'd', 'f'),
(5, 'loall@g', 'test2', 'test', 'Logan Nuttall');

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
  `customer_postcode` varchar(12) DEFAULT NULL COMMENT 'Postcode of Customer',
  `customer_address_line1` varchar(80) DEFAULT NULL COMMENT 'Address Line 1 of Customer',
  `customer_address_line2` varchar(80) DEFAULT NULL COMMENT 'Address Line 2 of Customer',
  `customer_phone_number` varchar(12) DEFAULT NULL COMMENT 'Phone Number of Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_email`, `customer_first_name`, `customer_last_name`, `customer_username`, `customer_postcode`, `customer_address_line1`, `customer_address_line2`, `customer_phone_number`) VALUES
(1, 'alexis.sanghera@me.com', 'Jamie', 'Nicholson', 'jamnic94', 'EH1 2RX', '609 Websters Land', '', '07479303393'),
(2, 'test@gmail.com', 'o', 'a', 'erte', 'ffff', 'f', 'f', '42424242424');

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `customer_login_id` int(11) NOT NULL COMMENT 'ID of Customer Login',
  `customer_login_password` varchar(100) NOT NULL COMMENT 'Password for Customer Login'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`customer_login_id`, `customer_login_password`) VALUES
(1, '$2y$10$E648Yh1yarAZDf58NaHhZ.T/9a45O6s3KZ0DtUikTFIJ/G6uv8RYS'),
(2, '$2y$10$fo8aGmFkwsQAKv9nQIsS3.8YhC6IHzZoyDKbOV6WSy.fJXePh2EHG');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `order_id` int(11) NOT NULL COMMENT 'ID of Order',
  `order_customer_id` int(11) NOT NULL COMMENT 'ID of Order''s Customer',
  `date_of_order` date DEFAULT current_timestamp() COMMENT 'Date of Order',
  `order_status` varchar(30) DEFAULT NULL COMMENT 'Status of Order (Collected, Shipping, Packings, ect.)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Orders';

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`order_id`, `order_customer_id`, `date_of_order`, `order_status`) VALUES
(1, 2, '2025-05-01', 'Complete'),
(2, 2, '2025-05-01', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `type` enum('customer','business') NOT NULL DEFAULT 'customer',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `type`, `created_at`) VALUES
('jamie.nic1@gmail.com', '43cf06f82b65c9bbf8f93bbef1ae7187e1b6165c6a033335f51b55ded1f15b7a', 'business', '2025-04-19 17:57:44'),
('jamie.nic1@gmail.com', '918d91379134f4d645fb1d56c78645a82569f675237ace19bb4d8d213926b6bb', 'business', '2025-04-19 23:38:07'),
('alexis.sanghera@me.com', '9d4b603d1b25430e94e628e68177b7ba03858c6b1ad0e1d0dcd3ce25900a0578', 'customer', '2025-04-19 23:42:13'),
('jamie.nic1@gmail.com', '306c8519294bfd4bf5c0d3d0d27257b4db5854ffced6eca139dc287bade6f4a7', 'business', '2025-04-19 23:47:11'),
('jamie.nic1@gmail.com', 'ebceae728b4af51cf0aa37e2d1595992b26d55f1cf728b5192fa5645dfcfa042', 'business', '2025-04-19 23:48:19'),
('jamie.nic1@gmail.com', 'cf331875e13a82c86668c7be068d5388945abe9be7f2da2fd3cc5807ec986a49', 'business', '2025-04-19 23:53:48'),
('jamie.nic1@gmail.com', 'd80334743683ada70765b597e1a252fcfa12c89553bbda2708fca20312906372', 'business', '2025-04-19 23:55:18'),
('jamie.nic1@gmail.com', 'e17ea7941363eddcf6380a314f62fb79ff2d1e5f89289fc249be061ff3657eaa', 'business', '2025-04-19 23:55:29'),
('jamie.nic1@gmail.com', '192461eeaff66f03465ac4080eb5cee23b16133d1b88630475014581cae366c8', 'business', '2025-04-19 23:58:56'),
('jamie.nic1@gmail.com', 'c17730f59f5cd5b6f934a0f7d576c84f011023249dea5e14a24adc6f2bcb45c5', 'business', '2025-04-20 00:19:02'),
('jamie.nic1@gmail.com', 'e596b89a333742955de8d7752002c45ab77a991c00ae5361ee8edf64b505da58', 'business', '2025-04-20 00:20:27'),
('jamie.nic1@gmail.com', 'cfd2179ac23a279c47829e6cd9e9c5dfb1b56100eab289e03175f3675f6d919a', 'business', '2025-04-20 00:26:38'),
('jamie.nic1@gmail.com', 'a826d8b6d253fc454cbdf70113fa66c776aa894a5be8fdb31fc103549d789445', 'business', '2025-04-20 00:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL COMMENT 'ID of Product',
  `product_business_id` int(11) NOT NULL COMMENT 'ID of Product''s Business',
  `product_category_name` varchar(30) DEFAULT NULL COMMENT 'Product''s Category Name',
  `product_name` varchar(100) NOT NULL COMMENT 'Product''s name',
  `price` decimal(7,2) NOT NULL COMMENT 'Product''s Price',
  `description` varchar(500) DEFAULT NULL COMMENT 'Product''s Description',
  `weight` decimal(4,1) DEFAULT NULL COMMENT 'Product''s Weight'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product';

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_business_id`, `product_category_name`, `product_name`, `price`, `description`, `weight`) VALUES
(1, 2, 'Grain', 'Rice', 1.00, '1', 1.0),
(2, 2, 'Grain', 'Rice2', 2.00, '2', 2.0);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `product_order_id` int(11) NOT NULL COMMENT 'ID of Product Order''s Order',
  `product_order_product_id` int(11) NOT NULL COMMENT 'ID of Product Order''s Product',
  `product_order_quantity` int(11) NOT NULL COMMENT 'Quantity of Product Ordered',
  `price_per_unit` decimal(7,2) NOT NULL COMMENT 'Price per Quantity of Product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`product_order_id`, `product_order_product_id`, `product_order_quantity`, `price_per_unit`) VALUES
(1, 1, 2, 1.00),
(2, 1, 3, 1.25);

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
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `subscriber_email` varchar(100) NOT NULL COMMENT 'Email of Subscriber'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Email List for Subscribers';

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`subscriber_email`) VALUES
('test4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_name` varchar(100) NOT NULL COMMENT 'Name of Tag for Products',
  `tag_description` varchar(1000) DEFAULT NULL COMMENT 'Description of Tag for Products'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for Product Tags';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `basket_item`
--
ALTER TABLE `basket_item`
  ADD PRIMARY KEY (`item_basket_customer_id`,`item_product_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`business_id`),
  ADD UNIQUE KEY `UniqueBusinessEmail` (`business_email`);

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
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_us_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `UniqueCustomerEmail` (`customer_email`),
  ADD KEY `CustomerLoginKeyed` (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`customer_login_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `OrderCustomerLink` (`order_customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ProductBusinessExists` (`product_business_id`),
  ADD KEY `ProductCategoryExists` (`product_category_name`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`product_order_id`,`product_order_product_id`),
  ADD KEY `ProductOrderOrderLink` (`product_order_id`),
  ADD KEY `ProductOrderProductLink` (`product_order_product_id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`product_tag_name`,`tag_product_id`),
  ADD KEY `ProductTagsToProduct` (`tag_product_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`subscriber_email`);

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
  MODIFY `business_login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Business Login Id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_us_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Contact Us ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `customer_login_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of Customer Login', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of Order', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of Product', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `AdminExists` FOREIGN KEY (`admin_id`) REFERENCES `admin_login` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `basket_item`
--
ALTER TABLE `basket_item`
  ADD CONSTRAINT `ItemBasketCustomerLink` FOREIGN KEY (`item_basket_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `OrderCustomerLink` FOREIGN KEY (`order_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `ProductBusinessExists` FOREIGN KEY (`product_business_id`) REFERENCES `business` (`business_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ProductCategoryExists` FOREIGN KEY (`product_category_name`) REFERENCES `category` (`category_name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE;

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
