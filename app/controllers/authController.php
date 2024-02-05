<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class AuthController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new \UserRepository();
    }

    public function signIn(RouteCollection $routes)
    {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $res = $this->userRepository->checkLoginCredentials($email, $password);
        
        if ($res != null) {
            session_start();
            $_SESSION['user'] = $res['username'];
            $_SESSION['user_id'] = $res['id'];
            header('location:/');
        } else {
            session_start();
            $_SESSION['message'] = 'Wrong email or password';
            header('location:login');
        }
    }

    public function signOut(RouteCollection $routes)
    {
        session_start();
        session_destroy();
        header('location:/');
    }

    public function signUp(RouteCollection $routes)
    {
        $uploadDir = 'assets/profiles/';

        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $birth_date = $_POST['birth_date'];
        $profile_img = null;
        $gender_id = $_POST['gender_id'];

        // Check if a file was uploaded
        if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK) {
            $profile_img = $_FILES['profile_img']['name'];
            $targetPath = $uploadDir . $profile_img;
            move_uploaded_file($_FILES['profile_img']['tmp_name'], $targetPath);
        }

        try {
            $res = $this->userRepository->registerUser($email, $username, $password, $birth_date, $profile_img, $gender_id);
            if ($res) {
                session_start();
                $_SESSION['user'] = $username;
                $_SESSION['user_id'] = $res;
                header('location:/');
            } else {
                session_start();
                $_SESSION['message'] = 'Sign up failed';
                header('location:register');
            }
        } catch (\Exception $e) {
            session_start();
            if (strpos($e->getMessage(), 'username')) {
                $_SESSION['message'] = 'Username already exists';
            } elseif (strpos($e->getMessage(), 'email')) {
                $_SESSION['message'] = 'Email already exists';
            } else {
                $_SESSION['message'] = 'Failed inserting new user: ' . $e->getMessage();
            }
            header('location:register');
        }
    }
}