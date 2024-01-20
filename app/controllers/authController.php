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
        // $password = md5($_POST['password']);
        $password = $_POST['password']; // TODO: hash password

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
}