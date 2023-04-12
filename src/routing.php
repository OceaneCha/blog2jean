<?php

use Oce\Blog\Controllers\HomeController;

$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');

$controller = new HomeController;

if ('' === $route) {
    echo $controller->index();
} elseif ('add' === $route) {
    echo $controller->form();
} elseif (isset($_GET['id'])) {
    if ('show' === $route) {
        //
        echo $controller->display($_GET['id']);
    } elseif ('show/edit' === $route) {
        // edit
        echo $controller->form($_GET['id']);
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 - Page not found';
    exit();
}