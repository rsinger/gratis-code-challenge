<?php

use App\Controllers\Admin;
use App\Controllers\Home;
use App\Controllers\Inventory;
use App\Controllers\Login;

require __DIR__ . '/vendor/autoload.php';

// router
session_start();
switch ($_SERVER['REQUEST_URI']) {
    case '/':
        Home::handleRequest();
        break;
    case preg_match('#^/inventory#', $_SERVER['REQUEST_URI']) ? true : false:
        Inventory::handleRequest();
        break;
    case '/login':
    case '/login/create-account':
        Login::handleRequest();
        break;
    case '/logout':
        session_destroy();
        header('Location: /');
        exit();
        break;
    case '/admin':
        Admin::handleRequest();
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}

exit(0);
