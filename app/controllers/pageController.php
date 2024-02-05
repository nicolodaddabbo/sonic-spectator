<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

session_start();

class PageController
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

    private function getLikes($posts)
    {
        $likes = [];
        foreach ($posts as $post) {
            $likes[$post['id']] = $this->postRepository->getPostLikes($post['id']);
        }

        return $likes;
    }

    private function getComments($posts)
    {
        $comments = [];
        foreach ($posts as $post) {
            $comments[$post['id']] = $this->postRepository->getPostComments($post['id']);
        }

        return $comments;
    }

    public function indexAction(RouteCollection $routes)
    {
        if (!isset($_SESSION['user'])) {
            require_once APP_ROOT . '/views/home.php';
            return;
        }
        $posts = $this->postRepository->getPostsByFollowingUsers($_SESSION['user_id']);

        $posting_users = [];
        foreach ($posts as $post) {
            if (!isset($posting_users[$post['user_id']])) {
                $posting_users[$post['user_id']] = $this->userRepository->getUser($post['user_id']);
            }
        }

        $likesArray = $this->getLikes($posts);
        // Flatten the array of likes
        $likes = array_map(function ($subArray) {
            return array_map(function ($item) {
                return $item['user_id'];
            }, $subArray);
        }, $likesArray);

        $comments = $this->getComments($posts);
        $commenting_users = [];
        foreach ($comments as $comment) {
            foreach ($comment as $userComment) {
                if (!isset($commenting_users[$userComment['user_id']])) {
                    $commenting_users[$userComment['user_id']] = $this->userRepository->getUser($userComment['user_id']);
                }
            }
        }

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

    public function createPostAction(RouteCollection $routes)
    {
        require_once APP_ROOT . '/views/createPost.php';
    }

    public function profileAction(RouteCollection $routes)
    {
        if (!isset($_SESSION['user'])) {
            require_once APP_ROOT . '/views/home.php';
            return;
        }

        $profileImage = $this->userRepository->getUser($_SESSION['user_id'])['profile_img'];
        $posts = $this->postRepository->getUserPosts($_SESSION['user_id']);
        $likes = $this->getLikes($posts);
        $comments = $this->getComments($posts);
        $post_count = count($posts);
        $follower_count = $this->userRepository->getUserFollowersCount($_SESSION['user_id']);
        $following_count = $this->userRepository->getUserFollowingCount($_SESSION['user_id']);
        $comments = $this->getComments($posts);
        $commenting_users = [];
        foreach ($comments as $comment) {
            foreach ($comment as $userComment) {
                if (!isset($commenting_users[$userComment['user_id']])) {
                    $commenting_users[$userComment['user_id']] = $this->userRepository->getUser($userComment['user_id']);
                }
            }
        }

        require_once APP_ROOT . '/views/profile.php';
    }

    public function showUser(int $id, RouteCollection $routes)
    {
        if (!isset($_SESSION['user'])) {
            require_once APP_ROOT . '/views/home.php';
            return;
        }

        if ($id === $_SESSION['user_id']) {
            header('Location: /profile');
            return;
        }

        $user = $this->userRepository->getUser($id);
        $profileImage = $user['profile_img'];
        $posts = $this->postRepository->getUserPosts($id);
        $likes = $this->getLikes($posts);
        $comments = $this->getComments($posts);
        $post_count = count($posts);
        $follower_count = $this->userRepository->getUserFollowersCount($user['id']);
        $following_count = $this->userRepository->getUserFollowingCount($user['id']);
        $isFollowing = $this->userRepository->isFollowing($_SESSION['user_id'], $user['id']);
        $comments = $this->getComments($posts);
        $commenting_users = [];
        foreach ($comments as $comment) {
            foreach ($comment as $userComment) {
                if (!isset($commenting_users[$userComment['user_id']])) {
                    $commenting_users[$userComment['user_id']] = $this->userRepository->getUser($userComment['user_id']);
                }
            }
        }

        require_once APP_ROOT . '/views/profile.php';
    }

    public function notificationsAction(RouteCollection $routes)
    {
        if (!isset($_SESSION['user'])) {
            require_once APP_ROOT . '/views/home.php';
            return;
        }

        define('NOTIFICATION_TYPE_LIKE', 1);
        define('NOTIFICATION_TYPE_COMMENT', 2);
        define('NOTIFICATION_TYPE_FOLLOW', 3);

        $notifications = $this->userRepository->getUserNotifications($_SESSION['user_id']);
        $users = [];
        $notification_types = [];
        $post_images = [];
        foreach ($notifications as $notification) {
            if (!isset($users[$notification['sending_user_id']])) {
                $users[$notification['sending_user_id']] = $this->userRepository->getUser($notification['sending_user_id']);
            }
            if (!isset($notification_types[$notification['notification_type_id']])) {
                $notification_types[$notification['notification_type_id']] = $this->notificationService->getNotificationType($notification['id']);
            }
            if ($notification['post_id'] && !isset($post_images[$notification['post_id']])) {
                $post_images[$notification['post_id']] = $this->postRepository->getUserPostById($_SESSION['user_id'], $notification['post_id'])['image'];
            }
        }

        require_once APP_ROOT . '/views/notifications.php';
    }

    public function followersListAction(int $id, RouteCollection $routes)
    {
        if (!isset($_SESSION['user'])) {
            require_once APP_ROOT . '/views/home.php';
            return;
        }

        $follow_list = $this->userRepository->getUserFollowers($id);
        $users = [];
        foreach ($follow_list as $item)
        {
            if (!isset($users[$item['follower_id']])) {
                $users[$item['follower_id']] = $this->userRepository->getUser($item['follower_id']);
            }
        }
        $header = 'Followers';

        require_once APP_ROOT . '/views/follow_list.php';
    }

    public function followingListAction(int $id, RouteCollection $routes)
    {
        if (!isset($_SESSION['user'])) {
            require_once APP_ROOT . '/views/home.php';
            return;
        }

        $follow_list = $this->userRepository->getUserFollowing($id);
        $users = [];
        foreach ($follow_list as $item)
        {
            if (!isset($users[$item['followed_id']])) {
                $users[$item['followed_id']] = $this->userRepository->getUser($item['followed_id']);
            }
        }
        $header = 'Following';

        require_once APP_ROOT . '/views/follow_list.php';
    }

}
