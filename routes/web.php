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
