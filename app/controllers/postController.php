<?php

namespace App\Controllers;

use App\Models\Post;
use Symfony\Component\Routing\RouteCollection;

session_start();

class PostController
{
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new \PostRepository();
    }

    public function createPost(RouteCollection $routes)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];

            // Handle the file upload
            $uploadDir = 'assets/posts/';
            $filename = basename($_FILES['image']['name']);
            $uploadedFile = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
                // File upload successful
                $this->postRepository->createPost($description, $filename, $_SESSION['user_id']);
                $response['status'] = true;
            } else {
                $response['status'] = false;
            }
            echo json_encode($response);
        }
    }
}
