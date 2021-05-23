<?php

declare(strict_types=1);

namespace App\Service\DataReader;

class GeoData implements DataInterface
{
    private string $name;
    private float $longitude;
    private float $latitude;

    public function __construct(
        string $name,
        float $latitude,
        float $longitude
    ) {
        $this->name = $name;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }
}
