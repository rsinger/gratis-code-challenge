<?php

namespace App\Services;

use App\Models\Location;
use PDO;

class Locations
{
    private PDO $db;
    
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getLocationById(int $id): ?Location
    {
        $stmt = $this->db->prepare('SELECT * FROM locations WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Location(
                $data['id'],
                $data['name'],
                $data['address'],
                $data['tagline'],
                $data['description'],
                $data['image_url'],
                $data['url'],
                new \DateTime($data['created_at']),
                new \DateTime($data['updated_at'])
            );
        }

        return null;
    }

    public function getDefaultLocation(): ?Location
    {
        $stmt = $this->db->prepare('SELECT * FROM locations WHERE default_location = 1 LIMIT 1');
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Location(
                $data['id'],
                $data['name'],
                $data['address'],
                $data['tagline'],
                $data['description'],
                $data['image_url'],
                $data['url'],
                new \DateTime($data['created_at']),
                new \DateTime($data['updated_at'])
            );
        }

        return null;
    }
}