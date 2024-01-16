<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class PageController
{
    private $conn;
    private $postRepository;

    public function __construct()
    {
        $this->conn = new \DatabaseConnection();
        $this->postRepository = new \PostRepository($this->conn->getConnection());
    }

    public function indexAction(RouteCollection $routes)
    {
        $posts = $this->postRepository->getPostsByFollowingUsers(1);
        require_once APP_ROOT . '/views/home.php';
    }
}
