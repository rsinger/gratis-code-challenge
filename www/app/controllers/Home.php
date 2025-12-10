<?php

namespace App\Controllers;

use App\Services\Locations;

class Home extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render('home.latte');
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller->index();
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}
