<?php

class DatabaseHelper
{
    private $db;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        // Creating connection
        $this->db = new mysqli($servername, $username, $password);

        // Checking connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        // Reading the SQL file content
        $sqlFile = file_get_contents('db_creation.sql');

        // Executing the SQL file
        if (!$this->db->multi_query($sqlFile)) {
            die("Error creating tables: " . $this->db->error . "\n");
        }
    }

    public function checkLoginCredentials($email, $password)
    {
        $query = "SELECT * FROM `user` WHERE `email`=? AND `password`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function isPostLikedByUser($user_id, $post_id)
    {
        $query = "SELECT * FROM `like` WHERE `user_id`=? AND `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc() !== null;
    }

    public function registerUser($email, $username, $password, $birth_date, $profile_img, $gender_id)
    {
        $query = "INSERT INTO `user` (`email`, `username`, `password`, `birth_date`, `profile_img`, `gender_id`)
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssi', $email, $username, $password, $birth_date, $profile_img, $gender_id);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function followUser($follower_id, $followed_id)
    {
        $query = "INSERT INTO `follower` (`follower_id`, `followed_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $follower_id, $followed_id);
        $stmt->execute();
    }

    public function blockUser($blocker_id, $blocked_id)
    {
        $query = "INSERT INTO `block` (`blocker_id`, `blocked_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $blocker_id, $blocked_id);
        $stmt->execute();
    }

    public function createPost($description, $image, $user_id)
    {
        $query = "INSERT INTO `post` (`description`, `image`, `user_id`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $description, $image, $user_id);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function addCommentToPost($text, $user_id, $post_id)
    {
        $query = "INSERT INTO `comment` (`text`, `user_id`, `post_id`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $text, $user_id, $post_id);
        $stmt->execute();
    }

    public function addTagToPost($post_id, $tag_id)
    {
        $query = "INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $post_id, $tag_id);
        $stmt->execute();
    }

    public function likePost($user_id, $post_id)
    {
        $query = "INSERT INTO `like` (`user_id`, `post_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
    }

    public function sendNotification($user_id, $notificationText)
    {
        $query = "INSERT INTO `notification` (`user_id`, `text`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is', $user_id, $notificationText);
        $stmt->execute();
    }

    public function updateUserProfile($user_id, $newUsername, $newEmail, $newPassword, $newProfileImg)
    {
        $query = "UPDATE `user` SET `username`=?, `email`=?, `password`=?, `profile_img`=? WHERE `id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssi', $newUsername, $newEmail, $newPassword, $newProfileImg, $user_id);
        $stmt->execute();
    }

    public function deleteUserAccount($user_id)
    {

        $this->deleteUserPosts($user_id);
        $this->deleteUserComments($user_id);
        $this->deleteUserLikes($user_id);
        $this->deleteUserFollowers($user_id);
        $this->deleteUserFollowing($user_id);
        $query = "DELETE FROM `user` WHERE `id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    private function deleteUserPosts($user_id)
    {
        $query = "DELETE FROM `post` WHERE `user_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    private function deleteUserComments($user_id)
    {
        $query = "DELETE FROM `comment` WHERE `user_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    private function deleteUserLikes($user_id)
    {
        $query = "DELETE FROM `like` WHERE `user_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    private function deleteUserFollowers($user_id)
    {
        $query = "DELETE FROM `follower` WHERE `followed_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    private function deleteUserFollowing($user_id)
    {
        $query = "DELETE FROM `follower` WHERE `follower_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
    }

    public function searchUsers($searchTerm)
    {
        $query = "SELECT `id`, `username` FROM `user` WHERE `username` LIKE ?";
        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $searchTerm . '%';
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserPosts($user_id)
    {
        $query = "SELECT `id`, `description`, `image` FROM `post` WHERE `user_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowers($user_id)
    {
        $query = "SELECT `follower_id` FROM `follower` WHERE `followed_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowersCount($user_id)
    {
        $query = "SELECT COUNT(*) AS followers_count FROM `follower` WHERE `followed_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['followers_count'];
    }

    public function getFollowing($user_id)
    {
        $query = "SELECT `followed_id` FROM `follower` WHERE `follower_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingCount($user_id)
    {
        $query = "SELECT COUNT(*) AS following_count FROM `follower` WHERE `follower_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['following_count'];
    }

    public function getBlockedUsers($user_id)
    {
        $query = "SELECT `blocked_id` FROM `block` WHERE `blocker_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostTags($post_id)
    {
        $query = "SELECT `tag_id` FROM `post_tag` WHERE `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostComments($post_id)
    {
        $query = "SELECT `id`, `text`, `user_id` FROM `comment` WHERE `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostLikes($post_id)
    {
        $query = "SELECT `user_id` FROM `like` WHERE `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostLikesCount($post_id)
    {
        $query = "SELECT COUNT(*) AS likes_count FROM `like` WHERE `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['likes_count'];
    }
}
