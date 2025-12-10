<?php

namespace App\Services;

use App\Models\InventoryType;
use App\Models\Vehicle;
use DateTime;
use PDO;

class Vehicles
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllVehicles(int $limit = 10, int $offset = 0): array
    {
        $stmt = $this->db->prepare('SELECT * FROM vehicles');
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function (array $row) {
            return new Vehicle(
                $row['id'],
                $row['make'],
                $row['model'],
                $row['model_trim'],
                InventoryType::from($row['inventory_type']),
                $row['model_year'],
                $row['exterior_color'],
                $row['interior_color'],
                $row['vin'],
                $row['image_url'],
                $row['price'],
                $row['mileage'],
                $row['location_id'],
                new \DateTime($row['created_at']),
                new \DateTime($row['updated_at']),
                $row['added_by_user_id']
            );
        }, $rows);
    }

    public function addVehicle(Vehicle $vehicle): int
    {
        $stmt = $this->db->prepare('INSERT INTO vehicles (make, model, model_trim, inventory_type, model_year, exterior_color, interior_color, vin, image_url, price, mileage, location_id, created_at, updated_at, added_by_user_id) VALUES (:make, :model, :model_trim, :inventory_type, :model_year, :exterior_color, :interior_color, :vin, :image_url, :price, :mileage, :location_id, :created_at, :updated_at, :added_by_user_id)');
        $stmt->execute([
            'make' => $vehicle->getMake(),
            'model' => $vehicle->getModel(),
            'model_trim' => $vehicle->getTrim(),
            'inventory_type' => $vehicle->getInventoryType()->value,
            'model_year' => $vehicle->getYear(),
            'exterior_color' => $vehicle->getExteriorColor(),
            'interior_color' => $vehicle->getInteriorColor(),
            'vin' => $vehicle->getVin(),
            'image_url' => $vehicle->getImageUrl(),
            'price' => $vehicle->getPrice(),
            'mileage' => $vehicle->getMileage(),
            'location_id' => $vehicle->getLocationId(),
            'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
            'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
            'added_by_user_id' => $vehicle->getAddedByUserId()
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function updateVehicle(Vehicle $vehicle): void
    {
        $stmt = $this->db->prepare('UPDATE vehicles SET make = :make, model = :model, model_trim = :model_trim, inventory_type = :inventory_type, model_year = :model_year, exterior_color = :exterior_color, interior_color = :interior_color, vin = :vin, image_url = :image_url, price = :price, mileage = :mileage, location_id = :location_id, updated_at = :updated_at WHERE id = :id');
        $stmt->execute([
            'id' => $vehicle->getId(),
            'make' => $vehicle->getMake(),
            'model' => $vehicle->getModel(),
            'model_trim' => $vehicle->getTrim(),
            'inventory_type' => $vehicle->getInventoryType()->value,
            'model_year' => $vehicle->getYear(),
            'exterior_color' => $vehicle->getExteriorColor(),
            'interior_color' => $vehicle->getInteriorColor(),
            'vin' => $vehicle->getVin(),
            'image_url' => $vehicle->getImageUrl(),
            'price' => $vehicle->getPrice(),
            'mileage' => $vehicle->getMileage(),
            'location_id' => $vehicle->getLocationId(),
            'updated_at' => (new DateTime())->format('Y-m-d H:i:s')
        ]);
    }

    public function getVehicleById(int $id): ?Vehicle
    {
        $stmt = $this->db->prepare('SELECT * FROM vehicles WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Vehicle(
                $data['id'],
                $data['make'],
                $data['model'],
                $data['model_trim'],
                InventoryType::from($data['inventory_type']),
                $data['model_year'],
                $data['exterior_color'],
                $data['interior_color'],
                $data['vin'],
                $data['image_url'],
                $data['price'],
                $data['mileage'],
                $data['location_id'],
                new \DateTime($data['created_at']),
                new \DateTime($data['updated_at']),
                $data['added_by_user_id']
            );
        }

        return null;
    }
}