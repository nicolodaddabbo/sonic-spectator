<?php

class PostRepository
{
    private $db;
    private $userRepository;

    public function __construct()
    {
        $databaseConnection = new \DatabaseConnection();
        $this->db = $databaseConnection->getConnection();
        $this->userRepository = new \UserRepository();
    }

    public function searchPostsByTags($searchTerm)
    {
        $query = "SELECT p.*
                FROM `post` p
                INNER JOIN `post_tag` pt ON p.`id` = pt.`post_id`
                INNER JOIN `tag` t ON pt.`tag_id` = t.`id`
                WHERE t.`name` LIKE ?
                ORDER BY p.`date` DESC";

        $stmt = $this->db->prepare($query);
        $searchTerm = '%' . $searchTerm . '%';
        $stmt->bind_param('s', $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserPosts($user_id)
    {
        $query = "SELECT * FROM `post` WHERE `user_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($post_id)
    {
        $query = "SELECT `id`, `description`, `image`, `user_id` FROM `post` WHERE `id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getUserPostById($user_id, $post_id)
    {
        $query = "SELECT `id`, `description`, `image` FROM `post` WHERE `user_id`=? AND `id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getPostsByFollowingUsers($user_id)
    {
        // Get the user IDs of those being followed by the specified user
        $followingUsers = $this->userRepository->getUserFollowing($user_id);

        // If no users are being followed, return an empty array
        if (empty($followingUsers)) {
            return [];
        }

        // Extract the followed user IDs from the result
        $followedUserIDs = array_column($followingUsers, 'followed_id');

        // Prepare a query to get all posts made by the followed users
        $query = "SELECT p.*
                FROM `post` p
                WHERE p.`user_id` IN (" . implode(',', $followedUserIDs) . ")
                ORDER BY p.`date` DESC";

        $result = $this->db->query($query);

        if (!$result) {
            die("Error retrieving posts: " . $this->db->error);
        }

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
        $query = "SELECT `id`, `text`, `user_id` FROM `comment` WHERE `post_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostCommentsCount($post_id)
    {
        $query = "SELECT COUNT(*) AS comments_count FROM `comment` WHERE `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['comments_count'];
    }

    public function getPostLikes($post_id)
    {
        $query = "SELECT `user_id` FROM `like` WHERE `post_id`=? ORDER BY `date` DESC";
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

    public function isPostLikedByUser($user_id, $post_id)
    {
        $query = "SELECT * FROM `like` WHERE `user_id`=? AND `post_id`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc() !== null;
    }

    public function createPost($description, $image, $artist, $user_id)
    {
        $query = "INSERT INTO `post` (`description`, `image`, `artist`, `user_id`) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssi', $description, $image, $artist, $user_id);
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

    public function toggleLike($user_id, $post_id)
    {
        // Check if the user has already liked the post
        $query = "SELECT * FROM `like` WHERE `user_id` = ? AND `post_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User has already liked the post, so unlike it
            $this->unlikePost($user_id, $post_id);
        } else {
            // User has not liked the post, so like it
            $this->likePost($user_id, $post_id);
        }
    }

    public function likePost($user_id, $post_id)
    {
        $query = "INSERT INTO `like` (`user_id`, `post_id`) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
    }

    private function unlikePost($user_id, $post_id)
    {
        $query = "DELETE FROM `like` WHERE `user_id` = ? AND `post_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $user_id, $post_id);
        $stmt->execute();
    }

    public function deletePost($post_id)
    {
        $this->deleteAllPostComments($post_id);
        $this->deleteAllPostLikes($post_id);
        $this->deleteAllPostNotifications($post_id);
        $this->deleteAllPostTags($post_id);
        $query = "DELETE FROM `post` WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
    }

    private function deleteAllPostComments($post_id){
        $query = "DELETE FROM `comment` WHERE `post_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
    }

    private function deleteAllPostLikes($post_id){
        $query = "DELETE FROM `like` WHERE `post_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
    }

    private function deleteAllPostNotifications($post_id){
        $query = "DELETE FROM `notification` WHERE `post_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
    }

    private function deleteAllPostTags($post_id){
        $query = "DELETE FROM `post_tag` WHERE `post_id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $post_id);
        $stmt->execute();
    }
}
