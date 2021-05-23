<?php

declare(strict_types=1);

namespace App\Service\CalculatorResult;

interface ResultItemInterface
{
    public function getDistanceInKm(): float;

    public function getPlaceName(): string;
}
