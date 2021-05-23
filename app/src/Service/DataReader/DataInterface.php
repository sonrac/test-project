<?php

declare(strict_types=1);

namespace App\Service\DataReader;

interface DataInterface
{
    public function getName(): string;

    public function getLongitude(): float;

    public function getLatitude(): float;
}
