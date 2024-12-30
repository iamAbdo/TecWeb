-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 29 déc. 2024 à 23:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nasahn`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(3, 'Sofiane', '$2y$10$PzdL9OnU1FQiV74JyzuWrOwxqiwI5cX7fdoYJlg/KBNILv39kFb.u', 'sofianemohammed716@gmail.com', '2024-12-29 20:29:37');

-- --------------------------------------------------------

--
-- Structure de la table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `student_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(8, NULL, 'John Smith', 'john.smith@email.com', '123-456-7890', 'I am passionate about Hardware Engineering and would like to learn more about designing microprocessors and circuits.', '2024-12-29 21:59:50'),
(9, NULL, 'David Wilson', 'david.wilson@email.com', '234-567-8901', 'I enjoy exploring Computer Science concepts like programming and computational problem-solving.', '2024-12-29 22:01:25'),
(10, NULL, 'Sophia Thomas', 'sophia.thomas@email.com', '345-678-9012', 'Network Engineering appeals to me because of its role in building resilient, high-speed networks.', '2024-12-29 22:02:28'),
(11, NULL, 'Alexander Clark', 'alexander.clark@email.com', '456-789-0123', 'Database Engineering fascinates me as it forms the backbone of almost all major applications.', '2024-12-29 22:03:23'),
(14, NULL, 'Charlotte Young', 'charlotte.young@email.com', '567-890-1234', 'Software Engineering lets me combine coding skills with creative problem-solving.', '2024-12-29 22:07:33'),
(15, NULL, 'Jackson Adams', 'jackson.adams@email.com', '678-901-2345', 'Cryptography and Cybersecurity are crucial for a safe and reliable digital world.', '2024-12-29 22:08:26');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author_or_source` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `read_more_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialty_type` enum('License','Masters','PhD') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `specialty_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `specialty_id`, `created_at`) VALUES
(2, 'John Smith', 'john.smith@email.com', '$2y$10$2DELxqNl/7lHBn5cUI5IteZamPP231KHNOdv2HIUiYn6yJl9WgFuS', 0, '2024-12-29 21:04:54'),
(3, 'Sarah Johnson', 'sarah.johnson@email.com', '$2y$10$ZVuZWb11byV/7QxvpQVCveCKYS7MS5FbuT5Az4qOPfwaDK4eZvtkW', 0, '2024-12-29 21:05:27'),
(4, 'Michael Brown', 'michael.brown@email.com', '$2y$10$iF.mxY2C7ZtQCgIk7EbzZO.iF5s4/u0RE5mIodK/D.wjFsemS9iMW', 0, '2024-12-29 21:06:00'),
(5, 'Emily Davis', 'emily.davis@email.com', '$2y$10$FN1DYGMKcFTOzrWL5NzxdOSifJWbvWqPiqXahRwMiQL4F0gvOT5Xm', 0, '2024-12-29 21:06:31'),
(6, 'David Wilson', 'david.wilson@email.com', '$2y$10$w73IVxoVJiDMxwtw0vrk7.3uehwhA6hsWyZalSy2kvT1PfpzSeiyS', 0, '2024-12-29 21:07:00'),
(7, 'Laura Miller', 'laura.miller@email.com', '$2y$10$B3GTg5LCDrAQoMZO3EvJGuSCCLXgL96BQn0ZIA1rdyaKM5F2vpSLy', 0, '2024-12-29 21:07:32'),
(8, 'James Moore', 'james.moore@email.com', '$2y$10$dWytXkbsX5mDxGcvAUxzteXu3NXn4fJ21kII0GCnJ/l018Wi0QoKa', 0, '2024-12-29 21:08:18'),
(9, 'Jessica Taylor', 'jessica.taylor@email.com', '$2y$10$7DyEAa1JzlByLCZcfNIQf./uANucvd6XRzPECrcesIoJe9g.vr5hy', 0, '2024-12-29 21:09:11'),
(10, 'William Anderson', 'william.anderson@email.com', '$2y$10$BuoI1iNITJpbRYSGcSECYOv3PVwsw3Paa73m4Mb5e6hxFinapMIo.', 0, '2024-12-29 21:09:40'),
(11, 'Sophia Thomas', 'sophia.thomas@email.com', '$2y$10$yEzSLXtPkn0IJ4.nYGzoU.IcmJy2CXTs2S6Jfe8nT37t9.9vLIwZe', 0, '2024-12-29 21:10:20'),
(12, 'Benjamin Jackson', 'benjamin.jackson@email.com', '$2y$10$AQ0d/1sNyl1fkIsalfHldOTI6wtNS42xc.WzOfCeuMP3xkJuYkwFu', 0, '2024-12-29 21:13:45'),
(13, 'Ava White', 'ava.white@email.com', '$2y$10$KQk0l7cLbMunimTsYfUWVuq8JfIxazO6R74SOlsHmMHhY/HM/bkYa', 0, '2024-12-29 21:14:20'),
(14, 'Ethan Harris', 'ethan.harris@email.com', '$2y$10$udTmzZxcgW685FTmq0b6Tu0k9iG9YsbWrhBKpZN/KBTd17I2kTguq', 0, '2024-12-29 21:14:57'),
(15, 'Olivia Martin', 'olivia.martin@email.com', '$2y$10$eDfv1PmhxfXd/tBbJqQBneoNe5qLTwyh5wPCSZS7u6pFUosdH4KZC', 0, '2024-12-29 21:15:34'),
(16, 'Alexander Clark', 'alexander.clark@email.com', '$2y$10$CINAP.LHTS31Kf/ezxxvKuK1/pVPDewUhZiQBRj/h.fTxUGKoFkFm', 0, '2024-12-29 21:16:01'),
(17, 'Mia Lewis', 'mia.lewis@email.com', '$2y$10$atwoBcCjNEluRM4GTn.LA.Ye0ItJdmCZLCJ.VbKiPyJWmA0NryZH2', 0, '2024-12-29 21:16:30'),
(18, 'Daniel Walker', 'daniel.walker@email.com', '$2y$10$x8VU1YTMemrjf3Zhmxfe8./dGNlPPNif/ZkF3cHdYzcmmcbEf37PK', 0, '2024-12-29 21:16:54'),
(19, 'Isabella Hall', 'isabella.hall@email.com', '$2y$10$LucgEiYi/FUlvC8WRS8hMO/1sUn13Vo6lX3bWPJIhu.G4CZCVFPZ2', 0, '2024-12-29 21:17:34'),
(20, 'Matthew Allen', 'matthew.allen@email.com', '$2y$10$giwsAANSvNOqv3VcANdiSOG7s/wSr5DVIFIz6VkxB7xlF.2iOHfqe', 0, '2024-12-29 21:18:03'),
(21, 'Charlotte Young', 'charlotte.young@email.com', '$2y$10$cIyguyAp4LRZ6BxM43stxezuRNUYxVE3CRMRho0Jg7Ng0TZUdPQye', 0, '2024-12-29 21:18:26'),
(22, 'Lucas King', 'lucas.king@email.com', '$2y$10$oXbqZ8ccn.alDG53HnRxou6jITmcV779c8QnAGf/mfDJp6c4k85US', 0, '2024-12-29 21:18:52'),
(23, 'Amelia Wright', 'amelia.wright@email.com', '$2y$10$wnbFatkhCJu2nrdYkDjd.udRV9AwHusxOfSQyVjsTqHEJtGZnQg32', 0, '2024-12-29 21:19:14'),
(24, 'Elijah Scott', 'elijah.scott@email.com', '$2y$10$hMpPb1yjKf4OeotV.r61/eum4vz1SZTL96ais0VRVkmEgaEszMxZm', 0, '2024-12-29 21:19:57'),
(25, 'Harper Green', 'harper.green@email.com', '$2y$10$AJxDKDCziRTacyjS1zeV7uudoDTT.ei4D7D3otRg8ej0/lkLnwhha', 0, '2024-12-29 21:20:22'),
(26, 'Jackson Adams', 'jackson.adams@email.com', '$2y$10$HF5F0kh9xDPA7H.0S5N3eOmRv7aRCJH.tlMmavmi.ZrS9zEZqiX.m', 0, '2024-12-29 21:20:47'),
(27, 'Abigail Baker', 'abigail.baker@email.com', '$2y$10$FfEVgvQdFijAVgn0Ht5mtuAOtgXtU4nxRk23Y3aIRm4tim5zz2GWy', 0, '2024-12-29 21:21:16'),
(28, 'Nathan Nelson', 'nathan.nelson@email.com', '$2y$10$eydNPP8MYYHff2nk24U5nu8O3p8bCElpb4ZQM5QCYmE8GNVc9f3iK', 0, '2024-12-29 21:21:51'),
(29, 'Emily Carter', 'emily.carter@email.com', '$2y$10$NB.lQkp9zD2mqup7nKwrl.eJOT779WSTqvzlH8Wj.wH5HCx304vk6', 0, '2024-12-29 21:22:26'),
(30, 'Grace Mitchell', 'grace.mitchell@email.com', '$2y$10$bDmqdeG.6tlUQwtcsZwSj.yj0JyBqqZWVjuX4Q6Ur7UlDYrI01GJa', 0, '2024-12-29 21:22:53'),
(31, 'Samuel Perez', 'samuel.perez@email.com', '$2y$10$PyIvHix4koza4gib7XoV9.4rifkOiKZcD9o7QaQPyZjxgP/QYjcAK', 0, '2024-12-29 21:23:26');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
