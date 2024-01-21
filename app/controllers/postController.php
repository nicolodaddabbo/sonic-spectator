<?php

namespace App\Controllers;

use App\Models\Post;
use Symfony\Component\Routing\RouteCollection;

class PostController
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new \PostRepository();
    }

    public function test(int $id, RouteCollection $routes)
    {
        $post = new Post();
        $post->read($id);

        require_once APP_ROOT . "/views/home.php";
    }

    public function createPost(RouteCollection $routes){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];
        
            // Handle the file upload
            $uploadDir = 'assets/posts/';
            $uploadedFile = $uploadDir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)){
                // File upload successful
                $this->postRepository->createPost($description, $uploadedFile, /*$loggedInUserId*/1);
                $response['status'] = true;
            } else{
                $response['status'] = false;
            }
            echo json_encode($response);
        }
    }

}
