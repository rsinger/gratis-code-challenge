<?php

namespace App\Models;

use DateTime;

class Vehicle
{
    private ?int $id;
    private string $make;
    private string $model;
    private string $trim;
    private InventoryType $inventoryType;
    private int $year;
    private string $exteriorColor;
    private string $interiorColor;
    private string $vin;
    private string $imageUrl;
    private int $mileage = 0;
    private float $price;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $locationId;
    private int $addedByUserId;

    public function __construct(
        ?int $id,
        string $make,
        string $model,
        string $trim,
        InventoryType $inventoryType,
        int $year,
        string $exteriorColor,
        string $interiorColor,
        string $vin,
        string $imageUrl,
        float $price,
        int $mileage,
        int $locationId,
        DateTime $createdAt,
        DateTime $updatedAt,
        int $addedByUserId
    ) {
        $this->id = $id;
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->price = $price;
        $this->mileage = $mileage;
        $this->locationId = $locationId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->trim = $trim;
        $this->inventoryType = $inventoryType;
        $this->exteriorColor = $exteriorColor;
        $this->interiorColor = $interiorColor;
        $this->vin = $vin;
        $this->imageUrl = $imageUrl;
        $this->addedByUserId = $addedByUserId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function setMake(string $make): void
    {
        $this->make = $make;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getTrim(): string
    {
        return $this->trim;
    }

    public function setTrim(string $trim): void
    {
        $this->trim = $trim;
    }

    public function getInventoryType(): InventoryType
    {
        return $this->inventoryType;
    }

    public function setInventoryType(InventoryType $inventoryType): void
    {
        $this->inventoryType = $inventoryType;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }
    
    public function getExteriorColor(): string
    {
        return $this->exteriorColor;
    }

    public function setExteriorColor(string $exteriorColor): void
    {
        $this->exteriorColor = $exteriorColor;
    }

    public function getInteriorColor(): string
    {
        return $this->interiorColor;
    }

    public function setInteriorColor(string $interiorColor): void
    {
        $this->interiorColor = $interiorColor;
    }

    public function getVin(): string
    {
        return $this->vin;
    }

    public function setVin(string $vin): void
    {
        $this->vin = $vin;
    }   

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }   
    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): void
    {
        $this->mileage = $mileage;
    }   

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }    

    public function getLocationId(): int
    {
        return $this->locationId;
    }
    
    public function getAddedByUserId(): int
    {
        return $this->addedByUserId;
    }
}