DROP DATABASE IF EXISTS shop_db;
CREATE DATABASE shop_db;
USE shop_db;


-- Admin table
CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--  data for table `admins` password : 111
INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');
 

-- Users table
CREATE TABLE `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
    `address` varchar(100) NOT NULL,
    `phone` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4

--  data for table `users`
INSERT INTO `users` (`id`, `name`, `email`,`address`,`phone`,`password`) VALUES
(1,'Rania','rania@rania.dk','Copenhagen','12345678', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');


--Products table
CREATE TABLE `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4

--  data for table `products`
INSERT INTO `products` (`id`, `name`, `price`,`image`,`quantity`,`category`) VALUES
(1, 'Samsung smart watch', '4500', 'Smartwatch-PNG-Clipart.png', 89, 'SmartWatch'),
(1, 'Apple smart watch', '6500', 'Smartwatch-Transparent-PNG.png', 34, 'SmartWatch'),
(3, 'Samsung smart 5', '5500', 'Smartwatch-PNG-Transparent-Image.png', 27, 'SmartWatch'),
(4, 'Toshiba laptop', '5500', 'Toshiba-Laptop-PNG-Transparent.png', 23, 'Laptop'),
(5, 'Asus laptop', '4000', 'Laptop-PNG-Photos.png', 25, 'Laptop'),
(6, 'HP laptop', '6000', 'Laptop-Computer-Icon-PNG.png', 46, 'Laptop'),
(7, 'iPhone 11', '3500', 'Apple-iPhone-11-PNG-Image.png', 23, 'smartphone'),
(8, 'iPhone 12', '6000', 'Apple-iPhone-12-Transparent-Background.png', 18, 'smartphone'),
(9, 'Samsung S20', '6300', 'samsung.png', 28, 'smartphone');


--cart table 

CREATE TABLE `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4
