-- Create database
CREATE DATABASE IF NOT EXISTS `sonic_spectator` DEFAULT CHARACTER SET utf8;
USE `sonic_spectator`;

-- TESTING
-- DROP TABLE IF EXISTS `like`;
-- DROP TABLE IF EXISTS `notification`;
-- DROP TABLE IF EXISTS `comment`;
-- DROP TABLE IF EXISTS `post_tag`;
-- DROP TABLE IF EXISTS `tag`;
-- DROP TABLE IF EXISTS `post`;
-- DROP TABLE IF EXISTS `block`;
-- DROP TABLE IF EXISTS `follower`;
-- DROP TABLE IF EXISTS `user`;
-- DROP TABLE IF EXISTS `gender`;
--

-- Gender Table
CREATE TABLE IF NOT EXISTS `gender` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

-- User Table
CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `username` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `birth_date` TIMESTAMP NOT NULL,
    `profile_img` VARCHAR(255),
    `gender_id` INT NOT NULL,
    `register_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`gender_id`) REFERENCES `gender`(`id`)
);

-- Follower Table
CREATE TABLE IF NOT EXISTS `follower` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `follower_id` INT NOT NULL,
    `followed_id` INT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`follower_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`followed_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
);

-- Block Table
CREATE TABLE IF NOT EXISTS `block` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `blocker_id` INT NOT NULL,
    `blocked_id` INT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`blocker_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`blocked_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
);

-- Post Table
CREATE TABLE IF NOT EXISTS `post` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `description` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
);

-- Tag Table
CREATE TABLE IF NOT EXISTS `tag` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

-- Linking table to associate tags with posts
CREATE TABLE IF NOT EXISTS `post_tag` (
    `post_id` INT,
    `tag_id` INT,
    PRIMARY KEY (`post_id`, `tag_id`),
    FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`tag_id`) REFERENCES `tag`(`id`) ON DELETE CASCADE
);

-- Comment Table
CREATE TABLE IF NOT EXISTS `comment` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `text` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE CASCADE
);

-- Notification Table
CREATE TABLE IF NOT EXISTS `notification` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `post_id` INT,
    `text` VARCHAR(255),
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE CASCADE
);

-- Like Table
CREATE TABLE IF NOT EXISTS `like` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `post_id` INT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES `post`(`id`) ON DELETE CASCADE
);
