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

CREATE TABLE `channels` (
  `id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` VARCHAR(255) NOT NULL,
  `descripion` TEXT,
  `type` int unsigned NOT NULL,
  `url_id` VARCHAR(255) NOT NULL
);

CREATE TABLE `threads` (
  `id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `channel_id` int unsigned NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `url_id` VARCHAR(255) NOT NULL,
  `total_messages` int unsigned NOT NULL DEFAULT 1,
  `total_views` int unsigned NOT NULL DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES `users`(id),
  FOREIGN KEY (channel_id) REFERENCES `channels`(id)
);

CREATE TABLE `messages` (
  `id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `channel_id` int unsigned NOT NULL,
  `thread_id` int unsigned, 
  `content` text,
  `total_views` int unsigned NOT NULL DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES `users`(id),
  FOREIGN KEY (channel_id) REFERENCES `channels`(id),
  FOREIGN KEY (thread_id) REFERENCES `threads`(id)
);

