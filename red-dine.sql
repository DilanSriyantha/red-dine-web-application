-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2024 at 08:34 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `red-dine`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `categoryImage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryImage`) VALUES
(2, 'Kottu', 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Chicken_Kottu.jpg/640px-Chicken_Kottu.jpg'),
(3, 'Fried Rice', 'https://www.seriouseats.com/thmb/BJjCEDw9OZe95hpZxmNcD3rJnHo=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/20230529-SEA-EggFriedRice-AmandaSuarez-hero-c8d95fbf69314b318bc279159f582882.jpg'),
(4, 'Pizza', 'https://www.southernliving.com/thmb/3x3cJaiOvQ8-3YxtMQX0vvh1hQw=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/2652401_QFSSL_SupremePizza_00072-d910a935ba7d448e8c7545a963ed7101.jpg'),
(5, 'Soup', 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/cat_img_3277_Tomato-Soup-3-scaled.jpg?alt=media'),
(6, 'Burgers', 'https://www.foodandwine.com/thmb/pwFie7NRkq4SXMDJU6QKnUKlaoI=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/Ultimate-Veggie-Burgers-FT-Recipe-0821-5d7532c53a924a7298d2175cf1d4219f.jpg'),
(7, 'Noodles', 'https://tiffycooks.com/wp-content/uploads/2021/09/Screen-Shot-2021-09-21-at-5.21.37-PM.png');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderItemId` int NOT NULL AUTO_INCREMENT,
  `productId` int NOT NULL,
  `orderId` int NOT NULL,
  `productName` text NOT NULL,
  `qty` int NOT NULL,
  `unitCost` double NOT NULL,
  `total` double NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`orderItemId`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderItemId`, `productId`, `orderId`, `productName`, `qty`, `unitCost`, `total`, `status`) VALUES
(6, 11, 22, 'Chicken Fried Rice', 2, 160, 320, 0),
(7, 17, 23, 'Vegetable Pizza', 2, 175, 350, 0),
(5, 17, 21, 'Vegetable Pizza', 3, 175, 525, 0),
(8, 14, 23, 'Pepperoni Pizza (L)', 3, 165, 495, 0),
(9, 14, 24, 'Pepperoni Pizza (L)', 3, 165, 495, 0),
(10, 6, 25, 'Masala Kottu', 2, 160, 320, 0),
(11, 13, 25, 'Mixed Fried Rice', 2, 360, 720, 0),
(12, 8, 25, 'Mutton Kottu', 1, 360, 360, 0),
(13, 6, 26, 'Masala Kottu', 1, 160, 160, 0),
(14, 17, 26, 'Vegetable Pizza', 2, 175, 350, 0),
(15, 14, 26, 'Pepperoni Pizza (L)', 3, 165, 495, 0),
(16, 6, 27, 'Masala Kottu', 1, 160, 160, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `utensils` tinyint(1) NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `subtotal` double NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `utensils`, `note`, `subtotal`, `time`, `status`) VALUES
(21, 7, 0, '', 525, '2024-05-17 18:33:06', 'completed'),
(22, 7, 0, '', 320, '2024-05-17 18:36:47', 'completed'),
(23, 7, 0, '', 845, '2024-05-17 18:37:36', 'completed'),
(24, 8, 0, '', 495, '2024-05-17 20:33:05', 'pending'),
(26, 7, 0, '', 1005, '2024-05-18 01:21:03', 'pending'),
(25, 7, 0, '', 1400, '2024-05-17 23:00:00', 'pending'),
(27, 7, 0, '', 160, '2024-05-18 01:34:45', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `categoryId` int NOT NULL,
  `productName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `productDescription` text NOT NULL,
  `productPrice` double NOT NULL,
  `productImage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `veg` tinyint(1) NOT NULL,
  `popular` tinyint(1) NOT NULL DEFAULT '0',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `categoryId`, `productName`, `productDescription`, `productPrice`, `productImage`, `veg`, `popular`, `featured`) VALUES
(13, 3, 'Mixed Fried Rice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 360, 'https://i.ytimg.com/vi/_TgNmKDd40w/maxresdefault.jpg', 0, 1, 0),
(14, 4, 'Pepperoni Pizza (L)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 165, 'https://www.simplyrecipes.com/thmb/KE6iMblr3R2Db6oE8HdyVsFSj2A=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__simply_recipes__uploads__2019__09__easy-pepperoni-pizza-lead-3-1024x682-583b275444104ef189d693a64df625da.jpg', 0, 1, 0),
(15, 4, 'Hawaiian Pizza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 260, 'https://hips.hearstapps.com/hmg-prod/images/hawaiian-pizza-index-65f4641de4b08.jpg?crop=1.00xw:1.00xh;0,0&resize=1200:*', 0, 0, 0),
(16, 4, 'Seafood Pizza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 360, 'https://mojo.generalmills.com/api/public/content/yFWkG7p5xUmxGBaShNbjNA_gmi_hi_res_jpeg.jpeg?v=0b390e42&t=466b54bb264e48b199fc8e83ef1136b4', 0, 0, 0),
(17, 4, 'Vegetable Pizza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 175, 'https://cdn.loveandlemons.com/wp-content/uploads/2023/02/vegetarian-pizza.jpg', 1, 1, 0),
(19, 4, 'Onion & Olive Pizza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 275, 'https://www.homecookingadventure.com/wp-content/uploads/2022/01/tuna-and-red-onion-pizza.jpg', 1, 0, 0),
(6, 2, 'Masala Kottu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry', 160, 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/prod_img_4932_image5.jpg?alt=media', 0, 0, 1),
(7, 2, 'Cheese Kottu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 260, 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/prod_img_9026_00cd4169-0f2e-464e-a351-bad5bb7c391b.jpeg?alt=media', 0, 0, 0),
(8, 2, 'Mutton Kottu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry', 360, 'https://media-cdn.tripadvisor.com/media/photo-s/1a/b5/d6/7e/mutton-kothu-parota.jpg', 0, 1, 0),
(9, 2, 'Beef Kottu', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry', 460, 'https://img.taste.com.au/rIljzoV7/taste/2022/09/sri-lankan-beef-kottu-roti-181296-1.jpg', 0, 0, 1),
(22, 7, 'Chicken Noodles', 'lorem ipsum', 250, 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/prod_img_6427_main-header.webp?alt=media', 0, 0, 1),
(10, 2, 'Dolphin Kottu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 560, 'https://media-cdn.tripadvisor.com/media/photo-m/1280/1b/29/f9/4d/dolphin-kottu-chicken.jpg', 0, 0, 0),
(11, 3, 'Chicken Fried Rice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 160, 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/prod_img_2063_Chicken-Fried-Rice-square-FS-.jpg?alt=media', 0, 1, 1),
(12, 3, 'Seafood Fried Rice', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 260, 'https://images.notquitenigella.com/images/seafood-fried-rice/ll.jpg', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `master` tinyint(1) NOT NULL DEFAULT '0',
  `userName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userEmail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userPassword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userAddress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userContactNumber` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userImage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `master`, `userName`, `userEmail`, `userPassword`, `userAddress`, `userContactNumber`, `userImage`) VALUES
(5, 1, 'Dilan', 'dilans091@gmail.com', 'ggwp', 'No.1/A, Old Buttala Road, Sella Kataragama', '0764886903', 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/usr_img_7245_me_cropped.jpg?alt=media'),
(7, 0, 'Sadini', 'sadinik091@gmail.com', 'ggwp', 'No.1/A, Old Buttala Road, Sella Kataragama', '0701363615', 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/usr_img_7734_105A6064.JPG?alt=media'),
(8, 0, 'Johny Silverhand', 'johny@gmail.com', 'ggwp', 'gg, wp, night city', '0701363615', 'https://firebasestorage.googleapis.com/v0/b/red-dine-webapp.appspot.com/o/usr_img_4682_Johnny_Silverhand.webp?alt=media');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
