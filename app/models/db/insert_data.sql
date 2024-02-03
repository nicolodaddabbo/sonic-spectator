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
('user1@example.com', 'user1', md5('password1'), '1990-01-15', 'profile1.jpg', 1),
('user2@example.com', 'user2', md5('password2'), '1985-05-22', 'profile2.jpg', 2),
('user3@example.com', 'user3', md5('password3'), '1998-09-10', 'profile3.jpg', 3);

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
INSERT INTO `notification` (`notification_type_id`, `sending_user_id`, `user_id`, `post_id`) VALUES
(1, 1, 2, 2),  -- User 1 liked a post by User 2
(1, 2, 3, 3),  -- User 2 liked a post by User 3
(1, 3, 1, 1),  -- User 3 liked a post by User 1
(2, 2, 1, 1),  -- User 2 commented on a post by User 1
(2, 3, 2, 2),  -- User 3 commented on a post by User 2
(2, 1, 3, 3),  -- User 1 commented on a post by User 3
(3, 1, 2, NULL),  -- User 1 started following User 2
(3, 2, 1, NULL),  -- User 2 started following User 1
(3, 1, 3, NULL);  -- User 1 started following User 3
