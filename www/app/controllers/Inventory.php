<?php

namespace App\Controllers;

use App\Models\Vehicle;
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
        $vehicles = new Vehicles($this->db);
        $vehicleId = (int)basename($_SERVER['REQUEST_URI']);
        $vehicle = $vehicles->getVehicleById($vehicleId);
        if (!$vehicle) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }
        $this->render('vehicle_detail.latte', ['vehicle' => $vehicle]);
    }

    public function addItem(): void
    {
        $this->render('add_vehicle.latte');
    }

    public function editItem(): void
    {
        $vehicles = new Vehicles($this->db);
        $vehicleId = (int)basename($_SERVER['REQUEST_URI']);
        $vehicle = $vehicles->getVehicleById($vehicleId);
        if (!$vehicle) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }
        $this->render('edit_vehicle.latte', ['vehicle' => $vehicle]);
    }

    public function deleteItem(): void
    {
        // To be implemented
    }

    public function saveItem(): void
    {
        $newVehicleData = $_POST;
        $vehicles = new Vehicles($this->db);
        $vehicle = new Vehicle(
            null,
            $newVehicleData['make'],
            $newVehicleData['model'],
            $newVehicleData['trim'],
            \App\Models\InventoryType::from($newVehicleData['inventory_type']),
            (int)$newVehicleData['year'],
            $newVehicleData['exterior_color'],
            $newVehicleData['interior_color'],
            $newVehicleData['vin'],
            $newVehicleData['image_url'],
            (float)$newVehicleData['price'],
            (int)$newVehicleData['mileage'],
            (int)$newVehicleData['location_id'],
            new \DateTime(),
            new \DateTime(),
            (int)$this->user->getId()
        );

        $newVehicleId = $vehicles->addVehicle($vehicle);
        $_SESSION['message'] = 'Vehicle added successfully with ID ' . $newVehicleId . '.';
        header('Location: /inventory/' . $newVehicleId);
    }

    public function updateItem(): void
    {
        $vehicles = new Vehicles($this->db);
        $vehicleId = (int)basename($_SERVER['REQUEST_URI']);
        $vehicle = $vehicles->getVehicleById($vehicleId);
        if (!$vehicle) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }
        $updatedVehicleData = $_POST;
        $vehicle->setMake($updatedVehicleData['make']);
        $vehicle->setModel($updatedVehicleData['model']);
        $vehicle->setTrim($updatedVehicleData['trim']);
        $vehicle->setInventoryType(\App\Models\InventoryType::from($updatedVehicleData['inventory_type']));
        $vehicle->setYear((int)$updatedVehicleData['year']);
        $vehicle->setExteriorColor($updatedVehicleData['exterior_color']);
        $vehicle->setInteriorColor($updatedVehicleData['interior_color']);
        $vehicle->setVin($updatedVehicleData['vin']);
        $vehicle->setImageUrl($updatedVehicleData['image_url']);
        $vehicle->setPrice((float)$updatedVehicleData['price']);
        $vehicle->setMileage((int)$updatedVehicleData['mileage']);
        $vehicle->setUpdatedAt(new \DateTime());
        $vehicles->updateVehicle($vehicle);
        $_SESSION['message'] = 'Vehicle updated successfully.';
        header('Location: /inventory/' . $vehicle->getId());
    }

    public static function handleRequest()
    {
        $controller = new self();
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (preg_match('#^/inventory/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
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
            } elseif (preg_match('#^/inventory$#', $_SERVER['REQUEST_URI'], $matches)) {
                $controller->saveItem();
            } elseif (preg_match('#^/inventory/(\d+)$#', $_SERVER['REQUEST_URI'], $matches)) {
                $controller->updateItem();
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