-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Mar 2024 pada 11.07
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lms_yppt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrasis`
--

CREATE TABLE `administrasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahunpelajaran_id` int(5) NOT NULL,
  `dokumen_id` int(11) NOT NULL,
  `file_administrasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aksesusers`
--

CREATE TABLE `aksesusers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahunpelajaran_id` int(11) NOT NULL,
  `hakakses_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggotarombels`
--

CREATE TABLE `anggotarombels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rombonganbelajar_id` int(5) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `aksesuser_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggotarombels`
--

INSERT INTO `anggotarombels` (`id`, `rombonganbelajar_id`, `user_id`, `aksesuser_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'X TKJ 1', 0, '2024-03-06 21:17:33', '2024-03-06 21:17:33'),
(2, 1, 'X TKJ 2', 0, '2024-03-06 21:26:29', '2024-03-06 21:26:29'),
(4, 1, 'X TSM 1', 0, '2024-03-06 23:13:03', '2024-03-06 23:24:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pembelajaran_id` int(5) NOT NULL,
  `judulassignment` int(11) NOT NULL,
  `jenisassignment_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hakakses`
--

CREATE TABLE `hakakses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hakakses` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `hakakses`
--

INSERT INTO `hakakses` (`id`, `hakakses`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Sekolah', NULL, NULL),
(2, 'Wakasek Kurikulum', NULL, NULL),
(3, 'Wali Kelas', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisassignments`
--

CREATE TABLE `jenisassignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenisassignment` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenisassignments`
--

INSERT INTO `jenisassignments` (`id`, `jenisassignment`, `created_at`, `updated_at`) VALUES
(1, 'Kuis', NULL, NULL),
(2, 'Tugas', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_02_09_001538_create_roles_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelajarans`
--

CREATE TABLE `pembelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahunpelajaran_id` int(5) NOT NULL,
  `rombonganbelajar_id` int(11) NOT NULL,
  `matapelajaran` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Guru', NULL, NULL),
(3, 'Peserta Didik', NULL, NULL),
(4, 'Tata Usaha', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rombonganbelajars`
--

CREATE TABLE `rombonganbelajars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahunpelajaran_id` int(5) NOT NULL,
  `rombongan_belajar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rombonganbelajars`
--

INSERT INTO `rombonganbelajars` (`id`, `tahunpelajaran_id`, `rombongan_belajar`, `created_at`, `updated_at`) VALUES
(1, 1, 'X TKJ 1', '2024-03-06 21:17:33', '2024-03-06 21:17:33'),
(2, 1, 'X TKJ 2', '2024-03-06 21:26:29', '2024-03-06 21:26:29'),
(4, 1, 'X TSM 1', '2024-03-06 23:13:03', '2024-03-06 23:24:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahunpelajarans`
--

CREATE TABLE `tahunpelajarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tapel_code` varchar(5) NOT NULL,
  `tahunpelajaran` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahunpelajarans`
--

INSERT INTO `tahunpelajarans` (`id`, `tapel_code`, `tahunpelajaran`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '20232', '2023-2024 Genap', 1, '2024-03-06 17:00:00', '2024-03-06 20:55:50'),
(2, '20231', '2023-2024 Ganjil', 0, '2024-03-06 20:23:14', '2024-03-06 20:55:50'),
(3, '20241', '2024-2025 Ganjil', 0, '2024-03-06 20:24:44', '2024-03-06 20:55:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Asep Ulumudin', 'admin', '$2y$12$wcapMaGK34nbXxU0GC8U3O//dW0bxMEi1RAPKY5PG1.J0N.5PMHPq', 1, '2024-02-06 16:08:17', '2024-03-05 09:48:05'),
(2, 'Administrator', 'su-admin', '$2y$12$fyxZa4O9QUB5HtoekrVAPeznl.mxmR0beFAJ/QG/pekwFCV7fFLpq', 1, '2024-02-06 16:13:22', '2024-02-06 16:13:22'),
(3, 'Anggi', 'anggi', '$2y$12$b22rkVbZQqr/q10RPN5qNej9.oMaW31ypUCLQ7py/F.9ceR6yd2iC', 1, '2024-02-06 16:19:30', '2024-02-06 16:19:30'),
(5, 'Nama Guru', 'guru1', '$2y$12$jS/rYjkTCBIvLVtrY9kG6.ohuKxKgQwW/ZLDkpaKKh6ApjJoq1pE.', 2, '2024-03-05 16:24:55', '2024-03-05 16:24:55'),
(6, 'Nama PD', 'pd1', '$2y$12$A2hwwopxG9ESUNkEg1IIiO5T82c9dDkhKwBIfXKkhwSypCRi3zGhu', 3, '2024-03-05 16:31:20', '2024-03-05 16:31:20'),
(14, 'Patah', 'sumarna', '$2y$12$sVARqG9kxiS28SjSZofnceIqV9wD3dEr8qb7CscPYVJLWKYABXsm2', 4, '2024-03-06 03:35:20', '2024-03-06 19:28:33'),
(19, 'Adhy Maulana Fatharani', '74786-107', '$2y$12$YwF98w9Hvvs5fzQm9va/M.peSrerNrBaWiD44E/KgzgoNeoujXyhy', 3, '2024-03-06 05:18:16', '2024-03-06 05:18:16'),
(20, 'AGNISA MA', '74786-108', '$2y$12$O58opgypqTsFtjfLW0tzFeAPKT8sMm9qIwekFjPGZO4K7AFHigGn2', 3, '2024-03-06 05:18:16', '2024-03-06 05:18:16'),
(21, 'Aisyah Ayu Pratiwi', '74786-109', '$2y$12$kIy66voTM.MZrJ3XgKFU4eLco0w/UWBipktlhM2vDinoMaxCEHSxO', 3, '2024-03-06 05:18:17', '2024-03-06 05:18:17'),
(22, 'Alycia Pebriani', '74786-110', '$2y$12$/hlC/XkOioYqLJPn8h/aJOhD9yF0qv/sKBxpQse9lYuJ3lymdKx9S', 3, '2024-03-06 05:18:17', '2024-03-06 05:18:17'),
(23, 'Bilqis Nur Arsy', '74786-111', '$2y$12$ACx3TkeCbrMrFrqCjzz.m./8iWjPxcjZMJm701wbbLGSH9K210SFe', 3, '2024-03-06 05:18:18', '2024-03-06 05:18:18'),
(24, 'Bima Putra Wahyudi', '74786-112', '$2y$12$Qtj/SrF69WlKNdLotfnuXeFC.RJtlkHXgjz3P6TyALunZ.1t5kpk2', 3, '2024-03-06 05:18:18', '2024-03-06 05:18:18'),
(25, 'CHARLITTA MEIDIRA SUHERMAN', '74786-113', '$2y$12$59vuDKsAlcGijB7vyuKZRuwbW.YR3pk37fTFZSKuIr1IX8u3ZhdGK', 3, '2024-03-06 05:18:19', '2024-03-06 05:18:19'),
(26, 'Daffa Ihsan Al-aziz Hermawan', '74786-114', '$2y$12$YPzjqjfw84Z/EofxJPQk9OP0lj32kIR//4SqeF2aCjmnr3g60rVSC', 3, '2024-03-06 05:18:20', '2024-03-06 05:18:20'),
(27, 'DINI SITI FATIMAH RIZKI', '74786-115', '$2y$12$7enRhEfIoznQ9TKtBJI0Eu.XA8IzPEBGt2BdqAYOu6J09WOt25ozO', 3, '2024-03-06 05:18:20', '2024-03-06 05:18:20'),
(28, 'Dita Humaira Putri', '74786-116', '$2y$12$5TPyFEU438lbZXMqMHZ.7ex.wYUTYcuOOdIvDjZMQmJM6ima/vjiq', 3, '2024-03-06 05:18:21', '2024-03-06 05:18:21'),
(29, 'DITA RISMA RAHAYU', '74786-117', '$2y$12$JvMX4VAbYVa52tU8WKNG5uMVGbLSRxNZudih.P/OktXl/RHZxV8Dq', 3, '2024-03-06 05:18:21', '2024-03-06 05:18:21'),
(30, 'ENDAH NURHAFIDAH', '74786-118', '$2y$12$FQ75m5i9qp7qJ9t4BNfILeB0UN44iAhzeYTQpSCGojsGEL45OXske', 3, '2024-03-06 05:18:22', '2024-03-06 05:18:22'),
(31, 'Faisal Gunawan', '74786-119', '$2y$12$PIizVdGBICbYBncBi4M7iONmKnRwGEoAnsSPibW33u9IxwIIOsqU.', 3, '2024-03-06 05:18:22', '2024-03-06 05:18:22'),
(32, 'Gazza Fadhila Fasha', '74786-120', '$2y$12$0iIBxXddrCDiAdLXQyZnAedK8u8a4d7BcscKX6GqmV3CawWSv1/hG', 3, '2024-03-06 05:18:23', '2024-03-06 05:18:23'),
(33, 'ISNA RAHMADANI', '74786-121', '$2y$12$gZgFU15ap5SnmUaPlOm6reIn5Fx9/3i6yjslA95xbPFLxE9vyOrFe', 3, '2024-03-06 05:18:23', '2024-03-06 05:18:23'),
(34, 'MOCH HASBI', '74786-122', '$2y$12$3DnTfu12uMuk2fawwrKXNu.u2aNPauHxnXRJrqZDD.lueUhzX2uom', 3, '2024-03-06 05:18:24', '2024-03-06 05:18:24'),
(35, 'Moh Febrian Nugraha', '74786-123', '$2y$12$zQ6jl.TvBKgC73ptugXNXen/9ifZfAS7Es5Io8h22IiOT26kEs4va', 3, '2024-03-06 05:18:25', '2024-03-06 05:18:25'),
(36, 'MOH NURHADI', '74786-124', '$2y$12$4eMCg132WdtfA9sqotic3O6me1Zi.oSdLlBLQxYfBNrFhEAkfX65e', 3, '2024-03-06 05:18:25', '2024-03-06 05:18:25'),
(37, 'MUHAMAD JULVI', '74786-125', '$2y$12$fCatDInJYtx8mVdzboBVqOlVidGiuZr0bzC09paX.UU2ZGQi5SF.G', 3, '2024-03-06 05:18:26', '2024-03-06 05:18:26'),
(38, 'Muhamad Sahwal Nurjaman', '74786-126', '$2y$12$pRGmLZCrI6I9CS9HZa7ZAOM4XNu1tqalhgV2FQSCp9OQ/iIGnO4u2', 3, '2024-03-06 05:18:27', '2024-03-06 05:18:27'),
(39, 'MUHAMMAD FAUZAN AZHIIMA', '74786-127', '$2y$12$if96ru452tuR8Gi24faNGuwVzIjWMmtgo6y9Pkm2KQxu/IguOOVGO', 3, '2024-03-06 05:18:27', '2024-03-06 05:18:27'),
(40, 'MUHAMMAD HAMKA MAULANA YUSUF', '74786-128', '$2y$12$DwGvOQPeO1hfjrbLyh5Lee1cgiMY3VM6A4dSmE.NKzTDYoAHk9Vqu', 3, '2024-03-06 05:18:28', '2024-03-06 05:18:28'),
(41, 'MUHAMMAD RAYFAL', '74786-129', '$2y$12$FKfqUXiRqqFo68PWabUeM.Fonu7L1h/mGx.Dpx4PQa5inPJojvAfO', 3, '2024-03-06 05:18:28', '2024-03-06 05:18:28'),
(42, 'Muhammad Rifqi Fadillah', '74786-130', '$2y$12$4PbpxxshVHFsjN/3OFcno.8I/NpcwC.H3j47wuTjzY2Je3jRmmDqu', 3, '2024-03-06 05:18:29', '2024-03-06 05:18:29'),
(43, 'Muhammad Saeful Fazri', '74786-131', '$2y$12$9CQVmh.pP46zP6mF26CL2eBbBmIyhn6aYyWfBIVGK3sBOh6f/Uj2O', 3, '2024-03-06 05:18:29', '2024-03-06 05:18:29'),
(44, 'MUHAMMAD TRISNA NUGRAHA', '74786-132', '$2y$12$5/mRiajJrLLRiX9bojlemeGo/hKUO6Yvc08.JIYm9oV9v0eFSCZ/a', 3, '2024-03-06 05:18:30', '2024-03-06 05:18:30'),
(45, 'NISA RAHMANIAR', '74786-133', '$2y$12$J8bCBv4JgNFFavyBmSGkmOpRCAdY/Tuxc6NYTDRoNDhSVjLYKRuNq', 3, '2024-03-06 05:18:30', '2024-03-06 05:18:30'),
(46, 'RAYHAN AL-GHIFARI', '74786-134', '$2y$12$AOvvgS5F/p.v51b83kB.LOKsFIr3pajiqRR48yk14DzCAqaXQ8wVa', 3, '2024-03-06 05:18:31', '2024-03-06 05:18:31'),
(47, 'REVALINA ARYANTI', '74786-135', '$2y$12$fCOHtvETjqIbmjwrnSzu.ubLqI7BZlIFLUfQ8pED4zSIMqctcplvS', 3, '2024-03-06 05:18:32', '2024-03-06 05:18:32'),
(48, 'Salma Rahmadinah', '74786-136', '$2y$12$4GBe8r17OH6TXbmrD0lQfO9GJjPrTRuq/yFv6JlMOgH4i9de0a/W.', 3, '2024-03-06 05:18:32', '2024-03-06 05:18:32'),
(49, 'SANTI ROSMAWATI', '74786-137', '$2y$12$40KUsq9o5lHC7ffF1JMgzO.2X.GqeJ2zGDpoQLElwdx7omdI0teQy', 3, '2024-03-06 05:18:33', '2024-03-06 05:18:33'),
(50, 'Sayyid Ihza Anshari', '74786-138', '$2y$12$2EyT4tU0OgNUUgb163TMgudsesLApiaftVP2cSDrTs4Xmf8zObkoO', 3, '2024-03-06 05:18:33', '2024-03-06 05:18:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrasis`
--
ALTER TABLE `administrasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aksesusers`
--
ALTER TABLE `aksesusers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `anggotarombels`
--
ALTER TABLE `anggotarombels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hakakses`
--
ALTER TABLE `hakakses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenisassignments`
--
ALTER TABLE `jenisassignments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelajarans`
--
ALTER TABLE `pembelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rombonganbelajars`
--
ALTER TABLE `rombonganbelajars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tahunpelajarans`
--
ALTER TABLE `tahunpelajarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tapel_code` (`tapel_code`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrasis`
--
ALTER TABLE `administrasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `aksesusers`
--
ALTER TABLE `aksesusers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `anggotarombels`
--
ALTER TABLE `anggotarombels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hakakses`
--
ALTER TABLE `hakakses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenisassignments`
--
ALTER TABLE `jenisassignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembelajarans`
--
ALTER TABLE `pembelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rombonganbelajars`
--
ALTER TABLE `rombonganbelajars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tahunpelajarans`
--
ALTER TABLE `tahunpelajarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
