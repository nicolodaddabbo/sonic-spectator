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
$routes->add('profile', new Route(constant('URL_SUBFOLDER') . '/profile', array('controller' => 'PageController', 'method' => 'profileAction'), array()));
$routes->add('like_post', new Route(constant('URL_SUBFOLDER') . '/likePost', array('controller' => 'PostController', 'method' => 'likePost'), array()));
$routes->add('newComment', new Route(constant('URL_SUBFOLDER') . '/newComment', array('controller' => 'PostController', 'method' => 'newComment'), array()));
$routes->add('deletePost', new Route(constant('URL_SUBFOLDER') . '/deletePost', array('controller' => 'PostController', 'method' => 'deletePost'), array()));
$routes->add('user', new Route(constant('URL_SUBFOLDER') . '/user/{id}', array('controller' => 'PageController', 'method' => 'showUser'), array()));
$routes->add('notifications', new Route(constant('URL_SUBFOLDER') . '/notifications', array('controller' => 'PageController', 'method' => 'notificationsAction'), array()));
$routes->add('markAllAsViewed', new Route(constant('URL_SUBFOLDER') . '/markAllAsViewed', array('controller' => 'NotificationController', 'method' => 'markAllAsViewed'), array()));
$routes->add('getNewNotificationsCount', new Route(constant('URL_SUBFOLDER') . '/getNewNotificationsCount', array('controller' => 'NotificationController', 'method' => 'getNewNotificationsCount'), array()));
$routes->add('followersList', new Route(constant('URL_SUBFOLDER') . '/followers/{id}', array('controller' => 'PageController', 'method' => 'followersListAction'), array()));
$routes->add('followingList', new Route(constant('URL_SUBFOLDER') . '/following/{id}', array('controller' => 'PageController', 'method' => 'followingListAction'), array()));
