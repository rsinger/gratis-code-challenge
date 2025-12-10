<?php

namespace App\Models;

class User {
    private int $id;
    private string $email;
    private int $locationId;

    public function __construct(int $id, string $email, int $locationId) {
        $this->id = $id;
        $this->email = $email;
        $this->locationId = $locationId;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getLocationId(): int {
        return $this->locationId;
    }
}