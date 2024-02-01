<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class PageController
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new \PostRepository();
    }

    public function indexAction(RouteCollection $routes)
    {
        $posts = $this->postRepository->getPostsByFollowingUsers(1);
        require_once APP_ROOT . '/views/home.php';
    }

    public function searchAction(RouteCollection $routes)
    {
        require_once APP_ROOT . '/views/search.php';
    }

    public function loginAction(RouteCollection $routes)
    {
        require_once APP_ROOT . '/views/login.php';
    }

    public function registerAction(RouteCollection $routes)
    {
        require_once APP_ROOT . '/views/register.php';
    }
}
