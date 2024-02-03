<?php

class NotificationService
{
    private $db;
    private $userRepository;

    public function __construct()
    {
        $databaseConnection = new \DatabaseConnection();
        $this->db = $databaseConnection->getConnection();
        $this->userRepository = new \UserRepository();
    }

    public function sendNotification($notification_type_id, $sending_user_id, $user_id)
    {
        $query = "INSERT INTO `notification` (`notification_type_id`, `user_id`, `sending_user_id`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('iii', $notification_type_id, $user_id, $sending_user_id);
        $stmt->execute();
    }

    public function deleteNotification($notificationId)
    {
        $query = "DELETE FROM `notification` WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $notificationId);
        $stmt->execute();
    }
    
}
