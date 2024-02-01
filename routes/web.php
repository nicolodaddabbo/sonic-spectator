<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('post', new Route(constant('URL_SUBFOLDER') . '/{id}', array('controller' => 'PostController', 'method' => 'test'), array('id' => '[0-9]+')));
$routes->add('home', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method' => 'indexAction'), array()));
$routes->add('search', new Route(constant('URL_SUBFOLDER') . '/search', array('controller' => 'PageController', 'method' => 'searchAction'), array()));
$routes->add('search_query', new Route(constant('URL_SUBFOLDER') . '/search/{query}', array('controller' => 'SearchController', 'method' => 'search'), array()));
$routes->add('toggle_follow', new Route(constant('URL_SUBFOLDER') . '/toggleFollow', array('controller' => 'SearchController', 'method' => 'toggleFollow'), array()));
$routes->add('post_creation', new Route(constant('URL_SUBFOLDER') . '/post', array('controller' => 'PageController', 'method' => 'createPostAction'), array()));
$routes->add('create_post', new Route(constant('URL_SUBFOLDER') . '/createPost', array('controller' => 'PostController', 'method' => 'createPost'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . '/login', array('controller' => 'PageController', 'method' => 'loginAction'), array()));
$routes->add('signIn', new Route(constant('URL_SUBFOLDER') . '/signIn', array('controller' => 'AuthController', 'method' => 'signIn'), array()));
$routes->add('logOut', new Route(constant('URL_SUBFOLDER') . '/logOut', array('controller' => 'AuthController', 'method' => 'signOut'), array()));
$routes->add('register', new Route(constant('URL_SUBFOLDER') . '/register', array('controller' => 'PageController', 'method' => 'registerAction'), array()));
$routes->add('signUp', new Route(constant('URL_SUBFOLDER') . '/signUp', array('controller' => 'AuthController', 'method' => 'signUp'), array()));
