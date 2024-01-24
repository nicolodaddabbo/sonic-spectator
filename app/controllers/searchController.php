<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

session_start();

class SearchController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new \UserRepository();
    }

    public function search(string $query, RouteCollection $routes)
    {
        $users = $this->userRepository->searchUsers($_SESSION['user_id'], $query);

        include_once APP_ROOT . "/views/searchResults.php";
    }

    public function toggleFollow(RouteCollection $routes)
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the profile user ID from the POST request
            $profileUserId = isset($_POST['profileUserId']) ? $_POST['profileUserId'] : null;

            if ($profileUserId !== null) {
                // Toggle follow status and retrieve the updated follow status
                $isFollowing = $this->userRepository->toggleFollowUser($_SESSION['user_id'], $profileUserId);

                // Send the updated follow status as JSON response
                echo json_encode(['isFollowing' => $isFollowing]);
            } else {
                // Invalid request
                echo json_encode(['error' => 'Invalid request']);
            }
        } else {
            // Invalid request method
            echo json_encode(['error' => 'Invalid request method']);
        }

    }
}