-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 20 2021 г., 16:21
-- Версия сервера: 5.7.29-log
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zholvar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attachmentable`
--

CREATE TABLE `attachmentable` (
  `id` int(10) UNSIGNED NOT NULL,
  `attachmentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` int(10) UNSIGNED NOT NULL,
  `attachment_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `hash` text COLLATE utf8mb4_unicode_ci,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2015_04_12_000000_create_orchid_users_table', 2),
(6, '2015_10_19_214424_create_orchid_roles_table', 2),
(7, '2015_10_19_214425_create_orchid_role_users_table', 2),
(8, '2016_08_07_125128_create_orchid_attachmentstable_table', 2),
(9, '2017_09_17_125801_create_notifications_table', 2),
(13, '2021_10_31_211117_create_parcels_table', 4),
(14, '2021_10_31_223712_create_package_recepients_table', 5),
(15, '2021_10_31_193624_create_parcel_senders_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `package_recepients`
--

CREATE TABLE `package_recepients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Пункт приёма-выдачи',
  `parcel_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Посылка',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `package_recepients`
--

INSERT INTO `package_recepients` (`id`, `name`, `user_id`, `parcel_id`, `created_at`, `updated_at`) VALUES
(1, 'NewIdea', 8, NULL, NULL, NULL),
(4, 'NewPointTest', 39, 24, '2021-11-09 17:08:12', '2021-11-09 17:08:12'),
(5, 'NewPointTest2', 40, 26, '2021-11-09 17:11:04', '2021-11-09 17:11:04');

-- --------------------------------------------------------

--
-- Структура таблицы `parcels`
--

CREATE TABLE `parcels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Номер заказа',
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Штрих-код',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Номер телефона получателя',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Имя получателя',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Фамилия получателя',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Email получателя',
  `insurance` decimal(8,2) DEFAULT NULL COMMENT 'Страховая стоимость',
  `weight` decimal(8,2) DEFAULT NULL COMMENT 'Вес посылки',
  `status` enum('pending_reception','in_transit','delivered') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending_reception' COMMENT 'Cтатус',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Отправитель',
  `parcelsender_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Отправитель',
  `packagerecepient_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Пункт приёма-выдачи',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parcels`
--

INSERT INTO `parcels` (`id`, `num`, `barcode`, `phone`, `name`, `last_name`, `email`, `insurance`, `weight`, `status`, `user_id`, `parcelsender_id`, `packagerecepient_id`, `created_at`, `updated_at`) VALUES
(17, '006', 'P000000007', '+420666666666', 'Ermek6', 'Newidea spol.r.o.', 'tanatar6.sro@seznam.cz', '6000.00', '6.00', 'pending_reception', 7, 1, 1, '2021-11-05 20:59:43', '2021-11-06 13:36:02'),
(19, '007', 'P000000009', '+420732199285', 'Newidea spol.', 'r.o.', 'tanatar1.sro@seznam.cz', '7000.00', '7.00', 'pending_reception', 7, 1, 1, '2021-11-05 21:06:21', '2021-11-05 21:06:21'),
(21, '008', 'P000000011', '+420732199285', 'Ermek8', 'Tanatar 8', 'tanatar8.sro@seznam.cz', '8000.00', '8.00', 'pending_reception', 7, 1, 1, '2021-11-05 21:18:52', '2021-11-06 13:40:08'),
(22, '009', 'P000000012', '+420732199285', 'Ermek9', 'Tanatar 9', 'tanatar9.sro@seznam.cz2', '9000.00', '9.00', 'pending_reception', 7, 1, 1, '2021-11-05 21:32:34', '2021-11-05 21:32:34'),
(23, '001', 'P000000013', '+420732199285', 'NewSender', 'NewSender spol.r.o.', 'tanatar1.sro@seznam.cz', '1000.00', '1.00', 'pending_reception', 9, 1, 4, '2021-11-06 13:41:55', '2021-11-14 14:04:24'),
(24, '006', 'P000000014', '+777478859', 'boxRecepient', 'Alser', 'box1@box.ru', '6000.00', '6.00', 'pending_reception', 42, 1, 4, '2021-11-09 20:26:08', '2021-11-09 20:26:08'),
(26, '001', 'P000000015', '+420732199285', 'NewPointTest2', 'newpointtest2', 'newpointtest2@seznam.cz', '2000.00', '2.00', 'pending_reception', 41, 1, 1, '2021-11-15 20:21:57', '2021-11-17 13:32:49'),
(27, '002', 'P000000016', '+420732199222', 'NewSenserTest2', 'NewSenserTest2', 'tanatar2.sro@seznam.cz', '2000.00', '2.00', 'pending_reception', 41, 2, 5, '2021-11-17 13:24:10', '2021-11-17 13:24:10');

-- --------------------------------------------------------

--
-- Структура таблицы `parcel_senders`
--

CREATE TABLE `parcel_senders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Отправитель',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parcel_senders`
--

INSERT INTO `parcel_senders` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Efin s.r.o.', 7, NULL, NULL),
(2, 'NewSenderTest', 41, '2021-11-09 17:16:09', '2021-11-09 17:16:09'),
(3, 'NewSenderTest1', 42, '2021-11-09 20:23:25', '2021-11-09 20:23:25');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'sender', 'Отправитель', '{\"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"1\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}', '2021-10-28 17:29:05', '2021-10-31 08:41:02'),
(2, 'Superadmin', 'Администратор', '{\"platform.index\": \"1\", \"platform.points\": \"1\", \"platform.parcels\": \"0\", \"platform.senders\": \"1\", \"platform.systems.roles\": \"1\", \"platform.systems.users\": \"1\", \"platform.systems.attachment\": \"1\"}', '2021-10-28 17:29:27', '2021-10-30 14:11:14'),
(3, 'point', 'Точка приёма-выдачи', '{\"platform.inbox\": \"1\", \"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"0\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}', '2021-10-30 13:06:43', '2021-11-06 20:55:09');

