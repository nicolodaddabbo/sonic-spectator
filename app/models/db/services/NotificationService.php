<?php

class NotificationService
{
    private $db;
    private $userRepository;

    public function __construct($db)
    {
        $this->db = $db;
        $this->userRepository = new \UserRepository($db);
    }

    public function sendNotificationToFollowers($user_id, $notificationText)
    {
        // Retrieve the followers of the user
        $followers = $this->userRepository->getUserFollowers($user_id);

        // Iterate through followers and send notifications
        foreach ($followers as $follower) {
            $follower_id = $follower['follower_id'];

            $query = "INSERT INTO `notification` (`user_id`, `text`) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('is', $follower_id, $notificationText);
            $stmt->execute();
        }
    }

    public function sendNotificationToFollowersWithPost($user_id, $notificationText, $post_id)
    {
        // Retrieve the followers of the user
        $followers = $this->userRepository->getUserFollowers($user_id);

        // Iterate through followers and send notifications
        foreach ($followers as $follower) {
            $follower_id = $follower['follower_id'];

            $query = "INSERT INTO `notification` (`user_id`, `text`, `post_id`) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('isi', $follower_id, $notificationText, $post_id);
            $stmt->execute();
        }
    }
}
