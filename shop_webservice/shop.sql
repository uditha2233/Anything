-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2014 at 07:26 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(30) NOT NULL DEFAULT 'no subject',
  `fromid` int(5) NOT NULL DEFAULT '0',
  `toid` int(5) NOT NULL DEFAULT '0',
  `msgtime` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL DEFAULT '1',
  `message` varchar(1000) NOT NULL,
  `about` varchar(25) NOT NULL DEFAULT 'Other',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `subject`, `fromid`, `toid`, `msgtime`, `state`, `message`, `about`) VALUES
(1, 'hi', 1, 1, '', '1', 'he', 'nokia lumia'),
(3, 'I want to buy this', 1, 1, '', '1', 'Sorry I want buy this item', 'nokia lumia'),
(4, 'I want to buy this', 1, 1, '', '1', 'Sorry I want buy this item Sorry I want buy this item Sorry I want buy this item', 'nokia lumia'),
(5, 'I want to buy this', 1, 1, '', '1', 'Sorry I want buy this item \r\nSorry I want buy this item Sorry I want buy this item', 'nokia lumia'),
(6, 'I want to buy this', 1, 1, '', '0', 'Sorry I want buy this item \r\nSorry I want buy this item Sorry I want buy this item', 'nokia lumia'),
(7, 'I want to buy this', 1, 1, '', '1', 'Sorry I want buy this item \r\nSorry I want buy this item Sorry I want buy this item', 'nokia lumia'),
(8, 'I want to buy this', 1, 1, '', '0', 'Sorry I want buy this item \r\nSorry I want buy this item Sorry I want buy this item', 'nokia lumia'),
(11, 'wow', 2, 1, '', '1', 'it s work find for me.', 'mp3 player'),
(12, 'hello root', 1, 1, '', '1', 'I want to buy this.', 'portable hard'),
(13, 'hello seller', 2, 1, '2014-05-16 14:00:14', '1', 'I m interesting ur item..', 'sony xperia z1'),
(27, 'wow', 1, 2, '2014-05-16 14:31:24', '1', 'yes sure.', 'mp3 player');

-- --------------------------------------------------------

--
-- Table structure for table `shop_items`
--

CREATE TABLE IF NOT EXISTS `shop_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(25) NOT NULL,
  `item_price` varchar(10) NOT NULL,
  `item_description` varchar(150) NOT NULL,
  `item_owner` int(10) NOT NULL,
  `item_category` varchar(20) NOT NULL DEFAULT '6',
  `item_quantity` int(2) NOT NULL,
  `item_image` varchar(50) NOT NULL,
  `valid` int(2) NOT NULL DEFAULT '0',
  `addedtime` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `shop_items`
--

INSERT INTO `shop_items` (`id`, `item_name`, `item_price`, `item_description`, `item_owner`, `item_category`, `item_quantity`, `item_image`, `valid`, `addedtime`) VALUES
(1, 'nokia lumia', '25000', 'brand new nokia lumia', 1, '', 0, 'anonymous.jpg', 1, ''),
(3, 'sony xperia z', '34000', 'sony xperia z brand new conditions', 1, '1', 13, 'anonymous.jpg', 1, ''),
(4, 'Samsung s4', '45000', 'new phone', 1, '1', 12, 'anonymous.jpg', 1, ''),
(5, 'galaxy s2', '23000', 'good', 1, '1', 2, 'anonymous.jpg', 1, ''),
(7, 'sony xperia z1', '34000', 'xperia z1', 1, '1', 1, 'anonymous.jpg', 1, ''),
(9, 'toshiba hard', '8000', 'brand new', 1, '2', 3, 'anonymous.jpg', 1, ''),
(10, 'nokia lumia 720', '20000', 'good ', 1, '1', 4, 'anonymous.jpg', 1, ''),
(11, 'sony handset', '10000', 'good', 1, '1', 2, 'anonymous.jpg', 1, ''),
(12, 'fgfg', 'gfg', 'gfg', 1, '1', 1, '21.jpg', 0, '1'),
(13, 'hellow odd', 'fff', 'ffff', 1, '1', 1, 'Untitled.jpg', 0, '2014-05-17 15:30:43'),
(14, 'gggg', '4444', 'gggggg', 1, '1', 444, '1641374563_1399793621.png', 0, '2014-05-17 16:14:11'),
(15, 'hello ', 'fff', 'fffff', 1, '4', 1, '21.jpg', 0, '2014-05-17 16:23:59'),
(16, 'dddddd', 'ddd', 'dddddddddddddd', 1, '2', 1, 'facebook-cover-photo-5.jpg', 0, '2014-05-17 16:30:30'),
(17, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:35:56'),
(18, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:36:09'),
(19, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:36:34'),
(20, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:36:55'),
(21, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:37:17'),
(22, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:37:36'),
(23, 'gggg', 'gg', 'ggg', 1, '2', 1, '21.jpg', 0, '2014-05-17 16:37:58'),
(24, 'nokia aquea', '5555', 'aaaaaaaaaaaaaaaaa', 1, '3', 1, '$_57.JPG', 0, '2014-05-17 16:49:24'),
(25, 'nokia aqueafffffffffff', '555', 'ffff', 2, '1', 1, 'wireless_hero.jpg', 0, '2014-05-17 16:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `location` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `fullname`, `email`, `phone`, `location`) VALUES
(1, 'root', 'root', 'Dumidu Madushanka', 'dumidu14@gmail.com', '0713881834', 'no 331, KAhahena, wa'),
(2, 'Dumidu', '1234', 'Dumidu Madushanka', 'dumidu47@gmail.com', '0757393548', 'no331'),
(3, 'Dumidua', '1234', 'dumidu madushanka', 'duidfu@gmail.com', '07133344', 'rrrrr'),
(4, 'uditha', '1234', 'dumidu madushanka', 'duidu@gmail.com', '07133344', 'rrrrr'),
(5, 'uditharr', '1234', 'dumidu madushanka', 'duiduvv@gmail.com', '07133344', 'rrrrr'),
(6, 'uditharfr', '1234', 'dumidu madushanka', 'duidfuvv@gmail.com', '07133344', 'rrrrr'),
(7, 'uditharfrhh', '1234', 'dumidu madushanka', 'duidfuhvv@gmail.com', '07133344', 'rrrrr'),
(8, 'aaauditharfrhh', '1234', 'dumidu madushanka', 'aaduidfuhvv@gmail.com', '07133344', 'rrrrr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
