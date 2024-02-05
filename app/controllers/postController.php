<?php

namespace App\Controllers;

use App\Models\Post;
use Symfony\Component\Routing\RouteCollection;

session_start();

class PostController
{
    private $postRepository;
    private $userRepository;
    private $notificationService;

    public function __construct()
    {
        $this->postRepository = new \PostRepository();
        $this->userRepository = new \UserRepository();
        $this->notificationService = new \NotificationService();
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
            $owner_id = $this->postRepository->getPostById($post_id)['user_id'];

            $this->postRepository->toggleLike($user_id, $post_id);

            $isLike = $this->postRepository->isPostLikedByUser($user_id, $post_id);
            if ($user_id !== $owner_id && $isLike) {
                $this->notificationService->sendNotificationWithPost(1, $user_id, $owner_id, $post_id);
            }
            
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
            $owner_id = $this->postRepository->getPostById($post_id)['user_id'];

            $this->postRepository->addCommentToPost($text, $user_id, $post_id);
            
            if ($user_id !== $owner_id) {
                $this->notificationService->sendNotificationWithPost(2, $user_id, $owner_id, $post_id);
            }

            $user = $this->userRepository->getUser($user_id);

            $response['new_comment'] = [
                'profile_img' => $user['profile_img'],
                'username' => $user['username'],
                'text' => $text,
            ];
            $response['status'] = true;
            echo json_encode($response);
        }
    }

    public function deletePost(RouteCollection $routes)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_id = $_POST['post_id'];

            $this->postRepository->deletePost($post_id);
            $response['status'] = true;

            echo json_encode($response);
        }
    }
}
