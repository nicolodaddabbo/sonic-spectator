-- Create database
CREATE DATABASE IF NOT EXISTS `sonic_spectator` DEFAULT CHARACTER SET utf8;
USE `sonic_spectator`;

-- TESTING
DROP TABLE IF EXISTS `like`;
DROP TABLE IF EXISTS `notification`;
DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `post_tag`;
DROP TABLE IF EXISTS `tag`;
DROP TABLE IF EXISTS `post`;
DROP TABLE IF EXISTS `block`;
DROP TABLE IF EXISTS `follower`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `gender`;


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

-- Notification Type Table
CREATE TABLE IF NOT EXISTS `notification_type` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(255) NOT NULL,
    `text` VARCHAR(255) NOT NULL
);

-- Notification Table
CREATE TABLE IF NOT EXISTS `notification` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `notification_type_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `sending_user_id` INT NOT NULL,
    `viewed` BOOLEAN DEFAULT FALSE,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`notification_type_id`) REFERENCES `notification_type`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`sending_user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE
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

-- Gender Table
INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'male'),
(2, 'female'),
(3, 'other');

-- Tag Table
INSERT INTO `tag` (`name`) VALUES
('Rock'),
('Metal'),
('Pop'),
('Rap'),
('Electronic'),
('Country'),
('Jazz'),
('Blues'),
('Reggae'),
('Punk'),
('Folk');

-- Notification Type Table
INSERT INTO `notification_type` (`type`, `text`) VALUES
('like', 'liked your post'),
('comment', 'commented on your post'),
('follow', 'started following you');

-- User Table
INSERT INTO `user` (`email`, `username`, `password`, `birth_date`, `profile_img`, `gender_id`) VALUES
('user1@example.com', 'user1', 'password1', '1990-01-15', 'profile1.jpg', 1),
('user2@example.com', 'user2', 'password2', '1985-05-22', 'profile2.jpg', 2),
('user3@example.com', 'user3', 'password3', '1998-09-10', 'profile3.jpg', 3);

-- Follower Table
INSERT INTO `follower` (`follower_id`, `followed_id`) VALUES
(1, 2),
(2, 1),
(1, 3);

-- Block Table
INSERT INTO `block` (`blocker_id`, `blocked_id`) VALUES
(1, 3),
(3, 1);

-- Post Table
INSERT INTO `post` (`description`, `image`, `user_id`) VALUES
('Post 1 Description', 'post1.jpg', 1),
('Post 2 Description', 'post2.jpg', 2),
('Post 3 Description', 'post3.jpg', 3);

-- Linking table to associate tags with posts
INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 4),
(3, 5),
(3, 7);

-- Comment Table
INSERT INTO `comment` (`text`, `user_id`, `post_id`) VALUES
('Comment on Post 1', 2, 1),
('Comment on Post 2', 3, 2),
('Comment on Post 3', 1, 3);

-- Like Table
INSERT INTO `like` (`user_id`, `post_id`) VALUES
(1, 2),
(2, 3),
(3, 1);

-- Notification Table
INSERT INTO `notification` (`notification_type_id`, `sending_user_id`, `user_id`)
VALUES
(1, 1, 2),  -- User 1 liked a post by User 2
(1, 2, 3),  -- User 2 liked a post by User 3
(1, 3, 1),  -- User 2 liked a post by User 3
(2, 2, 1),  -- User 2 commented on a post by User 1
(2, 2, 3),  -- User 3 commented on a post by User 2
(2, 1, 3),  -- User 1 commented on a post by User 3
(3, 1, 2),  -- User 1 started following User 2
(3, 2, 1),  -- User 2 started following User 1
(3, 1, 3);  -- User 1 started following User 3
