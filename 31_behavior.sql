-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2022 г., 07:55
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `31_behavior`
--

-- --------------------------------------------------------

--
-- Структура таблицы `behavior_student`
--

CREATE TABLE `behavior_student` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `type_behavior` int DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `behavior_student`
--

INSERT INTO `behavior_student` (`id`, `student_id`, `type_behavior`, `date`) VALUES
(4, 4, 1, '2019-09-02'),
(5, 6, 1, '2019-09-02'),
(6, 6, 1, '2019-09-02'),
(9, 8, NULL, '2019-09-03'),
(10, 8, NULL, '2019-09-03'),
(13, 4, 1, '2019-09-04'),
(14, 4, 1, '2019-09-04'),
(15, 6, 5, '2019-09-04'),
(16, 6, 5, '2019-09-04'),
(17, 8, 5, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(3, 'АИС - 34'),
(1, 'АСУ - 24');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `groups_id` int DEFAULT NULL,
  `birth_year` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `name`, `groups_id`, `birth_year`) VALUES
(2, 'Лопаткин', 3, 2002),
(4, 'Красов', 3, 2003),
(6, 'Лесовский', 1, 2004),
(8, 'Орлов', 1, 2002);

-- --------------------------------------------------------

--
-- Структура таблицы `type_behavior`
--

CREATE TABLE `type_behavior` (
  `id` int NOT NULL,
  `behavior` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `type_behavior`
--

INSERT INTO `type_behavior` (`id`, `behavior`) VALUES
(5, 'Удовлетвор'),
(1, 'Хорош');

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `v`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `v` (
`id` int
,`name` varchar(30)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `v1`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `v1` (
`id` int
,`name` varchar(30)
,`behavior` varchar(10)
);

-- --------------------------------------------------------

--
-- Структура для представления `v`
--
DROP TABLE IF EXISTS `v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v`  AS SELECT `students`.`id` AS `id`, `students`.`name` AS `name` FROM `students` ;

-- --------------------------------------------------------

--
-- Структура для представления `v1`
--
DROP TABLE IF EXISTS `v1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v1`  AS SELECT `students`.`id` AS `id`, `students`.`name` AS `name`, `type_behavior`.`behavior` AS `behavior` FROM (`students` join `type_behavior`) ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `behavior_student`
--
ALTER TABLE `behavior_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `type_behavior` (`type_behavior`),
  ADD KEY `date` (`date`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `groups_id` (`groups_id`),
  ADD KEY `birth_year` (`birth_year`);

--
-- Индексы таблицы `type_behavior`
--
ALTER TABLE `type_behavior`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `behavior` (`behavior`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `behavior_student`
--
ALTER TABLE `behavior_student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `type_behavior`
--
ALTER TABLE `type_behavior`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `behavior_student`
--
ALTER TABLE `behavior_student`
  ADD CONSTRAINT `behavior_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `behavior_student_ibfk_2` FOREIGN KEY (`type_behavior`) REFERENCES `type_behavior` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
