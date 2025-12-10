<?php

namespace App\Controllers;

use App\Services\DB;
use Latte\Engine;

abstract class BaseController
{
    private $templateEngine;
    private $viewPath = __DIR__ . '/../views/';
    protected DB $db;

    public function __construct()
    {
        $this->templateEngine = new Engine();
        $this->templateEngine->setTempDirectory(path: '/tmp/latte');  
        $this->db = DB::getInstance();      
    }

    protected function render($templatePath, $params = [])
    {
        echo $this->templateEngine->renderToString($this->viewPath . $templatePath, $params);
    }    
}