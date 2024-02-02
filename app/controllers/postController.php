<?php

namespace App\Controllers;

use App\Models\Post;
use Symfony\Component\Routing\RouteCollection;

session_start();

class PostController
{
    private $postRepository;
    private $userRepository;

    public function __construct()
    {
        $this->postRepository = new \PostRepository();
        $this->userRepository = new \UserRepository();
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

    public function likePost(RouteCollection $routes)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = $_POST['postId'];
            $user_id = $_SESSION['user_id'];

            $this->postRepository->toggleLike($user_id, $post_id);
            $response['likes'] = $this->postRepository->getPostLikesCount($post_id);
            $response['status'] = true;
            echo json_encode($response);
        }
    }

    public function newComment(RouteCollection $routes)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = $_POST['post_id'];
            $user_id = $_SESSION['user_id'];
            $text = $_POST['text'];

            $this->postRepository->addCommentToPost($text, $user_id, $post_id);

            $response['new_comment'] = [
                'username' => $this->userRepository->getUser($user_id)[0]['username'],
                'text' => $text,
            ];
            $response['status'] = true;
            echo json_encode($response);
        }
    }
}
