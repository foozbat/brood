CREATE TABLE `users` (
  `id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL
);

CREATE TABLE `user_sessions` (
  `id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `logged_in` BOOLEAN NOT NULL DEFAULT TRUE,
  `auth_token` VARCHAR(255) NOT NULL,
  `csrf_token` VARCHAR(255) NOT NULL,
  `fingerprint` CHAR(32)
);