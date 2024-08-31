-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 11:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `level_seven`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(2, 'Test new clean comment ( with update)', 1, 1, '2024-08-31 08:44:14', '2024-08-31 08:45:47'),
(3, 'Test Another Comment', 1, 1, '2024-08-31 08:44:26', '2024-08-31 08:44:26'),
(8, 'Test 2nd Post Comments', 1, 2, '2024-08-31 10:43:30', '2024-08-31 10:43:30'),
(9, 'See if i can view post from comments', 1, 2, '2024-08-31 10:43:53', '2024-08-31 10:43:53'),
(10, 'Hello World', 13, 1, '2024-08-31 12:03:21', '2024-08-31 12:03:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `ext` varchar(255) NOT NULL,
  `original_filename` longtext NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `ext`, `original_filename`, `filename`, `created_at`, `updated_at`) VALUES
(2, 'jpg', 'A91obfls7_ie6lws_9d4', '199a8aac65607b338da8384a5ceeb38b', '2024-08-31 19:01:25', '2024-08-31 19:01:25'),
(3, 'jpg', 'A91obfls7_ie6lws_9d4', '87d9bfd3ff05b39ca2de5cca4510d887', '2024-08-31 19:01:49', '2024-08-31 19:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_28_054656_create_personal_access_tokens_table', 1),
(5, '2024_08_28_055539_create_posts_table', 1),
(6, '2024_08_29_060928_create_tags_table', 1),
(7, '2024_08_29_061647_create_post_tags_table', 1),
(8, '2024_08_29_061927_create_comments_table', 1),
(9, '2024_08_31_205117_create_files_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Level7Assessment', 'dcc8d2166ef46d629bbedd7bbf0995ab40eacc32c63544172496cfc76f12518f', '[\"*\"]', '2024-08-31 08:20:16', NULL, '2024-08-31 08:09:46', '2024-08-31 08:20:16'),
(2, 'App\\Models\\User', 1, 'Level7Assessment', '687120445360e35b25f908af27c6585e0cdd0e1283d37f74fdf163bbdbb20739', '[\"*\"]', '2024-08-31 11:03:28', NULL, '2024-08-31 08:37:46', '2024-08-31 11:03:28'),
(3, 'App\\Models\\User', 2, 'Level7Assessment', '08506cf339f2b4884f895028881774325d87698884f64fce9d0bc3794b315cb2', '[\"*\"]', NULL, NULL, '2024-08-31 10:58:12', '2024-08-31 10:58:12'),
(4, 'App\\Models\\User', 3, 'Level7Assessment', '9f49aabe65c327239e21fe6eb36012624c9ed0b2848cb331ce94c8d7c3f575bf', '[\"*\"]', NULL, NULL, '2024-08-31 11:13:19', '2024-08-31 11:13:19'),
(5, 'App\\Models\\User', 4, 'Level7Assessment', '8294c1d200e629db7eee5b16180998c948cf0a070aea032af0c510e6593a78fc', '[\"*\"]', '2024-08-31 11:14:17', NULL, '2024-08-31 11:13:43', '2024-08-31 11:14:17'),
(6, 'App\\Models\\User', 5, 'Level7Assessment', '573038f132702e5faf7719537e78dbbd43a6ca9c9013db46fef14c0378f05c2a', '[\"*\"]', '2024-08-31 11:14:38', NULL, '2024-08-31 11:14:29', '2024-08-31 11:14:38'),
(7, 'App\\Models\\User', 6, 'Level7Assessment', 'e04aae7eeb3832960bb427a20279a3cde62e6953776feebbd7dbf945bdc3f82b', '[\"*\"]', '2024-08-31 11:14:53', NULL, '2024-08-31 11:14:44', '2024-08-31 11:14:53'),
(8, 'App\\Models\\User', 7, 'Level7Assessment', '56538b2f65c4b7d01a9f908aef9092baeeb7dab3ddfd99fade448c7a5671b43d', '[\"*\"]', '2024-08-31 11:16:18', NULL, '2024-08-31 11:16:08', '2024-08-31 11:16:18'),
(9, 'App\\Models\\User', 8, 'Level7Assessment', '838397c7202169028530e09226519f6f94211da1b23e107ede7276ced334ac4e', '[\"*\"]', '2024-08-31 11:16:47', NULL, '2024-08-31 11:16:23', '2024-08-31 11:16:47'),
(10, 'App\\Models\\User', 9, 'Level7Assessment', 'db3028edb428fa4b50c322b442f3cb6465330f7a25dbe00822f6fd621d183e81', '[\"*\"]', '2024-08-31 11:17:20', NULL, '2024-08-31 11:16:52', '2024-08-31 11:17:20'),
(11, 'App\\Models\\User', 10, 'Level7Assessment', '4be37c8dce82a886a374249ad020f38930931f66e97262c8da108388c78b8297', '[\"*\"]', '2024-08-31 11:17:25', NULL, '2024-08-31 11:17:24', '2024-08-31 11:17:25'),
(12, 'App\\Models\\User', 11, 'Level7Assessment', 'a7a39002f80c83d431c3748befe86f00fa8f94319e977bcc6e1cc8e37c64f98d', '[\"*\"]', '2024-08-31 11:17:58', NULL, '2024-08-31 11:17:57', '2024-08-31 11:17:58'),
(13, 'App\\Models\\User', 12, 'Level7Assessment', '464dbdff3f82af19227d0ff8bbfe019713f6c86d5a7efe89ca178258cc76e250', '[\"*\"]', '2024-08-31 11:18:17', NULL, '2024-08-31 11:18:16', '2024-08-31 11:18:17'),
(14, 'App\\Models\\User', 13, 'Level7Assessment', '75f876d87b245f7a6f737826e0e7d3b708206f072ba010071f6197c5835ce554', '[\"*\"]', '2024-08-31 12:03:37', NULL, '2024-08-31 11:18:22', '2024-08-31 12:03:37'),
(15, 'App\\Models\\User', 1, 'Level7Assessment', 'ca38c128ff7e71a5041169746faa0f9b7788dff0b8067411c75f8c09f3018c91', '[\"*\"]', '2024-08-31 19:31:57', NULL, '2024-08-31 15:55:02', '2024-08-31 19:31:57'),
(16, 'App\\Models\\User', 1, 'Level7Assessment', '169de86ad52b0972bb3e158e2d5f5cc492cb73bced7de3162f998b54f4334cc0', '[\"*\"]', '2024-08-31 16:01:40', NULL, '2024-08-31 16:01:08', '2024-08-31 16:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `published` int(11) NOT NULL DEFAULT 1,
  `excerpt` longtext NOT NULL,
  `description` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `thumbnail_id` int(11) NOT NULL,
  `publish_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `published`, `excerpt`, `description`, `user_id`, `thumbnail_id`, `publish_date`, `created_at`, `updated_at`) VALUES
(1, 'Facere voluptas prae', '<p>Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, volupta.Commodi est, With updated body </p>', 1, '<p>Commodi est, volupta.Commodi est</p>', 'Tenetur sed natus qu updated', 1, 1, '2024-08-30 22:00:00', '2024-08-31 08:43:32', '2024-08-31 08:53:00'),
(2, 'Earum labore perfere', '<p>Dolore voluptate des.</p>', 1, '<p>Voluptatum aute enim.</p>', 'Voluptate eos omnis', 1, 1, '2012-01-16 22:00:00', '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(3, 'Dolorum consequuntur', '<p>Consequat. Corrupti.</p>', 1, '<p>Fugiat molestiae per.</p>', 'Autem est commodo no', 1, 1, '1973-01-10 22:00:00', '2024-08-31 08:51:20', '2024-08-31 08:51:20'),
(4, 'Nemo et quisquam rer', '<p>Quae quisquam ex fug.</p>', 1, '<p>Sunt, sit neque et v.</p>', 'Blanditiis nihil ea', 1, 1, '2024-05-03 22:00:00', '2024-08-31 08:51:25', '2024-08-31 08:51:25'),
(5, 'Est do omnis repelle', '<p>Facilis expedita und.</p>', 1, '<p>Veniam, inventore el.</p>', 'Ut sit magna illum', 1, 1, '1977-12-06 22:00:00', '2024-08-31 08:51:32', '2024-08-31 08:51:32'),
(6, 'Et lorem aut repudia', '<p>Dolore velit ullam v.</p>', 0, '<p>Quasi sint, maiores .</p>', 'Natus vel voluptatem', 1, 1, '1977-06-12 22:00:00', '2024-08-31 18:36:18', '2024-08-31 18:36:18'),
(7, 'Cupidatat accusantiu', '<p>Animi, consequatur? .</p>', 1, '<p>Vel dolorem voluptas.</p>', 'Debitis omnis et in ', 1, 1, '2012-01-18 22:00:00', '2024-08-31 19:00:08', '2024-08-31 19:00:08'),
(8, 'Amet est enim quia ', '<p>Adipisicing quia qui.</p>', 0, '<p>Vel blanditiis aperi.</p>', 'Ut dolore nobis libe', 1, 2, '2015-01-28 22:00:00', '2024-08-31 19:01:25', '2024-08-31 19:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-08-31 08:43:32', '2024-08-31 08:43:32'),
(2, 1, 2, '2024-08-31 08:43:32', '2024-08-31 08:43:32'),
(3, 1, 3, '2024-08-31 08:43:32', '2024-08-31 08:43:32'),
(4, 1, 4, '2024-08-31 08:47:31', '2024-08-31 08:47:31'),
(5, 2, 5, '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(6, 2, 6, '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(7, 2, 7, '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(8, 3, 8, '2024-08-31 08:51:20', '2024-08-31 08:51:20'),
(9, 4, 9, '2024-08-31 08:51:25', '2024-08-31 08:51:25'),
(10, 5, 10, '2024-08-31 08:51:32', '2024-08-31 08:51:32'),
(11, 1, 11, '2024-08-31 08:52:30', '2024-08-31 08:52:30'),
(12, 6, 12, '2024-08-31 18:36:19', '2024-08-31 18:36:19'),
(13, 7, 13, '2024-08-31 19:00:08', '2024-08-31 19:00:08'),
(14, 8, 14, '2024-08-31 19:01:25', '2024-08-31 19:01:25'),
(15, 9, 14, '2024-08-31 19:01:49', '2024-08-31 19:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `created_at`, `updated_at`) VALUES
(1, 'Commodi est', '2024-08-31 08:43:32', '2024-08-31 08:43:32'),
(2, ' volupta.Commodi est', '2024-08-31 08:43:32', '2024-08-31 08:43:32'),
(3, '', '2024-08-31 08:43:32', '2024-08-31 08:43:32'),
(4, 'updated tag', '2024-08-31 08:47:30', '2024-08-31 08:47:30'),
(5, 'Voluptatem Aperiam', '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(6, 'Voluptatum aute enim', '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(7, 'Dolore voluptate des.', '2024-08-31 08:51:03', '2024-08-31 08:51:03'),
(8, 'Error praesentium ut', '2024-08-31 08:51:20', '2024-08-31 08:51:20'),
(9, 'Est ex et possimus', '2024-08-31 08:51:25', '2024-08-31 08:51:25'),
(10, 'Minim soluta duis ve', '2024-08-31 08:51:32', '2024-08-31 08:51:32'),
(11, ' volupta.', '2024-08-31 08:52:30', '2024-08-31 08:52:30'),
(12, 'Harum labore veniam', '2024-08-31 18:36:19', '2024-08-31 18:36:19'),
(13, 'Commodo nemo anim mi', '2024-08-31 19:00:08', '2024-08-31 19:00:08'),
(14, 'Iure dolor voluptas ', '2024-08-31 19:01:25', '2024-08-31 19:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mandiso Ngwenya Clean Test', 'mandiso04@gmail.com', NULL, '$2y$12$aAPiL4H5zXA4jjHjjtQY4.UtnfwmEFUeB4GcgsEIcQOFJPAFHZQR6', NULL, '2024-08-31 08:09:46', '2024-08-31 08:09:46'),
(2, 'Idola Fowler', 'keruv@mailinator.com', NULL, '$2y$12$o.MOIEct5OTvDlkNGLths.SlWR.rhnO2ixqx.qNNe.SGThOq9qVMG', NULL, '2024-08-31 10:58:12', '2024-08-31 10:58:12'),
(3, 'Dalton Richmond', 'viwewulixo@mailinator.com', NULL, '$2y$12$9bXtktohEC5ML3ZWSTDqt.K3hx2wYzNaoWPK6tiFgj0d/q6EIUSUa', NULL, '2024-08-31 11:13:19', '2024-08-31 11:13:19'),
(4, 'Vladimir Small', 'zikexa@mailinator.com', NULL, '$2y$12$675yagjYfg9LTAB1HKXEueyRwnWqYU6GwE7zlYEAQEk6SdknMUcsa', NULL, '2024-08-31 11:13:43', '2024-08-31 11:13:43'),
(5, 'Sybill Weeks', 'jiloj@mailinator.com', NULL, '$2y$12$v1bIfMibHCOUjTdI8wT87.O2SoAnhS3zCHueqkX0qtWb2feL24KgC', NULL, '2024-08-31 11:14:29', '2024-08-31 11:14:29'),
(6, 'Xanthus Williamson', 'nidev@mailinator.com', NULL, '$2y$12$/mbzzDfWsrBzGh7p3RZe0eAf9kUOp5LhlENOAXyukJe2e.onaXQHm', NULL, '2024-08-31 11:14:44', '2024-08-31 11:14:44'),
(7, 'Ramona Baird', 'wynyc@mailinator.com', NULL, '$2y$12$6BXBrziTwas0V0DKrMkC4u.IwqfkpykRamkOxH7fB5tGJWvhb3qWu', NULL, '2024-08-31 11:16:08', '2024-08-31 11:16:08'),
(8, 'Anne Daugherty', 'daheqily@mailinator.com', NULL, '$2y$12$nskkjO5zES6n1UA0PFf6N.QXXIc8xo8sLTTQwNlC.zNjKJgE6FCMu', NULL, '2024-08-31 11:16:23', '2024-08-31 11:16:23'),
(9, 'Daryl Navarro', 'xawu@mailinator.com', NULL, '$2y$12$ClrziDaOWzbcFSg3p0Ei2ezG3zVpmhj8EkQq1bfmCjj1ree7Gnn12', NULL, '2024-08-31 11:16:52', '2024-08-31 11:16:52'),
(10, 'Moana Hayden', 'puxozujo@mailinator.com', NULL, '$2y$12$mcpdZXBRUnvxB4t63DXI5ub663ladhaBIjbUfwqCZxAvN4V2pN8UO', NULL, '2024-08-31 11:17:24', '2024-08-31 11:17:24'),
(11, 'Nadine Barnes', 'qypivijage@mailinator.com', NULL, '$2y$12$USnbEYLB2skyy3DwxA3gtO4crgO2XvAVuRbmW/gUzHKTCRDgFl1Ny', NULL, '2024-08-31 11:17:57', '2024-08-31 11:17:57'),
(12, 'Zenia Vega', 'lilacadeca@mailinator.com', NULL, '$2y$12$CV/iN3JHUsgqfxFM2hEhDO8VAuIqLtPj83VJFdzhXG3Ahh/3x/FcW', NULL, '2024-08-31 11:18:16', '2024-08-31 11:18:16'),
(13, 'Francis Hudson', 'gamokago@mailinator.com', NULL, '$2y$12$uubJF1uFYZn3S/KCEcCH.uJiBVVX8pE3XOkGHaRz07/leHJ5Wunau', NULL, '2024-08-31 11:18:22', '2024-08-31 11:18:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
