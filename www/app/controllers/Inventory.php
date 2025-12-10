<?php

namespace App\Controllers;

class Inventory
{
    public function listItems()
    {
        echo "Listing all inventory items.";
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->listItems();
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}