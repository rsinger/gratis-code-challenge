<?php

namespace App\Services;

use App\Models\InventoryType;
use App\Models\Vehicle;
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
        return array_map(function (&$row) {
            return new Vehicle(
                $row['id'],
                $row['make'],
                $row['model'],
                $row['trim'],
                InventoryType::from($row['inventory_type']),
                $row['year'],
                $row['color'],
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
}