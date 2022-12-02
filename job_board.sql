-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2022 г., 09:21
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
-- База данных: `job_board`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `categories` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `categories`) VALUES
(1, 'Design & Art'),
(2, 'Engineering'),
(3, 'Sales & Marketing');

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id` int NOT NULL,
  `country` int NOT NULL,
  `citys` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `country`, `citys`) VALUES
(1, 1, 'California');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE `country` (
  `id` int NOT NULL,
  `countries` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `countries`) VALUES
(1, 'USA');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `city` int NOT NULL,
  `job_nature` int NOT NULL,
  `category` int NOT NULL,
  `salary_from` int DEFAULT NULL,
  `salary_to` int DEFAULT NULL,
  `vacancy_tally` int NOT NULL,
  `published` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `city`, `job_nature`, `category`, `salary_from`, `salary_to`, `vacancy_tally`, `published`) VALUES
(1, 'Software Engineer', 'Job description There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.  Variations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.  Responsibility The applicants should have experience in the following areas. Have sound knowledge of commercial activities. Leadership, analytical, and problem-solving abilities. Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT. Qualifications The applicants should have experience in the following areas. Have sound knowledge of commercial activities. Leadership, analytical, and problem-solving abilities. Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT. Benefits There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.', 1, 2, 1, 50, 120, 2, '2022-12-02 06:09:25'),
(2, 'Digital Marketer', 'Job description There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.  Variations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.  Responsibility The applicants should have experience in the following areas. Have sound knowledge of commercial activities. Leadership, analytical, and problem-solving abilities. Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT. Qualifications The applicants should have experience in the following areas. Have sound knowledge of commercial activities. Leadership, analytical, and problem-solving abilities. Should have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT. Benefits There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.', 1, 2, 1, 50, 120, 2, '2022-12-02 06:09:25'),
(3, 'Wordpress Developer', 'Job description\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n\r\nVariations of passages of lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.\r\n\r\nResponsibility\r\nThe applicants should have experience in the following areas.\r\nHave sound knowledge of commercial activities.\r\nLeadership, analytical, and problem-solving abilities.\r\nShould have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\nQualifications\r\nThe applicants should have experience in the following areas.\r\nHave sound knowledge of commercial activities.\r\nLeadership, analytical, and problem-solving abilities.\r\nShould have vast knowledge in IAS/ IFRS, Company Act, Income Tax, VAT.\r\nBenefits\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing.', 1, 1, 2, 50, 120, 1, '2022-12-02 08:10:41');

-- --------------------------------------------------------

--
-- Структура таблицы `job_nature`
--

CREATE TABLE `job_nature` (
  `id` int NOT NULL,
  `job_natures` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `job_nature`
--

INSERT INTO `job_nature` (`id`, `job_natures`) VALUES
(1, 'Full time'),
(2, 'Part time');

-- --------------------------------------------------------

--
-- Структура таблицы `titles`
--

CREATE TABLE `titles` (
  `id` int NOT NULL,
  `vacancies` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `titles`
--

INSERT INTO `titles` (`id`, `vacancies`) VALUES
(1, 'Software Engineer'),
(2, 'Digital Marketer'),
(3, 'Wordpress Developer');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country`);

--
-- Индексы таблицы `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`city`),
  ADD KEY `job_nature` (`job_nature`),
  ADD KEY `category` (`category`);

--
-- Индексы таблицы `job_nature`
--
ALTER TABLE `job_nature`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `country`
--
ALTER TABLE `country`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `job_nature`
--
ALTER TABLE `job_nature`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`city`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_ibfk_5` FOREIGN KEY (`job_nature`) REFERENCES `job_nature` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_ibfk_7` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
