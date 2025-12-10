<?php

namespace App\Models;

use DateTime;

class Location
{
    private int $_id;
    private string $name;
    private string $address;
    private string $tagline;
    private string $description;
    private string $image;
    private string $url;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private bool $defaultLocation = false;

    public function __construct(
        int $id,
        string $name,
        ?string $address,
        ?string $tagline,
        ?string $description,
        ?string $image,
        ?string $url,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->_id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->tagline = $tagline;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
