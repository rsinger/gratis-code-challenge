<?php

namespace App\Controllers;

use App\Services\Locations;

class Home extends BaseController
{
    private Locations $locationsService;

    public function __construct()
    {
        parent::__construct();
        $this->locationsService = new Locations($this->db);
    }

    public function index()
    {
        $location = $this->locationsService->getDefaultLocation();
        $title = $location ? $location->getName() : 'Home';
        if (!empty($location->getTagline())) {
            $title .= ' - ' . $location->getTagline();
        }
        $this->render('home.latte', ['title' => $title, 'location' => $location]);
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
