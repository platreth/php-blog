<?php
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);


// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        require 'views/home-page.php';
        break;
    // Blog page
    case '/blog':
        require 'views/category-page.php';
        break;
    // Everything else
    case '/blog/post':
    	require 'views/post-page.php';
    	break;
    default:
        header('HTTP/1.0 404 Not Found');
        require '/views/404.php';
        break;
}