-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 31 2019 г., 09:57
-- Версия сервера: 10.1.28-MariaDB
-- Версия PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `e_wallet_tt`
--
DROP DATABASE IF EXISTS `e_wallet_tt`;
CREATE DATABASE IF NOT EXISTS `e_wallet_tt` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `e_wallet_tt`;

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`id`, `name`, `country`, `city`) VALUES
(1, 'fara', 'uzbekistan', 'tashkent');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `name`) VALUES
(1, 'USD'),
(2, 'EUR'),
(3, 'GBP'),
(4, 'JPY'),
(5, 'CHF'),
(6, 'CAD'),
(7, 'AUD'),
(8, 'RUB');

-- --------------------------------------------------------

--
-- Структура таблицы `currency_quote`
--

CREATE TABLE `currency_quote` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `quote` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency_quote`
--

INSERT INTO `currency_quote` (`id`, `date`, `currency_id`, `quote`) VALUES
(27, '2017-02-21', 1, 1),
(28, '2017-02-21', 2, 1.12),
(29, '2017-02-21', 3, 1.3),
(30, '2017-02-21', 4, 0.009),
(31, '2017-02-21', 5, 1.004),
(32, '2017-02-21', 6, 0.74),
(33, '2017-02-21', 7, 0.71),
(34, '2017-02-21', 8, 0.015),
(35, '2019-03-30', 1, 1),
(36, '2019-03-30', 2, 1.12),
(37, '2019-03-30', 3, 1.3),
(38, '2019-03-30', 4, 0.009),
(39, '2019-03-30', 5, 1.004),
(40, '2019-03-30', 6, 0.74),
(41, '2019-03-30', 7, 0.71),
(42, '2019-03-30', 8, 0.015);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1553871296),
('m190329_145602_add_tbl__client', 1553871525),
('m190329_145952_add_tbl__currency', 1553872278),
('m190329_150014_add_tbl__currency_quote', 1553872278),
('m190329_151201_add_tbl__wallet', 1553872566),
('m190329_151213_add_tbl__transfer_log', 1553872566),
('m190330_180813_update_tbl__transfer_log', 1553969465);

-- --------------------------------------------------------

--
-- Структура таблицы `transfer_log`
--

CREATE TABLE `transfer_log` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `wallet_from` int(11) NOT NULL,
  `wallet_to` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `info` text NOT NULL,
  `amount_in_usd` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `transfer_log`
--

INSERT INTO `transfer_log` (`id`, `amount`, `wallet_from`, `wallet_to`, `time`, `info`, `amount_in_usd`) VALUES
(21, 7466.67, 1, 2, '2019-03-30 20:38:29', '{\"amount\":100,\"amount_in_usd\":112.00000000000001,\"amount_in_end\":7466.666666666668,\"currency_from\":\"EUR\"}', 112),
(22, 4.01786, -1, 1, '2019-03-30 21:47:43', '{\"amount\":300,\"amount_in_usd\":4.5,\"amount_in_end\":4.017857142857142,\"currency_from\":\"RUB\"}', 4.5),
(23, 4017.86, -1, 1, '2019-03-30 21:47:50', '{\"amount\":300000,\"amount_in_usd\":4500,\"amount_in_end\":4017.8571428571427,\"currency_from\":\"RUB\"}', 4500),
(24, 746.667, 1, 2, '2019-03-30 21:48:00', '{\"amount\":10,\"amount_in_usd\":11.200000000000001,\"amount_in_end\":746.6666666666667,\"currency_from\":\"EUR\"}', 11.2);

-- --------------------------------------------------------

--
-- Структура таблицы `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wallet`
--

INSERT INTO `wallet` (`id`, `guid`, `client_id`, `currency_id`, `balance`) VALUES
(1, 'lOQPyb4i', 1, 2, 4273.62),
(2, 'TO4b6uQE', 1, 8, 8213.34),
(4, 'JtkRka_3', 1, 1, 0),
(5, 'AIkiAv0n', 1, 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency_quote`
--
ALTER TABLE `currency_quote`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `transfer_log`
--
ALTER TABLE `transfer_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `currency_quote`
--
ALTER TABLE `currency_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `transfer_log`
--
ALTER TABLE `transfer_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
