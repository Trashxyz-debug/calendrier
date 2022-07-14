-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Dim 03 juil. 2022 à 17:47
-- Version du serveur :  8.0.29-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_calendar`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `book` tinyint(1) DEFAULT '0',
  `book_until` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `book` tinyint(1) DEFAULT '0',
  `book_until` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `user_id`, `book`, `book_until`, `created_at`, `updated_at`) VALUES
(12, 'Evenement 2', '2022-06-28 10:30:00', '2022-06-28 11:30:00', 2, 1, NULL, '2022-06-27 09:29:06', '2022-07-03 11:00:33'),
(13, 'Evenement 3', '2022-06-29 09:00:00', '2022-06-29 10:00:00', NULL, 0, NULL, '2022-06-27 09:30:26', '2022-07-03 10:55:22'),
(15, 'Evenement 4', '2022-06-28 12:00:00', '2022-06-28 13:00:00', 2, 1, NULL, '2022-06-27 09:35:33', '2022-07-03 13:34:04'),
(16, 'Evenement 5', '2022-06-29 12:00:00', '2022-06-29 13:30:00', NULL, 0, NULL, '2022-06-27 09:42:52', '2022-07-03 10:55:53'),
(17, 'Evenement 1', '2022-06-27 09:00:00', '2022-06-27 10:00:00', NULL, 0, NULL, '2022-07-01 13:26:02', '2022-07-03 09:46:09'),
(18, 'Evenement 6', '2022-06-27 13:00:00', '2022-06-27 14:00:00', NULL, 0, NULL, '2022-07-03 13:33:27', '2022-07-03 13:33:27');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_06_11_211456_create_events_table', 1),
(6, '2022_06_22_203452_create_books_table', 1),
(7, '2022_06_24_090336_add_email_to_events', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `nom`, `prenom`, `tel`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'David Vauris', 'dave@dave.com', NULL, '$argon2id$v=19$m=65536,t=4,p=1$R3g5aWNsa0hia3RheFN3YQ$6CCasYltxhuNnqAw5PqMPJR/aJt/J7TJPc5XKn5roxc', 1, 'VAURIS', 'David', NULL, NULL, '2022-06-25 12:42:49', '2022-06-25 12:42:49'),
(2, NULL, 'ex@ee.com', '2022-07-03 09:50:11', '$argon2id$v=19$m=65536,t=4,p=1$STlMQW5OWHFTSDI5YmFiZA$sP/QLpDCP5YnOEM3D4u1lrGkaFOuhaJz/MjXw/5XN5k', 0, 'Nom 1', 'Prenom 1', NULL, 'agOVgmKvdwwVXwUNskU4CQRcDPoZbDUTN9t61b6JwTlhx1g6QwQAxGTKHGBV', '2022-06-28 11:40:46', '2022-07-03 09:50:11'),
(3, NULL, 'nono@tr.fr', '2022-07-03 09:46:04', '$argon2id$v=19$m=65536,t=4,p=1$WGk2cnFrWFNCMFBkMi9GQg$pLpfuCyTwZuGxUBlRYxcAOiBhupKyn/r5Zj6jAYv98U', 0, NULL, NULL, NULL, NULL, '2022-07-01 10:05:46', '2022-07-03 09:46:04'),
(4, NULL, 'elie.lemoine76@gmail.com', '2022-07-01 18:07:13', '$argon2id$v=19$m=65536,t=4,p=1$U0YyeTl6dG9sdjl3azR0aA$UZ4Ie1xHveZ/iQieGEbGJOq8kcN6popM8CHxT7bMxsg', 0, NULL, NULL, NULL, NULL, '2022-07-01 18:07:02', '2022-07-01 18:07:13'),
(5, NULL, 'fqds@dhf.com', '2022-07-01 19:12:31', '$argon2id$v=19$m=65536,t=4,p=1$Qi9qYVJGR1dIT2hDU0U2Yg$bjrGWELjmWid2m66GBX8HJwaZWyFBeaphbIONY1h6es', 0, 'Durand', 'Jo', '0102030405', NULL, '2022-07-01 19:12:13', '2022-07-01 19:12:31'),
(6, NULL, 'agnes.fernandaise@gmail.com', '2022-07-01 19:26:30', '$argon2id$v=19$m=65536,t=4,p=1$QllqbEZjYS92aUlxZUJzVg$NONoeRFhuQy5n0fHsrC03EWclukWUM9572Dy+4DbJRU', 0, 'Fernandaise', 'Agnes', '0102030405', NULL, '2022-07-01 19:25:46', '2022-07-01 19:26:30'),
(7, NULL, 'abctrashxyz@gmail.com', '2022-07-01 19:12:31', '$argon2id$v=19$m=65536,t=4,p=1$aVFBbTA1eWhHdDFGQ211Zg$l24sh3+4g7ehYYuPeEx77XmyXFARtHb4U4/tgtHGWsI', 0, 'BERTRAND', 'DUGLAND', '0674627902', NULL, '2022-07-02 08:38:23', '2022-07-02 08:38:23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_event_id_foreign` (`event_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
