<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class SearchController
{
    private $conn;
    private $postRepository;
    private $userRepository;

    public function __construct()
    {
        $this->conn = new \DatabaseConnection();
        $this->postRepository = new \PostRepository($this->conn->getConnection());
        $this->userRepository = new \UserRepository($this->conn->getConnection());
    }

    public function search(string $query, RouteCollection $routes)
    {
        $users = $this->userRepository->searchUsers($query);
        $posts = $this->postRepository->searchPostsByTags($query);

        require_once APP_ROOT . "/views/search.php";
    }
}