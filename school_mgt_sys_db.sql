-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 07:12 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_mgt_sys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'developer.pasindujayanath89@gmail.com', '$2y$10$hT.o6RlIH.TK4GIQX/WwdurmG8KPU6weRu2KDt/jifvL2TtBGJKsy', 'azAAmLOrQcecvB9nSlL52VDQihzDFAiijhfzJnhoXkH9FckZ28Qspk7EJvpj', NULL, '2018-11-04 04:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `cls_id` varchar(8) NOT NULL,
  `code` varchar(6) NOT NULL,
  `name` varchar(140) NOT NULL,
  `year` int(1) NOT NULL,
  `semester` int(1) NOT NULL,
  `floor` int(1) NOT NULL,
  `room` int(2) NOT NULL,
  `capacity` int(3) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `cls_id`, `code`, `name`, `year`, `semester`, `floor`, `room`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 'CLS00001', 'CS0001', 'Auditoriam', 1, 1, 1, 1, 100, '2018-10-28 09:40:47', '2018-11-05 03:00:30'),
(3, 'CLS00002', 'CS0002', 'Auditorium-2', 1, 2, 1, 2, 122, '2018-10-28 17:33:14', '2018-11-05 03:02:34'),
(4, 'CLS00003', 'CS0003', 'Lecture Room-3', 2, 3, 2, 2, 90, '2018-11-05 03:02:25', '2018-11-05 03:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(10) UNSIGNED NOT NULL,
  `ins_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initials` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_in_full` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `experience` double(4,2) NOT NULL,
  `qualification` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `ins_id`, `f_name`, `l_name`, `initials`, `init_in_full`, `dob`, `experience`, `qualification`, `email`, `phone`, `address`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'INS00001', 'Billz', 'Gates', 'W.H.', 'William Henry', '1955-10-28', 43.00, 'Microsoft Masters', 'billgates@microsoft.com', '0939393933', 'America.', 'A good man.', '2018-11-01 00:17:33', '2018-11-02 22:25:30'),
(3, 'INS00002', 'Steve', 'Jobs', 'S.', 'Stephen', '1955-02-24', 40.00, 'Mac Architecture Masters', 'stevejobs@apple.com', '0997863453', 'Kirulapone, Colombo-6.', NULL, '2018-11-04 21:26:05', '2018-11-04 21:26:05'),
(4, 'INS00003', 'Michael', 'Dell', 'S.', 'Shepherd', '1965-02-23', 27.00, 'Hardware Architecture Designer', 'michael@dell.com', '0383636333', '#143, Rawatawatta, Moratuwa.', NULL, '2018-11-04 21:29:43', '2018-11-04 21:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_subject`
--

CREATE TABLE `instructor_subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `instructor_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructor_subject`
--

INSERT INTO `instructor_subject` (`id`, `instructor_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 5, '2018-11-03 06:30:22', '2018-11-03 06:30:22'),
(3, 1, 1, '2018-11-04 00:31:03', '2018-11-04 00:31:03'),
(4, 1, 8, '2018-11-05 08:06:11', '2018-11-05 08:06:11'),
(5, 1, 11, '2018-11-05 08:06:11', '2018-11-05 08:06:11'),
(6, 1, 20, '2018-11-05 08:06:11', '2018-11-05 08:06:11'),
(7, 3, 13, '2018-11-05 08:07:17', '2018-11-05 08:07:17'),
(8, 3, 14, '2018-11-05 08:07:17', '2018-11-05 08:07:17'),
(9, 3, 15, '2018-11-05 08:07:17', '2018-11-05 08:07:17'),
(10, 3, 16, '2018-11-05 08:07:17', '2018-11-05 08:07:17'),
(11, 3, 17, '2018-11-05 08:07:17', '2018-11-05 08:07:17'),
(14, 4, 5, '2018-11-05 08:08:19', '2018-11-05 08:08:19'),
(15, 4, 7, '2018-11-05 08:08:19', '2018-11-05 08:08:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_23_103954_create_students_table', 1),
(4, '2018_10_27_153534_create_instructors_table', 2),
(5, '2018_10_29_124928_create_admins_table', 3),
(6, '2018_10_31_124415_create_roles_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'student', '2018-10-31 12:52:22', '2018-11-01 09:57:26'),
(2, 'instructor', '2018-10-31 12:52:34', '2018-10-31 12:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `stu_id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initials` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_in_full` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_name` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardian_phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `stu_id`, `f_name`, `l_name`, `initials`, `init_in_full`, `dob`, `email`, `phone`, `guardian_name`, `guardian_phone`, `address`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'STU00001', 'Pasindu', 'Jayanath', 'S.H.', 'Sudirikku Hennadige', '1989-09-29', 'jayapacndunath.89@gmail.com', '0771387888', 'Mr. S.H.W. Goonasene', '0413415801', '\'Pasan\', Dampella, Thelijjawila.', 'A very good boy.', '2018-11-01 00:13:07', '2018-11-02 22:26:20'),
(4, 'STU00002', 'Hasun', 'Danansooriya', 'R.', 'Rathnatake', '1989-12-31', 'hasun@yukon.lk', '0712373833', 'Mr.Rathnayake', '0348485955', 'Madampe, Chilaw.', NULL, '2018-11-04 21:10:47', '2018-11-04 21:10:47'),
(5, 'STU00003', 'Chinthaka', 'Udayanga', 'M.', 'Makawita', '1989-03-26', 'chinthaka@platform1.com', '0715975865', 'Mr.Makawita', '0412224494', 'Paraduwa, Akuressa.', NULL, '2018-11-04 21:12:26', '2018-11-04 21:12:26'),
(7, 'STU00004', 'Manuja', 'Jayawardana', 'J.', 'Jayawardane', '1992-10-06', 'manuja@yukon.lk', '0716373564', 'Mr. Jayawardane', '0113343455', 'Hogaana Pokuna, Rajagiriya.', NULL, '2018-11-04 21:16:09', '2018-11-04 21:16:18'),
(8, 'STU00005', 'Achala', 'Chamindanath', 'W.K.', 'Wanniarachchi Kankanamlage', '1986-10-15', 'achala@yahoo.com', '0713267980', 'Mrs. Wijesekare', '0412274784', '\'Pasan Home\', Dampella, Thelijjawila.', NULL, '2018-11-04 21:18:51', '2018-11-04 21:18:51'),
(9, 'STU00006', 'Ranjan', 'Priyantha', 'N.V.', 'Navadawa Witanage', '1986-11-15', 'ranjan@gmail.com', '0773939333', 'Mrs. Daya Gamage', '0412286737', 'Waralla, Deniyaya.', NULL, '2018-11-04 21:22:05', '2018-11-04 21:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`id`, `student_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(12, 1, 1, '2018-11-03 22:01:56', '2018-11-03 22:01:56'),
(14, 4, 13, '2018-11-05 08:09:31', '2018-11-05 08:09:31'),
(15, 4, 14, '2018-11-05 08:09:31', '2018-11-05 08:09:31'),
(16, 4, 15, '2018-11-05 08:09:31', '2018-11-05 08:09:31'),
(17, 4, 16, '2018-11-05 08:09:31', '2018-11-05 08:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `sbj_id` varchar(8) NOT NULL,
  `code` varchar(6) NOT NULL,
  `name` varchar(140) NOT NULL,
  `year` int(1) NOT NULL,
  `semester` int(1) NOT NULL,
  `periods` int(3) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `sbj_id`, `code`, `name`, `year`, `semester`, `periods`, `created_at`, `updated_at`) VALUES
(1, 'SBJ00001', 'IT1104', 'Web Applications', 1, 2, 90, '2018-10-28 08:22:54', '2018-11-03 01:00:17'),
(5, 'SBJ00002', 'EE1122', 'Programming I', 2, 2, 1, '2018-11-02 09:02:14', '2018-11-03 12:02:23'),
(7, 'SBJ00003', 'IT1001', 'Accountancy', 1, 1, 123, '2018-11-05 03:05:35', '2018-11-05 03:05:35'),
(8, 'SBJ00004', 'IT1201', 'Computer Organization', 1, 1, 125, '2018-11-05 03:06:12', '2018-11-05 03:06:12'),
(9, 'SBJ00005', 'IT1002', 'Communication Skill Development', 1, 2, 89, '2018-11-05 03:07:55', '2018-11-05 03:07:55'),
(10, 'SBJ00006', 'IT1103', 'Visual Application Programming', 1, 2, 111, '2018-11-05 03:08:46', '2018-11-05 03:08:46'),
(11, 'SBJ00007', 'IT1801', 'Data Management Systems', 1, 2, 99, '2018-11-05 03:09:23', '2018-11-05 03:09:23'),
(12, 'SBJ00008', 'IT2203', 'Computer Architecture', 2, 3, 122, '2018-11-05 03:10:19', '2018-11-05 03:10:19'),
(13, 'SBJ00009', 'IT2302', 'Computer Networks', 2, 3, 131, '2018-11-05 03:10:53', '2018-11-05 03:10:53'),
(14, 'SBJ00010', 'IT2303', 'Network Programming', 2, 3, 101, '2018-11-05 03:11:26', '2018-11-05 03:11:26'),
(15, 'SBJ00011', 'IT2401', 'Logic Programming', 2, 3, 114, '2018-11-05 03:11:53', '2018-11-05 03:11:53'),
(16, 'SBJ00012', 'IT2402', 'Intelligent Systems', 2, 3, 122, '2018-11-05 03:12:20', '2018-11-05 03:12:20'),
(17, 'SBJ00013', 'IT2601', 'Multimedia Design', 2, 4, 105, '2018-11-05 03:12:48', '2018-11-05 03:12:48'),
(18, 'SBJ00014', 'IT2301', 'Basics of Information and Network Security', 2, 4, 132, '2018-11-05 03:13:21', '2018-11-05 03:13:21'),
(19, 'SBJ00015', 'IT2202', 'Operating Systems', 2, 4, 108, '2018-11-05 03:13:46', '2018-11-05 03:13:46'),
(20, 'SBJ00016', 'IT2105', 'Data Structures and Algorithms', 2, 4, 67, '2018-11-05 03:14:09', '2018-11-05 03:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'stu', 'Pasindu Jayanath', 'jayapacndunath.89@gmail.com', '$2y$10$mSRprwn.H81czUBooXeBBuJo892TQI/oehytG3vjmdKjq/fDm6ws6', 'JuEz6lxWmIFgifU2yAjoUaZAnkI87tej6tnY5ak2qqThe2o640YhMeqALuwn', '2018-11-01 00:13:07', '2018-11-04 04:37:38'),
(2, 'ins', 'Billz Gates', 'billgates@microsoft.com', '$2y$10$ViczzchNnSjVAijVp0q2PeS5mxIwSf//ZKgy1HLRSjkx9TamnZ/I2', 'c1Wk6TergtOxqN3DFXHYQpQL6z1WaGO1EQtnHAQE5zVTpYAXToyCqpIY2tlL', '2018-11-01 00:17:34', '2018-11-04 00:56:02'),
(3, 'stu', 'Aazzzzzzxxz asd', 'sdf@sfd.uj', '$2y$10$nrZ0QVpXgu3K8AtUl9tuUuq4A0aWQqNgGVpRiHVI5CvKXCuW5b742', 'Tss42b6PZPlZ71ymytGgW8rtrd8RjfSeBwB7ro10dXy656fXQaeLgRpLpZnG', '2018-11-01 05:00:41', '2018-11-03 23:33:05'),
(4, 'ins', 'Aqqqqqqzz aSA', 'dfd@sd.sd', '$2y$10$WSmW/raKePS7E9VRRykyMOc6arqz/zAr2iIZ0kGy0m5lLyAm9VA2i', NULL, '2018-11-01 05:02:12', '2018-11-03 23:35:27'),
(5, 'stu', 'Hasun Danansooriya', 'hasun@yukon.lk', '$2y$10$UCR8nZUTVVdyzIhRaBLvcOv240P0KvgP0ms9EvYQyVQ7YQ8I.Me1C', 'vu4Xes1c2qwUyXjPaQA7Vs1M4yiF0wqvk8taUcHfiAgoDfLx4X9ZNn7UmCqd', '2018-11-04 21:10:47', '2018-11-04 21:10:47'),
(6, 'stu', 'Chinthaka Udayanga', 'chinthaka@platform1.com', '$2y$10$eqyE48OhGdlbSaJ9ltu6XeTbMfQ3QAhmlgGYX67iLWNEog2YV9n1K', NULL, '2018-11-04 21:12:26', '2018-11-04 21:12:26'),
(7, 'stu', 'Manuja Jayawardana', 'manuja@yukon.lk', '$2y$10$bskz7UGOyqJG8ugQx3mDD.AQV8j07D2Z0nPylLYHP6KMK6Khb7YEi', 'CVXVTcCff16ipnzaJJ0YOLfFB3Lhn51qc7p8EizeNsIrtKTIXVfxlShJF4sz', '2018-11-04 21:16:09', '2018-11-04 21:16:18'),
(8, 'stu', 'Achala Chamindanath', 'achala@yahoo.com', '$2y$10$d0NK1tOCF4IyVG.0.YEhkuArJWnAwSfn4DwkwZ8hSLc..rEJsKfuW', NULL, '2018-11-04 21:18:51', '2018-11-04 21:18:51'),
(9, 'stu', 'Ranjan Priyantha', 'ranjan@gmail.com', '$2y$10$bXZ6tLD4tVMahJ7TOeF6mu3HhGCvyGa0WuaDxK3qoHV4iOjRpc6Q6', NULL, '2018-11-04 21:22:05', '2018-11-04 21:22:05'),
(10, 'ins', 'Steve Jobs', 'stevejobs@apple.com', '$2y$10$Sa.jLJJz8u185L2rhcHDZevbr3R99QnttAYT66eo.pIei/AAUg2vm', 'k1M83E4CWf0D2lfs38ieMAS1qLwki4wO39MtgMD1Fu0urG8RHjfN0Fs1mLmm', '2018-11-04 21:26:05', '2018-11-04 21:26:05'),
(11, 'ins', 'Michael Dell', 'michael@dell.com', '$2y$10$lJIZXIv2RhVaduMpYmRzueObxXROCfS5ewAjRVB5mtfp7qgQYzVua', 'BZE5VciONXyd0ossHQ1eVEQpeO523C7XIUxFxa5f9GLJGMM9K49EUIyacnOU', '2018-11-04 21:29:44', '2018-11-04 21:29:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `instructors_ins_id_unique` (`ins_id`),
  ADD UNIQUE KEY `instructors_email_unique` (`email`);

--
-- Indexes for table `instructor_subject`
--
ALTER TABLE `instructor_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_subject_instructor_id_foreign` (`instructor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_stu_id_unique` (`stu_id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_subject_student_id_foreign` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `role_id` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `instructor_subject`
--
ALTER TABLE `instructor_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `instructor_subject`
--
ALTER TABLE `instructor_subject`
  ADD CONSTRAINT `instructor_subject_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD CONSTRAINT `student_subject_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
