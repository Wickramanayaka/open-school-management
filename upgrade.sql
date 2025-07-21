CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` varchar(191) NOT NULL,
  `grade_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;