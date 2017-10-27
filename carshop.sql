-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 27 2017 г., 11:58
-- Версия сервера: 5.6.16
-- Версия PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `carshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carshop_cars`
--

CREATE TABLE IF NOT EXISTS `carshop_cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `motor` float NOT NULL,
  `speed` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `carshop_cars`
--

INSERT INTO `carshop_cars` (`id`, `model`, `brand`, `year`, `motor`, `speed`, `color`, `price`) VALUES
(1, 'lanos', 'daewoo', 2004, 1.2, 220, 'red', '44239.20'),
(2, 'x4', 'bmw', 2010, 3.2, 260, 'black', '22363.30'),
(3, 'z4', 'bmw', 2011, 2.2, 240, 'blue', '33255.65'),
(4, '100', 'audi', 1998, 2, 220, 'white', '88315.20'),
(5, 'octavia', 'shkoda', 2001, 2.2, 220, 'black', '56221.00'),
(6, 'sandera', 'renault', 2010, 2.2, 230, 'white', '56233.20'),
(7, 'sandera', 'renault', 2011, 2.5, 230, 'red', '65442.20'),
(8, 'x5', 'bmw', 2010, 3.2, 230, 'white', '88652.21'),
(9, 'rapid', 'shkoda', 2010, 2.1, 220, 'white', '45287.33');

-- --------------------------------------------------------

--
-- Структура таблицы `carshop_orders`
--

CREATE TABLE IF NOT EXISTS `carshop_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_car` int(11) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `status` varchar(222) NOT NULL DEFAULT 'ordered',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Структура таблицы `carshop_users`
--

CREATE TABLE IF NOT EXISTS `carshop_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
