<?php
namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

session_start();

class NotificationController
{
    private $notificationService;

    public function __construct()
    {
        $this->notificationService = new \NotificationService();
    }

    public function markAllAsViewed(RouteCollection $routes)
    {
        $this->notificationService->markAllUserNotificationsAsViewed($_SESSION['user_id']);
        echo json_encode(['status' => 'success']);
    }
}