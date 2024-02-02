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
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $birth_date = $_POST['birth_date'];
        $profile_img = $_POST['profile_img'];
        $gender_id = $_POST['gender_id'];

        $res = $this->userRepository->registerUser($email, $username, $password, $birth_date, $profile_img, $gender_id);

        if ($res) {
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $res['id'];
            header('location:/');
        } else {
            session_start();
            $_SESSION['message'] = 'Sign up failed';
            header('location:signUp');
        }
    }
}