-- --------------------------------------------------------

--
-- Структура таблицы `role_users`
--

CREATE TABLE `role_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`) VALUES
(7, 1),
(9, 1),
(41, 1),
(42, 1),
(2, 2),
(8, 3),
(10, 3),
(39, 3),
(40, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Номер телефона',
  `num` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Порядковый номер',
  `status` enum('active','not_active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_active' COMMENT 'Cтатус',
  `type` enum('company','e_shop','person') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'company' COMMENT 'Cтатус',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Имя Фамилия',
  `ico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Улица и номер дома',
  `post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Почтовый индекс',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Населённый пункт',
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Страна',
  `web` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Веб-адрес',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'Описание',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permissions` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `num`, `status`, `type`, `last_name`, `ico`, `dic`, `street`, `post`, `city`, `state`, `web`, `description`, `remember_token`, `created_at`, `updated_at`, `permissions`) VALUES
(2, 'admin', 'admin@admin.com', NULL, '$2y$10$/ESpF6n/u0C95qvH1G2Fe.cy3ScJh9BYQpMkIV6geRoti5YLKDk7a', NULL, NULL, 'not_active', 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gNbOBtfHpkCLk9iZTTRHwpqoQivrCyIo4XKMKB14j9HzWgID71ggZJeH14rE', '2021-10-28 17:14:15', '2021-10-28 17:29:46', '{\"platform.index\": \"1\", \"platform.systems.roles\": \"1\", \"platform.systems.users\": \"1\", \"platform.systems.attachment\": \"1\"}'),
(7, 'Efin s.r.o.', 'efin@efin.cz', NULL, '$2y$10$cAO2N68LLKoM39CaC/pgJeugZLbjE0qiHf8K46yu4Oi6Iphx/UpaG', '+420732199285', '0002', 'active', 'e_shop', 'EfinSender', '27204028', 'CZ27204028', 'Kamyk', '14220', 'Praha Kamyk', 'Казахстан', 'www.efin.cz', 'bla efin', '5xtnELpSx5DyyrnvxQDRLlop3LziQrxwOvGD7ZMAUxFe6m0c6WbQ5BeoIyt8', '2021-10-31 09:12:54', '2021-10-31 13:06:10', NULL),
(8, 'Newidea spol. s r.o.', 'newidea@seznam.cz', NULL, '$2y$10$PLjwEuZSba6qss85vjdGpu9LDzAdSAWpHRYUPD6YoP5brtOjglWEe', '+420732199285', '2001', 'active', 'company', 'Ermeknew', '27204027', 'CZ27204027', 'Starochodovska 58', '60827', 'Praha Chodov', 'Казахстан', 'www.newidea.cz', 'bla newidea', NULL, '2021-10-31 13:16:21', '2021-10-31 13:19:21', '{\"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"0\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(9, 'NewSender', 'newsender@sender.ru', NULL, '$2y$10$SrIJEL7LG2JpGO/Khw/N7u2IruiFvGRNqssgbKRPyosO/Gs3az2gm', '+420732199285', '003', 'active', 'e_shop', 'ErmekNewSender', '27204011', 'CZ27204011', 'Starochodovska 58', '60827', 'Praha 11', 'Казахстан', 'www.newsender.cz', 'bla newsenders', NULL, '2021-11-06 13:41:01', '2021-11-06 17:30:26', '{\"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"1\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(10, 'NewPoint', 'newpoint@point.ru', NULL, '$2y$10$qspCRIRkaqaFZ0nzRKy88.16WfrUdFxSWQRYDG97HQ0SI4Zbf.6RO', '+420608106286', '2002', 'active', 'company', 'ZhumanPoint', NULL, NULL, 'U Zabehlickeho Zamku 48', '10600', 'Praha 10', 'Казахстан', 'www.zhumannewpoint.cz', 'bla newpoint', 'LXY4CGbbIW2dQqSmUxiOflG4dH6uhPa692f0Epe84HobQ64zmMxK2jMNUcTk', '2021-11-06 13:46:37', '2021-11-06 20:55:28', '{\"platform.inbox\": \"1\", \"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"0\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(39, 'NewPointTest', 'newpointtest@er.ru', NULL, '$2y$10$jdC22z9xCK4JssXR5iRSZetI8MOrjH4cZTd/.KTm5VlxFFFKN16Qy', NULL, NULL, 'not_active', 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-09 17:08:12', '2021-11-09 17:12:22', '{\"platform.inbox\": \"1\", \"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"0\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(40, 'NewPointTest2', 'newpointtest2@er.ru', NULL, '$2y$10$GgzjcoBypGaH/jZKmpm2tO4bggSRQw5g4QEq/46zmoteVNJxSwJ9m', NULL, NULL, 'not_active', 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2pU0OfbO2P3AdhVbyvO8f5AivkuLKlFMwEsY4u2vRk5rXFrEKVXyh6OFdCvw', '2021-11-09 17:11:04', '2021-11-09 17:13:05', '{\"platform.inbox\": \"1\", \"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"0\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(41, 'NewSenderTest', 'newsendertest@er.ru', NULL, '$2y$10$9UEcKMCadCi9WnfPhp04i./KRI7hYZoEmi7IC1lJJ14ekfRjQo0UC', NULL, NULL, 'not_active', 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ae1DqXT95vOIa4lRG5iMinmD9JScNpclo0i1EaVm113S7JBlrAbF1Es4wI3f', '2021-11-09 17:16:09', '2021-11-09 17:17:00', '{\"platform.inbox\": \"0\", \"platform.index\": \"1\", \"platform.points\": \"0\", \"platform.parcels\": \"1\", \"platform.senders\": \"0\", \"platform.companies\": \"1\", \"platform.systems.roles\": \"0\", \"platform.systems.users\": \"0\", \"platform.systems.attachment\": \"1\"}'),
(42, 'NewSenderTest1', 'newsender1@sender.ru', NULL, '$2y$10$hEhPa0c.S7FK9j618v..t.ZWPQaGlfRcfW3jJDqt2toDgRWJGnpn6', NULL, NULL, 'not_active', 'company', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-09 20:23:25', '2021-11-09 20:23:25', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachmentable_attachmentable_type_attachmentable_id_index` (`attachmentable_type`,`attachmentable_id`),
  ADD KEY `attachmentable_attachment_id_foreign` (`attachment_id`);

--
-- Индексы таблицы `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Индексы таблицы `package_recepients`
--
ALTER TABLE `package_recepients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_recepients_user_id_foreign` (`user_id`),
  ADD KEY `parcel_id` (`parcel_id`);

--
-- Индексы таблицы `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcels_user_id_foreign` (`user_id`),
  ADD KEY `parcels_parcelsender_id_foreign` (`parcelsender_id`),
  ADD KEY `parcels_packagerecepient_id_foreign` (`packagerecepient_id`);

--
-- Индексы таблицы `parcel_senders`
--
ALTER TABLE `parcel_senders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcel_senders_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Индексы таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `package_recepients`
--
ALTER TABLE `package_recepients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `parcel_senders`
--
ALTER TABLE `parcel_senders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attachmentable`
--
ALTER TABLE `attachmentable`
  ADD CONSTRAINT `attachmentable_attachment_id_foreign` FOREIGN KEY (`attachment_id`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `package_recepients`
--
ALTER TABLE `package_recepients`
  ADD CONSTRAINT `package_recepients_parcel_id_foreign` FOREIGN KEY (`parcel_id`) REFERENCES `parcels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_recepients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `parcels`
--
ALTER TABLE `parcels`
  ADD CONSTRAINT `parcels_packagerecepient_id_foreign` FOREIGN KEY (`packagerecepient_id`) REFERENCES `package_recepients` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `parcels_parcelsender_id_foreign` FOREIGN KEY (`parcelsender_id`) REFERENCES `parcel_senders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `parcels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `parcel_senders`
--
ALTER TABLE `parcel_senders`
  ADD CONSTRAINT `parcel_senders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
