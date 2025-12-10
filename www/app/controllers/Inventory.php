<?php

namespace App\Controllers;

use App\Services\Vehicles;

class Inventory extends BaseController
{
    public function listItems()
    {
        $vehicles = new Vehicles($this->db);
        $allVehicles = $vehicles->getAllVehicles();
        $this->render('vehicles.latte', ['vehicles' => $allVehicles]);
    }

    public function viewItem(): void
    {
        $this->render('vehicle_detail.latte');
    }

    public function addItem(): void
    {
        $this->render('add_vehicle.latte');
    }

    public function editItem(): void
    {
        $this->render('edit_vehicle.latte');
    }

    public function deleteItem(): void
    {
     
    }

    public function saveItem(): void
    {
      
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (preg_match('#^/inventory/view/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
                $controller->viewItem();
            } elseif (preg_match('#^/inventory/edit/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
                $controller->editItem();
            } elseif ($_SERVER['REQUEST_URI'] === '/inventory/add') {
                $controller->addItem();
            } else {
                $controller->listItems();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (preg_match('#^/inventory/delete/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
                $controller->deleteItem();
            } elseif (preg_match('#^/inventory/save$#', $_SERVER['REQUEST_URI'], $matches)) {
                $controller->saveItem();
            } else {
                http_response_code(404);
                echo "404 Not Found";
            }
        } else {
            http_response_code(405);
            echo "405 Method Not Allowed";
        }
    }
}