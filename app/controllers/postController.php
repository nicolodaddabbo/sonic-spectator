<?php

namespace App\Controllers;

use App\Models\Post;
use Symfony\Component\Routing\RouteCollection;

class PostController
{
    public function test(int $id, RouteCollection $routes)
    {
        $post = new Post();
        $post->read($id);

        require_once APP_ROOT . "/views/home.php";
    }
}
