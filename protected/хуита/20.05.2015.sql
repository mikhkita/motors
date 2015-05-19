-- phpMyAdmin SQL Dump
-- version 4.3.0
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 20 2015 г., 05:13
-- Версия сервера: 5.6.22
-- Версия PHP: 5.4.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `motors`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `car` varchar(1024) DEFAULT NULL,
  `logo` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mark`
--

INSERT INTO `mark` (`id`, `name`, `car`, `logo`) VALUES
(2, 'Авто', 'p19ln6me3mhu51o0b1875h3n8b6j.png', 'p19ln6m96d7ps1lv9115k1fpbkbae.png'),
(3, 'asdasdas', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `model_names`
--

CREATE TABLE IF NOT EXISTS `model_names` (
`id` smallint(5) unsigned NOT NULL,
  `code` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `vin_name` varchar(128) NOT NULL,
  `rod_name` varchar(128) NOT NULL,
  `admin_menu` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(6) DEFAULT '9999'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `model_names`
--

INSERT INTO `model_names` (`id`, `code`, `name`, `vin_name`, `rod_name`, `admin_menu`, `sort`) VALUES
(1, 'mark', 'Марки', 'Марку', 'Марки', 1, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`usr_id` int(11) NOT NULL,
  `usr_login` varchar(128) NOT NULL,
  `usr_password` varchar(128) NOT NULL,
  `usr_name` varchar(255) NOT NULL,
  `usr_email` varchar(128) NOT NULL,
  `usr_role` varchar(20) NOT NULL,
  `usr_state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`usr_id`, `usr_login`, `usr_password`, `usr_name`, `usr_email`, `usr_role`, `usr_state`) VALUES
(1, 'root', 'eaaba36a95aedcfd1c21a0d011e12ecd', 'Иванов И.И.', 'beatbox787@gmail.com', 'root', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_names`
--
ALTER TABLE `model_names`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mark`
--
ALTER TABLE `mark`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `model_names`
--
ALTER TABLE `model_names`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
