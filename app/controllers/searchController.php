<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class SearchController
{
    private $postRepository;
    private $userRepository;

    public function __construct()
    {
        $this->postRepository = new \PostRepository();
        $this->userRepository = new \UserRepository();
    }

    public function search(string $query, RouteCollection $routes)
    {
        $users = $this->userRepository->searchUsers($query);
        $posts = $this->postRepository->searchPostsByTags($query);

        include_once APP_ROOT . "/views/searchResults.php";
    }
}