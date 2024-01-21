<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class SearchController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new \UserRepository();
    }

    public function search(string $query, RouteCollection $routes)
    {
        $users = $this->userRepository->searchUsers($query);

        include_once APP_ROOT . "/views/searchResults.php";
    }

    public function toggleFollow(RouteCollection $routes)
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the profile user ID from the POST request
            $profileUserId = isset($_POST['profileUserId']) ? $_POST['profileUserId'] : null;

            if ($profileUserId !== null) {
                // Assuming you have a logged-in user ID, replace with your actual logic
                $loggedInUserId = /*$loggedInUserId*/1; // Replace with the actual logged-in user ID

                // Toggle follow status and retrieve the updated follow status
                $isFollowing = $this->userRepository->toggleFollowUser($loggedInUserId, $profileUserId);

                // Send the updated follow status as JSON response
                echo json_encode(['isFollowing' => $isFollowing]);
            } else {
                // Invalid request, handle accordingly
                echo json_encode(['error' => 'Invalid request']);
            }
        } else {
            // Invalid request method, handle accordingly
            echo json_encode(['error' => 'Invalid request method']);
        }

    }
}