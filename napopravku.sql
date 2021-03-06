-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 08 2017 г., 18:45
-- Версия сервера: 5.5.53
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `napopravku`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_doctor`
--

CREATE TABLE `tbl_doctor` (
  `id` int(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profession_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tbl_doctor`
--

INSERT INTO `tbl_doctor` (`id`, `name`, `profession_id`) VALUES
(1, 'Селиванов Петр Андреевич', 1),
(2, 'Андреева Антонина Юрьевна', 2),
(3, 'Григорьев Михаил Ефимович', 3),
(4, 'Васильева Вера Сергеевна', 1),
(5, 'Иванов Юрий Петрович', 2),
(6, 'Сидорова Анна Тихомировна', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_last_update`
--

CREATE TABLE `tbl_last_update` (
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profession`
--

CREATE TABLE `tbl_profession` (
  `id` int(6) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tbl_profession`
--

INSERT INTO `tbl_profession` (`id`, `name`) VALUES
(1, 'Хирург'),
(2, 'Окулист'),
(3, 'Эндокринолог');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_receptions`
--

CREATE TABLE `tbl_receptions` (
  `id` int(6) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(5) CHARACTER SET utf8 NOT NULL,
  `doctor_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `auth_key` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `password`, `phone`, `email`, `auth_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$13$KJ720jOBwsttw83YYtCq9uu40b.0O1qYT5.7kpxNgwU9y3mOg3.zi', '+79522275990', 'chelovek-18@yandex.ru', 'v5E36j-9YjKnWnb61VN2A2XJlxPrqMBw', 10, 1491075071, 1491075742);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_working_sheet`
--

CREATE TABLE `tbl_working_sheet` (
  `id` int(6) NOT NULL,
  `date` date NOT NULL,
  `doctor_ids` varchar(100) CHARACTER SET utf32 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tbl_working_sheet`
--

INSERT INTO `tbl_working_sheet` (`id`, `date`, `doctor_ids`) VALUES
(1, '2017-04-03', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(2, '2017-04-04', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(3, '2017-04-05', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(4, '2017-04-06', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(5, '2017-04-07', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(6, '2017-04-10', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(7, '2017-04-11', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(8, '2017-04-12', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(9, '2017-04-13', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(10, '2017-04-14', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(11, '2017-04-17', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(12, '2017-04-18', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(13, '2017-04-19', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(14, '2017-04-20', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(15, '2017-04-21', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(16, '2017-04-24', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(17, '2017-04-25', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(18, '2017-04-26', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(19, '2017-04-27', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(20, '2017-04-28', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(21, '2017-05-01', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(22, '2017-05-02', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(23, '2017-05-03', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(24, '2017-05-04', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(25, '2017-05-05', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(26, '2017-05-08', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(27, '2017-05-09', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(28, '2017-05-10', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(29, '2017-05-11', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(30, '2017-05-12', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(31, '2017-05-15', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(32, '2017-05-16', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(33, '2017-05-17', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(34, '2017-05-18', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(35, '2017-05-19', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(36, '2017-05-22', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(37, '2017-05-23', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(38, '2017-05-24', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(39, '2017-05-25', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(40, '2017-05-26', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(41, '2017-05-29', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}'),
(42, '2017-05-30', '{\"4\": \"09.00-12.00+13.00-17.00\", \"5\": \"09.00-12.00+13.00-17.00\", \"6\": \"09.00-12.00+13.00-17.00\"}'),
(43, '2017-05-31', '{\"1\": \"09.00-12.00+13.00-17.00\", \"2\": \"09.00-12.00+13.00-17.00\", \"3\": \"09.00-12.00+13.00-17.00\"}');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_profession`
--
ALTER TABLE `tbl_profession`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_receptions`
--
ALTER TABLE `tbl_receptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `tbl_working_sheet`
--
ALTER TABLE `tbl_working_sheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_doctor`
--
ALTER TABLE `tbl_doctor`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `tbl_profession`
--
ALTER TABLE `tbl_profession`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `tbl_receptions`
--
ALTER TABLE `tbl_receptions`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `tbl_working_sheet`
--
ALTER TABLE `tbl_working_sheet`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
