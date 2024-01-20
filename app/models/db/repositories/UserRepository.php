<?php

class UserRepository
{
    private $db;

    public function __construct()
    {
        $databaseConnection = new \DatabaseConnection();
        $this->db = $databaseConnection->getConnection();
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

    public function getUserFollowers($user_id)
    {
        $query = "SELECT `follower_id` FROM `follower` WHERE `followed_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isFollowing($followerId, $followedId)
    {
        $query = "SELECT COUNT(*) as count FROM `follower` WHERE `follower_id`=? AND `followed_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $followerId, $followedId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] > 0;
    }

    public function getUserFollowersCount($user_id)
    {
        $query = "SELECT COUNT(*) AS followers_count FROM `follower` WHERE `followed_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['followers_count'];
    }

    public function getUserFollowing($user_id)
    {
        $query = "SELECT `followed_id` FROM `follower` WHERE `follower_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserFollowingCount($user_id)
    {
        $query = "SELECT COUNT(*) AS following_count FROM `follower` WHERE `follower_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['following_count'];
    }


    public function getUserBlockedUsers($user_id)
    {
        $query = "SELECT `blocked_id` FROM `block` WHERE `blocker_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserNotifications($user_id)
    {
        $query = "SELECT * FROM `notification` WHERE `user_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function toggleFollowUser($follower_id, $followed_id)
{
    // Check if a follow relationship already exists
    if ($this->isFollowing($follower_id, $followed_id)) {
        // If it does, unfollow by deleting the corresponding record
        $query = "DELETE FROM `follower` WHERE `follower_id` = ? AND `followed_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $follower_id, $followed_id);
        $stmt->execute();

        return false; // Indicate that the user is now not following
    } else {
        // If it doesn't, follow by inserting a new record
        $query = "INSERT INTO `follower` (`follower_id`, `followed_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $follower_id, $followed_id);
        $stmt->execute();

        return true; // Indicate that the user is now following
    }
}

    public function blockUser($blocker_id, $blocked_id)
    {
        $query = "INSERT INTO `block` (`blocker_id`, `blocked_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $blocker_id, $blocked_id);
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
}
