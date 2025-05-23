-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2025 at 03:14 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `fullname` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `opinion` varchar(64) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fullname`, `email`, `opinion`) VALUES
('Sonam Kumari', 'sonam@gmail.com', 'Food section needs improvement.'),
('rekha', 'rekha@abc.com', 'good '),
('nikhil', 'nikhil@gmail.com', 'good\r\n'),
('rohan', 'rohan@gmail.com', 'excellent');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `description`, `quantity`, `price`, `photo`, `created_at`) VALUES
(31, 'cat bowl', 'silver bowl', 99, 150.00, 'uplode/silver cat bowl.jpg', '2025-01-23 05:25:58'),
(30, 'new item', 'sgdjus', 29, 22.00, 'uplode/cat bowl.jpeg', '2025-01-22 15:10:36'),
(27, 'cat bed', 'a yellow cat bed', 93, 200.00, 'uplode/cat bed.png', '2025-01-21 07:34:15'),
(29, 'cat bowl', 'a white set bowl for cats', 0, 10.00, 'uplode/bowl.png', '2025-01-21 14:49:48'),
(26, 'belt', 'dog black belt', 40, 322.00, 'uplode/black dog collar belt.png', '2025-01-21 07:13:58'),
(28, 'cat bowl', 'silber metal bowl', 48, 20.00, 'uplode/silver cat bowl.jpg', '2025-01-21 07:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`, `order_date`) VALUES
(1, 1, 7, 'Small Bird Blend', 69.00, 1, 69.00, '2025-01-28 15:28:56'),
(2, 1, 2, 'pedigree', 200.00, 1, 200.00, '2025-01-28 15:29:47'),
(3, 1, 2, 'pedigree', 200.00, 1, 200.00, '2025-01-28 15:30:39'),
(4, 1, 3, 'jdfh', 30.00, 1, 30.00, '2025-01-28 15:34:10'),
(5, 1, 8, 'Tropical Fish Food', 100.00, 1, 100.00, '2025-01-28 15:34:10'),
(6, 1, 27, 'drool', 50.00, 1, 50.00, '2025-01-28 15:38:00'),
(7, 1, 27, 'drool', 50.00, 1, 50.00, '2025-01-28 16:33:54'),
(8, 1, 11, 'hallofeed turtle', 100.00, 2, 200.00, '2025-01-28 16:33:54'),
(9, 1, 8, 'Tropical Fish Food', 100.00, 2, 200.00, '2025-01-28 16:33:54'),
(10, 1, 14, 'cat food', 350.00, 2, 700.00, '2025-01-28 16:36:04'),
(11, 51, 12, 'catfood', 40.00, 1, 40.00, '2025-01-28 16:42:05'),
(12, 52, 29, 'The Birds Company Foxtail Millet.', 80.00, 1, 80.00, '2025-01-29 12:50:41'),
(13, 52, 28, 'ZuPreem FruitBlend Flavor with Natural Flavors', 99.00, 1, 99.00, '2025-01-29 12:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `quantity`, `price`, `photo`, `created_at`, `category`) VALUES
(2, 'pedigree', '100gm', 40, 200.00, 'uploads3.png', '2025-01-22 15:13:01', 'dog_food'),
(35, 'Optimum - Fish Food', '500gm. Optimum Fish Food is filled with the perfect balance of vitamins, minerals, and protein for your aquarium fish. In addition, the ingredients are designed to bring out the beautiful color of their skin. Feed 2 - 3 times a day by sprinkling the food on the top of the water. Fish should be able to consume all food in 5 minutes. ', 90, 160.00, 'uploadsfish2.jpeg', '2025-01-29 04:56:55', 'fish_food'),
(4, 'kfhnk', 'wiiaehf', 0, 50.00, 'uploads1.png', '2025-01-23 06:05:32', 'dog_food'),
(23, 'Drools', 'dog food', 5, 80.00, 'uplodedownload.jpeg', '2025-01-25 13:40:34', '0'),
(6, 'whiskas', 'cat food', 0, 89.00, 'uploadswhiskas.jpeg', '2025-01-24 15:30:35', 'cat_food'),
(28, 'ZuPreem FruitBlend Flavor with Natural Flavors', 'FruitBlend® Flavor with natural flavors provides healthy and delicious nutrition for everyday feeding for Amazons, Macaws, Cockatoos and other large parrots that prefer this pellet size. Amazons: 1/2 Cup Daily and Macaws, Cockatoos: 1/2 – 1 Cup Daily ', 100, 99.00, 'uploadsbird1.jpg', '2025-01-29 04:42:59', 'bird_food'),
(34, 'POND FISH FOOD ', '11.5 oz., 1.56 lbs., 2.68 lbs. POND FISH FOOD properly supports the health and immune system of your fish using high-quality ingredients such as vitamins, antioxidants, garlic, and prebiotic yeast.  ', 100, 100.00, 'uploadsfish1.jpg', '2025-01-29 04:56:11', 'fish_food'),
(11, 'hallofeed turtle', 'baby turtle food', 0, 100.00, 'uploadsHallofeed turtle.jpg', '2025-01-24 16:57:19', 'turtle_food'),
(12, 'catfood', 'jfhsidf', 0, 40.00, 'uploads1.png', '2025-01-24 17:06:42', 'cat_food'),
(13, 'bunny', 'kdsfhd', 0, 100.00, 'uploadsblack dog collar belt.png', '2025-01-24 17:25:39', 'rabbit_food'),
(14, 'cat food', 'wertyuiop', 0, 350.00, 'uploadswhiskas.jpeg', '2025-01-25 05:06:03', 'cat_food'),
(15, 'cat food', 'wertyuiop', 0, 350.00, 'uploadswhiskas.jpeg', '2025-01-25 05:07:17', 'cat_food'),
(27, 'drool', 'kjsdf', 0, 50.00, 'uploadsdownload.jpeg', '2025-01-25 13:55:24', 'dog_food'),
(29, 'The Birds Company Foxtail Millet.', '450grams. Ideal for Budgies, Lovebirds, Cockatiels, Canaries, Finches like Zebra Finch, Society Finch, Longtail Finch, Java Finch, Gouldian Finch, Owl Finch etc.', 80, 80.00, 'uploadsbird2.jpg', '2025-01-29 04:43:45', 'bird_food'),
(30, ' Jainsons Pet Products Big Parrot Food', ' 0.4kg. FOR BIRDS: This nutrient-rich universal blend food is ideal for canaries, parakeets, finches and other small birds.  Maximum Shelf life- 24 months. ', 150, 100.00, 'uploadsbird3.jpg', '2025-01-29 04:44:34', 'bird_food'),
(31, 'Birds Sparrow Wild Bird Food', 'Brand, Jimmy Pet Products, Packaging Size- 1200g, Packaging Type- Box, Suitable For- Birds, Shelf Life- 12 Months, Minimum Order Quantity- 1. Ingredients: Yellow Millet, Canola Bird Seed, Millet, Flax Seed, Foxtail Millet, Barley, Pearl Millet, Niger Seed. ', 100, 100.00, 'uploadsbird4.jpg', '2025-01-29 04:45:23', 'bird_food'),
(32, 'Panchee Pick Bird Food.', ' JiMMy Pet Products Panchee Pick Bird Food for Budgies (1200gm). Panchee pick ingredients: yellow millet, amaranth seed, white millet, striped sunflower seed, corn flour, millet, niger seed, flax seed, wheat flour, alfalfa meal, safflower seed.  ', 90, 99.00, 'uploadsbird5.jpg', '2025-01-29 04:47:34', 'bird_food'),
(36, 'TAIYO Humpy Head', 'TAIYO Humpy Head Flowerhorn Fish Food (100 gm). Ingredients- Fish and Fish derivatives, Shrimp meal, Soya Meal, Corn Meal, Wheat Flour, Fish Oil, Yeast, Lecithin, Natural Astaxanthin & Spirulina.', 80, 89.00, 'uploadsfish3.jpeg', '2025-01-29 04:57:56', 'fish_food'),
(37, 'TUNAI Tropical Fish Food', 'TUNAI Fish Food for Aquarium with 26% Protien Daily Nutrition Pellet for Health&Growth Shrimp 0.25 kg Dry Adult, New Born, Senior, Young Fish Food. \r\n\r\n  ', 90, 100.00, 'uploadsfish4.jpeg', '2025-01-29 04:58:41', 'fish_food'),
(38, 'Life Aayu Fish Food', ' API Aquarium Products India Life Aayu Fish Food for Freshwater Fishes (Small) Sea Food 0.1 kg Dry New Born, Young, Senior, Adult Fish Food. Suitable for- New Born, Young, Senior, Adult \r\n\r\n ', 90, 100.00, 'uploadsfish5.jpeg', '2025-01-29 04:59:38', 'fish_food'),
(39, 'Aquatic Venturez Fry Food', '35 grams. This highly nutritional granular food pack is specially developed for newborn fish fries. It has well-balanced ingredients which provide a superior protein source and is also rich in multi-vitamins. ', 90, 70.00, 'uploadsfish6.jpg', '2025-01-29 05:00:34', 'fish_food'),
(40, 'Tetra TetraFin Goldfish Flakes', ' 200gm, best selling goldfish food has been optimized with the fishkeepers success in mind. \"Clean & Clear Water Formula\" means that the flakes are even easier to digest and do not leach color, thereby keeping aquarium water clean and clear. \r\n\r\n  ', 90, 100.00, 'uploadsfish7.jpg', '2025-01-29 05:03:20', 'fish_food'),
(41, 'AQUA GOLD', 'AQUA GOLD 32/4 |FLOATING FISH FEED | Dayal Aqua Feed incorporates the latest advances in fish feed nutrition research and is product using advanced technology to give a world class product. \r\n\r\n ', 90, 150.00, 'uploadsfish8.png', '2025-01-29 05:05:00', 'fish_food'),
(42, 'DROOLS BUDGIES FOOD (S).', '  500gm. DROOLS BUDGIES FOOD (S) emerges as a superlative choice for small beak birds, specifically tailored for their intricate dietary needs. This product is a testament to Animals dedication to offering high-quality, nutritious, and natural bird food. With its composition chiefly revolving around a vegetarian formula, its an excellent fit for budgies and similar small birds.   ', 90, 200.00, 'uploadsbird6.jpg', '2025-01-29 05:08:09', 'bird_food'),
(43, 'Harvest Seed & Supply Orchard Blend Wild Bird Food', 'Harvests premium Orchard Blend wild bird food is packed with hearty nuts, oil-rich seeds, and 3 types of fruit to bring the most songbirds to your yard. Ideal for use in tube, hopper, or platform feeders. \r\n\r\n ', 80, 99.00, 'uploadsbird7.jpg', '2025-01-29 05:09:09', 'bird_food'),
(44, 'Versele Laga Prestige', ' 1kg. Versele Laga Prestige Parakeets Bird Food is made full of oil sunflower, white millet, safflower and striped sunflower, they are perfect multi-purpose blends to feed birds at the feeder and on the ground. ', 70, 80.00, 'uploadsbird8.jpeg', '2025-01-29 05:12:36', 'bird_food');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `address`, `phone`, `email`, `password`, `token`) VALUES
(25, 'Sonam Kumari', '', '0', 'sonam@gmail.com', '2dfadf1c87039ffa7beca3f732d544c4', '25-952c3ff98a6acdc36497d839e31aa57c'),
(26, 'Chandan', '', '0', 'Chan@yahoo.com', 'b18f2dfcfc1c94c17e43419b7e8f788b', '26-9a3f54913bf27e648d1759c18d007165'),
(27, 'sonam sinha', '', '0', 'sonamaztech@gmail.com', '9e6398df22f2073b579131506d2adae3', '27-829083d7452626f6e64b96ec0b734811'),
(23, 'chirag', '', '0', 'chirag@gmail.com', '7323d2248f2fab5b7a698a6fbf28715d', '23-605ac7e4c16b8a013b4779b81f883e66'),
(24, 'nausheen', '', '0', 'nausheen@123gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '24-55d99a37b2e1badba7c8df4ccd506a88'),
(28, 'shalu', '', '0', 'shalu@gmail.com', '41691b886d6222134bf2c1949f2fcf08', '28-9d12d071c18b535cda26f47f20e5c7ae'),
(29, 'anju', '', '0', 'anju@gmail.com', '9abfae448bc00ea3214033a3086e6539', NULL),
(30, 'manju', '', '0', 'manju@gmail.com', '$2y$10$unLshJuQpL2XwJKLtmNlwuMw2rZHtF/.hPDEekgHx0Zx77z4W0tk.', NULL),
(37, 'Harsh Verma', 'alkapuri, patna', '1234512345', 'harsh@gmail.com', '$2y$10$DLxTxoXAapAM.B37qb3s8OGHd0bwBYWfYvMu2RxlMHOTWBA8/ZWJa', 'b0d37afcac73806cd6b75ad48441d9d3'),
(38, 'ritesh ', 'alkapuri, patna', '1234512345', 'ritesh@gmail.com', '$2y$10$n4HOkQ5fazyId8brUd39OuaVIB9gLntKpNTSjCS6Orm7eNur1gbeO', NULL),
(33, 'adminadmin', '', '0', 'admin@gmail.com', '$2y$10$r2akY28GvdzsIqj.lwNmpuE4QvJxGwX8xzgeVxEAFTlFzcw6VB2Oi', NULL),
(39, 'om prakash', 'beiley road, patna', '4545456767', 'prakash@gmail.com', '$2y$10$kOjRCV6sWmRszpOiH.KHNOtGIh4rYMYZDHqKm8Dgr/vywzAdek1IC', NULL),
(36, 'rashmi kumari', 'patna', '9090909090', 'rash@gmail.com', '$2y$10$dmlB1CGpI8LXdfyWHTpWEOzPVXUjSDcZloa3rb1gOkU3n9DLtsI62', NULL),
(40, 'navya', 'fbjewf', '7878787878', 'ajsbd@gmail.com', '$2y$10$ZzAeX1lzaBG9YQKuTnw5S.djKI897q4pGM8XPJEFvfwCCUZpmKqxO', NULL),
(41, 'lokesh', 'nainital', '8908908908', 'lok@gmail.com', '$2y$10$oslXSNdS5N8r18IYUiaWZ.xBJcknASaqR6DtFgUVLxB7jOkVRTxmi', NULL),
(42, 'sohel', 'nadha', '1234567890', 'sohel@gmail.com', '$2y$10$wLjknoZJ5RCtgkzgMridtO4Gsl1Lk9ezeuYnDXrQFexe62vg5bW3a', NULL),
(43, 'sonani', 'efhs', '3434343434', 'sona@gmial.com', '$2y$10$aMgbdQXPsRVhjDBPIWdDzee8hVyHHYATHE/k011n5pQO3vBWaYq6G', '07a89a8dbf5be3296bf460d285c33610'),
(44, 'sudhesh', 'iejgjw', '7878787899', 'sudh@gmail.com', '$2y$10$PzJB6vuk0YA6vmocWlYZTO9uDbilNCnHtvrzaTuae8gNgYapkr3pG', NULL),
(45, 'sushil', 'ronatpur,patna', '4567845678', 'sushi@gmail.com', '$2y$10$iO/hTJ0Wsm1zfEJOy.gb5O1o.7GGUfQGb6U6LrPs8xcDQsJrsC7Qi', NULL),
(46, 'rujula', 'fhysdgfjs', '8908908900', 'rujula@gmail.com', '$2y$10$LmUvm9jyzW3RWxCyn/yO/eygXwdqHSxJgVkiFM.MryVIdBsAzyaB.', NULL),
(47, 'sharan', 'ihfkff', '9090898900', 'sharan@gmail.com', '$2y$10$HQPF7OzSFeSSTKwh.nmbJOpZsQWor0L1SKtDwgSB4LNiEylvnfEMe', NULL),
(48, 'Sokar', 'kdkssd', '9089089089', 'sokar@gmail.com', '$2y$10$Ot8IQ4mbANspzhilYn61aOEDL0Y29AP/4tK0BFGy.2eQhVzvcerau', NULL),
(49, 'Archi', 'Phulwari, patna', '1010101010', 'archi@gmail.com', '$2y$10$SnYw5pZfwYrSUCSWDAoWkuF8pKRJk1uSdJs5BxownadoWE3Y5qqNK', 'e91704facf3cbed1dd24e288c5381cd8'),
(50, 'Aman Kumar', 'alinagar', '8908908900', 'aman@gmail.com', '$2y$10$D0rns3VwTidKO/1Wf6/p5ONCEEAxMU0mmARuS20SdwY388jWa5Toa', '56dfe7ca7fe79b6fc18e761f6ec0fad8'),
(51, 'Anshuman', 'khdfksh', '8912891210', 'anshu@gmail.com', '$2y$10$ylBwpcZbuxjeUm4t7MKti.MGLw8IF6Lh8DoRiqXCyHQD4GW1qwDb6', NULL),
(52, 'sukriti', 'alinashabad', '7890789089', 'suk@gmail.com', '$2y$10$f7muAsU3/M2HL282OEhYtuVgsAakN2e1j4hrBLuhczRlGaU2mfAXW', '943b0467b922bac83e82750ab539abc1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`) VALUES
(8, 'Archita Verma', '7209186598.av@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '8-67038aaa'),
(9, 'vandana', 'vandana@gmail.com', 'e5a443b39e03eef4dc7ef39056a3a59e', '9-575afbdc'),
(5, 'riya', 'riya1@gmail.com', '9de38263ec7e1051f9e78fd6f1c35a2b', '5-78aa9cdf'),
(6, 'sneha', 'sneha@gmail.com', '990a559f923c9c482fe1ceade918de2e', '6-bb1443cc'),
(7, 'chhata', 'chhata@gmail.com', '26f6aaa024475f00227c685741781d49', '7-60cb558c');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
