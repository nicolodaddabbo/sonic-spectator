<?php
namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class PageController
{
    private $conn;

    public function __construct()
    {
        $this->conn = new \DatabaseHelper();
    }

    public function indexAction(RouteCollection $routes)
	{
        $posts = $this->conn->getPostsByFollowingUsers(1);
        require_once APP_ROOT . '/views/home.php';
	}
}