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
    `artist` VARCHAR(255),
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
    `post_id` INT,
    `viewed` BOOLEAN DEFAULT FALSE,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`notification_type_id`) REFERENCES `notification_type`(`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`sending_user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE,
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
('user@example.com', 'User', md5('password'), '1988-03-20', 'user.jpg', 1),
('john.doe@example.com', 'JohnDoe', md5('john_password'), '1988-03-20', 'john_profile.jpg', 1),
('emma.smith@example.com', 'EmmaSmith', md5('emma_password'), '1992-07-12', 'emma_profile.jpg', 2),
('alex.jones@example.com', 'AlexJones', md5('alex_password'), '1985-11-05', 'alex_profile.jpg', 1),
('lisa.brown@example.com', 'LisaBrown', md5('lisa_password'), '1994-04-28', 'lisa_profile.jpg', 2),
('sara.miller@example.com', 'SaraMiller', md5('sara_password'), '1990-05-15', 'sara_profile.jpg', 2),
('mike.wilson@example.com', 'MikeWilson', md5('mike_password'), '1982-09-30', 'mike_profile.jpg', 1),
('natalie.jones@example.com', 'NatalieJones', md5('natalie_password'), '1995-12-18', 'natalie_profile.jpg', 2),
('david.smith@example.com', 'DavidSmith', md5('david_password'), '1980-02-25', 'david_profile.jpg', 1);

-- Follower Table
INSERT INTO `follower` (`follower_id`, `followed_id`) VALUES
(1, 2),
(2, 1),
(1, 3),
(3, 4),
(4, 2),
(4, 3),
(5, 4),
(3, 5),
(5, 2);

-- Block Table
INSERT INTO `block` (`blocker_id`, `blocked_id`) VALUES
(1, 4),
(4, 1),
(2, 5),
(5, 3);

-- Post Table
INSERT INTO `post` (`description`, `image`, `artist`, `user_id`) VALUES
('Excited for the upcoming Queen concert!', 'queen_concert.jpg', 'Queen', 1),
('Throwback to The Beatles live performance!', 'beatles_concert.jpg', 'The Beatles', 2),
('The Rolling Stones rocked the stage last night!', 'stones_concert.jpg', 'The Rolling Stones', 3),
('Epic Metallica concert with friends!', 'metallica_concert.jpg', 'Metallica', 4),
('Remembering the magical night at the Coldplay concert!', 'coldplay_concert.jpg', 'Coldplay', 2),
('Fantastic jazz performance by Miles Davis!', 'miles_davis_concert.jpg', 'Miles Davis', 3),
('Country vibes at the Keith Urban concert!', 'keith_urban_concert.jpg', 'Keith Urban', 4),
('Folk music under the stars - Unforgettable evening!', 'folk_music_concert.jpg', 'Various Artists', 5);

-- Linking table to associate tags with posts
INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 4),
(3, 5),
(3, 7),
(4, 2),
(4, 10);

-- Comment Table
INSERT INTO `comment` (`text`, `user_id`, `post_id`) VALUES
('Cant wait to see Queen live too!', 2, 1),
('The Beatles are timeless!', 3, 2),
('The Rolling Stones never disappoint!', 1, 3),
('Metallica concerts are always epic!', 3, 4),
('Coldplay concerts are always magical!', 1, 5),
('Miles Davis is a legend!', 2, 6),
('Keith Urban knows how to rock the stage!', 3, 7),
('Folk music under the stars sounds like a dream!', 4, 8),
('Cant wait to experience it!', 5, 8);

-- Like Table
INSERT INTO `like` (`user_id`, `post_id`) VALUES
(1, 2),
(2, 3),
(3, 1),
(4, 4),
(1, 6),
(2, 7),
(3, 5),
(4, 8),
(5, 8);

-- Notification Table
INSERT INTO `notification` (`notification_type_id`, `sending_user_id`, `user_id`, `post_id`) VALUES
(1, 1, 2, 2),  -- User 1 liked a post by User 2
(1, 2, 3, 3),  -- User 2 liked a post by User 3
(1, 3, 1, 1),  -- User 3 liked a post by User 1
(1, 1, 3, 6),   -- User 1 liked a post by User 3
(1, 2, 4, 7),   -- User 2 liked a post by User 4
(1, 3, 2, 5),   -- User 3 liked a post by User 2
(1, 4, 5, 8),   -- User 4 liked a post by User 5
(2, 2, 1, 1),  -- User 2 commented on a post by User 1
(2, 3, 2, 2),  -- User 3 commented on a post by User 2
(2, 1, 3, 3),  -- User 1 commented on a post by User 3
(2, 1, 2, 5),   -- User 1 commented on a post by User 2
(2, 2, 3, 6),   -- User 2 commented on a post by User 3
(2, 3, 4, 7),   -- User 3 commented on a post by User 4
(2, 4, 5, 8),   -- User 1 commented on a post by User 5
(3, 1, 2, NULL),  -- User 1 started following User 2
(3, 2, 1, NULL),  -- User 2 started following User 1
(3, 1, 3, NULL),  -- User 1 started following User 3
(3, 3, 4, NULL),  -- User 3 started following User 4
(3, 4, 2, NULL),  -- User 4 started following User 2
(3, 4, 3, NULL),  -- User 4 started following User 3
(3, 5, 4, NULL),  -- User 5 started following User 4
(3, 3, 5, NULL),  -- User 3 started following User 5
(3, 5, 2, NULL);  -- User 5 started following User 2
