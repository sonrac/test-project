<?php

declare(strict_types=1);

namespace App\Service\DataReader;

class DataReader
{
    private $reader;

    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }
}
