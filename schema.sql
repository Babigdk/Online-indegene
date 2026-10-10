CREATE TABLE IF NOT EXISTS `fika_admin` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `phone_number` VARCHAR(30) NOT NULL DEFAULT '',
    `home_town` VARCHAR(150) NOT NULL DEFAULT '',
    `contact_address` TEXT NOT NULL,
    `email` VARCHAR(254) NOT NULL DEFAULT '',
    `gender` VARCHAR(20) NOT NULL DEFAULT '',
    `image` VARCHAR(255) NOT NULL DEFAULT '',
    `submission_date` DATE NOT NULL,
    PRIMARY KEY (`id`),
    KEY `idx_fika_admin_first_name` (`first_name`),
    KEY `idx_fika_admin_last_name` (`last_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
