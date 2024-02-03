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

    public function markAllUserNotificationsAsViewed($user_id)
    {
        // Get all notifications for the user
        $userNotifications = $this->userRepository->getUserNotifications($user_id);

        // Mark all notifications as viewed
        foreach ($userNotifications as $notification) {
            $this->markNotificationAsViewed($notification['id']);
        }
    }

    private function markNotificationAsViewed($notificationId)
    {
        $query = "UPDATE `notification` SET `viewed` = TRUE WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $notificationId);
        $stmt->execute();
    }

    public function deleteNotification($notificationId)
    {
        $query = "DELETE FROM `notification` WHERE `id` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $notificationId);
        $stmt->execute();
    }

    public function getNotificationType($notificationId)
    {
        $query = "SELECT nt.type
                  FROM `notification` n
                  JOIN `notification_type` nt ON n.notification_type_id = nt.id
                  WHERE n.id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $notificationId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    
}
