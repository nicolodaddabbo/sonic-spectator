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

-- Notification Table
INSERT INTO `notification` (`user_id`, `post_id`) VALUES
(2, 1),
(3, 2),
(1, 3);

-- Like Table
INSERT INTO `like` (`user_id`, `post_id`) VALUES
(1, 2),
(2, 3),
(3, 1);
