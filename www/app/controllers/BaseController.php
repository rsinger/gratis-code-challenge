<?php

namespace App\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Services\DB;
use App\Services\Locations;
use Latte\Engine;

abstract class BaseController
{
    private $templateEngine;
    private $viewPath = __DIR__ . '/../views/';
    protected DB $db;
    protected ?User $user;
    protected array $messages = [];
    protected Location $location;

    public function __construct()
    {
        $this->templateEngine = new Engine();
        $this->templateEngine->setTempDirectory(path: '/tmp/latte');  
        $this->db = DB::getInstance();      
        $this->location = (new Locations($this->db))->getDefaultLocation();
        if (!empty($_SESSION['message'])) {
            $this->messages[]= $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if (!empty($_SESSION['userId'])) {
            $userId = (int)$_SESSION['userId'];
            $userService = new \App\Services\Users($this->db);
            $this->user = $userService->getUserById($userId);
        } else {
            $this->user = null;
        }
    }

    protected function render($templatePath, $params = [])
    {
        $params['messages'] = $this->messages ?? [];
        $params['user'] = $this->user ?? null;
        $params['location'] = $this->location ?? null;
        $params['title'] = $this->location ? $this->location->getName() : 'Home';
        if (!empty($this->location->getTagline())) {
            $params['title'] .= ' - ' . $this->location->getTagline();
        }
        echo $this->templateEngine->renderToString($this->viewPath . $templatePath, $params);
    }    
}