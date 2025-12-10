<?php

namespace App\Controllers;

class Login
{
    public function showLoginForm()
    {
        echo "Displaying login form.";
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->showLoginForm();
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}