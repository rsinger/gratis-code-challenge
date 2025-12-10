<?php

namespace App\Controllers;

class Admin
{
    public function dashboard()
    {
        echo "Welcome to the Admin Dashboard!";
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->dashboard();
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}