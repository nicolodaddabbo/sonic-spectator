<?php

class PostRepository
{
    private $db;
    private $userRepository;

    public function __construct($db)
    {
        $this->db = $db;
        $this->userRepository = new \UserRepository($db);
    }

    public function getUserPosts($user_id)
    {
        $query = "SELECT `id`, `description`, `image` FROM `post` WHERE `user_id`=? ORDER BY `date` DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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
}
