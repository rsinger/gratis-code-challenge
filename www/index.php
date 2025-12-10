<?php

use App\Controllers\Admin;
use App\Controllers\Home;
use App\Controllers\Inventory;
use App\Controllers\Login;

require __DIR__ . '/vendor/autoload.php';

// router

switch ($_SERVER['REQUEST_URI']) {
    case '/':
        Home::handleRequest();
        break;
    case '/inventory':
        Inventory::handleRequest();
        break;
    case '/login':
        Login::handleRequest();
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
