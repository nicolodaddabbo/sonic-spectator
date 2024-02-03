<?php
namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

session_start();

class NotificationController
{
    private $notificationService;
    private $userReposiotry;

    public function __construct()
    {
        $this->notificationService = new \NotificationService();
        $this->userReposiotry = new \UserRepository();
    }

    public function getNewNotificationsCount(RouteCollection $routes)
    {
        $notifications = $this->userReposiotry->getUserNotifications($_SESSION['user_id']);
        $count = 0;
        foreach ($notifications as $notification) {
            if ($notification['viewed'] == 0) {
                $count++;
            }
        }
        echo json_encode(['count' => $count]);
    }

    public function markAllAsViewed(RouteCollection $routes)
    {
        $this->notificationService->markAllUserNotificationsAsViewed($_SESSION['user_id']);
        echo json_encode(['status' => 'success']);
    }
}