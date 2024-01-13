<?php

// Call model
// require_once 'models/product.php';
// $products = Product::getAllProducts();

$posts = [
    [
        'title' => 'Lorem ipsum dolor sit amet',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, diam vitae aliquam tincidunt, elit nunc aliquet nun
        c, nec aliquam nisl nunc quis nisl. Sed euismod, diam vitae aliquam tincidunt, elit nunc aliquet nunc, nec aliquam nisl nunc quis nisl.',
        'author' => 'John Doe',
        'date' => '2020-01-01',
        'likes' => 10,
        'comments' => 5,
    ],
];

// Call the view
require_once 'views/home.php';
