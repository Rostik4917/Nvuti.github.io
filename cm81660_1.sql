-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 07 2020 г., 16:52
-- Версия сервера: 5.6.39-83.1
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cm81660_1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kot_config`
--

CREATE TABLE IF NOT EXISTS `kot_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(50) NOT NULL DEFAULT 'KotDev',
  `sitedomen` varchar(50) NOT NULL,
  `sitegroup` varchar(50) NOT NULL,
  `sitesupport` varchar(150) NOT NULL,
  `sitekey` varchar(150) NOT NULL,
  `sitemail` varchar(50) NOT NULL,
  `min_bonus_size` varchar(50) NOT NULL DEFAULT '1',
  `max_bonus_size` varchar(50) NOT NULL DEFAULT '10',
  `min_withdraw_sum` varchar(50) NOT NULL DEFAULT '50',
  `bonus_reg` varchar(50) NOT NULL DEFAULT '5',
  `fk_id` varchar(50) NOT NULL,
  `fk_secret_1` varchar(50) NOT NULL,
  `fk_secret_2` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `kot_config`
--

INSERT INTO `kot_config` (`id`, `sitename`, `sitedomen`, `sitegroup`, `sitesupport`, `sitekey`, `sitemail`, `min_bonus_size`, `max_bonus_size`, `min_withdraw_sum`, `bonus_reg`, `fk_id`, `fk_secret_1`, `fk_secret_2`) VALUES
(1, 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019', 'https://vk.com/almiev2019');

-- --------------------------------------------------------

--
-- Структура таблицы `kot_games`
--

CREATE TABLE IF NOT EXISTS `kot_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `cel` varchar(50) NOT NULL,
  `sum` varchar(50) NOT NULL,
  `chance` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `win_summa` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kot_payments`
--

CREATE TABLE IF NOT EXISTS `kot_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `suma` varchar(50) NOT NULL,
  `data` varchar(50) NOT NULL,
  `qiwi` varchar(50) NOT NULL,
  `transaction` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kot_promo`
--

CREATE TABLE IF NOT EXISTS `kot_promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `is_admin` varchar(1) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `sum` varchar(50) NOT NULL,
  `active` varchar(50) NOT NULL,
  `actived` varchar(50) NOT NULL DEFAULT '0',
  `id_active` varchar(1500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kot_user`
--

CREATE TABLE IF NOT EXISTS `kot_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `vk_name` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `img` varchar(250) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `social` varchar(150) NOT NULL,
  `bdate` varchar(50) NOT NULL,
  `online` varchar(1) NOT NULL DEFAULT '1',
  `admin` varchar(1) NOT NULL DEFAULT '0',
  `ban` varchar(1) NOT NULL DEFAULT '0',
  `sliv` varchar(1) NOT NULL DEFAULT '0',
  `win` varchar(1) NOT NULL DEFAULT '0',
  `ref_id` varchar(11) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL,
  `date_reg` varchar(50) NOT NULL,
  `online_time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `kot_withdraws`
--

CREATE TABLE IF NOT EXISTS `kot_withdraws` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `ps` varchar(50) NOT NULL,
  `wallet` varchar(50) NOT NULL,
  `sum` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `fake` varchar(1) NOT NULL DEFAULT '0',
  `login_fake` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
