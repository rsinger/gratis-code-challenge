<?php

namespace App\Models;

use DateTime;

class Vehicle
{
    private int $id;
    private int $model;
    private int $trim;
    private int $year;
    private string $color;
    private int $mileage = 0;
    private float $price;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private ?int $locationId;
    private ?DateTime $addedToInventoryAt;
    private ?DateTime $removedFromInventoryAt;


}