<?php

declare(strict_types=1);

namespace App\Service\CalculatorResult;

class ResultItem implements ResultItemInterface
{
    private string $placeName;
    private float $distance;

    public function __construct(string $placeName, float $distance)
    {
        $this->placeName = $placeName;
        $this->distance = $distance;
    }

    public function getDistanceInKm(): float
    {
        return $this->distance;
    }

    public function getPlaceName(): string
    {
        return $this->placeName;
    }
}
